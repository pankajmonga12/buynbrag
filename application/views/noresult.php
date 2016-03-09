<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>No Result</title>
	<meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/common1.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sexy-combo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.selectbox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/search_people.css" />
    <!--[if IE]>
    <link type="text/css" rel="stylesheet" href="css/ie.css" />
    <![endif] -->
</head>
<body>
	<?php include_once('header2.php'); ?>
    <section class="wrapper">
        <article class="banner">
            <div class="slide">
            	<div class="topBanerPatternContainer"></div>
                <div class="bannerAuto newbannerAuto">
                	<div class="bannerMid newbannerAuto2">
                    	<div class="banner_name">No Results for"<?php print $search;?>"</div>
                        <div class="productsFound">
						   <span class="noOfProducts bnbPink"><?php  print $get_prod->count; ?></span>
						   <a href="<?php echo base_url(); ?>search/product/<?php echo $search; ?>/<?php echo 1;?>">Products</a>
						   <span class="noOfProducts bnbPink"><?php  print $get_ppl->count; ?></span>
						   <a href="<?php echo base_url(); ?>search/people/<?php echo $search; ?>/<?php echo 1;?>">People</a>
					    </div>
                    </div>
                    <div class="fr">
                    	<div class="searchContainer">
                    		<div class="searchLabel">Search</div>
							<form action="<?php echo base_url();?>search/product" method="post" id="searchform" name="searchform">
                            <input class="search_product" id="search" type="text" placeholder="search for products or people" name="search"/>
                            <div class="searchProductIcon"></div>
							</form>
                        </div>	
                        
                    </div>
                </div>
            </div>
        </article>
        <section class="middleBackground">
        	<div class="topDotSeparator topSeparatorStyle"></div>
        	<div class="fancyContentsContainer">
            	<div class="fancyForHeight">	
                    <div class="fancyStoreContainer paddingTop25">
                    	<div class="noresult">Other things to try:
						
						<ul>
						   <li>Search using other keywords</li>
						   <li>Search using fewer keywords</li>
						</ul>
                        </div>
                    </div>
            	</div> 
            </div>
        </section>
    </section>
    <?php include "footer.php" ?> 
</body>
</html>
