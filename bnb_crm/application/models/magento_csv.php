<?php
class Magento_csv extends CI_Model 
{
  
    public function __construct()
    {
      parent::__construct();
    }
    
    public function csvprodData($startDate,$endDate)
    {
      $this->db->select('products.product_id');
      $this->db->from('products');
      $this->db->where('products.product_id >=',$startDate);
      $this->db->where('products.product_id <=',$endDate);
      //echo $this->db->return_query();
      $details = $this->db->get();
      if($details->num_rows() > 0)
      {
        $query = $details->result();
        foreach ($query as $value) 
        {
          $simple_array[] = $value->product_id;
        }
        $uniqueDate = array_unique($simple_array);
        $finalArray = NULL;
        foreach ($uniqueDate as $key => $value) 
        {
          $finalArray[] = $this->getDetails($value);
        }
       // echo "<hr/><pre>finalArray = ".print_r($finalArray, TRUE)."</pre><hr/>";
        return $finalArray;
      }
      else
      {
        return NULL;
      }
    }
    public function getDetails($productID)
    {
        $this->db->select('products.product_id as productID');
        $this->db->select('store_info.store_name As StoreName');
        $this->db->select('products.product_name as productName');
        $this->db->select('catagories.category_name As Category');
        $this->db->select('products.added_on as AddedOn');
        $this->db->select('store_info.communication_country As Country');
        $this->db->select('variant.color As Color');
        $this->db->select('products.quantity as productQuantity');
        $this->db->select('products.status as productStatus');
        $this->db->select('products.selling_price as totalSellingPrice');
        $this->db->select('products.added_on as addedOn');
        if($productID > 4499)
        {
          $this->db->select('pDesc.description As Description');
          $this->db->select('pDesc.whats_in_the_box');
          $this->db->select('pDesc.packageWeightUnit AS Weight');
          $this->db->select('pDesc.additional_info');
        }
        else
        {
          $this->db->select('products.description As Description');
          $this->db->select('products.prd_act_weight As Weight');
        }
    
        $this->db->from('products');
        $this->db->join('pDesc','products.product_id = pDesc.refProductID','left');
        $this->db->join('store_info','products.store_id = store_info.store_id','left');
        $this->db->join('catagories',' products.cat_id = catagories.category_id','left');
         $this->db->join('variant',' products.product_id = variant.product_id','left');
        $this->db->where('products.product_id',$productID);
        //print_r($this->db->last_query()) ;
        $productDetails = $this->db->get();
        if($productDetails->num_rows() > 0)
        {
          return $productDetails->result_array();
        }
    }
  }
