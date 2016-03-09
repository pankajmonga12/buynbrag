<?php
class Info_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function seller_info($order_id)
	{
		$this->db->select('*');
        $this->db->from('store_info');
        $this->db->join('orders', "orders.store_id=store_info.store_id");
        $this->db->where('order_id',$order_id);
        $seller_details = $this->db->get();
        return $seller_details->result_array();
	}
	
	public function product_info($order_id)
	{
		$this->db->select('*');
        $this->db->from('products');
        $this->db->join('orders', "orders.product_id=products.product_id");
        $this->db->where('order_id',$order_id);
        $buyer_details = $this->db->get();
        return $buyer_details->result_array();
	}
	
	public function payment_info($order_id)
	{
		$this->db->select('*');
        $this->db->from('orders');
        //$this->db->join('orders', "orders.product_id=products.product_id");
        $this->db->where('order_id',$order_id);
        $payment_details = $this->db->get();
        return $payment_details->result_array();
	}
}
?>
