// JavaScript Document

$(function(){
		   
	$(".pro_name").each(function(){		
			var len = 28;
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
	$(".stor_nm").each(function(){
											
			var len = 20;
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
	$(".price").each(function(){

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
	$(".peopleImage").tooltip({
			track:true,
			delay:"0",	
			extraClass:"pretty fancy",	
	});
	$(".peopleImage").hover(function(){
		$("#tooltip.fancy").css("background","url('images/follow_copy.png') no-repeat 28px -2px");	
		$("#tooltip.pretty h3").css({"padding-left":"50px","padding-top":"21px"});
	});
	$(".ImageBackground").tooltip({
			track:true,
			delay:"0",	
			extraClass:"pretty fancy",	
		});	
	
	$(".ImageBackground").hover(function(){
		$("#tooltip.fancy").css("background","url('images/click_tooltip.png') no-repeat center center");							   
	});
	
$(".ImageBackground").each(function(){
		$(this).click(function(){
			var imgs=$(this).children("img").attr("src");
			var idVal=$(this).children("input").attr("value");
			var part = imgs.split('.');
			var part1 = part[0].split('_');
			var add_count = parseInt(document.getElementById('hiddenFieldDiv1').value);	
			if(add_count<9)
			{
				i= add_count+1;
<<<<<<< HEAD
				$("#smallImageBox"+i).append($(document.createElement("img")).attr({src: part1[0]+"_84x70"+"."+part[1], id:"img_"+i})).show();
=======
				$("#smallImageBox"+i).append($(document.createElement("img")).attr({src: part1[0]+"_240x200"+"."+part[1], id:"img_"+i , width:"84" , height:"70" })).show();
>>>>>>> upstream/master
				$("#smallImageBox"+i).append($(document.createElement("input")).attr({type: "hidden", class:"inputHidden",id:"input_"+i,value:idVal}));
				$("#smallImageBox"+i).css("background-color","#fff");
				$("#smallImageBox"+i).hover(function(){
						$(this).children(".closeOpacity").show();
				},function(){
						$(this).children(".closeOpacity").hide();
				});
				document.getElementById('hiddenFieldDiv1').value = i;
				$("#actualNo").html(i);
				
				if(parseInt(document.getElementById('hiddenFieldDiv1').value)==9)
				{
				var j=0;
				var mytasteArr=new Array();
					$(".inputHidden").each(function(ind, ele){
					mytasteArr[j]=ele.value;
			          j++;
						
					});  
					$.post( "savemytaste", {obj: mytasteArr}, function (resp){
					
				window.location.href=document.getElementById('hidden_base_url').value+"index.php/user_info/take_taste2" ;
				
					}, "text");
				}
				
			}
		});
		
	});
	$(".deleteIcon").each(function(){
	
			$(this).click(function(){
							var count = parseInt(document.getElementById('hiddenFieldDiv1').value);
							var imgId=$(this).parent().siblings("img").attr("id");	   
							var st = imgId.split('_');
							j=parseInt(st[1]);
							$(this).parent().parent().css("background-color","#E7E8EA");
							$(this).parent().siblings("img").hide();
							for(var l=j; l<count;l++)
							{
								var srcs=$("#smallImageBox"+(l+1)+" img").attr("src");
								$("#smallImageBox"+l).children("img").attr("src",srcs).show();
								$("#smallImageBox"+(l+1)+" img").hide();
								$("#smallImageBox"+l).css("background-color","#fff");
								$("#smallImageBox"+(l+1)).css("background-color","#E7E8EA");
								
							}
							
							var del=count-1;
							document.getElementById('hiddenFieldDiv1').value = del;
							$("#actualNo").html(del);
							for(var c=1; c<=9;c++)
							{
							if( $('#img_'+c).is(':hidden') ){
							$("#smallImageBox"+c).hover(function(){
							$(this).children(".closeOpacity").hide();
							});	
							}
							else
							{
								$("#smallImageBox"+c).hover(function(){
								$(this).children(".closeOpacity").show();
								},function(){
								
									$(this).children(".closeOpacity").hide();
								
								});	
							}
								   }
			});			
	
	});
	
	
	
});
/*$("#deleteIcon"+i).click(function(){
						
						for(var l=1; l<i;l++)
						{
							if(l=i)
							{
								var srcs=$("#smallImageBox"+(i+1)+" img").attr("src");
								$("#smallImageBox"+i).children("img").attr("src",srcs).show();
								$("#smallImageBox"+(i+1)+" img").hide();
								$("#smallImageBox"+(i+1)).css("background-color","#E7E8EA");
								$(this).parent().hide();
							
							}
						}
					
			});	*/