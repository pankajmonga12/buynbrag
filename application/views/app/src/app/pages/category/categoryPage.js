angular.module('categoryPage', [])

.controller("CategoryController", ["$scope", "paginatorFactory", "requestContext", "categoryService", "$q", "$http", "api", function($scope, paginatorFactory, requestContext, categoryService, $q, $http, api) {

    /********************************* Route Specific Code ********************************/
    var renderContext = requestContext.getRenderContext( "categories", "categoryID" );
    
    $scope.categoryID = requestContext.getParam("categoryID");
    $scope.subview = renderContext.getNextSection();
    
    $scope.$on( "requestContextChanged", function() {
        
        if ( ! renderContext.isChangeRelevant() ) {
            
            return;

        }
        
        $scope.categoryID = requestContext.getParam("categoryID");

        if ( requestContext.hasParamChanged( "categoryID" ) ) {

            renderSubView();

        }

    });

                        /********************************* Initialize ********************************/

    var defer = $q.defer(),
        paginator = new paginatorFactory($scope.imageCount, true, ['storeID', 'productID', 'fancy3.jpg']),
        // bannerRef = [1,1,1,1,1,1,1,1,1,1,1],
        refreshData = !1;

    $scope.products = [];
    $scope.sparseCategories = [];    
    $scope.filter = 4;
    $scope.params = '';
    $scope.hideSpinner = false;

    $scope.filters = {
        lowestPrice: 1,
        highestPrice: 2,
        popularity: 3,
        latest: 4,
        onSale: 6,
        trending: 7
    };

    categoryService.getCategories().then(function(data) {
        $scope.sparseCategories = data;
            
        setParams();
        // setBannerSrc();
    });
    

    /********************************* Controller Methods ********************************/

    $scope.$on('userLoggedIn', function() {
        refreshData = !0;
        paginator.reset();
        $scope.getProducts();
    });

    $scope.filterProducts = function(filter) {
        $scope.filter = filter;
        $scope.products.length = 0;
        $scope.getProducts();
    };

    $scope.getProducts = function() {
        //Refresh products on login
        if(refreshData) {
            $scope.products.length = 0;
            refreshData = !1;
        }

        var requestObject;

        requestObject = $scope.filter ? {sortBy: $scope.filter} : {};

        if(!($scope.params)) {
            defer.promise.then(function() {
                loadRemoteData();
            });
        }
        else {
            loadRemoteData();
        }

        function loadRemoteData() {
            paginator.retreiveProducts("async/catProducts" + $scope.params, "post", requestObject).then(
                function(data) {
                    var count = 0;

                    angular.forEach(data, function(product) {

                        product["src"] = api.productImage(product.storeID, product.productID);
                        product["discountedPrice"] = (product.productIsOnDiscount == 1) ? (product.productSellingPrice - product.productDiscount) : product.productSellingPrice;

                        $scope.products.push(product);
                        count++;
                    });

                    if(count < 15) {
                        $scope.hideSpinner = !0;
                    }

                },function(error) {
                    
                    switch(error) {
                        case "noMoreData":
                            $scope.hideSpinner = !0;
                            break;
                    };

                }
            );
        }

    };

    function setParams() {

        var allSubCategories = [];

        /**************** Set request parameters for Root Categories ******************/
        if( $scope.sparseCategories[$scope.categoryID].parentID == 0 ) {            
            $scope.params = "/" + $scope.categoryID;
            $scope.parentCategory = $scope.categoryID;            
        }
        /**************** Set request parameters for Sub Categories ******************/
        else  {
            var pid = $scope.sparseCategories[$scope.categoryID].parentID,
                params = "";


            /*********** Get All SubCategories from sparse array **************/
            allSubCategories.push($scope.categoryID);

            while( pid != 0 ) {
                allSubCategories.push( pid );
                pid = $scope.sparseCategories[pid].parentID;
            }

            /**************** Reverse Category IDs and build parameters ******************/
            var reversedCats = allSubCategories.reverse();

            $scope.parentCategory = reversedCats[0];

            angular.forEach(reversedCats, function(val) {
                params = params + "/" + val;
            });

            $scope.params = params;           

        }

        defer.resolve();
    }

    function renderSubView() {

        setParams();
        // setBannerSrc();

        /************** Reset some values for infinite scroll for different Cat IDs *******************/
        $scope.filter = 7;
        $scope.products.length = 0;
        $scope.getProducts();
    }

    // function setBannerSrc() {
    //     $scope.bannerSrc = "/application/views/dist/images/banners/" + $scope.parentCategory + "/" + bannerRef[$scope.parentCategory] + ".jpg";

    //     $http({
    //         method: "HEAD",
    //         url: "/application/views/dist/images/banners/" + $scope.parentCategory + "/" + (bannerRef[$scope.parentCategory] + 1) + ".jpg",
    //         cache: true
    //     }).then(
    //         function(success) {
    //             if(success.status == 200) {
    //                 bannerRef[$scope.parentCategory]++;
    //             }
    //         },
    //         function(error) {
    //             if(error.status == 404) {
    //                 bannerRef[$scope.parentCategory] = 1;
    //             }
    //         }
    //     );
    // }

}])

.directive("navigationBreadcrumbs", ["categoryService", "$routeParams", "$filter", "$location", function(categoryService, $routeParams, $filter, $location) {

    return {

        restrict: "A",
        // scope: {},
        link: function(scope, element, attrs) {  

            //Update Breadcrumbs when selected from Header dropdown
            scope.$on("ActiveCategoryChanged", function() {
                updateBreadcrumbs();
            });         

            scope.changeSubCats = function(cats) {
                if(cats.children.length > 0) {
                    updateSubCategories(cats);
                    scope.path.push(cats)
                }
                else {

                }
            };

            scope.linkBackPath = function(cat) {
                categoryService.setCategoryData(cat);
            };

            function updateSubCategories(cats) {
                scope.cats = cats;
            }

            function updateBreadcrumbs() { 
                scope.path = categoryService.getRelativePath();             

                //Update Sub-Categories
                updateSubCategories(categoryService.cats);
            }

            //Initialize
            var path, pid;

            categoryService.getCategories().then(function(data) {
                scope.sparseCategories = categoryService.sparseCategories;
                categoryService.setCategoryData(scope.sparseCategories[$routeParams.categoryID]);

                updateBreadcrumbs();
            });            

        }

    }

}])

.directive("navigationtree", ["$compile", "categoryService", function($compile, categoryService) {

    return {

        restrict: "E",
        scope: {
            cats: "="
        },
        terminal: true,
        link: function(scope, element, attrs) {

            var template =  '<ul class="dropdown-menu dark hidden-iphone-landscape">' +
                                '<li  class="{{ (cat.parentID == 0) && \'dropdown-submenu\' || \'\' }}" ng-repeat="cat in cats.children">' +
                                    '<a ng-click=passChildren(cat) ng-href="{{cat.data.relativeUrl}}{{cat.data.catID}}" tabindex="-1">' + 
                                        '{{cat.data.title}} ({{cat.data.totalProducts}})' + 
                                    '</a>' +
                                    '<navigationtree cats="cat"></navigationtree>' +
                                '</li>' +
                            '</ul>';

            var linkedTemplate = $compile(angular.element(template))(scope);
            var parentElement = element.parent();

            parentElement.bind("mouseenter", function() {

                (scope.cats.parentID === null || +scope.cats.parentID === 0) && (scope.cats.children.length !== 0) && parentElement.append(linkedTemplate);
                // (scope.cats.children.length !== 0) && parentElement.append(linkedTemplate);

            });

            scope.passChildren = function(cat) {

                categoryService.setCategoryData(cat);

            };

        }

    }

}])

.factory("categoryService", ["$rootScope", "api", "$q", "$filter", function($rootScope, api, $q, $filter) {

    var serveCats = {
        cats: '',
        sparseCategories: '',
        categories: '',
        path: ''
    };

    var defer1 = $q.defer();
    var defer2 = $q.defer();

    //Initialize serveCats object with Category data
    api.get("async/catsData2").then(function(data) {
        var itemsByID = [],
            cats = data,
            sortOrder = [],
            roots,
            sortedRoots = new Array(7),
            index;

        for(var i=0; i<7; i++) {
            sortOrder.push(cats[i].catID);
        }
        
        angular.forEach(cats, function(item) {
            itemsByID[item.catID] = {
                data: {
                    title: item.catName,
                    catID: item.catID,
                    totalProducts: item.totalProducts,
                    relativeUrl: ''
                },
                children: [],
                parentID: item.parentCatID
            };
        });

        serveCats.sparseCategories = itemsByID;
        defer1.resolve(itemsByID);

        angular.forEach(itemsByID, function(item) {
            if(item.parentID !== null && item.parentID != 0) {
                if(itemsByID[item.parentID]) {
                    itemsByID[item.parentID].children.push(item);
                    item.data.relativeUrl = itemsByID[item.parentID].data.relativeUrl + $filter('beautify')(item.data.title) + '/';
                } 
            }
            else {
                item.data.relativeUrl = $filter('beautify')(item.data.title) + '/';
            }
        });

        roots = itemsByID.filter(function(item) { return item.parentID == 0; });

        angular.forEach(roots, function(root) {
            index = sortOrder.indexOf(root.data.catID);
            sortedRoots[index] = root;  
        });
        console.log(sortedRoots);

        serveCats.categories = {
            data: {
                title: "All Categories",
                catID: null
            },
            children: sortedRoots,
            parentID: null
        };

        defer2.resolve(serveCats.categories);
                          
    });

    serveCats.getCategories = function(categoriesType) {
        return categoriesType && categoriesType === "roots" ? defer2.promise : defer1.promise;
    };

    serveCats.setCategoryData = function(cats) {
        this.cats = cats;
        $rootScope.$broadcast("ActiveCategoryChanged");
    };

    serveCats.getRelativePath = function(cat) {
        this.path = [];  
        var tempID = cat || this.cats.data.catID;              
        var pid = this.sparseCategories[tempID].parentID;            
        this.path.push(tempID);

        while( pid != 0 ) {
            this.path.push( pid );
            pid = this.sparseCategories[pid].parentID;
        }
        
        return this.path.reverse().map(function(x) { 
            return serveCats.sparseCategories[x] 
        });

    };

    return serveCats;
}]);