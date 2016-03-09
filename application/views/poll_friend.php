<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Poll - Voting Page</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
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
				<a href="<?php echo $base_url; ?>order/user_fancy_product" class="showtooltip">
					<div class="roundFancy"></div>
				</a> <a href="<?php echo $base_url; ?>index.php/poll/my_polls" class="showtooltip">
					<div class="roundPoll_active"></div>
				</a>

				<div class="categoriesText">POLL</div>
			</div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="fancyContentsContainer">
			<div class="fancyForHeight paddingTop10">
				<div class="leftPanel_poll" id="leftPanel_poll">
					<div id="pollParent">
						<div class="pollContents paddingBottom18">
							<div class="pollHeader">
								<div class="pollCreator"><img height=50 width=50
								                              src="<?php echo $base_url;?>assets/images/users/<?php echo $this_poll[0]->user_id; ?>/<?php echo $this_poll[0]->user_id; ?>_40x40.jpg"
								                              alt="Creator"/></div>
								<div class="pollnName"><?php echo $this_poll[0]->poll_quest; ?></div>
								<div class="pollEditDel">
									<div class="showPollResults showtooltip2" id="showPollResults_1"
									     title="Show Results"></div>
								</div>
							</div>
							<div class="pollContentsMain">
								<div class="pollItemRow"> <?php if (isset($poll_prod1)) : ?>
										<div class="pollItemBg">
											<div class="pollItemImg"><img width="200"
											                              src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod1[0]->store_id?>/<?php echo $poll_prod1[0]->product_id?>/img1_240x200.jpg"
											                              alt="Product Item"/></div>
											<div
												class="pollItemName"><?php echo truncateOptionVal($poll_prod1[0]->product_name, 18);?></div>
											<div class="pollItemInfo"><span class="rupeePoll">` </span><span
													class="rockwellBold"><?php echo intval($poll_prod1[0]->selling_price);?></span>
											</div>
											<div class="pollItemStore">from
												<strong><?php echo $poll_prod1[0]->store_name?></strong></div>
											<div class="pollItemLastRow"> <?php if ($this_poll[0]->poll_type == 1): ?>
													<button id="vote_poll_1" class="voteButton newVote voteDemo1"
													        type="button" name="vote">Love
													</button>
													<button id="vote_poll_9" class="voteButton newVote voteDemo9"
													        type="button" name="vote">Leave
													</button> <?php else : ?>
													<button id="vote_poll_1" class="voteButton newVote voteDemo1"
													        type="button" name="vote">Vote
													</button> <?php endif; ?> </div>
										</div> <?php endif; ?> <?php if (isset($poll_prod2)) : ?>
										<div class="pollItemBg">
											<div class="pollItemImg"><img width="200"
											                              src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod2[0]->store_id?>/<?php echo $poll_prod2[0]->product_id?>/img1_240x200.jpg"
											                              alt="Product Item"/></div>
											<div
												class="pollItemName"><?php echo truncateOptionVal($poll_prod2[0]->product_name, 18);?></div>
											<div class="pollItemInfo"><span class="rupeePoll">` </span><span
													class="rockwellBold"><?php echo intval($poll_prod2[0]->selling_price);?></span>
											</div>
											<div class="pollItemStore">from
												<strong><?php echo $poll_prod2[0]->store_name?></strong></div>
											<div class="pollItemLastRow">
												<button id="vote_poll_2" class="voteButton newVote voteDemo2"
												        type="button" name="vote">Vote
												</button>
											</div>
										</div> <?php endif; ?> <?php if (isset($poll_prod3)) : ?>
										<div class="pollItemBg marginRight0">
											<div class="pollItemImg"><img width="200"
											                              src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod3[0]->store_id?>/<?php echo $poll_prod3[0]->product_id?>/img1_240x200.jpg"
											                              alt="Product Item"/></div>
											<div
												class="pollItemName"><?php echo truncateOptionVal($poll_prod3[0]->product_name, 18);?></div>
											<div class="pollItemInfo"><span class="rupeePoll">` </span><span
													class="rockwellBold"><?php echo intval($poll_prod3[0]->selling_price);?></span>
											</div>
											<div class="pollItemStore">from
												<strong><?php echo $poll_prod3[0]->store_name?></strong></div>
											<div class="pollItemLastRow">
												<button id="vote_poll_3" class="voteButton newVote voteDemo3"
												        type="button" name="vote">Vote
												</button>
											</div>
										</div> <?php endif; ?> </div>
								<div class="pollSocialRow">
									<div class="pollBrag"></div>
									<!--<div class="pollFb"></div> <div class="pollTweet"></div>--> </div>
							</div>
						</div>
					</div>
					<div class="pollResults" id="pollResults">
						<div class="pollContents">
							<div class="pollHeader">
								<div class="pollCreator"><img height=50 width=50
								                              src="<?php echo $base_url;?>assets/images/users/<?php echo $this_poll[0]->user_id; ?>/<?php echo $this_poll[0]->user_id; ?>_40x40.jpg"
								                              alt="Creator"/></div>
								<div class="pollnName"><?php echo $this_poll[0]->poll_quest; ?></div>
								<div class="pollEditDel">
									<div class="backToPoll showtooltip2" id="backToPoll" title="Back to Poll"></div>
								</div>
							</div>
							<div class="pollContentsMain">
								<div class="pollItemRow"> <?php if (isset($poll_prod1)) : ?>
										<div class="pollItemBg">
											<div class="pollItemImg"><img width="200"
											                              src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod1[0]->store_id?>/<?php echo $poll_prod1[0]->product_id?>/img1_240x200.jpg"
											                              alt="Product Item"/></div>
											<div
												class="pollItemName"><?php echo truncateOptionVal($poll_prod1[0]->product_name, 18)?></div>
											<div class="pollItemInfo"><span class="rupeePoll">` </span><span
													class="rockwellBold"><?php echo intval($poll_prod1[0]->selling_price);?></span>
											</div>
											<div class="pollItemStore">from
												<strong><?php echo $poll_prod1[0]->store_name?></strong></div>
											<div class="pollItemLastRow"> <?php if ($this_poll[0]->poll_type == 1): ?>
													<div id="vote1" class="noOfVotes"><?php echo $votes1[0]->votes;?>
														Love, <?php echo $votes9[0]->votes;?> Leave
													</div> <?php else: ?>
													<div id="vote1" class="noOfVotes"><?php echo $votes1[0]->votes;?>
														Votes
													</div> <?php endif; ?> </div>
										</div> <?php endif; ?> <?php if (isset($poll_prod2)) : ?>
										<div class="pollItemBg">
											<div class="pollItemImg"><img width="200"
											                              src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod2[0]->store_id?>/<?php echo $poll_prod2[0]->product_id?>/img1_240x200.jpg"
											                              alt="Product Item"/></div>
											<div
												class="pollItemName"><?php echo truncateOptionVal($poll_prod2[0]->product_name, 18)?></div>
											<div class="pollItemInfo"><span class="rupeePoll">` </span><span
													class="rockwellBold"><?php echo intval($poll_prod2[0]->selling_price);?></span>
											</div>
											<div class="pollItemStore">from
												<strong><?php echo $poll_prod2[0]->store_name?></strong></div>
											<div class="pollItemLastRow">
												<div id="vote2" class="noOfVotes"><?php echo $votes2[0]->votes;?>
													Votes
												</div>
											</div>
										</div> <?php endif; ?> <?php if (isset($poll_prod3)) : ?>
										<div class="pollItemBg marginRight0">
											<div class="pollItemImg"><img width="200"
											                              src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod3[0]->store_id?>/<?php echo $poll_prod3[0]->product_id?>/img1_240x200.jpg"
											                              alt="Product Item"/></div>
											<div
												class="pollItemName"><?php echo truncateOptionVal($poll_prod3[0]->product_name, 18);?></div>
											<div class="pollItemInfo"><span class="rupeePoll">` </span><span
													class="rockwellBold"><?php echo intval($poll_prod3[0]->selling_price);?></span>
											</div>
											<div class="pollItemStore">from
												<strong><?php echo $poll_prod3[0]->store_name?></strong></div>
											<div class="pollItemLastRow">div class="pollItemInfo"
												<div id="vote3" class="noOfVotes"><?php echo $votes3[0]->votes;?>
													Votes
												</div>
											</div>
										</div> <?php endif; ?> </div>
								<div class="pollSocialRow">
									<div class="pollBrag"></div>
									<!--<div class="pollFb"></div> <div class="pollTweet"></div>--> </div>
							</div>
						</div>
						<div class="morePollInfo">
							<div class="moreInfoHeader">
								<div class="pollInfoIcon marginStylePoll"></div>
								<div class="moreInfo">More Information</div>
							</div> <?php if (isset($poll_prod1)) : ?>
								<div class="moreInfoParent">
									<div class="pollInfoContent">
										<div class="pollItemImgInfo"><img width="200"
										                                  src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod1[0]->store_id?>/<?php echo $poll_prod1[0]->product_id?>/img1_240x200.jpg"
										                                  alt="Product Item"/></div>
										<div class="pollInfoRight">
											<div
												class="pollItemNameBig paddingTop0"><?php echo $poll_prod1[0]->product_name?></div>
											<div class="pollItemStoreBig">from <span
													class="storeName"><?php echo $poll_prod1[0]->store_name?></span>
											</div>
											<div
												class="morepollInfoContent"><?php echo $poll_prod1[0]->description?></div>
										</div>
									</div>
								</div> <?php endif; ?> <?php if (isset($poll_prod2)) : ?>
								<div class="moreInfoParent">
									<div class="pollInfoContent">
										<div class="pollItemImgInfo"><img width="200"
										                                  src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod2[0]->store_id?>/<?php echo $poll_prod2[0]->product_id?>/img1_240x200.jpg"
										                                  alt="Product Item"/></div>
										<div class="pollInfoRight">
											<div
												class="pollItemNameBig paddingTop0"><?php echo $poll_prod2[0]->product_name?></div>
											<div class="pollItemStoreBig">from <span
													class="storeName"><?php echo $poll_prod2[0]->store_name?></span>
											</div>
											<div
												class="morepollInfoContent"><?php echo $poll_prod2[0]->description?></div>
										</div>
									</div>
								</div> <?php endif; ?> <?php if (isset($poll_prod3)) : ?>
								<div class="moreInfoParent">
									<div class="pollInfoContent">
										<div class="pollItemImgInfo"><img width="200"
										                                  src="<?php echo $store_url?>assets/images/stores/<?php echo $poll_prod3[0]->store_id?>/<?php echo $poll_prod3[0]->product_id?>/img1_240x200.jpg"
										                                  alt="Product Item"/></div>
										<div class="pollInfoRight">
											<div
												class="pollItemNameBig paddingTop0"><?php echo $poll_prod3[0]->product_name?></div>
											<div class="pollItemStoreBig">from <span
													class="storeName"><?php echo $poll_prod3[0]->store_name?></span>
											</div>
											<div
												class="morepollInfoContent"><?php echo $poll_prod3[0]->description?></div>
										</div>
									</div>
								</div> <?php endif; ?> </div>
					</div>
				</div>
				<div class="panelSeperator pollOthersHeight" id="panelSeperator_poll"></div>
				<div class="rightPanel_poll">
					<!--<div class="leftPanelCategory paddingBottom18">My Poll Categories</div> --> <?php $cnt = 0;$cnt2 = 0; ?> <?php foreach($poll_cat as $cat_item) : ?> <?php $cnt = $cnt + 1; ?>
					<div class="categoryHeading newColor" id="category<?php echo $cnt; ?>"
					     onClick="return panelCategories(<?php echo $cnt; ?>)">
						<strong><?php echo $cat_item->category_name; ?> - </strong> <span
							class="lightgrayText"><?php echo $cat_item->poll_count; ?> polls</span></div>
					<div class="subCategoryConntainer"
					     id="sub_category<?php echo $cnt; ?>"> <?php foreach ($poll_subcat as $subcat_item) { $cnt2 = $cnt2 + 1; if ($subcat_item->poll_category == $cat_item->poll_category){ //echo "<div class=\"subCategoryItems\" onClick=\"return subCategories(".$cnt2.")\"> //<div onClick=\"return ajax_poll(".$subcat_item->poll_id.")\" class=\"subCategory newColor\" id=\"subCategory_".$cnt2."\">".$subcat_item->poll_quest."<span class=\"lightgrayText\"> - ".$subcat_item->vote_count." votes</span></div> //</div>"; } } ?> </div> <?php endforeach ;?>
					--> <!--<div class="rightPanelSeperator"></div>-->
					<div class="leftPanelCategory paddingBottom18 paddingTop10">Vote on this Poll Too!</div>
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
<script type="text/javascript"><!--
poll.js-->
// JavaScript Document
$(".picon").attr("src", "<?php echo $base_url; ?>assets/images/droppoll_hover.png");
$(".picon").siblings(".value").html('');
$(function () {


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

		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/vote_product/"+<?php echo $this_poll[0]->poll_id; ?>+"/"+1,
			success: function (data) {
				$("#vote1").html(data);
			},
		});
		$("#pollParent").hide();
		$("#pollResults").show();
		$("#backToPoll").hide();


	});
	$(".voteDemo2").click(function () {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/vote_product/"+<?php echo $this_poll[0]->poll_id; ?>+"/"+2,
			success: function (data) {
				$("#vote2").html(data);
			},
		});
		$("#pollParent").hide();
		$("#pollResults").show();
		$("#backToPoll").hide();


	});
	$(".voteDemo3").click(function () {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/vote_product/"+<?php echo $this_poll[0]->poll_id; ?>+"/"+3,
			success: function (data) {
				$("#vote3").html(data);
			},
		});
		$("#pollParent").hide();
		$("#pollResults").show();
		$("#backToPoll").hide();


	});
	$(".voteDemo9").click(function () {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/vote_product/"+<?php echo $this_poll[0]->poll_id; ?>+"/"+9,
			success: function (data) {
				$("#vote1").html(data);
			},
		});
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
		$("#pollInfoIcon_" + i).css("background-image", "url(<?php echo $base_url; ?>assets/images/fancy/info_normal_poll.png)");
		$("#pollCommentsIcon_" + i).css("background-image", "url(<?php echo $base_url; ?>assets/images/fancy/comments_normal.png)");
		$("#pollInfo_" + i).css("display", "none");
		$("#pollComments_" + i).css("display", "none");
	}
	$("#pollInfoIcon_" + id).css("background-image", "url(<?php echo $base_url; ?>assets/images/fancy/info_click_poll.png)");
	$("#pollInfo_" + id).css("display", "block");
}

function funcPollComments(id) {
	for (var i = 1; i <= 9; i++) {
		$("#pollInfoIcon_" + i).css("background-image", "url(<?php echo $base_url; ?>assets/images/fancy/info_normal_poll.png)");
		$("#pollCommentsIcon_" + i).css("background-image", "url(<?php echo $base_url; ?>assets/images/fancy/comments_normal.png)");
		$("#pollInfo_" + i).css("display", "none");
		$("#pollComments_" + i).css("display", "none");
	}
	$("#pollCommentsIcon_" + id).css("background-image", "url(<?php echo $base_url; ?>assets/images/fancy/comments_click.png)");
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
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			$("#subCategory_" + i).css("color", "#666");
			$("#subSubCategory_" + i).hide();
		}
	}

}

function subCategoriesForDemo(id) {
	for (var i = 1; i <= 14; i++) {
		if (i == id) {
			if ($("#subSubCategory_" + i).css('display') != 'block') {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			$("#subCategory_" + i).css("color", "#666");
			$("#subSubCategory_" + i).hide();
		}
	}
}

function subCategoriesOthers(id) {
	for (var i = 1; i <= 14; i++) {
		if (i == id) {
			if ($("#subSubCategory_" + i).css('display') != 'block') {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
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
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
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
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
				$("#subCategory_" + i).css("color", "#da3c63");
				$("#subSubCategory_" + i).show();
			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}

		} else {
			$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
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