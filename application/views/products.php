<?php
$last_msg_id = "";
$action = "";
if (!empty($_GET))
{
    $last_msg_id = $_GET['last_msg_id'];
    $action = $_GET['action'];
}

if ($action <> "get")
{
    ?>
    <!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">
    <![endif]-->
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8" lang="en">
    <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9" lang="en">
    <![endif]-->
    <!--[if gt IE 8]>
    <html class="no-js" lang="en">
    <![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Products</title>
        <meta name="viewport" content="width=device-width">
        <?php require_once('stylesheets.php'); ?>
        <!--[if IE]>
        <link type="text/css" rel="stylesheet" href="css/ie.css"/>
        <![endif] -->
        <style type="text/css">
            .saveText{font-size: 12px; color: green;padding: 0 35px;bottom: 5px;position: relative;}
            .errorText{font-size: 12px; color: red;padding: 0 35px;bottom: 5px;position: relative;}
        </style>
    </head>
    <body>
        <input type="hidden" value="<?php echo $base_url; ?>" id="baseurl">
        <input type="hidden" value="<?php echo $store_info[0]->store_id; ?>" id="store_id">
        <?php //include_once('header.php'); ?>
        <section class="wrapper">
            <article class="banner">
                <div class="bannerIE2">
                    <div class="slide">
                        <div class="bannerHolder">
                            <div class="bannerLogo">
                                <img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $store_info[0]->store_id; ?>/top_banner.png"/>
                            </div>
                            <div class="bannerText newbannerText">
                                <!-- <div class="bannerTextHolder newbannerTextHolder"> <div class="bannerShopText">Shop URL :</div> <div class="bannerURLText"><?php echo $store_info[0]->store_url; ?></div> </div> -->
                            </div>
                            <div class="bannerIconsHolder">
                                <div class="fancyHolder">
                                    <div class="fancyIcon"></div>
                                    <div class="fancyTextHolder">
                                        <div class="fancyNumber"><?php echo $store_info[0]->fancy_counter; ?></div>
                                        <div class="fancyText">fancied</div>
                                    </div>
                                </div>
                                <div class="fancyHolder">
                                    <div class="bragedIcon"></div>
                                    <div class="fancyTextHolder newfancyTextHolder1">
                                        <div class="fancyNumber"><?php echo $store_info[0]->brag_counter; ?></div>
                                        <div class="fancyText">bragged</div>
                                    </div>
                                </div>
                                <div class="fancyHolder">
                                    <div class="viewedIcon"></div>
                                    <div class="fancyTextHolder newfancyTextHolder2">
                                        <div class="fancyNumber"><?php echo $store_info[0]->visit_counter; ?></div>
                                        <div class="fancyText">viewed</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <nav class="middleColumnTop">
                <div class="middleColumnIE">
                    <div class="topDotSeparator newtopDotSeparator"></div>
                    <div class="linksMiddle">
                        <a href="<?php echo $base_url; ?>index.php/dashboard/order_status/<?php echo $store_info[0]->store_id; ?>">
                            <div class="dashboardLink1">
                                <div class="dashboardLogo1"></div>
                                <div class="dashboardText1">Dashboard</div>
                            </div>
                        </a>
                        <a href="<?php echo $base_url; ?>index.php/dashboard/allproductspage/<?php echo $store_info[0]->store_id; ?>">
                            <div class="productsLink1">
                                <div class="productsLogo1"></div>
                                <div class="productsText1">Products</div>
                            </div>
                        </a>
                        <a href="">
                            <div class="productsLink">
                                <div class="designLogo"></div>
                                <div class="productsText">Design</div>
                            </div>
                        </a>
                        <a href="<?php echo $base_url; ?>index.php/promote/promote_discount_summary/<?php echo $store_info[0]->store_id; ?>">
                            <div class="productsLink">
                                <div class="promoteLogo"></div>
                                <div class="productsText">Promote</div>
                            </div>
                        </a>
                        <a href="<?php echo $base_url; ?>index.php/dashboard/store_info/<?php echo $store_info[0]->store_id; ?>">
                            <div class="productsLink">
                                <div class="storeLogo"></div>
                                <div class="productsText">Store Profile</div>
                            </div>
                        </a>
                        <a href="<?php echo $base_url; ?>index.php/bill/allbill/<?php echo $store_info[0]->store_id; ?>">
                            <div class="productsLink">
                                <div class="billLogo"></div>
                                <div class="productsText">Bill</div>
                            </div>
                        </a>
                    </div>
                    <div class="topDotSeparator newtopDotSeparator1"></div>
                </div>
            </nav>
            <section class="middleBackground">
                <div class="Ie8bg">
                    <div class="tabsContainer">
                        <div class="tabsContainerRelative">
                            <div class="tabsLinksContainer">
                                <div class="tabsLinksContainerTransparent"></div>
                            </div>
                            <div id="tab">
                                <ul>
                                    <li style="display:none"><a href="#tab1">All</a></li>
                                    <li style="display:none"><a href="#tab2">Live Products</a></li>
                                    <li style="display:none"><a href="#tab3">Sold Out</a></li>
                                    <li style="display:none"><a href="#tab4">Switched Off</a></li>
                                    <div class="addProductLinkHolder">
                                        <a href="<?php echo $base_url; ?>index.php/dashboard/addproductspage/<?php echo $store_info[0]->store_id; ?>">
                                            <button type="button" class="addProducts">Add Products</button>
                                        </a>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="bulkUpload">Bulk Upload</button>
                                        </a>
                                        <a href="javascript:void(0);">
                                            <button type="button" class="bulkUpload" style="width:95px;">Export</button>
                                        </a>
                                    </div>
                                </ul>
                                <div id="tab1">
                                    <div class="titleBackground newtitleBackground">
                                        <div class="addProductsBackgroundTransparent"></div>
                                        <div class="titleBackgroundHolder">
                                            <div class="productsTextHolder">
                                                <div class="productText">Products</div>
                                                <div class="searchProductsfield">
                                                    <div class="searchProductsFieldMid">
                                                        <input type="text" id="search_0" placeholder="Search products" onKeyUp="handleSearch(event, this)"/>
                                                        <div class="textfieldSearch"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="categoryHolder">
                                                <div class="categoryText">Catagories</div>
                                            </div>-->
                                            <div class="categoryHolder4">
                                                <div class="categoryText">
                                                    Fancied<a href="<?php echo base_url()."dashboard/allproductspage/".$store_info[0]->store_id."?sort=1&param=1"; ?>">&uarr;</a>&nbsp;&nbsp;<a href="<?php echo base_url()."dashboard/allproductspage/".$store_info[0]->store_id."?sort=-1&param=1"; ?>">&darr;</a>
                                                </div>
                                            </div>
                                            <div class="categoryHolder4">
                                                <div class="categoryText">
                                                    Orders<a href="<?php echo base_url()."dashboard/allproductspage/".$store_info[0]->store_id."?sort=1&param=2"; ?>">&uarr;</a>&nbsp;&nbsp;<a href="<?php echo base_url()."dashboard/allproductspage/".$store_info[0]->store_id."?sort=-1&param=2"; ?>">&darr;</a>
                                                </div>
                                            </div>
                                            <div class="categoryHolder1">
                                                <div class="categoryText">Price</div>
                                            </div>
                                            <div class="categoryHolder2">
                                                <div class="categoryText">Quantity</div>
                                            </div>
                                            <div class="categoryHolder3">
                                                <div class="categoryText">Status</div>
                                            </div>
                                            <div class="categoryHolder4">
                                                <div class="categoryText">Action</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stableGlassContainerHolder" id="parent_product_0">
                                        <?php
                                            $i = 0;
                                            $lastId = "";
                                            foreach ($allproducts as $item)
                                            {
                                                $i++;
                                                $lastId = $item->product_id;
                                                ?>
                                                <div class="stableGlassContainerRelative message_box" id="<?php echo $item->product_id; ?>">
                                                    <div class="stableGlassContainerTransp" id="row_transp<?php echo $i + 1; ?>"></div>
                                                    <div class="stableGlassContainer1">
                                                        <div class="stableGlassRelative">
                                                            <div class="stableglassHolderProducts">
                                                                <div class="stableglassImage">
                                                                    <img src="<?php echo $store_url; ?>assets/images/stores/<?php echo $item->store_id;?>/<?php echo $item->product_id;?>/img1_73x73.jpg" alt="<?php echo $item->product_name; ?>"/>
                                                                </div>
                                                                <div class="stableglassText">
                                                                    <div class="stableglassHeading">
                                                                        <?php echo $item->product_name; ?>
                                                                    </div>
                                                                    <div class="purchaseText">product code
                                                                        <span class="purchaseSpan"><?php echo $item->bnb_product_code;?></span>
                                                                    </div>
                                                                    <div class="purchaseText">product id
                                                                        <span class="purchaseSpan"><?php echo $item->product_id;?></span>
                                                                    </div>
                                                                    <?php
                                                                    /*
                                                                    ?>
                                                                    <div class="purchaseText">purchase date
                                                                        <span class="purchaseSpan">Jan 24, 2012</span>
                                                                    </div>
                                                                    <div class="silverImage">
                                                                        <img src="<?php echo $base_url; ?>assets/images/stable_badge.png" alt="stable" />
                                                                    </div>
                                                                    <?php
                                                                    */
                                                                    ?>
                                                                </div>
                                                                <div class="<?php echo ( ($item->quantity > 0)? "onsaleImage": "soldoutImage" ); ?>"></div>
                                                            </div>
                                                            <!--<div class="categoriesColumn">
                                                                <div class="priceAmount"><?php echo $item->category_name; ?></div>
                                                            </div>-->
                                                            <div class="actionColumn">
                                                                <div class="priceAmount"><?php echo $item->fancy_counter; ?> times</div>
                                                            </div>
                                                            <div class="actionColumn">
                                                                <div class="priceAmount" style="margin-top:-2em;font-size:14px"><?php echo $item->totalSold; ?><br>orders<hr style="margin:0"/><?php echo $item->totalComplete; ?><br/>Complete</div>
                                                            </div>
                                                            <div class="priceColumn">
                                                                <div class="priceAmount">
                                                                    <span class="rupee">`</span> <?php echo $item->selling_price; ?>
                                                                </div>
                                                            </div>
                                                            <div class="quantityColumn">
                                                                <input type="text" id="qEdit_<?php echo $item->product_id;?>" class="prodQuantity" placeholder="0" value="<?php echo $item->quantity; ?>" name="qEdit_<?php echo $item->product_id;?>" />
                                                            </div>
                                                            <div class="statusColumn">
                                                                <div class="<?php echo ( ($item->pro_status == 1 && $item->is_enable == 0)? "onOffSwitch active": "onOffSwitch" ); ?>" id="<?php echo "switch_".$item->product_id; ?>"></div>
                                                            </div>
                                                            <div class="actionColumn">
                                                                <a href="<?php echo $base_url;?>index.php/dashboard/editProduct/<?php echo $item->product_id; ?>/<?php echo $item->store_id; ?>">
                                                                    <div class="actionEdit" style="margin: 40px auto;"></div>
                                                                </a>
                                                                <?php /*<!-- <div class="actionClose" onClick="confirm_Delete(<?php echo $item->product_id; ?>)"></div> --> */ ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                <?php
                                            }
                                            ?>
                                            <input type="hidden" value="<?php echo $lastId; ?>" id="lastRecord"/>
                                            <div class="slideBackground" id="slideBackground_1">
                                                <div class="slideNormal" id="slideNormal_1"></div>
                                            </div>
                                    </div>
                                </div>
                                <div id="tab2">
                                    <div class="titleBackground newtitleBackground">
                                        <div class="addProductsBackgroundTransparent"></div>
                                        <div class="titleBackgroundHolder">
                                            <div class="productsTextHolder">
                                                <div class="productText">Products</div>
                                                <div class="searchProductsfield">
                                                    <div class="searchProductsFieldMid">
                                                        <input type="text" id="search_1" placeholder="Search products" onKeyUp="handleSearch(event, this)"/>
                                                        <div class="textfieldSearch"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="categoryHolder">
                                                <div class="categoryText">Catagories</div>
                                            </div>
                                            <div class="categoryHolder1">
                                                <div class="categoryText">Price</div>
                                            </div>
                                            <div class="categoryHolder2">
                                                <div class="categoryText">Quantity</div>
                                            </div>
                                            <div class="categoryHolder3">
                                                <div class="categoryText">Status</div>
                                            </div>
                                            <div class="categoryHolder4">
                                                <div class="categoryText">Action</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stableGlassContainerHolder" id="parent_product_1"></div>
                                </div>
                                <div id="tab3">
                                    <div class="titleBackground newtitleBackground">
                                        <div class="addProductsBackgroundTransparent"></div>
                                        <div class="titleBackgroundHolder">
                                            <div class="productsTextHolder">
                                                <div class="productText">Products</div>
                                                <div class="searchProductsfield">
                                                    <div class="searchProductsFieldMid">
                                                        <input type="text" id="search_2" placeholder="Search products" onKeyUp="handleSearch(event, this)"/>
                                                        <div class="textfieldSearch"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="categoryHolder">
                                                <div class="categoryText">Catagories</div>
                                            </div>
                                            <div class="categoryHolder1">
                                                <div class="categoryText">Price</div>
                                            </div>
                                            <div class="categoryHolder2">
                                                <div class="categoryText">Quantity</div>
                                            </div>
                                            <div class="categoryHolder3">
                                                <div class="categoryText">Status</div>
                                            </div>
                                            <div class="categoryHolder4">
                                                <div class="categoryText">Action</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stableGlassContainerHolder" id="parent_product_2"></div>
                                </div>
                                <div id="tab4">
                                    <div class="titleBackground newtitleBackground">
                                        <div class="addProductsBackgroundTransparent"></div>
                                        <div class="titleBackgroundHolder">
                                            <div class="productsTextHolder">
                                                <div class="productText">Products</div>
                                                <div class="searchProductsfield">
                                                    <div class="searchProductsFieldMid">
                                                        <input type="text" id="search_3" placeholder="Search products" onKeyUp="handleSearch(event, this)"/>
                                                        <div class="textfieldSearch"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="categoryHolder">
                                                <div class="categoryText">Catagories</div>
                                            </div>
                                            <div class="categoryHolder1">
                                                <div class="categoryText">Price</div>
                                            </div>
                                            <div class="categoryHolder2">
                                                <div class="categoryText">Quantity</div>
                                            </div>
                                            <div class="categoryHolder3">
                                                <div class="categoryText">Status</div>
                                            </div>
                                            <div class="categoryHolder4">
                                                <div class="categoryText">Action</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stableGlassContainerHolder">
                                        <div class="stableGlassContainerRelative" id="parent_product_3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!--    -->
        <?php //include "footer.php" ?>
    </body>
    <script type="text/javascript">
        $(document).ready(function ()
        {
            function last_products_funtion()
            {
                var num = $(".stableGlassContainerRelative").size();
                var ID = $(".message_box:last").attr("id");

                var baseUrl = $("#baseurl").val();
                var selected = $("#tab").tabs("option", "selected");
                var selectedTabTitle = $($("#tab li")[selected]).text();
                var type = 0;
                if (selectedTabTitle == "All")
                {
                    type = 0;
                }
                else if (selectedTabTitle == "Onsale")
                {
                    type = 1;
                }
                else
                {
                    type = 2;
                }
                var product = $('#search_' + (type + 1)).val();
                $('div#slideNormal_1').html('<img src=' + baseUrl + 'assets/images/loader.gif>');
                $.ajax(
                {
                    url: baseUrl + 'dashboard/productsAjaxLoader?status=' + type + '&limit=' + ID + '&pro=' + product + '&store_id=' + <?php echo $store_info[0]->store_id?> + '&number=' + num + '',
                    success: function (data)
                    {
                        if (data != "")
                        {
                            $(".message_box:last").after(data);
                        }
                        $('div#slideNormal_1').empty();
                    }
                });
            };

            $(window).scroll(function ()
            {
                if ($(window).scrollTop() == $(document).height() - $(window).height())
                {
                    last_products_funtion();
                }
            });
        });

        //Initializing required functions
        _bnbDashboard.prodQuantityChange();
        _bnbDashboard.statusSwitch();
    </script>
    <script type="text/javascript" src="/assets/js/products.js"></script>
</html>
<?php
}
?>