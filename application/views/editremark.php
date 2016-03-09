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
	<title>Edit Remark</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/product_page.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/store_page.css"/>
	<link rel="stylesheet" href="../assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="../assets/css/skeleton.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/>
	<![endif] -->
	<script type="text/javascript" src="../assets/js/libs/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">


		$(document).ready(function () {
			$("ul.tabs a").click(function () {
				$(".pane div").hide();
				$($(this).attr("href")).show();
			});
		})


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
			</a><a href="<?php echo base_url();?>logistic/logout"
			       style="margin-left:900px; margin-top:30px; color:#fff; font-size:16px;">Logout</a>

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
	<div style=" width:1024px; margin:20px auto; background-color:#fff; padding:20px;">
		<div align="center"><h1>Edit Remark</h1></div>
		<div align="center" style="margin:20px auto 0 auto; width:300px;">

		</div>
		<div class="tabox">
			<div class="pane">
				<div id="tab1">

					<table width="100%" border="0" cellspacing="0" cellpadding="0"
					       style="font-size:13px; font-family:Arial;" class="tabheadup">
						<form action="<?php print base_url();?>logistic/edit_remark/<?php echo $awbno['0']->awb_no;?>"
						      method="post">
							<tr class="tabhead">
								<td height="40" align="center" valign="middle">Airway Bill</td>
								<td height="40" align="center" valign="middle">Reference No</td>
								<td height="40" align="center" valign="middle">Attention</td>
								<td height="40" align="center" valign="middle">City/State</td>
								<td height="40" align="center" valign="middle">Contents</td>
								<td height="40" align="center" valign="middle">Weight(KG)</td>
								<td height="40" align="center" valign="middle">Product Type</td>
								<td height="40" align="center" valign="middle">Barcode</td>
								<td height="40" align="center" valign="middle">Order Status</td>
								<td height="40" align="center" valign="middle" name="remark">Remarks</td>
							</tr>

							<tr>
								<td height="40" align="center" valign="middle"><?php print $awbno['0']->awb_no; ?></td>
								<td height="40" align="center" valign="middle"><?php print $awbno['0']->txnid; ?></td>
								<td height="40" align="center"
								    valign="middle"><?php print $awbno['0']->buyer_name; ?></td>
								<td height="40" align="center" valign="middle"><?php print $awbno['0']->city; ?></td>
								<td height="40" align="center"
								    valign="middle"><?php print $awbno['0']->payment_mode; ?></td>
								<td height="40" align="center"
								    valign="middle"><?php print $awbno['0']->total_amount; ?></td>
								<td height="40" align="center" valign="middle"><img
										src="../assets/images/<?php print $awbno['0']->product_name; ?>" width="100"
										height="100"/></td>
								<td height="40" align="center" valign="middle"></td>
								<td height="40" align="center"
								    valign="middle"><?php print $awbno['0']->order_status; ?></td>
								<td height="40" align="center" valign="middle"><input type="text" name="remark"
								                                                      value='<?php print $awbno['0']->remark;?>'
								                                                      style="width:110px;"/></td>
							</tr>

							<tr style="background:#fff;">
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
								<td height="40" align="left" valign="middle">

									<input type="submit" value="Save Changes" style="margin:15px 0 0 0;"/></td>
							</tr>

							<script type="text/javascript">
								//If the Master checkbox is checked or unchchecked, process the following code
								$('#selectall').click(function () {

									if ($('#selectall').is(":checked")) {
										$('input[name="select1"]').each(function () {
											$(this).attr("checked", true);
										})
									}
									else {
										$('input[name="select1"]').each(function () {
											$(this).attr("checked", false);
										})
									}

								});

							</script>

						</form>
					</table>

				</div>
				<div id="tab2" style="display:none;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0"
					       style="font-size:13px; font-family:Arial;" class="tabheadup">
						<tr class="tabhead">

							<td height="40" align="center" valign="middle">All <input type="checkbox" name="selectall2"
							                                                          id="selectall2"/></td>
							<td height="40" align="center" valign="middle">Airway Bill</td>
							<td height="40" align="center" valign="middle">Order No</td>
							<td height="40" align="center" valign="middle">Attention</td>
							<td height="40" align="center" valign="middle">City/State</td>
							<td height="40" align="center" valign="middle">Contents</td>
							<td height="40" align="center" valign="middle">Weight(KG)</td>
							<td height="40" align="center" valign="middle">Product Type</td>
							<td height="40" align="center" valign="middle">Barcode</td>
							<td height="40" align="center" valign="middle">Order Status</td>
							<td height="40" align="center" valign="middle">Remarks</td>
						</tr>
						<tr>
							<td height="40" align="center" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
									type="checkbox" name="select2" id="select2"/></td>
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
							<td height="40" align="center" valign="middle"><input type="text" name="remarks"
							                                                      style="width:110px;"/></td>
						</tr>
						<tr style="background:#fff;">
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
							<td height="40" align="right" valign="middle"><input type="submit" value="Save Changes"
							                                                     style="margin:15px 0 0 0;"/></td>
						</tr>
						<script type="text/javascript">
							$('#selectall2').click(function () {

								if ($('#selectall2').is(":checked")) {
									$('input[name="select2"]').each(function () {
										$(this).attr("checked", true);
									})
								}
								else {
									$('input[name="select2"]').each(function () {
										$(this).attr("checked", false);
									})
								}

							});
						</script>

					</table>
					<!-- <div align="right"> <input type="submit" value="Save Changes" style="margin:15px 10px 0 0;"/><a href="<?php// echo base_url();?>logistic/exportPDF"><input type="submit" value="PDF Preview" style="margin:15px 0 0 0;"/></a></div>-->
				</div>

			</div>


		</div>

	</div>
</div>


</body>

</html>
