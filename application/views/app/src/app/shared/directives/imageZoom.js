angular.module("directives.imageZoom", [])

.directive("imageZoom", ["$window" ,function($window) {
    return {
        restrict: "A",
        link: function(scope, element, attrs) {

            var imageContainer = element.parent();
            var zoomBox = imageContainer.find(".imagePreviewZoom");
            var zoom = imageContainer.find(".imagePreviewZoom img");
            var box = angular.element("#imagePreviewZoomBox");
            var data = {
                init: false
            };

            element.bind("mouseenter", function(event) {
                var boxWidth = angular.element("#quickViewModal").width()/2;
                var boxHeight = angular.element("#quickViewModal").height();
                var zoomH = (zoom[0].naturalHeight);
                var zoomW = (zoom[0].naturalWidth);
                console.log(zoomH, zoomW, element)

                zoomBox.css("width", boxWidth);
                zoomBox.css("height", boxHeight-10);
                zoomBox.css("left", boxWidth+10);
                zoom.css("height", zoomH);
                zoom.css("width", zoomW);
                showZoom();
                initialize();
                moveBox(event.clientX, event.clientY);
            });

            box.bind("mousemove", function(event) {
                moveBox(event.clientX, event.clientY);
            });

            box.bind("mouseleave", function(event) {
                hideZoom(event.clientX, event.clientY);
            });

            element.bind("mouseleave", function(event) {
                hideZoom(event.clientX, event.clientY);
            });

            element.bind("mousemove", function(event) {
                moveBox(event.clientX, event.clientY);
            });
            angular.element(".productImageThumbsContainer").bind("hover", function(event) {
                hideZoom(event.clientX, event.clientY);
            });

            function hideZoom(mouseX, mouseY) {
                if (!data.init) {
                    return
                }
                var hide = false;
                if (mouseX < data.imageData.minPosition.left || mouseX > data.imageData.maxPosition.left) {
                    hide = true
                } else {
                    if (mouseY < data.imageData.minPosition.top || mouseY > data.imageData.maxPosition.top) {
                        hide = true
                    }
                }
                if (hide) {
                    box.hide().css("left", -1000).css("top", -1000);
                    element.removeClass("active");
                    zoomBox.fadeOut()
                }
            }

            function showZoom() {                
                box.show();
                element.addClass("active");
                zoomBox.stop(true, true);
                zoomBox.fadeIn();                
            }

            function initialize() {
                if (!data.init || data.init) {
                    var imageData = {
                        minPosition: element[0].getBoundingClientRect()
                    };
                    imageData.maxPosition = {
                        left: imageData.minPosition.left + element[0].width,
                        top: imageData.minPosition.top + element[0].height
                    };
                    var zoomData = {
                        minPosition: angular.element(zoom)[0].getBoundingClientRect()
                    };
                    zoomData.maxPosition = {
                        left: zoomData.minPosition.left + zoom[0].naturalWidth,
                        top: zoomData.minPosition.top + zoom[0].naturalHeight
                    };
                    
                    data = {
                        init: true,
                        widthRatio: zoom[0].naturalWidth / element[0].width,
                        heightRatio: zoom[0].naturalHeight / element[0].height,
                        boxSize: 90,
                        boxSized2: 90 / 2,
                        imageData: imageData,
                        zoomData: zoomData
                    }
                    data["constant"] = (data.boxSized2)*(data.widthRatio)+10;
                }
            }

            function moveBox(x, y) {
                var left = (x - data.boxSized2);
                var top = (y - data.boxSized2);
                //console.log(left, top)
                if (top < (data.imageData.minPosition.top)) {
                    top = data.imageData.minPosition.top
                } else {
                    if (top + data.boxSize > (data.imageData.maxPosition.top)) {
                        top = data.imageData.maxPosition.top - data.boxSize
                    }
                }
                if (left <= (data.imageData.minPosition.left)) {
                    left = data.imageData.minPosition.left
                } else {
                    if (left + data.boxSize >= (data.imageData.maxPosition.left)) {
                        left = (data.imageData.maxPosition.left) - data.boxSize
                    }
                }
                // console.log(left, top)
                box.css("left", left).css("top", top);
                moveZoom();
            }

            function moveZoom() {
                var boxOffset = angular.element(box)[0].getBoundingClientRect();
                
                var imageX = (boxOffset.left + data.boxSized2) - data.imageData.minPosition.left;
                var imageY = (boxOffset.top + data.boxSized2) - data.imageData.minPosition.top;
                var zoomX = (-1 * (imageX * data.widthRatio)) + (data.constant);
                var zoomY = (-1 * (imageY * data.heightRatio)) + (data.constant);

                zoom.css("left", zoomX);
                zoom.css("top", zoomY);
                
            }
        }
    }
}]);