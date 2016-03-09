<?php
if ($id == 6) {
	$h = "Furniture";
	$t1 = "Woodsy, Minimal or Eclectic";
	$t2 = " - Let your spaces say something about you.";
	$img = "graphic.png";
	$style = "#furnituretext{color:#fff;} .furnitureImage{background-image:url(" . $base_url . "assets/images/funiture_click.png);height:20px;width:20px;}";
	$file = "fhad.php";
}
if ($id == 8) {
	$h = "D&#233;cor &amp; Furnishing";
	$t1 = "Curios, Colours and other little touches";
	$t2 = "";
	$img = "graphic.png";
	$style = "#hometext{color:#fff;} .homeImage{background-image:url(" . $base_url . "assets/images/homedecor_click.png);height:20px;width:20px;}";
	$file = "fhad.php";
} if ($id == 7) {
	$h = "Dining";
	$t1 = "For the love of food and all things joyous and comforting";
	$t2 = "";
	$img = "graphic.png";
	$style = "#diningtext{color:#fff;} .DiningImage{background-image:url(" . $base_url . "assets/images/dinning_click.png);height:18px;width:27px;}";
	$file = "fhad.php";
} if ($id == 10) {
	$h = "Lighting";
	$t1 = "A different glow for each mood";
	$t2 = "";
	$img = "graphic.png";
	$style = "#lightingtext{color:#fff;} .LightingImage{background-image:url(" . $base_url . "assets/images/lighting_click.png);height:21px;width:15px;}";
	$file = "fhad.php";
} if ($id == 2) {
	$h = "Fashion";
	$t1 = "Boho-Chic to Haute Style, find it here.";
	$t2 = "";
	$img = "fashion.png";
	$style = "#fashiontext{color:#fff;} .fashionImage{background-image:url(" . $base_url . "assets/images/fashion_white.png);height:20px;width:20px;}";
	$file = "ffashion.php";
} if ($id == 3) {
	$h = "Art";
	$t1 = "From popular prints to original antiques, feel free to ";
	$t2 = "wander.";
	$img = "art.png";
	$style = "#arttext{color:#fff;} .artImage{background-image:url(" . $base_url . "assets/images/art_white.png);height:21px;width:20px;}";
	$file = "fart.php";
} if ($id == 4) {
	$h = "Collectibles";
	$t1 = "The rare and beautiful from the books of history";
	$t2 = " ";
	$img = "gizmos.png";
	$style = "#gizmostext{color:#fff;} .gizmosImage{background-image:url(" . $base_url . "assets/images/gizmos_white.png);height:18px;width:23px;}";
	$file = "fart.php";
} ?> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Homedecor Stores</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href=""<?php echo $base_url; ?>assets/css/ie.css" /> <![endif] -->
	<style>
		<?php echo $style; ?>
	</style>
</head>
<body><input type="hidden" value="<?php echo $base_url; ?>" id="baseurl">
<section class="wrapper"> <?php include "$file"; ?>
	<nav class="middleColumnTop">
		<div class="middleColumnIE">
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="linksMiddle"><a href="<?php echo $base_url . 'categories/cat_main/' . $id ?>">
					<div class="mainLink">
						<div class="heading_style">Main</div>
					</div>
				</a> <a href="<?php echo $base_url . 'categories/cat_product/' . $id ?>">
					<div class="mainLink">
						<div class="heading_style">Products</div>
					</div>
				</a> <a href="<?php echo $base_url . 'categories/cat_stores/' . $id ?>">
					<div class="mainLinkSelected">
						<div class="heading_selected">Stores</div>
					</div>
				</a>
				<!-- <a href="<?php echo $base_url.'categories/cat_editor/'.$id ?>"><div class="mainLink"> <div class="heading_style">Editor’s Faves</div> </div></a>-->
			</div>
			<div class="topDotSeparator newtopDotSeparator1"></div>
		</div>
	</nav>
	<section class="middleBackground">
		<div class="Ie8bg">
			<div class="topDotSeparator topSeparatorStyle"></div>
			<div class="storeMiddleBackgroundContainer">
				<div class="panelContainer">
					<div class="leftPanel leftPanelNewHeight">
						<div class="leftPanelCategory">Categories
						</div> <?php $ii = 0;$jj = 0;$kk = 0; foreach ($sub_categories as $sub_cat) {
							$ii = $ii + 1;
							echo "<div class=\"categoryHeading\" id=\"category" . $ii . "\" onClick=\"return panelCategories(" . $ii . "," . $sub_cat['category_id'] . ")\">" . $sub_cat['category_name'] . "(" . $sub_cat['store_count'] . ")</div> <div class=\"subCategoryConntainer\" id=\"sub_category" . $ii . "\">";
							foreach ($sub_sub_categories[$sub_cat['category_id']] as $sub_sub_cat) {
								$jj = $jj + 1;
								echo "<div class=\"subCategoryItems\" onClick=\"return subCategories(" . $jj . "," . $sub_sub_cat['category_id'] . ")\"> <div class=\"iconNormal\" id=\"icon_" . $jj . "\"></div> <div class=\"subCategory\" id=\"subCategory_" . $jj . "\">" . $sub_sub_cat['category_name'] . "(" . $sub_sub_cat['store_count'] . ")</div> </div> <div class=\"subSubCategoryContainer\" id=\"subSubCategory_" . $jj . "\"> <ul>";
								foreach ($sub_sub_sub_categories[$sub_sub_cat['category_id']] as $sub_sub_sub_cat) {
									$kk = $kk + 1;
									echo "<li sss_id=\"" . $sub_sub_sub_cat['category_id'] . "\" class=\"subSubCategory\" id=\"subSubCategory" . $kk . "\">" . $sub_sub_sub_cat['category_name'] . "(" . $sub_sub_sub_cat['store_count'] . ")</li>";
								}
								echo "</ul></div>";
							}
							echo "</div>";
						} ?> </div>
					<div class="panelSeparator seperator_new_style"></div>
					<div id="main_stores"
					     class="rightPanel"> <?php for ($i = 0; $i < count($store); $i++): $sid = '_' . $store[$i]->store_id; ?>
<?php
//Generate a random number for fetching images -AS
							$max = count($sprod["$sid"]) - 1;
							$tm1 = mt_rand(0, $max);
							$tm2 = mt_rand(0, $max);
							$tm3 = mt_rand(0, $max);
//Condition check for slider -AS
							if (($i % 2) == 0) {
								$class = "images_holder clear_both";
							} else {
								$class = "images_holder image2margin";
							}
							?> <a href="<?php echo $base_url?>order/store_page/<?php echo $store[$i]->store_id; ?>">
								<div class="<?php echo $class; ?> message_box" id="<?php echo $store[$i]->store_id; ?>">
									<img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm1"]->product_id; ?>/img1_product.jpg"
										alt="big image"/>

									<div class="banner_Image"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/top_banner.png"/>
									</div>
									<div class="smallImage"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm2"]->product_id; ?>/img1_product.jpg"/>
									</div>
									<div class="mediumImage"><img
											src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store[$i]->store_id; ?>/<?php echo $sprod["$sid"]["$tm3"]->product_id; ?>/img1_product.jpg"
											alt="medium image"/></div>
									<div class="fancyBragedHolder">
										<div class="fancy_Icon"></div>
										<div class="fancy_number"><?php echo $store[$i]->fancy_counter; ?></div>
										<div class="fancy_name">Fancied</div>
										<div class="brag_Icon clear_both"></div>
										<div class="fancy_number"><?php echo $store[$i]->brag_counter; ?></div>
										<div class="fancy_name">Bragged</div>
									</div>
									<div class="product_number"> <?php echo $max + 1; ?>
										<div class="braged_name">Products</div>
									</div>
								</div>
							</a> <?php endfor; ?>
						<!-- <div id="more_1" class="slideBackground moreWidthStyle clear_both">-->
						<!-- <div class="slideNormal"></div>--> </div>
				</div>
			</div>
		</div>
		</div> </section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/landing_page.js"></script>
<!--<script type="text/javascript">

	$(document).ready(function(){
		function last_products_funtion() 
		{ 
            var ID=$(".message_box:last").attr("id");
			var cat_id=<?php echo $id; ?>;
		    var baseUrl=$("#baseurl").val();
			$('div#slideNormal_1').html('<img src='+baseUrl+'assets/images/loader.gif>');
			$.ajax({
				url: baseUrl+'index.php/ajax/cat_stores_loader?cat_id='+cat_id+'&limit='+ID+'',
				success: function(data){
					if (data != "") {
						$(".message_box:last").after(data);			
					}
				$('div#slideNormal_1').empty();
				}
	});
		};  
		
		$(window).scroll(function(){
			if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			   last_products_funtion();
			}
		}); 
	});

</script>-->
<script type="text/javascript">
	$(function () {

		$('li').click(function () {
			var ids = $(this).attr('id');
			var ids2 = $(this).attr('sss_id');
			$(this).css('color', '#da3c63').siblings().css("color", "#666");
			$.ajax({
				url: "<?php echo $base_url; ?>/index.php/tree_products/sub_stores2/" + ids2 + "/3",
				success: function (data) {
					$('#main_stores').html(data);
				},
			});
		});

	});

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
			url: "<?php echo $base_url; ?>/index.php/tree_products/sub_stores2/" + sc_id + "/1",
			success: function (data) {
				$('#main_stores').html(data);
			},
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
			url: "<?php echo $base_url; ?>/index.php/tree_products/sub_stores2/" + ssc_id + "/2",
			success: function (data) {
				$('#main_stores').html(data);
			},
		});

	}
</script>
</html>