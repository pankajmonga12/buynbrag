<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');
class Flmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function readHandPickedUsersGen()
	{
		$whereText = array
						(
							0 => 22, 1 => 10267, 2 => 5984, 3 => 5642, 4 => 9029, 5 => 6284, 6 => 2800, 7 => 7511, 8 => 358, 9 => 9596,
							10 => 7495, 11 => 6472, 12 => 9460, 13 => 5955, 14 => 6810, 15 => 587, 16 => 6285, 17 => 2927, 18 => 5555, 19 => 25,
							20 => 1613, 21 => 5117, 22 => 44, 23 => 2330, 24 => 6585, 25 => 9597, 26 => 7845, 27 => 4115, 28 => 9944, 29 => 5627,
							30 => 6306, 31 => 4067, 32 => 5925, 33 => 7193, 34 => 8014, 35 => 9943, 36 => 5271, 37 => 2045, 38 => 4544, 39 => 7466,
							40 => 8013, 41 => 9421, 42 => 8033, 43 => 1971, 44 => 8018, 45 => 3700, 46 => 8028, 47 => 8191, 48 => 9840, 49 => 12758,
							50 => 8006, 51 => 5720, 52 => 496, 53 => 9539, 54 => 9474, 55 => 9557, 56 => 8835, 57 => 5592, 58 => 5721, 59 => 1842,
							60 => 3829, 61 => 8337, 62 => 9197, 63 => 6662, 64 => 887, 65 => 6965, 66 => 2509, 67 => 4147, 68 => 9660, 69 => 1221,
							70 => 3552, 71 => 3024, 72 => 313, 73 => 5643, 74 => 6575, 76 => 9904, 77 => 6276, 78 => 6189
						);
		/*
		user id - name - sort_order - about me - add products
		16104 - kirat bhattal - 6 - NA - ok
		1602 - vikram chopra - 7 - Co-Founder at Fabfurnish.com - OK
		14694 - Julia Bliss - 8 - Actor, DJ, Entrepreneur - OK
		4147 - NA - 9 - NA - NA
		17096 - Cory York - 10 - NA - NA
		3670 - Krsna Mehta - 11 - Designer, Co-Founder at India Circus - Add Products
		16791 - NA - 12 - NA - OK
		16312 - NA - 13 - NA - OK
		*/
		
		$this->db->select('fr.user_id');
		$this->db->select('user_details.full_name');
		$this->db->select('fr.rank'); 
		$this->db->select('user_details.about_me');
		$this->db->select('user_details.gender');
		$this->db->select('user_details.fb_uid');
		$this->db->select('user_details.joined_date');

		$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 0) AS fp1ProductID');
		$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 0) AS fp1StoreID');
		$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 0) AS fp1ProductName');

		$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 1) AS fp2ProductID');
		$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 1) AS fp2StoreID');
		$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 1) AS fp2ProductName');

		$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 2) AS fp3ProductID');
		$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 2) AS fp3StoreID');
		$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 2) AS fp3ProductName');

		$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 3) AS fp4ProductID');
		$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 3) AS fp4StoreID');
		$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 3) AS fp4ProductName');

		$this->db->from('fancy_rank fr');
		$this->db->join('user_details','fr.user_id = user_details.user_id','left');
		$this->db->where_in('fr.user_id', $whereText);
		
		$query = $this->db->get();

		echo "<p>query being run\r\n</p><p>".$this->db->last_query()."</p>";
		
		if($query->num_rows() > 0)
		{
			$finalValue = $query->result();
			/*echo "<p>handpicked users are\r\n</p><pre>".print_r($finalValue, TRUE)."</pre>";*/
			return $finalValue;
		}
		else 
		{
			return NULL;
		}
	}

	public function truncateHandPickedUsersTable()
	{
		return $this->db->truncate('handpicked_users');
	}

	public function saveHandPickedUsers($batchData)
	{
		return $this->db->insert_batch('handpicked_users', $batchData);
	}

	public function updateRFlowStatus($rFlowStatus)
	{
		$userID = $this->session->userdata('id');
		$loggedIN = $this->session->userdata('logged_in');
		if($userID !== FALSE && is_numeric($userID) && $loggedIN !== FALSE && $loggedIN === TRUE)
		{
			if($rFlowStatus > 6)
			{
				$rFlowStatus = 6;
			}

			$this->db->set('rFlowStatus', $rFlowStatus);
			$this->db->where('user_id', $userID);
			return $this->db->update('user_details');
		}
		else
		{
			return NULL;
		}
	}

	public function readHandPickedUsers($startFrom = NULL, $maxResults = NULL)
	{
		$this->db->select('user_id AS userID');
		$this->db->select('full_name AS userFullName');
		$this->db->select('fb_uid AS userFBID');
		$this->db->select('rank1 AS userRank');
		$this->db->select('about_me AS userAboutMe');
		$this->db->select('gender AS userGender');
		$this->db->select('rank1 AS userRank');
		$this->db->select('joined_date as userJoinedDate');
		
		$this->db->select('fp1ProductID');
		$this->db->select('fp1StoreID');
		$this->db->select('fp1ProductName');

		$this->db->select('fp2ProductID');
		$this->db->select('fp2StoreID');
		$this->db->select('fp2ProductName');

		$this->db->select('fp3ProductID');
		$this->db->select('fp3StoreID');
		$this->db->select('fp3ProductName');

		$this->db->select('fp4ProductID');
		$this->db->select('fp4StoreID');
		$this->db->select('fp4ProductName');

		$this->db->select('(SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE f1.user_id = handpicked_users.user_id) AS totalFanciedProducts');
		$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE followee_id = handpicked_users.user_id) as totalFollowers');
		$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE follower_id = handpicked_users.user_id) as totalFollowing');
		$this->db->select('(SELECT SUM(badge_level) FROM badges WHERE badges.user_id = handpicked_users.user_id) AS totalBadges');		

		$this->db->from('handpicked_users');

		$userID = $this->session->userdata('id');
		$fbFriends = $this->session->userdata('user_'.$userID.'_friends');
		log_message( 'DEBUG', "just read friends data in 'user_".$userID."_friends'. \r\nsession data is:\r\n".json_encode( $this->session->all_userdata() ) );
		log_message('DEBUG', 'FACEBOOK FRIENDS [user_'.$userID.'_friends] = '.print_r( json_encode($fbFriends), TRUE) );

		$friends = NULL;

		switch($fbFriends !== FALSE)
		{
			case TRUE:	foreach($fbFriends as $fbFriend)
						{
							$friends[] = $fbFriend->userID;
						}
						// $this->session->unset_userdata('user_'.$userID.'_friends'); /* dont unset the friends data from session. will help in getting the friends data on out favourites page */
						$this->db->where_not_in( 'user_id', $friends );
				break;
		}

		$this->db->order_by('sort_order');

		switch(is_null($startFrom))
		{
			case TRUE:	$this->db->limit(40); // by default read 40 users
				break;
			case FALSE:	switch(is_null($maxResults))
						{
							case TRUE:	$this->db->limit(40, 40*$startFrom); // if max result is not given, read 40 users
								break;
							case FALSE:	$this->db->limit($maxResults, $maxResults * $startFrom);
								break;
						}
				break;
		}

		$query = $this->db->get();
		
		$retVal['handpicked'] = NULL;
		$retVal['friends'] = NULL;

		switch($query->num_rows() > 0)
		{
			case TRUE:	$retVal['handpicked'] = $query->result();
				break;
			case FALSE:	$retVal['handpicked'] = NULL;
				break;
		}

		switch($fbFriends !== FALSE)
		{
			case TRUE:	$this->db->select('fr.user_id AS userID');
						$this->db->select('user_details.full_name AS userFullName');
						$this->db->select('fr.rank AS userRank'); 
						$this->db->select('user_details.about_me AS userAboutMe');
						$this->db->select('user_details.gender AS userGender');
						$this->db->select('user_details.fb_uid AS userFBID');
						$this->db->select('user_details.joined_date AS userJoinedDate');

						$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 0) AS fp1ProductID');
						$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 0) AS fp1StoreID');
						$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 0) AS fp1ProductName');

						$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 1) AS fp2ProductID');
						$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 1) AS fp2StoreID');
						$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 1) AS fp2ProductName');

						$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 2) AS fp3ProductID');
						$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 2) AS fp3StoreID');
						$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 2) AS fp3ProductName');

						$this->db->select('(SELECT fancy_products.product_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 3) AS fp4ProductID');
						$this->db->select('(SELECT products.store_id FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 3) AS fp4StoreID');
						$this->db->select('(SELECT products.product_name FROM fancy_products LEFT JOIN products ON fancy_products.product_id = products.product_id WHERE fancy_products.user_id = fr.user_id AND products.status = 1 AND products.is_enable = 0 ORDER BY time DESC LIMIT 1 OFFSET 3) AS fp4ProductName');

						$this->db->select('(SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE f1.user_id = fr.user_id) AS totalFanciedProducts');
						$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE followee_id = fr.user_id) as totalFollowers');
						$this->db->select('(SELECT COUNT(f_no) FROM follow_friends WHERE follower_id = fr.user_id) as totalFollowing');
						$this->db->select('(SELECT SUM(badge_level) FROM badges WHERE badges.user_id = fr.user_id) AS totalBadges');

						$this->db->from('fancy_rank fr');
						$this->db->join('user_details','fr.user_id = user_details.user_id','left');
						$this->db->where_in('fr.user_id', $friends);
						
						$query = $this->db->get();

						switch( $query->num_rows() > 0 )
						{
							case TRUE:	$retVal['friends'] = $query->result();
								break;
						}
				break;
		}

		return $retVal;
	}

	// function to fancy a product.
	// this does not initiate a pop-up on client side as requested by PRT but supports creation of lists
	public function flFancyProduct($productID, $listID = NULL)
	{
		if ($this->session->userdata('logged_in') === TRUE) // if the user accessing this function is logged-in
		{
			if (isset($productID) && !is_null($productID)) // if the product ID has been provided
			{
				$userID = $this->session->userdata('id'); // read the user id from the current session
				$catID = NULL; // variable to hold the category ID of the product
				$subCatID1 = NULL;
				$catName = NULL; // variable to hold the category's name of the category ID of the product
				$fancyListID = NULL; // variable to hold the fancy_list_id
				$listName = NULL;
				// query if the user has already fancied the current product
				// selecting a single column to minimize data overhead as we do not need to read data; only count the number of rows
				$this->db->select('fancy_list_id');
				$this->db->from('fancy_products');
				$this->db->where('user_id', $userID);
				$this->db->where('product_id', $productID);
				$query = $this->db->get();
				if ($query->num_rows() >= 1) // if the number of rows returned is greater than or equal to 1
				{
					return 2; // signifies the product is already fancied
				}
				else
				{
					// if the execution reaches this part means the user is logged-in and has not fancied this product
					// updating the product's fancy counter
					$this->db->set('fancy_counter', 'fancy_counter+1', FALSE);
					/* NEW CODE TO IMPROVISE PERFORMACE OF HOMEPAGE QUERY BY ADDING REQUISITE DATA TO
						the changed products table thereby reducing joins and improving query performance
					*/
					$this->db->set('lastFanciedBy', $userID);
					$this->db->set('lastFanciedAt', time());
					$this->db->set('lFUBadgeType', 4);
					$this->db->set('lFUBadgeLevel', '(SELECT badge_level FROM badges WHERE user_id = '.$userID.' AND badge_type = 4)', FALSE);
					$this->db->set('lFUBadgeNotificationText', '(SELECT notification_text FROM badges WHERE badge_type = 4 AND user_id = '.$userID.')', FALSE);
					$this->db->where('product_id', $productID);
					$query2 = $this->db->update('products');
					if($productID > 4500) // if the product ID is greater than 4500 means the product is in new table as well. so update that as well
					{
						$this->db->set('fancy_counter', 'fancy_counter+1', FALSE);
						$this->db->set('lastFanciedBy', $userID);
						$this->db->set('lastFanciedAt', time());
						$this->db->set('lFUBadgeType', 4);
						$this->db->set('lFUBadgeLevel', '(SELECT badge_level FROM badges WHERE user_id = '.$userID.' AND badge_type = 4)', FALSE);
						$this->db->set('lFUBadgeNotificationText', '(SELECT notification_text FROM badges WHERE badge_type = 4 AND user_id = '.$userID.')', FALSE);
						$this->db->where('product_id', $productID);
						$query3 = $this->db->update('productsNew');
						if (!$query2 || ! $query3) // if the update query has failed
						{
							return 4; // signifies the fancy counter update query has failed
						}
					}
					
					if (!$query2) // if the update query has failed
					{
						return 4; // signifies the fancy counter update query has failed
					}
					
					// read the parent category id of the product
					$this->db->select('cat_id');
					$this->db->select('sub_catid1');
					$this->db->from('products');
					$this->db->where('product_id', $productID);
					$query4 = $this->db->get();
					if ($query4->num_rows() >= 1) // if the query was successful
					{
						$row = $query4->result();
						$catID = $row[0]->cat_id;
						$subCatID1 = $row[0]->sub_catid1;
						$this->session->set_userdata(array("catID" => $catID, "subCatID1" => $subCatID1));
					}
					else
					{
						return 5; //signifies the category read query failed
					}
					// read the category name
					$this->db->select('category_name');
					$this->db->from('catagories');
					$this->db->where('category_id', $catID);
					$query5 = $this->db->get();
					if ($query5->num_rows() > 0) //if the query was successful
					{
						$row = $query5->result();
						$catName = $row[0]->category_name;
					}
					else
					{
						return 6; // signifies category name read query failed
					}

					// check if there already exists a list for this user named "You can gift me these"
					$this->db->select('fancy_list_id');
					$this->db->from('fancy_list');
					$this->db->where('user_id', $userID);
					$this->db->where('fancy_list_name', 'You can gift me these');
					$chkQryForFL = $this->db->get();
					switch($chkQryForFL->num_rows() > 0) // check if the user provided a listName
					{
						case FALSE:	$this->db->set('fancy_list_name', 'You can gift me these');
									$this->db->set('user_id', $userID);
									$this->db->insert('fancy_list');
							break;
					}

					// check if there already exists a list for this user
					$this->db->select('fancy_list_id');
					$this->db->select('fancy_list_name');
					$this->db->from('fancy_list');
					$this->db->where('user_id', $userID);
					switch(is_null($listID)) // check if the user provided a listID
					{
						case TRUE:	$this->db->where('fancy_list_name', 'Things I Love!'); // if the user did not provide a list name set the default list 'Things I Love!'
							break;
						case FALSE:	$this->db->where('fancy_list_id', $listID); // if the user did, try to find the list id of the listName
							break;
					}
					$query6 = $this->db->get();
					$qs = $this->db->last_query();
					/*print "<p>";
					print_r($qs);
					print "</p>";
					print "<p>";
					print_r($query5);
					print "</p>";*/
					if ($query6->num_rows() > 0) // if the query was successful
					{
						$row = $query6->result();
						$fancyListID = $row[0]->fancy_list_id;
					}
					else
					{
						// create a new fancy list for the user
						$data = array();
						$data['user_id'] = $userID;
						$data['fancy_list_name'] = $catName;
						switch( is_null($listName) )
						{
							case TRUE:	$data['fancy_list_name'] = 'Things I Love!';
								break;
							case FALSE:	$data['fancy_list_name'] = $listName;
								break;
						}
						$query7 = $this->db->insert('fancy_list', $data);
						if ($query7)
						{
							$fancyListID = $this->db->insert_id();
						}
						else
						{
							return 7; // signifies failure to create a fancy list for the user
						}
					}
					// insert into fancy list
					$data2['product_id'] = $productID;
					$data2['user_id'] = $userID;
					$data2['fancy_list_id'] = $fancyListID;
					$fancyTimeStamp = date( 'Y-m-d H:i:s', time() );;
					$data2['time'] = $fancyTimeStamp;
					$query8 = $this->db->insert('fancy_products', $data2);
					if ($query8)
					{
						$this->load->model('automate_model');
						$jobType = 5; // a check and then send email job depending upon the result of the check
						$jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate fancyProductEmailComputer";
						/* $jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013 */
						$jobScheduledTime = (time() + 66); // current time + 1 minute
						$jobDetails = array
										(
											'productID' => $productID,
											'userID' => $userID,
											'fancyTimeStamp' => $fancyTimeStamp
										);
						$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
						return 1; // signifies successful fancy of a product
					}
					else
					{
						return 0; // signifies failure of the fancy_product query
					}
				}
			}
			else
			{
				return "___PRODUCT_NOT_PROVIDED___";
			}
		}
		else
		{
			log_message('Info', $this->input->ip_address() . ' is trying to access the ajax controller\'s samAsyncFancyProduct function without logging-in. Could be a hack attempt. Thank God! you had Shammi! ;)');
			//redirect(base_url()); // send the user to the homepage
			return FALSE;
		}
	}

	public function catsData()
	{
		$this->db->select('category_id AS catID');
		$this->db->select('category_name AS catName');

		$this->db->from('catagories');

		/*
		* Disabling categories
		* 387 - Fashion > Men
		* 388 - Fashion > Women
		* 4 - Gifts And Collectibles
		* on PRT's request
		*/
		$this->db->where_in('category_id', array(6, 8, 7, 10, 18, 14, 3, 32) );

		$q = $this->db->get();
		switch($q->num_rows() > 0)
		{
			case TRUE:	return $q->result();
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	public function catTopProducts($catID)
	{
		$this->db->select('product_id AS productID');
		$this->db->select('product_name AS productName');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('store_name AS storeName');
		
		$this->db->from('products');
		
		$this->db->join('store_info', 'products.store_id = store_info.store_id', 'left');

		$whereText = "products.status = 1 AND products.is_enable = 0";

		if($catID == 4)
		{
			$whereText .= " AND cat_id = ".$catID." AND sub_catid1 <> 392";
		}
		else
		{
			$whereText .= " AND (cat_id = ".$catID." OR sub_catid1 = ".$catID." OR sub_catid2 = ".$catID." OR sub_catid3 = ".$catID.")";
		}

		if($catID != 14 && $catID != 3)
		{
			$whereText .= " AND products.added_on > '2014-04-01'";
		}

		$this->db->where($whereText);

		$this->db->order_by('(products.fancy_counter + products.brag_counter)', 'desc');
		$this->db->limit(4);

		$q = $this->db->get();

		log_message('DEBUG', "JUST RAN THE FOLLOWING QUERY___\r\n".$this->db->last_query() );

		switch($q->num_rows() > 0)
		{
			case TRUE:	return $q->result();
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	public function saveCatPreference($catID, $userID)
	{
		$this->db->select('id');

		$this->db->from('user_prefs');
		
		$this->db->where('user_id', $userID);
		$this->db->where('pType', 1);
		$this->db->where('pValue', $catID);
		
		$q = $this->db->get();
		
		switch($q->num_rows() <= 0)
		{
			case TRUE:	$this->db->set('user_id', $userID);
						$this->db->set('pType', 1); // preference type 1, i.e., a preference to store a category
						$this->db->set('pValue', $catID);
						$this->db->set('ts', time());
						return array( 'saved' => $this->db->insert('user_prefs') );
				break;
			case FALSE:	return array( 'saved' => NULL, 'alreadySaved' => TRUE );
				break;
		}
	}

	public function removeCatPreference($catID, $userID)
	{
		$q1SQL = "DELETE FROM `user_prefs` WHERE `user_id` = ".$userID." AND `pType` = 1 AND `pValue` = ".$catID;
		
		$q1 = $this->db->query($q1SQL);
		
		return array( 'saved' => ($this->db->affected_rows() > 0 ? TRUE: FALSE) );
	}
}
?>