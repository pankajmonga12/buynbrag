<?php if ( ! defined( 'BASEPATH' ) ) exit('403 Unauthorized!');
class Dod extends CI_Controller
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
		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE:	$this->load->model('rapiv1/dod_model', 'dodModel');
				break;
		}
		$this->output->set_content_type('application/json');
	}

	public function dods()
	{
		$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		switch( $this->isReallyLoggedIN === TRUE && $this->userID !== NULL && is_numeric( $this->userID ) )
		{
			case TRUE: $responseData['data'] = $this->dodModel->hasDods();
				break;
		}

		$response = json_encode($responseData);
		$this->output->set_output($response);
	}

	public function dodProducts( $dealID, $startFrom = 0, $maxResults = NULL )
	{
		$responseData = array();
		//$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		switch( $this->isReallyLoggedIN === TRUE && $this->userID !== NULL && is_numeric( $this->userID ) )
		{
			case TRUE: $responseData = $this->dodModel->dodProducts( $dealID, $this->userID, $this->isReallyLoggedIN, $startFrom, $maxResults );
				break;
		}

		$response = json_encode($responseData);
		$this->output->set_output($response);
	}
}
?>