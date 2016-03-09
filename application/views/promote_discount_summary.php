<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Promote Discount Summary</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/promote_discount_summary.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body><input type="hidden" value="<?php echo $base_url; ?>" id="baseurl"> <input type="hidden"
                                                                                 value="<?php echo $store_info[0]->store_id; ?>"
                                                                                 id="store_id">
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="bannerHolder">
				<div class="bannerLogo"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info[0]->store_id; ?>/top_banner.png"/>
				</div>
				<div class="bannerText newbannerText">
					<div class="bannerTextHolder newbannerTextHolder">
						<div class="bannerShopText">Shop URL :</div>
						<div class="bannerURLText"><?php echo $store_info[0]->store_url; ?></div>
					</div>
				</div>
				<div class="bannerIconsHolder">
					<div class="fancyHolder">
						<div class="fancyIcon"></div>
						<div class="fancyTextHolder">
							<div class="fancyNumber"><?php echo $store_info[0]->fancy_counter; ?></div>
							<div class="fancyText">fancied</div>
						</div>
					</div>
					<div class="fancyHolder">
						<div class="bragedIcon"></div>
						<div class="fancyTextHolder newfancyTextHolder1">
							<div class="fancyNumber"><?php echo $store_info[0]->brag_counter; ?></div>
							<div class="fancyText">braged</div>
						</div>
					</div>
					<div class="fancyHolder">
						<div class="viewedIcon"></div>
						<div class="fancyTextHolder newfancyTextHolder2">
							<div class="fancyNumber"><?php echo $store_info[0]->visit_counter; ?></div>
							<div class="fancyText">viewed</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle"><a
				href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info[0]->store_id; ?>">
				<div class="dashboardLink1">
					<div class="dashboardLogo1"></div>
					<div class="dashboardText1">Dashboard</div>
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
				<div class="promoteLink1">
					<div class="promoteHover"></div>
					<div class="promoteText1">Promote</div>
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
		<div class="categoriesContainer">
			<div class="categoryIcons">
				<div class="promote_discount"></div>
				<div class="categoriesText">DISCOUNT</div>
				<a href="promote_market_place.php">
					<div title="Market Place" class="promote_marketplace showtooltip"></div>
				</a> <a href="promote_gift_voucher.php">
					<div title="Gift Voucher" class="promote_giftvoucher showtooltip"></div>
				</a></div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="tabsContainer">
			<div class="tabsContainerRelative">
				<div class="tabsLinksContainer">
					<div class="tabsLinksContainerTransparent"></div>
				</div>
				<div id="tab">
					<ul>
						<li style="display:none"><a href="#tab1">All</a></li>
						<li style="display:none"><a href="#tab2">Percentage Off </a></li>
						<li style="display:none"><a href="#tab3">Rupee Off</a></li>
						<div class="addProductLinkHolder"><a
								href="<?php echo $base_url; ?>index.php/promote/add_promote_discount/<?php echo $store_info[0]->store_id; ?>">
								<button type="button" class="addProducts">Add Promotion</button>
							</a></div>
					</ul>
					<div id="tab1">
						<div class="titleBackground newtitleBackground">
							<div class="addProductsBackgroundTransparent"></div>
							<div class="titleBackgroundHolder">
								<div class="productsTextHolder">
									<div class="productText">Discount on</div>
									<div class="searchProductsfield">
										<div class="searchProductsFieldMid"><input type="text" id="search_0"
										                                           placeholder="Search"
										                                           onKeyUp="searchPromotions(0)"/>

											<div class="textfieldSearch"></div>
										</div>
									</div>
								</div>
								<div class="categoryHolder">
									<div class="categoryText">Discount Type</div>
								</div>
								<div class="categoryHolder1">
									<div class="categoryText">Duration</div>
								</div>
								<div class="categoryHolder2">
									<div class="categoryText">Used</div>
								</div>
								<div class="categoryHolder3">
									<div class="categoryText">Status</div>
								</div>
								<div class="categoryHolder4">
									<div class="categoryText">Action</div>
								</div>
							</div>
						</div>
						<div class="stableGlassContainerHolder"
						     id="parent_promotion_0"> <?php $i = 0; $lastId = ""; foreach ($promotionList as $item): $i++;
								$lastId = $item->id; ?>
								<div class="stableGlassContainerRelative message_box" id="<?php echo $item->id; ?>">
									<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
									<div class="stableGlassContainer1"
									     onMouseOver="return transp(<?php echo $i + 1; ?>)"
									     onMouseOut="return normal(<?php echo $i + 1; ?>)">
										<div class="stableGlassRelative"> <?php if ($item->discount_on_type == 0) { ?>
												<div class="stableglassHolderProducts">
													<div class="promoteStoreImage"><img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/top_banner.png"
															alt="promote store"/></div>
												</div> <?php } else if ($item->discount_on_type == 1) { ?>
												<div class="stableglassHolderProducts">
													<div class="stableglassImage"><img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->storeowner_id; ?>/img1_73x73.jpg"
															alt="<?php echo $item->store_name; ?>"/></div>
													<div class="stableglassText">
														<div
															class="stableglassHeading"><?php echo $item->store_name; ?></div>
													</div>
												</div> <?php } else { ?>
												<div class="stableglassHolderProducts">
													<div class="shoesSocksText">
														<div
															class="stableglassHeading"><?php echo $item->store_name; ?></div>
														<div class="category_text">category</div>
													</div>
												</div> <?php } ?>
											<div class="categoriesColumn">
												<div class="priceAmount">
													<div
														style="text-align:center;"><?php if ($item->promotion_type == 0) { ?> Percentage Off<?php } else { ?> Rupee Off<?php }?></div>
													<div style="text-align:center;"><?php echo $item->discount;?></div>
												</div>
											</div> <?php if ($item->expiry_type == 0) { ?>
												<div class="priceColumn">
													<div class="priceAmount">Unlimited</div>
												</div> <?php } else if ($item->expiry_type == 1) { ?> <?php $arr = get_time_difference($item->applied_on, $item->expiry_date); ?>
												<div class="priceColumn">
													<div class="priceAmount"><?php echo $arr['days']?> days</div>
												</div> <?php } else { ?>
												<div class="priceColumn">
													<div class="priceAmount"><?php echo $item->max_can_used; ?>Users
													</div>
												</div> <?php }?>
											<div class="quantityColumn">
												<div class="priceAmount"><?php echo $item->no_of_used; ?> used</div>
											</div>
											<div class="statusColumn"> <?php if ($item->status == 0) { ?>
													<div class="checkbox"><input id="check_<?php echo $i + 1; ?>"
													                             name="1"
													                             value="<?php echo $item->discount_on_type; ?>_<?php echo $item->storeowner_id; ?>"
													                             type="checkbox" checked="false"><label
															for="check_<?php echo $i + 1; ?>"></label>
													</div> <?php } else { ?>
													<div class="checkbox"><input id="check_<?php echo $i + 1; ?>"
													                             name="1"
													                             value="<?php echo $item->discount_on_type; ?>_<?php echo $item->storeowner_id; ?>"
													                             type="checkbox"><label
															for="check_<?php echo $i + 1; ?>"></label></div> <?php }?>
											</div>
											<div class="actionColumn"><a
													href="<?php echo $base_url;?>index.php/promote/editpromote/<?php echo $store_info[0]->store_id; ?>/<?php echo $item->discount_on_type; ?>/<?php echo $item->id; ?>">
													<div class="actionEdit"></div>
												</a>

												<div class="actionClose"
												     onClick="deletePromote(<?php echo $item->discount_on_type; ?>,<?php echo $item->storeowner_id;?>)"></div>
											</div>
										</div>
									</div>
								</div> <?php endforeach;?> </div>
					</div>
					<div id="tab2">
						<div class="titleBackground newtitleBackground">
							<div class="addProductsBackgroundTransparent"></div>
							<div class="titleBackgroundHolder">
								<div class="productsTextHolder">
									<div class="productText">Discount on</div>
									<div class="searchProductsfield">
										<div class="searchProductsFieldMid"><input type="text" id="search_1"
										                                           placeholder="Search"
										                                           onKeyUp="searchPromotions(1)"/>

											<div class="textfieldSearch"></div>
										</div>
									</div>
								</div>
								<div class="categoryHolder">
									<div class="categoryText">Discount Type</div>
								</div>
								<div class="categoryHolder1">
									<div class="categoryText">Duration</div>
								</div>
								<div class="categoryHolder2">
									<div class="categoryText">Used</div>
								</div>
								<div class="categoryHolder3">
									<div class="categoryText">Status</div>
								</div>
								<div class="categoryHolder4">
									<div class="categoryText">Action</div>
								</div>
							</div>
						</div>
						<div class="stableGlassContainerHolder" id="parent_promotion_1"></div>
					</div>
					<div id="tab3">
						<div class="titleBackground newtitleBackground">
							<div class="addProductsBackgroundTransparent"></div>
							<div class="titleBackgroundHolder">
								<div class="productsTextHolder">
									<div class="productText">Discount on</div>
									<div class="searchProductsfield">
										<div class="searchProductsFieldMid"><input type="text" id="search_2"
										                                           placeholder="Search"
										                                           onKeyUp="searchPromotions(2)"/>

											<div class="textfieldSearch"></div>
										</div>
									</div>
								</div>
								<div class="categoryHolder">
									<div class="categoryText">Discount Type</div>
								</div>
								<div class="categoryHolder1">
									<div class="categoryText">Duration</div>
								</div>
								<div class="categoryHolder2">
									<div class="categoryText">Used</div>
								</div>
								<div class="categoryHolder3">
									<div class="categoryText">Status</div>
								</div>
								<div class="categoryHolder4">
									<div class="categoryText">Action</div>
								</div>
							</div>
						</div>
						<div class="stableGlassContainerHolder" id="parent_promotion_2"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> <?php function get_time_difference($time, $time1)
{
	$uts['end'] = strtotime($time1);
	$uts['start'] = strtotime($time);
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
} ?> </body>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/promote_discount_single_product.js"></script>
<script type="text/javascript">

	$(document).ready(function () {
		function last_promote_funtion() {
			var ID = $(".message_box:last").attr("id");
			var baseUrl = $("#baseurl").val();
			var selected = $("#tab").tabs("option", "selected");
			var selectedTabTitle = $($("#tab li")[selected]).text();
			var type = 0;
			if (selectedTabTitle == "All") {
				type = 0;
			}
			else if (selectedTabTitle == "Rupee Off") {
				type = 2;
			}
			else {
				type = 1;
			}
			var product = $('#search_' + type).val();
			$('div#slideNormal_1').html('<img src=' + baseUrl + 'assets/images/loader.gif>');
			$.ajax({
				url: baseUrl + 'index.php/promote/promoteAjaxLoader?status=' + type + '&limit=' + ID + '&pro=' + product + '&store_id='+<?php echo $store_info[0]->store_id?>+'',
				success: function (data) {
					if (data != "") {
						$(".message_box:last").after(data);
					}
					$('div#slideNormal_1').empty();
				}
			});
		};

		$(window).scroll(function () {
			if ($(window).scrollTop() == $(document).height() - $(window).height()) {
				last_promote_funtion();
			}
		});
	});
</script>
</html>