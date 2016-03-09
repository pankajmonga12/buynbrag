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
		<title>Store Info</title>
		<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/products.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_profile.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_details.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jcrop.css"/>
		<!--[if IE]>
		<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->

        <style type="text/css">
            .category1 .sbHolder{
                height: 49px !important;
            }
        </style>

    </head>
	<body> <?php //include_once('header.php'); ?>
	<section class="wrapper"> <?php include_once('store_navigation.php'); ?>
		<section class="middleBackground">
			<div class="categoriesContainer">
				<div class="categoryIcons"><a
						href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info_var[0]->store_id; ?>">
						<div class="infoIcon_active showtooltip"></div>
					</a>

					<div class="categoriesText">INFO</div>
					<a href="<?php echo $base_url; ?>index.php/dashboard/store_categories/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Categories" class="categoryIcon1 showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_policies/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Policy" class="policyIcon showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_customer_support/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Customer Support" class="customerSupportIcon showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_bank_info/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Legal Banking" class="legalBankingIcon showtooltip"></div>
					</a> <a
						href="<?php echo $base_url; ?>index.php/dashboard/store_pickup_address/<?php echo $store_info_var[0]->store_id; ?>">
						<div title="Pick Up" class="pickupIcon showtooltip"></div>
					</a></div>
			</div>
			<div class="whiteSeparator"></div>
			<form action="<?php echo $base_url; ?>index.php/dashboard/store_info_form" method="post"
			      enctype="multipart/form-data" name="store_info"><input type="hidden" name="dbaction"
			                                                             value="<?php echo $actionRequired; ?>" required/> <input
					type="hidden" value="<?php echo $store_info_var[0]->store_id; ?>" id="my_store_id"
					name="my_store_id"> <input type="hidden" value="<?php echo $store_info_var[0]->store_url; ?>"
			                                   id="store_url" name="store_url" required/>

				<div class="formContainer">
					<div class="formLeft">
                        <div class="field3">
                            <div class="textTitle">Store name</div>
                            <input type="text" name="store_name" placeholder="Your store name" value="<?php echo $store_info_var[0]->store_name; ?>" required/>
                        </div>

                        <div class="field3">
                            <div class="textTitle">Store URL</div>
                            <div class="storeURLcontainer" style="color: #888888;font-size: 20px;">
                                http://<span class="storeURL"><?php echo $store_info_var[0]->store_url; ?></span>.buynbrag.com
                            </div>
                        </div>

						<div class="field3">
							<div class="textTitle">Meta Data Tags for SEO</div>
							<input type="text" name="seo_tags" id="seo_tags" placeholder="type..." value="<?php echo $store_info_var[0]->seo_tags; ?>" required/>
                        </div>
						<div class="field3" style="position:relative">
							<div class="textTitle">About Store</div>
							<textarea name="about_store" id="about_store" placeholder="tell us about your store" class="rte1"><?php echo $store_info_var[0]->about_store; ?></textarea></div>
						<div class="field3">
							<div class="textTitle">Contact Person Name</div>
							<input type="text" name="contact_name" id="person_name" placeholder="type..." value="<?php echo $store_info_var[0]->contact_name; ?>" required/></div>
						<div class="field3">
							<div class="textTitle">Mobile No.</div>
							<input class="mobilewidth1" id="mobile_code" type="text" placeholder="country code" value="91"
							       name="mobile_code" maxlength="5" required/> <input class="mobilewidth2" type="text"
							                                                name="contact_number" id="mobile_no"
							                                                placeholder="type 10 digit number"
							                                                maxlength="10"
							                                                value="<?php echo $store_info_var[0]->contact_number; ?>" required/>
						</div>
						<div class="field3 clear_both">
							<div class="textTitle">Email</div>
							<input type="email" name="contact_email" id="contact_email"
							       placeholder="type valid email id"
							       value="<?php echo $store_info_var[0]->contact_email; ?>" required/></div>
						<div class="field3">
							<div class="textTitle">Communication Address</div>
							<textarea id="store_textarea" name="communication_address"
							          placeholder="street address"><?php echo $store_info_var[0]->communication_address; ?></textarea>

							<div class="padding_top"><input class="textWidth1" id="city_name" type="text"
							                                placeholder="city" name="communication_city"
							                                value="<?php echo $store_info_var[0]->communication_city; ?>" required/>

								<div class="category1 category diffwidth"><select class="drop" name="communication_state">
										<option value="select State" selected="selected" disabled="disabled">state
										</option> <?php echo populateStates('India', $store_info_var[0]->communication_state); ?>
									</select></div>
							</div>
							<div class="padding_top clear_both">
								<div class="category1 category diffwidth"><select class="drop" name="communication_country">
										<option value="India">India</option>
									</select></div>
								<input class="textWidth2" type="text" name="communication_pincode" id="pinCode"
								       placeholder="pincode"
								       value="<?php echo $store_info_var[0]->communication_pincode; ?>" required/></div>
						</div>
						<div class="field3 clear_both">
							<div class="textTitle">Warehouse Address</div>
							<textarea name="warehouse_address" id="warehouse_address"
							          placeholder="street address"><?php echo $store_info_var[0]->warehouse_address; ?></textarea>

							<div class="padding_top"><input class="textWidth1" id="city_name1" type="text"
							                                placeholder="city" name="warehouse_city"
							                                value="<?php echo $store_info_var[0]->warehouse_city; ?>" required/>

								<div class="category1 category diffwidth"><select class="drop" name="warehouse_state">
										<option value="state" selected="selected" disabled="disabled">state
										</option> <?php echo populateStates('India', $store_info_var[0]->warehouse_state); ?>
									</select></div>
							</div>
							<div class="padding_top clear_both">
								<div class="category1 category diffwidth"><select class="drop" name="warehouse_country">
										<option value="India">India</option>
									</select></div>
								<input class="textWidth2" type="text" name="warehouse_pincode" id="pinCode1"
								       placeholder="pincode"
								       value="<?php echo $store_info_var[0]->warehouse_pincode; ?>" required/></div>
						</div>
						<div class="field3 clear_both">
							<div class="textTitle">Company Code</div>
							<input type="text" name="company_code" id="comp_code" placeholder="type..."
							       value="<?php echo $store_info_var[0]->company_code; ?>" readonly disabled/></div>
					</div>
					<div class="leftRightSeparator"></div>
					<div class="formRight">
						<div class="field1">
							<div class="darkFont1">Web storefront Info</div>
						</div>
						<div class="Ownerfield">
							<div class="textTitle">Owner Photo</div>
							<div class="photoBox" id="fileImageParent7">
								<div id="crop_preview7"></div>
								<div id="image7">
									<div id="imageCrop7"></div>
									<div class="paddingTop10">
										<div id="crop_details7"><input type="hidden" id="x7" name="x" required/> <input
												type="hidden" id="y7" name="y" required/> <input type="hidden" id="w7" name="w" required/>
											<input type="hidden" id="h7" name="h" required/> <input type="hidden" id="fname7"
											                                               name="fname" required/>
											<!--<button type="button" class="button button-red-mailme" onClick="return crop();" id="crop_image">Crop Image</button>-->
											<button type="button" class="button button-red-mailme"
											        onClick="return crop();" id="crop_image">Crop Image
											</button>
											<button type="button"
											        class="button button-red-mailme grayPopup margin_left5"
											        id="cancel_crop">Cancel
											</button>
										</div>
									</div>
								</div>
								<input type="hidden" value="<?php echo $base_url; ?>" id="baseurl" required/>

								<div id="upload7"
								     class="upload_product"> <?php if ($store_info_var[0]->owner_pic != "") {
										echo '<div id="fileImage7" class="previewText" style="padding-top:0px"><img src="' . $base_url . 'assets/images/stores/' . $store_info_var[0]->store_id . '/owner/owner.jpg" height="113" width="113"/></div>';
									} else {
										echo '<div id="fileImage7" class="previewText">Preview</div>';
									} ?> </div>
							</div>
							<div class="urlfield">
								<button type="button" class="link_box" id="fileUp2">Upload</button>
								<input type="file" name="userfile" id="file7" maxlength="1"/>
                                <input type="hidden" id="rand_num_id" name="rand_num_id" value="<?php echo $rand_num_file; ?>" required/>
								<!--<button type="button" class="link_box" id="add_url">Add URL</button> <input class="hiddenText" id="url_name" type="text" name="url_name"/>-->
							</div>
						</div>
						<div class="field3 clear_both">
							<div class="textTitle">Store Owner's Name</div>
							<input type="text" name="owner_name" id="owner_name" placeholder="type..."
							       value="<?php echo $store_info_var[0]->owner_name; ?>" required/></div>
						<div class="field3">
							<div class="textTitle">About Me</div>
							<textarea id="store_textarea2" name="about_owner"
							          placeholder="tell about yourself"><?php echo $store_info_var[0]->about_owner; ?></textarea>
						</div>
						<div class="field3 clear_both">
							<div class="textTitle">Mobile No.</div>
							<input class="mobilewidth1" id="mobile_code1" type="text" placeholder="country code" value="91"
							       name="mobile_code1" maxlength="5" required/> <input class="mobilewidth2" type="text"
							                                                 name="owner_mobile" id="mobile_no1"
							                                                 maxlength="10"
							                                                 placeholder="type 10 digit number"
							                                                 value="<?php echo $store_info_var[0]->owner_number; ?>" required/>
						</div>
						<div class="field3 clear_both">
							<div class="textTitle">Username</div>
							<input type="email" name="owner_email" id="pers_email1" placeholder="type valid email id"
							       value="<?php echo $store_info_var[0]->owner_email; ?>" required/></div>
						<div class="field3">
							<div class="textTitle">Website Link</div>
							<input class="webwidth1" type="text" name="fb_link" id="fb_link" placeholder="enter URL"
							       value="<?php echo $store_info_var[0]->fb_link; ?>" required/>

							<div class="category1 webwidth2 category diffwidth">
                                <select class="drop" name="category1">
									<option value="facebook" selected="selected">facebook</option>
									<option value="twitter">twitter</option>
									<option value="linkedin">linkedin</option>
								</select>
                            </div>
						</div>
						<div class="field3 clear_both">
							<div class="textTitle">Marketing Name</div>
							<input type="text" name="marketing_name" id="marketing_name" placeholder="brand name"
							       value="<?php echo $store_info_var[0]->marketing_name; ?>" required/></div>
						<div class="field3">
							<div class="textTitle">Tagline</div>
							<input type="text" name="tag_line" id="tagline_name" placeholder="type..."
							       value="<?php echo $store_info_var[0]->tag_line; ?>" required/></div>
					</div>
					<div class="buttonDivs clear_both"><input type="submit" name="save_store_info"
					                                          class="prod_continue mkItLive"
					                                          onClick="return formValidation()"
					                                          value="<?php echo $saveButton; ?>" required/>
						<button type="button" class="prod_cancel notNow">Not Now</button>
					</div>
				</div>
			</form>
		</section>
	</section>
<!--    --><?php //include "footer.php" ?>
    </body>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url;?>assets/css/jquery.rte.css"/>
	<style>
		.rte-panel {
			top: 77px !important;
			left: 201px !important;
		}

		#about_store {
			height: 190px !important;
		}
	</style>
	<script type="text/javascript" src="<?php echo $base_url;?>assets/js/jquery.rte.js"></script>
	<script type="text/javascript" src="<?php echo $base_url;?>assets/js/jquery.rte.tb.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			var arr = $('.rte1').rte({
				controls_rte: rte_toolbar,
				controls_html: html_toolbar
			});
		});
	</script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_details.js"></script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.Jcrop.js"></script>
	<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/ajaxfileupload.js"></script>
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
    <script type="text/javascript">
        $(function () {
            $(document).click(function (e) {
                var $clicked = $(e.target);
                if (!$clicked.parents().hasClass("sbHolder")) {
                    var x = $(document).find('select').attr('class');
                    $("." + x).each(function () {
                        var temp = $(this).attr('sb');
                        if ($("#sbOptions_" + temp).css("display") == 'block') {
                            $("#sbSelector_" + temp).click();
                        }
                    });
                }
            });

            $(".drop").selectbox({
                speed: 400
            });

        });
    </script>
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