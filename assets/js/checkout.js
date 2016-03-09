$(function () {
    $(".radio1").dgStyle();
    $(".checkbox").dgStyl();
});

function formValidate() {
    var a = /^[A-Za-z\s]+$/;

    if (!($("#fname").val().match(a)) || $("#fname").val().charAt(0) == " ") {
        $("#fname").addClass("red_border");
        return false
    } else {
        $("#fname").removeClass("red_border")
    }
    if (!($("#lname").val().match(a)) || $("#lname").val().charAt(0) == " ") {
        $("#lname").addClass("red_border");
        return false
    } else {
        $("#lname").removeClass("red_border")
    }
    if( $("#street_address").val() == "" ) {
        $("#street_address").addClass("red_border");
        return false;
    }
    else {
        $("#street_address").removeClass("red_border");
    }
    if (!($("#cityName").val().match(a)) || $("#cityName").val().charAt(0) == " ") {
        $("#cityName").addClass("red_border");
        return false
    } else {
        $("#cityName").removeClass("red_border")
    }
    if (isNaN($("#PinCode").val()) || $("#PinCode").val().charAt(0) == " " || $("#PinCode").val() == "" || $("#PinCode").val().length != 6) {
        $("#PinCode").addClass("red_border");
        return false
    } else {
        $("#PinCode").removeClass("red_border")
    }
    if (isNaN($("#country_code").val()) || $("#country_code").val().charAt(0) == " " || $("#country_code").val() == "") {
        $("#country_code").addClass("red_border");
        return false
    } else {
        $("#country_code").removeClass("red_border")
    }
    if (isNaN($("#mobile_no").val()) || $("#mobile_no").val().charAt(0) == " " || $("#mobile_no").val() == "" || $("#mobile_no").val().length != 10) {
        $("#mobile_no").addClass("red_border");
        return false
    } else {
        $("#mobile_no").removeClass("red_border")
    }
    if ($("#person_email").val() == "" || $("#person_email").val().charAt(0) == " ") {
        $("#person_email").addClass("red_border");
        return false
    } else {
        $("#person_email").removeClass("red_border")
    }

    //Notify Customer for extra charges for delivery in Maharashtra
    if($("#state").val() === 'Maharashtra') {
        var msg = "Additional 5% to 12% will be chargeable at the time of delivery for areas wherever Octroi is applicable. This is to be borne by customer.";
        var notify = confirm(msg);
        if (!(notify)) {
            return false;
        }
    }

    //Message for West Bengal Customers
    if($('#state').val().trim().replace(/\s+/g, '').toLowerCase() == 'westbengal') {
        alert("Sorry, we currently do not deliver products to West Bengal.");
        return false;
    }
    
    // if (!($("#fname1").val().match(a)) || $("#fname1").val().charAt(0) == " ") {
    //     $("#fname1").addClass("red_border");
    //     return false
    // } else {
    //     $("#fname1").removeClass("red_border")
    // }
    // if (!($("#lname1").val().match(a)) || $("#lname1").val().charAt(0) == " ") {
    //     $("#lname1").addClass("red_border");
    //     return false
    // } else {
    //     $("#lname1").removeClass("red_border")
    // }
    // if (!($("#cityName1").val().match(a)) || $("#cityName1").val().charAt(0) == " ") {
    //     $("#cityName1").addClass("red_border");
    //     return false
    // } else {
    //     $("#cityName1").removeClass("red_border")
    // }
    // if (isNaN($("#PinCode1").val()) || $("#PinCode1").val().charAt(0) == " " || $("#PinCode1").val() == "" || $("#PinCode1").val().length != 6) {
    //     $("#PinCode1").addClass("red_border");
    //     return false
    // } else {
    //     $("#PinCode1").removeClass("red_border")
    // }
    // if (isNaN($("#country_code1").val()) || $("#country_code1").val().charAt(0) == " " || $("#country_code1").val() == "") {
    //     $("#country_code1").addClass("red_border");
    //     return false
    // } else {
    //     $("#country_code1").removeClass("red_border")
    // }
    // if (isNaN($("#mobile_no1").val()) || $("#mobile_no1").val().charAt(0) == " " || $("#mobile_no1").val() == "" || $("#mobile_no1").val().length != 10) {
    //     $("#mobile_no1").addClass("red_border");
    //     return false
    // } else {
    //     $("#mobile_no1").removeClass("red_border")
    // }
    // if ($("#person_email1").val() == "" || $("#person_email1").val().charAt(0) == " ") {
    //     $("#person_email1").addClass("red_border");
    //     return false
    // } else {
    //     $("#person_email1").removeClass("red_border")
    // }
    
  
    var c = $("#baseurl").val();
    var b = $("#PinCode,#PinCode1").val();
    $.ajax({
        url: c + "index.php/shippingcalculator/shipping/" + b,
        success: function (d) {
            if (d == 0) {
                alert("We cant delivers to you   as Pin is not in our circle .Sorry");
                $("#PinCode,#PinCode1").addClass("red_border")
            } else {
                document.checkoutI.submit()
            }
        }
    });
    
    //Notify Customer for extra charges for delivery in Maharashtra
    if($("#state").val() == 'Maharashtra') {
        var msg = "Additional 5% to 12% will be chargeable at the time of delivery for areas wherever Octroi is applicable. This is to be borne by customer.";
        var notify = confirm(msg);
        if(!(notify)) return false;
    }
}


function getAddress() {
    if ($("#check2").is(":checked")) {
        $("#street_address1").val($("#street_address").val());
        $("#cityName1").val($("#cityName").val());
        $("#PinCode1").val($("#PinCode").val());
        $("#fname1").val($("#fname").val());
        $("#lname1").val($("#lname").val());
        $("#country_code1").val($("#country_code").val());
        $("#mobile_no1").val($("#mobile_no").val());
        $("#person_email1").val($("#person_email").val());
        var c = document.getElementById("country1");
        country = $("#country").val();
        for (var b = 0; b < c.options.length; b++) {
            if (c.options[b].value == country) {
                c.selectedIndex = b;
                break
            }
        }
        var a = $("#country1").attr("sb");
        $("#sbSelector_" + a).html(country);
        var e = document.getElementById("state1");
        state = $("#state").val();
        for (var b = 0; b < e.options.length; b++) {
            if (e.options[b].value == state) {
                e.selectedIndex = b;
                break
            }
        }
        var d = $("#state1").attr("sb");
        $("#sbSelector_" + d).html(state)
    } else {
        $("#street_address1").val("");
        $("#cityName1").val("");
        $("#PinCode1").val("");
        $("#fname1").val("");
        $("#lname1").val("");
        $("#country_code1").val("");
        $("#mobile_no1").val("");
        $("#person_email1").val("");
        var c = document.getElementById("country1");
        c.selectedIndex = 0;
        var a = $("#country1").attr("sb");
        $("#sbSelector_" + a).html("country");
        var e = document.getElementById("state1");
        e.selectedIndex = 0;
        var d = $("#state1").attr("sb");
        $("#sbSelector_" + d).html("state")
    }
}
function formValidate2() {
    var a = /^[A-Za-z\s]+$/;
    for (var b = 1; b <= 4; b++) {
        if (isNaN($("#creditCard" + b).val()) || $("#creditCard" + b).val().charAt(0) == " ") {
            $("#creditCard" + b).addClass("red_border");
            return false
        } else {
            $("#creditCard" + b).removeClass("red_border")
        }
    }
    for (var b = 1; b <= 2; b++) {
        if (isNaN($("#expiryDate" + b).val()) || $("#expiryDate" + b).val().charAt(0) == " ") {
            $("#expiryDate" + b).addClass("red_border");
            return false
        } else {
            $("#expiryDate" + b).removeClass("red_border")
        }
    }
    if (!($("#checkName").val().match(a)) || $("#checkName").val().charAt(0) == " ") {
        $("#checkName").addClass("red_border");
        return false
    } else {
        $("#checkName").removeClass("red_border")
    }
}
function back_to_checkout(a) {
    window.location.href = a + "index.php/cart/shopping_cart"
}
function getMyRegisteredAddress(g, e, b, d, a) {
    if (document.getElementById("check1").checked) {
        document.getElementById("street_address").value = g;
        document.getElementById("cityName").value = e;
        document.getElementById("PinCode").value = a;
        var j = document.getElementById("country");
        for (var f = 0; f < j.options.length; f++) {
            if (j.options[f].value == d) {
                j.selectedIndex = f;
                break
            }
        }
        var k = $("#country").attr("sb");
        document.getElementById("sbSelector_" + k).innerHTML = d;
        var c = document.getElementById("state");
        for (var f = 0; f < c.options.length; f++) {
            if (c.options[f].value == b) {
                c.selectedIndex = f;
                break
            }
        }
        var h = $("#state").attr("sb");
        document.getElementById("sbSelector_" + h).innerHTML = b
    } else {
        document.getElementById("street_address").value = "street address";
        document.getElementById("cityName").value = "City";
        document.getElementById("PinCode").value = "Pincode";
        var j = document.getElementById("country");
        j.selectedIndex = 0;
        var k = $("#country").attr("sb");
        document.getElementById("sbSelector_" + k).innerHTML = "country";
        var c = document.getElementById("state");
        c.selectedIndex = 0;
        var h = $("#state").attr("sb");
        document.getElementById("sbSelector_" + h).innerHTML = "state"
    }
};