<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Untitled Document</title>
	<link href="../assets/css/new_style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="main">
	<div class="header">
		<div style="float:left;">
			<h3>Account</h3><br/>

			Change your basic account setting and more
		</div>
		<div class="side_menu">
			<ul>
				<li><a href="<?php echo base_url(); ?>user_info/settings">Account</a></li>
				<li><a href="<?php echo base_url(); ?>user_info/notification">Notifications</a></li>
				<li><a href="<?php echo base_url(); ?>user_info/password">Password</a></li>
			</ul>
		</div>
	</div>

	<div class="contdiv bor">
		<div class="first">Picture</div>
		<div class="second">
			<div class="img"><img src="facebook.png"/></div>
			<div class="img_side"><input type="file"/><br/>
				<input type="button" value="Change Picture"/>

				<p>Allowed file types JPG,GIF or PNG maximum size of 700k</p>
				<a href="#">Delete Picture</a></div>
		</div>
	</div>
	<div class="contdiv bor">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="34%" height="30" align="left" valign="middle">Username</td>
				<td width="66%" height="30" align="left" valign="middle"><strong>Ayush jain</strong></td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">First name</td>
				<td height="30" align="left" valign="middle"><input type="text"/><br/>
					Enter your real name,So people you know who's you.
				</td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">E-mail</td>
				<td height="30" align="left" valign="middle"><input type="text"/></td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">Twitter</td>
				<td height="30" align="left" valign="middle"><input type="text"/></td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">Location</td>
				<td height="30" align="left" valign="middle"><input type="text"/></td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">Language</td>
				<td height="30" align="left" valign="middle"><select style="width:355px;">
						<option></option>
						<option></option>
						<option></option>
					</select></td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">Age</td>
				<td height="30" align="left" valign="middle"><select style="width:355px;">
						<option>Select Age</option>
						<option>13 to 17</option>
						<option>18 to 24</option>
						<option>25 to 34</option>
						<option>35 to 44</option>
						<option>45 to 54</option>
						<option>55+</option>

					</select></td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">Gender</td>
				<td height="30" align="left" valign="middle"><select style="width:355px;">
						<option>Select Gender</option>
						<option>Male</option>
						<option>Female</option>
					</select></td>
			</tr>
			<tr>
				<td height="30" align="left" valign="top">Bio</td>
				<td height="30" align="left" valign="middle"><textarea></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>Write something about yourself.</td>
			</tr>
		</table>


	</div>
	<div class="contdiv bor">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="34%" height="30" align="left" valign="top">List</td>
				<td width="66%" height="30" align="left" valign="middle">
					<input type="checkbox" name="checkbox" id="checkbox"/>

					<span><strong>Show list option when i fancy something</strong></span><br/><br/>

					If checked a popup for organizing in lists will appear when you fancy things
				</td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">Privacy</td>
				<td height="30" align="left" valign="middle"><input type="checkbox" name="checkbox" id="checkbox"/>

					<span><strong>Make my profile private </strong></span><br/><br/>

					If checked the things you fancy, your follower,and
				</td>
			</tr>
		</table>


	</div>

	<div class="contdiv bor">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="34%" height="30" align="left" valign="top">Instagram</td>
				<td width="66%" height="30" align="left" valign="middle">
					<div style="float:left"><img src="../assets/images/instagram.png"/></div>
					<div style="float:left; margin:0 0 0 20px;"><input type="button" value="Connect with instagram"/>
					</div>
				</td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">facebook</td>
				<td height="30" align="left" valign="middle">
					<div style="float:left"><img src="../assets/images/default/facebook.png"/></div>
					<div style="margin:0 0 0 20px; float:left;">Linkin to facebook as<strong> Ayush jain</strong> <a
							href="#">Unlink</a><br/> <input type="checkbox" name="checkbox" id="checkbox"/>Post thing I
						fancy to facebook
					</div>
				</td>
			</tr>
			<tr>
				<td height="30" align="left" valign="middle">Twitter</td>
				<td height="30" align="left" valign="middle">
					<div style="float:left"><img src="../assets/images/twitter.png"/></div>
					<div style="float:left; margin:0 0 0 20px;"><input type="button" value="Connect with Twitter"/>
					</div>
				</td>
			</tr>
		</table>


	</div>
	<div class="contdiv bor">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="34%" height="30" align="left" valign="top">&nbsp;</td>
				<td width="66%" height="30" align="left" valign="middle">

					<div style="float:left;"><input type="submit" value="Save Changes"/></div>
					<div style="float:right; margin:10px 0 0 0; color:#fa2b50"><a href="#">Close your account</a></div>
				</td>
			</tr>
		</table>


	</div>
</div>
</body>
</html>
