<html>
<head><title>Input1</title></head>
<body><h1>This page contains hidden Fields.</h1>

<form id="hidden" method="post" action="<?php echo $base_url; ?>index.php/test/submit"><input type="hidden" name="v1"
                                                                                              value="<?php echo $v1; ?>"/>
	<input type="hidden" name="v2" value="<?php echo $v2; ?>"/> <input type="hidden" name="v3"
	                                                                   value="<?php echo $v3; ?>"/> <input type="submit"
	                                                                                                       value="submit"/>
</form>
</body>
<script type="text/javascript">
	function myfunc() {
		var frm = document.getElementById("hidden");
		frm.submit();
	}
	window.onload = myfunc;
</script>
</html>