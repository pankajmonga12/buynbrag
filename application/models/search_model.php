<?php
class Search_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function searchProduct($keyWord, $startFrom = NULL, $maxResults = NULL)
	{
		$this->db->select('products.product_id');
		$this->db->select('products.store_id');
		$this->db->select('products.product_name');
		$this->db->select('store_info.store_name');
		$this->db->select('products.fancy_counter');
		$this->db->select('products.visit_counter');
		$this->db->select('products.brag_counter');
		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where("products.product_name LIKE '".$keyWord."%'");
		$this->db->order_by("products.fancy_counter + products.visit_counter + products.brag_counter + store_info.fancy_counter + store_info.visit_counter + store_info.brag_counter", "desc");
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(12);
				break;
			case FALSE:switch(is_null($maxResults))
					{
						case TRUE: $this->db->limit(12, 12*$startFrom);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					}
				break;
		}
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}
	
	public function searchSuggestions($keyWord, $startFrom = NULL, $maxResults = NULL)
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', $__ip." search_model/searchSuggestions fired");
		$this->db->select('products.product_name');
		$this->db->select('store_info.store_name');
		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where("products.product_name LIKE '".$keyWord."%' OR products.product_name LIKE '%".$keyWord."%'");
		$this->db->order_by("products.fancy_counter + products.visit_counter + products.brag_counter + store_info.fancy_counter + store_info.visit_counter + store_info.brag_counter", "desc");
		switch(is_null($startFrom))
		{
			case TRUE: $this->db->limit(12);
				break;
			case FALSE:switch(is_null($maxResults))
					{
						case TRUE: $this->db->limit(12, 12*$startFrom);
							break;
						case FALSE: $this->db->limit($maxResults, $maxResults*$startFrom);
							break;
					}
				break;
		}
		$query = $this->db->get();
		log_message('INFO', $__ip." search_model/searchSuggestions JUST RAN THE FOLLOWING QUERY____\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}
}
/*
** OLD CODE **
class search_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('date');
	}

	public function get_rank($user_id)
	{
	  
	    $this->db->select('rank');
		$this->db->from('fancy_rank');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get();
		switch($result->num_rows() > 0)
		{
			case TRUE: return $result->result();
				break;
			case FALSE: return FALSE;
			    break;
		}
	}
	public function count_followers($user_id)
	{
	   $res=$this->db->query("select * from user_details where exists(select followee_id from follow_friends where followee_id = user_details.user_id and f_type = 0 and follower_id = '$user_id')");
	   return $res->num_rows();
	}
	function cfprod($userid)
	{
		$this->db->select('product_id');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $userid);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_friends($user_id)
	{
	   $frnds=$this->db->query("select * from user_details where exists(select followee_id from follow_friends where followee_id = user_details.user_id and f_type = 1 and follower_id = '$user_id') union select * from user_details where exists(select follower_id from follow_friends where follower_id = user_details.user_id and f_type = 1 and followee_id = '$user_id')");
	   return $frnds->num_rows();
	}
    public function prod_id($user_id)
	{
	  
	    $this->db->select('product_id');
		$this->db->from('fancy_products');
		$this->db->where('user_id', $user_id);
		$this->db->limit(4);
	    $result = $this->db->get();
		return $result->result();
	  
		
	}
	public function store_id($product_id)
	{
	  
	    $this->db->select('store_id');
		$this->db->from('products');
		$this->db->where('product_id', $product_id);
		$result = $this->db->get();
		return $result->row();
	  
		
	}
	public function store_name($store_id1)
	{
	  
	    $this->db->select('store_name');
		$this->db->from('store_info');
		$this->db->where('store_id', $store_id1);
		$result = $this->db->get();
		return $result->row();
	  
		
	}
	
	public function get_followees($user_id)
	{
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('exists(select followee_id from follow_friends where followee_id = user_details.user_id and f_type = 0 and follower_id = ' . $user_id . ')');
		$this->db->order_by('user_id', "asc");
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	
	

}*/
?>