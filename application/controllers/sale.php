<?php
class Sale extends CI_Controller
{
	private $userid = "";

	//public $categoriesdb = "";
	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('saledb');

	}

	function occ($occ)
	{
		include 'header_for_controller.php';
		$price1 = $this->input->post('price_1');
		$price2 = $this->input->post('price_2');
		$sort_price = (int)$this->input->post('sort_price');

		$data['price1'] = $this->input->post('price_1');
		$data['price2'] = $this->input->post('price_2');
		$data['sort_price'] = $this->input->post('sort_price');
		$data['occasion'] = $occ;
		$data['sub_categories'] = $this->categoriesdb->get_occ_tree($occ, 0, 1, (int)$price1, (int)$price2);
//var_dump($data['sub_categories']);
		foreach ($data['sub_categories'] as $temp1) {
			$data['sub_sub_categories'][$temp1['category_id']] = $this->categoriesdb->get_occ_tree($occ, $temp1['category_id'], 2, (int)$price1, (int)$price2);
			foreach ($data['sub_sub_categories'] as $temp2) {
				foreach ($temp2 as $temp3) {
					$temp_cat = $this->categoriesdb->get_occ_tree($occ, $temp3['category_id'], 3, (int)$price1, (int)$price2);
					$data['sub_sub_sub_categories'][$temp3['category_id']] = $temp_cat;
				}
			}
		}
//END Thejas
//Fancy - Ananth
		$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
		//var_dump($fancy);
		$fancy_array = array();
		$i = 0;
		foreach ($fancy as $key => $val) {
			foreach ($val as $key => $prod_id) {
				//var_dump ($prod_id);
				$fancy_array[$i] = $prod_id;
				$i++;
			}
		}
		$fancied = array_unique($fancy_array);
		$fancied_prods = array_merge($fancied);
		foreach ($fancied_prods as $f_item) {
			$data['fancied_prods'][$f_item] = 1;
		}
		// END Fancy


//     Catagories Left side
//            //Thejas      
		$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
		foreach ($poll_prods as $p_item) {
			$data['poll_prods'][$p_item->product_id] = 1;
		}

		$data['products'] = $this->categoriesdb->occasion($occ, $price1, $price2, $sort_price);
		$this->load->view('sale_occasion', $data);
	}

	function discount_sale($id)
	{
		include 'header_for_controller.php';
		$data['id'] = $id;
		$cat = $this->saledb->sale_cat($id);
		$data['sale_id'] = $cat[0]->category;
		$sale_id = $cat[0]->category;
		$price1 = $this->input->post('price_1');
		$price2 = $this->input->post('price_2');
		$sort_price = (int)$this->input->post('sort_price');

		$data['price1'] = $this->input->post('price_1');
		$data['price2'] = $this->input->post('price_2');
		$data['sort_price'] = $this->input->post('sort_price');

		//thejas poll
		$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
		foreach ($poll_prods as $p_item) {
			$data['poll_prods'][$p_item->product_id] = 1;
		}
//Fancy - Ananth
		$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
		//var_dump($fancy);
		$fancy_array = array();
		$i = 0;
		foreach ($fancy as $key => $val) {
			foreach ($val as $key => $prod_id) {
				//var_dump ($prod_id);
				$fancy_array[$i] = $prod_id;
				$i++;
			}
		}
		$fancied = array_unique($fancy_array);
		$fancied_prods = array_merge($fancied);
		foreach ($fancied_prods as $f_item) {
			$data['fancied_prods'][$f_item] = 1;
		}
		// END Fancy


		$this->load->model('saledb');

		$cat = $this->saledb->sale_cat($id);
		$data['sale_id'] = $cat[0]->category;
		$data['products'] = $this->saledb->sale_product($cat[0]->category, $price1, $price2, $sort_price);
		$data['sale_type'] = $cat[0]->category_name;
		$this->load->view('sale_prod', $data);
	}

}

?>