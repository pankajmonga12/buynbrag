<?php
log_message("INFO", "Starting header for controller==========================");
$data['base_url'] = base_url();

log_message("INFO", "base URL: ".$data['base_url']);

/*$currentMemUsage = memory_get_usage(TRUE);
log_message("INFO", "Current Memory usage: ".($currentMemUsage/1024)."KB");*/
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
log_message("INFO", "loaded all new header data");
/*$currentMemUsage = memory_get_usage(TRUE);
log_message("INFO", "Current Memory usage: ".($currentMemUsage/1024)."KB");*/
if ($this->input->ip_address() == '10.138.163.22')
{
	log_message('Info', 'The following Ip: ' . $this->input->ip_address() . ' is added to blacklist.');
	exit();
}
$logged_id = $this->session->userdata('id'); // Gets the user_id stored in session.
$url_suffix = $this->config->item('url_suffix'); //Gets the Url suffix if any is set in config file.
$current_url = current_url(); //Gets the current url. e.g.: http(s)://www.hostname.com/index.php/[controller]/[function]/[param1]/[param2]
$home_page = site_url('homepage');
$loginURL = site_url('login');
$pos = strpos($current_url, 'homepage');
if (!empty($url_suffix))
	$current_url = strstr($current_url, $url_suffix, TRUE);
$curl = explode('/', $current_url);
$site_url = explode('/', site_url()); //Gets the site url. e.g.: http(s)://www.hostname.com/index.php
$params = array_diff($curl, $site_url); //Seperates the [controller],[function],[param1],[param2] and is stored in $params.
$page = implode('/', $params); //Combines the [controller],[function],[param1],[param2] using '/'.
/*if ($current_url != $home_page && empty($logged_id) && $pos === FALSE)*/
/*if( $current_url != $loginURL && empty($logged_id) )
{
	//Handle if [Main-Controller]/[Main-Function] is not user_info/homepage_afterlogin
	//$red_url = implode('/',$params);
	$footerCheck = strpos($current_url, 'footer');
	if ($footerCheck === FALSE) {
		//If the url doesnot contain footer allow user to view the page.
		$red_url = site_url('login/user/' . $page);
		redirect($red_url, 'Location');
	} else {
		$data['footer'] = $footerCheck;
	}
}
else
{
	//Handle if [Main-Controller]/[Main-Function] is user_info/homepage_afterlogin
}*/

//Load models, libraries, config files, etc. from here
$data['cur_url'] = $current_url;
log_message("INFO", "cur URL: ".$data['cur_url']);

$this->load->model('morder');
$this->load->library('fb_connect');
$this->config->load('facebook', TRUE);
$this->load->model('badges');
$this->load->model('poll_model');

if (empty($logged_id)) //CI Session Break or Session not set. Default values for the variables those needs userdetails has to be stored in here...
{
	log_message('Info', "User with ip: " . $this->input->ip_address() . " is accessing: $page WITHOUT CREATING SESSION.");
	$data['fb_uid'] = 0;
	$data['user_id'] = 0;
	$data['cart'] = 0;
	$data['userdetails'] = 0;
	$data['countfprod'] = 0;
	$data['friends'] = 0;
	$data['followers'] = 0;
	$data['followees'] = 0;
	$data['count_fancy'] = 0;
	$data['count_cart'] = 0;
	$data['count_poll'] = 0;
	$data['count_order'] = 0;
	$data['count_friend'] = 0;
	$data['count_badge'] = 0;
	$data['my_rank'] = 0;

	for ($ii = 1; $ii < 7; $ii++) {
		$data['badge_level'][$ii] = 0;
		$data['badge_notify'][$ii] = 0;
	}

	for ($ii = 71; $ii < 76; $ii++) {
		$data['badge_level'][$ii] = 0;
		$data['badge_notify'][$ii] = 0;
	}
} else //CI Session is set. Real values for the variables those needs userdetails has to be stored in here...
{
	log_message('Info', "User with userid: " . $this->session->userdata('id') . " and ip: " . $this->input->ip_address() . " is accessing: $page.");

	//For Sending Welcome Email
	$this->load->model('fb_model');
	$mail_info = $this->fb_model->welcome_mail_details($this->session->userdata('id'));
	if ($mail_info != 0)
	{
		$base_url = base_url();
		$data['newuser'] = 1;
		$name = $mail_info[0]['full_name'];
		include 'mail_1.php';
		$this->load->library('email');
		$this->email->from('support@buynbrag.com', 'BuynBrag');
		$this->email->to($mail_info[0]['sent_email_id']);
		$this->email->subject("Welcome to BuynBrag, " . $mail_info[0]['full_name']);
		$this->email->message($msg);
		$this->email->set_newline("\r\n");
		if ($this->email->send()) {
			log_message('Info', 'Welcome mail has been sent succesfully to user with uid: ' . $this->session->userdata('id'));
			$this->fb_model->welcome_mail_success($this->session->userdata('id'));
		}
		else
		{
			log_message('Info', 'Welcome mail sending failed for user with uid: ' . $this->session->userdata('id'));
		}
	}
	
	//if($logged_id == '2' || $logged_id == '6' || $logged_id == '14' || $logged_id == '7' ):
	if (!$this->fb_connect->user_id)
	{
		$this->load->model('fb_model');
		$fb_uid = $this->fb_model->fbuid();
		$data['fb_uid'] = $fb_uid[0]['fb_uid'];
	}
	else
	{
		$data['fb_uid'] = $this->fb_connect->user_id;
	}
	//Varaibles which needs userid or userdetails.
	$data['cart'] = $this->cartdb->mycartforuser($this->session->userdata('id'));
	$data['userdetails'] = $this->morder->userdetails($this->session->userdata('id'));
	$data['user_id'] = $this->session->userdata('id');
	
	/*  OLD CODE to count the number of fancied items */
	
	/*$data['countfprod'] = count($this->morder->cfprod($this->session->userdata('id')));*/
	
	/* NEW CODE BY SHAMMI SHAILAJ TO COUNT THE NUMBER OF FANCIED PRODUCTS FOR A USER */
	$data['countfprod'] = $this->morder->cfprodCount($this->session->userdata('id'));
	// User Badges
	//Badges Popup for type 1 to 6
	/*for ($ii = 1; $ii < 7; $ii++)
	{
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

	//S-> Counter in Dropdown
	/*  OLD CODE to count the number of fancied items */
	
	/* $data['count_fancy'] = count($this->morder->cfprod($this->session->userdata('id'))); */
	
	/*
	NEW CODE BY SHAMMI SHAILAJ TO COUNT THE NUMBER OF FANCIED PRODUCTS FOR A USER.
	We con't need to count this time as we already have above and the result is available in $data['countfprod']
	*/
	$data['count_fancy'] = $data['countfprod'];
	
	//$data['count_cart'] = count($this->cartdb->mycartforuser($this->session->userdata('id')));
	//$data['count_poll'] = count($this->poll_model->pending_polls($this->session->userdata('id')));
	//$data['count_order'] = count($this->cartdb->new_order_history());
	//$data['count_badge'] = count($this->badges->user_badge($this->session->userdata('id')));
	//$data['my_rank'] = $this->morder->myrank($this->session->userdata('id'));
}

/* BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */
/*$data['sale'] = $this->categoriesdb->header_sale();
//echo count($data['sale']);
$sale_prod = array();
//    for($i=0 ; $i < 7 ; $i++)
for ($i = 0; $i < count($data['sale']); $i++)
{
	$sale_prod[] = $this->categoriesdb->header_sale_product($data['sale'][$i]->category);
}
$data['sale_prod'] = $sale_prod;*/
/* END SECTION BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */

//Variables and DB data for Header
//Varaibles which doesn't need userid or userdetails.

log_message("INFO", "loading catgeories data");
/*$currentMemUsage = memory_get_usage(TRUE);
log_message("INFO", "Current Memory usage: ".($currentMemUsage/1024)."KB");*/
$data['catlist'] = $this->categoriesdb->catlist();

/*
following line disabled cause it was sucking up memory
$data['hcatproducts'] = $this->categoriesdb->catprod(0);
*/

$data['hcatstore'] = $this->categoriesdb->catstore(0);
log_message("INFO", "loaded all caetgories data and its products");
/*$currentMemUsage = memory_get_usage(TRUE);
log_message("INFO", "Current Memory usage: ".($currentMemUsage/1024)."KB");*/
$config = $this->config->item('facebook');
$data['app_id'] = $config['appId'];

/* BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */
/*$mega_cats = $this->categoriesdb->mega_cat(0);

$price1 = 0;
$price2 = 0;
foreach ($mega_cats as $mega_cat) {
	$data['header_store'][$mega_cat->category_id] = $this->categoriesdb->header_store($mega_cat->category_id);
	$data['header_fancyprod'][$mega_cat->category_id] = $this->categoriesdb->header_fancycatprod($mega_cat->category_id);
	$data['sub_categories1'][$mega_cat->category_id] = $this->categoriesdb->get_cat_tree_2($mega_cat->category_id, 1, (int)$price1, (int)$price2);
	foreach ($data['sub_categories1'][$mega_cat->category_id] as $temp1) {
		$data['sub_sub_categories1'][$mega_cat->category_id][$temp1['category_id']] = $this->categoriesdb->get_cat_tree_2($temp1['category_id'], 2, (int)$price1, (int)$price2);
	}
}*/
/* END SECTION BLOCKED BY SHAMMI SHAILAJ AS PART OF THE HEADER CLEANUP PROCESS */
//    var_dump($data['header_fancyprod']);
$this->config->load('payu', TRUE);
$myconfig = $this->config->item('payu');
$data['store_url'] = $myconfig['store_url'];
log_message("INFO", "finished header_for_controller");
/*$currentMemUsage = memory_get_usage(TRUE);
log_message("INFO", "Current Memory usage: ".($currentMemUsage/1024)."KB");*/
$this->load->view('header2', $data);
?>
