<?php
class Check_products extends CI_Model
{
   public function __construct()
   {
		parent::__construct();
   }
   public function checkQuantity( $productIDs )
   {
   	    $this->db->select('products.product_id AS productID');
   	    $this->db->from('products');
   	    $this->db->where('products.quantity >',0);
   	    $this->db->where_in('product_id', $productIDs);
   	    
        $productDetails = $this->db->get();

        if($productDetails->num_rows() > 0 )
        {
            $r1 = $productDetails->result();
            $t = array();
            foreach ($r1 as $key => $r1Item)
            {
                $t[] = $r1Item->productID;
            }
            return $t;
        }
        else
        {
        	return FALSE;
        }
    }
    public function insertDeal($start,$end,$name)
    {
    	$data = array(
        'dealName' => $name ,
        'startFrom' => $start ,
        'endOn' => $end
        );
        if($end > $start)
        {
            switch($this->db->insert('dealoftheday', $data))
            {
                case TRUE:  return $this->db->insert_id();
                    break;
                case FALSE: return NULL;
                    break;
            }
        }
        else
        {
            return FALSE;
        }
    }
    public function insertProducts( $productID, $productPrice, $dealID )
    {    
    	$data = array(
        'product_id' => $productID ,
        'dealID' => $dealID ,
        'dodPrice' => $productPrice
        );
        switch($this->db->insert('dod_products', $data))
        {
            case TRUE:
                return $productID;
                break;
            case FALSE:
                return NULL;
        }
    }
    public function dealsDetail()
    {
        $this->db->select('dealoftheday.dealID');
        $this->db->select('dealoftheday.dealName');
        $this->db->select('FROM_UNIXTIME(dealoftheday.startFrom) as startsON');
        $this->db->select('FROM_UNIXTIME(dealoftheday.endOn) as endsON');
        $this->db->from('dealoftheday');
        $data = $this->db->get();
        switch($data->num_rows() > 0)
        {
            case TRUE: 
                return $data->result();
                break;
            case FALSE:
                return NULL;
                break;
        }
    }
    public function countDeal($dealID)
    {
        $this->db->select('COUNT(dod_products.product_id) as maxID ');
        $this->db->from('dod_products');
        $this->db->where('dod_products.dealID',$dealID);
        $data = $this->db->get();
        switch($data->num_rows>0)
        {
            case TRUE:
                $maxID = $data->result();
                $maxID = $maxID[0]->maxID;
                return $maxID;
                break;
            case FALSE:
                return NULL;
                break;
        }
    }
    public function dealProductDeatsils($dealID,$pageNumber,$maxResults)
    {
        $this->db->select('products.product_name as productName');
        $this->db->select('dod_products.product_id as productID');
        $this->db->select('products.store_id as storeID');
        $this->db->select('store_info.store_name as storeName');
        $this->db->join('dod_products','products.product_id = dod_products.product_id','left');
        $this->db->join('store_info','products.store_id = store_info.store_id','left');
        $this->db->from('products');
        $this->db->where('dod_products.dealID',$dealID);
        $this->db->limit($maxResults,($maxResults*$pageNumber));
        $data = $this->db->get();
        switch($data->num_rows() >0)
        {
            case TRUE:
                return $data->result();
                break;
            case FALSE:
                return NULL;
                break;
        }
    }
    public function deleteDealDetails($dealID)
    {
        $tables = array('dod_products', 'dealoftheday');
        $this->db->where('dealID', $dealID);
        switch($this->db->delete($tables))
        {
            case TRUE:
                return TRUE;
                break;
            case FALSE:
                return FALSE;
                break;
        }
    }
    public function deleteProduct($productID)
    {
        $this->db->where('product_id', $productID);
        switch($this->db->delete('dod_products'))
        {
            case TRUE:
                return TRUE;
                break;
            case FASLE:
                return FALSE;
                break;
        }
    }
    public function categoryName()
    {
        $this->db->select('catagories.category_name');
        $this->db->select('catagories.category_id');
        $this->db->from('catagories');
        $this->db->where('catagories.status',1);
        $categoryDetails = $this->db->get();
        switch($categoryDetails->num_rows() > 0)
        {
           case TRUE:
                return $categoryDetails->result();
                break;
            case FALSE:
                return FALSE;
                break;
        }
    }
    public function getUserID($userEmail)
    {
        $this->db->select('user_details.user_id as userID');
        $this->db->from('user_details');
        $this->db->like('user_details.email',$userEmail);
        $data = $this->db->get();
        log_message('INFO', "vc_orders/purchaseMailDetails JUST RAN THE QUERY___________\r\n".$this->db->last_query());
        switch($data->num_rows == 1)
        {
            case TRUE:
                $userID = $data->result();
                $userID = $userID[0]->userID;
                return $userID;
                break;
            case FASLE:
                return FALSE;
                break;
        }
    }
    public function createCoupon($couponID,$percentOff,$useCount,$discountType,$validFrom,$validUpto,$minimumPurchaseAmount,$userID,$parameter,$visibility)
    {
        $data = array('couponid' => $couponID,
                 'percentoff' => $percentOff,
                 'usecount' => $useCount,
                 'discounttype' => $discountType,
                 'validFrom' => $validFrom,
                 'validUpto' => $validUpto,
                 'minPurchaseAmount' => $minimumPurchaseAmount,
                 'user_id' => $userID,
                 'param1' => $parameter,
                 'visibility' => $visibility
                );
        switch($this->db->insert('coupon',$data))
        {
            case TRUE:
                return TRUE;
                break;
            case FASLE:
                return FALSE;
                break;
        }
    }
    public function deleteCouponDetails($couponID)
    {
        $this->db->like('coupon.couponid', $couponID);
        switch($this->db->delete('coupon'))
        {
            case TRUE:
                return TRUE;
                break;
            case FALSE:
                return FALSE;
                break;
        }
    }
    public function changeValidity($validUpto,$couponID,$visibility)
    {
        $data = array('validUpto' => $validUpto,
                      'visibility' => $visibility);
        $this->db->where('couponid',$couponID);
        switch($this->db->update('coupon',$data))
        {
            case TRUE:
                log_message('INFO', "Check_products/changeValidity JUST RAN THE QUERY___________\r\n".$this->db->last_query());
                return TRUE;
                break;
            case FASLE:
                log_message('INFO', "Check_products/changeValidity JUST RAN THE QUERY___________\r\n".$this->db->last_query());
                return FALSE;
                break;
        }
    }
    public function checkCouponID($couponID)
    {
        $this->db->select('coupon.couponid as couponID');
        $this->db->from('coupon');
        $this->db->like('coupon.couponid',$couponID);
        $data = $this->db->get();
        switch($data->num_rows > 0)
        {
            case TRUE:
                return TRUE;
                break;
            case FALSE:
                return FALSE;
                break;
        }
    }
    public function checkCouponValidityModel($couponID)
    {
        $this->db->select('FROM_UNIXTIME(coupon.validUpto) as validUpto');
        $this->db->from('coupon');
        $this->db->like('coupon.couponid',$couponID);
        $data = $this->db->get();
        switch($data->num_rows>0) 
        {
            case TRUE:
                $valid = $data->result();
                $valid = $valid[0]->validUpto;
                return $valid;
                break;
            case FASLE:
                return FALSE;
                break;
        }
    }
}
?>