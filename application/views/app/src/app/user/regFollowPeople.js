angular.module('followPeople', [])

.directive('followPeople', ['$rootScope', '$window', 'api', function($rootScope, $window, api) {

	var personsToFollow = 3;

	return {
		restrict: 'A',
		controller: function($scope) {

			$scope.personsFollowed = 0;
			$scope.personsToFollow = [];
			$scope.friendsOnFacebook = [];

			api.get('rapiv1/firstlogin/getHandPickedUsers').then(function(data) {
				var suggestedUsers = data.data.handpicked || null,
					facebookFriends = data.data.friends || null;

				if(facebookFriends) {
					angular.forEach(facebookFriends, function(value, key){
						value['userImgSrc'] = (!isNaN(value.userFBID)) ? api.userImageFb(value.userFBID, 75) : api.userImageBnb(value.userGender);
						$scope.friendsOnFacebook.push(value);
					});
				}

				if(suggestedUsers) {
					angular.forEach(suggestedUsers, function(value, key){
						value['userImgSrc'] = (!isNaN(value.userFBID)) ? api.userImageFb(value.userFBID, 75) : api.userImageBnb(value.userGender);
						$scope.personsToFollow.push(value);
					});

				}
				
			});

			$scope.switchView = function() {
				if($scope.personsFollowed >= 3) {

					//Update user registration status and log him
					api.get('rapiv1/firstlogin/changeUserFlowStatus/6').then(function(data) {
						if(data && data.data) {
							$window.location.reload();
						}
					});
					
				}
			};

			$scope.$watch('personsFollowed', function(count) {
				if(count < 3) {
//					$scope.buttonText = 'Follow ' + (3 - count) + ' more!';
					$scope.buttonText = (3 - count) + ' more';
				}
				else {
					$scope.buttonText = 'Finish';
				}
				
			});

		},
		link: function(scope, element, attrs) {

		}
	}
}])

.directive('followUser', ['api', '$rootScope', function(api, $rootScope) {

	var txtFollow = 'Follow',
		txtFollowed = 'Following';

	return {
		restrict: 'E',
		scope: {
			usertofollow: '@',
			userid: '@',
			classlist: '@',
			followers: '@'
		},
		templateUrl: '/application/views/app/src/app/user/followBtn.html',
		controller: function($scope) {
			$scope.followText = txtFollow;
		},
		link: function(scope, element, attrs) {

			scope.triggerFollow = function() {
				if(scope.followText === txtFollow) {
					scope.followText = txtFollowed;
	                scope.$parent.$parent.personsFollowed++;
	                scope.followers = +(scope.followers) + 1;
	                
					api.get('rapiv1/profile/follow/' + scope.userid + '/' + scope.usertofollow).then(function(data) {
	                     _bnbAnalytics.registerFollow($rootScope.userDetails.ID, $rootScope.userDetails.email, "Registration_Flow", scope.userid);
	                });
				}
			};

		}
	}
}])