<div class="middleContainer "> <?php if (count($fprod) > 5) {
		$loop = floor(count($fprod) / 5) . '<br>';
		$imgloop = count($fprod) % 5 . '<br>';
	} else {
		$imgloop = count($fprod) % 5 . '<br>';
	} $p = 0; ?> <?php if (isset($loop)) for ($i = 0; $i < $loop; $i++): ?> <?php $numbers = range(2, 3);
		shuffle($numbers); ?> <?php include "hflayout" . $numbers[0] . ".php"; ?> <?php include "hflayout" . $numbers[1] . ".php"; ?> <?php endfor; ?> <?php if ($imgloop == 4): ?> <?php include 'hflayout2.php'; ?> <?php include 'hflayout2.php'; ?> <?php elseif ($imgloop == 3): ?> <?php include 'hflayout3.php'; ?> <?php elseif ($imgloop == 2): ?> <?php include 'hflayout2.php'; ?> <?php endif; ?> </div>
<script src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/alt2.css"/>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/newview.js?auto"></script>
<script>
	function AddPoll(pid) {
		var sess_id = $('#sess_id').val();
		if (sess_id == 0) {
			$("#createAccountPopup").dialog('close');
			$("#homePagePopup").dialog({
				width: 439,
				height: 439,
				modal: true
			});
		}
		else {
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/ajax_poll/add_to_poll/" + pid,
				success: function (data) {
					$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');
				}

			});

			$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLING...</div>');

			/*$("#pollPopup").dialog({
			 width:605,
			 height:293,
			 modal:true
			 });
			 $("#pollclose").click(function(){
			 $("#pollPopup").dialog('close');
			 });
			 $("#alertclose").click(function(){
			 $("#pollPopup").dialog('close');
			 });	*/
		}
	}


</script>