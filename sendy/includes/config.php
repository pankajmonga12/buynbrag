<?php 
	//----------------------------------------------------------------------------------//	
	//								COMPULSORY SETTINGS
	//----------------------------------------------------------------------------------//
	
	/*  Set the URL to your Sendy installation (without the trailing slash) */
	define('APP_PATH', 'http://campaign.buynbrag.com');
	
	/*  MySQL database connection credentials  */
	$dbHost = 'myolddbtemp.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com'; //MySQL Hostname
	$dbUser = 'bnbuser'; //MySQL Username
	$dbPass = '34d04b8745abd3ef7ea88d9ac0637e64'; //MySQL Password
	$dbName = 'sendy'; //MySQL Database Name
	
	
	//----------------------------------------------------------------------------------//	
	//								  OPTIONAL SETTINGS
	//----------------------------------------------------------------------------------//	
	
	/* 
		Change the database character set to something that supports the language you'll
		be using. Example, set this to utf16 if you use Chinese or Vietnamese characters
	*/
	$charset = 'utf8';
	
	/*  Set this if you use a non standard MySQL port.  */
	$dbPort = 3306;	
	
	/*  Domain of cookie (99.99% chance you don't need to edit this at all)  */
	define('COOKIE_DOMAIN', '');
	
	//----------------------------------------------------------------------------------//
?>