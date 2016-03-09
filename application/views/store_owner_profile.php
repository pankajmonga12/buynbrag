<!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Store Owner Profile</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_owner_profile.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_owner_profile.css"/>
	<script type="text/javascript">
		$(function () {
			tooltip2();
		});
	</script>
</head>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="topBanerPatternContainer"></div>
			<div class="bannerAuto">
				<div
					class="owner_pic"> <?php $filename = 'assets/owner/stores/' . $ownerdata[0]->store_id . '/owner/owner.jpg'; if (file_exists($filename)):?>
					<img src="<?php echo $filename; ?>" alt="Owner Pic"/></div> <?php else: ?> <img
					src="<?php echo $base_url; ?>assets/images/default/defbig.jpg" alt="Owner Pic"/>
			</div> <?php endif; ?>
			<div class="bannerMid">
				<div class="owner_name"><?php echo $ownerdata[0]->owner_name; ?></div>
				<div class="merbershipDate">Member
					since <?php echo date("jS \of F Y ", strtotime($ownerdata[0]->date));?></div>
				<div class="badgesContainer"></div>
			</div>
	</article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle"><a href="javascript:void(0)">
				<div class="dashboardLink linkWidth">
					<div class="profileLogoClick"></div>
					<div class="activeText">Profile</div>
				</div>
			</a>
			<!-- <a href="javascript:void(0)"><div class="productsLink"> <div class="profileLogo"></div> <div class="productsText newPadding">Feedback</div> </div></a> <a href="javascript:void(0)"><div class="productsLink"> <div class="productsText newPadding">Policies</div> </div></a>-->
			<!-- <div class="twoLinks"> <button type="button" class="messageButton"> <div class="messageImg"></div> <div class="followText">Send Message</div> </button> </div>-->
		</div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground clear_both">
		<div class="contentsWrapper">
			<div class="middleContents">
				<div class="leftPanel">
					<div class="darkText">About Me</div>
					<div class="aboutMeContent">
						<div><span><img
									src="<?php echo $base_url; ?>assets/images/comma_left.png"/></span> <?php echo $ownerdata[0]->about_owner; ?>
							<span><img src="<?php echo $base_url; ?>assets/images/comma_right.png"/></span></div>
						<br>
						<!-- <div class="darkBlackText"><?php echo $ownerdata[0]->contact_number; ?><span class="lightText">mobile</span></div> <div class="darkBlackText"><?php echo $ownerdata[0]->contact_email; ?><span class="lightText">email</span></div> <div class="darkBlackText"><?php echo $ownerdata[0]->fb_link; ?><span class="lightText">website link</span></div> <div class="darkBlackText">Jonathan, Billiot, Jonathan Billiot<span class="lightText">marketing names</span></div> <div class="darkBlackText">Fashion, Cloths, Women, Homedecore<span class="lightText">tagline</span></div>-->
					</div>
				</div>
				<div class="panelSeperator"></div>
				<div class="rightPanel">
					<div class="darkText paddingBottom0">Shop</div>
					<div class="store_banner"><img alt="store_banner"
					                               src="<?php echo $store_url; ?>assets/images/stores/<?php echo $ownerdata[0]->store_id; ?>/top_banner.png">
					</div>
					<div class="FirstImageContainer">
						<div
							class="FirstRow"> <?php if (count($myprod) > 8) $n = 8; else $n = count($myprod); for ($i = 0; $i < $n; $i++): ?> <?php if ($i % 4 == 3) $class = "prodBg marginRight0"; else $class = "prodBg"; ?>
								<a href="<?php echo $base_url . 'order/product_page/' . $ownerdata[0]->store_id . '/' . $myprod[$i]->product_id; ?>">
									<div class="<?php echo $class; ?>"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $ownerdata[0]->store_id; ?>/<?php echo $myprod[$i]->product_id; ?>/img1_240x200.jpg"/>
									</div>
								</a> <?php endfor; ?> </div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script src="<?php echo $base_url; ?>assets/js/store_owner.js"></script>
<script type="text/javascript" src="js/jquery.jscrollpane.js"></script>
</html>