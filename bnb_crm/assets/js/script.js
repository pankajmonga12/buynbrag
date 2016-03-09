$(document).ready(function () {
    
    $(".back").hide();
    
    $(".tile").mouseenter(function () {
        $(this).children(".front").transit( {
            "rotateX":"90deg"
        },500,"easeInCirc",function () {
            var back;
            $(this).hide();
            back = $(this).siblings(".back");
            back.css({
                "rotateX" : "-90deg"
            });
            back.show();
            back.transit( {
                "rotateX":"0deg"
            },500,"easeOutCirc");
        });
        
    });
    
    $(".tile").mouseleave(function () {
        $(this).children(".back").transit( {
            "rotateX" : "90deg"
        },500,"easeInCirc",function () {
            var front;
            $(this).hide();
            front = $(this).siblings(".front");
            front.css({
                "rotateX" : "-90deg"
            });
            front.show();
            front.transit({
                "rotateX" : "0deg"
            },500,"easeOutCirc");
        });
    });
});