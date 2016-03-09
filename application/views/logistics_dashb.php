<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Logistic Dashboard Login</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/product_page.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/store_page.css"/>
	<link rel="stylesheet" href="../assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/skeleton.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/>
	<![endif] -->
	<style>
		.select {
			height: 30px;
			width: 145px;
		}

		h4 {
			font-family: Arial;
			color: #333;
			margin: 0px;
			padding: 0px;
		}

		.loginbox {
			width: 300px;
			margin: 20px auto;
			background-color: #fff;
			padding: 10px;
			border-radius: 10px;
			border: 5px solid #ccc;
			box-shadow: 0 0 10px #666;
		}

		input[type="submit"] {
			border: none;
			background: #999;
			color: #fff;
			border-radius: 7px;
			padding: 10px 15px;
			box-shadow: 2px 2px 1px #ccc;
			margin: 15px 0 0 0;
			font-weight: 600;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			box-shadow: none;
		}

		input[type="password"] {
			width: 145px;
			height: 25px;
			border: 1px solid #999;
		}


	</style>
</head>
<body style="background:#eee;">


<header class="header" onLoad>
	<div class="headerTop">
		<div class="headerContainer">
			<a href="javascript:void(0)">
				<div class="logo"></div>
			</a>

		</div>
	</div>
	<div class="navigation">
		<nav class="navigationMiddle">

			<div class="navigationContainer">
				<div class="grey">
				</div>
			</div>
		</nav>
	</div>
</header>

<div class="wrapper" style="background:#eee;">
	<div class="loginbox">
		<form name="logistic_dashb" method="post" action="<?php echo base_url();?>logistic/logistics_dashb">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="36%" height="40"><h4>Partner</h4></td>
					<td width="64%" height="40">
						<label for="select"></label>
						<select name="select" id="select" class="select">

							<option>Blue Dart</option>
							<option>Gati</option>
							<option>Fedex</option>

						</select>
					</td>
				</tr>
				<tr>
					<td width="36%" height="40"><h4>City</h4></td>
					<td width="64%" height="40">
						<label for="select"></label>
						<select name="city" id="city" class="select">
							<option>New Delhi</option>

						</select>
					</td>
				</tr>
				<tr>
					<td height="40"><h4>Password</h4></td>
					<td height="40">
						<input type="password" name="pwd" id="textfield">
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="submit" name="button" id="button" value="Log in">
					</td>
				</tr>
			</table>

	</div>
	<?php echo $msg; ?>
</div>


</body>

</html>
