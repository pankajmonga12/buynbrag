<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Design extends CI_Model
{

	function bannerDesign($store_id)
	{
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->where('store_info.store_id', $store_id);
		$result = $this->db->get();

		return $result->result();
	}

	function myStoreBanner($store_id)
	{
		$this->load->database();

		$dbaction = $this->input->post('dbaction');
		if ($dbaction == "insertRecord") {
			$mydata = array(
				'store_url' => $this->input->post('subdomain'),
				'store_name' => $this->input->post('storeName'),
			);


			$this->db->insert('store_info', $mydata);

			$mystore_id = $this->db->insert_id();
			$mydata1["store_id"] = $mystore_id;
			$this->db->insert('store_owner', $mydata1);

			return $mystore_id;
		} else {
			$mydata = array(
				'store_name' => $this->input->post('storeName'),
			);
			$this->db->update('store_info', $mydata, "store_id ='" . $store_id . "'");
		}
	}

	function checkExistingStore($store_url)
	{
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->where('store_info.store_url', $store_url);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>