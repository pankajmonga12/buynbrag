<?php $value = $_REQUEST['typeID'];
if ($value == 'Single Category' || $value == 'Multiple Categories') { ?>
	<div class="rightMain" style="height:auto !important"><input type="hidden" name="hiddenRightTransparentHeight"
	                                                             id="hiddenRightTransparentHeight" value="122"/> <input
			type="hidden" name="hiddenCounter" id="hiddenCounter" value="1"/>

		<div class="rightTransparent" style="height:172px !important;"></div>
		<div class="rigntContent">
			<div class="faq_text">Select Category</div>
			<div class="sep"></div>
			<div class="promotecategory2" style="margin-bottom:10px;"><select class="drop"
			                                                                  id="rightPanelSelectedCategory"
			                                                                  onChange="<?php if($value == "Single Category") { ?>addCategoryToPanel(this.value); <?php } else { ?>addMultipleCategoryToPanel(this.value); <?php } ?>"
			                                                                  name="rightPanelSelectedCategory">
					<option value="select category" selected="selected" disabled="disabled">select category
					</option> <?php foreach ($catlist as $item): ?>
						<option value="<?php echo $item->name;?>"
						        id="<?php echo $item->storesection_id;?>"><?php echo $item->name;?></option> <?php endforeach;?>
				</select></div>
			<div class="appliesCategoriesSection">
				<ul id="appliesCategoriesSection">
					<!--<li> <div class="text">Home and Decore</div> <div class="selectedCategoryCloseIcon"><img src="images/close_icon.png"/></div> </li>-->
					<!-- <div class="sep"></div> <li> <div class="text">Home and Decore</div> <div class="selectedCategoryCloseIcon"><img src="images/close_icon.png"/></div> </li>--> </ul>
			</div>
		</div>
	</div>
	<script>
		$(".drop").selectbox();

		function addCategoryToPanel(value) {
			var data = "";
			var counter = $('#hiddenCounter').val();
			var cat_id = $('#rightPanelSelectedCategory option:selected').attr('id');
			var status = "'single'";

			data = '<div id="deleteAddedCategoryId' + counter + '"><div class="sep">&nbsp;</div><li><div class="text">' + value + '</div><div class="selectedCategoryCloseIcon" onClick="deleteAddedCategory(' + counter + ',' + status + ')">&nbsp;</div></li><input type="hidden" id="selectedCategoryId_' + counter + '" name="selectedCategoryId_' + counter + '"  value="' + cat_id + '" /></div>';

			$('#appliesCategoriesSection').html(data);
			$('#hiddenCounter').val(1);
		}

		function addMultipleCategoryToPanel(value) {

			var data = "";
			var height = $('#hiddenRightTransparentHeight').val();
			var cat_id = $('#rightPanelSelectedCategory option:selected').attr('id');
			var counter = $('#hiddenCounter').val();
			var status = "'multiple'";

			$('#hiddenRightTransparentHeight').val(parseInt(height) + 45);
			data = '<div id="deleteAddedCategoryId' + counter + '"><div class="sep">&nbsp;</div><li><div class="text">' + value + '</div><div class="selectedCategoryCloseIcon" onClick="deleteAddedCategory(' + counter + ',' + status + ')">&nbsp;</div></li><input type="hidden" id="selectedMultiCategoryId_' + counter + '" name="selectedMultiCategoryId_' + counter + '" value="' + cat_id + '" /></div>';

			$('#appliesCategoriesSection').append(data);
			var newHeight = $('#hiddenRightTransparentHeight').val();
			$('.rightTransparent').css('height', newHeight + 'px');
			$('#hiddenCounter').val(parseInt(counter) + 1);
		}

		function deleteAddedCategory(divNum, type) {
			var height = $('#hiddenRightTransparentHeight').val();
			if (type == 'multiple')
				$('#hiddenRightTransparentHeight').val(parseInt(height) - 45);
			else
				$('#hiddenRightTransparentHeight').val(parseInt(height) - 8);

			var newHeight = $('#hiddenRightTransparentHeight').val();
			$('.rightTransparent').css('height', newHeight + 'px');

			var d = document.getElementById('appliesCategoriesSection');
			var olddiv = document.getElementById("deleteAddedCategoryId" + divNum);
			d.removeChild(olddiv);
		}
	</script> <?php } else {
	$base_url = base_url();
	$maxWidth = round($total_products / 12);
	if ($maxWidth == 0) $maxWidth = 1; ?>
	<div class="rightMain">
		<div class="rightTransparent"></div>
		<div class="rigntContent">
			<div class="faq_text">Select Products</div>
			<div class="sep"></div>
			<div class="promotecategory2"><select class="drop" id="category" onChange="selectCategory(this.value)"
			                                      name="category">
					<option value="select category" selected="selected" disabled="disabled">select category
					</option> <?php foreach ($catlist as $item): ?>
						<option
							value="<?php echo $item->storesection_id;?>"><?php echo $item->name;?></option> <?php endforeach;?>
				</select></div>
			<div class="sep extraMargin"></div>
			<div id="remoteCategoriesSelected">
				<div class="faq_text" style="padding-left:10px;">Product(s):<?php echo $total_products; ?></div>
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
												<div class="panelImage1"> <?php if ($i + 0 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 0]->mystoreid;?>/<?php echo $allproducts[$i + 0]->product_id;?>/img1_92x77.jpg"
															alt="<?php echo $allproducts[$i + 0]->product_name; ?>"
															width="92" height="77"
															id="<?php echo $allproducts[$i + 0]->product_id; ?>"/>
													</a> <?php } ?> </div>
												<div class="panelImage1"> <?php if ($i + 1 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 1]->mystoreid;?>/<?php echo $allproducts[$i + 1]->product_id;?>/img1_92x77.jpg"
															alt="<?php echo $allproducts[$i + 1]->product_name; ?>"
															width="92" height="77"
															id="<?php echo $allproducts[$i + 1]->product_id; ?>"/>
													</a> <?php }?> </div>
												<div class="panelImage1"> <?php if ($i + 2 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
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
												<div class="panelImage1"> <?php if ($i + 4 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 4]->mystoreid;?>/<?php echo $allproducts[$i + 4]->product_id;?>/img1_92x77.jpg"
															alt="<?php echo $allproducts[$i + 4]->product_name; ?>"
															width="92" height="77"
															id="<?php echo $allproducts[$i + 4]->product_id; ?>"/>
													</a> <?php } ?> </div>
												<div class="panelImage1"> <?php if ($i + 5 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 5]->mystoreid;?>/<?php echo $allproducts[$i + 5]->product_id;?>/img1_92x77.jpg"
															alt="<?php echo $allproducts[$i + 5]->product_name; ?>"
															width="92" height="77"
															id="<?php echo $allproducts[$i + 5]->product_id; ?>"/>
													</a> <?php } ?> </div>
												<div class="panelImage1"> <?php if ($i + 6 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
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
												<div class="panelImage1"> <?php if ($i + 8 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 8]->mystoreid;?>/<?php echo $allproducts[$i + 8]->product_id;?>/img1_92x77.jpg"
															alt="<?php echo $allproducts[$i + 8]->product_name; ?>"
															width="92" height="77"
															id="<?php echo $allproducts[$i + 8]->product_id; ?>"/>
													</a> <?php } ?> </div>
												<div class="panelImage1"> <?php if ($i + 9 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
															src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 9]->mystoreid;?>/<?php echo $allproducts[$i + 9]->product_id;?>/img1_92x77.jpg"
															alt="<?php echo $allproducts[$i + 9]->product_name; ?>"
															width="92" height="77"
															id="<?php echo $allproducts[$i + 9]->product_id; ?>"/>
													</a> <?php } ?> </div>
												<div class="panelImage1"> <?php if ($i + 10 < $total_products) { ?> <a
														href="javascript:void(0)"> <img
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
	<script>
		$(function () {
			$(".drop").selectbox();

			var totalScroll = 0;

			$("#scrollLeftButton").click(function () {
				if (totalScroll <= 0) return;
				totalScroll = totalScroll - 400;
				$('#sliderParentDiv').animate({scrollLeft: totalScroll}, 840);
			});

			$("#scrollRightButton").click(function () {
				maxScroll = parseInt($(".slider").css("width")) - parseInt($("#sliderParentDiv").width());
				if (totalScroll > maxScroll) return;
				totalScroll = totalScroll + 400;
				$('#sliderParentDiv').animate({scrollLeft: totalScroll}, 840);
			});
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
						var count = 0;
						$(".multipleProductSelected img").each(function () {
							var value = $(this).attr('alt');
							if (value == image_id) {
								count++;
							}
						});
						if (count != 0) {
							return;
						}

						i = add_count + 1;
						$("#multiple_selected_img" + i).append($(document.createElement("img")).attr({src: image, id: "img_" + i, height: "94", width: "94", alt: image_id, class: "test"})).show();
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
	</script> <?php } ?>