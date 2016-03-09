<?php if (!defined('BASEPATH')) exit('Direct script access is prohibited');
class Async_model extends CI_Model
{
	// function to fancy a product.
	// this does not initiate a pop-up on client side as requested by PRT
	public function samAsyncFancyProduct($productID)
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
					// check if there already exists a list for this user
					$this->db->select('fancy_list_id');
					$this->db->from('fancy_list');
					$this->db->where('user_id', $userID);
					$this->db->where('fancy_list_name', $catName);
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

	// function to fancy a product.
	// this does not initiate a pop-up on client side as requested by PRT but supports creation of lists
	public function newFancyProduct($productID, $listID = NULL)
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
				$q1SQL = "SELECT `fancy_list_id` FROM `fancy_products` WHERE `user_id` = ".$this->db->escape( $userID )." AND `product_id` = ".$this->db->escape( $productID );
				log_message('INFO', "\$q1SQL = ".$q1SQL);

				$query = $this->db->query($q1SQL);

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


					// check if there already exists a list for this user
					$this->db->select('fancy_list_id');
					$this->db->select('fancy_list_name');
					$this->db->from('fancy_list');
					$this->db->where('user_id', $userID);
					switch( is_null($listID) || strcmp($listID, "") === 0 ) // check if the user provided a listID
					{
						case TRUE:	$this->db->where('fancy_list_name', 'Things I Love!'); // if the user did not provide a list name set the default list 'Things I Love!'
							break;
						case FALSE:	$this->db->where('fancy_list_id', $listID); // if the user did, try to find the list id of the listID /*checks validity*/
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
						$listName = $row[0]->fancy_list_name;
					}
					else
					{
						// create a new fancy list for the user
						$data = array();
						$data['user_id'] = $userID;
						$data['fancy_list_name'] = $catName;
						switch( is_null($listName) || strcmp($listID, "") === 0 )
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
					$fancyTimeStamp = date( 'Y-m-d H:i:s', time() );
					$data2['time'] = $fancyTimeStamp;
					log_message('INFO', 'Now Inserting Into Fancy list with ID: '.$fancyListID.' for user with ID: '.$userID."\r\n\$data2 = ".print_r($data2, TRUE));
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

	// function to unfancy a product.
	// this does not initiate a pop-up on client side as requested by PRT
	public function samAsyncUnFancyProduct($productID)
	{
		if ($this->session->userdata('logged_in') === TRUE) // if the user accessing this function is logged-in
		{
			if (isset($productID) && !is_null($productID)) // if the product ID has been provided
			{
				$userID = $this->session->userdata('id'); // read the user id from the current session
				$catID = NULL; // variable to hold the category ID of the product
				$catName = NULL; // variable to hold the category's name of the category ID of the product
				$fancyListID = NULL; // variable to hold the fancy_list_id
				// query if the user has already fancied the current product
				// selecting a single column to minimize data overhead as we do not need to read data; only count the number of rows
				$this->db->select('fancy_list_id');
				$this->db->from('fancy_products');
				$this->db->where('user_id', $userID);
				$this->db->where('product_id', $productID);
				$query = $this->db->get();
				if ($query->num_rows() >= 1) // if the number of rows returned is greater than or equal to 1
				{
					// if the execution reaches this part means the user is logged-in and has not fancied this product
					// updating the product's fancy counter
					$this->db->set('fancy_counter', 'fancy_counter-1', FALSE);
					$this->db->where('product_id', $productID);
					$query2 = $this->db->update('products');

					if($productID > 4500) // if the product ID is greater than 4500 means the product is in new table as well. so update that as well
					{
						$this->db->set('fancy_counter', 'fancy_counter-1', FALSE);
						$this->db->where('product_id', $productID);
						$query21 = $this->db->update('productsNew');
						if (!$query2 || !$query21) // if the update query has failed
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
					$this->db->from('products');
					$this->db->where('product_id', $productID);
					$query3 = $this->db->get();
					if ($query3->num_rows() >= 1) // if the query was successful
					{
						$row = $query3->result();
						$catID = $row[0]->cat_id;
					} else {
						return 5; //signifies the category read query failed
					}
					// read the category name
					$this->db->select('category_name');
					$this->db->from('catagories');
					$this->db->where('category_id', $catID);
					$query4 = $this->db->get();
					if ($query4->num_rows() > 0) //if the query was successful
					{
						$row = $query4->result();
						$catName = $row[0]->category_name;
					} else {
						return 6; // signifies category name read query failed
					}
					// check if there already exists a list for this user
					$this->db->select('fancy_list_id');
					$this->db->from('fancy_list');
					$this->db->where('user_id', $userID);
					$this->db->where('fancy_list_name', $catName);
					$query5 = $this->db->get();
					$qs = $this->db->last_query();
					/*print "<p>";
					print_r($qs);
					print "</p>";
					print "<p>";
					print_r($query5);
					print "</p>";*/
					if ($query5->num_rows() > 0) // if the query was successful
					{
						$row = $query5->result();
						$fancyListID = $row[0]->fancy_list_id;
					} else {
						// create a new fancy list for the user
						$data = array();
						$data['user_id'] = $userID;
						$data['fancy_list_name'] = $catName;
						$query6 = $this->db->insert('fancy_list', $data);
						if ($query6) {
							$fancyListID = $this->db->insert_id();
						} else {
							return 7; // signifies failure to create a fancy list for the user
						}
					}
					// insert into fancy list
					$data2 = array();
					$data2['product_id'] = $productID;
					$data2['user_id'] = $userID;
					$data2['fancy_list_id'] = $fancyListID;
					$query7 = $this->db->delete('fancy_products', $data2);
					if ($query7) {
						return 1; // signifies successful unfancy of a product
					} else {
						return 0; // signifies failure of the unfancy_product query
					}
				} else {
					return 2; // signifies the product has not been fancied by the current user
				}
			} else {
				return "___PRODUCT_NOT_PROVIDED___";
			}
		} else {
			log_message('Info', $this->input->ip_address() . ' is trying to access the ajax controller\'s samAsyncFancyProduct function without logging-in. Could be a hack attempt. Thank God! you had Shammi! ;)');
			//redirect(base_url()); // send the user to the homepage
			return FALSE;
		}
	}

	private function getUidByEmail($email)
	{
		$this->db->select('user_id');
		$this->db->from('user_details');
		$this->db->where('email', $email);
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function hasFancied($productID = NULL) // returns whether the current user has fancied the product specified by $productID
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async/checkLogin');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$this->load->model('async_model');
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in"  from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve header data for the user '.$userID);
					 if (isset($productID) && !is_null($productID)) // if the product ID has been provided
					 {
						// query if the user has already fancied the current product
						// selecting a single column to minimize data overhead as we do not need to read data; only count the number of rows
						$this->db->select('fancy_list_id');
						$this->db->from('fancy_products');
						$this->db->where('user_id', $userID);
						$this->db->where('product_id', $productID);
						$query = $this->db->get();
						switch($query->num_rows() >= 1) // if the number of rows returned is greater than or equal to 1
						{
							case TRUE: return TRUE; // signifies the product is already fancied
								break;
							case FALSE: return FALSE;
								break;
						}
					 }
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" from '.$__ip);
					  log_message('INFO', 'Will now return false');
					  return FALSE;
				break;
		}
	}

	public function hasPolled($productID) // returns whether the current user has fancied the product specified by $productID
	{
		//print "<p>inside poll</p>";
		if ($this->session->userdata('logged_in') === TRUE) // if the user accessing this function is logged-in
		{
			//print "<pre>Logged-in: ".$this->session->userdata('logged_in')."</pre>";
			if (isset($productID) && !is_null($productID)) // if the product ID has been provided
			{
				$userID = $this->session->userdata('id'); // read the user id from the current session
				//print "<pre>user-ID: ".$userID."</pre>";
				// query if the user has already polled the current product
				// selecting a single column to minimize data overhead as we do not need to read data; only count the number of rows
				$this->db->select('p_id');
				$this->db->from('poll_products');
				$this->db->where('user_id', $userID);
				$this->db->where('product_id', $productID);
				$query = $this->db->get();
				//print "<pre>user-ID: ";print_r($query);print "</pre>";
				//print "<pre>query rows returned: ".$query->num_rows()."</pre>";
				if ($query->num_rows() >= 1) // if the number of rows returned is greater than or equal to 1
				{
					return TRUE; // signifies the product is already polled
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else
			return FALSE;
	}

	public function getUserFanciedItems($userID, $startFrom = NULL)
	{
		//echo "test";
		$this->db->select('products.product_id, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter, products.quantity');
		$this->db->from('fancy_products, products');
		$this->db->where('fancy_products.user_id = ' . $userID . ' and fancy_products.product_id = products.product_id');
		$this->db->order_by('fancy_products.time', 'desc');
		if (!is_null($startFrom))
			$this->db->limit(8, 8*$startFrom);
		else
			$this->db->limit(8, 0);
		//echo $this->db->_compile_select();
		$query = $this->db->get();
		//echo "<pre>".$this->db->_error_message()."</pre>";
		//echo $this->db->last_query(); // shows the last select query executed
		//print_r($query);
		if ($query) // if the query was successful
		{
			if ($query->num_rows() > 0)
				return $query->result();
			else
				return FALSE;
		} else
			return FALSE;
	}

	public function getUserFanciedItemsCount($userID, $startFrom = NULL)
	{
		$this->db->select('COUNT(*) AS fanciedItemsCount');
		$this->db->from('fancy_products, products');
		$this->db->where('fancy_products.user_id = ' . $userID . ' AND fancy_products.product_id = products.product_id');
		$this->db->order_by('time', 'desc');
		switch ($startFrom) {
			// if no value has been provided to $startFrom
			// then do nothing i.e., get all results
			case NULL: //$this->db->limit(25, 0);
				break;
			// if some value is provided to $startFrom
			// then use that as the offset
			default:
				$this->db->limit(25, 25*$startFrom);
		}

		$query = $this->db->get();

		if ($query->result()) {
			$row = $query->result();
			//print "<p>query numrows = ".$query->num_rows()."</p>";
			//print_r($row);
			$fancyCount = $row[0]->fanciedItemsCount;
			//print "<p>fancyCount = ".$row."</p>";
			return $fancyCount;
		} else {
			return FALSE;
		}
	}

	public function storeIDToName($storeID)
	{
		$this->db->select('store_name');
		$this->db->from('store_info');
		$this->db->where('store_id = ' . $storeID);
		$query = $this->db->get();
		if ($query) {
			$row = $query->result();
			return $row[0]->store_name;
		} else
			return FALSE;
	}

	// function to pull details about a given product asynchronously
	// which can be used by the front-end to display the product
	public function getAsyncProductDetails($productID)
	{
		$this->db->select('products.product_id, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter, products.quantity');
		$this->db->from('products');
		$this->db->where('products.product_id', $productID);
		$query = $this->db->get();
		switch ($query->num_rows() > 0) {
			case TRUE:
				return $query->result();
				break;
			case FALSE:
				return FALSE;
		}
	}

	public function getRecentlySold($startFrom = NULL)
	{
		//$results = array();
		// get the products that have been recently ordered
		$this->db->select("products.product_id, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter, products.quantity");
		$this->db->from("products, orders");
		$this->db->where('orders.product_id = products.product_id');
		$this->db->order_by("orders.date_of_order", "desc");
		switch ($startFrom) {
			case NULL:
				$this->db->limit(4, 0);
				break;
			default:
				$this->db->limit(4, 4*$startFrom);
		}
		$query = $this->db->get();
		switch ($query->num_rows() > 0) {
			// if the number of rows is less than or equal to zero return false
			case FALSE:
				return FALSE;
				break;
			// if the number of rows is greater than zero
			// find the product details required to display a product
			case TRUE:
				return $query->result();
				/*foreach($query->result() as $row)
				   {
						$tmpResult = $this->getAsyncProductDetails($row->product_id);
						switch($tmpResult)
						{
							// if the result from getAsyncProductDetails is false
							case FALSE: break;
							// if the result from getAsyncProductDetails is true i.e., something is recieved store it
							case TRUE: $results[] = $tmpResult;
								break;
						}
				   }
				   return $results;*/
				break;
		}
	}

	public function getUserFanciedStore($userID, $startFrom = NULL, $catID = NULL)
	{
		/*
		QUERY BEING USED __________________________________________________________________
		select
		store_info.store_id,
		store_info.store_name,
		store_info.about_store,
		store_info.contact_name,
		store_info.storeowner_id,
		store_info.fancy_counter,
		store_info.visit_counter,
		store_owner.owner_name
		from store_info
		join store_owner on store_owner.store_id = store_info.store_id
		join fancy_store on fancy_store.store_id = store_info.store_id
		where fancy_store.user_id = 2915
		order by store_info.fancy_counter desc;
		*/
		$this->db->select('store_info.store_id');
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.about_store');
		$this->db->select('store_info.contact_name');
		$this->db->select('store_info.storeowner_id');
		$this->db->select('store_info.fancy_counter');
		$this->db->select('store_info.visit_counter');
		$this->db->select('store_owner.owner_name');
		$this->db->select('products.cat_id');
		$this->db->select('(SELECT COUNT(p1.product_id) FROM products p1 WHERE p1.store_id = store_info.store_id) AS totalProducts');
		$this->db->select('(SELECT SUM(p2.fancy_counter) FROM products p2 WHERE p2.store_id = store_info.store_id) AS totalFancied');
		$this->db->select('(SELECT SUM(p3.visit_counter) FROM products p3 WHERE p3.store_id = store_info.store_id) AS storeVisitCounter');
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeSections');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = ".$userID." AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = ".$userID." AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the stores or not');
					  $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = '%' AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = '%' AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED THE STORE OR NOT ====================================================== */
		$this->db->from('store_info');
		$this->db->join('store_owner', 'store_owner.store_id = store_info.store_id');
		$this->db->join('fancy_store', 'fancy_store.store_id = store_info.store_id');
		$this->db->join('products', 'products.store_id = store_info.store_id');
		$this->db->where('fancy_store.user_id', $userID);
		$this->db->where('store_info.isPublished', 1); // only pick stores which are enabled
		switch( is_null($catID) )
		{
			case FALSE: $this->db->where('products.cat_id', $catID);
				break;
		}
		$this->db->group_by('store_info.store_id');
		$this->db->order_by('store_info.fancy_counter', 'desc');
		switch ($startFrom)
		{
			case NULL:
				$this->db->limit(6, 0);
				break;
			default:
				$this->db->limit(6, $startFrom*6);
		}
		$query = $this->db->get();
		//print "<pre>".$this->db->last_query()."</pre>";
		switch ($query->num_rows() > 0)
		{
			case FALSE:
				return FALSE;
				break;
			case TRUE:
				return $query->result();
				break;
		}
	}

	public function getMostFanciedStoreProducts($storeID, $numberOfProducts = NULL)
	{
		$this->db->select('products.product_id, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter, products.quantity');
		$this->db->from('products');
		$this->db->where('products.store_id', $storeID);
		$this->db->where('products.status', 1);
		$this->db->where('products.is_enable', 0);
		switch (is_null($numberOfProducts))
		{
			case TRUE:	$this->db->limit(6);
				break;
			case FALSE:	$this->db->limit($numberOfProducts);
				break;
		}

		$query = $this->db->get();

		switch ($query->num_rows > 0)
		{
			case TRUE:	return $query->result();
				break;
			case FALSE:	return FALSE;
				break;
		}
	}

	public function getMostFanciedStoreProductsLite($storeID, $numberOfProducts = NULL, $catID = NULL)
	{
		$this->db->select('products.product_id');
		$this->db->select('products.product_name');
		$this->db->from('products');
		$this->db->where('products.store_id', $storeID);
		$this->db->where('products.status', 1);
		$this->db->where('products.is_enable', 0);
		switch(is_null($catID))
		{
			case FALSE: $this->db->where('cat_id', $catID);
				break;
		}
		$this->db->order_by('fancy_counter', 'desc');
		switch (is_null($numberOfProducts))
		{
			case TRUE:
				$this->db->limit(3);
				break;
			case FALSE:
				$this->db->limit($numberOfProducts);
				break;
		}
		$query = $this->db->get();
		/*print "<pre>".$this->db->last_query()."</pre>";
		print "<pre>";
		print_r($query->result());
		print "</pre>";*/
		switch ($query->num_rows() > 0) {
			case TRUE:
				return $query->result();
				break;
			case FALSE:
				return FALSE;
				break;
		}
	}

	public function getRecentProducts($startFrom = NULL)
	{
		$this->db->select('products.product_id, products.product_name, products.store_id');
		$this->db->from('products');
		switch (is_null($startFrom)) {
			case TRUE: $this->db->limit(15); // read only 15 products by default
				break;
			case FALSE: $this->db->limit(15, 15*$startFrom);
		}
		$query = $this->db->get();
		switch ($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: return $query->result();
				break;
		}
	}

	public function getRecentStores($startFrom = NULL)
	{
		$this->db->select('store_info.store_name, products.store_id');
		$this->db->from('store_info, products');
		$this->db->where('store_info.store_id = products.store_id');
		$this->db->where('store_info.isPublished', 1); // only pick stores which are enabled
		$this->db->group_by('products.store_id');
		$this->db->order_by('added_on', 'desc');
		switch (is_null($startFrom))
		{
			case TRUE: $this->db->limit(4); // read only 4 stores by default
				break;
			case FALSE: $this->db->limit(4, 4*$startFrom);
				break;
		}
		$query = $this->db->get();
		switch ($query->num_rows() > 0)
		{
			case FALSE:
				return FALSE;
				break;
			case TRUE:
				return $query->result();
				break;
		}
	}

	public function getTopStores($startFrom = NULL, $catID = NULL)
	{
		/*
		QUERY BEING USED=====================================
		select
		visit_counter,
		fancy_counter,
		store_name,
		store_info.store_id,
		brag_counter,
		(fancy_counter + visit_counter + (SELECT COUNT(*) AS storeSales FROM orders WHERE orders.store_id = store_info.store_id)) AS storeScore
		from store_info
		join orders on orders.store_id = store_info.store_id
		group by store_info.store_id
		order by storeScore desc;

		//order by visit_counter + fancy_counter + (SELECT COUNT(*) AS storeSales FROM orders WHERE orders.store_id = store_info.store_id) desc;

		*/
		$this->db->select('store_info.visit_counter');
		$this->db->select('store_info.fancy_counter');
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.store_id');
		$this->db->select('store_info.brag_counter');
		$this->db->select('(store_info.fancy_counter + store_info.visit_counter + (SELECT COUNT(*) AS storeSales FROM orders WHERE orders.store_id = store_info.store_id)) AS storeScore');
		$this->db->select('(SELECT COUNT(p1.product_id) FROM products p1 WHERE p1.store_id = store_info.store_id) AS totalProducts');
		$this->db->select('products.cat_id AS catID');
		$this->db->select('(SELECT COUNT(p1.product_id) FROM products p1 WHERE p1.store_id = store_info.store_id) AS totalProducts');
		$this->db->select('(SELECT SUM(p2.fancy_counter) FROM products p2 WHERE p2.store_id = store_info.store_id) AS totalFancied');
		$this->db->select('(SELECT SUM(p3.visit_counter) FROM products p3 WHERE p3.store_id = store_info.store_id) AS storeVisitCounter');
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeSections');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = ".$userID." AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = ".$userID." AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the stores or not');
					  $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = '%' AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = '%' AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED THE STORE OR NOT ====================================================== */
		$this->db->from('store_info');
		$this->db->join('products', 'products.store_id = store_info.store_id');
		//$this->db->join('orders', 'orders.store_id = store_info.store_id');
		$this->db->where('store_info.isPublished', 1); // only pick stores which are enabled
		switch(is_null($catID))
		{
			case FALSE: $this->db->where('products.cat_id', $catID);
				break;
		}
		$this->db->group_by('store_info.store_id');
		$this->db->order_by('storeScore', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(6); // read only 6 stores by default
				break;
			case FALSE: $this->db->limit(6, $startFrom*6);
				break;
		}
		$query = $this->db->get();
		switch ($query->num_rows() > 0)
		{
			case FALSE:
				return FALSE;
				break;
			case TRUE:
				return $query->result();
				break;
		}
	}

	public function getNewStores($startFrom = NULL, $catID = NULL)
	{
		/*
		QUERY BEING USED=====================================
		select
		distinct(store_info.store_id),
		store_info.visit_counter,
		store_info.fancy_counter,
		store_info.store_name,
		store_info.brag_counter,
		(store_info.fancy_counter + store_info.visit_counter + (SELECT COUNT(*) AS storeSales FROM orders WHERE orders.store_id = store_info.store_id)) AS storeScore,
		(SELECT products.added_on FROM products WHERE products.store_id = store_info.store_id limit 1) AS added_on
		from store_info
		order by added_on desc;
		*/
		$this->db->select('distinct(store_info.store_id)');
		$this->db->select('store_info.visit_counter');
		$this->db->select('store_info.fancy_counter');
		$this->db->select('store_info.store_id');
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.brag_counter');
		$this->db->select('(store_info.fancy_counter + store_info.visit_counter + (SELECT COUNT(order_id) AS storeSales FROM orders WHERE orders.store_id = store_info.store_id)) AS storeScore');
		$this->db->select('(SELECT products.added_on FROM products WHERE products.store_id = store_info.store_id ORDER BY added_on DESC LIMIT 1) AS added_on');
		$this->db->select('products.cat_id AS catID');
		$this->db->select('(SELECT COUNT(p1.product_id) FROM products p1 WHERE p1.store_id = store_info.store_id) AS totalProducts');
		$this->db->select('(SELECT SUM(p1.fancy_counter) FROM products p1 WHERE p1.store_id = store_info.store_id) AS totalFancied');
		$this->db->select('(SELECT SUM(p3.visit_counter) FROM products p3 WHERE p3.store_id = store_info.store_id) AS storeVisitCounter');
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeSections');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = ".$userID." AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = ".$userID." AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the stores or not');
					  $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = '%' AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = '%' AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED THE STORE OR NOT ====================================================== */
		$this->db->from('store_info');
		$this->db->join('products', 'products.store_id = store_info.store_id');
		$this->db->where('store_info.isPublished', 1); // only pick stores which are enabled
		$this->db->where('products.status', 1); // only pick products which are enabled
		$this->db->where('products.is_enable', 0); // only pick products which are enabled
		switch(is_null($catID))
		{
			case FALSE: $this->db->where('products.cat_id', $catID);
				break;
		}
		$this->db->group_by('store_info.store_id');
		$this->db->order_by('added_on', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(12); // read only 6 stores by default
				break;
			case FALSE: $this->db->limit(12, $startFrom*12);
				break;
		}
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY_____________\r\n".$this->db->last_query());
		switch ($query->num_rows() > 0)
		{
			case FALSE:
				return FALSE;
				break;
			case TRUE:
				return $query->result();
				break;
		}
	}

	public function getRecentlyFancied($startFrom = NULL)
	{
		$this->db->select('products.product_id, products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter, products.quantity');
		$this->db->from('fancy_products, products');
		switch ($this->session->userdata('logged_in')) {
			case TRUE:
				$userID = $this->session->userdata('id');
				$this->db->where('fancy_products.user_id = ' . $userID . ' and fancy_products.product_id = products.product_id');
				break;
			case FALSE:
				$this->db->where('fancy_products.product_id = products.product_id');
		}
		switch (is_null($startFrom)) {
			case TRUE:
				$this->db->limit(25);
				break;
			case FALSE:
				$this->db->limit(25, 25*$startFrom);
				break;
		}
		$this->db->order_by('fancy_products.time', 'desc');
		$query = $this->db->get();
		switch ($query->num_rows() > 0) {
			case FALSE:
				return FALSE;
				break;
			case TRUE:
				return $query->result();
		}
	}

	public function lazyFanciedData($startFrom = NULL, $maxResults = NULL, $userID = NULL)
	{
		$this->db->select('distinct(fancy_products.product_id), products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter, products.quantity');
		$this->db->from('fancy_products, products, store_info');
		switch ($this->session->userdata('logged_in') && !is_null($userID)) {
			case TRUE:
				$userID = $this->session->userdata('id');
				$this->db->where('fancy_products.user_id = ' . $userID . ' AND fancy_products.product_id = products.product_id');
				break;
			case FALSE:
				$this->db->where('fancy_products.product_id = products.product_id');
		}
		$this->db->order_by('fancy_products.time', 'desc');
		switch (is_null($startFrom))
		{
			case TRUE:
				$this->db->limit(50); // by default read 50 products
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$this->db->limit(50, 50*$startFrom); // if max result is not given, read 50 products
						break;
					case FALSE:
						$this->db->limit($maxResults, $maxResults*$startFrom);
						break;
				}
				break;
		}
		$query = $this->db->get();
		//print "<pre>".$this->db->last_query()."</pre>";
		switch ($query->num_rows() > 0) {
			case FALSE:
				return FALSE;
				break;
			case TRUE:
				return $query->result();
		}
	}

	public function lazyFanciedData2($startFrom = NULL, $maxResults = NULL)
	{
		$this->db->select('distinct(fancy_products.product_id), products.store_id, products.fancy_counter, products.is_on_discount, products.selling_price, products.discount, products.product_name, products.visit_counter, products.quantity');
		$this->db->from('fancy_products, products, store_info');
		switch ($this->session->userdata('logged_in')) {
			case TRUE:
				$userID = $this->session->userdata('id');
				$this->db->where('fancy_products.user_id = ' . $userID . ' AND fancy_products.product_id = products.product_id');
				break;
			case FALSE:
				$this->db->where('fancy_products.product_id = products.product_id');
		}
		$this->db->order_by('fancy_products.time', 'desc');
		switch (is_null($startFrom)) {
			case TRUE:
				$this->db->limit(50); // by default read 50 products
				break;
			case FALSE:
				switch (is_null($maxResults)) {
					case TRUE:
						$this->db->limit(50, 50*$startFrom); // if max result is not given, read 50 products
						break;
					case FALSE:
						$this->db->limit($maxResults, $maxResults*$startFrom);
						break;
				}
				break;
		}
		$query = $this->db->get();
		//print "<pre>".$this->db->last_query()."</pre>";
		switch ($query->num_rows() > 0) {
			case FALSE:
				return FALSE;
				break;
			case TRUE:
				return $query->result();
		}
	}

	// read the user IDs of users who last fancied a product[specified by $productID]
	public function lastFanciedBy($productID, $numberOfUsers = NULL)
	{
		$currentUserID = ($this->session->userdata('id') !== FALSE) ? $this->session->userdata('id'): "'%'";
		$this->db->select('DISTINCT(fancy_products.user_id), user_details.fb_uid, user_details.gender AS userGender');
		$this->db->from('fancy_products');
		$this->db->join('user_details', 'fancy_products.user_id = user_details.user_id', 'left');
		$this->db->where('product_id = '.$productID);
		$this->db->where('fancy_products.user_id <> '.$currentUserID);
		$this->db->order_by('`time`', 'desc');
		switch (is_null($numberOfUsers))
		{
			case TRUE: $this->db->limit(15); // by default read 5 users
				break;
			case FALSE: $this->db->limit($numberOfUsers);
				break;
		}

		$query = $this->db->get();
		//print "<pre>".$this->db->last_query()."</pre>";
		switch($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: return $query->result();
				break;
		}
	}

	// read the user IDs of users who last fancied a product[specified by $productID]
	public function lastBraggedBy($productID, $numberOfUsers = NULL)
	{
		$currentUserID = ($this->session->userdata('id') !== FALSE) ? $this->session->userdata('id'): 'NULL';
		$this->db->select('DISTINCT(brag_products.user_id), user_details.fb_uid, user_details.gender AS userGender');
		$this->db->from('brag_products');
		$this->db->join('user_details', 'brag_products.user_id = user_details.user_id');
		$this->db->where('product_id = '.$productID);
		$this->db->where('brag_products.user_id <> '.$currentUserID);
		switch (is_null($numberOfUsers))
		{
			case TRUE: $this->db->limit(5); // by default read 5 users
				break;
			case FALSE: $this->db->limit($numberOfUsers);
				break;
		}

		$query = $this->db->get();
		//print "<pre>".$this->db->last_query()."</pre>";
		switch($query->num_rows() > 0)
		{
			case FALSE: return NULL;
				break;
			case TRUE: return $query->result();
				break;
		}
	}

	public function increaseProductVisitCounter($productID)
	{
		log_message('INFO', 'inside async_model/increaseProductVisitCounter');
		$this->db->set('visit_counter', 'visit_counter + 1', FALSE);
		$this->db->where("product_id = ".$productID, NULL, FALSE);
		$updateResult1 = $this->db->update('products');
		log_message('INFO', 'JUST RAN THE QUERY__________________________________________________________________'.$this->db->last_query());
		$isNew = ($productID > 4499)? TRUE : FALSE;
		$updateResult2 = NULL;
		if($isNew === TRUE)
		{
			$this->db->set('visit_counter', 'visit_counter + 1', FALSE);
			$this->db->where('product_id = '.$productID, NULL, FALSE);
			$updateResult2 = $this->db->update('productsNew');
		}
		log_message('INFO', 'JUST RAN THE QUERY__________________________________________________________________'.$this->db->last_query());
		log_message('INFO', "\$updateResult1 = ".print_r($updateResult1, TRUE).", \$updateResult2 = ".print_r($updateResult2, TRUE));
		return ($updateResult1 && $updateResult2);
	}

	public function saveUserProductVisit( $pid = NULL )
	{
		log_message('INFO', 'inside async_model/saveUserProductVisit');
		$userID = $this->session->userdata('id');
		$isLoggedIN = $this->session->userdata('logged_in');
		$ipAddress = ip2long( $this->input->ip_address() );
		$isReallyLoggedIN = ( $userID !== FALSE && $isLoggedIN !== FALSE && is_numeric( $userID ) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in

		settype( $userID, 'integer' );
		settype( $pid, 'integer' );

		switch( $isReallyLoggedIN && $pid !== NULL && is_numeric ( $pid ) && $pid !== 0 )
		{
			case FALSE:	log_message('INFO', 'case evaluated to false');
									return FALSE;
				break;
			case TRUE:	$q1SQL = "INSERT INTO `productVisits`(`product_id`, `user_id`, `ip`)";
									$q1SQL .= " VALUES(".$this->db->escape( $pid ).", ".$this->db->escape( $userID ).", ".$this->db->escape( $ipAddress ).")";

									log_message( 'INFO', 'case evaluated to true' );
									log_message( 'INFO', "wil run query:::\r\n".$q1SQL );

									$q1 = $this->db->query( $q1SQL );
				break;
		}
	}

	public function qVProductData($productID)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/qVProductData');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in

		$this->db->select('p1.store_id, p1.product_name, p1.selling_price, p1.is_on_discount, p1.discount, p1.quantity, p1.cat_id, p1.sub_catid1, p1.sub_catid2, p1.sub_catid3, p1.fancy_counter, p1.brag_counter, p1.visit_counter');
		$this->db->select('p1.cat_id AS catID, p1.sub_catid1 AS subCatID1');
		$this->db->select('p1.processing_time AS processingTime');
		$this->db->select('store_info.store_name AS storeName');
		$this->db->select('store_info.return_policy AS storeReturnPolicy');
		$this->db->select('store_info.EMI_policy AS storeEMIPolicy');
		$this->db->select('store_info.COD_policy AS storeCODPolicy');
		$productsTableName = ($productID > 4499)? "prodData": "products";
		if($productID > 4499)
		{
			$this->db->select('p1.description');
			$this->db->select('p1.whats_in_the_box');
			$this->db->select('p1.dimensionUnit');
			$this->db->select('p1.dimensionLabel');
			$this->db->select('p1.length');
			$this->db->select('p1.breadth');
			$this->db->select('p1.height');
			$this->db->select('p1.diameter');
			$this->db->select('p1.capacityUnit');
			$this->db->select('p1.capacity');
			$this->db->select('p1.finish');
			$this->db->select('p1.tech_spec');
			$this->db->select('p1.material_composition');
			$this->db->select('p1.usage');
			$this->db->select('p1.care');
			$this->db->select('p1.assembly');
			$this->db->select('p1.sellers_assurance');
			$this->db->select('p1.additional_info');
		}
		else
		{
			$this->db->select('description');
		}
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(product_id) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = p1.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(product_id) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = p1.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(product_id) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = p1.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(product_id) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = p1.product_id)), TRUE, FALSE)) AS hasBragged", FALSE);
				break;
		}

		$this->db->from($productsTableName.' p1');
		$this->db->join('store_info', 'store_info.store_id = p1.store_id');
		$this->db->where('p1.product_id = ', $productID);
		$this->db->where('p1.status', 1); // only pick stores which are enabled
		$this->db->where('p1.is_enable', 0); // only pick products which are enabled
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY____________________________________\r\n".print_r($this->db->last_query(), TRUE));
		switch($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: log_message('INFO', print_r($query->result(), TRUE));
					return $query->result();
				break;
		}
	}

	public function qVProductVariants($productID)
	{
		log_message('INFO', '____________________Inside qVProductVariants________________________');
		$this->db->select('variant_name AS variantName');
		$this->db->select('variants_types AS variantTypes');
		$this->db->select('quantity AS variantQuantity');
		$this->db->select('size AS variantSize');
		$this->db->select('color AS variantColor');
		$this->db->from('variant');
		$this->db->where('product_id', $productID);
		$query = $this->db->get();
		log_message('INFO', 'JUST RAN THE FOLLOWING QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: return $query->result();
				break;
		}
	}

	// fetch a list of products as per the exact category provided by the arguments
	public function qVSameCatProducts($catID, $subCatID1, $subCatID2, $subCatID3)
	{
		log_message('INFO', '____________________Inside qVSameCatProducts________________________');
		$this->db->select('product_id');
		$this->db->select('product_name');
		$this->db->select('store_id');
		$this->db->select('selling_price');
		$this->db->select('is_on_discount');
		$this->db->select('discount');
		$this->db->select('quantity AS productQuantity');
		$this->db->select('fancy_counter AS fancyCounter');
		$this->db->select('visit_counter AS visitCounter');
		$this->db->select('brag_counter AS bragCounter');
		$this->db->from('products');
		/* BUGFIX FOR bitbucket issue #88 */
		$whereText = NULL;
		if(! is_null($catID) && strcmp($catID, '') !== 0)
		{
			$whereText = 'cat_id = '.$catID;
			if(! is_null($subCatID1) && strcmp($subCatID1, '') !== 0)
			{
				$whereText .= ' AND sub_catid1 = '.$subCatID1;
			}

			if(! is_null($subCatID2) && strcmp($subCatID2, '') !== 0)
			{
				$whereText .= ' AND sub_catid2 = '.$subCatID2;
			}

			if(! is_null($subCatID3) && strcmp($subCatID3, '') !== 0)
			{
				$whereText .= ' AND sub_catid3 = '.$subCatID3;
			}

			$this->db->where($whereText);
		}

		$this->db->where('quantity > 0 AND products.status = 1 AND products.is_enable = 0');
		/* BUGFIX FOR bitbucket issue #88 */

		$this->db->order_by('fancy_counter', 'desc');
		$this->db->limit(15);
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY_________________________\r\n");
		log_message('INFO', $this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: log_message('INFO', 'DATA RETURNED___________________________________________________________________');
					 log_message('INFO', print_r($query->result(), TRUE));
					 return $query->result();
				break;
		}
	}

	public function qVSameStoreProducts($productID)
	{
		/*
		QUERY BEING USED
		select p1.store_id, p1.product_id, p1.product_name
		from products p1
		join products p2 ON p1.store_id = p2.store_id
		where p2.product_id = 1006;
		*/
		log_message('INFO', '____________________Inside qVSameStoreProducts________________________');
		$this->db->select('p1.product_id AS productID');
		$this->db->select('p1.product_name AS productName');
		$this->db->select('p1.product_id AS productID');
		$this->db->select('p1.store_id AS storeID');
		$this->db->select('p1.selling_price');
		$this->db->select('p1.is_on_discount');
		$this->db->select('p1.discount');
		$this->db->select('p1.quantity AS productQuantity');
		$this->db->select('p1.fancy_counter AS fancyCounter');
		$this->db->select('p1.visit_counter AS visitCounter');
		$this->db->select('p1.brag_counter AS bragCounter');
		$this->db->from('products p1');
		$this->db->join('products p2', 'p1.store_id = p2.store_id');
		$this->db->where('p2.product_id', $productID);
		$this->db->where('p1.status', 1); // pick only stores that are enabled
		$this->db->where('p1.is_enable', 0); // pick only products that are enabled
		$this->db->limit(20);
		$query = $this->db->get();
		log_message('INFO', 'JUST RAN THE FOLLOWING QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: return $query->result();
				break;
		}
	}

	// fetch a list of products (max 25) which have been fancied by the users
	public function recentlyFanciedProductsByUsers($userIDs)
	{
		// $this->db->select('product_id, store_id, product_name, fancy_counter');
		$this->db->select('distinct(fancy_products.product_id), product_name, store_id, fancy_counter');
		$this->db->from('fancy_products');
		$this->db->join('products', 'fancy_products.product_id = products.product_id');
		$whereText = NULL;
		$userIDsCount = count($userIDs);
		$i = 0;
		if($userIDsCount > 0)
		{
			$whereText = "";
			foreach($userIDs as $userID)
			{
				$whereText .= 'user_id = '.$userID;
				$i++;
				if($i < $userIDsCount)
				{
					$whereText .= ' OR ';
				}
			}
			$this->db->where($whereText);
		}
		$this->db->limit(25); // limit to a maximum of 25 products
		$query = $this->db->get();
		//print "<pre>".$this->db->last_query()."</pre>";
		switch($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: return $query->result();
				break;
		}
	}

	public function userAuthDetails($email, $pw = NULL) // used when a user is trying to log-in
	{
		$data['IP'] = $this->input->ip_address();
		$this->db->select('`user_details`.`user_id` AS `userID`,`fb_uid` AS `FBID`, `full_name` AS `fullName`, `gender` AS `gender`,`email` AS email,`password` AS `password`');
		$this->db->select('user_details.isActive');
		$this->db->select('user_details.rFlowStatus');
		$this->db->select('user_details.joined_date AS userJoinedDate');
		$this->db->from('user_details');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$result = $this->db->get();
		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		log_message('INFO', 'number of rows returned: '.$result->num_rows());
		switch($result->num_rows() > 0)
		{
			case FALSE:	log_message('INFO', 'no user with the email you provided was found. Creating a Deactivated account now');
						/*$pw = is_null($pw)? "": $pw;
						$this->db->set('email', $email);
						$this->db->set('password', md5($pw));
						$this->db->set('isActive', 0);
						$this->db->set('joined_date', date('Y-m-d'));
						$this->db->set('fb_uid', 'non-fb-member');
						$newUserCreated = $this->db->insert('user_details');
						log_message('INFO', "Just ran the following query____________________________________\r\n".$this->db->last_query());
						$userIDNew = $this->db->insert_id();
						log_message('INFO', 'New deactivated user created with userID '.$userIDNew);

						$this->load->library('email');
						$this->email->from('support@buynbrag.com', 'BuynBrag');
						$this->email->to($email);
						$this->email->subject("BuynBrag ::: You just created a new account at BuynBrag");

						$msg = $this->load->view('emailers/newDeactivatedUser', $data, true);

						$this->email->message($msg);
						$this->email->set_newline("\r\n");

						if($this->email->send())
						{
						   log_message('INFO', " Successfully SENT new deactivated user MAIl FOR THE USER WITH ID : ".$userIDNew);
						}
						else
						{
						   log_message('INFO', " Error sending new deactivated user mail FOR THE USER WITH ID : ".$userIDNew);
						}

						log_message('INFo', 'returning FALSE from async_model/userAuthDetails');
						return array('userExists' => FALSE, 'newUserCreated' => $newUserCreated, 'newUserID' => $userIDNew, 'userDetails' => FALSE);*/
						return array('userExists' => FALSE, 'newUserCreated' => FALSE, 'newUserID' => FALSE, 'userDetails' => FALSE);
				break;
			case TRUE:	log_message('INFO', 'Resultset returned: '.print_r($result->result(), TRUE));
						$userDetails = $result->result();
						$newUserID = ($userDetails[0]->isActive == 0)? $userDetails[0]->userID: NULL;

					 return array('userExists' => TRUE, 'newUserCreated' => FALSE, 'newUserID' => $newUserID, 'userDetails' => $userDetails);
				break;
		}
	}

	public function forgotPasswordHash($emailID)
	{
		$this->db->select('user_id');
		$this->db->select('email');
		$this->db->from('user_details');
		$this->db->where('email', $emailID);
		$hDQuery = $this->db->get();
		$hash = NULL;
		$hashSaved = NULL;
		$userID = NULL;
		$hashGenerated = FALSE;
		$userExists = FALSE;
		log_message('INFO', "async_model/forgotPasswordHash(".$emailID.")");
		switch($hDQuery->num_rows() > 0)
		{
			case TRUE:$userExists = TRUE;
						$hData = $hDQuery->result();
						$hData = $hData[0];
						$userID = $hData->user_id;
						$hash = sha1("[{".md5("[{".$hData->user_id."}|{".$hData->email."}|{".time()."}]")."}]");
						$this->db->set('mpHash', $hash); // store a hash in the mpHash column
						$this->db->set('hashType', 1); // set the hashType as 1 which means it is to be used for forgotten passwords
						$this->db->set('hashValidity', time()+86400); // set the validity of the hash till the next 24 hours
						$this->db->where('user_id', $hData->user_id);
						$hashSaved = $this->db->update('user_details');
						$hashGenerated = TRUE; // expect the hash to be generated if execution reaches this point
					break;
			case FALSE: $hData = FALSE;
					break;
		}
		return array('userExists' => $userExists, 'hashGenerated' => $hashGenerated, 'hash' => $hash, 'hashSaved' => $hashSaved, 'userID' => $userID);
	}

	public function checkHash($hash)
	{
		$this->db->select('user_id');
		$this->db->from('user_details');
		$this->db->where('mpHash', $hash);
		$this->db->where('hashType', 1);
		$this->db->where('hashValidity >= '.time());
		$cHQuery = $this->db->get();
		switch($cHQuery->num_rows > 0)
		{
			case TRUE: $cHData = $cHQuery->result();
						$cHData = $cHData[0];
						return array("hashOK" => TRUE, "userID" => $cHData->user_id);
				break;
			case FALSE:return array("hashOK" => FALSE, "userID" => NULL);
				break;
		}
	}

	protected function deAuthorizeHash($userID)
	{
		$this->db->set('hashValidity', 0);
		$this->db->where('user_id', $userID);
		return $this->db->update('user_details');
	}

	public function setNewPassword($userID, $newPassword)
	{
		$this->db->set('password', md5($newPassword));
		$this->db->where('user_id', $userID);
		$result = $this->db->update('user_details');
		log_message('INFO', "async_model/setNewPassword just ran the query: ".$this->db->last_query());
		switch($result)
		{
			case TRUE:$this->deAuthorizeHash($userID);
				break;
		}
		return $result;
	}

	public function userCoupons($userID)
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
		$this->db->from('coupon');
		$this->db->where('user_id', $userID);
		$this->db->where('validFrom <= '.time());
		$this->db->where('validUpto >= '.time());
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

	public function createCoupon($couponDetails)
	{
		$isLoggedIN = $this->isLoggedIN();
		$result = NULL;
		if($isLoggedIN['status'] === TRUE && ($isLoggedIN['uid'] == 22 || $isLoggedIN['uid'] == 141 || $isLoggedIN['uid'] == 5124 || $isLoggedIN['uid'] == 4369 || $isLoggedIN['uid'] == 28))
		{
			$this->db->set('couponid', $couponDetails['couponid']);
			$this->db->set('percentoff', $couponDetails['couponValue']);
			$this->db->set('usecount', $couponDetails['couponsCount']);
			$this->db->set('discounttype', $couponDetails['couponType']);
			$this->db->set('validFrom', $couponDetails['validFrom']);
			$this->db->set('validUpto', $couponDetails['validUpto']);
			$this->db->set('minPurchaseAmount', $couponDetails['minPurchaseAmount']);
			$this->db->set('user_id', $couponDetails['userID']);
			$result = $this->db->insert('coupon');
			log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
			log_message('INFO', $this->db->last_query());
		}
		return $result;
	}

	public function createCouponPublic($couponDetails)
	{
		$result = NULL;
		$this->db->set('couponid', $couponDetails['couponid']);
		$this->db->set('percentoff', $couponDetails['couponValue']);
		$this->db->set('usecount', $couponDetails['couponsCount']);
		$this->db->set('discounttype', $couponDetails['couponType']);
		$this->db->set('validFrom', $couponDetails['validFrom']);
		$this->db->set('validUpto', $couponDetails['validUpto']);
		$this->db->set('minPurchaseAmount', $couponDetails['minPurchaseAmount']);
		$this->db->set('user_id', $couponDetails['userID']);
		$result = $this->db->insert('coupon');
		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		return $result;
	}

	public function createCouponPublic2($couponDetails)
	{
		log_message('INFO', "async_model/createCouponPublic2: someone from ".$this->input->ip_address().", userID = ".$this->session->userdata('id'));
		$result = NULL;
		log_message('INFO', "async_model/createCouponPublic2: Trying to create a coupon with the following details__\r\n".print_r($couponDetails, TRUE));
		$this->db->set('couponid', $couponDetails['couponid']);
		$this->db->set('percentoff', $couponDetails['couponValue']);
		$this->db->set('usecount', $couponDetails['couponsCount']);
		$this->db->set('discounttype', $couponDetails['couponType']);
		$this->db->set('validFrom', $couponDetails['validFrom']);
		$this->db->set('validUpto', $couponDetails['validUpto']);
		$this->db->set('minPurchaseAmount', $couponDetails['minPurchaseAmount']);
		$this->db->set('user_id', $couponDetails['userID']);

		$result = $this->db->insert('coupon');

		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		switch( $result === FALSE )
		{
			case TRUE:	log_message('INFO', "async_model/createCouponPublic2: Failed to create a coupon with the following details__\r\n".print_r($couponDetails, TRUE));
						$couponDetails['couponid'] .= 'A';
						log_message('INFO', "async_model/createCouponPublic2: Now trying to create a coupon with the following details__\r\n".print_r($couponDetails, TRUE));
						$this->db->set('couponid', $couponDetails['couponid']);
						$this->db->set('percentoff', $couponDetails['couponValue']);
						$this->db->set('usecount', $couponDetails['couponsCount']);
						$this->db->set('discounttype', $couponDetails['couponType']);
						$this->db->set('validFrom', $couponDetails['validFrom']);
						$this->db->set('validUpto', $couponDetails['validUpto']);
						$this->db->set('minPurchaseAmount', $couponDetails['minPurchaseAmount']);
						$this->db->set('user_id', $couponDetails['userID']);

						$result = $this->db->insert('coupon');
						log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
						log_message('INFO', $this->db->last_query());
				break;
		}
		return array('result' => $result, 'couponid' => $couponDetails['couponid']);
	}

	public function userBadges($uid)
	{
		$this->db->select('badge_type');
		$this->db->select('user_id');
		$this->db->select('badge_level');
		$this->db->select('notification_text');
		$this->db->select('notify_status');
		$this->db->from('badges');
		$this->db->where('user_id', $uid);
		$this->db->where('notify_status', 0);
		$result = $this->db->get();
		return $result->result();
	}

	public function userBadgesAll($uid)
	{
		$this->db->select('badge_type');
		$this->db->select('user_id');
		$this->db->select('badge_level');
		$this->db->select('notification_text');
		$this->db->select('notify_status');
		$this->db->from('badges');
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		return $result->result();
	}

	public function badges($userID)
	{
		/* ADDED BY SHAMMI FOR BADGES */
		include_once __DIR__.'/../controllers/badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		$this->load->model('badges');
		$badges = array();
		// Badges
		$userBadges = $this->userBadgesAll($userID);
		if (!empty($userBadges))
		{
			for ($i = 0; $i < count($userBadges); $i++)
			{
				if ($userBadges[$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText, 'bbucks' => $storeBadges[$badgeLevels]->bbucks, 'triggeredAt' => $storeBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text, 'bbucks' => $pollBadges[$badgeLevels]->bbucks, 'triggeredAt' => $pollBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText, 'bbucks' => $fancyStoreBadges[$badgeLevels]->bbucks, 'triggeredAt' => $fancyStoreBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText, 'bbucks' => $fancyBadges[$badgeLevels]->bbucks, 'triggeredAt' => $fancyBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText, 'bbucks' => $bragBadges[$badgeLevels]->bbucks, 'triggeredAt' => $bragBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $userBadges[$i]->badge_level; $badgeLevels++)
					{
						$temp = array('type' => $userBadges[$i]->badge_type, 'level' => $badgeLevels, 'img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText, 'bbucks' => $buyBadges[$badgeLevels]->bbucks, 'triggeredAt' => $buyBadges[$badgeLevels]->triggeredAt);
						array_push($badges, $temp);
					}
				}
				if ($userBadges[$i]->badge_type == 71)
				{
					$temp = array('type' => 71, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/71/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 72)
				{
					$temp = array('type' => 72, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/72/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 73)
				{
					$temp = array('type' => 73, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/73/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 74)
				{
					$temp = array('type' => 74, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/74/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 75)
				{
					$temp = array('type' => 75, 'level' => $userBadges[$i]->badge_level, 'img' => "fcat/75/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 8)
				{
					$temp = array('type' => 8, 'level' => $userBadges[$i]->badge_level, 'img' => "inv/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
				if ($userBadges[$i]->badge_type == 9)
				{
					$temp = array('type' => 9, 'level' => $userBadges[$i]->badge_level, 'img' => "acc/" . $userBadges[$i]->badge_level . ".png", 'txt' => $userBadges[$i]->notification_text);
					array_push($badges, $temp);
				}
			}
		}
		return $badges;
		//End of Badges
	}

	public function addFriend($selfUID, $toBefriendUID)
	{
		$this->db->set('f_type', 1);
		$this->db->where('followee_id = ' . $selfUID);
		$this->db->where('follower_id = ' . $toBefriendUID);
		$result = $this->db->update('follow_friends');
		return $result;
	}

	public function removeFriend($selfUID, $toUnfriend)
	{
		//for unfriending/unfollowing if self had started following visitor first before becoming friends.
		$this->db->where('follower_id = ' . $selfUID);
		$this->db->where('followee_id = ' . $toUnfriend);
		$this->db->where('f_type = 1');
		$result = $this->db->delete('follow_friends');
		return $result;
	}

	public function followFriend($selfUID, $toFollow)
	{
		$this->db->set('follower_id', $selfUID);
		$this->db->set('followee_id', $toFollow);
		return $this->db->insert('follow_friends');
	}

	public function userDetails($userID) // used for logged-in user
	{
		$this->db->select('user_details.user_id AS ID');
		$this->db->select('fb_uid AS FBID');
		$this->db->select('full_name AS fullName');
		$this->db->select('gender AS gender');
		$this->db->select('email AS email');
		$this->db->select('bbucks AS bragBucks');
		$this->db->select('user_details.city AS userCity');
		$this->db->select('user_details.isActive');
		$this->db->select('user_details.joined_date AS userJoinedDate');
		$this->db->select('user_details.country AS userCountry');
		$this->db->select('user_details.date_of_birth AS userDOB');
		$this->db->select('user_details.rFlowStatus');
		$this->db->select("DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(user_details.date_of_birth)), '%Y')+0 AS userAge", FALSE);
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$this->db->limit(1);
		$result = $this->db->get();
		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		log_message('INFO', 'number of rows returned: '.$result->num_rows());
		switch($result->num_rows() > 0)
		{
			case FALSE: log_message('ERROR', 'returning FALSE from async_model/userDetails');
					  return FALSE;
				break;
			case TRUE: log_message('INFO', 'Resultset returned: '.print_r($result->result(), TRUE));
					 return $result->result();
				break;
		}
	}

	public function storeURL()
	{
		/* fetch store URL */
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		return $myconfig['store_url'];
	}

	public function deleteCartItem($cartID)
	{
		$isLoggedIN = $this->isLoggedIN();
		switch($isLoggedIN['status'] === TRUE)
		{
			case TRUE:	$this->db->where('cart_id', $cartID);
						$this->db->where('user_id', $isLoggedIN['uid']);
						return $this->db->delete('cart');
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	public function headerData($userID = NULL)
	{
		$retData = array();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/headerData with userID: '.$userID);
		switch(is_null($userID))
		{
			case FALSE: log_message('INFO', 'trying to find rank of user '.$userID);
					  $this->db->select('userRank, fancy_counter');
					  $this->db->from('user_details');
					  $this->db->where('user_id', $userID);
					  $this->db->limit(1);
					  $rankQuery = $this->db->get();
					  log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
					  log_message('INFO', $this->db->last_query());
					  log_message('INFO', 'number of rows returned: '.$rankQuery->num_rows());
					  log_message('INFO', 'Resultset returned: '.print_r($rankQuery->result(), TRUE));
					  switch($rankQuery->num_rows() > 0)
					  {
					  	case FALSE: $retData['rank'] = FALSE;
					  			log_message('INFO', 'rank of user '.$userID.' is NULL');
					  		break;
					  	case TRUE: $rankQueryData = $rankQuery->result();
					  			log_message('INFO', 'rank of user '.$userID.' is '.$rankQueryData[0]->userRank);
					  			$retData['rank'] = $rankQueryData[0]->userRank;
					  			$retData['fancyCount'] = $rankQueryData[0]->fancy_counter;
					  		break;
					  }
					  $tNewRank = $this->newRank( $userID );
					  switch($tNewRank === FALSE)
					  {
						case FALSE: $retData['oldRank'] = $retData['rank'];
								  $retData['tNewRank'] = $tNewRank;
							break;
					  }
					  //$retData['rank'] = $this->buynbragRank($userID);
					  /* fetching fancyCount of the user */
					  log_message('INFO', 'trying to find number of products fancied by the user '.$userID);
					  $this->db->select('COUNT(fancy_list_id) AS fancyListCount');
					  $this->db->from('fancy_list');
					  $this->db->where('user_id', $userID);
					  $this->db->limit(1);
					  $fancyQuery = $this->db->get();
					  log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
					  log_message('INFO', $this->db->last_query());
					  log_message('INFO', 'number of rows returned: '.$fancyQuery->num_rows());
					  log_message('INFO', 'Resultset returned: '.print_r($fancyQuery->result(), TRUE));
					  switch($fancyQuery->num_rows() > 0)
					  {
					  	case FALSE: $retData['fancyListCount'] = FALSE;
					  			log_message('INFO', 'fancy count for user '.$userID.' is NULL');
					  		break;
					  	case TRUE: $fancyQueryData = $fancyQuery->result();
					  			log_message('INFO', 'fancy count of user '.$userID.' is '.$fancyQueryData[0]->fancyListCount);
					  			$retData['fancyListCount'] = $fancyQueryData[0]->fancyListCount;
					  		break;
					  }

					 /* fetching cart data for the user */
					 log_message('INFO', 'trying to find products in cart of user '.$userID);
					 $this->db->select('cart.product_id AS productID');
					 $this->db->select('products.product_name AS productName');
					 $this->db->from('cart');
					 $this->db->join('products', 'cart.product_id = products.product_id');
					 $this->db->join('store_info', 'cart.store_id = store_info.store_id');
					 $this->db->where('cart.user_id', $userID);
					 $this->db->where('store_info.isPublished', 1);
					 $this->db->where('products.status', 1);
					 $this->db->where('products.is_enable', 0);
					 $this->db->where('products.quantity >= cart.cart_quantity');
					 $cartQuery = $this->db->get();
					 log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
					 log_message('INFO', $this->db->last_query());
					 log_message('INFO', 'number of rows returned: '.$cartQuery->num_rows());
					 log_message('INFO', 'Resultset returned: '.print_r($cartQuery->result(), TRUE));

					 $retData['cartCount'] = $cartQuery->num_rows();
					 log_message('INFO', 'number of items in the cart of user '.$userID.' is '.$retData['cartCount'] );

					 /* counting poll_items */
					 // log_message('INFO', 'trying to find number of poll products for user '.$userID);
					 // $this->db->select('COUNT(polls.poll_id) AS pollCount');
					 // $this->db->from('polls');
					 // $this->db->join('polls_shared', 'polls.poll_id=polls_shared.poll_id');
					 // $this->db->join('user_details', 'polls.user_id=user_details.user_id');
					 // $this->db->where('friend_id', $userID);
					 // $this->db->where('voted_on = 0');
					 // $this->db->where('poll_close_date > current_timestamp');
					 // $this->db->order_by('poll_close_date', 'DESC');
					 // $pollCountQuery = $this->db->get();
					 // log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
					 // log_message('INFO', $this->db->last_query());
					 // log_message('INFO', 'number of rows returned: '.$pollCountQuery->num_rows());
					 // log_message('INFO', 'Resultset returned: '.print_r($pollCountQuery->result(), TRUE));
					 // switch($pollCountQuery->num_rows() > 0)
					 // {
					 // 	case FALSE: $retData['pollCount'] = 0;
					 // 			log_message('INFO', 'number of poll items for user '.$userID.' is 0');
					 // 		break;
					 // 	case TRUE:  $pollCountData = $pollCountQuery->result();
						// 		  $retData['pollCount'] = $pollCountData[0]->pollCount;
					 // 			log_message('INFO', 'total poll items in users\' poll list = '.$userID.' is '.$retData['pollCount']);
					 // 		break;
					 // }
					 /* counting user's orders */
					 // log_message('INFO', 'trying to find total number of orders for user '.$userID);
					 // $this->db->select('COUNT(orders.order_id) AS totalOrders');
					 // $this->db->from('orders');
					 // $this->db->where('user_id', $userID);
					 // $this->db->where('status_order', 1);
					 // $this->db->where('status_order', 2);
					 // $this->db->where('status_order', 3);
					 // $ordersCountQuery = $this->db->get();
					 // log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
					 // log_message('INFO', $this->db->last_query());
					 // log_message('INFO', 'number of rows returned: '.$ordersCountQuery->num_rows());
					 // log_message('INFO', 'Resultset returned: '.print_r($ordersCountQuery->result(), TRUE));
					 // switch($ordersCountQuery->num_rows() > 0)
					 // {
					 // 	case FALSE: $retData['totalOrders'] = 0;
					 // 			log_message('INFO', 'total number of orders for user '.$userID.' is 0');
					 // 		break;
					 // 	case TRUE: $ordersCountData = $ordersCountQuery->result();
						// 		 $retData['totalOrders'] = $ordersCountData[0]->totalOrders;
					 // 			log_message('INFO', 'total poll items in user '.$userID.'\'s poll list = '.$retData['totalOrders']);
					 // 		break;
					 // }
					 /* counting users' badges */
					 $this->db->select('SUM(badge_level) AS totalBadges');
					 $this->db->from('badges');
					 $this->db->where('user_id', $userID);
					 $userBadgesQuery = $this->db->get();
					 log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
					 log_message('INFO', $this->db->last_query());
					 log_message('INFO', 'number of rows returned: '.$userBadgesQuery->num_rows());
					 log_message('INFO', 'Resultset returned: '.print_r($userBadgesQuery->result(), TRUE));
					 switch($userBadgesQuery->num_rows() > 0)
					 {
					 	case FALSE: $retData['totalBadges'] = 0;
					 			log_message('INFO', 'total number of badges for user '.$userID.' is 0');
					 		break;
					 	case TRUE: $userBadgesData = $userBadgesQuery->result();
								 $retData['totalBadges'] = $userBadgesData[0]->totalBadges;
					 			log_message('INFO', 'total number of badges accquired by user '.$userID.' is '.$retData['totalBadges']);
					 		break;
					 }
				break;
			case TRUE: $retData['rank'] = NULL;
					 $retData['fancyCount'] = NULL;
					 $retData['cartCount'] = NULL;
					 $retData['cartData'] = NULL;
					 $retData['pollCount'] = NULL;
					 $retData['totalOrders'] = NULL;
					 $retData['totalBadges'] = NULL;
					 $retData['fancyListCount'] = NULL;
		}
		/* fetch store URL */
		$retData['storeURL'] = $this->storeURL();
		$retData['baseURL'] = base_url();
		log_message('INFO', 'headerData being returned___________________________________________________________________________________________________________ '.print_r($retData, TRUE));
		return $retData;
	}

	public function cartData($userID = NULL)
	{
		$retData = array();
		$retData['canPurchase'] = FALSE;

		$retData['productsVariants'] = FALSE;
		$retData['cartCount'] = FALSE;

		switch(is_null($userID))
		{
			case FALSE:
						$q1SQL = "SELECT `canPurchase` FROM `user_details` WHERE `user_id` = ".$userID;
						$q1 = $this->db->query( $q1SQL );
						switch( $q1->num_rows() > 0 )
						{
							case TRUE:	$r1 = $q1->result();
										$r1 = $r1[0]->canPurchase;
										switch( $r1 == 1 )
										{
											case FALSE:	return $retData;
												break;
											case TRUE:	$retData['canPurchase'] = TRUE;
												break;
										}
								break;
							case FALSE:	return $retData;
								break;
						}

					 /* fetching cart data for the user */
					 $q2SQL = "SELECT `cart`.`product_id` AS `productID`, `cart`.`cart_id` AS `cartID`, `cart`.`store_id` AS `storeID`, `cart`.`cart_quantity` AS `quantity`,";
					 $q2SQL .= " `vsize`, `vcolor`,";
					 $q2SQL .= " `products`.`product_name` AS `productName`, `products`.`is_on_discount` AS `isOnDiscount`, `products`.`selling_price` AS `originalPrice`,";
					 $q2SQL .= " `products`.`processing_time` AS `processingTime`, `products`.`discount` AS `discountAmount`, `products`.`quantity` AS `availableQuantity`,";
					 $q2SQL .= " `store_info`.`store_name` AS `storeName`, `store_info`.`return_policy` AS `storeReturnPolicy`, `store_info`.`EMI_policy` AS `storeEMIPolicy`,";
					 $q2SQL .= " `store_info`.`COD_policy` AS `storeCODPolicy` FROM `cart`";
					 $q2SQL	.= " JOIN `products` ON `cart`.`product_id` = `products`.`product_id` JOIN `store_info` ON `cart`.`store_id` = `store_info`.`store_id`";
					 $q2SQL .= " WHERE `user_id` = ". $userID." AND `products`.`quantity` > 0 AND `store_info`.`isPublished` = 1 AND `products`.`status` = 1 AND `products`.`is_enable` = 0";
					 $cartQuery = $this->db->query($q2SQL);

					 $retData['cartCount'] = $cartQuery->num_rows();

					 switch( $retData['cartCount'] > 0 )
					 {
					 	case FALSE: $retData['cartCount'] = 0;
					 		break;
					 	case TRUE:
					 			//Store cart data in $cartData
					 			$cartData = $cartQuery->result();

					 			//Store products IDs of products in user's cart
					 			$cartProducts = array();

					 			foreach($cartData as $item)
					 			{
					 				$cartProducts[] = $item->productID;
					 			}

					 			//Fetch all variants of products in user's cart
					 			$q3SQL = "SELECT `product_id` AS `productID`, `variant_name` AS `variantName`, `variants_types` AS `variantTypes`, `quantity` AS `variantQuantity`,";
					 			$q3SQL .= " `size` AS `variantSize`, `color` AS `variantColor`";
					 			$q3SQL .= " FROM `variant` WHERE `product_id` IN( ".implode(",", $cartProducts)." )";
								$variants = $this->db->query( $q3SQL );

								$retData['productsVariants'] = $variants->num_rows > 0 ? $variants->result() : NULL;

					 			$retData['cartData'] = $cartData;
					 		break;
					 }
				break;
			case TRUE:
					 $retData['cartData'] = NULL;

		}
		/* fetch store URL */
		return $retData;
	}

	public function catsData()
	{
		/* fetch all categories data */
		/* resolving all data using DB right now */
		/*
			select
			c1.category_id AS catID,
			c1.category_name AS catName,
			c1.parent_catagory_id AS parentID,
			c2.category_id AS subCatID,
			c2.category_name AS subCatName,
			c2.parent_catagory_id AS subCatParentID,
			c3.category_id AS subSubCatID,
			c3.category_name AS subSubCatName,
			c3.parent_catagory_id AS subSubCatParentID,
			c4.category_id AS subSubCatID,
			c4.category_name AS subSubCatName,
			c4.parent_catagory_id AS subSubCatParentID,

			IMPORTANT: PLEASE NOTE THAT THE FOLLOWING SECTION HAS NOT BEEN ADDED TO THE QUERY BUT WILL BE REQUIRED WHEN 5th-level-CATEGORIZATION is started.
					 Right now, it won't be needed. Also, when this is enabled, all other categories must have 4th-level-categorization

			{
				c5.category_id AS subSubSubCatID,
				c5.category_name AS subSubSubCatName,
				c5.parent_catagory_id AS subSubSubCatParentID
			}

			from catagories c1
			join catagories c2 on c1.parent_catagory_id = c2.category_id
			join catagories c3 on c2.parent_catagory_id = c3.category_id
			join catagories c4 on c3.parent_catagory_id = c4.category_id
			order by c4.category_name;

			IMPORTANT: PLEASE NOTE THAT THE FOLLOWING LINE HAS NOT BEEN ADDED TO THE QUERY BUT WILL BE REQUIRED WHEN 5th-level-CATEGORIZATION is started.
					 Right now, it won't be needed. Also, when this is enabled, all other categories must have 4th-level-categorization
			join catagories c5 on c4.parent_catagory_id = c5.category_id
		*/
		/*$this->db->cache_on(); //  start DB CACHING*/
		//$this->db->start_cache(); // Start Active Record DB caching
		$this->db->select('c1.category_id AS catID');
		$this->db->select('c1.category_name AS catName');
		$this->db->select('c1.parent_catagory_id AS parentCatID');

		$this->db->select('c2.category_id AS subCatID');
		$this->db->select('c2.category_name AS subCatName');
		$this->db->select('c2.parent_catagory_id AS subCatParentID');

		$this->db->select('c3.category_id AS subSubCatID');
		$this->db->select('c3.category_name AS subSubCatName');
		$this->db->select('c3.parent_catagory_id AS subSubCatParentID');

		$this->db->select('c4.category_id AS subSubSubCatID');
		$this->db->select('c4.category_name AS subSubSubCatName');
		$this->db->select('c4.parent_catagory_id AS subSubSubCatParentID');
		//$this->db->stop_cache(); // Stop Active Record DB caching
		$this->db->from('catagories c1');

		$this->db->join('catagories c2', 'c1.parent_catagory_id = c2.category_id');
		$this->db->join('catagories c3', 'c2.parent_catagory_id = c3.category_id');
		$this->db->join('catagories c4', 'c3.parent_catagory_id = c4.category_id');

		$this->db->order_by('c4.category_name');

		$catQuery = $this->db->get();
		/*$this->db->cache_off(); // END DB CACHING*/
		//$this->db->stop_cache(); // Stop Active Record DB caching
		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		log_message('INFO', 'number of rows returned: '.$catQuery->num_rows());
		log_message('INFO', 'Resultset returned: '.print_r($catQuery->result(), TRUE));
		switch($catQuery->num_rows() > 0)
		{
			case FALSE: log_message('INFO', 'no category data was returned by the DB');
					  $catData = FALSE;
				break;
			case TRUE: $catData = $catQuery->result();
					 log_message('INFO', 'category data has been read from the DB');
				break;
		}
		return $catData;
	}

	public function catsData2()
	{
		$__ip = $this->input->ip_address();
		/* fetch all categories data */
		log_message('INFO', $__ip." async_model/catsData2 fired");
		$q1SQL = "SELECT COUNT(`products`.`product_id`) AS `totalProducts`, `catagories`.`category_id` AS `catID`,";
		$q1SQL .= " `catagories`.`category_name` AS `catName`, `catagories`.`parent_catagory_id` AS `parentCatID`";
		$q1SQL .= " FROM `catagories`";
		$q1SQL .= " JOIN `products` ON `catagories`.`category_id` IN (`products`.`cat_id`, `products`.`sub_catid1`, `products`.`sub_catid2`, `products`.`sub_catid3`)";
		$q1SQL .= " WHERE `catagories`.`status` = 1 AND `products`.`status` = 1 AND `products`.`is_enable` = 0";
		$q1SQL .= " GROUP BY `catagories`.`category_id`, `catagories`.`category_name`, `catagories`.`parent_catagory_id`";
		$q1SQL .= " ORDER BY `catagories`.`parent_catagory_id`, `catagories`.`sort_order` ASC";

		$catQuery = $this->db->query( $q1SQL );

		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		log_message('INFO', 'number of rows returned: '.$catQuery->num_rows());

		switch( $catQuery->num_rows() > 0)
		{
			case FALSE: log_message('INFO', 'no category data was returned by the DB');
					  $catData = FALSE;
				break;
			case TRUE: $catData = $catQuery->result();
					 log_message('INFO', 'category data has been read from the DB');
					 log_message('INFO', 'Resultset returned: '.print_r($catQuery->result(), TRUE));
				break;
		}
		return $catData;
	}

	public function catsData3()
	{
		/* fetch all categories data */
		/*$this->db->cache_on(); //  start DB CACHING*/
		//$this->db->start_cache(); // Start Active Record DB caching
		$this->db->select('category_id AS catID');
		$this->db->select('category_name AS catName');
		$this->db->select('parent_catagory_id AS parentCatID');
		//$this->db->stop_cache(); // Stop Active Record DB caching
		$this->db->select('(SELECT COUNT(DISTINCT(products.store_id)) FROM products WHERE cat_id = catID) AS totalProducts'); // is reporting total stores and not total products. totalProducts is being used ujust for compatibility sake
		$this->db->from('catagories');
		$this->db->where('parent_catagory_id', 0);
		$this->db->order_by('sort_order', 'asc');
		$catQuery = $this->db->get();
		/*$this->db->cache_off(); // END DB CACHING*/
		//$this->db->stop_cache(); // Stop Active Record DB caching
		log_message('INFO', 'JUST RAN THE FOLLOWING MYSQL QUERY__________________________________________________________________');
		log_message('INFO', $this->db->last_query());
		log_message('INFO', 'number of rows returned: '.$catQuery->num_rows());
		log_message('INFO', 'Resultset returned: '.print_r($catQuery->result(), TRUE));
		switch($catQuery->num_rows() > 0)
		{
			case FALSE: log_message('INFO', 'no category data was returned by the DB');
					  $catData = FALSE;
				break;
			case TRUE: $catData = $catQuery->result();
					 log_message('INFO', 'category data has been read from the DB');
				break;
		}
		return $catData;
	}

	public function lazyFanciedData3($startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		select
		distinct(f2.product_id) AS productID,
		f2.user_id AS userID,
		products.store_id AS storeID,
		products.fancy_counter AS productFancyCounter,
		products.is_on_discount AS productIsOnDiscount,
		products.selling_price AS productSellingPrice,
		products.discount AS productDiscount,
		products.product_name AS productName,
		products.visit_counter AS productVisitCounter,
		products.quantity AS productQuantity,
		products.bbucks AS bbucks,
		fancy_rank.rank AS userRank,
		user_details.username AS userName,
		user_details.full_name AS userFullName,
		user_details.fb_uid as userFBID,

		(SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
											OR
		(SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = f2.product_id)) AS hasFancied

		from fancy_products f2
		join products on f2.product_id=products.product_id
		join fancy_rank on fancy_rank.user_id=f2.user_id
		join user_details on f2.user_id=user_details.user_id
		group by products.product_id
		order by `time` desc;
		*
		* VERSION 1.1
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id\
		* order by `time` desc;
		*
		*
		* VERSION 2.0
		* ***********
		* SELECT
		* DISTINCT(products.product_id) AS productID,
		* products.lastFanciedBy AS userID,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* *************************   NEW   *************************
		* products.lFUBadgeType AS badgeType,
		* products.lFUBadgeLevel AS badgeLevel,
		* products.lFUBadgeNotificationText AS badgeNotificationText,
		* *************************   NEW ENDS   *************************
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = products.product_id)) AS hasFancied
		* from products
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on products.user_id = user_details.user_id
		* order by `lastFanciedAt` desc;
		*/
		$q1SQL = "SELECT DISTINCT(`products`.`product_id`) AS `productID`, `products`.`lastFanciedBy` AS `userID`, `products`.`store_id` AS `storeID`,";
        $q1SQL .= " `products`.`fancy_counter` AS `productFancyCounter`, `products`.`is_on_discount` AS `productIsOnDiscount`,";

		$q1SQL .= " `products`.`selling_price` AS `productSellingPrice`, `products`.`discount` AS `productDiscount`,";
        $q1SQL .= " `products`.`bbucks` AS `bbucks`, `products`.`product_name` AS `productName`, `products`.`visit_counter` AS `productVisitCounter`,";
        $q1SQL .= " `products`.`quantity` AS `productQuantity`,";
        $q1SQL .= " `products`.`lFUBadgeType` AS `badgeType`, `products`.`lFUBadgeLevel` AS `badgeLevel`, `products`.`lFUBadgeNotificationText` AS `badgeNotificationText`,";

		$q1SQL .= " `user_details`.`userRank` AS `userRank`,";
		//$q1SQL .= " `buynbrag_rank`.`rank` AS `userRank`,";
		$q1SQL .= " `user_details`.`username` AS `userName`, `user_details`.`full_name` AS `userFullName`, `user_details`.`fb_uid` as `userFBID`,";
		$q1SQL .= " `user_details`.`gender` AS `userGender`, ";

		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		/*log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
		log_message('INFO', 'reading user details from session for '.$__ip);*/
		$this->slog->write( array('level' => 1, 'msg' => 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3') );
		$this->slog->write( array('level' => 1, 'msg' => 'reading user details from session for '.$__ip) );

		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in

		/*log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');*/
		$this->slog->write( array('level' => 1, 'msg' => 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip) );
		$this->slog->write( array('level' => 1, 'msg' => 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE') );

		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');*/
					 $this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip) );
					 $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not') );
					 $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `fancy_products` f1 WHERE (`f1`.`user_id` = ".$userID." AND `f1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasFancied`,";
					 /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					 $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					 $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `brag_products` b1 WHERE (`b1`.`user_id` = ".$userID." AND `b1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasbragged`";
				break;
			case FALSE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');*/
					  $this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ') );
					  $this->slog->write( array('level' => 1, 'msg' => 'Will not try to check if the current user has fancied the products or not') );
					  $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `fancy_products` f1 WHERE (`f1`.`user_id` = '%' AND `f1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasFancied`,";
					  /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					  $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					  $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `brag_products` b1 WHERE (`b1`.`user_id` = '%' AND `b1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasbragged`";
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$q1SQL .= " FROM `products`";
		//$q1SQL .= " LEFT JOIN `fancy_rank` ON `f2`.`user_id`=`fancy_rank`.`user_id`";
        //$q1SQL .= " LEFT JOIN `buynbrag_rank` ON `buynbrag_rank`.`user_id`=`f2`.`user_id`";
		$q1SQL .= " LEFT JOIN `user_details` ON `products`.`lastFanciedBy`=`user_details`.`user_id`";
		$q1SQL .= " WHERE `products`.`status` = 1"; // pick products whose store is enabled
		$q1SQL .= " AND `products`.`is_enable` = 0"; // pick products which are enabled
		/*if($this->session->userdata('gender') !== FALSE)
		{
			$q1SQL .= " AND `user_details`.`gender` = '".$this->session->userdata('gender')."'";
		}*/
		$q1SQL .= " ORDER BY `lastFanciedAt` DESC";
		switch(is_null($startFrom))
		{
			case TRUE: $q1SQL .= " LIMIT 50"; // by default only pick 50 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $q1SQL .= " LIMIT 50 OFFSET ".($startFrom*50);
							break;
						case FALSE: $q1SQL .= " LIMIT ".$maxResults." OFFSET ".($maxResults*$startFrom);
							break;
					  }
				break;
		}
        log_message('DEBUG', "ABOUT TO EXECUTE THE QUERY__________\r\n".$q1SQL."\r\n");
		$stores_fancied = $this->db->query( $q1SQL );
		/*log_message('INFO', 'JUST RAN THE QUERY__________________________________________________________________'.$this->db->last_query());*/
		$this->slog->write( array('level' => 1, 'msg' => "JUST RAN THE QUERY________________________\r\n".$this->db->last_query() ) );
		return $stores_fancied->result();
	}

	public function lazyPopularData($startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id
		* order by (products.brag_counter+products.visit_counter+products.fancy_counter) desc;
		*/
		$this->db->select('distinct(products.product_id) AS productID');
		$this->db->select('products.lastFanciedBy AS userID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.bbucks AS bbucks');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		$this->db->select('products.lFUBadgeType AS badgeType');
		$this->db->select('products.lFUBadgeLevel AS badgeLevel');
		$this->db->select('products.lFUBadgeNotificationText AS badgeNotificationText');
		$this->db->select('(products.brag_counter+products.visit_counter+products.fancy_counter) AS pScore');
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(b1.product_id) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(b1.product_id) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$this->db->from('products');
		//$this->db->join('fancy_rank', 'products.lastFanciedBy=fancy_rank.user_id', 'left');
		//$this->db->join('buynbrag_rank', 'products.lastFanciedBy=buynbrag_rank.user_id', 'left');
		$this->db->join('user_details', 'products.lastFanciedBy=user_details.user_id', 'left');
		$this->db->where('products.status', 1); // pick products whose store is enabled
		$this->db->where('products.is_enable', 0); // pick products which are enabled
		$this->db->order_by('pScore', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(50); // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(50, $startFrom*50);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$popularProducts = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($popularProducts->num_rows() > 0)
		{
			case TRUE: return $popularProducts->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function lazyFavouriteData($startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		* VERSION 1.0
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id
		* where user_details.user_id = 22
		* order by (products.brag_counter+products.visit_counter+products.fancy_counter) desc;
		*/
		$this->db->select('distinct(f2.product_id) AS productID');
		$this->db->select('f2.user_id AS userID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.bbucks AS bbucks');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		$this->db->select('(SELECT badges.badge_type FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeType', FALSE);
		$this->db->select('(SELECT badges.badge_level FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeLevel', FALSE);
		$this->db->select('(SELECT badges.notification_text FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeNotificationText', FALSE);
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFavouriteData');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$this->db->from('fancy_products f2');
		$this->db->join('products', 'f2.product_id=products.product_id', 'left');
//		$this->db->join('fancy_rank', 'f2.user_id=fancy_rank.user_id', 'left');
		//$this->db->join('buynbrag_rank', 'buynbrag_rank.user_id=f2.user_id', 'left');
		$this->db->join('user_details', 'f2.user_id=user_details.user_id', 'left');
		$this->db->where('products.status', 1); // pick products whose store is enabled
		$this->db->where('products.is_enable', 0); // pick products which are enabled
		$this->db->where('user_details.user_id', 22); // only pick products that are fancied by PRT
//		$this->db->order_by('(products.brag_counter+products.visit_counter+products.fancy_counter)', 'desc');
		$this->db->order_by('time', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(50); // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(50, $startFrom*50);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$popularProducts = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($popularProducts->num_rows() > 0)
		{
			case TRUE: return $popularProducts->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

    public function lazyCityTrendsData($city1, $city2 = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		select
		distinct(f2.product_id) AS productID,
		f2.user_id AS userID,
		products.store_id AS storeID,
		products.fancy_counter AS productFancyCounter,
		products.is_on_discount AS productIsOnDiscount,
		products.selling_price AS productSellingPrice,
		products.discount AS productDiscount,
		products.product_name AS productName,
		products.visit_counter AS productVisitCounter,
		products.quantity AS productQuantity,
		products.bbucks AS bbucks,
		fancy_rank.rank AS userRank,
		user_details.username AS userName,
		user_details.full_name AS userFullName,
		user_details.fb_uid as userFBID,

		(SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
											OR
		(SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = f2.product_id)) AS hasFancied

		from fancy_products f2
		join products on f2.product_id=products.product_id
		join fancy_rank on fancy_rank.user_id=f2.user_id
		join user_details on f2.user_id=user_details.user_id
		group by products.product_id
		order by `time` desc;
		*
		* VERSION 1.1
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id\
		* order by `time` desc;
		*
		*
		* VERSION 2.0
		* ***********
		* SELECT
		* DISTINCT(products.product_id) AS productID,
		* products.lastFanciedBy AS userID,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* *************************   NEW   *************************
		* products.lFUBadgeType AS badgeType,
		* products.lFUBadgeLevel AS badgeLevel,
		* products.lFUBadgeNotificationText AS badgeNotificationText,
		* *************************   NEW ENDS   *************************
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = products.product_id)) AS hasFancied
		* from products
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on products.user_id = user_details.user_id\
		* order by `lastFanciedAt` desc;
		*/
		$q1SQL = "SELECT DISTINCT(`products`.`product_id`) AS `productID`, `products`.`lastFanciedBy` AS `userID`, `products`.`store_id` AS `storeID`,";
        $q1SQL .= " `products`.`fancy_counter` AS `productFancyCounter`, `products`.`is_on_discount` AS `productIsOnDiscount`,";

		$q1SQL .= " `products`.`selling_price` AS `productSellingPrice`, `products`.`discount` AS `productDiscount`,";
        $q1SQL .= " `products`.`bbucks` AS `bbucks`, `products`.`product_name` AS `productName`, `products`.`visit_counter` AS `productVisitCounter`,";
        $q1SQL .= " `products`.`quantity` AS `productQuantity`,";
        $q1SQL .= " `products`.`lFUBadgeType` AS `badgeType`, `products`.`lFUBadgeLevel` AS `badgeLevel`, `products`.`lFUBadgeNotificationText` AS `badgeNotificationText`,";

		$q1SQL .= " `user_details`.`userRank` AS `userRank`,";
		//$q1SQL .= " `buynbrag_rank`.`rank` AS `userRank`,";
		$q1SQL .= " `user_details`.`username` AS `userName`, `user_details`.`full_name` AS `userFullName`, `user_details`.`fb_uid` as `userFBID`,";
		$q1SQL .= " `user_details`.`gender` AS `userGender`, ";

		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		/*log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
		log_message('INFO', 'reading user details from session for '.$__ip);*/
		$this->slog->write( array('level' => 1, 'msg' => 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3') );
		$this->slog->write( array('level' => 1, 'msg' => 'reading user details from session for '.$__ip) );

		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in

		/*log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');*/
		$this->slog->write( array('level' => 1, 'msg' => 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip) );
		$this->slog->write( array('level' => 1, 'msg' => 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE') );

		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');*/
					 $this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip) );
					 $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not') );
					 $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `fancy_products` f1 WHERE (`f1`.`user_id` = ".$userID." AND `f1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasFancied`,";
					 /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					 $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					 $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `brag_products` b1 WHERE (`b1`.`user_id` = ".$userID." AND `b1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasbragged`";
				break;
			case FALSE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');*/
					  $this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ') );
					  $this->slog->write( array('level' => 1, 'msg' => 'Will not try to check if the current user has fancied the products or not') );
					  $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `fancy_products` f1 WHERE (`f1`.`user_id` = '%' AND `f1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasFancied`,";
					  /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					  $this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					  $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `brag_products` b1 WHERE (`b1`.`user_id` = '%' AND `b1`.`product_id` = `products`.`product_id`)), TRUE, FALSE)) AS `hasbragged`";
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$q1SQL .= " FROM `products`";
		//$q1SQL .= " LEFT JOIN `fancy_rank` ON `f2`.`user_id`=`fancy_rank`.`user_id`";
        //$q1SQL .= " LEFT JOIN `buynbrag_rank` ON `buynbrag_rank`.`user_id`=`f2`.`user_id`";
		$q1SQL .= " LEFT JOIN `user_details` ON `products`.`lastFanciedBy`=`user_details`.`user_id`";
		$q1SQL .= " WHERE `products`.`status` = 1"; // pick products whose store is enabled
		$q1SQL .= " AND `products`.`is_enable` = 0"; // pick products which are enabled
		/*if($this->session->userdata('gender') !== FALSE)
		{
			$q1SQL .= " AND `user_details`.`gender` = '".$this->session->userdata('gender')."'";
		}*/

		// only pick products fancied by users from specified region
        $q1SQL .= " AND user_details.city = '".$city1."'";
		if( $city2 !== NULL )
		{
			$q1SQL .= " OR user_details.city = '".$city2."'";
		}

		$q1SQL .= " ORDER BY products.added_on DESC";
		switch(is_null($startFrom))
		{
			case TRUE: $q1SQL .= " LIMIT 50"; // by default only pick 50 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $q1SQL .= " LIMIT 50 OFFSET ".($startFrom*50);
							break;
						case FALSE: $q1SQL .= " LIMIT ".$maxResults." OFFSET ".($maxResults*$startFrom);
							break;
					  }
				break;
		}
        log_message('DEBUG', "ABOUT TO EXECUTE THE QUERY__________\r\n".$q1SQL."\r\n");
		$stores_fancied = $this->db->query( $q1SQL );
		/*log_message('INFO', 'JUST RAN THE QUERY__________________________________________________________________'.$this->db->last_query());*/
		$this->slog->write( array('level' => 1, 'msg' => "JUST RAN THE QUERY________________________\r\n".$this->db->last_query() ) );
		return $stores_fancied->result();
	}

	public function lazyCityTrendsData__old($city1, $city2 = NULL, $startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id
		* order by (products.brag_counter+products.visit_counter+products.fancy_counter) desc;
		*/
		$q1SQL = "SELECT DISTINCT(`f2`.`product_id`) AS `productID`, `f2`.`user_id` AS `userID`, `products`.`store_id` AS `storeID`,";
        $q1SQL .= " `products`.`fancy_counter` AS `productFancyCounter`, `products`.`is_on_discount` AS `productIsOnDiscount`,";
		$q1SQL .= " `products`.`selling_price` AS `productSellingPrice`, `products`.`discount` AS `productDiscount`, `products`.`bbucks` AS `bbucks`,";
		$q1SQL .= " `products`.`product_name` AS `productName`, `products`.`visit_counter` AS `productVisitCounter`, `products`.`quantity` AS `productQuantity`,";
        //$q1SQL .= " `fancy_rank`.`rank` AS `userRank`, `buynbrag_rank`.`rank` AS `userRank`,";
		$q1SQL .= " `user_details`.`username` AS `userName`, `user_details`.`full_name` AS `userFullName`, `user_details`.`fb_uid` as `userFBID`,";
		$q1SQL .= " `user_details`.`gender` AS `userGender`,";
        $q1SQL .= " (SELECT `badges`.`badge_type` FROM `badges` WHERE `badge_type` = 4 AND `badges`.`user_id` = `f2`.`user_id`) AS `badgeType`,";
		$q1SQL .= " (SELECT `badges`.`badge_level` FROM `badges` WHERE `badge_type` = 4 AND `badges`.`user_id` = `f2`.`user_id`) AS `badgeLevel`,";
		$q1SQL .= " (SELECT `badges`.`notification_text` FROM `badges` WHERE `badge_type` = 4 AND `badges`.`user_id` = `f2`.`user_id`) AS `badgeNotificationText`,";
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('DEBUG', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
		log_message('DEBUG', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('DEBUG', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('DEBUG', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		$response = NULL;
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('DEBUG', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('DEBUG', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `fancy_products` f1 WHERE (`f1`.`user_id` = ".$userID." AND `f1`.`product_id` = `f2`.`product_id`)), TRUE, FALSE)) AS `hasFancied`,";
					 log_message('DEBUG', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `brag_products` b1 WHERE (`b1`.`user_id` = ".$userID." AND `b1`.`product_id` = `f2`.`product_id`)), TRUE, FALSE)) AS `hasbragged`";
				break;
			case FALSE: log_message('DEBUG', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('DEBUG', 'Will not try to check if the current user has fancied the products or not');
					  $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `fancy_products` f1 WHERE (`f1`.`user_id` = '%' AND `f1`.`product_id` = `f2`.`product_id`)), TRUE, FALSE)) AS `hasFancied`,";
					  log_message('DEBUG', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $q1SQL .= " (IF((SELECT COUNT(`product_id`) FROM `brag_products` b1 WHERE (`b1`.`user_id` = '%' AND `b1`.`product_id` = `f2`.`product_id`)), TRUE, FALSE)) AS `hasbragged`";
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$q1SQL .= " FROM fancy_products f2";
		$q1SQL .= " LEFT JOIN products ON f2.product_id=products.product_id";
        //$q1SQL .= " LEFT JOIN fancy_rank ON f2.user_id=fancy_rank.user_id";
		//$q1SQL .= " LEFT JOIN buynbrag_rank ON buynbrag_rank.user_id=f2.user_id";
		$q1SQL .= " LEFT JOIN user_details ON f2.user_id=user_details.user_id";
		$q1SQL .= " WHERE products.status = 1"; // pick products whose store is enabled
		$q1SQL .= " AND products.is_enable = 0"; // pick products which are enabled

		// only pick products fancied by users from specified region
        $q1SQL .= " AND user_details.city = '".$city1."'";
		if( $city2 !== NULL )
		{
			$whereText .= " OR user_details.city = '".$city2."'";
		}

		$q1SQL .= " ORDER BY products.added_on DESC";
		switch(is_null($startFrom))
		{
			case TRUE: $q1SQL .= " LIMIT 50"; // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $q1SQL .= " LIMIT 50 OFFSET ".($startFrom*50);
							break;
						case FALSE: $q1SQl .= " LIMIT ".$maxResults." OFFSET ".($maxResults*$startFrom);
							break;
					  }
				break;
		}
        log_message('DEBUG', "ABOUT TO RUN THE QUERY___________________\r\n".$q1SQL);
		$popularProducts = $this->db->query( $q1SQL );
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch( $popularProducts->num_rows() > 0 )
		{
			case TRUE: return $popularProducts->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function lazyPopularDataDelhi($startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id
		* order by (products.brag_counter+products.visit_counter+products.fancy_counter) desc;
		*/
		$this->db->select('distinct(f2.product_id) AS productID');
		$this->db->select('f2.user_id AS userID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.bbucks AS bbucks');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		$this->db->select('(SELECT badges.badge_type FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeType', FALSE);
		$this->db->select('(SELECT badges.badge_level FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeLevel', FALSE);
		$this->db->select('(SELECT badges.notification_text FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeNotificationText', FALSE);
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$this->db->from('fancy_products f2');
		$this->db->join('products', 'f2.product_id=products.product_id', 'left');
		//$this->db->join('fancy_rank', 'f2.user_id=fancy_rank.user_id', 'left');
		//$this->db->join('buynbrag_rank', 'buynbrag_rank.user_id=f2.user_id', 'left');
		$this->db->join('user_details', 'f2.user_id=user_details.user_id', 'left');
		$this->db->where('products.status', 1); // pick products whose store is enabled
		$this->db->where('products.is_enable', 0); // pick products which are enabled
		$this->db->where("user_details.city = 'Delhi' OR user_details.city = 'New Delhi'"); // only pick products fancied by users from delhi region
		$this->db->order_by('products.added_on', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(12); // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(12, $startFrom*12);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$popularProducts = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($popularProducts->num_rows() > 0)
		{
			case TRUE: return $popularProducts->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function lazyPopularDataMumbai($startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id
		* order by (products.brag_counter+products.visit_counter+products.fancy_counter) desc;
		*/
		$this->db->select('distinct(f2.product_id) AS productID');
		$this->db->select('f2.user_id AS userID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.bbucks AS bbucks');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		$this->db->select('(SELECT badges.badge_type FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeType', FALSE);
		$this->db->select('(SELECT badges.badge_level FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeLevel', FALSE);
		$this->db->select('(SELECT badges.notification_text FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeNotificationText', FALSE);
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$this->db->from('fancy_products f2');
		$this->db->join('products', 'f2.product_id=products.product_id', 'left');
		//$this->db->join('fancy_rank', 'f2.user_id=fancy_rank.user_id', 'left');
		//$this->db->join('buynbrag_rank', 'buynbrag_rank.user_id=f2.user_id', 'left');
		$this->db->join('user_details', 'f2.user_id=user_details.user_id', 'left');
		$this->db->where('products.status', 1); // pick products whose store is enabled
		$this->db->where('products.is_enable', 0); // pick products which are enabled
		$this->db->where("user_details.city = 'Mumbai' OR user_details.city = 'Bombay'"); // only pick products fancied by users from mumabi region
		$this->db->order_by('products.added_on', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(50); // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(50, $startFrom*50);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$popularProducts = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($popularProducts->num_rows() > 0)
		{
			case TRUE: return $popularProducts->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function lazyPopularDataKolkata($startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id
		* order by (products.brag_counter+products.visit_counter+products.fancy_counter) desc;
		*/
		$this->db->select('distinct(f2.product_id) AS productID');
		$this->db->select('f2.user_id AS userID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.bbucks AS bbucks');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		$this->db->select('(SELECT badges.badge_type FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeType', FALSE);
		$this->db->select('(SELECT badges.badge_level FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeLevel', FALSE);
		$this->db->select('(SELECT badges.notification_text FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeNotificationText', FALSE);
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$this->db->from('fancy_products f2');
		$this->db->join('products', 'f2.product_id=products.product_id', 'left');
		//$this->db->join('fancy_rank', 'f2.user_id=fancy_rank.user_id', 'left');
		//$this->db->join('buynbrag_rank', 'buynbrag_rank.user_id=f2.user_id', 'left');
		$this->db->join('user_details', 'f2.user_id=user_details.user_id', 'left');
		$this->db->where('products.status', 1); // pick products whose store is enabled
		$this->db->where('products.is_enable', 0); // pick products which are enabled
		$this->db->where("user_details.city = 'Kolkata' OR user_details.city = 'Calcutta'"); // only pick products fancied by users from calcutta region
		$this->db->order_by('products.added_on', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(50); // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(50, $startFrom*50);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$popularProducts = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($popularProducts->num_rows() > 0)
		{
			case TRUE: return $popularProducts->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function lazyPopularDataChennai($startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++==================================================
		 * VERSION 1.0
		* select
		* distinct(f2.product_id) AS productID,
		* f2.user_id AS userID,
		* f2.time,
		* products.store_id AS storeID,
		* products.fancy_counter AS productFancyCounter,
		* products.is_on_discount AS productIsOnDiscount,
		* products.selling_price AS productSellingPrice,
		* products.discount AS productDiscount,
		* products.product_name AS productName,
		* products.visit_counter AS productVisitCounter,
		* products.quantity AS productQuantity,
		* products.bbucks AS bbucks,
		* buynbrag_rank.rank AS userRank,
		* user_details.username AS userName,
		* user_details.full_name AS userFullName,
		* user_details.fb_uid as userFBID,
		* (SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = 1 AND f1.product_id = f2.product_id)) AS hasFancied
		* from fancy_products f2
		* left join products on f2.product_id=products.product_id
		* left join buynbrag_rank on buynbrag_rank.user_id=f2.user_id
		* left join user_details on f2.user_id=user_details.user_id
		* order by (products.brag_counter+products.visit_counter+products.fancy_counter) desc;
		*/
		$this->db->select('distinct(f2.product_id) AS productID');
		$this->db->select('f2.user_id AS userID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.bbucks AS bbucks');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		$this->db->select('(SELECT badges.badge_type FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeType', FALSE);
		$this->db->select('(SELECT badges.badge_level FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeLevel', FALSE);
		$this->db->select('(SELECT badges.notification_text FROM badges WHERE badge_type = 4 AND badges.user_id = f2.user_id) AS badgeNotificationText', FALSE);
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/lazyFanciedData3');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = f2.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = f2.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$this->db->from('fancy_products f2');
		$this->db->join('products', 'f2.product_id=products.product_id', 'left');
		//$this->db->join('fancy_rank', 'f2.user_id=fancy_rank.user_id', 'left');
		//$this->db->join('buynbrag_rank', 'buynbrag_rank.user_id=f2.user_id', 'left');
		$this->db->join('user_details', 'f2.user_id=user_details.user_id', 'left');
		$this->db->where('products.status', 1); // pick products whose store is enabled
		$this->db->where('products.is_enable', 0); // pick products which are enabled
		$this->db->where("user_details.city = 'Chennai' OR user_details.city = 'Madras' OR user_details.city = 'Banglore' OR user_details.city = 'Bengaluru' OR user_details.city = 'Bangalore'"); // only pick products fancied by users from chennai region
		$this->db->order_by('products.added_on', 'desc');
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(50); // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(50, $startFrom*50);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$popularProducts = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($popularProducts->num_rows() > 0)
		{
			case TRUE: return $popularProducts->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function storesMenuData()
	{
		$this->db->select('store_id');
		$this->db->select('store_name');
		$this->db->from('store_info');
		$this->db->where('store_info.isPublished', 1); // only pick stores which are enabled
		$this->db->order_by('store_name', 'asc');
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return FALSE;
				break;
		}
	}

	public function getStores($startFrom = NULL, $catID = NULL)
	{
		/* OLD ActiveRecord Query
		$this->db->select('DISTINCT(store_info.store_id)');
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.about_store');
		$this->db->select('store_info.contact_name');
		$this->db->select('store_info.storeowner_id');
		$this->db->select('store_info.fancy_counter');
		$this->db->select('store_info.visit_counter');
		$this->db->select('store_owner.owner_name');
		$this->db->select('products.cat_id AS catID');
		$this->db->select('(SELECT COUNT(p1.product_id) FROM products p1 WHERE p1.store_id = store_info.store_id) AS totalProducts');
		$this->db->select('(SELECT SUM(p2.fancy_counter) FROM products p2 WHERE p2.store_id = store_info.store_id) AS totalFancied');
		$this->db->select('(SELECT SUM(p3.visit_counter) FROM products p3 WHERE p3.store_id = store_info.store_id) AS storeVisitCounter');
		$this->db->from('store_info');
		$this->db->from('store_owner');
		$this->db->join('products', 'products.store_id = store_info.store_id');
		$whereText = 'store_owner.store_id = store_info.store_id and store_owner.storeowner_id = store_info.storeowner_id';
		$this->db->where($whereText);
		$this->db->where('store_info.isPublished', 1); // only pick stores which are enabled
		*/

		$q1SQL = "SELECT DISTINCT(`store_info`.`store_id`), `store_info`.`store_name`, `store_info`.`about_store`, `store_info`.`contact_name`,";
		$q1SQL .= " `store_info`.`storeowner_id`, `store_info`.`fancy_counter`, `store_info`.`visit_counter`, `store_owner`.`owner_name`, `products`.`cat_id` AS `catID`,";
		$q1SQL .= " COUNT(`products`.`product_id`) AS `totalProducts`, SUM(`products`.`fancy_counter`) AS `totalFancied`, SUM(`products`.`visit_counter`) AS `storeVisitCounter`";
		$q1SQL .= " FROM `store_info`, `store_owner`, `products`";
		$q1SQL .= " WHERE `products`.`store_id` = `store_info`.`store_id` AND `store_owner`.`store_id` = `store_info`.`store_id`";
		$q1SQL .= " AND `store_owner`.`storeowner_id` = `store_info`.`storeowner_id` AND `store_info`.`isPublished` = 1";

		switch(is_null($catID))
		{
			case FALSE: $q1SQL .= " AND `products`.`cat_id` = ".$catID;
				break;
		}

		$q1SQL .= " GROUP BY `store_info`.`store_id` ORDER BY `store_info`.`store_name`";

		switch ($startFrom)
		{
			case NULL:	$q1SQL .= " LIMIT 12 OFFSET 0";
				break;
			default:	$q1SQL .= " LIMIT 12 OFFSET ".( $startFrom * 12 );
		}

		log_message( 'DEBUG', "QUERY BEING RUN__\r\n".$q1SQL );

		$q1 = $this->db->query( $q1SQL );
		//print "<pre>".$this->db->last_query()."</pre>";
		switch ( $q1->num_rows() > 0 )
		{
			case FALSE:	return FALSE;
				break;
			case TRUE:	return $q1->result();
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

	public function uid2FBID($userID)
	{
		$this->db->select('fb_uid');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $tmpResult = $query->result();
					 return $tmpResult[0]->fb_uid;
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function isLoggedINViaFacebook()
	{
		log_message('INFO', 'async_model/isLoggedINViaFacebook: fb sdk test by shammi shailaj started');
		log_message('INFO', 'async_model/isLoggedINViaFacebook: current directory is: '.__DIR__);

		$sessionUserID = $this->session->userdata('id');
		log_message('INFO', 'async_model/isLoggedINViaFacebook: checking Session data for '.$sessionUserID.' from '.$this->input->ip_address());
		$sessionLoggedIN = $this->session->userdata('logged_in');

		$isReallyLoggedIN = ($sessionUserID !== FALSE && $sessionLoggedIN !== FALSE && is_numeric($sessionUserID) && $sessionUserID > 0 && $sessionLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in

		$fbAppIDLive = '394741787279624';
		$fbAppSecretLive = '48a073a1b1e78e2b35a88610bace7f92';

		$fbAppIDTest = '454156234672558';
		$fbAppSecretTest = '5ef93f05dc0b5fed519532751b379cd7';

		$fbAppID = $fbAppIDLive;
		$fbAppSecret = $fbAppSecretLive;

		$fbConfig = array('appId' => $fbAppID, 'secret' => $fbAppSecret);
		$this->load->library('facebook', $fbConfig);
		log_message('INFO', 'async_model/isLoggedINViaFacebook: reading CI fb config');
		//$this->config->load('facebook');
		//$fbConfig = $this->config->item('facebook');
		log_message('INFO', 'async_model/isLoggedINViaFacebook: FB-APP-ID: '.$fbAppID.', FB-APP-SECRET: '.$fbAppSecret);

		// Create our Application instance (replace this with your appId and secret).
		//$facebook = new Facebook(array('appId' => $fbAppID, 'secret' => $fbAppSecret));

		// Get User ID
		$data['user'] = $this->facebook->getUser();

		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.

		$bnbUID = NULL;
		$needsAccountLinking = FALSE;
		$needsNewAccount = FALSE;
        $userProfile = NULL;

		if($data['user'])
		{
			try
			{
				// Proceed knowing you have a logged in user who's authenticated.
				$userProfile = $this->facebook->api('/me');
				log_message('INFO', 'async_model/isLoggedINViaFacebook: Someone is probably logged-in');
				log_message('INFO', 'async_model/isLoggedINViaFacebook: user_profile = '.print_r($userProfile, TRUE));
				log_message('INFO', 'async_model/isLoggedINViaFacebook: loading the fb_model');
				$this->load->model("fb_model");
				log_message('INFO', "async_model/isLoggedINViaFacebook: cheking if the user already exists");
				$userExists = $this->fb_model->user_exists($userProfile["id"], $userProfile["email"]);
				switch($userExists)
				{
					case 1: // existing bnb member. directly log-them-in
						  $bnbUID = $this->fb_model->uid($userProfile["id"]); //  get the bnb user id
						  $bnbUID = $bnbUID[0]->user_id;
						  $bnbUID = ($isReallyLoggedIN === TRUE && $bnbUID != $sessionUserID)? $sessionUserID: $bnbUID;
						  log_message('INFO', 'async_model/isLoggedINViaFacebook: fb credentials are fine and the user has already linked their profiles');
						  log_message('INFO', 'async_model/isLoggedINViaFacebook: sessionUserID = '.print_r($sessionUserID, TRUE).", sessionLoggedIN = ".print_r($sessionLoggedIN, TRUE));
						break;
					case 2: // another bnb member with same email address exists
						  // link their profiles
						  log_message('INFO', 'async_model/isLoggedINViaFacebook: another bnb member with same email address exists. This member needs to link their facebook acount');
						  $needsAccountLinking = TRUE;
						break;
					case 0: // new member. create their profile
						   log_message('INFO', 'async_model/isLoggedINViaFacebook: first time user. they need to create a new account');
						   $needsNewAccount = TRUE;
						break;
				}
				return array("isLoggedIN" => $isReallyLoggedIN, "isLoggedINViaFacebook" => TRUE, "fbID" => $userProfile["id"], "id" => $bnbUID, "needsAccountLinking" => $needsAccountLinking, "needsNewAccount" => $needsNewAccount);
			}
			catch (FacebookApiException $e)
			{
				log_message('INFO', 'async_model/isLoggedINViaFacebook: FACEBOOKAPIEXCEPTION OCCURRED');
				log_message('INFO', 'async_model/isLoggedINViaFacebook: no-one is logged-in');
				error_log($e->getType());
				error_log($e->getMessage());
				error_log($e);
				$data['user'] = NULL;
				return array("isLoggedIN" => $isReallyLoggedIN, "isLoggedINViaFacebook" => FALSE, "fbID" => $userProfile["id"], "id" => $sessionUserID, "needsAccountLinking" => $needsAccountLinking, "needsNewAccount" => $needsNewAccount);
			}
		}
		else
		{
			return array("isLoggedIN" => $isReallyLoggedIN, "isLoggedINViaFacebook" => FALSE, "fbID" => NULL, "id" => $sessionUserID, "needsAccountLinking" => $needsAccountLinking, "needsNewAccount" => $needsNewAccount);
		}
	}

	public function currentPageURL()
	{
		// for the full URL of the current page
		$ci=& get_instance();
		$fullURL = $ci->config->site_url().$ci->uri->uri_string();
		if(count($_GET) > 0)
		{
			$get =  array();
			foreach($_GET as $key => $val)
			{
				$get[] = $key.'='.$val;
			}
			$fullURL .= '?'.implode('&',$get);
		}
		return $fullURL;
	}

	public function newRank($uid = NULL)
	{
		/*
		QUERY BEING USED==================================================
		select
		distinct(fancy_products.product_id),
		products.fancy_counter
		from
		fancy_products
		join products on products.product_id = fancy_products.product_id
		where
		user_id = 141
		order by fancy_counter desc;
		*/
		$rank = 0;
		if(is_null($uid))
		{
			return FALSE;
		}
		$this->db->select('DISTINCT(fancy_products.product_id)');
		$this->db->select('products.fancy_counter');
		$this->db->from('fancy_products');
		$this->db->join('products', 'products.product_id = fancy_products.product_id');
		$this->db->where('fancy_products.user_id', $uid);
		$this->db->order_by('fancy_counter', 'desc');
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: $b = $query->result();
					 $a = count($b);
					 $prank = 0;
					 foreach($b as $bElement)
					 {
						$prank += $bElement->fancy_counter;
					 }
					 $rank += $prank;
					 /*
					 QUERY BEING USED==================================================
					 SELECT
					 badge_type,
					 badge_level
					 FROM
					 badges
					 WHERE
					 user_id = 141;
					 */
					 $this->db->select('badge_type');
					 $this->db->select('badge_level');
					 $this->db->from('badges');
					 $this->db->where('user_id', $uid);
					 $query2 = $this->db->get();
					 $c = 0;
					 switch($query2->num_rows() > 0)
					 {
						case FALSE: $c += 0;
							break;
						case TRUE: $cData = $query2->result();
								 foreach($cData as $cDataItem)
								 {
									switch($cDataItem->badge_type)
									{
										case 1: $c += $cDataItem->badge_level * 10;
											break;
										case 2: $c += $cDataItem->badge_level * 15;
											break;
										case 3: $c += $cDataItem->badge_level * 25;
											break;
										case 4: $c += $cDataItem->badge_level * 20;
											break;
										case 5: $c += $cDataItem->badge_level * 30;
											break;
										case 6: $c += $cDataItem->badge_level * 50;
											break;
										case 8: $c += $cDataItem->badge_level * 50;
											break;
										case 9: $c += $cDataItem->badge_level * 50;
											break;
									}
								 }
							break;
					 }
					 $rank += $c;
					 $rank /= $a;
				break;
		}
		return $rank;
	}

	public function saveBuynbragRank($userID = NULL)
	{
		if($userID !== NULL)
		{
			$rankScore = $this->newRank($userID); // compute the new rank
			if($rankScore === FALSE) // if we can not compute the rank
			{
				$rankScore = ($userID - ($userID*$userID)); // use the negated value of the userID as rankScore i.e., -4321 for user id 4321
			}
			$this->db->select('user_id'); // find if a rank score entry exists for the current user
			$this->db->from('buynbrag_rankScore');
			$this->db->where('user_id', $userID);
			$query = $this->db->get();
			$updateFlag = ($query->num_rows() > 0);
			$this->db->set('score', $rankScore);
			switch($updateFlag)
			{
				case TRUE:$this->db->where('user_id', $userID);
						return $this->db->update('buynbrag_rankScore');
					break;
				case FALSE:$this->db->set('user_id', $userID);
						return $this->db->insert('buynbrag_rankScore');
					break;
			}
		}
		else
		{
			return NULL;
		}
	}

	public function buynbragRank($userID)
	{
		$this->db->select('rank');
		$this->db->from('buynbrag_rank');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $rankData = $query->result();
						return $rankData[0]->rank;
				break;
			case FALSE: return $userID;
				break;
		}
	}

	public function storeSections($storeID)
	{
		/* Update store visit_counter */
		$this->db->set('visit_counter', 'visit_counter+1', FALSE);
		$this->db->where('store_id', $storeID);
		$query2 = $this->db->update('store_info');
		/* END SECTION Update store visit_counter */
		$retVal = array();
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.about_store');
		$this->db->select('store_info.return_policy');
		$this->db->select('store_info.EMI_policy');
		$this->db->select('store_info.COD_policy');
		$this->db->select('store_info.fancy_counter AS storeFancyCounter');
		$this->db->select('store_info.visit_counter AS storeVisitCounterOld');
		$this->db->select('store_info.brag_counter AS storeBragCounter');
		$this->db->select('(store_info.fancy_counter + store_info.visit_counter + (SELECT COUNT(order_id) AS storeSales FROM orders WHERE orders.store_id = store_info.store_id)) AS storeScore');
		$this->db->select('(SELECT COUNT(p1.product_id) FROM products p1 WHERE p1.store_id = store_info.store_id) AS totalProducts');
		$this->db->select('(SELECT SUM(p2.fancy_counter) FROM products p2 WHERE p2.store_id = store_info.store_id) AS totalFancied');
		$this->db->select('(SELECT SUM(p3.visit_counter) FROM products p3 WHERE p3.store_id = store_info.store_id) AS storeVisitCounter');

		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeSections');
		log_message('INFO', 'reading user details from session for '.$__ip);
		$userID = NULL;
		$isLoggedIN = NULL;
		$userID = $this->session->userdata('id'); // read the user id from session
		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in
		log_message('INFO', 'userID  = '.$userID.' isLoggedIN = '.$isLoggedIN.' ipAddress = '.$__ip);
		log_message('INFO', 'Trying to determine whether the user is really logged in. For this to happen, the session data must contain a valid userID and the value of logged_in must be boolean TRUE');
		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		switch($isReallyLoggedIN)
		{
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = ".$userID." AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current store in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = ".$userID." AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the stores or not');
					  $this->db->select("(IF((SELECT COUNT(fs1.store_id) FROM fancy_store fs1 WHERE (fs1.user_id = '%' AND fs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasFanciedStore", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(bs1.store_id) FROM brag_store bs1 WHERE (bs1.user_id = '%' AND bs1.store_id = store_info.store_id)), TRUE, FALSE)) AS hasBraggedStore", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED THE STORE OR NOT ====================================================== */
		$this->db->from('store_info');
		$this->db->where('store_info.store_id', $storeID);
		$this->db->where('store_info.isPublished', 1); // only pick stores which are enabled
		$query1 = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query1->num_rows() > 0)
		{
			case TRUE: $retVal["storeInfo"] = $query1->result();
				break;
			case FALSE: $retVal["storeInfo"] = NULL;
				break;
		}

		$q2SQL = "SELECT  `store_section`.`totalProducts`, `store_section`.`store_id` AS `storeID`";
		$q2SQL .= ", `store_section`.`storesection_id` AS storeSectionID";
		$q2SQL .= ", `store_section`.`name` AS `storeSectionName`, `store_section`.`is_on_discount` AS `isOnDiscount`";
		$q2SQL .= ", `store_section`.`promotion_id` AS `promotionID`";
		$q2SQL .= " FROM `store_section`";
		$q2SQL .= " JOIN `store_info` ON `store_section`.`store_id` = `store_info`.`store_id`";
		$q2SQL .= " JOIN `products` ON `store_section`.`storesection_id`=`products`.`storesection_id`";
		$q2SQL .= " WHERE `store_section`.`store_id` =  ".$storeID;
		$q2SQL .= " AND `products`.`status` =  1 AND `products`.`is_enable` =  0 AND `store_info`.`isPublished` =  1";
		$q2SQL .= " GROUP BY `store_section`.`store_id`, `store_section`.`storesection_id`";

		$query2 = $this->db->query( $q2SQL );
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$q2SQL);
		switch($query2->num_rows() > 0)
		{
			case TRUE: $retVal["storeSections"] =  $query2->result();
				break;
			case FALSE: $retVal["storeSections"] =  NULL;
				break;
		}

		$this->db->select('user_id');
		$this->db->from('fancy_store');

		$this->db->where('store_id', $storeID);

		$this->db->limit(5);

		$query3 = $this->db->get();

		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query3->num_rows() > 0)
		{
			case TRUE: $retVal["lastFanciedBy"] =  $query3->result();
				break;
			case FALSE: $retVal["lastFanciedBy"] =  NULL;
				break;
		}

		return $retVal;
	}

	public function storeSectionsUnpublished($storeID)
	{
		$retVal = array();
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.about_store');
		$this->db->select('store_info.return_policy');
		$this->db->select('store_info.EMI_policy');
		$this->db->select('store_info.COD_policy');
		$this->db->select('store_info.fancy_counter AS storeFancyCounter');
		$this->db->select('store_info.visit_counter AS storeVisitCounter');
		$this->db->select('store_info.brag_counter AS storeBragCounter');
		$this->db->from('store_info');
		$this->db->where('store_info.store_id', $storeID);
		$this->db->where('store_info.isPublished', 0); // only pick stores which are enabled
		$query1 = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query1->num_rows() > 0)
		{
			case TRUE: $retVal["storeInfo"] = $query1->result();
				break;
			case FALSE: $retVal["storeInfo"] = NULL;
				break;
		}

		$this->db->select('store_section.storesection_id AS storeSectionID');
		$this->db->select('store_section.name AS storeSectionName');
		$this->db->select('store_section.is_on_discount AS isOnDiscount');
		$this->db->select('store_section.promotion_id AS promotionID');
		$this->db->from('store_section');
		$this->db->join('store_info', 'store_section.store_id = store_info.store_id', 'left');
		$this->db->where('store_section.store_id', $storeID);
		$this->db->where('store_info.isPublished', 0); // only pick stores which are enabled
		$query2 = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query2->num_rows() > 0)
		{
			case TRUE: $retVal["storeSections"] =  $query2->result();
				break;
			case FALSE: $retVal["storeSections"] =  NULL;
				break;
		}
		return $retVal;

	}

	public function storeProducts($storeID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		log_message('INFO', 'storeProducts fired from '.$this->input->ip_address().' with storeID = '.$storeID.', sortBy = '.$sortBy.', startFrom = '.json_encode($startFrom).', maxResults = '.json_encode($maxResults));
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++++
		SELECT
		products.product_id,
		products.product_name,
		products.is_on_discount,
		products.bbucks,
		products.selling_price,
		products.discount,
		--products.store_id,
		products.storesection_id
		FROM products
		WHERE products.store_id = 100
		AND products.is_enable = 0
		AND products.status = 1
		ORDER BY storesection_id,added_on desc;
		*/
		$this->db->select('products.product_id AS productID');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.bbucks');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.storesection_id');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.brag_counter AS productBragCounter');
		$this->db->select('products.lastFanciedBy AS userID');
		$this->db->select('products.lFUBadgeType AS badgeType');
		$this->db->select('products.lFUBadgeLevel AS badgeLevel');
		$this->db->select('products.lFUBadgeNotificationText AS badgeNotificationText');

		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeProducts');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(b1.product_id) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(b1.product_id) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */

		$this->db->from('products');
		$this->db->join('store_info', 'products.store_id = store_info.store_id', 'left');
		$this->db->join('user_details', 'products.lastFanciedBy=user_details.user_id', 'left');
		$this->db->where("products.store_id", $storeID);
		$this->db->where('products.is_enable', 0);
		$this->db->where('products.status', 1);
		if($sortBy == 6) // only pick products that are on discount
		{
			$this->db->where('products.is_on_discount', 1);
		}

		if ($sortBy == 1) // sort by lowest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'ASC');
		}
		elseif ($sortBy == 2) // sort by highest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'DESC');
		}
		elseif ($sortBy==3) // sort by popularity
		{
			$this->db->order_by('(products.visit_counter+products.fancy_counter+products.brag_counter)', 'DESC');
		}
		elseif ($sortBy == 4) // sort by newness
		{
			$this->db->order_by('products.added_on', 'DESC');
		}
		elseif ($sortBy == 5) // sort by store section
		{
			$this->db->order_by('products.storesection_id, products.added_on', 'desc');
		}
		elseif ($sortBy == 7) // sort by last fancied time in descending order
		{
			$this->db->order_by('products.lastFanciedAt', 'DESC');
		}
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(20);
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(20, $startFrom*20);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE:	if(is_null($startFrom) || $startFrom === 0)
						{
							log_message('INFO', 'startFrom = '.json_encode($startFrom).'. Updating store visit counter');
							$this->db->set('visit_counter', 'visit_counter+1', FALSE);
							$this->db->where('store_id', $storeID);
							$storeVisitCounterQ = $this->db->update('store_info');
							log_message('INFO', "JUST RAN THE FOLLOWING QUERY_________________________\r\n".$this->db->last_query());
							log_message('INFO', 'RESULT OF storeVisitCounterQ = '.json_encode($storeVisitCounterQ));
						}
						return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function storeProductsUnpublished($storeID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++++
		SELECT
		products.product_id,
		products.product_name,
		products.is_on_discount,
		products.bbucks,
		products.selling_price,
		products.discount,
		--products.store_id,
		products.storesection_id
		FROM products
		WHERE products.store_id = 100
		AND products.is_enable = 0
		AND products.status = 1
		ORDER BY storesection_id,added_on desc;
		*/
		if(is_null($startFrom) || $startFrom === 0)
		{
			$this->db->set('visit_counter', 'visit_counter+1', FALSE);
			$this->db->where('store_id', $storeID);
			$this->db->update('store_info');
		}

		$this->db->select('products.product_id AS productID');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.bbucks');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.storesection_id');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.brag_counter AS productBragCounter');
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeProducts');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */

		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where("products.store_id", $storeID);
		$this->db->where('products.is_enable', 1); // only pick products which are disabled
		$this->db->where('products.status', 0); // only pick products which are disabled
		if($sortBy == 6) // only pick products that are on discount
		{
			$this->db->where('products.is_on_discount', 1);
		}

		if ($sortBy == 1) // sort by lowest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'ASC');
		}
		elseif ($sortBy == 2) // sort by highest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'DESC');
		}
		elseif ($sortBy==3) // sort by popularity
		{
			$this->db->order_by('(products.visit_counter+products.fancy_counter+products.brag_counter)', 'DESC');
		}
		elseif ($sortBy == 4) // sort by newness
		{
			$this->db->order_by('products.added_on', 'DESC');
		}
		elseif ($sortBy == 5) // sort by store section
		{
			$this->db->order_by('products.storesection_id, products.added_on', 'desc');
		}
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(20);
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(20, $startFrom*20);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function storeSectionProducts($storeID, $storeSectionID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++++
		SELECT
		products.product_id,
		products.product_name,
		products.is_on_discount,
		products.bbucks,
		products.selling_price,
		products.discount,
		--products.store_id,
		products.storesection_id
		FROM products
		WHERE products.store_id = 100
		AND products.is_enable = 0
		AND products.status = 1
		ORDER BY storesection_id,added_on desc;
		*/
		$this->db->select('products.product_id AS productID');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.bbucks');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('products.storesection_id');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.brag_counter AS productBragCounter');
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeSectionProducts');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */

		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where("products.store_id", $storeID);
		$this->db->where("products.storesection_id", $storeSectionID);
		$this->db->where("products.is_enable", 0);
		$this->db->where("products.status", 1);

		if($sortBy == 6) // only pick products that are on discount
		{
			$this->db->where('products.is_on_discount', 1);
		}

		if ($sortBy == 1) // sort by lowest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'ASC');
		}
		elseif ($sortBy == 2) // sort by highest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'DESC');
		}
		elseif ($sortBy==3) // sort by popularity
		{
			$this->db->order_by('(products.visit_counter+products.fancy_counter+products.brag_counter)', 'DESC');
		}
		elseif ($sortBy == 4) // sort by newness
		{
			$this->db->order_by('products.added_on', 'DESC');
		}
		elseif ($sortBy == 5) // sort by store section
		{
			$this->db->order_by('products.storesection_id, products.added_on', 'desc');
		}

		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(20);
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(20, $startFrom*20);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function storeSectionProductsUnpublished($storeID, $storeSectionID, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		/* QUERY BEING USED ++++++++++++++++++++++++++++++++++++++++++++++
		SELECT
		products.product_id,
		products.product_name,
		products.is_on_discount,
		products.bbucks,
		products.selling_price,
		products.discount,
		--products.store_id,
		products.storesection_id
		FROM products
		WHERE products.store_id = 100
		AND products.is_enable = 0
		AND products.status = 1
		ORDER BY storesection_id,added_on desc;
		*/
		$this->db->select('products.product_id AS productID');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.bbucks');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('products.storesection_id');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.brag_counter AS productBragCounter');
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/storeSectionProducts');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(*) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */

		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where("products.store_id", $storeID);
		$this->db->where("products.storesection_id", $storeSectionID);
		$this->db->where("products.is_enable", 1);
		$this->db->where("products.status", 0);

		if($sortBy == 6) // only pick products that are on discount
		{
			$this->db->where('products.is_on_discount', 1);
		}

		if ($sortBy == 1) // sort by lowest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'ASC');
		}
		elseif ($sortBy == 2) // sort by highest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'DESC');
		}
		elseif ($sortBy==3) // sort by popularity
		{
			$this->db->order_by('(products.visit_counter+products.fancy_counter+products.brag_counter)', 'DESC');
		}
		elseif ($sortBy == 4) // sort by newness
		{
			$this->db->order_by('products.added_on', 'DESC');
		}
		elseif ($sortBy == 5) // sort by store section
		{
			$this->db->order_by('products.storesection_id, products.added_on', 'desc');
		}

		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(20);
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(20, $startFrom*20);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY_________________________\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function buildTree($parentId = 0)
	{
		$this->db->select('category_id AS id');
		$this->db->select('category_name');
		$this->db->select('parent_catagory_id AS parentID');
		$this->db->select('category_id');
		$this->db->from('catagories');
		$this->db->order_by('sort_order', desc);
		$query = $this->db->get();
		$branch = array();
		switch($query->num_rows() > 0)
		{
			case TRUE:$elements = $query->result();
					foreach ($elements as $element)
					{
						if ($element->parentID == $parentId)
						{
							$children = $this->buildTree($elements, $element->id);
							if($children)
							{
								$element['children'] = $children;
							}
							$branch[] = $element;
						}
					}
				break;
			case FALSE: $branch = NULL;
				break;
		}
		return $branch;
	}

	function catProducts($catID, $subCatID1 = NULL, $subCatID2 = NULL, $subCatID3 = NULL, $sortBy = 4, $startFrom = NULL, $maxResults = NULL)
	{
		//$strname = $temp;
		/* $this->db->start_cache();
		 */
		log_message('INFO', "inside async_model/catProducts: cat_id = ".$catID.", sub_catid1 = ".$subCatID1.", sub_catid2 = ".$subCatID2.", sub_catid3 = ".$subCatID3.", sortBy = ".$sortBy.", startFrom = ".$startFrom.", maxResults = ".$maxResults);
		$this->db->select('products.product_id AS productID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.fancy_counter AS productFancyCounter');
		$this->db->select('products.is_on_discount AS productIsOnDiscount');
		$this->db->select('products.selling_price AS productSellingPrice');
		$this->db->select('products.discount AS productDiscount');
		$this->db->select('products.bbucks AS bbucks');
		$this->db->select('products.product_name AS productName');
		$this->db->select('products.visit_counter AS productVisitCounter');
		$this->db->select('products.quantity AS productQuantity');
		$this->db->select('products.lastFanciedBy AS userID');
		$this->db->select('products.lFUBadgeType AS badgeType');
		$this->db->select('products.lFUBadgeLevel AS badgeLevel');
		$this->db->select('products.lFUBadgeNotificationText AS badgeNotificationText');

		$this->db->select('user_details.userRank AS userRank');
		//$this->db->select('buynbrag_rank.rank AS userRank');
		$this->db->select('user_details.username AS userName');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.fb_uid as userFBID');
		$this->db->select('user_details.gender AS userGender');
		/* =============================================================== CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$__ip = $this->input->ip_address();
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to access async_model/catProducts');
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
			case TRUE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					 $this->db->select("(IF((SELECT COUNT(b1.product_id) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');
					  $this->db->select("(IF((SELECT COUNT(f1.product_id) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');
					  $this->db->select("(IF((SELECT COUNT(b1.product_id) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		/* =================================================== END SECTION CODE TO CHECK IF THE CURRENT USER HAS FANCIED  THE PRODUCT OR NOT ====================================================== */
		$this->db->from('products');
		$this->db->join('store_info', 'products.store_id = store_info.store_id', 'left');
		$this->db->join('user_details', 'products.lastFanciedBy=user_details.user_id', 'left');
		$this->db->where('products.cat_id', $catID);
		if(!is_null($subCatID1))
		{
			$this->db->where('products.sub_catid1', $subCatID1);
		}

		if(!is_null($subCatID2))
		{
			$this->db->where('products.sub_catid2', $subCatID2);
		}

		if(!is_null($subCatID3))
		{
			$this->db->where('products.sub_catid3', $subCatID3);
		}

		if($sortBy == 6)
		{
			$this->db->where('products.is_on_discount', 1);
		}

		$this->db->where('products.quantity > 0'); // only pick products which are in stock
		$this->db->where('products.status', 1); // pick only those products whose store are enabled
		$this->db->where('products.is_enable', 0); // pick only those products which are enabled
		//$this->db->order_by('products.visit_counter + products.fancy_counter',"desc");
		if ($sortBy == 1) // sort by lowest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'ASC');
		}
		elseif ($sortBy == 2) // sort by highest price
		{
			$this->db->order_by('(products.selling_price-products.discount)', 'DESC');
		}
		elseif ($sortBy==3) // sort by popularity
		{
			$this->db->order_by('(products.visit_counter+products.fancy_counter+products.brag_counter)', 'DESC');
		}
		elseif ($sortBy == 4) // sort by newness
		{
			$this->db->order_by('products.added_on', 'DESC');
		}
		elseif ($sortBy == 5) // sort by store name
		{
			$this->db->order_by('store_info.store_name', 'ASC');
		}
		elseif($sortBy == 7) // sort by last fancied time
		{
			$this->db->order_by('products.lastFanciedAt', 'DESC');
		}

		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(12); // by default only pick 12 products
				break;
			case FALSE: switch(is_null($maxResults))
					  {
						case TRUE: $this->db->limit(20, $startFrom*20);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					  }
				break;
		}
		$result = $this->db->get();
		log_message('INFO', "JUST RAN THE QUERY______\r\n".$this->db->last_query());
		switch($result->num_rows() > 0)
		{
			case TRUE: return $result->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}

	public function saveNotification($productID = NULL, $email = NULL, $userID = NULL)
	{
		$retData = array();
		$retData['hasEMail'] = FALSE;
		$retData['hasUserID'] = FALSE;
		$retData['hasProductID'] = FALSE;
		$retData['notificationSaved'] = FALSE;
		if( !is_null($productID) )
		{
			if( !is_null($email) )
			{
				$retData['hasEMail'] = TRUE;
				if( !is_null($userID) )
				{
					$retData['hasUserID'] = TRUE;
					$this->db->set('email', $email);
					$this->db->set('user_id', $userID);
					$this->db->set('product_id', $userID);
					$this->db->set('tsSaved', time());
					$retData['notificationSaved'] = $this->db->insert('pNotify');
				}
			}
		}
		return $retData;
	}

	public function getFBFriends($userDetails = NULL)
	{
		$retVal = array();
		$fbLoginStatus = $this->isLoggedINViaFacebook();
		$retVal['fbLoginStatus'] = $fbLoginStatus;
		$retVal['friendsList'] = NULL;

		$fbAppIDLive = '394741787279624';
		$fbAppSecretLive = '48a073a1b1e78e2b35a88610bace7f92';

		$fbAppIDTest = '454156234672558';
		$fbAppSecretTest = '5ef93f05dc0b5fed519532751b379cd7';

		$fbAppID = $fbAppIDLive;
		$fbAppSecret = $fbAppSecretLive;

		$fbConfig = array('appId' => $fbAppID, 'secret' => $fbAppSecret);
		$this->load->library('facebook', $fbConfig);
		log_message('INFO', 'async_model/isLoggedINViaFacebook: reading CI fb config');
		//$this->config->load('facebook');
		//$fbConfig = $this->config->item('facebook');
		log_message('INFO', 'async_model/isLoggedINViaFacebook: FB-APP-ID: '.$fbAppID.', FB-APP-SECRET: '.$fbAppSecret);

		// if a user with facebook id is logged-in and $userDetails is NULL
		if($fbLoginStatus["isLoggedINViaFacebook"] === TRUE && $fbLoginStatus["isLoggedIN"] === TRUE && $userDetails === NULL)
		{
			$friends = $this->facebook->api('/me/friends?limit=5000');
			$retVal['friendsList'] = $friends['data'];
			if(isset($friends["paging"]))
			{
				$retVal['nextURL'] = parse_url($friends["paging"]["next"], PHP_URL_QUERY);
			}
		}
		else
		{
			if($userDetails !== NULL)
			{
				$friends = $this->facebook->api('/'.$userDetails['fbID'].'/friends?limit=5000');
				$retVal['friendsList'] = $friends['data'];
				if(isset($friends["paging"]))
				{
					$retVal['nextURL'] = parse_url($friends["paging"]["next"], PHP_URL_QUERY);
				}
			}
		}

		log_message('INFO', "async_model/getFBFriends: Return Value:\r\n".print_r($retVal, TRUE));
		return $retVal;
	}

	public function addFBFriends()
	{

	}

	public function linkFBProfile($userID, $fbID, $fbEmail)
	{
		$this->db->set('fb_uid', $fbID);
		$this->db->set('fbEmail', $fbEmail);
		$this->db->where('user_id', $userID);
		$this->db->update('user_details');
	}

	public function fancyStore($storeID)
	{
		log_message('INFO', 'async_model/fancyStore/'.$storeID.' fired from '.$this->input->ip_address());
		$retVal = array();
		$retVal['storeUpdateOK'] = FALSE;
		$retVal['userStoreFollowOK'] = FALSE;
		$retVal['isLoggedIN'] = FALSE;
		$retVal['isAlreadyFancied'] = FALSE;
		$retVal['storeFancyCounter'] = NULL;
		$isLoggedIN = $this->isLoggedINViaFacebook();
		switch($isLoggedIN['isLoggedIN'] === TRUE)
		{
			case TRUE:	$retVal['isLoggedIN'] = TRUE;
						// check if the user has already fancied this store
						$this->db->select('COUNT(store_id) AS storeFancyCount');
						$this->db->from('fancy_store');
						$this->db->where('store_id', $storeID);
						$this->db->where('user_id', $isLoggedIN['id']);
						$query = $this->db->get();
						log_message('INFO', "JUST RAN THE FOLLOWING QUERY____________________________________\r\n".$this->db->last_query());
						switch($query->num_rows()> 0)
						{
							case TRUE:	$result = $query->result();
										log_message('INFO', '\$result[0]->storeFancyCount = '.$result[0]->storeFancyCount);
										if($result[0]->storeFancyCount == 0)
										{
											$this->db->set('store_id', $storeID);
											$this->db->set('user_id', $isLoggedIN['id']);
											$retVal['userStoreFollowOK'] = $this->db->insert('fancy_store');
											log_message('INFO', "JUST RAN THE FOLLOWING QUERY____________________________________\r\n".$this->db->last_query());

											/*$this->db->set('fancy_counter', 'fancy_counter+1', FALSE);
											$this->db->where('store_id', $storeID);
											$retVal['storeUpdateOK'] = $this->db->update('store_info');
											log_message('INFO', "JUST RAN THE FOLLOWING QUERY____________________________________\r\n".$this->db->last_query());
											*/
										}
										else
										{
											$retVal['isAlreadyFancied'] = TRUE;
										}
						}

						// find the current number of followers and attach it to the data being returned
						$this->db->select('fancy_counter');
						$this->db->from('store_info');
						$this->db->where('store_id', $storeID);
						$countQ = $this->db->get();
						log_message('INFO', "JUST RAN THE FOLLOWING QUERY____________________________________\r\n".$this->db->last_query());
						switch($countQ->num_rows() > 0)
						{
							case TRUE:	$count = $countQ->result();
										$count = $count[0]->fancy_counter;
										$retVal['storeFancyCounter'] = $count;
								break;
						}
				break;
		}
		return $retVal;
	}

}
?>
