<?php if (!defined('BASEPATH')) exit('Direct Script Access not allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>orders csv list</title>
</head>
<body>
<table>
    <tr>
        <td><input type="text" id="fromOrderNumber" placeholder="Start Order Number"></td>
        <td><input type="text" id="toOrderNumber" placeholder="End Order Number"></td>
        <td><input type="button" id="getOrderButton" value="Get Orders as CSV"></td>
    </tr>
    <tr>
        <td colspan="3">
            <a href="<?php echo $baseURL; ?>index.php/crm"> CRM Home </a>
        </td>
</table>
<script type="application/javascript" src="<?php echo $baseURL ?>assets/js/jquery-1.9.0.min.js"></script>
<script type="application/javascript" src="<?php echo $baseURL ?>assets/js/jquery-migrate-1.9.0.min.js"></script>
<script type="application/javascript">
    //<!--
    jQuery(document).ready(function () {
        jQuery('#getOrderButton').on('click', function () {
            var startOrder = jQuery('#fromOrderNumber').val();
            var endOrder = jQuery('#toOrderNumber').val();
            if (startOrder >= 0 && endOrder >= 0 && endOrder > startOrder) {
                console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/getCSV/' + startOrder + '/' + endOrder);
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/getCSV/' + startOrder + '/' + endOrder;
            }
        });
    });
    //-->
</script>
</body>
</html>