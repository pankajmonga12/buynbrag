<html><head>
    <title>CSV REPORT LIST</title>

    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">

  /*======================================  PRODUCTS DETAIL CSV TABLE FUNCTION START =================================================*/
        function product_csv() 
        {
             var x = document.getElementById("startProductID");
             var start = x.value;
             var y = document.getElementById("endProductID");
             var end = y.value;
                  
                  if (start==null || start=='' ) 
             {
                 alert("Please enter start Date");
                 return false;
             }
             else if (end==null || end=='' ) 
             {
                 alert("Please enter END Date");
                 return false;
             }
              else if (start > end ) 
             {
                 alert("Please enter correct format");
                 return false;
             }
             else {
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/productCsv/' + start + '/' + end);
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/productCsv/' + start + '/' + end;
            
                  }
          }
/*==========================================  PRODUCTS DETAIL CSV FUNCTION END =================================================*/         
</script>
   <script type="text/javascript">
  /*======================================  STORE DETAIL CSV TABLE FUNCTION START =================================================*/
        function store_csv() 
        {
             var x = document.getElementById("fromstoreID");
             var storeID= x.value;
                  
                  if (storeID==null || storeID=='' ) 
             {
                 alert("Please enter store ID");
                 return false;
             }
             else {
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/storeCsv/' + storeID);
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/storeCsv/' + storeID;
            
                  }
          }
/*==========================================  STORE DETAIL CSV FUNCTION END =================================================*/         
</script>
<script type="text/javascript">
  /*======================================  ALL STORE DETAIL CSV  FUNCTION START =================================================*/
        function all_store_info() 
        {
             
   
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/allstoreCsv/');
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/allstoreCsv/';
            
                  
          }
/*==========================================  ALL STORE DETAIL USERID CSV FUNCTION END =================================================*/         
</script>
    <script type="text/javascript">
  /*======================================  USER DETAIL CSV TABLE FUNCTION START =================================================*/
        function user_csv() 
        {
             var x = document.getElementById("startUserID");
             var start = x.value;
             var y = document.getElementById("endUserID");
             var end = y.value;
                  
                  if (start==null || start=='' ) 
             {
                 alert("Please enter start Date");
                 return false;
             }
             else if (end==null || end=='' ) 
             {
                 alert("Please enter END Date");
                 return false;
             }
              else if (start >= end ) 
             {
                 alert("Please enter correct format");
                 return false;
             }
             else {
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/UserCSV/' + start + '/' + end);
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/UserCSV/' + start + '/' + end;
            
                  }
          }
/*==========================================  USER DETAIL CSV FUNCTION END =================================================*/         
</script>
    <script type="text/javascript">
  /*======================================  USER DETAIL FILTER EMAIL CSV TABLE FUNCTION START =================================================*/
        function user_csv_email() 
        {
             
             var x = document.getElementById("userEMAIL");
             var selectEMAIL = x.value;
       atpos = selectEMAIL.indexOf("@");
   dotpos = selectEMAIL.lastIndexOf(".");
   if (atpos < 1 || ( dotpos - atpos < 2 )) 
   {
       alert("Please enter correct email ID");
       return false;
   }
   else {
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/UserCSVEmail/' + encodeURIComponent(selectEMAIL) );
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/UserCSVEmail/' + encodeURIComponent(selectEMAIL);
            
                  }
          }
/*==========================================  USER DETAIL FILTER EMAIL CSV FUNCTION END =================================================*/         
</script>
    <script type="text/javascript">
  /*======================================  USER DETAIL FILTER USERID CSV TABLE FUNCTION START =================================================*/
        function user_csv_ID() 
        {
             
             var x = document.getElementById("User_ID");
             var userID = x.value;
         if (userID==null || userID=='' ) 
             {
                 alert("Please enter USER ID");
                 return false;
             }
   else {
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/CSVUserID/' + userID);
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/CSVUserID/' + userID;
            
                  }
          }
/*==========================================  USER DETAIL FILTER USERID CSV FUNCTION END =================================================*/         
</script>
<script type="text/javascript">
  /*======================================  Products CSV filter By Store Function Start  =================================================*/
        function store_product_csv() 
        {
           var x = document.getElementById("storeID");
             var storeID = x.value;
         if (storeID==null || storeID=='' ) 
             {
                 alert("Please enter STORE ID");
                 return false;
             }
   else {
             
   
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/CSVstoreProduct/');
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/CSVstoreProduct/'+storeID;
            
               }   
          }
/*==========================================  Products CSV filter By Store Function END =================================================*/         
</script>
<script type="text/javascript">
  /*======================================  USER CART FILTER USERID CSV  FUNCTION START =================================================*/
        function users_cart() 
        {
             
              console.log('redirecting user to ' + '<?php echo $baseURL; ?>index.php/ordersCSV/CSVCartDetail/');
                location.href = '<?php echo $baseURL; ?>index.php/ordersCSV/CSVCartDetail/';
          }
/*==========================================  USER CART FILTER USERID CSV FUNCTION END =================================================*/         
</script>
</head>
<body>
<table>
    <tr>
      <td>
        <tr>
        <td colspan="3">
        <a href="<?php echo $baseURL; ?>index.php/crm" onClick='window.close()'> CRM Home </a>
        </td>
    </tr>
<tr><td><h2><b>ORDERS DETAIL</b></h2></td></tr>

<tr>
  <td>
    <table>
    <tr>
        <td><label for="StartOrderID">Start Order ID:</label></td>
        <td><input type="text" id="fromOrderNumber" placeholder="Start Order Number"></td>
        <td><label for="EndOrderID">End Order ID:</label></td>
        <td><input type="text" id="toOrderNumber" placeholder="End Order Number"></td>
        <td><input type="button" id="getOrderButton" value="Get Orders as CSV"></td>
     </tr>
  </table>
 </td>
</tr>
<tr><td><h2><b>PRODUCTS DETAIL</b></h2></td></tr>
<tr>
  <td>
    <table>
     <tr>
        <td><label for="StartProdId">Start Product ID:</label></td>
        <td><input type="text" id="startProductID" placeholder="Start Product Id"></td>
        <td><label for="EndProdId">End Product ID:</label></td>
        <td><input type="text"id="endProductID" class="endDate" placeholder="End Product Id"></td>
        <td><input type="submit"class="button" value="Get Products As CSV" onclick = "product_csv()"></td>
     </tr>
   </table>
 </td>
</tr>
<tr><td><h2><b>Products Detail From Store ID </b></h2></td></tr>
<tr>
  <td>
    <table>
      <tr>
        <td><label for="StartD">Store ID:</label></td>
        <td><input type="text" id="storeID" placeholder="Store ID"></td>
        <td><input type="submit"class="button" value="Get ProductDetail As CSV" onclick = "store_product_csv()"></td>
       </tr>
     </table>
    </td>
   </tr>
   <tr><td><h2><b>STORE DETAIL</b></h2></td></tr>

<tr>
  <td>
    <table>
    <tr>
        <td><label for="StartD"> Store ID:</label></td>
        <td><input type="text" id="fromstoreID" placeholder="Start Store Number"></td>
        <td><input type="button" id="getStoreButton" value="Get Stores as CSV" onclick="store_csv()"></td>
     </tr>
  </table>
 </td>
</tr>
    <tr><td><h2><b>ALL Store Details</b></h2></td></tr>
<tr>
  <td>
    <table>
      <tr>

        <td><input type="submit"class="button" value="Get Allstores As CSV" onclick = "all_store_info()"></td>
       </tr>
     </table>
    </td>
   </tr>
<tr><td><h2><b>USER DETAIL</b></h2></td></tr>
<tr>
  <td>
    <table>
      <tr>
        <td><label for="StartUserID">Start User ID:</label></td> 
        <td><input type="text" id="startUserID" placeholder="Start User Id"></td>
        <td><label for="EndUserID">End User ID:</label></td>
        <td><input type="text"id="endUserID" class="endDate" placeholder="End User Id"></td>
        <td><input type="submit"class="button" value="Get UserList As CSV" onclick = "user_csv()"></td>
     </tr>
    </table>
  </td>
</tr>
<tr><td><h2><b>USER DETAIL FILTER BY USERID</b></h2></td></tr>
<tr>
  <td>
    <table>
      <tr>
        <td><label for="UserID">User ID:</label></td>
        <td><input type="text" id="User_ID" placeholder="User Id"></td>
        <td><input type="submit"class="button" value="Get Userdetail As CSV" onclick = "user_csv_ID()"></td>
       </tr>
     </table>
    </td>
   </tr>
   <tr><td><h2><b>USER DETAIL FILTER BY EMAIL</b></h2></td></tr>
<tr>
  <td>
    <table>
      <tr>
        <td><label for="EmailID">User Email:</label></td>
        <td><input type="text" id="userEMAIL" placeholder="Email Id"></td>
        <td><input type="submit"class="button" value="Get Userdetail As CSV" onclick = "user_csv_email()"></td>
       </tr>
     </table>
    </td>
   </tr>
     <tr><td><h2><b>CART DETAIL OF USER</b></h2></td></tr>
<tr>
  <td>
    <table>
      <tr>
        <td><input type="submit"class="button" value="Get Cartdetail As CSV" onclick = "users_cart()"></td>
       </tr>
     </table>
    </td>
   </tr>

 </td>
 </tr>
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