<?php $total_row = count($select_store_category_items);
if ($total_row > 0)
{
    //echo mysql_num_rows($result);
    $j=0; foreach ($select_store_category_items as $items): $j++; ?>
	<input type="hidden" name="totalRowId" id="totalRowId" value="<?php echo $total_row; ?>"/>
	<div class="rightPanelContentRow">
		<div class="rightPanelContentRowBackground" id="changeBackground<?php echo $j; ?>"></div>
		<div class="rightPanelContentRow_1">
			<div class="chairItem1"><input type="hidden" name="hiddenProductId" id="hiddenProductId_<?php echo $j; ?>"
			                               value="<?php echo $items->product_id; ?>"/>

				<div class="checkbox_Holder">
					<div class="checkbox dynamicCheckboxes" id="checkbox<?php echo $j; ?>"
					     onClick="return changeColor2(<?php echo $j; ?>,<?php echo $total_row; ?>);"><input
							type="checkbox" name="check<?php echo $j; ?>" id="track_checkbox_<?php echo $j; ?>"/></div>
				</div>
				<div class="chairImage">
                    <img src="<?php echo $store_url."assets/images/stores/".$items->store_id."/".$items->product_id."/img1_40x40.jpg"; ?>" alt="chair 1"/>
                </div>
				<div class="chairCategoryText"><?php echo truncateOptionVal($items->product_name, 20); ?></div>
			</div>
			<div class="quantityTextContainerRow"><?php echo $items->quantity; ?></div>
			<div class="priceTextContainerRow"><span class="rupee">`</span>&nbsp;<?php echo $items->selling_price; ?>
			</div>
			<div class="actionTextContainerRow">
				<div class="actionEditImage"></div>
				<div class="actionCloseImage"></div>
			</div>
		</div>
	</div> <?php endforeach
	;
} else { ?>
	<div class="rightPanelContentRow">
		<div class="rightPanelContentRowBackground" style="font-size:20px;text-align:center">No Records</div>
	</div> <?php } function truncateOptionVal($text, $limit)
{
	$text = ucfirst(strtolower($text));
	if (strlen($text) > $limit) {
		$text = substr($text, 0, $limit) . '...';
	}
	return $text;
} ?>
<script type="text/javascript">
	$(".dynamicCheckboxes").dgStyl();
	$(".dynamicCheckboxes").click(function () {
		var flag = 0;
		$(".checkbox").each(function () {
			if ($(this).css("background-position") == '50% -33px' || $(".selectAll").css("background-position") == 'center -33px') {
				flag = 1;
				$(".move").show();
			}
		});
		if (flag == 0) {
			$(".move").hide();
		}
	});

	$(".chairImage,.chairCategoryText").click(function () {
		var baseurl = $('#baseurl').val();
		var currentPopUpItem = $(this).parent().find("input").val();
		var store_id = $('#store_id').val();

		$.ajax({
			url: baseurl + "index.php/dashboard/show_store_popup?currentPopUpItem=" + currentPopUpItem + "&store_id=" + store_id,
			async: false,
			success: function (data) {
				$("#chairPopup").html(data);
			}
		});
		$("#chairPopup").dialog({
			width: 552,
			height: 506,
			modal: true
		});
	});
	$("#chairIconClose").click(function () {
		$("#chairPopup").dialog('close');
	});

	function changeColor2(id, total_row) {
		for (var i = 1; i <= total_row; i++) {
			if (id == i) {
				if ($("#checkbox" + i).css("background-position") == '50% -33px' || $("#checkbox" + i).css("background-position") == 'center -33px') {
					$("#changeBackground" + i).css({"background-color": "#fff", "opacity": "1", "filter": "alpha(opacity=100)", "-khtml-opacity": "1", "-moz-opacity": "1", "-ms-filter": "'progid:DXImageTransform.Microsoft.Alpha(Opacity=100)'"});

				} else if ($("#checkbox" + i).css("background-position") == '50% 0px' || $("#checkbox" + i).css("background-position") == 'center 0px') {

					$("#changeBackground" + i).css({"background-color": "#F1EFF0", "opacity": "0.5", "filter": "alpha(opacity=50)", "-khtml-opacity": "0.5", "-moz-opacity": "0.5", "-ms-filter": "'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)'"});
				}
			}
		}
	}
</script>