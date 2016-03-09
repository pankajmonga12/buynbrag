angular.module('facebookInvite', ['facebookService'])

.directive('inviteFacebook', ['$rootScope', 'user', 'facebookFriends', function($rootScope, user, facebookFriends) {
	var fbFriendsNotOnBnb = {male: [], female: []},
		fbFriendsOnBnb = {male: [], female: []},
		fbFriends = [],
		invitedFriends = [];

	return {
		restrict: 'A',
		controller: function($scope) {

			var maleCounter = 0,
				femaleCounter = 0;

			$scope.fbFriendsToInvite = [];

			if(user.getloginstatus() && fbFriends.length === 0) {
				facebookFriends.get().then(function(response) {
					if(response && response.length !== 0) {
						fbFriends = response;

						angular.forEach(fbFriends, function(friend){
							if(typeof(friend.installed) === 'undefined') {
								friend.gender.toLowerCase() == 'male' ? fbFriendsNotOnBnb['male'].push(friend) : fbFriendsNotOnBnb['female'].push(friend);
							}
							else if(friend.installed) {
								friend.gender.toLowerCase() == 'male' ? fbFriendsOnBnb['male'].push(friend) : fbFriendsOnBnb['female'].push(friend);
							}
						});

						updateFriends(5);
					}
				});
			}

			$scope.inviteFriend = function(friend) {
				FB.ui({
					method: 'apprequests',
					message: user.getName() + " has invited you to join BuynBrag. Discover amazing designs, brag the things you love, unlock amazing deals!",
					to: friend.id
				}, function(response) {
					if(response && response.to && response.to.length === 1) {
						$scope.$apply(function() {
							$scope.fbFriendsToInvite.splice($scope.fbFriendsToInvite.indexOf(friend), 1);
							friend.gender.toLowerCase() == 'female' ?
								fbFriendsNotOnBnb['female'].splice(fbFriendsNotOnBnb['female'].indexOf(friend), 1) :
								fbFriendsNotOnBnb['male'].splice(fbFriendsNotOnBnb['male'].indexOf(friend), 1);
						});
					}
				});
			};

			$scope.inviteMultiple = function() {
				FB.ui({
					method: 'apprequests',
					message: user.getName() + " has invited you to join BuynBrag. Discover amazing designs, brag the things you love, unlock amazing deals!",
					filters: ["app_non_users"]
				}, function(response) {
					if(response && response.to) {
						$scope.$apply(function() {
							
						});
					}
				});
			};

			$scope.$watch('fbFriendsToInvite.length', function(val) {
				if(val < 5 && fbFriends.length != 0) {
					var friendsToLoad = 5 - (+val);
					updateFriends(friendsToLoad);
				}
			});

			function updateFriends(count) {
				var femaleCount, femaleFriends;

				if(count === 5) {
					if($rootScope.user.userdata.gender.toLowerCase() == 'male') {
						femaleFriends = fbFriendsNotOnBnb['female'].slice(femaleCounter, femaleCounter+4);
						$scope.fbFriendsToInvite.push.apply($scope.fbFriendsToInvite, femaleFriends);
						$scope.fbFriendsToInvite.push.apply($scope.fbFriendsToInvite, fbFriendsNotOnBnb['male'].slice(maleCounter, maleCounter + 5- femaleFriends.length));
						femaleCounter += femaleFriends.length;
						maleCounter += 5 - femaleFriends.length;
					}
					else {
						femaleFriends = fbFriendsNotOnBnb['female'].slice(femaleCounter, femaleCounter+3);
						$scope.fbFriendsToInvite.push.apply($scope.fbFriendsToInvite, femaleFriends);
						$scope.fbFriendsToInvite.push.apply($scope.fbFriendsToInvite, fbFriendsNotOnBnb['male'].slice(maleCounter, maleCounter + 5 - femaleFriends.length));
						femaleCounter += femaleFriends.length;
						maleCounter += 5 - femaleFriends.length;
					}
				}
				else {
					$scope.fbFriendsToInvite.push.apply($scope.fbFriendsToInvite, fbFriendsNotOnBnb['female'].slice(femaleCounter, femaleCounter+1));
					femaleCounter += 1;
				}
				
				
			}

		},
		link: function(scope, element, attrs) {

		}
	}
}])