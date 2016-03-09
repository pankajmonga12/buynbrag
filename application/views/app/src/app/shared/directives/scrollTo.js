angular.module('directives.scrollTo', []).directive("scrollTo", ["$anchorScroll", "$location", function($anchorScroll, $location) {
    return {
        restrict : "A",
        scope: {
            hash: "@"
        },
        link: function(scope, element, attrs) {

            element.bind("click", function() {
                element.parent().parent().children().removeClass("active");
                element.parent().addClass("active");
                $location.hash(scope.hash);
                $anchorScroll();
            });

        }
    }
}]);