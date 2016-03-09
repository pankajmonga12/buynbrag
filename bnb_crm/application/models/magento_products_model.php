<?php
class Magento_products_model extends CI_Model 
{
  
    public function __construct()
    {
      parent::__construct();
    }
    
    public function csvprodData()
    {
    $this->db->select('products.product_id');
      $this->db->from('products');
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
        $this->db->select('UPPER(store_info.store_name) As StoreName');
        $this->db->select('store_info.about_store As aboutStore');
        $this->db->select('products.product_name as productName');
        $this->db->select('products.store_id as storeID');
        $this->db->select('products.seller_earnings as sellerEarning');
        $this->db->select('(select products.selling_price-products.discount) as Discount');
        $this->db->select('products.shipping_cost as shippingCost');
        $this->db->select('(select products.selling_price-products.seller_earnings-products.shipping_cost) as bnbComission');
        $this->db->select('UPPER(cat.category_name) As Category');
        $this->db->select('products.added_on as AddedOn');
        $this->db->select('store_info.communication_country As Country');
        $this->db->select('UPPER(store_section.name) As storeCAT');
        $this->db->select('products.quantity as productQuantity');
        $this->db->select('products.status as productStatus');
        $this->db->select('products.tags as tags');
        $this->db->select('products.selling_price as totalSellingPrice');
        $this->db->select('products.added_on as addedOn');
        $this->db->select('UPPER(cat.category_name) As catName');
        $this->db->select('UPPER(cat1.category_name) As sub_cat_name');
        $this->db->select('UPPER(cat2.category_name) As sub_sub_cat_name');
        $this->db->select('UPPER(cat3.category_name) As sub_sub_sub_cat_name');
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
        $this->db->join('pDesc','products.product_id = pDesc.refProductID');
        $this->db->join('store_info','products.store_id = store_info.store_id');
        //$this->db->join('catagories',' products.cat_id = catagories.category_id','left');
        // $this->db->join('variant',' products.product_id = variant.product_id','left');
        $this->db->join('store_section',' products.storesection_id = store_section.storesection_id');
        $this->db->join('catagories As cat',' products.cat_id = cat.category_id');
        $this->db->join('catagories As cat1','products.sub_catid1 = cat1.category_id');
        $this->db->join('catagories As cat2','products.sub_catid2 = cat2.category_id');
        $this->db->join('catagories As cat3',' products.sub_catid3 = cat3.category_id');
        $this->db->where('products.product_id', $productID);
        $this->db->where('products.status','1');
        $this->db->where('products.is_enable','0');
        $this->db->where('products.product_id NOT IN (select variant.product_id from variant where variant.product_id = products.product_id)', NULL, FALSE);
  

       // print_r($this->db->last_query()) ;
        $productDetails = $this->db->get();
        if($productDetails->num_rows() > 0)
        {
          return $productDetails->result_array();
        }
    }
  }
