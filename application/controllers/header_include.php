<?php
date_default_timezone_set('Asia/Kolkata');
/* WWW FIX BY SHAMMI SHAILAJ */
$baseURL = base_url();
$this->load->model('async_model');
$currentPageURL = $this->async_model->currentPageURL();
log_message('INFO', 'Current page URL = '.print_r($currentPageURL, TRUE));
log_message('INFO', 'baseURL = '.$baseURL);
if(stripos($currentPageURL, 'www.', 0) !== FALSE)
{
	$search = "www.";
	$replaceWith = "";
	$searchInside = $currentPageURL;
	$numberOfTimesToReplace = 1;
	$redirectURL = str_ireplace($search, $replaceWith, $searchInside, $numberOfTimesToReplace);
	log_message('INFO', 'Redirecting from '.$currentPageURL.' to '.$redirectURL.' for angular compatibility until Bimal finds a fix!');
	redirect($redirectURL);
}
/* END SECTION WWW FIX BY SHAMMI SHAILAJ */
/* NEW CODE BY SHAMMI SHAILAJ FOR NEW HEADER */
$data['baseURL'] = base_url();
$isLoggedIN = $this->async_model->isLoggedIN();
$data['isLoggedIN'] = $isLoggedIN;
switch($isLoggedIN['status'])
{
	case TRUE: $data['userDetails'] = $this->async_model->userDetails($isLoggedIN['uid']);
				$data['headerData'] = $this->async_model->headerData($isLoggedIN['uid']);
		break;
	case FALSE: $data['userDetails'] = NULL;
				$data['headerData'] = NULL;
}
$data['currentPageURL'] = $this->async_model->currentPageURL();
$data['cats'] = $this->async_model->catsData3();
/* END SECTION NEW CODE BY SHAMMI SHAILAJ FOR NEW HEADER */
if ($this->input->ip_address() == '10.138.163.22') {
	log_message('Info', 'The following Ip: ' . $this->input->ip_address() . ' is added to blacklist.');
	exit();
}
$logged_id = $this->session->userdata('id');

//Load models, libraries, config files, etc. from here
$this->load->model('morder');
$this->load->library('fb_connect');
$this->config->load('facebook', TRUE);
//$this->load->model('badges');
//$this->load->model('poll_model');

$current_url = current_url();
if (!empty($url_suffix))
	$current_url = strstr($current_url, $url_suffix, TRUE);
$curl = explode('/', $current_url);
$site_url = explode('/', site_url()); //Gets the site url. e.g.: http(s)://www.hostname.com/index.php
$params = array_diff($curl, $site_url); //Seperates the [controller]/[function]/[param1]/[param2] and is stored in $params.
$page = implode('/', $params);

if (empty($logged_id)) //CI Session Break or Session not set. Default values for the variables those needs userdetails has to be stored in here...
{
	//$red_url = site_url('user_info/homepage_afterlogin/cart/shopping_cart');
	$red_url = base_url().'login/cart/shopping_cart';
	redirect($red_url);
} else //CI Session is set. Real values for the variables those needs userdetails has to be stored in here...
{
	log_message('Info', "User with userid: " . $this->session->userdata('id') . " and ip: " . $this->input->ip_address() . " is accessing: $page.");
	if (!$this->fb_connect->user_id) {
		$this->load->model('fb_model');
		$fb_uid = $this->fb_model->fbuid();
		$data['fb_uid'] = $fb_uid[0]['fb_uid'];
	} else {
		$data['fb_uid'] = $this->fb_connect->user_id;
	}
	//Varaibles which needs userid or userdetails.
	//$data['cart'] = $this->cartdb->mycartforuser($this->session->userdata('id'));
	$data['userDetails'] = $this->morder->userdetails($this->session->userdata('id'), "address, city, state, country, pin, email, fb_uid AS FBID, full_name AS fullName, gender");
	$data['user_id'] = $this->session->userdata('id');
	//$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));
	// User Badges
	//Badges Popup for type 1 to 6
	/*for ($ii = 1; $ii < 7; $ii++) {
		$badge_popup[$ii] = $this->badges->badge_alert($this->session->userdata('id'), $ii);
		$data['badge_level'][$ii] = $badge_popup[$ii][0];
		$data['badge_notify'][$ii] = $badge_popup[$ii][1];
	}
	for ($ii = 71; $ii < 76; $ii++) {
		$badge_popup[$ii] = $this->badges->badge_alert($this->session->userdata('id'), $ii);
		$data['badge_level'][$ii] = $badge_popup[$ii][0];
		$data['badge_notify'][$ii] = $badge_popup[$ii][1];
	}*/
	//S-> FFF
	//$this->load->model('friends_follow_model');
	//$data['followers'] = $this->friends_follow_model->get_followers($this->session->userdata('id'));
	//$data['followees'] = $this->friends_follow_model->get_followees($this->session->userdata('id'));
	//$data['friends'] = $this->friends_follow_model->get_friends($this->session->userdata('id'));
	//E-> FFF
	//S-> Counter in Dropdown
	//$data['count_fancy'] = count($this->morder->cfprod($this->session->userdata('id')));
	$t = $this->cartdb->mycartforuserCount($this->session->userdata('id'));
	$data['count_cart'] = $t[0]->totalCartItems;
	//$data['count_poll'] = count($this->poll_model->pending_polls($this->session->userdata('id')));
	//$data['count_order'] = count($this->cartdb->new_order_history());
	//$data['count_badge'] = count($this->badges->user_badge($this->session->userdata('id')));
	$data['my_rank'] = $this->morder->myrank($this->session->userdata('id'));
	//E-> Counter in Dropdown
}

/* BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */
/*$data['sale'] = $this->categoriesdb->header_sale();
//echo count($data['sale']);
$sale_prod = array();
//    for($i=0 ; $i < 7 ; $i++)
for ($i = 0; $i < count($data['sale']); $i++) {
	$sale_prod[] = $this->categoriesdb->header_sale_product($data['sale'][$i]->category);
}
$data['sale_prod'] = $sale_prod;*/
/* END SECTION BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */
//Variables and DB data for Header
//Varaibles which doesn't need userid or userdetails.
$data['base_url'] = base_url();
$data['cur_url'] = $current_url;
/* BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */
/*$data['catlist'] = $this->categoriesdb->catlist();
$data['hcatproducts'] = $this->categoriesdb->catprod(0);
$data['hcatstore'] = $this->categoriesdb->catstore(0);*/
/* END SECTION BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */
$config = $this->config->item('facebook');
$data['app_id'] = $config['appId'];
$this->config->load('payu', TRUE);
$myconfig = $this->config->item('payu');
$data['store_url'] = $myconfig['store_url'];
$this->load->view('header2', $data);
?>