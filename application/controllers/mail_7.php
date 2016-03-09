<?php
$base_url = "http://www.buynbrag.com/";
$new_order_message = '<html>
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
					<td align = "center"><span style="color:#ff0066;"><span style="font-size: 24px;"><strong></strong></span></span>
						<img src="http://gallery.mailchimp.com/b542d237f80058103b7db8ef4/images/image_13498663305001349866338.jpg" mc:edit="image_1" mc:allowdesigner style="max-width: 600px;">
					</td>
				</tr>
                                <tr>
                                    <td align = "center">
                                        <img src="' . $productImagePath . 'storepage_banner.png" style="max-width: 600px" />
                                    </td>
                                </tr>
				<tr>
					<td style="background:#ffffff;line-height:1.25em;padding:10px 20px 30px 40px;vertical-align:top;" mc:edit="main"><h1 style="font-size:16px;font-weight:normal;color:#000000;font-family:Georgia;line-height:150%;text-align:left;">
	Hey <strong>' . $owner_name . '!</strong><br>
<br>
Congratulations!<br>
&nbsp;<br>
You&#39;ve received an order at your BuynBrag store!<br>
&nbsp;<br>
The order details are attached.<br>
&nbsp;<br>
Total Invoice Amount: Rs ' . $total_amount . '.00<br>
&nbsp;<br>
Shipping Address: <br>
<font color ="green"><strong>' . $buyer_name . '</strong></font>,<br>
<strong>' . $shipping_address . '<br>
' . $shipping_city . ' - ' . $pin_code . '</strong>
<br><br>
		
		
Coupon Code: <strong>' . $couponcode . '</strong><br>
<br>		
		
Mode of Payment: <strong>' . $payment_mode . '</strong><br>
<br>
Processing Days: ' . ($process_days) . ' days<br>
<br>
Please process the order within the days mentioned above, and contact our local logistics Contact Number, when the Order is ready for pick-up.&nbsp;<br>
&nbsp;<br>
Please reach out to us at <a href="mailto:seller@buynbrag.com"><span style="color: rgb(255, 0, 102); ">seller@buynbrag.com</span></a> in case of queries or concerns.<br>
&nbsp;<br>
Thank you!<br>
&nbsp;<br>
-<span style="color: rgb(255, 0, 102); ">The BuynBrag Team</strong></span><br></h1>
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
					<td style="background-color:transparent;padding:20px;font-size:10px;color:#666;line-height:100%;font-family:Georgia;text-align:center;" mc:edit="footer"><p><div style="float:left;"><a href="https://twitter.com/BuynBrag" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow on Twitter</a> <span align = center style="color:#4b4b4b;"></span> 
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
//echo $new_order_message;
?>