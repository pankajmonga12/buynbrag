angular.module('dmClick', [])

.factory('hoverTimestamp', [function() {
    var timestamp;

    return {
        generateTimestamp: function() {
            timestamp = Date.now();
        },
        timestampDiff: function() {
            return Date.now() - timestamp;
        }
    }
}])

.directive('dmClick', ["$parse", 'hoverTimestamp', function($parse, hoverTimestamp) {

    return {
        restrict: "A",
        link: function(scope, element, attrs) {

            var startX, startY, startTime, tapElement,
                tapping = false,
                className = 'hoverActive',
                fn = attrs.dmClick ? $parse(attrs.dmClick) : null;

            if('ontouchstart' in document.documentElement) {
                var hiddenContainer = false;

                element.bind('touchstart', function(event) {

                    //If element is hidden container and is already Active, return
                    if(element.hasClass('fancyItem') && element.hasClass(className)) {
                        event.stopPropagation();
                        return;
                    }
                    
                    if(!element.hasClass('fancyItem')) {
                        //Get reference to hidden container element
                        var elemRef = element;

                        while(!(elemRef.parent().hasClass('fancyItem'))) {
                            elemRef = elemRef.parent();
                        }

                        hiddenContainer = elemRef.parent();
                    }

                    //If children are clicked and hiddenContainer is not active yet, return
                    // NOT WORKING
                    if(hiddenContainer && !(hiddenContainer.hasClass(className))) {
                        event.preventDefault();
                        //alert('prevented')
                        return;
                    }

                    tapping = true;
                    tapElement = event.target ? event.target : event.srcElement;
                    startTime = Date.now();

                    var touches = event.touches && event.touches.length ? event.touches : [event];
                    var e = touches[0].originalEvent || touches[0];
                    
                    startX = e.clientX;
                    startY = e.clientY;
                });

                element.bind('touchmove', function(event) {
                    tapping = false;
                });

                element.bind('touchend', function(event) {
                    
                    var touches = (event.changedTouches && event.changedTouches.length) ? event.changedTouches :
                        ((event.touches && event.touches.length) ? event.touches : [event]),
                        e = touches[0].originalEvent || touches[0],
                        stopX = e.clientX,
                        stopY = e.clientY,
                        stopTime = Date.now(),
                        distValid = (stopX - startX > 10 || stopY - startY > 10) ? false : true,
                        timeValid = (stopTime - startTime > 750) ? false : true;

                    if(tapping && distValid && timeValid) {
                        if(tapElement) {
                            //If tap event
                            element.addClass('hoverActive');

                            //Add hover timestamp
                            hoverTimestamp.generateTimestamp();

                            fn && scope.$apply(function() {
                                fn(scope, {$event: event});
                            });
                        }
                    }
                    tapping = false;
                });
            }
            else {
                if(!fn && element.hasClass('fancyItem')) {
                    element.bind('mouseenter', function() {
                        !(element.hasClass(className)) && element.addClass(className);
                    });

                    element.bind('mouseleave', function() {
                        element.hasClass(className) && element.removeClass(className);
                    });
                }
                else {
                    element.bind('click', function(event) {
                        fn && scope.$apply(function() {
                            fn(scope, {$event: event});
                        }); 
                    });
                }
            }
        }
    }
}])