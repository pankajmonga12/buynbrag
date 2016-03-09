<?php
class Vc_models extends CI_Model
{

	function Vc_models()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getorder_details()
	{
		$this->db->select('store_info.store_url');
		$this->db->from('orders');
		$this->db->join('store_info', 'orders.store_id = store_info.store_id');
		$result = $this->db->get();
		return $result->result();
	}
}

?>