function seller_info(order_id)
{
	var baseUrl = $('#base_url').val();
	$("#ajax_dialog").html($('#loader').html());
	$("#ajax_dialog").dialog({
               width:550,
               height:550,
               modal:true
        }); 
$.ajax({
        url:baseUrl + "index.php/order_info/seller_info/"+order_id,
        success:function(data){
			$("#ajax_dialog").html(data);
			$("#ajax_dialog").removeAttr('title');
			$("#ajax_dialog").attr('title','BuynBrag CRM');
                       
		}
    });	
}

function product_info(order_id)
{
var baseUrl = $('#base_url').val();
$("#ajax_dialog").html($('#loader').html());
$("#ajax_dialog").dialog({
               width:650,
               height:400,
               modal:true
        });            
$.ajax({
        url:baseUrl + "index.php/order_info/product_info/"+order_id,
        success:function(data){
			$("#ajax_dialog").html(data);
			$("#ajax_dialog").removeAttr('title');
			$("#ajax_dialog").attr('title','BuynBrag CRM');
            
		}
    });	
}

function product_img(imgsrc, prodName){var baseUrl = $('#base_url').val();$("#ajax_dialog").html($('#loader').html());$("#ajax_dialog").dialog({width:650,height:400,modal:true});
var data ="<img src=\""+imgsrc+"\" />";
$("#ajax_dialog").html(data);
$("#ajax_dialog").removeAttr('title');
$("#ajax_dialog").attr('title',prodName);}

function payment_info(order_id)
{
var baseUrl = $('#base_url').val();
$("#ajax_dialog").html($('#loader').html());
$("#ajax_dialog").dialog({
               width:650,
               height:400,
               modal:true
        });            
$.ajax({
        url:baseUrl + "index.php/order_info/payment_info/"+order_id,
        success:function(data){
			$("#ajax_dialog").html(data);
			$("#ajax_dialog").removeAttr('title');
			$("#ajax_dialog").attr('title','BuynBrag CRM');
            
		}
    });	
}