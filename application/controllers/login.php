<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('order');
		$this->load->model('products');
		$this->load->model('store_model');
		$this->load->model('design');
		$this->load->model('cartdb');
		$this->load->model('morder');
		$this->load->model('promotion');
		$this->load->model('slog');
		$this->load->model('login_model');
		$this->load->helper('html');
		$this->load->library('javascript');
		$this->load->helper(array('form'));
		//$this->load->library('jquery');
		$this->load->library('session');
		$this->load->model('slog');
	}
	
	public function index($controller = '', $function = '', $param1 = '', $param2 = '')
	{
		redirect(base_url());
		/*$url = NULL;
		$loggedIn = $this->session->userdata('logged_in');
		if(!empty($controller)) // if the first parameter has been provided
		{
			$url = site_url($controller . '/' . $function . '/' . $param1 . '/' . $param2);  // set URL to the passed URL
		}
		else // otherwise
		{
		    $url = 'homepage'; // set the redirection URL to the homepage
		}
		
		
		if (!empty($logged_id) && $loggedIn === TRUE) // if a user is logged in and their user ID has been set
		{
			redirect($url, 'location');
		}
		$data['msg']="";
		if(isset($_POST['emailid']))
		{
			$email = $this->input->post('emailid', TRUE);
			$pwd = md5( $this->input->post('password', TRUE) );
			$user_id=$this->login_model->login($email,$pwd);
			if(!empty($user_id))
			{
				$this->session->set_userdata('id',$user_id);
				$this->session->set_userdata('logged_in', TRUE); // this is needed by the existing system
				redirect($url);
			}
			else
			{
				$data['msg']='You have entered wrong email or password. Please try again.';
			}
		}
		$this->load->view('login_new',$data);
		*/
	}
	
	public function user($controller = '', $function = '', $param1 = '', $param2 = '')
	{
		$this->index($controller, $function, $param1, $param2);
	}
	
	
	function headerData()
	{
		$data['base_url'] = base_url();
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$data['store_url'] = $myconfig['store_url'];
		//$data['css'] = $this->config->item('css');


		//$data['catlist'] = $this->categoriesdb->catlist();
		//$data['hcatproducts'] = $this->categoriesdb->catprod(0);
		//$data['hcatstore'] = $this->categoriesdb->catstore(0);
		//$data['cart'] = $this->cartdb->mycartforuser($this->session->userdata('id'));
		//$data['userdetails'] = $this->morder->userdetails($this->session->userdata('id'));

		//Session validation
		if ($this->session->userdata('logged_in_seller') != TRUE)
		{
			redirect(base_url() . 'index.php/login/seller');
		}
		$data['user_id'] = $this->session->userdata('id');
		$this->load->view('header2_seller', $data);
	}


	///added by Rajeeb :Discount Summary

	function seller()
	{
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$this->load->view('seller', $data);
	}

	function getMeLoggedIn()
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'Someone from '.$__ip.' is trying to access login/getMeLoggedIn');
		$this->slog->write( array('level' => 1, 'msg' => 'Someone from '.$__ip.' is trying to access login/getMeLoggedIn'));
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		$username = $this->input->post('login_username', TRUE);
		$seller_password = md5($this->input->post('login_pass', TRUE));
		log_message('INFO', 'Username  = '.$username.' password = '.$this->input->post('login_pass', TRUE).' IP = '.$__ip);
		$this->slog->write( array('level' => 1, 'msg' => 'Username  = '.$username.' password = '.$this->input->post('login_pass', TRUE).' IP = '.$__ip));
		$data['seller_info'] = $this->login_model->getMeLogIn($username, $seller_password);
		log_message('INFO', '\$data[\'seller_info\'] = '.print_r($data['seller_info'], TRUE));
		$this->slog->write( array('level' => 1, 'msg'=> "\$data[\'seller_info\'] = ".print_r($data['seller_info'], TRUE)));
		log_message('INFO', '\count($data[\'seller_info\']) = '.print_r(count($data['seller_info']), TRUE));
		$this->slog->write( array('level' => 1, 'msg'=> '\count($data[\'seller_info\']) = '.print_r(count($data['seller_info']), TRUE)));
		if (count($data['seller_info']) > 0)
		{
			log_message('INFO', '\count($data[\'seller_info\']) = '.print_r(count($data['seller_info']), TRUE).' which is > 0');
			$this->slog->write( array('level' => 1, 'msg'=> '\count($data[\'seller_info\']) = '.print_r(count($data['seller_info']), TRUE).' which is > 0'));
			$s_id = $data['seller_info'][0]->store_id;
			$data = array('store_id' => $data['seller_info'][0]->storeowner_id, 'logged_in_seller' => TRUE, 'store_id' => $s_id);
			log_message('INFO', 'Now trying to set session data for username: '.$username);
			$this->slog->write( array('level' => 1, 'msg'=> 'Now trying to set session data for username: '.$username));
			$this->session->set_userdata($data);
			log_message('INFO', 'Just set session data for seller: '.$username.'. Will test now.');
			$this->slog->write( array('level' => 1, 'msg'=> 'Just set session data for seller: '.$username.'. Will test now.'));
			$storeID = $this->session->userdata('store_id');
			$loggedINSeller = $this->session->userdata('logged_in_seller');
			$storeID = $this->session->userdata('store_id');
			log_message('INFO', 'Data retrieved from session; store_id = '.$storeID.' logged_in_seller = '.print_r($loggedINSeller, TRUE));
			$this->slog->write( array('level' => 1, 'msg'=> 'Data retrieved from session; store_id = '.$storeID.' logged_in_seller = '.print_r($loggedINSeller, TRUE)));
			if ($s_id == 1)
			{
				log_message('INFO', 'redirecting to '.base_url() . 'index.php/dashboard/banner_design/' . $s_id);
				$this->slog->write( array('level' => 1, 'msg'=> 'redirecting to '.base_url() . 'index.php/dashboard/banner_design/' . $s_id));
				redirect(base_url() . 'index.php/dashboard/banner_design/' . $s_id);
			}
			else
			{
				log_message('INFO', 'redirecting to '.base_url() . 'index.php/dashboard/order_status/' . $s_id);
				$this->slog->write( array('level' => 1, 'msg'=> 'redirecting to '.base_url() . 'index.php/dashboard/order_status/' . $s_id));
				redirect(base_url() . 'index.php/dashboard/order_status/' . $s_id);
			}
		}
		else
		{
			log_message('INFO', 'redirecting to '.base_url() . 'index.php/footer/1');
			$this->slog->write( array('level' => 1, 'msg'=> 'redirecting to '.base_url() . 'index.php/footer/1'));
			redirect(base_url() . 'index.php/footer/1');
		}

	}

	function logout($uid)
	{
		$data = array('store_id' => $uid, 'logged_in_seller' => TRUE);
		$storeID = $data["store_id"];
		$this->session->unset_userdata($data);
		$this->session->unset_userdata('myNewStoreId');
		$this->session->sess_destroy();
		$data['base_url'] = base_url();
		$data['css'] = $this->config->item('css');
		//$this->load->view('seller', $data);
		//redirect(base_url()."index.php/order/store_page/".$storeID);
		redirect(base_url()."/#!/store//".$storeID);
	}
}
?>
