<?php $value = $_REQUEST['typeID'];
$base_url = base_url();
if ($value == 1) { ?>
	<style>
		.amPm .sbHolder {
			margin-top: 0px !important;
		}

		.amPm .sbOptions li a {
			font-family: RupeeForadian !important;
		}

		.amPm .sbSelector {
			font-family: RupeeForadian !important;
		}
	</style>
	<div class="dollerOfferMainDiv">
		<div class="enterDoller">
			<div class="promotionFields"><input id="rupeeValue" type="text" name="rupeeValue" placeholder="enter value"
			                                    style="width:477px"></div>
			<!-- <div style="float:left;padding-left:10px" class="amPm"> <select class="drop" name="dollerCurrency" style="width:50px" id="dollerCurrency"> <option value="dollar">$</option> <option value="rupee" class="rupee"><span>`</span></option> </select> </div>-->
		</div>
		<!--<div class="promotionTypeAreaSeperator"></div>--> <?php /*?><div class="scrollerContentsPromoteType"> <div class="faq_text" style="position:absolute;top:0px;font-size:14px;">Select Offer Badges</div> <div class="promoteTypeScrollArrowLeft" id="scrollLeftPromoteButton"></div> <div class="promotionTypeAreaSeperator"></div> <div id="sliderParentPromoteType" class="sliderParentPromoteType"> <div id="sliderPromoteType" class="sliderPromoteType"> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges1" checked="true" value="199"/></span><img src="<?php echo $base_url; ?>assets/images/doller_offer_badges/1.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges1" value="150"/></span><img src="<?php echo $base_url; ?>assets/images/doller_offer_badges/2.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges1" value="250"/></span><img src="<?php echo $base_url; ?>assets/images/doller_offer_badges/3.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges1" value="725"/></span><img src="<?php echo $base_url; ?>assets/images/doller_offer_badges/4.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges1" value="50"/></span><img src="<?php echo $base_url; ?>assets/images/doller_offer_badges/5.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges1" value="100"/></span><img src="<?php echo $base_url; ?>assets/images/doller_offer_badges/6.png" /></div> </div> </div> <div class="promoteTypeScrollArrowRight" id="scrollRightPromoteButton"></div> </div><?php */?>
	</div> <?php } else { ?>
	<div class="dollerOfferMainDiv">
		<div class="enterDoller">
			<div class="promotionFields"><input id="percentageOfferValue" type="text" name="percentageOfferValue"
			                                    placeholder="enter % value" style="width:477px"></div>
		</div>
		<!--<div class="promotionTypeAreaSeperator"></div>--> <?php /*?><div class="scrollerContentsPromoteType" style="widows:498px;height:162px;padding-top:37px;position:relative"> <div class="faq_text" style="position:absolute;top:0px;font-size:14px;">Select Offer Badges</div> <div class="promoteTypeScrollArrowLeft" id="scrollLeftPromoteButton"></div> <div class="promotionTypeAreaSeperator"></div> <div id="sliderParentPromoteType" class="sliderParentPromoteType"> <div id="sliderPromoteType" class="sliderPromoteType"> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges2" checked="true"/></span><img src="<?php echo $base_url; ?>assets/images/percentage_offer_badges/1.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges2"/></span><img src="<?php echo $base_url; ?>assets/images/percentage_offer_badges/2.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges2"/></span><img src="<?php echo $base_url; ?>assets/images/percentage_offer_badges/3.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges2"/></span><img src="<?php echo $base_url; ?>assets/images/percentage_offer_badges/4.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges2"/></span><img src="<?php echo $base_url; ?>assets/images/percentage_offer_badges/5.png" /></div> <div class="badgesImages1"><span class="radio1 badgesRadio"><input type="radio" name="promoteTypeBadges2"/></span><img src="<?php echo $base_url; ?>assets/images/percentage_offer_badges/6.png" /></div> </div> </div> <div class="promoteTypeScrollArrowRight" id="scrollRightPromoteButton"></div> </div><?php */?>
	</div> <?php } ?> <?php /*?><script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script> <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/promote_discount_single_product.js"></script> <script>
$(".radio1").dgStyle();
$(function(){
	var totalScroll = 0;
	
	$("#scrollLeftPromoteButton").click(function () {
		if(totalScroll<=0) return;
		totalScroll=totalScroll-498 ;
		$('#sliderParentPromoteType').animate({scrollLeft:totalScroll},840);
	});
		
	$("#scrollRightPromoteButton").click(function () {
		maxScroll = parseInt($(".sliderPromoteType").css("width")) -  parseInt($("#sliderParentPromoteType").width());
		if(totalScroll  > maxScroll) return;
		totalScroll=totalScroll+498;
		$('#sliderParentPromoteType').animate({scrollLeft:totalScroll},840);
	});
});
</script><?php */
?>