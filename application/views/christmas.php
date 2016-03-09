<?php $img1 = $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg'; $img1 = getimagesize($img1); $img2 = $store_url . 'assets/images/stores/' . $fprod[$p + 1]->store_id . '/' . $fprod[$p + 1]->product_id . '/fancy3.jpg'; $img2 = getimagesize($img2); $img3 = $store_url . 'assets/images/stores/' . $fprod[$p + 2]->store_id . '/' . $fprod[$p + 2]->product_id . '/fancy3.jpg'; $img3 = getimagesize($img3); if ($img1 > $img2 && $img1 > $img3) $height = $img1[1]; elseif ($img2 > $img3) $height = $img2[1]; else $height = $img3[1]; ?>
<div class="fancyProductSmallContainer">
	<div class="fancyProductSmallBg" style=" height: <?php echo $height + 65; ?>px;">
		<div class="fancyProductSmall" style=" height: <?php echo $height; ?>px;"><a
				href="<?php echo $base_url?>index.php/order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
				<img
					src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg'; ?>"
					alt="Product image"> </a></div>
		<div class="fancyProductInfo">
			<div class="storeDecoratingText"><?php echo $fprod[$p]->product_name; ?></div>
			<!--<div class="storeDecoratingText font12">Copplestore</div>-->
			<div class="storeFancyHolder inlineBlock">
				<div class="fanciedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->fancy_counter; ?></div>
				<div class="fancyText storeExtraStyle">fancied</div>
				<div class="viewedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->visit_counter; ?></div>
				<div class="fancyText storeExtraStyle">viewed</div>
			</div>
		</div>
		<!-- added by Rajeeb--> <?php if ($result == 0) { ?>
			<div class="priceHolder"><span class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price); ?>
			</div> <?php }if ($result == 1) { ?>
			<div class="priceHolder" style="height:40px;">
				<div><span class="rupee">`</span>
					<del><?php echo intval($fprod[$p]->selling_price); ?></del>
				</div>
				<div><span class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price / 2); ?></div>
			</div> <?php }?> <!-- End-->
		<div class="hoverHolder3">
			<div class="fancyHolder"> <?php if (isset($fancied_prods[$fprod[$p]->product_id])): ?> <input type="hidden"
			                                                                                              value="<?php echo $fprod[$p]->product_id; ?>"
			                                                                                              class="hiddenFieldDiv1"
			                                                                                              id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
					<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/> <input
						type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancyNext" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCIED
					</div> <?php else: ?> <input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>"
			                                     class="hiddenFieldDiv1"
			                                     id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/> <input
					type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/> <input
					type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancy" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCY
					</div> <?php endif; ?> </div> <?php if (isset($bragged_prods[$fprod[$p]->product_id])) : ?>
				<div class="PollHolder">
					<div class="hoverBrag bragged"></div>
					<div class="hoverText">BRAGGED</div>
				</div> <?php else: ?>
				<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
					<div id="brag<?php echo $fprod[$p]->product_id; ?>" class="hoverBrag"
					     onClick="brag(<?php echo $fprod[$p]->store_id . ',' . $fprod[$p]->product_id; ?>);"></div>
					<div id="bragText<?php echo $fprod[$p]->product_id; ?>" class="hoverText">BRAG</div>
				</div> <?php endif; ?> </div>
	</div> <?php $p++; ?>
	<div class="fancyProductSmallBg" style=" height: <?php echo $height + 65; ?>px;">
		<div class="fancyProductSmall" style=" height: <?php echo $height; ?>px;"><a
				href="<?php echo $base_url?>index.php/order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
				<img
					src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg'; ?>"
					alt="Product image"> </a></div>
		<div class="fancyProductInfo">
			<div class="storeDecoratingText"><?php echo $fprod[$p]->product_name; ?></div>
			<!--<div class="storeDecoratingText font12">Copplestore</div>-->
			<div class="storeFancyHolder inlineBlock">
				<div class="fanciedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->fancy_counter; ?></div>
				<div class="fancyText storeExtraStyle">fancied</div>
				<div class="viewedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->visit_counter; ?></div>
				<div class="fancyText storeExtraStyle">viewed</div>
			</div>
		</div>
		<!-- added by Rajeeb--> <?php if ($result == 0) { ?>
			<div class="priceHolder"><span class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price); ?>
			</div> <?php }if ($result == 1) { ?>
			<div class="priceHolder" style="height:40px;">
				<div><span class="rupee">`</span>
					<del><?php echo intval($fprod[$p]->selling_price); ?></del>
				</div>
				<div><span class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price / 2); ?></div>
			</div> <?php }?> <!-- End-->
		<div class="hoverHolder3">
			<div class="fancyHolder"> <?php if (isset($fancied_prods[$fprod[$p]->product_id])): ?> <input type="hidden"
			                                                                                              value="<?php echo $fprod[$p]->product_id; ?>"
			                                                                                              class="hiddenFieldDiv1"
			                                                                                              id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
					<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/> <input
						type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancyNext" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCIED
					</div> <?php else: ?> <input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>"
			                                     class="hiddenFieldDiv1"
			                                     id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/> <input
					type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/> <input
					type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancy" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCY
					</div> <?php endif; ?> </div> <?php if (isset($bragged_prods[$fprod[$p]->product_id])) : ?>
				<div class="PollHolder">
					<div class="hoverBrag bragged"></div>
					<div class="hoverText">BRAGGED</div>
				</div> <?php else: ?>
				<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
					<div id="brag<?php echo $fprod[$p]->product_id; ?>" class="hoverBrag"
					     onClick="brag(<?php echo $fprod[$p]->store_id . ',' . $fprod[$p]->product_id; ?>);"></div>
					<div id="bragText<?php echo $fprod[$p]->product_id; ?>" class="hoverText">BRAG</div>
				</div> <?php endif; ?> </div>
	</div> <?php $p++; ?>
	<div class="fancyProductSmallBg margin_right0" style=" height: <?php echo $height + 65; ?>px;">
		<div class="fancyProductSmall" style=" height: <?php echo $height; ?>px;"><a
				href="<?php echo $base_url?>index.php/order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
				<img
					src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg'; ?>"
					alt="Product image"> </a></div>
		<div class="fancyProductInfo">
			<div class="storeDecoratingText"><?php echo $fprod[$p]->product_name; ?></div>
			<!--<div class="storeDecoratingText font12">Copplestore</div>-->
			<div class="storeFancyHolder inlineBlock">
				<div class="fanciedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->fancy_counter; ?></div>
				<div class="fancyText storeExtraStyle">fancied</div>
				<div class="viewedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->visit_counter; ?></div>
				<div class="fancyText storeExtraStyle">viewed</div>
			</div>
		</div>
		<!-- added by Rajeeb--> <?php if ($result == 0) { ?>
			<div class="priceHolder"><span class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price); ?>
			</div> <?php }if ($result == 1) { ?>
			<div class="priceHolder" style="height:40px;">
				<div><span class="rupee">`</span>
					<del><?php echo intval($fprod[$p]->selling_price); ?></del>
				</div>
				<div><span class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price / 2); ?></div>
			</div> <?php }?> <!-- End-->
		<div class="hoverHolder3">
			<div class="fancyHolder"> <?php if (isset($fancied_prods[$fprod[$p]->product_id])): ?> <input type="hidden"
			                                                                                              value="<?php echo $fprod[$p]->product_id; ?>"
			                                                                                              class="hiddenFieldDiv1"
			                                                                                              id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
					<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/> <input
						type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancyNext" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCIED
					</div> <?php else: ?> <input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>"
			                                     class="hiddenFieldDiv1"
			                                     id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/> <input
					type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/> <input
					type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
					<div class="hoverFancy" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
					<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCY
					</div> <?php endif; ?> </div> <?php if (isset($bragged_prods[$fprod[$p]->product_id])) : ?>
				<div class="PollHolder">
					<div class="hoverBrag bragged"></div>
					<div class="hoverText">BRAGGED</div>
				</div> <?php else: ?>
				<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
					<div id="brag<?php echo $fprod[$p]->product_id; ?>" class="hoverBrag"
					     onClick="brag(<?php echo $fprod[$p]->store_id . ',' . $fprod[$p]->product_id; ?>);"></div>
					<div id="bragText<?php echo $fprod[$p]->product_id; ?>" class="hoverText">BRAG</div>
				</div> <?php endif; ?> </div>
	</div> <?php $p++; ?> </div>