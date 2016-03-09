<?php

class Badges extends CI_Model
{

	function user_badge($uid)
	{
		$this->db->select('badge_type');
		$this->db->select('user_id');
		$this->db->select('badge_level');
		$this->db->select('notification_text');
		$this->db->select('notify_status');
		$this->db->from('badges');
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		return $result->result();
	}

	function visit_store($uid, $sid)
	{
		$this->db->set('user_id', $uid, FALSE);
		$this->db->set('store_id', $sid, FALSE);
		$this->db->insert('visit_store');

		$this->db->where('store_id', $sid);
		$this->db->set('visit_counter', 'visit_counter + 1', FALSE);
		$this->db->update('store_info');

	}

	function visit_product($uid, $sid, $pid)
	{
		$this->db->set('user_id', $uid, FALSE);
		$this->db->set('store_id', $sid, FALSE);
		$this->db->set('product_id', $pid, FALSE);
		$this->db->insert('visit_product');

		$this->db->where('products.store_id', $sid);
		$this->db->where('products.product_id', $pid);
		$this->db->set('products.visit_counter', 'products.visit_counter + 1', FALSE);
		$this->db->update('products');

	}

	function userview($uid, $sid)
	{
		$this->db->select('*');
		$this->db->from('visit_store');
		$this->db->where('store_id', $sid);
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		$op = $result->result();
		if (!empty($op))
			return 1;
		else
			return 0;

	}

	function userviewprod($uid, $sid, $pid)
	{
		$this->db->select('*');
		$this->db->from('visit_product');
		$this->db->where('store_id', $sid);
		$this->db->where('product_id', $pid);
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		$op = $result->result();
		if (!empty($op))
			return 1;
		else
			return 0;

	}

	function myvisitstore($uid)
	{
		$this->db->select('user_id, store_id');
		$this->db->from('visit_store');
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		return $result->result();

	}

	function mypollcount($uid)
	{
		$this->db->select('*');
		$this->db->from('polls_shared');
		$this->db->where('friend_id', $uid);
		$this->db->where('voted_on >', 0);
		$result = $this->db->get();
		return $result->result();

	}

	function mypurchase($uid)
	{
		$this->db->select('order_id');
		$this->db->from('orders');
		$this->db->where('user_id', $uid);
		//$this->db->where('voted_on >',0 );
		$result = $this->db->get();
		return $result->result();

	}

	function badge_alert($user_id, $badge_type)
	{
		$this->db->select('*');
		$this->db->from('badges');
		$this->db->where('user_id', $user_id);
		$this->db->where('badge_type', $badge_type);
		$this->db->where('notify_status', 0);
		$result = $this->db->get();
		$row = $result->result_array();

		if (count($row) > 0) {
			$temp1 = $row[0]['badge_level'];
			$temp2 = $row[0]['notification_text'];

			return array($temp1, $temp2);
		} else return array(0, "");
	}


	function badge_popup_success($user_id, $badge_type)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('badge_type', $badge_type);
		$this->db->set('notify_status', 1);
		$this->db->update('badges');
	}
}

?>
