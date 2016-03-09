(function() {

    // Show browser modal for older IE
    if ((document.documentElement.className.match(/olderIE/i)) == "olderIE") {

        document.body.innerHTML = '<div id="browserModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"><div class="oldBrowserMsg"><img src="/application/views/dist/images/sprites/internet_explorer_broken.png" alt="Internet Explorer 8 broken icon"><h4>You are using an older version of <em>Internet Explorer.</em></h4><p>At BuynBrag, we use the latest web technology on our website. But that also means that older browsers (IE 8 and below) are not able to give an optimal user experience.</p><p>Please upgrade to one of the browsers below to enjoy BuynBrag in it\'s full glory.</p></div><div class="newBrowsers"><a class="inlineBlock browserLink" target="_blank" href="http://windows.microsoft.com/en-in/internet-explorer/ie-10-worldwide-languages"><img src="/application/views/dist/images/sprites/Internet_Explorer_9.png" alt="Internet Explorer 10 icon"><div>Internet Explorer 10</div></a> <a class="inlineBlock browserLink" target="_blank" href="https://www.google.com/intl/en/chrome/browser/"><img src="/application/views/dist/images/sprites/Google_Chrome.png" alt="Google Chrome icon"><div>Google Chrome</div></a> <a class="inlineBlock browserLink" target="_blank" href="http://www.mozilla.org/en-US/firefox/new/"><img src="/application/views/dist/images/sprites/firefox.png" alt="Mozilla Firefox icon"><div>Mozilla Firefox</div></a> <a class="inlineBlock browserLink" target="_blank" href="http://support.apple.com/downloads/#safari"><img src="/application/views/dist/images/sprites/Apple_Safari.png" alt="Apple Safari icon"><div>Apple Safari</div></a> <a class="inlineBlock browserLink" target="_blank" href="http://www.opera.com/"><img src="/application/views/dist/images/sprites/Opera.png" alt="Opera icon"><div>Opera</div></a></div></div>';
        //        $('.modal').modal('hide');
        //        $('#browserModal').modal('show');
    }

    /*******************************************************************/
    /************************** By Bimal********************************/
    /*******************************************************************/
    // if ('ontouchstart' in document.documentElement) {
    //     document.addEventListener('touchstart', function() {
    //         $('body .hoverActive').removeClass('hoverActive');
    //     });
    // }

    /****************** Login Autofill hack ***************/

    var monitorId;
    $('#loginModal').on('show', function() {

        monitorId = window.setInterval(function() {

            $('#loginModal input').trigger('input');

        }, 250);
    });

    $('#loginModal').on('hide', function() {

        window.clearInterval(monitorId);

    });

    /********** Twitter Window Function Call *********/

    //    function twitterSuccess() {
    //
    //        window.tw_window.close();
    //
    //        angular.element("#inviteFriendsModal").scope().getTwitterFollowers();
    //
    //    }

    /*******************************************************************/
    /******************************** End ******************************/
    /*******************************************************************/

    // check for 3D transform support
    if (document.body.style['webkitPerspective'] !== undefined || document.body.style['MozPerspective'] !== undefined) {
        console.log("3D transforms");
        document.documentElement.className += " supports3DTransforms";
    }

    // Top site alerts
//    $('.siteMsgContainer .close').click(function() {
//        //        $(this).parent().removeClass('active');
//        //        $('#midSection').removeClass('siteMsgActive');
//        $('body').removeClass('siteMsgActive');
//    });

    //Footer close styling
    $('footer').click(function() {
        if ($('footer').css('bottom') != "0px") {
            $('footer').css('bottom', 0);
            //        $('footer').css('opacity', 0.9);
        } else {
            $('footer').css('bottom', "-38px");
            //        $('footer').css('opacity', 0.8);
        }
    });

    //Search box container display on click
    $(".searchBoxContainer").click(function(e) {
        $(this).addClass("searchActive");
        setTimeout(function() {
            $(".searchBoxContainer").children(".searchInput").focus();
        }, 300);

        e.stopPropagation();
    });

    $("html").click(function() {
        $(".searchActive").removeClass("searchActive");
    });

    $(".closeSearch").click(function(e) {
        $(this).parent().parent().removeClass("searchActive");
        e.stopPropagation();
    });

    //End Search box container display on click

    // //scroll to top
    // var backtotopVisible = false;
    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 200 && !backtotopVisible) {
    //         $('#backtotop').fadeIn();
    //         backtotopVisible = true;
    //     }
    //     if ($(this).scrollTop() < 200 && backtotopVisible) {
    //         $('#backtotop').fadeOut();
    //         backtotopVisible = false;
    //     }
    // });

    // $('#backtotop').on('click', function() {
    //     $('html, body').animate({
    //         scrollTop: $("body").offset().top
    //     }, 2000, 'swing', function(){
    //         console.log('Scroll to top complete');
    //     });
    // });

// end scroll to top

//    Rolling links code
// var supports3DTransforms =  document.body.style['webkitPerspective'] !== undefined || document.body.style['MozPerspective'] !== undefined;

// function rollLinks() {

//     if( supports3DTransforms ) {

//         var elem = document.getElementById('rollLink');

//         if( !elem.className || !elem.className.match( /roll/g ) ) {
//             elem.className += ' roll';
//             elem.innerHTML = '<span data-title="'+ elem.text +'">' + elem.innerHTML + '</span>';
//         }
//     }
// }

// rollLinks();

//End rolling links

var personCurativeScore = function() {

    $('.personCurativeScore').easyPieChart({
        animate: 1000,
        trackColor: '#000',
        barColor: '#C41F1F',
        scaleColor: false,
        lineWidth: 3,
        size: 170
    });

    //        $('.percentage').data('easyPieChart').update(23);

};

setTimeout(function() {
personCurativeScore();
}, 1000);


//Tap event performance enhancer
//    document.addEventListener("touchstart", function(){}, true);

//Simple basic slider
//    $('#banner img:gt(0)').hide();
//    setInterval(function(){
//        $('#banner :first-child').fadeOut(300, function(){
//            $(this).delay(500).next('img').fadeIn(300).css('display', 'block').end().appendTo('#banner');
//        })
//    }, 6000);

// Custom radio checkboxes script
//    $('.customRadio input').on('click', function(){
//        var inputName = $(this).attr('name');
//
//        $(this).parent('label').addClass('radioOn');
//
//        if(inputName == 'colorRadio'){
//            $('.productColorOptions input').each(function(){
//                if( ! ($(this).is(':checked')) ){
//                    $(this).parent('label').removeClass('radioOn');
//                }
//            });
//        }else if(inputName == 'sizeRadio'){
//            $('.productSizeOptions input').each(function(){
//                if( ! ($(this).is(':checked')) ){
//                    $(this).parent('label').removeClass('radioOn');
//                }
//            });
//        }
//    });
})();
// End private function

// Tour start
//function startHomePageTour(){
//
//    setCookie("tourTaken", "true");
//
//    if($('#midSection').width() < 940){
//        $('html, body').animate({
//            scrollTop: 250
//        }, 1200);
//    }else{
//        $('html, body').animate({
//            scrollTop: 300
//        }, 1200);
//    }
//
//    $('.siteMsgContainer ').removeClass('active');
//    $('#midSection').removeClass('siteMsgActive');
//
//    setTimeout(function(){
//        hopscotch.startTour(homePageTour);
//    }, 1500);
//}

// Tour skip set cookie
//$('.tourSkipped').on('click', function(){
//    setCookie("tourTaken", "true");
//});
//
//// Functions to check and set cookie
//function getCookie(paramStored){
//    var cookieValue = document.cookie;
//
//    var cookieStart = cookieValue.indexOf(" " + paramStored + "=");
//
//    if (cookieStart == -1){
//        cookieStart = cookieValue.indexOf(paramStored + "=");
//    }
//
//    if (cookieStart == -1){
//        cookieValue = null;
//    }else{
//        cookieStart = cookieValue.indexOf("=", cookieStart) + 1;
//        var c_end = cookieValue.indexOf(";", cookieStart);
//        if (c_end == -1){
//            c_end = cookieValue.length;
//        }
//        cookieValue = cookieValue.substring(cookieStart,c_end);
//    }
//
//    return cookieValue;
//}
//
//function setCookie(paramStored,value){
//    var cookieVal = paramStored + "=" + value + "; path=/";
//    console.log(cookieVal);
//    document.cookie=cookieVal;
//}

//function checkCookie(paramStored){
//    var cookieVal=getCookie(paramStored);
//
//    if (cookieVal!=null && cookieVal!=""){
////        alert("Welcome again " + cookieVal);
//        return true;
//    }else{
////        cookieVal=prompt("Please enter your name:","");
////        setCookie("tourTaken",cookieVal);
//        return false;
//    }
//}

function eraseCookie(name) {
    setCookie(name, "", -1);
}

function setCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
// End function to check and set cookie

//(function(){
//    //    Disable hover effect on scroll
//
//    var body = document.body, timer;
//
//    window.addEventListener('scroll', function() {
//        clearTimeout(timer);
//        if(!body.classList.contains('disable-hover')) {
//            body.classList.add('disable-hover')
//        }
//
//        timer = setTimeout(function(){
//            body.classList.remove('disable-hover')
//        },300);
//    }, false);
//
////    End Disable hover effect on scroll
//
//})();

// Sticky elements on scroll

//var stickyElem = function() {
//
//    var midSection = document.getElementById("midSection");
//    midSection.className = midSection.className.replace('cssTransitionSlow', '');
//    var stop = (navBreadcrumbs.offsetTop - 45);
//
//    window.onscroll = function(e) {
//        var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
////        console.log(scrollTop, navBreadcrumbs.offsetTop);
//
//        if (scrollTop >= stop) {
//            navBreadcrumbs.className = 'stick';
//            midSection.style.marginTop = '105px';
//        } else {
//            navBreadcrumbs.className = '';
//            midSection.style.marginTop = '';
//        }
//
//    }
//
//};

// End sticky elements on scroll