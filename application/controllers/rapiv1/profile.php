<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');

class Profile extends CI_Controller
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
		$this->load->model('async_model');
		$this->load->model('rapiv1/profile_model', 'profile_model');
	}
	
	public function info($userID = NULL)
	{
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData["data"] = NULL;
		
		switch($responseData['isLoggedIN'] === TRUE && is_numeric($userID) )
		{
			case TRUE:	$currentUserID = $this->userID;
						switch( $currentUserID == $userID )
						{
							case TRUE:	$currentUserID = NULL;
								break;
						}
						switch( $userID == NULL )
						{
							case TRUE:	$userID = $this->userID;
								break;
						}
						$responseData["data"] = $this->profile_model->basicInfo( $userID, $currentUserID );
				break;
			case FALSE: $currentUserID = $userID;
				break;
		}

		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fancyListDetails($userID = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
			case FALSE: $currentUserID = $userID;
				break;
		}
		$responseData["data"] = $this->profile_model->fancyListDetails($currentUserID, $isLoggedIN['id']);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	// public function infoLite($userID = NULL)
	// {
	// 	$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
	// 	$currentUserID = NULL;
	// 	$responseData = array();
	// 	$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
	// 	switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
	// 	{
	// 		case TRUE: $currentUserID = $isLoggedIN['id'];
	// 			break;
	// 		case FALSE: $currentUserID = $userID;
	// 			break;
	// 	}
	// 	$responseData["data"] = $this->profile_model->basicInfo($currentUserID, $isLoggedIN['id'], TRUE); // pass a second argument of TRUE to get the data in lite version
	// 	$response = json_encode($responseData);
	// 	$this->output->set_content_type('application/json');
	// 	$this->output->set_output($response);
	// }

	public function fancyPage($userID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		$responseData["data"] = $this->profile_model->fancyPageData($userID, $currentUserID, $startFrom, $maxResults);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fancyPageFull($userID = NULL, $reloadFromDB = 0)
	{
		log_message('INFO', "/rapiv1/profile/fancyPageFull fired by someone from ".$this->input->ip_address());
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		log_message('INFO', "\$isLoggedIN = ".print_r($isLoggedIN, TRUE));
		log_message('INFO', "Params passed: \$userID = ".$userID.", \$reloadFromDB = ".$reloadFromDB);
		$currentUserID = NULL;
		$response = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		$this->load->driver('cache');
		$cacheVariableName = "profile__fancyPageFull__".$userID;
		$cachedData = $this->cache->memcached->get($cacheVariableName);
		switch($cachedData === FALSE || $reloadFromDB == 1)
		{
			case TRUE: $responseData["data"] = $this->profile_model->fancyPageDataFull($userID, $currentUserID);
						$response = json_encode($responseData);
						if($reloadFromDB == 1 && $cachedData !== FALSE) // if we need to reload from the DB
						{												//  and we have some data already in the cache
							$this->cache->memcached->delete($cacheVariableName); // delete old data in memcached
						}
						$savedCache = $this->cache->memcached->save($cacheVariableName, $response, 2592000); // cache for one month
						log_message('INFO', "Save status of profile/fancyPageFull for userID ".$userID." is ".json_encode($savedCache));
				break;
			case FALSE: $response = $cachedData;
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function fancyList($userID, $fancyListID = NULL, $startFrom = 0, $maxResults = NULL)
	{
		log_message('INFO', "/rapiv1/profile/fancyList fired by someone from ".$this->input->ip_address());
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		log_message('INFO', "\$isLoggedIN = ".print_r($isLoggedIN, TRUE));
		log_message('INFO', "Params passed: \$userID = ".$userID.", \$fancyListID = ".$fancyListID);
		$currentUserID = NULL;
		$response = NULL;
		$reloadFromDB = 1;
		$responseData = array();
		// $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE )
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		$cachedData = FALSE;
		//$this->load->driver('cache');
		//$cacheVariableName = "profile__fancyList__".$userID."__".$fancyListID;
		//$cachedData = $this->cache->memcached->get($cacheVariableName);
		switch($cachedData === FALSE || $reloadFromDB == 1)
		{
			case TRUE: $responseData = $this->profile_model->fancyListData($userID, $currentUserID, $fancyListID, $startFrom, $maxResults);
						$response = json_encode($responseData);
						//if($reloadFromDB == 1 && $cachedData !== FALSE) // if we need to reload from the DB
						//{												//  and we have some data already in the cache
						//	$this->cache->memcached->delete($cacheVariableName); // delete old data in memcached
						//}
						//$savedCache = $this->cache->memcached->save($cacheVariableName, $response, 2592000); // cache for one month
						//log_message('INFO', "Save status of profile/fancyPageFull for userID ".$userID." is ".json_encode($savedCache));
				break;
			case FALSE: $response = $cachedData;
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fancyLists($userID, $startFrom = 0, $maxResults = NULL)
	{
		log_message('INFO', "/rapiv1/profile/fancyLists fired by someone from ".$this->input->ip_address());
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		log_message('INFO', "\$isLoggedIN = ".print_r($isLoggedIN, TRUE));
		log_message('INFO', "Params passed: \$userID = ".$userID);
		$response = NULL;
		$reloadFromDB = 1;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		$responseData["data"] = NULL;

		$cachedData = FALSE;
		//$this->load->driver('cache');
		//$cacheVariableName = "profile__fancyList__".$userID."__".$fancyListID;
		//$cachedData = $this->cache->memcached->get($cacheVariableName);
		switch($cachedData === FALSE || $reloadFromDB == 1)
		{
			case TRUE: $responseData["data"] = $this->profile_model->fancyListsData($userID, $startFrom, $maxResults);
						$response = json_encode($responseData);
						//if($reloadFromDB == 1 && $cachedData !== FALSE) // if we need to reload from the DB
						//{												//  and we have some data already in the cache
						//	$this->cache->memcached->delete($cacheVariableName); // delete old data in memcached
						//}
						//$savedCache = $this->cache->memcached->save($cacheVariableName, $response, 2592000); // cache for one month
						//log_message('INFO', "Save status of profile/fancyPageFull for userID ".$userID." is ".json_encode($savedCache));
				break;
			case FALSE: $response = $cachedData;
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function friends($userID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		$responseData["data"] = $this->profile_model->friendsData($userID, $isLoggedIN['id'], $startFrom, $maxResults);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function followers($userID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		$responseData["data"] = $this->profile_model->followersData($userID, $isLoggedIN['id'], $startFrom, $maxResults);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function following($userID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		log_message('INFO', 'rapiv1/profile/following currentUserID = '.$isLoggedIN['id']);
		$responseData["data"] = $this->profile_model->followingData($userID, $isLoggedIN['id'], $startFrom, $maxResults);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function follow($userID, $userToFollow)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		$responseData["data"] = $this->profile_model->follow($userID, $userToFollow);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function unFollow($userID, $userToUnFollow)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$currentUserID = NULL;
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		switch($isLoggedIN['isLoggedIN'] === TRUE && $userID === NULL)
		{
			case TRUE: $currentUserID = $isLoggedIN['id'];
				break;
		}
		$responseData["data"] = $this->profile_model->unFollow($userID, $userToUnFollow);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function saveNewPassword()
	{
		$currentPassword = ($this->input->post('curPw') !== FALSE || strcmp($this->input->post('curPw'), '') === 0)? $this->input->post('curPw') : NULL;
		$newPassword = ($this->input->post('newPw') !== FALSE || strcmp($this->input->post('newPw'), '') === 0)? $this->input->post('newPw') : NULL;
		$confirmPassword = ($this->input->post('cnfNewPw') !== FALSE || strcmp($this->input->post('cnfNewPw'), '') === 0)? $this->input->post('cnfNewPw') : NULL;

		$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['data'] = NULL;
		switch( $this->isReallyLoggedIN === TRUE )
		{
			case TRUE: $responseData['data'] = $this->profile_model->changePassword( $this->userID, $currentPassword, $newPassword, $confirmPassword );
				break;
		}
		$response = json_encode( $responseData );
		$this->output->set_content_type( 'application/json' );
		$this->output->set_output( $response );
	}

	public function saveUserDetails()
	{
		$fullName = ($this->input->post('fName') !== FALSE || strcmp($this->input->post('fName'), '') === 0)? $this->input->post('fName') : NULL;
		$dd = ($this->input->post('dd') !== FALSE || strcmp($this->input->post('dd'), '') === 0)? $this->input->post('dd') : NULL;
		$mm = ($this->input->post('mm') !== FALSE || strcmp($this->input->post('mm'), '') === 0)? $this->input->post('mm') : NULL;
		$yyyy = ($this->input->post('yyyy') !== FALSE || strcmp($this->input->post('yyyy'), '') === 0)? $this->input->post('yyyy') : NULL;
		$sex = ($this->input->post('sex') !== FALSE || strcmp($this->input->post('sex'), '') === 0)? $this->input->post('sex') : NULL;
		$city = ($this->input->post('city') !== FALSE || strcmp($this->input->post('city'), '') === 0)? $this->input->post('city') : NULL;
		$cc = ($this->input->post('cc') !== FALSE || strcmp($this->input->post('cc'), '') === 0)? $this->input->post('cc') : NULL;

		$detailsArray = array('fullName' => $fullName, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yyyy, 'sex' => $sex, 'city' => $city, 'cc' => $cc);

		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		$responseData['data'] = NULL;
		switch($isLoggedIN['isLoggedIN'] === TRUE)
		{
			case TRUE: $responseData['data'] = $this->profile_model->saveUserDetails($isLoggedIN['id'], $detailsArray);
				break;
		}
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function saveNewUserDetails($userID)
	{
		$fullName = ($this->input->post('fName') !== FALSE || strcmp($this->input->post('fName'), '') === 0)? $this->input->post('fName') : NULL;
		$dd = ($this->input->post('dd') !== FALSE || strcmp($this->input->post('dd'), '') === 0)? $this->input->post('dd') : NULL;
		$mm = ($this->input->post('mm') !== FALSE || strcmp($this->input->post('mm'), '') === 0)? $this->input->post('mm') : NULL;
		$yyyy = ($this->input->post('yyyy') !== FALSE || strcmp($this->input->post('yyyy'), '') === 0)? $this->input->post('yyyy') : NULL;
		$sex = ($this->input->post('sex') !== FALSE || strcmp($this->input->post('sex'), '') === 0)? $this->input->post('sex') : NULL;
		$city = ($this->input->post('city') !== FALSE || strcmp($this->input->post('city'), '') === 0)? $this->input->post('city') : NULL;
		$cc = ($this->input->post('cc') !== FALSE || strcmp($this->input->post('cc'), '') === 0)? $this->input->post('cc') : NULL;

		$detailsArray = array('fullName' => $fullName, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yyyy, 'sex' => $sex, 'city' => $city, 'cc' => $cc);

		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		$responseData['data'] = NULL;
		$responseData['data'] = $this->profile_model->saveUserDetails($userID, $detailsArray);
		
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function saveUserCity()
	{
		$city = ($this->input->post('city') !== FALSE || strcmp($this->input->post('city'), '') === 0)? $this->input->post('city') : NULL;

		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
		$responseData = array();
		$responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
		$responseData['data'] = NULL;
		switch($isLoggedIN['isLoggedIN'] === TRUE)
		{
			case TRUE: $responseData['data'] = $this->profile_model->saveUserCity($isLoggedIN['id'], $city);
				break;
		}
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

    public function saveUserAboutMe()
    {
        $aboutMe = ($this->input->post('aboutMe') !== FALSE || strcmp($this->input->post('aboutMe'), '') === 0)? $this->input->post('aboutMe') : NULL;

        $isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE)
        {
            case TRUE: $responseData['data'] = $this->profile_model->saveAboutMe($isLoggedIN['id'], $aboutMe);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
    }

	public function suggestPeopleToFollow()
	{
		$responseData = array();
		$responseData['data'] = $this->profile_model->suggestPeopleToFollowData();
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fancy($userID) // a JFF function to redirect to a user's facebook profile
	{
		$ud = $this->profile_model->jffFancy($userID);
		if(!is_null($ud))
		{
			$redirURL = "https://www.facebook.com/".$ud->fb_uid;
			redirect($redirURL);
		}
		else
		{
			echo "<p>The user with ID ".$userID." does not appear to be coming from facebook. <a href=\"javascript:history.go(-1)\">Click here</a> to go back.</p>";
		}
	}

	public function saveUserStyleTags()
	{
		$tags = $this->input->post('sTags') !== FALSE ? $this->input->post('sTags') : NULL;
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $tags !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->saveStyleTags($isLoggedIN['id'], $tags);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function saveFancyList()
	{
		$listName = $this->input->post('listName') !== FALSE ? $this->input->post('listName') : NULL;
		$listDesc = $this->input->post('listDesc') !== FALSE ? $this->input->post('listDesc') : NULL;
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $listName !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->saveFancyList($isLoggedIN['id'], $listName, $listDesc);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function updateFancyListName()
	{
		$listID = $this->input->post('listID') !== FALSE ? $this->input->post('listID') : NULL;
		$listName = $this->input->post('listName') !== FALSE ? $this->input->post('listName') : NULL;

		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $listName !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->updateFancyListName($isLoggedIN['id'], $listID, $listName);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function saveFancyListDescription()
	{
		$listID = $this->input->post('listID') !== FALSE ? $this->input->post('listID') : NULL;
		$listDesc = $this->input->post('listDesc') !== FALSE ? $this->input->post('listDesc') : NULL;
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $listID !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->saveFancyListDescription($isLoggedIN['id'], $listID, $listDesc);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function moveToFancyList()
	{
		$fromListID = $this->input->post('fromListID') !== FALSE ? $this->input->post('fromListID') : NULL;
		$toListID = $this->input->post('toListID') !== FALSE ? $this->input->post('toListID') : NULL;
		$productID = $this->input->post('productID') !== FALSE ? $this->input->post('productID') : NULL;
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $fromListID !== NULL && $toListID !== NULL && $productID !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->moveToFancyList($isLoggedIN['id'], $fromListID, $toListID, $productID);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function deleteFancyList()
	{
		$listID = $this->input->post('listID') !== FALSE ? $this->input->post('listID') : NULL;
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $listID !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->deleteFancyList($isLoggedIN['id'], $listID);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function genProductTags()
	{
		/*
		VERSION 1
		$tags = $this->profile_model->readTags();
		$uniqueTags = array();
		foreach($tags as $tagLine)
		{
			$tagLine = trim($tagLine->style);
			$tempTags = explode(",", $tagLine);
			foreach($tempTags as $tempTag)
			{
				$tempTag = trim($tempTag);
				$uniqueTags[] = $tempTag;
			}
		}

		$uniqueTags = array_unique($uniqueTags);
		$this->load->driver('cache');
		$this->cache->memcached->delete('uniqueProfileTags');
		$cacheSaved = $this->cache->memcached->save("uniqueProfileTags", $uniqueTags, 2592000); // cache the product's data for a month
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array("saved" => $cacheSaved, 'uniqueTags' => $uniqueTags, 'tags' => $tags)));

		VERSION 1.1
		*/
		$tags = $this->profile_model->readDBTags();
		$this->load->driver('cache');
		$this->cache->memcached->delete('uniqueProfileTags');
		$cacheSaved = $this->cache->memcached->save("uniqueProfileTags", $tags, 2592000); // cache the product's data for a month
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array("saved" => $cacheSaved, 'uniqueTags' => $tags)));
	}

	public function getTags()
	{
		$this->load->driver('cache');
		$readCache = $this->cache->memcached->get('uniqueProfileTags');
		switch($readCache === FALSE)
		{
			case TRUE:	$this->genProductTags();
						$readCache = $this->cache->memcached->get('uniqueProfileTags');
				break;
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($readCache));
	}

	public function saveUserStyleTag($styleID = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $styleID !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->saveStyleTag($isLoggedIN['id'], $styleID);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function getUserStyleTags($userID = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($userID !== NULL && is_numeric($userID))
        {
        	case TRUE:	$isLoggedIN['id'] = $userID; // if a userID was provided, override the computed value
        		break;
        }
        
        $responseData['data'] = $this->profile_model->readUserStyleTags($isLoggedIN['id']);
        
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function removeUserStyleTag($styleID = NULL)
	{
		$isLoggedIN = $this->async_model->isLoggedINViaFacebook();
        $responseData = array();
        $responseData['isLoggedIN'] = $isLoggedIN['isLoggedIN'];
        $responseData['data'] = NULL;
        switch($isLoggedIN['isLoggedIN'] === TRUE && $styleID !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->deleteStyleTag($isLoggedIN['id'], $styleID);
                break;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function deleteUser($level = 0)
	{
		switch($level)
		{
			case 0:	echo "<form action=\"".base_url()."/rapiv1/profile/deleteUser/1\" method=\"POST\"><p><input type=\"text\" name=\"email\"></p><p><input type=\"password\" name=\"password\"></p><p><input type=\"submit\" value=\"Delete User\"></p></form>";
				break;
			case 1:	$email = $this->input->post('email') !== FALSE ? $this->input->post('email') : NULL;
					$password = $this->input->post('password') !== FALSE ? $this->input->post('password') : NULL;
					if($password === 'szzdell')
					{
						$result = $this->profile_model->deleteUser($email);
						echo "<p>Result is<p><hr/><pre>".print_r($result, TRUE)."</pre>";
					}
					else
					{
						echo "<p style=\"color:red\">Wrong Password</p>";
						echo "<form action=\"".base_url()."/rapiv1/profile/deleteUser/1\" method=\"POST\"><p><input type=\"text\" name=\"email\"></p><p><input type=\"password\" name=\"password\"></p><p><input type=\"submit\" value=\"Delete User\"></p></form>";
					}
		}
	}

	public function inFancyList($productID = NULL)
	{
        $responseData = array();
        $responseData['isLoggedIN'] = $this->isReallyLoggedIN;
        $responseData['data'] = NULL;

        switch($responseData['isLoggedIN'] === TRUE && $productID !== NULL)
        {
            case TRUE: $responseData['data'] = $this->profile_model->checkProductFancyListID($this->userID, $productID);
                break;
        }
        
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function joinedIN( $numberOfDays = NULL )
	{
        $responseData = array();
        $responseData['isLoggedIN'] = $this->isReallyLoggedIN;
        $responseData['isValid'] = FALSE;
        $responseData['data'] = NULL;
        
        switch($responseData['isLoggedIN'] === TRUE && $numberOfDays !== NULL && is_numeric( $numberOfDays ) )
        {
            case TRUE:	$responseData['isValid'] = TRUE;

            			$startDate =date('Y-m-d', strtotime("-".$numberOfDays." day") );
					    $endDate = date('Y-m-d');

					    $responseData['data'] = $this->profile_model->usersJoinedBetween( $startDate, $endDate );
					    log_message( 'DEBUG', "DATA RETUNED FROM rapiv1/profile_model/usersJoinedBetween(".$startDate.", ".$endDate.") is:\r\n".$responseData['data']);
                break;
        }

	    $response = json_encode( $responseData );
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}

	public function visits( $userID = NULL )
	{
        $responseData = array();
        $responseData['isLoggedIN'] = $this->isReallyLoggedIN;
        $responseData['isValid'] = FALSE;
        $responseData['data'] = NULL;

        switch( $userID === NULL || !is_numeric( $userID ) )
        {
        	case TRUE:	$userID = $this->userID;
        		break;
        	case FALSE:	$userID = NULL;
        		break;
        }
        
        switch($responseData['isLoggedIN'] === TRUE && $userID !== NULL && is_numeric( $userID ) )
        {
            case TRUE:	$responseData['isValid'] = TRUE;

            			$responseData['data'] = $this->profile_model->visitors( $userID );
                break;
        }

	    $response = json_encode( $responseData );
        $this->output->set_content_type('application/json');
        $this->output->set_output($response);
	}
}
?>