<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized!');

class fCats
{
	public $catID = NULL;
	public $catName = NULL;
	public $products = array();
}

class Firstlogin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rapiv1/flmodel', 'flmodel');
	}

	public function getHandPickedUsers($pageNumber = 0)
	{
		$responseData = array();
		
		$responseData['data'] = $this->flmodel->readHandPickedUsers($pageNumber);
		
		$response =  json_encode($responseData);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function genHandPickedUsers()
	{
		$this->flmodel->truncateHandPickedUsersTable();
		$users = $this->flmodel->readHandPickedUsersGen();
		$i = 0;
		$batchData = array();
		foreach($users as $user)
		{
			$batchData[] = array
							(
								'user_id'		=>	$user->user_id,
								'full_name'		=>	$user->full_name,
								'rank1'			=>	$user->rank,
								'about_me'		=>	$user->about_me,
								'fb_uid'		=>	$user->fb_uid,
								'gender'		=>	$user->gender,
								'sort_order'	=>	$i,
								'handpickedOn'	=>	time(),
								'handpickedBy'	=>	22,
								'joined_date'	=>	strtotime($user->joined_date),

								'fp1ProductID'	=>	$user->fp1ProductID,
								'fp1StoreID'	=>	$user->fp1StoreID,
								'fp1ProductName'=>	$user->fp1ProductName,

								'fp2ProductID'	=>	$user->fp2ProductID,
								'fp2StoreID'	=>	$user->fp2StoreID,
								'fp2ProductName'=>	$user->fp2ProductName,

								'fp3ProductID'	=>	$user->fp3ProductID,
								'fp3StoreID'	=>	$user->fp3StoreID,
								'fp3ProductName'=>	$user->fp3ProductName,
								
								'fp4ProductID'	=>	$user->fp4ProductID,
								'fp4StoreID'	=>	$user->fp4StoreID,
								'fp4ProductName'=>	$user->fp4ProductName
							);
			$i++;
		}

		switch($this->flmodel->saveHandPickedUsers($batchData))
		{
			case TRUE:	echo "<p> Saved ".$i." users </p>";
				break;
			case FALSE:	echo "<p> Unable to save handpicked users. Dumping data below:</p><pre>".print_r($batchData, TRUE)."</pre>";
				break;
		}
	}

	public function changeUserFlowStatus($rFlowStatus)
	{
		$responseData = array();
		
		$responseData['data'] = $this->flmodel->updateRFlowStatus($rFlowStatus);

		$response =  json_encode($responseData);
		
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function fancy2($productID)
	{
		$listID = ($this->input->post('listID') !== FALSE)? $this->input->post('listID'): NULL;
		$responseData = array();
		//print "<p> running fancy</p>";
		$fancyStatus = $this->flmodel->flFancyProduct($productID, $listID);
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

	public function cats()
	{
		$cats = $this->flmodel->catsData();
		$tmp = array();
		foreach($cats as $cat)
		{
			$tCats = new fCats;
			$tCats->catID = $cat->catID;
			if($tCats->catID == 387)
			{
				$tCats->catName = "Men's Fashion";
			}
			elseif($tCats->catID == 388)
			{
				$tCats->catName = "Women's Fashion";
			}
			elseif($tCats->catID == 18)
			{
				$tCats->catName = "Women's Fashion Accessories";
			}
			elseif($tCats->catID == 14)
			{
				$tCats->catName = "Men's Fashion Accessories";
			}
			elseif($tCats->catID == 32)
			{
				$tCats->catName = "Quirky";
			}
			elseif($tCats->catID == 392)
			{
				$tCats->catName = "Collectibles";
			}
			else
			{
				$tCats->catName = $cat->catName;
			}
			$tCats->products = $this->flmodel->catTopProducts($tCats->catID);

			$tmp[] = $tCats;
		}
		
		$responseData = array();
		$responseData['data'] = $tmp;


		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function saveCatPref($catID)
	{
		$responseData = array();
		$responseData['data'] = NULL;
		
		$userID = $this->session->userdata('id');
		$responseData['isLoggedIN'] = $isLoggedIN = $this->session->userdata('logged_in');

		switch($isLoggedIN === TRUE && $userID !== FALSE && is_numeric($userID))
		{
			case TRUE:	$responseData['data'] = $this->flmodel->saveCatPreference($catID, $userID);
				break;
		}

		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function removeCatPref($catID)
	{
		$responseData = array();
		$responseData['data'] = NULL;
		
		$userID = $this->session->userdata('id');
		$responseData['isLoggedIN'] = $isLoggedIN = $this->session->userdata('logged_in');

		switch($isLoggedIN === TRUE && $userID !== FALSE && is_numeric($userID))
		{
			case TRUE:	$responseData['data'] = $this->flmodel->removeCatPreference($catID, $userID);
				break;
		}

		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
}
?>