angular.module('changePassword', [])

.controller("ForgotPasswordController", ["$scope", "api", function($scope, api) {

    $scope.show = true;

    $scope.recoverPassword = function() {

        if($scope.forgotForm.$valid) {

            api.post("async/forgotPassword/1", {email: $scope.email}).then(function(response) {
                $scope.message = "";

                if(response.userExists == false) {
                    $scope.message = "User does not exist";
                }
                else {
                    if(response.hashGenerated != false) {
                        if(response.hashSaved == false || response.emailSent == false) {
                            $scope.message = "Server seems busy, please try after some time";
                        }
                        else if(response.emailSent == true) {
                            $scope.show = false;
                        }
                    }
                }
            });
        }
        else {
            $scope.message = "Please enter your Email!"
        }

        
    };

}])

.controller("ResetPasswordController", ["$scope", "api", "requestContext", "$timeout", "$window", function($scope, api, requestContext, $timeout, $window) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "reset" );
    $scope.resetHash = requestContext.getParam( "resetHash" );

    $scope.subview = renderContext.getNextSection();

    /**************************************************************/
    /*********************** Initialize ***************************/
    /**************************************************************/


    /**************************************************************/
    /******************** Controller Logic ************************/
    /**************************************************************/
    $scope.resetPassword = function() {

        if($scope.newPasswords.password1 === $scope.newPasswords.password2) {
            api.post("async/forgotPassword/2/" + $scope.resetHash, {
                                                                    newPassword: $scope.newPasswords.password1,
                                                                    newPasswordConfirm: $scope.newPasswords.password2
                                                                    }
            ).then(function(response) {

                if(response.newPasswordSet == true) {
                    $scope.message = "Your new password has been set!";
                    console.log($scope.message);
                    $timeout(function() {
                        $window.location.href = "login";
                    }, 5000);
                }
                else {
                    $scope.message = "Sorry, some problem occurred, please try after some time!";
                }

            });
        }
        else {
            $scope.message = "Passwords must match, please try again!";
            console.log($scope.message);
        }

    };

}]);