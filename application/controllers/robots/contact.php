<?php
if ( ! defined ( 'BASEPATH' ) )
{
	header("HTTP/1.0 403 Forbidden");
	exit('403 Unauthorized');
}

class Contact extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
	}

	public function index()
	{
		$agent = "";
		if ($this->agent->is_browser())
		{
		    $agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
		    $agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		    $agent = $this->agent->mobile();
		}
		else
		{
		    $agent = 'Unidentified User Agent';
		}

		log_message( 'INFO', 'AGENT ==== '.$agent );

		log_message( 'INFO', 'Platform ==== '.$this->agent->platform() ); // Platform info (Windows, Linux, Mac, etc.)
		
		if( $this->agent->is_robot() )
		{
			$this->load->view('robots/contact');
		}
		else
		{
			$userID = ($this->session->userdata('id'))? $this->session->userdata('id'): NULL;
			$isLoggedIN = ($this->session->userdata('logged_in'))? $this->session->userdata('logged_in'): NULL;
			if( $isLoggedIN )
			{
				$this->load->model( 'async_model' );
				$data['userDetails'] = $this->async_model->userDetails( $userID );
				$data['headerData'] = $this->async_model->headerData( $userID );
				$this->load->view("dist/index", $data);
			}
			else
			{
				$this->load->view("dist/index");
			}
		}
	}
}