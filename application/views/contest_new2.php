<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Merry Christmas</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<link rel="stylesheet" type="text/css"
	      href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css?timestamp=<?php echo time(); ?>"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
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
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<script type="text/javascript">
	function doPost(sId, pId) {
		var params = {};
		var storeId = sId;
		var productId = pId;
		var productName = 'this product';
		params['message'] = "<?php echo $userdetails[0]->full_name; ?> just acquired bragging rights for " + productName + "!! You can't blame them! It's frickin' awesome!";
		params['name'] = 'BuynBrag.com';
		params['description'] = 'You can also acquire bragging rights for this product by logging into www.buynbrag.com';
		params['link'] = "http://www.buynbrag.com/";
		params['picture'] = '<?php echo $store_url; ?>assets/images/stores/' + storeId + '/' + productId + '/img1_171x171.jpg';
		params['caption'] = 'is your destination for everything hard-to-find';

		FB.api('/me/feed', 'post', params, function (response) {
			if (!response || response.error) {
				console.log('Fb FFF Badly');
			}
			else {
				console.log('Fb Rocks');
			}
			$.ajax({
				url: "<?php echo $base_url; ?>" + 'index.php/brag_ajax/product_brag?store_id=' + sId + '&product_id=' + pId,
				success: function (data) {
					//$('#brag_count').html(data);
					$('#bragText' + pId).html('BRAGGED');
					$('#brag' + pId).addClass('bragged');
					$('#brag' + pId).removeAttr('onclick');
				}
			});
		});
	}
	function brag(sId, pId) {
		FB.getLoginStatus(function (response) {
			if (response.status === 'connected') {
				var accessToken = response.authResponse.accessToken;
				doPost(sId, pId);
			}
			else if (response.status === 'not_authorized') {
				FB.login(function (response) {
					if (response.authResponse) {
						if (response.status === 'connected') {
							console.log('User is now logged-in and Has authenticated!');
							var accessToken = response.authResponse.accessToken;
							doPost(sId, pId);
						}
					} else {
						console.log('User cancelled login or did not fully authorize.');
					}
				}, {scope: 'email,user_birthday,publish_stream'});
			}
			else {
				FB.login(function (response) {
					if (response.authResponse) {
						if (response.status === 'connected') {
							console.log('User is now logged-in and Has authenticated!');
							var accessToken = response.authResponse.accessToken;
							doPost(sId, pId);
						}
					} else {
						console.log('User cancelled login or did not fully authorize.');
					}
				}, {scope: 'email,user_birthday,publish_stream'});
			}
		});
	}
</script>
<body>
<div id="fb-root"></div>
<script>
	console.log('FFF Init started.');
	window.fbAsyncInit = function () {
		FB.init({
			appId: '<?php echo $app_id;?>', // App ID
			channelUrl: '<?php echo urlencode($base_url.'assets/channel.html'); ?>', // Channel File
			status: true, // check login status
			cookie: true, // enable cookies to allow the server to access the session
			xfbml: true,  // parse XFBML
			frictionlessRequests: true
		});
		// Additional initialization code here
	};
	// Load the SDK Asynchronously
	(function (d) {
		var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement('script');
		js.id = id;
		js.async = true;
		js.src = "//connect.facebook.net/en_US/all.js";
		ref.parentNode.insertBefore(js, ref);
	}(document));
</script>
<section class="wrapper">
	<article class="banner">FFF Init started
		<div class="bannerIE2">
			<div class="slide">
				<div class="topBanerPatternContainer">
					<center><img width="1024px" height="237px"
					             src="<?php echo $base_url . 'assets/images/christmas_banner2.jpg'?>"></center>
				</div>
			</div>
		</div>
	</article>
	<nav class="middleColumnTop"><input type="button" value="Invite Friends From Fb" onclick="invite();"
	                                    style="margin-left: 500px"/>

		<div class="middleColumnIE">
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="topDotSeparator newtopDotSeparator1"></div>
		</div>
	</nav>
	<!-- <div class="trendingNewText topStoresStyle">Top Stores</div> -->
	<div id="main_stores" class="scrollerHolder2"
	     style="width: 1024px; height: 204px; border: 1px solid #ECDEE6; margin: 0 auto; background-color: #f0f1f2">
		<!-- <div class="storeViewIcon icon_new_style"></div> <div class="scrollerContents2"> <div class="button-block-left button_left_style2"></div> <div class="sliderParentDiv2"> <div class="slider2" id="slider2"> </div> </div> <div class="button-block-right button_right_style2"></div> </div> -->
		<div style="display: table-cell; width: 390px">blank area</div>
		<div style="display: table-cell; width: 9px">
			<div id="badges_spacer" style="display: table-cell; height: 15px"></div>
			<img src="<?php echo base_url(); ?>assets/images/badges_spacer.jpg"/></div>
		<div style="display: table-cell; width: 137px">
			<div style="display: table-cell; height: 24px"></div>
			<img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/>

			<p style="text-align: center"><?php echo 5 - count($fancy_game); ?> / 5 Fancy</p></div>
		<div style="display: table-cell; width: 18px">
			<div style="display: table-cell; height: 84px;"></div>
			<img src="<?php echo base_url(); ?>assets/images/plus.jpg"/></div>
		<div style="display: table-cell; width: 4px"></div>
		<div style="display: table-cell; width: 137px">
			<div style="display: table-cell; height: 24px"></div>
			<img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/>

			<p style="text-align: center"><?php echo 5 - count($brag_game); ?> / 5 Brag</p></div>
		<div style="display: table-cell; width: 18px">
			<div style="display: table-cell; height: 84px"></div>
			<img src="<?php echo base_url(); ?>assets/images/plus.jpg"/></div>
		<div style="display: table-cell; width: 4px"></div>
		<div style="display: table-cell; width: 137px">
			<div style="display: table-cell; height: 24px"></div>
			<img src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg"/>

			<p style="text-align: center">Text</p></div>
		<div style="display: table-cell; width: 128px">
			<div style="display: table-cell; height: 21px"></div>
			<img src="<?php echo base_url(); ?>assets/images/discount_image.jpg"/></div>
	</div>
	<section class="middleBackground">
		<div class="Ie8bg">
			<div class="fancyContentsContainer"> <?php $p = 0; for ($i = 0; $i < 6; $i++) {
					include "christmas.php";
				} ?>
				<div id="more_fancy_1" class="slideBackground clear_both">
					<div class="slideNormal"></div>
				</div>
			</div>
		</div>
	</section>
</section>
<div class="poll_popUp" id="pollPopup">
	<div class="poll_popUpTransp"></div>
	<div class="poll_popUpActual">
		<div class="fancy_text">Product has been added to your poll list</div>
		<div class="button_style">
			<button id="pollclose" type="button" class="prod_continue width_style_fancy">OK</button>
		</div>
	</div>
</div> <?php include "fancy_unfancy_prod.php" ?> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script>
	$(".fancyHolder").each(function () {

		var r = $(this).children(".hiddenFieldDiv1").val();
		var store_id = $(this).children(".hiddenFieldStoreid").val();
		var product_id = $(this).children(".hiddenFieldProductid").val();
		var sess_id = $('#sess_id').val();
		$(this).click(function () {
			if (sess_id == 0) {
				$("#createAccountPopup").dialog('close');
				$("#homePagePopup").dialog({
					width: 439,
					height: 439,
					modal: true
				});
			}
			else {
				var z = $(this).children(".hiddenFieldDiv1").val();
				if ($(this).children(".hoverText").html() == 'FANCY') {
					$.ajax({
						url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_addlist_contest?store_id=' + store_id + '&product_id=' + product_id,
						success: function (data) {
							$("#hoverText" + product_id).html("FANCIED");
							$("#hoverFancy" + product_id).removeClass('hoverFancy');
							$("#hoverFancy" + product_id).addClass('hoverFancyNext');
						}
					});

				}
				else if ($(this).children(".hoverText").html() == 'UNFANCY') {
					$.ajax({
						url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_unfancy?store_id=' + store_id + '&product_id=' + product_id,
						success: function (data) {
							$("#hoverText" + product_id).html("FANCY");
							$("#hoverFancy" + product_id).removeClass('hoverFancyNext');
							$("#hoverFancy" + product_id).removeClass('editFancynext');
							$("#hoverFancy" + product_id).addClass('hoverFancy');
						}
					});


				}

			}
		});
		$(this).hover(function () {

			if ($(this).children("#hoverText" + r).html() == 'FANCIED') {
				$(this).children("#hoverText" + r).html("UNFANCY");
				$(this).children("#hoverFancy" + r).removeClass('hoverFancyNext');
				$(this).children("#hoverFancy" + r).addClass('editFancynext');
			}

		}, function () {
			if ($(this).children("#hoverText" + r).html() == 'EDIT') {
				$(this).children(".hoverText").html("FANCIED");
				$(this).children("#hoverFancy" + r).removeClass('editFancynext');
				$(this).children("#hoverFancy" + r).addClass('hoverFancyNext');
			}
		});
	});

</script>
<script>
	function invite() {

		FB.getLoginStatus(function (response) {
			if (response.status === 'connected') {
				var accessToken = response.authResponse.accessToken;
				console.log('Access Token = ' + accessToken);
				FB.ui({method: 'apprequests',
					title: 'BuynBrag Christmas Game!',
					exclude_ids: '<?php echo $exludedIds; ?>',
					message: 'Celebrate this Christmas with BuynBrag!'
				}, requestCallback);
			}

			else if (response.status === 'not_authorized') {
				FB.login(function (response) {
					if (response.authResponse) {
						if (response.status === 'connected') {
							console.log('User is now logged-in and Has authenticated!');
							var accessToken = response.authResponse.accessToken;
							console.log('Access Token = ' + accessToken);
							FB.ui({method: 'apprequests',
								title: 'BuynBrag Christmas Game!',
								exclude_ids: '<?php echo $exludedIds; ?>',
								message: 'Celebrate this Christmas with BuynBrag!'
							}, requestCallback);
						}
					} else {
						console.log('User cancelled login or did not fully authorize.');
					}
				}, {scope: 'email,user_birthday,publish_stream'});
			}

			else {
				FB.login(function (response) {
					if (response.authResponse) {
						if (response.status === 'connected') {
							console.log('User is now logged-in and Has authenticated!');
							var accessToken = response.authResponse.accessToken;
							console.log('Access Token = ' + accessToken);
							FB.ui({method: 'apprequests',
								title: 'BuynBrag Christmas Game!',
								exclude_ids: '<?php echo $exludedIds; ?>',
								message: 'Celebrate this Christmas with BuynBrag!'
							}, requestCallback);
						}
					} else {
						console.log('User cancelled login or did not fully authorize.');
					}
				}, {scope: 'email,user_birthday,publish_stream'});
			}

			function requestCallback(response) {
				// Handle callback here
				if (response != null) {
					console.log('response from fb = ' + JSON.stringify(response));
					console.log('requestId = ' + response['request']);
					if (response['to'] != null) {
						console.log('to = ' + response['to']);
						$.ajax({
							url: "<?php echo $base_url; ?>" + 'index.php/contest/updateInvitedFriends?to=' + response['to'],
							success: function (data) {
								console.log(data);
								window.location.reload();
							}
						});
					}
				}
				else {
					console.log('FFF');
				}
			}
		});
	}
</script>
</html>