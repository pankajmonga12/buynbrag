<html>
<head>
	<script type="text/javascript">
		function SelfClose() {

			window.close();
		}
	</script>
</head>

<body>
<form action="<?php print base_url();?>logistic/order_info_edit" method="post" name="frm1"
      onSubmit="window.opener.location.reload();">
	<table width="857" height="100" border="1">
		<tr>
			<td width="119" height="45">Airway bill number</td>
			<td width="87"> Order ID</td>
			<td width="130">Date of Order(GMT)</td>
			<td width="93">Total Wt(kg)</td>
			<td width="117">Product Information</td>
			<td width="69">Quantity</td>
			<td width="196">Order Status</td>
		</tr>


		<?php
		foreach ($order_details1 as $item) ;
		{
		?>
		<tr>
			<td height="47"><?php echo $item->awb_no;?></td>
			<td><?php echo $item->order_id;?></td>
			<td><?php echo $item->order_date_IST;?></td>
			<td><input type="text" name="total" value="<?php echo $item->total_amount;?>"/><br/></td>
			<td><img src="../assets/images/<?php echo $item->product_name;?>"/></td>
			<td><input type="text" name="quantity" value="<?php echo $item->quantity;?>"/><br/></td>
			<td><?php echo $item->order_status;?></td>
		</tr>
	</table>

	<?php     $order_details1--;}?>                             <!--    <label for="subject" id="subject_label">Airway Bill no</label><br>
									 <input type="text" name="awb_no" id="subject"
									value="<?php// print $edit_details["0"]->awb_no;?>"class="text-input" />
									<br> <label for="msg" id="msg_label">Order Id
									</label> <input type="text" name="order_id" id="order_id"
									value="<?php// print $edit_details["0"]->order_id;?>"
									class="text-input" /> <br>
									 <label for="" id="msg_label">Date Of Order(GMT)
									</label> <input type="text" name="order_date_IST" id="" value="<?php// print $edit_details["0"]->order_date_IST;?>"
									class="text-input" /> <br>
  									<label for="" id="msg_label">Total Weight(kg)
									</label> <input type="text" name="total_amount" id="" value="<?php// print $edit_details["0"]->total_amount;?>"
									class="text-input" /> <br>	
  									<label for="" id="msg_label">Product Information
									</label> <input type="text" name="product_name" id="" value="../assets/images<?php// print $edit_details["0"]->product_name;?>"
									class="text-input" /> <br>	-->

	<input type="hidden" name="awb" value="<?php echo $i;?>"/>
	<input type="submit" name="update" id="button" value="Submit" align="centre" onClick="SelfClose();"/>

</form>
</body>
</html>