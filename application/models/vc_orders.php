<?php
class Vc_orders extends CI_Model {

	function Vc_orders()
        {
                // Call the Model constructor
                parent::__construct();
        }
        
        function getorderedproduct_details($limit=0, $start=0)
        {
            $uid = $this->session->userdata('id');
            $this->db->select("DATE_FORMAT(date_of_order , '%b %e, %Y') AS date_of_order", FALSE);
            $this->db->select('orders.order_id, orders.txnid, orders.amt_paid,products.product_id,products.product_name, products.selling_price, products.shipping_cost, orders.payment_status, orders.quantity, orders.status_order, store_info.store_name, store_owner.owner_name, orders.store_id, orders.comment_count, orders.awb_no');
            $this->db->from('orders');
            $this->db->join('(products,store_info,store_owner)','orders.product_id = products.product_id AND orders.store_id = store_info.store_id AND store_info.storeowner_id = store_owner.storeowner_id');
            $this->db->where('user_id',$uid);
            $this->db->order_by('orders.order_id','desc');
            $this->db->limit($limit, $start);
            $result = $this->db->get();
            return $result->result();
        }

        function get_stores_totalProducts($store_id)
        {
            $this->db->select('product_id');
            $this->db->from('products');
            $this->db->where('store_id',$store_id);
            $query = $this->db->get();
            return $query->num_rows();
        }
        
         function invoice_no($storeid,$bnb_product_code)
         {
            $this->db->select('store_info.invoice_no,company_code');
            $this->db->from('store_info');
            $this->db->where('store_id',$storeid);
            $result = $this->db->get();
            $inv_num = $result->result();
            $inv_no = $inv_num['0']->invoice_no;
            if($inv_no == '99999') {
                $this->db->set('store_info.invoice_no',1); 
                $this->db->where('store_id',$storeid);
                $this->db->update('store_info');
            }
            $n = (int)strlen($inv_no);
            $diff = 5-$n;
            $in_no = '';
            if($diff > 0 ) {
              for($i=0; $i<$diff; $i++)
                    $in_no .= '0';
            }
            $in_no .= $inv_no;
            
//            $str_code = explode('_', $bnb_product_code);
            $str_code = $inv_num['0']->company_code;
//            $invoice_no = array('invoice_no'=>$str_code[1].date('Y').$in_no);
            $invoice_no = array('invoice_no'=>$str_code.date('Y').$in_no);
            
            $this->db->set('invoice_no',"invoice_no+1", FALSE);
            $this->db->where('store_info.store_id', $storeid);
            $this->db->update('store_info');
            
            return $invoice_no['invoice_no'];
         }

        
        function place_order($temp, $data)
        {
		  log_message('INFO', "inside vc_orders/place_order");
		  log_message('INFO', " \$temp = ".print_r($temp, TRUE));
		  log_message('INFO', " \$data = ".print_r($data, TRUE));
             $prodid = $temp->product_id;
             $qty = $temp->cart_quantity;
             $userid = $temp->user_id;
             $storeid = $temp->store_id;
             $amt_paid = ($temp->is_on_discount == 1)? $temp->selling_price - $temp->discount: $temp->selling_price;
             $vcolor = $temp->vcolor;
             $vsize = $temp->vsize;
             //$discount = $temp->discount;
      			if($temp->shipping_partner != '0')
      			{
      				$shipping_partner = $temp->shipping_partner;
      			}
      			else
      			{
      				$shipping_partner = 1;
      			}

            /*
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */
            $this->db->select('processing_time');
            $this->db->from('products');
            $this->db->where('product_id', $prodid);
            $pTimeQ = $this->db->get();
            switch($pTimeQ->num_rows > 0)
            {
                case TRUE: $pTime = $pTimeQ->result();
                            $pTime = $pTime[0]->processing_time + 5;
                    break;
                case FALSE: $pTime = 10;
                    break;
            }

            $pTime = time() + ($pTime * 24 * 3600); // convert $pTime to seconds and add that to the current timestamp
            $pTime = date('Y-m-d', $pTime); // convert to mysql compatible format

            /*
            END SECTION
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */

             $invoice_no       = $data['invoice'];
             $txnid            = $data['txnid'];
             $bank_ref_num     = $data['bank_ref_num'];
             $mihpayid         = $data['mihpayid'];
             $payment_status   = $data['payment_status'];
             $pg_type          = $data['mode'];
             $shipping_fname   = $data['firstname'];
             $shipping_lname   = $data['lastname'];
             $shipping_address = $data['address1'];
             $shipping_city    = $data['city'];
             $shipping_state   = $data['state'];
             $shipping_country = $data['country'];
             $shipping_pincode = $data['zipcode'];
             $shipping_phoneno = $data['phone'];
             $shipping_emailid = $data['email'];
             $totalAmount      = $data['totalAmount'];
	           $shipping_cost    = $data['shippng_cost'];
            
            $this->db->set('couponid', $data['couponId']);
            $this->db->set('redeemedprice', $data['couponValue'] );
            //place_order($prodid ,$qty ,$userid , $storeid ,$payment_status , $shipping_fname, $shipping_lname, $shipping_address,$shipping_city ,$shipping_state , $shipping_country, $shipping_pincode ,$shipping_phoneno,$shipping_emailid )
            
            /*
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */
            $this->db->set('date_of_pickup', $pTime);
            /*
            END SECTION
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */
            $this->db->set('invoice_no',$invoice_no);
            $this->db->set('product_id',$prodid );
            $this->db->set('txnid',$txnid);
            $this->db->set('bank_ref_num',$bank_ref_num);
            $this->db->set('mihpayid',$mihpayid);
            $this->db->set('pg_type',$pg_type);
            $this->db->set('payment_status',$payment_status);
            $this->db->set('quantity',$qty );
            $this->db->set('user_id',$userid );
            $this->db->set('store_id',$storeid );
            $this->db->set('amt_paid',$amt_paid );
            $this->db->set('vcolor',$vcolor );
            $this->db->set('vsize',$vsize );
            $this->db->set('shipping_fname',$shipping_fname );
            $this->db->set('shipping_lname',$shipping_lname );
            $this->db->set('shipping_address',$shipping_address );
            $this->db->set('shipping_city',$shipping_city );
            $this->db->set('shipping_state',$shipping_state );
            $this->db->set('shipping_country',$shipping_country );
            $this->db->set('shipping_pincode',$shipping_pincode );
            $this->db->set('shipping_phoneno',$shipping_phoneno );
            $this->db->set('shipping_emailid',$shipping_emailid );
	        $this->db->set('shipping_cost',$shipping_cost);
	        $this->db->set('shipping_partner',$shipping_partner);
            $this->db->insert('orders');

            $orderID = $this->db->insert_id();
            
            $this->db->set('quantity', "quantity-".$qty, FALSE);
            $this->db->where('product_id', $prodid );
            if($this->db->update('products'))
                return 1;
            else
                return 0;
         }

         function deletecart($temp)
         {
             $prodid = $temp->product_id;
             $usrid = $temp->user_id;
             $this->db->where('product_id',$prodid );
             $this->db->where('user_id',$usrid );
             $this->db->delete('cart' );
         }
        
		function place_order_cod($temp, $data)
		{
			log_message('INFO', "inside vc_orders/place_order_cod");
			log_message('INFO', " \$temp = ".print_r($temp, TRUE));
			log_message('INFO', " \$data = ".print_r($data, TRUE));
            //$txnid2 = NULL;
			$prodid = $temp->product_id;
			$qty = $temp->cart_quantity;
			$userid = $temp->user_id;
			$storeid = $temp->store_id;
			$amt_paid = ( $temp->is_on_discount == 1 )? $temp->selling_price - $temp->discount: $temp->selling_price;
			$vcolor = $temp->vcolor;
			$vsize = $temp->vsize;
			if($temp->shipping_partner != '0')
			{
				$shipping_partner = $temp->shipping_partner;
			}
			else
			{
				$shipping_partner = 1;
			}

            /*
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */
            $this->db->select('processing_time');
            $this->db->from('products');
            $this->db->where('product_id', $prodid);
            $pTimeQ = $this->db->get();
            switch($pTimeQ->num_rows > 0)
            {
                case TRUE: $pTime = $pTimeQ->result();
                            $pTime = $pTime[0]->processing_time;
                    break;
                case FALSE: $pTime = 10;
                    break;
            }

            $pTime = time() + ($pTime * 24 * 3600); // convert $pTime to seconds and add that to the current timestamp
            $pTime = date('Y-m-d', $pTime); // convert to mysql compatible format

            /*
            END SECTION
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */
             
            $invoice_no       = $data['invoice'];
            $txnid            = $data['txnid'];
            $payment_status   = 2;
            $pg_type          = 'COD';
            $shipping_fname   = $data['firstname'];
            $shipping_lname   = $data['lastname'];
            $shipping_address = $data['address1'];
            $shipping_city    = $data['city'];
            $shipping_state   = $data['state'];
            $shipping_country = $data['country'];
            $shipping_pincode = $data['zipcode'];
            $shipping_phoneno = $data['phone'];
            $shipping_emailid = $data['email'];
            $totalAmount      = $data['amount'];
            
             //log_message("INFO", "DATA BEING RETURNED FROM(\$data['redeemedprice']) VC_ORDERS/place_order_cod IS_____".print_r($data['redeemedprice'], TRUE));


            //if(!strcmp($txnid, $txnid2))
             //{
                /*$percentage = ($amt_paid*100)/$totalAmount;
                log_message("INFO", "DATA BEING RETURNED FROM(\$percentage) VC_ORDERS/place_order_cod IS_____".print_r($percentage, TRUE));
                $couponValue = ceil(($percentage*$data['redeemedPrice'])/100);
                log_message("INFO", "DATA BEING RETURNED FROM(\$couponValue) VC_ORDERS/place_order_cod IS_____".print_r($couponValue, TRUE));


			log_message('INFO', "\$couponDetails = ".print_r($couponDetails, TRUE));*/
            //place_order($prodid ,$qty ,$userid , $storeid ,$payment_status , $shipping_fname, $shipping_lname, $shipping_address,$shipping_city ,$shipping_state , $shipping_country, $shipping_pincode ,$shipping_phoneno,$shipping_emailid )
            /*
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */
            $this->db->set('date_of_pickup', $pTime);
            /*
            END SECTION
            NEW CODE by SHAMMI SHAILAJ as per PRTs request to set date_of_pickup at the time an order is placed
            */
            $this->db->set('invoice_no',$invoice_no);
            $this->db->set('product_id',$prodid );
            $this->db->set('txnid',$txnid);
            $this->db->set('pg_type',$pg_type);
            $this->db->set('payment_status',$payment_status);
            $this->db->set('quantity',$qty );
            $this->db->set('user_id',$userid );
            $this->db->set('store_id',$storeid );
            $this->db->set('amt_paid',$amt_paid );
            $this->db->set('vcolor',$vcolor );
            $this->db->set('vsize',$vsize );

			      log_message('INFO', "\$couponDetails != 0");

            $this->db->set( 'couponid', $data['couponId'] );
            $this->db->set( 'redeemedprice', $data['couponValue'] );

            $this->db->set('shipping_fname', $shipping_fname );
            $this->db->set('shipping_lname', $shipping_lname );
            $this->db->set('shipping_address', $shipping_address );
            $this->db->set('shipping_city', $shipping_city );
            $this->db->set('shipping_state', $shipping_state );
            $this->db->set('shipping_country', $shipping_country );
            $this->db->set('shipping_pincode', $shipping_pincode );
            $this->db->set('shipping_phoneno', $shipping_phoneno );
            $this->db->set('shipping_emailid', $shipping_emailid );
            $this->db->set('shipping_partner', $shipping_partner);
            $this->db->insert('orders');

            $orderID = $this->db->insert_id();
            
            $this->db->set('quantity', "quantity-$qty", FALSE);
            $this->db->where('product_id', $prodid );
            
            if($this->db->update('products'))
                return 1;
            else 
                return 0;
         }
        function pincode($pinto)
        {
            $this->db->select('pin_to');
            $this->db->from('shiping_partner');
            $this->db->where('pin_to', $pinto );
            $query = $this->db->get();
            return $query->result();
        }
         
        public function purchase_mail_details($txn_id)
        {
            $this->db->select('store_owner.owner_name,store_info.contact_email,email_purchase.*,user_details.full_name');
            $this->db->select('orders.*');
            $this->db->select('products.product_name, store_info.store_name, (products.processing_time) as process_days');
            $this->db->select('products.cat_id, products.sub_catid1, products.sub_catid2, products.sub_catid3');
            $this->db->select("ifnull(orders.vsize,'0') as variant_size",false);
            $this->db->select("ifnull(orders.vcolor,'0') as variant_color",false);
            $this->db->select('store_info.store_id,products.product_id');
            $this->db->from('email_purchase');
            $this->db->join('orders','email_purchase.txn_id = orders.txnid');
            $this->db->join('user_details','orders.user_id = user_details.user_id');
            $this->db->join('products','products.product_id = orders.product_id');
            $this->db->join('store_owner','store_owner.store_id = orders.store_id');
            $this->db->join('store_info','store_info.store_id = orders.store_id');
            $this->db->where('txn_id',$txn_id);
            $this->db->where('sent_status',0);
            $result = $this->db->get();
            $row = $result->result_array();
            if (count($row)>0)			
                return $row;
            else return 0;
       }

       /* © Shammi Shailaj for order2/payment_success query optimization */
       /*
        * This is the first step of optimization. Removes unnecessary details from the query
        */

        public function purchaseMailDetails($txnID)
        {
            log_message('INFO', "vc_orders/purchaseMailDetails fired with TXNID = ".$txnID);
            $this->db->select('email_purchase.sent_email_id');

            $this->db->select('store_owner.owner_name');
            $this->db->select('store_info.contact_email');

            $this->db->select('orders.order_id');
            $this->db->select('orders.shipping_fname');
            $this->db->select('orders.shipping_lname');
            $this->db->select('orders.shipping_address');
            $this->db->select('orders.shipping_city');
            $this->db->select('orders.shipping_pincode');
            $this->db->select('orders.shipping_phoneno');
            $this->db->select('orders.couponid');
            $this->db->select('orders.pg_type');
            $this->db->select('orders.store_id');
            $this->db->select('orders.product_id');
            $this->db->select('orders.amt_paid');
            $this->db->select('orders.quantity');
            $this->db->select('orders.date_of_pickup');

            $this->db->select('store_info.store_name');
            $this->db->select('store_info.contact_number');

            $this->db->select('products.product_name');
            $this->db->select('products.bnb_product_code');
            $this->db->select('products.processing_time AS process_days');

            $this->db->select("ifnull(orders.vsize,'0') as variant_size", FALSE);
            $this->db->select("ifnull(orders.vcolor,'0') as variant_color", FALSE);

            $this->db->select('user_details.full_name');

            $this->db->from('email_purchase');

            $this->db->join('orders','email_purchase.txn_id = orders.txnid', 'left');
            $this->db->join('user_details','orders.user_id = user_details.user_id', 'left');
            $this->db->join('products','orders.product_id = products.product_id', 'left');
            $this->db->join('store_owner','orders.store_id = store_owner.store_id', 'left');
            $this->db->join('store_info','orders.store_id = store_info.store_id', 'left');

            $this->db->where('email_purchase.txn_id', $txnID);
            $this->db->where('email_purchase.sent_status', 0);

            $result = $this->db->get();
            log_message('INFO', "vc_orders/purchaseMailDetails JUST RAN THE QUERY___________\r\n".$this->db->last_query());

            $row = $result->result_array();
            $retVal = 0;

            if($result->num_rows() > 0)
            {
                $retVal = $row;
            }

            log_message('INFO', "vc_orders/purchaseMailDetails returning________\r\n".$retVal);
            return $retVal;
        }
       
       /* © Shammi Shailaj for sokrati */
       /*
        * takes transaction id as its only argument and retrieves all details
        * from the db for that transaction
        */
       public function orderDetails($txnid = NULL)
       {
           //print "<pre>inside orderDetails. txnid = [".$txnid."]</pre>";
           $this->db->select('txnid, orders.quantity, order_id, pg_type, orders.product_id, orders.user_id, orders.store_id, amt_paid, couponid, redeemedprice, vsize, vcolor, shipping_fname, shipping_lname, shipping_company, shipping_address, shipping_city, shipping_state, shipping_country, shipping_pincode, shipping_phoneno, shipping_emailid, orders.invoice_no, product_name, store_name');
           $this->db->from('orders');
           $this->db->join('products', 'orders.product_id = products.product_id');
           $this->db->join('store_info', 'orders.store_id = store_info.store_id');
           $this->db->join('user_details', 'orders.user_id = user_details.user_id');
           if(is_null($txnid) || strcmp($txnid,"") === 0)
           {
               print "<pre>Returning false</pre>";
               return FALSE;
           }
           $this->db->where('txnid', $txnid);
           //print "<pre>running query</pre>";
           $query = $this->db->get(); 
           /*print "<pre> last query = ".$this->db->last_query()."</pre>";
           print "<p>";print $query->num_rows();print "<pre>";
           print "<p>";print_r($query->result());print "<pre>";*/
           //exit();
           switch($query->num_rows() > 0)
           {
               case TRUE: return $query->result();
                   break;
               case FALSE: return FALSE;
                   break;
           }
       }
       /* end © Shammi Shailaj for sokrati */
       
        public function purchase_mail_success($txn_id)
        {
                $this->db->where('txn_id',$txn_id);
                $this->db->set('sent_status',1);
                $this->db->update('email_purchase');
        }

		
	 public function shipped_mail_details($store_id)
         {
                $this->db->select('*');
                $this->db->from('shipped_orders');
		$store_id = (int)$store_id;
		if ($store_id > 0)
                    $this->db->where('store_id',$store_id);
                $this->db->limit('3');
                $result = $this->db->get();
                $row = $result->result_array();
                if (count($row)>0)			
                    return $row;
                else return 0;
	}
		
	 public function cancelled_mail_details($store_id)
         {
            $this->db->select('*');
            $this->db->from('cancelled_orders');
            $store_id = (int)$store_id;
            if ($store_id > 0)
                $this->db->where('store_id',$store_id);
            $this->db->limit('3');
            $result = $this->db->get();
            $row = $result->result_array();
            if (count($row)>0)			
                return $row;
            else return 0;
	}
		
         public function ship_canc_mail_success($order_id)
         {
            $this->db->where('order_id',$order_id);
            $this->db->set('mail_notify',0);
            $this->db->update('orders');     
         }
         
         public function totalOrdersByUser($userId)
         {
             $query = 'SELECT order_id FROM orders WHERE orders.user_id = '.$userId;
             $result = $this->db->query($query);
             return $result->num_rows();
         }
         
}?>