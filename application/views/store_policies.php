<?php $rand_num_file = mt_rand(); if ($isRecord == 0) {
	$actionRequired = "insertRecord";
	$saveButton = "Make it Live";
} else {
	$actionRequired = "updateRecord";
	$saveButton = "Update";
} error_reporting(E_ERROR | E_PARSE); ?> <!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Policies and FAQ</title>
	<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_profile.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body> <?php //include_once('header.php'); ?>
<section class="wrapper"> <?php include_once('store_navigation.php'); ?>
	<section class="middleBackground">
		<div class="categoriesContainer">
			<div class="categoryIcons"><a
					href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Info" class="infoIcon showtooltip"></div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_categories/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Shop Section" class="categoryIcon1 showtooltip"></div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_policies/<?php echo $store_info_var[0]->store_id; ?>">
					<div class="policyIcon_active"></div>
				</a>

				<div class="categoriesText">POLICIES &amp; FAQ</div>
				<a href="<?php echo $base_url; ?>index.php/dashboard/store_customer_support/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Customer Support" class="customerSupportIcon showtooltip"></div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_bank_info/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Legal &amp; Banking Info" class="legalBankingIcon showtooltip"></div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_pickup_address/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Pickup Address" class="pickupIcon showtooltip"></div>
				</a></div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="policy_container">
			<div class="policy_left">
				<div class="shop_text">Shop Policies</div>
				<div class="policyDetails">
					<div>BnB encourages all shops to post policies to help shoppers make informed</div>
					<div>purhcase. Don’t forget! Shop policy must follow BnB DO’S &amp; DON’T &amp;</div>
					<div>Terms of User</div>
				</div>
				<form action="<?php echo $base_url; ?>index.php/dashboard/store_policies_form" method="post"
				      enctype="multipart/form-data" name="form_11">

                    <input type="hidden" name="dbaction" value="<?php echo $actionRequired; ?>"/>
					<input type="hidden" value="<?php echo $store_info_var[0]->store_id; ?>" id="my_store_id" name="my_store_id"> <input type="hidden" value="<?php echo $store_info_var[0]->store_url; ?>" id="store_url" name="store_url">

					<div class="text_label">Return Policies</div>
					<div class="category2 category diffwidth">
                        <select class="down" name="return_policy">
							<option value="policy" selected="selected" disabled="disabled">select return policy</option>
							<option
								value="0" <?php if ($store_info_var[0]->return_policy == 0) echo ' selected="selected"'; ?>>
								BIP Returns
							</option>
							<option
								value="1"<?php if ($store_info_var[0]->return_policy == 1) echo ' selected="selected"'; ?>>
								Happy Returns
							</option>
						</select></div>
					<div class="text_label">EMI</div>
					<div class="category2 category diffwidth">
                        <select class="down" name="EMI_policy">
							<option value="policy" selected="selected" disabled="disabled">select EMI policy</option>
							<option
								value="0"<?php if ($store_info_var[0]->EMI_policy == 0) echo ' selected="selected"'; ?>>
								No
							</option>
							<option
								value="1"<?php if ($store_info_var[0]->EMI_policy == 1) echo ' selected="selected"'; ?>>
								Yes
							</option>
						</select></div>
					<div class="text_label">COD</div>
					<div class="category2 category diffwidth">
                        <select class="down" name="COD_policy">
							<option value="policy" selected="selected" disabled="disabled">select COD policy</option>
							<option
								value="0"<?php if ($store_info_var[0]->COD_policy == 0) echo ' selected="selected"'; ?>>
								No
							</option>
							<option
								value="1"<?php if ($store_info_var[0]->COD_policy == 1) echo ' selected="selected"'; ?>>
								Yes
							</option>
						</select></div>
<!--					<div class="checkboxText">-->
<!--						<div class="checkbox float_left">-->
<!--                            <input type="checkbox" name="allow_request_custom_item"/>-->
<!--                        </div>-->
<!--						<div class="checkText float_left">Allow Request Custom Item</div>-->
<!--					</div>-->
					<div class="buttonDivs clear_both" style="z-index: 0;"><input type="submit" name="save_polcies"
					                                          class="prod_continue save_width"
					                                          value="<?php echo $saveButton; ?>"/>
						<button type="submit" class="prod_cancel">Cancel</button>
					</div>
				</form>
			</div>
<!--			<div class="policySeperator"></div>-->
<!--			<div class="policy_right">-->
<!--				<div class="rightMain">-->
<!--					<div class="rightTransparent"></div>-->
<!--					<div class="rigntContent">-->
<!--						<div class="faq_text">FAQ</div>-->
<!--						<div class="sep"></div>-->
<!--						<form name="form_12" action="#" method="post">-->
<!--							<div class="text_label">Questions</div>-->
<!--                            <div class="productTextbox">-->
<!--                                <div class="textBorder category diffwidth">-->
<!--                                    <input type="text" id="que" class="ques" placeholder="type..."/>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--							<div class="text_label">Answers</div>-->
<!--							<textarea id="ans" class="ans" placeholder="type..."></textarea>-->
<!--							<button type="submit" class="prod_continue save_width">Save</button>-->
<!--						</form>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript">
	$(function () {
		$(document).click(function (e) {
			var $clicked = $(e.target);
			if (!$clicked.parents().hasClass("sbHolder")) {
				$(".down").each(function () {
					var temp = $(this).attr('sb');
					if ($("#sbOptions_" + temp).css("display") == 'block') {
						$("#sbToggle_" + temp).attr('class', '');
						$("#sbToggle_" + temp).addClass('sbToggle');
						$("#sbOptions_" + temp).css("display", "none");
						$("#sbSelector_" + temp).click();
					}
				});
			}
		});
	});
</script>
<script type="text/javascript" src="/assets/js/jquery.selectbox-0.1.3.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_profile.js"></script>
</html>