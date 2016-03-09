$(function () {
    $("#tabs").tabs({select: function (b, c) {
        var a = c.index;
        populateStatus(a)
    }});
    $(".nexttab").click(function () {
        $("#tabs").tabs("select", 2)
    });
    $("#timeCombo").selectbox();
    $(".startProcess,.problem_order").tooltip({track: true, delay: "0", showBody: "-", extraClass: "pretty fancy" });
    $("#pickupPopup").dialog({autoOpen: false, width: 445, height: 308, modal: true});
    $("#shippingPopup").dialog({autoOpen: false, width: 445, height: 400, modal: true});
    $("#pickup_close").unbind("click");
    $("#pickup_close").click(function () {
        $("#pickupPopup").dialog("close")
    });
    $("#pickupPopup").dialog({autoOpen: false, width: 445, height: 308, modal: true });
    $("#problemPopupContainer").dialog({autoOpen: false, width: 583, height: 292, modal: true });
    $(".problem_popup").unbind("click");
    $(".problem_popup").click(function () {
        $("#problemPopupContainer").dialog("open");
        $("#orderdetails_hidden").hide();
        $(".orderstatus_all_hidden").show()
    });
    $(".problemPopupClose").unbind("click");
    $(".problemPopupClose").click(function () {
        $("#problemPopupContainer").dialog("close")
    });
    $("#prob_textarea").click(function () {
        if ($("#prob_textarea").val() == "Please state your problem") {
            $("#prob_textarea").attr("value", "")
        }
    });
    $("#prob_textarea").blur(function () {
        if ($("#prob_textarea").val() == "") {
            $("#prob_textarea").attr("value", "Please state your problem")
        }
    })
});
function startProcessing(b) {

    console.log('function called from file "js/dashboard.js"');

    var a = $("#baseurl").val();
    $.ajax({url: "changeOrderStatus?o_id=" + b + "&statusNow=2", success: function (c) {
        window.location.reload();
    }});
    return false
}
function process_to_shipping(b) {

    console.log('function called from file "js/dashboard.js"');

    var a = $("#baseurl").val();
    $("#pickupPopup").dialog("open");
    $("#pickupPopup").unbind("click");
    $("#pickup_close").click(function () {
        $("#pickupPopup").dialog("close")
    });
    $("#pickupPopupProceed").unbind("click");
    $("#pickupPopupProceed").click(function () {
        $("#pickupPopup").dialog("close");
        var e = $("#ip_date").val();
        var f = $("#ip_time").val();
        var g = $("#timeCombo").val();
        var c = e.split("/");
        var d = c[2] + "-" + c[1] + "-" + c[0];
        $.ajax({url: "changeOrderStatus?o_id=" + b + "&statusNow=3&date=" + d + "&time=" + (f + g) + "", success: function (h) {
            window.location.reload();
        }})
    });
    return false
}
function orderCompleted(b) {

    console.log('function called from file "js/dashboard.js"');

    var a = $("#baseurl").val();
    $.ajax({url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=4",
        success: function (c) {
            window.location.reload();
        }});
    return false
}
function changeShippingDate(b) {

    console.log('function called from file "js/dashboard.js"');

    var a = $("#baseurl").val();
    $("#pickupPopup").dialog("open");
    $("#pickupPopup").unbind("click");
    $("#pickup_close").click(function () {
        $("#pickupPopup").dialog("close")
    });
    $("#pickupPopupProceed").unbind("click");
    $("#pickupPopupProceed").click(function () {
        $("#pickupPopup").dialog("close");
        var e = $("#ip_date").val();
        var f = $("#ip_time").val();
        var g = $("#timeCombo").val();
        var c = e.split("/");
        var d = c[2] + "-" + c[1] + "-" + c[0];
        $.ajax({
            url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=3&date=" + d + "&time=" + (f + g) + "",
            success: function (h) {
                window.location.reload();
            }})
    });
    return false
}
function change_to_problem_inorder(b) {

    console.log('function "change_to_problem_inorder" called from file "js/order_details.js"');

    var a = $("#baseurl").val();
    $("#problemPopupContainer").dialog("open");
    $("#send_note_to_bnb").unbind("click");
    $("#send_note_to_bnb").click(function () {
        $("#problemPopupContainer").dialog("close");
        var c = $("#prob_textarea").val();
        $.ajax({url: "changeOrderStatus?o_id=" + b + "&statusNow=6", success: function (d) {
            window.location.reload();
        }})
    });
    return false
}
function giveComments(b) {
    var a = $("#comment_input").val();
    $.ajax({url: "giveComment?o_id=" + b + "&comment=" + a + "", success: function (c) {
        $("#parent_comment").html(c)
    }});
    return false
}

function changeShippingDateSS(b, dbDate)
{

    console.log('function called from file "js/dashboard.js"');
    if(dbDate)
    {
        $("#ip_date").val(dbDate)
    }

    var a = $("#baseurl").val();
    $("#pickupPopup").dialog("open");
    $("#pickupPopup").unbind("click");
    $("#pickup_close").click(function () {
        $("#pickupPopup").dialog("close")
    });
    $("#pickupPopupProceed").unbind("click");
    $("#pickupPopupProceed").click(function () {
        $("#pickupPopup").dialog("close");
        var e = $("#ip_date").val();
        var f = $("#ip_time").val();
        var g = $("#timeCombo").val();
        var c = e.split("/");
        var d = c[2] + "-" + c[1] + "-" + c[0];
        $.ajax({
            url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=2&date=" + d + "&time=" + (f + g) + "",
            success: function (h) {
                $("#tabs").tabs("select", 2);
                populateStatus(2);
//                $('.shippingDate', $('#3252')).html('hi')
            }})
    });
    return false
}

function startShipping(orderId) {

    $("#shippingPopup").dialog("open");
    $("#shippingPopup").unbind("click");
    $("#shipping_close").click(function() {
        $("#shippingPopup").dialog("close");
    });

    $("#shippingPopupProceed").click(function() {

        var shippingForm = $(".startShipping_form"),
            awb = shippingForm.find("#awbNo").val(),
            awbParent = shippingForm.find("#awbNo").parent(),

            dts = (function() {
                var dtsDate = shippingForm.find("#deliveryTime").val() ? shippingForm.find("#deliveryTime").val().split("/") : "";
                console.log(dtsDate, shippingForm.find("#deliveryTime").val())
                return dtsDate ? (dtsDate[2] + "-" + dtsDate[1] + "-" + dtsDate[0]) : "";
            })() ,
            dtsParent = shippingForm.find("#deliveryTime").parent(),

            courier = shippingForm.find("#courierService").val(),
            courierParent = shippingForm.find("#courierService").parent();

        console.log(dts)

        !awb && showError(awbParent);
        !dts && showError(dtsParent);
        !courier && showError(courierParent);

        if(awb && dts && courier) {
            jQuery.ajax({
                url: $("#baseurl").val() + 'index.php/dashboard/updateAwbNo/' + awb + "/" + orderId + "/" + dts + "/" + courier,
                type: 'GET',
                complete: function(xhr, textStatus) {
                    //called when complete
                },
                success: function(data, textStatus, xhr) {
                    //called when successful
                    console.log('AWB SUCCESSFUL');
                    $("#shippingPopup").dialog("close");
                    $("#tabs").tabs('select', 3);
                    populateStatus(3);
                },
                error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                }
            });
        }

        function showError(elem) {
            elem.addClass("red_border");
        }

        function clearError(elem) {
            elem.removeClass("red_border");
        }

    });
}