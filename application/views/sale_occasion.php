<?php $h = "Curated finds for diwali"; $t1 = "get ready to sparkle , glitter & dazzle"; $t2 = ""; $style = "#occtext {color:#fff;} .diwaliImage{background-image:url(" . $base_url . "assets/images/diwali_hover.png);height:36px;width:28px;}"; $file = "foccasion.php"; ?> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $h; ?></title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] -->
	<style>
		<?php echo $style; ?>
		.priceRange {
			float: left;
			width: 420px;
			padding-top: 12px;
		}

		.sortbyTextHolder {
			float: right;
			padding-right: 10px;
			padding-top: 14px;
		}

		.sortbyText {
			color: #666;
			cursor: pointer;
			float: left;
			font-family: gill;
			font-size: 15px;
			padding-right: 5px;
			text-shadow: 0 1px 0 #FFFFFF;
		}

		input[type="text"] {
			background: none repeat scroll 0 0 #E1E1E1;
			border: 1px dashed #949494;
			border-radius: 3px 3px 3px 3px;
			color: #333333;
			font-family: gill;
			font-size: 14px;
			height: 30px;
			text-shadow: 0 1px 0 #FFFFFF;
			width: 72px;
			float: left;
			margin-right: 10px;
			margin-top: -6px;
			padding-left: 3px;

		}

		input[type="text"], textarea, select {
			outline: medium none;
		}

		.prod_continue {
			font-size: 12px;
			height: 26px;
			width: 35px;
			margin-top: -7px;
		}

		.soldOut {
			position: absolute;
			top: 4px;
			left: 4px;;
			background-image: url("<?php echo $base_url; ?>assets/images/soldout.png");
			width: 100px;
			height: 70px;

		}

		.checkPrice {
			background: url("<?php echo $base_url; ?>assets/images/categories_checkbox.png") no-repeat scroll 0 0 transparent;
			cursor: default;
			float: left;
			height: 19px;
			margin: 5px;
			text-align: left;
			width: 20px;
		}

		.checkPrice input[type="checkbox"] {
			display: none;
		}

		.checkVocations {
			background: url("<?php echo $base_url; ?>assets/images/categories_checkbox.png") no-repeat scroll 0 0 transparent;
			cursor: default;
			float: left;
			height: 19px;
			margin: 5px;
			text-align: left;
			width: 20px;
		}

		.checkVocations input[type="checkbox"] {
			display: none;
		}
	</style>
</head>
<body><input type="hidden" value="<?php echo $occasion; ?>" id="prod_occasion"> <input type="hidden"
                                                                                       value="<?php echo $base_url; ?>"
                                                                                       id="baseurl"> <input
	type="hidden" id="sort_price" value="<?php echo $sort_price; ?>"/>
<!--<input type="hidden" value="<?php //echo $id; ?>" id="identity">-->
<section class="wrapper"> <?php include "$file"; ?>
	<nav class="middleColumnTop">
		<div class="middleColumnTopIE">
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="linksMiddle">
				<div class="sortbyTextHolder"> <?php if (($price2 > 0) and ($price1 < $price2)) : ?>
						<div class="pricerangec">
							<div class="rangeText">Displaying products of Price range: Rs <?php echo $price1 ?> -
								Rs <?php echo $price2 ?></div>
							<a href="">
								<div class="range_cross">x</div>
							</a></div> <?php elseif (($price1 * $price2) > 0): ?>
						<div class="pricerangec">
							<div class="rangeText">You entered an invalid price-range!</div>
						</div> <?php endif; ?>
					<div class="sortbyText">Sort By :</div> <?php if ($sort_price == 2) : ?>
						<div class="sortbyText"><font color="#ff1493">Highest Price</font></div> <?php else: ?>
						<div class="sortbyText" onClick="return sortPrice(2)"> Highest Price</div> <?php endif; ?>
					<div class="textSeparator"></div> <?php if ($sort_price == 1) : ?>
						<div class="sortbyText" style="padding-left:7px;"><font color="#ff1493">Lowest Price</font>
						</div> <?php else: ?>
						<div class="sortbyText" style="padding-left:7px;" onClick="return sortPrice(1)"> Lowest Price
						</div> <?php endif; ?> </div>
			</div>
		</div>
	</nav>
	<section class="middleBackground">
		<div class="Ie8bg">
			<div class="topDotSeparator topSeparatorStyle"></div>
			<div class="storeMiddleBackgroundContainer">
				<div class="panelContainer">
					<div class="leftPanel leftPanelNewHeightProduct">
						<div class="leftPanelCategory">Categories
						</div> <?php $ii = 0;$jj = 0;$kk = 0; foreach ($sub_categories as $sub_cat) {
							$ii = $ii + 1;
							echo "<div class=\"categoryHeading\" id=\"category" . $ii . "\" onClick=\"return panelCategories(" . $ii . "," . $sub_cat['category_id'] . ")\">" . $sub_cat['category_name'] . "(" . $sub_cat['product_count'] . ")</div> <div class=\"subCategoryConntainer\" id=\"sub_category" . $ii . "\">";
							foreach ($sub_sub_categories[$sub_cat['category_id']] as $sub_sub_cat) {
								$jj = $jj + 1;
								echo "<div class=\"subCategoryItems\" onClick=\"return subCategories(" . $jj . "," . $sub_sub_cat['category_id'] . ")\"> <div class=\"iconNormal\" id=\"icon_" . $jj . "\"></div> <div class=\"subCategory\" id=\"subCategory_" . $jj . "\">" . $sub_sub_cat['category_name'] . "(" . $sub_sub_cat['product_count'] . ")</div> </div> <div class=\"subSubCategoryContainer\" id=\"subSubCategory_" . $jj . "\"> <ul>";
								foreach ($sub_sub_sub_categories[$sub_sub_cat['category_id']] as $sub_sub_sub_cat) {
									$kk = $kk + 1;
									echo "<li li_key=\"s3c\" sss_id=\"" . $sub_sub_sub_cat['category_id'] . "\" class=\"subSubCategory\" id=\"subSubCategory" . $kk . "\">" . $sub_sub_sub_cat['category_name'] . "(" . $sub_sub_sub_cat['product_count'] . ")</li>";
								}
								echo "</ul></div>";
							}
							echo "</div>";
						} ?> <br>

						<div class="leftPanelCategory">Price Range
						</div> <?php if (!(($price2 > 0) and ($price1 < $price2))) : ?>
							<div class="PriceSortingWrapper">
								<div class="priceNormal" id="priceIcon"></div>
								<div style="color:#333;font-size:16px;">Price</div>
								<!-- <div class="subCategory" style="color:#333;">(Clear All)</div>--> </div>
							<div class="priceContainer">
								<div class="clear_both">
									<div class="checkPrice" onclick="prod_filter();"><input type="checkbox"
									                                                        id="price_range_1"></div>
									<div class="checkText2" style="color:#333;">Rs 0-Rs 499</div>
								</div>
								<div class="clear_both">
									<div class="checkPrice" onClick="prod_filter();"><input type="checkbox"
									                                                        id="price_range_2"></div>
									<div class="checkText2" style="color:#333;">Rs 500-Rs 999</div>
								</div>
								<div class="clear_both">
									<div class="checkPrice" onClick="prod_filter();"><input type="checkbox"
									                                                        id="price_range_3"></div>
									<div class="checkText2" style="color:#333;">Rs 1000-Rs 1999</div>
								</div>
								<div class="clear_both">
									<div class="checkPrice" onClick="prod_filter();"><input type="checkbox"
									                                                        id="price_range_4"></div>
									<div class="checkText2" style="color:#333;">Rs 2000-Rs 4999</div>
								</div>
								<div class="clear_both">
									<div class="checkPrice" onClick="prod_filter();"><input type="checkbox"
									                                                        id="price_range_5"></div>
									<div class="checkText2" style="color:#333;">Rs 5000-Rs 9999</div>
								</div>
								<div class="clear_both">
									<div class="checkPrice" onClick="prod_filter();"><input type="checkbox"
									                                                        id="price_range_6"></div>
									<div class="checkText2" style="color:#333;">Rs 10000-Rs 19999</div>
								</div>
								<div class="clear_both">
									<div class="checkPrice" onClick="prod_filter();"><input type="checkbox"
									                                                        id="price_range_7"></div>
									<div class="checkText2" style="color:#333;">Rs 20000 &amp; above</div>
								</div>
							</div> <?php endif; ?>
						<!--<form name="price_filter" class="clear_both" action="" method="post"> <div class="sortbyText" style="margin-top:1px;">Rs.</div> <input type="text" value="<?php //echo $price1; ?>" id="price_1" name="price_1" class="names" placeholder="Start Price" maxlength="10" /> <input type="text" value="<?php //echo $price2; ?>" id="price_2" name="price_2" class="names" placeholder="End Price" maxlength="10" /> <button class="prod_continue" type="submit">Go</button> </form>-->
					</div>
					<div class="panelSeparator panelSeparatorProduct"></div>
					<div id="main_products"
					     class="rightPanel rightPanelNewWidth"> <?php for ($i = 0; $i < count($products); $i++): ?> <?php if (($i % 3) == 0) {
							$class = "rightPanelImageHolders clear_both";
							$class2 = "discountContainer";
						} elseif (($i % 3) == 1) {
							$class = "rightPanelImageHolders";
							$class2 = "discountContainer";
						} elseif (($i % 3) == 2) {
							$class = "rightPanelImageHolders productMarginNone";
							$class2 = "discountContainer rightStyle";
						} ?>
							<div class="store-list1 message_box"
							     id="<?php echo $products[$i]->product_id; ?>"> <?php if ($products[$i]->is_on_discount == 1): ?>
									<div class="<?php echo $class2; ?>">
										<div
											class="numberPercent"><?php echo (floor($products[$i]->discount / $products[$i]->selling_price * 100)); ?> </div>
										<div class="percentSign">%</div>
										<div class="offPercent clear_both">OFF</div>
									</div> <?php endif; ?>
								<div class="<?php echo $class; ?> "><a
										href="<?php echo $base_url?>order/product_page/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>">
										<img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $products[$i]->store_id; ?>/<?php echo $products[$i]->product_id; ?>/img1_240x200.jpg"/>
									</a>

									<div class="storeDecoratingText"><?php echo $products[$i]->product_name; ?></div>
									<div class="fl">
										<div
											class="storeDecoratingText stor_nm font12"><?php echo $products[$i]->store_name; ?></div>
										<div class="storeFancyHolder">
											<div class="fanciedIcon"></div>
											<div
												class="fancyNumber storeExtraStyle"><?php echo $products[$i]->fancy_counter; ?></div>
											<div class="fancyText storeExtraStyle">fancied</div>
										</div>
									</div> <?php if ($products[$i]->is_on_discount == 0) { ?>
										<div class="priceHolder"
										     id="<?php echo intval($products[$i]->selling_price); ?>"><span
												class="rupee">`</span> <?php echo intval($products[$i]->selling_price); ?>
										</div> <?php } else { ?>
										<div class="priceHolder"
										     id="<?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>"
										     style="height:40px; width:85px">
											<div><span class="rupee">`</span>
												<del><?php echo intval($products[$i]->selling_price); ?></del>
											</div>
											<div><span
													class="rupee">`</span> <?php echo intval($products[$i]->selling_price - $products[$i]->discount); ?>
											</div>
										</div> <?php }?> </div>
								<div class="hoverHolder">
									<div
										class="fancyHolder"> <?php if (isset($fancied_prods[$products[$i]->product_id])): ?>
											<input type="hidden" value="<?php echo $products[$i]->product_id; ?>"
											       class="hiddenFieldDiv1"
											       id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/> <input
												type="hidden" value="<?php echo $products[$i]->store_id; ?>"
												class="hiddenFieldStoreid"/> <input type="hidden"
											                                        value="<?php echo $products[$i]->product_id; ?>"
											                                        class="hiddenFieldProductid"/>
											<div class="hoverFancyNext"
											     id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
											<div class="hoverText"
											     id="hoverText<?php echo $products[$i]->product_id; ?>">FANCIED
											</div> <?php else: ?> <input type="hidden"
									                                     value="<?php echo $products[$i]->product_id; ?>"
									                                     class="hiddenFieldDiv1"
									                                     id="hiddenFieldDiv<?php echo $products[$i]->product_id; ?>"/>
											<input type="hidden" value="<?php echo $products[$i]->store_id; ?>"
											       class="hiddenFieldStoreid"/> <input type="hidden"
											                                           value="<?php echo $products[$i]->product_id; ?>"
											                                           class="hiddenFieldProductid"/>
											<div class="hoverFancy"
											     id="hoverFancy<?php echo $products[$i]->product_id; ?>"></div>
											<div class="hoverText"
											     id="hoverText<?php echo $products[$i]->product_id; ?>">FANCY
											</div> <?php endif; ?>
									</div> <?php if (isset($poll_prods[$products[$i]->product_id])) : ?>
										<div class="PollHolder">
											<div class="hoverPoll"
											     style="background-image: url('<?php echo $base_url; ?>assets/images/polled.png');"></div>
											<div class="hoverText">POLLED</div>
										</div> <?php else: ?>
										<div id="poll_<?php echo $products[$i]->product_id; ?>" class="PollHolder">
											<div class="hoverPoll"
											     onClick="return AddPoll(<?php echo $products[$i]->product_id; ?>)"></div>
											<div class="hoverText">POLL</div>
										</div> <?php endif; ?>
								</div> <?php if ($products[$i]->quantity > 0) $soldout = "display:none"; else $soldout = " "; ?>
								<div class="soldout" style="<?php echo $soldout; ?>"></div>
							</div> <?php endfor; ?>
						<div id="more_1" class="slideBackground moreWidthStyleProduct">
							<div class="slideNormal" id="slideNormal_1"></div>
						</div>
					</div>
				</div>
				<!-- <div class="slideBackground" id="slideBackground_1"> <div class="slideNormal" id="slideNormal_1"></div> </div> -->
			</div>
	</section>
</section>
<div class="poll_popUp" id="pollPopup">
	<div class="poll_popUpTransp"></div>
	<div class="poll_popUpActual">
		<div class="fancy_text">Product has been added to your poll list</div>
		<div class="button_style">
			<button type="button" id="pollclose" class="prod_continue width_style_fancy">OK</button>
		</div>
	</div>
</div> <?php include "footer.php" ?> <?php include "fancy_unfancy_categories.php" ?> <input type="hidden" name="sssc_id"
                                                                                            id="sssc_id" value="0"/>
<input type="hidden" name="sssc_type" id="sssc_type" value="0"/></body>
<script type="text/javascript">
	$(document).ready(function () {
		$(".checkPrice").dgStyl();
		$('.priceContainer').jScrollPane({
			showArrows: false,
			animateScroll: true
		});
		$('#priceIcon').click(function () {
			$('.priceContainer').toggle();
			$('.priceContainer').jScrollPane({
				showArrows: false,
				animateScroll: true
			});
			if ($(".priceContainer").css('display') != 'block') {
				$("#priceIcon").css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			} else {
				$("#priceIcon").css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
			}
		});
		$(".checkVocations").dgStyl();
		$('.vocationContainer').jScrollPane({
			showArrows: false,
			animateScroll: true
		});
		$('#vocationIcon').click(function () {
			$('.vocationContainer').toggle();
			$('.vocationContainer').jScrollPane({
				showArrows: false,
				animateScroll: true
			});
			if ($(".vocationContainer").css('display') != 'block') {
				$("#vocationIcon").css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_left.png')", "width": "5px", "height": "11px", "margin-top": "4px"});
			} else {
				$("#vocationIcon").css({"background-image": "url('<?php echo $base_url;?>assets/images/categories_arrow_down.png')", "width": "11px", "height": "5px", "margin-top": "6px"});
			}
		});
	});
</script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript">

$(function () {

	$('li').click(function () {
		var li_key = $(this).attr('li_key');
		if (li_key == 's3c') {
			var ids = $(this).attr('id');
			var ids2 = $(this).attr('sss_id');
			$("#sssc_id").val(ids2);
			$("#sssc_type").val(3);
			var pr_text = "";
			var postdata = [];
			var occ_count = $("#occ_count").val();
			for (var i = 1; i < 8; i++) {
				if ($("#price_range_" + i).is(":checked")) {
					pr_text = pr_text + "1";
				}
				else {
					pr_text = pr_text + "0";
				}
			}
			for (var j = 1; j <= occ_count; j++) {
				if ($("#chk_occ_" + j).is(":checked")) {
					postdata.push($("#chk_occ_" + j).val());
				}
			}
			$(this).css('color', '#da3c63').siblings().css("color", "#666");
			$.ajax({
				url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod2/" + ids2 + "/3/4?occasion=" + $("#prod_occasion").val() + "&range_bits=" + pr_text + "&sort_price=<?php if ($sort_price==1 or $sort_price==2 ) echo $sort_price; ?>",
				success: function (data) {
					$('#main_products').html(data);
				}
			});
		}
	});

	//END OF THEJAS
	// TOOL TIP START
	$(".pro_name").each(function () {

		var len = 28;
		var trunc = $(this).text();
		if ($(this).text().length > len) {
			/* Truncate the content of the P, then go back to the end of the
			 previous word to ensure that we don't truncate in the middle of
			 a word */
			$(this).attr("title", trunc);

			$(this).addClass("showtooltip2");

			trunc = trunc.substring(0, len);
			trunc = trunc.replace(/\w+$/, '');

			trunc += '..';

			$(this).html(trunc);
		}
	});
	$(".stor_nm").each(function () {

		var len = 20;
		var trunc = $(this).text();
		if ($(this).text().length > len) {
			/* Truncate the content of the P, then go back to the end of the
			 previous word to ensure that we don't truncate in the middle of
			 a word */
			$(this).attr("title", trunc);

			$(this).addClass("showtooltip2");

			trunc = trunc.substring(0, len);
			trunc = trunc.replace(/\w+$/, '');

			trunc += '..';

			$(this).html(trunc);
		}
	});

	//tooltip2();

});
function AddPoll(pid) {
	$.ajax({
		url: "<?php echo $base_url; ?>index.php/ajax_poll/add_to_poll/" + pid,
		success: function (data) {
		}

	});

	$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');
	$("#pollPopup").dialog({
		width: 605,
		height: 293,
		modal: true,
	});
	$("#pollclose").click(function () {
		$("#pollPopup").dialog('close');
	});
}
function prod_filter() {
	var pr_text = "";
	var sssc_id = $("#sssc_id").val();
	var sssc_type = $("#sssc_type").val();
	for (var i = 1; i < 8; i++) {
		if ($("#price_range_" + i).is(":checked")) {
			pr_text = pr_text + "1";
		}
		else {
			pr_text = pr_text + "0";
		}
	}
	$.ajax({
		url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod2/" + sssc_id + "/" + sssc_type + "/4?occasion=" + $("#prod_occasion").val() + "&range_bits=" + pr_text + "&sort_price=<?php if ($sort_price==1 or $sort_price==2 ) echo $sort_price; ?>",
		success: function (data) {
			$('#main_products').html(data);
		}
	});
}

$(".subCategory").click(function () {
	$(".checkPrice").each(function () {
		$(this).css("background-position", " center 0px");
		$(".checkPrice input[type='checkbox']").attr("checked", false);
	});
});

$(".subCategory2").click(function () {
	$(".checkVocations").each(function () {
		$(this).css("background-position", " center 0px");
		$(".checkVocations input[type='checkbox']").attr("checked", false);
	});
});

function sortPrice(sort) {
	var myForm = document.createElement("form");
	myForm.method = "post";
	myForm.action = "";

	var myInput = document.createElement("input");
	myInput.setAttribute("name", "sort_price");
	myInput.setAttribute("value", sort);
	myForm.appendChild(myInput);

	var myInput2 = document.createElement("input");
	myInput2.setAttribute("name", "price_1");
	myInput2.setAttribute("value", $("#price_1").val());
	myForm.appendChild(myInput2);

	var myInput3 = document.createElement("input");
	myInput3.setAttribute("name", "price_2");
	myInput3.setAttribute("value", $("#price_2").val());
	myForm.appendChild(myInput3);

	document.body.appendChild(myForm);
	myForm.submit();
	document.body.removeChild(myForm);
}

function panelCategories(id, sc_id) {
	$("#sssc_id").val(sc_id);
	$("#sssc_type").val(1);
	$('li').css('color', '#666');
	var pr_text = "";
	var postdata = [];
	var occ_count = $("#occ_count").val();
	for (var i = 1; i < 8; i++) {
		if ($("#price_range_" + i).is(":checked")) {
			pr_text = pr_text + "1";
		}
		else {
			pr_text = pr_text + "0";
		}
	}
	for (var j = 1; j <= occ_count; j++) {
		if ($("#chk_occ_" + j).is(":checked")) {
			postdata.push($("#chk_occ_" + j).val());
		}
	}
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
		url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod2/" + sc_id + "/1/4?occasion=" + $("#prod_occasion").val() + "&range_bits=" + pr_text + "&sort_price=<?php if ($sort_price==1 or $sort_price==2 ) echo $sort_price; ?>",
		success: function (data) {
			$('#main_products').html(data);
		}
	});

}

function subCategories(id, ssc_id) {
	$("#sssc_id").val(ssc_id);
	$("#sssc_type").val(2);
	var pr_text = "";
	var postdata = [];
	var occ_count = $("#occ_count").val();
	for (var i = 1; i < 8; i++) {
		if ($("#price_range_" + i).is(":checked")) {
			pr_text = pr_text + "1";
		}
		else {
			pr_text = pr_text + "0";
		}
	}
	for (var j = 1; j <= occ_count; j++) {
		if ($("#chk_occ_" + j).is(":checked")) {
			postdata.push($("#chk_occ_" + j).val());
		}
	}
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
		url: "<?php echo $base_url; ?>index.php/tree_products/sub_prod2/" + ssc_id + "/2/4?occasion=" + $("#prod_occasion").val() + "&range_bits=" + pr_text + "&sort_price=<?php if ($sort_price==1 or $sort_price==2 ) echo $sort_price; ?>",
		success: function (data) {
			$('#main_products').html(data);

		}
	});

}

</script>
<script type="text/javascript">

	function last_products_funtion() {

		var ID = $(".message_box:last").attr("id");
		var last_price = 0;
		var pr_text = "";
		for (var i = 1; i < 8; i++) {
			if ($("#price_range_" + i).is(":checked")) {
				pr_text = pr_text + "1";
			}
			else {
				pr_text = pr_text + "0";
			}
		}
		<?php if ($sort_price==1 or $sort_price==2 ) :?>
		var last_price = $(".priceHolder:last").attr("id");
		<?php endif; ?>
		var last_perc = $(".priceHolder:last").attr("perc");
		var last_price = $(".priceHolder:last").attr("id");
		//var cat_id=
		<?php //echo $id; ?>;
		var sssc_id = $("#sssc_id").val();
		var sssc_type = $("#sssc_type").val();
		var baseUrl = $("#baseurl").val();
		$('div#slideNormal_1').css('background', 'url(<?php echo $base_url; ?>assets/images/loader.gif)');
		$('div#slideNormal_1').height('32px');
		$('div#slideNormal_1').width('32px');
		$.ajax({
			url: baseUrl + 'index.php/ajax/occ_product_loader/' + $("#prod_occasion").val() + '/' + sssc_id + '/' + sssc_type + '?sort_price=' + $("#sort_price").val() + '&last_pid=' + ID + '&last_price=' + last_price + '&range_bits=' + pr_text + '&price1=<?php echo $price1; ?>&price2=<?php echo $price2; ?>',
			success: function (data) {
				if (data != "") {
					$(".message_box:last").after(data);
					killScroll = false;
				}
				$('div#slideNormal_1').css('background', 'none');
			}
		});
	}
	;

	var killScroll = false;
	$(window).scroll(function () {
		if ($(window).scrollTop() + 500 >= $(document).height() - $(window).height()) {
			if (killScroll == false) { // IMPORTANT - Keeps the loader from fetching more than once.
				killScroll = true;
				last_products_funtion();
			}
		}
	});
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
</html>