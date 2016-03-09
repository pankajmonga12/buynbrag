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
<div class="tabBg">
    <a href="index.html">
        <div class="bigLabel2 fl" id="search_buyer">Search Buyer</div>
    </a>

    <div class="bigLabel2 fl" id="search_seller" style="color:#fff;">Search Seller</div>
    <div class="bigLabel2 fl" id="export">Export</div>
    <div class="bigLabel2 fl" id="cod">COD Confirmation</div>
    <div class="bigLabel2 fl" id="ord">Order Processing</div>
</div>
<div class="buyerInfo hideit">
    <div class="bigLabel">Search Option</div>
    <div class="labeldetails">
        <div class="smallLabel">Search Buyer</div>
        <select class="firstdrop" id="dropdowns">
            <option selected="selected">Select</option>
            <option value="mob">Mobile Number</option>
            <option value="ord_no">Order Number</option>
            <option value="ea">Email Address</option>
        </select>
    </div>
    <div class="labeldetails hideit" id="mob">
        <div class="fl">
            <div class="smallLabel">Mobile Number</div>
            <input type="text" name="mobile" id="mobileno" maxlength="10" class="text_field"/>
        </div>
        <input type="button" class="enterbtn" id="ent_mob" value="Enter"/>
    </div>
    <div class="labeldetails hideit" id="ord_no">
        <div class="fl">
            <div class="smallLabel">Order Number</div>
            <input type="text" name="order" class="text_field"/>
        </div>
        <input type="button" class="enterbtn" value="Enter"/>
    </div>
    <div class="labeldetails hideit" id="dob">
        <div class="fl">
            <div class="smallLabel">Date of Birth</div>
            <input type="text" name="dob" class="text_field"/>
        </div>
        <input type="button" class="enterbtn" value="Enter"/>
    </div>
    <div class="labeldetails hideit" id="ea">
        <div class="fl">
            <div class="smallLabel">Email Address</div>
            <input type="text" name="emailid" class="text_field"/>
        </div>
        <input type="button" class="enterbtn" value="Enter"/>
    </div>
    <div class="bigLabel clear_both">Buyer Details</div>
    <div class="labeldetails">
        <div class="smallLabel">Buyer First Name</div>
        <input type="text" name="buyer_first" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Buyer Last Name</div>
        <input type="text" name="buyer_last" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Member Since</div>
        <input type="text" name="member_since" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Email</div>
        <input type="text" name="email" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Mobile</div>
        <input type="text" name="mob" id="mobile_no" class="text_field buyer" maxlength="10" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Date of Birth</div>
        <input type="text" name="dtbirth" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Billing Address 1</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Billing Address 2</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Billing Address city</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Billing Address State</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Billing Address Pincode</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Shipping Address 1</div>
        <input type="text" name="shipping_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Shipping Address 2</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Shipping Address city</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Shipping Address State</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Shipping Address Pincode</div>
        <input type="text" name="billing_add" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Last Activity Date/Time</div>
        <input type="text" name="last_activity" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Last Purchase Date/Time</div>
        <input type="text" name="last_purchase" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Brag Bucks Earned</div>
        <input type="text" name="brag_bucks" class="text_field buyer" disabled="disabled"/>
    </div>
    <div class="fl">
        <input type="button" value="Make Changes" id="make_changes" class="savechanges"/>
        <input type="button" value="Save Changes" class="savechanges"/>
    </div>
    <div class="table">
        <div class="bigLabel paddingLeft0">Order List</div>
        <div class="row">
            <div class="column">Store Name</div>
            <div class="column">Date of Order Placed</div>
            <div class="column">Logistics Provider</div>
            <div class="column">AWB Number</div>
            <div class="column">Product Cost</div>
            <div class="column">Order status</div>
            <div class="column">Action</div>
        </div>
        <div class="row">
            <div class="column">xx</div>
            <div class="column">yy</div>
            <div class="column">zz</div>
            <div class="column">ll</div>
            <div class="column">bb</div>
            <div class="column">cc</div>
            <a href="modify.html" class="column">modify</a>
        </div>
        <div class="row">
            <div class="column">xx</div>
            <div class="column">yy</div>
            <div class="column">zz</div>
            <div class="column">ll</div>
            <div class="column">bb</div>
            <div class="column">cc</div>
            <a href="modify.html" class="column">modify</a>
        </div>
        <div class="row borderBottom">
            <div class="column">xx</div>
            <div class="column">yy</div>
            <div class="column">zz</div>
            <div class="column">ll</div>
            <div class="column">bb</div>
            <div class="column">cc</div>
            <a href="modify.html" class="column">modify</a>
        </div>
    </div>
</div>
<div class="sellerInfo" style="display:block;">
<div class="labeldetails">
    <div class="smallLabel">Search Seller</div>
    <select class="firstdrop">
        <option selected="selected" value="copple">Copplerstore</option>
        <option value="alliflaila">Alliflaila</option>
        <option value="homeshop">Homeshop</option>
    </select>
</div>
<div class="bigLabel clear_both">Seller Details</div>
<div class="labeldetails">
    <div class="smallLabel">Store Name</div>
    <input type="text" name="store_name" class="text_field seller" disabled="disabled"/>
</div>
<div class="labeldetails">
    <div class="smallLabel">Brand/ Marketing Name</div>
    <input type="text" name="brand_name" class="text_field seller" disabled="disabled"/>
</div>
<div class="labeldetails paddingRight0">
    <div class="smallLabel">Seller URL</div>
    <input type="text" name="seller_url" class="text_field seller" disabled="disabled"/>
</div>
<div class="labeldetails clear_both">
    <div class="smallLabel">Contact Person First Name</div>
    <input type="text" name="firstName" class="text_field seller" disabled="disabled"/>
</div>
<div class="labeldetails">
    <div class="smallLabel">Contact Person Last Name</div>
    <input type="text" name="lastName" class="text_field seller" disabled="disabled"/>
</div>
<div class="labeldetails paddingRight0">
    <div class="smallLabel">Contact Person Mobile Number</div>
    <input type="text" name="mobile_no" class="text_field seller" disabled="disabled"/>
</div>
<div class="labeldetails clear_both">
    <div class="smallLabel">Contact Person Email</div>
    <input type="text" name="pers_email" class="text_field seller" disabled="disabled"/>
</div>
<div class="labeldetails">
    <div class="smallLabel">Communication City</div>
    <input type="text" name="commCity" class="text_field seller" disabled="disabled"/>
</div>
<div class="fl">
    <input type="button" value="Make Changes" id="make_changes2" class="savechanges"/>
    <input type="button" value="Save Changes" class="savechanges"/>
</div>

<div class="bigLabel clear_both">Access Orders</div>
<div class="labeldetails">
    <div class="smallLabel">Order Type</div>
    <select class="firstdrop" id="dropdown1">
        <option selected="selected" value="all">All</option>
        <option value="in_process">In Process</option>
        <option value="shipping">Shipping</option>
        <option value="completed">Completed</option>
        <option value="cancelled">Cancel Order</option>
        <option value="problem">Problem with Order</option>
    </select>
</div>
<div class="table" id="all">
    <div class="bigLabel paddingLeft0">Order List</div>
    <div class="row">
        <div class="column">Store Name</div>
        <div class="column width126">Date of Order Placed</div>
        <div class="column width126">Logistics Provider</div>
        <div class="column">Order ID</div>
        <div class="column">Track ID</div>
        <div class="column width112">Product Cost</div>
        <div class="column width126">Order status</div>
        <div class="column width90">Action</div>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">In process</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Shipping</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row borderBottom">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Completed</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
</div>
<div class="table hideit" id="in_process">
    <div class="bigLabel paddingLeft0">Order List</div>
    <div class="row">
        <div class="column">Store Name</div>
        <div class="column width126">Date of Order Placed</div>
        <div class="column width126">Logistics Provider</div>
        <div class="column">Order ID</div>
        <div class="column">Track ID</div>
        <div class="column width112">Product Cost</div>
        <div class="column width126">Order status</div>
        <div class="column width90">Action</div>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">In process</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">In process</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row borderBottom">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">In process</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
</div>
<div class="table hideit" id="shipping">
    <div class="bigLabel paddingLeft0">Order List</div>
    <div class="row">
        <div class="column">Store Name</div>
        <div class="column width126">Date of Order Placed</div>
        <div class="column width126">Logistics Provider</div>
        <div class="column">Order ID</div>
        <div class="column">Track ID</div>
        <div class="column width112">Product Cost</div>
        <div class="column width126">Order status</div>
        <div class="column width90">Action</div>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Shipping</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Shipping</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row borderBottom">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Shipping</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
</div>
<div class="table hideit" id="completed">
    <div class="bigLabel paddingLeft0">Order List</div>
    <div class="row">
        <div class="column">Store Name</div>
        <div class="column width126">Date of Order Placed</div>
        <div class="column width126">Logistics Provider</div>
        <div class="column">Order ID</div>
        <div class="column">Track ID</div>
        <div class="column width112">Product Cost</div>
        <div class="column width126">Order status</div>
        <div class="column width90">Action</div>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Completed</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Completed</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row borderBottom">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Completed</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
</div>
<div class="table hideit" id="cancelled">
    <div class="bigLabel paddingLeft0">Order List</div>
    <div class="row">
        <div class="column">Store Name</div>
        <div class="column width126">Date of Order Placed</div>
        <div class="column width126">Logistics Provider</div>
        <div class="column">Order ID</div>
        <div class="column">Track ID</div>
        <div class="column width112">Product Cost</div>
        <div class="column width126">Order status</div>
        <div class="column width90">Action</div>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Cancel Order</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Cancel Order</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row borderBottom">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Cancel Order</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
</div>
<div class="table hideit" id="problem">
    <div class="bigLabel paddingLeft0">Order List</div>
    <div class="row">
        <div class="column">Store Name</div>
        <div class="column width126">Date of Order Placed</div>
        <div class="column width126">Logistics Provider</div>
        <div class="column">Order ID</div>
        <div class="column">Track ID</div>
        <div class="column width112">Product Cost</div>
        <div class="column width126">Order status</div>
        <div class="column width90">Action</div>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Problem with Order</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Problem with Order</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
    <div class="row borderBottom">
        <div class="column"></div>
        <div class="column width126"></div>
        <div class="column width126"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column width112"></div>
        <div class="column width126">Problem with Order</div>
        <a href="modify2.html" class="column width90">modify</a>
    </div>
</div>
</div>
<div class="export">
    <div class="labeldetails">
        <div class="smallLabel">Search Seller</div>
        <select class="firstdrop">
            <option value="all">All</option>
            <option selected="selected" value="copple">Copplerstore</option>
            <option value="alliflaila">Alliflaila</option>
            <option value="homeshop">Homeshop</option>
        </select>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Search order status</div>
        <select class="firstdrop">
            <option selected="selected" value="all">All</option>
            <option value="in_process">In Process</option>
            <option value="shipping">Shipping</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancel Order</option>
            <option value="problem">Problem with Order</option>
        </select>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Date Range</div>
        <input type="text" name="prod_length" class="text_field2" value="From"/>
        <input type="text" name="prod_length" class="text_field2" value="To"/>
    </div>
    <div class="labeldetails">
        <input type="button" class="go" value="Go"/>
    </div>
</div>
<div class="cod">
    <div class="table">
        <div class="row">
            <div class="sno">Sno.</div>
            <div class="column bn">Buyer Name</div>
            <div class="column mb">Mobile</div>
            <div class="column em">Email Addres</div>
            <div class="column sa">Shipping Address</div>
            <div class="column mb">Pincode</div>
            <div class="column em">Buyer Comments</div>
            <div class="column mb">Product</div>
            <div class="column ca">Collection Amount</div>
            <div class="column em">BnB Remarks</div>
            <div class="column em">Approved COD</div>
        </div>
        <div class="row">
            <div class="sno"></div>
            <div class="column bn"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column sa"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column mb"></div>
            <div class="column ca"></div>
            <div class="column em"></div>
            <div class="column em">
                <input type="radio" value="yes" class="fl" name="yesno"/>

                <div class="label">Yes</div>
                <input type="radio" value="no" class="fl" name="yesno"/>

                <div class="label">No</div>
            </div>
        </div>
        <div class="row">
            <div class="sno"></div>
            <div class="column bn"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column sa"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column mb"></div>
            <div class="column ca"></div>
            <div class="column em"></div>
            <div class="column em">
                <input type="radio" value="yes" class="fl" name="yesno1"/>

                <div class="label">Yes</div>
                <input type="radio" value="no" class="fl" name="yesno1"/>

                <div class="label">No</div>
            </div>
        </div>
        <div class="row">
            <div class="sno"></div>
            <div class="column bn"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column sa"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column mb"></div>
            <div class="column ca"></div>
            <div class="column em"></div>
            <div class="column em">
                <input type="radio" value="yes" class="fl" name="yesno2"/>

                <div class="label">Yes</div>
                <input type="radio" value="no" class="fl" name="yesno2"/>

                <div class="label">No</div>
            </div>
        </div>
        <div class="row">
            <div class="sno"></div>
            <div class="column bn"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column sa"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column mb"></div>
            <div class="column ca"></div>
            <div class="column em"></div>
            <div class="column em">
                <input type="radio" value="yes" class="fl" name="yesno3"/>

                <div class="label">Yes</div>
                <input type="radio" value="no" class="fl" name="yesno3"/>

                <div class="label">No</div>
            </div>
        </div>
        <div class="row borderBottom">
            <div class="sno"></div>
            <div class="column bn"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column sa"></div>
            <div class="column mb"></div>
            <div class="column em"></div>
            <div class="column mb"></div>
            <div class="column ca"></div>
            <div class="column em"></div>
            <div class="column em">
                <input type="radio" value="yes" class="fl" name="yesno4"/>

                <div class="label">Yes</div>
                <input type="radio" value="no" class="fl" name="yesno4"/>

                <div class="label">No</div>
            </div>
        </div>
    </div>
    <input type="button" value="Approve" class="approve"/>
</div>
</div>

<div class="order">
    <div class="table">
        <div class="row1 ht">
            <div class="sno ht">Sno.</div>
            <div class="column ht">Track ID</div>
            <div class="column ht">Order No</div>
            <div class="column ht">Origin</div>
            <div class="column ht">Destination</div>
            <div class="column ht">Seller Name</div>
            <div class="column ht">Seller Code</div>
            <div class="column ht">Logistic Provider</div>
            <div class="column ht">Pick Up Date</div>
            <div class="column ht">Delivery Date</div>
            <div class="column ht">Delivery Time</div>
            <div class="column ht">Delivery Taken By</div>
            <div class="column ht">Undelivered Reason</div>
            <div class="column ht">Consignee Name</div>
            <div class="column ht">Consignee Address-1</div>
            <div class="column ht">Consignee Pincode</div>
            <div class="column ht">Charged Weight</div>
            <div class="column ht">Quantity</div>
            <div class="column ht">Product Value</div>
            <div class="column ht">Product Code</div>
            <div class="column ht fr">Freight
                <div>(Inclusive of Fuel Surcharge)</div>
            </div>
            <div class="column">
                <input type="checkbox" class="fl" id="check_all"/>

                <div class="label">Check All</div>
            </div>
        </div>
        <div class="row1">
            <div class="sno"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column fr"></div>
            <div class="column">
                <input type="checkbox" class="fl checks"/>

                <div class="label2">Completed</div>
            </div>
        </div>
        <div class="row1">
            <div class="sno"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column fr"></div>
            <div class="column">
                <input type="checkbox" class="fl checks"/>

                <div class="label2">Completed</div>
            </div>
        </div>
        <div class="row1">
            <div class="sno"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column fr"></div>
            <div class="column">
                <input type="checkbox" class="fl checks"/>

                <div class="label2">Completed</div>
            </div>
        </div>
        <div class="row1 borderBottom">
            <div class="sno"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div>
            <div class="column fr"></div>
            <div class="column">
                <input type="checkbox" class="fl checks"/>

                <div class="label2">Completed</div>
            </div>
        </div>
    </div>
    <input type="button" value="Complete Order" class="process_button"/>
</div>
</body>
<script type="text/javascript">
    $(function () {
        $('#dropdown1').change(function () {
            $('.table').hide();
            $('#' + $(this).val()).show();
        });
        $('.hideit').hide();
        $('#dropdowns').change(function () {
            $('.hideit').hide();
            $('#' + $(this).val()).show();
        });
        $('#search_buyer').click(function () {
            $(this).css('color', '#fff');
            $(this).siblings().css('color', '#000');
            $('.sellerInfo').hide();
            $('.export').hide();
            $('.cod').hide();
            $('.order').hide();
            $('.buyerInfo').show();
        });
        $('#export').click(function () {
            $(this).css('color', '#fff');
            $(this).siblings().css('color', '#000');
            $('.sellerInfo').hide();
            $('.buyerInfo').hide();
            $('.cod').hide();
            $('.order').hide();
            $('.export').show();
        });
        $('#search_seller').click(function () {
            $(this).css('color', '#fff');
            $(this).siblings().css('color', '#000');
            $('.export').hide();
            $('.buyerInfo').hide();
            $('.cod').hide();
            $('.order').hide();
            $('.sellerInfo').show();
        });
        $('#cod').click(function () {
            $(this).css('color', '#fff');
            $(this).siblings().css('color', '#000');
            $('.export').hide();
            $('.buyerInfo').hide();
            $('.sellerInfo').hide();
            $('.order').hide();
            $('.cod').show();
        });
        $('#ord').click(function () {
            $(this).css('color', '#fff');
            $(this).siblings().css('color', '#000');
            $('.export').hide();
            $('.buyerInfo').hide();
            $('.sellerInfo').hide();
            $('.cod').hide();
            $('.order').show();
        });
        $('#check_all').click(function () {
            var status = $(this).attr('checked');
            if (status == undefined) {
                status = false;
            }
            $('.checks').attr('checked', status);
        });
        $('#make_changes').click(function () {
            $('.buyer').attr('disabled', false);
        });
        $('#make_changes2').click(function () {
            $('.seller').attr('disabled', false);
        });

    });
</script>
</html>
