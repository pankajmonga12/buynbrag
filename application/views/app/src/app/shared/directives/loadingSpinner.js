angular.module("directives.loadingSpinner", [])

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
				if(!attrs.hollow && element[0].firstElementChild) {
					temp = element[0].removeChild(element[0].firstElementChild);
				}
				
				element.addClass("btnActivated");
			});

			scope.$on("hideSpinner", function() {
				element.removeClass("btnActivated");
				!attrs.hollow && element.prepend(temp);
			});

		}
	}
}])