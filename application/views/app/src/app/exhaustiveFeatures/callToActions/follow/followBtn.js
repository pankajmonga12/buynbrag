angular.module('directives.follow', []).directive('btnFollow', ['api', '$route' ,'user', '$timeout', function(api, $route, user, $timeout) {
    return {
        restrict: 'E',
        scope: {
            usertofollow: '@',
            hasFollowed: '@',
            followers: '@'
        },
        templateUrl: function(tElement, tAttrs) {
            if(typeof tAttrs.url !== 'undefined') {
                return tAttrs.url;
            }
            else {
                return '/application/views/app/src/app/exhaustiveFeatures/callToActions/follow/followBtn.html';
            }
        },
        link: function(scope, element, attrs) {

            /********** Initialise **********/ 
            var txtFollow = 'Follow',
                txtUnfollow = 'Unfollow';

            /************* Watchers ************/
            attrs.$observe("hasFollowed", function(val) {
                if((val == 1) || (val === "true")) {
                    scope.followText = txtUnfollow;
                    scope.activeClass = false;
                }
                else {
                    scope.followText = txtFollow;
                    scope.activeClass = true;
                }
            });

            attrs.$observe('usertofollow', function(val) {
                $timeout(function() {
                    scope.followBtnVisible = (val == user.getuser()) ? false : true;
                }, 600);
            });

            /*********** Scope methods ************/
            scope.triggerFollow = function() {
                if(user.getloginstatus()) {
                    if(scope.followText === txtFollow) {
                        follow();
                    }
                    else if(scope.followText === txtUnfollow) {
                        unFollow();
                    }
                }
                else {
                   $("#loginModal").modal("show"); 
                }
            };

            /******** Local Functions ********/ 
            function follow() {
                scope.$broadcast("showSpinner");
                scope.followText = txtUnfollow;
                scope.activeClass = false;

                if(scope.followers) {
                    scope.followers = +(scope.followers) + 1;
                }

                api.get('rapiv1/profile/follow/' + user.getuser() + '/' + scope.usertofollow).then(function(data) {
                    
                     scope.$broadcast("hideSpinner");
                     var evntPage =  $route.current.action.split(".")[0] + "_page";
                     _bnbAnalytics.registerFollow(user.getuser(), user.getEmail(), evntPage, scope.usertofollow);
                    
                });
            }

            function unFollow() {
                scope.$broadcast("showSpinner");
                scope.followText = txtFollow;
                scope.activeClass = true;

                if(scope.followers) {
                    scope.followers = +(scope.followers) - 1;
                }

                api.get('rapiv1/profile/unFollow/' + user.getuser() + '/' + scope.usertofollow).then(function(data) {
                    
                    scope.$broadcast("hideSpinner");
                    
                });
            }

        }
    }
}]);