<?php if( ! defined ( 'BASEPATH' ) ) exit('Direct script access not allowed'); ?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<title>php-sdk test by shammi</title>
		<style>
		<!--
			body { font-family: 'Lucida Grande', Verdana, Arial, sans-serif; }
			h1 a { text-decoration: none; color: #3b5998; }
			h1 a:hover { text-decoration: underline; }
		-->
		</style>
	</head>
	<body>
		<h1>php-sdk  by shammi shailaj</h1>
		
		<?php
		if(@$user_profile)
		{
			?>
			<pre>
				<?php echo print_r($user_profile, TRUE); ?>
			</pre>
			<a href="<?php echo $logoutUrl; ?>">Logout</a>
			<?php
		}
		else
		{
			?>
			<div>
			Login using OAuth 2.0 handled by the PHP SDK:
			<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
			</div>
			<?php
		}
		?>
	</body>
</html>
<?php /* dummy text */ ?>