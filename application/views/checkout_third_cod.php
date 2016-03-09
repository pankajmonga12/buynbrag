<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Check Out III</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/checkout.css"/>
</head>
<body> <?php //include_once('header2.php'); ?>
<section class="wrapper">
	<section class="middleBackground newMinHeight">
		<div class="topBanerPatternContainer diffHeight">
			<div class="checkWrapper">
				<div class="checkoutIcon"></div>
				<div class="checkoutText">CHECKOUT</div>
				<div class="rightWrapper">
					<div class="Iimage"></div>
					<div class="IIimage"></div>
					<div class="IIIimage"></div>
				</div>
			</div>
		</div>
		<div class="topDotSeparator"></div>
		<div class="middleContainer newHeight">
			<div class="checkHeading">Order Confirmed For Cash On Delivery</div>
			<div class="nextWrapper">
				<div class="cartSummaryHolder marginStyle" style="margin-left:0px">
					<div class="cartHeader">
						<div class="cartTransparent"></div>
						<div class="cartContents anwidth">
							<div class="labelFont fl">Cart Summary</div>
							<!--div class="editorIcon"></div--> </div>
					</div>
					<div class="summaryWrapper">
						<div class="summaryTransparent"></div>
						<div class="summaryContents">
							<div class="sumRow">
								<div class="subText diffwidth">Sub Total</div>
								<div class="subAmount"><span class="rupee">`</span><?php echo $amount - $tax; ?></div>
							</div>
							<div class="sumRow">
								<div class="subText diffwidth">Shipping Charges</div>
								<div class="subAmount"><span class="rupee">`</span>00.00</div>
							</div>
							<div class="sumRow">
								<div class="subText diffwidth">Taxes</div>
								<div class="subAmount"><span class="rupee">`</span><?php echo $tax; ?></div>
							</div>
						</div>
					</div>
					<div class="totalWrapper">
						<div class="totalTransparent"></div>
						<div class="totalContents">
							<div class="totalText diffwidth">Total</div>
							<div class="totalAmt"><span class="rupee">`</span><?php echo $amount; ?></div>
						</div>
					</div>
				</div>
				<div class="shippingAddressContainer marginStyle">
					<div class="shippingAddressTransparent2"></div>
					<div class="shippingAddressContents">
						<div class="shippingHeader">
							<div class="labelFont fl">Shipping Address</div>
							<!--div class="editorIcon"></div--> </div>
						<div class="addressContent">
							<div class="addresslabel">Name<span
									class="addressDetails">:<?php echo $firstname . " " . $lastname; ?></span></div>
							<div class="address">Address<span
									class="addressDetails"> :<?php echo $address1 . '<br>' . $city . ', ' . $state . '<br>' . $country . '-' . $zipcode; ?></span>
							</div>
							<div class="addresslabel">Mobile <span class="addressDetails">:<?php echo $phone;?></span>
							</div>
							<div class="addresslabel">Email <span class="addressDetails">:<?php echo $email;?></span>
							</div>
							<div class="addresslabel">Payment Type <span
									class="addressDetails">:<?php echo $pt;?></span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="buttonContainer"> <?php $txnid = substr(md5(uniqid(rand(), true)), 0, 16); ?>
				<form name="checkoutIII" action="checkout_third_cod" method="POST"><input type="hidden" name="email"
				                                                                          value="<?php echo $email; ?>"/>
					<input type="hidden" name="firstname" value="<?php echo $firstname; ?>"/> <input type="hidden"
					                                                                                 name="lastname"
					                                                                                 value="<?php echo $lastname; ?>"/>
					<input type="hidden" name="address1" value="<?php echo $address1; ?>"/> <input type="hidden"
					                                                                               name="city"
					                                                                               value="<?php echo $city; ?>"/>
					<input type="hidden" name="state" value="<?php echo $state; ?>"/> <input type="hidden"
					                                                                         name="country"
					                                                                         value="<?php echo $country; ?>"/>
					<input type="hidden" name="zipcode" value="<?php echo $zipcode; ?>"/> <input type="hidden"
					                                                                             name="mob_country_code"
					                                                                             value="<?php echo $mob_country_code; ?>"/>
					<input type="hidden" name="phone" value="<?php echo $phone; ?>"/> <input type="hidden" name="txnid"
					                                                                         value="<?php echo $txnid; ?>"/>
					<button class="prod_continue" type="submit">Order</button>
					<a href="checkout_second">
						<button class="prod_cancel" type="button">Back</button>
					</a></form>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
</html>