<html>
<head>
	<title>result page</title>
		
</head>	
 <body>
	<p><?php echo  (($isCached === TRUE)? "Data from cache.": "Data from DB"); ?></p>
	<p><?php echo  (($savedCache === TRUE)? "Data saved to cache.": "Unable to save data into cache"); ?></p>
	<p><?php echo  (($checkCache === FALSE)? "Read from DB": "Data returned from cache before reading from DB. DB Skipped"); ?></p>

	<p><?php echo  "\$isCached = ".json_encode($isCached); ?></p>
	<p><?php echo  "\$savedCache = ".json_encode($savedCache); ?></p>
	<p><?php echo  "\$checkCache = ".json_encode($checkCache); ?></p>

 	<form method = "post" action = "<?php echo $baseURL."searcha/testExecute"; ?>">
		<input type = "text" name = "term" value="<?php echo $keyword; ?>">
		<input type = "submit">enter some text</input>
	</form>
	<!-- <pre><?php print_r($output); ?></pre> -->
	<table>
	 	<?php
		 	$storeURL = "http://buynbragstores.s3.amazonaws.com/assets/images/stores/";
		 	foreach($output as $result)
		 	{
		 		echo "<tr><td><img src=\"".$storeURL.$result->storeID."/".$result->productID."/img1_240x200.jpg\"></td>";
		 		echo "<td><strong>".$result->productName."</strong> <i>by <em>".$result->storeName."</em></i><br>Viewed ".$result->productVisitCounter."times&nbsp;&nbsp;&nbsp;Bragged ".$result->productBragCounter." times</td></tr>";
		 	}
	 	?>
	</table>
	<p>Elapsed time {elapsed_time} seconds</p>
	<p>Memory Used {memory_usage}</p>
</body>
</html>

