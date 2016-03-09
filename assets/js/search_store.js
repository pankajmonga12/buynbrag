// JavaScript Document

$(function()
{	$(".price").each(function(){
											
			var len = 3;
			var trunc=$(this).text();
		if($(this).text().length>len)
		{
				/* Truncate the content of the P, then go back to the end of the
				   previous word to ensure that we don't truncate in the middle of
				   a word */
				$(this).attr("title",trunc);
			
				$(this).addClass("showtooltip2");   
				   
				trunc = trunc.substring(0, len);
				trunc = trunc.replace(/\w+$/, '');
				
				trunc += '..';
				  
				$(this).html(trunc);		
		}
	});
	tooltip2();
	
	$(".checkboxPrice").dgStyle2();
	
	$('li').click(function(){
			var ids=$(this).attr('id');
			$.ajax({
				url:"sub_store_contents.php?type="+ids,
				success:function(data){
					$(".rightPanel").html(data);
				},
			});
			$(this).css('color','#da3c63').siblings().css("color","#666");
			
	});
});

function panelCategories(id)
{
	$('li').css('color','#666');
	for(var i=1;i<=5;i++)
	{
		if(i==id)
		{	
			if($("#sub_category"+i).css('display')!='block'){
				$("#sub_category"+i).show();
				$("#category"+i).css("color","#333");
			}else{
					$("#sub_category"+i).hide();
					$("#category"+i).css("color","#666");
				}
		}else
		{
			$("#sub_category"+i).hide();
			$("#category"+i).css("color","#666");
		}
	}
}

function subCategories(id)
{
	for(var i=1;i<=13;i++)
	{
		if(i==id)
		{
			if($("#subSubCategory_"+i).css('display')!='block'){
					$("#icon_"+i).css({"background-image":"url('images/categories_arrow_down.png')","width":"11px","height":"5px","margin-top":"6px"});
					$("#subCategory_"+i).css("color","#333");
					$("#subSubCategory_"+i).show();
				}else{
						$("#icon_"+i).css({"background-image":"url('images/categories_arrow_left.png')","width":"5px","height":"11px","margin-top":"4px"});
						$("#subCategory_"+i).css("color","#666");
						$("#subSubCategory_"+i).hide();
					}
			
		}else
		{
			$("#icon_"+i).css({"background-image":"url('images/categories_arrow_left.png')","width":"5px","height":"11px","margin-top":"4px"});
			$("#subCategory_"+i).css("color","#666");
			$("#subSubCategory_"+i).hide();
		}
	}
	$.ajax({
		url:"store_contents2.php?typeID="+id,
		success:function(data){
			$(".rightPanel").html(data);
		},
	});
}