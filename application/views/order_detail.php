<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/jquery.tooltip.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/jquery.ui.dialog.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/jquery.selectbox.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/sexy-combo.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/>
	<![endif] -->
</head>
<body>
<?php
//$tabName = $_REQUEST['tabName'];
?>
<?php include_once('header.php'); ?>
<section class="wrapper">
<article class="banner">
	<div class="slide">
		<div class="bannerHolder">
			<div class="bannerLogo"></div>
			<div class="bannerText">
				<div class="bannerHeadingHolder">
					<div class="bannerTextHeading">CONGRATULATIONS</div>
					<div class="bannerTextTop">Your store has been created.</div>
				</div>
				<div class="bannerTextHolder">
					<div class="bannerShopText">Shop URL :</div>
					<div class="bannerURLText">copplestore.buynbrag.com</div>
				</div>
			</div>
			<div class="bannerContentSeparator"></div>
			<div class="yourShopImage">Your Shop is still in maintance mode</div>
			<div class="bannerButtonsHolder">
				<button type="button" class="bannerButtonImage1">Make it Live</button>
				<a href="javascript:void(0);">
					<button type="button" class="bannerButtonImage2">Change Settings</button>
				</a>
			</div>
		</div>
	</div>
</article>
<nav class="middleColumnTop">
	<div class="topDotSeparator newtopDotSeparator"></div>
	<div class="linksMiddle">
		<a href="dashboard.php">
			<div class="dashboardLink">
				<div class="dashboardLogo"></div>
				<div class="dashboardText">Dashboard</div>
			</div>
		</a>
		<a href="products.php">
			<div class="productsLink">
				<div class="productsLogo"></div>
				<div class="productsText">Products</div>
			</div>
		</a>
		<a href="design.php">
			<div class="productsLink">
				<div class="designLogo"></div>
				<div class="productsText">Design</div>
			</div>
		</a>
		<a href="promote_discount_single_product.php">
			<div class="productsLink">
				<div class="promoteLogo"></div>
				<div class="productsText">Promote</div>
			</div>
		</a>
		<a href="store_info.php">
			<div class="productsLink">
				<div class="storeLogo"></div>
				<div class="productsText">Store Profile</div>
			</div>
		</a>
		<a href="bill.php">
			<div class="productsLink">
				<div class="billLogo"></div>
				<div class="productsText">Bill</div>
			</div>
		</a>
	</div>
	<div class="topDotSeparator newtopDotSeparator1"></div>
</nav>
<section class="middleBackground">
	<div class="orderStatusContainer">
		<div class="orderStatusImages">
			<a href="javascript:void(0);">
				<div title="Statistics" class="statisticsImage showtooltip"></div>
			</a>
			<a href="javascript:void(0);">
				<div class="orderStatusImage"></div>
			</a>

			<div class="orderStatusText">ORDER STATUS</div>
		</div>
	</div>
	<div class="whiteSeparator"></div>
	<div class="middleContainerTabscontent">
		<div class="whiteSeparator" style="top:48px;"></div>
		<div class="middleTabsContainer">
			<div class="orderDetailsParent">
				<ul>
					<li id="liTab1"><a href="dashboard.php?tabName=1">All</a></li>
					<li id="liTab2"><a href="dashboard.php?tabName=2">New Order</a></li>
					<li id="liTab3"><a href="dashboard.php?tabName=3">In Process</a></li>
					<li id="liTab4"><a href="dashboard.php?tabName=4">Shipping</a></li>
					<li id="liTab5"><a href="dashboard.php?tabName=5">Completed</a></li>
					<li id="liTab6"><a href="dashboard.php?tabName=6">Canceled</a></li>
					<li id="liTab7"><a href="dashboard.php?tabName=7">Problem with Order</a></li>
				</ul>
				<div>
					<div class="orderdetails_hidden">
						<div class="sortByContainer">
							<div class="sortByContainerTransparent"></div>
							<div class="sortByContent">
								<div class="orderdetails_text"> Order details</div>
								<a href="dashboard.php<?php echo "?tabName=" . $tabName?>" class="back_button">Back to
									order list</a>
							</div>
						</div>
						<div class="detailsContainerRelative">
							<div class="detailsContainerTransparent"></div>
							<div class="details_container">
								<div class="first_left">
									<div class="stableglass_border">
										<img src="../assets/images/staableglass_image_171x171pixel.png"
										     alt="Product image"/>
									</div>
									<div class="shipping_button">
										<div class="shipping_icon"></div>
										<div class="shipping_text">Shipping</div>
									</div>
								</div>
								<div class="second_left">
									<div class="stableglass_details">
										<div class="stableglass_text">Stable glass</div>
										<div class="label_italic">purchase date<span
												class="label_details">Jan 24, 2012</span></div>
										<div class="label_italic">store<span class="label_details">copplestore</span>
										</div>
										<div class="label_italic" style="float:left; padding-top:10px;">Payment</div>
										<div class="payments_icon"></div>
										<div class="receipt_text">Reciept for #67859483</div>
										<div class="startprocessing_icon"></div>
										<div class="problemwithorder_icon"></div>
									</div>
								</div>
								<div class="vertical_separator" style="height:210px;margin-top:12px;"></div>
								<div class="third_left">
									<div class="third_top">
										<div class="top_box">
											<div class="top_text top_box1 " style="margin-top:-1px;">1</div>
											<div class="label_italic top_box1">Quantity</div>
										</div>
										<div class="vertical_separator custom_sep"></div>
										<div class="top_box">
											<div class="top_text top_box2"><span class="rupee">`</span> 25%</div>
											<div class="label_italic top_box2">discount</div>
										</div>
										<div class="vertical_separator custom_sep"></div>
										<div class="top_box">
											<div class="top_text"><span class="rupee">`</span> 9/-</div>
											<div class="label_italic2">shipping cost</div>
										</div>
										<div class="vertical_separator custom_sep"></div>
										<div class="top_box">
											<div class="top_text" style="color:#da3c63;"><span class="rupee">`</span>
												899/-
											</div>
											<div class="label_italic2">total price</div>
										</div>
									</div>
									<div class="horizontal_separator" style="width:580px;"></div>
									<div class="third_bottom">
										<div class="bottom_box">
											<div class="bottom_text">Buyer</div>
											<div class="pavan_bg">
												<img src="../assets/images/pavankudla_image_43x43pixel.png"
												     style="margin:3px"/>
											</div>
											<div class="name_text">Pavan Kudla
												<div class="siverbadge"></div>
											</div>
										</div>
										<div class="vertical_separator" style="height:112px; margin-top:10px;"></div>
										<div class="bottom_box">
											<div class="bottom_text">Shipping Address</div>
											<div class="add_text">
												<div>#34, 2nd cross, Indira Nagar, Bangalore,</div>
												<div>Karanataka,India</div>
											</div>
											<div class="label_italic clear_both">Contact<span class="label_details"
											                                                  style="padding-left:50px;">990123456</span>
											</div>
											<div class="label_italic">Email<span class="label_details"
											                                     style="padding-left:65px;">pk@gmail.com</span>
											</div>
										</div>
									</div>
								</div>
								<div class="feedbackImage" style="display:block;">Feedback</div>
							</div>
						</div>
						<div class="communicationHolderRelative">
							<div class="communicationHolderTransparent"></div>
							<div class="communicationAbsolute">
								<div class="communicationRelative">
									<div class="comm_icon"></div>
									<div class="comm_text">Communication</div>
								</div>
								<div class="pupplestoredivRelative">
									<div class="icon_bg"></div>
									<div class="img_details">
										<div class="names">Pupplestore<span class="timing">2 month ago</span></div>
										<div class="img_about">
											<div>Eating, drinking, sleeping! A little laughter! Much weeping!Is that all
												? Do not die here like a worm.
											</div>
											<div>Attain Immortal Bliss.</div>
										</div>
									</div>
									<div class="floatright">
										<div class="vertical_separator" style="height:77px;"></div>
										<div class="pupplestore_icon"></div>
										<div class="vertical_separator" style="height:77px;"></div>
										<div class="pupplestore_close"></div>
									</div>
								</div>
								<div class="pupplestoredivRelative">
									<div class="icon_bg"><img src="../assets/images/pavankudla_image_43x43pixel.png"
									                          style="margin:3px"/></div>
									<div class="img_details">
										<div class="names">Pavan Kudla <span class="timing">2 month ago</span></div>
										<div class="img_about">Eating, drinking, sleeping! A little laughter! Much
											weeping!Is that all ? Do not die here like a worm.
										</div>
									</div>
								</div>
								<div class="pupplestoredivRelative">
									<div class="icon_bg"></div>
									<div class="img_details">
										<div class="names">Pupplestore<span class="timing">2 month ago</span></div>
										<div class="img_about">Eating, drinking, sleeping! A little laughter! Much
											weeping!Is that all ? Do not die here like a worm.
											Attain Immortal Bliss.
										</div>
									</div>
								</div>
								<div class="pupplestoredivRelative">
									<div class="search_text">
										<div class="search_text_mid">
											<input type="text" name="search"/>
										</div>
									</div>
									<div class="searching_icon"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</section>
<?php include "footer.php" ?>
</body>
<script>
	$(function () {
		$("#liTab<?php echo $tabName; ?>").addClass('active_tab');
	});
</script>
</html>
