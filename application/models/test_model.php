<?php
class Test_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function session()
	{
		$session_id = $this->session->userdata('session_id');
		$this->db->select('session_id,user_data,last_activity');
		$this->db->from('buynbrag_sessions');
		$this->db->where('session_id', $session_id);
		$result = $this->db->get();
		return $result->result_array();
	}
}

?>