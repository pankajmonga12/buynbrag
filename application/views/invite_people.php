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
				message: 'Hi Friends! Is your destination for everything hard-to-find? Come and visit BuynBrag.com',
				to: sendUIDs
			}, callback);
		}
		else {
			alert('Select atleast one');
		}
	}

	function callback(response) {
		console.log(response);
		window.location = "<?php echo $base_url.'user_info/homepage_afterlogin'; ?>";
	}
</script>
<section class="wrapper">
	<section class="middleBackground">
		<div class="inviteFriendsContainer">
			<div class="inviteFriendsIcon"></div>
			<div class="inviteFriendsText">INVITE FRIENDS</div>
			<a class="skipText" href="<?php echo $base_url . 'user_info/homepage_afterlogin'?>">Skip</a></div>
		<div class="topDotSeparator"></div>
		<div id="siteContents">
			<div class="inviteFriendsContainerStyle"> <!--<div class="facebookIcon" onClick="changeSite(1)"></div>-->
				<div class="facebookIcon"></div>
				<div class="facebookTextImage"></div>
				<!--<div class="twitterIcon" onClick="changeSite(2)"></div> <div class="googleIcon twitterIcon" onClick="changeSite(3)"></div> <div class="yahooIcon twitterIcon" onClick="changeSite(4)"></div> <div class="linkedIcon twitterIcon" onClick="changeSite(5)"></div> <div class="wordpressIcon twitterIcon" onClick="changeSite(6)"></div> <div class="blogIcon twitterIcon" onClick="changeSite(7)"></div>-->
			</div>
			<div class="topDotSeparator"></div>
			<div class="friendsImagesContainer">
				<div class="scroll-pane">
					<!--<div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '100003550422337'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '100003550422337'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Elavarasan Lee'; ?> </div> </div> <div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '100001100954046'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '100001100954046'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Anant Singh'; ?> </div> </div> <div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '100000266719868'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '100000266719868'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Vignesh A Sthyanantham'; ?> </div> </div> <div class="peopleImageCheckBoxHolder"> <div class="pplCheck" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;"> <input type="checkbox" name="check1" class="checkie" value="<?php echo '1388028071'; ?>" /> </div> <div class="peopleImage_1" style="cursor:pointer;"> <img src="http://graph.facebook.com/<?php echo '1388028071'; ?>/picture?type=large" height="96" width="96" alt="profile_pic"/> </div> <div class="friendName" style="font-size: 12px; text-align: center;"> <?php echo 'Dude Shetty'; ?> </div> </div>--> <?php for ($i = 0; $i < count($keys); $i++): ?> <?php $key = $keys[$i]; ?> <?php if ($i % 9 == 0): $class = 'peopleImageCheckBoxHolder lastImageStyle'; ?> <?php else: $class = 'peopleImageCheckBoxHolder'; ?> <?php endif; ?>
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
					<button type="button" class="invite" onClick="sendRequest();">Invite</button>
					<button type="button" class="inviteAll" id="selectAll" onClick="checkall();">Check All</button>
					<!--<button type="button" class="inviteAll" id="unselectAll" onclick="uncheckall();" style="width: 167px;">Uncheck All</button>-->
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