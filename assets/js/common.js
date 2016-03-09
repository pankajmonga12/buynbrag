function loadingPageFunction() {
    $("#tabs li,#tab li").css("display", "block")
}
$(function () {
    $(document).click(function (c) {
        var b = $(c.target);
        if (!b.parents().hasClass("sbHolder")) {
            var a = $(document).find("select").attr("class");
            $("." + a).each(function () {
                var d = $(this).attr("sb");
                if ($("#sbOptions_" + d).css("display") == "block") {
                    $("#sbToggle_" + d).attr("class", "");
                    $("#sbToggle_" + d).addClass("sbToggle");
                    $("#sbOptions_" + d).css("display", "none");
                    $("#sbSelector_" + d).click()
                }
            })
        }
    });
    window.onload = loadingPageFunction;
    //$("#basic-combo").sexyCombo();
    //$("#combo").sexyCombo();
    $(".loginImage,.login").hover(function () {
        $(".login").css("color", "#ccc")
    }, function () {
        $(".login").css("color", "#6b6b6b")
    });
    //$(".drop1").selectbox();
    /*$("#sellerLoginPopup").dialog({
     autoOpen: false,
     width: 608,
     height: 446,
     modal: true
     });*/
    $("#seller_signin").click(function () {
        $("#sellerLoginPopup").dialog("open")
    });
    $("#sellerLoginButton").click(function () {
        login_to_seller()
    });
    $("#close_login").click(function () {
        $("#sellerLoginPopup").dialog("close")
    })
});

function login_to_seller() {
    var b = $("#login_username").val();
    if (b == "") {
        $("#login_username").addClass("red_border");
        return false
    }
    var a = $("#login_pass").val();
    if (a == "") {
        $("#login_pass").addClass("red_border");
        return false
    }
}
function transp(b) {
    for (var a = 1; a <= 36; a++) {
        if (b == a) {
            $("#row_transp" + b).css({
                "-moz-opacity": "0.8",
                opacity: "0.8",
                "-khtml-opacity": "0.8",
                filter: "alpha(opacity=80)",
                "-ms-filter": '"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"'
            });
            $("#feed" + b).css("display", "block")
        }
    }
}
function normal(b) {
    for (var a = 1; a <= 36; a++) {
        if (b == a) {
            $("#row_transp" + b).css({
                "-moz-opacity": "0.4",
                opacity: "0.4",
                "-khtml-opacity": "0.4",
                filter: "alpha(opacity=50)",
                "-ms-filter": '"progid:DXImageTransform.Microsoft.Alpha(Opacity=40)"'
            });
            $("#feed" + b).css("display", "none")
        }
    }
}
function changselect(a) {
    window.location = a.value
};