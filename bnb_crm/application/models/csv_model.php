<?php
class Csv_model extends CI_Model 
{

      public function __construct()
  {
    parent::__construct();
  }
  public function storeInfo($storeID)
  {
    $sql = "SELECT store_name,store_id,store_url,storeowner_id,seo_tags,banner_url,banner_url2,about_store,contact_name,contact_number,contact_email,";
    $sql .= "communication_address,communication_city,communication_state,communication_country,communication_pincode,warehouse_address,warehouse_city,";
    $sql .="warehouse_state,warehouse_country,warehouse_pincode,company_code,visit_counter,fancy_counter,brag_counter,marketing_name,tag_line,logo_url,";
    $sql .= "welcome_msg,return_policy,EMI_policy,COD_policy,support_email,return_address,return_city,return_state,return_country,return_pincode,";
    $sql .="bankaccountholder_name,bank_name,bank_branch,account_number,account_type,ifsc_code,vat_no,tin_no,pan_no,pickup_name,pickup_address,pickup_city,";
    $sql .="pickup_state,pickup_country,pickup_pincode,pickup_landmark,is_on_discount,promotion_id,invoice_no,isPublished,shippedByVendor";
    $sql .=" FROM store_info";
    $sql .=" WHERE store_id =".$storeID;
    $query = $this->db->query($sql);
    return $query;
  }
    public function allstoreInfo()
  {
    $sql = "SELECT store_name,store_id,store_url,storeowner_id,seo_tags,banner_url,banner_url2,about_store,contact_name,contact_number,contact_email,";
    $sql .= "communication_address,communication_city,communication_state,communication_country,communication_pincode,warehouse_address,warehouse_city,";
    $sql .="warehouse_state,warehouse_country,warehouse_pincode,company_code,visit_counter,fancy_counter,brag_counter,marketing_name,tag_line,logo_url,";
    $sql .= "welcome_msg,return_policy,EMI_policy,COD_policy,support_email,return_address,return_city,return_state,return_country,return_pincode,";
    $sql .="bankaccountholder_name,bank_name,bank_branch,account_number,account_type,ifsc_code,vat_no,tin_no,pan_no,pickup_name,pickup_address,pickup_city,";
    $sql .="pickup_state,pickup_country,pickup_pincode,pickup_landmark,is_on_discount,promotion_id,invoice_no,isPublished,shippedByVendor";
    $sql .=" FROM store_info";
    $query = $this->db->query($sql);
    return $query;
  }
  public function productList($startID,$endID)
  {
     $sql = "SELECT products.product_id,products.store_id AS storeID,store.store_name As storeName,cate1.category_name As Category,cate2.category_name As SubCategory,cate3.category_name As SubsubCategory,cate4.category_name As SubsubsubCategory,";
     $sql .="products.product_name,products.bnb_product_code,products.storesection_id,products.description,products.occasions,";
     $sql .="products.style,products.tags,products.length,products.breadth,products.height,products.prd_act_weight,products.prd_vol_weight,products.shipping_partner,products.shipping_mode,";
     $sql .="products.seller_earnings,products.bnb_commission,products.tax_rate,products.insurance_cost,products.shipping_cost,products.selling_price,products.quantity,products.processing_time,";
     $sql .="products.status,products.is_enable,products.discount,products.is_on_discount,products.promotion_id,products.added_on,products.visit_counter,products.fancy_counter,products.brag_counter,";
     $sql .="products.bbucks,products.lastFanciedBy,products.lastFanciedAt,products.curatedBy,products.bnb_commission_value";
     $sql .=" FROM products";
     $sql .=" LEFT JOIN catagories As cate1 on products.cat_id=cate1.category_id";
     $sql .=" LEFT JOIN catagories As cate2 on products.sub_catid1=cate2.category_id";
     $sql .=" LEFT JOIN catagories As cate3 on products.sub_catid2=cate3.category_id";
     $sql .=" LEFT JOIN catagories As cate4 on products.sub_catid3=cate4.category_id";
     $sql .=" LEFT JOIN store_info As store on products.store_id=store.store_id";
      $sql .=" WHERE product_id >= ".$startID." AND product_id <=".$endID;
     $query = $this->db->query($sql);
     return $query;
  }

public function userList($startID,$endID)
  {
    $sql = "SELECT  user_id,fb_uid,username,email,full_name,nick_name,gender,address,city,";
    $sql .="country,date_of_birth,mob,about_me,interested_in,profile_pic,state,pin,taste,joined_date,";
    $sql .="country_code,tw_uid,bbucks,mpHash,hashType,hashValidity,fbEmail,isActive,trafficID,canPurchase,rFlowStatus";
    $sql .=" FROM user_details";
    $sql .= " WHERE user_id >=".$startID." AND user_id <=".$endID;
     $query = $this->db->query($sql);
  
   return $query;
  }
  public function userListbyEmail($email)
  {
    $sql = "SELECT  user_id,fb_uid,username,email,full_name,nick_name,gender,address,city,country,date_of_birth,";
    $sql .="mob,about_me,interested_in,profile_pic,state,pin,taste,joined_date,country_code,tw_uid,bbucks,";
    $sql .="mpHash,hashType,hashValidity,fbEmail,isActive,trafficID,canPurchase,rFlowStatus";
    $sql .=" FROM user_details";
    $sql .= " WHERE email = "."'$email'";
    $query = $this->db->query($sql);
  
   return $query;
  }
    public function userListbyID($userID)
  {
    $sql = "SELECT  user_id,fb_uid,username,";
    $sql.="email,full_name,nick_name,gender,";
    $sql.="address,city,country,date_of_birth,";
    $sql.="mob,about_me,interested_in,profile_pic,";
    $sql.="state,pin,taste,joined_date,country_code,tw_uid,bbucks,";
    $sql.= "mpHash,hashType,hashValidity,fbEmail,isActive,trafficID,canPurchase,rFlowStatus";
    $sql.=" FROM user_details ";
    $sql.= "WHERE user_id =".$userID;
     $query = $this->db->query($sql);
  
   return $query;
  }
      public function CartDetail()
  {
              $this->load->database();
             $this->db->select("cart.user_id AS UserID");
             $this->db->select("cart.product_id As ProductID");
             $this->db->select("cart.date_time AS DateTime");
             $this->db->select("cart.vcolor AS variantColour");
             $this->db->select("cart.vsize AS variantSize");
             $this->db->select("products.product_name As ProductName");
             $this->db->select("store_info.store_name As StoreName");
             $this->db->select("products.selling_price As SellingPrice");
             $this->db->select("products.discount As Discount");
             $this->db->select("user_details.full_name UserName");
             $this->db->select("user_details.email As EmailID");
             $this->db->select("user_details.mob As MobileNO");
             $this->db->from("cart");
             $this->db->join('products','cart.product_id = products.product_id','left');
             $this->db->join('user_details','cart.user_id = user_details.user_id','left');
             $this->db->join('store_info','cart.store_id = store_info.store_id','left');

             $query = $this->db->get();
             return $query;
    
  }
   public function storeProducts($storeID)
  {
     $sql = "SELECT products.product_id,store.store_name As storeName,cate1.category_name As Category,cate2.category_name As SubCategory,cate3.category_name As SubsubCategory,cate4.category_name As SubsubsubCategory,";
     $sql .="products.product_name,products.bnb_product_code,products.storesection_id,products.description,products.occasions,";
     $sql .="products.style,products.tags,products.length,products.breadth,products.height,products.prd_act_weight,products.prd_vol_weight,products.shipping_partner,products.shipping_mode,";
     $sql .="products.seller_earnings,products.bnb_commission,products.tax_rate,products.insurance_cost,products.shipping_cost,products.selling_price,products.quantity,products.processing_time,";
     $sql .="products.status,products.is_enable,products.discount,products.is_on_discount,products.promotion_id,products.added_on,products.visit_counter,products.fancy_counter,products.brag_counter,";
     $sql .="products.bbucks,products.lastFanciedBy,products.lastFanciedAt,products.curatedBy,products.bnb_commission_value";
     $sql .=" FROM products";
     $sql .=" LEFT JOIN catagories As cate1 on products.cat_id=cate1.category_id";
     $sql .=" LEFT JOIN catagories As cate2 on products.sub_catid1=cate2.category_id";
     $sql .=" LEFT JOIN catagories As cate3 on products.sub_catid2=cate3.category_id";
     $sql .=" LEFT JOIN catagories As cate4 on products.sub_catid3=cate4.category_id";
     $sql .=" LEFT JOIN store_info As store on products.store_id=store.store_id";
     $sql .=" WHERE store.store_id = ".$storeID;
     $query = $this->db->query($sql);
     return $query;
  }

}
?>