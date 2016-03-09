angular.module('search', ['directives.fancy'])

.controller('SearchController', ['$scope', '$location', '$rootScope', 'api', 'requestContext', function($scope, $location, $rootScope, api, requestContext) {
    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "search", ["searchKey"] );
    $scope.searchKey = requestContext.getParam("searchKey");
    $scope.rawSearchKey = $scope.searchKey.split('-').join(' ');
    $scope.subview = renderContext.getNextSection();
    
    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }
        
        $scope.searchKey = requestContext.getParam("searchKey");
        $scope.rawSearchKey = $scope.searchKey.split('-').join(' ');

        if ( requestContext.hasParamChanged( "searchKey" ) ) {
            searchThis();
        }

        $scope.subview = renderContext.getNextSection();

    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/
    $scope.urlParams = {
        products: 'search/results/',
        stores: 'search/storeResult/',
        users: 'search/userResult/',
        count: 'search/resultsCount/'
    };

    $scope.resultsCount = {
        products: '',
        stores: '',
        users: ''
    };

    var newSearch = !0;

    $scope.productsVault = [];
    $scope.storesVault = [];
    $scope.usersVault = [];

    $scope.midSectionClass = $scope.subview === 'products' && $rootScope.deviceType == 'nonTouch'
        ? "searchPage container-fluid fluidHomePage cssTransitionSlow"
        : "searchPage container cssTransitionSlow";

    searchThis();

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/
    function getResults() {
        if(newSearch) {
            api.get($scope.urlParams.count + $scope.rawSearchKey).then(
                function(data) {
                    var pc = data.productsCount || 0,
                        sc = data.storesCount || 0,
                        uc = data.usersCount || 0;

                    if(pc === 0) {
                        if(sc === 0) {
                            if(uc !== 0) {
                                $location.path('search/people/' + $scope.searchKey).replace();
                            }
                        }
                        else {
                            $location.path('search/stores/' + $scope.searchKey).replace();
                        }
                    }

                    $scope.resultsCount = {
                        products: (!isNaN(pc) && pc>0) ? pc : 0 ,
                        stores: (!isNaN(sc) && sc>0) ? sc : 0,
                        users: (!isNaN(uc) && uc>0) ? uc : 0
                    };

                }, function(error) {

                }
            );
        }
    };

    function searchThis() {
        $scope.productsVault.length = 0;
        $scope.storesVault.length = 0;
        $scope.usersVault.length = 0;
        $scope.resultsCount.products = '';
        $scope.resultsCount.stores = '';
        $scope.resultsCount.users = '';
        newSearch = !0;
        getResults();
    }
}])

.controller('SearchProductsController', ['$scope', '$rootScope', 'api', 'requestContext', function($scope, $rootScope, api, requestContext) {
    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "search.products", ["searchKey"] );
    $scope.subview = renderContext.getNextSection();
    
    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }

        if ( requestContext.hasParamChanged( "searchKey" ) ) {
            refreshData();
        }

    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/
    var pages = 0,
        page = 0,
        pageSize = 20,
        noMoreData = !1,
        pageData;

    $scope.products = [];
    $scope.hideSpinner = !1;
    $scope.noResults = !1;

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/
    
    $scope.getProducts = function() {
        console.log('Firing request')

        if(Object.keys($scope.productsVault).length !== 0) {
            if(!noMoreData) {

                $scope.hideSpinner = !0;
                pageData = $scope.productsVault.slice(page*pageSize, (page+1)*pageSize - 1);  
                $scope.products.push.apply($scope.products, pageData);

                if(++page === pages) {
                    noMoreData = !0;
                }    
            }            

        }
        else {
            api.get($scope.urlParams.products + $scope.rawSearchKey).then(
                function(data) {

                    if(!data || typeof(data) !== 'object' || (typeof(data) === 'object' && Object.keys(data).length===0)) {
                        $scope.hideSpinner = !0;
                        noMoreData = !0;
                        $scope.noResults = !0;
                        return;
                    }

                    $scope.hideSpinner = !0;
                    $scope.productsVault.length = 0;

                    angular.forEach(data, function(product){
                        product["src"] = api.productImage(product.storeID, product.productID);
                        product["discountedPrice"] = (product.productIsOnDiscount == 1) ? (product.productSellingPrice - product.productDiscount) : product.productSellingPrice;
                        $scope.productsVault.push(product);
                    });

                    pages = Math.ceil($scope.productsVault.length/pageSize);
                    pageData = $scope.productsVault.slice(page*pageSize, (page+1)*pageSize - 1);  
                    $scope.products.push.apply($scope.products, pageData);
                    if(++page === pages) {
                        noMoreData = !0;
                    } 

                }, function(error) {

                }
            );
        }

    };

    function refreshData() {
        page = 0;
        $scope.hideSpinner = !1;
        $scope.noResults = !1;
        $scope.products.length = 0;
        noMoreData = !1;
        $scope.getProducts();
    }

}])

.controller('SearchStoresController', ['$scope', 'api', 'requestContext', function($scope, api, requestContext) {
    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "search.stores", ["searchKey"] );
    $scope.subview = renderContext.getNextSection();
    
    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }

        if ( requestContext.hasParamChanged( "searchKey" ) ) {
            refreshData();
        }

    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/
    var pages = 0,
        page = 0,
        pageSize = 20,
        noMoreData = !1,
        pageData;

    $scope.stores = [];
    $scope.hideSpinner = !1;
    $scope.noResults = !1;
    
    $scope.getStores = function() {

        if(Object.keys($scope.storesVault).length !== 0) {
            if(!noMoreData) {
                $scope.hideSpinner = !0;
                pageData = $scope.storesVault.slice(page*pageSize, (page+1)*pageSize - 1);  
                $scope.stores.push.apply($scope.stores, pageData);

                if(++page === pages) {
                    noMoreData = !0;
                }      
            }            

        }
        else {
            api.get($scope.urlParams.stores + $scope.rawSearchKey).then(
                function(data) {
                    if(!data || typeof(data) !== 'object' || (typeof(data) === 'object' && Object.keys(data).length===0)) {
                        $scope.hideSpinner = !0;
                        noMoreData = !0;
                        $scope.noResults = !0;
                        return;
                    }

                    $scope.hideSpinner = !0;
                    $scope.storesVault.length = 0;

                    angular.forEach(data, function(store){
                        $scope.storesVault.push(store);
                    });

                    pages = Math.ceil($scope.storesVault.length/pageSize);
                    pageData = $scope.storesVault.slice(page*pageSize, (page+1)*pageSize - 1);  
                    $scope.stores.push.apply($scope.stores, pageData); 
                    if(++page === pages) {
                        noMoreData = !0;
                    } 

                }, function(error) {

                }
            );
        }

    };

    function refreshData() {
        page = 0;
        $scope.hideSpinner = !1;
        $scope.noResults = !1;
        $scope.stores.length = 0;
        noMoreData = !1;
        $scope.getStores();
    }

}])

.controller('SearchUsersController', ['$scope', 'api', 'requestContext', function($scope, api, requestContext) {
    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "search.people", ["searchKey"] );
    $scope.subview = renderContext.getNextSection();
    
    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }

        if ( requestContext.hasParamChanged( "searchKey" ) ) {
            refreshData();
        }

    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/
    var pages = 0,
        page = 0,
        pageSize = 20,
        noMoreData = !1,
        pageData;

    $scope.users = [];
    $scope.hideSpinner = !1;
    $scope.noResults = !1;
    
    $scope.getUsers = function() {

        if(Object.keys($scope.usersVault).length !== 0) {
            if(!noMoreData) {
                $scope.hideSpinner = !0;
                pageData = $scope.usersVault.slice(page*pageSize, (page+1)*pageSize - 1);  
                $scope.users.push.apply($scope.users, pageData);

                if(++page === pages) {
                    noMoreData = !0;
                }      
            }            

        }
        else {
            api.get($scope.urlParams.users + $scope.rawSearchKey).then(
                function(data) {
                    if(!data || typeof(data) !== 'object' || (typeof(data) === 'object' && Object.keys(data).length===0)) {
                        $scope.hideSpinner = !0;
                        noMoreData = !0;
                        $scope.noResults = !0;
                        return;
                    }

                    $scope.hideSpinner = !0;
                    $scope.usersVault.length = 0;

                    angular.forEach(data, function(user){
                        var details = user.userDetails;
                        
                        $scope.usersVault.push(user);
                    });

                    pages = Math.ceil($scope.usersVault.length/pageSize);
                    pageData = $scope.usersVault.slice(page*pageSize, (page+1)*pageSize - 1);  
                    $scope.users.push.apply($scope.users, pageData); 
                    if(++page === pages) {
                        noMoreData = !0;
                    }  
                     
                }, function(error) {

                }
            );
        }

    };

    function refreshData() {
        page = 0;
        $scope.hideSpinner = !1;
        $scope.noResults = !1;
        $scope.users.length = 0;
        noMoreData = !1;
        $scope.getUsers();
    }

}])

// .controller("SearchController", ["$scope", "api", "requestContext", function($scope, api, requestContext) {

//     /**************************************************************/
//     /********************* Route Specific *************************/
//     /**************************************************************/
//     var renderContext = requestContext.getRenderContext( "search", ["searchKey", "page"] );
//     $scope.searchKey = requestContext.getParam("searchKey");
//     $scope.page = requestContext.getParam("page");
//     $scope.subview = renderContext.getNextSection();
    
//     $scope.$on( "requestContextChanged", function() {        
//         if ( ! renderContext.isChangeRelevant() ) {            
//             return;
//         }
        
//         $scope.searchKey = requestContext.getParam("searchKey");
//         $scope.page = requestContext.getParam("page");

//         if ( requestContext.hasParamChanged( "searchKey" ) ) {
//             searchThis();
//         }
//         else if( requestContext.hasParamChanged( "page" ) ) {
//             changePage();
//         }
//     });

//     /**************************************************************/
//     /********************* Initialize *************************/
//     /**************************************************************/
//     var pageSize = 20,
//         pageWindowSize = 10;

//     $scope.noResults = false;
//     $scope.hideSpinner = false;

//     searchThis();

//     /**************************************************************/
//     /********************* Controller Logic *************************/
//     /**************************************************************/
//     function getSearchResults() {
//         var searchKey = $scope.searchKey;

//         searchKey = searchKey.split('-').join(' ');

//         api.get("search/results/" + searchKey).then(
//             function(data) {

//                 if(!data || data === 'null') {
//                     $scope.hideSpinner = true;
//                     $scope.noResults = true;
//                     return;
//                 }

//                 var count = 0,
//                     pagesCount;

//                 angular.forEach(data, function(product) {
//                     count += 1;
//                 });

//                 pagesCount = Math.ceil(count/pageSize);

//                 for(var i=1; i<=pagesCount; i++) {
//                     $scope.pages.push(i);
//                 }   

//                 angular.forEach(data, function(product) {
//                     product["discountedPrice"] = (product.productIsOnDiscount == 1) ? (product.productSellingPrice - product.productDiscount) : product.productSellingPrice;

//                     $scope.results.push(product);

//                 });

//                 changePage();

//                 $scope.hideSpinner = true;

//             },function(reason) {
//                 if(reason === "noMoreData") {
//                     $scope.hideSpinner = true;
//                 }
//             }
            
//         );
//     };

//     function searchThis() {
//         $scope.results = [];
//         $scope.products = [];
//         $scope.pages = [];
//         $scope.currentPages = [];
//         $scope.hidePrevious = false;
//         $scope.hideNext = false;
//         $scope.noResults = false;
//         $scope.hideSpinner = false;
//         getSearchResults();
//     }

//     function changePage() {
//         var pageWindowStart = parseInt($scope.page) - pageWindowSize/2,
//             pageWindowEnd = parseInt($scope.page) + pageWindowSize/2,
//             pageStart = (parseInt($scope.page) - 1)*pageSize,
//             productsDisplayed = parseInt($scope.page)*pageSize;

//         $('html, body').scrollTop(0);

//         $scope.range = (productsDisplayed - pageSize + 1) + '-' + ((productsDisplayed < $scope.results.length) && productsDisplayed || $scope.results.length);

//         if($scope.pages.length <= pageWindowSize) {
//             $scope.currentPages = $scope.pages.slice(0, pageWindowSize);
//         }
//         else {
//             if(pageWindowStart <= 0) {
//                 $scope.currentPages = $scope.pages.slice(0, pageWindowSize);
//             }
//             else if(pageWindowEnd > $scope.pages.length) {
//                 $scope.currentPages = $scope.pages.slice(-1*pageWindowSize);
//             }
//             else {
//                 $scope.currentPages = $scope.pages.slice(pageWindowStart - 1, pageWindowStart + pageWindowSize - 1);
//             }
//         }

//         if($scope.page == $scope.pages[0]) {
//             $scope.hidePrevious = true;

//             if($scope.pages.length === 1) {
//                 $scope.hideNext = true;
//             }
//         }
//         else if($scope.page == $scope.pages[$scope.pages.length-1]) {
//             $scope.hideNext = true;
//         }
//         else {
//             $scope.hidePrevious = false;
//             $scope.hideNext = false;
//         }

//         $scope.previousUrl = $scope.searchKey + '/' + (parseInt($scope.page) - 1);
//         $scope.nextUrl = $scope.searchKey + '/' + (parseInt($scope.page) + 1);

//         $scope.products.length = 0;
//         $scope.products = $scope.results.slice(pageStart, pageStart+pageSize);
//     }

// }])

.directive("typeahead", ["$window", "$location", "api", "$filter", "$rootScope", function($window, $location, api, $filter, $rootScope) {
    var minChars = 2;

    return {
        restrict:"A",
        controller: function($scope) {

            $scope.showSuggestions = false;
            $scope.searchResults = [];
            $scope.active = null;

            this.activate = function(item) {
                $scope.active = item;
            };

            this.activateNext = function() {
                var index = $scope.searchResults.indexOf($scope.active);
                this.activate($scope.searchResults[(index + 1) % $scope.searchResults.length]);
            };

            this.activatePrevious = function() {
                var index = $scope.searchResults.indexOf($scope.active);
                this.activate(index === 0 ? null :  $scope.searchResults[index - 1]);
            };

            this.isActive = function(item) {
                return $scope.active === item;
            };

            this.selectActive = function() {
                $scope.showSuggestions = false;
            };

            this.shouldSearch = function() {
                return parseInt(minChars) <= $scope.searchKey.trim().length;
            };

            this.safeApply = function(fn) {
                $rootScope.$$phase ? $scope.$eval(fn) : $scope.$apply(fn);
            };

        },
        link: function(scope, element, attrs, controller) {
            console.log(controller)

            var inputElem = element.find("input");

            inputElem.bind("focus", function() {
                    controller.safeApply(function() { scope.showSuggestions = true; });          
            });

            inputElem.bind("blur", function() {
                controller.safeApply(function() { scope.showSuggestions = false; });
            });

            inputElem.bind("keydown", function(event) {
                var code = event.keyCode;

                if(code === 38) {
                    //Up Arrow
                    event.preventDefault();
                    scope.$apply(function() { controller.activatePrevious(); }); 
                }

                if(code === 40) {
                    //Down Arrow
                    event.preventDefault();
                    scope.$apply(function() { controller.activateNext(); });
                }

                if(code === 9 || code === 13 || code === 27) {
                    //Escape for tab, enter & escape keys
                    event.preventDefault();
                }

            });

            inputElem.bind("keyup", function(event) {
                var code = event.keyCode;

                if( code === 9 || code === 13) {
                    scope.$apply(function() { 
                        if(scope.active) {
                            controller.selectActive();
                        }
                        else {
                            scope.showSuggestions = false;
                            $location.path(setPath() + $filter('beautify')(scope.searchKey));
                            element.removeClass('searchActive');
                            inputElem.blur();
                        }
                    });
                }

                if(code === 27) {
                    controller.safeApply(function() { scope.showSuggestions = false; });
                }

            });

            function setPath() {
                var currentSplitPath = $location.path().split('/');
                if(currentSplitPath[1] != 'search') {
                    return 'search/products/';
                }
                else {
                    return currentSplitPath[1] + '/' + currentSplitPath[2] + '/';
                }
            }

            // scope.$watch("searchKey", function(newVal, oldVal) {

            //     if(oldVal !== newVal && controller.shouldSearch()) {
            //         scope.searchResults.length = 0;

            //         api.get("search/suggest/" + newVal).then(function(suggestions) {
            //             angular.forEach(suggestions, function(suggestion) {
            //                 scope.searchResults.push(suggestion);                            
            //             });
            //         });
            //     }

            // });

        }

    }

}])

.directive("typeaheadItem", [function() {

    return {

        restrict: "A",
        require: "^typeahead",
        link: function(scope, element, attrs, controller) {

            var item = scope.$eval(attrs.typeaheadItem);

            scope.$watch(function() { return controller.isActive(item); }, function(active) {
                active ? element.addClass("active") : element.removeClass("active");
            });

            element.bind("mouseenter", function() {
                scope.$apply(function() { controller.activate(item) });
            });

            element.bind("mousedown", function() {
                scope.$apply(function() { controller.selectActive(); });
            });

        }

    }

}]);