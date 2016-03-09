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
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/landing_page.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_product.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
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
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
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
							height="156px" width="156px"/> <?php endif; ?> </div>
					<div class="bannerMid">
						<div class="owner_name"><?php echo ucwords(strtolower($userinfo[0]->full_name));?></div>
						<div class="merbershipDate">Member
							since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date));?></div>
						<div
							class="badgesContainer"> <?php if (isset($badges)): if (count($badges) > 3) $n = 3; else $n = count($badges);
								for ($i = 0; $i < $n; $i++): ?> <img
									src="<?php echo $base_url . 'assets/images/badges/' . $badges[$i]['img']?>"
									class="silverBadge"> <?php endfor; ?> <!-- <div class="goldBadge"></div> <div class="platinumBadge"></div>-->
								<div class="pinkBadge"><a href="<?php echo $base_url . 'index.php/user_info/badges/'?>">
										<div class="white_text">+<?php echo count($badges) - $n; ?></div>
									</a></div> <?php endif; ?> </div>
					</div>
					<div class="bannerRight">
						<!-- <a href="styleboard.php"><div class="logoBox1"> <div class="styleboardIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Styleboard</div> </div> </div></a> <a href="blog.php"><div class="logoBox"> <div class="BlogIconPlus"></div> <div class="logoText"> <div>Create</div> <div>Blog</div> </div> </div></a>-->
						<a href="<?php echo $base_url . "index.php/order/user_fancy_product"; ?>">
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
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="linksMiddle">
				<!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
				<a href="<?php echo $base_url?>index.php/user_info/user_detail/">
					<div class="productsLink">
						<div class="profileLogo"></div>
						<div class="productsText newPadding">Profile</div>
					</div>
				</a>
				<!-- <a href="message.php"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a>-->
				<a href="<?php echo $base_url; ?>index.php/user_info/invite">
					<div class="productsLink">
						<div class="inviteLogo2"></div>
						<div class="productsText newPadding">Invite People</div>
					</div>
				</a> <a href="<?php echo $base_url?>index.php/user_info/purchase_history">
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
			<div class="categoriesContainerFancy">
				<div class="categoryIcons"><a href="<?php echo $base_url; ?>index.php/user_info/badges" title="Badges"
				                              class="showtooltip">
						<div class="roundhBadge"></div>
					</a>
					<!-- <a href="styleboard.php" title="Styleboard" class="showtooltip"><div class="roundStyleboard"></div></a> <a href="blog.php" title="Blog" class="showtooltip"><div class="roundBlog"></div></a>-->
					<a href="<?php echo $base_url; ?>index.php/order/user_fancy_product">
						<div class="roundFancy_active"></div>
					</a>

					<div class="categoriesText">FANCY</div>
					<a href="<?php echo $base_url; ?>index.php/poll/create_poll" title="Poll" class="showtooltip">
						<div class="roundPoll"></div>
					</a></div>
			</div>
			<div class="whiteSeparator"></div>
			<div class="fancyContentsContainer">
				<div class="sortByContainer">
					<div class="sortByContainerTransparent"></div>
					<div class="sortByContent">
						<div class="fancyLinksContainer"><a
								href="<?php echo $base_url?>index.php/order/user_fancy_product" class="fl">
								<div class="fancyLinkActive">My Fancy products</div>
								<div class="fancyBox"><?php echo $countfprod; ?></div>
							</a>

							<div class="fancySeperator"></div>
							<a href="<?php echo $base_url?>index.php/order/user_fancy_store" class="fl">
								<div class="fancyLink">My Fancy Stores</div>
								<div class="fancyBox"><?php echo $countfstore; ?></div>
							</a>

							<div class="fancySeperator"></div>
							<a href="<?php echo $base_url?>index.php/order/fancy_lists" class="fl">
								<div class="fancyLink">Lists</div>
								<div class="fancyBox"><?php echo $countflist; ?></div>
							</a>
							<!-- <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Blogazine</div> <div class="fancyBox">35</div> </a> <div class="fancySeperator"></div> <a href="javascript:void(0)" class="fl"> <div class="fancyLink">Styleboard</div> <div class="fancyBox">35</div> </a>-->
						</div>
					</div>
				</div> <?php if (count($fprod) == 0): ?>
					<div class="description_text">Not fancied anything yet? Get on the product pages and explore - we've
						found a thousand ways to hook you!! :-) And hey, don't blame us, one look at that profile photo
						and we knew we liked you ;-)
					</div> <?php endif; ?> <?php if (count($fprod) > 5) {
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
		</div>
	</section>
</section>
<div class="poll_popUp" id="pollPopup">
	<div class="poll_popUpTransp"></div>
	<div class="poll_popUpActual">
		<div class="fancy_text">Product has been added to your poll list</div>
		<div class="button_style">
			<button id="pollclose" type="button" class="prod_continue width_style_fancy">OK</button>
		</div>
	</div>
</div> <?php include "fancy_unfancy_prod.php" ?> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script>
	$(".ficon").attr("src", "<?php echo $base_url; ?>assets/images/dropfancy_hover.png");
	$(".ficon").siblings(".value").html(' ');
	function AddPoll(pid) {
		$.ajax({
			url: "<?php echo $base_url; ?>index.php/ajax_poll/add_to_poll/" + pid,
			success: function (data) {
			}

		});

		$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');

		$("#pollPopup").dialog({
			width: 605,
			height: 293,
			modal: true,
		});
		$("#pollclose").click(function () {
			$("#pollPopup").dialog('close');
		});
	}
	$(".fancyHolder").each(function () {

		var r = $(this).children(".hiddenFieldDiv1").val();
		var store_id = $(this).children(".hiddenFieldStoreid").val();
		var product_id = $(this).children(".hiddenFieldProductid").val();
		$(this).click(function () {
			var z = $(this).children(".hiddenFieldDiv1").val();
			if ($(this).children(".hoverText").html() == 'FANCY') {
				$("#FancyPopupContainer").dialog({
					width: 738,
					height: 510,
					modal: true
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop1?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);

						var myPname = $('#productNameD_' + product_id).html();
						$('.myProductName').html(myPname);

						var mySname = $('#storeNameD_' + store_id).html();
						$('.myStoreName').html(mySname);

						$("#f_img").attr('src', '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg');
						<?php /*?>document["f_img"].src='<?php echo $store_url; ?>assets/images/stores/'+store_id+'/'+product_id+'/img1_product.jpg';<?php */?>
						$('#popup_category').html(data);
					}
				});
				$('#checkboxesHolder1').jScrollPane({
					showArrows: false,
					animateScroll: true,
					maintainPosition: false
				});
			}
			else if ($(this).children(".hoverText").html() == 'EDIT') {
				$("#EditPopupContainer").dialog({
					width: 738,
					height: 510,
					modal: true,
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'index.php/ajax/fancy_product_fetchpop2?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);

						var myPname = $('#productNameD_' + product_id).html();
						$('.myProductName').html(myPname);

						var mySname = $('#storeNameD_' + store_id).html();
						$('.myStoreName').html(mySname);

						$("#uf_img").attr('src', '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg');
						<?php /*?>document["uf_img"].src='<?php echo $store_url; ?>assets/images/stores/'+store_id+'/'+product_id+'/img1_product.jpg';<?php */?>
						$('#popup_category1').html(data);
					}
				});
				$('#checkboxesHolder2').jScrollPane({
					showArrows: false,
					animateScroll: true
				});

			}
			$("#addtolist").click(function () {

				$("#FancyPopupContainer").dialog('close');
				//window.location.reload();
			});

			$("#unfancy").click(function () {

				$("#EditPopupContainer").dialog('close');
				//window.location.reload();

			});
		});
		$(this).hover(function () {

			if ($(this).children("#hoverText" + r).html() == 'FANCIED') {
				$(this).children("#hoverText" + r).html("EDIT");
				$(this).children("#hoverFancy" + r).removeClass('hoverFancyNext');
				$(this).children("#hoverFancy" + r).addClass('editFancynext');
			}

		}, function () {
			if ($(this).children("#hoverText" + r).html() == 'EDIT') {
				$(this).children(".hoverText").html("FANCIED");
				$(this).children("#hoverFancy" + r).removeClass('editFancynext');
				$(this).children("#hoverFancy" + r).addClass('hoverFancyNext');
			}
		});
	});

</script>
</html>