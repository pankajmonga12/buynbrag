<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Empty Carty</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_page.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/empty_carty.css" type="text/css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<section class="middleBackground">
		<div class="topDotSeparator top0"></div>
		<div class="shoppingContentsContainer">
			<div class="empty_cart_image"></div>
			<div class="empty_cart_contents">
				<div class="your_cart_text">Your cart is empty.</div>
				<a href="javascript:history.back()">
					<div class="browse_text">Back</div>
				</a> <a href="<?php echo $base_url . 'user_info/homepage_afterlogin' ?>">
					<div class="browse_text">Home</div>
				</a></div>
		</div>
		</div> </section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript">
	var totalScroll = 0;

	$("#scrollLeftButton").click(function () {
		if (totalScroll <= 0) return;
		totalScroll = totalScroll - 1025;
		$('#sliderParentDiv').animate({scrollLeft: totalScroll}, 2050);
	});

	$("#scrollRightButton").click(function () {
		maxScroll = parseInt($(".slider4").css("width")) - parseInt($("#sliderParentDiv").width());
		if (totalScroll > maxScroll) return;
		totalScroll = totalScroll + 1025;
		$('#sliderParentDiv').animate({scrollLeft: totalScroll}, 2050);
	});
</script>
</html>