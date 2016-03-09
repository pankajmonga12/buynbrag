<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>BuynBrag - Signup</title></head>
<body style="background-image:url(<?php echo $base_url; ?>/assets/images/top_banner_background.png);" leftmargin="0"
      marginwidth="0" topmargin="0" marginheight="0" offset="0">
<center> <?php if (isset($email_success)) : ?>
		<table>
			<tr>
				<td>
					<div class="formRow"> <?php if ($email_success != 'error') : ?>
							<div class="labelText" style="color:green;margin-left:200px;width:600px;">A mail has been
								sent to <font color="black"><?php echo $email_success; ?></font>. Please click on the
								activation link in the mail to directly login to BuynBrag. You can then change your
								password by clicking <font color="brown">Forgot/Create/Change Password</font>
							</div> <?php else : ?>
							<div class="labelText" style="color:red;margin-left:200px;width:600px;">An error occured
								while sending mail to <font color="red"><?php echo $error_email; ?></font>. Please try
								again!
							</div> <?php endif; ?> </div>
				</td>
			</tr>
		</table> <?php endif; ?> <?php if (isset($act_error)) : ?>
		<table>
			<tr>
				<td>
					<div class="formRow">
						<div class="labelText" style="color:red;margin-left:200px;width:600px;">Invalid Activation
							Link
						</div>
					</div>
				</td>
			</tr>
		</table> <?php endif; ?> <?php if (isset($activation)) : ?>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<div class="formRow">
							<div class="labelText" style="color:green;margin-left:200px;width:600px;">It seems that, you
								have already signed-up through facebook into BuynBrag! Click the button to send an
								activation link to your email to verify that you are the owner of this E-Mail ID!
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="formRow"><input type="hidden" name="act_id"
						                            value="<?php echo $activation['act_id']; ?>"> <input type="hidden"
						                                                                                 name="act_key"
						                                                                                 value="<?php echo $activation['act_key']; ?>">
							<button class="prod_continue save_width" type="submit" name="btn_activate"
							        style="margin-left:200px;">Send
							</button>
						</div>
					</td>
				</tr>
			</table>
		</form> <?php endif; ?> <?php if (isset($re_activation)) : ?>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<div class="formRow">
							<div class="labelText" style="color:green;margin-left:200px;width:600px;">It seems that, you
								have already signed-up into BuynBrag before! If you feel this is wrong, or in case you
								have forgotten the password,click the button to send a re-activation link to activate
								the password which you entered!
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="formRow"><input type="hidden" name="act_id"
						                            value="<?php echo $re_activation['act_id']; ?>"> <input
								type="hidden" name="act_key" value="<?php echo $re_activation['act_key']; ?>">
							<button class="prod_continue save_width" type="submit" name="btn_activate"
							        style="margin-left:200px;">Send
							</button>
						</div>
					</td>
				</tr>
			</table>
		</form> <?php endif; ?> </center>
</body>
</html>