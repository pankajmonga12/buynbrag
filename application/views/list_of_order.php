<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html> <!--<![endif]-->
<head> 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Product Page</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/product_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/store_page.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/skeleton.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/>
	<![endif] -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function ()
	{
		$("ul.tabs a").click(function ()
		{
			$(".pane div").hide();
			$($(this).attr("href")).show();
		});
	});
	
	$(document).ready(function()
	{
		$(".id").change(function()
		{
			var id=$(this).val();
			var dataString = 'id='+ id;
			
			$.ajax(
			{
				type: "POST",
				url: "<?php print base_url();?>logistic/load",
				data: dataString,
				cache: false,
				success: function(html)
				{
					$(".store_id").html(html);
				}
			});
		});
	});
	
	function init()
	{
		document.getElementById("slide_upload_form").onsubmit=function()
		{
			document.getElementById("slide_upload_form").target = "iframe_upload_target";
			document.getElementById("iframe_upload_target").onload = uploadDone;
		};
	}
	window.onload=init;
	function uploadDone()
	{
		var ret = frames['iframe_upload_target'].document.getElementsByTagName("body")[0].innerHTML;
		var data = eval("("+ret+")"); 
		alert(data);
		if(data.error_msg == "null")
		{
			alert('Invalid Browse File...');
		}
	}
	
	$(document).ready(function()
	{
		$("ul.tabs a").click(function()
		{
			$(".pane div").hide();
			$($(this).attr("href")).show();
		});
	});
	
	function get_batch(id)
	{
		var datastring='store_id=' + id ;
		$.ajax(
		{
			type: "POST",
			url: "<?php print base_url() ?>logistic/get_batchId",
			data: datastring,
			success: function(data)
			{
				$('#store_id').html(data);
			}
		});
	}
	//]]>
	</script>

	<style>
		ul.tabs {
			display: table;
			list-style-type: none;
			margin: 0;
			padding: 0;

		}

		ul.tabs>li {
			float: left;
			padding: 10px;
			background-color: lightgray;
			border-right: 1px solid #fff;
			font-size: 13px;
			color: #333;
			font-family: Arial;
			min-width: 70px;
			text-align: center;

		}

		ul.tabs>li a {
			color: #333;
			text-decoration: none;

		}

		ul.tabs>li:hover {
			background-color: lightgray;
		}

		ul.tabs>li.selected {
			background-color: lightgray;
		}

		div.content {
			border: 1px solid black;
		}

		ul {
			overflow: auto;
		}

		div.content {
			clear: both;
		}

		.tabox {
			margin: 20px 0 0 0;
		}

		.select {
			height: 30px;
			width: 150px;
		}

		.tab1 {
		}

		.pane {
			margin: 0px;
			border-top: 1px solid #fff;
		}

		.tabheadup {
			background: #f9f9f9
		}

		.tabheadup tr:nth-child(2n) {
			background: #f1f1f1
		}

		.tabhead {
			background: #e5e5e5;
		}

		.tabhead td {
			border-right: 1px solid #fff;
		}

		h1 {
			font-family: Arial;
			color: #333;
		}

		input[type="submit"] {
			border: none;
			background: #999;
			color: #fff;
			border-radius: 7px;
			padding: 10px 15px;
			box-shadow: 2px 2px 1px #ccc;
			margin: 0px 0 0 0;
			font-weight: 600;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			box-shadow: none;
		}

		input[type="button"] {
			border: none;
			background: #999;
			color: #fff;
			border-radius: 7px;
			padding: 10px 15px;
			box-shadow: 2px 2px 1px #ccc;
			margin: 0px 0 0 0;
			font-weight: 600;
			cursor: pointer;
		}

		input[type="button"]:hover {
			box-shadow: none;
		}

		input[type="text"] {
			height: 25px;
			border: 1px solid #999;
		}
		
	</style>
</head>
<body style="background:#eee;">
<header class="header" onLoad>
	<div class="headerTop">
		<div class="headerContainer">
			<a href="javascript:void(0)">
				<div class="logo"></div>
			</a><a href="<?php echo base_url();?>logistic/logout" style="margin-left:900px; margin-top:30px; color:#fff; font-size:16px;">Logout</a>
		</div>
	</div>
	<div class="navigation">
		<nav class="navigationMiddle">

			<div class="navigationContainer">
				<div class="grey">

				</div>
			</div>
		</nav>
	</div>
</header>

<div class="wrapper" style="background:#eee;">
<div style=" width:auto; margin:20px auto; background-color:#fff; padding:20px;">
<div align="center"><h1>List of Order</h1></div>
<div align="center" style="margin:20px auto 0 auto; width:300px;">
<form action="<?php print base_url();?>logistic/searchdata" value="" name="search" method="post">
	Manifest Number :
	<select name="id" class="id" id="id" style= "height:30px; width:150px;">
		<option selected="selected">Select </option>
			<?php
				$sql = mysql_query("select store_id FROM batch");
				while($row = mysql_fetch_array($sql))
				{
					$id = $row['store_id'];
					echo '<option value="'.$id.'">'.$id.'</option>';	
				}
			?>
	</select>
<br/><br/>

Batch Number :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="store_id" class="store_id" style= "height:30px; width:150px;">
<option selected="selected">Select </option>
</select>
</br>
</br>
	<form action="<?php print base_url(); ?>logistic/searchdata" name="search" method="post">
		Manifest Number :
		<select name="id" class="id" id="id" style= "height:30px; width:200px;" onchange="get_batch(this.value)">
			<option selected="selected">Select Manifest Number</option>
				<?php 
				foreach($storeIDs as $storeID)
				{
				?>
					<option value="<?php print $storeID->store_id; ?>"><?php print $storeID->store_id;?></option>
				<?php
				}
				?>
		</select>
		<br/><br/>
		
		Batch Number :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="store_id" id="store_id" class="store_id" style= "height:30px; width:200px;">
			<option selected="selected">Select Batch Number</option>
		</select>
		</br>
		</br>
		<table style="margin-left: 75px;">
			<tr>
				<td><input type="submit" value="Search" name="submit"/></td>
			</tr>
		</table>
	</form>

</div>
<div style="margin-left:800px;margin-top:20px;">

<form action="<?php print base_url();?>logistic/uploadfile" name="" method="post" enctype="multipart/form-data" id="slide_upload_form">

<iframe id="iframe_upload_target" onload="uploadDone()" name="iframe_upload_target" src="" style="width:1px;height:1px;display:none"></iframe>
		
		<table style="margin-left:-800px;">
			<tr>
				<td><input type="file" value="upload file" name="files"/></td>
			</tr>
						<tr>
				<td><input type="submit" value="upload" name="submit"/></td>
			</tr>
		</table>
	</form>
	<form action="<?php print base_url(); ?>logistic/export" name="export" method="post">
		<table>
			<tr>
				<td>From:&nbsp;&nbsp;</td>
				<td><input type="text" name="from" id="from" placeholder="YYYY-MM-DD"></td>
				<td>To:&nbsp;&nbsp;</td>
				<td><input type="text" name="to" id="to" placeholder="YYYY-MM-DD"></td>
				<td><input type="submit" name="export" id="export" value="Export"></td>
			</tr>
		</table>
</div>
</form>
<div class="tabox">
	<ul class="tabs">
		<li><a href="#tab1">PREPAID</a></li>
		<li><a href="#tab2">COD</a></li>
		<li><a href="#tab3">SHIPPING LABEL</a></li>
	</ul>
	<div class="pane">
		<div id="tab1">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px; font-family:Arial;" class="tabheadup">
				<form name="form1" method="post" action="<?php print base_url();?>logistic/edit">	
					<tr class="tabhead">
						<td height="40" align="center" valign="middle">All <input type="checkbox" name="selectall1" id="selectall1"/></td>
						<td height="40" align="center" valign="middle">Airwaybill</td>
						<td height="40" align="center" valign="middle">Order Number</td>
						<td height="40" align="center" valign="middle">Customer Name</td>
						<td height="40" align="center" valign="middle">City/State</td>
						<td height="40" align="center" valign="middle">Contents</td>
						<td height="40" align="center" valign="middle">Weight(KG)</td>
						<td height="40" align="center" valign="middle">Product Type</td>
						<td height="40" align="center" valign="middle">Barcode</td>
						<td height="40" align="center" valign="middle">Order Status</td>
						<td height="40" align="center" valign="middle" name="remark">Remarks</td>
						<td height="40" align="center" valign="middle" name="">Action</td>
					</tr>
					<?php
					foreach ($result as $detail)
					{
					?>
						<tr>
								
							<td height="40" align="center" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="id[]" value="<?php echo $detail->awb_no; ?>" id="id<?php echo $detail->awb_no; ?>"/>
							</td>
							<td height="40" align="center" valign="middle"><?php print $detail->awb_no; ?></td>
							<td height="40" align="center" valign="middle"><?php print $detail->txnid; ?></td>
							<td height="40" align="center" valign="middle"><?php print $detail->buyer_name; ?></td>
							<td height="40" align="center" valign="middle"><?php print $detail->city; ?></td>
							<td height="40" align="center" valign="middle"><?php print $detail->payment_mode; ?></td>
							<td height="40" align="center" valign="middle"><?php print $detail->total_amount; ?></td>
							<td height="40" align="center" valign="middle">
								<img src="../assets/images/<?php print $detail->product_name; ?>" width="100" height="100"/>
							</td>
							<td height="40" align="center" valign="middle" >
								<img src="<?php print base_url();?>barcode/<?php print $detail->txnid;?>_<?php print $detail->order_id;?>.png" width="150" height="80"/>
							</td>
							<td height="40" align="center" valign="middle">
							<?php
							$ab = $detail->order_status;
							$fileName = NULL;
							if ($ab == "Pending")
							{
								$fileName = "pending.png";
							}
							if($ab == "Start Processing")
							{
								$fileName = "process.png";
							}
							if($ab == "Shipping")
							{
								$fileName = "shipping.png";
							}
							if($ab == "Delivered")
							{
								$fileName = "completed.png";
							}
							if($ab == "Cancel Order")
							{
								$fileName = "cancelled.png";
							}
							if($ab == "Problem With Order")
							{
								$fileName = "problem.png";
							}
							?>
							<img src="<?php print base_url()."assets/images/".$fileName.".png"; ?> height="80" width="80"/>
							</td>
						</tr>
					<?php
					}
					foreach($orderDetailsPrepaid as $detail)
					{
					?>
					<tr>
							
						<td height="40" align="center" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="id[]" value="<?php echo $detail->order_id; ?>" id="id<?php echo $detail->order_id; ?>"/>
						</td>
						<td height="40" align="center" valign="middle"><?php print $detail->awb_no; ?></td>
						<td height="40" align="center" valign="middle"><?php print $detail->order_id; ?></td>
						<td height="40" align="center" valign="middle"><?php print $detail->shipping_fname." ".$detail->shipping_lname; ?></td>
						<td height="40" align="center" valign="middle"><?php print $detail->shipping_city; ?></td>
						<td height="40" align="center" valign="middle"><?php print $detail->pg_type; ?></td>
						<td height="40" align="center" valign="middle"><?php //print $detail->total_amount; ?></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle" >
							<img src="<?php print base_url();?>barcode/<?php print $detail->txnid;?>_<?php print $detail->order_id;?>.png" width="150" height="80"/>
						</td>
						<td height="40" align="center" valign="middle">
							<?php
							$ab = $detail->status_order;
							if($ab ==1)
							{
							?>
								<img src="<?php print base_url();?>assets/images/pending.png" height="80" width="80"/>
							<?php
							}
							
							if($ab ==2)
							{
							?>
								<img src="<?php print base_url();?>assets/images/process.png" height="80" width="80"/>
							<?php
							}
							
							if($ab ==3)
							{
							?>
								<img src="<?php print base_url();?>assets/images/shipping.png" height="80" width="80"/>
							<?php
							}
							if($ab ==4)
							{
							?>
								<img src="<?php print base_url();?>assets/images/completed.png" height="80" width="80"/>
							<?php
							}
							?>
							<?php
							if($ab ==5)
							{
							?>
								<img src="<?php print base_url();?>assets/images/cancelled.png" height="80" width="80"/>
							<?php
							}
							
							$ab = $detail->status_order;
							if($ab ==6)
							{
							?>
								<img src="<?php print base_url();?>assets/images/problem.png" height="80" width="80"/>
							<?php
							}
							?>
							</td>
							<td height="40" width="150" valign="middle">
								<input type="text" name="remark<?php echo $detail->awb_no; ?>" id="remark<?php echo $detail->awb_no; ?>" value="<?php echo $detail->remark; ?>" style="width:auto;"/>
							</td>
							<td height="40" width="150" valign="middle">
								<select style="height:25px;" name="action<?php echo $detail->awb_no; ?>"
								        id="action<?php echo $detail->awb_no; ?>">
									<option <?php $abc = $detail->order_status;if ($abc == 'Start Processing') { ?> selected="selected"<?php } ?>>
										Start Processing
									</option>
									<option <?php $abc = $detail->order_status;if ($abc == 'Pending') { ?> selected="selected"<?php } ?>>
										Pending
									</option>
									<option <?php $abc = $detail->order_status;if ($abc == 'Shipping') { ?> selected="selected"<?php } ?>>
										Shipping
									</option>
									<option <?php $abc = $detail->order_status;if ($abc == 'Delivered') { ?> selected="selected"<?php } ?>>
										Delivered
									</option>
									<option <?php $abc = $detail->order_status;if ($abc == 'Cancel Order') { ?> selected="selected"<?php } ?>>
										Cancel Order
									</option>
									<option <?php $abc = $detail->order_status;if ($abc == 'Problem With Order') { ?> selected="selected"<?php } ?>>
										Problem With Order
									</option>
								</select>
							</td>
						</tr>
					
					<?php 
					}
					?>
					

					<tr style="background:#fff;">
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle">
							<!--<img src="../assets/images/promote_image5.png"/>--></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						<td height="40" align="center" valign="middle"></td>
						
						<td height="40" align="right" valign="middle">

							<input type="submit" value="Save Changes" name="Submit" id="Submit"
							       style="margin:15px 0 0 0;"/></td>

					</tr>
				</form>
				<div id="search_results"></div>
					            
				<script type="text/javascript">
					//If the Master checkbox is checked or unchchecked, process the following code
					$('#selectall1').click(function () {

						if ($('#selectall1').is(":checked")) {
							$('input[name="id[]"]').each(function () {
								$(this).attr("checked", true);
							})
						}
						else {
							$('input[name="id[]"]').each(function () {
								$(this).attr("checked", false);
							})
						}

					});

				</script>


			</table>

		</div>
		<div id="tab2" style="display:none;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:13px; font-family:Arial;"
			       class="tabheadup">
				<tr class="tabhead">
					<td height="40" align="center" valign="middle">All <input type="checkbox" name="selectall2"
					                                                          id="selectall2"/></td>
					<td height="40" align="center" valign="middle">Airwaybill</td>
					<td height="40" align="center" valign="middle">Order Number</td>
					<td height="40" align="center" valign="middle">Attention</td>
					<td height="40" align="center" valign="middle">City/State</td>
					<td height="40" align="center" valign="middle">Contents</td>
					<td height="40" align="center" valign="middle">Weight(KG)</td>
					<td height="40" align="center" valign="middle">Product Type</td>
					<td height="40" align="center" valign="middle">Barcode</td>
					<td height="40" align="center" valign="middle">Order Status</td>
					<td height="40" align="center" valign="middle" name="remark">Remarks</td>
					<td height="40" align="center" valign="middle" name="">Action</td>
				</tr>

				<tr>

					<td height="40" align="center" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
					                                                                                    name="select2[]"
					                                                                                    value="<?php echo $detail->awb_no; ?>"
					                                                                                    id="select1"/>
					</td>
                 <?php
                 foreach($orderDetailsCOD as $d)
                 {
                 ?>
				<tr>
					<td height="40" align="center" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="select2[]" value="<?php echo $detail->order_id; ?>" id="select1"/>
					</td>
					<td height="40" align="center" valign="middle"><?php print $d->awb_no; ?></td>
					<td height="40" align="center" valign="middle"><?php print $d->order_id; ?></td>
					<td height="40" align="center" valign="middle"><?php print $d->shipping_fname." ".$detail->shipping_lname; ?></td>
					<td height="40" align="center" valign="middle"><?php print $d->shipping_city; ?></td>
					<td height="40" align="center" valign="middle"><?php print $d->pg_type; ?></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>

					<td height="40" width="150" valign="middle"><input type="text" name="remark" value=''
					                                                   style="width:auto;" readonly/></td>
					<td height="40" width="150" valign="middle"><select style="height:25px;">
							<option>Start Processing</option>
							<option>Pending</option>
							<option>Shipping</option>
							<option>Delivered</option>
							<option>Cancel Order</option>
							<option>Problem With Order</option>
						</select></td>

					<td height="40" align="center" valign="middle"></td>
				</tr>
				<?php
				}
				?>
				<tr style="background:#fff;">
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle">
						<!--<img src="../assets/images/promote_image5.png"/>--></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="center" valign="middle"></td>
					<td height="40" align="right" valign="middle"><a href="<?php echo base_url();?>logistic/exportPDF">

							<input type="button" value="Save Changes" style="margin:15px 0 0 0;"/></a></td>

				</tr>
    
    
				<script type="text/javascript">
					$('#selectall2').click(function () {

						if ($('#selectall2').is(":checked")) {
							$('input[name="select2[]"]').each(function () {
								$(this).attr("checked", true);
							})
						}
						else {
							$('input[name="select2[]"]').each(function () {
								$(this).attr("checked", false);
							})
						}

					});
				</script>

			</table>
		</div>
					
		

	</div>


</div>

</div>
</div>


</body>

</html>