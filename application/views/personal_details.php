<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Personal Details</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/friends_follower.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/checkout.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_owner_profile.css"/>

    <style type="text/css">
		.profile_header {
			background-image: none !important;
			background-color: #F7F7F7 !important;
		}

		.prtext {
			color: #e81c4d;
		}

		.panelSeperator {
			height: 1078px;
		}
	</style>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body>
<section class="wrapper">
	<article class="banner">
		<div class="bannerIE2">
			<div class="slide">
				<div class="topBanerPatternContainer"></div>
				<div class="bannerAuto">
					<div
						class="owner_pic"> <?php $filename = 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; if (file_exists($filename)): ?>
							<img width="156px" height="156px"
							     src="<?php echo $base_url . 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; ?>"
							     alt="Owner Pic"/> <?php else: ?> <img
							src="http://graph.facebook.com/<?php echo $fb_uid; ?>/picture?type=large" alt="Owner Pic"
							height="156" width="156"/> <?php endif; ?></div>
					<div class="bannerMid">
						<div class="owner_name"><?php echo ucwords(strtolower($userinfo[0]->full_name));?></div>
						<div class="merbershipDate">Member
							since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
						<div
							class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
								for ($i = 0; $i < $n; $i++): ?> <img
									src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>"
									class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
								<div class="pinkBadge"><a href="<?php echo $base_url . '#/badges'?>">
										<div class="white_text">+<?php echo count($badges) - $n; ?></div>
									</a></div> <?php endif; ?> </div>
					</div>
					<div class="bannerRight">
						<!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div> </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
						<a href="<?php echo $base_url . "order/user_fancy_product"; ?>">
							<div class="logoBox">
								<div class="iconFancy"></div>
								<div class="logoNumber"><?php echo $countfprod; ?></div>
								<div class="logoText">fancy</div>
							</div>
						</a>
<!--                        <a href="--><?php //echo $base_url . "index.php/poll/create_poll"; ?><!--">-->
<!--							<div class="logoBox borderRight">-->
<!--								<div class="PollIconPlus"></div>-->
<!--								<div class="logoText">-->
<!--									<div>Create</div>-->
<!--									<div>Poll</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</a>-->
                    </div>
				</div>
			</div>
	</article>
    <nav class="middleColumnTop">
        <div class="middleColumnIE">
            <div class="topDotSeparator newtopDotSeparator"></div>
            <div class="linksMiddle">
                <!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
                <a href="<?php echo $base_url; ?>user_info/user_detail">
                    <div class="dashboardLink">
                        <div class="profileLogoClick"></div>
                        <div class="activeText">Profile</div>
                    </div>
                </a>

                <a href="<?php echo $base_url; ?>user_info/account_detail">
                    <div class="productsLink">
                        <div class="accountLogoGrey"></div>
                        <div class="productsText newPadding">Account</div>
                    </div>
                </a>

                <a href="<?php echo $base_url; ?>order/user_fancy_product">
                    <div class="productsLink">
                        <div class="inviteLogoGrey"></div>
                        <div class="productsText newPadding">Fancy List</div>
                    </div>
                </a>

                <a href="<?php echo $base_url; ?>#/badges">
                    <div class="productsLink">
                        <div class="badgesLogoGrey"></div>
                        <div class="productsText newPadding">Badges Earned</div>
                    </div>
                </a>


                <!-- <a href="javascript:void(0)"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a>-->
                <div class="purchaseHistory">
                    <!--  <a href="<?php echo $base_url?>user_info/get_user_detail" ><button type="submit" class="followingButton"> Edit Profile </button></a> -->

<!--                    <a href="--><?php //echo $base_url; ?><!--user_info/invite">-->
<!--                        <div class="productsLink">-->
<!--                            <div class="inviteLogo2"></div>-->
<!--                            <div class="productsText newPadding">Invite People</div>-->
<!--                        </div>-->
<!--                    </a>-->

                    <a href="<?php echo $base_url?>user_info/purchase_history">
                        <div class="purchaseHistory">
                            <div class="purchaseHistoryLogo"></div>
                            <div class="purchaseText1">Purchase History</div>
                        </div>
                    </a></div>
                <div class="topDotSeparator newtopDotSeparator1"></div>
            </div>
    </nav>
	<section class="middleBackground">
		<div class="Ie8bg">
			<div class="contentsWrapper">
				<div class="middleContents">
					<div class="leftPanel">
						<div class="personalDetails">
							<div class="personalDetailLogo"></div>
							<div class="personalText">Personal Details</div>
						</div>
						<div class="topDotSeparator newtopDotSeparator2"></div>
						<div class="ActualContents">
							<form name="person_details"
							      action="<?php echo $base_url . 'user_info/save_personal_details'; ?>" method="post">
								<div class="formRow">
									<div class="labelText">Name</div>
									<input type="text" placeholder="enter your full name" name="person_nickname"
									       id="person_nickname" value="<?php echo $userinfo[0]->full_name;?>"/>
								</div> <?php if ($userinfo[0]->gender == 'male') {
									$male = "checked=TRUE";
									$female = "";
								} else {
									$male = "";
									$female = "checked=TRUE";
								} ?>
								<div class="formRow">
									<div class="labelText">Gender</div>
									<div class="radioText">
										<div class="radio1"><input type="radio" id="male" name="sex"
										                           value="male" <?php echo $male ?> /></div>
										<div class="checkText">Male</div>
									</div>
									<div class="radioText">
										<div class="radio1"><input type="radio" id="female" name="sex"
										                           value="female" <?php echo $female ?> /></div>
										<div class="checkText">Female</div>
									</div>
								</div>
								<!-- <div class="formRow"> <div class="labelText">Birthday</div> <input type="text" class="birthday" placeholder="date-month-year" name="birth_date" id="birth_date" value="<?php echo date("d-m-Y ", strtotime($userinfo[0]->date_of_birth)) ;?>" /> </div>-->
								<div class="formRow">
									<div class="labelText">Address</div>
									<div class="sideForm"><textarea id="street_address" placeholder="street address"
									                                name="street_address"><?php echo $userinfo[0]->address;?></textarea>

										<div class="twoTextField"><input type="text" class="addressWidth"
										                                 placeholder="city" name="cityName"
										                                 id="cityName"
										                                 value="<?php echo $userinfo[0]->city;?>"/>

											<div class="category1"><select class="drop1" name="stateName"
											                               id="stateName"> <?php if (!empty($userinfo[0]->state) || $userinfo[0]->state == "Null"): ?>
														<option selected="selected"
														        value="<?php echo $userinfo[0]->state; ?>"><?php echo $userinfo[0]->state; ?></option> <?php endif; ?>
													<option value="Andaman and Nicobar Islands">Andaman and Nicobar
														Islands
													</option>
													<option value="Andhra Pradesh">Andhra Pradesh</option>
													<option value="Arunachal Pradesh">Arunachal Pradesh</option>
													<option value="Assam">Assam</option>
													<option value="Bihar">Bihar</option>
													<option value="Chandigarh">Chandigarh</option>
													<option value="Chhattisgarh">Chhattisgarh</option>
													<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli
													</option>
													<option value="Daman and Diu">Daman and Diu</option>
													<option value="Delhi">Delhi</option>
													<option value="Goa">Goa</option>
													<option value="Gujarat">Gujarat</option>
													<option value="Haryana">Haryana</option>
													<option value="Himachal Pradesh">Himachal Pradesh</option>
													<option value="Jammu and Kashmir">Jammu and Kashmir</option>
													<option value="Jharkhand">Jharkhand</option>
													<option value="Karnataka">Karnataka</option>
													<option value="Kerala">Kerala</option>
													<option value="Lakshadweep">Lakshadweep</option>
													<option value="Madhya Pradesh">Madhya Pradesh</option>
													<option value="Maharashtra">Maharashtra</option>
													<option value="Manipur">Manipur</option>
													<option value="Meghalaya">Meghalaya</option>
													<option value="Mizoram">Mizoram</option>
													<option value="Nagaland">Nagaland</option>
													<option value="Orissa">Orissa</option>
													<option value="Pondicherry">Pondicherry</option>
													<option value="Punjab">Punjab</option>
													<option value="Rajasthan">Rajasthan</option>
													<option value="Sikkim">Sikkim</option>
													<option value="Tamil Nadu">Tamil Nadu</option>
													<option value="Tripura">Tripura</option>
													<option value="Uttaranchal">Uttaranchal</option>
													<option value="Uttar Pradesh">Uttar Pradesh</option>
													<option value="West Bengal">West Bengal</option>
												</select></div>
										</div>
										<div class="twoTextField">
											<div class="category1" style="width: 244px;"><select class="drop1"
											                                                     name="countryName"
											                                                     id="countryName">
													<option value="Country" selected="selected" disabled="disabled">
														Country
													</option>
													<option selected="selected" value="India">India</option>
												</select></div>
											<input type="text" class="addressWidth marginRight0" placeholder="pincode"
											       name="PinCode" id="PinCode" value="<?php echo $userinfo[0]->pin;?>"/>
										</div>
									</div>
								</div>
								<div class="formRow">
									<div class="labelText">Mobile</div>
									<input type="text" placeholder="country code" class="countryCode"
									       name="country_code" id="country_code"
									       value="<?php echo $userinfo[0]->country_code;?>"/> <input type="text"
									                                                                 placeholder="enter your 10 digit mobile number"
									                                                                 class="mobileNo"
									                                                                 maxlength="10"
									                                                                 name="mobile_no"
									                                                                 id="mobile_no"
									                                                                 value="<?php echo $userinfo[0]->mob;?>"/>
								</div>
								<!-- <div class="formRow"> <div class="labelText">Email</div> <input type="email" placeholder="enter your valid email Id" name="person_email" id="person_email" value="<?php //echo $userinfo[0]->email;?>" /> </div>-->
								<div class="formRow">
									<div class="labelText">About Me</div>
									<textarea id="about_me" placeholder="tell us about yourself"
									          name="about_me"><?php echo $userinfo[0]->about_me;?></textarea></div>
								<div class="formRow">
									<div class="labelText">Interests</div>
									<div
										class="sideForm"> <?php $interest = explode(',', (string)$userinfo[0]->interested_in); $home = ""; $fas = ""; $art = ""; $gizmos = ""; $pers = ""; $ns = ""; for ($i = 0; $i < count($interest); $i++) {
											if ($interest[$i] == "Home Decor") $home = "Checked"; elseif ($interest[$i] == "fashion") $fas = "Checked"; elseif ($interest[$i] == "art") $art = "Checked"; elseif ($interest[$i] == "gizmos") $gizmos = "Checked"; elseif ($interest[$i] == "personal care") $pers = "Checked"; elseif ($interest[$i] == "new stores") $ns = "Checked";
										} //print_r($interest); ?>
										<div class="checkBoxText">
											<div class="checkbox"><input type="checkbox" name="check1[]"
											                             value="Home Decor"
											                             checked="<?php echo $home; ?>"/></div>
											<div class="checkText">Home Decor</div>
											<div class="checkbox"><input type="checkbox" name="check1[]"
											                             value="Fashion" <?php echo $fas; ?>/></div>
											<div class="checkText">Fashion</div>
											<div class="checkbox"><input type="checkbox" name="check1[]"
											                             value="Art" <?php echo $art; ?>/></div>
											<div class="checkText">Art</div>
										</div>
										<div class="checkBoxText">
											<div class="checkbox"><input type="checkbox" name="check1[]"
											                             value="Gizmos" <?php echo $gizmos; ?>></div>
											<div class="checkText">Gizmos</div>
											<div class="checkbox"><input type="checkbox" name="check1[]"
											                             value="Personal Care" <?php echo $pers; ?>/>
											</div>
											<div class="checkText">Personal Care</div>
											<div class="checkbox"><input type="checkbox" name="check1[]"
											                             value="New stores"
											                             checked="<?php echo $ns; ?>"/></div>
											<div class="checkText">New stores</div>
										</div>
									</div>
								</div>
								<div class="formRow">
									<div class="labelText">My Tastes</div>
									<input type="text" placeholder="eg: Art, Fashion, Toys..." name="tastes" id="tastes"
									       value="<?php echo $userinfo[0]->taste;?>"/></div>
								<button class="prod_continue save_width" onClick="return formValidate()" type="submit">
									Save
								</button>
								<button class="prod_cancel" type="submit">Cancel</button>
							</form>
						</div>
					</div>
					<div class="panelSeperator newpanelHeight"></div>
					<div class="rightPanel">
						<!-- <div class="darkText paddingBottom0">Shoutbox</div> <div class="FirstImageContainer"> <div class="commentRow"> <a href="javascript:void(0)"><div class="float_left"> <img src="<?php echo $base_url; ?>assets/images/shoubox_1.png"/> </div></a> <div class="sideDiv"> <a href="javascript:void(0)" class="nameofperson">Rex Allen</a><span class="lightText">says</span><span class="duration">10 mins ago</span> <div class="comment">This is even my’n fav product :)</div> </div> </div> <div class="commentRow clear_both"> <a href="javascript:void(0)"><div class="float_left"> <img src="<?php echo $base_url; ?>assets/images/shoubox_2.png"/> </div></a> <div class="sideDiv"> <a href="javascript:void(0)" class="nameofperson">Leanna</a><span class="lightText">says</span><span class="duration">30 mins ago</span> <div class="comment">Wow this is awesone, i want some...</div> </div> </div> <div class="commentRow clear_both"> <a href="javascript:void(0)"><div class="float_left"> <img src="<?php echo $base_url; ?>assets/images/shoubox_1.png"/> </div></a> <div class="sideDiv"> <a href="javascript:void(0)" class="nameofperson">Rex Allen</a><span class="lightText">says</span><span class="duration">10 mins ago</span> <div class="comment">This is even my’n fav product :)</div> </div> </div> <div class="commentTextBox"> <input type="text" id="commentLine" name="comments"/> <div class="enterImage"></div> </div> </div>-->
						<div class="horizontalSep clear_both"></div>
						<div class="FriendsContainer">
							<div class="friendsHeader">
								<div class="friendsIcon"></div>
								<a href="javascript:void(0)" class="darkText float_left posText">Friends</a>

								<div class="pinkText"><?php echo count($friends); ?></div>
							</div>
							<div
								class="FirstRow clear_both"> <?php if (count($friends) > 6) $n = 6; else $n = count($friends); for ($i = 0; $i < $n; $i++): ?>
									<a href="<?php echo $base_url . 'order/friend_fancy_product/' . $friends[$i]['user_id'] ?>">
										<div class="prodBg"><img
												src="<?php echo $base_url; ?>assets/images/users/<?php echo $friends[$i]['user_id'] . '/' . $friends[$i]['user_id'] . '_large.jpg'; ?>"
												width="60" height="60"/></div>
									</a> <?php endfor;?> </div>
						</div>
						<div class="horizontalSep"></div>
						<div class="FriendsContainer">
							<div class="friendsHeader">
								<div class="followersIcon"></div>
								<div class="darkText float_left posText">Followers</div>
								<div class="pinkText"><?php echo count($followers); ?></div>
							</div>
							<div
								class="FirstRow clear_both"> <?php if (count($followers) > 6) $n = 6; else $n = count($followers); for ($i = 0; $i < $n; $i++): ?>
									<a href="<?php echo $base_url . 'order/friend_fancy_product/' . $followers[$i]['user_id'] ?>">
										<div class="prodBg"><img
												src="<?php echo $base_url; ?>assets/images/users/<?php echo $followers[$i]['user_id'] . '/' . $followers[$i]['user_id'] . '_large.jpg'; ?>"
												width="62" height="62"/></div>
									</a> <?php endfor;?> </div>
						</div>
						<div class="horizontalSep"></div>
						<div class="FriendsContainer">
							<div class="friendsHeader">
								<div class="followingIcon"></div>
								<div class="darkText float_left posText">Following</div>
								<div class="pinkText"><?php echo count($followees); ?></div>
							</div>
							<div
								class="FirstRow clear_both"> <?php if (count($followees) > 6) $n = 6; else $n = count($followees); for ($i = 0; $i < $n; $i++): ?>
									<a href="<?php echo $base_url . 'order/friend_fancy_product/' . $followees[$i]['user_id'] ?>">
										<div class="prodBg"><img
												src="<?php echo $base_url; ?>assets/images/users/<?php echo $followees[$i]['user_id'] . '/' . $followees[$i]['user_id'] . '_large.jpg'; ?>"
												width="62" height="62"/></div>
									</a> <?php endfor;?> </div>
						</div>
						<!-- <div class="horizontalSep"></div> <div class="scrollerHolderParent"> <a href="javascript:void(0)"><div class="darkText">Poll</div></a> <div class="scrollerHolderContent"> <div class="storeViewIcon"></div> <div class="scrollerContents"> <div id="scrollLeftButton_1" class="button-block-left"></div> <div id="sliderParentDiv1" class="sliderParentDiv"> <div id="slider4" class="slider"> <div class="slideList"> <div class="sunglassWrapper"> <div class="quesTextStyle">Which Sunglass is the Best?</div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_1.png"/> </div></a> <button id="vote" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_2.png"/> </div></a> <button id="vote2" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_3.png"/> </div></a> <button id="vote3" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> </div> </div> <div class="slideList"> <div class="sunglassWrapper"> <div class="quesTextStyle">Which Sunglass is the Best?</div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_1.png"/> </div></a> <button id="vote4" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_2.png"/> </div></a> <button id="vote5" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_3.png"/> </div></a> <button id="vote6" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> </div> </div> <div class="slideList"> <div class="sunglassWrapper"> <div class="quesTextStyle">Which Sunglass is the Best?</div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_1.png"/> </div></a> <button id="vote7" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_2.png"/> </div></a> <button id="vote8" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> <div class="sunglassImageDiv"> <a href="javascript:void(0)"><div class="sunglassProduct"> <img src="<?php echo $base_url; ?>assets/images/poll_3.png"/> </div></a> <button id="vote9" class="voteButton marginStyle" name="vote" type="button">Vote</button> </div> </div> </div> </div> </div> <div id="scrollRightButton_1" class="button-block-right"></div> </div> </div> </div>-->
						<!-- <div class="horizontalSep"></div> <div class="scrollerHolderParent"> <a href="javascript:void(0)"><div class="darkText">Blogzine</div></a> <div class="scrollerHolderContent"> <div class="storeViewIcon"></div> <div class="scrollerContentsblog"> <div id="scrollLeftButton_2" class="button-block-left"></div> <div id="sliderParentDiv2" class="sliderParentDiv"> <div id="sliderblog" class="sliderblog"> <div class="slideList2"> <a href="javascript:void(0)"><div class="BlogWrapper"> <div class="quesTextStyle paddingBottom0">Jeans Styles for Girls</div> <div class="brandText"><span class="diffColour">by</span>Tianna Meilinger</div> <div class="blogImage"> <img src="<?php echo $base_url; ?>assets/images/blogImage.png"/> </div> <div class="blogAbout">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div></a> </div> <div class="slideList2"> <a href="javascript:void(0)"><div class="BlogWrapper"> <div class="quesTextStyle paddingBottom0">Jeans Styles for Girls</div> <div class="brandText"><span class="diffColour">by</span>Tianna Meilinger</div> <div class="blogImage"> <img src="<?php echo $base_url; ?>assets/images/blogImage.png"/> </div> <div class="blogAbout">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div></a> </div> <div class="slideList2"> <a href="javascript:void(0)"><div class="BlogWrapper"> <div class="quesTextStyle paddingBottom0">Jeans Styles for Girls</div> <div class="brandText"><span class="diffColour">by</span>Tianna Meilinger</div> <div class="blogImage"> <img src="<?php echo $base_url; ?>assets/images/blogImage.png"/> </div> <div class="blogAbout">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div></a> </div> </div> </div> <div id="scrollRightButton_2" class="button-block-right"></div> </div> </div> </div> <div class="horizontalSep clear_both"></div> <div class="rightPanelbottomScroller"> <a href="javascript:void(0)"><div class="darkText">Styleboard</div></a> <div class="scrollerHolderContent"> <div class="storeViewIcon"></div> <div class="scrollerContents3"> <div class="button-block-left" id="scrollLeftButton5"></div> <div id="sliderParentDiv_5" class="sliderParentDiv3"> <div class="slider3" id="slider5"> <div class="store-list3"> <div class="rightPanelImageHolderBottom3"> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_1.png" /></a></div> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_2.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_3.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_4.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_5.png" /></a></div> <div class="clothingFestivalText clothingTextStyle paddingTop8">Clothing Festival </div> <div class="createdJuneText clothingTextStyle">created on <span class="rockwellSpan">june 23</span></div> <div class="storeFancyHolder storeFancyHolderNew"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list3"> <div class="rightPanelImageHolderBottom3"> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_1.png" /></a></div> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_2.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_3.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_4.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_5.png" /></a></div> <div class="clothingFestivalText clothingTextStyle paddingTop8">Clothing Festival </div> <div class="createdJuneText clothingTextStyle">created on <span class="rockwellSpan">june 23</span></div> <div class="storeFancyHolder clothingTextStyle storeFancyHolderNew"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> </div> </div> <div class="button-block-right" id="scrollRightButton5"></div> </div> </div> </div>-->
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "friends_follower.php" ?> <?php include "footer.php" ?> </body>
<script src="<?php echo $base_url; ?>assets/js/friend_follower.js"></script>
<script src="<?php echo $base_url; ?>assets/js/store_owner.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script src="<?php echo $base_url; ?>assets/js/tooltip.js"></script>
<script type="text/javascript">
	$(".pricon").attr("src", "<?php echo $base_url; ?>assets/images/dropprofile_hover.png");
	$(".pricon").siblings(".value").html(' ');
	$(function () {
		$(document).click(function (e) {
			var $clicked = $(e.target);
			if (!$clicked.parents().hasClass("sbHolder")) {
				$(".sbOptions").css({"top": "30px", "max-height": "243px", "display": "none"});
			}
			$(".sbToggle a").removeClass("sbToggleOpen");
		});
	});
</script>
</html>