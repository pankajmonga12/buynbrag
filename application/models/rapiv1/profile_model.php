<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');
class Profile_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function basicInfo($userID, $currentUserID)
	{
		log_message('INFO', "rapiv1/profile_model/basicInfo fired from ".$this->input->ip_address());
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		/* Queries being used
		SELECT
		ud.full_name AS userFullName,
		ud.joined_date as userJoinedDate,
		(SELECT COUNT(*) FROM fancy_products f1 WHERE f1.user_id = ud.user_id) AS totalFanciedProducts,
		(select sum(badge_level) from badges where user_id = ud.user_id) AS totalBadges,
		FROM user_details ud
		WHERE ud.user_id = $userID

		SELECT
		badges.badge_type AS badgeType,
		badges.badge_level AS badgeLevel,
		badges.notification_text AS badgeNotificationText
		FROM badges
		WHERE user_id = $userID

		SELECT
		fl.fancy_list_id AS fancyListID,
		fl.fancy_list_name AS fancyListName,
		FROM fancy_list
		WHERE fl.user_id = $userID

		SELECT
		COUNT(f_no)
		FROM follow_friends ff1
		WHERE followee_id = $userID AND f_type = 0;
		*/
		$retVal = array();
		$retVal['userInfo'] = NULL;
		$retVal['badgesData'] = NULL;
		$retVal['fancyListsData'] = NULL;

		if($userID === NULL)
		{
			return $retVal;
		}

		log_message('INFO', "userID(the one being visited) = ".$userID.", currentUserID(visitor) = ".$currentUserID );

		if( $userID != $currentUserID && $currentUserID != 0)
		{
			log_message('INFO', "writing profile visitor data to DB");
			$this->db->trans_start();
			$q1SQL = "INSERT INTO `profile_visits`(`user_id`, `visitor_id`) VALUES(".$userID.", ".$currentUserID.")";
			$q2SQL = "UPDATE user_details SET profile_visit_counter = profile_visit_counter + 1 WHERE user_id = ".$userID;
			$this->db->query($q1SQL);
			log_message("INFO", "JUST updated the profile visitor information for userID ".$userID.". Affected rows = ".$this->db->affected_rows() );
			$this->db->query($q2SQL);
			log_message("INFO", "JUST updated the profile visit counter userID ".$userID.". Affected rows = ".$this->db->affected_rows() );
			$this->db->trans_complete();
		}
		
		$this->db->select('ud.full_name AS userFullName');
		$this->db->select('ud.fb_uid AS userFBID');
		$this->db->select('ud.city AS userCity');
		$this->db->select('ud.bbucks AS bbucks');
		$this->db->select('ud.tw_uid AS userTwitterID');
		$this->db->select('ud.gender AS userGender');
		$this->db->select('ud.about_me AS userAboutMe');
		$this->db->select('ud.interested_in AS userStyleTags');
		$this->db->select('ud.userRank AS userRank');
		$this->db->select('ud.email AS userEmailAddress');
		$this->db->select('ud.date_of_birth AS userDOB');
		$this->db->select('ud.country AS userCountry');
		$this->db->select('ud.country_code AS userCC');
		$this->db->select('ud.joined_date as userJoinedDate');
		$this->db->select('ud.fancy_counter AS totalFanciedProducts');
		$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE followee_id = '.$userID.') as totalFollowers');
		$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE follower_id = '.$userID.') as totalFollowing');
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 where ff2.follower_id = '.$currentUserID.' and ff2.followee_id = '.$userID.'), TRUE, FALSE)) AS hasFollowed', FALSE);
		$this->db->select('(SELECT SUM(badge_level) FROM badges WHERE user_id = ud.user_id) AS totalBadges');
		$this->db->select("(SELECT COUNT(f1.product_id) FROM fancy_products f1 JOIN fancy_products f2 ON f1.product_id = f2.product_id WHERE f1.user_id  = ".$currentUserID." AND f2.user_id = ".$userID." ORDER BY f1.product_id) AS totalMutualProducts");
		$this->db->select('( SELECT COUNT(fancy_list_id) FROM fancy_list WHERE user_id = '.$userID.' LIMIT 1 ) AS fancyListCount');

		$this->db->from('user_details ud');

		$this->db->where("ud.user_id = ".$userID);

		$query1 = $this->db->get();

		log_message('INFO', "LAST QUERY_______".$this->db->last_query() );
		switch($query1->num_rows > 0)
		{
			case TRUE: $retVal['userInfo'] = $query1->result();
				break;
		}

		/*$this->db->select('badges.badge_type AS badgeType');
		$this->db->select('badges.badge_level AS badgeLevel');
		$this->db->select('badges.notification_text AS badgeNotificationText');
		$this->db->from('badges');
		$this->db->where("user_id = ".$userID);
		$query2 = $this->db->get();
		switch($query2->num_rows > 0)
		{
			case TRUE: $retVal['badgesData'] = $query2->result();
				break;
		}*/


		return $retVal;
	}

	public function fancyListDetails($userID, $currentUserID) {
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		$retVal = array();
		$retVal['fancyListsData'] = NULL;

		if($userID === NULL) {
			return $retVal;
		}

		$this->db->select('fl.fancy_list_id AS fancyListID');
		$this->db->select('fl.fancy_list_name AS fancyListName');
		$this->db->select('fl.description AS fancyListDescription');
		$this->db->select('(SELECT COUNT(fp.product_id) FROM fancy_products fp WHERE fp.user_id = '.$userID.' AND fp.fancy_list_id = fl.fancy_list_id) as totalFanciedProducts', FALSE);
		$this->db->from('fancy_list fl');
		$this->db->where("fl.user_id = ".$userID);
		$query3 = $this->db->get();
		switch($query3->num_rows > 0)
		{
			case TRUE: $retVal['fancyListsData'] = $query3->result();
				break;
		}

		return $retVal;
	}

	public function fancyPageData($userID = NULL, $currentUserID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		log_message('INFO', "rapiv1/profile_model/fancyPageData fired from ".$this->input->ip_address());
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		$startFrom = ($startFrom === NULL)? 0: $startFrom;
		$maxResults = ($maxResults === NULL)? 15: $maxResults;
		log_message('INFO', "After the requisite computations, userID = ".$userID.", currentUserID = ".$currentUserID.", startFrom = ".$startFrom.", maxResults = ".$maxResults);
		switch($userID === NULL)
		{
			case TRUE: return NULL;
				break;
		}
		/*
		* Query being used:
		SELECT
		DISTINCT(f2.product_id) as productID,
		ud.full_name AS userFullName,
		ud.joined_date joinedDate,
		p1.store_id AS storeID,
		p1.product_name AS productName,
		si.store_name AS storeName,
		p1.fancy_counter AS productFancyCounter,
		(SELECT COUNT(*) FROM fancy_products f1 WHERE f1.user_id = ud.user_id) AS totalFanciedProducts,
		(IF((SELECT COUNT(*) FROM fancy_products f3 WHERE (f3.user_id = '%' AND f3.product_id = p1.product_id)), TRUE, FALSE)) AS hasFancied,
		fl.fancy_list_name AS fancyListName,
		fl.fancy_list_id AS fancyListID
		FROM fancy_products f2
		RIGHT JOIN products p1 ON p1.product_id = f2.product_id
		RIGHT JOIN user_details ud ON ud.user_id = f2.user_id
		RIGHT JOIN store_info si ON si.store_id = p1.store_id
		RIGHT JOIN fancy_list fl ON fl.fancy_list_id = f2.fancy_list_id
		WHERE f2.user_id = 141
		LIMIT 15 OFFSET 0;
		*/
		$this->db->select('DISTINCT(f2.product_id) as productID');
		//$this->db->select('ud.full_name AS userFullName');
		//$this->db->select('ud.joined_date joinedDate');
		$this->db->select('p1.store_id AS storeID');
		$this->db->select('p1.product_name AS productName');
		$this->db->select('si.store_name AS storeName');
		$this->db->select('p1.fancy_counter AS productFancyCounter');
		//$this->db->select('(SELECT COUNT(*) FROM fancy_products f1 WHERE f1.user_id = ud.user_id) AS totalFanciedProducts');
		$this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f3 WHERE (f3.user_id = ".$currentUserID." AND f3.product_id = p1.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
		$this->db->select('fl.fancy_list_id AS fancyListID');
		$this->db->from('fancy_products f2');
		$this->db->join('products p1', 'p1.product_id = f2.product_id', 'right');
		//$this->db->join('user_details ud', 'ud.user_id = f2.user_id', 'right');
		$this->db->join('store_info si', 'si.store_id = p1.store_id', 'right');
		$this->db->join('fancy_list fl', 'fl.fancy_list_id = f2.fancy_list_id', 'right');
		$this->db->where('f2.user_id', $userID);
		$this->db->order_by('time', 'desc');
		$this->db->limit($maxResults, $startFrom * $maxResults);

		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY_______\r\n\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function fancyPageDataFull($userID = NULL, $currentUserID = NULL)
	{
		log_message('INFO', "rapiv1/profile_model/fancyPageData fired from ".$this->input->ip_address());
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		log_message('INFO', "After the requisite computations, userID = ".$userID.", currentUserID = ".$currentUserID);
		switch($userID === NULL)
		{
			case TRUE: return NULL;
				break;
		}
		/*
		* Query being used:
		SELECT
		DISTINCT(f2.product_id) as productID,
		ud.full_name AS userFullName,
		ud.joined_date joinedDate,
		p1.store_id AS storeID,
		p1.product_name AS productName,
		si.store_name AS storeName,
		p1.fancy_counter AS productFancyCounter,
		(SELECT COUNT(*) FROM fancy_products f1 WHERE f1.user_id = ud.user_id) AS totalFanciedProducts,
		(IF((SELECT COUNT(*) FROM fancy_products f3 WHERE (f3.user_id = '%' AND f3.product_id = p1.product_id)), TRUE, FALSE)) AS hasFancied,
		fl.fancy_list_name AS fancyListName,
		fl.fancy_list_id AS fancyListID
		FROM fancy_products f2
		RIGHT JOIN products p1 ON p1.product_id = f2.product_id
		RIGHT JOIN user_details ud ON ud.user_id = f2.user_id
		RIGHT JOIN store_info si ON si.store_id = p1.store_id
		RIGHT JOIN fancy_list fl ON fl.fancy_list_id = f2.fancy_list_id
		WHERE f2.user_id = 141;
		*/
		$this->db->select('DISTINCT(f2.product_id) as productID');
		//$this->db->select('ud.full_name AS userFullName');
		//$this->db->select('ud.joined_date joinedDate');
		$this->db->select('p1.store_id AS storeID');
		$this->db->select('p1.product_name AS productName');
		$this->db->select('si.store_name AS storeName');
		$this->db->select('p1.fancy_counter AS productFancyCounter');
		//$this->db->select('(SELECT COUNT(*) FROM fancy_products f1 WHERE f1.user_id = ud.user_id) AS totalFanciedProducts');
		$this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f3 WHERE (f3.user_id = ".$currentUserID." AND f3.product_id = p1.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
		$this->db->select('fl.fancy_list_id AS fancyListID');
		$this->db->from('fancy_products f2');
		$this->db->join('products p1', 'p1.product_id = f2.product_id', 'right');
		//$this->db->join('user_details ud', 'ud.user_id = f2.user_id', 'right');
		$this->db->join('store_info si', 'si.store_id = p1.store_id', 'right');
		$this->db->join('fancy_list fl', 'fl.fancy_list_id = f2.fancy_list_id', 'right');
		$this->db->where('f2.user_id', $userID);
		$this->db->order_by('time', 'desc');

		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY_______\r\n\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function fancyListData($userID = NULL, $currentUserID = NULL, $fancyListID = NULL, $startFrom = 0, $maxResults = NULL)
	{
		log_message('INFO', "rapiv1/profile_model/fancyPageData fired from ".$this->input->ip_address());
		$this->slog->write( array('level' => 1, "msg" => "rapiv1/profile_model/fancyPageData fired") );
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		log_message('INFO', "After the requisite computations, userID = ".$userID.", currentUserID = ".$currentUserID);
		$startFrom = ($startFrom === NULL)? 0: $startFrom;
		$maxResults = ($maxResults === NULL)? 24: $maxResults;
		switch($userID === NULL)
		{
			case TRUE: return NULL;
				break;
		}
		/*
		* Query being used:
		SELECT
		DISTINCT(f2.product_id) as productID,
		ud.full_name AS userFullName,
		ud.joined_date joinedDate,
		p1.store_id AS storeID,
		p1.product_name AS productName,
		si.store_name AS storeName,
		p1.fancy_counter AS productFancyCounter,
		(SELECT COUNT(*) FROM fancy_products f1 WHERE f1.user_id = ud.user_id) AS totalFanciedProducts,
		(IF((SELECT COUNT(*) FROM fancy_products f3 WHERE (f3.user_id = '%' AND f3.product_id = p1.product_id)), TRUE, FALSE)) AS hasFancied,
		fl.fancy_list_name AS fancyListName,
		fl.fancy_list_id AS fancyListID
		FROM fancy_products f2
		RIGHT JOIN products p1 ON p1.product_id = f2.product_id
		RIGHT JOIN user_details ud ON ud.user_id = f2.user_id
		RIGHT JOIN store_info si ON si.store_id = p1.store_id
		RIGHT JOIN fancy_list fl ON fl.fancy_list_id = f2.fancy_list_id
		WHERE f2.user_id = 141 AND fl.fancy_list_id = 22;
		*/
		$this->db->select('DISTINCT(f2.product_id) as productID');
		//$this->db->select('ud.full_name AS userFullName');
		//$this->db->select('ud.joined_date joinedDate');
		$this->db->select('p1.store_id AS storeID');
		$this->db->select('p1.product_name AS productName');
		//$this->db->select('si.store_name AS storeName');
		$this->db->select('p1.fancy_counter AS productFancyCounter');
		//$this->db->select('(SELECT COUNT(*) FROM fancy_products f1 WHERE f1.user_id = ud.user_id) AS totalFanciedProducts');
		$this->db->select("(IF((SELECT COUNT(product_id) FROM fancy_products f3 WHERE (f3.user_id = ".$currentUserID." AND f3.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
		$this->db->select('f2.fancy_list_id AS fancyListID');
		$this->db->from('fancy_products f2');
		$this->db->join('products p1', 'p1.product_id = f2.product_id', 'right');
		//$this->db->join('user_details ud', 'ud.user_id = f2.user_id', 'right');
		//$this->db->join('store_info si', 'si.store_id = p1.store_id', 'right');
		$this->db->where('f2.user_id', $userID);
		switch( $fancyListID !== NULL && $fancyListID != 0 )
		{
			case TRUE:	$this->db->where('f2.fancy_list_id', $fancyListID);
				break;
		}
		
		$this->db->order_by('time', 'desc');
		$this->db->limit($maxResults, $startFrom * $maxResults);

		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY_______\r\n\r\n".$this->db->last_query());
		$this->slog->write( array("level" => 1, "msg" => "JUST RAN THE FOLLOWING QUERY_______\r\n\r\n".$this->db->last_query()) );
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function fancyListsData($userID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		$retVal = NULL;
		$startFrom = ($startFrom === NULL)? 0: $startFrom;
		$maxResults = ($maxResults === NULL)? 24: $maxResults;
		$this->db->select('fl.fancy_list_id AS fancyListID');
		$this->db->select('fl.fancy_list_name AS fancyListName');
		$this->db->select('fl.description AS fancyListDescription');
		$this->db->select('(SELECT COUNT(fp.product_id) FROM fancy_products fp WHERE fp.user_id = '.$userID.' AND fp.fancy_list_id = fl.fancy_list_id) as totalFanciedProducts', FALSE);
		$this->db->from('fancy_list fl');
		$this->db->where("fl.user_id = ".$userID);
		$this->db->limit($maxResults, $startFrom * $maxResults);
		$query3 = $this->db->get();
		switch($query3->num_rows > 0)
		{
			case TRUE: $retVal = $query3->result();
				break;
		}
		return $retVal;
	}

	public function followersData($userID = NULL, $currentUserID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		/*
		Query being used_____________
		SELECT
		ff1.follower_id AS followerID,
		ud.fb_uid AS followerFBID,
		ud.gender AS followerGender,
		ud.full_name AS followerName,
		fr.rank AS followerRank,
		(IF((SELECT COUNT(f_no) FROM follow_friends ff2 where ff2.follower_id = '%' and ff2.followee_id = ff1.followee_id), TRUE, FALSE)) AS hasFollowed,
		(IF((SELECT COUNT(f_no) FROM follow_friends ff2 where (((ff2.follower_id = 37 AND ff2.followee_id = ff1.followee_id) OR  (ff2.follower_id = ff1.followee_id AND ff2.followee_id = 37)) AND ff2.f_type = 1)), TRUE, FALSE)) AS isFriends
		FROM follow_friends ff1
		LEFT JOIN user_details ud ON ff1.follower_id = ud.user_id
		LEFT JOIN fancy_rank fr ON ff1.follower_id = fr.user_id
		WHERE followee_id = 141 AND f_type = 0;
		*/
		log_message('INFO', "rapiv1/profile_model/followersData fired from ".$this->input->ip_address());
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		$startFrom = ($startFrom === NULL)? 0: $startFrom;
		$maxResults = ($maxResults === NULL)? 15: $maxResults;
		log_message('INFO', "After the requisite computations, userID = ".$userID.", currentUserID = ".$currentUserID.", startFrom = ".$startFrom.", maxResults = ".$maxResults);
		switch($userID === NULL)
		{
			case TRUE: return NULL;
				break;
		}
		$this->db->select('ff1.follower_id AS followerID');
		$this->db->select('ud.fb_uid AS followerFBID');
		$this->db->select('ud.gender AS followerGender');
		$this->db->select('ud.full_name AS followerName');
		$this->db->select('ud.userRank AS followerRank');
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 where ff2.follower_id = '.$currentUserID.' and ff2.followee_id = ff1.follower_id), TRUE, FALSE)) AS hasFollowed', FALSE);
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 where (((ff2.follower_id = '.$currentUserID.' AND ff2.followee_id = ff1.follower_id) OR  (ff2.follower_id = ff1.follower_id AND ff2.followee_id = '.$currentUserID.')) AND ff2.f_type = 1)), TRUE, FALSE)) AS isFriends', FALSE);
		$this->db->from('follow_friends ff1');
		$this->db->join('user_details ud', 'ff1.follower_id = ud.user_id', 'left');
		//$this->db->where('ff1.followee_id = '.$userID.' AND ff1.f_type = 0');
		$this->db->where('ff1.followee_id = '.$userID);
		$this->db->order_by('ff1.f_no', 'desc'); // sort the followers by newness
		$this->db->limit($maxResults, $startFrom * $maxResults);
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY_______\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: $retVal =  $query->result();
				break;
			case FALSE: $retVal = NULL;
				break;
		}
		log_message('INFO', "profile_model/followersData RETURNING the following data___\r\n".print_r($retVal, TRUE));
		return $retVal;
	}

	public function commonFollowers($userID1, $userID2)
	{
		$this->db->select('follower_id AS followerID');
		$this->db->select('ud.full_name AS followerName');
		$this->db->select('ud.fb_uid AS followerFBID');
		$this->db->select('ud.gender AS followerGender');
		$this->db->from('follow_friends');
		$this->db->join('user_details ud', 'follow_friends.follower_id = ud.user_id', 'left');
		$this->db->where('followee_id', $userID1);
		$this->db->or_where('followee_id', $userID2);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}
	
	public function followingData($userID = NULL, $currentUserID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		/*
		Query being used_____________
		SELECT
		ff1.followee_id AS followingID,
		ud.fb_uid AS followingFBID,
		ud.gender AS followingGender,
		ud.full_name AS followingName,
		fr.rank AS followingRank,
		(IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE ff2.follower_id = '%' AND ff2.followee_id = ff1.followee_id), TRUE, FALSE)) AS hasFollowed,
		(IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE (((ff2.follower_id = 37 AND ff2.followee_id = ff1.followee_id) OR  (ff2.follower_id = ff1.followee_id AND ff2.followee_id = 37)) AND ff2.f_type = 1)), TRUE, FALSE)) AS isFriends
		FROM follow_friends ff1
		LEFT JOIN user_details ud ON ff1.followee_id = ud.user_id
		LEFT JOIN fancy_rank fr ON ff1.followee_id = fr.user_id
		WHERE follower_id = 141 AND f_type = 0;
		*/
		log_message('INFO', "rapiv1/profile_model/followingData fired from ".$this->input->ip_address());
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		$startFrom = ($startFrom === NULL)? 0: $startFrom;
		$maxResults = ($maxResults === NULL)? 15: $maxResults;
		log_message('INFO', "After the requisite computations, userID = ".$userID.", currentUserID = ".$currentUserID.", startFrom = ".$startFrom.", maxResults = ".$maxResults);
		switch($userID === NULL)
		{
			case TRUE: return NULL;
				break;
		}
		$this->db->select('ff1.followee_id AS followingID');
		$this->db->select('ud.fb_uid AS followingFBID');
		$this->db->select('ud.gender AS followingGender');
		$this->db->select('ud.full_name AS followingName');
		$this->db->select('ud.userRank AS followingRank');
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE ff2.follower_id = '.$currentUserID.' AND ff2.followee_id = ff1.followee_id), TRUE, FALSE)) AS hasFollowed', FALSE);
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE (((ff2.follower_id = '.$currentUserID.' AND ff2.followee_id = ff1.followee_id) OR  (ff2.follower_id = ff1.followee_id AND ff2.followee_id = '.$currentUserID.')) AND ff2.f_type = 1)), TRUE, FALSE)) AS isFriends', FALSE);
		$this->db->from('follow_friends ff1');
		$this->db->join('user_details ud', 'ff1.followee_id = ud.user_id', 'left');
		//$this->db->where('ff1.follower_id = '.$userID.' AND ff1.f_type = 0');
		$this->db->where('ff1.follower_id = '.$userID);
		$this->db->order_by('ff1.f_no', 'desc'); // sort the followers by newness
		$this->db->limit($maxResults, $startFrom * $maxResults);
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY_______\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: $retVal =  $query->result();
				break;
			case FALSE: $retVal = NULL;
				break;
		}
		log_message('INFO', "profile_model/followingData RETURNING the following data___\r\n".print_r($retVal, TRUE));
		return $retVal;
	}

	public function friendsData($userID = NULL, $currentUserID = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		/*
		Query being used_____________
		SELECT
		(IF(ff1.follower_id = 141, ff1.followee_id, ff1.follower_id)) AS friendID,
		ff1.follower_id,
		ff1.followee_id,
		ud.full_name AS friendName,
		ud.fb_uid AS friendFBID,
		ud.gender AS friendGender,
		fr.rank AS friendRank,
		(IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE ff2.follower_id = 141 AND ff2.followee_id = (IF(ff1.follower_id = 141, ff1.followee_id, ff1.follower_id))), TRUE, FALSE)) AS hasFollowed,
		(IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE (((ff2.follower_id = 141 AND ff2.followee_id = (IF(ff1.follower_id = 141, ff1.followee_id, ff1.follower_id))) OR  (ff2.follower_id = (IF(ff1.follower_id = 141, ff1.followee_id, ff1.follower_id)) AND ff2.followee_id = 141)) AND ff2.f_type = 1)), TRUE, FALSE)) AS isFriends
		FROM follow_friends ff1
		LEFT JOIN user_details ud ON (IF(ff1.follower_id = 141, ff1.followee_id, follower_id)) = ud.user_id
		LEFT JOIN fancy_rank fr ON (IF(ff1.follower_id = 141, ff1.followee_id, follower_id)) = fr.user_id
		WHERE (ff1.followee_id = 141 OR ff1.follower_id = 141) AND ff1.f_type = 1;

		*/
		log_message('INFO', "rapiv1/profile_model/followingData fired from ".$this->input->ip_address());
		$currentUserID = ($currentUserID === NULL || $currentUserID === FALSE || $currentUserID === '')? "'%'": $currentUserID;
		$startFrom = ($startFrom === NULL)? 0: $startFrom;
		$maxResults = ($maxResults === NULL)? 15: $maxResults;
		log_message('INFO', "After the requisite computations, userID = ".$userID.", currentUserID = ".$currentUserID.", startFrom = ".$startFrom.", maxResults = ".$maxResults);
		switch($userID === NULL)
		{
			case TRUE: return NULL;
				break;
		}
		/*$this->db->select('(IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id)) AS friendID', FALSE);
		$this->db->select('ud.fb_uid AS friendFBID');
		$this->db->select('ud.gender AS friendGender');
		$this->db->select('ud.full_name AS friendName');
		$this->db->select('fr.rank AS friendRank');
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 where ff2.follower_id = '.$currentUserID.' and ff2.followee_id = (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id))), TRUE, FALSE)) AS hasFollowed', FALSE);
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE (((ff2.follower_id = '.$currentUserID.' AND ff2.followee_id = (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id))) OR  (ff2.follower_id = (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id)) AND ff2.followee_id = '.$currentUserID.')) AND ff2.f_type = 1)), TRUE, FALSE)) AS isFriends', FALSE);
		$this->db->from('follow_friends ff1');
		$this->db->join('user_details ud', '(IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id)) = ud.user_id', 'left');
		$this->db->join('fancy_rank fr', '(IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id)) = fr.user_id', 'left');*/
		/* JOIN was creating errors due to known ACTIVE RECORD limitation. So, will now directly ADD SQL to the WHEREText */
		$whereText = 'SELECT (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id)) AS friendID,';
		$whereText .= ' ud.fb_uid AS friendFBID,';
		$whereText .= ' ud.gender AS friendGender,';
		$whereText .= ' ud.full_name AS friendName,';
		$whereText .= ' ud.userRank AS friendRank,';
		$whereText .= ' (IF((SELECT COUNT(f_no) FROM follow_friends ff2 where ff2.follower_id = '.$currentUserID.' and ff2.followee_id = (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id))), TRUE, FALSE)) AS hasFollowed,';
		$whereText .= ' (IF((SELECT COUNT(f_no) FROM follow_friends ff2 WHERE (((ff2.follower_id = '.$currentUserID.' AND ff2.followee_id = (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id))) OR  (ff2.follower_id = (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id)) AND ff2.followee_id = '.$currentUserID.')) AND ff2.f_type = 1)), TRUE, FALSE)) AS isFriends';
		$whereText .= ' FROM follow_friends ff1';
		$whereText .= ' LEFT JOIN user_details ud ON (IF(ff1.follower_id = '.$userID.', ff1.followee_id, ff1.follower_id)) = ud.user_id';
		$whereText .= ' WHERE (ff1.followee_id = '.$userID.' OR ff1.follower_id = '.$userID.') AND ff1.f_type = 1';
		$whereText .= ' ORDER BY ff1.f_no DESC'; // sort the followers by newness
		$whereText .= ' LIMIT '.$maxResults.' OFFSET '.($startFrom *$maxResults);
		log_message('INFO', "\$whereText = ".$whereText);
		$query = $this->db->query($whereText);
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function suggestPeopleToFollowData()
	{
		/*
		Query being used
		select fr.rank, fr.user_id, ud.fb_uid, ud.full_name from fancy_rank fr
		left join user_details ud on fr.user_id = ud.user_id
		limit 10;
		*/
		$this->db->select('ud.userRank AS userRank');
		$this->db->select('ud.user_id AS userID');
		$this->db->select('ud.fb_uid AS userFBID');
		$this->db->select('ud.fb_uid AS userFullName');
		$this->db->from('user_details ud');
		$this->db->where('ud.userRank > 0');
		$this->db->order_by('ud.userRank', 'asc');
		$this->db->limit(10);

		$queryA = $this->db->get();
		switch($queryA->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function userIDToEmail($userID)
	{
		$this->db->select('email');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $result = $query->result();
						return $result[0]->email;
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function follow($userID, $userToFollow)
	{
		log_message('INFO', "rapiv1/profile_model fired with \$userID = ".$userID." and \$userToFollow = ".$userToFollow);
		/*
		Algorithm
		Check the follow_friends table if an entry exists where follower_id = $userID and followee_id = $userToFollow. Call the result A
		if exists(A), CONTINUE else INSERT INTO follow_friends(follower_id, followee_id, f_type) VALUES($userID, $userToFollow, 0);
		Check the follow_friends table if an entry exists where follower_id = $userToFollow and followee_id = $userID. Call the result C
		if exists(B), UPDATE follow_friends SET f_type = 1 WHERE (follower_id = $userID AND followee_id = $userToFollow) OR (follower_id = $userToFollow AND followee_id = $userID)
		else EXIT funtion
		*/
		$ffIDs = array();
		$retVal = NULL;
		if($userID == $userToFollow)
		{
			return $retVal;
		}
		$this->db->select('follower_id');
		$this->db->select('followee_id');
		$this->db->from('follow_friends');
		$this->db->where('follower_id', $userID);
		$this->db->where('followee_id', $userToFollow);
		$queryA = $this->db->get();
		switch($queryA->num_rows() > 0)
		{
			case FALSE: $this->db->set('follower_id', $userID);
						$this->db->set('followee_id', $userToFollow);
						$this->db->set('f_type', 0);
						$retVal = $queryB = $this->db->insert('follow_friends');
						$ffIDs[] = $this->db->insert_id();
						if($queryB === TRUE)
						{
							$data = array();
							$this->db->select('follower_id AS followerID');
							$this->db->select('ud.full_name AS followerName');
							$this->db->select('ud.fb_uid AS followerFBID');
							$this->db->select('ud.gender AS followerGender');
							$this->db->select('ud.joined_date AS memberSince');
							$this->db->select('(SELECT COUNT(followee_id) FROM follow_friends WHERE follower_id = '.$userID.') AS following');
							$this->db->select('(SELECT COUNT(follower_id) FROM follow_friends WHERE followee_id = '.$userID.') AS followers');
							$this->db->from('follow_friends');
							$this->db->join('user_details ud', 'follow_friends.follower_id = ud.user_id', 'left');
							$this->db->where('follower_id', $userID);
							$queryBEmail = $this->db->get();
							switch($queryBEmail->num_rows() > 0)
							{
								case TRUE: $tData = $queryBEmail->result();
											$data['followerFullName'] = $tData[0]->followerName;
											$data['followerFBID'] = $tData[0]->followerFBID;
											$data['followerID'] = $tData[0]->followerID;
											$data['commonFollowers'] = $this->commonFollowers($userID, $userToFollow);
											$data['commonFollowersCount'] = count($data['commonFollowers']);
											$data['profileImageSrc'] = NULL;
											$data['followersCount'] = $tData[0]->followers;
											$data['followingCount'] = $tData[0]->following;
											$data['memberSince'] = date('F jS, Y', strtotime($tData[0]->memberSince));
											
											$data['profileImageSrc'] = "http://buynbrag.com/assets/images/default/male.png";
											
											if(strcmp($tData[0]->followerGender, 'female') === 0)
											{
												$data['profileImageSrc'] = "https://buynbrag.com/assets/images/default/female.png";
											}

											if(strcmp($data['followerFBID'], 'non-fb-member') !== 0)
											{
												$data['profileImageSrc'] = "https://graph.facebook.com/".$data['followerFBID']."/picture?width=75&height=75";
											}

											$to = $this->userIDToEmail($userToFollow);

											log_message('INFO', 'sending following email to '.$to);

											$this->load->library('email');
											$this->email->from('support@buynbrag.com', 'BuynBrag');
											$this->email->to($to);
											$this->email->subject("BuynBrag ::: Someone started following you");

											$msg = $this->load->view('emailers/followingMail', $data, true);

											$this->email->message($msg);
											$this->email->set_newline("\r\n");

											if($this->email->send())
											{
											   log_message('INFO', " Successfully SENT following MAIl FOR THE USER WITH ID : ".$userID);
											}
											else
											{
											   log_message('INFO', " Error sending following MAIl FOR THE USER WITH ID : ".$userID);
											}
									break;
								case FALSE:	log_message('INFO', 'Query did not return any data');
									break;
							}
						}
				break;
		}

		$this->db->select('f_no');
		$this->db->from('follow_friends');
		$this->db->where('follower_id', $userToFollow);
		$this->db->where('followee_id', $userID);
		$queryC = $this->db->get();
		switch($queryC->num_rows() > 0)
		{
			case TRUE: $this->db->set('f_type', 1);
						$this->db->where("(follower_id = ".$userID." AND followee_id = ".$userToFollow.") OR (follower_id = ".$userToFollow." AND followee_id = ".$userID.")");
						$retVal = $queryD = $this->db->update('follow_friends');
				break;
			case FALSE: return $retVal;
				break;
		}
	}

	public function joinFollow($userID, $userToFollow, $sendMail = FALSE)
	{
		log_message('INFO', "rapiv1/profile_model fired with \$userID = ".$userID." and \$userToFollow = ".$userToFollow);
		/*
		Algorithm
		Check the follow_friends table if an entry exists where follower_id = $userID and followee_id = $userToFollow. Call the result A
		if exists(A), CONTINUE else INSERT INTO follow_friends(follower_id, followee_id, f_type) VALUES($userID, $userToFollow, 0);
		Check the follow_friends table if an entry exists where follower_id = $userToFollow and followee_id = $userID. Call the result C
		if exists(B), UPDATE follow_friends SET f_type = 1 WHERE (follower_id = $userID AND followee_id = $userToFollow) OR (follower_id = $userToFollow AND followee_id = $userID)
		else EXIT funtion
		*/
		$ffIDs = array();
		$retVal = NULL;
		if($userID == $userToFollow)
		{
			return $retVal;
		}
		$this->db->select('follower_id');
		$this->db->select('followee_id');
		$this->db->from('follow_friends');
		$this->db->where('follower_id', $userID);
		$this->db->where('followee_id', $userToFollow);
		$queryA = $this->db->get();
		switch($queryA->num_rows() > 0)
		{
			case FALSE: $this->db->set('follower_id', $userID);
						$this->db->set('followee_id', $userToFollow);
						$this->db->set('f_type', 0);
						$retVal = $queryB = $this->db->insert('follow_friends');
						$ffIDs[] = $this->db->insert_id();
						if($queryB === TRUE && $sendMail === TRUE)
						{
							$data = array();
							$this->db->select('follower_id AS followerID');
							$this->db->select('ud.full_name AS followerName');
							$this->db->select('ud.fb_uid AS followerFBID');
							$this->db->select('ud.gender AS followerGender');
							$this->db->select('ud.joined_date AS memberSince');
							$this->db->select('(SELECT COUNT(followee_id) FROM follow_friends WHERE follower_id = '.$userID.') AS following');
							$this->db->select('(SELECT COUNT(follower_id) FROM follow_friends WHERE followee_id = '.$userID.') AS followers');
							$this->db->select('(SELECT full_name FROM user_details WHERE user_id = '.$userToFollow.') AS followeeName');
							$this->db->from('follow_friends');
							$this->db->join('user_details ud', 'follow_friends.follower_id = ud.user_id', 'left');
							$this->db->where('follower_id', $userID);
							$queryBEmail = $this->db->get();
							switch($queryBEmail->num_rows() > 0)
							{
								case TRUE: $tData = $queryBEmail->result();
											$data['followerFullName'] = $tData[0]->followerName;
											$data['followeeFullName'] = $tData[0]->followeeName;
											$data['followerFBID'] = $tData[0]->followerFBID;
											$data['followerID'] = $tData[0]->followerID;
											$data['commonFollowers'] = $this->commonFollowers($userID, $userToFollow);
											$data['commonFollowersCount'] = count($data['commonFollowers']);
											$data['profileImageSrc'] = NULL;
											$data['followersCount'] = $tData[0]->followers;
											$data['followingCount'] = $tData[0]->following;
											$data['memberSince'] = date('F jS, Y', strtotime($tData[0]->memberSince));
											
											$data['profileImageSrc'] = "http://buynbrag.com/assets/images/default/male.png";
											
											if(strcmp($tData[0]->followerGender, 'female') === 0)
											{
												$data['profileImageSrc'] = "https://buynbrag.com/assets/images/default/female.png";
											}

											if(strcmp($data['followerFBID'], 'non-fb-member') !== 0)
											{
												$data['profileImageSrc'] = "https://graph.facebook.com/".$data['followerFBID']."/picture?width=75&height=75";
											}

											$to = $this->userIDToEmail($userToFollow);

											log_message('INFO', 'sending following email to '.$to);

											/*$this->load->library('email');
											$this->email->from('support@buynbrag.com', 'BuynBrag');
											$this->email->to($to);
											$this->email->subject("BuynBrag ::: Your friend joined and is now following you");

											log_message('INFO', "DATA being sent to the view is: \r\n".print_r($data, TRUE));

											$msg = $this->load->view('emailers/fbJoinFriendFollowMail', $data, TRUE);

											$this->email->message($msg);
											$this->email->set_newline("\r\n");

											if($this->email->send())
											{
											   log_message('INFO', " Successfully SENT following MAIl FOR THE USER WITH ID : ".$userID);
											}
											else
											{
											   log_message('INFO', " Error sending following MAIl FOR THE USER WITH ID : ".$userID);
											}*/

											/* sending distributed email */
											$msg = $this->load->view('emailers/fbJoinFriendFollowMail', $data, TRUE);
											$this->load->model('automate_model');
											$jobType = 1; // a check and then send email job depending upon the result of the check
											$jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
											/* $jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013 */
											$jobScheduledTime = (time() + 66); // current time + 1 day (24 hrs 1 minute)
											$jobDetails = array
															(
																'to' => $to,
																'subject' => "BuynBrag ::: Your friend joined and is now following you",
																'msg' => $msg
															);
											$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
											$this->slog->write( array('level' => 1, 'msg' => "<p>A check and then email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A T (P)', $jobScheduledTime)." </p>" ) );
											/* END SECTION sending distributed email */
									break;
								case FALSE:	log_message('INFO', 'Query did not return any data');
									break;
							}
						}
				break;
		}

		$this->db->select('f_no');
		$this->db->from('follow_friends');
		$this->db->where('follower_id', $userToFollow);
		$this->db->where('followee_id', $userID);
		$queryC = $this->db->get();
		switch($queryC->num_rows() > 0)
		{
			case TRUE: $this->db->set('f_type', 1);
						$this->db->where("(follower_id = ".$userID." AND followee_id = ".$userToFollow.") OR (follower_id = ".$userToFollow." AND followee_id = ".$userID.")");
						$retVal = $queryD = $this->db->update('follow_friends');
				break;
			case FALSE: $retVal = FALSE;
				break;
		}
		return $retVal;
	}

	public function unFollow($userID, $userToUnFollow)
	{
		/*
		Algorithm
		check the follow_friends table if an entry exists where follower_id = $userID and followee_id = $userToUnFollow. Call it A
		if exits(A),
			check if  A->f_type = 1. If it is, UPDATE follow_friends SET f_type = 0 WHERE followee_id = $userID AND follower_id = $userToUnFollow
			DELETE FROM follow_friends WHERE f_no = A->f_no
		else
			EXIT with NULL
		*/
		log_message('INFO', "rapiv1/profile_model/unFollow: fired with \$userID = ".$userID." and \$userToFollow = ".$userToFollow);
		$retVal = NULL;
		$this->db->select('f_no');
		$this->db->select('f_type');
		$this->db->from('follow_friends');
		$this->db->where('follower_id', $userID);
		$this->db->where('followee_id', $userToUnFollow);
		$retVal = $queryA = $this->db->get();
		log_message('INFO', "rapiv1/profile_model/unFollow: RAN___\r\n".$this->db->last_query());
		switch($queryA->num_rows() > 0)
		{
			case TRUE: $qAResult = $queryA->result();
						switch($qAResult[0]->f_type == 1)
						{
							case TRUE: $this->db->set('f_type', 0);
										$this->db->where('followee_id', $userID);
										$this->db->where('follower_id', $userToUnFollow);
										$queryB = $this->db->update('follow_friends');
										log_message('INFO', "rapiv1/profile_model/unFollow: RAN___\r\n".$this->db->last_query());
										$retVal = $retVal && $queryB;
								break;
						}
						$this->db->where('f_no', $qAResult[0]->f_no);
						$queryC = $this->db->delete('follow_friends');
						log_message('INFO', "rapiv1/profile_model/unFollow: RAN___\r\n".$this->db->last_query());
						$retVal = $retVal && $queryC;
				break;
		}
		log_message('INFO', "rapiv1/profile_model/unFollow: returning ".json_encode($retVal));
		return $retVal;
	}

	public function changePassword($userID, $currentPassword, $newPassword, $confirmPassword)
	{
		/*
		Algorithm
		read the password for $userID from DB
		compare it with the $currentPassword
		if a match is found,
			compare if $newPassword === $confirmPassword
				if true, save the newPassword for $userID
				if false, throw error
		else
			throw error
		*/
		$retVal = array();
		$retVal['userExists'] = FALSE;
		$retVal['currentPasswordMatches'] = FALSE;
		$retVal['newPasswordsMatch'] = FALSE;
		$retVal['passwordUpdated'] = NULL;

		$this->db->select('password');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);

		$queryA = $this->db->get();

		switch($queryA->num_rows() > 0)
		{
			case TRUE: $retVal['userExists'] = TRUE;
						$password = $queryA->result();
						$password = $password[0];
						switch( strcmp($password->password, md5($currentPassword)) === 0 )
						{
							case TRUE: $retVal['currentPasswordMatches'] = TRUE;
										switch( strcmp($newPassword, $confirmPassword) === 0 )
										{
											case TRUE: $retVal['newPasswordsMatch'] = TRUE;
														switch( $userID != 15089 ) // Restrict the user from changing the guest account password
														{
															case TRUE:	$this->db->set('password', md5($newPassword));
																		$this->db->where('user_id', $userID);
																		$retVal['passwordUpdated'] = $this->db->update('user_details');
																break;
															case FALSE:	// if the user account is the guest account,
																		// return TRUE to create an illusion of the password being changed without actually changing it
																		$retVal['passwordUpdated'] = TRUE;
																break;
														}
												break;
										}
								break;
						}
				break;
		}
		return $retVal;
	}

	public function ccToName($cCode)
	{
		$cc["AF"] = "Afghanistan";
	    $cc["AX"] = "Åland Islands";
	    $cc["AL"] = "Albania";
	    $cc["DZ"] = "Algeria";
	    $cc["AS"] = "American Samoa";
	    $cc["AD"] = "Andorra";
	    $cc["AO"] = "Angola";
	    $cc["AI"] = "Anguilla";
	    $cc["AQ"] = "Antarctica";
	    $cc["AG"] = "Antigua And Barbuda";
	    $cc["AR"] = "Argentina";
	    $cc["AM"] = "Armenia";
	    $cc["AW"] = "Aruba";
	    $cc["AU"] = "Australia";
	    $cc["AT"] = "Austria";
	    $cc["AZ"] = "Azerbaijan";
	    $cc["BS"] = "Bahamas";
	    $cc["BH"] = "Bahrain";
	    $cc["BD"] = "Bangladesh";
	    $cc["BB"] = "Barbados";
	    $cc["BY"] = "Belarus";
	    $cc["BE"] = "Belgium";
	    $cc["BZ"] = "Belize";
	    $cc["BJ"] = "Benin";
	    $cc["BM"] = "Bermuda";
	    $cc["BT"] = "Bhutan";
	    $cc["BO"] = "Bolivia, Plurinational State Of";
	    $cc["BQ"] = "Bonaire, Sint Eustatius And Saba";
	    $cc["BA"] = "Bosnia And Herzegovina";
	    $cc["BW"] = "Botswana";
	    $cc["BV"] = "Bouvet Island";
	    $cc["BR"] = "Brazil";
	    $cc["IO"] = "British Indian Ocean Territory";
	    $cc["BN"] = "Brunei Darussalam";
	    $cc["BG"] = "Bulgaria";
	    $cc["BF"] = "Burkina Faso";
	    $cc["BI"] = "Burundi";
	    $cc["KH"] = "Cambodia";
	    $cc["CM"] = "Cameroon";
	    $cc["CA"] = "Canada";
	    $cc["CV"] = "Cape Verde";
	    $cc["KY"] = "Cayman Islands";
	    $cc["CF"] = "Central African Republic";
	    $cc["TD"] = "Chad";
	    $cc["CL"] = "Chile";
	    $cc["CN"] = "China";
	    $cc["CX"] = "Christmas Island";
	    $cc["CC"] = "Cocos (keeling) Islands";
	    $cc["CO"] = "Colombia";
	    $cc["KM"] = "Comoros";
	    $cc["CG"] = "Congo";
	    $cc["CD"] = "Congo, The Democratic Republic Of The";
	    $cc["CK"] = "Cook Islands";
	    $cc["CR"] = "Costa Rica";
	    $cc["CI"] = "CÔte D'ivoire";
	    $cc["HR"] = "Croatia";
	    $cc["CU"] = "Cuba";
	    $cc["CW"] = "CuraÇao";
	    $cc["CY"] = "Cyprus";
	    $cc["CZ"] = "Czech Republic";
	    $cc["DK"] = "Denmark";
	    $cc["DJ"] = "Djibouti";
	    $cc["DM"] = "Dominica";
	    $cc["DO"] = "Dominican Republic";
	    $cc["EC"] = "Ecuador";
	    $cc["EG"] = "Egypt";
	    $cc["SV"] = "El Salvador";
	    $cc["GQ"] = "Equatorial Guinea";
	    $cc["ER"] = "Eritrea";
	    $cc["EE"] = "Estonia";
	    $cc["ET"] = "Ethiopia";
	    $cc["FK"] = "Falkland Islands (malvinas)";
	    $cc["FO"] = "Faroe Islands";
	    $cc["FJ"] = "Fiji";
	    $cc["FI"] = "Finland";
	    $cc["FR"] = "France";
	    $cc["GF"] = "French Guiana";
	    $cc["PF"] = "French Polynesia";
	    $cc["TF"] = "French Southern Territories";
	    $cc["GA"] = "Gabon";
	    $cc["GM"] = "Gambia";
	    $cc["GE"] = "Georgia";
	    $cc["DE"] = "Germany";
	    $cc["GH"] = "Ghana";
	    $cc["GI"] = "Gibraltar";
	    $cc["GR"] = "Greece";
	    $cc["GL"] = "Greenland";
	    $cc["GD"] = "Grenada";
	    $cc["GP"] = "Guadeloupe";
	    $cc["GU"] = "Guam";
	    $cc["GT"] = "Guatemala";
	    $cc["GG"] = "Guernsey";
	    $cc["GN"] = "Guinea";
	    $cc["GW"] = "Guinea-bissau";
	    $cc["GY"] = "Guyana";
	    $cc["HT"] = "Haiti";
	    $cc["HM"] = "Heard Island And Mcdonald Islands";
	    $cc["VA"] = "Holy See (vatican City State)";
	    $cc["HN"] = "Honduras";
	    $cc["HK"] = "Hong Kong";
	    $cc["HU"] = "Hungary";
	    $cc["IS"] = "Iceland";
	    $cc["IN"] = "India";
	    $cc["ID"] = "Indonesia";
	    $cc["IR"] = "Iran, Islamic Republic Of";
	    $cc["IQ"] = "Iraq";
	    $cc["IE"] = "Ireland";
	    $cc["IM"] = "Isle Of Man";
	    $cc["IL"] = "Israel";
	    $cc["IT"] = "Italy";
	    $cc["JM"] = "Jamaica";
	    $cc["JP"] = "Japan";
	    $cc["JE"] = "Jersey";
	    $cc["JO"] = "Jordan";
	    $cc["KZ"] = "Kazakhstan";
	    $cc["KE"] = "Kenya";
	    $cc["KI"] = "Kiribati";
	    $cc["KP"] = "Korea, Democratic People's Republic Of";
	    $cc["KR"] = "Korea, Republic Of";
	    $cc["KW"] = "Kuwait";
	    $cc["KG"] = "Kyrgyzstan";
	    $cc["LA"] = "Lao People's Democratic Republic";
	    $cc["LV"] = "Latvia";
	    $cc["LB"] = "Lebanon";
	    $cc["LS"] = "Lesotho";
	    $cc["LR"] = "Liberia";
	    $cc["LY"] = "Libya";
	    $cc["LI"] = "Liechtenstein";
	    $cc["LT"] = "Lithuania";
	    $cc["LU"] = "Luxembourg";
	    $cc["MO"] = "Macao";
	    $cc["MK"] = "Macedonia, The Former Yugoslav Republic Of";
	    $cc["MG"] = "Madagascar";
	    $cc["MW"] = "Malawi";
	    $cc["MY"] = "Malaysia";
	    $cc["MV"] = "Maldives";
	    $cc["ML"] = "Mali";
	    $cc["MT"] = "Malta";
	    $cc["MH"] = "Marshall Islands";
	    $cc["MQ"] = "Martinique";
	    $cc["MR"] = "Mauritania";
	    $cc["MU"] = "Mauritius";
	    $cc["YT"] = "Mayotte";
	    $cc["MX"] = "Mexico";
	    $cc["FM"] = "Micronesia, Federated States Of";
	    $cc["MD"] = "Moldova, Republic Of";
	    $cc["MC"] = "Monaco";
	    $cc["MN"] = "Mongolia";
	    $cc["ME"] = "Montenegro";
	    $cc["MS"] = "Montserrat";
	    $cc["MA"] = "Morocco";
	    $cc["MZ"] = "Mozambique";
	    $cc["MM"] = "Myanmar";
	    $cc["NA"] = "Namibia";
	    $cc["NR"] = "Nauru";
	    $cc["NP"] = "Nepal";
	    $cc["NL"] = "Netherlands";
	    $cc["NC"] = "New Caledonia";
	    $cc["NZ"] = "New Zealand";
	    $cc["NI"] = "Nicaragua";
	    $cc["NE"] = "Niger";
	    $cc["NG"] = "Nigeria";
	    $cc["NU"] = "Niue";
	    $cc["NF"] = "Norfolk Island";
	    $cc["MP"] = "Northern Mariana Islands";
	    $cc["NO"] = "Norway";
	    $cc["OM"] = "Oman";
	    $cc["PK"] = "Pakistan";
	    $cc["PW"] = "Palau";
	    $cc["PS"] = "Palestinian Territory, Occupied";
	    $cc["PA"] = "Panama";
	    $cc["PG"] = "Papua New Guinea";
	    $cc["PY"] = "Paraguay";
	    $cc["PE"] = "Peru";
	    $cc["PH"] = "Philippines";
	    $cc["PN"] = "Pitcairn";
	    $cc["PL"] = "Poland";
	    $cc["PT"] = "Portugal";
	    $cc["PR"] = "Puerto Rico";
	    $cc["QA"] = "Qatar";
	    $cc["RE"] = "RÉunion";
	    $cc["RO"] = "Romania";
	    $cc["RU"] = "Russian Federation";
	    $cc["RW"] = "Rwanda";
	    $cc["BL"] = "Saint BarthÉlemy";
	    $cc["SH"] = "Saint Helena, Ascension And Tristan Da Cunha";
	    $cc["KN"] = "Saint Kitts And Nevis";
	    $cc["LC"] = "Saint Lucia";
	    $cc["MF"] = "Saint Martin (french Part)";
	    $cc["PM"] = "Saint Pierre And Miquelon";
	    $cc["VC"] = "Saint Vincent And The Grenadines";
	    $cc["WS"] = "Samoa";
	    $cc["SM"] = "San Marino";
	    $cc["ST"] = "Sao Tome And Principe";
	    $cc["SA"] = "Saudi Arabia";
	    $cc["SN"] = "Senegal";
	    $cc["RS"] = "Serbia";
	    $cc["SC"] = "Seychelles";
	    $cc["SL"] = "Sierra Leone";
	    $cc["SG"] = "Singapore";
	    $cc["SX"] = "Sint Maarten (dutch Part)";
	    $cc["SK"] = "Slovakia";
	    $cc["SI"] = "Slovenia";
	    $cc["SB"] = "Solomon Islands";
	    $cc["SO"] = "Somalia";
	    $cc["ZA"] = "South Africa";
	    $cc["GS"] = "South Georgia And The South Sandwich Islands";
	    $cc["SS"] = "South Sudan";
	    $cc["ES"] = "Spain";
	    $cc["LK"] = "Sri Lanka";
	    $cc["SD"] = "Sudan";
	    $cc["SR"] = "Suriname";
	    $cc["SJ"] = "Svalbard And Jan Mayen";
	    $cc["SZ"] = "Swaziland";
	    $cc["SE"] = "Sweden";
	    $cc["CH"] = "Switzerland";
	    $cc["SY"] = "Syrian Arab Republic";
	    $cc["TW"] = "Taiwan, Province Of China";
	    $cc["TJ"] = "Tajikistan";
	    $cc["TZ"] = "Tanzania, United Republic Of";
	    $cc["TH"] = "Thailand";
	    $cc["TL"] = "Timor-leste";
	    $cc["TG"] = "Togo";
	    $cc["TK"] = "Tokelau";
	    $cc["TO"] = "Tonga";
	    $cc["TT"] = "Trinidad And Tobago";
	    $cc["TN"] = "Tunisia";
	    $cc["TR"] = "Turkey";
	    $cc["TM"] = "Turkmenistan";
	    $cc["TC"] = "Turks And Caicos Islands";
	    $cc["TV"] = "Tuvalu";
	    $cc["UG"] = "Uganda";
	    $cc["UA"] = "Ukraine";
	    $cc["AE"] = "United Arab Emirates";
	    $cc["GB"] = "United Kingdom";
	    $cc["US"] = "United States";
	    $cc["UM"] = "United States Minor Outlying Islands";
	    $cc["UY"] = "Uruguay";
	    $cc["UZ"] = "Uzbekistan";
	    $cc["VU"] = "Vanuatu";
	    $cc["VE"] = "Venezuela, Bolivarian Republic Of";
	    $cc["VN"] = "Viet Nam";
	    $cc["VG"] = "Virgin Islands, British";
	    $cc["VI"] = "Virgin Islands, U.s.";
	    $cc["WF"] = "Wallis And Futuna";
	    $cc["EH"] = "Western Sahara";
	    $cc["YE"] = "Yemen";
	    $cc["ZM"] = "Zambia";
	    $cc["ZW"] = "Zimbabwe";

	    switch( array_key_exists($cCode, $cc) === TRUE)
	    {
	    	case TRUE: return $cc[$cCode];
	    		break;
	    	case FALSE: return $cCode;
	    		break;
	    }
	}

	public function saveUserDetails($userID, $userDetails)
	{
		log_message('INFO', "profile_model/saveUserDetails fired with $userID = ".$userID." from ".$this->input->ip_address());
		log_message('INFO', "userDetails = ".json_encode($userDetails));
		
		$retVal = array();
		$retVal['fullNameOK'] = FALSE;
		$retVal['ddOK'] = FALSE;
		$retVal['mmOK'] = FALSE;
		$retVal['yyyyOK'] = FALSE;
		$retVal['sexOK'] = FALSE;
		$retVal['cityOK'] = FALSE;
		$retVal['ccOK'] = FALSE;
		$retVal['accActivated'] = FALSE;

		log_message('INFO', "checking if the user's account is activated or not");
		$this->db->select('email');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$this->db->where('isActive', 1);
		$this->db->limit(1);
		$userActive = $this->db->get();
		$newUserEmail = NULL;
		switch($userActive->num_rows() > 0)
		{
			case TRUE:	$retVal['accActivated'] = TRUE;
						$tmp = $userActive->result();
						$newUserEmail = $tmp[0]->email;
				break;
		}

		if($userDetails['fullName'] !== NULL)
		{
			$retVal['fullNameOK'] = TRUE;
		}

		if($userDetails['dd'] !== NULL /*&& $userDetails['dd'] !== ''*/)
		{
			$retVal['ddOK'] = TRUE;
		}

		if($userDetails['mm'] !== NULL /*&& $userDetails['mm'] !== ''*/)
		{
			$retVal['mmOK'] = TRUE;
		}

		if($userDetails['yyyy'] !== NULL /*&& $userDetails['yyyy'] !== ''*/)
		{
			$retVal['yyyyOK'] = TRUE;
		}

		if($userDetails['sex'] !== NULL)
		{
			$retVal['sexOK'] = TRUE;
		}

		if($retVal['sexOK'] === TRUE)
		{
			log_message('INFO', "\$userDetails[\"sex\"] = ".$userDetails['sex']);
			if(strcmp($userDetails['sex'], 'male') === 0)
			{
				$retVal['sexOK'] = TRUE;
			}
			else if(strcmp($userDetails['sex'], 'female') === 0)
			{
				$retVal['sexOK'] = TRUE;
			}
			else
			{
				$retVal['sexOK'] = FALSE;
			}
		}

		if($userDetails['city'] !== NULL)
		{
			$retVal['cityOK'] = TRUE;
		}

		if($userDetails['cc'] !== NULL)
		{
			$retVal['ccOK'] = TRUE;
		}

		$retVal['updateOK'] = NULL;

		log_message('INFO', "\$retVal = ".json_encode($retVal, JSON_FORCE_OBJECT));
		log_message('INFO', "\$userDetails = ".json_encode($userDetails, JSON_FORCE_OBJECT));
		log_message('INFO', "now entering switch");

		switch( $retVal['fullNameOK'] && $retVal['ddOK'] && $retVal['mmOK'] && $retVal['yyyyOK'] && $retVal['sexOK'] && $retVal['cityOK'] && $retVal['ccOK'] )
		{
			case TRUE: $retVal['detailsOK'] = TRUE;
						$mm = $userDetails['mm'];
						/*switch($userDetails['mm'])
						{
							case 1: $mm = "January";
								break;
							case 2: $mm = "February";
								break;
							case 3: $mm = "March";
								break;
							case 4: $mm = "April";
								break;
							case 5: $mm = "May";
								break;
							case 6: $mm = "June";
								break;
							case 7: $mm = "July";
								break;
							case 8: $mm = "August";
								break;
							case 9: $mm = "September";
								break;
							case 10: $mm = "October";
								break;
							case 11: $mm = "November";
								break;
							case 12: $mm = "December";
								break;
						}*/
						$this->db->set('full_name', $userDetails['fullName']);
						$this->db->set('date_of_birth', $userDetails['yyyy'].'-'.$mm.'-'.$userDetails['dd']);
						$this->db->set('gender', $userDetails['sex']);
						$this->db->set('city', $userDetails['city']);
						$this->db->set('country', $this->ccToName($userDetails['cc']));
						//$this->db->set('country_code', $userDetails['cc']);
						if($retVal['accActivated'] === FALSE)
						{
							$this->db->set('isActive', 1);
							$retVal['accActivated'] = TRUE;
						}

						$this->db->where('user_id', $userID);
						$retVal['updateOK'] = $this->db->update('user_details');
						log_message('INFO', "JUST RAN THE FOLLOWING QUERY_______\r\n\r\n".$this->db->last_query()."\r\n\r\n");

						if($retVal['updateOK'] === TRUE && $retVal['accActivated'] === TRUE)
						{
							$this->load->library('email');
							$this->email->from('support@buynbrag.com', 'BuynBrag');
							$this->email->to($newUserEmail);
							$this->email->subject("BuynBrag ::: Your new account at BuynBrag is now Active!");

							$msg = $this->load->view('emailers/accountActiveMail', $data, true);

							$this->email->message($msg);
							$this->email->set_newline("\r\n");

							if($this->email->send())
							{
							   log_message('INFO', " Successfully SENT account activation MAIl FOR THE USER WITH ID : ".$userID);
							}
							else
							{
							   log_message('INFO', " Error sending account activation mail FOR THE USER WITH ID : ".$userID);
							}

							log_message('INFO', 'Now trying to set session for user '.$userID);
							$sessionData = array('id' => $userID, 'logged_in' => TRUE);
							$this->session->set_userdata($sessionData);
							log_message('INFO', 'just set Session data for '.$userID.' from '.$this->input->ip_address());
							log_message('INFO', 'now checking whether it has been set or not');
							$sessionUserID = $this->session->userdata('id');
							$sessionLoggedIN = $this->session->userdata('logged_in');
							switch( (strcmp($sessionUserID, $userID) === 0) && $sessionLoggedIN === TRUE )
							{
								case TRUE:	log_message('INFO', 'session has been set. user with ID: '.$userID.' has been logged in ');
									break;
								case FALSE:	log_message('INFO', 'session could not be set for user with ID: '.$userID);
									break;
							}
						}
				break;
			case TRUE: $retVal['detailsOK'] = FALSE;
				break;
		}
		return $retVal;
	}

	public function saveUserCity($userID, $city)
	{
		$retVal = array();
		$retVal['cityOK'] = FALSE;
		$retVal['updateOK'] = NULL;

		if($city !== NULL && strcmp($city, '') !== 0)
		{
			$retVal['cityOK'] = TRUE;
		}
		
		switch($retVal['cityOK'] === TRUE)
		{
			case TRUE: $this->db->set('city', $city);
						$this->db->where('user_id', $userID);
						$retVal['updateOK'] = $this->db->update('user_details');
				break;
		}
		return $retVal;
	}

    public function saveAboutMe($userID, $aboutMe)
    {
        $this->db->set('about_me', $aboutMe);
        $this->db->where('user_id', $userID);
        return array('saved' => $this->db->update('user_details') );
    }

	public function jffFancy($userID)
	{
		$this->db->select('fb_uid');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $dataSet = $query->result();
					   return $dataSet[0];
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function saveStyleTags($userID, $tags)
	{
		$this->db->set('interested_in', $tags);
		$this->db->where('user_id', $userID);
		return array('saved' => $this->db->update('user_details'));
	}

	public function saveStyleTag($userID, $styleID)
	{
		// check if the current style has already been saved by the user
		$this->db->select('id');
		
		$this->db->from('user_styles');
		
		$this->db->where('user_id', $userID);
		$this->db->where('style_id', $styleID);

		$testQuery = $this->db->get();
		
		switch($testQuery->num_rows() > 0)
		{
			case FALSE:	$this->db->set('style_id', $styleID); // save when the style tag was not found for a user
						$this->db->set('user_id', $userID);
						$this->db->set('ts', time());
						return array('saved' => $this->db->insert('user_styles'));
				break;
			case TRUE:	return array('saved' => TRUE, 'alreadySaved' => TRUE);
		}
	}

	public function saveFancyList($userID, $listName, $description)
	{
		$this->db->set('description', $description);
		$this->db->set('fancy_list_name', $listName);
		$this->db->set('user_id', $userID);
		$this->db->set('ts', time());
		$saved = $this->db->insert('fancy_list');

		return array('saved' => $saved, array('fancyListID' => $this->db->insert_id(), 'fancyListName' => $listName));
	}

	public function updateFancyListName($userID, $listID, $listName)
	{
		$this->db->set('fancy_list_name', $listName);
		$this->db->set('ts', time());
		$this->db->where('user_id', $userID);
		$this->db->where('fancy_list_id', $listID);
		return array('saved' => $this->db->update('fancy_list'));
	}

	public function saveFancyListDescription($userID, $listID, $description)
	{
		$this->db->set('description', $description);
		$this->db->where('user_id', $userID);
		$this->db->where('fancy_list_id', $listID);
		return array('saved' => $this->db->update('fancy_list'));
	}

	protected function deleteFromFancyList($userID, $listID, $productID)
	{
		return array('saved' => $this->db->delete('fancy_products', array('fancy_list_id' => $listID, 'user_id' => $userID, 'product_id' => $productID)) );
	}

	public function moveToFancyList($userID, $fromListID, $toListID, $productID)
	{
		$this->db->set('fancy_list_id', $toListID);
		$this->db->where('user_id', $userID);
		$this->db->where('product_id', $productID);
		$this->db->where('fancy_list_id', $fromListID);
		return array('saved' => $this->db->update('fancy_products'));
	}

	public function readTags()
	{
		$this->db->select("MAX(product_id) AS maxPID");
		$this->db->from('products');
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$r1 = $q1->result();
						$r1 = $r1[0];
						$maxPID = $r1->maxPID;
						$this->db->select("product_id");
						$this->db->select("style");
						$this->db->from("products");
						$this->db->group_by("tags");
						$this->db->limit($maxPID);
						$q2 = $this->db->get();
						switch($q2->num_rows() > 0)
						{
							case TRUE:	return $q2->result();
								break;
							case FALSE:	return NULL;
								break;
						}
				break;
			case FALSE:	FALSE;
				break;
		}
	}

	public function readDBTags()
	{
		$this->db->select("style_id AS styleID");
		$this->db->select("category AS catID");
		$this->db->select("style");
		$this->db->from('styles');
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	return $q1->result();
				break;
			case FALSE:	NULL;
				break;
		}
	}

	public function readUserStyleTags($userID)
	{
		$this->db->select("user_styles.style_id AS styleID");
		$this->db->select("category AS catID");
		$this->db->select("style AS tag");

		$this->db->from('user_styles');

		$this->db->join('styles', 'user_styles.style_id = styles.style_id', 'left');

		$this->db->where('user_id', $userID);

		$q1 = $this->db->get();
		log_message('INFO', "JUST RAN___\r\n".$this->db->last_query());
		switch($q1->num_rows() > 0)
		{
			case TRUE:	return $q1->result();
				break;
			case FALSE:	NULL;
				break;
		}
	}

	public function deleteStyleTag($userID, $styleID)
	{
		// check if the specified style has been saved by the user
		$this->db->select('id');
		
		$this->db->from('user_styles');
		
		$this->db->where('user_id', $userID);
		$this->db->where('style_id', $styleID);

		$testQuery = $this->db->get();
		
		switch($testQuery->num_rows() > 0)
		{
			case FALSE:	return array('saved' => TRUE, 'exists' => FALSE);
				break;
			case TRUE:	$idToDelete = $testQuery->result();
						$idToDelete = $idToDelete[0];
						//$this->db->delete('user_styles', array('style_id' => $styleID, 'user_id' => $userID)); // delete when the style tag was not found for a user
						return array( 'saved' => $this->db->delete( 'user_styles', array('id' => $idToDelete) ) );
		}
	}

	public function deleteUser($email)
	{
		$retVal = array();
		
		$retVal['fancy'] = NULL;

		$retVal['brag'] = NULL;

		$retVal['coupon'] = NULL;

		$retVal['following'] = NULL;

		$retVal['followers'] = NULL;

		$retVal['userPrefs'] = NULL;

		$retVal['user'] = NULL;

		switch(! is_null($email) )
		{
			case TRUE:	$this->db->select('user_id');
						$this->db->from('user_details');
						$this->db->where('email', $email);
						$q1 = $this->db->get();
						switch($q1->num_rows() > 0)
						{
							case TRUE:	$userID = $q1->result();
										$userID = $userID[0]->user_id;
										log_message('INFO', "userID: ".$userID);

										$retVal['fancy'] = $this->db->delete('fancy_products', array('user_id' => $userID) ); // delete the fancied products
										log_message('INFO', "Result is______________\r\n".print_r($retVal, TRUE));

										$retVal['brag'] = $this->db->delete('brag_products', array('user_id' => $userID) ); // delete the bragged products
										log_message('INFO', "Result is______________\r\n".print_r($retVal, TRUE));

										$retVal['coupon'] = $this->db->delete('coupon', array('user_id' => $userID) ); // delete the coupons
										log_message('INFO', "Result is______________\r\n".print_r($retVal, TRUE));

										$retVal['following'] = $this->db->delete('follow_friends', array('follower_id' => $userID) ); // delete the user from the list of followers
										log_message('INFO', "Result is______________\r\n".print_r($retVal, TRUE));

										$retVal['followers'] = $this->db->delete('follow_friends', array('followee_id' => $userID) ); // delete the user from the list of following
										log_message('INFO', "Result is______________\r\n".print_r($retVal, TRUE));

										$retVal['userPrefs'] = $this->db->delete('user_prefs', array('user_id' => $userID) ); // delete the user preferences
										log_message('INFO', "Result is______________\r\n".print_r($retVal, TRUE));

										$retVal['user'] = $this->db->delete('user_details', array('user_id' => $userID) ); // delete the user
										log_message('INFO', "Result is______________\r\n".print_r($retVal, TRUE));
								break;
						}
				break;
		}
		return $retVal;
	}

	public function checkProductFancyListID($userID, $productID)
	{
		$this->db->select('fancy_list_id AS fancyListID');
		
		$this->db->from('fancy_products');

		$this->db->where('user_id', $userID);
		$this->db->where('product_id', $productID);

		$query = $this->db->get();

		switch($query->num_rows() > 0)
		{
			case TRUE:	return $query->result();
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	public function defaultFancyListID($userID)
	{
		$defaultFancyListID = NULL;
		// find the list ID of the current user's default fancy list "Things I Love!"
		// check if there already exists a list for this user
		$this->db->select('fancy_list_id AS fancyListID');
		
		$this->db->from('fancy_list');
		
		$this->db->where('user_id', $userID);
		$this->db->where('fancy_list_name', 'Things I Love!');

		$q3 = $this->db->get();

		switch($q3->num_rows() > 0)
		{
			case TRUE:	$tmp = $q3->result();
						$tmp = $tmp[0]->fancyListID;
						$defaultFancyListID = $tmp;
				break;
			case FALSE:	// create a new fancy list for the user
						$tmp = array();
						$tmp['user_id'] = $userID;
						$tmp['fancy_list_name'] = 'Things I Love!';
						
						$q4 = $this->db->insert('fancy_list', $tmp);

						if ($q4)
						{
							$defaultFancyListID = $this->db->insert_id();
						}
						else
						{
							return array('result' => FALSE, 'error' => "No default list found and failed to create a default fancy list(\"Things I Love!\") for the current user as well!");
						}
				break;
		}

		return $defaultFancyListID;
	}

	public function deleteFancyList($userID, $listID)
	{
		$productsToMoveArray = NULL;
		$productsInCurrentList = NULL;
		$defaultFancyListID = NULL;
		$tmp = NULL;

		// 1. Check existence of the fancy list for the current user and proceed only when it exists
		$this->db->select('fancy_list_id  AS fancyListID');
		$this->db->select('fancy_list_name AS fancyListName');
		
		$this->db->from('fancy_list');
		
		$this->db->where('fancy_list_id', $listID);
		$this->db->where('user_id', $userID);

		$q1 = $this->db->get();

		switch($q1->num_rows() > 0)
		{
			case TRUE:	$tmp = $q1->result();

						if( strcmp($tmp[0]->fancyListName, "Things I Love!") === 0 )
						{
							return array('result' => FALSE, 'error' => "Default list can not be deleted!");
						}
						else
						{
							// execution reached this point means the list exists and is not the default list "Things I Love!"
							// we now need to find out all the products in the current list and
							// migrate them to the Things I Love! list for the current user
							
							// find a list of all products in the specified fancy list for the current user
							$this->db->select('product_id AS productID');

							$this->db->from('fancy_products');

							$this->db->where('fancy_list_id', $listID);
							$this->db->where('user_id', $userID);

							$q2 = $this->db->get();

							switch($q2->num_rows() > 0)
							{
								case TRUE:	$productsInCurrentList = $q2->result();
											
											$tmp = array();
											
											foreach($productsInCurrentList as $product)
											{
												$tmp[] = $product->productID;
											}

											$productsInCurrentList = $tmp;

											// find the list ID of the current user's default fancy list "Things I Love!"
											// check if there already exists a list for this user
											$this->db->select('fancy_list_id AS fancyListID');
											
											$this->db->from('fancy_list');
											
											$this->db->where('user_id', $userID);
											$this->db->where('fancy_list_name', 'Things I Love!');

											$q3 = $this->db->get();

											switch($q3->num_rows() > 0)
											{
												case TRUE:	$tmp = $q3->result();
															$tmp = $tmp[0]->fancyListID;
															$defaultFancyListID = $tmp;
													break;
												case FALSE:	// create a new fancy list for the user
															$tmp = array();
															$tmp['user_id'] = $userID;
															$tmp['fancy_list_name'] = 'Things I Love!';
															
															$q4 = $this->db->insert('fancy_list', $tmp);

															if ($q4)
															{
																$defaultFancyListID = $this->db->insert_id();
															}
															else
															{
																return array('result' => FALSE, 'error' => "No default list found and failed to create a default fancy list(\"Things I Love!\") for the current user as well!");
															}
													break;
											}

											switch( ! is_null($defaultFancyListID) )
											{
												case TRUE:	// find if any of the products in the current list already exist in the "Things I Love!"
															$this->db->select('product_id AS productID');

															$this->db->from('fancy_products');

															$this->db->where('fancy_list_id', $defaultFancyListID);
															$this->db->where('user_id', $userID);
															$this->db->where_in('product_id', $productsInCurrentList);

															$q5 = $this->db->get();

															switch($q5->num_rows() > 0)
															{
																case TRUE:	$productsInDefaultList = $q5->result();
																			
																			$tmp = array();

																			foreach($productsInDefaultList as $product)
																			{
																				$tmp[] = $product->productID;
																			}

																			$productsInDefaultList = $tmp;

																			$tmp = array_merge($productsInDefaultList, $productsInCurrentList);

																			$tmp = array_unique($tmp); // the final list of products that will be added to the default fancy list

																			$productsToMoveArray = $tmp;
																	break;
																case FALSE:	$productsToMoveArray = $productsInCurrentList;
																	break;
															}
													break;
												case FALSE:	return array('result' => FALSE, 'error' => "No default list was found. Probably, this error will never be seen. If it does, the Server / OS must have reached an exception!");
													break;
											}
									break;
								case FALSE:	// if execution reaches this point, it means that there are no products in the specified fancy list
											// hence we don't need to move any products, just delete the specified fancy list
									break;
							}
						}

						switch(! is_null($productsToMoveArray) )
						{
							case TRUE:	$this->db->set('fancy_list_id', $defaultFancyListID);

										$this->db->where('user_id', $userID);
										$this->db->where('fancy_list_id', $listID);
										$this->db->where_in('product_id', $productsToMoveArray);

										$this->db->update('fancy_products'); // IMP: HANDLE THE RETURN VALUE FROM THIS QUERY SOMEHOW ---SAM
								break;
							case FALSE:	// if execution reaches this point, it means that there are no products to move and hence we will
										// just break out and delete the entry from the fancy list table
								break;
						}
						return array('result' =>  $this->db->delete( 'fancy_list', array('fancy_list_id' => $listID, 'user_id' => $userID) ), 'defaultFancyListID' => ($defaultFancyListID === NULL? $this->defaultFancyListID($userID): $defaultFancyListID) );
				break;
			case FALSE:	return array('result' => NULL, 'error' => "Specified fancy list not found for the current user");
				break;
		}
	}

	public function usersJoinedBetween( $startDate, $endDate )
    {
        $q1SQL = "SELECT `user_details`.`username`, `user_details`.`email`, `user_details`.`full_name`, `user_details`.`gender`, `user_details`.`joined_date`,`user_details`.`date_of_birth`";
        $q1SQL .= " FROM `user_details` WHERE `user_details`.`joined_date` >= '".$startDate."' AND `user_details`.`joined_date` <= '".$endDate."'";

        log_message( 'DEBUG', "QUERY BEING EXECUTED IS___\r\n".$q1SQL );
        
        $q1 = $this->db->query( $q1SQL );

        log_message( 'DEBUG', "QUERY THAT WAS EXECUTED IS___\r\n".$this->db->last_query() );

        $q1NumRows = $q1->num_rows();
        
        switch( $q1NumRows > 0 )
        {
            case TRUE:	return  $q1->result();
                break;
            case FALSE:	return FALSE;
            	break;
        }
    }

    public function visitors( $userID = NULL, $startFrom = 0, $maxResults = 5)
    {
    	switch ( $userID !== NULL && is_numeric( $userID ) )
    	{
    		case TRUE:	$q1SQL = "SELECT `ud`.`user_id` AS `visitorID`, `ud`.`fb_uid` AS `visitorFBID`, `ud`.`full_name` AS `visitorName`, `ud`.`gender` AS `visitorGender`";
    					$q1SQL .= " FROM `profile_visits` JOIN `user_details` `ud` ON `profile_visits`.`visitor_id` = `ud`.`user_id` WHERE `profile_visits`.`user_id` = ".$userID;
    					$q1SQL .= " ORDER BY `visited` DESC LIMIT ".$maxResults." OFFSET ".( $startFrom * $maxResults );
    					
    					$q1 = $this->db->query( $q1SQL );

    					switch( $q1->num_rows() > 0 )
    					{
    						case TRUE:	return $q1->result();
    							break;
    						case FALSE:	return NULL;
    							break;
    					}
    			break;
    		case FALSE:	return NULL;
    			break;
    	}
    }
}
?>