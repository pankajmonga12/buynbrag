<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');
class Searcha extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
    	$this->searchbar();
    }
    
	public function searchbar()
	{
       $data["baseURL"] = base_url();
       $this->load->view('search_v', $data);
    }

	public function execute()
	{
		if ($this->input->post['term']===0)
		{
			echo "enter some text";
			exit();
		}
	    else
	    {
	    	$term = $this->input->post('term');
	    	$data = array();
	    	$data["isCached"] = FALSE;
	    	$data["savedCache"] = FALSE;
	    	$cacheArray = array();
	    	$cacheVariableName = "searchSuggestionsFor__".$term."__TEST";
	    	$this->load->driver('cache');
            $cacheArray = $this->cache->memcached->get($cacheVariableName);
            $data["checkCache"] = $cacheArray;
            if($cacheArray === FALSE)
            {
		    	$this->load->model('search_m');
			   	$output = $this->search_m->searchSuggestions($term);
		    	$data["savedCache"] = $this->cache->memcached->save($cacheVariableName, json_encode($output), 60);
	        }
	        else
	        {
	        	$data["isCached"] = TRUE;
	        	$output = json_decode($this->cache->memcached->get($cacheVariableName));
	        }
	    	//$this->output->set_content_type('application/json')->set_output(json_encode($output));
	    	$data["output"] = $output;
	    	$data["keyword"] = $term;
	    	$data["baseURL"] = base_url();
	    	//$this->output->enable_profiler(TRUE);
	    	$data["storeURL"] = "";
            $this->load->view('result1', $data);
	    }	
    }
    public function suggestions()
	{
		if ($this->input->post('term') === FALSE)
		{
			
			echo "dumbo";
		}
	    else
	    {
	    	$term = $this->input->post('term');
	    	$data = array();
	    	$data["isCached"] = FALSE;
	    	$data["savedCache"] = FALSE;
	    	$cacheArray = array();
	    	$cacheVariableName = "searchSuggestionsFor__".$term."__TEST";
	    	$this->load->driver('cache');
            $cacheArray = $this->cache->memcached->get($cacheVariableName);
            $data["checkCache"] = $cacheArray;
            if($cacheArray === FALSE)
            {
		    	$this->load->model('search_m');
		    	$output = $this->search_m->searchSuggestions($term);
		    	$data["savedCache"] = $this->cache->memcached->save($cacheVariableName, json_encode($output), 60);
	        }
	        else
	        {
	        	$data["isCached"] = TRUE;
	        	$output = json_decode($this->cache->memcached->get($cacheVariableName));
	        }
	    	//$this->output->set_content_type('application/json')->set_output(json_encode($output));
	    	$data["output"] = $output;
	    	$data["keyword"] = $term;
	    	$data["baseURL"] = base_url();
	    	//$this->output->enable_profiler(TRUE);
	    	$data["storeURL"] = "";
            $this->load->view('result1', $data);
	    }	
    }

    public function testExecute()
	{

		if ($this->input->post('term') === FALSE)
		{
			
			echo "dumbo";
		}
	    else
	    {
	    	$term = $this->input->post('term');
	    	$data = array();
	    	//$data["isCached"] = FALSE;
	    	//$data["savedCache"] = FALSE;
	    	//$cacheArray = array();
	    	//$cacheVariableName = "searchResultsFor__".$term;
	    	//$this->load->driver('cache');
            //$cacheArray = $this->cache->memcached->get($cacheVariableName);
            //$data["checkCache"] = $cacheArray;
            //if($cacheArray === FALSE)
            //{
		    	$this->load->model('search_m');
		    	$output = $this->search_m->termArray($term);
		    	log_message('INFO', "\$output = ".print_r($output, TRUE));
		    	//$data["savedCache"] = $this->cache->memcached->save($cacheVariableName, json_encode($output), 60);
	        //}
	        //else
	        //{
	        	//$data["isCached"] = TRUE;
	        	//$output = json_decode($this->cache->memcached->get($cacheVariableName));
	        //}
	    	//$this->output->set_content_type('application/json')->set_output(json_encode($output));
	    	$data["output"] = $output;
	    	$data["keyword"] = $term;
	    	$data["baseURL"] = base_url();
	    	//$this->output->enable_profiler(TRUE);
	    	$data["storeURL"] = "";
            $this->load->view('result1', $data);
	    }	
    }
}
?>