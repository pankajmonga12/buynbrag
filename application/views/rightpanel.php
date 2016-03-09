<?php $base_url = base_url(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_store.js"></script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_lists.js"></script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
	<script type="text/javascript"
	        src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script> <?php if (isset($prods)) for ($i = 0; $i < count($prods); $i++): ?> <?php //if ( $i == 0 ) //$class="rightPanelImageHolders"; if ( ($i%3) == 0 ) $class="rightPanelImageHolders clear_both"; if ( ($i%3) == 1 ) $class="rightPanelImageHolders marginRight0"; elseif ( ($i%3) == 2 ) $class="rightPanelImageHolders marginRight0"; ?>
	<div class="<?php echo $class;?>"><a
			href="<?php echo $base_url?>order/product_page/<?php echo $prods[$i]->store_id; ?>/<?php echo $prods[$i]->product_id; ?>">
			<img
				src="<?php echo $store_url; ?>assets/images/stores/<?php echo $prods[$i]->store_id;?>/<?php echo $prods[$i]->product_id;?>/img1_product.jpg"
				width="240" height="200" alt="product image"/> </a>

		<div class="storeDecoratingText"><?php echo $prods[$i]->product_name;?></div>
		<div class="fl">
			<div class="storeDecoratingText font12"><?php echo $prods[$i]->store_name;?></div>
			<div class="storeFancyHolder">
				<div class="fanciedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $prods[$i]->fancy_counter;?></div>
				<div class="fancyText storeExtraStyle">fancied</div>
			</div>
		</div>
		<div class="priceHolder"><span class="rupee">`</span><?php echo intval($prods[$i]->selling_price);?></div>
	</div> <!-- <div class="hoverHolder"> <div class="fancyHolder"> <input type="hidden" value="1" class="hiddenFieldDiv1"/> <div class="hoverFancy" id="hoverFancy1"></div> <div class="hoverText" id="hoverText1">FANCY</div> </div> <div class="PollHolder"> <div class="hoverPoll"></div> <div class="hoverText">POLL</div>--> <!-- </div> </div> --> <?php endfor; ?>