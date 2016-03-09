<?php
//session_start();
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
	}

	function index()
	{
		log_message('INFO', 'Start a  request===================================================================================================================');
		//$data['base_url'] = base_url();
		//$this->load->view('landing_page_new',$data);
		/* WWW FIX BY SHAMMI SHAILAJ */
		$baseURL = base_url();
		$this->load->model('async_model');
		$currentPageURL = $this->async_model->currentPageURL();
		log_message('INFO', 'Current page URL = '.print_r($currentPageURL, TRUE));
		log_message('INFO', 'baseURL = '.$baseURL);
		/*if(stripos($currentPageURL, 'www.', 0) !== FALSE)
		{
			$search = "www.";
			$replaceWith = "";
			$searchInside = $currentPageURL;
			$numberOfTimesToReplace = 1;
			$redirectURL = str_ireplace($search, $replaceWith, $searchInside, $numberOfTimesToReplace);
			log_message('INFO', 'Redirecting from '.$currentPageURL.' to '.$redirectURL.' for angular compatibility until Bimal finds a fix!');
			redirect($redirectURL);
		}*/
		/* END SECTION WWW FIX BY SHAMMI SHAILAJ */
		$subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2);
		$subdomain = $subdomain_arr[0];
		$redir_id = $this->categoriesdb->sub_domain($subdomain);
		if (!empty($redir_id)) {
			log_message('Info', 'A Seller is trying to login from the Ip: ' . $this->input->ip_address() . '.');
			$url = base_url("index.php/order/store_page/" . $redir_id[0]->store_id);
			redirect($url, 'Location');
		} elseif ($subdomain == "seller") {
			log_message('Info', 'A Seller is trying to login from the Ip: ' . $this->input->ip_address() . '.');
			$url = base_url('index.php/login/seller');
			redirect($url, 'Location');
		} else {
			log_message('Info', 'A User-Buyer is trying to login from the Ip: ' . $this->input->ip_address() . '.');
			//$url = base_url('user_info/homepage_afterlogin');
			$url = base_url('homepage');
			redirect($url, 'Location');
		}
	}

	function facebook($def_url_controller = '', $def_url_function = '', $def_url_param1 = '', $def_url_param2 = '')
	{
		$this->load->model('fb_model');
		$this->load->library('fb_connect');

		if (!$this->fb_connect->user_id)
		{
			log_message('Info', 'User is not logged in properly via fb or fbuid is not fetched properly! ' . $this->input->ip_address() . '.');
			//redirect(base_url('user_info/homepage_afterlogin'));
			redirect(base_url('homepage'));
		}
		else
		{
			//Hanlde user logged in, you can update your session with the available data
			$fb_uid = $this->fb_connect->user_id;
			log_message('Info', 'User is logged in via fb with fbuid: ' . $fb_uid . ' and Ip:' . $this->input->ip_address() . '.');
			$fb_data['fb_uid'] = $this->fb_connect->user_id;
			$fb_data['fb_usr'] = $this->fb_connect->user;
			//$this->fb_model->insert_user($fb_data);-> this insert the data fetched from fb only if user is logging in for 1st time
			//and will return his bnb user id. Also if the user is logging in for the 1st time $user_exists = 0 else it will be 1.
			//$user_exists is used to Invite friends from fb, create a seperate directory for the user inside assets/images/user/.
			//The above actions happens only for the 1st time, as soon as the user sucessfully signup!
			if ($fb_data['fb_usr']['email'] != 1)
			{
				log_message('Info', 'Checking if User with fbuid: ' . $fb_uid . ' and Ip:' . $this->input->ip_address() . ' is already existing in db.');
				$user = $this->fb_model->insert_user($fb_data);
			}
			else
			{
				log_message('Info', 'User is not logged in properly via fb or fbuser details are not fetched properly! ' . $this->input->ip_address() . '.');
				if (!empty($def_url_controller))
					$def_url = 'user/loginByFacebook/' . $def_url_controller . '/' . $def_url_function . '/' . $def_url_param1 . '/' . $def_url_param2;
				else
					$def_url = 'user/loginByFacebook';
				redirect(site_url($def_url));
			}
			$userid = $user['0']->user_id;
			$user_exists = $user['user_exists'];
			log_message('Info', 'Started session creation for Ip: ' . $this->input->ip_address() . " and user_id: $userid.");
			//Session creation for Users-buyer
			$sess = array('id' => $userid, 'logged_in' => TRUE);
			$this->session->set_userdata($sess); // CI Session
			//end of session creation
			log_message('Info', "Completed session creation for Ip: " . $this->input->ip_address() . " and user_id: $userid.");
			if ($user_exists == 0 || $user_exists == 2) // User is entering the site for the first time.
			{
				log_message('Info', "User with user_id=$userid and Ip: " . $this->input->ip_address() . " is logging into the site for the first time using facebook.");
				$this->profile_pic($fb_uid, $userid);

				$fb_friends = $this->fb_connect->friends;
				if (isset($fb_friends['data']))
				{
					log_message('Info', "FFF Logic is beign called for the user with user_id=$userid.");
					$base_url = base_url();
					$newbie = $this->fb_model->fetch_user($userid);
					$newbie_name = $newbie[0]->full_name;
					$newbie_id = $newbie[0]->user_id;
					$to_email = '';
					foreach ($fb_friends['data'] as $fb_users)
					{
						$friend_id = $this->fb_model->insert_friends($userid, $fb_users['id']);
						if ($friend_id != 0)
						{
							$to_user = $this->fb_model->fetch_user($friend_id);
							$to_email = $to_user[0]->email . "," . $to_email;
						}
					}
					$to_email = 'shammishailaj@gmail.com' . "," . $to_email;
					include 'mail_3.php';
					$this->load->library('email');
					$this->email->from('support@buynbrag.com', 'BuynBrag');
					$this->email->bcc($to_email);
					$this->email->subject($newbie_name . " added you as a friend on BuynBrag!");
					$this->email->message($newbie_message);
					$this->email->set_newline("\r\n");
					if ($this->email->send())
					{
						log_message('Info', "FFF mail is succesfully sent for the friends of user with user_id=$userid.");
					}
					else
					{
						log_message('Info', "Sending FFF mail failed for the friends of user with user_id=$userid.");
					}
				}

			}

			//FOR HEADER
			$data['base_url'] = base_url();

			//Fetches all the filled details from db
			$data['user'] = $this->fb_model->fetch_user($userid);

			if ($user_exists == 0 || $user_exists == 2)
			{
				log_message('Info', "User with user_id=$userid is logging in for the first time. His Image is being resized.");
				//if user is logging in for the 1st time he'll be re-directed to Customized Invite friedns page and
				//will be redirected to homepage after login.
				$this->profile_pic($fb_uid, $userid);
				$red_url = site_url("user/user_pic1/$userid");
				//$url = "http://www.facebook.com/dialog/apprequests?app_id=$app_id&message=Welcome_to_BuynBrag&redirect_uri=$red_url";
				redirect($red_url, 'location');
			}
			else
			{
				if (!empty($def_url_controller))
				{
					//$def_url = 'user_info/homepage_afterlogin/' . $def_url_controller . '/' . $def_url_function . '/' . $def_url_param1 . '/' . $def_url_param2;
					$def_url = 'homepage/index/' . $def_url_controller . '/' . $def_url_function . '/' . $def_url_param1 . '/' . $def_url_param2;
				}
				else
				{
					//$def_url = 'user_info/homepage_afterlogin';
					$def_url = 'homepage';
				}
				log_message('Info', "User with user_id=$userid is an existing user. He is being redirected to $def_url.");
				redirect(site_url("$def_url"));
			}
		}
	}


	function loginByFacebook($red_uri_controller = 'user', $red_uri_function = 'facebook', $red_uri_param1 = '', $red_uri_param2 = '')
	{
		$this->load->model('fb_model');
		$this->load->library('fb_connect');
		if ($red_uri_controller == 'user' && $red_uri_function == 'facebook')
			$redirect_uri = $red_uri_controller . '/' . $red_uri_function . '/' . $red_uri_param1 . '/' . $red_uri_param2;
		else
			$redirect_uri = 'user/facebook/' . $red_uri_controller . '/' . $red_uri_function . '/' . $red_uri_param1 . '/' . $red_uri_param2;
		$param['redirect_uri'] = site_url($redirect_uri);
		$param['scope'] = 'email,user_birthday,user_about_me,publish_stream';
		log_message('Info', "User with IP addres: " . $this->input->ip_address() . " is being redirected to Fb via Graph Api with following params: " . $param['redirect_uri'] . ".");
		log_message('Info', "User with IP addres: " . $this->input->ip_address() . " Redirect_uri: " . $param['redirect_uri'] . ".");
		log_message('Info', "User with IP addres: " . $this->input->ip_address() . " scope: " . $param['scope'] . ".");
		redirect($this->fb_connect->getLoginUrl($param));
	}

	function user_pic1($userid)
	{
		$userid = $this->session->userdata('id');
		$img1 = $userid;
		$wt1 = '40';
		$ht1 = '40';
		$this->pic_resize($img1, $wt1, $ht1, $userid);
		$url = "user/user_pic2/" . $userid;
		redirect(base_url($url), 'location');
	}

	function defaultdb($userid)
	{
		$this->load->model('fb_model');
		$this->fb_model->deffancy($userid);
		$url = "user/user_pic2/" . $userid;
		redirect(base_url($url), 'location');
	}

	function user_pic2($userid)
	{
		$userid = $this->session->userdata('id');
		$img2 = $userid . '_large';
		$wt2 = '156';
		$ht2 = '156';
		$this->pic_resize($img2, $wt2, $ht2, $userid);
		//$url = "user/invite_people";
		$url = "user_info/homepage_afterlogin";
		redirect(site_url($url), 'location');
	}

	function profile_pic($fbid, $userid) //100003550422337 http://graph.facebook.com/100003550422337/picture?type=large
	{
		log_message('Info', "Function Profile pic has been called for the user with user_id=$userid.");
		$path = "assets/images/users/$userid";
		if (!file_exists($path)) {
			if (mkdir($path, 0777)) {
				log_message('Info', "User folder has been created for the user with user_id=$userid.");
				$img1 = file_get_contents('http://graph.facebook.com/' . $fbid . '/picture?type=large');
				$img2 = file_get_contents('http://graph.facebook.com/' . $fbid . '/picture');
				$file1 = "assets/images/users/$userid/" . $userid . '_large.jpg';
				$file2 = "assets/images/users/$userid/" . $userid . '.jpg';
				file_put_contents($file1, $img1);
				file_put_contents($file2, $img2);
				log_message('Info', "Created folder for the user with user_id=$userid.");
				return 1;
			} else {
				log_message('Info', "Unable to create folder for the user with user_id=$userid.");
				return 0;
			}
		} else {
			log_message('Info', "Folder for the user with user_id=$userid already exists in the server, so overwriting the existing images.");
			$img1 = file_get_contents('http://graph.facebook.com/' . $fbid . '/picture?type=large');
			$img2 = file_get_contents('http://graph.facebook.com/' . $fbid . '/picture');
			$file1 = "assets/images/users/$userid/" . $userid . '_large.jpg';
			$file2 = "assets/images/users/$userid/" . $userid . '.jpg';
			file_put_contents($file1, $img1);
			file_put_contents($file2, $img2);
			log_message('Info', "Overwritten the existing user image for user_id=$userid.");
			return 1;
		}
	}

	function pic_resize($img, $wt, $ht, $uid)
	{
		log_message('Info', "Started Resizing image for the user with user_id=$uid, dimension: Width = $wt, Height= $ht");
		$config['image_library'] = 'gd2';
		$config['source_image'] = "assets/images/users/$uid/$img.jpg";
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = '_' . $wt . 'x' . $ht;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $wt;
		$config['height'] = $ht;
		$config['new_image'] = "$uid.jpg";
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		if (!$this->image_lib->resize()) {
			log_message('Errors', "The following error occured while resizing image for the user with user_id=$uid." . $this->image_lib->display_errors());
			return 0;
		}
		$image_file_to_delete = "assets/images/users/$uid/$img.jpg";
		//chmod($image_file_to_delete, 0666);
		//unlink($image_file_to_delete);
		log_message('Info', "Successfully Resized image for the user with user_id=$uid, dimension: Width = $wt, Height= $ht");
		return 1;
	}

	function invite_people()
	{
		include 'header_for_controller.php';
		$this->load->library('fb_connect');
		$this->config->load('facebook', TRUE);
		$config = $this->config->item('facebook');
		$data['app_id'] = $config['appId'];
		$data['base_url'] = base_url();
		$fb_friends = $this->fb_connect->friends;
		$min = 0;
		$max = count($fb_friends['data']) - 1;
		if ((int)count($fb_friends['data']) > 50)
			$quantity = 50;
		else
			$quantity = (int)count($fb_friends['data']);
		$numbers = range($min, $max);
		shuffle($numbers);
		$data['keys'] = array_slice($numbers, 0, $quantity);
		$data['friends'] = $fb_friends['data'];
		//echo '<img src="http://graph.facebook.com/'.$data['friends'][816]['id'].'/picture?type=large" height="96" width="96" alt="profile_pic"/>';
		//echo '<img src="http://graph.facebook.com/'.$data['friends'][0]['id'].'/picture?type=large" height="96" width="96" alt="profile_pic"/>';
		$this->load->view('invite_people', $data);
	}

	function logout()
	{
		log_message('Info', "Logging out the user with user_id= " . $this->session->userdata('id') . " and Ip address: " . $this->input->ip_address() . '.');
		$this->load->library('fb_connect');
		$data = array('id' => '', 'logged_in' => FALSE);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		log_message('Info', "Logging out the user only from bnb as he is already logged out from fb/Loggedin via email.");
		log_message('Info', "User with Ip address: " . $this->input->ip_address() . ' has been successfully logged out and is being redirected to default controller.');
		redirect(base_url());
	}

	public function mail_discover($count, $start)
	{
		$this->load->model('cartdb');
		$email = $this->cartdb->emailblast($count, $start);
		for ($i = 0; $i < count($email); $i++) {
			$name = $email[$i]->full_name;
			include 'discover_mail.php';
			$this->load->library('email');
			$this->email->from('support@buynbrag.com', 'BuynBrag');
			$this->email->to($email[$i]->email);
			$this->email->subject("Christmas Cheer at Flat 50% OFF");
			$this->email->message($msg);
			$this->email->set_newline("\r\n");
			if ($this->email->send())
				echo "<br>Success : " . $email[$i]->email;
			else
				echo "<br>Failure : " . $email[$i]->email;
		}

	}

	protected function login($uid)
	{
		$userid = $uid;
		$data = array('id' => $userid, 'logged_in' => TRUE);
		$this->session->set_userdata($data);
		redirect(base_url('user_info/homepage_afterlogin'));
	}

	function maintain()
	{
		$data['base_url'] = base_url();
		$this->load->view('fff', $data);
	}
}
?>
