<div class="bigImageRow"> <?php $i = 0; foreach ($randomProduct as $item): $i++;
		if ($i > 4) break;
		$img = explode('.', (string)$item->image1_path);
		if ($i != 4) { ?>
			<div title=" " class="ImageBackground"><input type="hidden" value="<?php echo $item->product_id;?>"/><img
					src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/<?php echo ($img[0] . "_161x134." . $img[1]) ?>"
					alt="<?php echo $item->product_name;?>"/></div> <?php } else { ?>
			<div title=" " class="ImageBackground marginRight0"><input type="hidden"
			                                                           value="<?php echo $item->product_id;?>"/><img
					src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/<?php echo ($img[0] . "_161x134." . $img[1]) ?>"
					alt="<?php echo $item->product_name;?>"/></div> <?php } endforeach;?> </div>
<div class="bigImageRow"> <?php $i = 0; foreach ($randomProduct as $item): $i++;
		if ($i <= 4) continue;
		if ($i == 9) break;
		$img = explode('.', (string)$item->image1_path);
		if ($i < 8) { ?>
			<div title=" " class="ImageBackground"><input type="hidden" value="<?php echo $item->product_id;?>"/><img
					src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/<?php echo ($img[0] . "_161x134." . $img[1]) ?>"
					alt="<?php echo $item->product_name;?>"/></div> <?php } else { ?>
			<div title=" " class="ImageBackground marginRight0"><input type="hidden"
			                                                           value="<?php echo $item->product_id;?>"/><img
					src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/<?php echo ($img[0] . "_161x134." . $img[1]) ?>"
					alt="<?php echo $item->product_name;?>"/></div> <?php } endforeach;?> </div>
<div class="bigImageRow"> <?php $i = 0; foreach ($randomProduct as $item): $i++;
		if ($i <= 8) continue;
		if ($i == 13) break;
		$img = explode('.', (string)$item->image1_path);
		if ($i < 12) { ?>
			<div title=" " class="ImageBackground"><input type="hidden" value="<?php echo $item->product_id;?>"/><img
					src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/<?php echo ($img[0] . "_161x134." . $img[1]) ?>"
					alt="<?php echo $item->product_name;?>"/></div> <?php } else { ?>
			<div title=" " class="ImageBackground marginRight0"><input type="hidden"
			                                                           value="<?php echo $item->product_id;?>"/><img
					src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/<?php echo ($img[0] . "_161x134." . $img[1]) ?>"
					alt="<?php echo $item->product_name;?>"/></div> <?php } endforeach;?> </div>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/take_taste_test2.js"></script>