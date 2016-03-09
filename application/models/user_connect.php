<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');
class User_connect extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	// function to connect the current user to the current twitter Account
	public function twitterConnect($userID, $twitterID)
	{
		$this->db->select('tw_uid');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$checkQuery = $this->db->get();
		switch($checkQuery->num_rows() > 0)
		{
			case TRUE:$checkData = $checkQuery->result();
					return array("isAlreadyLinked" => TRUE, "tw_uid" => $checkData[0]->tw_uid);
				break;
			case FALSE: $this->db->set('tw_uid', $twitterID);
					$this->db->where('user_id', $userID);
					$linkResult = $this->db->update('user_details');
					return array("isAlreadyLinked" => FALSE, "linkResult" => $linkResult);
				break;
		}
	}
}
?>

