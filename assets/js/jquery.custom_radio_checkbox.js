//##############################
// jQuery Custom Radio-buttons and Checkbox; basically it's styling/theming for Checkbox and Radiobutton elements in forms
// By Dharmavirsinh Jhala - dharmavir@gmail.com
// Date of Release: 13th March 10
// Version: 0.8
/*
 USAGE:
	$(document).ready(function(){
		$(":radio").behaveLikeCheckbox();
	}
*/

var elmHeight = "25";	// should be specified based on image size

// Extend JQuery Functionality For Custom Radio Button Functionality
jQuery.fn.extend({
dgStyle: function()
{
	// Initialize with initial load time control state
	$.each($(this), function(){
		var elm	=	$(this).children().get(0);
		elmType = $(elm).attr("type");
		$(this).data('type',elmType);
		$(this).data('checked',$(elm).attr("checked"));
		$(this).dgClear();
	});
	$(this).mousedown(function() { $(this).dgEffect(); });
	$(this).mouseup(function() { $(this).dgHandle(); });	
},
dgClear: function()
{
	if($(this).data("checked") == "checked")
	{
		$(this).css("background-position","center -"+(40)+"px");
		}
	else
	{
		$(this).css("backgroundPosition","center 0");
		}	
},
dgEffect: function()
{
	if($(this).data("checked") == true)
		$(this).css({backgroundPosition:"center -"+(40)+"px"});
	else
		$(this).css({backgroundPosition:"center -"+(40)+"px"});
},
dgHandle: function()
{
	var elm	=	$(this).children().get(0);
	if($(this).data("checked") == true)
		$(elm).dgUncheck(this);
	else
		$(elm).dgCheck(this);
	
	if($(this).data('type') == 'radio')
	{
		$.each($("input[name='"+$(elm).attr("name")+"']"),function()
		{
			if(elm!=this)
				$(this).dgUncheck(-1);
		});
	}
},
dgCheck: function(div)
{
	$(this).attr("checked",true);
	$(div).data('checked',true).css({backgroundPosition:"center -"+(40)+"px"});
},
dgUncheck: function(div)
{
	$(this).attr("checked",false);
	if(div != -1)
		$(div).data('checked',false).css({backgroundPosition:"center 0"});
	else
		$(this).parent().data("checked",false).css({backgroundPosition:"center 0"});
}
});




jQuery.fn.extend({
dgStyl: function()
{
	// Initialize with initial load time control state
	$.each($(this), function(){
		var elm	=	$(this).children().get(0);
		elmType = $(elm).attr("type");
		$(this).data('type',elmType);
		$(this).data('checked',$(elm).attr("checked"));
		$(this).dgClea();
	});
	$(this).mousedown(function() { $(this).dgEffec(); });
	$(this).mouseup(function() { $(this).dgHandl(); });	
},
dgClea: function()
{
	if($(this).data("checked") == "checked")
	{
		$(this).css("background-position","center -"+(33)+"px");
		}
	else
	{
		$(this).css("background-position","center 0");
		}	
},
dgEffec: function()
{
	if($(this).data("checked") == true)
		$(this).css({backgroundPosition:"center -"+(33)+"px"});
	else
		$(this).css({backgroundPosition:"center -"+(33)+"px"});
},
dgHandl: function()
{
	var elm	=	$(this).children().get(0);
	if($(this).data("checked") == true)
		$(elm).dgUnchec(this);
	else
		$(elm).dgChec(this);
	
	if($(this).data('type') == 'radio')
	{
		$.each($("input[name='"+$(elm).attr("name")+"']"),function()
		{
			if(elm!=this)
				$(this).dgUnchec(-1);
		});
	}
},
dgChec: function(div)
{
	$(this).attr("checked",true);
	$(div).data('checked',true).css({backgroundPosition:"center -"+(33)+"px"});
},
dgUnchec: function(div)
{
	$(this).attr("checked",false);
	if(div != -1)
		$(div).data('checked',false).css({backgroundPosition:"center 0"});
	else
		$(this).parent().data("checked",false).css({backgroundPosition:"center 0"});
}
});

// Extend JQuery Functionality For Custom Radio Button Functionality
jQuery.fn.extend({
dgStyle2: function()
{
	// Initialize with initial load time control state
	$.each($(this), function(){
		var elm	=	$(this).children().get(0);
		elmType = $(elm).attr("type");
		$(this).data('type',elmType);
		$(this).data('checked',$(elm).attr("checked"));
		$(this).dgClear2();
	});
	$(this).mousedown(function() { $(this).dgEffect2(); });
	$(this).mouseup(function() { $(this).dgHandle2(); });	
},
dgClear2: function()
{
	if($(this).data("checked") == true)
	{
		$(this).css("backgroundPosition","center -"+(48)+"px");
		}
	else
	{
		$(this).css("backgroundPosition","center 0");
		}	
},
dgEffect2: function()
{
	if($(this).data("checked") == true)
		$(this).css({backgroundPosition:"center -"+(38)+"px"});
	else
		$(this).css({backgroundPosition:"center -"+(38)+"px"});
},
dgHandle2: function()
{
	var elm	=	$(this).children().get(0);
	if($(this).data("checked") == true)
		$(elm).dgUncheck2(this);
	else
		$(elm).dgCheck2(this);
	
	if($(this).data('type') == 'radio')
	{
		$.each($("input[name='"+$(elm).attr("name")+"']"),function()
		{
			if(elm!=this)
				$(this).dgUncheck2(-1);
		});
	}
},
dgCheck2: function(div)
{
	$(this).attr("checked",true);
	$(div).data('checked',true).css({backgroundPosition:"center -"+(38)+"px"});
},
dgUncheck2: function(div)
{
	$(this).attr("checked",false);
	if(div != -1)
		$(div).data('checked',false).css({backgroundPosition:"center 0"});
	else
		$(this).parent().data("checked",false).css({backgroundPosition:"center 0"});
}
});
