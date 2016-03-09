<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <title>CUSTOMER RELATIONSHIP MANAGEMENT</title>
<!--    <link rel="stylesheet" type="text/css" href="/bnb_crm/assets/css/common.css"/>-->
    <link rel="stylesheet" type="text/css" href="/bnb_crm/assets/css/datepickr.css" />
    <!--<link rel="stylesheet" type="text/css" href="/bnb_crm/assets/css/smoothness/jquery-ui-1.10.3.custom.css"/>-->
    <link rel="stylesheet" type="text/css" href="/bnb_crm/assets/css/jquery-ui.min.css"/>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />
<!--    <link rel="stylesheet" type="text/css" href="/bnb_crm/assets/css/demos.css"/>-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/bnb_crm/assets/js/ajax_info.js"></script>
    <script type="text/javascript" src="/bnb_crm/assets/js/datepickr.min.js"></script>
    <script src='/bnb_crm/assets/js/jquery.bpopup-x.x.x.min.js'></script>
    <!--<script type="text/javascript" src="/bnb_crm/assets/js/jquery-ui-1.10.3.custom.min.js">-->
    <!--<css change >-->
       <style type="text/css" >
    body {
background-color: aliceblue;
}
a:hover {
text-decoration: underline;
color: #DD127B;

}
table#transaction-view {
    border-collapse: collapse;

  }
 table#transaction-user-detail th{
    border: 1px solid #666666;
    padding: 4px;
  }
  table#transaction-user-detail td{
    border: 1px solid #666666;
    padding: 4px;
  }
  table#transaction-cart-detail th{
    border: 1px solid #666666;
    padding: 4px;
    width: 50px;
  }
  table#transaction-cart-detail td{
    border: 1px solid #666666;
    padding: 4px;
    width: 50px;
  }
  table#transaction-user-aftercheckout th{
    border: 1px solid #666666;
    padding: 4px;
    width: 200px;
  }
  table#transaction-user-aftercheckout td{
    border: 1px solid #666666;
    padding: 4px;
    width: 200px;
  }
  table#transaction-bank-detail th{
    border: 1px solid #666666;
    padding: 4px;
    width: 200px;
  }
  table#transaction-bank-detail td{
    border: 1px solid #666666;
    padding: 4px;
    width: 200px;
  }
  table#transaction-cart-aftercheckout th{
    border: 1px solid #666666;
    padding: 4px;
    width: 50px;
  }
  table#transaction-cart-aftercheckout td{
    border: 1px solid #666666;
    padding: 4px;
    width: 50px;
  }
          .button.b-close {
  border-radius: 7px 7px 7px 7px;

  font: bold 131% sans-serif;
  padding: 0 6px 2px;
  position: absolute;
  right: -7px;
  top: -50px;
  box-shadow: 0 2px 3px rgba(0,0,0,0.3);
  color: #fff;
  cursor: pointer;
  display: inline-block;
  text-align: center;
  text-decoration: none;
  }
 .box{
      background-color: white;
      color: black;
      font-size: 16px;
      box-shadow: 0 0 25px 5px #999;
      border-radius: 7px 7px 7px 7px;
      padding: 7px;
      position: absolute;
      top: 10em;
      left: 1em;
      width: 1305px;
      height: auto;
      display: none;
      min-height: 200px;
     }
     div#transaction-user-detail {
      width: 250px;
      }
      div#transaction-cart-detail {
      width: 250px;
      }
  .button {
    margin-top: 2em;
    margin-left: 20em;
    background: #E48F8F;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
    }

         .button:hover{
     cursor: pointer;
    }
</style>
 <script type="text/javascript">
  function Checkout(transID) {

         $.ajax
                      ({
                          url: "<?php echo $base_url; ?>index.php/crm/Checkout/",
                          data: {transID:transID},
                          type: 'GET',
                         success :   function(data){
                          console.log(data);
                            console.log('success');
                        
                        document.getElementById("transaction-user-detail").innerHTML='';
                        document.getElementById("transaction-bank-detail").innerHTML='';
                        document.getElementById("transaction-user-aftercheckout").innerHTML='';
                        document.getElementById("transaction-cart-aftercheckout").innerHTML='';
                        document.getElementById("transaction-view-header").innerHTML='<h2><center>DETAIL OF TRANSACTION BEFOR CHECKOUT</center></h2>';
                        document.getElementById("transaction-user-detail").innerHTML='<b><h3>USER DETAIL</h3></b>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>FULL NAME</th><td>'+data.beforecheck.post.firstname+' '+data.beforecheck.post.lastname+'</td></tr>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>PAYEMENT TYPE</th><td>'+data.beforecheck.post.pg+'</td></tr>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>AMOUNT</th><td>'+data.beforecheck.post.amount+'</td></tr>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>SHIPPING ADDRESS</th><td>'+data.beforecheck.post.address1+'</td></tr>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>CITY</th><td>'+data.beforecheck.post.city+'</td></tr>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>STATE</th><td>'+data.beforecheck.post.state+'</td></tr>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>COUNTRY</th><td>'+data.beforecheck.post.country+'</td></tr>';
                        document.getElementById("transaction-user-detail").innerHTML+='<b><tr><th>ZIPCODE</th><td>'+data.beforecheck.post.zipcode+'</td></tr>';
                        
                                                                        
                        document.getElementById("transaction-cart-detail").innerHTML='<b><h3>CART DETAIL</h3></b>';
                        document.getElementById("transaction-cart-detail").innerHTML+='<b><tr><th>CART ID</th><th>CART QUANTITY</th><th>PRODUCT ID</th><th>PRODUCT NAME</th><th>STORE ID </th><th>PRODUCT IN-STOCK</th><th>SELLING PRICE</th><th>SHIPPING COST</th><th>SHIPPING PARTNER</th><th>TAX RATE</th><th>USER ID </th><th>DISCOUNT STATUS</th><th>DISCOUNT VALUE</th><th>VARIENT SIZE</th><th>VARIENT COLOR</th></tr> </b>';
                        $.each(data.beforecheck.cartState, function(k, v) 
                                  {   
                          document.getElementById("transaction-cart-detail").innerHTML+='<tr><td>'+v.cart_id+'</td><td>'+v.cart_quantity+'</td><td>'+v.product_id+'</td><td>'+v.product_name+'</td><td>'+v.store_id+'</td><td>'+v.quantity+'</td><td>'+v.selling_price+'</td><td>'+v.shipping_cost+'</td><td>'+v.shipping_partner+'</td><td>'+v.tax_rate+'</td><td>'+v.user_id+'</td><td>'+v.is_on_discount+'</td><td>'+v.discount+'</td><td>'+v.vcolor+'</td><td>'+v.vsize+'</td></tr>';         
                                  });
                     
                     if (data.afterCheckout !==null) {        
                   document.getElementById("transaction-view-header2").innerHTML='<br><h2><center>DETAIL OF TRANSACTION AFTER CHECKOUT</center></h2>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML='<b><h3>ORDER DETAIL</h3></b>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>PAYEMENT TYPE</th><td>'+data.afterCheckout.post.PG_TYPE+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>DATE OF ORDER</th><td>'+data.afterCheckout.post.addedon+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>FULL NAME</th><td>'+data.afterCheckout.post.firstname+' '+data.afterCheckout.post.lastname+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>SHIPPING ADDRESS</th><td>'+data.afterCheckout.post.address1+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>CITY</th><td>'+data.afterCheckout.post.city+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>STATE</th><td>'+data.afterCheckout.post.state+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>COUNTRY</th><td>'+data.afterCheckout.post.country+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>ZIPCODE</th><td>'+data.afterCheckout.post.zipcode+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>CONTACT NO</th><td>'+data.afterCheckout.post.phone+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>EMAIL ID</th><td>'+data.afterCheckout.post.email+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>AMOUNT PAID</th><td>'+data.afterCheckout.post.amount+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>DISCOUNT</th><td>'+data.afterCheckout.post.discount+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>COUPON ID</th><td>'+data.afterCheckout.post.udf3+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>COUPON AMOUNT</th><td>'+data.afterCheckout.post.udf4+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>COUPON STATUS</th><td>'+data.afterCheckout.post.unmappedstatus+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>PRODUCT INFO</th><td>'+data.afterCheckout.post.productinfo+'</td></tr>';
                   document.getElementById("transaction-user-aftercheckout").innerHTML+='<b><tr><th>STATUS</th><td>'+data.afterCheckout.post.status+'</td></tr>';

                  document.getElementById("transaction-bank-detail").innerHTML='<b><h3>BANK DETAIL</h3></b>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>BANK REF. NO. </th><b><td>'+data.afterCheckout.post.bank_ref_num+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>BANK CODE </th><b><td>'+data.afterCheckout.post.bankcode+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>CARD NO. </th><b><td>'+data.afterCheckout.post.cardnum+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>TRANSACTION MODE </th><b><td>'+data.afterCheckout.post.mode+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>NAME ON CARD </th><b><td>'+data.afterCheckout.post.name_on_card+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>AMOUNT DEBIT </th><b><td>'+data.afterCheckout.post.net_amount_debit+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>PAYEMENT SOURCE </th><b><td>'+data.afterCheckout.post.payment_source+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>PAY ID </th><b><td>'+data.afterCheckout.post.mihpayid+'</td></tr>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b><tr><th>TRANSACTION ID </th><b><td>'+data.afterCheckout.post.txnid+'</td></tr>';

                  document.getElementById("transaction-cart-aftercheckout").innerHTML='<br><b><h3>CART DETAIL</h3></b>';
                  document.getElementById("transaction-cart-aftercheckout").innerHTML+='<b><tr><th>CART ID</th><th>CART QUANTITY</th><th>PRODUCT ID</th><th>PRODUCT NAME</th><th>STORE ID </th><th>PRODUCT IN-STOCK</th><th>SELLING PRICE</th><th>SHIPPING COST</th><th>SHIPPING PARTNER</th><th>TAX RATE</th><th>USER ID </th><th>DISCOUNT STATUS</th><th>DISCOUNT VALUE</th><th>VARIENT SIZE</th><th>VARIENT COLOR</th></tr> </b>';
                  $.each(data.afterCheckout.cartState, function(k, v) 
                                  {   
                          document.getElementById("transaction-cart-aftercheckout").innerHTML+='<tr><td>'+v.cart_id+'</td><td>'+v.cart_quantity+'</td><td>'+v.product_id+'</td><td>'+v.product_name+'</td><td>'+v.store_id+'</td><td>'+v.quantity+'</td><td>'+v.selling_price+'</td><td>'+v.shipping_cost+'</td><td>'+v.shipping_partner+'</td><td>'+v.tax_rate+'</td><td>'+v.user_id+'</td><td>'+v.is_on_discount+'</td><td>'+v.discount+'</td><td>'+v.vcolor+'</td><td>'+v.vsize+'</td></tr>';         
                                  });
                  }

                  else  {

                  document.getElementById("transaction-user-aftercheckout").innerHTML='<b>COD ORDER</b> NO BANK DETAIL AVAILABLE';
                  }
                            $(document.getElementById("transaction-view")).bPopup({
                                    easing:'linear',
                                    speed: 500,
                                    escClose: true,
                                    transition: 'fadeIn'
                                    });
                         }
                        });
                 
                         }
  
</script>
    <script type="text/javascript">

        function getBaseURL() {
            return location.protocol + "//" + location.hostname + "/";
        }

        console.log("Registering sendmail function");

        function semail() {
            console.log('semail called');
            var allvendors = new String(document.getElementById("allvendors").value);
            allvendors = allvendors.split(',');
            var i = 0;
            var j = 0;
            var toSend = new Array();
            for (; i < allvendors.length; i++) {
                if (document.getElementById("orderNo" + allvendors[i]).checked) {
                    if (document.getElementById("default_" + allvendors[i]).selected) {
                        toSend[j] = "default_" + allvendors[i];
                        j++;
                    }
                    if (document.getElementById("fedex_" + allvendors[i]).selected) {
                        toSend[j] = "fedex_" + allvendors[i];
                        j++;
                    }
                    if (document.getElementById("bd_" + allvendors[i]).selected) {
                        toSend[j] = "bd_" + allvendors[i];
                        j++;
                    }
                    if (document.getElementById("gati_" + allvendors[i]).selected) {
                        toSend[j] = "gati_" + allvendors[i];
                        j++;
                    }
                }
            }
            var Send = encodeURIComponent(toSend.join('|'));

            console.log(toSend.length);

            if (toSend.length > 0) {

                console.log("sendmail window");

                //window.open(baseUrl + 'bnb_crm/index.php/crm/sendmail/' + Send);
                //window.open(baseUrl + 'bnb_crm/index.php/crm/newSendMail/' + Send);
                jQuery.ajax
                ({
                    url: baseUrl + 'bnb_crm/index.php/crm/newSendMail/' + Send,
                    type: 'GET',
                    success: function()
                    {
                        console.log('sendmail request successful');
                        alert("Successfully sent mail ("+Send+") to seller");
                    }
                });
            }
        }

    </script>

    <script type = "text/javascript">

    function selectStore()
    {
    
    console.log('selectStore called');
    var selectElement = document.getElementById("selectStore");
    var x = selectElement.value;
    alert(x);
        
    window.location.assign( baseURL + 'index.php/crm/store/'+encodeURIComponent(x));

    }

    </script>

    <script type = "text/javascript">

    function selectOrderedDate()
    {
     
      var selectElement = document.getElementById("selectOrderedDate");
      var x = selectElement.value;
      var p = "ob";
      alert(x);
      window.location.assign( baseURL + 'index.php/crm/bydate/'+ p + '/' + x);

    }
    </script>

    <script type = "text/javascript">

    function selectPickupDate()
    {
      console.log("pickup called");
      var selectElement = document.getElementById("selectPickupDate");
      var x = selectElement.value;
      var p = "pu";
      alert(x);
      window.location.assign( baseURL + 'index.php/crm/bydate/'+ p + '/' + x);
    }
    </script>

    <script type="text/javascript">

        function getBaseURL() {
            return location.protocol + "//" + location.hostname + "/";
        }

        var baseUrl = getBaseURL();

        $(".invoice").on("click", function () {
            var x = this.value;
            var n = x.split("_");

            $.ajax(
                {
                    url: baseUrl + "bnb_crm/index.php/inv",
                    type: 'POST',
                    data: {a: n[0], b: n[1]},

                    success: function (data) {
                        if (n[0] === "default") {
                            $("#shivam_" + n[1]).html("<a href=" + data.db + ">" + data.dc + "</a>|<a href=" + data.dd + ">" + data.de + "</a>");
                        } else {
                            $("#shivam_" + n[1]).html("<a href=" + data.db + ">" + data.dc + "</a>|<a href=" + data.dd + ">" + data.de + "</a>|<a href=" + data.df + ">" + data.dg + "</a>");
                        }

                    },

                    error: function (data) {
                        console.log(error);
                    }
                });
            return false;
        });

        /*$(".str").change(function () {
            var x = this.value;
            if (x.indexOf(' ') >= 0)
                var x1 = x.split(" ").join("_");
            else
                var x1 = x.split("'").join(".");

            window.location.replace(baseUrl + 'bnb_crm/index.php/crm/store/' + x1);
        });*/
        /*$(".obdate").change(function () {
            var p = "ob";
//        alert(p);
            var x = this.value;
            window.open(baseUrl + 'bnb_crm/index.php/crm/bydate/' + p + '/' + x);
        });*/
        /*$(".pudate").change(function () {
            var p = "pu";
            var x = this.value;
            window.open(baseUrl + 'bnb_crm/index.php/crm/bydate/' + p + '/' + x);
        });*/
    </script>

    <script type="text/javascript">
        window.onload = function(){
            console.log("datepicker called");
            new datepickr('datepicker',{
                'dateFormat': 'y-m-d'
            });
        };

    </script>

    <script>

    function updatePickupDate(id)
    {
       var x = document.getElementById("datepicker");
       var selectedDate = x.value;
       alert(selectedDate);
       console.log("update PickUpDate");
                jQuery.ajax
                ({
                    url: baseUrl + 'bnb_crm/index.php/crm/updatePickupDate/' + selectedDate + '/' + id,
                    type: 'GET',
                    success: function()
                    {
                        console.log('Request to update pickupdate');
                        alert("PickUpDate successfully changed");
                    }
                });
    }

  </script>
   <script>
        function venderEMAIL(id)
    {

       var x = document.getElementById("ownerEMAIL");
       var selectEMAIL = x.value;
       atpos = selectEMAIL.indexOf("@");
   dotpos = selectEMAIL.lastIndexOf(".");
   if (atpos < 1 || ( dotpos - atpos < 2 )) 
   {
       alert("Please enter correct email ID");
       return false;
   }
   else {
       alert(selectEMAIL);
       console.log("SEND EMAIL TO OWNER");
                $.ajax
                ({
                    url: "<?php echo $base_url; ?>index.php/crm/vendorEMAIL/",
                    data: {selectEMAIL: selectEMAIL, id: id},
                    type: 'GET',
                    success: function(data)
                    {
                        console.log('Request to send Email');
                        alert("email send successfully");
                    }
                });
            }
    }
        function updateAWBNO(id)
    {

       var x = document.getElementById("genrateawbNO");
       var genrateawbNO = x.value;
   
         
       alert(genrateawbNO);
       console.log("AWB NO UPDATED");
                $.ajax
                ({
                    url: "<?php echo $base_url; ?>index.php/crm/updateAWBNO/",
                    data: {genrateawbNO: genrateawbNO, id: id},
                    type: 'GET',
                    success: function(data)
                    {
                        console.log('Request to update AWB no');
                        alert("AWB NO UPDATED successfully");
                    } 
                });
            
       

    }

    </script>

    <script>
        // $(function() {
        // 	$( "#dialog" ).dialog({
        // 		height: 500,
        // 		width:600,
        // 		modal: true
        // 	});
        // 	$("#cancel").click(function(){
        // 		$("#dialog").dialog('close');

        // 	});
        // });
    </script>
    <style type="text/css">
        .article1 {
            text-align: center;
            min-width: 100px;
            width: auto;
            height: 100px;
            background: #C0C0C0;
            float: left;
            margin: 2px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function ($) {
            $('.sellerInfo').hide();
            $('.export').hide();
            $('.cod').hide();
            $('.order').hide();
            $('.buyerInfo').hide();
            $('.mailing').hide();
            $('.pickuptoday').hide();
            $(".das").hide();
            <?php if ($crm_tab==1 ) : ?>
            $('.buyerInfo').show();
            $('#search_buyer').css('color', '#fff');
            $('#search_buyer').siblings().css('color', '#000');
            $('.mailing').hide();
            $('.pickuptoday').hide();
            <?php elseif ($crm_tab==2 || $crm_tab==0) : ?>
            $('.sellerInfo').hide();
            $('#search_seller').css('color', '#fff');
            $('#search_seller').siblings().css('color', '#000');
            $('.mailing').hide();
            $('.pickuptoday').hide();
            <?php elseif ($crm_tab==3) : ?>
            $('.export').show();
            $('#export').css('color', '#fff');
            $('#export').siblings().css('color', '#000');
            $('.mailing').hide();
            $('.pickuptoday').hide();
            <?php elseif ($crm_tab==4) : ?>
            $('.cod').show();
            $('#cod').css('color', '#fff');
            $('#cod').siblings().css('color', '#000');
            $('.mailing').hide();
            $('.pickuptoday').hide();
            <?php elseif ($crm_tab==5) : ?>
            $('.order').show();
            $('#ord').css('color', '#fff');
            $('#ord').siblings().css('color', '#000');
            $('.pickuptoday').hide();
            $('.mailing').hide();
            <?php endif; ?>
            all_order_filter(0);
            $('.pickuptoday').hide();
            $('.mailing').hide();
            $(".das").hide();
        });
    </script>

    <script type="text/javascript">
        function popup(val, orderId) {
//alert(orderId);
            var element = document.getElementById('shippingdate' + orderId);
            var elements = document.getElementById('shippingtime' + orderId);
            //alert(element);
            //alert(elements);
            if (val == '3') {
                element.style.display = 'block';
                elements.style.display = 'block';
            }
            else {
                element.style.display = 'none';
                elements.style.display = 'none';
            }
        }

    </script>
</head>
<body>
<?php
$datepickuptoday = date("Y-m-d");
$a = array();
$a = explode('-', $datepickuptoday);
?>
<div align="center" id="ajax_dialog" title="BuynBrag CRM" style="display:none;">
</div>
<input id="base_url" type="hidden" value="<?php echo $base_url; ?>"/>
<input style="margin-right:150px;margin-top:20px;" type="submit" onclick="logout()" value="Logout">

<div class="bigLabel2_fl"><input type="BUTTON" value="All Orders" class="article1" id="ord"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="CSV Reports" class="article1" id="getCSV"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="Enable / Disable / Change" class="article1" id="enableDisable"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="Sales Report Dashboard" class="article1" id="reportsDashboard"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="Seller Details" class="article1" id="seldet"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="PickUp Today" class="article1" onclick="pickup(<?php echo $a[0]; ?>,<?php echo $a[1]; ?>,<?php echo $a[2]; ?>)"/>
<div class="bigLabel2_fl"><input type="BUTTON" value="Comments" class="article1" id="commentsDashboardButton"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="Transaction Status" class="article1" id="transactionButton"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="Manage Deals" class="article1" id="dealsDashboardButton"/></div>
<div class="bigLabel2_fl"><input type="BUTTON" value="Manage Coupons" class="article1" id="couponsDashboardButton"/></div>

</div>
<div class="bigLabel2_fl"><input type="BUTTON" value="Change Pickup date" class="article1" id="changepick"/></div>
<div class="buyerInfo">
    <div class="bigLabel">Search Option</div>
    <span style="color: red; font-size: 13px;"><?php $validation_errors = validation_errors();
        if (!empty($validation_errors)) echo '*' . $validation_errors; ?></span>

    <form method="post">
        <div class="labeldetails">
            <div class="smallLabel">Search Buyer</div>
            <select class="firstdrop" id="dropdown">
                <option selected="selected">Select</option>
                <option value="mob">Mobile Number</option>
                <option value="ord_no">Order Number</option>
                <option value="ea">Email Address</option>
            </select>
        </div>
        <!-- Start Hidden label displayed once a particular search option is selected -->
        <div class="labeldetails hideit" id="mob">
            <div class="fl">
                <div class="smallLabel">Mobile Number</div>
                <input type="text" name="mobile" id="mobileno option" maxlength="10" class="text_field"/>
            </div>
            <input type="submit" class="enterbtn" id="ent_mob ent_option" value="Enter"/>
        </div>
        <div class="labeldetails hideit" id="ord_no">
            <div class="fl">
                <div class="smallLabel">Order Number</div>
                <input type="text" name="order" class="text_field" id="option"/>
            </div>
            <input type="submit" class="enterbtn" id="ent_option" value="Enter"/>
        </div>
        <div class="labeldetails hideit" id="dob">
            <div class="fl">
                <div class="smallLabel">Date of Birth</div>
                <input type="text" name="dob" class="text_field" id="option"/>
            </div>
            <input type="submit" class="enterbtn" id="ent_option" value="Enter"/>
        </div>
        <div class="labeldetails hideit" id="ea">
            <div class="fl">
                <div class="smallLabel">Email Address</div>
                <input type="text" name="emailid" class="text_field" id="option"/>
            </div>
            <input type="submit" class="enterbtn" id="ent_option" value="Enter"/>
        </div>
    </form>
    <!-- End Hidden label displayed once a particular search option is selected -->
    <form name="details" method="post">
        <div class="bigLabel clear_both">Buyer Last Purchase Details</div>
        <div class="labeldetails">
            <div class="smallLabel">Buyer First Name</div>
            <input type="text" name="buyer_first" class="text_field buyer" id="shp_fname" disabled="disabled"
                   value="<?php echo $buyer_first_name; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Buyer Last Name</div>
            <input type="text" name="buyer_last" class="text_field buyer" id="shp_lname" disabled="disabled"
                   value="<?php echo $buyer_last_name; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Member Since</div>
            <input type="text" name="member_since" class="text_field buyer" disabled="disabled"
                   value="<?php echo $joined_date; ?>"/>
        </div>
        <div class="labeldetails clear_both">
            <div class="smallLabel">Email</div>
            <input type="text" name="email" class="text_field buyer" id="shp_email" disabled="disabled"
                   value="<?php echo $email; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Mobile</div>
            <input type="text" name="mob" id="mobile_no shp_mob" class="text_field buyer" maxlength="10"
                   disabled="disabled" value="<?php echo $mobile; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Date of Birth</div>
            <input type="text" name="dtbirth" class="text_field buyer" disabled="disabled" value="<?php echo $dob; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Billing Address</div>
            <input type="text" name="billing_add" class="text_field buyer address_field" id="bill_add"
                   disabled="disabled" value="<?php echo $shipping_address; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Billing city</div>
            <input type="text" name="billing_city" class="text_field buyer" id="bill_city" disabled="disabled"
                   value="<?php echo $shipping_city; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Billing State</div>
            <input type="text" name="billing_state" class="text_field buyer" id="bill_state" disabled="disabled"
                   value="<?php echo $shipping_state; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Billing Country</div>
            <input type="text" name="billing_country" class="text_field buyer" id="bill_country" disabled="disabled"
                   value="<?php echo $shipping_country; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Billing Pincode</div>
            <input type="text" name="billing_pin" class="text_field buyer" id="bill_pin" disabled="disabled"
                   value="<?php echo $shipping_pincode; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Shipping Address</div>
            <input type="text" name="shipping_add" class="text_field buyer address_field" id="shp_add"
                   disabled="disabled" value="<?php echo $shipping_address; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Shipping city</div>
            <input type="text" name="billing_city" class="text_field buyer" id="shp_city" disabled="disabled"
                   value="<?php echo $shipping_city; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Shipping State</div>
            <input type="text" name="billing_state" class="text_field buyer" id="shp_state" disabled="disabled"
                   value="<?php echo $shipping_state; ?>"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Shipping Country</div>
            <input type="text" name="billing_country" class="text_field buyer" id="shp_country" disabled="disabled"
                   value="<?php echo $shipping_country; ?>"/>
        </div>
        <div class="labeldetails paddingRight0">
            <div class="smallLabel">Shipping Pincode</div>
            <input type="text" name="billing_pin" class="text_field buyer" id="shp_pin" disabled="disabled"
                   value="<?php echo $shipping_pincode; ?>"/>
        </div>
        <div class="labeldetails clear_both">
            <div class="smallLabel">Last Activity Date/Time</div>
            <input type="text" name="last_activity" class="text_field buyer" disabled="disabled"/>
        </div>
        <div class="labeldetails">
            <div class="smallLabel">Last Purchase Date/Time</div>
            <input type="text" name="last_purchase" class="text_field buyer" disabled="disabled"
                   value="<?php echo $last_purchase_date; ?>"/>
        </div>
        <div class="labeldetails paddingRight0">
            <div class="smallLabel">BnB Credits</div>
            <input type="text" name="brag_bucks" class="text_field buyer" disabled="disabled"/>
        </div>
        <div class="fl">
            <input type="button" value="Make Changes" id="make_changes" class="savechanges"/>
            <input type="button" value="Save Changes" class="savechanges" id="save" disabled="disabled"/>
            <input type="button" value="Cancel" class="savechanges" id="cancel" disabled="disabled"/>
        </div>
    </form>
    <div class="table">
        <?php if (!empty($order_list)) : ?>
            <div class="bigLabel paddingLeft0">Order List</div>
            <table border="1">
                <!--<div class="row">-->
                <tr>
                    <th>Store Name</th>
                    <th>Date of Order Placed</th>
                    <th>Logistics Provider</th>
                    <th>Order ID</th>
                    <th>Track ID</th>
                    <th>Product Cost</th>
                    <th>Order status</th>
                    <th>Action</th>
                </tr>
                <!--</div>-->
                <?php for ($i = 0; $i < count($order_list); $i++) : ?>
                    <tr>
                        <td><?php echo $order_list[$i]['store_name']; ?></td>
                        <td><?php echo $order_list[$i]['date_of_order'] ?></td>
                        <td><?php echo $order_list[$i]['shipping_partner'] ?></td>
                        <td><?php echo $order_list[$i]['order_id'] ?></td>
                        <td><?php // echo $order_list[$i]['track_id']?></td>
                        <td><?php echo $order_list[$i]['selling_price'] ?></td>
                        <td><?php echo $order_list[$i]['status_order'] ?></td>
                        <td>
                            <a href="<?php echo $base_url . 'index.php/crm/modify_buyer_orders/' . $order_list[$i]['order_id']; ?>">modify</a>
                        </td>
                    </tr>
                <?php endfor; ?>
            </table>
        <?php endif; ?>
        <!--                 <div class="row">
                            <div class="column"></div>
                            <div class="column width126"></div>
                            <div class="column width126"></div>
                            <div class="column"></div>
                            <div class="column"></div>
                            <div class="column width112"></div>
                            <div class="column width126"></div>
                            <a href="modify.html" class="column width90">modify</a>
                        </div>
                        <div class="row borderBottom">
                            <div class="column"></div>
                            <div class="column width126"></div>
                            <div class="column width126"></div>
                            <div class="column"></div>
                            <div class="column"></div>
                            <div class="column width112"></div>
                            <div class="column width126"></div>
                            <a href="modify.html" class="column width90">modify</a>
                        </div> -->
    </div>
</div>
<div class="sellerInfo">
    <div class="labeldetails">
        <div class="smallLabel">Search Seller</div>
        <select name="store_dropdown" class="firstdrop" id="store_dropdown">
            <option id="store_0" selected="selected" value="0" onchange="clear_access_orders()">-- Select Store --
            </option>
            <?php foreach ($stores as $store_detail) : ?>
                <option id="store_<?php echo $store_detail['store_id']; ?>"
                        value="<?php echo $store_detail['store_id']; ?>"
                        onclick="return store_info(<?php echo $store_detail['store_id']; ?>)"><?php echo $store_detail['store_id']; ?>
                    - <?php echo $store_detail['store_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php foreach ($stores as $store_detail) : ?>
        <input type="hidden" id="h1_<?php echo $store_detail['store_id']; ?>"
               value="<?php echo $store_detail['store_name']; ?>">
        <input type="hidden" id="h2_<?php echo $store_detail['store_id']; ?>"
               value="<?php echo $store_detail['marketing_name']; ?>">
        <input type="hidden" id="h3_<?php echo $store_detail['store_id']; ?>"
               value="<?php echo $store_detail['store_url']; ?>">
        <input type="hidden" id="h4_<?php echo $store_detail['store_id']; ?>"
               value="<?php echo $store_detail['owner_name']; ?>">
        <input type="hidden" id="h5_<?php echo $store_detail['store_id']; ?>"
               value="<?php echo $store_detail['contact_number']; ?>">
        <input type="hidden" id="h6_<?php echo $store_detail['store_id']; ?>"
               value="<?php echo $store_detail['contact_email']; ?>">
        <input type="hidden" id="h7_<?php echo $store_detail['store_id']; ?>"
               value="<?php echo $store_detail['owner_city']; ?>">
    <?php endforeach; ?>
    <input type="button" id="home1" value="home" align="left"/>

    <div class="bigLabel clear_both">Seller Details</div>
    <div class="labeldetails">
        <div class="smallLabel">Store Name</div>
        <input type="text" id="s1" name="store_name" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Brand/ Marketing Name</div>
        <input type="text" id="s2" name="brand_name" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Seller URL</div>
        <input type="text" id="s3" name="seller_url" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Contact Person Full Name</div>
        <input type="text" id="s4" name="firstName" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails paddingRight0">
        <div class="smallLabel">Contact Person Mobile Number</div>
        <input type="text" id="s5" name="mobile_no" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails clear_both">
        <div class="smallLabel">Contact Person Email</div>
        <input type="text" id="s6" name="pers_email" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="labeldetails">
        <div class="smallLabel">Communication City</div>
        <input type="text" id="s7" name="commCity" class="text_field seller" disabled="disabled"/>
    </div>
    <div class="fl">
        <input type="button" value="Make Changes" id="change_store" class="savechanges"/>
        <input disabled="true" type="button" id="save_store" value="Save Changes" class="savechanges"
               onclick="return save_store_info()"/>
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
<div class="das">
    <input type="button" id="home" value="home"/>
</div>
<div class="pickuptoday">
</div>
<div class="order">
    <input type="button" id="home" value="home"/>

    <div align="center" class="bigLabelcl"><b>Buynbrag Orders</b></div>
    <div align="center" class="labeldetails" style="float:none !important;">
        <div align="center" class="smallLabel"><b>Order Type</b></div>
        <select class="firstdrop" id="all_status_filter">
            <option onclick="all_order_filter_paged(this.value)" selected="selected" value="0"
                    id="allOrderFilterDropDown">All
            </option>
            <option onclick="all_order_filter(1)" value="1">New/Pending Orders</option>
            <option onclick="all_order_filter(2)" value="2">In Process</option>
            <option onclick="all_order_filter(3)" value="3">Shipping</option>
            <option onclick="all_order_filter(4)" value="4">Completed</option>
            <option onclick="all_order_filter(5)" value="5">Cancelled Order</option>
            <option onclick="all_order_filter(6)" value="6">Problem with Order</option>
        </select>

        <div align="left" class="search0"><b>Search by orderID:</b><input type="text" id="search"><input type="button"
                                                                                                         value="search"
                                                                                                         id="search1"
                                                                                                         onclick="order_searched()">
        </div>
        <div id="all_orders_table">
        </div>
    </div>
</div>
<br><br><br>

<div id="loader" align="left" style="display:none">
    <img src="<?php echo $base_url; ?>assets/loader.gif" width="400" height="400" alt="Loding Please Wait"/></div>
 <div class="box"  id="transaction-view"style="display=none">
        <div class="button b-close" title="Close" id="closeMbtn">x</div>
         <div id="transaction-view-header"></div>
            <table id ="transaction-user-detail" style=""><tbody></tbody></table>
            <table id ="transaction-cart-detail" style=""><tbody></tbody></table>
            <div id="transaction-view-header2"></div>
            <table id ="transaction-user-aftercheckout" style="display:inline-block;"></table>
            <table id ="transaction-bank-detail" style="float: right;display:inline-block;"><tbody></tbody></table>
            <table id ="transaction-cart-aftercheckout" style=""><tbody></tbody></table>
           
      </div>
</body>
<script type="text/javascript">
    function save_buyerdetails() {
        var shp_fname = $('#shp_fname').val();
        var shp_lname = $('#shp_lname').val();
        var shp_email = $('#shp_email').val();
        var shp_mob = $('#shp_mob').val();
        var shp_add = $('#shp_add').val();
        var shp_city = $('#shp_city').val();
        var shp_state = $('#shp_state').val();
        var shp_country = $('#shp_country').val();
        var shp_pin = $('#shp_pin').val();
        $.ajax({
            url: "<?php echo $base_url; ?>index.php/crm/modify_last_purchase_details/<?php #echo $base_url; ?>?shp_fname=" + shp_fname + "&shp_lname=" + shp_lname + "&shp_email=" + shp_email + "&shp_mob=" + shp_mob + "&shp_add=" + shp_add + "&shp_city=" + shp_city + "&shp_state=" + shp_state + "&shp_country=" + shp_country + "&shp_pin=" + shp_pin,
            success: function (data) {
                alert(data);
            }
        });
    }
</script>
<script type="text/javascript">
function store_info(id) {
    $('#access_orders').html($('#loader').html());
    $('#access_orders').show();
    var d1 = $("#h1_" + id).val();
    var d2 = $("#h2_" + id).val();
    var d3 = $("#h3_" + id).val();
    var d4 = $("#h4_" + id).val();
    var d5 = $("#h5_" + id).val();
    var d6 = $("#h6_" + id).val();
    var d7 = $("#h7_" + id).val();
    $("#s1").val(d1);
    $("#s2").val(d2);
    $("#s3").val(d3);
    $("#s4").val(d4);
    $("#s5").val(d5);
    $("#s6").val(d6);
    $("#s7").val(d7);
    $.ajax({
        url: "<?php echo $base_url; ?>index.php/crm/orders_stores/" + id,
        success: function (data) {
            $("#access_orders").html(data);
            $('#access_orders').show();
        }
    });
}
function order_filter(store_id, type) {
    $('#access_orders').html($('#loader').html());
    $('#access_orders').show();
    $.ajax({
        url: "<?php echo $base_url; ?>index.php/crm/orders_stores/" + store_id + "/" + type,
        success: function (data) {
            $("#access_orders").html(data);
            $('#access_orders').show();
        }
    });
}
function all_order_filter(type) {
//$('#all_orders_table').html($('#loader').html());
//$('#all_orders_table').show();
    $.ajax({
        url: "<?php echo $base_url; ?>index.php/crm/orders_all/" + type,
        success: function (data) {
            $("#all_orders_table").html(data);
            $('#all_orders_table').show();
        }
    });
}
function order_searched() {
    var x = document.getElementById('search').value;
    $.ajax({
        url: "<?php echo $base_url; ?>index.php/crm/searched_order/" + x,
        success: function (data) {
            $("#all_orders_table").html(data);
            $('#all_orders_table').show();
        },
        error: function (data) {
            alert(data);
        }
    });
}
function all_order_filter_paged(pageNumber) {
    //$('#all_orders_table').html($('#loader').html());
    //$('#all_orders_table').show();
    $.ajax(
        {
            url: "<?php echo $base_url; ?>index.php/crm/orders_all/0/" + pageNumber,
            success: function (data) {
                $("#all_orders_table").html(data);
                $('#all_orders_table').show();
            }
        });
}
function pickup(date, date1, date2) {
    //$('#all_orders_table').html($('#loader').html());
    //$('#all_orders_table').show();
    $.ajax(
        {
            url: "<?php echo $base_url; ?>index.php/crm/bydate/pu/" + date + "-" + date1 + "-" + date2,
            success: function (data) {
                $(".pickuptoday").html(data);
                $(".das").show();
                $(".pickuptoday").show();
                $('.bigLabel2_fl').hide();
            }
        });
}
function all_order_filterstore(name, pageNumber) {
//$('#all_orders_table').html($('#loader').html());
//$('#all_orders_table').show();
    $.ajax({
        url: "<?php echo $base_url; ?>index.php/crm/store/" + name + "/0/" + pageNumber,
        success: function (data) {
            $("#all_orders_table").html(data);
            $('#all_orders_table').show();
        }
    });
}
function clear_access_orders() {
    $('#access_orders').html($('#loader').html());
    $('#access_orders').show();
}
function save_store_info() {
    var sid = $('#store_dropdown:last').val();
    var r1 = $("#s1").val();
    var r2 = $("#s2").val();
    var r3 = $("#s3").val();
    var r4 = $("#s4").val();
    var r5 = $("#s5").val();
    var r6 = $("#s6").val();
    var r7 = $("#s7").val();
    $.ajax({
        url: "<?php echo $base_url; ?>index.php/crm/save_store/" + sid + "?s1=" + r1 + "&s2=" + r2 + "&s3=" + r3 + "&s4=" + r4 + "&s5=" + r5 + "&s6=" + r6 + "&s7=" + r7,
        success: function (data) {
            alert(data);
        }
    });
    $('#store_dropdown').attr('disabled', false);
    $('#change_store').attr('disabled', false);
    $('#save_store').attr('disabled', true);
}
function all_modify_status(id, txnid, pageNumber, productid, quantity) {
//alert(id);
    var status;
    status = $("#bnb_sts_" + id).val();
    console.log(status);
//alert (status);

    if (status == 2 || status == 21 || status == 22) {
        window.open('<?php echo $base_url; ?>index.php/crm/modify_order/' + id + '/' + status + '/' + txnid);
        all_order_filter(st_id);
        return 0;
    }
    if (status == 5) {
        var row = document.getElementById(id);
        console.log('ID =' + id);
        row.parentNode.removeChild(row);
        jQuery.ajax
                ({
                    url: baseUrl + 'bnb_crm/index.php/crm/updateDBv/' + productid + '/' + quantity + '/' + status + '/' + id,
                    type: 'GET',
                    success: function()
                    {
                        console.log("Request to update order's status");
                        alert("updateDBv successfully changed");
                    }
                });
    }
    if (status == 4) {
        window.location.href('<?php echo $base_url; ?>index.php/crm/orderDelivered/' + id);
    }
    var st_id = $('#all_status_filter:last').val();

    var shippingdate = $("#shippingdate" + id).val();
//alert(shippingdate);
    var shippingtime = $("#shippingtime" + id).val();
//alert(shippingtime);
//var dataString = 'shippingdate=' + shippingdate + 'shippingtime=' +shippingtime;
//alert(dataString);
    $.ajax({

        //data: dataString,
        url: "<?php echo $base_url; ?>index.php/crm/modify_order/" + id + '/' + status + '/' + txnid + '/' + shippingdate + '/' + shippingtime,
        success: function (data) {
            alert(data);
            console.log('inside ajax request of all_modify_status. pageNumber = ' + pageNumber);
            all_order_filter_paged(st_id, pageNumber);
        }
    });
}

/* added by shammi for multiple modifiation of order statuses */
var modifyOrders = function () {
    var filter = document.getElementById("all_status_filter").value;
    var operation = new String(document.getElementById("operationsAllxxx").value); // the operation to be performed
    var allTransxxx = new String(document.getElementById("allTxnsxxx").value); // all transactions
    var allOrdersxxx = new String(document.getElementById("allOrdersxxx").value); // all orders
    allTransxxx = allTransxxx.split(','); // arrange all trans data in an array
    allOrdersxxx = allOrdersxxx.split(','); // arrange all order data in an array
    var i = 0; // looper
    var toModify = new Array();
    var j = 0; // for indexing the toModify array
    for (; i < allTransxxx.length; i++) // loop through all transactions
    {
        if (document.getElementById("orderNo" + allOrdersxxx[i])) {
            if (document.getElementById("orderNo" + allOrdersxxx[i]).checked) // if a particular row has been checked
            {
                toModify[j] = allOrdersxxx[i] + "__" + allTransxxx[i]; // push the data to array in the format: o__t;
                j++;
            }
        }
    }
    var toModifyStr = encodeURIComponent(toModify.join('|'));
    if (toModify.length > 0) {
        window.open('<?php echo $base_url; ?>index.php/crm/modifyOrders/' + operation + '/' + toModifyStr);
        /* use this if you wish to stay on the same view before and after the operation */
        setTimeout('all_order_filter(' + filter + ')', 3000);

        /* use this if you wish to go to the view same as the operation being done after the operation */
        //document.getElementById("all_status_filter").selectedIndex = operation;
        //setTimeout('all_order_filter('+operation+')',3000);
    }
}
/* added by shammi for multiple modifiation of order statuses */
function modify_status(id, txnid) {
    var status;
    status = $("#sts_" + id).val();
    if (status == 2 || status == 21 || status == 22) {
        window.open('<?php echo $base_url; ?>index.php/crm/modify_order/' + id + '/' + status + '/' + txnid);
        all_order_filter(st_id);
        return 0;
    }
    var sid = $('#store_dropdown:last').val();
    $.ajax({
        url: "<?php echo $base_url; ?>index.php/crm/modify_order/" + id + "/" + $("#sts_" + id).val() + '/' + txnid,
        success: function (data) {
            alert(data);
            return store_info(sid);
        }
    });
}
function logout() {
    var baseUrl = '<?php echo $base_url; ?>';
    $.ajax({
        type: "POST",
        url: baseUrl + 'index.php/crm/logout',

        success: function (data) {
            window.location.reload();
        }
    });
}
jQuery('#changepick').click(function () {
    var a = prompt("order Id :", "");
    var b = prompt("New Date(Y-m-d)", "");
    if (a != null && b != null) {
        jQuery.ajax(
            {
                url: "<?php echo $base_url; ?>index.php/inv/updatepick",
                type: 'POST',
                data: {a: a, b: b},
                success: function (data) {
                    console.log("data = " + data);
                    if (data.updated === true) {
                        alert('updated successfully');
                        console.log("data = " + data);
                    }
                    else {
                        alert("Unable to update");
                    }
                },
                error: function (data) {
                    alert(data);
                }
            });
    }
});
$(function () {
    //$('#dropdown1').change(function() {
    //$('.table').hide();
    //$('#'+$(this).val()).show();
    //});
    $('.hideit').hide();
    $('#dropdown').change(function () {
        $('.hideit').hide();
        $('#' + $(this).val()).show();
        $('.mailing').hide();
    });
    $('#search_buyer').click(function () {
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.sellerInfo').hide();
        $('.export').hide();
        $('.cod').hide();
        $('.order').hide();
        $('.buyerInfo').show();
        $('.mailing').hide();
    });
    $('#seldet').click(function () {
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.sellerInfo').show();
        $('.export').hide();
        $('.cod').hide();
        $('.order').hide();
        $('.bigLabel2_fl').hide();
        $('.mailing').hide();
    });
    $('#export').click(function () {
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.sellerInfo').hide();
        $('.buyerInfo').hide();
        $('.cod').hide();
        $('.order').hide();
        $('.export').show();
        $('.mailing').hide();
    });
    $('#search_seller').click(function () {
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.cod').hide();
        $('.order').hide();
        $('.sellerInfo').hide();
        $('.mailing').hide();
    });
    $('#cod').click(function () {
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.sellerInfo').hide();
        $('.order').hide();
        $('.cod').show();
        $('.mailing').hide();
    });
    $('#ord').click(function () {
        $(this).css('background-color', '#0a6d52');
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.sellerInfo').hide();
        $('.cod').hide();
        $('.bigLabel2_fl').hide();
        $('.order').show();
        $('.mailing').hide();
    });
    $('#picktoday').click(function () {
        $(this).css('background-color', '#0a6d52');
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.sellerInfo').hide();
        $('.cod').hide();
        $('.bigLabel2_fl').hide();
        $('.pickuptoday').show();
        $('.mailing').hide();
        window.location.replace();
    });
    $('#search1').click(function () {
        $(this).css('background-color', '#0a6d52');
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.sellerInfo').hide();
        $('.cod').hide();
        $('.order').show();
        $('.mail1').hide();
        $('.mailing').hide();
    });
    $('#home').click(function () {
        $(this).css('background-color', '#0a6d52');
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.sellerInfo').hide();
        $('.cod').hide();
        $('.order').hide();
        $('.mail1').hide();
        $('.mailing').hide();
        $('.bigLabel2_fl').show();
        $('.pickuptoday').hide();
        $('.das').hide();
    });
    $('#home1').click(function () {
        $(this).css('background-color', '#0a6d52');
        $(this).css('color', '#fff');
        $(this).siblings().css('color', '#000');
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.sellerInfo').hide();
        $('.cod').hide();
        $('.order').hide();
        $('.mail1').hide();
        $('.mailing').hide();
        $('.pickuptoday').hide();
        $('.bigLabel2_fl').show();
        $('.das').hide();
    });
    $('#mail').click(function () {
        $('.export').hide();
        $('.buyerInfo').hide();
        $('.sellerInfo').hide();
        $('.cod').hide();
        $('.order').hide();
        $('.mail1').hide();
        $('.search0').hide();
        $('.smallLabel').hide();
        $('.firstdrop').hide();
        $('.bigLabelcl').hide();
        $('.mailing').show();
    });

    $('#getCSV').click(function () {
        window.open('<?php echo $base_url; ?>index.php/ordersCSV', 'ordersCSVWindow', 'scrollbars=1,height=570,width=650', false);
    });
    $('#transactionButton').click(function () {
        window.open('<?php echo $base_url; ?>index.php/transaction/display/1', 'ordersCSVWindow', 'scrollbars=1,height=570,width=650', false);
    });


    $('#enableDisable').click(function () {
        window.open('<?php echo $base_url; ?>index.php/enabledisable', 'enableDisableWindow', 'height=570,width=650', false);
    });

    $('#reportsDashboard').click(function () {
        window.open('<?php echo $base_url; ?>index.php/reportdetails', 'reportsDashboardWindow', 'scrollbars=1,height=645,width=1265', false);
    });

    $('#commentsDashboardButton').click(function () {
        window.open('<?php echo $base_url; ?>index.php/comments/display/1', 'commentsDashboardWindow', '', false);
    });

    $('#dealsDashboardButton').click(function () {
        window.open('<?php echo $base_url; ?>index.php/deals', 'dealsDashboardWindow', '', false);
    });

    $('#couponsDashboardButton').click(function () {
        window.open('<?php echo $base_url; ?>index.php/coupon', 'couponsDashboardWindow', '', false);
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
        $('#dropdown').attr('disabled', true);
        $('#bill_add').attr('disabled', true);
        $('#bill_city').attr('disabled', true);
        $('#bill_state').attr('disabled', true);
        $('#bill_country').attr('disabled', true);
        $('#bill_pin').attr('disabled', true);
        $('#cancel').attr('disabled', false);
        $('#save').attr('disabled', false);
//                $('#option').attr('disabled',true);
//                $('#ent_option').attr('disabled',true);
    });
    $('#cancel').click(function () {
        $('.buyer').attr('disabled', true);
        $('#dropdown').attr('disabled', false);
        $('#cancel').attr('disabled', true);
        $('#save').attr('disabled', true);
    });
    $('#change_store').click(function () {
        $('.seller').attr('disabled', false);
        $('#store_dropdown').attr('disabled', true);
        $('#change_store').attr('disabled', true);
        $('#save_store').attr('disabled', false);
    });

});
</script>
<!-- ================== shivam's code -============================-->
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> -->
<script type="text/javascript">
    var baseURL = <?php echo "'".base_url()."'"; ?>;
    $(".invoice").click(function () {
        console.log("error");
        var x = this.value;
        var n = x.split("_");
        $.ajax(
            {
                url: baseURL + "index.php/inv",
                type: 'POST',
                data: {a: n[0], b: n[1]},
                success: function (data) {
                    if (n[0] === "default")
                        $("#shivam_" + n[1]).html("<a href=" + data.db + ">" + data.dc + "</a>|<a href=" + data.dd + ">" + data.de + "</a>");
                    else
                        $("#shivam_" + n[1]).html("<a href=" + data.db + ">" + data.dc + "</a>|<a href=" + data.dd + ">" + data.de + "</a>|<a href=" + data.df + ">" + data.dg + "</a>");

                },
                error: function (data) {
                    console.log(error);
                }
            });
        return false;
    });

   /* $(".str").change(function () {
        var x = this.value;
        if (x.indexOf(' ') >= 0)
            var x1 = x.split(" ").join("_");
        else
            var x1 = x.split("'").join(".");

        window.location.replace(baseURL + 'index.php/crm/store/' + x1);
    });*/
    /*$(".obdate").change(function () {
        var p = "ob";
        alert(p);
        var x = this.value;
        window.open(baseURL + 'index.php/crm/bydate/' + p + '/' + x);
    });*/
    /*$(".pudate").change(function () {
        var p = "pu";
        var x = this.value;
        window.open(baseURL + 'index.php/crm/bydate/' + p + '/' + x);
    });*/
    $(".home2").click(function () {
        window.location.replace(baseURL + 'index.php/crm');
    });
</script>
<!-- ================== END SECTION shivam's code -============================-->
</html>
