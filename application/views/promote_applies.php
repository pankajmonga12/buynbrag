<?php $value = $_REQUEST['typeID']; if ($value == "Single Product") { ?>
	<div class="addProductHere"><input type="hidden" name="productType" id="productType" value="single"/> <input
			type="hidden" name="hiddenFieldDiv1" id="hiddenFieldDiv1" value="1"/>

		<div id="addTextContainer" class="addText">ADD
			<div style="font-size:18px;">PRODUCT</div>
			<div style="font-size:33px;">HERE</div>
		</div>
		<div id="single_selected_img1"></div>
	</div> <?php } elseif ($value == "Multiple Products") { ?>
	<div class="addProductHere" style="width:500px">
		<div id="addTextContainer"></div>
		<div><input type="hidden" name="hiddenFieldDiv1" id="hiddenFieldDiv1" value="0"/> <input type="hidden"
		                                                                                         name="productType"
		                                                                                         id="productType"
		                                                                                         value="multiple"/>

			<div id="appliesFirstRow" style="display:inline-block;padding-top:10px">
				<div id="multiple_selected_img1" class="multipleProductSelected"></div>
				<div id="multiple_selected_img2" class="multipleProductSelected"></div>
				<div class="multipleProductSelected" id="multiple_selected_img3"></div>
				<div class="multipleProductSelected" id="multiple_selected_img4"></div>
				<div class="multipleProductSelected" id="multiple_selected_img5"></div>
			</div>
			<div id="appliesFirstRow" style="padding-top:30px;clear:both">
				<div class="multipleProductSelected" id="multiple_selected_img6"></div>
				<div class="multipleProductSelected" id="multiple_selected_img7"></div>
				<div class="multipleProductSelected" id="multiple_selected_img8"></div>
				<div class="multipleProductSelected" id="multiple_selected_img9"></div>
				<div class="multipleProductSelected" id="multiple_selected_img10"></div>
			</div>
		</div>
	</div> <?php } ?>
<script type="text/javascript" src="js/promote_discount_single_product.js"></script>