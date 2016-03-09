<?php
class Crm_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function order_details_mob($mobile_no)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->order_by('order_id', "desc");
        $this->db->where('shipping_phoneno',$mobile_no);
        $this->db->limit(1);
        $order_details = $this->db->get();
        return $order_details->result_array();
    }
    
    public function user_details($user_id)
    {
        $this->db->select("DATE_FORMAT(joined_date , '%b %e, %Y') AS joined_date", FALSE);
        $this->db->select("DATE_FORMAT(date_of_birth , '%b %e, %Y') AS dob", FALSE);
        $this->db->from('user_details');
        $this->db->where('user_id',$user_id);
        $user_details = $this->db->get();
        $join_date = $user_details->result_array();
        return $join_date[0];
    }
    
    public function order_lists($user_id)
    {
        $this->db->select("DATE_FORMAT(date_of_order , '%b %D, %Y %r') AS date_of_order", FALSE);
        $this->db->select('orders.order_id,orders.status_order,orders.shipping_partner');
        $this->db->select('store_info.store_name,products.selling_price');
        $this->db->from('orders');
        $this->db->join('(products,store_info)','store_info.store_id = orders.store_id AND products.product_id = orders.product_id');
        $this->db->where('user_id',$user_id);
        $order_lists = $this->db->get();
        return $order_lists->result_array();
    }
    
    public function get_stores()
    {
        $this->db->select("*");
        $this->db->from('store_info');
	   $this->db->join('store_owner','store_info.store_id = store_owner.store_id');
        $stores = $this->db->get();
        $store_details = $stores->result_array();
        return $store_details;
    }
    
    public function save_stores($store_id,$v1='',$v2='',$v3='',$v4='',$v5='',$v6='',$v7='')
    {
        $s_row = array('store_name' => $v1,'marketing_name' => $v2,'store_url' => $v3,
        'contact_number' => $v5,'contact_email' => $v6);
        $this->db->where('store_id = '.$store_id);
        $this->db->update('store_info', $s_row);
        $s_row2 = array('owner_name' => $v4,'owner_city' => $v7);
        $this->db->where('store_id = '.$store_id);
        $this->db->update('store_owner', $s_row2);
        return "Data has been stored successfully!";
    }
    
    public function change_order_details($order_id)
    {
        $this->db->select("DATE_FORMAT(date_of_order , '%b %D, %Y %r') AS date_of_order", FALSE);
        $this->db->select('orders.status_order,orders.shipping_partner,orders.pg_type,orders.shipping_fname,orders.shipping_lname,orders.shipping_address,orders.shipping_city,orders.shipping_state,orders.shipping_country,orders.shipping_pincode,orders.shipping_phoneno,orders.shipping_emailid');
        $this->db->select('products.bnb_product_code,products.selling_price,products.processing_time');
        $this->db->select('store_info.store_name');
        $this->db->from('orders');
        $this->db->join('(products,store_info)','orders.product_id = products.product_id AND orders.store_id = store_info.store_id');
        $this->db->where('orders.order_id',$order_id);
        $order_details = $this->db->get();
        $order_details = $order_details->result_array();
        return $order_details[0];
    }
    
    public function save_order_changes($status,$mode,$shipping_address,$shipping_city,$shipping_state,$shipping_country,$shipping_pincode,$invoice_no)
    {
        $this->db->set('status_order',$status);
        $this->db->set('pg_type',$mode);
        $this->db->set('shipping_address',$shipping_address);
        $this->db->set('shipping_city',$shipping_city);
        $this->db->set('shipping_state',$shipping_state);
        $this->db->set('shipping_country',$shipping_country);
        $this->db->set('shipping_pincode',$shipping_pincode);
        $this->db->where('order_id',$order_id);
        if($this->db->update('orders'))
        {
            return 1;
        }
        return 0;
    }
    
    public function order_details_store($store_id,$order_status)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->join('store_info','store_info.store_id = orders.store_id');
        $this->db->where('orders.store_id = '.$store_id);
        if ($order_status>0)
            $this->db->where('orders.status_order = '.$order_status);
        $this->db->order_by('order_id', "desc");
        $order_details = $this->db->get();
        return $order_details->result_array();
        
    }

    function updateDbOnCancel($quantity,$pID)
	{
       $this->load->database();
       switch($pID > 4499)
       {
        case TRUE:  $this->db->set('products.quantity','products.quantity +'.$quantity, FALSE);
                    $this->db->set('productsNew.quantity','productsNew.quantity +'.$quantity, FALSE);
                    $this->db->where('products.product_id',$pID);
                    $this->db->where('productsNew.product_id',$pID);
                    if($this->db->update('products LEFT JOIN productsNew ON products.product_id = productsNew.product_id'))
                    {
       	               return 1;
                    }
                    else
                    {
       	               return 0;
                    }
        case FALSE: $this->db->set('products.quantity','products.quantity +'.$quantity, FALSE);
				    $this->db->where('products.product_id', $pID);
				    if($this->db->update('products'))
				    {
				    	return 1;
				    }
				    else
				    {
				    	return 0;
				    }
						
       }
	}

	function updateStatus($status,$orderID)
	{
		$data = array('status_order' => $status);
		$this->db->where('orders.order_id',$orderID);
		if($this->db->update('orders',$data))
		{
		 return 1;
		}
		else 
		{
		 return 0;
		}
	}
	
	public function maxOrderID()
	{
		$this->db->select('MAX(order_id) as maxOrderID');
		$this->db->from('orders');
		$this->db->limit(1);	
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $maxOrderID = $query->result();
			           $maxOrderID = $maxOrderID[0]->maxOrderID;
			       	   return $maxOrderID;
				   break;
			case FALSE: return FALSE;
		}
	}
	public function maxOrderbyname($name)
	{
		$this->db->select('count(*) as maxOrderID');
		$this->db->from('orders');
		$this->db->join('store_info','orders.store_id = store_info.store_id');
		$this->db->where('store_info.store_name',$name);
		$this->db->limit(1);	
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $maxOrderID = $query->result();
			           $maxOrderID = $maxOrderID[0]->maxOrderID;
			       	   return $maxOrderID;
				   break;
			case FALSE: return FALSE;
		}
	}
	public function updatepickup($date,$orderID)
	{
		$data = array(
		'date_of_pickup' => $date
		);
		$this->db->where('orders.order_id',$orderID);
		$this->db->update('orders', $data); 
		$query = $this->db->get();
		return $query->result();
	}
	public function search_by_orderid($id)
	{
		$this->db->select('*');
		$this->db->select('orders.quantity as totalQuantity' );
		$this->db->select('DATE(date_of_order) as orderdate');
		$this->db->from('orders');
		$this->db->join('store_info','store_info.store_id = orders.store_id');
		$this->db->join('products','products.product_id = orders.product_id');
		$this->db->join('store_owner','store_owner.store_id = orders.store_id');
		$this->db->where('order_id = '.$id);
		$order_details = $this->db->get();
		return $order_details->result_array();
	}
	public function vendors_details_all()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
		$order_details = $this->db->get();
		return $order_details->result_array();
	}
	public function sellermail($id)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
		$this->db->join('store_info','orders.store_id = store_info.store_id');
		$this->db->join('products','orders.store_id = products.store_id');
		$this->db->where('order_id = '.$id);
		$order_details = $this->db->get();
		return $order_details->result_array();
	}
	public function sellermail2($orderID)
	{
		$live_url = 'http://www.buynbrag.com/';
		$this->db->select('orders.order_id');
        $this->db->select('orders.amt_paid');
		$this->db->select('orders.pg_type');
		$this->db->select('orders.date_of_pickup');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('orders.shipping_address');
		$this->db->select('orders.shipping_phoneno');
		$this->db->select('orders.shipping_partner');
		$this->db->select('orders.txnid');
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.store_id');
		$this->db->select('store_owner.owner_name');
		$this->db->select('store_owner.owner_email');
		$this->db->select('products.bnb_product_code');
		$this->db->select('products.product_id');
		$this->db->select('products.product_name');
		$this->db->select('products.processing_time');
		$this->db->from('orders');
		$this->db->join('products', 'orders.product_id = products.product_id');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
        $this->db->join('store_info', 'orders.store_id = store_info.store_id');
        $this->db->where('order_id',$orderID);
        $query = $this->db->get(); 
            switch($query->num_rows() > 0)			
                {
                	case TRUE: $emailInfo = $query->result_array();
                	$toSeller = $emailInfo[0]['owner_email'];
                	if ($emailInfo[0]['shipping_partner'] == 1) 
                	{
                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/changeShippingPartnerPDF/'.$emailInfo[0]['order_id'].'/1';
                	}
                	elseif ($emailInfo[0]['shipping_partner'] == 2) 
                	{
                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/changeShippingPartnerPDF/'.$emailInfo[0]['order_id'].'/2';
                	}
                	elseif ($emailInfo[0]['shipping_partner'] == 3) 
                	{
                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/changeShippingPartnerPDF/'.$emailInfo[0]['order_id'].'/3';
                	}
                	else 
                	{   
                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/sellerInvoicePDFNew/'.$emailInfo[0]['order_id'];
                    }
                	$data['orderid'] = $emailInfo[0]['order_id'];
                	$data['Customername'] = $emailInfo[0]['shipping_fname'].' '.$emailInfo[0]['shipping_lname'];
                	$data['ownername'] = $emailInfo[0]['owner_name'];
                	$data['paymentAmount'] = $emailInfo[0]['amt_paid'];
                	$data['filename1'] = $live_url.'invoice/'.$emailInfo[0]['txnid'].'/buyer_invoice_order_'.$emailInfo[0]['order_id'].'.pdf';
                	$data['image'] = 'https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/'.$emailInfo[0]['store_id'].'/'.$emailInfo[0]['product_id'].'/fancy1.jpg';
			        $data['storename'] = $emailInfo[0]['store_name'];
			        $data['productname'] = $emailInfo[0]['product_name'];
			        $data['productcode'] = $emailInfo[0]['bnb_product_code'];
			        $data['BuyerAddress'] = $emailInfo[0]['shipping_address'];
			        $data['paymentType'] = $emailInfo[0]['pg_type'];
			        $data['BuyerMobile'] = $emailInfo[0]['shipping_phoneno'];
			        $data['ProcessingTime'] = $emailInfo[0]['processing_time'];
			        $data['Estimateddispatchtime'] = date( "d-M-Y", ( strtotime($emailInfo[0]['date_of_pickup']) ) );
			        $sellermail = $this->load->view('emailers/orderDetailsView', $data, true);
			        $this->load->model('automate_model');
			        $jobType = 1; // an email job
			        $jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			        $jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			        $jobDetails = array
							(
								'to' => $toSeller,
								'bcc' => 'ops@buynbrag.com',
								'subject' => "ORDER DETAILS FOR ORDER ID".$data['orderid'],
								'msg' => $sellermail
							);
				    $this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			        $this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );
			
			        /*$this->load->library('email');
					$this->email->from('support@buynbrag.com', 'BuynBrag');
					$this->email->to($toBuyer,'ops@buynbrag.com');
					$this->email->subject("ORDER DETAILS");
                    $msg = $this->load->view('orderDetailsView', $data, true);
                    $this->email->message($msg);
                     if($this->email->send())
						       {
		
						         $this->slog->write( array('level' => 1, 'msg' => " Successfully SENT ORDER DETAILS MAIl TO THE Seller WITH ORDERID : ".$data['orderId']));
						       }
					           else
						       {
						         $this->slog->write(array('level' => 1, 'msg' => " Error sending ORDER DETAILS MAIl TO THE Seller WITH ORDERID : ".$data['orderId']));

						       }*/
				}   break;
    }
	public function order_details_all($order_status, $startFrom = NULL, $maxResults = NULL)
	{
        //$this->db->select('*');
		$this->db->select('orders.order_id');
		$this->db->select('orders.date_of_pickup');
		$this->db->select('orders.quantity as totalQuantity' );
		$this->db->select('orders.awb_no');
		$this->db->select('orders.status_order');
		$this->db->select('orders.vsize');
		$this->db->select('orders.vcolor');
		$this->db->select('orders.pg_type');
		$this->db->select('orders.redeemedprice');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.date_of_order as orderdate');
		$this->db->select('orders.shipping_partner');
		$this->db->select('orders.txnid');
		$this->db->select('orders.product_id');
		$this->db->select('orders.store_id');
        $this->db->select('products.product_name');
		$this->db->select('products.bnb_product_code');
		$this->db->select('products.discount');
		$this->db->select('products.seller_earnings');
		$this->db->select('products.processing_time');
		$this->db->select('store_info.store_name');
		$this->db->from('orders');
		$this->db->join('products','orders.product_id = products.product_id','left');
		$this->db->join('store_info','orders.store_id = store_info.store_id','left');
		if($order_status > 0)
		{
			$this->db->where('orders.status_order = '.$order_status);
		}
		$this->db->order_by('order_id', "desc");
		if(! is_null($startFrom) )
		{
			if( is_null($maxResults) )
			{
				$maxResults = 50;
			}
			$startFrom *= $maxResults;
			$this->db->limit($maxResults, $startFrom);
		}
		$order_details = $this->db->get();
		log_message("INFO", "just ran the following query_____\r\n".$this->db->last_query());
		return $order_details->result_array();
	}

	public function store_names()
	{
		$this->db->select('store_name');
		$this->db->from('store_info');
		$order_details = $this->db->get();
		return $order_details->result_array();
	}
	public function bydate($date)
	{
		$this->db->select('*');
		$this->db->select('orders.quantity as totalQuantity' );
		$this->db->select('DATE(date_of_order) as orderdate');
		$this->db->from('orders');
		$this->db->join('store_info','store_info.store_id = orders.store_id');
		$this->db->join('products','products.product_id = orders.product_id');
		$this->db->join('store_owner','store_owner.store_id = orders.store_id');
		$this->db->where('Date(date_of_order)',$date);
		$order_details = $this->db->get();
		return $order_details->result_array();
	}
	public function pudate($date)
	{
		$this->db->select('*');
		$this->db->select('orders.quantity as totalQuantity' );
		$this->db->select('DATE(date_of_order) as orderdate');
		$this->db->from('orders');
		$this->db->join('store_info','store_info.store_id = orders.store_id');
		$this->db->join('products','products.product_id = orders.product_id');
		$this->db->join('store_owner','store_owner.store_id = orders.store_id');
		$this->db->where('date_of_pickup',$date);
		 $this->db->order_by('order_id', "desc");
		$order_details = $this->db->get();
		return $order_details->result_array();
	}
	public function pickup($date)
	{
		$this->db->select('*');
		$this->db->select('DATE(date_of_order) as orderdate');
		$this->db->from('orders');
		$this->db->join('store_info','store_info.store_id = orders.store_id');
		$this->db->join('products','products.product_id = orders.product_id');
		$this->db->join('store_owner','store_owner.store_id = orders.store_id');
		$this->db->where('date_of_pickup',$date);
		$order_details = $this->db->get();
		return $order_details->result_array();
	}
	public function order_details_storebyname($name, $order_status, $startFrom = NULL, $maxResults = NULL)
	{
		$this->db->select('*');
		$this->db->select('DATE(date_of_order) as orderdate');
        $this->db->from('orders');
		$this->db->join('store_info','store_info.store_id = orders.store_id');
		$this->db->join('products','products.product_id = orders.product_id');
		$this->db->join('store_owner','store_owner.store_id = orders.store_id');
		$this->db->where('store_info.store_name',urldecode($name));
		if($order_status > 0)
		{
			$this->db->where('orders.status_order = '.$order_status);
		}
		$this->db->order_by('order_id', "desc");
		if(! is_null($startFrom) )
		{
			if( is_null($maxResults) )
			{
				$maxResults = 50;
			}
			$startFrom *= $maxResults;
			$this->db->limit($maxResults, $startFrom);
		}
		$order_details = $this->db->get();
		log_message("INFO", "just ran the following query_____\r\n".$this->db->last_query());
		return $order_details->result_array();
	}
    
	public function generateBatchForOrder($orderID)
	{
		/*
	1.	Read the orders.date_of_pickup(A), orders.time_of_pickup(B), orders.store_id(C), orders.order_id(D) where order_id = $orderID
	2.	Create a unix timestamp UT as (A+B)
	3.	Read batches.id, where batches.store_id = C  and batches.timestamp = UT order by batches.id desc, Call the result RB
	4.	if(RB->num_rows() > 0)
	5.	{
	6.		Read the first entry in RB as it contains the latest entry. Call it BID
	7.		if(BID->num_rows() > 0)
	8.		{
	9.			Read batch_items.refBatchID, batch_items.refOrderID, batch_items.status where refBatchID = BID->id and refOrderID = D. Call it BIID
	10.			if(BIID->num_rows() > 0)
	11.			{
	12.				Read batch_items_ts.refBatchItemID, batch_items_ts.ts, batch_items_ts.status, batch_items_ts.remarks
	13.				where batch_items_ts.status = BIID->status and batch_items_ts.refBatchID =  BIID->id. Call it BIITS 
	14.				if(BIITS->num_rows() <= 0)
	15.				{
	16.					insert into batch_items_ts(refBatchItemID, ts, status, remarks) values(BIID->id, UNIX_TIMESTAMP(CURRENT_TIMESTAMP), BIID->status, 'DEFAULT STATUS GENERATED BY THE SYSTEM')
	17.				}
	18.			}
	19.			else
	20			{
	21				insert into batch_items(refBatchID, refOrderID, status) values(BID->id, D, 0). Call the insertID generated as BIID
	22.				insert into batch_items_ts(refBatchItemID, ts, status, remarks) values(BIID->id, UNIX_TIMESTAMP(CURRENT_TIMESTAMP), BIID->status, 'DEFAULT STATUS GENERATED BY THE SYSTEM')
	23.			}
	24.		}
	25.	}
	26.	else
	27.	{
	28.		insert into batches(store_id, timestamp) values(C, UT). Call the insertID generated as BID
	29.		insert into batch_items(refBatchID, refOrderID, status) values(BID->id, D, 0). Call the insertID generated as BIID
	30.		insert into batch_items_ts(refBatchItemID, ts, status, remarks) values(BIID->id, UNIX_TIMESTAMP(CURRENT_TIMESTAMP), 0, 'DEFAULT STATUS GENERATED BY THE SYSTEM')
	31.		status --- 0 = default/reserved/no idea, 1 out for pickup, 2 picked-up, 3 in transit, 4 out for delivery, 5 delivered, 6 problem with pickup, 7 problem with delivery
	32.	}
	33.	*/
		
		/* Algo line number 1 */
		$this->db->select('date_of_pickup');
		$this->db->select('time_of_pickup');
		$this->db->select('store_id');
		$this->db->select('order_id');
		$this->db->from('orders');
		$this->db->where('order_id', $orderID);
		$this->db->order_by('order_id', 'desc');
		$query1 = $this->db->get();
		switch($query1->num_rows() > 0)
		{
			case TRUE: $result1 = $query1->result();
					 /* Algo line number 2 */
					 $ut = strtotime($result1[0]->date_of_pickup." ".$result1[0]->time_of_pickup);
					 $c = $result1[0]->store_id;
					 $d = $result1[0]->order_id;
					 /* Algo line number 3 */
					 $this->db->select('batches.id');
					 $this->db->from('batches');
					 $this->db->where('batches.store_id', $c);
					 $this->db->where('batches.timestamp', $ut);
					 $this->db->order_by('id', 'desc');
					 $this->db->limit(1);
					 $rb = $this->db->get();
					 switch($rb->num_rows() > 0)
					 {
						case TRUE: $bid = $rb->result();
								 $this->db->select('batch_items.refBatchID');
								 $this->db->select('batch_items.refOrderID');
								 $this->db->select('batch_items.status');
								 $this->db->where('refBatchID', $bid[0]->id);
								 $this->db->where('refOrderID', $d);
								 $biid = $this->db->get();
								 switch($biid->num_rows() > 0)
								 {
									case TRUE: $this->db->select('batch_items_ts.refBatchItemID');
											 $this->db->select('batch_items_ts.ts');
											 $this->db->select('batch_items_ts.status');
											 $this->db->select('batch_items_ts.remarks');
											 $this->db->where('batch_items_ts.status', $biid[0]->status);
											 $this->db->where('batch_items_ts.refBatchID', $biid[0]->id);
											 $biits = $this->db->get();
											 switch($biits->num_rows() <= 0)
											 {
												case TRUE: $this->db->set('refBatchItemID', $biid[0]->id);
														 $this->db->set('ts', time());
														 $this->db->set('status', $biid[0]->status);
														 $this->db->set('remarks', 'DEFAULT STATUS GENERATED BY THE SYSTEM');
														 switch($this->db->insert('batch_items_ts'))
														 {
															case TRUE: return array(TRUE, "ALL DONE AND OK");
																break;
															case FALSE: return array(FALSE, "UNABLE TO GENERATE BATCH_ITEMS_TS");
																break;
														 }
													break;
												case FALSE: return array(TRUE, "ALL DONE ALREADY");
													break;
											 }
										break;
									case FALSE: $this->db->set('refBatchID', $bid[0]->id);
											 $this->db->set('refOrderID', $d);
											 $this->db->set('status', 0);
											 switch($this->db->insert('batch_items'))
											 {
												case TRUE: $biid = $this->db->insert_id(); // get the batch_items ID
														 $this->db->set('refBatchItemID', $biid);
														 $this->db->set('ts', time());
														 $this->db->set('status', 0);
														 $this->db->set('remarks', 'DEFAULT STATUS GENERATED BY THE SYSTEM');
														 switch($this->db->insert('batch_items_ts'))
														 {
															case TRUE: return array(TRUE, "ALL OK");
																break;
															case FALSE: return array(TRUE, "Unable to create batch_items_ts in DB");
																break;
														 }
													break;
												case FALSE: return array(FALSE, "Unable to create batch_item in DB");
													break;
											 }
										break;
								 }
							break;
						case FALSE: $this->db->set('store_id', $c);
								  $this->db->set('timestamp', $ut);
								  switch($this->db->insert('batches'))
								  {
									case TRUE: $bid = $this->db->insert_id(); // get the batch ID
											 $this->db->set('refBatchID', $bid);
											 $this->db->set('refOrderID', $orderID);
											 $this->db->set('status', 0);
											 switch($this->db->insert('batch_items'))
											 {
												case TRUE: $biid = $this->db->insert_id(); // get the batch_items ID
														 $this->db->set('refBatchItemID', $biid);
														 $this->db->set('ts', time());
														 $this->db->set('status', 0);
														 $this->db->set('remarks', 'DEFAULT STATUS GENERATED BY THE SYSTEM');
														 switch($this->db->insert('batch_items_ts'))
														 {
															case TRUE: return array(TRUE, "ALL OK");
																break;
															case FALSE: return array(TRUE, "Unable to create batch_items_ts in DB");
																break;
														 }
													break;
												case FALSE: return array(FALSE, "Unable to create batch_item in DB");
													break;
											 }
										break;
									case FALSE: array(FALSE, "Unable to create batch in DB for manifest ID ".$c);
										break;
								  }
							break;
					 }
				break;
			case FALSE: return array(FALSE, "OrderID does not exist");
				break;
		}
	}
    
	public function seller_order_modify($order_id, $status, $shippingdate, $shippingtime)
	{
		log_message('INFO', "inside crm/seller_order_modify(\$order_id,\$status,\$shippingdate='',\$shippingtime='') === (".$order_id.", ".$status.", ".$shippingdate.", ".$shippingtime.")");
		$status = (int)$status;
		$this->db->set('status_order',$status);
		$returnString = NULL;
		$dateSet = FALSE;
		if ($status==3)
		{
			log_message('INFO', "status = 3 and hence setting date and time of pickup");
			$this->db->set('date_of_pickup',$shippingdate);
			$this->db->set('time_of_pickup',$shippingtime);
			$dateSet = TRUE;
		}
		$this->db->where('order_id',$order_id);
		if($this->db->update('orders'))
		{
			switch($dateSet)
			{
				case TRUE: $this->generateBatchForOrder($order_id);
					break;
			}
			$returnString = "<p>Status has been successfully changed for Order No: ".$order_id."</p>";
		}
		else
		{
			$returnString = "<p>Some Problem has occured. Try Again.</p>";
		}
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY______________________________\r\n".$this->db->last_query());
		log_message('INFO', "Exiting crm_model/seller_order_modify. \$returnString = ".print_r($returnString, TRUE));
		return $returnString;
	}
   
   /* new Shipping label functions ported from main Website by Shammi Shailaj */
	public function orderShippingDetails($order_id)
	{
		$this->db->select('shipping_partner, payment_status, txnid');
		$this->db->from('orders');
		$this->db->where('order_id', $order_id);
		$result = $this->db->get();
		switch($result->num_rows() > 0)
		{
			case TRUE: return $result->result();
				break;
			case FALSE: return FALSE;
				break;
		}
	}
	
	
	public function fetchAWBNO($orderID)
	{
		$this->db->select('awb_no');
		$this->db->from('orders');
		$this->db->where('order_id', $orderID);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row['awb_no'];
	}
	
	public function hasValidAWBNO($orderID, $shippingType)
	{
		/* QUERY BEING USED ==================================================
		SELECT
		orders.awb_no, orders.shipping_partner
		FROM orders
		JOIN docket_series ON docket_series.shipping_partner = orders.shipping_partner
		WHERE orders.order_id = 973 AND docket_series.shipping_type = 2 AND orders.awb_no >= docket_series.first_num AND orders.awb_no <= docket_series.last_num;
		*/
		// read the awb_no and shipping_partner for this order
		log_message('INFO', "inside crm_model/hasValidAWBNO. ARGS:: orderID = ".$orderID.", shippingType = ".$shippingType);
		$this->db->select('order_id');
		$this->db->from('orders');
		$this->db->join('docket_series', 'docket_series.shipping_partner = orders.shipping_partner');
		$this->db->where("orders.order_id = ".$orderID." AND docket_series.shipping_type = ".$shippingType." AND orders.awb_no >= docket_series.first_num AND orders.awb_no <= docket_series.last_num");
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY____________________________________________________________________\r\n".$this->db->last_query());
		return ($query->num_rows() > 0);
	}
	
	public function setAWBNO($orderID, $awbNo)
	{
		log_message('INFO', "inside crm_model/setAWBNO. ARGS:: orderID = ".$orderID.", awbNo = ".$awbNo);
		$this->db->set('awb_no', $awbNo);
		$this->db->where('order_id', $orderID);
		return $this->db->update('orders');
	}
	
	public function sellerInvoiceData($orderID)
	{
		$this->db->select('orders.*');
		$this->db->select("DATE_FORMAT(orders.date_of_order , '%e/%c/%Y') AS date_of_order", FALSE);
		$this->db->select('products.tax_rate,products.product_name,products.bnb_product_code,products.prd_act_weight,products.prd_vol_weight');
		$this->db->select('store_info.*');
		$this->db->select('orders.invoice_no');
		$this->db->from('orders');
		$this->db->join('(products,store_info)', 'orders.product_id = products.product_id AND orders.store_id = store_info.store_id');
		$this->db->where('orders.order_id', $orderID);
		$result = $this->db->get();
		switch($result->num_rows() > 0)
		{
			case TRUE: return $result->row_array();
				break;
			case FALSE: return FALSE;
				break;
		}
	}
	
	function fetchRoutingCodeCOD($pinCode)
	{
		$this->db->select('destination_code');
		$this->db->from('bd_cod_routing_code');
		$this->db->where('pin', $pinCode);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row['destination_code'];
	}
	
	
	function fetchRoutingRetcodeCOD($pinCode)
	{
		$this->db->select('return_code,retpin');
		$this->db->from('bd_cod_routing_code');
		$this->db->where('pin', $pinCode);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row;
	}

	function fetchRoutingCodePaid($pinCode)
	{
		$this->db->select('destination_code');
		$this->db->from('bd_prepaid_routing_code');
		$this->db->where('pin', $pinCode);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row['destination_code'];
	}
	
	function shipping_partner($order_id)
	{
		$this->db->select('shipping_partner,payment_status,txnid,awb_no');
		$this->db->from('orders');
		$this->db->where('order_id', $order_id);
		$result = $this->db->get();
		$result = $result->row_array();
		return $result;
	}
	
	public function docket_no($shipping_partner, $shipping_type)
	{
		
		$this->db->select('current_num');
		$this->db->from('docket_series');
		$this->db->where('lock', 0);
		$this->db->where('shipping_partner', $shipping_partner);
		$this->db->where('shipping_type', $shipping_type);
		$this->db->where('current_num <= last_num'); // pick a number only if it is less than or equal to the maxia in the range stored
		$result = $this->db->get();
		
//        $this->db->set('current_num',$result['current_num']+11);
//        $this->db->where('current_num',$result['current_num']);
//        $this->db->update('docket_series');
		$result = $result->result();
		$result = $result[0];
		$docket_num = $result->current_num;
		return $docket_num;
	}
	
	public function updateShippingPartner($orderID, $shippingPartner)
	{
		$this->db->set('shipping_partner', $shippingPartner);
		$this->db->where('order_id', $orderID);
		return $this->db->update('orders');
	}
	
	function update_docket($order_id, $shipping_partner, $docket_number, $shipping_type)
	{
		$this->db->set('awb_no', $docket_number);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders');
		$docket_array = str_split($docket_number);
		$count = count($docket_array);
		$last_digit = (int)$docket_array[$count-1];

		if($last_digit == 6 && $shipping_partner == 2)
		{
			$this->db->query("UPDATE `docket_series` SET `current_num` = `current_num` + 4 WHERE `shipping_partner` = ".$shipping_partner." AND `shipping_type` = ".$shipping_type);
			/* set lock = 1(thereby rendering it useless) on docket_series if the current_num has exceeded the range */
			$this->db->query("UPDATE `docket_series` SET `lock` = 1 WHERE `shipping_partner` = ".$shipping_partner." AND `shipping_type` = ".$shipping_type." AND `current_num` > `last_num`");
		}
		else
		{
			$this->db->query("UPDATE `docket_series` SET `current_num` = `current_num` + 11 WHERE `shipping_partner` = ".$shipping_partner." AND `shipping_type` = ".$shipping_type);
			/* set lock = 1(thereby rendering it useless) on docket_series if the current_num has exceeded the range */
			$this->db->query("UPDATE `docket_series` SET `lock` = 1 WHERE `shipping_partner` = ".$shipping_partner." AND `shipping_type` = ".$shipping_type." AND `current_num` > `last_num`");
		}
	}
	
	public function ownerEMAIL($toSeller,$orderID)
	{
		$live_url = 'http://www.buynbrag.com/';
		$this->db->select('orders.order_id');
        $this->db->select('orders.amt_paid');
		$this->db->select('orders.pg_type');
		$this->db->select('orders.date_of_pickup');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('orders.shipping_address');
		$this->db->select('orders.shipping_phoneno');
		$this->db->select('orders.shipping_partner');
		$this->db->select('orders.txnid');
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.store_id');
		$this->db->select('store_owner.owner_name');
		$this->db->select('store_owner.owner_email');
		$this->db->select('products.bnb_product_code');
		$this->db->select('products.product_id');
		$this->db->select('products.product_name');
		$this->db->select('products.processing_time');
		$this->db->from('orders');
		$this->db->join('products', 'orders.product_id = products.product_id');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
        $this->db->join('store_info', 'orders.store_id = store_info.store_id');
        $this->db->where('order_id',$orderID);
        $query = $this->db->get(); 
	    switch($query->num_rows() > 0)			
        {
        	case TRUE:	$emailInfo = $query->result_array();
	                	
	                	if ($emailInfo[0]['shipping_partner'] == 1) 
	                	{
	                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/changeShippingPartnerPDF/'.$emailInfo[0]['order_id'].'/1';
	                	}
	                	elseif ($emailInfo[0]['shipping_partner'] == 2) 
	                	{
	                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/changeShippingPartnerPDF/'.$emailInfo[0]['order_id'].'/2';
	                	}
	                	elseif ($emailInfo[0]['shipping_partner'] == 3) 
	                	{
	                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/changeShippingPartnerPDF/'.$emailInfo[0]['order_id'].'/3';
	                	}
	                	else 
	                	{   
	                		$data['shippingpartner'] = $live_url.'bnb_crm/index.php/crm/sellerInvoicePDFNew/'.$emailInfo[0]['order_id'];
	                    }
	                	$data['orderid'] = $emailInfo[0]['order_id'];
	                	$data['Customername'] = $emailInfo[0]['shipping_fname'].' '.$emailInfo[0]['shipping_lname'];
	                	$data['ownername'] = $emailInfo[0]['owner_name'];
	                	$data['paymentAmount'] = $emailInfo[0]['amt_paid'];
	                	$data['filename1'] = $live_url.'invoice/'.$emailInfo[0]['txnid'].'/buyer_invoice_order_'.$emailInfo[0]['order_id'].'.pdf';
	                	$data['image'] = 'https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/'.$emailInfo[0]['store_id'].'/'.$emailInfo[0]['product_id'].'/fancy1.jpg';
				        $data['storename'] = $emailInfo[0]['store_name'];
				        $data['productname'] = $emailInfo[0]['product_name'];
				        $data['productcode'] = $emailInfo[0]['bnb_product_code'];
				        $data['BuyerAddress'] = $emailInfo[0]['shipping_address'];
				        $data['paymentType'] = $emailInfo[0]['pg_type'];
				        $data['BuyerMobile'] = $emailInfo[0]['shipping_phoneno'];
				        $data['ProcessingTime'] = $emailInfo[0]['processing_time'];
				        $data['Estimateddispatchtime'] = date( "d-M-Y", ( strtotime($emailInfo[0]['date_of_pickup']) ) );
				        $sellermail = $this->load->view('emailers/orderDetailsView', $data, TRUE);

				        //echo $sellermail;
	                    $this->load->library('email');
						$this->email->from('support@buynbrag.com', 'BuynBrag');
						$this->email->to($toSeller);
						$this->email->bcc('ops@buynbrag.com');
						$this->email->subject("ORDER DETAILS FOR ORDER ID:".$data['orderid']);
                        $this->email->message($sellermail);
                        $this->email->set_newline("\r\n");
						if($this->email->send())
						{
						  echo(" Successfully SENT TO STORE OWNER WITH PORDUCT ID : ".$orderID." and email ".$toSeller);
						}
						else
						{
						   echo(" Error sending TO STORE OWNER WITH PORDUCT ID : ".$orderID." and email ".$toSeller);
						   show_error($this->email->print_debugger()); 
						}
				break;
		}			
	}
	
	function updateAWBNO($updateAWBNO,$orderid) 
	{
        $this->db->set('awb_no', $updateAWBNO);
        $this->db->set('status_order', 3);
		$this->db->where('order_id', $orderid);
		return $this->db->update('orders');
	}

    
   /* END new Shipping label functions ported from main Website by Shammi Shailaj */
   function orderDeliveredModel($orderid)
   {
   	    $this->db->select('orders.order_id');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.pg_type');
		$this->db->select('orders.date_of_pickup');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('store_info.store_name');
		$this->db->select('store_owner.owner_email');
		$this->db->select('products.product_name');
		$this->db->select('products.processing_time');
		$this->db->select('products.product_id');
		$this->db->select('user_details.full_name');
		$this->db->select('user_details.address');
		$this->db->select('user_details.mob');
		$this->db->from('orders');
		$this->db->join('products', 'orders.product_id = products.product_id');
		$this->db->join('store_owner','orders.store_id = store_owner.store_id');
        $this->db->join('store_info', 'orders.store_id = store_info.store_id');
        $this->db->join('user_details', 'orders.user_id = user_details.user_id');
        $this->db->where('order_id',$orderid);
        $query = $this->db->get(); 
        $row = $$query->result_array();
        switch($row->num_rows() > 0)			
        {
        	case TRUE:	$emailInfo = $row->result();
			        	$toBuyer = $emailInfo[0]['shipping_emailid'];
			        	$toSeller = $emailInfo[0]['owner_email'];
			        	$data['orderid'] = $emailInfo[0]['order_id'];
			        	$data['Customername'] = $emailinfo[0]['shipping_fname'].' '.$emailinfo[0]['shipping_lname'];
				        $data['storename'] = $emailInfo[0]['store_name'];
				        $data['productname'] = $emailInfo[0]['product_name'];
				        $data['productcode'] = $emailInfo[0]['product_code'];
				        $data['paymentAmount'] = $emailInfo[0]['amt_paid'];
				        $data['paymentType'] = $emailInfo[0]['pg_type'];
				        $data['BuyerName'] = $emailInfo[0]['full_name'];
				        $data['BuyerAddress'] = $emailInfo[0]['address'];
				        $data['BuyerMobile'] = $emailInfo[0]['mob'];
				        $data['ProcessingTime'] = $emailInfo[0]['processing_time'];
				        $data['Estimateddispatchtime'] = $emailInfo[0]['date_of_pickup'];
				        $this->load->library('email');
						$this->email->from('support@buynbrag.com', 'BuynBrag');
						$this->email->to($toBuyer);
						$this->email->subject("PICK UP DATE CHANGED");
			            $msg = $this->load->view('emailviewbuyer', $data, true);
			            $this->email->message($msg);

			            if($this->email->send())
						{
							log_message('INFO', " Successfully SENT following MAIl TO THE USER WITH ORDERID : ".$data['orderid']);
						}
						else
						{
							log_message('INFO', " Error sending following MAIl TO THE BUYER WITH ORDERID : ".$data['orderid']);
						}
            
			            $this->email->from('support@buynbrag.com', 'BuynBrag');
						$this->email->to($toSeller);
						$this->email->subject("PICK UP DATE CHANGED");
			            $msg = $this->load->view('emailviewseller', $data, true);
			            $this->email->message($msg);
            			if($this->email->send())
						{
							log_message('INFO', " Successfully SENT following MAIl TO THE SELLER WITH ORDERID : ".$data['orderid']);
						}
						else
						{
							log_message('INFO', " Error sending following TO THE SELLER WITH ORDERID : ".$data['orderid']);
						}
				break;
		}
		return 1;
   }

   function beforeCheckoutData($transID)
    {
      $this->db->select('beforeCheckout.bcData');
      $this->db->where("beforeCheckout.txnid",$transID );
      $this->db->from('beforeCheckout');
      $query = $this->db->get();
      return $query->result_array();
    }
    function afterCheckoutData($transID)
    {
      $this->db->select('afterCheckout.acData');
      $this->db->where("afterCheckout.txnid",$transID );
      $this->db->from('afterCheckout');
      $query = $this->db->get();
      return $query->result_array();
    }
}
?>
