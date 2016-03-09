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
	<title>Legal &amp; Banking</title>
	<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_profile.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body><input type="hidden" value="<?=$base_url; ?>" id="baseurl"> <?php //include_once('header.php'); ?>
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
					<div class="legalBankingIcon_active"></div>
				</a>

				<div class="categoriesText">LEGAL &amp; BANKING INFO</div>
				<a href="<?php echo $base_url; ?>index.php/dashboard/store_pickup_address/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Pickup Address" class="pickupIcon showtooltip"></div>
				</a></div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="policy_container">
			<form action="<?php echo $base_url; ?>index.php/dashboard/store_bank_form" method="post"
			      enctype="multipart/form-data" name="form_3"><input type="hidden" name="dbaction"
			                                                         value="<?php echo $actionRequired; ?>"/> <input
					type="hidden" value="<?php echo $store_info_var[0]->store_id; ?>" id="my_store_id"
					name="my_store_id"> <input type="hidden" value="<?php echo $store_info_var[0]->store_url; ?>"
			                                   id="store_url" name="store_url">

				<div class="detail_text">Details of the account to which money will be remitted electronically</div>
				<div class="text_label">Bank Account Holder Name</div>
				<input type="text" name="bankaccountholder_name" id="accnt" class="ques input_width"
				       placeholder="type..." value="<?php echo $store_info_var[0]->bankaccountholder_name; ?>"/>

				<div class="text_label">Bank Account Number</div>
				<input type="text" name="bankaccountnumber" id="accntNo" class="ques input_width" placeholder="type..."
				       value="<?php echo $store_info_var[0]->account_number; ?>"/>

				<div class="text_label">Name of the Bank</div>
				<div class="category2 select_width"><select class="down" name="bank_name">
						<option value="bank" disabled="disabled">Select name of Bank
						</option> <?php foreach ($banks as $bank) : ?>
							<option
								value="<?php echo $bank->bank_name; ?>"<?php if ($store_info_var[0]->bank_name == $bank->bank_name) echo ' selected="selected"'; ?>><?php echo $bank->bank_name; ?></option> <?php endforeach; ?>
					</select></div>
				<div class="text_label">Bank Branch</div>
				<input type="text" name="bank_branch" id="bank_branch" class="ques input_width" placeholder="type..."
				       value="<?php echo $store_info_var[0]->bank_branch; ?>"/>

				<div class="text_label">Type of Account</div>
				<div class="category2 select_width"><select class="down" name="account_type">
						<option value="type" selected="selected" disabled="disabled">Select Type of Account</option>
						<option
							value="Current Account"<?php if ($store_info_var[0]->account_type == 'Current Account') echo ' selected="selected"'; ?>>
							Current Account
						</option>
						<option
							value="Saving Account"<?php if ($store_info_var[0]->account_type == 'Saving Account') echo ' selected="selected"'; ?>>
							Saving Account
						</option>
						<option
							value="Corporate Account"<?php if ($store_info_var[0]->account_type == 'Corporate Account') echo ' selected="selected"'; ?>>
							Corporate Account
						</option>
						<option
							value="Over Draft Account"<?php if ($store_info_var[0]->account_type == 'Over Draft Account') echo ' selected="selected"'; ?>>
							Over Draft Account
						</option>
						<option
							value="Business Account"<?php if ($store_info_var[0]->account_type == 'Business Account') echo ' selected="selected"'; ?>>
							Business Account
						</option>
					</select></div>
				<div class="text_label">IFSC Code</div>
				<input type="text" name="ifsc_code" id="ifsc_code" class="ques input_width" placeholder="type..."
				       value="<?php echo $store_info_var[0]->ifsc_code; ?>"/>

				<div class="text_label">VAT/CST Registration Number</div>
				<input type="text" name="vat_no" id="vat" class="ques input_width" placeholder="type..."
				       value="<?php echo $store_info_var[0]->vat_no; ?>"/>

				<div class="text_label">TIN Number</div>
				<input type="text" name="tin_no" id="tin_number" class="ques input_width" placeholder="type..."
				       value="<?php echo $store_info_var[0]->tin_no; ?>"/>

				<div class="text_label">PAN CARD Number</div>
				<input type="text" name="pan_no" id="panCard" class="ques input_width" placeholder="type..."
				       value="<?php echo $store_info_var[0]->pan_no; ?>"/>

				<div class="buttonDivs"><input type="submit" name="save_legal_info" class="prod_continue save_width"
				                               onClick="return formValidate()" value="<?php echo $saveButton; ?>"/>
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
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_profile.js"></script>
</html>