angular.module('allStores', [])
.controller("StoreController", ["$scope", "api","requestContext", "paginatorFactory", function($scope, api, requestContext, paginatorFactory) {

    /***************************************************************************************/
    /********************************* Route Specific Code ********************************/
    /***************************************************************************************/
    var renderContext = requestContext.getRenderContext( "allStores", "categoryID" ),
        categoryID,
        categoryName;
    
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {
        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }
        
        categoryID = requestContext.getParam("categoryID");
        categoryName = requestContext.getParam("categoryName");

        if ( requestContext.hasParamChanged( "categoryID" ) ) {
            if(categoryID) {
              getStoresByCategory();  
          }
          else {
            getStoresDefault();
          }
        }

    });
    /***************************************************************************************/
    /***************************************************************************************/
    /***************************************************************************************/

    $scope.busy = false;
    $scope.after = 0;
    $scope.stores = [];
    $scope.category = "Filter stores by category";

    $scope.filters = {
        newStores: 1,
        popularStores: 2,
        allStores: 3
    };

    var apis = [undefined, 'newStores2', 'topStores', 'allStores'];

    $scope.filter = 1;

    api.get("async/cats", true).then(function(data) {
        $scope.storesByCategories = data.cats;
    });

    $scope.hideSpinner = false;
    $scope.cancelFurtherRequests = false;

    $scope.getStores = function() {
        if($scope.busy || $scope.cancelFurtherRequests) return;

        var baseUrl = 'async/' + apis[+$scope.filter] + '/' + $scope.after,
            url = categoryID ? (baseUrl + "/" + categoryID) : baseUrl;

        $scope.busy = true;
        $scope.hideSpinner = false;

        api.get(url, true).then(function(data) {
            if(!data[0].hasData) {
                $scope.hideSpinner = true;
                $scope.cancelFurtherRequests = true;
                $scope.busy = false;
                return;
            }

            var stores = data[1];

            for(var store in stores) {
                var elm = stores[store];
                $scope.stores.push(elm);
            }

            $scope.busy = false;
            $scope.after += 1;
        });
    };

    $scope.filterProducts = function(filter) {
        $scope.filter = filter;
        fetchNew();
    };

    function getStoresByCategory() {
        $scope.category = categoryName;
        fetchNew();
    }

    function getStoresDefault() {
        $scope.category = 'All';
        categoryID = null;
        fetchNew();
    }

    function fetchNew() {
        $scope.stores.length = 0;
        $scope.after = 0;
        $scope.getStores();
    }


}]);