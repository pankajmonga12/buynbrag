<?php
class Ajax_poll extends CI_Controller
{
	private $userid = "";

	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();

		//Added by lee
		$url_suffix = $this->config->item('url_suffix'); //Gets the Url suffix if any is set in config file.
		$current_url = current_url(); //Gets the current url. e.g.: http(s)://www.hostname.com/index.php/[controller]/[function]/[param1]/[param2]
		if (!empty($url_suffix))
			$current_url = strstr($current_url, $url_suffix, TRUE);
		$curl = explode('/', $current_url);
		$site_url = explode('/', site_url()); //Gets the site url. e.g.: http(s)://www.hostname.com/index.php
		$params = array_diff($curl, $site_url); //Seperates the [controller]/[function]/[param1]/[param2] and is stored in $params.
		$page = implode('/', $params);
		log_message('Info', "User with userid: " . $this->session->userdata('id') . " and ip: " . $this->input->ip_address() . " is accessing: $page via ajax.");

		//Session validation
		if (!$this->session->userdata('id')) {
			//Added by lee
			log_message('Info', "User Session Broke for the user with ip: " . $this->input->ip_address() . " While he was in: $page.");
			$red_url = base_url('user_info/homepage_afterlogin');
			redirect($red_url);
		}
		$this->load->model('morder');
		//Dont EDIT the above code

		// Your own constructor code

		$this->load->library('javascript');
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');
	}


	function ajax_poll1($poll_id, $type)
	{
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$this->load->model('poll_model');
		$poll_detail = $this->poll_model->poll_details($poll_id);

		if ($type == 1) //POLL QUESTION
		{
			echo $poll_detail[0]->poll_quest; ?>
			<script type="text/javascript">
				$(function () {
					$(".pollItemName").each(function () {

						var len = 32;
						var trunc = $(this).text();
						if ($(this).text().length > len) {
							/* Truncate the content of the P, then go back to the end of the
							 previous word to ensure that we don't truncate in the middle of
							 a word */
							$(this).attr("title", trunc);

							$(this).addClass("showtooltip2");

							trunc = trunc.substring(0, len);
							trunc = trunc.replace(/\w+$/, '');

							trunc += '..';

							$(this).html(trunc);
						}
					});
					tooltip2();
				});
			</script> <?php
		} elseif ($type == 2) //POLL START DATE
		{
			echo date('M d', strtotime($poll_detail[0]->poll_start_date));

		} elseif ($type == 3) //DETAILS OF PRODUCT1
		{
			$poll_prod1 = $this->poll_model->poll_products($poll_detail[0]->product_id_1);
			if ($poll_detail[0]->product_id_1 > 0) {
				$votes = $this->poll_model->poll_votes($poll_id, 1);
				$leave = $this->poll_model->poll_votes($poll_id, 9);
				echo "<div class=\"pollItemImg\">
				<img width = 200 src=\"" . $myconfig['store_url'] . "assets/images/stores/" . $poll_prod1[0]->store_id . "/" . $poll_prod1[0]->product_id . "/img1_240x200.jpg\" alt=\"Polldfdsfdsf Item\" /></div>
                <div class=\"pollItemName\">" . $poll_prod1[0]->product_name . "</div>
                <div class=\"pollItemInfo\"><span class=\"rupeePoll\">` </span><span class=\"rockwellBold\">" . $poll_prod1[0]->selling_price . "</span></div>
				<div class=\"pollItemStore\">from <strong>" . $poll_prod1[0]->store_name . "</strong></div>
				<div class=\"pollItemLastRow\">";

				if ($poll_detail[0]->poll_type == 1)
					echo "<div class=\"noOfVotes\">" . $votes[0]->votes . " Love</div>" .
						"<div class=\"noOfVotes\">" . $leave[0]->votes . " Leave</div>";
				else echo "<div class=\"noOfVotes\">" . $votes[0]->votes . " Votes</div>";

				echo "<div class=\"pollInfoComm\">
				<div class=\"pollInfoIcon\" id=\"pollInfoIcon_1\" onClick=\"return funcPollInfo(1)\"></div>
				";
			} else echo "blank";

		} elseif ($type == 4) //DETAILS OF PRODUCT2
		{
			$poll_prod2 = $this->poll_model->poll_products($poll_detail[0]->product_id_2);
			if ($poll_detail[0]->no_of_items > 1) {
				$votes = $this->poll_model->poll_votes($poll_id, 2);
				echo "<div class=\"pollItemImg\">
				<img width = 200 src=\"" . $myconfig['store_url'] . "assets/images/stores/" . $poll_prod2[0]->store_id . "/" . $poll_prod2[0]->product_id . "/img1_240x200.jpg\" alt=\"Polldfdsfdsf Item\" /></div>
                <div class=\"pollItemName\">" . $poll_prod2[0]->product_name . "</div>
                <div class=\"pollItemInfo\"><span class=\"rupeePoll\">` </span><span class=\"rockwellBold\">" . $poll_prod2[0]->selling_price . "</span></div>
				<div class=\"pollItemStore\">from <strong>" . $poll_prod2[0]->store_name . "</strong></div>
				<div class=\"pollItemLastRow\">
				<div class=\"noOfVotes\">" . $votes[0]->votes . " Votes</div>
				<div class=\"pollInfoComm\">
				<div class=\"pollInfoIcon\" id=\"pollInfoIcon_1\" onClick=\"return funcPollInfo(2)\"></div>
				";
			} else echo "";

		} elseif ($type == 5) //DETAILS OF PRODUCT3
		{
			$poll_prod3 = $this->poll_model->poll_products($poll_detail[0]->product_id_3);
			if ($poll_detail[0]->no_of_items > 2) {
				$votes = $this->poll_model->poll_votes($poll_id, 3);
				echo "<div class=\"pollItemImg\">
				<img width = 200 src=\"" . $myconfig['store_url'] . "assets/images/stores/" . $poll_prod3[0]->store_id . "/" . $poll_prod3[0]->product_id . "/img1_240x200.jpg\" alt=\"Polldfdsfdsf Item\" /></div>
                <div class=\"pollItemName\">" . $poll_prod3[0]->product_name . "</div>
                <div class=\"pollItemInfo\"><span class=\"rupeePoll\">` </span><span class=\"rockwellBold\">" . $poll_prod3[0]->selling_price . "</span></div>
				<div class=\"pollItemStore\">from <strong>" . $poll_prod3[0]->store_name . "</strong></div>
				<div class=\"pollItemLastRow\">
				<div class=\"noOfVotes\">" . $votes[0]->votes . " Votes</div>
				<div class=\"pollInfoComm\">
				<div class=\"pollInfoIcon\" id=\"pollInfoIcon_1\" onClick=\"return funcPollInfo(3)\"></div>
				";
			} else echo "";

		} elseif ($type == 6) //INFORMATION(i) OF PRODUCT1
		{
			$poll_prod1 = $this->poll_model->poll_products($poll_detail[0]->product_id_1);
			if ($poll_detail[0]->product_id_1 > 0) {
				echo "<div class=\"pollInfoHeader\">
				<div class=\"fl\">
				<div class=\"pollItemNameBig\">" . $poll_prod1[0]->product_name . "</div>
				<div class=\"pollItemStoreBig\">from <span class=\"storeName\">" . $poll_prod1[0]->store_name . "</span>
				<div class=\"fr\"><button type=\"button\" id=\"add_to_cart_1\" name=\"add_to_cart_1\" class=\"add_to_cart\">
				<div class=\"pollItemPrice\"><span class=\"rupeePollBig\">`</span>
				" . $poll_prod1[0]->selling_price . "</div>
				</button>
				</div></div>
				<div class=\"pollItemInfoRow paddingTop25\">" . $poll_prod1[0]->description . "</div>
				<div class=\"pollItemInfoRow\">Tags:" . $poll_prod1[0]->tags . "</div>
				<div class=\"pollItemInfoRow\">Weight: " . $poll_prod1[0]->prd_act_weight . "</div>
				<div class=\"pollItemInfoRow\">Style: " . $poll_prod1[0]->style . "</div>";
			} else echo "";

		} elseif ($type == 7) //INFORMATION(i) OF PRODUCT2
		{
			$poll_prod2 = $this->poll_model->poll_products($poll_detail[0]->product_id_2);
			if ($poll_detail[0]->no_of_items > 1) {
				echo "<div class=\"pollInfoHeader\">
				<div class=\"fl\">
				<div class=\"pollItemNameBig\">" . $poll_prod2[0]->product_name . "</div>
				<div class=\"pollItemStoreBig\">from <span class=\"storeName\">" . $poll_prod2[0]->store_name . "</span>
				<div class=\"fr\"><button type=\"button\" id=\"add_to_cart_1\" name=\"add_to_cart_1\" class=\"add_to_cart\">
				<div class=\"pollItemPrice\"><span class=\"rupeePollBig\">`</span>
				" . $poll_prod2[0]->selling_price . "</div>
				</button>
				</div></div>
				<div class=\"pollItemInfoRow paddingTop25\">" . $poll_prod2[0]->description . "</div>
				<div class=\"pollItemInfoRow\">Tags:" . $poll_prod2[0]->tags . "</div>
				<div class=\"pollItemInfoRow\">Weight: " . $poll_prod2[0]->prd_act_weight . "</div>
				<div class=\"pollItemInfoRow\">Style: " . $poll_prod2[0]->style . "</div>";
			} else echo "";

		} elseif ($type == 8) //INFORMATION(i) OF PRODUCT3
		{
			$poll_prod3 = $this->poll_model->poll_products($poll_detail[0]->product_id_3);
			if ($poll_detail[0]->no_of_items > 3) {
				echo "<div class=\"pollInfoHeader\">
				<div class=\"fl\">
				<div class=\"pollItemNameBig\">" . $poll_prod3[0]->product_name . "</div>
				<div class=\"pollItemStoreBig\">from <span class=\"storeName\">" . $poll_prod3[0]->store_name . "</span>
				<div class=\"fr\"><button type=\"button\" id=\"add_to_cart_1\" name=\"add_to_cart_1\" class=\"add_to_cart\">
				<div class=\"pollItemPrice\"><span class=\"rupeePollBig\">`</span>
				" . $poll_prod3[0]->selling_price . "</div>
				</button>
				</div></div>
				<div class=\"pollItemInfoRow paddingTop25\">" . $poll_prod3[0]->description . "</div>
				<div class=\"pollItemInfoRow\">Tags:" . $poll_prod3[0]->tags . "</div>
				<div class=\"pollItemInfoRow\">Weight: " . $poll_prod3[0]->prd_act_weight . "</div>
				<div class=\"pollItemInfoRow\">Style: " . $poll_prod3[0]->style . "</div>";
			} else echo "";

		}
	}

	public function vote_product($poll_id, $p_type)
	{
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$this->load->model('poll_model');
		$this->poll_model->vote_on($poll_id, $p_type, $this->session->userdata('id'));
		$this_poll = $this->poll_model->poll_details($poll_id);
		if ($this_poll[0]->poll_type == 1) {
			$votes = $this->poll_model->poll_votes($poll_id, 1);
			$leave = $this->poll_model->poll_votes($poll_id, 9);
			echo $votes[0]->votes . " Love,";
			echo $leave[0]->votes . " Leave";
		} else {
			$votes = $this->poll_model->poll_votes($poll_id, $p_type);
			echo $votes[0]->votes . " Votes";
		}

	}

	public function add_to_poll($product_id)
	{
		$this->load->model('poll_model');
		$this->poll_model->add_to_poll_list($product_id, $this->session->userdata('id'));
		echo "ADDED";
	}


}



?>
