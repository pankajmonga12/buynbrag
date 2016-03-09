<?php if( ! defined ( 'BASEPATH' )) exit('Direct script access not allowed');

class Homepage extends CI_Controller
{
	public function __constructor()
	{
		parent::__constructor();
		log_message('INFO', "userAgent ===== ".json_encode( $_SERVER['HTTP_USER_AGENT'] ) );
	}

	public function index()
	{
		$switcher = NULL;
		$preSwitcher = NULL;
		/* code to delete manish's mix panel shopping cart cookie */
		$this->load->helper('cookie');
		$cookieToDelete = array('name' => 'shoppingCartPageLoaded', 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/');
		delete_cookie($cookieToDelete);
		/* END SECTION code to delete manish's mix panel shopping cart cookie */

		$__ip = $this->input->ip_address();
		log_message('INFO', 'Someone from '.$__ip.' is accessing homepage/index');
		log_message('INFO', 'loading model async_model');
		/* WWW FIX BY SHAMMI SHAILAJ */
		$baseURL = base_url();
		$this->load->model('async_model');
		$currentPageURL = $this->async_model->currentPageURL();
		/* code for angular app routing */
		if(strpos($currentPageURL, "application/views/app") !== FALSE)
		{
			$preSwitcher = 4;
		}
		/* END SECTION code for angular app routing */
		log_message('INFO', 'Current page URL = '.print_r($currentPageURL, TRUE));
		log_message('INFO', 'baseURL = '.$baseURL);
		if(stripos($currentPageURL, 'www.', 0) !== FALSE)
		{
			$search = "www.";
			$replaceWith = "";
			$searchInside = $currentPageURL;
			$numberOfTimesToReplace = 1;
			$redirectURL = str_ireplace($search, $replaceWith, $searchInside, $numberOfTimesToReplace);
			log_message('INFO', 'Redirecting from '.$currentPageURL.' to '.$redirectURL.' for angular compatibility until Bimal finds a fix!');
			redirect($redirectURL);
		}
		/* END SECTION WWW FIX BY SHAMMI SHAILAJ */
		/* SUB-DOMAIN REDIRECTION CODE */
		$subdomain_arr = explode('.', $_SERVER['HTTP_HOST'], 2);
		$subdomain = $subdomain_arr[0];
		$this->load->model('categoriesdb');
		$redir_id = $this->categoriesdb->sub_domain($subdomain);
		if (!empty($redir_id))
		{
			log_message('Info', 'A Seller is trying to login from the Ip: ' . $this->input->ip_address() . '.');
			/* OLD PHP VIEW REDIRECT URL
			$url = base_url("index.php/order/store_page/" . $redir_id[0]->store_id);
			*/
			$url = base_url("/store/" . str_replace(' ', '-',$redir_id[0]->store_name)."/".$redir_id[0]->store_id);
			redirect($url, 'Location');
		}
		elseif ($subdomain == "seller")
		{
			log_message('Info', 'A Seller is trying to login from the Ip: ' . $this->input->ip_address() . '.');
			$url = base_url('index.php/login/seller');
			redirect($url, 'Location');
		}
		else
		{
			log_message('Info', 'A User-Buyer is trying to login from the Ip: ' . $this->input->ip_address() . '.');
			//$url = base_url('user_info/homepage_afterlogin');
			/*$url = base_url();
			redirect($url, 'Location');*/
			$data['baseURL'] = base_url();
			$isLoggedIN = $this->async_model->isLoggedIN();
			$data['isLoggedIN'] = $isLoggedIN;

			
			switch( $isLoggedIN['status'] )
			{
				case TRUE: $switcher = 1;
					break;
				case FALSE: $switcher = 2;
					break;
			}

			/* code by shammi shailaj to redirect robots directly to the homepage */
			$this->load->library('user_agent');
			switch( $this->agent->is_robot() )
			{
				case TRUE:	$switcher  = 3;
					break;
			}
			/* END SECTION code by shammi shailaj to redirect robots directly to the homepage */
			
			log_message('INFO', "\$switcher = ".$switcher);

			switch( $switcher )
			{
				case 1:	$data['userDetails'] = $this->async_model->userDetails($isLoggedIN['uid']);
						$data['headerData'] = $this->async_model->headerData($isLoggedIN['uid']);
						switch($preSwitcher === NULL)
						{
							case TRUE:	$this->load->view("dist/index", $data);
								break;
							case FALSE:	$this->load->view("app/index", $data);
								break;
						}
					break;
				case 2:	$data['userDetails'] = NULL;
						$data['headerData'] = NULL;
						/*$this->load->view("dist/landing", $data); // landing page blockade*/
						switch($preSwitcher === NULL)
						{
							case TRUE:	$this->load->view("dist/index", $data);
								break;
							case FALSE:	$this->load->view("app/index", $data);
								break;
						}
					break;
				case 3:	$data['userDetails'] = NULL;
						$data['headerData'] = NULL;
						switch($preSwitcher === NULL)
						{
							case TRUE:	$this->load->view("dist/index", $data);
								break;
							case FALSE:	$this->load->view("app/index", $data);
								break;
						}
					break;
			}
			
			log_message('INFO', 'data = '.print_r($data, TRUE));
			//$this->load->view("homepage", $data);
			//$this->load->view("website_down", $data);
		}
		/* END SECTION SUB-DOMAIN REDIRECTION CODE */
	}
	
	public function dev()
	{
		$__ip = $this->input->ip_address();
		log_message('INFO', 'Someone from '.$__ip.' is accessing homepage/dev');
		log_message('INFO', 'loading model async_model');
		$data['baseURL'] = base_url();
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		$data['isLoggedIN'] = $isLoggedIN;
		switch($isLoggedIN['status'])
		{
			case TRUE: $data['userDetails'] = $this->async_model->userDetails($isLoggedIN['uid']);
					 $data['headerData'] = $this->async_model->headerData($isLoggedIN['uid']);
				break;
			case FALSE: $data['userDetails'] = NULL;
					 $data['headerData'] = NULL;
		}
		log_message('INFO', 'data = '.print_r($data, TRUE) );
		//$this->load->view("homepage", $data);
		$this->load->view("app/index", $data);
	}
}
?>
