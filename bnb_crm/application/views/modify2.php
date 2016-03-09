<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Seller</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
</head>

<body>
<div class="wrapper">
    <div class="bigLabel clear_both">Order List</div>
    <div class="labeldetails">
        <div class="smallLabel">Reciever</div>
        <input type="text" name="reciever" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Reciever Address</div>
        <input type="text" name="address" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Contact</div>
        <input type="text" name="contact" id="mobile_no" class="text_field seller" maxlength="10" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Product Name</div>
        <input type="text" name="product_code" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Product Code</div>
        <input type="text" name="contents" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Weight</div>
        <input type="text" name="weight" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Seller Price</div>
        <input type="text" name="price" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Shipping Charges</div>
        <input type="text" name="price" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Discount Type</div>
        <input type="text" name="logistics_batch" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Discount Amount</div>
        <input type="text" name="logistics" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Discount Percentage</div>
        <input type="text" name="logistics" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">BnB Commision</div>
        <input type="text" name="logistics" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Total Price</div>
        <input type="text" name="logistics" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Date of Order Placed</div>
        <input type="text" name="date_of_order_placed" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel"> Expected Date of Delivery</div>
        <input type="text" name="expected_delivery" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Date of Order Delivered</div>
        <input type="text" name="date_of_order_delivered" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Logistics Provider</div>
        <input type="text" name="logistics" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Logistics Batch Number</div>
        <input type="text" name="logistics_batch" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Return Address</div>
        <input type="text" name="return_add" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Product length/ breadth/ height</div>
        <input type="text" name="prod_length" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Quantity</div>
        <input type="text" name="return_add" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">AWB number</div>
        <input type="text" name="awb_no" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel seller">Change order status</div>
        <select class="firstdrop" id="ord_sts" disabled="disabled">
            <option selected="selected" value="in_process">In Process</option>
            <option value="shipping">Shipping</option>
            <option value="completed">Completed</option>
            <option value="cancelled_order">Cancel Order</option>
            <option value="problem">Problem with Order</option>
        </select>
    </div>
    <div class="labeldetails hideit paddingRight0" id="cancelled_order">
        <div class="smallLabel">Cancel Reason</div>
        <select class="firstdrop">
            <option selected="selected">Cancelled Order COD</option>
            <option>Pre Delivery Refund Prepaid</option>
            <option>7 Day Refund Prepaid</option>
            <option>7 Day Refund COD</option>
            <option>7 Day Replacement Prepaid</option>
            <option>7 Day Replacement COD</option>
            <option>No Replacement Available</option>
            <option>Produc Not Available</option>
        </select>
    </div>
    <div class="labeldetails height76 clear_both">
        <div class="smallLabel">Seller Remarks</div>
        <textarea type="text" name="seller_remarks" class="seller" disabled="disabled"></textarea>
    </div>
    <div class="labeldetails height76 paddingRight0">
        <div class="smallLabel">Buyer Remarks</div>
        <textarea type="text" name="buyer_remarks" class="seller" disabled="disabled"></textarea>
    </div>

    <div class="clear_both">
        <input type="button" value="Make Changes" id="make_changes2" class="make_changes"/>
        <input type="button" class="modify_btn" value="Save Changes"/>
        <a href="search_seller.html"><input type="button" class="go_back" value="Go Back"/></a>
    </div>
</div>
</body>
<script>
    $(function () {

        $('#ord_sts').change(function () {
            $('#' + $(this).val()).show();
        });
        $(".modify_btn").click(function () {
            if (isNaN($("#mobile_no").val()) || $("#mobile_no").val().charAt(0) == ' ' || $("#mobile_no").val() == '' || $("#mobile_no").val().length != 10) {
                $("#mobile_no").addClass("red_border");
                return false;
            }
            else {
                $("#mobile_no").removeClass("red_border");

            }
        });
        $('#make_changes2').click(function () {
            $('.seller').attr('disabled', false);
        });
    });
</script>
</html>
