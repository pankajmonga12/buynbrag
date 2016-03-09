angular.module('facebookService', [])

.factory('facebookFriends', ['$q', '$timeout', function($q, $timeout) {
	var friends = [];

	return {
		get: function() {
			var defer = $q.defer();

			if(friends.length > 0) {
				defer.resolve(friends);
			}
			else {
				
				FB.api('/me/friends?fields=installed,name,gender', function(response) {
					if(response && response.data && response.data.length !== 0) {
						friends = response.data;
						$timeout(function() { defer.resolve(friends); }, 0);
					}
				});

			}

			return defer.promise;
		},
		isFBConnected: function() {
			var defer = $q.defer();

			FB.getLoginStatus(function(response) {
				if(response.status === 'connected') {
					$timeout(function() { defer.resolve(!0); }, 0);
				}
				else {
					$timeout(function() { defer.resolve(!1); }, 0);
				}
			});

			return defer.promise;
		},
		openFBLoginDialog: function() {
			var defer = $q.defer();

			FB.login(function(response) {
				if(response.authResponse) {
					$timeout(function() { defer.resolve(!0); }, 0);
				}
				else {
					$timeout(function() { defer.resolve(!1); }, 0);
				}
			});

			return defer.promise;
		}
	}
}])