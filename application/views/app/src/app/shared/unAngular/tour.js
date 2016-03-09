var homePageTour = {
    id: "homePageTour",
    steps: [
        {
            target: ".fancyItemBtn ",
            placement: "top",
            xOffset: 20,
            arrowOffset : "center",
            title: "Like something? Fancy it!",
            content: "Fancy something to curate your own fancy list. Share it with your friends, help people discover cool products.</br>What's more, you unlock cool badges when you fancy something."
        },
        {
            target: ".fanciedByInfoContainer",
            placement: "right",
            title: "Recently fancied user",
            content: "This is the person who most recently fancied this product. Fancy, curate and help other people discover unique products."
        },
        {
//            target: document.querySelector("footer"),
            target: ".fanciedPersonRank",
            placement: "right",
            title: "The curator's rank.",
            content: "Rank is a real time rating based on your curation. The more you curate, the better your rank.</br>Hit fancy or unlock badges to improve rank.</br></br><strong>Top rankers gets something special every week.</strong>"
        },
        {
            target: ".fanciedByTopBadge ",
            placement: "right",
            title: "The highest badge unlocked by the curator.",
            content: "Unlock badges to stay ahead in the game and earn real money in form of <em><strong>BragBucks</strong></em>.</br>Whether you fancy, discover or do any other thing, you'll unlock badges."
        }
    ],

    onStart: function() {
        var arr = $('.fancyItem');

        $(arr[0]).children().children('.fancyItemHiddenContainer').css('visibility', 'visible');
        $(arr[0]).children().children('.fancyItemHiddenContainer').css('opacity', 1);

        $(arr[0]).children().children().children('.hover_shine').css('display', 'none');

    },

    showPrevButton: true,
    bubbleWidth: 310,
    zindex: 9999,
    onEnd: function(){
        var arr = $('.fancyItem');

        $(arr[0]).children().children('.fancyItemHiddenContainer').css('visibility', '');
        $(arr[0]).children().children('.fancyItemHiddenContainer').css('opacity', '');
        $(arr[0]).children().children().children('.hover_shine').css('display', '');

//        $('.siteMsgContainer ').addClass('active');
//        $('#midSection').addClass('siteMsgActive');
    },
    onClose: function(){
        var arr = $('.fancyItem');

        $(arr[0]).children().children('.fancyItemHiddenContainer').css('visibility', '');
        $(arr[0]).children().children('.fancyItemHiddenContainer').css('opacity', '');
        $(arr[0]).children().children().children('.hover_shine').css('display', '');

//        $('.siteMsgContainer ').addClass('active');
//        $('#midSection').addClass('siteMsgActive');
    },
    onError : function(){
        var arr = $('.fancyItem');

        $(arr[0]).children().children('.fancyItemHiddenContainer').css('visibility', '');
        $(arr[0]).children().children('.fancyItemHiddenContainer').css('opacity', '');
        $(arr[0]).children().children().children('.hover_shine').css('display', '');

//        $('.siteMsgContainer ').addClass('active');
//        $('#midSection').addClass('siteMsgActive');
    }
};

var headerTour = {
    id: "headerTour",
    steps: [
        {
//            target: document.querySelector("footer"),
            target: "#bootStrapDropDownFix",
            placement: "bottom",
            title: "Invite friends",
            content: "Invite your friends and earn brag bucks."
        },
        {
            target: ".fanciedByInfoContainer",
            placement: "right",
            title: "Recently fancied user",
            content: "This is the person who recently fancied this product."
        },
        {
            target: "#banner",
            placement: "bottom",
            title: "Banner image",
            content: "This is our super cool banner."
        }
    ],

    showPrevButton: true
//    onEnd: function(){
//        alert("you earned 200 BB");
//    }
};

var headerProfileTour = {
    id: "headerProfileTour",
    steps: [
        {
//            target: document.querySelector("footer"),
            target: "#productFanciedCounter",
            placement: "bottom",
            title: "Invite friends",
            content: "Invite your friends and earn brag bucks."
        },
        {
            target: "#userRankCounter",
            placement: "bottom",
            title: "Recently fancied user",
            content: "This is the person who recently fancied this product."
        },
        {
            target: "#userCartCounter",
            placement: "bottom",
            title: "Banner image",
            content: "This is our super cool banner."
        }
    ],

    onStart: function() {
    },

    showPrevButton: true
//    onEnd: function(){
//        alert("you earned 200 BB");
//    }
};