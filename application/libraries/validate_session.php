<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Validate_Session
{
    public function __construct()
    {
        $cI = get_instance();

        $cI->load->library('Session');

        if ($this->session->userdata('logged_in') != TRUE) 
            {
            redirect(base_url()); 
        }
    }
} 
?>