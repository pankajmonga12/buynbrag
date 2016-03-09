angular.module('profilePage')

.controller('ProfileAboutController', ['$scope', 'api', 'requestContext', 'user', function($scope, api, requestContext, user) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.about", "userID" );
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
    $scope.aboutMe = '';
    $scope.newTag = '';
    $scope.saveBtnText = 'Save';
    $scope.allStyleTags = {};
    $scope.userStyleTags = [];    

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/

    api.get('rapiv1/profile/getTags', !0).then(
        function(data) {
            if(!data) return;

            angular.forEach(data, function(tag){
                $scope.allStyleTags[tag.styleID] = tag;
                $scope.allStyleTags['added'] = !1;
            });

            return api.get('rapiv1/profile/getUserStyleTags/' + $scope.userID);
        }, function(error) {

        }
    ).then(
        function(data) {
            if(data && data.data) {
                var userStyleTags = data.data;
                $scope.userStyleTags = userStyleTags;

                angular.forEach(userStyleTags, function(tag){
                    if($scope.allStyleTags[tag.styleID]) {
                        $scope.allStyleTags[tag.styleID].added = !0;
                    }
                });
            }
        }, function(error) {

        }
    );

    $scope.updateAboutMe = function() {
        if($scope.aboutMe) {
            var aboutText = $scope.aboutMe;
            $scope.aboutMe = '';
            $scope.saveBtnText = 'Saved';
            api.post('rapiv1/profile/saveUserAboutMe', {aboutMe: aboutText}).then(function(data) {
                if(data.data.saved) {
                    $scope.userInfo.userAboutMe = aboutText;
                }
            });
        }
    };

    $scope.updateSaveBtnText = function() {
        $scope.saveBtnText = 'Save';
    };

    $scope.toggleTag = function(tag) {

        if($scope.userID != user.getuser()) return;

        if($scope.allStyleTags[tag.styleID].added) {
            //Delete tag
            $scope.allStyleTags[tag.styleID].added = !1;

            api.get('rapiv1/profile/removeUserStyleTag/' + tag.styleID).then(
                function(data) {
                    if(data && !data.data.saved) {
                        $scope.allStyleTags[tag.styleID].added = !0;
                    }
                },
                function(error) {
                    $scope.allStyleTags[tag.styleID].added = !0;
                }
            );
        }
        else {
            //Add Tag
            $scope.allStyleTags[tag.styleID].added = !0;

            api.get('rapiv1/profile/saveUserStyleTag/' + tag.styleID).then(
                function(data) {
                    if(data && !data.data.saved) {
                        $scope.allStyleTags[tag.styleID].added = !1;
                    }
                },
                function(error) {
                    $scope.allStyleTags[tag.styleID].added = !1;
                }
            );
        }

        
    };

}])