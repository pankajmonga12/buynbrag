<?php
class Signup extends CI_Model
{

	function Signup()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function create_activation_link($act_key, $user_id, $email, $password, $a_type)
	{
		$this->db->query('delete from activation_key where type = ' . $a_type . ' and user_id = ' . $user_id);
		$this->db->set('email', $email);
		$this->db->set('user_id', $user_id);
		$this->db->set('act_key', $act_key);
		$this->db->set('password', md5($password));
		$this->db->set('type', $a_type);
		$this->db->insert('activation_key');
		return $this->db->insert_id();
	}

	function modify_fb_bnb($act_id, $act_key)
	{
		$this->db->select('act_id,user_id,password');
		$this->db->from('activation_key');
		$this->db->where('act_id', $act_id);
		$this->db->where('md5(act_key)', $act_key);
		$this->db->where('type', 1);
		$result = $this->db->get();
		if (count($result->result()) == 0)
			return 0;
		else {
			$row = $result->result();
			$this->db->query("update user_details set password = '" . $row[0]->password . "' where user_id = " . $row[0]->user_id);
			$this->db->query("delete from activation_key where act_id = " . $row[0]->act_id);
			return $row[0]->user_id;
		}
	}

	function pw_reset_status($act_id, $act_key)
	{
		$this->db->select('act_id,user_id,password');
		$this->db->from('activation_key');
		$this->db->where('act_id', $act_id);
		$this->db->where('act_key', $act_key);
		$this->db->where('type', 2);
		$result = $this->db->get();

		if (count($result->result()) == 0)
			return 0;
		else
			return 1;

	}

	function pw_reset($act_id, $act_key, $pw)
	{
		$sql = "update user_details set password = md5(?) where user_id = (select user_id from activation_key where act_id = ?)";
		$binds = array($pw, $act_id);
		$query = $this->db->query($sql, $binds);

		if ($query) {
			$this->db->select('user_id');
			$this->db->from('activation_key');
			$this->db->where('act_id', $act_id);
			$result = $this->db->get();
			$row = $result->result();
			$user_id = $row[0]->user_id;
			$this->db->query("delete from activation_key where act_id = " . $act_id);
			return $user_id;
		} else
			return 0;

	}

	function act_mail($act_id, $act_key)
	{
		$this->db->select('email');
		$this->db->from('activation_key');
		$this->db->where('act_id', $act_id);
		$this->db->where('act_key', $act_key);
		$this->db->where('type', 1);
		$result = $this->db->get();
		if (count($result->result()) == 0)
			return '0';
		else {
			$row = $result->result();
			return $row[0]->email;
		}
	}

	function create_user($user_details)
	{
		$this->db->set('date_of_birth', "");
		$this->db->set('about_me', "");
		$this->db->set('fb_uid', 'non-fb-member');
		$this->db->set('username', '');
		$this->db->set('password', md5($user_details['pw1']));
		$this->db->set('email', $user_details['email']);
		$this->db->set('full_name', $user_details['fname'] . ' ' . $user_details['lname']);
		$this->db->set('nick_name', $user_details['lname']);
		$this->db->set('gender', $user_details['gender']);
		$this->db->set('profile_pic', '');
		$this->db->set('joined_date', date('Y-m-d'));
		$this->db->insert('user_details');
		return $this->db->insert_id();
	}

	function user_id($email)
	{
		$this->db->select('user_id');
		$this->db->from('user_details');
		$this->db->where('email', $email);
		$result = $this->db->get();

		if (count($result->result()) == 0)
			return 0;
		else {
			$row = $result->result();
			return $row[0]->user_id;
		}
	}

	function sign_in($email, $pw)
	{
		$this->db->select('user_id,email,password');
		$this->db->from('user_details');
		$this->db->where('email', $email);
		$result = $this->db->get();

		if (count($result->result()) == 0)
		{
			return 0;
		}
		else
		{
			$row = $result->result();
			$password = $row[0]->password;
			if ($password == md5($pw))
			{
				return $row[0]->user_id;
			}
			else
			{
				return -1;
			}
		}
	}
}

?>