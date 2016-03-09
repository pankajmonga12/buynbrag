angular.module('productPage', ['directives.cart', 'directives.fancy', 'directives.imageZoom', 'fanciedByUsersModal'])

.directive('productPageHandler', ["$filter", '$rootScope', "api", "requestContext", 'user', 'imageService', function($filter, $rootScope, api, requestContext, user, imageService) {

    return {
        restrict: 'A',

        scope: true,

        controller: function($scope, $element) {

            /**************************************************************/
            /********************* Route Specific *************************/
            /**************************************************************/
            var renderContext = requestContext.getRenderContext( "product", "productID" );
            
            $scope.productID = requestContext.getParam("productID");
            $scope.subview = renderContext.getNextSection();

            $scope.$on( "requestContextChanged", function() {

                if ( ! renderContext.isChangeRelevant() ) {
                    return;
                }

                $scope.productID = requestContext.getParam("productID");

                if ( requestContext.hasParamChanged( "productID" ) ) {
                    $scope.hideSpinner = false;
                    $scope.similarProducts.length = 0;
                    cancelFurther = false;
                    page = 0;

                    window.scrollTo(0,0);
                    loadRemoteData();
                }

            });

            /**************************************************************/
            /*********************** Initialize ***************************/
            /**************************************************************/

            window.scrollTo(0,0);
            var page=0,
                cancelFurther = !1,
                productCommentsInitialised = false,
                productImageUrl;
            $scope.busy = !1;
            $scope.hideSpinner = false;
            $scope.productComment = '';
            $scope.productComments = '';
            $scope.similarProducts = [];
            loadRemoteData();

            /**************************************************************/
            /******************** Controller Logic ************************/
            /**************************************************************/

            $scope.loadRemainingData = function() {
                !productCommentsInitialised && loadProductComments();
                productCommentsInitialised = true;
            };

            $scope.checkLogin = function($event) {
                if(!user.getloginstatus()) {
                    $event.preventDefault();
                    $('#loginModal').modal('show');
                }
            };

            $scope.saveComment = function($event) {
                if($event && $event.keyCode === 13) {
                    $event.preventDefault();

                    if(user.getloginstatus()) {

                        if($scope.userComment) {

                            api.post('rapiv1/comments/save', {
                                ctype: 1,
                                comments: $scope.userComment,
                                pid: $scope.productID
                            }).then(function(data) {

                                if(data.result) {
                                    loadProductComments();
                                }

                                //Track on mixpanel
                                _bnbAnalytics.commentSuccess($scope.productID, user.getuser(), $scope.productName, $scope.storeID, $scope.userComment);

                                $scope.userComment = '';
                            });

                        }
                    }
                    else {

                        $('#loginModal').modal('show');

                    }
                }        
                
            };

            $scope.deleteComment = function(cid, userID) {
                if(user.getuser() == userID) {
                    api.get('rapiv1/comments/delete/' + cid).then(function(data) {
                        if(data.result) {
                            loadProductComments();
                        }
                    });
                }
                
            };

            $scope.editComment = function(comment, $event) {
                if($event && $event.keyCode === 13) {
                    $event.preventDefault();
                    comment.toggle = false;
                    if(user.getuser() == comment.userID) {

                        api.post('rapiv1/comments/update/' + comment.commentID, {comments: comment.userComments}).then(function(data) {
                            if(data.result) {
                                loadProductComments();
                            }
                        });
                    }    
                }
                
            };

            $scope.changeProductImage = function(num) {
                imageNum = num;

                $scope.productImage = num === 1
                    ? productImageUrl + 'fancy2.jpg'
                    : productImageUrl + 'img' + num + '_product.jpg';
            };

            $scope.loadSimilarFanciedProducts = function() {
                if(!cancelFurther) {
                    if($scope.busy) return;

                    $scope.busy = !0;
                    api.get('rapiv1/product/fanciedUsersFancies/' + $scope.productID + '/' + page).then(
                        function(data) {
                            if(!data || typeof(data) !== 'object' || (typeof(data) === 'object' && Object.keys(data).length === 0)) {
                                cancelFurther = !0;
                                return;
                            }

                            page++;
                            $scope.similarProducts.push.apply($scope.similarProducts, data);
                            $scope.busy = !1;

                        }, function(error) {

                        }
                    );
                }        
            };

            $scope.showLargerImages = function() {
                imageService.set({
                    'productName' : $scope.productName,
                    'productImage' : productImageUrl,
                    'imageThumbs' : $scope.imageThumbs
                })
            };

            function loadProductComments() {
                api.get('rapiv1/comments/read/' + $scope.productID).then(function(data) {

                    if(data) {
                        if(data.result) {
                           angular.forEach(data.result, function(value, key){

                                value['commentedTime'] = (function() {
                                    var commentTime = +value.commentTime,
                                        timeDiff = Math.ceil(Date.now()/1000 - commentTime);
                                    if(timeDiff < 60) {
                                        return timeDiff>0 ? (timeDiff + ' secs ago') : '1 sec ago';
                                    }
                                    else if(timeDiff < 3600) {
                                        return Math.floor(timeDiff/60) + ' mins ago';
                                    }
                                    else if(timeDiff < 2*86400) {
                                        if(Math.floor(timeDiff/3600) < (new Date()).getHours()) {
                                            return Math.floor(timeDiff/3600) + ' hours ago';
                                        }
                                        else {
                                            return 'Yesterday at ' + $filter('date')(commentTime*1000, 'h:mm a');
                                        }
                                    }
                                    else {
                                        return $filter('date')(commentTime*1000, 'MMM d, yyyy  h:mm a');
                                    }

                                }());
                            });

                            $scope.productComments = data.result; 
                        }
                        else {
                            if($scope.productComments.length === 1) {
                                $scope.productComments.length = 0;
                            }
                        }
                        
                    }


                    
                });
            }

            function loadRemoteData() {

                $scope.productComments.length = 0;
                $scope.usersWhoFancied = [];
                $element.find('.fancyItemImageContainer img')[0].src = '';

                api.get("async/productPageData/" + $scope.productID).then(function(data) {

                    var i, imageURL, variantName,
                        variant="",
                        colorVariants = [],
                        sizeVariants = [],
                        qvdata = data.qvData,
                        moreStoreProducts = data.moreStoreProducts,
                        descriptionHtml = qvdata.productDescription,
                        thumbnails = data.filesExistence,
                        variants = data.variants,
                        descriptionText = (function() {
                            var div = document.createElement("div");
                            var html = descriptionHtml;
                            div.innerHTML = html;

                            return div.textContent || div.innerText || "";
                        })();

                    /***** Get Product Variants *****/
                    if(variants) {

                        angular.forEach(variants, function(val, key) {
                            variantName = val.variantName;
                            variantQuantity = val.variantQuantity;

                            if( variantName && variantName.toUpperCase() === "COLOR" ) {
                                variant = val.variantColor;
                                (variant) && colorVariants.push({"color": variant, "variantQuantity": variantQuantity});
                            }
                            else if( variantName && variantName.toUpperCase() === "SIZE" ) {
                                variant = val.variantSize;
                                (variant) && sizeVariants.push({"size": variant, "variantQuantity": variantQuantity});
                            }
                                                            
                        });

                    }

                    $scope.hideSpinner = !0;

                    $scope.storeID = qvdata.storeID;
                    productImageUrl = api.productImage($scope.storeID, $scope.productID);
                    $scope.productImage = productImageUrl + 'fancy2.jpg';
                    $scope.productName = qvdata.productName;

                    $scope.dynamicSeoContent.title = angular.copy($scope.productName);
                    $scope.dynamicSeoContent.description = descriptionText;
                    $scope.dynamicSeoContent.ogType = 'product';
                    $scope.dynamicSeoContent.image = api.productImage($scope.storeID, $scope.productID) + "img1_240x200.jpg";
                    $scope.dynamicSeoContent.imageType = "image/jpg";
                    $scope.dynamicSeoContent.imageWidth = "240";
                    $scope.dynamicSeoContent.imageHeight = "200";

                    $scope.storeName = qvdata.storeName;
                    $scope.hasFancied = qvdata.hasFancied;
                    $scope.hasBragged = qvdata.hasBragged;
                    $scope.fancyCount = qvdata.productFancyCounter;
                    $scope.bragCount = qvdata.productBragCounter;
                    $scope.viewCount = qvdata.productVisitCounter;
                    $scope.discountAvailable = qvdata.isOnDiscount;
                    $scope.originalPrice = qvdata.productSellingPrice;
                    $scope.discountedPrice = (qvdata.isOnDiscount == 1) ? (qvdata.productSellingPrice - qvdata.productDiscount) : qvdata.productSellingPrice;
                    $scope.productDescription = qvdata.productDescription;
                    $scope.productDescriptionShort = descriptionText.split(".")[0] + ".";
                    $scope.totalQuantity = qvdata.productQuantity;
                    $scope.isCOD = qvdata.storeCODPolicy;
                    $scope.isEMI = qvdata.storeEMIPolicy;
                    $scope.isHappyReturn = qvdata.storeReturnPolicy;
                    $scope.processingTime = (+qvdata.processingTime);
                    $scope.deliveryDate = Date.now() + ($scope.processingTime)*86400000;

                    $scope.colorVariants = (colorVariants.length !== 0) ? colorVariants : null;
                    $scope.selectedColorVariant = $scope.colorVariants ? $scope.colorVariants[0] : null;
                    $scope.sizeVariants = (sizeVariants.length !== 0) ? sizeVariants : null;
                    $scope.selectedSizeVariant = $scope.sizeVariants ? $scope.sizeVariants[0] : null;
                    
                    $scope.moreProducts = moreStoreProducts;

                    $scope.productQuantity = (function() {
                        var i = 1,
                            quantity = [];

                        while(i <= parseInt($scope.totalQuantity)) {
                            quantity.push({"num": i});
                            i++;
                        }

                        return quantity;
                    })();

                    $scope.selectedQuantity = $scope.productQuantity[0];
                    
                    $scope.imageThumbs = (function() {
                        var imageThumbs = [];

                        angular.forEach(thumbnails, function(val, key) {
                            val && imageThumbs.push({"imageURL" : api.productImage($scope.storeID, $scope.productID), "num": (parseInt(key) + 1)});
                        });

                        return imageThumbs;
                    })();

                    for(i=1; i<=5; i++) {
                        var userID = eval("qvdata.userID" + i), 
                            userFBID = eval("qvdata.user" + i + "FBID"), 
                            userGender = eval("qvdata.user" + i + "Gender"),
                            imageURL;

                        if(userID) {
                            imageURL = (userFBID && !isNaN(userFBID)) ? api.userImageFb(userFBID, 75) : api.userImageBnb(userGender);
                            $scope.usersWhoFancied.push({'userID': userID, 'imageURL': imageURL});
                        }
                        
                    }

                });

            }

        },

        link: function(scope, element, attrs, ctrl) {

        }
    }
}])

.factory('imageService', [function() {

    var imageSources;

    return {
        set : function(obj) {
            imageSources = obj;
        },

        get : function() {
            return imageSources;
        }
    }
}])

.directive('productImageZoom', ['imageService', function(imageService) {

    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var imageUrl;

            scope.$on('SHOW', function() {
                var imageSources = imageService.get();
                imageUrl = imageSources.productImage;

                scope.productImage = imageUrl + 'fancy1.jpg';
                scope.productImageThumbs = imageSources.imageThumbs;
                scope.productName = imageSources.productName;
            });

            scope.$on('HIDE', function() {
                scope.productImage = '';
                element.find('.zoomProductImage')[0].src = '';
            });

            scope.changeProductImage = function(num) {
                scope.productImage = +num === 1 ?
                    imageUrl + 'fancy1.jpg' :
                    imageUrl + 'img' + num + '_product.jpg';
            };

        }
    }

}])

.directive("imageSlider", [function() {

    return {
        restrict: "A",
        scope: true,
        link: function(scope, element, attrs) {

            var container = element.find(".imageContainers"),
                imageCount;

            scope.imagesViewed = 5;

            function getImageCount() {
                imageCount = container[0].children.length;
            }

            scope.$watch("imagesViewed", function(count) {
                scope.showPrevious = count > 5 ? true : false;
                scope.showNext = imageCount ? (count < imageCount ? true : false) : true;
            });

            scope.getPrevious = function() {
               var resolution = $(".container").width();
                imageCount || getImageCount();

                if(scope.imagesViewed > 5) {
                    resolution >= 768 ? container.css('left', parseInt(container.css('left')) + 885) : container.css('left', parseInt(container.css('left')) + 675);
                    scope.imagesViewed -= 5;
                } 
            };

            scope.getNext = function() {
                var resolution = $(".container").width();
                imageCount || getImageCount();
                
                if(scope.imagesViewed < imageCount) {
                    resolution >= 768 ? container.css('left', parseInt(container.css('left')) - 885) : container.css('left', parseInt(container.css('left')) - 675);
                    scope.imagesViewed += 5;
                }  
            };

        }

    }

}]);