<?php if( ! defined( 'BASEPATH' ) ) exit('403 Unauthorized');

class Mutual_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function products( $currentUserID, $userID, $startFrom, $maxResults )
	{
		switch($startFrom === NULL || ! is_numeric($startFrom) )
		{
			case TRUE:	$startFrom = 0;
				break;
		}

		switch($maxResults === NULL || ! is_numeric($maxResults) )
		{
			case TRUE:	$maxResults = 50;
				break;
		}

		$q1SQL  = "SELECT `f1`.`product_id` AS `productID`, `products`.`product_name` AS `productName`,";
		$q1SQL .= " `products`.`store_id` AS `storeID`, `store_info`.`store_name` AS `storeName`,";
		$q1SQL .= " `f1`.`time` AS `currentUserFancyTime`, `f2`.`time` AS `userFancyTime`";
		$q1SQL .= " FROM `fancy_products` `f1`";
		$q1SQL .= " JOIN `fancy_products` `f2` ON `f1`.`product_id` = `f2`.`product_id`";
		$q1SQL .= " JOIN `products` ON `f1`.`product_id` = `products`.`product_id`";
		$q1SQL .= " JOIN `store_info` ON `products`.`store_id` = `store_info`.`store_id`";
		$q1SQL .= " WHERE `f1`.`user_id` = ".$currentUserID." AND `f2`.`user_id` = ".$userID;
		$q1SQL .= " ORDER BY `f1`.`time` DESC LIMIT ".$maxResults." OFFSET ".( $startFrom * $maxResults );

		$q1 = $this->db->query( $q1SQL );

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	return $q1->result();
				break;
			case TRUE:	return NULL;
				break;
		}
	}
}
?>