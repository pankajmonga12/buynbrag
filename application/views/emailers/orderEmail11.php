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
                                        <p style="margin:0; margin-bottom: 10px; padding:0">Dear <?php echo $storeOwnerName; ?>,</p>
                                        With reference to order <b><?php echo $orderID; ?></b> with dispatch date <?php echo $dispatchDate; ?>, our records
                                        indicate that you have not accepted this order in your back end portal.
                                        <p style="margin:0;margin-top:5px; margin-bottom: 10px; padding:0">We request you to immediately <a href="<?php echo $baseURL."login/seller"; ?>">log in</a> with your user id <em><?php echo $storeOwnerEmail; ?></em> and password
                                            <em>bnbseller99</em> and click on <em>Start Processing</em>.
                                        </p>
                                        <p style="margin:0;margin-top:5px; margin-bottom: 10px; padding:0">To schedule a pick up, kindly send an email only to
                                            <a href="mailto:ops@buynbrag.com" target="_top">ops@buynbrag.com</a>.
                                        </p>
                                        <p style="margin:0;margin-top:5px; margin-bottom: 10px; padding:0">
                                            <strong>Order information:</strong>
                                        </p>

                                        <p style="margin: 0; margin-bottom: 5px;">Order ID : <?php echo $orderID; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Store name : <?php echo $storeName; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Product : <?php echo $productName; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Product code : <?php echo $productID.' - '.$bnbProductCode; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Payment amount : <?php echo $amountPaid; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Payment type : <?php echo $paymentType; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Buyer name : <?php echo $buyerName; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Buyer address : <?php echo $buyerAddress; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Buyer contact no. : <?php echo $buyerContactNumber; ?></p>
                                        <p style="margin: 0; margin-bottom: 5px;">Processing time : <?php echo $processingTime; ?> working days</p>
                                        <p style="margin: 0; margin-bottom: 5px;">Estimated dispatch date : <?php echo $dispatchDate; ?></p>

                                        <p style="margin:0;margin-top:15px; margin-bottom: 10px; padding:0">
                                            This is an auto-generated message. Please do not reply to this email.
                                        </p>

                                        <div style="padding:0;margin:0; margin-top:20px;">
                                                <p style="margin: 5px 0; padding: 0">Regards</p>
                                                <p style="margin: 0; padding: 0;"><strong>Operations team</strong></p>
                                                <p style="margin: 0; padding: 0;">BuynBrag.com</p>
                                                <p style="margin: 0; padding: 0;">Contact no : +91-8130 878 822</p>
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
                                                        <br>BuynbBrag and the BuynbBrag logo are trademarks of Social Scientist e-Commerce Pvt. Ltd.
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