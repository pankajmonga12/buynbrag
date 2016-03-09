<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Poll - My Polls</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/poll.css"/>
	<style type="text/css">
		.poll_header {
			background-image: none !important;
			background-color: #F7F7F7 !important;
		}

		.ptext {
			color: #e81c4d;
		}
	</style>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
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
						     alt="Owner Pic"/> <?php else: ?> <img
						src="http://graph.facebook.com/<?php echo $fb_uid; ?>/picture?type=large" alt="Owner Pic"
						height="156" width="156"/> <?php endif; ?></div>
				<div class="bannerMid">
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
			<!-- <a href="message.php"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a> <a href="invite_people_second.php"><div class="productsLink"> <div class="inviteLogo2"></div> <div class="productsText newPadding">Invite People</div> </div></a>-->
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
				<!-- <a href="styleboard.php" title="Styleboard" class="showtooltip"><div class="roundStyleboard"></div></a> <a href="blog.php" title="Blog" class="showtooltip"><div class="roundBlog"></div></a>-->
				<a href="<?php echo $base_url; ?>order/user_fancy_product" title="Fancy" class="showtooltip">
					<div class="roundFancy"></div>
				</a> <a href="create_poll">
					<div class="roundPoll_active"></div>
				</a>

				<div class="categoriesText">POLL</div>
			</div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="fancyContentsContainer">
			<div class="fancyForHeight paddingTop10">
				<div class="leftPanel_poll" id="leftPanel_poll">
					<div class="pollContents" id="pollContents_1">
						<div class="pollHeader">
							<div id="ajax_date"
							     class="pollCreationDate"><?php if (isset($latest_poll[0])) echo date('M d', strtotime($latest_poll[0]->poll_start_date));?></div>
							<div id="ajax_ques"
							     class="pollnName"><?php if (isset($latest_poll[0])) echo $latest_poll[0]->poll_quest?></div>
							<div class="pollEditDel">
								<div class="polllEdit"></div>
								<!--<div class="pollDel" onClick="return funcDelPoll(1)"></div>--> </div>
						</div>
						<div class="pollContentsMain">
							<div class="pollItemRow">
								<div id="ajax_p1" class="pollItemBg"> <?php if (isset($latest_prod1)) : ?>
										<div class="pollItemImg"><img width="200"
										                              src="<?php echo $store_url?>assets/images/stores/<?php echo $latest_prod1[0]->store_id?>/<?php echo $latest_prod1[0]->product_id?>/img1_240x200.jpg"
										                              alt="Poll Item"/></div>
										<div
											class="pollItemName"><?php echo truncateOptionVal($latest_prod1[0]->product_name, 18);?></div> <!--<div class="pollItemInfo"><span class="rupeePoll">` </span><span class="rockwellBold"><?php echo intval($latest_prod1[0]->selling_price);?></span></div>-->
										<div class="pollItemStore">from
											<strong><?php echo $latest_prod1[0]->store_name?></strong></div>
										<div class="pollItemLastRow"> <?php if ($latest_poll[0]->poll_type == 1): ?>
											<div class="noOfVotes"><?php echo $votes_1[0]->votes;?> Like</div>
											<div class="noOfVotes"><?php echo $votes_9[0]->votes;?>Leave
											</div> <?php else : ?>
											<div class="noOfVotes"><?php echo $votes_1[0]->votes;?>Votes
											</div> <?php endif; ?>
										<div class="pollInfoComm">
											<div class="pollInfoIcon" id="pollInfoIcon_1"
											     onClick="return funcPollInfo(1)"></div>
											<!--<div class="pollCommentsIcon" id="pollCommentsIcon_1" onClick="return funcPollComments(1)"> <div class="noOfPollComments">815</div> </div>-->
										</div> </div><?php endif; ?> </div>
								<div id="ajax_p2"
								     class="pollItemBg"> <?php if (isset($latest_prod2) and ($latest_poll[0]->no_of_items > 1)) : ?>
										<div class="pollItemImg"><img width="200"
										                              src="<?php echo $store_url?>assets/images/stores/<?php echo $latest_prod2[0]->store_id?>/<?php echo $latest_prod2[0]->product_id?>/img1_92x77.jpg"
										                              alt="Poll Item"/></div>
										<div
											class="pollItemName"><?php echo truncateOptionVal($latest_prod2[0]->product_name, 18);?></div>
										<div class="pollItemInfo"><span class="rupeePoll">` </span><span
												class="rockwellBold"><?php echo intval($latest_prod2[0]->selling_price);?></span>
										</div>
										<div class="pollItemStore">from
											<strong><?php echo $latest_prod2[0]->store_name?></strong></div>
										<div class="pollItemLastRow">
										<div class="noOfVotes"><?php echo $votes_2[0]->votes;?> Votes</div>
										<div class="pollInfoComm">
											<div class="pollInfoIcon" id="pollInfoIcon_2"
											     onClick="return funcPollInfo(2)"></div>
											<!--<div class="pollCommentsIcon" id="pollCommentsIcon_2" onClick="return funcPollComments(2)"> <div class="noOfPollComments">6</div> </div>-->
										</div> </div><?php endif; ?> </div>
								<div id="ajax_p3"
								     class="pollItemBg marginRight0"> <?php if (isset($latest_prod3) and ($latest_poll[0]->no_of_items > 2)) : ?>
										<div class="pollItemImg"><img width="200"
										                              src="<?php echo $store_url?>assets/images/stores/<?php echo $latest_prod3[0]->store_id?>/<?php echo $latest_prod3[0]->product_id?>/img1_92x77.jpg"
										                              alt="Poll Item"/></div>
										<div
											class="pollItemName"><?php echo truncateOptionVal($latest_prod3[0]->product_name, 18);?></div>
										<div class="pollItemInfo"><span class="rupeePoll">` </span><span
												class="rockwellBold"><?php echo intval($latest_prod3[0]->selling_price);?></span>
										</div>
										<div class="pollItemStore">from
											<strong><?php echo $latest_prod3[0]->store_name?></strong></div>
										<div class="pollItemLastRow">
										<div class="noOfVotes"><?php echo $votes_3[0]->votes;?> Votes</div>
										<div class="pollInfoComm">
											<div class="pollInfoIcon" id="pollInfoIcon_3"
											     onClick="return funcPollInfo(3)"></div>
											<!--<div class="pollCommentsIcon" id="pollCommentsIcon_3" onClick="return funcPollComments(3)"> <div class="noOfPollComments">7</div> </div>-->
										</div> </div><?php endif; ?> </div>
							</div>
							<div class="pollSocialRow"> <!--<div class="pollBrag"></div>-->
								<!--<div class="pollFb"></div> <div class="pollTweet"></div>--> </div>
						</div>
						<div class="pollInfo" id="pollInfo_1">
							<div class="pollInfoHeader">
								<div class="fl">
									<div class="pollItemNameBig"><?php echo $latest_prod1[0]->product_name?></div>
									<div class="pollItemStoreBig"> from <span
											class="storeName"><?php echo $latest_prod1[0]->store_name?></span></div>
								</div>
								<div class="fr">
									<button type="button" id="add_to_cart_1" name="add_to_cart_1" class="add_to_cart">
										<div class="pollItemPrice"><span
												class="rupeePollBig">`</span> <?php echo intval($latest_prod1[0]->selling_price);?>
										</div>
										<!--<div class="buttonInnerSep"></div> <div class="shoppingCartIcon"></div>-->
									</button>
								</div>
							</div>
							<div class="pollItemInfoRow paddingTop25"><?php echo $latest_prod1[0]->description?></div>
							<div class="pollItemInfoRow">Tags:<?php echo $latest_prod1[0]->tags?></div>
							<div class="pollItemInfoRow">Weight: <?php echo $latest_prod1[0]->prd_act_weight?></div>
							<div class="pollItemInfoRow">Style: <?php echo $latest_prod1[0]->style?></div>
						</div>
						<div class="pollInfo" id="pollInfo_2">
							<div class="pollInfoHeader">
								<div class="fl">
									<div class="pollItemNameBig"><?php echo $latest_prod2[0]->product_name?></div>
									<div class="pollItemStoreBig">from <span
											class="storeName"><?php echo $latest_prod2[0]->store_name?></span></div>
								</div>
								<div class="fr">
									<button type="button" id="add_to_cart_2" name="add_to_cart_2" class="add_to_cart">
										<div class="pollItemPrice"><span
												class="rupeePollBig">`</span> <?php echo intval($latest_prod2[0]->selling_price);?>
										</div>
										<!--<div class="buttonInnerSep"></div> <div class="shoppingCartIcon"></div>-->
									</button>
								</div>
							</div>
							<div class="pollItemInfoRow paddingTop25"><?php echo $latest_prod2[0]->description?></div>
							<div class="pollItemInfoRow">Tags:<?php echo $latest_prod2[0]->tags?></div>
							<div class="pollItemInfoRow">Weight: <?php echo $latest_prod2[0]->prd_act_weight?></div>
							<div class="pollItemInfoRow">Style: <?php echo $latest_prod2[0]->style?></div>
						</div>
						<div class="pollInfo" id="pollInfo_3">
							<div class="pollInfoHeader">
								<div class="fl">
									<div class="pollItemNameBig"><?php echo $latest_prod3[0]->product_name?></div>
									<div class="pollItemStoreBig">from <span
											class="storeName"><?php echo $latest_prod3[0]->store_name?></span></div>
								</div>
								<div class="fr">
									<button type="button" id="add_to_cart_3" name="add_to_cart_3" class="add_to_cart">
										<div class="pollItemPrice"><span
												class="rupeePollBig">`</span> <?php echo intval($latest_prod3[0]->selling_price);?>
										</div>
										<!--<div class="buttonInnerSep"></div> <div class="shoppingCartIcon"></div>-->
									</button>
								</div>
							</div>
							<div class="pollItemInfoRow paddingTop25"><?php echo $latest_prod3[0]->description?></div>
							<div class="pollItemInfoRow">Tags:<?php echo $latest_prod3[0]->tags?></div>
							<div class="pollItemInfoRow">Weight: <?php echo $latest_prod3[0]->prd_act_weight?></div>
							<div class="pollItemInfoRow">Style: <?php echo $latest_prod3[0]->style?></div>
						</div>
						<!--<div class="pollComments" id="pollComments_1"> <div class="pollCommentBox"> <div class="pollCommentIcon"></div> <div class="pollCommentTextbox"><input type="text" id="pollCommentTextbox_1"/></div> <div class="addPollComment"></div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_1"> <div class="userImgBg"><img src="images/fancy/user_comment1.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Pupple <span class="commentHour">2hrs ago</span></div> <div class="comment">I like this.. should buy this...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(1)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_2"> <div class="userImgBg"><img src="images/fancy/user_comment2.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Dupex <span class="commentHour">2hrs ago</span></div> <div class="comment">pretty...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(2)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_3"> <div class="userImgBg"><img src="images/fancy/user_comment3.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Pupple <span class="commentHour">2hrs ago</span></div> <div class="comment">maybe simetime</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(3)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_4"> <div class="userImgBg"><img src="images/fancy/user_comment4.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Pavankudla <span class="commentHour">2hrs ago</span></div> <div class="comment">Gypsy!</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(4)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_5"> <div class="userImgBg"><img src="images/fancy/user_comment5.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Locoweed <span class="commentHour">2hrs ago</span></div> <div class="comment">This is my favourite.</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(5)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_6"> <div class="userImgBg"><img src="images/fancy/user_comment6.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Scalper <span class="commentHour">2hrs ago</span></div> <div class="comment">Really love this!</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(6)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_7"> <div class="userImgBg"><img src="images/fancy/user_comment7.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Armstrong <span class="commentHour">2hrs ago</span></div> <div class="comment">I like this.. should buy this...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(7)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_8"> <div class="userImgBg"><img src="images/fancy/user_comment8.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Johnson <span class="commentHour">2hrs ago</span></div> <div class="comment">pretty...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(8)"></div> </div> </div> </div>-->
						<!--<div class="pollComments" id="pollComments_2"> <div class="pollCommentBox"> <div class="pollCommentIcon"></div> <div class="pollCommentTextbox"><input type="text" id="pollCommentTextbox_2"/></div> <div class="addPollComment"></div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_9"> <div class="userImgBg"><img src="images/fancy/user_comment3.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Pupple <span class="commentHour">2hrs ago</span></div> <div class="comment">maybe simetime</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(9)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_10"> <div class="userImgBg"><img src="images/fancy/user_comment4.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Pavankudla <span class="commentHour">2hrs ago</span></div> <div class="comment">Gypsy!</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(10)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_11"> <div class="userImgBg"><img src="images/fancy/user_comment5.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Locoweed <span class="commentHour">2hrs ago</span></div> <div class="comment">This is my favourite.</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(11)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_12"> <div class="userImgBg"><img src="images/fancy/user_comment6.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Scalper <span class="commentHour">2hrs ago</span></div> <div class="comment">Really love this!</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(12)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_13"> <div class="userImgBg"><img src="images/fancy/user_comment7.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Armstrong <span class="commentHour">2hrs ago</span></div> <div class="comment">I like this.. should buy this...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(13)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_14"> <div class="userImgBg"><img src="images/fancy/user_comment8.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Johnson <span class="commentHour">2hrs ago</span></div> <div class="comment">pretty...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(14)"></div> </div> </div> </div>-->
						<!--<div class="pollComments" id="pollComments_3"> <div class="pollCommentBox"> <div class="pollCommentIcon"></div> <div class="pollCommentTextbox"><input type="text" id="pollCommentTextbox_3"/></div> <div class="addPollComment"></div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_15"> <div class="userImgBg"><img src="images/fancy/user_comment2.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Dupex <span class="commentHour">2hrs ago</span></div> <div class="comment">pretty...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(15)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_16"> <div class="userImgBg"><img src="images/fancy/user_comment3.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Pupple <span class="commentHour">2hrs ago</span></div> <div class="comment">maybe simetime</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(16)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_17"> <div class="userImgBg"><img src="images/fancy/user_comment1.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Pavankudla <span class="commentHour">2hrs ago</span></div> <div class="comment">Gypsy!</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(17)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_18"> <div class="userImgBg"><img src="images/fancy/user_comment5.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Locoweed <span class="commentHour">2hrs ago</span></div> <div class="comment">This is my favourite.</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(18)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_19"> <div class="userImgBg"><img src="images/fancy/user_comment6.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Scalper <span class="commentHour">2hrs ago</span></div> <div class="comment">Really love this!</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(19)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_20"> <div class="userImgBg"><img src="images/fancy/user_comment7.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Armstrong <span class="commentHour">2hrs ago</span></div> <div class="comment">I like this.. should buy this...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(20)"></div> </div> </div> <div class="pollUserCommentBox" id="pollUserCommentBox_21"> <div class="userImgBg"><img src="images/fancy/user_comment8.png" alt="User"/></div> <div class="fl"> <div class="pollUserRow1">Johnson <span class="commentHour">2hrs ago</span></div> <div class="comment">pretty...</div> </div> <div class="fr"> <div class="commentSep"></div> <div class="pollCommentIcon2"></div> <div class="commentSep"></div> <div class="pollDel marginStylePoll" onClick="return funcDelComment(21)"></div> </div> </div> </div>-->
					</div>
				</div>
				<div class="panelSeperator" id="panelSeperator_poll"></div>
				<div class="rightPanel_poll">
					<div class="paddingBottom18"><a href="create_poll">
							<button class="createNewPollButton" type="button">Create New Poll</button>
						</a></div>
					<div class="leftPanelCategory paddingBottom18">My Poll Categories
					</div> <?php $cnt = 0;$cnt2 = 0; ?> <?php foreach ($poll_cat as $cat_item) : ?> <?php $cnt = $cnt + 1; ?>
						<div class="categoryHeading newColor" id="category<?php echo $cnt; ?>"
						     onClick="return panelCategories(<?php echo $cnt; ?>)">
							<strong><?php echo $cat_item->category_name; ?> - </strong> <span
								class="lightgrayText"><?php echo $cat_item->poll_count; ?> polls</span></div>
						<div class="subCategoryConntainer"
						     id="sub_category<?php echo $cnt; ?>"> <?php foreach ($poll_subcat as $subcat_item) {
								$cnt2 = $cnt2 + 1;
								if ($subcat_item->poll_category == $cat_item->poll_category) {
									echo "<div class=\"subCategoryItems\" onClick=\"return subCategories(" . $cnt2 . ")\"> <div onClick=\"return ajax_poll(" . $subcat_item->poll_id . ")\" class=\"subCategory newColor\" id=\"subCategory_" . $cnt2 . "\">" . $subcat_item->poll_quest . "<span class=\"lightgrayText\"> - " . $subcat_item->vote_count . " votes</span></div> </div>";
								}
							} ?> </div> <?php endforeach;?>
					<div class="rightPanelSeperator"></div>
					<div class="leftPanelCategory paddingBottom18 paddingTop10">Vote on these Polls!</div>
					<div class="closingPolls"> <?php foreach ($pending_polls as $polls) : ?>
							<div class="paddingBottom8"><a class="pollLinks"
							                               href="<?php echo $base_url;?>index.php/poll/vote/<?php echo $polls->poll_id; ?>"><?php echo $polls->poll_quest . "<br><h5>by " . $polls->full_name . "</h5>"; ?></a>
							</div> <?php endforeach; ?> </div>
					<!--<div class="famousPolls"> <div class="pollLinkHead">Everyones talking about these!</div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Which Iphone Case?</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Wedges or Sandals? Which would...</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">What Kind of Floppy Hat for the...</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Apple Ipad or Android Tablet?</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Brown OR Black&amp;White Oxfords?</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">What summer movie are you wanting...</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Which bracelet goes better with...</a></div> </div> <div class="newPolls"> <div class="pollLinkHead">Brand New Polls</div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Guys look better in a: Skinny Tie...</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Which should I get?</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Which jacket is better?</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Which tree necklace?</a></div> <div class="paddingBottom8"><a class="pollLinks" href="javascript:void(0)">Which color dress should I get?...</a></div> </div> -->
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/landing_page.js"></script>
<script type="text/javascript">
// JavaScript Document/poll.js
$(".picon").attr("src", "<?php echo $base_url; ?>assets/images/droppoll_hover.png");
$(".picon").siblings(".value").html('');
$(function () {


	$(".pollItemName").each(function () {

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
		tooltip2();
	});
	$("#showPollResults_1").click(function () {
		$("#pollParent").hide();
		$("#pollResults").show();
		$("#backToPoll").show();
	});

	$("#backToPoll").click(function () {
		$("#pollParent").show();
		$("#pollResults").hide();
	});

	$(".voteDemo1").click(function () {
		alert('AAA');
		$("#pollParent").hide();
		$("#pollResults").show();
		$("#backToPoll").hide();
	});
	$(".voteDemo2").click(function () {
		alert('BBB');
		$("#pollParent").hide();
		$("#pollResults").show();
		$("#backToPoll").hide();
	});
	$(".voteDemo3").click(function () {
		alert('CCC');
		$("#pollParent").hide();
		$("#pollResults").show();
		$("#backToPoll").hide();
	});

});

function funcDelPoll(id) {
	$("#panelSeperator_poll").css("display", "none");
	$("#pollContents_" + id).css("display", "none");
}

function funcDelComment(id) {
	$("#pollUserCommentBox_" + id).css("display", "none");
}

function funcPollInfo(id) {
	for (var i = 1; i <= 9; i++) {
		$("#pollInfoIcon_" + i).css("background-image", "url(<?php echo $base_url;?>assets/images/fancy/info_normal_poll.png)");
		$("#pollCommentsIcon_" + i).css("background-image", "url(<?php echo $base_url;?>assets/images/fancy/comments_normal.png)");
		$("#pollInfo_" + i).css("display", "none");
		$("#pollComments_" + i).css("display", "none");
	}
	$("#pollInfoIcon_" + id).css("background-image", "url(<?php echo $base_url;?>assets/images/fancy/info_click_poll.png)");
	$("#pollInfo_" + id).css("display", "block");
}

function funcPollComments(id) {
	for (var i = 1; i <= 9; i++) {
		$("#pollInfoIcon_" + i).css("background-image", "url(<?php echo $base_url;?>assets/images/fancy/info_normal_poll.png)");
		$("#pollCommentsIcon_" + i).css("background-image", "url(<?php echo $base_url;?>assets/images/fancy/comments_normal.png)");
		$("#pollInfo_" + i).css("display", "none");
		$("#pollComments_" + i).css("display", "none");
	}
	$("#pollCommentsIcon_" + id).css("background-image", "url(<?php echo $base_url;?>assets/images/fancy/comments_click.png)");
	$("#pollComments_" + id).css("display", "block");
}

function panelCategories(id) {
	$('li').css('color', '#666');
	for (var i = 1; i <= 5; i++) {
		if (i == id) {
			if ($("#sub_category" + i).css('display') != 'block') {
				$("#sub_category" + i).show();
				$("#category" + i).css("color", "#333");
			} else {
				$("#sub_category" + i).hide();
				$("#category" + i).css("color", "#666");
			}
		} else {
			$("#sub_category" + i).hide();
			$("#category" + i).css("color", "#666");
		}
	}
}

function subCategories(id) {
	for (var i = 1; i <= 14; i++) {
		if (i == id) {
			if ($("#subSubCategory_" + i).css('display') != 'block') {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			$("#subCategory_" + i).css("color", "#666");
			$("#subSubCategory_" + i).hide();
		}
	}

}

function subCategoriesForDemo(id) {
	for (var i = 1; i <= 14; i++) {
		if (i == id) {
			if ($("#subSubCategory_" + i).css('display') != 'block') {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			$("#subCategory_" + i).css("color", "#666");
			$("#subSubCategory_" + i).hide();
		}
	}
}

function subCategoriesOthers(id) {
	for (var i = 1; i <= 14; i++) {
		if (i == id) {
			if ($("#subSubCategory_" + i).css('display') != 'block') {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			$("#subCategory_" + i).css("color", "#666");
			$("#subSubCategory_" + i).hide();
		}
	}
	$.ajax({
		url: "poll_contents_others.php?typeID=" + id,
		success: function (data) {
			$(".leftPanel_poll").html(data);
		},
	});
}

function subCategoriesFriend(id) {
	for (var i = 1; i <= 14; i++) {
		if (i == id) {
			if ($("#subSubCategory_" + i).css('display') != 'block') {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			$("#subCategory_" + i).css("color", "#666");
			$("#subSubCategory_" + i).hide();
		}
	}
	$.ajax({
		url: "poll_contents_friend.php?typeID=" + id,
		success: function (data) {
			$(".leftPanel_poll").html(data);
		},
	});
}

function subCategoriesMyPolls(id) {
	for (var i = 1; i <= 14; i++) {
		if (i == id) {
			if ($("#subSubCategory_" + i).css('display') != 'block') {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			$("#subCategory_" + i).css("color", "#666");
			$("#subSubCategory_" + i).hide();
		}
	}
	$.ajax({
		url: "my_poll_contents.php?typeID=" + id,
		success: function (data) {
			$(".leftPanel_poll").html(data);
		},
	});
}
</script>
<script type="text/javascript">
	$("#sub_category1").show();
	$("#category1").css("color", "#333");
	$("#subCategory_1").css("color", "#da3c63");
</script>
<script type="text/javascript">
	function ajax_poll(p_id) {

		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 1,
			success: function (data) {
				$("#ajax_ques").html(data);
			},
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 2,
			success: function (data) {
				$("#ajax_date").html(data);
			},
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 3,
			success: function (data) {
				$("#ajax_p1").html(data);
			},
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 4,
			success: function (data) {
				$("#ajax_p2").html(data);
			},
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 5,
			success: function (data) {
				$("#ajax_p3").html(data);
			},
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 6,
			success: function (data) {
				$("#pollInfo_1").html(data);
			},
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 7,
			success: function (data) {
				$("#pollInfo_2").html(data);
			},
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/ajax_poll1/" + p_id + "/" + 8,
			success: function (data) {
				$("#pollInfo_3").html(data);
			},
		});

	}
</script>
</html> <?php function truncateOptionVal($text, $limit)
{
	if (strlen($text) > $limit) {
		$text = substr($text, 0, $limit) . '...';
	}
	return $text;
} ?>