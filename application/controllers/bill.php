<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bill extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('order');
		$this->load->model('products');
		$this->load->model('store_model');
		$this->load->model('design');
		$this->load->model('cartdb');
		$this->load->model('morder');
		$this->load->model('promotion');
		$this->load->model('bill_model');
		$this->load->model('categoriesdb');
		$this->load->model('login_model');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('javascript');
		$this->load->helper(array('form'));
		//$this->load->library('jquery');
		$this->load->library('session');
	}


	function headerData()
	{
		$data['base_url'] = base_url();
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data['css'] = $this->config->item('css');


		$data['catlist'] = $this->categoriesdb->catlist();
		$data['hcatproducts'] = $this->categoriesdb->catprod(0);
		$data['hcatstore'] = $this->categoriesdb->catstore(0);
		$data['cart'] = $this->cartdb->mycartforuser($this->session->userdata('store_id'));
		$data['storeownerdetails'] = $this->login_model->ownerdetails($this->session->userdata('store_id'));

		//Session validation
		if ($this->session->userdata('logged_in_seller') != TRUE) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$data['user_id'] = $this->session->userdata('store_id');
		$this->load->view('header2_seller', $data);
	}


	///added by Rajeeb :Discount Summary

	function allbill($store_id)
	{
        if($this->session->userdata('store_id')!=$store_id)
        {
            redirect(base_url().'index.php/login/seller');
        }

        $this->headerData();
        $data['base_url'] = base_url();
        $data['css'] = $this->config->item('css');
        $data['store_info'] = $this->order->getStoreIdOrder($store_id);
        $data['bill']=$this->bill_model->allbills($store_id);
        $this->load->view('bill',$data);
//		redirect(base_url() . 'index.php/dashboard/allproductspage/' . $store_id);
	}

	function billsAjax()
	{

		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');

		$status = $this->input->get('status', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['status'] = $status;
		$data['bill_ajax'] = $this->bill_model->myBillAjax($status, $s_id);
		$this->load->view('billAjax', $data);
	}

	function billAjaxLoader()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');

		$status = $this->input->get('status', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['status'] = $status;
		$data['bill_ajax'] = $this->bill_model->myBillAjaxLoad($status, $limit, $s_id);
		$this->load->view('billAjax', $data);
	}
}

?>