<?php
class logistic extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('logistic_model');
		$this->load->helper('form');
		$this->load->helper('directory');
		$this->load->library('session');
		$this->load->helper('download');
	}
	
	public function index()
	{
		$this->logistics_dashb();
	}
	
	public function manifestIDs()
	{
		$city = $this->session->userdata('city');
		$responseData['isLoggeIN'] = FALSE;
		if($this->session->userdata('logistic_id'))
		{
			$responseData['isLoggeIN'] = TRUE;
			$responseData['manifestIDs'] = $this->logistic_model->manifestIDs($city);
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function batchIDs($manifestID = NULL)
	{
		$city = $this->session->userdata('city');
		$responseData['isLoggeIN'] = FALSE;
		if($this->session->userdata('logistic_id'))
		{
			$responseData['isLoggeIN'] = TRUE;
			$responseData['batchIDs'] = $this->logistic_model->batchIDs($manifestID);
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function batchOrders($batchID, $pageNumber = 0)
	{
		$city = $this->session->userdata('city');
		$responseData['isLoggeIN'] = FALSE;
		if($this->session->userdata('logistic_id'))
		{
			$responseData['isLoggeIN'] = TRUE;
			$responseData['batchOrders'] = $this->logistic_model->batchOrders($batchID, $pageNumber);
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function saveRemark($batchItemID, $status, $remark)
	{
		$city = $this->session->userdata('city');
		$responseData['isLoggeIN'] = FALSE;
		if($this->session->userdata('logistic_id'))
		{
			$responseData['isLoggeIN'] = TRUE;
			$responseData['saveRemarkStatus'] = $this->logistic_model->saveRemark($batchItemID, $status, urldecode($remark));
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
	
	public function order_list()
	{
		log_message('INFO', "inside logistic/order_list");
		/*$data['order_details'] = $this->logistic_model->all_order_details();*/
		/*$this->load->view('list_of_order', $data);*/
		$data = NULL;
		if($this->session->userdata('logistic_id'))
		{
			log_message('INFO', "Someone is logged-in from ".$this->input->ip_address());
			$data['storeIDs'] = $this->logistic_model->manifestIDs();
			$city = $this->session->userdata('city');
			$data['orderDetailsPrepaid'] = $this->logistic_model->orderDetails($city);
			$data['orderDetailsCOD'] = $this->logistic_model->orderDetailsCOD($city);
			log_message('INFO', "exiting logistic/order_list. \$data = ".print_r($data, TRUE)."\r\nLoading the list_of_order view now");
			$this->load->view('list_of_order2', $data);
		}
		else
		{
			log_message('INFO', "Nobody is logged-in from ".$this->input->ip_address()." exiting logistic/order_list. \$data = ".print_r($data, TRUE)."\r\nRedirecting to logistic/logistics_dashb now");
			redirect('logistic/logistics_dashb');
		}
	}

	public function logout()
	{
		session_start();
		session_destroy();
		redirect('logistic/logistics_dashb');
	}

	public function export()
	{
		if (isset($_POST['export']) && ($_POST['from']) && ($_POST['to']))
		{
			$fileName = 'file.csv';
			header("Content-type: text/x-csv");
			$ab = $_POST['from'];
			$abc = $_POST['to'];
			$t1 = explode(" ",$ab);
			$t2 = explode(" ",$abc);
			$from = $t1[0];
			$to = $t2[0];
			$fileName = 'csvbydate.csv';
			$this->output->set_content_type('text/x-csv');
			header("Content-Disposition: attachment; filename=$fileName");
			
			$f = @fopen('php://output', 'w');
			$sql = "select * from shipped_orders where order_date_IST between '" . $_POST['from'] . "' and '" . $_POST['to'] . "'";
			$res = mysql_query($sql);
			
			$first = true;
			while ($row = mysql_fetch_assoc($res))
			$res=$this->logistic_model->exportbydate($from,$to);
			$first = true;
			foreach ($res as $row)
			{
				if($first)
				{
					fputcsv($f, array_keys($row));
					$first = false;
				}
				fputcsv($f, $row);
			}
			fclose($f);
		}
		else
		{
			redirect('logistic/order_list');
		}
	}

	public function logistics_dashb()
	{
		log_message('INFO', "inside logistic/logistics_dashb");
		$data['msg'] = "";
		if(isset($_POST['select']))
		{
			$logistic_id = $this->logistic_model->login($this->input->post('select'), $this->input->post('city'), $this->input->post('pwd'));
			log_message('INFO', "logistic_id = ".print_r($logistic_id, TRUE)." is trying to login from ".$this->input->ip_address());
			if (!empty($logistic_id))
			{
				log_message("INFO", "now setting session to login the logistics partner");
				$this->session->set_userdata('logistic_id', $logistic_id);
				log_message('INFO', "Session has been set. Will now test it");
				$id = $this->session->userdata('logistic_id');
				log_message('INFO', "data retrieved from session is::: id = ".print_r($id, TRUE));
				log_message('INFO', "exiting logistic/logistic_dashb. \$data = ".print_r($data, TRUE)."\r\nRedirecting to logistic/order_list now");
				redirect('logistic/order_list');
			}
			else
			{
				$data['msg'] = 'You have entered wrong email or password. Please try again.';
			}
		}
		log_message('INFO', "exiting logistic/logistic_dashb. \$data = ".print_r($data, TRUE)."\r\nLoading the logistics_dashb view now");
		$this->load->view('logistics_dashb', $data);
	}

	public function search()
	{

		if (isset($_POST['order_status']))
		{
			$order_status = $this->input->post('order_status');
			$data['order_details1'] = $this->logistic_model->select_order_details($order_status);
			$this->load->view('search_result', $data);
		}
	}

	public function edit()
	{
		if ($_POST['Submit'])
		{
			foreach ($_POST['id'] as $id)
			{
				$sql1 = "update shipped_orders set remark='" . $_POST["remark" . $id] . "',order_status='" . $_POST["action" . $id] . "' WHERE awb_no='" . $id . "'";
				$result1 = mysql_query($sql1);
			}
		}
		redirect('logistic/order_list');
	}
	
	public function load()
	{
		if($_POST['id'])
		{
			$id=$_POST['id'];
			$sql=mysql_query("SELECT id FROM batch WHERE store_id='$id'");
			while($row=mysql_fetch_array($sql))
			{
				$store_id = $row['id'];
				echo '<option value="'.$store_id.'">'.$store_id.'</option>';
			}
		}
	}
	
	public function upload()
	{
		if(isset($_POST['submit']))
		{
			//$path = "C:/xampp/htdocs/bnb-l/csv/";
			/* PATH FIX BY SHAMMI SHAILAJ======================================================================= */
			/* ============================TO GET THE REAL PATH ON THE CURRENT SERVER RATHER THAN HARD-CODING IT */
			$path = __DIR__."/../../bnb_crm/logisticsData/";
			/* END PATH FIX BY SHAMMI SHAILAJ=================================================================== */
			$filename = $_FILES['files']['name'];
			$filename = date('U').$filename;
			$add1 =  $path.$filename;
			move_uploaded_file($_FILES['files']['tmp_name'], $add1);
			$sql = mysql_query("UPDATE batch set url='$add1' WHERE id=2");
		}
		redirect('logistic/order_list');
	}
	
	public function searchdata()
	{
		if (isset($_POST['submit']))
		{
			$id = $this->input->post('id');
			$store_id = $this->input->post('store_id'); 
			$data['result'] = $this->logistic_model->search_result($id,$store_id);
		}
		$this->load->view('list_of_order',$data);
	}
}
?>
