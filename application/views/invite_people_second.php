<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Invite People</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/invite_people.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<body>
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

	function sendRequest() {
		// Get the list of selected friends
		var sendUIDs = '';
		var checked = 0;
		var j = 0;
		var mfsForm = document.getElementsByClassName('checkie');
		while (j < <?php echo count($keys); ?> && j >= 0) {
			if (mfsForm[j].checked) {
				checked = 1;
				break;
			}
			else {
				j = j + 1;
				checked = 0;
			}
		}
		if (checked == 1) {
			var count = 0;
			for (var i = 0; i < <?php echo count($keys); ?>; i++) {
				if (mfsForm[i].checked) {
					count = count + 1;
					sendUIDs += mfsForm[i].value + ',';
				}
			}
			//alert('Request sent to '+ count +' Friend(s)');
			// Use FB.ui to send the Request(s)
			FB.ui({method: 'apprequests',
				title: 'BuynBrag.com',
				message: 'Hey! If you are on the lookout for antique lamps, a quirky laptop bag or pop-art cushions, BuynBrag is the place to go - your destination for everything hard-to-find. Check it out!',
				to: sendUIDs
			}, callback);
		}
		else {
			alert('Select atleast one');
		}
	}

	function callback(response) {
		console.log(response);
		window.location.reload();
	}
</script>
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
			</div>
		</div>
	</article>
	<nav class="middleColumnTop">
		<div class="middleColumnIE">
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="linksMiddle">
				<!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
				<a href="<?php echo $base_url . 'user_info/user_detail'; ?>">
					<div class="productsLink">
						<div class="profileLogo"></div>
						<div class="productsText newPadding">Profile</div>
					</div>
				</a> <a href="<?php echo $base_url; ?>user_info/invite">
					<div class="dashboardLink newWidth">
						<div class="inviteLogo"></div>
						<div class="activeText">Invite People</div>
					</div>
				</a>
				<!-- <a href="javascript:void(0)"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a>-->
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
		<div class="Ie8bg">
			<div id="siteContents">
				<div class="inviteFriendsContainerStyle"><!--<div class="facebookIcon" onClick="changeSite(1)"></div>-->
					<div class="facebookIcon"></div>
					<div class="facebookTextImage"></div>
					<!-- <div class="twitterIcon" onClick="changeSite(2)"></div> <div class="googleIcon twitterIcon" onClick="changeSite(3)"></div> <div class="yahooIcon twitterIcon" onClick="changeSite(4)"></div> <div class="linkedIcon twitterIcon" onClick="changeSite(5)"></div> <div class="wordpressIcon twitterIcon" onClick="changeSite(6)"></div> <div class="blogIcon twitterIcon" onClick="changeSite(7)"></div>-->
				</div>
				<div class="topDotSeparator"></div>
				<div class="friendsImagesContainer">
					<div class="scroll-pane">
						<!-- <div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '100003550422337'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '100003550422337'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Elavarasan Lee'; ?> </div> </div> <div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '100001100954046'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '100001100954046'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Anant Singh'; ?> </div> </div> <div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '100000266719868'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '100000266719868'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Vignesh A Sthyanantham'; ?> </div> </div> <div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '1388028071'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '1388028071'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Dude Shetty'; ?> </div> </div>--> <?php for ($i = 0; $i < count($keys); $i++): ?> <?php $key = $keys[$i]; ?> <?php if ($i % 9 == 0): $class = 'peopleImageCheckBoxHolder lastImageStyle'; ?> <?php else: $class = 'peopleImageCheckBoxHolder'; ?> <?php endif; ?>
							<div class="<?php echo $class; ?>">
								<div class="pplCheck"
								     style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;">
									<input type="checkbox" name="check1" class="checkie"
									       value="<?php echo $friends[$key]['id']; ?>"/></div>
								<div class="peopleImage_1" style="cursor:pointer;"><img
										src="http://graph.facebook.com/<?php echo $friends[$key]['id']; ?>/picture?type=large"
										height="96" width="96" alt="profile_pic"/></div>
								<div class="friendName"
								     style="font-size: 12px; text-align: center;"> <?php echo $friends[$key]['name']; ?> </div>
							</div> <?php endfor; ?> </div>
					<div class="paddingTop25">
						<div class="buttonsClear">
							<button type="button" class="invite" onClick="sendRequest();">Invite</button>
							<button type="button" class="inviteAll" id="selectAll" onClick="checkall();">Check All
							</button>
							<!--<button type="button" class="inviteAll" id="unselectAll" onclick="uncheckall();" style="width: 167px;">Uncheck All</button>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript">
	$(function () {
		$(".peopleImage_1").each(function () {
			var $checkbox = $(this).siblings(".pplCheck").children(".checkie");
			$(this).click(function () {
				$checkbox.attr('checked', !$checkbox.attr('checked'));
			});
		});
	});

	function checkall() {
		var ip = document.getElementsByTagName('input'), i = ip.length - 1;
		for (i; i > -1; --i) {
			if (ip[i].type && ip[i].type.toLowerCase() === 'checkbox') {
				ip[i].checked = true;
			}
		}
	}

	function uncheckall() {
		var ip = document.getElementsByTagName('input'), i = ip.length - 1;
		for (i; i > -1; --i) {
			if (ip[i].type && ip[i].type.toLowerCase() === 'checkbox') {
				ip[i].checked = false;
			}
		}
	}

</script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/invite_people.js"></script>
</html>