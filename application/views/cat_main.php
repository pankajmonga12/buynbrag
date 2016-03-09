<?php if ($id == 6) {
	$h = "Furniture";
	$t1 = "Woodsy, Minimal or Eclectic";
	$t2 = " - Let your spaces say something about you.";
	$img = "graphic.png";
	$style = "#furnituretext{color:#fff;} .furnitureImage{background-image:url(" . $base_url . "assets/images/funiture_click.png);height:20px;width:20px;}";
	$file = "fhad.php";
}
if ($id == 8) {
	$h = "D&#233;cor &amp; Furnishing";
	$t1 = "Curios, Colours and other little touches";
	$t2 = "";
	$img = "graphic.png";
	$style = "#hometext{color:#fff;} .homeImage{background-image:url(" . $base_url . "assets/images/homedecor_click.png);height:20px;width:20px;}";
	$file = "fhad.php";
}
if ($id == 7) {
	$h = "Dining";
	$t1 = "For the love of food and all things joyous and comforting";
	$t2 = "";
	$img = "graphic.png";
	$style = "#diningtext{color:#fff;} .DiningImage{background-image:url(" . $base_url . "assets/images/dinning_click.png);height:18px;width:27px;}";
	$file = "fhad.php";
}
if ($id == 10) {
	$h = "Lighting";
	$t1 = "A different glow for each mood";
	$t2 = "";
	$img = "graphic.png";
	$style = "#lightingtext{color:#fff;} .LightingImage{background-image:url(" . $base_url . "assets/images/lighting_click.png);height:21px;width:15px;}";
	$file = "fhad.php";
}
if ($id == 2) {
	$h = "Fashion";
	$t1 = "Boho-Chic to Haute Style, find it here.";
	$t2 = "";
	$img = "fashion.png";
	$style = "#fashiontext{color:#fff;} .fashionImage{background-image:url(" . $base_url . "assets/images/fashion_white.png);height:20px;width:20px;}";
	$file = "ffashion.php";
}
if ($id == 3) {
	$h = "Art";
	$t1 = "From popular prints to original antiques, feel free to ";
	$t2 = "wander.";
	$img = "art.png";
	$style = "#arttext{color:#fff;} .artImage{background-image:url(" . $base_url . "assets/images/art_white.png);height:21px;width:20px;}";
	$file = "fart.php";
}
if ($id == 4) {
	$h = "Collectibles";
	$t1 = "The rare and beautiful from the books of history";
	$t2 = " ";
	$img = "gizmos.png";
	$style = "#gizmostext{color:#fff;} .gizmosImage{background-image:url(" . $base_url . "assets/images/gizmos_white.png);height:18px;width:23px;}";
	$file = "fart.php";
} ?> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
	<html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Homedecor Main</title>
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
		<!-- for view.js <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/alt2.css" /> <script src="<?php echo $base_url; ?>assets/js/newview.js?auto"></script>--> <?php if ($sub_main > 0 and $sub_count > 0) : ?>
			<script type="text/javascript">
				$(document).ready(function ($) {
					return panelCategories(<?php echo $sub_count; ?>, <?php echo $sub_main; ?>);
				});
			</script> <?php endif; ?> <!--[if IE]>
		<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->
		<style>
			<?php echo $style; ?>
		</style>
	</head>
	<body>
	<section class="wrapper"> <?php include "$file"; ?>
		<nav class="middleColumnTop">
			<div class="middleColumnIE">
				<div class="topDotSeparator newtopDotSeparator"></div>
				<div class="linksMiddle"><a href="<?php echo $base_url . 'categories/cat_main/' . $id ?>">
						<div class="mainLinkSelected">
							<div class="heading_selected">Main</div>
						</div>
					</a> <a href="<?php echo $base_url . 'categories/cat_product/' . $id ?>">
						<div class="mainLink">
							<div class="heading_style">Products</div>
						</div>
					</a> <a href="<?php echo $base_url . 'categories/cat_stores/' . $id ?>">
						<div class="mainLink">
							<div class="heading_style">Stores</div>
						</div>
					</a>
					<!-- <a href="<?php echo $base_url.'categories/cat_editor/'.$id ?>"><div class="mainLink"> <div class="heading_style">Editor’s Faves</div> </div></a>-->
				</div>
				<div class="topDotSeparator newtopDotSeparator1"></div>
			</div>
		</nav>
		<section class="middleBackground">
			<div class="Ie8bg">
				<div class="topDotSeparator topSeparatorStyle"></div>
				<div class="storeMiddleBackgroundContainer">
					<div class="panelContainer">
						<div class="leftPanel leftPanelNewHeight">
							<div class="leftPanelCategory">Categories
							</div> <?php $ii = 0;$jj = 0;$kk = 0; foreach ($sub_categories as $sub_cat) {
								$ii = $ii + 1;
								echo "<div class=\"categoryHeading\" id=\"category" . $ii . "\" onClick=\"return panelCategories(" . $ii . "," . $sub_cat['category_id'] . ")\">" . $sub_cat['category_name'] . "</div> <div class=\"subCategoryConntainer\" id=\"sub_category" . $ii . "\">";
								foreach ($sub_sub_categories[$sub_cat['category_id']] as $sub_sub_cat) {
									$jj = $jj + 1;
									echo "<div class=\"subCategoryItems\" onClick=\"return subCategories(" . $jj . "," . $sub_sub_cat['category_id'] . ")\"> <div class=\"iconNormal\" id=\"icon_" . $jj . "\"></div> <div class=\"subCategory\" id=\"subCategory_" . $jj . "\">" . $sub_sub_cat['category_name'] . "</div> </div> <div class=\"subSubCategoryContainer\" id=\"subSubCategory_" . $jj . "\"> <ul>";
									foreach ($sub_sub_sub_categories[$sub_sub_cat['category_id']] as $sub_sub_sub_cat) {
										$kk = $kk + 1;
										echo "<li sss_id=\"" . $sub_sub_sub_cat['category_id'] . "\" class=\"subSubCategory\" id=\"subSubCategory" . $kk . "\">" . $sub_sub_sub_cat['category_name'] . "</li>";
									}
									echo "</ul></div>";
								}
								echo "</div>";
							} ?> </div>
						<div class="panelSeparator seperator_new_style"></div>
						<div class="rightPanel">
							<div class="trendingNewText">Trending Now</div>
							<div id="main_products" class="scrollerHolder">
								<div class="storeViewIcon icon_new_style"></div>
								<div class="scrollerContents">
									<div class="button-block-left button_left_style"></div>
									<div class="sliderParentDiv">
										<div class="slider"
										     id="slider"> <?php for ($i = 0; $i < count($products); $i++): ?> <?php if (($i % 3) == 0) {
												$class = "store-list paddingLeft0";
												$class2 = "soldout";
											} else {
												$class = "store-list";
												$class2 = "soldout paddingMore";
											} ?>
												<div class="<?php echo $class; ?>">
													<div class="rightPanelImageHolder1"><a
															href="<?php echo $base_url?>order/product_page/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>">
															<img
																src="<?php echo $store_url; ?>assets/images/stores/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>/img1_240x200.jpg"/>
														</a>

														<div class="storeDecoratingText pro_name"
														     id="productNameD_<?php echo $products[$i]->product_id; ?>"><?php echo $products[$i]->product_name; ?></div>
														<div class="fl">
															<div class="storeDecoratingText font12 stor_nm"
															     id="storeNameD_<?php echo $products[$i]->store_id; ?>"><?php echo $products[$i]->store_name; ?></div>
															<div class="storeFancyHolder">
																<div class="fanciedIcon"></div>
																<div
																	class="fancyNumber storeExtraStyle"><?php echo $products[$i]->fancy_counter; ?></div>
																<div class="fancyText storeExtraStyle">fancied</div>
															</div>
														</div>
														<!-- added by Rajeeb--> <?php if ($products[$i]->is_on_discount == 0) { ?>
															<div class="priceHolder"><span
																	class="rupee">`</span> <?php echo intval($products[$i]->selling_price); ?>
															</div> <?php } else { ?>
															<div class="priceHolder" style="height:40px; width:85px">
																<div><span class="rupee">`</span>
																	<del><?php echo intval($products[$i]->selling_price); ?></del>
																</div>
																<div><span
																		class="rupee">`</span><?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>
																</div>
															</div> <?php }?> <!-- End--> </div>
													<div class="hoverHolder">
														<div
															class="fancyHolder"> <?php if (isset($fancied_prods[$products[$i]->product_id])): ?>
																<input type="hidden"
																       value="<?php echo $products[$i]->product_id; ?>"
																       class="hiddenFieldDiv1"
																       id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/>
																<input type="hidden"
																       value="<?php echo $products[$i]->store_id; ?>"
																       class="hiddenFieldStoreid"/> <input type="hidden"
																                                           value="<?php echo $products[$i]->product_id; ?>"
																                                           class="hiddenFieldProductid"/>
																<div class="hoverFancyNext"
																     id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
																<div class="hoverText"
																     id="hoverText<?php echo $products[$i]->product_id; ?>">
																	FANCIED
																</div> <?php else: ?> <input type="hidden"
														                                     value="<?php echo $products[$i]->product_id; ?>"
														                                     class="hiddenFieldDiv1"
														                                     id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/>
																<input type="hidden"
																       value="<?php echo $products[$i]->store_id; ?>"
																       class="hiddenFieldStoreid"/> <input type="hidden"
																                                           value="<?php echo $products[$i]->product_id; ?>"
																                                           class="hiddenFieldProductid"/>
																<div class="hoverFancy"
																     id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
																<div class="hoverText"
																     id="hoverText<?php echo $products[$i]->product_id; ?>">
																	FANCY
																</div> <?php endif; ?>
														</div> <?php if (isset($poll_prods[$products[$i]->product_id])) : ?>
															<div class="PollHolder">
																<div class="hoverPoll"
																     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
																<div class="hoverText">POLLED</div>
															</div> <?php else: ?>
															<div id="poll_<?php echo $products[$i]->product_id; ?>"
															     class="PollHolder">
																<div class="hoverPoll"
																     onClick="return AddPoll(<?php echo $products[$i]->product_id; ?>)"></div>
																<div class="hoverText">POLL</div>
															</div> <?php endif; ?>
													</div> <?php if ($products[$i]->quantity > 0) $soldout = "display:none"; else $soldout = " "; ?>
													<div class="<?php echo $class2; ?>"
													     style="<?php echo $soldout; ?>"></div>
												</div> <?php endfor; ?> </div>
									</div>
									<div class="button-block-right button_right_style"></div>
								</div>
							</div>
							<div class="topScrollerSeparator clear_both"></div>
							<div class="trendingNewText topStoresStyle">Top Stores</div>
							<div id="main_stores" class="scrollerHolder2 clear_both">
								<div class="storeViewIcon icon_new_style"></div>
								<div class="scrollerContents2">
									<div class="button-block-left button_left_style2"></div>
									<div class="sliderParentDiv2">
										<div class="slider2"
										     id="slider2"> <?php for ($i = 0; $i < count($store); $i++): $sid = '_' . $store[$i]->store_id; ?>
<?php
//Generate a random number for fetching images -AS
												$max = count($sprod["$sid"]) - 1;
// $numbers = array();
// echo $numbers = range(0, $max);
// echo $numbers = shuffle($numbers);
// var_dump(array_slice($numbers, 0, $quantity));
												$tm1 = mt_rand(0, $max);
												$tm2 = mt_rand(0, $max);
												$tm3 = mt_rand(0, $max);
//Condition check for slider -AS
												if (($i % 2) == 0) {
													$class = "store-list2 paddingLeft0";
												} else {
													$class = "store-list2";
												}
												?>
												<div class="<?php echo $class; ?>"><a
														href="<?php echo $base_url?>order/store_page/<?php echo $store[$i]->store_id; ?>">
														<div class="images_holder">

															<img
																src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm1"]->product_id; ?>/img1_500x375.jpg"
																alt="big image"/>

															<div class="banner_Image"><img
																	src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/top_banner.png"/>
															</div> <?php //if(isset($sprod["$sid"]["$tm2"]->product_id)): ?>
															<div class="smallImage"><img
																	src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm2"]->product_id; ?>/img1_500x375.jpg"
																	alt="small image"/></div>
															<div class="mediumImage"><img
																	src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm3"]->product_id; ?>/img1_500x375.jpg"
																	alt="medium image"/></div>
															<div class="fancyBragedHolder">
																<div class="fancy_Icon"></div>
																<div
																	class="fancy_number"><?php echo $store[$i]->fancy_counter; ?></div>
																<div class="fancy_name">Fancied</div>
																<div class="brag_Icon clear_both"></div>
																<div
																	class="fancy_number"><?php echo $store[$i]->brag_counter; ?></div>
																<div class="fancy_name">Bragged</div>
															</div>
															<div class="product_number"> <?php echo $max + 1; ?>
																<div class="braged_name">Products</div>
															</div>
														</div>
													</a></div> <?php endfor; ?> </div>
									</div>
									<div class="button-block-right button_right_style2"></div>
								</div>
							</div>
							<div class="topScrollerSeparator clear_both"></div>
							<div class="trendingNewText topStoresStyle">Editor&rsquo;s Faves</div>
							<!-- <a href="javascript:void(0)"><div class="storesText">Stores</div></a> <div class="newVerticalSeparator"></div> <a href="javascript:void(0)"><div class="pannelProductText">Products</div></a>-->
							<div class="scrollerHolder2 clear_both">
								<div class="storeViewIcon icon_new_style"></div>
								<div class="scrollerContents2">
									<div class="button-block-left button_left_style3"></div>
									<div class="sliderParentDiv3">
										<div class="slider2"
										     id="slider3"> <?php for ($i = count($store) - 1; $i >= 0; $i--): $sid = '_' . $store[$i]->store_id; ?> <?php //Generate a random number for fetching images -AS $max = count($sprod["$sid"])-1; $tm1 = mt_rand(0, $max); $tm2 = mt_rand(0, $max); $tm3 = mt_rand(0, $max); //Condition check for slider -AS if ( ($i%2)==0 ) { $class="store-list2 paddingLeft0"; } else { $class="store-list2"; } ?>
												<div class="<?php echo $class; ?>"><a
														href="<?php echo $base_url?>order/store_page/<?php echo $store[$i]->store_id; ?>">
														<div class="images_holder"><img
																src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm1"]->product_id; ?>/img1_500x375.jpg"
																alt="big image"/>

															<div class="banner_Image"><img
																	src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/top_banner.png"/>
															</div>
															<div class="smallImage"><img
																	src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm2"]->product_id; ?>/img1_500x375.jpg"
																	alt="small image"/></div>
															<div class="mediumImage"><img
																	src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm3"]->product_id; ?>/img1_500x375.jpg"
																	alt="medium image"/></div>
															<div class="fancyBragedHolder">
																<div class="fancy_Icon"></div>
																<div
																	class="fancy_number"><?php echo $store[$i]->fancy_counter; ?></div>
																<div class="fancy_name">Fancied</div>
																<div class="brag_Icon clear_both"></div>
																<div
																	class="fancy_number"><?php echo $store[$i]->brag_counter; ?></div>
																<div class="fancy_name">Bragged</div>
															</div>
															<div class="product_number"> <?php echo $max + 1; ?>
																<div class="braged_name">Products</div>
															</div>
														</div>
													</a></div> <?php endfor; ?> </div>
									</div>
									<div class="button-block-right button_right_style3"></div>
								</div>
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
	</div> <?php include "fancy_unfancy_categories.php" ?> <?php include "footer.php" ?> </body>
	<script type="text/javascript">
		var totalScroll = 0;

		$(".button_left_style").click(function () {
			var rightArrowShow = $(".button_right_style").css('display');
			if (rightArrowShow == 'none')
				$(".button_right_style").css('display', 'block');

			//alert(totalScroll);
			if (totalScroll <= 735) {
				$(".button_left_style").css('display', 'none');
			}
			if (totalScroll <= 0) return;
			totalScroll = totalScroll - 760;
			$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
		});

		$(".button_right_style").click(function () {

			var x =<?php echo ceil(count($products)/3); ?>;
			if (x == 1) {
			} else {
				var rightArrowShow = $(".button_left_style").css('display');
				if (rightArrowShow == 'none')
					$(".button_left_style").css('display', 'block');
				maxScroll = parseInt($(".slider").css("width")) - parseInt($(".sliderParentDiv").width());
				if (totalScroll > maxScroll) {
					$(".button_right_style").css('display', 'none');
					return
				}
				;
				totalScroll = totalScroll + 760;
				$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
				var totalWidth = x * 760;
				$("#slider").css("width", totalWidth + "px");
			}
		});

		var totalScroll2 = 0;

		$(".button_left_style2").click(function () {
			if (totalScroll2 <= 0) return;
			totalScroll2 = totalScroll2 - 768;
			$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
		});

		var x2 =<?php echo ceil(count($store)/2); ?>;
		var totalWidth2 = x2 * 768;
		$("#slider2").css("width", totalWidth2 + "px");
		$(".button_right_style2").click(function () {
			if (x2 == 1) {
			} else {
				maxScroll = parseInt($(".slider2").css("width")) - parseInt($(".sliderParentDiv2").width());
				if (totalScroll2 > maxScroll) return;
				totalScroll2 = totalScroll2 + 768;
				$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
			}
		});

		var totalScroll3 = 0;

		$(".button_left_style3").click(function () {
			if (totalScroll3 <= 0) return;
			totalScroll3 = totalScroll3 - 768;
			$('.sliderParentDiv3').animate({scrollLeft: totalScroll3}, 1550);
		});
		var x3 =<?php echo ceil(count($store)/2); ?>;
		var totalWidth3 = x3 * 768;
		$("#slider3").css("width", totalWidth3 + "px");
		$(".button_right_style3").click(function () {
			if (x3 == 1) {
			} else {
				maxScroll = parseInt($(".slider2").css("width")) - parseInt($(".sliderParentDiv3").width());
				if (totalScroll3 > maxScroll) return;
				totalScroll3 = totalScroll3 + 768;
				$('.sliderParentDiv3').animate({scrollLeft: totalScroll3}, 1550);
			}
		});
	</script>
	<script type="text/javascript">
		$(function () {

			$('li').click(function () {
				var ids = $(this).attr('id');
				var ids2 = $(this).attr('sss_id');
				$(this).css('color', '#da3c63').siblings().css("color", "#666");
				$.ajax({
					url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod/" + ids2 + "/3",
					success: function (data) {
						$('#main_products').html(data);
					}
				});
				$.ajax({
					url: "<?php echo $base_url; ?>index.php/tree_products/sub_stores/" + ids2 + "/3",
					success: function (data) {
						$('#main_stores').html(data);
					}
				});
			});

		});

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
				modal: true,
			});
			$(".width_style_fancy").click(function () {
				$("#fancyPopup").dialog('close');
			});
		}
		function panelCategories(id, sc_id) {

			$('li').css('color', '#666');
			for (var i = 1; i <=<?php echo $ii; ?>; i++) {
				if (i == id) {
					if ($("#sub_category" + i).css('display') != 'block') {
						$("#sub_category" + i).show();
						$("#category" + i).css("color", "#333");
					} else {
						$("#sub_category" + i).hide();
						$("#category" + i).css("color", "#333");
					}
				} else {
					$("#sub_category" + i).hide();
					$("#category" + i).css("color", "#333");
				}
			}
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod/" + sc_id + "/1",
				success: function (data) {
					$('#main_products').html(data);
				}
			});
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/tree_products/sub_stores/" + sc_id + "/1",
				success: function (data) {
					$('#main_stores').html(data);
				}
			});

		}

		function subCategories(id, ssc_id) {
			for (var i = 1; i <=<?php echo $jj; ?>; i++) {
				if (i == id) {
					if ($("#subSubCategory_" + i).css('display') != 'block') {
						$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
						$("#subCategory_" + i).css("color", "#333");
						$("#subSubCategory_" + i).show();
					} else {
						$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
						$("#subCategory_" + i).css("color", "#666");
						$("#subSubCategory_" + i).hide();
					}

				} else {
					$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
					$("#subCategory_" + i).css("color", "#666");
					$("#subSubCategory_" + i).hide();
				}
			}
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod/" + ssc_id + "/2",
				success: function (data) {
					$('#main_products').html(data);
				}
			});
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/tree_products/sub_stores/" + ssc_id + "/2",
				success: function (data) {
					$('#main_stores').html(data);
				}
			});

		}
	</script>
	<script>
		$(".fancyHolder").each(function () {

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
						url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop1?store_id=' + store_id + '&product_id=' + product_id,
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
						modal: true,
					});
					$.ajax({
						url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop2?store_id=' + store_id + '&product_id=' + product_id,
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
	</script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
	</html> <?php //gc_disable(); ?>