<?php if( !defined('BASEPATH') ) exit('403 Unauthorized');

class Coupons_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function userCoupons($userID, $filterUnusable = FALSE)
	{
		$this->db->select('sno AS couponSerialNumber');
		$this->db->select('couponid AS couponID');
		$this->db->select('percentoff AS couponValue');
		$this->db->select('usecount AS couponsCount');
		$this->db->select('discounttype AS couponType');
		$this->db->select('validFrom');
		$this->db->select('validUpto');
		$this->db->select('minPurchaseAmount');
		$this->db->select('user_id AS userID');
		$this->db->select('param1');
		$this->db->from('coupon');
		$this->db->where('validFrom <= '.time());
		$this->db->where('validUpto >= '.time());
		$this->db->where('visibility', 1);
		$this->db->where('(user_id ='.$userID.' OR user_id = 0)');
		if($filterUnusable === TRUE)
		{
			$this->db->where('usecount > 0');
		}
		$result = $this->db->get();
		log_message('INFO', "async_model/userCoupons just ran the query: ".$this->db->last_query());
		switch($result->num_rows() > 0)
		{
			case TRUE: return $result->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function isLoggedIN()
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/isLoggedIN');
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
					 return array("status" => TRUE, "uid" => $userID, "ip" => $__ip);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is not "logged-in" ');
					  log_message('INFO', 'Will now try to retrieve header data for "nobody"');
					  return array("status" => FALSE, "uid" => NULL, "ip" => $__ip);
				break;
		}
	}

	public function storeID2Name($storeID = NULL)
	{
		switch(! is_null($storeID) && is_numeric($storeID) )
		{
			case TRUE:	$this->db->select('store_name');

						$this->db->from('store_info');

						$this->db->where('store_id', $storeID);

						$this->db->limit(1);

						$q1 = $this->db->get();

						switch($q1->num_rows() > 0)
						{
							case TRUE:	$t = $q1->result();
										return $t[0]->store_name;
								break;
						}
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	public function catID2URL($catID = NULL)
	{
		$url = "";
		$catName = "";
		switch(! is_null($catID) && is_numeric($catID) )
		{
			case TRUE:	$parentID = NULL;
						$tCatID = $catID;
						do
						{
							$this->db->select('category_name AS catName, parent_catagory_id AS parentID');

							$this->db->from('catagories');

							$this->db->where( 'category_id', $tCatID );

							$this->db->limit(1);

							$q1 = $this->db->get();

							switch($q1->num_rows() > 0)
							{
								case TRUE:	$t = $q1->result();
											if($parentID === NULL ) // if this is the first iteration
											{
												$url = preg_replace( '/\s+/', '-', trim( preg_replace( '/\W/', ' ', $t[0]->catName ) ) )."/".$tCatID;
												$catName = $t[0]->catName;
											}
											else
											{
												$url = preg_replace( '/\s+/', '-', trim( preg_replace( '/\W/', ' ', $t[0]->catName ) ) )."/".$url;
											}
											$parentID = ($t[0]->parentID == 0)? 0: $t[0]->parentID; // this line ensures that the value in parentID is 0 with data-type integer
											$tCatID = $parentID;
									break;
							}

						}while($parentID !== 0);
						return array( $url, $catName );
				break;
			case FALSE:	return NULL;
				break;
		}
	}
}
?>