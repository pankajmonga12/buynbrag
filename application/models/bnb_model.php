<?php
class bnb_model extends CI_Model
{

	function bnb_model()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getuser_details()
	{
		//Query the data table for every record and row
		$query = $this->db->get('user_details');

		if ($query->num_rows() <= 0) {
			show_error('Database is empty!');
		} else {
			return $query->result();
		}
	}

	function getorder_details()
	{
		$this->db->select('store_info.store_url');
		$this->db->from('orders');
		$this->db->join('store_info', 'orders.store_id = store_info.store_id');
		$result = $this->db->get();
		return $result->result();

		/*Query the data table for every record and row
		$query = $this->db->get('orders');

		if ($query->num_rows() <= 0)
		{
			show_error('Database is empty!');
		}else{
			return $query->result();
		}*/
	}
}
?>
