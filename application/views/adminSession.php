<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login</title></head>
<body style="margin-left: 180px; margin-right: 180px; margin-top: 30px; text-align: center;"> <?php if (!$error): ?>
	<span style="color: red; font-weight: bold;">*ENTER USERNAME AND PASSWORD TO GET ADMIN ACCESS*</span>
	<br> <?php else: ?> <span style="color: red; font-weight: bold;">*ENTER CORRECT USERNAME AND PASSWORD TO GET ADMIN ACCESS*</span>
	<br> <?php endif; ?> <span
	style="color: red; font-weight: bold;">No. of attempts left: <?php echo ($maxTry - ((int)$attempts)); ?></span><br> <?php $try = (int)$attempts; if ($try < $maxTry): ?>
	<form method="post" action="#">
		<div><label>Username:</label> <input type="text" name="adminid" style="width: 200px;"></div>
		<br>

		<div><label>Password:</label> <input type="password" name="adminpwd" style="width: 200px;"></div>
		<br>

		<div><input type="submit" name="submit" value="Submit"></div>
	</form> <?php else: ?> <?php echo 'Better Luck Next Time Buddy!'; ?> <?php endif; ?> </body>
</html>