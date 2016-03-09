<?php

class Error extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');

	}

	function notavailable()
	{
		$data['base_url'] = base_url();
		$this->output->set_status_header('404');
		$this->output->set_header("HTTP/1.1 404 Not Found");
		$this->load->view('error_404', $data);
	}

	function error_pin()
	{
		$data['base_url'] = base_url();
		$this->load->view('error_pin', $data);
	}

}

?>