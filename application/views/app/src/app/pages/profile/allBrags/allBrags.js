angular.module('profilePage')

.controller('AllBragsController', ["$scope", "api", "requestContext", "paginatorFactory", function($scope, api, requestContext, paginatorFactory) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.allBrags", "userID" );
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {

        if ( ! renderContext.isChangeRelevant() ) {           
            return;
        }

        if(requestContext.hasParamChanged('userID')) {
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

    $scope.braggedProducts = [];
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

        paginator.retreiveProducts('rapiv1/profile/fancyList/' + $scope.userID + '/0/', "get").then(
            function(data) {
                console.log('All Bragged Products --->  ', data)
                $scope.braggedProducts.push.apply($scope.braggedProducts, data);                  

            }, function(error) {
                if(error == 'noMoreData') {
                    $scope.hideSpinner = !0;
                }
            }
        );
    };

}])