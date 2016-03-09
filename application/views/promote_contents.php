<script>
	$(function () {
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
</script> <?php $maxWidth = round($total_products / 12); if ($maxWidth == 0) $maxWidth = 1; ?>
<div class="faq_text" style="padding-left:10px;">Product(s):<?php echo $total_products; ?></div>
<div class="sep"></div>
<div class="scrollerHolderPromote">
	<div class="storeViewIcon" style="top:-35px;"></div>
	<div class="scrollerContentsPromote">
		<div class="button-block-left extraTopPosition" id="scrollLeftButton"></div>
		<div id="sliderParentDiv" class="sliderParentDivPromote">
			<div class="sliderPromote" id="slider"
			     style="width:<?php echo $maxWidth * 400; ?>px"> <?php $base_url = base_url(); $i = 0; while ($i <= $total_products) { ?>
					<div class="store-listPromote">
						<div class="rightPanelImageHolder">
							<div class="imageHolderPromote">
								<div class="panelImage1"> <?php if ($i + 0 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 0]->mystoreid;?>/<?php echo $allproducts[$i + 0]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 0]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 0]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1"> <?php if ($i + 1 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 1]->mystoreid;?>/<?php echo $allproducts[$i + 1]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 1]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 1]->product_id; ?>"/>
									</a> <?php }?> </div>
								<div class="panelImage1"> <?php if ($i + 2 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 2]->mystoreid;?>/<?php echo $allproducts[$i + 2]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 2]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 2]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1 paddingRight0"> <?php if ($i + 3 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 3]->mystoreid;?>/<?php echo $allproducts[$i + 3]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 3]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 3]->product_id; ?>"/>
									</a> <?php } ?> </div>
							</div>
							<div class="imageHolderPromote clear_both">
								<div class="panelImage1"> <?php if ($i + 4 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 4]->mystoreid;?>/<?php echo $allproducts[$i + 4]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 4]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 4]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1"> <?php if ($i + 5 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 5]->store_id;?>/<?php echo $allproducts[$i + 5]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 5]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 5]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1"> <?php if ($i + 6 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 6]->mystoreid;?>/<?php echo $allproducts[$i + 6]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 6]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 6]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1 paddingRight0"> <?php if ($i + 7 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 7]->mystoreid;?>/<?php echo $allproducts[$i + 7]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 7]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 7]->product_id; ?>"/>
									</a> <?php } ?> </div>
							</div>
							<div class="imageHolderPromote clear_both">
								<div class="panelImage1"> <?php if ($i + 8 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 8]->mystoreid;?>/<?php echo $allproducts[$i + 8]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 8]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 8]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1"> <?php if ($i + 9 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 9]->mystoreid;?>/<?php echo $allproducts[$i + 9]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 9]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 9]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1"> <?php if ($i + 10 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 10]->mystoreid;?>/<?php echo $allproducts[$i + 10]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 10]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 10]->product_id; ?>"/>
									</a> <?php } ?> </div>
								<div class="panelImage1 paddingRight0"> <?php if ($i + 11 < $total_products) { ?> <a
										href="javascript:void(0)"> <img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $allproducts[$i + 11]->mystoreid;?>/<?php echo $allproducts[$i + 11]->product_id;?>/img1_92x77.jpg"
											alt="<?php echo $allproducts[$i + 11]->product_name; ?>" width="92"
											height="77" id="<?php echo $allproducts[$i + 11]->product_id; ?>"/>
									</a> <?php } ?> </div>
							</div>
						</div>
					</div> <?php $i = $i + 12;
				} ?> </div>
			<div class="button-block-right extraTopPosition" id="scrollRightButton"></div>
		</div>
	</div>
</div>
<script>
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