<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Upload Form</title></head>
<body> <?php echo form_open_multipart('image/do_upload');?> <input type="file" name="userfile" size="20"/> <br/><br/>
<input type="submit" value="upload"/> </form> </body>
</html>