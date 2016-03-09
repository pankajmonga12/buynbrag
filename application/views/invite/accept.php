<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized'); ?>
<p><a href="<?php echo $baseURL."invite/accept/facebook/".$inviteID."/".$hash; ?>">click here to register via facebook</a>
and get a coupon of Rs 500. </p>
<p> OR </p>
<p> Register directly on BuynBrag and get nothing </p>
<p> registration form here </p>
<form action="<?php echo $baseURL."invite/accept/register/".$inviteID."/".$hash; ?>" method="POST">
	<input type="text" name="signup_email" placeholder="Email Address" />
	<input type="text" name="signup_fname" placeholder="Firstname" />
	<input type="text" name="signup_lname" placeholder="Lastname" />
	<input type="password" name="signup_pw1" placeholder="Password" />
	<input type="password" name="signup_pw2" placeholder="Confirm Password" />
	<input type="radio" name="signup_gender" placeholder="Male" value="male" />
	<input type="radio" name="signup_gender" placeholder="Female" value="female" />
	<input type="text" name="signup_city" placeholder="City" />
	<input type="submit" value="Register" />
</form>