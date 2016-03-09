<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Promote extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('order');
		$this->load->model('products');
		$this->load->model('store_model');
		$this->load->model('promote_discount');
		$this->load->model('design');
		$this->load->model('cartdb');
		$this->load->model('morder');
		$this->load->model('promotion');
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
	function promote_discount_single_product($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}

		$this->headerData();
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$data['store_info'] = $this->order->getStoreIdOrder($store_id);
		$this->load->view('promote_discount_single_product', $data);
	}

	function promote_discount_summary($store_id)
	{
//			if($this->session->userdata('store_id')!=$store_id)
//			{
//				redirect(base_url().'index.php/login/seller'); 
//			}
//
//			$this->headerData();
//			$data['base_url'] = base_url();
//			$data['css'] = $this->config->item('css');
//			$data['promotionList']=$this->promotion->getAllPromotions($store_id);	
//                        $data['store_info'] = $this->order->getStoreIdOrder($store_id);	
//			$this->load->view('promote_discount_summary',$data);
		redirect(base_url() . 'index.php/dashboard/allproductspage/' . $store_id);
	}

	function promotionAjax()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');

		$status = $this->input->get('status', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['promotion_ajax'] = $this->promotion->myPromotionAjax($status, $s_id);
		$data['store_id'] = $s_id;
		$data['status'] = $status;
		$this->load->view('promotionAjax', $data);
	}

	function searchPromotionAjax()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');

		$status = $this->input->get('status', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$search_val = $this->input->get('s_val', TRUE);
		$data['promotion_ajax'] = $this->promotion->myPromotionSearchAjax($status, $s_id, $search_val);
		$data['status'] = $status;
		$data['store_id'] = $s_id;
		$this->load->view('promotionAjax', $data);
	}

	function promoteAjaxLoader()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');

		$status = $this->input->get('status', TRUE);
		$pro = $this->input->get('pro', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['status'] = $status;
		$data['promotion_ajax'] = $this->promotion->myPromoteAjaxLoad($status, $s_id, $pro, $limit);
		$this->load->view('promotionAjax', $data);
	}

	function promote_product_discount($storeid, $prodid)
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$this->headerData();
		$data['mystore'] = $this->morder->mystore($storeid);
		$data['mysec'] = $this->morder->mysec($storeid);

		$data['userid'] = $this->session->userdata('store_id');

		$data['productdetails'] = $this->promotion->myprod($prodid);
		$data['myvar'] = $this->morder->myvar($prodid);

		$data['allprodondis'] = $this->morder->products($storeid);
		//FANCY
		$data['fancied'] = $this->morder->fancied_product_user($this->session->userdata('store_id'), $prodid);

		$this->load->view('promote_product_discount', $data);
	}

	function changeStatus($p_id, $status, $type)
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');

		$this->promotion->changestatus($p_id, $status, $type);
		echo base_url();
	}

	function deletepromote()
	{

		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$status = $this->input->get('status', TRUE);
		$type_to = $this->input->get('type_to', TRUE);
		$item_id = $this->input->get('item_id', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$this->promotion->deletePromote($type_to, $item_id);
		$search_val = $this->input->get('pro', TRUE);
		$data['promotion_ajax'] = $this->promotion->myPromotionSearchAjax($status, $s_id, $search_val);
		$data['status'] = $status;
		$this->load->view('promotionAjax', $data);

	}

	function editpromote($store_id, $type_to, $item_id)
	{
		$this->headerData();
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$data['items'] = $this->promotion->getPromote($type_to, $item_id, $store_id);
		$data['isedit'] = 1;
		$data['type'] = $type_to;
		$data['catlist'] = $this->promote_discount->shopSectionCatlist($store_id);
		$data['store_info'] = $this->order->getStoreIdOrder($store_id);
		$data['allproducts'] = $this->promote_discount->myproducts($store_id, "");
		$data['total_products'] = count($data['allproducts']);
		$this->load->view('promote_discount_single_product', $data);


	}


	/* Promote module */
	function add_promote_discount($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}

		$this->headerData();

		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$data['isedit'] = 0;
		$data['catlist'] = $this->promote_discount->shopSectionCatlist($store_id);
		$data['store_info'] = $this->order->getStoreIdOrder($store_id);
		$data['allproducts'] = $this->promote_discount->myproducts($store_id, "");
		$data['total_products'] = count($data['allproducts']);
		$this->load->view('promote_discount_single_product', $data);
	}

	function promoteContents()
	{
		$typeID = $this->input->get('typeID', TRUE);
		$s_id = $this->input->get('store_id', TRUE);

		$data['allproducts'] = $this->promote_discount->myproducts($s_id, $typeID);
		$data['total_products'] = count($data['allproducts']);
		$this->load->view('promote_contents', $data);
	}

	function promoteApplies()
	{
		$typeID = $this->input->get('typeID', TRUE);
		$s_id = $this->input->get('store_id', TRUE);

		$data['allproducts'] = "";
		$this->load->view('promote_applies', $data);
	}

	function promoteRightCategoriesApplies()
	{
		$typeID = $this->input->get('typeID', TRUE);
		$s_id = $this->input->get('store_id', TRUE);

		$data['catlist'] = $this->promote_discount->shopSectionCatlist($s_id);
		$data['allproducts'] = $this->promote_discount->myproducts($s_id, "");
		$data['total_products'] = count($data['allproducts']);

		$this->load->view('promote_right_categories_applies', $data);
	}

	function promoteSelectedType()
	{
		$typeID = $this->input->get('typeID', TRUE);
		$s_id = $this->input->get('store_id', TRUE);

		$data['allproducts'] = "";
		$this->load->view('promote_selected_type', $data);
	}

	function promotePromotionExpires()
	{
		$typeID = $this->input->get('typeID', TRUE);
		$s_id = $this->input->get('store_id', TRUE);

		$data['allproducts'] = "";
		$this->load->view('promote_promotion_expires', $data);
	}

	function savepromotedata()
	{
		$s_id = $this->input->get('store_id', TRUE);
		$imageArray = array();
		$catArray = array();

		$data1 = $this->input->POST('obj', TRUE);
		if ($data1['discount_on_type'] == 1) {
			$hiddenFieldDiv = $data1['hiddenFieldDiv'];

			for ($i = 1; $i <= $hiddenFieldDiv; $i++) {
				if ($data1['image_' . $i] != "") {
					$imageArray[$i] = $data1['image_' . $i];
				} else {
					break;
				}
			}
		}

		if ($data1['discount_on_type'] == 2) {
			for ($j = 1; $j <= ($data1['categoryCounter']); $j++) {
				$catArray[$j] = $data1['category_' . $j];
			}
		}

		//print_r($catArray);
		$no_of_uses = 0;
		$expiry_date = 0;

		if ($data1['promotion_expires'] == "1") {
			$promotionExpiresDate = $data1['promotionExpiresDate'];
			$promotionExpiresMonth = $data1['promotionExpiresMonth'];
			$promotionExpiresYear = $data1['promotionExpiresYear'];
			$expiry_date = $promotionExpiresYear . "/" . $promotionExpiresMonth . "/" . $promotionExpiresDate;

		} else if ($data1['promotion_expires'] == "2") {
			$no_of_uses = $data1['no_of_uses'];
		}
		$currDate = date("Y-m-d");
		$data_discount_offer = array(
			'store_id' => $s_id,
			'discount_on_type' => $data1['discount_on_type'],
			'promotion_type' => $data1['promotion_type'],
			'discount' => $data1['discountValue'],
			'expiry_type' => $data1['promotion_expires'],
			'no_of_used' => $no_of_uses,
			'expiry_date' => $expiry_date,
			'status' => 1,
			'applied_on' => $currDate
		);
		$promotion_type1 = $data1['promotion_type'];
		$promo_val = $data1['discountValue'];
		//print_r($catArray);

		$this->promote_discount->addPromoteDiscount($data_discount_offer, $imageArray, $catArray, $promotion_type1, $promo_val);
	}

}

?>