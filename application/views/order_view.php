<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?> <!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body> <?php //include_once('header.php'); ?>
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
						<div class="bannerURLText"><?php echo $result[0]->store_url;?></div>
					</div>
				</div>
				<div class="bannerContentSeparator"></div>
				<div class="yourShopImage">Your Shop is still in maintance mode</div>
				<div class="bannerButtonsHolder">
					<button type="button" class="bannerButtonImage1">Make it Live</button>
					<a href="javascript:void(0);">
						<button type="button" class="bannerButtonImage2">Change Settings</button>
					</a></div>
			</div>
		</div>
	</article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle"><a href="dashboard.php">
				<div class="dashboardLink">
					<div class="dashboardLogo"></div>
					<div class="dashboardText">Dashboard</div>
				</div>
			</a> <a href="products.php">
				<div class="productsLink">
					<div class="productsLogo"></div>
					<div class="productsText">Products</div>
				</div>
			</a> <a href="design.php">
				<div class="productsLink">
					<div class="designLogo"></div>
					<div class="productsText">Design</div>
				</div>
			</a> <a href="javascript:void(0);">
				<div class="productsLink">
					<div class="promoteLogo"></div>
					<div class="productsText">Promote</div>
				</div>
			</a> <a href="store_info.php">
				<div class="productsLink">
					<div class="storeLogo"></div>
					<div class="productsText">Store Profile</div>
				</div>
			</a> <a href="javascript:void(0);">
				<div class="productsLink">
					<div class="billLogo"></div>
					<div class="productsText">Bill</div>
				</div>
			</a></div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground">
		<div class="orderStatusContainer">
			<div class="orderStatusImages"><a href="javascript:void(0);">
					<div class="statisticsImage"></div>
				</a> <a href="javascript:void(0);">
					<div class="orderStatusImage"></div>
				</a>

				<div class="orderStatusText">ORDER STATUS</div>
			</div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="middleContainerTabscontent">
			<div class="whiteSeparator" style="top:48px;"></div>
			<div class="middleTabsContainer">
				<div id="tabs">
					<ul>
						<li><a href="#tab1">All</a></li>
						<li><a href="#tab2">New Order</a></li>
						<li><a href="#tab3">In Process</a></li>
						<li><a href="#tab4">Shipping</a></li>
						<li><a href="#tab5">Completed</a></li>
						<li><a href="#tab6">Canceled</a></li>
						<li><a href="#tab7">Problem with Order</a></li>
					</ul>
					<div id="tab1">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing 5 / 15 Orders</div>
									<div class="sortbyTextHolder">
										<div class="sortbyText sortbyColor">Sort By</div>
										<div class="sortbyText">Most Recent</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Oldest</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Highest Value</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Lowest Value</div>
									</div>
								</div>
							</div>
							<div class="titleBackground">
								<div class="titleBackgroundTransparent"></div>
								<div class="titleBackgroundHolder">
									<div class="titleTextHolder">
										<div class="titleText">Title</div>
									</div>
									<div class="quantityHolder">
										<div class="quantityText">Quantity</div>
									</div>
									<div class="quantityHolder1">
										<div class="quantityText">Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText">Shipping</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div
									class="stableGlassContentHolder"> <?php for ($i = 0; $i < count($result1); $i++): $r = $i + 1; ?>
										<div class="stableGlassContainerRelative">
											<div class="stableGlassContainerTransp"
											     id="row_transp<?php echo $r; ?>"></div>
											<div class="stableGlassContainer1"
											     onMouseOver="return transp(<?php echo $r; ?>)"
											     onMouseOut="return normal(<?php echo $r; ?>)">
												<div class="stableGlassRelative">
													<div class="stableglassHolder"><a href="order_details.php?tabName=1"
													                                  class="stableglassImage"><img
																src="<?php echo $result1[$i]->image1_path;?>"
																alt="glass Image"/></a>

														<div class="stableglassText"><a
																href="order_details.php?tabName=1"
																class="stableglassHeading"><?php echo $result1[$i]->product_name; ?></a>

															<div class="purchaseText">purchase date<span
																	class="purchaseSpan">Jan 12, 2012</span></div>
															<div class="silverImage"><img
																	src="<?php echo $result1[$i]->image2_path;?>"
																	alt="stable"/></div>
														</div>
													</div>
													<div class="quantityRow1">
														<div
															class="qtyNumber paddingTOp25"><?php echo $result1[$i]->quantity; ?></div>
													</div>
													<div class="quantityRow2">
														<div class="qtyNumber"><span
																class="rupee">`</span> <?php echo $result1[$i]->selling_price; ?>
														</div>
														<div class="paidImage"><img
																src="<?php echo $result1[$i]->status_image;?>"
																alt="<?php echo $result1[$i]->payment_status;?>"/></div>
													</div>
													<div class="quantityRow3">
														<div class="qtyNumber"><span
																class="rupee">`</span> <?php echo $result1[$i]->shipping_cost; ?>
														</div>
													</div>
													<div class="quantityRow4">
														<div class="shippingImage">
															<div class="shippingInnerImage"></div>
															<div
																class="shippingTxt"><?php echo $result1[$i]->status; ?></div>
														</div>
													</div>
													<div class="quantityRow5">
														<div class="communicationImage">
															<div class="communicationNumber">3</div>
														</div>
													</div>
													<div class="pdfImage">
														<div class="pdf_icon"></div>
													</div>
													<div class="feedbackImage" id="feed<?php echo $r; ?>">Feedback</div>
												</div>
											</div>
										</div> <?php endfor; ?> </div>
							</div>
							<div class="slideBackground">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
					<div id="tab2">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing 5 / 15 Orders</div>
									<div class="sortbyTextHolder">
										<div class="sortbyText sortbyColor">Sort By</div>
										<div class="sortbyText">Most Recent</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Oldest</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Highest Value</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Lowest Value</div>
									</div>
								</div>
							</div>
							<div class="titleBackground">
								<div class="titleBackgroundTransparent"></div>
								<div class="titleBackgroundHolder">
									<div class="titleTextHolder">
										<div class="titleText">Title</div>
									</div>
									<div class="quantityHolder">
										<div class="quantityText">Quantity</div>
									</div>
									<div class="quantityHolder1">
										<div class="quantityText">Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText">Shipping</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder">
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp6"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(6)"
										     onMouseOut="return normal(6)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=2"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/glass_image.png"
															alt="glass Image"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=2"
													                                class="stableglassHeading">Stable
															glass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 899.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingAndProblem">
														<div class="startProcessTooltip">
															<div title="&nbsp;started processing"
															     class="startProcessing startProcess nexttab"></div>
														</div>
														<div class="processingProblemTooltip">
															<div title="Problem with Order"
															     class="problemOrder problem_order problem_popup"></div>
														</div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed6">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp7"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(7)"
										     onMouseOut="return normal(7)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=2"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/colourbottel.png"
															alt="color bottle"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=2"
													                                class="stableglassHeading">Colorbottle</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/colourbottel_badge.png"
																alt="color bottle"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 499.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 19.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingAndProblem">
														<div class="startProcessTooltip">
															<div title="&nbsp;started processing"
															     class="startProcessing startProcess nexttab"></div>
														</div>
														<div class="processingProblemTooltip">
															<div title="Problem with Order"
															     class="problemOrder problem_order problem_popup"></div>
														</div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">5</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed7">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp8"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(8)"
										     onMouseOut="return normal(8)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=2"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/guiterglass.png"
															alt="guiter glass"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=2"
													                                class="stableglassHeading">Guitarglass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingAndProblem">
														<div class="startProcessTooltip">
															<div title="&nbsp;started processing"
															     class="startProcessing startProcess nexttab"></div>
														</div>
														<div class="processingProblemTooltip">
															<div title="Problem with Order"
															     class="problemOrder problem_order problem_popup"></div>
														</div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">2</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed8">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp9"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(9)"
										     onMouseOut="return normal(9)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=2"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/mobilereceiver.png"
															alt="mobile receiver"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=2"
													                                class="stableglassHeading">Mobile
															Reciever</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 1259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingAndProblem">
														<div class="startProcessTooltip">
															<div title="&nbsp;started processing"
															     class="startProcessing startProcess nexttab"></div>
														</div>
														<div class="processingProblemTooltip">
															<div title="Problem with Order"
															     class="problemOrder problem_order problem_popup"></div>
														</div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">6</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed9">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp10"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(10)"
										     onMouseOut="return normal(10)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=2"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/atomwatch.png"
															alt="atom watch"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=2"
													                                class="stableglassHeading">AutomWatch</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingAndProblem">
														<div class="startProcessTooltip">
															<div title="&nbsp;started processing"
															     class="startProcessing startProcess nexttab"></div>
														</div>
														<div class="processingProblemTooltip">
															<div title="Problem with Order"
															     class="problemOrder problem_order problem_popup"></div>
														</div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed10">Feedback</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="slideBackground">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
					<div id="tab3">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing 5 / 15 Orders</div>
									<div class="sortbyTextHolder">
										<div class="sortbyText sortbyColor">Sort By</div>
										<div class="sortbyText">Most Recent</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Oldest</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Highest Value</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Lowest Value</div>
									</div>
								</div>
							</div>
							<div class="titleBackground">
								<div class="titleBackgroundTransparent"></div>
								<div class="titleBackgroundHolder">
									<div class="titleTextHolder">
										<div class="titleText">Title</div>
									</div>
									<div class="quantityHolder">
										<div class="quantityText">Quantity</div>
									</div>
									<div class="quantityHolder1">
										<div class="quantityText">Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText">Shipping</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder">
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp11"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(11)"
										     onMouseOut="return normal(11)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=3"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/glass_image.png"
															alt="glass Image"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=3"
													                                class="stableglassHeading">Stable
															glass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 899.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingImage">
														<div class="processingInnerImage"></div>
														<div class="shippingTxt" style="padding-right:6px;">Processing
														</div>
													</div>
													<div class="startProcessTooltip">
														<div title="Ready for Shipping"
														     class="readyShipping startProcess"></div>
													</div>
													<div class="processingProblemTooltip">
														<div title="Problem with Order"
														     class="problemOrder problem_order problem_popup"></div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed11">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp12"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(12)"
										     onMouseOut="return normal(12)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=3"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/colourbottel.png"
															alt="color bottle"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=3"
													                                class="stableglassHeading">Colorbottle</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/colourbottel_badge.png"
																alt="color bottle"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 499.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 19.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingImage">
														<div class="processingInnerImage"></div>
														<div class="shippingTxt" style="padding-right:6px;">Processing
														</div>
													</div>
													<div class="startProcessTooltip">
														<div title="Ready for Shipping"
														     class="readyShipping startProcess"></div>
													</div>
													<div class="processingProblemTooltip">
														<div title="Problem with Order"
														     class="problemOrder problem_order problem_popup"></div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">5</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed12">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp13"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(13)"
										     onMouseOut="return normal(13)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=3"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/guiterglass.png"
															alt="guiter glass"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=3"
													                                class="stableglassHeading">Guitarglass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingImage">
														<div class="processingInnerImage"></div>
														<div class="shippingTxt" style="padding-right:6px;">Processing
														</div>
													</div>
													<div class="startProcessTooltip">
														<div title="Ready for Shipping"
														     class="readyShipping startProcess"></div>
													</div>
													<div class="processingProblemTooltip">
														<div title="Problem with Order"
														     class="problemOrder problem_order problem_popup problem_popup"></div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">2</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed13">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp14"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(14)"
										     onMouseOut="return normal(14)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=3"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/mobilereceiver.png"
															alt="mobile receiver"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=3"
													                                class="stableglassHeading">Mobile
															Reciever</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 1259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingAndProblem">
														<div class="startProcessTooltip">
															<div title="Ready for Shipping"
															     class="readyShipping startProcess"></div>
														</div>
														<div class="processingProblemTooltip">
															<div title="Problem with Order"
															     class="problemOrder problem_order problem_popup"></div>
														</div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">6</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed14">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp15"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(15)"
										     onMouseOut="return normal(15)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=3"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/atomwatch.png"
															alt="atom watch"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=3"
													                                class="stableglassHeading">AutomWatch</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="processingAndProblem">
														<div class="startProcessTooltip">
															<div title="Ready for Shipping"
															     class="readyShipping startProcess"></div>
														</div>
														<div class="processingProblemTooltip">
															<div title="Problem with Order"
															     class="problemOrder problem_order problem_popup"></div>
														</div>
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed15">Feedback</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="slideBackground">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
					<div id="tab4">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing 5 / 15 Orders</div>
									<div class="sortbyTextHolder">
										<div class="sortbyText sortbyColor">Sort By</div>
										<div class="sortbyText">Most Recent</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Oldest</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Highest Value</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Lowest Value</div>
									</div>
								</div>
							</div>
							<div class="titleBackground">
								<div class="titleBackgroundTransparent"></div>
								<div class="titleBackgroundHolder">
									<div class="titleTextHolder">
										<div class="titleText">Title</div>
									</div>
									<div class="quantityHolder">
										<div class="quantityText">Quantity</div>
									</div>
									<div class="quantityHolder1">
										<div class="quantityText">Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText">Shipping</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder">
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp16"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(16)"
										     onMouseOut="return normal(16)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=4"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/glass_image.png"
															alt="glass Image"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=4"
													                                class="stableglassHeading">Stable
															glass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 899.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="shippingImage" style="margin-top:22px;">
														<div class="shippingInnerImage"></div>
														<div class="shippingTxt">Shipping</div>
													</div>
													<div class="shippingDate"><span class="shippingSpan">&nbsp;at</span>
														Jun 24,2012,1:30pm
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed16">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp17"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(17)"
										     onMouseOut="return normal(17)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=4"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/colourbottel.png"
															alt="color bottle"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=4"
													                                class="stableglassHeading">Colorbottle</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/colourbottel_badge.png"
																alt="color bottle"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 499.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 19.00</div>
												</div>
												<div class="quantityRow4">
													<div class="shippingImage" style="margin-top:22px;">
														<div class="shippingInnerImage"></div>
														<div class="shippingTxt">Shipping</div>
													</div>
													<div class="shippingDate"><span class="shippingSpan">&nbsp;at</span>
														Jun 24,2012,1:30pm
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">5</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed17">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp18"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(18)"
										     onMouseOut="return normal(18)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=4"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/guiterglass.png"
															alt="guiter glass"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=4"
													                                class="stableglassHeading">Guitarglass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="shippingImage" style="margin-top:22px;">
														<div class="shippingInnerImage"></div>
														<div class="shippingTxt">Shipping</div>
													</div>
													<div class="shippingDate"><span class="shippingSpan">&nbsp;at</span>
														Jun 24,2012,1:30pm
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">2</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed18">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp19"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(19)"
										     onMouseOut="return normal(19)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=4"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/mobilereceiver.png"
															alt="mobile receiver"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=4"
													                                class="stableglassHeading">Mobile
															Reciever</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 1259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="shippingImage" style="margin-top:22px;">
														<div class="shippingInnerImage"></div>
														<div class="shippingTxt">Shipping</div>
													</div>
													<div class="shippingDate"><span class="shippingSpan">&nbsp;at</span>
														Jun 24,2012,1:30pm
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">6</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed19">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp20"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(20)"
										     onMouseOut="return normal(20)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=4"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/atomwatch.png"
															alt="atom watch"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=4"
													                                class="stableglassHeading">AutomWatch</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/cod.png" alt="cod"/>
													</div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="shippingImage" style="margin-top:22px;">
														<div class="shippingInnerImage"></div>
														<div class="shippingTxt">Shipping</div>
													</div>
													<div class="shippingDate"><span class="shippingSpan">&nbsp;at</span>
														Jun 24,2012,1:30pm
													</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed20">Feedback</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="slideBackground">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
					<div id="tab5">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing 5 / 15 Orders</div>
									<div class="sortbyTextHolder">
										<div class="sortbyText sortbyColor">Sort By</div>
										<div class="sortbyText">Most Recent</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Oldest</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Highest Value</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Lowest Value</div>
									</div>
								</div>
							</div>
							<div class="titleBackground">
								<div class="titleBackgroundTransparent"></div>
								<div class="titleBackgroundHolder">
									<div class="titleTextHolder">
										<div class="titleText">Title</div>
									</div>
									<div class="quantityHolder">
										<div class="quantityText">Quantity</div>
									</div>
									<div class="quantityHolder1">
										<div class="quantityText">Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText">Shipping</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder">
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp21"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(21)"
										     onMouseOut="return normal(21)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=5"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/glass_image.png"
															alt="glass Image"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=5"
													                                class="stableglassHeading">Stable
															glass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 899.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="completedImage"></div>
													<div class="completedText">Completed</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed21">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_trans22"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(22)"
										     onMouseOut="return normal(22)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=5"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/colourbottel.png"
															alt="color bottle"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=5"
													                                class="stableglassHeading">Colorbottle</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/colourbottel_badge.png"
																alt="color bottle"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 499.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 19.00</div>
												</div>
												<div class="quantityRow4">
													<div class="completedImage"></div>
													<div class="completedText">Completed</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">5</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed22">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp23"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(23)"
										     onMouseOut="return normal(23)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=5"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/guiterglass.png"
															alt="guiter glass"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=5"
													                                class="stableglassHeading">Guitarglass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="completedImage"></div>
													<div class="completedText">Completed</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">2</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed23">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp24"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(24)"
										     onMouseOut="return normal(24)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=5"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/mobilereceiver.png"
															alt="mobile receiver"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=5"
													                                class="stableglassHeading">Mobile
															Reciever</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 1259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="completedImage"></div>
													<div class="completedText">Completed</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">6</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed24">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp25"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(25)"
										     onMouseOut="return normal(25)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=5"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/atomwatch.png"
															alt="atom watch"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=5"
													                                class="stableglassHeading">AutomWatch</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/paid.png"
															alt="paid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="completedImage"></div>
													<div class="completedText">Completed</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed25">Feedback</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="slideBackground">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
					<div id="tab6">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing 5 / 15 Orders</div>
									<div class="sortbyTextHolder"><a href="javascript:void(0);">
											<div class="sortbyText sortbyColor">Sort By</div>
										</a> <a href="javascript:void(0);">
											<div class="sortbyText">Most Recent</div>
										</a>

										<div class="textSeparator" style="height:15px;"></div>
										<a href="javascript:void(0);">
											<div class="sortbyText">Oldest</div>
										</a>

										<div class="textSeparator" style="height:15px;"></div>
										<a href="javascript:void(0);">
											<div class="sortbyText">Highest Value</div>
										</a>

										<div class="textSeparator" style="height:15px;"></div>
										<a href="javascript:void(0);">
											<div class="sortbyText">Lowest Value</div>
										</a></div>
								</div>
							</div>
							<div class="titleBackground">
								<div class="titleBackgroundTransparent"></div>
								<div class="titleBackgroundHolder">
									<div class="titleTextHolder">
										<div class="titleText">Title</div>
									</div>
									<div class="quantityHolder">
										<div class="quantityText">Quantity</div>
									</div>
									<div class="quantityHolder" style="width:136px;">
										<div class="quantityText">Price</div>
									</div>
									<div class="quantityHolder" style="width:129px;">
										<div class="quantityText">Shipping</div>
									</div>
									<div class="quantityHolder" style="width:151px;">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder" style="width:68px;"></div>
									<div class="quantityHolder" style="width:55px;border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder">
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp26"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(26)"
										     onMouseOut="return normal(26)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=6"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/glass_image.png"
															alt="glass Image"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=6"
													                                class="stableglassHeading">Stable
															glass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 899.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="cancelledImage"></div>
													<div class="completedText">Canceled</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed26">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp27"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(27)"
										     onMouseOut="return normal(27)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=6"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/colourbottel.png"
															alt="color bottle"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=6"
													                                class="stableglassHeading">Colorbottle</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/colourbottel_badge.png"
																alt="color bottle"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 499.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 19.00</div>
												</div>
												<div class="quantityRow4">
													<div class="cancelledImage"></div>
													<div class="completedText">Canceled</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">5</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed27">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp28"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(28)"
										     onMouseOut="return normal(28)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=6"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/guiterglass.png"
															alt="guiter glass"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=6"
													                                class="stableglassHeading">Guitarglass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="cancelledImage"></div>
													<div class="completedText">Canceled</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">2</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed28">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp29"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(29)"
										     onMouseOut="return normal(29)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=6"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/mobilereceiver.png"
															alt="mobile receiver"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=6"
													                                class="stableglassHeading">Mobile
															Reciever</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 1259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="cancelledImage"></div>
													<div class="completedText">Canceled</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">6</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed29">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp30"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(30)"
										     onMouseOut="return normal(30)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=6"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/atomwatch.png"
															alt="atom watch"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=6"
													                                class="stableglassHeading">AutomWatch</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="cancelledImage"></div>
													<div class="completedText">Canceled</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed30">Feedback</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="slideBackground">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
					<div id="tab7">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing 5 / 15 Orders</div>
									<div class="sortbyTextHolder">
										<div class="sortbyText sortbyColor">Sort By</div>
										<div class="sortbyText">Most Recent</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Oldest</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Highest Value</div>
										<div class="textSeparator"></div>
										<div class="sortbyText">Lowest Value</div>
									</div>
								</div>
							</div>
							<div class="titleBackground">
								<div class="titleBackgroundTransparent"></div>
								<div class="titleBackgroundHolder">
									<div class="titleTextHolder">
										<div class="titleText">Title</div>
									</div>
									<div class="quantityHolder">
										<div class="quantityText">Quantity</div>
									</div>
									<div class="quantityHolder1">
										<div class="quantityText">Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText">Shipping</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder">
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp31"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(31)"
										     onMouseOut="return normal(31)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=7"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/glass_image.png"
															alt="glass Image"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=7"
													                                class="stableglassHeading">Stable
															glass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 899.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="problemWithOrderImage"></div>
													<div class="problrmWithOrderText">Problem with Order</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed31">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp32"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(32)"
										     onMouseOut="return normal(32)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=7"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/colourbottel.png"
															alt="color bottle"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=7"
													                                class="stableglassHeading">Colorbottle</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/colourbottel_badge.png"
																alt="color bottle"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 499.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 19.00</div>
												</div>
												<div class="quantityRow4">
													<div class="problemWithOrderImage"></div>
													<div class="problrmWithOrderText">Problem with Order</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">5</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed32">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp33"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(33)"
										     onMouseOut="return normal(33)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=7"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/guiterglass.png"
															alt="guiter glass"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=7"
													                                class="stableglassHeading">Guitarglass</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="problemWithOrderImage"></div>
													<div class="problrmWithOrderText">Problem with Order</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">2</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed33">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp34"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(34)"
										     onMouseOut="return normal(34)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=7"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/mobilereceiver.png"
															alt="mobile receiver"/></a>

													<div class="stableglassText"><a href="order_details.php?tabName=7"
													                                class="stableglassHeading">Mobile
															Reciever</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/guiter_badge.png"
																alt="guiter badge"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 1259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 30.00</div>
												</div>
												<div class="quantityRow4">
													<div class="problemWithOrderImage"></div>
													<div class="problrmWithOrderText">Problem with Order</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">6</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed34">Feedback</div>
											</div>
										</div>
									</div>
									<div class="stableGlassContainerRelative">
										<div class="stableGlassContainerTransp" id="row_transp35"></div>
										<div class="stableGlassContainer1" onMouseOver="return transp(35)"
										     onMouseOut="return normal(35)">
											<div class="stableGlassRelative">
												<div class="stableglassHolder"><a href="order_details.php?tabName=7"
												                                  class="stableglassImage"><img
															src="http://localhost/ci/assets/images/atomwatch.png"
															alt="atom watch"/></a>

													<div class="stableglassText"><a class="stableglassHeading"
													                                href="order_details.php?tabName=7">AutomWatch</a>

														<div class="purchaseText">purchase date<span
																class="purchaseSpan">Jan 24, 2012</span></div>
														<div class="silverImage"><img
																src="http://localhost/ci/assets/images/stable_badge.png"
																alt="stable"/></div>
													</div>
												</div>
												<div class="quantityRow1">
													<div class="qtyNumber paddingTOp25">1</div>
												</div>
												<div class="quantityRow2">
													<div class="qtyNumber"><span class="rupee">`</span> 259.00</div>
													<div class="paidImage"><img
															src="http://localhost/ci/assets/images/unpaid.png"
															alt="unpaid"/></div>
												</div>
												<div class="quantityRow3">
													<div class="qtyNumber"><span class="rupee">`</span> 25.00</div>
												</div>
												<div class="quantityRow4">
													<div class="problemWithOrderImage"></div>
													<div class="problrmWithOrderText">Problem with Order</div>
												</div>
												<div class="quantityRow5">
													<div class="communicationImage">
														<div class="communicationNumber">3</div>
													</div>
												</div>
												<div class="pdfImage">
													<div class="pdf_icon"></div>
												</div>
												<div class="feedbackImage" id="feed35">Feedback</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="slideBackground">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pickup_popup" id="pickupPopup">
			<div class="pickupPopupRelative">
				<div class="pickupPopupTransp"></div>
				<div class="pickup_mid">
					<div class="expected_header">
						<div class="expected_text">Expected Date & Time</div>
						<div class="pickup_close" id="pickup_close"></div>
					</div>
					<div class="expected_separator"></div>
					<div class="pickup_form">
						<div class="date_pickup">Date of Pick up</div>
						<div class="date_textfield">
							<div class="date_textfield_mid"><input type="text" id="ip_date"
							                                       placeholder="date/month/year"/></div>
						</div>
						<div class="clear_both">
							<div class="date_pickup">Pick up time</div>
							<div class="time_textfield">
								<div class="time_textfield_mid"><input type="text" id="ip_time"
								                                       placeholder="hour:minute"/></div>
							</div>
							<div class="amPm"><select id="timeCombo" name="time_combo">
									<option value="am">AM</option>
									<option value="pm">PM</option>
								</select></div>
						</div>
					</div>
					<div class="pickup_bottom">
						<div class="or_icon">OR</div>
						<div class="calling_text">Call</div>
						<div class="calling_icon">
							<div class="call_icon_image"></div>
							<div class="call_icon_text">+4407843555666</div>
						</div>
						<button type="button" class="proceed">Proceed</button>
					</div>
				</div>
			</div>
		</div>
		<div class="problemPopupContainer" id="problemPopupContainer">
			<div class="problemPopupRelative">
				<div class="problemPopupTransp"></div>
				<div class="problemPopupMiddle">
					<div class="headingAndClose">
						<div class="SendNoteHeading">Send a note to BnB</div>
						<div class="problemPopupClose"></div>
					</div>
					<div class="textAreaBox">
						<div class="problemTextareaMiddle"><textarea id="prob_textarea" class="problemTextareaMiddle">Please
								state your problem</textarea></div>
					</div>
					<div class="problembottom">
						<button type="button" class="send_icon">Send</button>
						<div class="or_text">or</div>
						<div class="calling_text">Call</div>
						<div class="calling_icon">
							<div class="call_icon_image"></div>
							<div class="call_icon_text">+4407843555666</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php";?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/dashboard.js"></script>
<script>
	<?php echo link_tag('assets/js/dashboard.js'); ?>
	<?php
	$tabName = $_REQUEST['tabName'];
	if($tabName <= 0 || $tabName == "")
		$tabName = 1;
	?>
	$('document').ready(function () {
		$("#tabs").tabs("select", <?php echo $tabName-1; ?>)
	});
</script>
</html>