<?php for ($i = 0; $i < count($result1); $i++) : $r = $i + 1; ?>
	<div class="stableGlassContainerRelative">
		<div class="stableGlassContainerTransp" id="row_transp<?php echo $r;?>"></div>
		<div class="stableGlassContainer1" onMouseOver="return transp(<?php echo $r;?>)"
		     onMouseOut="return normal(<?php echo $r;?>)">
			<div class="stableGlassRelative">
				<div class="stableglassHolder"><a href="order_details.php?tabName=1" class="stableglassImage"><img
							src="<?php echo $result1[$i]->image1_path;?>" alt="glass Image"/></a>

					<div class="stableglassText"><a href="order_details.php?tabName=1"
					                                class="stableglassHeading"><?php echo $result1[$i]->product_name; ?></a>

						<div class="purchaseText">purchase date<span
								class="purchaseSpan"><?php echo $result2[$i]->date_of_order; ?></span></div>
						<div class="silverImage"><img src="<?php echo $result1[$i]->image2_path;?>" alt="stable"/></div>
					</div>
				</div>
				<div class="quantityRow1">
					<div class="qtyNumber paddingTOp25"><?php echo $result1[$i]->quantity; ?></div>
				</div>
				<div class="quantityRow2">
					<div class="qtyNumber"><span class="rupee">`</span> <?php echo $result1[$i]->selling_price; ?></div>
					<div class="paidImage"><img src="<?php echo $result1[$i]->status_image;?>"
					                            alt="<?php echo $result1[$i]->payment_status;?>"/></div>
				</div>
				<div class="quantityRow3">
					<div class="qtyNumber"><span class="rupee">`</span> <?php echo $result1[$i]->shipping_cost; ?></div>
				</div>
				<div class="quantityRow4">
					<div class="shippingImage">
						<div class="shippingInnerImage"></div>
						<div class="shippingTxt"><?php echo $result1[$i]->status; ?></div>
					</div>
				</div>
				<div class="quantityRow5">
					<div class="communicationImage">
						<div class="communicationNumber">3</div>
					</div>
				</div>
				<div class="pdfImage">
					<div class="pdf_icon"></div>
				</div>
				<div class="feedbackImage" id="feed<?php echo $r;?>">Feedback</div>
			</div>
		</div>
	</div> <?php endfor; ?>