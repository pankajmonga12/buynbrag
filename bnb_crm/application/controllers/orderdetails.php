<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');
class Orderdetails extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
  public function orderIDpdf()
  {
      $txnID = $this->input->get('txnID');
      $data = array();
      $data['baseURL'] = base_url();
      $data['orderID'] = $txnID;
      $this->load->model('orderModel');
      $output = $this->orderModel->orderIDdetails($data['orderID']);
      //$this->load->view('orderPDF',$output,$data['baseURL']);
  }
  public function txnIDpdf()
  {
    $txnID = $this->input->get('txnID');
    $data = array();
    $data['baseURL'] = base_url();
    $data['txnID'] = $txnID;
    $this->load->model('orderModel');
    $output['base'] = $this->orderModel->txnIDdetails($data['txnID']);
    $this->load->view('orderView',$output,$data['baseURL']);
  }   

} 
?>    
