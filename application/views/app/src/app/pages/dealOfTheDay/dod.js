angular.module('dealofday', ['directives.fancy', 'directives.tag'])

.controller("DodController", ["$scope", "api", "requestContext", "trendsService", "$filter", "user", "paginatorFactory", function($scope, api, requestContext, trendsService, $filter, user, paginatorFactory) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "dealofday" );

    $scope.subview = renderContext.getNextSection();


    /**************************************************************/
    /*********************** Initialize ***************************/
    /**************************************************************/
    var paginator = new paginatorFactory(50, true, ['storeID', 'productID', 'fancy3.jpg']);;

    $scope.products = [];
    $scope.busy = false;
    $scope.hideSpinner = false;

    /**************************************************************/
    /******************** Controller Logic ************************/
    /**************************************************************/


    $scope.getProducts = function() {

        //Refresh products on login
        // if(refreshData) {
        //     $scope.products.length = 0;
        //     refreshData = !1;
        // }

        if($scope.deal) {
            get();
        }
        else {
            $scope.$on('DEALDATAREADY', function() {
                get();
            });
        }

        function get() {

            paginator.retreiveProducts('rapiv1/dod/dodProducts/' + $scope.deal.dealID + '/', "get").then(
                function(products) {

                    $scope.hideSpinner = true;

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
                    switch(error) {
                            case "noMoreData":
                                $scope.hideSpinner = !0;
                                break;
                        };
                }
            );

        }

    };

    function fetchNewProducts() {
        $scope.bannerSrc = "";
        $scope.products.length = 0;
        $scope.getProducts();
    }

    function getRequestParam() {
        var cities = trendsService.names;

        angular.forEach(cities, function(city) {
            if($filter('beautify')(city.urlParam) == $scope.city) {
                $scope.requestParam = city;
                $scope.bannerSrc = city.bannerSrc;
                $scope.breadCrumb = city.urlParam;
                return;
            }
        });
    }

}])

.factory("trendsService", [function() {

    var cities = {};
    cities.names = {
        0 : {
            urlParam: "New Delhi",
            requestParam: "delhi",
            bannerSrc: "NewDelhi"
        },
        1 : {
            urlParam: "Mumbai",
            requestParam: "Bombay",
            bannerSrc: "Mumbai"
        },
        2 : {
            urlParam: "Hyderabad",
            requestParam: '',
            bannerSrc: "Hyderabad"
        },
//        3 : {
//            urlParam: "Chennai",
//            requestParam: "chennai",
//            bannerSrc: "Chennai"
//        },
        4 : {
            urlParam: "Kolkata",
            requestParam: "Calcutta",
            bannerSrc: "Kolkata"
        },
        5 : {
            urlParam: "Bengaluru",
            requestParam: "bangalore",
            bannerSrc: "Bangalore"
        }
//        6 : {
//            urlParam: "Chandigarh",
//            requestParam: '',
//            bannerSrc: "Chandigarh"
//        }
    };

    return cities;
}]);