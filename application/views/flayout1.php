<?php $img1 = $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy1.jpg';
$img1 = getimagesize($img1); ?>
	<div class="fancyProductBigBg" style=" height: <?php echo $img1[1] + 65; ?>px;">
		<div class="fancyProductBig"><a
				href="<?php echo $base_url?>order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
				<img
					src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy1.jpg'; ?>"
					alt="Product image"> </a></div>
		<div class="fancyProductInfo">
			<div class="storeDecoratingText bigTrunc"><?php echo $fprod[$p]->product_name; ?> </div>
			<!-- <div class="storeDecoratingText font12">Copplestore</div>-->
			<div class="storeFancyHolder inlineBlock">
				<div class="fanciedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->fancy_counter; ?></div>
				<div class="fancyText storeExtraStyle">fancied</div>
			</div>
		</div>
		<div class="hoverHolder1">
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
					</div> <?php endif; ?> </div> <?php if (isset($poll_prods[$fprod[$p]->product_id])) : ?>
				<div class="PollHolder">
					<div class="hoverPoll"
					     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
					<div class="hoverText">POLLED</div>
				</div> <?php else: ?>
				<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
					<div class="hoverPoll" onClick="return AddPoll(<?php echo $fprod[$p]->product_id; ?>)"></div>
					<div class="hoverText">POLL</div>
				</div> <?php endif; ?> </div>
	</div> <?php $p++; ?>