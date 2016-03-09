<?php if ($isRecord == 0) {
	$actionRequired = "insertRecord";
	$saveButton = "Open your store";
} else {
	if ($store_info_var[0]->store_id == 1) {
		$actionRequired = "insertRecord";
	} else {
		$actionRequired = "updateRecord";
	}
	$saveButton = "Save changes";
}
error_reporting(E_ERROR | E_PARSE); ?> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
	<html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Design</title>
		<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/design.css"/>
		<!--[if IE]>
		<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
	<body> <?php //include_once('header.php'); ?>
	<section class="wrapper">
		<article class="banner">
			<div class="slide">
				<div class="bannerHolder">
					<div class="bannerLogo"><img
							src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info_var[0]->store_id; ?>/top_banner.png"/>
					</div>
					<div class="bannerText newbannerText">
						<div class="bannerTextHolder newbannerTextHolder">
							<div class="bannerShopText">Shop URL :</div>
							<div class="bannerURLText"><?php echo $store_info_var[0]->store_url; ?></div>
						</div>
					</div>
					<div class="bannerIconsHolder">
						<div class="fancyHolder">
							<div class="fancyIcon"></div>
							<div class="fancyTextHolder">
								<div class="fancyNumber"><?php echo $store_info_var[0]->fancy_counter; ?></div>
								<div class="fancyText">fancied</div>
							</div>
						</div>
						<div class="fancyHolder">
							<div class="bragedIcon"></div>
							<div class="fancyTextHolder newfancyTextHolder1">
								<div class="fancyNumber"><?php echo $store_info_var[0]->brag_counter; ?></div>
								<div class="fancyText">braged</div>
							</div>
						</div>
						<div class="fancyHolder">
							<div class="viewedIcon"></div>
							<div class="fancyTextHolder newfancyTextHolder2">
								<div class="fancyNumber"><?php echo $store_info_var[0]->visit_counter; ?></div>
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
					href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info_var[0]->store_id; ?>">
					<div class="dashboardLink1">
						<div class="dashboardLogo1"></div>
						<div class="dashboardText1">Dashboard</div>
					</div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info_var[0]->store_id; ?>">
					<div class="productsLink">
						<div class="productsLogo"></div>
						<div class="productsText">Products</div>
					</div>
				</a> <a href="">
					<div class="designLink1">
						<div class="designHover"></div>
						<div class="designText">Design</div>
					</div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/promote/promote_discount_summary/<?php echo $store_info_var[0]->store_id; ?>">
					<div class="productsLink">
						<div class="promoteLogo"></div>
						<div class="productsText">Promote</div>
					</div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info_var[0]->store_id; ?>">
					<div class="productsLink">
						<div class="storeLogo"></div>
						<div class="productsText">Store Profile</div>
					</div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/bill/allbill/<?php echo $store_info_var[0]->store_id; ?>">
					<div class="productsLink">
						<div class="billLogo"></div>
						<div class="productsText">Bill</div>
					</div>
				</a></div>
			<div class="topDotSeparator newtopDotSeparator2"></div>
		</nav>
		<section class="middleBackground">
			<form action="<?php echo $base_url; ?>index.php/dashboard/submitBannerChanges" name="bannerForm"
			      method="post" enctype="multipart/form-data"><input type="hidden" name="dbaction"
			                                                         value="<?php echo $actionRequired; ?>"/> <input
					type="hidden" name="store_url" value="<?php echo $store_info_var[0]->store_url; ?>"/> <input
					type="hidden" name="store_id" value="<?php echo $store_info_var[0]->store_id; ?>" id="store_id"/>

				<div class="designContainer">
					<div class="valueWrapper">
						<div class="valueBox1">
							<div class="text_label">Store Name<span class="text_italic">you can change this later</span>
							</div>
							<input type="text" id="strName" name="storeName" onBlur="return change_banner_text();"
							       placeholder="<?php echo $store_info_var[0]->store_name; ?>"
							       value="<?php echo $store_info_var[0]->store_name; ?>">

							<div class="under_text">type # to continue typing in next line. # will not visible
								anywhere.
							</div>
						</div>
						<div class="valueBox2">
							<div class="text_label">Font</div>
							<div class="font"><select class="font_style" id="changeStyle"
							                          onChange="return change_style();" name="font_style">
									<option value="Rockwell" selected="selected">Rockwell</option>
									<option value="Trebuchet MS">Trebuchet MS</option>
									<option value="Comic Sans">Comic Sans</option>
									<option value="Arial">Arial</option>
								</select></div>
						</div>
						<div class="valueBox2">
							<div class="text_label">Font Size</div>
							<div class="font1"><select class="font_size" id="changeFont" onChange="return font_sz();"
							                           name="font_size">
									<option value="34">34</option>
									<option value="38">38</option>
									<option value="42">42</option>
									<option value="46">46</option>
									<option value="50">50</option>
									<option value="54">54</option>
									<option value="58">58</option>
									<option value="62">62</option>
									<option value="66" selected="selected">66</option>
								</select></div>
						</div>
						<div class="valueBox3">
							<div class="bold_text bold_text_click" id="makeBold">B</div>
							<div class="bold_italic bold_text_click" id="makeBoldItalic">B</div>
							<div class="bold_text bold_text_click" id="upper">TT</div>
							<div class="small_tt bold_text_click" id="capitals">Tt</div>
							<input type="text" class="izzyColor" id="color1"></div>
					</div>
					<!--<div class="bigBannerDiv"></div> <div class="imageScrollContainer"> <div class="text_label">Select Banner</div> </div>-->
					<div class="bannerTextContentHolder">
						<div class="text_banner" id="changeTopPosition">
							<div class="text_change"
							     id="changeFontSize"><?php echo changeInBannerFormat($store_info_var[0]->store_name); ?></div>
						</div>
					</div>
					<div id="galleria"> <?php for ($i = 1; $i <= 20; $i++) { ?> <a
							href="<?php echo $base_url; ?>assets/photos/BB<?php echo $i; ?>.png"> <img
								src="<?php echo $base_url; ?>assets/thumb/sb<?php echo $i; ?>.png"> </a> <?php } ?>
					</div>
					<div class="select_banner">Select Banner</div>
				</div>
				<div class="whiteSeparator"></div>
				<div class="bottomContainer">
					<div class="text_label">Store URL</div>
					<div class="website_wrapper"> <?php if ($store_info_var[0]->store_id == 1) { ?> <input type="text"
					                                                                                       id="subdomain"
					                                                                                       class="website_name"
					                                                                                       placeholder="type.."
					                                                                                       name="subdomain"/>
							<div><?php if ($_GET['msg'] != "") {
									echo "<span style='color:red'>*&nbsp;" . $_GET['msg'] . "</span>";
								} ?></div> <?php } else { ?>
							<div
								class="webName float_left"><?php echo $store_info_var[0]->store_url; ?></div> <?php } ?>
						<!--<div class="webName float_left" id="webName">chinasuperbazaar</div> <input type="text" id="website_name" class="website_name" placeholder="type.." style="display:none;"/> <div class="webName float_left">.buynbrag.com</div> <div class="store_edit" style="margin:8px 0 0 12px;"></div>-->
					</div>
					<div class="submitDivs">
						<button type="submit" class="prod_continue save_width">Save Changes</button>
						<button type="submit" class="prod_cancel">Cancel</button>
					</div>
				</div>
			</form>
		</section>
	</section> <?php include "footer.php" ?> </body>
	<script>

		// Load the classic theme
		Galleria.loadTheme('<?php echo $base_url; ?>/assets/js/galleria.classic.js');

		// Initialize Galleria
		Galleria.run('#galleria');

	</script>
	<script type="text/javascript">
		var imageUrl = '<?php echo $base_url; ?>/assets/images/colourpicker_small.png'; // optionally, you can change path for images.
	</script>
	<script type="text/javascript" src="<?php echo $base_url; ?>/assets/js/design.js"></script>
	<script src="<?php echo $base_url; ?>/assets/js/izzyColor.js"></script>
	</html> <?php function changeInBannerFormat($storename)
{
	return str_replace("#", "<br>", $storename);
} ?>