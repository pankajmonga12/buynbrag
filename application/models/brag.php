<?php
class Brag extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//Bragg model functions
	function brag_product($prodid, $userid)
	{
		$this->db->select('product_id');
		$this->db->select('user_id');
		$this->db->from('brag_products');
		$this->db->where('product_id', $prodid);
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case FALSE: $this->db->set('product_id', $prodid);
					  $this->db->set('user_id', $userid);
					  return $this->db->insert('brag_products');
				break;
		}
	}

	//User Bragged Product
	function user_brag_product($uid)
	{
		$this->db->select('product_id');
		$this->db->from('brag_products');
		$this->db->where('user_id', $uid);
		$query = $this->db->get();
		return $query->result();
	}

	//End Vignesh
	function increment_product_brag_count($storeid, $prodid)
	{
		$this->db->set('brag_counter', 'brag_counter+1', FALSE);
		$this->db->where('store_id', $storeid);
		$this->db->where('product_id', $prodid);
		$this->db->update('products');
	}

	function get_product_brag_count($storeid, $prodid)
	{
		$this->db->select('brag_counter');
		$this->db->from('products');
		$this->db->where('store_id', $storeid);
		$this->db->where('product_id', $prodid);
		$query = $this->db->get();
		return $query->result();
	}

	function product_brag_check($user_id, $product_id)
	{
		$this->db->select('product_id,user_id');
		$this->db->from('brag_products');
		$this->db->where('user_id', $user_id);
		$this->db->where('product_id', $product_id);
		$bragged = $this->db->count_all_results();
		if ($bragged == 0)
			return FALSE;
		else
			return TRUE;
	}

	function brag_store($storeid, $userid)
	{
		$this->db->set('store_id', $storeid);
		$this->db->set('user_id', $userid);
		$this->db->insert('brag_store');
	}

	function increment_store_brag_count($storeid)
	{
		$this->db->set('brag_counter', 'brag_counter+1', FALSE);
		$this->db->where('store_id', $storeid);
		$this->db->update('store_info');
	}

	function get_store_brag_count($storeid)
	{
		$this->db->select('brag_counter');
		$this->db->from('store_info');
		$this->db->where('store_id', $storeid);
		$query = $this->db->get();
		return $query->result();
	}

	function store_brag_check($user_id, $store_id)
	{
		$this->db->select('store_id,user_id');
		$this->db->from('brag_store');
		$this->db->where('user_id', $user_id);
		$this->db->where('store_id', $store_id);
		$bragged = $this->db->count_all_results();
		if ($bragged == 0)
			return FALSE;
		else
			return TRUE;
	}
}

?>