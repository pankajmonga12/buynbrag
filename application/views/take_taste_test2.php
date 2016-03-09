<?php $mydata1 = $similarPeople; $mydata2 = $similarProducts; ?> <!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Take Taste Test 2</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/take_taste_test2.css" type="text/css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body>
<section class="wrapper">
	<section class="middleBackground">
		<div class="tasteIconHolder">
			<div class="tasteIcon"></div>
			<div class="itemTasteText">items matching your taste</div>
			<div class="exploreText">Explore</div>
		</div>
		<div class="topDotSeparator clear_both"></div>
		<div class="testContainer">
			<div class="profile_picture_Holder">
				<div class="profile_picture_background"></div>
				<div class="profile_picture_contents">
					<div class="profileLeftContainer"><a href="javascript:void(0)">
							<div class="profileImage"><img
									src="<?php echo $base_url; ?>assets/images/user/<?php echo $userdetails[0]->user_id ?>_90x90.jpg"
									alt="<?php echo $userdetails[0]->full_name ?>"/></div>
						</a>

						<div class="profileTextHolder"> <?php echo $userdetails[0]->full_name ?>
							<div class="buttonsHolder"><a href="javascript:void(0)">
									<button type="button" class="bragButton">
										<div class="brag_icon"></div>
										Brag
									</button>
								</a> <a href="javascript:void(0)">
									<button type="button" class="retakeTestButton"
									        onclick="retake('<?php echo $base_url;?>')">Retake the Test
									</button>
								</a></div>
						</div>
					</div>
					<div class="profileRightContainer">
						<div class="otherPeopleText">Other People with similar taste</div>
						<div class="peopleImagesHolder"> <?php $i = 0; foreach ($mydata1 as $key => $value) {
								$i++;
								if ($i > 10) break; ?> <a href="javascript:void(0)">
									<div title="FOLLOW" class="peopleImage"><img
											src="<?php echo $base_url; ?>assets/images/user/<?php echo $key;?>_62x62.png"
											alt="<?php echo $value;?>"/></div>
								</a> <?php } ?> </div>
					</div>
				</div>
			</div>
			<div class="imageRow1"> <?php $i = 0; foreach ($mydata2 as $key => $item) {
					$i++;
					if ($i > 4) break;
					if ($i == 1) { ?>
						<div class="test_image_holder paddingLeft0">
							<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"/></a>

								<div class="fl">
									<div class="storeDecoratingText"><?php echo $item->product_name;?></div>
									<div class="storeDecoratingText font12"><?php echo $item->store_name;?></div>
									<div class="storeFancyHolder">
										<div class="fanciedIcon"></div>
										<div class="fancyNumber storeExtraStyle">548</div>
										<div class="fancyText storeExtraStyle">fancied</div>
									</div>
								</div>
								<div class="priceHolder"><span class="rupee">`</span> <?php echo $item->selling_price;?>
								</div>
							</div>
						</div> <?php } else { ?>
						<div class="test_image_holder">
							<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"/></a>

								<div class="fl">
									<div class="storeDecoratingText"><?php echo $item->product_name;?></div>
									<div class="storeDecoratingText font12"><?php echo $item->store_name;?></div>
									<div class="storeFancyHolder">
										<div class="fanciedIcon"></div>
										<div class="fancyNumber storeExtraStyle">548</div>
										<div class="fancyText storeExtraStyle">fancied</div>
									</div>
								</div>
								<div class="priceHolder"><span class="rupee">`</span> <?php echo $item->selling_price;?>
								</div>
							</div>
						</div> <?php }
				}?> </div>
			<div class="imageRow2"> <?php $i = 0; foreach ($mydata2 as $key => $item) {
					$i++;
					if ($i <= 4) continue;
					if ($i == 9) break;
					$img = explode('.', (string)$item->image1_path);
					if ($i == 5) { ?>
						<div class="test_image_holder paddingLeft0">
							<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"/></a>

								<div class="fl">
									<div class="storeDecoratingText"><?php echo $item->product_name;?></div>
									<div class="storeDecoratingText font12"><?php echo $item->store_name;?></div>
									<div class="storeFancyHolder">
										<div class="fanciedIcon"></div>
										<div class="fancyNumber storeExtraStyle">548</div>
										<div class="fancyText storeExtraStyle">fancied</div>
									</div>
								</div>
								<div class="priceHolder"><span class="rupee">`</span> <?php echo $item->selling_price;?>
								</div>
							</div>
						</div> <?php } else { ?>
						<div class="test_image_holder">
							<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"/></a>

								<div class="fl">
									<div class="storeDecoratingText"><?php echo $item->product_name;?></div>
									<div class="storeDecoratingText font12"><?php echo $item->store_name;?></div>
									<div class="storeFancyHolder">
										<div class="fanciedIcon"></div>
										<div class="fancyNumber storeExtraStyle">548</div>
										<div class="fancyText storeExtraStyle">fancied</div>
									</div>
								</div>
								<div class="priceHolder"><span class="rupee">`</span> <?php echo $item->selling_price;?>
								</div>
							</div>
						</div> <?php }
				}?> </div>
			<div class="imageRow2"> <?php $i = 0; foreach ($mydata2 as $key => $item) {
					$i++;
					if ($i <= 8) continue;
					if ($i == 13) break;
					$img = explode('.', (string)$item->image1_path);
					if ($i == 9) { ?>
						<div class="test_image_holder paddingLeft0">
							<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"/></a>

								<div class="fl">
									<div class="storeDecoratingText"><?php echo $item->product_name;?></div>
									<div class="storeDecoratingText font12"><?php echo $item->store_name;?></div>
									<div class="storeFancyHolder">
										<div class="fanciedIcon"></div>
										<div class="fancyNumber storeExtraStyle">548</div>
										<div class="fancyText storeExtraStyle">fancied</div>
									</div>
								</div>
								<div class="priceHolder"><span class="rupee">`</span> <?php echo $item->selling_price;?>
								</div>
							</div>
						</div> <?php } else { ?>
						<div class="test_image_holder">
							<div class="rightPanelImageHolder1"><a href="javascript:void(0)"><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"/></a>

								<div class="fl">
									<div class="storeDecoratingText"><?php echo $item->product_name;?></div>
									<div class="storeDecoratingText font12"><?php echo $item->store_name;?></div>
									<div class="storeFancyHolder">
										<div class="fanciedIcon"></div>
										<div class="fancyNumber storeExtraStyle">548</div>
										<div class="fancyText storeExtraStyle">fancied</div>
									</div>
								</div>
								<div class="priceHolder"><span class="rupee">`</span> <?php echo $item->selling_price;?>
								</div>
							</div>
						</div> <?php }
				}?> </div>
			<div id="more_1" class="slideBackground clear_both">
				<div class="slideNormal"></div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/take_taste_test2.js"></script>
</html>