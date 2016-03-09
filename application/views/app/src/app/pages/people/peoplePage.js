angular.module('people', ['directives.fancy', 'directives.tag', 'directives.loadingSpinner', 'directives.masonryLayout'])

.controller("PeopleController", ["$scope", "api", "requestContext", "paginatorFactory", function($scope, api, requestContext, paginatorFactory) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "people" );

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
    var paginator = new paginatorFactory(12, false, ['storeID', 'productID', 'fancy3.jpg']),
        refreshData = !1,
        newData = [];

    $scope.users = [];
    $scope.filter = 1;
    $scope.hideSpinner = false;

    $scope.filters = {
        topRankers: {
            val: 1,
            api: "rapiv1/people/index/1/"
        },
        mostFollowed: {
            val: 2,
            api: "rapiv1/people/index/2/"
        },
        friends: {
            val: 3,
            api: "rapiv1/people/index/3/"
        },
        favourites: {
            val: 4,
            api: "rapiv1/people/index/4/"
        }
    };

    $scope.params = $scope.filters.topRankers.api; 

    /**************************************************************/
    /******************** Controller Logic ************************/
    /**************************************************************/

    $scope.filterBySelection = function(filter) {        

        $scope.filter = filter.val;
        fetchNewProducts(filter.api);

    };

    $scope.getUsers = function() {

        //Refresh products on login
        if(refreshData) {
            $scope.users.length = 0;
            refreshData = !1;
        }

        paginator.retreiveProducts($scope.params, "get").then(
            function(users) {
                
                angular.forEach(users[1], function(user) {
                    $scope.users.push(user);
                });

                if($scope.users.length > 50) {
                    $scope.hideSpinner = true;
                }

            }, function(error) {
                
            }
        );
    };

    function fetchNewProducts(api) {
        $scope.params = api;
        $scope.users.length = 0;
        //$scope.hideSpinner = false;
        $scope.getUsers();
    }

}])