<?php
$img1 = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img1_product.jpg';
$img2 = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img2_product.jpg';
$img3 = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img3_product.jpg';
$img4 = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img4_product.jpg';
$img5 = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img5_product.jpg';
if (file_exists($img1)) {
	$img1 = getimagesize($img1);
	$s1 = $img1[1] - 115;
	if ($s1 < 455)
		$s1 = 455;
}
if (file_exists($img2)) {
	$img2 = getimagesize($img2);
	$s2 = $img2[1] - 211;
	if ($s2 < 455)
		$s1 = 455;
}
if (file_exists($img3)) {
	$img3 = getimagesize($img3);
	$s3 = $img3[1] - 211;
	if ($s3 < 455)
		$s1 = 455;
}
if (file_exists($img4)) {
	$img4 = getimagesize($img4);
	$s4 = $img4[1] - 211;
	if ($s4 < 455)
		$s1 = 455;
}
if (file_exists($img5)) {
	$img5 = getimagesize($img5);
	$s5 = $img5[1] - 211;
	if ($s5 < 455)
		$s1 = 455;
} else
	$s1 = 455;
?>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $products[0]->product_name; ?></title>
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/product_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/alt2.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<!--for view.js-->
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<style type="text/css">
		.newBadge {
			float: left;
			height: 96px;
			padding-left: 6px;
			width: 99px;
		}
	</style>
</head>
<body>
<?php
for ($i = 0; $i < (count($myvar)); $i++) {
	if (($myvar[$i]->size) != NULL || $myvar[$i]->size != "") {
		$size[] = $myvar[$i]->size;
	} elseif (($myvar[$i]->color) != NULL || $myvar[$i]->color != "") {
		$color[] = $myvar[$i]->color;
	}
}
?>

<script src="<?php echo $base_url; ?>assets/js/timer.js" type="text/javascript"></script>
<!-- Brag Script start -->
<script type="text/javascript">
	function doPost() {
		var params = {};
		params['message'] = "<?php echo $userdetails[0]->full_name; ?> just acquired bragging rights for <?php echo substr($products[0]->product_name,0,16).'...'; ?> !! You can't blame them ! It's frickin' awesome";
		params['name'] = 'BuynBrag.com';
		params['description'] = 'You can also acquire bragging rights for this product by logging into www.buynbrag.com';
		params['link'] = "http://www.buynbrag.com/";
		params['picture'] = '<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id.'/'.$products[0]->product_id; ?>/img1_171x171.jpg';
		params['caption'] = 'is your destination for everything hard-to-find';

		FB.api('/me/feed', 'post', params, function (response) {
			if (!response || response.error) {
				console.log('Fb FFF Badly');
			}
			else {
				console.log('Fb Rocks');
			}
			$.ajax({
				url: "<?php echo $base_url; ?>" + 'index.php/brag_ajax/product_brag?store_id=<?php echo $mystore[0]->store_id; ?>&product_id=<?php echo $products[0]->product_id;?>',
				success: function (data) {
					$('#brag_count').html(data);
					$('#brag').html('BRAGGED');
					$('#brag_logo').attr('src', '<?php echo $base_url; ?>assets/images/brag_click.png');
					$('#brag_btn').attr(disabled = true);
				}
			});
		});
	}
	function brag() {
		FB.getLoginStatus(function (response) {
			if (response.status === 'connected') {
				var accessToken = response.authResponse.accessToken;
				doPost();
			}
			else if (response.status === 'not_authorized') {
			}
			else {
			}
		});
	}
</script>


<!-- Brag Script end -->
<body>
<!-- Added by lee for fb share post. Should be just below Body tag. -->
<div id="fb-root"></div>
<script>
	console.log('FFF Init started.');
	window.fbAsyncInit = function () {
		FB.init({
			appId: '<?php echo $app_id;?>', // App ID
			channelUrl: '<?php echo urlencode($base_url.'assets/channel.html'); ?>', // Channel File
			status: true, // check login status
			cookie: true, // enable cookies to allow the server to access the session
			xfbml: true  // parse XFBML
		});

		// Additional initialization code here
	};

	// Load the SDK Asynchronously
	(function (d) {
		var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement('script');
		js.id = id;
		js.async = true;
		js.src = "//connect.facebook.net/en_US/all.js";
		ref.parentNode.insertBefore(js, ref);
	}(document));
</script>
<!-- End fb share post. by lee -->
<?php //include_once($base_url."index.php/user/header"); ?>
<section class="wrapper">
<article class="bannerBg">
	<div class="bannerBgndIE">
		<div class="bannerField">

			<div class="fl">
				<div class="BigQuesText" style="text-align:center; padding-bottom:8px; color:#ec184d;">View this store
				</div>
				<a class="store_banner"
				   href="<?php echo $base_url; ?>index.php/order/store_page/<?php echo $mystore[0]->store_id; ?>">
					<img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/top_banner.png"/>
				</a>
			</div>
			<div class="sliderContainer">
				<div class="BigQuesText" style="padding:0 0 8px 14px; text-align:center; color:#ec184d;">More products
					from store
				</div>
				<div class="ProductSlider">
					<div class="button_block_left1" id="scrollLeftB1"></div>
					<div id="sliderParentDiv_1">
						<div class="sliders" id="slider1">
							<?php if (count($allprod) > 9) $tmp = 9;
							else $tmp = count($allprod);
							?>
							<?php for ($i = 0; $i < count($allprod); $i++): ?>
								<div class="image_list">
									<a href="<?php echo $base_url; ?>index.php/order/product_page/<?php echo $mystore[0]->store_id; ?>/<?php echo $allprod[$i]->product_id; ?>">
										<img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $allprod[$i]->product_id; ?>/img1_97x80.jpg"
											id="image_<?php echo $i; ?>"/>
									</a>
								</div>
							<?php endfor; ?>
						</div>
					</div>
					<div class="button_block_right1" id="scrollRightB1"></div>
				</div>
			</div>
		</div>
	</div>
</article>
<section class="middleBackground prod_middle">
<div class="Ie8bg">
<div class="topDotSeparator clear_both"></div>
<div class="productMiddle">

<!--- Added by Rajeeb--->
<?php if ($ondiscount == 1) { ?>

	<div class="timerContainer" <?php if($productdetails[0]->expiry_type == 1) {?>style="height:100px;"
	     <?php } else { ?>style="height:0px;" <?php } ?>>
		<?php /*?><div class="luxurySofaSet"><?php echo $products[0]->product_name; ?> <span style="color:#e81c4d;"><?php echo $productdetails[0]->discount; ?><?php if($productdetails[0]->promotion_type==0) {?>% <?php }else {?> Rupee <?php }?>Discount</span></div><?php */?>
		<?php if ($productdetails[0]->expiry_type == 1) { ?>
			<div class="rightContainerGradient">

				<div class="expiresText">EXPIRES IN</div>
				<div class="timerBoxes" id="timerBoxes_1">
					<script
						type="text/javascript">StartCountDownDays("timerBoxes_1", "12/23/2012 10:00 AM -0400")</script>
				</div>
				<div class="timerBoxes" id="timerBoxes_2">
					<script
						type="text/javascript">StartCountDownHours("timerBoxes_2", "12/23/2012 10:00 AM -0400")</script>

				</div>
				<div class="timerHours">days</div>
				<div class="timerHours">hours</div>
			</div>
		<?php } else if ($productdetails[0]->expiry_type == 2) { ?>
			<div class="rightContainerGradient">

				<div class="expiresText">EXPIRES IN</div>
				<div class="timerBoxes" id="timerBoxes_1"
				     style=" font-size: 31px;"><?php echo $productdetails[0]->max_can_used - $productdetails[0]->no_of_used; ?></div>
				<div class="timerBoxes" id="timerBoxes_1" style=" font-size: 31px;">Left</div>
			</div>
		<?php } ?>
	</div>
<?php }?>
<!--- end--->
<div class="prod_bg">
<div class="whiteBg">
<div class="whiteLeft">
	<div class="productBigPic">
		<div class="bigimgBg">
			<!--<a href="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img1_product.jpg" class="view" rel="adventure" title="<?php echo $products[0]->product_name; ?>">-->
			<img id="big_pic"
			     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img1_product.jpg"/>
			<!--</a>-->
		</div>
		<!--<a href="javascript:void(0)" class="priceTag">-->

		<?php if ($products[0]->quantity == 0): ?>
			<button class="priceTag">
				<?php if ($ondiscount == 1): ?>
					<?php $per = ($products[0]->discount / $products[0]->selling_price) * 100; ?>
					<div class="priceTextper"
					     style="margin:-34px 0px 0px 24px;position:absolute"><?php echo intval($per) . '% off'; ?></div>
					<div class="priceText" style="font-size:18px"><span class="rupee">`</span>
						<del><?php echo intval($products[0]->selling_price); ?></del>
					</div>
					<div class="priceText" style="margin:-17px 0px 0px -4px;font-size:26px"><span class="rupee">`</span>&nbsp;<?php echo intval($products[0]->selling_price - $products[0]->discount); ?>
					</div>
				<?php else: ?>
					<div class="priceText"><span
							class="rupee">`</span><?php echo intval($products[0]->selling_price); ?></div>
				<?php endif; ?>
			</button>

		<?php elseif ($exist == 1): ?>

			<button type="submit" class="priceTag" onClick="incart();">
				<?php if ($ondiscount == 1): ?>
					<?php $per = ($products[0]->discount / $products[0]->selling_price) * 100; ?>
					<div class="priceTextper"
					     style="margin:-34px 0px 0px 24px;position:absolute"><?php echo intval($per) . '% off'; ?></div>
					<div class="priceText" style="font-size:18px"><span class="rupee">`</span>
						<del><?php echo intval($products[0]->selling_price); ?></del>
					</div>
					<div class="priceText" style="margin:-17px 0px 0px -4px;font-size:26px"><span class="rupee">`</span>&nbsp;<?php echo intval($products[0]->selling_price - $products[0]->discount); ?>
					</div>
				<?php else: ?>
					<div class="priceText"><span
							class="rupee">`</span><?php echo intval($products[0]->selling_price); ?></div>
				<?php endif; ?>
			</button>

		<?php elseif ($exist == 0): ?>

			<button type="submit" class="priceTag" onClick="buyit();">
				<?php if ($ondiscount == 1): ?>
					<?php $per = ($products[0]->discount / $products[0]->selling_price) * 100; ?>
					<div class="priceTextper"
					     style="margin:-34px 0px 0px 24px;position:absolute"><?php echo intval($per) . '% off'; ?></div>
					<div class="priceText" style="font-size:18px"><span class="rupee">`</span>
						<del><?php echo intval($products[0]->selling_price); ?></del>
					</div>
					<div class="priceText" style="margin:-17px 0px 0px -4px;font-size:26px"><span class="rupee">`</span>&nbsp;<?php echo intval($products[0]->selling_price - $products[0]->discount); ?>
					</div>
				<?php else: ?>
					<div class="priceText"><span
							class="rupee">`</span><?php echo intval($products[0]->selling_price); ?></div>
				<?php endif; ?>
			</button>
		<?php endif; ?>
		<div class="smallImageContainer">
			<div class="smImgBg">
				<img class="bottom_image"
				     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img1_40x40.jpg"
				     id="img1_product.jpg"/>
			</div>
			<?php
			$filename = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img2_product.jpg';
			if (file_exists($filename)):
				?>
				<div class="smImgBg">
					<!--<a href="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img2_product.jpg" class="view" rel="adventure" title="<?php echo $products[0]->product_name; ?>">-->
					<img class="bottom_image"
					     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img2_40x40.jpg"
					     id="img2_product.jpg"/>
					<!--</a>-->
				</div>
				<?php
				$filename = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img3_product.jpg';
				if (file_exists($filename)):
					?>
					<div class="smImgBg">
						<!--<a href="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img3_product.jpg" class="view" rel="adventure" title="<?php echo $products[0]->product_name; ?>">-->
						<img class="bottom_image"
						     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img3_40x40.jpg"
						     id="img3_product.jpg"/>
						<!--</a>-->
					</div>
					<?php
					$filename = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img4_product.jpg';
					if (file_exists($filename)):
						?>
						<div class="smImgBg">
							<!--<a href="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img4_product.jpg" class="view" rel="adventure" title="<?php echo $products[0]->product_name; ?>">-->
							<img class="bottom_image"
							     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img4_40x40.jpg"
							     id="img4_product.jpg"/>
							<!--</a>-->
						</div>
						<?php
						$filename = 'assets/images/stores/' . $mystore[0]->store_id . '/' . $products[0]->product_id . '/img5_product.jpg';
						if (file_exists($filename)):
							?>
							<div class="smImgBg">
								<!--<a href="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img5_product.jpg" class="view" rel="adventure" title="<?php echo $products[0]->product_name; ?>">-->
								<img class="bottom_image"
								     src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img5_40x40.jpg"
								     id="img5_product.jpg"/>
								<!--</a>-->
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="fancy_viewContainer">
		<div class="iconBox">
			<div class="bragitIcon"></div>
			<div class="numberText" id="brag_count"><?php echo $products[0]->brag_counter; ?></div>
			<div class="icoText">People Bragged it</div>
		</div>
		<div class="iconBox">
			<div class="fancyitIcon"></div>
			<div class="numberText" id="fan"><?php echo $products[0]->fancy_counter; ?></div>
			<div class="icoText">People Fancied it</div>
		</div>
		<div class="iconBox border_right">
			<div class="viewitIcon"></div>
			<div class="numberText"><?php echo $products[0]->visit_counter; ?></div>
			<div class="icoText">Viewed this Product</div>
		</div>
	</div>
</div>
<div class="whiteRight">
<div class="rightHeader">
	<?php if ($fancied) : ?>
		<!-- 						<input type="hidden" value="2" id="fancy_hidden"/>-->
		<button type="button" class="iconWrapper fancyIt" onClick="fancy_product_popup2();" id="fancied">
			<img name="im2" src="<?php echo $base_url; ?>assets/images/fancy_click.png" class="fancyLogo"/>

			<div class="iconText" id="fancyText">FANCIED</div>
		</button>
	<?php else : ?>
		<!-- 						<input type="hidden" value="1" id="fancy_hidden"/> -->
		<button type="button" class="iconWrapper fancyIt" onClick="fancy_product_popup1();" id="fancy">
			<img name="im2" src="<?php echo $base_url; ?>assets/images/fancy_icon.png" class="fancyLogo"/>

			<div class="iconText" id="fancyText">FANCY IT</div>
		</button>
	<?php endif;?>
	<?php if ($bragged) : ?>
		<button type="submit" class="iconWrapper" onClick="this.disabled=1;">
			<img class="bragLogo" src="<?php echo $base_url; ?>assets/images/brag_click.png">

			<div class="iconText" id="brag">BRAGGED</div>
		</button>
	<?php else: ?>
		<button type="submit" class="iconWrapper" id="brag_btn" onClick="brag();">
			<img class="bragLogo" id="brag_logo" src="<?php echo $base_url; ?>assets/images/braged_icon.png"/>

			<div class="iconText" id="brag">BRAG IT</div>
		</button>
	<?php endif; ?>
	<?php if (isset($poll_prods[$products[0]->product_id])) : ?>
		<button type="submit" class="iconWrapper border_right">
			<img class="pollLogo" src="<?php echo $base_url; ?>assets/images/polled.png">

			<div class="iconText">POLLED</div>
		</button>
	<?php else: ?>
		<div id="poll_<?php echo $products[0]->product_id; ?>">
			<button type="submit" onClick="return AddPoll(<?php echo $products[0]->product_id; ?>)"
			        class="iconWrapper border_right">
				<img class="pollLogo" src="<?php echo $base_url; ?>assets/images/poll.png">

				<div class="iconText">POLL IT</div>
			</button>
		</div>
	<?php endif; ?>
</div>
<div class="topWrapper">
	<!--Add to cart button-->
	<?php if ($products[0]->quantity <= 0): ?>
		<div>
			<button type="submit" class="inCart"
			        style=" width:195px; background-image:red; margin:6px 30px 10px 0;float:left">
				<div class="inCartImage"></div>
				<div class="inCartText">Out of Stock</div>
			</button>
		</div>
	<?php elseif ($exist == 1): ?>
		<div>
			<button type="submit" class="inCart"
			        style=" width:195px; background-image:red; margin:6px 30px 10px 0;float:left">
				<div class="inCartImage"></div>
				<div class="inCartText">Already in Cart</div>
			</button>
		</div>
	<?php else: ?>
		<div>
			<button type="submit" class="addCart" style="margin:0px 0 10px 0px;float:left" onClick="add2cart();">
				<div class="addCartImage"></div>
				<div class="addCartText">Add to Cart</div>
			</button>
		</div>
	<?php endif; ?>
	<!--End of add to cart-->
	<div class="scrollPaneContainer" style="height:<?php echo $s1; ?>;min-height:450px">
		<div class="prodItemText" id="prod_item"><?php echo $products[0]->product_name;?></div>
		<?php
		$filename = 'assets/images/stores/' . $store_id . '/size.jpg';
		if (file_exists($filename)): ?>
			<a style="color:#ec184d;" class="view" rel="cart"
			   href="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_id; ?>/size.jpg"
			   class="prodHeading">Click Here to See Size Chart</a>
		<?php endif; ?>
		<div class="prodHeading">QUANTITY</div>
		<?php
		if ($products[0]->quantity <= 0) {
			$clr = "#F33F4B";
			$txt = "OUT OF STOCK";
			//$button = "hidden";
		} else {
			$clr = "GREEN";
			$txt = "IN STOCK";
			//$button = "visible";
		}

		?>
		<div class="stockIcon" style="background-color:<?php echo $clr;?>;"><?php echo $txt;?></div>
		<div class="prodAbout">
			<?php
			if ($products[0]->quantity <= 5)
				echo $products[0]->quantity;
			else
				echo "more than 5"; ?>
			available
		</div>
		<div class="prodHeading">SHIPPING</div>
		<div class="shipWrapper">
			<div class="prodAbout float_left">Deliver within <?php echo $products[0]->processing_time + 5; ?> days</div>
		</div>
		<div class="prodHeading">DETAILS</div>
		<div class="prodAbout">
			<div><?php echo preg_replace('/\v+|\\\[rn]/', '<br/>', $products[0]->description); ?></div>
			<!--<div class="paddingStyle"><?php //echo $products[0]->description; ?>.</div>-->
		</div>

	</div>
</div>
<div class="drop_bottom">
	<!--            //For Variants
				// For colors-->
	<?php if (isset($color) || isset($size)): ?>
		<div class="drop_downSet">
			<?php if (isset($color)): ?>
				<div class="firstDropdown" style="border-right:1px solid #CCCCCC;width:185px">
					<div class="drop_heading" id="color">COLOR'S</div>
					<select id="colors">
						<?php for ($i = 0; $i < (count($color)); $i++): ?>
							<option><?php echo $color[$i];?></option>
						<?php endfor; ?>
					</select>
				</div>
			<?php else: ?>
				<div class="firstDropdown" style="display:none">
					<div class="drop_heading" id="color">COLOR'S</div>
					<select id="colors">
						<option selected="selected">0</option>
					</select>
				</div>
			<?php endif; ?>
			<!--            // Size-->
			<?php if (isset($size)): ?>
				<div class="firstDropdown">
					<div class="drop_heading">SIZE</div>
					<select id="sizes">
						<?php for ($i = 0; $i < (count($size)); $i++): ?>
							<option><?php echo $size[$i];?></option>
						<?php endfor; ?>
					</select>
				</div>
			<?php else: ?>
				<div class="firstDropdown" style="display:none">
					<div class="drop_heading">SIZE</div>
					<select id="sizes">
						<option selected="selected">0</option>
					</select>
				</div>
			<?php endif; ?>
		</div>



	<?php else: ?>



		<div class="drop_downSet" style="display:none">
			<?php if (isset($color)): ?>
				<div class="firstDropdown" style="border-right:1px solid #CCCCCC;width:185px">
					<div class="drop_heading" id="color">COLOR</div>
					<select id="colors">
						<?php for ($i = 0; $i < (count($color)); $i++): ?>
							<option><?php echo $color[$i];?></option>
						<?php endfor; ?>
					</select>
				</div>
			<?php else: ?>
				<div class="firstDropdown" style="display:none">
					<div class="drop_heading" id="color">COLOR</div>
					<select id="colors">
						<option selected="selected">0</option>
					</select>
				</div>
			<?php endif; ?>
			<!--            // Size-->
			<?php if (isset($size)): ?>
				<div class="firstDropdown">
					<div class="drop_heading">SIZE'S</div>
					<select id="sizes">
						<?php for ($i = 0; $i < (count($size)); $i++): ?>
							<option><?php echo $size[$i];?></option>
						<?php endfor; ?>
					</select>
				</div>
			<?php else: ?>
				<div class="firstDropdown" style="display:none">
					<div class="drop_heading">SIZE'S</div>
					<select id="sizes">
						<option selected="selected">0</option>
					</select>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>

<!--            //End of Variants-->
<div class="bottomWrapper" style="clear:both">
	<!--                        	<div class="badge1"></div>
								<div class="badge2"></div>-->
	<?php if ($mystore[0]->COD_policy == 1): ?>
		<div title="Cash On Delivery available" class="gold_badge showtooltip">
			<img src="<?php echo $base_url; ?>assets/images/badges/stores/cod.png" alt="cod badge"/>
		</div>
	<?php endif; ?>
	<?php if ($mystore[0]->EMI_policy == 1): ?>
		<div title="3 month and 6 month EMI available" class="platinum_badge showtooltip">
			<img src="<?php echo $base_url; ?>assets/images/badges/stores/emi.png" alt="emi badge"/>
		</div>
	<?php endif; ?>
	<?php if ($mystore[0]->return_policy == 0): ?>
		<div title="Returns not available on this store, unless covered under BIP" class="newBadge showtooltip">
			<img src="<?php echo $base_url; ?>assets/images/badges/stores/noreturn.png" alt="return badge"/>
		</div>
	<?php else : ?>
		<div title="7 day replacement guarantee" class="newBadge showtooltip">
			<div class="platinum_badge">
				<img src="<?php echo $base_url; ?>assets/images/badges/stores/happyreturn.png" alt="return badge"/>
			</div>
		</div>
	<?php endif; ?>


</div>

</div>
</div>
</div>
<!--                <div class="secondContainer">
                	<div class="commentsContainer">
                    	<div class="commentHeading">
                        	<div class="commentText">Comments</div>
                            <a href="javascript:void(0)" class="FriendsText">Friends</a>
                            <div class="friendCircle">13</div>
                            <a href="javascript:void(0)" class="AllText">All</a>
                            <div class="allCircle">73</div>
                        </div>
                        <div class="showingText">showing 3/13</div>
                        <div class="commentHolder">
                        	<div class="commentRow">
                            	<a href="javascript:void(0)" class="pro_pic">
                                	<img src="<?php echo $base_url; ?>assets/images/david_image.png" alt="profile picture"/>
                                </a>
                                <a href="javascript:void(0)" class="pro_name">David</a>
                                <div class="comment">We like to keep it casual out here in California, and whatâ€™s more casual than your very 
own chalkboard? </div>
                            </div>
                            <div class="commentRow">
                            	<a href="javascript:void(0)" class="pro_pic">
                                	<img src="<?php echo $base_url; ?>assets/images/david_image_2.png" alt="profile picture"/>
                                </a>
                                <a href="javascript:void(0)" class="pro_name">David</a>
                                <div class="comment">We like to keep it casual out here in California, and whatâ€™s more casual than your very 
own chalkboard? It makes a proud statement all on its own, and looks extra â€œCaliforniaâ€� 
once you fill it with your farmers market  </div>
                            </div>
                            <div class="commentRow">
                            	<a href="javascript:void(0)" class="pro_pic">
                                	<img src="<?php echo $base_url; ?>assets/images/david_image.png" alt="profile picture"/>
                                </a>
                                <a href="javascript:void(0)" class="pro_name">David</a>
                                <div class="comment">We like to keep it casual out here in California, and whatâ€™s more casual than your very 
own chalkboard? </div>
                            </div>
                            <div class="commentRow">
                            	<a href="javascript:void(0)" class="pro_pic">
                                	<img src="<?php echo $base_url; ?>assets/images/david_image.png" alt="profile picture"/>
                                </a>
                                <a href="javascript:void(0)" class="pro_name">David</a>
                                <div class="comment">We like to keep it casual out here in California, and whatâ€™s more casual than your very 
own chalkboard? </div>
                            </div>
                        </div>
                        <div class="PostHolder">
                        	<textarea id="comment_post" placeholder="comment! tell what do you think about this product"></textarea>
                            <button type="submit" class="post_button">Post</button>
                            <div class="post_icon"></div>
                        </div>
                    </div>
                    <div class="commentSep"></div>
                    <div class="questionRight">
                    	<div class="BigQuesText">Hava a Question?</div>
                        <div class="ques">
                        	<div class="ques_icon1"></div>
                            <a href="javascript:void(0)"  class="quest_text">Contact Shop Owner</a>
                        </div>
                        <div class="ques">
                        	<div class="ques_icon2"></div>
                            <a href="javascript:void(0)" class="quest_text">View Shop Policies</a>
                        </div>
                        <div class="ques" id="requestPopup">
                        	<div class="ques_icon3"></div>
                            <a href="javascript:void(0)"  class="quest_text">Request Custom Item</a>
                        </div>
                        <div class="ques">
                        	<div class="ques_icon4"></div>
                            <a href="javascript:void(0)"  class="quest_text">Report this Item to BnB</a>
                        </div>
                    </div>
                </div>-->
</div>
<div class="bottomBg">
	<div class="topDotSeparator clear_both"></div>
	<div class="bottomContent">

		<div class="BigQuesText">You may also be interested in</div>
		<div class="bottomSlider">
			<div class="sliderrHolder">
				<div class="storeViewIcon" style="top:-23px;"></div>
				<div class="scrollerContents4">
					<div class="button_block_left2" id="scrollLeftButton6"></div>
					<div id="sliderParentDiv_6" class="sliderParentDiv4">

						<div class="slider4" id="slider6">


							<?php
							for ($i = 0; $i < count($interested); $i++): ?>
								<?php
								if ($i == 0) {
									$class = "store-list paddingLeft0";
								} else {
									$class = "store-list";
								}
								?>
								<div class="<?php echo $class; ?>">
									<div class="rightPanelImageHolder1">
										<a href="<?php echo $base_url?>index.php/order/product_page/<?php echo $interested[$i]->store_id; ?>/<?php echo $interested[$i]->product_id; ?>">
											<img
												src="<?php echo $store_url; ?>assets/images/stores/<?php echo $interested[$i]->store_id; ?>/<?php echo $interested[$i]->product_id; ?>/img1_240x200.jpg"/>
										</a>


										<div
											class="storeDecoratingText pro_name2"><?php echo $interested[$i]->product_name; ?></div>
										<div class="fl">
											<!--                                                       <div class="storeDecoratingText font12 stor_nm "><?php  //$interested[$i]->store_name; ?></div>-->
											<div class="storeFancyHolder">
												<div class="fanciedIcon"></div>
												<div
													class="fancyNumber storeExtraStyle"><?php echo $interested[$i]->fancy_counter; ?></div>
												<div class="fancyText storeExtraStyle">fancied</div>
											</div>
										</div>
										<!-- added by Rajeeb-->
										<?php if ($interested[$i]->is_on_discount == 0) { ?>
											<div class="priceHolder"><span class="rupee">`</span>
												<?php echo intval($interested[$i]->selling_price); ?>

											</div>


										<?php } else { ?>
											<div class="priceHolder" style="height:40px;">
												<div><span class="rupee">`</span>
													<del><?php echo intval($interested[$i]->selling_price); ?></del>
												</div>
												<div><span
														class="rupee">`</span> <?php echo intval($interested[$i]->selling_price - $interested[$i]->discount); ?>
												</div>
											</div>
										<?php }?>
										<!-- End-->

									</div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
					<div class="button_block_right2" id="scrollRightButton6"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="prod_popUp" id="prodPopup">
	<div class="prod_popUpTransp"></div>
	<div class="prod_popUpActual">
		<div class="request_header">
			<div class="request_text">REQUEST CUSTOM ITEM</div>
			<div id="pickup_close" class="pickup_close"></div>
		</div>
		<div class="productContent">
			<div class="firstLeft">
				<div class="productBg">
					<img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/img1_product.jpg"
						alt="popup icon" width="144" height="117"/>
				</div>
				<div class="productName"><?php echo substr($products[0]->product_name, 0, 15); ?></div>
			</div>
			<div class="wideSeperator"></div>
			<div class="secondLeft">
				<div class="textAreaHolder1">
					<div class="textareaBackground1"></div>
					<textarea class="textarea_class1" placeholder="enter message"></textarea>
				</div>
				<button type="button" class="prod_continue width_style1">Send</button>
			</div>
		</div>
	</div>
</div>
<!--            <div class="bigImagePopUP" id="bigImagePopUP">
            	<div class="bigImageSlider">
                	<div class="arrowLeft" id="arrowLeft"></div>
                   	<div class="bigImageContainer" id="bigImageContainer">
                        	<?php 
								$firstFilename = 'assets/images/stores/'.$mystore[0]->store_id.'/'.$products[0]->product_id.'/img1_product.jpg'; 
								$firstMyImageHeight = getimagesize($firstFilename);
								$firstMyImageHeight = $firstMyImageHeight[1]+10;
							?>
							<input type="hidden" name="zoomPicHiddenField" id="zoomPicHiddenField" value="1"/>
                            <div class="bigImageScroller" id="bigImageScroller" style="height:<?php echo $firstMyImageHeight;?>;">
							<?php 
							
							for($i=1;$i<=5;$i++){ 
								$filename = 'assets/images/stores/'.$mystore[0]->store_id.'/'.$products[0]->product_id.'/img'.$i.'_product.jpg'; 
                                                                if(file_exists($filename)):
								$myImageHeight = getimagesize($filename);
								$myImageHeight = $myImageHeight[1]+10;
                                                                endif;
							?>
							<?php
								
								if (file_exists($filename)){ ?>	
									<div class="imageBackground" style="height:auto" id="imageBackground_<?php echo $i; ?>" title="<?php echo $myImageHeight; ?>">
                            			<img src="<?php echo $base_url;  ?><?php echo $filename;?>" alt="image1"/> 
                            		</div>
							<?php } }?>
                            
                    	</div>
                    </div>
                    <div class="arrowRight" id="arrowRight"></div>
            	</div>
            </div>-->
</div>
</section>
</section>
<div class="fancy_popUp" id="fancyPopup">
	<div class="fancy_popUpTransp"></div>
	<div class="fancy_popUpActual">
		<div class="fancy_text">Product has been added to your poll list</div>
		<div class="button_style">
			<button type="button" class="prod_continue width_style_fancy">OK</button>
		</div>
	</div>
</div>
<?php include "fancy_unfancy.php" ?>
<?php include "footer.php" ?>
</body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/product_page.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_unfancy.js"></script>
<script>
	$(function () {

//    $("#big_pic").click(function(){
//		$("#bigImagePopUP").dialog({
//			autoOpen: true,
//			width:1024,
//			height:'auto',
//			modal: true,
//			open: function(){
//				$('.ui-widget-overlay').bind('click',function(){
//					$('#bigImagePopUP').dialog('close');
//				})
//			}
//    	});
//	});
		//Image thumbnail to bigsize
		$(".bottom_image").each(function () {
			$(this).hover(function () {
				var imgId = $(this).attr('id');
				$("#big_pic").attr({src: "<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/" + imgId});
				var img2 = "<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[0]->product_id; ?>/" + imgId;

				var theImage = new Image();
				theImage.src = img2;
				var myHeight = theImage.height;
				var s1 = myHeight;
				if (s1 < 450)
					s1 = 450;


				$(".scrollPaneContainer").height(s1);
				//$(".jspPane").height(s1);
				$(".jspContainer").css('height', s1);

				$('.scrollPaneContainer').jScrollPane({
					showArrows: false,
					animateScroll: true
				});


				window.scrollTo(0, 250);

			});
		});


		$(".color_box").each(function () {

			$(this).mouseover(function () {
				var colorId = $(this).attr('id');

				$("#" + colorId).closest(".choosecolor").click(function () {
					$("#big_pic").attr({src: "images/product_bigImage/s_" + imgId + ".png"});
				});
			});
		});
		//TOOLTip
		$(".prodItemText").each(function () {
			var len = 32;
			var trunc = $(this).text();
			if ($(this).text().length > len) {
				/* Truncate the content of the P, then go back to the end of the
				 previous word to ensure that we don't truncate in the middle of
				 a word */
				$(this).attr("title", trunc);
				$(this).addClass("showtooltip2");
				trunc = trunc.substring(0, len);
				trunc = trunc.replace(/\w+$/, '');
				trunc += '..';
				$(this).html(trunc);
			}
		});

		$(".pro_name2").each(function () {

			var len = 42;
			var trunc = $(this).text();
			if ($(this).text().length > len) {
				/* Truncate the content of the P, then go back to the end of the
				 previous word to ensure that we don't truncate in the middle of
				 a word */
				$(this).attr("title", trunc);

				$(this).addClass("showtooltip2");

				trunc = trunc.substring(0, len);
				trunc = trunc.replace(/\w+$/, '');

				trunc += '..';

				$(this).html(trunc);
			}
		});
		$(".stor_nm").each(function () {

			var len = 20;
			var trunc = $(this).text();
			if ($(this).text().length > len) {
				/* Truncate the content of the P, then go back to the end of the
				 previous word to ensure that we don't truncate in the middle of
				 a word */
				$(this).attr("title", trunc);

				$(this).addClass("showtooltip2");

				trunc = trunc.substring(0, len);
				trunc = trunc.replace(/\w+$/, '');

				trunc += '..';

				$(this).html(trunc);
			}
		});
		tooltip2();
		//ScrollpaneHeight

		<?php //echo $s1; ?>
	});
</script>
<script type="text/javascript">
	var tScroll = 0;

	$("#scrollLeftB1").click(function () {
		var rightArrowShow = $("#scrollRightB1").css('display');
		if (rightArrowShow == 'none')
			$("#scrollRightB1").css('display', 'block');

		//alert(totalScroll);
		if (tScroll <= 735) {
			$("#scrollLeftB1").css('display', 'none');
		}
		if (tScroll <= 0) return;
		tScroll = tScroll - 735;
		$('#sliderParentDiv_1').animate({scrollLeft: tScroll}, 1500);
	});

	var xy =<?php echo ceil(count($allprod)/7); ?>;
	var tWidth = xy * 735;
	$("#slider1").css("width", tWidth + "px");
	$("#scrollRightB1").click(function () {
		if (xy == 1) {
		} else {
			var rightArrowShow = $("#scrollLeftB1").css('display');
			if (rightArrowShow == 'none')
				$("#scrollLeftB1").css('display', 'block');

			maxScroll = parseInt($(".sliders").css("width")) - parseInt($("#sliderParentDiv_1").width());

			if ((tScroll + 735) >= maxScroll) {
				$("#scrollRightB1").css('display', 'none');
				tScroll = tScroll + 735;
				$('#sliderParentDiv_1').animate({scrollLeft: tScroll}, 1500);
				return
			}
			;
			tScroll = tScroll + 735;
			$('#sliderParentDiv_1').animate({scrollLeft: tScroll}, 1500);
		}
	});

	var totalScroll = 0;

	//	$("#arrowLeft").click(function () {
	//
	//		var rightArrowShow = $("#arrowRight").css('display');
	//		if(rightArrowShow == 'none')
	//			$("#arrowRight").css('display','block');
	//
	//		//alert(totalScroll);
	//		if(totalScroll<=1024)
	//		{
	//			$("#arrowLeft").css('display','none');
	//		}
	//		totalScroll=totalScroll-1024 ;
	//		$('#bigImageContainer').animate({scrollLeft:totalScroll},2050);
	//
	//		var zoomFileNumber = $('#zoomPicHiddenField').val();
	//		zoomFileNumber = parseInt(zoomFileNumber)-1;
	//
	//		var getZoomPicHeight =  $("#imageBackground_"+zoomFileNumber).attr('title');
	//
	//		if(parseInt(zoomFileNumber) >= 1)
	//			$('#zoomPicHiddenField').val(parseInt(zoomFileNumber));
	//		//$(".bigImageScroller").css("height",getZoomPicHeight+"px");
	//		$(".bigImageScroller").animate({"height":getZoomPicHeight+"px"}, 2050);
	//
	//	});
	//	var temp=0;
	//
	<?php for($i=1;$i<=5;$i++){ $file = 'assets/images/stores/'.$mystore[0]->store_id.'/'.$products[0]->product_id.'/img'.$i.'_product.jpg'; if (file_exists($file)){ ?>	temp+=1;
	<?php } }?>
	//	$("#arrowRight").click(function () {
	//		var rightArrowShow = $("#arrowLeft").css('display');
	//		if(rightArrowShow == 'none')
	//			$("#arrowLeft").css('display','block');
	//
	//		var zoomFileNumber = $('#zoomPicHiddenField').val();
	//		zoomFileNumber = parseInt(zoomFileNumber)+1;
	//		var getZoomPicHeight =  $("#imageBackground_"+zoomFileNumber).attr('title');
	//		//$(".bigImageScroller").css("height",getZoomPicHeight+"px");
	//		$(".bigImageScroller").animate({"height":getZoomPicHeight+"px"}, 2050);
	//		//alert(getZoomPicHeight);
	//		if(parseInt(zoomFileNumber) <= 5)
	//			$('#zoomPicHiddenField').val(parseInt(zoomFileNumber));
	//
	//		maxScroll = parseInt($(".bigImageScroller").css("width"))-2048;
	//		if(totalScroll  >= maxScroll)
	//		{
	//			$("#arrowRight").css('display','none');
	//		}
	//		totalScroll=totalScroll+1024;
	//		$('#bigImageContainer').animate({scrollLeft:totalScroll},2050);
	//		 var totalWid=temp*1024;
	//		 $(".bigImageScroller").css("width",totalWid+"px");
	//
	//	});

	var totalScroll6 = 0;

	$("#scrollLeftButton6").click(function () {
		var rightArrowShow = $("#scrollRightButton6").css('display');
		if (rightArrowShow == 'none')
			$("#scrollRightButton6").css('display', 'block');

		//alert(totalScroll);
		if (totalScroll6 <= 1024) {
			$("#scrollLeftButton6").css('display', 'none');
		}
		if (totalScroll6 <= 0) return;
		totalScroll6 = totalScroll6 - 1024;
		$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
	});
	var x2 =<?php echo ceil(count($interested)/4); ?>;
	var totalWidth2 = x2 * 1024;
	$("#slider6").css("width", totalWidth2 + "px");

	$("#scrollRightButton6").click(function () {
		if (x2 == 1) {
		} else {
			var rightArrowShow = $("#scrollLeftButton6").css('display');
			if (rightArrowShow == 'none')
				$("#scrollLeftButton6").css('display', 'block');
			maxScroll = parseInt($(".slider4").css("width")) - parseInt($("#sliderParentDiv_6").width());
			if (totalScroll6 + 1024 >= maxScroll) {
				$("#scrollRightButton6").css('display', 'none');
				totalScroll6 = totalScroll6 + 1024;
				$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
				return
			}
			;
			totalScroll6 = totalScroll6 + 1024;
			$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);

		}
	});
</script>
<script type="text/javascript">
	function fancy_product_popup1() {
//var type=$('#fancy_hidden').val();
		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop1?store_id=<?php echo $mystore[0]->store_id; ?>&product_id=<?php echo $products[0]->product_id;?>',
			success: function (data) {
				/* if(type==1)
				 { */
				$('#popup_category').html(data);
				/* }
				 else
				 {
				 $('#popup_category1').html(data);
				 } */
			}
		});
	}
	function AddPoll(pid) {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/add_to_poll/" + pid,
			success: function (data) {

			}
		});
		$('#poll_' + pid).html('<button type="submit" class="iconWrapper border_right"><img class="pollLogo" src="<?php echo $base_url; ?>assets/images/polled.png" ><div class="iconText">POLLED</div></button>');
		$("#fancyPopup").dialog({
			width: 605,
			height: 293,
			modal: true,
		});
		$(".width_style_fancy").click(function () {
			$("#fancyPopup").dialog('close');
		});
	}
	function fancy_product_popup2() {
//var type=$('#fancy_hidden').val();
		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop2?store_id=<?php echo $mystore[0]->store_id; ?>&product_id=<?php echo $products[0]->product_id;?>',
			success: function (data) {
				$('#popup_category1').html(data);
			}
		});
	}


</script>
<script type="text/javascript">
	function add2cart() {
		var x = colors.options[colors.selectedIndex].value;
		var y = sizes.options[sizes.selectedIndex].value;
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/order/add_to_cart/<?php echo $products[0]->product_id ?>/" + x + "/" + y + "/<?php echo $user_id ?>/<?php echo $mystore[0]->store_id;?>",
			success: function (data) {
//          window.location="
				<?php echo $base_url; ?>index.php/cart/shopping_cart";
				alert('Product is Added to cart');
			}
		});
	}

	function incart() {
		alert('Product already added to ur cart');
	}

	function buyit() {
		var x = colors.options[colors.selectedIndex].value;
		var y = sizes.options[sizes.selectedIndex].value;
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/order/add_to_cart/<?php echo $products[0]->product_id ?>/" + x + "/" + y + "/<?php echo $user_id ?>/<?php echo $mystore[0]->store_id;?>",
			success: function (data) {
				window.location = "<?php echo $base_url; ?>index.php/cart/shopping_cart";
//          alert('Product is Added to cart');
			}
		});
	}
</script>
<script src="<?php echo $base_url; ?>assets/js/timer.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/js/homepage.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/newview.js?auto"></script>
</html>
