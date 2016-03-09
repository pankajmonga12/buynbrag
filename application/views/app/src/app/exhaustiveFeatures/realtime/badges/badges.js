angular.module('realtime.badges', [])

.controller("BadgesController", ["$scope", "user", "$timeout", "api", function($scope, user, $timeout, api) {

    var badgeOpen = !1;
    $scope.userBadges = [];

    //Start Polling for changes
    startPolling();

    $("#badgesModal").on("hidden", function() {
    	badgeOpen = !1;

        api.get("ajax/badge_success/" + $scope.badge.badgeType);

        $timeout(function() {

            $scope.userBadges.length !== 0 && displayBadge();

        }, 30000);

    });

    function displayBadge() {

        $scope.badge = $scope.userBadges.pop();
        $("#badgesModal").modal("show");
        badgeOpen = !0;

    }

    function startPolling() {
    	//if(!user.getloginstatus()) return;

    	var polling = window.setInterval(function() {
    		api.get('async/badgeNotifications', false, true).then(
    			function(data) {
    				if(data && data.result) {
    					var badges = data.result.badgesData,
    						badge;

    					if(badges.toString() === '[object Object]' && Object.keys(badges).length > 0) {
    						angular.forEach(badges, function(val) {
    							badge = {
                                    id : val.type.toString() + val.level.toString(),
				                    badgeSrc: "/assets/images/badges/" + val.img,
				                    badgeText: val.txt,
				                    badgeType: val.type
				                };

                                if($scope.userBadges.indexOfObject('id', badge.id) < 0) {
                                    $scope.userBadges.splice(0, 0, badge);
                                }

    						});
    					}

    					!badgeOpen && $scope.userBadges.length !== 0 && displayBadge();
    				}

    			}
    		);
    	}, 60000);
    }

}]);