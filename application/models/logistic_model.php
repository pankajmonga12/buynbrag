<?php
class logistic_model extends CI_Model
{


	public function __construct()
	{
		$this->load->helper('date');
	}

	public function login($select, $city, $password)
	{
		$this->db->select('id');
		$this->db->where('logistic_name', $select);
		$this->db->where('city_name', $city);
		$this->db->where('password', $password);
		$query = $this->db->get('shiping_partners');

		if ($query->num_rows() > 0)
		{
			return $query->row()->id;
		}
		else
		{
			return false;
		}
	}

	public function get_order_detail($select, $select2, $select3)
	{
		$this->db->select('*');
		$this->db->or_where('city', $select);

		$this->db->or_where('order_status', $select3);
		$this->db->or_where('seller_name', $select2);
		$query = $this->db->get('shipped_order');
		return $query->result();
	}

	public function get_order_detail1($id)
	{
		$this->db->select('*');
		$this->db->or_where('awb_no', $id);
		$query = $this->db->get('shipped_order');
		return $query->result();
	}

	public function orderDetails($city)
	{
		$this->db->select('orders.awb_no');
		$this->db->select('orders.order_id');
		$this->db->select('orders.shipping_city');
		$this->db->select('orders.status_order');
		
		$this->db->select('batch_items_ts.status');
		$this->db->select('batch_items_ts.remarks');
		
		$this->db->select('products.product_name');
		$this->db->select('products.prd_act_weight');
		$this->db->select('products.prd_vol_weight');
		$this->db->select('products.store_id');
		
		$this->db->from('orders');
		
		$this->db->join('batch_items', 'batch_items.refOrderID = orders.order_id');
		$this->db->join('products', 'products.product_id = orders.product_id');
		$this->db->join('batch_items_ts', 'batch_items_ts.refBatchItemID = batch_items.id AND batch_items_ts.status = batch_items.status');
		
		$this->db->where('orders.shipping_city',$city);
		$this->db->where('orders.payment_status', 1);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function orderDetailsCOD($city)
	{
		$this->db->select('orders.awb_no');
		$this->db->select('orders.order_id');
		$this->db->select('orders.shipping_city');
		$this->db->select('orders.status_order');
		
		$this->db->select('batch_items.refBatchID as batchID');
		
		$this->db->select('batch_items_ts.refBatchItemID as batchItemID');
		$this->db->select('batch_items_ts.status');
		$this->db->select('batch_items_ts.ts');
		$this->db->select('batch_items_ts.remarks');
		
		$this->db->select('products.product_name');
		$this->db->select('products.prd_act_weight');
		$this->db->select('products.prd_vol_weight');
		$this->db->select('products.store_id');
		
		$this->db->from('orders');
		
		$this->db->join('batch_items', 'batch_items.refOrderID = orders.order_id');
		$this->db->join('products', 'products.product_id = orders.product_id');
		$this->db->join('batch_items_ts', 'batch_items_ts.refBatchItemID = batch_items.id AND batch_items_ts.status = batch_items.status');
		
		$this->db->where('orders.shipping_city',$city);
		$this->db->where('orders.payment_status', 2);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	/*public function search_result($id,$store_id)
	{
		$this->db->select('*');
		$query = $this->db->get('shipped_order');
		return $query->result();
	}*/

	public function select_order_details($order_status)
	{
		$this->db->select('*');
		$this->db->where('order_status', $order_status);
		$query = $this->db->get('shipped_order');
	}
	
	public function update($data,$id)
	{
		$this->load->database();
		$this->db->where('order_id',$id);
		$this->db->update('orders',$data);
	}
	/* SHAMMI SHAILAJ */
	public function manifestIDs()
	{
		/* 24-09-2013 QUERY CHANGE
		SELECT * FROM batches WHERE timestamp >= unix_timestamp(curdate()) and timestamp < unix_timestamp(curdate())+86400 order by timestamp asc;

		picks manifests for the current day only
		*/
		$this->db->select('store_id AS manifestID');
		$this->db->from('batches');
		$this->db->where('timestamp >= UNIX_TIMESTAMP(CURDATE()) AND timestamp < UNIX_TIMESTAMP(CURDATE())+86400');
		$this->db->order_by('timestamp', 'asc');
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return FALSE;
				break;
		}
	}
	
	public function batchIDs($manifestID)
	{
		/* 24-09-2013 QUERY CHANGE
		select * from batches where timestamp >= unix_timestamp(curdate()) and timestamp < unix_timestamp(curdate())+86400 order by timestamp asc;

		picks batches for the current day only
		*/
		$this->db->select('id AS batchID');
		$this->db->from('batches');
		$this->db->where('store_id', $manifestID);
		$this->db->where('timestamp >= UNIX_TIMESTAMP(CURDATE()) AND timestamp < UNIX_TIMESTAMP(CURDATE())+86400');
		$this->db->order_by('timestamp', 'asc');
		//$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return FALSE;
				break;
		}
	}
	
	public function batchOrders($batchItemID, $startFrom = NULL, $maxResults = NULL)
	{
		if(is_null($startFrom) || !is_numeric($startFrom))
		{
			$startFrom = 0;
		}
		if(is_null($maxResults) || !is_numeric($maxResults))
		{
			$maxResults = 100;
		}
		/*
		query being used
		SELECT batch_items.refOrderID AS order_id, batch_items_ts.ts, batch_items_ts.`status` AS `action`, batch_items_ts.remarks, batch_items_ts.refBatchItemID AS batchItemID
		orders.awb_no, orders.shipping_city, products.product_name, (IF((products.prd_act_weight > products.prd_vol_weight), products.prd_act_weight, products.prd_vol_weight )) AS weight,
		orders.status_order
		from batch_items
		join batch_items_ts on batch_items_ts.refBatchItemID = batch_items.id and batch_items_ts.`status` = batch_items.`status`
		join orders on orders.order_id = batch_items.refOrderID
		join products on products.product_id = orders.product_id;
		*/
		/* 24-09-2013 NEW QUERY to fix issue where multiple status messages were not being displayed
		SELECT batch_items_ts.ts, batch_items_ts.status AS action, batch_items_ts.remarks batch_items.refOrderID AS order_id, batch_items_ts.refBatchItemID AS batchItemID,
		`orders`.`awb_no`, `orders`.`shipping_city`, `products`.`product_name`,
		(IF((products.prd_act_weight > products.prd_vol_weight), `products`.`prd_act_weight`, `products`.`prd_vol_weight` )) AS weight,
		`orders`.`status_order`
		from batch_items_ts
		left join batch_items on batch_items_ts.refBatchItemID = batch_items.refBatchID
		left join orders on batch_items.refOrderID = orders.order_id
		left join products on orders.product_id = products.product_id
		WHERE refBatchItemID = 6;
		*/
		log_message('INFO', "inside logistic_model/batchOrders");
		$this->db->select('batch_items.refOrderID AS order_id');
		$this->db->select('batch_items_ts.ts AS statusTimeStamp');
		$this->db->select('batch_items_ts.refBatchItemID AS batchItemID');
		$this->db->select('batch_items_ts.status AS action');
		$this->db->select('batch_items_ts.remarks');
		$this->db->select('orders.awb_no');
		$this->db->select('orders.shipping_city');
		$this->db->select('products.product_name');
		$this->db->select('(IF((products.prd_act_weight > products.prd_vol_weight), products.prd_act_weight, products.prd_vol_weight )) AS weight');
		$this->db->select('orders.status_order');
		$this->db->from('batch_items_ts');
		$this->db->join('batch_items', 'batch_items_ts.refBatchItemID = batch_items.refBatchID', 'left');
		$this->db->join('orders', 'batch_items.refOrderID = orders.order_id', 'left');
		$this->db->join('products', 'orders.product_id = products.product_id', 'left');
		$this->db->where('batch_items_ts.refBatchItemID', $batchItemID);
		$this->db->limit($maxResults, $startFrom*$maxResults);
		$query = $this->db->get();
		log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________________________________\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}
	
	public function saveRemark($batchItemID, $status, $remark)
	{
		log_message('INFO', 'inside logistic_model/saveRemark');
		$this->db->select('batch_items.refBatchID as batchID');
		$this->db->select('batch_items.refOrderID as orderID');
		$this->db->from('batch_items');
		$this->db->join('batch_items_ts', 'batch_items_ts.refBatchItemID = batch_items.refBatchID', 'left');
		$query0 = $this->db->get();
		log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________________________________\r\n".$this->db->last_query());
		$batchID = NULL;
		$orderID = NULL;
		switch($query0->num_rows() > 0)
		{
			case TRUE:	$tmp = $query0->result();
						$batchID = $tmp[0]->batchID;
						$orderID = $tmp[0]->orderID;
				break;
		}

		$this->db->select('batch_items_ts.id');
		$this->db->from('batch_items_ts');
		$this->db->where('batch_items_ts.refBatchItemID', $batchItemID);
		$this->db->where('batch_items_ts.status', $status);
		$query = $this->db->get();
		log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________________________________\r\n".$this->db->last_query());
		switch($query->num_rows() > 0)
		{
			case TRUE: $this->db->set('status', $status); // if a remark has already been saved with the given status, update
					 $this->db->set('remarks', $remark);
					 $this->db->set('ts', time());
					 $this->db->where('refBatchItemID', $batchItemID);
					 $this->db->where('status', $status);
					 $q1 = $this->db->update('batch_items_ts');
					 log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________________________________\r\n".$this->db->last_query());
				break;
			case FALSE: $this->db->set('status', $status); // if a remark has not been saved with the given status, insert
					 $this->db->set('remarks', $remark);
					 $this->db->set('ts', time());
					 $this->db->set('refBatchItemID', $batchItemID);
					 $q1 = $this->db->insert('batch_items_ts');
					 log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________________________________\r\n".$this->db->last_query());

					 if($batchID !== NULL && is_numeric($batchID) && $orderID !== NULL && is_numeric($orderID))
					 {
					 	$this->db->set('refBatchID', $batchID);
					 	$this->db->set('refOrderID', $orderID);
					 	$this->db->set('status', $status);
					 	$q2 = $this->db->insert('batch_items');
					 	log_message("INFO", "JUST RAN THE FOLLOWING QUERY_____________________________________________\r\n".$this->db->last_query());
					 }
					 return $q1 && $q2;
				break;
		}
	}
	
	/* SHAMMI SHAILAJ */
	public function get_batch_id($store_id)
	{
		$this->db->select('id');
		
		$this->db->from('batches');
		
		$this->db->where('store_id',$store_id);
		
		$query = $this->db->get();

		return $query->result();
	}


	public function get_awbno($awbno)
	{
		$this->db->select('*');
		$this->db->where('awb_no', $awbno);
		$query = $this->db->get('shipped_order');
		return $query->result();
	}

	public function search_result($id,$store_id)
	{
		$this->db->select('*');
		$this->db->where('store_id',$id);
		$this->db->where('batch_id',$store_id);
		$query = $this->db->get('shipped_order');
		return $query->result();
	}
}

?>