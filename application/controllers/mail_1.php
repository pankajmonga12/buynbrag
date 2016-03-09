<?php
$msg = '<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Mailer</title>
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
        @font-face {font-family:gill; src:url("http://www.buynbrag.com/assets/email/rock.ttf");}
        input[type="text"], textarea, select {
          outline: none;
        }
        a{
            text-decoration:none;    
        }
        a:link,a:visited{color:#fff;}
        a:hover,a:active{color:#E81C4D;}
        body {
            
        }
        
        * {
              
               outline:none;
        }
        
        img {
               border:0px solid;
        }
    
        
    </style>
</head>
<body>
    <div style="margin:0 auto;width:600px;height:auto;">
        <div style="width:100%;height:122px;background-image:url(http://www.buynbrag.com/assets/email/header_2.png);background-repeat:repeat-x;">
            <div style="width:221px;height:96px;background-image:url(http://www.buynbrag.com/assets/email/logo.png);background-repeat:no-repeat;margin-left:20px;float:left;"></div>
            <div style="float:left;padding-left:8px;">
                <div style="font-family:gill;font-size:26px;color:#fff;padding-top:20px;padding-bottom:10px;">Welcome to BuynBrag.com</div>
                <div style="font-family:gill;font-size:20px;color:#fff;padding-left:5px;">' . $name . '</div>
            </div>
        </div>
        <div style="width:100%;height:5px;background-image:url(http://www.buynbrag.com/assets/email/header_dots_1.png);background-repeat:repeat-x;position:relative;z-index:100;"></div>
        <div style="width:100%;height:auto;padding-bottom:30px;background-image:url(http://www.buynbrag.com/assets/email/center_1.png);background-repeat:repeat;margin-top:-5px;"> 
            <div style="clear:both;font-family:gill;font-size:18px;padding:20px 10px 20px 30px;color:#5a5a5a;">
                You are the newest member of BuynBrag, your destination for all things 
                hard-to-find!<div style="padding-top:8px;">
                We&#39;ve taken great care and handpicked things that we thought had 
                character and a story  to them.  So that they can add to your story.</div>
                <div style="padding-top:8px;">
                And we&#39;ve packed in a whole bunch of things you can do as you browse 
                and wait to get hooked.</div>
            </div> 
            <a href="' . $base_url . 'order/user_fancy_product">
            <div style="width:260px;height:325px;float:left;padding-left:26px;">
                <div style="width:261px;height:230px;background:#fff;">
                    <img src="http://www.buynbrag.com/assets/email/image_1.png" style="margin:3px 3px -2px 3px;" />
                    <div style="background:#d2d2d2;width:255px;height:50px;padding-top:6px;margin-left:3px;">
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/heart.png);background-repeat:no-repeat;width:43px;height:35px;float:left;margin-left:7px;
margin-top:5px;"></div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/fancy_icon.png);background-repeat:no-repeat;width:45px;height:45px;float:left;margin-left:6px;"></div>
                        <div style="font-family:gill;font-size:28px;color:#333;text-shadow:0px 1px 0px #fff;float:left;margin-left:6px;margin-top:5px;">FANCY</div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/heart.png);background-repeat:no-repeat;width:43px;height:35px;float:left;margin-left:7px;
margin-top:5px;"></div>
                    </div>
                </div> 
                <div style="font-family:gill;font-size:18px;color:#5a5a5a;padding-top:5px;">Your list of things you love.<div>If you like it,  put a &#39;crown&#39; on it. 
Don&#39;t be shy ;)</div></div>
            </div></a>
            <a href="' . $base_url . 'index.php/poll/poll_page"><div style="width:260px;height:325px;float:left;padding-left:26px;">
                <div style="width:261px;height:230px;background:#fff;">
                    <img src="http://www.buynbrag.com/assets/email/image_2.png" style="margin:3px 3px -2px 3px;"  />
                    <div style="background:#d2d2d2;width:255px;height:50px;padding-top:6px;margin-left:3px;">
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/left.png);background-repeat:no-repeat;width:49px;height:45px;float:left;margin-left:9px;"></div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/poll.png);background-repeat:no-repeat;width:45px;height:45px;float:left;margin-left:7px;"></div>
                        <div style="font-family:gill;font-size:28px;color:#333;text-shadow:0px 1px 0px #fff;float:left;margin-left:6px;margin-top:5px;">POLL</div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/right.png);background-repeat:no-repeat;width:49px;height:45px;float:left;margin-left:13px;"></div>
                    </div>
                </div> 
                <div style="font-family:gill;font-size:18px;color:#5a5a5a;padding-top:5px;">A little confusion is kind of  sexy, so ask your friends for their opinion when you&#39;re stuck</div> 
            </div> </a>
            <a href="' . $base_url . 'homepage">
            <div style="height:290px;clear:both;width:260px;height:325px;float:left;padding-left:26px;">
                <div style="width:261px;height:230px;background:#fff;">
                    <img src="http://www.buynbrag.com/assets/email/image_3.png" style="margin:3px 3px -2px 3px;" />
                    <div style="background:#d2d2d2;width:255px;height:50px;padding-top:6px;margin-left:3px;">
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/facebook.png);background-repeat:no-repeat;width:40px;height:40px;float:left;margin-left:10px;"></div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/brag.png);background-repeat:no-repeat;width:45px;height:45px;float:left;margin-left:13px;"></div>
                        <div style="font-family:gill;font-size:28px;color:#333;text-shadow:0px 1px 0px #fff;float:left;margin-left:6px;margin-top:5px;">BRAG</div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/twitter.png);background-repeat:no-repeat;width:42px;height:42px;float:left;margin-left:15px;"></div>
                    </div>
                </div> 
                <div style="font-family:gill;font-size:18px;color:#5a5a5a;padding-top:5px;">Your button to spread the love on to Facebook</div>
            </div>
            </a>
            <a href="' . $base_url . 'user_info/badges">
            <div style="width:260px;height:290px;float:left;padding-left:26px;">
                <div style="width:261px;height:230px;background:#fff;">
                    <img src="http://www.buynbrag.com/assets/email/image_4.png"  style="margin:3px 3px -2px 3px;" />
                    <div style="background:#d2d2d2;width:255px;height:50px;padding-top:6px;margin-left:3px;">
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/badge.png);background-repeat:no-repeat;width:32px;height:53px;float:left;margin-left:8px;
margin-top:-6px;"></div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/badges_icon.png);background-repeat:no-repeat;width:45px;height:45px;float:left;margin-left:7px;"></div>
                        <div style="font-family:gill;font-size:28px;color:#333;text-shadow:0px 1px 0px #fff;float:left;margin-left:6px;margin-top:5px;">BADGES</div>
                        <div style="background-image:url(http://www.buynbrag.com/assets/email/badge.png);background-repeat:no-repeat;width:32px;height:53px;float:left;margin-left:8px;margin-top:-6px;"></div>
                    </div>
                </div> 
                <div style="font-family:gill;font-size:18px;color:#5a5a5a;padding-top:5px;">A little somethin&#39;- somethin&#39; for your social cred ;)</div> 
            </div> 
            </a>
            <div style="font-family:gill;font-size:18px;color:#333;text-shadow:0px 1px 0px #fff;clear:both;padding-top:5px;padding-bottom:5px;text-align:center;">So get on there, browse, discover and tell us what you think.</div> 
            <div style="font-family:gill;font-size:18px;color:#333;padding-bottom:15px;text-shadow:0px 1px 0px #fff;text-align:center;">We&#39;re all about the conversation!</div> 
            <div style="font-family:gill;font-size:25px;color:#e81c4d;text-align:center;padding-bottom:5px;">Happy Discovering!</div> 
            <div style="font-family:gill;font-size:18px;color:#e81c4d;text-align:center;padding-bottom:5px;">The BuynBrag Team</div> 
        </div>  
        <div style="width:100%;height:70px;background-image:url(http://www.buynbrag.com/assets/email/footer_1.png);background-repeat:repeat-x;margin-top:-3px;">
            <div style="font-family:gill;font-size:15px;color:#5a5a5a;text-align:center;padding-top:12px;padding-bottom:3px;">Available now on Web :<span style="color:#fff;"><a href="http://www.buynbrag.com">www.buynbrag.com</a></span></div>
            <div style="font-family:gill;font-size:13px;color:#fff;padding:12px 0 0 30px;">
                <div style="float:left;"><a href="https://twitter.com/BuynBrag">Follow on Twitter</a> <span style="color:#4b4b4b;">|</span> <a href="https://www.facebook.com/Buynbrag">Like on Facebook</a></div>
                <div style="float:left;color:#727272;padding-left:65px;">Copyright &copy; 2012 Social Scientist E-Commerce Pvt Ltd. All rights reserved</div>
            </div>
        </div>
    </div>
</body>
</html>';
//echo $msg;
?>