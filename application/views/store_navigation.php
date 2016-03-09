<article class="banner">
	<div class="slide">
		<div class="bannerHolder">
			<div class="bannerLogo"><img
					src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info_var[0]->store_id; ?>/top_banner.png"/>
			</div>
			<div class="bannerText newbannerText">
				<div class="bannerTextHolder newbannerTextHolder">
					<div class="bannerShopText">Shop URL :</div>
					<div class="bannerURLText"><?php echo $store_info_var[0]->store_url; ?></div>
				</div>
			</div>
			<div class="bannerIconsHolder">
				<div class="fancyHolder">
					<div class="fancyIcon"></div>
					<div class="fancyTextHolder">
						<div class="fancyNumber"><?php echo $store_info_var[0]->fancy_counter; ?></div>
						<div class="fancyText">fancied</div>
					</div>
				</div>
				<div class="fancyHolder">
					<div class="bragedIcon"></div>
					<div class="fancyTextHolder newfancyTextHolder1">
						<div class="fancyNumber"><?php echo $store_info_var[0]->brag_counter; ?></div>
						<div class="fancyText">braged</div>
					</div>
				</div>
				<div class="fancyHolder">
					<div class="viewedIcon"></div>
					<div class="fancyTextHolder newfancyTextHolder2">
						<div class="fancyNumber"><?php echo $store_info_var[0]->visit_counter; ?></div>
						<div class="fancyText">viewed</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
<nav class="middleColumnTop">
	<div class="topDotSeparator newtopDotSeparator"></div>
	<div class="linksMiddle"><a
			href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info_var[0]->store_id; ?>">
			<div class="dashboardLink1">
				<div class="dashboardLogo1"></div>
				<div class="dashboardText1">Dashboard</div>
			</div>
		</a> <a
			href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info_var[0]->store_id; ?>">
			<div class="productsLink">
				<div class="productsLogo"></div>
				<div class="productsText">Products</div>
			</div>
		</a> <a href="">
			<div class="productsLink">
				<div class="designLogo"></div>
				<div class="productsText">Design</div>
			</div>
		</a> <a
			href="<?php echo $base_url; ?>index.php/promote/promote_discount_summary/<?php echo $store_info_var[0]->store_id; ?>">
			<div class="productsLink">
				<div class="promoteLogo"></div>
				<div class="productsText">Promote</div>
			</div>
		</a> <a
			href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info_var[0]->store_id; ?>">
			<div class="storeLink1">
				<div class="storeHover"></div>
				<div class="storeText">Store Profile</div>
			</div>
		</a> <a href="<?php echo $base_url; ?>index.php/bill/allbill/<?php echo $store_info_var[0]->store_id; ?>">
			<div class="productsLink">
				<div class="billLogo"></div>
				<div class="productsText">Bill</div>
			</div>
		</a></div>
	<div class="topDotSeparator newtopDotSeparator2"></div>
</nav>