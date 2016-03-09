<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>How it Works</title>
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
							<div class="leftPanelLinksActive">Selling with BuynBrag
								<div class="hiddenTriangle"></div>
							</div>
						</a>
						<a href="<?php echo $base_url . 'index.php/footer/seller_registration' ?>">
							<div class="leftPanelLinks borderTop0 borderBottom0">Seller Registration</div>
						</a>
						<?php
						/*<a href="<?php echo $base_url . 'index.php/login/seller' ?>" id="sellerLoginLink">*/
						?>
						<a href="javascript:void(0)" id="sellerLoginLink" onClick="">
							<div class="leftPanelLinks">Seller Login</div>
						</a>
						<a href="<?php echo $base_url . 'index.php/footer/rules_policies' ?>">
							<div class="leftPanelLinks">Rules and Policies</div>
						</a>
					</div>
					<div class="panelSeparator newHeightFooter"></div>
					<div class="rightPanel">
						<div class="forRightPanelPadding">
							<div class="rightPanelHeading">Selling with BuynBrag</div>
							<div class="rightPanelDesc" style="line-height:18px">
                                <p>BuynBrag is a marketplace of unique,
									curated finds from across the country. We troll the bylanes of towns small and big,
									in the search for things that are crafted with love and tell a story</p>

								<p>We invite the creators of these finds to set up shop with us and make it available to
									others who share our sense of aesthetic, who would appreciate it as much as us.</p>

                                <p>You can set up a store on BuynBrag if you are one of the following:</p>
                                <ul>
                                    <li>You have a boutique store</li>
                                    <li>You have an e-commerce website</li>
                                    <li>You supply products to various stores</li>
                                    <li>You help artisans and designers sell their products</li>
                                </ul>

								<p style="padding:15px 0px 15px 0px;"><strong>The BuynBrag Advantage:</strong></p>

								<p>At Buynbrag, we believe in providing you the complete solution for taking your
									business online. To sell online, you do not have to set up a website, you just need
									an e-store. We provide you that and lots more and you do what you do best, i.e.
									create amazing products. </p>

								<p style="padding-top:15px">What's more, you sell your creations under your own brand
									across the country to discerning shoppers who seek quality craftsmanship and unique
									design.</p>

								<p style="padding-top:15px">When an order comes in, we pick it up from your warehouse
									and have it delivered at the shopper's doorstep.</p>

								<p style="padding-top:15px"><strong>Therefore we take over complete responsibility
										for:</strong></p>

								<p>
								<ul style="padding:10px 0px 0px 15px">
									<li>Designing your Virtual Storefront</li>
									<li>Product Photography (optional)</li>
									<li>Content Writing (optional)</li>
									<li>Inventory Planning</li>
									<li>Pricing</li>
									<li>Store Management</li>
									<li>Logistics Support</li>
									<li>Customer Care</li>
									<li>Marketing and Promotions</li>
								</ul>
								</p> </div>
						</div>
					</div>
				</div>
				<div class="backToTop" style="margin-top:15px"><a href="#forHeight">Back to Top</a></div>
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
					<?php
						if(isset($openModal) && $openModal == 1)
						{
							?>
							<div class="row-fluid">
								<span class="text text-error">Illegal username / password</span>
							</div>
							<?php
						}
					?>
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
</section>
<?php include "footer.php" ?>
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
<?php
	if(isset($openModal) && $openModal == 1)
	{
		?>
jQuery("#sellerLoginModal").modal('show');
		<?php
	}
?>
//]]>
</script>
<!-- End Section For new seller login by Shammi Shailaj -->
</body>
</html>