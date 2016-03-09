<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Login</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/common1.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sexy-combo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.selectbox.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/search_people.css"/>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
<script language="javascript">
$(document).ready(function()
{
	$("#login").submit(function() {
		

		var x=$('#emailid').val();
		
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			
		   
			$('#email_error').html("<br>Enter valid email");
		  	return false;
		 }
		 else if ($('#password').val()=="")
		  {
		    
			$('#email_error').html("");
			$('#file_error').html("<br>Enter Password");
			return false;
		  }
		  
		
	});
});
</script>    
</head>
<body> <?php include_once('header2.php'); ?>
<!-- MAIN CONTENT -->
<div id="outermain">
	<div class="container">
		<section id="maincontent" class="twelve columns">
			<div class="par"></div>



			<div class="incn2">
			<h5>Enter Login Details</h5>
			<br>
			<?php if($msg){print $msg."<br><br>";}?>
				<form action="<?php print base_url();?>login" id="login" name="login" method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td width="50%">Email</td>
							<td><input type="text" name="emailid" id="emailid"></td><td><span style="color: red" id="email_error"></span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="password" id="password"></td><td><span style="color: red" id="email_error"></span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td></td>
							<td><input name="submit" type="submit" value="Login"  /></td>
							<td><a href="<?php echo base_url(); ?>">Login With Facebook</a></td>
						</tr>
					</table>
				</form>
                
			</div>


			<!-- clear float -->
		</section>
	</div>
</div>
<!-- END MAIN CONTENT -->
<?php include "footer.php" ?>
</body>
</html>
