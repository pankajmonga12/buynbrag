<?php $row = $row[0];
$p_mode = $row['pg_type'];
?>
<table width="630" border="0">
    <tr>

        <td width="150" rowspan="5" valign="middle"><img src="<?php echo $base_url; ?>assets/<?php echo $p_mode; ?>.png"
                                                         width="150" alt="payment_mode"></td>
        <td height="40" colspan="2" align="right" valign="middle"><strong>Transaction ID:</strong></td>
        <td width="246" align="left" valign="middle"><strong><font
                    color="#CC0066"><?php echo $row['txnid']; ?></font></strong></td>
    </tr>
    <tr>
        <td height="40" colspan="2" align="right" valign="middle"><strong>Order Number:</strong></td>
        <td width="246" align="left" valign="middle"><strong><font
                    color="#CC5566"><?php echo $row['order_id']; ?></font></strong></td>
    </tr>
    <tr>
        <td height="40" colspan="2" align="right" valign="middle"><strong>Bank Reference No:</strong></td>
        <td width="246" align="left" valign="middle"><strong><font
                    color="#55CC66"><?php echo $row['bank_ref_num']; ?></font></strong></td>
    </tr>
    <tr>
        <td height="36" colspan="2" align="right" valign="middle"><strong>MIH Pay ID:</strong></td>
        <td width="246" align="left" valign="middle"><strong><font
                    color="#CC2266"><?php echo $row['mihpayid']; ?></font></strong></td>
    </tr>
    <tr>
        <td height="38" colspan="2" align="right" valign="middle"><strong>Coupon Code:</strong></td>
        <td width="246" align="left" valign="middle"><strong><font
                    color="#252266"><?php if (empty($row['couponid'])) echo 'N.A'; else echo $row['couponid']; ?></font></strong>
        </td>
    </tr>
    <tr>
        <td height="43" colspan="2" align="right" valign="middle">&nbsp;</td>
        <td width="219" align="right" valign="middle"><strong>Store Price:</strong></td>
        <td align="left" valign="middle"><font color="#147866"><?php echo $row['quantity'] * $row['amt_paid']; ?>
                .00</font></td>
    </tr>
    <tr>
        <td height="41" colspan="2" align="right" valign="middle">&nbsp;</td>
        <td align="right" valign="middle"><strong>Coupon Redemption:</strong></td>
        <td align="left" valign="middle"><font
                color="#365666"><?php echo intval($row['quantity'] * $row['amt_paid'] * ($row['redeemedprice'])); ?>
                .00</font></td>
    </tr>
    <tr>
        <td height="40" colspan="2" align="right" valign="middle">&nbsp;</td>
        <td align="right" valign="middle"><strong>Paid Price:</strong></td>
        <td align="left" valign="middle"><h2><font
                    color="#578966"><?php echo intval($row['quantity'] * $row['amt_paid'] * (1 - $row['redeemedprice'])); ?>
                    .00</font></h2></td>
    </tr>
</table>
