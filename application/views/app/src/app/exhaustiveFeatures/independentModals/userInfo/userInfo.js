angular.module('userInfo', [])

.directive('userInfo', ['api', function(api) {

    return {
        restrict: 'A',
        controller: function($scope) {

            $scope.friendInfo = {};


            $scope.$on('personModal', function(event, args) {

                $scope.userId = args.uid;

                $scope.friendInfo.firstName = '';
                $scope.friendInfo.lastName = '';
                $scope.friendInfo.profilePic = '';
                $scope.friendInfo.userRank = '';
                $scope.friendInfo.totalFanciedProducts = '';
                $scope.friendInfo.totalBadges = '';
                $scope.friendInfo.totalFollowers = '';

                api.get('rapiv1/profile/info/' + $scope.userId, true).then(function(data) {
                    var userInfo = data.data.userInfo[0],
                        userNameDetails = userInfo.userFullName.split(' ');

                    $scope.friendInfo.firstName = userNameDetails.slice(0, -1).join(' ');
                    $scope.friendInfo.lastName = userNameDetails.slice(-1)[0];
                    $scope.friendInfo.profilePic = !isNaN(userInfo.userFBID) ? api.userImageFb(userInfo.userFBID, 200) : api.userImageBnb(userInfo.userGender);
                    $scope.friendInfo.userRank = userInfo.userRank || $scope.userId;
                    $scope.friendInfo.totalFanciedProducts = userInfo.totalFanciedProducts || 0;
                    $scope.friendInfo.totalBadges = userInfo.totalBadges || 0;
                    $scope.friendInfo.totalFollowers = userInfo.totalFollowers || 0;
                    $scope.friendInfo.userCity = userInfo.userCity;
                });

            });    

        },
        link: function(scope, element, attrs) {

            scope.$on('$destroy', function() {
                element.remove();
            });

        }
    }
}])