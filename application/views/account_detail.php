<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Account Details</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_owner_profile.css"/>
    <style type="text/css">
        .profile_header {
            background-image: none !important;
            background-color: #F7F7F7 !important;
        }

        .prtext {
            color: #e81c4d;
        }
    </style>
    <!--[if IE]>
    <link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] -->
    <script type="text/javascript">
        $(function () {
            tooltip2();
        });
    </script>
</head>
<body>
<section class="wrapper">
<article class="banner">
    <div class="bannerIE2">
        <div class="slide">
            <div class="topBanerPatternContainer"></div>
            <div class="bannerAuto">

                <div class="owner_pic">
                    <?php $userImageSrc = (strcmp($userinfo[0]->fb_uid, "non-fb-member") === 0)? $baseURL."assets/images/default/".((strcmp($userinfo[0]->gender, "female") === 0)? "female": "male").".png": "https://graph.facebook.com/".$userinfo[0]->fb_uid."/picture?width=200&height=200"; ?>
                    <img width="156px" height="156px" src="<?php echo $userImageSrc; ?>" alt="<?php echo $userinfo[0]->full_name; ?>"/>
                </div>

                <div class="bannerMid">
                    <div class="owner_name"><?php echo strtoupper(strtolower($userinfo[0]->full_name));?></div>
                    <div class="merbershipDate">Member
                        since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
                    <div
                        class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
                            for ($i = 0; $i < $n; $i++): ?>
                                <img src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>"
                                     class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div>
        <div class="platinumBadge"></div>-->
                            <div class="pinkBadge"><a href="<?php echo $base_url . '#/badges'?>">
                                    <div class="white_text">+<?php echo count($badges) - $n; ?></div>
                                </a></div> <?php endif; ?> </div>
                </div>
                <div class="bannerRight">
                    <!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div>
                      </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
                    <a href="<?php echo $base_url . "order/user_fancy_product"; ?>">
                        <div class="logoBox">
                            <div class="iconFancy"></div>
                            <div class="logoNumber"><?php echo $countfprod; ?></div>
                            <div class="logoText">fancy</div>
                        </div>
                    </a>
                    <!--                    <a href="--><?php //echo $base_url . "index.php/poll/create_poll"; ?><!--">-->
                    <!--						<div class="logoBox borderRight">-->
                    <!--							<div class="PollIconPlus"></div>-->
                    <!--							<div class="logoText">-->
                    <!--								<div>Create</div>-->
                    <!--								<div>Poll</div>-->
                    <!--							</div>-->
                    <!--						</div>-->
                    <!--					</a>-->
                </div>
            </div>
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
                <div class="productsLink">
                    <div class="profileLogoGrey"></div>
                    <div class="productsText newPadding">Profile</div>
                </div>
            </a>

            <a href="<?php echo $base_url; ?>user_info/account_detail">
                <div class="dashboardLink">
                    <div class="accountLogoPink"></div>
                    <div class="activeText">Account</div>
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

                <!--                <a href="--><?php //echo $base_url; ?><!--user_info/invite">-->
                <!--                    <div class="productsLink">-->
                <!--                        <div class="inviteLogo2"></div>-->
                <!--                        <div class="productsText newPadding">Invite People</div>-->
                <!--                    </div>-->
                <!--                </a>-->

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


<div class="leftPanel" id="show">
    <div class="personalDetails">
        <div class="personalDetailLogo"></div>
        <div class="personalText">Account Details</div>
        <input type="button" value="Edit Account" class="followingButton" id="button"
               style="margin-left:420px; margin-top:-40px;"/>
    </div>
    <div class="topDotSeparator newtopDotSeparator2"></div>
    <div class="aboutMeContent clear_both"> <?php if (isset($userinfo[0]->nick_name)): ?> <!-- <div class="darkBlackText">
                     <?php echo $userinfo[0]->full_name;?><span class="lightText">Name</span></div> --> <?php endif; ?> <?php if (isset($userinfo[0]->gender)): ?>
            <!-- <div class="darkBlackText"><?php echo $userinfo[0]->gender;?><span class="lightText">gender</span></div> --> <?php endif; ?>
        <?php //if (isset($userinfo[0]->date_of_birth)):?> <!--<div class="darkBlackText">
                       <?php //echo date("j-F-Y ", strtotime($userinfo[0]->date_of_birth)); ?><span class="lightText">birthday</span></div>--> <?php //endif; ?>
        <?php if (isset($userinfo[0]->email)): ?>
            <div class="darkBlackText"><span
                    class="lightText">email:</span><?php echo $userinfo[0]->email;?>
            </div> <?php endif; ?>
        <?php if (isset($userinfo[0]->address)): ?>
            <div class="darkBlackText paddingBottom0"><?php echo $userinfo[0]->address;?><span
                    class="lightText">Address</span>
            </div> <?php endif; ?> <?php if (isset($userinfo[0]->city)): ?>
            <div class="darkBlackText paddingBottom0">
                <?php echo $userinfo[0]->city;?><span class="lightText">city</span>
            </div> <?php endif; ?>
        <?php if (isset($userinfo[0]->state)): ?>
            <div class="darkBlackText"><?php echo $userinfo[0]->state;?>
                <span class="lightText">state</span>
            </div> <?php endif; ?> <?php if (isset($userinfo[0]->country)): ?>
            <div class="darkBlackText"><?php echo $userinfo[0]->country;?><span class="lightText">country</span>
            </div>
        <?php endif; ?> <?php if (isset($userinfo[0]->mob)): ?>
            <div class="darkBlackText">+<?php echo $userinfo[0]->country_code;?>
                <?php echo $userinfo[0]->mob;?><span class="lightText">mobile</span>
            </div> <?php endif; ?>
        <!--<?php if (isset($userinfo[0]->interested_in)):?> <div class="darkBlackText"><?php echo $userinfo[0]->interested_in;?>
                             <span class="lightText">interests</span></div> <?php endif; ?>-->
        <!--<?php if (isset($userinfo[0]->taste)):?>
                              <div class="darkBlackText"><?php echo $userinfo[0]->taste;?><span class="lightText">my tastes</span></div> <?php endif; ?>-->
    </div>
</div>


<div class="leftPanel" id="hide" style="display:none;">
    <div class="personalDetails">
        <div class="personalDetailLogo"></div>
        <div class="personalText">Edit Account Details</div>
    </div>
    <div class="topDotSeparator newtopDotSeparator2"></div>
    <div class="ActualContents">
        <form name="person_details" action="<?php echo $base_url . 'user_info/save_account_details'; ?>"
              method="post">
            <!--  <div class="formRow"> <div class="labelText">Name</div> <input type="text" placeholder="enter your full name" name="person_nickname"
     id="person_nickname" value="<?php echo $userinfo[0]->full_name;?>" /> </div>-->
            <!--   <?php if($userinfo[0]->gender == 'male') { $male="checked=TRUE"; $female=""; } else { $male = ""; $female = "checked=TRUE"; } ?>
   <div class="formRow"> <div class="labelText">Gender</div> <div class="radioText">
  <div class="radio1"><input type="radio" id="male" name="sex" value="male" <?php echo $male ?> /></div>
 <div class="checkText">Male</div> </div> <div class="radioText"> <div class="radio1">
 <input type="radio" id="female" name="sex" value="female" <?php echo $female ?> /></div> <div class="checkText">Female</div> </div> </div>-->
            <!-- <div class="formRow"> <div class="labelText">Birthday</div> <input type="text" class="birthday" placeholder="date-month-year" name="birth_date" id="birth_date" value="<?php echo date("d-m-Y ", strtotime($userinfo[0]->date_of_birth)) ;?>" /> </div>-->
            <div class="formRow">
                <div class="labelText">Email</div>
                <input type="email" placeholder="enter your valid email Id" name="person_email"
                       id="person_email" value="<?php echo $userinfo[0]->email;?>"/>
            </div>
            <div class="formRow">
                <div class="labelText">Address</div>
                <div class="sideForm">
                    <textarea id="street_address" placeholder="street address" name="street_address">
                        <?php echo $userinfo[0]->address;?></textarea>

                    <div class="twoTextField"><input type="text" class="addressWidth" placeholder="city"
                                                     name="cityName" id="cityName"
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
                                <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
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
                        <div class="category1" style="width: 244px;">
                            <select class="drop1" name="countryName" id="countryName">
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
                <input type="text" placeholder="country code" class="countryCode" name="country_code"
                       id="country_code" value="<?php echo $userinfo[0]->country_code;?>"/>
                <input type="text" placeholder="enter your 10 digit mobile number" class="mobileNo"
                       maxlength="10"
                       name="mobile_no" id="mobile_no" value="<?php echo $userinfo[0]->mob;?>"/></div>

            <!--  <div class="formRow"> <div class="labelText">About Me</div> <textarea id="about_me" placeholder="tell us about yourself" name="about_me">
  <?php echo $userinfo[0]->about_me;?></textarea> </div>
   <div class="formRow"> <div class="labelText">Interests</div> <div class="sideForm">
    <?php $interest=explode(',', (string)$userinfo[0]->interested_in); $home = ""; $fas = ""; $art = ""; $gizmos = ""; $pers = ""; $ns = "";
     for($i=0 ; $i <count($interest) ; $i++) { if($interest[$i] == "Home Decor") $home = "Checked";
 elseif($interest[$i] == "fashion") $fas = "Checked"; elseif($interest[$i] == "art") $art = "Checked";
  elseif($interest[$i] == "gizmos") $gizmos = "Checked"; elseif($interest[$i] == "personal care") $pers = "Checked"; 
  elseif($interest[$i] == "new stores") $ns = "Checked"; } //print_r($interest); ?> <div class="checkBoxText">
  <div class="checkbox"><input type="checkbox" name="check1[]" value="Home Decor" checked="<?php echo $home; ?>" /></div>
  <div class="checkText">Home Decor</div> <div class="checkbox"><input type="checkbox" name="check1[]" value="Fashion" <?php echo $fas; ?>/></div>
  <div class="checkText">Fashion</div> <div class="checkbox"><input type="checkbox" name="check1[]" value="Art" <?php echo $art; ?>/></div>
  <div class="checkText">Art</div> </div> <div class="checkBoxText"> <div class="checkbox">
  <input type="checkbox" name="check1[]" value="Gizmos" <?php echo $gizmos; ?>></div>
   <div class="checkText">Gizmos</div> <div class="checkbox">
   <input type="checkbox" name="check1[]" value="Personal Care" <?php echo $pers; ?>/></div>
    <div class="checkText">Personal Care</div> <div class="checkbox">
    <input type="checkbox" name="check1[]" value="New stores" checked="<?php echo $ns; ?>" /></div>
     <div class="checkText">New stores</div> </div> </div> </div> <div class="formRow"> 
     <div class="labelText">My Tastes</div> <input type="text" 
    placeholder="eg: Art, Fashion, Toys..." name="tastes" id="tastes" value="<?php echo $userinfo[0]->taste;?>" /> </div>-->


            <a href="javascript:void(0)"
               onclick="document.getElementById('popup').style.display='block';document.getElementById('fade').style.display='block'">
                <input type="button" class="prod_cancel" value="Change Password"
                       style="width:200px;height:35px; "/></a><br/><br/><br/><br/><br/>
            <button class="prod_continue save_width" onClick="return formValidate()" type="submit">
                Save
            </button>
            <a href="<?php echo base_url();?>user_info/account_detail">
                <button class="prod_cancel" type="button">Cancel</button>
            </a>

        </form>
    </div>


</div>


<div class="qcont popup" id="popup">
    <div class="close"><a href="javascript:void(0)"
                          onclick="document.getElementById('popup').style.display='none';document.getElementById('fade').style.display='none'">
            <img src="../assets/images/close.png"/></a></div>
    <div class="main">
        <!-- <div class="header"> -->
        <div style="float:left;">
            <h3>Change Your Password</h3></br>
        </div>
        <!-- </div> -->

<span style="color:red; padding-left:380px;">
<div class="contdiv bor">
    <form action="<?php print base_url();?>user_info/password" method="post" id="change_password"
          name="change_password">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="34%" height="30" align="left" valign="top">New Password</td>
                <td width="66%" height="30" align="left" valign="middle"><input type="password" name="new_password"
                                                                                id="new_password"/><br/>

                    Minimum 6 characters
                    <span id="new_password_error" style="color:red"></span>
                </td>
            </tr>
            <tr>
                <td height="30" align="left" valign="top">Confirm Password</td>
                <td height="30" align="left" valign="middle"><input type="password" name="confirm_password"
                                                                    id="confirm_password"/>
                    <span id="confirm_password_error" style="color:red"></span>
                </td>
            </tr>
        </table>
</div>
<div class="contdiv bor">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="34%" height="30" align="left" valign="top">&nbsp;</td>
            <td width="66%" height="30" align="left" valign="middle">
                <div style="float:left;"><input type="submit" value="Save Changes" name="submit"/></div>
            </td>
        </tr>
    </table>
    </form>
</div>
    </div>
</div>
<div id="fade" class="black_overlay"></div>

</div>
</div>
</div>
</section>
</section> <?php include "friends_follower.php" ?> <?php include "footer.php" ?> </body>
<script>
    $(".pricon").attr("src", "<?php echo $base_url; ?>assets/images/dropprofile_hover.png");
    $(".pricon").siblings(".value").html(' ');
</script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_owner.js"></script>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#button").click(function () {
            $("#show").toggle();

        });
        $("#button").click(function () {
            $("#hide").toggle();
        });
    });
</script>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    $(document).ready(function () {
        $("#fisrtitem").click(function () {
            $("#firstimg").show();
            $("#secimg").hide();
            $("#thirdimg").hide();
            $("#fourimg").hide();


        });

        $("#secitem").click(function () {
            $("#secimg").show();
            $("#firstimg").hide();
            $("#thirdimg").hide();
            $("#fourimg").hide();
        });

        $("#thirditem").click(function () {
            $("#secimg").hide();
            $("#firstimg").hide();
            $("#thirdimg").show();
            $("#fourimg").hide();
        });

        $("#fouritem").click(function () {
            $("#secimg").hide();
            $("#firstimg").hide();
            $("#thirdimg").hide();
            $("#fourimg").show();
        });
    });
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script>
    $(document).ready(function () {
        $("#change_password").submit(function () {
            if ($("#new_password").val() == "") {

                $('#new_password_error').html("<br>Enter new password");
                return false;
            }
            else if ($("#new_password").val().length < 6) {
                $('#new_password_error').html("");
                $('#new_password_error').html("<br>Password must contain 6 digits or characters.");
                return false;
            }
            else if ($("#new_password").val() != $("#confirm_password").val()) {
                $('#new_password_error').html("");
                $('#new_password_error').html("");
                $('#confirm_password_error').html("<br>New Password and Confirm Password do not match");
                return false;
            }
            else {

                $('#new_password_error').html("");
            }
        });
    });

</script>

<style>
    .black_overlay {
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index: 1001;
        -moz-opacity: 0.5;
        opacity: .50;
        filter: alpha(opacity = 80);

    }

    .popup {
        display: none;
        position: fixed;
        top: 20px;
        left: 200px;
        width: 900px;
        padding: 15px;
        border: 3px solid #4f81bd;
        border-radius: 10px;
        background-color: white;
        z-index: 1002;

    }

    .close {
        position: absolute;
        height: 30px;
        width: 30px;

        top: -15px;
        right: -15px;
    }
</style>

</html>