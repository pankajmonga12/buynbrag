<?php session_start();
	require "include/dbConfig.php";
	$store_name = stripslashes($_REQUEST['store_name']);
	$store_url = stripslashes($_REQUEST['store_url']);
	$seo_tags = stripslashes($_REQUEST['seo_tags']);
	$banner_url = "Copple_Banner.jpg";
	$about_store = stripslashes($_REQUEST['about_store']);
	$contact_name = stripslashes($_REQUEST['contact_name']);
	$contact_number = stripslashes($_REQUEST['contact_number']);
	$contact_email = stripslashes($_REQUEST['contact_email']);
	$communication_address = stripslashes($_REQUEST['communication_address']);
	$communication_city = stripslashes($_REQUEST['communication_city']);
	$communication_state = stripslashes($_REQUEST['communication_state']);
	$communication_country = stripslashes($_REQUEST['communication_country']);
	$communication_pincode = stripslashes($_REQUEST['communication_pincode']);
	$warehouse_address = stripslashes($_REQUEST['warehouse_address']);
	$warehouse_city = stripslashes($_REQUEST['warehouse_city']);
	$warehouse_state = stripslashes($_REQUEST['warehouse_state']);
	$warehouse_country = stripslashes($_REQUEST['warehouse_country']);
	$warehouse_pincode = stripslashes($_REQUEST['warehouse_pincode']);
	$company_code = stripslashes($_REQUEST['company_code']);
	$marketing_name = stripslashes($_REQUEST['marketing_name']);
	$tag_line = stripslashes($_REQUEST['tag_line']);
	$owner_name = stripslashes($_REQUEST['owner_name']);
	$fb_link = stripslashes($_REQUEST['fb_link']);
	$about_owner = stripslashes($_REQUEST['about_owner']);
	$owner_mobile = stripslashes($_REQUEST['owner_mobile']);
	$owner_email = stripslashes($_REQUEST['owner_email']);
	$owner_pic = $_FILES['file']['name'];
	$rand_num_id = stripslashes($_REQUEST['rand_num_id']);
	$final_owner_pic = $rand_num_id . "_" . $owner_pic;
	$dbaction = stripslashes($_REQUEST['dbaction']);
	if ($dbaction == 'insertRecord') {
		$qry1 = "insert into store_info(store_name,store_url,seo_tags,banner_url,about_store,contact_name,contact_number,contact_email,communication_address,communication_city,communication_state,communication_country,communication_pincode,warehouse_address,warehouse_city,warehouse_state,warehouse_country,warehouse_pincode,company_code,marketing_name,tag_line) values('$store_name','$store_url','$seo_tags','$banner_url','$about_store','$contact_name','$contact_number','$contact_email','$communication_address','$communication_city','$communication_state','$communication_country','$communication_pincode','$warehouse_address','$warehouse_city','$warehouse_state','$warehouse_country','$warehouse_pincode','$company_code','$marketing_name','$tag_line')"; //echo $qry1; if (!mysql_query($qry1)) { die('Error1: ' . mysql_error()); } // getting newly inserted store id */ $queryForId="SELECT * FROM store_info where store_url='".$store_url."'"; $resultForId = mysql_query($queryForId); $fatchId=mysql_fetch_assoc($resultForId); $store_id = $fatchId['store_id']; /* insert into store_owner table */ $qry2="insert into store_owner(store_id,fb_link,owner_name,owner_pic,about_owner,owner_email,owner_number) values('$store_id','$fb_link','$owner_name','$final_owner_pic','$about_owner','$owner_email','$owner_mobile')"; if (!mysql_query($qry2)) { die('Error2: ' . mysql_error()); } } else { // getting newly inserted store id */ $queryForId="SELECT * FROM store_info where store_url='".$store_url."'"; $resultForId = mysql_query($queryForId); $fatchId=mysql_fetch_assoc($resultForId); $store_id = $fatchId['store_id']; $qry3 = "update store_info set store_name='$store_name', store_url='$store_url', seo_tags='$seo_tags', about_store='$about_store', contact_name='$contact_name', contact_number='$contact_number', contact_email='$contact_email', communication_address='$communication_address', communication_city='$communication_city', communication_state='$communication_state', communication_country='$communication_country', communication_pincode='$communication_pincode', warehouse_address='$warehouse_address', warehouse_city='$warehouse_city', warehouse_state='$warehouse_state', warehouse_country='$warehouse_country', warehouse_pincode='$warehouse_pincode', company_code='$company_code', marketing_name='$marketing_name', tag_line='$tag_line' where store_id=$store_id"; if (!mysql_query($qry3)) { die('Error: ' . mysql_error()); } $qry4="update store_owner set fb_link='$fb_link', owner_name='$owner_name', owner_pic='$final_owner_pic', about_owner='$about_owner', owner_email='$owner_email', owner_number='$owner_mobile' where store_id=$store_id"; echo $qry4; if (!mysql_query($qry4)) { die('Error2: ' . mysql_error()); } } header("location:store_info.php"); ?>