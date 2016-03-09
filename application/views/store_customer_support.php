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
		<title>Customer Support</title>
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
						<div class="customerSupportIcon_active"></div>
					</a>

					<div class="categoriesText">CUSTOMER SUPPORT</div>
					<a href="<?php echo $base_url; ?>index.php/dashboard/store_bank_info/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Legal &amp; Banking Info" class="legalBankingIcon showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_pickup_address/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Pickup Address" class="pickupIcon showtooltip"></div>
					</a></div>
			</div>
			<div class="whiteSeparator"></div>
			<div class="policy_container">
				<form action="<?php echo $base_url; ?>index.php/dashboard/store_customer_form" method="post"
				      enctype="multipart/form-data" name="form_2"><input type="hidden" name="dbaction"
				                                                         value="<?php echo $actionRequired; ?>"/> <input
						type="hidden" value="<?php echo $store_info_var[0]->store_id; ?>" id="my_store_id"
						name="my_store_id"> <input type="hidden" value="<?php echo $store_info_var[0]->store_url; ?>"
				                                   id="store_url" name="store_url">

					<div class="text_label">Support Email</div>

                    <div class="textBorder">
					    <input type="email" name="support_email" id="support_email" class="ques input_width" placeholder="this is wher you want support email sent" value="<?php echo $store_info_var[0]->support_email; ?>"/>
                    </div>


					<div class="text_label">Return Address</div>
					<textarea name="return_address" id="store_textarea3" class="add_area" placeholder="street address" style="width: 472px;"><?php echo $store_info_var[0]->return_address; ?></textarea>

					<div class="padding_top">
                        <div class="textBorder" style="overflow: hidden;">
                            <input class="address_inputs" id="city" type="text" placeholder="city" name="return_city" value="<?php echo $store_info_var[0]->return_city; ?>"/>
                        </div>

						<div class="category1"><select class="drop" name="return_state">
								<option value="state" selected="selected" disabled="disabled">state
								</option> <?php echo populateStates('India', $store_info_var[0]->return_state); ?>
							</select></div>
					</div>
					<div class="padding_top clear_both">
						<div class="category1"><select class="drop" name="return_country">
								<option value="India">India</option>
							</select></div>
						<input class="address_inputs margin_left12" type="text" name="return_pincode" id="pinCode"
						       placeholder="pincode" value="<?php echo $store_info_var[0]->return_pincode; ?>"/></div>
					<div class="buttonDivs clear_both"><input type="submit" name="save_cust_info"
					                                          class="prod_continue save_width"
					                                          onClick="return formValidate()"
					                                          value="<?php echo $saveButton; ?>"/>
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
					$(".drop").each(function () {
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
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_profile.js"></script>
    <script type="text/javascript">$('.drop').selectbox();</script>
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