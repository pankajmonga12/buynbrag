<?php if(! defined ('BASEPATH') ) exit('Direct script access not allowed'); ?>
<!doctype html>
<!-- Microdata markup added by Google Structured Data Markup Helper. -->
<head>

<meta http-equiv="Content-Type" content="text/html">
<meta name="revisit-after" content="7 days">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?php echo $base_url; ?>favicon.ico" rel="shortcut icon" type="image/ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>application/views/dist/styles/vendor.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>application/views/app/styles/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/badge_popup.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/friends_follower.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/fonts.css" />

<script src="/application/views/app/scripts/analyticsTracking.js"></script>

<script src="/application/views/app/src/app/shared/unAngular/customJS.js"></script>

<script type="text/javascript">
//<![CDATA[
	/* IMPORTANT:: NEVER DELETE */
	var baseUrl = <?php echo '"'.base_url().'"'; ?>;
	var storeUrl = <?php echo '"'.$store_url.'"'; ?>;
	var isLoggedIN = <?php echo ($isLoggedIN['status'] === TRUE)? 'true': 'false'; ?>;
	var fbID = <?php echo (strcmp($userDetails[0]->FBID, "non-fb-member") === 0)? 'null': "'".$userDetails[0]->FBID."'"; ?>
	/* IMPORTANT:: NEVER DELETE */
//]]>
</script>
<script type="text/javascript" src="/application/views/app/scripts/vendor/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/plugins.js"></script>

<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.selectbox-0.1.3.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.sexy-combo.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/pop-up.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/common.js"></script>
<!--<script type="text/javascript" src="--><?php //echo $base_url; ?><!--assets/js/tooltip.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo $base_url; ?><!--assets/js/landing_page.js"></script>-->
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/friend_follower.js"></script>

<script type="text/javascript">

	function login(){
		$('.formError').html('');

		var baseUrl ='<?php echo $base_url; ?>';
		var email = $('#inputEmail').val();
		var password = $('#inputPassword').val();
		$.ajax({
			type: "POST",
			url: baseUrl+'index.php/async/login',
			data: {
				signin_email: email,
				signin_pw: password
			},
			success: function(data, status, xhr){
				console.log(data);
				if (data[0].validCredentials){
					window.location.reload();
				}
				else if(data[0].validCredentials === false){
					$('.formError').html("Invalid username or password");
				} else{
					$('.formError').html("Some error occurred");
				}
			}
		});
	}

	function register()
	{
		$('.formError').html('');

		var baseUrl ='<?php echo $base_url; ?>';
		var registerEmail = $('input[name="registerEmail"]').val();
		var firstName = $('input[name="firstName"]').val();
		var lastName = $('input[name="lastName"]').val();
		var registerPassword = $('input[name="registerPassword"]').val();
		var registerPasswordConfirm = $('input[name="registerPasswordConfirm"]').val();
		var userGender = $('input[name=genderSelect]:radio:checked')[0].value;
		$.ajax({
			type: "POST",
			url: baseUrl+'index.php/ajax/signup',
			data:{signup_email: registerEmail,signup_fname: firstName,signup_lname: lastName,signup_pw1: registerPassword,signup_pw2: registerPasswordConfirm,signup_gender: userGender},

			success: function(data)
			{
				console.log(data);
				if (data=='sign_up_success')
					window.location.reload();
				else if (data=='validation_error')
				{
					$('.formError').html('Please check the details entered');
				}
				else if (data=='existing_facebook_user')
				{
					$('.formError').html('User already signed up with facebook');
				}
				else if (data=='existing_signup_user')
				{
					$('.formError').html('User already registered');
				} else{
					$('.formError').html("Some error occurred");
				}
			}
		});
	}

	function brag(pid, sid, pname) {
		if(fbID) {

		    var params = {};

		    params['message'] = "<?php echo $userDetails[0]->fullName; ?> has acquired bragging rights for " + pname + " ... !! After all, brag is the new love! :)";
		    params['name'] = 'BuynBrag.com';
		    params['description'] = 'You can also acquire bragging rights for this product by logging on to www.buynbrag.com';
		    params['link'] = "https://www.buynbrag.com/";
		    params['picture'] = 'https://buynbragstores.s3.amazonaws.com/assets/images/stores/' + sid + '/' + pid + '/img1_171x171.jpg';
		    params['caption'] = 'is your destination for everything hard-to-find';

		    FB.getLoginStatus(function(logResponse) {
		        if (logResponse.status === 'connected') {
		        	$('#brag_' + pid).find(".hoverText").text("BRAGGING!");
		            var accessToken = logResponse.authResponse.accessToken;

		            FB.api('/me/feed', 'post', params, function (response) {
		                if (!response || response.error) {
		                    console.log('Fb FFF Badly');
		                }
		                else {
		                    $.ajax({
								url: "<?php echo $base_url; ?>" + 'index.php/brag_ajax/product_brag?store_id=' + sid + '&product_id=' + pid,
								success: function (data) {
									$('#brag_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/brag_pink.png);"></div><div class="hoverText">BRAGGED!</div>');
								}
							});
		                }
		            });
		        }
		        else if (logResponse.status === 'not_authorized') {

		        }
		        else {
		        	
		        }
		    });
		}
		else {
			$("#fbSignUpModal").modal('show');
		}
                
	}

	var authorizationCheck = function(){

		if($('.signInAccountHolder ').is(':VISIBLE')){
			$('#loginModal').modal('show');
		}

	};
	
	jQuery(document).ready(function()
	{
//		jQuery('#loginModalClose').on('click', function()
//		{
//			jQuery('#loginModal').modal('hide');
//		});
		var couponsLoaded = false;
		
		jQuery('.loginRequired').on('click', function()
		{
			authorizationCheck();
		});

		$("#logoutUser").on("click", function() {
			$.ajax({
				type: "POST",
				url: "<?php echo $base_url; ?>" + "index.php/async/logout",
				success: function(data) {
					setTimeout(function() {
						window.location.reload();
					}, 2500);
				}
			});
		});

		$('#coupons').on('click', function() {

			if(!couponsLoaded) {
				$.ajax({
					type: 'GET',
					url: '<?php echo $base_url; ?>' + 'index.php/coupons/all',
					success: function(data) {
						if(data && data.isLoggedIN && data.coupons) {
							var coupon, startTimeStamp, stopTimeStamp,
								months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
								row = '';

		                   for(i in data.coupons) {
		                   		coupon = data.coupons[i];
		                   		startTimeStamp = new Date(coupon.validFrom * 1000);
		                   		stopTimeStamp = new Date(coupon.validUpto * 1000);
		                   		
		                   		row += '<tr>' +
		                   				'<td>' + coupon.couponID + '</td>' + 
		                   				'<td>' + months[startTimeStamp.getMonth()] + ' ' + startTimeStamp.getDate() + ', ' + startTimeStamp.getFullYear() + '</td>' +
		                   				'<td>' + months[stopTimeStamp.getMonth()] + ' ' + stopTimeStamp.getDate() + ', ' + stopTimeStamp.getFullYear() + '</td>' + 
		                   				'<td>' + ((coupon.couponType == 1) ? ('&#8377 ' + parseInt(coupon.couponValue)) : (parseInt(coupon.couponValue) + ' %')) + '</td>' +
		                   				'<td>' + '&#8377 ' + parseInt(coupon.minPurchaseAmount) + '</td>' +
		                   			  '</tr>';
		                   }
		                   
		                   $('#couponContent').html(row);
		                   couponsLoaded = true;

		                }
		                else {
							$('.couponsTableContainer').addClass('hide');
        					$('.noCoupons').removeClass('hide');
		                }
					}
				});
			}
			
		});
	});

</script>

</head>
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

                <h1 class="logoHeading">
                    <a class="logo pull-left hidden-phone" href="/">
                        <img src="/application/views/dist/images/404_logo.png" alt="BuynBrag logo"/>
                    </a>
                </h1>

				<?php
				if($isLoggedIN["status"] === FALSE)
				{
					?>
					<div class="signInAccountHolder pull-right">
<!--                        <a href="#loginModal123" class="signInImage pull-left loginRequired hidden-phone" id="signInAccount" role="button" data-toggle="modal">Sign In</a>-->
                        <a href="/#/login" class="signInImage pull-left loginRequired" id="signInAccount">Sign In</a>
                        <div class="image_Separator pull-left"></div>
<!--                        <a href="#registerModal" class="accountImage pull-left registerModal hidden-phone" id="createAccount" role="button" data-toggle="modal">Sign Up</a>-->
                        <a href="/#/register" class="accountImage pull-left registerModal" id="createAccount">Sign Up</a>
					</div>
				<?php
				}
				if($isLoggedIN["status"] === TRUE)
				{
					$userImageSrc = (strcmp($userDetails[0]->FBID, "non-fb-member") === 0)? $baseURL."assets/images/default/".((strcmp($userDetails[0]->gender, "female") === 0)? "female": "male").".png": "https://graph.facebook.com/".$userDetails[0]->FBID."/picture?width=200&height=200";
					?>
					<div class="signedInProfileHolder pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img class="userImage" src="<?php echo $userImageSrc; ?>" alt="<?php echo $userDetails[0]->fullName." picture"; ?>">
							<span class="userName hidden-phone"><?php echo $userDetails[0]->fullName; ?></span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu dark">
							<li><a href="/user_info/user_detail/">Profile</a></li>
							<li><a href="/order/user_fancy_product/">Fancy list</a></li>
							<li><a href="/user_info/badges/">Badges unlocked</a></li>
                            <li id='coupons'><a href="#couponsModal" role="button" data-toggle="modal">Coupons available</a></li>
							<li><a href="/user_info/purchase_history/">Purchase history</a></li>
							<li><a id="logoutUser" href="/sync/logout">Log Out</a></li>
						</ul>
					</div>
					<ul class="notificationCounterContainer pull-right">
						<!--               <li><a class="userPollCount cssTransition" href="#"><span class="notificationBadge"><?php echo isset($headerData["pollCount"])? $headerData["pollCount"]: ""; ?></span></a></li>-->
						<li>
							<a href="/order/user_fancy_product/" class="userFancyCount cssTransition">
								<span class="notificationBadge"><?php echo $headerData["fancyCount"]; ?></span>
								<span class="tooltips hide">Fancied items</span>
							</a>
						</li>
						<li>
							<a href="" class="userRankCount cssTransition">
								<span class="notificationBadge"><?php echo $headerData["rank"]; ?></span>
								<span class="tooltips hide">Your rank</span>
							</a>
						</li>
<!--						<li>-->
<!--							<a href="--><?php //echo $baseURL; ?><!--index.php/cart/shopping_cart" class="userCartCount cssTransition">-->
<!--								<span class="notificationBadge" id="countCart">--><?php //echo $headerData["cartCount"]; ?><!--</span>-->
<!--								<span class="tooltips hide">Your cart</span>-->
<!--							</a>-->
<!--						</li>-->
                        <li>
                            <!--Link for mobiles-->
                            <a href="/cart/shopping_cart" class="userCartCount visible-phone">
                                <span class="notificationBadge" id="countCart"><?php echo $headerData["cartCount"]; ?></span>
                            </a>
                            <!--Link for tablets and desktops-->
                            <a href="#" class="userCartCount cssTransition dropdown-toggle hidden-phone" data-toggle="dropdown">
                                <span class="notificationBadge" id="countCart"><?php echo $headerData["cartCount"]; ?></span>
                            </a>
                            <ul class="cartPreviewContainer dark dropdown-menu hidden-phone">

                                <?php
                                $cartTotalQuantity = 0;
                                $cartTotalAmount = 0;
                                if($headerData["cartCount"] > 0 && isset($headerData["cartData"]) )
                                {
									foreach($headerData["cartData"] as $cartDataItem)
									{
										$itemPrice = $cartDataItem->originalPrice;
										switch($cartDataItem->isOnDiscount)
										{
											case 1: $itemPrice = $cartDataItem->originalPrice - $cartDataItem->discountAmount;
												break;
										}
										$itemPrice = $itemPrice * $cartDataItem->quantity;
										$cartTotalAmount += $itemPrice;
										$cartTotalQuantity += $cartDataItem->quantity;
		                                ?>
		                                <li class="cartItemDetails">
		                                    <a href="/order/product_page/<?php echo $cartDataItem->storeID."/".$cartDataItem->productID; ?>">
		                                        <img <?php echo "src=\"".$store_url."assets/images/stores/".$cartDataItem->storeID."/".$cartDataItem->productID."/img1_40x40.jpg\" alt=\"".$cartDataItem->productName."\""; ?>>
		                                    <span class="itemPreviewDescriptionContainer">
		                                        <span class="itemName"><?php echo $cartDataItem->productName; ?></span>
		                                        <span class="itemTotalContainer">X <?php echo $cartDataItem->quantity; ?>
		                                            <span class="itemPriceHolder">Amount   :<span class="itemPrice"><?php echo "&#8377; ".$itemPrice; ?></span></span>
		                                        </span>
		                                    </span>
		                                    </a>
		                                </li>
		                                <?php
									}
                                }
                                ?>

                                <li class="checkOutCart">
                                    <a class="btn inlineBlock" href="/cart/shopping_cart">Checkout Cart</a>
                                <span class="cartTotalDetailsContainer">
                                    <span class="cartTotalContainer">Total Quantity :
                                        <span class="cartTotalItemQuantity"><?php echo $cartTotalQuantity; ?></span>
                                        <span class="cartTotalPriceHolder">Total :<span class="cartTotalPrice"><?php echo "&#8377; ".$cartTotalAmount; ?></span></span>
                                    </span>
                                </span>
                                </li>

                            </ul>
                        </li>
					</ul>
				<?php
				}
				?>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="visible-phone"><a href="/">Home</a></li>
						<li>
							<a id="bootStrapDropDownFix" href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
							<ul class="dropdown-menu dark">
<!--								--><?php
//									foreach($cats as $cat)
//									{
//									?>
<!--										<li><a href="--><?php //echo $base_url; ?><!--categories/cat_product/--><?php //echo $cat->catID; ?><!--">--><?php //echo $cat->catName; ?><!--</a></li>-->
<!--									--><?php
//									}
//								?>
								<!-- <li><a href="<?php echo $base_url; ?>categories/cat_product/2">Fashion</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/3">Art</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/4">Collectibles &amp; Accessories</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/5">Personal Care</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/6">Furniture</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/7">Dining</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/8">Decor and Furnishings</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/10">Lighting</a></li>
								<li><a href="<?php echo $base_url; ?>categories/cat_product/357">Collectibles</a></li> -->

                                <li><a href="/#/categories/Fashion/2">Fashion</a></li>
                                <li><a href="/#/categories/Art/3">Art</a></li>
                                <li><a href="/#/categories/Gadgets-Collectibles/4">Gadgets &amp; Collectibles</a></li>
                                <li><a href="/#/categories/Furniture/6">Furniture</a></li>
                                <li><a href="/#/categories/Dining/7">Dining</a></li>
                                <li><a href="/#/categories/Decor-and-Furnishings/8">Decor and Furnishings</a></li>
                                <li><a href="/#/categories/Lighting/10">Lighting</a></li>
							</ul>
						</li>
						<li><a href='<?php echo $base_url; ?>#/allStores'>Stores</a></li>
						<!--<li><a href="https://blog.buynbrag.com">Blog</a></li>-->
						<!--                        <li class="navSearch hide">-->
						<!--                            <input type="text" class="span2" placeholder="Search">-->
						<!--                        </li>-->
					</ul>
				</div>
			</div>
		</nav>
	</div>

	<!--	<div class="headerReveal hidden-phone hide">BuynBrag</div>-->
</header>

<!-- lOGIN Modal -->
<div id="loginModal123" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="pull-right"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>

    <div class="userLoginContainer">

        <p class="loginHeading">Login and Discover</p>
        <p class="fbLoginImgContainer"><a href="/fbLogin/index"><img src="/application/views/dist/images/sprites/fbLogin.png"></a></p>
        <p><img src="/application/views/dist/images/sprites/orDivider.png"></p>
        <p class="signInText">Sign-in with your email address</p>

        <form onsubmit="return false" id="login">
            <div class="input-prepend block">
                <span class="add-on">Email Address</span>
                <input type="text" placeholder="Your Email" id="inputEmail">
            </div>

            <div class="input-prepend block">
                <span class="add-on">Password</span>
                <input type="password" placeholder="Your Password" id="inputPassword">
            </div>

            <button class="btn btn-primary block" type="submit" onclick="login()">Sign in</button>
        </form>

        <div class="signUpUserContainer">
            Don't have an account yet?
            <a href="#registerModal" class="bnbPink userSignUpButton" role="button" data-toggle="modal" data-dismiss="modal" aria-hidden="true">Sign up & Discover</a>
        </div>

        <div class="formError"></div>
    </div>
</div>

<!-- REGISTER Modal -->
<div id="registerModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
	<!--<div class="modal-header">-->
	<!--&lt;!&ndash;<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>&ndash;&gt;-->
	<!--<h3 id="myModalLabel">Modal header</h3>-->
	<!--</div>-->
	<div class="modal-body">
		<div class="span6 pull-right">
			<button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		</div>
		<div class="registerContainer">
			<div class="span6 registerForm">
				<form id="register" onsubmit="return false">
					<fieldset>
						<legend>Sign up for BuynBrag</legend>
						<input type="text" name="firstName" placeholder="First name" required>
						<input type="text" name="lastName" placeholder="Last name" required>
						<input type="email" name="registerEmail" placeholder="Email address" required>
						<input type="password" name="registerPassword" placeholder="Create password" required>
						<input type="password" name="registerPasswordConfirm" placeholder="Confirm password" required>
						<label class="inlineBlock">Male<input class="inlineBlock" name="genderSelect" type="radio" value="male" required></label>
						<label class="inlineBlock">Female<input class="inlineBlock" name="genderSelect" type="radio" value="female" required></label>
						<table><tr>
							<td><button type="submit" class="btn btn-primary" onclick="register()">Register</button></td>
							<td class="span1" style="font-size:2em; margin-top: 0.3em">OR</td>
							<td><a href="<?php echo $baseURL; ?>fbLogin/index"><img src="<?php echo $baseURL; ?>assets/images/fbSignUp.png"></a></td>
						</tr></table>
					</fieldset>
				</form>
			</div>
		</div>

		<span class="formError"></span>

	</div>
	<!--<div class="modal-footer">-->
	<!--<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>-->
	<!--<button class="btn btn-primary">Save changes</button>-->
	<!--</div>-->
</div>
<!-- USER COUPONS Modal -->
<div id="couponsModal" class="modal hide" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-header">
        <button class="close" role="button" data-dismiss="modal">&times;</button>
        <h3>Coupons Available</h3>
    </div>
    <div class="modal-body">

        <div class="couponsTableContainer">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Coupon code</th>
                    <th>Issued on</th>
                    <th>Valid till</th>
                    <th>Coupon Value</th>
                    <th>Minimum purchase amount</th>
                </tr>
                </thead>

                <tbody id="couponContent">
                </tbody>
            </table>

        </div>

        <div class="noCoupons text-center hide">
            <i class="icon-emo-displeased block bnbRed"></i>
            <div class="noCouponsMsg">No coupons are available for you right now. Check back later.</div>
        </div>

    </div>
</div>

<!-- BADGES Modal -->
<div id="badgesModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <img src="\assets\images\badges\fprod\4.png" alt="badge">
</div>

<!-- NEW VISITOR Modal -->
<div id="newVisitorModal" class="modal hidden-phone hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <img src="\application\views\dist\images\landing_png2.png" alt="Landing png"/>
    <button class="btn btn-primary">Sign up & Discover</button>
</div>

<!-- FACEBOOK SIGNUP Modal -->
<div id="fbSignUpModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <div class="span5">
        <p>Please login via Facebook to Brag products.</p>
        <a href="https://buyandbrag.in/index.php/fbLogin/index">
            <img src="https://buyandbrag.in/assets/images/fbLogin.png">
        </a>
    </div>
</div>

<!-- INVITE FRIENDS Modal -->
<div id="inviteFriendsModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

    <div class="inviteHeadingContainer">
        <span class="inviteHeading block hidden-phone">Invite friends. Earn BragBucks. Simple.</span>
        <span class="inviteSubHeading block">Invite friends and earn BragBucks when they join. For each friend. Simple enough?</span>
    </div>

    <div class="socialInviteContainer">
        Invite your friends directly from...

        <div class="socialButtonContainer">
            <button class="btn fbInvite">
                <i class="icon-facebook"></i>
                Facebook
            </button>
            <button class="btn twitterInvite">
                <i class="icon-twitter-1"></i>
                Twitter
            </button>
            <button class="btn googleInvite">
                <i class="icon-gplus"></i>
                Google+
            </button>
        </div>

        We won't share your contacts with anyone. Period.
    </div>

    <div class="referralLinksContainer pull-left">
        <span class="referralHeading block">Referral link to share</span>
        <input type="text" value="https://bnb.to/5fgrd69d"/>
        <button class="btn">Copy Link</button>
        <span class="orDecorative block">or post via</span>
        <div class="socialIcons">
            <a href=""><i class="icon-facebook-circled" style="color: #506ba1; font-size: 33px;"></i></a>
            <a href=""><i class="icon-twitter-circled" style="color: #00aced; font-size: 33px;"></i></a>
            <a href=""><i class="icon-gplus-circled" style="color: #d74937; font-size: 33px;"></i></a>
        </div>
    </div>

    <div class="emailInviteContainer inlineBlock">
        <span class="inviteEmailHeading block">Invite via email</span>
        <form action="post">
            <input type="email" placeholder="Enter your friends email addresses"/>
            <textarea style="resize: none" placeholder="Add a personal note (optional)"></textarea>
            <button class="btn block">Send Invites</button>
        </form>
    </div>

</div>