<?php

class productInfo
{
    public $storeID = NULL;
    public $productID = NULL;
    public $storeName = NULL;
    public $orderID = NULL;
    public $productName = NULL;
    public $productCat = NULL;
    public $productSubCat1 = NULL;
    public $productSubCat2 = NULL;
    public $productSubCat3 = NULL;
    public $unitPrice = NULL;
    public $quantity = NULL;
    public $vColor = NULL;
    public $vSize = NULL;
    public $cid = NULL;
}

 class Order2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('morder');
		$this->load->model('vc_orders');
		$this->load->model('shipping');
		$this->load->model('slog');
		/*
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		*/
	}

	function checkout()
	{
		$userID = ($this->session->userdata('id') !== FALSE) ? $this->session->userdata('id'): NULL;
		if( $userID !== NULL && is_numeric($userID) )
		{
			if($this->cartdb->canPurchase($userID))
			{
				include('header_include.php');
		
				/* code to delete manish's mix panel shopping cart cookie */
				$this->load->helper('cookie');
				$cookieToDelete = array('name' => 'shoppingCartPageLoaded', 'domain' => $this->input->server('SERVER_NAME'), 'path' => '/');
				delete_cookie($cookieToDelete);
				/* END SECTION code to delete manish's mix panel shopping cart cookie */

				$amount = $this->input->post('amount');
				$tax = $this->input->post('tax');
				/*$redeemedAmount = $this->session->userdata('redeemedprice');
				if(!empty($redeemedAmount))
				{
					if(floatval($redeemedAmount) < 1)
					{
						amount = $amount * (1-(floatval($redeemedAmount)));
					}
					else
					{
						$amount = $amount - floatval($redeemedAmount);
					}
				}*/
				/* ADDED BY SHAMMI SHAILAJ TO SKIP THE POSTING OF DATA FROM cart/shopping_cart*/
				/*$cart = $data['cart'];
				$
				if(count($cart) > 0)
				{
					$amount = 0;
					$tax = 0;
					foreach($cart as $cartItem)
					{
						$price = $cartItem->selling_price;
						$discount = $discount + $cartItem->discount * $cartItem->cart_quantity;
						$total = $total + ($cartItem->cart_quantity * ($cartItem->selling_price - $cartItem->discount));
						$tax = $tax + (($cartItem->selling_price - $cartItem->discount) * ($cartItem->tax_rate / 100));
					}
				}*/
				/* END SECTION ADDED BY SHAMMI SHAILAJ TO SKIP THE POSTING OF DATA FROM cart/shopping_cart */
		        $amount = number_format($amount,2,'.','');
				$data['amount'] = $amount;
				$data['tax'] = $tax;
		        $userArr=$this->session->userdata('userArr');
				//var_dump($userArr);
		        if( $userArr != FALSE )
		        {
		        	$data['userArr']=$userArr;
		        }
				else
				{
					$data['userArr'] = FALSE;
				}
				$this->session->unset_userdata('userArr');
				$this->load->model('user_info_model');
				$data['mydetails'] = $this->user_info_model->userdetails($this->session->userdata('id'));
				//print "<p>reached here</p>";
		        $this->load->view('checkout',$data);
			}
			else
			{
				$this->load->view('restrictedPurchase');
			}
		}
		else
		{
			redirect(base_url()."?next=".urlencode('/order2/checkout_second'));
		}
	}

	function checkout_second()
	{
		$data['base_url'] = base_url();
		$userID = ($this->session->userdata('id') !== FALSE) ? $this->session->userdata('id'): NULL;
		if( $userID !== NULL && is_numeric($userID) )
		{
			if($this->cartdb->canPurchase($userID))
			{
				/*
				ADDED BY ALTAMASH TO BLOCK COD FOR ORDERS WHICH HAVE A COUPON
				*/
				$data['couponId'] = NULL;
				$data['redeemedPrice'] = NULL;
				$data['couponId'] = $this->session->userdata('couponid');
				$data['redeemedPrice'] = $this->session->userdata('redeemedprice');
				$data['couponSet'] = FALSE;
				if($data['couponId'] !== FALSE && $data['couponId'] !== NULL && strcmp($data['couponId'], '') !== 0)
				{
					$data['couponSet'] = TRUE;
				}
				/*
				END SECTION
				ADDED BY ALTAMASH TO BLOCK COD FOR ORDERS WHICH HAVE A COUPON
				*/
				//Pincode verification
				$pin = $this->input->post('zipcode');
				//$this->input->post('address11');
		        if(!empty($pin))
		        {
					$pincode = $this->vc_orders->pincode($pin);
		        }
				else
				{
					$pin = $this->session->userdata('userArr');
					$pincode = $this->vc_orders->pincode($pin['zipcode']);
				}

				//$pincode = $this->vc_orders->pincode($this->input->post('zipcode'));
		        if(!empty($pincode))
		        {
					include('header_include.php');
					include('forminput.php');
		            
		            if(!empty($data['amount']) || !empty($data['tax']) )
		            {
						$this->session->set_userdata('userArr', $data);
	                    $userArr=$this->session->userdata('userArr');
	                    if($userArr != NULL || $userArr != FALSE)
	                    {
		                	$data['userArr']=$userArr;
		                }
					}

					$codChecks = $this->cartdb->codcheckShammiCheckOut2nd($this->session->userdata('id'));
					$data['cod'] = $codChecks[0];
					$data['codProductsQuantity'] = 0;
					
					if($codChecks !== NULL)
					{
						foreach ($codChecks[1] as $quans)
						{
							$data['CODPolicy'] = $quans->COD_policy;
							if($quans->COD_policy == 1)
							{
								$data['codProductsQuantity'] += $quans->cart_quantity;
							}
							else
							{
								$data['CODPolicy'] = FALSE;
							}
						}
					}
					else
					{
						$data['codProductsQuantity'] = 0;
					}

		            $this->load->view('checkout_second',$data);
		        }
		        else 
		        {
		        	$this->load->view('error_pin',$data);
		        }
			}
			else
			{
				$this->load->view('restrictedPurchase');
			}
		}
		else
		{
			redirect(base_url()."?next=".urlencode('/order2/checkout_second'));
		}
	}

	function checkout_third()
	{
		log_message('INFO', "inside order2/checkout_third");
		$this->load->model('slog');
		$this->slog->write(array('level' => 1, 'msg' => "inside order2/checkout_third"));
		include('header_include.php');
		include('forminput.php');
		$pg = $this->input->post('pg');
		$pt = "";
		if($pg == "CC") {$pt = "Online Payment";}
		elseif($pg == "COD") {$pt = "Cash On Delivery";}
		else {$pt = "EMI";}
          $input = array('pg' => "$pg",'pt' => "$pt");
          $data = array_merge($data, $input);

		$sess_userid = $this->session->userdata('id');
		$sess_logged_in = $this->session->userdata('logged_in');

        $data['session'] = array( 'id' => $sess_userid, 'logged_in' => $sess_logged_in );
		$data['base_url'] = base_url();
		$data['txnid'] = substr(md5(uniqid(rand(), true)),0,16);

		log_message('INFO', "now trying to save saveBeforeCheckoutData");

		$this->cartdb->saveBeforeCheckoutData($data['txnid'], array( 'post' => $_POST, 'cartState' => $this->cartdb->mycartforuser($sess_userid) ) ); // save all the data from payu and the state of cart
		log_message('INFO', "just saved saveBeforeCheckoutData");
		//log_message('INFO', "payment gateway  = ".$pg);
		$this->load->model('slog');
		$this->slog->write(array('level' => 1, 'msg' => "payment gateway  = ".$pg));

		$data['couponId'] = NULL;
		$data['redeemedPrice'] = NULL;
		$data['couponId'] = $this->session->userdata('couponid');
		$data['redeemedPrice'] = $this->session->userdata('redeemedprice');
		$data['udf3'] = "COUPONID__".$data['couponId'];
		$data['udf4'] = "REDEMPTION_AMOUNT__".$data['redeemedPrice'];

		log_message('INFO', "After reading all data, \$data = ".print_r($data, TRUE) );

		/* NEW CODE BY SHAMMI TO CHECK AND APPLY COUPON ONLY ON VALID DATA OTHERWISE THE COUPON GETS REMOVED */

		$this->load->model('cartdb');

		$totalPurchaseAmount = $this->cartdb->getTotalPurchaseAmount( $this->session->userdata( 'id' ) );
		log_message('INFO', "order2/checkout_third:::totalPurchaseAmount = ".$totalPurchaseAmount);
		$data['amount'] = $totalPurchaseAmount;

		log_message('INFO', "Before coupon computation, \$data['amount'] = ".$data['amount']." and \$data['tax'] = ".$data['tax']);
		$data['couponValue'] = 0.00;
		
		$id = $sess_userid;
		
		$isLoggedIN = $sess_logged_in;
		
		$isValid = $this->cartdb->checkCouponId( $data['couponId'] );
		
		log_message('INFO', "\$this->cartdb->checkCouponId(".$data['couponId'].") = ".print_r($isValid, TRUE));
		
		$couponCheckData = array();
		
		$couponCheckData['isValidCoupon'] = FALSE;
		$couponCheckData['isValidUser'] = FALSE;
		$couponCheckData['isValidAmount'] = FALSE;
		$couponCheckData['discounttype'] = NULL;
		$couponCheckData['sessionSet'] = FALSE;
		$couponCheckData['redeemedPrice'] = 0;
		
		if ($isValid !== 0 && $isLoggedIN === TRUE) // proceed only when the coupon exists and a user is logged-in
		{
			log_message('Info', 'Validating redeem bnb coupon code: ' . $data['couponId'] . ' entered by User with userid: ' . $id);
			$couponDetails = $isValid;
			$redeemedPrice = 0.0;

			$couponCheckData['isValidCoupon'] = TRUE;
			$couponCheckData['discounttype'] = $isValid['discounttype'];

			if ($couponDetails['discounttype'] == 0)
			{
				//Discount in terms of %
				if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
				{
					$couponCheckData['isValidUser'] = TRUE;
					if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
					{
						$couponCheckData['isValidAmount'] = TRUE;
						$redeemedPrice = (intval($couponDetails['percentoff']) / 100);
						$redeemedPrice = $redeemedPrice * $totalPurchaseAmount;
					}
				}
			}
			elseif($couponDetails['discounttype'] == 1)
			{
				//Discount in terms of Rs.
				if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
				{
					$couponCheckData['isValidUser'] = TRUE;
					if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
					{
						$couponCheckData['isValidAmount'] = TRUE;
						$redeemedPrice = floatval($couponDetails['percentoff']);
					}
				}
			}
			elseif($couponDetails['discounttype'] == 2){ /* discount on a store % */ }
			elseif($couponDetails['discounttype'] == 3){ /* discount on a store Rs */ }
			elseif($couponDetails['discounttype'] == 4){ /* discount on a category % */ }
			elseif($couponDetails['discounttype'] == 5)
			{
			    // discount on a category Rs
				if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
				{
					$couponCheckData['isValidUser'] = TRUE;
					// check if the current cart has products of the category 
					if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
					{
						$couponCheckData['isValidAmount'] = TRUE;
						$redeemedPrice = floatval($couponDetails['percentoff']);
					}
				}
			}
			elseif($couponDetails['discounttype'] == 6){ /* discount on a product % */}
			elseif($couponDetails['discounttype'] == 7){ /* discount on a product Rs */}
			elseif($couponDetails['discounttype'] == 8)
			{
			    // discount on a store %
			    if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
				{
					$couponCheckData['isValidUser'] = TRUE;
					// check if the current cart has products of the store specified in param1
					$hasStoreProducts = $this->cartdb->cartHasCouponProducts( $couponDetails['discounttype'], $couponDetails['param1'] );
					if($hasStoreProducts['result'] === TRUE)
					{
						if($hasStoreProducts['totalPurchaseAmount'] >= $couponDetails['minPurchaseAmount'])
						{
							$couponCheckData['isValidAmount'] = TRUE;
							$redeemedPrice = (intval($couponDetails['percentoff']) / 100);
							$couponCheckData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
							$redeemedPrice = $couponCheckData['finalDiscountAmount']; // hack to send the discounted value instead of percentage(which was being used as a multiplication factor in the shopping_cart view)
						}
					}
				}
			}
			elseif($couponDetails['discounttype'] == 9){/* discount on a store Rs */}
			
			elseif($couponDetails['discounttype'] == 10){ /* discount on a store % */}
			elseif($couponDetails['discounttype'] == 11){ /* discount on a store Rs */}
			elseif($couponDetails['discounttype'] == 12){/* discount on a store % */}
			elseif($couponDetails['discounttype'] == 13){ /* discount on a store Rs */}
			elseif($couponDetails['discounttype'] == 14){}
			elseif($couponDetails['discounttype'] == 15){}
			elseif($couponDetails['discounttype'] == 16){}
			elseif($couponDetails['discounttype'] == 17){}
			elseif($couponDetails['discounttype'] == 18){}
			elseif($couponDetails['discounttype'] == 19){}
			elseif($couponDetails['discounttype'] == 20){}
			elseif($couponDetails['discounttype'] == 21){}
			elseif($couponDetails['discounttype'] == 22){}
			elseif($couponDetails['discounttype'] == 23){}
			elseif($couponDetails['discounttype'] == 24){}
			elseif($couponDetails['discounttype'] == 25){}
			elseif($couponDetails['discounttype'] == 26){ /* discount voucher redeemable that can be used as credit balance by a user */ }

			$couponCheckData['redeemedPrice'] = $redeemedPrice;
			
			if($couponCheckData['isValidAmount'] && $couponCheckData['isValidUser'] === TRUE)
			{
				$this->session->set_userdata('couponid', $couponDetails['couponid']);
				$this->session->set_userdata('redeemedprice', $redeemedPrice);
				$couponRedeemSuccess = $this->session->set_userdata('couponRedeemSuccessBeforePayU', TRUE );

				$data['amount'] = $data['amount'] - $redeemedPrice;
				$data['couponValue'] = $redeemedPrice / $cartCount;
			}
		}
		else
		{
			log_message('Info', 'User with userid: ' . $id . ' has entered Invalid couponId!');
		}

		/* ___END_SECTION___ NEW CODE BY SHAMMI TO CHECK AND APPLY COUPON ONLY ON VALID DATA OTHERWISE THE COUPON GETS REMOVED */

		if($pg == "CC" || $pg == "EMI")
		{
                    $this->config->load('payu',TRUE);
			        $config = $this->config->item('payu');
                    $data['key']=$config['key'];
                    $data['salt']=$config['salt'];
                    $data['url']=$config['url'];
                    log_message('INFO', "After coupon computation, \$data = ".print_r($data, TRUE) );
                    $this->load->view('checkout_third',$data);
		}
		else
		{
//                    $cod = $this->cartdb->codcheck($this->session->userdata('id'));
//                    $data['amount'] = 0;
//                    $data['tax'] = 0;
//                    for($i=0;$i<count($cod);$i++) {
//                        $data['amount'] = $data['amount'] + ( ($cod[$i]->selling_price - $cod[$i]->discount )* $cod[$i]->cart_quantity ) ;
//                        $data['tax'] = $data['tax'] + ( ( $cod[$i]->selling_price - $cod[$i]->discount ) * ( $cod[$i]->tax_rate / 100 ) ) ;
//                    }
//                    
//                    $redeemedAmount = $this->session->userdata('redeemedprice');
//                    if(!empty($redeemedAmount)) {
//                        if(floatval($redeemedAmount) < 1) {
//                            $data['amount'] = $data['amount'] * (1-(floatval($redeemedAmount))); }
//                        else {
//                            $data['amount'] = $data['amount'] - floatval($redeemedAmount); }
//                    }
//                    $this->load->view('checkout_third_codForm',$data);
			//log_message('INFO', "processing COD order for user ".$sess_userid." from ".$this->input->ip_address());
				$this->load->model('slog');
				$this->slog->write(array('level' => 1, 'msg' => "processing COD order for user ".$sess_userid." from ".$this->input->ip_address()));
				$this->session->unset_userdata('userArr');
				$cartinfo = $this->cartdb->codcheck($this->session->userdata('id'));
				$cartCount = count($cartinfo);
				
				//log_message('INFO', "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponid = ".$data['couponId']." redeemedPrice = ".$data['redeemedPrice']);
				$this->load->model('slog');
				$this->slog->write(array('level' => 1, 'msg' => "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponid = ".$data['couponId']." redeemedPrice = ".$data['redeemedPrice']));
				if($data['couponId'] !== FALSE || $data['redeemedPrice'] !== FALSE)
				{
					//log_message('INFO', "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponid is set in the current session. Will now check for validity");
					$this->load->model('slog');
					$this->slog->write(array('level' => 1, 'msg' => "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponid is set in the current session. Will now check for validity"));
					$couponDetails = $this->cartdb->checkCouponId($data['couponId']);
					$data['couponDetails'] = $couponDetails;
					//log_message('INFO', "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponDetails = ".print_r($couponDetails, TRUE));
					$this->load->model('slog');
					$this->slog->write(array('level' => 1, 'msg' => "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponDetails = ".print_r($couponDetails, TRUE)));
					if($couponDetails !== 0)
					{
						//log_message('INFO', "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; redeeming coupon now by decreasing the coupon count in DB");
						$this->load->model('slog');
						$this->slog->write(array('level' => 1, 'msg' => "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; redeeming coupon now by decreasing the coupon count in DB"));
						$this->cartdb->redeemCouponId($couponDetails);
					}
					$this->session->unset_userdata('couponid');
					$this->session->unset_userdata('redeemedprice');
				}
				else
				{
					//log_message('INFO', "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponid is either not valid or does not exist");
					$this->load->model('slog');
					$this->slog->write(array('level' => 1, 'msg' => "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; couponid is either not valid or does not exist"));
				}
			//$this->load->model('contestdb');
			//log_message('INFO', "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; will now place order for each product");
			$this->load->model('slog');
			$this->slog->write(array('level' => 1, 'msg' => "user ".$sess_userid." from ".$this->input->ip_address()."; order2/checkout_third; will now place order for each product"));

			for ($i=0 ; $i < $cartCount; $i++ ) 
			{ 
				$data['totalAmount'] += ($cartinfo[$i]->selling_price - $cartinfo[$i]->discount);
				log_message("INFO", "DATA BEING RETURNED FROM(\$data['totalAmount']) ORDER2/checkout_third IS_____".print_r($data['totalAmount'], TRUE));
			}

			for($i = 0; $i < $cartCount; $i++)
			{
				$data['invoice'] = $this->vc_orders->invoice_no($cartinfo[$i]->store_id, $cartinfo[$i]->bnb_product_code);
				/*if($this->contestdb->is_christmas_prod($cartinfo[$i]->product_id) == 1 && $this->contestdb->is_christmas_winner() == 1)
					$cartinfo[$i]->discount = $cartinfo[$i]->selling_price / 2 ;*/
				$pass = $this->vc_orders->place_order_cod($cartinfo[$i], $data);
				if ($pass)
				{
					$this->vc_orders->deletecart($cartinfo[$i]);
				}
			}
			$this->session->set_userdata('email', $email);
			$this->session->set_userdata('e_txn_id', $data['txnid']);
			/* old code [used redirection] */
			/*$sucess_url = base_url("index.php/invoice_controller/redirecting_to_bnb/" . $data['txnid']);
			redirect($sucess_url);*/
			/* END old code [used redirection] */
			/* new code by Shammi Shailaj [direct function call] */
			$this->redirecting_to_bnb($data['txnid']);
			/* END new code by Shammi Shailaj [direct function call] */
		}

	}
	
	/* added by Shammi Shailaj to remove redirection */
	public function redirecting_to_bnb($txnid, $first_time = 0) //save_buyer_invoice
	{
		$base_url = base_url();
		$this->load->model('invoice_model');
		$order_details = $this->invoice_model->save_invoice($txnid);
		if ($first_time == 0)
			$_SESSION['order_count'] = count($order_details);
		else
			$_SESSION['order_count'] = (int)$_SESSION['order_count'] - 1;

		if ((int)$_SESSION['order_count'] == 0)
		{
			unset($_SESSION['invoice_orders']);
			unset($_SESSION['order_count']);
			$sucess_url = base_url("index.php/order2/payment_success");
			//redirect($sucess_url, 'refresh');
			redirect($sucess_url);
		}
		else
		{
			$_SESSION['invoice_orders'] = $order_details[(int)$_SESSION['order_count'] - 1];
			/* Removing Redirection SHIT [SHAMMI SHAILAJ]*/
			/* ====================OLD===================== */
			/*$url = base_url("index.php/invoice_controller/redirectingback/" . $txnid);
			redirect($url);*/
			/* ====================NEW CODE================ */
			$this->redirectingback($txnid);
			/* END SECTION Removing Redirection SHIT [SHAMMI SHAILAJ]*/
		}
	}
	
	public function redirectingback($txnid) //generate buyer_invoice
	{
		$base_url = base_url();
		$this->load->model('invoice_model');
		$order_details = $_SESSION['invoice_orders'];
		$routing_code['destination_code'] = '';
		$routing_code['return_code'] = '';
		$routing_code['retpin'] = '';
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 2)
		{
			$routing_code = $this->invoice_model->fetch_routing_retcode_cod($order_details['return_pincode']);
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_cod($order_details['shipping_pincode']);
		}
		if ($order_details['shipping_partner'] == 2 && $order_details['payment_status'] == 1)
		{
			$routing_code['destination_code'] = $this->invoice_model->fetch_routing_code_paid($order_details['shipping_pincode']);
		}
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		/* ADDED BY SHAMMI SHAILAJ to fix issue where save_buyer_invoice.php was not getting the store URL and hence generating a notice error */
		$this->config->load('payu', TRUE);
		$myconfig = $this->config->item('payu');
		$store_url = $myconfig['store_url'];
		/* END SECTION ADDED BY SHAMMI SHAILAJ to fix issue where save_buyer_invoice.php was not getting the store URL and hence generating a notice error */
		include 'save_buyer_invoice.php';
		$file_path = __DIR__.'/../../invoice/' . $txnid;
		if(!file_exists($file_path))
		{
			mkdir($file_path, 0777);
		}
		$pdfcode = $this->cezpdf->output();
		$fp = fopen($file_path . '/buyer_invoice_order_' . $order_details['order_id'] . '.pdf', 'wb');
		fwrite($fp, $pdfcode);
		fclose($fp);
		/* Removing Redirection SHIT [SHAMMI SHAILAJ]*/
		/* ====================OLD===================== */
		/*$url = base_url("index.php/invoice_controller/redirecting_to_bnb/" . $txnid . '/1');
		redirect($url);*/
		/* ====================NEW CODE================ */
		$this->redirecting_to_bnb($txnid, 1);
		/* END SECTION Removing Redirection SHIT [SHAMMI SHAILAJ]*/
	}
	/* END added by Shammi Shailaj to remove redirection */
	
	function checkout_third_cod()
	{
		log_message('INFO', "order2/checkout_third_cod init");
		include('header_include.php');
		include('forminput.php');
		$data['txnid'] = $this->input->post('txnid');
		$this->session->unset_userdata('userArr');
		$cartinfo = $this->cartdb->codcheck($this->session->userdata('id'));
		$data['count'] = count($cartinfo);
		$data['couponId'] = '';
		$data['redeemedPrice'] = '';
		if ($this->session->userdata('couponid') && $this->session->userdata('redeemedprice')) {
			$data['couponId'] = $this->session->userdata('couponid');
			$data['redeemedPrice'] = $this->session->userdata('redeemedprice');
			$couponDetails = $this->cartdb->checkCouponId($data['couponId']);
                        if($couponDetails != 0)
				$this->cartdb->redeemCouponId($couponDetails);
			$this->session->unset_userdata('couponid');
			$this->session->unset_userdata('redeemedprice');
		}

		//$this->load->model('contestdb');
		if($data['couponId'] !== FALSE && $data['couponId'] !== NULL && strcmp($data['couponId'], '') !== 0)
		{		
		   for ($i=0; $i <count($cartinfo) ; $i++) 
           { 
        	$data['totalAmount'] += ( $cartinfo[$i]->is_on_discount == 1 )? ($cartinfo[$i]->selling_price - $cartinfo[$i]->discount): $cartinfo[$i]->selling_price;
			//log_message("INFO", "DATA BEING RETURNED FROM(\$data['totalAmount']) ORDER2/checkout_third_cod IS_____".print_r($data['totalAmount'], TRUE));
			$this->load->model('slog');
			$this->slog->write(array('level' => 1, 'msg' => "DATA BEING RETURNED FROM(\$data['totalAmount']) ORDER2/checkout_third_cod IS_____".print_r($data['totalAmount'], TRUE)));
		   }
		}	
		

		for ($i = 0; $i < count($cartinfo); $i++)
		{
			$data['invoice'] = $this->vc_orders->invoice_no($cartinfo[$i]->store_id, $cartinfo[$i]->bnb_product_code);
			/*if($this->contestdb->is_christmas_prod($cartinfo[$i]->product_id) == 1 && $this->contestdb->is_christmas_winner() == 1)
				$cartinfo[$i]->discount = $cartinfo[$i]->selling_price / 2 ; */
			$pass = $this->vc_orders->place_order_cod($cartinfo[$i], $data);
			if ($pass)
				$this->vc_orders->deletecart($cartinfo[$i]);
		}
		$this->session->set_userdata('email', $email);
		$this->session->set_userdata('e_txn_id', $data['txnid']);
		$sucess_url = base_url("index.php/invoice_controller/redirecting_to_bnb/" . $data['txnid']);
		redirect($sucess_url);
	}

	//END            
            //Success Page after checkout - placing the order "AS"
            function pay_status()
            {
                include('header_include.php');
                include('forminput.php');
                $this->config->load('payu',TRUE);
                $config = $this->config->item('payu');
                $address2 = $this->input->post('address2');
                $this->session->unset_userdata('userArr');
                if(!empty($address2)) {
                    $data['address1'] = $data['address1'].','.$address2;
                }
                $data['address1'] = str_replace('  ',', ',trim($data['address1']));
                $mihpayid = $this->input->post('mihpayid');
                $mode = $this->input->post('mode');
                $status = $this->input->post('status');
                $key = $this->input->post('key');
                $productinfo = $this->input->post('productinfo');
                $txnid = $this->input->post('txnid');
                $offer = $this->input->post('offer');
                $error = $this->input->post('error');
                $pg_type = $this->input->post('pg_type');
                $bank_ref_num = $this->input->post('bank_ref_num');
                $hash = $this->input->post('hash');
                $salt=$config['salt'];
                $udf1 = $this->input->post('udf1');
                $udf2 = $this->input->post('udf2');
                $udf3 = $this->input->post('udf3');
                $udf4 = $this->input->post('udf4');
                $data['couponValue'] = 0.00;
                $data['totalAmount'] = 0.00;

                $input = array('mihpayid' => $mihpayid,
                               'mode' => $mode,
                               'status' => $status,
                               'key' => $key,
                               'productinfo' => $productinfo,
                               'txnid' => $txnid,
                               'offer' => $offer,
                               'error' => $error,
                               'pg_type' => $pg_type,
                               'bank_ref_num' => $bank_ref_num,
                               'udf1'=>$udf1,
                               'udf2'=>$udf2,
                               'udf3' => $udf3,
                               'udf4' => $udf4,
                               'hash' =>$hash);
                $data = array_merge($data,$input);
                $text = "$salt|$status|||||||$udf4|$udf3|$udf2|$udf1|$email|$firstname|$productinfo|$amount|$txnid|$key";
                $output = hash("sha512", $text);
                $data['couponId'] = $this->session->userdata('couponid');
                $data['redeemedPrice'] = $this->session->userdata('redeemedprice');
                //Lee Finished <--
                $cartinfo = $this->cartdb->mycartforuser($udf1);
                $cartCount = count($cartinfo);
                $this->cartdb->saveAfterCheckoutData($txnid, array( 'post' => $_POST, 'cartState' => $cartinfo ) ); // save all the data from payu and the state of cart
                if($status == "SUCCESS" || $status == "success" && $output == $hash)
                {
				 //log_message('Info','Order Succeeded for the user with userid: '.$this->session->userdata('id').' and ip address: '.$this->input->ip_address());
				 $this->load->model('slog');
				 $this->slog->write(array('level' => 1, 'msg' => 'Order Succeeded for the user with userid: '.$this->session->userdata('id').' and ip address: '.$this->input->ip_address()));
                 //log_message('Info','Order Details are userid: '.$this->session->userdata('id').' and ip: '.$this->input->ip_address());
                    $this->slog->write(array('level' => 1, 'msg' => 'Order Details are userid: '.$this->session->userdata('id').' and ip: '.$this->input->ip_address()));
                    
                    $postName = array(0=>'PG_TYPE',1=>'address1',2=>'address2',3=>'amount',4=>'bank_ref_num',5=>'bankcode',6=>'cardhash',7=>'cardnum',8=>'city',9=>'country',10=>'discount',11=>'email',12=>'error',13=>'field1',14=>'field2',15=>'field3',16=>'field4',17=>'field5',18=>'field6',19=>'field7',20=>'field8',21=>'firstname',22=>'hash',23=>'key',24=>'lastname',25=>'mihpayid',26=>'mode',27=>'phone',28=>'productinfo',29=>'state',30=>'status',31=>'txnid',32=>'udf1',33=>'udf10',34=>'udf2',35=>'udf3',36=>'udf4',37=>'udf5',38=>'udf6',39=>'udf7',40=>'udf8',41=>'udf9',42=>'unmappedstatus',43=>'zipcode');
                    
                    foreach($postName as $key=>$name)
                    {
                        $sno = $key+1;
                        //log_message('Info',$sno.'.'.$name.': '.$this->input->post($name));
                        $this->load->model('slog');
                        $this->slog->write(array('level' => 1, 'msg' => $sno.'.'.$name.': '.$this->input->post($name)));
                    }

                    
                	for ($i=0; $i < $cartCount ; $i++) 
					{
						$data['totalAmount'] += ($cartinfo[$i]->is_on_discount == 1)? ($cartinfo[$i]->selling_price - $cartinfo[$i]->discount) : $cartinfo[$i]->selling_price;
						log_message("INFO", "DATA BEING RETURNED FROM(\$data['totalAmount']) ORDER2/pay_status IS_____".print_r($data['totalAmount'], TRUE));
					}
                    
                    for($i=0;$i< $cartCount;$i++)
                    {
                        $data['invoice'] = $this->vc_orders->invoice_no( $cartinfo[$i]->store_id, $cartinfo[$i]->bnb_product_code );
                        if($mode == 'COD')
                        {
                            $data['payment_status'] = 2;
                        }
                        else
                        {
                            $data['payment_status'] = 1;
                        }
                        $data['shippng_cost']=0.00;
                        $data['shippng_part']=1;
                        
                        if($this->session->userdata('couponid') !== FALSE && $this->session->userdata('redeemedprice') !== FALSE && $this->session->userdata('couponRedeemSuccessBeforePayU') === TRUE )
                        {
                            $data['couponId'] = $this->session->userdata('couponid');
                            $data['redeemedPrice'] = $this->session->userdata('redeemedprice');
                            $data['couponDetails'] = $couponDetails = $this->cartdb->checkCouponId($data['couponId']);
                            if($couponDetails != 0)
                                $this->cartdb->redeemCouponId($couponDetails);
                            $this->session->unset_userdata('couponid');
                            $this->session->unset_userdata('redeemedprice');
                        }
                        /*$this->load->model('contestdb');
                        if($this->contestdb->is_christmas_prod($cartinfo[$i]->product_id) == 1 && $this->contestdb->is_christmas_winner() == 1)
                            $cartinfo[$i]->discount = $cartinfo[$i]->selling_price / 2 ;
                        */

                        /* NEW COUPON FIX SECTION BY SHAMMI */

                        if( $this->session->userdata('couponRedeemSuccessBeforePayU') === TRUE )
                        {
                        	$this->load->model('cartdb');

							$couponId = $this->session->userdata('couponid');
							$totalPurchaseAmount = $this->cartdb->getTotalPurchaseAmount( $this->session->userdata( 'id' ) );
							$data['amountComputed'] = $totalPurchaseAmount;
							
							$id = $sess_userid;
							
							$isLoggedIN = $sess_logged_in;
							
							$isValid = $this->cartdb->checkCouponId($couponId);
							
							log_message('INFO', "\$this->cartdb->checkCouponId(".$couponId.") = ".print_r($isValid, TRUE));
							
							$couponCheckData = array();
							
							$couponCheckData['isValidCoupon'] = FALSE;
							$couponCheckData['isValidUser'] = FALSE;
							$couponCheckData['isValidAmount'] = FALSE;
							$couponCheckData['discounttype'] = NULL;
							$couponCheckData['sessionSet'] = FALSE;
							$couponCheckData['redeemedPrice'] = 0;
							
							if ($isValid !== 0 && $isLoggedIN === TRUE) // proceed only when the coupon exists and a user is logged-in
							{
								log_message('Info', 'Validating redeem bnb coupon code: ' . $couponId . ' entered by User with userid: ' . $id);
								$couponDetails = $isValid;
								$redeemedPrice = 0.0;

								$couponCheckData['isValidCoupon'] = TRUE;
								$couponCheckData['discounttype'] = $isValid['discounttype'];

								if ($couponDetails['discounttype'] == 0)
								{
									//Discount in terms of %
									if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
									{
										$couponCheckData['isValidUser'] = TRUE;
										if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
										{
											$couponCheckData['isValidAmount'] = TRUE;
											$redeemedPrice = (intval($couponDetails['percentoff']) / 100);
											$redeemedPrice = $redeemedPrice * $totalPurchaseAmount;
										}
									}
								}
								elseif($couponDetails['discounttype'] == 1)
								{
									//Discount in terms of Rs.
									if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
									{
										$couponCheckData['isValidUser'] = TRUE;
										if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
										{
											$couponCheckData['isValidAmount'] = TRUE;
											$redeemedPrice = floatval($couponDetails['percentoff']);
										}
									}
								}
								elseif($couponDetails['discounttype'] == 2){ /* discount on a store % */ }
								elseif($couponDetails['discounttype'] == 3){ /* discount on a store Rs */ }
								elseif($couponDetails['discounttype'] == 4){ /* discount on a category % */ }
								elseif($couponDetails['discounttype'] == 5)
								{
								    // discount on a category Rs
									if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
									{
										$couponCheckData['isValidUser'] = TRUE;
										// check if the current cart has products of the category 
										if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
										{
											$couponCheckData['isValidAmount'] = TRUE;
											$redeemedPrice = floatval($couponDetails['percentoff']);
										}
									}
								}
								elseif($couponDetails['discounttype'] == 6){ /* discount on a product % */}
								elseif($couponDetails['discounttype'] == 7){ /* discount on a product Rs */}
								elseif($couponDetails['discounttype'] == 8)
								{
								    // discount on a store %
								    if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
									{
										$couponCheckData['isValidUser'] = TRUE;
										// check if the current cart has products of the store specified in param1
										$hasStoreProducts = $this->cartdb->cartHasCouponProducts( $couponDetails['discounttype'], $couponDetails['param1'] );
										if($hasStoreProducts['result'] === TRUE)
										{
											if($hasStoreProducts['totalPurchaseAmount'] >= $couponDetails['minPurchaseAmount'])
											{
												$couponCheckData['isValidAmount'] = TRUE;
												$redeemedPrice = (intval($couponDetails['percentoff']) / 100);
												$couponCheckData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
												$redeemedPrice = $couponCheckData['finalDiscountAmount']; // hack to send the discounted value instead of percentage(which was being used as a multiplication factor in the shopping_cart view)
											}
										}
									}
								}
								elseif($couponDetails['discounttype'] == 9){/* discount on a store Rs */}
								
								elseif($couponDetails['discounttype'] == 10){ /* discount on a store % */}
								elseif($couponDetails['discounttype'] == 11){ /* discount on a store Rs */}
								elseif($couponDetails['discounttype'] == 12){/* discount on a store % */}
								elseif($couponDetails['discounttype'] == 13){ /* discount on a store Rs */}
								elseif($couponDetails['discounttype'] == 14){}
								elseif($couponDetails['discounttype'] == 15){}
								elseif($couponDetails['discounttype'] == 16){}
								elseif($couponDetails['discounttype'] == 17){}
								elseif($couponDetails['discounttype'] == 18){}
								elseif($couponDetails['discounttype'] == 19){}
								elseif($couponDetails['discounttype'] == 20){}
								elseif($couponDetails['discounttype'] == 21){}
								elseif($couponDetails['discounttype'] == 22){}
								elseif($couponDetails['discounttype'] == 23){}
								elseif($couponDetails['discounttype'] == 24){}
								elseif($couponDetails['discounttype'] == 25){}
								elseif($couponDetails['discounttype'] == 26){ /* discount voucher redeemable that can be used as credit balance by a user */ }

								$couponCheckData['redeemedPrice'] = $redeemedPrice;
								
								if($couponCheckData['isValidAmount'] && $couponCheckData['isValidUser'] === TRUE)
								{
									$this->session->set_userdata('couponid', $couponDetails['couponid']);
									$this->session->set_userdata('redeemedprice', $redeemedPrice);
									$couponRedeemSuccess = $this->session->set_userdata('couponRedeemSuccessBeforePayU', TRUE );

									$data['amountComputed'] = $data['amountComputed'] - $redeemedPrice;
									$data['couponValue'] = floor( $redeemedPrice / $cartCount );
								}
								else
								{
									$this->session->unset_userdata( 'couponid' );
									$this->session->unset_userdata( 'redeemedprice' );
									$data['couponValue'] = 0.00;
								}
							}
							else
							{
								log_message('Info', 'User with userid: ' . $id . ' has entered Invalid couponId!');
							}
                        }

                        /* __END_SECTION__ NEW COUPON FIX BY SHAMMI */
						$pass = $this->vc_orders->place_order($cartinfo[$i], $data);
                        if($pass)
                        {
                            $this->vc_orders->deletecart($cartinfo[$i]);
                        }
                    }
                    $this->session->set_userdata('email',$email);
                    $this->session->set_userdata('e_txn_id',$txnid);
                    /* old code [used redirection] */
				/*$sucess_url = base_url("index.php/invoice_controller/redirecting_to_bnb/".$txnid);
				redirect($sucess_url,'refresh');*/
				/* END old code [used redirection] */
				/* new code by Shammi Shailaj [direct function call] */
				$this->redirecting_to_bnb($txnid);
				/* END new code by Shammi Shailaj [direct function call] */
                }
                else
                {
                    //log_message('Info','Order Failed for the user with userid: '.$this->session->userdata('id').' and ip address: '.$this->input->ip_address());
                    $this->load->model('slog');
                    $this->slog->write(array('level' => 1, 'msg' => 'Order Failed for the user with userid: '.$this->session->userdata('id').' and ip address: '.$this->input->ip_address()));
                    //log_message('Info','Reason for Order Failed for userid: '.$this->session->userdata('id').' and ip: '.$this->input->ip_address());
                    $this->load->model('slog');
                    $this->slog->write( array ( 'level' => 1, 'msg' => 'Reason for Order Failed for userid: '.$this->session->userdata('id').' and ip: '.$this->input->ip_address() ) );
                    $postName=array(0=>'PG_TYPE',1=>'address1',2=>'address2',3=>'amount',4=>'bank_ref_num',5=>'bankcode',6=>'cardhash',7=>'cardnum',8=>'city',9=>'country',10=>'discount',11=>'email',12=>'error',13=>'field1',14=>'field2',15=>'field3',16=>'field4',17=>'field5',18=>'field6',19=>'field7',20=>'field8',21=>'firstname',22=>'hash',23=>'key',24=>'lastname',25=>'mihpayid',26=>'mode',27=>'phone',28=>'productinfo',29=>'state',30=>'status',31=>'txnid',32=>'udf1',33=>'udf10',34=>'udf2',35=>'udf3',36=>'udf4',37=>'udf5',38=>'udf6',39=>'udf7',40=>'udf8',41=>'udf9',42=>'unmappedstatus',43=>'zipcode');
                    foreach($postName as $key=>$name)
                    {
                        $sno = $key+1;
                        //log_message('Info',$sno.'.'.$name.': '.$this->input->post($name));
                        $this->load->model('slog');
                        $this->slog->write(array('level' => 1, 'msg' => $sno.'.'.$name.': '.$this->input->post($name)));
                    }
                    $this->load->view('order_failed',$data);
                }
            }
            
            function payment_success()
            {
			/* ADDED BY SHAMMI SHAILAJ to keep quantities in the new and old products table EQUAL */
			/*log_message('INFO', 'Inside order2/payment_success');
			$this->morder->equateProductsQuantities();
			log_message('INFO', 'end equateProductsQuantities()______________________________________________________');*/
			/* END ADDED BY SHAMMI SHAILAJ */
			
                //print "<p>inside payments success</p>";
                include('header_include.php');
                $data['email'] = $this->session->userdata('email');
                $this->session->unset_userdata('email');
                $txnid= $this->session->userdata('e_txn_id');
                $data['transID'] = $txnid;
                //print "<p>transID = ".$txnid."</p>";
                if(is_null($this->session->userdata('e_txn_id')) || strcmp($this->session->userdata('e_txn_id'), "") === 0)
                {
                    $data['transID'] = NULL;
                }
                $this->session->unset_userdata('e_txn_id');
                
                //purchase email
                $this->load->model('vc_orders');
                /* following code added by shammi to generate data for sokrati and ecommerce tracking */
                if(!is_null($data['transID']))
                {
                    $transDataDB = $this->vc_orders->orderDetails($data['transID']);
                    //print "<pre>";print_r($transDataDB);print "</pre>";
                    //exit();
                    if($transDataDB !== FALSE)
                    {
                        $data['prodsCount'] = count($transDataDB);
                        $data ['buyerFName'] = $transDataDB[0]->shipping_fname;
                        $data ['buyerLName'] = $transDataDB[0]->shipping_lname;
                        $data['buyerAddress'] = $transDataDB[0]->shipping_address;
                        $data['buyerCity'] = $transDataDB[0]->shipping_city;
                        $data['buyerPinCode'] = $transDataDB[0]->shipping_pincode;
                        $data['buyerState'] = $transDataDB[0]->shipping_state;
                        $data['buyerCountry'] = $transDataDB[0]->shipping_country;
                        $data['buyerUserID'] = $transDataDB[0]->user_id;
                        $data['tax'] = 0;
                        $grandTotal = 0;
                        $products = array();
                        if(is_array($products))
                        {
                            for($j=0;$j < $data['prodsCount']; $j++)
                            {
                                $product = new productInfo;
                                $product->storeID = $transDataDB[$j]->store_id;
                                $product->storeName = $transDataDB[$j]->store_name;
                                $order_no = $transDataDB[$j]->order_id;
                                $product->orderID = $transDataDB[$j]->order_id;
                                $product->productName = $transDataDB[$j]->product_name;
                                $product->vSize = $transDataDB[$j]->vsize;
                                $product->vColor = $transDataDB[$j]->vcolor;
                                $product->unitPrice = $transDataDB[$j]->amt_paid;
                                $product->quantity = $transDataDB[$j]->quantity;
                                $grandTotal += $transDataDB[$j]->amt_paid * $transDataDB[$j]->quantity;
                                $product->productID = $transDataDB[$j]->product_id;                               
                                $product->cid = $transDataDB[$j]->couponid;
                                $products[$j] = $product;
                                /* ADDED BY SHAMMI SHAILAJ to keep quantities in the new and old products table EQUAL (NEW METHOD)*/
							//log_message('INFO', 'Inside order2/payment_success');
							$this->load->model('slog');
							$this->slog->write(array('level' => 1, 'msg' => 'Inside order2/payment_success'));
							$this->morder->equateProductsQuantities2($product->productID);
							//log_message('INFO', 'end equateProductsQuantities2()______________________________________________________');
							$this->load->model('slog');
							$this->slog->write(array('level' =>1, 'msg' => 'end equateProductsQuantities2()______________________________________________________'));
                                /* END ADDED BY SHAMMI SHAILAJ */
                            }
                        }
                        else
                        {
                            $product = new productInfo;
                            $product->storeID = $transDataDB->store_id;
                            $product->storeName = $transDataDB->store_name;
                            $order_no = $transDataDB->order_id;
                            $product->orderID = $transDataDB->order_id;
                            $product->productName = $transDataDB->product_name;
                            $product->vSize = $transDataDB->vsize;
                            $product->vColor = $transDataDB->vcolor;
                            $product->unitPrice = $transDataDB->amt_paid;
                            $product->quantity = $transDataDB->quantity;
                            $product->productID = $transDataDB->product_id;
                            $product->cid = $transDataDB->couponid;
                            $grandTotal += $transDataDB->amt_paid * $transDataDB->quantity;
                            $products[] = $product;
                        }
                        $data['grandTotal'] = $grandTotal;
                        $data['products'] = $products;
                    }
                    //print "<pre>";print_r($transDataDB);print "</pre>";
                }
                /* end code added by shammi to generate data for sokrati and ecommerce tracking */
                $base_url = base_url();
                $ip_address = (string)$this->input->ip_address();
                //log_message('Info',"Ipaddress = $ip_address");
                $this->load->model('slog');
                $this->slog->write(array('level' => 1, 'msg' => "Ipaddress = $ip_address"));
                if($ip_address!='127.0.0.1')
                {
                    //log_message('Info',"Allow mail as the Ip is not 127.0.0.1");
                    $this->load->model('slog');
                    $this->slog->write(array('level' =>1, 'msg' => "Allow mail as the Ip is not 127.0.0.1"));
                    $mail_info = $this->vc_orders->purchaseMailDetails($txnid);
                    $this->slog->write(array('level' =>1 ,'msg' => "mail_info FROM ORDERS2/PAYMENT_SUCCESS_____".print_r($mail_info, TRUE)));
                    if($mail_info!=0)
                    {
                        $count_prod = count($mail_info);
                        $buyer_name = $mail_info[0]['shipping_fname'].' '.$mail_info[0]['shipping_lname'];
                        $shipping_address = $mail_info[0]['shipping_address'];
                        $shipping_city = $mail_info[0]['shipping_city'];
                        $pin_code = $mail_info[0]['shipping_pincode'];
                        $couponcode = $mail_info[0]['couponid'];
                        $payment_mode = $mail_info[0]['pg_type'];
                        if ($payment_mode=='COD')
                        {
                            $payment_mode = 'Cash on Delivery';
                        }
                        elseif ($payment_mode=='CC')
                        {
                            $payment_mode = 'Credit Card';
                        }
                        elseif ($payment_mode=='DC')
                        {
                            $payment_mode = 'Debit Card';
                        }
                        elseif ($payment_mode=='NB')
                        {
                            $payment_mode = 'Net Banking';
                        }
                        
                        for($j=0;$j<$count_prod;$j++)
                        {
                            $order_no = $mail_info[$j]['order_id'];
                            $product_name = $mail_info[$j]['product_name'];
                            $variant_size = "Size: ".$mail_info[$j]['variant_size'];
                            $variant_color = "Color: ".$mail_info[$j]['variant_color'];
                            $variant_details = "";
                            $this->slog->write(array('level' => 1,'msg' => "INDEX MAIL VALUE".print_r($mail_info[$j]['sent_email_id'],TRUE)));
                            if ($mail_info[$j]['variant_size']=="0" and $mail_info[$j]['variant_color']=="0")
                            {
                                $variant_details = "";
                            }
                            elseif ($mail_info[$j]['variant_size']!="0" and $mail_info[$j]['variant_color']=="0")
                            {
                                $variant_details = " - (".$variant_size.")";
                            }
                            elseif ($mail_info[$j]['variant_size']=="0" and $mail_info[$j]['variant_color']!="0")
                            {
                                $variant_details = " - (".$variant_color.")";
                            }
                            elseif ($mail_info[$j]['variant_size']!="0" and $mail_info[$j]['variant_color']!="0")
                            {
                                $variant_details = " - (".$variant_size.",".$variant_color.")";
                            }
                            $process_days = (int)$mail_info[$j]['process_days'];
                            $productImagePath = './assets/images/stores/'.$mail_info[$j]['store_id'].'/'.$mail_info[$j]['product_id'].'/';
                            if(file_exists($productImagePath.'fancy3.jpg'))
                            {
                                    $productImage = $productImagePath.'fancy3.jpg';
                            }
                            elseif(file_exists($productImagePath.'fancy3.JPG'))
                            {
                                    $productImage = $productImagePath.'fancy3.JPG';
                            }
                            else
                            {
                                $productImage = '';
                            }
                            //log_message('INFO', 'NOW queueing buyer EMAIL '.$mail_info[$j]['sent_email_id'].' for order no '.$mail_info[$j]['order_id']);
                            $this->load->model('slog');
                            $this->slog->write(array('level' => 1 , 'msg' => 'NOW queueing buyer EMAIL '.$mail_info[$j]['sent_email_id'].' for order no '.$mail_info[$j]['order_id']));
                            include 'mail_4.php';
                            //Buyer Purchase Email
                            $this->load->model('automate_model');
							$jobType = 1; // an email job
							$jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
							/* $jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013 */
							$jobScheduledTime = (time() + 66); // current time + 1 minute 6 seconds
							$jobDetails = array
											(
												'to' => $mail_info[$j]['sent_email_id'],
												'bcc' => 'neworders@buynbrag.com,shammishailaj@gmail.com',
												'subject' => "Your order with BuynBrag.com for order ID ".$order_no,
												'msg' => $purchase_message
											);
							$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
							$this->slog->write( array('level' => 1, 'msg' => "<p>An Email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A (P)', $jobScheduledTime)." </p>" ) );

							$smsMsg = "Dear ".$mail_info[$j]['shipping_fname'].' '.$mail_info[$j]['shipping_lname'].", \r\n Thank you for placing an order with us. Your order ID ".$mail_info[$j]['order_id'];
							$smsMsg .= " will be dispatched by ".date( "d-M-Y", ( strtotime($mail_info[$j]['date_of_pickup']) ) ).". Once dispatched, it will reach you in 1-5 working days. Contact us on +91-8130878822 or ops@buynbrag.com \r\n Team BuynBrag";

							$smsNo = $mail_info[$j]['shipping_phoneno'];
							if($smsNo == '' )
							{
								$smsNo = NULL;
							}
							
							$this->load->model('smsc');
							$this->smsc->sendSMS($smsNo, $smsMsg);
							$this->slog->write( array( 'level' => 1, 'msg' => 'Just sent an SMS to '.json_encode($smsNo).'. The msg sent is <p>'.$smsMsg.'</p>' ) );

							// now set an email job to be executed only after 24 hours if the seller has not sent the mail
							$orderEmail11Data = array();
							
							$orderEmail11Data['storeOwnerName'] = $mail_info[$j]['owner_name'];
							$orderEmail11Data['orderID'] = $mail_info[$j]['order_id'];
							$orderEmail11Data['dispatchDate'] = $mail_info[$j]['date_of_pickup'];
							$orderEmail11Data['storeOwnerEmail'] = $mail_info[$j]['contact_email'];
							$orderEmail11Data['storeName'] = $mail_info[$j]['store_name'];
							$orderEmail11Data['productName'] = $mail_info[$j]['product_name'];
							$orderEmail11Data['productID'] = $mail_info[$j]['product_id'];
							$orderEmail11Data['bnbProductCode'] = $mail_info[$j]['bnb_product_code'];
							$orderEmail11Data['amountPaid'] = $mail_info[$j]['amt_paid'] * $mail_info[$j]['quantity'];
							$orderEmail11Data['paymentType'] = $mail_info[$j]['pg_type'];
							$orderEmail11Data['buyerName'] = $mail_info[$j]['shipping_fname']." ".$mail_info[$j]['shipping_lname'];
							$orderEmail11Data['buyerAddress'] = $mail_info[$j]['shipping_address']."<br/>".$mail_info[$j]['shipping_city']."<br/>".$mail_info[$j]['shipping_pincode'];
							$orderEmail11Data['buyerContactNumber'] = $mail_info[$j]['shipping_phoneno'];
							$orderEmail11Data['processingTime'] = $mail_info[$j]['process_days'];

							$orderEmail11 = $this->load->view('emailers/orderEmail11', $orderEmail11Data, TRUE);

							$jobType = 4; // a check and then send email job depending upon the result of the check
							$jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate index";
							/* $jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013 */
							$jobScheduledTime = (time() + 86460); // current time + 1 day (24 hrs 1 minute)
							$jobDetails = array
											(
												'orderID' => $order_no,
												'to' => ( (empty($mail_info[$j]['contact_email']) )? $mail_info[$j]['contact_email'] : 'ops@buynbrag.com'),
												'bcc' => 'ops@buynbrag.com,prt@buynbrag.com,shammishailaj@gmail.com',
												'subject' => "Your order with BuynBrag.com for order ID ".$order_no,
												'msg' => $orderEmail11
											);
							$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
							$this->slog->write( array('level' => 1, 'msg' => "<p>A check and then email job has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A T (P)', $jobScheduledTime)." </p>" ) );
							/* OLD EMAIL SENDING CODE
                            $this->load->library('email');
                            $mailArraylog = array();
                            $this->email->from('support@buynbrag.com','BuynBrag');
                            $this->email->to($mail_info[$j]['sent_email_id']);
                            $this->email->bcc('neworders@buynbrag.com,shammishailaj@gmail.com');
                            $this->email->subject("BuynBrag: Order Success,Order Id:$order_no");

                            $this->email->message($purchase_message);
                            $this->email->set_newline("\r\n");
                            if($this->email->send())
                            {
                                log_message('Info', 'SUCCESSFULLY SENT EMAIL to buyer  '.$mail_info[$j]['sent_email_id'].' for order no '.$mail_info[$j]['order_id']);
                                $mailArraylog = array('level' => 1, 'send status' => 1,'to' => $mail_info[$j]['sent_email_id'],'bcc' =>'neworders@buynbrag.com,shammishailaj@gmail.com','From' => 'support@buynbrag.com','mail content' => $purchase_message);
                                $this->load->model('slog');
                                $this->slog->write($mailArraylog);
                            }
                            else
                            {
                                log_message('Info', 'FAILED SENDING EMAIL to buyer  '.$mail_info[$j]['sent_email_id'].' for order no '.$mail_info[$j]['order_id']);
                            }*/

                            //////////////////////////////
                            $owner_name = $mail_info[$j]['owner_name'];
                            $owner_email = $mail_info[$j]['contact_email'];
                            $total_amount = $mail_info[$j]['amt_paid'] * $mail_info[$j]['quantity'];
                            include 'mail_7.php';

                            $sellerSMSMsg = "Dear ".$mail_info[$j]['owner_name'].", \r\n You have recieved a new order for ".$mail_info[$j]['product_name'].". The order ID is ".$mail_info[$j]['order_id'];
							$sellerSMSMsg .= " and the quantity ordered is ".$mail_info[$j]['quantity'].". Please make sure that the product is dispatched by ".date( "d-M-Y", ( ( strtotime($mail_info[$j]['date_of_pickup']) ) - 86400) ).". Contact us on +91-8130878822 or ops@buynbrag.com \r\n Team BuynBrag";

							$sellerSMSNo = $mail_info[$j]['contact_number'];
							if($sellerSMSNo == '' )
							{
								$sellerSMSNo = NULL;
							}
							
							$this->smsc->sendSMS($sellerSMSNo, $sellerSMSMsg);
							$this->slog->write( array( 'level' => 1, 'msg' => 'Just sent seller SMS to '.json_encode($sellerSMSNo).'. The msg sent is <p>'.$sellerSMSMsg.'</p>' ) );

                            //Seller New Order Email
							
							/*$config['protocol'] = 'smtp';
							$config['smtp_host'] = 'ssl://smtp.googlemail.com';
							$config['smtp_port'] = 465;
							$config['smtp_user'] = 'info@buynbrag.com';
							$config['smtp_pass'] = '';*/

                            $this->load->library('email');
                            $mailArraylog2 = array();
                            $this->email->clear(TRUE);
                            $this->email->from('support@buynbrag.com','BuynBrag');
                            if(empty($owner_email))
                            {
                            	//log_message('INFO', 'Seller email ('.$mail_info[$j]['contact_email'].') is empty. Sellers EMAIL will be sent to neworders@buynbrag.com');
                            	$this->load->model('slog');
                            	$this->slog->write(array('level' => 1 , 'msg' => 'Seller email ('.$mail_info[$j]['contact_email'].') is empty. Sellers EMAIL will be sent to neworders@buynbrag.com'));
                                $owner_email = 'neworders@buynbrag.com';
                            }

                            $this->email->to($owner_email);
                            $this->email->bcc('shammishailaj@gmail.com,rajat.bhagat@buynbrag.com,prt@buynbrag.com,ayushjain@buynbrag.com,lucky@buynbrag.com,finance@buynbrag.com');
                            $this->email->subject("New Order from BuynBrag,Order Id:".$order_no);
                            $this->email->message($new_order_message);
                            $this->email->attach('./invoice/'.$txnid.'/buyer_invoice_order_'.$order_no.'.pdf');
                            
                            if(!empty($productImage))
                            {
                                $this->email->attach($productImage);
                            }

                            $this->email->set_newline("\r\n");
                            
                            if($this->email->send())
                            {
                                //log_message('Info',"Seller eMail sent to $owner_email for order no: $order_no");
                                $this->load->model('slog');
                                $this->slog->write(array('level' => 1 , 'msg' => "Seller eMail sent to $owner_email for order no: $order_no" ));
                                $mailArraylog2 = array('level' => 1, 'send status' => 1,'to' => $owner_email,'bcc' =>'rajat.bhagat@buynbrag.com,prt@buynbrag.com,ayushjain@buynbrag.com,lucky@buynbrag.com,finance@buynbrag.com,shammishailaj@gmail.com','From' => 'support@buynbrag.com','emsg' => $new_order_message);
                                $this->load->model('slog');
                                $this->slog->write($mailArraylog2);
                                if($j==($count_prod-1))
                                {
                                    $this->vc_orders->purchase_mail_success($txnid);
                                }
                            }
                            else
                            {
                                //log_message('Info',"ERROR occurred while sending Seller email to $owner_email order no: $order_no");
                                $this->load->model('slog');
                                $this->slog->write( array('level' => 1, 'msg' => "ERROR occurred while sending Seller email to $owner_email order no: ".$order_no, 'debug' => $this->email->print_debugger() ) );
                                $mailArraylog2 = array('level' => 1, 'send status' => 0,'to' => $owner_email,'bcc' =>'rajat.bhagat@buynbrag.com,prt@buynbrag.com,ayushjain@buynbrag.com,lucky@buynbrag.com,finance@buynbrag.com,shammishailaj@gmail.com','From' => 'support@buynbrag.com','emsg' => $new_order_message);
                                $this->load->model('slog');
                                $this->slog->write($mailArraylog2);
                                
                            }
                            $this->email->clear(TRUE);
                            //end email send
                        }//end for
                        
                    }//end if mail_info !=0
                }
                else
                {
                    log_message('Info',"Don't Allow mail as the Ip is 127.0.0.1");
                    $this->load->model('slog');
                    $this->slog->write(array('level' => 1, 'msg' => "Don't Allow mail as the Ip is 127.0.0.1"));
                }
            $this->load->view('order_success',$data);
         }

        function purchase_history()
        {
            $url = base_url('user_info/purchase_history');
            redirect($url,'location');
        }

        public function calculate($weight,$pincode,$iscod,$issur)
	{
		$this->load->model('shipping');
             $weight1= $weight*1000;
		//$data['isvalid'] = $this->shipping->isvalidPin($weight1,$pincode,$iscod,$issur);
		$data['isvalid'] = 1;
		//print_r($data['isvalid']);
		echo "<br />";
             if(count($data['isvalid'])>0) {
			//echo "vallid PIN " .$data['isvalid'][0]->part_name;
			//echo "<br />";
                    $data['weight'] = $this->shipping->calc($weight1,$issur);
			// print_r($data['weight']);
                    $shipping_cost=0;
                    if($data['isvalid'][0]->part_name==1) {
                            if($weight1>=5000 && $weight1<=1000000) {
                                $shipping_cost=$data['weight'][0]->fedx_cost*$weight;
                            }
                            else {
                                    $shipping_cost=$data['weight'][0]->fedx_cost;
                            }
                            return $shipping_cost."_".$data['isvalid'][0]->part_name;
                    }
                    else if($data['isvalid'][0]->part_name==2) {
                            if($weight1>=5000 && $weight1<=1000000) {
                                $shipping_cost=$data['weight'][0]->blue_cost*$weight;
                            }
                            else {
                                $shipping_cost=$data['weight'][0]->blue_cost;
                            }
                        return $shipping_cost."_".$data['isvalid'][0]->part_name;
                    }
                    else if($data['isvalid'][0]->part_name==3) {
                        if($weight1>=10000 && $weight1<=5000000) {
                                $shipping_cost=$data['weight'][0]->gati_cost*$weight;
				}
                        else {
                                $shipping_cost=$data['weight'][0]->gati_cost;
				}
                        return $shipping_cost."_".$data['isvalid'][0]->part_name;
				}
			}
             else {
			echo "We cant delivers to u as Pin is not in our circle .Sorry";
		}
	}

}?>
