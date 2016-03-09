<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class calendar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		include_once('header_for_controller.php');
		$this->load->view('calendar');
	}
}
?>
