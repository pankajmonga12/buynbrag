angular.module("bnbApp", [
    'angular-loading-bar',
    'ngCookies',
    'ngRoute',
    'ngTouch',
    'ngAnimate',
    'ngSanitize',
    'router',
    'gallery',
    'home',
    'blocked',
    'trends',
    'allStores',
    'dealofday',
    'people',
    'profilePage',
    'productPage',
    'cartPage',
    'checkoutPage',
    'categoryPage',
    'storePage',
    'search',
    'userSession',
    'siteMessage',
    'userCoupons',
    'changePassword',
    'filters.beautify',
    'filters.compress',
    'services.api',
    'services.user',
    'services.seo',
    'directives.stabiliseHover',
    'directives.clearImage',
    'directives.checkLoad',
    'directives.scrollTo',
    'directives.follow',
    'directives.sexyOverlay',
    'directives.share',
    'dynamicModals',
    'realtime.badges',
    'prefetchTemplates',
    'angulartics', 'angulartics.google.analytics'
])

.run(['$rootScope', '$window',
    function($rootScope, $window) {

        //Configure environments
        (function() {

            var ENV = document.location.host.split('.')[0] === 'buynbrag'
                ? 'PRODUCTION'
                : 'DEVELOPMENT';

            if(ENV === 'PRODUCTION') {
                if(window.console && window.console.log && window.console.info) {
                    window.console.log = function() {};
                    window.console.info = function() {};
                }

                $rootScope.relativeServerPath = "/";
            }
            else {
                $rootScope.relativeServerPath = "/application/views/app/";
            }

        }());

        Array.prototype.findObject = function(key, id) {
            var obj = this.filter(function(item) {
                return item[key] == id;
            })[0];

            return obj;
        };

        Array.prototype.indexOfObject = function(key, id) {
            return this.indexOf(this.findObject(key, id));
        };

        Array.prototype.deleteObject = function(key, id) {
            this.splice(this.indexOfObject(key, id), 1);
        };

        Array.prototype.range = function(a, b, step) {
          step = !step ? 1 : step;
          b = b / step;
          for(var i = a; i <= b; i++) {
            this.push(i * step);
          }
          return this;
        };


        $rootScope.deviceType = 'ontouchstart' in document.documentElement ? 'touch' : 'nonTouch';

        $rootScope.openModal = function(id, obj) {
            if(id) {
                angular.element('#' + id).modal('show');

                if(obj && (obj.toString() === '[object Object]') && Object.keys(obj).length > 0) {
                    $rootScope.$broadcast(id, obj);
                }
            }
        };

        $rootScope.closeModal = function(id) {
            angular.element('#' + id).modal('hide');
        };

    }
])

.config(['$provide', 'cfpLoadingBarProvider', function($provide, cfpLoadingBarProvider) {

    //Turn the loading spinner off
    cfpLoadingBarProvider.includeSpinner = false;

    //Overriding ngSrc directive(to set empty src)
    // $provide.decorator('ngSrcDirective', function($delegate) {
    //     console.log($delegate, $delegate[0].compile.toString(), $delegate[0].link.toString());
    //     var directive = $delegate[0];

    //     // directive.compile = function(element, attrs) {

    //     //     attrs.$observe('ngSrc', function(val) {
    //     //         if(!val) return;
    //     //         // attrs.$set('src', '');
    //     //         attrs.$set('src', val);
    //     //     });
    //     // };

    //     directive.link = function(scope, element, attrs) {

    //         attrs.$observe('ngSrc', function(val) {
    //             // if(!val) return;
    //             element[0].src = '';
    //             window.setTimeout(function() { element[0].src = val; }, 50);
    //         })

    //     };

    //     return $delegate;
    // });

}])

.controller("AppController", ["$scope", "$window", "$rootScope", "$route", "$routeParams", "$location", "$window", "api", "requestContext", "categoryService", "trendsService", "seo", "$sce",
    function($scope, $window, $rootScope, $route, $routeParams, $location, $window, api, requestContext, categoryService, trendsService, seo, $sce) {

        /******************************* Update the rendering of the page.   ***************************************/


        function isRouteRedirect(route) {

            return (!route.current.action);

        }

        var renderContext = requestContext.getRenderContext();

        $scope.subview = renderContext.getNextSection();

        $scope.$on("requestContextChanged", function() {

            if (!renderContext.isChangeRelevant()) {

                return;

            }

            $scope.subview = renderContext.getNextSection();

        });

        $scope.$on("$routeChangeSuccess", function(event) {

            if (isRouteRedirect($route)) {

                return;

            }

            $scope.dynamicSeoContent = {};

            requestContext.setContext($route.current.action, $routeParams);

            $scope.$broadcast("requestContextChanged", requestContext);

        });

        /****************************** Definition of all the variables here *********************************/
        var protocol = $location.protocol();

        $rootScope.baseUrl = protocol + '://' + $location.host() + '/';
        $rootScope.s3baseUrl = protocol + '://ir0.mobify.com/jpg50/http://buynbragstores.s3.amazonaws.com/assets/images/stores/';
        $scope.defaultSeoContent = seo;
        $scope.dynamicSeoContent = {};
        $scope.bodyClass = 'landingActive';


        /******************************* Initialization of all the functions ****************************/

        //Calculate product count to load for masonry layout
        (function() {
            var MIN_IMG_WIDTH = 323,
            MARGIN = 25,      
            containerWidth, columns ;

            document.body.style.overflow = 'scroll';
            containerWidth = document.body.getBoundingClientRect().width;
            document.body.style.overflow = 'auto';

            columns = Math.floor(containerWidth/(MIN_IMG_WIDTH + MARGIN));

            if($rootScope.deviceType == 'touch') {
                if(columns < 2) {
                    $scope.imageCount = 10;
                }
                else {
                    $scope.imageCount = 16;
                }
            }
            else {
                $scope.imageCount = Math.floor((window.innerHeight/300)*2.5*columns);
            }           
            
        }());

        $scope.$on('userLoggedIn', function() {
            $scope.defaultView =  '/application/views/app/src/app/pages/home/home.html' ;
            $scope.bodyClass = '';
        });

        $scope.$on('notLoggedIn', function() {
            $scope.defaultView =  '/application/views/app/src/app/pages/blocked/blocked.html' ;
        });

        categoryService.getCategories("roots").then(function(data) {
            $scope.categories = data;
        });

        api.get('rapiv1/dod/dods', true).then(function(data) {
            if(data && data.data && data.data.dods) {
                $scope.deal = data.data.dods[0];
                $scope.$broadcast('DEALDATAREADY');
            }
        });

        $scope.cities = trendsService.names;


        /******************************** Definition of Functions for actions *****************************/

        $scope.trustSrc = function(src) {
            return $sce.trustAsResourceUrl(src);
        };

        $scope.userImg = function(obj) {
            if(obj && typeof(obj.id) !== 'undefined' && typeof(obj.dimension !== 'undefined') && typeof(obj.gender) !== 'undefined') {
                if(obj.id && !isNaN(obj.id)) {
                    return 'https://graph.facebook.com/' + obj.id + '/picture?width=' + obj.dimension + '&height=' + obj.dimension;
                }
                else {
                    if(obj.gender === "curator") {
                        return '/assets/images/sapna_pic.jpg';
                    }
                    else {
                        return obj.gender === "female" ? '/assets/images/default/female.png' : '/assets/images/default/male.png';
                    }
                }
                
            }
        };

        $scope.logout = function() {

            api.post("async/logout", {}).then(function(data) {

                $rootScope.user = {
                    userid: null,
                    userdata: {}
                };

                window.location.href = "/";
                //$window.location.reload();

            });

        };

    }
]);

var fbRegistrationWindow, fbLoginWindow;

function registrationStarted() {
    fbRegistrationWindow.close();
    angular.element('#postRegistrationModal').scope().displayModal();

}

function fbLoggedIn() {
    if(fbLoginWindow) {
        fbLoginWindow.close();
        angular.element('#loginModal').scope().logUserIn();
    }

    if(fbRegistrationWindow) {
        fbRegistrationWindow.close();
        angular.element('#loginModal').scope().logUserIn();
    }
    if(fbConnectWindow) {
        fbConnectWindow.close();
        angular.element('#loginModal').scope().connectWithFB();
    }

}

function alreadyRegistered() {
    fbLoggedIn();
}
