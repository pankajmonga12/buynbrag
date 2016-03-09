<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Coupon</title>
	<link rel="stylesheet" href='<?php echo base_url(); ?>assets/css/loginStyle.css' type="text/css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type = "text/javascript">
	var parameter = 0;
  var storeName = '';
  var categoryName = '';
  var validityParameter = '';
  $(document).ready(function($)
  {
    $('#deleteCoupon').hide();
    $('#alterCoupon').hide();
    $('#createButton').hide();
    $('#createButton2').hide();
    $('#storeName').hide();
    $('#categoryName').hide();
    $('#validDate').hide();
    $('#changeValidity2').hide();
    $.ajax
    ({
        url: "<?php echo $baseURL; ?>index.php/reportdetails/storeDetails",
        data: {},
        type: 'GET',
        success: function(data)
        {   
          $.each(data, function(key, value)
          {
            $('#storeDropdown').append('<option value =' +value.store_id+'>'+value.store_name+'('+value.store_id+')</option>'); 
          });
        }
    });
    $.ajax
    ({
        url: "<?php echo $baseURL; ?>index.php/deals/categoryDetails",
        data: {},
        type: 'GET',
        success: function(data)
        {   
          $.each(data, function(key, value)
          {
            $('#categoryDropdown').append('<option value =' +value.category_id+'>'+value.category_name+'('+value.category_id+')</option>'); 
          });
        }
    });
    $('#couponid').blur(function()
    {
      var couponID = $('#couponid').val();
      var result = $('#availResult');
      $.ajax
      ({
          url: "<?php echo $baseURL; ?>index.php/deals/checkCoupon",
          data: {couponID:couponID},
          type: 'GET',
          success: function(data)
          {   
            console.log(data);
            if(data == true)
            {
              result.html('<span style = "color:red;font-size: 15px;">Coupon ID already exists. Please choose a different coupon ID.</span>');
            }
          }
      });
    });
    $('#couponid3').blur(function()
    {
      var couponID = $('#couponid3').val();
      $.ajax
      ({
          url: "<?php echo $baseURL; ?>index.php/deals/checkCouponValidity",
          data: {couponID:couponID},
          type: 'GET',
          success: function(data)
          {   
            console.log(data);
            $('#validupto3').val(data);
          }
      });
    });
    $('#deleteButton').click(function()
    {
     $('#createCoupon').hide();
     $('#alterCoupon').hide();
     $('#deleteCoupon').show();
     $('#deleteButton').hide();
     $('#createButton2').hide();
     $('#createButton').show();
     $('#alterButton').show();
    });
    $('#alterButton').click(function()
    {
      $('#deleteCoupon').hide();
      $('#createCoupon').hide();
      $('#alterCoupon').show();
      $('#alterButton').hide();
      $('#deleteButton').show();
      $('#createButton2').show();
      $('#createButton').hide();
    });
    $('.createNew').click(function()
    {
      $('#alterButton').show();
      $('#deleteButton').show();
      $('.createNew').hide();
      $('#deleteCoupon').hide();
      $('#alterCoupon').hide();
      $('#createCoupon').show();
    })
    $('#create').click(function()
    {
      var isValid = true;
      var couponID = $('#couponid').val();
      var percentOff = $('#percentoff').val();
      var useCount = $('#usecount').val();
      var discountType = $('#discounttype').val();
      var validFrom = $('#validfrom').val();
      var validUpto = $('#validupto').val();
      var minimumPurchaseAmount = $('#minimumpurchaseamount').val();
      var userName = $('#username').val();
      var visibility = $('#visibility').val();
      console.log(parameter);
      //console.log(categoryName);
      //console.log(storeName);
      $('input[type="text"]').each(function() 
      {
        if ($.trim($(this).val()) == '') 
        {
          isValid = false;
          $(this).css
          ({
              "border": "1px solid red",
          });
        }
          else 
        {
        $(this).css
        ({
            "border": "",
            "background": "",
        });
      }
      if (isValid == false)
      {
        event.preventDefault();
      }
        else
      {
        console.log(couponID+percentOff+useCount+discountType+validFrom+validUpto+minimumPurchaseAmount+userName+parameter+visibility);
        $.ajax
        ({
            url: "<?php echo $baseURL; ?>index.php/deals/generateCoupon/",
            data: {couponID:couponID,percentOff:percentOff,useCount:useCount,discountType:discountType,validFrom:validFrom,validUpto:validUpto,
              minimumPurchaseAmount:minimumPurchaseAmount,userName:userName,parameter:parameter,visibility:visibility},
            type: 'GET',
            success: function(data) 
            {
              if(data == true)
              {
                alert('coupon successfully created');
              }
              else
              {
                alert('something went wrong');
              }
            },
            error: function(error) 
            {
                console.log("an error", error);
                alert('something went wrong');
            }
        });
      }
      })
    });
    $('#delete').click(function()
    {
      var couponID = $('#couponid2').val();
      $.ajax
      ({
          url: "<?php echo $baseURL; ?>index.php/deals/deleteCoupon/",
          data: {couponID:couponID},
          type: 'GET',
          success: function(data) 
          {
            alert('selected option successfully updated');
          },
          error: function(error) 
          {
            console.log("an error", error);
          }
      });
    })
    $('#alter').click(function()
    {
      var validityParameter = ''; 
      var couponID = $('#couponid3').val();
      var validityUpto = $('#validupto3').val();
      var validityUpto2 = $('#validupto2').val();
      if(validityUpto2 == '' || null)
      {
        validityParameter = validityUpto;
      }
      else
      {
        validityParameter = validityUpto2;
      }
      var visibility = $('#visibility2').val();
      console.log(validityParameter);
      $.ajax
      ({
          url: "<?php echo $baseURL; ?>index.php/deals/alterCoupon/",
          data: {couponID:couponID,validityParameter:validityParameter,visibility:visibility},
          type: 'GET',
          success: function(data) 
          {
            if(data == true)
            {
              alert('coupon successfully altered');
            }
            else
            {
              alert('something went wrong');
            }
          },
          error: function(error) 
          {
            console.log("an error", error);
            alert('something went wrong');
          }
      });
    })
    $('#discounttype').change(function()
    {
      var discountType = $('#discounttype').val();
      console.log('from discount switch' + discountType);
      switch(discountType)
      {
        case '0':
        $('#parameterValue').show();
        $('#storeName').hide();
        $('#categoryName').hide();
        break;
        case '1':
        $('#parameterValue').show();
        $('#categoryName').hide();
        $('#storeName').hide();
        break;
        case '5':
        $('#storeName').hide();
        $('#categoryName').show();
        $('#parameterValue').hide();
        console.log("changed the discount ype " + parameter);
        break;
        case '8':
        $('#storeName').show();
        $('#categoryName').hide();
        $('#parameterValue').hide();
        console.log("changed the discount ype " + parameter);
        break;
      }
    });
    $('#storeDropdown').change(function()
    {
      storeName = $('#storeDropdown').val();
      parameter = storeName;
      categoryName = null;
    });
    $('#categoryDropdown').change(function()
    {
      categoryName = $('#categoryDropdown').val();
      parameter = categoryName;
      categoryName = null;
    });
    $('#changeValidity').click(function()
    {
      $('#validDate2').hide();
      $('#validDate').show();
      $('#changeValidity').hide();
      $('#changeValidity2').show();
    })
    $('#changeValidity2').click(function()
    {
      $('#validDate').hide();
      $('#validDate2').show();
      $('#changeValidity2').hide();
      $('#changeValidity').show();
      $('#validupto2').val(null);
    })
 });
  </script>
</head>
<body>
  <input type="button" onClick="window.close();return true;" value="Return to CRM BASE">
  <input style = "float:left;margin-left:20px;" id = "deleteButton" type = "button" value = "Delete Coupon">
  <input style = "margin-right:20px;"type = "button" id = "alterButton" value = "Alter Coupon">
  <input style = "float:left;margin-left:20px;" id = "createButton" class = "createNew" type = "button" value = "Create Coupon">
  <input style = "margin-right:20px;" id = "createButton2" class = "createNew" type = "button" value = "Create Coupon">
  <div></div>
  <div class = "form" id = "createCoupon">
      <h1>CREATE COUPON</h1>
      <div class="inset">
      <p>
        <label for="couponid">COUPON ID</label>
        <div id = "availResult"></div>
        <input type="text" id="couponid" placeholder = "Coupon Id">
      </p>
      <p>
        <label for="percentoff">PERCENT OFF</label>
        <input type="text" id="percentoff" placeholder = "Percent Off">
      </p>
      <p>
        <label for="accesskey">USE COUNT</label>
        <input type="text" id="usecount" placeholder = "Use Count">
      </p>
      <p>
        <label for="accesskey">DISCOUNT TYPE</label>
        <select id = "discounttype">
          <option selected="selected" value = "0">Percentage</option>
          <option value = "1">Value</option>
          <option value = "8">Store</option>
          <option value = "5">Category</option>
        </select>
      </p>
      <p id = "storeName">
        <label for="accesskey">STORE NAME</label>
        <select class = "parameter" id = "storeDropdown">
          <option selected="selected" value = "0">Select Store</option>
        </select>
      </p>
      <p id = "categoryName">
        <label for="accesskey">CATEGORY NAME</label>
        <select class = "parameter" id = "categoryDropdown">
          <option selected="selected" value = "0">Select Category</option>
        </select>
      </p>
      <p>
        <label for="accesskey">VALID FROM</label>
        <input type="date" id="validfrom" placeholder = "Valid From">
      </p>
      <p>
        <label for="accesskey">VALID UPTO</label>
        <input type="date" id="validupto" placeholder = "Valid Upto">
      </p>
      <p>
        <label for="accesskey">MINIMUM PURCHASE AMOUNT</label>
        <input type="text" id="minimumpurchaseamount" placeholder = "Minimum Purchase Amount">
      </p>
      <p>
        <label for="accesskey">USER NAME</label>
        <input type="text" id="username" placeholder = "User Name">
      </p>
      <p>
        <label for="accesskey">VISIBILITY</label>
        <select id = "visibility">
          <option selected="selected" value = "1">Public</option>
          <option value = "0">Hidden</option>
        </select>
      </p>
      </div>
      <p class="p-container">
        <input type="button" name="go" id="create" value="Create">
      </p>
  </div>
  <div id = "deleteCoupon" class = "form">
    <h1>DELETE COUPON</h1>
      <div class="inset">
      <p>
        <label for="couponid">COUPON ID</label>
        <input type="text" id="couponid2" placeholder = "Coupon Id">
      </p>
      </div>
      <p class="p-container">
        <input type="button" name="go" id="delete" value="Delete">
      </p>
  </div>
  <div id = "alterCoupon" class = "form">
    <h1>ALTER VALIDITY</h1>
      <div class="inset">
      <p>
        <label for="couponid">COUPON ID</label>
        <input type="text" id="couponid3" placeholder = "Coupon Id">
      </p>
      <p id = "validDate">
        <label for="validupto">VALIDUPTO</label>
        <input type="date" id="validupto2" class ="testing" placeholder = "Valid Upto">
      </p>
      <p id = "validDate2">
        <label for="validupto">VALIDUPTO</label>
        <input type="text" id="validupto3" class ="testing" placeholder = "Valid Upto">
      </p>
      <p>
        <label for="accesskey">VISIBILITY</label>
        <select id = "visibility2">
          <option selected="selected" value = "1">Public</option>
          <option value = "0">Hidden</option>
        </select>
      </p>
      </div>
      <p class="p-container">
        <input type="button" name="go" id="alter" value="Alter">
        <input style = "float:left;"type="button" name="go" id="changeValidity" value="ChangeDate">
        <input style = "float:left;"type="button" name="go" id="changeValidity2" value="ChangeDate">
      </p>
  </div>
  <script type = "text/javascript">
  </script>
</body>
</html>