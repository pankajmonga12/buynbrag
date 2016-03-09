angular.module('directives.stabiliseHover', ['services.hoverTimestamp'])
.directive('stabiliseHover', [function() {

	var className = 'hoverActive';

	return {
		restrict: 'A',
		link: function(scope, element, attrs) {

			if('ontouchstart' in document.documentElement) {
				element.bind('touchstart', function(event) {
					alert(hoverTimestamp.timestampDiff());
					if(hoverTimestamp.timestampDiff() < 750) {
						element[0].preventDefault();
					}
				});
			}

		}
	}
}])