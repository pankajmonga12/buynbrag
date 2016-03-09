<?php
$base_url = "http://www.buynbrag.com/";
$poll_message = '
<html>
	<head>
		<title>*|MC:SUBJECT|*</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		
	<style type="text/css">
	/*
	@tab Page
	@section background color
	@tip Choose a color for your HTML email\'s background. You might choose one to match your company\'s branding.
	@theme page
	*/
		body,#wrap{
			/*@editable*/background-color:#d2efef;
			text-align:center;
		}
		#layout{
			margin:10px auto;
			text-align:left;
		}
	/*
	@tab Top Bar
	@section topbar bar
	@tip Choose a set of colors that look good with the colors of your logo image or text topbar.
	*/
		#topbar{
			/*@tab Top Bar
@section topbar bar
@tip Choose a set of colors that look good with the colors of your logo image or text topbar.*/background-color:transparent;
			padding:10px 0 20px;
			/*@editable*/color:#666;
			/*@editable*/font-size:11px;
			/*@editable*/font-family:Georgia;
			/*@editable*/font-weight:normal;
			/*@editable*/text-align:center;
		}
	/*
	@tab Top Bar
	@section topbar links
	@tip Choose a set of colors that look good with the colors of your logo image or text topbar.
	*/
		#topbar{
			/*@editable*/color:#ff8e6b;
			/*@editable*/text-decoration:underline;
			/*@editable*/font-weight:normal;
		}
		#content{
			background:#ffffff;
			line-height:1.25em;
			padding:10px 20px 30px 40px;
			vertical-align:top;
		}
	/*
	@tab Body
	@section title style
	@tip Titles and headlines in your message body. Make them big and easy to read.
	@theme title
	*/
		.primary-heading{
			/*@editable*/font-size:22px;
			/*@editable*/font-weight:normal;
			/*@editable*/color:#7e7e7e;
			/*@editable*/font-family:Georgia;
			/*@editable*/line-height:150%;
			text-align:center;
		}
	/*
	@tab Body
	@section button style
	@tip This is the byline text that appears immediately underneath your titles/headlines.
	@theme subtitle
	*/
		p.btn{
			/*@editable*/
			/*@editable*/
			
			/*@editable*/
			
			
			/*@editable*/
			/*@editable*/
			
		}
	/*
	@tab Body
	@section lower text style
	@tip This is the byline text that appears immediately underneath your titles/headlines.
	@theme subtitle
	*/
		p.note{
			/*@editable*/font-family:Georgia;
			/*@editable*/color:#777;
			margin:0 10%;
			/*@editable*/font-size:16px;
			/*@editable*/line-height:1.4em;
			text-align:center;
		}
	/*
	@tab Footer
	@section footer
	@tip You might give your footer a light background color and separate it with a top border
	@theme footer
	*/
		#footer{
			/*@tab Footer
@section footer
@tip You might give your footer a light background color and separate it with a top border
@theme footer*/background-color:transparent;
			padding:20px;
			/*@editable*/font-size:10px;
			/*@editable*/color:#666;
			/*@editable*/line-height:100%;
			/*@editable*/font-family:Georgia;
			text-align:center;
		}
	/*
	@tab Footer
	@section link style
	@tip Specify a color for your footer hyperlinks.
	@theme link_footer
	*/
		#footer a{
			/*@editable*/color:#ff8e6b;
			/*@editable*/text-decoration:underline;
			/*@editable*/font-weight:normal;
		}
	/*
	@tab Page
	@section link style
	@tip Specify a color for all the hyperlinks in your email.
	@theme link
	*/
		a,a:link,a:visited{
			/*@editable*/color:#ff8e6b;
			/*@editable*/text-decoration:underline;
			/*@editable*/font-weight:normal;
		}
		#templateHeader{
			padding:0px;
			background-color:#000000;
		}
</style></head>
	<body>
		<div id="wrap">
			<table id="layout" border="0" cellspacing="0" cellpadding="0" width="600">
				<tr>
					<td id="topbar" mc:edit="topbar"><br>
<!-- *|END:IF|* --></td>
				</tr>
				<tr>
					<td>
						<img src="http://gallery.mailchimp.com/b542d237f80058103b7db8ef4/images/image_13498663305001349866338.jpg" mc:edit="image_1" mc:allowdesigner style="max-width: 600px;">
					</td>
				</tr>
				<tr>
					<td id="content" mc:edit="main"><h1 class="primary-heading">
	<span style="color:#000000;">Hey there!</span>
	&nbsp;</h1>
<div style="text-align: center; ">
  <span style="font-size:24px;">' . $poll_owner . ' wants your opinion on something they like on BuynBrag!</span><br><br>
  <span style="font-size:24px;"><font color="green">' . $poll_question . '!</font></span></div>
    <p>&nbsp;</p>
    <table border="0" align="center">
  <tr>'; ?>

<?php foreach ($pid as $prod) : ?>
	<?php if (!empty($prod[0])) $poll_message = $poll_message . '
   <td align="center" width="200"><a href="' . $base_url . 'order/product_page/' . $prod[0] . '/' . $prod[1] . '"><img src="' . $base_url . 'assets/images/stores/' . $prod[0] . '/' . $prod[1] . '/img1_171x171.jpg" width="171" height="171" alt="product image"></a></td>'; ?>
<?php endforeach; ?>
<?php $poll_message = $poll_message . '</tr>
  <tr>'; ?>
<?php foreach ($pid as $prod) : ?>
	<?php if (!empty($prod[0])) $poll_message = $poll_message . '
    <td height="54" align="center" valign="top"><h3><font color="#FF0066">' . $prod[2] . '</font></h3></td>'; ?>
<?php endforeach; ?>
<?php $poll_message = $poll_message . '</tr>
    </table>
<a href="' . $base_url . 'index.php/poll/vote/' . $poll_id . '">
<p style="background:#ff0066;border:3px solid #ebebeb;width:auto;color:#fff;text-align:center;margin:25px 15%;font-size:40px;font-family:Georgia;padding:.7em 0;">
	<span style="font-size:24px;">Click here to vote on the Poll!</span></p></a>
<div style="text-align: center; ">
	<div>
		<span style="color:#ff0066;"><span style="font-size: 24px; ">Happy Discovering!</span></span><br>
		&nbsp;</div>
	<div>
		<span style="color:#ff0066;"><span style="font-size: 24px; ">- The BuynBrag Team</span></span></div>
</div>
<p class="note">&nbsp;
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
					<td id="footer" mc:edit="footer"><p>
	<a href="http://www.facebook.com/buynbrag" target="_blank">Facebook</a>| <a href="http://www.twitter.com/buynbrag" target="_blank"><u>Twitter</u></a> | <a href="*|FORWARD|*">Forward to a friend</a></p>
<div style="">
	<div>
		36, Hartron Complex, Electronic City,</div>
	<div>
		Sector 18, Udyog Vihar,</div>
	<div>
		Gurgaon</div>
</div>
<p>
	Copyright (C) Social Scientists E-Commerce Pvt. Ltd.&nbsp;&nbsp;All rights reserved.</p>
</td>
				</tr>
			</table>
		</div>
		<span style="padding: 0px;"></span>
	</body>
</html>
';
//echo $poll_message;
?>