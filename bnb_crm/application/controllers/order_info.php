<?php
class Order_info extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata');
        $status = $this->session->userdata('status');
        if (empty($status)) {
            $this->session->set_userdata('red_url', current_url());
            redirect(base_url() . 'index.php/login');
        }
        $this->load->model('crm_model');
        $this->load->model('info_model');
    }

    public function seller_info($order_id)
    {
        $seller_details = $this->info_model->seller_info($order_id);
        $data['row'] = $seller_details;
        //var_dump($seller_details);
        $this->load->view('seller_info', $data);
    }

    public function product_info($order_id)
    {
        $product_details = $this->info_model->product_info($order_id);
        $data['row'] = $product_details;
        //var_dump($product_details);
        $this->load->view('product_info', $data);
    }

    public function payment_info($order_id)
    {
        $payment_details = $this->info_model->payment_info($order_id);
        $data['row'] = $payment_details;
        $data['base_url'] = base_url();
        //var_dump($product_details);
        $this->load->view('payment_info', $data);
    }
}

?>