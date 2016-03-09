angular.module('userCoupons', [])

.directive('couponshandler', ['api', 'user', function(api, user) {
    return {
        restrict: 'A',
        scope: true,
        controller: function($scope) {
            $scope.userCoupons = {};
            $scope.message = false;

            $scope.$on('userLoggedIn', loadCoupons);

            api.get("coupons/all").then(function(data) {
                if(data && data.isLoggedIN && data) {

                    $scope.userCoupons = data;
                    user.setCoupons(data.coupons);

                    (!window.localStorage.getItem('couponsDisplayed') || (Date.now() - (+window.localStorage.getItem('couponsDisplayed')) > 24*60*60*1000)) && handleCouponDisplay();
                }
                else {
                    $scope.message = true;
                }

                function handleCouponDisplay() {
                    $('#couponsModal').modal('show');
                    // window.localStorage.setItem('couponsDisplayed', Date.now());
                }

            });

            // $scope.iframeUrl = $rootScope.baseUrl + 'index.php/coupons/allHTML';

            // $scope.$on('userLoggedIn', function() {
                
            //     api.get("coupons/all").then(function(data) {
            //             if(data && data.isLoggedIN && data) {

            //                 $scope.userCoupons = data;
            //                 user.setCoupons(data.coupons);

            //                 (!window.localStorage.getItem('couponsDisplayed') || (Date.now() - (+window.localStorage.getItem('couponsDisplayed')) > 24*60*60*1000)) && handleCouponDisplay();
            //             }
            //             else {
            //                 $scope.message = true;
            //             }

            //             function handleCouponDisplay() {
            //                 $('#couponsModal').modal('show');
            //                 window.localStorage.setItem('couponsDisplayed', Date.now());
            //             }

            //         });
            // });
        },
        link: function(scope, element) {

            scope.$on('$destroy', function() {
                element.remove();
            });

        }
    }
}])