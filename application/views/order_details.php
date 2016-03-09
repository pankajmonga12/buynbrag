<?php $epoch_1 = time(); ?> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?> <!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->
	<style>
		.productsLogo {
			background-image: url("<?php echo $base_url; ?>assets/images/products_normal.png") !important;
		}
	</style>
</head>
<body><input type="hidden" value="<?=$base_url; ?>"
             id="baseurl"> <?php $o_id = $_REQUEST['o_id']; $tabName = $_REQUEST['tabName']; ?> <?php //include_once('header.php'); ?>
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="bannerHolder">
				<div class="bannerLogo"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info[0]->store_id; ?>/top_banner.png"/>
				</div>
				<!--<div class="bannerText"> <div class="bannerHeadingHolder"> <div class="bannerTextHeading">CONGRATULATIONS</div> <div class="bannerTextTop">Your store has been created.</div> </div> <div class="bannerTextHolder"> <div class="bannerShopText">Shop URL :</div> <div class="bannerURLText"><?php echo $store_info[0]->store_url; ?></div> </div> </div> <div class="bannerContentSeparator"></div> <div class="yourShopImage">Your Shop is still in maintance mode</div> <div class="bannerButtonsHolder"> <button class="bannerButtonImage1">Make it Live</button> <a href="javascript:void(0);"><button class="bannerButtonImage2">Change Settings</button></a> </div>-->
			</div>
		</div>
	</article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle"><a
				href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info[0]->store_id; ?>">
				<div class="dashboardLink">
					<div class="dashboardLogoSelected"></div>
					<div class="dashboardTextActive">Dashboard</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="productsLogo"></div>
					<div class="productsText">Products</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>/index.php/dashboard/banner_design/<?php echo $store_info[0]->store_id; ?>">
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
				<div class="orderDetailsParent">
					<ul>
						<li id="liTab1"><a
								href="order_status/<?php echo $store_info[0]->store_id; ?>/?tabName=1">All</a></li>
						<li id="liTab2"><a href="order_status/<?php echo $store_info[0]->store_id; ?>/?tabName=2">New
								Order</a></li>
						<li id="liTab3"><a href="order_status/<?php echo $store_info[0]->store_id; ?>/?tabName=3">In
								Process</a></li>
						<li id="liTab4"><a href="order_status/<?php echo $store_info[0]->store_id; ?>/?tabName=4">Shipping</a>
						</li>
						<li id="liTab5"><a href="order_status/<?php echo $store_info[0]->store_id; ?>/?tabName=5">Completed</a>
						</li>
						<li id="liTab6"><a href="order_status/<?php echo $store_info[0]->store_id; ?>/?tabName=6">Canceled</a>
						</li>
						<li id="liTab7"><a href="order_status/<?php echo $store_info[0]->store_id; ?>/?tabName=7">Problem
								with Order</a></li>
					</ul>
					<div>
						<div class="orderdetails_hidden">
							<div class="sortByContainer">
								<div class="sortByContainerTransparent"></div>
								<div class="sortByContent">
									<div class="orderdetails_text"> Order details</div>
									<a href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info[0]->store_id; ?>/<?php echo "?tabName=" . $tabName?>"
									   class="back_button">Back to order list</a></div>
							</div>
							<div class="detailsContainerRelative">
								<div class="detailsContainerTransparent"></div>
								<div class="details_container">
									<div class="first_left">
										<div
											class="stableglass_border"> <?php /*?> <?php if($order_id[0]->image1_path =='') { ?> <img src="<?php echo $base_url; ?>assets/images/staableglass_image_171x171pixel.png" alt="<?php echo $order_id[0]->product_name; ?>" /> <?php } else { ?><?php */?>
											<img
												src="<?php echo $store_url; ?>assets/images/stores/<?php echo $order_id[0]->store_id;?>/<?php echo $order_id[0]->product_id;?>/img1_171x171.jpg"
												alt="<?php echo $order_id[0]->product_name; ?>"/> <?php /*?><?php }?><?php */?>
										</div> <?php if ($order_id[0]->status_order == '2') { ?>
											<div class="processingImage" style="width: 165px;padding: 3px 0;margin-top: 4px;">
												<div class="shipping_icon"></div>
												<div class="shipping_text">Processing</div>
											</div> <?php } else if ($order_id[0]->status_order == '3') { ?>
											<div class="shipping_button">
												<div class="shipping_icon"></div>
												<div class="shipping_text">Shipping</div>
											</div> <?php } else {
										} ?> </div>
									<div class="second_left">
										<div class="stableglass_details">
											<div
												class="stableglass_text"><?php echo $order_id[0]->product_name; ?></div>
											<div class="label_italic removePadding"><font
													color="red"><?php if (!empty($order_id[0]->variant_size)): ?> Size: <?php echo $order_id[0]->variant_size; ?> <?php endif; ?> <?php if (!empty($order_id[0]->variant_color)): ?> Color: <?php echo $order_id[0]->variant_color; ?> <?php endif; ?></font>
											</div>
											<div class="label_italic removePadding">purchase date<span
													class="label_details"><?php echo $order_id[0]->date_of_order; ?></span>
											</div>
											<!-- <div class="label_italic removePadding">store<span class="label_details"><?php //echo $s_id[0]->store_name; ?></span></div>-->
											<!--<div class="label_italic" style="float:left; padding-top:10px;">Payment</div>--> <?php if ($order_id[0]->status_order == '1') { ?>
<!--												<a href="--><?php //echo $base_url . 'index.php/dashboard/generate_invoice/' . $order_id[0]->order_id . '/' . $order_id[0]->txnid; ?><!--">-->
													<div title="&nbsp;Start processing" class="startProcessing startProcess startprocessing_icon" onClick="return startProcessing(<?php echo $order_id[0]->order_id; ?>)"></div>
<!--													<div title="&nbsp;Start processing" class="startProcessing startProcess startprocessing_icon"></div>-->
<!--												</a>-->
												<div title="Problem with Order"
												     class="problemOrder problem_order problemwithorder_icon"
												     onClick="return change_to_problem_inorder(<?php echo $order_id[0]->order_id; ?>)"></div> <?php }
                                            else if ($order_id[0]->status_order == '2') { ?>
												<div class="startProcessTooltip">
													<div title="Mark item shipped" class="readyShipping1 startProcess" onClick="return startShipping(<?php echo $order_id[0]->order_id; ?>)"></div>
												</div>
                                                <div class="startProcessTooltip">
                                                    <div title="Change pick up date" class="readyShipping startProcess" onClick="return changeShippingDateSS(<?php echo $order_id[0]->order_id; ?>, '<?php echo date( 'd/m/Y', strtotime($order_id[0]->date_of_pickup) ); ?>')"></div>
                                                </div>
<!--												<div class="processingProblemTooltip">-->
<!--													<div title="Problem with Order" class="problemOrder problem_order problem_popup" onClick="return change_to_problem_inorder(--><?php //echo $order_id[0]->order_id; ?><!--)"></div>-->
<!--												</div>-->
                                            <?php } else if ($order_id[0]->status_order == '3') { ?>
                                            <div class="quantityRow4">
                                                <div class="shippingImage" style="margin-top:4px;">
                                                    <div class="shippingInnerImage"></div>
                                                    <div class="shippingTxt">Shipping</div>
                                                </div>
                                                <div class="shippingDate" style="padding-top: 0;">
                                                    <span class="shippingSpan">&nbsp;at</span>
                                                    <?php echo $order_id[0]->date_of_pickup; ?> &nbsp;&nbsp; <?php echo $order_id[0]->time_of_pickup; ?>
                                                </div>
	                                            <div class="orderCompletedTooltip">
		                                            <div style="margin: 0 5px;" title="Order completed" class="completeOrder startProcess" onClick="return orderCompleted(<?php echo $order_id[0]->order_id; ?>)"></div>
	                                            </div>
	                                            <div class="startProcessTooltip">
                                                    <div style="margin: 0 5px;" title="Change shipping details" class="readyShipping1 startProcess" onClick="return startShipping(<?php echo $order_id[0]->order_id; ?>)"></div>
	                                            </div>
<!--	                                            <div class="processingProblemTooltip">-->
<!--		                                            <div style="margin: 0 5px;" title="Problem with Order" class="problemOrder problem_order problem_popup" onClick="return change_to_problem_inorder(--><?php //echo $item->order_id; ?><!--)"></div>-->
<!--	                                            </div>-->
                                            </div>  <?php } else if ($order_id[0]->status_order == '4') { ?>
	                                            <div class="quantityRow4">
		                                            <div class="completedImage"></div>
		                                            <div class="completedText">Completed</div>
	                                            </div> <?php } else if ($order_id[0]->status_order == '5') { ?>
	                                            <div class="quantityRow4">
		                                            <div class="cancelledImage"></div>
		                                            <div class="completedText">Canceled</div>
	                                            </div> <?php } else if ($order_id[0]->status_order == '6') { ?>
	                                            <div class="quantityRow4">
		                                            <div class="problemWithOrderImage"></div>
		                                            <div class="problrmWithOrderText">Problem with Order</div>
	                                            </div> <?php }?>

											<div class="receipt_text removePadding">Invoice
												No: <?php if($order_id[0]->status_order == 2 || $order_id[0]->status_order == 3 || $order_id[0]->status_order == 4): ?>
												<a style="text-decoration:none; color:green;"
												   href="../../invoice/<?php echo $order_id[0]->txnid; ?>/shipping_label_order_<?php echo $order_id[0]->order_id; ?>.pdf"
												   target="_blank"><strong><?php echo $order_id[0]->invoice_no; ?> </strong></a>
											</div> <?php else: ?> <a style="text-decoration:none; color:green;"
											                         href="../../invoice/<?php echo $order_id[0]->txnid; ?>/buyer_invoice_order_<?php echo $order_id[0]->order_id; ?>.pdf"
											                         target="_blank"><strong><?php echo $order_id[0]->invoice_no; ?> </strong></a>
										</div> <?php endif; ?> </div>
								</div>
								<div class="vertical_separator" style="height:210px;margin-top:12px;"></div>
								<div class="third_left">
									<div class="third_top">
										<div class="top_box" style="padding-top:12px;">
											<div class="top_text top_box1 "
											     style="margin-top:-1px;"><?php echo $order_id[0]->quantity; ?></div>
											<div class="label_italic top_box1">Quantity</div>
										</div>
										<div class="vertical_separator custom_sep"></div>
										<div class="top_box" style="padding-top:12px;">
											<div
												class="top_text top_box2"><?php echo (int)($order_id[0]->discount / $order_id[0]->selling_price * 100); ?>
												%
											</div>
											<div class="label_italic top_box2">discount</div>
										</div>
										<div class="vertical_separator custom_sep"></div>
										<div class="top_box" style="padding-top:12px;">
											<div class="top_text"><span
													class="rupee">`</span> <?php echo (int)$order_id[0]->shipping_charge; ?>
											</div>
											<div class="label_italic2">shipping cost</div>
										</div>
										<div class="vertical_separator custom_sep"></div>
										<div class="top_box">
											<div class="top_text" style="color:#da3c63;"><span
													class="rupee">`</span> <?php echo (int)$order_id[0]->amt_paid * (int)$order_id[0]->quantity; ?>
												.00/-<?php if ($order_id[0]->payment_status == '1') { ?> <img
													height="35" src="<?php echo $base_url; ?>assets/images/paid.png"
													alt="paid"/> <?php } else { ?> <img height="35"
												                                        src="<?php echo $base_url; ?>assets/images/cod.png"
												                                        alt="cod"/> <?php }?></div>
											<div class="label_italic2">total price</div>
										</div>
									</div>
									<div class="horizontal_separator" style="width:580px;"></div>
									<div class="third_bottom">
										<div class="bottom_box" style="width: auto;margin-right: 10px">
											<div class="bottom_text">Buyer</div>
											<?php
											$userImageSrc = (strcmp($user_details[0]->fb_uid, "non-fb-member") === 0)? "/assets/images/default/".((strcmp($user_details[0]->gender, "female") === 0)? "female": "male").".png": "https://graph.facebook.com/".$user_details[0]->fb_uid."/picture?width=200&height=200";
											?>
											<div class="pavan_bg" style="margin-top: 5px;"><img height="43" src="<?php echo $userImageSrc; ?>" style="margin:3px"/></div>
											<div class="name_text" style="clear: both;padding-left: 0;"><?php echo $user_details[0]->full_name; ?>
												<!--<div class="siverbadge"></div>--> </div>
										</div>
										<div class="vertical_separator" style="height:112px; margin-top:10px;"></div>
										<div class="bottom_box">
											<div class="bottom_text">Shipping Address</div>
											<div class="add_text">
												<div><?php echo $order_id[0]->shipping_address; ?></div>
												<div><?php echo $order_id[0]->shipping_city; ?>
													,<br><?php echo $order_id[0]->shipping_state; ?>
													,<br><?php echo $order_id[0]->shipping_country; ?>
													-<?php echo $order_id[0]->shipping_pincode; ?>
                                                </div>
											</div>
											<!--<div class="label_italic clear_both">Contact<span class="label_details" style="padding-left:50px;"><?php echo $order_id[0]->shipping_phoneno; ?></span></div> <div class="label_italic">Email<span class="label_details" style="padding-left:65px;"><?php echo $order_id[0]->shipping_emailid; ?>--></span>
										</div>
									</div>
								</div>
							</div>
							<div class="feedbackImage" style="display:block;">Feedback</div>
						</div>
					</div>
					<!--
					<div class="communicationHolderRelative">
						<div class="communicationHolderTransparent">
							<div class="communicationAbsolute">
								<div class="communicationRelative">
									<div class="comm_icon"></div>
									<div class="comm_text">Communication</div>
								</div>
								<div id="parent_comment">
									<?php
									// $i=0;
									// foreach ($user_details_comment as $comDetails):
									// $i++;
									?>
									<div class="pupplestoredivRelative">
										<div class="icon_bg"></div>
										<div class="img_details">
											<?php
												// $arr=get_time_difference($comDetails->comments_time);
											?>
											<div class="names">
												<?php
													// echo $comDetails->full_name;
												?>
												<span class="timing">
													<?php
														echo $arr['days']."days";
														echo $arr['hours']."Hours";
														echo $arr['minutes']."Minutes";
														echo $arr['seconds']."Seconds";
													?>
												</span>
											</div>
											<div class="img_about">
												<div>
													<?php
													// echo $comDetails->comments;
													?>
												</div>
											</div>
										</div>
										<div class="floatright">
											<div class="vertical_separator" style="height:77px;"></div>
											<div class="pupplestore_icon"></div>
											<div class="vertical_separator" style="height:77px;"></div>
											<div class="pupplestore_close"></div>
										</div>
									</div>
									<?php
										// endforeach;
									?>
								</div>
								<div class="pupplestoredivRelative">
									<div class="search_text">
										<div class="search_text_mid">
											<input type="text" name="search" id="comment_input"/>
										</div>
									</div>
									<div class="searching_icon" onClick="giveComments(<?php /* echo $o_id; */?>)"></div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		</div> </div> </section>
</section>
<?php //include "footer.php" ?>
<?php function get_time_difference($time)
{
	$uts['start'] = strtotime($time);
	$uts['end'] = strtotime(date("Y-m-d G:i:s", time()));
	if ($uts['start'] !== -1 && $uts['end'] !== -1) {
		if ($uts['end'] >= $uts['start']) {
			$diff = $uts['end'] - $uts['start'];
			if ($days = intval((floor($diff / 86400)))) $diff = $diff % 86400;
			if ($hours = intval((floor($diff / 3600)))) $diff = $diff % 3600;
			if ($minutes = intval((floor($diff / 60)))) $diff = $diff % 60;
			$diff = intval($diff);
			return (array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $diff));
		} else {
			trigger_error("Ending date/time is earlier than the start date/time", E_USER_WARNING);
		}
	} else {
		trigger_error("Invalid date/time data detected", E_USER_WARNING);
	}
	return (false);
} ?>
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

                <div class="date_pickup">DTS</div>
                <div class="date_textfield">
                    <div class="date_textfield_mid"><input type="text" id="deliveryTime" placeholder="dd/mm/yyyy"/>
                    </div>
                </div>

                <div class="date_pickup">Courier Sevice</div>
                <select id="courierService" name="">
                    <option value="BlueDart">BlueDart</option>
                    <option value="Gati">Gati</option>
                    <option value="Fedex">Fedex</option>
                    <option value="Aramex">Aramex</option>
                    <option value="First Flight">First Flight</option>
                    <option value="DTDC">DTDC</option>
                    <option value="Overnight">Overnight</option>
                    <option value="Trackor">Trackor</option>
                    <option value="DHL">DHL</option>
                    <option value="TNT">TNT</option>
                    <option value="IndiaPost">IndiaPost</option>
                    <option value="Blazeflash">Blazeflash</option>
                    <option value="UPS">UPS</option>
                    <option value="Red Express">Red Express</option>
                    <option value="Cargo Nation">Cargo Nation</option>
                    <option value="Other">Other</option>
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
</body>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/order_details.js"></script>
<script>
	$(function () {
		var o_id = '+<?php echo $o_id; ?>+';
		$("#liTab<?php echo $tabName; ?>").addClass('active_tab');
	});
</script>
</html>