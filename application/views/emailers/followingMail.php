<div>
    <div style="overflow: hidden;">
        <div style="font:14px/1.4285714 Arial,sans-serif;color:#333">
            <table style="width:100%;border-collapse:collapse">
                <tbody>
                <tr>
                    <td style="font:14px/1.4285714 Arial,sans-serif;padding:10px 10px 0;background:#f5f5f5; margin-left: auto; margin-right: auto;">

                        <table style="width:100%;border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:0">
                                    <div style="background:#fff;border:1px solid #ccc;border-radius:5px;padding:20px">

                                        <table style="width:100%;border-collapse:collapse">
                                            <tbody>

                                            <tr>
                                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:0">
                                                    <p style="margin-bottom:10px;margin-top:0">
                                                        Yay!!! <strong><?php echo $followerFullName; ?></strong> just started following your curation.
                                                    </p>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <table style="width:100%;border-collapse:collapse">
                                            <tbody>

                                                <tr>
                                                    <td width="10%" style="padding: 14px 12px 0 12px;vertical-align:top">
                                                        <a target="_blank" href="http://buynbrag.com/profile/fancy/<?php echo $followerID; ?>">
                                                            <img width="75" height="75" src="<?php echo $profileImageSrc; ?>" style="border:0">
                                                        </a>
                                                    </td>

                                                    <td style="padding:14px 12px 0 12px;vertical-align:top">

                                                        <div style="display:inline-block;max-width:200px;min-width:200px;padding-right:12px;vertical-align:middle">
                                                            <div style="overflow:hidden;text-overflow:ellipsis">
                                                                <a target="_blank" style="color:#262626;font:15px arial,bold;text-decoration:none;font-weight:bold;" href="http://buynbrag.com/profile/fancy/<?php echo $followerID; ?>"><?php echo $followerFullName; ?></a>
                                                            </div>
                                                            <?php
                                                            /*
                                                            if($commonFollowersCount > 0)
                                                            {
                                                                ?>
                                                                <div style="color:#727272;font:12px arial,normal;margin:7px 0 5px;overflow:hidden;text-overflow:ellipsis"><?php echo $commonFollowersCount; ?> followers in common</div>

                                                                <div>
                                                                    <?php
                                                                    if($commonFollowersCount >= 1)
                                                                    {
                                                                        $img1Src = NULL;
                                                                        if(strcmp($commonFollowers[0]->followerFBID, 'non-fb-member') === 0)
                                                                        {
                                                                            if(strcmp($commonFollowers[0]->followerGender, 'male') === 0)
                                                                            {
                                                                                $img1Src = "http://buynbrag.com/assets/images/default/male.png";
                                                                            }
                                                                            else
                                                                            {
                                                                                $img1Src = "https://buynbrag.com/assets/images/default/female.png";
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            $img1Src = "https://graph.facebook.com/".$commonFollowers[0]->followerFBID."/picture?width=30&height=30";
                                                                        }
                                                                        ?>
                                                                        <div style="display:inline-block;margin:0 1px">
                                                                            <a target="_blank" href="http://buynbrag.com/profile/fancy/<?php echo $commonFollowers[0]->followerID; ?>">
                                                                                <img width="28" height="28" src="<?php echo $img1Src; ?>" style="border:0">
                                                                            </a>
                                                                        </div>
                                                                        <?php
                                                                    }

                                                                    if($commonFollowersCount >= 2)
                                                                    {
                                                                        $img1Src = NULL;
                                                                        if(strcmp($commonFollowers[1]->followerFBID, 'non-fb-member') === 0)
                                                                        {
                                                                            if(strcmp($commonFollowers[1]->followerGender, 'male') === 0)
                                                                            {
                                                                                $img1Src = "http://buynbrag.com/assets/images/default/male.png";
                                                                            }
                                                                            else
                                                                            {
                                                                                $img1Src = "https://buynbrag.com/assets/images/default/female.png";
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                            $img1Src = "https://graph.facebook.com/".$commonFollowers[1]->followerFBID."/picture?width=30&height=30";
                                                                        }
                                                                        ?>
                                                                        <div style="display:inline-block;margin:0 1px">
                                                                            <a target="_blank" href="http://buynbrag.com/profile/fancy/<?php echo $commonFollowers[1]->followerID; ?>">
                                                                                <img width="28" height="28" src="<?php echo $img1Src; ?>" style="border:0">
                                                                            </a>
                                                                        </div>
                                                                        <?php
                                                                    }

                                                                    if($commonFollowersCount >= 3)
                                                                    {
                                                                        if($commonFollowersCount === 3)
                                                                        {
                                                                            $img1Src = NULL;
                                                                            if(strcmp($commonFollowers[2]->followerFBID, 'non-fb-member') === 0)
                                                                            {
                                                                                if(strcmp($commonFollowers[2]->followerGender, 'male') === 0)
                                                                                {
                                                                                    $img1Src = "http://buynbrag.com/assets/images/default/male.png";
                                                                                }
                                                                                else
                                                                                {
                                                                                    $img1Src = "https://buynbrag.com/assets/images/default/female.png";
                                                                                }
                                                                            }
                                                                            else
                                                                            {
                                                                                $img1Src = "https://graph.facebook.com/".$commonFollowers[2]->followerFBID."/picture?width=30&height=30";
                                                                            }
                                                                            ?>
                                                                            <div style="display:inline-block;margin:0 1px">
                                                                                <a target="_blank" href="http://buynbrag.com/profile/fancy/<?php echo $commonFollowers[2]->followerID; ?>">
                                                                                    <img width="28" height="28" src="<?php echo $img1Src; ?>" style="border:0">
                                                                                </a>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                            <div style="display:inline-block;margin:0 1px">
                                                                                <a target="_blank" href="http://buynbrag.com/profile/fancy/<?php echo $followerID; ?>">
                                                                                    +<?php echo ($commonFollowersCount - 2); ?> more
                                                                                </a>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <?php
                                                            }*/
                                                            ?>
                                                        </div>

                                                        <div width="10%" style="font: 12px/1.4285714 Arial,sans-serif;padding:0;padding-top:6px;vertical-align:top">
                                                            Member Since <?php echo $memberSince; ?><br/>
                                                            <?php echo $followersCount;?> Followers<br/>
                                                            <?php echo $followingCount;?> Following
                                                        </div>

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <table style="width:100%;border-collapse:collapse">
                                            <tbody>

                                                <tr>
                                                    <td style="font:14px/1.4285714 Arial,sans-serif;padding:10px 12px;">
                                                        <table style="width:auto;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font:14px/1.4285714 Arial,sans-serif;padding:0">
                                                                        <table style="width:auto;border-collapse:collapse">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="font:13px/1.4285714 Arial,sans-serif;">
                                                                                        <!--<a href="" style="color:white;text-decoration:none;font-weight:bold;padding:7px 10px;display: inline-block;border:1px solid #0064bd;border-radius:1px;background:#0069c8;margin-right: 10px;" target="_blank">View profile</a>-->
                                                                                        <a href="http://buynbrag.com/profile/fancy/<?php echo $followerID; ?>" style="color:white;text-decoration:none;font-weight:bold;padding:6px 15px;display: inline-block;border:1px solid #0064bd;border-radius:1px;background:#0069c8;" target="_blank">Follow <?php echo $followerFullName; ?></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:5px 0 20px 0;color:#707070">
                                    <table style="width:100%;border-collapse:collapse">
                                        <tbody>
                                        <tr>
                                            <td style="font:14px/1.4285714 Arial,sans-serif;padding:0">
                                                <p style="margin:0">
                                                    <font face="Arial, Helvetica, San Serif" color="#666666" size="1">
                                                        <br>Copyright &copy; 2013 Social Scientist e-Commerce Pvt. Ltd. All Rights Reserved.
                                                        <br>Designated trademarks and brands are the property of their respective owners.
                                                        <br>BuynbBrag and the BuynbBrag logo are trademarks of Social Scientist e-Commerce Pvt. Ltd.
                                                        <!--<br><br>To unsubscribe, <a href="" style="color:#002398" target="_blank">click here</a>-->
                                                    </font>
                                                </p>
                                            </td>
                                            <td style="font:14px/1.4285714 Arial,sans-serif;padding:0;text-align:right;width:100px">
                                                <a href="http://buynbrag.com" style="color:#3b73af;text-decoration:none" target="_blank">
                                                    <img width="150" height="50" src="http://buynbrag.com/application/views/dist/images/404_logo.png" alt="BuynbBrag">
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
