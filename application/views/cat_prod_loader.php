<?php for ($i = 0; $i < count($products); $i++): ?> <?php if (($i % 3) == 0) {
	$class = "rightPanelImageHolders clear_both";
	$class2 = "discountContainer";
} elseif (($i % 3) == 1) {
	$class = "rightPanelImageHolders";
	$class2 = "discountContainer";
} elseif (($i % 3) == 2) {
	$class = "rightPanelImageHolders productMarginNone";
	$class2 = "discountContainer rightStyle";
} ?>
	<div class="store-list1 message_box"
	     id="<?php echo $products[$i]->product_id; ?>"> <?php if ($products[$i]->is_on_discount == 1): ?>
			<div class="<?php echo $class2; ?>">
				<div
					class="numberPercent"><?php echo (floor($products[$i]->discount / $products[$i]->selling_price * 100)); ?> </div>
				<div class="percentSign">%</div>
				<div class="offPercent clear_both">OFF</div>
			</div> <?php endif; ?>
		<div
			class="<?php echo $class; ?>"> <?php //echo (floor($products[$i]->discount/$products[$i]->selling_price*100)); ?>
			<a href="<?php echo $base_url?>order/product_page/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>">
				<img
					src="<?php echo $store_url; ?>assets/images/stores/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>/img1_240x200.jpg"/>
			</a>

			<div class="storeDecoratingText"><?php echo $products[$i]->product_name; ?></div>
			<div class="fl">
				<div class="storeDecoratingText stor_nm font12"><?php echo $products[$i]->store_name; ?></div>
				<div class="storeFancyHolder">
					<div class="fanciedIcon"></div>
					<div class="fancyNumber storeExtraStyle"><?php echo $products[$i]->fancy_counter; ?></div>
					<div class="fancyText storeExtraStyle">fancied</div>
				</div>
			</div> <?php if ($products[$i]->is_on_discount == 0) { ?>
				<div class="priceHolder" id="<?php echo intval($products[$i]->selling_price); ?>"
				     perc="<?php echo floor($products[$i]->discount / $products[$i]->selling_price * 100); ?>"><span
						class="rupee">`</span> <?php echo intval($products[$i]->selling_price); ?>
				</div> <?php } else { ?>
				<div class="priceHolder"
				     id="<?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>"
				     perc="<?php echo floor($products[$i]->discount / $products[$i]->selling_price * 100); ?>"
				     style="height:40px; width:85px">
					<div><span class="rupee">`</span>
						<del><?php echo intval($products[$i]->selling_price); ?></del>
					</div>
					<div><span
							class="rupee">`</span> <?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>
					</div>
				</div> <?php }?> </div>
		<div class="hoverHolder">
			<div class="fancyHolder"> <?php if (isset($fancied_prods[$products[$i]->product_id])): ?> <input
					type="hidden" value="<?php echo $products[$i]->product_id; ?>" class="hiddenFieldDiv1"
					id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/> <input type="hidden"
			                                                                             value="<?php echo $products[$i]->store_id; ?>"
			                                                                             class="hiddenFieldStoreid"/>
					<input type="hidden" value="<?php echo $products[$i]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancyNext" id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $products[$i]->product_id; ?>">FANCIED
					</div> <?php else: ?> <input type="hidden" value="<?php echo $products[$i]->product_id; ?>"
			                                     class="hiddenFieldDiv1"
			                                     id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/> <input
					type="hidden" value="<?php echo $products[$i]->store_id; ?>" class="hiddenFieldStoreid"/> <input
					type="hidden" value="<?php echo $products[$i]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancy" id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $products[$i]->product_id; ?>">FANCY
					</div> <?php endif; ?> </div> <?php if (isset($poll_prods[$products[$i]->product_id])) : ?>
				<div class="PollHolder">
					<div class="hoverPoll"
					     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
					<div class="hoverText">POLLED</div>
				</div> <?php else: ?>
				<div id="poll_<?php echo $products[$i]->product_id; ?>" class="PollHolder">
					<div class="hoverPoll" onClick="return AddPoll(<?php echo $products[$i]->product_id; ?>)"></div>
					<div class="hoverText">POLL</div>
				</div> <?php endif; ?>
		</div> <?php if ($products[$i]->quantity > 0) $soldout = "display:none"; else $soldout = " "; ?>
		<div class="soldout" style="<?php echo $soldout; ?>"></div>
	</div> <?php endfor; ?>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script>

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
			modal: true
		});
		$(".width_style_fancy").click(function () {
			$("#fancyPopup").dialog('close');
		});
	}

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