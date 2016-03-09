angular.module('userSession.signUp', ['registrationFlow'])

.directive("signUp", ["$location", "$window", "$timeout", "user", "api", "$cookieStore", function($location, $window, $timeout, user, api, $cookieStore) {

    return {
        restrict: "A",
        controller: function($scope) {

            $scope.startRegistration = function() {
                var fbDimensions = new function() {
                    this.width = 800;
                    this.height = 450;
                    this.left = ($window.innerWidth - this.width)/2;
                    this.top = ($window.innerHeight - this.height)/2;
                };
                
                //Redirect for ios Chrome
                if(navigator.userAgent.match('CriOS')) {
                    $window.location.href = '/fbLogin/index';
                }
                else {
                    fbRegistrationWindow = window.open("/rapiv1/ulogin/facebook", "_blank", 'width=' + fbDimensions.width + ', height=' + fbDimensions.height + ', left=' + fbDimensions.left + ', top=' + fbDimensions.top + ', status=yes, resizable=yes', true);    
                }

            };

        },
        link: function(scope, element, attrs) {

            scope.signUpLocal = function() {

                (scope.register.pw1 !== scope.register.pw2) && (scope.formError = "Passwords do not match!");

                api.post("ajax/signup", {
                                            signup_email:  scope.register.email,
                                            signup_fname:  scope.register.fname,
                                            signup_lname:  scope.register.lname,
                                            signup_pw1:    scope.register.pw1,
                                            signup_pw2:    scope.register.pw2,
                                            signup_gender: scope.register.gender
                                        }
                ).then(function(data) {

                    switch(data){

                        case "sign_up_success":

                            $timeout(function() {

                                $cookieStore.put("newBnbUser", {"newRegisteredUser": new Date().getTime()});

                                ($location.path().indexOf('register') !== -1) && ($window.location.href = '#/');

                                $timeout(function() { 

                                    $window.location.reload();

                                }, 100);

                            }, 500);

                            break;

                        case "existing_signup_user":

                            scope.formError = "User already registered";

                            break;

                        case "existing_facebook_user":

                            scope.formError = "User already signed up with facebook";

                            break;

                        default:

                            scope.formError = "Please check the details entered";

                    }
                });
            };
        }
    }
}]);