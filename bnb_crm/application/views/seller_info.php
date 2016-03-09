<?php $row = $row[0]; ?>
<table width="500" border="1">
    <tr>
        <td colspan="2" align="center"><img
                src="https://s3-ap-southeast-1.amazonaws.com/buynbragstores/assets/images/stores/<?php echo $row['store_id']; ?>/top_banner.png"
                width="480" alt="store_banner"></td>
    </tr>
    <tr>
        <td width="211" align="right" valign="top"><p><strong>Store ID:</strong></p>

            <p><strong><font color="#330033"><?php echo $row['store_id']; ?></font></strong></p></td>
        <td width="273" align="center"><strong><u>Seller Name</u><br><font
                    color="#990066"><?php echo $row['contact_name']; ?></font></strong></td>
    </tr>
    <tr>
        <td align="right" valign="top"><p><strong>Store Name:</strong></p>

            <p><strong><font color="#006600"><?php echo $row['store_name']; ?></font></strong></p></td>
        <td align="center"><font color="#333399"><?php echo $row['contact_email']; ?>,<br>
                <?php echo $row['contact_number']; ?></font></td>
    </tr>
    <tr>
        <td align="right" valign="top"><p><strong>Marketing Name:</strong></p>

            <p><strong><font color="#006600"><?php echo $row['marketing_name']; ?></font></strong></p></td>
        <td align="center" valign="top"><font color="#000033">
                <?php echo $row['communication_address']; ?>,<br>
                <?php echo $row['communication_city']; ?> - <?php echo $row['communication_pincode']; ?><br>
                <?php echo $row['communication_state']; ?> : <?php echo $row['communication_country']; ?>
            </font></td>
    </tr>
    <tr>
        <td align="right" valign="top"><p><strong>Company Code:</strong></p>

            <p><strong><font color="#FF0000"><?php echo $row['company_code']; ?></font></strong></p></td>
        <td align="center" valign="top"><p><strong><u>Return Address:</u></strong><Br>
                <font color="#000033"><?php echo $row['return_address']; ?>,<br>
                    <?php echo $row['return_city']; ?> - <?php echo $row['return_pincode']; ?><br>
                    <?php echo $row['return_state']; ?> : <?php echo $row['return_country']; ?> </font></p></td>
    </tr>
</table>
