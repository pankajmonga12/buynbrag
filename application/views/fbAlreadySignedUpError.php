<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Error signing-up. Already signed-up.</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/application/views/dist/styles/vendor.css" />
    <link rel="stylesheet" type="text/css" href="/application/views/app/styles/main.css" />
    <link href="<?php echo $baseURL; ?>favicon.ico" rel="shortcut icon" type="image/ico"/>
</head>
<body id="midSection" class="container error404Page">
    <div class="span8 offset2">
        <h1>It appears that you forgot something!</h1>
        The account you are trying to sign-up with <h3 class="bnbRedFont">already exists</h3>.

        <div class="errorMsg">We already have an account associated with the email address <em><?php echo $userEmailAddress; ?></em> since <?php echo $userDOJ; ?>.</div>

        <div class="contactUsContainer row">
            <div class="span4">
                <h4><a href="<?php echo $baseURL."fbLogin/index"; ?>"><button class="btn btn-red">Login with your existing Account</button></a></h4>
                
            </div>
            <!-- <div class="span4">
                <h4>To sign-up with a new account again, follow the instruction below:</h4>
                <ul>
                    <li>Open <a href="http://www.facebook.com/" target="_blank">www.facebook.com</a> and logout from your facebook account associated with email address <em><?php echo $userEmailAddress; ?></em> 
                    and then click the button below.</li>
                    <li><a href="<?php echo $baseURL."fbLogin/index"; ?>"><button class="btn btn-blue">Sign-up with facebook</button></a></li>
                </ul>
            </div> -->
        </div>
    </div>
</body>
</html>