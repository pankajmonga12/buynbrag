window.bnbAppSocial = {};

(function(b) {

    //Initialise SDKs
    setTimeout(function() {

        $("body").prepend('<div id="fb-root"></div>');
        $("body").append('<div id="sharePost"></div>');

        window.fbAsyncInit = function() {

            FB.init({
                appId: "394741787279624",
                channelUrl: "//" + window.location.host + "/assets/channel.html", // Channel File
                status: true, // check login status
                cookie: true, // enable cookies to allow the server to access the session
                xfbml: true,  // parse XFBML
                frictionlessRequests: true //Invite FB friends without prompt on subsequent request
            });

            // $('#midSection').prepend('<div class="fb-facepile" data-app-id="394741787279624" data-href="http://facebook.com/FacebookDevelopers" data-width="300" data-max-rows="1"></div>')

            // FB.Event.subscribe('auth.authResponseChange', function(response) {
            //     console.log(response)
            // });

        };

    }, 500);

    (function(doc, script) {

        setTimeout(function() {

            var js, fjs = doc.getElementsByTagName(script)[0],

                getScript = function(url, id, sdk, callback) {
                    if(doc.getElementById(id)) return;

                    js = doc.createElement(script);
                    js.src = url; id && (js.id = id);
                    fjs.parentNode.insertBefore(js, fjs);

                    js.onload = js.onreadystatechange = function() {

                        if(!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete') {
                            b[sdk] = !0;
                            callback && callback();
                        }
                    };
                };

            b.facebookLoaded || getScript("//connect.facebook.net/en_US/all.js", 'facebook-jssdk', 'facebookLoaded');
            b.frogLoaded || getScript('//buynbragin.nsfleximail.com/buynbragin/etrack.php', 'frog-script', 'frogLoaded');
            //b.googleplusLoaded || getScript("https://apis.google.com/js/client:plusone.js", '', 'googleplusLoaded');
            //getScript('//platform.twitter.com/widgets.js', 'twitter-wjs');

        }, 500);

    }(document, "script"));

})(window.bnbAppSocial);