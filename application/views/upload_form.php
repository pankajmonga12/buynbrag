<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html>
<head><title>JQuery - CodeIgniter File Upload Demo</title>
	<link href="<?php echo base_url()?>asset/style/ajaxfileupload.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url()?>asset/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>asset/js/ajaxfileupload.js"></script>
	<script type="text/javascript">
		function ajaxFileUpload() {
			$("#loading")
				.ajaxStart(function () {
					$(this).show();
				});
		.
			ajaxComplete(function () {
				$(this).hide();
			});
			$.ajaxFileUpload
			(
				{
					url: '<?php echo site_url()?>/image/do_upload',
					secureuri: false,
					fileElementId: 'fileToUpload',
					dataType: 'json',
					success: function (data, status) {
						if (typeof(data.error) != 'undefined') {
							if (data.error != '') {
								$("#info").html(data.error);
							} else {
								$("#info").html(data.msg);
							}
						}
					},
					error: function (data, status, e) {
						$("#info").html(e);
					}
				}
			)
			return false;
		}
	</script>
</head>
<body>
<div id="wrapper">
	<div id="content"><h1>JQuery - CodeIgniter File Upload Demo</h1>

		<p>Upload file using CodeIgniter File Uploading Class and JQuery</p>

		<p> Need any Web-based Information System?<br> Please <a href="http://www.putraweb.net/about">Contact Us</a><br>

		<form name="form" action="" method="POST" enctype="multipart/form-data">
			<table cellpadding="0" cellspacing="0" class="tableForm">
				<thead>
				<tr>
					<th>Please select a file and click Upload button</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td><input id="fileToUpload" type="file" size="45" name="fileToUpload" class="input"></td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td>
						<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">Upload</button>
					</td>
				</tr>
				</tfoot>
			</table>
		</form>
		<img id="loading" src="<?php echo base_url()?>asset/images/loading.gif" style="display:none;"/>

		<div id="info"></div>
	</div>
</body>
</html>