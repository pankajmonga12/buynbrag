<html>
<head>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
              console.log('redirecting user to ' + 'http://localhost/seller/index.php/productsCsv/prodCSV/' + start + '/' + end);
                location.href = 'http://localhost/seller/index.php/productsCsv/prodCSV/' + start + '/' + end;
            
                  }
          }
/*==========================================  PRODUCTS DETAIL CSV FUNCTION END =================================================*/         
</script>
</head>
<body>
<table>
<tr><td><h2><b>PRODUCTS DETAIL</b></h2></td></tr>
<tr>
  <td>
    <table>
     <tr>
     <td><label for="StartD">Start Product ID:</label></td>
        <td><input type="text" id="startProductID" placeholder="Start Product Id"></td>
        <td><label for="StartD">End Product ID:</label></td>
        <td><input type="text"id="endProductID" class="endDate" placeholder="End Product Id"></td>
        <td><input type="submit"class="button" value="Get Products As CSV" onclick = "product_csv()"></td>
     </tr>
   </table>
   </td>
   </tr>
   </table>
   </body>
</html>