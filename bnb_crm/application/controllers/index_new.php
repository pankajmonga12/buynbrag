<?php if( ! defined('BASEPATH') ) exit('403 Unuthorized!');
class Index_new extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
    {
        $data = array();
        $data['baseURL'] = $this->baseURL;
        $this->load->view('index_new', $data);
    }
    public function allOrders()
	{

	}
}
?>