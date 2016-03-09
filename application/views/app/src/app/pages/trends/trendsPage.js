angular.module('trends', ['directives.fancy', 'directives.tag'])

.controller("TrendsController", ["$scope", "api", "requestContext", "trendsService", "$filter", "user", "paginatorFactory", function($scope, api, requestContext, trendsService, $filter, user, paginatorFactory) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "trends", "cityName" );
    $scope.city = requestContext.getParam( "cityName" );

    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }
        
        $scope.city = requestContext.getParam("cityName");

        if ( requestContext.hasParamChanged( "cityName" ) ) {
            fetchNewProducts();
        }

    });

    /**************************************************************/
    /*********************** Initialize ***************************/
    /**************************************************************/
    var paginator = new paginatorFactory($scope.imageCount, true, ['storeID', 'productID', 'fancy3.jpg']);;

    $scope.products = [];
    $scope.busy = false;

    /**************************************************************/
    /******************** Controller Logic ************************/
    /**************************************************************/
    if(user.getloginstatus() && !user.getCity()) {
        $scope.showInput = true;
    }

    $scope.saveUserCity = function() {

        if(!$scope.userCity) {
            window.alert("Please enter valid city!");
        }
        else {
            api.post('rapiv1/profile/saveUserCity', {city: $scope.userCity}).then(function(data) {
                if(data.data.updateOK) {
                    $scope.showInput = false;
                    window.alert("City updated!");
                }
                else if(!data.data.cityOK) {
                    window.alert("Please enter valid city!");
                }
            });
        }

    };

    $scope.getProducts = function() {

        getRequestParam();

         var getParams = $scope.requestParam.requestParam ? ("rapiv1/trends/" + $scope.requestParam.requestParam + "/" + "?city2=" + $scope.requestParam.urlParam) : ("rapiv1/trends/" + $scope.requestParam.urlParam + "/");

        paginator.retreiveProducts(getParams, "get").then(
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