$(function () {
    $("#fileUp2").mousemove(function (a) {
        var b = $(".urlfield").offset();
        $("#file7").css("top", "70px");
        $("#file7").css("left", a.pageX - b.left - 148 + "px")
        console.log("fileup mousemove")
    });
    $("#file7").change(function () {
        console.log("file7 on CHANGE")
        var a = $("#rand_num_id").val();
        ajaxFileUpload(a);
        $("#image7").dialog({width: 600, height: 450, modal: false });

    });
    $("#crop_image").click(function () {
        $(".ui-widget-overlay").css("display", "none")
    });
    $("#cancel_crop").click(function () {
        $("#image7").dialog("close");
        $(".ui-widget-overlay").css("display", "none")
    });
    $("#select_crop").click(function () {
        $("#image7").dialog("close");
        $(".ui-widget-overlay").css("display", "none")
    });
    $(".store_edit").click(function () {
        $(".store_name").show();
        $("#st_nm").hide()
    });
    $(".store_name").blur(function () {
        $(".store_name").hide();
        $("#st_nm").show();
        var a = $(".store_name").val();
        if (a == "") {
            $("#st_nm").html("Copple Store")
        } else {
            $("#st_nm").html(a)
        }
    });
    $("#add_url").click(function () {
        $("#add_url").hide();
        $(".hiddenText").show()
    });
    $("#url_name").blur(function () {
        $("#add_url").show();
        $("#url_name").hide();
        var a = $("#url_name").val();
        $(".url_enter").html(a)
    })
});
function ajaxFileUpload(a) {
    console.log("upload exec")
    var b = $("#baseurl").val();
    $.ajaxFileUpload({url: "../../image/upload_file", secureuri: false, fileElementId: "file7", dataType: "json", success: function (d, c) {
        if (typeof(d.error) != "undefined") {
            if (d.error != "") {
                alert(d.error)
            }
        } else {
            $("#fname7").val(d.msg.file_name);
            $("#imageCrop7").append($(document.createElement("img")).attr({src: b + "assets/uploads/products/" + d.msg.file_name, id: "jcrop"})).show();
            if (fixed) {
                $("#crop_preview7").css({width: 75, height: 75}).append($(document.createElement("img")).attr({src: b + "assets/uploads/products/" + d.msg.file_name, id: "preview"})).show()
            }
            jCrop("#jcrop");
            $("#upload7").hide()
        }
    }});
    return false
}
function jCrop(a) {
    $(a).Jcrop({onChange: updateCoords, onSelect: updateCoords, aspectRatio: 1, boxWidth: 500})
}
function updateCoords(f) {
    var b = 190;
    var a = 190;
    $("#x7").val(f.x);
    $("#y7").val(f.y);
    $("#w7").val(f.w);
    $("#h7").val(f.h);
    if (b) {
        var e = a / f.w;
        var d = a / f.h;
        $("#preview").css({width: 200, height: Math.round(d * $("#jcrop").height()) + "px" })
    }
}
function crop() {
    var a = $("#baseurl").val();
    $.ajax({type: "POST", url: a + "index.php/dashboard/ownerAjaxImage?action=crop", data: {x: $("#x7").val(), y: $("#y7").val(), w: $("#w7").val(), h: $("#h7").val(), fname: $("#fname7").val(), fixed: fixed, size: size}, success: function (b) {
        if (!fixed) {
            $("#crop_preview7").css({overflow: "auto"})
        }
        $("#crop_preview7").html($(document.createElement("img")).attr("src", a + "assets/uploads/products/crop.jpg")).show();
        $("#image7").hide()
    }})
}
function formValidation() {
    if (isNaN($("#mobile_code").val()) || $("#mobile_code").val().charAt(0) == " ") {
        $("#mobile_code").addClass("red_border");
        return false
    }
    if (isNaN($("#mobile_code1").val()) || $("#mobile_code1").val().charAt(0) == " ") {
        $("#mobile_code1").addClass("red_border");
        return false
    }
    if (isNaN($("#mobile_no").val()) || $("#mobile_no").val().charAt(0) == " ") {
        $("#mobile_no").addClass("red_border");
        return false
    }
    if (isNaN($("#mobile_no1").val()) || $("#mobile_no1").val().charAt(0) == " ") {
        $("#mobile_no1").addClass("red_border");
        return false
    }
    if (isNaN($("#pinCode1").val()) || $("#pinCode1").val().charAt(0) == " ") {
        $("#pinCode1").addClass("red_border");
        return false
    }
    if (isNaN($("#pinCode").val()) || $("#pinCode").val().charAt(0) == " ") {
        $("#pinCode").addClass("red_border");
        return false
    }
    var a = /^[A-Za-z\s]+$/;
    if ($("#person_name").val() == "" || $("#person_name").val().charAt(0) == " ") {
        $("#person_name").addClass("red_border");
        return false
    }
    if ($("#owner_name").val() == "" || $("#owner_name").val().charAt(0) == " ") {
        $("#owner_name").addClass("red_border");
        return false
    }
    if ($("#city_name1").val() == "" || $("#city_name1").val().charAt(0) == " ") {
        $("#city_name1").addClass("red_border");
        return false
    }
    if ($("#city_name").val() == "" || $("#city_name").val().charAt(0) == " ") {
        $("#city_name").addClass("red_border");
        return false
    }
};