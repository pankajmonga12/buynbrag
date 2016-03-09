<?php if(! defined('BASEPATH') ) exit('403 Unauthorized!');
class Me extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rapiv1/me_model', 'me_model');
	}

	public function feed($startFrom = 0, $maxResults = NULL)
	{
		$userID = ($this->session->userdata('id'))? $this->session->userdata('id'): NULL;
		$isLoggedIN = ($this->session->userdata('logged_in'))? $this->session->userdata('logged_in'): NULL;

		$feedData = $this->me_model->feedData($userID, $startFrom, $maxResults);

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($feedData, JSON_FORCE_OBJECT));
	}

	public function refreshFeed()
	{
		$cacheVariableNamePrefix = 'feedDataUsersList';
		$cacheVariableNamePostfix = $this->input->server('SERVER_NAME');
		
		$cacheVariableName = $cacheVariableNamePrefix."___".$cacheVariableNamePostfix;

		$this->load->driver('cache');
		$this->cache->memcached->delete($cacheVariableName);
	}
}
?>