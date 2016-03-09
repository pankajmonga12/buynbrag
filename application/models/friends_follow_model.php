<?php
class Friends_follow_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function f_status($self_uid, $visit_uid) //involves union
	{
		$query = $this->db->query('select * from follow_friends where follower_id =
	' . $self_uid . ' and followee_id = ' . $visit_uid . ' union
	select * from follow_friends where follower_id = ' . $visit_uid . ' and followee_id = '
			. $self_uid);
		$f_status = $query->row_array();
		if (!$f_status) return array("Not a friend or follower.", "Follow");
		elseif ($f_status['f_type'] == 0) {
			if ($f_status['follower_id'] == $self_uid)
				return array("You are following this guy", "Unfollow");
			else return array("He is following you", "Add Friend");
		} else return array("You both are connected as friends", "Unfriend");
	}


	public function f_follow($self_uid, $visit_uid)
	{
		$f_row = array('follower_id' => $self_uid, 'followee_id' => $visit_uid);
		$this->db->insert('follow_friends', $f_row);
		return "You successfully started following " . $visit_uid;
	}


	public function f_add($self_uid, $visit_uid)
	{
		$f_row = array('f_type' => 1);
		$this->db->where('followee_id = ' . $self_uid);
		$this->db->where('follower_id = ' . $visit_uid);
		$this->db->update('follow_friends', $f_row);
		return "You added " . $visit_uid . " successfully";
	}


	public function f_unfollow($self_uid, $visit_uid)
	{
		$this->db->where('follower_id = ' . $self_uid);
		$this->db->where('followee_id = ' . $visit_uid);
		$this->db->delete('follow_friends');
		return "You no more follow " . $visit_uid;
	}


	public function f_delete($self_uid, $visit_uid)
	{
		//for unfriending/unfollowing if self had started following visitor first before becoming friends.
		$this->db->where('follower_id = ' . $self_uid);
		$this->db->where('followee_id = ' . $visit_uid);
		$this->db->where('f_type = 1');
		$this->db->delete('follow_friends');

		//for only unfriending, since visitor started following self first before becoming friends. Visitor will still continue following self.
//		$f_row = array('f_type' => 0);
//		$this->db->where('follower_id = '.$self_uid);
//		$this->db->where('followee_id = '.$visit_uid);
//		$this->db->where('f_type = 1');
//		$this->db->update('follow_friends', $f_row);
		return "You are no more friends with " . $visit_uid;
	}

/* CHANGES BY SHAMMI SHAILAJ */
/* Started using specific column names instead of * in field column selection in the following three functions to improve performance
*/
	public function get_followers($u_id)
	{
		$this->db->select('user_details.fb_uid');
		$this->db->select('user_details.user_id');
		$this->db->select('user_details.gender');
		$this->db->from('user_details');
		$this->db->where('exists(select follower_id from follow_friends where follower_id = user_details.user_id and f_type = 0 and followee_id = ' . $u_id . ')');
		$this->db->order_by('user_id', "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_followees($u_id)
	{
		$this->db->select('user_details.fb_uid');
		$this->db->select('user_details.user_id');
		$this->db->select('user_details.gender');
		$this->db->from('user_details');
		$this->db->where('exists(select followee_id from follow_friends where followee_id = user_details.user_id and f_type = 0 and follower_id = ' . $u_id . ')');
		$this->db->order_by('user_id', "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_friends($u_id) //involves union
	{
		$query = $this->db->query('select user_details.fb_uid, user_details.user_id, user_details.gender from user_details where exists(select followee_id from follow_friends where followee_id = user_details.user_id and f_type = 1 and follower_id = ' . $u_id . ') union select user_details.fb_uid, user_details.user_id, user_details.gender from user_details where exists(select follower_id from follow_friends where follower_id = user_details.user_id and f_type = 1 and followee_id = ' . $u_id . ')');
		return $query->result_array();
	}
/* END SECTION CHANGES BY SHAMMI SHAILAJ */

	public function get_all_users()
	{
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->order_by('full_name', "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function follow_mail_details($f1, $f2)
	{
		$this->db->select('*');
		$this->db->from('email_follow');
		$this->db->join('user_details', 'follower_id = user_details.user_id or followee_id = user_details.user_id');
		$this->db->where('follower_id', $f1);
		$this->db->where('followee_id', $f2);
		$this->db->where('sent_status', 0);
		$this->db->order_by('user_id', 'asc');
		$result = $this->db->get();
		$row = $result->result_array();
		if (count($row) > 0)
			return $row;
		else return 0;

	}

	public function follow_mail_success($f1, $f2)
	{
		$this->db->where('follower_id', $f1);
		$this->db->where('followee_id', $f2);
		$this->db->set('sent_status', 1);
		$this->db->update('email_follow');
	}
	

}

?>