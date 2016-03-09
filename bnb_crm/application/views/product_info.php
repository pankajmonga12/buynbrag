<?php $row = $row[0]; ?>
<table width="630" border="1">
    <tr>

        <td width="171" rowspan="4" align="left" valign="top">
            <a href="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/<?php echo $row['product_id']; ?>/fancy1.jpg"
               target="_blank" onClick="prod_img(this.src, '<?php echo $row['product_name']; ?>'); return false;">
                <img
                    src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/<?php echo $row['product_id']; ?>/img1_171x171.jpg"
                    width="171" alt="product_image">
            </a>
        </td>
        <td width="164" height="34" align="right" valign="middle"><strong>Product ID:</strong></td>
        <td colspan="2" align="left" valign="middle"><strong><font
                    color="#000099"><?php echo $row['product_id']; ?></font></strong></td>
    </tr>
    <tr>
        <td height="37" align="right" valign="middle"><strong>Product Code:</strong></td>
        <td colspan="2" align="left" valign="middle"><strong><font
                    color="#990000"><?php echo $row['bnb_product_code']; ?></font></strong></td>
    </tr>
    <tr>
        <td height="50" align="right" valign="middle"><strong>Product Name:</strong></td>
        <td colspan="2" align="left" valign="middle"><strong><font
                    color="#009900"><?php echo $row['product_name']; ?></font></strong></td>
    </tr>
    <tr>
        <td height="38" align="center" valign="top">
            <?php if (!empty($row['vsize'])) : ?>
                <strong>Size : <font color="#FF0099"><?php echo $row['vsize']; ?></font></strong>
            <?php else: ?>
                <strong>Size : <font color="#FF0099">default</font></strong>
            <?php endif; ?>
        </td>
        <td colspan="2" align="center" valign="top"><?php if (!empty($row['vcolor'])) : ?>
                <strong>Color : <font color="#FF0099"><?php echo $row['vcolor']; ?></font></strong>
            <?php else: ?>
                <strong>Color : <font color="#FF0099">default</font></strong>
            <?php endif; ?></td>
    </tr>
    <tr>
        <td width="171" height="47" align="right" valign="middle"><strong>Actual Store Price:</strong></td>
        <td align="center" valign="middle"><strong><?php echo $row['selling_price']; ?>.00</strong></td>
        <td width="88" align="center" valign="middle"><strong> x <?php echo $row['quantity']; ?></strong></td>
        <td width="179" align="center" valign="middle"><strong><?php echo $row['selling_price'] * $row['quantity']; ?>
                .00</strong></td>
    </tr>
    <tr>
        <td height="46" align="right" valign="middle"><strong>Store Discount:</strong></td>
        <td align="center" valign="middle"><strong><?php echo $row['discount']; ?>.00</strong></td>
        <td align="center" valign="middle"><strong> x <?php echo $row['quantity']; ?></strong></td>
        <td align="center" valign="middle"><strong> - <?php echo $row['discount'] * $row['quantity']; ?>.00</strong>
        </td>
    </tr>
    <tr>
        <td height="47" align="right" valign="middle"><strong>Final Selling Price(store):</strong></td>
        <td align="center" valign="middle"><strong><?php echo $row['selling_price'] - $row['discount']; ?>.00</strong>
        </td>
        <td align="center" valign="middle"><strong> x <?php echo $row['quantity']; ?></strong></td>
        <td align="center" valign="middle"><strong>
                = <?php echo ($row['selling_price'] - $row['discount']) * $row['quantity']; ?>.00</strong></td>
    </tr>


</table>
