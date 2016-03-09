angular.module('storeDisabledPage', [])

.controller("StoreDisabledController", ["$scope", "api", "requestContext", "paginatorFactory", function($scope, api, requestContext, paginatorFactory) {

    /********************************* Route Specific Code ********************************/
    var renderContext = requestContext.getRenderContext( "storeDisabled", "storeSectionID" );
    
    $scope.storeID = requestContext.getParam("storeID");
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {
        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }
        
        $scope.storeSectionID = requestContext.getParam("storeSectionID");

        if ( requestContext.hasParamChanged( "storeSectionID" ) ) {
            renderSectionView();
        }

    });

    /***************************************** Initialize ******************************************/
    var initSectionRequests = false,
        paginator = new paginatorFactory(12, true, [$scope.storeID, 'productID', 'img1_240x200.jpg']),
        urlBase;

    $scope.storeProducts = [];
    $scope.filter = 4;
    $scope.hideSpinner = false;

    $scope.filters = {
        lowestPrice: 1,
        highestPrice: 2,
        popularity: 3,
        latest: 4,
        onSale: 6
    };

    //Get Store Sections List
    api.get("async/storeSectionsUnpublished/" + $scope.storeID).then(function(data) {

        $scope.storeSections = data.storeSections;
        $scope.storeInfo = data.storeInfo[0];

    });

    /************************************ Controller Methods ****************************************/
    $scope.getProducts = function() {

        if(!initSectionRequests) {
            urlBase = "async/storeProductsUnpublished/" + $scope.storeID + "/" + $scope.filter + "/";
        }
        else {
            urlBase = "async/storeSectionProductsUnpublished/" + $scope.storeID + "/" + $scope.storeSectionID + "/" + $scope.filter + "/";
        }

        paginator.retreiveProducts(urlBase, "get").then(function(data) {

            angular.forEach(data, function(product) {
                product["discountedPrice"] = (product.productIsOnDiscount == 1) ? (product.productSellingPrice - product.productDiscount) : product.productSellingPrice;

                $scope.storeProducts.push(product);
            });

        },function(reason) {
            if(reason === "noMoreData") {
                $scope.hideSpinner = true;
            }
        });

    };

    $scope.filterProducts = function(filter) {
        $scope.filter = filter;
        $scope.storeProducts.length = 0;
    };

    function renderSectionView() {
        initSectionRequests = true;        
        $scope.filter = 4;
        $scope.storeProducts.length = 0;
    }

}]);