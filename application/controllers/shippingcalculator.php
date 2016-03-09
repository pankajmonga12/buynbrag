<?php
class ShippingCalculator extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('shipping');
		$this->load->model('cartdb');

		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->library('javascript');
		$this->load->helper(array('form'));

		//$this->load->library('jquery');

	}

	function shipping($pin)
	{

		$cartdetails = $this->cartdb->mycartforuser($this->session->userdata('id'));
		//echo $cartdetails[0]->prd_act_weight;
		//print_r($cartdetails );
		$isvalid = 1;
		foreach ($cartdetails as $item):
			$val = $this->isvalidatePin($item->prd_act_weight, $pin, $item->COD_policy, $item->shipping_mode);
			if ($val == 2) {
				$isvalid = 0;
				break;
			}
		endforeach;
		echo $isvalid;

	}


	public function isvalidatePin($weight, $pincode, $iscod, $issur)
	{
		$weight1 = $weight * 1000;
		$data['isvalid'] = $this->shipping->isvalidPin($weight1, $pincode, $iscod, $issur);
		if (count($data['isvalid']) > 0) {
			return 1;
		} else {
			return 2;
		}

	}

	function a()
	{
		$cartinfo = $this->cartdb->mycartforuser($this->session->userdata('id'));
		print_r($cartinfo);
		for ($i = 0; $i < count($cartinfo); $i++) {

			$shipping_cost = $this->calculate($cartinfo[$i]->prd_act_weight, "560031", $cartinfo[$i]->COD_policy, $cartinfo[$i]->shipping_mode);

		}
	}

	public function calculate($weight, $pincode, $iscod, $issur)
	{

		/*
			$weight_type=1 for  actual weight else  2

		*/

		$weight1 = $weight * 1000;
		$data['isvalid'] = $this->shipping->isvalidPin($weight1, $pincode, $iscod, $issur);
		print_r($data['isvalid']);
//	 $weight_type=1;
		echo "<br />";
		if (count($data['isvalid']) > 0) {
			echo "vallid PIN " . $data['isvalid'][0]->part_name;
			echo "<br />";


			$data['weight'] = $this->shipping->calc($weight1, $issur);
			// print_r($data['weight']);
			$shipping_cost = 0;
			echo "<br />";
			if ($data['isvalid'][0]->part_name == 1) {
				if ($weight1 >= 5000 && $weight1 <= 1000000) {
					$shipping_cost = $data['weight'][0]->fedx_cost * $weight;
				} else {
					$shipping_cost = $data['weight'][0]->fedx_cost;
				}
				echo("shipping cost :" . $shipping_cost);
			} else if ($data['isvalid'][0]->part_name == 2) {
				if ($weight1 >= 5000 && $weight1 <= 1000000) {
					$shipping_cost = $data['weight'][0]->blue_cost * $weight;
				} else {
					$shipping_cost = $data['weight'][0]->blue_cost;
				}
				echo("shipping cost :" . $shipping_cost);
			} else if ($data['isvalid'][0]->part_name == 3) {
				if ($weight1 >= 10000 && $weight1 <= 5000000) {
					$shipping_cost = $data['weight'][0]->gati_cost * $weight;
				} else {
					$shipping_cost = $data['weight'][0]->gati_cost;
				}
				echo("shipping cost :" . $shipping_cost);
			}
			echo "<br />";

		} else {
			echo "We cant delivers to u   as Pin is not in our circle .Sorry";
		}


	}
}

?>