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
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/common1.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/sexy-combo.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/jquery.selectbox.css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/jquery.ui.dialog.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/shopping_cart.css" type="text/css"/>
</head>
<body><input type="hidden" value="<?php echo $base_url;?>" id="baseurl"/>
<!-- ADDED BY SHAMMI TO pass the cart data to BIMAL in order to check for out of stock products -->
<script type="text/javascript">
//<![CDATA[
<?php echo "var cartData = ".((count($cart) > 0) ? json_encode($cart) : "null").";"; ?>
//]]>

var userEmail = "<?php echo $userDetails[0]->email; ?>";
var shoppingCartVisitCounter = parseInt(getCookie("shoppingCartPageLoaded"));
if(!shoppingCartVisitCounter){
	shoppingCartVisitCounter=0;
	console.log('First page visit;');
}
shoppingCartVisitCounter++;
setCookie("bnbCouponID", "none");
setCookie("shoppingCartPageLoaded", shoppingCartVisitCounter);
//console.log("ANALYTICS +++++ shopping cart loaded from shop.php var: " + userEmail + cartData.length + "  ---  " +  shoppingCartVisitCounter);
_bnbAnalytics.shoppingCartLoaded(userEmail, cartData.length, shoppingCartVisitCounter);
</script>

<!-- END SECTION ADDED BY SHAMMI TO pass the cart data to BIMAL in order to check for out of stock products -->
<input type="hidden" name="percentOff" id="perOff" value="<?php if (!empty($session_redeemVal)) { echo $session_redeemVal;} else { echo '0.00'; }?>">
<!-- refer testdata shoppingcart.txt-->
<section class="wrapper">
	<section class="middleBackground">
		<div class="Ie8bg">
			<div class="shoppingCartIconHolder">
				<div class="shoppingCartIcon"></div>
				<div class="shoppingCartText">SHOPPING CART</div>
			</div>
			<div class="topDotSeparator"></div>
			<?php if(count($cart) > 0): ?>
			<div class="shoppingContentsContainer">
				<?php $i = 0; $j = -1; while ($i < count($cart)): ++$j; ?>
					<?php if ($i == 0): ?>
					<?php $price = 0;
					$discount = 0;
					$total = 0;
					$shipping = 0;
					$tdiscount = 0;
					$ttotal = 0;
					$tax = 0; ?> <!-- Head -->
					<div class="titleBackground extraPadding">
						<div class="addProductsBackgroundTransparent"></div>
						<div class="titleBackgroundHolder">
							<div class="productsTextHolder">
								<div class="productsHeading">Products from</div>
								<div class="bannerImage">
									<a href="<?php echo $base_url."order/store_page/".$cart[$i]->store_id; ?>" >
										<img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $cart[$i]->store_id; ?>/cart_banner.jpg" alt="banner"/>
									</a>
								</div>
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
					</div> <!-- END HEAD --> <!-- Prod -->
					<div class="stableGlassContainerHolder">
						<div class="stableGlassContainerMain">
							<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
							<div class="stableGlassContainr" onMouseOver="return transp(<?php echo $i + 1; ?>)" onMouseOut="return normal(<?php echo $i + 1; ?>)">
								<div class="stableGlassRelative">
									<div class="stableglassHolderProducts">
										<div class="stableImage">
											<a href="<?php echo $baseURL."order/product_page/".$cart[$i]->store_id."/".$cart[$i]->product_id; ?>">
												<img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $cart[$i]->store_id; ?>/<?php echo $cart[$i]->product_id; ?>/img1_92x77.jpg" alt="image 1"/>
											</a>
										</div>
										<div class="content">
											<a href="<?php echo $baseURL."order/product_page/".$cart[$i]->store_id."/".$cart[$i]->product_id; ?>">
												<div class="stableTextCheckbox"><?php echo $cart[$i]->product_name; ?>
											</a>
											<?php echo ($cart[$i]->quantity == 0)? "<br/><big><span class=\"text-error\"><b>OUT OF STOCK !! </b></span></big>": ""; ?>
												<input type="hidden" id="hiddenForcartId_<?php echo $cart[$i]->cart_id; ?>" class="hiddenForcartId" value="<?php echo $cart[$i]->cart_id . "_" . $cart[$i]->cart_quantity;?>"/>
											</div>
											<?php if (isset($cart[$i]->vsize)): ?>
												<?php if ($cart[$i]->vsize != 0 || $cart[$i]->vsize != '0'): ?>
													<div class="cartv">Size:<?php echo $cart[$i]->vsize; ?></div>
												<?php endif; ?>
											<?php endif; ?>
											<?php if (isset($cart[$i]->vcolor)): ?>
												<?php if ($cart[$i]->vcolor != 0 || $cart[$i]->vcolor != '0'): ?>
													<div class="cartv">Color: <?php echo $cart[$i]->vcolor; ?></div>
												<?php endif; ?>
											<?php endif; ?>
											<!-- <div class="checkboxHolder"> <div class="checkbox"><input type="checkbox" name="check1"/></div> <div class="showPictureText">Show this purchase in my activities </div> </div>-->
										</div>
									</div>
									<div class="categoriesColumn">
										<select class="drop" id="drop_<?php echo $j; ?>_<?php echo $cart[$i]->store_id; ?>" onChange="calculate2(<?php echo $cart[$i]->cart_id; ?>,<?php echo $cart[$i]->store_id; ?>,<?php echo $i; ?>,this.value,<?php echo ($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price; ?>,<?php echo $cart[$i]->cart_quantity * (($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price); ?>);" name="category">
											<?php $k = 1;$max = $cart[$i]->quantity; for ($k = 1; $k <= $max; $k++): if (($cart[$i]->cart_quantity) != $k): ?>
												<option value="<?php echo $k; ?>"><?php echo $k; ?></option>
											<?php else: ?>
												<option value="<?php echo $cart[$i]->cart_quantity; ?>" selected="selected"><?php echo $cart[$i]->cart_quantity; ?></option>
											<?php endif; ?>
											<?php endfor; ?>
										</select></div>
									<div class="priceColumn">
										<div class="priceAmount">
											<span class="rupee">`</span>
											<span id="selling_price_<?php echo $j; ?>_<?php echo $cart[$i]->store_id; ?>"><?php echo $cart[$i]->selling_price; ?></span>
										</div>
									</div>
									<div class="quantityColumn">
										<div class="priceAmount">
											<span class="rupee">`</span>
											<span class="discount_price_<?php echo $cart[$i]->store_id; ?>"><?php echo ($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price; ?></span>
										</div>
									</div>
									<div class="statusColumn">
										<div class="priceAmount calculate" id="total_price_<?php echo $cart[$i]->store_id; ?>_<?php echo $j; ?>">
											<span class="rupee">`</span>
											<span class="total_price_on_<?php echo $cart[$i]->store_id; ?>"><?php echo $cart[$i]->cart_quantity * (($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price); ?></span>
										</div>
									</div>
									<div class="actionColumn">
										<div class="actionClose" onClick="deleteFromCart('<?php echo $base_url;?>','<?php echo $cart[$i]->cart_id;?>')"></div>
										<!-- <div class="shoppingIcon"></div>--> </div>
								</div>
							</div>
						</div>
					</div> <!-- END PROD --> <?php $price = $price + $cart[$i]->selling_price;
					$discount = $discount + (($cart[$i]->is_on_discount == 1)? $cart[$i]->discount: 0) * $cart[$i]->cart_quantity;
					if($cart[$i]->is_on_discount == 1)
					{
						$total = $total + ($cart[$i]->cart_quantity * ($cart[$i]->selling_price - $cart[$i]->discount));
						$tax = $tax + (($cart[$i]->selling_price - $cart[$i]->discount) * ($cart[$i]->tax_rate / 100));
					}
					else
					{
						$total = $total + ($cart[$i]->cart_quantity * $cart[$i]->selling_price);
						$tax = $tax + (($cart[$i]->selling_price) * ($cart[$i]->tax_rate / 100));
					}
					 // $shipping = $shipping + $cart[$i]->shipping_cost; $shipping = 0.00; ?> <?php else: if ($cart[$i - 1]->store_id == $cart[$i]->store_id): ?> <!-- Prod -->
					<div class="stableGlassContainerHolder">
						<div class="stableGlassContainerMain">
							<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
							<div class="stableGlassContainr" onMouseOver="return transp(<?php echo $i + 1; ?>)"
							     onMouseOut="return normal(<?php echo $i + 1; ?>)">
								<div class="stableGlassRelative">
									<div class="stableglassHolderProducts">
										<div class="stableImage">
											<a href="<?php echo $baseURL."order/product_page/".$cart[$i]->store_id."/".$cart[$i]->product_id; ?>">
												<img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $cart[$i]->store_id; ?>/<?php echo $cart[$i]->product_id; ?>/img1_92x77.jpg" alt="image 1"/>
											</a>
										</div>
										<div class="content">
											<div class="stableTextCheckbox">
												<a href="<?php echo $baseURL."order/product_page/".$cart[$i]->store_id."/".$cart[$i]->product_id; ?>">
													<?php echo $cart[$i]->product_name; ?>
												</a>
												<input type="hidden" id="hiddenForcartId_<?php echo $cart[$i]->cart_id; ?>" class="hiddenForcartId" value="<?php echo $cart[$i]->cart_id . "_" . $cart[$i]->cart_quantity;?>"/>
												<?php echo ($cart[$i]->quantity == 0)? "<br/><big><span class=\"text-error\"><b>OUT OF STOCK !! </b></span></big>": ""; ?>
											</div>
											<?php if (isset($cart[$i]->vsize)): ?> <?php if ($cart[$i]->vsize != 0 || $cart[$i]->vsize != '0'): ?>
												<div class="cartv">Size
													:<?php echo $cart[$i]->vsize; ?></div> <?php endif; ?> <?php endif; ?> <?php if (isset($cart[$i]->vcolor)): ?> <?php if ($cart[$i]->vcolor != 0 || $cart[$i]->vcolor != '0'): ?>
												<div class="cartv">Color
													:<?php echo $cart[$i]->vcolor; ?></div> <?php endif; ?> <?php endif; ?>
											<!-- <div class="checkboxHolder"> <div class="checkbox"><input type="checkbox" name="check1"/></div> <div class="showPictureText">Show this purchase in my activities </div> </div>-->
										</div>
									</div>
									<div class="categoriesColumn"><select class="drop"
									                                      id="drop_<?php echo $j; ?>_<?php echo $cart[$i]->store_id; ?>"
									                                      onChange="calculate2(<?php echo $cart[$i]->cart_id; ?>,<?php echo $cart[$i]->store_id; ?>,<?php echo $i; ?>,this.value,<?php echo $cart[$i]->selling_price - $cart[$i]->discount; ?>,<?php echo $cart[$i]->cart_quantity * ($cart[$i]->selling_price - $cart[$i]->discount); ?>);"
									                                      name="category"> <?php $k = 1; $max = $cart[$i]->quantity; for ($k = 1; $k <= $max; $k++) {
												if (($cart[$i]->cart_quantity) != $k) { ?>
													<option
														value="<?php echo $k; ?>"><?php echo $k; ?></option> <?php } else { ?>
													<option value="<?php echo $cart[$i]->cart_quantity; ?>"
													        selected="selected"><?php echo $cart[$i]->cart_quantity; ?></option> <?php }
											}?> </select></div>
									<div class="priceColumn">
										<div class="priceAmount"><span class="rupee">`</span><span
												id="selling_price_<?php echo $j; ?>_<?php echo $cart[$i]->store_id; ?>"><?php echo $cart[$i]->selling_price; ?></span>
										</div>
									</div>
									<div class="quantityColumn">
										<div class="priceAmount"><span class="rupee">`</span><span
												class="discount_price_<?php echo $cart[$i]->store_id; ?>"><?php echo ($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price; ?></span>
										</div>
									</div>
									<div class="statusColumn">
										<div class="priceAmount calculate"
										     id="total_price_<?php echo $cart[$i]->store_id; ?>_<?php echo $j; ?>"><span
												class="rupee">`</span><span
												class="total_price_on_<?php echo $cart[$i]->store_id; ?>"><?php echo $cart[$i]->cart_quantity * (($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price); ?></span>
										</div>
									</div>
									<div class="actionColumn"
									     onClick="deleteFromCart('<?php echo $base_url;?>','<?php echo $cart[$i]->cart_id;?>')">
										<div class="actionClose"
										     onClick="deleteFromCart('<?php echo $base_url;?>','<?php echo $cart[$i]->cart_id;?>')"></div>
										<!-- <div class="shoppingIcon"></div>--> </div>
								</div>
							</div>
						</div>
					</div> <!-- END PROD --> <?php $price = $price + $cart[$i]->selling_price;
					$discount = $discount + (($cart[$i]->is_on_discount == 1)? $cart[$i]->discount: 0) * $cart[$i]->cart_quantity;
					$total = $total + ($cart[$i]->cart_quantity * (($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price));
					$tax = $tax + ((($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price) * ($cart[$i]->tax_rate / 100)); // $shipping = $shipping + $cart[$i]->shipping_cost; $shipping = 0.00; ?> <?php endif; ?> <?php if ($cart[$i - 1]->store_id <> $cart[$i]->store_id): $j = 0; ?> <!-- TAIL -->
					<div class="shoppingCostMain">
						<div class="shoppingCostBackground"></div>
						<div class="shoppingCostContent">
							<div class="costAmount" id="shipping_amount_<?php echo $cart[$i - 1]->store_id; ?>"><span
									class="rupee">`</span><?php echo $shipping; ?></div>
							<div class="shopText">Shipping Cost</div>
						</div>
					</div>
					<div class="savingTotal">
						<div class="saving_text">Saving</div>
						<div class="rupeeAmount rupeeExtra"
						     id="savings_rupee_amount_<?php echo $cart[$i - 1]->store_id; ?>"><span
								class="rupee">`</span> <?php $tdiscount = $tdiscount + $discount; echo $discount; ?>
						</div>
						<div class="rupeeAmount total_cal" id="rupee_amount_<?php echo $cart[$i - 1]->store_id; ?>">
							<span class="rupee">`</span> <?php $ttotal = $ttotal + ($total + $shipping); echo $total + $shipping; ?>
						</div>
						<div class="totalStyle">Total</div>
					</div> <!-- END TAIL --> <?php $price = 0;
					$discount = 0;
					$total = 0;
					$shipping = 0; ?> <!-- Head -->
					<div class="titleBackground extraPadding">
						<div class="addProductsBackgroundTransparent"></div>
						<div class="titleBackgroundHolder">
							<div class="productsTextHolder">
								<div class="productsHeading">Products from</div>
								<a href="<?php echo $base_url."order/store_page/".$cart[$i]->store_id; ?>" >
									<div class="bannerImage"><img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $cart[$i]->store_id; ?>/cart_banner.png" alt="banner"/></div>
								</a>
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
					</div> <!-- END HEAD --> <!-- Prod -->
					<div class="stableGlassContainerHolder">
						<div class="stableGlassContainerMain">
							<div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
							<div class="stableGlassContainr" onMouseOver="return transp(<?php echo $i + 1; ?>)"
							     onMouseOut="return normal(<?php echo $i + 1; ?>)">
								<div class="stableGlassRelative">
									<div class="stableglassHolderProducts">
										<div class="stableImage">
										<a href="<?php echo $baseURL."order/product_page/".$cart[$i]->store_id."/".$cart[$i]->product_id; ?>">
											<img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $cart[$i]->store_id; ?>/<?php echo $cart[$i]->product_id; ?>/img1_92x77.jpg" alt="image 1"/>
										</a>
										</div>
										<div class="content">
											<div class="stableTextCheckbox">
												<a href="<?php echo $baseURL."order/product_page/".$cart[$i]->store_id."/".$cart[$i]->product_id; ?>">
													<?php echo $cart[$i]->product_name; ?>
												</a>
												<input type="hidden" id="hiddenForcartId_<?php echo $cart[$i]->cart_id; ?>" class="hiddenForcartId" value="<?php echo $cart[$i]->cart_id . "_" . $cart[$i]->cart_quantity;?>"/>
												<?php echo ($cart[$i]->quantity == 0)? "<br/><big><span class=\"text-error\"><b>OUT OF STOCK !! </b></span></big>": ""; ?>
											</div>
											<?php if (isset($cart[$i]->vsize)): ?>
												<?php if ($cart[$i]->vsize != 0 || $cart[$i]->vsize != '0'): ?>
													<div class="cartv">Size: <?php echo $cart[$i]->vsize; ?></div>
												<?php endif; ?>
											<?php endif; ?>
											<?php if (isset($cart[$i]->vcolor)): ?> <?php if ($cart[$i]->vcolor != 0 || $cart[$i]->vcolor != '0'): ?>
												<div class="cartv">Color
													:<?php echo $cart[$i]->vcolor; ?></div> <?php endif; ?> <?php endif; ?>
											<!-- <div class="checkboxHolder"> <div class="checkbox"><input type="checkbox" name="check1"/></div> <div class="showPictureText">Show this purchase in my activities </div> </div>-->
										</div>
									</div>
									<div class="categoriesColumn"><select class="drop"
									                                      id="drop_<?php echo $j; ?>_<?php echo $cart[$i]->store_id; ?>"
									                                      onChange="calculate2(<?php echo $cart[$i]->cart_id; ?>,<?php echo $cart[$i]->store_id; ?>,<?php echo $i; ?>,this.value,<?php echo $cart[$i]->selling_price - $cart[$i]->discount; ?>,<?php echo $cart[$i]->cart_quantity * ($cart[$i]->selling_price - $cart[$i]->discount); ?>);"
									                                      name="category"> <?php $k = 1; $max = $cart[$i]->quantity; for ($k = 1; $k <= $max; $k++): if (($cart[$i]->cart_quantity) != $k): ?>
												<option
													value="<?php echo $k; ?>"><?php echo $k; ?></option> <?php else: ?>
												<option value="<?php echo $cart[$i]->cart_quantity; ?>"
												        selected="selected"><?php echo $cart[$i]->cart_quantity; ?></option> <?php endif; ?> <?php endfor; ?>
										</select></div>
									<div class="priceColumn">
										<div class="priceAmount"><span class="rupee">`</span><span
												id="selling_price_<?php echo $j; ?>_<?php echo $cart[$i]->store_id; ?>"><?php echo $cart[$i]->selling_price; ?></span>
										</div>
									</div>
									<div class="quantityColumn">
										<div class="priceAmount"><span class="rupee">`</span><span
												class="discount_price_<?php echo $cart[$i]->store_id; ?>"><?php echo ($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price; ?></span>
										</div>
									</div>
									<div class="statusColumn">
										<div class="priceAmount calculate"
										     id="total_price_<?php echo $cart[$i]->store_id; ?>_<?php echo $j; ?>"><span
												class="rupee">`</span><span
												class="total_price_on_<?php echo $cart[$i]->store_id; ?>"><?php echo $cart[$i]->cart_quantity * (($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price); ?></span>
										</div>
									</div>
									<div class="actionColumn">
										<div class="actionClose"
										     onClick="deleteFromCart('<?php echo $base_url;?>','<?php echo $cart[$i]->cart_id;?>')"></div>
										<!-- <div class="shoppingIcon"></div>--> </div>
								</div>
							</div>
						</div>
					</div> <!-- END PROD --> <?php $price = $price + $cart[$i]->selling_price;
					$discount = $discount + (($cart[$i]->is_on_discount == 1)? $cart[$i]->discount: 0) * $cart[$i]->cart_quantity;
					$total = $total + ($cart[$i]->cart_quantity * (($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price));
					$tax = $tax + ((($cart[$i]->is_on_discount == 1)? $cart[$i]->selling_price - $cart[$i]->discount: $cart[$i]->selling_price) * ($cart[$i]->tax_rate / 100)); //$shipping = $shipping + $cart[$i]->shipping_cost; $shipping = 0.00; ?> <?php endif; ?> <?php endif; ?> <?php $i++; endwhile; ?>
				<!-- TAIL -->
				<div class="shoppingCostMain">
					<div class="shoppingCostBackground"></div>
					<div class="shoppingCostContent">
						<div class="costAmount" id="shipping_amount_<?php echo $cart[$i - 1]->store_id; ?>"><span
								class="rupee">`</span><?php echo $shipping; ?></div>
						<div class="shopText">Shipping Cost</div>
					</div>
				</div>
				<div class="savingTotal">
					<div class="saving_text">Saving</div>
					<div class="rupeeAmount rupeeExtra"
					     id="savings_rupee_amount_<?php echo $cart[$i - 1]->store_id; ?>"><span
							class="rupee">`</span> <?php $tdiscount = $tdiscount + $discount; echo $discount; ?> </div>
					<div class="rupeeAmount total_cal" id="rupee_amount_<?php echo $cart[$i - 1]->store_id; ?>"><span
							class="rupee">`</span> <?php $ttotal = $ttotal + ($total + $shipping); echo $total + $shipping; ?>
					</div>
					<div class="totalStyle">Total</div>
				</div>
				<!-- END TAIL -->
				<div class="finalTotal">
					<div class="rupeeAmount extraColor" id="rupee_amount2"><span class="rupee">`</span> <span
							id="redeemValCart"> <?php if (!empty($session_redeemVal)) {
								$redeemValFloat = floatval($session_redeemVal);
								if ($redeemValFloat < 1) {
									$redeemAmt = $ttotal * $redeemValFloat;
								} else {
									$redeemAmt = $redeemValFloat;
								}
								$ttotal -= $redeemAmt;
								echo $redeemAmt;
							} else {
								echo '0.00';
							} ?> </span></div>
					<div class="totalStyle extraColor">Redeemed Amount</div>
				</div>
				<div class="finalTotal">
					<div class="total_amount_text">Total amount Saved</div>
					<div class="rupeeAmountNew" id="discount2"><span class="rupee">`</span><?php echo $tdiscount; ?>
						&nbsp;&nbsp;&nbsp;&nbsp; </div>
					<div class="rupeeAmount extraColor" id="rupee_amount2"><span class="rupee">`</span><span
							id="totval"><?php echo $ttotal; ?></span></div>
					<div class="totalStyle extraColor">Total amount to be Paid</div>
				</div>
				<div class="bottomButtonsHolder"> <?php if (!empty($session_redeemVal)): ?>
						<button type="button" style="min-height: 44px; padding: 0 30px;" id="redeem_credits" class="btn btn-info" disabled="disabled">Redeem BnB Coupon
						</button> <?php else: ?>
						<button type="button" id="redeem_credits" class="btn btn-blue btn-large">Redeem BnB Coupon
						</button> <?php endif; ?>
					<div class="bottomButtonsHolder2">
						<form id="cartForm" action="<?php echo $base_url . "index.php/order2/checkout"; ?>" method="post"><input
								id="tamount" type="hidden" name="amount" value="<?php echo $ttotal; ?>" id="amount">
							<input type="hidden" name="tax" value="<?php echo $tax; ?>" id="tax"> <?php endif; ?>
							<button type="button" id="continue_shopping" class="btn btn-flat btn-large"
							        onClick="window.location.href='javascript:history.back()'">Continue Shopping
							</button>
							<button type="submit" style="margin-left: 15px;" id="proceed_checkout" class="btn btn-red btn-large"
							        onClick="return updateCart()">Proceed to Checkout
							</button>
						</form>
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

		<div style="display: none;" id="CartModal" class="modal hide fade" tabindex="-1" role="dialog"  aria-hidden="false">
			<div class="modal-body">
				<div id="redeem_close" class="send_close close" data-dismiss="modal" aria-hidden="true"></div>
				<div id="CartPopup">
					<div>
						<div>
							<h5>PRODUCTS MENTIONED BELOW ARE <span style="color: red">OUT OF STOCK !!</span></h5>
						</div>
						<div>
							<div class="rightPart padding_left35">
								<div id="outItems" class="input_holder"></div>
								<div class="row-fluid">
									<button type="button" class="btn btn-primary btn-large" id="confirmCheckout">Reload modified cart</button>
									<button type="button" class="btn btn-inverse btn-large" id="cancelCheckout">Cancel</button>
								</div>
								<div class="row-fluid">&nbsp;</div>
								<div class="row-fluid">
									<em>On clicking the button, your page will reload and you will be presented with the modified cart. Please click the <b>Proceed to Checkout</b> button then to checkout</em>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

			<!-- Start Redeem Pop-Up -->
		<div style="display: none;" id="redeemModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
			<div class="modal-body">
				<div id="redeemPopup">
					<div>
						<div>
							<div class="send_text padding_left35">REDEEM CREDITS</div>
							<div id="redeem_close" class="send_close close" data-dismiss="modal" aria-hidden="true"></div>
						</div>
						<div>
							<div class="leftPart padding_left35 padding_right64">
								<div class="newRupeeStyle"><span class="rupee">`</span><span id="redeemVal">0</span></div>
								<div class="productName">available credit</div>
								<div id="cErrorDiv" class="cerrorText"></div>
							</div>
							<!-- <div class="layerSeperator lsheight"></div> -->
							<div class="rightPart">
								<div class="input_holder">
									<!-- <div class="input_background"></div> -->
									<input type="text" id="couponId" class="inputClass" name="coupon_id" placeholder="Enter your BuynBrag coupon here"/>
								</div>
                                <button type="button" id="confirmId" class="btn btn-red btn-large pull-left" style="margin-right: 15px;">Confirm</button>
                                <button type="button" id="redeemId" class="btn btn-success btn-large pull-left" style="margin-right: 15px;">Redeem</button>
                                <button type="button" id="cancellCouponPopup" class="btn btn-flat btn-large pull-left" style="margin-right: 15px;">Cancel</button>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<!-- End Redeem Pop-Up --> </div>
	</section>
</section> <?php include "footer.php"; ?>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>assets/js/shopping_cart.js"></script>
<script type="text/javascript">
	$("#redeemId").hide();

	//console.log(cartData);

	$("#redeem_close").click(function ()
	{
		$("#redeemId").hide();
		$("#confirmId").show();
		$("#couponId").val('');
		$("#redeemVal").html('0');
		/*$("#redeemPopup").dialog('close');*/
		$("#redeemModal").modal('hide');
	});

	$("#cancellCouponPopup").click(function ()
	{
		$("#redeemId").hide();
		$("#confirmId").show();
		$("#couponId").val('');
		$("#redeemVal").html('0');
		$("#redeemModal").modal('hide');
	});

	$("#confirmId").click(function ()
	{
		var couponId = jQuery.trim($("#couponId").val());
		couponId = couponId.toLowerCase();
		var total = $("#tamount").val();
		if (couponId != "" && couponId.length != 0)
		{
			$.ajax(
			{
				url: "<?php echo $base_url; ?>" + 'index.php/cart/confirmRedeemCoupon?coupon_id=' + couponId,
				success: function (data)
				{
					if (data.isValid == true) {
						// var n = data.split("/");
						// var couponId = n[0];
						// var percentOff = n[1];
						// var discType = n[2];
						// var availableCredit = '';
						// if (discType == 0)
						// {
						// 	availableCredit = (parseFloat(percentOff) * parseFloat(total)) / 100;
						// }
						// else
						// {
						// 	availableCredit = parseFloat(percentOff);
						// }
						// $("#cErrorDiv").html('');
						// $("#couponId").html(couponId);
						// $("#redeemVal").html(availableCredit);
						// $("#confirmId").hide();
						// $("#redeemId").show();

						var couponId = data.couponid,
							discountType = data.discounttype,
							minPurchaseAmount = parseFloat(data.minPurchaseAmount),
							percentOff = parseFloat(data.percentoff),
							userId = data.userID,
							availableCredit = '';

						if(discountType == 0) {
							availableCredit = (percentOff * parseFloat(total))/100;

							canRedeemCoupon(couponId, availableCredit);
						}
						else if(discountType == 1) {
							availableCredit = percentOff;
							
							if(minPurchaseAmount > 0) {
								//var totalCartAmount = parseFloat("<?php echo $ttotal; ?>");
								
								if(total >= minPurchaseAmount) {									
									canRedeemCoupon(couponId, availableCredit);
								}
								else {
									resetCouponModal('Your purchase amount should be greater than ' + minPurchaseAmount);
								}
							}
							else {
								canRedeemCoupon(couponId, availableCredit);
							}
						}
						/* NEW CODE TO SUPPORT DISCOUNT TYPE = 8, discount on a store */
						else if(discountType == 8)
						{
							if(data.isValidAmount)
							{
								availableCredit = data.finalDiscountAmount;
								canRedeemCoupon(couponId, availableCredit);
							}
							else
							{
								resetCouponModal('Your purchase amount should be greater than ' + minPurchaseAmount + "from the store " + data.storeName + "to avail this coupon.");
							}
						}
						/* __END SECTION__ NEW CODE TO SUPPORT DISCOUNT TYPE = 8, % discount on a store */
						/* NEW CODE TO SUPPORT DISCOUNT TYPE = 5, % discount on a category */
						else if(discountType == 5)
						{
							if(data.isValidAmount)
							{
								availableCredit = data.finalDiscountAmount;
								canRedeemCoupon(couponId, availableCredit);
							}
							else
							{
								resetCouponModal('Your purchase amount should be greater than ' + minPurchaseAmount + "from the store " + data.storeName + "to avail this coupon.");
							}
						}
						/* __END SECTION__ NEW CODE TO SUPPORT DISCOUNT TYPE = 5, % discount on a category */
						else {
							resetCouponModal('Invalid Coupon Id!');
						}
					}
					else {
						resetCouponModal('Invalid Coupon Id!');
					}

				}
			});
		}
		else
			$("#cErrorDiv").html('Enter a valid Coupon Id!');
	});

	$("#redeemId").click(function () {
		var couponId = jQuery.trim($("#couponId").val());
		var totalval = parseFloat($("#tamount").val());
		var totSaved = parseFloat($("#discount2").text().slice(1));
		couponId = couponId.toLowerCase();

		//setCookie("bnbCouponID", couponId);

		if (couponId != "" && couponId.length != 0) {
			$.ajax(
			{
				url: "<?php echo $base_url; ?>" + 'index.php/cart/redeemCoupon',
				data: {coupon_id: couponId, totalPurchaseAmount: totalval},
				success: function (data) {
					if (data.isValidCoupon && data.isValidUser && data.isValidAmount && data.sessionSet)
					{
						if(data.discounttype != 8) {
							var redeemeVal = parseFloat(data.redeemedPrice);
							$("#perOff").val(redeemeVal);	
						}						

						if(data.discounttype == 1 || data.discounttype == 0) {
							var redeemedTotal = totalval - redeemeVal;
							var redeemValCart = redeemeVal;
							totSaved = totSaved + redeemValCart;
							$("#cErrorDiv").html('');
							$("#redeemValCart").html(redeemValCart);
							$("#totval").html(redeemedTotal);
							$("#tamount").val(redeemedTotal);
							$("#discount2").text(totSaved).prepend("<span class='rupee'>`</span> ");
							/*$("#redeemId").hide();*/
							/*$("#redeem_credits").attr('disabled', true);*/
							/*$("#redeemPopup").dialog('close');*/
							$("#redeemModal").modal('hide');
						}
						// if(data.discounttype == 0) {
						// 	var redeemedTotal = Math.round(totalval - (totalval * redeemeVal));
						// 	var redeemValCart = (Math.round((totalval * redeemeVal)*Math.pow(10,2))/Math.pow(10,2)).toFixed(2);
						// 	totSaved = parseInt(totSaved) + parseInt(redeemValCart);
						// 	$("#cErrorDiv").html('');
						// 	$("#redeemValCart").html(redeemValCart);
						// 	$("#totval").html(redeemedTotal);
						// 	$("#tamount").val(redeemedTotal);
						// 	$("#discount2").text(totSaved).prepend("<span class='rupee'>`</span> ");
						// 	/*$("#redeemId").hide();*/
						// 	//$("#redeem_credits").attr('disabled', true);
						// 	/*$("#redeemPopup").dialog('close');*/
						// 	$("#redeemModal").modal('hide');
						// }
						if(data.discounttype == 8) {
							var redeemedTotal = totalval - data.finalDiscountAmount;
							var redeemValCart = redeemeVal;
							totSaved = totSaved + redeemValCart;
							$("#cErrorDiv").html('');
							$("#redeemValCart").html(redeemValCart);
							$("#totval").html(redeemedTotal);
							$("#tamount").val(redeemedTotal);
							$("#discount2").text(totSaved).prepend("<span class='rupee'>`</span> ");
							/*$("#redeemId").hide();*/
							/*$("#redeem_credits").attr('disabled', true);*/
							/*$("#redeemPopup").dialog('close');*/
							$("#redeemModal").modal('hide');
							window.location.reload();
						}
						else if(data.discounttype == 5)
						{
							var redeemedTotal = totalval - data.finalDiscountAmount;
							var redeemValCart = redeemeVal;
							totSaved = totSaved + redeemValCart;
							$("#cErrorDiv").html('');
							$("#redeemValCart").html(redeemValCart);
							$("#totval").html(redeemedTotal);
							$("#tamount").val(redeemedTotal);
							$("#discount2").text(totSaved).prepend("<span class='rupee'>`</span> ");
							/*$("#redeemId").hide();*/
							/*$("#redeem_credits").attr('disabled', true);*/
							/*$("#redeemPopup").dialog('close');*/
							$("#redeemModal").modal('hide');
							window.location.reload();
						}
					}
					else
					{
						$("#redeemId").hide();
						$("#confirmId").show();
						$("#couponId").val('');
						$("#redeemVal").html('0');
						$("#cErrorDiv").html('Enter a valid Coupon Id!');
					}
				}
			});
		}
		else {
			$("#redeemId").hide();
			$("#confirmId").show();
			$("#couponId").val('');
			$("#redeemVal").html('0');
			$("#cErrorDiv").html('Enter a valid Coupon Id!');
		}

	});

	function canRedeemCoupon(couponId, availableCredit) {
		$("#cErrorDiv").html('');
		$("#couponId").html(couponId);
		$("#redeemVal").html(availableCredit);
		$("#confirmId").hide();
		$("#redeemId").show();
	}

	function resetCouponModal(msg) {
		$("#redeemId").hide();
		$("#confirmId").show();
		$("#couponId").val('');
		$("#redeemVal").html('0');
		$("#cErrorDiv").html(msg);
	}

	function deleteFromCart(base_url, cart_id)
	{
		$.post(base_url + "index.php/ajax/deleteCart", {obj: cart_id}, function (resp) {
			window.location.href = resp + "index.php/cart/shopping_cart";
		}, "text");
	}
	
	function updateCart()
	{

		var bnbCouponVal = document.getElementById('redeemValCart').innerHTML;
		var bnbGrandTotal = document.getElementById('totval').innerHTML;
		setCookie("bnbCouponRedeemVal", bnbCouponVal);
		setCookie("checkout1CartSize", cartData.length);
		setCookie("bnbGrandTotal", bnbGrandTotal);

		var flag = 0;
		$(".drop").each(function () {
			if (parseInt($(this).val()) == 0) {
				alert("Quantity should not be zero");
				flag = 1;
			}
		});
		if (flag == 1) {
			return false;
		}
		var baseurl = $('#baseurl').val();

		//Check for out of stock items -- By Bimal
		var emptyItems = [];
		for(item in cartData){
			if( parseInt(cartData[item].quantity) == 0 ) {
				emptyItems.push(cartData[item]);
			}
		}
		//console.log(emptyItems)

		if(emptyItems.length !== 0)
		{
			//console.log('opening modal');
			$('#outItems').empty();
			for(item in emptyItems) {
				$('#outItems').append('<h5>'+ emptyItems[item].product_name + '</h5>');
			}
			$('#CartModal').modal('show');
			return false;
		}
		else {
			updateCart2();
			$('#cartForm').submit();
			return true;
		}
	}

	function updateCart2(hasOutOfStock) {
		var baseurl = $('#baseurl').val();
		var arr = new Object();
		$(".hiddenForcartId").each(function (ind, ele) {
			var splitval = ele.value.split("_");
			arr[ind] = {'cartID':splitval[0], 'quantity':splitval[1]};
			//arr[splitval[0]] = splitval[1];
		});

		console.log(arr);

		$.ajax(
		{
			type:'POST' ,
			url: baseurl + "index.php/ajax/updateCart",
			data: {obj: arr},
			success: function(response, textStatus, jqXHR)
			{
				console.log(hasOutOfStock, textStatus, jqXHR)
				if (typeof(hasOutOfStock) === 'undefined') {
					// $('#cartForm').submit();
					//console.log('Default cart behaviour');
				}
				else {
					setTimeout(function() {console.log('Loading Cart')}, 500);
					// $('#outItems').find('img').remove();
					location.reload();
				}
			},
			error: function(){return false;}
		});
		//window.location.href=resp+"index.php/order2/checkout" ;
	}

	$('#confirmCheckout').click(function()
	{
		$('#outItems').append('<img src="../../assets/images/loader.gif" />');
		$('#outItems').append('<span>Loading Modified cart</span>');
		updateCart2(true);
		//window.location.href= '<?php echo $base_url; ?>'+"index.php/order2/checkout" ;
	});

	$('#cancelCheckout').click(function()
	{
		$('#CartModal').modal('hide');
		return false;
	});
	
	function calculate2(cat_id, s_id, id, drop_down_value, our_price, total)
	{
		document.getElementById("hiddenForcartId_" + cat_id).value = cat_id + "_" + drop_down_value;
		var i = 0;
		var totalsum = 0;
		var savings = 0;
		$(".discount_price_" + s_id).each(function (ind, ele) {
			var e = document.getElementById("drop_" + i + "_" + s_id);
			var selectedQuantity = e.options[e.selectedIndex].value;
			var total = (parseInt(ele.innerHTML) * parseInt(selectedQuantity));
			//alert(parseInt(ele.innerHTML)*parseInt(selectedQuantity));
			totalsum += total;
			$("#total_price_" + s_id + "_" + i).text(total).prepend("<span class='rupee'>`</span> ");
			savings += selectedQuantity * (parseInt(document.getElementById("selling_price_" + i + "_" + s_id).innerHTML) - parseInt(ele.innerHTML));
			i++;
		});
		var t1 = parseInt($("#shipping_amount_" + s_id).text().replace('`', ''));
		$("#rupee_amount_" + s_id).text(totalsum + t1).prepend("<span class='rupee'>`</span> ");
		$("#savings_rupee_amount_" + s_id).text(savings).prepend("<span class='rupee'>`</span> ");
		var total_order = 0;
		$(".total_cal").each(function (ind, ele) {
			total_order += parseInt($("#" + ele.id).text().replace('`', ''));
			//total_order+=parseInt(ele.text().replace('`', ''));
		});
		var total_savings = 0
		$(".rupeeExtra").each(function (ind, ele) {
			total_savings += parseInt($("#" + ele.id).text().replace('`', ''));
			//total_order+=parseInt(ele.text().replace('`', ''));

		});
		var redeemVal = jQuery.trim($("#perOff").val());
		redeemVal = parseFloat(redeemVal);
		var redeemValCart = 0.00;
		if (redeemVal != 0) {
			if (redeemVal < 1) {
				redeemValCart = total_order * redeemVal;
			}
			else {
				redeemValCart = redeemVal;
			}
		}
		total_order = total_order - redeemValCart;
		total_savings = total_savings + redeemValCart;
		//document.getElementByName("amount").value=total_order;
		$("#redeemValCart").html(redeemValCart);
		$("#totval").html(total_order);
		$("#tamount").val(total_order);
		$("#discount2").text(total_savings).prepend("<span class='rupee'>`</span> ");
		updateCart2();
		location.reload(); // reload the page to rectify all values
	}
</script>
</html>