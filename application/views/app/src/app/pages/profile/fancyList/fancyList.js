angular.module('profilePage')

.controller('FancyListController', ["$scope", "fancyListService", "api", "requestContext", "user", function($scope, fancyListService, api, requestContext, user) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.fancy", "userID" );
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
    $scope.fancyList = [];

    refreshView();

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/
    $scope.sendList = function(list) {
        fancyListService.setList(list);
    };

    function refreshView() {
        $scope.fancyList = [];
        $scope.hideSpinner = false;

        api.get('rapiv1/profile/fancyListDetails/' + $scope.userID, true).then(
            function(data) {
                var listToAdd;
                $scope.hideSpinner = true;
                if(data.data && data.data.fancyListsData) {
                    angular.forEach(data.data.fancyListsData, function(list) {
                        listToAdd = {
                                    fancyListID : list.fancyListID,
                                    fancyListName : list.fancyListName,
                                    fancyListDescription: list.fancyListDescription,
                                    fanciedItemsToDisplay : [],
                                    totalFancies: +list.totalFanciedProducts
                                };
                        
                        //Don't include lists with no name
                        if(list.fancyListName) {
                            if(user.getuser() == $scope.userID) {
                                $scope.fancyList.push(listToAdd);    
                            }
                            //Don't show empty lists of other users
                            else {
                                if(+list.totalFanciedProducts > 0) {
                                    $scope.fancyList.push(listToAdd);
                                }
                            }
                            
                        }
                        
                    });

                }

                loadListProducts();
            }
        );      

    }

    function loadListProducts() {
        angular.forEach($scope.fancyList, function(fancyList){

            if(+fancyList.totalFancies > 0) {
                api.get('rapiv1/profile/fancyList/' + $scope.userID + '/' + fancyList.fancyListID + '/0/6', true).then(
                    function(fancyData) {

                        if(!fancyData) {
                            //$scope.showFancyMessage = true;
                            return;
                        }

                        fancyList.fanciedItemsToDisplay = fancyData;
                    }
                );
            }
            
        });
    }

}])