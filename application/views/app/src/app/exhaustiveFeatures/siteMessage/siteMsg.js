angular.module('siteMessage', [])

.controller("siteMsgController", ["$scope", "user", "$timeout", function($scope, user, $timeout) {

    $scope.newClass = '';
    $scope.message = '';

    $timeout(function() {
        if(!user.getloginstatus() && ($('#midSection').width() > 599)) {
            document.body.className += " siteMsgActive";
            $scope.newClass ='active';
            $scope.message = '<a href="#registerModal" role="button" data-toggle="modal">Register now </a>& get <span class="bnbRedFont"><i class="icon-fontawesome-webfont-5"></i>2500&#42;</span> worth of free shopping vouchers.';

//            var elem = document.getElementById("midSection");
//            elem.className = elem.className + " siteMsgActive";

            // if(!checkCookie()){
            //     setTimeout(function(){
            //         $("#homePageTourModal").modal("show");
            //     }, 30000);
            // }
        }
    },20000);

}]);