<?php

class Cartdb extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function canPurchase($userID = NULL)
	{
		if( !is_null($userID) && is_numeric($userID) )
		{
			$this->db->select('canPurchase');
			$this->db->from('user_details');
			$this->db->where('user_id', $userID);
			$query = $this->db->get();
			switch($query->num_rows() > 0)
			{
				case TRUE:	$result = $query->result();
							$result = $result[0]->canPurchase;
							switch($result)
							{
								case 1:	return TRUE;
									break;
								default:	return FALSE;
									break;
							}
					break;
				case FALSE:	return FALSE;
					break;
			}
		}
		else
		{
			return FALSE;
		}
	}

	function mycartforuser_original($userid)
	{
		$this->db->select('cart.*,products.*,store_info.COD_policy');
		$this->db->from('cart');
		$this->db->join('products', 'cart.product_id = products.product_id');
		$this->db->join('store_info', 'cart.store_id = store_info.store_id');
		$this->db->where('user_id', $userid);
		$this->db->order_by('cart.store_id', "asc");
		//$this->db->where('cart.store_id',$storeid);
		$result = $this->db->get();
		return $result->result();
	}

	/* START changes and additions by shammi */
	function mycartforuser($userid)
	{
		$this->db->select( 'cart.cart_id' );
		$this->db->select( 'cart.user_id' );
		$this->db->select( 'cart.product_id' );
		$this->db->select( 'cart.cart_quantity' );
		$this->db->select( 'cart.store_id' );
		$this->db->select( 'cart.vsize' );
		$this->db->select( 'cart.vcolor' );
		$this->db->select( 'products.product_id' );
		$this->db->select( 'products.product_name' );
		$this->db->select( 'products.bnb_product_code' );
		$this->db->select( 'products.selling_price' );
		$this->db->select( 'products.shipping_partner' );
		$this->db->select( 'products.is_on_discount' );
		$this->db->select( 'products.discount' );
		$this->db->select( 'products.quantity' );
		$this->db->select( 'products.tax_rate' );
		$this->db->select( 'products.shipping_cost' );
		$this->db->select( 'store_info.COD_policy' );
		$this->db->from( 'cart' );
		$this->db->join( 'products', 'cart.product_id = products.product_id' );
		$this->db->join( 'store_info', 'cart.store_id = store_info.store_id' );
		$this->db->where( 'products.is_enable', 0 );
		$this->db->where( 'products.status', 1 );
		$this->db->where( 'products.quantity >= cart.cart_quantity' );
		$this->db->where( 'store_info.isPublished', 1 );
		$this->db->where( 'user_id', $userid );
		$this->db->order_by( 'cart.store_id', "asc" );
		//$this->db->where('cart.store_id',$storeid);
		$result = $this->db->get();
		return $result->result();
	}
	
	function selectOneWeekOldProducts()
	{
		$this->db->select('cart.user_id AS userID');
		$this->db->select('cart.product_id AS productID');
		$this->db->select('cart.store_id AS storeID');
		$this->db->select('user_details.full_name AS fullName');
		$this->db->from('cart');
		$this->db->join('user_details', 'user_details.user_id = cart.user_id');
		$this->db->order_by('cart.user_id', 'desc');
		$oneWeekOldTimestamp = strtotime("-6 days");
		$mysqlTs = date("Y-m-d H:i:s", $oneWeekOldTimestamp);
		$mysqlTs = explode(" ", $mysqlTs);
		$mysqlTs = $mysqlTs[0];
		$this->db->where('cart.timestamp <= '.$mysqlTs);
		$result = $this->db->get();
		log_message("INFO", "running the following query:\r\n".print_r($mysqlTs, TRUE));
		return $result->result();
	}
	
	function mycartforuserCount($userid)
	{
		$this->db->select('count(*) as totalCartItems');
		$this->db->from('cart');
		$this->db->join('products', 'cart.product_id = products.product_id');
		$this->db->join('store_info', 'cart.store_id = store_info.store_id');
		$this->db->where('user_id', $userid);
		$this->db->order_by('cart.store_id', "asc");
		//$this->db->where('cart.store_id',$storeid);
		$result = $this->db->get();
		return $result->result();
	}

	/* END changes and additions by shammi */
	function cart_placeorder($userid)
	{
		$this->db->select('cart.*, products.*, store_info.COD_policy');
		$this->db->from('cart');
		$this->db->join('products', 'cart.product_id = products.product_id');
		$this->db->join('store_info', 'cart.store_id = store_info.store_id');
		$this->db->where('user_id', $userid);
		$this->db->order_by('cart.store_id', "asc");
		//$this->db->where('cart.store_id',$storeid);
		$result = $this->db->get();
		return $result->result();
	}

	function usercart($userid)
	{
		$this->db->select( 'cart.cart_id , cart.product_id , cart.store_id , store_info.COD_policy' );
		$this->db->from( 'cart' );
//		$this->db->join('products','cart.product_id = products.product_id');
		$this->db->join( 'store_info', 'cart.store_id = store_info.store_id' );
		$this->db->where( 'user_id', $userid );
//		$this->db->order_by('cart.store_id',"asc");
		//$this->db->where('cart.store_id',$storeid);
		$result = $this->db->get();
		return $result->result();
	}

	public function getTotalPurchaseAmount( $userID = NULL )
	{
		if( $userID !== NULL )
		{
			$q1SQL = "SELECT  SUM( IF(`products`.`is_on_discount` = 1, (`products`.`selling_price` - `products`.`discount`) * `cart_quantity`, `products`.`selling_price` * `cart_quantity`) ) AS `totalPurchaseAmount`";
			$q1SQL .= " FROM `cart` ";
			$q1SQL .= " JOIN `products` ON `cart`.`product_id` = `products`.`product_id`";
			$q1SQL .= " JOIN `store_info` ON `cart`.`store_id` = `store_info`.`store_id`";
			$q1SQL .= " WHERE `cart`.`user_id` = ".$userID;
			$q1SQL .= " AND `products`.`is_enable` = 0 AND `products`.`status` = 1";
			$q1SQL .= " AND `products`.`quantity` >= `cart`.`cart_quantity` AND `store_info`.`isPublished` = 1";

			log_message('DEBUG', "cartdb/getTotalPurchaseAmount:::Running Query__\r\n".$q1SQL );

			$q1 = $this->db->query( $q1SQL );

			switch( $q1->num_rows() > 0 )
			{
				case TRUE:	$r1 = $q1->result();
							return $r1[0]->totalPurchaseAmount;
					break;
				case FALSE:	return 0;
					break;
			}
		}
		else
		{
			return 0;
		}
	}

	function codcheck($userid)
	{
		$this->db->select( 'cart.product_id, cart.cart_quantity, cart.user_id, cart.store_id, cart.vsize, cart.vcolor' );
		$this->db->select( 'products.is_on_discount, products.selling_price, products.discount, products.bnb_product_code' );
		$this->db->select( 'products.shipping_partner, store_info.COD_policy' );
		$this->db->from( 'cart' );

		$this->db->join( 'products', 'cart.product_id = products.product_id' );
		$this->db->join( 'store_info', 'cart.store_id = store_info.store_id' );
		
		$this->db->where( 'COD_policy', 1 );
		$this->db->where( 'store_info.isPublished', 1 );
		$this->db->where( 'products.is_enable', 0 );
		$this->db->where( 'products.status', 1 );
		$this->db->where( 'user_id', $userid );
		
		$result = $this->db->get();
		
		return $result->result();
	}

	public function codcheckShammiCheckOut2nd($userid)
	{
		$this->db->select('cart.cart_id');
		$this->db->select('cart.cart_quantity');
		$this->db->select('store_info.COD_policy');
		
		$this->db->from('cart');
		
		$this->db->join('products', 'cart.product_id = products.product_id');
		$this->db->join('store_info', 'cart.store_id = store_info.store_id');
		
		//$this->db->where('COD_policy', 1);
		
		$this->db->where('cart.user_id', $userid);
		
		$result = $this->db->get();
		
		switch($result->num_rows() > 0)
		{
			case TRUE:	return array(TRUE, $result->result());
				break;
			case FALSE: return array(FALSE, NULL);
				break;
		}
	}

	/*
		added by rajeeb
	   */
	function deleteMyCart($cart_id, $u_id)
	{
		$this->db->where('cart_id', $cart_id)
			->where('user_id', $u_id)
			->delete('cart');


	}
	
	/* CHANGED BY SHAMMI SHAILAJ TO DETELE PRODUCTS WHICH ARE OUT OF STOCK AND fix the issue where cart quantity was not being updated */
	function updateMyCart($no, $cart_id, $u_id)
	{
		log_message('INFO', "cartdb/updateMyCart fired");
		$this->db->set('cart_quantity', $no);
		$this->db->where('cart_id', $cart_id);
		$this->db->where('user_id', $u_id);
		$retVal1 = $this->db->update('cart');
		log_message("INFO", 'JUST RAN THE FOLLOWING QUERY_____________________'.print_r($this->db->last_query(), TRUE));
	}
	
	function isINStock($productID)
	{
		log_message('INFO',  "inside cartdb/isINStock. productID = ".$productID);
		$this->db->select('quantity');
		$this->db->from('products');
		$this->db->where('`product_id` = '.$productID, NULL, FALSE);
		$this->db->limit(1);
		$query = $this->db->get();
		log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________\r\n".print_r($this->db->last_query(), TRUE));
		$result = $query->result();
		log_message('INFO', " Data returned____".print_r($result, TRUE));
		$retVal = NULL;
		switch($query->num_rows() > 0)
		{
			case TRUE: $retVal = (($result[0]->quantity > 0)? TRUE: FALSE);
				break;
			case FALSE: $retVal =  FALSE;
		}
		log_message('INFO', " exiting cartdb/isINStock. \$retVal = ".$retVal);
		return $retVal;
	}
	
	function productIDFromCartID($cartID)
	{
		$this->db->select('cart.product_id');
		/*$this->db->select('products.quantity');*/
		$this->db->from('cart');
		/*$this->db->join('products', 'products.product_id = cart.product_id');*/
		$this->db->where('cart.cart_id', $cartID);
		$this->db->limit(1);
		$query = $this->db->get();
		log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________\r\n".print_r($this->db->last_query(), TRUE));
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			log_message('INFO', "returning FALSE");
			return FALSE;
		}
	}
	
	function updateMyCartNew($cartData, $userID)
	{
		log_message('INFO', "cartdb/updateMyCartNew fired");
		$retVals = array();
		foreach($cartData as $cartDataItem)
		{
			log_message('INFO', "cartDataItem = ".print_r($cartDataItem, TRUE));
			
			$tCartDataItem = $this->productIDFromCartID($cartDataItem['cartID']);
			if($tCartDataItem === FALSE)
			{
				log_message('INFO', "\$tCartDataItem = FALSE. This means that either the product was not in the user\'s cart or it was deleted by a prior request");
				continue;
			}
			log_message('INFO', "\$tCartDataItem = ".print_r($tCartDataItem, TRUE));
			
			$cartDataItem['product_id'] = $tCartDataItem[0]->product_id;
			$cartDataItem['cart_quantity'] = $cartDataItem['quantity'];
			
			if( $this->isINStock($cartDataItem['product_id']) )
			{
				log_message('INFO', "updating quantity-------------------");
				$this->db->set('`cart_quantity`', $cartDataItem['cart_quantity'], FALSE);
				$this->db->where("`cart_id` = ".$cartDataItem['cartID']." AND `user_id` = ".$userID, NULL, FALSE);
				$retVals[] = $this->db->update('cart');
			}
			else
			{
				log_message('INFO', "deleting cart item id: ".$cartDataItem['cartID']);
				$this->db->where("`cart_id` = ".$cartDataItem['cartID']." AND `user_id` = ".$userID, NULL, FALSE);
				$retVals[] = $this->db->delete('cart');
			}
			log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________\r\n".print_r($this->db->last_query(), TRUE));
		}
		log_message('INFO', 'exiting cartdb/updateMyCartNew. Data being returned is______'.print_r($retVals, TRUE));
		return $retVals;
	}
	/* END SECTION CHANGED BY SHAMMI SHAILAJ TO DETELE PRODUCTS WHICH ARE OUT OF STOCK AND fix the issue where cart quantity was not being updated */
	function new_order_history()
	{
		$uid = $this->session->userdata('id');
		$this->db->select('orders.order_id');
		$this->db->from('orders');
		$this->db->where('user_id', $uid);
		$this->db->where('status_order', 1);
		$this->db->where('status_order', 2);
		$this->db->where('status_order', 3);
		$result = $this->db->get();
		return $result->result();
	}

	// User Email and FullName of all user in platform
	function userlist($count, $start)
	{
		$this->db->select('email , full_name');
		$this->db->from('user_details');
		$this->db->limit($count, $start);
		$result = $this->db->get();
		return $result->result();
	}

	function checkCouponId($couponId)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', $__ip.' cartdb/checkCouponId: INIT');
		$this->db->select('sno');
		$this->db->select('couponid');
		$this->db->select('percentoff');
		$this->db->select('usecount');
		$this->db->select('discounttype');
		$this->db->select('validFrom');
		$this->db->select('validUpto');
		$this->db->select('minPurchaseAmount');
		$this->db->select('user_id AS userID');
		$this->db->select('param1');
		$this->db->from('coupon');
		$this->db->where('couponid', $couponId);
		$this->db->where('usecount > 0'); // select only those coupons which have not exhausted
		$this->db->where("validFrom <= ".time());// select only those coupons whose validity has started
		$this->db->where("validUpto > ".time()); // select only those coupons whose validity has not ended
		$this->db->limit(1); // just to ease out the db as we know there can only be one coupon for a single coupon
		$result = $this->db->get();
		log_message('INFO', $__ip." cartdb/checkCouponId: just ran \r\n".$this->db->last_query());
		log_message('INFO', $__ip." cartdb/checkCouponId: num_rows =  \r\n".$result->num_rows());
		if ($result->num_rows() > 0)
		{
			$row = $result->row_array();
			return $row;
		}
		else
		{
			return 0;
		}
	}

	/*CREATE TABLE `bnbdbTest`.`coupon_products`
	(
		`id` BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
		`couponid` VARCHAR(20) NOT NULL,
		`product_id` BIGINT UNSIGNED NOT NULL DEFAULT 0
	);*/

	public function couponProducts( $couponID )
	{
		$q1SQL = "SELECT `product_id` AS `productID` FROM `coupon_products` WHERE `couponid` = '".$couponID."'";
		$q1 = $this->db->query( $q1SQL );

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$r1 = $q1->result();
						$t = array();
						foreach ($r1 as $key => $value)
						{
							$t[] = $value->productID;
						}
						return $t;
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	function redeemCouponId($couponDetails)
	{
		//var_dump($couponDetails);
		$usecount = intval($couponDetails['usecount']);
		$queryResult = 0;
		if($usecount == 0)
		{
			/*
			$this->db->where('couponid', $couponDetails['couponid']);
			$query = $this->db->delete('coupon');
			
			if($query)
			{
				log_message('Info', 'Deleting the coupon with id: ' . $couponDetails['couponid']);
				return 1;
			}*/
			return 0;
		}
		else
		{
			$usecount = $usecount - 1;
			$this->db->set('usecount', $usecount);
			$this->db->where('couponid', $couponDetails['couponid']);
			if ($this->db->update('coupon'))
			{
				log_message('Info', 'Updating the coupon with id: ' . $couponDetails['couponid'] . ' and use count: ' . $usecount);
				return 1;
			}
		}
		return 0;
	}

	public function storeIDToName($storeID)
	{
		$this->db->select('store_name');

		$this->db->from('store_info');

		$this->db->where('store_id', $storeID);

		$this->db->limit(1);

		$q1 = $this->db->get();

		switch($q1->num_rows() > 0)
		{
			case TRUE:	$tmp = $q1->result();
						$q1 = NULL;
						return $tmp[0]->store_name;
				break;
			case FALSE:	return FALSE;
				break;
		}
	}

	public function totalPurchaseAmount( $userID = NULL )
	{
		if( $userID !== NULL )
		{
		}
		else
		{
			return 0;
		}
	}

	public function cartHasCouponProducts($couponType = NULL, $param1 = NULL, $couponProducts = NULL)
	{
		$retVal = array( 'result' => FALSE, 'totalPurchaseAmount' => 0, 'storeName' => NULL );
		if(! is_null($couponType) && ! is_null($param1) && is_numeric($couponType) && $couponType >= 0 && $couponType <= 26)
		{
			// we are assuming here that this function is being used
			// only inside controller functions which are auth-safe
			// meaning that they themselves check if a user is logged-in
			// in the curent session and only then call this function so we
			// already know that someone is logged-in
			$userID = $this->session->userdata('id');
			switch($couponType)
			{
				case 5:	// discount on a store
						//$this->db->select('cart_id');
						$this->db->select('cart_quantity');
						$this->db->select('products.discount');
						$this->db->select('products.is_on_discount');
						$this->db->select('products.selling_price');

						$this->db->from('cart');

						$this->db->join('products', 'cart.product_id = products.product_id', 'left');

						$this->db->where('cart.user_id = '.$userID.' AND (products.cat_id = '.$param1.' OR products.sub_catid1 = '.$param1.' OR products.sub_catid2 = '.$param1.' OR products.sub_catid3 = '.$param1.')');

						$q1 = $this->db->get();
						switch($q1->num_rows() > 0)
						{
							case TRUE:	$tmp = $q1->result();
										$purchaseAmount = 0;
										foreach($tmp as $t)
										{
											switch($t->is_on_discount == 1)
											{
												case TRUE:	$purchaseAmount += ( $t->cart_quantity * ( $t->selling_price - $t->discount ) );
													break;
												case FALSE:	$purchaseAmount += ( $t->cart_quantity * $t->selling_price );
													break;
											}
										}
										$retVal = array( 'result' => TRUE, 'totalPurchaseAmount' => $purchaseAmount, 'storeName' => $this->storeIDToName($param1) );
								break;
						}
					break;
				case 8:	// discount on a store
						//$this->db->select('cart_id');
						$this->db->select('cart_quantity');
						$this->db->select('cart.store_id');
						$this->db->select('products.discount');
						$this->db->select('products.is_on_discount');
						$this->db->select('products.selling_price');

						$this->db->from('cart');

						$this->db->join('products', 'cart.product_id = products.product_id', 'left');

						$this->db->where('cart.user_id', $userID);
						$this->db->where('cart.store_id', $param1);

						$q1 = $this->db->get();
						switch($q1->num_rows() > 0)
						{
							case TRUE:	$tmp = $q1->result();
										$purchaseAmount = 0;
										foreach($tmp as $t)
										{
											switch($t->is_on_discount == 1)
											{
												case TRUE:	$purchaseAmount += ( $t->cart_quantity * ( $t->selling_price - $t->discount ) );
													break;
												case FALSE:	$purchaseAmount += ( $t->cart_quantity * $t->selling_price );
													break;
											}
										}
										$retVal = array( 'result' => TRUE, 'totalPurchaseAmount' => $purchaseAmount, 'storeName' => $this->storeIDToName($param1) );
								break;
						}
					break;
				case 24:	// discount on a set of products
							$q1SQL = "SELECT `cart`.`cart_quantity`, `products`.`discount`, `products`.`is_on_discount`,`products`.`selling_price`";
							$q1SQL .= " FROM `cart`";
							$q1SQL .= " LFET JOIN `products` ON `cart`.`product_id` = `products`.`product_id`";
					break;
			}
		}
		return $retVal;
	}

	public function saveBeforeCheckoutData($txnID, $data)
	{
		$txnID = $this->db->escape( $txnID );
		$data = $this->db->escape( json_encode($data) );

		$q1SQL = "SELECT `txnid` FROM `beforeCheckout` WHERE `txnid` = ".$txnID;
		log_message('DEBUG', "QUERY BEING RUN__\r\n".$q1SQL);

		$q1 = $this->db->query( $q1SQL );

		$q2SQL = NULL;

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$q2SQL = "UPDATE `beforeCheckout` SET `bcData` = ".$data." WHERE `txnid` = ".$txnID;
				break;
			case FALSE:	$q2SQL = "INSERT INTO `beforeCheckout`(`txnid`, `bcData`) VALUES(".$txnID.", ".$data.")";
				break;
		}

		log_message('DEBUG', "QUERY BEING RUN__\r\n".$q2SQL);

		$q2 = $this->db->query( $q2SQL );

		$aRows = $this->db->affected_rows();

		log_message('INFO', "RanQuery__\r\n".$q2SQL."\r\naRows = ".$aRows );

		return ( $aRows > 0 ? TRUE: FALSE);
	}

	public function saveAfterCheckoutData($txnID, $data)
	{
		$txnID = $this->db->escape( $txnID );
		$data = $this->db->escape( json_encode($data) );

		$q1SQL = "SELECT `txnid` FROM `afterCheckout` WHERE `txnid` = ".$txnID;

		log_message('DEBUG', "QUERY BEING RUN__\r\n".$q1SQL);

		$q1 = $this->db->query( $q1SQL );

		$q2SQL = NULL;

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$q2SQL = "UPDATE `afterCheckout` SET `acData` = ".$data." WHERE `txnid` = ".$txnID;
				break;
			case FALSE:	$q2SQL = "INSERT INTO `afterCheckout`(`txnid`, `acData`) VALUES(".$txnID.", ".$data.")";
				break;
		}

		log_message('DEBUG', "QUERY BEING RUN__\r\n".$q2SQL);

		$q2 = $this->db->query( $q2SQL );


		$aRows = $this->db->affected_rows();

		log_message('INFO', "RanQuery__\r\n".$q2SQL."\r\naRows = ".$aRows );

		return ( $aRows > 0 ? TRUE: FALSE);
	}
}
?>
