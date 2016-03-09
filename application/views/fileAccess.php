<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $function; ?></title></head>
<body style="margin-left: 180px; margin-right: 180px; margin-top: 8px;">
<div style="float: left;"><strong>Welcome Admin:</strong> <?php echo $this->session->userdata('adminId'); ?></div>
<div><span style="padding-left: 800px;"><a href="<?php echo $base_url . 'index.php/admin/logout'; ?>">Logout</a></span>
</div>
<hr>
<div> <?php for ($i = 1; $i < count($dmap); $i++) {
		echo $i . '. <a href="' . base_url('index.php/admin/downloadLogs/' . $dmap[$i]) . '" target="_blank">' . $dmap[$i] . '</a><br>';
	} ?> </div>
</body>
</html>