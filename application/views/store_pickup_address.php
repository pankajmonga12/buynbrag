<?php $rand_num_file = mt_rand();
if ($isRecord == 0) {
	$actionRequired = "insertRecord";
	$saveButton = "Make it Live";
} else {
	$actionRequired = "updateRecord";
	$saveButton = "Update";
}
error_reporting(E_ERROR | E_PARSE); ?> <!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
	<html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Pickup Address</title>
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
						<div title="Policies &amp; FAQ" class="policyIcon showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_customer_support/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Customer Support" class="customerSupportIcon showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_bank_info/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Legal &amp; Banking Info" class="legalBankingIcon showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_pickup_address/<?php echo $store_info_var[0]->store_id; ?>">
						<div class="pickupIcon_active"></div>
					</a>

					<div class="categoriesText">PICKUP ADDRESS</div>
				</div>
			</div>
			<div class="whiteSeparator"></div>
			<div class="policy_container">
				<form action="<?php echo $base_url; ?>index.php/dashboard/store_pickadd_form" method="post"
				      enctype="multipart/form-data" name="form_4"><input type="hidden" name="dbaction"
				                                                         value="<?php echo $actionRequired; ?>"/> <input
						type="hidden" value="<?php echo $store_info_var[0]->store_id; ?>" id="my_store_id"
						name="my_store_id"> <input type="hidden" value="<?php echo $store_info_var[0]->store_url; ?>"
				                                   id="store_url" name="store_url">

					<div class="detail_text">Logistics company will pickup goods from the address given below</div>
					<div class="text_label">Name of place or Business</div>
					<input class="ques input_width" type="text" name="pickup_name" id="accnt" placeholder="enter here"
					       value="<?php echo $store_info_var[0]->pickup_name; ?>"/>

					<div class="text_label">Address</div>
					<textarea id="store_textarea3" name="pickup_address" class="add_area"
					          placeholder="street address"><?php echo $store_info_var[0]->pickup_address; ?></textarea>

					<div class="padding_top"><input class="address_inputs" type="text" name="pickup_city" id="city"
					                                placeholder="city"
					                                value="<?php echo $store_info_var[0]->pickup_city; ?>"/>

						<div class="category1"><select class="drop1" name="pickup_state">
								<option value="state" selected="selected" disabled="disabled">state
								</option> <?php echo populateStates('India', $store_info_var[0]->pickup_state); ?>
							</select></div>
					</div>
					<div class="padding_top clear_both">
						<div class="category1"><select class="drop1" name="pickup_country">
								<option value="India">India</option>
							</select></div>
						<input class="address_inputs margin_left12" type="text" name="pickup_pincode" id="pinCode"
						       placeholder="pincode" value="<?php echo $store_info_var[0]->pickup_pincode; ?>"/></div>
					<div class="text_label">Nearby Landmark</div>
					<input class="ques input_width" type="text" name="pickup_landmark" id="pickup_landmark"
					       placeholder="enter here" value="<?php echo $store_info_var[0]->pickup_landmark; ?>"/>

					<div class="buttonDivs"><input type="submit" name="save_pickup_info"
					                               class="prod_continue save_width" value="<?php echo $saveButton; ?>"/>
						<button type="submit" class="prod_cancel">Cancel</button>
					</div>
				</form>
			</div>
		</section>
	</section> <?php include "footer.php" ?> </body>
	<script type="text/javascript">
		$(function () {
			$(document).click(function (e) {
				var $clicked = $(e.target);
				if (!$clicked.parents().hasClass("sbHolder")) {
					$(".drop1").each(function () {
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
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_profile.js"></script>
	</html> <?php function populateStates($country, $selectedState)
{
	$varStates = array("Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli", "Daman and Diu", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Pondicherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Tripura", "Uttrakhand", "Uttar Pradesh", "West Bengal");
	$allStatesDrop = "";
	for ($hi = 0; $hi < count($varStates); $hi++) {
		if ($selectedState == $varStates[$hi]) {
			$allStatesDrop = $allStatesDrop . '<option value="' . $varStates[$hi] . '" selected="selected">' . $varStates[$hi] . '</option>';
		} else {
			$allStatesDrop = $allStatesDrop . '<option value="' . $varStates[$hi] . '">' . $varStates[$hi] . '</option>';
		}
	}
	return $allStatesDrop;
} ?>