<!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $mystore[0]->store_name; ?></title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/fancy_unfancy.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.tabs.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.jscrollpane.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_page.css"/>
	<link rel="stylesheet" type="text/css"
	      href="<?php echo $base_url; ?>assets/css/landing_page.css"/> <?php //require_once('stylesheets.php') ?>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<script type="text/javascript">
	function bragStore() {
		var params = {};
		params['message'] = "<?php echo $userdetails[0]->full_name; ?> just acquired bragging rights for <?php echo $mystore[0]->store_name; ?> !! You can't blame them ! It's frickin' awesome";
		params['name'] = 'BuynBrag.com';
		params['description'] = 'You can also acquire bragging rights for this store by logging into www.buynbrag.com';
		params['link'] = "http://www.buynbrag.com/";
		params['picture'] = '<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/storepage_banner.png';
		params['caption'] = 'is your destination for everything hard-to-find';

		FB.api('/me/feed', 'post', params, function (response) {
			if (!response || response.error) {
			} else {

				$.ajax({
					url: "<?php echo $base_url; ?>" + 'brag_ajax/store_brag?store_id=<?php echo $mystore[0]->store_id; ?>',
					success: function (data) {
						$('#brag_count').html(data);
						$('#brag').html('BRAGGED');
					}
				});
			}
		});
	}
</script>
<body> <!-- Added by lee for fb share post. Should be just below Body tag. -->

<!-- End fb share post. by lee -->
<section class="wrapper">
	<article class="banner">
		<div class="slide">
			<div class="topBanerPatternContainer"></div>
			<div class="topBannerContainer">
				<div class="bannerImageHolder"><a
						href="<?php echo $base_url; ?>order/store_page/<?php echo $mystore[0]->store_id; ?>"> <img
							src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/storepage_banner.jpg"/>
					</a></div>
				<div class="fancyBragContainer">
					<div class="fancyBragHolder"> <?php if ($fancied) : ?>
							<button type="submit" class="fancyHolderStore" onClick="unfancy_store();"><img name="im2"
							                                                                               src="<?php echo $base_url; ?>assets/images/fancy_click.png"/>

								<div class="fancText" id="imuf">FANCIED</div>
							</button> <?php else : ?>
							<button type="submit" class="fancyHolderStore" onClick="fancy_store_changed();"><img
									name="im2" src="<?php echo $base_url; ?>assets/images/fancy_normal.png"/>

								<div class="fancText" id="im1">FANCY THIS STORE</div>
							</button> <?php endif;?> <?php if ($bragged) : ?>
							<button type="submit" class="bragHolder" onClick="this.disabled=1;"><img class="bragLogo"
							                                                                         src="<?php echo $base_url; ?>assets/images/braged_icon.png">

								<div class="fancText" id="brag">BRAGGED</div>
							</button> <?php else: ?>
							<button type="submit" class="bragHolder" onClick="bragStore();this.disabled=1;"><img
									class="bragLogo" src="<?php echo $base_url; ?>assets/images/braged_icon.png">

								<div class="fancText" id="brag">BRAG THIS STORE</div>
							</button> <?php endif; ?> </div>
				</div>
				<div class="bannerDescriptionText"
				     style="padding-bottom:32px;"> <?php echo substr($mystore[0]->about_store, 0, 550) . '...'; ?> </div>
				<div class="bannerBadgesContainer">
					<div class="bannerBadgesHolder">
						<div class="badgesText">Policy</div> <?php if ($mystore[0]->COD_policy == 1): ?>
							<div class="gold_badge"><img
									src="<?php echo $base_url; ?>assets/images/badges/stores/cod.png" alt="cod badge"/>
							</div> <?php endif; ?> <?php if ($mystore[0]->EMI_policy == 1): ?>
							<div class="platinum_badge"><img
									src="<?php echo $base_url; ?>assets/images/badges/stores/emi.png" alt="emi badge"/>
							</div> <?php endif; ?> <?php if ($mystore[0]->return_policy == 0): ?> <img
							src="<?php echo $base_url; ?>assets/images/badges/stores/noreturn.png"
							alt="return badge"/> <?php else : ?> <img
							src="<?php echo $base_url; ?>assets/images/badges/stores/happyreturn.png"
							alt="return badge"/> <?php endif; ?> </div>
					<div class="bannerRightIcons">
						<div class="badgesText so_far_text">SO FAR</div>
						<div class="fancHolder">
							<div class="fancyIcon"></div>
							<div class="fancyTextHolder">
								<div class="fancyNumber" id="fan"><?php echo $mystore[0]->fancy_counter; ?></div>
								<div class="fancyText">fancied</div>
							</div>
						</div>
						<div class="fancHolder">
							<div class="bragedIcon"></div>
							<div class="fancyTextHolder fancy_style">
								<div class="fancyNumber" id="brag_count"><?php echo $mystore[0]->brag_counter; ?></div>
								<div class="fancyText">bragged</div>
							</div>
						</div>
						<div class="fancHolder">
							<div class="viewedIcon"></div>
							<div class="fancyTextHolder newfancyTextHolder2">
								<div class="fancyNumber"><?php echo $mystore[0]->visit_counter; ?></div>
								<div class="fancyText">viewed</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
	<section class="middleBackground">
		<div class="topDotSeparator"></div>
		<div class="storeMiddleBackgroundContainer">
			<div class="leftPanel">
				<div class="storeSectionText">Store Section</div>
				<a href="<?php echo $base_url; ?>order/store_page_store_section/<?php echo $mystore[0]->store_id; ?>">
					<div class="shopHomeText">Shop Home</div>
				</a> <!--Store Section--> <?php for ($i = 0; $i < (count($mysec)); $i++): ?>
					<div class='shopHomeText'
					     onClick="select_category('<?php echo $base_url; ?>order/store_page_store_section/<?php echo $mystore[0]->store_id ?>',<?php echo $i; ?>)"><?php echo ucwords(strtolower($mysec[$i]->name)); ?></div> <?php endfor; ?>
				<div class="ShopOwnerTextImage">
					<div class="storeShopOwnerText">Store Owner</div>
					<div class="sideArrowIcon"></div>
				</div>
				<div class="storeProfileImageContainer">
					<div
						class="storeProfileImage"> <?php $filename = "assets/images/stores/" . $mystore[0]->store_id . "/owner/owner_40x40.jpg"; if (file_exists($filename)): ?>
							<a href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>">
								<img
									src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/owner/owner_40x40.jpg"/>
							</a> <?php else: ?> <a
							href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>">
							<img src="<?php echo $base_url; ?>assets/images/default/defsmall.jpg" alt="profile_pic"/>
						</a> <?php endif; ?> </div>
					<div class="storeLeahTextHolder"><a class="storeLeahText"
					                                    href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>"><?php echo $mystore[0]->owner_name; ?></a>

						<div
							class="newYorkText"><?php echo $mystore[0]->owner_city . ',' . $mystore[0]->owner_state; ?></div>
					</div>
				</div>
				<a href="<?php echo $base_url; ?>owner/owner_info/<?php echo $mystore[0]->store_id; ?>">
					<div class="storeContactText clear_both">Contact</div>
				</a> <!--<a href="javascript:void(0)"><div class="storeContactText">Policies</div></a>-->
				<!--<a href="javascript:void(0)"><div class="storeContactText request_bottom" id="feedback_popup">Feedback</div></a>-->
				<!-- <div class="storeShopRankingText">Shop Ranking <span style="color:#f03562;">46</span></div>-->
			</div>
			<div class="panelSeparator"></div>
			<div class="rightPanel">
				<div class="storeSectionText extra_style">Recently Added Products</div>
				<div class="hurrayOfferText">Hurry! don’t miss todays best offer!</div>
				<div class="scrollerHolder">
					<div id="product_popup1" class="storeViewIcon"></div>
					<div class="scrollerContents">
						<div class="button-block-left" id="scrollLeftButton"></div>
						<div id="sliderParentDiv_1" class="sliderParentDiv">
							<div class="slider"
							     id="slider"> <?php for ($i = 0; $i < count($products); $i++): ?> <?php if (($i % 3) == 0) {
									$class = "store-list paddingLeft0";
								} else {
									$class = "store-list";
								} ?>
									<div class="<?php echo $class; ?>">
										<div class="rightPanelImageHolder1"><a
												href="<?php echo $base_url?>order/product_page/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[$i]->product_id; ?>">
												<img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $products[$i]->product_id; ?>/img1_240x200.jpg"/>
											</a>

											<div
												class="storeDecoratingText pro_name"><?php echo substr($products[$i]->product_name, 0, 30); ?> </div>
											<div class="fl">
												<div
													class="storeDecoratingText stor_nm font12"><?php echo $mystore[0]->store_name; ?></div>
												<div class="storeFancyHolder">
													<div class="fanciedIcon"></div>
													<div
														class="fancyNumber price storeExtraStyle"><?php echo $products[$i]->fancy_counter; ?></div>
													<div class="fancyText storeExtraStyle">fancied</div>
												</div>
											</div>
											<div class="priceHolder"><span
													class="rupee">`</span> <?php echo intval($products[$i]->selling_price); ?>
											</div>
										</div>
										<div class="hoverHolder">
											<div
												class="fancyHolder1"> <?php if (isset($fancied_prods[$products[$i]->product_id])): ?>
													<input type="hidden" value="<?php echo $i + 1; ?>"
													       class="hiddenFieldDiv1"/> <input type="hidden"
													                                        value="<?php echo $products[$i]->store_id; ?>"
													                                        class="hiddenFieldStoreid"/>
													<input type="hidden"
													       value="<?php echo $products[$i]->product_id; ?>"
													       class="hiddenFieldProductid"/>
													<div class="hoverFancyNext"
													     id="hoverFancy<?php echo $i + 1; ?>"></div>
													<div class="hoverText" id="hoverText<?php echo $i + 1; ?>">FANCIED
													</div> <?php else: ?> <input type="hidden"
											                                     value="<?php echo $i + 1; ?>"
											                                     class="hiddenFieldDiv1"/> <input
													type="hidden" value="<?php echo $products[$i]->store_id; ?>"
													class="hiddenFieldStoreid"/> <input type="hidden"
											                                            value="<?php echo $products[$i]->product_id; ?>"
											                                            class="hiddenFieldProductid"/>
													<div class="hoverFancy" id="hoverFancy<?php echo $i + 1; ?>"></div>
													<div class="hoverText" id="hoverText<?php echo $i + 1; ?>">FANCY
													</div> <?php endif; ?>
											</div> <?php if (isset($poll_prods[$products[$i]->product_id])) : ?>
												<div class="PollHolder">
													<div class="hoverPoll"
													     style="background-image: url(<?php echo $base_url; ?>assets/images/brag_pink.png);"></div>
													<div class="hoverText">BRAGGED!</div>
												</div> <?php else: ?>
												<div id="brag_<?php echo $products[$i]->product_id; ?>"
												     class="PollHolder">
													<div class="hoverPoll"
														 style="background-image: url('<?php echo $base_url; ?>assets/images/brag_grey.png');"
													     onClick="return brag(<?php echo $products[$i]->product_id; ?>, <?php echo $products[$i]->store_id; ?>, '<?php echo substr($products[$i]->product_name,0,42); ?>')"></div>
													<div class="hoverText">BRAG!</div>
												</div> <?php endif; ?> </div>
									</div> <?php endfor; ?> </div>
						</div>
						<div class="button-block-right" id="scrollRightButton"></div>
					</div>
				</div>
				<div class="topScrollerSeparator"></div>
				<div class="storeSectionText extra_style" style="padding-top:28px;">Recently Sold</div>
				<!-- <div class="hurrayOfferText"><span class="numberBold">23</span> products have been sold this month</div>-->
				<div class="scrollerHolder">
					<div id="product_popup2" class="storeViewIcon"></div>
					<div class="scrollerContents">
						<div class="button-block-left" id="scrollLeftButton2"></div>
						<div id="sliderParentDiv_2" class="sliderParentDiv">
							<div class="slider"
							     id="slider2"> <?php for ($i = 0; $i < count($recentlysold); $i++): ?> <?php if (($i % 3) == 0) {
									$class = "store-list paddingLeft0";
								} else {
									$class = "store-list";
								} ?>
									<div class="<?php echo $class; ?>">
										<div class="rightPanelImageHolder1"><a
												href="<?php echo $base_url?>order/product_page/<?php echo $mystore[0]->store_id; ?>/<?php echo $recentlysold[$i]->product_id; ?>">
												<img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $mystore[0]->store_id; ?>/<?php echo $recentlysold[$i]->product_id; ?>/img1_240x200.jpg"/>
											</a>

											<div
												class="storeDecoratingText pro_name"><?php echo substr($recentlysold[$i]->product_name, 0, 30); ?></div>
											<div class="fl">
												<div
													class="storeDecoratingText font12 stor_nm"><?php echo $mystore[0]->store_name; ?></div>
												<div class="storeFancyHolder">
													<div class="fanciedIcon"></div>
													<div
														class="fancyNumber storeExtraStyle"><?php echo $recentlysold[$i]->fancy_counter; ?></div>
													<div class="fancyText storeExtraStyle">fancied</div>
												</div>
											</div>
											<div class="priceHolder"><span
													class="rupee">`</span> <?php echo intval($recentlysold[$i]->selling_price); ?>
											</div>
										</div>
									</div> <?php endfor; ?> </div>
						</div>
						<div class="button-block-right" id="scrollRightButton2"></div>
					</div>
				</div>
				<!-- <div class="topScrollerSeparator"></div>-->
				<!-- <div class="rightPanelRightScroller2"> <div class="rightPanelImageContent2"> <div class="rightPanelFriendsTextHolder"> <div class="storeSectionText2 paddingBottom18">Blog</div> </div> <div class="scrollerHolder5"> <div id="product_popup3" class="storeViewIcon"></div> <div class="scrollerContents5"> <div class="button-block-left" id="scrollLeftButton7"></div> <div id="sliderParentDiv_7" class="sliderParentDiv5"> <div class="slider5" id="slider7"> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/blog_image_1.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list5"> <div class="rightPanelImageHolderBottom5"> <div class="storeJeansText2">Jeans Styles for Girls </div> <div class="tiannaMeilingerText"><span class="spanStyle">by</span> Tianna Meilinger</div> <div class="blogImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/blog_image_1.png" /></a></div> <div class="renaissanceText">Since my Renaissance-themed lists have garnered so much attention...</div> <div class="storeFancyHolder paddingLeft6"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> </div> </div> <div class="button-block-right" id="scrollRightButton7"></div> </div> </div> </div> </div> <div class="rightPanelRightScroller"> <div class="verticalSeparator fl newHeight"></div> <div class="rightPanelImageContent"> <div class="rightPanelFriendsTextHolder"> <div class="storeSectionText2 paddingBottom18">Styleboard</div> </div> <div class="scrollerHolder3"> <div id="product_popup4" class="storeViewIcon"></div> <div class="scrollerContents3"> <div class="button-block-left" id="scrollLeftButton5"></div> <div id="sliderParentDiv_5" class="sliderParentDiv3"> <div class="slider3" id="slider5"> <div class="store-list3"> <div class="rightPanelImageHolderBottom3"> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_1.png" /></a></div> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_2.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_3.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_4.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_5.png" /></a></div> <div class="clothingFestivalText clothingTextStyle paddingTop8">Clothing Festival </div> <div class="createdJuneText clothingTextStyle">created on <span class="rockwellSpan">june 23</span></div> <div class="storeFancyHolder storeFancyHolderNew"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> <div class="store-list3"> <div class="rightPanelImageHolderBottom3"> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_1.png" /></a></div> <div class="styboardImage1"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_2.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_3.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_4.png" /></a></div> <div class="styboardImage3"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/styleboard_image_5.png" /></a></div> <div class="clothingFestivalText clothingTextStyle paddingTop8">Clothing Festival </div> <div class="createdJuneText clothingTextStyle">created on <span class="rockwellSpan">june 23</span></div> <div class="storeFancyHolder clothingTextStyle storeFancyHolderNew"> <div class="fanciedIcon"></div> <div class="fancyNumber storeExtraStyle">548</div> <div class="fancyText storeExtraStyle">fancied</div> </div> </div> </div> </div> </div> <div class="button-block-right" id="scrollRightButton5"></div> </div> </div> </div> </div> <div class="rightPanelRightScroller"> <div class="verticalSeparator fl newHeight"></div> <div class="rightPanelImageContent"> <div class="rightPanelFriendsTextHolder"> <div class="storeSectionText2">People who fancied</div> <div class="hurrayOfferText hurrayOfferTextNew"><span class="numberBold"><?php echo count($store_fancy); ?></span> People fancied <?php echo $mystore[0]->store_name; ?></div> </div> <div class="rightPanelViewIcon"></div> <div class="rightPanelSmallImages"> <?php if (count($store_fancy)> 12 ) $n = 12; else $n=count($store_fancy); for($i = 0; $i<$n; $i++): ?> <?php if ( $i%3 == 2) $class = "rightPanelSmallImagesDiv rightPanelImage3"; else $class = "rightPanelSmallImagesDiv"; ?> <div class="<?php echo $class; ?>"> <?php $filename = 'assets/images/users/'.$store_fancy[$i]->user_id.'/'.$store_fancy[$i]->user_id.'_156x156.jpg'; if (file_exists($filename)):?> <img src=<?php echo $base_url; ?>assets/images/users/<?php echo $store_fancy[$i]->user_id.'/'.$store_fancy[$i]->user_id.'_156x156.jpg'; ?> width="62" height="62" /></div> <?php else: ?> <img src="<?php echo $base_url; ?>assets/images/default/defbig.jpg" width="62" height="62"/></div> <?php endif; ?> <?php endfor; ?> </div> </div> </div> -->
				<div class="topScrollerSeparator clear_both"></div>
				<!-- <div class="scroller_three_holder"> <div class="storeSectionText extra_style" style="padding-top:24px;padding-bottom:15px;">Poll</div> <div class="scrollerHolder2"> <div class="storeViewIcon"></div> <div class="scrollerContents2"> <div class="button-block-left" id="scrollLeftButton4"></div> <div id="sliderParentDiv_4" class="sliderParentDiv2"> <div class="slider2" id="slider4"> <div class="store-list2"> <div class="rightPanelImageHolderBottom2"> <div class="rightPanelScrollerFourHeading"> <div class="storeJeansText sunglassTextStyle">Which Sunglass is best? </div> <div class="pollIcon"></div> </div> <div class="sunglassImagesContainer"> <div class="firstSunglassImageDiv"> <div class="firstSunGlassImage"><a href="javascript:void(0);"><img src="<?php echo $base_url; ?>assets/images/poll_image1.png" /></a></div> <div class="homepodgeText">Hodgepodge T-Shirt</div> <div class="rupee_quantity_text"><span class="rupee">`</span> 1099, <span class="rockwellSpan">Quantity</span> 1</div> <div class="fromItalicStyle">from <span class="spanFont">laroxane</div> <button type="button" id="vote" name="vote" class="voteButton">Vote</button> </div> <div class="firstSunglassImageDiv"> <div class="firstSunGlassImage"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/poll_image2.png" /></a></div> <div class="homepodgeText">Hodgepodge T-Shirt</div> <div class="rupee_quantity_text"><span class="rupee">`</span> 1099, <span class="rockwellSpan">Quantity</span> 1</div> <div class="fromItalicStyle">from <span class="spanFont">laroxane</div> <button type="button" id="vote2" name="vote" class="voteButton">Vote</button> </div> <div class="firstSunglassImageDiv marginRight0"> <div class="firstSunGlassImage"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/poll_image3.png" /></a></div> <div class="homepodgeText">Hodgepodge T-Shirt</div> <div class="rupee_quantity_text"><span class="rupee">`</span> 1099, <span class="rockwellSpan">Quantity</span> 1</div> <div class="fromItalicStyle">from <span class="spanFont">laroxane</div> <button type="button" id="vote3" name="vote" class="voteButton">Vote</button> </div> </div> </div> </div> <div class="store-list2"> <div class="rightPanelImageHolderBottom2"> <div class="rightPanelScrollerFourHeading"> <div class="storeJeansText sunglassTextStyle">Which Sunglass is best? </div> <div class="pollIcon"></div> </div> <div class="sunglassImagesContainer"> <div class="firstSunglassImageDiv"> <div class="firstSunGlassImage"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/poll_image1.png" /></a></div> <div class="homepodgeText">Hodgepodg Sunglass</div> <div class="rupee_quantity_text"><span class="rupee">`</span> 1099, <span class="rockwellSpan">Quantity</span> 1</div> <div class="fromItalicStyle">from <span class="spanFont">laroxane</span></div> <button type="button" id="vote4" name="vote" class="voteButton">Vote</button> </div> <div class="firstSunglassImageDiv"> <div class="firstSunGlassImage"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/poll_image2.png" /></a></div> <div class="homepodgeText">Hodgepodg Sunglass</div> <div class="rupee_quantity_text"><span class="rupee">`</span> 1099, <span class="rockwellSpan">Quantity</span> 1</div> <div class="fromItalicStyle">from <span class="spanFont">laroxane</span></div> <button type="button" id="vote5" name="vote" class="voteButton">Vote</button> </div> <div class="firstSunglassImageDiv marginRight0"> <div class="firstSunGlassImage"><a href="javascript:void(0)"><img src="<?php echo $base_url; ?>assets/images/poll_image3.png" /></a></div> <div class="homepodgeText">Hodgepodg Sunglass</div> <div class="rupee_quantity_text"><span class="rupee">`</span> 1099, <span class="rockwellSpan">Quantity</span> 1</div> <div class="fromItalicStyle">from <span class="spanFont">laroxane</span></div> <button type="button" id="vote6" name="vote" class="voteButton">Vote</button> </div> </div> </div> </div> </div> </div> <div class="button-block-right" id="scrollRightButton4"></div> </div> </div> </div>-->
				<div class="rightPanelRightScroller">
					<div class="verticalSeparator fl" style="height:362px;"></div>
					<div class="rightPanelImageContent">
						<div class="rightPanelFriendsTextHolder">
							<div class="storeSectionText2">People who fancied</div>
							<div class="hurrayOfferText hurrayOfferTextNew"><span
									class="numberBold"><?php echo count($store_fancy); ?></span> People who
								fancied <?php echo $mystore[0]->store_name; ?></div>
						</div>
						<div class="rightPanelViewIcon"></div>
						<div
							class="rightPanelSmallImages"> <?php if (count($store_fancy) > 12) $n = 12; else $n = count($store_fancy); for ($i = 0; $i < $n; $i++): ?> <?php if ($i % 3 == 2) $class = "rightPanelSmallImagesDiv rightPanelImage3"; else $class = "rightPanelSmallImagesDiv"; ?>
								<div
									class="<?php echo $class; ?>"> <?php $filename = 'assets/images/users/' . $store_fancy[$i]->user_id . '/' . $store_fancy[$i]->user_id . '_156x156.jpg'; if (file_exists($filename)): ?>
										<a href="<?php echo $base_url; ?>user_info/view/<?php echo $store_fancy[$i]->user_id; ?>">
											<img
												src=<?php echo $base_url; ?>assets/images/users/<?php echo $store_fancy[$i]->user_id . '/' . $store_fancy[$i]->user_id . '_156x156.jpg'; ?> width="62"
											height="62" /> </a> <?php else: ?> <a
										href="<?php echo $base_url; ?>user_info/view/<?php echo $store_fancy[$i]->user_id; ?>">
										<img src="<?php echo $base_url; ?>assets/images/default/defbig.jpg" width="62"
										     height="62"/> </a> <?php endif; ?> </div> <?php endfor; ?> </div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>

<?php include "fancy_unfancy_categories.php" ?> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/landing_page.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/store_page.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/homepage.js"></script>
<script type="text/javascript">
function AddPoll(pid) {
	$.ajax({
		url: "<?php echo $base_url; ?>ajax_poll/add_to_poll/" + pid,
		success: function (data) {
		}

	});

	$('#poll_' + pid).html('<div class="hoverPoll" style="background-image: url(<?php echo $base_url;?>assets/images/polled.png);"></div><div class="hoverText">POLLED</div>');

	$("#fancyPopup").dialog({
		width: 605,
		height: 293,
		modal: true,
	});
	$(".width_style_fancy").click(function () {
		$("#fancyPopup").dialog('close');
	});
}

$(function () {

	$("#tab").tabs();

	$("#tabs_store_page").tabs();

	$("#tabs_store_page_store_section").tabs();

	$(".radio1").dgStyle();

	$("#category_0").hide();
	$("#hidden_0").show();

	$("#feedback_popup,#feedbackPopupStore").click(function () {
		$("#feedbackPopup").dialog({
			width: 595,
			height: 410,
			modal: true
		});
	});
	$("#feedbackClose").click(function () {
		$("#feedbackPopup").dialog('close');
	});

	$("#product_popup1,#product_popup2,#product_popup3,#product_popup4").click(function () {
		$("#bigImagePopUP").dialog({
			autoOpen: true,
			width: 1024,
			height: 854,
			modal: true,
			open: function () {
				$('.ui-widget-overlay').bind('click', function () {
					$('#bigImagePopUP').dialog('close');
				})
			}
		});
	});

	var totalScroll = 0;

	$("#arrowLeft").click(function () {
		if (totalScroll <= 0) return;
		totalScroll = totalScroll - 1024;
		$('#bigImageContainer').animate({scrollLeft: totalScroll}, 2050);
	});

	$("#arrowRight").click(function () {
		maxScroll = parseInt($(".bigImageScroller").css("width")) - parseInt($("#bigImageContainer").width());
		if (totalScroll > maxScroll) return;
		totalScroll = totalScroll + 1024;
		$('#bigImageContainer').animate({scrollLeft: totalScroll}, 2050);
	});
	var totalScroll = 0;

	$("#scrollLeftButton").click(function () {
		if (totalScroll <= 0) return;
		totalScroll = totalScroll - 760;
		$('#sliderParentDiv_1').animate({scrollLeft: totalScroll}, 1550);
	});

	$("#scrollRightButton").click(function () {
		maxScroll = parseInt($(".slider").css("width")) - parseInt($("#sliderParentDiv_1").width());
		if (totalScroll > maxScroll) return;
		totalScroll = totalScroll + 760;
		$('#sliderParentDiv_1').animate({scrollLeft: totalScroll}, 1550);
		var x =<?php echo ceil(count($products)/3); ?>;
		var totalWidth = x * 760;
		$("#slider").css("width", totalWidth + "px");
	});

	var totalScroll2 = 0;

	$("#scrollLeftButton2").click(function () {
		if (totalScroll2 <= 0) return;
		totalScroll2 = totalScroll2 - 760;
		$('#sliderParentDiv_2').animate({scrollLeft: totalScroll2}, 1550);
	});

	$("#scrollRightButton2").click(function () {
		maxScroll = parseInt($(".slider").css("width")) - parseInt($("#sliderParentDiv_2").width());
		if (totalScroll2 > maxScroll) return;
		totalScroll2 = totalScroll2 + 760;
		$('#sliderParentDiv_2').animate({scrollLeft: totalScroll2}, 1550);
		var x2 =<?php echo ceil(count($products)/3); ?>;
		var totalWidth2 = x2 * 760;
		$("#slider2").css("width", totalWidth2 + "px");
	});

	var totalScroll6 = 0;

	$("#scrollLeftButton6").click(function () {
		if (totalScroll6 <= 0) return;
		totalScroll6 = totalScroll6 - 1025;
		$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
	});

	$("#scrollRightButton6").click(function () {
		maxScroll = parseInt($(".slider4").css("width")) - parseInt($("#sliderParentDiv_6").width());
		if (totalScroll6 > maxScroll) return;
		totalScroll6 = totalScroll6 + 1025;
		$('#sliderParentDiv_6').animate({scrollLeft: totalScroll6}, 2050);
		var x3 =<?php echo ceil(count($products)/4); ?>;
		var totalWidth3 = x3 * 1025;
		$("#slider6").css("width", totalWidth3 + "px");
	});

	var totalScroll9 = 0;

	$("#scrollLeftButton9").click(function () {
		if (totalScroll9 <= 0) return;
		totalScroll9 = totalScroll9 - 1025;
		$('#sliderParentDiv_9').animate({scrollLeft: totalScroll9}, 2050);
	});

	$("#scrollRightButton9").click(function () {
		maxScroll = parseInt($(".slider4").css("width")) - parseInt($("#sliderParentDiv_9").width());
		if (totalScroll9 > maxScroll) return;
		totalScroll9 = totalScroll9 + 1025;
		$('#sliderParentDiv_9').animate({scrollLeft: totalScroll9}, 2050);
		var x4 =<?php echo ceil(count($products)/4); ?>;
		var totalWidth4 = x4 * 1025;
		$("#slider9").css("width", totalWidth4 + "px");
	});

	var totalScroll10 = 0;

	$("#scrollLeftButton10").click(function () {
		if (totalScroll10 <= 0) return;
		totalScroll10 = totalScroll10 - 1025;
		$('#sliderParentDiv_10').animate({scrollLeft: totalScroll10}, 2050);
	});

	$("#scrollRightButton10").click(function () {
		maxScroll = parseInt($(".slider4").css("width")) - parseInt($("#sliderParentDiv_10").width());
		if (totalScroll10 > maxScroll) return;
		totalScroll10 = totalScroll10 + 1025;
		$('#sliderParentDiv_10').animate({scrollLeft: totalScroll10}, 2050);
		var x5 =<?php echo ceil(count($products)/4); ?>;
		var totalWidth5 = x5 * 1025;
		$("#slider10").css("width", totalWidth5 + "px");
	});
	//TOOLTIP
	$(".pro_name").each(function () {

		var len = 24;
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
	$(".stor_nm").each(function () {

		var len = 20;
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
	$(".storeLeahText").each(function () {

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
});

function select_category(store_section, x) {
	var t = x + 1;
	window.location.href = store_section + "?type=" + t;
}
</script>
<!--store fancy unfancy-->
<script type="text/javascript">
	function fancy_store_changed() {
		document.im2.src = "<?php echo $base_url; ?>assets/images/fancy_click.png";

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'ajax/fancy_store?store_id=<?php echo $mystore[0]->store_id; ?>',
			success: function (data) {
				$('#fan').html(data);
				$('#im1').html('FANCIED');
				window.location.reload();

			}
		});
	}
	function unfancy_store() {
//document.imuf.src="
		<?php echo $base_url; ?>assets/images/fancy_normal.png";

		$.ajax({
			url: "<?php echo $base_url; ?>" + 'ajax/unfancy_store?store_id=<?php echo $mystore[0]->store_id; ?>',
			success: function (data) {
				$('#fan').html(data);
				$('#imuf').html('FANCY IT');
				window.location.reload();

			}
		});
	}
</script>
<script>
	$(".fancyHolder1").each(function () {

		var r = $(this).children(".hiddenFieldDiv1").val();
		var store_id = $(this).children(".hiddenFieldStoreid").val();
		var product_id = $(this).children(".hiddenFieldProductid").val();
		$(this).click(function () {
			if ($(this).children(".hoverText").html() == 'FANCY') {
				$("#FancyPopupContainer").dialog({
					width: 735,
					height: 510,
					modal: true
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'ajax/fancy_product_fetchpop1?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);
						document["f_img"].src = '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg';
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
					width: 731,
					height: 506,
					modal: true,
				});
				$.ajax({
					url: "<?php echo $base_url; ?>" + 'ajax/fancy_product_fetchpop2?store_id=' + store_id + '&product_id=' + product_id,
					success: function (data) {
						$('#sid').val(store_id);
						$('#pid').val(product_id);
						document["uf_img"].src = '<?php echo $store_url; ?>assets/images/stores/' + store_id + '/' + product_id + '/img1_product.jpg';
						$('#popup_category1').html(data);
					}
				});
				$('#checkboxesHolder2').jScrollPane({
					showArrows: false,
					animateScroll: true
				});

			}
			$("#addtolist").click(function () {
				$("#hoverText" + r).html("FANCIED");
				/* $("#hoverFancy"+r).removeClass('hoverFancy');
				 $("#hoverFancy"+r).addClass('hoverFancynext'); */
				//	var postdata=[];
				//   $('#checkbox input[name="checkbox5"]:checked').each(function() {
				//       postdata.push($(this).val()); //push each val into the array
				//    });
//$.ajax({
				//  url: "
				<?php echo $base_url; ?>"+'ajax/fancy_product_addlist?store_id='+store_id+'&product_id='+product_id+'&postdata='+postdata,
				//  success: function(data){
				//document.getElementById("fancy_hidden").value=2;
				//	$('#fan').html(data);
//	  }
//	});
				$("#FancyPopupContainer").dialog('close');
				//window.location.reload();
			});


			$("#unfancy").click(function () {
				$("#hoverText" + r).html("FANCY");
				/* $("#hoverFancy"+r).addClass('hoverFancy');
				 $("#hoverFancy"+r).removeClass('hoverFancynext');
				 $("#hoverFancy"+r).removeClass('editFancynext'); */
				//			$.ajax({
				//  url: "
				<?php echo $base_url; ?>"+'ajax/fancy_product_unfancy?store_id='+store_id+'&product_id='+product_id,
				//  success: function(data){
				// document.getElementById("fancy_hidden").value=1;
				//	$('#fan').html(data);
				// }
				//});
				$("#EditPopupContainer").dialog('close');
				//window.location.reload();

			});
		});
		$(this).hover(function () {

			if ($(this).children("#hoverText" + r).html() == 'FANCIED') {
				$(this).children("#hoverText" + r).html("EDIT");
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