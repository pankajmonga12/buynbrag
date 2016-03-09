<?php
class FbLogin extends CI_Controller
{
	public function __constructor()
	{
		parent::__constructor();
	}
	
	public function index($devMode = 0)
	{
		log_message('INFO', 'fb sdk test by shammi shailaj started');
		log_message('INFO', 'current directory is: '.__DIR__);

		log_message('INFO', 'devMode = '.$devMode);
		
		$fbAppIDLive = '394741787279624';
		$fbAppSecretLive = '48a073a1b1e78e2b35a88610bace7f92';
		
		$fbAppIDTest = '454156234672558';
		$fbAppSecretTest = '5ef93f05dc0b5fed519532751b379cd7';
		
		$fbAppID = '';
		$fbAppSecret = '';
		
		if($devMode == 1)
		{
			$fbAppID = $fbAppIDTest;
			$fbAppSecret = $fbAppSecretTest;
		}
		
		if($devMode == 0)
		{
			$fbAppID = $fbAppIDLive;
			$fbAppSecret = $fbAppSecretLive;
		}
		
		$fbConfig = array('appId' => $fbAppID, 'secret' => $fbAppSecret);
		$this->load->library('facebook', $fbConfig);
		log_message('INFO', 'reading CI fb config');
		//$this->config->load('facebook');
		//$fbConfig = $this->config->item('facebook');
		log_message('INFO', 'FB-APP-ID: '.$fbAppID.', FB-APP-SECRET: '.$fbAppSecret);
		
		// Create our Application instance (replace this with your appId and secret).
		//$facebook = new Facebook(array('appId' => $fbAppID, 'secret' => $fbAppSecret));
		
		// Get User ID
		$data['user'] = $this->facebook->getUser();
		
		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		
		if($data['user'])
		{
			try
			{
				// Proceed knowing you have a logged in user who's authenticated.
				$userProfile = $this->facebook->api('/me');
				log_message('INFO', 'Someone is probably logged-in');
				log_message('INFO', 'user_profile = '.print_r($userProfile, TRUE));
				log_message('INFO', 'loading the fb_model');
				$this->load->model("fb_model");
				log_message('INFO', "cheking if the user already exists");
				$userExists = $this->fb_model->user_exists($userProfile["id"], $userProfile["email"]);
				log_message('INFO', 'userExists = '.$userExists);
				switch($userExists)
				{
					case 1:	// existing bnb member. check if they were trying to signup then show them error page else directly log-them-in
							log_message('INFO', 'existing BNB member');
							log_message('INFO', 'devMode = '.$devMode);
							log_message('INFO', '($devMode == "signup") = '.json_encode( ($devMode == "signup") ) );
							if(strcmp($devMode,"signup") == 0)
							{
								log_message('INFO', 'executing fb error page');
								$tData = array( 'baseURL' => base_url(), "userEmailAddress" => $this->fb_model->userEmailFromFBID( $userProfile["id"] ), "userDOJ" => $this->fb_model->userDOJ( 2, $userProfile['id'] ) );
								$this->load->view( 'fbAlreadySignedUpError', $tData );
							}
							else
							{
								log_message('INFO', 'executing fblogin code to login the existing user');
								$bnbUID = $this->fb_model->uid($userProfile["id"]); //  get the bnb user id
								$bnbUID = $bnbUID[0]->user_id;
								log_message('INFO', 'fb credentials are fine and the user has already linked their profiles');
								/* FRIENDS CODE */
								try
								{
									// Proceed knowing you have a logged in user who's authenticated.
									$userProfileFr = $this->facebook->api('/me/friends?fields=installed');
									log_message('INFO', 'Someone is probably logged-in');
									//echo "<pre>".print_r($userProfile, TRUE)."</pre>";
									log_message('INFO', 'user_profile = '.print_r($userProfileFr, TRUE));
									$users = $userProfileFr['data'];
									$allFriends = array();
									$friendsWithApp = array();
									
									// compute all friends with app
									foreach($users as $user)
									{
										$allFriends[] = $user['id'];
										if( array_key_exists('installed', $user) )
										{
											if( $user['installed'] == 1 )
											{
												$friendsWithApp[] = $user['id'];
											}
										}
									}

									log_message('INFO', "Access token = ".$this->facebook->getAccessToken()."\r\nPrinting friends with the bnb app!</p>\r\n".print_r($friendsWithApp, TRUE));
									if(count($friendsWithApp) > 0)
									{
										$bnbFriends = $this->fb_model->fbFriendsToBNBUsers($friendsWithApp);
										if($bnbFriends !== NULL)
										{
											$this->load->model('rapiv1/profile_model', 'profile_model');
											foreach($bnbFriends as $bnbFriend) // make the new user follow every fb friend on BNB
											{
												$this->profile_model->joinFollow($bnbUID, $bnbFriend->userID, TRUE);
											}

											/*foreach($bnbFriends as $bnbFriend) // make every fb friend on BNB follow the new user
											{
												$this->profile_model->joinFollow($bnbFriend->userID, $bnbUID, FALSE);
											}*/
										}
									}
								}
								catch (FacebookApiException $e)
								{
									log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
									log_message('INFO', 'no-one is logged-in');
									error_log($e);
									$data['user'] = null;
								}
								/* END SECTION FRIENDS CODE */
								log_message('INFO', 'trying to set session');
								/* new logout fix by shammi shailaj. Now logging-out from buynbrag will log you out of facebook as well */
								$params["next"] = site_url("sync/logout");
								$logOutURL = $this->facebook->getLogoutUrl($params);
								/* END SECTION new logout fix by shammi shailaj. Now logging-out from buynbrag will log you out of facebook as well */
								$sessionData = array('id' => $bnbUID, 'logged_in' => TRUE, 'fbLogOutURL' => $logOutURL);
								$this->session->set_userdata($sessionData);
								log_message('INFO', 'just set Session data for '.$bnbUID.' from '.$this->input->ip_address());
								log_message('INFO', 'now checking whether it has been set or not');
								$sessionUserID = $this->session->userdata('id');
								$sessionLoggedIN = $this->session->userdata('logged_in');
								log_message('INFO', 'sessionUserID = '.print_r($sessionUserID, TRUE).", sessionLoggedIN = ".print_r($sessionLoggedIN, TRUE));
								switch( (strcmp($sessionUserID, $bnbUID) === 0) && $sessionLoggedIN === TRUE )
								{
									case TRUE:	log_message('INFO', 'session has been set. user with ID: '.$bnbUID.' has been logged in ');
												log_message('INFO', 'now redirecting the user to homepage');
												redirect(base_url());
										break;
									case FALSE:	log_message('INFO', 'session could not be set for user with ID: '.$bnbUID);
												log_message("ERROR", "redirecting them to the homepage");
												redirect(base_url());
										break;
								}
							}
						break;
					case 2: // another bnb member with same email address exists
						  // link their profiles
						  log_message('INFO', 'another bnb member with same email address exists');
						  log_message('INFO', 'linking the FB profile with BNB Profile');
						  $bnbUID = $this->fb_model->uidFromEmail($userProfile["email"]);
						  $bnbUID = $bnbUID[0]->uid;
						  switch($this->fb_model->linkFBAccount($userProfile))
						  {
							case TRUE: $sessionData = array('id' => $bnbUID, 'logged_in' => TRUE);
									 log_message('INFO', " NOW CREATING COUPON 1 FOR THE NEWLY LINKED USER WITH ID : ".$newAccountDetails["newUID"]);
									 $this->load->model('async_model');
									 $couponDetails['couponid'] = "BNBFB1".$bnbUID;
									 $couponDetails['couponValue'] = 500;
									 $couponDetails['couponsCount'] = 1;
									 $couponDetails['couponType'] = 1;
									 $couponDetails['validFrom'] = time();
									 $couponDetails['validUpto'] = time() + (15 * 3600 * 24);
									 $couponDetails['minPurchaseAmount'] = 3500;
									 $couponDetails['userID'] = $bnbUID;

									 $couponResult = $this->async_model->createCouponPublic($couponDetails);
									 switch($couponResult)
									 {
									 	case TRUE: log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB1".$bnbUID." FOR THE NEWLY REGISTERED USER WITH ID : ".$bnbUID);
									 		break;
									 	case FALSE: log_message('INFO', " FAILURE CREATING COUPON BNBFB1".$bnbUID." FOR THE NEWLY REGISTERED USER WITH ID : ".$bnbUID);
									 		break;
									 }

								   $data['ip'] = $this->input->ip_address();
								   $data['userFullName'] = $userProfile["name"];
								   $data['couponCode1'] = "BNBFB1".$bnbUID;
								   $data['validFrom1'] = $couponDetails['validFrom'];
								   $data['validTill1'] = $couponDetails['validUpto'];
								   $data['couponValue1'] = $couponDetails['couponValue'];
								   

								   log_message('INFO', " NOW CREATING COUPON 2 FOR THE NEWLY LINKED USER WITH ID : ".$newAccountDetails["newUID"]);

									 $couponDetails['couponid'] = "BNBFB2".$bnbUID;
									 $couponDetails['couponValue'] = 2000;
									 $couponDetails['couponsCount'] = 1;
									 $couponDetails['couponType'] = 1;
									 $couponDetails['validFrom'] = time();
									 $couponDetails['validUpto'] = time() + (15 * 3600 * 24);
									 $couponDetails['minPurchaseAmount'] = 10000;
									 $couponDetails['userID'] = $bnbUID;

									 $couponResult = $this->async_model->createCouponPublic($couponDetails);
									 switch($couponResult)
									 {
									 	case TRUE: log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB2".$bnbUID." FOR THE NEWLY REGISTERED USER WITH ID : ".$bnbUID);
									 		break;
									 	case FALSE: log_message('INFO', " FAILURE CREATING COUPON BNBFB2".$bnbUID." FOR THE NEWLY REGISTERED USER WITH ID : ".$bnbUID);
									 		break;
									 }

									 $this->load->library('email');
								   $this->email->from('support@buynbrag.com', 'BuynBrag');
								   $this->email->to($userProfile["email"]);
								   $this->email->subject("BuynBrag ::: Here's our first gift to you");
								   
								 
								   $data['couponCode2'] = "BNBFB2".$bnbUID;
								   $data['validFrom2'] = $couponDetails['validFrom'];
								   $data['validTill2'] = $couponDetails['validUpto'];
								   $data['couponValue2'] = $couponDetails['couponValue'];
								   $msg = $this->load->view('emailers/fbSignupLinkCouponMail', $data, true);
								   
								   $this->email->message($msg);
								   $this->email->set_newline("\r\n");
								   
								   if($this->email->send())
								   {
									   log_message('INFO', " Successfully SENt coupon MAIl FOR THE NEWLY LINKED USER WITH ID : ".$bnbUID);
								   }
								   else
								   {
									   log_message('INFO', " Error sending coupon MAIl FOR THE NEWLY LINKED USER WITH ID : ".$bnbUID);
								   }

									 $this->session->set_userdata($sessionData);
									 log_message('INFO', 'just set Session data for '.$bnbUID.' from '.$this->input->ip_address());
									 log_message('INFO', 'now checking whether it has been set or not');
									 $sessionUserID = $this->session->userdata('id');
									 $sessionLoggedIN = $this->session->userdata('logged_in');
									 switch( (strcmp($sessionUserID, $bnbUID) === 0) && $sessionLoggedIN === TRUE )
									 {
										case TRUE: log_message('INFO', 'session has been set. user with ID: '.$bnbUID.' has been logged in ');
												 log_message('INFO', 'now redirecting the user to homepage');
												 redirect(base_url());
											break;
										case FALSE: log_message('INFO', 'session could not be set for user with ID: '.$bnbUID);
												  redirect(base_url());
											break;
									 }
									 /* FRIENDS CODE */
									try
									{
										// Proceed knowing you have a logged in user who's authenticated.
										$userProfileFr = $this->facebook->api('/me/friends?fields=installed');
										log_message('INFO', 'Someone is probably logged-in');
										//echo "<pre>".print_r($userProfile, TRUE)."</pre>";
										log_message('INFO', 'user_profile = '.print_r($userProfileFr, TRUE));
										$users = $userProfileFr['data'];
										$allFriends = array();
										$friendsWithApp = array();
										
										// compute all friends with app
										foreach($users as $user)
										{
											$allFriends[] = $user['id'];
											if( array_key_exists('installed', $user) )
											{
												if( $user['installed'] == 1 )
												{
													$friendsWithApp[] = $user['id'];
												}
											}
										}

										log_message('INFO', "Access token = ".$this->facebook->getAccessToken()."\r\nPrinting friends with the bnb app!</p>\r\n".print_r($friendsWithApp, TRUE));
										if(count($friendsWithApp) > 0)
										{
											$bnbFriends = $this->fb_model->fbFriendsToBNBUsers($friendsWithApp);
											if($bnbFriends !== NULL)
											{
												$this->load->model('rapiv1/profile_model', 'profile_model');
												foreach($bnbFriends as $bnbFriend) // make the new user follow every fb friend on BNB
												{
													$this->profile_model->joinFollow($bnbUID, $bnbFriend->userID, TRUE);
												}

												/*foreach($bnbFriends as $bnbFriend) // make every fb friend on BNB follow the new user
												{
													$this->profile_model->joinFollow($bnbFriend->userID, $bnbUID, FALSE);
												}*/
											}
										}
									}
									catch (FacebookApiException $e)
									{
										log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
										log_message('INFO', 'no-one is logged-in');
										error_log($e);
										$data['user'] = null;
									}
									/* END SECTION FRIENDS CODE */
								break;
							case FALSE: log_message("ERROR", "DB ERROR WHILE LINKING FB ACCOUNT FOR USER: ".$bnbUID);
									  log_message("ERROR", "redirecting them to the homepage");
									  redirect(base_url());
								break;
						  }
						break;
					case 0: // new member. create their profile
							$isReallyNew = FALSE;
						   log_message('INFO', 'the current user appears to be a new member. Verifying from the session...');
						   $this->load->model('async_model');
						   $isLoggedIN = $this->async_model->isLoggedIN();
						   if($isLoggedIN["status"] === TRUE)
						   {
						   		$this->async_model->linkFbProfile($isLoggedIN['uid'], $userProfile['id'], $userProfile['email']);
						   		
						   		log_message('INFO', "\$this->input->server('SERVER_NAME') = ".json_encode($this->input->server('SERVER_NAME')));
						   		$cookie = array('name' => 'linkFB', 'value'  => 'true', 'expire' => 0, 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/', 'prefix' => 'bnbX_', 'secure' => FALSE);
								$this->input->set_cookie($cookie);
								log_message('INFO', 'JUST SET THE linkFB COOKIE. Will now check for it...');
								
								$cookieRead = $this->input->cookie('bnbX_linkFB');
								log_message('INFO', 'The value in cookie is: '.json_encode($cookieRead));

						   		$data['ip'] = $this->input->ip_address();
								$data['userFullName'] = $userProfile["name"];

								 log_message('INFO', " NOW CREATING COUPON 1 FOR THE NEWLY linked USER WITH ID : ".$isLoggedIN['uid']);
								 $couponDetails['couponid'] = "BNBFB1".$isLoggedIN['uid'];
								 $couponDetails['couponValue'] = 500;
								 $couponDetails['couponsCount'] = 1;
								 $couponDetails['couponType'] = 1;
								 $couponDetails['validFrom'] = time();
								 $couponDetails['validUpto'] = time() + (15 * 3600 * 24);
								 $couponDetails['minPurchaseAmount'] = 3500;
								 $couponDetails['userID'] = $isLoggedIN['uid'];

								 $couponResult = $this->async_model->createCouponPublic($couponDetails);
								 switch($couponResult)
								 {
								 	case TRUE: log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB1".$isLoggedIN['uid']." FOR THE NEWLY linked USER WITH ID : ".$newAccountDetails["newUID"]);
								 		break;
								 	case FALSE: log_message('INFO', " FAILURE CREATING COUPON BNBFB1".$isLoggedIN['uid']." FOR THE NEWLY linked USER WITH ID : ".$newAccountDetails["newUID"]);
								 		break;
								 }

								 $data['couponCode1'] = "BNBFB1".$isLoggedIN['uid'];
							   	 $data['validFrom1'] = $couponDetails['validFrom'];
							   	 $data['validTill1'] = $couponDetails['validUpto'];
							   	 $data['couponValue1'] = $couponDetails['couponValue'];

								 log_message('INFO', " NOW CREATING COUPON 2 FOR THE NEWLY REGISTERED USER WITH ID : ".$isLoggedIN['uid']);

								 $couponDetails['couponid'] = "BNBFB2".$isLoggedIN['uid'];
								 $couponDetails['couponValue'] = 2000;
								 $couponDetails['couponsCount'] = 1;
								 $couponDetails['couponType'] = 1;
								 $couponDetails['validFrom'] = time();
								 $couponDetails['validUpto'] = time() + (15 * 3600 * 24);
								 $couponDetails['minPurchaseAmount'] = 10000;
								 $couponDetails['userID'] = $isLoggedIN['uid'];

								 $couponResult = $this->async_model->createCouponPublic($couponDetails);
								 switch($couponResult)
								 {
								 	case TRUE: log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB2".$isLoggedIN['uid']." FOR THE NEWLY linked USER WITH ID : ".$newAccountDetails["newUID"]);
								 		break;
								 	case FALSE: log_message('INFO', " FAILURE CREATING COUPON BNBFB2".$isLoggedIN['uid']." FOR THE NEWLY linked USER WITH ID : ".$newAccountDetails["newUID"]);
								 		break;
								 }

								 $data['couponCode2'] = "BNBFB2".$isLoggedIN['uid'];
							   	 $data['validFrom2'] = $couponDetails['validFrom'];
							   	 $data['validTill2'] = $couponDetails['validUpto'];
							   	 $data['couponValue2'] = $couponDetails['couponValue'];

								 /*log_message('INFO', " NOW SENDING coupon MAIl FOR THE NEWLY linked USER WITH ID : ".$isLoggedIN['uid']);
									$this->load->library('email');
								   $this->email->from('support@buynbrag.com', 'BuynBrag');
								   $this->email->to();
								   $this->email->subject("BuynBrag ::: Here's our gift to you for linking your account");
								   
								   
								   
								   $msg = $this->load->view('emailers/fbSignupLinkCouponMail', $data, true);
								   
								   $this->email->message($msg);
								   $this->email->set_newline("\r\n");
								   
								   if($this->email->send())
								   {
									   log_message('INFO', " Successfully SENt coupon MAIl  FOR THE NEWLY linked USER WITH ID : ".$newAccountDetails["newUID"]);
								   }
								   else
								   {
									   log_message('INFO', " Error sending coupon MAIl  FOR THE NEWLY linked USER WITH ID : ".$newAccountDetails["newUID"]);
								   }*/
						   }
						   else
						   {
						   		$isReallyNew = TRUE;
						   }


						   if($isReallyNew === TRUE)
						   {
						   		log_message('INFO', 'first time user. creating a new account for them');
						   		
						   		log_message('INFO', "\$this->input->server('SERVER_NAME') = ".json_encode($this->input->server('SERVER_NAME')));
						   		$cookie = array('name' => 'firstLogin', 'value'  => 'true', 'expire' => 0, 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/', 'prefix' => 'bnbX_', 'secure' => FALSE);
								
								$this->input->set_cookie($cookie);
								log_message('INFO', 'JUST SET THE firstLogin COOKIE. Will now check for it...');
								
								$cookieRead = $this->input->cookie('bnbX_firstLogin');
								log_message('INFO', 'The value in cookie is: '.json_encode($cookieRead));

								  $newAccountDetails = $this->fb_model->newFBAccount($userProfile);
								  switch($newAccountDetails["result"])
								  {
									case TRUE:	$sessionData = array('id' => $newAccountDetails["newUID"], 'logged_in' => TRUE);
												log_message('INFO', " NOW SENDING Welcome MAIl  FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
												$mail_info = $this->fb_model->welcome_mail_details($newAccountDetails["newUID"]);
												if ($mail_info != 0)
												{
													$base_url = base_url();
													$name = $mail_info[0]['full_name'];
													include 'mail_1.php';
													$this->load->library('email');
													$this->email->from('support@buynbrag.com', 'BuynBrag');
													$this->email->to($mail_info[0]['sent_email_id']);
													$this->email->subject("Welcome to BuynBrag, " . $mail_info[0]['full_name']);
													$this->email->message($msg);
													$this->email->set_newline("\r\n");
													if ($this->email->send())
													{
														log_message('Info', 'Welcome mail has been sent succesfully to user with uid: ' . $newAccountDetails["newUID"]);
														$this->fb_model->welcome_mail_success($newAccountDetails["newUID"]);
													}
													else
													{
														log_message('Info', 'Welcome mail sending failed for user with uid: ' . $newAccountDetails["newUID"]);
													}
												}

												$data['ip'] = $this->input->ip_address();
												$data['userFullName'] = $newAccountDetails["userFullName"];

												log_message('INFO', " NOW CREATING COUPON 1 FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
												$couponDetails['couponid'] = "BNBFB1".$newAccountDetails["newUID"];
												$couponDetails['couponValue'] = 500;
												$couponDetails['couponsCount'] = 1;
												$couponDetails['couponType'] = 1;
												$couponDetails['validFrom'] = time();
												$couponDetails['validUpto'] = time() + (15 * 3600 * 24);
												$couponDetails['minPurchaseAmount'] = 3500;
												$couponDetails['userID'] = $newAccountDetails["newUID"];

												$couponResult = $this->async_model->createCouponPublic($couponDetails);
												switch($couponResult)
												{
													case TRUE: log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB1".$newAccountDetails["newUID"]." FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
														break;
													case FALSE: log_message('INFO', " FAILURE CREATING COUPON BNBFB1".$newAccountDetails["newUID"]." FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
														break;
												}

												$data['couponCode1'] = "BNBFB1".$newAccountDetails["newUID"];
											   	$data['validFrom1'] = $couponDetails['validFrom'];
											   	$data['validTill1'] = $couponDetails['validUpto'];
											   	$data['couponValue1'] = $couponDetails['couponValue'];
												log_message('INFO', " NOW CREATING COUPON 2 FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
												$this->load->model('async_model');
												$couponDetails['couponid'] = "BNBFB2".$newAccountDetails["newUID"];
												$couponDetails['couponValue'] = 2000;
												$couponDetails['couponsCount'] = 1;
												$couponDetails['couponType'] = 1;
												$couponDetails['validFrom'] = time();
												$couponDetails['validUpto'] = time() + (15 * 3600 * 24);
												$couponDetails['minPurchaseAmount'] = 10000;
												$couponDetails['userID'] = $newAccountDetails["newUID"];

												$couponResult = $this->async_model->createCouponPublic($couponDetails);
												switch($couponResult)
												{
													case TRUE: log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB2".$newAccountDetails["newUID"]." FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
														break;
													case FALSE: log_message('INFO', " FAILURE CREATING COUPON BNBFB2".$newAccountDetails["newUID"]." FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
														break;
												}

												$data['couponCode2'] = "BNBFB2".$newAccountDetails["newUID"];
											   	$data['validFrom2'] = $couponDetails['validFrom'];
											   	$data['validTill2'] = $couponDetails['validUpto'];
											   	$data['couponValue2'] = $couponDetails['couponValue'];

												log_message('INFO', " NOW SENDING coupon MAIl FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
												$this->load->library('email');
												$this->email->from('support@buynbrag.com', 'BuynBrag');
												$this->email->to($mail_info[0]['sent_email_id']);
												$this->email->subject("BuynBrag ::: Here's our first gift to you");
												   
												   
												   
												$msg = $this->load->view('emailers/fbSignupLinkCouponMail', $data, true);
												   
												$this->email->message($msg);
												$this->email->set_newline("\r\n");
												  
												if($this->email->send())
												{
												   log_message('INFO', " Successfully SENt coupon MAIl  FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
												}
												else
												{
													log_message('INFO', " Error sending coupon MAIl  FOR THE NEWLY REGISTERED USER WITH ID : ".$newAccountDetails["newUID"]);
												}

												/* FRIENDS CODE */
												try
												{
													// Proceed knowing you have a logged in user who's authenticated.
													$userProfile = $this->facebook->api('/me/friends?fields=installed');
													log_message('INFO', 'Someone is probably logged-in');
													//echo "<pre>".print_r($userProfile, TRUE)."</pre>";
													log_message('INFO', 'user_profile = '.print_r($userProfile, TRUE));
													$users = $userProfile['data'];
													$allFriends = array();
													$friendsWithApp = array();
													
													// compute all friends with app
													foreach($users as $user)
													{
														$allFriends[] = $user['id'];
														if( array_key_exists('installed', $user) )
														{
															if( $user['installed'] == 1 )
															{
																$friendsWithApp[] = $user['id'];
															}
														}
													}

													log_message('INFO', "Access token = ".$this->facebook->getAccessToken()."\r\nPrinting friends with the bnb app!</p>\r\n".print_r($friendsWithApp, TRUE));
													if(count($friendsWithApp) > 0)
													{
														$bnbFriends = $this->fb_model->fbFriendsToBNBUsers($friendsWithApp);
														if($bnbFriends !== NULL)
														{
															$this->load->model('rapiv1/profile_model', 'profile_model');
															foreach($bnbFriends as $bnbFriend) // make the new user follow every fb friend on BNB
															{
																$this->profile_model->joinFollow($newAccountDetails["newUID"], $bnbFriend->userID, TRUE);
															}

															/*foreach($bnbFriends as $bnbFriend) // make every fb friend on BNB follow the new user
															{
																$this->profile_model->joinFollow($bnbFriend->userID, $newAccountDetails["newUID"], FALSE);
															}*/
														}
													}
												}
												catch (FacebookApiException $e)
												{
													log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
													log_message('INFO', 'no-one is logged-in');
													error_log($e);
													$data['user'] = null;
												}
												/* END SECTION FRIENDS CODE */

												$this->session->set_userdata($sessionData);
												log_message('INFO', 'just set Session data for '.$newAccountDetails["newUID"].' from '.$this->input->ip_address());
												log_message('INFO', 'now checking whether it has been set or not');
												$sessionUserID = $this->session->userdata('id');
												$sessionLoggedIN = $this->session->userdata('logged_in');

												switch( (strcmp($sessionUserID, $newAccountDetails["newUID"]) === 0) && $sessionLoggedIN === TRUE )
												{
													case TRUE:	log_message('INFO', 'session has been set. user with ID: '.$newAccountDetails["newUID"].' has been logged in ');
																log_message('INFO', 'now redirecting the user to homepage');
																redirect(base_url());
														break;
													case FALSE:	log_message('INFO', 'session could not be set for user with ID: '.$newAccountDetails["newUID"]);
																redirect(base_url());
														break;
												}
										break;
									case FALSE:	log_message("ERROR", "DB ERROR WHILE LINKING FB ACCOUNT FOR USER: ".$newAccountDetails["newUID"]." ad FB ID: ".$data["id"]);
												log_message("ERROR", "redirecting them to the homepage");
												redirect(base_url());
										break;
								  }
						   }
						break;
				}
			}
			catch (FacebookApiException $e)
			{
				log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
				log_message('INFO', 'no-one is logged-in');
				error_log($e);
				$data['user'] = null;
			}
		}
		// Login or logout url will be needed depending on current user state.
		if($data['user'])
		{
			$params["next"] = site_url("sync/logout");
			$data['logoutUrl'] = $this->facebook->getLogoutUrl($params);
		}
		else
		{
			$params = array();
			$params["scope"] = "email,user_birthday,user_about_me,publish_actions";
			$params['scope'] .= ",user_friends,user_likes,user_subscriptions,friends_likes,friends_subscriptions,create_note,publish_stream,share_item,xmpp_login,manage_notifications";
			$params["redirect_uri"] = base_url()."index.php/fbLogin/index";
			//$params["display"] = "popup";
			$data['loginUrl'] = $this->facebook->getLoginUrl($params);
			redirect($data['loginUrl']);
		}
		
		log_message('INFO', 'data = '.print_r($data, TRUE));
		//$this->load->view('fbLogin', $data);
		$data['user_profile'] = $userProfile;
		//$this->load->view('fbLogin2', $data);
	}
	
	public function oldWorkingtestloginskdjhfsdkjf()
	{
		log_message('INFO', 'fb sdk test by shammi shailaj started');
		log_message('INFO', 'current directory is: '.__DIR__);
		$fbAppID = '394741787279624';
		$fbAppSecret = '48a073a1b1e78e2b35a88610bace7f92';
		$fbConfig = array('appId' => $fbAppID, 'secret' => $fbAppSecret);
		$this->load->library('facebook', $fbConfig);
		log_message('INFO', 'reading CI fb config');
		//$this->config->load('facebook');
		//$fbConfig = $this->config->item('facebook');
		log_message('INFO', 'FB-APP-ID: '.$fbAppID.', FB-APP-SECRET: '.$fbAppSecret);
		
		// Create our Application instance (replace this with your appId and secret).
		//$facebook = new Facebook(array('appId' => $fbAppID, 'secret' => $fbAppSecret));
		
		// Get User ID
		$data['user'] = $this->facebook->getUser();
		
		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		
		if($data['user'])
		{
			try
			{
				// Proceed knowing you have a logged in user who's authenticated.
				$data['user_profile'] = $this->facebook->api('/me');
				log_message('INFO', 'Someone is probably logged-in');
				log_message('INFO', 'user_profile = '.print_r($data['user_profile'], TRUE));
			}
			catch (FacebookApiException $e)
			{
				log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
				log_message('INFO', 'no-one is logged-in');
				error_log($e);
				$data['user'] = null;
			}
		}
		// Login or logout url will be needed depending on current user state.
		if($data['user'])
		{
			$params["next"] = base_url();
			$data['logoutUrl'] = $this->facebook->getLogoutUrl($params);
		}
		else
		{
			$params = array();
			$params["scope"] = "email,user_birthday,user_about_me,publish_actions";
			$params["redirect_uri"] = base_url()."index.php/fbLogin/index";
			//$params["display"] = "popup";
			$data['loginUrl'] = $this->facebook->getLoginUrl($params);
		}
		
		log_message('INFO', 'data = '.print_r($data, TRUE));
		//$this->load->view('fbLogin', $data);
		$this->load->view('fbLogin2', $data);
	}
	
	public function loginjkwgfdiuwehfohworhfiuwgefiweihroweir()
	{
		log_message('INFO', 'fb sdk test by shammi shailaj started');
		log_message('INFO', 'current directory is: '.__DIR__);
		log_message('INFO', 'trying to load file: '.__DIR__.'/../libraries/facebook.php');
		require __DIR__.'/../libraries/facebook.php';
		log_message('INFO', 'reading CI fb config');
		//$this->config->load('facebook');
		//$fbConfig = $this->config->item('facebook');
		$fbAppID = '394741787279624';
		$fbAppSecret = '48a073a1b1e78e2b35a88610bace7f92';
		log_message('INFO', 'FB-APP-ID: '.$fbAppID.', FB-APP-SECRET: '.$fbAppSecret);
		
		// Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array('appId' => $fbAppID, 'secret' => $fbAppSecret));
		
		// Get User ID
		$data['user'] = $facebook->getUser();
		
		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		
		if($data['user'])
		{
			try
			{
				// Proceed knowing you have a logged in user who's authenticated.
				$data['user_profile'] = $facebook->api('/me');
				log_message('INFO', 'Someone is probably logged-in');
				log_message('INFO', 'user_profile = '.print_r($data['user_profile'], TRUE));
			}
			catch (FacebookApiException $e)
			{
				log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
				log_message('INFO', 'no-one is logged-in');
				error_log($e);
				$data['user'] = null;
			}
		}
		// Login or logout url will be needed depending on current user state.
		if($data['user'])
		{
			$data['logoutUrl'] = $facebook->getLogoutUrl();
		}
		else
		{
			$data['loginUrl'] = $facebook->getLoginUrl(array("scope" => "email,user_birthday,user_about_me,publish_stream"));
		}
		
		// This call will always work since we are fetching public data.
		$data['naitik'] = $facebook->api('/naitik');
		log_message('INFO', 'data = '.print_r($data, TRUE));
		?>
		<?php if( ! defined ( 'BASEPATH' ) ) exit('Direct script access not allowed'); ?>
		<!doctype html>
		<html xmlns:fb="http://www.facebook.com/2008/fbml">
			<head>
				<title>php-sdk test by shammi</title>
				<style>
				<!--
					body { font-family: 'Lucida Grande', Verdana, Arial, sans-serif; }
					h1 a { text-decoration: none; color: #3b5998; }
					h1 a:hover { text-decoration: underline; }
				-->
				</style>
			</head>
			<body>
				<h1>php-sdk  by shammi shailaj</h1>
				
				<?php
				if($data['user'])
				{
					?>
					<a href="<?php echo $data['logoutUrl']; ?>">Logout</a>
					<?php
				}
				else
				{
					?>
					<div>
					Login using OAuth 2.0 handled by the PHP SDK:
					<a href="<?php echo $data['loginUrl']; ?>">Login with Facebook</a>
					</div>
					<?php
				}
				?>
				
				<h3>PHP Session</h3>
				<pre>
					<?php
						print_r($_SESSION);
					?>
				</pre>
				
				<?php
				if($data['user'])
				{
					?>
					<h3>You</h3>
					<img src="https://graph.facebook.com/<?php echo $data['user']; ?>/picture">
					<h3>Your User Object (/me)</h3>
					<pre><?php print_r($data['user_profile']); ?></pre>
					<?php
				}
				else
				{
					?>
					<strong><em>You are not Connected.</em></strong>
					<?php
				}
				?>
				<h3>Public profile of Naitik</h3>
				<img src="https://graph.facebook.com/naitik/picture">
				<?php
					echo $data['naitik']['name'];
				?>
			</body>
		</html>
	<?php
	}

	public function testAppFriends()
	{
		log_message('INFO', 'fb sdk test by shammi shailaj started');
		log_message('INFO', 'current directory is: '.__DIR__);

		log_message('INFO', 'devMode = '.$devMode);
		
		$fbAppIDLive = '394741787279624';
		$fbAppSecretLive = '48a073a1b1e78e2b35a88610bace7f92';
		
		$fbAppIDTest = '454156234672558';
		$fbAppSecretTest = '5ef93f05dc0b5fed519532751b379cd7';
		
		$fbAppID = '';
		$fbAppSecret = '';
		
		if($devMode == 1)
		{
			$fbAppID = $fbAppIDTest;
			$fbAppSecret = $fbAppSecretTest;
		}
		
		if($devMode == 0)
		{
			$fbAppID = $fbAppIDLive;
			$fbAppSecret = $fbAppSecretLive;
		}
		
		$fbConfig = array('appId' => $fbAppID, 'secret' => $fbAppSecret);
		$this->load->library('facebook', $fbConfig);
		log_message('INFO', 'reading CI fb config');
		//$this->config->load('facebook');
		//$fbConfig = $this->config->item('facebook');
		log_message('INFO', 'FB-APP-ID: '.$fbAppID.', FB-APP-SECRET: '.$fbAppSecret);
		
		// Create our Application instance (replace this with your appId and secret).
		//$facebook = new Facebook(array('appId' => $fbAppID, 'secret' => $fbAppSecret));
		
		// Get User ID
		$data['user'] = $this->facebook->getUser();
		
		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		
		if($data['user'])
		{
			try
			{
				// Proceed knowing you have a logged in user who's authenticated.
				$userProfile = $this->facebook->api('/me/friends?fields=installed');
				log_message('INFO', 'Someone is probably logged-in');
				//echo "<pre>".print_r($userProfile, TRUE)."</pre>";
				log_message('INFO', 'user_profile = '.print_r($userProfile, TRUE));
				$users = $userProfile['data'];
				$allFriends = array();
				$friendsWithApp = array();
				
				// compute all friends with app
				foreach($users as $user)
				{
					$allFriends[] = $user['id'];
					if( array_key_exists('installed', $user) )
					{
						if( $user['installed'] == 1 )
						{
							$friendsWithApp[] = $user['id'];
						}
					}
				}

				echo "<p>Access token = ".$this->facebook->getAccessToken()."</p><p> Printing friends with the bnb app!</p>";
				$rower = 0;
				echo "<table border=\"1\">";
				foreach($friendsWithApp as $key => $fren)
				{
					echo ($rower === 0)? '<tr>': '';
					echo '<td><img src="https://graph.facebook.com/'.$fren.'/picture?width=75&height=75"/>'.$fren.'</td>';
					echo ($rower === 4)? '</tr>': '';
					$rower = ($rower === 4)? 0: $rower+1;
				}
				echo "</table>";

				echo "<p> Printing friends with the bnb app! </p>";
				/*
				*/
			}
			catch (FacebookApiException $e)
			{
				log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
				log_message('INFO', 'no-one is logged-in');
				error_log($e);
				$data['user'] = null;
			}

			try
			{
				// Proceed knowing you have a logged in user who's authenticated.
				$userProfile = $this->facebook->api('/me/friends?fields=installed');
				log_message('INFO', 'Someone is probably logged-in');
				//echo "<pre>".print_r($userProfile, TRUE)."</pre>";
				log_message('INFO', 'user_profile = '.print_r($userProfile, TRUE));
				$users = $userProfile['data'];
				$allFriends = array();
				$friendsWithApp = array();
				
				// compute all friends with app
				foreach($users as $user)
				{
					$allFriends[] = $user['id'];
					if( array_key_exists('installed', $user) )
					{
						if( $user['installed'] == 1 )
						{
							$friendsWithApp[] = $user['id'];
						}
					}
				}
				$this->load->model('fb_model');

				log_message('INFO', "Access token = ".$this->facebook->getAccessToken()."\r\nPrinting friends with the bnb app!</p>\r\n".print_r($friendsWithApp, TRUE));
				if(count($friendsWithApp) > 0)
				{
					$bnbFriends = $this->fb_model->fbFriendsToBNBUsers($friendsWithApp);
					if($bnbFriends !== NULL)
					{
						$this->load->model('rapiv1/profile_model', 'profile_model');
						foreach($bnbFriends as $bnbFriend) // make the new user follow every fb friend on BNB
						{
							$this->profile_model->joinFollow('11801', $bnbFriend->userID, TRUE);
						}

						/*foreach($bnbFriends as $bnbFriend) // make every fb friend on BNB follow the new user
						{
							$this->profile_model->joinFollow($bnbFriend->userID, '11801', FALSE);
						}*/
					}
				}
			}
			catch (FacebookApiException $e)
			{
				log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
				log_message('INFO', 'no-one is logged-in');
				error_log($e);
				$data['user'] = null;
			}
		}
		// Login or logout url will be needed depending on current user state.
		if($data['user'])
		{
			$params["next"] = site_url("sync/logout");
			$data['logoutUrl'] = $this->facebook->getLogoutUrl($params);
		}
		else
		{
			$params = array();
			$params["scope"] = "email,user_birthday,user_about_me,publish_actions";
			$params['scope'] .= ",user_friends,user_likes,user_subscriptions,friends_likes,friends_subscriptions,create_note,publish_stream,share_item,xmpp_login,manage_notifications";
			$params["redirect_uri"] = base_url()."index.php/fbLogin/testAppFriends";
			//$params["display"] = "popup";
			$data['loginUrl'] = $this->facebook->getLoginUrl($params);
			redirect($data['loginUrl']);
		}
		
		log_message('INFO', 'data = '.print_r($data, TRUE));
		//$this->load->view('fbLogin', $data);
		$data['user_profile'] = $userProfile;
		//$this->load->view('fbLogin2', $data);
	}

	public function notify()
	{
		$fbAppIDLive = '394741787279624';
		$fbAppSecretLive = '48a073a1b1e78e2b35a88610bace7f92';

		$fbConfig = array('appId' => $fbAppIDLive, 'secret' => $fbAppSecretLive);
		$this->load->library('facebook', $fbConfig);
		log_message('INFO', 'reading CI fb config');
		log_message('INFO', 'FB-APP-ID: '.$fbAppIDLive.', FB-APP-SECRET: '.$fbAppSecretLive);

		echo "<p>Access token = ".$this->facebook->getAccessToken()."</p>";

		$data = array
					(
					    'href'=> 'https://apps.facebook.com/bnbbuynbrag/',
					    'access_token'=> $this->facebook->getAccessToken(),
					    'template'=> 'test'
					);
		echo "<p> Printing data inside \$data for fb notification request !</p>";
		echo "<pre>".print_r($data, TRUE)."</pre>";
		try
		{
			$sendnotification = $this->facebook->api('/707544199/notifications', 'POST', $data);
		}
		catch(FacebookApiException $e)
		{
			log_message('INFO', 'FACEBOOKAPIEXCEPTION OCCURRED');
			log_message('INFO', 'no-one is logged-in');
			error_log($e);
			$data['user'] = null;
		}
		echo "<p> Printing data inside returned by fb after notification request !</p>";
		echo "<pre>".print_r($sendnotification, TRUE)."</pre>";
	}
}
?>
