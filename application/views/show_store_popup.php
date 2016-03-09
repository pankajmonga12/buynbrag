<?php $num_rows = count($show_store_popup_items); ?>
<div class="chairPopupHolder">
	<div class="chairPopupBackground"></div>
	<div class="chairPopupBackgroundContent">
		<div class="textCloseIcon">
			<div class="textsHolder">
				<div class="uniqueChairText"><?php echo $show_store_popup_items[0]->product_name; ?></div>
				<input type="hidden" name="popupHiddenProductId" id="popupHiddenProductId"
				       value="<?php echo $show_store_popup_items[0]->product_id; ?>"/>

				<div class="priceQuantityText">Price : <span
						class="rupee">`</span> <?php echo $show_store_popup_items[0]->selling_price; ?></div>
				<div class="categoryChangeText" id="changeCategory">
					<div class="categoryChairText">Category : <?php echo $show_store_popup_items[0]->name; ?></div>
					<div class="changeItalicText" id="show_add_category">Change</div>
				</div>
				<div class="addCategory" id="add_category"><select class="addCategory" id="add_to_category"
				                                                   name="add_to_category"
				                                                   onChange="return moveCatRecordsByDropDown(this.value)">
						<option value="">add to category
						</option> <?php $total_cat = count($show_store_popup_cat); if ($total_cat > 0) {
							foreach ($show_store_popup_cat as $item): ?>
								<option
									value="<?php echo $item->storesection_id; ?>"><?php echo $item->name; ?></option> <?php endforeach;
						} ?> </select></div>
			</div>
			<div class="closeIcon" id="chairIconClose"></div>
		</div>
		<div class="popupChairImage"><img
				src="<?php echo $store_url; ?>assets/images/stores/<?php echo $show_store_popup_items[0]->mystoreid;?>/<?php echo $show_store_popup_items[0]->product_id;?>/img1_500x375.jpg"
				alt="popup image"
				onerror='this.src = "<?php echo $base_url; ?>assets/images/default/def_500x375.jpg" ;'/></div>
	</div>
</div>
<script>
	$("#chairIconClose").click(function () {
		$("#chairPopup").dialog('close');
	});
	$("#show_add_category").click(function () {
		$("#changeCategory").css("display", "none");
		$("#add_category").css("display", "block");
	});
	$("#add_to_category").selectbox();

	function moveCatRecordsByDropDown(value) {

		var store_id = $("#store_id").val();
		var baseurl = $('#baseurl').val();

		var allVals = [];
		var method = 'dropdownPopup';
		var popupHiddenProductId = $("#popupHiddenProductId").val();

		$.ajax({
			url: baseurl + "index.php/dashboard/move_store_category?productId=" + popupHiddenProductId + "&catId=" + value + "&method=" + method,
			async: false,
			success: function (data) {
				//alert(data);
			}
		});
	}
</script>