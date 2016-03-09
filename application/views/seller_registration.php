<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Seller Registration</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/footer_links.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] -->
	<script type="text/javascript">
		$(function () {
			tooltip2();
		});
	</script>
</head>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<section class="middleBackground noMinHeight">
		<div class="Ie8bg">
			<div class="storeMiddleBackgroundContainer">
				<div class="forHeight" id="forHeight">
					<div class="leftPanel autoHeight">
						<a href="<?php echo $base_url . 'index.php/footer/how_it_works' ?>">
							<div class="leftPanelLinks">Selling with BuynBrag</div>
						</a>
						<a href="<?php echo $base_url . 'index.php/footer/seller_registration' ?>">
							<div class="leftPanelLinksActive">Seller Registration
								<div class="hiddenTriangle"></div>
							</div>
						</a>
						<a href="javascript:void(0)" id="sellerLoginLink">
							<div class="leftPanelLinks">Seller Login</div>
						</a>
						<a href="<?php echo $base_url . 'index.php/footer/rules_policies' ?>">
							<div class="leftPanelLinks">Rules and Policies</div>
						</a>
					</div>
					<div class="panelSeparator newHeightFooter"></div>
					<div class="rightPanel">
						<div class="forRightPanelPadding">
							<div class="rightPanelHeading">Seller Registration</div>
							<div class="rightPanelDesc" style="line-height:18px"><p>If you think your products fit the
									bill, give us a shout</p>

								<p>Email us at <span style="color:#eb3862"><a href="mailto:seller@buynbrag.com"
								                                              style="color:#eb3862">seller@buynbrag.com</a></span>&nbsp;with
									the following details.</p>

								<p>
								<ul style="padding:20px 0px 0px 15px">
									<li>A brief description of your business</li>
									<li>Location of business</li>
									<li>Product photographs</li>
									<li>Business owner's bio</li>
								</ul>
								</p> <p style="padding-top:20px">Someone from our team will be in touch with you to take
									things forward.</p></div>
						</div>
					</div>
				</div>
				<div class="backToTop"><a href="#forHeight">Back to Top</a></div>
			</div>
		</div>
		<!-- New seller login modal by Shammi Shailaj -->
		<div id="sellerLoginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h3 id="myModalLabel">Login to BuynBrag</h3>
			</div>
			<form action="<?php echo $baseURL;?>index.php/login/getMeLoggedIn" method="POST">
				<div class="modal-body">
					<div class="row-fluid">
						<div class="input-prepend span12">
							<span class="add-on">Email Address</span>
							<input type="text" placeholder="Your Email" id="inputEmail" class="span7" name="login_username">
						</div>
					</div>
					<div class="row-fluid">
						<div class="input-prepend span12">
							<span class="add-on" style="width: 5.76em">Password</span>
							<input type="password" placeholder="Your Password" id="inputPassword" class="span7" name="login_pass">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit">Login</button>
					<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true" >Cancel</button>
				</div>
			</form>
		</div>
		<!-- End section New seller login modal by Shammi Shailaj -->
	</section>
</section> <?php include "footer.php" ?>
<!-- For new seller login by Shammi Shailaj -->
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function()
{
	jQuery("#sellerLoginLink").click(function()
	{
		jQuery("#sellerLoginModal").modal('show');
	});
});
//]]>
</script>
<!-- End Section For new seller login by Shammi Shailaj -->
</body>
</html>