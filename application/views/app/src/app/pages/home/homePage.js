angular.module('home', ['directives.fancy', 'directives.tag', 'directives.loadingSpinner', 'directives.masonryLayout'])

.controller("HomeController", ["$scope", "api", "requestContext", "paginatorFactory", function($scope, api, requestContext, paginatorFactory) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "home" );

    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {

        if ( ! renderContext.isChangeRelevant() ) {

            return;

        }
        
        $scope.subview = renderContext.getNextSection();

    });

    /**************************************************************/
    /*********************** Initialize ***************************/
    /**************************************************************/
    var paginator = new paginatorFactory($scope.imageCount, true, ['storeID', 'productID', 'fancy3.jpg']),
        refreshData = !1,
        newData = [];

    $scope.products = [];
    $scope.filter = 4;
    $scope.hideSpinner = false;

    $scope.filters = {
        recentlyFancied: {
            val: 1,
            api: "hdata/recent/"
        },
        popularity: {
            val: 2,
            api: "hdata/popular/"
        },
        favourites: {
            val: 3,
            api: "hdata/favourites/"
        },
        myFeed: {
            val: 4,
            api: "rapiv1/me/feed/"
        }
    };

    $scope.params = $scope.filters.myFeed.api; 

    /**************************************************************/
    /******************** Controller Logic ************************/
    /**************************************************************/

    $scope.$on('userLoggedIn', function() {
        refreshData = !0;
        paginator.reset();
        $scope.getProducts();
    });

    $scope.filterByFame = function(filter) {        

        $scope.filter = filter.val;
        fetchNewProducts(filter.api);

    };

    $scope.getProducts = function() {

        //Refresh products on login
        if(refreshData) {
            $scope.products.length = 0;
            refreshData = !1;
        }

        paginator.retreiveProducts($scope.params, "get").then(
            function(products) {

                angular.forEach(products, function(product) {

                    product["src"] = api.productImage(product.storeID, product.productID);
                    product['discounted_price'] = (product.productIsOnDiscount == 1) ? (product.productSellingPrice - product.productDiscount) : product.productSellingPrice; 

                    if(+product.badgeLevel) {
                        product["badgeSrc"] = "/assets/images/badges/fprod/" + product.badgeLevel + ".png";
                        product["badgeText"] = product.badgeNotificationText; 
                    }
                    else {
                        product["badgeSrc"] = "/assets/images/badges/locked_badges.png";
                        product["badgeText"] = "Fancy more products to unlock badges!";
                    }

                    $scope.products.push(product);                    
                });

                if($scope.products.length > 50) {
                    $scope.hideSpinner = true;
                }
            }, function(error) {
                
            }
        );
    };

    function fetchNewProducts(api) {
        $scope.params = api;
        $scope.products.length = 0;
        //$scope.hideSpinner = false;
        $scope.getProducts();
    }

}])