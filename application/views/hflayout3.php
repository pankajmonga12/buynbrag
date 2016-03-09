<?php
$img1 = $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg';
$img1 = getimagesize($img1);
$img2 = $store_url . 'assets/images/stores/' . $fprod[$p + 1]->store_id . '/' . $fprod[$p + 1]->product_id . '/fancy3.jpg';
$img2 = getimagesize($img2);
$img3 = $store_url . 'assets/images/stores/' . $fprod[$p + 2]->store_id . '/' . $fprod[$p + 2]->product_id . '/fancy3.jpg';
$img3 = getimagesize($img3);
if ($img1 > $img2 && $img1 > $img3)
	$height = $img1[1];
elseif ($img2 > $img3)
	$height = $img2[1]; else
	$height = $img3[1];
?>
<div class="fancyProductSmallContainer">
<div class="fancyProductSmallBg" style=" height: <?php echo $height + 65; ?>px;">
	<div class="fancyProductSmall" style=" height: <?php echo $height; ?>px;">
		<a href="<?php echo $base_url?>order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
			<img
				src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg'; ?>"
				alt="Product image">
		</a>
	</div>
	<div class="storeDecoratingText smallTrunc"><?php echo $fprod[$p]->product_name; ?></div>
	<div class="fancyProductInfo">
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
	<!-- added by Rajeeb-->
	<?php
	if ($fprod[$p]->is_on_discount == 0) {
		?>
		<div class="priceHolder">
			<span class="rupee">`</span>
			<?php echo intval($fprod[$p]->selling_price); ?>
		</div>
	<?php
	} else {
		?>
		<div class="priceHolder" style="height:40px;">
			<div>
				<span class="rupee">`</span>
				<del><?php echo intval($fprod[$p]->selling_price); ?></del>
			</div>
			<div>
				<span class="rupee">`</span>
				<?php echo intval($fprod[$p]->selling_price - $fprod[$p]->discount); ?>
			</div>
		</div>
	<?php
	}
	?>
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
	<!-- End-->
	<div class="hoverHolder3">
		<div class="fancyHolder" id="fancyHolder<?php echo $fprod[$p]->product_id; ?>"
		     onClick="<?php echo (isset($fancied_prods[$fprod[$p]->product_id])) ? "unFancyProduct(" . $fprod[$p]->product_id . ", this.id)" : "fancyProduct(" . $fprod[$p]->product_id . ", this.id)";?>">
			<?php if (isset($fancied_prods[$fprod[$p]->product_id])): ?>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldDiv1"
				       id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
				<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
				<div class="editFancynext" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
				<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">UNFANCY</div>
			<?php else: ?>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldDiv1"
				       id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
				<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
				<div class="hoverFancy" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
				<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCY IT</div>
			<?php endif; ?>
		</div>
		<?php if (isset($poll_prods[$fprod[$p]->product_id])) : ?>
			<div class="PollHolder">
				<div class="hoverPoll"
				     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
				<div class="hoverText">POLLED</div>
			</div>
		<?php else: ?>
			<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
				<div class="hoverPoll" onClick="return AddPoll(<?php echo $fprod[$p]->product_id; ?>)"></div>
				<div class="hoverText">POLL IT</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php $p++; ?>
<div class="fancyProductSmallBg" style=" height: <?php echo $height + 65; ?>px;">
	<div class="fancyProductSmall" style=" height: <?php echo $height; ?>px;">
		<a href="<?php echo $base_url?>order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
			<img
				src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg'; ?>"
				alt="Product image">
		</a>
	</div>
	<div class="storeDecoratingText smallTrunc">
		<?php echo $fprod[$p]->product_name; ?>
	</div>
	<div class="fancyProductInfo">
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
	<!-- added by Rajeeb-->
	<?php if ($fprod[$p]->is_on_discount == 0) {
		?>
		<div class="priceHolder">
			<span class="rupee">`</span>
			<?php echo intval($fprod[$p]->selling_price); ?>
		</div>

	<?php
	} else {
		?>
		<div class="priceHolder" style="height:40px;">
			<div>
				<span class="rupee">`</span>
				<del><?php echo intval($fprod[$p]->selling_price); ?></del>
			</div>
			<div>
				<span class="rupee">`</span>
				<?php echo intval($fprod[$p]->selling_price - $fprod[$p]->discount); ?>
			</div>
		</div>
	<?php
	}
	?>
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
	<!-- End-->
	<div class="hoverHolder3">
		<div class="fancyHolder" id="fancyHolder<?php echo $fprod[$p]->product_id; ?>"
		     onClick="<?php echo (isset($fancied_prods[$fprod[$p]->product_id])) ? "unFancyProduct(" . $fprod[$p]->product_id . ", this.id)" : "fancyProduct(" . $fprod[$p]->product_id . ", this.id)";?>">
			<?php if (isset($fancied_prods[$fprod[$p]->product_id])): ?>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldDiv1"
				       id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
				<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
				<div class="editFancynext" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
				<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">UNFANCY</div>
			<?php else: ?>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldDiv1"
				       id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
				<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
				<div class="hoverFancy" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
				<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCY IT</div>
			<?php endif; ?>
		</div>
		<?php if (isset($poll_prods[$fprod[$p]->product_id])) : ?>
			<div class="PollHolder">
				<div class="hoverPoll"
				     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
				<div class="hoverText">POLLED</div>
			</div>
		<?php else: ?>
			<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
				<div class="hoverPoll" onClick="return AddPoll(<?php echo $fprod[$p]->product_id; ?>)"></div>
				<div class="hoverText">POLL IT</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php $p++; ?>
<div class="fancyProductSmallBg margin_right0" style=" height: <?php echo $height + 65; ?>px;">
	<div class="fancyProductSmall" style=" height: <?php echo $height; ?>px;">
		<a href="<?php echo $base_url?>order/product_page/<?php echo $fprod[$p]->store_id; ?>/<?php echo $fprod[$p]->product_id; ?>">
			<img
				src="<?php echo $store_url . 'assets/images/stores/' . $fprod[$p]->store_id . '/' . $fprod[$p]->product_id . '/fancy3.jpg'; ?>"
				alt="Product image">
		</a>
	</div>
	<div class="storeDecoratingText smallTrunc"><?php echo $fprod[$p]->product_name; ?></div>
	<div class="fancyProductInfo">
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
	<!-- added by Rajeeb-->
	<?php
	if ($fprod[$p]->is_on_discount == 0) {
		?>
		<div class="priceHolder">
			<span class="rupee">`</span>
			<?php echo intval($fprod[$p]->selling_price); ?>
		</div>
	<?php
	} else {
		?>
		<div class="priceHolder" style="height:40px;">
			<div>
				<span class="rupee">`</span>
				<del><?php echo intval($fprod[$p]->selling_price); ?></del>
			</div>
			<div>
				<span class="rupee">`</span>
				<?php echo intval($fprod[$p]->selling_price - $fprod[$p]->discount); ?>
			</div>
		</div>
	<?php
	}
	?>
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
	<!-- End-->
	<div class="hoverHolder3">
		<div class="fancyHolder" id="fancyHolder<?php echo $fprod[$p]->product_id; ?>"
		     onClick="<?php echo (isset($fancied_prods[$fprod[$p]->product_id])) ? "unFancyProduct(" . $fprod[$p]->product_id . ", this.id)" : "fancyProduct(" . $fprod[$p]->product_id . ", this.id)";?>">
			<?php if (isset($fancied_prods[$fprod[$p]->product_id])): ?>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldDiv1"
				       id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
				<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
				<div class="editFancynext" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
				<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">UNFANCY</div>
			<?php else: ?>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldDiv1"
				       id="hiddenFieldDiv<?php echo $fprod[$p]->product_id; ?>"/>
				<input type="hidden" value="<?php echo $fprod[$p]->store_id; ?>" class="hiddenFieldStoreid"/>
				<input type="hidden" value="<?php echo $fprod[$p]->product_id; ?>" class="hiddenFieldProductid"/>
				<div class="hoverFancy" id="hoverFancy<?php echo $fprod[$p]->product_id; ?>"></div>
				<div class="hoverText" id="hoverText<?php echo $fprod[$p]->product_id; ?>">FANCY IT</div>
			<?php endif; ?>
		</div>
		<?php if (isset($poll_prods[$fprod[$p]->product_id])) : ?>
			<div class="PollHolder">
				<div class="hoverPoll"
				     style="background-image: url(<?php echo $base_url; ?>assets/images/polled.png);"></div>
				<div class="hoverText">POLLED</div>
			</div>
		<?php else: ?>
			<div id="poll_<?php echo $fprod[$p]->product_id; ?>" class="PollHolder">
				<div class="hoverPoll" onClick="return AddPoll(<?php echo $fprod[$p]->product_id; ?>)"></div>
				<div class="hoverText">POLL IT</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php $p++; ?>
</div>