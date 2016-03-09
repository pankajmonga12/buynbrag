angular.module('registrationFlow', ['fancyProducts', 'followPeople', 'selectRegistrationCategory'])

.directive('registrationFlow', ['api', function(api) {

	var views = {
		1 : 'category',
		2 : 'products',
		3 : 'people'
	};

	return {
		restrict: 'A',
		controller: function($scope) {

			$scope.subview = '';
			$scope.showRegistrationModal = !1;

			$scope.displayModal = function() {
				$scope.showRegistrationModal = !0;
				
				api.get('async/checkLogin').then(function(data) {
                    var level = data[0] && data[0].isLoggedIN ? data[1].rFlowStatus : 0;
                    
                    if(+level === 1) {
                    	$scope.userDetails = data[1];
                        $scope.$broadcast('CATEGORYVIEW');
                    }
                   
                }); 

			};

			$scope.$on('PEOPLEVIEW', function() {
				$scope.subview = 'people';
			});

			$scope.$on('CATEGORYVIEW', function() {
				$scope.showRegistrationModal = !0;
				$scope.subview = 'category';
			});

			$scope.$on('PRODUCTSVIEW', function() {
				$scope.subview = 'products';
			});

			$scope.$on('STOREVIEW', function() {
				$scope.subview = 'stores';
			});

			$scope.goBack = function(view) {
				if(view > 1) {
					$scope.subview = views[+view - 1];
				}
			};

		},
		link: function(scope, element, attrs) {

		}
	}

}])