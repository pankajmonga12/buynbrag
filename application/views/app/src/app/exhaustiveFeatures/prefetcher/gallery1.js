var gallery = angular.module('gallery', []);

gallery.factory("paginatorFactory", ["api", "$q", "$timeout", "$rootScope", function(api, $q, $timeout, $rootScope) {

    function Paginator(pageSize, prefetching) {
        this.products = [];
        this.cache = {};
        this.duplicates = {};
        this.after = 0;
        this.cancelFurtherRequests = false;
        this.pageSize = pageSize;
        this.enablePrefetching = prefetching;

        this._init();
    }

    Paginator.prototype._init = function() {

        if(this.enablePrefetching) {
            this.imageCache = [];
            this.imagesFailed = {};
            this.previousRequest = '';
            this.currentRequest = '';
            this.busy = false;
            this.first = true;
        }
        
    };

    Paginator.prototype._prefetchImages = function(products) {
        var self = this;
        this.imageCache.length = 0;

        angular.forEach(products, function(product, key) {
            self.imageCache[key] = api.productImage(product.storeID, product.productID) + 'fancy2.jpg';
        });

        loadSequentially();

        function loadSequentially() {
            var imgElem = new Image();

            imgElem.onload = function() {
                loadSequentially();
            };

            imgElem.src = self.imageCache.shift();
        }
  
    };

    Paginator.prototype.retreiveProducts = function(url, requestType, requestParams) {
        var supplying = $q.defer(),
            self = this;

        this.currentRequest = {
            url : url,
            requestType: requestType,
            requestParams: requestParams
        };
        
        if(this.enablePrefetching) {
            console.log('FETCH')
            var fetchFirst = function() {
                self._fetchProducts(self.currentRequest).then(function(products) {
                    supplying.resolve(products);
                    fetchNext();
                });
            };

            //On every run, fire next request and prefetch images
            var fetchNext = function() {
                self.busy = true;
                $timeout(function() {
                    self._fetchProducts(self.currentRequest).then(function(products) {
                        // self._prefetchImages(products);
                    });    
                }, 1000);
            };

            var fireRequests = function() {
                if(self.products.length === 0) {
                    fetchFirst();
                }
                else {
                    $timeout(function() { supplying.resolve(self.products); }, 0);
                    fetchNext();
                }
            };

            if(!angular.equals(self.previousRequest, self.currentRequest)) {
                self.reset();
                fetchFirst();
            }
            else {
                if(!self.busy) {
                    fireRequests();                                     
                }
                else {
                    var wait = window.setInterval(function() {
                        if(!self.busy) {
                            fireRequests();                    
                            window.clearInterval(wait);
                        }
                    }, 200);
                }
            }
            
           
        }
        else {
            this._fetchProducts(self.currentRequest).then(function() {
                supplying.resolve(self.products);
            });
        }       

        return supplying.promise;
    };

    Paginator.prototype._fetchProducts = function(currentRequest) {
        var fetching = $q.defer();

        if(!this.cancelFurtherRequests) {
            var self = this,
            urlBase, postParams;

            if(currentRequest.requestType === 'get') {
                urlBase = currentRequest.url + this.after;
                postParams = null;
            }
            else if(currentRequest.requestType === "post") {
                urlBase = currentRequest.url;
                postParams = currentRequest.requestParams;
            }

            self.previousRequest = currentRequest;

            api[self.currentRequest.requestType](urlBase, postParams).then(
                function(data) {
                    
                    if(!data || typeof(data) !== 'object' || data === 'null') {
                        self.cancelFurtherRequests = true;
                        fetching.reject("noMoreData");
                        return;
                    }

                    self.products.length = 0;

                    var products = data,
                        productId;

                    angular.forEach(products, function(product) {
                        productId = product.productID;

                        //Check if Products are already in Cache, to avoid repeated products
                        if(!self.cache.hasOwnProperty(productId)) {
                            self.products.push(product);
                            self.cache[productId] = product;
                        }
                        else {
                            if(self.duplicates.hasOwnProperty(productId)) {
                                self.duplicates[productId].count = parseInt(self.duplicates[productId].count) + 1;
                            }
                            else {
                                self.duplicates[productId] = {count: 1};
                            }
                        }
                    });

                    fetching.resolve(self.products);
                    self.after += 1;
                    self.busy = false;
                },
                function(data){
                    if(data.status == 500) {
                        self.busy = false;
                    }
                });        
        }  

        return fetching.promise;
    };

    Paginator.prototype.reset = function() {
        this.previousRequest = '';
        //this.products.length = 0;
        this.cache = {};
        this.after = 0;
        this.cancelFurtherRequests = false;
        this.busy= false;
    };

    //Return public API
    return Paginator;

}]);

gallery.directive('requestTrigger', ["$window", function($window) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var triggerAreaSize = 50,
                body = document.body,
                html = document.documentElement,
                previousPosition = '',
                scrollTop, docHeight, winHeight, body, html;

            if(element.height() == 0) {
                scope.$eval(attrs.requestTrigger);
            }

            scope.$watch(function() {
                return element.height();
            }, function(elemHeight) {
                if(elemHeight === 0) {
                    previousPosition = 0;
                }
            })

            angular.element($window).bind('scroll', function () {
                scrollTop = window.scrollY;
                docHeight = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
                winHeight = window.innerHeight;

               if (scrollTop >= docHeight - winHeight - triggerAreaSize) {
                  //Add something at the end of the page

                  if(!previousPosition) {
                    previousPosition = docHeight;
                    scope.$eval(attrs.requestTrigger);
                  }
                  else {
                    currentPosition = docHeight;
                    //Prevent firing multiple requests on scroll by checking that current position is not in previous fire area. 
                    if(currentPosition > (previousPosition + triggerAreaSize)) {
                        scope.$eval(attrs.requestTrigger);
                        previousPosition = currentPosition;                        
                    }
                    
                  }
                  
               }
            }); 
        }
    }
}]);

gallery.directive('infiniteScroll', [
  '$rootScope', '$window', '$timeout', 'eventThrottler', function($rootScope, $window, $timeout, eventThrottler) {
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

          var elementBottom, remaining, shouldScroll, windowBottom;
          windowBottom = $window.height() + $window.scrollTop();
          elementBottom = elem.offset().top + elem.height();
          remaining = elementBottom - windowBottom;
          shouldScroll = remaining <= $window.height() * scrollDistance;
          if (shouldScroll && scrollEnabled) {
            if ($rootScope.$$phase) {
              return scope.$eval(attrs.infiniteScroll);
            } else {
              return scope.$apply(attrs.infiniteScroll);
            }
          } else if (shouldScroll) {
            return checkWhenEnabled = true;
          }
        };
        
        $window.bind('scroll', eventThrottler.debounce(handler, 300));

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
  }
])

