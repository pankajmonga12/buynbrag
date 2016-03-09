<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"><![endif]--> <!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]--> <!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"><![endif]--> <!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Seller Landing Page</title>
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" type="text/css" href="/application/views/dist/styles/vendor.css" />
    <link rel="stylesheet" type="text/css" href="/application/views/app/styles/main.css" />

    <script type="text/javascript" src="/application/views/app/scripts/vendor/jquery.min.js"></script>

</head>

<body>

<div id="midSection" class="container loginPage">

    <div class="userLoginContainer">

        <form id="login" method="post" action="<?php echo $base_url;?>index.php/login/getMeLoggedIn" enctype="multipart/form-data" name="sellerLoginForm">

            <fieldset>
                <legend>Seller Sign in</legend>

                <div class="input-prepend block">
                    <span class="add-on">Email Address</span>
                    <input type="text" id="login_username" name="login_username" placeholder="Your Email" style="height: 34px;">
                </div>

                <div class="input-prepend block">
                    <span class="add-on" style="width: 5.76em">Password</span>
                    <input type="password" id="login_pass" name="login_pass" placeholder="Your Password" style="height: 34px;">
                </div>

                <button id="sellerLoginButton" class="btn btn-primary block sellerLoginButton" type="submit" style="width: 310px;">Sign in</button>
            </fieldset>

        </form>

    </div>

</div>

<?php
//include "seller_login.php";
$this->load->view("footer");
?>
</body>
</html>