<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');

class People extends CI_Controller
{
	public $userID = NULL;
	public $isLoggedIN = NULL;
	public $isReallyLoggedIN = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->userID = $this->session->userdata('id');
		$this->isLoggedIN = $this->session->userdata('logged_in');
		$this->isReallyLoggedIN = ($this->userID !== FALSE && $this->isLoggedIN !== FALSE && is_numeric($this->userID) && $this->userID > 0 && $this->isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$this->load->model('rapiv1/people_model', 'people_model');
		$this->output->set_content_type('application/json');
	}
	
	public function index($sortBy = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		$currentUserID = $this->userID;
		$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		
		switch( $this->isReallyLoggedIN === TRUE && $this->userID !== NULL && is_numeric( $this->userID ) )
		{
			case TRUE: $responseData['data'] = $this->people_model->getPeopleData( $sortBy, $startFrom, $maxResults, $this->userID );
				break;
		}

		$response = json_encode($responseData);
		$this->output->set_output($response);
	}

	public function favourites( $startFrom = NULL, $maxResults = NULL )
	{
	}
}
?>