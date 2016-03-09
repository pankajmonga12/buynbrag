<?php if( ! defined ('BASEPATH') ) exit("Direct script access not allowed");
class Sync extends CI_Controller
{
	public function __constructor()
	{
		parent::__constructor();
	}
	
	public function logout($redirectURI = NULL)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access sync/logout');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'Data retrieved from session is userID  = '.$userID.', isLoggedIN = '.$isLoggedIN.', ipAddress = '.$__ip);
		$fbLogOutURL = $this->session->userdata('fbLogOutURL');
		if($fbLogOutURL !== FALSE)
		{
			log_message('INFO', "user was logged-in via facebook. Logging them out from facebook first");
			$this->session->unset_userdata('fbLogOutURL');
			log_message('INFO', "just unset facebook logout url from session. redirecting to the fbLogOutURL now");
			redirect($fbLogOutURL);
		}
		$response = NULL;
		if($userID === FALSE || $isLoggedIN === FALSE)
		{
			log_message('ERROR', 'Nobody is logged-in from the current session and hence can not be logged-out');
			log_message("ERROR", "redirecting them to the homepage");
			redirect(site_url('homepage'));
		}
		else
		{
			log_message('INFO', 'trying to logout user '.$userID.' based on a request from '.$__ip);
			$this->session->unset_userdata('id'); // delete id from session data
			$this->session->unset_userdata('logged_in'); // delete logged_in from session data
			$this->session->unset_userdata('couponid'); // delete any coupon ids from session
			$this->session->unset_userdata('redeemedprice'); // delete redeemedprice associated with the coupon
			$this->session->sess_destroy(); // completely destroy session and all associated data
			log_message('INFO', 'just deleted session data for user '.$userID.'. Will re-read the values to be 100% sure');
			$userID2 = NULL;
			$isLoggedIN2 = NULL;
			$userID2 = $this->session->userdata('id'); // read the user id from session
			$isLoggedIN2 = $this->session->userdata('logged_in'); // check the status of the variable logged_in
			$couponID2 = $this->session->userdata('couponid'); // check the status of the variable 'couponid'
			$redeemedPrice2 = $this->session->userdata('redeemedprice'); // check the status of the variable redeemedprice
			log_message('INFO', 'Logging the coupon data from session');
			log_message('INFO', "CouponID2 = ".$couponID2.", redeemedPrice2 = ".$redeemedPrice2);
			switch($userID2 === FALSE && $isLoggedIN2 === FALSE)
			{
				case TRUE: log_message('INFO', 'session data has been deleted for user '.$userID.' based on a request from '.$__ip.'. The user has been logged-out successfully.');
						 log_message("INFO", "redirecting them to the homepage");
						 switch(is_null($redirectURI))
						 {
							case TRUE: redirect(site_url('homepage'));
								break;
							case FALSE: redirect(urldecode($redirectURI));
						 }
					break;
				case FALSE: log_message('INFO', 'session data could not be deleted for user '.$userID.' based on a request from '.$__ip.'. The user could not be logged-out.');
						  log_message('INFO', 'Dumping CI session '.print_r($this->session->all_userdata(), TRUE) );
						  log_message("INFO", "redirecting them to the homepage");
						  switch(is_null($redirectURI))
						  {
							case TRUE: redirect(site_url('homepage'));
								break;
							case FALSE: redirect(urldecode($redirectURI));
								break;
						  }
					break;
			}
		}
	}
}
?>