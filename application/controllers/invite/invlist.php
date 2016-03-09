<?php if( !defined('BASEPATH') ) exit('403 Unauthorized');
class Invlist extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		$responseData = array();
		$responseData[] = array("loggedIN" => $isLoggedIN['status']);
		switch($isLoggedIN['status'])
		{
			case TRUE: $this->load->model('invite_model');
					 $inviter = $isLoggedIN['uid'];
					 $responseData[] = $this->invite_model->listInvites($inviter);
				break;
		}
		
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
}
?>