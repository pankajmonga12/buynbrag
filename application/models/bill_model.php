<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bill_Model extends CI_Model
{


	function allbills($strname)
	{
		$this->db->select('*');
		$this->db->from('bill');
		$this->db->where('bill.store_id', $strname);
		$this->db->order_by('bill_id', 'DESC');
		$result = $this->db->get();
		return $result->result();

	}

	function myBillAjax($status, $s_id)
	{

		$this->db->select('*');
		$this->db->from('bill');
		$this->db->where('bill.store_id', $s_id);
		if ($status == 0) {
			$this->db->order_by('bill_id', 'DESC');
		} else {
			$this->db->order_by('date_time', 'DESC');
		}
		$result = $this->db->get();
		return $result->result();
	}

	function myBillAjaxLoad($status, $limit, $s_id)
	{

		$this->db->select('*');
		$this->db->from('bill');
		$this->db->where('bill.store_id', $s_id);
		if ($status == 0) {
			$this->db->order_by('bill_id', 'DESC');
			$this->db->where('bill_id <', $limit);
		} else {
			$this->db->order_by('date_time', 'DESC');
			$this->db->where('bill_id <', $limit);
		}


		$this->db->limit(5);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}


}

?>