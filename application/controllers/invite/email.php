<?php if( !defined('BASEPATH') ) exit('403 Unauthorized');
class Email extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		log_message("INFO", "invite/email fired");
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		$responseData = array();
		$responseData[] = array("loggedIN" => $isLoggedIN['status']);
		switch($isLoggedIN['status'])
		{
			case TRUE: $emailToInvite = ($this->input->post('inviteeEmailAddress') !== FALSE)? $this->input->post('inviteeEmailAddress'): NULL;
					 $this->load->model('invite_model');
					 $inviter = $isLoggedIN['uid'];
					 $inviteeRefID = $emailToInvite;
					 $invitationMedium = 3;
					 log_message("INFO", "invite/email: calling invite_model/saveInvite with \$inviter = ".$inviter." \$inviteeRefID = ".$inviteeRefID." \$invitationMedium = ".$invitationMedium);
					 $responseData[] = $this->invite_model->saveInvite($inviter, $inviteeRefID, $invitationMedium);
					 log_message("INFO", "invite/email: \$responseData = ".print_r($responseData, TRUE));
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message("INFO", "invite/email: \$response = ".print_r($response, TRUE));
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
}
?>