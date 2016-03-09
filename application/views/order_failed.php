<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Order Failed</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/order_failed.css" type="text/css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>

<script type="text/javascript">
	var userEmail = "<?php echo $userDetails[0]->email; ?>";
	//console.log("ANALYTICS ++++ order faled vars : " + userEmail);
    _bnbAnalytics.orderFailed(userEmail);
</script>

<body>
<section class="wrapper">
	<section class="middleBackground">
		<div class="orderContentsContainer">
			<div class="order_successful_Holder">
				<div class="order_success_background"></div>
				<div class="order_success_contents">
					<div class="failed_text">Your Order from BnB has been <span style="color:#e81c4d">Failed</span>
					</div>
					<div class="failed_text wrong_details_text">This is due to Wrong Credit Card Number</div>
					<div class="button_holder"><a href="<?php echo $base_url . "index.php/cart/shopping_cart"; ?>">
							<button type="button" id="back_to_cart" class="back_to_cart">Back to Shopping Cart</button>
						</a></div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
</html>