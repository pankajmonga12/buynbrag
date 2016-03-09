<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/promote_discount_summary.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
<link rel="stylesheet" type="text/css"
      href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/> <?php $i = 0; $lastId = ""; foreach ($promotion_ajax as $item): $i++;
	$lastId = $item->id; ?>
	<div class="stableGlassContainerRelative message_box" id="<?php echo $item->id; ?>">
		<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
		<div class="stableGlassContainer1" onMouseOver="return transp(<?php echo $i + 1; ?>)"
		     onMouseOut="return normal(<?php echo $i + 1; ?>)">
			<div class="stableGlassRelative"> <?php if ($item->discount_on_type == 0) { ?>
					<div class="stableglassHolderProducts">
						<div class="promoteStoreImage"><img
								src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/top_banner.png"
								alt="promote store"/></div>
					</div> <?php } else if ($item->discount_on_type == 1) { ?>
					<div class="stableglassHolderProducts">
						<div class="stableglassImage"><img
								src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->storeowner_id; ?>/img1_73x73.jpg"
								alt="<?php echo $item->store_name; ?>"/></div>
						<div class="stableglassText">
							<div class="stableglassHeading"><?php echo $item->store_name; ?></div>
						</div>
					</div> <?php } else { ?>
					<div class="stableglassHolderProducts">
						<div class="shoesSocksText">
							<div class="stableglassHeading"><?php echo $item->store_name; ?></div>
							<div class="category_text">category</div>
						</div>
					</div> <?php } ?>
				<div class="categoriesColumn">
					<div class="priceAmount">
						<div
							style="text-align:center;"><?php if ($item->promotion_type == 0) { ?> Percentage Off<?php } else { ?> Rupee Off<?php }?></div>
						<div style="text-align:center;"><?php echo $item->discount;?></div>
					</div>
				</div> <?php if ($item->expiry_type == 0) { ?>
					<div class="priceColumn">
						<div class="priceAmount">Unlimited</div>
					</div> <?php } else if ($item->expiry_type == 1) { ?> <?php $arr = get_time_difference($item->applied_on, $item->expiry_date); ?>
					<div class="priceColumn">
						<div class="priceAmount"><?php echo $arr['days']?> days</div>
					</div> <?php } else { ?>
					<div class="priceColumn">
						<div class="priceAmount"><?php echo $item->max_can_used; ?> Users</div>
					</div> <?php }?>
				<div class="quantityColumn">
					<div class="priceAmount"><?php echo $item->no_of_used; ?> used</div>
				</div>
				<div class="statusColumn"> <?php if ($item->status == 0) { ?>
						<div class="checkbox"><input id="check_<?php echo $status; ?>_<?php echo $i + 1; ?>" name="1"
						                             value="<?php echo $item->discount_on_type; ?>_<?php echo $item->storeowner_id; ?>"
						                             type="checkbox" checked="false"><label
								for="check_<?php echo $status; ?>_<?php echo $i + 1; ?>"></label>
						</div> <?php } else { ?>
						<div class="checkbox"><input id="check_<?php echo $status; ?>_<?php echo $i + 1; ?>" name="1"
						                             value="<?php echo $item->discount_on_type; ?>_<?php echo $item->storeowner_id; ?>"
						                             type="checkbox"><label
								for="check_<?php echo $status; ?>_<?php echo $i + 1; ?>"></label></div> <?php }?> </div>
				<div class="actionColumn"><a
						href="<?php echo $base_url;?>index.php/promote/editpromote/<?php echo $store_id; ?>/<?php echo $item->discount_on_type; ?>/<?php echo $item->id; ?>">
						<div class="actionEdit"></div>
					</a>

					<div class="actionClose"
					     onclick="deletePromote(<?php echo $item->discount_on_type; ?>,<?php echo $item->storeowner_id;?>)"></div>
				</div>
			</div>
		</div>
	</div> <?php endforeach; ?> <?php function get_time_difference($time, $time1)
{
	$uts['end'] = strtotime($time1);
	$uts['start'] = strtotime($time);
	if ($uts['start'] !== -1 && $uts['end'] !== -1) {
		if ($uts['end'] >= $uts['start']) {
			$diff = $uts['end'] - $uts['start'];
			if ($days = intval((floor($diff / 86400)))) $diff = $diff % 86400;
			if ($hours = intval((floor($diff / 3600)))) $diff = $diff % 3600;
			if ($minutes = intval((floor($diff / 60)))) $diff = $diff % 60;
			$diff = intval($diff);
			return (array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $diff));
		} else {
			trigger_error("Ending date/time is earlier than the start date/time", E_USER_WARNING);
		}
	} else {
		trigger_error("Invalid date/time data detected", E_USER_WARNING);
	}
	return (false);
} ?>
<script type="text/javascript" src="<?php echo $base_url;?>assets/js/promote_discount_single_product.js"></script>