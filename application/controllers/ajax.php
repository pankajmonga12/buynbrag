<?php
class Ajax extends CI_Controller
{

	public function __construct()
	{
		date_default_timezone_set('Asia/Kolkata');
		parent::__construct();
		$this->load->model('morder');
		$this->load->model('saledb');
		$this->load->model('signup');
		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->library('email');
		//$this->load->library('javascript'); /* dont know why the fuck was this being used */
		$this->config->load('payu', TRUE);
		//Added by lee
		$url_suffix = $this->config->item('url_suffix'); //Gets the Url suffix if any is set in config file.
		$current_url = current_url(); //Gets the current url. e.g.: http(s)://www.hostname.com/index.php/[controller]/[function]/[param1]/[param2]
		if (!empty($url_suffix))
			$current_url = strstr($current_url, $url_suffix, TRUE);
		$curl = explode('/', $current_url);
		$site_url = explode('/', site_url()); //Gets the site url. e.g.: http(s)://www.hostname.com/index.php
		$params = array_diff($curl, $site_url); //Seperates the [controller]/[function]/[param1]/[param2] and is stored in $params.
		$page = implode('/', $params);
		if ($this->session->userdata('id'))
		{
			log_message('Info', "User with userid: " . $this->session->userdata('id') . " and ip: " . $this->input->ip_address() . " is accessing: $page via ajax.");
		}
		
		if (!$this->session->userdata('id'))
		{
			//Added by lee
			log_message('Info', "User Session Broke/Not set for the user with ip: " . $this->input->ip_address() . " While he was in: $page.");
			//$red_url = base_url('user_info/homepage_afterlogin');
			//redirect($red_url);
		}
	}

	public function password()
	{
		$temp1 = $this->input->post('fp_email');
		$status = (int)$this->signup->user_id($temp1);
		if ($status == 0) {
			die("no_account");
		} else {
			$pw_reset = $this->reset_password($status, $temp1);
			if ($pw_reset == 1)
				die("success");
			else
				die("error_occured");
		}
	}

	public function reset_password($user_id, $email)
	{
		$act_key = random_string('nozero', 3);
		$act_id = $this->signup->create_activation_link($act_key, $user_id, $email, '', 2);
		$this->email->from('support@buyandbrag.in', 'BuynBrag');
		$this->email->to($email);
		$this->email->subject("BuynBrag: Password Reset Link for Login");
		$msg = "Paste the following activation key, to reset the password & login to BuynBrag!<br>Ignore this mail to retain your old password(if any),incase you didn't request for it!<br><br>";
		$act_link = base_url().'index.php/welcome/activate/'.$act_id.'/'.md5($act_key).'/2';
		$act_link = $act_id . '0' . $act_key;
		$this->email->message($msg . '<h2>' . $act_link . '</h2>');
		//echo $msg.$act_link;
		$this->email->set_newline("\r\n");
		if ($this->email->send())
			return 1;
		else
			return 0;
	}

	public function activate_password()
	{
		$activation = $this->input->post('activation_key');
		if (empty($activation))
			$activation = ' / ';
		$activation = explode("0", $activation);
		$act_id = $activation[0];
		$act_key = $activation[1];

		$a3 = $this->input->post('reset_pw1');
		$a4 = $this->input->post('reset_pw2');
		$status = $this->signup->pw_reset_status($act_id, $act_key);
		if ($status == 0) { //invalid activation key
			die('invalid');
		} elseif ($status == 1) {
			if ($a3 == '' or $a4 == '')
				die('pw_blank');
			elseif ($a3 != $a4)
				die('pw_mismatch'); else {
				$user_id = $this->signup->pw_reset($act_id, $act_key, $a3);
				if ($user_id == 0)
					die('error');
				else {
					$sess = array('id' => $user_id, 'logged_in' => TRUE);
					$this->session->set_userdata($sess);
					die('success');
				}
			}
		}
	}


	function store_page_category($storeid, $secid)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'Someone from '.$__ip.' is trying to access ajax/store_page_store_section');
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data['css'] = $this->config->item('css');
		$data['mystore'] = $this->morder->mystore($storeid);
		$data['products'] = $this->morder->secprod($storeid, $secid);
		//Fancy - Ananth
		$this->load->model('badges');
		$this->load->model('categoriesdb');
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
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
		}
		//end thejas
		//$data['mysec'] = $this->morder->mysec($storeid);
		//$data['products'] = $this->morder->secprod($storeid,$secid);
		//$data['productshigh'] = $this->morder->productshigh($storeid);
		//$data['productslow'] = $this->morder->productslow($storeid);
		$this->load->view('store_page_store_section', $data);
	}

	function cat_product_loader()
	{
		log_message('INFO', 'inside ajax/cat_product_loader');
		$id = $this->input->get('cat_id', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$price1 = 0;
		$price2 = 0;
		$sort_price = 0;
		$sssc_id = 0;
		$sssc_type = 0;
		$price1 = (int)$this->input->get('price1', TRUE);
		$price2 = (int)$this->input->get('price2', TRUE);
		$range_bits = $this->input->get('range_bits', TRUE);
		$occasions = $this->input->get('occasions', TRUE);
		$occasions = explode(',', $occasions);
		$sort_price = (int)$this->input->get('sort_price', TRUE);
		$last_price = (int)$this->input->get('last_price', TRUE);
		$sssc_id = (int)$this->input->get('sssc_id', TRUE);
		$sssc_type = (int)$this->input->get('sssc_type', TRUE);
		$data['id'] = $id;
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		if ($sort_price == 0)
		{
			log_message('INFO', 'sort_price == 0 is true');
			log_message('INFO', 'NOW EXECUTING____'."\$data[\'products\'] = \$this->categoriesdb->catprodLoader(0, ".$id.", ".$limit.", ".$price1.", ".$price2.", 0, 0, ".$sssc_id.", ".$sssc_type.", ".$range_bits.", ".$occasions.")");
			$data['products'] = $this->categoriesdb->catprodLoader(0, $id, $limit, $price1, $price2, 0, 0, $sssc_id, $sssc_type, $range_bits, $occasions);
		}
		else
		{
			log_message('INFO', 'sort_price == '.$sort_price);
			log_message('INFO', "NOW EXECUTING___\$data[\'products1\'] = \$this->categoriesdb->catprodLoader(1, ".$id.", ".$limit.", ".$price1.", ".$price2.", ".$sort_price.", ".$last_price.", ".$sssc_id.", ".$sssc_type.", ".$range_bits.", ".$occasions.")");
			$data['products1'] = $this->categoriesdb->catprodLoader(1, $id, $limit, $price1, $price2, $sort_price, $last_price, $sssc_id, $sssc_type, $range_bits, $occasions);
			log_message('INFO', "NOW EXECUTING___\$data[\'products2\'] = \$this->categoriesdb->catprodLoader(2, ".$id.", ".$limit.", ".$price1.", ".$price2.", ".$sort_price.", ".$last_price.", ".$sssc_id.", ".$sssc_type.", ".$range_bits.", ".$occasions.")");
			$data['products2'] = $this->categoriesdb->catprodLoader(2, $id, $limit, $price1, $price2, $sort_price, $last_price, $sssc_id, $sssc_type, $range_bits, $occasions);
			log_message('INFO', "NOW merging arrays data[products1] and data[products2]");
			$data['products3'] = array_merge($data['products1'], $data['products2']);
			if (count($data['products3']) > 6)
			{
				$data['products'] = array_slice($data['products3'], 0, 6);
			}
			else
			{
				$data['products'] = array_slice($data['products3'], 0, count($data['products3']));
			}
		}
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
			log_message('INFO', 'user is logged-in from '.$isLoggedIN['ip']);
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
			//Thejas
			$this->load->model('poll_model');
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item)
			{
				$data['poll_prods'][$p_item->product_id] = 1;
			}
		}
		log_message('INFO', 'Data being returned by ajax/cat_product_loader is: '.print_r($data, TRUE));
		$this->load->view('cat_prod_loader', $data);
	}

	function sale_product_loader($sale_id)
	{
		$last_price = 0;
		$last_price = (int)$this->input->get('last_price', TRUE);
		$last_perc = 0;
		$last_perc = (int)$this->input->get('last_perc', TRUE);
		$price1 = 0;
		$price1 = (int)$this->input->get('price1', TRUE);
		$price2 = 0;
		$price2 = (int)$this->input->get('price2', TRUE);
		$range_bits = $this->input->get('range_bits', TRUE);
		$sort_price = 0;
		$sort_price = (int)$this->input->get('sort_price', TRUE);
		$last_pid = 0;
		$last_pid = (int)$this->input->get('last_pid', TRUE);

		if ($sort_price == 0)
		{
			$data['products1'] = $this->saledb->saleprodLoader(1, $sale_id, 0, $last_perc, $last_pid, $last_price, $price1, $price2, $range_bits);
			$data['products2'] = $this->saledb->saleprodLoader(2, $sale_id, 0, $last_perc, $last_pid, $last_price, $price1, $price2, $range_bits);
			$data['products3'] = array_merge($data['products1'], $data['products2']);
			if (count($data['products3']) > 6)
				$data['products'] = array_slice($data['products3'], 0, 6);
			else
				$data['products'] = array_slice($data['products3'], 0, count($data['products3']));
		}
		else
		{
			$data['products1'] = $this->saledb->saleprodLoader(1, $sale_id, $sort_price, $last_perc, $last_pid, $last_price, $price1, $price2, $range_bits);
			$data['products2'] = $this->saledb->saleprodLoader(2, $sale_id, $sort_price, $last_perc, $last_pid, $last_price, $price1, $price2, $range_bits);
			$data['products3'] = array_merge($data['products1'], $data['products2']);
			if (count($data['products3']) > 6)
			{
				$data['products'] = array_slice($data['products3'], 0, 6);
			}
			else
			{
				$data['products'] = array_slice($data['products3'], 0, count($data['products3']));
			}
		}
		
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
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
			//Thejas
			$this->load->model('poll_model');
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item) {
				$data['poll_prods'][$p_item->product_id] = 1;
			}
		}
		
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$this->load->view('cat_prod_loader', $data);
	}

	function occ_product_loader($occasion, $sssc_id, $sssc_type = 0)
	{
		$last_price = 0;
		$last_price = (int)$this->input->get('last_price', TRUE);
		$price1 = 0;
		$price1 = (int)$this->input->get('price1', TRUE);
		$price2 = 0;
		$price2 = (int)$this->input->get('price2', TRUE);
		$range_bits = $this->input->get('range_bits', TRUE);
		$sort_price = 0;
		$sort_price = (int)$this->input->get('sort_price', TRUE);
		$last_pid = 0;
		$last_pid = (int)$this->input->get('last_pid', TRUE);
		$occasion = mysql_real_escape_string($occasion);

		if ($sort_price == 0)
		{
			$data['products'] = $this->categoriesdb->occprodLoader(0, $occasion, 0, $last_pid, $last_price, $price1, $price2, $range_bits, $sssc_id, $sssc_type);
		}
		else
		{
			$data['products1'] = $this->categoriesdb->occprodLoader(1, $occasion, $sort_price, $last_pid, $last_price, $price1, $price2, $range_bits, $sssc_id, $sssc_type);
			$data['products2'] = $this->categoriesdb->occprodLoader(2, $occasion, $sort_price, $last_pid, $last_price, $price1, $price2, $range_bits, $sssc_id, $sssc_type);
			$data['products3'] = array_merge($data['products1'], $data['products2']);
			if (count($data['products3']) > 6)
			{
				$data['products'] = array_slice($data['products3'], 0, 6);
			}
			else
			{
				$data['products'] = array_slice($data['products3'], 0, count($data['products3']));
			}
		}
		
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
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
			//Thejas
			$this->load->model('poll_model');
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item) {
				$data['poll_prods'][$p_item->product_id] = 1;
			}
		}
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$this->load->view('cat_prod_loader', $data);
	}

	function cat_stores_loader()
	{
		$id = $this->input->get('cat_id', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$data['id'] = $id;
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data['products'] = $this->categoriesdb->catprod($id);
		$data['store'] = $this->categoriesdb->catstoreLoader($id, $limit);
		$data['sprod'] = array();
		foreach ($data['store'] as $sid) {
			$key = '_' . $sid->store_id;
			$var = array($key => $this->categoriesdb->catstoreprod($id, $sid->store_id));
			$data['sprod'] = array_merge($data['sprod'], $var);
		}
		$this->load->view('cat_stores_loader', $data);
	}

	function deleteCart()
	{
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data['css'] = $this->config->item('css');
		$cat_id = $this->input->post('obj', TRUE);
		$this->cartdb->deleteMyCart($cat_id, $this->session->userdata('id'));
		echo base_url();
	}

	function updateCart()
	{
		log_message('INFO', 'ajax/updateCart Fired');
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data['css'] = $this->config->item('css');
		$id = $this->input->POST('obj', TRUE);
		log_message('INFO', "POSTED DATA IS:___________________ \r\nobj = \$id = ".print_r($id, TRUE));
		/*log_message('INFO', "now using JSON DECODE on this data");
		$id = json_decode($id, TRUE);
		log_message('INFO', "POSTED DATA IS:___________________ \r\nobj = \$id = ".print_r($id, TRUE));*/
		log_message('INFO', "Updating cart quantities");
		$this->cartdb->updateMyCartNew($id, $this->session->userdata('id'));		
		echo base_url();
	}

	//Ananth - for FANCY
	function fancy_store()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$userid = $this->session->userdata('id');
		$this->morder->save_fancy_store($storeid, $userid);
		$this->morder->fancy_store_increment($storeid);
		$data = $this->morder->get_store_fancy($storeid);
		echo ($data['0']->fancy_counter);
	}

	function unfancy_store()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$userid = $this->session->userdata('id');
		$this->morder->delete_fancy_store($storeid, $userid);
		$this->morder->fancy_store_decrement($storeid);
		$data = $this->morder->get_store_fancy($storeid);
		echo ($data['0']->fancy_counter);
	}

	function fancy_product_addlist()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		$userid = $this->session->userdata('id');
		//$postdata=array();
		$post = $this->input->get('postdata', TRUE);
		$postdata = explode(',', $post);
		for ($i = 0; $i < count($postdata); $i++) {
			$this->morder->save_fancy_product($prodid, $userid, $postdata[$i]);
		}
		$this->morder->fancy_product_increment($storeid, $prodid);
		$data = $this->morder->get_product_fancy($storeid, $prodid);
		echo ($data['0']->fancy_counter);
	}

	function fancy_product_unfancy()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		$userid = $this->session->userdata('id');
		$this->morder->remove_fancy_product($prodid, $userid);
		$this->morder->fancy_product_decrement($storeid, $prodid);
		$data = $this->morder->get_product_fancy($storeid, $prodid);
		echo ($data['0']->fancy_counter);
	}

	function fancy_product_fetchpop2()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		$userid = $this->session->userdata('id');

		$flistdef = $this->morder->getflistiddef($prodid, $userid);
		if (isset($flistdef[0]->fancy_list_id))
			$data['default'] = $this->morder->checked($prodid, $userid, $flistdef[0]->fancy_list_id);

		$flist = $this->morder->getflistiduser($prodid, $userid);

		for ($i = 0; $i < count($flist); $i++) {
			$data[$i] = $this->morder->checked($prodid, $userid, $flist[$i]->fancy_list_id);
			$data['userdef'][] = $data[$i][0]->fancy_list_name;
		}

		$user_list = $this->morder->fancy_popup_list2($userid);
		for ($i = 0; $i < count($user_list); $i++) {
			$data['user'][] = $user_list[$i]->fancy_list_name;
		}
		if (isset($data['userdef'])) {
			$diff = array_diff($data['user'], $data['userdef']);
			foreach ($diff as $key => $val) {
				$diff_arr[] = $val;
				$data['diff_arr'] = array_merge($diff_arr);
			}
		} else
			$data['user'] = $this->morder->fancy_popup_list2($userid);
		$data['def'] = $this->morder->fancy_popup_list1($prodid, $userid);
//                        var_dump($data['userdef']);
//                        var_dump($data['default']['0']);
//                        var_dump($data['diff_arr']);
		$this->load->view('categoryAjax1', $data);
	}

	function fancy_product_fetchpop1()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		//$data['type']=$this->input->get('type', TRUE);
		$userid = $this->session->userdata('id');
		$data['def'] = $this->morder->fancy_popup_list1($prodid, $userid);
		$data['user'] = $this->morder->fancy_popup_list2($userid);
		$this->load->view('categoryAjax', $data);
	}

	function fancy_list_add()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		$listname = $this->input->get('name', TRUE);
		//$data['type']=$this->input->get('type', TRUE);
		$userid = $this->session->userdata('id');
		$this->morder->fancy_addlist($listname, $prodid, $userid);
		$data['def'] = $this->morder->fancy_popup_list1($prodid, $userid);
		$data['user'] = $this->morder->fancy_popup_list2($userid);
		$this->load->view('categoryAjax', $data);
	}

	function fancy_product_update()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		$userid = $this->session->userdata('id');
		$this->morder->remove_fancy_product($prodid, $userid);
		//$postdata=array();
		$post = $this->input->get('postdata', TRUE);
		$postdata = explode(',', $post);
		for ($i = 0; $i < count($postdata); $i++) {
			$this->morder->save_fancy_product($prodid, $userid, $postdata[$i]);
		}
	}

	function fancy_list_proddetail($flistid)
	{
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$this->load->model('user_info_model');
		$this->load->model('morder');
		$data['prods'] = $this->morder->list_product_details($this->session->userdata('id'), $flistid);
		$this->load->view('rightpanel', $data);
	}

	function badge_success($badge_type = 0)
	{
		$this->load->model('badges');
		$this->badges->badge_popup_success($this->session->userdata('id'), $badge_type);
	}

	function homepage_afterlogin_lazyloading($fff)
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$data['base_url'] = base_url();
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$this->load->model('morder');
		$this->load->model('user_info_model');
		$this->load->model('poll_model');
		if ($this->session->userdata('id'))
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
		else
			$fancy = $this->categoriesdb->fancy_prods(0);
		//var_dump($fancy);
		//$fprod = $this->morder->alluser_fancied_product();
		//$data['fprod'] = array_slice($fprod, intval($fff),6 );
		$fprod = $this->morder->alluser_fancied_product_optimized($fff);
		$data['fprod'] = $fprod;
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
		if ($this->session->userdata('id'))
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
		else
			$poll_prods = $this->poll_model->my_poll_products(0);
		foreach ($poll_prods as $p_item) {
			$data['poll_prods'][$p_item->product_id] = 1;
		}
		//End poll
		$this->load->view('homepage_lazyloading', $data);
	}

	public function login()
	{
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to login via homepage_afterlogin popup');
		$temp1 = $this->input->post('signin_email');
		$temp2 = $this->input->post('signin_pw');
		$status = (int)$this->signup->sign_in($temp1, $temp2);
		log_message('INFO', 'data for user from '.$this->input->ip_address().' \$status = '.$status);
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to login with email: '.$temp1.' and password '.$temp2);
		if ($status == 0)
		{
			echo "Invalid E-Mail ID";
			log_message('INFO', 'someone from '.$this->input->ip_address().' was trying to login with email: '.$temp1.' and password '.$temp2.' and provided wrong email ID');
		}
		elseif ($status == -1)
		{
			echo "You entered incorrect password!";
			log_message('INFO', 'someone from '.$this->input->ip_address().' was trying to login with email: '.$temp1.' and password '.$temp2.' and provided wrong password');
		}
		else
		{
			log_message('INFO', 'someone from '.$this->input->ip_address().' was trying to login with email: '.$temp1.' and password '.$temp2.' and and are now being logged-in with userID: '.$status);
			$sess = array('id' => $status, 'logged_in' => TRUE);
			if($this->session->set_userdata($sess))
			{
				log_message('ERROR', 'UNABLE TO SET SESSION');
				log_message('ERROR', 'DUMPING SESSION DATA'.print_r($this->session->all_userdata(), TRUE));
			}
			echo "logged_in";
			log_message('INFO', 'DUMPING SESSION DATA'.print_r($this->session->all_userdata(), TRUE));
		}
	}
	
	public function login2($temp1, $temp2)
	{
		$temp1 = mysql_real_escape_string($temp1);
		$temp2 = mysql_real_escape_string($temp2);
		$status = (int)$this->signup->sign_in($temp1, $temp2);
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to login via homepage_afterlogin popup');
		log_message('INFO', 'someone from '.$this->input->ip_address().' is trying to login with email: '.$temp1.' and password '.$temp2);
		if ($status == 0)
		{
			echo "Invalid E-Mail ID";
			log_message('INFO', 'someone from '.$this->input->ip_address().' was trying to login with email: '.$temp1.' and password '.$temp2.' and provided wrong email ID');
		}
		elseif ($status == -1)
		{
			echo "You entered incorrect password!";
			log_message('INFO', 'someone from '.$this->input->ip_address().' was trying to login with email: '.$temp1.' and password '.$temp2.' and provided wrong password');
		}
		else
		{
			log_message('INFO', 'someone from '.$this->input->ip_address().' was trying to login with email: '.$temp1.' and password '.$temp2.' and and are now being logged-in with userID: '.$status);
			$sess = array('id' => $status, 'logged_in' => TRUE);
			$this->session->set_userdata($sess);
			echo "logged_in";
		}
	}

	public function signup()
	{
		$temp['email'] = $this->input->post('signup_email');
		$temp['fname'] = $this->input->post('signup_fname');
		$temp['lname'] = $this->input->post('signup_lname');
		$temp['pw1'] = $this->input->post('signup_pw1');
		$temp['pw2'] = $this->input->post('signup_pw2');
		$temp['gender'] = $this->input->post('signup_gender');
		$temp['trafficID'] = ( ($this->session->userdata('tID') !== FALSE)? $this->session->userdata('tID'): 0);

		$signup_case = $this->signup_validate($temp['email']);

		if ($signup_case[0] == "CaseA") //already existing member(2 cases)
		{
			if ($signup_case[2] == 'non-fb-member') //non fb-member re-tries signup
			{
				die('existing_signup_user');
			} else //fb-member tries to signup through email
			{
				die('existing_facebook_user');
			}
		} elseif ($signup_case[0] == "CaseB") //create new user(non-existing previously)
		{
			if ($this->dataValidate($temp) == 1) {
				$this->create_new_user($temp);
				die('sign_up_success');
			} else //(html form manipulation/javascript bypass or sql-injection error)
			{
				die('validation_error');
			}
		}
	}

	public function create_new_user($user_details)
	{
		$user_id = $this->signup->create_user($user_details);
		$path = "assets/images/users/$user_id";
		if (mkdir($path, 0777)) {
			$img1 = file_get_contents('assets/images/default/defbig.jpg');
			$img2 = file_get_contents('assets/images/default/defsmall.jpg');
			$file1 = "assets/images/users/$user_id/" . $user_id . '_large.jpg';
			$file2 = "assets/images/users/$user_id/" . $user_id . '.jpg';
			file_put_contents($file1, $img1);
			file_put_contents($file2, $img2);
		}
		$sess = array('id' => $user_id, 'logged_in' => TRUE);
		$this->session->set_userdata($sess);
		return $user_id;
	}

	public function signup_validate($email)
	{
		//See if Email ID exists:
		$sql = "SELECT user_id,fb_uid,COUNT(*) AS count FROM user_details WHERE email ='" . $email . "'";
		$query = $this->db->query($sql);
		$row = $query->row();
		if ($row->count > 0)
			return array("CaseA", $row->user_id, $row->fb_uid);
		else
			return array("CaseB", 0, 0);
	}

	public function dataValidate($user_details)
	{
		if ($user_details['pw1'] != $user_details['pw2'])
			return 0;
		elseif ($user_details['pw1'] == '' or $user_details['pw2'] == '')
			return 0; elseif ($user_details['fname'] == '' or $user_details['lname'] == '')
			return 0; elseif ($user_details['email'] == '')
			return 0; else return 1;
	}

	function fancy_product_addlist_contest()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		$userid = $this->session->userdata('id');
		$this->morder->save_fancy_product_contest($prodid, $userid);
		$this->morder->fancy_product_increment($storeid, $prodid);
		$data = $this->morder->get_product_fancy($storeid, $prodid);
		echo ($data['0']->fancy_counter);
	}


}?>
