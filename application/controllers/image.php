<?php
class Image extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('morder');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('javascript');
		$this->load->helper(array('form', 'url'));
		//$this->load->library('jquery');
		$data['base_url'] = base_url();
	}

	function index()
	{
		$this->load->view('test_page');
	}

	function do_upload()
	{
		$config['upload_path'] = './assets/uploads/products';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '3000';
		$config['max_height'] = '3000';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$this->load->view('order_failed', $data);
		} else {
			$this->load->view('order_success', $data);
		}
	}


	public function upload_file()
	{
		$status = "";
		$msg = "";
		$file_element_name = 'userfile';


		if ($status != "error") {
			$config['upload_path'] = './assets/uploads/products';
			$config['allowed_types'] = 'gif|jpg|png|doc|txt';
			$config['max_size'] = '10000';
			$config['max_width'] = '5000';
			$config['max_height'] = '5000';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload($file_element_name)) {
				$status = 'error';
				echo $msg = $this->upload->display_errors('', '');
			} else {
				$data = $this->upload->data();
				$file_id = 1;
				if ($file_id) {
					$status = "success";
					$msg = "File successfully uploaded";
				} else {
					unlink($data['full_path']);
					$status = "error";
					$msg = "Something went wrong when saving the file, please try again.";
				}
			}
			@unlink($_FILES[$file_element_name]);
		}
		echo json_encode(array('status' => $status, 'msg' => $data));
	}

}
?>
