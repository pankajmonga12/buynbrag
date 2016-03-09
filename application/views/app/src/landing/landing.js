angular.module("landingApp", ["loginRegisterModule", "fancyProducts", "followPeople", "services.api", "dmClick"])

.run(['$rootScope', function($rootScope) {
	
}])

.controller("AppController", ["$scope", "$rootScope", "$http", "$location", 'api', function($scope, $rootScope, $http, $location, api) {

	$scope.s3Url = 'http://buynbragstores.s3.amazonaws.com/assets/images/stores/';

	$scope.$on('HOMEVIEW', function() {
		$scope.subview = 'home';
		$rootScope.stylesheets = [{href: '/application/views/app/styles/landing.css'}];
	});

	$scope.$on('PEOPLEVIEW', function() {
		$scope.subview = 'people';
	});

	$scope.$on('PRODUCTSVIEW', function() {
		$scope.subview = 'products';
		$rootScope.stylesheets = [{href: '/application/views/app/styles/vendor.css'}, {href: '/application/views/app/styles/main.css'}];
	});

	$scope.$on('STOREVIEW', function() {
		$scope.subview = 'stores';
	});

	api.get('async/checkLogin').then(function(data) {
		var level = data[0] && data[0].isLoggedIN ? data[1][0].rFlowStatus : 0;
		$scope.userDetails = data[1][0] || null;
		
		switch(+level) {
			case 0: $scope.$broadcast('HOMEVIEW');
				break;
			case 1: $scope.$broadcast('PRODUCTSVIEW');
				break;
		}
	});	
	

}])

.directive("xhrSpinner", [function() {

	// var nodeTypes = [1,3];

	// function child(el) {
	// 	for(el = el.firstChild; el && !(nodeTypes.indexOf(el.nodeType) > -1); el = el.nextSibling);
	// 	return el;
	// }

	return {
		restrict: "A",
		link: function(scope, element, attrs) {

			var temp;

			scope.$on("showSpinner", function() {
				if(element[0].firstElementChild) {
					temp = element[0].removeChild(element[0].firstElementChild);
				}
				
				element.addClass("btnActivated");
			});

			scope.$on("hideSpinner", function() {
				element.removeClass("btnActivated");
				element.prepend(temp);
			});

		}
	}
}])