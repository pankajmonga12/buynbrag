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
    $("#problemPopupContainer").dialog({autoOpen: false, width: 583, height: 292, modal: true});
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
    });
    $(".stableglassHeading").each(function () {
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
    tooltip2()
});
function transp(b) {
    for (var a = 1; a <= 5; a++) {
        if (b == a) {
            $(".row_transp" + b).css({background: "#f8f8f7", "-moz-opacity": "0.7", opacity: "0.7", "-khtml-opacity": "0.7", filter: "alpha(opacity=70)", "-ms-filter": '"progid:DXImageTransform.Microsoft.Alpha(Opacity=70)"'});
            $(".feed" + b).css("display", "block")
        }
    }
}
function normal(b) {
    for (var a = 1; a <= 5; a++) {
        if (b == a) {
            $(".row_transp" + b).css({background: "#f0f3f3", "-moz-opacity": "0.5", opacity: "0.5", "-khtml-opacity": "0.5", filter: "alpha(opacity=50)", "-ms-filter": '"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"'});
            $(".feed" + b).css("display", "none")
        }
    }
}
function populateStatus(a) {

    console.log('function called from file "js/dashboard.js"');

    var c = $("#baseurl").val();
    var b = $("#store_id").val();
    $.ajax({
        beforeSend: function() { $('#loading').show(); }, //Show spinner
        url: c + "index.php/dashboard/orderStatusAjax?status=" + a + "&base_url=" + c + "&store_id=" + b,
        success: function (d) {
            $("#parent_" + a).html(d);
            $("#total_" + a).html($("#noOfdata_" + a).val());
            $("#showing_" + a).html($("#noOfdata_" + a).val())
        },
        complete: function() { $('#loading').hide(); } //Hide spinner
    });
    return false
}
function startProcessing(b) {

    console.log('function called from file "js/dashboard.js"');

    var a = $("#baseurl").val();
    $.ajax({url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=2", success: function (c) {
        $("#tabs").tabs("select", 2);
        populateStatus(2)
    }});
    return false
}
function orderCompleted(b) {

    console.log('function called from file "js/dashboard.js"');

    var a = $("#baseurl").val();
    $.ajax({url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=4",
        success: function (c) {
            $("#tabs").tabs("select", 4);
            populateStatus(4)
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
        $.ajax({
            url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=3&date=" + d + "&time=" + (f + g) + "",
            success: function (h) {
                $("#tabs").tabs("select", 3);
                populateStatus(3)
            }})
    });
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
            url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=2&date=" + d + "&time=" + (f + g) + "",
            success: function (h) {
                $("#tabs").tabs("select", 2);
                populateStatus(2);
//                $('.shippingDate', $('#3252')).html('hi')
            }})
    });
    return false
}

getShippingPartners();

function getShippingPartners() {
    jQuery.ajax({
      url: $("#baseurl").val() + 'index.php/dashboard/getShippingPartners',
      type: 'GET',
      complete: function(xhr, textStatus) {
        //called when complete
      },
      success: function(data, textStatus, xhr) {
        console.log(data, data.result)
        //called when successful
        var courierDropdown = $(".startShipping_form").find("#courierService"),
            shippingPartners = data.result;

        for(var i=0; i<shippingPartners.length; i++) {
            courierDropdown.append('<option value=' + shippingPartners[i].name + '>' + shippingPartners[i].name + '</option>');
        }        

      },
      error: function(xhr, textStatus, errorThrown) {
        //called when there is an error
      }
    });
    
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
                    if(data.result == 1) {
                        $("#shippingPopup").dialog("close");
                        $("#tabs").tabs('select', 3);
                        populateStatus(3);    
                    }
                    
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

function change_to_problem_inorder(b) {

    console.log('function "change_to_problem_inorder" called from file "js/dashboard.js"');

    var a = $("#baseurl").val();
    $("#problemPopupContainer").dialog("open");
    $("#send_note_to_bnb").unbind("click");
    $("#send_note_to_bnb").click(function () {
        $("#problemPopupContainer").dialog("close");
        var c = $("#prob_textarea").val();
        $.ajax({
            url: a + "index.php/dashboard/changeOrderStatus?o_id=" + b + "&statusNow=6",
            success: function (d) {
            $("#tabs").tabs("select", 6);
            populateStatus(6)
            }
        })
    });
    return false
}
function sortStatus(b, a) {

    console.log('function called from file "js/dashboard.js"');

    var d = $("#baseurl").val();
    var c = $("#store_id").val();
    $.ajax({url: d + "index.php/dashboard/sortOrderStatus?sortparam=" + b + "&status=" + a + "&base_url=" + d + "&store_id=" + c, success: function (e) {
        $("#parent_" + a).html(e)
    }});
    return false
}

function giveComments(b) {
    var a = $("#comment_input").val();
    $.ajax({url: "giveComment?o_id=" + b + "&comment=" + a + "", success: function (c) {
        $("#parent_comment").html(c)
    }});
    return false
}