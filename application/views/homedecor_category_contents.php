<script type="text/javascript">
	var totalScroll = 0;

	$(".button_left_style").click(function () {
		if (totalScroll <= 0) return;
		totalScroll = totalScroll - 760;
		$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
	});

	$(".button_right_style").click(function () {
		maxScroll = parseInt($(".slider").css("width")) - parseInt($(".sliderParentDiv").width());
		if (totalScroll > maxScroll) return;
		totalScroll = totalScroll + 760;
		$('.sliderParentDiv').animate({scrollLeft: totalScroll}, 1550);
	});

	var totalScroll2 = 0;

	$(".button_left_style2").click(function () {
		if (totalScroll2 <= 0) return;
		totalScroll2 = totalScroll2 - 768;
		$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
	});

	$(".button_right_style2").click(function () {
		maxScroll = parseInt($(".slider").css("width")) - parseInt($(".sliderParentDiv2").width());
		if (totalScroll2 > maxScroll) return;
		totalScroll2 = totalScroll2 + 768;
		$('.sliderParentDiv2').animate({scrollLeft: totalScroll2}, 1550);
	});

	var totalScroll3 = 0;

	$(".button_left_style3").click(function () {
		if (totalScroll3 <= 0) return;
		totalScroll3 = totalScroll3 - 768;
		$('.sliderParentDiv3').animate({scrollLeft: totalScroll3}, 1550);
	});

	$(".button_right_style3").click(function () {
		maxScroll = parseInt($(".slider").css("width")) - parseInt($(".sliderParentDiv3").width());
		if (totalScroll3 > maxScroll) return;
		totalScroll3 = totalScroll3 + 768;
		$('.sliderParentDiv3').animate({scrollLeft: totalScroll3}, 1550);
	});
</script> <?php $type = $_REQUEST['typeID']; if ($type == 1) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 2) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 3) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big4.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image4.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small4.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium4.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 4) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 5) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 6) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 7) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big4.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image4.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small4.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium4.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 8) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 9) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big4.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image4.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small4.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium4.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 10) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 11) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 12) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } else if ($type == 13) { ?>
	<div class="trendingNewText">Trending Now</div>
	<div class="scrollerHolder">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents">
			<div class="button-block-left button_left_style"></div>
			<div class="sliderParentDiv">
				<div class="slider">
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list paddingLeft0">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller1.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
					<div class="store-list">
						<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
									src="images/image_scroller2.png"/></a>

							<div class="fl">
								<div class="storeDecoratingText">Decorating vases</div>
								<div class="storeDecoratingText font12">Copplestore</div>
								<div class="storeFancyHolder">
									<div class="fanciedIcon"></div>
									<div class="fancyNumber storeExtraStyle">548</div>
									<div class="fancyText storeExtraStyle">fancied</div>
								</div>
							</div>
							<div class="priceHolder"><span class="rupee">`</span> 3800</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button-block-right button_right_style"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Top Stores</div>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style2"></div>
			<div class="sliderParentDiv2">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big5.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image5.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small5.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium5.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big1.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image1.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small1.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium1.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style2"></div>
		</div>
	</div>
	<div class="topScrollerSeparator clear_both"></div>
	<div class="trendingNewText topStoresStyle">Editor’s Faves</div> <a href="javascript:void(0)">
		<div class="storesText">Stores</div>
	</a>
	<div class="newVerticalSeparator"></div> <a href="javascript:void(0)">
		<div class="pannelProductText">Products</div>
	</a>
	<div class="scrollerHolder2 clear_both">
		<div class="storeViewIcon icon_new_style"></div>
		<div class="scrollerContents2">
			<div class="button-block-left button_left_style3"></div>
			<div class="sliderParentDiv3">
				<div class="slider2">
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2 paddingLeft0"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big2.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image2.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small2.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium2.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
					<div class="store-list2"><a href="javascript:void(0)">
							<div class="images_holder"><img src="images/image_big3.png" alt="big image"/>

								<div class="banner_Image"><img src="images/banner_image3.png" alt="Banner Image"/></div>
								<div class="smallImage"><img src="images/image_small3.png" alt="small image"/></div>
								<div class="mediumImage"><img src="images/image_medium3.png" alt="medium image"/></div>
								<div class="fancyBragedHolder">
									<div class="fancy_Icon"></div>
									<div class="fancy_number">548</div>
									<div class="fancy_name">Fancied</div>
									<div class="brag_Icon clear_both"></div>
									<div class="fancy_number">145</div>
									<div class="fancy_name">Braged</div>
								</div>
								<div class="product_number"> 1245
									<div class="braged_name">Products</div>
								</div>
							</div>
						</a></div>
				</div>
			</div>
			<div class="button-block-right button_right_style3"></div>
		</div>
	</div> <?php } ?>