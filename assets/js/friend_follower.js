$(function () {
    // $("#tabfriend").tabs();
    $(".friendsHeader").click(function () {
        var a = $(this).children(":first").attr("class");
        $("#ffPopup").dialog({
            width: 947,
            height: 733,
            modal: true
        });
        if (a == "friendsIcon") {
            $("#tabfriend").tabs("select", 0)
        }
        if (a == "followersIcon") {
            $("#tabfriend").tabs("select", 1)
        }
        if (a == "followingIcon") {
            $("#tabfriend").tabs("select", 2)
        }
        $(".fftab1contents").jScrollPane({
            showArrows: false,
            animateScroll: true
        });
        $("#tabfriend ul li a").click(function () {
            $("#tabfriend ul li").removeClass("active");
            $(this).closest("li").addClass("active");
            var b = $(this).attr("href");
            $(b).find(".fftab1contents").jScrollPane();
            return false
        });
        $(".following").each(function () {
            $(this).click(function () {
                $(this).hide();
                $(this).siblings(".unfollow").show()
            })
        });
        $(".unfollow").each(function () {
            $(this).click(function () {
                $(this).hide();
                $(this).siblings(".following").show()
            })
        })
    });
    $("#friendsClose").click(function () {
        $("#ffPopup").dialog("close")
    })
});