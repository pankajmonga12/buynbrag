<?php
class Email_test extends CI_Controller
{
	function index()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->library('email');
		$this->email->from('talktous@buynbrag.com', 'Buy N Brag');
		$this->email->to('shammishailaj@gmail.com');
		$this->email->cc('sam@corblimey.org');
		$this->email->bcc('bnb-email-test-bcc@corblimey.org');
		$this->email->subject('Email Test from linux live server');
		$this->email->message('Testing the email class.');
		$this->email->attach('/var/www/bnb_live/invoice/03bca34fa78c15a1/buyer_invoice_order_91.pdf');
		$this->email->send();
		echo $this->email->print_debugger();
	}
}

?>
