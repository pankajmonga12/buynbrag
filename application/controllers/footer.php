<?php
class Footer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('javascript');
	}

	function index($openSellerLoginModal = FALSE)
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		if($openSellerLoginModal !== FALSE)
		{
			$this->how_it_works($openSellerLoginModal);
		}
		$this->load->view('footer', $data);
	}

	function rules_policies()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('rules_policies', $data);
	}

	function how_it_works($openSellerLoginModal = FALSE)
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$data["openModal"] = $openSellerLoginModal;
		$this->load->view('how_it_works', $data);
	}

	function seller_registration()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('seller_registration', $data);
	}

	//Buyers Info FINAL
	function payment_policies()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('payment_policies', $data);
	}

	function buyer_interest()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('buyer_interest', $data);
	}

	function other_policy()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('other_policy', $data);
	}

	function shipping_delivery()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('shipping_delivery', $data);
	}

	function cancellation_policy()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('cancellation_policy', $data);
	}

	function user_agreement()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('user_agreement', $data);
	}

	function contact()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('contact', $data);
	}

	//Final
	function why_bnb()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('why_bnb', $data);
	}

	function take_the_tour()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('take_the_tour', $data);
	}

	function team()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('team', $data);
	}

	function bnb_news()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('bnb_news', $data);
	}

	function careers()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('careers', $data);
	}

	function about_us()
	{
		include 'header_for_controller.php';
		$data['base_url'] = base_url();
		$this->load->view('about_us', $data);
	}

}

?>