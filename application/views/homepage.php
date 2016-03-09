<?php if( ! defined ( 'BASEPATH' )) exit('Direct script access not allowed'); ?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns:ng="http://angularjs.org" ng-app="IpApp">
<head>

	<script type="text/javascript">
		//<!--
		var baseURL = '<?php echo $baseURL; ?>';
		//-->
	</script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">

	<meta name="robots" content="index, follow">

	<title>BuynBrag Home | Your single destination for contemporary, quirky lifestyle.</title>

	<meta name="description" content="WE KNEW YOU WOULD COME HERE!! BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">
	<meta name="keywords" content="buy, and, brag, buyandbrag, buynbrag, buy and brag,  social, shopping, outfits, trends, fashion, style advice, trends, what to wear, casual wear, individual style, style tips, fashion blog">
	<meta name="author" content="BuynBrag">

	<meta property="og:site_name" content="buynbrag">
	<meta property="og:title" content="BuynBrag | Your destination for discovery and indulgence and all things luxury you will love.">
	<meta property="og:description" content="BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="<?php echo $baseURL; ?>dist/styles/main.css" rel="stylesheet">

	<link href="<?php echo $baseURL; ?>favicon.ico" rel="shortcut icon" type="image/ico" />

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-3512457-27']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

	<script>
		var _gaq=[['_setAccount','UA-35785264-1'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));

	</script>

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-35785264-1']);
		_gaq.push(['_setDomainName', 'buynbrag.com']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

	<script type="text/javascript">
		(function() {
			var a = document.createElement('script');a.type = 'text/javascript'; a.async
				= true;
			a.src=('https:'==document.location.protocol?'https://':'http://cdn.')
				+'chuknu.sokrati.com/305/tracker.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(a, s);
		})();
	</script>

</head>

<body ng-controller="IpAppController">
<!--================== Header Section ================================-->

<header>
    <div class="headerTop container">

        <nav class="navbar navbar-inverse">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="logo pull-left hidden-phone" href="/">Home</a>
                <div class="signInAccountHolder pull-right" ng-hide='user.userid' >
                    <a href="#loginModal" class="signInImage pull-left loginRequired" id="signInAccount" role="button" data-toggle="modal">Sign In</a>
                    <div class="image_Separator pull-left"></div>
                    <a href="#registerModal" class="accountImage pull-left registerModal" id="createAccount" role="button" data-toggle="modal">Sign Up</a>
                </div>
                <div class="signedInProfileHolder pull-right " ng-show="user.userid">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="userImage" ng-src="{{user.userdata.fbsrc}}" alt="{{user.userdata.name}} Pic">
                        <span class="userName hidden-phone" ng-cloak>{{user.userdata.name}}</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/user_info/user_detail/">Profile</a></li>
                        <li><a href="/order/user_fancy_product/">Fancy list</a></li>
                        <li><a href="/user_info/badges/">Badges unlocked</a></li>
                        <li><a href="/user_info/purchase_history/">Purchase history</a></li>
                        <li><a href="" ng-click="logout()">Log Out</a></li>
                    </ul>
                </div>
                <ul class="notificationCounterContainer pull-right" ng-show="user.userid">
                    <!--<li><a class="userPollCount cssTransition" href="#"><span class="notificationBadge">12</span></a></li>-->
                    <li>
                        <a href="/order/user_fancy_product/" class="userFancyCount cssTransition">
                            <span class="notificationBadge" ng-cloak>{{user.userdata.fancy}}</span>
                            <span class="tooltips hide">Fancied items</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="userRankCount cssTransition">
                            <span class="notificationBadge" ng-cloak>{{user.userdata.rank}}</span>
                            <span class="tooltips hide">Your rank</span>
                        </a>
                    </li>
                    <li>
                        <a href="/cart/shopping_cart" class="userCartCount cssTransition">
                            <span class="notificationBadge" ng-cloak>{{user.userdata.cartcount}}</span>
                            <span class="tooltips hide">Your cart</span>
                        </a>
                        <!--<ul class="cartPreviewContainer dropdown-menu">-->

                        <!--<li class="cartItemDetails" ng-repeat="item in user.userdata.cart">-->
                        <!--<a href="#">-->
                        <!--<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/{{item.storeID}}/{{item.productID}}/img2_40x40.jpg" alt="item preview">-->
                        <!--<span class="itemPreviewDescriptionContainer">-->
                        <!--<span class="itemName">{{item.productName}}</span>-->
                        <!--<span class="itemTotalContainer">X-->
                        <!--<span class="itemQuantity">{{item.quantity}}</span>-->
                        <!--<span class="itemPriceHolder">Total Cost   :<span class="itemPrice">78000</span></span>-->
                        <!--</span>-->
                        <!--</span>-->
                        <!--</a>-->
                        <!--</li>-->

                        <!--<li class="checkOutCart">-->
                        <!--<a href="#">Checkout Cart-->
                        <!--&lt;!&ndash;<span class="cartDetailsContainer">&ndash;&gt;-->
                        <!--&lt;!&ndash;<span class="cartTotalContainer">X&ndash;&gt;-->
                        <!--&lt;!&ndash;<span class="cartItemQuantity">1</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;<span class="cartTotalPriceHolder">Total Cost   :<span class="CartTotalPrice">78000</span></span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</span>&ndash;&gt;-->
                        <!--&lt;!&ndash;</span>&ndash;&gt;-->
                        <!--</a>-->
                        <!--</li>-->

                        <!--</ul>-->
                    </li>
                </ul>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="visible-phone"><a href="/">Home</a></li>
                        <li ng-controller="DiscoverController">
                            <a id="bootStrapDropDownFix" href="#" class="dropdown-toggle" data-toggle="dropdown">Discover
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li ng-repeat="category in categories"><a ng-href="/categories/cat_product/{{category.catID}}">{{category.catName}}</a></li>
                            </ul>
                        </li>
                        <li><a href='/homepage/#/store'>Stores</a></li>
                        <!--<li><a href="http://blog.buynbrag.com">Blog</a></li>-->
                        <!--<li class="navSearch hide">-->
                        <!--<input type="text" class="span2" placeholder="Search">-->
                        <!--</li>-->
                    </ul>
                    <!--<div class="nav pull-right">-->
                    <!--&lt;!&ndash;<li><a href="http://buynbrag.com/login/" data-link="modal" data-target="#login-modal">Log In</a></li>&ndash;&gt;-->
                    <!--&lt;!&ndash;<li><a href="http://buynbrag.com/signup/" data-link="modal" data-target="#signup-modal">Sign Up</a></li>&ndash;&gt;-->
                    <!--</div>-->
                </div>
            </div>
        </nav>
    </div>
</header>

<!--================== Mid Section ================================-->

<div ng-switch on="renderPath[ 0 ]">
	<!-- Home Content. -->
	<div ng-switch-when="home" ng-include=" '<?php echo $baseURL; ?>dist/views/home.html' "></div>

	<!-- Login Content. -->
	<div ng-switch-when="login" ng-include=" '<?php echo $baseURL; ?>dist/views/login.html' "></div>

	<!-- Register Content. -->
	<div ng-switch-when="register" ng-include=" '<?php echo $baseURL; ?>dist/views/register.html' "></div>

	<!-- Store Content. -->
	<div ng-switch-when="store" ng-include=" '<?php echo $baseURL; ?>dist/views/store.html' "></div>

	<!-- Search Content. -->
	<div ng-switch-when="search" ng-include=" '<?php echo $baseURL; ?>dist/search.html' "></div>

</div>


<!-- lOGIN Modal -->
<div id="loginModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="LoginController">
	<!--<div class="modal-header">-->
	<!--&lt;!&ndash;<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>&ndash;&gt;-->
	<!--<h3 id="myModalLabel">Modal header</h3>-->
	<!--</div>-->
	<div class="modal-body">

		<div class=" loginContainer">
			<div class="span5 loginForm">
				<form id="login">
					<fieldset>
						<legend>Login to BuynBrag</legend>

						<label>Email:<input type="email" id="inputEmail" placeholder="Email" ng-model="login.Email" autofocus required></label>
						<label>Password:<input type="password" id="inputPassword" placeholder="Password" ng-model="login.Password" required></label>
						<!--<label class="checkbox"><input type="checkbox"> Remember me</label>-->

						<button ng-click="loginUser()" type="submit" class="btn btn-primary">Sign in</button>
						<a ng-href="{{baseUrl}}fbLogin/index">Login with Facebook</a>
						<!-- ADDED BY SHAMMI FOR TESTING -->
						<button onClick="facebookSignIn()" class="btn btn-primary">Login via Facebook</button>
						<!-- END SECTION ADDED BY SHAMMI FOR TESTING -->
						<!--<span>OR</span>-->

						<!--<button class="fbLogin">Sign in with Facebook</button>-->
					</fieldset>
				</form>
			</div>
		</div>
		<span class="formError" ng-show="formError">{{formError}}</span>

	</div>
	<!--<div class="modal-footer">-->
	<!--<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>-->
	<!--<button class="btn btn-primary">Save changes</button>-->
	<!--</div>-->
</div>

<!-- REGISTER Modal -->
<div id="registerModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="LoginController">
	<!--<div class="modal-header">-->
	<!--&lt;!&ndash;<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>&ndash;&gt;-->
	<!--<h3 id="myModalLabel">Modal header</h3>-->
	<!--</div>-->
	<div class="modal-body">

		<div class="registerContainer">
			<div class="span6 registerForm">
				<form id="register">
					<fieldset>
						<legend>Sign up for BuynBrag</legend>
						<input type="text" placeholder="Your first name" ng-model="register.fname" required autofocus>
						<input type="text" placeholder="Your last name" ng-model="register.lname" required>
						<input type="email" placeholder="Your email address" ng-model="register.email" required>
						<input type="password" placeholder="New password" ng-model="register.pw1" required>
						<input type="password" placeholder="Confirm password" ng-model="register.pw2" required>
						<label class="inlineBlock">Male<input class="inlineBlock" name="genderSelect" type="radio" ng-model="register.gender" value="male" required></label>
						<label class="inlineBlock">Female<input class="inlineBlock" name="genderSelect" type="radio" ng-model="register.gender" value="female" required></label>

						<button class="btn btn-primary" type="submit" ng-click="registerUser()">Register</button>
					</fieldset>
				</form>
			</div>
		</div>

		<span class="formError" ng-show="formError">{{formError}}</span>

	</div>
	<!--<div class="modal-footer">-->
	<!--<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>-->
	<!--<button class="btn btn-primary">Save changes</button>-->
	<!--</div>-->
</div>

<!--================== Footer section ================================-->
<footer class="cssTransition hidden-phone">

    <div class="footerReveal">About Us</div>

    <a href="<?php echo $baseURL; ?>footer/about_us">About Us</a>
    <a href="<?php echo $baseURL; ?>footer/other_policy">Privacy</a>
    <a href="<?php echo $baseURL; ?>footer/shipping_delivery">Shipping and Returns</a>
    <a href="<?php echo $baseURL; ?>footer/how_it_works">For sellers</a>
    <a href="<?php echo $baseURL; ?>footer/contact">Help and Support</a>

</footer>

<!--==================================================-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo $baseURL; ?>dist/scripts/scripts.js"></script>

</body>
</html>