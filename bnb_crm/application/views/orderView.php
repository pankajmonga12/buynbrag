<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>INVOICE</title>
    <style type = "text/css">
 	tr:nth-child(even) {
    background: #CCC;
    }
    </style>   
</head>
<body>
	<table>
		<p style = "font-family:tahoma;color:#808080;text-align:center;font-size:25px">INVOICE</p>
		<img src = "/Application/XAMPP/xamppfiles/htdocs/welcome/assets/404_logo_145.png" width ="250" height = "100" style ="margin-left:100px">
		<table style ="width:90%;margin-left:60px">
			<tr>
			<td style = "font-family:tahoma">Social Scientist E-commerce Pvt Ltd</td>
			<td style = "font-family:tahoma">INVOICE NO:<?php echo $base[0]['txnid'];?></td>
			</tr>
			<tr>
			<td style = "font-family:tahoma;length">IQR|4th Floor|Plot no.21,22|Udyog Vihar|Phase 4|Gurgaon.</td>
			<td style = "font-family:tahoma">ORDER DATE:<?php $date = date_create($base[0]['date_of_order']);
           $orderDate = date_format($date, ' l jS F Y');echo $orderDate;?></td>
			</tr>
		</table>
		<table style = "margin-top:30px;border: 1px solid black;border-collapse:collapse;width:90%;margin-left:60px">
			<tr >
				<td style = "font-family:tahoma;text-align:center;border: 1px solid black">Billing Address</td>
				<td style = "font-family:tahoma;text-align:center;border: 1px solid black">Shipping Address</td>
			</tr>
			<tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_fname'].'&nbsp;'.$base[0]['shipping_lname'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_fname'].'&nbsp;'.$base[0]['shipping_lname'];?></td>
 		    </tr>
 		    <tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_address'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_address'];?></td>
 		    </tr>
      		<tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_city'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_city'];?></td>
 		    </tr>
 		    <tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_state'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_state'];?></td>
 		    </tr>
 		    <tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_country'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_country'];?></td>
 		    </tr>
 		    <tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_pincode'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_pincode'];?></td>
 		    </tr>
 		    <tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_phoneno'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_phoneno'];?></td>
 		    </tr>
 		    <tr>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_emailid'];?></td>
 			    <td style = "font-family:arial;border: 1px solid black"><?php echo $base[0]['shipping_emailid'];?></td>
 		    </tr>
		</table>
		<table style ="margin-top:30px;border: 1px solid black;border-collapse:collapse;width:90%;margin-left:60px">
			<tr>
				<td style = "font-family:tahoma;border: 1px solid black">SELLER'S NAME</td>
				<td style = "font-family:tahoma;border: 1px solid black">SELLER'S ADDRESS</td>
				<td style = "font-family:tahoma;border: 1px solid black">ORDER NO</td>
				<td style = "font-family:tahoma;border: 1px solid black">VAT REG NO</td>
				<td style = "font-family:tahoma;border: 1px solid black">PAN NO</td>
				<td style = "font-family:tahoma;border: 1px solid black">TIN NO</td>
			</tr>

		<?php
		for ($i=0; $i <count($base) ; $i++)
		{  
    	?>
    	    <tr>
				<td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['contact_name'];?></td>
				<td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['communication_address'];?></td>
				<td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['order_id'];?></td>
				<td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['vat_no'];?></td>
				<td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['pan_no'];?></td>
				<td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['tin_no'];?></td>
			</tr>
			<?php } ?>
	    </table>
	     <table style ="margin-top:30px;border: 1px solid black;border-collapse:collapse;width:90%;margin-left:60px">
	    	<tr>
	    		<td style = "font-family:tahoma;border: 1px solid black">S/NO</td>
	    	    <td style = "font-family:tahoma;border: 1px solid black">PRODUCT NAME</td>
	    	    <td style = "font-family:tahoma;border: 1px solid black">PRODUCT CODE</td>
	    	    <td style = "font-family:tahoma;border: 1px solid black">QUANTITY</td>
	    	    <td style = "font-family:tahoma;border: 1px solid black">PRICE</td>
	    	    <td style = "font-family:tahoma;border: 1px solid black">COUPON VALUE</td>
	    	    <td style = "font-family:tahoma;border: 1px solid black">COD CHARGES</td>
	    	    <td style = "font-family:tahoma;border: 1px solid black">AMOUNT</td>
	    	</tr>
	    	<?php
		for ($i=0; $i <count($base) ; $i++)
		{  
    	   $selling_price = $base["$i"]['amt_paid'];
    	   $quantity = $base["$i"]['quantity'];
           $subTotal = $selling_price;
           if(!empty($base["$i"]['redeemedprice'])&& $base["$i"]['redeemedprice']>0) 
    	   {
	        $subTotal -= $base["$i"]['redeemedprice'];
	        $couponDiscount = $base["$i"]['redeemedprice'];
	       }
	       else
	       {
	       	$couponDiscount = "No Coupons Applied";
	       }
    	   if($base["$i"]['payment_status']==2) 
    	   {
    		$codCharges = 50;
    		$Total = ($subTotal * $quantity)+50;
    	   }
    	   else 
    	   {
    		$codCharges = "NONE";
    		$Total = $subTotal * $quantity;
    	   }
    	   $grandTotal +=$Total;
    	   ?>
    	   <tr>
    	   	  <td style = "font-family:arial;border: 1px solid black"><?php echo $i;?></td>
	    	  <td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['product_name'];?></td>
	    	  <td style = "font-family:arial;border: 1px solid black"><?php echo $base["$i"]['bnb_product_code'];?></td>
	    	  <td style = "font-family:arial;border: 1px solid black"><?php echo $quantity;?></td>
	    	  <td style = "font-family:arial;border: 1px solid black"><?php echo $subTotal*$quantity;?></td>
	    	  <td style = "font-family:arial;border: 1px solid black"><?php echo $couponDiscount;?></td>
	    	  <td style = "font-family:arial;border: 1px solid black"><?php echo $codCharges;?></td>
	    	  <td style = "font-family:arial;border: 1px solid black"><?php echo $Total;?></td>
	    	</tr>
	    	<?php } ?>
	    </table>
	          <p style = "margin-left:900px; margin-top:20px;font-family:tahoma;">Total Amount to be Paid: Rs. <?php echo $grandTotal;?></p>
              <p style = "margin-left:220px; margin-top:40px;font-family:tahoma;">We hope you love what you bought!</br>If you have any concern, please contact our customer care team at +91-8130878822. Send us a text or give us a missed call.</p>
              <p style = "margin-left:220px;font-family:tahoma;">Mon-Fri,10am to 6:30 pm,or email us at talktous@buynbrag.com<p>
		</table>
</body>
</html>

