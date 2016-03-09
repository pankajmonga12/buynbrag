<?php

class Morder extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//fetch store & owner information
	function mystore($strname)
	{
		//$strname = $temp;
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('store_owner', 'store_info.storeowner_id = store_owner.storeowner_id');
		$this->db->where('store_info.store_id', $strname);
		$this->db->where('store_info.isPublished', 1); // only pick store if its enabled
		$result = $this->db->get();
		return $result->result();
	}
	
	/* ADDED BY SHAMMI SHAILAJ to keep quantities in the new and old products table EQUAL */
	
	public function equateProductsQuantities()
	{
		log_message('INFO', 'trying to equate quantities NOW.');
		/* VERSION 1
		$this->db->set('productsNew.quantity', 'products.quantity');
		$this->db->where('productsNew.product_id', 'products.product_id');
		$this->db->join('products', 'products.product_id = productsNew.product_id');
		$this->db->update('productsNew'); */
		
		/* VERSION 2
		$this->db->set('productsNew.quantity', 'products.quantity');
		$this->db->join('products', 'products.product_id = productsNew.product_id');
		$this->db->update('productsNew');*/
		
		/* VERSION 3*/
		$this->db->query('UPDATE productsNew, products SET productsNew.quantity = products.quantity WHERE productsNew.product_id = products.product_id');
		log_message('INFO', 'JUST RAN THE FOLLOWING QUERY_____________________________________________'.$this->db->last_query());
	}
	
	public function equateProductsQuantities2($productID = NULL)
	{
		log_message('INFO', 'trying to equate quantities NOW.');
		/* VERSION 1
		$this->db->set('productsNew.quantity', 'products.quantity');
		$this->db->where('productsNew.product_id', 'products.product_id');
		$this->db->join('products', 'products.product_id = productsNew.product_id');
		$this->db->update('productsNew'); */
		
		/* VERSION 2
		$this->db->set('productsNew.quantity', 'products.quantity');
		$this->db->join('products', 'products.product_id = productsNew.product_id');
		$this->db->update('productsNew');*/
		
		/* VERSION 3*/
		if( is_null($productID) )
		{
			$this->db->query('UPDATE productsNew, products SET productsNew.quantity = products.quantity WHERE productsNew.product_id = products.product_id');
		}
		else
		{
			$this->db->query('UPDATE productsNew, products SET productsNew.quantity = products.quantity WHERE productsNew.product_id = products.product_id AND products.product_id = '.$this->db->escape($productID).' AND productsNew.product_id = '.$this->db->escape($productID));
		}
		log_message('INFO', 'JUST RAN THE FOLLOWING QUERY_____________________________________________'.$this->db->last_query());
	}
	
	/* END ADDED BY SHAMMI SHAILAJ */
	
	function myrank($user_id)
	{
		$this->db->select('userRank AS rank');
		$this->db->from('user_details');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get();
		return $result->result();
	}

	//TO FETCH THE STORE CATEGORIES AND TO ADD IN HEADER1 AND HEADER.PHP
	function header()
	{
		$this->db->select('category_id, category_name, parent_catagory_id, sort_order, status');
		$this->db->from('catagories');
		$this->db->order_by('parent_catagory_id', "asc");
		$result = $this->db->get();
		return $result->result();
	}

	function userdetails($userid, $columns = NULL)
	{
		switch($columns !== NULL)
		{
			case TRUE:	$this->db->select( $columns );
				break;
			case FALSE:	$this->db->select('*');
				break;
		}
		
		$this->db->from('user_details');
		
		$this->db->where('user_id', $userid);
		
		$this->db->limit(1); // just to improve speed
		
		$result = $this->db->get();
		
		return $result->result();

	}

	//FETCHING THE ALL PRODUCTS
	function products($strname)
	{
		$this->db->select('*');
		//$maxPID = $this->maxProductID('products');
		$productsTableName = 'products';
		/*if(maxPID !== FALSE && $prodid > $maxPID) // if something has been returned by maxProductID() and product ID is greater than the maximum product ID in the old table
		{
			$productsTableName = 'prodData'; // use the new DB VIEW which comprises of data from productsNew, pDims and pDesc
		}*/
		$this->db->from($productsTableName);
		$this->db->where('store_id', $strname);
		$this->db->where($productsTableName.'.status', 1); // pick only those products whose store are enabled
		$this->db->where($productsTableName.'.is_enable', 0); // pick only those products which are enabled
		$this->db->order_by('storesection_id', 'DESC');
		//$this->db->limit(9);
		$result = $this->db->get();
		switch($result->num_rows() > 0)
		{
			case TRUE: return $result->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	//Recently Viewed product - Store_page
	function rec_viewed()
	{
		$this->db->select('distinct(visit_product.product_id),products.*');
		$this->db->from('visit_product');
		$this->db->join('products', 'products.product_id = visit_product.product_id');
		$this->db->order_by('products.product_id', 'desc');
		$this->db->limit(12);
		$result = $this->db->get();
		return $result->result();

	}

	function allproducts($strname, $maxResults = NULL)
	{
		$maxPID = $this->maxProductID('products');
		$productsTableName = 'products';
//		$maxPID = 4200;
//		if($maxPID !== FALSE && $prodid > $maxPID) // if something has been returned by maxProductID() and product ID is greater than the maximum product ID in the old table
//		{
//			$productsTableName = 'prodData'; // use the new DB VIEW which comprises of data from productsNew, pDims and pDesc
//		}
		$this->db->select('*');
		$this->db->from($productsTableName);
		$this->db->where('store_id', $strname);
		$this->db->where($productsTableName.'.status', 1); // pick only those products whose store are enabled
		$this->db->where($productsTableName.'.is_enable', 0); // pick only those products which are enabled
		if( !is_null($maxResults) && is_numeric($maxResults) )
		{
			$this->db->limit($maxResults);
		}
		$result = $this->db->get();
		return $result->result();
	}
	
	public function totalStoreProducts($storeID)
	{
		$this->db->select('COUNT(*) AS totalStoreProducts');
		$this->db->from('products');
		$this->db->where('store_id', $storeID);
		$this->db->limit(1);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $resultSet = $query->result();
					 return $resultSet[0]->totalStoreProducts;
				break;
			case FALSE: return 0;
				break;
		}
	}

	function interested($cid, $s1, $s2)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('cat_id', $cid);
		$this->db->where('sub_catid1', $s1);
		$this->db->where('sub_catid2', $s2);
		// $this->db->limit(9);
		$result = $this->db->get();
		return $result->result();

	}

	//Store_page
	function recentlysold($sid)
	{
//		$this->db->select('orders.store_id');
//		$this->db->from('orders');
//		$this->db->join('products','products.store_id = orders.store_id');
//               $this->db->where('orders.store_id', $sid);
//		$result = $this->db->get();
//		return $result->result();		
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('store_id', $sid);
		$this->db->order_by('product_id', 'DESC');
		//$this->db->limit(9);
		$result = $this->db->get();
		return $result->result();

	}

	function productshigh($strname)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('store_id', $strname);
		$this->db->order_by('selling_price', "desc");
		$result = $this->db->get();
		return $result->result();

	}

	function productslow($strname)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('store_id', $strname);
		$this->db->order_by('selling_price', "asc");
		$result = $this->db->get();
		return $result->result();

	}

	//Fetching the sectionised product
	function secprod($strname, $secid)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('store_id', $strname);
		if ($secid <> 0) {
			$this->db->where('storesection_id', $secid);
		}
		$this->db->where('status', 1); // pick products only whose store is enabled
		$this->db->where('is_enable', 0); // pick products only which are enabled

		$result = $this->db->get();
		return $result->result();
	}


	//Fetch category for sidebar
	function mysec($strname)
	{
		$this->db->select('*');
		$this->db->from('store_section');
		$this->db->where('store_id', $strname);
		$result = $this->db->get();
		//$result = $this->db->count_all_results();
		return $result->result();
	}
	
	public function maxProductID($productsTableName)
	{
		$this->db->select('MAX(product_id) AS maxProductID');
		$this->db->from($productsTableName);
		$this->db->limit(1);
		$result = $this->db->get();
		switch($result->num_rows() > 0)
		{
			case TRUE: $retVal = $result->result();
					 return $retVal[0]->maxProductID; // return the max product ID
				break;
			case FALSE: return FALSE;
			    break;
		}
	}

	function myprod($prodid)
	{
		log_message('INFO', "inside morder/myprod");
		$maxPID = $this->maxProductID('products');
		$productsTableName = 'products';
		$maxPID = 4200;
		if($maxPID !== FALSE && $prodid > $maxPID) // if something has been returned by maxProductID() and product ID is greater than the maximum product ID in the old table
		{
			$productsTableName = 'prodData'; // use the new DB VIEW which comprises of data from productsNew, pDims and pDesc
		}
		$this->db->select('*');
		$this->db->from($productsTableName);
		//$this->db->join('variant','products.product_id = variant.product_id');
		$this->db->where($productsTableName.'.product_id', $prodid);
		$this->db->where($productsTableName.'.status', 1); // pick only those products whose store is enabled
		$this->db->where($productsTableName.'.is_enable', 0); // pick only those products which are enabled
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY__________________________________________________________________\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: $result = $query->result();
					 return $result;
					 log_message('INFO', "DATA BEING RETURNED__________________________________________\r\n".print_r($result, TRUE));
				break;
			case FALSE: return NULL;
				break;
		}
	}

	//Fetch the variants of the products -- color and size
	function myvar($prodid)
	{
		$this->db->select('*');
		$this->db->from('variant');
		//$this->db->join('variant','products.product_id = variant.product_id');
		$this->db->where('product_id', $prodid);
		$result = $this->db->get();
		return $result->result();

	}

	function check_cart($prodid, $color, $size, $userid, $storeid)
	{
		log_message("INFO", "INSIDE morder/check_cart. Requested by ".$userid." from ".$this->input->ip_address());
		$this->db->select('cart_id');
		$this->db->select('product_id');
		$this->db->select('cart_quantity');
		$this->db->select('user_id');
		$this->db->select('store_id');
		$this->db->select('session_id');
		$this->db->select('date_time');
		$this->db->select('vsize');
		$this->db->select('vcolor');
		$this->db->from('cart');
		$this->db->where('product_id', $prodid);
		$this->db->where('vcolor', $color);
		$this->db->where('vsize', $size);
		$this->db->where('user_id', $userid);
		$this->db->where('store_id', $storeid);
		$result = $this->db->get();
		$numRows = $result->num_rows();
		log_message('INFO', "JUST RAN the following query__________\r\n".$this->db->last_query());
		log_message("INFO", "INSIDE morder/check_cart. Returning numRows = ".$numRows);
		return $numRows;
	}

	public function checkCartExistence($prodID, $color, $size, $userID, $storeID)
	{
		log_message("INFO", "INSIDE morder/checkCartExistence. Requested by ".$userID." from ".$this->input->ip_address());
		log_message("INFO", 'params:::: prodid = '.$prodID.', color = '.$color.', size = '.$size.', userID = '.$userID.', storeID = '.$storeID);
		$this->db->select('COUNT(cart_id) AS cartCount');
		$this->db->from('cart');
		$this->db->where('product_id', $prodID);
		$this->db->where('vcolor', $color);
		$this->db->where('vsize', $size);
		$this->db->where('user_id', $userID);
		$this->db->where('store_id', $storeID);
		$query = $this->db->get();
		$retVal = NULL;
		switch($query->num_rows() > 0)
		{
			case TRUE:	$result = $query->result();
						$retVal = $result[0]->cartCount;
				break;
			case FALSE:	$retVal = 0;
				break;
		}

		log_message('INFO', "JUST RAN the following query__________\r\n".$this->db->last_query());
		log_message("INFO", "INSIDE morder/checkCartExistence. Returning retVal = ".$retVal);
		return $retVal;
	}

	public function checkCartExistence2($prodID, $userID)
	{
		log_message("INFO", "INSIDE morder/checkCartExistence2. Requested by ".$userID." from ".$this->input->ip_address());
		log_message("INFO", 'params:::: prodid = '.$prodID.', userID = '.$userID);
		$this->db->select('COUNT(cart_id) AS cartCount');
		$this->db->from('cart');
		$this->db->where('product_id', $prodID);
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		$retVal = NULL;
		switch($query->num_rows() > 0)
		{
			case TRUE:	$result = $query->result();
						$retVal = $result[0]->cartCount;
				break;
			case FALSE:	$retVal = 0;
				break;
		}

		log_message('INFO', "JUST RAN the following query__________\r\n".$this->db->last_query());
		log_message("INFO", "INSIDE morder/checkCartExistence2. Returning retVal = ".$retVal);
		return $retVal;
	}

	public function getCartID($prodID, $color, $size, $userID, $storeID)
	{
		log_message("INFO", "INSIDE morder/getCartID. Requested by ".$userID." from ".$this->input->ip_address());
		log_message("INFO", 'params:::: prodid = '.$prodID.', color = '.$color.', size = '.$size.', userID = '.$userID.', storeID = '.$storeID);
		$this->db->select('cart_id');
		$this->db->from('cart');
		$this->db->where('product_id', $prodID);
		$this->db->where('vcolor', $color);
		$this->db->where('vsize', $size);
		$this->db->where('user_id', $userID);
		$this->db->where('store_id', $storeID);
		$query = $this->db->get();
		$retVal = NULL;
		switch($query->num_rows() > 0)
		{
			case TRUE:	$result = $query->result();
						$retVal = $result[0]->cart_id;
				break;
			case FALSE:	$retVal = NULL;
				break;
		}

		log_message('INFO', "JUST RAN the following query__________\r\n".$this->db->last_query());
		log_message("INFO", "INSIDE morder/getCartID. Returning retVal(cart_id) = ".$retVal);
		return $retVal;
	}

	public function getCartID2($prodID, $userID)
	{
		log_message("INFO", "INSIDE morder/getCartID2. Requested by ".$userID." from ".$this->input->ip_address());
		log_message("INFO", 'params:::: prodid = '.$prodID.', userID = '.$userID);
		$this->db->select('cart_id');
		$this->db->from('cart');
		$this->db->where('product_id', $prodID);
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		$retVal = NULL;
		switch($query->num_rows() > 0)
		{
			case TRUE:	$result = $query->result();
						$retVal = $result[0]->cart_id;
				break;
			case FALSE:	$retVal = NULL;
				break;
		}

		log_message('INFO', "JUST RAN the following query__________\r\n".$this->db->last_query());
		log_message("INFO", "INSIDE morder/getCartID2. Returning retVal(cart_id) = ".$retVal);
		return $retVal;
	}

	function check_cart_prod($prodid, $userid, $storeid)
	{
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->where('product_id', $prodid);
		$this->db->where('user_id', $userid);
		$this->db->where('store_id', $storeid);
		$result = $this->db->get();
		$op = $result->result();
		if (!empty($op))
			return 1;
		else
			return 0;
	}

	public function save_cart($prodid, $color, $size, $userid, $storeid)
	{
		$this->db->set('product_id', $prodid);
		//if($color != '0' || $color != 0 )
		$this->db->set('vcolor', $color);
		//if($size != '0' || $size != 0 )
		$this->db->set('vsize', $size);
		$this->db->set('user_id', $userid);
		$this->db->set('store_id', $storeid);
		$this->db->set('cart_quantity', '1');
		return $this->db->insert('cart');
	}
	
	public function save_cart2($prodid, $color, $size, $userid, $storeid, $quantity)
	{
		log_message("DEBUG", "INSIDE morder/save_cart2. Requested by ".$userid." from ".$this->input->ip_address());
		log_message("DEBUG", 'params:::: prodid = '.$prodid.', color = '.$color.', size = '.$size.', userID = '.$userid.', storeID = '.$storeid);

		$retVal = array( 'availableQuantity' => 0, 'addedProduct' => FALSE );
		
		$q1SQL = "SELECT `quantity` FROM `products` WHERE `product_id` = ".$prodid; // query to read a product's quantity from the DB table
		$q1 = $this->db->query( $q1SQL );
		switch( $q1->num_rows() > 0 ) // if something is returned
		{
			case TRUE:	$r1 = $q1->result(); // get the result
						$retVal['availableQuantity'] = $r1[0]->quantity; // save the quantity read
						switch( $retVal['availableQuantity'] >= $quantity ) // if the quantity in DB is greater than what is being requested then continue
						{
							case FALSE:	return $retVal; // else return the retVal telling that the qunatity is not available
								break;
						}
				break;
			case FALSE:	return $retVal;
				break;
		}
		
		$this->db->set('product_id', $prodid);
		//if($color != '0' || $color != 0 )
		$this->db->set('vcolor', $color);
		//if($size != '0' || $size != 0 )
		$this->db->set('cart_quantity', $quantity);
		$this->db->set('vsize', $size);
		$this->db->set('user_id', $userid);
		$this->db->set('store_id', $storeid);
		$query = $this->db->insert('cart');
		
		$retVal['addedProduct'] = ( $this->db->affected_rows() > 0 )? TRUE : FALSE;

		log_message('INFO', "JUST RAN the following query__________\r\n".$this->db->last_query());
		log_message("INFO", "INSIDE morder/save_cart2. Returning \$query = ".json_encode($query, JSON_FORCE_OBJECT));
		return $retVal;
	}
	
	public function updateCart($prodid, $color, $size, $userid, $storeid, $quantity, $cartID = NULL)
	{
		log_message("INFO", "INSIDE morder/updateCart. Requested by ".$userid." from ".$this->input->ip_address());
		log_message("INFO", 'params:::: prodid = '.$prodid.', color = '.$color.', size = '.$size.', userID = '.$userid.', storeID = '.$storeid);

		$retVal = array( 'availableQuantity' => 0, 'addedProduct' => FALSE );
		
		$q1SQL = "SELECT `quantity` FROM `products` WHERE `product_id` = ".$prodid;
		$q1 = $this->db->query( $q1SQL );
		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$r1 = $q1->result();
						$retVal['availableQuantity'] = $r1[0]->quantity;
						switch( $retVal['availableQuantity'] >= $quantity )
						{
							case FALSE:	return $retVal;
								break;
						}
				break;
			case FALSE:	return $retVal;
				break;
		}

		$this->db->set('product_id', $prodid);
		//if($color != '0' || $color != 0 )
		$this->db->set('vcolor', $color);
		//if($size != '0' || $size != 0 )
		$this->db->set('cart_quantity', $quantity);
		$this->db->set('vsize', $size);
		$this->db->set('user_id', $userid);
		$this->db->set('store_id', $storeid);
		if( !is_null($cartID) )
		{
			$this->db->where('cart_id', $cartID);
		}
		$query = $this->db->update('cart');

		$retVal['addedProduct'] = ( $this->db->affected_rows() > 0 )? TRUE : FALSE;

		log_message('INFO', "JUST RAN the following query__________\r\n".$this->db->last_query());
		log_message("INFO", "INSIDE morder/updateCart. Returning \$query = ".json_encode($query, JSON_FORCE_OBJECT));
		return $retVal;
	}
	/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ SHAMMI SHAILAJ ==============================================================++++++++++++++++++++++ */
	/* +++++++++++++++++++++ function to count numer of items in the user's cart SHAMMI SHAILAJ ================================================++++++++++++++++++++++ */
	public function cartCount($userID)
	{
		/* fetching cart data for the user */
		/*log_message('INFO', 'trying to find number of products in the cart of user '.$userID);
		$this->db->select('cart.product_id AS productID');
		$this->db->select('cart.store_id AS storeID');
		$this->db->select('cart_quantity AS quantity');
		$this->db->select('vsize');
		$this->db->select('vcolor');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.is_on_discount AS isOnDiscount');
		$this->db->select('products.selling_price AS originalPrice');
		$this->db->select('products.discount AS discountAmount');
		$this->db->from('cart');
		$this->db->join('products', 'cart.product_id = products.product_id');
		$this->db->where('user_id', $userID);
		$cartQuery = $this->db->get();
		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		log_message('INFO', 'number of rows returned: '.$cartQuery->num_rows());
		log_message('INFO', 'Resultset returned: '.print_r($cartQuery->result(), TRUE));
		switch($cartQuery->num_rows() > 0)
		{
			case FALSE: $retData['cartCount'] = 0;
						log_message('INFO', 'number of items in the cart of user '.$userID.' is 0');
					break;
			case TRUE: $retData['cartData'] = $cartQuery->result();
						$retData['cartCount'] = $cartQuery->num_rows();
						log_message('INFO', 'total items in users\' cart = '.$userID.' is '.$retData['cartCount']);
					break;
		}*/
		/* fetch cart count only */
		log_message('INFO', 'trying to find number of products in the cart of user '.$userID);
		$this->db->select('COUNT(cart.product_id) AS cartCount');
		$this->db->from('cart');
		$this->db->where('user_id', $userID);
		$cartQuery = $this->db->get();
		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		log_message('INFO', 'number of rows returned: '.$cartQuery->num_rows());
		log_message('INFO', 'Resultset returned: '.print_r($cartQuery->result(), TRUE));
		switch($cartQuery->num_rows() > 0)
		{
			case FALSE: log_message('INFO', 'number of items in the cart of user '.$userID.' is 0');
					  return 0;
				break;
			case TRUE: $cartQueryData = $cartQuery->result();
					 log_message('INFO', 'total items in users\' cart = '.$userID.' is '.$cartQueryData[0]->cartCount);
					 return $cartQueryData[0]->cartCount;
				break;
		}
	}
	/* ++++++++++++++++++++++++++++++ END section function to count numer of items in the user's cart SHAMMI SHAILAJ ===========================++++++++++++++++++++++ */
	/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ SHAMMI SHAILAJ ==============================================================++++++++++++++++++++++ */

	function fancy_store_increment($storeid)
	{
		$this->db->set('fancy_counter', 'fancy_counter+0', FALSE);
		$this->db->where('store_id', $storeid);
		$this->db->update('store_info');
	}

	function fancy_store_decrement($storeid)
	{
		$this->db->set('fancy_counter', 'fancy_counter-0', FALSE);
		$this->db->where('store_id', $storeid);
		$this->db->update('store_info');
	}

	function delete_fancy_store($storeid, $userid)
	{
		$this->db->where('store_id', $storeid);
		$this->db->where('user_id', $userid);
		$this->db->delete('fancy_store');
	}

	function store_fancy($sid)
	{
		$this->db->select('*');
		$this->db->from('fancy_store');
		$this->db->where('store_id', $sid);
		$store_fancy = $this->db->get();
		return $store_fancy->result();
	}

	function get_store_fancy($storeid)
	{
		$this->db->select('fancy_counter');
		$this->db->from('store_info');
		$this->db->where('store_id', $storeid);
		$query = $this->db->get();
		return $query->result();
	}

	function save_fancy_store($storeid, $userid)
	{
		$this->db->set('store_id', $storeid);
		$this->db->set('user_id', $userid);
		$this->db->insert('fancy_store');
	}

	function fancied_store_user($userid, $storeid)
	{
		$this->db->select('store_id', 'user_id');
		$this->db->from('fancy_store');
		$this->db->where('user_id', $userid);
		$this->db->where('store_id', $storeid);
		$fancied = $this->db->count_all_results();
		if ($fancied == 0)
			return FALSE;

		else
			return TRUE;
	}

	function fancy_product_increment($storeid, $prodid)
	{
		$this->db->set('fancy_counter', 'fancy_counter+0', FALSE);
		$this->db->where('store_id', $storeid);
		$this->db->where('product_id', $prodid);
		$this->db->update('products');
	}

	function fancy_product_decrement($storeid, $prodid)
	{
		$this->db->set('fancy_counter', 'fancy_counter-0', FALSE);
		$this->db->where('store_id', $storeid);
		$this->db->where('product_id', $prodid);
		$this->db->update('products');
	}

	function get_product_fancy($storeid, $prodid)
	{
		$this->db->select('fancy_counter');
		$this->db->from('products');
		$this->db->where('store_id', $storeid);
		$this->db->where('product_id', $prodid);
		$query = $this->db->get();
		return $query->result();
	}

	function save_fancy_product($prodid, $userid, $postdata)
	{
		$flistid = $this->fetch_flistid($userid, $postdata);
		$this->db->set('product_id', $prodid);
		$this->db->set('user_id', $userid);
		$this->db->set('fancy_list_id', $flistid);
		$this->db->insert('fancy_products');
	}

	function remove_fancy_product($prodid, $userid)
	{
		//$flistid = $this->fetch_flistid($prodid);
		$this->db->where('product_id', $prodid);
		$this->db->where('user_id', $userid);
		//$this->db->where('fancy_list_id',$flistid);
		$this->db->delete('fancy_products');
	}

	function getflistiduser($prodid, $userid)
	{
		$lists = array(2, 3, 4, 5, 6, 7, 8, 10);
		$this->db->select('fancy_list_id');
		$this->db->from('fancy_products');
		$this->db->where('product_id', $prodid);
		$this->db->where('user_id', $userid);
		$this->db->where_not_in('fancy_list_id', $lists);
		$query = $this->db->get();
		return $query->result();
	}

	function getflistiddef($prodid, $userid)
	{
		$lists = array(2, 3, 4, 5, 6, 7, 8, 10);
		$this->db->select('fancy_list_id');
		$this->db->from('fancy_products');
		$this->db->where('product_id', $prodid);
		$this->db->where('user_id', $userid);
		$this->db->where_in('fancy_list_id', $lists);
		$query = $this->db->get();
		return $query->result();
	}

	function checked($prodid, $userid, $flist_id)
	{
		$this->db->select('fancy_list_name');
		$this->db->from('fancy_list');
		$this->db->where('user_id', $userid);
		$this->db->where('fancy_list_id', $flist_id);
		$query = $this->db->get();
		//var_dump($query->result());
		return $query->result();
	}

	function fetch_flistid($userid, $postdata)
	{
		$this->db->select('fancy_list_id');
		$this->db->from('fancy_list');
		$this->db->where('user_id', $userid);
		$this->db->where('fancy_list_name', $postdata);
		$query = $this->db->get();
		$cat_id = $query->result();
		return $cat_id['0']->fancy_list_id;
	}

	function fancied_product_user($userid, $prodid)
	{
		$this->db->select('product_id', 'user_id');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userid);
		$this->db->where('product_id', $prodid);
		$fancied = $this->db->count_all_results();
		if ($fancied == 0)
			return FALSE;

		else
			return TRUE;
	}

	function fancystoreprod($sid)
	{
		$this->db->select('product_id');
		$this->db->from('products');
		$this->db->where('products.store_id', $sid);
		$result = $this->db->get();
		return $result->result();
	}

	function user_fancied_stores($userid)
	{
		$this->db->select('distinct(fancy_store.store_id),store_info.*');
		$this->db->from('fancy_store');
		$this->db->join('store_info', 'fancy_store.store_id=store_info.store_id');
//		$this->db->join('products','fancy_store.store_id=products.store_id');
//                $this->db->group_by('products.store_id'); 
		$this->db->where('fancy_store.user_id', $userid);
		$stores_fancied = $this->db->get();
		return $stores_fancied->result();
	}

	function user_fancied_product($userid)
	{
		$this->db->select('distinct(fancy_products.product_id),products.*');
		//$this->db->select('distinct(fancy_products.product_id),products.product_name, products.fancy_counter');
		$this->db->from('fancy_products');
		$this->db->join('products', 'fancy_products.product_id=products.product_id');
		$this->db->where('user_id', $userid);
		$stores_fancied = $this->db->get();
		return $stores_fancied->result();
	}
	
	/* added by SHAMMI SHAILAJ for user's fancy page */
	// Previously user_fancied_product() was being used. This function will also speed-up the data fetch and hence the display
	function user_fancied_product2($userid)
	{
		$this->db->select('distinct(fancy_products.product_id),products.product_name, products.fancy_counter, products.store_id');
		$this->db->from('fancy_products');
		$this->db->join('products', 'fancy_products.product_id=products.product_id');
		$this->db->where('user_id', $userid);
		$this->db->order_by('fancy_products.time', 'desc');
		$stores_fancied = $this->db->get();
		return $stores_fancied->result();
	}
	/* END added by SHAMMI SHAILAJ for user's fancy page */

	function alluser_fancied_product()
	{
		$this->db->select('distinct(fancy_products.product_id),products.*');
		$this->db->from('fancy_products');
		$this->db->join('products', 'fancy_products.product_id=products.product_id');
		$this->db->group_by('products.product_id , user_id', true);
		$this->db->order_by('time', 'desc');
		$stores_fancied = $this->db->get();
		return $stores_fancied->result();
	}

	/* inserted by shammi for speeding-up initial data display */
	function alluser_fancied_product_optimized($startFrom = NULL, $maxResults = NULL)
	{
		/*$this->db->select('distinct(fancy_products.product_id), fancy_rank.rank, fancy_products.user_id, user_details.username, user_details.full_name, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter');
		$this->db->from('fancy_products');
                $this->db->join('fancy_rank', 'fancy_rank.user_id=fancy_products.user_id');
                $this->db->join('products','fancy_products.product_id=products.product_id');
                $this->db->join('user_details', 'fancy_products.user_id=user_details.user_id');
		$this->db->group_by('products.product_id , fancy_products.user_id' , true);
                $this->db->order_by('fancy_products.time','desc');*/
		$this->db->select('distinct(fancy_products.product_id), fancy_products.user_id, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter,fancy_rank.rank,user_details.username, user_details.full_name');
		$this->db->from('fancy_products');
		$this->db->join('products', 'fancy_products.product_id=products.product_id');
		$this->db->join('fancy_rank', 'fancy_rank.user_id=fancy_products.user_id');
		$this->db->join('user_details', 'fancy_products.user_id=user_details.user_id');
		$this->db->group_by('products.product_id', true);
		$this->db->order_by('time', 'desc');
		if (is_null($startFrom)) {
			$this->db->limit(50);
		} else {
			if (is_null($maxResults)) {
				$this->db->limit(50, $startFrom);
			} else {
				$this->db->limit($maxResults, $startFrom);
			}
		}
		$stores_fancied = $this->db->get();
		//print "<pre>".$this->db->last_query()."</pre>";
		return $stores_fancied->result();
	}

	function alluser_fancied_product_optimized2()
	{
		/*$this->db->select('distinct(fancy_products.product_id), fancy_rank.rank, fancy_products.user_id, user_details.username, user_details.full_name, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter');
		$this->db->from('fancy_products');
		$this->db->join('fancy_rank', 'fancy_rank.user_id=fancy_products.user_id');
		$this->db->join('products','fancy_products.product_id=products.product_id');
		$this->db->join('user_details', 'fancy_products.user_id=user_details.user_id');
		$this->db->group_by('products.product_id , fancy_products.user_id' , true);
		$this->db->order_by('fancy_products.time','desc');*/
		$this->db->select('distinct(fancy_products.product_id), fancy_products.user_id, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter,fancy_rank.rank,user_details.username, user_details.full_name');
		$this->db->from('fancy_products');
		$this->db->join('products', 'fancy_products.product_id=products.product_id');
		$this->db->join('fancy_rank', 'fancy_rank.user_id=fancy_products.user_id');
		$this->db->join('user_details', 'fancy_products.user_id=user_details.user_id');
		$this->db->group_by('products.product_id', true);
		$this->db->order_by('time', 'desc');
		$this->db->limit(25);
		$stores_fancied = $this->db->get();
		return $stores_fancied->result();
	}
	/* end inserted by shammi for speeding-up initial data display n lazyloading  */
	
	function fancy_popup_list1($prodid, $userid)
	{
		$this->db->select('fancy_list.fancy_list_name');
		$this->db->from('fancy_list');
		$this->db->join('products', 'fancy_list.fancy_list_id = products.cat_id');
		$this->db->where('products.product_id', $prodid);
		$this->db->where('fancy_list.user_id', $userid);
		$result = $this->db->get();
		return $result->result();
	}

	function fancy_popup_list2($userid)
	{
		$lists = array(2, 3, 4, 5, 6, 7, 8, 10);
		$this->db->select('fancy_list_name');
		$this->db->from('fancy_list');
		$this->db->where_not_in('fancy_list_id', $lists);
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
		return $query->result();
	}

	function fancy_addlist($listname, $prodid, $userid)
	{
		//$this->db->set('fancy_list_id',13);
		$this->db->set('user_id', $userid);
		$this->db->set('fancy_list_name', $listname);
		$this->db->insert('fancy_list');
	}

	function user_fancy_list($userid, $flistid)
	{
		$this->db->select('fancy_products.product_id ,products.store_id');
		$this->db->from('fancy_products');
		$this->db->join('products', 'products.product_id=fancy_products.product_id');
		$this->db->where('fancy_products.user_id', $userid);
		$this->db->where('fancy_products.fancy_list_id', $flistid);
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	function user_fancy_prodcount($userid, $flistid)
	{
		$this->db->select('count(*) as product_count');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userid);
		$this->db->where('fancy_list_id', $flistid);
		$query = $this->db->get();
		return $query->result();
	}

	function my_fancy_default($userid)
	{
		$lists = array(2, 3, 4, 5, 6, 7, 8, 10);
		$this->db->select('*');
		$this->db->from('fancy_list');
		$this->db->where('user_id', $userid);
		$this->db->where_in('fancy_list_id', $lists);
		$query = $this->db->get();
		return $query->result();
	}

	function my_fancy_user($userid)
	{
		$lists = array(2, 3, 4, 5, 6, 7, 8, 10);
		$this->db->select('*');
		$this->db->from('fancy_list');
		$this->db->where('user_id', $userid);
		$this->db->where_not_in('fancy_list_id', $lists);
		$query = $this->db->get();
		return $query->result();
	}

	function product_store($prodid)
	{
		$this->db->select('store_id');
		$this->db->from('products');
		$this->db->where('product_id', $prodid);
		$query = $this->db->get();
		return $query->result();
	}

	function fancy_list_delete($userid, $flistid)
	{
		$this->db->where('user_id', $userid);
		$this->db->where('fancy_list_id', $flistid);
		$this->db->delete('fancy_products');
	}

	function fancy_product_delete($userid, $flistid)
	{
		$this->db->where('user_id', $userid);
		$this->db->where('fancy_list_id', $flistid);
		$this->db->delete('fancy_list');
	}

	function list_product_details($userid, $flistid)
	{
		$this->db->select('products.product_id,products.product_name,products.selling_price,products.fancy_counter,products.store_id,store_info.store_name');
		$this->db->from('products');
		$this->db->join('fancy_products', 'products.product_id=fancy_products.product_id');
		$this->db->join('store_info', 'store_info.store_id=products.store_id');
		$this->db->where('user_id', $userid);
		$this->db->where('fancy_list_id', $flistid);
		$query = $this->db->get();
		return $query->result();
	}

	function cfprod($userid)
	{
		$this->db->select('distinct(fancy_products.product_id)');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* added by SHAMMI SHAILAJ TO IMPROVE PERFORMANCE WHERE only counting of number of products fancied was needed */
	public function cfprodCount($userID)
	{
		$this->db->select('COUNT(fancy_products.product_id) AS userFancyCount');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $result = $query->result();
					 return $result[0]->userFancyCount;
				break;
			case FALSE: return 0;
		}
	}
	/* END SECTION added by SHAMMI SHAILAJ TO IMPROVE PERFORMANCE WHERE only counting of number of products fancied was needed */
	
	function cfstore($userid)
	{
		$this->db->select('distinct(fancy_store.store_id)');
		$this->db->from('fancy_store');
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
		return $query->result();
	}
	/* added by SHAMMI SHAILAJ TO IMPROVE PERFORMANCE WHERE only count of number of stores fancied was needed */
	public function cfstoreCount($userID)
	{
		$this->db->select('COUNT(distinct(fancy_store.store_id)) AS userFancyStoreCount');
		$this->db->from('fancy_store');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $result = $query->result();
					 return $result[0]->userFancyStoreCount;
				break;
			case FALSE: return 0;
		}
	}
	/* END SECTION added by SHAMMI SHAILAJ TO IMPROVE PERFORMANCE WHERE only count of number of stores fancied was needed */
	function cflist($userid)
	{
		$this->db->select('distinct(fancy_products.fancy_list_id)');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* added by SHAMMI SHAILAJ TO IMPROVE PERFORMANCE WHERE only count of cflist was needed */
	public function cflistCount($userID)
	{
		$this->db->select('COUNT(distinct(fancy_products.fancy_list_id)) AS cflistCount');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $result = $query->result();
					 return $result[0]->cflistCount;
				break;
			case FALSE: return 0;
		}
	}
	/* END SECTION added by SHAMMI SHAILAJ TO IMPROVE PERFORMANCE WHERE only count of cflist was needed */
	
	//Frieds Who fancied in product page
	function friendsfanciedprod($userid)
	{
		$this->db->select('distinct(fancy_products.product_id)');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
		return $query->result();
	}

	function add_def_prod($storeid)
	{

		$data = array(
			'store_id' => $storeid,
			'cat_id' => '1',
			'sub_catid1' => '1',
			'sub_catid2' => '1',
			'sub_catid3' => '1',
			'product_name' => 'Default product',
			'bnb_product_code' => 'BNBPROD1111',
			'storesection_id' => '0',
			'description' => 'Product description',
			'occasions' => 'ANY',
			'style' => 'STYLE',
			'tags' => 'TAGS',
			'prd_act_weight' => '0.000',
			'prd_vol_weight' => '0.000',
			'shipping_partner' => '0.000',
			'shipping_mode' => '1',
			'seller_earnings' => '0',
			'bnb_commission' => '0',
			'tax_rate' => '0',
			'insurance_cost' => '0',
			'shipping_cost' => '0',
			'selling_price' => '0',
			'quantity' => '1',
			'processing_time' => '0',
			'status' => '1',
			'is_enable' => '1',
			'discount' => '0',
			'is_on_discount' => '0',
			'promotion_id' => '0',
			'added_on' => 'CURRENT_TIMESTAMP()',
			'visit_counter' => '0',
			'fancy_counter' => '0',
			'brag_counter' => '0');

		$this->db->insert('products', $data);

	}

	function errorpage()
	{
		//$this->db->truncate('sale');
	}

	function save_fancy_product_contest($prodid, $userid)
	{
		$flistid = $this->get_fancy_listid($prodid);
		$this->db->set('product_id', $prodid);
		$this->db->set('user_id', $userid);
		$this->db->set('fancy_list_id', $flistid);
		$this->db->insert('fancy_products');
	}

	function get_fancy_listid($prodid)
	{
		$this->db->select('cat_id');
		$this->db->from('products');
		$this->db->where('product_id', $prodid);
		$result = $this->db->get();
		$cat_id = $result->result();
		return $cat_id['0']->cat_id;

	}
}

?>
