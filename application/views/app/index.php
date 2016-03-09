<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns:ng="http://angularjs.org" ng-app="bnbApp" ng-controller="AppController">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">

	<meta name="robots" content="index, follow">
	<!--    <meta name="fragment" content="!" />-->
	<base href="/application/views/app/">

	<title ng-bind="dynamicSeoContent.title || defaultSeoContent.title"></title>

	<meta name="description" content="{{dynamicSeoContent.description || defaultSeoContent.description}}">
	<meta name="keywords" content="buy, and, brag, buyandbrag, buynbrag, buy and brag,  social, shopping, outfits, trends, fashion, style, advice, tips, fashion">
	<meta name="author" content="BuynBrag">

	<meta property="og:site_name" content="BuynBrag.com">
	<meta property="og:type" content="{{dynamicSeoContent.ogType || defaultSeoContent.ogType}}">
	<meta property="og:title" content="{{dynamicSeoContent.title || defaultSeoContent.title}}">
	<meta property="og:description" content="{{dynamicSeoContent.description || defaultSeoContent.description}}">
	<meta property="og:image" content="{{dynamicSeoContent.image || defaultSeoContent.image}}" />
	<meta property="og:image:type" content="{{dynamicSeoContent.imageType || defaultSeoContent.imageType}}" />
	<meta property="og:image:width" content="{{dynamicSeoContent.imageWidth || defaultSeoContent.imageWidth}}" />
	<meta property="og:image:height" content="{{dynamicSeoContent.imageHeight || defaultSeoContent.imageHeight}}" />

	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:100' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400' rel='stylesheet' type='text/css'>

	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<!--<script src="//cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>-->
	<link rel="publisher" href="https://plus.google.com/+Buynbrag"/>

	<link href="/application/views/app/styles/vendor.css" rel="stylesheet">
	<link href="/application/views/app/styles/main.css" rel="stylesheet">
	<link rel="stylesheet" href="scripts/loading-bar.css">

	<!-- For iPad with high-resolution Retina display running iOS â‰¥ 7: -->
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="152x152" href="/apple-touch-icon-152x152-precomposed.png">
	<!-- For iPad with high-resolution Retina display running iOS â‰¤ 6: -->
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="144x144" href="/apple-touch-icon-144x144-precomposed.png">
	<!-- For iPhone with high-resolution Retina display running iOS â‰¥ 7: -->
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="120x120" href="/apple-touch-icon-120x120-precomposed.png">
	<!-- For iPhone with high-resolution Retina display running iOS â‰¤ 6: -->
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" type="image/png" href="/apple-touch-icon-precomposed.png">
	<!-- Fallback for all browsers -->
	<link rel="apple-touch-icon" type="image/png" href="/apple-touch-icon.png" />
	<link rel="icon" type="image/png" href="/apple-touch-icon.png" />

	<script type="text/javascript">

		(function(){
			//      test for touch events support and if not supported, attach .no-touch class to the HTML tag.
			if (!("ontouchstart" in document.documentElement)) {
				document.documentElement.className += " non-touch";
			}
			else {
				document.documentElement.className += " touch";
			}

			if(window.location.hash && window.location.hash === "#_=_") {
				window.location.hash = "";
			}

			// test for non IE and modern IE browsers
			if (navigator.appName == 'Microsoft Internet Explorer'){
				var userAgent = navigator.userAgent;
				var regEx  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
				if (regEx.exec(userAgent) != null){
					ieVersion = parseFloat( RegExp.$1 );
				}

				if ( ieVersion >= 9.0 ){
					document.documentElement.className += " modernIE";
				} else document.documentElement.className += " olderIE";
			} else document.documentElement.className += " nonIE";

		})();

	</script>

	<style type="text/css">
		#livechat-compact-container,
		#livechat-full {
			left: 10px;
			right: auto;
		}
	</style>


</head>

<body class="scrollingActive {{bodyClass}}" prefetch-templates>

<!-- <img src="/application/views/app/images/discover_BNB.svg" alt=""> -->

<!-- Load Facebook SDK -->
<div id="fb-root"></div>
<script>
	// window.fbAsyncInit = function() {
	//   // init the FB JS SDK
	//   FB.init({
	//     appId      : '394741787279624',                        // App ID from the app dashboard
	//     status     : true,                                 // Check Facebook Login status
	//     xfbml      : true                                  // Look for social plugins on the page
	//   });

	//   // Additional initialization code such as adding Event Listeners goes here
	// };

	// // Load the SDK asynchronously
	// (function(){
	//    // If we've already installed the SDK, we're done
	//    if (document.getElementById('facebook-jssdk')) {return;}

	//    // Get the first script element, which we'll use to find the parent node
	//    var firstScriptElement = document.getElementsByTagName('script')[0];

	//    // Create a new script element and set its id
	//    var facebookJS = document.createElement('script');
	//    facebookJS.id = 'facebook-jssdk';

	//    // Set the new script's source to the source of the Facebook JS SDK
	//    facebookJS.src = '//connect.facebook.net/en_US/all.js';

	//    // Insert the Facebook JS SDK into the DOM
	//    firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
	//  }());
</script>

<!-- LOGIN Modal -->
<div sign-in id="loginModal" url="/application/views/app/src/app/user/loginModal.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"></div>

<!--================== Site alert message ================================-->
<!--<div class="siteMsgContainer alert text-center hidden-iphone-landscape {{newClass}}" ng-controller="siteMsgController">-->
<!--<button class="close">&times;</button>-->
<!--<span ng-bind-html-unsafe="message"></span>-->
<!--</div>-->

<!--================== Header Section ================================-->
<header class="cssTransitionSlow">
	<div class="headerTop container-fluid">

		<nav class="navbar navbar-inverse">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<h1 class="logoHeading">
					<a class="logo pull-left hidden-phone" ng-href="{{relativeServerPath}}">
						<img src="/application/views/dist/images/404_logo_200.png" alt="BuynBrag"/>
					</a>
				</h1>

				<div class="signInAccountHolder pull-right" ng-hide='user.userid' >
					<a href="" ng-click="openModal('loginModal')" class="loginRequired" id="signInAccount" role="button" data-toggle="modal">Login</a>
					<a href="" ng-click="openModal('registerModal')" class="registerModal" id="createAccount" role="button" data-toggle="modal">Register</a>
				</div>

				<div class="signedInProfileHolder pull-right" ng-show="user.userid">
					<a href="//" class="dropdown-toggle" data-toggle="dropdown">
						<img class="userImage" ng-src="{{user.userdata.fbsrc}}" alt="" ng-cloak>
						<span class="userName hidden-phone hidden-tablet" ng-cloak>{{user.userdata.name}}</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu dark">
						<!-- <li><a href="#/inviteStatus">Brag bucks earned</a></li> -->
						<li><a ng-href="profile/social/{{user.userid}}">Profile</a></li>
						<li><a ng-href="profile/fancy/{{user.userid}}">Collections(<span class="bnbPink">{{user.userdata.collectionsCount}}</span>)<span class="dropDownBadge pull-right hidden-desktop">{{user.userdata.fancy}}</span></a></li>
						<li><a ng-href="profile/badges/{{user.userid}}">Badges unlocked(<span class="bnbPink">{{user.userdata.totalBadges}}</span>)<span class="dropDownBadge pull-right hidden-desktop">{{user.userdata.totalBadges}}</span></a></li>
						<li><a ng-href="" ng-click="openModal('couponsModal')" role="button" data-toggle="modal">Coupons available</a></li>
						<li><a target="_self" href="/user_info/purchase_history/">Purchase history</a></li>
						<li><a href="" ng-click="logout()">Log Out</a></li>
					</ul>
				</div>

				<ul class="notificationCounterContainer pull-right" ng-show="user.userid">
					<!--<li class="hidden-phone hidden-tablet">-->
					<!--<a href="/profile/badges/{{user.userid}}" class="userBadgesCount">-->
					<!--<span class="notificationBadge" ng-cloak>{{user.userdata.totalBadges}}</span>-->
					<!--<span class="tooltips top invisible">Total badges unlocked</span>-->
					<!--</a>-->
					<!--</li>-->
					<!--<li class="hidden-phone hidden-tablet">-->
					<!--<a href="/profile/fancy/{{user.userid}}" class="userFancyCount">-->
					<!--<span class="notificationBadge" ng-cloak>{{user.userdata.fancy}}</span>-->
					<!--<span class="tooltips top invisible">Fancied items</span>-->
					<!--</a>-->
					<!--</li>-->
					<!--<li class="hidden-phone">-->
					<!--<a href="" class="userRankCount">-->
					<!--<span class="notificationBadge" ng-cloak>{{user.userdata.rank}}</span>-->
					<!--<span class="tooltips top invisible">Your rank</span>-->
					<!--</a>-->
					<!--</li>-->
					<!--<li>-->
					<!--<a href="/cart/shopping_cart" class="userCartCount">-->
					<!--<span class="notificationBadge" ng-cloak>{{user.userdata.cartcount}}</span>-->
					<!--<span class="tooltips top invisible">Your cart</span>-->
					<!--</a>-->
					<!--</li>-->

					<li>
						<!--Link for mobiles-->
						<a target="_self" href="/cart/shopping_cart" class="userCartCount visible-phone">
							<span class="notificationBadge" ng-cloak>{{user.userdata.cartcount}}</span>
						</a>
						<!--Link for tablets and desktops-->
						<a href="" class="userCartCount cssTransition dropdown-toggle hidden-phone" ng-click="openModal('checkoutModal', {dummy: 'dummy'})">
							<span class="notificationBadge" ng-cloak>{{user.userdata.cartcount}}</span>
						</a>
						<!-- <ul class="cartPreviewContainer dropdown-menu dark hidden-phone">

							<li class="cartItemDetails" ng-repeat="item in user.userdata.cart">
								<a ng-href="product/{{item.productName | beautify}}/{{item.productID}}">
									<img ng-src="{{s3baseUrl}}{{item.storeID}}/{{item.productID}}/img1_40x40.jpg" alt="item">
									<span class="itemPreviewDescriptionContainer">
										<span class="itemName">{{item.productName}}</span>
										<span class="itemTotalContainer">X {{item.quantity}}
											<span class="itemPriceHolder">Amount   :<span class="itemPrice">{{item.totalPayable}}</span></span>
										</span>
									</span>
								</a>
							</li>

							<li class="checkOutCart">
								<a id="checkoutCartBtn" class="btn btn-lightBlue inlineBlock" target="_self" href="/cart/shopping_cart">Checkout Cart</a>
								<span class="cartTotalDetailsContainer">
									<span class="cartTotalContainer">Total Quantity :
										<span class="cartTotalItemQuantity">{{user.userdata.cartTotalItemQuantity}}</span>
										<span class="cartTotalPriceHolder">Total :<span class="cartTotalPrice">{{user.userdata.cartAmount}}</span></span>
									</span>
								</span>
							</li>

						</ul> -->
					</li>

				</ul>

				<div typeahead min-chars="2" class="searchBoxContainer pull-right relative">

					<div class="searchBox">
						<input ng-model="searchKey" class="searchInput cssTransition" type="text" placeholder="Search..." autocomplete="off" spellcheck="false"/>
						<button class="btn btn-flat hide closeSearch">Cancel</button>
					</div>

					<i class="searchIcon icon-search block"></i>

				</div>

				<div class="nav-collapse">

					<ul class="nav">
						<li class="visible-phone"><a ng-href="{{relativeServerPath}}">Home</a></li>
						<li class="relative">
							<a id="bootStrapDropDownFix" href="//" class="dropdown-toggle" data-toggle="dropdown">Categories
								<span class="caret"></span>
							</a>

							<ul class="dropdown-menu dark visible-iphone-landscape" style="height: 0; overflow: hidden;">
								<li ng-repeat="cat in categories.children"><a ng-href="{{cat.data.relativeUrl}}{{cat.data.catID}}">{{cat.data.title}} (<span class="bnbPink">{{cat.data.totalProducts}}</span>)</a></li>
							</ul>

							<!-- <ul class="dropdown-menu dark">
								<li ng-repeat="category in categories"><a ng-href="#/categories/{{category.catName | beautify}}/{{category.catID}}">{{category.catName}}</a></li>
							</ul> -->
							<navigationtree cats="categories"></navigationtree>

						</li>
						<li><a href='allStores'>Stores</a></li>

						<li class="relative trendsDropdown">
							<a href="//" class="dropdown-toggle" data-toggle="dropdown">Trends
								<span class="caret"></span>
							</a>

							<ul class="dropdown-menu dark">
								<li ng-repeat="city in cities"><a ng-href="trends/{{city.urlParam | beautify}}">{{city.urlParam}}</a></li>
							</ul>
						</li>

						<li class="relative"><a href="users" title="">People</a></li>

						<li class="relative"><a href="dealofday" title="" ng-bind="deal.dealName"></a></li>

						<li class="relative"><a href="http://blog.buynbrag.com" target="_blank" title="">Blog</a></li>

						<!--Tour activation link-->
						<!--<li class="visible-desktop">-->
						<!--<a href="#homePageTourModal" id="startTour" class="hidden-phone" role="button" data-toggle="modal">Tour</a>-->
						<!--</li>-->

					</ul>

					<!--<a href="#/inviteFriends" class="inviteLink pull-right">Invite Friends</a>-->
					<!--<a href="#inviteFriendsModal" class="pull-right" role="button" data-toggle="modal">Invite Friends</a>-->

					<!--<a class="bragBucks hidden-phone bold pull-right" href="/#inviteStatus">{{user.userdata.bragBucks | currency}}</a>-->

					<!--<a href="#homePageTourModal" id="startTour" class="btn btn-red btn-small pull-right visible-desktop" role="button" data-toggle="modal">Tour</a>-->

					<!--<a href="#badgesModal" class="pull-right" role="button" data-toggle="modal">Badges toggle</a>-->

				</div>

				<!--<my-autocomplete min-chars="3">-->
				<!--</my-autocomplete>-->

			</div>
		</nav>
	</div>
</header>

<!--================== Mid Section ================================-->

<div ng-switch="subview">
	<!-- Home Content -->
	<div ng-switch-when="home">
		<div ng-include="defaultView">

		</div>
	</div>

	<!-- Invite Content -->
	<div ng-switch-when="inviteFriends">
		<div ng-include=" '/application/views/app/src/app/pages/inviteFriends.html' ">

		</div>
	</div>

	<!-- Login Content -->
	<div ng-switch-when="login">
		<div ng-include=" '/application/views/app/src/app/user/loginPage.html' ">

		</div>
	</div>

	<!-- Register Content -->
	<div ng-switch-when="register">
		<div ng-include=" '/application/views/app/src/app/user/registerPage.html' ">

		</div>
	</div>

	<!-- Reset password page Content -->
	<div ng-switch-when="reset">
		<div ng-include=" '/application/views/app/src/app/user/reset.html' ">

		</div>
	</div>

	<!-- Forgot password page Content -->
	<div ng-switch-when="forgot">
		<div ng-include=" '/application/views/app/src/app/user/forgot.html' ">

		</div>
	</div>

	<!-- All Stores Content -->
	<div ng-switch-when="allStores">
		<div ng-include=" '/application/views/app/src/app/pages/allStores/allStores.html' ">

		</div>
	</div>

	<!-- Deal of day Content -->
	<div ng-switch-when="dealofday">
		<div ng-include=" '/application/views/app/src/app/pages/dealOfTheDay/dod.html' ">

		</div>
	</div>

	<!-- All Stores Content -->
	<div ng-switch-when="users">
		<div ng-include=" '/application/views/app/src/app/pages/people/people.html' ">

		</div>
	</div>

	<!-- All Stores Content -->
	<div ng-switch-when="cart">
		<div ng-include=" '/application/views/app/src/app/pages/cart/checkoutCart.html' ">

		</div>
	</div>

	<!-- All Stores Content -->
	<div ng-switch-when="checkout">
		<div ng-include=" '/application/views/app/src/app/pages/cart/checkout2.html' ">

		</div>
	</div>

	<!-- Store Page Content -->
	<div ng-switch-when="store">
		<div ng-include=" '/application/views/app/src/app/pages/store/store.html' ">

		</div>
	</div>

	<!-- Duplicate Store Page Content -->
	<div ng-switch-when="storeDisabled">
		<div ng-include=" '/application/views/app/src/app/pages/storeDisabled/storeDisabled.html' ">

		</div>
	</div>

	<!-- Product Page Content -->
	<div ng-switch-when="product">
		<div ng-include=" '/application/views/app/src/app/pages/product/product.html' ">

		</div>
	</div>

	<!-- Categories Page Content -->
	<div ng-switch-when="categories">
		<div ng-include=" '/application/views/app/src/app/pages/category/categories.html' ">

		</div>
	</div>

	<!-- Invite and BragBucks status Content -->
	<div ng-switch-when="inviteStatus">
		<div ng-include=" '/application/views/app/src/app/pages/inviteStatus.html' ">

		</div>
	</div>

	<!-- 404 Error Page Content -->
	<div ng-switch-when="404">
		<div ng-include=" '/application/views/app/src/app/pages/404.html' ">

		</div>
	</div>

	<!-- For sellers Page Content -->
	<div ng-switch-when="forSellers">
		<div ng-include=" '/application/views/app/src/app/pages/aboutUs/forSellers.html' ">

		</div>
	</div>

	<!-- Contact Us Page Content -->
	<div ng-switch-when="contact">
		<div ng-include=" '/application/views/app/src/app/pages/aboutUs/contact.html' ">

		</div>
	</div>

	<!-- About Us Page Content -->
	<div ng-switch-when="aboutUs">
		<div ng-include=" '/application/views/app/src/app/pages/aboutUs/aboutUs.html' ">

		</div>
	</div>

	<!-- Policies Page Content -->
	<div ng-switch-when="policies">
		<div ng-include=" '/application/views/app/src/app/pages/aboutUs/policies.html' ">

		</div>
	</div>

	<!-- Trends Page Content -->
	<div ng-switch-when="trends">
		<div ng-include=" '/application/views/app/src/app/pages/trends/trends.html' ">

		</div>
	</div>

	<!-- Search page Content -->
	<div ng-switch-when="search">
		<div ng-include=" '/application/views/app/src/app/pages/search/search.html' ">

		</div>
	</div>

	<!-- Profile page Content -->
	<div ng-switch-when="profileHeader">
		<div ng-include=" '/application/views/app/src/app/pages/profile/profileHeader/profileHeader.html' ">

		</div>
	</div>

</div>

<!----------------- MODALS  ------------------>

<!-- REGISTER Modal -->
<div sign-up id="registerModal" url="/application/views/app/src/app/user/registerModal.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<!-- POST REGISTER PROFILE INFORMATION MODAL-->
<!-- <div id="profileFillModal" url="/application/views/app/src/app/user/profileFillModal.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="ProfileFillController"></div> -->

<!-- Forgot Password Modal -->
<div id="forgetPassModal" url="/application/views/app/src/app/user/forgotModal.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<!-- Person Modal -->
<!-- <div class="profilePage">

    <div id="personModal" url="/application/views/app/src/app/exhaustiveFeatures/independentModals/userInfo/userInfo.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" user-info>
    </div>

</div> -->

<!-- Checkout Modal -->
<div id="checkoutModal" dynamic-modal url="/application/views/app/src/app/exhaustiveFeatures/callToActions/cart/cartModal.html" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<!-- QUICK VIEW Modal -->
<!-- <div id="quickViewModal" url="/application/views/app/src/app/exhaustiveFeatures/independentModals/quickView/quickView.html" dynamic-modal class="container modal fade hide" tabindex="-1" role="dialog" aria-labelledby="userProfileModal" aria-hidden="true" ng-controller="QuickViewController"></div> -->

<!--BADGES Modal-->
<div id="badgesModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="BadgesController" ng-cloak>
	<p class="badgeImgContainer relative">
		<a type="button" href="/profile/badges/{{user.userid}}" data-dismiss="modal" aria-hidden="true">
			<img src="/application/views/dist/images/sprites/badges_background.png" alt="badge">
			<img class="badgeImg" ng-src="{{badge.badgeSrc}}" ng-click="prepareForNext()" alt="badge">
		</a>
	</p>
	<p class="checkBadgesMsg">Check out the other badges you have earned <a type="button" href="/profile/badges/{{user.userid}}" data-dismiss="modal" aria-hidden="true">here</a></p>
	<!--<div style="color: #fff; text-transform: uppercase; font-size: 16px">$$500 Earned!</div>-->
</div>

<!-- USER COUPONS Modal -->
<div id="couponsModal" url="/application/views/app/src/app/exhaustiveFeatures/independentModals/coupons/coupons.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<!-- TAKE THE TOUR Modal -->
<!--<div id="tourModal" class="modal hide" tabindex="-1" role="dialog" aria-hidden="true">-->
<!--</div>-->

<!-- NEW VISITOR Modal -->
<!--<div id="newVisitorModal" visitor-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<!--<img check-load="displayPopup()" ng-src="{{imgSrc}}" alt="Landing png"/>-->
<!--&lt;!&ndash;<img src="images/landing1.png" alt="Landing png"/>&ndash;&gt;-->
<!--<div class="signedUpUserContainer">-->
<!--Already have an account?-->
<!--<a href="#loginModal" class="bnbRedFont oldVisitorSignIn" role="button" data-toggle="modal" data-dismiss="modal" aria-hidden="true">Click here to sign in</a>-->
<!--<a class="skipVisitorModal pull-right" type="button" data-dismiss="modal" aria-hidden="true">Skip >></a>-->
<!--</div>-->
<!--<a href="#registerModal" class="btn btn-blue newVisitorSignUp" role="button" data-toggle="modal" data-dismiss="modal" aria-hidden="true">Sign up & Discover</a>-->
<!--</div>-->

<!-- FACEBOOK SIGNUP Modal -->
<!--<div id="fbSignUpModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
<!--<div class="span5">-->
<!--<p>Please login via Facebook to Brag products.</p>-->
<!--<a href="/fbLogin/index">-->
<!--<img src="/application/views/dist/images/sprites/fbLogin.png" alt="FB login image">-->
<!--</a>-->
<!--</div>-->
<!--</div>-->

<!-- Fancy List Modal -->
<div id="fancyListModal" url="/application/views/app/src/app/exhaustiveFeatures/callToActions/brag/bragList.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<!-- Tag User modal -->
<div id="tagFriendModal" url="/application/views/app/src/app/exhaustiveFeatures/callToActions/tag/tagUser.html" dynamic-modal class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"></div>

<!-- Fancied By modal -->
<div id="prodBraggedUserModal" userswhobragged url="/application/views/app/src/app/exhaustiveFeatures/independentModals/fanciedBy/usersList.html" dynamic-modal  class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"></div>

<!-- FACEBOOK SIGNUP Modal -->
<div id="postRegistrationModal" class="modal ng-hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-show="showRegistrationModal" registration-flow>
	<div ng-switch="subview">
		<div ng-switch-when="stores">
			<div ng-include=" '/application/views/app/src/app/user/regFollowStores.html' "></div>
		</div>

		<div ng-switch-when="category">
			<div ng-include=" '/application/views/app/src/app/user/regSelectCat.html' "></div>
		</div>

		<div ng-switch-when="people">
			<div ng-include=" '/application/views/app/src/app/user/regFollowPeople.html' "></div>
		</div>

		<div ng-switch-when="products">
			<div ng-include=" '/application/views/app/src/app/user/regBragProducts.html' "></div>
		</div>
	</div>
</div>

<!-- USER FRIENDS Modal -->
<!--<div id="friendsModal" class="modal hide" ng-show="showFriends" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="FriendsController">-->
<!--</div>-->

<!-- INVITE FRIENDS Modal -->
<!--<div id="inviteFriendsModal" class="modal hide" ng-show="showInviteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="InviteController">-->

<!-- Scroll to top button -->
<div id="backtotop" class="hide hidden-phone">&#8679;</div>

<!--================== Footer section ================================-->
<footer class="cssTransition hidden-phone">

	<div class="footerReveal">About us</div>

	<a href="/aboutUs">About us</a>
	<!--<a href="#/policies">Privacy</a>-->
	<a href="/policies">Shipping and returns</a>
	<a href="/forSellers">For sellers</a>
	<a href="/contact">Contact us</a>

	<!-- AddThis Follow BEGIN -->
	<!--<div class="addThisFollowBtnContainer inlineBlock">Follow us on-->
	<!--<a class="addthis_button_facebook_follow" addthis:userid="BuynBrag">-->
	<!--<img src="https://ct1.addthis.com/static/r07/images000/follow/svg/facebook.svg" width="28" height="28" border="0" alt="Share" />-->
	<!--</a>-->
	<!--<a class="addthis_button_twitter_follow" addthis:userid="BuynBrag">-->
	<!--<img src="https://ct1.addthis.com/static/r07/images000/follow/svg/twitter.svg" width="28" height="28" border="0" alt="Share" />-->
	<!--</a>-->
	<!--</div>-->
	<!-- AddThis Follow END -->

</footer>

<!-- build:js scripts/analyticsTracking.js -->
<script src="scripts/analyticsTracking.js"></script>
<!-- endbuild -->

<!--Use of CDN's for faster loading-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-cookies.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-route.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-touch.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-sanitize.min.js"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular-resource.min.js"></script> -->

<!-- build:js scripts/vendor.js -->
<script src="scripts/vendor/bootstrap/bootstrap-collapse.js"></script>
<script src="scripts/vendor/bootstrap/bootstrap-tab.js"></script>
<script src="scripts/vendor/bootstrap/bootstrap-modal.js"></script>
<script src="scripts/vendor/bootstrap/bootstrap-dropdown.js"></script>
<script src="scripts/vendor/angular/angulartics.min.js"></script>
<script src="scripts/vendor/angular/angulartics-ga.min.js"></script>
<script src="scripts/vendor/jquery.easy-pie-chart.js"></script>

<script src="scripts/loading-bar.min.js"></script>
<!-- endbuild -->

<!-- build:js scripts/bnb.js -->
<script src="src/app/shared/unAngular/customJS.js"></script>

<script src="src/app/shared/filters/beautify.js"></script>
<script src="src/app/shared/filters/compress.js"></script>

<script src="src/app/shared/services/api.js"></script>
<script src="src/app/shared/services/user.js"></script>
<script src="src/app/shared/services/seo.js"></script>
<script src="src/app/shared/services/hoverTimestamp.js"></script>
<script src="src/app/shared/services/eventThrottler.js"></script>
<script src="src/app/shared/services/facebookService.js"></script>

<!-- <script src="src/app/shared/directives/dmClick.js"></script> -->
<script src="src/app/shared/directives/stabiliseHover.js"></script>
<script src="src/app/shared/directives/shareBtn.js"></script>
<script src="src/app/shared/directives/clearImage.js"></script>
<script src="src/app/shared/directives/checkLoad.js"></script>
<script src="src/app/shared/directives/scrollTo.js"></script>
<script src="src/app/shared/directives/dynamicModals.js"></script>
<script src="src/app/shared/directives/imageZoom.js"></script>
<script src="src/app/shared/directives/loadingSpinner.js"></script>
<script src="src/app/shared/directives/masonryLayout.js"></script>
<script src="src/app/shared/directives/sexyOverlay.js"></script>

<script src="src/app/exhaustiveFeatures/callToActions/brag/bragBtn.js"></script>
<script src="src/app/exhaustiveFeatures/callToActions/tag/tagBtn.js"></script>
<script src="src/app/exhaustiveFeatures/callToActions/follow/followBtn.js"></script>
<script src="src/app/exhaustiveFeatures/callToActions/cart/cartBtn.js"></script>
<script src="src/app/exhaustiveFeatures/callToActions/cart/cartService.js"></script>

<script src="src/app/exhaustiveFeatures/independentModals/coupons/coupons.js"></script>
<script src="src/app/exhaustiveFeatures/independentModals/fanciedBy/usersList.js"></script>
<script src="src/app/exhaustiveFeatures/independentModals/userInfo/userInfo.js"></script>

<script src="src/app/exhaustiveFeatures/realtime/badges/badges.js"></script>

<script src="src/app/exhaustiveFeatures/prefetcher/gallery.js"></script>
<script src="src/app/exhaustiveFeatures/prefetcher/prefetchTemplates.js"></script>
<script src="src/app/exhaustiveFeatures/siteMessage/siteMsg.js"></script>

<script src="src/app/pages/home/homePage.js"></script>
<script src="src/app/pages/allStores/allStoresPage.js"></script>
<script src="src/app/pages/trends/trendsPage.js"></script>
<script src="src/app/pages/people/peoplePage.js"></script>
<script src="src/app/pages/dealOfTheDay/dod.js"></script>
<script src="src/app/pages/profile/profilePage.js"></script>
<script src="src/app/pages/profile/about/about.js"></script>
<script src="src/app/pages/profile/badges/badges.js"></script>
<script src="src/app/pages/profile/fancyList/fancyList.js"></script>
<script src="src/app/pages/profile/allBrags/allBrags.js"></script>
<script src="src/app/pages/profile/mutualProducts/mutualProducts.js"></script>
<script src="src/app/pages/profile/fancyListView/fancyListView.js"></script>
<script src="src/app/pages/profile/profileHeader/profileHeader.js"></script>
<script src="src/app/pages/profile/settings/settings.js"></script>
<script src="src/app/pages/profile/social/social.js"></script>
<script src="src/app/pages/profile/editFancyListModal.js"></script>
<script src="src/app/pages/category/categoryPage.js"></script>
<script src="src/app/pages/store/storePage.js"></script>
<script src="src/app/pages/cart/cartPage.js"></script>
<script src="src/app/pages/cart/checkoutPage.js"></script>
<script src="src/app/pages/search/searchPage.js"></script>
<script src="src/app/pages/product/productPage.js"></script>
<script src="src/app/pages/blocked/blocked.js"></script>

<script src="src/app/social/inviteFacebookFriends.js"></script>
<!-- <script src="src/app/social/addThisShare.js"></script> -->
<!-- <script src="src/app/social/inviteFriends.js"></script> -->
<script src="src/app/social/loadSdks.js"></script>
<!-- <script src="src/app/social/facepile.js"></script> -->

<script src="src/app/user/signIn.js"></script>
<script src="src/app/user/signUp.js"></script>
<script src="src/app/user/auth.js"></script>
<script src="src/app/user/registrationFlow.js"></script>
<script src="src/app/user/regSelectCat.js"></script>
<script src="src/app/user/regBragProducts.js"></script>
<script src="src/app/user/regFollowPeople.js"></script>
<script src="src/app/user/changePassword.js"></script>

<script src="src/app/router/renderRequest.js"></script>
<script src="src/app/router/routesConfig.js"></script>
<script src="src/app/router/router.js"></script>

<script src="src/app/app.js"></script>
<!-- endbuild -->
<!--<script src="/application/views/dist/scripts/scripts.js"></script>-->

<!-- ADD THIS -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-538f009568e92dfd"></script>
	<script type="text/javascript">
	var addthis_config = {
		// data_track_addressbar:false,
		data_track_clickback : true,
		data_ga_tracker : 'UA-35785264-1',
		data_ga_social : true,
		// services_expanded : 'facebook,twitter,linkedin,google_plusone_share,pinterest,email',
		services_compact : '',
		// services_exclude : 'thefancy,print,yahoomail',
		ui_click : true,
	    ui_header_background : "#000",
	    ui_show_promo: false,
	    ui_use_css : true,
		ui_use_addressbook : true
	};
	</script>

<script type="text/javascript">
	var __lc = {};
	__lc.license = 3667741;

	(function() {
		var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
		lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
	})();
</script>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-35785264-1', 'buynbrag.com');

</script>

</body>
</html>