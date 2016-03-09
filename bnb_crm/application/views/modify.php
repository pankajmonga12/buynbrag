<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Buyer</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url ?>assets/css/common.css"/>
    <script type="text/javascript" src="<?php echo $base_url ?>assets/js/jquery-1.7.2.min.js"></script>
</head>

<body>
<div class="wrapper">
    <div class="bigLabel">Modify Order</div>
    <div class="labeldetails">
        <div class="smallLabel">Store Name</div>
        <input type="text" name="store_name" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['store_name']; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Product Code</div>
        <input type="text" name="product_code" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['bnb_product_code']; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Product Category</div>
        <input type="text" name="product_cat" class="text_field buyer" disabled="disabled"
               value="<?php #echo $order_details ;?>"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Product Type</div>
        <input type="text" name="product_type" class="text_field buyer" disabled="disabled"
               value="<?php #echo $order_details ;?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Product Cost</div>
        <input type="text" name="product_cost" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['selling_price']; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Mode of Payment</div>
        <input id="payment_mode" type="text" name="modeofpayment" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['pg_type']; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Shipping Address</div>
        <input id="shipping_address" type="text" name="shipping_ad" class="text_field buyer" disabled="disabled"
               style="width: 498px;" value="<?php echo trim($order_details['shipping_address']); ?>"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Shipping City</div>
        <input id="shipping_city" type="text" name="billing_add" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['shipping_city']; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Shipping State</div>
        <input id="shipping_state" type="text" name="billing_add" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['shipping_state']; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Shipping Country</div>
        <input id="shipping_country" type="text" name="billing_add" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['shipping_country']; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Shipping Pincode</div>
        <input id="shipping_pincode" type="text" name="billing_add" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['shipping_pincode']; ?>"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Date of Order Placed</div>
        <input type="text" name="date_of_order_placed" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['date_of_order']; ?>"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Expected Date of Delivery</div>
        <input type="text" name="expected_delivery" class="text_field buyer" disabled="disabled"
               value="<?php $processing_time = (int)$order_details['processing_time'] + 10;
               echo $processing_time . ' days from date of order'; ?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Date of Order Delivered</div>
        <input type="text" name="date_of_order_delivered" class="text_field buyer" disabled="disabled"
               value="<?php #echo $order_details ;?>"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Logistics Provider</div>
        <input type="text" name="logistics" class="text_field buyer" disabled="disabled"
               value="<?php echo $order_details['shipping_partner']; ?>"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">AWB Number</div>
        <input type="text" name="awb_no" class="text_field buyer" disabled="disabled"
               value="<?php #echo $order_details ;?>"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Order status</div>
        <select class="firstdrop buyer" id="ord_st" disabled="disabled">
            <option selected="selected"
                    value="<?php echo $val; ?>"><?php echo $order_details['status_order']; ?></option>
            <option value="2">In Process</option>
            <option value="3">Shipping</option>
            <option value="4">Completed</option>
            <option value="5">Cancel Order</option>
            <option value="6">Problem with Order</option>
        </select>
    </div>
    <div class="labeldetails hideit" id="cancelled">
        <div class="smallLabel">Cancel Reason</div>
        <select class="firstdrop">
            <option selected="selected">Cancelled Order COD</option>
            <option>Pre Delivery Refund Prepaid</option>
            <option>7 Day Refund Prepaid</option>
            <option>7 Day Refund COD</option>
            <option>7 Day Replacement Prepaid</option>
            <option>7 Day Replacement COD</option>
            <option>No Replacement Available</option>
            <option>Product Not Available</option>
        </select>
    </div>
    <div class="labeldetails height76 clear_both">
        <div class="smallLabel">Buyer Seller Communication Logs</div>
        <textarea type="text" name="comm_logs" class="buyer" disabled="disabled"></textarea>
    </div>
    <div class="labeldetails height76 paddingRight0">
        <div class="smallLabel">Bnb Remarks</div>
        <textarea type="text" name="bnb_remarks" class="buyer" disabled="disabled"></textarea>
    </div>
    <div class="clear_both">
        <input type="button" value="Make Changes" id="make_changes" class="make_changes"/>
        <input type="button" class="modify_btn" value="Save Changes" onclick="return save_orders();"/>
        <input type="button" class="go_back" value="Go Back"
               onClick="window.location.href='javascript:history.back();'"/>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function () {
        $('#ord_st').change(function () {
            $('#' + $(this).val()).show();
        });
        $('#make_changes').click(function () {
            $('.buyer').attr('disabled', false);
        });
    });

    function save_orders() {
        var status = $('#ord_st').val();
        var mode = $("#payment_mode").val();
        var shipping_address = $("#shipping_address").val();
        var shipping_city = $("#shipping_city").val();
        var shipping_state = $("#shipping_state").val();
        var shipping_country = $("#shipping_country").val();
        var shipping_pincode = $("#shipping_pincode").val();
        $.ajax({
            url: "<?php echo $base_url; ?>index.php/crm/modify_orders/<?php echo $order_id; ?>?status=" + status + "&mode=" + mode + "&shipping_address=" + shipping_address + "&shipping_city=" + shipping_city + "&shipping_state=" + shipping_state + "&shipping_country=" + shipping_country + "&shipping_pincode=" + shipping_pincode,
            success: function (data) {
                alert(data);
                window.location.reload();
            }
        });
        $('#store_dropdown').attr('disabled', false);
        $('#change_store').attr('disabled', false);
        $('#save_store').attr('disabled', true);
    }
</script>
</html>
