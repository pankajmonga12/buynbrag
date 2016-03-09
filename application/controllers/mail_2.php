<?php
$base_url = "http://www.buynbrag.com/";
$follow_message = '<html>
	<head>
		<title>*|MC:SUBJECT|*</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<style type="text/css">
	
		#footer a{
			color:#ff8e6b;
			text-decoration:none;
			font-weight:normal;
		}
	/*
	@tab Page
	@section link style
	@tip Specify a color for all the hyperlinks in your email.
	@theme link
	*/
		a,a:link,a:visited{
			color:#ff8e6b;
			text-decoration:none;
			font-weight:normal;
		}
		#templateHeader{
			padding:0px;
			background-color:#000000;
		}
</style></head>
	<body style="background-color:#d2efef;text-align:center;">
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>
		<div style="background-color:#d2efef;text-align:center;">
			<table style="margin:10px auto;text-align:left;" border="0" cellspacing="0" cellpadding="0" width="600">
				<tr>
					<td style="padding:10px 0 20px;color:#666;font-size:11px;font-family:Georgia;font-weight:normal;text-align:center;text-decoration:none;" mc:edit="topbar"><br>
<!-- *|END:IF|* --></td>
				</tr>
				<tr>
					<td>
						<img src="http://gallery.mailchimp.com/b542d237f80058103b7db8ef4/images/image_13498663305001349866338.jpg" mc:edit="image_1" mc:allowdesigner style="max-width: 600px;">
					</td>
				</tr>
				<tr>
					<td style="background:#ffffff;line-height:1.25em;padding:10px 20px 30px 40px;vertical-align:top;" mc:edit="main"><h1 style="font-size:22px;font-weight:normal;color:#7e7e7e;font-family:Georgia;line-height:150%;text-align:center;">
	<span style="color:#000000;">Hey there!</span></h1>
<div>
	&nbsp;</div>
	
<div style="text-align: center; ">
	<span style="font-size:24px;">
	<img align="center" height="100px" alt =" " src="' . $base_url . 'assets/images/users/' . $self_id . '/' . $self_id . '_large.jpg">
	<strong>' . $follower_name . '</strong> just followed you on BuynBrag!&nbsp;</span></div>
<div style="text-align: center; ">
	&nbsp;</div>
<a style="text-decoration:none;" href="' . $base_url . 'order/friend_fancy_product/' . $self_id . '"><p style="background:#ff8e6b;border:3px solid #ebebeb;width:auto;color:#fff;text-align:center;margin:25px 15%;font-size:40px;font-family:Georgia;padding:.7em 0;">
	<span style="font-size:24px;">Click here to view User Profile!</span></p></a>
<a style="text-decoration:none;" href="' . $base_url . 'user_info/friend_follow/' . $uid . '/' . $self_id . '"><p style="background:#006400;border:3px solid #ebebeb;width:auto;color:#fff;text-align:center;margin:25px 15%;font-size:40px;font-family:Georgia;padding:.7em 0;">
<span style="font-size:24px;">Click here to follow them back!</span></p></a>
<div style="text-align: center; ">
	<div>
		<span style="color:#ff0066;"><span style="font-size: 24px; ">Happy Discovering!</span></span><br>
		&nbsp;</div>
	<div>
		<span style="color:#ff0066;"><span style="font-size: 24px; ">- The BuynBrag Team</span></span></div>
</div>
<p style="font-family:Georgia;color:#777;margin:0 10%;font-size:16px;line-height:1.4em;text-align:center;">&nbsp;
	</p>
<div>
	&nbsp;</div>
<div>
	&nbsp;</div>
</td>
				</tr>
				<tr>
					<td id="page_curl">
						<img src="http://gallery.mailchimp.com/0d61bb2ec9002f0e9872b8c36/images/beauty_coupon_footer.png">
					</td>
				</tr>
				<tr>
					<td style="background-color:transparent;padding:20px;font-size:10px;color:#666;line-height:100%;font-family:Georgia;text-align:center;" mc:edit="footer"><p>
	<div style="float:left;"><a href="https://twitter.com/BuynBrag" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow on Twitter</a> <span align = center style="color:#4b4b4b;"></span> 
</div>
<span align = center style="color:#4b4b4b;"><strong><a style="color:#4682b4;" href="https://www.facebook.com/Buynbrag">Like us on Facebook</a></strong></span>
<div class="fb-like" data-href="https://www.facebook.com/Buynbrag" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-font="tahoma"></div></p>
<div style="">
	<div>
		36, Hartron Complex, Electronic City,</div>
	<div>
		Sector 18, Udyog Vihar,</div>
	<div>
		Gurgaon</div>
</div>
<p>
	Copyright &copy; Social Scientists E-Commerce Pvt. Ltd.&nbsp;&nbsp;All rights reserved.</p>
</td>
				</tr>
			</table>
		</div>
		<span style="padding: 0px;"></span>
	</body>
</html>
';
//echo $follow_message;
?>