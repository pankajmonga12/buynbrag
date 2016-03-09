<html>

<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<script src="<?php echo $baseURL; ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/jquery-ui.min.js"></script>
<script src='<?php echo $baseURL; ?>assets/js/jquery.bpopup-x.x.x.min.js'></script>
<style type="text/css" >
input[type=text]
{
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width: 150px;
  min-height: 28px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
  float: left;
  display: inline;
  margin-left: 1em;
}
textarea#txtArea {
  width: 400px;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
  float: left;
  margin-left: 1em;
}
label{
  font-family: Tahoma;
  float: left;
  display: inline;
  margin-left: 1em;
}
	body {
background-color: aliceblue;
}
a {
text-decoration: none;
color: cornflowerblue;
cursor: pointer;
}
a:hover {
text-decoration: underline;
cursor: pointer;
color: #DD127B;

}
.pagination {
margin-left: 35%;
margin-bottom: 10px;
}
	input[type="submit"] {
width: 80px;
background-color: aliceblue;
}
table{
		border-collapse: collapse;

	}
	td,th{
		border: 1px solid #666666;
		padding: 4px;
	}
	.thead {
color: white;
background-color: black;
}
    .button {
    margin-top: 2em;
    margin-left: 20em;
    background: #E48F8F;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
}
		   input#addbutton {
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
      padding: 20px;
      position: absolute;
      top: 10em;
      left: 15em;
      width: 800px;
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
 </style>
 <script type="text/javascript">
  function beforCheckout(transID) {

         $.ajax
                      ({
                          url: "<?php echo $baseURL;?>index.php/transaction/beforeCheckout",
                          data: {transID:transID},
                          type: 'GET',
                         success :   function(data){
                          console.log(data);
                            console.log('success');
                  document.getElementById("transaction-bank-detail").innerHTML='';
                  document.getElementById("transaction-view-header").innerHTML='<h2><center>DETAIL OF TRANSACTION BEFOR CHECKOUT</center></h2>';
                  document.getElementById("transaction-user-detail").innerHTML='<br><b><h3>USER DETAIL</h3></b>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>FULL NAME:  <b>'+data.post.firstname+' '+data.post.lastname+'<br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>PAYEMENT TYPE TEMP- </b>'+data.post.pgTmp+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>PAYEMENT TYPE- </b>'+data.post.pg+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>AMOUNT- </b>'+data.post.amount+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>SHIPPING ADDRESS- </b>'+data.post.address1+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>CITY- </b>'+data.post.city+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>STATE- </b>'+data.post.state+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>COUNTARY- </b>'+data.post.country+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>ZIPCODE- </b>'+data.post.zipcode+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>CONTACT NO.- </b>'+data.post.mob_country_code+'</br>';

                  document.getElementById("transaction-cart-detail").innerHTML='<br><b><h3>CART DETAIL</h3></b>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>CART ID -  </b>'+data.cartState[0].cart_id+'<br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>CART QUANTITY - </b>'+data.cartState[0].cart_quantity+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>PRODUCT ID - </b>'+data.cartState[0].product_id+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>PRODUCT NAME - </b>'+data.cartState[0].product_name+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>STORE ID - </b>'+data.cartState[0].store_id+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>PRODUCT QUANTITY - </b>'+data.cartState[0].quantity+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>SELLING PRICE - </b>'+data.cartState[0].selling_price+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>SHIPPING COST - </b>'+data.cartState[0].shipping_cost+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>SHIPPING PARTNER - </b>'+data.cartState[0].shipping_partner+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>TAX RATE - </b>'+data.cartState[0].tax_rate+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>USER ID - </b>'+data.cartState[0].user_id+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>DISCOUNT STATUS - </b>'+data.cartState[0].is_on_discount+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>DISCOUNT VALUE - </b>'+data.cartState[0].discount+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>VARIENT SIZE - </b>'+data.cartState[0].vcolor+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>VARIENT COLOR - </b>'+data.cartState[0].vsize+'</br>';

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
  function afterCheckout(transID) {

         $.ajax
                      ({
                          url: "<?php echo $baseURL;?>index.php/transaction/afterCheckout",
                          data: {transID:transID},
                          type: 'GET',
                         success :   function(data){
                            console.log('success');
                  document.getElementById("transaction-user-detail").innerHTML='';
                  document.getElementById("transaction-cart-detail").innerHTML='';
                  document.getElementById("transaction-view-header").innerHTML='';
                  document.getElementById("transaction-view-header").innerHTML='<h2><center>DETAIL OF TRANSACTION AFTER CHECKOUT</center></h2>';
                  document.getElementById("transaction-user-detail").innerHTML='<br><b><h3>ORDER DETAIL</h3></b>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>PAYEMENT TYPE -  <b>'+data.post.PG_TYPE+'<br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>DATE OF ORDER - </b>'+data.post.addedon+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>FULL NAME -  <b>'+data.post.firstname+' '+data.post.lastname+'<br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>ADDRESS - </b>'+data.post.address1+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>CITY - </b>'+data.post.city+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>STATE - </b>'+data.post.state+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>COUNTARY - </b>'+data.post.country+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>ZIPCODE - </b>'+data.post.zipcode+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>CONTACT NO. - </b>'+data.post.phone+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>EMAIL ID - </b>'+data.post.email+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>AMOUNT PAID - </b>'+data.post.amount+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>DISCOUNT - </b>'+data.post.discount+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>COUPON ID - </b>'+data.post.udf3+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>COUPON AMOUNT - </b>'+data.post.udf4+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>COUPON STATUS - </b>'+data.post.unmappedstatus+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>PRODUCT INFO - </b>'+data.post.productinfo+'</br>';
                  document.getElementById("transaction-user-detail").innerHTML+='<b>STATUS - </b>'+data.post.status+'</br>';

                  document.getElementById("transaction-bank-detail").innerHTML='<br><b><h3>BANK DETAIL</h3></b>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>BANK REF. NO. -  <b>'+data.post.bank_ref_num+'<br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>BANK CODE - </b>'+data.post.bankcode+'</br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>CARD NO. -  <b>'+data.post.cardnum+'<br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>TRANSACTION MODE - </b>'+data.post.mode+'</br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>NAME ON CARD - </b>'+data.post.name_on_card+'</br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>AMOUNT DEBIT - </b>'+data.post.net_amount_debit+'</br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>PAYEMENT SOURCE - </b>'+data.post.payment_source+'</br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>PAY ID - </b>'+data.post.mihpayid+'</br>';
                  document.getElementById("transaction-bank-detail").innerHTML+='<b>TRANSACTION ID - </b>'+data.post.txnid+'</br>';
  
                  

                  document.getElementById("transaction-cart-detail").innerHTML='<br><b><h3>CART DETAIL</h3></b>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>CART ID -  </b>'+data.cartState[0].cart_id+'<br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>CART QUANTITY - </b>'+data.cartState[0].cart_quantity+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>PRODUCT ID - </b>'+data.cartState[0].product_id+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>PRODUCT NAME - </b>'+data.cartState[0].product_name+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>STORE ID - </b>'+data.cartState[0].store_id+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>PRODUCT QUANTITY - </b>'+data.cartState[0].quantity+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>SELLING PRICE - </b>'+data.cartState[0].selling_price+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>SHIPPING COST - </b>'+data.cartState[0].shipping_cost+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>SHIPPING PARTNER - </b>'+data.cartState[0].shipping_partner+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>TAX RATE - </b>'+data.cartState[0].tax_rate+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>USER ID - </b>'+data.cartState[0].user_id+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>DISCOUNT STATUS - </b>'+data.cartState[0].is_on_discount+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>DISCOUNT VALUE - </b>'+data.cartState[0].discount+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>VARIENT SIZE - </b>'+data.cartState[0].vcolor+'</br>';
                  document.getElementById("transaction-cart-detail").innerHTML+='<b>VARIENT COLOR - </b>'+data.cartState[0].vsize+'</br>';

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
</head>
<body>
<button onClick="window.close();return true;">Return to CRM BASE</button>
<div class = "head" style="height:600;">
 <table align='center'>
    <thead class ="thead">
        <th>S. No.</th>
        <th>ORDER ID</th>
        <th>Transaction ID</th>
        <th>Date of Transaction</th>
        <th colspan="2">CHECKOUT DETAIL</th>
         
    </thead>
<tbody>
 <?php foreach($taxID as $q): ?>
  <tr>
    <td><?php echo $i++; ?></td>
    <td><?php echo $q->orderID ?></td>
    <td><?php echo $q->taxID ?></td>
    <td><?php echo $q->dateOfOrder ?></td>
     <?php echo "<td><button onclick=\"beforCheckout('".$q->taxID."')\">BEFORE CHECKOUT</button></td>";
     echo "<td><button onclick=\"afterCheckout('".$q->taxID ."')\">AFTER CHECKOUT</button></td>";
  ?>
  </tr>
     <?php endforeach; ?>
       <div class = "pagination"><?php echo $pagination ?>
       </div>
      </div>
     </tbody>
    </table>
      <div class="box"  id="transaction-view"style="display=none">
        <div class="button b-close" title="Close" id="closeMbtn">x</div>
         <div id="transaction-view-header"></div>
            <div id ="transaction-user-detail" style="float:left;display:inline-block;"></div>
            <div id ="transaction-bank-detail" style="float:left;"></div>
            <div id ="transaction-cart-detail" style="float:right;display:inline-block;"></div>
           
         </div>
 </body>
</html>