<?php if(! defined ('BASEPATH') ) exit('Direct script access not allowed'); ?>
<!doctype html>
<!-- Microdata markup added by Google Structured Data Markup Helper. -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php $c1 = 0;$c2 = 0;$c3 = 0;$c4 = 0;$c5 = 0; for ($i = 0; $i < count($catlist); $i++) {
        if ($catlist[$i]->parent_catagory_id == 1) {
            $had[] = $catlist[$i]->category_name;
            $had_sub[] = $catlist[$i]->category_id;
        }
        if ($catlist[$i]->parent_catagory_id == 2) {
            $fashion[] = $catlist[$i]->category_name;
            $fashion_sub[] = $catlist[$i]->category_id;
        }
        if ($catlist[$i]->parent_catagory_id == 3) {
            $art[] = $catlist[$i]->category_name;
            $art_sub[] = $catlist[$i]->category_id;
        }
        if ($catlist[$i]->parent_catagory_id == 4) {
            $gizmos[] = $catlist[$i]->category_name;
            $gizmos_sub[] = $catlist[$i]->category_id;
        }
        if ($catlist[$i]->parent_catagory_id == 5) {
            $pers[] = $catlist[$i]->category_name;
            $pers_sub[] = $catlist[$i]->category_id;
        }
    } for ($i = 0; $i < count($hcatproducts); $i++) {
        if ($hcatproducts[$i]->cat_id == 1) {
            $phad[] = $hcatproducts[$i];
        }
        if ($hcatproducts[$i]->cat_id == 2) {
            $pfashion[] = $hcatproducts[$i];
        }
        if ($hcatproducts[$i]->cat_id == 3) {
            $part[] = $hcatproducts[$i];
        }
        if ($hcatproducts[$i]->cat_id == 4) {
            $pgizmos[] = $hcatproducts[$i];
        }
        if ($hcatproducts[$i]->cat_id == 5) {
            $ppers[] = $hcatproducts[$i];
        }
    } $temp_shad = 0; $temp_sfashion = 0; $temp_sart = 0; $temp_sgizmos = 0; $temp_spers = 0; for ($i = 0; $i < count($hcatstore); $i++) {
        if ($hcatstore[$i]->cat_id == 1) {
            if (!($hcatstore[$i]->store_id == $temp_shad)) {
                $shad[] = $hcatstore[$i];
                $temp_shad = $hcatstore[$i]->store_id;
            }
        }
        if ($hcatstore[$i]->cat_id == 2) {
            if (!($hcatstore[$i]->store_id == $temp_sfashion)) {
                $sfashion[] = $hcatstore[$i];
                $temp_sfashion = $hcatstore[$i]->store_id;
            }
        }
        if ($hcatstore[$i]->cat_id == 3) {
            if (!($hcatstore[$i]->store_id == $temp_sart)) {
                $sart[] = $hcatstore[$i];
                $temp_sart = $hcatstore[$i]->store_id;
            }
        }
        if ($hcatstore[$i]->cat_id == 4) {
            if (!($hcatstore[$i]->store_id == $temp_sgizmos)) {
                $sgizmos[] = $hcatstore[$i];
                $temp_sgizmos = $hcatstore[$i]->store_id;
            }
        }
        if ($hcatstore[$i]->cat_id == 5) {
            if (!($hcatstore[$i]->store_id == $temp_spers)) {
                $spers[] = $hcatstore[$i];
                $temp_spers = $hcatstore[$i]->store_id;
            }
        }
    } //for ($i=0;$i<count($hcatstore);$i++) //{ // if ($hcatstore[$i]->cat_id == 1) // { // $shad[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 2) // { // $sfashion[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 3) // { // $sart[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 4) // { // $sgizmos[] = $hcatstore[$i]; // } // if ($hcatstore[$i]->cat_id == 5) // { // $spers[] = $hcatstore[$i]; // } //} ?>

    <link rel="stylesheet" type="text/css" href="/application/views/dist/styles/vendor.css" />
    <link rel="stylesheet" type="text/css" href="/application/views/app/styles/main.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/common1.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/sexy-combo.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/newCss/dashboard.css"/>

    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/assets/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
    <script src="/assets/js/libs/modernizr-2.5.3.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery-ui-1.8.16.custom.min.js"></script> <!-- scripts concatenated and minified via ant build script-->
    <link href="/favicon.ico" rel="shortcut icon" type="image/ico"/>
    <script type="text/javascript" src="/assets/js/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.ui.tabs.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.ui.dialog.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.ui.position.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.tooltip.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.selectbox-0.1.3.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.sexy-combo.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.hoverIntent.minified.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.jscrollpane.js"></script>
    <script type="text/javascript" src="/assets/js/pop-up.js"></script>
    <script type="text/javascript" src="/assets/js/common.js"></script>

    <script type="text/javascript" src="/assets/js/tooltip.js"></script>
    <script src="/application/views/app/scripts/vendor/bootstrap/bootstrap-dropdown.js"></script>
    <script src="/assets/js/newJS/dashboard.js"></script>

</head>

<header class="header" onLoad>
    <div class="headerTop container-fluid">
        <div class="headerContainer">

            <h1 class="logoHeading">
                <a class="logo pull-left hidden-phone" href="/">
                    <img src="/application/views/dist/images/404_logo.png" alt="BuynBrag logo"/>
                </a>
            </h1>

            <div class="signedInProfileHolder pull-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img class="userImage" src="<?php echo $store_url; ?>assets/images/stores/<?php echo $storeownerdetails[0]->store_id; ?>/<?php echo $storeownerdetails[0]->storeowner_id; ?>_40x40.jpg"  onerror='this.src = "<?php echo $base_url; ?>assets/images/default/defsmall.jpg" ;'>
                    <span class="userName"><?php echo $storeownerdetails[0]->owner_name; ?></span>
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a id="logoutUser" href="<?php echo $base_url . 'index.php/login/logout/' . $user_id; ?>">Log Out</a></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="navigation">
        <nav class="navigationMiddle">
            <div class="logoChain"></div>
        </nav>
    </div>
</header>

<div id="loading" style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0.7);height: 100%;left: 0;position: fixed;right: 0;text-align: center;top: 0;width: 100%;z-index: 9999;display: none;">
    <div style="width:100%;background: url('/assets/images/loading.gif') no-repeat scroll 0 0 / contain rgba(0, 0, 0, 0);bottom: 50%;height: 100px;left: 50%;position: relative;right: 50%;top: 50%;width: 100%;"></div>
</div>