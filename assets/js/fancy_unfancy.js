$(function () {
    $(".pradio").dgStyle();
    $(".fancyIt").click(function () {
        if ($("#fancyText").html() == "FANCY IT") {
            // $("#FancyPopupContainer").dialog({
            //     width: 738,
            //     height: 510,
            //     modal: true,
            // });
            $(".checkboxesHolder2").jScrollPane({
                showArrows: false,
                animateScroll: true
            })
        } else {
            if ($("#fancyText").html() == "EDIT") {
                // $("#EditPopupContainer").dialog({
                //     width: 738,
                //     height: 510,
                //     modal: true,
                // });
                $(".checkboxesHolder2").jScrollPane({
                    showArrows: false,
                    animateScroll: true
                })
            }
        }
        $("#addtolist").click(function () {
            $("#fancyText").html("FANCIED");
            $("#FancyPopupContainer").dialog("close")
        });
        // $("#unfancy").click(function () {
        //     $("#fancyText").html("FANCY IT");
        //     $("#EditPopupContainer").dialog("close")
        // })
    });
    $(".fancyIt").hover(function () {
        if ($("#fancyText").html() == "FANCIED") {
            $("#fancyText").html("UNFANCY")
        }
    }, function () {
        if ($("#fancyText").html() == "EDIT") {
            $("#fancyText").html("FANCIED")
        }
    });
    // $("#popUpClose1").click(function () {
    //     $("#FancyPopupContainer").dialog("close")
    // });
    // $("#popUpClose2").click(function () {
    //     $("#EditPopupContainer").dialog("close")
    // });
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