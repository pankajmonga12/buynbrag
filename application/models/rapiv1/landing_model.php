<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized!');

class Landing_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function truncateTrendingProductsTable()
	{
		return $this->db->truncate('trendingProducts');
	}

	public function readTrendingDataForGen()
	{
		/*
		select
		product_id,
		store_id,
		(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore
		from products
		where cat_id = 2 order by pScore desc limit 40;
		*/
		$retVal['furniture'] = NULL;
		$retVal['decor'] = NULL;
		$retVal['dining'] = NULL;
		$retVal['lighting'] = NULL;
		$retVal['fashion'] = NULL;
		$retVal['gnc'] = NULL;
		$retVal['art'] = NULL;
		$retVal['fashionM'] = NULL;
		$retVal['fashionW'] = NULL;
		$retVal['fashionAccessW'] = NULL;
		$retVal['fashionAccessM'] = NULL;
		$retVal['quirky'] = NULL;
		$retVal['collectibles'] = NULL;

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('cat_id', 6);
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(60);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['furniture'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('cat_id', 8);
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(48);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['decor'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('cat_id', 7);
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(12);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['dining'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('cat_id', 10);
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(14);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['lighting'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('cat_id', 2);
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(6);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['fashion'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('cat_id', 4);
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(18);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['gnc'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('cat_id', 3);
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(10);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['art'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('(cat_id = 387 OR sub_catid1 = 387 OR sub_catid2 = 387 OR sub_catid3 = 387)');
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(3);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['fashionM'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('(cat_id = 388 OR sub_catid1 = 388 OR sub_catid2 = 388 OR sub_catid3 = 388)');
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(3);
		echo "<pre>The query being executed".PHP_EOL.$this->db->return_query()."</pre>";
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['fashionW'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('(cat_id = 18 OR sub_catid1 = 18 OR sub_catid2 = 18 OR sub_catid3 = 18)');
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(6);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['fashionAccessW'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('(cat_id = 14 OR sub_catid1 = 14 OR sub_catid2 = 14 OR sub_catid3 = 14)');
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(3);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['fashionAccessM'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		$this->db->from('products');
		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('(cat_id = 32 OR sub_catid1 = 32 OR sub_catid2 = 32 OR sub_catid3 = 32)');
		
		$this->db->order_by('pScore', 'desc');
		$this->db->limit(57);
		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['quirky'] = $q1->result();
				break;
		}

		$this->db->select('product_id');
		$this->db->select('store_id');
		$this->db->select('cat_id');
		$this->db->select('(visit_counter + (fancy_counter*5) + ((SELECT COUNT(orders.order_id) FROM orders WHERE product_id = products.product_id)*10) ) as pScore');
		
		$this->db->from('products');

		$this->db->where('status', 1);
		$this->db->where('is_enable', 0);
		$this->db->where('(cat_id = 392 OR sub_catid1 = 392 OR sub_catid2 = 392 OR sub_catid3 = 392)');
		
		$this->db->order_by('pScore', 'desc');
		
		$this->db->limit(3);
		
		$q1 = $this->db->get();
		
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$retVal['collectibles'] = $q1->result();
				break;
		}

		return $retVal;
	}

	public function write($batchData)
	{
		$batchDataCount = count($batchData);
		log_message('DEBUG', "batchDataCount = ".$batchDataCount);

		$this->db->truncate('trendingProducts');

		log_message( 'DEBUG', "JUST RAN THE FOLLOWING QUERY___/r/n".$this->db->last_query() );

		$result = $this->db->insert_batch('trendingProducts', $batchData);

		log_message( 'DEBUG', "JUST RAN THE FOLLOWING QUERY___/r/n".$this->db->last_query() );

		$affectedRows = $this->db->affected_rows();
		log_message('DEBUG', "affected rows = ".$affectedRows);

		if($affectedRows < $batchDataCount) // if not all data was successfully inserted, fall-back to one by one insertion
		{
			$this->db->truncate('trendingProducts'); // delete all data
			$t = 0;
			foreach ($batchData as $batchItem)
			{
				$this->db->insert('trendingProducts', $batchItem);
				$t += $this->db->affected_rows();
			}
			
			$affectedRows = $t;
		}
		return array('batchDataCount' => $batchDataCount, 'result' => $result, 'affectedRows' => $affectedRows, 'lastQuery' => $this->db->last_query());
	}

	public function readTrendingData($startFrom = NULL, $userID = NULL)
	{
		$retVal = NULL;

		$userCats = NULL;

		$isLoggedIN = $this->session->userdata('logged_in'); // check the status of the variable logged_in

		if( !is_null($userID) )
		{
			$this->db->select('pValue as catID');
			
			$this->db->from('user_prefs');
			
			$this->db->where('user_id', $userID);
			$this->db->where('pType', 1);
			
			$this->db->order_by('ts', 'desc');

			$q0 = $this->db->get();
			if($q0->num_rows() > 0)
			{
				$cats = $q0->result();
				$userCats = array();
				foreach($cats as $cat)
				{
					$userCats[] = $cat->catID;
				}
			}
		}

		$this->db->select('products.product_id AS productID');
		$this->db->select('products.store_id AS storeID');
		$this->db->select('products.cat_id AS catID');
		$this->db->select('products.product_name AS productName');

		$isReallyLoggedIN = ($userID !== FALSE && $isLoggedIN !== FALSE && is_numeric($userID) && $userID > 0 && $isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
		
		switch($isReallyLoggedIN)
		{
			case TRUE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip);
					 log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not');*/
					 //$this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is deemed "logged-in" from '.$__ip) );
					 //$this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has fancied the current product in the query result set or not') );
					 $this->db->select("(IF((SELECT COUNT(product_id) FROM fancy_products f1 WHERE (f1.user_id = ".$userID." AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);
					 /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					 //$this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					 $this->db->select("(IF((SELECT COUNT(product_id) FROM brag_products b1 WHERE (b1.user_id = ".$userID." AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
			case FALSE: /*log_message('INFO', 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ');
					  log_message('INFO', 'Will not try to check if the current user has fancied the products or not');*/
					  //$this->slog->write( array('level' => 1, 'msg' => 'depending upon the data retrieved, the user '.$userID.' is "NOT logged-in" ') );
					  //$this->slog->write( array('level' => 1, 'msg' => 'Will not try to check if the current user has fancied the products or not') );
					  $this->db->select("(IF((SELECT COUNT(product_id) FROM fancy_products f1 WHERE (f1.user_id = '%' AND f1.product_id = products.product_id)), TRUE, FALSE)) AS hasFancied", FALSE);;
					  /*log_message('INFO', 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not');*/
					  //$this->slog->write( array('level' => 1, 'msg' => 'Will now try to retrieve whether the user '.$userID.' has bragged the current product in the query result set or not') );
					  $this->db->select("(IF((SELECT COUNT(product_id) FROM brag_products b1 WHERE (b1.user_id = '%' AND b1.product_id = products.product_id)), TRUE, FALSE)) AS hasbragged", FALSE);
				break;
		}
		
		$this->db->from('products');

		if($userCats !== NULL && count($userCats) > 0)
		{
			$this->db->where_in('products.cat_id', $userCats);
		}

		$this->db->order_by('fancy_counter', 'desc');

		switch (is_null($startFrom))
		{
			case TRUE:	$this->db->limit(60);
				break;
			case FALSE:	$this->db->limit(60, $startFrom*60);
				break;
		}

		log_message('INFO', "GOING TO RUN THE FOLLOWING QUERY___\r\n".$this->db->return_query());

		$query = $this->db->get();

		log_message('INFO', "JUST RAN THE FOLLOWING QUERY___\r\n".$this->db->last_query());
		
		switch($query->num_rows() > 0)
		{
			case TRUE:	$retVal = $query->result();
				break;
		}

		return $retVal;
	}

	public function shuffleTrendingProducts()
	{
		$totalRows = $this->db->count_all('trendingProducts');
		$totalRows = ($totalRows > 0 ? $totalRows: 179);
		$numbers = range(0, $totalRows); // generate an array containg numbers from 0 - 179 (180 values)
		shuffle($numbers); // shuffle to randomize

		// read the current list of trendingProducts
		$this->db->select('product_id');
		$this->db->from('trendingProducts');
		$this->db->limit(180, 0);

		$q1 = $this->db->get();
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$q1r = $q1->result();
						$this->db->trans_start();
						$i = 0;
						foreach($q1r as $product)
						{
							$this->db->query("UPDATE trendingProducts SET sort_order = ".$numbers[$i++]." WHERE product_id = ".$product->product_id);
						}
						$this->db->trans_complete();
				break;
		}
	}
}
?>