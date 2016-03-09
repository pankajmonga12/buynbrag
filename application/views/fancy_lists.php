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
                            <div class="pinkBadge"><a href="<?php echo $base_url . '#/badges'?>">
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
                    <div class="productsLink"">
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

<!--                            <div class="fancySeperator"></div>-->
<!--                            <a href="--><?php //echo $base_url?><!--order/user_fancy_store" class="fl">-->
<!--                                <div class="fancyLink">My Fancy Stores</div>-->
<!--                                <div class="fancyBox">--><?php //echo $countfstore; ?><!--</div>-->
<!--                            </a>-->

                            <div class="fancySeperator"></div>
                            <a href="<?php echo $base_url?>order/fancy_lists" class="fl">
                                <div class="fancyLinkActive">Lists</div>
                                <div class="fancyBox"><?php echo $countflist; ?></div>
                            </a>
                            <!-- <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Blogazine</div> <div class="fancyBox">35</div> </a> <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Styleboard</div> <div class="fancyBox">35</div> </a>-->
                            <!-- <button id="add_list" class="addList" type="button">Add List</button>--> </div>
                    </div>
                </div>
                <div
                    class="fancyStoreContainer"> <?php if (isset($mylistdef)) for ($i = 0; $i < count($mylistdef); $i++): ?>
                        <div class="listBg" id="listBg_<?php echo $i;?>"><a
                                href="<?php echo $base_url . 'order/fancy_list_detail' ?>">
                                <div class="listImagesStatic<?php echo $i + 1;?> listImagesStatic">
                                    <div class="listName"><?php echo $mylistdef[$i]->fancy_list_name;?></div>
                                    <div class="noOfListItems"><?php echo $prod_count_def[$i][0]->product_count;?><span
                                            class="itemSpan"> items</span></div>
                                    <div class="listFunctionalityRow">
                                        <div class="viewListIcon"></div>
                                        <div class="lockListIcon"></div>
                                        <!-- <div class="deleteListIcon"></div>--> </div>
                                </div>
                            </a> <?php for ($j = 0; $j < count($fancyitemdef[$i]); $j++): ?> <?php if ($j % 5 == 4) $class = "listImages paddingRight0"; else $class = "listImages"; ?>
                                <div class="<?php echo $class;?>"><a
                                        href="<?php echo $base_url?>order/product_page/<?php echo $fancyitemdef[$i][$j]->store_id; ?>/<?php echo $fancyitemdef[$i][$j]->product_id; ?>">
                                        <img
                                            src="<?php echo $store_url; ?>assets/images/stores/<?php echo $fancyitemdef[$i][$j]->store_id;?>/<?php echo $fancyitemdef[$i][$j]->product_id;?>/img1_171x171.jpg" alt="product image"/> </a></div> <?php endfor;?>
                        </div> <?php endfor;?>
                </div> <?php if (isset($mylistuser)) if (count($mylistuser) > 0): ?> <?php for ($i = 0; $i < count($mylistuser); $i++): ?>
                    <div class="listBg" id="listBg_1_<?php echo $i;?>">
                        <div class="listImagesStatic<?php echo $i + 8;?> listImagesStatic">
                            <div class="listName"><?php echo $mylistuser[$i]->fancy_list_name;?></div>
                            <div class="noOfListItems"><?php echo $prod_count_user[$i][0]->product_count;?><span
                                    class="itemSpan"> items</span></div>
                            <div class="listFunctionalityRow">
                                <div class="viewListIcon"></div>
                                <div class="lockListIcon"></div>
<!--                                <div class="deleteListIcon" onClick="return deleteList(--><?php //echo $i;?><!--)"></div>-->
                                <a href="<?php echo $base_url . 'order/fancy_list_detail' ?>"></div>
                        </div>
                        </a> <?php for ($j = 0; $j < count($fancyitemuser[$i]); $j++): ?> <?php if (($j + 1) % 5 == 0) $class = "listImages"; else $class = "listImages paddingRight0"; ?>
                            <div class="<?php echo $class;?>"><a
                                    href="<?php echo $base_url?>order/product_page/<?php echo $fancyitemuser[$i][$j]->store_id; ?>/<?php echo $fancyitemuser[$i][$j]->product_id; ?>">
                                    <img
                                        src="<?php echo $store_url; ?>assets/images/stores/<?php echo $fancyitemuser[$i][$j]->store_id;?>/<?php echo $fancyitemuser[$i][$j]->product_id;?>/img1_product.jpg"
                                        width="161" height="134" alt="product image"/> </a></div> <?php endfor;?>
                        <div class="deleteListContainer" id="deleteListContainer_<?php echo $i;?>">
                            <div class="deleteListHeading">DELETE<span
                                    class="spanListName"><?php echo " " . strtoupper($mylistuser[$i]->fancy_list_name) . " ";?></span>FROM
                                MY LIST
                            </div>
                            <div class="deleteListInfo">The collection in the list will remain and only list will be
                                deleted
                            </div>
                            <div class="deleteListButtons">
                                <button class="deleteListButton" type="button"
                                        onClick="return deleteButtonFunc(<?php echo $i;?>,<?php echo $mylistuser[$i]->fancy_list_id;?>)">
                                    Delete
                                </button>
                                <button class="cancelListButton" type="button"
                                        onClick="return cancelButtonFunc(<?php echo $i;?>)">Cancel
                                </button>
                            </div>
                        </div>
                    </div> <?php endfor; ?> <?php endif; ?> </div>
            <div id="more_fancy_lists" class="slideBackground clear_both">
                <div class="slideNormal"></div>
            </div>
        </div>
        </div>
        <!-- <div class="AddPopupContainer" id="EditPopupContainer"> <div class="AddPopupWrapper"> <div class="AddPopupTransp"></div> <div class="AddPopupActual"> <div class="headingAndClose"> <div class="Addtotext">ADD TO LISTS</div> <div class="AddClose" id="popUpClose2"></div> </div> <div class="scrollContents"> <div class="createaList"> <input type="text" placeholder="create a new list" name="newlist" id="fancylist"/> <div class="plusText">+</div> <div class="radioText"> <div class="radio1"><input type="radio" id="cod" name="cards" checked="checked"/></div> <div class="checkText">Public</div> </div> <div class="radioText"> <div class="radio1"><input type="radio" id="emi" name="cards"/></div> <div class="checkText">Private</div> </div> <button class="prod_continue add_button" id="add" type="submit" style="width:100px">Add</button> </div> <div class="rightPop2"> <div class="checkboxesHolder2" id="checkboxesHolder1"> <div class="checkBoxText" id="checkBoxText_1"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Fashion</div> </div> <div class="checkBoxText" id="checkBoxText_2"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Trendy Bags</div> </div> <div class="checkBoxText" id="checkBoxText_3"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Boog Woogy</div> </div> <div class="checkBoxText" id="checkBoxText_4"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Chappar Shoes</div> </div> <div class="checkBoxText" id="checkBoxText_5"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Dirt Chops</div> </div> <div class="checkBoxText" id="checkBoxText_6"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Easee Visee Chairs</div> </div> <div class="checkBoxText" id="checkBoxText_7"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Donkees Caps</div> </div> <div class="checkBoxText" id="checkBoxText_8"> <div class="checkbox checkit"><input type="checkbox" name="check1"/></div> <div class="checkText2">Donkees Caps</div> </div> </div> </div> </div> <div class="bottomButton"> <button class="prod_continue" id="unfancy" type="submit" style="width:108px">Done</button> <div class="checkBoxText2"> <div class="checkbox"><input type="checkbox" name="check2"/></div> <div class="checkText2">Show Lists Everytime</div> </div> </div> </div> </div> </div>-->
    </section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/fancy_lists.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script>
    $(".ficon").attr("src", "<?php echo $base_url; ?>assets/images/dropfancy_hover.png");
    $(".ficon").siblings(".value").html(' ');
    function deleteButtonFunc(id, fid) {
        $("#deleteListContainer_" + id).hide();
        $("#listBg_1_" + id).hide();
        $.ajax({
            url: "<?php echo $base_url; ?>" + 'order/fancy_list_delete/' + fid,
            success: function (data) {
            }
        });
    }
</script>
</html>