<?php
class Categories extends CI_Controller
{
	private $userid = "";

	//public $categoriesdb = "";
	//private $userdetails = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('poll_model');
		$this->load->model('store_model');
		$this->load->model('categoriesdb');
	}

	function index()
	{
		//Dont delete this function.
		$this->cat_main(1);
	}

	function cat_main($id, $sub_count = 0, $sub_main = 0)
	{
		include 'header_for_controller.php';


		$data['id'] = $id;
		$data['products'] = array_slice($this->categoriesdb->catprod($id), 0, 12);
		$data['store'] = array_slice($this->categoriesdb->catstore($id), 0, 6);
		// for store with 3 random product image
		$data['sprod'] = array();
		foreach ($data['store'] as $sid)
		{
			$key = '_' . $sid->store_id;
			$var = array($key => $this->categoriesdb->catstoreprod($id, $sid->store_id));
			$data['sprod'] = array_merge($data['sprod'], $var);
		}
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
			//Fancy - Ananth
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val)
			{
				foreach ($val as $key => $prod_id)
				{
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_prods = array_merge($fancied);
			foreach ($fancied_prods as $f_item)
			{
				$data['fancied_prods'][$f_item] = 1;
			}
			// END Fancy


//Thejas      
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item)
			{
				$data['poll_prods'][$p_item->product_id] = 1;
			}
		}
		$data['sub_count'] = $sub_count;
		$data['sub_main'] = $sub_main;
		$data['sub_categories'] = $this->categoriesdb->get_cat_tree($id, 1);
		foreach ($data['sub_categories'] as $temp1) {
			$data['sub_sub_categories'][$temp1['category_id']] = $this->categoriesdb->get_cat_tree($temp1['category_id'], 2);
			foreach ($data['sub_sub_categories'] as $temp2) {
				foreach ($temp2 as $temp3) {
					$temp_cat = $this->categoriesdb->get_cat_tree($temp3['category_id'], 3);
					$data['sub_sub_sub_categories'][$temp3['category_id']] = $temp_cat;
				}
			}
		}
//END Thejas

		$data['banner_prod'] = $this->categoriesdb->banner_prod($id);
		$this->load->view('cat_main', $data);

	}

	function cat_product($id, $sub_count = 0, $sub_main = 0, $sub_sub_count = 0, $sub_sub_main = 0)
	{
		include 'header_for_controller.php';
		$data['id'] = $id;
		$price1 = $this->input->post('price_1');
		$price2 = $this->input->post('price_2');
		$data['price1'] = $this->input->post('price_1');
		$data['price2'] = $this->input->post('price_2');
		$sort_price = (int)$this->input->post('sort_price');
		if ($sort_price == 0)
		{
			$sort_price = 4;
			$data['sort_price'] = 4;
		}
		else
		{
			$data['sort_price'] = $this->input->post('sort_price');
		}
		$data['sub_count'] = $sub_count;
		$data['sub_main'] = $sub_main;
		$data['sub_sub_count'] = $sub_sub_count;
		$data['sub_sub_main'] = $sub_sub_main;
		$data['occasions'] = $this->categoriesdb->cat_occasions($id);
		//$data['occasions'] = $this->store_model->bnb_occasions();
		$data['products'] = $this->categoriesdb->catprodshow($id, $price1, $price2, $sort_price);
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		if($isLoggedIN['status'] === TRUE)
		{
			//Fancy - Ananth
			$fancy = $this->categoriesdb->fancy_prods($this->session->userdata('id'));
			//var_dump($fancy);
			$fancy_array = array();
			$i = 0;
			foreach ($fancy as $key => $val)
			{
				foreach ($val as $key => $prod_id)
				{
					//var_dump ($prod_id);
					$fancy_array[$i] = $prod_id;
					$i++;
				}
			}
			$fancied = array_unique($fancy_array);
			$fancied_prods = array_merge($fancied);
			foreach ($fancied_prods as $f_item)
			{
				$data['fancied_prods'][$f_item] = 1;
			}
			// END Fancy
//Thejas      
			$poll_prods = $this->poll_model->my_poll_products($this->session->userdata('id'));
			foreach ($poll_prods as $p_item)
			{
				$data['poll_prods'][$p_item->product_id] = 1;
			}
		}
		else
		{
			//$this->output->cache(1440); // cache the page for 1 day for non-logged-in users
		}
		$data['sub_categories'] = $this->categoriesdb->get_cat_tree_2($id, 1, (int)$price1, (int)$price2);
//var_dump($data['sub_categories']);
		foreach ($data['sub_categories'] as $temp1)
		{
			$data['sub_sub_categories'][$temp1['category_id']] = $this->categoriesdb->get_cat_tree_2($temp1['category_id'], 2, (int)$price1, (int)$price2);
			foreach ($data['sub_sub_categories'] as $temp2)
			{
				foreach ($temp2 as $temp3)
				{
					$temp_cat = $this->categoriesdb->get_cat_tree_2($temp3['category_id'], 3, (int)$price1, (int)$price2);
					$data['sub_sub_sub_categories'][$temp3['category_id']] = $temp_cat;
				}
			}
		}
//END Thejas               
		$data['banner_prod'] = $this->categoriesdb->banner_prod($id);
//		   var_dump($data['banner_prod']);
		$this->load->view('cat_prod', $data);
	}

	function cat_stores($id)
	{
		include 'header_for_controller.php';
		$data['id'] = $id;
		$data['products'] = $this->categoriesdb->catprod($id);
		$data['store'] = $this->categoriesdb->catstore($id);
		$data['sprod'] = array();
		foreach ($data['store'] as $sid)
		{
			$key = '_' . $sid->store_id;
			$var = array($key => $this->categoriesdb->catstoreprod($id, $sid->store_id));
			$data['sprod'] = array_merge($data['sprod'], $var);
		}
//Thejas      
		$data['sub_categories'] = $this->categoriesdb->get_cat_tree_3($id, 1);
		foreach ($data['sub_categories'] as $temp1)
		{
			$data['sub_sub_categories'][$temp1['category_id']] = $this->categoriesdb->get_cat_tree_3($temp1['category_id'], 2);
			foreach ($data['sub_sub_categories'] as $temp2)
			{
				foreach ($temp2 as $temp3)
				{
					$temp_cat = $this->categoriesdb->get_cat_tree_3($temp3['category_id'], 3);
					$data['sub_sub_sub_categories'][$temp3['category_id']] = $temp_cat;
				}
			}
		}
		$data['banner_prod'] = $this->categoriesdb->banner_prod($id);
		$this->load->view('cat_stores', $data);
	}


}

?>