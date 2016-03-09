<?php if( ! defined( 'BASEPATH' ) ) exit('403 Unauthorized');
class Products_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function info($pid, $params = NULL)
	{
		$retVal = NULL;
		$this->db->select('product_name AS productName');
		$this->db->select('store_id AS storeID');
		$this->db->select('cat_id AS catID');
		$this->db->select('sub_catid1 AS subCatID1');
		$this->db->from('products');
		$this->db->where('product_id', $pid);
		$q = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY________\r\n".$this->db->last_query());
		switch($q->num_rows() > 0)
		{
			case TRUE:	$retVal = $q->result();
				break;
		}
		return $retVal;
	}

	public function similarProducts($pid, $startFrom = NULL)
	{
		$retVal = NULL;
		$this->db->select('cat_id AS catID');
		$this->db->select('sub_catid1 AS subCatID1');
		$this->db->from('products');
		$this->db->where('product_id', $pid);
		$q1 = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY________\r\n".$this->db->last_query());
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$tmp = $q1->result();
						$tmp = $tmp[0];
						$this->db->select('product_id AS productID');
						$this->db->select('products.store_id AS storeID');
						$this->db->select('product_name AS productName');
						$this->db->select('store_info.store_name AS storeName');
						$this->db->from('products');
						$this->db->join('store_info', 'products.store_id = store_info.store_id', 'left');
						$this->db->where('cat_id', $tmp->catID);
						$this->db->where('sub_catid1', $tmp->subCatID1);
						$this->db->where('products.status', 1);
						$this->db->where('products.is_enable', 0);
						$this->db->order_by('products.added_on', 'desc');
						switch( is_null($startFrom) )
						{
							case TRUE:	$this->db->limit(48, 0);
								break;
							case FALSE:	$this->db->limit(48, 48*$startFrom);
								break;
						}
						$q2 = $this->db->get();
						switch($q2->num_rows() > 0)
						{
							case TRUE:	$retVal = $q2->result();
								break;
						}
				break;
		}
		return $retVal;
	}

	public function fanciedUsersFancies($pid, $startFrom = NULL)
	{
		$retVal = NULL;
		$this->db->select('user_id AS userID');
		$this->db->from('fancy_products');
		$this->db->where('product_id', $pid);
		$q1 = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY________\r\n".$this->db->last_query());
		$usersCount = $q1->num_rows();
		switch($usersCount > 0)
		{
			case TRUE:	$tmp = $q1->result();
						$tmpUsers = array();
						foreach($tmp as $tmpUser)
						{
							$tmpUsers[] = $tmpUser->userID;
						}

						$whereText = NULL;

						if($usersCount > 1)
						{
							//$whereText = "user_id IN(".implode(",", $tmpUsers).") AND products.status = 1 AND products.is_enable = 0 ORDER BY FIELD(fancy_products.user_id,".implode(",", $tmpUsers).")";
							$whereText = "user_id IN(".implode(",", $tmpUsers).") AND products.status = 1 AND products.is_enable = 0 ORDER BY fancy_products.time DESC";
						}
						else
						{
							$whereText = "user_id = ".$tmpUsers[0]." AND products.status = 1 AND products.is_enable = 0 ORDER BY fancy_products.time DESC";
						}

						$this->db->select('DISTINCT(fancy_products.product_id) AS productID');
						$this->db->select('products.store_id AS storeID');
						$this->db->select('product_name AS productName');
						$this->db->select('store_info.store_name AS storeName');
						$this->db->from('fancy_products');
						$this->db->join('products', 'fancy_products.product_id = products.product_id', 'left');
						$this->db->join('store_info', 'products.store_id = store_info.store_id', 'left');
						$this->db->where($whereText);
						//$this->db->order_by('fancy_products.time', 'desc');
						switch( is_null($startFrom) )
						{
							case TRUE:	$this->db->limit(48, 0);
								break;
							case FALSE:	$this->db->limit(48, 48*$startFrom);
								break;
						}
						$q2 = $this->db->get();
						switch($q2->num_rows() > 0)
						{
							case TRUE:	$retVal = $q2->result();
								break;
						}
				break;
		}
		return $retVal;
	}

	public function fanciedUsers($pid, $startFrom = NULL)
	{
		$retVal = NULL;
		$currentUserID = ($this->session->userdata('id') !== FALSE)? $this->session->userdata('id'): "'%'";
		$this->db->select('fancy_products.user_id AS userID');
		$this->db->select('full_name AS userFullName');
		$this->db->select('fb_uid AS userFBID');
		$this->db->select('gender AS userGender');
		$this->db->select('(SELECT COUNT(DISTINCT(f1.product_id)) FROM fancy_products f1 WHERE f1.user_id = fancy_products.user_id) AS totalFanciedProducts');
		$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE followee_id = fancy_products.user_id) as totalFollowers');
		$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE follower_id = fancy_products.user_id) as totalFollowing');
		$this->db->select('(IF((SELECT COUNT(f_no) FROM follow_friends ff2 where ff2.follower_id = '.$currentUserID.' and ff2.followee_id = fancy_products.user_id), TRUE, FALSE)) AS hasFollowed', FALSE);
		
		$this->db->from('fancy_products');
		
		$this->db->join('user_details', 'fancy_products.user_id = user_details.user_id', 'left');
		
		$this->db->where('fancy_products.product_id', $pid);

		switch( is_null($startFrom) )
		{
			case TRUE:	$this->db->limit(15);
				break;
			case FALSE:	$this->db->limit(15, 15*$startFrom);
				break;
		}
		$q1 = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY________\r\n".$this->db->last_query());
		$usersCount = $q1->num_rows();
		switch($usersCount > 0)
		{
			case TRUE:	$retVal = $q1->result();
				break;
		}
		return $retVal;
	}
}
?>