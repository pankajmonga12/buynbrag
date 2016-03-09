<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Welcome to BuynBrag</title>
	<meta name="viewport" content="width=device-width">
</head>
<body background="<?php echo $base_url; ?>/bk.jpg">
<center><img src="<?php echo $base_url; ?>/logo.png"> <?php $error = 0; if (isset($_POST['pass'])) {
		$pass = $_POST['pass'];
		if ($pass == "BUYNBRAG_user") redirect(base_url('user/landing')); elseif ($pass == "BUYNBRAG_developer") redirect(base_url('user/login/0')); else $error = 1;
	} if (isset($_POST['email'])) {
		echo "thanku";
	} ?>
	<form id="form1" name="test" method="post" action=""><p style="color:#FF1087";> <label for="pass"></label><b>Enter
			Secret Code to Access BuynBrag</b></p> <p><input name="pass" type="password" id="pass" size="50"
	                                                         maxlength="50"/></p> <?php if ($error == 1): ?> <p
			style="color:red;">Wrong Key , Contact info@buynbrag.com to get your Secret Code </p> <?php endif; ?>
	</form>
</center>
</body> </html>