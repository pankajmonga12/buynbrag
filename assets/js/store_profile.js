$(function () {
    $(".down").selectbox();
//    $("#move_combo").sexyCombo();
    $("#ans").click(function () {
        if ($("#ans").val() == "type...") {
            $("#ans").attr("value", "")
        }
    });
    $("#ans").blur(function () {
        if ($("#ans").val() == "") {
            $("#ans").attr("value", "type...")
        }
    });
    $("#add_to_category").selectbox();
    $("#show_add_category").click(function () {
        $("#changeCategory").css("display", "none");
        $("#add_category").css("display", "block")
    });
    $(".chairImage,.chairCategoryText").click(function () {
        var c = $("#baseurl").val();
        var a = $(this).parent().find("input").val();
        var b = $("#store_id").val();
        $.ajax({url: c + "index.php/dashboard/show_store_popup?currentPopUpItem=" + a + "&store_id=" + b, async: false, success: function (d) {
            $("#chairPopup").html(d)
        }});
        $("#chairPopup").dialog({width: 552, height: 506, modal: true })
    });
    $("#chairIconClose").click(function () {
        $("#chairPopup").dialog("close")
    });
    $("#add_category_button").click(function () {
        $("#add_category_button").css("display", "none");
        $("#add_category_hidden").css("display", "block")
    });
    $("#cancel_button").click(function () {
        $("#add_category_hidden").css("display", "none");
        $("#add_category_button").css("display", "block")
    });
    $(".selectAll").click(function () {
        if ($(".selectAll").css("background-position") == "50% -33px") {
            $(".checkbox").css("background-position", "50% -33px");
            $(".rightPanelContentRowBackground").css({"background-color": "#fff", opacity: "1", filter: "alpha(opacity=100)", "-khtml-opacity": "1", "-moz-opacity": "1", "-ms-filter": "'progid:DXImageTransform.Microsoft.Alpha(Opacity=100)'"})
        } else {
            if ($(".selectAll").css("background-position") == "50% 0px") {
                $(".checkbox").css("background-position", "50% 0px");
                $(".rightPanelContentRowBackground").css({"background-color": "#F1EFF0", opacity: "0.5", filter: "alpha(opacity=50)", "-khtml-opacity": "0.5", "-moz-opacity": "0.5", "-ms-filter": "'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)'"})
            }
        }
    });
    $("#save_button").click(function () {
        if ($("#category_name").val().length != 0) {
            $("#category_name").removeClass("red_border");
            save_category()
        } else {
            $("#category_name").addClass("red_border")
        }
    });
    $(".checkbox").click(function () {
        var a = 0;
        $(".checkbox").each(function () {
            if ($(this).css("background-position") == "50% -33px") {
                a = 1;
                $(".move").show()
            }
        });
        if (a == 0) {
            $(".move").hide()
        }
    });
    $(".fashionWeekText").each(function () {
        var a = 25;
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
    $(".chairCategoryText").each(function () {
        var a = 75;
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
    $(".allText").each(function () {
        var a = 30;
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
    tooltip2()
});
function rightPanelCategories(c, f, e, a) {
    var d = $("#baseurl").val();
    $("#top_shadow" + c).removeClass();
    $("#top_shadow" + c).addClass("topBoxShadow");
    for (var b = 0; b <= f + 1; b++) {
        if (c == b) {
            $("#top_shadow" + c).show();
            $("#bottom_shadow" + c).show();
            $("#categoryBackground" + c).css({"z-index": "1", "border-right": "none"});
            $("#allText" + b).css({color: "#DA3C63"})
        } else {
            $("#top_shadow" + b).hide();
            $("#bottom_shadow" + b).hide();
            $("#categoryBackground" + b).css({"z-index": "0", "border-right": "1px solid #C8C8C8"});
            $("#allText" + b).css({color: "#666666"})
        }
    }
    $.ajax({url: d + "index.php/dashboard/select_store_category?store_id=" + e + "&section_cat_id=" + a, async: false, success: function (g) {
        $("#rightAjaxFatchedRecords").html(g)
    }})
}
function save_category() {
    var a = $("#category_name").val();
    var b = document.createElement("div");
    b.className = "new_child";
    var c = '<div class="categoryContentBackgroundHolder"><div class="categoryContentBackground"></div><div class="categoryContent"><div class="category_identity"></div><div class="allText">' + a + "</div></div></div>";
    b.innerHTML = c;
    document.getElementById("leftPanelContent").appendChild(b);
    $("#add_category_hidden").css("display", "none");
    $("#add_category_button").css("display", "block");
    $("#category_name").val("");
    var e = $("#store_id").val();
    var d = $("#baseurl").val();
    $.ajax({url: d + "index.php/dashboard/add_store_category?catname=" + a + "&store_id=" + e, async: false, success: function (f) {
        window.location.reload()
    }})
}
function changeColor(c, b) {
    for (var a = 1; a <= b; a++) {
        if (c == a) {
            if ($("#checkbox" + a).css("background-position") == "50% -33px" || $("#checkbox" + a).css("background-position") == "center -33px") {
                $("#changeBackground" + a).css({"background-color": "#fff", opacity: "1", filter: "alpha(opacity=100)", "-khtml-opacity": "1", "-moz-opacity": "1", "-ms-filter": "'progid:DXImageTransform.Microsoft.Alpha(Opacity=100)'"})
            } else {
                if ($("#checkbox" + a).css("background-position") == "50% 0px" || $("#checkbox" + a).css("background-position") == "center 0px") {
                    $("#changeBackground" + a).css({"background-color": "#F1EFF0", opacity: "0.5", filter: "alpha(opacity=50)", "-khtml-opacity": "0.5", "-moz-opacity": "0.5", "-ms-filter": "'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)'"})
                }
            }
        }
    }
}
function formValidate() {
    var a = /^[A-Za-z\s]+$/;
    if (!($("#city").val().match(a)) || $("#city").val().charAt(0) == " ") {
        $("#city").addClass("red_border");
        return false
    }
    if (isNaN($("#pinCode").val()) || $("#pinCode").val().charAt(0) == " ") {
        $("#pinCode").addClass("red_border");
        return false
    }
    if (!($("#accnt").val().match(a)) || $("#accnt").val().charAt(0) == " ") {
        $("#accnt").addClass("red_border");
        return false
    }
}
function truncateOption() {
//    var a = 6;
//    var b = $(".moveDrop div.sexy input").val();
//    $(".moveDrop div.sexy input").attr("title", b);
//    if (b.length > a) {
//        b = b.substring(0, a);
//        b += "...";
//        $(".moveDrop div.sexy input").val(b)
//    }
}
function moveCatRecords(e) {
    var h = $("#store_id").val();
    var g = $("#baseurl").val();
    var c = $("#totalRowId").val();
    var d = [];
    if (e != "") {
        for (var a = 1; a <= c; a++) {
            if ($("#track_checkbox_" + a).attr("checked") == "checked") {
                var b = $("#hiddenProductId_" + a).val();
                d.push(b)
            }
        }
        var f = "selectedcheckboxes";
        $.ajax({url: g + "index.php/dashboard/move_store_category?allVals=" + d + "&catId=" + e + "&method=" + f, async: false, success: function (i) {
            window.location.reload()
        }})
    }
};