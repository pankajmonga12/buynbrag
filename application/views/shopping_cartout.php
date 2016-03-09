<!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Shopping Cart</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shopping_cart.css" type="text/css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="<?php echo $base_url; ?>assets/css/ie.css"/> <![endif] --> </head>
<body> <?php include_once('header2.php'); ?>
<section class="wrapper">
	<section class="middleBackground">
		<div class="shoppingCartIconHolder">
			<div class="shoppingCartIcon"></div>
			<div class="shoppingCartText">SHOPPING CART</div>
		</div>
		<div class="topDotSeparator"></div>
		<div class="shoppingContentsContainer"> <?php for ($i = 0; $i < count($mycart); $i++): //$i=0; ?>
				<div class="titleBackground extraPadding">
					<div class="addProductsBackgroundTransparent"></div>
					<div class="titleBackgroundHolder">
						<div class="productsTextHolder">
							<div class="productsHeading">Products from</div>
							<div class="bannerImage"><img
									src="<?php echo $base_url; ?>assets/stores/<?php echo $mycart[$i]->store_id; ?>/banner/top_banner.png"
									alt="banner"/></div>
						</div>
						<div class="categoryHolder">
							<div class="quantityHeading">Quantity</div>
						</div>
						<div class="categoryHolder1">
							<div class="quantityHeading">MRP</div>
						</div>
						<div class="categoryHolder2">
							<div class="quantityHeading">Our Price</div>
						</div>
						<div class="categoryHolder3">
							<div class="quantityHeading">Total</div>
						</div>
						<div class="categoryHolder4"></div>
					</div>
				</div> <!--WORK FROM HERE-->
				<div class="stableGlassContainerHolder">
					<div class="stableGlassContainerMain">
						<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
						<div class="stableGlassContainr" onMouseOver="return transp(<?php echo $i + 1; ?>)"
						     onMouseOut="return normal(<?php echo $i + 1; ?>)">
							<div class="stableGlassRelative">
								<div class="stableglassHolderProducts">
									<div class="stableImage"><img
											src="<?php echo $base_url; ?>assets/stores/<?php echo $mycart[$i]->store_id; ?>/products/<?php echo $mycart[$i]->product_id; ?>.jpg"/>
									</div>
									<div class="stableTextCheckbox"><?php echo $mycart[$i]->product_name; ?>
										<div class="checkboxHolder">
											<div class="checkbox"><input type="checkbox" name="check1"/></div>
											<div class="showPictureText">Show this purchase in my activities</div>
										</div>
									</div>
								</div>
								<div class="categoriesColumn"> <?php echo $mycart[$i]->cart_quantity; ?> </div>
								<div class="priceColumn">
									<div class="priceAmount"><span
											class="rupee">`</span><?php echo $mycart[$i]->selling_price; ?></div>
								</div>
								<div class="quantityColumn">
									<div class="priceAmount"><span
											class="rupee">`</span><?php echo $mycart[$i]->selling_price - $mycart[$i]->discount; ?>
									</div>
								</div>
								<div class="statusColumn">
									<div class="priceAmount"><span
											class="rupee">`</span><?php echo ($mycart[$i]->selling_price - $mycart[$i]->discount) * $mycart[$i]->cart_quantity; ?>
									</div>
								</div>
								<div class="actionColumn">
									<div class="actionClose"></div>
									<div class="shoppingIcon"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="shoppingCostMain">
					<div class="shoppingCostBackground"></div>
					<div class="shoppingCostContent">
						<div class="costAmount"><span class="rupee">`</span><?php echo $mycart[$i]->shipping_cost; ?>
						</div>
						<div class="shopText">Shipping Cost</div>
					</div>
				</div>
				<div class="savingTotal">
					<div class="saving_text">Saving</div>
					<div class="rupeeAmount rupeeExtra"><span class="rupee">`</span><?php echo $mycart[$i]->discount; ?>
					</div>
					<div class="rupeeAmount"><span
							class="rupee">`</span><?php echo (($mycart[$i]->selling_price - $mycart[$i]->discount) * $mycart[$i]->cart_quantity) + $mycart[$i]->shipping_cost; ?>
					</div>
					<div class="totalStyle">Total</div>
				</div> <?php endfor; ?> <!--WORK END HERE-->
			<div class="titleBackground extraPadding">
				<div class="addProductsBackgroundTransparent"></div>
				<div class="titleBackgroundHolder">
					<div class="productsTextHolder">
						<div class="productsHeading">Products from</div>
						<div class="bannerImage2"><img src="<?php echo $base_url; ?>assets/images/banner_2.png"
						                               alt="banner"/></div>
					</div>
					<div class="categoryHolder">
						<div class="quantityHeading">Quantity</div>
					</div>
					<div class="categoryHolder1">
						<div class="quantityHeading">MRP</div>
					</div>
					<div class="categoryHolder2">
						<div class="quantityHeading">Our Price</div>
					</div>
					<div class="categoryHolder3">
						<div class="quantityHeading">Total</div>
					</div>
					<div class="categoryHolder4"></div>
				</div>
			</div>
			<div class="stableGlassContainerHolder">
				<div class="stableGlassContainerMain">
					<div class="stableGlassContainerTransp" id="row_transp3"></div>
					<div class="stableGlassContainr" onMouseOver="return transp(3)" onMouseOut="return normal(3)">
						<div class="stableGlassRelative">
							<div class="stableglassHolderProducts">
								<div class="stableImage"><img src="<?php echo $base_url; ?>assets/images/image_02.png"
								                              alt="image 1"/></div>
								<div class="stableTextCheckbox">Guitarglass
									<div class="checkboxHolder">
										<div class="checkbox"><input type="checkbox" name="check1"/></div>
										<div class="showPictureText">Show this purchase in my activities</div>
									</div>
								</div>
							</div>
							<div class="categoriesColumn"><input id="qEdit" type="text" name="qEdit" placeholder="2">
							</div>
							<div class="priceColumn">
								<div class="priceAmount"><span class="rupee">`</span> 899.00</div>
							</div>
							<div class="quantityColumn">
								<div class="priceAmount"><span class="rupee">`</span> 799.00</div>
							</div>
							<div class="statusColumn">
								<div class="priceAmount"><span class="rupee">`</span> 1598.00</div>
							</div>
							<div class="actionColumn">
								<div class="actionClose"></div>
								<div class="shoppingIcon"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="stableGlassContainerMain">
					<div class="stableGlassContainerTransp" id="row_transp4"></div>
					<div class="stableGlassContainr" onMouseOver="return transp(4)" onMouseOut="return normal(4)">
						<div class="stableGlassRelative">
							<div class="stableglassHolderProducts">
								<div class="stableImage"><img src="<?php echo $base_url; ?>assets/images/image_03.png"
								                              alt="image 1"/></div>
								<div class="stableTextCheckbox">Mobile Reciever
									<div class="checkboxHolder">
										<div class="checkbox"><input type="checkbox" name="check1"/></div>
										<div class="showPictureText">Show this purchase in my activities</div>
									</div>
								</div>
							</div>
							<div class="categoriesColumn"><input id="qEdit" type="text" name="qEdit" placeholder="1">
							</div>
							<div class="priceColumn">
								<div class="priceAmount"><span class="rupee">`</span> 499.00</div>
							</div>
							<div class="quantityColumn">
								<div class="priceAmount"><span class="rupee">`</span> 399.00</div>
							</div>
							<div class="statusColumn">
								<div class="priceAmount"><span class="rupee">`</span> 399.00</div>
							</div>
							<div class="actionColumn">
								<div class="actionClose"></div>
								<div class="shoppingIcon"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="stableGlassContainerMain">
					<div class="stableGlassContainerTransp" id="row_transp5"></div>
					<div class="stableGlassContainr" onMouseOver="return transp(5)" onMouseOut="return normal(5)">
						<div class="stableGlassRelative">
							<div class="stableglassHolderProducts">
								<div class="stableImage"><img src="<?php echo $base_url; ?>assets/images/image_04.png"
								                              alt="image 1"/></div>
								<div class="stableTextCheckbox">AutomWatch
									<div class="checkboxHolder">
										<div class="checkbox"><input type="checkbox" name="check1"/></div>
										<div class="showPictureText">Show this purchase in my activities</div>
									</div>
								</div>
							</div>
							<div class="categoriesColumn"><input id="qEdit" type="text" name="qEdit" placeholder="1">
							</div>
							<div class="priceColumn">
								<div class="priceAmount"><span class="rupee">`</span> 499.00</div>
							</div>
							<div class="quantityColumn">
								<div class="priceAmount"><span class="rupee">`</span> 399.00</div>
							</div>
							<div class="statusColumn">
								<div class="priceAmount"><span class="rupee">`</span> 399.00</div>
							</div>
							<div class="actionColumn">
								<div class="actionClose"></div>
								<div class="shoppingIcon"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="shoppingCostMain">
				<div class="shoppingCostBackground"></div>
				<div class="shoppingCostContent">
					<div class="costAmount"><span class="rupee">`</span> 25.00</div>
					<div class="shopText">Shipping Cost</div>
				</div>
			</div>
			<div class="savingTotal">
				<div class="saving_text">Saving</div>
				<div class="rupeeAmount rupeeExtra"><span class="rupee">`</span> 400.00</div>
				<div class="rupeeAmount"><span class="rupee">`</span> 2396.00</div>
				<div class="totalStyle">Total</div>
			</div>
			<div class="finalTotal">
				<div class="total_amount_text">Total amount Saved</div>
				<div class="rupeeAmountNew"><span class="rupee">`</span> 700.00</div>
				<div class="rupeeAmount extraColor"><span class="rupee">`</span> 4393.00</div>
				<div class="totalStyle extraColor">Total amount to be Paid</div>
			</div>
			<div class="bottomButtonsHolder">
				<button type="button" id="redeem_credits" class="redeemCredits">Redeem BnB Credits</button>
				<div class="bottomButtonsHolder2">
					<button type="button" id="continue_shopping" class="continueShopping">Continue Shopping</button>
					<button type="button" id="proceed_checkout" class="proceedCheckout">Proceed to Checkout</button>
				</div>
			</div>
		</div>
		<div class="send_popUp" id="sendPopup">
			<div class="send_popUpTransp"></div>
			<div class="send_popUpActual">
				<div class="send_header">
					<div class="send_text">SEND NOTE</div>
					<div id="send_close" class="send_close"></div>
				</div>
				<div class="sendPopupContent">
					<div class="leftPart">
						<div class="sendBg"><img src="<?php echo $base_url; ?>assets/images/sendnote_popup.png"
						                         alt="popup icon"/></div>
						<div class="productName">Guitarglass</div>
					</div>
					<div class="layerSeperator"></div>
					<div class="rightPart">
						<div class="textarea_holder">
							<div class="textarea_background"></div>
							<textarea class="textareaClass"
							          placeholder="enter details about colour, size, bulk order enquiry or any other specifics.."></textarea>
						</div>
						<button type="button" class="prod_continue width_style1">Send</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</section> <?php include "footer.php" ?> </body>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/shopping_cart.js"></script>
</html>