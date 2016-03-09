<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?> <!--[if gt IE 7]>
    <link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] -->
    <!--[if IE 8]>
    <link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie8.css"/><![endif]--> </head>
<body>
<input type="hidden" value="<?php echo $base_url; ?>" id="baseurl"> <input type="hidden"
                                                                           value="<?php echo $store_info[0]->store_id; ?>"
                                                                           id="store_id">
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="bannerHolder">
				<div class="bannerLogo"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info[0]->store_id; ?>/top_banner.png"/>
				</div>
				<div class="bannerText">
					<!--<div class="bannerHeadingHolder"> <div class="bannerTextHeading">CONGRATULATIONS</div> <div class="bannerTextTop">Your store has been created.</div> </div> <div class="bannerTextHolder"> <div class="bannerShopText">Shop URL :</div> <div class="bannerURLText"><?php echo $store_info[0]->store_url; ?></div> </div> --> </div>
				<!-- <div class="bannerContentSeparator"></div>-->
				<!--<div class="yourShopImage">Your Shop is still in maintance mode</div>-->
				<!--<div class="bannerButtonsHolder"> <button type="button" class="bannerButtonImage1">Make it Live</button> <a href="javascript:void(0);"><button type="button" class="bannerButtonImage2">Change Settings</button></a> </div>-->
			</div>
		</div>
	</article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle"><a
				href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info[0]->store_id; ?>">
				<div class="dashboardLink">
					<div class="dashboardLogo"></div>
					<div class="dashboardText">Dashboard</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="productsLogo"></div>
					<div class="productsText">Products</div>
				</div>
			</a> <a href="">
				<div class="productsLink">
					<div class="designLogo"></div>
					<div class="productsText">Design</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/promote/promote_discount_summary/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="promoteLogo"></div>
					<div class="productsText">Promote</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="storeLogo"></div>
					<div class="productsText">Store Profile</div>
				</div>
			</a> <a href="<?php echo $base_url; ?>index.php/bill/allbill/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="billLogo"></div>
					<div class="productsText">Bill</div>
				</div>
			</a></div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground">
		<div class="orderStatusContainer">
			<div class="orderStatusImages"> <!--<a href="javascript:void(0);"><div class="statisticsImage"></div></a>-->
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
				<div id="tabs">
					<ul>
						<li style="display:none"><a href="#tab1">All</a></li>
						<li style="display:none"><a href="#tab2">New Order</a></li>
						<li style="display:none"><a href="#tab3">In Process</a></li>
						<li style="display:none"><a href="#tab4">Shipping</a></li>
						<li style="display:none"><a href="#tab5">Completed</a></li>
						<li style="display:none"><a href="#tab6">Canceled</a></li>
						<li style="display:none"><a href="#tab7">Problem with Order</a></li>
					</ul>
					<div id="tab1">
						<div class="orderstatus_all_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="currentlyShowingText">Currently showing <span
											id="total_0"><?php echo sizeof($products);?></span>
										/ <?php echo sizeof($products);?> Orders
									</div>
									<div class="sortbyTextHolder">
										<div class="sortbyText sortbyColor">Sort By</div>
										<div class="sortbyText" onClick="return sortStatus(0,0)">Most Recent</div>
										<div class="textSeparator"></div>
										<div class="sortbyText" onClick="return sortStatus(1,0)">Oldest</div>
										<div class="textSeparator"></div>
										<div class="sortbyText" onClick="return sortStatus(2,0)">Highest Value</div>
										<div class="textSeparator"></div>
										<div class="sortbyText" onClick="return sortStatus(3,0)">Lowest Value</div>
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
										<div class="quantityText">Total Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText shippingCostWidth">Shipping Cost</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
									<div class="quantityHolder">
										<div class="quantityText">Counts</div>
									</div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder"
								     id="parent_0"> <?php $i = 0; foreach ($products as $item): $i++; ?>
										<div class="stableGlassContainerRelative message_box"
										     style="height:auto !important" id="<?php echo $item->order_id; ?>">
											<div class="stableGlassContainerTransp"
											     id="row_transp<?php echo $i + 1; ?>"></div>
											<div class="stableGlassContainer1"
											     onMouseOver="return transp(<?php echo $i + 1; ?>)"
											     onMouseOut="return normal(<?php echo $i + 1; ?>)">
												<div class="stableGlassRelative">
													<div class="stableglassHolder">
													<a href="<?php echo $base_url;?>index.php/dashboard/order_details?tabName=1&o_id=<?php echo $item->order_id; ?>&store_id=<?php echo $store_info[0]->store_id; ?>"
															class="stableglassImage"><img
																src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_73x73.jpg"
																alt="<?php echo $item->product_name; ?>"/></a>

														<div class="stableglassText"><a
																href="<?php echo $base_url;?>index.php/dashboard/order_details?tabName=1&o_id=<?php echo $item->order_id; ?>&store_id=<?php echo $store_info[0]->store_id; ?>"
																class="stableglassHeading"><?php echo $item->product_name; ?></a>
															<!--<div class="purchaseText">
																<div class="purchaseSpan">Ordered <?php echo $item->totalOrders; ?> times</div>
															</div>
															<div class="purchaseText">
																<div class="purchaseSpan">Fancied <?php echo $item->fancy_counter; ?> times</div>
															</div> -->
															<div class="purchaseText"><font
																	color="red"> <?php if (!empty($item->variant_size)): ?> Size: <?php echo $item->variant_size; ?> <?php endif; ?> <?php if (!empty($item->variant_color)): ?> Color: <?php echo $item->variant_color; ?> <?php endif; ?> </font>
															</div>
															<div class="purchaseText">purchase date<span
																	class="purchaseSpan"><?php echo $item->date_of_order; ?></span>
															</div>
															<div class="purchaseText">Order ID<span
																	class="purchaseSpan"><?php echo $item->order_id; ?></span>
															</div>
															<div class="silverImage"></div>
														</div>
													</div>
													<div class="quantityRow1">
														<div
															class="qtyNumber paddingTOp25"><?php echo $item->quantity; ?></div>
													</div>
													<div class="quantityRow2">
														<div class="qtyNumber"><span
																class="rupee">`</span> <?php echo (int)$item->amt_paid * (int)$item->quantity; ?>
															.00/-
														</div> <?php if ($item->payment_status == '1') { ?>
															<div class="paidImage"><img
																	src="<?php echo $base_url; ?>assets/images/paid.png"
																	alt="paid"/></div> <?php } else { ?>
															<div class="paidImage"><img
																	src="<?php echo $base_url; ?>assets/images/cod.png"
																	alt="cod"/></div> <?php }?> </div>
													<div class="quantityRow3">
														<div class="qtyNumber"><span
																class="rupee">`</span> <?php echo $item->shipping_charge; ?>
														</div>
													</div> <?php if ($item->status_order == '1') { ?>
														<div class="quantityRow4">
															<div class="processingAndProblem">
																<div class="startProcessTooltip">
																	<div title="&nbsp;Start processing" class="startProcessing startProcess nexttab" onClick="return startProcessing(<?php echo $item->order_id; ?>)"></div>
<!--																	<a href="--><?php //echo $base_url . 'index.php/dashboard/generate_invoice/' . $item->order_id . '/' . $item->txnid; ?><!--">-->
<!--																		<div title="&nbsp;Start processing" class="startProcessing startProcess nexttab"></div>-->
<!--																	</a>-->
                                                                </div>

                                                                <div class="startProcessTooltip">
																	<div title="&nbsp;Start processing" class="completeOrder startProcess nexttab" onClick="return startShipping(<?php echo $item->order_id; ?>)"></div>
                                                                </div>

																<div class="processingProblemTooltip">
																	<div title="Problem with order" class="problemOrder problem_order problem_popup" onClick="return change_to_problem_inorder(<?php echo $item->order_id; ?>)"></div>
																</div>
															</div>
														</div> <?php } else if ($item->status_order == '2' || $status_order == 20) { ?>
                                                        <div class="quantityRow4" style="text-align: center;">
                                                            <div class="processingImage">
                                                                <div class="processingInnerImage"></div>
                                                                <div class="shippingTxt" style="padding-right:6px;">Processing</div>
                                                            </div>
                                                            <div class="shippingDate" style="padding-top: 0;">
                                                                pickup at&nbsp;<span class="shippingDateCont"><?php echo $item->date_of_pickup; ?></span>
                                                            </div>
                                                            <div class="startProcessTooltip" style="margin-left: 25px;margin-top: -17px;">
                                                                <div style="margin: 15px 10px;" title="Change pick up date" class="readyShipping startProcess" onClick="return changeShippingDateSS(<?php echo $item->order_id; ?>, '<?php echo date( 'd/m/Y', strtotime($item->date_of_pickup) ); ?>')"></div>
                                                            </div>
                                                            <div class="startProcessTooltip" style="margin-left: 25px;margin-top: -17px;">
                                                                <div title="Mark item shipped" class="completeOrder startProcess" onClick="return startShipping(<?php echo $item->order_id; ?>)"></div>
                                                            </div>
<!--                                                            <div class="processingProblemTooltip">-->
<!--                                                                <div title="Problem with Order" class="problemOrder problem_order problem_popup" onClick="return change_to_problem_inorder(--><?php //echo $item->order_id; ?><!--)"></div>-->
<!--                                                            </div>-->
                                                        </div> <?php } else if ($item->status_order == '3') { ?>
                                                        <div class="quantityRow4">
                                                            <div class="shippingImage" style="margin-top:4px;">
                                                                <div class="shippingInnerImage"></div>
                                                                <div class="shippingTxt">Shipped</div>
                                                            </div>
                                                            <div class="shippingDate" style="padding-top: 0;">
                                                                Fedex: 9876543210987
                                                            </div>
	                                                        <div class="orderCompletedTooltip">
		                                                        <div style="margin: 0 5px;" title="Order completed" class="completeOrder startProcess" onClick="return orderCompleted(<?php echo $item->order_id;  ?>)"></div>
	                                                        </div>
                                                            <div class="startProcessTooltip">
                                                                <div style="margin: 0 5px;" title="Change shipping details" class="readyShipping1 startProcess" onClick="return startShipping(<?php echo $item->order_id; ?>)"></div>
                                                            </div>
<!--                                                            <div class="processingProblemTooltip">-->
<!--                                                                <div style="margin: 0 5px;" title="Problem with Order" class="problemOrder problem_order problem_popup" onClick="return change_to_problem_inorder(--><?php //echo $item->order_id; ?><!--)"></div>-->
<!--                                                            </div>-->
                                                        </div> <?php } else if ($item->status_order == '4') { ?>
														<div class="quantityRow4">
															<div class="completedImage"></div>
															<div class="completedText">Completed</div>
														</div> <?php } else if ($item->status_order == '5') { ?>
														<div class="quantityRow4">
															<div class="cancelledImage"></div>
															<div class="completedText">Canceled</div>
														</div> <?php } else if ($item->status_order == '6') { ?>
														<div class="quantityRow4">
															<div class="problemWithOrderImage"></div>
															<div class="problrmWithOrderText">Problem with Order</div>
														</div> <?php }?>
													<div class="quantityRow5"><a
															href="<?php echo $base_url;?>index.php/dashboard/order_details?tabName=1&o_id=<?php echo $item->order_id; ?>&store_id=<?php echo $store_info[0]->store_id; ?>">
															<div class="communicationImage">
																<div
																	class="communicationNumber"><?php echo $item->comment_count;?></div>
															</div>
														</a></div>
													<div class="pdfImage"> <?php if($item->status_order == 2 || $item->status_order == 3 || $item->status_order == 4): ?>
														<a href="../../../invoice/<?php echo $item->txnid; ?>/shipping_label_order_<?php echo $item->order_id; ?>.pdf" target="_blank"> <?php else: ?>
														<a href="../../../invoice/<?php echo $item->txnid; ?>/buyer_invoice_order_<?php echo $item->order_id; ?>.pdf" target="_blank"> <?php endif; ?>
															<div class="pdf_icon"></div>
														</a>
													</div>
													<div class="feedbackImage" id="feed<?php echo $i + 1; ?>">Feedback
													</div>
												</div>
											</div>
										</div> <?php endforeach;?> </div>
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
									<div class="currentlyShowingText">Currently showing <span id="total_1">0</span>
										/ <?php echo sizeof($products);?> Orders
									</div>
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
										<div class="quantityText">Total Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText shippingCostWidth">Shipping Cost</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder" id="parent_1"></div>
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
									<div class="currentlyShowingText">Currently showing <span id="total_2">0</span>
										/ <?php echo sizeof($products);?> Orders
									</div>
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
										<div class="quantityText">Total Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText shippingCostWidth">Shipping Cost</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder" id="parent_2"></div>
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
									<div class="currentlyShowingText">Currently showing <span id="total_3">0</span>
										/ <?php echo sizeof($products);?> Orders
									</div>
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
										<div class="quantityText">Total Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText shippingCostWidth">Shipping Cost</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder" id="parent_3"></div>
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
									<div class="currentlyShowingText">Currently showing <span id="total_4">0</span>
										/ <?php echo sizeof($products);?> Orders
									</div>
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
										<div class="quantityText">Total Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText shippingCostWidth">Shipping Cost</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder" id="parent_4"></div>
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
									<div class="currentlyShowingText">Currently showing <span id="total_5">0</span>
										/ <?php echo sizeof($products);?> Orders
									</div>
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
										<div class="quantityText">Total Price</div>
									</div>
									<div class="quantityHolder" style="width:129px;">
										<div class="quantityText shippingCostWidth">Shipping Cost</div>
									</div>
									<div class="quantityHolder" style="width:151px;">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder" style="width:68px;"></div>
									<div class="quantityHolder" style="width:55px;border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder" id="parent_5"></div>
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
									<div class="currentlyShowingText">Currently showing <span id="total_6">0</span>
										/ <?php echo sizeof($products);?> Orders
									</div>
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
										<div class="quantityText">Total Price</div>
									</div>
									<div class="quantityHolder2">
										<div class="quantityText shippingCostWidth">Shipping Cost</div>
									</div>
									<div class="quantityHolder3">
										<div class="quantityText">Status</div>
									</div>
									<div class="quantityHolder4"></div>
									<div class="quantityHolder5" style="border-right:none;"></div>
								</div>
							</div>
							<div class="stableGlassContainerHolder">
								<div class="stableGlassContentHolder" id="parent_6"></div>
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
                            <div class="date_textfield_mid"><input type="text" id="ip_date" placeholder="dd/mm/yyyy"/>
                            </div>
                        </div>
                        <!--						<div class="clear_both">-->
                        <!--							<div class="date_pickup">Pick up time</div>-->
                        <!--							<div class="time_textfield">-->
                        <!--								<div class="time_textfield_mid"><input type="text" id="ip_time" placeholder="hh:mm"/>-->
                        <!--								</div>-->
                        <!--							</div>-->
                        <!--							<div class="amPm"><select id="timeCombo" name="time_combo">-->
                        <!--									<option value="am">AM</option>-->
                        <!--									<option value="pm">PM</option>-->
                        <!--								</select></div>-->
                        <!--						</div>-->
                    </div>
                    <div class="pickup_bottom">
                        <div class="or_icon">OR</div>
                        <div class="calling_text">Call</div>
                        <div class="calling_icon">
                            <div class="call_icon_image"></div>
                            <div class="call_icon_text">+91-8130878822</div>
                        </div>
                        <button type="button" class="proceed" id="pickupPopupProceed">Proceed</button>
                    </div>
                </div>
            </div>
        </div>

		<!-- New Modal(start shipping) -->
        <div class="pickup_popup" id="shippingPopup">
            <div class="pickupPopupRelative">
                <div class="pickupPopupTransp"></div>
                <div class="pickup_mid">

                    <div class="expected_header">
                        <div class="expected_text">Start Shipping</div>
                        <div class="pickup_close" id="shipping_close"></div>
                    </div>

                    <div class="expected_separator"></div>

                    <div class="startShipping_form pickup_form">
                        <div class="date_pickup">AWB No.</div>
                        <div class="date_textfield">
                            <div class="date_textfield_mid"><input type="text" id="awbNo" placeholder=""/>
                            </div>
                        </div>

                        <div class="date_pickup">Expected Time Of Delivery</div>
                        <div class="date_textfield">
                            <div class="date_textfield_mid"><input type="text" id="deliveryTime" placeholder="dd/mm/yyyy"/>
                            </div>
                        </div>

                        <div class="date_pickup">Courier Sevice</div>
                        <select id="courierService" name="">
                        </select>
                    </div>

                    <div class="pickup_bottom" style="overflow: hidden;">
                        <div class="or_icon">OR</div>
                        <div class="calling_text">Call</div>
                        <div class="calling_icon">
                            <div class="call_icon_image"></div>
                            <div class="call_icon_text">+91-8130878822</div>
                        </div>
                        <button type="button" class="proceed" id="shippingPopupProceed">Proceed</button>
                    </div>
                </div>
            </div>
        </div>


		<div class="problemPopupContainer" id="problemPopupContainer">
			<div class="problemPopupRelative">
				<div class="problemPopupTransp"></div>
				<div class="problemPopupMiddle">
					<div class="headingAndClose">
						<div class="SendNoteHeading">Send a note to BuynBrag</div>
						<div class="problemPopupClose"></div>
					</div>
					<div class="textAreaBox">
						<div class="problemTextareaMiddle">
                            <textarea id="prob_textarea" class="problemTextareaMiddle" placeholder="Please state your problem"></textarea>
						</div>
					</div>
					<div class="problembottom">
						<button type="button" class="send_icon" id="send_note_to_bnb">Send</button>
						<div class="or_text">or</div>
						<div class="calling_text">Call</div>
						<div class="calling_icon">
							<div class="call_icon_image"></div>
							<div class="call_icon_text">+91-8130878822</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>

<?php //include "footer.php";?>

</body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/tooltip.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/dashboard.js"></script>
</html>