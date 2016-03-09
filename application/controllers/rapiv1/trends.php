<?php if(! defined ('BASEPATH') ) exit('403 Unauthorized');

class Trends extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('async_model');
	}
	
	public function index($city1, $startFrom = NULL, $maxResults = NULL)
	{
		$city2 = ($this->input->get('city2') !== FALSE)? $this->input->get('city2'): NULL;
		$lazyData = NULL;
		switch (is_null($startFrom))
		{
			case TRUE:
				$lazyData = $this->async_model->lazyCityTrendsData($city1, $city2);
				break;
			case FALSE:
				switch (is_null($maxResults))
				{
					case TRUE:
						$lazyData = $this->async_model->lazyCityTrendsData($city1, $city2, $startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyCityTrendsData($city1, $city2, $startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}

	public function delhi($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$lazyData = $this->async_model->lazyPopularDataDelhi();
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$lazyData = $this->async_model->lazyPopularDataDelhi($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyPopularDataDelhi($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}
	
	public function mumbai($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$lazyData = $this->async_model->lazyPopularDataMumbai();
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$lazyData = $this->async_model->lazyPopularDataMumbai($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyPopularDataMumbai($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}
	
	public function kolkata($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$lazyData = $this->async_model->lazyPopularDataKolkata();
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$lazyData = $this->async_model->lazyPopularDataKolkata($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyPopularDataKolkata($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}
	
	public function chennai($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$lazyData = $this->async_model->lazyPopularDataChennai();
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$lazyData = $this->async_model->lazyPopularDataChennai($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyPopularDataChennai($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}
}
?>
