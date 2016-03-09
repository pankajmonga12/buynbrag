angular.module('directives.masonryLayout', [])

.factory('masonryService', ['$window', function($window) {

	//disable hover on scroll
	(function() {
		// Used to track the enabling of hover effects
		var enableTimer = 0,
			className = 'scrollingActive';

		window.addEventListener('scroll', function() {
		  clearTimeout(enableTimer);
		  removeHoverClass();

		  // enable after 1 second, choose your own value here!
		  enableTimer = setTimeout(addHoverClass, 1000);
		}, false);

		function removeHoverClass() {
		  document.body.classList.remove(className);
		}

		function addHoverClass() {
		  document.body.classList.add(className);
		}
	}());

	var MIN_IMG_WIDTH = 323,
		MARGIN = 25,
		GAP = 25,
		windowWidth = $window.innerWidth,
		containerWidth, columns, dynamicImageWidth, maginWidth, containers, i, n;

	resetDimensions();
	initColumnHeight();

	function resetDimensions() {

		document.body.style.overflow = 'scroll';

		containerWidth = document.body.getBoundingClientRect().width;

		document.body.style.overflow = 'auto';
		columns = Math.floor(containerWidth/(MIN_IMG_WIDTH + MARGIN));
		dynamicImageWidth = MIN_IMG_WIDTH;

		marginWidth = (containerWidth - (dynamicImageWidth*columns + MARGIN*(columns - 1)))/2 - 20; //20 is pagging-left
		
		containers = new Array(columns);
	}

	function initColumnHeight() {
		for(i=0, n=containers.length; i < n; i++) {
			containers[i] = 0;
		}
	}

	function getShortestColumn() {
		return containers.indexOf(containers.slice().sort(function(a, b) {
			return a - b;
		})[0]);
	}

	function getLargestColumnHeight() {
		return containers.slice().sort(function(a, b) {
			return b-a;
		})[0];
	}

	function getDimensions() {
		return {
			containers: containers,
			imgWidth: dynamicImageWidth,
			marginWidth: marginWidth
		}
	}

	function getStatics() {
		return {
			margin: MARGIN,
			gap: GAP,
			windowWidth: windowWidth
		}
	}

	function updateColumnHeight(column, height) {
		containers[column] += height;
	}

	function shouldResize() {
		return Math.abs(windowWidth - $window.innerWidth) > 50 ? true : false;
	}

	function setWindowWidth() {
		windowWidth = $window.innerWidth;
	}

	//Expose API
	return {
		shortest: getShortestColumn,
		tallest: getLargestColumnHeight,
		dimensions: getDimensions,
		statics: getStatics,
		update: updateColumnHeight,
		reset: resetDimensions,
		init: initColumnHeight,
		shouldResize: shouldResize,
		setWindowWidth: setWindowWidth
	}


}])

.directive('masonryLayout', ['$window', '$rootScope', 'masonryService', function($window, $rootScope, masonryService) {
	var imgFancy2 = 'fancy2',
		imgFancy3 = 'fancy3',
		statics = masonryService.statics(),
		vMargin = statics.gap,
		hMargin = statics.margin,
		pageHeightSet = !1,
		midContainer, parentContainer, containerHeight,	pageHeight;

	function setContainerHeight(elem, height, simplySet) {
		if(simplySet) {
			containerHeight = height;
		}
		else {
			containerHeight += height;
		}
		
		elem[0].style.height = containerHeight + 'px';
	}

	function init() {
		containerHeight = 0;
		midContainer = angular.element('#midSection');
		parentContainer = angular.element('.fanciedProductsContainer');
	}

	return {
		restrict: 'A',
		priority: 1000,
		link: function(scope, element, attrs) {
			if($rootScope.deviceType == 'touch') {
				scope.imageType = imgFancy2;
				return;
			}
			else {
				scope.imageType = imgFancy3;
			}

			var dimensions = masonryService.dimensions(),
				tallestColumn, homeColumn,
				img = element.find('.fancyItemImageContainer img'),
				newLeft, newTop, newWidth;

			//Hide containers untill loaded
			element[0].style.opacity = '0';				

			img.bind('load', repaint);	

			//Update parent container height to control infinite page scrolling
			if(scope.$index === 0) {
				init();
			}

			if(scope.$index === 49 && !pageHeightSet) {
				img.bind('load', function() {
					pageHeight = masonryService.tallest();
					console.log('pageHeight', pageHeight);
					pageHeightSet = !0;
				});
			} 		

			if(scope.$last) {
				if(!pageHeightSet) {
						setContainerHeight(parentContainer, $window.innerHeight * 3, !1);
				}
				else {
					setContainerHeight(parentContainer, pageHeight, !1);
				}				

				//Correct the difference between last element and container height
				img.bind('load', function() {
					setContainerHeight(parentContainer, masonryService.tallest(), !0);
				});
			}	

			//Set item position
			function repaint() {
				homeColumn = masonryService.shortest();				
				tallestColumn = masonryService.tallest();
				newLeft = homeColumn*(dimensions.imgWidth + hMargin) + dimensions.marginWidth;
				newTop = dimensions.containers[homeColumn];
				// newWidth = dimensions.imgWidth;

				masonryService.update(homeColumn, element[0].scrollHeight + vMargin);
				
				element[0].style.cssText += "; opacity: 1; left: " + newLeft + "px; top: " + newTop + "px;";

				
			}

			//Switch Layouts
			scope.$on('CLASSIC', function() {
				element.width('');
				//parentContainer.height('');
				scope.imageType = imgFancy3;
				if(midContainer.hasClass('container-fluid fluidHomePage')) {
					midContainer.removeClass('container-fluid fluidHomePage');
					midContainer.addClass('container classicHomePage');
				}

			});	

		}
	}
}])

.directive('masonryResize', ['$window', '$rootScope', 'masonryService', function($window, $rootScope, masonryService) {

	var resizing = false,
		statics, vMargin, hMargin;

	getStatics();		

	function getStatics() {
		statics = masonryService.statics();
		vMargin = statics.gap;
		hMargin = statics.margin;
	}

	return {
		restrict: 'A',
		link: function(scope, element, attrs, controller) {
			if($rootScope.deviceType == 'touch') return;

			var midContainer = $('#midSection'),
				switchingLayout = false,
				imageContainers, container, dimensions, homeColumn, tallestColumn, newLeft, newTop, newWidth;

			scope.$watch('products.length', function(newCount, oldCount) {
				var newImages;
				
				if(newCount === 0) {
					element.height(0);
					masonryService.init();
				}

			});

			scope.$on('MASONRY', function() {
				if(midContainer.hasClass('container classicHomePage')) {
					element.height(0);
					masonryService.init();
					getStatics();
					switchingLayout = true;
					midContainer.removeClass('container classicHomePage');
					midContainer.addClass('container-fluid fluidHomePage');
					// scope.imageType = imgFancy3;
					repaint();
					switchingLayout = false;

				}
			});	

			angular.element($window).bind('resize', repaint);

			//Remove resize listener from window when view is changed
			scope.$on('$destroy', function() {
				resizing = false;
				angular.element($window).off('resize');
			});

			function repaint() {
				if((masonryService.shouldResize() || switchingLayout) && !resizing) {
					console.log('START RESIZING')
					resizing = true;
					masonryService.setWindowWidth();

					//Get new viewPort dimensions
					masonryService.reset();
					masonryService.init();
					dimensions = masonryService.dimensions();

					imageContainers = element.find('.imageRepetition');

					for(i=0, n=imageContainers.length; i<n; i++) {
						homeColumn = masonryService.shortest();
						container = angular.element(imageContainers[i]);
						newLeft = homeColumn*(dimensions.imgWidth + hMargin) + dimensions.marginWidth;
						newTop = dimensions.containers[homeColumn];
						// newWidth = dimensions.imgWidth;

						container[0].style.cssText += "; opacity: 1; left: " + newLeft + "px; top: " + newTop + "px;";
						masonryService.update(homeColumn, container.height() + vMargin);

					}

					element.height(masonryService.tallest());
					resizing = false;

					console.log('STOP RESIZING')
				}
			}

		}
	}
}])

.directive('layoutSwitcher', [function() {

	var activeClass = 'current';

	return {
		restrict: 'E',
		template: '<div class="layoutSwitchContainer">Switch layout' + 
					'<i class="classicSwitch {{classicActive}}" ng-click="switchLayout(layouts.classic)">' + 
//						'<span class="tooltips top invisible cssTransitionSlow">Classic layout</span>' +
					'</i>' + 
					'<i class="masonrySwitch {{masonryActive}}" ng-click="switchLayout(layouts.masonry)">' + 
//						'<span class="tooltips top invisible cssTransitionSlow">Free layout</span>' +
					'</i>' + 
				'</div>',
		controller: function($scope) {

			$scope.layouts = {
				classic: 0,
				masonry: 1
			};

			$scope.classicActive = '';
			$scope.masonryActive = activeClass;

			$scope.switchLayout = function(layout) {

				switch(layout) {
					case 0: $scope.$broadcast('CLASSIC');
							$scope.masonryActive = '';
							$scope.classicActive = activeClass;
						break;
					case 1: $scope.$broadcast('MASONRY');
							$scope.classicActive = '';
							$scope.masonryActive = activeClass;
						break;
				}
			};
		},
		link: function(scope, element, attrs) {

		}
	}
}])