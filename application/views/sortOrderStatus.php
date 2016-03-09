<?php $status = $_REQUEST['status']; $sortparam = $_REQUEST['sortparam']; $base_url = $_REQUEST['base_url']; $i = 0; foreach ($sort_order_status as $item): $i++; ?>
	<div class="stableGlassContainerRelative">
		<div class="stableGlassContainerTransp row_transp<?php echo $i + 1; ?>"></div>
		<div class="stableGlassContainer1" onMouseOver="return transp(<?php echo $i + 1; ?>)"
		     onMouseOut="return normal(<?php echo $i + 1; ?>)">
			<div class="stableGlassRelative">
				<div class="stableglassHolder"><a
						href="<?php echo $base_url;?>index.php/dashboard/order_details?tabName=<?php echo $status + 1; ?>&o_id=<?php echo $item->order_id; ?>&store_id=<?php echo $item->store_id; ?>"
						class="stableglassImage"><img
							src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_73x73.jpg"
							alt="<?php echo $item->product_name; ?>"/></a>

					<div class="stableglassText"><a
							href="<?php echo $base_url;?>index.php/dashboard/order_details?tabName=<?php echo $status + 1; ?>&o_id=<?php echo $item->order_id; ?>&store_id=<?php echo $item->store_id; ?>"
							class="stableglassHeading"><?php echo $item->product_name; ?></a>

						<div class="purchaseText">purchase date<span
								class="purchaseSpan"><?php echo $item->date_of_order; ?></span>
						</div> <?php /*?> <?php if($order['bedges']=='1') { ?> <div class="silverImage"><img src="images/guiter_badge.png" alt="guiter badge"/></div> <?php } else if($order['bedges']=='2'){ ?> <div class="silverImage"><img src="images/stable_badge.png" alt="stable"/></div> <?php } else { ?> <div class="silverImage"><img src="images/colourbottel_badge.png" alt="color bottle"/></div> <?php }?><?php */?>
					</div>
				</div>
				<div class="quantityRow1">
					<div class="qtyNumber paddingTOp25"><?php echo $item->quantity; ?></div>
				</div>
				<div class="quantityRow2">
					<div class="qtyNumber"><span class="rupee">`</span> <?php echo $item->selling_price; ?>
					</div> <?php if ($item->payment_status == '1') { ?>
						<div class="paidImage"><img src="<?php echo $base_url; ?>assets/images/paid.png" alt="paid"/>
						</div> <?php } else { ?>
						<div class="paidImage"><img src="<?php echo $base_url; ?>assets/images/cod.png" alt="cod"/>
						</div> <?php }?> </div>
				<div class="quantityRow3">
					<div class="qtyNumber"><span class="rupee">`</span> <?php echo $item->shipping_cost; ?></div>
				</div> <?php if ($item->status_order == '1') { ?>
					<div class="quantityRow4">
						<div class="processingAndProblem">
							<div class="startProcessTooltip">
								<div title="&nbsp;started processing" class="startProcessing startProcess nexttab"
								     onClick="return startProcessing(<?php echo $item->order_id; ?>)"></div>
							</div>
							<div class="processingProblemTooltip">
								<div title="Problem with Order" class="problemOrder problem_order problem_popup"
								     onClick="return change_to_problem_inorder(<?php echo $item->order_id; ?>)"></div>
							</div>
						</div>
					</div> <?php } else if ($item->status_order == '2') { ?>
					<div class="quantityRow4">
						<div class="processingImage">
							<div class="processingInnerImage"></div>
							<div class="shippingTxt" style="padding-right:6px;">Processing</div>
						</div>
						<div class="startProcessTooltip">
							<div title="Ready for Shipping" class="readyShipping startProcess"
							     onClick="return process_to_shipping(<?php echo $item->order_id; ?>)"></div>
						</div>
						<div class="processingProblemTooltip">
							<div title="Problem with Order" class="problemOrder problem_order problem_popup"
							     onClick="return change_to_problem_inorder(<?php echo $item->order_id; ?>)"></div>
						</div>
					</div> <?php } else if ($item->status_order == '3') { ?>
					<div class="quantityRow4">
						<div class="shippingImage" style="margin-top:22px;">
							<div class="shippingInnerImage"></div>
							<div class="shippingTxt">Shipping</div>
						</div>
						<div class="shippingDate"><span
								class="shippingSpan">&nbsp;at</span> <?php echo $item->date_of_pickup; ?>
							&nbsp;&nbsp; <?php echo $item->time_of_pickup; ?></div>
					</div> <?php } else if ($item->status_order == '4') { ?>
					<div class="quantityRow4">
						<div class="completedImage"></div>
						<div class="completedText">Completed</div>
					</div> <?php } else if ($item->status_order == '5') { ?>
					<div class="quantityRow4">
						<div class="cancelledImage"></div>
						<div class="completedText">Canceled</div>
					</div> <?php } else if ($item->status_order == '6') { ?>
					<div class="quantityRow4">
						<div class="problemWithOrderImage"></div>
						<div class="problrmWithOrderText">Problem with Order</div>
					</div> <?php }?>
				<div class="quantityRow5">
					<div class="communicationImage">
						<div class="communicationNumber"><?php echo $item->comment_count;?></div>
					</div>
				</div>
				<div class="pdfImage">
					<div class="pdf_icon"></div>
				</div>
				<div class="feedbackImage feed<?php echo $i + 1; ?>">Feedback</div>
			</div>
		</div>
	</div> <?php endforeach; ?> <?php function cleanString($movie_name, $displayChar)
{
	$movie_name1 = str_replace("_", " ", $movie_name);
	$movie_name2 = str_replace("-", " ", $movie_name1);
	$movie_name = trim($movie_name2);
	if ($movie_name == "") return "N/A";
	if (strlen($movie_name) >= $displayChar) return substr($movie_name, 0, $displayChar) . "&nbsp;..."; else return $movie_name;
} ?>
<div class="pickup_popup" id="pickupPopup">
	<div class="pickupPopupRelative">
		<div class="pickupPopupTransp"></div>
		<div class="pickup_mid">
			<div class="expected_header">
				<div class="expected_text">Expected Date & Time</div>
				<div class="pickup_close" id="pickup_close"></div>
			</div>
			<div class="expected_separator"></div>
			<div class="pickup_form">
				<div class="date_pickup">Date of Pick up</div>
				<div class="date_textfield">
					<div class="date_textfield_mid"><input type="text" id="ip_date" placeholder="date/month/year"/>
					</div>
				</div>
				<div class="clear_both">
					<div class="date_pickup">Pick up time</div>
					<div class="time_textfield">
						<div class="time_textfield_mid"><input type="text" id="ip_time" placeholder="hour:minute"/>
						</div>
					</div>
					<div class="amPm"><select id="timeCombo" name="time_combo">
							<option value="am">AM</option>
							<option value="pm">PM</option>
						</select></div>
				</div>
			</div>
			<div class="pickup_bottom">
				<div class="or_icon">OR</div>
				<div class="calling_text">Call</div>
				<div class="calling_icon">
					<div class="call_icon_image"></div>
					<div class="call_icon_text">+4407843555666</div>
				</div>
				<div class="proceed" id="pickupPopupProcees">Proceed</div>
			</div>
		</div>
	</div>
</div>
<div class="problemPopupContainer" id="problemPopupContainer">
	<div class="problemPopupRelative">
		<div class="problemPopupTransp"></div>
		<div class="problemPopupMiddle">
			<div class="headingAndClose">
				<div class="SendNoteHeading">Send a note to BnB</div>
				<div class="problemPopupClose"></div>
			</div>
			<div class="textAreaBox">
				<div class="problemTextareaMiddle"><textarea id="prob_textarea" class="problemTextareaMiddle">Please
						state your problem</textarea></div>
			</div>
			<div class="problembottom">
				<div class="send_icon" id="send_note_to_bnb">Send</div>
				<div class="or_text">or</div>
				<div class="calling_text">Call</div>
				<div class="calling_icon">
					<div class="call_icon_image"></div>
					<div class="call_icon_text">+4407843555666</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$("#timeCombo").selectbox();
	$(".startProcess,.problem_order").tooltip({
		track: true,
		delay: "0",
		showBody: "-",
		extraClass: "pretty fancy",
	});
	$("#pickupPopup").dialog({
		autoOpen: false,
		width: 445,
		height: 308,
		modal: true
	});

	$("#problemPopupContainer").dialog({
		autoOpen: false,
		width: 583,
		height: 292,
		modal: true
	});
	$('.readyShipping').unbind('click');
	$(".readyShipping").click(function () {

		$("#pickupPopup").dialog('open');
	});
	$('#pickup_close').unbind('click');
	$("#pickup_close").click(function () {

		$("#pickupPopup").dialog('close');
	});
	$('.problem_popup').unbind('click');
	$(".problem_popup").click(function () {
		$("#problemPopupContainer").dialog('open');


	});
	$('.problemPopupClose').unbind('click');
	$(".problemPopupClose").click(function () {
		$("#problemPopupContainer").dialog('close');
	});


</script>