<?php $value = $_REQUEST['typeID'];
if ($value == 1) { ?>
	<div class="promotionExpiresDiv">
		<div class="enterDoller">
			<div class="promotionFields"><input id="promotionExpiresDate" type="text" name="promotionExpiresDate"
			                                    placeholder="Date" style="width:100px"></div>
			<div class="promotionFields" style="padding-left:10px;float:left"><input id="promotionExpiresMonth"
			                                                                         type="text"
			                                                                         name="promotionExpiresMonth"
			                                                                         placeholder="Month"
			                                                                         style="width:100px"></div>
			<div class="promotionFields" style="padding-left:10px;float:left"><input id="promotionExpiresYear"
			                                                                         type="text"
			                                                                         name="promotionExpiresYear"
			                                                                         placeholder="Year"
			                                                                         style="width:100px"></div>
		</div>
	</div> <?php } elseif ($value == 2) { ?>
	<div class="promotionExpiresDiv">
		<div class="enterDoller">
			<div class="promotionFields"><input id="no_of_uses" type="text" name="no_of_uses"
			                                    placeholder="enter no. of uses" style="width:463px"></div>
		</div>
	</div> <?php } ?>