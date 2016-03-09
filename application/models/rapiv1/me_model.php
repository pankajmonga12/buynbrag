<?php if( ! defined( 'BASEPATH' ) ) exit('403 Unauthorized');
class Me_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function feedData($userID, $startFrom = NULL, $maxResults = NULL)
	{
		/*
		-	read the list of users the current user is following, call it A
		-	read the list of products that I have fancied, call it B
		-	read the list of users who have fancied the products from resultset B, call it C
		-	read the list of user's category preferences call it D
		-	E = A union D
		-	E = array_unique(E)
		-	SELECT
				DISTINCT(f2.product_id) AS productID,
				f2.user_id AS userID,
				f2.time,
				products.store_id AS storeID,
				products.fancy_counter AS productFancyCounter,
				products.is_on_discount AS productIsOnDiscount,
				products.selling_price AS productSellingPrice,
				products.discount AS productDiscount,
				products.product_name AS productName,
				products.visit_counter AS productVisitCounter,
				products.quantity AS productQuantity,
				products.bbucks AS bbucks,
				buynbrag_rank.rank AS userRank,
				user_details.username AS userName,
				user_details.full_name AS userFullName,
				user_details.fb_uid as userFBID,
				(SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
				from fancy_products f2
				left join products on f2.product_id=products.product_id
				left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
				left join user_details on f2.user_id=user_details.user_id
				order by `time` desc;
		*/
		$isLoggedIN = NULL;
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		$__ip = $this->input->ip_address();

		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		
		$cacheVariableNamePrefix = 'feedDataUsersList';
		$cacheVariableNamePostfix = $this->input->server('SERVER_NAME');
		
		$cacheVariableName = $cacheVariableNamePrefix."___".$cacheVariableNamePostfix."__".$userID."__".$__ip;

		$this->load->driver('cache');
		$cacheData = $this->cache->memcached->get($cacheVariableName);

		$userList = array();
		$usersCount = 0;
		$catPrefs = array();
		$catPrefsCount = 0;

		switch($cacheData === FALSE)
		{
			case TRUE:	// computing A
						$this->db->select('followee_id AS userID');

						$this->db->from('follow_friends');

						$this->db->where('follower_id', $userID);

						$q1 = $this->db->get();

						switch($q1->num_rows() > 0)
						{
							case TRUE:	$userList1 = $q1->result();
										foreach ($userList1 as $user)
										{
											$userList[] = $user->userID;
											$usersCount++;
										}
								break;
						}

						// computing B
						$tProducts = array();
						$this->db->select('DISTINCT(product_id) AS productID');

						$this->db->from('fancy_products');

						$this->db->where('user_id', $userID);

						$q2 = $this->db->get();

						switch($q2->num_rows() > 0)
						{
							case TRUE:	$productsList = $q2->result();
										foreach ($productsList as $product)
										{
											$tProducts[] = $product->productID;
										}

										// computing C and hence D
										$this->db->select('DISTINCT(user_id) AS userID');

										$this->db->from('fancy_products');

										$this->db->where_in('product_id', $tProducts);

										$q3 = $this->db->get();

										switch($q3->num_rows() > 0)
										{
											case TRUE:	$userList2 = $q3->result();
														foreach($userList2 as $user)
														{
															$userList[] = $user->userID;
															$usersCount++;
														}
												break;
										}
								break;
						}
						$userList = array_unique($userList);

						$tUL = $userList;
						$tUL[] = $userID;

						$this->db->select('pValue AS catID');
						$this->db->from('user_prefs');
						$this->db->where_in('user_id', $tUL);
						$q21 = $this->db->get();

						switch( $q21->num_rows() > 0 )
						{
							case TRUE:	$r21 = $q21->result();
										foreach( $r21 as $key => $value )
										{
											$catPrefs[] = $value->catID;
										}
								break;
							case FALSE:	$catPrefs = NULL;
								break;
						}
						$catPrefs = array_unique($catPrefs);
						$catPrefsCount = count( $catPrefs );
						$cacheSaved = $this->cache->memcached->save( $cacheVariableName, array('userList' => $userList, 'usersCount' => $usersCount, 'catPrefs' => $catPrefs, 'catPrefsCount' => $catPrefsCount, 'isReallyLoggedIN' => $isReallyLoggedIN), 1800); // cache the product's data for 30 minutes
				break;
			case FALSE:	$userList = $cacheData['userList'];
						$usersCount = $cacheData['usersCount'];
						$catPrefs = $cacheData['catPrefs'];
						$catPrefsCount = $cacheData['catPrefsCount'];
						switch( $isReallyLoggedIN && $cacheData['isReallyLoggedIN'] )
						{
							case FALSE:	// computing A
										$this->db->select('followee_id AS userID');

										$this->db->from('follow_friends');

										$this->db->where('follower_id', $userID);

										$q1 = $this->db->get();

										switch($q1->num_rows() > 0)
										{
											case TRUE:	$userList1 = $q1->result();
														foreach ($$userList1 as $user)
														{
															$userList[] = $user->userID;
															$usersCount++;
														}
												break;
										}

										// computing B
										$tProducts = array();
										$this->db->select('DISTINCT(product_id) AS productID');

										$this->db->from('fancy_products');

										$this->db->where('user_id', $userID);

										$q2 = $this->db->get();

										switch($q2->num_rows() > 0)
										{
											case TRUE:	$productsList = $q2->result();
														foreach ($productsList as $product)
														{
															$tProducts[] = $product->productID;
														}

														// computing C and hence D
														$this->db->select('DISTINCT(user_id) AS userID');

														$this->db->from('fancy_products');

														$this->db->where_in('product_id', $tProducts);

														$q3 = $this->db->get();

														switch($q3->num_rows() > 0)
														{
															case TRUE:	$userList2 = $q3->result();
																		foreach($userList2 as $user)
																		{
																			$userList[] = $user->userID;
																			$usersCount++;
																		}
																break;
														}
												break;
										}
										$userList = array_unique($userList);
										$tUL = $userList;
										
										$tUL[] = $userID;

										$this->db->select('pValue AS catID');
										$this->db->from('user_prefs');
										$this->where_in('user_id', $tUL);
										$q21 = $this->db->get();

										switch( $q21->num_rows() > 0 )
										{
											case TRUE:	$r21 = $q21->result();
														foreach( $r21 as $key => $value )
														{
															$catPrefs[] = $value->catID;
														}
												break;
											case FALSE:	$catPrefs = NULL;
												break;
										}
										$catPrefs = array_unique($catPrefs);
										$catPrefsCount = count( $catPrefs );
										$cacheSaved = $this->cache->memcached->save($cacheVariableName, array( 'userList' => $userList, 'usersCount' => $usersCount, 'catPrefs' => $catPrefs, 'catPrefsCount' => $catPrefsCount, 'isReallyLoggedIN' => $isReallyLoggedIN ), 1800); // cache the product's data for 30 minutes
								break;
						}
				break;
		}

		log_message( 'DEBUG', "user_prefs = ".print_r($catPrefs, TRUE) );

		$this->db->select('DISTINCT(f2.product_id) AS productID');
		//NEW__$this->db->select('f2.fancy_list_id AS bragListID');
		//NEW__$this->db->select('fancy_list.fancy_list_name AS bragListName');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('products.bbucks AS bbucks');
		
		$this->db->select('products.lastFanciedBy AS userID');
		$this->db->select('products.lFUBadgeType AS badgeType');
		$this->db->select('products.lFUBadgeLevel AS badgeLevel');
		$this->db->select('products.lFUBadgeNotificationText AS badgeNotificationText');
		$this->db->select('store_info.store_name AS storeName');

		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender as userGender');
		//$this->db->select('(SELECT COUNT(product_id) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied');

		switch( $isReallyLoggedIN )
		{
			case TRUE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');*/
					 $this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip) );
					 $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not') );
					 $this->db->select("(IF((SELECT COUNT(product_id) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					 $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					 $this->db->select("(IF((SELECT COUNT(product_id) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');*/
					  $this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ') );
					  $this->slog->write( array('level' => 1, 'msg' => 'Will not try to check if the current user has fancied the products or not') );
					  $this->db->select("(IF((SELECT COUNT(product_id) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					  $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					  $this->db->select("(IF((SELECT COUNT(product_id) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		
		$this->db->from('fancy_products f2');
		
		$this->db->join('products', 'f2.product_id=products.product_id', 'left');
		$this->db->join('store_info', 'products.store_id=store_info.store_id', 'left');
		//$this->db->join('buynbrag_rank', 'buynbrag_rank.user_id=f2.user_id', 'left');
		$this->db->join('user_details', 'products.lastFanciedBy=user_details.user_id', 'left');
		//NEW__$this->db->join('fancy_list', 'f2.fancy_list_id = fancy_list.fancy_list_id', 'left');
		
		$whereText = 'products.status = 1 AND products.is_enable = 0';
		switch($usersCount > 0)
		{
			case TRUE:	$whereText .= " AND f2.user_id IN (".implode(',', $userList).")";
				break;
		}


		switch( $catPrefsCount > 0 )
		{
			case TRUE:	$whereText .= " AND  ( products.cat_id IN (".implode(',', $catPrefs).") OR products.sub_catid1 IN (".implode(',', $catPrefs).")  OR products.sub_catid2 IN (".implode(',', $catPrefs).") OR products.sub_catid3 IN (".implode(',', $catPrefs).") )";
		}

		$this->db->where( $whereText );
		$this->db->order_by('products.lastFanciedAt', 'desc');

		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(50); // by default only pick 50 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(50, $startFrom*50);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults * $startFrom);
							break;
					  }
				break;
		}
		log_message('INFO', "GOING TO RUN THE QUERY___\r\n".$this->db->return_query());
		$q = $this->db->get();
		switch($q->num_rows() > 0)
		{
			case TRUE:	return $q->result();
				break;
			case FALSE:	return NULL;
				break;
		}
	}
}