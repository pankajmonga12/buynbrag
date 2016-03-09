angular.module('services.user', [])

.factory("user", ["$rootScope", function($rootScope) {

    var userCoupons;
    
    return {

        setCoupons: function(coupons) {
            userCoupons = coupons;
        },

        getUserCoupons: function() {
            return userCoupons || null;
        },
        
        getBadgeData: function() {
            
            return $rootScope.user.badgesData;
        },
        getcartcount: function() {

            return $rootScope.user.userdata.cartcount;

        },
        getCity: function() {
            return (!$rootScope.user.userdata.city || $rootScope.user.userdata.city == 0) ? false : $rootScope.user.userdata.city; 
        },
        getEmail: function() {

            return $rootScope.user.userdata.email;

        },
        getfbID: function() {

            return $rootScope.user.userdata.fbid;

        },
        getloginstatus: function() {

            return $rootScope.user.userdata.loggedin; 

        },
        getName: function() {

            return $rootScope.user.userdata.name;

        },
        getuser: function() {

            return $rootScope.user.userid;

        },        
        updatefancycount: function() {

            $rootScope.user.userdata.fancy += 1;

        }
    }
}]);