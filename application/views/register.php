<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Register</title>
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
	$("#register").submit(function() {
		

		var x=$('#emailid').val();
		
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if($('#fname').val()=="")
		{
			$('#fname_error').html("Enter Firstname");
			return false;
		}
		else if ($('#lname').val()=="")
		  {
		    $('#fname_error').html("");
			$('#lname_error').html("Enter Lastname");
			return false;
		  }
		   else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			
		    $('#fname_error').html("");
			$('#lname_error').html("");
			$('#email_error').html("Enter Valid Email");
		  	return false;
		 }
		 else if ($('#password').val()=="")
		  {
		    $('#fname_error').html("");
			$('#lname_error').html("");
			$('#email_error').html("");
			
			$('#file_error').html("Enter Password");
			return false;
		  }
		  else if ($('#password').val().length<6)
		  {
		    $('#fname_error').html("");
			$('#lname_error').html("");
			$('#email_error').html("");
			
			$('#file_error').html("");
			$('#file_error').html("Password must contain 6 digits or characters.");
			return false;
		  }
		  else if ($('#password').val()!=$('#cpassword').val()) 
		  {
		    $('#fname_error').html("");
			$('#lname_error').html("");
			$('#email_error').html("");
			$('#file_error').html("");
			$('#cpassword_error').html("New Password and Confirm Password do not match");
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
			<h5>Enter Details To Signup</h5>
			<br>
			<?php if($msg){print $msg."<br><br>";}?>
				<form action="<?php echo base_url();?>register" id="register" name="register" method="post">
					<table>
						<tr>
							<td>First Name</td>
							<td><input type="text" name="fname" id="fname"></td><td><span style="color: red" id="fname_error"></span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><input type="text" name="lname" id="lname"></td><td><span style="color: red" id="lname_error"></span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td width="50%">Emailid</td>
							<td><input type="text" name="emailid" id="emailid"></td><td><span style="color: red" id="email_error"></span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="password" id="password"></td><td><span style="color: red" id="file_error"></span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Confirm Password</td>
							<td><input type="password" name="cpassword" id="cpassword"></td><td><span style="color: red" id="cpassword_error"></span></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						
						<tr>
							<td></td>
							<td><input type="submit" name="submit" value="Signup"></td>
							<td><a href="<?php echo base_url(); ?>">Signup With Facebook</a></td>
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
