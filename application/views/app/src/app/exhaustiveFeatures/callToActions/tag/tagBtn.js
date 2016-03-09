angular.module('directives.tag', ['facebookService'])

.directive("btnTag", ["$rootScope", "user", "api", "facebookFriends", "tagService", function($rootScope, user, api, facebookFriends, tagService) {

    return {
        restrict: "E",
        scope: {
            pid: '@',
            sid: '@',
            pname: '@'
        },
        templateUrl: '/application/views/app/src/app/exhaustiveFeatures/callToActions/tag/tagBtn.html',
        link: function(scope, element, attrs) {

            scope.triggerTag = function() {
                if(user.getloginstatus()) {
                    facebookFriends.isFBConnected().then(function(fbConnected) {
                        if(fbConnected) {
                            handleTagModal();
                        }
                        else {
                            facebookFriends.openFBLoginDialog().then(function(loginSuccess) {
                                if(loginSuccess) {
                                    handleTagModal();
                                }
                            });
                        }
                    });
                }
                else {
                    $("#fbSignUpModal").modal("show");
                }
            };

            function handleTagModal() {
                tagService.set({pid: scope.pid, sid: scope.sid, pname: scope.pname});
                $rootScope.openModal('tagFriendModal');    
            }
 
        }
    }    
}])

.factory('tagService', [function() {
    var productData;

    return {
        get: function() {
            return productData;
        },
        set: function(data) {
            productData = data;
        }
    }
}])

.directive('tagFriends', ['api', 'user', '$route', 'facebookFriends', '$filter', 'tagService', function(api, user, $route, facebookFriends, $filter, tagService) {

    return {
        restrict: 'A',
        scope: true,
        controller: function($scope) {

            $scope.showFriends = !1;
            $scope.friends = [];
            $scope.searchResults = [];
            $scope.friendKey = '';
            $scope.taggedFriends = [];
            $scope.inputWidth = '';

            calculateInputWidth.previousIndex = 0;

            if($scope.friends.length === 0) {
                facebookFriends.get().then(function(data) {
                    $scope.friends = data;
                });
            }

            $scope.product = tagService.get();

            $scope.$watch('friendKey.length', function(val) {
                if(val > 1) {
                    $scope.showFriends = !0;
                }
            });

            $scope.$watch('friendKey', function(val) {
                $scope.searchResults = $filter('filter')($scope.friends, {name: val});
            });

            $scope.$watch('taggedFriends.length', calculateInputWidth);

            function calculateInputWidth(val) {
                if(val === 0) {
                    calculateInputWidth.previousIndex = 0;
                }

                var totalNameLength = Array.prototype.join.call($scope.taggedFriends.slice(calculateInputWidth.previousIndex).map(function(friend) {
                                                                                            return friend.name;
                                                                                        })
                                        ).length,
                    width = 499 - (totalNameLength*8) - ($scope.taggedFriends.length + 1)*15;

                if(width > 96) {
                    $scope.inputWidth = width;
                }
                else {
                    $scope.inputWidth = 499;
                    calculateInputWidth.previousIndex = $scope.taggedFriends.length;
                }

            }

            $scope.addFriendToTag = this.addFriendToTag = function(friend) {
                // $scope.taggedFriends[friend.id] = friend;
                $scope.taggedFriends.push(friend);
                $scope.friendKey = '';
                $scope.showFriends = !1;
            };

            $scope.deleteFriendToTag = function(friend) {
                $scope.taggedFriends.deleteObject('id', friend.id);
            };

            this.isActive = function(item) {
                return $scope.active === item;
            };
            
        },
        link: function(scope, element, attrs, controller) {

            //Friend Selection through up & down arrows
            var inputElem;
            scope.active = null;

            inputElem = element.find("input");

            inputElem.on('keydown', onkeydown);
            inputElem.on('keyup', onkeyup);

            function onkeydown(event) {
                var code = event.keyCode;

                if(code === 38) {
                    //Up Arrow
                    event.preventDefault();
                    scope.$apply(function() {
                        var index = scope.searchResults.indexOf(scope.active);
                        scope.active = index === 0 ? null :  scope.searchResults[index - 1]; 
                    }); 
                }

                if(code === 40) {
                    //Down Arrow
                    event.preventDefault();
                    scope.$apply(function() {
                        var index = scope.searchResults.indexOf(scope.active);
                        scope.active = scope.searchResults[(index + 1) % scope.searchResults.length];
                    });
                }

                if(code === 9 || code === 13 || code === 27) {
                    //Escape for tab, enter & escape keys
                    event.preventDefault();
                }
            }

            function onkeyup(event) {
                var code = event.keyCode;

                if( code === 9 || code === 13) {
                    scope.$apply(function() { 
                        if(scope.active) {
                            controller.addFriendToTag(scope.active);
                        }
                        else {
                            scope.showFriends = false;
                            element.removeClass('searchActive');
                            inputElem.blur();
                        }
                    });
                }

                if(code === 27) {
                    controller.safeApply(function() { scope.showSuggestions = false; });
                }
            }

            scope.tagFriends = function(user) {

                var userList = Array.prototype.join.call(scope.taggedFriends.map(function(friend) {return '@[' + friend.id + ']' ;}), ' '),
                    productUrl = 'https://buynbrag.com/product/' + $filter('beautify')(scope.product.pname) + '/' + scope.product.pid;
                

                FB.api(
                    '/me/bnbbuynbrag:comment?message=' + userList,
                    'post',
                    {
                        product: productUrl
                    },
                    function(response) {
                        console.log(response);
                        var tagPath =  $route.current.action.split(".")[0] + "_page"; 
                        //console.log("tagsuccess tracked" + user.getEmail() + "  " + tagPath + "  " + scope.product.pid + "  " + scope.product.pname + "  " + scope.product.sid);
                        //_bnbAnalytics.tagSuccess(user.getEmail(), tagPath, scope.product.pid, scope.product.pname, scope.product.sid);
                    }
                );

            };

            scope.$on('$destroy', function() {
                element.remove();
            });

        }
    }
}])

.directive("activateItem", [function() {

    return {

        restrict: "A",
        require: "^tagFriends",
        link: function(scope, element, attrs, controller) {

            var item = scope.$eval(attrs.activateItem);

            scope.$watch(function() { return controller.isActive(item); }, function(active) {
                active ? element.addClass("active") : element.removeClass("active");
            });

            // element.bind("mouseenter", function() {
            //     scope.$apply(function() { controller.activate(item) });
            // });

            // element.bind("mousedown", function() {
            //     scope.$apply(function() { controller.selectActive(); });
            // });

        }

    }

}])