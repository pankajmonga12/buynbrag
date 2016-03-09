<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');
class Accept extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($inviteID = NULL, $hash = NULL)
	{
		$data['baseURL'] = base_url();
		$this->load->model("invite_model");
		if(is_null($inviteID) || is_null($hash) || strcmp($inviteID, "") === 0 || strcmp($hash, "") === 0)
		{
			$this->load->view('invite/illegal', $data);
		}
		else
		{
			$inviteValid = $this->invite_model->checkInvite($inviteID, $hash);
			if($inviteValid === TRUE)
			{
				/*
					* check the invitee's invitation medium (1 = facebook, 2 = twitter, 3 = email(default), 4 = referral link(email), 5 = yahoo, 6 = gmail)
					* if medium = 1
					* ---- NEW SCHEME
					* Load the sign-up page and give them 500 ka coupon if they sign-up via facebook else give them nothing
				*/
				$data["baseURL"] = base_url();
				$data["inviteID"] = $inviteID;
				$data["hash"] = $hash;
				$this->load->view('invite/accept', $data);
			}
			else
			{
				$this->load->view('invite/illegal', $data);
			}
		}
	}
	
	public function facebook($inviteID = NULL, $hash = NULL)
	{
		
		log_message('INFO', 'fb sdk accept invite test by shammi shailaj started');
		log_message('INFO', 'current directory is: '.__DIR__);
		
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
				switch($userExists)
				{
					case 1: // existing bnb member. directly log-them-in
						  $bnbUID = $this->fb_model->uid($userProfile["id"]); //  get the bnb user id
						  $bnbUID = $bnbUID[0]->user_id;
						  log_message('INFO', 'fb credentials are fine and the user has already linked their profiles');
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
							case TRUE: log_message('INFO', 'session has been set. user with ID: '.$bnbUID.' has been logged in ');
									 log_message('INFO', 'now redirecting the user to homepage');
									 redirect(site_url('homepage'));
								break;
							case FALSE: log_message('INFO', 'session could not be set for user with ID: '.$bnbUID);
									  log_message("ERROR", "redirecting them to the homepage");
									  redirect(site_url('homepage'));
								break;
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
									 $this->session->set_userdata($sessionData);
									 log_message('INFO', 'just set Session data for '.$bnbUID.' from '.$this->input->ip_address());
									 log_message('INFO', 'now checking whether it has been set or not');
									 $sessionUserID = $this->session->userdata('id');
									 $sessionLoggedIN = $this->session->userdata('logged_in');
									 switch( (strcmp($sessionUserID, $bnbUID) === 0) && $sessionLoggedIN === TRUE )
									 {
										case TRUE: log_message('INFO', 'session has been set. user with ID: '.$bnbUID.' has been logged in ');
												 log_message('INFO', 'now redirecting the user to homepage');
												 redirect(site_url('homepage'));
											break;
										case FALSE: log_message('INFO', 'session could not be set for user with ID: '.$bnbUID);
												  redirect(site_url('homepage'));
											break;
									 }
								break;
							case FALSE: log_message("ERROR", "DB ERROR WHILE LINKING FB ACCOUNT FOR USER: ".$bnbUID);
									  log_message("ERROR", "redirecting them to the homepage");
									  redirect(site_url('homepage'));
								break;
						  }
						break;
					case 0: // new member. create their profile
						   log_message('INFO', 'first time user. creating a new account for them');
						  $newAccountDetails = $this->fb_model->newFBAccount($userProfile);
						  $this->load->model("invite_model");
						  $this->invite_model->acceptInvite($inviteID, $hash, $newAccountDetails["newUID"]);
						  // code to give a 500 Rs discount coupon with one time validity
						  switch($newAccountDetails["result"])
						  {
							case TRUE: $sessionData = array('id' => $newAccountDetails["newUID"], 'logged_in' => TRUE);
									 $this->session->set_userdata($sessionData);
									 log_message('INFO', 'just set Session data for '.$newAccountDetails["newUID"].' from '.$this->input->ip_address());
									 log_message('INFO', 'now checking whether it has been set or not');
									 $sessionUserID = $this->session->userdata('id');
									 $sessionLoggedIN = $this->session->userdata('logged_in');
									 switch( (strcmp($sessionUserID, $newAccountDetails["newUID"]) === 0) && $sessionLoggedIN === TRUE )
									 {
										case TRUE: log_message('INFO', 'session has been set. user with ID: '.$newAccountDetails["newUID"].' has been logged in ');
												 log_message('INFO', 'now redirecting the user to homepage');
												 redirect(site_url('homepage'));
											break;
										case FALSE: log_message('INFO', 'session could not be set for user with ID: '.$newAccountDetails["newUID"]);
												  redirect(site_url('homepage'));
											break;
									 }
								break;
							case FALSE: log_message("ERROR", "DB ERROR WHILE LINKING FB ACCOUNT FOR USER: ".$newAccountDetails["newUID"]." ad FB ID: ".$data["id"]);
									  log_message("ERROR", "redirecting them to the homepage");
									  redirect(site_url('homepage'));
								break;
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
			$params["redirect_uri"] = base_url()."accept/facebook/".$inviteID."/".$hash;
			//$params["display"] = "popup";
			$data['loginUrl'] = $this->facebook->getLoginUrl($params);
			redirect($data['loginUrl']);
		}
		log_message('INFO', 'data = '.print_r($data, TRUE));
	}
	
	public function register($inviteID = NULL, $hash = NULL)
	{
		$temp['email'] = ($this->input->post('signup_email') !== FALSE && strcmp($this->input->post('signup_email'), '') !== 0)? $this->input->post('signup_email'): NULL;
		$temp['fname'] = ($this->input->post('signup_fname') !== FALSE && strcmp($this->input->post('signup_fname'), '') !== 0)? $this->input->post('signup_fname'): NULL;
		$temp['lname'] = ($this->input->post('signup_lname') !== FALSE && strcmp($this->input->post('signup_lname'), '') !== 0)? $this->input->post('signup_lname'): NULL;
		$temp['pw1'] = ($this->input->post('signup_pw1') !== FALSE && strcmp($this->input->post('signup_pw1'), '') !== 0)? $this->input->post('signup_pw1'): NULL;
		$temp['pw2'] = ($this->input->post('signup_pw2') !== FALSE && strcmp($this->input->post('signup_pw2'), '') !== 0)? $this->input->post('signup_pw2'): NULL;
		$temp['gender'] = ($this->input->post('signup_gender') !== FALSE && strcmp($this->input->post('signup_gender'), '') !== 0)? $this->input->post('signup_gender'): NULL;
		$temp['city'] = ($this->input->post('signup_city') !== FALSE && strcmp($this->input->post('signup_city'), '') !== 0)? $this->input->post('signup_city'): NULL;
		$this->load->model("invite_model");
		$accCreateResult = $this->invite_model->createAccount($temp);
		$accCreateResult["acceptInviteResult"] = FALSE;
		if($accCreateResult["accountCreated"] === TRUE)
		{
			$accCreateResult["acceptInviteResult"] = $this->invite_model->acceptInvite($inviteID, $hash, $accCreateResult["newUID"]);
		}
		$response = json_encode($accCreateResult, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
	
	public function referral($referrerID)
	{
		$temp['email'] = ($this->input->post('signup_email') !== FALSE && strcmp($this->input->post('signup_email'), '') !== 0)? $this->input->post('signup_email'): NULL;
		$temp['fname'] = ($this->input->post('signup_fname') !== FALSE && strcmp($this->input->post('signup_fname'), '') !== 0)? $this->input->post('signup_fname'): NULL;
		$temp['lname'] = ($this->input->post('signup_lname') !== FALSE && strcmp($this->input->post('signup_lname'), '') !== 0)? $this->input->post('signup_lname'): NULL;
		$temp['pw1'] = ($this->input->post('signup_pw1') !== FALSE && strcmp($this->input->post('signup_pw1'), '') !== 0)? $this->input->post('signup_pw1'): NULL;
		$temp['pw2'] = ($this->input->post('signup_pw2') !== FALSE && strcmp($this->input->post('signup_pw2'), '') !== 0)? $this->input->post('signup_pw2'): NULL;
		$temp['gender'] = ($this->input->post('signup_gender') !== FALSE && strcmp($this->input->post('signup_gender'), '') !== 0)? $this->input->post('signup_gender'): NULL;
		$temp['city'] = ($this->input->post('signup_city') !== FALSE && strcmp($this->input->post('signup_city'), '') !== 0)? $this->input->post('signup_city'): NULL;
		$this->load->model("invite_model");
		$accCreateResult = $this->invite_model->createAccount($temp);
		$accCreateResult["acceptReferralResult"] = NULL;
		$accCreateResult["acceptReferralResult"] = FALSE;
		if($accCreateResult["accountCreated"] === TRUE)
		{
			$accCreateResult["acceptReferralResult"] = $this->invite_model->acceptReferral($referrerID, $accCreateResult["newUID"]);
		}
		$response = json_encode($accCreateResult, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
	
	public function user()
	{
	}
}
?>