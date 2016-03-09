<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Promote_discount extends CI_Model
{

	//fetch store & owner information
	function shopSectionCatlist($store_id)
	{
		$this->db->select('*');
		$this->db->from('store_section');
		$this->db->order_by('store_id', "asc");
		$this->db->where('store_id', $store_id);
		$result = $this->db->get();
		return $result->result();
	}

	function save($store_id)
	{
		//$strname = $temp;
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('orders', 'products.product_id = orders.product_id');
		$this->db->order_by('order_id', 'DESC');
		$this->db->where('products.store_id', $store_id);
		$this->db->limit(10);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function myproducts($store_id, $typeID)
	{
		$this->db->select('*,`products`.`store_id` as mystoreid,products.status as pro_status');
		$this->db->from('products');
		$this->db->join('store_section', 'store_section.storesection_id = products.storesection_id', 'left');
		$this->db->order_by('product_id', 'DESC');
		$this->db->where('products.store_id', $store_id);
		if ($typeID != "")
			$this->db->where('store_section.storesection_id', $typeID);
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}

	function addPromoteDiscount($data_discount_offer, $imageArray, $catArray, $promo_type, $promo_val)
	{
		$this->load->database();
		$this->db->insert('promotion', $data_discount_offer);
		$newInsertId = $this->db->insert_id();

		$addPromotionId = array(
			'is_on_discount' => 1,
			'promotion_id' => $newInsertId,

		);

		$total_items = count($imageArray);
		if ($total_items > 0) {
			for ($j = 1; $j <= $total_items; $j++) {
				$this->db->where('product_id', $imageArray[$j]);
				$this->db->update('products', $addPromotionId);

				if ($promo_type == 0) {
					$sql = "UPDATE products SET discount=selling_price*(" . $promo_val . "/100) where product_id=" . $imageArray[$j];
				} else {
					$sql = "UPDATE products SET discount=" . $promo_val . " where product_id=" . $imageArray[$j];
				}
				$this->db->query($sql);


			}
		}

		$total_cat = count($catArray);
		if ($total_cat > 0) {
			for ($k = 1; $k <= $total_cat; $k++) {
				$this->db->where('storesection_id', $catArray[$k]);
				$this->db->update('store_section', $addPromotionId);
				{
					if ($promo_type == 0) {
						$sql = "UPDATE products SET is_on_discount=1,promotion_id=" . $newInsertId . ",discount=selling_price*(" . $promo_val . "/100) where storesection_id=" . $catArray[$k] . " ";
					} else {
						$sql = "UPDATE products SET is_on_discount=1,promotion_id=" . $newInsertId . ",discount=" . $promo_val . " where storesection_id=" . $catArray[$k];
					}
					$this->db->query($sql);
				}
			}
		}

		echo $this->db->last_query();
	}
}

?>