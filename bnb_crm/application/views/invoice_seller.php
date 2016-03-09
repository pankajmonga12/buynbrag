<?php if (!defined('BASEPATH')) exit('Direct script access not allowed');
date_default_timezone_set('Asia/Kolkata');
?>
<html>
<head>
    <title>Shipping Label for Order No<?php echo $orderDetails['order_id']; ?></title>
</head>
<body>
<div style="width: 950px; margin: 0 auto;text-align: center; font-family: Helvetica, sans-serif; font-size: 17pt">
<p><b>SHIPPING LABEL</b></p>
<?php
$img = $storeURL . './assets/images/stores/' . $orderDetails['store_id'] . '/storepage_banner.png';

if ($orderDetails['shipping_partner'] == 1) {
    $shipping_partner = 'Fedex';
} elseif ($orderDetails['shipping_partner'] == 2) {
    $shipping_partner = 'Blue Dart';
} else {
    $shipping_partner = 'Gati';
}

$title_seller_details = array('seller_details' => '', 'order_details' => '');
if (!empty($orderDetails['bankaccountholder_name']))
    $seller_name = $orderDetails['bankaccountholder_name'];
else
    $seller_name = $orderDetails['store_name'];
if ($orderDetails['communication_address'] != "NULL")
    $seller_address = $orderDetails['communication_address'];
else
    $seller_address = '';
if ($orderDetails['communication_city'] != "NULL")
    $seller_city = $orderDetails['communication_city'];
else
    $seller_city = '';
if ($orderDetails['communication_state'] != "NULL")
    $seller_state = $orderDetails['communication_state'];
else
    $seller_state = '';
if ($orderDetails['communication_country'] != "NULL")
    $seller_country = $orderDetails['communication_country'];
else
    $seller_country = '';
if ($orderDetails['communication_pincode'] != "NULL")
    $seller_code = 'Pin: ' . $orderDetails['communication_pincode'];
else
    $seller_code = '-';
if (!empty($seller_address))
    $seller_complete_address = $seller_address . ',' . '<br/>' . $seller_city . ',' . $seller_state . ',' . $seller_country;
else
    $seller_complete_address = '-';

$seller_contact_no = 'Ph: +91-124-43 00827';
$seller_email = 'email: talktous@buynbrag.com';
$invoice_no = 'INVOICE NO : ' . $orderDetails['invoice_no'];
$invoice_date = 'INVOICE DATE : ' . $orderDetails['date_of_order'];
$vat_reg_no = 'VAT REG NO : ' . $orderDetails['vat_no'];
//$cst_reg_no = 'CST REG NO : '.$order_details['vat_no'];
$pan_no = 'PAN NO : ' . $orderDetails['pan_no'];
$tin_no = 'TIN NO : ' . $orderDetails['tin_no'];
$quantity = (int)$orderDetails['quantity'];

$selling_price = $orderDetails['amt_paid'];
$subTotal = $selling_price;
$couponDiscountvalue = floatval($orderDetails['redeemedprice']);
$couponDiscount = floatval($orderDetails['redeemedprice']);
if (!empty($couponDiscount)) {
    if ($couponDiscount < 1) {
        $subTotal = $subTotal * (1 - $couponDiscount);
        $couponDiscount = ($couponDiscount * 100) . '%';
    } else {
        $subTotal -= $couponDiscount;
        $couponDiscount = 'Rs.' . $couponDiscount;
    }
}
//if($this->contestdb->is_christmas_prod($order_details['product_id']) == 1 && $this->contestdb->is_christmas_winner() == 1)
//$couponDiscount = '50%';
$total = $selling_price * $quantity - $couponDiscountvalue;
$codtotal = ($selling_price * $quantity) + 50;
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
//$this->cezpdf->ezTable($col_seller_details, $title_seller_details, '', $options);
?>
<table border="1"
       style="border-collapse: collapse; border: 3px solid;width: 100%; font-family: Helvetica, sans-serif; font-size: 17pt">
    <tr>
        <td><?php echo $seller_name; ?></td>
        <td style="padding-left: 10px"><?php echo $invoice_no; ?></td>
    </tr>
    <tr style="background-color: #ccc">
        <td><?php echo $seller_complete_address; ?></td>
        <td style="padding-left: 10px"><?php echo $invoice_date; ?></td>
    </tr>
    <tr>
        <td><?php echo $seller_code; ?></td>
        <td style="padding-left: 10px"><?php echo $vat_reg_no; ?></td>
    </tr>
    <tr style="background-color: #ccc">
        <td><?php echo $seller_contact_no; ?></td>
        <td style="padding-left: 10px"><?php echo $tin_no; ?></td>
    </tr>
    <tr>
        <td><?php echo $seller_email; ?></td>
        <td style="padding-left: 10px"><?php echo $pan_no; ?></td>
    </tr>
</table>
<br/><br/><br/>
<?php
//$barcode_y = $this->cezpdf->ezText('', 10);

$barcode_path = "./barcode/barcode.php?txnid=" . $orderDetails['txnid'] . '&orderid=' . $orderID . "&awbno=" . $orderDetails['awb_no'];
/*if (file_exists($barcode_path) && $order_details['shipping_partner'] != 3)
{
	$image_barcode = ImageCreatefrompng($barcode_path);
}*/

$order_no = 'ORDER NO : ' . $orderDetails['order_id'];
$title_buyer_details = array('buyer_details' => '<b>DELIVER TO</b>', 'shippment_details' => "$order_no");
$order_date = 'ORDER DATE : ' . $orderDetails['date_of_order'];
$docket_no = 'DOCKET NO: ' . $orderDetails['awb_no'];
$weight = 'WEIGHT: ' . (float)$orderDetails['prd_act_weight'] * $quantity . ' kg';
$vol_weight = 'VOLUMETRIC WEIGHT: ' . (float)$orderDetails['prd_vol_weight'] * $quantity . ' kg';
$pieces = 'PIECES: ' . $orderDetails['quantity'];
$shipping_name = $orderDetails['shipping_fname'] . ' ' . $orderDetails['shipping_lname'];
$shipping_address = trim($orderDetails['shipping_address']);
$shipping_city = trim($orderDetails['shipping_city']);
$shipping_state = trim($orderDetails['shipping_state']);
$shipping_country = trim($orderDetails['shipping_country']);
$shipping_code = 'Pin: ' . trim($orderDetails['shipping_pincode']) . ' ' . $routingCode['destination_code'];
$shipping_contact_no = 'Ph: ' . $orderDetails['shipping_phoneno'];
$shipping_email = 'Email: ' . $orderDetails['shipping_emailid'];
if ($orderDetails['payment_status'] == 2) {
    $payment_type = 'CASH ON DELIVERY (COD)';
} else {
    $payment_type = 'PREPAID';
}
if ($orderDetails['shipping_partner'] != 3 && $orderDetails['shipping_partner'] != 1) {
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
    ?>
    <table border="0" style="width: 100%" align="center" style="font-family: Helvetica, sans-serif; font-size: 17pt">
        <tr>
            <td style="width: 50%"><?php echo $title_buyer_details['buyer_details']; ?></td>
            <td style="width: 50%"><?php echo $order_no; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_name; ?></td>
            <td style="width: 50%"><?php echo $payment_type; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_address; ?></td>
            <td style="width: 50%"><img
                    src="<?php echo base_url() . 'barcode/barcode.php?orderid=' . $orderDetails['order_id'] . '&awbno=' . $orderDetails['awb_no'] . '&txnid=' . $orderDetails['txnid']; ?>"/>
            </td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_city; ?></td>
            <td style="width: 50%"></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_state; ?></td>
            <td style="width: 50%"></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_country; ?></td>
            <td style="width: 50%"></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_code; ?></td>
            <td style="width: 50%"><?php echo $docket_no; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_contact_no; ?></td>
            <td style="width: 50%"><?php echo $weight; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_email; ?></td>
            <td style="width: 50%"><?php echo $vol_weight; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%"><?php echo $order_date; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%"><?php echo $pieces; ?></td>
        </tr>
    </table>
<?php
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
    ?>
    <table border="0" style="width: 100%; font-family: Helvetica, sans-serif; font-size: 17pt">
        <tr>
            <td><b>DELIVER TO</b></td>
            <td style="width: 50%"><?php echo $order_no; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_name; ?></td>
            <td style="width: 50%"><?php echo $payment_type; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_address; ?></td>
            <td style="width: 50%"><?php echo $weight; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_city; ?></td>
            <td style="width: 50%"><?php echo $order_date; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_state; ?></td>
            <td style="width: 50%"><?php echo $pieces; ?></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_country; ?></td>
            <td style="width: 50%"></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_code; ?></td>
            <td style="width: 50%"></td>
        </tr>
        <tr>
            <td style="width: 50%"><?php echo $shipping_contact_no; ?></td>
            <td style="width: 50%"></td>
        </tr>
        <tr><td><?php echo $shipping_email; ?></td></tr><!--<td style="width: 50%"></td></tr>-->
    </table>
<?php
}

$return_address = $orderDetails['return_address'] . PHP_EOL;
$return_city = $orderDetails['return_city'];
$return_state = $orderDetails['return_state'];
$return_country = $orderDetails['return_country'];
if ($orderDetails['shipping_partner'] == 2) {
    if ($routingCode['retpin'] != '0') {
        $return_pincode = $routingCode['retpin'] . ' ' . $routingCode['return_code'];
    } else {
        $return_pincode = $orderDetails['return_pincode'] . ' ' . $routingCode['return_code'];
    }
} else {
    $return_pincode = $orderDetails['return_pincode'];
}

$returnCompleteAddress = "RETURN ADDRESS: $return_address,$return_city,$return_state,$return_country-$return_pincode";
$codStatement = '';
?>
<table border="0" style="width: 100%; font-family: Helvetica, sans-serif; font-size: 25pt">
    <tr>
        <?php
        if ($orderDetails['payment_status'] == '2') {
            $codStatement = 'Amount to be Paid: Rs.' . $codtotal;
            print "		<td>" . $codStatement . "</td>";
        } else {
            print "		<td>Amount Paid: Rs." . $total . " </td>";
        }
        ?>
        <td style="width: 50%; font-weight: bold; font-size: 25pt"><?php echo $returnCompleteAddress; ?></td>
    </tr>
</table>
<br/>
<?php
$options_bold = array('showLines' => 0, 'showHeadings' => 0, 'shaded' => 0, 'fontSize' => 15, 'rowGap' => 1, 'colGap' => 8, 'width' => 500);
$data_bold = array(
    array('pincode' => $codStatement, 'returnaddress' => $returnCompleteAddress)
);
?>
<?php
$prod_name = $orderDetails['product_name'];
$len = strlen($orderDetails['tax_rate']) - 1;
$tax = substr($orderDetails['tax_rate'], 0, $len) . '%';
$prod_code = $orderDetails['bnb_product_code'];
$variantDetails = NULL;
if ($orderDetails['vsize'] != '0') {
    if (is_null($variantDetails)) {
        $variantDetails = urldecode($orderDetails['vsize']);
    } else {
        $variantDetails .= urldecode($orderDetails['vsize']);
    }
}

if ($orderDetails['vcolor'] != '0') {
    if (is_null($variantDetails)) {
        $variantDetails = urldecode($orderDetails['vcolor']);
    } else {
        $variantDetails .= urldecode($orderDetails['vcolor']);
    }
}

if (!is_null($variantDetails)) {
    $prod_name .= ' - ' . $variantDetails;
}

if (isset($couponDiscount) && !empty($couponDiscount) && $orderDetails['payment_status'] == 2) {
    /*$data_order = array(
     array('S/NO'=>1,'ITEM DESC.'=>$prod_name,'ITEM CODE'=>$prod_code,
         'QTY.'=>$quantity,'COUPON'.PHP_EOL.'DISC.'=>$couponDiscount,'TAX'=>$tax,'PRICE'=>'Rs.'.$selling_price,'TOTAL (ALL INCLUSIVE)'=>'Rs.'.$total)
    );*/
    $data_order = array(
        array('S/NO' => 1, 'ITEM DESC.' => $prod_name, 'ITEM CODE' => $prod_code,
            'QTY.' => $quantity, 'COUPON' . PHP_EOL . 'DISC.' => $couponDiscount, 'PRICE' => 'Rs.' . $selling_price,'COD CHARGES' =>'RS. 50', 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $codtotal)
    );
    ?>
    <br/><br/>
    <table border="1"
           style="border-collapse: collapse; border: 3px solid; width: 100%; font-family: Helvetica, sans-serif; font-size: 17pt">
        <tr>
            <th>S/NO</th>
            <th>ITEM DESC.</th>
            <th>ITEM CODE</th>
            <th>QTY.</th>
            <th>DISCOUNT</th>
            <th>PRICE</th>
            <th>COD CHARGES</th>
            <th>TOTAL (ALL INCLUSIVE)</th>
        </tr>
        <tr>
            <td>1</td>
            <td><?php echo $prod_name; ?></td>
            <td><?php echo $prod_code; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $couponDiscount; ?></td>
            <td><?php echo $selling_price; ?></td>
            <td><?php echo "Rs. 50";?></td>
            <td><?php echo $codtotal; ?></td>
        </tr>
    </table>
<?php
} elseif ($orderDetails['payment_status'] == 2){
    /*$data_order = array(
     array('S/NO'=>1,'ITEM'.PHP_EOL.'DESC.'=>$prod_name,'ITEM CODE'=>$prod_code,
         'QTY.'=>$quantity,'TAX'=>$tax,'PRICE'=>'Rs.'.$selling_price,'TOTAL (ALL INCLUSIVE)'=>'Rs.'.$total)
    );*/
    $data_order = array(
        array('S/NO' => 1, 'ITEM DESC.' => $prod_name, 'ITEM CODE' => $prod_code,
            'QTY.' => $quantity, 'PRICE' => 'Rs.' . $selling_price,'COD CHARGES' =>'RS. 50','TOTAL (ALL INCLUSIVE)' => 'Rs.' . $codtotal)
    );
    ?>
    <br/><br/>
    <table border="1"
           style="border-collapse: collapse; border: 3px solid; width: 100%; font-family: Helvetica, sans-serif; font-size: 17pt">
        <tr>
            <th>S/NO</th>
            <th>ITEM DESC.</th>
            <th>ITEM CODE</th>
            <th>QTY.</th>
            <th>PRICE</th>
            <th>COD CHARGES</th>
            <th>TOTAL (ALL INCLUSIVE)</th>
        </tr>
        <tr>
            <td>1</td>
            <td><?php echo $prod_name; ?></td>
            <td><?php echo $prod_code; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $selling_price; ?></td>
            <td><?php echo "Rs. 50";?></td>
            <td><?php echo $codtotal; ?></td>
        </tr>
    </table>
<?php
} elseif(isset($couponDiscount) && !empty($couponDiscount) && $orderDetails['payment_status'] == 1){
    $data_order = array(
        array('S/NO' => 1, 'ITEM DESC.' => $prod_name, 'ITEM CODE' => $prod_code,
            'QTY.' => $quantity, 'COUPON' . PHP_EOL . 'DISC.' => $couponDiscount, 'PRICE' => 'Rs.' . $selling_price, 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $total)
    );
    ?>
    <br/><br/>
    <table border="1"
           style="border-collapse: collapse; border: 3px solid; width: 100%; font-family: Helvetica, sans-serif; font-size: 17pt">
        <tr>
            <th>S/NO</th>
            <th>ITEM DESC.</th>
            <th>ITEM CODE</th>
            <th>QTY.</th>
            <th>DISCOUNT</th>
            <th>PRICE</th>
            <th>TOTAL (ALL INCLUSIVE)</th>
        </tr>
        <tr>
            <td>1</td>
            <td><?php echo $prod_name; ?></td>
            <td><?php echo $prod_code; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $couponDiscount; ?></td>
            <td><?php echo $selling_price; ?></td>
            <td><?php echo $total; ?></td>
        </tr>
    </table>
<?php
} else {
    $data_order = array(
        array('S/NO' => 1, 'ITEM DESC.' => $prod_name, 'ITEM CODE' => $prod_code,
            'QTY.' => $quantity, 'PRICE' => 'Rs.' . $selling_price, 'TOTAL (ALL INCLUSIVE)' => 'Rs.' . $total)
    );
    ?>
    <br/><br/>
    <table border="1"
           style="border-collapse: collapse; border: 3px solid; width: 100%; font-family: Helvetica, sans-serif; font-size: 17pt">
        <tr>
            <th>S/NO</th>
            <th>ITEM DESC.</th>
            <th>ITEM CODE</th>
            <th>QTY.</th>
            <th>PRICE</th>
            <th>TOTAL (ALL INCLUSIVE)</th>
        </tr>
        <tr>
            <td>1</td>
            <td><?php echo $prod_name; ?></td>
            <td><?php echo $prod_code; ?></td>
            <td><?php echo $quantity; ?></td>
            <td><?php echo $selling_price; ?></td>
            <td><?php echo $total; ?></td>
        </tr>
    </table>
<?php
}
/* COMMENTED BY SHAMMI SHAILAJ AS DID NOT KNOW WHAT TO DO WITH THE DATA
$options_price = array('fontSize' => 10, 'titleFontSize' => 13, 'rowGap' => 1, 'colGap' => 2, 'width' => 500);
$this->cezpdf->ezTable($data_order, '', '', $options_price);

$this->cezpdf->ezText('', 10);
if (!empty($orderDetails['vcolor']) && $orderDetails['vcolor'] != 0)
	$vcolor = $order_details['vcolor'];
if (!empty($orderDetails['vsize']) && $orderDetails['vsize'] != 0)
	$vsize = $orderDetails['vsize'];

if (isset($vcolor))
	$this->cezpdf->ezText("Color: $vcolor" . PHP_EOL, 10);
if (isset($vsize))
	$this->cezpdf->ezText("Size: $vsize", 12);
*/
print "<p style = \"text-align: right; font-size: 25pt\">";
if ($orderDetails['payment_status'] == '1') {
    print 'Total Amount Paid: Rs.' . $total;
} elseif ($orderDetails['payment_status'] == '2') {
    print 'Total Amount to be Paid: Rs.' . $codtotal;
} else {
    print 'Total: Rs.' . $total;
}
?>
</p>
<p style="font-family: Helvetica, sans-serif; font-size: 15pt"><b>This is an electronically generated document,hence
        does not require signature</b></p>

<p>The shipping will be done by <?php echo $shipping_partner; ?>
    <?php
    //$y = $this->cezpdf->ezText('<b>Powered by <c:alink:http://www.buynbrag.com>BUYNBRAG.COM</c:alink></b>',10);
    ?>

<p style="float:left; font-family: Helvetica, sans-serif; font-size: 15pt"><b>Powered by: </b><img
        src="<?php echo base_url() . 'assets/404_logo.jpg'; ?>"/></p>
</div>
</body>
</html>
