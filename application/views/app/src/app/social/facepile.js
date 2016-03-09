angular.module('facepile', [])

.directive('facepile', ['$document', function($document) {

	return {
		restrict: 'E',
		template: '<div class="fb-facepile" data-href="https://www.facebook.com/Buynbrag" data-size="large" data-colorscheme="light" data-width="{{containerWidth}}" data-max-rows="1"></div>',
		link: function(scope, element, attrs) {

			scope.containerWidth = document.getElementById('midSection').clientWidth;

		}
	}
}])