<?php
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function results($term)
	{
		$term = str_replace('%20', " ", $term);
    	//$cacheVariableName = "searchResultsFor__".$term;
    	//$this->load->driver('cache');
        //$cacheResult = $this->cache->memcached->get($cacheVariableName);
        //if($cacheResult === FALSE)
        //{
        	//log_message('INFO', 'Unable to find '.$cacheVariableName.' in memcached. Will read from DB now.');
			log_message('INFO', 'search/results fired from '.$this->input->ip_address()." with \$term = ".$term);
			$userID = $this->session->userdata('id');
			$this->load->model('search_m');
			$store = $this->search_m->storeTerm($term, time(), $userID);
			$lastSearchTermCounts = $this->session->userdata('last_search_term_counts');
			$output = NULL;
			if( $lastSearchTermCounts !== FALSE ) // if there is some search count data available from the last time
			{
				if( strcmp( $lastSearchTermCounts[0], $term ) === 0 ) // if the same term was used for the counting
				{
					if( $lastSearchTermCounts[1] > 0 ) // product results
					{
						$output = $this->search_m->termArray($term);
					}
					elseif( $lastSearchTermCounts[2] > 0 ) // store results
					{
						$output = $this->search_m->termArray1($term);
					}
					elseif( $lastSearchTermCounts[3] > 0 ) // user results
					{
						$output = $this->search_m->searchUsers( $term );
					}
				}
				else
				{
					$output = $this->search_m->termArray($term);
				}
			}
			else
			{
				$output = $this->search_m->termArray($term);
			}
	    	$responseData = json_encode($output, JSON_FORCE_OBJECT);
	    	log_message('INFO', 'DATA RETURNED BY results:::'.print_r($responseData,TRUE));

	    	//$savedCache = $this->cache->memcached->save($cacheVariableName, $responseData, 604800); // cache for one week
	    	//switch($savedCache)
	    	//{
	    		//case TRUE: log_message('INFO', 'Successfully saved '.$cacheVariableName.' to memcached');
	    			//break;
	    		//case FALSE: log_message('INFO', 'Failed to save '.$cacheVariableName.' to memcached');
	    			//break;
	    	//}
        //}
        //else
        //{
        	//log_message('INFO', 'Read search results for "'.$term.'" from memcached');
        	//$responseData = $cacheResult;
        //}
    	$this->output->set_content_type('application/json')->set_output($responseData);
    }

    public function suggest($term)
	{
		$term = str_replace('%20', " ", $term);
    	$cacheVariableName = "searchSuggestionsFor__".$term;
    	$this->load->driver('cache');
        $cacheResult = $this->cache->memcached->get($cacheVariableName);
        if($cacheResult === FALSE)
        {
        	log_message('INFO', 'Unable to find "'.$cacheVariableName.'" in memcached. Will read from DB now.');
	    	$this->load->model('search_m');
	    	$output = $this->search_m->searchSuggestions($term);
	    	$responseData = json_encode($output, JSON_FORCE_OBJECT);
	    	$savedCache = $this->cache->memcached->save($cacheVariableName, $responseData, 604800); // cache for one week
	    	switch($savedCache)
	    	{
	    		case TRUE: log_message('INFO', 'Successfully saved '.$cacheVariableName.' to memcached');
	    			break;
	    		case FALSE: log_message('INFO', 'Failed to save '.$cacheVariableName.' to memcached');
	    			break;
	    	}
        }
        else
        {
        	log_message('INFO', 'Read search suggestions for "'.$term.'" from memcached');
        	$responseData = $cacheResult;
        }
    	$this->output->set_content_type('application/json')->set_output($responseData);
    }
    public function storeResult($term)
    {
    	$term = str_replace('%20', " ", $term);
    	$userID=$this->session->userdata('id');
    	log_message('INFO', 'search/storeresults fired from '.$this->input->ip_address()." with \$term = ".$term);
	    $this->load->model('search_m');
	    $store = $this->search_m->storeTerm($term, time(), $userID);
	    $output = $this->search_m->termArray1($term);
	    $responseData = json_encode($output, JSON_FORCE_OBJECT);
	    log_message('INFO', 'DATA RETURNED BY storeResult:::'.print_r($responseData,TRUE));
	    $this->output->set_content_type('application/json')->set_output($responseData);
    }
    public function userResult($term)
    {
    	$term = str_replace('%20', " ", $term);
    	$userID=$this->session->userdata('id');
    	log_message('INFO', 'search/userresults fired from '.$this->input->ip_address()." with \$term = ".$term);
	    $this->load->model('search_m');
	    $store = $this->search_m->storeTerm($term, time(), $userID);
	    $output = $this->search_m->searchUsers($term);
	    $responseData = json_encode($output, JSON_FORCE_OBJECT);
	    log_message('INFO', 'DATA RETURNED BY userResult:::'.print_r($responseData,TRUE));
	    $this->output->set_content_type('application/json')->set_output($responseData);
    }
    public function resultsCount($term)
	{
		$term = str_replace('%20', " ", $term);
		log_message('INFO', 'search/resultsCount fired from '.$this->input->ip_address()." with \$term = ".$term);
		$userID=$this->session->userdata('id');
	    $this->load->model('search_m');
	    $output['productsCount'] = $this->search_m->countProduct($term);
	    $output['storesCount'] = $this->search_m->countStore($term);
	    $output['usersCount'] = $this->search_m->countUser($term);

	    $this->session->set_userdata('last_search_term_counts', array($term, $output['productsCount'], $output['storesCount'], $output['usersCount']  ) ); // save the current search term so that this->results() returns only appropriate data 

	    $responseData = json_encode($output, JSON_FORCE_OBJECT);
	    log_message('INFO', 'DATA RETURNED BY resultsCount:::'.print_r($responseData,TRUE));
    	$this->output->set_content_type('application/json')->set_output($responseData);
    }
}
/*OLD shammi temp code
class Search extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
	}
	
	public function resultsOld($keyWord = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		$this->load->model('search_model');
		$searchResults = NULL;
		switch(is_null($keyWord)) // check if the keyword is NULL, only proceed if it is not NULL
		{
			case FALSE:$searchResults = $this->search_model->searchProduct($keyWord, $startFrom, $maxResults);
				break;
		}
		$response = json_encode($searchResults, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
	public function suggestOld($keyWord = NULL)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', $__ip." search/suggest fired with keyWord = ".print_r($keyWord, TRUE));
		$this->load->model('search_model');
		$searchResults = $this->search_model->searchSuggestions($keyWord);
		log_message('INFO', $__ip." search/suggest suggestions returned = ".print_r($searchResults, TRUE));
		$response = json_encode($searchResults, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
}*/
/*OLD UTK team code
class peopleSearchDataClass
{
	public $userFullName = NULL;
	public $userID = NULL;
	public $userEmail = NULL;
	public $userRank = NULL;
	public $userFollow = NULL;
	public $userFriends = NULL;
	public $userFancy = NULL;
	public $userStatus = NULL;
	public $productId = NULL;
	public $storeId = NULL;
	
}
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('directory');
		$this->load->model(search_model);
		$this->load->model(friends_follow_model);
	}
	public function index()
	{
	    include "header_for_controller.php";
		
	   $this->load->view('search_index');
	}
/////////////////////////////////////////        product search controller       /////////////////////////////////
	public function product($search="",$page_no="")
	{
        include "header_for_controller.php";
		if (isset($_POST['search']))
		{
		    $this->load->library('ci_thrift');
            $search = $this->input->post('search');
			$socket = new TSocket('54.251.99.100', 8888);
			$transport = new TBufferedTransport($socket, 1024, 1024);
			$protocol = new TBinaryProtocol($transport);
			$client = new mainservice_MainserviceClient($protocol);
			$transport->open();
			$data['get'] = $client->get_products($search, 8, 1, 40);
			$data['people'] = $client->get_people($search, 8, 1, 40);
			$data['search'] = $search;
			$data['pageno']=1;
			$data['session']=$this->session->userdata('id');
			$count=$data['get']->count;
			//$countPeople=$data['people']->count;
			if($count==0)
			{
			   redirect('search/noresult/'.$search.'');
			}
		}
		else
		 {  
		    $this->load->library('ci_thrift');
			$trimmed=str_replace("%20"," ",$search);
			$socket = new TSocket('54.251.99.100', 8888);
			$transport = new TBufferedTransport($socket, 1024, 1024);
			$protocol = new TBinaryProtocol($transport);
			$client = new mainservice_MainserviceClient($protocol);
			$transport->open();
			$data['get'] = $client->get_products($trimmed, 8, $page_no, 40);
			$data['people'] = $client->get_people($trimmed, 8, $page_no, 40);
			$data['search'] = $trimmed;
			$data['pageno'] = $page_no;
			$data['session']=$this->session->userdata('id');
			$count=$data['get']->count;
			if($count==0)
			{
			   redirect('search/noresult/'.$search.'');
			}
		}
		$this->load->view(search_product, $data);
	}
	/////////////////////////////////////////        people search controller       /////////////////////////////////
	public function people($search="",$page_no="")
	{  
        include "header_for_controller.php";
		$trimmed=str_replace("%20"," ",$search);
		$this->load->library('ci_thrift');
		$socket = new TSocket('54.251.99.100', 8888);
		$transport = new TBufferedTransport($socket, 1024, 1024);
		$protocol = new TBinaryProtocol($transport);
		$client = new mainservice_MainserviceClient($protocol);
		$transport->open();
		$data['get_product'] = $client->get_products($trimmed, 8, $page_no, 40);
		$data['get_people'] = $client->get_people($trimmed, 8, $page_no, 40);
		$data['search'] = $trimmed;
		$data['pageno']=$page_no;
		$count=$data['get_people']->count;
		//$countPeople=$data['get_product']->count;
			if($count==0)
			{
			   redirect('search/noresult/'.$search.'');
			}
		$get =$data['get_people']->url_details;
		$returnData = array();
		foreach($get as $people)
		{
			$peopleSearchDataItem = new peopleSearchDataClass;
			$keyval = $people->keyvalue;
			$peopleSearchDataItem->userID = $keyval[0]->value;
			$peopleSearchDataItem->userFullName = $keyval[1]->value;
			$peopleSearchDataItem->userEmail = $keyval[2]->value;
			$userRank = $this->search_model->get_rank($peopleSearchDataItem->userID);              // get user's rank
			$userFollow=$this->search_model->count_followers($peopleSearchDataItem->userID);	   //  get follower's count 
			$userFriends=$this->search_model->count_friends($peopleSearchDataItem->userID);        //  get friend's count
			$userFancy=$this->search_model->cfprod($peopleSearchDataItem->userID);                 // get count of fancy product
			$userStatus=$this->friends_follow_model->f_status($this->session->userdata('id'), $peopleSearchDataItem->userID);    // get friends status
			$productId=$this->search_model->prod_id($peopleSearchDataItem->userID);
			switch ($userRank)
			{
				case FALSE: $peopleSearchDataItem->userRank = 0;
					break;
				default: $peopleSearchDataItem->userRank = $userRank[0]->rank;
					break;
			}
			$peopleSearchDataItem->userFollow = $userFollow;
			$peopleSearchDataItem->userFriends = $userFriends;
			$peopleSearchDataItem->userFancy = $userFancy;
			$peopleSearchDataItem->productId = $productId;
			$peopleSearchDataItem->userStatus = $userStatus;
			$peopleSearchDataItem->storeId = $storeId;
			$returnData[] = $peopleSearchDataItem;
		}
		$data['userData'] = $returnData;
		$data['session']=$this->session->userdata('id');
		$this->load->view('search_people', $data);
		//$this->load->view('peoplesearch', $data);
	}
	public function noresult($search="",$page_no="")
	{
	  include "header_for_controller.php";
	  $this->load->library('ci_thrift');
      $trimmed=str_replace("%20"," ",$search);
	  $socket = new TSocket('54.251.99.100', 8888);
	  $transport = new TBufferedTransport($socket, 1024, 1024);
	  $protocol = new TBinaryProtocol($transport);
	  $client = new mainservice_MainserviceClient($protocol);
	  $transport->open();
	  $data['get_prod'] = $client->get_products($trimmed, 8, 1, 40);
      $data['get_ppl'] = $client->get_people($trimmed, 8, 1, 40);
	  $data['search'] = $trimmed;
	  $this->load->view('noresult',$data);
	}
}
*/
?>