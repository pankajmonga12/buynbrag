<?php if( ! defined( 'BASEPATH' ) ) exit('403 Access denied!');
class User_info extends CI_Controller
{
	private $userid = "";

	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_info_model');
		$this->load->model('search_model');
		$this->load->model('badges');
	}

	public function index()
	{
		//Dont delete this function.
		$user_id = $this->session->userdata('id');
		$this->user_detail($user_id);
	}

	function get_user_detail()
	{
		include 'header_for_controller.php';
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		$uid = $this->session->userdata('id');
		//AS
		$this->load->model('friends_follow_model');
		// Badges
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
			}
		}

		//End of Badges
		//Thejas
//                        $data['followers']=$this->friends_follow_model->get_followers($uid);//uid will replace by session id after EOP2
//                        $data['followees']=$this->friends_follow_model->get_followees($uid);
//                        $data['friends']=$this->friends_follow_model->get_friends($uid);
		//END
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
		log_message('Info', "User with user_id=$uid is Editing his profile details.");
		$this->load->view('personal_details', $data);
	}

	function user_detail()
	{
		include 'header_for_controller.php';
		//AS
		$this->load->model('friends_follow_model');
		$uid = $this->session->userdata('id');
		log_message('Info', "User with user_id=$uid is Viewing his profile details.");
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		// Badges
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
			}
		}

		//End of Badges
		//S-> FFF
//                        $this->load->model('friends_follow_model');
//                        $data['followers']=$this->friends_follow_model->get_followers($this->session->userdata('id'));
//                        $data['followees']=$this->friends_follow_model->get_followees($this->session->userdata('id'));
//                        $data['friends']=$this->friends_follow_model->get_friends($this->session->userdata('id'));
		//E-> FFF

		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
		$this->load->view('personal_details_filled', $data);

	}

	function badges()
	{
		include 'header_for_controller.php';
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		$this->load->model('badges');
		$data['badges'] = array();
		$data['visit'] = count($this->badges->myvisitstore($this->session->userdata('id')));
		// Badges
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++)
			{
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}

		//End of Badges
		$data['userinfo'] = $this->user_info_model->userdetails($this->session->userdata('id'));
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
		$this->load->view('badges', $data);

	}

	function badge_friends($uid)
	{
		include 'header_for_controller.php';
		$data['uid'] = $uid;
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		$this->load->model('badges');
		$data['badges'] = array();
		// Badges
		$data['user_badge'] = $this->badges->user_badge($uid);
		if (!empty($data['user_badge']))
		{
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++)
			{
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71)
				{
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72)
				{
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73)
				{
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74)
				{
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75)
				{
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8)
				{
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9)
				{
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
			}
		}

		//End of Badges
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$data['countfprod'] = $this->morder->cfprodCount($uid);
		if($isLoggedIN['status'] === TRUE)
		{
			$this->load->model('friends_follow_model');
			$data['f_status'] = $this->friends_follow_model->f_status($this->session->userdata('id'), $uid); //text for the button of freinds/follow
		}
		$this->load->view('badge_friends', $data);

	}

	function badges_detail()
	{
		include 'header_for_controller.php';
		$this->load->model('badges');
		$data['visit'] = count($this->badges->myvisitstore($this->session->userdata('id')));
		$data['fancyprod'] = count($this->morder->user_fancied_product($this->session->userdata('id')));
		$data['fancystore'] = count($this->morder->user_fancied_stores($this->session->userdata('id')));
		$data['userinfo'] = $this->user_info_model->userdetails($this->session->userdata('id'));
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
		$this->load->view('badges_detail', $data);
	}

	function homepage_afterlogin2()
	{
		include 'header_for_controller.php';
		$this->load->model('user_info_model');
		$this->load->model('poll_model');
		$data['fprodE'] = $this->morder->user_fancied_product(0);
		$data['fprodU'] = $this->morder->alluser_fancied_product();
		$data['userinfo'] = $this->user_info_model->userdetails($this->session->userdata('id'));

//                        //TASTE
//                        $data['mytaste']=$this->user_info_model->getMytaste($this->session->userdata('id'));
//                        $simTags=$data['mytaste'];
//                        $arr2=array();
//                        $products=array();
//                        for($i=0;$i<count($simTags);$i++)
//                        {
//                        $products[$i]=$simTags[$i]->product_id;
//
//
//                        }
//                        for($i=0;$i<count($simTags);$i++)
//                        {
//                        $tags=$simTags[$i]->tags;
//                        $tags1=explode(',', (string)$tags);
//                        $arr2[$i]=$this->user_info_model->getSimilarTasteProducts($products,$tags1);
//
//                        }
//
//                        $mydata2=array();
//                        for($i=0;$i<count($arr2);$i++)
//                        {
//
//                        $arr=$arr2[$i];
//                        for($j=0;$j<count($arr);$j++)
//                        {
//                        $mydata2[$arr[$j]->product_id]=$arr[$j];
//			}
//						//End of taste
		//Fancy - Ananth
		$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
		//var_dump($fancy);
		$fancy_array = array();
		$i = 0;
		foreach ($fancy as $key => $val) {
			foreach ($val as $key => $prod_id) {
				//var_dump ($prod_id);
				$fancy_array[$i] = $prod_id;
				$i++;
			}
		}
		$fancied = array_unique($fancy_array);
		$fancied_prods = array_merge($fancied);
		foreach ($fancied_prods as $f_item) {
			$data['fancied_prods'][$f_item] = 1;
		}
		//thejas poll
		$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
		foreach ($poll_prods as $p_item) {
			$data['poll_prods'][$p_item->product_id] = 1;
		}

		//end thejas
		// END Fancy
//                        } // For Take Taste


		//$data['similarProducts']=$mydata2;

//                        var_dump($data['similarProducts']);
//                        echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaa';
//                        var_dump($data['fprodE']);
//                        echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaa';
//                        var_dump($data['fprodU']);
		$this->load->view('homepage_afterlogin', $data);
	}

	function createPhoto()
	{
		$startUserID = 1;
		$endUserID = 4050;
		$staticSource = "assets/images/default/defmed.jpg";
		for ($i = $startUserID; $i <= $endUserID; $i++) {
			if (!file_exists("assets/images/users/" . $i)) {
				if (mkdir("assets/images/users/" . $i)) {
					print "<p>Created folder: " . "assets/images/users/" . $i . "</p>";
					if (copy($staticSource, "assets/images/users/" . $i . "/" . $i . ".jpg")) {
						print "<p>Copied file: " . "assets/images/users/" . $i . "/" . $i . ".jpg</p>";
					} else {
						print "<p>unable to create file: assets/images/users/" . $i . "/" . $i . ".jpg</p>";
					}
				} else {
					print "<p>Unable to create folder: assets/images/users/" . $i . "</p>";
				}
			}
		}
	}

	function homepage_afterlogin($controller = '', $function = '', $param1 = '', $param2 = '')
	{
		redirect(base_url());
		include 'header_for_controller.php';
		//$this->load->model('user_info_model'); /* commented as already loaded in the constructor */
		//$this->load->model('poll_model'); /* commented as already loaded in header_for_controller.php */
		$this->load->model('fb_model');

		if ($isLoggedIN["status"] === TRUE && !empty($controller)) {
			$url = site_url($controller . '/' . $function . '/' . $param1 . '/' . $param2);
			redirect($url, 'location');
		}

		if($isLoggedIN["status"] === TRUE)
		{
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val) {
				foreach ($val as $key => $prod_id) {
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_prods = array_merge($fancied);
			foreach ($fancied_prods as $f_item) {
				$data['fancied_prods'][$f_item] = 1;
			}
			// END Fancy
			//poll
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item) {
				$data['poll_prods'][$p_item->product_id] = 1;
			}
			//End poll
			$uid = $this->session->userdata('id');
		} else {
			//When Session is empty.
			$this->load->library('user_agent');
			if ($this->agent->is_browser()) {
				//$agent = $this->agent->browser().' '.$this->agent->version();
				$agent = $this->agent->agent_string();
			} elseif ($this->agent->is_robot()) {
				//$agent = $this->agent->robot();
				$agent = $this->agent->robot() . ' [ROBOT] ' . $this->agent->agent_string();
			} elseif ($this->agent->is_mobile()) {
				//$agent = $this->agent->mobile();
				$agent = $this->agent->mobile() . ' [MOBILE USER] ' . $this->agent->agent_string();
			} else {
				$agent = 'Unidentified User Agent in ' . $this->agent->platform();
			}
			$userIp = $this->input->ip_address();
			$locFName = "http://api.hostip.info/get_html.php?ip=" . $userIp;
			$location = file_get_contents($locFName);
			//$userOs = $this->agent->platform();
			log_message('Info', "User has just entered the site from the location: $location and using $agent.");
		}
		$fprod = $this->morder->alluser_fancied_product_optimized2();
		//$data['fprod'] = array_slice($fprod, 0, 10);
		$data['fprod'] = $fprod;
		$data['controller'] = $controller;
		$data['function'] = $function;
		$data['param1'] = $param1;
		$data['param2'] = $param2;
//                       $this->config->load('facebook',TRUE);
//                       $config = $this->config->item('facebook');
//                       $data['app_id']=$config['appId'];
		//$data['red_url_ajax']=$controller.'/'.$function.'/'.$param1.'/'.$param2;
		$this->load->view('homepage_afterlogin', $data);
	}


	//Thejas /uid == others id;/
	//FFF
	function view($uid)
	{
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if ($uid == $this->session->userdata('id'))
		{
			redirect(base_url('user_info/user_detail'));
		}
		include 'header_for_controller.php';
		$data['uid'] = $uid;
		//AS
		$this->load->model('friends_follow_model'); //thejas
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		// Badges
		$data['user_badge'] = $this->badges->user_badge($uid);
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++)
			{
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71)
				{
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72)
				{
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73)
				{
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74)
				{
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75)
				{
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8)
				{
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9)
				{
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
			}
		}

		//End of Badges

		//Thejas(friends n follow feature)
		//add friend, follow,unfollow,unfriend button is clicked
		$self_id = $this->session->userdata('id');
		if($isLoggedIN['status'] === TRUE)
		{
			if ($this->input->post('btn_fnf') == 'Follow')
			{
				$data['f_click'] = $this->friends_follow_model->f_follow($self_id, $uid);
				if ($self_id < $uid) {
					$i = 0;
					$j = 1;
				} else {
					$i = 1;
					$j = 0;
				}

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
				header('Location: ' . base_url() . 'user_info/view/' . $uid);
			}
			
			elseif ($this->input->post('btn_fnf') == 'Add Friend')
			{
				$data['f_click'] = $this->friends_follow_model->f_add($self_id, $uid);
				header('Location: ' . base_url() . 'user_info/view/' . $uid);
			}
			elseif ($this->input->post('btn_fnf') == 'Unfollow')
			{
				$data['f_click'] = $this->friends_follow_model->f_unfollow($self_id, $uid);
				header('Location: ' . base_url() . 'user_info/view/' . $uid);
			} elseif ($this->input->post('btn_fnf') == 'Unfriend')
			{
				$data['f_click'] = $this->friends_follow_model->f_delete($self_id, $uid);
				$data['f_click'] = $this->friends_follow_model->f_delete($uid, $self_id);
				header('Location: ' . base_url() . 'user_info/view/' . $uid);

			}
			else
			{
				$data['f_click'] = "";
			}
			//End IF
			$data['f_status'] = $this->friends_follow_model->f_status($this->session->userdata('id'), $uid); //text for the button of freinds/follow
		}
		$data['followers'] = $this->friends_follow_model->get_followers($uid); //$uid will replace by session id after EOP2
		$data['followees'] = $this->friends_follow_model->get_followees($uid);
		$data['friends'] = $this->friends_follow_model->get_friends($uid);
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
		//end of thejas(friends n follow feature)
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		//when user accessing his page
		if ($this->session->userdata('id') == $uid)
		{
			$this->load->view('personal_details_filled', $data);
		}
		$this->load->view('personal_details_others', $data);
	}

	//End of Thejas

	function save_personal_details()
	{
		//Rajeeb
		$this->load->model('user_info_model');
//                        $aDoor = $this->input->post('check1');
//                        $intrestedin="";
//                        $N = count($aDoor);
//                        for($i=0; $i < $N; $i++)
//                        {
//                            if($intrestedin!="")
//                            {
//                                $intrestedin.=",";
//                                $intrestedin.=(string)$aDoor[$i];
//                            }
//                            else
//                            {
//                                $intrestedin=(string)$aDoor[$i];
//                            }
//                        }
//                            $bday=explode('/', (string)$this->input->post('birth_date'));
//                            $date=$bday[2]."-".$bday[1]."-".$bday[0];
//                            $mydata = array(
//                                      'email'=>$this->input->post('person_email'),
//                                      'nick_name'=>$this->input->post('person_nickname'),
//                                      'gender'=>$this->input->post('sex'),
//                                      'date_of_birth'=>$date,
//                                      'address'=>$this->input->post('street_address'),
//                                      'city'=>$this->input->post('cityName'),
//                                      'state'=>$this->input->post('stateName'),
//                                      'pin'=>$this->input->post('PinCode'),
//                                      'country'=>$this->input->post('countryName'),
//                                      'country_code'=>$this->input->post('country_code'),
//                                      'mob'=>$this->input->post('mobile_no'),
//                                      'about_me'=>$this->input->post('about_me'),
//                                      'interested_in'=>$intrestedin,
//                                      'taste'=>$this->input->post('tastes'),
//                                    );
		$user_id = $this->session->userdata('id');
		$this->user_info_model->savePersonalInfo($user_id);
	}

	function take_taste()
	{
		include 'header_for_controller.php';
		$data['randomProduct'] = $this->user_info_model->getRandomProducts();
		$this->load->view('take_taste_test1', $data);
		//header("location:".$data['base_url']."user_info/personal_details_filled");
	}

	function showMoreProducts()
	{
		include 'header_for_controller.php';
		$data['randomProduct'] = $this->user_info_model->getRandomProducts();
		$this->load->view('showMore', $data);
	}

	function savemytaste()
	{
		include 'header_for_controller.php';
		$arr = $this->input->POST('obj', TRUE);
		$data1['user_id'] = $this->session->userdata('id');
		$this->user_info_model->deleteMyPrevioustaste($data1['user_id']);
		foreach ($arr as $item):
			$data1['product_id'] = $item;
			$this->user_info_model->addMytaste($data1);
		endforeach;
		$newId = $this->user_info_model->getLastRow();
		header("location:" . $data['base_url'] . "user_info/take_taste2");
	}

	function take_taste2()
	{
		include 'header_for_controller.php';
		//$data['userdetails'] = $this->morder->userdetails($this->session->userdata('id'));
		$data['mytaste'] = $this->user_info_model->getMytaste($this->session->userdata('id'));
		$simTags = $data['mytaste'];
		$n = "";
		$arr1 = array();
		$arr2 = array();
		$products = array();
		for ($i = 0; $i < count($simTags); $i++) {
			$products[$i] = $simTags[$i]->product_id;


		}
		for ($i = 0; $i < count($simTags); $i++) {
			$tags = $simTags[$i]->tags;
			$tags1 = explode(',', (string)$tags);
			$arr1[$i] = $this->user_info_model->getSimilarTasteUser($data['user_id'], $tags1);
			$arr2[$i] = $this->user_info_model->getSimilarTasteProducts($products, $tags1);

		}
		$mydata1 = array();
		$mydata2 = array();
		for ($i = 0; $i < count($arr1); $i++) {
			$arr = $arr1[$i];
			for ($j = 0; $j < count($arr); $j++) {

				$mydata1[$arr[$j]->u_id] = $arr[$j]->name;
			}
		}

		for ($i = 0; $i < count($arr2); $i++) {

			$arr = $arr2[$i];
			for ($j = 0; $j < count($arr); $j++) {
				$mydata2[$arr[$j]->product_id] = $arr[$j];


			}
		}


		$data['similarPeople'] = $mydata1;
		$data['similarProducts'] = $mydata2;
		$this->load->view('take_taste_test2', $data);

		//header("location:".$data['base_url']."user_info/personal_details_filled");
	}


	function purchase_history()
	{
		include 'header_for_controller.php';
		$user_id = $this->session->userdata('id');
		$this->load->model('vc_orders');
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		//Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}
		//End of Badges
		$data['userinfo'] = $this->user_info_model->userdetails($user_id);

		$this->load->library('pagination');
		$PagnConfig['base_url'] = base_url('index.php/user_info/purchase_history');
		$PagnConfig['total_rows'] = $this->vc_orders->totalOrdersByUser($this->session->userdata('id'));
		$PagnConfig['per_page'] = 5;
		$PagnConfig['uri_segment'] = 3;
		$PagnConfig["num_links"] = 1;
		$PagnConfig['first_link'] = FALSE;
		$PagnConfig['last_link'] = FALSE;
		$PagnConfig['next_link'] = '>>';
		$PagnConfig['prev_link'] = '<<';
		$PagnConfig['next_tag_open'] = '<span class="pagNumTag nextPage">';
		$PagnConfig['next_tag_close'] = '</span>';
		$PagnConfig['prev_tag_open'] = '<span class="pagNumTag prevPage">';
		$PagnConfig['prev_tag_close'] = '</span>';
		$PagnConfig['num_tag_open'] = '<span class="pagNumTag">';
		$PagnConfig['num_tag_close'] = '</span>';
		$PagnConfig['cur_tag_open'] = '<span class="pagNumTag">';
		$PagnConfig['cur_tag_close'] = '</span>';
		$PagnConfig['anchor_class'] = 'class = "pagAnchor"';
		$this->pagination->initialize($PagnConfig);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['totalOrders'] = $PagnConfig['total_rows'];
		$data['offset'] = $page;
		$data['order'] = $this->vc_orders->getorderedproduct_details($PagnConfig['per_page'], $page);
		$data['links'] = $this->pagination->create_links();
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
//            for($i=0;$i<count($data['order']);$i++) {
//                $data['tot_prods'][$i] = $this->vc_orders->get_stores_totalProducts($data['order'][$i]->store_id);
//            }
		$this->load->view('purchase_history', $data);
	}

	function friend_follow($user1, $user2)
	{
		$this->load->model('friends_follow_model');
		$f_status = $this->friends_follow_model->f_status($user1, $user2);
		if ($f_status[1] == 'Add Friend') {
			$this->friends_follow_model->f_add($user1, $user2);
			header('Location: ' . base_url() . 'order/friend_fancy_product/' . $user2);
		} elseif ($f_status[1] == 'Follow') {
			$this->friends_follow_model->f_follow($user1, $user2);
			header('Location: ' . base_url() . 'order/friend_fancy_product/' . $user2);
		} else
			header('Location: ' . base_url() . 'user_info/view/' . $user2);
	}

	public function invite()
	{
		include 'header_for_controller.php';

		$user_id = $this->session->userdata('id');
		$this->load->model('vc_orders');
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		// Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}
		//End of Badges
		$data['userinfo'] = $this->user_info_model->userdetails($user_id);
		//$data['order'] = $this->vc_orders->getorderedproduct_details();
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
		//for($i=0;$i<count($data['order']);$i++) {
		//    $data['tot_prods'][$i] = $this->vc_orders->get_stores_totalProducts($data['order'][$i]->store_id);
		//}

		$this->load->library('fb_connect');
		$this->config->load('facebook', TRUE);
		$config = $this->config->item('facebook');
		$data['app_id'] = $config['appId'];
		$data['base_url'] = base_url();
		$fb_friends = $this->fb_connect->friends;
		$min = 0;
		$max = count($fb_friends['data']) - 1;
		if ((int)count($fb_friends['data']) > 50)
			$quantity = 50;
		else
			$quantity = (int)count($fb_friends['data']);
		$numbers = range($min, $max);
		shuffle($numbers);
		$data['keys'] = array_slice($numbers, 0, $quantity);
		$data['friends'] = $fb_friends['data'];
		$this->load->view('invite_people_second', $data);
	}

	function mail()
	{
		$base_url = base_url();
		include 'discover_mail.php';
		$this->load->library('email');
		$this->email->from('support@buynbrag.com', 'BuynBrag');
		$this->email->to('shammishailaj@gmail.com');
		$this->email->subject("Curated finds for diwali");
		$this->email->message($msg);
		$this->email->set_newline("\r\n");

		if ($this->email->send())
			echo "ok";
		else
			echo "Wrong";
	}

	public function settings()
	{
		$this->load->view('account');
	}

	public function notification()
	{
		$this->load->view('notification');
	}

	public function password()
	{
		if (isset($_POST['submit'])) {
			$user_id = $this->session->userdata('id');
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
			$this->user_info_model->change_pswd($user_id, $new_password, $confirm_password);
			$this->session->set_flashdata('msg', 'Your password has been changed.');
			redirect('user_info/account_detail');
		}
	}

	public function save_account_details()
	{
		$this->load->model('user_info_model');
		$user_id = $this->session->userdata('id');
		$this->user_info_model->saveaccountInfo($user_id);
	}

	public function account_detail()
	{
		include 'header_for_controller.php';
		$this->load->model('friends_follow_model');
		$uid = $this->session->userdata('id');
		log_message('Info', "User with user_id=$uid is Viewing his profile details.");
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
// Badges
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge']))
		{
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++)
			{
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72)
				{
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73)
				{
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74)
				{
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75)
				{
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8)
				{
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9)
				{
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
			}
		}
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
		$this->load->view('account_detail', $data);
	}

	public function follow_followers()
{
  include "header_for_controller.php";
  $this->load->model('friends_follow_model');
  /* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
  $data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
                       if(!empty($data['user_badge']))
                       {
                           $data['badges'] = array();
                           for($i=0;$i<count($data['user_badge']);$i++)
                           {
                               if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
                                if($data['user_badge'][$i]->badge_type == 71)
                                {
                                    $temp = array( 'img' => "fcat/71/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 72)
                                {
                                    $temp = array( 'img' => "fcat/72/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 73)
                                {
                                    $temp = array( 'img' => "fcat/73/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 74)
                                {
                                    $temp = array( 'img' => "fcat/74/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 75)
                                {
                                    $temp = array( 'img' => "fcat/75/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 8)
                                {
                                    $temp = array( 'img' => "inv/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 9)
                                {
                                    $temp = array( 'img' => "acc/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                           }
                       }
                       
  $uid=$this->session->userdata('id');
  $data['logged_id']=$this->session->userdata('id');
  $data['userinfo'] = $this->user_info_model->userdetails($uid);
  $data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
  
  
 $this->load->view('follow_followers',$data);
}
public function follow_following()
{
  include "header_for_controller.php";
  $this->load->model('friends_follow_model');
  /* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
  $data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
                       if(!empty($data['user_badge']))
                       {
                           $data['badges'] = array();
                           for($i=0;$i<count($data['user_badge']);$i++)
                           {
                                if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
                                if($data['user_badge'][$i]->badge_type == 71)
                                {
                                    $temp = array( 'img' => "fcat/71/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 72)
                                {
                                    $temp = array( 'img' => "fcat/72/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 73)
                                {
                                    $temp = array( 'img' => "fcat/73/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 74)
                                {
                                    $temp = array( 'img' => "fcat/74/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 75)
                                {
                                    $temp = array( 'img' => "fcat/75/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 8)
                                {
                                    $temp = array( 'img' => "inv/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                                if($data['user_badge'][$i]->badge_type == 9)
                                {
                                    $temp = array( 'img' => "acc/".$data['user_badge'][$i]->badge_level.".png" , 'txt' => $data['user_badge'][$i]->notification_text );
                                    array_push($data['badges'], $temp);
                                }
                           }
                       }
                       
  $uid=$this->session->userdata('id');
  $data['logged_id']=$this->session->userdata('id');
  $data['userinfo'] = $this->user_info_model->userdetails($uid);
  $data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
 // $data['followees_detail'] = $this->friends_follow_model->get_followees($uid);
  
  
 $this->load->view('follow_following',$data);
}

}?>
