<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');
class People_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(FALSE);
	}

	public function getPeopleData( $sortBy = NULL, $startFrom = NULL, $maxResults = NULL, $userID )
	{
		log_message( 'DEBUG', time() );
		switch( $sortBy === NULL || !is_numeric( $sortBy ) || $sortBy < 1 || $sortBy > 4 )
		{
			case TRUE:	$sortBy = 1;
				break;
		}

		switch( $startFrom === NULL || !is_numeric( $startFrom ) )
		{
			case TRUE:	$startFrom = 0;
				break;
		}

		switch( $maxResults === NULL || !is_numeric( $maxResults ) )
		{
			case TRUE:	$maxResults = 20;
				break;
		}

		$q1SQL = NULL;

		switch( $sortBy )
		{
			case 1:	$q1SQL = "SELECT `user_details`.`user_id` AS `userID`, `user_details`.`fb_uid` AS `userFBID`,";
					$q1SQL .= " `user_details`.`full_name` AS `userFullName`, `user_details`.`nick_name` AS `userNickName`, `user_details`.`gender` AS `userGender`,";
					$q1SQL .= " `user_details`.`city` AS `userCity`, `user_details`.`country` AS `userCountry`, `user_details`.`date_of_birth` AS `userDOB`,";
					$q1SQL .= " `user_details`.`state` AS `userState`,`user_details`.`userRank` AS `userRank`, `user_details`.`about_me` AS `userAboutMe`,";
					$q1SQL .= " `user_details`.`fancy_counter` AS `totalFanciedProducts`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`followee_id` = `user_details`.`user_id`) AS `totalFollowers`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`follower_id` = `user_details`.`user_id`) AS `totalFollowing`";
					$q1SQL .= " FROM `user_details`";
					$q1SQL .= " WHERE `user_details`.`isActive` = 1 AND `user_details`.`userRank` > 0 ORDER BY `user_details`.`userRank` ASC";
					$q1SQL .= " LIMIT ".$maxResults." OFFSET ".( $startFrom * $maxResults );
				break;
			case 2: $q1SQL = "SELECT `user_details`.`user_id` AS `userID`, `user_details`.`fb_uid` AS `userFBID`,";
					$q1SQL .= " `user_details`.`full_name` AS `userFullName`, `user_details`.`nick_name` AS `userNickName`, `user_details`.`gender` AS `userGender`,";
					$q1SQL .= " `user_details`.`city` AS `userCity`, `user_details`.`country` AS `userCountry`, `user_details`.`date_of_birth` AS `userDOB`,";
					$q1SQL .= " `user_details`.`state` AS `userState`,`user_details`.`userRank` AS `userRank`, `user_details`.`about_me` AS `userAboutMe`,";
					$q1SQL .= " `user_details`.`fancy_counter` AS `totalFanciedProducts`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`followee_id` = `user_details`.`user_id`) AS `totalFollowers`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`follower_id` = `user_details`.`user_id`) AS `totalFollowing`";
					$q1SQL .= " FROM `user_details`";
					$q1SQL .= " WHERE `user_details`.`isActive` = 1 ORDER BY `totalFollowers` DESC";
					$q1SQL .= " LIMIT ".$maxResults." OFFSET ".( $startFrom * $maxResults );
				break;
			case 3: $q1SQL = "SELECT DISTINCT `user_details`.`fb_uid` AS `userFBID`, `user_details`.`user_id` AS `userID`, `user_details`.`gender` AS `userGender`,";
					$q1SQL .= " `user_details`.`full_name` AS `userFullName`, `user_details`.`nick_name` AS `userNickName`, `user_details`.`gender` AS `userGender`,";
					$q1SQL .= " `user_details`.`city` AS `userCity`, `user_details`.`country` AS `userCountry`, `user_details`.`date_of_birth` AS `userDOB`,";
					$q1SQL .= " `user_details`.`state` AS `userState`,`user_details`.`userRank` AS `userRank`, `user_details`.`about_me` AS `userAboutMe`,";
					$q1SQL .= " `user_details`.`fancy_counter` AS `totalFanciedProducts`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`followee_id` = `user_details`.`user_id`) AS `totalFollowers`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`follower_id` = `user_details`.`user_id`) AS `totalFollowing`";
					$q1SQL .= " FROM `user_details`, `follow_friends`";
					$q1SQL .= " WHERE `f_type` = 1 AND ( ( `user_details`.`user_id` = `follow_friends`.`followee_id` AND `follower_id` = ".$userID." )";
					$q1SQL .= " OR ( `user_details`.`user_id` = `follow_friends`.`follower_id` AND `followee_id` = ".$userID.") ) ORDER BY `totalFollowers` DESC";
					$q1SQL .= " LIMIT ".$maxResults." OFFSET ".( $startFrom * $maxResults );
				break;
			case 4:	$q1SQL = "SELECT `handpicked_users`.`user_id` AS `userID`, `user_details`.`fb_uid` AS `userFBID`,";
					$q1SQL .= " `user_details`.`full_name` AS `userFullName`, `user_details`.`nick_name` AS `userNickName`, `user_details`.`gender` AS `userGender`,";
					$q1SQL .= " `user_details`.`city` AS `userCity`, `user_details`.`country` AS `userCountry`, `user_details`.`date_of_birth` AS `userDOB`,";
					$q1SQL .= " `user_details`.`state` AS `userState`,`user_details`.`userRank` AS `userRank`, `user_details`.`about_me` AS `userAboutMe`,";
					$q1SQL .= " `user_details`.`fancy_counter` AS `totalFanciedProducts`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`followee_id` = `user_details`.`user_id`) AS `totalFollowers`,";
					$q1SQL .= " (SELECT COUNT(`follow_friends`.`f_no`) FROM `follow_friends` WHERE `follow_friends`.`follower_id` = `user_details`.`user_id`) AS `totalFollowing`";
					$q1SQL .= " FROM `handpicked_users`";
					$q1SQL .= " LEFT JOIN `user_details` ON `handpicked_users`.`user_id` = `user_details`.`user_id`";
					$q1SQL .= " WHERE `user_details`.`isActive` = 1 ORDER BY `handpicked_users`.`sort_order` ASC";
					$q1SQL .= " LIMIT ".$maxResults." OFFSET ".( $startFrom * $maxResults );
				break;
		}

		$q1 = $this->db->query( $q1SQL );

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$r1 = $q1->result();

						$retVal = array();
						foreach( $r1 as $tr1 )
						{
							
							$q2SQL = "SELECT `fancy_products`.`product_id` AS `productID`, `products`.`product_name` AS `productName`, `products`.`store_id` AS `storeID`,";
							$q2SQL .= " (`products`.`fancy_counter`)+(`products`.`brag_counter`)+(`products`.`visit_counter`) AS `mostPopular`";
							$q2SQL .= " FROM `fancy_products` JOIN `products` ON `fancy_products`.`product_id` = `products`.`product_id`";
							$q2SQL .= " WHERE `products`.`status` = 1 AND `products`.`is_enable` = 0 AND `fancy_products`.`user_id` = ".$tr1->userID;
							$q2SQL .= " ORDER BY `products`.`lastFanciedAt` DESC LIMIT 4";

							$q2 = $this->db->query( $q2SQL );

							$t['productDetails'] = NULL;
							switch( $q2->num_rows() > 0 )
							{
								case TRUE:	$t['productDetails'] = $q2->result();
									break;
							} 
							$t['userDetails'] = $tr1;
							$retVal[] = $t;
						}
						return $retVal;
				break;
			case FALSE:	return NULL;
				break;
		}
	}
}
?>