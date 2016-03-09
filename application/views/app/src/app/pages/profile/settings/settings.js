angular.module('profilePage')

.controller('ProfileSettingsController', ['$scope', 'api', 'requestContext', '$http', '$timeout', function($scope, api, requestContext, $http, $timeout) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.settings" );
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }
        $scope.subview = renderContext.getNextSection();
    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/
    $scope.genders = ['male', 'female'];
    $scope.saveResponse = '';
    $scope.editableUserInfo = {};
    $scope.savedClass = '';
    angular.copy($scope.userInfo, $scope.editableUserInfo); 
    $scope.editableUserInfo.gender = $scope.genders[$scope.genders.indexOf($scope.editableUserInfo.userGender.toLowerCase())]; 

    $http.get('/countryList.json').then(function(data) {
        $scope.countries = data.data;

        angular.forEach($scope.countries, function(country) {
            if(country.name == $scope.editableUserInfo.userCountry) {
                $scope.editableUserInfo.country = country;
            }
        });
    });

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/

    $scope.updateProfile = function() {
        var userDOB = $scope.editableUserInfo.userDOB.split('-');

        $scope.$broadcast('showSpinner');

        api.post('rapiv1/profile/saveUserDetails', {
            fName: $scope.editableUserInfo.firstName + ' ' + $scope.editableUserInfo.lastName,
            dd: userDOB[2],
            mm: userDOB[1],
            yy: userDOB[0],
            sex: $scope.editableUserInfo.gender,
            city: $scope.editableUserInfo.userCity,
            cc: $scope.editableUserInfo.country.code
        }).then(function(data) {
            $scope.$broadcast('hideSpinner');
            $scope.savedClass = 'savingDone';
            $timeout(function() { $scope.savedClass = ''; }, 5000);
            var response = data.data;

            if(response.updateOK) {
                $scope.saveResponse = 'Changes successfully saved!';
            }
        });
    };

    $scope.resetForm = function() {
       angular.copy($scope.userInfo, $scope.editableUserInfo); 
    };

}])

.controller('PasswordChangeController', ['api', '$scope', 'user', function(api, $scope, user) {

    $scope.formError = '';

    $scope.$watch('passwords.newPswd', function(password) {

        if(password && password.length < 7) {
            $scope.formError = 'Password should be atleast 7 characters long!'
        }
        else {
            $scope.formError = '';
        }

    });

    $('#passwordChangeModal').on('hidden', function() {

        $scope.$apply(function() {
            $scope.formError = '';
            $scope.passwords.currPswd = '';
            $scope.passwords.newPswd = '';
            $scope.passwords.cnfNewPswd = '';
        });

    });

    $scope.changePassword = function() {

        if($scope.passwords.newPswd !== $scope.passwords.cnfNewPswd) {
            $scope.formError = 'New Passwords must match!';
        }
        else {

            api.post('rapiv1/profile/saveNewPassword', {
                curPw: $scope.passwords.currPswd,
                newPw: $scope.passwords.newPswd,
                cnfNewPw: $scope.passwords.cnfNewPswd
            }).then(function(data) {
                var response = data.data;

                if(!response.userExists) {
                    $scope.formError = 'User Does not Exist!';
                }
                else if(!response.currentPasswordMatches) {
                    $scope.formError = 'Please enter correct Current Password!';
                }
                else if(!response.passwordUpdated) {
                    $scope.formError = 'Password could not be updated, please try after some time!'
                }
                else {
                    $scope.formError = 'Password successfully changed!'
                }

            });

        }
    };

}])