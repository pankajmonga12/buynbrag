angular.module('storePage', ['directives.fancy', 'directives.loadingSpinner'])

.controller("StorePageController", ["$scope", "api", "requestContext", "paginatorFactory", "user", function($scope, api, requestContext, paginatorFactory, user) {

    /********************************* Route Specific Code ********************************/
    var renderContext = requestContext.getRenderContext( "store", "storeSectionID" ),
        showStoreProducts = false;
    
    $scope.storeID = requestContext.getParam("storeID");
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {
        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }
        
        $scope.storeSectionID = requestContext.getParam("storeSectionID");

        if(!$scope.storeSectionID) {
            showStoreProducts = true;
        }
        else {
            showStoreProducts = false;
        }

        if ( requestContext.hasParamChanged( "storeSectionID" ) ) {
            renderSectionView();
        }

    });

    /***************************************** Initialize ******************************************/
    var initSectionRequests = false,
        paginator = new paginatorFactory($scope.imageCount, true, [$scope.storeID, 'productID', 'fancy3.jpg']),
        refreshData = !1,
        urlBase, hasFanciedStore;

    $scope.products = [];
    $scope.filter = 4;
    $scope.hideSpinner = false;
    $scope.followText = "";

    $scope.filters = {
        lowestPrice: 1,
        highestPrice: 2,
        popularity: 3,
        latest: 4,
        onSale: 6,
        trending: 7
    };

    //Get Store Sections List
    api.get("async/storeSections/" + $scope.storeID).then(function(data) {

        $scope.storeSections = data.storeSections;
        $scope.storeInfo = data.storeInfo[0];
        hasFanciedStore = $scope.storeInfo.hasFanciedStore || 0;
        $scope.followText = (hasFanciedStore == 1) ? "Following!" : "Follow Store!";

    });

    /************************************ Controller Methods ****************************************/
    $scope.$on('userLoggedIn', function() {
        refreshData = !0;
        paginator.reset();
        $scope.getProducts();
    });

    $scope.fancyStore = function() {
        if(user.getloginstatus() && $scope.followText === "Follow Store!") {
            $scope.$broadcast("showSpinner");

            api.get("async/fancyStore/" + $scope.storeID).then(function(data) {
                var resp = data.result;

                if(resp.userStoreFollowOK) {
                    $scope.storeInfo.storeFancyCounter = resp.storeFancyCounter;
                    $scope.followText = "Following!";
                    $scope.$broadcast("hideSpinner");
                }

            });
        }
        else if(!user.getloginstatus()){
            $("#loginModal").modal("show");
        }
        
    };

    $scope.getProducts = function() {
        //Refresh products on login
        if(refreshData) {
            $scope.products.length = 0;
            refreshData = !1;
        }

        if(!initSectionRequests) {
            urlBase = "async/storeProducts/" + $scope.storeID + "/" + $scope.filter + "/";
        }
        else {
            urlBase = "async/storeSectionProducts/" + $scope.storeID + "/" + $scope.storeSectionID + "/" + $scope.filter + "/";
        }

        paginator.retreiveProducts(urlBase, "get").then(
            function(data) {
                var count = 0;

                angular.forEach(data, function(product) {

                    product["src"] = api.productImage($scope.storeID, product.productID);
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

    };

    $scope.filterProducts = function(filter) {
        $scope.filter = filter;
        $scope.products.length = 0;
        $scope.getProducts();
    };

    function renderSectionView() {
        initSectionRequests = !showStoreProducts;    
        $scope.filter = 7;
        $scope.products.length = 0;
        $scope.getProducts();
    }

}]);