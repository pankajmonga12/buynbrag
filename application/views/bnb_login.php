<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <?php if ($action == 'login') : ?> <title>
		BuynBrag - Login</title> <?php else : ?> <title>BuynBrag - Forgot Password</title> <?php endif; ?> </head>
<body style="background-image:url(<?php echo $base_url; ?>/assets/images/top_banner_background.png);" leftmargin="0"
      marginwidth="0" topmargin="0" marginheight="0" offset="0">
<center> <?php if ($action == 'login') : ?> <?php if ($msg != "") : ?>
		<div class="formRow">
			<div class="labelText" style="color:red;margin-left:200px;width:600px;"><?php echo $msg; ?></div>
		</div> <?php endif; ?>
		<form action="" method="post">
			<table style="margin-top:40px;">
				<tr>
					<td>
						<div class="formRow">
							<div class="labelText" style="width:200px;">Enter your E-Mail ID!</div>
							<input style="width:350px;" id="signin_email" type="text" value="<?php echo $email; ?>"
							       name="signin_email" placeholder="enter your email ID"></div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="formRow">
							<div class="labelText" style="width:200px;">Enter Password</div>
							<input style="width:350px;" id="signin_pw" type="password" value="" name="signin_pw"
							       placeholder="Password"></div>
					</td>
				</tr>
				<tr>
					<td>
						<button class="prod_continue save_width" type="submit" name="btn_signin"
						        style="margin-left:200px;margin-top:20px;">Sign In
						</button>
					</td>
				</tr>
			</table>
		</form> <?php elseif ($action == 'pw_reset') : ?> <?php if ($msg != "") : ?>
		<div class="formRow">
			<div class="labelText" style="color:green;margin-left:200px;width:600px;"><?php echo $msg; ?></div>
		</div> <?php endif; ?> <?php if ($err != "") : ?>
		<div class="formRow">
			<div class="labelText" style="color:red;margin-left:200px;width:600px;"><?php echo $err; ?></div>
		</div> <?php endif; ?>
		<form action="" method="post">
			<table style="margin-top:40px;">
				<tr>
					<td>
						<div class="formRow">
							<div class="labelText" style="width:200px;">Enter Password</div>
							<input style="width:350px;" id="reset_pw1" type="password" value="" name="reset_pw1"
							       placeholder="Password"></div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="formRow">
							<div class="labelText" style="width:200px;">Confirm Password</div>
							<input style="width:350px;" id="reset_pw2" type="password" value="" name="reset_pw2"
							       placeholder="Password"></div>
					</td>
				</tr>
				<tr>
					<td><input type="hidden" name="act_id" value="<?php echo $act_id; ?>"> <input type="hidden"
					                                                                              name="act_key"
					                                                                              value="<?php echo $act_key; ?>">
						<button class="prod_continue save_width" type="submit" name="btn_reset_pw"
						        style="margin-left:200px;margin-top:20px;">Reset
						</button>
					</td>
				</tr>
			</table>
		</form> <?php else : ?> <?php if ($msg != "") : ?>
		<div class="formRow">
			<div class="labelText" style="color:green;margin-left:200px;width:600px;"><?php echo $msg; ?></div>
		</div> <?php endif; ?> <?php if ($err != "") : ?>
		<div class="formRow">
			<div class="labelText" style="color:red;margin-left:200px;width:600px;"><?php echo $err; ?></div>
		</div> <?php endif; ?>
		<form action="" method="post">
			<table style="margin-top:40px;">
				<tr>
					<td>
						<div class="formRow">
							<div class="labelText" style="width:200px;">Enter your E-Mail ID!</div>
							<input style="width:350px;" id="fp_email" type="text" value="<?php echo $fp_email; ?>"
							       name="fp_email" placeholder="enter your email ID"></div>
					</td>
				</tr>
				<tr>
					<td>
						<button class="prod_continue save_width" type="submit" name="btn_fp"
						        style="margin-left:200px;margin-top:20px;">Go
						</button>
					</td>
				</tr>
			</table>
		</form> <?php endif; ?> </center>
</body>
</html>