<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Fancy Store</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<style type="text/css">
		.fancy_header {
			background-image: none !important;
			background-color: #F7F7F7 !important;
		}

		.ftext {
			color: #e81c4d;
		}
	</style>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="topBanerPatternContainer"></div>
			<div class="bannerAuto">
				<div
					class="owner_pic"> <?php $filename = 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; if (file_exists($filename)): ?>
						<img width="156px" height="156px"
						     src="<?php echo $base_url . 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; ?>"
						     alt="Owner Pic"/> <?php else: ?> <img
						src="http://graph.facebook.com/<?php echo $fb_uid; ?>/picture?type=large" alt="Owner Pic"
						height="156" width="156"/> <?php endif; ?> </div>
				<div class="bannerMid bannerwidth">
					<div class="owner_name"><?php echo ucwords(strtolower($userinfo[0]->full_name));?></div>
					<div class="merbershipDate">Member
						since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
					<div
						class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
							for ($i = 0; $i < $n; $i++): ?> <img
								src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>"
								class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
							<div class="pinkBadge"><a href="<?php echo $base_url . 'user_info/badges/'?>">
									<div class="white_text">+<?php echo count($badges) - $n; ?></div>
								</a></div> <?php endif; ?> </div>
				</div>
				<div class="bannerRight">
					<!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div> </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
					<a href="<?php echo $base_url . "order/user_fancy_product"; ?>">
						<div class="logoBox">
							<div class="iconFancy"></div>
							<div class="logoNumber"><?php echo $countfprod; ?></div>
							<div class="logoText">fancy</div>
						</div>
					</a> <a href="<?php echo $base_url . "index.php/poll/create_poll"; ?>">
						<div class="logoBox borderRight">
							<div class="PollIconPlus"></div>
							<div class="logoText">
								<div>Create</div>
								<div>Poll</div>
							</div>
						</div>
					</a></div>
			</div>
		</div>
	</article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle">
			<!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
			<a href="<?php echo $base_url?>user_info/user_detail/">
				<div class="productsLink">
					<div class="profileLogo"></div>
					<div class="productsText newPadding">Profile</div>
				</div>
			</a>
			<!-- <a href="javascript:void(0)"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a> <a href="invite_people_second.php"><div class="productsLink"> <div class="inviteLogo2"></div> <div class="productsText newPadding">Invite People</div> </div></a>-->
			<a href="<?php echo $base_url?>user_info/purchase_history">
				<div class="purchaseHistory">
					<div class="purchaseHistoryLogo"></div>
					<div class="purchaseText1">Purchase History</div>
				</div>
			</a></div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground">
		<div class="categoriesContainerFancy">
			<div class="categoryIcons"><a href="<?php echo $base_url; ?>user_info/badges" title="Badges"
			                              class="showtooltip">
					<div class="roundhBadge"></div>
				</a>
				<!--<a href="styleboard.php" title="Styleboard" class="showtooltip"><div class="roundStyleboard"></div></a> <a href="blog.php" title="Blog" class="showtooltip"><div class="roundBlog"></div></a>-->
				<a href="<?php echo $base_url; ?>order/user_fancy_product">
					<div class="roundFancy_active"></div>
				</a>

				<div class="categoriesText">FANCY</div>
				<a href="<?php echo $base_url; ?>index.php/poll/create_poll" title="Poll" class="showtooltip">
					<div class="roundPoll"></div>
				</a></div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="fancyContentsContainer">
			<div class="fancyForHeight">
				<div class="sortByContainer">
					<div class="sortByContainerTransparent"></div>
					<div class="sortByContent">
						<div class="fancyLinksContainer"><a href="<?php echo $base_url?>order/user_fancy_product"
						                                    class="fl">
								<div class="fancyLink">My Fancy products</div>
								<div class="fancyBox"><?php echo $countfprod; ?></div>
							</a>

							<div class="fancySeperator"></div>
							<a href="<?php echo $base_url?>order/user_fancy_store" class="fl">
								<div class="fancyLinkActive">My Fancy Stores</div>
								<div class="fancyBox"><?php echo $countfstore; ?></div>
							</a>

							<div class="fancySeperator"></div>
							<a href="<?php echo $base_url?>order/fancy_lists" class="fl">
								<div class="fancyLink">Lists</div>
								<div class="fancyBox"><?php echo $countflist; ?></div>
							</a>
							<!-- <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Blogazine</div> <div class="fancyBox">35</div> </a> <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Styleboard</div> <div class="fancyBox">35</div> </a>-->
						</div>
					</div>
				</div>
				<div class="fancyStoreContainer">
					<div class="leftPanel">
						<div class="leftPanelCategory">Editor Picks
						</div> <?php for ($i = 0; $i < count($Efancy_stores); $i++): ?>
							<div class="leftPanelSeperator"></div>
							<div class="leftPanelBanners" onClick="return fancyStores(1)"><img
									src="<?php echo $store_url . 'assets/images/stores/' . $Efancy_stores[$i]->store_id . '/top_banner.png' ?>"
									alt="Banner"/></div> <?php endfor; ?> </div>
					<div class="panelSeparator"></div>
					<div
						class="rightPanel"> <?php for ($i = 0; $i < count($fancy_stores); $i++): ?> <?php //Generate a random number for fetching images -AS $sid = '_'.$fancy_stores[$i]->store_id; $max = count($sprod["$sid"])-1; $tm1 = rand(0, $max); $tm2 = rand(0, $max); $tm3 = rand(0, $max); //Condition check for slider -AS if ( ($i%2)==0 ) { $class="images_holder clear_both"; } else { $class="images_holder image2margin"; } ?>
							<a href="<?php echo $base_url?>order/store_page/<?php echo $fancy_stores[$i]->store_id; ?>">
								<div class="<?php echo $class; ?> message_box"
								     id="<?php echo $fancy_stores[$i]->store_id; ?>"><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $fancy_stores[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm1"]->product_id; ?>/img1_product.jpg"
										alt="big image"/>

									<div class="banner_Image"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $fancy_stores[$i]->store_id; ?>/top_banner.png"/>
									</div>
									<div class="smallImage"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $fancy_stores[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm2"]->product_id; ?>/img1_product.jpg"/>
									</div>
									<div class="mediumImage"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $fancy_stores[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm3"]->product_id; ?>/img1_product.jpg"
											alt="medium image"/></div>
									<div class="fancyBragedHolder">
										<div class="fancy_Icon"></div>
										<div class="fancy_number"><?php echo $fancy_stores[$i]->fancy_counter; ?></div>
										<div class="fancy_name">Fancied</div>
										<div class="brag_Icon clear_both"></div>
										<div class="fancy_number"><?php echo $fancy_stores[$i]->brag_counter; ?></div>
										<div class="fancy_name">Bragged</div>
									</div>
									<div class="product_number"> <?php echo $max + 1; ?>
										<div class="braged_name">Products</div>
									</div>
								</div>
							</a> <?php endfor; ?>
						<div id="more_fancy_store" class="slideBackground moreWidthStyle2 clear_both">
							<div class="slideNormal"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script>
	$(".ficon").attr("src", "<?php echo $base_url; ?>assets/images/dropfancy_hover.png");
	$(".ficon").siblings(".value").html(' ');
</script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_store.js"></script>
</html>