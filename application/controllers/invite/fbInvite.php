<?php
class Fbinvite extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getFriends()
	{
		$this->load->model('async_model');
		$fbLoginStatus = $this->async_model->isLoggedINViaFacebook();
		print "<pre>";
		print_r(json_encode($fbLoginStatus, JSON_FORCE_OBJECT));
		print "</pre>";
		if($fbLoginStatus["isLoggedINViaFacebook"] === TRUE && $fbLoginStatus["isLoggedIN"] === TRUE)
		{
			$fbAppIDLive = '394741787279624';
			$fbAppSecretLive = '48a073a1b1e78e2b35a88610bace7f92';
			
			$fbAppIDTest = '454156234672558';
			$fbAppSecretTest = '5ef93f05dc0b5fed519532751b379cd7';
			
			$fbAppID = $fbAppIDLive;
			$fbAppSecret = $fbAppSecretLive;
			
			$fbConfig = array('appId' => $fbAppID, 'secret' => $fbAppSecret);
			$this->load->library('facebook', $fbConfig);
			log_message('INFO', 'async_model/isLoggedINViaFacebook: reading CI fb config');
			//$this->config->load('facebook');
			//$fbConfig = $this->config->item('facebook');
			log_message('INFO', 'async_model/isLoggedINViaFacebook: FB-APP-ID: '.$fbAppID.', FB-APP-SECRET: '.$fbAppSecret);
			$friends = $this->facebook->api('/me/friends?fields=installed&limit=5000');
			print_r(json_encode($friends, JSON_FORCE_OBJECT));
			if(isset($friends["paging"]))
			{
				print "<p>PARSE URL RESULT: </p><pre>";
				print_r(parse_url($friends["paging"]["next"], PHP_URL_QUERY));
				print "</pre>";
			}
		}
	}
	
	public function save()
	{
		$this->load->model('async_model');
		$fbLoginStatus = $this->async_model->isLoggedINViaFacebook();
		if($fbLoginStatus["isLoggedINViaFacebook"] === TRUE && $fbLoginStatus["isLoggedIN"] === TRUE)
		{
			$this->load->model('invite_model');
			$fbIDs = ($this->input->post('fbIDs') !== FALSE)? $this->input->post('fbIDs') : NULL;
			if(!is_null($fbIDs))
			{
				print_r($fbIDs);
			}
		}
	}
}
?>