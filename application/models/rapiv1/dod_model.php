<?php if ( ! defined ( 'BASEPATH' ) ) exit('403 Unauthorized!');
/*
CREATE TABLE `bnbdbTest`.`dod_products`
(
	`dodItemID` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`product_id` BIGINT UNSIGNED NOT NULL DEFAULT 0,
	`dealID` BIGINT UNSIGNED NOT NULL DEFAULT 0,
	`dodPrice` DOUBLE(10,2) DEFAULT 0.00,
	KEY `dealID` (`dealID`),
	KEY `product_id` (`product_id`),
	KEY `dodPrice` (`dodPrice`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `bnbdbTest`.`dealoftheday`
(
	`dealID` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`dealName` VARCHAR(64) NOT NULL DEFAULT 'Today\'s Deal',
	`startFrom` BIGINT UNSIGNED NOT NULL DEFAULT 0,
	`endOn` BIGINT UNSIGNED NOT NULL DEFAULT 0,
	KEY `startFrom` (`startFrom`),
	KEY `endOn` (`endOn`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
class Dod_model extends CI_Model
{
	public function __construct()
	{
		$this->output->enable_profiler(FALSE);
		parent::__construct();
	}

	public function hasDods()
	{
		$retVal = array( 'hasDods' => FALSE, 'dods' => NULL );
		
		$q1SQL = "SELECT `dealID`, `dealName`, `startFrom`, `endOn` FROM `dealoftheday` WHERE `startFrom` <= ".time()." AND `endOn` > ".time();

		$q1 = $this->db->query( $q1SQL );

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$retVal['hasDods'] = TRUE;
						$retVal['dods'] = $q1->result();
				break;
		}

		return $retVal;
	}

	public function dodProducts( $dealID, $userID = FALSE, $isLoggedIN = FALSE, $startFrom = NULL, $maxResults = NULL )
	{
		$q1SQL = "SELECT `dod_products`.`product_id` AS `productID`, `products`.`lastFanciedBy` AS `userID`, `products`.`store_id` AS `storeID`,";
        $q1SQL .= " `products`.`fancy_counter` AS `productFancyCounter`, `products`.`is_on_discount` AS `productIsOnDiscount`,";
        
		$q1SQL .= " `products`.`selling_price` AS `productSellingPrice`, `products`.`discount` AS `productDiscount`,";
        $q1SQL .= " `products`.`bbucks` AS `bbucks`, `products`.`product_name` AS `productName`, `products`.`visit_counter` AS `productVisitCounter`,";
        $q1SQL .= " `products`.`quantity` AS `productQuantity`,";
        $q1SQL .= " `products`.`lFUBadgeType` AS `badgeType`, `products`.`lFUBadgeLevel` AS `badgeLevel`, `products`.`lFUBadgeNotificationText` AS `badgeNotificationText`,";

		$q1SQL .= " `user_details`.`userRank` AS `userRank`, `user_details`.`username` AS `userName`, `user_details`.`full_name` AS `userFullName`,";
		$q1SQL .= " `user_details`.`fb_uid` as `userFBID`, `user_details`.`gender` AS `userGender`,";
		
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		
		$userID = ( $isReallyLoggedIN === FALSE ) ? '%': $userID;

		$q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `fancy_products` f1 WHERE (`f1`.`user_id` = ".$userID." AND `f1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasFancied`,";
		$q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `brag_products` b1 WHERE (`b1`.`user_id` = ".$userID." AND `b1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasbragged`";
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$q1SQL .= " FROM `dod_products`";
		$q1SQL .= " LEFT JOIN `products` ON `dod_products`.`product_id`=`products`.`product_id`";
		$q1SQL .= " LEFT JOIN `user_details` ON `products`.`lastFanciedBy`=`user_details`.`user_id`";
		$q1SQL .= " WHERE `products`.`status` = 1"; // pick products whose store is enabled
		$q1SQL .= " AND `products`.`is_enable` = 0"; // pick products which are enabled
		/*$q1SQL .= " ORDER BY `lastFanciedAt` DESC"; // sort the products by the time there were fancied in descending order*/

		switch( is_null( $startFrom ) )
		{
			case TRUE: $q1SQL .= " LIMIT 50"; // by default only pick 50 products
				break;
			case FALSE: switch( is_null( $maxResults ) )
					  {
						case TRUE: $q1SQL .= " LIMIT 50 OFFSET ".( $startFrom * 50 );
							break;
						case FALSE: $q1SQL .= " LIMIT ".$maxResults." OFFSET ".( $maxResults * $startFrom );
							break;
					  }
				break;
		}

		$q1 = $this->db->query( $q1SQL );

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	return $q1->result();
				break;
			case FALSE:	return NULL;
				break;
		}
	}
}
?>