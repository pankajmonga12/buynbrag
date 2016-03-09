<?php
class Owner extends CI_Controller
{
	private $userid = "";

	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();
	}

	function owner_info($sid)
	{
		include 'header_for_controller.php';
		$this->load->model('morder');
		$data['ownerdata'] = $this->morder->mystore($sid);
		$data['myprod'] = $this->morder->products($sid);
		$this->load->view('store_owner_profile', $data);
	}
//put your code here
}

?>
