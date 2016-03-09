<?php
class Search_m extends CI_Model
{
    protected $finalResult = array();
    protected $retProductVal = array();
    protected $retStoreVal = array();
    protected $retUserVal = array();
    
    public function __construct()
	{
		parent::__construct();
        $this->load->model('slog');
	}

    public function termArray($term)
    {
       // log_message('INFO', 'search_m/termArray fired from '.$this->input->ip_address()." with \$term = ".$term);
        $str = explode(" ",$term);
        $finalProductArray = array();
        $checkProductArray = array();
        $simpleProductArray = array();
        $checkedProductArray = array();
        $uniqueProductArray = array();
        foreach ($str as $key => $value)
        {
         $simpleProductArray = $this->search_result($value);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$simpleProductArray) SEARCH_M/TERMARRAY IS_____".print_r($simpleProductArray, TRUE));
         $checkProductArray = array_intersect($finalProductArray, $simpleProductArray);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$checkProductArray) SEARCH_M/TERMARRAY IS_____".print_r($checkProductArray, TRUE));
         $checkedProductArray = array_merge($checkProductArray, $simpleProductArray);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$checkedProductArray) SEARCH_M/TERMARRAY IS_____".print_r($checkedProductArray, TRUE));
         $finalProductArray = array_merge($checkedProductArray, $finalProductArray);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$finalProductArray) SEARCH_M/TERMARRAY IS_____".print_r($finalProductArray, TRUE));
         $simpleProductArray = NULL;
        }
        
        foreach ($str as $key => $value)
        {
         $simpleProductArray = $this->search_result1($value);
       //  log_message("INFO", "DATA BEING RETURNED FROM(\$simpleProductArray1) SEARCH_M/TERMARRAY IS_____".print_r($simpleProductArray, TRUE));
         $finalProductArray = array_merge($finalProductArray, $simpleProductArray);
        // log_message("INFO", "DATA BEING RETURNED FROM(\$finalProductArray1) SEARCH_M/TERMARRAY IS_____".print_r($finalProductArray, TRUE));
         $simpleProductArray = NULL;
        }

        //log_message("INFO", "DATA BEING RETURNED BEFORE UNIQUE FROM(\$finalProductArray2) SEARCH_M/TERMARRAY IS_____".print_r($finalProductArray, TRUE));
        $uniqueProductArray = array();
        $uniqueProductArray = array_unique($finalProductArray);
        //log_message("INFO", "DATA BEING RETURNED AFTER UNIQUE FROM(\$uniqueProductArray) SEARCH_M/TERMARRAY IS_____".print_r($uniqueProductArray, TRUE));
        //$this->slog->write( array( 'level' => 1, 'msg' =>"DATA BEING RETURNED AFTER UNIQUE FROM(\$uniqueProductArray) SEARCH_M/TERMARRAY IS_____".print_r($uniqueProductArray, TRUE)));

        $this->finalResult = $this->details($uniqueProductArray);
        return $this->finalResult;
     }

    public function termArray1($term)
    {
        //log_message('INFO', 'search_m/termArray1 fired from '.$this->input->ip_address()." with \$term = ".$term);
        $str = explode(" ",$term);
        $finalStoreArray = array();
        $checkStoreArray = array();
        $simpleStoreArray = array();
        $checkedStoreArray = array();
        $uniqueStoreArray = array();
        $finalstoreResult = array();
        
        foreach ($str as $key => $value) 
        {
         $simpleStoreArray = $this->search_result2($value);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$simpleStoreArray) SEARCH_M/TERMARRAY IS_____".print_r($simpleStoreArray, TRUE));
         //$this->slog->write( array( 'level' => 1, 'msg' => "DATA BEING RETURNED FROM(\$simpleStoreArray) SEARCH_M/TERMARRAY IS_____".print_r($simpleStoreArray, TRUE)));
         $checkStoreArray = array_intersect($finalStoreArray,$simpleStoreArray);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$checkStoreArray) SEARCH_M/TERMARRAY IS_____".print_r($checkStoreArray, TRUE));
         $checkedStoreArray = array_merge($checkStoreArray, $simpleStoreArray);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$checkedStoreArray) SEARCH_M/TERMARRAY IS_____".print_r($checkedStoreArray, TRUE));
         $finalStoreArray = array_merge($checkedStoreArray, $finalStoreArray);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$finalStoreArray) SEARCH_M/TERMARRAY IS_____".print_r($finalStoreArray, TRUE));
         $simpleStoreArray = NULL;
        }

        foreach ($str as $key => $value) 
        {
         $simpleStoreArray = $this->search_result3($value);
         //log_message("INFO", "DATA BEING RETURNED FROM(\$simpleStoreArray2) SEARCH_M/TERMARRAY IS_____".print_r($simpleArray, TRUE));
         $finalStoreArray = array_merge($finalStoreArray, $simpleStoreArray);
        // log_message("INFO", "DATA BEING RETURNED FROM(\$finalStoreArray2) SEARCH_M/TERMARRAY IS_____".print_r($finalStoreArray, TRUE));
         $simpleStoreArray = NULL;    
        }
        
       // log_message("INFO", "DATA BEING RETURNED BEFORE UNIQUE FROM(\$finalStoreArray3) SEARCH_M/TERMARRAY IS_____".print_r($finalStoreArray, TRUE));
        $uniqueStoreArray = array();
        $uniqueStoreArray = array_unique($finalStoreArray);
        //log_message("INFO", "DATA BEING RETURNED AFTER UNIQUE FROM(\$uniqueStoreArray) SEARCH_M/TERMARRAY IS_____".print_r($uniqueStoreArray, TRUE));

        $allStores = $this->details1($uniqueStoreArray);
        foreach ($allStores as $key => $value) 
        {
            $mostFancied = $this->details2($value->storeID);
            $finalstoreResult[] = array("storeDetails" => $value, "storeProducts" => $mostFancied);
        }
        return $finalstoreResult;
  
    }

    public function searchUsers( $term )
    {
       //log_message('INFO', 'search_m/termArray2 fired from '.$this->input->ip_address()." with \$term = ".$term);
        $str = explode( " ",$term );
        $strLen = count( $str );

        $finalUserArray = array();
        $checkUserArray = array();
        $simpleUserArray = array();
        $checkedUserArray = array();
        $uniqueUserArray = array();
        $finalUserResult = array();

        foreach ($str as $key => $value)
        for( $iii = 0; $iii < $strLen; $iii++ )
        {
            $simpleUserArray = $this->searchByName($value);
            //log_message("INFO", "DATA BEING RETURNED FROM(\$simpleUserArray) SEARCH_M/TERMARRAY IS_____".print_r($simpleUserArray, TRUE));
            $checkUserArray = array_intersect($finalUserArray,$simpleUserArray);
            //log_message("INFO", "DATA BEING RETURNED FROM(\$checkUserArray) SEARCH_M/TERMARRAY IS_____".print_r($checkUserArray, TRUE));
            $checkedUserArray = array_merge($checkUserArray, $simpleUserArray);
            //log_message("INFO", "DATA BEING RETURNED FROM(\$checkedUserArray) SEARCH_M/TERMARRAY IS_____".print_r($checkedUserArray, TRUE));
            $finalUserArray = array_merge($checkedUserArray, $finalUserArray);
            //log_message("INFO", "DATA BEING RETURNED FROM(\$finalUserArray) SEARCH_M/TERMARRAY IS_____".print_r($finalUserArray, TRUE));
            $simpleUserArray = NULL;  
        }

        for( $iii = 0; $iii < $strLen; $iii++ )
        {
            if( filter_var( $str[$iii], FILTER_VALIDATE_EMAIL ) )
            {
                $simpleUserArray = $this->searchByEmail( $str[$iii] );
                $finalUserArray = array_merge($finalUserArray, $simpleUserArray);
                $simpleUserArray = NULL;
            }
        }
        
        
        //log_message("INFO", "DATA BEING RETURNED BEFORE UNIQUE FROM(\$finalUserArray2) SEARCH_M/TERMARRAY IS_____".print_r($finalUserArray, TRUE));
        $uniqueUserArray = array();
        $uniqueUserArray = array_unique($finalUserArray);
        //log_message("INFO", "DATA BEING RETURNED AFTER UNIQUE FROM(\$uniqueUserArray) SEARCH_M/TERMARRAY IS_____".print_r($uniqueUserArray, TRUE));

        $allUser = $this->details3($uniqueUserArray);
        foreach ($allUser as $key => $value) 
        {
            $mostFancied = $this->details4($value->userID);
            $finalUserResult[] = array("userDetails" => $value, "productDetails" => $mostFancied);
        }
        return $finalUserResult; 
   
    }
    public function countProduct($term)
    {
        $str = explode(" ",$term);
        $finalProductArray = array();
        $checkProductArray = array();
        $simpleProductArray = array();
        $checkedProductArray = array();
        $uniqueProductArray = array();
        $finalProductResult = array();
        
        foreach ($str as $key => $value)
        {
         $simpleProductArray = $this->search_result($value);
         $checkProductArray = array_intersect($finalProductArray, $simpleProductArray);
         $checkedProductArray = array_merge($checkProductArray, $simpleProductArray);
         $finalProductArray = array_merge($checkedProductArray, $finalProductArray);
         $simpleProductArray = NULL;
        }
        
        foreach ($str as $key => $value)
        {
         $simpleProductArray = $this->search_result1($value);
         $finalProductArray = array_merge($finalProductArray, $simpleProductArray);
         $simpleProductArray = NULL;
        }
        $uniqueProductArray = array();
        $uniqueProductArray = array_unique($finalProductArray);
        $finalProductResult = $this->details($uniqueProductArray);
        if(is_array($finalProductResult) && count($finalProductResult) >= 1)
        {
          $productCount = count($finalProductResult);
          return $productCount;
        }
        else
        {
            return NULL;
        }

          
    }
    public function countStore($term)
    {
        $str = explode(" ",$term);
        $finalStoreArray = array();
        $checkStoreArray = array();
        $simpleStoreArray = array();
        $checkedStoreArray = array();
        $uniqueStoreArray = array();
        $finalstoreResult = array();
        
        foreach ($str as $key => $value) 
        {
         $simpleStoreArray = $this->search_result2($value);
         $checkStoreArray = array_intersect($finalStoreArray,$simpleStoreArray);
         $checkedStoreArray = array_merge($checkStoreArray, $simpleStoreArray);
         $finalStoreArray = array_merge($checkedStoreArray, $finalStoreArray);
         $simpleStoreArray = NULL;
        }
        foreach ($str as $key => $value) 
        {
         $simpleStoreArray = $this->search_result3($value);
         $finalStoreArray = array_merge($finalStoreArray, $simpleStoreArray);
         $simpleStoreArray = NULL;    
        }
        $uniqueStoreArray = array();
        $uniqueStoreArray = array_unique($finalStoreArray);
        $finalstoreResult = $this->details1($uniqueStoreArray);
        if(is_array($finalstoreResult) && count($finalstoreResult) >= 1)
        {
          $storeCount = count($finalstoreResult);
          return $storeCount;
        }
        else 
        {
            return NULL;
        }
          
    }
    public function countUser($term)
    {
        $str = explode(" ",$term);
        $finalUserArray = array();
        $checkUserArray = array();
        $simpleUserArray = array();
        $checkedUserArray = array();
        $uniqueUserArray = array();
        $finalUserResult = array();
        

        foreach ($str as $key => $value) 
        {
         $simpleUserArray = $this->searchByName($value);
         $checkUserArray = array_intersect($finalUserArray,$simpleUserArray);
         $checkedUserArray = array_merge($checkUserArray, $simpleUserArray);
         $finalUserArray = array_merge($checkedUserArray, $finalUserArray);
         $simpleUserArray = NULL;  
        }

        foreach ($str as $key => $value) 
        {
         $simpleUserArray = $this->searchByEmail($value);
         $finalUserArray = array_merge($finalUserArray, $simpleUserArray);
         $simpleUserArray = NULL;    
        }
        $uniqueUserArray = array();
        $uniqueUserArray = array_unique($finalUserArray);
        $finalUserResult = $this->details3($uniqueUserArray);
        if(is_array($finalUserResult) && count($finalUserResult) >= 1)
        {
          $userCount = count($finalUserResult);
          return $userCount;
        }
        else 
        {
            return NULL;
        }
           
    }

	public function search_result($value)
	{
        
        
        $retProductVal['resultSet'] = NULL;

        $simple_array = array();
  	    $this->db->select('products.product_id');
  	    $this->db->from('products');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->like('products.product_name',$value,'after'); 
        $this->db->or_like('products.product_name',$value,'both');
        $this->db->or_like('products.product_name',$value,'before');
        $query = $this->db->get();
        //log_message('INFO','show result.____'.$this->db->last_query());
        switch($query->num_rows() > 0)
        {
        case TRUE: $retProductVal["resultSet"] = $query->result();
        
        foreach ($retProductVal["resultSet"] as $record )
        {
            $simple_array[] = $record->product_id;
            //log_message('INFO','show result.____'.print_r($simple_array,TRUE));
            $this->slog->write( array( 'level' => 1, 'msg' => 'show result.____'.print_r($simple_array,TRUE)));
        }
        break;
        }
        return $simple_array;
    }
        
        //log_message('INFO','Results After searching by name____'.print_r($retVal["resultSet"],TRUE));

        //$this->db->select('products.tags'); 
    public function search_result1($value)
    {

        $retProductVal['resultset1'] = NULL;

        $simple_array = array();

        $this->db->select('products.product_id');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->like('products.tags',$value, 'after');
        $this->db->or_like('products.tags',$value,'both');
        $this->db->or_like('products.tags',$value,'before');
        $query1= $this->db->get();
        //log_message("INFO", "just ran the following query_____\r\n".$this->db->last_query());

        switch($query1->num_rows()>0)
        {
    	case TRUE: $retProductVal["resultset1"] = $query1->result();
        foreach ($retProductVal["resultset1"] as $record )
        {
            $simple_array[] = $record->product_id;
            //log_message('INFO','show result2.____'.print_r($simple_array,TRUE));
           //$this->slog->write( array( 'level' => 1, 'msg' => 'show result.____'.print_r($simple_array,TRUE)));
        }
        break;
        }
        return $simple_array;
    }
    
        //log_message('INFO','Results After searching by tags____'.print_r($retVal["resultset1"],TRUE));
    
    public function search_result2($value)
    {   
        $retStoreVal['resultSet'] = NULL;

        $simple_array = array();

        $this->db->select('store_info.store_id');
        $this->db->from('store_info');
        $this->db->where('isPublished', 1);
        $this->db->like('store_info.store_name', $value, 'after');
        $this->db->or_like('store_info.store_name', $value, 'both');
        $this->db->or_like('store_info.store_name', $value, 'before');
        $query2 = $this->db->get();

        switch($query2->num_rows()>0)
        {
    	case TRUE: $retStoreVal["resultset"] = $query2->result();
        foreach ($retStoreVal["resultset"] as $record )
        {
            $simple_array[] = $record->store_id;
            //log_message('INFO','show result.____'.print_r($simple_array,TRUE));
            //$this->slog->write( array( 'level' => 1, 'msg' => 'show result.____'.print_r($simple_array,TRUE)));
        }
        break;
        }
        return $simple_array;
    }

        //log_message('INFO','Results After searching in description____'.print_r($retVal["resultset2"],TRUE));
    
    public function search_result3($value)
    {
        $retStoreVal['resultset1'] = NULL;

        $simple_array = array();

        /*$this->db->select('store_info.store_id');
        $this->db->from('store_info');
        $this->db->where('isPublished', 1);
        $this->db->like('store_info.seo_tags',$value, 'after');
        $this->db->or_like('store_info.seo_tags',$value, 'both');
        $this->db->or_like('store_info.seo_tags',$value, 'before');*/

        /* OPTIMIZED QUERY AS WE NOW HAVE A FULLTEXT INDEX ON THE seo_tags column */

        $q3 = "SELECT `store_id` FROM `store_info` WHERE isPublished = 1 AND MATCH(`seo_tags`) AGAINST(".$this->db->escape( $value ).")";
        $query3 = $this->db->query( $q3 );

        switch($query3->num_rows()>0)
        {
        case TRUE: $retStoreVal["resultset1"] = $query3->result();
        foreach ($retStoreVal["resultset1"] as $record )
        {
            $simple_array[] = $record->store_id;
            //log_message('INFO','show result.____'.print_r($simple_array,TRUE));
            //$this->slog->write( array( 'level' => 1, 'msg' => 'show result.____'.print_r($simple_array,TRUE)));
        }
        break;
        }
        return $simple_array;
    }
    

        //log_message('INFO','Results After searching in whats_in_the_box____'.print_r($retVal["resultset2"],TRUE));
        
        //log_message("INFO", "DATA BEING RETURNED FROM(\$retVal) SEARCH_M/SEARCH_RESULT IS_____".print_r($retVal, TRUE));
        //echo "<h2>value of simple array before applying array unique</h2><pre>",print_r ($simple_array),"</pre>";
        //$uniqueResult = array();
        //$uniqueResult = array_unique($simple_array);
        //echo "<h2>value of simple array after applying array unique</h2><pre>",print_r ($uniqueResult,TRUE);"</pre>";
        //log_message("INFO", "DATA BEING RETURNED FROM(\$uniqueResult) SEARCH_M/SEARCH_RESULT_____".print_r($uniqueResult, TRUE));
        //log_message("INFO", "Now reading details for the products read from DB++++++++++++++++++++++++++++++++++++++++++++++++");
        //log_message("INFO", "DATA BEING RETURNED FROM(\$finalResult) SEARCH_M/SEARCH_RESULT______".print_r($finalResult, TRUE));
        //return $uniqueResult;
    public function searchByName($value)
    {
        $retUserVal['resultset'] = NULL;

        $simple_array = array();

        $q4 = "SELECT `user_details`.`user_id` FROM `user_details` WHERE `full_name` LIKE '".$this->db->escape_like_str( $value )."%' OR `full_name` LIKE '%".$this->db->escape_like_str( $value )."%' OR `full_name` LIKE '%".$this->db->escape_like_str( $value )."' AND isActive = 1 AND rFlowStatus = 6";
        
        $query4 = $this->db->query( $q4 );

        $q4NumRows = $query4->num_rows();

        switch( $q4NumRows > 0 )
        {
            case TRUE:  $retUserVal["resultset"] = $query4->result();
                        for( $iii = 0; $iii < $q4NumRows; $iii++ )
                        {
                            $simple_array[] = $retUserVal['resultset'][$iii]->user_id;
                        }
                break;
        }

        return $simple_array;
    }

    public function searchByEmail($value)
    {
        $retUserVal['resultset1'] = NULL;

        $simple_array = array();

        /*$this->db->select('user_details.user_id');
        $this->db->from('user_details');
        $this->db->like('user_details.email',$value,'after');
        $this->db->or_like('user_details.email',$value,'both');
        $this->db->or_like('user_details.email',$value,'before');*/
        /*
        THE ABOVE METHOD OF SEARCHING BY EMAIL IS UNNECESSARY AS IT CAN SEARCH AN EMAIL
        EVEN WHEN A PART OF THEIR EMAIL ADDRESS HAS BEEN PROVIDED THEREBY RAISING PRIVACY CONCERNS.
        FROM NOW ON, WE WILL ONLY FIND EXACT MATCHES
        */
        $q5 = "SELECT `user_id` FROM `user_details` WHERE `email` = ".$this->db->escape( $value );

        $query5 = $this->db->query( $q5 );

        $q5NumRows = $query5->num_rows();

        switch( $q5NumRows > 0 )
        {
            case TRUE:  $retUserVal["resultset1"] = $query5->result();
                        for($iii = 0; $iii < $q5NumRows; $iii++ )
                        {
                            $simple_array[] = $retUserVal['resultset1'][$iii]->user_id;
                        }
                break;
        }

        return $simple_array;      
    }

    public function details($uniqueProductArray)
    {
        $whereText = NULL;
        /*$i = 0;
        foreach($uniqueResult as $key => $value)
        {
            if(is_null($value))
            {
                continue;
            }

            if($i === 0)
            {
                $whereText =  "product_id = ".$value;
            }
            else
            {
                $whereText .= " OR product_id = ".$value;
            } 
            $i++;
        }*/
        $orderBy = FALSE;
        if(is_array($uniqueProductArray) && count($uniqueProductArray) > 0)
        {
            if(count($uniqueProductArray) >  1)
            {
                $pids = implode(",", $uniqueProductArray);
                $whereText = "product_id IN (".$pids.") ORDER BY FIELD(product_id,".$pids.")";
                $orderBy = TRUE;
            }
            else
            {
                $arrayKeyData = each($uniqueProductArray); // read the current key of $uniqueResult
                $arrayKeyValue = $arrayKeyData["value"]; // get the value in the current key
                $whereText = "product_id = ".$arrayKeyValue; // append the Value
            }
        }
        log_message("INFO", "whereText FROM SEARCH_M/DETAILS_____".print_r($whereText, TRUE));
        if($whereText === NULL || $whereText === "")
        {
            return NULL;
        }
        $this->db->select('products.product_id AS productID');
        $this->db->select('products.store_id AS storeID');
        $this->db->select('products.product_name productName');
        $this->db->select('store_info.store_name AS storeName');
        $this->db->select('products.visit_counter AS productVisitCounter');
        $this->db->select('products.brag_counter AS productBragCounter');
        $this->db->select('products.fancy_counter AS productFancyCounter');
        $this->db->select('products.discount AS productDiscount');
        $this->db->select('products.selling_price AS productSellingPrice');
        $this->db->select('products.bbucks AS bbucks');
        $this->db->select('products.quantity AS productQuantity');
        $this->db->select('products.is_on_discount AS productIsOnDiscount');
        $this->db->from('products');
        $this->db->join('store_info', 'products.store_id = store_info.store_id', 'left');
        $this->db->where('status', 1);
        $this->db->where('is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->where($whereText);
        /*switch($orderBy)
        {
            case TRUE: $this->db->order_by("field(product_id,".$pids.")")
        }*/
        $finalValue = $this->db->get();
        log_message("INFO", "just ran the following query_____\r\n".$this->db->last_query());
        if($finalValue->num_rows()>0)
        {
            log_message("INFO", "ABOVE Query Returned the following_____\r\n".json_encode($finalValue->result(), JSON_FORCE_OBJECT));
            return $finalValue->result();
        }
    }

    public function details1($uniqueStoreArray) 
    {
        $whereText = NULL;
        //$orderBy = FALSE;
        if(is_array($uniqueStoreArray) && count($uniqueStoreArray) >= 1)
        {
              $whereText = $uniqueStoreArray;
              $pids = implode(",", $uniqueStoreArray);
              
                //$whereText = "store_info.store_id IN (".$pids.") ORDER BY FIELD(store_id,".$pids.")";
                //$whereText = " IN (".$pids.")";
                //$whereText = $pids;
                //$orderBy = TRUE;
        }
        //log_message("INFO", "whereText FROM SEARCH_M/DETAILS1_____".print_r($whereText, TRUE));
        //$this->slog->write( array( 'level' => 1, 'msg' => "whereText FROM SEARCH_M/DETAILS1_____".print_r($whereText, TRUE)));
        if($whereText === NULL || $whereText === "")
        {
            return NULL;
        }
        $this->db->select('store_info.store_id AS storeID');
        $this->db->select('store_info.visit_counter AS storeVisitCounter');
        $this->db->select('store_info.fancy_counter AS storeFancyCounter');
        $this->db->select('store_info.store_name AS storeName');
        $this->db->select('store_info.brag_counter AS storeBragCounter');
        $this->db->select('store_info.about_store');
        $this->db->select('(SELECT COUNT(product_id) FROM products WHERE products.store_id = store_info.store_id) AS totalProducts');
        $this->db->select('(SELECT SUM(p2.fancy_counter) FROM products p2 WHERE p2.store_id = store_info.store_id) AS totalFancied');
        $this->db->select('(SELECT SUM(p3.visit_counter) FROM products p3 WHERE p3.store_id = store_info.store_id) AS totalVisits');
        $this->db->from('store_info');
        $this->db->where_in('store_info.store_id',$whereText);
        $this->db->where('store_info.isPublished = 1 ORDER BY FIELD(store_info.store_id,'.$pids.')');
        $finalValue = $this->db->get();
        //$this->slog->write( array( 'level' => 1, 'msg' => "just ran the following query_____".PHP_EOL.$this->db->last_query()));
        //$this->db->select('products.product_id AS productID');
        //$this->db->select('products.product_name AS productName');
        //$this->db->from('products');
        //$this->db->join('products','store_info.store_id = products.store_id', 'left');
        //$this->db->join('store_owner', 'store_info.store_id = store_owner.store_id', 'left');
        //$this->db->where('status', 1);
        ///$this->db->where('is_enable',0);
        //$this->db->where('store_id',$whereText);
        //$this->db->order_by('fancy_counter','desc');
        //$this->db->limit(3);
        //$finalValue = $this->db->get();
        //log_message("INFO", "just ran the following query_____\r\n".$this->db->last_query());
        //$this->slog->write( array( 'level' => 1, 'msg' => "just ran the following query_____".PHP_EOL.$this->db->last_query()));
        if($finalValue->num_rows()>0)
        {
            return $finalValue->result();
        }
        
    }

    public function details2($uniqueStore)
    {
        $whereText = NULL;
        //$orderBy = FALSE;
        if(count($uniqueStore)>= 1)
        {
                //$pids = implode(",", $uniqueStoreArray);
                $whereText = $uniqueStore;
               // $whereText = " IN (".$pids.")";
                //$orderBy = TRUE;
        }
        //log_message("INFO", "whereText FROM SEARCH_M/DETAILS1_____".print_r($whereText, TRUE));
        if($whereText === NULL || $whereText === "")
        {
            return NULL;
        }
        $this->db->select('products.product_id AS productID');
        $this->db->select('products.product_name AS productName');
        $this->db->from('products');
        $this->db->where('status', 1);
        $this->db->where('is_enable',0);
        $this->db->where('products.quantity > 0');
        $this->db->where('products.store_id',$whereText);
        $this->db->order_by('fancy_counter','desc');
        $this->db->limit(3);
        $finalValue = $this->db->get();
        if($finalValue->num_rows()>0)
        {
            return $finalValue->result();
        }
        
        
    }

    public function details3($uniqueUserArray) 
    {
        $whereText = NULL;
        if(is_array($uniqueUserArray) && count($uniqueUserArray) >= 1)
        {
                $pids = implode(",", $uniqueUserArray);
                $whereText = $uniqueUserArray;
        }
        if($whereText === NULL || $whereText === "")
        {
            return NULL;
        }
        $this->db->select('user_details.user_id AS userID');
        $this->db->select('user_details.fb_uid AS userFBID');
        $this->db->select('user_details.full_name AS userFullName');
        $this->db->select('user_details.nick_name AS userNickName');
        $this->db->select('user_details.gender AS userGender');
        $this->db->select('user_details.city AS userCity');
        $this->db->select('user_details.country AS userCountry');
        $this->db->select('user_details.date_of_birth AS userDOB');
        $this->db->select('user_details.interested_in AS userInterest');
        $this->db->select('user_details.state AS userState');
        $this->db->select('user_details.fancy_counter AS totalFanciedProducts');
        $this->db->select('(SELECT COUNT(follow_friends.f_no) FROM follow_friends WHERE follow_friends.followee_id = user_details.user_id) as totalFollowers');
        $this->db->select('(SELECT COUNT(follow_friends.f_no) FROM follow_friends WHERE follow_friends.follower_id = user_details.user_id) as totalFollowing');
        $this->db->from('user_details');
        $this->db->where_in('user_details.user_id',$whereText);
        $this->db->where('user_details.isActive = 1 ORDER BY FIELD(user_details.user_id,'.$pids.')');
        $finalValue = $this->db->get();
        log_message("INFO", "just ran the following query_____\r\n".$this->db->last_query());
        if($finalValue->num_rows()>0)
        {
            log_message("INFO", "ABOVE Query Returned the following_____\r\n".json_encode($finalValue->result(), JSON_FORCE_OBJECT));
            return $finalValue->result();
        }
        
    }
    public function details4($uniqueUser)
    {
        $whereText = NULL;
        if(count($uniqueUser)>= 1)
        {
                $whereText = $uniqueUser;
        }
        if($whereText === NULL || $whereText === "")
        {
            return NULL;
        }
        $this->db->select('fancy_products.product_id AS productID');
        $this->db->select('products.product_name AS productName');
        $this->db->select('products.store_id AS storeID');
        $this->db->select('(products.fancy_counter)+(products.brag_counter)+(products.visit_counter) AS mostPopular');
        $this->db->from('fancy_products');
        $this->db->join('products','fancy_products.product_id = products.product_id','left');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->where('fancy_products.user_id',$whereText);
        $this->db->order_by('mostPopular','desc');
        $this->db->limit(3);
        $finalValue = $this->db->get();
        if($finalValue->num_rows()>0)
        {
            return $finalValue->result();
        }
    }

    public function storeTerm($term,$current,$userID)
    {
        $data = array(
                     'user_id' => $userID ,
                     'keyword' => $term ,
                     'ts' => $current
                     );
       return $this->db->insert('search_history',$data);
    }

   /* public function unique_id($output)
    {
        $result = array_map("unserialize", array_unique(array_map("serialize", $output)));

        foreach ($result as $key => $value)
    {
        if ( is_array($value) )
        {   log_message('INFO','show result.____'.$this->db->last_query());
            $result[$key] = array_unique($value);
            log_message("INFO", "DATA BEING RETURNED FROM SEARCH_M/SEARCH_RESULT IS_____".print_r($result, TRUE));
        }
    }

    return $result;
    }*/
    public function searchSuggestions($term)
    {
        $i = 0;
        $j = 0;
        $k = 0;
        $l = 0;
        $retVal['resultSet'] = NULL;
        $retVal['resultset1'] = NULL;
        $retVal['resultset2'] = NULL;
        $retVal['resultset3'] = NULL;
        
        $this->db->select('products.product_id');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->like('products.product_name',$term,'after'); 
        $this->db->or_like('products.product_name',$term,'both');
        $this->db->or_like('products.product_name',$term,'before');
        $query = $this->db->get();
        switch($query->num_rows() > 0)
    {
        case TRUE: $retVal["resultSet"] = $query->result();
        
        foreach ($retVal["resultSet"] as $record )
        {
            
            $simple_array[] = $record->product_id;
            if(++$i == 10)
            {
                //return $simple_array;
                log_message('INFO','show result.____'.print_r($simple_array,TRUE));
                break;
            }
        }
        break;
    }    
        //$this->db->select('products.tags');
        $this->db->select('products.product_id');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->like('products.tags', $term, 'after');
        $this->db->or_like('products.product_name',$term,'both');
        $this->db->or_like('products.product_name',$term,'before');
        $query1= $this->db->get();

        switch($query1->num_rows()>0)
    {
        case TRUE: $retVal["resultset1"] = $query1->result();
        foreach ($retVal["resultset1"] as $record )
        {
            $simple_array[] = $record->product_id;
            if(++$j == 10)
            {
                //return $simple_array;
                log_message('INFO','show result.____'.print_r($simple_array[0],TRUE));
                break;
            }
        }
        break;
    }
        /*$this->db->select('products.product_id');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->like('products.description',$term,'after'); 
        $this->db->or_like('products.description',$term,'both');
        $this->db->or_like('products.description',$term,'before');*/

        /* OPTIMIZED QUERY TO UTILIZE THE FULLTEXT INDEX */

        $q2 = "SELECT `product_id` FROM `products` WHERE `status` = 1 AND `is_enable` = 0 AND MATCH( `description` ) AGAINST(".$this->db->escape( $term ).")";
        $query2 = $this->db->query( $q2 );

        switch( $query2->num_rows() > 0 )
    {
        case TRUE: $retVal["resultset2"] = $query2->result();
        foreach ($retVal["resultset2"] as $record )
        {
            $simple_array[] = $record->product_id;
            if(++$k == 10)
            {
                //return $simple_array;
                log_message('INFO','show result.____'.print_r($simple_array[10],TRUE));
                break;
            }
        }
        break;
    }
        /*$this->db->select('pDesc.refproductID AS product_id');
        $this->db->from('pDesc');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->like('pDesc.whats_in_the_box',$term, 'after');
        $this->db->or_like('pDesc.whats_in_the_box',$term,'both');
        $this->db->or_like('pDesc.whats_in_the_box',$term,'before');*/

        /* OPTIMIZED QUERY TO UTILIZE THE FULLTEXT INDEX */

        $q3 = "SELECT `refproductID` AS `product_id` FROM `pDesc` WHERE `status` = 1 AND `is_enable` = 0 AND MATCH(`whats_in_the_box`) AGAINST(".$this->db->escape( $term ).")";

        $query3 = $this->db->query( $q3 );

        switch( $query3->num_rows() > 0 )
    {
        case TRUE: $retVal["resultset3"] = $query3->result();
        foreach ($retVal["resultset3"] as $record )
        {
            $simple_array[] = $record->product_id;
            if(++$l == 10)
            {
                //return $simple_array;
                //log_message('INFO','show result.____'.print_r($simple_array[20],TRUE));
                break;
            }
        }
        break;
    }
        //log_message('INFO','Results After searching in whats_in_the_box____'.print_r($retVal["resultset3"],TRUE));
        //log_message("INFO", "DATA BEING RETURNED FROM(\$retVal) SEARCH_M/SEARCHSUGGESTIONS_____ IS_____".print_r($retVal, TRUE));
        //echo "<h2>value of simple array before applying array unique</h2><pre>",print_r ($simple_array),"</pre>";
        $uniqueResult = array();
        $uniqueResult = array_unique($simple_array);
        //echo "<h2>value of simple array after applying array unique</h2><pre>",print_r ($uniqueResult,TRUE);"</pre>";
        //log_message("INFO", "DATA BEING RETURNED FROM(\$uniqueResult) SEARCH_M/SEARCHSUGGESTIONS_____".print_r($uniqueResult, TRUE));
        //log_message("INFO", "Now reading details for the products read from DB++++++++++++++++++++++++++++++++++++++++++++++++");
        $finalSearchResult = $this->suggestionDetails($uniqueResult);
        //log_message("INFO", "DATA BEING RETURNED FROM(\$finalSearchResult) SEARCH_M/SEARCHSUGGESTIONS______".print_r($finalResult, TRUE));
        return $finalSearchResult;

    }
    public function suggestionDetails($uniqueResult)
    {
       $whereText = NULL;
       /*$m = 0;
       foreach($uniqueResult as $key =>$value)
       {
        if($m==0)
        {
            $whereText = "product_id = ".$value;
        }
        else
        {
            $whereText .= " OR product_id = ".$value;
        }  
        if(++$m == 10)
        break;
       }*/
       $orderBy = FALSE;
        if(is_array($uniqueResult) && count($uniqueResult) > 0)
        {
            if(count($uniqueResult) >  1)
            {
                $pids = implode(",", $uniqueResult);
                $whereText = "product_id IN (".$pids.") ORDER BY FIELD(product_id,".$pids.")";
                $orderBy = TRUE;
            }
            else
            {
                $arrayKeyData = each($uniqueResult); // read the current key of $uniqueResult
                $arrayKeyValue = $arrayKeyData["value"]; // get the value in the current key
                $whereText = "product_id = ".$arrayKeyValue; // append the Value
            }
        }

        log_message("INFO", "whereText FROM SEARCH_M/DETAILS_____".print_r($whereText, TRUE));
        if($whereText === NULL || $whereText === "")
        {
            return NULL;
        }

        $this->db->select('products.product_id AS productID');
        $this->db->select('products.store_id AS storeID');
        $this->db->select('products.product_name AS productName');
        $this->db->select('store_info.store_name AS storeName');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        $this->db->where('products.is_enable', 0);
        $this->db->where('products.quantity > 0');
        $this->db->join('store_info', 'products.store_id = store_info.store_id', 'left');
        $this->db->where($whereText);
        //$this->db->order_by("product_id","asc");
        /*switch($orderBy)
        {
            case TRUE: $this->db->order_by("field(product_id,".$pids.")")
        }*/
        $finalSuggestedValue = $this->db->get();
        log_message("INFO", "just ran the following query_____\r\n".$this->db->last_query());
        if($finalSuggestedValue->num_rows()>0)
        {
            log_message("INFO", "ABOVE Query Returned the following_____\r\n".json_encode($finalSuggestedValue->result(), JSON_FORCE_OBJECT));
            return $finalSuggestedValue->result();
        }
    }
}
