<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitterlogin extends CI_Controller
{
	public $isConnected = FALSE;
	public $twUserID = NULL;
	public $twScreenName = NULL;
	public $twLogOutLink = NULL;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("async_model");
		$this->load->library('twconnect');
		$twSessionData = $this->session->userdata('tw_access_token');
		if($twSessionData !== FALSE)
		{
			$this->isConnected = TRUE;
			$this->twUserID = $twSessionData["user_id"];
			$this->twScreenName = $twSessionData["screen_name"];
			$this->twLogOutLink = base_url()."twitterLogin/logout";
		}
	}
	
	/* show link to connect to Twitter */
	public function index()
	{
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN["status"] === TRUE)
		{
			$this->load->library('twconnect');
			$responseData = array();
			$twSessionData = $this->session->userdata('tw_access_token');
			if($twSessionData !== FALSE)
			{
				$responseData["twUserID"] = $twSessionData["user_id"];
				$responseData["twScreenName"] = $twSessionData["screen_name"];
				$responseData["twLogOutLink"] = base_url()."twitterLogin/logout";
				$this->success();
			}
			else
			{
				$this->redirect(); // connect to twitter
			}
		}
		else
		{
			echo "<p>You are not logged-in. <a href=\"/login\">Click here</a> to login in order to invite your friends</p>";
		}
	}
	
	public function isConnected()
	{
		$responseData = array();
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN["status"] === TRUE)
		{
			log_message('INFO', 'inside twitterLogin/isConnected. Now switching-on error reporting');
			error_reporting(0);
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			$responseData["isConnected"] = $this->isConnected;
			$tresponse = json_encode($responseData, JSON_FORCE_OBJECT);
			log_message('INFO', "\$responseData = ".print_r($tresponse, TRUE));
			
			$twSessionData = $this->session->userdata('tw_access_token');
			if($twSessionData !== FALSE)
			{
				log_message('INFO', "\$twSessionData is TRUE");
				$responseData["twUserID"] = $twSessionData["user_id"];
				$responseData["twScreenName"] = $twSessionData["screen_name"];
				$responseData["twLogOutLink"] = base_url()."twitterLogin/logout";
			}
			log_message('INFO', "\$responseData = ".print_r($responseData, TRUE));
		}
		else
		{
			$responseData["isLoggedIN"] = FALSE;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message('INFO', "\$response = ".print_r($response, TRUE));
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
	
	/* redirect to Twitter for authentication */
	public function redirect()
	{
		/* twredirect() parameter - callback point in your application */
		/* by default the path from config file will be used */
		$ok = $this->twconnect->twredirect('twitterLogin/callback');
		if (!$ok)
		{
			echo 'Could not connect to Twitter. Refresh the page or try again later.';
		}
	}


	/* return point from Twitter */
	/* you have to call $this->twconnect->twprocess_callback() here! */
	public function callback()
	{
		$isLoggedIN = $this->async_model->isLoggedIN();
		$ok = $this->twconnect->twprocess_callback();
		if ( $ok )
		{
			$this->twconnect->twaccount_verify_credentials();
			$currentUserInfo = $this->twconnect->tw_user_info;
			$this->load->model('user_connect');
			$twitterConnectResult = $this->user_connect->twitterConnect($isLoggedIN['uid'], $currentUserInfo->id);
			$twitterConnectResultENC = json_encode($twitterConnectResult, JSON_FORCE_OBJECT);
			?>
			<script type="text/javascript">/*<![CDATA[*/window.opener.twitterSuccess(<?php echo "'".$twitterConnectResultENC."'"; ?>);/*]]>*/</script>
			<?php
			/*$this->success();*/
		}
		else
		{
			?>
			<script type="text/javascript">/*<![CDATA[*/window.opener.twitterFailure();/*]]>*/</script>
			<?php
			/*$this->failure();*/
		}
	}
	/* authentication successful */
	/* it should be a different function from callback */
	/* twconnect library should be re-loaded */
	/* but you can just call this function, not necessarily redirect to it */
	public function success()
	{
		return 0;
		log_message('INFO', "Twitter connect succeded. Reading session data now");
		$responseData = array();
		$twSessionData = $this->session->userdata('tw_access_token');
		if($twSessionData !== FALSE)
		{
			$responseData["twUserID"] = $twSessionData["user_id"];
			$responseData["twScreenName"] = $twSessionData["screen_name"];
			$responseData["twLogOutLink"] = base_url()."twitterLogin/logout";
		}
		else
		{
			log_message('INFO', "FAILED! to read twconnect session data");
		}
		// saves Twitter user information to $this->twconnect->tw_user_info
		// twaccount_verify_credentials returns the same information
		$this->twconnect->twaccount_verify_credentials();
		
		$currentUserInfo = $this->twconnect->tw_user_info;
		
		echo '<hr>Current User Info<hr><pre>'; print_r($currentUserInfo); echo "</pre>";
		
		$friendsData = $this->twconnect->tw_get('friends/ids', array("user_id" => $currentUserInfo->id));
		$followersData = $this->twconnect->tw_get('followers/ids', array("user_id" => $currentUserInfo->id));
		
		echo '<hr>Friends<hr><pre>'; print_r($friendsData); echo "</pre>";
		echo '<hr>Followers<hr><pre>'; print_r($followersData); echo "</pre>";
	}
	
	public function followers($cursor = -1)
	{
		log_message("INFO", "inside twitterLogin/followers");
		$twSessionData = $this->session->userdata('tw_access_token');
		$responseData = array();
		if($twSessionData !== FALSE)
		{
			$responseData["twUserID"] = $twSessionData["user_id"];
			$responseData["twScreenName"] = $twSessionData["screen_name"];
			$responseData["twLogOutLink"] = base_url()."twitterLogin/logout";
			$followersData = $this->twconnect->tw_get('followers/list', array("user_id" => $twSessionData["user_id"], "cursor" => $cursor));
			log_message("INFO", "\$followersData = ".print_r($followersData, TRUE));
			$users = NULL;
			if(is_array($followersData->users))
			{
				$users = array();
				$i = 0;
				foreach($followersData->users as $userData)
				{
					$users[$i]["id"] = $userData->id;
					$users[$i]["id_str"] = $userData->id_str;
					$users[$i]["name"] = $userData->name;
					$users[$i]["screenName"] = $userData->screen_name;
					$users[$i]["profile_image_url"] = $userData->profile_image_url;
					$users[$i]["profile_image_url_https"] = $userData->profile_image_url_https;
					$i++;
				}
			}
			$responseData["users"] = $users;
			$responseData["next_cursor"] = $followersData->next_cursor;
			$responseData["next_cursor_str"] = $followersData->next_cursor_str;
			$responseData["previous_cursor"] = $followersData->previous_cursor;
			$responseData["previous_cursor_str"] = $followersData->previous_cursor_str;
			
			$response = json_encode($responseData, JSON_FORCE_OBJECT);
			$this->output->set_content_type("application/json");
			$this->output->set_output($response);
		}
		
	}
	
	public function friends($cursor = -1)
	{
		log_message("INFO", "inside twitterLogin/friends");
		$twSessionData = $this->session->userdata('tw_access_token');
		$responseData = array();
		if($twSessionData !== FALSE)
		{
			$responseData["twUserID"] = $twSessionData["user_id"];
			$responseData["twScreenName"] = $twSessionData["screen_name"];
			$responseData["twLogOutLink"] = base_url()."twitterLogin/logout";
			$friendsData = $this->twconnect->tw_get('friends/list', array("user_id" => $twSessionData["user_id"], "cursor" => $cursor));
			log_message("INFO", "\$friendsData = ".print_r($friendsData, TRUE));
			$users = NULL;
			if(is_array($followersData->users))
			{
				$users = array();
				$i = 0;
				foreach($friendsData->users as $userData)
				{
					$users[$i]["id"] = $userData->id;
					$users[$i]["id_str"] = $userData->id_str;
					$users[$i]["name"] = $userData->name;
					$users[$i]["screenName"] = $userData->screen_name;
					$users[$i]["profile_image_url"] = $userData->profile_image_url;
					$users[$i]["profile_image_url_https"] = $userData->profile_image_url_https;
					$i++;
				}
			}
			$responseData["users"] = $users;
			$responseData["next_cursor"] = $friendsData->next_cursor;
			$responseData["next_cursor_str"] = $friendsData->next_cursor_str;
			$responseData["previous_cursor"] = $friendsData->previous_cursor;
			$responseData["previous_cursor_str"] = $friendsData->previous_cursor_str;
			
			$response = json_encode($responseData, JSON_FORCE_OBJECT);
			$this->output->set_content_type("application/json");
			$this->output->set_output($response);
		}
		
	}
	
	public function sendMessage()
	{
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN["status"] === TRUE && $this->isConnected === TRUE)
		{
			$followerIDs = ($this->input->post("followerIDs") !== FALSE) ? $this->input->post("followerIDs") : NULL;
			$followerIDsCount = count($followerIDs);
			$responseData = array();
			$responseData["followersCount"] = $followerIDsCount;
			$i = 0;
			log_message("INFO", "\$followerIDs = ".print_r($followerIDs, TRUE));
			if($followerIDsCount > 0)
			{
				$this->load->model("invite_model");
				foreach($followerIDs as $followerID)
				{
					$responseData["invitationStatuses"][$i]["followerID"] = $followerID;
					$tInvRetVal = $this->invite_model->saveInvite($isLoggedIN["uid"], $followerID, 2);
					$responseData["invitationStatuses"][$i]["status"] = $tInvRetVal;
					if($tInvRetVal["savedInvite"] === TRUE)
					{
						$msg = "Join me on BuynBrag. Discover amazing products, everyday ! http://buynbrag.com/invite/accept/".$tInvRetVal["inviteID"]."/".$tInvRetVal["hash"];
						$dataAftePost = $this->twconnect->tw_post('direct_messages/new', array("user_id" => $followerID, "text" => $msg));
						log_message("INFO", "Data from twitter after ".print_r($dataAftePost, TRUE));
						echo "<pre>", print_r($dataAftePost, TRUE), "</pre>";
					}
					$i++;
				}
			}
		}
		echo "<pre>", print_r($responseData, TRUE), "</pre>";
		/*$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);*/
	}
	
	public function lookup()
	{
		$followersData = $this->twconnect->tw_get('followers/ids', array("user_id" => $currentUserInfo->id));
	}
	
	/* authentication un-successful */
	public function failure()
	{
		return 0;
		echo '<p>Twitter connect failed</p>';
		echo '<p><a href="' . base_url() . 'twitterLogin/logout">Try again!</a></p>';
	}

	/* clear session */
	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}