<?php
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('directory');
	}

	public function index()
	{
		redirect(base_url('index.php/admin/accessFiles'));
	}

	public function adminSessionCheck()
	{
		$firstTime = $this->session->userdata('firstTime');
		if ($firstTime == FALSE)
		{
			$this->session->set_userdata('firstTime', 2);
			$this->load->library('user_agent');
			if ($this->agent->is_browser())
			{
				$agent = $this->agent->agent_string();
			}
			elseif ($this->agent->is_robot())
			{
				$agent = $this->agent->robot() . ' [ROBOT] ' . $this->agent->agent_string();
			}
			elseif ($this->agent->is_mobile())
			{
				$agent = $this->agent->mobile() . ' [MOBILE USER] ' . $this->agent->agent_string();
			}
			else
			{
				$agent = 'Unidentified User Agent in ' . $this->agent->platform();
			}
			$userIp = $this->input->ip_address();
			if ($userIp != '127.0.0.1')
			{
				$location = file_get_contents("http://api.hostip.info/get_html.php?ip=$userIp");
			}
			else
			{
				$location = 'Localhost';
			}
			log_message('Info', "User is trying to access the site's admin panel from the location: $location and using $agent.");
		}

		$adminId = $this->session->userdata('adminId');
		if ($adminId)
		{
			log_message('Info', "Admin is logged in.");
		}
		else
		{
			$adminid = $this->input->post('adminid');
			$adminpwd = $this->input->post('adminpwd');
			$data['maxTry'] = 3;
			$data['attempts'] = $this->session->userdata('attempts');
			$uname = 'lee';
			$pwd = 'lee';
			$data['adminid'] = $adminid;
			$data['adminpwd'] = $adminpwd;
			$data['error'] = FALSE;
			if (!empty($adminid) && !empty($adminpwd))
			{
				if (md5($adminid) == md5($uname) && md5($adminpwd) == md5($pwd))
				{
					$this->session->set_userdata('attempts', 0);
					$this->session->set_userdata('adminId', $adminid);
					redirect(base_url('index.php/admin/accessFiles'));
				}
				else
				{
					$this->session->set_userdata('attempts', (int)$data['attempts'] + 1);
					$data['error'] = TRUE;
					$this->load->view('adminSession', $data);
				}
			}
			else
			{
				$this->session->set_userdata('attempts', (int)$data['attempts'] + 1);
				$this->load->view('adminSession', $data);
			}
		}
	}

	public function accessFiles()
	{
		$isAdmin = $this->session->userdata('adminId');
		if ($isAdmin) {
			$data['function'] = 'Logs List';
			$data['dmap'] = directory_map('./application/logs', 2);
			$data['base_url'] = base_url();
			$this->load->view('fileAccess', $data);
		} else {
			redirect(base_url('index.php/admin/adminSessionCheck'));
		}
	}

	public function downloadLogs($logName)
	{
		$isAdmin = $this->session->userdata('adminId');
		if ($isAdmin) {
			log_message('Info', "Admin is trying to download a log-file: $logName.");
			$this->load->helper('download');
			$logContents = file_get_contents('./application/logs/' . $logName);
			force_download($logName, $logContents);
		} else {
			redirect(base_url('index.php/admin/adminSessionCheck'));
		}
	}

	public function controllers()
	{
		//
	}

	public function logout()
	{
		$this->session->set_userdata('attempts', 0);
		$this->session->unset_userdata('adminId');
		//$this->session->sess_destroy();
		redirect(base_url('index.php/admin'));
	}

}?>
