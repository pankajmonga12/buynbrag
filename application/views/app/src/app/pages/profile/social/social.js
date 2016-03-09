angular.module('profilePage')

.controller('SocialController', ['$scope', 'api', 'requestContext', "user", function($scope, api, requestContext, user) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.social", "userID" );
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }

        if(requestContext.hasParamChanged('userID')) {
            refreshView();
        }

        $scope.subview = renderContext.getNextSection();
    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/ 
    var listSize = 10,
        influencers = [22, 77, 2509 , 1221, 5642, 9597, 2340, 2461, 6276, 3670, 989, 3024, 5984, 9029, 7495, 5955, 8006, 4147, 2800, 94, 2801, 115];

    $scope.followerAfter = 0;
    $scope.followingAfter = 0;
    $scope.showSuggestions = false;
    $scope.followers = [];
    $scope.following = [];
    $scope.hideFollowerBtn = false;
    $scope.hideFollowingBtn = false;
    $scope.hideFollowerSpinner = false;
    $scope.hideFollowingSpinner = false;

    refreshView();

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/

    $scope.loadMoreFollowers = function() {

        $scope.followerAfter += 1;

        loadFollowers();

    };

    $scope.loadMoreFollowing = function() {

        $scope.followingAfter += 1;

        loadFollowing();

    };

    function loadFollowers() {

        api.get('rapiv1/profile/followers/' + $scope.userID + '/' + $scope.followerAfter + '/' + listSize, true).then(function(data) {

            if(!data || data.data === 'null' || data.data === null) {
                $scope.hideFollowerBtn = true;
                $scope.hideFollowerSpinner = true;

                if($scope.followers.length < 1 && user.getuser() && $scope.userID == user.getuser()) {
                    $scope.showSuggestions = true;
                    $scope.followSuggestions = [];
                    chainLoading();
                }
                return;
            }

            if(data.data.length < listSize) {
                $scope.hideFollowerBtn = true;
            }

            angular.forEach(data.data, function(user) {

                $scope.followers.push(user);
            });
            
            $scope.hideFollowerSpinner = true;

        });  

    }

    function chainLoading() {
        var influencer = influencers.pop();

        if(influencer) {
            api.get('rapiv1/profile/info/' + influencer, true).then(function(data) {
                var info = data.data.userInfo[0];
                info.userID = influencer;

                $scope.followSuggestions.push(info);
                return chainLoading();
            });
        }
    }

    function loadFollowing() {

        api.get('rapiv1/profile/following/' + $scope.userID + '/' + $scope.followingAfter + '/' + listSize, true).then(function(data) {

            if(!data || data.data === 'null' || data.data === null) {
                $scope.hideFollowingBtn = true;
                $scope.hideFollowingSpinner = true;
                return;
            }

            if(data.data.length < listSize) {
                $scope.hideFollowingBtn = true;
            }

            angular.forEach(data.data, function(user) {

                $scope.following.push(user);
            });
            
            $scope.hideFollowingSpinner = true;
        }); 

    }

    function refreshView() {
        $scope.hideFollowerSpinner = false;
        $scope.hideFollowingSpinner = false;
        $scope.followerAfter = 0;
        $scope.followingAfter = 0;
        $scope.followers.length = 0;
        $scope.following.length = 0;
        $scope.hideFollowerBtn = false;
        $scope.hideFollowingBtn = false;

        loadFollowers();
        loadFollowing();        
    } 

}])