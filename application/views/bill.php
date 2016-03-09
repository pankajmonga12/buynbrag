<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Bill</title>
	<meta name="viewport" content="width=device-width">
    <?php require_once('stylesheets.php') ?>
	<link rel="stylesheet" type="text/css" href="/assets/css/bill.css"/>
	<script type="text/javascript" src="/assets/js/tooltip.js"></script>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body>
<input type="hidden" value="<?php echo $base_url; ?>" id="baseurl">
<input type="hidden" value="<?php echo $store_info[0]->store_id; ?>" id="store_id">
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="bannerHolder">
				<div class="bannerLogo"><img
						src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info[0]->store_id; ?>/top_banner.png"/>
				</div>
				<div class="bannerText newbannerText">
					<div class="bannerTextHolder newbannerTextHolder">
						<div class="bannerShopText">Shop URL :</div>
						<div class="bannerURLText"><?php echo $store_info[0]->store_url; ?></div>
					</div>
				</div>
				<div class="bannerIconsHolder">
					<div class="fancyHolder">
						<div class="fancyIcon"></div>
						<div class="fancyTextHolder">
							<div class="fancyNumber"><?php echo $store_info[0]->fancy_counter; ?></div>
							<div class="fancyText">fancied</div>
						</div>
					</div>
					<div class="fancyHolder">
						<div class="bragedIcon"></div>
						<div class="fancyTextHolder newfancyTextHolder1">
							<div class="fancyNumber"><?php echo $store_info[0]->brag_counter; ?></div>
							<div class="fancyText">braged</div>
						</div>
					</div>
					<div class="fancyHolder">
						<div class="viewedIcon"></div>
						<div class="fancyTextHolder newfancyTextHolder2">
							<div class="fancyNumber"><?php echo $store_info[0]->visit_counter; ?></div>
							<div class="fancyText">viewed</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
	<nav class="middleColumnTop">
		<div class="topDotSeparator newtopDotSeparator"></div>
		<div class="linksMiddle"><a
				href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info[0]->store_id; ?>">
				<div class="dashboardLink1">
					<div class="dashboardLogo1"></div>
					<div class="dashboardText1">Dashboard</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="productsLogo"></div>
					<div class="productsText">Products</div>
				</div>
			</a> <a href="">
				<div class="productsLink">
					<div class="designLogo"></div>
					<div class="productsText">Design</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/promote/add_promote_discount/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="promoteLogo"></div>
					<div class="productsText">Promote</div>
				</div>
			</a> <a
				href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink">
					<div class="storeLogo"></div>
					<div class="productsText">Store Profile</div>
				</div>
			</a> <a href="<?php echo $base_url; ?>index.php/bill/allbill/<?php echo $store_info[0]->store_id; ?>">
				<div class="productsLink1">
					<div class="billLogoHover"></div>
					<div class="productsText1">Bill</div>
				</div>
			</a></div>
		<div class="topDotSeparator newtopDotSeparator1"></div>
	</nav>
	<section class="middleBackground">
		<div class="tabsContainerBill">
			<div class="tabsContainerRelative">
				<div class="tabsLinksContainer">
					<div class="tabsLinksContainerTransparent"></div>
				</div>
				<div id="tab">
					<ul>
						<li style="display:none"><a href="#tab1">View full List</a></li>
						<li style="display:none"><a href="#tab2">View current</a></li>
						<!-- <div class="currentlyTextHolder">Currently showing 7/10</div>--> </ul>
					<div id="tab1">
						<div class="titleBackground">
							<div class="addProductsBackgroundTransparent"></div>
							<div class="titleBackgroundHolder">
								<div class="invoiceNumberHolder">Invoice Number</div>
								<div class="invoiceNumberHolder transactionHolder">Transactions</div>
								<div class="invoiceNumberHolder bnbCommission">BnB Commission</div>
								<div class="invoiceNumberHolder logisticsHolder">Logistics Fees</div>
								<div class="invoiceNumberHolder billAmountHolder">Bill Amount</div>
								<div class="invoiceNumberHolder closingBalanceHolder">Closing Balance</div>
								<div class="invoiceNumberHolder disputeBillHolder">Dispute Bill</div>
								<div class="pdfHolder"></div>
							</div>
						</div>
						<div class="stableGlassContainerHolder"
						     id="parent_product_0"> <?php $i = 0; $lastId = ""; foreach ($bill as $item): $i++;
								$lastId = $item->bill_id; ?>
								<div class="stableGlassContainerRelative message_box"
								     id="<?php echo $item->bill_id; ?>">
									<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
									<div class="stableGlassContainer1"
									     onMouseOver="return transparent(<?php echo $i + 1; ?>)"
									     onMouseOut="return norm(<?php echo $i + 1; ?>)">
										<div class="stableGlassRelative">
											<div class="invoiceNumberdetail"><?php echo $item->inv_number; ?>
												<div class="dateTextHolder">
													<div class="dateText">date</div>
													<div class="dateNumber"><?php echo $item->date_time; ?></div>
												</div>
											</div>
											<div class="transactionNumber"><?php echo $item->transaction; ?></div>
											<div class="transactionNumber transactionExtra"><span
													class="rupee">`</span><?php echo $item->bnb_commision; ?></div>
											<div class="transactionNumber logisticsExtra"><span
													class="rupee">`</span><?php echo $item->logistic_fee; ?></div>
											<div class="transactionNumber billAmountExtra"><span
													class="rupee">`</span><?php echo $item->bill_amt; ?></div>
											<div class="transactionNumber closingBalanceExtra"><span
													class="rupee">`</span><?php echo $item->closing_balance; ?></div>
											<div class="disputeBillIconHolder">
												<div title="Dispute Bill" class="disputeBillIcon showtooltip2"
												     onClick="return dispute(<?php echo $item->bill_id; ?>)"></div>
											</div>
											<div class="pdfIconHolder">
												<div class="pdfIcon"></div>
											</div>
										</div>
									</div>
								</div> <?php endforeach;?>
							<div class="slideBackground" id="slideBackground_1">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
					<div id="tab2">
						<div class="titleBackground">
							<div class="addProductsBackgroundTransparent"></div>
							<div class="titleBackgroundHolder">
								<div class="invoiceNumberHolder">Invoice Number</div>
								<div class="invoiceNumberHolder transactionHolder">Transactions</div>
								<div class="invoiceNumberHolder bnbCommission">BnB Commission</div>
								<div class="invoiceNumberHolder logisticsHolder">Logistics Fees</div>
								<div class="invoiceNumberHolder billAmountHolder">Bill Amount</div>
								<div class="invoiceNumberHolder closingBalanceHolder">Closing Balance</div>
								<div class="invoiceNumberHolder disputeBillHolder">Dispute Bill</div>
								<div class="pdfHolder"></div>
							</div>
						</div>
						<div class="stableGlassContainerHolder" id="parent_product_1">
							<div class="slideBackground" id="slideBackground_2">
								<div class="slideNormal"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?>
<div class="problemPopupContainer" id="problemPopupContainer">
	<div class="problemPopupRelative">
		<div class="problemPopupTransp"></div>
		<div class="problemPopupMiddle">
			<div class="headingAndClose">
				<div class="SendNoteHeading">Send a note to BnB</div>
				<div class="problemPopupClose"></div>
			</div>
			<div class="textAreaBox">
				<div class="problemTextareaMiddle"><textarea id="prob_textarea" class="problemTextareaMiddle"
				                                             placeholder="Please state your problem"></textarea></div>
			</div>
			<div class="problembottom">
				<div class="send_icon" id="send_note_to_bnb">Send</div>
				<div class="or_text">or</div>
				<div class="calling_text">Call</div>
				<div class="calling_icon">
					<div class="call_icon_image"></div>
					<div class="call_icon_text">+4407843555666</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/bill.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		function last_bill_funtion() {
			var ID = $(".message_box:last").attr("id");
			var baseUrl = $("#baseurl").val();
			var selected = $("#tab").tabs("option", "selected");
			var selectedTabTitle = $($("#tab li")[selected]).text();
			var type = 0;
			if (selectedTabTitle == "View full List") {
				type = 0;
			}
			else {
				type = 1;
			}
			$('div#slideNormal_1').html('<img src=' + baseUrl + 'assets/images/loader.gif>');
			$.ajax({
				url: baseUrl + 'index.php/bill/billAjaxLoader?status=' + type + '&limit=' + ID + '&store_id=' + <?php echo $store_info[0]->store_id?>+'',
				success: function (data) {
					if (data != "") {
						$(".message_box:last").after(data);
					}
					$('div#slideNormal_1').empty();
				}
			});
		};

		$(window).scroll(function () {
			if ($(window).scrollTop() == $(document).height() - $(window).height()) {
				last_bill_funtion();
			}
		});
	});
</script>
</html>