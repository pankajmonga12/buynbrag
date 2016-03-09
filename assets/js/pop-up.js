$(document).ready(function () {
    $("#file1").change(function (a) {
        a.preventDefault();
        ajaxFileUpload()
    });
    $("#file2").change(function (a) {
        a.preventDefault();
        ajaxFileUpload2()
    });
    $("#file3").change(function () {
        ajaxFileUpload3()
    });
    $("#file4").change(function () {
        ajaxFileUpload4()
    });
    $("#file5").change(function () {
        ajaxFileUpload5()
    })
});
var fixed = 190;
var size = 190;
function ajaxFileUpload() {
    var a = $("#baseurl").val();
    $.ajaxFileUpload({url: a + "index.php/image/upload_file", secureuri: false, fileElementId: "file1", dataType: "json", data: {}, success: function (c, b) {
        if (c.status != "error") {
            $("#fname").val(c.msg.file_name);
            $("#crop_preview").css({width: 190, height: 150}).append($(document.createElement("img")).attr({src: a + "assets/uploads/products/" + c.msg.file_name, id: "preview"})).show();
            $("#upload").hide()
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
    $("#x").val(f.x);
    $("#y").val(f.y);
    $("#w").val(f.w);
    $("#h").val(f.h);
    if (b) {
        var e = a / f.w;
        var d = a / f.h;
        $("#preview").css({width: 200, height: Math.round(d * $("#jcrop").height()) + "px", })
    }
}
function ajaxFileUpload2() {
    var a = $("#baseurl").val();
    $.ajaxFileUpload({url: a + "index.php/image/upload_file", secureuri: false, fileElementId: "file2", dataType: "json", data: {}, success: function (c, b) {
        if (c.status != "error") {
            $("#fname2").val(c.msg.file_name);
            $("#crop_preview2").css({width: 190, height: 150}).append($(document.createElement("img")).attr({src: a + "assets/uploads/products/" + c.msg.file_name, id: "preview"})).show();
            $("#upload2").hide()
        }
    }});
    return false
}
function ajaxFileUpload3() {
    var a = $("#baseurl").val();
    $.ajaxFileUpload({url: a + "index.php/image/upload_file", secureuri: false, fileElementId: "file3", dataType: "json", data: {}, success: function (c, b) {
        if (c.status != "error") {
            $("#fname3").val(c.msg.file_name);
            $("#crop_preview3").css({width: 190, height: 150}).append($(document.createElement("img")).attr({src: a + "assets/uploads/products/" + c.msg.file_name, id: "preview"})).show();
            $("#upload3").hide()
        }
    }});
    return false
}
function ajaxFileUpload4() {
    var a = $("#baseurl").val();
    $.ajaxFileUpload({url: a + "index.php/image/upload_file", secureuri: false, fileElementId: "file4", dataType: "json", data: {}, success: function (c, b) {
        if (c.status != "error") {
            $("#fname4").val(c.msg.file_name);
            $("#crop_preview4").css({width: 190, height: 150}).append($(document.createElement("img")).attr({src: a + "assets/uploads/products/" + c.msg.file_name, id: "preview"})).show();
            $("#upload4").hide()
        }
    }});
    return false
}
function ajaxFileUpload5() {
    var a = $("#baseurl").val();
    $.ajaxFileUpload({url: a + "index.php/image/upload_file", secureuri: false, fileElementId: "file5", dataType: "json", data: {}, success: function (c, b) {
        if (c.status != "error") {
            $("#fname5").val(c.msg.file_name);
            $("#crop_preview5").css({width: 190, height: 150}).append($(document.createElement("img")).attr({src: a + "assets/uploads/products/" + c.msg.file_name, id: "preview"})).show();
            $("#upload5").hide()
        }
    }});
    return false
};