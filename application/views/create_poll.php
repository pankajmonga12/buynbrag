<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Poll - Create Poll</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.selectbox.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/poll2.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<style type="text/css">
		.poll_header {
			background-image: none !important;
			background-color: #F7F7F7 !important;
		}

		.ptext {
			color: #e81c4d;
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
						class="owner_pic"><?php $filename = 'assets/images/users/' . $userinfo[0]->user_id . '/' . $userinfo[0]->user_id . '_large.jpg'; if (file_exists($filename)): ?>
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
								<div class="pinkBadge"><a href="<?php echo $base_url . 'user_info/badges/'?>">
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
			<div class="topDotSeparator newtopDotSeparator"></div>
			<div class="linksMiddle">
				<!-- <a href="user_network_activities.php"><div class="productsLink"> <div class="activityLogo"></div> <div class="productsText newPadding">Activities</div> </div></a>-->
				<a href="<?php echo $base_url?>user_info/user_detail/">
					<div class="productsLink">
						<div class="profileLogo"></div>
						<div class="productsText newPadding">Profile</div>
					</div>
				</a>
				<!-- <a href="message.php"><div class="productsLink"> <div class="messageLogo"></div> <div class="productsText newPadding">Message</div> </div></a>-->
				<a href="<?php echo $base_url; ?>user_info/invite">
					<div class="productsLink">
						<div class="inviteLogo2"></div>
						<div class="productsText newPadding">Invite People</div>
					</div>
				</a> <a href="<?php echo $base_url?>user_info/purchase_history">
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
				<div class="categoryIcons"><a href="<?php echo $base_url; ?>user_info/badges" title="Badges"
				                              class="showtooltip">
						<div class="roundhBadge"></div>
					</a>
					<!-- <a href="styleboard.php" title="Styleboard" class="showtooltip"><div class="roundStyleboard"></div></a> <a href="blog.php" title="Blog" class="showtooltip"><div class="roundBlog"></div></a>-->
					<a href="<?php echo $base_url; ?>order/user_fancy_product">
						<div title="Fancy" class="roundFancy showtooltip"></div>
					</a> <a href="<?php echo $base_url; ?>index.php/poll/create_poll">
						<div class="roundPoll_active"></div>
					</a>

					<div class="categoriesText">POLL</div>
				</div>
			</div>
			<div class="whiteSeparator"></div>
			<div class="pollsContainer">
				<form name="create_poll" action="#" method="post">
					<div class="pollsLeft">
						<div class="pollsHeading">Create Your Poll</div>
						<div class="pollsLabel">Question</div>
						<div class="poll_textboxes"><input type="text" id="poll_ques"
						                                   placeholder="enter question here"/></div>
						<div class="pollsLabel">Type of Poll</div>
						<div class="radioBoxes">
							<div class="radioText2">
								<div class="radio2 rd" id="rd1"><input id="help_me" value="helMe" type="radio"
								                                       checked="true" name="poll_types"/></div>
								<div class="radio2Text">Help me Choose</div>
							</div>
							<div class="radioText2" id="rd2">
								<div class="radio2 rd"><input id="love_leave" value="itemAddDiv3" type="radio"
								                              name="poll_types"/></div>
								<div class="radio2Text">Love it/ Leave it</div>
							</div>
						</div>
						<div class="helMe" id="helMe">
							<div class="pollsLabel">How Many items should this poll contain?</div>
							<div class="radioBoxes">
								<div class="radioText2">
									<div class="radio2 item_radio" id="rad1"><input checked="checked" id="poll_items1"
									                                                value="itemAddDiv1" type="radio"
									                                                name="poll_items"/></div>
									<div class="Radiocontent">
										<div class="smbox"></div>
										<div class="smbox"></div>
										<div class="smbox"></div>
									</div>
								</div>
								<div class="radioText2">
									<div class="radio2 item_radio" id="rad2"><input id="poll_items2" value="itemAddDiv2"
									                                                type="radio" name="poll_items"/>
									</div>
									<div class="Radiocontent">
										<div class="smbox"></div>
										<div class="smbox"></div>
									</div>
								</div>
							</div>
							<div class="itemAddDiv1 items_hides" id="itemAddDiv1"><input type="hidden" value="1"
							                                                             id="hiddenFieldDiv"/>

								<div class="itemContainer" id="itemContainer1"><img class="forrad1"
								                                                    src="<?php echo $base_url; ?>assets/images/transparent.png"/>

									<div class="add_text" id="add_1">Add
										<div>Items</div>
									</div>
								</div>
								<div class="itemContainer" id="itemContainer2"><img class="forrad1"
								                                                    src="<?php echo $base_url; ?>assets/images/transparent.png"/>

									<div class="add_text" id="add_2">Add
										<div>Items</div>
									</div>
								</div>
								<div class="itemContainer marginRight0" id="itemContainer3"><img class="forrad1"
								                                                                 src="<?php echo $base_url; ?>assets/images/transparent.png"/>

									<div class="add_text" id="add_3">Add
										<div>Items</div>
									</div>
								</div>
							</div>
							<div class="itemAddDiv2 items_hides" id="itemAddDiv2"><input type="hidden" value="1"
							                                                             id="hiddenFieldDiv2"/>

								<div class="itemContainer" id="itemContainer_1"><img
										src="<?php echo $base_url; ?>assets/images/transparent.png"/>

									<div class="add_text" id="add1">Add
										<div>Items</div>
									</div>
								</div>
								<div class="itemContainer marginRight0" id="itemContainer_2"><img
										src="<?php echo $base_url; ?>assets/images/transparent.png"/>

									<div class="add_text" id="add2">Add
										<div>Items</div>
									</div>
								</div>
							</div>
						</div>
						<div class="itemAddDiv3" id="itemAddDiv3">
							<div class="itemContainer marginRight0" id="itemContainer4"><img
									src="<?php echo $base_url; ?>assets/images/transparent.png"/>

								<div class="add_text" id="add_text">Add
									<div>Items</div>
								</div>
							</div>
						</div>
						<div class="pollsLabel">Category</div>
						<div class="category2"><select class="down"
						                               name="category"> <?php $cnt = 0; foreach ($categories as $p_cat) {
									if ($cnt == 0) {
										echo "<option value=\"" . $p_cat->category_id . "\" selected=\"selected\">" . $p_cat->category_name . "</option>";
										$cnt = 1;
									} else echo "<option value=\"" . $p_cat->category_id . "\">" . $p_cat->category_name . "</option>";
								} ?> </select></div>
						<div class="pollsLabel">Poll Close Date</div>
						<div class="poll_drop" id="poll_date">
							<div class="category2 width212 fl"><select class="down" name="close_days">
									<option value="1" selected="selected">after 1 day</option>
									<option value="3">after 3 days</option>
									<option value="5">after 5 days</option>
									<option value="7">after 1 week</option>
									<option value="14">after 2 weeks</option>
									<option value="30">after 1 month</option>
								</select></div>
						</div>
						<div class="buttonDivs clear_both"><a href="javascript:void(0)">
								<button class="prod_continue" id="publish" type="button">Publish</button>
							</a>
							<button class="prod_cancel" type="submit">Cancel</button>
						</div>
					</div>
					<div class="panelSeparator"></div>
					<div class="pollsRight">
						<div class="item_searchDiv">
							<div class="item_searchMain">
								<div class="itemSearchNav">
									<div class="items paddingLeft18">My items</div>
									<!--<div class="searchpoll">Search</div>--> </div>
								<div class="itemsSelect">
									<!-- <div class="myitems_show"> <div class="selectitems paddingLeft18">Select one of your lists</div> <div class="category2 width371 paddingLeft18"> <select class="down" name="category4"> <option value="recently" selected="selected">Recently Added Items</option> <option value="popular">Popular</option> <option value="Prices">Prices</option> </select> </div> </div>-->
									<div class="search_show">
										<div class="selectitems paddingLeft18">Search</div>
										<div class="search_textboxes"><input type="text" placeholder="Fashion"/>

											<div class="searchProductIcon"></div>
										</div>
									</div>
								</div>
								<div class="recentlyitemsnot">
									<div class="rectext">Recently Added Items</div>
									<div class="reasonText">In order to create this type of poll, you must first add
										products to one of your BuynBrag lists
									</div>
								</div>
								<div class="recentlyadd_items">
									<div class="sep"></div>
									<div class="rectext" style=" padding: 12px 20px;">My Recently added Products
										- <?php echo count($poll_products);?></div>
									<div class="showingText">Showing 20/450</div>
									<div class="sep"></div>
									<div class="scrollerHolderPromote">
										<div class="scrollerContentsPromote">
											<div class="button-block-left extraTopPosition" id="scrollLeftButton"></div>
											<div id="sliderParentDiv" class="sliderParentDivPromote">
												<div class="sliderPromote"
												     id="slider"> <?php for ($j = 0; $j < ceil(count($poll_products) / 12); $j++): ?>
														<div class="store-listPromote">
															<div
																class="rightPanelImageHolder"> <?php if ($j == ceil(count($poll_products) / 12) - 1) $k = (count($poll_products) % 12); else $k = 12; for ($i = 1; $i < 13; $i++) {
																	if ($i == 1 or $i == 5 or $i == 9) {
																		$div_class_open = "<div class=\"imageHolderPromote\">";
																		$div_class_close = "";
																		$div_panel_image = "panelImage1";
																	} elseif ($i == 4 or $i == 8 or $i == 12) {
																		$div_class_open = "";
																		$div_class_close = "</div>";
																		$div_panel_image = "panelImage1 paddingRight0";
																	} else {
																		$div_class_open = "";
																		$div_class_close = "";
																		$div_panel_image = "panelImage1";
																	}
																	if ($i <= $k) {
																		echo $div_class_open;
																		echo "<div class=\"" . $div_panel_image . "\"><a href=\"javascript:void(" . $poll_products[($j * 12) + $i - 1]->product_id . ")\"> <img id=\"" . $poll_products[($j * 12) + $i - 1]->product_id . "\" src=\"" . $store_url . "assets/images/stores/" . $poll_products[($j * 12) + $i - 1]->store_id . "/" . $poll_products[($j * 12) + $i - 1]->product_id . "/img1_92x77.jpg\" /></a></div>";
																		echo $div_class_close;
																	}
																} ?> </div>
														</div> <?php endfor; ?> </div>
												<div class="button-block-right extraTopPosition"
												     id="scrollRightButton"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="BragPopupContainer" id="BragPopupContainer">
					<div class="BragPopupWrapper">
						<div class="BragPopupTransp"></div>
						<div class="BragPopupActual"> <?php if(count($friends) > 0) :?>
							<form action="poll_shared" method="post"><?php endif;?>
								<div class="headingAndClose padding_top8">
									<div class="Addtofancytext">SEND POLL TO FRIENDS</div>
									<div class="PopupClose" id="popUpClose3"></div>
								</div>
								<div class="leftRightPop1">
									<div class="radiobuttonConatainer">
										<div class="radioText">
											<div class="radio1 item_radio1"><input type="radio" value="bnb_friends"
											                                       name="brag" checked="checked"/></div>
											<div class="checkText diffstyle">BnB Friends</div>
										</div>
									</div>
									<div class="BragContainer" id="bnb_friends">
										<div class="BragleftPop fl">
											<div class="selectAllContainer">
												<div class="fl">
													<div class="checkbox select_all" id="selectAll2"><input
															type="checkbox" name="check_all" value="1"/></div>
													<div class="checkText2">Select All</div>
												</div>
												<div class="fr">
													<div class="imported_text"><?php echo count($friends); ?> Friends
														imported
													</div>
												</div>
												<!--<div class="searchFriends"> <input type="text" placeholder="search for friends"/> </div>-->
											</div>
											<div class="rightPop2 width290" id="select_all">
												<div class="checkboxesHolder2 width290"><input name="poll_quest"
												                                               type="hidden" value="">
													<input name="poll_type" type="hidden" value="2"> <input
														name="no_of_items" type="hidden" value="3"> <input name="p_id_1"
													                                                       type="hidden"
													                                                       value="0">
													<input name="p_id_2" type="hidden" value="0"> <input name="p_id_3"
													                                                     type="hidden"
													                                                     value="0">
													<input name="poll_category" type="hidden" value="0"> <input
														name="poll_close_date" type="hidden"
														value="1"> <?php $c_cnt = 0; ?> <?php foreach ($friends as $p_friends) : ?>
														<div class="checkBoxText1" id="checkBox_Text1">
															<div class="checkbox Bcheckit1"><input
																	id="check_item<?php $c_cnt = $c_cnt + 1;echo $c_cnt; ?>"
																	type="checkbox" value="1"
																	name="user_<?php echo $p_friends['user_id'];?>"/>
															</div>
															<div class="friendsimg"><img height="25" width="25"
															                             src="<?php echo $base_url; ?>assets/images/users/<?php echo $p_friends['user_id'];?>/<?php echo $p_friends['user_id'];?>.jpg"/>
															</div>
															<div
																class="checkText2"><?php echo $p_friends['full_name'];?></div>
														</div> <?php endforeach; ?> </div>
											</div>
										</div>
									</div>
								</div>
								<div class="BragbottomButton clear_both">
									<button class="prod_continue" style="width:160px;"
									        id="share" <?php if (count($friends) > 0) : ?> type="submit" <?php else : ?>onclick ="return alert('You dont have any friends to share this poll.')" <?php endif; ?>>
										Share
									</button>
								</div> <?php if(count($friends) > 0) :?></form><?php endif;?> </div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<!--<script type="text/javascript" src="<?php //echo $base_url; ?>assets/js/poll2.js"></script>-->
<script type="text/javascript"><!--
poll2.js-->
$(".picon").attr("src", "<?php echo $base_url; ?>assets/images/droppoll_hover.png");
$(".picon").siblings(".value").html('');
// JavaScript Document
$(function () {

	$("#rd1").click(function () {

		$("input[name='poll_type']").val("2");
		$("input[name='no_of_items']").val("3");

	});
	$("#rd2").click(function () {

		$("input[name='poll_type']").val("1");
		$("input[name='no_of_items']").val("1");

	});
	$("#rad1").click(function () {

		$("input[name='no_of_items']").val("3");

	});
	$("#rad2").click(function () {


		$("input[name='no_of_items']").val("2");

	});

	$(".radio2").dgStyle();
	$(".check_box").dgStyl();
	$(".down").selectbox();
	$(".rd").each(function () {

		$(this).click(function () {
			if ($(this).css("background-position") == '50% -40px') {
				var q = $(this).children().val();
				if (q == 'helMe') {
					$("#itemAddDiv3").hide();
					$("#helMe").show();
				}
				else if (q == 'itemAddDiv3') {
					$("#helMe").hide();
					$("#itemAddDiv3").show();
					$("#itemContainer4 img").attr('src', '<?php echo $base_url; ?>assets/images/transparent.png');
					$("#add_text").show();
				}
			}
			else if ($(this).css("background-position") == 'center 0px') {
			}
		});
	});
	$(".item_radio").each(function () {

		$(this).click(function () {
			if ($(this).css("background-position") == '50% -40px') {
				var q = $(this).children().val();
				if (q == 'itemAddDiv1') {
					$(".items_hides").hide();
					$("#itemAddDiv1").show();
					$("#itemContainer1 img, #itemContainer2 img, #itemContainer3 img").attr('src', '<?php echo $base_url; ?>assets/images/transparent.png');
					$("#add_1, #add_2, #add_3").show();
					$('#hiddenFieldDiv').val("1");
				}
				if (q == 'itemAddDiv2') {
					$(".items_hides").hide();
					$("#itemAddDiv2").show();
					$("#itemContainer_1 img, #itemContainer_2 img").attr('src', '<?php echo $base_url; ?>assets/images/transparent.png');
					$("#add1, #add2").show();
					$('#hiddenFieldDiv2').val("1");

				}

			}
			else if ($(this).css("background-position") == 'center 0px') {
			}
		});
	});
	/*   $("#datedrop").change(function(){

	 $('.poll_drop').hide();
	 $('#' + $(this).val()).show();

	 });*/
	$("#layout").change(function () {

		$('.items_hides').hide();
		$('#' + $(this).val()).show();
		var s = $(this).val();
		if (s == 'itemAddDiv1') {
			$("#add_1, #add_2, #add_3").show();
			$('#hiddenFieldDiv').val("1");
		}
		if (s == 'itemAddDiv2') {
			$("#add1, #add2").show();
			$('#hiddenFieldDiv2').val("1");

		}
		if (s == 'itemAddDiv3') {
			$("#itemContainer4 img").attr('src', '<?php echo $base_url; ?>assets/images/transparent.png');
			$("#add_text").show();
		}

	});
	var totalScroll = 0;

	$("#scrollLeftButton").click(function () {
		var rightArrowShow = $("#scrollRightButton").css('display');
		if (rightArrowShow == 'none')
			$("#scrollRightButton").css('display', 'block');

		//alert(totalScroll);
		if (totalScroll <= 400) {
			$("#scrollLeftButton").css('display', 'none');
		}
		if (totalScroll <= 0) return;
		totalScroll = totalScroll - 400;
		$('#sliderParentDiv').animate({scrollLeft: totalScroll}, 500);
	});
	var x =<?php echo ceil(count($poll_products)/12); ?>;
	var totalWidth = x * 400;
	$("#slider").css("width", totalWidth + "px");
	$("#scrollRightButton").click(function () {
		if (x == 1) {
		} else {
			var rightArrowShow = $("#scrollLeftButton").css('display');
			if (rightArrowShow == 'none')
				$("#scrollLeftButton").css('display', 'block');

			maxScroll = parseInt($("#slider").css("width")) - parseInt($("#sliderParentDiv").width());
			if ((totalScroll + 400) >= maxScroll) {
				$("#scrollRightButton").css('display', 'none');
				totalScroll = totalScroll + 400;
				$('#sliderParentDiv').animate({scrollLeft: totalScroll}, 500);
				return
			}
			totalScroll = totalScroll + 400;
			$('#sliderParentDiv').animate({scrollLeft: totalScroll}, 500);
		}
	});
	$(".searchpoll").click(function () {
		$(this).css('color', '#DA3C63');
		$(".items").css('color', '#999999');
		$(".myitems_show").hide();
		$(".search_show").show();
		$(".showingText").show();
		$(".rectext").hide();


	});
	$(".items").click(function () {
		$(this).css('color', '#DA3C63');
		$(".searchpoll").css('color', '#999999');
		$(".search_show").hide();
		$(".myitems_show").show();
		$(".rectext").show();
		$(".showingText").hide();


	});
	$(".panelImage1 img").each(function () {
		$(this).click(function () {

			var image = $(this).attr('src');
			if ($("#itemAddDiv3").css("display") == 'block') {
				$("#add_text").hide();
				$("#itemContainer4 img").attr('src', image);
				$("#itemContainer4 img").height("145px");
				$("#itemContainer4 img").width("173px");
				$("input[name='p_id_1']").val($(this).attr('id'));
			}

			else if ($("#itemAddDiv1").css("display") == 'block') {
				if ($("#itemContainer1 img").attr('src') == image || $("#itemContainer2 img").attr('src') == image || $("#itemContainer3 img").attr('src') == image) {
					alert("image is already selected");
				}
				else {
					var i = parseInt(document.getElementById('hiddenFieldDiv').value);
					$("#add_" + i).hide();
					$("#itemContainer" + i + " img").attr('src', image);
					$("#itemContainer" + i + " img").height("145px");
					$("#itemContainer" + i + " img").width("173px");
					$("input[name='p_id_" + i + "']").val($(this).attr('id'));
					i = i + 1;
					if (i <= 3)
						$('#hiddenFieldDiv').val(i);
					else {
						$('#hiddenFieldDiv').val("1");
					}
				}
			}
			else if ($("#itemAddDiv2").css("display") == 'block') {
				if ($("#itemContainer_1 img").attr('src') == image || $("#itemContainer_2 img").attr('src') == image) {
					alert("image is already selected");
				}
				else {
					var i = parseInt(document.getElementById('hiddenFieldDiv2').value);
					$("#add" + i).hide();
					$("#itemContainer_" + i + " img").attr('src', image);
					$("#itemContainer_" + i + " img").height("145px");
					$("#itemContainer_" + i + " img").width("173px");
					$("input[name='p_id_" + i + "']").val($(this).attr('id'));
					i = i + 1;
					if (i <= 2)
						$('#hiddenFieldDiv2').val(i);
					else
						$('#hiddenFieldDiv2').val("1");
				}
			}
		});
	});


	$("#publish").click(function () {
		var q = "<?php echo $base_url; ?>assets/images/transparent.png";
		if ($("#helMe").css("display") == 'block') {
			if ($("#itemAddDiv1").css("display") == 'block') {
				if ($("#itemContainer1 img").attr('src') == q || $("#itemContainer2 img").attr('src') == q || $("#itemContainer3 img").attr('src') == q) {
					alert("Please Add all the items in a box");
					return false;
				}
			}
			else if ($("#itemAddDiv2").css("display") == 'block') {
				if ($("#itemContainer_1 img").attr('src') == q || $("#itemContainer_2 img").attr('src') == q) {
					alert("Please Add all the items in a box");
					return false;
				}
			}
		}
		else if ($("#itemAddDiv3").css("display") == 'block') {
			if ($("#itemContainer4 img").attr('src') == q) {
				alert("Please Add the items in a box");
				return false;
			}

		}
		$("input[name='poll_quest']").val($("#poll_ques").val());
		$("input[name='poll_category']").val($("select[name='category']").val());
		$("input[name='poll_close_date']").val($("select[name='close_days']").val());

		$(".BragPopupContainer").dialog({
			width: 668,
			height: 522,
			modal: true,
		});

		$('.checkboxesHolder2').jScrollPane({
			showArrows: false,
			animateScroll: true
		});

		$("#popUpClose3").click(function () {
			$(".BragPopupContainer").dialog('close');
		});

	});

	$(".Bcheckit, .Bcheckit1, .select_all").dgStyl();
	/*$(".item_radio1").dgStyle();*/
	/*$(".item_radio1").each(function(){

	 $(this).click(function(){
	 if($(this).css("background-position")=='50% -40px')
	 {
	 var q=$(this).children().val();
	 if(q=='facebook_friends')
	 {
	 $(".BragContainer").hide();
	 $("#facebook_friends").show();
	 $(".BragbottomButton").css('margin-top','0');
	 $('.checkboxesHolder2').jScrollPane();
	 }
	 if(q=='bnb_friends')
	 {
	 $(".BragContainer").hide();
	 $("#bnb_friends").show();
	 $(".BragbottomButton").css('margin-top','0');
	 $('.checkboxesHolder2').jScrollPane();
	 }
	 if(q=='via_email')
	 {
	 $(".BragContainer").hide();
	 $("#via_email").show();
	 $(".BragbottomButton").css('margin-top','-20px');
	 }
	 }
	 });
	 });*/
	$(".select_all").click(function () {
		if ($(this).css("background-position") == '50% -33px') {
			if ($(this).closest(".BragContainer").attr('id') == 'facebook_friends') {
				$(".Bcheckit").css({"background-position": "50% -33px"});
				$(".Bcheckit").parent().css({"background-color": "#fff"});
			}
			else if ($(this).closest(".BragContainer").attr('id') == 'bnb_friends') {
				$(".Bcheckit1").css({"background-position": "50% -33px"});
				$(".Bcheckit1").parent().css({"background-color": "#fff"});
			}
		}
		else if ($(this).css("background-position") == '50% 0px') {

			if ($(this).closest(".BragContainer").attr('id') == 'facebook_friends') {
				$(".Bcheckit").css({"background-position": "50% 0px"});
				$(".Bcheckit").parent().css({"background-color": "#f4f4f4"});

			}
			else if ($(this).closest(".BragContainer").attr('id') == 'bnb_friends') {
				$(".Bcheckit1").css({"background-position": "50% 0px"});
				$(".Bcheckit1").parent().css({"background-color": "#f4f4f4"});
			}
		}
	});

	$(".Bcheckit").each(function () {
		$(this).click(function () {

			if ($(this).css("background-position") == '50% -33px') {
				$(this).parent().css({"background-color": "#FFF"});
				if ($("#selectAll1").css("background-position") == '50% -33px') {
					$(this).css({"background-position": "50% 0px"});
					$(this).parent().css({"background-color": "#f4f4f4"});
				}
			}
			else if ($(this).css("background-position") == '50% 0px') {
				$(this).parent().css({"background-color": "#f4f4f4"});
				if ($("#selectAll1").css("background-position") == '50% -33px') {
					$(this).css({"background-position": "50% -33px"});
					$(this).parent().css({"background-color": "#fff"});
				}
			}

		});
	});
	$(".Bcheckit1").each(function () {

		$(this).click(function () {
			if ($(this).css("background-position") == '50% -33px') {
				$(this).parent().css({"background-color": "#FFF"});
				if ($("#selectAll2").css("background-position") == '50% -33px') {
					$(this).css({"background-position": "50% 0px"});
					$(this).parent().css({"background-color": "#f4f4f4"});
				}
			}
			else if ($(this).css("background-position") == '50% 0px') {
				$(this).parent().css({"background-color": "#f4f4f4"});
				if ($("#selectAll2").css("background-position") == '50% -33px') {
					$(this).css({"background-position": "50% -33px"});
					$(this).parent().css({"background-color": "#fff"});
				}
			}
		});
	});


	$(".owner_name").each(function () {
		var len = 15;
		var trunc = $(this).text();
		if ($(this).text().length > len) {
			/* Truncate the content of the P, then go back to the end of the
			 previous word to ensure that we don't truncate in the middle of
			 a word */
			$(this).attr("title", trunc);

			$(this).addClass("showtooltip2");

			trunc = trunc.substring(0, len);
			trunc = trunc.replace(/\w+$/, '');

			trunc += '..';

			$(this).html(trunc);
		}
	});
	tooltip2();

});
</script>
</html>