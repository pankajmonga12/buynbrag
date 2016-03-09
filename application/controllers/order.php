<?php
class Order extends CI_Controller
{
	private $userid = "";

	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//Dont delete this function.
		$storeid = 106;
		$prodid = 101;
		$this->product_page($storeid, $prodid);
	}

	function product_page($storeid, $prodid)
	{
		//$this->benchmark->mark('start');
		include 'header_for_controller.php';
		$data['store_id'] = $storeid;
		$data['products'] = $this->morder->myprod($prodid);
		log_message('INFO', "\$data['products'] = ".print_r($data['products'], TRUE));
		if(is_null($data['products'])) // if no data was returned by the function
		{
			$this->load->view('disabledProduct', $data); // display an error page
			exit(0); // and stop execution
		}
		
		$data['productsDataRowCount'] = count($data['products']); // the number of product rows
		// If product is available
		if (!empty($data['products']))
		{
			//thejas
			/* THIS SECTION COMMENTED BY SHAMMI SHAILAJ TO DISABLE FORCE LOGIN BASED ERRORS
			$this->load->model('poll_model');
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item)
			{
				$data['poll_prods'][$p_item->product_id] = 1;
			}*/
			//end thejas
			$data['mystore'] = $this->morder->mystore($storeid);
			$data['mysec'] = $this->morder->mysec($storeid);
			$data['allprod'] = $this->morder->allproducts($storeid, 13); // pick a maximum of 13 products from the same store as the current products'
			$data['totalStoreProducts'] = $this->morder->totalStoreProducts($storeid);
			//$data['allprod'] = array_slice($data['allprod'], 0, 13);
			//$data['interested'] = array_slice($this->morder->interested($data['products'][0]->cat_id , $data['products'][0]->sub_catid1 , $data['products'][0]->sub_catid2), 0, 12);
			//Promotion / Discount
			$this->load->model('promotion');
			$data['products'] = $this->morder->myprod($prodid);
			$storeSection = $data['products'][0]->storesection_id;
			$mysecdetails = $this->promotion->mysecDetails($storeSection);
			//var_dump($data['products']);
			if ($data['products'][0]->is_on_discount)
			{
				$data['productdetails'] = $this->promotion->myprod($data['products'][0]->promotion_id);
				if ($data['productdetails'][0]->status == 0) {
					$data['ondiscount'] = 0;
				} else {
					$data['ondiscount'] = 1;
				}
			}
			else if (count($mysecdetails) > 0 && $mysecdetails[0]->is_on_discount)
			{
				$data['productdetails'] = $this->promotion->myprod($mysecdetails[0]->promotion_id);
				if (!empty($data['productdetails'][0]->status))
				{
					$data['ondiscount'] = 0;
				}
				else
				{
					$data['ondiscount'] = 1;
				}
			}
			else if ($data['mystore'][0]->is_on_discount)
			{
				$data['productdetails'] = $this->promotion->myprod($data['mystore'][0]->promotion_id);
				if (!empty($data['productdetails'][0]->status))
				{
					$data['ondiscount'] = 0;
				}
				else
				{
					$data['ondiscount'] = 1;
				}
			}
			else
			{
				$data['ondiscount'] = 0;
			}
			/* ============================ SHAMMI SHAILAJ =======================================+++ */
			/* HACK ATTMEPT TO FIX PRODUCT DISCOUNT NOT BEING DISPLAYED */
			$data['ondiscount'] = $data['products'][0]->is_on_discount;
			/* END SECTION HACK ATTMEPT TO FIX PRODUCT DISCOUNT NOT BEING DISPLAYED */
			/* ============================ SHAMMI SHAILAJ =======================================+++ */
			$data['myvar'] = $this->morder->myvar($prodid);
			if($isLoggedIN['status'] === TRUE)
			{
				//FANCY
				$data['fancied'] = $this->morder->fancied_product_user($this->session->userdata('id'), $prodid);
				//BRAG
				$this->load->model('brag');
				$data['bragged'] = $this->brag->product_brag_check($this->session->userdata('id'), $prodid);
				$this->config->load('facebook', TRUE);
				$config = $this->config->item('facebook');
				$data['app_id'] = $config['appId'];
				//VIEW Counter
				$this->load->model('badges');
				$viewed = $this->badges->userviewprod($this->session->userdata('id'), $storeid, $prodid);
				if ($viewed == 0)
				{
					$this->badges->visit_product($this->session->userdata('id'), $storeid, $prodid);
				}
				//End of View Counter
				// Is Exist in Cart
				$data['exist'] = $this->morder->check_cart_prod($prodid, $this->session->userdata('id'), $storeid);
				// End of Is Exist in cart
			}
			/* CODE DISABLED. CHRISTMAS IS OVER BITCH!
			//Christmas Discount
			/* CHISTMAS IS FUCKING OVER BITCH
			$this->load->model('contestdb');
			$data['christmas_winner'] = $this->contestdb->is_christmas_winner();
			$data['christmas_product'] = $this->contestdb->is_christmas_prod($prodid);
			*/
			$this->load->view('product_page', $data); //If Product id is wrong redirect to 404 Page
		}
		else
		{
			$data['error'] = "Product not available - You are accessing a wrong URL";
			if ($prodid == 'product_name_product_name')
			{
				$this->morder->errorpage();
			}
			$this->load->view('error_404', $data);
		}
//                        $this->benchmark->mark('end');
//                        echo $this->benchmark->elapsed_time('start' , 'end');
	}


	function store_page($storeid)
	{
//                    $this->benchmark->mark('start');
//                        include 'header_for_controller.php';
//			
//                        //Database field fetch up
//			$data['mystore'] = $this->morder->mystore($storeid);
//			$data['mysec'] = $this->morder->mysec($storeid);
//			$data['products'] = $this->morder->allproducts($storeid);
//			$data['recentlysold'] = $this->morder->recentlysold($storeid);
//			$data['productshigh'] = $this->morder->productshigh($storeid);
//			$data['productslow'] = $this->morder->productslow($storeid);
//                        //FANCY
//			$data['fancied'] = $this->morder->fancied_store_user($this->session->userdata('id'),$storeid);
//                        $data['store_fancy'] = $this->morder->store_fancy($storeid);
//                        //BRAG
//                        $this->load->model('brag');
//                        $data['bragged'] = $this->brag->store_brag_check($this->session->userdata('id'),$storeid);
//                        $this->config->load('facebook',TRUE);
//                        $config = $this->config->item('facebook');
//                        $data['app_id']=$config['appId'];
//                        //var_dump($data['products']);
//                        $this->load->model('badges');
//                        $viewed = $this->badges->userview($this->session->userdata('id'), $storeid);
//                        $data['store_visit_level'] = 0;
//                        if ( $viewed == 0)
//                        {
//                            $this->badges->visit_store($this->session->userdata('id') , $storeid);
//                        }
//                        //Fancy - Ananth
//                        $this->load->model('categoriesdb');
//                   $fancy=$this->categoriesdb->fancy_prods($this->session->userdata('id'));
//                    //var_dump($fancy);
//                    $fancy_array = array();
//                    $i = 0;
//                    foreach ($fancy as $key=>$val)
//                    {
//                        foreach($val as $key=>$prod_id){
//                        //var_dump ($prod_id);
//                        $fancy_array[$i] = $prod_id;
//                        $i++;
//                            }
//                    }
//                    $fancied=array_unique($fancy_array);
//                    $fancied_prods=array_merge($fancied);
//                    foreach ($fancied_prods as $f_item)
//                    {$data['fancied_prods'][$f_item]=1;
//                    }
//                    // END Fancy 
//                    $this->load->model('poll_model');
////thejas poll
//                    $poll_prods=$this->poll_model->my_poll_products($this->session->userdata('id')); 
//                    foreach ($poll_prods as $p_item)
//                    {$data['poll_prods'][$p_item->product_id]=1;
//                    }
//                    $store_visit=$this->badges->badge_alert($this->session->userdata('id'),1);
//                    $data['store_visit_level']=$store_visit[0];
//                    $data['store_badges_notify']=$store_visit[1];
//
//                    //end thejas
//                    $this->load->view('store_page',$data);

		include 'header_for_controller.php';
		$data['mystore'] = $this->morder->mystore($storeid);
		if (!empty($data['mystore']))
		{
			$data['mysec'] = $this->morder->mysec($storeid);
			$data['products'] = $this->morder->products($storeid);
			if( is_null($data['products']) )
			{
				$this->load->view('disabledProduct', $data); // display disabledProduct page
				exit(0); // and stop execution
			}
			$data['rec_viewed'] = $this->morder->rec_viewed();
//			$data['productshigh'] = $this->morder->productshigh($storeid);
//			$data['productslow'] = $this->morder->productslow($storeid);
			$this->config->load('facebook', TRUE);
			$config = $this->config->item('facebook');
			$data['app_id'] = $config['appId'];
			$this->load->model('async_model');
			$isLoggedIN = $this->async_model->isLoggedIN();
			if($isLoggedIN['status'] === TRUE)
			{
				//FANCY
				$data['fancied'] = $this->morder->fancied_store_user($this->session->userdata('id'), $storeid);
				//BRAG
				$this->load->model('brag');
				$data['bragged'] = $this->brag->store_brag_check($this->session->userdata('id'), $storeid);
				
				//VIEW
				$this->load->model('badges');
				$viewed = $this->badges->userview($this->session->userdata('id'), $storeid);
				if ($viewed == 0)
				{
					$this->badges->visit_store($this->session->userdata('id'), $storeid);
				}
				
				//Fancy - Ananth
				$this->load->model('categoriesdb');
				$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
				//var_dump($fancy);
				$fancy_array = array();
				$i = 0;
				foreach ($fancy as $key => $val)
				{
					foreach ($val as $key => $prod_id)
					{
						//var_dump ($prod_id);
						$fancy_array[$i] = $prod_id;
						$i++;
					}
				}
				$fancied = array_unique($fancy_array);
				$fancied_prods = array_merge($fancied);
				foreach ($fancied_prods as $f_item)
				{
					$data['fancied_prods'][$f_item] = 1;
				}
				// END Fancy
				$this->load->model('poll_model');
				//thejas poll
				$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
				foreach ($poll_prods as $p_item)
				{
					$data['poll_prods'][$p_item->product_id] = 1;
				}
				$store_visit = $this->badges->badge_alert($this->session->userdata('id'), 1);
				$data['store_visit_level'] = $store_visit[0];
				$data['store_badges_notify'] = $store_visit[1];
				//end thejas
			}
			$this->load->view('store_page_store', $data);
		}
		else
		{
			$data['error'] = "Store not available - You are accessing a wrong URL";
			$this->load->view('error_404', $data);
		}
//                    $this->benchmark->mark('end');
//                    echo $this->benchmark->elapsed_time('start', 'end');
	}

	function store_page_store_section($storeid)
	{
		include 'header_for_controller.php';
		$data['mystore'] = $this->morder->mystore($storeid);
		$data['mysec'] = $this->morder->mysec($storeid);
		$data['products'] = $this->morder->products($storeid);
		//$data['productshigh'] = $this->morder->productshigh($storeid);
		//$data['productslow'] = $this->morder->productslow($storeid);
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
			//FANCY
			$data['fancied'] = $this->morder->fancied_store_user($this->session->userdata('id'), $storeid);
			//BRAG
			$this->load->model('brag');
			$data['bragged'] = $this->brag->store_brag_check($this->session->userdata('id'), $storeid);
			$this->config->load('facebook', TRUE);
			$config = $this->config->item('facebook');
			$data['app_id'] = $config['appId'];
			//VIEW
			$this->load->model('badges');
			$viewed = $this->badges->userview($this->session->userdata('id'), $storeid);
			if ($viewed == 0)
			{
				$this->badges->visit_store($this->session->userdata('id'), $storeid);
			}

			//Fancy - Ananth
			$this->load->model('categoriesdb');
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val) {
				foreach ($val as $key => $prod_id) {
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_prods = array_merge($fancied);
			foreach ($fancied_prods as $f_item) {
				$data['fancied_prods'][$f_item] = 1;
			}
			// END Fancy
			$this->load->model('poll_model');
			//thejas poll
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item) {
				$data['poll_prods'][$p_item->product_id] = 1;
			}
			$store_visit = $this->badges->badge_alert($this->session->userdata('id'), 1);
		}
		$data['store_visit_level'] = $store_visit[0];
		$data['store_badges_notify'] = $store_visit[1];

		//end thejas

		$this->load->view('store_page_store', $data);
	}

/* ============================================== add_to_cart improvised by SHAMMI SHAILAJ ============================ */
/* =========================== NOW RETURNS JSON OBJECT WITH CART COUNT AND ADDITION STATUS ============================ */
	function add_to_cart($prodid = NULL, $color = NULL, $size = NULL, $userid = NULL, $storeid = NULL)
	{
		log_message("INFO", "INSIDE order/add_to_cart. Requested by ".$userid." from ".$this->input->ip_address());
		$response = NULL;
		$responseData = NULL;
		if(is_null($prodid) || is_null($color) || is_null($size) || is_null($userid) || is_null($storeid) || strcmp($prodid, "") === 0 || strcmp($color, "") === 0 || strcmp($size, "") === 0 || strcmp($userid, "") === 0 || strcmp($storeid, "") === 0)
		{
			$responseData = array("addedProduct" => FALSE, "cartCount" => 0);
		}
		else
		{
			$this->load->model('morder');
			$exist = $this->morder->check_cart($prodid, $color, $size, $userid, $storeid);
			if ($exist == 0)
			{
				$data['mystore'] = $this->morder->save_cart($prodid, $color, $size, $userid, $storeid);
				$cartCount = $this->morder->cartCount($userid);
				$responseData = array("addedProduct" => TRUE, "cartCount" => $cartCount);
			}
			else
			{
				$cartCount = $this->morder->cartCount($userid);
				$responseData = array("addedProduct" => FALSE, "cartCount" => $cartCount);
			}
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT|JSON_NUMERIC_CHECK);
		log_message("INFO", "Response = ".print_r($response, TRUE));
		
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
/* ============================================== END SECTION add_to_cart improvised by SHAMMI SHAILAJ ============================ */
	function buyit($prodid, $userid, $storeid)
	{
		$this->load->model('morder');
		$exist = $this->morder->check_cart($prodid, $color, $size, $userid, $storeid);
		if ($exist == 0) {
			$data['mystore'] = $this->morder->save_cart($prodid, $userid, $storeid);
		}
		redirect("cart/shopping_cart/");
	}

	function user_fancy_store()
	{
		include 'header_for_controller.php';
		$this->load->model('user_info_model');
		$this->load->model('morder');
		// Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1) {
					$temp = array('img' => "view/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 2) {
					$temp = array('img' => "poll/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 3) {
					$temp = array('img' => "fstore/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 4) {
					$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 5) {
					$temp = array('img' => "brag/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 6) {
					$temp = array('img' => "buy/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}


			}
		}

		//End of Badges
		$uid = $this->session->userdata('id');
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$data['Efancy_stores'] = $this->morder->user_fancied_stores(0);
		$data['fancy_stores'] = $this->morder->user_fancied_stores($this->session->userdata('id'));
//			for ($i=0; $i<count($data);$i++)
//				{
//				echo $data[$i]->store_id;
//				echo "<br/>";
//				}
		$data['sprod'] = array();
		foreach ($data['fancy_stores'] as $sid) {
			$key = '_' . $sid->store_id;
			$var = array($key => $this->morder->fancystoreprod($sid->store_id));
			$data['sprod'] = array_merge($data['sprod'], $var);
		}
		$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));
		$data['countfstore'] = count($this->morder->cfstore($this->session->userdata('id')));
		$data['countflist'] = count($this->morder->cflist($this->session->userdata('id')));
		$this->load->view('fancy_store', $data);
	}

	function user_fancy_product()
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', $__ip."order/user_fancy_product start: ". time());
		include 'header_for_controller.php';
		if($isLoggedIN['status'] === TRUE)
		{
			$this->load->model('user_info_model');
			$this->load->model('morder');
			/* ADDED BY SHAMMI FOR BADGES */
			include_once 'badges_desc.php';
			/* END SECTION ADDED BY SHAMMI FOR BADGES */
			// Badges
			$this->load->model('badges');
			log_message('INFO', $__ip."order/user_fancy_product loaded header, models n badges_desc: ". time());
			$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
			log_message('INFO', $__ip."order/user_fancy_product loaded badges from DB: ". time());
			if (!empty($data['user_badge'])) {
				$data['badges'] = array();
				for ($i = 0; $i < count($data['user_badge']); $i++) {
					if ($data['user_badge'][$i]->badge_type == 1)
					{
						for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
						{
							$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
							array_push($data['badges'], $temp);
						}
					}
					if ($data['user_badge'][$i]->badge_type == 2)
					{
						for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
						{
							$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
							array_push($data['badges'], $temp);
						}
					}
					if ($data['user_badge'][$i]->badge_type == 3)
					{
						for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
						{
							$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
							array_push($data['badges'], $temp);
						}
					}
					if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
					{
						/* OLD DISPLAY CODE */
						//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						//array_push($data['badges'], $temp);
						/* OLD FANCY BADGES DISPLAY CODE */
						/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
						/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
						for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
						{
							$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
							array_push($data['badges'], $temp);
						}
					}
					if ($data['user_badge'][$i]->badge_type == 5)
					{
						for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
						{
							$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
							array_push($data['badges'], $temp);
						}
					}
					if ($data['user_badge'][$i]->badge_type == 6)
					{
						for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
						{
							$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
							array_push($data['badges'], $temp);
						}
					}
					if ($data['user_badge'][$i]->badge_type == 71) {
						$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						array_push($data['badges'], $temp);
					}
					if ($data['user_badge'][$i]->badge_type == 72) {
						$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						array_push($data['badges'], $temp);
					}
					if ($data['user_badge'][$i]->badge_type == 73) {
						$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						array_push($data['badges'], $temp);
					}
					if ($data['user_badge'][$i]->badge_type == 74) {
						$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						array_push($data['badges'], $temp);
					}
					if ($data['user_badge'][$i]->badge_type == 75) {
						$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						array_push($data['badges'], $temp);
					}
					if ($data['user_badge'][$i]->badge_type == 8) {
						$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						array_push($data['badges'], $temp);
					}
					if ($data['user_badge'][$i]->badge_type == 9) {
						$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
						array_push($data['badges'], $temp);
					}

				}
			}
			log_message('INFO', $__ip."order/user_fancy_product processed badges: ". time());
			//End of Badges
			//Fancy - Ananth
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			log_message('INFO', $__ip."order/user_fancy_product DB query categoriesdb->fancy_prods: ". time());
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val) {
				foreach ($val as $key => $prod_id) {
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_prods = array_merge($fancied);
			foreach ($fancied_prods as $f_item) {
				$data['fancied_prods'][$f_item] = 1;
			}
			log_message('INFO', $__ip."order/user_fancy_product finished checking fancied items: ". time());
			// END Fancy
			//poll
			$this->load->model('poll_model');
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			log_message('INFO', $__ip."order/user_fancy_product finished loading poll products: ". time());
			foreach ($poll_prods as $p_item) {
				$data['poll_prods'][$p_item->product_id] = 1;
			}
			log_message('INFO', $__ip."order/user_fancy_product finished poll products: ". time());
			//End poll
			$uid = $this->session->userdata('id');
			$data['base_url'] = base_url();
			$data['css'] = $this->config->item('css');
			$data['fprod'] = array_reverse($this->morder->user_fancied_product2($this->session->userdata('id')));
			log_message('INFO', $__ip."order/user_fancy_product finished loading facny list products ". time());
			//$data['fprod'] = array_fill(0,14,'a');
			//var_dump($data['fprod']);
			$data['userinfo'] = $this->user_info_model->userdetails($this->session->userdata('id'));
			$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
			$data['countfstore'] = $this->morder->cfstoreCount($this->session->userdata('id'));
			$data['countflist'] = $this->morder->cflistCount($this->session->userdata('id'));
			log_message('INFO', $__ip."order/user_fancy_product finished various counts ". time());
			log_message('INFO', $__ip."order/user_fancy_product NOW LOADING VIEW ". time());
			$this->load->view('fancy_product', $data);
		}
		else
		{
			redirect(base_url('/login'));
		}
	}

	function friend_fancy_product($uid)
	{
		include 'header_for_controller.php';
		$this->load->model('user_info_model');
		$this->load->model('morder');
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		// Badges
		$this->load->model('badges');
		$data['uid'] = $uid;
		$data['user_badge'] = $this->badges->user_badge($uid);
		if (!empty($data['user_badge']))
		{
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++)
			{
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71)
				{
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72)
				{
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73)
				{
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74)
				{
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75)
				{
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8)
				{
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9)
				{
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
			}
		}
		//End of Badges
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
			//Fancy - Ananth
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val) {
				foreach ($val as $key => $prod_id) {
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_prods = array_merge($fancied);
			foreach ($fancied_prods as $f_item) {
				$data['fancied_prods'][$f_item] = 1;
			}
			// END Fancy
			//poll
			$this->load->model('poll_model');
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item) {
				$data['poll_prods'][$p_item->product_id] = 1;
			}
			//End poll
			$this->load->model('friends_follow_model');
			$data['f_status'] = $this->friends_follow_model->f_status($this->session->userdata('id'), $uid); //text for the button of freinds/follow
		}
		$data['base_url'] = base_url();
		$data['fprod'] = $this->morder->user_fancied_product2($uid);
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$data['countfprod'] = $this->morder->cfprodCount($uid);
		$this->load->view('fancy_product_other', $data);
	}

	function fancy_lists()
	{
		include 'header_for_controller.php';
		$this->load->model('user_info_model');
		$this->load->model('morder');
		/* ADDED BY SHAMMI FOR BADGES */
		include_once 'badges_desc.php';
		/* END SECTION ADDED BY SHAMMI FOR BADGES */
		// Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge']))
		{
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++)
			{
				if ($data['user_badge'][$i]->badge_type == 1)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "view/" . $badgeLevels . ".png", 'txt' => $storeBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 2)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "poll/" . $badgeLevels . ".png", 'txt' => $pollBadges[$badgeLevels]->notification_text);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 3)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fstore/" . $badgeLevels . ".png", 'txt' => $fancyStoreBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 4) // badges for fancy products
				{
					/* OLD DISPLAY CODE */
					//$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					//array_push($data['badges'], $temp);
					/* OLD FANCY BADGES DISPLAY CODE */
					/* ABOVE SECTION COMMENTED ON AYUSH N PRT's REQUEST TO SHOW ALL BADGES */
					/* FOLLOWING CODE BY SHAMMI TO DISPLAY ALL BADGES FOR A USER UPTO THE LEVEL THEY HAVE EARNED */
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "fprod/" .$badgeLevels. ".png", 'txt' => $fancyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 5)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "brag/" . $badgeLevels . ".png", 'txt' => $bragBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 6)
				{
					for($badgeLevels = 1; $badgeLevels <= $data['user_badge'][$i]->badge_level; $badgeLevels++)
					{
						$temp = array('img' => "buy/" . $badgeLevels . ".png", 'txt' => $buyBadges[$badgeLevels]->notificationText);
						array_push($data['badges'], $temp);
					}
				}
				if ($data['user_badge'][$i]->badge_type == 71)
				{
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72)
				{
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73)
				{
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74)
				{
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75)
				{
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8)
				{
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9)
				{
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}

		//End of Badges
		$uid = $this->session->userdata('id');
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$mylistdef = $this->morder->my_fancy_default($this->session->userdata('id'));
		$mylistuser = $this->morder->my_fancy_user($this->session->userdata('id'));
		//var_dump($mylists[0]->fancy_list_id);
		for ($i = 0; $i < count($mylistdef); $i++) {
			if (count($this->morder->user_fancy_list($this->session->userdata('id'), $mylistdef[$i]->fancy_list_id)) > 0) {
				$data['fancyitemdef'][] = $this->morder->user_fancy_list($this->session->userdata('id'), $mylistdef[$i]->fancy_list_id);
				$data['mylistdef'][] = $mylistdef[$i];
				$data['prod_count_def'][] = $this->morder->user_fancy_prodcount($this->session->userdata('id'), $mylistdef[$i]->fancy_list_id);
			}
		}
		for ($i = 0; $i < count($mylistuser); $i++) {
			if (count($this->morder->user_fancy_list($this->session->userdata('id'), $mylistuser[$i]->fancy_list_id)) > 0) {
				$data['fancyitemuser'][] = $this->morder->user_fancy_list($this->session->userdata('id'), $mylistuser[$i]->fancy_list_id);
				$data['mylistuser'][] = $mylistuser[$i];
				$data['prod_count_user'][] = $this->morder->user_fancy_prodcount($this->session->userdata('id'), $mylistuser[$i]->fancy_list_id);
			}
		}
		//var_dump($data['prod_count_user']);
		//var_dump($data['prod_count_def']);
		$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));
		$data['countfstore'] = count($this->morder->cfstore($this->session->userdata('id')));
		$data['countflist'] = count($this->morder->cflist($this->session->userdata('id')));
		$this->load->view('fancy_lists', $data);
	}

	function fancy_list_delete($flistid)
	{
		include 'header_for_controller.php';
		$this->morder->fancy_list_delete($this->session->userdata('id'), $flistid);
		$this->morder->fancy_product_delete($this->session->userdata('id'), $flistid);
	}

	function fancy_list_detail()
	{
		include 'header_for_controller.php';
		$this->load->model('user_info_model');
		$this->load->model('morder');
		// Badges
		$this->load->model('badges');
		$data['user_badge'] = $this->badges->user_badge($this->session->userdata('id'));
		if (!empty($data['user_badge'])) {
			$data['badges'] = array();
			for ($i = 0; $i < count($data['user_badge']); $i++) {
				if ($data['user_badge'][$i]->badge_type == 1) {
					$temp = array('img' => "view/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 2) {
					$temp = array('img' => "poll/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 3) {
					$temp = array('img' => "fstore/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 4) {
					$temp = array('img' => "fprod/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 5) {
					$temp = array('img' => "brag/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 6) {
					$temp = array('img' => "buy/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 71) {
					$temp = array('img' => "fcat/71/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 72) {
					$temp = array('img' => "fcat/72/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 73) {
					$temp = array('img' => "fcat/73/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 74) {
					$temp = array('img' => "fcat/74/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 75) {
					$temp = array('img' => "fcat/75/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 8) {
					$temp = array('img' => "inv/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}
				if ($data['user_badge'][$i]->badge_type == 9) {
					$temp = array('img' => "acc/" . $data['user_badge'][$i]->badge_level . ".png", 'txt' => $data['user_badge'][$i]->notification_text);
					array_push($data['badges'], $temp);
				}

			}
		}

		//End of Badges
		$uid = $this->session->userdata('id');
		$data['userinfo'] = $this->user_info_model->userdetails($uid);
		$mylistdef = $this->morder->my_fancy_default($this->session->userdata('id'));
		$mylistuser = $this->morder->my_fancy_user($this->session->userdata('id'));
		//var_dump($mylists[0]->fancy_list_id);
		for ($i = 0; $i < count($mylistdef); $i++) {
			if (count($this->morder->user_fancy_list($this->session->userdata('id'), $mylistdef[$i]->fancy_list_id)) > 0) {
				$data['mylistdef'][] = $mylistdef[$i];
				$data['prod_count_def'][] = $this->morder->user_fancy_prodcount($this->session->userdata('id'), $mylistdef[$i]->fancy_list_id);
			}
		}
		for ($i = 0; $i < count($mylistuser); $i++) {
			if (count($this->morder->user_fancy_list($this->session->userdata('id'), $mylistuser[$i]->fancy_list_id)) > 0) {
				$data['mylistuser'][] = $mylistuser[$i];
				$data['prod_count_user'][] = $this->morder->user_fancy_prodcount($this->session->userdata('id'), $mylistuser[$i]->fancy_list_id);
			}
		}
		//var_dump($data['prods']);
		//var_dump($data['prod_count_def']);
		$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));
		$data['countfstore'] = count($this->morder->cfstore($this->session->userdata('id')));
		$data['countflist'] = count($this->morder->cflist($this->session->userdata('id')));
		$this->load->view('fancy_list_detail', $data);
	}


	function def_prod($store_id, $count)
	{
		$this->load->model('morder');
//                    $aaa = $this->morder->add_def_prod($store_id);
//                    echo $aaa ; 
		for ($i = 0; $i < $count; $i++) {
			if ($this->morder->add_def_prod($store_id))
				echo $i;
		}


	}
}
?>
