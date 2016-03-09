<?php

class Categoriesdb extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	function sub_domain($domain)
	{
		$this->db->select('store_id');
		$this->db->select('store_name');
		$this->db->from('store_info');
		$this->db->where('store_url', $domain);
		$result = $this->db->get();
		return $result->result();
	}

	function header_store($id)
	{
		$this->db->select('store_id , store_name');
		$this->db->from('store_info s1');
		$this->db->where('exists(SELECT products.product_id FROM products WHERE store_id = s1.store_id and cat_id = ' . $id . ')');
		$this->db->order_by('(visit_counter + fancy_counter) ASC');
		$this->db->limit(8);
		$result = $this->db->get();
		return $result->result();
	}

	function header_fancycatprod($id)
	{
		$this->db->select('products.product_id , product_name , fancy_counter , store_id , selling_price , discount');
		$this->db->from('products');
		$this->db->where('cat_id', $id);
		$this->db->order_by('fancy_counter', 'DESC');
		$this->db->limit(8);
		$result = $this->db->get();
		return $result->result();
	}

	function mega_cat()
	{
		$this->db->select('category_id,category_name');
		$this->db->from('catagories');
		$this->db->where('parent_catagory_id', 0);
		$this->db->limit(10);
		$result = $this->db->get();
		return $result->result();
	}

	function catlist()
	{
		$this->db->select('category_id');
		$this->db->select('category_name');
		$this->db->select('parent_catagory_id');
		$this->db->select('sort_order');
		$this->db->select('status');
		$this->db->from('catagories c1');
		$this->db->where('parent_catagory_id between 1 and 5');
		$this->db->where('exists(SELECT products.product_id FROM products WHERE sub_catid1 = c1.category_id)');
		$this->db->order_by('parent_catagory_id', "asc");
		$this->db->order_by('category_id', "asc");
		$result = $this->db->get();
		return $result->result();
	}

	function catstore($id)
	{
		$this->db->select('store_info.store_id ,store_info.store_name , store_info.fancy_counter , store_info.brag_counter , products.cat_id');
		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		if ($id <> 0) {
			$this->db->where('cat_id', $id);
			$this->db->group_by('products.store_id');
		}
		if ($id == 0) {
			$this->db->order_by('store_id', "asc");
		}
		$result = $this->db->get();
		return $result->result();
	}

	function catstoreprod($id, $sid)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('cat_id', $id);
		//$this->db->join('store_info','products.store_id = store_info.store_id');

		$this->db->where('products.store_id', $sid);
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$result = $this->db->get();
		return $result->result();
	}

	function banner_prod($id)
	{
		$this->db->select('store_info.store_id , products.product_id , products.selling_price , products.discount , products.product_name ');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');
		$this->db->order_by('products.fancy_counter', "desc");
		$this->db->where('cat_id', $id);
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$this->db->limit(3);
		$result = $this->db->get();
		return $result->result();
	}

	function catprod($id)
	{
		//$strname = $temp;
		$this->db->select('products.cat_id');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');
		if ($id <> 0) {
			$this->db->where('cat_id', $id);
		}
		$this->db->where('products.quantity > 0');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$this->db->order_by('products.visit_counter + products.fancy_counter', "desc");
		$result = $this->db->get();
		return $result->result();
	}

	function occasion($occ, $price1 = 0, $price2 = 0, $sort_price = 0)
	{
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'products.store_id = store_info.store_id');
		if (($price2 > 0) and ($price1 < $price2))
			$this->db->where('(products.selling_price-products.discount) between ' . $price1 . ' and ' . $price2);
		$this->db->where('products.quantity > 0');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$this->db->like('occasions', $occ);
		if ($sort_price == 1)
			$this->db->order_by('(selling_price-discount)', 'ASC');
		elseif ($sort_price == 2)
			$this->db->order_by('(selling_price-discount)', 'DESC');

		$this->db->order_by('products.product_id', 'ASC');
		$this->db->limit(9);
		$result = $this->db->get();
		return $result->result();
	}

	function catprodshow($id, $price1 = 0, $price2 = 0, $sort_price = 0) //normal loading of cat_prod
	{
		//$strname = $temp;
		/* $this->db->start_cache();
		$this->db->select('store_info.store_name');
		$this->db->select('products.product_id');
		$this->db->select('products.store_id');
		$this->db->select('products.is_on_discount');
		$this->db->select('products.discount');
		$this->db->select('products.selling_price');
		$this->db->select('products.product_name');
		$this->db->select('products.fancy_counter'); */
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');
		if (($price2 > 0) and ($price1 < $price2))
			$this->db->where('(products.selling_price-products.discount) between ' . $price1 . ' and ' . $price2);
		if ($id <> 0) {
			$this->db->where('cat_id', $id);
		}
		$this->db->where('products.quantity > 0');
		$this->db->where('products.status', 1); // pick only those products whose store are enabled
		$this->db->where('products.is_enable', 0); // pick only those products which are enabled
		//$this->db->order_by('products.visit_counter + products.fancy_counter',"desc");
		if ($sort_price == 1) // sort by lowest price
			$this->db->order_by('(selling_price-discount)', 'ASC');
		elseif ($sort_price == 2) // sort by highest price
			$this->db->order_by('(selling_price-discount)', 'DESC');
		elseif ($sort_price==3) // sort by popularity
			$this->db->order_by('(products.visit_counter+products.fancy_counter+products.brag_counter)', 'DESC');
		elseif ($sort_price == 4) // sort by newness
			$this->db->order_by('products.added_on', 'DESC');
		elseif ($sort_price == 5) // sort by store name
			$this->db->order_by('store_info.store_name', 'ASC');
		$this->db->order_by('products.product_id', 'ASC');
		//$this->db->limit(9);
		//$this->db->stop_cache();
		$result = $this->db->get();
		return $result->result();
	}


	function catprodLoader($type, $id, $limit, $price1 = 0, $price2 = 0, $sort_price = 0, $last_price = 0, $sssc_id = 0, $sssc_type = 0, $range_bits = "", $occasions)
	{
		log_message('INFO', 'inside categoriesdb/catprodLoader from '.$this->input->ip_address());
		//$strname = $temp;
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		
		if ($sssc_type == 0)
			$this->db->where('cat_id', $id);
		else
			$this->db->where('sub_catid' . $sssc_type, $sssc_id);

		if (($price2 > 0) and ($price1 < $price2))
			$this->db->where('(products.selling_price-products.discount) between ' . $price1 . ' and ' . $price2);
		else {
			$or_query = "";
			$or_count = 0;
			for ($i = 0; $i < count($occasions); $i++) {
				$or_count++;
				if ($or_count == 1)
					$or_query = "(products.occasions like '%" . $this->db->escape($occasions[$i]) . "%')";
				else
					$or_query = $or_query . " OR (products.occasions like '%" . $this->db->escape($occasions[$i]) . "%')";
			}
			$this->db->where('(' . $or_query . ')');
			if (!($range_bits == "0000000") and !($range_bits == "1111111")) {
				$or_query = "";
				$or_count = 0;
				for ($i = 1; $i <= 7; $i++)
				{
					$range_bit[$i] = substr($range_bits, $i - 1, 1);
					if($range_bit[$i] == "1")
					{
						switch ($i)
						{
							case 1:
								$pr1 = 0;
								$pr2 = 499;
								break;
							case 2:
								$pr1 = 500;
								$pr2 = 999;
								break;
							case 3:
								$pr1 = 1000;
								$pr2 = 1999;
								break;
							case 4:
								$pr1 = 2000;
								$pr2 = 4999;
								break;
							case 5:
								$pr1 = 5000;
								$pr2 = 9999;
								break;
							case 6:
								$pr1 = 10000;
								$pr2 = 19999;
								break;
							case 7:
								$pr1 = 20000;
								$pr2 = 99999999;
								break;
								break;
						}
						$or_count++;
						if ($or_count == 1)
							$or_query = "((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
						else
							$or_query = $or_query . " OR ((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
					}
				}
				$this->db->where('(' . $or_query . ')');
			}
		}
		if ($sort_price == 1)
		{
			if ($type == 1)
			{
				$this->db->where('(selling_price-discount) = ', $last_price);
				$this->db->where('products.product_id >', $limit);
			}
			elseif ($type == 2)
			{
				$this->db->where('(selling_price-discount) > ', $last_price);
			}
			$this->db->order_by('(selling_price-discount)', 'ASC');
		}
		elseif ($sort_price == 2)
		{
			if ($type == 1)
			{
				$this->db->where('(selling_price-discount) = ', $last_price);
				$this->db->where('products.product_id >', $limit);
			}
			elseif ($type == 2)
			{
				$this->db->where('(selling_price-discount) < ', $last_price);
			}
			$this->db->order_by('(selling_price-discount)', 'DESC');
		}
		elseif ($sort_price == 0)
		{
			$this->db->where('products.product_id > ', $limit);
		}
		$this->db->order_by('products.product_id', 'ASC');
		$this->db->limit(6);
		$result = $this->db->get();
		log_message('INFO', 'Just Executed Query_____'.$this->db->last_query());
		log_message('INFO', 'Data returned:'.$result->result());
		log_message('INFO', 'exiting categoriesdb/catprodLoader from '.$this->input->ip_address());
		return $result->result();
	}


	function catstoreLoader($id, $limit)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->group_by('products.store_id');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where('cat_id', $id);
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$this->db->where('products.store_id <', $limit);
		$this->db->order_by('products.store_id', 'DESC');
		$this->db->limit(6);
		$result = $this->db->get();
		return $result->result();
	}

//Thejas
	function get_cat_tree($p_id, $c_type) //include only sub-categories who have products within them.
	{
		$this->db->select('*');
		$this->db->from('catagories c1');
		$this->db->where('parent_catagory_id = ' . $p_id);
		$this->db->where('exists(SELECT product_id FROM products WHERE sub_catid' . $c_type . ' = c1.category_id AND products.status = 1)');
		$this->db->order_by('parent_catagory_id', "asc");
		$this->db->order_by('category_id', "asc");
		$result = $this->db->get();
		return $result->result_array();
	}

	function get_cat_tree_2($p_id, $c_type, $price1 = 0, $price2 = 0) //include only sub-categories who have products within them.
	{
		$filter1 = 'SELECT products.product_id FROM products WHERE sub_catid' . $c_type . ' = c1.category_id AND products.status = 1';
		if (($price2 > 0) and ($price1 < $price2)) {
			$filter2 = ' and (selling_price-discount) between ' . $price1 . ' and ' . $price2;
			$this->db->select('*,(select count(*) from products where sub_catid' . $c_type . ' = c1.category_id ' . $filter2 . ' AND products.status = 1)as product_count');
		} else {
			$filter2 = '';
			$this->db->select('*,(select count(*) from products where sub_catid' . $c_type . ' = c1.category_id AND products.status = 1)as product_count');
		}
		$filter = $filter1 . $filter2;
		$this->db->from('catagories c1');
		$this->db->where('parent_catagory_id = ' . $p_id);
		$this->db->where('exists(' . $filter . ')');
		$this->db->order_by('parent_catagory_id', "asc");
		$this->db->order_by('category_id', "asc");
		$result = $this->db->get();
		return $result->result_array();
	}

	function get_occ_tree($occasion, $p_id, $c_type, $price1 = 0, $price2 = 0) //include only sub-categories who have products within them.
	{
		$filter1 = "SELECT products.product_id FROM products WHERE occasions like '%" . $occasion . "%' and ". "sub_catid" . $c_type . " = c1.category_id AND products.status = 1";
		if (($price2 > 0) and ($price1 < $price2)) {
			$filter2 = ' and (selling_price-discount) between ' . $price1 . ' and ' . $price2;
			$this->db->select('*,(select count(*) from products where occasions like \'%' . $occasion . '%\' and sub_catid' . $c_type . ' = c1.category_id ' . $filter2 . ' AND products.status = 1)as product_count');
		} else {
			$filter2 = '';
			$this->db->select('*,(select count(*) from products where occasions like \'%' . $occasion . '%\' and sub_catid' . $c_type . ' = c1.category_id AND products.status = 1)as product_count');
		}
		$filter = $filter1 . $filter2;
		$this->db->from('catagories c1');
		if ($p_id == 0)
			$this->db->where('parent_catagory_id between 1 and 10');
		else
			$this->db->where('parent_catagory_id = ' . $p_id);

		$this->db->where('exists(' . $filter . ')');
		$this->db->order_by('parent_catagory_id', "asc");
		$this->db->order_by('category_id', "asc");
		$result = $this->db->get();
		return $result->result_array();
	}


	function get_cat_tree_3($p_id, $c_type) //include only sub-categories who have products within them.
	{
		$this->db->select('*,(select count(distinct(store_id)) from products where sub_catid' . $c_type . ' = c1.category_id AND products.status = 1 )as store_count');
		$this->db->from('catagories c1');
		$this->db->where('parent_catagory_id = ' . $p_id);
		$this->db->where('exists(SELECT products.product_id FROM products WHERE sub_catid' . $c_type . ' = c1.category_id AND products.status = 1)');
		$this->db->order_by('parent_catagory_id', "asc");
		$this->db->order_by('category_id', "asc");
		$result = $this->db->get();
		return $result->result_array();
	}

	function get_sub_prod($cat_id, $sssc_id, $c_type, $price1 = 0, $price2 = 0, $sort_price = 0, $range_bits = "", $occasions) //(tree products)Load all product details within sub/sub/sub-category.
	{
		log_message('INFO', 'inside categoriesdb/get_sub_prod');
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		if ($cat_id > 0)
			$this->db->where('cat_id', $cat_id);
		else
			$this->db->where('sub_catid' . $c_type, $sssc_id);
		if (($price2 > 0) and ($price1 < $price2))
			$this->db->where('(products.selling_price-products.discount) between ' . $price1 . ' and ' . $price2);
		else {
			$or_query = "";
			$or_count = 0;
			for ($i = 0; $i < count($occasions); $i++)
			{
				$or_count++;
				if ($or_count == 1)
				{
					$or_query = "(products.occasions like '%" . $occasions[$i] . "%')";
				}
				else
				{
					$or_query = $or_query . " OR (products.occasions like '%" . $occasions[$i] . "%')";
				}
			}
			//$this->db->where('(' . $or_query . ')');
			$this->db->where($or_query);
			if (!($range_bits == "0000000") and !($range_bits == "1111111")) {
				$or_query = "";
				$or_count = 0;
				for ($i = 1; $i <= 7; $i++) {
					$range_bit[$i] = substr($range_bits, $i - 1, 1);
					if ($range_bit[$i] == "1") {
						switch ($i) {
							case 1:
								$pr1 = 0;
								$pr2 = 499;
								break;
							case 2:
								$pr1 = 500;
								$pr2 = 999;
								break;
							case 3:
								$pr1 = 1000;
								$pr2 = 1999;
								break;
							case 4:
								$pr1 = 2000;
								$pr2 = 4999;
								break;
							case 5:
								$pr1 = 5000;
								$pr2 = 9999;
								break;
							case 6:
								$pr1 = 10000;
								$pr2 = 19999;
								break;
							case 7:
								$pr1 = 20000;
								$pr2 = 99999999;
								break;
								break;
						}
						$or_count++;
						if ($or_count == 1)
							$or_query = "((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
						else
							$or_query = $or_query . " OR ((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
					}
				}
				//$this->db->where('(' . $or_query . ')');
				$this->db->where($or_query);
			}
		}

		if ($sort_price == 1)
			$this->db->order_by('(selling_price-discount)', 'ASC');
		elseif ($sort_price == 2)
			$this->db->order_by('(selling_price-discount)', 'DESC');

		$this->db->order_by('added_on', 'DESC');
		//$this->db->limit(150);
		log_message('INFO','GOING TO RUN THE FOLLOWING QUERY__________________________________________________________'.$this->db->nextQuery());
		$result = $this->db->get();
		log_message('INFO','JUST RAN THE FOLLOWING QUERY__________________________________________________________'.$this->db->last_query());
		return $result->result();
	}

	function get_prod_occ($occasion, $price1 = 0, $price2 = 0, $sort_price = 0, $range_bits = "", $sssc_id, $sssc_type) //(tree products)Load all product details within sub/sub/sub-category.
	{
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		
		if ($sssc_type > 0)
			$this->db->where('sub_catid' . $sssc_type, $sssc_id);

		$this->db->like('occasions', $occasion);
		if (($price2 > 0) and ($price1 < $price2))
			$this->db->where('(products.selling_price-products.discount) between ' . $price1 . ' and ' . $price2);
		else {
			if (!($range_bits == "0000000") and !($range_bits == "1111111")) {
				$or_query = "";
				$or_count = 0;
				for ($i = 1; $i <= 7; $i++) {
					$range_bit[$i] = substr($range_bits, $i - 1, 1);
					if ($range_bit[$i] == "1") {
						switch ($i) {
							case 1:
								$pr1 = 0;
								$pr2 = 499;
								break;
							case 2:
								$pr1 = 500;
								$pr2 = 999;
								break;
							case 3:
								$pr1 = 1000;
								$pr2 = 1999;
								break;
							case 4:
								$pr1 = 2000;
								$pr2 = 4999;
								break;
							case 5:
								$pr1 = 5000;
								$pr2 = 9999;
								break;
							case 6:
								$pr1 = 10000;
								$pr2 = 19999;
								break;
							case 7:
								$pr1 = 20000;
								$pr2 = 99999999;
								break;
								break;
						}
						$or_count++;
						if ($or_count == 1)
							$or_query = "((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
						else
							$or_query = $or_query . " OR ((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
					}
				}
				$this->db->where('(' . $or_query . ')');
			}
		}

		if ($sort_price == 1)
			$this->db->order_by('(selling_price-discount)', 'ASC');
		elseif ($sort_price == 2)
			$this->db->order_by('(selling_price-discount)', 'DESC');

		$this->db->order_by('products.product_id', 'ASC');

		$this->db->limit(9);
		$result = $this->db->get();
		return $result->result();
	}

	function occprodLoader($type, $occasion, $sort_price, $last_pid, $last_price, $price1, $price2, $range_bits = "", $sssc_id, $sssc_type)
	{
		//$strname = $temp;
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		
		if ($sssc_type > 0)
			$this->db->where('sub_catid' . $sssc_type, $sssc_id);

		$this->db->like('occasions', $occasion);

		if (($price2 > 0) and ($price1 < $price2))
			$this->db->where('(products.selling_price-products.discount) between ' . $price1 . ' and ' . $price2);
		else {
			if (!($range_bits == "0000000") and !($range_bits == "1111111")) {
				$or_query = "";
				$or_count = 0;
				for ($i = 1; $i <= 7; $i++) {
					$range_bit[$i] = substr($range_bits, $i - 1, 1);
					if ($range_bit[$i] == "1") {
						switch ($i) {
							case 1:
								$pr1 = 0;
								$pr2 = 499;
								break;
							case 2:
								$pr1 = 500;
								$pr2 = 999;
								break;
							case 3:
								$pr1 = 1000;
								$pr2 = 1999;
								break;
							case 4:
								$pr1 = 2000;
								$pr2 = 4999;
								break;
							case 5:
								$pr1 = 5000;
								$pr2 = 9999;
								break;
							case 6:
								$pr1 = 10000;
								$pr2 = 19999;
								break;
							case 7:
								$pr1 = 20000;
								$pr2 = 99999999;
								break;
								break;
						}
						$or_count++;
						if ($or_count == 1)
							$or_query = "((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
						else
							$or_query = $or_query . " OR ((products.selling_price-products.discount) between " . $pr1 . " and " . $pr2 . ")";
					}
				}
				$this->db->where('(' . $or_query . ')');
			}
		}

		if ($sort_price == 1) {
			if ($type == 1) {
				$this->db->where('(selling_price-discount)=' . $last_price);
				$this->db->where('products.product_id >', $last_pid);
			} elseif ($type == 2) {
				$this->db->where('(selling_price-discount)>' . $last_price);
				$this->db->order_by('(selling_price-discount)', 'ASC');
			}
		} elseif ($sort_price == 2) {
			if ($type == 1) {
				$this->db->where('(selling_price-discount)=' . $last_price);
				$this->db->where('products.product_id >', $last_pid);
			} elseif ($type == 2) {
				$this->db->where('(selling_price-discount)<' . $last_price);
				$this->db->order_by('(selling_price-discount)', 'DESC');
			}
		} elseif ($sort_price == 0) {
			$this->db->where('products.product_id >', $last_pid);
		}

		$this->db->order_by('products.product_id', 'ASC');
		$this->db->limit(6);
		$result = $this->db->get();
		return $result->result();
	}

	function get_sub_stores($sssc_id, $c_type) //Load all store details within sub/sub/sub-category.
	{
		$this->db->select('store_info.store_id ,store_info.store_name , store_info.fancy_counter , store_info.brag_counter , products.cat_id');
		$this->db->from('products');
		$this->db->join('store_info', 'store_info.store_id = products.store_id');
		$this->db->where('sub_catid' . $c_type, $sssc_id);
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$this->db->group_by('products.store_id');
		$this->db->order_by('store_info.visit_counter + store_info.fancy_counter', "desc");
		//$this->db->limit(6);		
		$result = $this->db->get();
		return $result->result();
	}

	function sub_catstoreprod($sssc_id, $sssc_type, $st_id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$this->db->where('sub_catid' . $sssc_type, $sssc_id);
		$this->db->where('store_id', $st_id);
		$result = $this->db->get();
		return $result->result();
	}

//END Thejas	
	function fancy_prods($uid)
	{
		$this->db->select('DISTINCT(fancy_products.product_id)');
		$this->db->from('fancy_products');
		$this->db->join('products', 'fancy_products.product_id = products.product_id');
		$this->db->where('fancy_products.user_id', $uid);
		$this->db->where('products.status', 1); // pick only those products whose store are enabled
		$this->db->order_by('fancy_products.time', 'desc');
		$result = $this->db->get();
		return $result->result();
	}

	function header_sale()
	{
		$this->db->select('category , category_name');
		$this->db->from('sale');
		$this->db->join('catagories', 'catagories.category_id = sale.category');
		$result = $this->db->get();
		return $result->result();
	}

	function header_sale_product($id)
	{
		$this->db->select('products.store_id , products.product_id , products.discount , products.selling_price ');
		$this->db->from('products');
		//$this->db->join('products', 'products.store_id = store_info.store_id');
		$this->db->where('products.is_on_discount', 1);
		$this->db->where('(products.cat_id = ' . $id . ' or products.sub_catid1=' . $id . ' or products.sub_catid2=' . $id . ' or products.sub_catid3=' . $id . ')');
		$this->db->order_by('products.discount', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get();
		return $result->result();
	}

	function cat_occasions($id)
	{
		$this->db->select('occ_id,occasion');
		$this->db->from('occasions,products');
		$this->db->where("products.occasions like concat('%',occasions.occasion,'%')");
		$this->db->where("products.cat_id", $id);
		$this->db->where('products.status', 1); // pick only those products whose store is enabled
		$this->db->group_by('occasion');
		$result = $this->db->get();
		return $result->result();
	}

}
?>
