<?php if( !defined('BASEPATH') ) exit('403 Unauthorized'); ?>
<!DOCTYPE html>
<html>
    <head>
    	<link href="/application/views/dist/styles/vendor.css" rel="stylesheet">
		<link href="/application/views/dist/styles/0f654b22.main.css" rel="stylesheet">
        <title>Restricted User :: BuynBrag.com</title>
    </head>
    <body>
    <div class="container">
	    <div class="row-fluid">
	        <div style="height:20em"></div>
	    </div>
	    <div class="row-fluid">
	    	<h1 align="center">Oops!</h1>
	    </div>
	    <div class="row-fluid">
	        <h2 align="center">Your account has been <span style="color:red">blocked</span> to use this feature!</h2>
	    </div>
	    <div class="row-fluid">
	         <h5 align="center">Please contact our customer support (<a target="_top" href="mailto:talktous@buynbrag.com" style="text-decoration:none;color:inherit;font-family:">talktous@buynbrag.com</a> | <a href="tel:+918130878822" style="color:inherit;text-decoration: none">+91-8130878822</a> ) to get your profile unblocked.</h5>
	    </div>
	    <div class="row-fluid">
	        <p align="center"><a href="#goBack" onClick="history.go(-1)">Go back</a> to what you were doing or check-out <a href="<?php echo base_url(); ?>">the homepage</a>.</p>
	    </div>
	</div>
    </body>
</html>