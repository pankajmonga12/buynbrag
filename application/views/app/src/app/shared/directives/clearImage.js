angular.module('directives.clearImage', [])

.directive("clearImage", [function() {
    return {
        restrict: "A",
        link: function(scope, element, attrs) {

            scope.$on('clearImage', function() {
            	element[0].src = '';
            }); 

        }
    }
}]);