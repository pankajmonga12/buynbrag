<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Purchase History</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/purchase_history.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/dashboard.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.selectbox.css"/>
</head>
<body>
<section class="wrapper">
<article class="banner">
    <div class="bannerIE2">
        <div class="slide">
            <div class="topBanerPatternContainer"></div>
            <div class="bannerAuto">
                <div class="owner_pic"> <?php $filename = 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg';
                        if (file_exists($filename)): ?>
                            <img width="156px" height="156px" src="<?php echo $base_url . 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; ?>" alt="Owner Pic"/> <?php else: ?>
                            <img src="http://graph.facebook.com/<?php echo $fb_uid; ?>/picture?type=large" alt="Owner Pic" height="156" width="156"/> <?php endif; ?>
                </div>
                <div class="bannerMid">
                    <div class="owner_name"><?php echo $userinfo[0]->full_name; ?></div>
                    <div class="merbershipDate">Member since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date)); ?></div>
                    <div class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3)
                            $n = 3; else $n = count($badges);
                            for ($i = 0; $i < $n; $i++): ?>
                                <img src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img'] ?>" class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
                            <div class="pinkBadge"><a href="<?php echo $base_url . '#/badges' ?>">
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
                    </a> <a href="<?php echo $base_url . "index.php/poll/create_poll"; ?>">
                        <div class="logoBox borderRight">
                            <div class="PollIconPlus"></div>
                            <div class="logoText">
                                <div>Create</div>
                                <div>Poll</div>
                            </div>
                        </div>
                    </a></div>
            </div>
        </div>
    </div>
</article>
<nav class="middleColumnTop">
    <div class="middleColumnIE">
        <div class="topDotSeparator"></div>
        <div class="linksMiddle">
            <!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
            <a href="<?php echo $base_url . 'user_info/user_detail'; ?>">
                <div class="productsLink">
                    <div class="profileLogo"></div>
                    <div class="productsText newPadding">Profile</div>
                </div>
            </a> <a href="<?php echo $base_url; ?>user_info/invite">
                <div class="productsLink">
                    <div class="inviteLogo2"></div>
                    <div class="productsText newPadding">Invite People</div>
                </div>
            </a>
            <!-- <a href="javascript:void(0)"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a> <a href="javascript:void(0)"><div class="purchasehistoryLink"> <div class="purchaseHistoryLogo"></div> <div class="dashboardText">Purchase History</div> </div></a>-->
        </div>
        <div class="topDotSeparator newtopDotSeparator1"></div>
    </div>
</nav>
<section class="middleBackground">
<div class="Ie8bg">
<div class="orderStatusContainer">
    <div class="orderStatusImages"><a href="javascript:void(0);">
            <div class="purchaseHistoryIcon"></div>
        </a>

        <div class="orderStatusText">PURCHASE HISTORY</div>
    </div>
</div>
<div class="whiteSeparator"></div>
<div class="middleContainerTabscontent">
<div class="middleTabsContainer">
<div id="tabs">
    <div id="tab1">
        <div class="orderstatus_all_hidden">
            <div class="sortByContainer">
                <div class="sortByContainerTransparent"></div>
                <div class="sortByContent">
                    <div class="currentlyShowingText">Currently showing <?php if ((int)$offset == 0) {
                            $start = 0;
                        } else {
                            $start = (int)$offset + 1;
                        }
                            echo ($start) . '-' . ((int)$offset + count($order)) . ' / ' . $totalOrders?>
                        Purchase
                    </div>
                    <!-- <div class="dropdownHolder"> <div class="viewpurchase">View Purchase in</div> <div class="datesDropdown"> <select class="drop1" name="datedrop"> <option value="month" selected="selected" disabled="disabled">Month</option> <option value="jan">January</option> <option value="feb">February</option> <option value="march">March</option> <option value="April">April</option> <option value="May">May</option> <option value="jun">June</option> <option value="jul">July</option> <option value="aug">August</option> <option value="sep">September</option> <option value="oct">October</option> <option value="nov">November</option> <option value="dec">December</option> </select> </div> <div class="datesDropdown"> <select class="drop1" name="datedrop"> <option value="year" selected="selected" disabled="disabled">Year</option> <option value="2012">2012</option> </select> </div> <div class="search_logo"></div> </div>-->
                </div>
            </div>
            <div class="titleBackground">
                <div class="titleBackgroundTransparent"></div>
                <div class="titleBackgroundHolder">
                    <div class="titleTextHolder">
                        <div class="titleText">Title</div>
                    </div>
                    <div class="quantityHolder">
                        <div class="quantityText">Quantity</div>
                    </div>
                    <div class="quantityHolder1">
                        <div class="quantityText">Price</div>
                    </div>
                    <div class="quantityHolder2">
                        <div class="quantityText">Shipping</div>
                    </div>
                    <div class="quantityHolder3">
                        <div class="quantityText">Status</div>
                    </div>
                    <div class="quantityHolder4"></div>
                    <div class="quantityHolder5" style="border-right:none;"></div>
                </div>
            </div>
            <!-- Start From here for purchase history -->
            <div class="stableGlassContainerHolder">
                <div class="stableGlassContentHolder"> <?php for ($i = 0; $i < count($order); $i++): ?>
                        <div class="stableGlassContainerRelative">
                            <div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
                            <div class="stableGlassContainer1" onMouseOver="return transp(<?php echo $i + 1; ?>)" onMouseOut="return normal(<?php echo $i + 1; ?>)">
                                <div class="stableGlassRelative">
                                    <div class="stableglassHolder">
                                        <div class="stableglassImage1">
                                            <a href="<?php echo $baseURL . "order/product_page/" . $order[$i]->store_id . "/" . $order[$i]->product_id; ?>">
                                                <img src="<?php echo $store_url . 'assets/images/stores/' . $order[$i]->store_id . '/' . $order[$i]->product_id . '/img1_92x77.jpg'; ?>" alt="prod_img"/>
                                            </a>
                                        </div>
                                        <div class="stableglassText">
                                            <a href="<?php echo $baseURL . "#!/product//" . $order[$i]->product_id;?>">
                                                <div class="stableglassHeading"><?php echo rtrim(substr($order[$i]->product_name, 0, 20)); ?></div>
                                            </a>

                                            <div class="purchaseText">purchase date<span class="purchaseSpan"><?php echo $order[$i]->date_of_order; ?></span>
                                            </div>
                                            <!--<div class="silverImage"><img src="<?php echo $base_url.'assets/images/stable_badge.png'; ?>" alt="stable" /></div>-->
                                        </div>
                                    </div>
                                    <div class="quantityRow1">
                                        <div class="qtyNumber paddingTOp25"><?php echo $order[$i]->quantity; ?></div>
                                    </div>
                                    <div class="quantityRow2">
                                        <div class="qtyNumber"><span class="rupee">`</span> <?php echo $order[$i]->amt_paid; ?>
                                        </div> <?php if ($order[$i]->payment_status == 1) {
                                            $img_url = $base_url . 'assets/images/paid.png';
                                            $alt = "paid";
                                        } elseif ($order[$i]->payment_status == 2) {
                                            $img_url = $base_url . 'assets/images/cod.png';
                                            $alt = "cod";
                                        } else {
                                            $img_url = $base_url . 'assets/images/unpaid.png';
                                            $alt = "unpaid";
                                        } ?>
                                        <div class="paidImage">
                                            <img src="<?php echo $img_url; ?>" alt="<?php echo $alt; ?>"/>
                                        </div>
                                    </div>
                                    <div class="quantityRow3">
                                        <div class="qtyNumber"><span class="rupee">`</span> 0.00
                                        </div>
                                    </div> <?php $order_status = $order[$i]->status_order;
                                        $class = "quantityRow4 newPaddings";
                                        if ($order_status == 1) {
                                            $div_containers = '<div class="pendingIcon"></div><div class="statusText">Pending</div>';
                                        } elseif ($order_status == 2) {
                                            $div_containers = '<div class="processingImage"><div class="processingInnerImage"></div>';
                                            $div_containers .= '<div style="padding-right:6px;" class="shippingTxt">Processing</div></div>';
                                        } elseif ($order_status == 3) {
                                            $class = "quantityRow4";
                                            $div_containers = '<div class="shippeddiv"><div class="shippedIcon"></div>';
                                            $div_containers .= '<div class="shippedText">Shipped</div></div>';
                                        } elseif ($order_status == 4) {
                                            $class = "quantityRow4";
                                            $div_containers = '<div class="completedImage"></div>';
                                            $div_containers .= '<div class="completedText">Completed</div>';
                                        } elseif ($order_status == 5) {
                                            $div_containers = '<div class="cancelledIcon"></div><div class="statusText">Cancelled</div>';
                                        } elseif ($order_status == 6) {
                                            $class = "quantityRow4";
                                            $div_containers = '<div class="problemWithOrderImage"></div> <div class="problrmWithOrderText">Problem with Order</div>';
                                        } else {
                                            $div_containers = '<div class="pendingIcon"></div><div class="statusText">Pending</div>';
                                        } ?>
                                    <div class="<?php echo $class; ?>"> <?php echo $div_containers; ?> </div>
                                    <div class="quantityRow5">
                                        <div class="purchaseIcon"></div>
                                        <!--<div class="communicationImage" id="communicationImage_<?php //echo $i+1; ?>" onClick="return showonlyone(<?php //echo $i+1; ?>)"><div class="communicationNumber"><?php //echo $order[$i]->comment_count;?></div></div>-->
                                    </div>
                                    <div class="pdfImage"> <?php if ($order_status == 1 || $order_status == 5 || $order_status == 6): ?>
                                            <a href="<?php echo '../../invoice/' . $order[$i]->txnid . '/buyer_invoice_order_' . $order[$i]->order_id . '.pdf'; ?>" target="_blank">
                                                <div class="pdf_icon"></div>
                                            </a> <?php elseif ($order_status == 2 || $order_status == 3 || $order_status == 4): ?>
                                            <a href="<?php echo '../../invoice/' . $order[$i]->txnid . '/shipping_label_order_' . $order[$i]->order_id . '.pdf'; ?>" target="_blank">
                                                <div class="pdf_icon"></div>
                                            </a> <!--<a href="<?php //echo $base_url.'index.php/invoice_controller/buyer_invoice/'.$order[$i]->order_id; ?>" target="_blank"><div class="pdf_icon"></div></a>--> <?php endif; ?>
                                    </div>
                                    <div class="feedbackImage" id="feed<?php echo $i + 1; ?>">
                                        Feedback
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="searchMain">
                            <div class="searchTransparent"></div>
                            <div class="searchActual">
                                <div class="search_text">
                                    <div class="search_text_mid"><input type="text" name="search"/>
                                    </div>
                                </div>
                                <div class="searching_icon"></div>
                            </div>
                        </div> <!-- <div class="communicationHolderRelative" id="communicationhide_<?php //echo $i+1; ?>"> <div class="communicationHolderTransparent height289"></div> <div class="communicationAbsolute height289"> <div class="communicationRelative"> <div class="comm_icon"></div> <div class="comm_text">Communication</div> </div> <div class="pupplestoredivRelative"> <div class="icon_bg1"><img src="images/starfish.png"/></div> <div class="img_details"> <div class="names">Pupplestore<span class="timing">2 month ago</span></div> <div class="img_about"> <div>Eating, drinking, sleeping! A little laughter! Much weeping!Is that all ? Do not die here like a worm.</div> <div>Attain Immortal Bliss.</div> </div> </div> <div class="floatright"> <div class="vertical_separator" style="height:77px;"></div> <div class="pupplestore_icon"></div> <div class="vertical_separator" style="height:77px;"></div> <div class="pupplestore_close"></div> </div> </div> <div class="pupplestoredivRelative"> <div class="icon_bg1"><img src="images/pavankudla_image.png"/></div> <div class="img_details"> <div class="names">Pavan Kudla <span class="timing">2 month ago</span> </div> <div class="img_about">Eating, drinking, sleeping! A little laughter! Much weeping!Is that all ? Do not die here like a worm.</div> </div> </div> <div class="pupplestoredivRelative"> <div class="icon_bg1"><img src="images/starfish.png"/></div> <div class="img_details"> <div class="names">Pupplestore<span class="timing">2 month ago</span></div> <div class="img_about">Eating, drinking, sleeping! A little laughter! Much weeping!Is that all ? Do not die here like a worm. Attain Immortal Bliss.</div> </div> </div> </div> </div>--> <?php endfor; ?>
                    <!-- End purchase history here -->
                    <div class="slideBackground">
                        <div class="slideNormal"><?php echo $links; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="feedbackPopup" id="feedbackPopup">
    <div class="feedbackPopupContainer">
        <div class="feedbackPopupContainerBackground"></div>
        <div class="feedbackPopupContents">
            <div id="tab">
                <ul>
                    <li>
                        <div class="feedbackIconText">
                            <div class="feedbackColor"></div>
                            <a href="#t1">
                                <div class="feedbackContentHolder">
                                    <div class="feedbackIcon"></div>
                                    <div class="feedbackText">Feedback</div>
                                </div>
                            </a></div>
                    </li>
                    <li>
                        <div class="feedbackIconText2">
                            <div class="feedbackColor"></div>
                            <a href="#t2">
                                <div class="feedbackContentHolder2">
                                    <div class="completedIcon"></div>
                                    <div class="feedbackText">Completed</div>
                                </div>
                            </a></div>
                    </li>
                    <div class="closeIcon" id="feedbackClose"></div>
                </ul>
                <div class="topDotSeparator"></div>
                <div id="t1">
                    <div class="tab1Content">
                        <div class="tab1contentBackground"></div>
                        <div class="tab1contents">
                            <div class="feedbackBannerHolder">
                                <div class="popupBanner"><img src="images/popup_banner.png" alt="popup banner"/></div>
                                <div class="popupBannerContentHolder">
                                    <div class="coppleStoreText">CoppleStore</div>
                                    <div class="ownerText">Owner <span class="leahStoreText">Leah Copple</span>
                                    </div>
                                    <div class="productsText1">980 <span style="color:#666;">products</span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical_separator extra_class"></div>
                            <div class="feedbackButtonsHolder">
                                <div class="radio1"><input type="radio" name="rad1"></div>
                                <div class="positive">POSITIVE</div>
                                <div class="radio1 radioStyle"><input type="radio" name="rad1">
                                </div>
                                <div class="neutral">NEUTRAL</div>
                                <div class="radio1 radioStyle"><input type="radio" name="rad1">
                                </div>
                                <div class="neutral" style="background-color:#c85e5e">NEGATIVE</div>
                            </div>
                            <div class="textAreaHolder clear_both">
                                <div class="textareaBackground"></div>
                                <textarea class="textarea_class" placeholder="enter text"></textarea></div>
                            <button type="button" class="prod_continue width_style">Send</button>
                        </div>
                    </div>
                </div>
                <div id="t2">
                    <div class="tab1Content">
                        <div class="tab1contentBackground"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/dashboard.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/purchase_history.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
</html>