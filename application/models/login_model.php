<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model
{
	function getMeLogIn($userName, $pass)
	{
		log_message('INFO', 'inside login_model/getMeLogIn');
		//$this->db->select('*');
		$this->db->select('store_owner.store_id');
		$this->db->select('store_owner.storeowner_id');
		//$this->db->select('store_owner.owner_email');
		//$this->db->select('store_owner.password');
		$this->db->from('store_owner');
		$this->db->where('owner_email', $userName);
		$this->db->where('password', $pass);
		$result = $this->db->get();
		log_message('INFO', 'just ran the query____________________________________________________');
		log_message('INFO', $this->db->last_query());
		$retVal = $result->result();
		log_message('INFO', 'DATA RETURNED FROM THE QUERY__________________________________________');
		log_message('INFO', print_r($retVal, TRUE));
		return $retVal;

	}

	function ownerdetails($id)
	{
		//$this->db->select('*');
		$this->db->select('store_owner.store_id');
		$this->db->select('store_owner.storeowner_id');
		//$this->db->select('store_owner.owner_email');
		//$this->db->select('store_owner.password');
		$this->db->select('store_owner.owner_number');
		$this->db->select('store_owner.contact_email');
		$this->db->select('store_owner.owner_city');
		$this->db->select('store_owner.owner_state');
		$this->db->from('store_owner');
		$this->db->where('storeowner_id', $id);
		$result = $this->db->get();
		return $result->result();
	}
	public function login($email,$pwd)
	{
	    $this->db->select('user_id');
		$this->db->from('user_details');
		$this->db->where('email', $email);
		$this->db->where('password', $pwd);
		$result = $this->db->get();
		if($result->num_rows()>0)
		{
			return $result->row()->user_id;
		}
		else
		{
			return false;
		}
	
	}
	public function register($details)
	
	{
	   
	   $this->db->insert('user_details',$details);
	    
	}


}

?>