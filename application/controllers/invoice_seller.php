<?php
date_default_timezone_set('Asia/Kolkata');
$this->cezpdf->ezSetCmMargins(1, 5, 9, 3);
$this->cezpdf->ezText('<b>SHIPPING LABEL</b>', 12);
$this->cezpdf->ezSetCmMargins(2, 8, 9, 3);

$img = './assets/images/stores/' . $order_details['store_id'] . '/storepage_banner.png';
if (file_exists($img)) {
	$image = imagecreatefrompng("$img");
	$this->cezpdf->addImage($image, 60, 726, 500, 70);
}

$this->cezpdf->ezText('', 52);
if ($order_details['shipping_partner'] == 1) {
	$shipping_partner = 'Fedex';
} elseif ($order_details['shipping_partner'] == 2) {
	$shipping_partner = 'Blue Dart';
} else {
	$shipping_partner = 'Gati';
}
$this->cezpdf->ezSetCmMargins(3, 6, 1, 1);
$title_seller_details = array('seller_details' => '', 'order_details' => '');
if (!empty($order_details['bankaccountholder_name']))
	$seller_name = $order_details['bankaccountholder_name'];
else
	$seller_name = $order_details['store_name'];
if ($order_details['communication_address'] != "NULL")
	$seller_address = $order_details['communication_address'];
else
	$seller_address = '';
if ($order_details['communication_city'] != "NULL")
	$seller_city = $order_details['communication_city'];
else
	$seller_city = '';
if ($order_details['communication_state'] != "NULL")
	$seller_state = $order_details['communication_state'];
else
	$seller_state = '';
if ($order_details['communication_country'] != "NULL")
	$seller_country = $order_details['communication_country'];
else
	$seller_country = '';
if ($order_details['communication_pincode'] != "NULL")
	$seller_code = 'Pin: ' . $order_details['communication_pincode'];
else
	$seller_code = '-';
if (!empty($seller_address))
	$seller_complete_address = $seller_address . ',' . PHP_EOL . $seller_city . ',' . $seller_state . ',' . $seller_country;
else
	$seller_complete_address = '-';
$seller_contact_no = 'Ph: +91-124-43 00827 ';
$seller_email = 'email: talktous@buynbrag.com';
$invoice_no = 'INVOICE NO : ' . $order_details['invoice_no'];
$invoice_date = 'INVOICE DATE : ' . $order_details['date_of_order'];
$vat_reg_no = 'VAT REG NO : ' . $order_details['vat_no'];
//        $cst_reg_no = 'CST REG NO : '.$order_details['vat_no'];
$pan_no = 'PAN NO : ' . $order_details['pan_no'];
$tin_no = 'TIN NO : ' . $order_details['tin_no'];
$quantity = (int)$order_details['quantity'];

$selling_price = $order_details['amt_paid'];
$subTotal = $selling_price;
$couponDiscount = floatval($order_details['redeemedprice']);
if (!empty($couponDiscount)) {
	if ($couponDiscount < 1) {
		$subTotal = $subTotal * (1 - $couponDiscount);
		$couponDiscount = ($couponDiscount * 100) . '%';
	} else {
		$subTotal -= $couponDiscount;
		$couponDiscount = 'Rs.' . $couponDiscount;
	}
}
//        if($this->contestdb->is_christmas_prod($order_details['product_id']) == 1 && $this->contestdb->is_christmas_winner() == 1)
//                            $couponDiscount = '50%';
$total = $subTotal * $quantity;
$codtotal = ($subTotal * $quantity) + 50;
//'order_details'=>$order_no
//'order_details'=>$order_date)
$col_seller_details = array(
	array('seller_details' => $seller_name, 'order_details' => $invoice_no),
	array('seller_details' => $seller_complete_address, 'order_details' => $invoice_date),
	array('seller_details' => $seller_code, 'order_details' => $vat_reg_no),
	array('seller_details' => $seller_contact_no, 'order_details' => $tin_no),
	array('seller_details' => $seller_email, 'order_details' => $pan_no)
);
$options = array('showLines' => 1, 'showHeadings' => 0, 'shaded' => 1, 'fontSize' => 10, 'titleFontSize' => 13, 'rowGap' => 1, 'width' => 350);
$this->cezpdf->ezTable($col_seller_details, $title_seller_details, '', $options);

$barcode_y = $this->cezpdf->ezText('', 10);

$barcode_path = "./barcode/" . $txn_id . '_' . $order_id . ".png";
if (file_exists($barcode_path) && $order_details['shipping_partner'] != 3) {
	$image_barcode = ImageCreatefrompng($barcode_path);
	$this->cezpdf->addImage($image_barcode, 360, $barcode_y - 80, 160, 45);
}

$this->cezpdf->ezSetCmMargins(3, 6, 4, 1);
$order_no = 'ORDER NO : ' . $order_details['order_id'];
$title_buyer_details = array('buyer_details' => '<b>DELIVER TO</b>', 'shippment_details' => "$order_no");
$order_date = 'ORDER DATE : ' . $order_details['date_of_order'];
$docket_no = 'DOCKET NO: ' . $barcode;
$weight = 'WEIGHT: ' . (float)$order_details['prd_act_weight'] * $quantity . ' kg';
$vol_weight = 'VOLUMETRIC WEIGHT: ' . (float)$order_details['prd_vol_weight'] * $quantity . ' kg';
$pieces = 'PIECES: ' . $order_details['quantity'];
$shipping_name = $order_details['shipping_fname'] . ' ' . $order_details['shipping_lname'];
$shipping_address = trim($order_details['shipping_address']);
$shipping_city = trim($order_details['shipping_city']);
$shipping_state = trim($order_details['shipping_state']);
$shipping_country = trim($order_details['shipping_country']);
$shipping_code = 'Pin: ' . trim($order_details['shipping_pincode']) . ' ' . $routing_code['destination_code'];
$shipping_contact_no = 'Ph: ' . $order_details['shipping_phoneno'];
$shipping_email = 'Email: ' . $order_details['shipping_emailid'];
if ($order_details['payment_status'] == 2)
	$payment_type = 'CASH ON DELIVERY (COD)';
else
	$payment_type = 'PREPAID';
if ($order_details['shipping_partner'] != 3) {
	$col_buyer_details = array(
		array('buyer_details' => $shipping_name, 'shippment_details' => $payment_type),
		array('buyer_details' => $shipping_address, 'shippment_details' => ''),
		array('buyer_details' => $shipping_city, 'shippment_details' => ''),
		array('buyer_details' => $shipping_state, 'shippment_details' => ''),
		array('buyer_details' => $shipping_country, 'shippment_details' => ''),
		array('buyer_details' => $shipping_code, 'shippment_details' => $docket_no),
		array('buyer_details' => $shipping_contact_no, 'shippment_details' => $weight),
		array('buyer_details' => $shipping_email, 'shippment_details' => $vol_weight),
		array('buyer_details' => '', 'shippment_details' => $order_date),
		array('buyer_details' => '', 'shippment_details' => $pieces)
	);
} else {
	$col_buyer_details = array(
		array('buyer_details' => $shipping_name, 'shippment_details' => $payment_type),
		array('buyer_details' => $shipping_address, 'shippment_details' => $weight),
		array('buyer_details' => $shipping_city, 'shippment_details' => $order_date),
		array('buyer_details' => $shipping_state, 'shippment_details' => $pieces),
		array('buyer_details' => $shipping_country, 'shippment_details' => ''),
		array('buyer_details' => $shipping_code, 'shippment_details' => ''),
		array('buyer_details' => $shipping_contact_no, 'shippment_details' => '')
//                                    array('buyer_details' => '','shippment_details'=>$vol_weight),
//                                    array('buyer_details' => '','shippment_details'=>$order_date),
//                                    array('buyer_details' => '','shippment_details'=>$pieces)
	);
}
$options_buyer = array('showLines' => 0, 'showHeadings' => 1, 'shaded' => 0, 'fontSize' => 10, 'titleFontSize' => 13, 'rowGap' => 1, 'colGap' => 2, 'width' => 450);
$this->cezpdf->ezTable($col_buyer_details, $title_buyer_details, '', $options_buyer);

$return_address = $order_details['return_address'] . PHP_EOL;
$return_city = $order_details['return_city'];
$return_state = $order_details['return_state'];
$return_country = $order_details['return_country'];
if ($order_details['shipping_partner'] == 2) {
	if ($routing_code['retpin'] != '0') {
		$return_pincode = $routing_code['retpin'] . ' ' . $routing_code['return_code'];
	} else {
		$return_pincode = $order_details['return_pincode'] . ' ' . $routing_code['return_code'];
	}
} else {
	$return_pincode = $order_details['return_pincode'];
}
$returnCompleteAddress = "RETURN ADDRESS: $return_address,$return_city,$return_state,$return_country-$return_pincode";
$codStatement = '';
if ($order_details['payment_status'] == '2')
	$codStatement = 'Amount to be Paid: Rs.' . $total;
$this->cezpdf->ezText('', 10);
//$this->cezpdf->ezSetCmMargins(3,6,10,1);
//$this->cezpdf->ezText("RETURN ADDRESS: $return_address,$return_city,$return_state,$return_country-$return_pincode",13);
$options_bold = array('showLines' => 0, 'showHeadings' => 0, 'shaded' => 0, 'fontSize' => 15, 'rowGap' => 1, 'colGap' => 8, 'width' => 500);
$data_bold = array(
	array('pincode' => $codStatement, 'returnaddress' => $returnCompleteAddress)
);
$this->cezpdf->ezTable($data_bold, '', '', $options_bold);
$this->cezpdf->ezText('', 10);

$this->cezpdf->ezSetCmMargins(3, 6, 3, 3); //ezSetCmMargins(top,bottom,left,right)
$prod_name = $order_details['product_name'];
$len = strlen($order_details['tax_rate']) - 1;
$tax = substr($order_details['tax_rate'], 0, $len) . '%';
$prod_code = $order_details['bnb_product_code'];
if (isset($couponDiscount) && !empty($couponDiscount) && $order_details['payment_status'] == 2) {
	/*$data_order = array(
	 array('S/NO'=>1,'ITEM DESC.'=>$prod_name,'ITEM CODE'=>$prod_code,
		 'QTY.'=>$quantity,'COUPON'.PHP_EOL.'DISC.'=>$couponDiscount,'TAX'=>$tax,'PRICE'=>'Rs.'.$selling_price,'TOTAL (ALL INCLUSIVE)'=>'Rs.'.$total)
	);*/
	$data_order = array(
		array('S/NO' => 1, 'ITEM DESC.' => $prod_name, 'ITEM CODE' => $prod_code,
			'QTY.' => $quantity, 'COUPON' . PHP_EOL . 'DISC.' => $couponDiscount, 'PRICE' => 'Rs.' . $selling_price,'COD CHARGES' =>'RS. 50', 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $codtotal)
	);
} elseif ($order_details['payment_status'] == 2){
	/*$data_order = array(
	 array('S/NO'=>1,'ITEM'.PHP_EOL.'DESC.'=>$prod_name,'ITEM CODE'=>$prod_code,
		 'QTY.'=>$quantity,'TAX'=>$tax,'PRICE'=>'Rs.'.$selling_price,'TOTAL (ALL INCLUSIVE)'=>'Rs.'.$total)
	);*/
	$data_order = array(
		array('S/NO' => 1, 'ITEM' . PHP_EOL . 'DESC.' => $prod_name, 'ITEM CODE' => $prod_code,
			'QTY.' => $quantity, 'PRICE' => 'Rs.' . $selling_price,'COD CHARGES' =>'RS. 50','TOTAL (ALL INCLUSIVE)' => 'Rs.' . $codtotal)
	);
}else
{
	$data_order = array(
		array('S/NO' => 1, 'ITEM' . PHP_EOL . 'DESC.' => $prod_name, 'ITEM CODE' => $prod_code,
			'QTY.' => $quantity, 'PRICE' => 'Rs.' . $selling_price, 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $total)
	);
}
$options_price = array('fontSize' => 10, 'titleFontSize' => 13, 'rowGap' => 1, 'colGap' => 2, 'width' => 500);
$this->cezpdf->ezTable($data_order, '', '', $options_price);

$this->cezpdf->ezText('', 10);
if (!empty($order_details['vcolor']) && $order_details['vcolor'] != 0)
	$vcolor = $order_details['vcolor'];
if (!empty($order_details['vsize']) && $order_details['vsize'] != 0)
	$vsize = $order_details['vsize'];

if (isset($vcolor))
	$this->cezpdf->ezText("Color: $vcolor" . PHP_EOL, 10);
if (isset($vsize))
	$this->cezpdf->ezText("Size: $vsize", 12);

$this->cezpdf->ezSetCmMargins(2, 4, 14, 3);
if ($order_details['payment_status'] == '1')
	$this->cezpdf->ezText('Total Amount Paid: Rs.' . $total, 10);
elseif ($order_details['payment_status'] == '2')
	$this->cezpdf->ezText('Total Amount to be Paid: Rs.' . $total, 12); else
	$this->cezpdf->ezText('Total: Rs.' . $total, 12);

$this->cezpdf->ezText('', 10);

$this->cezpdf->ezSetCmMargins(2, 4, 4, 1);
$this->cezpdf->ezText('<b>This is an electronically generated document,hence does not require signature</b>', 10);

$this->cezpdf->ezText('', 10);
$this->cezpdf->ezSetCmMargins(2, 4, 2, 1);
$this->cezpdf->ezText("The shipping will be done by $shipping_partner.", 10);
$this->cezpdf->ezText('', 10);

$this->cezpdf->ezSetCmMargins(2, 4, 2, 1);
//$y = $this->cezpdf->ezText('<b>Powered by <c:alink:http://www.buynbrag.com>BUYNBRAG.COM</c:alink></b>',10);
$y = $this->cezpdf->ezText('<b>Powered by: </b>', 12);

$logo = './invoice/404_logo.jpg';
if (file_exists($logo)) {
	$image_logo = ImageCreatefromjpeg("$logo");
	$this->cezpdf->addImage($image_logo, 124, $y - 50, 200, 70);
}

?>
