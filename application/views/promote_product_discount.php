<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Product Page</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/product_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_page.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<script type="text/javascript">
	function fancy_product_changed() {
		document.im2.src = "<?php echo $base_url; ?>assets/images/fancy_click.png";

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product?store_id=<?php echo $mystore[0]->store_id; ?>&product_id=<?php echo $productdetails[0]->product_id;?>',
			success: function (data) {
				$('#fan').html(data);
				$('#im1').html('FANCIED');
			}
		});
	}
</script>
<body> <?php for ($i = 0; $i < (count($myvar)); $i++) {
	if (($myvar[$i]->variant_name) == 'color') {
		$color[] = $myvar[$i]->variants_types;
	} else if (($myvar[$i]->variant_name) == 'size') {
		$size[] = $myvar[$i]->variants_types;
	}
} ?>
<script src="<?php echo $base_url; ?>assets/js/timer.js"
        type="text/javascript"></script> <?php //include_once($base_url."user/header"); ?>
<section class="wrapper">
	<article class="bannerBg">
		<div class="bannerField">
			<div class="store_banner"><a
					href="<?php echo $base_url; ?>order/store_page/<?php echo $mystore[0]->store_id; ?>"> <img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/top_banner.png"/>
				</a></div>
			<div class="sliderContainer">
				<div class="ProductSlider">
					<div class="button_block_left1" id="scrollLeftButton1"></div>
					<div id="sliderParentDiv_1">
						<div class="sliders"
						     id="slider1"> <?php if (count($allprodondis) > 14) $tmp = 14; else $tmp = count($allprodondis); ?> <?php for ($i = 0; $i < count($allprodondis); $i++): ?>
								<div class="image_list"><a
										href="<?php echo $base_url; ?>order/product_page/<?php echo $mystore[0]->store_id; ?>/<?php echo $allprodondis[$i]->product_id; ?>">
										<img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $allprodondis[$i]->product_id; ?>/img1_97x80.jpg"
											id="image_<?php echo $i; ?>"/> </a></div> <?php endfor; ?> </div>
						<div class="button_block_right1" id="scrollRightButton1"></div>
					</div>
				</div>
			</div>
	</article>
	<section class="middleBackground prod_middle">
		<div class="topDotSeparator clear_both"></div>
		<div class="productMiddle productMiddleExtra">
			<div class="timerContainer">
				<div class="luxurySofaSet">Luxury Sofa Set <span style="color:#e81c4d;">50% Discount</span></div>
				<div class="rightContainerGradient">
					<div class="expiresText">EXPIRES IN</div>
					<div class="timerBoxes" id="timerBoxes_1">
						<script
							type="text/javascript">StartCountDownDays("timerBoxes_1", "12/23/2012 10:00 AM -0400")</script>
					</div>
					<div class="timerBoxes" id="timerBoxes_2">
						<script
							type="text/javascript">StartCountDownHours("timerBoxes_2", "12/23/2012 10:00 AM -0400")</script>
					</div>
					<div class="timerHours">days</div>
					<div class="timerHours">hours</div>
				</div>
			</div>
			<div class="whiteBg clear_both">
				<div class="whiteLeft">
					<div class="productBigPic"><img id="big_pic"
					                                src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $productdetails[0]->product_id; ?>/img1_598x453.jpg"/>
						<!--<a href="javascript:void(0)" class="priceTag">-->
						<form
							action="<?php echo $base_url; ?>order/add_to_cart/<?php echo $productdetails[0]->product_id . '/' . $user_id . '/' . $mystore[0]->store_id;?>"
							method="post">
							<button type="submit" class="priceTag">
								<div class="priceText"><?php echo intval($productdetails[0]->selling_price); ?></div>
							</button>
						</form>
						<div class="smallImageContainer">
							<div class="smImgBg"><img class="bottom_image"
							                          src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $productdetails[0]->product_id; ?>/img1_40x40.jpg"
							                          id="img1_598x453.jpg"/>
							</div> <?php $filename = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $productdetails[0]->product_id . '/img2_40x40.jpg'; if (file_exists($filename)): ?>
								<div class="smImgBg"><img class="bottom_image"
								                          src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $productdetails[0]->product_id; ?>/img2_40x40.jpg"
								                          id="img2_598x453.jpg"/></div> <?php endif; ?> </div>
					</div>
					<div class="fancy_viewContainer">
						<div class="iconBox">
							<div class="ownitIcon"></div>
							<div class="numberText"><?php echo $productdetails[0]->brag_counter; ?></div>
							<div class="icoText">Friends Who had Fancied</div>
						</div>
						<div class="iconBox">
							<div class="fancyitIcon"></div>
							<div class="numberText" id="fan"><?php echo $productdetails[0]->fancy_counter; ?></div>
							<div class="icoText">People Fancy it</div>
						</div>
						<div class="iconBox border_right">
							<div class="viewitIcon"></div>
							<div class="numberText"><?php echo $productdetails[0]->visit_counter; ?></div>
							<div class="icoText">Viewed this Product</div>
						</div>
					</div>
				</div>
				<div class="whiteRight">
					<div class="rightHeader"> <?php if ($fancied) : ?>
							<button type="submit" class="iconWrapper" onClick="this.disabled=true">
								<div class="fancyLogo"><img name="im2"
								                            src="<?php echo $base_url; ?>assets/images/fancy_click.png"/>
								</div>
								<div class="iconText" id="im1">FANCIED</div>
							</button> <?php else : ?>
							<button type="submit" class="iconWrapper"
							        onClick="fancy_product_changed();this.disabled=true">
								<div class="fancyLogo"><img name="im2"
								                            src="<?php echo $base_url; ?>assets/images/fancy_normal.png"/>
								</div>
								<div class="iconText" id="im1">FANCY IT</div>
							</button> <?php endif;?>
						<!-- <button type="submit" class="iconWrapper"> <div class="fancyLogo"></div> <div class="iconText">FANCY IT</div> </button>-->
						<button type="submit" class="iconWrapper">
							<div class="bragLogo"></div>
							<div class="iconText">BRAG IT</div>
						</button>
						<button type="submit" class="iconWrapper border_right">
							<div class="pollLogo"></div>
							<div class="iconText">POLL IT</div>
						</button>
					</div>
					<div class="topWrapper">
						<div class="scrollPaneContainer">
							<div class="prodItemText"
							     id="prod_item"><?php echo $productdetails[0]->product_name; ?></div>
							<div class="prodHeading">DETAILS</div>
							<div class="prodAbout">
								<div><?php echo $productdetails[0]->description; ?></div>
								<!--<div class="paddingStyle"><?php //echo $productdetails[0]->description; ?>.</div>-->
							</div>
							<div class="prodHeading">QUANTITY</div>
							<div class="prodAbout"><?php echo $productdetails[0]->quantity; ?> available</div>
							<div class="prodHeading">SHIPPING</div>
							<div
								class="shipWrapper"> <?php if($productdetails[0]->quantity <= 0) { $clr = "#F33F4B"; $txt = "OUT OF STOCK"; //$button = "hidden"; } else { $clr = "GREEN"; $txt = "IN STOCK"; //$button = "visible"; } ?>
								<div class="stockIcon"
								     style="background-color:<?php echo $clr;?>;"><?php echo $txt;?></div>
								<div class="prodAbout float_left">Usually shipped
									in <?php echo $productdetails[0]->processing_time; ?> days
								</div>
							</div>
						</div>
					</div> <?php if(isset($color)): ?>
					<div class="drop_downSet">
						<div class="secondDropdown">
							<div class="drop_heading">COLOR'S</div>
							<dl id="sample" class="dropdown">
								<dt><a href="javascript:void(0)"><span><div class="color_box" id="color"
								                                            style="background-color:white;"></div><?php //echo $color[0]; ?></span></a>
								</dt>
								<dd>
									<ul> <?php for ($i = 0; $i < (count($color)); $i++): ?>
											<li class="choosecolor"><a href="javascript:void(0)">
													<div class="color_box" id="color<?php echo $i; ?>"
													     style="background-color:<?php echo $color[$i]; ?>;"></div> <?php echo $color[$i]; ?>
													<span class="value"><?php echo $color[$i]; ?></span> </a>
											</li> <?php endfor; ?> </ul>
								</dd>
							</dl>
						</div> <?php endif; ?> <?php if(isset($size)): ?>
						<div class="firstDropdown">
							<div class="drop_heading">SIZE'S</div>
							<select id="sizes"> <?php for ($i = 0; $i < (count($size)); $i++): ?>
									<option selected="selected"><?php echo $size[$i];?></option> <?php endfor; ?>
							</select></div>
					</div> <?php endif; ?>
					<div class="bottomWrapper">
						<div class="badge1"></div>
						<div class="badge2"></div>
						<!--<form action = "<?php echo $base_url; ?>order/add_to_cart/<?php echo $productdetails[0]->product_id.'/'.$user_id.'/'.$mystore[0]->store_id;?>" method="post" > <button type="submit" class="addCart"> <div class="addCartImage"></div> <div class="addCartText">Add to Cart</div> </button> </form>-->
					</div>
				</div>
			</div>
			<div class="secondContainer">
				<div class="commentsContainer">
					<div class="commentHeading">
						<div class="commentText">Comments</div>
						<a href="javascript:void(0)" class="FriendsText">Friends</a>

						<div class="friendCircle">13</div>
						<a href="javascript:void(0)" class="AllText">All</a>

						<div class="allCircle">73</div>
					</div>
					<div class="showingText">showing 3/13</div>
					<div class="commentHolder">
						<div class="commentRow"><a href="javascript:void(0)" class="pro_pic"> <img
									src="<?php echo $base_url; ?>assets/images/david_image.png" alt="profile picture"/>
							</a> <a href="javascript:void(0)" class="pro_name">David</a>

							<div class="comment">We like to keep it casual out here in California, and what’s more
								casual than your very own chalkboard?
							</div>
						</div>
						<div class="commentRow"><a href="javascript:void(0)" class="pro_pic"> <img
									src="<?php echo $base_url; ?>assets/images/david_image_2.png"
									alt="profile picture"/> </a> <a href="javascript:void(0)" class="pro_name">David</a>

							<div class="comment">We like to keep it casual out here in California, and what’s more
								casual than your very own chalkboard? It makes a proud statement all on its own, and
								looks extra “California” once you fill it with your farmers market
							</div>
						</div>
						<div class="commentRow"><a href="javascript:void(0)" class="pro_pic"> <img
									src="<?php echo $base_url; ?>assets/images/david_image.png" alt="profile picture"/>
							</a> <a href="javascript:void(0)" class="pro_name">David</a>

							<div class="comment">We like to keep it casual out here in California, and what’s more
								casual than your very own chalkboard?
							</div>
						</div>
						<div class="commentRow"><a href="javascript:void(0)" class="pro_pic"> <img
									src="<?php echo $base_url; ?>assets/images/david_image.png" alt="profile picture"/>
							</a> <a href="javascript:void(0)" class="pro_name">David</a>

							<div class="comment">We like to keep it casual out here in California, and what’s more
								casual than your very own chalkboard?
							</div>
						</div>
					</div>
					<div class="PostHolder"><textarea id="comment_post"
					                                  placeholder="comment! tell what do you think about this product"></textarea>
						<button type="submit" class="post_button">Post</button>
						<div class="post_icon"></div>
					</div>
				</div>
				<div class="commentSep"></div>
				<div class="questionRight">
					<div class="BigQuesText">Hava a Question?</div>
					<div class="ques">
						<div class="ques_icon1"></div>
						<a href="javascript:void(0)" class="quest_text">Contact Shop Owner</a></div>
					<div class="ques">
						<div class="ques_icon2"></div>
						<a href="javascript:void(0)" class="quest_text">View Shop Policies</a></div>
					<div class="ques">
						<div class="ques_icon3"></div>
						<a href="javascript:void(0)" class="quest_text">Request Custom Item</a></div>
					<div class="ques" id="requestPopup">
						<div class="ques_icon4"></div>
						<a href="javascript:void(0)" class="quest_text">Report this Item to BnB</a></div>
				</div>
			</div>
		</div>
		<div class="bottomBg">
			<div class="topDotSeparator clear_both"></div>
			<div class="bottomContent">
				<div class="BigQuesText">You may also be interested in</div>
				<div class="bottomSlider">
					<div class="sliderrHolder">
						<div class="storeViewIcon" style="top:-23px;"></div>
						<div class="scrollerContents4">
							<div class="button_block_left2" id="scrollLeftButton6"></div>
							<div id="sliderParentDiv_6" class="sliderParentDiv4">
								<div class="slider4"
								     id="slider6"> <?php for ($i = 0; $i < count($allprodondis); $i++): ?> <?php if ($i == 0) {
										$class = "store-list paddingLeft0";
									} else {
										$class = "store-list";
									} ?>
										<div class="<?php echo $class; ?>">
											<div class="rightPanelImageHolder1"><a
													href="<?php echo $base_url?>order/product_page/<?php echo $mystore[0]->store_id; ?>/<?php echo $allprodondis[$i]->product_id; ?>">
													<img
														src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $allprodondis[$i]->product_id; ?>/img1_240x200.jpg"/>
												</a>

												<div class="fl">
													<div
														class="storeDecoratingText"><?php echo str_pad(substr($allprodondis[$i]->product_name, 0, 17), 18, '.'); ?></div>
													<div
														class="storeDecoratingText font12"><?php echo $mystore[0]->store_name; ?></div>
													<div class="storeFancyHolder">
														<div class="fanciedIcon"></div>
														<div
															class="fancyNumber storeExtraStyle"><?php echo $allprodondis[$i]->fancy_counter; ?></div>
														<div class="fancyText storeExtraStyle">fancied</div>
													</div>
												</div>
												<div class="priceHolder"><span
														class="rupee">`</span> <?php echo intval($allprodondis[$i]->selling_price); ?>
												</div>
											</div>
										</div> <?php endfor; ?> </div>
							</div>
							<div class="button_block_right2" id="scrollRightButton6"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="prod_popUp" id="prodPopup">
			<div class="prod_popUpTransp"></div>
			<div class="prod_popUpActual">
				<div class="request_header">
					<div class="request_text">REQUEST CUSTOM ITEM</div>
					<div id="pickup_close" class="pickup_close"></div>
				</div>
				<div class="productContent">
					<div class="firstLeft">
						<div class="productBg"><img src="<?php echo $base_url; ?>assets/images/popup_ico.png"
						                            alt="popup icon"/></div>
						<div class="productName">YSL Lace Shoes</div>
					</div>
					<div class="wideSeperator"></div>
					<div class="secondLeft">
						<div class="textAreaHolder1">
							<div class="textareaBackground1"></div>
							<textarea class="textarea_class1" placeholder="enter message"></textarea></div>
						<button type="button" class="prod_continue width_style1">Send</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script>
	$(function () {
		//Image thumbnail to bigsize
		$(".bottom_image").each(function () {
			$(this).click(function () {
				var imgId = $(this).attr('id');
				$("#big_pic").attr({src: "<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $productdetails[0]->product_id; ?>/" + imgId});
			});
		});


		$(".color_box").each(function () {

			$(this).mouseover(function () {
				var colorId = $(this).attr('id');

				$("#" + colorId).closest(".choosecolor").click(function () {
					$("#big_pic").attr({src: "images/product_bigImage/s_" + imgId + ".png"});
				});
			});
		});


	});
</script>
<script src="<?php echo $base_url; ?>assets/js/product_page.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_unfancy.js"></script>
<script type="text/javascript">
	var totalScroll = 0;

	$("#scrollLeftButton1").click(function () {
		if (totalScroll <= 0) return;
		totalScroll = totalScroll - 733;
		$('#sliderParentDiv_1').animate({scrollLeft: totalScroll}, 1500);
	});

	$("#scrollRightButton1").click(function () {
		var x =<?php echo ceil(count($allprodondis)/7); ?>;
		if (x == 1) {
		} else {
			maxScroll = parseInt($(".sliders").css("width")) - parseInt($("#sliderParentDiv_1").width());
			if (totalScroll > maxScroll) return;
			totalScroll = totalScroll + 733;
			$('#sliderParentDiv_1').animate({scrollLeft: totalScroll}, 1500);
			var totalWidth = x * 733;
			$("#slider1").css("width", totalWidth + "px");
		}
	});

	var totalScroll6 = 0;

	$("#scrollLeftButton6").click(function () {
		if (totalScroll6 <= 0) return;
		totalScroll6 = totalScroll6 - 1025;
		$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
	});

	$("#scrollRightButton6").click(function () {
		var x2 =<?php echo ceil(count($allprodondis)/4); ?>;
		if (x2 == 1) {
		} else {
			maxScroll = parseInt($(".slider4").css("width")) - parseInt($("#sliderParentDiv_6").width());
			if (totalScroll6 > maxScroll) return;
			totalScroll6 = totalScroll6 + 1025;
			$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
			var totalWidth2 = x2 * 1025;
			$("#slider6").css("width", totalWidth2 + "px");
		}
	});
</script>
</html>