<?php if(! defined ('BASEPATH') ) exit('403 Unauthorized');
class Hdata extends CI_COntroller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('async_model');
	}
	
	public function recent($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom))
		{
			case TRUE:
				$lazyData = $this->async_model->lazyFanciedData3();
				break;
			case FALSE:
				switch (is_null($maxResults))
				{
					case TRUE:
						$lazyData = $this->async_model->lazyFanciedData3($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyFanciedData3($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}
	
	public function popular($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom))
		{
			case TRUE:
				$lazyData = $this->async_model->lazyPopularData();
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$lazyData = $this->async_model->lazyPopularData($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyPopularData($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}
	
	public function favourites($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom))
		{
			case TRUE:
				$lazyData = $this->async_model->lazyFavouriteData();
				break;
			case FALSE:
				switch (is_null($maxResults))
				{
					case TRUE:
						$lazyData = $this->async_model->lazyFavouriteData($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyFavouriteData($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($lazyData, JSON_FORCE_OBJECT));
	}
}
?>
