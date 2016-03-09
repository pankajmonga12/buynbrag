angular.module('profilePage')

.controller('MutualProductsController', ["$scope", "api", "requestContext", "paginatorFactory", function($scope, api, requestContext, paginatorFactory) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.mutualproducts", "userID" );
    $scope.currentUser = requestContext.getParam("userID");
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {

        if ( ! renderContext.isChangeRelevant() ) {           
            return;
        }

        if(requestContext.hasParamChanged('userID')) {
            $scope.currentUser = requestContext.getParam("userID");
            refreshView();
        }
        $scope.subview = renderContext.getNextSection();
    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/ 

    //Wait for Fancy List to be ready before firing individual fancyList requests
    //Fire instantly if Fancy List is already available(when switching tabs)
    var paginator = new paginatorFactory(35, true, ['storeID', 'productID', 'img1_240x200.jpg']),
        refreshData = !1,
        newData = [];

    $scope.mutualProducts = [];
    $scope.bragList = '';
    $scope.hideSpinner = !1;

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/

    function refreshView() {
        $scope.hideSpinner = !1;
        $scope.showFancyMessage = !1;
        $scope.braggedProducts.length = 0;
        $scope.getProducts();
    }

    $scope.getProducts = function() {

        paginator.retreiveProducts('rapiv1/mutual/products/' + $scope.currentUser + '/', "get").then(
            function(data) {
                console.log('Mutual Products --->  ', data);
                $scope.mutualProducts.push.apply($scope.mutualProducts, data);                  

            }, function(error) {
                if(error == 'noMoreData') {
                    $scope.hideSpinner = !0;
                }
            }
        );
    };

}])