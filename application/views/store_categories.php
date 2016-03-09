<?php $rand_num_file = mt_rand(); if ($isRecord == 0) {
	$actionRequired = "insertRecord";
	$saveButton = "Make it Live";
} else {
	$actionRequired = "updateRecord";
	$saveButton = "Update";
} //error_reporting(E_ERROR | E_PARSE); ?> <!doctype html> <!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Store Profile</title>
	<meta name="viewport" content="width=device-width"> <?php require_once('stylesheets.php') ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>assets/css/store_profile.css"/>
	<!--[if IE]>
	<link type="text/css" rel="stylesheet" href="css/ie.css"/> <![endif] --> </head>
<body><input type="hidden" value="<?php echo $base_url; ?>" id="baseurl"> <?php //include_once('header.php'); ?>
<section class="wrapper"> <?php include_once('store_navigation.php'); ?>
	<section class="middleBackground">
		<div class="categoriesContainer">
			<div class="categoryIcons"><a
					href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Info" class="infoIcon showtooltip"></div>
				</a> <a href="javascript:void(0);">
					<div class="categoryIcon"></div>
				</a>

				<div class="categoriesText">SHOP SECTION</div>
				<a href="<?php echo $base_url; ?>index.php/dashboard/store_policies/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Policies &amp; FAQ" class="policyIcon showtooltip"></div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_customer_support/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Customer Support" class="customerSupportIcon showtooltip"></div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_bank_info/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Legal &amp; Banking Info" class="legalBankingIcon showtooltip"></div>
				</a> <a
					href="<?php echo $base_url; ?>index.php/dashboard/store_pickup_address/<?php echo $store_info_var[0]->store_id; ?>">
					<div title="Pickup Address" class="pickupIcon showtooltip"></div>
				</a></div>
		</div>
		<div class="whiteSeparator"></div>
		<div class="tableContentsContainer">
			<div class="tableContentsInner">
				<div class="leftPanel">
					<div class="leftPanelContent" id="leftPanelContent">
						<div class="category_Heading">
							<div class="categoryBackground"></div>
							<div class="categoryContent">
								<div class="categoryText">SHOP SECTION</div>
								<button type="button" class="addCategoryButton" id="add_category_button">Add Catagory
								</button>
								<div class="addCategoryHidden" id="add_category_hidden">
									<div class="addCategoryTextHolder">
										<div class="addCategoryText">
											<div class="addCategoryTextBackground"></div>
											<div class="addCategoryTextHiddenContent">Add Catagory</div>
											<div class="addCategorySaveCancel">
												<div class="addCategorySaveCancelHolder">
													<div class="addCategorySaveCancelBackground"></div>
													<div class="addCategorySaveCancelContent"><input type="hidden"
													                                                 name="store_id"
													                                                 id="store_id"
													                                                 value="<?php echo $store_info_var[0]->store_id; ?>"/>
														<input type="text" name="category name" id="category_name"
														       placeholder="enter category name"/>

														<div class="buttonsContainer">
															<button type="button" class="save_icon" style="margin-top:0"
															        id="save_button">Save
															</button>
															<button type="button" class="cancel_icon"
															        id="cancel_button">Cancel
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> <?php $total_rec = count($store_cat_var); ?>
						<div class="shadowHolder">
							<div class="categoryContentBackgroundHolder" id="categoryBackground0"
							     onClick="rightPanelCategories(0,<?php echo $total_rec; ?>,<?php echo $store_info_var[0]->store_id; ?>,0)">
								<div class="topBoxShadow" id="top_shadow0"></div>
								<div class="categoryContentBackground"></div>
								<div class="categoryContent">
									<div class="allText" id="allText0" style="color:#DA3C63">All</div>
								</div>
								<div class="bottomBoxShadow" id="bottom_shadow0"></div>
							</div>
						</div> <?php $total_rec = count($store_cat_var); $i = 0; foreach ($store_cat_var as $item): $i++; ?>
							<div class="shadowHolder">
								<div class="chairCategoryContentBackgroundHolder"
								     id="categoryBackground<?php echo $i; ?>"
								     onClick="rightPanelCategories(<?php echo $i; ?>,<?php echo $total_rec; ?>,<?php echo $store_info_var[0]->store_id; ?>,<?php echo $item->storesection_id; ?>)">
									<div class="topBoxShadow1" id="top_shadow<?php echo $i; ?>"></div>
									<div class="chairCategoryContentBackground"></div>
									<div class="chairCategoryContent">
										<div class="category_identity"></div>
										<div class="allText"
										     id="allText<?php echo $i; ?>"><?php echo $item->name; ?></div>
									</div>
									<div class="bottomBoxShadow" id="bottom_shadow<?php echo $i; ?>"></div>
								</div>
							</div> <?php endforeach;?> </div>
					<div class="dragDropText">&nbsp;</div>
					<div class="leftBoxShadow"></div>
				</div>
				<div class="rightPanel">
					<div class="rightPanelHeading">
						<div class="rightPanelHeadingBackground"></div>
						<div class="rightPanelHeadingContents">
							<div class="itemsTextContainer">
								<div class="checkbox selectAll"><input type="checkbox" name="check1" id="checkedAll"/>
								</div>
								<div class="itemsText">Items</div>
								<div class="moveDrop move"><select id="move_combo" name="move_combo"
								                                   onChange="return truncateOption(),moveCatRecords(this.value)">
										<option value="">Move to
										</option> <?php $total_rec = count($store_cat_var); if ($total_rec > 0) {
											foreach ($store_cat_var as $item1): ?>
												<option
													value="<?php echo $item1->storesection_id; ?>"><?php echo truncateOptionVal($item1->name, 8); ?></option> <?php endforeach;
										} ?> </select></div>
							</div>
							<div class="quantityTextContainer">Quantity</div>
							<div class="priceTextContainer">Price</div>
							<div class="actionTextContainer" style="padding-left: 8px;text-align: center;">Action</div>
						</div>
					</div>
					<div id="rightAjaxFatchedRecords">
						<div
							class="rightPanelContents">
                            <?php
                                $total_rec_items = count($store_cat_items);
                                if ($total_rec_items > 0)
                                {
                                    //echo mysql_num_rows($result);
                                    $n=0;
                                    foreach ($store_cat_items as $item2):
                                        $n++;
                                    ?>
								<input type="hidden" name="totalRowId" id="totalRowId"
								       value="<?php echo $total_rec_items; ?>"/>
								<div class="rightPanelContentRow">
									<div class="rightPanelContentRowBackground"
									     id="changeBackground<?php echo $n; ?>"></div>
									<div class="rightPanelContentRow_1">
										<div class="chairItem1"><input type="hidden" name="hiddenProductId"
										                               id="hiddenProductId_<?php echo $n; ?>"
										                               value="<?php echo $item2->product_id; ?>"/>

											<div class="checkbox_Holder">
												<div class="checkbox" id="checkbox<?php echo $n; ?>"
												     onClick="return changeColor(<?php echo $n; ?>,<?php echo $total_rec_items; ?>);">
													<input type="checkbox" name="check<?php echo $n; ?>"
													       id="track_checkbox_<?php echo $n; ?>"/></div>
											</div>
											<div class="chairImage"><img
													src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item2->store_id;?>/<?php echo $item2->product_id;?>/img1_40x40.jpg"
													alt="chair 1"/>
											</div>
											<div
												class="chairCategoryText"><?php echo truncateOptionVal($item2->product_name, 20); ?></div>
										</div>
										<div class="quantityTextContainerRow"><?php echo $item2->quantity; ?></div>
										<div class="priceTextContainerRow"><span
												class="rupee">`</span>&nbsp;<?php echo $item2->selling_price; ?></div>
										<div class="actionTextContainerRow">
                                            <a href="<?php echo $base_url;?>index.php/dashboard/editProduct/<?php echo $item2->product_id; ?>/<?php echo $item2->store_id; ?>">
                                                <div class="actionEditImage" style="margin-left: 20px;"></div>
                                            </a>
                                        </div>
<!--											<div class="actionCloseImage"></div>-->
									</div>
								</div> <?php endforeach;} ?>
                        </div>
					</div>
					<div class="slideBackground" id="slideBackground_1">
						<div class="slideNormal"></div>
					</div>
				</div>
			</div>
		</div>
		<!--pop up-->
		<div class="chairPopupContainer" id="chairPopup"></div>
		<!--pop up end --> </section>
</section> <?php include "footer.php" ?> <?php function truncateOptionVal($text, $limit)
{
	$text = ucfirst(strtolower($text));
	if (strlen($text) > $limit) {
		$text = substr($text, 0, $limit) . '...';
	}
	return $text;
} ?> </body>
<script type="text/javascript" src="/assets/js/jquery.selectbox-0.1.3.js"></script>
<script type="text/javascript" src="/assets/js/jquery.custom_radio_checkbox.js"></script>
<script type="text/javascript" src="/assets/js/store_profile.js"></script>
</html>