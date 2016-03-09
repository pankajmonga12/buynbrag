angular.module('fanciedByUsersModal', [])

.directive('userswhobragged', ['api', function(api) {
	var modalVisible = !1,
		page = 0,
		noMoreData = !1,
		productID;

	return {
		restrict: 'A',
		// scope: true,
		controller: function($scope) {
			$scope.busy = !1;

			this.getUsers = $scope.getUsersWhoFancied = function() {
				if(!modalVisible || $scope.busy || noMoreData) return;

				$scope.busy = !0;

				api.get('rapiv1/product/fanciedBy/' + productID + '/' + page).then(
					function(data) {
						if(!data || typeof(data) !== 'object') {
							noMoreData = !0;
							$scope.busy = !1;
							return;
						}
						
						$scope.usersWhoFancied.push.apply($scope.usersWhoFancied, data);
						page++;
						$scope.busy = !1;					
					},
					function(error) {

					}
				);
			};

		},
		link: function(scope, element, attrs, ctrl) {
			
			scope.usersWhoFancied = [];

			scope.$on('prodBraggedUserModal', function(event, args) {
				element.scrollTop = 0;
				modalVisible = !0;
				productID = args.pid;
				ctrl.getUsers();
			});

			scope.$on('$destroy', function() {
                element.remove();
            });

		}
	}
}])