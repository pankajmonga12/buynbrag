<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public $storeURL;

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('order');
		$this->load->model('products');
		$this->load->model('store_model');
		$this->load->model('design');
		$this->load->model('morder');
		$this->load->model('promotion');
		$this->load->model('login_model');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('javascript');
        $this->config->load('payu', TRUE);
        $myconfig = $this->config->item('payu');
        $this->storeURL = $myconfig['store_url'];
	}

	function headerData()
	{
		$data['base_url'] = base_url();
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		log_message('INFO', "Memory Leak Test 10");
		$data['catlist'] = $this->categoriesdb->catlist();
		log_message('INFO', "Memory Leak Test 11");
		$data['hcatproducts'] = $this->categoriesdb->catprod(0);
		log_message('INFO', "Memory Leak Test 12");
		$data['hcatstore'] = $this->categoriesdb->catstore(0);
		log_message('INFO', "Memory Leak Test 13");
		$data['cart'] = $this->cartdb->mycartforuser($this->session->userdata('store_id'));
		log_message('INFO', "Memory Leak Test 14");
		$data['storeownerdetails'] = $this->login_model->ownerdetails($this->session->userdata('store_id'));

		log_message('INFO', "Memory Leak Test 15");

		//Session validation
		if ($this->session->userdata('logged_in_seller') != TRUE) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data['user_id'] = $this->session->userdata('store_id');
		//$this->shipped_email($this->session->userdata('store_id'));

		//$this->cancelled_email($this->session->userdata('store_id'));
		$this->load->view('header2_seller', $data);
	}

	// Order status Start //
	function shipped_email($store_id)
	{
		$this->load->model('vc_orders');
		$base_url = base_url();
		$mail_info = $this->vc_orders->shipped_mail_details($store_id);
		if ($mail_info != 0) {
			$count_order = count($mail_info);
			for ($j = 0; $j < $count_order; $j++) {
				$shipped_email_id = $mail_info[$j]['shipping_emailid'];
				$buyer_name = $mail_info[$j]['buyer_name'];
				$product_name = $mail_info[$j]['product_name'];
				$order_no = $mail_info[$j]['order_id'];
				$txnid = $mail_info[$j]['txnid'];
				$shipping_address = $mail_info[$j]['shipped_address'];
				$awb_no = $mail_info[$j]['awb_no'];
				$shipping_company = $mail_info[$j]['shipping_company'];
				if ($shipping_company == 'Fedex')
					$track_link = 'http://www.fedex.com/Tracking?cntry_code=in&lid=/Track/Track_Number';
				elseif ($shipping_company == 'Blue Dart')
					$track_link = 'http://www.bluedart.com/htotrack.html'; elseif ($shipping_company == 'GATI')
					$track_link = 'http://www.gati.com/html/my-gati_track-your-shipment_track-online.html'; else
					$track_link = '';
				$payment_mode = $mail_info[$j]['payment_mode'];
				if ($payment_mode == 'COD')
					$payment_mode = 'Cash on Delivery';
				elseif ($payment_mode == 'CC')
					$payment_mode = 'Credit Card'; elseif ($payment_mode == 'DC')
					$payment_mode = 'Debit Card'; elseif ($payment_mode == 'NB')
					$payment_mode = 'Net Banking';
				include 'mail_5.php';
				$this->load->library('email');
				$this->email->clear(TRUE);
				$this->email->from('support@buyandbrag.in', 'BuynBrag');
				$this->email->to($shipped_email_id);
				$this->email->bcc('bnb.vitallabs@gmail.com');
				$this->email->subject("BuynBrag: Order Shipped,Order Id:$order_no");
				$this->email->message($shipped_message);
				$this->email->attach('./invoice/' . $txnid . '/shipping_label_order_' . $order_no . '.pdf');
				$this->email->set_newline("\r\n");
				if ($this->email->send()) {
					$this->vc_orders->ship_canc_mail_success($order_no);
				}
				//end email send
				$this->email->clear(TRUE);
			}
			//end for
		}
		//end if mail_info !=0
	}

	function cancelled_email($store_id)
	{
		$this->load->model('vc_orders');
		$base_url = base_url();
		$mail_info = $this->vc_orders->cancelled_mail_details($store_id);
		if ($mail_info != 0) {
			$count_order = count($mail_info);
			for ($j = 0; $j < $count_order; $j++) {
				$shipped_email_id = $mail_info[$j]['shipping_emailid'];
				$buyer_name = $mail_info[$j]['buyer_name'];
				$product_name = $mail_info[$j]['product_name'];
				$order_no = $mail_info[$j]['order_id'];
				$txnid = $mail_info[$j]['txnid'];
				$shipping_address = $mail_info[$j]['shipped_address'];
				$payment_mode = $mail_info[$j]['payment_mode'];
				if ($payment_mode == 'COD')
					$payment_mode = 'Cash on Delivery';
				elseif ($payment_mode == 'CC')
					$payment_mode = 'Credit Card'; elseif ($payment_mode == 'DC')
					$payment_mode = 'Debit Card'; elseif ($payment_mode == 'NB')
					$payment_mode = 'Net Banking';
				include 'mail_6.php';
				$this->load->library('email');
				$this->email->from('support@buyandbrag.in', 'BuynBrag');
				$this->email->to($shipped_email_id);
				$this->email->subject("BuynBrag: Order Cancelled,Order Id:$order_no");
				$this->email->message($shipped_message);
				$this->email->set_newline("\r\n");
				if ($this->email->send()) {
					$this->vc_orders->ship_canc_mail_success($order_no);
				}
				//end email send
			}
			//end for
		}
		//end if mail_info !=0
	}

	function order_status($store_id)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'Someone from '.$__ip.' is trying to access dashboard/order_status');
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		log_message('INFO', "Memory Leak Test 1");
		$this->headerData();
		log_message('INFO', "Memory Leak Test 1");
		$data['base_url'] = base_url();
		$data['store_info'] = $this->order->getStoreIdOrder($store_id);
		log_message('INFO', "Memory Leak Test 2");
		$data['products'] = $this->order->myorder($store_id);
		log_message('INFO', "Memory Leak Test 3");
		$this->load->view('order_status', $data);
	}

	function order_details()
	{
		$this->headerData();
		$data['base_url'] = base_url();
		$o_id = $this->input->get('o_id', TRUE);
		$store_id = $this->input->get('store_id', TRUE);
		$data['store_info'] = $this->order->getStoreIdOrder($store_id);
		$data['order_id'] = $this->order->myorderdetails($o_id);
		$user_id = $data['order_id'][0]->user_id;
		$data['s_id'] = $this->order->getStoreIdOrder($store_id);
		$data['user_details'] = $this->order->myorderdetails2($user_id);
		//$data['user_details_comment'] = $this->order->myorderdetails3($o_id);
		$this->load->view('order_details', $data);
	}

	function orderStatusAjax()
	{
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$status = $this->input->get('status', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['order_status_ajax'] = $this->order->myorderdetails4($status, $s_id);
		$this->load->view('orderStatusAjax', $data);
	}

	function orderStatusAjaxLoader()
	{
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$status = $this->input->get('status', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['order_status_ajax'] = $this->order->myorderdetails4Loader($status, $limit, $s_id);
		$this->load->view('orderStatusAjax', $data);
	}

	function sortOrderStatus()
	{
		$sortparam = $this->input->get('sortparam', TRUE);
		$status = $this->input->get('status', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['sort_order_status'] = $this->order->sortmyorder($sortparam, $status, $s_id);
		$this->load->view('sortOrderStatus', $data);
	}

	function changeStatus($p_id, $status, $quantity)
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$this->products->changeStatus($p_id, $status, $quantity);
		echo "1";
		//$this->load->view('productsAjax',$data);
	}

	function enableProduct($productID)
	{
		$responseData = array();
		$responseData['result'] = $this->products->enableProduct($productID);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	function disableProduct($productID)
	{
		$responseData = array();
		$responseData['result'] = $this->products->disableProduct($productID);
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	function changeOrderStatus()
	{
		$status = $this->input->get('statusNow', TRUE);
		$o_id = $this->input->get('o_id', TRUE);
		$date = $this->input->get('date', TRUE);
		$time = $this->input->get('time', TRUE);
		if ( $this->order->changeOrderStatus( $status, $o_id, $date, $time ) )
		{
			$data['order_status_ajax'] = $this->order->myorderdetails4($status);
			$this->load->view('orderStatusAjax', $data);
		}
	}

	function giveComment()
	{
		$data['base_url'] = base_url();
		$o_id = $this->input->get('o_id', TRUE);
		$data1['object_id'] = $o_id;
		$data1['comments'] = $this->input->get('comment', TRUE);
		$data1['user_id'] = $this->session->userdata('store_id');
		$data1['comments_time'] = date("Y-m-d G:i:s", time());
		$this->order->addComment($data1);
		$this->order->updateOrderAfterComments($o_id);
		$data['user_details_comment'] = $this->order->myorderdetails3($o_id);
		$this->load->view('give_comments', $data);
	}

	// Order status End //

	// Products Pages Start //
	function allproductspage($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id)
		{
			redirect(base_url() . 'index.php/login/seller');
		}
		
		$sort = ($this->input->get('sort') !== FALSE)? $this->input->get('sort'): NULL;
		$sortBy = ($this->input->get('param') !== FALSE)? $this->input->get('param') : NULL;

		$this->headerData();
		$data['base_url'] = base_url();
		$data['store_info'] = $this->order->getStoreIdOrder($store_id);
		$data['allproducts'] = $this->products->myproducts($store_id, $sort, $sortBy);
		$this->load->view('products', $data);
	}

	function searchProduct()
	{
		$data['base_url'] = base_url();
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$status = $this->input->get('status', TRUE);
		$pro = $this->input->get('pro', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['status'] = $status;
		//log_message('INFO', "dashboard/searchProduct fired with \$status = ".$status.", \$store_id = ".$s_id.", pro = ".$pro);
		$this->load->model('slog');
		$this->slog->write(array('level' => 1, 'msg' => "dashboard/searchProduct fired with \$status = ".$status.", \$store_id = ".$s_id.", pro = ".$pro));
		$data['search_product'] = $this->products->mySearchProduct($status, $pro, $s_id);
		$this->load->view('searchProduct', $data);
	}

	function productsAjax()
	{
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data['base_url'] = base_url();
		$status = $this->input->get('status', TRUE);
		$pro = $this->input->get('pro', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['status'] = $status;
		//$data['products_ajax'] = $this->products->myProductsAjax($status, $s_id);
		$data['products_ajax'] = $this->products->myProductsAjax2($status, $s_id); // using new function by sam to speed up the perf
		$this->load->view('productsAjax', $data);
	}

	function productsAjaxLoader()
	{
		$data['base_url'] = base_url();
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$status = $this->input->get('status', TRUE);
		$pro = $this->input->get('pro', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$data['status'] = $status;
		$data['products_ajax'] = $this->products->myProductsAjaxLoad($status, $limit, $pro, $s_id);
		$this->load->view('productsAjax', $data);
	}

	function addproductspage($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$data['isEdit'] = 0;
		// loading product categories
		$data['product_cat'] = $this->products->productMainCat(0);
		// loading shop section categories
		$data['shop_section_cat'] = $this->products->shopSectionCat($store_id);
		$data['store_info_var'] = $this->store_model->myStoreInfo($store_id);
		$data['styles'] = $this->store_model->bnb_styles();
		$data['occasions'] = $this->store_model->bnb_occasions();
		$this->load->view('add_products', $data);
	}

	function product_cat_exec()
	{
		$data['base_url'] = base_url();
		$parentCatId = $this->input->get('parentCatId', TRUE);
		$data['typeID'] = $this->input->get('typeID', TRUE);
		$data['products_sub_cat'] = $this->products->productMainCat($parentCatId);
		$this->load->view('product_cat_exec', $data);
	}

	function savedata()
	{
		$currSession = $this->session->userdata('dataFirst');
		if ($currSession == true) {
			$this->session->unset_userdata('dataFirst');
		}
		$data['base_url'] = base_url();
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$data1 = $this->input->post('obj', TRUE);
		$this->session->set_userdata('dataFirst', $data1);
		echo base_url();
		//$this->load->view('add_product_second',$data);
	}

	function add_product_second($store_id, $isEdit)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		if ($isEdit == 0) {
			$data['isEdit'] = 0;
		} else {
			$data['isEdit'] = 1;
			$productdetails = $this->session->userdata('toeditProduct');
			$data['productdetails'] = $productdetails;
			$data['variantdetails'] = $this->products->variantdetails($productdetails[0]->product_id);
		}
		$data['store_info_var'] = $this->store_model->myStoreInfo($store_id);
		$this->load->view('add_product_second', $data);
	}

	function saveproduct()
	{
		$data['base_url'] = base_url();
		$data1 = $this->session->userdata('dataFirst');
		$data2 = $this->input->post('obj', TRUE);
		$store_id = $data2['store_id'];
		$data = array(
			'store_id' => $store_id,
			'cat_id' => $data1['catogory'],
			'sub_catid1' => $data1['sub_cagegory'],
			'sub_catid2' => $data1['sub_sub_cagegory'],
			'sub_catid3' => $data1['sub_sub_sub_cagegory'],
			'product_name' => $data1['product_name'],
			'bnb_product_code' => $data1['item_code'],
			'storesection_id' => $data1['selected_shop'],
			'description' => $data1['description'],
			'occasions' => $data1['product_occasion'],
			'style' => $data1['product_style'],
			'tags' => $data1['tags'],
			'length' => $data2['length'],
			'breadth' => $data2['breadth'],
			'height' => $data2['height'],
			'prd_act_weight' => $data2['weight'],
			'prd_vol_weight' => $data2['volWeight'],
			'shipping_mode' => $data2['shipping_mode'],
			'seller_earnings' => $data2['seller_earnings'],
			'bnb_commission' => $data2['commision'],
			'tax_rate' => $data2['tax_rate'],
			'insurance_cost' => $data2['insurance'],
			'shipping_cost' => $data2['logistics'],
			'selling_price' => $data2['selling_price'],
			'discount' => $data2['discount_price'],
			'is_on_discount' => $data2['is_on_discount'],
			'shipping_partner' => $data2['shipping_partner_id'],
			'quantity' => $data2['quantity'],
			'quantity' => $data2['quantity'],
			'processing_time' => $data2['order_processing'],
			'status' => 0,
			'is_enable' => 1,
			'added_on' => date("Y-m-d")
		);
		//log_message('INFO', "products/addProduct returned \r\n".$this->products->addProduct($data));
		$this->load->model('slog');
		$this->slog->write(array('level' => 1,'msg' => "products/addProduct returned \r\n".$this->products->addProduct($data)));
		$newId = $this->products->getLastRow();
		$stock = $data2['stock'];
		if ($data1['image1'] != "") {
			$img = $data1['image1'];
		}
		if ($data1['image2'] != "") {
			$img2 = $data1['image2'];
		}
		if ($data1['image3'] != "") {
			$img3 = $data1['image3'];
		}
		if ($data1['image4'] != "") {
			$img4 = $data1['image4'];
		}
		if ($data1['image5'] != "") {
			$img5 = $data1['image5'];
		}
		$this->a(1, $img, $store_id, $newId, $img2, $img3, $img4, $img5);
		if ($stock != "") {
			$pieces = explode("~", $stock);
			for ($i = 0; $i < sizeof($pieces); $i++) {
				$pieces1 = explode("_", $pieces[$i]);
				$data1 = array(
					'product_id' => $newId,
					'variant_name' => $pieces1[0],
					'quantity' => $pieces1[1],
					'size' => $pieces1[2],
					'color' => $pieces1[3],
				);
				$this->products->addVariant($data1);
			}
		}
		//header("location:".$data['base_url']."index.php/dashboard/allproductspage/".$store_id);
	}

	///////added by Rajeeb
	function saveEditedproduct($newId)
	{
		$data['base_url'] = base_url();
		$data1 = $this->session->userdata('dataFirst');
		$data2 = $this->input->POST('obj', TRUE);
		$store_id = $data2['store_id'];
		if ($data2['quantity'] < 1)
			$is_enable = 0;
		$data = array(
			'store_id' => $store_id,
			'cat_id' => $data1['catogory'],
			'sub_catid1' => $data1['sub_cagegory'],
			'sub_catid2' => $data1['sub_sub_cagegory'],
			'sub_catid3' => $data1['sub_sub_sub_cagegory'],
			'product_name' => $data1['product_name'],
			'bnb_product_code' => $data1['item_code'],
			'storesection_id' => $data1['selected_shop'],
			'description' => $data1['description'],
			'occasions' => $data1['product_occasion'],
			'style' => $data1['product_style'],
			'tags' => $data1['tags'],
			'length' => $data2['length'],
			'breadth' => $data2['breadth'],
			'height' => $data2['height'],
			'prd_act_weight' => $data2['weight'],
			'prd_vol_weight' => $data2['volWeight'],
			'shipping_mode' => $data2['shipping_mode'],
			'seller_earnings' => $data2['seller_earnings'],
			'bnb_commission' => $data2['commision'],
			'tax_rate' => $data2['tax_rate'],
			'insurance_cost' => $data2['insurance'],
			'shipping_cost' => $data2['logistics'],
			'selling_price' => $data2['selling_price'],
			'discount' => $data2['discount_price'],
			'is_on_discount' => $data2['is_on_discount'],
			'shipping_partner' => $data2['shipping_partner_id'],
			'quantity' => $data2['quantity'],
			'quantity' => $data2['quantity'],
			'processing_time' => $data2['order_processing'],
			'status' => 0,
			'is_enable' => $is_enable,
			'added_on' => date("Y-m-d")
		);
		$img = "";
		$img2 = "";
		$img3 = "";
		$img4 = "";
		$img5 = "";
		$stock = $data2['stock'];
		if ($data1['image1'] != "") {
			$img = $data1['image1'];
		}
		if ($data1['image2'] != "") {
			$img2 = $data1['image2'];
		}
		if ($data1['image3'] != "") {
			$img3 = $data1['image3'];
		}
		if ($data1['image4'] != "") {
			$img4 = $data1['image4'];
		}
		if ($data1['image5'] != "") {
			$img5 = $data1['image5'];
		}
		$this->a(1, $img, $store_id, $newId, $img2, $img3, $img4, $img5);

		if ($stock != "") {
			$pieces = explode("~", $stock);
			for ($i = 0; $i < sizeof($pieces); $i++) {
				$pieces1 = explode("_", $pieces[$i]);
				$data1 = array(
					'product_id' => $newId,
					'variant_name' => $pieces1[0],
					'quantity' => $pieces1[1],
					'size' => $pieces1[2],
					'color' => $pieces1[3],
				);
				$this->products->addVariant($data1);
			}
		}
		$this->products->editProduct($data, $newId);
	}

	function deleteproduct()
	{
		$data['base_url'] = base_url();
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		$status = $this->input->get('status', TRUE);
		$p_id = $this->input->get('product_id', TRUE);
		$s_id = $this->input->get('store_id', TRUE);
		$this->products->deleteproduct($p_id);
		$pro = $this->input->get('pro', TRUE);
		$data['search_product'] = $this->products->mySearchProduct($status, $pro, $s_id);
		$this->load->view('searchProduct', $data);
	}

	function editProduct($p_id, $store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		//$p_id=$this->input->get('product_id', TRUE);
		//$store_id=$this->input->get('store_id', TRUE);
		$productdetails = $this->products->productdetails($p_id);
		$data['variantdetails'] = $this->products->variantdetails($p_id);
		$data['productdetails'] = $productdetails;
		$this->session->set_userdata('toeditProduct', $productdetails);
		// loading product categories
		$data['product_cat'] = $this->products->productMainCat(0);
		$data['product_cat1'] = $this->products->productMainCat($productdetails[0]->cat_id);
		$data['product_cat2'] = $this->products->productMainCat($productdetails[0]->sub_catid1);
		$data['product_cat3'] = $this->products->productMainCat($productdetails[0]->sub_catid2);
		// loading shop section categories
		$data['shop_section_cat'] = $this->products->shopSectionCat($store_id);
		$data['store_info_var'] = $this->store_model->myStoreInfo($store_id);
		$data['isEdit'] = 1;
		$data['styles'] = $this->store_model->bnb_styles();
		$data['occasions'] = $this->store_model->bnb_occasions();
		$this->load->view('add_products', $data);
	}

	// product page end //
	// store info start //
	function store_info($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['isRecord'] = $this->store_model->store_exists($store_id);
		$isRecord = $data['isRecord'];
		if ($isRecord != 0) {
			if ($this->session->userdata('myNewStoreId') == true) {
				$data['store_info_var'] = $this->store_model->myStoreInfo($this->session->userdata('myNewStoreId'));
			} else {
				$data['store_info_var'] = $this->store_model->myStoreInfo($store_id);
			}
		}
		$this->load->view('store_info', $data);
	}

	function store_info_form()
	{
		$data['base_url'] = base_url();
		$store_id = $this->input->post('my_store_id', TRUE);
		$this->store_model->saveStoreInfo();
		$this->a1($store_id);
		header("location:" . $data['base_url'] . "index.php/dashboard/store_info/" . $store_id);
	}

	function ownerAjaxImage()
	{
		$action = $this->input->get('action', TRUE);
		$this->load->view('ownerAjaxImage');
	}

	function editVariant($vid)
	{
		$color = $this->input->get('color', TRUE);
		$qty = $this->input->get('qty', TRUE);
		$size = $this->input->get('size', TRUE);
		$v_name = $this->input->get('name', TRUE);
		if ($this->products->editVariant($vid, $v_name, $color, $size, $qty) == 1)
			echo "Your Variant Details has been updated successfully!";
		else
			echo "Database Error Occured! Please Try Again";
	}

	function deleteVariant($vid)
	{
		if ($this->products->deleteVariant($vid) == 1)
			echo "Variant has been deleted successfully!";
		else
			echo "Database Error Occured! Please Try Again";
	}

	function addNewVariant($pid)
	{
		if ($this->products->addNewVariant($pid) == 1)
			echo "Variant has been added successfully!";
		else
			echo "Database Error Occured! Please Try Again";
	}

	function a($type, $img, $s_id, $p_id, $img2, $img3, $img4, $img5)
	{
		if (!is_dir("./assets/images/stores/" . $s_id . "/" . $p_id))
			mkdir("./assets/images/stores/" . $s_id . "/" . $p_id, 0700);
		//92x77 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (92 / 77)) {
				$config['width'] = (92 / 77) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (77 / 92) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}
			$config['new_image'] = "./assets/uploads/products/ratio_9277.jpg";
			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		}
		//97x80 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (97 / 80)) {
				$config['width'] = (97 / 80) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (80 / 97) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}
			$config['new_image'] = "./assets/uploads/products/ratio_9780.jpg";
			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		}
		//240x200 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (240 / 200)) {
				$config['width'] = (240 / 200) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (200 / 240) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}
			$config['new_image'] = "./assets/uploads/products/ratio_240200.jpg";
			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		}
		//190*150 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (190 / 150)) {
				$config['width'] = (190 / 150) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (150 / 190) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}
			$config['new_image'] = "./assets/uploads/products/ratio_190150.jpg";
			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		}
		//500*375 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (500 / 375)) {
				$config['width'] = (500 / 375) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (375 / 500) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}
			$config['new_image'] = "./assets/uploads/products/ratio_500375.jpg";
			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		}
		//Square ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if ($w > $h) {
				$config['width'] = $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $h) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = $w;
				$config['y_axis'] = ($h - $w) / 2;
			}
			$config['new_image'] = "./assets/uploads/products/ratio_suare.jpg";
			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img2 != "") {
			//Square ratio
			{
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$url = "./assets/uploads/products/" . $img2;
				$config['image_library'] = 'gd2';
				$config['quality'] = "100%";
				$config['source_image'] = $url;
				$vals = getimagesize($url);
				$w = $vals['0'];
				$h = $vals['1'];
				//$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				if ($w > $h) {
					$config['width'] = $h;
					$config['height'] = $h;
					$config['x_axis'] = ($w - $h) / 2;
				} else {
					$config['width'] = $w;
					$config['height'] = $w;
					$config['y_axis'] = ($h - $w) / 2;
				}
				$config['new_image'] = "./assets/uploads/products/ratio_suare2.jpg";
				$this->load->library('image_lib', $config);
				$this->image_lib->crop();
				$this->image_lib->initialize($config);
				if (!$this->image_lib->crop()) {
					echo $this->image_lib->display_errors();
				}
			}
		}
		if ($img3 != "") {
			//Square ratio
			{
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$url = "./assets/uploads/products/" . $img3;
				$config['image_library'] = 'gd2';
				$config['quality'] = "100%";
				$config['source_image'] = $url;
				$vals = getimagesize($url);
				$w = $vals['0'];
				$h = $vals['1'];
				//$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				if ($w > $h) {
					$config['width'] = $h;
					$config['height'] = $h;
					$config['x_axis'] = ($w - $h) / 2;
				} else {
					$config['width'] = $w;
					$config['height'] = $w;
					$config['y_axis'] = ($h - $w) / 2;
				}
				$config['new_image'] = "./assets/uploads/products/ratio_suare3.jpg";
				$this->load->library('image_lib', $config);
				$this->image_lib->crop();
				$this->image_lib->initialize($config);
				if (!$this->image_lib->crop()) {
					echo $this->image_lib->display_errors();
				}
			}
		}
		if ($img4 != "") {
			//Square ratio
			{
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$url = "./assets/uploads/products/" . $img4;
				$config['image_library'] = 'gd2';
				$config['quality'] = "100%";
				$config['source_image'] = $url;
				$vals = getimagesize($url);
				$w = $vals['0'];
				$h = $vals['1'];
				//$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				if ($w > $h) {
					$config['width'] = $h;
					$config['height'] = $h;
					$config['x_axis'] = ($w - $h) / 2;
				} else {
					$config['width'] = $w;
					$config['height'] = $w;
					$config['y_axis'] = ($h - $w) / 2;
				}
				$config['new_image'] = "./assets/uploads/products/ratio_suare4.jpg";
				$this->load->library('image_lib', $config);
				$this->image_lib->crop();
				$this->image_lib->initialize($config);
				if (!$this->image_lib->crop()) {
					echo $this->image_lib->display_errors();
				}
			}
		}
		if ($img5 != "") {
			//Square ratio
			{
				$config['image_library'] = 'gd2';
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$url = "./assets/uploads/products/" . $img5;
				$config['image_library'] = 'gd2';
				$config['quality'] = "100%";
				$config['source_image'] = $url;
				$vals = getimagesize($url);
				$w = $vals['0'];
				$h = $vals['1'];
				//$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				if ($w > $h) {
					$config['width'] = $h;
					$config['height'] = $h;
					$config['x_axis'] = ($w - $h) / 2;
				} else {
					$config['width'] = $w;
					$config['height'] = $w;
					$config['y_axis'] = ($h - $w) / 2;
				}
				$config['new_image'] = "./assets/uploads/products/ratio_suare5.jpg";
				$this->load->library('image_lib', $config);
				$this->image_lib->crop();
				$this->image_lib->initialize($config);
				if (!$this->image_lib->crop()) {
					echo $this->image_lib->display_errors();
				}
			}
		}
		//73x73
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (73);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_73x73.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//40x40
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (40);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_40x40.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img2 != "") {
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare2.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (40);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img2_40x40.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img3 != "") {
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare3.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (40);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img3_40x40.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img4 != "") {
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare4.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (40);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img4_40x40.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img5 != "") {
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare5.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (40);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img5_40x40.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//171x171
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (171);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_171x171.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//92x77
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_9277.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (92);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_92x77.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//97x80
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_9780.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (97);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_97x80.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//240x200
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_240200.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (240);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_240x200.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//190x150
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_190150.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (190);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_190x150.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//500x375
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_500375.jpg";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (500);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_500x375.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//1013x____
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (1013);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/fancy1.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//598x____
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (598);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img1_product.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img2 != "") {
			//598x____
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img2;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (598);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img2_product.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img3 != "") {
			//598x____
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img3;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (598);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img3_product.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img4 != "") {
			//598x____
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img4;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (598);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img4_product.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		if ($img5 != "") {
			//598x____
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img5;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (598);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img5_product.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//494x____
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (494);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/fancy2.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}


		//323x____
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['x_axis'] = 0;
			$config['y_axis'] = 0;
			$config['width'] = (323);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/fancy3.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//$this->a2(2,"b.jpg",$s_id,$p_id);
	}

	function a2($type, $img, $s_id, $p_id)
	{
		if (!is_dir("./assets/images/stores/" . $s_id . "/" . $p_id))
			mkdir("./assets/images/stores/" . $s_id . "/" . $p_id, 0700);
		//92x77 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (92 / 77)) {
				$config['width'] = (92 / 77) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (77 / 92) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}
			$config['new_image'] = "./assets/uploads/products/ratio_suare.jpg";
			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			}
		}
		//40x40
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/ratio_suare" . $type . ".jpg";
			echo "test " . $url;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (40);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_40x40.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
		//598x____
		{
			$this->image_lib->initialize($config);
			$url = "./assets/uploads/products/" . $img;
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			//$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = (598);
			$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_product.jpg';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}
		}
	}

	function func()
	{
		$data['base_url'] = base_url();
		$data['q'] = $this->input->get('action', TRUE);
		$this->load->view('functions', $data);
	}

	function a1($s_id)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = "./assets/uploads/products/crop.jpg";
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = 190;
		$config['height'] = 190;
		$config['new_image'] = './assets/images/stores/' . $s_id . '/owner/owner.jpg';
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}

	/* Store Policies */
	function store_policies($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['isRecord'] = $this->store_model->store_exists($store_id);
		$isRecord = $data['isRecord'];
		if ($isRecord != 0)
			$data['store_info_var'] = $this->store_model->myStorePolicies($store_id);
		$this->load->view('store_policies', $data);
	}

	function store_policies_form()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$store_id = $this->input->post('my_store_id', TRUE);
		$this->store_model->saveStorePolicies();
		header("location:" . $data['base_url'] . "index.php/dashboard/store_policies/" . $store_id);
	}

	/* Store Customer Support */
	function store_customer_support($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['isRecord'] = $this->store_model->store_exists($store_id);
		$isRecord = $data['isRecord'];
		if ($isRecord != 0)
			$data['store_info_var'] = $this->store_model->myStorePolicies($store_id);
		$this->load->view('store_customer_support', $data);
	}

	function store_customer_form()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$store_id = $this->input->post('my_store_id', TRUE);
		$this->store_model->saveStoreCustomer();
		header("location:" . $data['base_url'] . "index.php/dashboard/store_customer_support/" . $store_id);
	}

	/* Store legal & Banking Info */
	function store_bank_info($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');

		$data['isRecord'] = $this->store_model->store_exists($store_id);
		$data['banks'] = $this->store_model->banks_list();
		$isRecord = $data['isRecord'];
		if ($isRecord != 0)
			$data['store_info_var'] = $this->store_model->myStorePolicies($store_id);
		$this->load->view('store_bank_info', $data);
	}

	function store_bank_form()
	{
		$data['base_url'] = base_url();
		$store_id = $this->input->post('my_store_id', TRUE);
		$this->store_model->saveStoreBankInfo();
		header("location:" . $data['base_url'] . "index.php/dashboard/store_bank_info/" . $store_id);
	}

	/* Store Pickup Address */
	function store_pickup_address($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['isRecord'] = $this->store_model->store_exists($store_id);
		$isRecord = $data['isRecord'];
		if ($isRecord != 0)
			$data['store_info_var'] = $this->store_model->myStorePolicies($store_id);
		$this->load->view('store_pickup_address', $data);
	}

	function store_pickadd_form()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$store_id = $this->input->post('my_store_id', TRUE);
		$this->store_model->saveStorePickAddress();
		header("location:" . $data['base_url'] . "index.php/dashboard/store_pickup_address/" . $store_id);
	}

	/* Store Categories */
	function store_categories($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['isRecord'] = $this->store_model->store_exists($store_id);
		$isRecord = $data['isRecord'];
		if ($isRecord != 0)
			$data['store_info_var'] = $this->store_model->myStorePolicies($store_id);
		$data['store_cat_var'] = $this->store_model->myStoreCategories($store_id);
		$data['store_cat_items'] = $this->store_model->myStoreCategoriesProducts($store_id);
		$this->load->view('store_categories', $data);
	}

	function add_store_category()
	{
		$data['base_url'] = base_url();
		$catname = $this->input->get('catname', TRUE);
		$store_id = $this->input->get('store_id', TRUE);
		$data['add_store_category'] = $this->store_model->addStoreCategory($catname, $store_id);
		//	$this->load->view('add_store_category',$data);
	}

	function select_store_category()
	{
		$data['base_url'] = base_url();
		$data['store_url'] = $this->storeURL;
		$store_id = $this->input->get('store_id', TRUE);
		$section_cat_id = $this->input->get('section_cat_id', TRUE);
		$data['select_store_category_items'] = $this->store_model->selectStoreCategory($store_id, $section_cat_id);
		$this->load->view('select_store_category', $data);
	}

	function move_store_category()
	{
		$data['base_url'] = base_url();
		$method = $this->input->get('method', TRUE);
		$catId = $this->input->get('catId', TRUE);
		if ($method == 'selectedcheckboxes') {
			$myids = $this->input->get('allVals', TRUE);
			$myidsexploded = explode(',', $myids);
			$data['move_store_category_items'] = $this->store_model->moveStoreCategory($myidsexploded, $catId, $method);
		} else {
			$productId = $this->input->get('productId', TRUE);
			$data['move_store_category_items'] = $this->store_model->moveStoreCategory($productId, $catId, $method);
		}
		$this->load->view('move_store_category', $data);
	}

	function show_store_popup()
	{
		$data['base_url'] = base_url();
		$currentPopUpItem = $this->input->get('currentPopUpItem', TRUE);
		$store_id = $this->input->get('store_id', TRUE);
		$data['show_store_popup_items'] = $this->store_model->showStorePopup($currentPopUpItem);
		$data['show_store_popup_cat'] = $this->store_model->myStoreCategories($store_id);
		$this->load->view('show_store_popup', $data);
	}

	/* Design */
	function banner_design($store_id)
	{
		if ($this->session->userdata('store_id') != $store_id) {
			redirect(base_url() . 'index.php/login/seller');
		}
		$this->headerData();
		$data['base_url'] = base_url();
		$data['isRecord'] = $this->store_model->store_exists($store_id);
		$isRecord = $data['isRecord'];
		if ($isRecord != 0)
			$data['store_info_var'] = $this->store_model->myStoreInfo($store_id);
		$data['banner_design_insert'] = $this->design->bannerDesign($store_id);
		$this->load->view('banner_design', $data);
	}

	function submitBannerChanges()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$dbaction = $this->input->post('dbaction', TRUE);

		if ($dbaction == "insertRecord") {
			$store_id = $this->input->post('store_id', TRUE);
			$subdomain = $this->input->post('subdomain', TRUE);
			$existingStore = $this->design->checkExistingStore($subdomain);
			if ($existingStore == false) {
				$newId = $this->design->myStoreBanner($store_id);
				$this->session->set_userdata('myNewStoreId', $newId);

				$folderName = $newId;
				$pathToUpload = './assets/images/stores/' . $folderName;
				mkdir($pathToUpload, 0755);
			} else {
				redirect(base_url() . 'index.php/dashboard/banner_design/' . $store_id . "?msg=Domain name already created! Plz choose another name");
			}
		} else {
			$store_id = $this->input->post('store_id', TRUE);
			$this->design->myStoreBanner($store_id);
		}
		header("location:" . $data['base_url'] . "index.php/dashboard/banner_design/" . $store_id);
	}

	function generate_invoice($order_id, $txnid)
	{
		//$status = 2;
		//$date = 0;
		//$time = 0;
		//$this->order->changeOrderStatus($status,$order_id,$date,$time);
		$url = base_url('index.php/invoice_controller/index/' . $order_id . '/' . $txnid);
		redirect($url);
	}

	public function changeQuantity($productID, $quantity)
	{
		$this->load->model('products');
		$responseData['result'] = $this->products->changeQuantity($productID, $quantity);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	public function updatePickupDateV($pickdate,$orderid)
	{
		$this->load->model('store_model');
		$responseData['result'] = $this->store_model->updatePickUpDate($pickdate,$orderid);
		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
		$this->store_model->emailModel($orderid);
	}
	public function updateAwbNo($awbNo = NULL, $orderid = NULL, $dTS = NULL, $shpPartner = NULL)
	{
		$this->load->model('store_model');
		if(!is_null($awbNo) && !is_null($orderid) && !is_null($dTS) && !is_null($shpPartner))
		{
			$responseData['result'] = $this->store_model->updateAwbNo($awbNo,$orderid,$dTS,$shpPartner);
		}
		else
		{
			$responseData['result'] = 'undefined';
		}

		$response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
		//$this->store_model->emailModel2($orderid,$shpPartner);
	}
	//public function emailController($orderid)
	//{
		//$this->load->model('store_model');
		//$this->store_model->emailModel($orderid);
	//}
	//public function emailController2($orderid)
	//{
		//$this->load->model('store_model');
		//$this->store_model->emailModel2($orderid);
	//}

	public function bnbNote($orderid)
	{
		$note = $this->input->get('term');
		$this->load->model('store_model');
		$this->store_model->bnbNoteModel($orderid,$note);
    }
    
    /*public function savePartner($name)
    {
    	//$name = $this->input->get('term');
    	$this->load->model('store_model');
    	$partnerID = $this->store_model->saveShippingPartner($name);
    }*/
    public function getShippingPartners()
    {
    	//$note = $this->input->get('program_id');
        $this->load->model('store_model');
        $responseData['result']= $this->store_model->readShippingPartners();
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
		$this->output->set_output($response);
    }	
}?>
