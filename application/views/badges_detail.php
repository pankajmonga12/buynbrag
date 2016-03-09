<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Badge Details</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/badges.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="topBanerPatternContainer"></div>
			<div class="bannerAuto">
				<div class="owner_pic"><img src="<?php echo $base_url; ?>assets/images/pavankudla_image_invie.png"
				                            alt="Owner Pic"/></div>
				<div class="bannerMid bannerwidthBadges">
					<div class="owner_name">PAVAN KUDLA</div>
					<div class="merbershipDate">Member since January, 2012</div>
					<div class="badgesContainer">
						<div class="silverBadge"></div>
						<div class="goldBadge"></div>
						<div class="platinumBadge"></div>
						<a href="badges.php">
							<div class="pinkBadge">
								<div class="white_text">+19</div>
							</div>
						</a></div>
				</div>
				<div class="bannerRight"><a href="styleboard.php">
						<div class="logoBox1">
							<div class="styleboardIconPlus"></div>
							<div class="logoText">
								<div>Create</div>
								<div>Styleboard</div>
							</div>
						</div>
					</a> <a href="blog.php">
						<div class="logoBox">
							<div class="BlogIconPlus"></div>
							<div class="logoText">
								<div>Create</div>
								<div>Blog</div>
							</div>
						</div>
					</a> <a href="fancy_product.php">
						<div class="logoBox">
							<div class="iconFancy"></div>
							<div class="logoNumber"><?php echo $countfprod; ?></div>
							<div class="logoText">fancy</div>
						</div>
					</a> <a href="create_poll.php">
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
		<div class="linksMiddle"><a href="user_network_activities.php">
				<div class="productsLink">
					<div class="activityLogo"></div>
					<div class="productsText newPadding">Activities</div>
				</div>
			</a> <a href="personal_details.php">
				<div class="productsLink">
					<div class="profileLogo"></div>
					<div class="productsText newPadding">Profile</div>
				</div>
			</a> <a href="message.php">
				<div class="productsLink">
					<div class="messageLogo"></div>
					<div class="productsText newPadding">Message</div>
				</div>
			</a> <a href="invite_people_second.php">
				<div class="productsLink">
					<div class="inviteLogo2"></div>
					<div class="productsText newPadding">Invite People</div>
				</div>
			</a> <a href="purchase_history.php">
				<div class="purchaseHistory">
					<div class="purchaseHistoryLogo"></div>
					<div class="purchaseText1">Purchase History</div>
				</div>
			</a></div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground noMinHeight">
		<div class="categoriesContainerFancy">
			<div class="categoryIcons"><a href="badges.php">
					<div class="roundhBadgeActive"></div>
				</a>

				<div class="categoriesText">BADGES</div>
				<a href="styleboard.php" title="Styleboard" class="showtooltip">
					<div class="roundStyleboard"></div>
				</a> <a href="blog.php" title="Blog" class="showtooltip">
					<div class="roundBlog"></div>
				</a> <a href="javascript:void(0)" title="Fancy" class="showtooltip">
					<div class="roundFancy"></div>
				</a> <a href="create_poll.php" title="Poll" class="showtooltip">
					<div class="roundPoll"></div>
				</a></div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="fancyContentsContainer">
			<div class="fancyForHeight">
				<div class="leftPanel">
					<div class="badgeDetailImg"><img
							src="<?php echo $base_url; ?>assets/images/badges/Poll/thedemocrat_I.png"
							alt="The Democrat I"/></div>
					<div class="fl">
						<div class="badgeDetailName">The Democrat</div>
						<div class="badgeInfo">You've just earned one of your �The Democrat� badge. Fancy, Brag and Buy
							the things you love and you'll earn more badges in no time!
						</div>
						<div class="badgeUnlockDetail">You have unlocked this badge on 12 jun, 2012</div>
						<button class="bragBadge" type="button">Brag</button>
					</div>
				</div>
				<div class="panelSeperator"></div>
				<div class="rightPanel">
					<div class="badgeDetailNum">78</div>
					<div class="badgeDetailtext">friends earned this badge</div>
					<div class="badgeDetailSep"></div>
					<div class="badgeDetailNum">62378</div>
					<div class="badgeDetailtext">earned this badge</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
</html>