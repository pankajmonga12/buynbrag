<?php if( ! defined('BASEPATH') ) exit('403 UnAuthorized');
class Promotion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rapiv1/promotion_model', 'promotion_model');
	}

	public function dealOfTheDay()
	{
		$responseData = array('data' => 'The is the deal!');
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
}
?>