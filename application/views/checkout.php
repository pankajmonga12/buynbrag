<?php $coming_from = 0;
if ($userArr != FALSE) $coming_from = 1;
$details = $userDetails[0]; ?> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
	<html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Check Out</title>
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/checkout.css"/>

        <script type="text/javascript">
	        var userEmail = "<?php echo $userDetails[0]->email; ?>";
	        var checkout1VisitCounter = parseInt(getCookie("checkout1VisitCounter"));
	        var checkout1CartSize = parseInt(getCookie("checkout1CartSize"));
	        if(!checkout1VisitCounter){
		        checkout1VisitCounter=0;
		        console.log('First page visit;');
	        }
	        checkout1VisitCounter++;
	        setCookie("bnbCouponID", "none");
	        setCookie("checkout1VisitCounter", checkout1VisitCounter);
	        //console.log("ANALYTICS ++++ checkout1loaded vars: " + userEmail + checkout1CartSize + " -- " +checkout1VisitCounter);
			_bnbAnalytics.checkout1Loaded(userEmail, checkout1CartSize, checkout1VisitCounter);

	    </script>
	    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
		<script src="<?php echo $base_url; ?>assets/js/checkout.js"></script>
		<script type="text/javascript">
			function processForm(){
					if(formValidate() === false){
						return false;
					}
					else{
						var contactNo = document.forms["checkoutI"]["mobile_no"].value;
						_bnbAnalytics.registerContactNo(userEmail, contactNo);				
						return true;
					}
				}
		</script>

	</head>
	<body><input type="hidden" value="<?php echo $base_url; ?>" id="baseurl">
	<section class="wrapper">
		<section class="middleBackground">
			<div class="topBanerPatternContainer diffHeight">
				<div class="checkWrapper">
					<div class="checkoutIcon"></div>
					<div class="checkoutText">CHECKOUT</div>
					<div class="rightWrapper">
						<div class="Iimage"></div>
						<div class="blank_circleImage"></div>
						<div class="blank_circleImage"></div>
					</div>
				</div>
			</div>
			<div class="topDotSeparator"></div>
			<div class="middleContainer">
				<div class="leftPanel">
					<div class="checkHeading fl">Shipping Address</div>
					<div class="checkBoxTextfl" style="padding-top:6px;">
						<div class="checkbox"
						     onClick="getMyRegisteredAddress('<?php echo $details->address;?>','<?php echo $details->city;?>','<?php echo $details->state;?>','<?php echo $details->country;?>','<?php echo $details->pin;?>')">
							<input type="checkbox" name="check1" id="check1"/></div>
						<div class="checkText2">use my registered address</div>
					</div>
					<form name="checkoutI" action="checkout_second" method="post" onsubmit="return processForm();">
						<div class="formRow">
							<div class="labelText">Full Name</div>
							<div
								class="textBoxes"> <?php if ($coming_from == 0) { ?> <?php $name = explode(" ", $mydetails[0]->full_name); ?>
									<input type="text" maxlength="20" placeholder="First Name" class="names"
									       name="firstname" id="fname" value="<?php echo $name[0]; ?>"/> <input
										type="text" maxlength="20" placeholder="Last Name" class="names marginRight0"
										name="lastname" id="lname" value="<?php echo $name[1]; ?>"/> <?php } else { ?>
									<input type="text" maxlength="20" placeholder="First Name" class="names"
									       name="firstname" id="fname" value="<?php echo $userArr['firstname'];?>"/>
									<input type="text" maxlength="20" placeholder="Last Name" class="names marginRight0"
									       name="lastname" id="lname"
									       value="<?php echo $userArr['lastname'];?>"/> <?php }?> </div>
						</div>
						<div class="formRow">
							<div class="textBoxes clear_both"> <?php if ($coming_from == 0) { ?> <textarea
									name="address1" id="street_address"
									placeholder="street address"></textarea> <?php } else { ?> <textarea name="address1"
							                                                                             id="street_address"
							                                                                             placeholder="street address"><?php echo $userArr['address1'];?></textarea> <?php }?>
								<div class="twoTextField"> <?php if ($coming_from == 0) { ?> <input type="text"
								                                                                    class="addressWidth fl"
								                                                                    placeholder="City"
								                                                                    name="city"
								                                                                    id="cityName"/> <?php } else { ?>
										<input type="text" class="addressWidth fl" placeholder="City" name="city"
										       id="cityName" value="<?php echo $userArr['city'];?>"/> <?php }?>
									<div class="category1"> <?php if ($coming_from == 0) { ?> <select class="drop1"
									                                                                  name="state"
									                                                                  id="state">
											<option value="state" selected="selected" disabled="disabled">State
											</option> <?php echo populateStates('India', $userArr['state']); ?>
										</select> <?php } else { ?> <select class="drop1" name="state" id="state" style="border: 1px dashed #999;">
											<option value="state" disabled="disabled">State</option>
											<option value="<?php echo $userArr['state'];?>"
											        selected="selected"><?php echo $userArr['state'];?></option> <?php echo populateStates('India', $userArr['state']); ?>
										</select> <?php }?> </div>
								</div>
								<div class="twoTextField">
									<div class="category1 changeWidth"> <?php if ($coming_from == 0) { ?> <select
											class="drop1" name="country" id="country" style="border: 1px dashed #999;">
											<option value="India">India</option>
											<option value="Germany">Germany</option>
											<option value="Japan">Japan</option>
											<option value="China">China</option>
											<option value="Italy">Italy</option>
										</select> <?php } else { ?> <select class="drop1" name="country" id="country">
											<option value="Country" disabled="disabled">Country</option>
											<option value="<?php echo $userArr['country'];?>"
											        selected="selected"><?php echo $userArr['country'];?></option>
											<option value="India">India</option>
										</select> <?php }?> </div> <?php if ($coming_from == 0) { ?> <input type="text"
									                                                                        class="newaddressWidth fl"
									                                                                        placeholder="Pincode"
									                                                                        name="zipcode"
									                                                                        id="PinCode"/> <?php } else { ?>
										<input type="text" class="newaddressWidth fl" placeholder="Pincode"
										       name="zipcode" id="PinCode"
										       value="<?php echo $userArr['zipcode'];?>"/> <?php }?> </div>
							</div>
						</div>
						<div class="formRow">
							<div class="labelText">Mobile</div>
							<div class="textBoxes"> <?php if ($coming_from == 0) { ?> <input type="text"
							                                                                 placeholder="country code"
							                                                                 class="countryCode"
							                                                                 name="mob_country_code"
							                                                                 id="country_code"
							                                                                 value="+91"/> <input
									type="text" placeholder="enter your 10 digit mobile number" class="mobileNo"
									maxlength="10" name="phone" id="mobile_no"
									value="<?php echo $mydetails[0]->mob; ?>"/> <?php } else { ?> <input type="text"
							                                                                             placeholder="country code"
							                                                                             class="countryCode"
							                                                                             name="mob_country_code"
							                                                                             id="country_code"
							                                                                             value="+91"/>
									<input type="text" placeholder="enter your 10 digit mobile number" class="mobileNo"
									       maxlength="10" name="phone" id="mobile_no"
									       value="<?php echo $userArr['phone'];?>"/> <?php }?> </div>
						</div>
						<div class="formRow">
							<div class="labelText">Email</div>
							<div class="textBoxes"> <?php if ($coming_from == 0) { ?> <input type="email"
							                                                                 placeholder="enter your valid email Id"
							                                                                 name="email"
							                                                                 id="person_email"
							                                                                 value="<?php echo $mydetails[0]->email; ?>"/> <?php } else { ?>
									<input type="email" placeholder="enter your valid email Id" name="email"
									       id="person_email" value="<?php echo $userArr['email'];?>"/> <?php }?> </div>
						</div>
						<!-- <div class="formRow"> <div class="labelText fl">Shipping Address</div> <div class="checkBoxTextfl"> <div class="checkbox" onClick="getAddress()"><input type="checkbox" name="check2" id="check2"/></div> <div class="checkText2">same as above address</div> </div> <div class="formRow clear_both"> <div class="labelText">Full Name</div> <div class="textBoxes"> <input type="text" maxlength="20" placeholder="First Name" class="names" name="firstname" id="fname1" value=""/> <input type="text" maxlength="20" placeholder="Last Name" class="names marginRight0" name="lastname" id="lname1" value=""/> </div> </div> <div class="textBoxes"> <textarea name="address1" id="street_address1" placeholder="street address"></textarea> <div class="twoTextField"> <input type="text" class="addressWidth fl" placeholder="City" name="city" id="cityName1"/> <div class="category1"> <select class="drop1" name="state" id="state1"> <option value="state" selected="selected" disabled="disabled">State</option> <?php //echo populateStates('India',$userArr['state']); ?> </select> </div> </div> <div class="twoTextField"> <div class="category1 changeWidth"> <select class="drop1" name="country" id="country1"> <option value="India">India</option> <option value="Germany">Germany</option> <option value="Japan">Japan</option> <option value="China">China</option> <option value="Italy">Italy</option> </select> </div> <input type="text" class="newaddressWidth fl" placeholder="Pincode" name="zipcode" id="PinCode1"/> </div> </div> </div> <div class="formRow"> <div class="labelText">Mobile</div> <div class="textBoxes"> <input type="text" placeholder="country code" class="countryCode" name="mob_country_code" id="country_code1" value="+91"/> <input type="text" placeholder="enter your 10 digit mobile number" class="mobileNo" maxlength="10" name="phone" id="mobile_no1" value=""/> </div> </div> <div class="formRow"> <div class="labelText">Email</div> <div class="textBoxes"> <input type="email" placeholder="enter your valid email Id" name="email" id="person_email1" value=""/> </div> </div>-->
						<!-- <div class="formRow"> <div class="checkBoxText"> <div class="checkbox"><input type="checkbox" name="daily_deals_check"/></div> <div class="checkText2">Email me deals and product information. No Spam!</div> </div> </div>-->
						<div class="buttonContainer"> <?php if ($coming_from == 0) { ?> <input type="hidden"
						                                                                       name="amount"
						                                                                       value="<?php echo $amount; ?>"/>
								<input type="hidden" name="tax" value="<?php echo $tax; ?>"/> <?php } else { ?> <input
								type="hidden" name="amount" value="<?php echo $userArr['amount']; ?>"/> <input
								type="hidden" name="tax" value="<?php echo $userArr['tax']; ?>"/> <?php }?>
							<button class="btn btn-red btn-large" style="padding: 11px 40px;
margin-right: 15px;" type="submit">Proceed</button>
							<button class="btn btn-flat btn-large" type="button" style="width:175px;"
							        onClick="back_to_checkout('<?php echo $base_url;?>')">Back To Cart
							</button>
						</div>
					</form>
				</div>
				<div class="panelSeperator" style="height:1300px;"></div>
				<div class="rightPanel" style="width: auto;">
					<div class="cartSummaryHolder inlineBlock">
						<div class="cartHeader">
							<div class="cartTransparent"></div>
							<div class="cartContents">
								<div class="labelFont">Cart Summary</div>
							</div>
						</div>
						<div class="summaryWrapper">
							<div class="summaryTransparent"></div>
							<div class="summaryContents">
								<div class="sumRow">
									<div class="subText">Sub Total</div> <?php if ($coming_from == 0) { ?>
										<div class="subAmount"><span class="rupee">`</span><?php echo $amount; ?>
										</div> <?php } else { ?>
										<div class="subAmount"><span
												class="rupee">`</span><?php echo $userArr['amount']; ?>
										</div> <?php }?> </div>
								<div class="sumRow">
									<div class="subText">Shipping Charges</div>
									<div class="subAmount"><span class="rupee">`</span> 00.00</div>
								</div>
								<!-- <div class="sumRow">
									<div class="subText">Taxes</div> <?php if ($coming_from == 0) { ?>
										<div class="subAmount"><span class="rupee">`</span><?php echo $tax; ?>
										</div> <?php } else { ?>
										<div class="subAmount"><span
												class="rupee">`</span><?php echo $userArr['tax']; ?></div> <?php }?>
								</div> -->
							</div>
						</div>
						<div class="totalWrapper">
							<div class="totalTransparent"></div>
							<div class="totalContents">
								<div class="totalText">Total</div> <?php if ($coming_from == 0) { ?>
									<div class="totalAmt"><span class="rupee">`</span><?php echo $amount; ?>
									</div> <?php } else { ?>
									<div class="totalAmt"><span class="rupee">`</span><?php echo $userArr['amount']; ?>
									</div> <?php }?> </div>
						</div>
					</div>
					<!-- <div class="needHelpContainer"> <div class="labelFont">Need Help?</div> <div class="paddingtop"><a href="javascript:void(0)" class="linkText">Email assistance</a></div> <div class="paddingtop"><a href="javascript:void(0)" class="linkText">FAQs</a></div> <div class="paddingtop"><a href="javascript:void(0)" class="linkText">Call Customer Care</a></div> </div>-->
				</div>
			</div>
		</section>
	</section> <?php include "footer.php" ?> </body>
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