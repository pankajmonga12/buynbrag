<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Untitled Document</title>
	<link href="../assets/css/new_style.css" rel="stylesheet" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
	<script>
		$(document).ready(function () {
			$("#change_password").submit(function () {
				if ($("#new_password").val() == "") {

					$('#new_password_error').html("<br>Enter new password");
					return false;
				}
				else if ($("#new_password").val().length < 6) {
					$('#new_password_error').html("");
					$('#new_password_error').html("<br>Password must contain 6 digits or characters.");
					return false;
				}
				else if ($("#new_password").val() != $("#confirm_password").val()) {
					$('#new_password_error').html("");
					$('#new_password_error').html("");
					$('#confirm_password_error').html("<br>New Password and Confirm Password do not match");
					return false;
				}
				else {

					$('#new_password_error').html("");
				}
			});
		});

	</script>
</head>
<title>Change Password</title>

<body>
<div class="main">
	<div class="header">
		<div style="float:left;">
			<h3>Password</h3><br/>

			Change Your Password
		</div>
		<div class="side_menu">
			<ul>
				<li><a href="<?php echo base_url(); ?>user_info/settings">Account</a></li>
				<li><a href="<?php echo base_url(); ?>user_info/notification">Notifications</a></li>
				<li><a href="<?php echo base_url(); ?>user_info/password">Password</a></li>
			</ul>
		</div>
	</div>

	<?php $this->load->library('session');?>
	<span style="color:red; padding-left:380px;"><?php  print  $this->session->flashdata('msg');?></span>

	<div class="contdiv bor">
		<form action="<?php print base_url();?>user_info/password" method="post" id="change_password"
		      name="change_password">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="34%" height="30" align="left" valign="top">New Password</td>
					<td width="66%" height="30" align="left" valign="middle"><input type="password" name="new_password"
					                                                                id="new_password"/><br/>

						Minimum 6 characters
						<span id="new_password_error" style="color:red"></span>
					</td>
				</tr>
				<tr>
					<td height="30" align="left" valign="top">Confirm Password</td>
					<td height="30" align="left" valign="middle"><input type="password" name="confirm_password"
					                                                    id="confirm_password"/>
						<span id="confirm_password_error" style="color:red"></span>
					</td>
				</tr>
			</table>
	</div>


	<div class="contdiv bor">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="34%" height="30" align="left" valign="top">&nbsp;</td>
				<td width="66%" height="30" align="left" valign="middle">

					<div style="float:left;"><input type="submit" value="Save Changes" name="submit"/></div>

				</td>
			</tr>
		</table>
		</form>

	</div>
</div>
</body>
</html>
