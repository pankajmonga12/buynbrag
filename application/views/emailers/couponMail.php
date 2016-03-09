
<div>
    <div style="overflow: hidden;">
        <div style="font:14px/1.4285714 Arial,sans-serif;color:#333">
            <table style="width:100%;border-collapse:collapse">
                <tbody>
                <tr>
                    <td style="font:14px/1.4285714 Arial,sans-serif;padding:10px;background:#f5f5f5">

                        <table style="width:100%;border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:0">
                                    <div style="background:#fff;border:1px solid #ccc;border-radius:5px;padding:20px">
                                        <table style="width:100%;border-collapse:collapse">
                                            <tbody>

                                            <tr>
                                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:0;">
                                                    <p style="margin-bottom:15px;margin-top:0">
                                                        Dear <strong><?php echo $userFullName; ?></strong>,
                                                    </p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:0">
                                                    <p style="margin-bottom:15px;margin-top:0">
                                                        Thanks for signing up on <strong>BuynBrag.com</strong>. Here is your welcome voucher.
                                                    </p>
                                                </td>
                                            </tr>



                                            <div class="couponsTableContainer">

                                                <table style="font-size: 14px;background: #fff;border: 1px solid #dddddd;border-collapse: separate;border-radius: 4px;width: 100%;border-spacing: 0;">
                                                    <thead>
                                                    <tr>
                                                        <th style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;">Coupon code</th>
                                                        <th style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-left: 1px solid #dddddd;">Issued on</th>
                                                        <th style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-left: 1px solid #dddddd;">Valid till</th>
                                                        <th style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-left: 1px solid #dddddd;">Coupon Value</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr>
                                                        <td style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-top: 1px solid #dddddd;"><?php echo $couponCode; ?></td>
                                                        <td style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-left: 1px solid #dddddd;border-top: 1px solid #dddddd;"><?php echo date("F j, Y", $validFrom); ?></td>
                                                        <td style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-left: 1px solid #dddddd;border-top: 1px solid #dddddd;"><?php echo date("F j, Y", $validTill); ?></td>
                                                        <td style="padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-left: 1px solid #dddddd;border-top: 1px solid #dddddd;"><?php echo $couponValue; ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <tr>
                                                <td style="font:10px/1.4285714 Arial,sans-serif;padding:0">
                                                    <p style="margin-bottom:5px;margin-top:15px">
                                                        * Coupon subject to minimum cart value.
                                                    </p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:20px 0;color:#707070">
                                    <table style="width:100%;border-collapse:collapse">
                                        <tbody>
                                        <tr>
                                            <td style="font:14px/1.4285714 Arial,sans-serif;padding:0;text-align:left;">
                                                <p style="margin: 5px 0; padding: 0">Your Sincerely</p>
                                                <p style="margin: 0; padding: 0;"><strong>Prithvi Raj Tejavath</strong></p>
                                                <p style="margin: 0; padding: 0;">Co-Founder, BuynBrag.com</p>
                                            </td>
                                            <td style="font:14px/1.4285714 Arial,sans-serif;padding:0;text-align:right;width:100px">
                                                <a href="http://buynbrag.com" style="color:#3b73af;text-decoration:none" target="_blank" wotsearchprocessed="true">
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