angular.module('blocked', [])

.directive('blockedView', ['api', function(api) {

	return {
		restrict: 'A',
		controller: function($scope) {
			var page = 0,
				busy = !1;
			$scope.products = [];

			$scope.getProducts = function() {
				if(busy || page === 4) return;
				busy = !0;

				api.get('rapiv1/ldata/get/' + page).then(
					function(data) {
						if(data && data.result) {
							$scope.products.push.apply($scope.products, data.result);
							page++;
							busy = !1;
						}
					}, function(error) {

					}
				);
			};

			

		},
		link: function(scope, element, attrs) {



		}
	}
}])