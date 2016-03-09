<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_queue extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
	}


	function index()
	{
		$this->shipped_email(0);
		//$this->cancelled_email($this->session->userdata('store_id'));
	}

	function shipped_email($store_id = 0)
	{
		$this->load->model('vc_orders');
		$base_url = base_url();
		$mail_info = $this->vc_orders->shipped_mail_details($store_id);
		if ($mail_info != 0 && $this->input->ip_address() != '127.0.0.1') {
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
					$track_link = 'http://www.bluedart.com/htotrack.html'; else
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
					echo "Order ID, $order_no shipped to $shipped_email_id <br>";
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


}
?>
