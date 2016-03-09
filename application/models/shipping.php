<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends CI_Model
{

	function isvalidPin($weight, $pin, $iscod, $issur)
	{
		$this->db->select('*');
		$this->db->from('shiping_partner');
		if ($weight <= 1000000 && $iscod == 1 && $issur == 0) {
			$this->db->where("(part_name = '1' AND type = '1')");
			$this->db->where('pin_to', $pin);
		} else if ($weight <= 1000000 && $iscod == 0 && $issur == 0) {
			$this->db->where("(part_name = '2' AND type = '2')");
			$this->db->where('pin_to', $pin);
		} else if ($weight > 5000 && $iscod == 0 && $issur == 1) {
			$this->db->where("(part_name = '3' AND type = '2')");
			$this->db->where('pin_to', $pin);
		} else if ($weight > 5000 && $iscod == 1 && $issur == 1) {
			$this->db->where("(part_name = '3' AND type = '1')");
			$this->db->where('pin_to', $pin);
		} else {
			$this->db->where('pin_to', -1);
		}
		$result = $this->db->get();
		return $result->result();

	}

	function calc($weight, $issur)
	{
		$this->db->select('*');
		$this->db->from('rate_list_actual_weight');

		$this->db->where('from <=', $weight);
		$this->db->where('to >=', $weight);
		$this->db->where('mode', $issur);
		$result = $this->db->get();
		return $result->result();

	}


}

?>