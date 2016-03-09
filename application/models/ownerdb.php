<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ownerdb
 *
 * @author User
 */
class Ownerdb extends CI_Model
{

	function ownerdata($id)
	{
		$this->db->select('*');
		$this->db->from('store_owner');
		$this->db->where('storeowner_id', $id);
		$result = $this->db->get();
		return $result->result();
	}

}
?>
