<?php

    class Transaction extends CI_Controller 
    {

    	public function __construct() 
       {
		parent:: __construct();
        $this->load->helper("url");
		$this->load->model("transaction_model");
		$this->load->library("pagination");
	   }
    	function display( $page = 0 )
       {
	     $limit=20;
         // pagination
		 $this->load->library('pagination');
         $config = array();
	     $config['base_url'] = base_url()."index.php/transaction/display";
		 $config['total_rows']=$this->transaction_model->record_count();
		 $config["per_page"] = $limit;
	     $config['use_page_numbers'] = TRUE;
	     $config['first_url'] = '1';
	     $offset = $this->uri->segment(3);
	     //$choice = $config["total_rows"] / $config["per_page"];
         //$pagination["num_links"] = round($choice);
		 $config['uri_segment'] = 3;
	     $config["num_links"] = 20;
	     $config['next_link']  = 'Next';
	     $config['prev_link'] = 'Back';
         $this->pagination->initialize( $config );
				
		 $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		 $data['i'] = (($offset-1) * $limit) +1; 
		 $data['baseURL'] = base_url();
		 $data['taxID'] = $this->transaction_model->transactionDetail($config['per_page'], $offset);
		 $data['pagination'] = $this->pagination->create_links();
		 $this->load->view('transaction_view',$data);
					     
        }

        public function beforeCheckout()
       {
	      $transID = $this->input->get('transID');
	      $transData = $this->transaction_model->beforeCheckoutData($transID);
	      $response = print_r($transData[0]->bcData,TRUE);
	      $this->output->set_content_type('application/json');
	      $this->output->set_output($response);
        }

        public function afterCheckout()
        {
	      $transID = $this->input->get('transID');
	      $transData = $this->transaction_model->afterCheckoutData($transID);
	      $response = print_r($transData[0]->acData,TRUE);
	      $this->output->set_content_type('application/json');
	      $this->output->set_output($response);
        }
}

?>