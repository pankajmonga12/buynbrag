angular.module('directives.brag', [])

.directive("btnBrag", ["user", "api", function(user, api) {
    return {
        restrict: "A",
        scope: {
            sid: "@",
            pid: "@",
            userName: "@",
            productName:"@",
            hasBragged: "@"
        },
        link: function(scope, element, attrs) {

            var txtBrag = "Brag on FB!",
                txtBragged = "Bragged!";

            attrs.$observe("hasBragged", function(val) {

                scope.bragText = ((val === "1") || (val === "true")) ? txtBragged : txtBrag;

            });

            scope.triggerBrag = function() {
                user.getfbID() ? brag() : $("#fbSignUpModal").modal("show");
            };

            // element.bind("click", function() {

            //     user.getfbID() ? scope.$apply(function() { brag(); }) : $("#fbSignUpModal").modal("show");

            // });

            function brag() {

                var params = {};

                params['message'] = scope.userName + " has acquired bragging rights for " + (scope.productName).substring(0,42) + "... !! After all, brag is the new love! :)";
                params['name'] = 'BuynBrag.com';
                params['description'] = 'You can also acquire bragging rights for this product by logging on to www.buynbrag.com';
                params['link'] = "http://www.buynbrag.com/";
                params['picture'] = 'http://buynbragstores.s3.amazonaws.com/assets/images/stores/' + scope.sid + '/' + scope.pid + '/img1_171x171.jpg';
                params['caption'] = 'is your destination for everything hard-to-find';

                FB.getLoginStatus(function(logResponse) {

                    if (logResponse.status === 'connected') {

                        var accessToken = logResponse.authResponse.accessToken;

                        FB.api('/me/feed', 'post', params, function (response) {

                            if (!response || response.error) {

                                console.log('Fb FFF Badly');

                            }
                            else {

                                api.get("brag_ajax/product_brag?store_id=" +scope.sid + "&product_id=" + scope.pid).then(function(data) {

                                    scope.bragText = txtBragged;
                                    scope.$parent.hasBragged = "1";

                                });

                            }

                        });

                    }

                });                
            }  

        }
    }    
}]);