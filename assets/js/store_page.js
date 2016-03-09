$(function () {
    // $("#tabs_store").tabs();
    // $("#tab").tabs();
    // $("#tabs_store_page_store_section").tabs();
    $("#category_0").hide();
    $("#hidden_0").show();
    $("#addMoreProducts").click(function () {
        last_products_funtion()
    });
    $(".pro_name").each(function () {
        var a = 42;
        var b = $(this).text();
        if ($(this).text().length > a) {
            $(this).attr("title", b);
            $(this).addClass("showtooltip2");
            b = b.substring(0, a);
            b = b.replace(/\w+$/, "");
            b += "..";
            $(this).html(b)
        }
    });
    $(".stor_nm").each(function () {
        var a = 20;
        var b = $(this).text();
        if ($(this).text().length > a) {
            $(this).attr("title", b);
            $(this).addClass("showtooltip2");
            b = b.substring(0, a);
            b = b.replace(/\w+$/, "");
            b += "..";
            $(this).html(b)
        }
    });
    $(".storeLeahText").each(function () {
        var a = 15;
        var b = $(this).text();
        if ($(this).text().length > a) {
            $(this).attr("title", b);
            $(this).addClass("showtooltip2");
            b = b.substring(0, a);
            b = b.replace(/\w+$/, "");
            b += "..";
            $(this).html(b)
        }
    })
});
function showAjaxContents(e, b, a)
{
    console.log('showAjaxContents(' + e + ', ' + b + ', ' + a + ') fired');
	var d = jQuery.trim($("#urls").text());
    console.log('d = '+d);
    for (var c = 0; c <= 10; c++)
    {
        if (c == e)
	   {
            $("#category_" + c).hide();
            $("#hidden_" + c).show()
        }
        else
	   {
            $("#category_" + c).show();
            $("#hidden_" + c).hide()
        }
    }
    console.log('url being queried: ' + d + 'index.php/ajax/store_page_category/' + b + '/' + a);
    $.ajax(
	{
		/*url: d + "index.php/ajax/store_page_category/" + b + "/" + a,*/
		url: "/index.php/ajax/store_page_category/" + b + "/" + a,
		success: function (f)
		{
			$(".rightPanel").html(f);
		}
		
	});
}

$('.store-list').hover(function(){
        $('.hoverHolder', $(this) ).show();
    },
    function(){
        $('.hoverHolder').hide();
    })