<div class="sellerLoginPopup" id="sellerLoginPopup">
	<div class="sellerLoginContainer">
		<div class="sellerLoginTrans"></div>
		<div class="sellerLoginContents">
			<div class="loginHeaderRow">
				<div class="fl">
					<div class="loginHeading">LOGIN</div>
					<div class="loginNow">Seller login now.</div>
				</div>
				<div class="fr">
					<div class="problemPopupClose noMargin" id="close_login"></div>
				</div>
			</div>
			<form method="post" action="<?php echo $base_url;?>index.php/login/getMeLoggedIn" enctype="multipart/form-data" name="sellerLoginForm">
				<div class="loginLabel">Username</div>
				<div class="loginTextField"><input type="text" id="login_username" name="login_username"/></div>
				<div class="loginLabel">Password</div>
				<div class="loginTextField"><input type="password" id="login_pass" name="login_pass"/></div>
				<div class="loginButtonPane"><input id="sellerLoginButton" class="sellerLoginButton" type="submit"
				                                    value="Login"/>

					<div class="asideLogin">Don&rsquo;t have an account? <a href="javascript:void(0)"
					                                                        class="asideLoginRed">Signup</a></div>
				</div>
			</form>
		</div>
	</div>
</div>