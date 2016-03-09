<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Personal Details</title>
	<meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/common1.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.ui.tabs.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.jscrollpane.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/friends_follower.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.ui.dialog.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sexy-combo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/store_owner_profile.css" />
    <!--[if IE]>
    <link type="text/css" rel="stylesheet" href="css/ie.css" />
    <![endif] -->
	<style>.pink{ color:#DA3C63;}

.follow_box{ width:1024px; min-width:100px; margin:auto; clear:both; overflow:hidden;}
.follow_pad{ padding:20px; width:470px; min-height:100px; float:left;}
.follow_img{ height:100px; width:100px; float:left;}
.follow_img img{height:100px; width:100px;}
.follow_side{ width:360px; min-height:100px; float:right;}
.follow_text{ width:230px;min-height:60px; font-family: rockwell; float:left; overflow:hidden;}
.follow_text h2{ color:#333;}
.follow_t{ color:#666; font-size:14px; }
.follow_c{ font-size:14px; margin:5px 0 0 0;color:#666}
.img_b{ float:left; height:40px; width:40px; margin:0 2px;}</style>
</head>
<body>_
	<?php include_once('header2.php'); ?>
<section class="wrapper">
  <article class="banner">
            <div class="slide">
            	<div class="topBanerPatternContainer"></div>
                <div class="bannerAuto">
                	<div class="owner_pic"><img src="<?php echo base_url(); ?>assets/images/users/<?php echo $logged_id; ?>/<?php echo $logged_id;?>_156X156.jpg" alt="Owner Pic" /></div>
                    <div class="bannerMid">
                    	<div class="owner_name"><?php echo strtoupper(strtolower($userinfo[0]->full_name));?></div>
                        <div class="merbershipDate">Member since <?php echo date("jS F Y ", strtotime($userinfo[0]->joined_date)) ;?></div>
                        <div class="badgesContainer">
                        	<?php if(isset($badges)): if(count($badges)> 3) $n = 3; else $n = count($badges); for($i=0; $i<$n ; $i++): ?> <img src="<?php echo $base_url.'assets/images/badges/'.$badges[$i]['img']?>" class="silverBadge" > <?php endfor; ?> 
                            <div class="pinkBadge"> <a href="<?php echo $base_url.'user_info/badges/'?>" ><div class="white_text">+<?php echo count($badges)-$n; ?></div></a> </div><?php endif; ?>       
                        </div>
                    </div>
                    <div class="bannerRight">
                    	
                    
                        <a href="<?php echo $base_url."order/user_fancy_product"; ?>"><div class="logoBox">
                        	<div class="iconFancy"></div>
                            <div class="logoNumber"><?php echo $countfprod; ?></div>
                            <div class="logoText">fancy</div>
                        </div></a>
                        <a href="<?php echo $base_url."index.php/poll/create_poll"; ?>" ><div class="logoBox borderRight">
                        	<div class="PollIconPlus"></div>
                            <div class="logoText">
                            	<div>Create</div>
                                <div>Poll</div>
                            </div>
                        </div></a>
                    </div>
                </div>
            </div>
    </article>
        <nav class="middleColumnTop">
            <div class="topDotSeparator newtopDotSeparator"></div> 
            <div class="linksMiddle">
            
                <a href="javascript:void(0)"><div class="dashboardLink linkWidth">
                    <div class="profileLogoClick"></div>
                    <div class="activeText">Profile</div>
                </div></a>
               
                <a href="<?php echo base_url(); ?>user_info/invite"><div class="productsLink">
                    <div class="inviteLogo2"></div>
                    <div class="productsText newPadding">Invite People</div>
                </div></a>
                <div class="purchaseHistory">
            
                 <a href="<?php echo base_url(); ?>user_info/follow_followers">   <div class="purchaseText1"><span class="pink"><?php echo count($followers);?></span> Followers</div></a>
                 <a href="<?php echo base_url(); ?>user_info/follow_following">     <div class="purchaseText1"><span class="pink"><?php echo count($followees);?></span> Following</div></a>
    			</div>
            </div> 
          
        </nav>
		
      <div class="middleBackground" >
      <div class="follow_box">
	  <?php foreach($followers as $f) { $user_id=$f['user_id']; ?>
      <div class="follow_pad">
      <div class="follow_img">
      <a class="peopleImg" href="<?php echo base_url(); ?>order/friend_fancy_product/<?php echo $user_id;?>"><img src="<?php echo base_url();?>assets/images/users/<?php echo $user_id;?>/<?php echo $user_id;?>.jpg"/></a>
      </div>
      <div class="follow_side">
      <div style="overflow:hidden;">
      <div class="follow_text">
      <h2><?php print $f['full_name'];?></h2>
      <div class="follow_t"><?php $count_followers=$this->search_model->count_followers($user_id); print $count_followers; ?> Followers &nbsp;<?php $count_following=$this->friends_follow_model->count_following($user_id); print $count_following; ?> Following </div>
      <div class="follow_c"> Rank <?php $r=$this->search_model->get_rank($user_id); print $r->rank; ?>&nbsp;,Fancy <?php $cfprod=$this->search_model->cfprod($user_id); print $cfprod; ?> </div>
      </div>
      <div style="float:right;"><form method="post" action="<?php echo base_url();?>user_info/view/<?php echo $user_id; ?>"><input type="submit" name="btn_fnf" class="followUserButton" value = "Follow" /></form></div>
      </div>
      <div><?php $prod_id=$this->search_model->prod_id($user_id);
								      foreach($prod_id as $prod)
									  {
									     $product_id= $prod->product_id;
										 $store_id=$this->search_model->store_id($product_id);
										 $store= $store_id->store_id;
										 $prod_img = "http://buynbragstores.s3.amazonaws.com/assets/images/stores/" . $store . "/" . $product_id . "/";   ?>
	  
      <img src="<?php echo $prod_img;?>img1_97x80.jpg" class="img_b"/>
       <?php } ?>
          
      </div>
      </div>
      </div>
      
      
      <?php } ?>
      
      
      
      </div>
      
      </div> 
    </section>
    <?php include "friends_follower.php" ?>
    <?php include "footer.php" ?> 
</body>
<script src="<?php echo base_url(); ?>js/friend_follower.js"></script>
<script src="<?php echo base_url(); ?>js/store_owner.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.jscrollpane.js"></script>
</html>
