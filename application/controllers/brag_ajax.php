<?php
class Brag_Ajax extends CI_Controller
{
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

		$this->load->model('brag');
		if (!$this->session->userdata('id')) {
			//Added by lee
			log_message('Info', "User Session Broke for the user with ip: " . $this->input->ip_address() . " While he was in: $page.");
			//$red_url = base_url('user_info/homepage_afterlogin');
			//redirect($red_url);
		}
	}

	//For Adding the ajax functionality refer C:\wamp\www\GitFork\brag.php
	// Added by lee - Bragg start()

	function product_brag()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$prodid = $this->input->get('product_id', TRUE);
		$userid = $this->session->userdata('id');
		$this->brag->brag_product($prodid, $userid);
		$this->brag->increment_product_brag_count($storeid, $prodid);
		$data = $this->brag->get_product_brag_count($storeid, $prodid);
		echo ($data['0']->brag_counter);
	}

	function store_brag()
	{
		$storeid = $this->input->get('store_id', TRUE);
		$userid = $this->session->userdata('id');
		$this->brag->brag_store($storeid, $userid);
		$this->brag->increment_store_brag_count($storeid);
		$data = $this->brag->get_store_brag_count($storeid);
		echo ($data['0']->brag_counter);
	}

}

?>