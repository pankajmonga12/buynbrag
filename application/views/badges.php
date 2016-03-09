<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Badges</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/badges.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<script type="text/javascript">
	$(function () {
		tooltip2();
	});
</script>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<article class="banner">
		<div class="bannerIE2">
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
					<div class="bannerMid">
						<div class="owner_name"><?php echo ucwords(strtolower($userinfo[0]->full_name));?></div>
						<div class="merbershipDate">Member
							since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
						<div
							class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
								for ($i = 0; $i < $n; $i++): ?> <img src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>" class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
								<div class="pinkBadge"><a href="<?php echo $base_url . '#/badges'?>">
										<div class="white_text">+<?php echo count($badges) - $n; ?></div>
									</a></div> <?php endif; ?> </div>
					</div>
					<div class="bannerRight">
						<!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div> </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
						<a href="<?php echo $base_url . "order/user_fancy_product"; ?>">
							<div class="logoBoxActive">
								<div class="iconFancyActive"></div>
								<div class="logoNumber"><?php echo $countfprod; ?></div>
								<div class="logoText">fancy</div>
							</div>
						</a>
<!--                        <a href="--><?php //echo $base_url . "index.php/poll/poll_page"; ?><!--">-->
<!--							<div class="logoBox borderLeft0 borderRight">-->
<!--								<div class="PollIconPlus"></div>-->
<!--								<div class="logoText">-->
<!--									<div>Create</div>-->
<!--									<div>Poll</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</a>-->
                    </div>
				</div>
			</div>
		</div>
	</article>
    <nav class="middleColumnTop">
        <div class="middleColumnIE">
            <div class="topDotSeparator newtopDotSeparator"></div>
            <div class="linksMiddle">
                <!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
                <a href="<?php echo $base_url; ?>user_info/user_detail">
                    <div class="productsLink">
                        <div class="profileLogoGrey"></div>
                        <div class="productsText newPadding">Profile</div>
                    </div>
                </a>

                <a href="<?php echo $base_url; ?>user_info/account_detail">
                    <div class="productsLink">
                        <div class="accountLogoGrey"></div>
                        <div class="productsText newPadding">Account</div>
                    </div>
                </a>

                <a href="<?php echo $base_url; ?>order/user_fancy_product">
                    <div class="productsLink">
                        <div class="inviteLogoGrey"></div>
                        <div class="productsText newPadding">Fancy List</div>
                    </div>
                </a>

                <a href="<?php echo $base_url; ?>#/badges/">
                    <div class="dashboardLink">
                        <div class="badgesLogoPink"></div>
                        <div class="activeText">Badges Earned</div>
                    </div>
                </a>


                <!-- <a href="javascript:void(0)"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a>-->
                <div class="purchaseHistory">
                    <!--  <a href="<?php echo $base_url?>user_info/get_user_detail" ><button type="submit" class="followingButton"> Edit Profile </button></a> -->

<!--                    <a href="--><?php //echo $base_url; ?><!--user_info/invite">-->
<!--                        <div class="productsLink">-->
<!--                            <div class="inviteLogo2"></div>-->
<!--                            <div class="productsText newPadding">Invite People</div>-->
<!--                        </div>-->
<!--                    </a>-->

                    <a href="<?php echo $base_url?>user_info/purchase_history">
                        <div class="purchaseHistory">
                            <div class="purchaseHistoryLogo"></div>
                            <div class="purchaseText1">Purchase History</div>
                        </div>
                    </a></div>
                <div class="topDotSeparator newtopDotSeparator1"></div>
            </div>
    </nav>
	<section class="middleBackground">
			<div class="fancyContentsContainer">
				<div class="fancyForHeight">
					<!-- <div class="badgesMainContainer"> <div class="badgesHeading">Discount Badges <span class="numOfBadges">3</span></div> <div class="discountBadgesRow"> <div class="badgeContainer"> <div class="badgeImg"><a href="badges_detail.php"><img src="<?php echo $base_url; ?>assets/images/badges/discount badges/silver.png" alt="Silver"></a></div> <div class="badgeName1">5% Offer</div> <div class="badgeName1">Silver Badge</div> </div> <div class="badgeContainer"> <div class="badgeImg"><a href="badges_detail.php"><img src="<?php echo $base_url; ?>assets/images/badges/discount badges/gold.png" alt="Gold"></a></div> <div class="badgeName1">10% Offer</div> <div class="badgeName1">Gold Badge</div> </div> <div class="badgeContainer"> <div class="badgeImg"><a href="badges_detail.php"><img src="<?php echo $base_url; ?>assets/images/badges/discount badges/platinum.png" alt="Platinum"></a></div> <div class="badgeName1">15% Offer</div> <div class="badgeName1">Platinum Badge</div> </div> </div> </div> <div class="badgeSep"></div>-->
					<div class="badgesMainContainer">
						<div class="badgesHeading">Social Badges <span
								class="numOfBadges"><?php echo count($badges); ?></span></div>
						<div class="socialBadgesRow"> <?php if (count($badges) == 0): ?>
								<div class="description_text"> We're watching you. Your art fascinations, your shoe
									fetish, what you like, what you don't. And we give you badges for it - a little
									something-something for your social billing on BuynBrag ;)
								</div> <?php endif; ?> <?php for ($i = 0; $i < count($badges); $i++): ?>
								<div class="badgeContainer">
									<div class="badgeImg"> <!--<a href="badges_detail.php">-->
										<center><img src="<?php echo $base_url; ?>assets/images/badges/<?php echo $badges[$i]['img']; ?>" alt="The Democrat I" style="width: 90px"></center>
										<!--</a>--> </div>
									<div class="badgeName"> <?php echo $badges[$i]['txt'];?> </div>
								</div> <?php endfor; ?> </div>
					</div>
				</div>
			</div>
	</section>
</section> <?php include "footer.php" ?></body>
</html>