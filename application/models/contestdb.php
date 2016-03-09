<?php

class Contestdb extends CI_Model
{

	function is_christmas_winner()
	{
		$uid = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('contest_winner');
		$this->db->where('user_id', $uid);
		$this->db->where('occasion', 'christmas');
		$is_exist = $this->db->count_all_results();
		if ($is_exist == 0)
			return 0;
		else
			return 1;

	}

	function christmas_winner()
	{
		$uid = $this->session->userdata('id');
		$this->db->set('user_id', $uid, true);
		$this->db->set('occasion', 'christmas', true);
		$this->db->insert('contest_winner');

	}

	function is_christmas_prod($prodid)
	{
		$this->db->select('product_id');
		$this->db->from('contest_product');
		$this->db->where('product_id', $prodid);
		$is_exist = $this->db->count_all_results();
		if ($is_exist == 0)
			return 0;
		else
			return 1;
	}

	function christmas_prod($date)
	{
		$this->db->select('*');
		$this->db->from('contest_product');
		$this->db->join('products', 'contest_product.product_id = products.product_id');
		$this->db->where('date', $date);
		$result = $this->db->get();
		return $result->result();
	}

	function christmas_fancy($date)
	{
		$this->db->select('contest_fancy_product');
		$this->db->from('contest_fancy');
		$this->db->where('contest_fancy_date', $date);
		$result = $this->db->get();
		return $result->result();
	}

	function christmas_brag($date)
	{
		$this->db->select('contest_brag_product');
		$this->db->from('contest_brag');
		$this->db->where('contest_brag_date', $date);
		$result = $this->db->get();
		return $result->result();
	}

	function christmas_invite($uid, $date)
	{
		$query = "select count(*) as invite from invitedfriends where uid = $uid AND date = $date";
		$result = $this->db->query($query);
//            $this->db->select('count(*)');
//            $this->db->from('invitedfriends');
//            $this->db->where('uid' , $uid);
//            $this->db->where(DATE_FORMAT( date, '%d') , 15);
		return $result->result();
	}

	function invitedFriends()
	{
		$uid = $this->session->userdata('id');
		$this->db->select('fb_uid');
		$this->db->from('invitedfriends');
		$this->db->where('uid', $uid);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			$idarrays = $result->result_array();
			return $idarrays;
		} else
			return 0;
	}

	function updateInvitedFriends($fbuid, $date)
	{
		$uid = $this->session->userdata('id');
		$this->db->set('fb_uid', $fbuid);
		$this->db->set('date', $date);
		$this->db->set('uid', $uid);
		if ($this->db->insert('invitedfriends'))
			return 1;
		else
			return 0;
	}

	function ajaxfancy($contest_fancy, $uid)
	{
		$this->db->select('product_id');
		$this->db->from('fancy_products');
		$this->db->where_in('product_id', $contest_fancy);
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		return $result->result();
	}

	function ajaxbrag($contest_fancy, $uid)
	{
		$this->db->select('product_id');
		$this->db->from('brag_products');
		$this->db->where_in('product_id', $contest_fancy);
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		return $result->result();
	}

}?>
