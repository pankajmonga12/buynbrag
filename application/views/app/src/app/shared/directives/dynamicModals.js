angular.module("dynamicModals", [])

.directive("dynamicModal", ["$http", "$compile", "$templateCache", "$location", function($http, $compile, $templateCache, $location) {
	return {
		restrict: "A",
		scope: true,
		link: function(scope, element, attrs) {

			element.on("show", function() {

				$http.get(attrs.url, {cache: $templateCache}).then(function(data) {
					element.html(data.data);
					$compile(element.contents())(scope);

				});	

			});

			element.on('hidden', function() {
				scope.$$childHead.$destroy();				
			});

		}
	}
}])