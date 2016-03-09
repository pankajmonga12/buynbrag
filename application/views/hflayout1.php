<?php $img1 = $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy1.jpg';
$img1 = getimagesize($img1); ?>
	<div class="fancyProductBigBg" style=" height: <?php echo $img1[1] + 65; ?>;">
		<div class="fancyProductBig"><a
				href="<?php echo $base_url?>order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
				<img
					src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy1.jpg'; ?>"
					alt="Product image"> </a></div>
		<div class="storeDecoratingText bigTrunc"><?php echo $fprod[$p]->product_name; ?> </div>
		<div class="fancyProductInfo"> <!-- <div class="storeDecoratingText font12">Copplestore</div>-->
			<div class="storeFancyHolder inlineBlock">
				<div class="fanciedIcon"></div>
				<div class="fancyNumber storeExtraStyle"><?php echo $fprod[$p]->fancy_counter; ?></div>
				<div class="fancyText storeExtraStyle">fancied</div>
			</div>
		</div>
		<!-- added by Rajeeb--> <?php if ($fprod[$p]->is_on_discount == 0) { ?>
			<div class="priceHolder"><span class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price); ?>
			</div> <?php } else { ?>
			<div class="priceHolder" style="height:40px;">
				<div><span class="rupee">`</span>
					<del><?php echo intval($fprod[$p]->selling_price); ?></del>
				</div>
				<div><span
						class="rupee">`</span> <?php echo intval($fprod[$p]->selling_price - $fprod[$p]->discount); ?>
				</div>
			</div> <?php }?> <!-- End-->
		<div class="fanciedByHolder">
			<a href="<?php echo base_url() . "order/friend_fancy_product/" . $fprod[$p]->user_id; ?>">
				<img
					src="<?php echo base_url() . "assets/images/users/" . $fprod[$p]->user_id . "/" . $fprod[$p]->user_id . ".jpg"; ?>"
					alt="<?php echo $fprod[$p]->full_name; ?>">
				Recently fancied by
				<span class="fanciedByName"><?php echo $fprod[$p]->full_name; ?></span>
			</a>

			<div class="fanciedRankHolder">
				Rank
				<span class="fanciedRank">
				<?php echo $fprod[$p]->rank; ?>
				</span>
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
					<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCY IT
					</div> <?php endif; ?> </div> <?php if (isset($poll_prods[$fprod[$p]->product_id])) : ?>
				<div class="PollHolder">
					<div class="hoverPoll"
					     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
					<div class="hoverText">POLLED</div>
				</div> <?php else: ?>
				<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
					<div class="hoverPoll" onClick="return AddPoll(<?php echo $fprod[$p]->product_id; ?>)"></div>
					<div class="hoverText">POLL IT</div>
				</div> <?php endif; ?> </div>
	</div> <?php $p++; ?>