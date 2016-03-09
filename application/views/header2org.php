<!doctype html> <?php $c1 = 0;$c2 = 0;$c3 = 0;$c4 = 0;$c5 = 0; for ($i = 0; $i < count($catlist); $i++) {
	if ($catlist[$i]->parent_catagory_id == 1) {
		$had[] = $catlist[$i]->category_name;
		$had_sub[] = $catlist[$i]->category_id;
	}
	if ($catlist[$i]->parent_catagory_id == 2) {
		$fashion[] = $catlist[$i]->category_name;
		$fashion_sub[] = $catlist[$i]->category_id;
	}
	if ($catlist[$i]->parent_catagory_id == 3) {
		$art[] = $catlist[$i]->category_name;
		$art_sub[] = $catlist[$i]->category_id;
	}
	if ($catlist[$i]->parent_catagory_id == 4) {
		$gizmos[] = $catlist[$i]->category_name;
		$gizmos_sub[] = $catlist[$i]->category_id;
	}
	if ($catlist[$i]->parent_catagory_id == 5) {
		$pers[] = $catlist[$i]->category_name;
		$pers_sub[] = $catlist[$i]->category_id;
	}
} for ($i = 0; $i < count($hcatproducts); $i++) {
	if ($hcatproducts[$i]->cat_id == 1) {
		$phad[] = $hcatproducts[$i];
	}
	if ($hcatproducts[$i]->cat_id == 2) {
		$pfashion[] = $hcatproducts[$i];
	}
	if ($hcatproducts[$i]->cat_id == 3) {
		$part[] = $hcatproducts[$i];
	}
	if ($hcatproducts[$i]->cat_id == 4) {
		$pgizmos[] = $hcatproducts[$i];
	}
	if ($hcatproducts[$i]->cat_id == 5) {
		$ppers[] = $hcatproducts[$i];
	}
} $temp_shad = 0; $temp_sfashion = 0; $temp_sart = 0; $temp_sgizmos = 0; $temp_spers = 0; for ($i = 0; $i < count($hcatstore); $i++) {
	if ($hcatstore[$i]->cat_id == 1) {
		if (!($hcatstore[$i]->store_id == $temp_shad)) {
			$shad[] = $hcatstore[$i];
			$temp_shad = $hcatstore[$i]->store_id;
		}
	}
	if ($hcatstore[$i]->cat_id == 2) {
		if (!($hcatstore[$i]->store_id == $temp_sfashion)) {
			$sfashion[] = $hcatstore[$i];
			$temp_sfashion = $hcatstore[$i]->store_id;
		}
	}
	if ($hcatstore[$i]->cat_id == 3) {
		if (!($hcatstore[$i]->store_id == $temp_sart)) {
			$sart[] = $hcatstore[$i];
			$temp_sart = $hcatstore[$i]->store_id;
		}
	}
	if ($hcatstore[$i]->cat_id == 4) {
		if (!($hcatstore[$i]->store_id == $temp_sgizmos)) {
			$sgizmos[] = $hcatstore[$i];
			$temp_sgizmos = $hcatstore[$i]->store_id;
		}
	}
	if ($hcatstore[$i]->cat_id == 5) {
		if (!($hcatstore[$i]->store_id == $temp_spers)) {
			$spers[] = $hcatstore[$i];
			$temp_spers = $hcatstore[$i]->store_id;
		}
	}
} //for ($i=0;$i<count($hcatstore);$i++) //{ // if ($hcatstore[$i]->cat_id == 1) // { // $shad[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 2) // { // $sfashion[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 3) // { // $sart[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 4) // { // $sgizmos[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 5) // { // $spers[] = $hcatstore[$i]; // } //} ?>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo $base_url; ?>assets/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
<script src="<?php echo $base_url; ?>assets/js/libs/modernizr-2.5.3.min.js"></script>
<script type="text/javascript"
        src="<?php echo $base_url; ?>assets/js/jquery-ui-1.8.16.custom.min.js"></script> <!-- scripts concatenated and minified via ant build script-->
<script src="<?php echo $base_url; ?>assets/js/plugins.js"></script> <!-- end scripts-->
<link href="<?php echo $base_url; ?>favicon.ico" rel="shortcut icon" type="image/ico"/>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.ui.tabs.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.ui.position.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.tooltip.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.selectbox-0.1.3.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.sexy-combo.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.dcmegamenu.1.3.3.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/pop-up.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/common.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/tooltip.js"></script>
<script type="text/javascript"
        src="<?php echo $base_url; ?>assets/js/friend_follower.js"></script> <!--<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/landing_page.js"></script>-->
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/galleria-1.2.7.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/badge_popup.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/friends_follower.css"/>
<style type="text/css">
	.headerSeperator {
		height: 42px !important;
	}
</style>
<script type="text/javascript">
	$(document).ready(function ($) {
		$(".pplImage").mousemove(function () {
			$(".headerdropdown dd ul").show();
			$(".headerdropdown dt a").css("background", " url('<?php echo $base_url; ?>assets/images/header_arrow_click.png') no-repeat scroll 2px center #C4C4C4 ");
		});
		$(".headerdropdown dd ul").mouseover(function () {
			$(".headerdropdown dd ul").show();
		});
		$(".pplImage").mouseout(function () {
			$(".headerdropdown dd ul").hide();
		});
		$(".headerdropdown dd ul").mouseout(function () {
			$(".headerdropdown dd ul").hide();
		});
		$(document).bind('click', function (e) {
			var $clicked = $(e.target);
			if (!$clicked.parents().hasClass("headerdropdown")) {
				$(".headerdropdown dd ul").hide();
				$(".headerdropdown dt a").css("background", " url('<?php echo $base_url; ?>assets/images/header_arrow.png') no-repeat scroll 2px center #444444");
			}
		});
		$(".headerdropdown dd ul li a").each(function () {
			$(this).hover(function () {
				var s = $(this).find("span").html();
				if (s == 'PR') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropprofile_hover.png");
				}
				else if (s == 'FA') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropfancy_hover.png");
				}
				else if (s == 'PL') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/droppoll_hover.png");
				}
				else if (s == 'BL') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropblog_hover.png");
				}
				else if (s == 'SB') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropstyleboard_hover.png");
				}
			}, function () {
				var s = $(this).find("span").html();
				if (s == 'PR') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropprofile_icon.png");
				}
				else if (s == 'FA') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropfancy_icon.png");
				}
				else if (s == 'PL') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/droppoll_icon.png");
				}
				else if (s == 'BL') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropblog_icon.png");
				}
				else if (s == 'SB') {
					$(this).children("img").attr("src", "<?php echo $base_url; ?>assets/images/dropstyleboard_icon.png");
				}

			});
		});
		$('#mega-menu-3').dcMegaMenu({
			rowItems: '1',
			speed: 'fast'
		});
		<?php $status =0; ?>
		<?php for ($b_i=1;$b_i<7;$b_i++) :?>
		<?php if ($badge_level[$b_i]>0) :?>
		$("#badgePopup").dialog({
			width: 381,
			height: 402,
			modal: true
		});
		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/badge_success/<?php echo $b_i; ?>',
			success: function (data) {
			}
		});
		<?php $status=$b_i;break; ?>
		<?php endif;?>
		<?php endfor; ?>
		<?php if($status==0) :?>
		<?php for ($b_i=71;$b_i<76;$b_i++) :?>
		<?php if ($badge_level[$b_i]>0) :?>
		$("#badgePopup").dialog({
			width: 381,
			height: 402,
			modal: true
		});
		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/badge_success/<?php echo $b_i; ?>',
			success: function (data) {
			}
		});
		<?php $status=$b_i;break; ?>
		<?php endif;?>
		<?php endfor; ?>
		<?php endif; ?>
	});
</script>
<script>
	var _gaq = [
		['_setAccount', 'UA-XXXXX-X'],
		['_trackPageview']
	];
	(function (d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g, s)
	}(document, 'script'));

</script>
<script type="text/javascript">
	$(function () {
		$(".icon2").click(function () {
			$("#rankPopup").dialog({
				width: 415,
				height: 185,
				modal: true
			});
		});
		$(".closeNewRank").click(function () {
			$("#rankPopup").dialog('close');
		});

		$(".furnitureText").each(function () {
			var len = 23;
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
		$(".beachText").each(function () {
			var len = 27;
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
		$(".header_stores").click(function () {
			$(".homeTab1").hide();
			$(".homeTab3").hide();
			$(".homeTab2").show();

		});
		$(".categories").click(function () {
			$(".homeTab2").hide();
			$(".homeTab3").hide();
			$(".homeTab1").show();

		});
		$(".most_fancied").click(function () {
			$(".homeTab1").hide();
			$(".homeTab2").hide();
			$(".homeTab3").show();

		});
	});

</script>
<header class="header" onLoad> <?php if ($user_id != 0): ?>
		<div id="fb-root"></div>
		<script src="http://connect.facebook.net/en_US/all.js"></script>
		<script>
			FB.init(
				{
					appId:<?php echo $app_id; ?>,
					frictionlessRequests: true,
					cookie: true,
					status: true,
					xfbml: true
				});

			function sendRequestViaMultiFriendSelector() {
				FB.ui({method: 'apprequests',
					message: 'Welcome to Buynbrag...'
				}, requestCallback);
			}

			function requestCallback(response) {
				// Handle callback here
			}
		</script> <?php endif; ?>
	<div class="headerTop">
		<div class="headerContainer"><a href="<?php echo $base_url . 'user_info/homepage_afterlogin' ?>">
				<div class="logo"></div>
			</a>

			<div class="iconItem"> <?php if ($count_poll > 0) $poll_url = "my_polls"; else $poll_url = "poll_page"; ?><a
					href="<?php echo $base_url; ?>index.php/poll/<?php echo $poll_url; ?>" class="showtooltip3"
					title="Polls">
					<div class="icon1">
						<div class="headerIcon2 headerFancyIcon" style="background-repeat: no-repeat;"></div>
						<div class="circle1"><?php echo $count_poll; ?></div>
						<div class="pollText">Poll</div>
					</div>
				</a>

				<div class="headerSeperator"></div> <?php $url = $base_url . 'order/user_fancy_product'; ?> <a
					href="<?php echo $url; ?>" class="showtooltip3" title="Fancy">
					<div class="icon1">
						<div class="headerIcon3"></div>
						<div class="circle1" style="margin-top:10px;"><?php echo $count_fancy; ?></div>
						<div class="pollText">Fancy</div>
					</div>
				</a>

				<div class="headerSeperator"></div>
				<div
					class="pplImage"> <?php $filename = "assets/images/users/" . $user_id . '/' . $user_id . '.jpg'; if (file_exists($filename)): ?>
						<img
							src="<?php echo $base_url; ?>assets/images/users/<?php echo $user_id; ?>/<?php echo $user_id; ?>.jpg"
							height="50" width="50" alt="profile_pic"/> <?php elseif (!empty($fb_uid)): ?> <img
						src="http://graph.facebook.com/<?php echo $fb_uid; ?>/picture?type=small" height="50" width="50"
						alt="profile_pic"/> <?php else: ?> <img
						src="<?php echo $base_url; ?>assets/images/default/defsmall.jpg" height="40" width="40"
						alt="profile_pic"/> <?php endif; ?> </div>
				<div class="headerSeperator"></div>
				<div class="subbottom">
					<dl id="sample" class="headerdropdown fl">
						<dt></dt>
						<dd>
							<ul>
								<div class="arrowDropdown7"></div>
								<li><a class="newStyleColumn" href="<?php echo $base_url; ?>user_info/user_detail/">
										<div
											class="paddingstyle prtext"><?php if ($userdetails != 0) echo $userdetails[0]->full_name; else echo ''; ?></div>
										<div class="profileText">view my profile</div>
										<span class="value">PR</span></a></li>
								<li><a class="noborder profile_header"
								       href="<?php echo $base_url; ?>user_info/purchase_history/">
										<div class="paddingstyle prtext">Orders</div>
										<div class="drop_icon"><?php echo $count_order; ?></div>
										<span class="value">PR</span></a></li>
								<li><a href="<?php echo $base_url;?>order/user_fancy_product"
								       class="noborder profile_header">
										<div class="paddingstyle prtext">Fancy</div>
										<div class="drop_icon"><?php echo $count_fancy; ?></div>
										<span class="value">FA</span></a></li>
								<li><a href="<?php echo $base_url; ?>index.php/poll/poll_page"
								       class="noborder profile_header">
										<div class="paddingstyle prtext">Poll</div>
										<div class="drop_icon"><?php echo $count_poll; ?></div>
										<span class="value">PL</span></a></li>
								<!-- <li><a href="javascript:void(0)" class="noborder profile_header"><div class="paddingstyle prtext">Friends</div><div class="drop_icon"><?php echo count($friends); ?></div><span class="value">PL</span></a></li>-->
								<li><a href="<?php echo $base_url; ?>user_info/badges" class="noborder profile_header">
										<div class="paddingstyle prtext">Badges</div>
										<div class="drop_icon"><?php echo $count_badge; ?></div>
										<span class="value">PL</span></a></li>
								<li><a href="<?php echo $base_url; ?>user/logout" class="noborder profile_header">
										<div class="paddingstyle prtext">Logout</div>
										<span class="value">PL</span></a></li>
								<!-- <li><a href="javascript:void(0)"><img class="icons" src="images/dropblog_icon.png" alt=""/><div class="paddingstyle">Blog</div><span class="value">BL</span></a></li> <li><a href="javascript:void(0)"><img class="icons" src="images/dropstyleboard_icon.png" alt=""/><div class="paddingstyle">StyleBoard</div><span class="value">SB</span></a></li>-->
							</ul>
						</dd>
					</dl>
				</div>
				<a href="#" class="showtooltip3"
				   title="My Rank"> <?php $rankclass = 'maleIcon'; if (isset($userdetails[0])) {
						if ($userdetails[0]->gender == 'male') $rankclass = "maleIcon"; else $rankclass = "femaleIcon";
					} ?>
					<div class="icon2">
						<div class="<?php echo $rankclass; ?> " style="background-repeat: no-repeat;">
							<div
								class="circle2"> <?php if (isset($my_rank[0])) echo $my_rank[0]->rank; else echo 0; ?> </div>
						</div>
						<div class="pollText" id="rank" style="width:43px;">Rank</div>
					</div>
				</a>

				<div class="headerSeperator"></div> <?php $url = $base_url . 'index.php/cart/shopping_cart'; ?> <a
					href="<?php echo $url; ?>" class="showtooltip3" title="Shopping Cart">
					<div class="icon1">
						<div class="headerIcon4"></div>
						<div class="circle1" style="margin-top:11px;"><?php echo $count_cart; ?></div>
						<div class="pollText">Your Cart</div>
					</div>
				</a></div>
		</div>
	</div>
	<div class="navigation">
		<nav class="navigationMiddle">
			<div class="logoChain"></div>
			<div class="navigationContainer">
				<div class="grey">
					<ul id="mega-menu-3" class="mega-menu"> <?php //if(isset($funiturehad)): ?>
						<li><a href="javascript:void(0)">
								<div class="hom" id="homeTab">
									<div class="furnitureImage"></div>
									<div class="home" id="hometext">Furniture</div>
								</div>
							</a>
							<ul>
								<div class="homeDropDown homeTab1">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores">Stores</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a></div>
									<div class="mainHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Cosmetics</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="productHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Garments</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a></div>
									<div class="storesHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Furnitures</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a></div>
									<div class="editorsHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Jwellery</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
								</div>
								<div class="homeDropDown_stores homeTab2" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected" style="padding: 11px 26px;">Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
								<div class="homeDropDown_stores homeTab3" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores" style="padding: 11px 26px;">
												Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
							</ul>
						</li><?php //endif; ?> <?php if (isset($phad)): ?>
							<li><a href="javascript:void(0)">
								<div class="hom" id="homeTab">
									<div class="homeImage"></div>
									<div class="home" id="hometext">D&#233;cor &amp; Furnishing</div>
								</div>
							</a>
							<ul>
								<div class="homeDropDown homeTab1">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores">Stores</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a></div>
									<div class="mainHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Cosmetics</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="productHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Garments</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a></div>
									<div class="storesHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Furnitures</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a></div>
									<div class="editorsHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Jwellery</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
								</div>
								<div class="homeDropDown_stores homeTab2" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected" style="padding: 11px 26px;">Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
								<div class="homeDropDown_stores homeTab3" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores" style="padding: 11px 26px;">
												Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
							</ul> </li><?php endif; ?> <?php //if(isset($dininghad)): ?>
						<li><a href="javascript:void(0)">
								<div class="hom" id="homeTab">
									<div class="DiningImage"></div>
									<div class="home" id="diningtext">Dining Lightning</div>
								</div>
							</a>
							<ul>
								<div class="homeDropDown homeTab1">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores">Stores</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a></div>
									<div class="mainHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Cosmetics</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="productHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Garments</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a></div>
									<div class="storesHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Furnitures</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a></div>
									<div class="editorsHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Jwellery</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
								</div>
								<div class="homeDropDown_stores homeTab2" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected" style="padding: 11px 26px;">Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
								<div class="homeDropDown_stores homeTab3" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores" style="padding: 11px 26px;">
												Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
							</ul>
						</li><?php //endif; ?> <?php //if(isset($lightinghad)): ?>
						<li><a href="javascript:void(0)">
								<div class="hom" id="homeTab">
									<div class="LightingImage"></div>
									<div class="home" id="diningtext">Lightning</div>
								</div>
							</a>
							<ul>
								<div class="homeDropDown homeTab1">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores">Stores</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a></div>
									<div class="mainHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Cosmetics</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="productHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Garments</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a></div>
									<div class="storesHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Furnitures</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a></div>
									<div class="editorsHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Jwellery</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
								</div>
								<div class="homeDropDown_stores homeTab2" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected" style="padding: 11px 26px;">Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
								<div class="homeDropDown_stores homeTab3" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores" style="padding: 11px 26px;">
												Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
							</ul>
						</li><?php //endif; ?> <?php if (isset($pfashion)): ?>
							<li><a href="<?php echo $base_url . 'categories/cat_product/2' ?>">
									<div class="fash" id="fashTab">
										<div class="fashionImage"></div>
										<div class="home" id="fashiontext">Fashion</div>
									</div>
								</a>
								<ul>
									<div class="homeDropDown2 homeTab1">
										<div class="arrowDropdown"></div>
										<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
												<div class="mainHeadingTextSelected">Categories</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText header_stores">Stores</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText most_fancied">Most Fancied</div>
											</a></div>
										<div class="mainHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Cosmetics</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Lipstick</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a></div>
										<div class="productHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Garments</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Lipstick</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a></div>
										<div class="storesHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Furnitures</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a></div>
										<div class="editorsHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Jwellery</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a></div>
									</div>
									<div class="homeDropDown_stores homeTab2" style="display:none;">
										<div class="arrowDropdown"></div>
										<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
												<div class="mainHeadingText categories">Categories</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingTextSelected" style="padding: 11px 26px;">
													Stores
												</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText most_fancied">Most Fancied</div>
											</a>
										</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
											<div class="<?php echo $saleclass; ?>">
												<div class="imageHolderDropdown"><img
														src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
														style="width:40px;height:40px;"/></div>
												<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
												                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

													<div class="price_holder">
														<div class="priceHolder" style="float:left;">Upto</div>
														<div class="priceHolder" style="float:left;">
															<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
																/- </strong>OFF
														</div>
													</div>
												</div>
											</div> <?php endif; endfor; ?> </div>
									<div class="homeDropDown_stores homeTab3" style="display:none;">
										<div class="arrowDropdown"></div>
										<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
												<div class="mainHeadingText categories">Categories</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText header_stores" style="padding: 11px 26px;">
													Stores
												</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingTextSelected">Most Fancied</div>
											</a>
										</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
											<div class="<?php echo $saleclass; ?>">
												<div class="imageHolderDropdown"><img
														src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
														style="width:40px;height:40px;"/></div>
												<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
												                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

													<div class="price_holder">
														<div class="priceHolder" style="float:left;">Upto</div>
														<div class="priceHolder" style="float:left;">
															<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
																/- </strong>OFF
														</div>
													</div>
												</div>
											</div> <?php endif; endfor; ?> </div>
								</ul>
							</li> <?php endif; ?> <?php if (isset($part)): ?>
							<li><a href="<?php echo $base_url . 'categories/cat_product/3' ?>">
								<div class="at" id="atTab">
									<div class="artImage"></div>
									<div class="home" id="arttext">Art</div>
								</div>
							</a>
							<ul>
								<div class="homeDropDown3 homeTab1">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores">Stores</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a></div>
									<div class="mainHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Cosmetics</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="productHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Garments</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a></div>
									<div class="storesHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Furnitures</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a></div>
									<div class="editorsHeadingContainer"><a href="javascript:void(0)">
											<div class="mainCatText">Jwellery</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
								</div>
								<div class="homeDropDown_stores homeTab2" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected" style="padding: 11px 26px;">Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText most_fancied">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
								<div class="homeDropDown_stores homeTab3" style="display:none;">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingText categories">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText header_stores" style="padding: 11px 26px;">
												Stores
											</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Most Fancied</div>
										</a>
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
							</ul> </li><?php endif; ?> <?php if (isset($pgizmos)): ?>
							<li><a href="<?php echo $base_url . 'categories/cat_product/4' ?>">
									<div class="gizmo" id="gizmoTab">
										<div class="gizmosImage"></div>
										<div class="home" id="gizmostext">Gizmos</div>
									</div>
								</a>
								<ul>
									<div class="homeDropDown4 homeTab1">
										<div class="arrowDropdown"></div>
										<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
												<div class="mainHeadingTextSelected">Categories</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText header_stores">Stores</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText most_fancied">Most Fancied</div>
											</a></div>
										<div class="mainHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Cosmetics</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Lipstick</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a></div>
										<div class="productHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Garments</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Lipstick</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a></div>
										<div class="storesHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Furnitures</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a></div>
										<div class="editorsHeadingContainer"><a href="javascript:void(0)">
												<div class="mainCatText">Jwellery</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Nail Polish</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Perfume</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Eye Shadow</div>
											</a> <a href="javascript:void(0)">
												<div class="furnitureText">Shop by Brand</div>
											</a></div>
									</div>
									<div class="homeDropDown_stores homeTab2" style="display:none;">
										<div class="arrowDropdown"></div>
										<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
												<div class="mainHeadingText categories">Categories</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingTextSelected" style="padding: 11px 26px;">
													Stores
												</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText most_fancied">Most Fancied</div>
											</a>
										</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
											<div class="<?php echo $saleclass; ?>">
												<div class="imageHolderDropdown"><img
														src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
														style="width:40px;height:40px;"/></div>
												<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
												                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

													<div class="price_holder">
														<div class="priceHolder" style="float:left;">Upto</div>
														<div class="priceHolder" style="float:left;">
															<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
																/- </strong>OFF
														</div>
													</div>
												</div>
											</div> <?php endif; endfor; ?> </div>
									<div class="homeDropDown_stores homeTab3" style="display:none;">
										<div class="arrowDropdown"></div>
										<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
												<div class="mainHeadingText categories">Categories</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingText header_stores" style="padding: 11px 26px;">
													Stores
												</div>
											</a> <a href="javascript:void(0)">
												<div class="mainHeadingTextSelected">Most Fancied</div>
											</a>
										</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
											<div class="<?php echo $saleclass; ?>">
												<div class="imageHolderDropdown"><img
														src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
														style="width:40px;height:40px;"/></div>
												<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
												                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

													<div class="price_holder">
														<div class="priceHolder" style="float:left;">Upto</div>
														<div class="priceHolder" style="float:left;">
															<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
																/- </strong>OFF
														</div>
													</div>
												</div>
											</div> <?php endif; endfor; ?> </div>
								</ul>
							</li> <?php endif; ?> <?php if (isset($ppers)): ?>
							<li><a href="<?php echo $base_url . 'categories/cat_product/5' ?>">
								<div class="personal" id="personalTab">
									<div class="personalcareImage"></div>
									<div class="home" id="personalcaretext">Personal Care</div>
								</div>
							</a>
							<ul>
								<div class="homeDropDown4">
									<div class="arrowDropdown"></div>
									<div class="dropdownHeadingContainer"><a href="javascript:void(0)">
											<div class="mainHeadingTextSelected">Categories</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText">Stores</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText">Most Fancied</div>
										</a> <a href="javascript:void(0)">
											<div class="mainHeadingText">Editors Faves</div>
										</a></div>
									<div class="mainHeadingContainer"><a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="productHeadingContainer"><a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="storesHeadingContainer"><a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
									<div class="editorsHeadingContainer"><a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Lipstick</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Nail Polish</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Perfume</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Eye Shadow</div>
										</a> <a href="javascript:void(0)">
											<div class="furnitureText">Shop by Brand</div>
										</a></div>
								</div>
							</ul> </li><?php endif; ?>
						<li class="sale"><a href="javascript:void(0)">
								<div class="salesText">
									<div class="salesImage"></div>
									<div class="home" id="saletext">Sale</div>
								</div>
							</a>
							<ul>
								<div class="homeDropDown6">
									<div class="arrowDropdown6"></div>
									<div class="SalesByCategory">Sales By Category
									</div> <?php for ($s = 0; $s < 7; $s++): if (isset($sale_prod[$s][0])): if ($s % 2 == 0) $saleclass = "dropdownContentsHolder clear_both"; else $saleclass = "dropdownContentsHolder"; ?>
										<div class="<?php echo $saleclass; ?>">
											<div class="imageHolderDropdown"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $sale_prod[$s][0]->store_id; ?>/<?php echo $sale_prod[$s][0]->product_id; ?>/img1_73x73.jpg"
													style="width:40px;height:40px;"/></div>
											<div class="namePrice"><a class="nameHeading" style="color:#FFF;"
											                          href="<?php echo $base_url; ?>sale/discount_sale/<?php echo $s + 1; ?>"> <?php echo $sale[$s]->category_name; ?> </a>

												<div class="price_holder">
													<div class="priceHolder" style="float:left;">Upto</div>
													<div class="priceHolder" style="float:left;">
														<strong>Rs <?php echo $sale_prod[$s][0]->discount; ?>
															/- </strong>OFF
													</div>
												</div>
											</div>
										</div> <?php endif; endfor; ?> </div>
							</ul>
						</li>
						<div class="diwaliContainer">
							<div class="diwaliImage"></div>
							<a class="home" id="occtext" href="<?php echo $base_url ?>sale/occ/diwali">Diwali</a></div>
					</ul>
				</div>
				<!-- <div class="productsLink" style="margin-left: 178px;"> <div class="inviteLogo2" onclick="sendRequestViaMultiFriendSelector(); return false;"></div> <div class="newPadding home" onclick="sendRequestViaMultiFriendSelector(); return false;">Invite Friends</div> </div>-->
				<!-- <div class="discover"> <div class="discoverDrop"> <select id="basic-combo" name="basic-combo" onchange="javascript:changselect(this)"> <option value="javascript:void(0)">Discover</option> <option value="dealsland.php">Deals</option> <option value="way_to_store_taste_test.php">Tastes</option> <option value="way_to_store.php">Stores</option> <option value="marketplaces2.php">Marketplaces</option> </select> </div> </div>-->
				<!-- <div class="search"> <div class="searchBox"> <select id="combo" name="basic-combo"> <option value="pr">Products</option> <option value="pr">People</option> <option value="li">Lists</option> <option value="st">Stores</option> <option value="sa">Sale</option> <option value="br">Brand</option> <option value="po">Polls</option> </select> </div> </div> <div class="searchIconBox"> <div class="searchIcon"></div> </div> -->
			</div>
		</nav>
	</div>
	<div class="rankPopup" id="rankPopup">
		<div class="rankpopUpTransp"></div>
		<div class="rankpopUpActual">
			<div class="headingContainer">
				<div class="headin">What is Rank ?</div>
				<div class="closeNewRank"></div>
			</div>
			<div class="body_text" style="clear:both;">Your rank is real - time popularity score of the things you've
				fancied.
				<div style="padding-top:8px;"> The more popular your things, the higher your rank.</div>
				<div style="padding-top:8px;">Fancy things you love, let the world follow.</div>
			</div>
		</div>
	</div>
</header> <?php if ($status > 0) : ?> <?php switch ($status) {
	case 1:
		$badge_path = 'view';
		break;
	case 2:
		$badge_path = 'poll';
		break;
	case 3:
		$badge_path = 'fstore';
		break;
	case 4:
		$badge_path = 'fprod';
		break;
	case 5:
		$badge_path = 'brag';
		break;
	case 6:
		$badge_path = 'buy';
		break;
} ?>
	<div class="badgePopup" id="badgePopup">
		<div class="badgePopupTransp"></div>
		<div class="badgePopupActual">
			<div class="b_icon_holder"><img
					src="<?php echo $base_url;?>assets/images/badges/<?php echo $badge_path;?>/<?php echo $badge_level[$status];?>.png"/>
			</div>
			<!-- <div id="badge_close" class="badge_close"></div> --> </div>
	</div> <?php endif; ?>
<script type="text/javascript">
	$(".b_icon_holder").click(function () {
		$("#badgePopup").dialog('close');
		$.ajax({
			url: "<?php echo $base_url; ?>" + 'index.php/ajax/badge_success/<?php echo $b_i; ?>',
			success: function (data) {
			}
		});
	});
</script> <!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
	window.$zopim || (function (d, s) {
		var z = $zopim = function (c) {
			z._.push(c)
		}, $ = z.s =
			d.createElement(s), e = d.getElementsByTagName(s)[0];
		z.set = function (o) {
			z.set.
				_.push(o)
		};
		z._ = [];
		z.set._ = [];
		$.async = !0;
		$.setAttribute('charset', 'utf-8');
		$.src = '//cdn.zopim.com/?cepyWqn8hSI5UyvtIPXCkXHHyej1Ossn';
		z.t = +new Date;
		$.
			type = 'text/javascript';
		e.parentNode.insertBefore($, e)
	})(document, 'script');
</script> <!--End of Zopim Live Chat Script--> <!-- google analytics -->
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-35785264-1']);
	_gaq.push(['_setDomainName', 'buynbrag.com']);
	_gaq.push(['_trackPageview']);

	(function () {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();
</script> <!-- End of Google Analytics --> <!-- KISS Analytics -->
<script type="text/javascript">
	var _kmq = _kmq || [];
	var _kmk = _kmk || '01842e2b4f6b54c0db54a34188cc102ccaf80b5b';
	function _kms(u) {
		setTimeout(function () {
			var d = document, f = d.getElementsByTagName('script')[0],
				s = d.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = u;
			f.parentNode.insertBefore(s, f);
		}, 1);
	}
	_kms('//i.kissmetrics.com/i.js');
	_kms('//doug1izaerwt3.cloudfront.net/' + _kmk + '.1.js');
</script> <?php include "friends_follower.php" ?>