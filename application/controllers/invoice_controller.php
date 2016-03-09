<?php
//session_start();
class Invoice_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('contestdb');
		$this->load->model('invoice_model');
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
	}

	public function index($order_id, $txn_id) // For Generating Barcode in case of Shipping_partner = 1 or 2.
	{
		$shipping_details = $this->invoice_model->shipping_partner($order_id);
		$shipping_partner = (int)$shipping_details['shipping_partner'];
		if ($shipping_partner == 2) {
			if ($shipping_details['payment_status'] != 1)
				$shipping_type = 0;
			else
				$shipping_type = 1;
		} else
			$shipping_type = 1;
		if ($shipping_partner != 3) {
			$docket_number = $this->invoice_model->docket_no($shipping_partner, $shipping_type);
			$this->invoice_model->update_docket($order_id, $shipping_partner, $docket_number, $shipping_type);
			$_SESSION['order_id'] = $order_id;
			$_SESSION['txn_id'] = $txn_id;
			$_SESSION['docket_number'] = $docket_number;
			$_SESSION['over_write'] = 0;
			$_SESSION['base_url'] = base_url('index.php/invoice_controller/seller_invoice');
			$url = base_url("barcode/barcode.php");
			redirect($url);
		} else {
			$url = base_url("index.php/invoice_controller/seller_invoice/0/" . $order_id . '/' . $txn_id);
			redirect($url);
		}
	}

	public function redirecting_to_bnb($txnid, $first_time = 0) //save_buyer_invoice
	{
		$base_url = base_url();
		$order_details = $this->invoice_model->save_invoice($txnid);
		if ($first_time == 0)
			$_SESSION['order_count'] = count($order_details);
		else
			$_SESSION['order_count'] = (int)$_SESSION['order_count'] - 1;

		if ((int)$_SESSION['order_count'] == 0)
		{
			unset($_SESSION['invoice_orders']);
			unset($_SESSION['order_count']);
			$sucess_url = base_url("index.php/order2/payment_success");
			//redirect($sucess_url, 'refresh');
			redirect($sucess_url);
		} else {
			$_SESSION['invoice_orders'] = $order_details[(int)$_SESSION['order_count'] - 1];
			$url = base_url("index.php/invoice_controller/redirectingback/" . $txnid);
			redirect($url);
		}

	}

	public function redirectingback($txnid) //generate buyer_invoice
	{
		$base_url = base_url();
		$order_details = $_SESSION['invoice_orders'];
		$routing_code['destination_code'] = '';
		$routing_code['return_code'] = '';
		$routing_code['retpin'] = '';
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 2)
		{
			$routing_code = $this->invoice_model->fetch_routing_retcode_cod($order_details['return_pincode']);
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_cod($order_details['shipping_pincode']);
		}
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 1)
		{
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_paid($order_details['shipping_pincode']);
		}
		include 'save_buyer_invoice.php';
		$file_path = './invoice/' . $txnid;
		if(!file_exists($file_path))
		{
			mkdir($file_path, 0777);
		}
		$pdfcode = $this->cezpdf->output();
		$fp = fopen($file_path . '/buyer_invoice_order_' . $order_details['order_id'] . '.pdf', 'wb');
		fwrite($fp, $pdfcode);
		fclose($fp);
		$url = base_url("index.php/invoice_controller/redirecting_to_bnb/" . $txnid . '/1');
		redirect($url);
	}

	public function buyer_invoice($order_id)
	{
		$base_url = base_url();
		$order_details = $this->invoice_model->buyer_invoice($order_id);
		$routing_code['destination_code'] = '';
		$routing_code['return_code'] = '';
		$routing_code['retpin'] = '';
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 2) {
			$routing_code = $this->invoice_model->fetch_routing_retcode_cod($order_details['return_pincode']);
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_cod($order_details['shipping_pincode']);
		}
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 1) {
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_paid($order_details['shipping_pincode']);
		}
		include_once 'invoice_buyer.php';
		$this->cezpdf->ezStream();
	}

	public function seller_invoice($barcode, $order_id, $txn_id, $over_write = 0) // Shipping Label
	{
		$base_url = base_url();
		$order_details = $this->invoice_model->seller_invoice($order_id);
		$routing_code['destination_code'] = '';
		$routing_code['return_code'] = '';
		$routing_code['retpin'] = '0';
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 2) {
			$routing_code = $this->invoice_model->fetch_routing_retcode_cod($order_details['return_pincode']);
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_cod($order_details['shipping_pincode']);
		}
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 1) {
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_paid($order_details['shipping_pincode']);
		}
		include_once 'invoice_seller.php';
		$this->cezpdf->ezNewPage();
		include 'invoice_buyer.php';
//            $this->cezpdf->ezStream();
		$file_path = "./invoice/$txn_id";
		$pdfcode = $this->cezpdf->output();
		$fp = fopen($file_path . '/shipping_label_order_' . $order_id . '.pdf', 'wb');
		fwrite($fp, $pdfcode);
		fclose($fp);
		if ($over_write == 0) {
			$status = 2;
			$this->load->model('order');
			$date = 0;
			$time = 0;
			$this->order->changeOrderStatus($status, $order_id, $date, $time);
			$url = base_url('index.php/dashboard/order_status/' . $order_details['store_id']);
			redirect($url, 'location');
		} else {
			//$file_path = '../../../../../../invoice/'.$txn_id;
			//if(file_exists($file_path))
			//    echo '<a href="'.$file_path.'/shipping_label_order_'.$order_id.'.pdf"  target="_blank">pdf</a>';
			echo 'Seller Invoice was generated successfully!';
		}
	}

	public function invoice_generator($txn_id, $order_id)
	{
		$base_url = base_url();
		$order_details = $this->invoice_model->seller_invoice($order_id);
		$routing_code = array('destination_code' => '', 'return_code' => '');
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 2) {
			$routing_code = $this->invoice_model->fetch_routing_code_cod($order_details['shipping_pincode']);
		}
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 1) {
			$routing_code = $this->invoice_model->fetch_routing_code_paid($order_details['shipping_pincode']);
		}
		include_once 'invoice_seller.php';
		$this->cezpdf->ezNewPage();
		include 'invoice_buyer.php';
//            $this->cezpdf->ezStream();
		$file_path = './invoice/' . $txn_id;
		$pdfcode = $this->cezpdf->output();
		$fp = fopen($file_path . '/shipping_label_order_' . $order_id . '.pdf', 'wb');
		fwrite($fp, $pdfcode);
		fclose($fp);
	}

	public function regenerate_sl($order_id, $txn_id) // Regenerate Shipping Label with existing Barcode
	{
		$shipping_details = $this->invoice_model->shipping_partner($order_id);
		$shipping_partner = $shipping_details['shipping_partner'];
		if ($shipping_partner != 3) {
			$awb_no = $this->invoice_model->fetch_awbno($order_id);
			$_SESSION['order_id'] = $order_id;
			$_SESSION['txn_id'] = $txn_id;
			$_SESSION['docket_number'] = $awb_no;
			$_SESSION['over_write'] = 1;
			$_SESSION['base_url'] = base_url('index.php/invoice_controller/seller_invoice');
			$url = base_url("barcode/barcode.php");
			redirect($url);
		} else {
			$url = base_url("index.php/invoice_controller/seller_invoice/0/$order_id/$txn_id/1");
			redirect($url);
		}
	}

	public function regenerate_barcode($order_id, $txn_id) // Regenerate Barcode and the overwrite existing Shipping Label
	{
		$shipping_details = $this->invoice_model->shipping_partner($order_id);
		$shipping_partner = (int)$shipping_details['shipping_partner'];
		if ($shipping_partner == 2) {
			if ($shipping_details['payment_status'] != 1)
				$shipping_type = 0;
			else
				$shipping_type = 1;
		} else
			$shipping_type = 1;
		if ($shipping_partner != 3) {
			$docket_number = $this->invoice_model->docket_no($shipping_partner, $shipping_type);
			$this->invoice_model->update_docket($order_id, $shipping_partner, $docket_number, $shipping_type);
			$_SESSION['order_id'] = $order_id;
			$_SESSION['txn_id'] = $txn_id;
			$_SESSION['docket_number'] = $docket_number;
			$_SESSION['over_write'] = 1;
			$_SESSION['base_url'] = base_url('index.php/invoice_controller/seller_invoice');
			$url = base_url("barcode/barcode.php");
			redirect($url);
		} else {
			$url = base_url("index.php/invoice_controller/seller_invoice/0/" . $order_id . '/' . $txn_id . '/1');
			redirect($url);
		}
	}

	public function overwrite_buyer_invoice($order_id)
	{
		$base_url = base_url();
		$order_details = $this->invoice_model->buyer_invoice($order_id);
		$routing_code['destination_code'] = '';
		$routing_code['return_code'] = '';
		$routing_code['retpin'] = '';
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 2) {
			$routing_code = $this->invoice_model->fetch_routing_retcode_cod($order_details['return_pincode']);
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_cod($order_details['shipping_pincode']);
		}
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 1) {
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_paid($order_details['shipping_pincode']);
		}
		$txnid = $order_details['txnid'];
		include_once 'invoice_buyer.php';
		//$this->cezpdf->ezStream();
		$file_path = 'invoice/' . $txnid;
		if (!file_exists($file_path)) {
			echo 'File doesnot Exists<br>';
			mkdir($file_path);
		}
		$pdfcode = $this->cezpdf->output();
		$fp = fopen($file_path . '/buyer_invoice_order_' . $order_details['order_id'] . '.pdf', 'wb');
		if ($fp) {
			fwrite($fp, $pdfcode);
			fclose($fp);
			$file_path = '../../../invoice/' . $txnid;
			echo 'Invoice Saved Successfully!<br>';
			echo '<a href="' . $file_path . '/buyer_invoice_order_' . $order_id . '.pdf"  target="_blank">pdf</a>';
		} else {
			echo 'FFF';
		}
	}

	function routing_code($pin1 = '', $pin2 = '')
	{
		//600119
		if (empty($pin1))
			$pin1 = 122017;
		if (empty($pin2))
			$pin2 = 110013;
		echo 'pin1: ' . $pin1 . '-' . 'pin2: ' . $pin2 . '<br>';
		$routing_code = $this->invoice_model->fetch_routing_retcode_cod($pin2);
		$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_cod($pin1);
		var_dump($routing_code);
		if ($routing_code['retpin'] != '0')
			echo $routing_code['retpin'];
		else
			echo 'FFF';
	}

}?>
