<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Calendar</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<style type="text/css">
		.soldOut {
			position: absolute;
			top: 4px;
			left: 4px;;
			background-image: url("<?php echo $base_url; ?>assets/images/soldout.png");
			width: 100px;
			height: 70px;
		}

		.paddingMore {
			left: 12px !important;
		}

			/* Added by shammi for calendar table */
		.calendarTable {
			width: 996px;
			height: 344px;
			/* background-color: #f2f0f3; */
			background-color: #f0f1f3;
			/* border-collapse: collapse; */
			border: 5px solid #f0f1f3;
		}

		.calendarTable TD {
			position: relative;
			width: 136px;
			height: 112px;
			background-color: #d9d9d9;
			color: #c7c7c7;
			border: 5px solid #f0f1f3;
		}

		.calendarTable TD .dateDivBlanker {
			position: relative;
			top: 0;
			left: 0px;
			height: 60px;
			width: 100%;
		}

		.calendarTable TD .dateDiv {
			position: relative;
			bottom: 0;
			right: 12px;
			float: right;
		}

		.calendarTable TD .dayName {
			font-size: 12px;
			color: #c7c7c7;
		}

		.calendarTable TD .date {
			font-size: 24px;
			color: #c7c7c7;
		}

			/* Added by shammi for calendar table */
	</style>
	<!-- for view.js <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/alt2.css" /> <script src="<?php echo $base_url; ?>assets/js/newview.js?auto"></script>-->
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->
	<style>
		<?php echo $style; ?>
	</style>
</head>
<body>
<script type="text/javascript">
	//<![CDATA[
	//alert(navigator.appName + "<<||>>" + navigator.userAgent);
	var ua = new String(navigator.userAgent);
	var browser = null;
	if (ua.indexOf("Chrome") != -1)
		browser = "GC"; // google chrome
	if (ua.indexOf("Firefox") != -1)
		browser = "FF"; // firefox
	if (ua.indexOf("MSIE") != -1)
		browser = "IE"; // internet explorer
	if (ua.indexOf("Opera") != -1)
		browser = "OP"; // opera
	//alert("Browser Code: " + browser);
	//]]>>
</script>
<section class="wrapper">
	<nav class="middleColumnTop">
		<div class="middleColumnIE">
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="linksMiddle"></div>
			<div class="topDotSeparator newtopDotSeparator1"></div>
		</div>
	</nav>
	<section class="middleBackground">
		<div class="Ie8bg">
			<div class="topDotSeparator topSeparatorStyle"></div>
			<div class="storeMiddleBackgroundContainer">
				<div class="panelContainer">
					<!-- <div class="leftPanel leftPanelNewHeight"> <div class="leftPanelCategory">Categories</div> </div> -->
					<!-- <div class="panelSeparator seperator_new_style"></div> -->
					<div class="rightPanel"> <!-- <div class="trendingNewText">Trending Now</div> -->
						<div id="main_products" class="scrollerHolder"
						     style="width: 1020px; height: 303px; overflow: hidden;"></div>
					</div>
				</div>
				<div class="topScrollerSeparator clear_both"></div>
				<!-- <div class="trendingNewText topStoresStyle">Top Stores</div> -->
				<div id="main_stores" class="scrollerHolder2"
				     style="width: 1014px; height: 385px; padding: 18px 0 18px 20px; border: 1px solid #ECDEE6; display: block; background-color: #f2f0f3">
					<table border="1" class="calendarTable">
						<tr>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">SUN</div>
									<div class="date">9</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">MON</div>
									<div class="date">10</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">TUE</div>
									<div class="date">11</div>
								</div>
							</td>
							<td><a class="dateDiv" href="<?php echo $base_url . 'index.php/contest/christmas/12' ?>">
									<div class="dateDivBlanker"></div>
									<div class="dayName">WED</div>
									<div class="date">12</div>
								</a></td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">THU</div>
									<div class="date">13</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">FRI</div>
									<div class="date">14</div>
								</div>
							</td>
							<td><a class="dateDiv" href="<?php echo $base_url . 'index.php/contest/christmas/15' ?>">
									<div class="dateDivBlanker"></div>
									<div class="dayName">SAT</div>
									<div class="date">15</div>
								</a></td>
						</tr>
						<tr>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">SUN</div>
									<div class="date">16</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">MON</div>
									<div class="date">17</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">TUE</div>
									<div class="date">18</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">WED</div>
									<div class="date">19</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">THU</div>
									<div class="date">20</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">FRI</div>
									<div class="date">21</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">SAT</div>
									<div class="date">22</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">SUN</div>
									<div class="date">23</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">MON</div>
									<div class="date">24</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">TUE</div>
									<div class="date">25</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">WED</div>
									<div class="date">26</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">THU</div>
									<div class="date">27</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">FRI</div>
									<div class="date">28</div>
								</div>
							</td>
							<td>
								<div class="dateDiv">
									<div class="dateDivBlanker"></div>
									<div class="dayName">SAT</div>
									<div class="date">29</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="topScrollerSeparator clear_both"></div> <?php include "footer.php" ?>
</body>
<script type="text/javascript">
	var totalScroll = 0;

	$(".button_left_style").click(function () {
		var rightArrowShow = $(".button_right_style").css('display');
		if (rightArrowShow == 'none')
			$(".button_right_style").css('display', 'block');

		//alert(totalScroll);
		if (totalScroll <= 735) {
			$(".button_left_style").css('display', 'none');
		}
		if (totalScroll <= 0) return;
		totalScroll = totalScroll - 760;
		$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
	});

	$(".button_right_style").click(function () {

		var x =<?php echo ceil(count($products)/3); ?>;
		if (x == 1) {
		} else {
			var rightArrowShow = $(".button_left_style").css('display');
			if (rightArrowShow == 'none')
				$(".button_left_style").css('display', 'block');
			maxScroll = parseInt($(".slider").css("width")) - parseInt($(".sliderParentDiv").width());
			if (totalScroll > maxScroll) {
				$(".button_right_style").css('display', 'none');
				return
			}
			;
			totalScroll = totalScroll + 760;
			$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
			var totalWidth = x * 760;
			$("#slider").css("width", totalWidth + "px");
		}
	});

	var totalScroll2 = 0;

	$(".button_left_style2").click(function () {
		if (totalScroll2 <= 0) return;
		totalScroll2 = totalScroll2 - 768;
		$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
	});

	var x2 =<?php echo ceil(count($store)/2); ?>;
	var totalWidth2 = x2 * 768;
	$("#slider2").css("width", totalWidth2 + "px");
	$(".button_right_style2").click(function () {
		if (x2 == 1) {
		} else {
			maxScroll = parseInt($(".slider2").css("width")) - parseInt($(".sliderParentDiv2").width());
			if (totalScroll2 > maxScroll) return;
			totalScroll2 = totalScroll2 + 768;
			$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
		}
	});

	var totalScroll3 = 0;

	$(".button_left_style3").click(function () {
		if (totalScroll3 <= 0) return;
		totalScroll3 = totalScroll3 - 768;
		$('.sliderParentDiv3').animate({scrollLeft: totalScroll3}, 1550);
	});
	var x3 =<?php echo ceil(count($store)/2); ?>;
	var totalWidth3 = x3 * 768;
	$("#slider3").css("width", totalWidth3 + "px");
	$(".button_right_style3").click(function () {
		if (x3 == 1) {
		} else {
			maxScroll = parseInt($(".slider2").css("width")) - parseInt($(".sliderParentDiv3").width());
			if (totalScroll3 > maxScroll) return;
			totalScroll3 = totalScroll3 + 768;
			$('.sliderParentDiv3').animate({scrollLeft: totalScroll3}, 1550);
		}
	});
</script>
<script type="text/javascript">
	$(function () {

		$('li').click(function () {
			var ids = $(this).attr('id');
			var ids2 = $(this).attr('sss_id');
			$(this).css('color', '#da3c63').siblings().css("color", "#666");
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod/" + ids2 + "/3",
				success: function (data) {
					$('#main_products').html(data);
				}
			});
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/tree_products/sub_stores/" + ids2 + "/3",
				success: function (data) {
					$('#main_stores').html(data);
				}
			});
		});

	});

	function AddPoll(pid) {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/add_to_poll/" + pid,
			success: function (data) {
			}

		});

		$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');

		$("#fancyPopup").dialog({
			width: 605,
			height: 293,
			modal: true,
		});
		$(".width_style_fancy").click(function () {
			$("#fancyPopup").dialog('close');
		});
	}
	function panelCategories(id, sc_id) {

		$('li').css('color', '#666');
		for (var i = 1; i <=<?php echo $ii; ?>; i++) {
			if (i == id) {
				if ($("#sub_category" + i).css('display') != 'block') {
					$("#sub_category" + i).show();
					$("#category" + i).css("color", "#333");
				} else {
					$("#sub_category" + i).hide();
					$("#category" + i).css("color", "#333");
				}
			} else {
				$("#sub_category" + i).hide();
				$("#category" + i).css("color", "#333");
			}
		}
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod/" + sc_id + "/1",
			success: function (data) {
				$('#main_products').html(data);
			}
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/tree_products/sub_stores/" + sc_id + "/1",
			success: function (data) {
				$('#main_stores').html(data);
			}
		});

	}

	function subCategories(id, ssc_id) {
		for (var i = 1; i <=<?php echo $jj; ?>; i++) {
			if (i == id) {
				if ($("#subSubCategory_" + i).css('display') != 'block') {
					$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
					$("#subCategory_" + i).css("color", "#333");
					$("#subSubCategory_" + i).show();
				} else {
					$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
					$("#subCategory_" + i).css("color", "#666");
					$("#subSubCategory_" + i).hide();
				}

			} else {
				$("#icon_" + i).css({"background-image": "url('<?php echo $base_url; ?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
				$("#subCategory_" + i).css("color", "#666");
				$("#subSubCategory_" + i).hide();
			}
		}
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod/" + ssc_id + "/2",
			success: function (data) {
				$('#main_products').html(data);
			}
		});
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/tree_products/sub_stores/" + ssc_id + "/2",
			success: function (data) {
				$('#main_stores').html(data);
			}
		});

	}
</script>
<script>
	$(".fancyHolder").each(function () {

		var r = $(this).children(".hiddenFieldDiv1").val();
		var store_id = $(this).children(".hiddenFieldStoreid").val();
		var product_id = $(this).children(".hiddenFieldProductid").val();
		$(this).click(function () {
			var z = $(this).children(".hiddenFieldDiv1").val();
			if ($(this).children(".hoverText").html() == 'FANCY') {
				$("#FancyPopupContainer").dialog({
					width: 738,
					height: 510,
					modal: true
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop1?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);

						var myPname = $('#productNameD_' + product_id).html();
						$('.myProductName').html(myPname);

						var mySname = $('#storeNameD_' + store_id).html();
						$('.myStoreName').html(mySname);

						$("#f_img").attr('src', '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg');
						<?php /*?>document["f_img"].src='<?php echo $store_url; ?>assets/images/stores/'+store_id+'/'+product_id+'/img1_product.jpg';<?php */?>
						$('#popup_category').html(data);
					}
				});
				$('#checkboxesHolder1').jScrollPane({
					showArrows: false,
					animateScroll: true,
					maintainPosition: false
				});
			}
			else if ($(this).children(".hoverText").html() == 'EDIT') {
				$("#EditPopupContainer").dialog({
					width: 738,
					height: 510,
					modal: true,
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop2?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);

						var myPname = $('#productNameD_' + product_id).html();
						$('.myProductName').html(myPname);

						var mySname = $('#storeNameD_' + store_id).html();
						$('.myStoreName').html(mySname);

						$("#uf_img").attr('src', '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg');
						<?php /*?>document["uf_img"].src='<?php echo $store_url; ?>assets/images/stores/'+store_id+'/'+product_id+'/img1_product.jpg';<?php */?>
						$('#popup_category1').html(data);
					}
				});
				$('#checkboxesHolder2').jScrollPane({
					showArrows: false,
					animateScroll: true
				});

			}
			$("#addtolist").click(function () {

				$("#FancyPopupContainer").dialog('close');
				//window.location.reload();
			});

			$("#unfancy").click(function () {

				$("#EditPopupContainer").dialog('close');
				//window.location.reload();

			});
		});
		$(this).hover(function () {

			if ($(this).children("#hoverText" + r).html() == 'FANCIED') {
				$(this).children("#hoverText" + r).html("EDIT");
				$(this).children("#hoverFancy" + r).removeClass('hoverFancyNext');
				$(this).children("#hoverFancy" + r).addClass('editFancynext');
			}

		}, function () {
			if ($(this).children("#hoverText" + r).html() == 'EDIT') {
				$(this).children(".hoverText").html("FANCIED");
				$(this).children("#hoverFancy" + r).removeClass('editFancynext');
				$(this).children("#hoverFancy" + r).addClass('hoverFancyNext');
			}
		});
	});
</script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
</html> <?php //gc_disable(); ?>