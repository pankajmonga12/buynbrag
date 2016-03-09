<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Check Out II</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/checkout.css"/>
	
<!--  Code for Facebook tracking of successful conversion	-->
	<script type="text/javascript">
	var fb_param = {};
	fb_param.pixel_id = '6007853992663';
	fb_param.value = '0.00';
	(function(){
	  var fpw = document.createElement('script');
	  fpw.async = true;
	  fpw.src = '//connect.facebook.net/en_US/fp.js';
	  var ref = document.getElementsByTagName('script')[0];
	  ref.parentNode.insertBefore(fpw, ref);
	})();
    var userMobile = "<?php echo $userArr['phone']; ?>";
    var userAddress = "<?php echo $userArr['address1'] . ', ' . $userArr['city'] . ', ' . $userArr['state'] . '-' . $userArr['zipcode'] . ', ' . $userArr['country']; ?>";
    mixpanel.people.set({
        '$phone': userMobile,
        '$address': userAddress
    }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "user mobile no updated.");});
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6007853992663&amp;value=0" /></noscript>
	
<!--  Facebook tracking ends	-->
</head>
<body>
<section class="wrapper">
	<section class="middleBackground">
		<div class="topBanerPatternContainer diffHeight">
			<div class="checkWrapper">
				<div class="checkoutIcon"></div>
				<div class="checkoutText">CHECKOUT</div>
				<div class="rightWrapper">
					<div class="Iimage"></div>
					<div class="IIimage"></div>
					<div class="blank_circleImage"></div>
				</div>
			</div>
		</div>
		<div class="topDotSeparator"></div>
		<div class="middleContainer">
			<div class="leftPanel">
				<div class="checkHeading">Payment Information</div>
				<form id="checkoutII" name="checkoutII" action="checkout_third" method="post">
				<br/>
				<div class="row">
					<div class="span1">
						<input type="radio" checked="true" value="CC" onclick="updateAmount(0)" name="pgTmp" id="debit" style="display: inline">
					</div>
					<div class="span3" style="font-size: 1.9em; margin-left: -1em">Pay Online</div>
					<?php
					 if($CODPolicy !== FALSE) /* CONDITION ADDED BY ALTAMASH TO BLOCK COD FOR ORDERS WHICH HAVE A COUPON */
					{
						if (!empty($cod)): ?>
							<div class="span1">
								<input type="radio" name="pgTmp" value="COD" onclick="updateAmount(1)" id="netbanking" style="display: inline">
							</div>
							<div class="span3" style="font-size: 1.9em; margin-left: -1em">COD</div>
						<?php
						endif;
					}
					?>
				</div>
								<!--<div class="checkText">Net Banking</div>-->        
					<!-- <div class="radioButton">
						<div class="radioText">
							<div class="radio1"><input type="radio" id="cod" value="EMI" name="pg"/></div>
							<div class="checkText">EMI</div>
						</div>
						<div class="radioText">
							<div class="radio1"><input type="radio" id="emi" value="DB" name="pg"/></div>
							<div class="checkText">Debit Card</div>
						</div>
					</div>-->
					<!-- <div class="radioButton">
						<div class="radioText">
							<div class="radio1"><input type="radio" id="cod" value="EMI" name="pg"/></div>
							<div class="checkText">EMI</div>
						</div>
						<div class="radioText">
							<div class="radio1"><input type="radio" id="emi" value="DB" name="pg"/></div>
							<div class="checkText">Debit Card</div>
						</div>
					</div>-->
					<div class="row">
						<div class="buttonContainer">
							<input type="hidden" name="pg" value="CC" id="pgHandle"/>
							<input type="hidden" name="firstname"
								value="<?php if (!empty($firstname)) echo $firstname; else echo $userArr['firstname']; ?>"/>
							<input type="hidden" name="lastname"
								value="<?php if (!empty($lastname)) echo $lastname; else echo $userArr['lastname']; ?>"/>
							<input type="hidden" name="address1"
								value="<?php if (!empty($address1)) echo $address1; else echo $userArr['address1'];?>"/>
							<input type="hidden" name="city"
								value="<?php if (!empty($city)) echo $city; else echo $userArr['city']; ?>"/>
							<input type="hidden" name="state"
								value="<?php if (!empty($state)) echo $state; else echo $userArr['state']; ?>"/>
							<input type="hidden" name="country"
								value="<?php if (!empty($country)) echo $country; else echo $userArr['country']; ?>"/>
							<input type="hidden" name="zipcode"
								value="<?php if (!empty($zipcode)) echo $zipcode; else echo $userArr['zipcode'];?>"/>
							<input type="hidden" name="mob_country_code" value="<?php echo $mob_country_code; ?>"/>
							<input type="hidden" name="phone"
								value="<?php if (!empty($phone)) echo $phone; else echo $userArr['phone'];?>"/>
							<input type="hidden" name="email"
								value="<?php if (!empty($email)) echo $email; else echo $userArr['email'];?>"/>
							<input type="hidden" name="amount"
								value="<?php if (!empty($amount)) echo $amount; else echo $userArr['amount'];?>">
							<input type="hidden" name="tax"
								value="<?php if (!empty($tax)) echo $tax; else echo $userArr['tax'];?>">
							<button class="btn btn-success btn-large" type="submit" onClick="validate()">Proceed</button>
							<a href="checkout">
								<button class="btn btn-danger btn-large" type="button">Back</button>
							</a>
						</div>
					</div>
				</form>
				<!--<div class="" style="clear: both; padding-top: 10px; padding-left: 0px;"> <div class="checkText" style="clear: both; padding-left: 0px; width: 527px;">The following products in your cart don't have COD option</div> <div></div> </div>-->
			</div>
			<div class="panelSeperator"></div>
			<div class="rightPanel" style="width: auto !important;">
				<div class="cartSummaryHolder">
					<div class="cartHeader">
						<div class="cartTransparent"></div>
						<div class="cartContents">
							<div class="labelFont fl">Cart Summary</div>
							<a href="<?php echo $base_url . "index.php/cart/shopping_cart/" . $user_id; ?>">
								<div class="editorIcon"></div>
							</a></div>
					</div>
					<div class="summaryWrapper">
						<div class="summaryTransparent"></div>
						<div class="summaryContents">
							<div class="sumRow">
								<div class="subText">Sub Total</div>
								<div class="subAmount"><span
										class="rupee">`</span><?php if (!empty($amount)) echo $amount; else echo $userArr['amount'];?>
								</div>
							</div>
							<div class="sumRow">
								<div class="subText">Shipping Charges</div>
								<div class="subAmount"><span class="rupee">`</span> 00.00</div>
							</div>
							<!-- <div class="sumRow">
								<div class="subText">Taxes</div>
								<div class="subAmount"><span
										class="rupee">`</span><?php if (!empty($tax)) echo $tax; else echo $userArr['tax'];?>
								</div>
							</div> -->
						</div>
					</div>
					<div class="totalWrapper">
						<div class="totalTransparent"></div>
						<div class="totalContents">
							<div class="totalText">Total</div>
							<div class="totalAmt"><span
									class="rupee">`</span><?php if (!empty($amount)) echo $amount; else echo $userArr['amount'];?>
							</div>
						</div>
					</div>
				</div>
				<div class="shippingAddressContainer">
					<div class="shippingAddressTransparent"></div>
					<div class="shippingAddressContents">
						<div class="shippingHeader">
							<div class="labelFont fl">Shipping Address</div>
							<a href="checkout">
								<div class="editorIcon"></div>
							</a></div>
						<div class="addressContent">
							<div class="address"><span
									class="shippingName"><?php echo $userArr['firstname'] . " " . $userArr['lastname']; ?>
									, <?php echo $userArr['address1'] . '<br>' . $userArr['city'] . ',' . $userArr['state'] . ',' . $userArr['country'] . '-' . $userArr['zipcode']; ?></span>
							</div>
							<div class="shippingMobile">Mobile : <?php echo $userArr['phone'];?></div>
							<div class="shippingEmail">Email: <?php echo $userArr['email'];?></div>
						</div>
					</div>
				</div>
				<!-- <div class="needHelpContainer"> <div class="labelFont">Need Help?</div> <div class="paddingtop"><a href="javascript:void(0)" class="linkText">Email assistance</a></div> <div class="paddingtop"><a href="javascript:void(0)" class="linkText">FAQs</a></div> <div class="paddingtop"><a href="javascript:void(0)" class="linkText">Call Customer Care</a></div> </div>-->
			</div>
		</div>
	</section>
</section>

<script type="text/javascript">

	var userEmail = "<?php echo $userDetails[0]->email; ?>";
	var checkout2VisitCounter = parseInt(getCookie("checkout2VisitCounter"));
	var checkout2CartSize = parseInt(getCookie("checkout1CartSize"));
	if(!checkout2VisitCounter){
		checkout2VisitCounter=0;
		console.log('First page visit;');
	}
	checkout2VisitCounter++;
	setCookie("bnbCouponID", "none");
	setCookie("checkout2VisitCounter", checkout2VisitCounter);
	//console.log("ANALYTICS ++++ checkout2load vars " + userEmail + checkout2CartSize + " -- " + checkout2VisitCounter);
	_bnbAnalytics.checkout2Loaded(userEmail, checkout2CartSize, checkout2VisitCounter);

	function updateAmount(val) {
		var template = '',
			originalAmount = <?php echo $amount;?>,
			codAmount, totalAmount;
		//Show Online Amount
		if(val == 0) {
			$('.summaryContents').find('#codAmount').remove();
			document.getElementsByClassName('totalAmt')[0].childNodes[1].textContent = originalAmount;
			document.forms.checkoutII.amount.value = originalAmount;

		}
		//Show COD Amount
		else if(val == 1) {
			codAmount = <?php echo $codProductsQuantity*50;?>; 
			totalAmount = originalAmount + codAmount;
			
			template = '<div id="codAmount" class="sumRow">' +
							'<div class="subText">COD Charges</div>' +
							'<div class="subAmount"><span class="rupee">`</span>' + codAmount + '</div>' +
						'</div>';

			$('.summaryContents').append(template);
			document.getElementsByClassName('totalAmt')[0].childNodes[1].textContent = totalAmount;
			document.forms.checkoutII.amount.value = totalAmount;
		}
	}

	function validate() {
		if (document.getElementById("debit").checked) {

			document.getElementById("pgHandle").value = "CC";

			setCookie("bnb_Mode_Of_Payment", "Online Payment");

			mixpanel.track_forms("#checkoutII", "Order confirmed", {
				"Mode_Of_Payment" : "Online payment",
				'Cart_Size': checkout2CartSize
			}, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "order confirmed update sent on shopping cart page.");});
			return true;

		} else if (document.getElementById("netbanking").checked) {

			document.getElementById("pgHandle").value = "COD";

			setCookie("bnb_Mode_Of_Payment", "Cash on delivery");

			mixpanel.track_forms("#checkoutII", "Order confirmed", {
				"Mode_Of_Payment" : "Cash on delivery",
				'Cart_Size': checkout2CartSize
			}, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "order confirmed update sent on shopping cart page.");});
			return true;

		} else {
			alert('Please select payment type');
			return false;
		}
	}
	
</script>

<?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script src="<?php echo $base_url; ?>assets/js/checkout.js"></script>
</html>