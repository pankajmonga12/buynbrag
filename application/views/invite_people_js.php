<html>
<head><title>MFS</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/invite_people.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
</head>
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
		var mfsForm = document.getElementById('mfsForm');
		for (var i = 0; i < 54; i++) {
			if (mfsForm.friends[i].checked) {
				sendUIDs += mfsForm.friends[i].value + ',';
			}
		}

		// Use FB.ui to send the Request(s)
		FB.ui({method: 'apprequests',
			to: sendUIDs,
			title: 'My Great Invite',
			message: 'Invited By Lee'
		}, callback);
	}

	function callback(response) {
		//console.log(response);
	}
</script>
<div class="friendsImagesContainer">
	<div
		class="scroll-pane"> <?php // for($i=0;$i<count($friends);$i++): ?> <?php for ($i = 0; $i < count($keys); $i++): ?> <?php $key = $keys[$i]; ?> <?php if ($i % 9 == 0): $class = 'peopleImageCheckBoxHolder lastImageStyle'; ?> <?php else: $class = 'peopleImageCheckBoxHolder'; ?> <?php endif; ?>
			<div class="<?php echo $class; ?>">
				<div class="" style="float:left; height: 19px; padding: 0px; position: absolute; text-align: left;">
					<input type="checkbox" name="check1" class="checkie" value="<?php echo $friends[$key]['id']; ?>"/>
				</div>
				<div class="peopleImage_1 <?php echo $i; ?>"><img
						src="http://graph.facebook.com/<?php echo $friends[$key]['id']; ?>/picture?type=large"
						height="96" width="96" alt="profile_pic"/></div>
				<div class="friendName" style="font-size: 12px;"> <?php echo $friends[$key]['name']; ?> </div>
			</div> <?php endfor; ?> </div>
	<div class="paddingTop25">
		<button type="button" class="invite">Invite</button>
		<button type="button" class="inviteAll" id="selectAll" onclick="checkall();">Check All</button>
		<button type="button" class="inviteAll" id="unselectAll" onclick="uncheckall();" style="width: 167px;">Uncheck
			All
		</button>
	</div>
</div>
</body>
<script type="text/javascript">
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