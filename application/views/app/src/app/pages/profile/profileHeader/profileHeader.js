angular.module('profilePage')

.controller('ProfileInfoController', ["$scope", '$window', "api", "requestContext", "user", "$rootScope", function($scope, $window, api, requestContext, user, $rootScope) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader", "userID" );
    $scope.userID = requestContext.getParam("userID");
    $scope.subview = renderContext.getNextSection();
    console.log($scope.subview);

    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }

        if(requestContext.hasParamChanged('userID')) {
            $scope.userID = requestContext.getParam("userID");
            refreshView();
        }
        
        $scope.subview = renderContext.getNextSection();
    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/ 
    $scope.hideLoader = false;
    $scope.fancyListReady = false;
    $scope.fbConnectClass = user.getfbID() ? 'active' : '';

    $scope.$on('userLoggedIn', function() {
        $scope.fbConnectClass = user.getfbID() ? 'active' : '';
    });
    
    $scope.twConnectClass = '';

    refreshView();

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/ 
    
    var firstVisit = true;
    $scope.$watch('subview', function(view) {
        if(user.getuser() == $scope.userID) {
            if(firstVisit){
                _bnbAnalytics.trackProfileVisit(user.getuser(), user.getEmail(), 'self', 'firstVisit');
                firstVisit = false;
                //console.log("tracking profile visit " + "  user : " + user.getuser() + "  email : " + user.getEmail() + "  vsisttype : " + 'self' + 'firstVisit');
            }
            else{
                _bnbAnalytics.trackProfileVisit(user.getuser(), user.getEmail(), 'self', view);
                //console.log("tracking profile visit " + user.getuser() + user.getEmail() + 'self' + view);
            }
        }
        else {
            if(firstVisit){
             _bnbAnalytics.trackProfileVisit(user.getuser(), user.getEmail(), $scope.userID, 'firstVisit');
                firstVisit = false;
                //console.log("tracking profile visit " + user.getuser() + user.getEmail() + $scope.userID + 'firstVisit');
            }
            else{
             _bnbAnalytics.trackProfileVisit(user.getuser(), user.getEmail(), $scope.userID, view);   
                //console.log("tracking profile visit " + user.getuser() + user.getEmail() + $scope.userID + view);
            }
        }
    });

    $scope.connectWithFB = function() {
        if($scope.fbConnectClass) return;

        var fbDimensions = new function() {
            this.width = 800;
            this.height = 450;
            this.left = ($window.innerWidth - this.width)/2;
            this.top = ($window.innerHeight - this.height)/2;
        };
        
        window.fbConnectWindow = window.open("/rapiv1/ulogin/facebook", "_blank", 'width=' + fbDimensions.width + ', height=' + fbDimensions.height + ', left=' + fbDimensions.left + ', top=' + fbDimensions.top + ', status=yes, resizable=yes', true);
    };

    function refreshView() {
        $scope.hideLoader = false;
        $scope.fancyListReady = false;
        $scope.fancyList = [];

        $rootScope.$broadcast('clearImage');

        api.get("rapiv1/profile/info/" + $scope.userID, true).then(function(data) {

            if(!data.data.userInfo) {
                $scope.hideLoader = true;
                return;
            }

            var userInfo = data.data.userInfo[0],
                userNameDetails = userInfo.userFullName.split(' ');

            userInfo.firstName = userNameDetails.slice(0, -1).join(' ');
            userInfo.lastName = userNameDetails.slice(-1)[0];

            $scope.userInfo = userInfo;
            $scope.userStyleTags = userInfo.userStyleTags ? userInfo.userStyleTags.split(',') : [];
            $scope.hideLoader = true;

        });
    }

}])