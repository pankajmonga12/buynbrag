<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/html" xmlns:ng="http://angularjs.org" ng-app="bnbApp" ng-controller="AppController"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta charset="utf-8"><meta name="robots" content="index, follow"><base href="/"><title ng-bind="dynamicSeoContent.title || defaultSeoContent.title"></title><meta name="description" content="{{dynamicSeoContent.description || defaultSeoContent.description}}"><meta name="keywords" content="buy, and, brag, buyandbrag, buynbrag, buy and brag,  social, shopping, outfits, trends, fashion, style, advice, tips, fashion"><meta name="author" content="BuynBrag"><meta property="og:site_name" content="BuynBrag.com"><meta property="og:type" content="{{dynamicSeoContent.ogType || defaultSeoContent.ogType}}"><meta property="og:title" content="{{dynamicSeoContent.title || defaultSeoContent.title}}"><meta property="og:description" content="{{dynamicSeoContent.description || defaultSeoContent.description}}"><meta property="og:image" content="{{dynamicSeoContent.image || defaultSeoContent.image}}"><meta property="og:image:type" content="{{dynamicSeoContent.imageType || defaultSeoContent.imageType}}"><meta property="og:image:width" content="{{dynamicSeoContent.imageWidth || defaultSeoContent.imageWidth}}"><meta property="og:image:height" content="{{dynamicSeoContent.imageHeight || defaultSeoContent.imageHeight}}"><link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100" rel="stylesheet" type="text/css"><link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400" rel="stylesheet" type="text/css"><meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1"><meta name="apple-mobile-web-app-capable" content="yes"><link rel="publisher" href="https://plus.google.com/+Buynbrag"><link href="/application/views/dist/styles/vendor.css" rel="stylesheet"><link href="/application/views/dist/styles/c2582361.main.css" rel="stylesheet"><link rel="stylesheet" href="scripts/loading-bar.css"><link rel="apple-touch-icon-precomposed" type="image/png" sizes="152x152" href="/apple-touch-icon-152x152-precomposed.png"><link rel="apple-touch-icon-precomposed" type="image/png" sizes="144x144" href="/apple-touch-icon-144x144-precomposed.png"><link rel="apple-touch-icon-precomposed" type="image/png" sizes="120x120" href="/apple-touch-icon-120x120-precomposed.png"><link rel="apple-touch-icon-precomposed" type="image/png" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png"><link rel="apple-touch-icon-precomposed" type="image/png" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png"><link rel="apple-touch-icon-precomposed" type="image/png" href="/apple-touch-icon-precomposed.png"><link rel="apple-touch-icon" type="image/png" href="/apple-touch-icon.png"><link rel="icon" type="image/png" href="/apple-touch-icon.png"><script type="text/javascript">(function(){
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

		})();</script><style type="text/css">#livechat-compact-container,
		#livechat-full {
			left: 10px;
			right: auto;
		}</style></head><body class="scrollingActive {{bodyClass}}" prefetch-templates=""><div id="fb-root"></div><script>// window.fbAsyncInit = function() {
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
	//  }());</script><div sign-in="" id="loginModal" url="/application/views/dist/src/app/user/loginModal.html" dynamic-modal="" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"></div><header class="cssTransitionSlow"><div class="headerTop container-fluid"><nav class="navbar navbar-inverse"><div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></a><h1 class="logoHeading"><a class="logo pull-left hidden-phone" ng-href="{{relativeServerPath}}"><img src="/application/views/dist/images/404_logo_200.png" alt="BuynBrag"></a></h1><div class="signInAccountHolder pull-right" ng-hide="user.userid"><a href="" ng-click="openModal('loginModal')" class="loginRequired" id="signInAccount" role="button" data-toggle="modal">Login</a> <a href="" ng-click="openModal('registerModal')" class="registerModal" id="createAccount" role="button" data-toggle="modal">Register</a></div><div class="signedInProfileHolder pull-right" ng-show="user.userid"><a href="//.DS_Store" class="dropdown-toggle" data-toggle="dropdown"><img class="userImage" ng-src="{{user.userdata.fbsrc}}" alt="" ng-cloak=""> <span class="userName hidden-phone hidden-tablet" ng-cloak="">{{user.userdata.name}}</span> <span class="caret"></span></a><ul class="dropdown-menu dark"><li><a ng-href="profile/social/{{user.userid}}">Profile</a></li><li><a ng-href="profile/fancy/{{user.userid}}">Collections(<span class="bnbPink">{{user.userdata.collectionsCount}}</span>)<span class="dropDownBadge pull-right hidden-desktop">{{user.userdata.fancy}}</span></a></li><li><a ng-href="profile/badges/{{user.userid}}">Badges unlocked(<span class="bnbPink">{{user.userdata.totalBadges}}</span>)<span class="dropDownBadge pull-right hidden-desktop">{{user.userdata.totalBadges}}</span></a></li><li><a ng-href="" ng-click="openModal('couponsModal')" role="button" data-toggle="modal">Coupons available</a></li><li><a target="_self" href="/user_info/purchase_history/">Purchase history</a></li><li><a href="" ng-click="logout()">Log Out</a></li></ul></div><ul class="notificationCounterContainer pull-right" ng-show="user.userid"><li><a target="_self" href="/cart/shopping_cart" class="userCartCount visible-phone"><span class="notificationBadge" ng-cloak="">{{user.userdata.cartcount}}</span></a>  <a href="" class="userCartCount cssTransition dropdown-toggle hidden-phone" ng-click="openModal('checkoutModal', {dummy: 'dummy'})"><span class="notificationBadge" ng-cloak="">{{user.userdata.cartcount}}</span></a> </li></ul><div typeahead="" min-chars="2" class="searchBoxContainer pull-right relative"><div class="searchBox"><input ng-model="searchKey" class="searchInput cssTransition" type="text" placeholder="Search..." autocomplete="off" spellcheck="false"><button class="btn btn-flat hide closeSearch">Cancel</button></div><i class="searchIcon icon-search block"></i></div><div class="nav-collapse"><ul class="nav"><li class="visible-phone"><a ng-href="{{relativeServerPath}}">Home</a></li><li class="relative"><a id="bootStrapDropDownFix" href="//.DS_Store" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a><ul class="dropdown-menu dark visible-iphone-landscape" style="height: 0; overflow: hidden"><li ng-repeat="cat in categories.children"><a ng-href="{{cat.data.relativeUrl}}{{cat.data.catID}}">{{cat.data.title}} (<span class="bnbPink">{{cat.data.totalProducts}}</span>)</a></li></ul><navigationtree cats="categories"></navigationtree></li><li><a href="allStores">Stores</a></li><li class="relative trendsDropdown"><a href="//.DS_Store" class="dropdown-toggle" data-toggle="dropdown">Trends <span class="caret"></span></a><ul class="dropdown-menu dark"><li ng-repeat="city in cities"><a ng-href="trends/{{city.urlParam | beautify}}">{{city.urlParam}}</a></li></ul></li><li class="relative"><a href="users" title="">People</a></li><li class="relative"><a href="dealofday" title="" ng-bind="deal.dealName"></a></li><li class="relative"><a href="http://blog.buynbrag.com" target="_blank" title="">Blog</a></li></ul></div></div></nav></div></header><div ng-switch="subview"><div ng-switch-when="home"><div ng-include="defaultView"></div></div><div ng-switch-when="inviteFriends"><div ng-include=" '/application/views/dist/src/app/pages/inviteFriends.html' "></div></div><div ng-switch-when="login"><div ng-include=" '/application/views/dist/src/app/user/loginPage.html' "></div></div><div ng-switch-when="register"><div ng-include=" '/application/views/dist/src/app/user/registerPage.html' "></div></div><div ng-switch-when="reset"><div ng-include=" '/application/views/dist/src/app/user/reset.html' "></div></div><div ng-switch-when="forgot"><div ng-include=" '/application/views/dist/src/app/user/forgot.html' "></div></div><div ng-switch-when="allStores"><div ng-include=" '/application/views/dist/src/app/pages/allStores/allStores.html' "></div></div><div ng-switch-when="dealofday"><div ng-include=" '/application/views/dist/src/app/pages/dealOfTheDay/dod.html' "></div></div><div ng-switch-when="users"><div ng-include=" '/application/views/dist/src/app/pages/people/people.html' "></div></div><div ng-switch-when="cart"><div ng-include=" '/application/views/dist/src/app/pages/cart/checkoutCart.html' "></div></div><div ng-switch-when="checkout"><div ng-include=" '/application/views/dist/src/app/pages/cart/checkout2.html' "></div></div><div ng-switch-when="store"><div ng-include=" '/application/views/dist/src/app/pages/store/store.html' "></div></div><div ng-switch-when="storeDisabled"><div ng-include=" '/application/views/dist/src/app/pages/storeDisabled/storeDisabled.html' "></div></div><div ng-switch-when="product"><div ng-include=" '/application/views/dist/src/app/pages/product/product.html' "></div></div><div ng-switch-when="categories"><div ng-include=" '/application/views/dist/src/app/pages/category/categories.html' "></div></div><div ng-switch-when="inviteStatus"><div ng-include=" '/application/views/dist/src/app/pages/inviteStatus.html' "></div></div><div ng-switch-when="404"><div ng-include=" '/application/views/dist/src/app/pages/404.html' "></div></div><div ng-switch-when="forSellers"><div ng-include=" '/application/views/dist/src/app/pages/aboutUs/forSellers.html' "></div></div><div ng-switch-when="contact"><div ng-include=" '/application/views/dist/src/app/pages/aboutUs/contact.html' "></div></div><div ng-switch-when="aboutUs"><div ng-include=" '/application/views/dist/src/app/pages/aboutUs/aboutUs.html' "></div></div><div ng-switch-when="policies"><div ng-include=" '/application/views/dist/src/app/pages/aboutUs/policies.html' "></div></div><div ng-switch-when="trends"><div ng-include=" '/application/views/dist/src/app/pages/trends/trends.html' "></div></div><div ng-switch-when="search"><div ng-include=" '/application/views/dist/src/app/pages/search/search.html' "></div></div><div ng-switch-when="profileHeader"><div ng-include=" '/application/views/dist/src/app/pages/profile/profileHeader/profileHeader.html' "></div></div></div><div sign-up="" id="registerModal" url="/application/views/dist/src/app/user/registerModal.html" dynamic-modal="" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div><div id="forgetPassModal" url="/application/views/dist/src/app/user/forgotModal.html" dynamic-modal="" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div><div id="checkoutModal" dynamic-modal="" url="/application/views/dist/src/app/exhaustiveFeatures/callToActions/cart/cartModal.html" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div><div id="badgesModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="BadgesController" ng-cloak=""><p class="badgeImgContainer relative"><a type="button" href="/profile/badges/{{user.userid}}" data-dismiss="modal" aria-hidden="true"><img src="/application/views/dist/images/sprites/badges_background.png" alt="badge"> <img class="badgeImg" ng-src="{{badge.badgeSrc}}" ng-click="prepareForNext()" alt="badge"></a></p><p class="checkBadgesMsg">Check out the other badges you have earned <a type="button" href="/profile/badges/{{user.userid}}" data-dismiss="modal" aria-hidden="true">here</a></p></div><div id="couponsModal" url="/application/views/dist/src/app/exhaustiveFeatures/independentModals/coupons/coupons.html" dynamic-modal="" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div><div id="fancyListModal" url="/application/views/dist/src/app/exhaustiveFeatures/callToActions/brag/bragList.html" dynamic-modal="" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div><div id="tagFriendModal" url="/application/views/dist/src/app/exhaustiveFeatures/callToActions/tag/tagUser.html" dynamic-modal="" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"></div><div id="prodBraggedUserModal" userswhobragged="" url="/application/views/dist/src/app/exhaustiveFeatures/independentModals/fanciedBy/usersList.html" dynamic-modal="" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"></div><div id="postRegistrationModal" class="modal ng-hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-show="showRegistrationModal" registration-flow=""><div ng-switch="subview"><div ng-switch-when="stores"><div ng-include=" '/application/views/dist/src/app/user/regFollowStores.html' "></div></div><div ng-switch-when="category"><div ng-include=" '/application/views/dist/src/app/user/regSelectCat.html' "></div></div><div ng-switch-when="people"><div ng-include=" '/application/views/dist/src/app/user/regFollowPeople.html' "></div></div><div ng-switch-when="products"><div ng-include=" '/application/views/dist/src/app/user/regBragProducts.html' "></div></div></div></div><div id="backtotop" class="hide hidden-phone">&#8679;</div><footer class="cssTransition hidden-phone"><div class="footerReveal">About us</div><a href="/aboutUs">About us</a>  <a href="/policies">Shipping and returns</a> <a href="/forSellers">For sellers</a> <a href="/contact">Contact us</a>          </footer><script src="/application/views/dist/scripts/4a742a9f.analyticsTracking.js"></script><script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-cookies.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-route.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-touch.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-sanitize.min.js"></script><script src="/application/views/dist/scripts/vendor.js"></script><script src="/application/views/dist/scripts/e6dd7716.bnb.js"></script><script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-538f009568e92dfd"></script><script type="text/javascript">var addthis_config = {
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
	};</script>

	<script type="text/javascript">
	var __lc = {};
	__lc.license = 3667741;

	(function() {
		var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
		lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
	})();
	</script>

	<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-35785264-1', 'buynbrag.com');
	</script>

</body></html>