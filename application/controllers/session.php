<?php
class Session extends CI_Controller
{
	private $userid = "";

	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();
		$this->userid = 1;
		// Your own constructor code
		$this->load->model('morder');
		$this->load->model('cartdb');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('javascript');
		$this->load->library('session');
		$data['base_url'] = base_url();
		//$this->load->library('jquery');


	}

	function creates($uid)
	{

		$userid = $uid;
		$data = array('id' => $userid, 'logged_in' => TRUE);
		$this->session->set_userdata($data);

	}


	function notlogin()
	{
		$this->load->view('login');
	}

	function destroys($uid)
	{

		$userid = $uid;
		$data = array('id' => $userid, 'logged_in' => TRUE);
		$this->session->unset_userdata($data);
		redirect(base_url('index.php/user'));
	}


}

?>