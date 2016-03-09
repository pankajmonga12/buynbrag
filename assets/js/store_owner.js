$(function () {
    var e = 0;
    $("#scrollLeftButton4").click(function () {
        if (e <= 0) {
            return
        }
        e = e - 508;
        $("#sliderParentDiv_4").animate({scrollLeft: e}, 1040)
    });
    $("#scrollRightButton4").click(function () {
        maxScroll = parseInt($(".slider2").css("width")) - parseInt($("#sliderParentDiv_4").width());
        if (e > maxScroll) {
            return
        }
        e = e + 508;
        $("#sliderParentDiv_4").animate({scrollLeft: e}, 1040)
    });
    var c = 0;
    $("#scrollLeftButton5").click(function () {
        if (c <= 0) {
            return
        }
        c = c - 240;
        $("#sliderParentDiv_5").animate({scrollLeft: c}, 1000)
    });
    $("#scrollRightButton5").click(function () {
        maxScroll = parseInt($(".slider3").css("width")) - parseInt($("#sliderParentDiv_5").width());
        if (c > maxScroll) {
            return
        }
        c = c + 240;
        $("#sliderParentDiv_5").animate({scrollLeft: c}, 1000)
    });
    var b = 0;
    $("#scrollLeftButton7").click(function () {
        if (b <= 0) {
            return
        }
        b = b - 254;
        $("#sliderParentDiv_7").animate({scrollLeft: b}, 1000)
    });
    $("#scrollRightButton7").click(function () {
        maxScroll = parseInt($(".slider5").css("width")) - parseInt($("#sliderParentDiv_7").width());
        if (b > maxScroll) {
            return
        }
        b = b + 254;
        $("#sliderParentDiv_7").animate({scrollLeft: b}, 1000)
    });
    var a = 0;
    $("#scrollLeftButton_1").click(function () {
        if (a <= 0) {
            return
        }
        a = a - 302;
        $("#sliderParentDiv1").animate({scrollLeft: a}, 930)
    });
    $("#scrollRightButton_1").click(function () {
        maxScroll = parseInt($(".slider").css("width")) - parseInt($("#sliderParentDiv1").width());
        if (a > maxScroll) {
            return
        }
        a = a + 302;
        $("#sliderParentDiv1").animate({scrollLeft: a}, 930)
    });
    var d = 0;
    $("#scrollLeftButton_2").click(function () {
        if (d <= 0) {
            return
        }
        d = d - 250;
        $("#sliderParentDiv2").animate({scrollLeft: d}, 700)
    });
    $("#scrollRightButton_2").click(function () {
        maxScroll = parseInt($(".sliderblog").css("width")) - parseInt($("#sliderParentDiv2").width());
        if (d > maxScroll) {
            return
        }
        d = d + 250;
        $("#sliderParentDiv2").animate({scrollLeft: d}, 700)
    });
    $(".checkbox").dgStyl();
    $(".radio1").dgStyle()
});
function formValidate() {
    var a = /^[A-Za-z\s]+$/;
    if ($("#person_nickname").val() == "" || $("#cityName").val() == "" || $("#stateName").val() == "" || $("#countryName").val() == "" || $("#PinCode").val() == "") {
        return true
    }
    if (!($("#person_nickname").val().match(a))) {
        $("#person_nickname").addClass("red_border");
        return false
    } else {
        $("#person_nickname").removeClass("red_border")
    }
    if (!($("#cityName").val().match(a))) {
        $("#cityName").addClass("red_border");
        return false
    } else {
        $("#cityName").removeClass("red_border")
    }
    if (!($("#stateName").val().match(a))) {
        $("#stateName").addClass("red_border");
        return false
    } else {
        $("#stateName").removeClass("red_border")
    }
    if (!($("#countryName").val().match(a))) {
        $("#countryName").addClass("red_border");
        return false
    } else {
        $("#countryName").removeClass("red_border")
    }
    if (isNaN($("#PinCode").val()) || $("#PinCode").val().length != 6) {
        $("#PinCode").addClass("red_border");
        return false
    } else {
        $("#PinCode").removeClass("red_border")
    }
    if (isNaN($("#country_code").val())) {
        $("#country_code").addClass("red_border");
        return false
    } else {
        $("#country_code").removeClass("red_border")
    }
    if (isNaN($("#mobile_no").val()) || $("#mobile_no").val().length != 10) {
        $("#mobile_no").addClass("red_border");
        return false
    } else {
        $("#mobile_no").removeClass("red_border")
    }
};