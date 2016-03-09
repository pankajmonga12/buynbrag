<html xmlns:fb="https://www.facebook.com/2008/fbml"> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<META HTTP-EQUIV="REFRESH" CONTENT="200000">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Contest</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/homepage.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url?>/assets/css/footer_links.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/alt2.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/style.css"/>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/script.js"></script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/newview.js?auto"></script>
	<style type="text/css">
		.middleBackground, BODY {
			background: url("<?php echo $base_url; ?>assets/images/top_banner_background.png") repeat scroll 0 0 transparent;
		}

	</style>
</head>
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
<body> <?php if ($user_id == 0): ?>
	<div id="fb-root"></div>
	<script>
		var button;
		var button1;
		var userInfo;

		window.fbAsyncInit = function () {
			FB.init({ appId: '<?php echo $app_id; ?>',
				status: true,
				cookie: true,
				xfbml: true,
				oauth: true});

			showLoader(false);
			showLoader2(false);
			showLoader3(false);

			function updateButton(response) {
				button = document.getElementById('fb-auth');
				button2 = document.getElementById('fb-auth2');
				button3 = document.getElementById('fb-auth3');
				//userInfo     =   document.getElementById('user-info');

				/* if (response.authResponse) {
				 //user is already logged in and connected
				 window.location="
				<?php //echo $base_url.'index.php/user/facebook/'.$controller.'/'.$function.'/'.$param1.'/'.$param2; ?>";
				 FB.api('/me', function(info) {
				 login(response, info);
				 });
				 }  */
				//else {
				//user is not connected to your app or logged out
				button.onclick = function () {
					showLoader(true);
					FB.login(function (response) {
						if (response.authResponse) {
							window.location = "<?php if(!empty($controller))
                                            echo $base_url.'index.php/user/facebook/'.$controller.'/'.$function.'/'.$param1.'/'.$param2; 
                                                            else
                                            echo $base_url.'index.php/user/facebook';?>";
							FB.api('/me', function (info) {
								showLoader(true);
								login(response, info);
							});
						} else {
							//user cancelled login or did not grant authorization
							showLoader(false);
						}
					}, {scope: 'email,user_birthday,user_about_me,publish_stream'});
				}

				button2.onclick = function () {
					showLoader2(true);
					FB.login(function (response) {
						if (response.authResponse) {
							window.location = "<?php if(!empty($controller))
                                            echo $base_url.'index.php/user/facebook/'.$controller.'/'.$function.'/'.$param1.'/'.$param2; 
                                                            else
                                            echo $base_url.'index.php/user/facebook';?>";
							FB.api('/me', function (info) {
								showLoader2(true);
								login(response, info);
							});
						} else {
							//user cancelled login or did not grant authorization
							showLoader2(false);
						}
					}, {scope: 'email,user_birthday,user_about_me,publish_stream'});
				}

				button3.onclick = function () {
					showLoader3(true);
					FB.login(function (response) {
						if (response.authResponse) {
							window.location = "<?php echo $base_url.'index.php/user/facebook/'.$controller.'/'.$function.'/'.$param1.'/'.$param2; ?>";
							FB.api('/me', function (info) {
								showLoader3(true);
								login(response, info);
							});
						} else {
							//user cancelled login or did not grant authorization
							showLoader3(false);
						}
					}, {scope: 'email,user_birthday,user_about_me,publish_stream'});
				}
				//}
			}

			// run once with current status and whenever the status changes
			FB.getLoginStatus(updateButton);
			FB.Event.subscribe('auth.statusChange', updateButton);
		};
		(function () {
			var e = document.createElement('script');
			e.async = true;
			e.src = document.location.protocol
				+ '//connect.facebook.net/en_US/all.js';
			document.getElementById('fb-root').appendChild(e);
		}());

		function login(response, info) {
			if (response.authResponse) {
				var accessToken = response.authResponse.accessToken;
				showLoader(false);
			}
		}

		function showLoader(status) {
			if (status)
				document.getElementById('loader').style.display = 'block';
			else
				document.getElementById('loader').style.display = 'none';
		}

		function showLoader2(status) {
			if (status)
				document.getElementById('loader2').style.display = 'block';
			else
				document.getElementById('loader2').style.display = 'none';
		}

		function showLoader3(status) {
			if (status)
				document.getElementById('loader3').style.display = 'block';
			else
				document.getElementById('loader3').style.display = 'none';
		}
	</script> <?php endif; ?>
<section class="wrapper">
	<article class="banner2">
		<div class="bannerTop">
			<div id="wrap" style="width: 1024px; height: 300px; border: 2px solid #ecdee6; margin-top: 15px"><img
					src="<?php echo $base_url . 'assets/images/christmas_banner2.jpg'?>"></div>
		</div>
	</article>
	<section class="middleBackground clear_both" style="margin-top: 81px">
		<div class="middleBackgroundie8">
			<div class="middleContainer" style="width: 1028px; height: 30px"></div>
			<div class="middleContainer"
			     style="width: 1028px; height: 218px; border: 1px solid #ecdee6; background-color: #f0f1f2">
				<div style="width: 390px; height: 218px; float: left;">Blank area</div>
				<!-- <div style="display: inline-block; width: 630px; height: 100%; float: right; border: 1px solid blue; position: relative"></div> -->
				<div style="width: 18px; height: 198px; float: left; margin-top: 22px"><img
						src="<?php echo base_url(); ?>assets/images/badges_spacer.jpg" style=""/></div>
				<div style="width: 141px; height: 193px; float: left; margin-top: 30px"><img
						src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg" style=""/>
					Fancy <?php if (count($fancy_game) == 0) echo "win"; ?> </div>
				<div style="width: 22px; height: 128px; float: left; margin-top: 94px"><img
						src="<?php echo base_url(); ?>assets/images/plus.jpg" style=""/></div>
				<div style="width: 141px; height: 193px; float: left; margin-top: 30px"><img
						src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg" style=""/>
					BRAG <?php if (count($brag_game) == 0) echo "win"; ?> </div>
				<div style="width: 22px; height: 128px; float: left; margin-top: 94px"><img
						src="<?php echo base_url(); ?>assets/images/plus.jpg"/></div>
				<div style="width: 144px; height: 193px; float: left; margin-top: 30px"><img
						src="<?php echo base_url(); ?>assets/images/contest_badge_p_h.jpg" style=""/> <input
						type="button" class="buttonStyleForInviteButton" value="Invite Friends From Fb"
						onclick="invite();"/></div>
				<div style="width: 128px; height: 193px; float: left; margin-top: 32px"><img
						src="<?php echo base_url(); ?>assets/images/discount_image.jpg" style=""/></div>
			</div>
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
<input id="sess_id" type="hidden"
       value="<?php echo $user_id; ?>"> <?php include "fancy_unfancy_prod.php" ?> <?php include "footer.php" ?> </body>
<script src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
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
							url: "<?php echo $base_url; ?>" + 'index.php/contest/updateInvitedFriends?to=' + response['to'] + '&date=' +<?php echo $date; ?>,
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