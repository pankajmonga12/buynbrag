angular.module("directives.sexyOverlay", [])

.directive('sexyOverlay', [function() {

	return {
		restrict: 'A',
		scope: true,
		link: function(scope, element, attrs) {

			element.addClass('ng-hide');

			scope.$on(attrs.id, function() {
				element.removeClass('ng-hide');
				element.addClass('overlayModal');
				scope.$broadcast('SHOW');
			});

			scope.$on('CLOSEMODAL', function() {
				if(!element.hasClass('ng-hide')) {
					element.addClass('ng-hide');
					scope.$broadcast('HIDE');
				}
			});

		}
	}

}])

.directive('overlay', ['$rootScope', function($rootScope) {

	return {
		restrict: 'E',
		template: '<div id="overlay" class="overlay"></div>',
		link: function(scope, element, attrs) {

			element.on('click', function($event) {
				$rootScope.$broadcast('CLOSEMODAL');	
				element.remove();
			});

		}
	}
}])

.directive('olink', ['$rootScope', '$compile', '$timeout', function($rootScope, $compile, $timeout) {

	return {
		restrict: 'A',
		scope: {},
		link: function(scope, element, attrs) {

			element.on('click', function($event) {
				if(attrs.olink) {
					$('body').append($compile('<overlay></overlay>')($rootScope.$new()));

					$timeout(function() {
						$rootScope.$broadcast(attrs.olink);
						$rootScope.$apply();	
					}, 100);
					
				}
			});

		}
	}

}])