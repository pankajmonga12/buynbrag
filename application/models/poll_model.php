<?php

class Poll_Model extends CI_Model
{

	//fetch store & owner information
	function fetch_poll_products($userid) //products in recently added items
	{
		$this->db->select('poll_products.product_id,products.store_id');
		$this->db->from('poll_products');
		$this->db->join('products', 'products.product_id=poll_products.product_id');
		$this->db->where('poll_products.user_id', $userid);
		$result = $this->db->get();
		return $result->result();
	}

	function fetch_categories() //fetch the name of categories from categories table for create poll
	{
		$mainid = 0;
		$this->db->select('category_id,category_name');
		$this->db->from('catagories');
		$this->db->where('parent_catagory_id', $mainid);
		$this->db->order_by('category_id', 'ASC');
		$result = $this->db->get();
		return $result->result();
	}

	function save_poll($userid, $data1) //create a poll or insert
	{
		$this->db->set('user_id', $userid);
		$this->db->set('poll_quest', $data1[0]);
		$this->db->set('poll_type', $data1[1]);
		$this->db->set('no_of_items', $data1[2]);
		$this->db->set('product_id_1', $data1[3]);
		$this->db->set('product_id_2', $data1[4]);
		$this->db->set('product_id_3', $data1[5]);
		$this->db->set('poll_category', $data1[6]);
		$this->db->set('poll_close_date', $data1[7]);
		$this->db->insert('polls');
		return $this->db->insert_id();
	}

	function poll_friends($friends_shared, $poll_id) //after insert share it with selected friends
	{
		for ($i = 0; $i < count($friends_shared); $i++) {
			$this->db->set('poll_id', $poll_id);
			$this->db->set('friend_id', intval($friends_shared[$i][1]));
			return $this->db->insert('polls_shared');
		}
	}

	function add_to_poll_list($product_id, $user_id) //Add product to a poll list
	{

		$this->db->set('product_id', $product_id);
		$this->db->set('user_id', $user_id);
		$this->db->insert('poll_products');

	}

	function my_poll_categories($userid) //fetch only those categories which has atleast one poll created by me
	{
		$this->db->select('polls.poll_category,catagories.category_name,count(*) as poll_count');
		$this->db->from('polls');
		$this->db->join('catagories', 'catagories.category_id=polls.poll_category');
		$this->db->where('polls.user_id', $userid);
		$this->db->group_by('polls.poll_category');
		$result = $this->db->get();
		return $result->result();
	}

	function my_poll_products($userid) //fetch all the products added to poll lists by me.
	{
		$this->db->select('products.product_id');
		$this->db->from('products');
		$this->db->where('exists(select * from poll_products where poll_products.product_id=products.product_id and user_id = ' . $userid . ')');
		$result = $this->db->get();
		return $result->result();
	}

	function my_poll_items($userid) //fetch the polls within those categories which has atleast one poll created by me
	{
		$this->db->select('poll_id,poll_category,poll_quest,
	 (select count(*) from polls_shared where polls_shared.poll_id=polls.poll_id and voted_on > 0)as vote_count');
		$this->db->from('polls');
		$this->db->where('user_id', $userid);
		$result = $this->db->get();
		return $result->result();
	}

	function poll_details($pollid) //fetch details of a poll based on its poll id
	{
		$this->db->select('*');
		$this->db->from('polls');
		$this->db->where('poll_id', $pollid);
		$result = $this->db->get();
		return $result->result();
	}

	function latest_poll($user_id) //fetch the details of latest poll created by me
	{
		$this->db->select('*');
		$this->db->from('polls');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('poll_id', 'DESC');
		$result = $this->db->limit(1);
		$result = $this->db->get();
		return $result->result();
	}

	function pending_polls($user_id) //display all pending polls to be voted by me
	{
		$this->db->select('polls.poll_id,poll_quest,polls.user_id,full_name');
		$this->db->from('polls');
		$this->db->join('polls_shared', 'polls.poll_id=polls_shared.poll_id');
		$this->db->join('user_details', 'polls.user_id=user_details.user_id');
		$this->db->where('friend_id', $user_id);
		$this->db->where('voted_on = 0');
		$this->db->where('poll_close_date > current_timestamp');
		$this->db->order_by('poll_close_date', 'DESC');
		$result = $this->db->limit(12);
		$result = $this->db->get();
		return $result->result();
	}


	function poll_products($pr_id) //display product details for a given product id
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id=products.store_id');
		$this->db->where('product_id', $pr_id);
		$result = $this->db->get();
		return $result->result();
	}

	function poll_votes($poll_id, $ptype) //fetch count(votes) for a given product
	{
		$this->db->select('count(*) as votes');
		$this->db->from('polls_shared');
		$this->db->where('poll_id', $poll_id);
		$this->db->where('voted_on', $ptype);
		$result = $this->db->get();
		return $result->result();
	}

	function vote_on($poll_id, $ptype, $friend) //Vote for a given product
	{
		$this->db->set('voted_on', $ptype);
		$this->db->where('poll_id', $poll_id);
		$this->db->where('friend_id', $friend);
		$this->db->update('polls_shared');

	}

	function vote_status($poll_id, $friend) //Check Status of a poll for a person to vote on.
	{
		$this->db->select('*');
		$this->db->from('polls_shared');
		$this->db->join('polls', 'polls.poll_id=polls_shared.poll_id');
		$this->db->where('polls.poll_id', $poll_id);
		$this->db->where('friend_id', $friend);
		$this->db->where('voted_on', 0);
		$this->db->where('poll_close_date > current_timestamp');
		$result = $this->db->get();
		return $result->result();
	}

	function prod_info($prod_id)
	{
		$this->db->select('store_id,product_id,product_name');
		$this->db->from('products');
		$this->db->where('product_id', $prod_id);
		$result = $this->db->get();
		$row = $result->result();
		return array($row[0]->store_id, $row[0]->product_id, $row[0]->product_name);
	}


}

?>
