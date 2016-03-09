<?php if ( ! defined ( 'BASEPATH' ) ) exit( '403 Unauthorized!' );

class Coupon extends CI_Controller
{
	public $baseURL = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->baseURL = base_url();
	}

	public function index()
	{
		$this->load->view( 'coupon', array('baseURL' => $this->baseURL ) );
	}
}
?>