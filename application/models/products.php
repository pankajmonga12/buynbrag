<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class products extends CI_Model
{
	function myproducts($store_id, $sort = NULL, $sortBy = NULL)
	{
		$this->db->select('*,products.status as pro_status');
		$this->db->select("(SELECT COUNT(orders.order_id) FROM orders WHERE orders.product_id = products.product_id) AS totalSold", FALSE);
		$this->db->select("(SELECT COUNT(orders.order_id) FROM orders WHERE orders.product_id = products.product_id AND status_order = 4) AS totalComplete", FALSE);
		$this->db->from('products');
		$this->db->join('catagories', 'catagories.category_id = products.cat_id', 'left');
		$this->db->where('products.store_id', $store_id);
		if($sortBy == 1)
		{
			if($sort == 1)
			{
				$this->db->order_by('fancy_counter', 'ASC');
			}
			elseif($sort == -1)
			{
				$this->db->order_by('fancy_counter', 'DESC');
			}
			else
			{
				$this->db->order_by('product_id', 'DESC');
			}
		}
		elseif($sortBy == 2)
		{
			if($sort == 1)
			{
				$this->db->order_by('totalSold', 'ASC');
			}
			elseif($sort == -1)
			{
				$this->db->order_by('totalSold', 'DESC');
			}
			else
			{
				$this->db->order_by('product_id', 'DESC');
			}
		}
		else
		{
			$this->db->order_by('product_id', 'DESC');
		}
		// $this->db->limit(10);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function mySearchProduct($status, $pro, $s_id)
	{

		$this->db->select('*,products.status as pro_status');
		$this->db->from('products');
		$this->db->join('catagories', 'catagories.category_id = products.cat_id', 'left');

        if ($status != 0)
        {
            $this->db->like('products.product_name', $pro);

            if ($status == 1) // on-sale tab
            {
                $this->db->where('products.status', 1);
                $this->db->where('products.is_enable', 0);
            }
            elseif ($status == 2) // sold-out tab
            {
                $this->db->where('products.quantity < 1');
            }
            elseif ($status == 3) // disabled tab
            {
                $this->db->where('products.status', 0);
                $this->db->where('products.is_enable', 1);
            }
        }
        else
        {
            $this->db->like('products.product_name', $pro);
        }

//		if ($status != 0)
//		{
//			$this->db->like('products.product_name', $pro);
//			$this->db->where('products.status', ($status - 1));
//		}
//		else
//		{
//			$this->db->like('products.product_name', $pro);
//		}
		
		$this->db->where('products.store_id', $s_id);
		$this->db->order_by('product_id', 'DESC');
		
		//$this->db->limit(10);
		$result = $this->db->get();
		log_message("INFO", "LAST QUERY = \r\n".$this->db->last_query());
		
		$retVal = $result->result();
		log_message("INFO", "LAST QUERY RESULT (which is being returned) = \r\n".print_r($retVal, TRUE));
		return $retVal;
	}

	function myProductsAjax($status, $s_id)
	{

		$this->db->select('*,products.status as pro_status');
		$this->db->from('products');
		$this->db->join('catagories', 'catagories.category_id = products.cat_id', 'left');
		if ($status != 0)
		{
			if ($status == 1)
				$this->db->where('products.quantity >', (0));
			elseif ($status == 2)
				$this->db->where('products.quantity <', (1));
		}
		$this->db->where('products.store_id', $s_id);
		$this->db->order_by('product_id', 'DESC');
		//$this->db->limit(10);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	/*
	added by SHAMMI SHAILAJ as an improvised version of products/myProductsAjax
	Currently being used by dashboard/productsAjax
	*/

	function myProductsAjax2($status, $s_id)
	{

		$this->db->select('products.product_id');
		$this->db->select('products.store_id');
		$this->db->select('products.product_name');
		$this->db->select('products.bnb_product_code');
		$this->db->select('products.quantity');
		$this->db->select('products.selling_price');
		$this->db->select('products.is_enable');
		$this->db->select('products.status AS pro_status');
		$this->db->select('catagories.category_name');
		$this->db->from('products');
		$this->db->join('catagories', 'catagories.category_id = products.cat_id', 'left');

		if ($status != 0)
		{
			if ($status == 1) // on-sale tab
			{
				$this->db->where('products.status', 1);
				$this->db->where('products.is_enable', 0);
			}
			elseif ($status == 2) // sold-out tab
			{
				$this->db->where('products.quantity < 1');
			}
			elseif ($status == 3) // disabled tab
			{
				$this->db->where('products.status', 0);
				$this->db->where('products.is_enable', 1);
			}
		}

		$this->db->where('products.store_id', $s_id);
		$this->db->order_by('product_id', 'DESC');
		//$this->db->limit(10);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	/* END SECTION added by SHAMMI SHAILAJ as an improvised version of products/myProductsAjax */

	function myProductsAjaxLoad($status, $limit, $pro, $s_id)
	{

		$this->db->select('*,products.status as pro_status');
		$this->db->from('products');
		$this->db->join('catagories', 'catagories.category_id = products.cat_id', 'left');
		if ($status != 0) {
			$this->db->where('products.status', ($status - 1));
		}
		$this->db->like('products.product_name', $pro);
		$this->db->where('products.product_id <', $limit);
		$this->db->where('products.store_id', $s_id);
		$this->db->order_by('product_id', 'DESC');
		//$this->db->limit(5);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function productMainCat($parentCatId)
	{
		$this->db->select('*');
		$this->db->from('catagories');
		$this->db->where('parent_catagory_id', $parentCatId);
		$result = $this->db->get();
		return $result->result();
	}

	function productCat($catId)
	{
		$this->db->select('*');
		$this->db->from('catagories');
		$this->db->where('category_id', $catId);
		$result = $this->db->get();
		return $result->result();
	}


	function shopSectionCat($get_store_id)
	{
		$this->db->select('*');
		$this->db->from('store_section');
		$this->db->where('store_id', $get_store_id);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function addProduct($data)
	{
		$this->load->database();
		$this->db->insert('products', $data);
		return $this->db->last_query();
	}

	function deleteProduct($id)
	{
		$this->db->where('product_id', $id);
		$this->db->delete('products');
	}

	function editProduct($data, $p_id)
	{
		$this->db->where('product_id', $p_id);
		$this->db->update('products', $data);
		switch($p_id > 4499)
		{
			case TRUE: $pNewData = array(
						'store_id' => $data['store_id'],
						'cat_id' => $data['cat_id'],
						'sub_catid1' => $data['sub_catid1'],
						'sub_catid2' => $data['sub_catid2'],
						'sub_catid3' => $data['sub_catid3'],
						'product_name' => $data['product_name'],
						'bnb_product_code' => $data['bnb_product_code'],
						'storesection_id' => $data['storesection_id'],
						'prd_act_weight' => $data['prd_act_weight'],
						'prd_vol_weight' => $data['prd_vol_weight'],
						'shipping_mode' => $data['shipping_mode'],
						'seller_earnings' => $data['seller_earnings'],
						'bnb_commission' => $data['bnb_commission'],
						'tax_rate' => $data['tax_rate'],
						'insurance_cost' => $data['insurance_cost'],
						'shipping_cost' => $data['shipping_cost'],
						'selling_price' => $data['selling_price'],
						'discount' => $data['discount_price'],
						'is_on_discount' => $data['is_on_discount'],
						'shipping_partner' => $data['shipping_partner_id'],
						'quantity' => $data['quantity'],
						'processing_time' => $data['order_processing'],
						'status' => 0,
						'is_enable' => $data['is_enable'],
						'added_on' => date("Y-m-d")
					);

					$this->db->where('product_id', $p_id);
					$this->db->update('productsNew', $data);

					$pDescData = array(
						'description' => $data['description'],
						'occasions' => $data['occasions'],
						'style' => $data['style'],
						'tags' => $data['tags']
					);
					$this->db->where('refProductID', $p_id);
					$this->db->update('pDesc', $data);
				break;
		}
	}

	function productdetails($p_id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('products.product_id', $p_id);
		$result = $this->db->get();
		return $result->result();
	}

	function addVariant($data)
	{
		$this->load->database();
		$this->db->insert('variant', $data);

	}

	function editVariant($vid, $v_name, $v_color, $v_size, $v_qty)
	{
		$this->db->set('variant_name', $v_name);
		$this->db->set('quantity', $v_qty);
		$this->db->set('size', $v_size);
		$this->db->set('color', $v_color);
		$this->db->where('variant_id', $vid);
		$this->db->update('variant');
		return 1;
	}

	function deleteVariant($vid)
	{
		$this->db->where('variant_id', $vid);
		$this->db->delete('variant');
		return 1;
	}

	function addNewVariant($pid)
	{
		$this->db->query('insert into variant(product_id) values(' . $pid . ')');
		return 1;
	}

	function deleteMyPreviouVariant($p_id)
	{
		$this->db->where('product_id', $p_id)
			->delete('variant');
	}

	function variantdetails($p_id)
	{
		$this->db->select('*');
		$this->db->from('variant');
		$this->db->where('variant.product_id', $p_id);
		$result = $this->db->get();
		return $result->result();
	}

	function getLastRow()
	{
		return $this->db->insert_id();
	}

	function changeStatus($p_id, $status, $quantity)
	{
		$status = ($status == 1)? 0: 1; // change the status from 1 to 0 and 0 to 1 as that is the way the value of is_enable works in the DB
		$storeStatus = ($status == 0)? 1: 0; // depending upon the status of the product, switch the store on or off. A store is automatically
		// switched on when a product is from that store is switched-on. While switching-off we will be checking if there are no products enabled,
		// then the store is switched-off, else, not.

		// compute the store id
		$storeID = NULL;
		$this->db->select('store_id');
		$this->db->from('products');
		$this->db->where('product_id', $p_id);
		$storeIDQuery = $this->db->get();
		switch($storeIDQuery->num_rows() > 0)
		{
			case TRUE: $storeID = $storeIDQuery->result();
						$storeID = $storeID[0]->store_id;
				break;
		}

		if ($quantity == -1)
		{
			$data = array('is_enable' => $status, 'status' => $storeStatus);
		}
		else
		{
			$data = array('is_enable' => $status, 'status' => $storeStatus, 'quantity' => $quantity);
		}
		$this->db->where('product_id', $p_id);
		$this->db->update('products', $data);

		if($storeStatus == 1)
		{
			if(!is_null($storeID))
			{
				$this->db->set('isPublished', 1);
				$this->db->where('store_id', $storeID);
				$this->db->update('store_info');
			}
		}
		else // when $storeStatus = 0, check the no of products enabled if the total number is greater than zero, then enable the store.
		{
			if(!is_null($storeID))
			{
				$this->db->select('COUNT(product_id) AS storeProductsCount');
				$this->db->from('products');
				$this->db->where('store_id', $storeID);
				$this->db->where('is_enable', 0);
				$this->db->where('status', 1);
				$pCountQuery = $this->db->get();
				switch($pCountQuery->num_rows() > 0)
				{
					case TRUE: $pCount = $pCountQuery->result();
								$pCount = $pCount[0]->storeProductsCount;
								switch($pCount == 0)
								{
									case TRUE: $this->db->set('isPublished', 0);
												$this->db->where('store_id', $storeID);
												$this->db->update('store_info');
										break;
								}
						break;
				}
			}
		}
	}

	protected function enableStore($storeID)
	{
		$this->db->set('isPublished', 1);
		$this->db->where('store_id', $storeID);
		return $this->db->update('store_info');
	}

	protected function disableStore($storeID)
	{
		$this->db->set('isPublished', 0);
		$this->db->where('store_id', $storeID);
		return $this->db->update('store_info');
	}

	function enableProduct($productID)
	{
		log_message('INFO', 'products/enableProduct fired from '.$this->input->ip_address().' with productID = '.$productID);
		log_message('INFO', 'products/enableProduct '.$this->input->ip_address().' finding storeID for product '.$productID);
		// compute the store id
		$storeID = NULL;
		$this->db->select('store_id');
		$this->db->from('products');
		$this->db->where('product_id', $productID);
		$storeIDQuery = $this->db->get();
		switch($storeIDQuery->num_rows() > 0)
		{
			case TRUE: $storeID = $storeIDQuery->result();
						$storeID = $storeID[0]->store_id;
				break;
		}
		log_message('INFO', 'products/enableProduct '.$this->input->ip_address().' storeID = '.$storeID.' for product'.$productID);

		$this->db->set('status', 1);
		$this->db->set('is_enable', 0);
		$this->db->where('product_id', $productID);
		$retVal = $productsTableStatus = $this->db->update('products');
		log_message('INFO', 'products/enableProduct '.$this->input->ip_address().' product '.$productID.' enabled = '.json_encode($productsTableStatus));
		switch($productID > 4499)
		{
			case TRUE: log_message('INFO', 'products/enableProduct '.$this->input->ip_address().' productID = '.$productID.' is > 4499. Changing status of productsNew table');
						$this->db->set('status', 1);
						$this->db->set('is_enable', 0);
						$this->db->where('product_id', $productID);
						$productsNewTableStatus = $this->db->update('productsNew');

						$retVal = $productsNewTableStatus && $productsTableStatus;
				break;
		}
		
		log_message('INFO', 'products/enableProduct '.$this->input->ip_address().' enabling store '.$storeID.' just to be sure!');
		$this->enableStore($storeID);
		log_message('INFO', 'products/enableProduct '.$this->input->ip_address().' enabling store '.$storeID.' result = '.json_encode($storeID));

		return $retVal;
	}

	public function disableProduct($productID)
	{
		log_message('INFO', 'products/disableProduct fired from '.$this->input->ip_address().' with productID = '.$productID);
		log_message('INFO', 'products/disableProduct '.$this->input->ip_address().' finding storeID for product '.$productID);
		// compute the store id
		$storeID = NULL;
		$this->db->select('store_id');
		$this->db->from('products');
		$this->db->where('product_id', $productID);
		$storeIDQuery = $this->db->get();
		switch($storeIDQuery->num_rows() > 0)
		{
			case TRUE: $storeID = $storeIDQuery->result();
						$storeID = $storeID[0]->store_id;
				break;
		}
		log_message('INFO', 'products/disableProduct '.$this->input->ip_address().' storeID = '.$storeID.' for product'.$productID);

		$this->db->set('status', 0);
		$this->db->set('is_enable', 1);
		$this->db->where('product_id', $productID);
		$retVal = $productsTableStatus = $this->db->update('products');
		log_message('INFO', 'products/disableProduct '.$this->input->ip_address().' product '.$productID.' enabled = '.json_encode($productsTableStatus));
		switch($productID > 4499)
		{
			case TRUE: log_message('INFO', 'products/disableProduct '.$this->input->ip_address().' productID = '.$productID.' is > 4499. Changing status of productsNew table');
						$this->db->set('status', 0);
						$this->db->set('is_enable', 1);
						$this->db->where('product_id', $productID);
						$productsNewTableStatus = $this->db->update('productsNew');

						$retVal = $productsNewTableStatus && $productsTableStatus;
				break;
		}
		
		log_message('INFO', 'products/disableProduct '.$this->input->ip_address().' checking if the store '.$storeID.' needs to be disabled just to be sure!');
		$this->db->select('COUNT(product_id) AS storeProductsCount');
		$this->db->from('products');
		$this->db->where('store_id', $storeID);
		$this->db->where('is_enable', 0);
		$this->db->where('status', 1);
		$pCountQuery = $this->db->get();
		switch($pCountQuery->num_rows() > 0)
		{
			case TRUE: $pCount = $pCountQuery->result();
						$pCount = $pCount[0]->storeProductsCount;
						switch($pCount == 0)
						{
							case TRUE: log_message('INFO', 'products/disableProduct '.$this->input->ip_address().' disabling store '.$storeID.' just to be sure!');
										$storeDisableQuery = $this->disableStore($storeID);
										log_message('INFO', 'products/disableProduct '.$this->input->ip_address().' disabling store '.$storeID.' result = '.json_encode($storeDisableQuery));
								break;
						}
				break;
		}

		/* new code to delete the product's cache of product page and qv data */
		$cacheVariableName1 = "qvData__".$productID;
		$cacheVariableName2 = "productPageData__".$productID;
		$this->load->driver('cache');
		
		$this->cache->memcached->delete($cacheVariableName1);
		$this->cache->memcached->delete($cacheVariableName2);

		return $retVal;
	}

	public function changeQuantity($productID, $quantity)
	{
		$retVal = array();
		$retVal['changed'] = FALSE;
		switch($productID > 4499)
		{
			case TRUE: $this->db->set('quantity', $quantity);
						$this->db->where('product_id', $productID);
						$r1 = $this->db->update('products');
						log_message('INFO', 'result of updation of quantity = '.$quantity.' for product_id = '.$productID.' in products table is '.json_encode($r1));
						$this->db->set('quantity', $quantity);
						$this->db->where('product_id', $productID);
						$r2 = $this->db->update('productsNew');
						log_message('INFO', 'result of updation of quantity = '.$quantity.' for product_id = '.$productID.' productsNew table is '.json_encode($r2));
						$retVal['changed'] = $r1 && $r2;
				break;
			case FALSE: $this->db->set('quantity', $quantity);
						$this->db->where('product_id', $productID);
						$retVal['changed'] = $this->db->update('products');
						log_message('INFO', 'result of updation of quantity = '.$quantity.' for product_id = '.$productID.' in products is '.json_encode($r1));
				break;
		}
		return $retVal;
	}
}

?>