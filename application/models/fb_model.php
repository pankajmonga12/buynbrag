<?php
class Fb_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

	public function uid($fb_uid)
	{
		$this->db->select('user_id');
		$this->db->select('full_name');
		$this->db->from('user_details');
		$this->db->where('fb_uid', $fb_uid);
		$result = $this->db->get();
		return $result->result();
	}

	public function insert_user($data)
	{
		$fb_uid = $data['fb_uid'];
		$fb_usr['email'] = $data['fb_usr']['email'];
		$user_exists = $this->user_exists($fb_uid, $fb_usr['email']); //Check email also
		$first_login = array('user_exists' => $user_exists); //Either [1 or 2]-Existing user or 0-New user
		if ($user_exists == 0) //New user insert.
		{
			if (isset($data['fb_usr']['birthday'])) {
				$fb_usr['birthday'] = $data['fb_usr']['birthday'];
				$time = strtotime($fb_usr['birthday']);
				$mydate = date('Y-m-d', $time);
				$this->db->set('date_of_birth', $mydate);
			} else
				$this->db->set('date_of_birth', "");

			if (isset($data['fb_usr']['bio'])) {
				$fb_usr['bio'] = $data['fb_usr']['bio'];
				$this->db->set('about_me', $fb_usr['bio']);
			} else
				$this->db->set('about_me', "");

			$fb_usr['username'] = $data['fb_usr']['username'];
			$fb_usr['name'] = $data['fb_usr']['name'];
			$fb_usr['last_name'] = $data['fb_usr']['last_name'];
			$fb_usr['gender'] = $data['fb_usr']['gender'];
			$joined_date = date('Y-m-d');
			$profile_pic = "";
			$this->db->set('fb_uid', $fb_uid);
			$this->db->set('username', $fb_usr['username']);
			$this->db->set('password', '');
			$this->db->set('email', $fb_usr['email']);
			$this->db->set('full_name', $fb_usr['name']);
			$this->db->set('nick_name', $fb_usr['last_name']);
			$this->db->set('gender', $fb_usr['gender']);
			$this->db->set('profile_pic', $profile_pic);
			$this->db->set('joined_date', $joined_date);
			$this->db->insert('user_details');

			$result = $this->uid($fb_uid);
			$return = array_merge($result, $first_login);
			return $return;
		} else {
			if ($user_exists == 2) //For Update
			{
				if (isset($data['fb_usr']['birthday'])) {
					$fb_usr['birthday'] = $data['fb_usr']['birthday'];
					$time = strtotime($fb_usr['birthday']);
					$mydate = date('Y-m-d', $time);
					$this->db->set('date_of_birth', $mydate);
				} else
					$this->db->set('date_of_birth', "");

				if (isset($data['fb_usr']['bio'])) {
					$fb_usr['bio'] = $data['fb_usr']['bio'];
					$this->db->set('about_me', $fb_usr['bio']);
				} else
					$this->db->set('about_me', "");

				$fb_usr['username'] = $data['fb_usr']['username'];
				$fb_usr['gender'] = $data['fb_usr']['gender'];
				$this->db->set('fb_uid', $fb_uid);
				$this->db->set('username', $fb_usr['username']);
				//$this->db->set('full_name',$fb_usr['name']);
				//$this->db->set('nick_name',$fb_usr['last_name']);
				$this->db->set('gender', $fb_usr['gender']);
				$this->db->where('email', $fb_usr['email']);
				$updateUser = $this->db->update('user_details');
				if ($updateUser) {
					$result = $this->uid($fb_uid);
					$return = array_merge($result, $first_login);
					return $return;
				} else {
					log_message('Info', 'Some shit happened while updating existing user with same email as fb primary email!');
					redirect(base_url('index.php/welcome/login'));
				}
			} elseif ($user_exists == 1) {
				$result = $this->uid($fb_uid);
				$return = array_merge($result, $first_login);
				return $return;
			} else {
				log_message('Info', 'Unhandled case while signup!');
			}
		}
	}
	/* NEW ADD USER FUNCTION BY SHAMMI SHAILAJ */
	public function newFBAccount($data)
	{
		log_message('INFO', 'Data from fb is: '.print_r($data, TRUE));
		if (isset($data['birthday']))
		{
			$time = strtotime($data['birthday']);
			$mydate = date('Y-m-d', $time);
			$this->db->set('date_of_birth', $mydate);
		}
		else
		{
			$this->db->set('date_of_birth', "");
		}
		
		$bnbAboutMe = NULL;
		if (isset($data['bio']))
		{
			$bnbAboutMe = $data['bio'];
		}
		else
		{
			$bnbAboutMe = "";
		}
		
		if(isset($data["quotes"]))
		{
			$bnbAboutMe .= "\r\n";
		}
		else
		{
			$bnbAboutMe .= "";
		}
		
		$this->db->set('about_me', $bnbAboutMe);
		$joined_date = date('Y-m-d');
		$profile_pic = "";
		$this->db->set('fb_uid', $data["id"]);
		$this->db->set('username', $data['username']);
		$this->db->set('password', '');
		$this->db->set('email', $data['email']);
		$this->db->set('fbEmail', $data['email']);
		$this->db->set('full_name', $data['name']);
		$this->db->set('nick_name', $data['last_name']);
		$this->db->set('gender', $data['gender']);
		$this->db->set('profile_pic', $profile_pic);
		$this->db->set('joined_date', $joined_date);
		$this->db->set('rFlowStatus', 1);
		log_message('INFO', "Going to run the following query:\r\n".$this->db->return_query());
		$result = $this->db->insert('user_details');
		
		log_message('INFO', "Just ran the following query with result".json_encode($result).": \r\n".$this->db->last_query());

		$uid = $this->uid($data["id"]);
		$uid = $uid[0];
		log_message('INFO', "fb_model/newFBAccount ::: RETURNING ".print_r(array("result" => $result, "newUID" => $uid->user_id, "userFullName" => $uid->full_name), TRUE));
		return array("result" => $result, "newUID" => $uid->user_id, "userFullName" => $uid->full_name);
	}
	/* END SECTION NEW ADD USER FUNCTION BY SHAMMI SHAILAJ */

	public function fbFriendsToBNBUsers($fbFriendsFBIDs)
	{
		$this->db->select('user_id AS userID');
		$this->db->from('user_details');

		$whereText = NULL;

		if(is_array($fbFriendsFBIDs))
		{
			$friendsCount = count($fbFriendsFBIDs);
			if($friendsCount == 1)
			{
				$whereText = "fb_uid = '".$fbFriendsFBIDs[0]."'";
				$this->db->where($whereText);
			}
			elseif($friendsCount > 1)
			{
				$fbUIDs = implode("','", $fbFriendsFBIDs);
				$whereText = "fb_uid IN ('".$fbUIDs."') ORDER BY FIELD (fb_uid,'".$fbUIDs."')";
				$this->db->where($whereText, NULL, FALSE);
			}
		}

		log_message('INFO', "FB FRIENDS QUERY COMPILED IS: \r\n".print_r($this->db->return_query(), TRUE));

		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE:	$results = $query->result();
						return $results;
				break;
			case FALSE:	return NULL;
				break;
		}
	}
	
	/* EXISTING USER LINK FB ACCOUNT FUNCTION BY SHAMMI SHAILAJ */
	// start new function here
	public function linkFBAccount($data)
	{
		if (isset($data['birthday']))
		{
			$time = strtotime($data['birthday']);
			$mydate = date('Y-m-d', $time);
			$this->db->set('date_of_birth', $mydate);
		}
		else
		{
			$this->db->set('date_of_birth', "");
		}
		
		$bnbAboutMe = NULL;
		if (isset($data['bio']))
		{
			$bnbAboutMe = $data['bio'];
		}
		else
		{
			$bnbAboutMe = "";
		}
		
		if(isset($data["quotes"]))
		{
			$bnbAboutMe .= "\r\n";
		}
		else
		{
			$bnbAboutMe .= "";
		}
		
		$this->db->set('fb_uid', $data["id"]);
		$this->db->set('username', $data['username']);
		// still to decide whether to change the about me or not
		//$this->db->set('about_me', $bnbAboutMe);
		// no need to set gender as we do not need the user must have submitted it while registering
		// $this->db->set('gender', $fb_usr['gender']);
		$this->db->where('email', $data['email']);
		return $this->db->update('user_details');
	}
	/* END SECTION NEW ADD USER FUNCTION BY SHAMMI SHAILAJ */
	/* FUNCTION TO GET UID FROM EMAIL BY SHAMMI SHAILAJ */
	public function uidFromEmail($email)
	{
		$this->db->select('user_id AS uid');
		$this->db->from('user_details');
		$this->db->where('email', $email);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return FALSE;
				break;
		}
	}
	/* END SECTION FUNCTION TO GET UID FROM EMAIL BY SHAMMI SHAILAJ */
	
	public function user_exists($fb_uid, $email)
	{
		$this->db->select('fb_uid,email');
		$this->db->from('user_details');
		$this->db->where('fb_uid', $fb_uid);
		$this->db->or_where('email', $email);
		$result = $this->db->get();
		if ($result->num_rows != 0)
		{
			$result = $result->result();
			if ($result[0]->fb_uid == 'non-fb-member')
			{
				return 2; //Non-Fb-Exixting member with same primary email-id of Fb.
			}
			else
			{
				return 1; //Fb-Exixting member
			}
		}
		else
		{
			return 0; //New user
		}
	}

	public function fetch_user($uid)
	{
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('user_id', $uid);
		$result = $this->db->get();
		return $result->result();
	}

	public function deffancy($uid)
	{
		$fancyf = array(
			array(
				'fancy_list_id' => '1',
				'user_id' => $uid,
				'fancy_list_name' => 'Home Decor'
			),
			array(
				'fancy_list_id' => '2',
				'user_id' => $uid,
				'fancy_list_name' => 'Fashion'
			),
			array(
				'fancy_list_id' => '3',
				'user_id' => $uid,
				'fancy_list_name' => 'Art'
			),
			array(
				'fancy_list_id' => '4',
				'user_id' => $uid,
				'fancy_list_name' => 'Gizmos'
			),
			array(
				'fancy_list_id' => '5',
				'user_id' => $uid,
				'fancy_list_name' => 'Personal Care'
			)
		);

		$this->db->insert_batch('fancy_list', $fancyf);
	}


	public function insert_friends($user_id, $friend_id)
	{
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('fb_uid', $friend_id);
		$result = $this->db->get();
		$row = $result->result_array();
		if (count($row) > 0) {
			$f_row = array('follower_id' => $user_id, 'followee_id' => $row[0]['user_id'], 'f_type' => 1);
			$this->db->insert('follow_friends', $f_row);
			return $row[0]['user_id'];
		} else return 0;
	}

	public function fbuid()
	{
		$this->db->select('fb_uid');
		$this->db->from('user_details');
		$this->db->where('user_id', $this->session->userdata('id'));
		$result = $this->db->get();
		$fb_uid = $result->result_array();
		return $fb_uid;
	}

	public function welcome_mail_details($user_id)
	{
		$this->db->select('full_name,sent_email_id');
		$this->db->from('email_welcome');
		$this->db->join('user_details', 'email_welcome.user_id = user_details.user_id');
		$this->db->where('email_welcome.user_id', $user_id);
		$this->db->where('sent_status', 0);
		$result = $this->db->get();
		$row = $result->result_array();
		if (count($row) > 0)
			return $row;
		else
			return 0;
	}

	public function welcome_mail_success($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->set('sent_status', 1);
		$this->db->update('email_welcome');
	}

	public function userDOJ($mode = 0, $userDetail) // when mode = 0, userDetail = userID, mode = 1 userDetail = email address, mode = 2 userDetail = fb_uid
	{
		$retVal = NULL;
		$this->db->select('joined_date');
		$this->db->from('user_details');
		switch($mode)
		{
			case 0:	$this->db->where('user_id', $userDetail);
				break;
			case 1:	$this->db->where('email', $userDetail);
				break;
			case 2:	$this->db->where('fb_uid', $userDetail);
				break;
		}
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE:	$retVal = $query->result();
						$retVal = $retVal[0]->joined_date;
				break;
		}
		return $retVal;
	}

	public function userEmailFromFBID($userFBID)
	{
		$retVal = NULL;
		$this->db->select('email');
		$this->db->from('user_details');
		$this->db->where('fb_uid', $userFBID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE:	$retVal = $query->result();
						$retVal = $retVal[0]->email;
				break;
		}
		return $retVal;
	}
}

?>