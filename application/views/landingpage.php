<html xmlns:fb="https://www.facebook.com/2008/fbml"> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Landing Page New</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_new.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/libs/jquery-1.7.2.min.js"></script>
	<!--<script src="http://www.google-analytics.com/ga.js" async="" type="text/javascript"></script>--> </head>
<body>
<div id="fb-root"></div>
<script>
	var button;
	var userInfo;

	window.fbAsyncInit = function () {
		FB.init({ appId: '464096783643221',
			status: true,
			cookie: true,
			xfbml: true,
			oauth: true});

		showLoader(true);

		function updateButton(response) {
			button = document.getElementById('fb-auth');
			//userInfo     =   document.getElementById('user-info');

			if (response.authResponse) {
				//user is already logged in and connected
				FB.api('/me', function (info) {
					login(response, info);
					window.location = "<?php echo $base_url.'user/facebook'; ?>";
				});

//                        button.onclick = function() {
//                            FB.logout(function(response) {
//                                logout(response);
//                            });
//                        };
			} else {
				//user is not connected to your app or logged out
				//button.innerHTML = 'Login';
				button.onclick = function () {
					showLoader(true);
					FB.login(function (response) {
						if (response.authResponse) {
							FB.api('/me', function (info) {
								login(response, info);
							});
						} else {
							//user cancelled login or did not grant authorization
							showLoader(false);
						}
					}, {scope: 'email,user_birthday,status_update,publish_stream,user_about_me'});
				}
			}
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

			//userInfo.innerHTML  = '<img src="https://graph.facebook.com/' + info.id + '/picture">' + info.name
			//+ "<br /> Your Access Token: " + accessToken;
			//button.innerHTML  = 'Logout';
			showLoader(false);
			//document.getElementById('other').style.display = "block";
		}
	}

	function logout(response) {
		userInfo.innerHTML = "";
		document.getElementById('debug').innerHTML = "";
		document.getElementById('other').style.display = "none";
		showLoader(false);
	}

	function showLoader(status) {
		if (status)
			document.getElementById('loader').style.display = 'block';
		else
			document.getElementById('loader').style.display = 'none';
	}
</script>
<section class="wrapper">
	<div class="leftStripHolder" id="leftStripHolder">
		<div class="landing_logo"></div>
	</div>
	<div class="leftStripBig" id="leftStripBig">
		<div class="landing_logo1"></div>
		<div class="close_icon" id="close_icon"></div>
		<div class="fancy_logo_text_holder clear_both">
			<div class="fancy_logo"></div>
			<div class="fancy_heading_text">
				<div class="fancy_heading more_style">FANCY</div>
				<div class="fancy_body_Text">See something you love? Hit 'Fancy' and add it to your list of loves and
					you can revisit it anytime you want. Beyonce said it right - If you like it then you should put a
					'crown' on it!!
				</div>
			</div>
		</div>
		<div class="style_logo_text_holder clear_both">
			<div class="styleboard_logo"></div>
			<div class="fancy_heading_text">
				<div class="fancy_heading">STYLEBOARD</div>
				<div class="fancy_body_Text">Your very own style spread. Coming soon!</div>
			</div>
		</div>
		<div class="style_logo_text_holder clear_both">
			<div class="blog_logo"></div>
			<div class="fancy_heading_text">
				<div class="fancy_heading">BLOG</div>
				<div class="fancy_body_Text">Your personal column on what not to wear
					<div>(or anything you want)! Coming soon!</div>
				</div>
			</div>
		</div>
		<div class="style_logo_text_holder clear_both">
			<div class="poll_logo"></div>
			<div class="fancy_heading_text">
				<div class="fancy_heading">POLL</div>
				<div class="fancy_body_Text">Money is finite, fascination isn't. So when you're torn between two awesome
					things to buy, create a poll and get your friends to vote! Your best friend wouldn't lie, so count
					on her!
				</div>
			</div>
		</div>
	</div>
	<div class="rightContentsHolder">
		<div class="soulCharacterHeading">SOUL, CHARACTER</div>
		<div class="hardtofindtText">AND OTHER THINGS HARD-TO-FIND.</div>
		<div class="destinationText">your single destination for contemporary, quirky lifestyle</div>
		<div id="fb-auth" style="cursor: pointer;" class="signupfromfacebookHolder" onClick="">
			<div class="facebook_icon_holder">
				<div class="facebook_icon"></div>
			</div>
			<div class="signup_facebook_text">Signup with Facebook</div>
		</div>
		<div class="itsfreeText" id="loader">Its Free!</div>
		<!-- <div class="fb-login-button" data-show-faces="false" data-width="200" data-max-rows="1"></div>-->
		<div class="memberSigninText">Already a member ?<span id="fb-auth" style="cursor: pointer;"
		                                                      style="color:#f93873;"> Sign In</span></div>
	</div>
	<div class="footer_bottom">
		<div class="footerContainer"> <!--<div class="footerContainerBackground"></div>-->
			<!-- <div class="footerContent"> <div class="footerContentHolder"> <a href="javascript:void(0)"><div class="aboutusText">ABOUT US</div></a> <a href="javascript:void(0)"><div class="aboutusText">SHIPPING &amp; RETURNS</div></a> <a href="javascript:void(0)"><div class="aboutusText">PRIVACY &amp; TERMS</div></a> <a href="javascript:void(0)"><div class="aboutusText">FAQ</div></a> <a href="javascript:void(0)"><div class="aboutusText" style="margin-right:0">CAREERS</div></a> </div> </div>--> </div>
	</div>
</section>
</body>
<script type="text/javascript">
	function Randomize() {
		var baseurl = $('#baseurl').val();
		var images = new Array("landing_1.jpg", "landing_2.jpg", "landing_3.jpg", "landing_4.jpg", "landing_5.jpg");
		var imageNum = Math.floor(Math.random() * images.length);
		$("body").css("background-image", "url(<?php echo $base_url; ?>assets/images/" + images[imageNum] + ")");
	}

	window.onload = Randomize;
	$(function () {
		$("#leftStripBig").show().hide(1000);
		$("#close_icon").click(function () {
			$("#leftStripBig").hide(200);
			$("#leftStripHolder").show(200);
		});
		$("#leftStripHolder").hover(function () {
			$("#leftStripBig").show(200);
			$("#leftStripHolder").hide(200);
		});
	});
</script>
</html>