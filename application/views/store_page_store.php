<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $mystore[0]->store_name; ?></title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_page.css"/>
	<style type="text/css">
		.soldout {
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
</head>
<script type="text/javascript">
	function bragStore() {
		var params = {};
		params['message'] = "<?php echo $userdetails[0]->full_name; ?> has acquired bragging rights for <?php echo $mystore[0]->store_name; ?> !! After all, brag is the new love! :)";
		params['name'] = 'BuynBrag.com';
		params['description'] = 'You can also acquire bragging rights for this store by logging on to www.buynbrag.com';
		params['link'] = "http://www.buynbrag.com/";
		params['picture'] = '<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/storepage_banner.jpg';
		params['caption'] = 'is your destination for everything hard-to-find';

		FB.api('/me/feed', 'post', params, function (response) {
			//if (!response || response.error) {
			//} else {

			$.ajax({
				url: "<?php echo $base_url; ?>" + 'brag_ajax/store_brag?store_id=<?php echo $mystore[0]->store_id; ?>',
				success: function (data) {
					$('#brag_count').html(data);
					$('#brag').html('BRAGGED');
					$("#brag_logo").attr('src', '<?php echo $base_url; ?>assets/images/brag_click.png');
				}
			});
			//}
		});
	}
</script>
<body> <!-- Added by lee for fb share post. Should be just below Body tag. -->

<section class="wrapper">
	<div class="banner">
		<div class="slide">
			<div class="topBanerPatternContainer"></div>
			<div class="topBannerContainer">
				<div align="center" class="bannerImageHolder"><a
						href="<?php echo $base_url; ?>order/store_page/<?php echo $mystore[0]->store_id; ?>"> <img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/storepage_banner.jpg"/>
					</a></div>
				<div class="fancyBragContainer">
					<div class="fancyBragHolder"> <?php if ($fancied) : ?>
							<button type="submit" class="fancyHolderStore" onClick="unfancy_store();"><img name="im2" src="<?php echo $base_url; ?>assets/images/fancy_click.png"/>

								<div class="fancText" id="imuf">FANCIED</div>
							</button> <?php else : ?>
							<button type="submit" class="fancyHolderStore" onClick="fancy_store_changed();"><img
									name="im2" src="<?php echo $base_url; ?>assets/images/fancy_normal.png"/>

								<div class="fancText" id="im1">FANCY IT</div>
							</button> <?php endif;?> <?php if ($bragged) : ?>
							<button type="submit" class="bragHolder" onClick="this.disabled=1;"><img class="bragLogo"
							                                                                         src="<?php echo $base_url; ?>assets/images/brag_click.png">

								<div class="fancText" id="brag">BRAGGED</div>
							</button> <?php else: ?>
							<button type="submit" class="bragHolder" onClick="bragStore();this.disabled=1;"><img class="bragLogo" id="brag_logo" src="<?php echo $base_url; ?>assets/images/braged_icon.png">

								<div class="fancText" id="brag">BRAG IT</div>
							</button> <?php endif; ?> </div>
				</div>
				<div class="bannerDescriptionText" id="banner"> <?php /*echo $mystore[0]->about_store;*/ ?> </div>
				<div id="hide" style="display:none"></div>
				<div class="bannerBadgesContainer">
					<div class="bannerBadgesHolder">
						<div class="badgesText">Policy</div> <?php if ($mystore[0]->COD_policy == 1): ?>
							<div class="gold_badge showtooltip" title="COD"><img
									src="<?php echo $base_url; ?>assets/images/badges/stores/cod.png" alt="cod badge"/>
							</div> <?php endif; ?> <?php if ($mystore[0]->EMI_policy == 1): ?>
							<div class="platinum_badge showtooltip" title="EMI"><img
									src="<?php echo $base_url; ?>assets/images/badges/stores/emi.png" alt="emi badge"/>
							</div> <?php endif; ?> <?php if ($mystore[0]->return_policy == 0): ?>
							<div class="noreturn_badge showtooltip" title="No Return"><img
									src="<?php echo $base_url; ?>assets/images/badges/stores/noreturn.png"
									alt="return badge"/></div> <?php else : ?>
							<div class="happyreturn_badge showtooltip" title="Happy Return"><img
									src="<?php echo $base_url; ?>assets/images/badges/stores/happyreturn.png"
									alt="return badge"/></div> <?php endif; ?> </div>
					<div class="bannerRightIcons">
						<div class="badgesText so_far_text">SO FAR</div>
						<div class="fancHolder">
							<div class="fancyIcon"></div>
							<div class="fancyTextHolder">
								<div class="fancyNumber" id="fan"><?php echo $mystore[0]->fancy_counter; ?></div>
								<div class="fancyText">fancied</div>
							</div>
						</div>
						<div class="fancHolder">
							<div class="bragedIcon"></div>
							<div class="fancyTextHolder fancy_style">
								<div class="fancyNumber" id="brag_count"><?php echo $mystore[0]->brag_counter; ?></div>
								<div class="fancyText">bragged</div>
							</div>
						</div>
						<div class="fancHolder">
							<div class="viewedIcon"></div>
							<div class="fancyTextHolder newfancyTextHolder2">
								<div class="fancyNumber"><?php echo $mystore[0]->visit_counter; ?></div>
								<div class="fancyText">viewed</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="middleBackground middlebackground_height">
		<div class="middleBackgroundStoreIE">
			<div class="topDotSeparator"></div>
			<div class="storeMiddleBackgroundContainer autoStyle">
				<div class="panelsContainer">
					<div class="leftPanel leftPanelHeight">
						<div class="storeSectionText">Store Section</div>
						<div class="shopHomeText" id="category_0"
						     onClick="showAjaxContents(0 ,<?php echo $mystore[0]->store_id; ?>, 0)">Shop Home
						</div>
						<div class="hiddenCategories" id="hidden_0">Shop Home
							<div class="hiddenTriangle"></div>
						</div> <?php for ($i = 0; $i < (count($mysec)); $i++): ?>
							<div class="shopHomeText" id="category_<?php echo $i + 1 ?>"
							     onClick="showAjaxContents(<?php echo $i + 1 ?> , <?php echo $mystore[0]->store_id; ?>, <?php echo $mysec[$i]->storesection_id; ?>)"> <?php echo ucwords(strtolower($mysec[$i]->name)); ?> </div>
							<div class="hiddenCategories"
							     id="hidden_<?php echo $i + 1 ?>"> <?php echo $mysec[$i]->name ?>
								<div class="hiddenTriangle"></div>
							</div> <?php endfor; ?>
						<!-- <div class="ShopOwnerTextImage"> <div class="storeShopOwnerText">Store Owner</div> <div class="sideArrowIcon"></div> </div> <div class="storeProfileImageContainer"> <div class="storeProfileImage"> <?php $filename = "assets/images/stores/".$mystore[0]->store_id."/owner/owner_40x40.jpg"; if (file_exists($filename)):?> <a href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>"> <img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/owner/owner_40x40.jpg" /> </a> <?php else: ?> <a href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>"> <img src="<?php echo $base_url; ?>assets/images/default/defsmall.jpg" alt="profile_pic"/> </a> <?php endif; ?> </div> <div class="storeLeahTextHolder"> <a class="storeLeahText" href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>"><?php echo $mystore[0]->owner_name; ?></a> <div class="newYorkText"><?php echo $mystore[0]->owner_city.','.$mystore[0]->owner_state; ?></div> </div> </div> <a href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>"><div class="storeContactText clear_both">Profile</div> <div class="storeContactText clear_both">Policies</div></a> <!-- <a href="javascript:void(0)"><div class="storeContactText request_bottom" id="feedbackPopupStore">Feedback</div></a>-->
						<!-- <div class="storeShopRankingText">Shop Ranking <span style="color:#f03562;">46</span></div>-->
					</div>
					<div class="panelSeparator panelPadding"></div>
					<div
						class="rightPanel widthStyle"> <?php for ($i = 0; $i < count($products); $i++): ?> <?php if (($i % 3) == 0) {
							$class = "store-list paddingLeft0";
							$class2 = "soldout";
							$class3 = "discountContainer rightStyle";
						} else {
							$class = "store-list";
							$class2 = "soldout paddingMore";
							$class3 = "discountContainer rightStyle";
						} ?>
							<div class="<?php echo $class; ?>"> <?php if ($products[$i]->is_on_discount == 1): ?>
									<div class="<?php echo $class3; ?>">
										<div
											class="numberPercent"><?php echo (floor($products[$i]->discount / $products[$i]->selling_price * 100)); ?> </div>
										<div class="percentSign">%</div>
										<div class="offPercent clear_both">OFF</div>
									</div> <?php endif; ?>
								<div class="rightPanelImageHolder1"><a
										href="<?php echo $base_url?>order/product_page/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[$i]->product_id; ?>">
										<img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[$i]->product_id; ?>/img1_240x200.jpg"/>
									</a>

									<div
										class="storeDecoratingText pro_name"><?php echo substr($products[$i]->product_name, 0, 30); ?> </div>
									<div class="fl">
										<div
											class="storeDecoratingText stor_nm font12"><?php echo $mystore[0]->store_name; ?></div>
										<div class="storeFancyHolder">
											<div class="fanciedIcon"></div>
											<div
												class="fancyNumber price storeExtraStyle"><?php echo $products[$i]->fancy_counter; ?></div>
											<div class="fancyText storeExtraStyle">fancied</div>
										</div>
									</div>
									<!-- added by Rajeeb--> <?php if ($products[$i]->is_on_discount == 0) { ?>
										<div class="priceHolder"><span
												class="rupee">`</span> <?php echo intval($products[$i]->selling_price); ?>
										</div> <?php } else { ?>
										<div class="priceHolder" style="height:40px;">
											<div><span class="rupee">`</span>
												<del><?php echo intval($products[$i]->selling_price); ?></del>
											</div>
											<div><span
													class="rupee">`</span> <?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>
											</div>
										</div> <?php }?> <!-- End--> </div>
								<div class="hoverHolder">
									<div class="fancyHolder showtooltip" title="Love It? FANCY It!" id="fancyHolder<?php echo $products[$i]->product_id; ?>" onClick="<?php echo (isset($fancied_prods[$products[$i]->product_id])) ? "unFancyProduct(" . $products[$i]->product_id . ", this.id)" : "fancyProduct(" . $products[$i]->product_id . ", this.id)";?>">
									 <?php if (isset($fancied_prods[$products[$i]->product_id])): ?>
									<input type="hidden" value="<?php echo $products[$i]->product_id; ?>" class="hiddenFieldDiv1" id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/>
									 <input type="hidden" value="<?php echo $products[$i]->store_id; ?>" class="hiddenFieldStoreid"/> 
									 <input type="hidden" value="<?php echo $products[$i]->product_id; ?>" class="hiddenFieldProductid"/>
											<div class="hoverFancyNext"
											     id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
											<div class="hoverText"
											     id="hoverText<?php echo $products[$i]->product_id; ?>">FANCIED
											</div> <?php else: ?> <input type="hidden"
									                                     value="<?php echo $products[$i]->product_id; ?>"
									                                     class="hiddenFieldDiv1"
									                                     id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/>
											<input type="hidden" value="<?php echo $products[$i]->store_id; ?>"
											       class="hiddenFieldStoreid"/> <input type="hidden"
											                                           value="<?php echo $products[$i]->product_id; ?>"
											                                           class="hiddenFieldProductid"/>
											<div class="hoverFancy"
											     id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
											<div class="hoverText"
											     id="hoverText<?php echo $products[$i]->product_id; ?>">FANCY
											</div> <?php endif; ?>
									</div> <?php if (isset($poll_prods[$products[$i]->product_id])) : ?>
										<div class="PollHolder showtooltip" title="Brag On FB!">
											<div class="hoverBrag"
											     style="background-image: url('<?php echo $base_url; ?>assets/images/brag_grey.png');"></div>
											<div class="hoverText">BRAGGED!</div>
										</div> <?php else: ?>
										<div id="brag_<?php echo $products[$i]->product_id; ?>" class="PollHolder showtooltip" title="Brag On FB!">
											<div class="hoverBrag"
												 onClick="return brag(<?php echo $products[$i]->product_id; ?>, <?php echo $products[$i]->store_id; ?>, '<?php echo substr($products[$i]->product_name,0,42); ?>')"></div>
											<div class="hoverText">BRAG!</div>
										</div> <?php endif; ?>
								</div> <?php if ($products[$i]->quantity > 0) $soldout = "display:none"; else $soldout = " "; ?>
								<div class="<?php echo $class2; ?>" style="<?php echo $soldout; ?>"></div>
							</div> <?php endfor; ?>
						<div id="slideBackground_1" class="slideBackground widthStyle clear_both">
							<div class="slideNormal" id="addMoreProducts"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
<?php include "fancy_unfancy_categories.php" ?> <?php include "footer.php" ?> </body>
<!--store fancy unfancy-->
<script type="text/javascript">
	function fancy_store_changed() {
		document.im2.src = "<?php echo $base_url; ?>assets/images/fancy_click.png";

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'ajax/fancy_store?store_id=<?php echo $mystore[0]->store_id; ?>',
			success: function (data) {
				$('#fan').html(data);
				$('#im1').html('FANCIED');
				window.location.reload();

			}
		});
	}
	function unfancy_store() {
//document.imuf.src="<?php echo $base_url; ?>assets/images/fancy_normal.png";

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'ajax/unfancy_store?store_id=<?php echo $mystore[0]->store_id; ?>',
			success: function (data) {
				$('#fan').html(data);
				$('#imuf').html('FANCY IT');
				window.location.reload();

			}
		});
	}
</script>
<script>
	$(".fancyHolder1").each(function () {

		var r = $(this).children(".hiddenFieldDiv1").val();
		var store_id = $(this).children(".hiddenFieldStoreid").val();
		var product_id = $(this).children(".hiddenFieldProductid").val();
		$(this).click(function () {
			var z = $(this).children(".hiddenFieldDiv1").val();
			if ($(this).children(".hoverText").html() == 'FANCY') {
				$("#FancyPopupContainer").dialog({
					width: 738,
					height: 510,
					modal: true
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'ajax/fancy_product_fetchpop1?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);

						var myPname = $('#productNameD_' + product_id).html();
						$('.myProductName').html(myPname);

						var mySname = $('#storeNameD_' + store_id).html();
						$('.myStoreName').html(mySname);

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
					modal: true
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'ajax/fancy_product_fetchpop2?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);

						var myPname = $('#productNameD_' + product_id).html();
						$('.myProductName').html(myPname);

						var mySname = $('#storeNameD_' + store_id).html();
						$('.myStoreName').html(mySname);

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

				$("#FancyPopupContainer").dialog('close');
				//window.location.reload();
			});

			$("#unfancy").click(function () {

				$("#EditPopupContainer").dialog('close');
				//window.location.reload();

			});
		});
		$(this).hover(function () {

			if ($(this).children("#hoverText" + r).html() == 'FANCIED') {
				$(this).children("#hoverText" + r).html("EDIT");
				$(this).children("#hoverFancy" + r).removeClass('hoverFancyNext');
				$(this).children("#hoverFancy" + r).addClass('editFancynext');
			}

		}, function () {
			if ($(this).children("#hoverText" + r).html() == 'EDIT') {
				$(this).children(".hoverText").html("FANCIED");
				$(this).children("#hoverFancy" + r).removeClass('editFancynext');
				$(this).children("#hoverFancy" + r).addClass('hoverFancyNext');
			}
		});
	});


	function AddPoll(pid) {
		$.ajax({
			url: "<?php echo $base_url; ?>ajax_poll/add_to_poll/" + pid,
			success: function (data) {
			}

		});

		$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');

		$("#pollPopup").dialog({
			width: 605,
			height: 293,
			modal: true
		});
	}
	function poll_close() {
		$("#pollPopup").dialog('close');
	}
</script>
<script type="text/javascript">
	$(function () {
		var x = $.trim($("#banner").text());
		if (x.length >= 520) {
			$("#hide").html(x);
			x = x.substring(0, 520);
			x = x.replace(/\w+$/, '');
			x += '<span id="mor">..</span>';
			$("#banner").html(x);
		}
		$("#mor").click(function () {
			$("#banner").html($("#hide").html());
		});


		var totalScroll6 = 0;
		$("#scrollLeftButton6").click(function () {
			var rightArrowShow = $("#scrollRightButton6").css('display');
			if (rightArrowShow == 'none')
				$("#scrollRightButton6").css('display', 'block');

			//alert(totalScroll);
			if (totalScroll6 <= 1024) {
				$("#scrollLeftButton6").css('display', 'none');
			}
			if (totalScroll6 <= 0) return;
			totalScroll6 = totalScroll6 - 1024;
			$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
		});

		var x3 =<?php echo ceil(count($rec_viewed)/4); ?>;
		var totalWidth3 = x3 * 1024;
		$("#slider6").css("width", totalWidth3 + "px");


		$("#scrollRightButton6").click(function () {
			if (x3 == 1) {
			} else {
				var rightArrowShow = $("#scrollLeftButton6").css('display');
				if (rightArrowShow == 'none')
					$("#scrollLeftButton6").css('display', 'block');
				maxScroll = parseInt($("#slider6").css("width")) - parseInt($("#sliderParentDiv_6").width());
				if (totalScroll6 + 1024 >= maxScroll) {
					$("#scrollRightButton6").css('display', 'none');
					totalScroll6 = totalScroll6 + 1024;
					$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
					return
				}
				;
				totalScroll6 = totalScroll6 + 1024;
				$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);

			}
		});


		var totalScroll9 = 0;
		$("#scrollLeftButton9").click(function () {
			var rightArrowShow = $("#scrollRightButton9").css('display');
			if (rightArrowShow == 'none')
				$("#scrollRightButton9").css('display', 'block');

			//alert(totalScroll);
			if (totalScroll9 <= 1024) {
				$("#scrollLeftButton9").css('display', 'none');
			}
			if (totalScroll9 <= 0) return;
			totalScroll9 = totalScroll9 - 1024;
			$('#sliderParentDiv_9').animate({scrollLeft: totalScroll9}, 2050);
		});

		var x4 =<?php echo ceil(count($productslow)/4); ?>;
		var totalWidth4 = x4 * 1024;
		$("#slider9").css("width", totalWidth4 + "px");

		$("#scrollRightButton9").click(function () {
			if (x4 == 1) {
			} else {
				var rightArrowShow = $("#scrollLeftButton9").css('display');
				if (rightArrowShow == 'none')
					$("#scrollLeftButton9").css('display', 'block');
				maxScroll = parseInt($("#slider9").css("width")) - parseInt($("#sliderParentDiv_9").width());
				if (totalScroll9 + 1024 >= maxScroll) {
					$("#scrollRightButton9").css('display', 'none');
					totalScroll9 = totalScroll9 + 1024;
					$('#sliderParentDiv_9').animate({scrollLeft: totalScroll9}, 2050);
					return
				}
				;
				totalScroll9 = totalScroll9 + 1024;
				$('#sliderParentDiv_9').animate({scrollLeft: totalScroll9}, 2050);

			}
		});

		var totalScroll10 = 0;
		$("#scrollLeftButton10").click(function () {
			var rightArrowShow = $("#scrollRightButton10").css('display');
			if (rightArrowShow == 'none')
				$("#scrollRightButton10").css('display', 'block');

			//alert(totalScroll);
			if (totalScroll10 <= 1024) {
				$("#scrollLeftButton10").css('display', 'none');
			}
			if (totalScroll10 <= 0) return;
			totalScroll10 = totalScroll10 - 1024;
			$('#sliderParentDiv_10').animate({scrollLeft: totalScroll10}, 2050);
		});

		var x5 =<?php echo ceil(count($productshigh)/4); ?>;
		var totalWidth5 = x5 * 1024;
		$("#slider10").css("width", totalWidth5 + "px");

		$("#scrollRightButton10").click(function () {
			if (x5 == 1) {
			} else {
				var rightArrowShow = $("#scrollLeftButton10").css('display');
				if (rightArrowShow == 'none')
					$("#scrollLeftButton10").css('display', 'block');
				maxScroll = parseInt($("#slider10").css("width")) - parseInt($("#sliderParentDiv_10").width());
				if (totalScroll10 + 1024 >= maxScroll) {
					$("#scrollRightButton10").css('display', 'none');
					totalScroll10 = totalScroll10 + 1024;
					$('#sliderParentDiv_10').animate({scrollLeft: totalScroll10}, 2050);
					return
				}
				;
				totalScroll10 = totalScroll10 + 1024;
				$('#sliderParentDiv_10').animate({scrollLeft: totalScroll10}, 2050);

			}
		});


		$(".radio1").dgStyle();

		$("#feedback_popup,#feedbackPopupStore").click(function () {
			$("#feedbackPopup").dialog({
				width: 595,
				height: 410,
				modal: true
			});
		});
		$("#feedbackClose").click(function () {
			$("#feedbackPopup").dialog('close');
		});

		//tooltip2();
		//TOOLTIP
		//showAjaxContents(<?php echo $_GET['type'].", ".$mystore[0]->store_id; ?>, 0);
	});
</script>
<script src="<?php echo $base_url; ?>assets/js/store_page.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/newJS/customJS.js"></script>
</html>
