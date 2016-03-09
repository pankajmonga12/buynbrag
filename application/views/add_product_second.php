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
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<body><input type="hidden" value="<?php echo $base_url; ?>" id="baseurl"/> <input type="hidden"
                                                                                  value="<?php echo $store_info_var[0]->store_id; ?>"
                                                                                  id="my_store_id" name="my_store_id"/>
<input type="hidden" value="<?php echo $isEdit; ?>" id="isEdit"/>
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="bannerHolder">
				<div class="bannerLogo"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info_var[0]->store_id; ?>/top_banner.png"/>
				</div>
				<div class="bannerText newbannerText">
					<div class="bannerTextHolder newbannerTextHolder">
						<div class="bannerShopText">Shop URL:</div>
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
							<div class="fancyText">bragged</div>
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
				href="<?php echo $base_url; ?>/index.php/dashboard/banner_design/<?php echo $store_info_var[0]->store_id; ?>">
				<div class="productsLink">
					<div class="designLogo"></div>
					<div class="productsText">Design</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/promote_discount_summary/<?php echo $store_info_var[0]->store_id; ?>">
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
			</a> <a href="<?php echo $base_url; ?>index.php/dashboard/bill/<?php echo $store_info_var[0]->store_id; ?>">
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
			<form name="prod_form" method="post" action="#">
				<div class="sameFont"> Details<span class="textItalic">Package product details</span></div>
				<div class="measurementBox">
					<div class="measurementboxLeft">
						<div class="measureDiv" style="padding-top:0px">
							<div class="float_left">
								<div class="sameFont diffcolor">Length</div>
								<div class="type_text">
									<div class=" productTextbox widthChange">
										<div class="textBorder widthChange"><input type="text" class="widthChange"
										                                           name="length_type" id="length_type"
										                                           placeholder="type"
										                                           value="<?php if ($isEdit != 0) echo $productdetails[0]->length; ?>"/>
										</div>
									</div>
								</div>
								<div class="unit_text">
									<div class=" productTextbox widthChange1">
										<!--<div class="textBorder widthChange1">-->
										<div class="ship_mode">
											<!--<input type="text" class="widthChange1" disabled="disabled" name="length_unit" id="length_unit" value="cm"/>-->
											<select class="mode" id="lengthUnit" name="lenUnit" style="width: auto;">
												<option value="0" selected="selected">cm</option>
												<option value="1">m</option>
												<option value="2">Inches</option>
											</select></div>
									</div>
								</div>
							</div>
							<div class="float_left">
								<div class="sameFont diffcolor">Breadth</div>
								<div class="type_text">
									<div class=" productTextbox widthChange">
										<div class="textBorder widthChange"><input type="text" class="widthChange"
										                                           name="breadth_type" id="breadth_type"
										                                           placeholder="type"
										                                           value="<?php if ($isEdit != 0) echo $productdetails[0]->breadth; ?>"/>
										</div>
									</div>
								</div>
								<div class="unit_text">
									<div class=" productTextbox widthChange1">
										<!--<div class="textBorder widthChange1">-->
										<div class="ship_mode">
											<!--<input type="text" class="widthChange1" disabled="disabled" name="width_unit" id="width_unit" value="cm"/>-->
											<select class="mode" id="breadthUnit" name="brthUnit" style="width: auto;">
												<option value="0" selected="selected">cm</option>
												<option value="1">m</option>
												<option value="2">Inches</option>
											</select></div>
									</div>
								</div>
							</div>
						</div>
						<div class="measureDiv">
							<div class="float_left">
								<div class="sameFont diffcolor">Height</div>
								<div class="type_text">
									<div class=" productTextbox widthChange">
										<div class="textBorder widthChange"><input type="text" class="widthChange"
										                                           name="height_type" id="height_type"
										                                           placeholder="type"
										                                           value="<?php if ($isEdit != 0) echo $productdetails[0]->height; ?>"/>
										</div>
									</div>
								</div>
								<div class="unit_text">
									<div class=" productTextbox widthChange1">
										<!--<div class="textBorder widthChange1">-->
										<div class="ship_mode">
											<!--<input type="text" class="widthChange1" disabled="disabled" name="length_unit" id="length_unit" value="cm"/>-->
											<select class="mode" id="heightUnit" name="heightUnit" style="width: auto;">
												<option value="0" selected="selected">cm</option>
												<option value="1">m</option>
												<option value="2">Inches</option>
											</select></div>
									</div>
								</div>
							</div>
						</div>
						<div class="measureDiv">
							<div class="float_left">
								<div class="sameFont diffcolor">Actual Weight</div>
								<div class="type_text">
									<div class=" productTextbox widthChange">
										<div class="textBorder widthChange"> <?php if ($isEdit == 0) { ?> <input
												type="text" class="widthChange" name="weight_type" id="weight_type"
												placeholder="type"/> <?php } else { ?> <input type="text"
										                                                      class="widthChange"
										                                                      name="weight_type"
										                                                      id="weight_type"
										                                                      placeholder="type"
										                                                      value="<?php echo $productdetails[0]->prd_act_weight; ?>"/> <?php }?>
										</div>
									</div>
								</div>
								<div class="unit_text">
									<div class=" productTextbox widthChange1">
										<div class="textBorder widthChange1"><input type="text" class="widthChange1"
										                                            name="weight_unit" id="weight_unit"
										                                            value="Kg"/></div>
									</div>
								</div>
							</div>
							<div class="fr">
								<div class="sameFont diffcolor">Volumetric Weight</div>
								<div class="type_text">
									<div class=" productTextbox widthChange">
										<div class="textBorder widthChange"> <?php if ($isEdit == 0) { ?> <input
												type="text" class="widthChange" name="volWeight_type"
												id="volWeight_type" placeholder="type"/> <?php } else { ?> <input
												type="text" class="widthChange" name="volWeight_type"
												id="volWeight_type" placeholder="type"
												value="<?php echo $productdetails[0]->prd_vol_weight; ?>"/> <?php }?>
										</div>
									</div>
								</div>
								<div class="unit_text">
									<div class=" productTextbox widthChange1">
										<div class="textBorder widthChange1"><input type="text" class="widthChange1"
										                                            name="length_unit" id="length_unit"
										                                            value="Kg"/></div>
									</div>
								</div>
							</div>
						</div>
						<div class="measureDiv">
							<div class="float_left">
								<div class="sameFont diffcolor">Shipping Mode</div>
								<div class="ship_mode"><select class="mode" id="mode" name="ship_mode">
										<option
											value="0" <?php if ($isEdit == 1 && $productdetails[0]->shipping_mode == '0') echo ' selected="selected"'; ?>>
											Air
										</option>
										<option
											value="1" <?php if ($isEdit == 1 && $productdetails[0]->shipping_mode == '1') echo ' selected="selected"'; ?>>
											Surface
										</option>
									</select></div>
							</div>
						</div>
						<div class="measureDiv">
							<div class="float_left">
								<div class="sameFont diffcolor">Shipping Partner</div>
								<div class="category diffwidth"><select class="drop" name="shipping_partner_id"
								                                        id="shipping_partner_id"> <?php if ($isEdit == 1) : ?>
											<option
												value="0" <?php if ($productdetails[0]->shipping_partner == 0) echo 'selected="selected"';?>>
												--Choose--
											</option>
											<option
												value="1" <?php if ($productdetails[0]->shipping_partner == 1) echo 'selected="selected"';?>>
												Fedex
											</option>
											<option
												value="2" <?php if ($productdetails[0]->shipping_partner == 2) echo 'selected="selected"';?>>
												Blue Dart
											</option>
											<option
												value="3" <?php if ($productdetails[0]->shipping_partner == 3) echo 'selected="selected"';?>>
												GATI
											</option> <?php else: ?>
											<option value="0" selected="selected">--Choose--</option>
											<option value="1">Fedex</option>
											<option value="2">Blue Dart</option>
											<option value="3">GATI</option> <?php endif; ?> </select></div>
							</div>
						</div>
					</div>
					<div class="thickseparator"></div>
					<div class="measurementboxRight">
						<div class="lbhBg">
							<div class="lbhTransparent"></div>
							<div class="lbhImage"></div>
						</div>
					</div>
				</div>
				<div class="textfieldSet">
					<div class="sameFont diffcolor">Seller Earnings</div>
					<span class="textItalic">(in rupees without any special character)</span>

					<div class="productTextbox widthChange2">
						<div class="textBorder widthChange2"> <?php if ($isEdit == 0) { ?> <input type="text"
						                                                                          name="seller"
						                                                                          id="seller"
						                                                                          placeholder="enter value"/> <?php } else { ?>
								<input type="text" name="seller" id="seller" placeholder="enter value"
								       value="<?php echo $productdetails[0]->seller_earnings; ?>"/> <?php }?> </div>
					</div>
					<div class="sameFont diffcolor">BuynBrag Commission</div>
					<span class="textItalic">(in %age, without % symbol or any special character)</span>

					<div class="productTextbox widthChange2">
						<div class="textBorder widthChange2"> <?php if ($isEdit == 0) { ?> <input type="text"
						                                                                          name="commision"
						                                                                          id="commision"
						                                                                          placeholder="---"/> <?php } else { ?>
								<input type="text" name="commision" id="commision" placeholder="---"
								       value="<?php echo $productdetails[0]->bnb_commission; ?>"/> <?php }?> </div>
					</div>
					<div class="sameFont diffcolor">Tax Rate</div>
					<span class="textItalic">(in %age, without % symbol or any special character)</span>

					<div class="productTextbox widthChange2">
						<div class="textBorder widthChange2"> <?php if ($isEdit == 0) { ?> <input type="text"
						                                                                          name="tax_rate"
						                                                                          id="tax_rate"
						                                                                          placeholder="enter value"/> <?php } else { ?>
								<input type="text" name="tax_rate" id="tax_rate" placeholder="enter value"
								       value="<?php echo $productdetails[0]->tax_rate; ?>"/> <?php }?> </div>
					</div>
					<div class="sameFont diffcolor">Insurance</div>
					<span class="textItalic">(in rupees without any special character)</span>

					<div class="productTextbox widthChange2">
						<div class="textBorder widthChange2"> <?php if ($isEdit == 0) { ?> <input type="text"
						                                                                          name="insurance"
						                                                                          id="insurance"
						                                                                          placeholder="enter value"/> <?php } else { ?>
								<input type="text" name="insurance" id="insurance" placeholder="enter value"
								       value="<?php echo $productdetails[0]->insurance_cost; ?>"/> <?php }?> </div>
					</div>
					<div class="sameFont diffcolor">Shipping Cost</div>
					<span class="textItalic">(in rupees without any special character)</span>

					<div class="productTextbox widthChange2">
						<div class="textBorder widthChange2"> <?php if ($isEdit == 0) { ?> <input type="text"
						                                                                          name="logistics"
						                                                                          id="logistics"
						                                                                          placeholder="enter value"/> <?php } else { ?>
								<input type="text" name="logistics" id="logistics" placeholder="enter value"
								       value="<?php echo $productdetails[0]->shipping_cost; ?>"/> <?php }?> </div>
					</div>
				</div>
				<div class="statisticsDiv">
					<div class="sameFont">MRP</div>
					<div class="statisticsTable2">
						<div class="titleMain">
							<div class="titleTransparent"></div>
							<div class="title_row">
								<div class="column1"></div>
								<div class="column2">
									<div class="heading1 imp">
										<div>MRP</div>
										<div class="textItalic1">inclusive of taxes</div>
									</div>
								</div>
								<div class="column3">
									<div class="heading imp">
										<div></div>
										<div></div>
									</div>
								</div>
							</div>
						</div>
						<div class="tableWrapper">
							<div class="tableTransparent" style="height:50px;"></div>
							<div class="tableInner">
								<div class="row">
									<div class="column1">
										<div class="radioText1">
											<div class="radio"><input type="radio" name="rad3"/></div>
											<div class="texts1">Manually Input MRP</div>
										</div>
									</div>
									<div class="column2">
										<div class="productTextbox widthChange4">
											<div class="textBorder"> <?php if ($isEdit == 0) { ?> <input type="text"
											                                                             name="sellingPrice"
											                                                             id="sellingPrice"
											                                                             placeholder="---"/> <?php } else { ?>
													<input type="text" name="sellingPrice" id="sellingPrice"
													       placeholder="---"
													       value="<?php echo $productdetails[0]->selling_price; ?>"/> <?php }?>
											</div>
										</div>
									</div>
									<div class="column3">
										<div class="innerValues"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="statisticsTable2">
						<div class="titleMain">
							<div class="titleTransparent"></div>
							<div class="title_row">
								<div class="column1"></div>
								<div class="column2">
									<div class="heading1 imp">
										<div>Discount</div>
										<div class="textItalic1">(in Rupees)</div>
									</div>
								</div>
								<div class="column3">
									<div class="heading imp">
										<div>&nbsp;</div>
										<div>&nbsp;</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tableWrapper">
							<div class="tableTransparent" style="height:50px;"></div>
							<div class="tableInner">
								<div class="row">
									<div class="column1">
										<div class="radioText1">
											<!--<div class="radio"><input type="radio" name="rad3"/></div>-->
											<div class="texts1">Input Discount Price(optional)</div>
										</div>
									</div>
									<div class="column2">
										<div class="productTextbox widthChange4">
											<div class="textBorder"> <?php if ($isEdit == 0) { ?> <input type="text"
											                                                             name="discount_price"
											                                                             id="discount_price"
											                                                             placeholder="---"/> <?php } else { ?>
													<input type="text" name="discount_price" id="discount_price"
													       placeholder="---"
													       value="<?php echo $productdetails[0]->discount; ?>"/> <?php }?>
											</div>
										</div>
									</div>
									<div class="column3">
										<div class="innerValues">&nbsp;</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="textfieldSet2">
						<div class="textfieldSet21">
							<div class="sameFont diffcolor">Quantity</div>
							<div class="productTextbox widthChange2">
								<div class="textBorder widthChange2"> <?php if ($isEdit == 0) { ?> <input type="text"
								                                                                          name="quantity"
								                                                                          id="quantity"
								                                                                          placeholder="enter quantity"/> <?php } else { ?>
										<input type="text" name="quantity" id="quantity" placeholder="enter quantity"
										       value="<?php echo $productdetails[0]->quantity; ?>"/> <?php }?> </div>
							</div>
						</div>
						<div class="textfieldSet22">
							<div class="sameFont diffcolor">Order Processing</div>
							<div class="productTextbox widthChange3">
								<div class="textBorder widthChange3"> <?php if ($isEdit == 0) { ?> <input type="text"
								                                                                          name="order_processing"
								                                                                          id="order_processing"
								                                                                          placeholder="enter no. of days"/> <?php } else { ?>
										<input type="text" name="order_processing" id="order_processing"
										       placeholder="enter no. of days"
										       value="<?php echo $productdetails[0]->processing_time; ?>"/> <?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="variantDiv">
					<div class="sameFont">Variant & Stock Levels</div>
					<div class="variantDetails">Please enter variants of the products which have same price. Eg. Small,
						XL, Large, Blue, White.
						<div>Variants with price variations are considered a separate product to be input under a
							separate unique product code
						</div>
					</div>
				</div>
				<input type="hidden" value="0" id="hiddenFieldDiv1"/> <?php if (isset($variantdetails)) : ?>
					<div class="namequantityDiv" id="namequantityDiv"> <?php foreach($variantdetails as $p_variant) : ?>
						<div class="nameQtyWrapper" id="nameQtyWrapper_0">
							<div class="nameQtyLeft" id="nameQtyLeft_0">
								<div class="namequantityTransparent"></div>
								<span class="textItalic">(Color) or (Size)</span>

								<div class="namequantityRow">
									<div class="quantity_text">Variant Type</div>
									<input type="text" value="<?php echo $p_variant->variant_name; ?>"
									       id="name_<?php echo $p_variant->variant_id; ?>"/>

									<div class="quantity_text">Quantity</div>
									<input type="text" value="<?php echo $p_variant->quantity; ?>"
									       id="qty_<?php echo $p_variant->variant_id; ?>"/>

									<div class="quantity_text">Size</div>
									<input type="text" value="<?php echo $p_variant->size; ?>"
									       id="size_<?php echo $p_variant->variant_id; ?>"/>

									<div class="quantity_text">Colour</div>
									<input type="text" value="<?php echo $p_variant->color; ?>"
									       id="color_<?php echo $p_variant->variant_id; ?>"/>

									<div class="divider"></div>
									<div class="editor"
									     onClick="return variant_edit(<?php echo $p_variant->variant_id; ?>)"></div>
									<div class="close"
									     onClick="return variant_delete(<?php echo $p_variant->variant_id; ?>)"></div>
								</div> <?php endforeach; ?> </div>
							<button class="bulkUpload addButton" type="button" id="add_0"
							        onClick="return addVariant(<?php if ($isEdit == 1) echo $productdetails[0]->product_id; ?>)">
								ADD
							</button>
						</div>
					</div> <?php endif; ?>
				<div class="buttonDiv"> <?php if ($isEdit == 0) { ?>
						<button type="button" class="prod_continue" onClick="saveData2(1)">Save
						</button> <?php } else { ?>
						<button type="button" class="prod_continue"
						        onClick="saveData2(<?php echo $productdetails[0]->product_id; ?>)">Save
						</button> <?php } ?>
					<!--<a href="<?php echo $base_url;?>index.php/dashboard/allproductspage/<?php echo $store_info_var[0]->store_id; ?>">-->
					<button type="button" class="prod_cancel"
					        onclick="window.location='<?php echo $base_url;?>index.php/dashboard/allproductspage/<?php echo $store_info_var[0]->store_id; ?>';">
						Cancel
					</button>
					<!--</a>--> </div>
			</form>
		</div>
	</section>
</section>
<?php //include "footer.php" ?>
</body>
<script type="text/javascript"
        src="<?php echo $base_url;?>assets/js/products.js?timestamp=<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript">
	function variant_edit(id) {
		var v_name = $('#name_' + id).val();
		var v_qty = $('#qty_' + id).val();
		var v_size = $('#size_' + id).val();
		var v_color = $('#color_' + id).val();
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/dashboard/editVariant/" + id + "?name=" + v_name +
				"&qty=" + v_qty + "&size=" + v_size + "&color=" + v_color,
			success: function (data) {
				alert(data);
			}
		});
	}
	function variant_delete(id) {
		var answer = confirm("Are you sure you want to delete this product?")
		if (answer) {
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/dashboard/deleteVariant/" + id,
				success: function (data) {
					if (data == 'Variant has been deleted successfully!') {
						window.location.reload(true);
					}
					else {
						alert('Database error occured!Please Try again');
					}
				}
			});
		}
	}
	function addVariant(id) {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/dashboard/addNewVariant/" + id,
			success: function (data) {
				window.location.reload(true);
			}
		});
	}
</script>
</html>