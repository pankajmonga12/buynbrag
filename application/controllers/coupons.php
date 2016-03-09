<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');
class Coupons extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function all()
	{
		$this->load->model('coupons_model');
		$isLoggedIN = $this->coupons_model->isLoggedIN();
		$badges = NULL;
		$responseData = array();
		switch($isLoggedIN['status'] === TRUE)
		{
			case TRUE:	$responseData['isLoggedIN'] = TRUE;
						$responseData['coupons'] = NULL;
						$t = $this->coupons_model->userCoupons($isLoggedIN['uid'], TRUE);
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
															$t3['param1'][1] = $this->coupons_model->storeID2Name($tObj->param1);
													break;
											}
											$t2[] = $t3;
										}
										$responseData['coupons'] = $t2;
								break;
						}
						
						$responseData['couponString'] = $this->allString(TRUE);
						$responseData['couponHTML'] = $this->allHTML(TRUE);
				break;
			case FALSE: $responseData['isLoggedIN'] = FALSE;
						$responseData['coupons'] = NULL;
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function allString($return = FALSE)
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
								elseif($coupon->couponType == 5)
								{
									$catURL = $this->coupons_model->catID2URL( $coupon->param1 );
									//log_message('INFO', "catURL = ".json_encode($catURL) );
									if( $catURL !== NULL )
									{
										$tmp .= $coupon->couponValue." % OFF</u></b>";
										if($coupon->minPurchaseAmount > 0)
										{
											$tmp .= " on a minimum purchase of Rs. ".$coupon->minPurchaseAmount;
										}

										$catName = $catURL[1];

										$catURL = base_url().$catURL[0];
										
										$tmp .= " from the category <b><a href=\"".$catURL."\" target=\"_top\" style=\"color:rgb(240,93,111)\">".$catName."</a></b>";

										if($coupon->validUpto > 0)
										{
											$tmp .= ". Valid till ".date('F jS, Y', $coupon->validUpto);
										}
									}
									else
									{
										$tmp = ""; // empty the contents of the $tmp variable so that it does not output anything
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

	public function allHTML($return = FALSE)
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
}
?>
