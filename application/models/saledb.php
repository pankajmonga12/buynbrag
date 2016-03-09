<?php

class Saledb extends CI_Model
{


	function sale_cat($id)
	{
		$this->db->select('category , category_name');
		$this->db->from('sale');
		$this->db->join('catagories', 'catagories.category_id = sale.category');
		$this->db->where('category', $id);
		$result = $this->db->get();
		return $result->result();
	}

	function sale_product($id, $price1 = 0, $price2 = 0, $sort_price = 0)
	{
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'products.store_id = store_info.store_id');
		if (($price2 > 0) and ($price1 < $price2))
			$this->db->where('(products.selling_price-products.discount) between ' . $price1 . ' and ' . $price2);

		$this->db->where('products.is_on_discount', 1);
		$this->db->where('(products.cat_id = ' . $id . ' or products.sub_catid1=' . $id . ' or products.sub_catid2=' . $id . ' or products.sub_catid3=' . $id . ')');

		if ($sort_price == 1)
			$this->db->order_by('(selling_price-discount)', 'ASC');
		elseif ($sort_price == 2)
			$this->db->order_by('(selling_price-discount)', 'DESC'); else
			$this->db->order_by('floor(discount/selling_price*100)', 'DESC');

		$this->db->order_by('product_id', 'ASC');

		$this->db->limit(9);
		$result = $this->db->get();
		return $result->result();
	}

	function get_prod_sales($sale_id, $price1 = 0, $price2 = 0, $sort_price = 0, $range_bits = "") //(tree products)Load all product details within sub/sub/sub-category.
	{
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');

		$this->db->where('products.is_on_discount', 1);

		$this->db->where('(products.cat_id = ' . $sale_id . ' or products.sub_catid1=' . $sale_id . ' or products.sub_catid2=' . $sale_id . ' or products.sub_catid3=' . $sale_id . ')');

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
			$this->db->order_by('(selling_price-discount)', 'DESC'); else
			$this->db->order_by('floor(discount/selling_price*100)', 'DESC');

		$this->db->order_by('product_id', 'ASC');

		$this->db->limit(9);
		$result = $this->db->get();
		return $result->result();
	}

	function saleprodLoader($type, $sale_id, $sort_price, $last_perc, $last_pid, $last_price, $price1, $price2, $range_bits = "")
	{
		//$strname = $temp;
		$this->db->select('*');
		$this->db->from('store_info');
		$this->db->join('products', 'store_info.store_id = products.store_id');

		$this->db->where('products.is_on_discount', 1);

		$this->db->where('(products.cat_id = ' . $sale_id . ' or products.sub_catid1=' . $sale_id . ' or products.sub_catid2=' . $sale_id . ' or products.sub_catid3=' . $sale_id . ')');

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
			if ($type == 1) {
				$this->db->where('floor(discount/selling_price*100)=' . $last_perc);
				$this->db->where('products.product_id >', $last_pid);
			} elseif ($type == 2) {
				$this->db->where('floor(discount/selling_price*100)<' . $last_perc);
				$this->db->order_by('floor(discount/selling_price*100)', 'DESC');
			}
		}

		$this->db->order_by('product_id', 'ASC');
		$this->db->limit(6);
		$result = $this->db->get();
		return $result->result();
	}

}

?>