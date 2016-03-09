<?php class Upload extends CI_Controller
{
	function Upload()
	{
		parent::Controller();
	}

	function index()
	{
		$this->load->view('upload_form');
	}

	function do_upload()
	{
		$error = "";
		$msg = "";
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'doc|xls|ppt|pdf|rar|zip';
		$config['max_size'] = '1000';
		$this->load->library('upload', $config);
		$this->upload->display_errors('', '');
		if (!$this->upload->do_upload("fileToUpload")) {
			$error = $this->upload->display_errors();
		} else {
			$msg = "Success";
		}
		echo "{";
		echo    "error: '" . $error . "',n";
		echo    "msg: '" . $msg . "'n";
		echo "}";
	}
}
?>