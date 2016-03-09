<?php
class Cart extends CI_Controller
{
	public $userID = NULL;
	public $isLoggedIN = NULL;
	public $isReallyLoggedIN = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->userID = $this->session->userdata('id');
		$this->isLoggedIN = $this->session->userdata('logged_in');
		$this->isReallyLoggedIN = ($this->userID !== FALSE && $this->isLoggedIN !== FALSE && is_numeric($this->userID) && $this->userID > 0 && $this->isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
	}

	public function shopping_cart()
	{
		include 'header_for_controller.php';
		if($isLoggedIN['status'] === TRUE)
		{
			if (!isset($data['cart']) || count($data['cart']) < 1)
			{
				log_message('Info', "User with userid: " . $this->session->userdata('id') . " and ip: " . $this->input->ip_address() . " is accessing: his empty cart.");
				$this->load->view('empty_cart', $data);
			}
			else
			{
				if ($this->session->userdata('userArr'))
				{
					log_message('Info', 'Removing the stored session value of Amount and other user\'s checkout related session variables.');
					$this->session->unset_userdata('userArr');
				}
				//$data['session_redeemVal'] = $this->session->userdata('redeemedprice');
				log_message('Info', "User with userid: " . $this->session->userdata('id') . " and ip: " . $this->input->ip_address() . " is accessing: cart which has got " . count($data['cart']) . ' Product(s)');
				
				$data['cart'] = $this->cartdb->mycartforuser($this->session->userdata('id'));

				$totalPurchaseAmount = $this->cartdb->getTotalPurchaseAmount( $this->session->userdata( 'id' ) );
				log_message('INFO', "cart/shopping_cart:::totalPurchaseAmount = ".$totalPurchaseAmount);
				//$data['amount'] = $totalPurchaseAmount;

				//log_message('INFO', "Before coupon computation, \$data['amount'] = ".$data['amount']." and \$data['tax'] = ".$data['tax']);
				//$data['couponValue'] = 0.00;
				
				$id = $this->session->userdata('id');
				
				$isLoggedIN = $this->session->userdata('logged_in');
				
				$isValid = $this->cartdb->checkCouponId( $this->session->userdata('couponid') );
				
				log_message('INFO', "\$this->cartdb->checkCouponId(".$this->session->userdata('couponid').") = ".print_r($isValid, TRUE));
				
				$couponCheckData = array();
				
				$couponCheckData['isValidCoupon'] = FALSE;
				$couponCheckData['isValidUser'] = FALSE;
				$couponCheckData['isValidAmount'] = FALSE;
				$couponCheckData['discounttype'] = NULL;
				$couponCheckData['sessionSet'] = FALSE;
				$couponCheckData['redeemedPrice'] = 0;

				$data['session_redeemVal'] = 0.0;
				$redeemedPrice = 0.0;
				
				if ($isValid !== 0 && $isLoggedIN === TRUE) // proceed only when the coupon exists and a user is logged-in
				{
					log_message('Info', 'Validating redeem bnb coupon code: ' . $this->session->userdata('couponid') . ' entered by User with userid: ' . $id);
					$couponDetails = $isValid;

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

				$data['session_redeemVal'] = $redeemedPrice;

				$this->load->view('shopping_cart', $data);
			}
		}
		else
		{
			redirect(base_url().'#!/login?next='.urlencode('/cart/shopping_cart'));
		}
	}

	public function deleteItem($cartID)
	{
		$this->load->model('async_model');
		
		$response = NULL;
		$responseData = array();
		
		$responseData['result'] = $this->async_model->deleteCartItem($cartID);
		$response = json_encode($responseData);

		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	function confirmRedeemCoupon()
	{
		$couponId = $this->input->get('coupon_id', TRUE);
		$id = $this->session->userdata('id');
		$isLoggedIN = $this->session->userdata('logged_in');
		$responseData = array();
		$responseData['isValid'] = FALSE;
		log_message('Info', 'User with userid: ' . $id . ' is trying to redeem bnb coupon with couponid: ' . $couponId);
		$isValid = $this->cartdb->checkCouponId($couponId);
		if ($isValid !== 0 && $isLoggedIN === TRUE) // proceed only when the coupon exists and a user is logged-in
		{
			log_message('Info', 'User with userid: ' . $id . ' has entered correct redeem bnb coupon code: ' . $couponId);
			if($isValid['userID'] == $id || $isValid['userID'] == 0)
			{
				$responseData['isValid'] = TRUE;
				//$couponDetails = $isValid['couponid'] . '/' . $isValid['percentoff'] . '/' . $isValid['discounttype'].'/'.$isValid['validFrom'] . '/' . $isValid['validUpto'] . '/' . $isValid['userID']. '/' . $isValid['minPurchaseAmount'];
				//echo $couponDetails;
				$responseData['couponid'] = $isValid['couponid'];
				$responseData['percentoff'] = $isValid['percentoff'];
				$responseData['discounttype'] = $isValid['discounttype'];
				$responseData['validFrom'] = $isValid['validFrom'];
				$responseData['validUpto'] = $isValid['validUpto'];
				$responseData['userID'] = $isValid['userID'];
				$responseData['minPurchaseAmount'] = $isValid['minPurchaseAmount'];
				$responseData['param1'] = $isValid['param1'];
				$responseData['finalDiscountAmount'] = 0;
				$responseData['isValidUser'] = NULL;

				if($responseData['discounttype'] == 8)
				{
				    // discount on a store %
				    if($responseData['userID'] == $id || $responseData['userID'] == 0)
					{
						$responseData['isValidUser'] = TRUE;
						// check if the current cart has products of the store specified in param1
						$hasStoreProducts = $this->cartdb->cartHasCouponProducts( $responseData['discounttype'], $responseData['param1'] );
						
						$responseData['storeName'] = $hasStoreProducts['storeName'];
						if($hasStoreProducts['result'] === TRUE)
						{
							log_message('INFO', "totalPurchaseAmount = ".$hasStoreProducts['totalPurchaseAmount'].", minPurchaseAmount = ".$responseData['minPurchaseAmount']);
							if($hasStoreProducts['totalPurchaseAmount'] >= $responseData['minPurchaseAmount'])
							{
								$responseData['isValidAmount'] = TRUE;
								$redeemedPrice = (intval($responseData['percentoff']) / 100);
								$responseData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
							}
							else
							{
								$responseData['isValid'] = FALSE;
							}
						}
						else
						{
							$responseData['isValid'] = FALSE;
						}
					}
				}
				elseif($responseData['discounttype'] == 5)
				{
				    // discount on a category Rs
					if($responseData['userID'] == $id || $responseData['userID'] == 0)
					{
						$responseData['isValidUser'] = TRUE;
						// check if the current cart has products of the category
						$hasStoreProducts = $this->cartdb->cartHasCouponProducts( $responseData['discounttype'], $responseData['param1'] );
						
						if($hasStoreProducts['result'] === TRUE)
						{
							if($hasStoreProducts['totalPurchaseAmount'] >= $responseData['minPurchaseAmount'])
							{
								$responseData['isValidAmount'] = TRUE;
								$redeemedPrice = (intval($responseData['percentoff']) / 100);
								$responseData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
							}
							else
							{
								$responseData['isValid'] = FALSE;
							}
						}
						else
						{
							$responseData['isValid'] = FALSE;
						}
					}
				}
				elseif($responseData['discounttype'] == 24)
				{
					// discount on selected set of products %
					if( $responseData['userID'] == $id || $responseData['userID'] == 0 )
					{
						$responseData['isValidUser'] = TRUE;
						
						// read the list of selected products for the current couponID
						$couponProducts = $this->cartdb->couponProducts( $responseData['couponid'] );

						// check if the current cart has products of the store specified in param1
						$hasCouponProducts = $this->cartdb->cartHasCouponProducts( $responseData['discounttype'], $responseData['param1'], $couponProducts );
	
					}
				}
			}
		}
		else
		{
			log_message('Info', 'User with userid: ' . $id . ' has entered Invalid redeem bnb coupon code: ' . $couponId);
			//echo $isValid;
			$responseData['isValid'] = FALSE;
		}
		log_message( 'INFO', "\r\nresponseData = \r\n".print_r($responseData, TRUE) );
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}

	function redeemCoupon()
	{
		$couponId = $this->input->get('coupon_id', TRUE);
		$totalPurchaseAmount = $this->input->get('totalPurchaseAmount', TRUE);
		$id = $this->session->userdata('id');
		$isLoggedIN = $this->session->userdata('logged_in');
		$isValid = $this->cartdb->checkCouponId($couponId);
		log_message('INFO', "\$this->cartdb->checkCouponId(".$couponId.") = ".print_r($isValid, TRUE));
		$responseData = array();
		$responseData['isValidCoupon'] = FALSE;
		$responseData['isValidUser'] = FALSE;
		$responseData['isValidAmount'] = FALSE;
		$responseData['discounttype'] = NULL;
		$responseData['sessionSet'] = FALSE;
		$responseData['redeemedPrice'] = 0;
		if ($isValid !== 0 && $isLoggedIN === TRUE) // proceed only when the coupon exists and a user is logged-in
		{
			log_message('Info', 'Validating redeem bnb coupon code: ' . $couponId . ' entered by User with userid: ' . $id);
			$couponDetails = $isValid;
			$redeemedPrice = 0.0;

			$responseData['isValidCoupon'] = TRUE;
			$responseData['discounttype'] = $isValid['discounttype'];

			if ($couponDetails['discounttype'] == 0)
			{
				//Discount in terms of %
				if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
				{
					$responseData['isValidUser'] = TRUE;
					if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
					{
						$responseData['isValidAmount'] = TRUE;
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
					$responseData['isValidUser'] = TRUE;
					if($totalPurchaseAmount >= $couponDetails['minPurchaseAmount'])
					{
						$responseData['isValidAmount'] = TRUE;
						$redeemedPrice = floatval($couponDetails['percentoff']);
					}
				}
			}
			elseif($couponDetails['discounttype'] == 2)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 3)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 4)
			{
			    // discount on a category %
			}
			elseif($couponDetails['discounttype'] == 5)
			{
			    // discount on a category Rs
				if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
				{
					$responseData['isValidUser'] = TRUE;
					// check if the current cart has products of the category
					$hasStoreProducts = $this->cartdb->cartHasCouponProducts( $couponDetails['discounttype'], $couponDetails['param1'] );
					if($hasStoreProducts['result'] === TRUE)
					{
						if($hasStoreProducts['totalPurchaseAmount'] >= $couponDetails['minPurchaseAmount'])
						{
							$responseData['isValidAmount'] = TRUE;
							$redeemedPrice = (intval($couponDetails['percentoff']) / 100);
							$responseData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
							$redeemedPrice = $responseData['finalDiscountAmount']; // hack to send the discounted value instead of percentage(which was being used as a multiplication factor in the shopping_cart view)
						}
					}
				}
			}
			elseif($couponDetails['discounttype'] == 6)
			{
			    // discount on a product %
			}
			elseif($couponDetails['discounttype'] == 7)
			{
			    // discount on a product Rs
			}
			elseif($couponDetails['discounttype'] == 8)
			{
			    // discount on a store %
			    if($couponDetails['userID'] == $id || $couponDetails['userID'] == 0)
				{
					$responseData['isValidUser'] = TRUE;
					// check if the current cart has products of the store specified in param1
					$hasStoreProducts = $this->cartdb->cartHasCouponProducts( $couponDetails['discounttype'], $couponDetails['param1'] );
					if($hasStoreProducts['result'] === TRUE)
					{
						if($hasStoreProducts['totalPurchaseAmount'] >= $couponDetails['minPurchaseAmount'])
						{
							$responseData['isValidAmount'] = TRUE;
							$redeemedPrice = (intval($couponDetails['percentoff']) / 100);
							$responseData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
							$redeemedPrice = $responseData['finalDiscountAmount']; // hack to send the discounted value instead of percentage(which was being used as a multiplication factor in the shopping_cart view)
						}
					}
				}
			}
			elseif($couponDetails['discounttype'] == 9)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 10)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 11)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 12)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 13)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 14)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 15)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 16)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 17)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 18)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 19)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 20)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 21)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 22)
			{
			    // discount on a store %
			}
			elseif($couponDetails['discounttype'] == 23)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 24)
			{
			    // discount on selected products %

			}
			elseif($couponDetails['discounttype'] == 25)
			{
			    // discount on a store Rs
			}
			elseif($couponDetails['discounttype'] == 26)
			{
			    // discount voucher redeemable that can be used as credit balance by a user
			}

			$responseData['redeemedPrice'] = $redeemedPrice;
			
			if($responseData['isValidAmount'] && $responseData['isValidUser'] === TRUE)
			{
				$this->session->set_userdata('couponid', $couponDetails['couponid']);
				$this->session->set_userdata('redeemedprice', $redeemedPrice);

				$session_couponid = $this->session->userdata('couponid');
				$session_redeemVal = $this->session->userdata('redeemedprice');
				
				log_message('INFO', "session_couponid = ".print_r($session_couponid, TRUE));
				log_message('INFO', "session_redeemVal = ".print_r($session_redeemVal, TRUE));
				
				if ( strcmp( $session_couponid, $couponDetails['couponid'] ) === 0 && strcmp( $session_redeemVal, $redeemedPrice ) === 0)
				{
					log_message('Info', 'User with userid: ' . $id . ' has entered correct redeem bnb coupon code: ' . $couponId . '. He can now redeem it successfully.');
					$responseData['sessionSet'] = TRUE;
				}
				else
				{
					log_message('Info', 'User with userid: ' . $id . ' has entered Invalid redeem bnb coupon code: ' . $couponId . ' Some crap happened I guess!');
				}
			}
		}
		else
		{
			log_message('Info', 'User with userid: ' . $id . ' has entered Invalid couponId!');
		}

		$response = json_encode($responseData, JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}

	public function removeCoupon()
	{
		// check if a user is logged-in or not

		// check if there is any coupon set or not
		// if there is one remove it from the session and return relevant information
		$responseData = array();
		$response = NULL;
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['couponFound'] = FALSE;
		$responseData['couponRemoved'] = FALSE;

		switch($this->isReallyLoggedIN)
		{
			case TRUE:	$coupon = $this->session->userdata('couponid');
						$redeemedPrice = $this->session->userdata('redeemedprice');

						switch( $redeemedPrice !== FALSE && $coupon !== FALSE )
						{
							case TRUE:	$responseData['couponFound'] = TRUE;
										$this->session->unset_userdata('couponid'); // delete any coupon ids from session
										$this->session->unset_userdata('redeemedprice'); // delete redeemedprice associated with the coupon

										$coupon2 = $this->session->userdata('couponid');
										$redeemedPrice2 = $this->session->userdata('redeemedprice');

										switch( $redeemedPrice2 === FALSE && $coupon2 === FALSE )
										{
											case TRUE:	$responseData['couponRemoved'] = TRUE;
												break;
										}
								break;
						}
				break;
		}

		$response = json_encode($responseData, JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK);
		$this->output->set_content_type("application/json");
		$this->output->set_output($response);
	}
}

?>
