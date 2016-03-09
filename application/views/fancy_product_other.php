<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Fancy Product</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
    <style type="text/css">
        .fancy_header { background-image: none !important; background-color: #F7F7F7 !important; }
        .ftext { color: #e81c4d; }
    </style>
    <!--[if IE]>
    <link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<body>
<section class="wrapper">
    <article class="banner">
        <div class="slide">
            <div class="topBanerPatternContainer"></div>
            <div class="bannerAuto">
                <div class="owner_pic">
                    <?php
                    $userImageSrc = (strcmp($userinfo[0]->fb_uid, "non-fb-member") === 0)? $baseURL."assets/images/default/".((strcmp($userinfo[0]->gender, "female") === 0)? "female": "male").".png": "https://graph.facebook.com/".$userinfo[0]->fb_uid."/picture?width=200&height=200";
                    //$filename = 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg';
                    ?>
                    <img width="156px" height="156px" src="<?php echo $userImageSrc; ?>" alt="<?php echo $userinfo[0]->full_name; ?>"/>
                </div>
                <div class="bannerMid">
                    <div class="owner_name"><?php echo ucwords(strtolower($userinfo[0]->full_name));?></div>
                    <div class="followUserButtonContainer">
                        <?php
                        if($isLoggedIN['status'] === TRUE)
                        {
                            ?>
                            <form action="<?php echo base_url(); ?>user_info/view/<?php echo $userinfo[0]->user_id; ?>" method="post" accept-charset="utf-8">
                                <input type="submit" name="btn_fnf" class="followUserButton" value="<?php echo $f_status[1]; ?>">
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="merbershipDate">Member
                        since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
                    <div
                        class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
                            for ($i = 0; $i < $n; $i++): ?> <img
                                src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>"
                                class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
                            <div class="pinkBadge"><a
                                    href="<?php echo $base_url . '#/badges/' . $uid ?>">
                                    <div class="white_text">+<?php echo count($badges) - $n; ?></div>
                                </a></div> <?php endif; ?> </div>
                </div>
                <div class="bannerRight">
                    <!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div> </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
                    <!--<a href="<?php //echo $base_url."order/friend_fancy_product/".$uid; ?>"><div class="logoBox">-->
                    <div class="iconFancy"></div>
                    <div class="logoNumber"><?php echo $countfprod; ?></div>
                    <div class="logoText">fancy</div>
                </div>
                <!--</a>-->
                <!-- <a href="<?php //echo $base_url."index.php/poll/create_poll"; ?>" > <div class="logoBox borderRight"> <div class="PollIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Poll</div> </div> </div> </a>-->
            </div>
        </div>
        </div> </article>
    <nav class="middleColumnTop">
        <div class="topDotSeparator newtopDotSeparator"></div>
        <div class="linksMiddle">
            <!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
        <a href="<?php echo $base_url; ?>user_info/view/<?php echo $uid?>">
            <div class="productsLink">
                <div class="profileLogoGrey"></div>
                <div class="productsText newPadding">Profile</div>
            </div>
        </a>

        <a href="<?php echo $base_url; ?>order/friend_fancy_product/<?php echo $uid?>">
            <div class="dashboardLink">
                <div class="inviteLogoPink"></div>
                <div class="activeText">Fancy List</div>
            </div>
        </a>

        <a href="<?php echo $base_url; ?>#/badges/<?php echo $uid?>">
            <div class="productsLink">
                <div class="badgesLogoGrey"></div>
                <div class="productsText newPadding">Badges Earned</div>
            </div>
        </a>
        <!-- <a href="message.php"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a> <a href="invite_people_second.php"><div class="productsLink"> <div class="inviteLogo2"></div> <div class="productsText newPadding">Invite People</div> </div></a>-->
        <!-- <a href="<?php //echo $base_url?>user_info/purchase_history"><div class="purchaseHistory"> <div class="purchaseHistoryLogo"></div> <div class="purchaseText1">Purchase History</div> </div></a>-->
        </div>
        <div class="topDotSeparator newtopDotSeparator1"></div>
    </nav>
    <section class="middleBackground">
        <div class="whiteSeparator"></div>
        <div class="fancyContentsContainer">
            <div class="sortByContainer">
                <div class="sortByContainerTransparent"></div>
                <div class="sortByContent">
                    <div class="fancyLinksContainer">
                        <!--<a href="<?php echo $base_url?>order/user_fancy_product" class="fl">-->
                        <div class="fancyLinkActive">My Fancy products</div>
                        <div class="fancyBox"><?php echo $countfprod; ?></div>
                        <!--</a>-->
                        <!-- <div class="fancySeperator"></div> <a href="<?php echo $base_url?>order/user_fancy_store" class="fl"> <div class="fancyLink">My Fancy Stores</div> <div class="fancyBox"><?php //echo $countfstore; ?></div> </a> <div class="fancySeperator"></div> <a href="<?php //echo $base_url?>order/fancy_lists" class="fl"> <div class="fancyLink">Lists</div> <div class="fancyBox"><?php //echo $countflist; ?></div> </a>-->
                        <!-- <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Blogazine</div> <div class="fancyBox">35</div> </a> <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Styleboard</div> <div class="fancyBox">35</div> </a>-->
                    </div>
                </div>
            </div> <?php if (count($fprod) > 5) {
                $loop = floor(count($fprod) / 6) . '<br>';
                $imgloop = count($fprod) % 6 . '<br>';
            } else {
                $imgloop = count($fprod) % 6 . '<br>';
            } $p = 0; ?> <?php if (isset($loop)) for ($i = 0; $i < $loop; $i++): ?> <?php $numbers = range(1, 3);
                shuffle($numbers); ?> <?php include "flayout" . $numbers[0] . ".php"; ?> <?php include "flayout" . $numbers[1] . ".php"; ?> <?php include "flayout" . $numbers[2] . ".php"; ?> <?php endfor; ?> <?php if ($imgloop == 5): ?> <?php include 'flayout2.php'; ?> <?php include 'flayout3.php'; ?> <?php elseif ($imgloop == 4): ?> <?php include 'flayout2.php'; ?> <?php include 'flayout2.php'; ?> <?php elseif ($imgloop == 3): ?> <?php include 'flayout3.php'; ?> <?php elseif ($imgloop == 2): ?> <?php include 'flayout2.php'; ?> <?php elseif ($imgloop == 1): ?> <?php include 'flayout1.php'; ?> <?php endif; ?>
            <div id="more_fancy_1" class="slideBackground clear_both">
                <div class="slideNormal"></div>
            </div>
        </div>
    </section>
</section> <?php include "fancy_unfancy_prod.php" ?> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/tooltip.js"></script>
<script src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript"
    $(".ficon").attr("src", "<?php echo $base_url; ?>assets/images/dropfancy_hover.png");
    $(".ficon").siblings(".value").html(' ');
    $(function () {
        tooltip();
    });
</script>
<script>
    function AddPoll(pid) {
        if(isLoggedIN){
            $.ajax({
                url: "<?php echo $base_url; ?>index.php/ajax_poll/add_to_poll/" + pid,
                success: function (data) {
                }

            });

            $('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');

            $("#pollPopup").dialog({
                width: 605,
                height: 293,
                modal: true
            });
        }
        else {
            $('#loginModal').modal('show');
        }
    }

    function poll_close() {
        $("#pollPopup").dialog('close');
    }

    $(".fancyHolder").each(function () {

        var r = $(this).children(".hiddenFieldDiv1").val();
        var store_id = $(this).children(".hiddenFieldStoreid").val();
        var product_id = $(this).children(".hiddenFieldProductid").val();
        $(this).click(function () {
            if(isLoggedIN) {
                if (($(this).children(".hoverText").html()).replace(/\s+/g, '') == 'FANCY') {

                    $.ajax({
                        type: "GET",
                        url: "<?php echo $base_url; ?>index.php/async/fancy2/" + product_id,
                        success: function(data, status, xhr)
                        {
                            if(data.fancy && !(data.alreadyFancied)) {
                                //$('#fancy .fancyLogo').attr('src', 'http://buynbrag.com/assets/images/fancie_icon.png');
                                $("#hoverText" + r).html("FANCIED");
                            }
                            else if(data.fancy && data.alreadyFancied) {

                            }
                            else {

                            }
                        }
                    });

                }
                else if (($(this).children(".hoverText").html()).replace(/\s+/g, '') == 'UNFANCY') {
                    $.ajax({
                        type:"GET",
                        url: "<?php echo $base_url; ?>index.php/async/unFancy/" + product_id,
                        dataType: "text",
                        success: function (data, status, xhr) {
                            console.log(r,'Changed', data)
                            $("#hoverText" + r).html("FANCY");
                            $(this).children("#hoverFancy" + r).removeClass('editFancynext');
                            //$(this).children("#hoverFancy" + r).addClass('hoverFancynext');
                        }
                    });
                }
            }
            else {
                $('#loginModal').modal('show');
            }

            // $("#addtolist").click(function () {
            // 	$("#hoverText" + r).html("FANCIED");
            // 	/* $("#hoverFancy"+r).removeClass('hoverFancy');
            // 	 $("#hoverFancy"+r).addClass('hoverFancynext'); */
            // 	//	var postdata=[];
            // 	//   $('#checkbox input[name="checkbox5"]:checked').each(function() {
            // 	//       postdata.push($(this).val()); //push each val into the array
            // 	//    });
            // 	$.ajax({
            // 	  url: "<?php //echo $base_url; ?>" +'index.php/ajax/fancy_product_addlist?store_id='+store_id+'&product_id='+product_id+'&postdata='+postdata,
            // 		success: function(data){
            // 		document.getElementById("fancy_hidden").value=2;
            // 		$('#fan').html(data);
            // 		}
            // 	});
            // 	$("#FancyPopupContainer").dialog('close');
            // 	//window.location.reload();
            // });
        });
        $(this).hover(function () {

            if (($(this).children(".hoverText").html()).replace(/\s+/g, '') == 'FANCIED') {
                $(this).children("#hoverText" + r).html("UNFANCY");
                $(this).children("#hoverFancy" + r).removeClass('hoverFancynext');
                $(this).children("#hoverFancy" + r).addClass('editFancynext');
            }

        }, function () {
            if ($(this).children("#hoverText" + r).html() == 'EDIT') {
                $(this).children(".hoverText").html("FANCIED");
                $(this).children("#hoverFancy" + r).removeClass('editFancynext');
                $(this).children("#hoverFancy" + r).addClass('hoverFancynext');
            }
        });
    });
</script>
</html>
