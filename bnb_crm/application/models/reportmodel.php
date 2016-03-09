<?php
class Reportmodel extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}

	public function storeName()
	{
	   $this->db->select('store_name');
	   $this->db->select('store_id');
	   $this->db->from('store_info');
	   $storeDetails = $this->db->get();
	   if($storeDetails->num_rows() > 0)
	   {
	      return $storeDetails->result();
	   }
	}

	public function sevenDaysDetail($date)
	{
    	$status = array(5,7);
        $this->db->select('SUM((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        $this->db->select('SUM(orders.redeemedprice) as couponRedeemed');
        $this->db->select('(SUM((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-SUM(orders.redeemedprice)) as finalCommissionValue');
        $this->db->select('SUM((products.selling_price-products.discount)*orders.quantity) as totalSellingPrice');
        $this->db->from('orders');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->like("orders.date_of_order",$date);
        $this->db->where_not_in('orders.status_order',$status);
        //echo $this->db->return_query();
        $perDayDetails = $this->db->get();
        if($perDayDetails->num_rows() > 0)
        {
    	  return $perDayDetails->result();
        }
    }

	public function monthlyModel($month)
	{
        $status = array(5,7);
        $this->db->select('products.product_id as productID');
        $this->db->select('products.store_id as storeID');
        $this->db->select('DATE_FORMAT(orders.date_of_order,"%W, %M %e, %Y @ %h:%i %p") as date_of_order',FALSE);
        //$this->db->select('orders.date_of_order');
        $this->db->select('orders.pg_type');
        $this->db->select('ROUND((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        $this->db->select('ROUND(orders.redeemedprice) as couponsRedeemed');
        $this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-(orders.redeemedprice)) as finalCommission');
        $this->db->select('ROUND((products.selling_price-products.discount)*orders.quantity) as TotalSellingPrice');
        $this->db->select('ROUND((products.seller_earnings)*orders.quantity) as sellerEarning');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->join('store_info','orders.store_id = store_info.store_id','left');
        $this->db->from('orders');
        $this->db->like('orders.date_of_order',$month);
        $this->db->where_not_in('orders.status_order',$status);
        $this->db->order_by('orders.date_of_order', 'desc');
        //echo $this->db->return_query();
        $orderDetails = $this->db->get();
        if($orderDetails->num_rows() > 0)
        {
          return $orderDetails->result();
        }
    }

	public function customModel($startDate,$endDate)
	{
        $status = array(5,7);
        $this->db->select('products.product_id as productID');
        $this->db->select('products.store_id as storeID');
        $this->db->select('DATE_FORMAT(orders.date_of_order,"%W, %M %e, %Y @ %h:%i %p") as date_of_order',FALSE);
        //$this->db->select('orders.date_of_order');
        $this->db->select('orders.pg_type');
        $this->db->select('ROUND((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        //$this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100) as bnbCommissionValue');
        $this->db->select('ROUND(orders.redeemedprice) as couponsRedeemed');
        $this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-(orders.redeemedprice)) as finalCommission');
        //$this->db->select('ROUND((((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100)-(orders.redeemedprice)) as finalCommission');
        $this->db->select('ROUND((products.selling_price-products.discount)*orders.quantity) as TotalSellingPrice');
        $this->db->select('ROUND((products.seller_earnings)*orders.quantity) as sellerEarning');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->join('store_info','orders.store_id = store_info.store_id','left');
        $this->db->from('orders');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where_not_in('orders.status_order',$status);
        //echo $this->db->return_query();
        $orderDetails = $this->db->get();
        if($orderDetails->num_rows() > 0)
        {
          return $orderDetails->result();
        }
    }

	public function customModelOne($startDate,$endDate,$storeID)
	{
        $status = array(5,7);
        $this->db->select('products.product_id as productID');
        $this->db->select('products.store_id as storeID');
        $this->db->select('DATE_FORMAT(orders.date_of_order,"%W, %M %e, %Y @ %h:%i %p") as date_of_order',FALSE);
        //$this->db->select('orders.date_of_order');
        $this->db->select('orders.pg_type');
        $this->db->select('ROUND((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        //$this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100) as bnbCommissionValue');
        $this->db->select('ROUND(orders.redeemedprice) as couponsRedeemed');
        $this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-(orders.redeemedprice)) as finalCommission');
        //$this->db->select('ROUND((((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100)-(orders.redeemedprice)) as finalCommission');
        $this->db->select('ROUND((products.selling_price-products.discount)*orders.quantity) as TotalSellingPrice');
        $this->db->select('ROUND((products.seller_earnings)*orders.quantity) as sellerEarning');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->join('store_info','orders.store_id = store_info.store_id','left');
        $this->db->from('orders');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where('products.store_id',$storeID);
        $this->db->where_not_in('orders.status_order',$status);
        //echo $this->db->return_query();
        $orderDetails = $this->db->get();
        if($orderDetails->num_rows() > 0)
        {
          return $orderDetails->result();
        }
	}

	public function customModelTwo($startDate,$endDate,$catID)
	{
        $status = array(5,7);
        $this->db->select('products.product_id as productID');
        $this->db->select('products.store_id as storeID');
        $this->db->select('DATE_FORMAT(orders.date_of_order,"%W, %M %e, %Y @ %h:%i %p") as date_of_order',FALSE);
        //$this->db->select('orders.date_of_order');
        $this->db->select('orders.pg_type');
        $this->db->select('ROUND((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        //$this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100) as bnbCommissionValue');
        $this->db->select('ROUND(orders.redeemedprice) as couponsRedeemed');
        $this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-(orders.redeemedprice)) as finalCommission');
        //$this->db->select('ROUND((((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100)-(orders.redeemedprice)) as finalCommission');
        $this->db->select('ROUND((products.selling_price-products.discount)*orders.quantity) as TotalSellingPrice');
        $this->db->select('ROUND((products.seller_earnings)*orders.quantity) as sellerEarning');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->join('store_info','orders.store_id = store_info.store_id','left');
        $this->db->from('orders');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where('products.cat_id',$catID);
        $this->db->where_not_in('orders.status_order',$status);
        $orderDetails = $this->db->get();
        if($orderDetails->num_rows() > 0)
        {
          return $orderDetails->result();
        }
    }

	public function customModelThree($startDate,$endDate,$catID,$storeID)
	{
        $status = array(5,7);
        $this->db->select('products.product_id as productID');
        $this->db->select('products.store_id as storeID');
        $this->db->select('DATE_FORMAT(orders.date_of_order,"%W, %M %e, %Y @ %h:%i %p") as date_of_order',FALSE);
        //$this->db->select('orders.date_of_order');
        $this->db->select('orders.pg_type');
        $this->db->select('ROUND((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        //$this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100) as bnbCommissionValue');
        $this->db->select('ROUND(orders.redeemedprice) as couponsRedeemed');
        $this->db->select('ROUND(((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-(orders.redeemedprice)) as finalCommission');
        //$this->db->select('ROUND((((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100)-(orders.redeemedprice)) as finalCommission');
        $this->db->select('ROUND((products.selling_price-products.discount)*orders.quantity) as TotalSellingPrice');
        $this->db->select('ROUND((products.seller_earnings)*orders.quantity) as sellerEarning');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->join('store_info','orders.store_id = store_info.store_id','left');
        $this->db->from('orders');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where('products.store_id',$storeID);
        $this->db->where('products.cat_id',$catID);
        $this->db->where_not_in('orders.status_order',$status);
        $orderDetails = $this->db->get();
        if($orderDetails->num_rows() > 0)
        {
          return $orderDetails->result();
        }
	}

    public function columnChart($startDate,$endDate)
    {
        $status = array(5,7);
        $orderDate = array();
        $this->db->distinct();
        $this->db->select('orders.date_of_order');
        $this->db->from('orders');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where_not_in('orders.status_order',$status);
        //echo $this->db->return_query();
        $details = $this->db->get();
        if($details->num_rows() > 0)
        {
        	$query = $details->result();
        	foreach ($query as $value) 
        	{
        	  $date = date_create($value->date_of_order);
              $orderDate[] = date_format($date,'Y-m-d');
            }
    	    $uniqueDate = array_unique($orderDate);
    	    $finalArray = NULL;
    	    foreach ($uniqueDate as $key => $value) 
    	    {
    	      $finalArray[] = $this->checkDetails($value);
    	    }
    	    	//echo "<hr/><pre>finalArray = ".print_r($finalArray, TRUE)."</pre><hr/>";
    		  return $finalArray;
        }
        else
        {
        		return NULL;
        }
    }

    public function columnChartTwo($startDate,$endDate)
    {
        $status = array(5,7);
        $orderDate = array();
        $this->db->distinct();
        $this->db->select('orders.date_of_order');
        $this->db->from('orders');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where_not_in('orders.status_order',$status);
        //echo $this->db->return_query();
        $details = $this->db->get();
        if($details->num_rows() > 0)
        {
        	$query = $details->result();
        	foreach ($query as $value) 
        	{
        	  $date = date_create($value->date_of_order);
              $orderDate[] = date_format($date,'Y-m');
            }
    	    $uniqueDate = array_unique($orderDate);
    	      //print_r($uniqueDate);
    	    $finalArray = NULL;
    	    foreach ($uniqueDate as $key => $value) 
    	    {
    	      $finalArray[] = $this->checkDetails($value);
    	    }
                 //echo "<hr/><pre>finalArray = ".print_r($finalArray, TRUE)."</pre><hr/>";
    			return $finalArray;
        }
        else
        {
        	return NULL;
        }
    }

    public function checkDetails($orderDate)
    {
        $status = array(5,7);
        $this->db->select('orders.date_of_order');
        $this->db->select('SUM((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        //$this->db->select('SUM(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100) as bnbCommissionValue');
        $this->db->select('SUM(orders.redeemedprice) as couponsRedeemed');
        $this->db->select('(SUM((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-SUM(orders.redeemedprice)) as finalCommissionValue');
        //$this->db->select('(SUM(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100)-SUM(orders.redeemedprice)) as finalCommissionValue');
        $this->db->select('SUM((products.selling_price-products.discount)*orders.quantity) as totalSellingPrice');
        $this->db->from('orders');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->like('orders.date_of_order',$orderDate);
        $this->db->where_not_in('orders.status_order',$status);
        //echo $this->db->return_query();
        $dateDetails = $this->db->get();
        if($dateDetails->num_rows() > 0)
        {
        	return $dateDetails->result();
        }
    }

    public function weeklyDataModel($whereText)
    {
        $status = array(5,7);
        $this->db->select('SUM((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity) as bnbCommissionValue');
        //$this->db->select('SUM(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100) as bnbCommissionValue');
        $this->db->select('SUM(orders.redeemedprice) as couponRedeemed');
        $this->db->select('(SUM((products.selling_price-products.discount-products.shipping_cost-products.seller_earnings-products.insurance_cost)*orders.quantity)-SUM(orders.redeemedprice)) as finalCommissionValue');
        //$this->db->select('(SUM(((products.selling_price-products.discount-products.shipping_cost)*products.bnb_commission)/100)-SUM(orders.redeemedprice)) as finalCommissionValue');
        $this->db->select('SUM((products.selling_price-products.discount)*orders.quantity) as totalSellingPrice');
        $this->db->from('orders');
        $this->db->join('products','orders.product_id = products.product_id','left');
        $this->db->where("orders.date_of_order BETWEEN". $whereText);
        $this->db->where_not_in('orders.status_order',$status);
        //echo $this->db->return_query();
        $weekDetails = $this->db->get();
        if($weekDetails->num_rows() > 0)
        {
        	return $weekDetails->result();
        }
    }
  
    public function topSellingModel($startDate,$endDate)
    {
        $status = array(5,7);
        $this->db->distinct();
        $this->db->select('products.product_id as productID');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->select('store_info.store_id as storeID');
        $this->db->select('(SELECT COUNT(order_id) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalCount');
        $this->db->select('(SELECT SUM(quantity) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalQuantity');
        $this->db->select('(SELECT ROUND(SUM(quantity*amt_paid)) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as TotalSellingPrice');
        $this->db->join('orders','products.product_id = orders.product_id','left');
        $this->db->join('store_info','products.store_id = store_info.store_id','left');
        $this->db->from('products');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where_not_in('orders.status_order',$status);
        $this->db->order_by('totalCount', "desc");
        //echo $this->db->return_query();
        $orderDetails = $this->db->get();
        if($orderDetails->num_rows() > 0)
        {
          return $orderDetails->result();
        }
        else
        {
          return NULL;
        }
    }

    public function topSellingModelOne($startDate,$endDate,$storeID)
    {
        $status = array(5,7);
        $this->db->distinct();
        $this->db->select('products.product_id as productID');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->select('store_info.store_id as storeID');
        $this->db->select('(SELECT COUNT(order_id) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalCount');
        $this->db->select('(SELECT SUM(quantity) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalQuantity');
        $this->db->select('(SELECT ROUND(SUM(quantity*amt_paid)) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as TotalSellingPrice');
        $this->db->join('orders','products.product_id = orders.product_id','left');
        $this->db->join('store_info','products.store_id = store_info.store_id','left');
        $this->db->from('products');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where('products.store_id',$storeID);
        $this->db->where_not_in('orders.status_order',$status);
        $this->db->order_by('totalCount', "desc");
        $dateDetails = $this->db->get();
        if($dateDetails->num_rows() > 0)
        {
        	return $dateDetails->result();
        }
    }

    public function topSellingModelTwo($startDate,$endDate,$catID)
    {
        $status = array(5,7);
        $this->db->distinct();
        $this->db->select('products.product_id as productID');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->select('store_info.store_id as storeID');
        $this->db->select('(SELECT COUNT(order_id) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalCount');
        $this->db->select('(SELECT SUM(quantity) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalQuantity');
        $this->db->select('(SELECT ROUND(SUM(quantity*amt_paid)) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as TotalSellingPrice');
        $this->db->join('orders','products.product_id = orders.product_id','left');
        $this->db->join('store_info','products.store_id = store_info.store_id','left');
        $this->db->from('products');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where('products.cat_id',$catID);
        $this->db->where_not_in('orders.status_order',$status);
        $this->db->order_by('totalCount', "desc");
        $dateDetails = $this->db->get();
        if($dateDetails->num_rows() > 0)
        {
          return $dateDetails->result();
        }
    }

    public function topSellingModelThree($startDate,$endDate,$storeID,$catID)
    {
        $status = array(5,7);
        $this->db->distinct();
        $this->db->select('products.product_id as productID');
        $this->db->select('products.product_name as productName');
        $this->db->select('store_info.store_name as storeName');
        $this->db->select('store_info.store_id as storeID');
        $this->db->select('(SELECT COUNT(order_id) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalCount');
        $this->db->select('(SELECT SUM(quantity) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as totalQuantity');
        $this->db->select('(SELECT ROUND(SUM(quantity*amt_paid)) FROM orders WHERE orders.product_id = products.product_id AND orders.date_of_order>='."'$startDate'".'AND orders.date_of_order<='."'$endDate'".') as TotalSellingPrice');
        $this->db->join('orders','products.product_id = orders.product_id','left');
        $this->db->join('store_info','products.store_id = store_info.store_id','left');
        $this->db->from('products');
        $this->db->where('orders.date_of_order >=',$startDate);
        $this->db->where('orders.date_of_order <=',$endDate);
        $this->db->where('products.store_id',$storeID);
        $this->db->where('products.cat_id',$catID);
        $this->db->where_not_in('orders.status_order',$status);
        $this->db->order_by('totalCount', "desc");
        $dateDetails = $this->db->get();
        if($dateDetails->num_rows() > 0)
        {
          return $dateDetails->result();
        }
    }
}
?>
