angular.module('selectRegistrationCategory', [])

.directive('selectCategory', ['$rootScope', '$window', 'api', function($rootScope, $window, api) {

	return {
		restrict: 'A',
		controller: function($scope) {

			$scope.categoriesSelected = 0;

			api.get('rapiv1/firstlogin/cats').then(function(data) {
				if(data && data.data) {
					$scope.categoriesToSelect = data.data;
				}
			});

			// $scope.selectCat = function(category) {
			// 	api.get('rapiv1/firstlogin/saveCatPref/' + category.catID).then(
			// 		function(data) {
			// 			if(data && data.data) {
			// 				$scope.categoriesSelected++;
			// 			}
			// 		}
			// 	);
			// };

			$scope.switchView = function() {
				if($scope.categoriesSelected >= 1) {
					$scope.$emit('PRODUCTSVIEW');
				}
			};

			$scope.$watch('categoriesSelected', function(count) {
				if(count < 1) {
//					$scope.buttonText = 'Select ' + (3 - count) + ' more';
					$scope.buttonText = (1 - count) + ' more';
				}
				else {
					$scope.buttonText = 'Continue';
				}
				
			});
		},
		link: function(scope, element, attrs) {

		}
	}
}])

.directive('selectCat', ['api', function(api) {
	var txtSelect = 'Select',
		txtSelected = 'UnSelect',
		selectedCategories = [];

	return {
		restrict: 'A',
		controller: function($scope) {

			$scope.selectText = selectedCategories.indexOf($scope.category.catID) > -1
				? txtSelected
				: txtSelect;

			$scope.$parent.categoriesSelected = selectedCategories.length;

		},
		link: function(scope, element, attrs) {

			scope.selectCat = function(cat) {
				if(scope.selectText === txtSelect) {
					scope.selectText = txtSelected;

					api.get('rapiv1/firstlogin/saveCatPref/' + cat.catID).then(
						function(data) {
							if(data && data.data) {
								selectedCategories.push(cat.catID);
								scope.$parent.categoriesSelected++;
							}
						}
					);
				}
				else if(scope.selectText === txtSelected) {
					scope.selectText = txtSelect;

					api.get('rapiv1/removeCatPref/' + cat.catID).then(function(data) {
						if(data.data && data.data.saved) {
							selectedCategories.splice(selectedCategories.indexOf(cat.catID), 1);
							scope.$parent.categoriesSelected--;
						}
					});
				}
								
			};
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