<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Order Successful Confirmation</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shopping_cart.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/order_successful_confirmation.css" type="text/css"/>
    <!--[if IE]> <link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css" /> <![endif] -->
</head>
<body>
<section class="wrapper">
    <section class="middleBackground">
        <div class="shoppingContentsContainer">
            <div class="order_successful_Holder">
                <div class="order_success_background"></div>
                <div class="order_success_contents">
                    <div class="thanks_text">Thanks! Your Order from BnB has been submitted</div>
                    <div class="thanks_text email_confirmation_text">Will send an email confirmation
                        to <?php echo $email; ?></div>
                    <div class="button_holder"><a href="<?php echo $base_url . 'index.php/order2/purchase_history'; ?>">
                            <button type="button" id="view_order_detail" class="view_order">View Order Detail</button>
                        </a></div>
                </div>
            </div>
        </div>
        </div>
    </section>
</section> <?php include "footer.php" ?>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35785264-1']);
    _gaq.push(['_trackPageview']);
    _gaq.push(['_addTrans',
        '<?php echo $transID; ?>',           // transaction ID - required
        'BuynBrag',  // affiliation or store name
        '<?php echo $grandTotal; ?>',          // total - required
        '<?php echo $tax; ?>',           // tax
        '<?php echo $buyerAddress; ?>',              // shipping
        '<?php echo $buyerCity; ?>',       // city
        '<?php echo $buyerState; ?>',     // state or province
        '<?php echo $buyerCountry; ?>',
        '<?php echo $buyerPinCode; ?>'// country
    ]);

    // add item might be called for every item in the shopping cart
    // where your ecommerce engine loops through each item in the cart and
    // prints out _addItem for each
    <?php
     if(isset($products))
     {
         foreach($products as $product)
         {
             print "_gaq.push(['_addItem','".$transID."', '".$product->productID."','".$product->productName."','".$product->vColor.$product->vSize."','".$product->unitPrice."','".$product->quantity."','".$product->storeID."','".$product->storeName."','".$product->orderID."']);\r\n";
         }
     }
   ?>
    _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
<?php /* FACEBOOK CODE */ ?>
<script type="text/javascript">/*<![CDATA[*/
    var fb_param = {};
    fb_param.pixel_id = '6009467198082';
    fb_param.value = '<?php echo $grandTotal; ?>';
    (function () {
        var fpw = document.createElement('script');
        fpw.async = true;
        fpw.src = '//connect.facebook.net/en_US/fp.js';
        var ref = document.getElementsByTagName('script')[0];
        ref.parentNode.insertBefore(fpw, ref);
    })();
    /*]]>*/
</script>
<noscript><img height="1" width="1" alt="" style="display:none"
               src="https://www.facebook.com/offsite_event.php?id=6009467198082&amp;value=<?php echo $grandTotal; ?>"/>
</noscript>
<?php /* END SECTION FACEBOOK CODE */ ?>
<?php /* NETCORE CODE */ ?>
<script type="text/javascript">

	var emailID = "<?php echo $email; ?>";

    var productsOrdered = [];
    var productUnitPrice = [];
    var productQuantityOrdered = [];
    var orderIdOrdered = [];

    /*<![CDATA[*/
    <?php
        $cartSize = 1;
        $totalProducts = count($products);
        if(isset($products)){
            foreach($products as $product){
                ?>
    var NT1_amount = "<?php echo $product->unitPrice; ?>";
    var NT2_productName = "<?php echo $product->productName; ?>";
    var NT3_productCode = <?php echo $product->productID; ?>;
    var NT4_productType = "";
    var NT5_productCategory = "";
    var NT6_customerType = "";
    var NT7_promotionalId = "";
    var NT8_pageType = "<?php echo $transID; ?>";
    var NT9_paymentType = "";
    var NT10_dayType = "<?php echo $product->orderID; ?>";
    var NT11_totalProducts = "<?php echo $totalProducts += $product->quantity ?>";
    var NT12_cartSize = "<?php echo $cartSize++ ?>";
    var NT13_grandTotal = "<?php echo $grandTotal; ?>";
    var NT14_couponID = "<?php echo $product->cid; ?>";
    var NT15_productQuantity = "<?php echo $product->quantity ?>";
    console.log('Coupon ID for <?php echo $product->productName; ?> ' + NT14_couponID);

    productsOrdered.push(NT2_productName);
    productUnitPrice.push(parseInt(NT1_amount));
    productQuantityOrdered.push(parseInt(NT15_productQuantity));
    orderIdOrdered.push(parseInt(NT10_dayType));

//    mixpanel.people.append('Products ordered', NT2_productName, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "products appended successfully.");});
    //console.log("ANALYTICS +++++ order sucess propend vars: " + emailID + NT2_productName + NT11_totalProducts + " -- " + parseInt(NT10_dayType));
	_bnbAnalytics.orderSuccessProdAppend(emailID, NT2_productName, NT11_totalProducts, parseInt(NT10_dayType));

    <?php
}
}
?>
    document.write('<script type="text/javascript" src="' + document.location.protocol + '//buynbragin.nsfleximail.com/buynbragin/etrack.php?c=1"><' + '/script>');
    /*]]>*/

	NT11_totalProducts = parseInt(NT11_totalProducts);
	NT12_cartSize = parseInt(NT12_cartSize);
    NT13_grandTotal = parseFloat(NT13_grandTotal);

//    console.log('Grand total is ' + NT13_grandTotal);
//    console.log('Cart size is ' + NT12_cartSize);
//    console.log('Total products are ' + NT11_totalProducts);
//    console.log('Mode of payment is ' + modeOfPayment);
//    console.log('Redeemed coupon is ' + redeemedCouponID);
//    console.log('Redeemed coupon amount is ' + redeemedCouponAmount);
     //console.log("ANALYTICS ++++ order sucess vars : " + emailID + NT13_grandTotal + NT12_cartSize + NT11_totalProducts + productsOrdered + productUnitPrice + productQuantityOrdered + orderIdOrdered);
	_bnbAnalytics.orderSuccess(emailID, NT13_grandTotal, NT12_cartSize, NT11_totalProducts, productsOrdered, productUnitPrice, productQuantityOrdered, orderIdOrdered);
</script>
<?php /* END SECTION NETCORE CODE */ ?>
<?php /* ICUBE CODE */ ?>
<script src="http://affiliates.icubeswire.com/i_sale_third/353/<?php echo $grandTotal; ?>/<?php echo "TXN" . $transID; ?>"></script>
<noscript>
	<img src="http://affiliates.icubeswire.com/i_track_sale/353/<?php echo $grandTotal; ?>/<?php echo "TXN" . $transID; ?>">
</noscript>
<?php /* END SECTION ICUBE CODE */ ?>

<!-- Offer Conversion: Buy n Brag (CPS) -->
<iframe src="http://tracking.icubeswire.com/SL28?adv_sub=<?php echo "TXN" . $transID; ?>&amount=<?php echo $grandTotal; ?>" scrolling="no" frameborder="0" width="1" height="1"></iframe>
<!-- // End Offer Conversion -->

<!-- Youmint Transaction Pixel  Starts -->
<img src="http://www.youmint.com/ptrack/?mx=9941&MemberId=<?php echo $buyerUserID; ?>&TransactionValue=<?php echo $grandTotal; ?>&TransactionId=<?php echo $transID; ?>" border="0" height="1" width="1"/>
<!-- Youmint  Transaction Pixel Ends -->

<!-- FrogIdeas New Pixel -->
<!-- Google Code for Lead Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 975209259;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "llQMCIXCwQkQq4aC0QM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/975209259/?label=llQMCIXCwQkQq4aC0QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- END SECTION FrogIdeas New Pixel -->

<!-- CelebVox Code -->
<img src="http://sandbox.celebvox.com/t2.php?orderid=<?php echo $transID; ?>&offercode=3c2QA86&amount=<?php echo $grandTotal; ?>&type=TXN" width="1" height="1" />
<!-- END SECTION Celebvox
</body>
</html>
