<body> <?php /* echo $result[0]->product_name; */ echo '<br>'; for ($i = 0; $i < count($result); $i++) {
	echo 'Title: ' . $result[$i]->product_name . '<br>';
	echo 'Quantity: ' . $result[$i]->quantity . '<br>';
	echo 'Price: ' . $result[$i]->selling_price . '<br>';
	echo 'Shipping: ' . $result[$i]->shipping_cost . '<br>';
	echo 'Status: ' . $result[$i]->status . '<br><br>';
} ?> </body>