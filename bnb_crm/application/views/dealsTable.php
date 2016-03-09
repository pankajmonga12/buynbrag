<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <title>DealsView</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script> 
    <script src='<?php echo base_url(); ?>assets/js/jquery.bpopup-x.x.x.min.js'></script>
    <style>
    body
    {
        background-color: aliceblue;
    }
    table,td,th
    {
        border:1px solid black;
    }
    table
    {
        width:100%;
        border-collapse:collapse;
    }
    th
    {
        height:30px;
    }
    label
    {
    	margin-left: 120px;
    }
    input[type=submit]
    {
    	margin-left: 250px;
    	cursor: pointer;
    }
    #createPopup
    {
        background-color: #ffffff;
        opacity: 1;
        width: 500px;
        height: 250px;
        border-radius: 10px;
        border-width: 6px;
        border-style: solid;
    }
    #createDealPopup
    {
        background-color: #ffffff;
        opacity: 1;
        width: 500px;
        height: 250px;
        border-radius: 10px;
        border-width: 6px;
        border-style: solid;
    }
    .button.b-close 
    {
        border-radius: 7px 7px 7px 7px;
        background: #E48F8F;
        font: bold 131% sans-serif;
        padding: 0 6px 2px;
        position: absolute;
        right: -7px;
        top: -15px;
        box-shadow: 0 2px 3px rgba(0,0,0,0.3);
        color: #fff;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }
    </style>
    <script type = "text/javascript">
    $(document).ready(function($)
    {
    	$('#createPopup').hide();
    	$('#createDealPopup').hide();
    	$.ajax(
        {
            url: "<?php echo $baseURL; ?>index.php/deals/readDeals/",
            data: {},
            type: 'GET',
            success: function(data) 
            {
                //console.log(data.dealsDetail);
                //console.log(data);
                var i = 0;
				$.each(data.dealsDetail,function(key,  value)
                {
                    $('#tableView').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+value.dealName+'</td><td align="center">'+value.startsON+'</td><td align="center">'+value.endsON+'</td><td align="center"><select class = "actionName" id = "SelectAction'+i+'" onchange = "dealAction('+value.dealID+', this.id)"><option selected = "selected" value = "0">---Select Action---</option><option value = "1">Delete Deal</option><option value = "2">Add Products</option><option value = "3">Remove Products</option></select></td></tr>');
                    console.log(value.dealName);
                    i++;
                })
            },
            error: function(error)
            {
                console.log("an error",error);
            }
        });
		$('#createDeal').click(function ()
        {
            console.log('popup called');  
            $('#createDealPopup').bPopup(
            {
                speed:650,
                transition:'slideIn',
            });
        });
        $('#button2').click(function()
        {   
        	$('#createDealPopup').bPopup().close();
            $('#csvForm2').ajaxForm
            ({
                success: function(data) 
                { 
                    console.log(data);
                    if(Array.isArray(data))
                    {
                    	alert('successfully added');
                	}
                	else
                	{
                		alert('try again buddy');
                	}
                },
                error: function(error)
                {
                    console.log("an error",error);
                }
            });
        });
		$('#button').click(function()
        {   
        	var dealID = $('#s9').val();
        	$('#createPopup').bPopup().close();
        	console.log(dealID);
            $('#csvForm').ajaxForm
            ({
                data: {dealID:dealID},
                success: function(data) 
                { 
                    console.log(data);
                    if(Array.isArray(data))
                    {
                    	alert('successfully added');
                	}
                	else
                	{
                		alert('try again buddy');
                	}
                },
                error: function(error)
                {
                    console.log("an error",error);
                }
            });
        });
        $(".clickable").click(function()
        {
     		window.location=$(this).data("href");
     		return false;
		});
    });
    </script>
    <script type = "text/javascript">

    function dealAction(dealID, ID)
    {
    	console.log('dealAction called');
    	var actionID = document.getElementById(ID).value;
    	console.log(actionID);
    	console.log(ID);
    	switch(actionID)
    	{
    		case '1':
    			console.log('delete called');
                var confirmation = confirm("Really you want to delete this deal");
                if(confirmation == true)
                {
    			    $.ajax
            	    ({
                	   url: "<?php echo $baseURL; ?>index.php/deals/deleteDeal/",
                	   data: {dealID:dealID},
                	   type: 'GET',
                	   success: function(data) 
                	   {
                    	   alert('selected option successfully deleted');
                           window.location.reload();
                	   },
                	   error: function(error) 
                	   {
                    	   console.log("an error", error);
                	   }
            	    });
                }
                else
                {
                    console.log("user canceled deletion");
                }
    		break;
    		case '2':
            	console.log('popup called');
            	$('#s9').val(dealID);  
            	$('#createPopup').bPopup(
            	{
                	speed:650,
                	transition:'slideIn',
            	});
			break;
    		case '3':
    			console.log('remove called');
    			$.ajax
            	({
                	url: "<?php echo $baseURL; ?>index.php/deals/dealProducts/",
                	data: {dealID:dealID},
                	type: 'GET',
                	success: function(data) 
                	{
                    	console.log(data);
                    	$('#tableView').empty();
                    	for (var i = 1, limit = data.totalPages; i <= limit; i++)
                    	{
                        	$('#pagination').append('<a href ="#" onclick ="filter('+dealID+','+(i-1)+')">'+i+'</a> | '); 
                    	}
                		$('#tableView').append('<tr><th>S NO</th><th>PRODUCT NAME</th><th>PRODUCT IMAGE</th><th>STORE NAME</th><th>DELETE</th></tr>')
                		for (var i = 0, limit = data.totalResults; i < limit; i++)
                    	{
                    		$('#tableView').append('<tr id = '+data.result[i]['productID']+'><td align="center">'+(i+1)+'</td><td align="center">'+data.result[i]['productName']+'</td><td align="center"><img src="https://buynbragstores.s3.amazonaws.com/assets/images/stores/'+data.result[i]['storeID']+'/'+data.result[i]['productID']+'/img1_240x200.jpg" alt="Smiley facINR.e" height="80" width="80"></td><td align="center">'+data.result[i]['storeName']+'</td><td align="center"><input type = "button" value = "Delete" onclick = "deleteProduct('+data.result[i]['productID']+')"></td></tr>');
						}
                	},
                	error: function(error) 
                	{
                    	console.log("an error", error);
                	}
            	});
            break;
    	}
    }
    function deleteProduct(productID)
    {
    	console.log(productID);
    	rowID = document.getElementById(productID);
    	$.ajax
        ({
            url: "<?php echo $baseURL; ?>index.php/deals/deleteDealProduct/",
            data: {productID:productID},
            type: 'GET',
            success: function(data) 
            {
            	rowID.parentNode.removeChild(rowID);
            },
            error: function(error) 
            {
                console.log("an error", error);
            }
        });
    }
    function filter(dealID,pageNumber)
    {
        $.ajax(
        {
            url: "<?php echo $baseURL; ?>index.php/deals/dealProducts/",
            data: {dealID:dealID,pageNumber:pageNumber},
            type: 'GET',
            success: function(data) 
            {
                $('#tableView').empty();
                $('#tableView').append('<tr><th>S NO</th><th>PRODUCT NAME</th><th>PRODUCT IMAGE</th><th>STORE NAME</th><th>DELETE</th></tr>')
                for (var i = 0, limit = data.productCount; i < limit; i++)
                {
                    $('#tableView').append('<tr id = '+data.result[i]['productID']+'><td align="center">'+(i+1)+'</td><td align="center">'+data.result[i]['productName']+'</td><td align="center"><img src="https://buynbragstores.s3.amazonaws.com/assets/images/stores/'+data.result[i]['storeID']+'/'+data.result[i]['productID']+'/img1_240x200.jpg" alt="Smiley facINR.e" height="80" width="80"></td><td align="center">'+data.result[i]['storeName']+'</td><td align="center"><input type = "button" value = "Delete" onclick = "deleteProduct('+data.result[i]['productID']+')"></td></tr>');
				}
            },
            error: function(error)
            {
                console.log("an error",error);
            }
        });
    } 
    </script>
</head>
<body>
    <button onClick="window.close();return true;">Return to CRM BASE</button>
	<h2 align = "center" data-href = "<?php echo $baseURL; ?>index.php/deals" class = "clickable" style ="cursor:pointer;">DEALS</h2>
	<div>
	<a style = "color:black;float:left;" href= "<?php echo $baseURL; ?>index.php/crm" target = "_self">Home</a>
	<input type = "button" id = "createDeal" value  = "Create Deal" style = "margin-left: 1015px;cursor:pointer;"/>
	<div id = "pagination" style = "text-align:center"></div>
	</div>
    <div id ="mainTable">
        <table id = "tableView">
            <tr>
            	<th>S NO</th>
                <th>DEAL NAME</th>
                <th>STARTS ON</th> 
                <th>ENDS ON</th>
                <th>OPERATION</th>
            </tr>
            <tr>
            </tr>
        </table>
    </div>
    <div id = "createPopup" >
        <div id="intern" style="margin-top:40px;">
        <div class="button b-close" title="Close" id="closeMbtn">x</div>
        <form action= "<?php echo $baseURL."index.php/deals/addProducts"; ?>" method="post" enctype="multipart/form-data" id = "csvForm">
        	<p style = "margin-top:80px;">
        		<label for="uploadFile">UPLOAD FILE</label>
        		<input type="file" name="file">
      		</p>
            <input type="hidden" id="s9"/>
            <input type="submit" name="submit" id="button" value="Submit"/>
        </form>
        </div>
    </div>
    <div id = "createDealPopup" >
        <div id="intern" style="margin-top:40px;">
        <div class="button b-close" title="Close" id="closeMbtn">x</div>
        <form action= "<?php echo $baseURL."index.php/deals/getDeal"; ?>" method="post" enctype="multipart/form-data" id = "csvForm2">
        	<p>
        		<label for="dealName">DEAL NAME</label>
        		<input type="text" name="dealName" placeholder = "Deal Name">
      		</p>
      		<p>
        		<label for="startDate">START DATE</label>
        		<input type="date" name="start">
      		</p>
      		<p>
        		<label for="endDate">END DATE</label>
        		<input type="date" name="end">
      		</p>
      		<p>
        		<label for="uploadFile">UPLOAD FILE</label>
        		<input type="file" name="file">
      		</p>
            <input type="submit" name="submit" id="button2" value="Submit"/>
        </form>
        </div>
    </div>
</body>
</html>

