<html>
<head>
<title>Import CSV</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center" valign="top"><table width="100%" border="0">
<tr>
<td height="25" align="center" class="label">Import Csv</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="0">
<tr>
<td valign="top"><form action="<?php echo base_url(); ?>productscsv/upload" name="" method="post" enctype="multipart/form-data">
<table width="100%" border="1">
<tr>
<td width="30%" class="line2">File Name:</td>
<td width="70%" align="left" class="line2"><input type="file" name="files" id="files"></td>
</tr>
<tr>
<td class="line2">&nbsp;</td>
<td align="left" valign="middle" class="line2">&nbsp;<?php echo $msg;?></td>
</tr>
<tr><td class="line2">&nbsp;</td>
<td align="left" valign="middle" class="line2">
<input name="submit" type="submit" class="buttons" value="Submit" ></td>
</tr>
</table>


</form></td>
</tr>
</table></td>
</tr>
</table>
</body>
</html>