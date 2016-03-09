<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/bill.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/> <?php $i = 0; $lastId = ""; foreach ($bill_ajax as $item): $i++;
	$lastId = $item->bill_id; ?>
	<div class="stableGlassContainerRelative message_box" id="<?php echo $item->bill_id; ?>">
		<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
		<div class="stableGlassContainer1" onMouseOver="return transparent(<?php echo $i + 1; ?>)"
		     onMouseOut="return norm(<?php echo $i + 1; ?>)">
			<div class="stableGlassRelative">
				<div class="invoiceNumberdetail"><?php echo $item->inv_number; ?>
					<div class="dateTextHolder">
						<div class="dateText">date</div>
						<div class="dateNumber"><?php echo $item->date_time; ?></div>
					</div>
				</div>
				<div class="transactionNumber"><?php echo $item->transaction; ?></div>
				<div class="transactionNumber transactionExtra"><span
						class="rupee">`</span><?php echo $item->bnb_commision; ?></div>
				<div class="transactionNumber logisticsExtra"><span
						class="rupee">`</span><?php echo $item->logistic_fee; ?></div>
				<div class="transactionNumber billAmountExtra"><span
						class="rupee">`</span><?php echo $item->bill_amt; ?></div>
				<div class="transactionNumber closingBalanceExtra"><span
						class="rupee">`</span><?php echo $item->closing_balance; ?></div>
				<div class="disputeBillIconHolder">
					<div title="Dispute Bill" class="disputeBillIcon showtooltip2"
					     onClick="return dispute(<?php echo $item->bill_id; ?>)"></div>
				</div>
				<div class="pdfIconHolder">
					<div class="pdfIcon"></div>
				</div>
			</div>
		</div>
	</div> <?php endforeach; ?>
<div class="problemPopupContainer" id="problemPopupContainer">
	<div class="problemPopupRelative">
		<div class="problemPopupTransp"></div>
		<div class="problemPopupMiddle">
			<div class="headingAndClose">
				<div class="SendNoteHeading">Send a note to BnB</div>
				<div class="problemPopupClose"></div>
			</div>
			<div class="textAreaBox">
				<div class="problemTextareaMiddle"><textarea id="prob_textarea" class="problemTextareaMiddle"
				                                             placeholder="Please state your problem"></textarea></div>
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


	$("#problemPopupContainer").dialog({
		autoOpen: false,
		width: 583,
		height: 292,
		modal: true
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
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/tooltip.js"></script>