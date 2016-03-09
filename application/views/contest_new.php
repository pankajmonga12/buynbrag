<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Contest Page</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<style type="text/css">
		.soldOut {
			position: absolute;
			top: 4px;
			left: 4px;;
			background-image: url("<?php echo $base_url; ?>assets/images/soldout.png");
			width: 100px;
			height: 70px;
		}

		.paddingMore {
			left: 12px !important;
		}
	</style>
	<!-- for view.js <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/alt2.css" /> <script src="<?php echo $base_url; ?>assets/js/newview.js?auto"></script>-->
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->
	<style>
		<?php echo $style; ?>
	</style>
</head>
<body>
<script type="text/javascript">
	//<![CDATA[
	//alert(navigator.appName + "<<||>>" + navigator.userAgent);
	var ua = new String(navigator.userAgent);
	var browser = null;
	if (ua.indexOf("Chrome") != -1)
		browser = "GC"; // google chrome
	if (ua.indexOf("Firefox") != -1)
		browser = "FF"; // firefox
	if (ua.indexOf("MSIE") != -1)
		browser = "IE"; // internet explorer
	if (ua.indexOf("Opera") != -1)
		browser = "OP"; // opera
	//alert("Browser Code: " + browser);
	//]]>>
</script>
<section class="wrapper">
	<nav class="middleColumnTop">
		<div class="middleColumnIE">
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="linksMiddle"></div>
			<div class="topDotSeparator newtopDotSeparator1"></div>
		</div>
	</nav>
	<section class="middleBackground">
		<div class="Ie8bg">
			<div class="topDotSeparator topSeparatorStyle"></div>
			<div class="storeMiddleBackgroundContainer">
				<div class="panelContainer">
					<!-- <div class="leftPanel leftPanelNewHeight"> <div class="leftPanelCategory">Categories</div> </div> -->
					<!-- <div class="panelSeparator seperator_new_style"></div> -->
					<div class="rightPanel"> <!-- <div class="trendingNewText">Trending Now</div> -->
						<div id="main_products" class="scrollerHolder" style="width: 1020px; height: 300px">
							<!-- <div class="storeViewIcon icon_new_style"></div> <div class="scrollerContents"> <div class="button-block-left button_left_style"></div> <div class="sliderParentDiv"> <div class="slider" id="slider"> </div> </div> <div class="hoverHolder"> </div> </div> --> </div>
						<!-- <div class="button-block-right button_right_style"></div> --> </div>
				</div>
				<div class="topScrollerSeparator clear_both"></div>
				<!-- <div class="trendingNewText topStoresStyle">Top Stores</div> -->
				<div id="main_stores" class="scrollerHolder2"
				     style="width: 1024px; height: 204px; border: 1px solid #ECDEE6; display: inline-table; background-color: #f0f1f2">
					<!-- <div class="storeViewIcon icon_new_style"></div> <div class="scrollerContents2"> <div class="button-block-left button_left_style2"></div> <div class="sliderParentDiv2"> <div class="slider2" id="slider2"> </div> </div> <div class="button-block-right button_right_style2"></div> </div> -->
					<div style="display: table-cell; width: 390px">blank area</div>
					<div style="display: table-cell; width: 9px">
						<div id="badges_spacer" style="display: table-cell; height: 15px"></div>
						<img src="<?php echo base_url(); ?>assets/images/badges_spacer.jpg"/></div>
					<div style="display: table-cell; width: 137px">
						<div style="display: table-cell; height: 24px"></div>
						<img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/>

						<p style="text-align: center">Text</p></div>
					<div style="display: table-cell; width: 18px">
						<div style="display: table-cell; height: 84px;"></div>
						<img src="<?php echo base_url(); ?>assets/images/plus.jpg"/></div>
					<div style="display: table-cell; width: 4px"></div>
					<div style="display: table-cell; width: 137px">
						<div style="display: table-cell; height: 24px"></div>
						<img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/>

						<p style="text-align: center">Text</p></div>
					<div style="display: table-cell; width: 18px">
						<div style="display: table-cell; height: 84px"></div>
						<img src="<?php echo base_url(); ?>assets/images/plus.jpg"/></div>
					<div style="display: table-cell; width: 4px"></div>
					<div style="display: table-cell; width: 137px">
						<div style="display: table-cell; height: 24px"></div>
						<img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/>

						<p style="text-align: center">Text</p></div>
					<div style="display: table-cell; width: 128px">
						<div style="display: table-cell; height: 21px"></div>
						<img src="<?php echo base_url(); ?>assets/images/discount_image.jpg"/></div>
				</div>
				<div class="topScrollerSeparator clear_both"></div>
				<div id="main_stores" class="scrollerHolder2"
				     style="left: -1%; width: 1024px; height: 204px; display: inline-table">
					<div style="width: 27%; display: table-cell; border: 1px solid #ECDEE6;"> dynamically generated box
						with data
					</div>
					<div style="width: 3%; display: table-cell"></div>
					<div style="width: 27%; display: table-cell; border: 1px solid #ECDEE6;"> dynamically generated box
						with data
					</div>
					<div style="width: 3%; display: table-cell"></div>
					<div style="width: 40%; display: table-cell; border: 1px solid #ECDEE6;"> dynamically generated box
						with data
					</div>
				</div>
				<section class="middleBackground clear_both">
					<div class="middleBackgroundie8">
						<div class="middleContainer"> <?php if (count($fprod) > 5) {
								$loop = floor(count($fprod) / 5) . '<br>';
								$imgloop = count($fprod) % 5 . '<br>';
							} else {
								$imgloop = count($fprod) % 5 . '<br>';
							} $p = 0; ?> <?php if (isset($loop)) for ($i = 0; $i < $loop; $i++): ?> <?php $numbers = range(2, 3);
								shuffle($numbers); ?> <?php include "hflayout" . $numbers[0] . ".php"; ?> <?php include "hflayout" . $numbers[1] . ".php"; ?> <?php endfor; ?> <?php if ($imgloop == 4): ?> <?php include 'hflayout2.php'; ?> <?php include 'hflayout2.php'; ?> <?php elseif ($imgloop == 3): ?> <?php include 'hflayout3.php'; ?> <?php elseif ($imgloop == 2): ?> <?php include 'hflayout2.php'; ?> <?php endif; ?>
							<input type="hidden" value="10" class="lazyid"/></div> <?php include "footer.php" ?>
</body>
</html>