<?php $base_url = base_url(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/product_page.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_unfancy.js"></script>
<div class="checkboxesHolder2">
	<div class="checkBoxText" id="checbox_text_0"
	     style="background-color:#fff;"> <?php if(isset($default)): // if($default[0]->fancy_list_name==$def[0]->fancy_list_name):?>
		<div class="checkbox" id="checkbox" style="background-position: center -33px;"><input type="checkbox"
		                                                                                      name="checkbox5"
		                                                                                      value="<?php echo $def[0]->fancy_list_name;?>"/>
		</div>
		<div class="checkText2"><?php echo $def[0]->fancy_list_name;?></div>
	</div> <?php endif;?> <?php if (isset($userdef)): ?> <?php for ($j = 0; $j < count($userdef); $j++): ?>
		<div class="checkBoxText" id="checbox_text_<?php echo $j;?>_<?php echo $j?>">
			<div class="checkbox checkit" id="checkbox"><input type="checkbox" name="checkbox5"
			                                                   value="<?php echo $userdef[$j];?>" checked="checked"/>
			</div>
			<div class="checkText2"><?php echo $userdef[$j];?></div>
		</div> <?php endfor; ?> <?php else: for ($j = 0; $j < count($user); $j++): ?>
		<div class="checkBoxText" id="checbox_text_<?php echo $j;?>_<?php echo $j?>">
			<div class="checkbox checkit" id="checkbox"><input type="checkbox" name="checkbox5"
			                                                   value="<?php echo $user[$j]->fancy_list_name;?>"/></div>
			<div class="checkText2"><?php echo $user[$j]->fancy_list_name;?></div>
		</div> <?php endfor; ?> <?php endif;?> <?php if (isset($diff_arr)): ?> <?php for ($j = 0; $j < count($diff_arr); $j++): ?>
		<div class="checkBoxText" id="checbox_text_<?php echo $j;?>_<?php echo $j?>">
			<div class="checkbox checkit" id="checkbox"><input type="checkbox" name="checkbox5"
			                                                   value="<?php echo $diff_arr[$j];?>"/></div>
			<div class="checkText2"><?php echo $diff_arr[$j];?></div>
		</div> <?php endfor; ?> <?php endif;?> </div>