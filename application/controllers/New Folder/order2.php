<?php
class Order2 extends CI_Controller
{
	private $userid = "";

	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();
		$this->userid = 1;
		// Your own constructor code
		$this->load->model('vc_orders'); /* lee */
		$this->load->model('morder');
		$this->load->model('cartdb');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('javascript');
		//$this->load->library('jquery');
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		//FOR HEADER
		$data['user_id'] = $this->userid;
		$data['cart'] = $this->cartdb->mycartforuser($this->userid);
		$data['userdetails'] = $this->morder->userdetails($this->userid);
		$this->load->view('header2', $data);

	}

	function checkout()
	{
		$amount = $this->input->post('amount');
		$amount = number_format($amount, 2);
		$data['amount'] = $amount;
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$this->load->view('checkout', $data);
	}

	function checkout_second()
	{
		include_once('forminput.php');
		print_r($data);
		echo br(2);
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$this->load->view('checkout_second', $data);
	}

	function checkout_third()
	{
		include_once('forminput.php');
		$pg = $this->input->post('pg');
		if ($pg == "CC")
			$pg = "Credit Card/EMI";
		elseif ($pg == "DC")
			$pg = "Debit Card"; elseif ($pg == "NB")
			$pg = "Net Banking"; else
			$pg = "Cash On Delivery";
		$input = array('pg' => "$pg");
		$data = array_merge($data, $input);
		print_r($data);
		echo br(2);
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$this->load->view('checkout_third', $data);
	}

	function checkout_third_cod()
	{
		include_once('forminput.php');
		$pg = $this->input->post('pg');
		if ($pg == "CC")
			$pg = "Credit Card/EMI";
		elseif ($pg == "DC")
			$pg = "Debit Card"; elseif ($pg == "NB")
			$pg = "Net Banking"; else
			$pg = "Cash On Delivery";
		$input = array('pg' => "$pg");
		$data = array_merge($data, $input);
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$this->load->view('checkout_third_cod', $data);
	}

	//Success Page after checkout - placing the order "AS"
	function pay_status_s()
	{

		include_once('forminput.php');
		$mihpayid = $this->input->post('mihpayid');
		$mode = $this->input->post('mode');
		$status = $this->input->post('status');
		$key = $this->input->post('key');
		$productinfo = $this->input->post('productinfo');
		$txnid = $this->input->post('txnid');
		$offer = $this->input->post('offer');
		$error = $this->input->post('error');
		$pg_type = $this->input->post('pg_type');
		$bank_ref_num = $this->input->post('bank_ref_num');
		$hash = $this->input->post('hash');
		$salt = "3sf0jURk";
		$input = array('mihpayid' => "$mihpayid",
			'mode' => "$mode",
			'status' => "$status",
			'key' => "$key",
			'productinfo' => "$productinfo",
			'txnid' => "$txnid",
			'offer' => "$offer",
			'error' => "$error",
			'pg_type' => "$pg_type",
			'bank_ref_num' => "$bank_ref_num",
			'hash' => "$hash"
		);
		$data = array_merge($data, $input);
		$text = "$salt|$status|||||||||||$email|$firstname|$productinfo|$amount|$txnid|$key";
		$output = hash("sha512", $text);
		echo $data['firstname'];

//                        echo "$output";
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
//Lee Finished <--			
		$data['cart'] = $this->cartdb->mycartforuser($this->userid);
		$cartinfo = $data['cart'];
		for ($i = 0; $i < count($data['cart']); $i++) {
			$pass = $this->vc_orders->place_order($cartinfo[$i], $data);
			if ($pass)
				$this->vc_orders->deletecart($cartinfo[$i]);
		}
		$this->load->view('tsuccess', $data);
//AS <--
	}

	function pay_status_f()
	{
		$data['base_url'] = base_url();
		$this->load->view('tfailed', $data);
	}


}

?>