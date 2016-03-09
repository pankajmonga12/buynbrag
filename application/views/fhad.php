<article class="landingBanner">
	<div class="waytostoreBanner">
		<div class="topleftDeco"></div>
		<div class="whiteBox1"><a
				href="<?php echo $base_url . 'order/product_page/' . $banner_prod[0]->store_id . '/' . $banner_prod[0]->product_id; ?>">
				<img width="120px" height="120px"
				     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $banner_prod[0]->store_id; ?>/<?php echo $banner_prod[0]->product_id; ?>/img1_171x171.jpg"/>
			</a>

			<div class="bprodText"><?php echo $banner_prod[0]->product_name; ?></div>
			<div class="bpriceText"><?php echo $banner_prod[0]->selling_price - $banner_prod[0]->discount; ?></div>
			<!-- <div class="ytext">Yahoo<br></div>--> </div>
		<div class="leftBanner">
			<div class="bannerHeadingText"><?php echo $h; ?></div>
			<div class="bannerBottomTextBottom"><?php echo $t1; ?>
				<div> <?php echo $t2; ?></div>
			</div>
			<div class="bottomrightDeco"></div>
		</div>
		<div class="toprightDeco"></div>
		<div class="whiteBox2"><a
				href="<?php echo $base_url . 'order/product_page/' . $banner_prod[1]->store_id . '/' . $banner_prod[1]->product_id; ?>">
				<img width="120px" height="120px"
				     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $banner_prod[1]->store_id; ?>/<?php echo $banner_prod[1]->product_id; ?>/img1_171x171.jpg"/>
			</a>

			<div class="bprodText"><?php echo $banner_prod[1]->product_name; ?></div>
			<div class="bpriceText"><?php echo $banner_prod[1]->selling_price - $banner_prod[1]->discount; ?></div>
			<!-- <div class="ytext">Yahoo<br></div>--> </div>
		<div class="whiteBox3"><a
				href="<?php echo $base_url . 'order/product_page/' . $banner_prod[2]->store_id . '/' . $banner_prod[2]->product_id; ?>">
				<img width="120px" height="120px"
				     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $banner_prod[2]->store_id; ?>/<?php echo $banner_prod[2]->product_id; ?>/img1_171x171.jpg"/>
			</a>

			<div class="bprodText"><?php echo $banner_prod[2]->product_name; ?></div>
			<div class="bpriceText"><?php echo $banner_prod[2]->selling_price - $banner_prod[2]->discount; ?></div>
			<!-- <div class="ytext">Yahoo<br></div>--> </div>
	</div>
</article>