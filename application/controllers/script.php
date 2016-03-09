<?php if( ! defined('BASEPATH') ) exit('Direct Script access not allowed');
class Script extends CI_Controller
{
	public function __constructor()
	{
		parent::__constructor();
	}
	
	public function load($fileName = NULL)
	{
		$data['baseURL'] = base_url();
		$searchIN = $data['baseURL'];
		$toSearch = 'www.';
		$replaceWith = '';
		$numberOfTimes = 1;
		$data['baseForAngular'] = str_replace($toSearch, $replaceWith, $searchIN, $numberOfTimes);
		$this->load->model('async_model');
		$data['storeURL'] = $this->async_model->storeURL();
		if(is_null($fileName))
		{
			$this->output->set_content_type('application/javascript');
			$scriptData = $this->load->view("app/scripts/angular/bnb_main", $data, TRUE); // make the loader class return the data
			$this->output->set_output($scriptData);
		}
	}
}
?>