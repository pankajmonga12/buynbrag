angular.module('profilePage')

.controller('FancyListViewController', ["$scope", "api", "fancyListService", "requestContext", "paginatorFactory", function($scope, api, fancyListService, requestContext, paginatorFactory) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.list", "listID" );
    $scope.listID = requestContext.getParam("listID");
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {

        if ( ! renderContext.isChangeRelevant() ) {           
            return;
        }

        if(requestContext.hasParamChanged('listID')) {
            $scope.listID = requestContext.getParam("listID");
            refreshView();
        }
        $scope.subview = renderContext.getNextSection();
    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/ 

    //Wait for Fancy List to be ready before firing individual fancyList requests
    //Fire instantly if Fancy List is already available(when switching tabs)
    var paginator = new paginatorFactory(12, true, ['storeID', 'productID', 'img1_240x200.jpg']),
        refreshData = !1,
        newData = [];

    $scope.listProducts = [];
    $scope.bragList = '';
    $scope.hideSpinner = !1;
    $scope.bragList = fancyListService.getList();

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/
    function refreshView() {
        $scope.hideSpinner = !1;
        $scope.showFancyMessage = !1;
        $scope.listProducts.length = 0;
        $scope.getListProducts();
    }

    $scope.$on('PRODUCTEDITED', function(event, data) {
        var product = $scope.listProducts.filter(function(obj) { return obj.productID == data.productData.pid; })[0];

        $scope.listProducts.splice($scope.listProducts.indexOf(product), 1);
    });

    $scope.getListProducts = function() {

        paginator.retreiveProducts('rapiv1/profile/fancyList/' + $scope.userID + '/' + $scope.listID + '/', "get").then(
            function(data) {
                console.log('FANCY LIST VIEW DATA --->  ', data)
                $scope.listProducts.push.apply($scope.listProducts, data);                  

            }, function(error) {
                if(error == 'noMoreData') {
                    $scope.hideSpinner = !0;
                }
            }
        );
    };

}])