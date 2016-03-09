<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Products</title>
	<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php'); ?> <!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body><input type="hidden" value="<?php echo $base_url; ?>" id="baseurl"> <input type="hidden"
                                                                                 value="<?php echo $store_info_var[0]->store_id; ?>"
                                                                                 id="my_store_id" name="my_store_id">
<input type="hidden" value="<?php echo $isEdit; ?>" id="isEdit"> <?php //include_once('header.php'); ?>
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="bannerHolder">
				<div class="bannerLogo"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info_var[0]->store_id; ?>/top_banner.png"/>
				</div>
				<div class="bannerText newbannerText">
					<div class="bannerTextHolder newbannerTextHolder">
						<div class="bannerShopText">Shop URL :</div>
						<div class="bannerURLText"><?php echo $store_info_var[0]->store_url; ?></div>
					</div>
				</div>
				<div class="bannerIconsHolder">
					<div class="fancyHolder">
						<div class="fancyIcon"></div>
						<div class="fancyTextHolder">
							<div class="fancyNumber"><?php echo $store_info_var[0]->fancy_counter; ?></div>
							<div class="fancyText">fancied</div>
						</div>
					</div>
					<div class="fancyHolder">
						<div class="bragedIcon"></div>
						<div class="fancyTextHolder newfancyTextHolder1">
							<div class="fancyNumber"><?php echo $store_info_var[0]->brag_counter; ?></div>
							<div class="fancyText">braged</div>
						</div>
					</div>
					<div class="fancyHolder">
						<div class="viewedIcon"></div>
						<div class="fancyTextHolder newfancyTextHolder2">
							<div class="fancyNumber"><?php echo $store_info_var[0]->visit_counter; ?></div>
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
				href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info_var[0]->store_id; ?>">
				<div class="dashboardLink1">
					<div class="dashboardLogo1"></div>
					<div class="dashboardText1">Dashboard</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info_var[0]->store_id; ?>">
				<div class="productsLink1">
					<div class="productsLogo1"></div>
					<div class="productsText1">Products</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/banner_design/<?php echo $store_info_var[0]->store_id; ?>">
				<div class="productsLink">
					<div class="designLogo"></div>
					<div class="productsText">Design</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/promote/promote_discount_summary/<?php echo $store_info_var[0]->store_id; ?>">
				<div class="productsLink">
					<div class="promoteLogo"></div>
					<div class="productsText">Promote</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info_var[0]->store_id; ?>">
				<div class="productsLink">
					<div class="storeLogo"></div>
					<div class="productsText">Store Profile</div>
				</div>
			</a> <a href="<?php echo $base_url; ?>index.php/bill/allbill/<?php echo $store_info_var[0]->store_id; ?>">
				<div class="productsLink">
					<div class="billLogo"></div>
					<div class="productsText">Bill</div>
				</div>
			</a></div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground padding_bottom">
		<div class="add_productsContainer">
			<div class="leftSide"> <?php if ($isEdit == 0) { ?>
					<div class="add_productIcon"></div>
					<div class="add_productText">Add Product</div> <?php } else { ?>
					<div class="add_productIcon"></div>
					<div class="add_productText">Edit Product
						- <?php echo $productdetails[0]->product_id; ?></div> <?php }?> </div>
			<div class="rightSide"><a
					href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info_var[0]->store_id; ?>">
					<button type="button" class="addProducts">Back to List</button>
				</a> <a href="javascript:void(0);">
					<button type="button" class="bulkUpload">Bulk Upload</button>
				</a> <a href="javascript:void(0);">
					<button type="button" class="bulkUpload newbulkUpload">Export</button>
				</a></div>
		</div>
		<div class="whiteSeparator clear_both"></div>
		<div class="middleProductsContainer">
			<div class="add_productsFirst">
				<div class="sameFont"> What is it?</div>
				<div class="category"><select class="drop" name="category" id="category"
				                              onChange="showCategories(this.value,1)"> <?php if ($isEdit == 0) { ?>
							<option value="0" selected="selected" disabled="disabled">select category
							</option> <?php foreach ($product_cat as $product_cat_items): ?>
								<option
									value="<?php echo $product_cat_items->category_id; ?>"><?php echo $product_cat_items->category_name; ?></option> <?php endforeach;
						} else { ?>
							<option value="0" disabled="disabled">select category
							</option> <?php foreach ($product_cat as $product_cat_items): if ($product_cat_items->category_id == $productdetails[0]->cat_id) { ?>
								<option selected="selected"
								        value="<?php echo $product_cat_items->category_id; ?>"><?php echo $product_cat_items->category_name; ?></option> <?php } else { ?>
								<option
									value="<?php echo $product_cat_items->category_id; ?>"><?php echo $product_cat_items->category_name; ?></option> <?php } endforeach;
						}?> </select></div>
			</div>
			<div class="add_productsSecond">
				<div class="firstDropbox">
					<div class="sameFont"> What Type?<span class="textItalic"></span></div>
					<div class="category" id="category_1"><select class="drop" name="sub1_category" id="sub1_category">
							<option value="0">select sub category</option> <?php if ($isEdit == 1) {
								foreach ($product_cat1 as $product_cat_items1): ?> <?php if ($product_cat_items1->category_id != $productdetails[0]->sub_catid1) { ?>
									<option
										value="<?php echo $product_cat_items1->category_id; ?>"><?php echo $product_cat_items1->category_name; ?></option> <?php } else { ?>
									<option value="<?php echo $product_cat_items1->category_id; ?>"
									        selected="selected"><?php echo $product_cat_items1->category_name; ?></option> <?php } endforeach;
							}?> </select></div>
				</div>
				<div class="firstDropbox">
					<div class="sameFont"> What Type?<span class="textItalic"></span></div>
					<div class="category" id="category_2"><select class="drop" name="sub2_category" id="sub2_category">
							<option value="0">select sub sub category</option> <?php if ($isEdit == 1) {
								foreach ($product_cat2 as $product_cat_items2): ?> <?php if ($product_cat_items2->category_id != $productdetails[0]->sub_catid2) { ?>
									<option
										value="<?php echo $product_cat_items2->category_id; ?>"><?php echo $product_cat_items2->category_name; ?></option> <?php } else { ?>
									<option value="<?php echo $product_cat_items2->category_id; ?>"
									        selected="selected"><?php echo $product_cat_items2->category_name; ?></option> <?php } endforeach;
							}?> </select></div>
				</div>
				<div class="firstDropbox" style="width:325px;">
					<div class="sameFont"> What Type?<span class="textItalic">Optional</span></div>
					<div class="category" id="category_3"><select class="drop" name="sub3_category" id="sub3_category">
							<option value="0">select sub sub sub category</option> <?php if ($isEdit == 1) {
								foreach ($product_cat3 as $product_cat_items3): ?> <?php if ($product_cat_items3->category_id != $productdetails[0]->sub_catid3) { ?>
									<option
										value="<?php echo $product_cat_items3->category_id; ?>"><?php echo $product_cat_items3->category_name; ?></option> <?php } else { ?>
									<option value="<?php echo $product_cat_items3->category_id; ?>"
									        selected="selected"><?php echo $product_cat_items3->category_name; ?></option> <?php } endforeach;
							}?> </select></div>
				</div>
			</div>


<!--			To add products images-->

			<div class="add_productsThird">
				<div class="sameFont">Photos<span class="textItalic">Convey the shape, color, size & texture. Try to use natural light & include a great 			                    closeup</span></div>
				<div class="browseDiv">
					<div class="porfilePhotoArea">
						<div class="profilePhoto" id="fileImageParent1">
							<div id="crop_preview"></div>
							<div id="image" class="image_product">
								<div id="imageCrop"></div>
								<div class="paddingTop10">
									<form action="#" method="post" id="crop_details">
										<input type="hidden" id="x" name="x" />
										<input type="hidden" id="y" name="y" />
										<input type="hidden" id="w" name="w" />
										<input type="hidden" id="h" name="h" />
										<input type="hidden" id="fname" name="fname"  />
									</form>
								</div>
							</div>
							<div id="upload" class="upload_product">
								<form id="form1" action="" method="post" enctype="multipart/form-data">
									<!--<input type="file" name="file" id="file" />-->
									<div id="fileImage1" class="browseText">
										<div class="sfont">BROWSE &amp;</div>
										<div class="bfont">ADD</div>
										<div class="bfont1">PHOTO</div>
									</div>
									<input type="file" name="file" class="browse_products" id="file1" onChange="return fileUpload(1)" maxlength="1"/>
									<!--<input type="button" id="buttonUpload" value="Upload Image" onClick="return ajaxFileUpload();" />-->
								</form>
							</div>
						</div>
					</div>
					<div class="porfilePhotoArea">
						<div class="profilePhoto" id="fileImageParent2">
							<div id="crop_preview2"></div>
							<div id="image2" class="image_product">
								<div id="imageCrop2"></div>
								<div class="paddingTop10">
									<form action="#" method="post" id="crop_details2">
										<input type="hidden" id="x2" name="x" />
										<input type="hidden" id="y2" name="y" />
										<input type="hidden" id="w2" name="w" />
										<input type="hidden" id="h2" name="h" />
										<input type="hidden" id="fname2" name="fname"  />
									</form>
								</div>
							</div>
							<div id="upload2" class="upload_product">
								<form id="form2" action="" method="post" enctype="multipart/form-data">
									<!--<input type="file" name="file" id="file" />-->
									<div id="fileImage2" class="browseText">
										<div class="sfont">BROWSE &amp;</div>
										<div class="bfont">ADD</div>
										<div class="bfont1">PHOTO</div>
									</div>
									<input type="file" name="file" class="browse_products" id="file2" onChange="return fileUpload(2)"  maxlength="1"/>
									<!--<input type="button" id="buttonUpload" value="Upload Image" onClick="return ajaxFileUpload();" />-->
								</form>
							</div>
						</div>
					</div>
					<div class="porfilePhotoArea">
						<div class="profilePhoto" id="fileImageParent3">
							<div id="crop_preview3"></div>
							<div id="image3" class="image_product">
								<div id="imageCrop3"></div>
								<div class="paddingTop10">
									<form action="#" method="post" id="crop_details3">
										<input type="hidden" id="x3" name="x" />
										<input type="hidden" id="y3" name="y" />
										<input type="hidden" id="w3" name="w" />
										<input type="hidden" id="h3" name="h" />
										<input type="hidden" id="fname3" name="fname"  />
									</form>
								</div>
							</div>
							<div id="upload3" class="upload_product">
								<form id="form3" action="" method="post" enctype="multipart/form-data">
									<!--<input type="file" name="file" id="file" />-->
									<div id="fileImage3" class="browseText">
										<div class="sfont">BROWSE &amp;</div>
										<div class="bfont">ADD</div>
										<div class="bfont1">PHOTO</div>
									</div>
									<input type="file" name="file" class="browse_products" id="file3" onChange="return fileUpload(3)"  maxlength="1"/>
									<!--<input type="button" id="buttonUpload" value="Upload Image" onClick="return ajaxFileUpload();" />-->
								</form>
							</div>
						</div>
					</div>
					<div class="porfilePhotoArea">
						<div class="profilePhoto" id="fileImageParent4">
							<div id="crop_preview4"></div>
							<div id="image4" class="image_product">
								<div id="imageCrop4"></div>
								<div class="paddingTop10">
									<form action="#" method="post" id="crop_details4">
										<input type="hidden" id="x4" name="x" />
										<input type="hidden" id="y4" name="y" />
										<input type="hidden" id="w4" name="w" />
										<input type="hidden" id="h4" name="h" />
										<input type="hidden" id="fname4" name="fname"  />
									</form>
								</div>
							</div>
							<div id="upload4" class="upload_product">
								<form id="form4" action="" method="post" enctype="multipart/form-data">
									<!--<input type="file" name="file" id="file" />-->
									<div id="fileImage4" class="browseText">
										<div class="sfont">BROWSE &amp;</div>
										<div class="bfont">ADD</div>
										<div class="bfont1">PHOTO</div>
									</div>
									<input type="file" name="file" class="browse_products" id="file4" onChange="return fileUpload(4)"  maxlength="1"/>
									<!--<input type="button" id="buttonUpload" value="Upload Image" onClick="return ajaxFileUpload();" />-->
								</form>
							</div>
						</div>
					</div>
					<div class="porfilePhotoArea margin_right0">
						<div class="profilePhoto" id="fileImageParent5">
							<div id="crop_preview5"></div>
							<div id="image5" class="image_product">
								<div id="imageCrop5"></div>
								<div class="paddingTop10">
									<form action="#" method="post" id="crop_details5">
										<input type="hidden" id="x5" name="x" />
										<input type="hidden" id="y5" name="y" />
										<input type="hidden" id="w5" name="w" />
										<input type="hidden" id="h5" name="h" />
										<input type="hidden" id="fname5" name="fname"  />
									</form>
								</div>
							</div>
							<div id="upload5" class="upload_product">
								<form id="form5" action="" method="post" enctype="multipart/form-data">
									<!--<input type="file" name="file" id="file" />-->
									<div id="fileImage5" class="browseText">
										<div class="sfont">BROWSE &amp;</div>
										<div class="bfont">ADD</div>
										<div class="bfont1">PHOTO</div>
									</div>
									<input type="file" name="file" class="browse_products" id="file5" onChange="return fileUpload(5)"  maxlength="1"/>
									<!--<input type="button" id="buttonUpload" value="Upload Image" onClick="return ajaxFileUpload();" />-->
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

<!--			End add prods images-->


			<div class="add_productsFourth">
				<div class="sameFont"> Brief</div>
				<div class="fourthLeft">
					<div class="sameFont diffcolor">Product Name<span class="textItalic">Try to describe your item the way a shopper would</span>
					</div>
					<div class="productTextbox">
						<div class="textBorder category diffwidth"> <?php if ($isEdit == 0) { ?> <input type="text" name="prod_name"
						                                                             id="prod_name"
						                                                             placeholder="enter name of the product"/> <?php } else { ?>
								<input type="text" name="prod_name" id="prod_name"
								       placeholder="enter name of the product"
								       value="<?php echo $productdetails[0]->product_name; ?>"/> <?php }?> </div>
					</div>
					<div class="sameFont diffcolor">Product Code</div>
					<div class="productTextbox">
						<div class="textBorder"> <?php if ($isEdit == 0) { ?> <input type="text" name="item_code"
						                                                             id="item_code"
						                                                             placeholder="enter item code"/> <?php } else { ?>
								<input type="text" name="item_code" id="item_code" placeholder="enter item code"
								       value="<?php echo $productdetails[0]->bnb_product_code; ?>"/> <?php }?> </div>
					</div>
					<div class="sameFont diffcolor" style="margin-bottom: 12px">Shop Section</div>
					<div class="category diffwidth">
						<select class="drop" name="category" id="selected_shop">
							<option value="0">select category
							</option> <?php if ($isEdit == 0) { ?> <?php foreach ($shop_section_cat as $shop_section_cat_items): ?>
								<option
									value="<?php echo $shop_section_cat_items->storesection_id; ?>"><?php echo $shop_section_cat_items->name; ?></option> <?php endforeach; ?> <?php } else { ?> <?php foreach ($shop_section_cat as $shop_section_cat_items): if ($productdetails[0]->storesection_id != $shop_section_cat_items->storesection_id) { ?>
								<option
									value="<?php echo $shop_section_cat_items->storesection_id; ?>"><?php echo $shop_section_cat_items->name; ?></option> <?php } else { ?>
								<option value="<?php echo $shop_section_cat_items->storesection_id; ?>"
								        selected="selected"><?php echo $shop_section_cat_items->name; ?></option> <?php } endforeach; ?> <?php }?>
						</select>
					</div>
				</div>
				<div class="fourthRight">
					<div class="sameFont diffcolor">Description</div>
					<div class="productTexarea">
						<div class="textareaBorder" id="prod_textarea_div"> <?php if ($isEdit == 0) { ?> <textarea
								id="prod_textarea" placeholder="select category" wrap="hard" class="rte1"
								name="mytextarea"></textarea> <?php } else { ?> <textarea id="prod_textarea"
						                                                                  placeholder="select category"
						                                                                  class="rte1"
						                                                                  name="mytextarea"><?php echo $productdetails[0]->description; ?></textarea> <?php }?>
						</div>
					</div>
				</div>
			</div>
			<div class="add_productsFifth">
				<div class="sameFont">Target</div>
				<div class="fifthLeft">
					<div class="fifthHeading">Occasion</div>
					<div class="sameFont diffcolor">Is it for a specific occasion(s)?<span
							class="textItalic">Optional</span></div>
					<div class="productTextbox">
						<div class="textBorder category diffwidth"> <?php if ($isEdit == 0) { ?>
								<select class="drop" name="product_occasion" id="product_occasion" onChange="$('#occsn').val($(this).val()+','+$('#occsn').val())">
								<option value=" " selected="selected">- - Choose Occasion - -
								</option> <?php foreach ($occasions as $occasion) : ?>
									<option value="<?php echo $occasion->occasion; ?>"><?php echo $occasion->occasion; ?></option> <?php endforeach; ?>
							</select> <?php } else { ?>
								<select class="drop" name="product_occasion" id="product_occasion" onChange="$('#occsn').val($(this).val()+','+$('#occsn').val())">
								<option value=" " selected="selected">- - Choose Occasion - -
								</option> <?php foreach ($occasions as $occasion) : ?>
									<option
										value="<?php echo $occasion->occasion; ?>"><?php echo $occasion->occasion; ?></option> <?php endforeach; ?>
							</select> <?php }?> <input type="text" name="occsn" id="occsn"
						                               placeholder="Click on the occasion(s) one after one or type manually!"
						                               value="<?php if ($isEdit == 1) echo $productdetails[0]->occasions; ?>"/>
						</div>
					</div>
					<div class="sameFont diffcolor">Tags</div>
					<div class="productTextbox">
						<div class="textBorder"> <?php if ($isEdit == 0) { ?> <input type="text" name="tag_name"
						                                                             id="tag_name"
						                                                             placeholder="If Yes, enter name of evens separated with comma"/> <?php } else { ?>
								<input type="text" name="tag_name" id="tag_name"
								       placeholder="If Yes, enter name of evens separated with comma"
								       value="<?php echo $productdetails[0]->tags; ?>"/> <?php }?> </div>
					</div>
				</div>
				<div class="fifthRight">
					<div class="topRight category diffwidth">
						<div class="fifthHeading">What style?</div>
						<div class="sameFont diffcolor" style="margin-bottom: 12px;">Choose an unique style<span class="textItalic">Optional</span>
						</div>
						<select class="drop" name="product_style" id="product_style">
							<option value=" " selected="selected">- - Choose Style - -
							</option> <?php foreach ($styles as $style) : ?>
								<option <?php if (($isEdit == 1) and ($productdetails[0]->style == $style->style)) echo 'selected="selected"';?>
									value="<?php echo $style->style; ?>"><?php echo $style->style; ?></option> <?php endforeach; ?>
						</select></div>
					<div class="bottomRight">
						<div class="arrow_left"></div>
						<div class="whitebg">
							<div class="tag_text">
								<div>Tags help shoppers find your items when they search on Bnb.</div>
								<div>Add 13 tags to reach as many Bnb shoppers as possible.</div>
							</div>
							<div id="tag_close" class="tag_close"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="buttonDiv">
				<button type="button" class="prod_continue" id="continue_to_second">Continue</button>
				<a href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info_var[0]->store_id; ?>">
					<button type="button" class="prod_cancel">Cancel</button>
				</a></div>
		</div>
	</section>
</section>
<?php //include "footer.php" ?>
</body>
<link type="text/css" rel="stylesheet" href="<?php echo $base_url;?>assets/css/jquery.rte.css"/>
<style>
	.productTexarea {
		position: relative;
	}

	.rte-panel {
		top: 77px !important;
		left: 201px !important;
	}
</style>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/jquery.rte.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/jquery.rte.tb.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var arr = $('.rte1').rte({
			controls_rte: rte_toolbar,
			controls_html: html_toolbar
		});

		$('.rte2').rte({
			width: 486,
			height: 235,
			controls_rte: rte_toolbar,
			controls_html: html_toolbar
		}, arr);
	});
</script>
<script type="text/javascript">
	$(function () {
		$(document).click(function (e) {
			var $clicked = $(e.target);
			if (!$clicked.parents().hasClass("sbHolder")) {
				var x = $(document).find('select').attr('class');
				$("." + x).each(function () {
					var temp = $(this).attr('sb');
					if ($("#sbOptions_" + temp).css("display") == 'block') {
						$("#sbSelector_" + temp).click();
					}
				});
			}
		});
	});
</script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/products.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/ajaxfileupload.js"></script>
</html>