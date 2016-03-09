angular.module('fancyProducts', [])

.directive('fancyProducts', ['$rootScope', '$window', 'api', function($rootScope, $window, api) {

	return {
		restrict: 'A',
		controller: function($scope) {

			$scope.productsFancied = 0;

            stickyElem(document.getElementById('msgBanner'), document.querySelector('.fanciedProductsContainer'), 0, 56);

			api.get('rapiv1/ldata/get/0').then(function(data) {
				if(data.result) {
					$scope.productsToFancy = data.result;
				}
			});

			$scope.switchView = function() {
				if($scope.productsFancied >= 3) {
					$rootScope.$broadcast('PEOPLEVIEW');
				}
				else {
					alert('Please fancy atleast 3 items!');
				}
			};
		},
		link: function(scope, element, attrs) {

		}
	}
}])

.directive('fancyProduct', ['api', function(api) {

	var txtFancy = 'Fancy It!',
		txtFancied = 'Fancied!';

	return {
		restrict: 'A',
		scope: {
			productid: '@'
		},
		controller: function($scope) {
			$scope.fancyText = txtFancy;
		},
		link: function(scope, element, attrs) {

			element.bind('mouseup', function() {

				scope.$apply(function() {
					if(scope.fancyText === txtFancy) {
						api.get("async/fancy2/" + scope.productid).then(function(data) {
		                    if( data.fancy && !data.alreadyFancied ) {
		                    	scope.fancyText = txtFancied;
		                    	scope.$parent.$parent.productsFancied++;
		                    }
		                });
					}
				});				

			});
		}
	}
}])