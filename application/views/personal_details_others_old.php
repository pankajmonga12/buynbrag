<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>User Profile</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/friends_follower.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_owner_profile.css"/>
	<style type="text/css">
		.profile_header {
			background-image: none !important;
			background-color: #F7F7F7 !important;
		}

		.prtext {
			color: #e81c4d;
		}
	</style>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->
	<script type="text/javascript">

		$(function () {
			tooltip2();
		});
	</script>
</head>
<body>
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="topBanerPatternContainer"></div>
			<div class="bannerAuto">
				<div
					class="owner_pic"> <?php $filename = 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; if (file_exists($filename)): ?>
						<img width="156px" height="156px"
						     src="<?php echo $base_url . 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; ?>"
						     alt="Owner Pic"/> <?php else: ?> <img width="156px" height="156px"
				                                                   src="<?php echo $base_url . 'assets/images/default/defbig.jpg'; ?>"
				                                                   alt="Owner Pic"/> <?php endif; ?> </div>
				<div class="bannerMid">
					<div class="owner_name"><?php echo ucwords(strtolower($userinfo[0]->full_name));?></div>
					<div class="merbershipDate">Member
						since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
					<div
						class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
							for ($i = 0; $i < $n; $i++): ?> <img
								src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>"
								class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
							<div class="pinkBadge"><a
									href="<?php echo $base_url . 'user_info/badge_friends/' . $uid; ?>">
									<div class="white_text">+<?php echo count($badges) - $n; ?></div>
								</a></div> <?php endif; ?> </div>
				</div>
				<div class="bannerRight">
					<!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div> </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
					<!--<a href="<?php echo $base_url."order/friend_fancy_product/".$uid; ?>"><div class="logoBox">-->
					<div class="iconFancy"></div>
					<div class="logoNumber"><?php echo $countfprod; ?></div>
					<div class="logoText">fancy</div>
				</div>
				<!--</a>-->
				<!-- <a href="<?php echo $base_url."index.php/poll/create_poll"; ?>" > <div class="logoBox borderRight"> <div class="PollIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Poll</div> </div> </div> </a>-->
			</div>
		</div>
		</div> </article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle">
			<!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
			<a href="javascript:void(0)">
				<div class="dashboardLink linkWidth">
					<div class="profileLogoClick"></div>
					<div class="activeText">Profile</div>
				</div>
			</a>
			<!-- <a href="invite_people_second.php"><div class="productsLink"> <div class="inviteLogo2"></div> <div class="productsText newPadding">Invite People</div> </div></a> <a href="javascript:void(0)"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a>-->
			<div class="twoLinks"> <?php echo form_open(''); ?> <input type="submit" name="btn_fnf"
			                                                           class="followingButton"
			                                                           value="<?php echo $f_status[1]; ?>">

				<div class="followText"></div>
				</input>
				<!-- <button type="button" class="messageButton"> <div class="messageImg"></div> <div class="followText">Send Message</div> </button>--> </form>
			</div>
		</div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground">
		<div class="contentsWrapper">
			<div class="middleContents">
				<div class="leftPanel">
					<div class="personalDetails">
						<div class="personalDetailLogo"></div>
						<div class="personalText">Personal Details</div>
					</div>
					<div class="topDotSeparator newtopDotSeparator2"></div>
					<div class="aboutMeContent clear_both"> <?php if (isset($userinfo[0]->nick_name)): ?>
							<div class="darkBlackText"><?php echo $userinfo[0]->nick_name;?><span class="lightText">nickname</span>
							</div> <?php endif; ?> <?php if (isset($userinfo[0]->gender)): ?>
							<div class="darkBlackText"><?php echo $userinfo[0]->gender;?><span
									class="lightText">gender</span>
							</div> <?php endif; ?> <?php if (isset($userinfo[0]->about_me)): ?>
							<div><span><img
										src="<?php echo $base_url; ?>assets/images/comma_left.png"/></span> <?php echo $userinfo[0]->about_me;?>
								<span><img src="<?php echo $base_url; ?>assets/images/comma_right.png"/></span><span
									class="lightText">about me</span>
							</div> <?php endif; ?> <?php if (isset($userinfo[0]->interested_in)): ?>
							<div class="darkBlackText"><?php echo $userinfo[0]->interested_in;?><span class="lightText">interests</span>
							</div> <?php endif; ?> <?php if (isset($userinfo[0]->taste)): ?>
							<div class="darkBlackText"><?php echo $userinfo[0]->taste;?><span class="lightText">my tastes</span>
							</div> <?php endif; ?> </div>
				</div>
				<div class="panelSeperator newpanelHeight"></div>
				<div class="rightPanel">
					<!-- <div class="darkText paddingBottom0">Shoutbox</div> <div class="FirstImageContainer"> <div class="commentRow"> <a href="javascript:void(0)"><div class="float_left"> <img src="<?php echo $base_url; ?>assets/images/shoubox_1.png"/> </div></a> <div class="sideDiv"> <a href="javascript:void(0)" class="nameofperson">Rex Allen</a><span class="lightText">says</span><span class="duration">10 mins ago</span> <div class="comment">This is even myâ€™n fav product :)</div> </div> </div> <div class="commentRow clear_both"> <a href="javascript:void(0)"><div class="float_left"> <img src="<?php echo $base_url; ?>assets/images/shoubox_2.png"/> </div></a> <div class="sideDiv"> <a href="javascript:void(0)" class="nameofperson">Leanna</a><span class="lightText">says</span><span class="duration">30 mins ago</span> <div class="comment">Wow this is awesone, i want some...</div> </div> </div> <div class="commentRow clear_both"> <a href="javascript:void(0)"><div class="float_left"> <img src="<?php echo $base_url; ?>assets/images/shoubox_1.png"/> </div></a> <div class="sideDiv"> <a href="javascript:void(0)" class="nameofperson">Rex Allen</a><span class="lightText">says</span><span class="duration">10 mins ago</span> <div class="comment">This is even myâ€™n fav product :)</div> </div> </div> <div class="commentTextBox"> <input type="text" id="commentLine" name="comments"/> <div class="enterImage"></div> </div> </div>-->
					<div class="horizontalSep clear_both"></div>
					<div class="FriendsContainer">
						<div class="friendsHeader">
							<div class="friendsIcon"></div>
							<a href="javascript:void(0)" class="darkText float_left posText">Friends</a>

							<div class="pinkText"><?php echo count($friends); ?></div>
						</div>
						<div
							class="FirstRow clear_both"> <?php if (count($friends) > 6) $n = 6; else $n = count($friends); for ($i = 0; $i < $n; $i++): ?>
								<a href="<?php echo $base_url . 'order/friend_fancy_product/' . $friends[$i]['user_id'] ?>">
									<div class="prodBg"><img
											src="<?php echo $base_url; ?>assets/images/users/<?php echo $friends[$i]['user_id'] . '/' . $friends[$i]['user_id'] . '_large.jpg'; ?>"
											width="60" height="60"/></div>
								</a> <?php endfor;?> </div>
					</div>
					<div class="horizontalSep"></div>
					<div class="FriendsContainer">
						<div class="friendsHeader">
							<div class="followersIcon"></div>
							<div class="darkText float_left posText">Followers</div>
							<div class="pinkText"><?php echo count($followers); ?></div>
						</div>
						<div
							class="FirstRow clear_both"> <?php if (count($followers) > 6) $n = 6; else $n = count($followers); for ($i = 0; $i < $n; $i++): ?>
								<a href="<?php echo $base_url . 'order/friend_fancy_product/' . $followers[$i]['user_id'] ?>">
									<div class="prodBg"><img
											src="<?php echo $base_url; ?>assets/images/users/<?php echo $followers[$i]['user_id'] . '/' . $followers[$i]['user_id'] . '_large.jpg'; ?>"
											width="62" height="62"/></div>
								</a> <?php endfor;?> </div>
					</div>
					<div class="horizontalSep"></div>
					<div class="FriendsContainer">
						<div class="friendsHeader">
							<div class="followingIcon"></div>
							<div class="darkText float_left posText">Following</div>
							<div class="pinkText"><?php echo count($followees); ?></div>
						</div>
						<div
							class="FirstRow clear_both"> <?php if (count($followees) > 6) $n = 6; else $n = count($followees); for ($i = 0; $i < $n; $i++): ?>
								<a href="<?php echo $base_url . 'order/friend_fancy_product/' . $followees[$i]['user_id'] ?>">
									<div class="prodBg"><img
											src="<?php echo $base_url; ?>assets/images/users/<?php echo $followees[$i]['user_id'] . '/' . $followees[$i]['user_id'] . '_large.jpg'; ?>"
											width="62" height="62"/></div>
								</a> <?php endfor;?> </div>
					</div>
					<div class="horizontalSep"></div>
					<!-- <div class="scrollerHolderParent"> <a href="javascript:void(0)"><div class="darkText">Poll</div></a> <div class="scrollerHolderContent"> <div class="storeViewIcon"></div> <div class="scrollerContents"> <div id="scrollLeftButton_1" class="button-block-left"></div> <div id="sliderParentDiv1" class="sliderParentDiv"> <div id="slider4" class="slider"> <div class="slideList"> <div class="sunglassWrapper"> <div class="quesTextStyle">Which Sunglass is the Best?</div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_1.png"/> </div></a> <button id="vote" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_2.png"/> </div></a> <button id="vote2" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_3.png"/> </div></a> <button id="vote3" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> </div> </div> <div class="slideList"> <div class="sunglassWrapper"> <div class="quesTextStyle">Which Sunglass is the Best?</div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_1.png"/> </div></a> <button id="vote4" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_2.png"/> </div></a> <button id="vote5" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_3.png"/> </div></a> <button id="vote6" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> </div> </div> <div class="slideList"> <div class="sunglassWrapper"> <div class="quesTextStyle">Which Sunglass is the Best?</div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_1.png"/> </div></a> <button id="vote7" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_2.png"/> </div></a> <button id="vote8" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_3.png"/> </div></a> <button id="vote9" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> </div> </div> </div> </div> <div id="scrollRightButton_1" class="button-block-right"></div> </div> </div> </div>-->
					<!-- <div class="horizontalSep"></div> <div class="scrollerHolderParent"> <a href="javascript:void(0)"><div class="darkText">Blogzine</div></a> <div class="scrollerHolderContent"> <div class="storeViewIcon"></div> <div class="scrollerContentsblog"> <div id="scrollLeftButton_2" class="button-block-left"></div> <div id="sliderParentDiv2" class="sliderParentDiv"> <div id="sliderblog" class="sliderblog"> <div class="slideList2"> <a href="javascript:void(0)"><div class="BlogWrapper"> <div class="quesTextStyle paddingBottom0">Jeans Styles for Girls</div> <div class="brandText"><span class="diffColour">by</span>Tianna Meilinger</div> <div class="blogImage"> <img src="<?php echo $base_url; ?>assets/images/blogImage.png"/> </div> <div class="blogAbout">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div></a> </div> <div class="slideList2"> <a href="javascript:void(0)"><div class="BlogWrapper"> <div class="quesTextStyle paddingBottom0">Jeans Styles for Girls</div> <div class="brandText"><span class="diffColour">by</span>Tianna Meilinger</div> <div class="blogImage"> <img src="<?php echo $base_url; ?>assets/images/blogImage.png"/> </div> <div class="blogAbout">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div></a> </div> <div class="slideList2"> <a href="javascript:void(0)"><div class="BlogWrapper"> <div class="quesTextStyle paddingBottom0">Jeans Styles for Girls</div> <div class="brandText"><span class="diffColour">by</span>Tianna Meilinger</div> <div class="blogImage"> <img src="<?php echo $base_url; ?>assets/images/blogImage.png"/> </div> <div class="blogAbout">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div></a> </div> </div> </div> <div id="scrollRightButton_2" class="button-block-right"></div> </div> </div> </div> <div class="horizontalSep clear_both"></div> <div class="rightPanelbottomScroller"> <a href="javascript:void(0)"><div class="darkText">Styleboard</div></a> <div class="scrollerHolderContent"> <div class="storeViewIcon"></div> <div class="scrollerContents3"> <div class="button-block-left" id="scrollLeftButton5"></div> <div id="sliderParentDiv_5" class="sliderParentDiv3"> <div class="slider3" id="slider5"> <div class="store-list3"> <div class="rightPanelImageHolderBottom3"> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_1.png" /></a></div> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_2.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_3.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_4.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_5.png" /></a></div> <div class="clothingFestivalText clothingTextStyle paddingTop8">Clothing Festival </div> <div class="createdJuneText clothingTextStyle">created on <span class="rockwellSpan">june 23</span></div> <div class="storeFancyHolder storeFancyHolderNew"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list3"> <div class="rightPanelImageHolderBottom3"> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_1.png" /></a></div> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_2.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_3.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_4.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_5.png" /></a></div> <div class="clothingFestivalText clothingTextStyle paddingTop8">Clothing Festival </div> <div class="createdJuneText clothingTextStyle">created on <span class="rockwellSpan">june 23</span></div> <div class="storeFancyHolder clothingTextStyle storeFancyHolderNew"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> </div> </div> <div class="button-block-right" id="scrollRightButton5"></div> </div> </div> </div>-->
				</div>
			</div>
		</div>
	</section>
</section> <?php include "friends_follower.php" ?> <?php include "footer.php" ?> </body>
<script>
	$(".pricon").attr("src", "<?php echo $base_url; ?>assets/images/dropprofile_hover.png");
	$(".pricon").siblings(".value").html(' ');
</script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/friend_follower.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_owner.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script src="<?php echo $base_url; ?>assets/js/tooltip.js"></script>
</html>