<?php
echo "<b>Welcome Thejas</b><br>";
class Img2 extends CI_Controller
{


	public function indexx($img = 1)
	{


		//92x77 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = 'C:\test\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];

//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (92 / 77)) {
				$config['width'] = (92 / 77) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (77 / 92) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}

			$config['new_image'] = 'C:\test\test_9277.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 92*77 ratio</h5>";
		}


		//97x80 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = 'C:\test\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];

//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (97 / 80)) {
				$config['width'] = (97 / 80) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (80 / 97) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}

			$config['new_image'] = 'C:\wamp\test\test_9780.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 97*80 ratio</h5>";
		}

		//240x200 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = 'C:\test\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];

//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (240 / 200)) {
				$config['width'] = (240 / 200) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (200 / 240) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}

			$config['new_image'] = 'C:\wamp\test\test_240200.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 240*200 ratio</h5>";
		}


		//190*150 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = 'C:\test\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];

//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (190 / 150)) {
				$config['width'] = (190 / 150) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (150 / 190) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}

			$config['new_image'] = 'C:\wamp\test\test_190150.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 190*150 ratio</h5>";
		}


		//500*375 ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = 'C:\test\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];

//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if (($w / $h) > (500 / 375)) {
				$config['width'] = (500 / 375) * $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $config['width']) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = (375 / 500) * $w;
				$config['y_axis'] = ($h - $config['height']) / 2;
			}

			$config['new_image'] = 'C:\wamp\test\test_500375.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 500*375 ratio</h5>";
		}



		//Square ratio
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = 'C:\test\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
			$vals = getimagesize($url);
			$w = $vals['0'];
			$h = $vals['1'];

//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			if ($w > $h) {
				$config['width'] = $h;
				$config['height'] = $h;
				$config['x_axis'] = ($w - $h) / 2;
			} else {
				$config['width'] = $w;
				$config['height'] = $w;
				$config['y_axis'] = ($h - $w) / 2;
			}

			$config['new_image'] = 'C:\wamp\test\test_square.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->crop();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->crop()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: Square ratio</h5>";
		}





		//73x73
		{
			$config['image_library'] = 'gd2';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_square.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (73);
			$config['new_image'] = 'C:\wamp\test\img1_73x73.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 73x73</h5>";
		}


		//40x40
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_square.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (40);
			$config['new_image'] = 'C:\wamp\test\img1_40x40.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 40x40</h5>";
		}


		//171x171
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_square.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (171);
			$config['new_image'] = 'C:\wamp\test\img1_171x171.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 171*171</h5>";
		}


		//92x77
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_9277.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (92);
			$config['new_image'] = 'C:\wamp\test\img1_92x77.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 92x77</h5>";
		}


		//97x80
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_9780.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (97);
			$config['new_image'] = 'C:\wamp\test\img1_97x80.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 97/80</h5>";
		}


		//240x200
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_240200.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (240);
			$config['new_image'] = 'C:\wamp\test\img1_240x200.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 240/200</h5>";
		}


		//190x150
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_190150.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (190);
			$config['new_image'] = 'C:\wamp\test\img1_190x150.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 190/150</h5>";
		}

		//500x375
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\test_500375.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (500);
			$config['new_image'] = 'C:\wamp\test\img1_500x375.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 500/375</h5>";
		}

		//1013x____
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\source\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (1013);
			$config['new_image'] = 'C:\wamp\test\fancy1.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 1013x____</h5>";
		}



		//598x____
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\source\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (598);
			$config['new_image'] = 'C:\wamp\test\img1_product.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 598x____</h5>";
		}






		//494x____
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\source\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (494);
			$config['new_image'] = 'C:\wamp\test\fancy2.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 494x____</h5>";
		}


		//323x____
		{
			$this->image_lib->initialize($config);
			$url = 'C:\wamp\test\source\\' . $img . '.jpg';
			echo $url . "<br>";
			$config['image_library'] = 'gd2';
			$config['quality'] = "100%";
			$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;

			$config['width'] = (323);
			$config['new_image'] = 'C:\wamp\test\fancy3.jpg';

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			} else echo "<h5>Image processing success for Image " . $img . "- Size: 323x____</h5>";
		}


	}
}

?>