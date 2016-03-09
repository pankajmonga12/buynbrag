<?php
class Invoice_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function save_invoice($txnid)
	{
		$this->db->select('orders.*');
		$this->db->select("DATE_FORMAT(orders.date_of_order , '%b %e, %Y') AS date_of_order", FALSE);
		$this->db->select('products.tax_rate,product_name,products.bnb_product_code');
		$this->db->select('store_info.*');
		$this->db->select('orders.invoice_no');
		$this->db->from('orders');
		$this->db->join('(products,store_info)', 'orders.product_id = products.product_id AND orders.store_id = store_info.store_id');
		$this->db->where('orders.txnid', $txnid);
		$result = $this->db->get();
		return $result->result_array();
	}

	function buyer_invoice($order_id)
	{
		$this->db->select('orders.*');
		$this->db->select("DATE_FORMAT(orders.date_of_order , '%b %e, %Y') AS date_of_order", FALSE);
		$this->db->select('products.product_name,products.bnb_product_code');
		$this->db->select('store_info.*');
		$this->db->select('orders.invoice_no');
		//$this->db->select('user_details.full_name,user_details.address,user_details.city,user_details.country,user_details.state,user_details.pin,user_details.mob');
		$this->db->from('orders');
//        $this->db->join('(products,store_info,user_details)','orders.product_id = products.product_id AND orders.store_id = store_info.store_id AND user_details.user_id = orders.user_id');
		$this->db->join('(products,store_info)', 'orders.product_id = products.product_id AND orders.store_id = store_info.store_id');
		$this->db->where('orders.order_id', $order_id);
		$result = $this->db->get();
		return $result->row_array();
	}

	function seller_invoice($order_id)
	{
		$this->db->select('orders.*');
		$this->db->select("DATE_FORMAT(orders.date_of_order , '%e/%c/%Y') AS date_of_order", FALSE);
		$this->db->select('products.tax_rate,products.product_name,products.bnb_product_code,products.prd_act_weight,products.prd_vol_weight');
		$this->db->select('store_info.*');
		$this->db->select('orders.invoice_no');
		$this->db->from('orders');
		$this->db->join('(products,store_info)', 'orders.product_id = products.product_id AND orders.store_id = store_info.store_id');
		$this->db->where('orders.order_id', $order_id);
		$result = $this->db->get();
		return $result->row_array();
	}

	function docket_no($shipping_partner, $shipping_type)
	{
		$this->db->select('current_num');
		$this->db->from('docket_series');
		$this->db->where('lock', 0);
		$this->db->where('shipping_partner', $shipping_partner);
		$this->db->where('shipping_type', $shipping_type);
		$result = $this->db->get();
		$result = $result->row_array();
//        $this->db->set('current_num',$result['current_num']+11);
//        $this->db->where('current_num',$result['current_num']);
//        $this->db->update('docket_series');
		$docket_num = $result['current_num'];
		return $docket_num;
	}

	function shipping_partner($order_id)
	{
		$this->db->select('shipping_partner,payment_status');
		$this->db->from('orders');
		$this->db->where('order_id', $order_id);
		$result = $this->db->get();
		$result = $result->row_array();
		return $result;
	}

	function update_docket($order_id, $shipping_partner, $docket_number, $shipping_type)
	{
		$this->db->set('awb_no', $docket_number);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders');
		$this->db->query("UPDATE docket_series SET current_num = current_num + 11 WHERE shipping_partner = $shipping_partner AND shipping_type = $shipping_type");
//        $docket_array = str_split($docket_number);
//        $count = count($docket_array);
//        $last_digit = (int)$docket_array[$count-1];

//        if($last_digit == 6 && $shipping_partner == 2)
//            $this->db->query("UPDATE docket_series SET current_num = current_num + 4 WHERE shipping_partner = $shipping_partner AND shipping_type = $shipping_type");
//        else

	}

	function fetch_routing_code_cod($pin_code)
	{
		$this->db->select('destination_code');
		$this->db->from('bd_cod_routing_code');
		$this->db->where('pin', $pin_code);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row['destination_code'];
	}

	function fetch_routing_retcode_cod($pin_code)
	{
		$this->db->select('return_code,retpin');
		$this->db->from('bd_cod_routing_code');
		$this->db->where('pin', $pin_code);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row;
	}

	function fetch_routing_code_paid($pin_code)
	{
		$this->db->select('destination_code');
		$this->db->from('bd_prepaid_routing_code');
		$this->db->where('pin', $pin_code);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row['destination_code'];
	}

	function fetch_awbno($order_id)
	{
		$this->db->select('awb_no');
		$this->db->from('orders');
		$this->db->where('order_id', $order_id);
		$result = $this->db->get();
		$row = $result->row_array();
		return $row['awb_no'];
	}

}
?>
