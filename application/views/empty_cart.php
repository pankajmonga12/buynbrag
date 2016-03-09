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
		<div class="shoppingCartIconHolder">
			<div class="shoppingCartIcon"></div>
			<div class="shoppingCartText">SHOPPING CART</div>
		</div>
		<div class="topDotSeparator top0"></div>
		<div class="shoppingContentsContainer">
			<div class="empty_cart_image"></div>
			<div class="empty_cart_contents">
				<div class="your_cart_text">Your cart is empty.</div>
				<a href="javascript:history.back()">
					<div class="browse_text">Back</div>
				</a> <a href="<?php echo $base_url . '/homepage' ?>">
					<div class="browse_text">Home</div>
				</a></div>
		</div>
		<!-- <div class="topDotSeparator" style="position:relative;top:1px;"></div> <div class="panelBottomPattern"></div> <div class="bottomPatternHolder"> <div class="recently_text">Recently Viewed</div> <div class="bottomScrollerHolderBottom"> <div class="scrollerHolder4"> <div class="storeViewIcon" style="top:-60px;"></div> <div class="scrollerContents4"> <div class="button-block-left top58" id="scrollLeftButton"></div> <div id="sliderParentDiv" class="sliderParentDiv4"> <div class="slider4" id="slider"> <div class="store-list paddingLeft0"> <div class="rightPanelImageHolder1"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>index.php/images/recent_1.png" /></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> </div> </div> </div> <div class="button-block-right top58" id="scrollRightButton"></div> </div> </div> </div> </div> -->
	</section>
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