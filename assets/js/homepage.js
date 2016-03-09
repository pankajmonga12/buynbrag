$(function () {
    // $("#tabsSlider").tabs({
    //     fx: {
    //         opacity: "toggle"
    //     }
    // }).tabs("rotate", 7000, true);
    $(".pro_name").each(function () {
        var a = 32;
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
    $(".storeDecoratingText").each(function () {
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
    $(".pradio").dgStyle();
    $(".store-list, .store-list1, .storeListNew").each(function () {
        $(this).hover(function () {
            $(this).children(".hoverHolder").show()
        }, function () {
            $(this).children(".hoverHolder").hide()
        })
    });
    $(".fancyProductBigBg").hover(function () {
        $(this).children(".hoverHolder1").show();
        $(this).children(".slideOpacity").show()
    }, function () {
        $(this).children(".hoverHolder1").hide();
        $(this).children(".slideOpacity").hide()
    });
    $(".fancyProductMedBg").hover(function () {
        $(this).children(".hoverHolder2").show();
        $(this).children(".slideOpacity2").show()
    }, function () {
        $(this).children(".hoverHolder2").hide();
        $(this).children(".slideOpacity2").hide()
    });
    $(".fancyProductSmallBg").hover(function () {
        $(this).children(".hoverHolder3").show();
        $(this).children(".slideOpacity").show()
    }, function () {
        $(this).children(".hoverHolder3").hide();
        $(this).children(".slideOpacity").hide()
    });
    $(".slideshowIcon").each(function () {
        $(this).click(function () {
            $(this).addClass("slideshowIconChange");
            $(this).siblings(".slideText").css("color", "#db3c64")
        })
    });
    $("#popUpClose1").click(function () {
        $("#FancyPopupContainer").dialog("close")
    });
    $("#popUpClose2").click(function () {
        $("#EditPopupContainer").dialog("close")
    });
    $(".checkit").dgStyl();
    $(".checkit").each(function () {
        $(this).click(function () {
            if ($(this).css("background-position") == "50% -33px") {
                $(this).parent().css({
                    "background-color": "#FFF"
                })
            } else {
                if ($(this).css("background-position") == "50% 0px") {
                    $(this).parent().css({
                        "background-color": "#f4f4f4"
                    })
                }
            }
        })
    })
});