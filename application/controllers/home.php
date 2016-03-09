<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
	}
	
	public function index()
	{
		$this->page();
	}
	
	public function page()
	{
		include "header_for_controller.php";
		$this->load->view('homepage_afterlogin_new', $data);
	}
}
?>