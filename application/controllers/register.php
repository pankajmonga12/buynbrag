<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		
		
		$this->load->model('login_model');
		$this->load->helper('html');
		$this->load->library('javascript');
		$this->load->helper(array('form'));
		
		
	}
	public function index()
	{
		redirect(base_url());
	    /*if(isset($_POST['submit']))
		{
			$data['msg']="";
		    $fname=$this->input->post('fname');
			$lname=$this->input->post('lname');
			$mail=$this->input->post('emailid');
	        $pwd=$this->input->post('password');
			$fullname=$fname.$lname;
			
		    $details=array(
			              'password'=>md5($this->input->post('password')),
			             
						 'email'=>$this->input->post('emailid'),
						 'full_name'=>$fullname
						 );
		    $this->login_model->register($details);
		     
			$data['msg']="User Successfully Registered";
		}
		$this->load->view('register',$data);*/
	}
}
?>