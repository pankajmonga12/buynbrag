<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $data['base_url'] = base_url();
    }

    public function index()
    {
        $red_url = $this->session->userdata('red_url');

        $password = $this->input->post('txt_password');
        $userName = $this->input->post('txt_username');
        if ($password == 'buynbrag' && $userName == 'rajat') {
            $this->session->set_userdata('status', 'admin');
            redirect($red_url);
        }

        $this->load->view('login');

    }

}
