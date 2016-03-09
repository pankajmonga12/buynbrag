<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class store_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('slog');
	}

	function store_exists($store_id)
	{
		$this->db->select('store_url');
		$this->db->from('store_info');
		$this->db->where('store_info.store_id', $store_id);
		$result = $this->db->get();

		if ($result->num_rows() > 0)
			return 1;
		else
			return 0;
	}

	function myStoreInfo($store_id)
	{
		$this->db->select('*');
		$this->db->from('store_owner');
		$this->db->join('store_info', 'store_info.store_id = store_owner.store_id');
		$this->db->where('store_info.store_id', $store_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function saveStoreInfo()
	{
		$this->load->database();
		$mydata = array(
			'store_name' => $this->input->post('store_name'),
			//'store_url'=>$this->input->post('store_url'),
			'seo_tags' => $this->input->post('seo_tags'),
			'banner_url' => "Copple_Banner.jpg",
			'about_store' => $this->input->post('about_store'),
			'contact_name' => $this->input->post('contact_name'),
			'contact_number' => $this->input->post('contact_number'),
			'contact_email' => $this->input->post('contact_email'),
			'communication_address' => $this->input->post('communication_address'),
			'communication_city' => $this->input->post('communication_city'),
			'communication_state' => $this->input->post('communication_state'),
			'communication_country' => $this->input->post('communication_country'),
			'communication_pincode' => $this->input->post('communication_pincode'),
			'warehouse_address' => $this->input->post('warehouse_address'),
			'warehouse_city' => $this->input->post('warehouse_city'),
			'warehouse_state' => $this->input->post('warehouse_state'),
			'warehouse_country' => $this->input->post('warehouse_country'),
			'warehouse_pincode' => $this->input->post('warehouse_pincode'),
			'company_code' => $this->input->post('company_code'),
			'marketing_name' => $this->input->post('marketing_name'),
			'tag_line' => $this->input->post('tag_line'),
		);

		$mydata1 = array(
			'owner_name' => $this->input->post('owner_name'),
			'fb_link' => $this->input->post('fb_link'),
			'about_owner' => $this->input->post('about_owner'),
			'owner_number' => $this->input->post('owner_mobile'),
			'owner_email' => $this->input->post('owner_email'),
			//'owner_pic'=>"Jellyfish2.jpg",
			//'rand_num_id'=>$this->input->post('rand_num_id'),
			'owner_pic' => $this->input->post('rand_num_id') . "_" . "Jellyfish2.jpg",
		);
		$dbaction = $this->input->post('dbaction');
		if ($dbaction == "insertRecord") {
			$this->db->insert('store_info', $mydata);
			//echo $this->db->insert_id()."------";
			$mydata1["store_id"] = $this->db->insert_id();
			$this->db->insert('store_owner', $mydata1);
		} else {
			if ($this->session->userdata('store_id') == 1) {
				$mystore_id = $this->session->userdata('myNewStoreId');
			} else {
				$mystore_id = $this->input->post('my_store_id');
			}
			$this->db->update('store_owner', $mydata1, "store_id ='" . $mystore_id . "'");
			$this->db->update('store_info', $mydata, "store_id ='" . $mystore_id . "'");

		}
	}

	/* Store Policies */
	function myStorePolicies($store_id)
	{
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->where('store_info.store_id', $store_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function saveStorePolicies()
	{
		$this->load->database();
		$mydata = array(
			'store_url' => $this->input->post('store_url'),
			'return_policy' => $this->input->post('return_policy'),
			'EMI_policy' => $this->input->post('EMI_policy'),
			'COD_policy' => $this->input->post('COD_policy'),
		);

		$dbaction = $this->input->post('dbaction');
		if ($dbaction == "insertRecord") {
			$this->db->insert('store_info', $mydata);
		} else {
			$mystore_id = $this->input->post('my_store_id');
			$this->db->update('store_info', $mydata, "store_id ='" . $mystore_id . "'");
		}
	}

	/* Store Customer Support */
	function saveStoreCustomer()
	{
		$this->load->database();
		$mydata = array(
			'store_url' => $this->input->post('store_url'),
			'support_email' => $this->input->post('support_email'),
			'return_address' => $this->input->post('return_address'),
			'return_city' => $this->input->post('return_city'),
			'return_state' => $this->input->post('return_state'),
			'return_country' => $this->input->post('return_country'),
			'return_pincode' => $this->input->post('return_pincode'),
		);

		$dbaction = $this->input->post('dbaction');
		if ($dbaction == "insertRecord") {
			$this->db->insert('store_info', $mydata);
		} else {
			$mystore_id = $this->input->post('my_store_id');
			$this->db->update('store_info', $mydata, "store_id ='" . $mystore_id . "'");
		}
	}

	/* Store Bank Info */
	function saveStoreBankInfo()
	{
		$this->load->database();
		$mydata = array('store_url' => $this->input->post('store_url'),
			'bankaccountholder_name' => $this->input->post('bankaccountholder_name'),
			'account_number' => $this->input->post('bankaccountnumber'),
			'bank_name' => $this->input->post('bank_name'),
			'bank_branch' => $this->input->post('bank_branch'),
			'account_type' => $this->input->post('account_type'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'vat_no' => $this->input->post('vat_no'),
			'tin_no' => $this->input->post('tin_no'),
			'pan_no' => $this->input->post('pan_no'),
		);

		$dbaction = $this->input->post('dbaction');
		if ($dbaction == "insertRecord") {
			$this->db->insert('store_info', $mydata);
		} else {
			$mystore_id = $this->input->post('my_store_id');
			$this->db->update('store_info', $mydata, "store_id ='" . $mystore_id . "'");
		}
	}

	/* Store Pickup Address */
	function saveStorePickAddress()
	{
		$this->load->database();
		$mydata = array(
			'store_url' => $this->input->post('store_url'),
			'pickup_name' => $this->input->post('pickup_name'),
			'pickup_address' => $this->input->post('pickup_address'),
			'pickup_city' => $this->input->post('pickup_city'),
			'pickup_state' => $this->input->post('pickup_state'),
			'pickup_country' => $this->input->post('pickup_country'),
			'pickup_pincode' => $this->input->post('pickup_pincode'),
			'pickup_landmark' => $this->input->post('pickup_landmark'),
		);

		$dbaction = $this->input->post('dbaction');
		if ($dbaction == "insertRecord") {
			$this->db->insert('store_info', $mydata);
		} else {
			$mystore_id = $this->input->post('my_store_id');
			$this->db->update('store_info', $mydata, "store_id ='" . $mystore_id . "'");
		}
	}

	function myStoreCategories($store_id)
	{
		$this->db->select('*');
		$this->db->from('store_section');
		$this->db->where('store_id', $store_id);
		$result = $this->db->get();
		return $result->result();
	}

	function myStoreCategoriesProducts($store_id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('products.store_id', $store_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function addStoreCategory($catname, $store_id)
	{

		$data = array(
			'store_id' => $store_id,
			'name' => $catname,
		);

		$this->db->insert('store_section', $data);
		echo $this->db->last_query();
	}

	function selectStoreCategory($store_id, $section_cat_id)
	{

		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('store_id', $store_id);
		if ($section_cat_id == 0) {
			$this->db->where('storesection_id >', $section_cat_id);
		} else {
			$this->db->where('storesection_id', $section_cat_id);

		}

		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function moveStoreCategory($myidsexploded, $catId, $method)
	{
		$data = array(
			'storesection_id' => $catId,
		);
		if ($method == 'selectedcheckboxes') {
			$total_items = count($myidsexploded);

			for ($j = 0; $j < $total_items; $j++) {
				$this->db->where('product_id', $myidsexploded[$j]);
				$this->db->update('products', $data);
			}
			echo $this->db->last_query();
		} else {
			$this->db->where('product_id', $myidsexploded);
			$this->db->update('products', $data);
		}
	}

	function showStorePopup($currentPopUpItem)
	{
		$this->db->select('*,products.store_id as mystoreid');
		$this->db->from('products');
		$this->db->join('store_section', 'products.storesection_id = store_section.storesection_id', 'right');
		$this->db->where('products.product_id', $currentPopUpItem);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function bnb_styles()
	{
		$this->db->select('*');
		$this->db->from('styles');
		$this->db->order_by('style');
		$result = $this->db->get();
		return $result->result();
	}

	function bnb_occasions()
	{
		$this->db->select('*');
		$this->db->from('occasions');
		$this->db->order_by('occasion');
		$result = $this->db->get();
		return $result->result();
	}

	function banks_list()
	{
		$this->db->select('*');
		$this->db->from('banks_list');
		$this->db->order_by('bank_name');
		$result = $this->db->get();
		return $result->result();
	}
	function updatePickUpDate($pickDate,$orderId)
	{
		$this->db->set('orders.date_of_pickup',$pickDate);
		$this->db->where('orders.order_id',$orderId);
		if($this->db->update('orders'))
		{
			return 1;
		}
		    return 0;
	}
	function emailModel($orderId)
	{
		$this->db->select('orders.order_id');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.pg_type');
		$this->db->select('orders.date_of_pickup');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('orders.shipping_phoneno');
		$this->db->select('orders.shipping_address');
		$this->db->select('store_info.store_name');
		$this->db->select('store_owner.owner_email');
		$this->db->select('products.product_name');
		$this->db->select('products.processing_time');
		$this->db->select('products.product_id');
		$this->db->from('orders');
		$this->db->join('products', 'orders.product_id = products.product_id');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
        $this->db->join('store_info', 'orders.store_id = store_info.store_id');
        $this->db->where('order_id',$orderId);
        $query = $this->db->get(); 
            switch($query->num_rows() > 0)			
                {
                	case TRUE: $emailInfo = $query->result_array();
                	           $toBuyer = $emailInfo[0]['shipping_emailid'];
                	           $toSeller = $emailInfo[0]['owner_email'];
                	           $data['orderid'] = $emailInfo[0]['order_id'];
                	           $data['Customername'] = $emailInfo[0]['shipping_fname'].' '.$emailInfo[0]['shipping_lname'];
			                   $data['storename'] = $emailInfo[0]['store_name'];
			                   $data['productname'] = $emailInfo[0]['product_name'];
			                   $data['productcode'] = $emailInfo[0]['product_id'];
			                   $data['paymentAmount'] = $emailInfo[0]['amt_paid'];
			                   $data['paymentType'] = $emailInfo[0]['pg_type'];
			                   $data['BuyerAddress'] = $emailInfo[0]['shipping_address'];
			                   $data['BuyerMobile'] = $emailInfo[0]['shipping_phoneno'];
			                   $data['ProcessingTime'] = $emailInfo[0]['processing_time'];
			                   $data['Estimateddispatchtime'] = $emailInfo[0]['date_of_pickup'];
			                   $this->load->library('email');
				           	   $this->email->from('support@buynbrag.com', 'BuynBrag');
					           $this->email->to($toBuyer);
					           $this->email->subject("PICK UP DATE CHANGED");
                               $msg = $this->load->view('emailViewBuyer', $data, true);
                               $this->email->message($msg);

                               if($this->email->send())
						       {
						         log_message('INFO', " Successfully SENT UPDATED PICKUP DATE MAIl TO THE BUYER WITH ORDERID : ".$data['orderId']);
						       }
					           else
						       {
						         log_message('INFO', " Error sending UPDATED PICKUP DATE MAIl TO THE BUYER WITH ORDERID : ".$data['orderId']);
						       }
                    
                               $this->email->from('support@buynbrag.com', 'BuynBrag');
					           $this->email->to($toSeller);
					           $this->email->subject("PICK UP DATE CHANGED");
                               $msg = $this->load->view('emailViewSeller', $data, true);
                               $this->email->message($msg);
                               if($this->email->send())
					           {
						         log_message('INFO', " Successfully SENT UPDATED PICKUP DATE MAIl TO THE SELLER WITH ORDERID : ".$data['orderId']);
					           }
					           else
					           {
					             log_message('INFO', " Error sending UPDATED PICKUP DATE MAIL TO THE SELLER WITH ORDERID : ".$data['orderId']);
					           }
					           $this->email->from('support@buynbrag.com', 'BuynBrag');
					           $this->email->to('pranshu@buynbrag.com','himanshu.kanogiya@buynbrag.com' , 'rajat.bhagat@buynbrag.com');
					           $this->email->subject("PICK UP DATE CHANGED");
                               $msg = $this->load->view('emailViewBuynbrag', $data, true);
                               $this->email->message($msg);
                               if($this->email->send())
					           {
						         log_message('INFO', " Successfully SENT UPDATED PICKUP DATE MAIl TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }
					           else
					           {
					             log_message('INFO', " Error sending UPDATED PICKUP DATE MAIL TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }
					           $this->email->from('support@buynbrag.com', 'BuynBrag');
					           $this->email->to('pranshu@buynbrag.com','himanshu.kanogiya@buynbrag.com' , 'rajat.bhagat@buynbrag.com');
					           $this->email->subject("AWB NO UPDATED");
                               $msg = $this->load->view('emailViewBuynbrag', $data, true);
                               $this->email->message($msg);
                               if($this->email->send())
					           {
						         log_message('INFO', " Successfully SENT UPDATED PICKUP DATE MAIl TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }
					           else
					           {
					             log_message('INFO', " Error sending UPDATED PICKUP DATE MAIL TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }
					   break;
                }
	}
	function updateAwbNo($awbNo, $orderid, $dTS, $shpPartner)
	{
		$this->slog->write( array('level' => 1, 'msg' => 'inside store_model/updateAwbNo') );
		$partnerID = $this->saveShippingPartner($shpPartner);
		$this->db->set('orders.awb_no',$awbNo);
		$this->db->set('orders.deliveryTimeStamp',$dTS);
		$this->db->set('orders.shipping_partner',$partnerID);
		$this->db->where('orders.order_id',$orderid);
		if($this->db->update('orders'))
		{
			$this->slog->write( array( 'level' => 1, 'msg' => 'JUST RAN THE FOLLOWING QUERY___'.PHP_EOL.$this->db->last_query() ) );
			$this->slog->write( array( 'level' => 1, 'msg' => 'Bye Bye!') );
			return 1;
		}
		$this->slog->write( array( 'level' => 1, 'msg' => 'something fucked up the updating query.' ) );
		$this->slog->write( array( 'level' => 1, 'msg' => 'JUST RAN THE FOLLOWING QUERY___'.PHP_EOL.$this->db->last_query() ) );
		$this->slog->write( array( 'level' => 1, 'msg' => 'Bye Bye!') );
		return 0;
	}
	function emailModel2($orderId,$shpPartner)
	{
		$this->db->select('orders.order_id');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.pg_type');
		$this->db->select('orders.date_of_pickup');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('orders.shipping_address');
		$this->db->select('orders.shipping_phoneno');
		$this->db->select('orders.awb_no');
		$this->db->select('orders.deliveryTimeStamp');
		$this->db->select('store_info.store_name');
		$this->db->select('store_owner.owner_name');
		$this->db->select('store_owner.owner_number');
		$this->db->select('store_owner.owner_email');
		$this->db->select('products.product_name');
		$this->db->select('products.processing_time');
		$this->db->select('products.product_id');
		$this->db->from('orders');
		$this->db->join('products', 'orders.product_id = products.product_id');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
        $this->db->join('store_info', 'orders.store_id = store_info.store_id');
        $this->db->where('order_id',$orderId);
        $query = $this->db->get();
            switch($query->num_rows() > 0)			
               {
                	case TRUE: $emailInfo = $query->result_array();
                	           $toBuyer = $emailInfo[0]['shipping_emailid'];
                	           $toSeller = $emailInfo[0]['owner_email'];
                	           $data['orderid'] = $emailInfo[0]['order_id'];
                	           $data['Customername'] = $emailInfo[0]['shipping_fname'].' '.$emailInfo[0]['shipping_lname'];
			                   $data['storename'] = $emailInfo[0]['store_name'];
			                   $data['owner_email'] = $emailInfo[0]['owner_email'];
			                   $data['productname'] = $emailInfo[0]['product_name'];
			                   $data['ownername'] = $emailInfo[0]['owner_name'];
			                   $data['ownernumber'] = $emailInfo[0]['owner_number'];
			                   $data['awbNo'] = $emailInfo[0]['awb_no'];
			                   $data['productcode'] = $emailInfo[0]['product_id'];
			                   $data['paymentAmount'] = $emailInfo[0]['amt_paid'];
			                   $data['shipping_partner'] = $shpPartner;
			                   $data['paymentType'] = $emailInfo[0]['pg_type'];
			                   $data['BuyerAddress'] = $emailInfo[0]['shipping_address'];
			                   $data['BuyerMobile'] = $emailInfo[0]['shipping_phoneno'];
			                   $data['ProcessingTime'] = $emailInfo[0]['processing_time'];
			                   $data['Estimateddispatchtime'] = $emailInfo[0]['date_of_pickup'];
			                   $data['deliveryTimeStamp'] = $emailInfo[0]['deliveryTimeStamp'];
                               $buyermail = $this->load->view('emailViewBuyer', $data, true);
                               $this->load->model('automate_model');
			                   $jobType = 1; // an email job
			                   $jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			                   $jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			                   $jobDetails = array
							   (
								'to' => $toBuyer,
								'bcc' => 'ops@buynbrag.com',
								'subject' => "AWB NO FOR ".$data['orderid']."UPDATED",
								'msg' => $buyermail
							   );
				               $this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			                   $this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );
                               //$this->email->message($msg);

                               /*if($this->email->send())
						       {
						         //log_message('INFO', " Successfully SENT UPDATED AWBNO MAIl TO THE USER WITH ORDERID : ".$data['orderId']);
						         $this->slog->write( array('level' => 1, 'msg' => " Successfully SENT UPDATED AWBNO MAIl TO THE USER WITH ORDERID : ".$data['orderId']));
						       }
					           else
						       {
						         log_message('INFO', " Error sending UPDATED AWBNO MAIl TO THE BUYER WITH ORDERID : ".$data['orderId']);

						       }*/
                    
                               //$this->email->from('support@buynbrag.com', 'BuynBrag');
					           //$this->email->to($toSeller);
					           //$this->email->subject("AWB NO UPDATED");
                               $sellermail = $this->load->view('emailViewSeller', $data, true);
                               $this->load->model('automate_model');
			                   $jobType = 1; // an email job
			                   $jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			                   $jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			                   $jobDetails = array
							   (
								'to' => $toSeller,
								'bcc' => 'ops@buynbrag.com',
								'subject' => "AWB NO FOR ".$data['orderid']."UPDATED",
								'msg' => $sellermail
							   );
				               $this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			                   $this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );
                               /*$this->email->message($msg);
                               if($this->email->send())
					           {
						         log_message('INFO', " Successfully SENT UPDATED AWBNO MAIl TO the SELLER WITH ORDERID : ".$data['orderId']);
					           }
					           else
					           {
					             log_message('INFO', " Error sending UPDATED AWBNO MAIL TO the SELLER WITH ORDERID : ".$data['orderId']);
					           }
					           $this->email->from('support@buynbrag.com', 'BuynBrag');
					           $this->email->to('ops@buynbrag.com');
					           $this->email->subject("AWB NO UPDATED");*/
                               /*$ops = $this->load->view('emailViewBuynbrag', $data, true);
                               $this->load->model('automate_model');
			                   $jobType = 1; // an email job
			                   $jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			                   $jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			                   $jobDetails = array
							   (
								'to' => 'ops@buynbrag.com',
								'subject' => "AWB NO FOR ".$data['orderid']."UPDATED",
								'msg' => $sellermail
							   );
				               $this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			                   $this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );
                               $this->email->message($msg);
                               if($this->email->send())
					           {
						         log_message('INFO', " Successfully SENT UPDATED AWBNO MAIL TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }
					           else
					           {
					             log_message('INFO', " Error sending UPDATED AWBNO MAIL TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }*/
                         break;
                }
	}
	public function bnbNoteM($orderId,$term)
	{
		$this->db->select('orders.order_id');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.pg_type');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('orders.shipping_address');
		$this->db->select('orders.shipping_phoneno');
		$this->db->select('store_info.store_name');
		$this->db->select('store_owner.owner_email');
		$this->db->select('products.product_name');
		$this->db->select('products.product_id');
		$this->db->from('orders');
		$this->db->join('products', 'orders.product_id = products.product_id');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
        $this->db->join('store_info', 'orders.store_id = store_info.store_id');
        $this->db->where('order_id',$orderId);
        $query = $this->db->get(); 
            switch($query->num_rows() > 0)			
                {
                	case TRUE: $emailInfo = $query->result_array();
                	           $toSeller = $emailInfo[0]['owner_email'];
                	           $data['orderid'] = $emailInfo[0]['order_id'];
                	           $data['Customername'] = $emailInfo[0]['shipping_fname'].' '.$emailInfo[0]['shipping_lname'];
			                   $data['storename'] = $emailInfo[0]['store_name'];
			                   $data['term'] = $term;
			                   $data['productname'] = $emailInfo[0]['product_name'];
			                   $data['productcode'] = $emailInfo[0]['product_code'];
			                   $data['paymentAmount'] = $emailInfo[0]['amt_paid'];
			                   $data['paymentType'] = $emailInfo[0]['pg_type'];
			                   $data['BuyerAddress'] = $emailInfo[0]['shipping_address'];
			                   $data['BuyerMobile'] = $emailInfo[0]['shipping_phoneno'];
			                   //$this->load->library('email');
					           //$this->email->from('support@buynbrag.com', 'BuynBrag');
					           //$this->email->to($toBuyer);
					           //$this->email->subject("PROBLEM WITH ORDER");
                               $ops = $this->load->view('emailViewBuyer', $data, true);
                               $this->load->model('automate_model');
			                   $jobType = 1; // an email job
			                   $jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			                   $jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			                   $jobDetails = array
							   (
								'to' => 'ops@buynbrag.com',
								'subject' => "PROBLEM WITH ORDER WITH ".$data['orderid'],
								'msg' => $ops
							   );
				               $this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			                   $this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );
                               /*$this->email->message($msg);
                               if($this->email->send())
						       {
						         log_message('INFO', " Successfully SENT BNB NOTE MAIl TO THE USER WITH ORDERID : ".$data['orderId']);
						       }
					           else
						       {
						         log_message('INFO', " Error sending BNB NOTE MAIl TO THE BUYER WITH ORDERID : ".$data['orderId']);
						       }
                    
                               $this->email->from('support@buynbrag.com', 'BuynBrag');
					           $this->email->to($toSeller);
					           $this->email->subject("PROBLEM WITH ORDER");
                               $ops = $this->load->view('emailViewSeller', $data, true);
                               $this->load->model('automate_model');
			                   $jobType = 1; // an email job
			                   $jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			                   $jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			                   $jobDetails = array
							   (
								'to' => 'ops@buynbrag.com',
								'subject' => "PROBLEM WITH ORDER WITH ".$data['orderid'],
								'msg' => $ops
							   );
				               $this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			                   $this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );
                               $this->email->message($msg);
                               if($this->email->send())
					           {
						         log_message('INFO', " Successfully SENT BNB NOTE MAIl TO THE SELLER WITH ORDERID : ".$data['orderId']);
					           }
					           else
					           {
					             log_message('INFO', " Error sending BNB NOTE MAIl TO THE SELLER WITH ORDERID : ".$data['orderId']);
					           }
					           $this->email->from('support@buynbrag.com', 'BuynBrag');
					           $this->email->to('ops@buynbrag.com');
					           $this->email->subject("PROBLEM WITH ORDER");
                               $msg = $this->load->view('emailViewBuynbrag', $data, true);
                               $this->email->message($msg);
                               if($this->email->send())
					           {
						         log_message('INFO', " Successfully SENT BNB NOTE MAIl MAIl TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }
					           else
					           {
					             log_message('INFO', " Error sending BNB NOTE MAIl TO BUYNBRAG WITH ORDERID : ".$data['orderId']);
					           }*/
                         break;
                }
    }

    public function saveShippingPartner($name)
   {
	    $str = trim($name);
	    $this->db->select('shipping_company.id');
  	    $this->db->from('shipping_company');
        $this->db->like('shipping_company.name',$str); 
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
    	   $query = $query->result();
           return $query->id;
        }
        else 
        {
    	   $this->db->insert('shipping_company', array('name' => $str) );
    	   return $this->db->insert_id();
        }
    }

    public function readShippingPartners()
    {
	    $this->db->select('shipping_company.id');
	    $this->db->select('shipping_company.name');
	    $this->db->from('shipping_company');
	    $query = $this->db->get();
	    return $query->result();
    }
}
?>