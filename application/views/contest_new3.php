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
				     style="width: 1024px; height: 218px; padding: 4px; border: 1px solid #ECDEE6; display: block; background-color: #f0f1f2">
					<table border="0">
						<tr>
							<td colspan="8" style="height: 5px"></td>
							<!-- <td style="height: 12px">&nbsp;</td> --> </tr>
						<tr>
							<td style="width: 390px">blank area</td>
							<td><img src="<?php echo base_url(); ?>assets/images/badges_spacer.jpg"/></td>
							<td><img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/></td>
							<td><img src="<?php echo base_url(); ?>assets/images/plus.jpg"/></td>
							<td><img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/></td>
							<td><img src="<?php echo base_url(); ?>assets/images/plus.jpg"/></td>
							<td><img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/></td>
							<td><img src="<?php echo base_url(); ?>assets/images/discount_image.jpg"
							         style="margin-top: 24px"/></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td style="text-align: center">Text1</td>
							<td></td>
							<td style="text-align: center">Text2</td>
							<td></td>
							<td style="text-align: center">Text 3</td>
							<td></td>
						</tr>
					</table>
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
				</div> <?php include "footer.php" ?>
</body>
</html> <?php //gc_disable(); ?>