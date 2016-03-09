<?php for ($i = 0; $i < count($store); $i++): $sid = '_' . $store[$i]->store_id; ?> <?php //Generate a random number for fetching images -AS $max = count($sprod["$sid"])-1; //$max."_".count($store); $tm1 = mt_rand(0, $max); $tm2 = mt_rand(0, $max); $tm3 = mt_rand(0, $max); //Condition check for slider -AS if ( ($i%2)==0 ) { $class="images_holder clear_both"; } else { $class="images_holder image2margin"; } ?>
	<a href="<?php echo $base_url?>order/store_page/<?php echo $store[$i]->store_id; ?>">
		<div class="<?php echo $class; ?> message_box" id="<?php echo $store[$i]->store_id; ?>"><img
				src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm1"]->product_id; ?>/img1_product.jpg"
				alt="big image"/>

			<div class="banner_Image"><img
					src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/top_banner.png"/>
			</div>
			<div class="smallImage"><img
					src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm2"]->product_id; ?>/img1_product.jpg"/>
			</div>
			<div class="mediumImage"><img
					src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm3"]->product_id; ?>/img1_product.jpg"
					alt="medium image"/></div>
			<div class="fancyBragedHolder">
				<div class="fancy_Icon"></div>
				<div class="fancy_number"><?php echo $store[$i]->fancy_counter; ?></div>
				<div class="fancy_name">Fancied</div>
				<div class="brag_Icon clear_both"></div>
				<div class="fancy_number"><?php echo $store[$i]->brag_counter; ?></div>
				<div class="fancy_name">Braged</div>
			</div>
			<div class="product_number"> <?php echo $max + 1; ?>
				<div class="braged_name">Products</div>
			</div>
		</div>
	</a> <?php endfor; ?>