<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Fancy Lists</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
    <style type="text/css">
        .fancy_header {
            background-image: none !important;
            background-color: #F7F7F7 !important;
        }

        .ftext {
            color: #e81c4d;
        }
    </style>
    <!--[if IE]>
    <link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body> <?php //include_once('header2.php'); ?> <input type="hidden" value="<?php echo $base_url; ?>" id="baseurl"/>
<section class="wrapper">
<article class="banner">
    <div class="slide">
        <div class="topBanerPatternContainer"></div>
        <div class="bannerAuto">
            <div
                class="owner_pic"> <?php $filename = 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; if (file_exists($filename)): ?>
                    <img width="156px" height="156px"
                         src="<?php echo $base_url . 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; ?>"
                         alt="Owner Pic"/> <?php else: ?> <img
                    src="http://graph.facebook.com/<?php echo $fb_uid; ?>/picture?type=large" alt="Owner Pic"
                    height="156" width="156"/> <?php endif; ?> </div>
            <div class="bannerMid bannerwidth">
                <div class="owner_name"><?php echo ucwords(strtolower($userinfo[0]->full_name));?></div>
                <div class="merbershipDate">Member
                    since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
                <div
                    class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
                        for ($i = 0; $i < $n; $i++): ?> <img
                            src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>"
                            class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
                        <div class="pinkBadge"><a href="<?php echo $base_url . 'user_info/badges/'?>">
                                <div class="white_text">+<?php echo count($badges) - $n; ?></div>
                            </a></div> <?php endif; ?> </div>
            </div>
            <div class="bannerRight">
                <!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div> </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
                <a href="<?php echo $base_url . "order/user_fancy_product"; ?>">
                    <div class="logoBoxActive">
                        <div class="iconFancyActive"></div>
                        <div class="logoNumber"><?php echo $countfprod; ?></div>
                        <div class="logoText">fancy</div>
                    </div>
                </a>
                <!--                    <a href="--><?php //echo $base_url . "index.php/poll/create_poll"; ?><!--">-->
                <!--						<div class="logoBox borderLeft0 borderRight">-->
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
                <div class="productsLink">
                    <div class="accountLogoGrey"></div>
                    <div class="productsText newPadding">Account</div>
                </div>
            </a>

            <a href="<?php echo $base_url; ?>order/user_fancy_product">
                <div class="dashboardLink">
                    <div class="inviteLogoPink"></div>
                    <div class="activeText">Fancy List</div>
                </div>
            </a>

            <a href="<?php echo $base_url; ?>user_info/badges/">
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
    <div class="fancyContentsContainer">
        <div class="fancyForHeight">
            <div class="sortByContainer">
                <div class="sortByContainerTransparent"></div>
                <div class="sortByContent">
                    <div class="fancyLinksContainer"><a href="<?php echo $base_url?>order/user_fancy_product"
                                                        class="fl">
                            <div class="fancyLink">My Fancy products</div>
                            <div class="fancyBox"><?php echo $countfprod; ?></div>
                        </a>

<!--                        <div class="fancySeperator"></div>-->
<!--                        <a href="--><?php //echo $base_url?><!--order/user_fancy_store" class="fl">-->
<!--                            <div class="fancyLink">My Fancy Stores</div>-->
<!--                            <div class="fancyBox">--><?php //echo $countfstore; ?><!--</div>-->
<!--                        </a>-->

                        <div class="fancySeperator"></div>
                        <a href="<?php echo $base_url?>order/fancy_lists" class="fl">
                            <div class="fancyLinkActive">Lists</div>
                            <div class="fancyBox"><?php echo $countflist; ?></div>
                        </a>
                        <!-- <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Blogazine</div> <div class="fancyBox">35</div> </a> <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Styleboard</div> <div class="fancyBox">35</div> </a>-->
                        <!-- <button id="add_list" class="addList" type="button">Add List</button>--> </div>
                </div>
            </div>
            <div class="fancyStoreContainer"> <!-- <input type="hidden" id="HiddenFieldForDelete" value=""/>-->
                <div class="leftPanel"> <?php for ($i = 0; $i < count($mylistdef); $i++): ?>
                        <div class="leftPanelList" id="leftPanelList_<?php echo $i + 1;?>">
                            <div class="listNormal_<?php echo $i + 1;?> listNormal">
                                <div class="detailListName"><?php echo $mylistdef[$i]->fancy_list_name;?></div>
                                <div class="functinalityDiv">
                                    <div class="itemsQuantity"><?php echo $prod_count_def[$i][0]->product_count;?>
                                        items
                                    </div>
                                </div>
                            </div>
                            <div class="listHover_1 listHover"
                                 onClick="return fancyDetailList(<?php echo $mylistdef[$i]->fancy_list_id;?>)">
                                <div class="detailListName"><?php echo $mylistdef[$i]->fancy_list_name;?></div>
                                <div class="functinalityDiv">
                                    <div class="itemsQuantity"><?php echo $prod_count_def[$i][0]->product_count;?>
                                        items
                                    </div>
                                    <!-- <div class="deleteDetailList"><input type="hidden" class="HiddenFieldForFancyList" value="HOME & DECOR"/></div>-->
                                </div>
                            </div>
                        </div> <?php endfor;?> <?php if (isset($mylistuser)) if (count($mylistuser) > 0): ?> <?php for ($i = 0; $i < count($mylistuser); $i++): ?>
                        <div class="leftPanelList"
                             id="leftPanelList_1_<?php echo $mylistuser[$i]->fancy_list_id;?>">
                            <div class="listNormal_<?php echo $i + 1;?> listNormal">
                                <div class="detailListName"><?php echo $mylistuser[$i]->fancy_list_name;?></div>
                                <div class="functinalityDiv">
                                    <div class="itemsQuantity"><?php echo $prod_count_user[$i][0]->product_count;?>
                                        items
                                    </div>
                                </div>
                            </div>
                            <div class="listHover_2 listHover"
                                 onClick="return fancyDetailList(<?php echo $mylistuser[$i]->fancy_list_id;?>)">
                                <div class="detailListName"><?php echo $mylistuser[$i]->fancy_list_name;?></div>
                                <div class="functinalityDiv">
                                    <div class="itemsQuantity"><?php echo $prod_count_user[$i][0]->product_count;?>
                                        items
                                    </div>
                                    <div class="deleteDetailList"><input type="hidden"
                                                                         class="HiddenFieldForFancyList"
                                                                         value="<?php echo " " . strtoupper($mylistuser[$i]->fancy_list_name) . " ";?>"/><input
                                            type="hidden" class="HiddenFieldForDelete"
                                            value="<?php echo $mylistuser[$i]->fancy_list_id;?>"/></div>
                                </div>
                            </div>
                        </div> <?php endfor; ?> <?php endif;?>
                    <!-- <div class="leftPanelList" id="leftPanelList_3"> <div class="listNormal_3 listNormal"> <div class="detailListName">MEDIA</div> <div class="functinalityDiv"> <div class="itemsQuantity">35 items</div> </div> </div> <div class="listHover_3 listHover" onClick="return fancyDetailList(3)"> <div class="detailListName">MEDIA</div> <div class="functinalityDiv"> <div class="itemsQuantity">35 items</div> <div class="deleteDetailList"><input type="hidden" class="HiddenFieldForFancyList" value="MEDIA"/></div> </div> </div> </div> <div class="leftPanelList" id="leftPanelList_4"> <div class="listNormal_4 listNormal"> <div class="detailListName">SHOES</div> <div class="functinalityDiv"> <div class="itemsQuantity">35 items</div> </div> </div> <div class="listHover_4 listHover" onClick="return fancyDetailList(4)"> <div class="detailListName">SHOES</div> <div class="functinalityDiv"> <div class="itemsQuantity">35 items</div> <div class="deleteDetailList"><input type="hidden" class="HiddenFieldForFancyList" value="SHOES"/></div> </div> </div> </div> <div class="leftPanelList" id="leftPanelList_5"> <div class="listNormal_5 listNormal"> <div class="detailListName">TRAVEL &amp; DESTINATIONS</div> <div class="functinalityDiv"> <div class="itemsQuantity">35 items</div> </div> </div> <div class="listHover_5 listHover" onClick="return fancyDetailList(5)"> <div class="detailListName">TRAVEL &amp; DESTINATIONS</div> <div class="functinalityDiv"> <div class="itemsQuantity">35 items</div> <div class="deleteDetailList"><input type="hidden" class="HiddenFieldForFancyList" value="TRAVEL & DESTINATIONS"/></div> </div> </div> </div>-->
                </div>
                <div class="panelSeparator"></div>
                <div class="rightPanel rightPanelNewStyle">
                    <!-- <div class="rightPanelImageHolders"> <a href="javascript:void(0)"><img src="images/image_scroller2.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> <div class="rightPanelImageHolders marginRight0"> <a href="javascript:void(0)"><img src="images/image_scroller1.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> <div class="rightPanelImageHolders clear_both"> <a href="javascript:void(0)"><img src="images/image_1.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> <div class="rightPanelImageHolders"> <a href="javascript:void(0)"><img src="images/image_2.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> <div class="rightPanelImageHolders marginRight0"> <a href="javascript:void(0)"><img src="images/image_3.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> <div class="rightPanelImageHolders clear_both"> <a href="javascript:void(0)"><img src="images/image_scroller1.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> <div class="rightPanelImageHolders"> <a href="javascript:void(0)"><img src="images/image_1.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div> <div class="rightPanelImageHolders marginRight0"> <a href="javascript:void(0)"><img src="images/image_3.png"/></a> <div class="fl"> <div class="storeDecoratingText">Decorating vases</div> <div class="storeDecoratingText font12">Copplestore</div> <div class="storeFancyHolder"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> <div class="priceHolder"><span class="rupee">`</span> 3800</div> </div>-->
                    <div id="more_detail_1" class="slideBackground moreWidthStyle3 clear_both">
                        <div class="slideNormal"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="delete_popUp" id="delete_popUp">
    <div class="delete_popUpTransp"></div>
    <div class="delete_popUpActual">
        <div class="deleteDetailHeading">DELETING<span class="otherColor"> &quot;</span><span class="otherColor"
                                                                                              id="otherColorName">HOME &amp; DECOR</span><span
                class="otherColor">&quot; </span>FROM LIST
        </div>
        <div class="deleteDetailInfo">The collection in the list will remain and only list will be deleted</div>
        <div class="detailButtonPane"><input type="hidden" id="toremoveid" value="0"/>
            <button class="deleteDetailButton" id="deleteDetailButton" type="button">Delete</button>
            <button class="cancelDetailButton" type="button">Cancel</button>
        </div>
    </div>
</div>
<div class="AddPopupContainer" id="EditPopupContainer">
    <div class="AddPopupWrapper">
        <div class="AddPopupTransp"></div>
        <div class="AddPopupActual">
            <div class="headingAndClose">
                <div class="Addtotext">ADD TO LISTS</div>
                <div class="AddClose" id="popUpClose2"></div>
            </div>
            <div class="scrollContents">
                <div class="createaList"><input type="text" placeholder="create a new list" name="newlist"
                                                id="fancylist"/>

                    <div class="plusText">+</div>
                    <div class="radioText">
                        <div class="radio1"><input type="radio" id="cod" name="cards" checked="checked"/></div>
                        <div class="checkText">Public</div>
                    </div>
                    <div class="radioText">
                        <div class="radio1"><input type="radio" id="emi" name="cards"/></div>
                        <div class="checkText">Private</div>
                    </div>
                    <button class="prod_continue add_button" id="add" type="submit" style="width:100px">Add</button>
                </div>
                <div class="rightPop2">
                    <div class="checkboxesHolder2" id="checkboxesHolder1">
                        <div class="checkBoxText" id="checkBoxText_1">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Fashion</div>
                        </div>
                        <div class="checkBoxText" id="checkBoxText_2">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Trendy Bags</div>
                        </div>
                        <div class="checkBoxText" id="checkBoxText_3">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Boog Woogy</div>
                        </div>
                        <div class="checkBoxText" id="checkBoxText_4">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Chappar Shoes</div>
                        </div>
                        <div class="checkBoxText" id="checkBoxText_5">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Dirt Chops</div>
                        </div>
                        <div class="checkBoxText" id="checkBoxText_6">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Easee Visee Chairs</div>
                        </div>
                        <div class="checkBoxText" id="checkBoxText_7">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Donkees Caps</div>
                        </div>
                        <div class="checkBoxText" id="checkBoxText_8">
                            <div class="checkbox checkit"><input type="checkbox" name="check1"/></div>
                            <div class="checkText2">Donkees Caps</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottomButton">
                <button class="prod_continue" id="unfancy" type="submit" style="width:108px">Done</button>
                <div class="checkBoxText2">
                    <div class="checkbox"><input type="checkbox" name="check2"/></div>
                    <div class="checkText2">Show Lists Everytime</div>
                </div>
            </div>
        </div>
    </div>
</div>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_store.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_lists.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script>
    $(".ficon").attr("src", "<?php echo $base_url; ?>assets/images/dropfancy_hover.png");
    $(".ficon").siblings(".value").html(' ');
    function fancyDetailList(id) {
        $.ajax({
            url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_list_proddetail/' + id,
            success: function (data) {
                $('.rightPanel').html(data);
            }
        });
    }
    $("#deleteDetailButton").click(function () {
        var id = $("#toremoveid").val();

        if (id) {
            $("#leftPanelList_1_" + id).hide();
        }
        /* else if(storeCategory == "SPORTS & OUTDOORS") {
         $("#leftPanelList_2").hide();
         }
         else if(storeCategory == "MEDIA") {
         $("#leftPanelList_3").hide();
         }
         else if(storeCategory == "SHOES") {
         $("#leftPanelList_4").hide();
         }
         else if(storeCategory == "TRAVEL & DESTINATIONS") {
         $("#leftPanelList_5").hide();
         }  */
        $("#delete_popUp").dialog('close');
        $.ajax({
            url: "<?php echo $base_url; ?>" + 'order/fancy_list_delete/' + id,
            success: function (data) {
            }
        });
    });
</script>
</html>