<html>
<head>
	<script type="text/javascript">
		function SelfClose() {

			window.close();
		}

	</script>
</head>
<body>

<form name="frm" action="<?php print base_url();?>logistic/order_status_edit" method="post"
      onSubmit="window.opener.location.reload();">
	<p>
		<label>
			<input type="radio" name="RadioGroup1" value="pending" id="RadioGroup1"/>
			Pending</label>
		<br/>
		<label>
			<input type="radio" name="RadioGroup1" value="delievered" id="RadioGroup1"/>
			Delivered</label>
		<br/>


		<br/>
		<br/>
	</p>
	<input type="submit" name="button" id="button" value="Submit" align="centre" onClick="SelfClose();"/>
</form>
</body>
</html>