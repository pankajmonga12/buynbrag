<?php
date_default_timezone_set('Asia/Kolkata');
$this->cezpdf->ezText('', 30);

$this->cezpdf->ezSetCmMargins(1, 4, 9, 3);
$ytext = $this->cezpdf->ezText('<b>INVOICE</b>', 12);
$this->cezpdf->ezSetCmMargins(2, 8, 9, 3);

//$img = './assets/images/stores/'.$order_details['store_id'].'/storepage_banner.png';
$img = $store_url . 'assets/images/stores/' . $order_details['store_id'] . '/storepage_banner.png';
if (file_exists($img)) {
	$a = getimagesize($img);
	$image = imagecreatefrompng($img);
	$this->cezpdf->addImage($image, 190, $ytext - 70, 200, 60);
}

$this->cezpdf->ezText('', 70);

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
	$seller_code = $order_details['communication_pincode'];
else
	$seller_code = '';
$seller_contact_no = 'Ph: ' . $order_details['contact_number'];
if (!empty($seller_address))
	$seller_complete_address = $seller_address . ',' . PHP_EOL . $seller_city . ',' . $seller_state . ',' . $seller_country . '-' . $seller_code;
else
	$seller_complete_address = '-';
$order_no = $order_details['order_id'];
$order_date = $order_details['date_of_order'];
$invoice_no = $order_details['invoice_no'];
$tin_no = $order_details['tin_no'];
$vat_reg_no = $order_details['vat_no'];
//        $cst_reg_no = $order_details['vat_no'];
$pan_no = $order_details['pan_no'];

$this->cezpdf->ezSetCmMargins(3, 6, 1, 1);
//        Start Seller Details Table
$title_seller_details = array('seller_details0' => '', 'seller_details1' => '', 'seller_details2' => '', 'seller_details3' => '');
$col_seller_details = array(
	array('seller_details0' => "SELLER'S NAME", 'seller_details1' => $seller_name, 'seller_details2' => 'ORDER NO. ', 'seller_details3' => $order_no),
	array('seller_details0' => "SELLER'S ADDRESS", 'seller_details1' => $seller_complete_address, 'seller_details2' => 'ORDER DATE ', 'seller_details3' => $order_date),
	array('seller_details0' => "TIN NO.", 'seller_details1' => $tin_no, 'seller_details2' => 'INVOICE NO ', 'seller_details3' => $invoice_no),
	array('seller_details0' => "VAT REG NO.", 'seller_details1' => $vat_reg_no, 'seller_details2' => 'PAN NO.', 'seller_details3' => $pan_no)
);
$options_seller_details = array('showLines' => 1, 'showHeadings' => 0, 'shaded' => 1, 'fontSize' => 10, 'titleFontSize' => 13, 'rowGap' => 1, 'width' => 500);
$this->cezpdf->ezTable($col_seller_details, $title_seller_details, '', $options_seller_details);

$this->cezpdf->ezText('', 10);

$this->cezpdf->ezSetCmMargins(3, 6, 1, 1);
$shipping_name = trim($order_details['shipping_fname']) . ' ' . trim($order_details['shipping_lname']);
$shipping_address = trim($order_details['shipping_address']);
$shipping_city = trim($order_details['shipping_city']);
$shipping_state = trim($order_details['shipping_state']);
$shipping_country = trim($order_details['shipping_country']);
$shipping_code = 'Pin: ' . trim($order_details['shipping_pincode']) . ' ' . $routing_code['destination_code'];
$shipping_contact_no = 'Ph: ' . trim($order_details['shipping_phoneno']);
$shipping_email = 'Email: ' . trim($order_details['shipping_emailid']);
$title_buyer_details = array('buyer_details' => '<b>BILL TO</b>', 'shippment_details' => '<b>SHIP TO</b>');
$col_buyer_details = array(
	array('buyer_details' => $shipping_name, 'shippment_details' => $shipping_name),
	array('buyer_details' => $shipping_address, 'shippment_details' => $shipping_address),
	array('buyer_details' => $shipping_city, 'shippment_details' => $shipping_city),
	array('buyer_details' => $shipping_state, 'shippment_details' => $shipping_state),
	array('buyer_details' => $shipping_country, 'shippment_details' => $shipping_country),
	array('buyer_details' => $shipping_code, 'shippment_details' => $shipping_code),
	array('buyer_details' => $shipping_contact_no, 'shippment_details' => $shipping_contact_no),
	array('buyer_details' => $shipping_email, 'shippment_details' => $shipping_email)
);
$options_buyer = array('showLines' => 1, 'showHeadings' => 1, 'shaded' => 1, 'fontSize' => 10, 'titleFontSize' => 13, 'rowGap' => 1, 'colGap' => 2, 'width' => 500);
$this->cezpdf->ezTable($col_buyer_details, $title_buyer_details, '', $options_buyer);

$this->cezpdf->ezText('', 10);

$this->cezpdf->ezSetCmMargins(3, 6, 3, 3); //ezSetCmMargins(top,bottom,left,right)
//        if(strlen($order_details['product_name'])<=20)
$prod_name = $order_details['product_name'];
//        else
//            $prod_name = substr($order_details['product_name'],0,20).'...';
$variantDetails = "";
if($order_details['vsize'] != '0')
{
	$variantDetails .= $order_details['vsize'];
}
if($order_details['vcolor'] != '0')
{
	$variantDetails .= $order_details['vcolor'];
}
$prod_name .= ' - '.$variantDetails;
$prod_code = $order_details['bnb_product_code'];
$quantity = $order_details['quantity'];

$selling_price = $order_details['amt_paid'];
$subTotal = $selling_price;
$couponDiscount = floatval($order_details['redeemedprice']);
//log_message("INFO", "DATA BEING RETURNED FROM(\$couponDetails2) save_buyer_invoice/ IS_____".print_r($couponDetails, TRUE));
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
$codTotal = ($subTotal * $quantity) + 50;

if (isset($couponDiscount) && !empty($couponDiscount) && $order_details['payment_status'] == 2) 
{   
	$data_order = array(array('S/NO' => 1, 'PRODUCT' => $prod_name, 'PRODUCT CODE' => $prod_code,'QTY.' => $quantity, 'COUPON' . PHP_EOL . 'DISC.' => $couponDiscount, 'PRICE' => 'Rs.' . $selling_price,'COD CHARGES' =>'RS. 50', 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $codTotal));
} 
elseif ($order_details['payment_status'] == 2) 
{
	$data_order = array(
		array('S/NO' => 1, 'PRODUCT' => $prod_name, 'PRODUCT CODE' => $prod_code,
			'QTY.' => $quantity, 'PRICE' => 'Rs.' . $selling_price,'COD CHARGES' =>'RS.50', 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $codTotal));

} 
elseif (isset($couponDiscount) && !empty($couponDiscount) && $order_details['payment_status'] == 1) 
{
	$data_order = array(
		array('S/NO' => 1, 'PRODUCT' => $prod_name, 'PRODUCT CODE' => $prod_code,
			'QTY.' => $quantity, 'COUPON' . PHP_EOL . 'DISC.' => $couponDiscount, 'PRICE' => 'Rs.' . $selling_price, 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $total));
	
}
else
{
	$data_order = array(
		array('S/NO' => 1, 'PRODUCT' => $prod_name, 'PRODUCT CODE' => $prod_code,
			'QTY.' => $quantity, 'PRICE' => 'Rs.' . $selling_price, 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $total));
	
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
	$this->cezpdf->ezText("Size: $vsize", 10);


$this->cezpdf->ezSetCmMargins(2, 4, 14, 3);
if ($order_details['payment_status'] == '1')
	$this->cezpdf->ezText('Total Amount Paid: Rs.' . $total, 10);
elseif ($order_details['payment_status'] == '2')
	$this->cezpdf->ezText('Total Amount to be Paid: Rs.' . $codTotal, 12); else
	$this->cezpdf->ezText('Total: Rs.' . $total, 12);

$this->cezpdf->ezSetCmMargins(2, 4, 15, 1);

$this->cezpdf->ezText('', 60);

$this->cezpdf->ezSetCmMargins(2, 4, 2, 1);
$this->cezpdf->ezText('<b>We hope you love what you bought!</b>', 10);
$this->cezpdf->ezText('<b>If you have any concern, please contact our customer care team at +91-8130878822. Send us a text or give us a missed call.</b>', 10);

$this->cezpdf->ezText('', 10);

$this->cezpdf->ezSetCmMargins(2, 4, 6, 1);
$this->cezpdf->ezText('<b>Mon-Fri,10am to 6:30 pm,or email us at " talktous@buynbrag.com "</b>', 10);

$this->cezpdf->ezText('', 20);

$this->cezpdf->ezSetCmMargins(2, 4, 2, 1);
$y = $this->cezpdf->ezText('<b>Powered by: </b>', 12);

$logo = './invoice/404_logo.jpg';
if (file_exists($logo)) {
	$image_logo = imageCreatefromjpeg($logo);
	$this->cezpdf->addImage($image_logo, 124, $y - 50, 200, 70);
}

//        $this->cezpdf->ezText('',10);
//        $this->cezpdf->ezNewPage();
//        $file_path = 'invoice/'.$txnid;
//        if(!file_exists($file_path))
//            mkdir ($file_path);
//        $pdfcode = $this->cezpdf->output();
//        $fp=fopen($file_path.'/buyrer_invoice_order_'.$order_details['order_id'].'.pdf','wb');
//        fwrite($fp,$pdfcode);
//        fclose($fp);
//        $this->cezpdf->clear_output();
?>
