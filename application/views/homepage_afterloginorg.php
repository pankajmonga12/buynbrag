<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<META HTTP-EQUIV="REFRESH" CONTENT="200000">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Home Page</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/homepage.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<body>
<section class="wrapper">
	<article class="banner">
		<div class="bannerTop">
			<div class="leftBanner" style="padding-top:34px;">
				<div class="bannerTopText" style="font-family:landing;color:#DC345C">Discover</div>
				<div class="bannerBottomText" style="font-family:landing;color:#333333">Everything from quirky home
					accents to distinctive fashion to things your friends are loving this minute. All here.
				</div>
			</div>
			<div class="rightBanner"></div>
		</div>
	</article>
	<section class="middleBackground clear_both">
		<div class="topDotSeparator"></div>
		<div class="middleContainer">
			<!-- <div class="SliderContent"> <div class="BigQuesText">Items Matching Your Taste<a href="<?php echo $base_url; ?>user_info/take_taste" class="taketest">Take Taste Test</a></div> <div class="bottomSlider"> <div class="sliderrHolder"> <div class="storeViewIcon top23"></div> <div class="scrollerContents"> <div class="button_block_left" id="scrollLeftButton1"></div> <div id="sliderParentDiv_1" class="sliderParentDiv1"> <div class="slider" id="slider3"> <div class="store-list paddingLeft0"> <?php foreach ( $similarProducts as $key => $item ): ?> <div class="store-list paddingLeft0"> <a href="<?php echo $base_url.'order/product_page/'.$item->store_id.'/'.$item->product_id ; ?>"><div class="rightPanelImageHolder1"> <img src="<?php echo $store_url.'assets/images/stores/'.$item->store_id.'/'.$item->product_id.'/img1_240x200.jpg'; ?>"> <div class="storeDecoratingText pro_name"><?php echo $item->product_name; ?></div> <div class="fl"> <div class="storeDecoratingText stor_nm font12"><?php echo $item->store_name; ?></div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price"><?php echo $item->fancy_counter; ?></div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> <?php echo intval($item->selling_price); ?></div> </div> </a> <div class="hoverHolder"> <div class="fancyHolder"> <input type="hidden" value="18" class="hiddenFieldDiv1"/> <div class="hoverFancy" id="hoverFancy18"></div> <div class="hoverText" id="hoverText18">FANCY</div> </div> <div class="PollHolder"> <div class="hoverPoll"></div> <div class="hoverText">POLL</div> </div> </div> </div> <?php endforeach ; ?> </div> </div> <div class="button_block_right" id="scrollRightButton1"></div> </div> </div> </div> </div> <div class="topDotSeparator2"></div>-->
			<div class="SliderContent">
				<div class="BigQuesText">Handpicked Items</div>
				<div class="bottomSlider">
					<div class="sliderrHolder">
						<div class="storeViewIcon top23"></div>
						<div class="scrollerContents">
							<div class="button_block_left" id="scrollLeftButton3"></div>
							<div id="sliderParentDiv_3" class="sliderParentDiv1">
								<div class="slider" id="slider1">
									<!--<div class="store-list paddingLeft0">--> <?php for ($i = 0; $i < count($fprodE); $i++): ?> <?php if ($i == 0) $class = "store-list paddingLeft0"; else $class = "store-list"; ?>
										<div class="<?php echo $class; ?>"><a
												href="<?php echo $base_url ?>order/product_page/<?php echo $fprodE[$i]->store_id . '/' . $fprodE[$i]->product_id; ?>">
												<div class="rightPanelImageHolder1"><img
														src="<?php echo $store_url . 'assets/images/stores/' . $fprodE[$i]->store_id . '/' . $fprodE[$i]->product_id . '/img1_240x200.jpg'; ?>">

													<div
														class="storeDecoratingText pro_name"><?php echo $fprodE[$i]->product_name; ?></div>
													<div class="fl">
														<!-- <div class="storeDecoratingText stor_nm font12">Copplestore</div>-->
														<div class="storeFancyHolder">
															<div class="fanciedIcon"></div>
															<div
																class="fancyNumber storeExtraStyle price"><?php echo $fprodE[$i]->fancy_counter; ?></div>
															<div class="fancyText storeExtraStyle">fancied</div>
														</div>
													</div>
													<div class="priceHolder"><span
															class="rupee">`</span> <?php echo intval($fprodE[$i]->selling_price); ?>
													</div>
												</div>
											</a>
											<!-- <div class="hoverHolder"> <div class="fancyHolder"> <input type="hidden" value="18" class="hiddenFieldDiv1"/> <div class="hoverFancy" id="hoverFancy18"></div> <div class="hoverText" id="hoverText18">FANCY</div> </div> <div class="PollHolder"> <div class="hoverPoll"></div> <div class="hoverText">POLL</div> </div> </div>-->
										</div> <?php endfor; ?> </div>
							</div>
							<div class="button_block_right" id="scrollRightButton3"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="topDotSeparator2"></div>
			<!-- <div class="SliderContent"> <div class="BigQuesText">Featured Store</div> <div class="bottomSlider"> <div class="sliderrHolder2"> <div class="storeViewIcon top23"></div> <div class="scrollerContents2"> <div class="button_block_left" id="scrollLeftButton5"></div> <div id="sliderParentDiv_5" class="sliderParentDiv2"> <div class="slider2" id="slider4"> <div class="store-list2 paddingLeft0"> <div class="whiteBackground"> <div class="firstColumn"> <div class="store_bg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_banner.png" /></a> <div class="storeTextImage">Vayacloths</div> </div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="SecondColumn"> <div class="storeText">Vayacloths</div> <div class="storeDetails">"I'd like to help prove that you don't have to sacrifice your values and squash the people around you to make it in business.I'd like to help prove that you don't have to sacrifice" </div> <div class="signatureText">by Tianna Meilinger</div> </div> <div class="ThirdColumn"> <div class="firstImageRow"> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_1.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_2.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_3.png" /></a> </div> </div> <div class="firstImageRow"> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_2.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_1.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_3.png" /></a> </div> </div> <div class="homFancy"></div> </div> </div> </div> <div class="store-list2"> <div class="whiteBackground"> <div class="firstColumn"> <div class="store_bg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_banner.png" /></a> <div class="storeTextImage">Vayacloths</div> </div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="SecondColumn"> <div class="storeText">Vayacloths</div> <div class="storeDetails">"I'd like to help prove that you don't have to sacrifice your values and squash the people around you to make it in business.I'd like to help prove that you don't have to sacrifice" </div> <div class="signatureText">by Tianna Meilinger</div> </div> <div class="ThirdColumn"> <div class="firstImageRow"> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_1.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_2.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_3.png" /></a> </div> </div> <div class="firstImageRow"> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_2.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_1.png" /></a> </div> <div class="featureImgBg"> <a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/featuredstore_3.png" /></a> </div> </div> <div class="homFancy"></div> </div> </div> </div> </div> </div> <div class="button_block_right" id="scrollRightButton5"></div> </div> </div> </div> </div> <div class="topDotSeparator2"></div> -->
			<!-- <div class="SliderContent"> <div class="BigQuesText">Recently Blog Post</div> <div class="bottomSlider"> <div class="sliderrHolder2"> <div class="storeViewIcon top23"></div> <div class="scrollerContents2"> <div class="button_block_left" id="scrollLeftButton2"></div> <div id="sliderParentDiv_2" class="sliderParentDiv2"> <div class="slider2" id="slider2"> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/blog_image_1.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/recentblog_2.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/recentblog_3.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/blog_image_1.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/recentblog_3.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/blog_image_1.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/blog_image_1.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/recentblog_3.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle price">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> </div> </div> <div class="button_block_right" id="scrollRightButton2"></div> </div> </div> </div> </div> <div class="topDotSeparator2"></div>-->
			<div class="SliderContent">
				<div class="BigQuesText">Recently Fancied Items</div>
				<div class="bottomSlider">
					<div class="sliderrHolder">
						<div class="storeViewIcon top23"></div>
						<div class="scrollerContents">
							<div class="button_block_left" id="scrollLeftButton4"></div>
							<div id="sliderParentDiv_4" class="sliderParentDiv1">
								<div class="slider"
								     id="slider5"> <?php for ($i = count($fprodU) - 1; $i >= 0; $i--): ?> <?php if ($i == count($fprodU) - 1) $class = "store-list paddingLeft0"; else $class = "store-list" ?>
										<div class="<?php echo $class; ?>"><a
												href="<?php echo $base_url ?>order/product_page/<?php echo $fprodU[$i]->store_id . '/' . $fprodU[$i]->product_id; ?>">
												<div class="rightPanelImageHolder1"><img
														src="<?php echo $store_url . 'assets/images/stores/' . $fprodU[$i]->store_id . '/' . $fprodU[$i]->product_id . '/img1_240x200.jpg'; ?>">

													<div
														class="storeDecoratingText pro_name"><?php echo $fprodU[$i]->product_name; ?></div>
													<div class="fl">
														<!-- <div class="storeDecoratingText stor_nm font12">Copplestore</div>-->
														<div class="storeFancyHolder">
															<div class="fanciedIcon"></div>
															<div
																class="fancyNumber storeExtraStyle price"><?php echo $fprodU[$i]->fancy_counter; ?></div>
															<div class="fancyText storeExtraStyle">fancied</div>
														</div>
													</div>
													<div class="priceHolder"><span
															class="rupee">`</span> <?php echo intval($fprodU[$i]->selling_price); ?>
													</div>
												</div>
											</a>

											<div class="hoverHolder">
												<div
													class="fancyHolder"> <?php if (isset($fancied_prods[$fprodU[$i]->product_id])): ?>
														<input type="hidden" value="<?php echo $i + 1; ?>"
														       class="hiddenFieldDiv1"/> <input type="hidden"
														                                        value="<?php echo $fprodU[$i]->store_id; ?>"
														                                        class="hiddenFieldStoreid"/>
														<input type="hidden"
														       value="<?php echo $fprodU[$i]->product_id; ?>"
														       class="hiddenFieldProductid"/>
														<div class="hoverFancyNext"
														     id="hoverFancy<?php echo $i + 1; ?>"></div>
														<div class="hoverText" id="hoverText<?php echo $i + 1; ?>">
															FANCIED
														</div> <?php else: ?> <input type="hidden"
												                                     value="<?php echo $i + 1; ?>"
												                                     class="hiddenFieldDiv1"/> <input
														type="hidden" value="<?php echo $fprodU[$i]->store_id; ?>"
														class="hiddenFieldStoreid"/> <input type="hidden"
												                                            value="<?php echo $fprodU[$i]->product_id; ?>"
												                                            class="hiddenFieldProductid"/>
														<div class="hoverFancy"
														     id="hoverFancy<?php echo $i + 1; ?>"></div>
														<div class="hoverText" id="hoverText<?php echo $i + 1; ?>">
															FANCY
														</div> <?php endif; ?>
												</div> <?php if (isset($poll_prods[$fprodU[$i]->product_id])) : ?>
													<div class="PollHolder">
														<div class="hoverPoll"
														     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
														<div class="hoverText">POLLED</div>
													</div> <?php else: ?>
													<div id="poll_<?php echo $fprodU[$i]->product_id; ?>"
													     class="PollHolder">
														<div class="hoverPoll"
														     onClick="return AddPoll(<?php echo $fprodU[$i]->product_id; ?>)"></div>
														<div class="hoverText">POLL</div>
													</div> <?php endif; ?> </div>
										</div> <?php endfor; ?> </div>
							</div>
							<div class="button_block_right" id="scrollRightButton4"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
<div class="fancy_popUp" id="fancyPopup">
	<div class="fancy_popUpTransp"></div>
	<div class="fancy_popUpActual">
		<div class="fancy_text">Product has been added to your poll list</div>
		<div class="button_style">
			<button type="button" class="prod_continue width_style_fancy">OK</button>
		</div>
	</div>
</div> <?php include "fancy_unfancy_fprodU.php" ?> <?php include "footer.php" ?> </body>
<script src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script>
	function AddPoll(pid) {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/add_to_poll/" + pid,
			success: function (data) {
			}

		});

		$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');

		$("#fancyPopup").dialog({
			width: 605,
			height: 293,
			modal: true
		});
		$(".width_style_fancy").click(function () {
			$("#fancyPopup").dialog('close');
		});
	}

	$(".fancyHolder").each(function () {

		var r = $(this).children(".hiddenFieldDiv1").val();
		var store_id = $(this).children(".hiddenFieldStoreid").val();
		var product_id = $(this).children(".hiddenFieldProductid").val();
		$(this).click(function () {
			if ($(this).children(".hoverText").html() == 'FANCY') {
				$("#FancyPopupContainer").dialog({
					width: 738,
					height: 510,
					modal: true
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop1?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);

						$("#f_img").attr('src', '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg');
						<?php /*?>document["f_img"].src='<?php echo $store_url; ?>assets/images/stores/'+store_id+'/'+product_id+'/img1_product.jpg';<?php */?>
						$('#popup_category').html(data);
					}
				});
				$('#checkboxesHolder1').jScrollPane({
					showArrows: false,
					animateScroll: true,
					maintainPosition: false
				});
			}
			else if ($(this).children(".hoverText").html() == 'EDIT') {
				$("#EditPopupContainer").dialog({
					width: 738,
					height: 510,
					modal: true,
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop2?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);
						$("#uf_img").attr('src', '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg');
						<?php /*?>document["uf_img"].src='<?php echo $store_url; ?>assets/images/stores/'+store_id+'/'+product_id+'/img1_product.jpg';<?php */?>
						$('#popup_category1').html(data);
					}
				});
				$('#checkboxesHolder2').jScrollPane({
					showArrows: false,
					animateScroll: true
				});

			}
			$("#addtolist").click(function () {
				$("#hoverText" + r).html("FANCIED");
				/* $("#hoverFancy"+r).removeClass('hoverFancy');
				 $("#hoverFancy"+r).addClass('hoverFancynext'); */
				//	var postdata=[];
				//   $('#checkbox input[name="checkbox5"]:checked').each(function() {
				//       postdata.push($(this).val()); //push each val into the array
				//    });
//$.ajax({
				//  url: "
				<?php echo $base_url; ?>"+'index.php/ajax/fancy_product_addlist?store_id='+store_id+'&product_id='+product_id+'&postdata='+postdata,
				//  success: function(data){
				//document.getElementById("fancy_hidden").value=2;
				//	$('#fan').html(data);
//	  }
//	});
				$("#FancyPopupContainer").dialog('close');
				//window.location.reload();
			});


			$("#unfancy").click(function () {
				$("#hoverText" + r).html("FANCY");
				/* $("#hoverFancy"+r).addClass('hoverFancy');
				 $("#hoverFancy"+r).removeClass('hoverFancynext');
				 $("#hoverFancy"+r).removeClass('editFancynext'); */
				//			$.ajax({
				//  url: "
				<?php echo $base_url; ?>"+'index.php/ajax/fancy_product_unfancy?store_id='+store_id+'&product_id='+product_id,
				//  success: function(data){
				// document.getElementById("fancy_hidden").value=1;
				//	$('#fan').html(data);
				// }
				//});
				$("#EditPopupContainer").dialog('close');
				//window.location.reload();

			});
		});
		$(this).hover(function () {

			if ($(this).children("#hoverText" + r).html() == 'FANCIED') {
				$(this).children("#hoverText" + r).html("EDIT");
				$(this).children("#hoverFancy" + r).removeClass('hoverFancynext');
				$(this).children("#hoverFancy" + r).addClass('editFancynext');
			}

		}, function () {
			if ($(this).children("#hoverText" + r).html() == 'EDIT') {
				$(this).children(".hoverText").html("FANCIED");
				$(this).children("#hoverFancy" + r).removeClass('editFancynext');
				$(this).children("#hoverFancy" + r).addClass('hoverFancynext');
			}
		});
	});
</script>
</html>