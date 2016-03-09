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
                                        <p style="margin:0; margin-bottom: 10px; padding:0">
                                            Dear <?php echo $ownername ;?>,</p>
                                        <p style="margin:0; margin-bottom: 10px; padding:0">
                                            This email is with reference to order ID <?php echo $orderid; ?> for <?php echo $Customername ;?>.</p>
                                        <p style="margin:0; margin-bottom: 10px; padding:0">
                                            We would like to inform you that the buyer has placed an order from your store. Information regarding the same is below <br>
                                            <table style="border-collapse:collapse;border:1px solid black" border="1">
                                                <tr><th>Shipping Label</th><th>Product Invoice</th><th>Product Image</th></tr>
                                                <tr><td><a href = "<?php echo $shippingpartner; ?>" style="padding:2px;text-align:center;text-decoration:none"><input type="button" value="Download" /></a></td><td><a href = "<?php echo $filename1; ?>" style="padding:2px;text-align:center;text-decoration:none"><input type="button" value="Download" /></a></td><td><a href = "<?php echo $image; ?>" style="padding:2px;text-align:center;text-decoration:none"><input type="button" value="Download" /></a></td></tr>
                                            </table><br><br>
                                            <table style="border-collapse:collapse;border:1px solid black" border="1">
                                                <tr><th style="padding:2px;text-align:left">Order ID</th><td style="padding:2px;text-align:left"><?php echo $orderid; ?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Store Name</th><td style="padding:2px;text-align:left"><?php echo $storename; ?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Product Name</th><td style="padding:2px;text-align:left"><?php echo $productname ;?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Product Code</th><td style="padding:2px;text-align:left"><?php echo $productcode; ?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Payment Amount</th><td style="padding:2px;text-align:left"><?php echo $paymentAmount ;?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Payment Type</th><td style="padding:2px;text-align:left"><?php echo $paymentType; ?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Buyer Address</th><td style="padding:2px;text-align:left"><?php echo $BuyerAddress ;?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Buyer Contact No</th><td style="padding:2px;text-align:left"><?php echo $BuyerMobile; ?></td></tr>
                                                <tr><th style="padding:2px;text-align:left">Processing Time</th><td style="padding:2px;text-align:left"><?php echo $ProcessingTime; ?> Working days</td></tr>
                                                <tr><th style="padding:2px;text-align:left">Estimated Dispatch Date</th><td style="padding:2px;text-align:left"><?php echo $Estimateddispatchtime; ?></td></tr>
                                            </table>
                                        <p style="margin:0; margin-bottom: 10px; padding:0">
                                            We'll send you another email if their is any update from buyer.</p>
                                        <p style="margin:0;margin-top:15px; margin-bottom: 10px; padding:0">
                                            To schedule a pick up,kindly send an email only to <a href ="mailto:ops@buynbrag.com"> ops@buynbrag.com </a> or call us on </p>
                                        <p style="margin:0;margin-top:15px; margin-bottom: 10px; padding:0">
                                            This is an auto-generated email. Do not reply.</p>

                                        <div style="padding:0;margin:0; margin-top:20px;">
                                                <p style="margin: 5px 0; padding: 0">Regards</p>
                                                <p style="margin: 0; padding: 0;"><strong>Operations Team</strong></p>
                                                <p style="margin: 0; padding: 0;">BuynBrag.com</p>
                                        </div>
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
                                                        <br>BuynBrag and the BuynBrag logo are trademarks of Social Scientist e-Commerce Pvt. Ltd.
                                                        <!--<br><br>To unsubscribe, <a href="" style="color:#002398" target="_blank">click here</a>-->
                                                    </font>
                                                </p>
                                            </td>
                                            <td style="font:14px/1.4285714 Arial,sans-serif;padding:0;text-align:right;width:100px">
                                                <a href="http://buynbrag.com" style="color:#3b73af;text-decoration:none" target="_blank">
                                                    <img width="150" height="50" src="http://buynbrag.com/application/views/dist/images/404_logo.png" alt="BuynBrag">
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