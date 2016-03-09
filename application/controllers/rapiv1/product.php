<?php if( ! defined( 'BASEPATH' ) ) exit('403 Unauthorized');
class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rapiv1/products_model', 'products_model');
	}

	public function info($pid, $params = NULL)
	{
		$responseData = array();
		$response = NULL;
		$responseData = $this->products_model->info($pid, $params);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function similar($pid, $pageNumber = 0)
	{
		$responseData = array();
		$response = NULL;
		$responseData = $this->products_model->similarProducts($pid, $pageNumber);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fanciedUsersFancies($pid, $pageNumber = 0)
	{
		$responseData = array();
		$response = NULL;
		$responseData = $this->products_model->fanciedUsersFancies($pid, $pageNumber);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fanciedBy($pid, $pageNumber = 0)
	{
		$responseData = array();
		$response = NULL;
		$responseData = $this->products_model->fanciedUsers($pid, $pageNumber);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
}
?>