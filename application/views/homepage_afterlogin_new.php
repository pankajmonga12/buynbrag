<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Home Page</title>
	<meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/assets/css/common.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/common1.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/sexy-combo.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/homepage.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/fancy_unfancy.css" />
    <link rel="stylesheet" href="/assets/css/jquery.ui.dialog.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery.jscrollpane.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/jquery.sliderTabs.min.css" />
    <!--[if IE]>
    <link type="text/css" rel="stylesheet" href="/assets/css/ie.css" />
    <![endif] -->
	<style type="text/css">
	<!--
	.grid5row { display: block; }
	.grid5rowSpacer { display: inline-block; width: 15px; height: 171px; }
	.grid5rowImageHolder { display: inline-block; width: 171px; height: 171px; padding: 1px; background-color: #fff; }
	.buttonStyleByShammi
    {
        /*background-color: #006dcc;*/
		display: inline;
		background-color: #e81c4d;
        background-image: linear-gradient(to bottom, #0088cc, 0044cc);
        background-repeat: repeat-x;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        color: #FFFFFF;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        border-image: none;
        border-radius: 4px 4px 4px 4px;
        border-style: solid;
        border-width: 1px;
        cursor: pointer;
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset, 0 1px 2px rgba(0, 0, 0, 0.05); font-size: 14px;
        line-height: 20px;
        margin-bottom: 0;
        padding: 4px 12px;
        text-align: center;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
        vertical-align: middle;
        font-family: gill;
		font-variant: small-caps;
		margin-top: -50px;
		height: 40px;
    }
	-->
	</style>
</head>
<body>
	<?php /*include_once('header2.php');*/ ?>
    <section class="wrapper">
        <article class="banner" style="background-repeat: repeat">
            <div class="bannerTop">
            	<!-- <div class="leftBanner">
                	<div class="bannerTopText">Share : Shopping will 
never be the same again!</div>
                    <div class="bannerBottomText">Discover hundreds of stores, indie designers, products, gadgets, 
gizmos, people and lots more.</div>
                </div>
                <div class="rightBanner"></div> -->
				<div id="tabsSlider">
					<ul>
						<li><a href="#tt1"></a></li>
						<li><a href="#tt2"></a></li>
						<li><a href="#tt3"></a></li>
						<li><a href="#tt4"></a></li>
					</ul>
					<div id="tt1">
						<img src="/assets/images/photos/1.jpg" width="1024" height="223" />
					</div>
					<div id="tt2">
						<img src="/assets/images/photos/2.jpg" width="1024" height="223" />
					</div>
					<div id="tt3">
						<img src="/assets/images/photos/3.jpg" width="1024" height="223" />
					</div>
					<div id="tt4">
						<img src="/assets/images/photos/4.jpg" width="1024" height="223" />
					</div>
				</div>
            </div>
        </article>
        <section class="middleBackground clear_both" style="margin-top: 160px">
        	<div class="topDotSeparator"></div>
        	<div class="middleContainer">
            <div class="SliderContent">
            		<div class="BigQuesText">Handpicked Items</div>
                    <div class="bottomSlider">
                        <div class="sliderrHolder">
                            <!-- <div class="storeViewIcon top23"></div> -->
                            <div class="scrollerContents">
                                <div class="button_block_left" id="hiPrevButton"></div>
                                <div id="sliderParentDiv_1" class="sliderParentDiv1">
    
                                    <div class="slider" id="slider3"> 
                                        <div class="store-list">
										   <div class="store-list paddingLeft0" id="hi1">
											<div class="discountContainer rightStyle" id="hi1DiscountContainer">
												<div class="numberPercent" id="hi1DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi1ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi1ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi1ProdName">...</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi1ProdStoreName">...</div>
                                                   <div class="storeFancyHolder" id="hi1ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi1ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi1ProdPrice">...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi1FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi1ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi1FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi1PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi1PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi1SoldOutLabel" style="display: none"></div>
											</div>
                                        </div>
                                        <div class="store-list">
										   <div class="store-list paddingLeft0" id="hi2">
											<div class="discountContainer rightStyle" id="hi2DiscountContainer">
												<div class="numberPercent" id="hi2DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi2ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi2ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi2ProdName">...</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi2ProdStoreName">...</div>
                                                   <div class="storeFancyHolder" id="hi2ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi2ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi2ProdPrice"><span class="rupee">`</span> ...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi2FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi2ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi2FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi2PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi2PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi2SoldOutLabel" style="display: none"></div>
											</div>
                                        </div>
                                        <div class="store-list">
										   <div class="store-list paddingLeft0" id="hi3">
											<div class="discountContainer rightStyle" id="hi3DiscountContainer">
												<div class="numberPercent" id="hi3DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi3ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi3ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi3ProdName">Loading..</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi3ProdStoreName">Loading...</div>
                                                   <div class="storeFancyHolder" id="hi3ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi3ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi3ProdPrice"><span class="rupee">`</span> Loading...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi3FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi3ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi3FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi3PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi3PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi3SoldOutLabel" style="display: none"></div>
											</div>  
                                        </div>
                                        <div class="store-list">
										   <div class="store-list paddingLeft0" id="hi4">
											<div class="discountContainer rightStyle" id="hi4DiscountContainer">
												<div class="numberPercent" id="hi4DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi4ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi4ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi4ProdName">...</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi4ProdStoreName">...</div>
                                                   <div class="storeFancyHolder" id="hi4ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi4ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi4ProdPrice"><span class="rupee">`</span> ...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi4FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi4ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi4FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi4PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi4PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi4SoldOutLabel" style="display: none"></div>
											</div>
                                        </div>
                                    </div>
									<div style="width: 1024px; height: 6px"></div>
									<div class="slider" id="slider13">
									<div class="store-list">
										   <div class="store-list paddingLeft0" id="hi5">
											<div class="discountContainer rightStyle" id="hi5DiscountContainer">
												<div class="numberPercent" id="hi5DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi5ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi5ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi5ProdName">...</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi5ProdStoreName">...</div>
                                                   <div class="storeFancyHolder" id="hi2ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi5ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi5ProdPrice"><span class="rupee">`</span> ...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi5FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi5ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi5FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi5PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi2PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi5SoldOutLabel" style="display: none"></div>
											</div>
                                        </div>
										<div class="store-list">
										   <div class="store-list paddingLeft0" id="hi6">
											<div class="discountContainer rightStyle" id="hi6DiscountContainer">
												<div class="numberPercent" id="hi6DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi6ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi6ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi6ProdName">...</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi6ProdStoreName">...</div>
                                                   <div class="storeFancyHolder" id="hi6ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi6ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi6ProdPrice"><span class="rupee">`</span> ...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi6FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi6ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi6FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi6PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi6PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi6SoldOutLabel" style="display: none"></div>
											</div>
                                        </div>
                                        <div class="store-list">
										   <div class="store-list paddingLeft0" id="hi7">
											<div class="discountContainer rightStyle" id="hi7DiscountContainer">
												<div class="numberPercent" id="hi7DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi7ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi7ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi7ProdName">...</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi7ProdStoreName">...</div>
                                                   <div class="storeFancyHolder" id="hi7ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi7ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi7ProdPrice"><span class="rupee">`</span> ...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi7FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi7ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi7FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi7PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi7PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi7SoldOutLabel" style="display: none"></div>
											</div>
                                        </div>
                                        <div class="store-list">
										   <div class="store-list paddingLeft0" id="hi8">
											<div class="discountContainer rightStyle" id="hi8DiscountContainer">
												<div class="numberPercent" id="hi8DiscountPercent">...</div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                            <a href="javascript:void(0)" id="hi8ProdPageLink"><div class="rightPanelImageHolder1">
                                               <img src="/assets/images/crown-loading.gif" id="hi8ProdImage" alt="Loading Product Image..."/>
                                               <div class="storeDecoratingText pro_name" id="hi8ProdName">...</div>
                                               <div class="fl">
                                                   <div class="storeDecoratingText stor_nm font12" id="hi8ProdStoreName">...</div>
                                                   <div class="storeFancyHolder" id="hi8ProdFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price" id="hi8ProdFancyCount"></div>
                                                        <div class="fancyText storeExtraStyle"></div>
                                                    </div>
                                                </div>    
                                                <div class="priceHolder" id="hi8ProdPrice"><span class="rupee">`</span> ...</div>
                                            </div> </a>
                                            <div class="hoverHolder" id="hi8FancyHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="0" class="hiddenFieldDiv1" id="hi8ProdID"/>
                                                    <div class="hoverFancy" id="hoverFancy1"></div>
                                                    <div class="hoverText" id="hi8FancyText">FANCY</div>
                                                </div>
                                                <div class="PollHolder" id="hi8PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText" id="hi8PollText">POLL</div>
                                                </div>
                                            </div>
											<div class=\"soldout paddingMore\" style=\" \" id="hi8SoldOutLabel" style="display: none"></div>
											</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button_block_right" id="hiNextButton"></div>
                        	</div>
                        </div>  
                      </div>
                </div>               
                <div class="topDotSeparator2 featuredStore"></div>
                <div class="SliderContent">
            		<div class="BigQuesText">Featured Store</div>
                    <div class="bottomSlider">
                        <div class="sliderrHolder2">
                            <!-- <div class="storeViewIcon top23"></div> -->
                            <div class="scrollerContents2">
                                <div class="button_block_left" id="scrollLeftButton5"></div>
                                <div id="sliderParentDiv_5" class="sliderParentDiv2">
                                    <div class="slider2" id="slider4">
                                        <div class="store-list2 paddingLeft0">
											
                                            <div class="whiteBackground">
                                                <div class="firstColumn">
                                                    <div class="store_bg">
                                                        <a href="javascript:void(0)"><img src="images/featuredstore_banner.png" /></a>
                                                        <div class="storeTextImage">Vayacloths</div>
                                                    </div>
                                                    <div class="storeFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price">548</div>
                                                        <div class="fancyText storeExtraStyle">fancied</div>
                                                    </div>
                                                </div>
                                                <div class="SecondColumn">
                                                    <div class="storeText">Vayacloths</div>
                                                    <div class="storeDetails">"I'd like to help prove that you don't have to sacrifice 
                                                        your values and squash the people around you to 
                                                        make it in business.I'd like to help prove that you don't 
                                                        have to sacrifice" 
                                                    </div>
                                                    <div class="signatureText">by Tianna Meilinger</div>
                                                </div>
                                                <div class="ThirdColumn">
                                                    <div class="firstImageRow">
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_1.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_2.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_3.png" /></a>
                                                        </div>
                                                    </div>
                                                    <div class="firstImageRow">
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_2.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_1.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_3.png" /></a>
                                                        </div>
                                                    </div>
                                                    <div class="homFancy"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="store-list2">
                                            <div class="whiteBackground">
                                                <div class="firstColumn">
                                                    <div class="store_bg">
                                                        <a href="javascript:void(0)"><img src="images/featuredstore_banner.png" /></a>
                                                        <div class="storeTextImage">Vayacloths</div>
                                                    </div>
                                                    <div class="storeFancyHolder">
                                                        <div class="fanciedIcon"></div>
                                                        <div class="fancyNumber storeExtraStyle price">548</div>
                                                        <div class="fancyText storeExtraStyle">fancied</div>
                                                    </div>
                                                </div>
                                                <div class="SecondColumn">
                                                    <div class="storeText">Vayacloths</div>
                                                    <div class="storeDetails">"I'd like to help prove that you don't have to sacrifice 
                                                        your values and squash the people around you to 
                                                        make it in business.I'd like to help prove that you don't 
                                                        have to sacrifice" 
                                                    </div>
                                                    <div class="signatureText">by Tianna Meilinger</div>
                                                </div>
                                                <div class="ThirdColumn">
                                                    <div class="firstImageRow">
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_1.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_2.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_3.png" /></a>
                                                        </div>
                                                    </div>
                                                    <div class="firstImageRow">
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_2.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_1.png" /></a>
                                                        </div>
                                                        <div class="featureImgBg">
                                                            <a href="javascript:void(0)"><img src="images/featuredstore_3.png" /></a>
                                                        </div>
                                                    </div>
                                                    <div class="homFancy"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button_block_right" id="scrollRightButton5"></div>
                        	</div>
                        </div>  
                      </div>
                </div>
                <div class="topDotSeparator2"></div> 
                <div class="SliderContent">
            		<div class="BigQuesText">Recently Sold</div>
                    <div class="bottomSlider">
                        <div class="sliderrHolder">
                            <!-- <div class="storeViewIcon top23"></div> -->
                            <div class="scrollerContents">
                                <div class="button_block_left" id="scrollLeftButton4"></div>
                                <div id="sliderParentDiv_4" class="sliderParentDiv1">
    
                                        <div class="slider" id="slider5"> 
                                           <div class="store-list paddingLeft0">
											<div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_1.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a>
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="19" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy19"></div>
                                                    <div class="hoverText" id="hoverText19">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>    
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_2.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="20" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy20"></div>
                                                    <div class="hoverText" id="hoverText20">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_3.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a>  
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="21" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy21"></div>
                                                    <div class="hoverText" id="hoverText21">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>  
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_4.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="22" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy22"></div>
                                                    <div class="hoverText" id="hoverText22">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
    
                                                   <img src="images/your-taste_2.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div> </a>
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="23" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy23"></div>
                                                    <div class="hoverText" id="hoverText23">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_1.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="24" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy24"></div>
                                                    <div class="hoverText" id="hoverText24">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_3.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div> </a>  
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="25" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy25"></div>
                                                    <div class="hoverText" id="hoverText25">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div> 
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_4.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="26" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy26"></div>
                                                    <div class="hoverText" id="hoverText26">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                      </div>
                                </div>
                                <div class="button_block_right" id="scrollRightButton4"></div>
                        	</div>
                        </div>  
                      </div>
                </div>
                <div class="topDotSeparator2"></div>
				<div class="SliderContent">
            		<div class="BigQuesText">New Arrivals</div>
                    <div class="bottomSlider">
						<div class="button_block_left" id="scrollLeftButton2"></div>
						<div class="grid5row">
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
						</div>
						<div style="width: 1024px; height: 15px"></div>
						<div class="grid5row">
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
						</div>
						<div style="width: 1024px; height: 15px"></div>
						<div style="display: block">
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
							<div class="grid5rowSpacer"></div>
							<div class="grid5rowImageHolder">
								<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_171x171.jpg" />
							</div>
						</div>
						<div class="button_block_right" id="scrollRightButton2"></div>
					</div>
                </div>
                <div class="topDotSeparator2"></div>
				<div class="SliderContent">
            		<div class="BigQuesText">New Stores</div>
                    <div class="bottomSlider">
						<div class="button_block_left" id="scrollLeftButton2"></div>
						<div style="display: block; width: 1024px">
							<div style="display: inline-block; width: 36px"></div>
							<div style="display: inline-block; width: 418px; padding: 3px; background: rgb(255,255,247) url(/assets/images/top_banner_background.png)">
								<div style="display: block">
									<div style="display: inline-block; width: 257px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/top_banner.png" />
									</div>
									<div style="display: inline-block; width: 15px"><!-- Fancy icon to come here in future --></div>
									<div style="display: inline-block"><input type="BUTTON" class="buttonStyleByShammi" value=" Enter Store " /></div>
								</div>
								<div style="display: block; height: 73px">
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
								</div>
							</div>
							<div style="display: inline-block; width: 37px"></div>
							<div style="display: inline-block; width: 418px; padding: 3px; background: rgb(255,255,247) url(/assets/images/top_banner_background.png)">
								<div style="display: block">
									<div style="display: inline-block; width: 257px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/top_banner.png" />
									</div>
									<div style="display: inline-block; width: 15px"><!-- Fancy icon to come here in future --></div>
									<div style="display: inline-block"><input type="BUTTON" class="buttonStyleByShammi" value=" Enter Store " /></div>
								</div>
								<div style="display: block; height: 73px">
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
								</div>
							</div>
							<div style="display: inline-block; width: 37px"></div>
						</div>
						<div style="display: block; width: 1024px">
							<div style="display: inline-block; width: 36px"></div>
							<div style="display: inline-block; width: 418px; padding: 3px; background: rgb(255,255,247) url(/assets/images/top_banner_background.png)">
								<div style="display: block">
									<div style="display: inline-block; width: 257px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/top_banner.png" />
									</div>
									<div style="display: inline-block; width: 15px"><!-- Fancy icon to come here in future --></div>
									<div style="display: inline-block"><input type="BUTTON" class="buttonStyleByShammi" value=" Enter Store " /></div>
								</div>
								<div style="display: block; height: 73px">
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
								</div>
							</div>
							<div style="display: inline-block; width: 37px"></div>
							<div style="display: inline-block; width: 418px; padding: 3px; background: rgb(255,255,247) url(/assets/images/top_banner_background.png)">
								<div style="display: block">
									<div style="display: inline-block; width: 257px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/top_banner.png" />
									</div>
									<div style="display: inline-block; width: 15px"><!-- Fancy icon to come here in future --></div>
									<div style="display: inline-block"><input type="BUTTON" class="buttonStyleByShammi" value=" Enter Store " /></div>
								</div>
								<div style="display: block; height: 73px">
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
									<div style="display: inline-block; width: 73px">
										<img src="http://buynbragstores.s3.amazonaws.com/assets/images/stores/171/3791/img1_73x73.jpg" />
									</div>
									<div style="display: inline-block; width: 7px"></div>
								</div>
							</div>
							<div style="display: inline-block; width: 37px"></div>
						</div>
						<div class="button_block_right" id="scrollRightButton2"></div>
					</div>
                </div>
				<div class="topDotSeparator2"></div>
                <div class="SliderContent">
            		<div class="BigQuesText">Recently Fancied Items</div>
                    <div class="bottomSlider">
                        <div class="sliderrHolder">
                            <!-- <div class="storeViewIcon top23"></div> -->
                            <div class="scrollerContents">
                                <div class="button_block_left" id="scrollLeftButton4"></div>
                                <div id="sliderParentDiv_4" class="sliderParentDiv1">
    
                                        <div class="slider" id="slider5"> 
                                           <div class="store-list paddingLeft0">
											<div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_1.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a>
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="19" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy19"></div>
                                                    <div class="hoverText" id="hoverText19">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>    
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_2.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="20" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy20"></div>
                                                    <div class="hoverText" id="hoverText20">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_3.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a>  
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="21" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy21"></div>
                                                    <div class="hoverText" id="hoverText21">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>  
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_4.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="22" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy22"></div>
                                                    <div class="hoverText" id="hoverText22">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
    
                                                   <img src="images/your-taste_2.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div> </a>
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="23" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy23"></div>
                                                    <div class="hoverText" id="hoverText23">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_1.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="24" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy24"></div>
                                                    <div class="hoverText" id="hoverText24">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_3.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div> </a>  
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="25" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy25"></div>
                                                    <div class="hoverText" id="hoverText25">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div> 
                                           </div>
                                           <div class="store-list">
										   <div class="discountContainer rightStyle">
												<div class="numberPercent">25 </div>
												<div class="percentSign">%</div>
												<div class="offPercent clear_both">OFF</div>
											</div>
                                               <a href="javascript:void(0)"><div class="rightPanelImageHolder1">
                                                   <img src="images/your-taste_4.png" />
                                               <div class="storeDecoratingText pro_name">Decorating vases</div>
                                                   <div class="fl">
                                                       <div class="storeDecoratingText stor_nm font12">Copplestore</div>
                                                       <div class="storeFancyHolder">
                                                            <div class="fanciedIcon"></div>
                                                            <div class="fancyNumber storeExtraStyle price">548</div>
                                                            <div class="fancyText storeExtraStyle">fancied</div>
                                                        </div>
                                                    </div>    
                                                    <div class="priceHolder"><span class="rupee">`</span> 3800</div>
                                               </div></a> 
                                               <div class="hoverHolder">
                                                <div class="fancyHolder">
                                                    <input type="hidden" value="26" class="hiddenFieldDiv1"/>
                                                    <div class="hoverFancynext" id="hoverFancy26"></div>
                                                    <div class="hoverText" id="hoverText26">FANCIED</div>
                                                </div>
                                                <div class="PollHolder">
                                                    <div class="hoverPoll"></div>
                                                    <div class="hoverText">POLL</div>
                                                </div>
                                             </div>   
                                           </div>
                                      </div>
                                </div>
                                <div class="button_block_right" id="scrollRightButton4"></div>
                        	</div>
                        </div>  
                      </div>
                </div>
             </div>
        </section>  
    </section>
    <?php /*include "fancy_unfancy.php"*/ ?>
    <?php include "footer.php" ?> 
</body>
<script type="text/javascript" src="/assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="/assets/js/jquery.jscrollpane.js"></script>
<script src="/assets/js/homepage.js"></script>
<script type="text/javascript" src="/assets/js/jquery.sliderTabs.min.js"></script>
<script type="text/javascript">
//<!--
$("#tabsSlider").sliderTabs({
  autoplay: true,
  position: 'top',
  /*transition: 'fade',*/
  defaultTab: 1,
  width: 1024,
  height: 223,
  tabSlideSpeed: 10,
  indicators: true,
  panelArrows: false,
  panelArrowsShowOnHover: false,
  tabs: false,
});
var ajaxError = function(xhr, status, error)
{
	console.log("Async Errors. Please try again later.\r\n"+status+": "+error);
	console.log("status = "+status+"\r\nerror = "+error+"\r\nxhr.readyState = "+xhr.readyState+"\r\nxhr.status = "+xhr.status);
};

var truncateText = function(textContainerID, len)
{
	var trunc = $(textContainerID).text();
	if( $(textContainerID).text().length > len )
	{
		/* Truncate the content of the P, then go back to the end of the
		   previous word to ensure that we don't truncate in the middle of
		   a word */
		$(textContainerID).attr("title",trunc);
		$(textContainerID).addClass("showtooltip2");
		trunc = trunc.substring(0, len);
		trunc = trunc.replace(/\w+$/, '');
		trunc += '..';
		$(textContainerID).html(trunc);
	}
};

var addTitle  = function(id, titleText)
{
	$(id).attr("title", titleText);
	$(id).addClass("showtooltip2");
};

var hiPrevButton = document.getElementById("hiPrevButton"); // handle for handpicked items Previous button
var hiNextButton = document.getElementById("hiNextButton"); // handle for handpicked items Next button
var hiStart = 0;
var hiEnd = 8;

// array to hold all the discount Containers
var hiDiscountContainers = new Array(document.getElementById('hi1DiscountContainer'), document.getElementById('hi2DiscountContainer'), document.getElementById('hi3DiscountContainer'), document.getElementById('hi4DiscountContainer'), document.getElementById('hi5DiscountContainer'), document.getElementById('hi6DiscountContainer'), document.getElementById('hi7DiscountContainer'), document.getElementById('hi8DiscountContainer'));

// array to hold all the discount Percentage Text for their respective containers
var hiDiscountPercents = new Array(document.getElementById('hi1DiscountPercent'), document.getElementById('hi2DiscountPercent'), document.getElementById('hi3DiscountPercent'), document.getElementById('hi4DiscountPercent'), document.getElementById('hi5DiscountPercent'), document.getElementById('hi6DiscountPercent'), document.getElementById('hi7DiscountPercent'), document.getElementById('hi8DiscountPercent'));

// array to hold all the product page links for their respective containers
var hiProdPageLinks = new Array(document.getElementById('hi1ProdPageLink'), document.getElementById('hi2ProdPageLink'), document.getElementById('hi3ProdPageLink'), document.getElementById('hi4ProdPageLink'), document.getElementById('hi5ProdPageLink'), document.getElementById('hi6ProdPageLink'), document.getElementById('hi7ProdPageLink'), document.getElementById('hi8ProdPageLink'));

// array to hold all the product images for their respective containers
var hiProdImages = new Array(document.getElementById('hi1ProdImage'), document.getElementById('hi2ProdImage'), document.getElementById('hi3ProdImage'), document.getElementById('hi4ProdImage'), document.getElementById('hi5ProdImage'), document.getElementById('hi6ProdImage'), document.getElementById('hi7ProdImage'), document.getElementById('hi8ProdImage'));

// array to hold all the product names for their respective containers
var hiProdNames = new Array(document.getElementById('hi1ProdName'), document.getElementById('hi2ProdName'), document.getElementById('hi3ProdName'), document.getElementById('hi4ProdName'), document.getElementById('hi5ProdName'), document.getElementById('hi6ProdName'), document.getElementById('hi7ProdName'), document.getElementById('hi8ProdName'));

// array to hold all the product store names for their respective containers
var hiProdStoreNames = new Array(document.getElementById('hi1ProdStoreName'), document.getElementById('hi2ProdStoreName'), document.getElementById('hi3ProdStoreName'), document.getElementById('hi4ProdStoreName'), document.getElementById('hi5ProdStoreName'), document.getElementById('hi6ProdStoreName'), document.getElementById('hi7ProdStoreName'), document.getElementById('hi8ProdStoreName'));

// array to hold all the product fancy count holders for their respective containers
var hiProdFancyHolders = new Array(document.getElementById('hi1ProdFancyHolder'), document.getElementById('hi2ProdFancyHolder'), document.getElementById('hi3ProdFancyHolder'), document.getElementById('hi4ProdFancyHolder'), document.getElementById('hi5ProdFancyHolder'), document.getElementById('hi6ProdFancyHolder'), document.getElementById('hi7ProdFancyHolder'), document.getElementById('hi8ProdFancyHolder'));

// array to hold all the product fancy count for their respective containers
var hiProdFancyCounts = new Array(document.getElementById('hi1ProdFancyCount'), document.getElementById('hi2ProdFancyCount'), document.getElementById('hi3ProdFancyCount'), document.getElementById('hi4ProdFancyCount'), document.getElementById('hi5ProdFancyCount'), document.getElementById('hi6ProdFancyCount'), document.getElementById('hi7ProdFancyCount'), document.getElementById('hi8ProdFancyCount'));

// array to hold all the product prices
var hiProdPrices = new Array(document.getElementById('hi1ProdPrice'), document.getElementById('hi2ProdPrice'), document.getElementById('hi3ProdPrice'), document.getElementById('hi4ProdPrice'), document.getElementById('hi5ProdPrice'), document.getElementById('hi6ProdPrice'), document.getElementById('hi7ProdPrice'), document.getElementById('hi8ProdPrice'));

// array to hold all the product IDs
var hiProdIDs = new Array(document.getElementById('hi1ProdID'), document.getElementById('hi2ProdID'), document.getElementById('hi3ProdID'), document.getElementById('hi4ProdID'), document.getElementById('hi5ProdID'), document.getElementById('hi6ProdID'), document.getElementById('hi7ProdID'), document.getElementById('hi8ProdID'));

// array to hold all the fancy button containers
var hiFancyHolders = new Array(document.getElementById('hi1FancyHolder'), document.getElementById('hi2FancyHolder'), document.getElementById('hi3FancyHolder'), document.getElementById('hi4FancyHolder'), document.getElementById('hi5FancyHolder'), document.getElementById('hi6FancyHolder'), document.getElementById('hi7FancyHolder'), document.getElementById('hi8FancyHolder'));

// array to hold all the fancy button text holders
var hiFancyText = new Array(document.getElementById('hi1FancyText'), document.getElementById('hi2FancyText'), document.getElementById('hi3FancyText'), document.getElementById('hi4FancyText'), document.getElementById('hi5FancyText'), document.getElementById('hi6FancyText'), document.getElementById('hi7FancyText'), document.getElementById('hi8FancyText'));

// array to hold all the poll button containers
var hiPollHolders = new Array(document.getElementById('hi1Pollholder'), document.getElementById('hi2Pollholder'), document.getElementById('hi3Pollholder'), document.getElementById('hi4Pollholder'), document.getElementById('hi5Pollholder'), document.getElementById('hi6Pollholder'), document.getElementById('hi7Pollholder'), document.getElementById('hi8Pollholder'));

// array to hold all the poll button text holders
var hiPollTexts = new Array(document.getElementById('hi1PollText'), document.getElementById('hi2PollText'), document.getElementById('hi3PollText'), document.getElementById('hi4PollText'), document.getElementById('hi5PollText'), document.getElementById('hi6PollText'), document.getElementById('hi7PollText'), document.getElementById('hi8PollText'));

// array to hold all the handpicked item containers
var hiContainers = new Array(document.getElementById('hi1'), document.getElementById('hi2'), document.getElementById('hi3'), document.getElementById('hi4'), document.getElementById('hi5'), document.getElementById('hi6'), document.getElementById('hi7'), document.getElementById('hi8'));

// array to hold all the handpicked item containers
var hiProdSoldOutLabels = new Array(document.getElementById('hi1SoldOutLabel'), document.getElementById('hi2SoldOutLabel'), document.getElementById('hi3SoldOutLabel'), document.getElementById('hi4SoldOutLabel'), document.getElementById('hi5SoldOutLabel'), document.getElementById('hi6SoldOutLabel'), document.getElementById('hi7SoldOutLabel'), document.getElementById('hi8SoldOutLabel'));

var updateHandPickedProducts =  function(result, status, xhr)
{
	var data = new String(result);
	var products = data.split('///|\\\\\\');
	//alert("data = "+data);
	//alert("products\n============================================================\n"+products);
	
	var i = 0; // the looper
	var loadingImageSrc = "/assets/images/crown-loading.gif";
	for(i = 0; i < (products.length-1); i++)
	{
		if(i == 0)
			hiStart = i;
		// start reading data for a single product
		var product = products[i].split("_|_");
		//alert("product data (for i = "+i+")\n===========\n" + product);
		var productID = product[0];
		var productStoreID = product[1];
		var productStoreName = product[2];
		var productFancyCount = product[3];
		var productIsOnDiscount = product[4];
		var productSellingPrice = product[5];
		var productDiscount = product[6];
		var productName = product[7];
		var productVisitCounter = product[8];
		var productQuantity = product[9];
		//alert("i = "+i+"\nsp = "+productSellingPrice+"\ndisc = "+productDiscount);
		// start displaying data
		if(productIsOnDiscount == 1)
		{
			hiDiscountContainers[i].style.display = 'block';
			hiDiscountPercents[i].innerHTML = Math.floor((productDiscount / productSellingPrice) * 100);
			hiProdPrices[i].innerHTML = "<div style=\"margin-top:-14px\"><span class=\"rupee\">` </span><del>"+productSellingPrice+"</del></div><div><span class=\"rupee\">`</span>"+(productSellingPrice - productDiscount)+"</div>";
		}
		else
		{
			hiDiscountContainers[i].style.display = 'none';
			hiProdPrices[i].innerHTML = "<div style=\"margin-top:8px\"><span class=\"rupee\">` </span>"+productSellingPrice+"</div>";
		}
		hiProdPageLinks[i].href = '/order/product_page/'+productStoreID+'/'+productID;
		/* the following asynchronous approach does not work for no apparent reason */
		/*var prodImage = new Image();
		prodImage.src = "<?php echo $store_url; ?>assets/images/stores/"+productStoreID+"/"+productID+"/img1_240x200.jpg";
		alert("prodImage.src = "+prodImage.src);
		/prodImage.onload = function()
		{
			prodImages[i].src = prodImage.src;
			alert("Changing product image");
		};*/
		hiProdImages[i].src = "<?php echo $store_url; ?>assets/images/stores/"+productStoreID+"/"+productID+"/img1_240x200.jpg";
		hiProdNames[i].innerHTML = productName;
		if(productName.length > 32) /* limit product name to 32 characters */
		{
			truncateText(hiProdNames[i], 32);
		}
		
		hiProdStoreNames[i].innerHTML = productStoreName;
		
		if(productStoreName.length > 27) /* limit product store name to 27 characters */
		{
			truncateText(hiProdStoreNames[i], 27);
		}
		hiProdFancyCounts[i].innerHTML = productFancyCount + " fancied";
		//prodPrices[i].innerHTML = "<span class=\"rupee\">`</span> "+productSellingPrice - ((productDiscount / productSellingPrice) * 100);
		hiProdIDs[i].value = productID;
		if(productQuantity == 0)
		{
			hiProdSoldOutLabels[i].style.display = 'block';
		}
		addTitle(hiContainers[i], productName + " from " + productStoreName);
		hiEnd = i;
	}
	//alert("hiProdIDs[7].value = "+hiProdIDs[7].value);
};

hiPrevButton.onclick = loadHandPickedProducts(hiStart);
hiNextButton.onclick = loadHandPickedProducts(hiEnd);

var loadHandPickedProducts = function(productID)
{
	var request = $.ajax(
				{
					type: "GET",
					url: "<?php echo base_url(); ?>index.php/async/handPickedItems/"+productID,
					dataType: "text",
					success: updateHandPickedProducts,
					error: ajaxError
				});
};

var loadHandPickedProductsInitial = function()
{
	var request = $.ajax(
				{
					type: "GET",
					url: "<?php echo base_url(); ?>index.php/async/handPickedItems/0",
					dataType: "text",
					success: updateHandPickedProducts,
					error: ajaxError
				});
};

$(document).ready(function()
{
	loadHandPickedProductsInitial();
	tooltip2();
});
//-->
</script>
</html>
