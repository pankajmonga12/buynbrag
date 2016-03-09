<?php
$base_url = "http://www.buynbrag.com/";
$purchase_message = '<html>
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
	Hi ' . $buyer_name . ',<br>
<br>
Congratulations! Your BuynBrag order has been placed.<br>
Your Order No for the Product: <font color=green><strong>' . $product_name . '</strong></font><font color=brown><strong>' . $variant_details . '</strong></font> is <strong>' . $order_no . '</strong><br>
 <br>
Kindly note down the Order No mentioned above for any future reference. <br>
 <br>
It will reach your shipping address in ' . ($process_days + 5) . ' working days.<br>
<br>
Shipping Address: <br>
<strong>' . $shipping_address . '<br>
' . $shipping_city . ' - ' . $pin_code . '</strong>
<br><br>
<table border = "1"
           style="border-collapse: collapse; border: 3px solid; width: 200px; font-family: Helvetica, sans-serif;" align = "center">
      <tr>
          <th>ORDER ID</th>
          <th>PRODUCT NAME</th>
          <th>PRODUCT DETAILS</th>
          <th>QUANTITY</th>
          <th>COUPON CODE</th>
          <th>MODE OF PAYMENT</th>
          <th>AMOUNT PAYABLE</th>
      </tr>
      <tr>
          <td>'.$order_no.'</td>
          <td>'.$product_name.'</td>
          <td>'.$variant_details.'</td>
          <td>'.$mail_info[$j]['quantity'].'</td>
          <td>'.$couponcode.'</td>
          <td>'.$payment_mode.'</td>
          <td>'.$mail_info[$j]['quantity'] * $mail_info[$j]['amt_paid'].'</td>
      </tr>
</table>

		
<!--Coupon Code: <strong>' . $couponcode . '</strong><br>
<br>
		
Mode of Payment: <strong>' . $payment_mode . '</strong>--><br>
<br>
Please log into BuynBrag and view your Purchase History to get invoice statement!<br>
<br>
<strong>Note (only for COD):</strong>Rs:50 extra will be charged per item for Cash On Delivery. Please have the order amount ready&nbsp;in cash to receive your products upon delivery. Our courier partner will not be able to collect cheques or demand drafts.<br>
<br>
In case of queries or concerns, reach out to us at <span style="color:#ff0066;">talktous@buynbrag.com</span><br>
<br> Call us or send us a text at <b><span style="color:#ff0066;">+91 8130878822</span></b><br>
<br>

<span style="color:#ff0066;"><strong>- The BuynBrag Team</strong></span><br></h1>
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
		IQR, Plot No.21,22, 4th Floor,</div>
	<div>
		Phase 4, Udyog Vihar,</div>
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
/*echo $purchase_message;*/
?>
