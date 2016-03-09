<?php $status = $_REQUEST['status'];
$pro = $_REQUEST['pro'];
$i = 0;
foreach ($search_product as $product): $i++; ?> <?php require_once('stylesheets.php'); ?>
    <div class="stableGlassContainerRelative">
        <div class="stableGlassContainerTransp" id="row_transp1"></div>
        <div class="stableGlassContainer1" onMouseOver="return transp(1)" onMouseOut="return normal(1)">
            <div class="stableGlassRelative">
                <div class="stableglassHolderProducts">
                    <div class="stableglassImage">
                        <img src="<?php echo $store_url."assets/images/stores/".$product->store_id."/".$product->product_id."/img1_73x73.jpg"; ?>" alt="<?php echo $product->product_name; ?>" />
                    </div>
                    <div class="stableglassText">
                        <div class="stableglassHeading"><?php echo $product->product_name; ?></div>
                        <div class="purchaseText">product code
                            <span class="purchaseSpan"><?php echo $product->bnb_product_code; ?></span>
                        </div>
                        <div class="purchaseText">product id
                            <span class="purchaseSpan"><?php echo $product->product_id; ?></span>
                        </div>
                        <?php
                        /*
                        <!--
                        <div class="silverImage">
                            <img src="images/stable_badge.png" alt="stable" />
                        </div>
                        -->
                        */
                        ?>
                    </div>
                    <div class="<?php echo ( ($product->quantity > 0)? "onsaleImage": "soldoutImage" ); ?>"></div>
                </div>
                <div class="categoriesColumn">
                    <div class="priceAmount"><?php echo $product->category_name; ?></div>
                </div>
                <div class="priceColumn">
                    <div class="priceAmount">
                        <span class="rupee">`</span> <?php echo $product->selling_price; ?>
                    </div>
                </div>
                <div class="quantityColumn">
                    <input type="text" id="qEdit_<?php echo $product->product_id;?>" class="prodQuantity" placeholder="0" value="<?php echo $product->quantity; ?>" name="qEdit_<?php echo $product->product_id;?>" />
                </div>
                <div class="statusColumn">
                    <div class="<?php echo ( ($product->pro_status == 1 && $product->is_enable == 0)? "onOffSwitch active": "onOffSwitch" ); ?>" id="<?php echo "switch_".$product->product_id; ?>"></div>
                </div>
                <div class="actionColumn">
                    <a href="<?php echo $base_url."dashboard/editProduct/".$product->product_id."/".$product->store_id; ?>">
                        <div class="actionEdit"></div>
                    </a>
                    <!-- <div class="actionClose"></div> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script type="text/javascript" src="/assets/js/products.js"></script>