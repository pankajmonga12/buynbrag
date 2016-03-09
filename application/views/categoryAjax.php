<?php $base_url = base_url(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/product_page.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_unfancy.js"></script> <?php $i = 0; ?>
<div class="checkboxesHolder2">
	<div class="checkBoxText" id="checbox_text_0" style="background-color:#fff;">
		<div class="checkbox" id="checkbox" style="background-position: center -33px;"><input checked="checked"
		                                                                                      type="checkbox"
		                                                                                      name="checkbox5"
		                                                                                      value="<?php echo $def[0]->fancy_list_name;?>"/>
		</div>
		<div class="checkText2"><?php echo $def[0]->fancy_list_name;?></div>
	</div> <?php foreach ($user as $item): $i++; ?>
		<div class="checkBoxText" id="checbox_text_<?php echo $i;?>_<?php echo $i?>">
			<div class="checkbox checkit" id="checkbox"><input type="checkbox" name="checkbox5"
			                                                   value="<?php echo $item->fancy_list_name;?>"/></div>
			<div class="checkText2"><?php echo $item->fancy_list_name;?></div>
		</div> <?php endforeach;?> </div>