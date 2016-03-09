<!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Take Taste Test 1</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/take_taste_test2.css" type="text/css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<script type="text/javascript">
	$(function () {
		tooltip2();
	});
</script>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<section class="middleBackground minHeighttaste"><input type="hidden" value="0" id="hiddenFieldDiv1"/>

		<div class="tasteIconHolder">
			<div class="tasteIcon"></div>
			<div class="itemTasteText">Taste Tests</div>
			<div class="exploreText" onClick="taketaste2('<?php echo $base_url;?>')">Skip</div>
		</div>
		<div class="topDotSeparator clear_both"></div>
		<div class="testContainer">
			<div class="textLeftRight">
				<div class="picksText">Your Taste picks <span class="redNumber" id="actualNo">0</span> out of <span
						class="redNumber" id="totalNo">9</span></div>
				<div class="showMoreItems" onClick="showmoreItems()">show more items</div>
			</div>
			<div class="ImageLeftRight">
				<div class="ImageLeft">
					<div class="imageRows">
						<div class="smallImageBox" id="smallImageBox1">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon1"></div>
							</div>
						</div>
						<div class="smallImageBox" id="smallImageBox2">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon2"></div>
							</div>
						</div>
						<div class="smallImageBox marginRight0" id="smallImageBox3">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon3"></div>
							</div>
						</div>
					</div>
					<div class="imageRows">
						<div class="smallImageBox" id="smallImageBox4">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon4"></div>
							</div>
						</div>
						<div class="smallImageBox" id="smallImageBox5">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon5"></div>
							</div>
						</div>
						<div class="smallImageBox marginRight0" id="smallImageBox6">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon6"></div>
							</div>
						</div>
					</div>
					<div class="imageRows">
						<div class="smallImageBox" id="smallImageBox7">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon7"></div>
							</div>
						</div>
						<div class="smallImageBox" id="smallImageBox8">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon8"></div>
							</div>
						</div>
						<div class="smallImageBox marginRight0" id="smallImageBox9">
							<div class="closeOpacity">
								<div class="deleteIcon" id="deleteIcon9"></div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" id="hidden_base_url" value="<?php echo $base_url ?>"/>

				<div class="imageRight" id="imageRight">
					<div class="bigImageRow"> <?php $i = 0; foreach ($randomProduct as $item): $i++;
							if ($i > 4) break;
							$img = explode('.', (string)$item->image1_path);
							if ($i != 4) { ?>
								<div title=" " class="ImageBackground"><input type="hidden"
								                                              value="<?php echo $item->product_id;?>"/><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"
										width="161" height="134" alt="<?php echo $item->product_name;?>"/>
								</div> <?php } else { ?>
								<div title=" " class="ImageBackground marginRight0"><input type="hidden"
								                                                           value="<?php echo $item->product_id;?>"/><img
										src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"
										width="161" height="134" alt="<?php echo $item->product_name;?>"/>
								</div> <?php } endforeach;?> </div>
					<div class="bigImageRow"> <?php $i = 0; foreach ($randomProduct as $item): $i++;
							if ($i <= 4) continue;
							if ($i == 9) break;
							$img = explode('.', (string)$item->image1_path);
							if ($i < 8) { ?>
								<div title=" " class="ImageBackground"><input type="hidden"
								                                              value="<?php echo $item->product_id;?>"/><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"
										width="161" height="134" alt="<?php echo $item->product_name;?>"/>
								</div> <?php } else { ?>
								<div title=" " class="ImageBackground marginRight0"><input type="hidden"
								                                                           value="<?php echo $item->product_id;?>"/><img
										src="<?php echo $base_url; ?>assets/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"
										width="161" height="134" alt="<?php echo $item->product_name;?>"/>
								</div> <?php } endforeach;?> </div>
					<div class="bigImageRow"> <?php $i = 0; foreach ($randomProduct as $item): $i++;
							if ($i <= 8) continue;
							if ($i == 13) break;
							if ($i < 12) { ?>
								<div title=" " class="ImageBackground"><input type="hidden"
								                                              value="<?php echo $item->product_id;?>"/><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"
										width="161" height="134" alt="<?php echo $item->product_name;?>"/>
								</div> <?php } else { ?>
								<div title=" " class="ImageBackground marginRight0"><input type="hidden"
								                                                           value="<?php echo $item->product_id;?>"/><img
										src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_240x200.jpg"
										width="161" height="134" alt="<?php echo $item->product_name;?>"/>
								</div> <?php } endforeach;?> </div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/take_taste_test2.js"></script>
</html>