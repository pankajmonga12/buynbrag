<?php
class Imagetest extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('morder');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('javascript');
		//$this->load->library('jquery');
	}

	function a($type, $img, $s_id, $p_id)
	{
		if (!is_dir("./assets/images/stores/" . $s_id . "/" . $p_id))
			mkdir("./assets/images/stores/" . $s_id . "/" . $p_id, 0700);


		$i = 0;


		while ($i < 6) {
			echo $i;
			switch ($i) {
				case 0:
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'c:/images/' . $img;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;

					$config['width'] = 240;
					$config['height'] = 200;
					$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_240x200.jpg';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					} else {
						if (file_exists('./assets/uploads/products/' . $config['new_image'])) {
							echo "file exist";
							$res = array();
							$return = 0;
							exec('mv ./assets/uploads/products/"' . $config['new_image'] . '"  "' . base_url() . '".assets/uploads/p', $res, $return);
							unset($res);
						} else {
						}

					}
					break;
				case 1:
					$this->image_lib->clear();
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'c:/images/' . $img;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 40;
					$config['height'] = 40;
					$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_40x40.jpg';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					} else {

					}
					break;
				case 2:
					$this->image_lib->clear();
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'c:/images/' . $img;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 97;
					$config['height'] = 80;
					$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_97x80.jpg';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					} else {

					}
					break;
				case 3:
					$this->image_lib->clear();
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'c:/images/' . $img;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 92;
					$config['height'] = 77;
					$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_92x77.jpg';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					} else {

					}
					break;
				case 4:
					$this->image_lib->clear();
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'c:/images/' . $img;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 598;
					$config['height'] = 453;
					$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_598x453.jpg';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					} else {

					}
					break;
				case 5:
					$this->image_lib->clear();
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'c:/images/' . $img;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 73;
					$config['height'] = 73;
					$config['new_image'] = './assets/images/stores/' . $s_id . "/" . $p_id . '/img' . $type . '_73x73.jpg';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					} else {

					}
					break;

			}
			$i++;
		}


	}
}

?>