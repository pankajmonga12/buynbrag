<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized!');
class Tester extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		// function to login as any user
		$this->load->library('email');
		$this->email->from('support@buynbrag.com', 'BuynBrag');
		$this->email->to($to);
		$this->email->subject("BuynBrag OTP");

		$msg = $this->load->view('emailers/followingMail', $data, true);

		$this->email->message($msg);
		$this->email->set_newline("\r\n");

		if($this->email->send())
		{
		   log_message('INFO', " Successfully SENT following MAIl FOR THE USER WITH ID : ".$userID);
		}
		else
		{
		   log_message('INFO', " Error sending following MAIl FOR THE USER WITH ID : ".$userID);
		}
	}
}
?>