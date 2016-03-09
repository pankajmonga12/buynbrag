<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>BuynBrag - Signup</title>
	<meta name="viewport" content="width=device-width">
	<style type="text/css">
		.errorText {
			color: #ec184d;
			clear: both;
			font: 16px gill;
			padding-left: 213px;
			display: none;
		}
	</style>
</head>
<body style="background-image:url('<?php echo $base_url; ?>assets/images/top_banner_background.png');" leftmargin="0"
      marginwidth="0" topmargin="0" marginheight="0" offset="0">
<center> <?php if ($msg != "") : ?>
		<div class="formRow">
			<div class="labelText" style="color:red;margin-left:200px;width:600px;"><?php echo $msg; ?></div>
		</div> <?php endif; ?>
	<form action="" method="post">
		<table style="margin-top:40px;">
			<tr>
				<td>
			<tr>
				<td>
					<div class="formRow">
						<div class="labelText" style="width:200px;">Enter your E-Mail ID!</div>
						<input style="width:350px;" id="signup_email" type="text" value="<?php echo $email; ?>"
						       name="signup_email" placeholder="enter your email ID">

						<div class="errorText" id="error_id">Please enter email ID in proper format</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
			<tr>
				<td>
					<div class="formRow">
						<div class="labelText" style="width:200px;">First Name</div>
						<input style="width:350px;" id="signup_fname" type="text" value="<?php echo $fname; ?>"
						       name="signup_fname" placeholder="First Name">

						<div class="errorText" id="error_fname">Please enter first name</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="formRow">
						<div class="labelText" style="width:200px;">Last Name</div>
						<input style="width:350px;" id="signup_lname" type="text" value="<?php echo $lname; ?>"
						       name="signup_lname" placeholder="Last Names">

						<div class="errorText" id="error_lname">Please enter last name</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="formRow">
						<div class="labelText" style="width:200px;">Create Password</div>
						<input style="width:350px;" id="signup_pw1" type="password" value="" name="signup_pw1"
						       placeholder="Password">

						<div class="errorText" id="error_pass">Please enter password</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
			<tr>
				<td>
					<div class="formRow">
						<div class="labelText" style="width:200px;">Confirm Password</div>
						<input style="width:350px;" id="signup_pw2" type="password" value="" name="signup_pw2"
						       placeholder="Repeat the password">

						<div class="errorText" id="error_pass2">Please enter confirm password</div>
						<div class="errorText" id="match_pass">Passwords must match</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="formRow">
						<div class="labelText" style="width:200px;">Enter the text below!</div>
						<input style="width:350px;" id="signup_cap" type="text" value="" name="signup_cap"
						       placeholder="Captcha Text ( not case sensitive )">

						<div class="errorText" id="error_code">Please enter captcha code</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div style="margin-left:200px;"><?php echo $cap['image']; ?></div>
				</td>
			</tr>
			<tr>
				<td>
					<button class="prod_continue save_width" type="submit" onclick="return validate();"
					        name="btn_signup" style="margin-left:200px;margin-top:20px;">Signup
					</button>
				</td>
			</tr>
		</table>
	</form>
</center>
</body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/libs/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
	function validate() {

		var ePattern = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,4}$/;
		if ($("#signup_email").val() == '' || $("#signup_email").val().charAt(0) == ' ' || !ePattern.test($("#signup_email").val())) {
			$("#signup_email").addClass("red_border");
			$("#signup_email").focus();
			$("#error_id").show();
			return false;
		}
		else {
			$("#signup_email").removeClass("red_border");
			$("#error_id").hide();

		}

		var regExpression = /^[A-Za-z\s]+$/;
		var regExpression2 = /^[A-Za-z.\s]+$/;

		if (!($("#signup_fname").val().match(regExpression)) || $("#signup_fname").val().charAt(0) == ' ') {
			$("#signup_fname").addClass("red_border");
			$("#signup_fname").focus();
			$("#error_fname").show();
			return false;
		}
		else {
			$("#signup_fname").removeClass("red_border");
			$("#error_fname").hide();

		}
		if (!($("#signup_lname").val().match(regExpression2)) || $("#signup_lname").val().charAt(0) == ' ') {
			$("#signup_lname").addClass("red_border");
			$("#signup_lname").focus();
			$("#error_lname").show();
			return false;
		}
		else {
			$("#signup_lname").removeClass("red_border");
			$("#error_lname").hide();

		}

		if ($("#signup_pw1").val() == '' || $("#signup_pw1").val().charAt(0) == ' ') {
			$("#signup_pw1").addClass("red_border");
			$("#signup_pw1").focus();
			$("#error_pass").show();
			return false;
		}
		else {
			$("#signup_pw1").removeClass("red_border");
			$("#error_pass").hide();

		}

		if ($("#signup_pw2").val() == '' || $("#signup_pw2").val().charAt(0) == ' ') {
			$("#signup_pw2").addClass("red_border");
			$("#signup_pw2").focus();
			$("#error_pass2").show();
			return false;
		}
		else {
			$("#signup_pw2").removeClass("red_border");
			$("#error_pass2").hide();

		}

		if ($("#signup_pw1").val() != $("#signup_pw2").val()) {
			$("#signup_pw2").addClass("red_border");
			$("#signup_pw2").focus();
			$("#match_pass").show();
			return false;
		}
		else {
			$("#signup_pw2").removeClass("red_border");
			$("#match_pass").hide();

		}

		if ($("#signup_cap").val() == '' || $("#signup_cap").val().charAt(0) == ' ') {
			$("#signup_cap").addClass("red_border");
			$("#signup_cap").focus();
			$("#error_code").show();
			return false;
		}
		else {
			$("#signup_cap").removeClass("red_border");
			$("#error_code").hide();

		}

	}
</script>
</html>