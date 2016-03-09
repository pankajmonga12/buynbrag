<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Promote Create Discounts Single Product</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.selectbox.css"/>
	<link rel="stylesheet" type="text/css"
	      href="<?php echo $base_url; ?>assets/css/promote_discount_single_product.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body><input type="hidden" value="<?php echo $base_url; ?>" id="baseurl" name="baseurl"> <input type="hidden"
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
			</a> <a
				href="<?php echo $base_url; ?>/index.php/dashboard/banner_design/<?php echo $store_info[0]->store_id; ?>">
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
	<section class="middleBackground" style="display:inline-block;margin-top:-2px;">
		<div class="categoriesContainer">
			<div class="categoryIcons">
				<div class="promote_discount"></div>
				<a href="<?php echo $base_url; ?>index.php/promote/promote_discount_summary/<?php echo $store_info[0]->store_id; ?>">
					<div class="categoriesText">DISCOUNT</div>
				</a> <a href="javascript:void(0)">
					<div title="Market Place" class="promote_marketplace showtooltip"></div>
				</a> <a href="javascript:void(0)">
					<div title="Gift Voucher" class="promote_giftvoucher showtooltip"></div>
				</a></div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="promote_body_container">
			<div class="promote_left_panel">
				<div class="promotionAppliesText">Promotion applies to</div>
				<div class="promotecategory"><select class="drop" name="selectedCategory"
				                                     onChange="selectPromotionApplies(this.value),selectPromotionAppliesRight(this.value)"
				                                     id="selectedCategory">
						<option
							value="Single Product" <?php if ($isedit == 0) echo ' selected="selected"'; elseif ($isedit == 1 && $type == 1 && count($items) == 1) echo ' selected="selected"'; ?>>
							Single Product
						</option>
						<option
							value="Multiple Products" <?php if ($isedit == 1 && $type == 1 && count($items) > 0) echo ' selected="selected"'; ?>>
							Multiple Products
						</option>
						<option
							value="Single Category" <?php if ($isedit == 1 && $type == 2 && count($items) == 1) echo ' selected="selected"'; ?>>
							Single Category
						</option>
						<option
							value="Multiple Categories" <?php if ($isedit == 1 && $type == 2 && count($items) > 1) echo ' selected="selected"'; ?>>
							Multiple Categories
						</option>
					</select></div>
				<!--Ajax Content-->
				<div id="promotionAppliesArea">
					<div class="addProductHere"><input type="hidden" name="productType" id="productType"
					                                   value="single"/> <input type="hidden" name="hiddenFieldDiv1"
					                                                           id="hiddenFieldDiv1" value="1"/>

						<div id="addTextContainer" class="addText">ADD
							<div style="font-size:18px;">PRODUCT</div>
							<div style="font-size:33px;">HERE</div>
						</div>
						<div id="single_selected_img1"></div>
					</div>
				</div>
				<!--Ajax Content end here-->
				<div class="promotionAppliesText morePadding">Promotion Type</div>
				<div class="promotecategory"><select class="drop" name="promotion_type"
				                                     onChange="selectPromotionType(this.value)" id="promotion_type">
						<option value="Select Promotion Type" selected="selected" disabled="disabled">Select Promotion
							Type
						</option>
						<option
							value="0" <?php if ($isedit == 1 && $items[0]->promotion_type == 0) echo ' selected="selected"'; ?>>
							Percentage Offer
						</option>
						<option
							value="1" <?php if ($isedit == 1 && $items[0]->promotion_type == 1) echo ' selected="selected"'; ?>>
							Rupee Offer
						</option>
					</select></div>
				<!--Ajax Content-->
				<div id="promotionTypeArea"></div>
				<!--Ajax Content end here-->
				<div class="promotionAppliesText morePadding">Promotion Expires</div>
				<div class="promotecategory"><select class="drop" name="promotion_expires"
				                                     onChange="selectPromotionExpires(this.value)"
				                                     id="promotion_expires">
						<option value="0"
						        selected="selected" <?php if ($isedit == 1 && $items[0]->expiry_type == 0) echo ' selected="selected"'; ?>>
							Never
						</option>
						<option
							value="1" <?php if ($isedit == 1 && $items[0]->expiry_type == 1) echo ' selected="selected"'; ?>>
							On Date
						</option>
						<option
							value="2" <?php if ($isedit == 1 && $items[0]->expiry_type == 2) echo ' selected="selected"'; ?>>
							After 'X' No. of Uses
						</option>
					</select></div>
				<!--Ajax Content-->
				<div id="promotionExpiresArea"></div>
				<!--Ajax Content end here-->
				<div class="buttonsContainer"><a href="javascript:void(0)">
						<button class="prod_continue" style="width:92px;" type="button" id="save_promote_form">Save
						</button>
					</a> <a href="javascript:void(0)">
						<button class="prod_cancel" style="width:122px;" type="button">Cancel</button>
					</a></div>
			</div>
			<div class="promote_panel_seperator"></div>
			<div class="promote_right_panel" id="promote_right_panel">
				<div class="rightMain">
					<div class="rightTransparent"></div>
					<div class="rigntContent">
						<div class="faq_text">Select Products</div>
						<div class="sep"></div>
						<div class="promotecategory2"><select class="drop" id="category"
						                                      onChange="selectCategory(this.value)" name="category">
								<option value="select category" selected="selected" disabled="disabled">select
									category
								</option> <?php foreach ($catlist as $item): ?>
									<option
										value="<?php echo $item->storesection_id;?>"><?php echo $item->name;?></option> <?php endforeach;?>
							</select></div>
						<div
							class="sep extraMargin"></div> <?php $maxWidth = ceil($total_products / 12); if ($maxWidth == 0) $maxWidth = 1; ?>
						<div id="remoteCategoriesSelected">
							<div class="faq_text" style="padding-left:10px;">
								Product(s):<?php echo $total_products; ?></div>
							<div class="sep"></div>
							<div class="scrollerHolderPromote">
								<div class="storeViewIcon" style="top:-35px;"></div>
								<div class="scrollerContentsPromote">
									<div class="button-block-left extraTopPosition" id="scrollLeftButton"></div>
									<div id="sliderParentDiv" class="sliderParentDivPromote">
										<div class="sliderPromote" id="slider"
										     style="width:<?php echo $maxWidth * 400; ?>px"> <?php $i = 0; while ($i <= $total_products) { ?>
												<div class="store-listPromote">
													<div class="rightPanelImageHolder">
														<div class="imageHolderPromote">
															<div
																class="panelImage1"> <?php if ($i + 0 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 0]->mystoreid;?>/<?php echo $allproducts[$i + 0]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 0]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 0]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1"> <?php if ($i + 1 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 1]->mystoreid;?>/<?php echo $allproducts[$i + 1]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 1]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 1]->product_id; ?>"/>
																	</a> <?php }?> </div>
															<div
																class="panelImage1"> <?php if ($i + 2 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 2]->mystoreid;?>/<?php echo $allproducts[$i + 2]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 2]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 2]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1 paddingRight0"> <?php if ($i + 3 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 3]->mystoreid;?>/<?php echo $allproducts[$i + 3]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 3]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 3]->product_id; ?>"/>
																	</a> <?php } ?> </div>
														</div>
														<div class="imageHolderPromote clear_both">
															<div
																class="panelImage1"> <?php if ($i + 4 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 4]->mystoreid;?>/<?php echo $allproducts[$i + 4]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 4]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 4]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1"> <?php if ($i + 5 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 5]->mystoreid;?>/<?php echo $allproducts[$i + 5]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 5]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 5]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1"> <?php if ($i + 6 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 6]->mystoreid;?>/<?php echo $allproducts[$i + 6]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 6]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 6]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1 paddingRight0"> <?php if ($i + 7 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 7]->mystoreid;?>/<?php echo $allproducts[$i + 7]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 7]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 7]->product_id; ?>"/>
																	</a> <?php } ?> </div>
														</div>
														<div class="imageHolderPromote clear_both">
															<div
																class="panelImage1"> <?php if ($i + 8 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 8]->mystoreid;?>/<?php echo $allproducts[$i + 8]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 8]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 8]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1"> <?php if ($i + 9 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 9]->mystoreid;?>/<?php echo $allproducts[$i + 9]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 9]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 9]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1"> <?php if ($i + 10 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 10]->mystoreid;?>/<?php echo $allproducts[$i + 10]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 10]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 10]->product_id; ?>"/>
																	</a> <?php } ?> </div>
															<div
																class="panelImage1 paddingRight0"> <?php if ($i + 11 < $total_products) { ?>
																	<a href="javascript:void(0)"> <img
																			src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 11]->mystoreid;?>/<?php echo $allproducts[$i + 11]->product_id;?>/img1_92x77.jpg"
																			alt="<?php echo $allproducts[$i + 11]->product_name; ?>"
																			width="92" height="77"
																			id="<?php echo $allproducts[$i + 11]->product_id; ?>"/>
																	</a> <?php } ?> </div>
														</div>
													</div>
												</div> <?php $i = $i + 12;
											} ?> </div>
										<div class="button-block-right extraTopPosition" id="scrollRightButton"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/promote_discount_single_product.js"></script>
<script>
	$(document).ready(function () {
		<?php if($isedit==1 && $type==1 && count($items)==1){?>
		selectPromotionApplies("Single Product");
		selectPromotionAppliesRight("Single Product");
		<?php foreach ($items as $item): ?>
		addtolist(<?php echo $item->product_id ;?>);
		<?php endforeach;?>
		<?php } else if ($isedit==1 && $type==1 && count($items)>1){?>
		selectPromotionApplies("Multiple Products");
		selectPromotionAppliesRight("Multiple Products");
		<?php foreach ($items as $item): ?>
		addtolist(<?php echo $item->product_id ;?>);
		<?php endforeach;?>
		<?php } else if ($isedit==1 && $type==2 && count($items)==1){?>

		selectPromotionApplies("Single Category");
		selectPromotionAppliesRight("Single Category");
		<?php foreach ($items as $item): ?>

		addCategoryToPanelcall('<?php echo $item->name ;?>', '<?php echo $item->storesection_id ;?>');
		<?php endforeach;?>
		<?php } else if ($isedit==1 && $type==2 && count($items)>1){?>
		selectPromotionApplies("Multiple Categories");
		selectPromotionAppliesRight("Multiple Categories");
		<?php foreach ($items as $item): ?>
		addMultipleCategoryToPanelcall('<?php echo $item->name ;?>', '<?php echo $item->storesection_id ;?>');
		<?php endforeach;?>
		<?php }?>
		<?php if($isedit==1) {?>
		selectPromotionType('<?php echo $items[0]->promotion_type ;?>');
		selectPromotionExpires('<?php echo $items[0]->expiry_type ;?>');
		<?php if($items[0]->promotion_type==0) {?>
		$("#percentageOfferValue").val('<?php echo $items[0]->discount ;?>');
		<?php } else {?>
		$("#rupeeValue").val('<?php echo $items[0]->discount ;?>');
		<?php }?>
		<?php if($items[0]->expiry_type==2) {?>
		$("#no_of_uses").val('<?php echo $items[0]->max_can_used ;?>');
		<?php } else if($items[0]->expiry_type==1){ $val=$items[0]->expiry_date;?>
		var expdate = '<?php echo $items[0]->expiry_date ;?>';
		var splitval = expdate.split("-");
		$("#promotionExpiresDate").val(splitval[2]);
		$("#promotionExpiresMonth").val(splitval[1]);
		$("#promotionExpiresYear").val(splitval[0]);
		<?php }}?>

	});
	$(".panelImage1 img").each(function () {
		$(this).click(function () {
			$("#addTextContainer").hide();
			var image = $(this).attr('src');
			var image_id = $(this).attr('id');
			var productType = $('#productType').val();
			if (productType == 'multiple') {
				var add_count = parseInt(document.getElementById('hiddenFieldDiv1').value);
				if (add_count < 11) {
					i = add_count + 1;
					$("#multiple_selected_img" + i).append($(document.createElement("img")).attr({src: image, id: "img_" + i, height: "94", width: "94", alt: image_id})).show();
					$("#multiple_selected_img" + i).css("background-color", "#fff");
					document.getElementById('hiddenFieldDiv1').value = i;
				}
			} else {

				var fullPath = image;
				if (fullPath) {
					var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
					var filename = fullPath.substring(startIndex);
					if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
						filename = filename.substring(1);
					}
					//alert(filename);
					var image = image.replace(filename, 'img1_500x375.jpg');
				}

				$("#single_selected_img1").html($(document.createElement("img")).attr({src: image, id: "img_1", height: "244", width: "333", alt: image_id}));
				$("#single_selected_img1").css("background-color", "#fff");
			}

		});
	});

</script>
</html>