<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Promotion extends CI_Model
{

	function getAllPromotions($s_id)
	{
		$query = "SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where promotion.discount_on_type=0 AND store_info.is_on_discount=1 AND store_info.store_id=" . $s_id . "
                  UNION 
                  SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where promotion.discount_on_type=1 AND products.is_on_discount=1 AND products.store_id=" . $s_id . "
					 UNION 
                   SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where promotion.discount_on_type=2 AND store_section.is_on_discount=1 AND store_section.store_id=" . $s_id . " ";


		$sql = $this->db->query("select * from (" . $query . ") as unionTable order by id DESC limit 9");
		return $sql->result();
	}


	function myPromotionAjax($status, $s_id)
	{
		$query = "";
		if ($status != 0) {
			$query = "SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where promotion.discount_on_type=0 AND store_info.is_on_discount=1 AND store_info.store_id=" . $s_id . "  AND promotion.promotion_type=" . ($status - 1) . "
                  UNION 
                   SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where promotion.discount_on_type=1 AND products.is_on_discount=1 AND products.store_id=" . $s_id . " AND promotion.promotion_type=" . ($status - 1) . "
					 UNION 
                   SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where promotion.discount_on_type=2 AND store_section.is_on_discount=1 AND store_section.store_id=" . $s_id . " AND promotion.promotion_type=" . ($status - 1) . "";


		} else {
			$query = "SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where promotion.discount_on_type=0 AND store_info.is_on_discount=1 AND store_info.store_id=" . $s_id . "
                  UNION 
                   SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where promotion.discount_on_type=1 AND products.is_on_discount=1 AND products.store_id=" . $s_id . "
					 UNION 
                   SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where promotion.discount_on_type=2 AND store_section.is_on_discount=1 AND store_section.store_id=" . $s_id . "";

		}

		$sql = $this->db->query("select * from (" . $query . ") as unionTable order by id DESC limit 9");
		return $sql->result();
	}

	function myPromotionSearchAjax($status, $s_id, $s_val)
	{
		$query = "";
		if ($status != 0) {
			$query = "SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where promotion.discount_on_type=0 AND store_info.is_on_discount=1 AND store_info.store_id=" . $s_id . "  AND promotion.promotion_type=" . ($status - 1) . " AND store_info.store_name LIKE '%" . $s_val . "%'
                  UNION 
                   SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where promotion.discount_on_type=1 AND products.is_on_discount=1 AND products.store_id=" . $s_id . " AND promotion.promotion_type=" . ($status - 1) . " AND products.product_name LIKE '%" . $s_val . "%'
					 UNION 
                   SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where promotion.discount_on_type=2 AND store_section.is_on_discount=1 AND store_section.store_id=" . $s_id . " AND promotion.promotion_type=" . ($status - 1) . " AND store_section.name LIKE '%" . $s_val . "%'";


		} else {
			$query = "SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where promotion.discount_on_type=0 AND store_info.is_on_discount=1 AND store_info.store_id=" . $s_id . "  AND store_info.store_name LIKE '%" . $s_val . "%'
                  UNION 
                   SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where promotion.discount_on_type=1 AND products.is_on_discount=1 AND products.store_id=" . $s_id . " AND products.product_name LIKE '%" . $s_val . "%'
					 UNION 
                  SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where promotion.discount_on_type=2 AND store_section.is_on_discount=1 AND store_section.store_id=" . $s_id . " AND store_section.name LIKE '%" . $s_val . "%'";

		}


		$sql = $this->db->query("select * from (" . $query . ") as unionTable order by id DESC limit 9");
		return $sql->result();
	}

	function myPromoteAjaxLoad($status, $s_id, $s_val, $limit)
	{
		$query = "";
		if ($status != 0) {
			$query = "SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where  promotion.discount_on_type=0 AND promotion.id <" . $limit . " AND store_info.is_on_discount=1 AND store_info.store_id=" . $s_id . "  AND promotion.promotion_type=" . ($status - 1) . " AND store_info.store_name LIKE '%" . $s_val . "%'

                  UNION 
                   SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where promotion.discount_on_type=1 AND promotion.id <" . $limit . " AND products.is_on_discount=1 AND products.store_id=" . $s_id . " AND promotion.promotion_type=" . ($status - 1) . " AND products.product_name LIKE '%" . $s_val . "%'
					 UNION 
                   SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where promotion.discount_on_type=2 AND promotion.id <" . $limit . " AND store_section.is_on_discount=1 AND store_section.store_id=" . $s_id . " AND promotion.promotion_type=" . ($status - 1) . " AND store_section.name LIKE '%" . $s_val . "%'";


		} else {
			$query = "SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where  promotion.discount_on_type=0 AND promotion.id <" . $limit . " AND store_info.is_on_discount=1 AND store_info.store_id=" . $s_id . "  AND store_info.store_name LIKE '%" . $s_val . "%'

                  UNION 
                  SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where promotion.discount_on_type=1 AND promotion.id <" . $limit . " AND products.is_on_discount=1 AND products.store_id=" . $s_id . "  AND products.product_name LIKE '%" . $s_val . "%'
				 UNION 
                  SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where promotion.discount_on_type=2 AND promotion.id <" . $limit . " AND store_section.is_on_discount=1 AND store_section.store_id=" . $s_id . "  AND store_section.name LIKE '%" . $s_val . "%'";

		}


		$sql = $this->db->query("select * from (" . $query . ") as unionTable order by id DESC limit 9");
		return $sql->result();

	}

	function allproductsondis($strname)
	{
		$this->db->select('*');
		$this->db->from('promotion');
		$this->db->join('products', 'promotion.discount_on_item = products.product_id');
		$this->db->where('promotion.store_id', $strname);
		$this->db->where('discount_on_type', 1);
		$this->db->order_by('id', 'DESC');
		$result = $this->db->get();
		return $result->result();

	}

	function myprod($prodid)
	{
		$this->db->select('*');
		$this->db->from('promotion');
		//	$this->db->join('products','promotion.discount_on_item = products.product_id');
		$this->db->where('promotion.id', $prodid);
		//$this->db->where('discount_on_type', 1);
		$result = $this->db->get();
		return $result->result();

	}

	function mysecDetails($strname)
	{
		$this->db->select('*');
		$this->db->from('store_section');
		$this->db->where('storesection_id', $strname);
		$result = $this->db->get();
		//$result = $this->db->count_all_results();
		return $result->result();
	}

	function changestatus($item_id, $status, $type)
	{
		$this->db->set('is_on_discount', $status);
		if ($type == 0) {
			$this->db->where('store_id', $item_id);
			$this->db->update('store_info');
		} else if ($type == 1) {
			$this->db->where('product_id', $item_id);
			$this->db->update('products');
		} else {
			$this->db->where('storesection_id', $item_id);
			$this->db->update('store_section');
		}

	}

	function deletePromote($type_to, $item_id)
	{

		$data = array(
			'is_on_discount' => 0,
			'promotion_id' => 0,
		);
		if ($type_to == 0) {
			$this->db->where('store_id', $item_id);
			$this->db->update('store_info', $data);
		} else if ($type_to == 1) {
			$this->db->where('product_id', $item_id);
			$this->db->update('products', $data);
		} else {
			$this->db->where('storesection_id', $item_id);
			$this->db->update('store_section', $data);
		}


	}

	function getPromote($type_to, $id, $s_id)
	{

		if ($type_to == 0) {
			$sql = $this->db->query("SELECT store_info.store_name ,store_info.storeowner_id ,promotion.*
                    FROM promotion
                   INNER JOIN store_info
                     ON promotion.id=store_info.promotion_id
					  where store_info.is_on_discount=1 AND store_info.promotion_id=" . $id . " AND store_info.store_id=" . $s_id . "");
		} else if ($type_to == 1) {
			$sql = $this->db->query("SELECT products.product_name ,products.product_id ,promotion.*
                    FROM  promotion
                    INNER JOIN products
                     ON promotion.id=products.promotion_id
					 where products.is_on_discount=1 AND products.promotion_id=" . $id . " AND products.store_id=" . $s_id . "");
		} else {
			$sql = $this->db->query("SELECT store_section.name,store_section.storesection_id,promotion.*
                    FROM promotion
                    INNER JOIN  store_section
                     ON promotion.id=store_section.promotion_id
					  where store_section.is_on_discount=1 AND store_section.promotion_id=" . $id . " AND store_section.store_id=" . $s_id . "");
		}


		return $sql->result();


	}

}

?>