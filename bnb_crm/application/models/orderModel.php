<?php
class OrderModel extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
	public function orderIDdetails($orderid)
	{
        $this->db->select('orders.invoice_no');
		$this->db->select('orders.txnid');
		$this->db->select('orders.payment_status');
		$this->db->select('orders.date_of_order');
		$this->db->select('orders.quantity');
		$this->db->select('orders.redeemedprice');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('orders.shipping_address');
		$this->db->select('orders.shipping_city');
		$this->db->select('orders.shipping_state');
		$this->db->select('orders.shipping_country');
		$this->db->select('orders.shipping_pincode');
		$this->db->select('orders.shipping_phoneno');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.order_id');
		$this->db->select('products.product_id');
		$this->db->select('products.product_name');
		$this->db->select('products.bnb_product_code');
		$this->db->select('store_info.contact_name');
		$this->db->select('store_info.communication_address');
		$this->db->select('store_info.tin_no');
		$this->db->select('store_info.vat_no');
		$this->db->select('store_info.pan_no');
		$this->db->from('orders');
		$this->db->join('products','orders.product_id = products.product_id');
		$this->db->join('store_info','orders.store_id = store_info.store_id');
		//echo $this->db->return_query();
		$details = $this->db->get();
		if($details->num_rows()>0)
		{
			return $details->result();
		}
		else
		{
			return "something went wrong";
		}
	}
	public function txnIDdetails($txnid)
	{
		$this->db->select('orders.invoice_no');
		$this->db->select('orders.txnid');
		$this->db->select('orders.payment_status');
		$this->db->select('orders.date_of_order');
		$this->db->select('orders.quantity');
		$this->db->select('orders.store_id');
		$this->db->select('orders.redeemedprice');
		$this->db->select('orders.amt_paid');
		$this->db->select('orders.shipping_fname');
		$this->db->select('orders.shipping_lname');
		$this->db->select('orders.shipping_address');
		$this->db->select('orders.shipping_city');
		$this->db->select('orders.shipping_state');
		$this->db->select('orders.shipping_country');
		$this->db->select('orders.shipping_pincode');
		$this->db->select('orders.shipping_phoneno');
		$this->db->select('orders.shipping_emailid');
		$this->db->select('orders.order_id');
		$this->db->select('products.product_id');
		$this->db->select('products.product_name');
		$this->db->select('products.bnb_product_code');
		$this->db->select('store_info.contact_name');
		$this->db->select('store_info.communication_address');
		$this->db->select('store_info.tin_no');
		$this->db->select('store_info.vat_no');
		$this->db->select('store_info.pan_no');
		$this->db->from('orders');
		$this->db->join('products','orders.product_id = products.product_id');
		$this->db->join('store_info','orders.store_id = store_info.store_id');
		$this->db->like('orders.txnid',$txnid,'after'); 
        $this->db->or_like('orders.txnid',$txnid,'both');
        $this->db->or_like('orders.txnid',$txnid,'before');
        //echo $this->db->return_query();
		$details = $this->db->get();
		if($details->num_rows()>0)
		{
			return $details->result_array();
		}
		else
		{
			return "something went wrong";
		}

	}
}