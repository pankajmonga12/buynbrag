<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class order extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('slog');
	}

	//fetch store & owner information
	function myorder($store_id, $startFrom = NULL, $maxResults = NULL)
	{
		//$strname = $temp;
		//$this->db->select('*');
		$this->db->select('products.product_name');
		$this->db->select('orders.order_id');
		$this->db->select('products.store_id');
		$this->db->select('products.product_id');
		$this->db->select('orders.quantity');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.payment_status');
		$this->db->select('products.shipping_cost');
		$this->db->select('orders.status_order');
		$this->db->select('orders.date_of_pickup');
		$this->db->select('orders.txnid');
		$this->db->select("DATE_FORMAT(date_of_order , '%b %e, %Y') AS date_of_order", FALSE);
		$this->db->select('products.shipping_cost AS shipping_charge');
		$this->db->select("ifnull(orders.vsize,'0') as variant_size", false);
		$this->db->select("ifnull(orders.vcolor,'0') as variant_color", false);
		$this->db->select('(SELECT COUNT(order_id) FROM orders WHERE orders.product_id = products.product_id) AS totalOrders', FALSE);
		$this->db->from('products');
		$this->db->join('orders', 'products.product_id = orders.product_id');
		$this->db->where('products.store_id', $store_id);
		$this->db->order_by('order_id', 'DESC');

		$startFrom = (is_null($startFrom))? 0: $startFrom;
		$maxResults = (is_null($maxResults))? 30: $maxResults;

		$this->db->limit($maxResults, $startFrom * $maxResults);
		
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function myorderdetails($o_id)
	{
		$this->db->select('*');
		$this->db->select("DATE_FORMAT(date_of_order , '%b %e, %Y') AS date_of_order", FALSE);
		$this->db->select('products.shipping_cost AS shipping_charge');
		$this->db->select("ifnull(orders.vsize,'0') as variant_size", false);
		$this->db->select("ifnull(orders.vcolor,'0') as variant_color", false);
		$this->db->from('products');
		$this->db->join('orders', 'products.product_id = orders.product_id');
		$this->db->where('orders.order_id', $o_id);
		$result = $this->db->get();
		return $result->result();
	}

	function getStoreIdOrder($store_id)
	{
		//$this->db->select('*');
		$this->db->select('store_info.store_name');
		$this->db->select('store_info.storeowner_id');
		$this->db->select('store_info.store_id');
		$this->db->select('store_info.contact_name');
		$this->db->select('store_info.return_policy');
		$this->db->select('store_info.EMI_policy');
		$this->db->select('store_info.COD_policy');
		$this->db->select('store_info.fancy_counter');
		$this->db->select('store_info.visit_counter');
		$this->db->select('store_info.brag_counter');
		$this->db->from('store_info');
		$this->db->where('store_id', $store_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function myorderdetails2($order_by)
	{
		//$strname = $temp;
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('user_id', $order_by);
		$result = $this->db->get();
		return $result->result();
	}

	/*function myorderdetails3($o_id)
	{
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->join('comments', 'user_details.user_id=comments.user_id');
		$this->db->where('comments.object_id', $o_id);
		$result = $this->db->get();
		return $result->result();
	}*/

	function myorderdetails4($status, $s_id)
	{
		if ($status != 0)
		{
			$this->db->select('*');
			$this->db->select("DATE_FORMAT(date_of_order , '%b %e, %Y') AS date_of_order", FALSE);
			$this->db->select('products.shipping_cost AS shipping_charge');
			$this->db->select("ifnull(orders.vsize,'0') as variant_size", false);
			$this->db->select("ifnull(orders.vcolor,'0') as variant_color", false);
			$this->db->from('products');
			$this->db->join('orders', 'products.product_id=orders.product_id');
			$this->db->where('status_order', $status);
			if($status == 2)
			{
				$this->db->or_where('status_order', 20);
			}
		}
		else
		{
			$this->db->select('*');
			$this->db->select("DATE_FORMAT(date_of_order , '%b %e, %Y') AS date_of_order", FALSE);
			$this->db->select('products.shipping_cost AS shipping_charge');
			$this->db->select("ifnull(orders.vsize,'0') as variant_size", false);
			$this->db->select("ifnull(orders.vcolor,'0') as variant_color", false);
			$this->db->from('products');
			$this->db->join('orders', 'products.product_id=orders.product_id');
		}
		$this->db->where('products.store_id', $s_id);
		$this->db->order_by('order_id', 'DESC');
		//$this->db->limit(10);
		$result = $this->db->get();
		return $result->result();
	}

	function myorderdetails4Loader($status, $limit)
	{
		if ($status != 0) {
			$this->db->select('*');
			$this->db->select("ifnull(orders.vsize,'0') as variant_size", false);
			$this->db->select("ifnull(orders.vcolor,'0') as variant_color", false);
			$this->db->from('products');
			$this->db->join('orders', 'products.product_id=orders.product_id');
			$this->db->where('status_order', $status);
		} else {
			$this->db->select('*');
			$this->db->select("ifnull(orders.vsize,'0') as variant_size", false);
			$this->db->select("ifnull(orders.vcolor,'0') as variant_color", false);
			$this->db->from('products');
			$this->db->join('orders', 'products.product_id=orders.product_id');
		}
		$this->db->where('orders.order_id <', $limit);
		$this->db->order_by('order_id', 'DESC');
		//$this->db->limit(5);
		$result = $this->db->get();
		return $result->result();
	}

	function changeOrderStatus($status, $o_id, $date, $time)
	{
		$this->db->set('status_order', $status);
		if ($status == 2)
		{
			$this->db->set('shipinPartStatus', 1);
			$this->db->set('date_of_pickup', $date);
			$this->db->set('time_of_pickup', $time);
			$this->db->set('status_order', 20);
		}
		$this->db->where('order_id', $o_id);
		//echo $this->db->last_query();
		$retVal = $this->db->update('orders');
		if($retVal && $status == 2)
		{
			$this->db->select('orders.shipping_emailid');
			$this->db->select('orders.date_of_pickup');
			$this->db->select('orders.shipping_fname');
			$this->db->select('orders.shipping_lname');
			$this->db->select('orders.shipping_phoneno');
			$this->db->select('orders.store_id');

			$this->db->select('products.product_name');

			$this->db->select('store_info.contact_name');
			$this->db->select('store_info.contact_email');
			$this->db->select('store_info.contact_number');

			$this->db->from('orders');
			$this->db->join('products', 'orders.product_id = products.product_id', 'left');
			$this->db->join('store_info', 'orders.store_id = store_info.store_id', 'left');
			$this->db->where('orders.order_id', $o_id);

			$query = $this->db->get();

			$result = $query->result();

			$result = $result[0];

			$tData['orderID'] = $o_id;
			$tData['buyerName'] = $result->shipping_fname.' '.$result->shipping_lname;
			$tData['dispatchDate'] = date( "d-M-Y", ( strtotime($result->date_of_pickup) ) );
			$tData['productName'] = $result->product_name;
			$tData['storeContactEmail'] = $result->contact_email;
			$tData['storeContactNumber'] = $result->contact_number;

			$buyerOrderEmail20 = $this->load->view('emailers/orderEmail20Buyer', $tData, TRUE);
			$this->load->model('automate_model');
			$jobType = 1; // an email job
			$jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			/* $jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013 */
			$jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			$jobDetails = array
							(
								'to' => $result->shipping_emailid,
								'bcc' => 'neworders@buynbrag.com,shammishailaj@gmail.com',
								'subject' => "Update for your order ID ".$o_id." with BuynBrag.com",
								'msg' => $buyerOrderEmail20
							);
			$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			$this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );

			// email to bnb operations team regarding the change in pickup schedule
			$bnbOpsOrderEmail20 = $this->load->view('emailers/orderEmail20BNB', $tData, TRUE);

			$jobType = 1; // an email job
			$jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
			/* $jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013 */
			$jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
			$jobDetails = array
							(
								'to' => 'ops@buynbrag.com',
								'bcc' => 'neworders@buynbrag.com,shammishailaj@gmail.com',
								'subject' => "Update for your order ID ".$o_id." with BuynBrag.com",
								'msg' => $bnbOpsOrderEmail20ss
							);
			$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
			$this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );

			$smsNoBNB = '8130878822';
			$smsNoBuyer = $result->shipping_phoneno;

			$smsMsgBNB = "Dear Ops Team, \r\n The seller ".$result->contact_name." for store ID".$result->store_id." has started processing the order and the estimated dispatch date is: ".$tData['dispatchDate'].". Seller Contact details are: \r\n";
			$smsMsgBNB .= "Email: ".$result->contact_email.", Phone: ".$result->contact_number;

			$smsMsgBuyer = "Dear ".$result->shipping_fname." ".$result->shipping_lname."\r\n The seller has started processing your order no ".$o_id." and the estimated date of dispatch is ".$tData['dispatchDate']." Once dispatched, it will reach you in 1-5 working days. Contact us on +91-8130878822 or ops@buynbrag.com \r\n Team BuynBrag";


			$this->load->model('smsc');
			$this->smsc->sendSMS($smsNoBNB, $smsMsgBNB);
			$this->slog->write( array( 'level' => 1, 'msg' => 'Just sent an SMS to '.json_encode($smsNoBNB).'. The msg sent is <p>'.$smsMsgBNB.'</p>' ) );

			$this->smsc->sendSMS($smsNoBuyer, $smsMsgBuyer);
			$this->slog->write( array( 'level' => 1, 'msg' => 'Just sent an SMS to '.json_encode($smsNoBuyer).'. The msg sent is <p>'.$smsMsgBuyer.'</p>' ) );
		}
	}

	function addComment($data)
	{
		$this->load->database();
		$this->db->insert('comments', $data);

	}

	function updateOrderAfterComments($o_id)
	{

		$this->db->where('order_id', $o_id);
		$this->db->set('comment_count', 'comment_count+1', FALSE);
		$this->db->update('orders');

	}


	function sortmyorder($sortparam, $status, $s_id)
	{
		$this->db->select('*');
		$this->db->select("ifnull(orders.vsize,'0') as variant_size", false);
		$this->db->select("ifnull(orders.vcolor,'0') as variant_color", false);
		$this->db->from('products');
		$this->db->join('orders', 'products.product_id=orders.product_id');
		if ($status != 0) {
			$this->db->where('status_order', $status);

			if ($sortparam == 0) {
				$this->db->order_by("date_of_order", "asc");
			} else if ($sortparam == 1) {
				$this->db->order_by("date_of_order", "desc");
			} else if ($sortparam == 2) {
				$this->db->order_by("selling_price", "desc");
			} else {
				$this->db->order_by("selling_price", "asc");
			}
		} else {
			if ($sortparam == 0) {
				$this->db->order_by("date_of_order", "desc");
			} else if ($sortparam == 1) {
				$this->db->order_by("date_of_order", "asc");
			} else if ($sortparam == 2) {
				$this->db->order_by("selling_price", "desc");
			} else if ($sortparam == 3) {
				$this->db->order_by("selling_price", "asc");
			}
		}
		$this->db->where('products.store_id', $s_id);
		$result = $this->db->get();
		return $result->result();
	}
}

?>