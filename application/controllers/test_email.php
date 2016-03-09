<?php
class test_email extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		log_message('INFO', 'test_email/index fired. loading email library');
		$this->load->library('email');
		//$this->email->print_debugger();
		/*
		We don't need the following line as we have already set up this
		parameter in /system/libraries/Email.php
		$this->email->set_newline("\r\n");
		*/
		log_message('INFO', 'setting "from" field');
		$this->email->from('support@buynbrag.com', 'Test email');

		log_message('INFO', 'setting "to" field');
		$this->email->to('sam@buynbrag.com');

		log_message('INFO', 'setting "subject" field');
		$this->email->subject('Email testing script!');

		log_message('INFO', 'setting "message" field');
		$this->email->message('It\'s working. Great!');

		log_message('INFO', 'sending email now');

		if ($this->email->send())
		{
			log_message('INFO', 'Your email was sent, successfully.');
			echo 'Your email was sent, successfully.';
			echo "<p>", $this->email->print_debugger(), "</p>";
			show_error($this->email->print_debugger());
		}
		else
		{
			log_message('INFO', 'Unable to send mail. debug is: '.print_r($this->email->print_debugger(), TRUE) );
			show_error($this->email->print_debugger());
		}
	}
}
?>
