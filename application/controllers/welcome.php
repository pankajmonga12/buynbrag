<?php
class Welcome extends CI_Controller
{
	private $cap_expiry = 300;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->model('signup');
		date_default_timezone_set('Asia/Kolkata');
		$data['base_url'] = base_url();
		$this->load->view('static_header', $data);

	}

	public function login()
	{
		$data['action'] = 'login';
		$data['msg'] = '';
		$data['email'] = '';
		//Login button pressed
		if (isset($_POST['btn_signin'])) {
			$temp1 = mysql_real_escape_string($_POST['signin_email']);
			$temp2 = mysql_real_escape_string($_POST['signin_pw']);
			$status = (int)$this->signup->sign_in($temp1, $temp2);
			if ($status == 0)
				$data['msg'] = "Invalid E-Mail ID";
			elseif ($status == -1)
				$data['msg'] = "You entered incorrect password!"; else {
				$sess = array('id' => $status, 'logged_in' => TRUE);
				$this->session->set_userdata($sess);
				redirect(base_url('user_info/homepage_afterlogin'));
			}
		} else
			$data['msg'] = 'Please enter your Email ID & Password to continue!';

		$this->load->view('bnb_login', $data);
	}

	public function password()
	{
		$data['action'] = 'password';
		$data['msg'] = 'Enter the E-Mail Id associated with your account!<br>A Password Reset link will be sent to that Email ID!';
		$data['fp_email'] = '';
		$data['err'] = '';
		//Go button pressed
		if (isset($_POST['btn_fp'])) {
			$temp1 = mysql_real_escape_string($_POST['fp_email']);
			$status = (int)$this->signup->user_id($temp1);
			if ($status == 0) {
				$data['err'] = "There is no account associated with the provided Email-ID";
				$data['fp_email'] = $temp1;
			} else {
				$pw_reset = $this->reset_password($status, $temp1);
				if ($pw_reset == 1) {
					$data['err'] = "";
					$data['msg'] = "An password-reset link has been sent to provided Email-ID:";
				} else {
					$data['err'] = "An error occured! Try again";
					$data['msg'] = "";
				}
			}

		}

		$this->load->view('bnb_login', $data);
	}

	public function reset_password($user_id, $email)
	{
		$act_key = random_string('alnum', 16);
		$act_id = $this->signup->create_activation_link($act_key, $user_id, $email, '', 2);

		$this->email->from('support@buyandbrag.in', 'BuynBrag');
		$this->email->to($email);
		$this->email->subject("BuynBrag: Password Reset Link for Login");
		$msg = "Click on the following link to reset the password & login to BuynBrag!<br>Ignore this mail to retain your old password(if any),incase you didn't request for it!<br>";
		$act_link = base_url() . 'index.php/welcome/activate/' . $act_id . '/' . md5($act_key) . '/2';
		$this->email->message($msg . $act_link);
		//echo $msg.$act_link;
		$this->email->set_newline("\r\n");
		if ($this->email->send())
			//if(1)
			return 1;
		else
			return 0;

	}

	public function case_validate($cap_text, $email)
	{
		// First, delete old captchas
		$expiration = time() - $this->cap_expiry;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($cap_text, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		if ($row->count == 0)
			return array("Wrong Captcha", "You entered a wrong verification code!");
		else {
			$sql = "delete FROM captcha WHERE word = ? AND ip_address = ?";
			$binds = array($cap_text, $this->input->ip_address());
			$query = $this->db->query($sql, $binds);
		}
		//Then see if Email ID exists:
		$sql = "SELECT user_id,fb_uid,COUNT(*) AS count FROM user_details WHERE email ='" . $email . "'";
		$query = $this->db->query($sql);
		$row = $query->row();
		if ($row->count > 0)
			return array("CaseA", $row->user_id, $row->fb_uid);
		else
			return array("CaseB", 0, 0);
	}

	public function create_new_user($user_details)
	{
		$user_id = $this->signup->create_user($user_details);
		$path = "assets/images/users/$user_id";
		if (mkdir($path, 0777)) {
			$img1 = file_get_contents('assets/images/default/defbig.jpg');
			$img2 = file_get_contents('assets/images/default/defsmall.jpg');
			$file1 = "assets/images/users/$user_id/" . $user_id . '_large.jpg';
			$file2 = "assets/images/users/$user_id/" . $user_id . '.jpg';
			file_put_contents($file1, $img1);
			file_put_contents($file2, $img2);
		}
		$sess = array('id' => $user_id, 'logged_in' => TRUE);
		$this->session->set_userdata($sess);
		redirect(base_url('user_info/homepage_afterlogin'));
	}

	public function generate_activation($user_details)
	{
		$act_key = random_string('alnum', 16);
		$act_id = $this->signup->create_activation_link($act_key, $user_details['user_id'], $user_details['email'], $user_details['pw1'], 1);
		return array($act_id, $act_key);
	}

	public function dataValidate($user_details)
	{
		if ($user_details['pw1'] != $user_details['pw2'])
			return 0;
		elseif ($user_details['pw1'] == '' or $user_details['pw2'] == '')
			return 0; elseif ($user_details['fname'] == '' or $user_details['lname'] == '')
			return 0; elseif ($user_details['email'] == '')
			return 0; else return 1;
	}

	public function activate($act_id, $act_key, $type)
	{
		if ($type == 1) {
			$status = $this->signup->modify_fb_bnb($act_id, $act_key);
			if ($status == 0) //invalid activation key
			{
				$data['act_error'] = 'error';
				$this->load->view('signup_msg', $data);
			} else {
				$sess = array('id' => $status, 'logged_in' => TRUE);
				$this->session->set_userdata($sess);
				redirect(base_url('homepage'));
			}
		} elseif ($type == 2) {
			$status = $this->signup->pw_reset_status($act_id, $act_key);
			$data['err'] = '';
			if ($status == 0) //invalid activation key
			{
				$data['act_error'] = 'error';
				$this->load->view('signup_msg', $data);
			} elseif ($status == 1) {
				$data['msg'] = 'Please enter your new password to continue!';
				$data['action'] = "pw_reset";
				$data['act_id'] = $act_id;
				$data['act_key'] = $act_key;
				if (isset($_POST['btn_reset_pw'])) {
					$a1 = mysql_real_escape_string($_POST['act_id']);
					$a2 = mysql_real_escape_string($_POST['act_key']);
					$a3 = mysql_real_escape_string($_POST['reset_pw1']);
					$a4 = mysql_real_escape_string($_POST['reset_pw2']);
					$status2 = $this->signup->pw_reset_status($a1, $a2);
					if ($a3 == '' or $a4 == '')
						$data['err'] = 'Passwords cannot be left blank!';
					elseif ($a3 != $a4)
						$data['err'] = 'The two passwords do not match!'; elseif ($status2 == 0)
						$data['err'] = 'Do not mutilate with the activation keys ;)'; else {
						$user_id = $this->signup->pw_reset($a1, $a2, $a3);
						if ($user_id == 0)
							$data['err'] = 'Some error occured! Try again';
						else {
							$sess = array('id' => $user_id, 'logged_in' => TRUE);
							$this->session->set_userdata($sess);
							redirect(base_url('homepage'));
						}
					}
				}
				$this->load->view('bnb_login', $data);
			}
		}
	}

	public function signup()
	{
		//data submission validation
		$data['msg'] = '';
		$data['email'] = '';
		$data['fname'] = '';
		$data['lname'] = '';
		if (isset($_POST['btn_signup'])) {
			$temp['email'] = mysql_real_escape_string($_POST['signup_email']);
			$temp['fname'] = mysql_real_escape_string($_POST['signup_fname']);
			$temp['lname'] = mysql_real_escape_string($_POST['signup_lname']);
			$temp['pw1'] = mysql_real_escape_string($_POST['signup_pw1']);
			$temp['pw2'] = mysql_real_escape_string($_POST['signup_pw2']);
			$temp['gender'] = 'male';
			$cap_text = mysql_real_escape_string($_POST['signup_cap']);
			$signup_case = $this->case_validate($cap_text, $temp['email']);

			//Case for actions to do
			if ($signup_case[0] == "CaseA") //already existing member(2 cases)
			{
				$temp['user_id'] = $signup_case[1];
				$temp['fb_uid'] = $signup_case[2];
				$act = $this->generate_activation($temp);
				$temp['act_id'] = $act[0];
				$temp['act_key'] = $act[1];
				if ($signup_case[2] == 'non-fb-member') //non fb-member re-tries signup
				{
					$data['re_activation'] = $temp;
					$this->load->view('signup_msg', $data);
					return 0;
				} else //fb-member tries to signup through email
				{
					$data['activation'] = $temp;
					$this->load->view('signup_msg', $data);
					return 0;
				}
				//case a ends
			} elseif ($signup_case[0] == "CaseB") //create new user(non-existing previously)
			{
				if ($this->dataValidate($temp) == 1)
					$this->create_new_user($temp);
				else //(html form manipulation/javascript bypass or sql-injection error)
				{
					$data['msg'] = 'There was an error while you entered your details!';
					$data['email'] = $_POST['signup_email'];
					$data['fname'] = $_POST['signup_fname'];
					$data['lname'] = $_POST['signup_lname'];
				}
				//case b ends
			} else //validation error in sign up page
			{
				$data['msg'] = $signup_case[1];
				$data['email'] = $_POST['signup_email'];
				$data['fname'] = $_POST['signup_fname'];
				$data['lname'] = $_POST['signup_lname'];
			}
			//else ends
		}


		//activation link button submit
		if (isset($_POST['btn_activate'])) {
			$a1 = mysql_real_escape_string($_POST['act_id']);
			$a2 = mysql_real_escape_string($_POST['act_key']);
			$to_email = $this->signup->act_mail($a1, $a2);
			if ($to_email != '0') {
				$this->email->from('support@buyandbrag.in', 'BuynBrag');
				$this->email->to($to_email);
				$this->email->subject("BuynBrag: Activation Link for Signup");
				$msg = "Click on the following link to activate the requested Username,Password & directly login to BuynBrag!<br>Ignore this mail to retain your old password(if any),incase you didn't request for it!<br>";
				$act_link = base_url() . 'index.php/welcome/activate/' . $a1 . '/' . md5($a2) . '/1';
				$this->email->message($msg . $act_link);
				$this->email->set_newline("\r\n");
				if ($this->email->send())
					$data['email_success'] = $to_email;
				else {
					$data['email_success'] = 'error';
					$data['error_email'] = $to_email;
				}

				$this->load->view('signup_msg', $data);
				return 0;
			}
			//activation accept page
		}
		//create a random captcha
		$vals = array(
			'word' => random_string('alpha', 7),
			'img_path' => './captcha/',
			'img_url' => base_url() . 'captcha/',
			'font_path' => './assets/font/rocki.ttf',
			'img_width' => '180',
			'img_height' => 60,
			'expiration' => $this->cap_expiry
		);
		$data['cap'] = create_captcha($vals);
		//store captcha in database
		$captcha_details = array(
			'captcha_time' => $data['cap']['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $data['cap']['word']);
		$query = $this->db->insert_string('captcha', $captcha_details);
		$this->db->query($query);

		$this->load->view('signup', $data);
	}

}
?>
