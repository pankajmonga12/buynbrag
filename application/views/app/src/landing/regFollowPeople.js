angular.module('followPeople', [])

.directive('followPeople', ['$rootScope', '$window', 'api', function($rootScope, $window, api) {

	var personsToFollow = 3;

	return {
		restrict: 'A',
		controller: function($scope) {

			$scope.personsFollowed = 0;

			api.get('rapiv1/firstlogin/getHandPickedUsers').then(function(data) {
				var results = data.data || null;

				if(results) {
					angular.forEach(results, function(value, key){
						value['userImgSrc'] = (!isNaN(value.userFBID)) ? api.userImageFb(value.userFBID, 75) : api.userImageBnb(value.userGender);
					});

					$scope.personsToFollow = results;

                    stickyElem(document.getElementById('msgBanner'), document.querySelector('.fanciedProductsContainer'), 0, 56);
				}
			});

			$scope.switchView = function() {
				if($scope.personsFollowed >= 3) {
					$window.location.reload();
				}
				else {
					alert('Please follow atleast 3 users!')
				}
			};

		},
		link: function(scope, element, attrs) {

		}
	}
}])

.directive('followUser', ['api', function(api) {

	var txtFollow = 'Follow!',
		txtFollowed = 'Followed!';

	return {
		restrict: 'A',
		scope: {
			usertofollow: '@',
			userid: '@'
		},
		controller: function($scope) {
			$scope.followText = txtFollow;
		},
		link: function(scope, element, attrs) {

			element.bind('mouseup', function() {

				scope.$apply(function() {
					if(scope.followText === txtFollow) {
						api.get('rapiv1/profile/follow/' + scope.userid + '/' + scope.usertofollow).then(function(data) {
		                    scope.followText = txtFollowed;
		                    scope.$parent.$parent.personsFollowed++;
		                });
					}
				});				

			});
		}
	}
}])