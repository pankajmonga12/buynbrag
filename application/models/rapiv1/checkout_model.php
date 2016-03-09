<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');

class Checkout_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function readUserCart($userID = NULL)
	{
		switch( !is_null($userID) && is_numeric($userID) )
		{
			case TRUE:	$q1SQL = "SELECT `cart`.`cart_id` AS `cartID`, `cart`.`product_id` AS `productID`, `cart`.`cart_quantity` AS `quantity`, `cart`.`user_id` AS `userID`,";
						$q1SQL .= " `cart`.`store_id` AS `storeID`, `session_id` AS `sessionID`, `cart`.`date_time` AS `addedOn`, `cart`.`vsize`, `cart`.`vcolor`,";
						$q1SQL .= " `store_info`.`store_name` AS `storeName`, `store_info`.`COD_policy` AS `storeCODPolicy`, `store_info`.`EMI_policy` AS `storeEMIPolicy`,";
						$q1SQL .= " `store_info`.`return_policy` AS `storeReturnPolicy`, `products`.`cat_id`, `products`.`sub_catid1`, `products`.`sub_catid2`, `products`.`sub_catid3`, `products`.`product_name` AS `productName`,";
						$q1SQL .= " `products`.`is_on_discount` AS `isOnDiscount`, `products`.`selling_price` AS `originalPrice`, `products`.`processing_time` AS `processingTime`,";
						$q1SQL .= " `products`.`discount` AS `discountAmount`, `products`.`quantity` AS `availableQuantity`, `store_info`.`store_name` AS `storeName`";

						$q1SQL .= " FROM `cart`";

						$q1SQL .= " LEFT JOIN `store_info` ON `cart`.`store_id` = `store_info`.`store_id`";
						$q1SQL .= " LEFT JOIN `products` ON `cart`.`product_id` = `products`.`product_id`";
						
						$q1SQL .= " WHERE `user_id` = ".$userID." AND `products`.`quantity` > 0";

						$q1 = $this->db->query( $q1SQL );

						switch( $q1->num_rows() > 0 )
						{
							case TRUE:	return $q1->result();
								break;
						}
				break;
		}
	}

	public function appliedCoupons($userID = NULL)
	{
		$retVal = array();
		$retVal['couponID'] = NULL;
		$retVal['redeemedPrice'] = NULL;

		switch( ! is_null($userID) && is_numeric($userID) )
		{
			case TRUE:	switch( $this->session->userdata('couponid') !== FALSE && $this->session->userdata('redeemedprice') !== FALSE && $this->session->userdata('id') === $userID && $this->session->userdata('logged_in') === TRUE )
						{
							case TRUE:	$retVal['couponID'] = $this->session->userdata('couponid');
										$retVal['redeemedPrice'] = $this->session->userdata('redeemedprice');
								break;
						}
				break;
		}

		return $retVal;
	}

	public function readCoupon($couponID = NULL, $userID = NULL)
	{
		switch( !is_null( $couponID ) && !is_null( $userID ) && is_numeric( $userID ) )
		{
			case TRUE:	$q1SQL = "SELECT `sno` AS `couponSerialNumber`, `couponid` AS `couponID`, `percentoff` AS `couponValue`, `usecount` AS `couponsCount`,";
						$q1SQL .= " `discounttype` AS `couponType`, `validFrom`, `validUpto`, `minPurchaseAmount`, `user_id` AS `userID`, `param1`";
						$q1SQL .= " FROM `coupon` WHERE `user_id` = ".$userID." AND `validFrom` <= ".time()." AND `validUpto` >= ".time()." AND `couponid` = '".$couponID."'";

						$q1 = $this->db->query( $q1SQL );
						switch( $q1->num_rows() > 0 )
						{
							case TRUE:	$r1 = $q1->result();
										return $r1[0];
								break;
						}
				break;
			case FALSE:	return $couponID;
				break;
		}
	}

	public function userID2Email( $userID = NULL )
	{
		$q1SQL = "SELECT `email` FROM `user_details` WHERE `user_id` = ".$userID." LIMIT 1";
		$q1 = $this->db->query( $q1SQL );
		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$r1 = $q1->result();
						return $r1[0]->email;
				break;
			case FALSE:	return FALSE;
				break;
		}
	}

	public function saveState( $stateData )
	{
		$keyName = 'created';
		$q2Result = FALSE;
		$checkoutID = 0;
		switch( !is_null( $stateData['userID'] ) && is_numeric( $stateData['userID'] ) )
		{
			case TRUE:	// check if there exists any state data for the current user
						$q1SQL = "SELECT `checkoutID` FROM `checkout` WHERE user_id = ".$stateData['userID'];
						$q1 = $this->db->query( $q1SQL );
						$q2SQL = NULL;
						$updateFlag = TRUE; // true = update query, false = insert query

						$stateDataToSave = json_decode( json_encode( $stateData, JSON_NUMERIC_CHECK ), TRUE );
						
						switch( $q1->num_rows() > 0 )
						{
							case TRUE:	$result = $q1->result();
										$checkoutID = $result[0]->checkoutID;

										$q2SQL = "UPDATE `checkout` SET `stateData` = '".json_encode($stateData, JSON_NUMERIC_CHECK)."' WHERE `checkoutID` = ".$checkoutID;
										$updateFlag = TRUE;
										$keyName = 'saved';
								break;
							case FALSE:	$q2SQL = "INSERT INTO `checkout`(`user_id`, `stateData`) VALUES(".$stateData['userID'].", '".json_encode($stateData, JSON_NUMERIC_CHECK)."')";
										$updateFlag = FALSE;
								break;
						}

						switch( !is_null( $q2SQL ) )
						{
							case TRUE:	log_message( 'INFO', "Query being Executed is:\r\n".$q2SQL );
										$q2 = $this->db->query( $q2SQL );
										$q2Result = ($q2 ? TRUE: FALSE);
								break;
						}
				break;
		}

		$newID = $this->db->insert_id();
		return array( $keyName => $q2Result, 'aRows' => $this->db->affected_rows(), 'newID' => $newID, 'savedID' => ($newID !== 0? $newID: $checkoutID) );
	}

	public function setAddress( $addressType = 1, $addressID = NULL, $userID = NULL )
	{
		$retVal = array( 'validParams' => FALSE, 'addressExists' => FALSE, 'stateDataExists' => FALSE, 'addressSet' => FALSE, 'stateSaved' => FALSE );

		switch( ( $addressType == 1 || $addressType == 2 || $addressType == 3 ) && ! is_null($addressID) && !is_null($userID) && is_numeric($userID) )
		{
			case TRUE:	/* check if the address exists in the DB */
						/* if it does, add it to the checkout session in the checkout table */
						/* if it does not, return error */
						
						$retVal['validParams'] = TRUE;

						$q1SQL = "SELECT `addressID` FROM `address` WHERE `addressID` = ".$addressID." AND `user_id`  = ".$userID;
						log_message('INFO', "query being executed".$q1SQL);
						$q1 = $this->db->query( $q1SQL );

						switch( $q1->num_rows() > 0 )
						{
							case TRUE:	$retVal['addressExists'] = TRUE;

										$q2SQL = "SELECT `checkoutID`, `user_id` AS `userID`, `stateData` FROM `checkout` WHERE `user_id` = ".$userID;
										log_message('INFO', "query being executed".$q2SQL);

										$q2 = $this->db->query( $q2SQL );

										switch( $q2->num_rows() > 0 )
										{
											case TRUE:	$retVal['stateDataExists'] = TRUE;
											
														$q2Result = $q2->result();
														$q2Result = $q2Result[0];
														log_message( 'INFO', "stateData = \r\n".print_r( $q2Result->stateData, TRUE ) );
														
														$stateData = get_object_vars( json_decode( $q2Result->stateData ) );
														log_message( 'INFO', "after json_decode and get_object_vars, stateData = \r\n".print_r( $stateData, TRUE ) );

														$stateData['stepID'] = 2;
														

														switch( $addressType == 1 )
														{
															case TRUE:	$stateData['shippingAddressID'] = $addressID;
																break;
														}

														switch( $addressType == 2 )
														{
															case TRUE:	$stateData['billingAddressID'] = $addressID;
																break;
														}

														switch( $addressType == 3 )
														{
															case TRUE:	$stateData['shippingAddressID'] = $addressID;
																		$stateData['billingAddressID'] = $addressID;
																break;
														}

														log_message('INFO', "stateData = \r\n".print_r($stateData, TRUE) );

														$retVal['stateSaved'] = $this->saveState( $stateData );

														switch( $retVal['stateSaved']['savedID'] === $q2Result->checkoutID )
														{
															case TRUE:	$retVal['addressSet'] = TRUE;
																break;
														}
												break;
										}
								break;
						}
				break;
		}

		log_message('INFO', "data being returned".print_r($retVal, TRUE) );
		return $retVal;
	}

	public function setPaymentOption( $shippingAddressID = NULL, $billingAddressID = NULL, $paymentMode = NULL, $userID = NULL )
	{
		$retVal = array(
						'validParams' => FALSE,
						'addressExists' => FALSE,
						'stateDataExists' => FALSE,
						'addressSet' => FALSE,
						'paymentOptionSet' => FALSE,
						'paymentOptionConflict' => FALSE,
						'nonCODProducts' => NULL,
						'nonCODProductsCount' => 0,
						'stateSaved' => FALSE,
						'isServiceable' => FALSE,
						'coupons' => array( 'hasCoupon' => FALSE, 'isValid' => FALSE, 'removed' => FALSE, 'removedID' => NULL )
				);

		switch( !is_null( $shippingAddressID ) && !is_null( $billingAddressID ) && ! is_null( $paymentMode ) && !is_null($userID) && is_numeric($shippingAddressID) && is_numeric($billingAddressID) && is_numeric($paymentMode) && is_numeric($userID) )
		{
			case TRUE:	/* check if the address exists in the DB */
						/* if it does, add it to the checkout session in the checkout table */
						/* if it does not, return error */
						
						$retVal['validParams'] = TRUE;

						$q1SQL = "SELECT `addressID`, `zipCode` FROM `address` WHERE `addressID` IN (".$shippingAddressID.", ".$billingAddressID.") AND `user_id`  = ".$userID;
						log_message('DEBUG', "query being executed     ".$q1SQL);
						$q1 = $this->db->query( $q1SQL );

						switch( $q1->num_rows() > 0 )
						{
							case TRUE:	$retVal['addressExists'] = TRUE;

										/*
										* WRITE CODE HERE TO CHECK IF THE SHIPPING ADDRESS IS SERVICEABLE BY FEDEX
										* IF IT IS, PROCEED ONLY THEN; ELSE, RETURN $retVal
										*/

										$q2SQL = "SELECT `checkoutID`, `user_id` AS `userID`, `stateData` FROM `checkout` WHERE `user_id` = ".$userID;
										log_message('INFO', "query being executed     ".$q2SQL);

										$q2 = $this->db->query( $q2SQL );

										switch( $q2->num_rows() > 0 )
										{
											case TRUE:	$retVal['stateDataExists'] = TRUE;
											
														$q2Result = $q2->result();
														$q2Result = $q2Result[0];
														log_message( 'INFO', "stateData = \r\n".print_r( $q2Result->stateData, TRUE ) );
														
														$stateData = get_object_vars( json_decode( $q2Result->stateData ) );
														log_message( 'INFO', "after json_decode and get_object_vars, stateData = \r\n".print_r( $stateData, TRUE ) );

														$stateData['stepID'] = 2;

														// check if the stateData has any removed coupons. If it has, then recheck if the coupon is applicable to the
														//   current cart in stateData. If it is, apply the coupon and store the discounts

														// check if the stateData has paymentMode set. If it has been and it is COD and the current payemntMode is online, then
														if( isset( $stateData['paymentMode'] ) && $stateData['paymentMode'] == 2 && $paymentMode == 1 )
														{
															// check if there are onlinePayableProducts. If it has, then,
															if( isset( $stateData['onlinePayableProducts'] ) && is_array($stateData['onlinePayableProducts']) && count( $stateData['onlinePayableProducts'] ) > 0 )
															{
																// read all products from onlinePayableProducts and add them to the cartData
																$stateData['cartData'][] = $stateData['onlinePayableProducts'];
																
																// add the total of the onlinePayableProducts to cartTotal
																$stateData['cartTotal'] += $stateData['onlinePayableProductsTotal'];

																$totalPurchaseAmount = $stateData['cartTotal']; // the total of the new cart data
																
																// change / update the values of cartGrandTotal, cartTotal and onlinePayableProductsTotal, nonCODProductsCount
																$stateData['onlinePayableProductsTotal'] = 0; // make the onlinePayableProductsTotal = 0
																unset( $stateData['onlinePayableProductsTotal'] ); // remove the onlinePayableProductsTotal key from the stateData array
																
																$stateData['onlinePayableProducts'] = NULL; // delete all data from onlinePayableProducts key
																unset( $stateData['onlinePayableProducts'] ); // remove the onlinePayableProducts key from the stateData array

																$stateData['nonCODProductsCount'] = 0; // make the nonCODProductsCount = 0
																unset( $stateData['nonCODProductsCount'] ); // unset the key nonCODProductsCount from the stateData array

																// check if a coupon has been set or it has been removed
																if( isset( $stateData['coupons'] ) && isset( $stateData['coupons']->couponID ) && ( $stateData['coupons']->couponID !== NULL || $stateData['coupons']->removedID !== NULL ) )
																{
																	$coupons = $stateData['coupons'];
																	// if a coupon has been set or it has been removed
																	// re-test its validity
																	$couponDetails = $this->readCoupon( $coupons->couponID, $userID );
																	$responseData = array( 'isValidUser' => FALSE, 'isValidAmount' => FALSE, 'finalDiscountAmount' => 0.00 );

																	log_message( 'INFO', "couponDetails = ".print_r( $couponDetails, TRUE ) );
																	if( !is_null( $couponDetails ) ) // proceed only when the coupon exists and is valid
																	{
																		$responseData = NULL;
																		log_message( 'Info', 'Validating redeem bnb coupon code: '.$coupons->couponID.' entered by User with userid: '. $userID );
																		
																		$redeemedPrice = 0.00;

																		if ( $couponDetails->couponType == 0 )
																		{
																			//Discount in terms of %
																			if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																			{
																				if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
																				{
																					$redeemedPrice = ( intval( $couponDetails->couponValue ) / 100 );
																					$redeemedPrice = $redeemedPrice * $totalPurchaseAmount;
																				}
																			}
																		}
																		elseif($couponDetails->couponType == 1)
																		{
																			//Discount in terms of Rs.
																			if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																			{
																				$responseData['isValidUser'] = TRUE;
																				if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
																				{
																					$responseData['isValidAmount'] = TRUE;
																					$redeemedPrice = floatval( $couponDetails->couponValue );
																				}
																			}
																		}
																		elseif($couponDetails->couponType == 2)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 3)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 4)
																		{
																		    // discount on a category %
																		}
																		elseif($couponDetails->couponType == 5)
																		{
																		    // discount on a category Rs
																			if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																			{
																				$responseData['isValidUser'] = TRUE;
																				// check if the current cart has products of the category 
																				if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
																				{
																					$responseData['isValidAmount'] = TRUE;
																					$redeemedPrice = floatval( $couponDetails->couponValue );
																				}
																			}
																		}
																		elseif($couponDetails->couponType == 6)
																		{
																		    // discount on a product %
																		}
																		elseif($couponDetails->couponType == 7)
																		{
																		    // discount on a product Rs
																		}
																		elseif( $couponDetails->couponType == 8 )
																		{
																		    // discount on a store %
																		    if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																			{
																				$responseData['isValidUser'] = TRUE;
																				$hasStoreProducts = array('result' => FALSE, 'totalPurchaseAmount' => 0.00, 'storeName' => NULL);
																				// check if the current cart has products of the store specified in param1
																				if(! is_null($couponDetails->couponType) && ! is_null($couponDetails->param1) && is_numeric($couponDetails->couponType) && $couponDetails->couponType >= 0 && $couponDetails->couponType <= 26)
																				{
																					$purchaseAmount = 0;
																					foreach($newCartData as $tmp)
																					{
																						if($tmp->storeID == $couponDetails->param1) // if the current product is from the same store on which the coupon can be applied
																						{
																							switch($tmp->isOnDiscount == 1)
																							{
																								case TRUE:	$purchaseAmount += ( $tmp->quantity * ( $tmp->originalPrice - $tmp->discountAmount ) );
																									break;
																								case FALSE:	$purchaseAmount += ( $tmp->quantity * $tmp->originalPrice );
																									break;
																							}
																							$hasStoreProducts['result'] = TRUE;
																						}
																					}
																					$hasStoreProducts['totalPurchaseAmount'] = $purchaseAmount;
																				}

																				if($hasStoreProducts['result'] === TRUE)
																				{
																					if($hasStoreProducts['totalPurchaseAmount'] >= $couponDetails->minPurchaseAmount )
																					{
																						$responseData['isValidAmount'] = TRUE;
																						$redeemedPrice = ( intval( $couponDetails->couponValue ) / 100 );
																						$responseData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
																						$redeemedPrice = $responseData['finalDiscountAmount']; // hack to send the discounted value instead of percentage(which was being used as a multiplication factor in the shopping_cart view)
																					}
																				}
																			}
																		}
																		elseif($couponDetails->couponType == 9)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 10)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 11)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 12)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 13)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 14)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 15)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 16)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 17)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 18)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 19)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 20)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 21)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 22)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 23)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 24)
																		{
																		    // discount on a store %
																		}
																		elseif($couponDetails->couponType == 25)
																		{
																		    // discount on a store Rs
																		}
																		elseif($couponDetails->couponType == 26)
																		{
																		    // discount voucher redeemable that can be used as credit balance by a user
																		}
																		
																		$coupons->redeemedPrice = $redeemedPrice;
																		log_message( 'INFO', "responseData = ".print_r($responseData, TRUE) );

																		switch( $coupons->redeemedPrice <= 0.00 )
																		{
																			case TRUE:	$retVal['coupons']['removed'] = TRUE;
																						$retVal['coupons']['removedID'] = $coupons->couponID;
																						$coupons->removedID = $coupons->couponID;
																						$coupons->couponID = NULL;
																						$coupons->removed = TRUE;
																				break;
																			case FALSE:	$retVal['coupons']['hasCoupon'] = TRUE;
																						$retVal['coupons']['isValid'] = ( $coupons->redeemedPrice > 0.00 ) ? TRUE: FALSE;
																				break;
																		}
																	}
																	$stateData['coupons'] = $coupons; // store the changes in $coupons object in the stateData['coupons']
																}
															}
														}

														$stateData['paymentMode'] = $paymentMode;

														$stateData['shippingAddressID'] = $shippingAddressID;
														$stateData['billingAddressID'] = $billingAddressID;

														// traverse through the cart data and find if there are any products that do not match the payment mode selected
														$cartData = $stateData['cartData'];
														log_message( 'INFO', "cartData = ".print_r( $cartData, TRUE ) );

														switch( $paymentMode == 2 ) // COD payment mode selected
														{
															case TRUE:	// loop through all the cart data to check if all the products have COD payment option available
																		// and weed out the online ones in a temporary array
																		log_message( 'INFO', "paymentMode = ".$paymentMode );
															
																		$t = array(); // temporary array to store the cartItems that can not be checked out using the COD payment method
																		$newCartData = array();
																		$nonCODProductsCount = 0; // online only product counter
																		if( array_key_exists( 'onlinePayableProducts', $stateData ) )
																		{
																			$nonCODProductsCount = count( $stateData['onlinePayableProducts'] );
																			log_message('INFO', 'the array key, onlinePayableProducts exists in stateData and its count is: '.$nonCODProductsCount);
																		}
																		else
																		{
																			log_message('INFO', 'the array key, onlinePayableProducts does not exist in stateData');
																		}

																		$nonCODProducts = array(); // online only products
																		$onlinePayableProductsTotal = 0.00; // total of online products
																		$totalPurchaseAmount = 0.00; // the total of the new cart data


																		foreach( $cartData as $key => $cartItem ) // traverse through the cart data
																		{
																			switch( $cartItem->storeCODPolicy == 0 ) // if the product has COD disabled
																			{
																				case TRUE:	$t[] = $cartItem; // store the product in the temporary array
																							unset( $cartData[ $key ] ); // delete the product from the cartData array
																							$nonCODProductsCount++; // increment the online only product counter
																							$nonCODProducts[] = $cartItem->productID; // save the productID that can not be purchased using the COD payment method
																							$onlinePayableProductsTotal = ( ($cartItem->isOnDiscount == 0) ? $cartItem->originalPrice : ($cartItem->originalPrice - $cartItem->discountAmount) );
																					break;
																				case FALSE:	$newCartData[] = $cartItem; // store the COD enabled product in a new temporary array
																							$totalPurchaseAmount += ( ($cartItem->isOnDiscount == 0) ? $cartItem->originalPrice : ($cartItem->originalPrice - $cartItem->discountAmount) );
																					break;
																			}
																		}

																		log_message( 'INFO', "totalPurchaseAmount = ". $totalPurchaseAmount );

																		$stateData['cartData'] = $newCartData; // store the new cart data in the checkout state data
																		$stateData['cartTotal'] = $totalPurchaseAmount;

																		$stateData['nonCODProductsCount'] = $nonCODProductsCount; // store the count of products that can not be purchased using the COD option

																		log_message( 'INFO', "nonCODProductsCount = ".$nonCODProductsCount );

																		switch( $nonCODProductsCount > 0 ) // check if there are any products that can only be purchased using online payment method
																		{
																			case TRUE:	if( !array_key_exists('onlinePayableProducts', $stateData) )
																						{
																							$stateData['onlinePayableProducts'] = $t; // store them under the key "onlinePayableProducts" in the stateData
																							$stateData['onlinePayableProductsTotal'] = $onlinePayableProductsTotal;
																						}
																						$retVal['paymentOptionConflict'] = TRUE; // set the paymentOptionConflict key of the array being returned to TRUE in order to let the user know there are conflicting products
																						$retVal['nonCODProductsCount'] = $nonCODProductsCount; // store the number of products that can not be purchased using the COD payment option
																						$retVal['nonCODProducts'] = $nonCODProducts; // store the productIDs

																						// check if the user has coupons
																						$coupons = $stateData['coupons'];

																						log_message( 'INFO', "coupons = ".print_r( $coupons, TRUE ) );

																						switch( $coupons->couponID !== NULL && $coupons->redeemedPrice !== NULL )
																						{
																							case TRUE:	// check if the coupon is valid on the modified cart
																										// if it is, then do nothing. otherwise, remember to not allow
																										// the redemption
																										
																										$couponDetails = $this->readCoupon( $coupons->couponID, $userID );
																										$responseData = array( 'isValidUser' => FALSE, 'isValidAmount' => FALSE, 'finalDiscountAmount' => 0.00 );


																										log_message( 'INFO', "couponDetails = ".print_r( $couponDetails, TRUE ) );
																										if( !is_null( $couponDetails ) ) // proceed only when the coupon exists and is valid
																										{
																											$responseData = NULL;
																											log_message( 'Info', 'Validating redeem bnb coupon code: '.$coupons->couponID.' entered by User with userid: '. $userID );
																											
																											$redeemedPrice = 0.00;

																											if ( $couponDetails->couponType == 0 )
																											{
																												//Discount in terms of %
																												if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																												{
																													if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
																													{
																														$redeemedPrice = ( intval( $couponDetails->couponValue ) / 100 );
																														$redeemedPrice = $redeemedPrice * $totalPurchaseAmount;
																													}
																												}
																											}
																											elseif($couponDetails->couponType == 1)
																											{
																												//Discount in terms of Rs.
																												if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																												{
																													$responseData['isValidUser'] = TRUE;
																													if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
																													{
																														$responseData['isValidAmount'] = TRUE;
																														$redeemedPrice = floatval( $couponDetails->couponValue );
																													}
																												}
																											}
																											elseif($couponDetails->couponType == 2)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 3)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 4)
																											{
																											    // discount on a category %
																											}
																											elseif($couponDetails->couponType == 5)
																											{
																											    // discount on a category Rs
																												if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																												{
																													$responseData['isValidUser'] = TRUE;
																													// check if the current cart has products of the category 
																													if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
																													{
																														$responseData['isValidAmount'] = TRUE;
																														$redeemedPrice = floatval( $couponDetails->couponValue );
																													}
																												}
																											}
																											elseif($couponDetails->couponType == 6)
																											{
																											    // discount on a product %
																											}
																											elseif($couponDetails->couponType == 7)
																											{
																											    // discount on a product Rs
																											}
																											elseif( $couponDetails->couponType == 8 )
																											{
																											    // discount on a store %
																											    if($couponDetails->userID == $userID || $couponDetails->userID == 0)
																												{
																													$responseData['isValidUser'] = TRUE;
																													$hasStoreProducts = array('result' => FALSE, 'totalPurchaseAmount' => 0.00, 'storeName' => NULL);
																													// check if the current cart has products of the store specified in param1
																													if(! is_null($couponDetails->couponType) && ! is_null($couponDetails->param1) && is_numeric($couponDetails->couponType) && $couponDetails->couponType >= 0 && $couponDetails->couponType <= 26)
																													{
																														$purchaseAmount = 0;
																														foreach($newCartData as $tmp)
																														{
																															if($tmp->storeID == $couponDetails->param1) // if the current product is from the same store on which the coupon can be applied
																															{
																																switch($tmp->isOnDiscount == 1)
																																{
																																	case TRUE:	$purchaseAmount += ( $tmp->quantity * ( $tmp->originalPrice - $tmp->discountAmount ) );
																																		break;
																																	case FALSE:	$purchaseAmount += ( $tmp->quantity * $tmp->originalPrice );
																																		break;
																																}
																																$hasStoreProducts['result'] = TRUE;
																															}
																														}
																														$hasStoreProducts['totalPurchaseAmount'] = $purchaseAmount;
																													}

																													if($hasStoreProducts['result'] === TRUE)
																													{
																														if($hasStoreProducts['totalPurchaseAmount'] >= $couponDetails->minPurchaseAmount )
																														{
																															$responseData['isValidAmount'] = TRUE;
																															$redeemedPrice = ( intval( $couponDetails->couponValue ) / 100 );
																															$responseData['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
																															$redeemedPrice = $responseData['finalDiscountAmount']; // hack to send the discounted value instead of percentage(which was being used as a multiplication factor in the shopping_cart view)
																														}
																													}
																												}
																											}
																											elseif($couponDetails->couponType == 9)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 10)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 11)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 12)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 13)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 14)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 15)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 16)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 17)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 18)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 19)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 20)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 21)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 22)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 23)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 24)
																											{
																											    // discount on a store %
																											}
																											elseif($couponDetails->couponType == 25)
																											{
																											    // discount on a store Rs
																											}
																											elseif($couponDetails->couponType == 26)
																											{
																											    // discount voucher redeemable that can be used as credit balance by a user
																											}
																											
																											$coupons->redeemedPrice = $redeemedPrice;
																											log_message( 'INFO', "responseData = ".print_r($responseData, TRUE) );

																											switch( $coupons->redeemedPrice <= 0.00 )
																											{
																												case TRUE:	$retVal['coupons']['removed'] = TRUE;
																															$retVal['coupons']['removedID'] = $coupons->couponID;
																															$coupons->removedID = $coupons->couponID;
																															$coupons->couponID = NULL;
																															$coupons->removed = TRUE;
																													break;
																												case FALSE:	$retVal['coupons']['hasCoupon'] = TRUE;
																															$retVal['coupons']['isValid'] = ( $coupons->redeemedPrice > 0.00 ) ? TRUE: FALSE;
																													break;
																											}
																										}
																								break;
																						}
																						$stateData['coupons'] = $coupons;
																						log_message( 'INFO', "totalPurchaseAmount ( After Coupons computation ) = ". $totalPurchaseAmount );
																				break;
																		}
																break;
														}

														log_message('INFO', "stateData = \r\n".print_r($stateData, TRUE) );

														$retVal['stateSaved'] = $this->saveState( $stateData );

														switch( $retVal['stateSaved']['savedID'] === $q2Result->checkoutID )
														{
															case TRUE:	$retVal['addressSet'] = TRUE;
																		$retVal['paymentOptionSet'] = TRUE;
																break;
														}
												break;
										}
								break;
						}
				break;
		}

		log_message('INFO', "data being returned".print_r($retVal, TRUE) );
		return $retVal;
	}

	public function hasCheckoutStateData( $userID = NULL )
	{
		switch( !is_null($userID) && is_numeric( $userID ) )
		{
			case TRUE:	$q1SQL = "SELECT `checkoutID` FROM `checkout` WHERE `user_id` = ".$userID;
						$q1 = $this->db->query( $q1SQL );

						return ( $q1->num_rows() > 0 );
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	public function readCheckoutStateData( $userID = NULL, $raw = FALSE )
	{
		switch( !is_null($userID) && is_numeric( $userID ) )
		{
			case TRUE:	$q1SQL = "SELECT `checkoutID`, `user_id` AS `userID`, `stateData` FROM `checkout` WHERE `user_id` = ".$userID;
						$q1 = $this->db->query( $q1SQL );

						switch( $q1->num_rows() > 0 )
						{
							case TRUE:	$t = $q1->result();
										$t2 = NULL;
										switch( $raw )
										{
											case TRUE:	$t2 = $t[0]->stateData;
												break;
											case FALSE:	$t2 = json_decode( $t[0]->stateData );
												break;
										}
										return array( 'checkoutID' => $t[0]->checkoutID, 'userID' => $t[0]->userID, 'stateData' => $t2, "txn" => $this->createBNBUUID(5) );
								break;
							case FALSE:	return NULL;
								break;
						}
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	public function canPurchase($userID = NULL)
	{
		switch( !is_null($userID) && is_numeric($userID) )
		{
			case TRUE:	$q1SQL = "SELECT `canPurchase` FROM `user_details`WHERE(`user_id` = ".$userID.")";
						$q1 = $this->db->query($q1SQL);
						switch($q1->num_rows() > 0)
						{
							case TRUE:	$r1 = $q1->result();
										$r1 = $r1[0]->canPurchase;
										switch($r1)
										{
											case 1:	return TRUE;
												break;
											default:	return FALSE;
												break;
										}
								break;
							case FALSE:	return FALSE;
								break;
						}
				break;
			case FALSE: return FALSE;
				break;
		}
	}

	public function invoiceNumber( $storeID/*, $bnbProductCode */)
	{
		$q1SQL = "SELECT `invoice_no`, `company_code` FROM `store_info` WHERE `store_id` = ".$storeID;
		$q1 = $this->db->query( $q1SQL );
		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$r1 = $q1->result();
						$invoiceNumber = $r1[0]->invoice_no;
						if( $invoiceNumber == '99999' )
						{
							$q2SQL = "UPDATE `store_info` SET `store_info`.`invoice_no` = 1 WHERE `store_id` = ".$storeID;
							$q2 = $this->db->query( $q2 );
						}

						$n = (int) strlen( $invoiceNumber );
						$diff = 5 - $n;
						$inNo = '';
						if( $diff > 0 )
						{
							for( $i = 0; $i < $diff; $i++ )
							{
								$inNo .= '0';
							}
						}
						$inNo .= $invoiceNumber;

						// $strCode = explode('_', $bnbProductCode);
						$strCode = $r1[0]->company_code;
						// $invoice_no = array('invoiceNumber' => $strCode[1].date('Y').$inNo);
						
						//--???--$invoiceNumber = array( 'invoiceNumber' => $strCode.date('Y').$inNo );

						$q3SQL = "UPDATE `store_info` SET `invoice_no` = `invoice_no` + 1 WHERE `store_id` = ".$storeID;
						$q3 = $this->db->query( $q3SQL );

						return $strCode.date('Y').$inNo;
				break;
			case FALSE:	return NULL;
				break;
		}
	}

	// create a unique BNB UUID. entityType = 1 - product, 2 - store, 3 - user, 4 - order, 5 - transaction

	public function createBNBUUID( $entityType = 1 )
	{
		// format = entityType-unixTimestamp-ip2long(currentIPAddress)-substr(md5(uniqid(rand(), true)),0,16)-$this->session->userdata('DBID');
		return strtoupper( base_convert( $entityType, 10, 16 ).'-'.base_convert( time(), 10, 16).'-'.base_convert( ip2long( $this->input->ip_address() ), 10, 16 ).'-'.substr( md5( uniqid( rand(), true ) ), 0, 16 ) ).'-'.$this->session->userdata('DBID');
	}

	public function isInStock( $productID, $quantity = NULL )
	{
		switch( $quantity === NULL || !is_numeric( $quantity ) )
		{
			case TRUE:	$quantity = 0;
				break;
		}
		$q1SQL = "SELECT `product_id` FROM `products` WHERE `product_id` = ".$productID." AND `quantity` > ".$quantity;
		$q1 = $this->db->query( $q1SQL );
		return ( ( $q1->num_rows() > 0 )? TRUE: FALSE );
	}

	public function processCOD( $userID = NULL )
	{
		/*
		* check if a userID has been provided
		* if it is, check if the user has some stateData saved with them
		* if they don't have, return $retVal else, continue
		* store count($stateData['cartData']) in cartCount
		* if a coupon has been redeemed, then check again in the DB if it is still valid.
		* * If it is, compute floor( $stateData['coupons']->redeemedPrice / cartCount ) and store that value as redeemedAvgPrice
		* generate a new transactionID
		* continue and loop through all the items in the $stateData['cartData'] starting from $looper = 0, $failedLooper = 0
		* * * read current product from $stateData['cartData']
		* * * if it is available in stock, get an invoice number using $this->invoiceNumber and make an entry in the orders table and then do $stateData['cartData'][$looper] = NULL;$looper++;continue LOOP
		* * * else, do $stateData['failedOrder'][$failedLooper] = array('product' => $stateData['cartData'][$looper], 'reason' => "ouOfStock")
		*/
		$retVal['validUserID'] = FALSE;
		$retVal['hasCheckoutStateData'] = FALSE;

		if( $userID !== NULL )
		{
			$retVal['validUserID'] = TRUE;
			$q1SQL = "SELECT `checkoutID`, `user_id`, `stateData` FROM `checkout` WHERE `user_id` = ".$userID;
			$q1 = $this->db->query( $q1SQL );

			switch( $q1->num_rows() > 0 )
			{
				case TRUE:	$r1 = $q1->result();
							$r1 = $r1[0];
							$retVal['hasCheckoutStateData'] = TRUE;
							$stateData = get_object_vars( json_decode( $r1->stateData ) );
							$cartCount = count( $stateData['cartData'] ); // count the number of products that can be purchased using COD
							if( $cartCount > 0 ) // if there are products which can be checked out
							{
								$coupons = $stateData['coupons'];
								$txnID = $this->createBNBUUID( 5 ); // create a new UUID for this transaction
								$failedOrders = array(); // array to hold failed cart items
								$orders = array(); // array to hold successful order IDs
								$newCartData = array(); // new cart data that needs to be written back to the stateData
								$orderedItems = array(); // save the cart items order for which was placed
								$totalAmountToBePaid = 0.00;

								$shippingAddressID = $stateData['shippingAddressID'];
								$billingAddressID = $stateData['billingAddressID'];
								
								$looper = $failedLooper = 0;
								foreach( $stateData['cartData'] as $cartItem )
								{
									if( $this->isInStock( $cartItem->productID, $cartItem->quantity ) ) // if the product is available in the Database
									{
										$this->db->trans_begin(); // begin a DB transaction
										$q2SQL = "UPDATE `products` SET `quantity` = `quantity` - 1 WHERE `product_id` = ".$cartItem->productID;
										$q2 = $this->db->query( $q2SQL );

										$amountToBePaid = ($cartItem->isOnDiscount == 0)? $cartItem->originalPrice : ( $cartItem->originalPrice - $cartItem->discountAmount );
										$pTime = $cartItem->processingTime + 5;
										switch($pTime == 0)
										{
											case TRUE:	$pTime += 10;
												break;
										}

										$pTime = time() + ($pTime * 24 * 3600); // convert $pTime to seconds and add that to the current timestamp
            							$pTime = date('Y-m-d', $pTime); // convert to mysql compatible format


										$q3SQL = "INSERT INTO `orders`(`invoice_no`, `txnid`, `pg_type`, `product_id`, `status_order`, `quantity`, `user_id`,";
										$q3SQL .= " `store_id`, `amt_paid`, `payment_status`, `date_of_pickup`, `shipping_partner`, `vsize`, `vcolor`,";
										$q3SQL .= " `shippingAddressID`, `billingAddressID`, `shipping_emailid`)";
										$q3SQL .= " VALUES('".$this->invoiceNumber( $cartItem->storeID )."', '".$txnID."', 'COD', ".$cartItem->productID.", 1, ".$cartItem->quantity.", ".$cartItem->userID.",";
										$q3SQL .= " ".$cartItem->storeID.", ".$amountToBePaid.", 2, '".$pTime."', 1, '".$cartItem->vsize."', '".$cartItem->vcolor."',";
										$q3SQL .= " ".$shippingAddressID.", ".$billingAddressID.", '".$stateData['email']."')";
										$q3 = $this->db->query( $q3SQL );

										$q31SQL = "DELETE FROM `cart` WHERE `cart_id` = ".$cartItem->cartID;
										$q31 = $this->db->query( $q31SQL );

										$q32SQL = "UPDATE address SET `useCount` = `useCount` + 1 WHERE `addressID` IN (".$shippingAddressID.", ".$billingAddressID.")";
										$q32 = $this->db->query( $q32SQL );
										
										switch($this->db->trans_status() !== FALSE)
										{
											case TRUE:	$orders[] = $this->db->insert_id(); // for a successful order store the orderID
														$totalAmountToBePaid += $amountToBePaid;
														$orderedItems[] = $cartItem;
														$this->db->trans_commit(); // commit the changes
												break;
											case FALSE:	$failedOrders[] = $cartItem; // for a failed order(failed query), store the entire cartItem
														$this->db->trans_rollback(); // rollback any changes made
												break;
										}
									}
									else
									{
										$failedOrders[] = $cartItem; // for a failed order(failed query), store the entire cartItem
									}
								}

								$stateData['cartData'] = $failedOrders;
								if( $coupons->couponID !== NULL ) // if a coupon has been redeemed
								{
									$totalPurchaseAmount = $totalAmountToBePaid;
									$couponDetails = $this->readCoupon( $coupons->couponID, $userID ); // if the coupon is valid
									log_message( 'INFO', "couponDetails = ".print_r( $couponDetails, TRUE ) );
									$tDiscountedProducts = NULL;
									if( !is_null( $couponDetails ) ) // proceed only when the coupon exists and is valid
									{
										log_message( 'Info', 'Validating redeem bnb coupon code: '.$coupons->couponID.' entered by User with userid: '. $userID );
										
										$redeemedPrice = 0.00;

										if ( $couponDetails->couponType == 0 )
										{
											//Discount in terms of %
											if($couponDetails->userID == $userID || $couponDetails->userID == 0)
											{
												if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
												{
													$redeemedPrice = ( intval( $couponDetails->couponValue ) / 100 );
													$redeemedPrice = $redeemedPrice * $totalPurchaseAmount;
												}
											}
										}
										elseif($couponDetails->couponType == 1)
										{
											//Discount in terms of Rs.
											if($couponDetails->userID == $userID || $couponDetails->userID == 0)
											{
												$retVal['coupons']['isValidUser'] = TRUE;
												if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
												{
													$retVal['coupons']['isValidAmount'] = TRUE;
													$redeemedPrice = floatval( $couponDetails->couponValue );
												}
											}
										}
										elseif($couponDetails->couponType == 6){ /* discount on a product % */}
										elseif($couponDetails->couponType == 7){ /* discount on a product Rs */ }
										elseif( $couponDetails->couponType == 8 )
										{
										    // discount on a store %
										    if($couponDetails->userID == $userID || $couponDetails->userID == 0)
											{
												$retVal['coupons']['isValidUser'] = TRUE;
												$hasStoreProducts = array('result' => FALSE, 'totalPurchaseAmount' => 0.00, 'storeName' => NULL);
												// check if the current cart has products of the store specified in param1
												if(! is_null($couponDetails->couponType) && ! is_null($couponDetails->param1) && is_numeric($couponDetails->couponType) && $couponDetails->couponType >= 0 && $couponDetails->couponType <= 26)
												{
													$purchaseAmount = 0;
													foreach($orderedItems as $key => $tmp)
													{
														if($tmp->storeID == $couponDetails->param1) // if the current product is from the same store on which the coupon can be applied
														{
															switch($tmp->isOnDiscount == 1)
															{
																case TRUE:	$purchaseAmount += ( $tmp->quantity * ( $tmp->originalPrice - $tmp->discountAmount ) );
																			$tDiscountedProducts[] = $tmp->productID;
																	break;
																case FALSE:	$purchaseAmount += ( $tmp->quantity * $tmp->originalPrice );
																	break;
															}
															$hasStoreProducts['result'] = TRUE;
														}
													}
													$hasStoreProducts['totalPurchaseAmount'] = $purchaseAmount;
												}

												if($hasStoreProducts['result'] === TRUE)
												{
													if($hasStoreProducts['totalPurchaseAmount'] >= $couponDetails->minPurchaseAmount )
													{
														$retVal['coupons']['isValidAmount'] = TRUE;
														$redeemedPrice = ( intval( $couponDetails->couponValue ) / 100 );
														$retVal['coupons']['finalDiscountAmount'] = $hasStoreProducts['totalPurchaseAmount'] * $redeemedPrice;
														$redeemedPrice = $retVal['coupons']['finalDiscountAmount']; // hack to send the discounted value instead of percentage(which was being used as a multiplication factor in the shopping_cart view)
													}
												}
											}
										}
										elseif($couponDetails->couponType == 2){ /* discount on a store % */}
										elseif($couponDetails->couponType == 3){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 4){ /* discount on a category % */ }
										elseif($couponDetails->couponType == 5)
										{
										    // discount on a category Rs
											if($couponDetails->userID == $userID || $couponDetails->userID == 0)
											{
												$retVal['coupons']['isValidUser'] = TRUE;
												// check if the current cart has products of the category 
												if( $totalPurchaseAmount >= $couponDetails->minPurchaseAmount )
												{
													$retVal['coupons']['isValidAmount'] = TRUE;
													$redeemedPrice = floatval( $couponDetails->couponValue );
												}
											}
										}
										elseif($couponDetails->couponType == 9){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 10){ /* discount on a store % */}
										elseif($couponDetails->couponType == 11){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 12){ /* discount on a store % */ }
										elseif($couponDetails->couponType == 13){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 14){ /* discount on a store % */ }
										elseif($couponDetails->couponType == 15){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 16){ /* discount on a store % */ }
										elseif($couponDetails->couponType == 17){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 18){ /* discount on a store % */ }
										elseif($couponDetails->couponType == 19){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 20){ /* discount on a store % */ }
										elseif($couponDetails->couponType == 21){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 22){ /* discount on a store % */ }
										elseif($couponDetails->couponType == 23){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 24){ /* discount on a store % */ }
										elseif($couponDetails->couponType == 25){ /* discount on a store Rs */ }
										elseif($couponDetails->couponType == 26){ /* discount voucher redeemable that can be used as credit balance by a user */ }
										
										$coupons->redeemedPrice = $redeemedPrice;
										log_message( 'INFO', "responseData = ".print_r($responseData, TRUE) );

										switch( $coupons->redeemedPrice <= 0.00 )
										{
											case TRUE:	$retVal['coupons']['removed'] = TRUE;
														$retVal['coupons']['removedID'] = $coupons->couponID;
														$coupons->removedID = $coupons->couponID;
														$coupons->couponID = NULL;
														$coupons->removed = TRUE;
												break;
											case FALSE:	$retVal['coupons']['hasCoupon'] = TRUE;
														$retVal['coupons']['isValid'] = ( $coupons->redeemedPrice > 0.00 ) ? TRUE: FALSE;
														if( $retVal['coupons']['isValid'] === TRUE )
														{
															$tDiscountedProductsCount = ( is_array( $tDiscountedProducts ) )? count( $tDiscountedProducts ): 0;
															$orderedItemsCount = ( $tDiscountedProductsCount > 0 )? $tDiscountedProductsCount: count( $orderedItems );
															$redeemedAvgPrice = floor($redeemedPrice / $orderedItemsCount);
															if( $tDiscountedProductsCount > 0 )
															{
																$q4SQL = "UPDATE `orders` SET `redeemedprice` = ".$redeemedAvgPrice;
																$q4SQL .= " WHERE `txnid` = '".$txnID."' AND `product_id` IN(".implode(",", $tDiscountedProducts).")";
																$q4 = $this->db->query( $q4SQL );
																$retVal['coupons']['couponRedeemed'] = ( $this->db->affected_rows() >= $orderedItemsCount )? TRUE: FALSE;
																if( $retVal['coupons']['couponRedeemed'] === TRUE )
																{
																	$q5SQL = "UPDATE `coupon` SET `usecount` = `usecount` - 1 WHERE `couponid` = '".$coupons->couponID;
																	$q5 = $this->db->query( $q5SQL );
																	$retVal['coupons']['couponRedeemedDB'] = ( $this->db->affected_rows() >= $orderedItemsCount )? TRUE: FALSE;
																	$coupons->couponID = NULL; // remove the coupon from the stateData
																	$this->session->unset_userdata('couponid'); // delete any coupon ids from session
																	$this->session->unset_userdata('redeemedprice'); // delete redeemedprice associated with the coupon
																}
															}
														}
												break;
										}
									}
								}
								$stateData['coupons'] = $coupons;
								$retVal['stateSaved'] = $this->saveState( $stateData );
							}
					break;
			}
		}

		return $retVal;
	}

	public function getTransaction( $transID = NULL, $userID = NULL )
	{
		if( $userID !== NULL && $transID !== NULL && is_numeric( $userID ) && is_string( $transID ) )
		{
			$q1SQL = "SELECT * FROM `orders`, `address` WHERE `orders`.`txnid` = '".$transID."' AND `orders`.`user_id` = ".$userID." AND `address`.`addressID` IN(`orders`.`shippingAddressID`, `orders`.`billingAddressID`)";
			$q1 = $this->db->query( $q1SQL );
			switch( $q1->num_rows() > 0 )
			{
				case TRUE:	return $q1->result();
					break;
				case FALSE:	return NULL;
					break;
			}
		}
		else
		{
			return NULL;
		}
	}

	public function getTransactions( $userID = NULL )
	{
		if( $userID !== NULL  && is_numeric( $userID ) )
		{
			$q1SQL = "SELECT `txnid`, `date_of_order`, COUNT(`order_id`) AS `totalOrders` FROM `bnbdbTest`.`orders` WHERE `user_id` = 141 GROUP BY `txnid`";
			$q1 = $this->db->query( $q1SQL );
			switch( $q1->num_rows() > 0 )
			{
				case TRUE:	return $q1->result();
					break;
				case FALSE:	return NULL;
					break;
			}
		}
		else
		{
			return NULL;
		}
	}

	/*

	public function coupons( $userID = NULL )
	{
		switch ( !is_null($userID) && is_numeric($userID) )
		{
			case TRUE:	$this->load->model('coupons_model');
						$badges = NULL;
						
						$responseData = array();
						$responseData['coupons'] = NULL;
						
						$t = $this->coupons_model->userCoupons($userID, TRUE);
						$t2 = NULL;
						switch( count($t) > 0)
						{
							case TRUE:	$t2 = array();
										foreach($t as $tObj)
										{
											$t3['couponSerialNumber'] = $tObj->couponSerialNumber;
											$t3['couponID'] = $tObj->couponID;
											$t3['couponValue'] = $tObj->couponValue;
											$t3['couponsCount'] = $tObj->couponsCount;
											$t3['couponType'] = $tObj->couponType;
											$t3['validFrom'] = $tObj->validFrom;
											$t3['validUpto'] = $tObj->validUpto;
											$t3['minPurchaseAmount'] = $tObj->minPurchaseAmount;
											$t3['userID'] = $tObj->userID;
											$t3['param1'] = 0;
											switch($tObj->couponType == 8)
											{
												case TRUE:	$t3['param1'] = array();
															// $t3['param1']['paramType'] = 1; // param type  = 1 (storeID), 2(category ID)
															$t3['param1'][0] = $tObj->param1;
															$t3['param1'][1] = $this->coupons_model->storeID2Name( $tObj->param1 );
													break;
											}
											$t2[] = $t3;
										}
										$responseData['coupons'] = $t2;
								break;
						}
						
						$responseData['couponString'] = $this->allCouponsString(TRUE);
						$responseData['couponHTML'] = $this->allCouponsHTML(TRUE);

						return $responseData;
				break;
		}
	}

	public function allCouponsString($return = FALSE)
	{
		$this->load->model('coupons_model');
		$isLoggedIN = $this->coupons_model->isLoggedIN();
		$badges = NULL;
		$responseData = array();
		switch($isLoggedIN['status'] === TRUE)
		{
			case TRUE:	$responseData['isLoggedIN'] = TRUE;
						$responseData['coupons'] = $this->coupons_model->userCoupons($isLoggedIN['uid'], TRUE);
						if( ! is_null($responseData['coupons']) )
						{
							$couponStrs = array();
							foreach($responseData['coupons'] as $coupon)
							{
								$tmp = "Use coupon code <b><u>".strtoupper($coupon->couponID)."</u></b> to get <b><u>";
								if($coupon->couponType == 0)
								{
									$tmp .= $coupon->couponValue." % OFF</u></b>";
									if($coupon->minPurchaseAmount > 0)
									{
										$tmp .= " on a minimum purchase of Rs. ".$coupon->minPurchaseAmount.".";
									}
									if($coupon->validUpto > 0)
									{
										$tmp .= " Valid till ".date('F jS, Y', $coupon->validUpto);
									}
								}
								elseif($coupon->couponType == 1)
								{
									$tmp .= "Rs. ".$coupon->couponValue." OFF</u></b>";
									if($coupon->minPurchaseAmount > 0)
									{
										$tmp .= " on a minimum purchase of Rs. ".$coupon->minPurchaseAmount;
									}
									if($coupon->validUpto > 0)
									{
										$tmp .= ". Valid till ".date('F jS, Y', $coupon->validUpto);
									}
								}
								elseif($coupon->couponType == 8)
								{
									$tmp .= $coupon->couponValue." % OFF</u></b>";
									if($coupon->minPurchaseAmount > 0)
									{
										$tmp .= " on a minimum purchase of Rs. ".$coupon->minPurchaseAmount;
									}
									$storeName = $this->coupons_model->storeID2Name($coupon->param1);
									
									if($coupon->param1 == 251)
									{
										$storeName = 'Atmosphere Bedsense';
									}

									$storeURL = base_url()."store/".preg_replace('/\s+/', '-', trim(preg_replace('/\W/', ' ', $storeName)))."/".$coupon->param1;
									
									$tmp .= " from the store <b><a href=\"".$storeURL."\" target=\"_top\" style=\"color:rgb(240,93,111)\">".$storeName."</a></b>";
									
									if($coupon->param1 == 251)
									{
										$tmp .= ". Also get two cushion covers Size 16 inch X 16 inch FREE!";
									}

									if($coupon->validUpto > 0)
									{
										$tmp .= ". Valid till ".date('F jS, Y', $coupon->validUpto);
									}
								}
								$couponStrs[] = $tmp;
							}
							$responseData['coupons'] = $couponStrs;
						}

				break;
			case FALSE: $responseData['isLoggedIN'] = FALSE;
						$responseData['coupons'] = NULL;
				break;
		}
		switch($return)
		{
			case TRUE:	return $responseData;
				break;
		}

		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function allCouponsHTML($return = FALSE)
	{
		$couponsData = $this->allString(TRUE);
		$response = "<ul style=\"font-family:sans-serif;color:rgb(90,90,90);font-size:0.9em;line-height:2em;list-style-type:upper-roman;font-variant:small-caps\">";
		foreach($couponsData['coupons'] as $coupon)
		{
			$response .= "<li>".$coupon."</li>";
		}
		$response .= "</ul>";

		switch($return)
		{
			case TRUE:	return $response;
				break;
		}
		
		$this->output->set_content_type('text/html');
		$this->output->set_output($response);
	}
	*/
}
?>