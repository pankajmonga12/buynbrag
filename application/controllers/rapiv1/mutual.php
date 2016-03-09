<?php if( ! defined ( 'BASEPATH' ) ) exit( '403 Unauthorized' );

class Mutual extends CI_Controller
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
			case TRUE:	$this->load->model('rapiv1/mutual_model', 'mutualModel');
				break;
		}
		$this->output->set_content_type('application/json');
	}

	public function products( $userID = NULL, $startFrom = 0, $maxResults = NULL )
	{
		// filter parameter. 1 = by user, 2 = 
		//$filterBy = $this->input->get('filterBy')

		$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
        $responseData['data'] = NULL;

		switch( $responseData['isLoggedIN'] === TRUE && $userID !== NULL && is_numeric( $userID ) )
        {
            case TRUE:	$responseData['isValid'] = TRUE;
					    $responseData['data'] = $this->mutualModel->products( $this->userID, $userID, $startFrom, $maxResults );
					    log_message( 'DEBUG', "DATA RETUNED FROM rapiv1/mutualModel/products(".$this->userID.", ".$userID.") is:\r\n".$responseData['data']);
                break;
        }

	    $response = json_encode( $responseData['data'] );
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}
}
?>