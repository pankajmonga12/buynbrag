$(function () {
    $("#tab").tabs({select: function (b, c) {
        var a = c.index;
        populateProduct(a)
    }});
    $(".drop").selectbox();
    $("#tag_close").click(function () {
        $(".bottomRight").hide()
    });
    $("#prod_name").click(function () {
        $("#prod_name").removeClass("red_border")
    });
    $("#prod_textarea").click(function () {
        $("#prod_textarea").removeClass("red_border")
    });
    $("#item_code").click(function () {
        $("#item_code").removeClass("red_border")
    });
    $("#tag_name").click(function () {
        $("#tag_name").removeClass("red_border")
    });
    $("#weight_type").click(function () {
        $("#weight_type").removeClass("red_border")
    });
    $("#length_type").click(function () {
        $("#length_type").removeClass("red_border")
    });
    $("#width_type").click(function () {
        $("#width_type").removeClass("red_border")
    });
    $("#height_type").click(function () {
        $("#height_type").removeClass("red_border")
    });
    $("#seller").click(function () {
        $("#seller").removeClass("red_border")
    });
    $("#commision").click(function () {
        $("#commision").removeClass("red_border")
    });
    $("#tax_rate").click(function () {
        $("#tax_rate").removeClass("red_border")
    });
    $("#logistics").click(function () {
        $("#logistics").removeClass("red_border")
    });
    $("#sellingPrice").click(function () {
        $("#sellingPrice").removeClass("red_border")
    });
    $("#quantity").click(function () {
        $("#quantity").removeClass("red_border")
    });
    $("#order_processing").click(function () {
        $("#order_processing").removeClass("red_border")
    });
    $("#continue_to_second").click(function () {
        saveData()
    });
    $("#save_product").click(function () {
        saveData2()
    });
});
function showCategories(b, a) {
    var c = $("#baseurl").val();
    $.ajax({url: c + "index.php/dashboard/product_cat_exec?parentCatId=" + b + "&typeID=" + a, success: function (d) {
        $("#category_" + a).html(d)
    }})
}
function browsing(b, d) {
    for (var a = 1; a <= 5; a++) {
        if (a == d) {
            var c = $("#fileImageParent" + d).offset();
            $("#file" + d).css("top", b.pageY - c.top - 10 + "px");
            $("#file" + d).css("left", b.pageX - c.left - 100 + "px")
        }
    }
}
function quantityfunc(h) {
    var e = parseInt(document.getElementById("hiddenFieldDiv1").value);
    var a = e + 1;
    document.getElementById("hiddenFieldDiv1").value = a;
    var c = document.createElement("div");
    var b = $("#hiddenFieldDiv1").val();
    for (var d = 0; d <= b; d++) {
        if (d == h + 1) {
            $("#add_" + d).show()
        } else {
            $("#add_" + d).hide()
        }
    }
    c.id = "nameQtyWrapper_" + a;
    c.className = "nameQtyWrapper";
    var f = '<div class="nameQtyLeft" id="nameQtyLeft_' + a + '"><div class="namequantityTransparent">	 </div><div class="namequantityRow"><div class="stock_name hideIt" id="stock_name_' + a + '"></div><input type="text" placeholder="enter product name" class="productNameNew" id="productName_' + a + '"/><div class="quantity_text">Quantity</div><input type="text" id="qtyvalue1_' + a + '"/><div class="quantity_text">Size</div><input type="text" id="sizevalue1_' + a + '"/><div class="quantity_text">Colour</div><input type="text" id="colorvalue1_' + a + '"/><div class="divider"></div><div class="editor hideIt" id="editor_' + a + '" onClick="return nameqty(' + a + ')"></div><div class="save_icon" id="savenew_' + a + '" onClick="return SaveNewDiv(' + a + ')"></div><div class="close" onClick="return closeIt(' + a + ')"></div></div></div><button class="bulkUpload addButton" type="button" id="add_' + a + '"  onClick="return quantityfunc(' + a + ')">ADD</button><div class="nameQtyHidden" id="nameQtyHidden_' + a + '"><div class="namequantityTransparent"></div><div class="namequantityRow"><input type="text" placeholder="pavan Kudla" class="productName" id="productName1_' + a + '"/><div class="quantity_text">Quantity</div><input type="text" placeholder="10" id="qtyvalue2_' + a + '"/><div class="quantity_text">Size</div><input class="stock_rowClass" type="hidden" id="hidden_' + a + '"/><input type="text" placeholder="10" id="sizevalue2_' + a + '"/><div class="quantity_text">Colour</div><input type="text" placeholder="10" id="colorvalue2_' + a + '"/><div class="divider"></div><div class="save_icon" id="save_icon_' + a + '" onClick="return saving(' + a + ')"></div><div class="close" onClick="return closeItnew(' + a + ')"></div></div></div>';
    c.innerHTML = f;
    var g = document.getElementById("namequantityDiv");
    g.appendChild(c)
}
function quantityfuncEdit(c, l, f, m, g) {
    var a = parseInt(document.getElementById("hiddenFieldDiv1").value);
    var b = a + 1;
    document.getElementById("hiddenFieldDiv1").value = b;
    var e = document.createElement("div");
    var j = $("#hiddenFieldDiv1").val();
    for (var h = 0; h <= j; h++) {
        if (h == c + 1) {
            $("#add_" + h).show()
        } else {
            $("#add_" + h).hide()
        }
    }
    e.id = "nameQtyWrapper_" + b;
    e.className = "nameQtyWrapper";
    var d = '<div class="nameQtyLeft" id="nameQtyLeft_' + b + '"><div class="namequantityTransparent">	 </div><div class="namequantityRow"><div class="stock_name hideIt" id="stock_name_' + b + '"></div><input type="text" placeholder="enter product name" class="productNameNew" id="productName_' + b + '" value="' + l + '"/><div class="quantity_text">Quantity</div><input type="text" id="qtyvalue1_' + b + '" value="' + f + '"/><div class="quantity_text">Size</div><input type="text" id="sizevalue1_' + b + '" value="' + m + '"/><div class="quantity_text">Colour</div><input type="text" id="colorvalue1_' + b + '" value="' + g + '"/><div class="divider"></div><div class="editor hideIt" id="editor_' + b + '" onClick="return nameqty(' + b + ')"></div><div class="save_icon" id="savenew_' + b + '" onClick="return SaveNewDiv(' + b + ')"></div><div class="close" onClick="return closeIt(' + b + ')"></div></div></div><button class="bulkUpload addButton" type="button" id="add_' + b + '"  onClick="return quantityfunc(' + b + ')">ADD</button><div class="nameQtyHidden" id="nameQtyHidden_' + b + '"><div class="namequantityTransparent"></div><div class="namequantityRow"><input type="text" placeholder="pavan Kudla" class="productName" id="productName1_' + b + '"/><div class="quantity_text">Quantity</div><input type="text" placeholder="10" id="qtyvalue2_' + b + '"/><div class="quantity_text">Size</div><input class="stock_rowClass" type="hidden" id="hidden_' + b + '"/><input type="text" placeholder="10" id="sizevalue2_' + b + '"/><div class="quantity_text">Colour</div><input type="text" placeholder="10" id="colorvalue2_' + b + '"/><div class="divider"></div><div class="save_icon" id="save_icon_' + b + '" onClick="return saving(' + b + ')"></div><div class="close" onClick="return closeItnew(' + b + ')"></div></div></div>';
    e.innerHTML = d;
    var k = document.getElementById("namequantityDiv");
    k.appendChild(e);
    SaveNewDiv(b)
}
function closeIt(c) {
    var a = $("#hiddenFieldDiv1").val();
    for (var b = 0; b <= a; b++) {
        if (b == c) {
            $("#nameQtyLeft_" + c).remove()
        }
    }
}
function closeItnew(c) {
    var a = $("#hiddenFieldDiv1").val();
    for (var b = 0; b <= a; b++) {
        if (b == c) {
            $("#nameQtyHidden_" + c).hide()
        }
    }
}
function nameqty(c) {
    var a = $("#hiddenFieldDiv1").val();
    for (var b = 0; b <= a; b++) {
        if (b == c) {
            $("#nameQtyHidden_" + c).show()
        }
    }
}
function SaveNewDiv(h) {
    var d = $("#hiddenFieldDiv1").val();
    for (var g = 0; g <= d; g++) {
        if (g == h) {
            var a = /^[A-Za-z\s]+$/;
            if (!($("#productName_" + g).val().match(a)) || $("#productName_" + g).val().charAt(0) == " ") {
                $("#productName_" + g).addClass("red_border");
                return false
            } else {
                $("#productName_" + h).removeClass("red_border")
            }
            if (isNaN($("#qtyvalue1_" + h).val()) || $("#qtyvalue1_" + h).val().charAt(0) == " " || $("#qtyvalue1_" + h).val() == "") {
                $("#qtyvalue1_" + h).addClass("red_border");
                return false
            } else {
                $("#qtyvalue1_" + h).removeClass("red_border")
            }
            if ($("#sizevalue1_" + h).val().charAt(0) == " " || $("#sizevalue1_" + h).val() == "") {
                $("#sizevalue1_" + h).addClass("red_border");
                return false
            } else {
                $("#sizevalue1_" + h).removeClass("red_border")
            }
            if ($("#colorvalue1_" + h).val().charAt(0) == " " || $("#colorvalue1_" + h).val() == "") {
                $("#colorvalue1_" + h).addClass("red_border");
                return false
            } else {
                $("#colorvalue1_" + h).removeClass("red_border")
            }
            $("#stock_name_" + g).css("display", "block");
            $("#productName_" + g).css("display", "none");
            $("#qtyvalue1_" + g).attr("disabled", "disabled");
            $("#sizevalue1_" + g).attr("disabled", "disabled");
            $("#colorvalue1_" + g).attr("disabled", "disabled");
            var f = $("#productName_" + g).val();
            $("#stock_name_" + g).html(f);
            $("#editor_" + g).css("display", "block");
            $("#savenew_" + g).css("display", "none");
            $("#sizevalue1_" + h, "#colorvalue1_" + h, "#qtyvalue1_" + h).removeClass("red_border");
            var c = $("#qtyvalue1_" + h).val();
            var e = $("#sizevalue1_" + h).val();
            var b = $("#colorvalue1_" + h).val();
            $("#hidden_" + h).val(f + "_" + c + "_" + e + "_" + b)
        }
    }
}
function saving(h) {
    var d = $("#hiddenFieldDiv1").val();
    for (var g = 0; g <= d; g++) {
        if (g == h) {
            var a = /^[A-Za-z\s]+$/;
            if (!($("#productName1_" + g).val().match(a)) || $("#productName1_" + g).val().charAt(0) == " ") {
                $("#productName1_" + g).addClass("red_border");
                return false
            } else {
                $("#productName1_" + h).removeClass("red_border")
            }
            if (isNaN($("#qtyvalue2_" + h).val()) || $("#qtyvalue2_" + h).val().charAt(0) == " " || $("#qtyvalue2_" + h).val() == "") {
                $("#qtyvalue2_" + h).addClass("red_border");
                return false
            } else {
                $("#qtyvalue2_" + h).removeClass("red_border")
            }
            if ($("#sizevalue2_" + h).val().charAt(0) == " " || $("#sizevalue2_" + h).val() == "") {
                $("#sizevalue2_" + h).addClass("red_border");
                return false
            } else {
                $("#sizevalue2_" + h).removeClass("red_border")
            }
            if ($("#colorvalue2_" + h).val().charAt(0) == " " || $("#colorvalue2_" + h).val() == "") {
                $("#colorvalue2_" + h).addClass("red_border");
                return false
            } else {
                $("#colorvalue2_" + h).removeClass("red_border")
            }
            $("#nameQtyHidden_" + g).css("display", "none");
            var f = $("#productName1_" + g).val();
            $("#stock_name_" + g).html(f);
            var c = $("#qtyvalue2_" + h).val();
            $("#qtyvalue1_" + h).val(c);
            var e = $("#sizevalue2_" + h).val();
            $("#sizevalue1_" + h).val(e);
            var b = $("#colorvalue2_" + h).val();
            $("#colorvalue1_" + h).val(b);
            $("#hidden_" + h).val(f + "_" + c + "_" + e + "_" + b)
        }
    }
}
function populateProduct(a) {
    var c = $("#baseurl").val();
    var b = $("#store_id").val();
    $.ajax({
        url: c + "index.php/dashboard/productsAjax?status=" + a + "&store_id=" + b + "",
        beforeSend: function() { $('#loading').show(); }, //Show spinner
        success: function (d) {
            $("#parent_product_" + a).html(d)
        },
        complete: function() { $('#loading').hide(); } //Hide spinner
    });
    return false
}
function confirm_Delete(a) {
    var b = confirm("Are you sure you want to delete this product?");
    if (b) {
        return deleteProduct(a)
    }
}
function deleteProduct(a) {
    var g = $("#baseurl").val();
    var f = $("#store_id").val();
    var c = $("#tab").tabs("option", "selected");
    var e = $($("#tab li")[c]).text();
    var b = 0;
    if (e == "All") {
        b = 0
    } else {
        if (e == "Onsale") {
            b = 1
        } else {
            b = 2
        }
    }
    var d = $("#search_" + (b + 1)).val();
    $.ajax({url: g + "index.php/dashboard/deleteproduct?status=" + b + "&store_id=" + f + "&product_id=" + a + "&pro=" + d + "", success: function (h) {
        $("#parent_product_" + b).html(h)
    }});
    return false
}
function searchProducts(a, elem) {
    var d = $("#baseurl").val();
    var c = $("#store_id").val();
    var b = $(elem).val();
    $.ajax({
        beforeSend: function() { $('#loading').show(); }, //Show spinner
        url: d + "index.php/dashboard/searchProduct?status=" + a + "&pro=" + b + "&store_id=" + c + "",
        success: function (e) {
            $("#parent_product_" + a).html(e)
        },
        complete: function() { $('#loading').hide(); } //Hide spinner
    });
    return false
}
function handleSearch(e, elem){

    if (e.keyCode === 13) {

        e.preventDefault();

        var populateID = parseInt($(elem).attr('id').split('_')[1]);

        searchProducts(populateID, elem);
    }
}
function saveData() {
    var j = $("#baseurl").val();
    var b = $("#my_store_id").val();
    var f = $("#category").val();
    if (f == 0) {
        $("#sbHolder_" + $("#category").attr("sb")).addClass("red_border");
        $("#category").change(function () {
        });
        return false
    }
    var p = $("#sub1_category").val();
    if (p == 0) {
        $("#sbHolder_" + $("#sub1_category").attr("sb")).addClass("red_border");
        $("#category").change(function () {
        });
        return false
    }
    if (p == "0") {
        p = ""
    }
    sub_sub_cat = $("#sub2_category").val();
    var a = $("#sub3_category").val();
    if (a == "0000") {
        a = ""
    }
    var h = $("#prod_name").val();
    if (h == "") {
        $("#prod_name").addClass("red_border");
        return false
    }
    var l = $("#prod_textarea").contents().find("body").html();
    if (l == "") {
        $("#prod_textarea").addClass("red_border");
        return false
    }
    var g = $("#item_code").val();
    if (g == "") {
        $("#item_code").addClass("red_border");
        return false
    }
    var d = $("#selected_shop").val();
    if (d == 0) {
        $("#sbHolder_" + $("#selected_shop").attr("sb")).addClass("red_border");
        $("#selected_shop").change(function () {
            $("#sbHolder_" + $("#selected_shop").attr("sb")).removeClass("red_border")
        });
        return false
    }
    var e = $("#event_name").val();
    var c = $("#style_name").val();
    var r = $("#tag_name").val();
    if (r == "") {
        $("#tag_name").addClass("red_border");
        return false
    }
    var q = $("#fname").val();
    var o = $("#fname2").val();
    var n = $("#fname3").val();
    var m = $("#fname4").val();
    var k = $("#fname5").val();
    var i = $("#isEdit").val();
    var s = new Object();
    s.catogory = f;
    s.sub_cagegory = p;
    s.sub_sub_cagegory = sub_sub_cat;
    s.sub_sub_sub_cagegory = a;
    s.image1 = q;
    s.image2 = o;
    s.image3 = n;
    s.image4 = m;
    s.image5 = k;
    s.product_name = h;
    s.item_code = g;
    s.selected_shop = d;
    s.description = l;
    s.occasion = e;
    s.style = c;
    s.tags = r;
    s.isEdit = i;
    s.product_style = $("#product_style").val();
    s.product_occasion = $("#occsn").val();
    $.post(j + "index.php/dashboard/savedata", {obj: s}, function (t) {
        window.location.href = j + "index.php/dashboard/add_product_second/" + b + "/" + i
    }, "text");
    return false
}
function saveData2(n) {
    var s = $("#baseurl").val();
    var e = $("#my_store_id").val();
    var p = $("#isEdit").val();
    var q = "0";
    var c = $("#discount_price").val();
    var u = $("#shipping_partner_id").val();
    if (c == "0") {
        q = "0"
    } else {
        q = "1"
    }
    var k = $("#weight_type").val();
    if (k == "") {
        $("#weight_type").addClass("red_border");
        return false
    }
    var f = $("#length_type").val();
    if (f == "") {
        $("#length_type").addClass("red_border");
        return false
    }

    /************* added by Bimal **************/ 
    var productWidth = $("#breadth_type").val(),
        productHeight = $("#height_type").val(),
        productVolumetricWeight = $("#volWeight_type").val();

    if(!productWidth) {
        $("#breadth_type").addClass("red_border");
        return false;
    }
    if(!productHeight) {
        $("#height_type").addClass("red_border");
        return false;
    }
    if(!productVolumetricWeight) {
        $("#volWeight_type").addClass("red_border");
        return false;
    }
    /**********************************************/ 

    var g = $("#mode").val();
    var m = $("#seller").val();
    if (m == "") {
        $("#seller").addClass("red_border");
        return false
    }
    var t = $("#commision").val();
    if (t == "") {
        $("#commision").addClass("red_border");
        return false
    }
    var a = $("#tax_rate").val();
    if (a == "") {
        $("#tax_rate").addClass("red_border");
        return false
    }
    var l = $("#insurance").val();
    if (l == "") {
        $("#insurance").addClass("red_border");
        return false
    }
    var o = $("#logistics").val();
    if (o == "") {
        $("#logistics").addClass("red_border");
        return false
    }
    var h = $("#sellingPrice").val();
    if (h == "") {
        $("#sellingPrice").addClass("red_border");
        return false
    }
    var j = $("#quantity").val();
    if (j == "") {
        $("#quantity").addClass("red_border");
        return false
    }
    var d = $("#order_processing").val();
    if (d == "") {
        $("#order_processing").addClass("red_border");
        return false
    }
    var r = 0;
    var b = "";
    $(".stock_rowClass").each(function (w, i) {
        if (i.value != 0 && i.value != null) {
            if (b != "") {
                b = b + "~" + i.value
            } else {
                b = i.value
            }
        }
    });
    var v = new Object();
    v.store_id = e;
    v.weight = k;
    v.length = f;
    v.breadth = productWidth;
    v.height = productHeight;
    v.volWeight = productVolumetricWeight;
    v.shipping_mode = g;
    v.seller_earnings = m;
    v.commision = t;
    v.tax_rate = a;
    v.insurance = l;
    v.logistics = o;
    v.selling_price = h;
    v.quantity = j;
    v.order_processing = d;
    v.stock = b;
    v.discount_price = c;
    v.is_on_discount = q;
    v.shipping_partner_id = u;

    if (p == 0) {
        $.post(s + "index.php/dashboard/saveproduct", {obj: v}, function (i) {
            window.location.href = s + "index.php/dashboard/allproductspage/" + e
        }, "text")
    } else {
        $.post(s + "index.php/dashboard/saveEditedproduct/" + n, {obj: v}, function (i) {
            window.location.href = s + "index.php/dashboard/allproductspage/" + e
        }, "text")
    }
    return false
};