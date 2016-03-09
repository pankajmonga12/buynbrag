<?php if (!defined('BASEPATH')) exit("Direct script access prohibited");
class lazyLoadData
{
	public $product_id;
	public $store_id;
	public $store_name;
	public $fancy_counter;
	public $is_on_discount;
	public $selling_price;
	public $discount;
	public $product_name;
	public $visit_counter;
	public $quantity;
	public $poll_status;
	public $fancy_status;
}
// class to hold quick view data

class qvDataClass
{
	public $productID;
	public $storeID;
	public $productName;
	public $storeName;
	public $storeReturnPolicy;
	public $storeEMIPolicy;
	public $storeCODPolicy;
	public $productSellingPrice;
	public $isOnDiscount;
	public $productDiscount;
	public $productQuantity;
	public $catID;
	public $subCatID1;
	public $processingTime;
	public $productDescription;
	public $productFancyCounter;
	public $productBragCounter;
	public $productVisitCounter;
	public $hasFancied;
	public $hasBragged;
	
	public $userID1;
	public $user1FBID;
	public $user1Gender;
	public $userID2;
	public $user2FBID;
	public $user2Gender;
	public $userID3;
	public $user3FBID;
	public $user3Gender;
	public $userID4;
	public $user4FBID;
	public $user4Gender;
	public $userID5;
	public $user5FBID;
	public $user5Gender;

	public $braggedBy = NULL;
	
	public $mostFanciedProductID1;
	public $mostFanciedProductStoreID1;
	public $mostFanciedProductName1;
	//public $mostFanciedStoreName1;
	
	public $mostFanciedProductID2;
	public $mostFanciedProductStoreID2;
	public $mostFanciedProductName2;
	//public $mostFanciedStoreName2;
	
	public $mostFanciedProductID3;
	public $mostFanciedProductStoreID3;
	public $mostFanciedProductName3;
	//public $mostFanciedStoreName3;
	
	public $mostFanciedProductID4;
	public $mostFanciedProductStoreID4;
	public $mostFanciedProductName4;
	//public $mostFanciedStoreName4;
	
	public $mostFanciedProductID5;
	public $mostFanciedProductStoreID5;
	public $mostFanciedProductName5;
	//public $mostFanciedStoreName5;
}

class loginResponseData
{
	public $sessionSet = NULL;
	public $validCredentials = NULL;
	public $ID = NULL;
	public $gender = NULL;
	public $FBID = NULL;
	public $fullName = NULL;
	public $isActive = 0;
	public $rFlowStatus = 0;	
}

class Async extends CI_Controller
{
	public $cacheVariablePrefix = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->output->set_content_type('application/json');
		//error_reporting(-1);
		//ini_set("display_errors", 1);
		log_message('INFO', 'loading async model');
		$this->load->model('async_model');
		log_message('INFO', 'loaded async model');
		$this->cacheVariablePrefix = isset( $_SERVER['SERVER_NAME'] )? $_SERVER['SERVER_NAME']: "0.0.0.0";
	}

	public function index()
	{
		// do not write anything here for now
		// as we want this script to cater to
		// asynchronous requests only
	}

	public function handPickedItems($startFrom = NULL)
	{
		// select user id of the account editor@buynbrag.com (UID: 2915)
		$editorPicks = NULL;
		switch (is_null($startFrom))
		{
			case TRUE:
				$editorPicks = $this->async_model->getUserFanciedItems(2915);
				break;
			case FALSE:
				$editorPicks = $this->async_model->getUserFanciedItems(2915, $startFrom);
				//print "<p>startFrom = ".$startFrom."</p>";
				break;
		}
		/*print "<pre>\$editorPicks = ".$editorPicks;
		print_r($editorPicks);
		print "</pre>";*/
		if ($editorPicks !== FALSE)
		{
			/*print "<pre>";
			print_r($editorPicks);
			print "</pre>";*/
			foreach ($editorPicks as $row)
			{
				$storeName = $this->async_model->storeIDToName($row->store_id);
				$fancyStatus = ($this->async_model->hasFancied($row->product_id)) ? 1 : 0;
				//$storeName = $storeName->store_name;
				//print "<p>Product ID|Store ID|Fancy Counter|is_on_discount|Selling Price|Discount|Product Name|Visit Counter</p>";
				print $row->product_id . "_|_" . $row->store_id . "_|_" . $storeName . "_|_" . $row->fancy_counter . "_|_" . $row->is_on_discount . "_|_" . $row->selling_price . "_|_" . $row->discount . "_|_" . $row->product_name . "_|_" . $row->visit_counter . "_|_" . $row->quantity . "_|_" . $fancyStatus . "///|\\\\\\";
			}
		} else {
			print "___ERROR___";
		}
	}

	public function fancy($productID)
	{
		//print "<p> running fancy</p>";
		$fancyStatus = $this->async_model->samAsyncFancyProduct($productID);
		//print "<p> ran fancy. \\fancyStatus = ".$fancyStatus."</p>";
		// using if else-if as I want strict comparison
		if ($fancyStatus === FALSE) {
			print "___NOT_LOGGED_IN___";
		} else if ($fancyStatus === 1) {
			print "___SUCCESS___";
		} else if ($fancyStatus === 2) {
			print "___FANCIED___";
		} else {
			print "___ERROR___";
		}
	}
	
	public function fancy2($productID)
	{
		$listID = ($this->input->post('listID') !== FALSE)? $this->input->post('listID'): NULL;
		$responseData = array();
		//print "<p> running fancy</p>";
		$fancyStatus = $this->async_model->newFancyProduct($productID, $listID);
		$responseData['catID'] = ($this->session->userdata('catID') !== FALSE)? $this->session->userdata('catID') : NULL;
		$responseData['subCatID1'] = ($this->session->userdata('subCatID1') !== FALSE)? $this->session->userdata('subCatID1') : NULL;
		$this->session->unset_userdata('catID');
		$this->session->unset_userdata('subCatID1');
		//print "<p> ran fancy. \\fancyStatus = ".$fancyStatus."</p>";
		// using if else-if as I want strict comparison
		if ($fancyStatus === FALSE)
		{
			$responseData['loggedIN'] = FALSE;
			$responseData['fancy'] = FALSE;
			$responseData['alreadyFancied'] = FALSE;
			$responseData['error'] = FALSE;
		}
		else if ($fancyStatus === 1)
		{
			$responseData['loggedIN'] = TRUE;
			$responseData['fancy'] = TRUE;
			$responseData['alreadyFancied'] = FALSE;
			$responseData['error'] = FALSE;
		}
		else if ($fancyStatus === 2)
		{
			$responseData['loggedIN'] = TRUE;
			$responseData['fancy'] = TRUE;
			$responseData['alreadyFancied'] = TRUE;
			$responseData['error'] = FALSE;
		}
		else
		{
			$responseData['loggedIN'] = TRUE;
			$responseData['fancy'] = FALSE;
			$responseData['alreadyFancied'] = FALSE;
			$responseData['error'] = TRUE;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function unFancy($productID)
	{
		//print "<p> running fancy</p>";
		$unFancyStatus = $this->async_model->samAsyncUnFancyProduct($productID);
		//print "<p> ran fancy. \\fancyStatus = ".$fancyStatus."</p>";
		// using if else-if as I want strict comparison
		if ($unFancyStatus === FALSE) {
			print "___NOT_LOGGED_IN___";
		} else if ($unFancyStatus === 1) {
			print "___SUCCESS___";
		} else if ($unFancyStatus === 2) {
			print "___NOT_FANCIED___";
		} else {
			print "___ERROR___";
		}
	}
	
	public function unFancy2($productID)
	{
		//print "<p> running fancy</p>";
		$unFancyStatus = $this->async_model->samAsyncUnFancyProduct($productID);
		//print "<p> ran fancy. \\fancyStatus = ".$fancyStatus."</p>";
		// using if else-if as I want strict comparison
		$responseData = array();
		if ($unFancyStatus === FALSE)
		{
			$responseData['loggedIN'] = FALSE;
			$responseData['unFancy'] = FALSE;
			$responseData['alreadyFancied'] = FALSE;
			$responseData['error'] = FALSE;
		}
		else if ($unFancyStatus === 1)
		{
			$responseData['loggedIN'] = TRUE;
			$responseData['unFancy'] = TRUE;
			$responseData['alreadyFancied'] = TRUE;
			$responseData['error'] = FALSE;
		}
		else if ($unFancyStatus === 2)
		{
			$responseData['loggedIN'] = TRUE;
			$responseData['unFancy'] = FALSE;
			$responseData['alreadyFancied'] = FALSE;
			$responseData['error'] = FALSE;
		}
		else
		{
			$responseData['loggedIN'] = TRUE;
			$responseData['unFancy'] = FALSE;
			$responseData['alreadyFancied'] = FALSE;
			$responseData['error'] = TRUE;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function recentlySold($startFrom = NULL)
	{
		$recentItems = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$recentItems = $this->async_model->getRecentlySold();
				break;
			case FALSE:
				$recentItems = $this->async_model->getRecentlySold($startFrom);
				break;
		}
		switch ($recentItems) {
			case FALSE:
				print "___ERROR___";
				break;
			case TRUE: /*print "<pre>";
                           print_r($recentItems);
                           print "</pre>";*/
				foreach ($recentItems as $row) {
					$storeName = $this->async_model->storeIDToName($row->store_id);
					$fancyStatus = ($this->async_model->hasFancied($row->product_id)) ? 1 : 0;
					print $row->product_id . "_|_" . $row->store_id . "_|_" . $storeName . "_|_" . $row->fancy_counter . "_|_" . $row->is_on_discount . "_|_" . $row->selling_price . "_|_" . $row->discount . "_|_" . $row->product_name . "_|_" . $row->visit_counter . "_|_" . $row->quantity . "_|_" . $fancyStatus . "///|\\\\\\";
				}
		}
	}

	public function featuredStores($startFrom = NULL)
	{
		$featuredStore = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$featuredStore = $this->async_model->getUserFanciedStore(2915);
				break;
			case FALSE:
				$featuredStore = $this->async_model->getUserFanciedStore(2915, $startFrom);
				break;
		}
		// select user id of the account editor@buynbrag.com (UID: 2915)

		switch ($featuredStore) {
			case FALSE:
				print "___ERROR___";
				break;
			case TRUE: /*print "<pre>";
                           print_r($featuredStore);
                           print "</pre>";*/
				foreach ($featuredStore as $row) {
					$asyncOutput = $row->store_id . "_|_" . $row->store_name . "_|_" . $row->about_store . "_|_" . $row->contact_name . "_|_" . $row->storeowner_id . "_|_" . $row->fancy_counter . "_|_" . $row->owner_name;
					$mostFanciedStoreProducts = $this->async_model->getMostFanciedStoreProductsLite($row->store_id); // get only 6 results
					switch ($mostFanciedStoreProducts) {
						case FALSE:
							print "___ERROR___";
							break;
						case TRUE:
							foreach ($mostFanciedStoreProducts as $mostFanciedStoreProduct)
							{
								$asyncOutput .= "_|_" . $mostFanciedStoreProduct->product_id;
							}
							$asyncOutput .= "///|\\\\\\";
							print $asyncOutput;
							break;
					}
				}
				break;
		}
	}
	
	public function featuredStores2($startFrom = NULL, $catID = NULL)
	{
		$featuredStores = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$featuredStores = $this->async_model->getUserFanciedStore(2915, NULL, $catID);
				break;
			case FALSE:
				$featuredStores = $this->async_model->getUserFanciedStore(2915, $startFrom, $catID);
				break;
		}
		// select user id of the account editor@buynbrag.com (UID: 2915)
		$asyncOutput =  array();
		switch ($featuredStores)
		{
			case FALSE: $asyncOutput[0] = array("hasData" => FALSE);
				break;
			case TRUE: $asyncOutput[0] = array("hasData" => TRUE);
					 $storeProducts = array();
					 $looper = 0;
					 foreach ($featuredStores as $featuredStore)
					 {
						$mostFanciedStoreProducts = $this->async_model->getMostFanciedStoreProductsLite($featuredStore->store_id, NULL, $catID); // get only 6 results
						$storeProducts[$looper] = array("storeDetails" => $featuredStore, "storeProducts" => $mostFanciedStoreProducts);
						$looper++;
					 }
					 $asyncOutput[1] = $storeProducts;
				break;
		}
		$response = json_encode($asyncOutput, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function topStores($startFrom = NULL, $catID = NULL)
	{
		$topStores = NULL;
		switch (is_null($startFrom))
		{
			case TRUE: $topStores = $this->async_model->getTopStores(NULL, $catID);
				break;
			case FALSE: $topStores = $this->async_model->getTopStores($startFrom, $catID);
				break;
		}
		// select user id of the account editor@buynbrag.com (UID: 2915)
		$asyncOutput =  array();
		switch ($topStores)
		{
			case FALSE: $asyncOutput[0] = array("hasData" => FALSE);
				break;
			case TRUE: $asyncOutput[0] = array("hasData" => TRUE);
					 $storeProducts = array();
					 $looper = 0;
					 foreach($topStores as $topStore)
					 {
						$topStoreMostFanciedProducts = $this->async_model->getMostFanciedStoreProductsLite($topStore->store_id, NULL, $catID); // get only 6 results
						$storeProducts[$looper] = array("storeDetails" => $topStore, "storeProducts" => $topStoreMostFanciedProducts);
						$looper++;
					 }
					 $asyncOutput[1] = $storeProducts;
				break;
		}
		$response = json_encode($asyncOutput, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function newStores2($startFrom = NULL, $catID = NULL)
	{
		$newStores = NULL;
		switch (is_null($startFrom))
		{
			case TRUE: $newStores = $this->async_model->getNewStores(NULL, $catID);
				break;
			case FALSE: $newStores = $this->async_model->getNewStores($startFrom, $catID);
				break;
		}
		// select user id of the account editor@buynbrag.com (UID: 2915)
		$asyncOutput =  array();
		switch ($newStores)
		{
			case FALSE: $asyncOutput[0] = array("hasData" => FALSE);
				break;
			case TRUE: $asyncOutput[0] = array("hasData" => TRUE);
					 $storeProducts = array();
					 $looper = 0;
					 foreach($newStores as $newStore)
					 {
						$newStoreMostFanciedProducts = $this->async_model->getMostFanciedStoreProductsLite($newStore->store_id, NULL, $catID); // get only 6 results
						$storeProducts[$looper] = array("storeDetails" => $newStore, "storeProducts" => $newStoreMostFanciedProducts);
						$looper++;
					 }
					 $asyncOutput[1] = $storeProducts;
				break;
		}
		$response = json_encode($asyncOutput, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function allStores($startFrom = NULL, $catID = NULL)
	{
		$allStores = NULL;
		switch (is_null($startFrom))
		{
			case TRUE: $allStores = $this->async_model->getStores(NULL, $catID);
				break;
			case FALSE: $allStores = $this->async_model->getStores($startFrom, $catID);
				break;
		}
		// select user id of the account editor@buynbrag.com (UID: 2915)
		$asyncOutput =  array();
		switch ($allStores)
		{
			case FALSE: $asyncOutput[0] = array("hasData" => FALSE);
				break;
			case TRUE: $asyncOutput[0] = array("hasData" => TRUE);
					 $storeProducts = array();
					 $looper = 0;
					 foreach($allStores as $allStore)
					 {
						$allStoreMostFanciedProducts = $this->async_model->getMostFanciedStoreProductsLite($allStore->store_id, NULL, $catID); // get only 6 results
						$storeProducts[$looper] = array("storeDetails" => $allStore, "storeProducts" => $allStoreMostFanciedProducts);
						$looper++;
					 }
					 $asyncOutput[1] = $storeProducts;
				break;
		}
		$response = json_encode($asyncOutput, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function newProducts($startFrom = NULL)
	{
		$newProducts = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$newProducts = $this->async_model->getRecentProducts();
				break;
			case FALSE:
				$newProducts = $this->async_model->getRecentProducts($startFrom);
		}

		switch ($newProducts) {
			case FALSE:
				print "___ERROR___";
				break;
			case TRUE: /*print "<pre>";
                           print_r($newProducts);
                           print "</pre>";*/
				foreach ($newProducts as $row) {
					print $row->product_id . "_|_" . $row->store_id . "_|_" . $row->product_name . "///|\\\\\\";
				}
				break;
		}
	}

	public function newStores($startFrom = NULL)
	{
		$newStores = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$newStores = $this->async_model->getRecentStores();
				break;
			case FALSE:
				$newStores = $this->async_model->getRecentStores($startFrom);
				break;
		}

		switch ($newStores) {
			case FALSE:
				print "___ERROR___";
				break;
			case TRUE: /*print "<pre>";
                           print_r($newStores);
                           print "</pre>";*/
				foreach ($newStores as $row) {
					$asyncOutput = $row->store_id . "_|_" . $row->store_name;
					$mostFanciedStoreProducts = $this->async_model->getMostFanciedStoreProductsLite($row->store_id); // get only 6 results
					switch ($mostFanciedStoreProducts) {
						case FALSE:
							print "___ERROR___";
							break;
						case TRUE:
							foreach ($mostFanciedStoreProducts as $mostFanciedStoreProduct) {
								$asyncOutput .= "_|_" . $mostFanciedStoreProduct->product_id;
							}
							$asyncOutput .= "///|\\\\\\";
							print $asyncOutput;
							break;
					}
					print "///|\\\\\\";
				}
				break;
		}
	}

	public function recentlyFancied($startFrom = NULL)
	{
		$recentlyFancied = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$recentlyFancied = $this->async_model->getRecentlyFancied();
				break;
			case FALSE:
				$recentlyFancied = $this->async_model->getRecentlyFancied($startFrom);
				break;
		}

		switch ($recentlyFancied) {
			case FALSE:
				print "___ERROR___";
				break;
			case TRUE:
				print "<pre>";
				print_r($recentlyFancied);
				print "</pre>";
				/*foreach($newStores as $row)
				   {
					   $asyncOutput = $row->store_id."_|_".$row->store_name;
					   $mostFanciedStoreProducts = $this->async_model->getMostFanciedStoreProductsLite($row->store_id); // get only 6 results
					   switch($mostFanciedStoreProducts)
					   {
						   case FALSE: print "___ERROR___";
							   break;
						   case TRUE: foreach($mostFanciedStoreProducts as $mostFanciedStoreProduct)
									  {
										   $asyncOutput .= "_|_".$mostFanciedStoreProduct->product_id;
									  }
									  $asyncOutput .= "///|\\\\\\";
									  print $asyncOutput;
							   break;
					   }
					   print "///|\\\\\\";
				   }*/
				break;
		}
	}

	public function lazyFanciedData($startFrom = NULL, $maxResults = NULL)
	{
		$tLazyData = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$tLazyData = $this->async_model->lazyFanciedData();
				break;
			case FALSE:
				switch (is_null($maxResults))
				{
					case TRUE:
						$tLazyData = $this->async_model->lazyFanciedData($startFrom);
						break;
					case FALSE:
						$tLazyData = $this->async_model->lazyFanciedData($startFrom, $maxResults);
						break;
				}
				break;
		}
		//print "<pre>".print_r($tLazyData)."</pre>";
		$lazyData = array();
		foreach ($tLazyData as $row) {
			$lazyDatum = new lazyLoadData();
			$lazyDatum->product_id = $row->product_id;
			$lazyDatum->store_id = $row->store_id;
			$lazyDatum->store_name = $this->async_model->storeIDToName($row->store_id);
			$lazyDatum->fancy_counter = $row->fancy_counter;
			$lazyDatum->is_on_discount = $row->is_on_discount;
			$lazyDatum->selling_price = $row->selling_price;
			$lazyDatum->discount = $row->discount;
			$lazyDatum->product_name = $row->product_name;
			$lazyDatum->visit_counter = $row->visit_counter;
			$lazyDatum->quantity = $row->quantity;
			$lazyDatum->poll_status = ($this->async_model->hasPolled($row->product_id)) ? 1 : 0;
			$lazyDatum->fancy_status = ($this->async_model->hasFancied($row->product_id)) ? 1 : 0;
			$lazyData[] = $lazyDatum;
		}
		/*print "<pre>";
		print_r($lazyData);
		print "</pre>";*/
		$this->output->set_content_type('application/json');
		print json_encode($lazyData, JSON_FORCE_OBJECT);
	}

	public function lazyFanciedData2($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$lazyData = $this->async_model->lazyFanciedData2();
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$lazyData = $this->async_model->lazyFanciedData2($startFrom);
						break;
					case FALSE:
						$lazyData = $this->async_model->lazyFanciedData2($startFrom, $maxResults);
						break;
				}
				break;
		}
		$this->output->set_content_type('application/json');
		print json_encode($lazyData, JSON_FORCE_OBJECT);
	}
	
	public function lazyFanciedData3($startFrom = NULL, $maxResults = NULL)
	{
		$lazyData = NULL;
		switch (is_null($startFrom)) {
			case TRUE:
				$lazyData = $this->async_model->lazyFanciedData3();
				break;
			case FALSE:
				switch (is_null($maxResults)) {
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
	
	public function qvData($productID = NULL)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'Someone is trying to access async/qvData for product '.$productID." from ".$__ip);
		/*error_reporting(E_ALL);
		ini_set('display_errors', 1);*/
		$this->async_model->increaseProductVisitCounter($productID); // increase the visit counter
		$responseData = array();
		$cacheVariableName = "qvData__".$productID;
		$this->load->driver('cache');
		$cachedData = $this->cache->memcached->get($cacheVariableName);
		switch($cachedData === FALSE)
		{
			case TRUE:if(! is_null($productID) )
						{
							$qVData = new qvDataClass;
							$qVData->productID = $productID;
							$usersList = NULL;
							$usersList = $this->async_model->lastFanciedBy($productID);
							$qVData->braggedBy = $this->async_model->lastBraggedBy($productID);
							$userIDs = array();
							$userIDsCount = 0;
							$userFBIDs = array();
							$userGenders = array();
							if($usersList !== FALSE)
							{
								foreach($usersList as $row)
								{
									$userIDs[] = $row->user_id; // loop through all data and store the userIDs
									$userFBIDs[] = $row->fb_uid;// and FBIDs
									$userGenders[] = $row->userGender; // and their gender
									$userIDsCount++; // increment the user IDs counter
								}

								/* CODE BLOCK TO SKIP THE CURRENT USER */

								$currentUserID = $this->session->userdata('id');
								if($currentUserID !== FALSE)
								{
									$tUserIDs = array_diff($userIDs, array($currentUserID));
									$tI = 0;
									unset($userIDs);
									foreach($tUserIDs as $userID)
									{
										$userIDs[$tI++] = $userID;
									}
								}

								/* END SECTION CODE BLOCK TO SKIP THE CURRENT USER */


								// following five lines store the userIDs in the qvDataClass object only if a userID has been read/returned from the DB
								$qVData->userID1 = ($userIDsCount > 0 && isset($userIDs[0]))? $userIDs[0]: NULL;
								$qVData->user1FBID = ($userIDsCount > 0 && isset($userFBIDs[0]))? $userFBIDs[0]: NULL;
								$qVData->user1Gender = ($userIDsCount > 0 && isset($userGenders[0]))? $userGenders[0]: NULL;
								
								$qVData->userID2 = ($userIDsCount > 1 && isset($userIDs[1]))? $userIDs[1]: NULL;
								$qVData->user2FBID = ($userIDsCount > 1 && isset($userFBIDs[1]))? $userFBIDs[1]: NULL;
								$qVData->user2Gender = ($userIDsCount > 1 && isset($userGenders[1]))? $userGenders[1]: NULL;
								
								$qVData->userID3 = ($userIDsCount > 2 && isset($userIDs[2]))? $userIDs[2]: NULL;
								$qVData->user3FBID = ($userIDsCount > 2 && isset($userFBIDs[2]))? $userFBIDs[2]: NULL;
								$qVData->user3Gender = ($userIDsCount > 2 && isset($userGenders[2]))? $userGenders[2]: NULL;
								
								$qVData->userID4 = ($userIDsCount > 3 && isset($userIDs[3]))? $userIDs[3]: NULL;
								$qVData->user4FBID = ($userIDsCount > 3 && isset($userFBIDs[3]))? $userFBIDs[3]: NULL;
								$qVData->user4Gender = ($userIDsCount > 3 && isset($userGenders[3]))? $userGenders[3]: NULL;
								
								$qVData->userID5 = ($userIDsCount > 4 && isset($userIDs[4]))? $userIDs[4]: NULL;
								$qVData->user5FBID = ($userIDsCount > 4 && isset($userFBIDs[4]))? $userFBIDs[4]: NULL;
								$qVData->user5Gender = ($userIDsCount > 4 && isset($userGenders[4]))? $userGenders[4]: NULL;
							}
							
							$productData = NULL;
							$productData = $this->async_model->qVProductData($productID); //  read the product data from the database
							if($productData === FALSE)
							{
								$this->output->set_content_type('application/json');
								$this->output->set_output('null');
								return NULL;
							}
							//print "<pre>";print_r($productData);print "</pre>";
							$qVData->storeID = $productData[0]->store_id;
							$qVData->productName = $productData[0]->product_name;
							//$qVData->storeName = $this->async_model->storeIDToName($productData[0]->store_id);
							$qVData->storeName = $productData[0]->storeName;
							$qVData->productSellingPrice = $productData[0]->selling_price;
							$qVData->isOnDiscount = $productData[0]->is_on_discount;
							$qVData->productDiscount = $productData[0]->discount;
							$qVData->productQuantity = $productData[0]->quantity;
							$qVData->hasFancied = $productData[0]->hasFancied;
							$qVData->hasBragged = $productData[0]->hasBragged;
							
							/* for description */
							$tdesc = "";
							$tdesc .= preg_replace('/\v+|\\\[rn]/', '<br/>', $productData[0]->description);
							if($productID > 4499)
							{
								if(strlen($productData[0]->whats_in_the_box) > 0)
								{
									$tdesc .= "<br><br><b>What's in the box: </b>".$productData[0]->whats_in_the_box;
								}
								foreach($productData as $productItem)
								{
									if(isset($productItem->dimensionUnit) && strlen($productItem->dimensionUnit) > 0) // if there is some value in dimensionUnit
									{
										$dimensionUnitName = NULL;
										if($productItem->dimensionUnit == 1) // if dimensionUnit = 1 then
										{
											$dimensionUnitName = "inch"; // unit name is "inch"
										}
										elseif($productItem->dimensionUnit == 2) //  if its 2 then
										{
											$dimensionUnitName = "cm"; // unit name is "cm"
										}
										elseif($productItem->dimensionUnit == 3)
										{
											$dimensionUnitName = "mm"; // unit name is "mm"
										}
										elseif($productItem->dimensionUnit == 4)
										{
											$dimensionUnitName = "mL"; // unit name is "mL"
										}
										elseif($productItem->dimensionUnit == 5)
										{
											$dimensionUnitName = "L"; // unit name is "L"
										}
										elseif($productItem->dimensionUnit == 6)
										{
											$dimensionUnitName = "Feet"; // unit name is "feet"
										}
										else // if there is no value or any other value then
										{
											$dimensionUnitName = ""; // make it an empty string
										}
										
										$tdesc .= "<br><br><b>";
										if(isset($productItem->dimensionLabel) && strlen($productItem->dimensionLabel) > 0) // if any dimension label has been specified
										{
											$tdesc .= $productItem->dimensionLabel." "; // print it with a postfixed space
										}
										$tdesc .= "Dimensions: </b>";
										$isPrintedLength = FALSE;
										$isPrintedBreadth = FALSE;
										$isPrintedHeight = FALSE;
										if(isset($productItem->length) && strlen($productItem->length) > 0 && $productItem->length > 0) // if some length has been inputted in the db
										{
											$tdesc .= "Length ".(($productItem->length > 0)? $productItem->length: "")." ".$dimensionUnitName; // print the length
											$isPrintedLength = TRUE;
										}
										
										if(isset($productItem->breadth) && strlen($productItem->breadth) > 0 && $productItem->breadth > 0) // if some breadth has been inputted in the db
										{
											if($isPrintedLength === TRUE)
											{
												$tdesc .= " x ";
											}
											$tdesc .= "Width ".(($productItem->breadth > 0)? $productItem->breadth: "")." ".$dimensionUnitName; // print the width
											$isPrintedBreadth = TRUE;
										}
										
										if(isset($productItem->height) && strlen($productItem->height) > 0 && $productItem->height > 0) // if some height has been inputted in the db
										{
											if($isPrintedLength === TRUE || $isPrintedBreadth === TRUE)
											{
												$tdesc .= " x ";
											}
											$tdesc .= "Height ".(($productItem->height > 0)? $productItem->height: "")." ".$dimensionUnitName; // print the height
											$isPrintedBreadth = TRUE;
										}
										if(isset($productItem->diameter) && strlen($productItem->diameter) > 0 && $productItem->diameter > 0) // if some diameter has been inputted in the db
										{
											if($isPrintedLength === TRUE || $isPrintedBreadth === TRUE)
											{
												$tdesc .= " x ";
											}
											$tdesc .= "Diameter ".(($productItem->diameter > 0)? $productItem->diameter: "")." ".$dimensionUnitName; // print the diameter
										}
									}
									
									if(isset($productItem->capacityUnit) && strlen($productItem->capacityUnit) > 0)
									{
										$capacityUnitName = NULL;
										if($productItem->capacityUnit == 1) // if the value of capacityUnit is 1 in db
										{
											$capacityUnitName = "mL"; // then set the capacity unit name to "mL"
										}
										elseif($productItem->capacityUnit == 2) // if the value of capacityUnit is 2 in db
										{
										$capacityUnitName = "L"; // then set the capacity unit  name to "L"
										}
										
										if(isset($productItem->capacity) && strlen($productItem->capacity) > 0 && $productItem->capacity > 0) // if some capacity has been inputted in the db
										{
											$tdesc .= "<br><br><b>Capacity: </b>".(($productItem->capacity > 0)? $productItem->capacity: "")." ".$capacityUnitName; // print the length
										}
									}
								}
								if(isset($productData[0]->finish) && strlen($productData[0]->finish) > 0)
								{
									$tdesc .= "<br><br><b>Finish: </b>".$productData[0]->finish;
								}
								if(isset($productData[0]->tech_spec) && strlen($productData[0]->tech_spec) > 0)
								{
									$tdesc .= "<br><br><b>Technical Specifications: </b>".$productData[0]->tech_spec;
								}
								if(isset($productData[0]->material_composition) && strlen($productData[0]->material_composition) > 0)
								{
									$tdesc .= "<br><br><b>Material Composition: </b>".$productData[0]->material_composition;
								}
								if(isset($productData[0]->usage) && strlen($productData[0]->usage) > 0)
								{
									$tdesc .= "<br><br><b>Usage: </b>".$productData[0]->usage;
								}
								if(isset($productData[0]->care) && strlen($productData[0]->care) > 0)
								{
									$tdesc .= "<br><br><b>Care: </b>".$productData[0]->care;
								}
								if(isset($productData[0]->assembly) && strlen($productData[0]->assembly) > 0)
								{
									$tdesc .= "<br><br><b>Assembly: </b>".$productData[0]->assembly;
								}
								if(isset($productData[0]->sellers_assurance) && strlen($productData[0]->sellers_assurance) > 0)
								{
									$tdesc .= "<br><br><b>Seller Assurance: </b>".$productData[0]->sellers_assurance;
								}
								if(isset($productData[0]->additional_info) && strlen($productData[0]->additional_info) > 0)
								{
									$tdesc .= "<br><br><b>Additional Information: </b>".$productData[0]->additional_info;
								}
							}
							/* for description */
							
							$qVData->productDescription = $tdesc;
							$qVData->productFancyCounter = $productData[0]->fancy_counter;
							$qVData->productBragCounter = $productData[0]->brag_counter;
							$qVData->productVisitCounter = $productData[0]->visit_counter;
							$qVData->storeReturnPolicy = $productData[0]->storeReturnPolicy;
							$qVData->storeEMIPolicy = $productData[0]->storeEMIPolicy;
							$qVData->storeCODPolicy = $productData[0]->storeCODPolicy;
							
							$sameCatProducts = $this->async_model->qVSameCatProducts($productData[0]->cat_id, $productData[0]->sub_catid1, $productData[0]->sub_catid2, $productData[0]->sub_catid3);
							/* ============ FOLLOWING CODE BLOCKED TO SHOW THE SAME CATEGORY PRODUCTS ======================= */
							/* ============ INSTEAD OF YOU MIGHT FANCY's OLD LOGIC ========================================== */
							/*$userFanciedProducts = $this->async_model->recentlyFanciedProductsByUsers($userIDs);
							$mightFancyPool = array_merge($sameCatProducts, $userFanciedProducts); // merge arrays to generate the fancy pool
							
							$sorter = array();
							$i = 0;
							foreach($mightFancyPool as $mightFancy) // loop through all objects in the mightFancyPool
							{
								$sorter[sprintf("%d", $i)] = $mightFancy->fancy_counter; // store all the fancy counters
								$i++;
							}
							
							//print "<hr>SORTER (unsorted)<hr><pre>";print_r($sorter);print "</pre>";
							arsort($sorter, SORT_NUMERIC); // sort the array of fancy counters and maintain index associations
							//print "<hr>SORTER (sorted)<hr><pre>";print_r($sorter);print "</pre>";
							*/
							$limiter = 15;
							$i = 0;
							$mightFancyProds = array();
							foreach($sameCatProducts as $key => $value)
							{
								if($i === 0 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID1 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID1 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName1 = $sameCatProducts[intval($key)]->product_name;
									$mightFancyProds[$i] = $qVData->mostFanciedProductID1;
									$i++;
									continue;
								}
								if($i === 1 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID2 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID2 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName2 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID2, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID2; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								if($i === 2 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID3 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID3 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName3 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID3, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID3; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								if($i === 3 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID4 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID4 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName4 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID4, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID4; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								if($i === 4 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID5 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID5 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName5 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID5, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID5; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								/*print "<pre>";
								print "\r\n\$i = ".$i;
								print "\r\n\$mightFancyProds = [";print_r($mightFancyProds);print "]";
								print "</pre>";*/
								if($i >= $limiter) // if we have read 5 array values
								{
									break; // break out of the loop
								}
							}
							
							//print "<hr>Might Fancy Pool (After Sorting)<hr><pre>";print_r($mightFancyPool);print "</pre>";
							$filesExistence = array();
							$imgs = array();
							$storeURL = $this->async_model->storeURL();
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/".$productID."/img1_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/".$productID."/img2_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/".$productID."/img3_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/". $productID."/img4_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/". $productID."/img5_product.jpg";
							clearstatcache(); // clear file_exists cache
							foreach($imgs as $img)
							{
								$tmpExistence = @file_get_contents($img);
								$tLogMsg = NULL;
								if($tmpExistence === FALSE)
								{
									$filesExistence[] = FALSE;
									$tLogMsg = "File : ".$img." EXISTS";
								}
								else
								{
									$filesExistence[] = TRUE;
									$tLogMsg = "File : ".$img." DOES NOT EXIST";
								}
								log_message("INFO", $__ip." async/qvData: ".$tLogMsg);
							}
							$responseData['hasData'] = TRUE;
							$responseData['qvData'] = $qVData;
							$responseData['variants'] = $this->async_model->qVProductVariants($productID);
							$responseData['filesExistence'] = $filesExistence;
							$responseData['moreStoreProducts'] = $this->async_model->qVSameStoreProducts($productID);
						}
						else
						{
							$responseData[] = array("hasData" => FALSE);
						}
						$cacheSaved = $this->cache->memcached->save($cacheVariableName, json_encode($responseData, JSON_FORCE_OBJECT), 2592000); // cache the data for 30 days
						log_message('INFO', "Status of saving data for ".$cacheVariableName." in cache is ".json_encode($cacheSaved));
				break;
			case FALSE: $responseData = json_decode($cachedData, TRUE);
						log_message('INFO', "read qvData for ".$cacheVariableName." from cache.\r\n\r\nCached Data is: \r\n".print_r($cachedData, TRUE)."\r\n\r\nAfter json_decode the data is: \r\n".print_r($responseData, TRUE));
				break;
		}
		$responseData['hasFancied'] = $this->async_model->hasFancied($productID);
		// print the JSON
		//print json_encode($qVData, JSON_FORCE_OBJECT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_NUMERIC_CHECK);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($responseData, JSON_FORCE_OBJECT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT));
	}
	
	public function view($uid)
	{
		//include 'header_for_controller.php';
		$this->load->model('friends_follow_model'); //thejas
		$self_id = $this->session->userdata('id');
		if ($this->input->post('btn_fnf') == 'Follow')
		{
			$data['f_click'] = $this->friends_follow_model->f_follow($self_id, $uid);
			if ($self_id < $uid)
			{
				$i = 0;
				$j = 1;
			}
			else
			{
				$i = 1;
				$j = 0;
			}
			$mail_info = $this->friends_follow_model->follow_mail_details($self_id, $uid);
			//var_dump($mail_info);

			if ($mail_info != 0)
			{
				if ($mail_info != 0)
				{
					$follower_name = $mail_info[$i]['full_name'];
					$base_url = base_url();
					include 'mail_2.php';
					$this->load->library('email');
					$this->email->from('support@buynbrag.com', 'BuynBrag');
					$this->email->to($mail_info[$j]['sent_email_id']);
					$this->email->subject($follower_name . " started following you on BuynBrag!");
					$this->email->message($follow_message);
					$this->email->set_newline("\r\n");
					if ($this->email->send())
					{
						$this->friends_follow_model->follow_mail_success($self_id, $uid);
					}
				}
			}
			elseif($this->input->post('btn_fnf') == 'Add Friend') 
			{
				$data['f_click'] = $this->friends_follow_model->f_add($self_id, $uid);
			}
			elseif($this->input->post('btn_fnf') == 'Unfollow')
			{
				$data['f_click'] = $this->friends_follow_model->f_unfollow($self_id, $uid);
			}
			elseif ($this->input->post('btn_fnf') == 'Unfriend')
			{
				$data['f_click'] = $this->friends_follow_model->f_delete($self_id, $uid);
				$data['f_click'] = $this->friends_follow_model->f_delete($uid, $self_id);
			}
			else
			{
				$data['f_click'] = "";
			}
		}
	}
	
	protected function addFriend($uid)
	{
		$isLoggedIN = $this->async_model->isLoggedIN();
		$self_id = $isLoggedIN['uid']; 
		if($isLoggedIN['status'] === TRUE)
		{
			return $this->async_model->addFriend($self_id, $uid);
		}
		else
		{
			return 0; // signifies user is not logged-in
		}
	}
	
	protected function unFriend($uid)
	{
		$isLoggedIN = $this->async_model->isLoggedIN();
		$self_id = $isLoggedIN['uid']; 
		if($isLoggedIN['status'] === TRUE)
		{
			$res1 = $this->async_model->removeFriend($self_id, $uid);
			$res2 = $this->async_model->removeFriend($uid, $self_id);
			return ($res1 && $res2);
		}
		else
		{
			return 0;
		}
	}
	
	public function followUser($uid)
	{
		$isLoggedIN = $this->async_model->isLoggedIN();
		$self_id = $isLoggedIN['uid']; 
		if($isLoggedIN['status'] === TRUE)
		{
			if ($this->input->post('btn_fnf') == 'Follow')
			{
				$data['f_click'] = $this->async_model->friendFollow($self_id, $uid);
				if($self_id < $uid)
				{
					$i = 0;
					$j = 1;
				}
				else
				{
					$i = 1;
					$j = 0;
				}
				$this->load->model('friends_follow_model');
				$mail_info = $this->friends_follow_model->follow_mail_details($self_id, $uid);
				//var_dump($mail_info);

				if ($mail_info != 0)
				{
					$follower_name = $mail_info[$i]['full_name'];
					$base_url = base_url();
					include 'mail_2.php';
					$this->load->library('email');
					$this->email->from('support@buynbrag.com', 'BuynBrag');
					$this->email->to($mail_info[$j]['sent_email_id']);
					$this->email->subject($follower_name . " started following you on BuynBrag!");
					$this->email->message($follow_message);
					$this->email->set_newline("\r\n");
					if ($this->email->send())
					{
						$this->friends_follow_model->follow_mail_success($self_id, $uid);
					}
				}
			}
		}
	}
	
	public function unFollowUser($uid)
	{
		$isLoggedIN = $this->async_model->isLoggedIN();
		$self_id = $isLoggedIN['uid']; 
		if($isLoggedIN['status'] === TRUE)
		{
			$this->friends_follow_model->f_unfollow($self_id, $uid);
		}
		else
		{
			return 0;
		}
	}
	
	public function login()
	{
		log_message('INFO', 'a user from '.$this->input->ip_address().' is accessing page async/login at '.microtime());
		$email = $this->input->post('signin_email');
		$pw = $this->input->post('signin_pw');
		log_message('INFO', 'the details POSTed from '.$this->input->ip_address().' email = '.$email.', password = '.$pw);
		$userAuthDetails = $this->async_model->userAuthDetails($email, $pw);
		$authDetails = $userAuthDetails['userDetails'];
		$responseData = array();
		$responseData[0] = new loginResponseData;
		log_message('INFO', 'authDetails = '.print_r($authDetails, TRUE));
		$response = NULL;
		switch($authDetails === FALSE)
		{
			case TRUE: log_message('ERROR', 'authDetails returned FALSE');
					 $responseData[0] = array("isLoggedIN" => FALSE,'validCredentials' => FALSE, 'sessionSet' => FALSE, 'rFlowStatus' => 0);
					 $response = json_encode($responseData, JSON_FORCE_OBJECT);
				break;
			case FALSE: log_message('INFO', 'authDetails got DATA!. checking credentials now');
					  if(strcmp($email, $authDetails[0]->email) === 0 && strcmp(md5($pw), $authDetails[0]->password) === 0)
					  {
						log_message('INFO', 'provided credentials are correct');
						$responseData[0] = array("isLoggedIN" => TRUE,'validCredentials' => TRUE, 'sessionSet' => FALSE, 'rFlowStatus' => 0);
						$t = $this->async_model->userDetails( $authDetails[0]->userID );
						$responseData[1] = $t[0];
						$responseData[0]['rFlowStatus'] = $t[0]->rFlowStatus;
						log_message('INFO', 'trying to set session');
						$sessionData = array('id' => $authDetails[0]->userID, 'logged_in' => TRUE, 'gender' => $authDetails[0]->gender);
						$this->session->set_userdata( $sessionData );
						log_message('INFO', 'just set Session data for '.$authDetails[0]->userID.' from '.$this->input->ip_address());
						log_message('INFO', 'now checking whether it has been set or not');
						$sessionUserID = $this->session->userdata('id');
						$sessionLoggedIN = $this->session->userdata('logged_in');
						switch( ( strcmp( $sessionUserID, $authDetails[0]->userID ) === 0 ) && $sessionLoggedIN === TRUE )
						{
							case TRUE: $responseData[0]['sessionSet'] = TRUE;
									log_message('INFO', 'session has been set. user with ID: '.$authDetails[0]->userID.' has been logged in ');
									log_message('INFO', 'now setting data for the response');
									$responseData[2] = $this->async_model->headerData($authDetails[0]->userID);
								break;
							case FALSE: log_message('INFO', 'session could not be set for user with ID: '.$authDetails[0]->userID);
									$responseData[0]->sessionSet = FALSE;
								break;
						}
					  }
					  else
					  {
						log_message('INFO', 'credentials are wrong');
						$responseData[0] = array("isLoggedIN" => FALSE,'validCredentials' => FALSE, 'sessionSet' => FALSE, 'rFlowStatus' => 0);
					  }
				break;
		}
		$responseData[3] = array( 'badgesData' => $this->badges($authDetails[0]->userID) );
		$responseData[4] = $this->async_model->isLoggedINViaFacebook();
		$responseData[5] = array('userExists' => $userAuthDetails['userExists'], 'newUserCreated' => $userAuthDetails['newUserCreated'], 'newUserID' => $userAuthDetails['newUserID']);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message('INFO', 'response = '.print_r($responseData, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
		log_message('INFO', 'JSON Output sent to the client');
	}
	
	protected function allBadges($userID)
	{
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		$this->load->model('badges');
		$badges = array();
		//---$visitedStoresCount = count($this->badges->myvisitstore($this->session->userdata('id')));
		// Badges
		$userBadges = $this->async_model->userBadges($userID);
		if (!empty($userBadges))
		{
			for ($i = 0; $i < count($userBadges); $i++)
			{
				if ($userBadges[$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText, 'bbucks' => $storeBadges[$badgeLevels]->bbucks, 'triggeredAt' => $storeBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text, 'bbucks' => $pollBadges[$badgeLevels]->bbucks, 'triggeredAt' => $pollBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText, 'bbucks' => $fancyStoreBadges[$badgeLevels]->bbucks, 'triggeredAt' => $fancyStoreBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText, 'bbucks' => $fancyBadges[$badgeLevels]->bbucks, 'triggeredAt' => $fancyBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText, 'bbucks' => $bragBadges[$badgeLevels]->bbucks, 'triggeredAt' => $bragBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText, 'bbucks' => $buyBadges[$badgeLevels]->bbucks, 'triggeredAt' => $buyBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 71)
				{
					$temp = array('type' => 71, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/71/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 72)
				{
					$temp = array('type' => 72, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/72/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 73)
				{
					$temp = array('type' => 73, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/73/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 74)
				{
					$temp = array('type' => 74, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/74/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 75)
				{
					$temp = array('type' => 75, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/75/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 8)
				{
					$temp = array('type' => 8, 'level' => $userBadges[$i]->badge_level, 'img' => "inv/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 9)
				{
					$temp = array('type' => 9, 'level' => $userBadges[$i]->badge_level, 'img' => "acc/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
			}
		}
		return $badges;
		//End of Badges
	}
	
	protected function badges($userID)
	{
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		$this->load->model('badges');
		$badges = array();
		//---$visitedStoresCount = count($this->badges->myvisitstore($this->session->userdata('id')));
		// Badges
		$userBadges = $this->async_model->userBadges($userID);
		if (!empty($userBadges))
		{
			for ($i = 0; $i < count($userBadges); $i++)
			{
				$badgeLevels = $userBadges[$i]->badge_level;
				if ($userBadges[$i]->badge_type == 1)
				{
					$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText, 'bbucks' => $storeBadges[$badgeLevels]->bbucks, 'triggeredAt' => $storeBadges[$badgeLevels]->triggeredAt);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 2)
				{
					$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text, 'bbucks' => $pollBadges[$badgeLevels]->bbucks, 'triggeredAt' => $pollBadges[$badgeLevels]->triggeredAt);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 3)
				{
					$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText, 'bbucks' => $fancyStoreBadges[$badgeLevels]->bbucks, 'triggeredAt' => $fancyStoreBadges[$badgeLevels]->triggeredAt);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 4) // badges for fancy products
				{
					$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText, 'bbucks' => $fancyBadges[$badgeLevels]->bbucks, 'triggeredAt' => $fancyBadges[$badgeLevels]->triggeredAt);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 5)
				{
					$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText, 'bbucks' => $bragBadges[$badgeLevels]->bbucks, 'triggeredAt' => $bragBadges[$badgeLevels]->triggeredAt);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 6)
				{
					$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText, 'bbucks' => $buyBadges[$badgeLevels]->bbucks, 'triggeredAt' => $buyBadges[$badgeLevels]->triggeredAt);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 71)
				{
					$temp = array('type' => 71, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/71/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 72)
				{
					$temp = array('type' => 72, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/72/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 73)
				{
					$temp = array('type' => 73, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/73/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 74)
				{
					$temp = array('type' => 74, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/74/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 75)
				{
					$temp = array('type' => 75, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/75/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 8)
				{
					$temp = array('type' => 8, 'level' => $userBadges[$i]->badge_level, 'img' => "inv/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 9)
				{
					$temp = array('type' => 9, 'level' => $userBadges[$i]->badge_level, 'img' => "acc/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
			}
		}
		return $badges;
		//End of Badges
	}
	
	public function checkLogin($returnValue = FALSE)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async/checkLogin');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		$gender = $this->session->userdata('gender'); // check the status of the variable gender
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' gender = '.$gender.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" ');
					 log_message('INFO', 'Will now try to retrieve header data for the user '.$userID);
					 $responseData[0] = array("isLoggedIN" => TRUE);
					 $userDetails = $this->async_model->userDetails($userID);
					 $responseData[1] = $userDetails[0];
					 /* BUGFIX BITBUCKET ISSUE # 86
					 	CHECK TO SEE IF THE USER DETAILS REALLY EXIST IN THE DB.
					 	IF IT DOES NOT, LOGOUT THE USER AND REDIRECT TO homepage
					 */
					 if($responseData[1] === FALSE)
					 {
					 	$this->logout();
					 	$responseData = NULL; // user not found
					 	$response = json_encode($responseData, JSON_FORCE_OBJECT);
						log_message('INFO', "Sending the following response now_______________________\r\n".print_r($response, TRUE));
						$this->output->set_content_type('application/json');
						$this->output->set_output($response);
						exit;
					 }
					 /* END SECTION BUGFIX BITBUCKET ISSUE # 86 */
					 $responseData[2] = $this->async_model->headerData($userID);
					 $responseData[3] = array("badgesData" => $this->badges($userID));
					 $responseData[4] = $this->async_model->isLoggedINViaFacebook();
					 if($gender === FALSE)
					 {
					 	$this->session->set_userdata( array( 'gender' => $responseData[1]->gender ) );
					 }
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is not "logged-in" ');
					  log_message('INFO', 'Will now try to retrieve header data for "nobody"');
					  $responseData[0] = array("isLoggedIN" => FALSE);
				break;
		}
		switch($returnValue)
		{
			case TRUE:log_message('INFO', "Returning the following DATA_______________________\r\n".print_r($responseData, TRUE));
						return $responseData;
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message('INFO', "Sending the following response now_______________________\r\n".print_r($response, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function cartData($returnValue = FALSE)
	{
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE:
					 $responseData[0] = array("isLoggedIN" => TRUE);
					 $responseData[1] = $this->async_model->cartData($userID);
				break;
			case FALSE:
					  $responseData[0] = array("isLoggedIN" => FALSE);
				break;
		}
		switch($returnValue)
		{
			case TRUE:
						return $responseData;
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function badgeNotifications($returnValue = FALSE)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async/badgeNotifications');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		$gender = $this->session->userdata('gender'); // check the status of the variable gender
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' gender = '.$gender.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" ');
					 log_message('INFO', 'Will now try to retrieve header data for the user '.$userID);
					 $responseData[0] = array("isLoggedIN" => TRUE);
					 $responseData['result'] = array("badgesData" => $this->badges($userID));
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is not "logged-in" ');
					  log_message('INFO', 'Will now try to retrieve header data for "nobody"');
					  $responseData[0] = array("isLoggedIN" => FALSE);
				break;
		}
		switch($returnValue)
		{
			case TRUE:log_message('INFO', "Returning the following DATA_______________________\r\n".print_r($responseData, TRUE));
						return $responseData;
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message('INFO', "Sending the following response now_______________________\r\n".print_r($response, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function isLoggedIN($returnValue = FALSE)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async/isLoggedIN');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$response = NULL;
		$responseData = array($this->async_model->isLoggedINViaFacebook());
		switch($returnValue)
		{
			case TRUE:log_message('INFO', "Returning the following DATA now_______________________\r\n".print_r($responseData, TRUE));
						return $responseData;
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message('INFO', "Sending the following response now_______________________\r\n".print_r($response, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function logout()
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async/logout');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		$couponID = $this->session->userdata('couponid'); // check the status of the variable 'couponid'
		$redeemedPrice = $this->session->userdata('redeemedprice'); // check the status of the variable redeemedprice
		log_message('INFO', 'Data retrieved from session is userID  = '.$userID.', isLoggedIN = '.$isLoggedIN.', ipAddress = '.$__ip);
		$response = NULL;
		if($userID === FALSE || $isLoggedIN === FALSE)
		{
			log_message('ERROR', 'Nobody is logged-in from the current session and hence can not be logged-out');
			$response = '{"logOutStatus":false,"wasLoggedIN":false}';
		}
		else
		{
			log_message('INFO', 'trying to logout user '.$userID.' based on a request from '.$__ip);

			$this->load->helper('cookie');
			$cookieToDelete = array('name' => 'firstLogin', 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/', 'prefix' => 'bnbX_');
			delete_cookie($cookieToDelete);
			$cookieToDelete = array('name' => 'linkFB', 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/', 'prefix' => 'bnbX_');
			delete_cookie($cookieToDelete);
			
			$this->session->unset_userdata('id'); // delete id from session data
			$this->session->unset_userdata('logged_in'); // delete logged_in from session data
			$this->session->unset_userdata('couponid'); // delete any coupon ids from session
			$this->session->unset_userdata('redeemedprice'); // delete redeemedprice associated with the coupon
			$this->session->unset_userdata('tID'); // delete tID associated with the current user
			$this->session->unset_userdata('gender'); // delete gender associated with the current user
			$this->session->sess_destroy(); // completely destroy session and all associated data
			log_message('INFO', 'just deleted session data for user '.$userID.'. Will re-read the values to be 100% sure');
			$userID2 = NULL;
			$isLoggedIN2 = NULL;
			$userID2 = $this->session->userdata('id'); // read the user id from session
			$isLoggedIN2 = $this->session->userdata('logged_in'); // check the status of the variable logged_in
			$couponID2 = $this->session->userdata('couponid'); // check the status of the variable 'couponid'
			$redeemedPrice2 = $this->session->userdata('redeemedprice'); // check the status of the variable redeemedprice
			log_message('INFO', 'Logging the coupon data from session');
			log_message('INFO', "CouponID2 = ".$couponID2.", redeemedPrice2 = ".$redeemedPrice2);
			switch($userID2 === FALSE && $isLoggedIN2 === FALSE)
			{
				case TRUE: log_message('INFO', 'session data has been deleted for user '.$userID.' based on a request from '.$__ip.'. The user has been logged-out successfully.');
						 $response = '{"logOutStatus":true,"wasLoggedIN":true}';
					break;
				case FALSE: log_message('INFO', 'session data could not be deleted for user '.$userID.' based on a request from '.$__ip.'. The user could not be logged-out.');
						  log_message('INFO', 'Dumping CI session '.print_r($this->session->all_userdata(), TRUE) );
						  $response = '{"logOutStatus":false,"wasLoggedIN":true}';
			}
		}
		log_message('INFO', 'Sending response now');
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function deleteFBCookies()
	{
		$this->load->helper('cookie');
		$cookieToDelete = array('name' => 'firstLogin', 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/', 'prefix' => 'bnbX_');
		delete_cookie($cookieToDelete);
		$cookieToDelete = array('name' => 'linkFB', 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/', 'prefix' => 'bnbX_');
		delete_cookie($cookieToDelete);
	}
	
	public function headerData()
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async/headerData');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" ');
					 log_message('INFO', 'Will now try to retrieve header data for the user '.$userID);
					 $responseData = $this->async_model->headerData($userID);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is not "logged-in" ');
					  log_message('INFO', 'Will now try to retrieve header data for "nobody"');
					  $responseData = $this->async_model->headerData();
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$outputBuffer = $this->output->get_output();
		log_message('INFO', ' The output buffer contains the following data______________');
		log_message('INFO', print_r($outputBuffer, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function cats()
	{
		//$this->output->set_content_type('text/html');
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$__ip.' is trying to access async/cats');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$cats = $this->async_model->catsData3();
		/*
		$tmpArray = array();
		$rootCats = array(); // stores all the root categories
		// find all root level categories
		$i = 0;
		foreach($cats as $cat)
		{
			//  if the parentID is 0 then it is a root category
			switch($cat->parentCatID)
			{
				case 0: $rootCats[$cat->parentCatID][$cat->catID] = $cat;
					break;
			}
		}
		
		$looper = 0;
		foreach($cats as $cat)
		{
			//  if the parentID is 0 then it is a root category
			switch($cat->parentCatID)
			{
				case 0: $rootCats[][$cat->catID] = $cat;
					   $tmpArray[] = $cat->catID; //  store all the root categories in a temporary array
					   unset($cats[$looper]);
					break;
			}
			$looper++;
		}*/
		/*print "<pre>";
		print_r($rootCats);
		print "</pre><hr>all cats<hr><pre>";
		print_r($cats);
		print "</pre>";
		*/
		/*
		read level 2 cats
		if the parent of any cat is in level 1 categories then it is a level 2 category
		*/
		/*$looper = 0;
		foreach($cats as $cat)
		{
			if( in_array($cat->parentCatID, $tmpArray) ) // if the current category's parent is a level 1 category
			{
				$rootCats[0][$cat->parentCatID][]
			}
			$looper++;
		}*/
		/*$responseData = NULL;
		$response = json_encode($responseData, JSON_FORCE_OBJECT|JSON_NUMERIC_CHECK);
		log_message('INFO', 'Sending response now');
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);*/
		$responseData = array();
		$responseData['cats'] = $cats;
		$responseData['storeURL'] = $this->async_model->storeURL();
		$responseData['baseURL'] = base_url();
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message('INFO', 'Sending response now');
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function storesList()
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$__ip.' is trying to access async/storesList');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$storesData = $this->async_model->storesMenuData();
		log_message('INFO', 'data returned is: '.print_r($storesData, TRUE));
		$responseData = NULL;
		switch($storesData === FALSE)
		{
			case TRUE: $responseData = array("hasData" => FALSE);
				break;
			case FALSE: $responseData = array("hasData" => TRUE, "storesList" => $storesData);
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT|JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_QUOT);
		log_message('INFO', 'Sending response now');
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function addToCart($prodid, $color, $size, $userid, $storeid, $quantity = 1)
	{
		log_message("INFO", "INSIDE async/addToCart. Requested by ".$userid." from ".$this->input->ip_address());
		log_message("INFO", 'params:::: prodid = '.$prodid.', color = '.$color.', size = '.$size.', userID = '.$userid.', storeID = '.$storeid.', quantity = '.$quantity);
		$this->load->model('morder');
		//$exist = $this->morder->checkCartExistence($prodid, $color, $size, $userid, $storeid);
		$exist = $this->morder->checkCartExistence2($prodid, $userid);
		$response = NULL;
		log_message('INFO', 'cart exist = '.$exist);
		if($exist == 0)
		{
			$t = $this->morder->save_cart2($prodid, $color, $size, $userid, $storeid, $quantity);
			$cartCount = $this->morder->cartCount($userid);
			$responseData = array("addedProduct" => $t['addedProduct'], "availableQuantity" => $t['availableQuantity'], "cartCount" => $cartCount);
		}
		else
		{
			//$cartID = $this->morder->getCartID($prodid, $color, $size, $userid, $storeid, $quantity);
			$cartID = $this->morder->getCartID2($prodid, $userid);
			$t = $this->morder->updateCart($prodid, $color, $size, $userid, $storeid, $quantity, $cartID);
			$cartCount = $this->morder->cartCount($userid);
			$responseData = array("addedProduct" => $t['addedProduct'], "availableQuantity" => $t['availableQuantity'], "cartCount" => $cartCount);
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message("INFO", "Response = ".print_r($response, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function forgotPassword($step = NULL, $hash = NULL)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$__ip.' is trying to access async/forgotPassword');
		$responseData = array();
		switch(is_null($step) || ! is_numeric($step))
		{
			case TRUE: $responseData['hasData'] = FALSE;
				break;
			case FALSE:switch($step)
					 {
						case 1: // generate hash and send email
							   $responseData['hasData'] = TRUE;
							   $responseData['hashGenerated'] = FALSE;
							   $emailAddress = $this->input->post('email');
							   $hashGenerated = $this->async_model->forgotPasswordHash($emailAddress);
							   
							   $responseData['userExists'] = $hashGenerated['userExists'];
							   $responseData['hashGenerated'] = $hashGenerated['hash'];
							   $responseData['hashSaved'] = $hashGenerated['hashSaved'];
							   
							   if($hashGenerated['userExists'] === TRUE && $hashGenerated['hashSaved'] === TRUE)
							   {
								   log_message('INFO', "json_encoded hash saving data = ".json_encode($hashGenerated));
								   $this->load->library('email');
								   $this->email->from('support@buynbrag.com', 'BuynBrag');
								   $this->email->to($emailAddress);
								   $this->email->subject("BuynBrag: Password Reset Link for your account at BuynBrag");
								   //$msg = "Click the following link to reset your BuynBrag password<br>Ignore this mail to retain your old password in case you did not request for it.<br><br>";
								   $resetLink = base_url().'reset/'.$hashGenerated['hash'];
//								   $resetLink = base_url().'reset.html?hash='.$hashGenerated['hash'];
								   //$this->email->message($msg . '<h2 style="padding:9px;border:3px solid red;background-color:black;color:green">' . $resetLink . '</h2>');
								   $data['resetLink'] = $resetLink;
								   $data['ip'] = $this->input->ip_address();
								   $msg = $this->load->view('emailers/resetPasswordMail', $data, true);
								   
								   $this->email->message($msg);
								   $this->email->set_newline("\r\n");
								   
								   if($this->email->send())
								   {
									   $responseData['emailSent'] = TRUE;
								   }
								   else
								   {
									   $responseData['emailSent'] = FALSE;
								   }
							   }
							   else
							   {
								   $responseData['emailSent'] = FALSE;
							   }
							break;
						case 2: // check hash and allow user to set new password
							  switch(is_null($hash))
							  {
								case TRUE: $responseData['hasData'] = TRUE;
										 $responseData['hadHash'] = FALSE;
									break;
								case FALSE: $responseData['hasData'] = TRUE;
										 $responseData['hadHash'] = TRUE;
										 $hashCheck = $this->async_model->checkHash($hash);
										 switch($hashCheck["hashOK"]) // check the hash and return the user's ID from DB
										 {
											 case TRUE:$responseData['hashOK'] = TRUE;
													 $newPassword = $this->input->post('newPassword');
													 $newPasswordConfirm = $this->input->post('newPasswordConfirm');
													 switch(strcmp($newPassword, $newPasswordConfirm) === 0 && strlen($newPassword) > 0) // if both newPassword and newPasswordConfirm are same and are not an empty string
													 {
														case TRUE:$responseData['passwordsMatched'] = TRUE;
																$pwChangeStatus = $this->async_model->setNewPassword($hashCheck["userID"], $newPassword);
																if($pwChangeStatus === TRUE)
																{
																	$responseData['newPasswordSet'] = TRUE;
																}
																else
																{
																	$responseData['newPasswordSet'] = FALSE;
																}
															break;
														case FALSE: $responseData['passwordsMatched'] = FALSE;
															break;
													 }
												break;
											case FALSE:$responseData['hashOK'] = FALSE;
												break;
										}
									break;
							  }
							break;
					 }
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		log_message('INFO', 'Response being returned-----------------'.print_r($response, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function storeSections($storeID)
	{
		$responseData = array();
		$responseData = $this->async_model->storeSections($storeID);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}

	public function storeSectionsUnpublished($storeID)
	{
		$responseData = array();
		$responseData = $this->async_model->storeSectionsUnpublished($storeID);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
	
	public function storeProducts($storeID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		$storeProducts = NULL;
		switch(is_null($startFrom))
		{
			case TRUE: $storeProducts = $this->async_model->storeProducts($storeID, $sortBy);
				break;
			case FALSE:switch(is_null($maxResults))
					 {
						case TRUE: $storeProducts = $this->async_model->storeProducts($storeID, $sortBy, $startFrom);
							break;
						case FALSE: $storeProducts = $this->async_model->storeProducts($storeID, $sortBy, $startFrom, $maxResults);
							break;
					 }
				break;
		}
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($storeProducts, JSON_FORCE_OBJECT));
	}

	public function storeProductsUnpublished($storeID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		$storeProducts = NULL;
		switch(is_null($startFrom))
		{
			case TRUE: $storeProducts = $this->async_model->storeProductsUnpublished($storeID, $sortBy);
				break;
			case FALSE:switch(is_null($maxResults))
					 {
						case TRUE: $storeProducts = $this->async_model->storeProductsUnpublished($storeID, $sortBy, $startFrom);
							break;
						case FALSE: $storeProducts = $this->async_model->storeProductsUnpublished($storeID, $sortBy, $startFrom, $maxResults);
							break;
					 }
				break;
		}
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($storeProducts, JSON_FORCE_OBJECT));
	}
	
	public function storeSectionProducts($storeID, $storeSectionID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		$__ip = $this->input->ip_address();
		$storeSectionProducts = NULL;
		switch(is_null($startFrom))
		{
			case TRUE: $storeSectionProducts = $this->async_model->storeSectionProducts($storeID,  $storeSectionID, $sortBy);
				break;
			case FALSE:switch(is_null($maxResults))
					 {
						case TRUE: $storeSectionProducts = $this->async_model->storeSectionProducts($storeID, $storeSectionID, $sortBy, $startFrom);
							break;
						case FALSE: $storeSectionProducts = $this->async_model->storeSectionProducts($storeID, $storeSectionID, $sortBy, $startFrom, $maxResults);
							break;
					 }
				break;
		}
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($storeSectionProducts, JSON_FORCE_OBJECT));
	}

	public function storeSectionProductsUnpublished($storeID, $storeSectionID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		$__ip = $this->input->ip_address();
		$storeSectionProducts = NULL;
		switch(is_null($startFrom))
		{
			case TRUE: $storeSectionProducts = $this->async_model->storeSectionProductsUnpublished($storeID,  $storeSectionID, $sortBy);
				break;
			case FALSE:switch(is_null($maxResults))
					 {
						case TRUE: $storeSectionProducts = $this->async_model->storeSectionProductsUnpublished($storeID, $storeSectionID, $sortBy, $startFrom);
							break;
						case FALSE: $storeSectionProducts = $this->async_model->storeSectionProductsUnpublished($storeID, $storeSectionID, $sortBy, $startFrom, $maxResults);
							break;
					 }
				break;
		}
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($storeSectionProducts, JSON_FORCE_OBJECT));
	}
	
	public function catTree()
	{
		$responseData = $this->async_model->buildTree();
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($responseData, JSON_FORCE_OBJECT));
	}
	
	public function catsData2()
	{
		$this->load->driver('cache');
		$catsCached = $this->cache->memcached->get($this->cacheVariablePrefix."async__catsData2");
		switch($catsCached === FALSE)
		{
			case TRUE: $catsCached = $this->async_model->catsData2();
						$cacheSaved = $this->cache->memcached->save($this->cacheVariablePrefix."async__catsData2", $catsCached, 604800); // cache the categories for 7 days
						log_message('INFO', "async/catsData2: Saving categories to cache. Saved status: ".json_encode($cacheSaved));
				break;
			case FALSE: log_message('INFO', 'async/catsData2: Read categories from cache');
				break;
		}
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($catsCached, JSON_FORCE_OBJECT));
	}
	
	public function catProducts($catID, $subCatID1 = NULL, $subCatID2 = NULL, $subCatID3 = NULL)
	{
		 // 1 = lowest price, 2 = highest price, 3 = popularity, 4 = newness, 5 = store_name(alphabetical), 6 = only discounted products, 7 = trending
		$sortBy = ($this->input->post('sortBy') !== FALSE)? $this->input->post('sortBy'): 4;
		$startFrom = ($this->input->post('startFrom') !== FALSE)? $this->input->post('startFrom'): 0;
		$maxResults = ($this->input->post('maxResults') !== FALSE)? $this->input->post('maxResults'): NULL;
		
		log_message('INFO', "cat_id = ".$catID.", sub_catid1 = ".$subCatID1.", sub_catid2 = ".$subCatID2.", sub_catid3 = ".$subCatID3);
		
		$responseData = $this->async_model->catProducts($catID, $subCatID1, $subCatID2, $subCatID3, $sortBy, $startFrom, $maxResults);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
	
	public function productPageData($productID = NULL)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'Someone is trying to access async/productPageData for product '.$productID." from ".$__ip);

		$cacheVariableName = "productPageData__".$productID;
		log_message('INFO', 'initiating memcached procedures');
		
		$this->load->driver('cache');
		$cachedData = $this->cache->memcached->get($cacheVariableName);
		/*error_reporting(E_ALL);
		ini_set('display_errors', 1);*/
		$responseData = array();
		switch($cachedData === FALSE)
		{
			case TRUE: if(! is_null($productID) )
						{
							$this->async_model->increaseProductVisitCounter($productID);
							$this->async_model->saveUserProductVisit( $productID );
							$qVData = new qvDataClass;
							$qVData->productID = $productID;
							$usersList = NULL;
							$usersList = $this->async_model->lastFanciedBy($productID);
							$qVData->braggedBy = $this->async_model->lastBraggedBy($productID);
							$userIDs = array();
							$userIDsCount = 0;
							$userFBIDs = array();
							$userGenders = array();
							if($usersList !== FALSE)
							{
								foreach($usersList as $row)
								{
									$userIDs[] = $row->user_id; // loop through all data and store the userIDs
									$userFBIDs[] = $row->fb_uid;// and FBIDs
									$userGenders[] = $row->userGender; // and their gender
									$userIDsCount++; // increment the user IDs counter
								}

								/* CODE BLOCK TO SKIP THE CURRENT USER */

								$currentUserID = $this->session->userdata('id');
								if($currentUserID !== FALSE)
								{
									$tUserIDs = array_diff($userIDs, array($currentUserID));
									$tI = 0;
									unset($userIDs);
									foreach($tUserIDs as $userID)
									{
										$userIDs[$tI++] = $userID;
									}
								}
								
								/* END SECTION CODE BLOCK TO SKIP THE CURRENT USER */
								
								// following five lines store the userIDs in the qvDataClass object only if a userID has been read/returned from the DB
								$qVData->userID1 = ($userIDsCount > 0 && isset($userIDs[0]))? $userIDs[0]: NULL;
								$qVData->user1FBID = ($userIDsCount > 0 && isset($userFBIDs[0]))? $userFBIDs[0]: NULL;
								$qVData->user1Gender = ($userIDsCount > 0 && isset($userGenders[0]))? $userGenders[0]: NULL;
								
								$qVData->userID2 = ($userIDsCount > 1 && isset($userIDs[1]))? $userIDs[1]: NULL;
								$qVData->user2FBID = ($userIDsCount > 1 && isset($userFBIDs[1]))? $userFBIDs[1]: NULL;
								$qVData->user2Gender = ($userIDsCount > 1 && isset($userGenders[1]))? $userGenders[1]: NULL;
								
								$qVData->userID3 = ($userIDsCount > 2 && isset($userIDs[2]))? $userIDs[2]: NULL;
								$qVData->user3FBID = ($userIDsCount > 2 && isset($userFBIDs[2]))? $userFBIDs[2]: NULL;
								$qVData->user3Gender = ($userIDsCount > 2 && isset($userGenders[2]))? $userGenders[2]: NULL;
								
								$qVData->userID4 = ($userIDsCount > 3 && isset($userIDs[3]))? $userIDs[3]: NULL;
								$qVData->user4FBID = ($userIDsCount > 3 && isset($userFBIDs[3]))? $userFBIDs[3]: NULL;
								$qVData->user4Gender = ($userIDsCount > 3 && isset($userGenders[3]))? $userGenders[3]: NULL;
								
								$qVData->userID5 = ($userIDsCount > 4 && isset($userIDs[4]))? $userIDs[4]: NULL;
								$qVData->user5FBID = ($userIDsCount > 4 && isset($userFBIDs[4]))? $userFBIDs[4]: NULL;
								$qVData->user5Gender = ($userIDsCount > 4 && isset($userGenders[4]))? $userGenders[4]: NULL;
							}
							
							$productData = NULL;
							$productData = $this->async_model->qVProductData($productID); //  read the product data from the database
							if($productData === FALSE)
							{
								$this->output->set_content_type('application/json');
								$this->output->set_output('null');
								
							}
							//print "<pre>";print_r($productData);print "</pre>";
							$qVData->storeID = $productData[0]->store_id;
							$qVData->productName = $productData[0]->product_name;
							//$qVData->storeName = $this->async_model->storeIDToName($productData[0]->store_id);
							$qVData->storeName = $productData[0]->storeName;
							$qVData->productSellingPrice = $productData[0]->selling_price;
							$qVData->isOnDiscount = $productData[0]->is_on_discount;
							$qVData->productDiscount = $productData[0]->discount;
							$qVData->productQuantity = $productData[0]->quantity;
							$qVData->catID = $productData[0]->catID;
							$qVData->subCatID1 = $productData[0]->subCatID1;
							
							$qVData->processingTime = $productData[0]->processingTime;
							
							log_message('INFO', "\$productData[0]->processingTime = ".$productData[0]->processingTime.", \$qvData->processingTime = ".$qVData->processingTime);
							$qVData->hasFancied = $productData[0]->hasFancied;
							$qVData->hasBragged = $productData[0]->hasBragged;
							
							/* for description */
							$tdesc = "";
							$tdesc .= preg_replace('/\v+|\\\[rn]/', '<br/>', $productData[0]->description);
							if($productID > 4499)
							{
								if(strlen($productData[0]->whats_in_the_box) > 0)
								{
									$tdesc .= "<br><br><b>What's in the box: </b>".$productData[0]->whats_in_the_box;
								}
								foreach($productData as $productItem)
								{
									if(isset($productItem->dimensionUnit) && strlen($productItem->dimensionUnit) > 0) // if there is some value in dimensionUnit
									{
										$dimensionUnitName = NULL;
										if($productItem->dimensionUnit == 1) // if dimensionUnit = 1 then
										{
											$dimensionUnitName = "inch"; // unit name is "inch"
										}
										elseif($productItem->dimensionUnit == 2) //  if its 2 then
										{
											$dimensionUnitName = "cm"; // unit name is "cm"
										}
										elseif($productItem->dimensionUnit == 3)
										{
											$dimensionUnitName = "mm"; // unit name is "mm"
										}
										elseif($productItem->dimensionUnit == 4)
										{
											$dimensionUnitName = "mL"; // unit name is "mL"
										}
										elseif($productItem->dimensionUnit == 5)
										{
											$dimensionUnitName = "L"; // unit name is "L"
										}
										elseif($productItem->dimensionUnit == 6)
										{
											$dimensionUnitName = "Feet"; // unit name is "feet"
										}
										else // if there is no value or any other value then
										{
											$dimensionUnitName = ""; // make it an empty string
										}
										
										$tdesc .= "<br><br><b>";
										if(isset($productItem->dimensionLabel) && strlen($productItem->dimensionLabel) > 0) // if any dimension label has been specified
										{
											$tdesc .= $productItem->dimensionLabel." "; // print it with a postfixed space
										}
										$tdesc .= "Dimensions: </b>";
										$isPrintedLength = FALSE;
										$isPrintedBreadth = FALSE;
										$isPrintedHeight = FALSE;
										if(isset($productItem->length) && strlen($productItem->length) > 0 && $productItem->length > 0) // if some length has been inputted in the db
										{
											$tdesc .= "Length ".(($productItem->length > 0)? $productItem->length: "")." ".$dimensionUnitName; // print the length
											$isPrintedLength = TRUE;
										}
										
										if(isset($productItem->breadth) && strlen($productItem->breadth) > 0 && $productItem->breadth > 0) // if some breadth has been inputted in the db
										{
											if($isPrintedLength === TRUE)
											{
												$tdesc .= " x ";
											}
											$tdesc .= "Width ".(($productItem->breadth > 0)? $productItem->breadth: "")." ".$dimensionUnitName; // print the width
											$isPrintedBreadth = TRUE;
										}
										
										if(isset($productItem->height) && strlen($productItem->height) > 0 && $productItem->height > 0) // if some height has been inputted in the db
										{
											if($isPrintedLength === TRUE || $isPrintedBreadth === TRUE)
											{
												$tdesc .= " x ";
											}
											$tdesc .= "Height ".(($productItem->height > 0)? $productItem->height: "")." ".$dimensionUnitName; // print the height
											$isPrintedBreadth = TRUE;
										}
										if(isset($productItem->diameter) && strlen($productItem->diameter) > 0 && $productItem->diameter > 0) // if some diameter has been inputted in the db
										{
											if($isPrintedLength === TRUE || $isPrintedBreadth === TRUE)
											{
												$tdesc .= " x ";
											}
											$tdesc .= "Diameter ".(($productItem->diameter > 0)? $productItem->diameter: "")." ".$dimensionUnitName; // print the diameter
										}
									}
									
									if(isset($productItem->capacityUnit) && strlen($productItem->capacityUnit) > 0)
									{
										$capacityUnitName = NULL;
										if($productItem->capacityUnit == 1) // if the value of capacityUnit is 1 in db
										{
											$capacityUnitName = "mL"; // then set the capacity unit name to "mL"
										}
										elseif($productItem->capacityUnit == 2) // if the value of capacityUnit is 2 in db
										{
										$capacityUnitName = "L"; // then set the capacity unit  name to "L"
										}
										
										if(isset($productItem->capacity) && strlen($productItem->capacity) > 0 && $productItem->capacity > 0) // if some capacity has been inputted in the db
										{
											$tdesc .= "<br><br><b>Capacity: </b>".(($productItem->capacity > 0)? $productItem->capacity: "")." ".$capacityUnitName; // print the length
										}
									}
								}
								if(isset($productData[0]->finish) && strlen($productData[0]->finish) > 0)
								{
									$tdesc .= "<br><br><b>Finish: </b>".$productData[0]->finish;
								}
								if(isset($productData[0]->tech_spec) && strlen($productData[0]->tech_spec) > 0)
								{
									$tdesc .= "<br><br><b>Technical Specifications: </b>".$productData[0]->tech_spec;
								}
								if(isset($productData[0]->material_composition) && strlen($productData[0]->material_composition) > 0)
								{
									$tdesc .= "<br><br><b>Material Composition: </b>".$productData[0]->material_composition;
								}
								if(isset($productData[0]->usage) && strlen($productData[0]->usage) > 0)
								{
									$tdesc .= "<br><br><b>Usage: </b>".$productData[0]->usage;
								}
								if(isset($productData[0]->care) && strlen($productData[0]->care) > 0)
								{
									$tdesc .= "<br><br><b>Care: </b>".$productData[0]->care;
								}
								if(isset($productData[0]->assembly) && strlen($productData[0]->assembly) > 0)
								{
									$tdesc .= "<br><br><b>Assembly: </b>".$productData[0]->assembly;
								}
								if(isset($productData[0]->sellers_assurance) && strlen($productData[0]->sellers_assurance) > 0)
								{
									$tdesc .= "<br><br><b>Seller Assurance: </b>".$productData[0]->sellers_assurance;
								}
								if(isset($productData[0]->additional_info) && strlen($productData[0]->additional_info) > 0)
								{
									$tdesc .= "<br><br><b>Additional Information: </b>".$productData[0]->additional_info;
								}
							}
							/* for description */
							
							$qVData->productDescription = $tdesc;
							$qVData->productFancyCounter = $productData[0]->fancy_counter;
							$qVData->productBragCounter = $productData[0]->brag_counter;
							$qVData->productVisitCounter = $productData[0]->visit_counter;
							$qVData->storeReturnPolicy = $productData[0]->storeReturnPolicy;
							$qVData->storeEMIPolicy = $productData[0]->storeEMIPolicy;
							$qVData->storeCODPolicy = $productData[0]->storeCODPolicy;
							
							$sameCatProducts = $this->async_model->qVSameCatProducts($productData[0]->cat_id, $productData[0]->sub_catid1, $productData[0]->sub_catid2, $productData[0]->sub_catid3);
							/* ============ FOLLOWING CODE BLOCKED TO SHOW THE SAME CATEGORY PRODUCTS ======================= */
							/* ============ INSTEAD OF YOU MIGHT FANCY's OLD LOGIC ========================================== */
							/*$userFanciedProducts = $this->async_model->recentlyFanciedProductsByUsers($userIDs);
							$mightFancyPool = array_merge($sameCatProducts, $userFanciedProducts); // merge arrays to generate the fancy pool
							
							$sorter = array();
							$i = 0;
							foreach($mightFancyPool as $mightFancy) // loop through all objects in the mightFancyPool
							{
								$sorter[sprintf("%d", $i)] = $mightFancy->fancy_counter; // store all the fancy counters
								$i++;
							}
							
							//print "<hr>SORTER (unsorted)<hr><pre>";print_r($sorter);print "</pre>";
							arsort($sorter, SORT_NUMERIC); // sort the array of fancy counters and maintain index associations
							//print "<hr>SORTER (sorted)<hr><pre>";print_r($sorter);print "</pre>";
							*/
							$limiter = 15;
							$i = 0;
							$mightFancyProds = array();
							foreach($sameCatProducts as $key => $value)
							{
								if($i === 0 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID1 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID1 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName1 = $sameCatProducts[intval($key)]->product_name;
									$mightFancyProds[$i] = $qVData->mostFanciedProductID1;
									$i++;
									continue;
								}
								if($i === 1 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID2 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID2 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName2 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID2, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID2; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								if($i === 2 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID3 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID3 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName3 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID3, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID3; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								if($i === 3 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID4 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID4 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName4 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID4, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID4; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								if($i === 4 && $sameCatProducts[intval($key)]->product_id != $productID)
								{
									$qVData->mostFanciedProductID5 = $sameCatProducts[intval($key)]->product_id;
									$qVData->mostFanciedProductStoreID5 = $sameCatProducts[intval($key)]->store_id;
									$qVData->mostFanciedProductName5 = $sameCatProducts[intval($key)]->product_name;
									if(array_search($qVData->mostFanciedProductID5, $mightFancyProds)) // if the current product is already there in the pool that is being sent to the client
									{
										continue; // continue the loop to skip this product
									}
									else
									{
										$mightFancyProds[$i] = $qVData->mostFanciedProductID5; // store the product in the pool being sent to the client for comparison
										$i++; // update the counter
									}
								}
								/*print "<pre>";
								print "\r\n\$i = ".$i;
								print "\r\n\$mightFancyProds = [";print_r($mightFancyProds);print "]";
								print "</pre>";*/
								if($i >= $limiter) // if we have read 5 array values
								{
									break; // break out of the loop
								}
							}
							
							//print "<hr>Might Fancy Pool (After Sorting)<hr><pre>";print_r($mightFancyPool);print "</pre>";
							$filesExistence = array();
							$imgs = array();
							$storeURL = $this->async_model->storeURL();
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/".$productID."/img1_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/".$productID."/img2_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/".$productID."/img3_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/". $productID."/img4_product.jpg";
							$imgs[] = $storeURL."assets/images/stores/".$qVData->storeID."/". $productID."/img5_product.jpg";
							clearstatcache(); // clear file_exists cache
							foreach($imgs as $img)
							{
								$tmpExistence = @file_get_contents($img);
								$tLogMsg = NULL;
								if($tmpExistence === FALSE)
								{
									$filesExistence[] = FALSE;
									$tLogMsg = "File : ".$img." EXISTS";
								}
								else
								{
									$filesExistence[] = TRUE;
									$tLogMsg = "File : ".$img." DOES NOT EXIST";
								}
								log_message("INFO", $__ip." async/qvData: ".$tLogMsg);
							}
							$responseData['hasData'] = TRUE;
							log_message('INFO', "qvData = ".print_r($qvData, TRUE));
							$responseData['qvData'] = $qVData;
							$responseData['variants'] = $this->async_model->qVProductVariants($productID);
							$responseData['filesExistence'] = $filesExistence;
							$responseData['moreStoreProducts'] = $this->async_model->qVSameStoreProducts($productID);
							$responseData['similarProducts'] = $sameCatProducts;
							$responseData['hasFancied'] = $this->async_model->hasFancied($productID);
						}
						else
						{
							$responseData[] = array("hasData" => FALSE);
						}
						$cacheSaved = $this->cache->memcached->save($cacheVariableName, $responseData, 2592000); // cache the product's data for a month
						log_message('INFO', "Status of save product page data in ".$cacheVariableName." for a period of 30 days is: ".json_encode($cacheSaved));
				break;
			case FALSE:	$this->async_model->increaseProductVisitCounter($productID);
						$this->async_model->saveUserProductVisit( $productID );
						$responseData = $cachedData;
				break;
		}
		
		// print the JSON
		//print json_encode($qVData, JSON_FORCE_OBJECT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_NUMERIC_CHECK);
		log_message('INFO', "\$responseData = ".print_r($responseData, TRUE));
		$response = json_encode($responseData, JSON_FORCE_OBJECT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT);
		log_message('INFO', "\$response = ".print_r($response, TRUE));
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function notifyProduct($productID, $email = NULL, $userID = NULL)
	{
		$notifyStatus = $this->async_model->saveNotification($productID, $email, $userID);
		$responseData = array();
		$responseData['notifyProduct'] = $notifyStatus;
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fancyStore($storeID)
	{
		log_message('INFO', 'async/fancyStore/'.$storeID.' fired from '.$this->input->ip_address());
		$responseData = array();
		$responseData['result'] = $this->async_model->fancyStore($storeID);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

}
?>
