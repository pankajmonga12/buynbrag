angular.module('gallery', ['services.eventThrottler'])

.factory("paginatorFactory", ["api", "$q", "$timeout", "$rootScope", "$window", "user", "$document",
    function(api, $q, $timeout, $rootScope, $window, user, $document) {

        function forceLogin() {

            var view = document.getElementById("midSection"),
                loginTemplate = '<div class="forceLoginContainer"><div class="btnForceLogin text-center"><span class="forceLoginBtnWrapper"><a href="#loginModal" data-toggle="modal" role="button" class="btn btn-blue">Login to discover more</a></span>' +
                    '</div></div>';

            if (view) {
                view = angular.element(view);
                !view.find(".btnForceLogin").length && view.append(loginTemplate);
                view.find(".spinner") && view.find(".spinner").remove();
            }
        }

        function Duplicates() {
            this.length = 0;
            this.totalDuplicacyCount = 0;
        }

        function Paginator(pageSize, prefetching, imageParams) {
            //Stores item count for 1 page
            this.pageSize = pageSize;

            //Boolean(use images prefetching or not)
            this.prefetching = false;

            //Stores Product IDs across all requests of similar type and checks for duplicacy
            this.cache = [];

            //Store duplicate results and print them to console
            this.duplicates = new Duplicates();

            //Stores prefetched data to be returned
            this.buffer = {
                request: '',
                data: ''
            };

            //Stores page no.
            this.after = 0;

            //Tells if no more pages left for currrent request
            this.cancelFurtherRequests = false;

            //Tells if fetcher is busy
            this.busy = false;

            //Used to conditionally block further requests
            this.blockMore = false;

            //Parameters used to create image URLs
            this.imgParams = imageParams;

            this.previousRequest = '';
        }

        Paginator.prototype = {
            constructor: Paginator,

            prefetchImages: function(results) {

                var n = results.length,
                    allImagesLoaded = $q.defer(),
                    imageSources = new Array(n),
                    loaded = 0,
                    product, i, count=0;

                for (i = 0; i < n; i++) {
                    product = results[i];
                    imageSources[i] = api.productImage(product[this.imgParams[0]] || this.imgParams[0], product[this.imgParams[1]]) + this.imgParams[2];
                }

                loadSequentially();

                function loadSequentially() {
                    var imgElem = new Image(),
                        source = '';

                    imgElem.onload = function() {
                        if(++count === n) {
                            $timeout(function() { allImagesLoaded.resolve(); }, 0);
                        }
                        else {
                            loadSequentially();
                        }                        
                    };

                    imgElem.onerror = function() {
                         console.log(n, ' loaded')
                        if(++count === n) {
                            $timeout(function() { allImagesLoaded.resolve(); }, 0);
                        }
                        else {
                            loadSequentially();
                        }  
                    };

                    source = imageSources.shift();
                    if(source) {
                        imgElem.src = source;
                    }
                }

                return allImagesLoaded.promise;

            },

            retreiveProducts: function(url, requestType, requestParams) {

                var supplying = $q.defer(),
                    self = this,
                    urlBase, postParams;

                //Make a request object
                var currentRequest = {
                    url: url,
                    requestType: requestType,
                    requestParams: requestParams
                };

                //If conesecutive requests are different i.e belong to different views, reset the Paginator data
                !angular.equals(currentRequest, this.previousRequest) && this._reset();

                //If user is not logged in, ask them to login after 2 pages.
                if ((this.after === 2) && !user.getloginstatus() && !this.blockMore) {
                    this.blockMore = true;
                    forceLogin();
                }

                //If buffer has data, resolve the promise immediately, else wait for the data to be available, then resolve
                if (angular.equals(this.buffer.request, currentRequest)) {
                    $timeout(function() {
                        self.cancelFurtherRequests ? supplying.reject('noMoreData') : supplying.resolve(self.buffer.data);
                        self._clearBuffer();
                    }, 0);

                    $timeout(function() { fetchNext(); }, 2000);

                } else {
                    this.fetchProducts(currentRequest).then(function(data) {
                        supplying.resolve(data);
                        self._clearBuffer();                        

                        if($document[0].readyState !== 'complete') {

                            angular.element($window).on('load', function() { fetchNext(); });

                        }
                        else {
                            fetchNext();
                        }

                    }, function(error) {
                        self.cancelFurtherRequests && supplying.reject('noMoreData');
                    });
                }

                function fetchNext() {
                    self.fetchProducts(currentRequest).then(function(data) {
                        self.prefetching && self.prefetchImages(data);
                    });
                }

                return supplying.promise;

            },

            fetchProducts: function(request) {
                var fetching = $q.defer(),
                    url = request.url,
                    requestType = request.requestType,
                    requestParams = request.requestParams,
                    self = this,
                    urlBase, postParams;


                if (this.busy || this.cancelFurtherRequests || this.blockMore) {
                    fetching.reject('Fetcher is busy');
                } 
                else {
                    this.busy = true;

                    //Modify URL to include page number for infinite scrolling
                    if (requestType === 'get') {
                        //Modify trends page URL for infinite scrolling
                        if (url && (typeof url === "string") && (url.indexOf("trends") !== -1) && (url.indexOf("?city2") !== -1)) {
                            urlBase = (function() {
                                var splitUrl = url.split("?");
                                return splitUrl[0] + self.after + '/' + self.pageSize + "?" + splitUrl[1];
                            })();
                        } else {
                            urlBase = url + self.after + '/' + self.pageSize;
                        }

                        postParams = null;
                    } 
                    else if (requestType === "post") {
                        urlBase = url;
                        postParams = angular.copy(requestParams);
                        postParams.startFrom = this.after;
                        postParams.maxResults = this.pageSize;
                    }

                    this.previousRequest = request;

                    api[requestType](urlBase, postParams).then(
                        function(data) {

                            if (!data || typeof(data) !== 'object' || data === 'null') {
                                self.cancelFurtherRequests = true;
                                fetching.reject("noMoreData");
                                self.busy = false;
                                return;
                            }

                            var products = data,
                                results = [],
                                productId, check;

                            angular.forEach(products, function(product) {

                                if(typeof product.productID !== 'undefined') {
                                    productId = product.productID;

                                    //Check if Products are already in Cache, to avoid repeated products
                                    // if ((typeof product.userFullName !== 'undefined') ? ((self.cache.indexOf(productId) < 0) && product.userFullName) : (self.cache.indexOf(productId) < 0)) {
                                    //     results.push(product);
                                    //     self.cache.push(productId);
                                    // }

                                    if(self.cache.indexOf(productId) < 0) {
                                        //Product not in cache
                                        results.push(product);
                                        self.cache.push(productId);
                                    }
                                    else {
                                        //Duplicate product
                                        if(!self.duplicates[productId]) {
                                            self.duplicates[productId] = {
                                                duplicacyCount : 0,
                                                details : product
                                            };

                                            self.duplicates.length++;
                                        }

                                        self.duplicates[productId].duplicacyCount++;
                                        self.duplicates.totalDuplicacyCount++;
                                    }

                                }
                                else {

                                    results.push(product);

                                }

                            });

                            //Log duplicate products
                            self.duplicates.length > 0 && console.log('Duplicate Products --->  ', self.duplicates);

                            self.buffer.request = request;
                            self.buffer.data = results;
                            fetching.resolve(results);
                            self.after += 1;
                            self.busy = false;
                        },
                        function(data) {
                            self.busy = false;
                        }
                    );
                }


                return fetching.promise;
            },

            reset: function() {
                this._reset();
                this._clearBuffer();
            },

            _clearBuffer: function() {
                this.buffer.request = '';
                this.buffer.data = '';
            },

            _reset: function() {
                this.cache.length = 0;
                this.duplicates = new Duplicates();
                this.after = 0;
                this.cancelFurtherRequests = false;
                this.busy = false;
                this.blockMore = false;
            }
        };

        return Paginator;
    }
])

.directive('infiniteScroll', ['$rootScope', '$window', '$timeout', function($rootScope, $window, $timeout) {

    var lastScrollTime = 0;

    return {
        restrict: 'A',
        link: function(scope, elem, attrs) {
            var checkWhenEnabled, handler, scrollDistance, scrollEnabled;
            $window = angular.element($window);
            scrollDistance = 0;
            if (attrs.infiniteScrollDistance != null) {
                scope.$watch(attrs.infiniteScrollDistance, function(value) {
                    return scrollDistance = parseInt(value, 10);
                });
            }
            scrollEnabled = true;
            checkWhenEnabled = false;
            if (attrs.infiniteScrollDisabled != null) {
                scope.$watch(attrs.infiniteScrollDisabled, function(value) {
                    scrollEnabled = !value;
                    if (scrollEnabled && checkWhenEnabled) {
                        checkWhenEnabled = false;
                        return handler();
                    }
                });
            }
            handler = function() {
                if(Date.now() - lastScrollTime < 500) return;

                var elementBottom, remaining, shouldScroll, windowBottom;
                windowBottom = $window.height() + $window.scrollTop();
                elementBottom = elem.offset().top + elem.height();
                remaining = elementBottom - windowBottom;
                shouldScroll = remaining <= $window.height() * scrollDistance;
                if (shouldScroll && scrollEnabled) {
                    lastScrollTime = Date.now();
                    if ($rootScope.$$phase) {
                        return scope.$eval(attrs.infiniteScroll);
                    } else {
                        return scope.$apply(attrs.infiniteScroll);
                    }
                } else if (shouldScroll) {
                    return checkWhenEnabled = true;
                }
            };

            $window.bind('scroll', handler);

            scope.$on('$destroy', function() {
                return $window.unbind('scroll', handler);
            });
            return $timeout((function() {
                if (attrs.infiniteScrollImmediateCheck) {
                    if (scope.$eval(attrs.infiniteScrollImmediateCheck)) {
                        return handler();
                    }
                } else {
                    return handler();
                }
            }), 0);
        }
    };
}])

.directive('elementScroll', [function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var raw = element[0];

            element.bind('scroll', function() {
                if (raw.scrollTop + raw.offsetHeight + 100 >= raw.scrollHeight) {
                    scope.$apply(attrs.elementScroll);
                }
            });

        }
    }
}])

// .directive('eternalTrigger', ["$window", "$rootScope", function($window, $rootScope) {
//     return {
//         restrict: 'A',
//         link: function(scope, element, attrs) {
//             var triggerAreaSize = parseInt(attrs.area, 10),
//                 body = document.body,
//                 html = document.documentElement,
//                 previousPosition = '',
//                 scrollTop, docHeight, winHeight, body, html, trigger, wait;

//             scope.$watch(
//                 function() {
//                     return element[0].offsetHeight;
//                 }, function(val) {
//                     if(val === 0) {
//                         previousPosition = 0;
//                         angular.element($window).trigger('scroll');
//                     };
//                 });

//             trigger = function() {
//                 scrollTop = window.scrollY;
//                 docHeight = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
//                 winHeight = window.innerHeight;

//                if (scrollTop >= docHeight - winHeight - triggerAreaSize) {
//                   //Add something at the end of the page
//                   safeApply(attrs.eternalTrigger);

//                }
//             };

//             angular.element($window).bind('scroll', trigger);

//             scope.$on('$destroy', function() {
//                 angular.element($window).unbind('scroll', trigger);
//             });

//             function safeApply(fn) {
//                 $rootScope.$$phase ? scope.$eval(fn) : scope.$apply(fn);
//             }

//         }
//     }
// }]);

.directive("resizeImage", ["$window",
    function($window) {
        return {
            restrict: "A",
            link: function(scope, element, attrs) {

                var aHeight, bHeight, sibling, siblingContainer, siblingImage;

                scope.$on('CLASSIC', triggerResize);

                element.find("img").bind("load", triggerResize);

                function triggerResize() {
                    if ($("body").width() >= 768) {
                        scope.$index % 2 === 0 ? resizeNext() : resizePrevious();
                    }
                }

                function resizePrevious() {
                    sibling = angular.element(element.parent().parent().parent().parent().parent())[0].previousElementSibling;
                    siblingContainer = angular.element(angular.element(sibling).find(".fancyItemImageContainer"));

                    if (sibling && siblingContainer) {
                        siblingImage = siblingContainer.find("img");
                        aHeight = siblingContainer[0].clientHeight;
                        bHeight = element[0].clientHeight;

                        if ((siblingImage[0].complete) && (aHeight !== bHeight)) {
                            resize(siblingContainer, element, aHeight, bHeight);
                        }

                    }
                }

                function resizeNext() {
                    sibling = angular.element(element.parent().parent().parent().parent().parent())[0].nextElementSibling;
                    siblingContainer = angular.element(angular.element(sibling).find(".fancyItemImageContainer"));

                    if (sibling && siblingContainer) {
                        siblingImage = siblingContainer.find("img");
                        aHeight = element[0].clientHeight;
                        bHeight = siblingContainer[0].clientHeight;

                        if ((siblingImage[0].complete) && (aHeight !== bHeight)) {
                            resize(element, siblingContainer, aHeight, bHeight);
                        }

                    }
                }

                function resize(el1, el2, h1, h2) {
                    if (h1 > h2) {
                        el2[0].style.height = h1 + 'px';
                    } else if (h2 > h1) {
                        el1[0].style.height = h2 + 'px';
                    }
                }

            }
        }
    }
])
