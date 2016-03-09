angular.module('userSession.signIn', ['services.cart'])

.directive("signIn", ["$rootScope", "$location", "$window", "$timeout", "user", "api", "$cookieStore", "cart", "$q", "$route", function($rootScope, $location, $window, $timeout, user, api, $cookieStore, cart, $q, $route) {
    return {
        restrict: "A",
        controller: function($scope) {

            $rootScope.user = {
                userid: null,
                userdata: {
                    loggedin: false
                }
            };
            
            $scope.formError = null;

            $scope.signInFB = function() {
                var fbDimensions = new function() {
                    this.width = 800;
                    this.height = 450;
                    this.left = ($window.innerWidth - this.width)/2;
                    this.top = ($window.innerHeight - this.height)/2;
                };
                
                if(navigator.userAgent.match('CriOS')) {
                    $window.location.href = '/fbLogin/index';
                }
                else {
                    fbLoginWindow = window.open("/rapiv1/ulogin/facebook", "_blank", 'width=' + fbDimensions.width + ', height=' + fbDimensions.height + ', left=' + fbDimensions.left + ', top=' + fbDimensions.top + ', status=yes, resizable=yes', false);
                }
    
            };

            $scope.connectWithFB = function() {
                api.get('rapiv1/firstlogin/changeUserFlowStatus/6').then(function(data) {
                        if(data && data.data) {
                            $window.location.href= '/';
                        }
                    });
            };

            $scope.logUserIn = function() {

                api.get("async/checkLogin").then(function(data) {

                    if(data[0] && data[0].isLoggedIN && data[1]) {
                        switch(+data[1].rFlowStatus) {
                            case 1:
                                $rootScope.userDetails = data[1];
                                $rootScope.$broadcast('CATEGORYVIEW');
                                break;
                            case 6:
                                updateUserData(data[1], data[2], data[3].badgesData);
                                break;
                        }
                        
                    }
                    else {
                        $rootScope.$broadcast('notLoggedIn');
                    }

                    $cookieStore.get("newBnbUser") && handleNewUser();

                });
            };

            $scope.clearError = function() {
                $scope.formError = '';
            };

            $scope.signInLocal = function() {

                if($scope.loginForm.$valid) {
                    api.post("async/login", {
                                                signin_email: $scope.login.email,
                                                signin_pw: $scope.login.password
                                            }
                    ).then(function(data) {

                        var signInDetails = data[1],
                            signInData = data[2],
                            badgesData = data[3].badgesData;

                        if(data[0].validCredentials && data[0].sessionSet && data[0].rFlowStatus) {
                            if($location.path().indexOf('login') !== -1) {
                                //loggin from login page
                                $window.location.href = '/';

                            }

                            updateUserData(signInDetails, signInData, badgesData);
                            angular.element('#loginModal').modal('hide');

                        }
                        else {

                            $scope.formError = "Please enter valid Email & Password!";

                        }
                    });
                }
                else {
                    $scope.formError = 'Please enter valid Email & Password!';
                }

                
            };

            function updateUserData(logindata, userdata, badgedata) {

                var fbId = (logindata.FBID && !isNaN(logindata.FBID)) ? logindata.FBID : null ;
                var imgSrc = fbId ? api.userImageFb(fbId, 75) : api.userImageBnb(logindata.gender);

                $rootScope.user = {
                    userid: logindata.ID,
                    userdata: {
                        loggedin: true,
                        email: logindata.email,
                        name: logindata.fullName,
                        city: logindata.userCity,
                        country: logindata.userCountry,
                        gender: logindata.gender,
                        dob: logindata.userDOB,
                        cartcount: userdata.cartCount,
                        rank: (userdata.rank || logindata.ID),
                        fancy: parseInt(userdata.fancyCount),
                        fbid: fbId,
                        fbsrc: imgSrc,
                        totalBadges: userdata.totalBadges || 0,
                        bragBucks: logindata.bragBucks,
                        collectionsCount: userdata.fancyListCount
                    },
                    badgesData: badgedata
                };

                $rootScope.$broadcast('userLoggedIn');

                //Initialise cart
                cart.get();

                // Add class for successful sign in
                document.documentElement.className += " loggedIn";

                var fbRegister = getCookie('bnbX_firstLogin');
                if(fbRegister === 'true'){
                    _bnbAnalytics.fbRegisterSuccess(logindata.ID, logindata.email, logindata.fullName, logindata.gender, logindata.FBID, logindata.userDOB, logindata.userAge, logindata.userCity, logindata.userCountry);
                }else{
                    _bnbAnalytics.trackLoginSuccess(logindata.ID, logindata.email, logindata.fullName, logindata.gender, logindata.FBID, logindata.userDOB, logindata.userAge, logindata.userCity, logindata.userCountry, logindata.userJoinedDate);
                }
                 _bnbAnalytics.userStatsUpdate(logindata.ID, logindata.email, userdata.rank, userdata.fancyCount, userdata.cartCount, userdata.totalOrders, userdata.totalBadges);
            }

            function handleNewUser() {

                var imgSrc = "http://affiliates.icubeswire.com/track_lead/353/" + user.getEmail(),
                    elm = document.createElement("img");

                elm.src = imgSrc;

                angular.element("body").append(elm);
                $cookieStore.remove("newBnbUser");

            }

        },
        link: function(scope, element, attrs) {

            //Check if user is already logged in
            scope.logUserIn();

            scope.$on('$destroy', function() {
                element.remove();
            })

        }
    }
}]);