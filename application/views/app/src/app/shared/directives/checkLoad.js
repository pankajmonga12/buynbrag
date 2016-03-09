angular.module('directives.checkLoad', []).directive("checkLoad", [function() {
    return {
        restrict: "A",
        link: function(scope, element, attrs) {

            element.bind("load", function() {

                scope.$apply(function() {

                    scope.$eval(attrs.checkLoad);

                });

            });

        }
    }
}]);