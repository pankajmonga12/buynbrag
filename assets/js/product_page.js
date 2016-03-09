$(function () {
    $("#requestPopup").click(function () {
        $("#prodPopup").dialog({
            width: 605,
            height: 293,
            modal: true,
        })
    });
    $("#pickup_close").click(function () {
        $("#prodPopup").dialog("close")
    });
    $(".scrollPaneContainer").jScrollPane({
        showArrows: false,
        animateScroll: true
    });
    $(".commentHolder").jScrollPane({
        showArrows: true,
        animateScroll: true
    });
    $(".dropdown dt a").click(function () {
        $(".dropdown dd ul").toggle()
    });
    $(".dropdown dd ul li a").click(function () {
        var a = $(this).html();
        $(".dropdown dt a span").html(a);
        $(".dropdown dd ul").hide();
        $("#result").html("Selected value is: " + getSelectedValue("sample"))
    });
    $(document).bind("click", function (b) {
        var a = $(b.target);
        if (!a.parents().hasClass("dropdown")) {
            $(".dropdown dd ul").hide()
        }
    });
    //$("#sizes,#colors").sexyCombo()
});