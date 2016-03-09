angular.module('directives.fancy', [])

.directive("btnFancy", ["user", "api", "$route", "$timeout", "$rootScope", "$analytics", "bragService", function(user, api, $route, $timeout, $rootScope, $analytics, bragService) {
    
    var fancyClass = "hasBragged",
        fancyText = 'Brag',
        fanciedText = 'Edit';

    return {
        restrict: "E",
        scope: {
            storeId: "@sid",
            productId: "@pid",
            userName: "@uname",
            productName: "@pname",
            hasFancied: "@",
            fancyCounter: "=?"
        },
        // templateUrl: '/application/views/app/src/app/exhaustiveFeatures/callToActions/brag/bragBtn.html',
        templateUrl: function(tElement, tAttrs) {
            if(typeof tAttrs.url !== 'undefined') {
                return tAttrs.url;
            }
            else {
                return '/application/views/app/src/app/exhaustiveFeatures/callToActions/brag/bragBtn.html';
            }
        },
        controller: function($scope) {

        },
        link: function(scope, element, attrs, ctrl) {

            /********** Initialise **********/ 
            var fancied = !1,
                productData = '';

            /************* Watchers ************/
            attrs.$observe("hasFancied", function(val) {
                if(+val === 1) {
                    scope.fanciedClass = fancyClass;
                    scope.productFanciedClass = api.ctaActivatedClass;
                    scope.fancyText = fanciedText;
                }
                else {
                    scope.fanciedClass = '';
                    scope.productFanciedClass = '';
                    scope.fancyText = fancyText;
                }
            });

            /*********** Scope methods ************/ 
            scope.triggerFancy = function() {
                if( user.getloginstatus() ) {

                    productData = {
                        pid: scope.productId,
                        sid: scope.storeId,
                        uname: scope.userName,
                        pname: scope.productName
                    };

                    bragService.set(productData);
                    $rootScope.openModal('fancyListModal');

                    $analytics.eventTrack('click', {category: 'Brag', label: scope.productName});

                    //Execute when product gets fancied
                    $rootScope.$on('PRODUCTFANCIED', function() {
                        if(fancied) return;
                        scope.fanciedClass = fancyClass;
                        scope.productFanciedClass = api.ctaActivatedClass;
                        scope.fancyText = fanciedText;

                        if(window.location.href.match('product')) {
                            if(scope.$parent.hasFancied && scope.$parent.hasFancied == 0) {
                                scope.$parent.hasFancied = 1;
                            }
                        }
                                   
                        user.updatefancycount();

                        if(typeof scope.fancyCounter !== 'undefined') {
                            scope.fancyCounter++;    
                        }
                        
                        fancied = !0;
                        
                    });
                }
                else {
                    $("#loginModal").modal("show");
                }

            };

        }
    }
}])

.factory('bragService', [function() {
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

.directive('fancyList', ['$route', '$rootScope', '$timeout', '$cacheFactory', '$analytics', 'api', 'user', 'bragService', function($route, $rootScope, $timeout, $cacheFactory, $analytics, api, user, bragService) {

    return {
        restrict: 'A',
        scope: true,
        controller: function($scope) {

            /********** Initialise **********/ 
            var editFancy = !1,
                selectedList = '';

            $scope.listName = '';
            $scope.userFancyLists = [];
            $scope.product = bragService.get();
            readFancyList();

            api.get('rapiv1/profile/inFancyList/' + $scope.product.pid).then(
                function(data) {
                    if(data && data.data && data.data[0].fancyListID) {
                        selectedList = data.data[0].fancyListID;
                        $scope.selectedList = selectedList;
                        editFancy = !0;   
                    }                        
                }
            );

            

            /*********** Scope methods ************/ 
            $scope.selectList = function(list) {
                $scope.selectedList = list.fancyListID;
            };

            $scope.createNewList = function($event) {
                // if($event && $event.keyCode === 13) {
                //     $event.preventDefault();

                // }
                if(!$scope.listName) return;
                
                api.post('rapiv1/profile/saveFancyList', {listName: $scope.listName}).then(
                    function(data) {
                        var bragListCache;

                        if(data && data.data && data.data.saved) {
                            $scope.listName = '';
                            var newList = data.data['0'];
                            // $scope.userFancyLists.unshift(newList);
                            $scope.selectedList = newList.fancyListID;

                            //Update brag lists cache
                            bragListCache = api.getHttpCacheObject('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser());
                            
                            bragListCache.data.fancyListsData.unshift({
                                fancyListDescription: null,
                                fancyListID: newList.fancyListID,
                                fancyListName: newList.fancyListName,
                                totalFanciedProducts: 0
                            });

                            api.updateHttpCache('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser(), bragListCache);

                            //Update brag lists
                            readFancyList();
                        }

                    }, function(error) {

                    }
                );
            };

            $scope.fancyProduct = function() {

                if(editFancy) {
                    api.post('rapiv1/profile/moveToFancyList', {fromListID: selectedList, toListID: $scope.selectedList, productID: $scope.product.pid}).then(
                        function(data) {
                            editFancy = !1;

                            //Update brag list counts
                            var bragListCache = api.getHttpCacheObject('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser());
                            bragListCache.data.fancyListsData.findObject('fancyListID', selectedList).totalFanciedProducts--;
                            bragListCache.data.fancyListsData.findObject('fancyListID', $scope.selectedList).totalFanciedProducts++;
                            api.updateHttpCache('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser(), bragListCache);

                            //If editing from profile page, remove product from fancy list view
                            console.log($scope.subview);
                            if($scope.subview === 'profileHeader') {
                                $rootScope.$broadcast('PRODUCTEDITED', {productData: $scope.product});
                            }

                            $analytics.eventTrack('movedToAnotherList', {category: 'Brag', label: $scope.product.pname});

                        }, function(error) {
                            
                        }
                    );
                }
                else {
                    api.post("async/fancy2/" + $scope.product.pid, {listID: $scope.selectedList}).then(
                        function(data) {
            
                            if( !data.error ) {

                                if( data.fancy && !data.alreadyFancied ) {
                                    //Update total fancy count for profile page info
                                    var profileInfoCache = api.getHttpCacheObject("/index.php/rapiv1/profile/info/" + user.getuser());
                                    profileInfoCache && profileInfoCache.data.userInfo[0].totalFanciedProducts++;

                                   //Notify product scope that product has been added to fancy list
                                   $rootScope.$broadcast('PRODUCTFANCIED');

                                   //Update brag list counts
                                   var bragListCache = api.getHttpCacheObject('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser());
                                   if(bragListCache) {
                                        bragListCache.data.fancyListsData.findObject('fancyListID', $scope.selectedList).totalFanciedProducts++;
                                        api.updateHttpCache('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser(), bragListCache);
                                   }

                                   //Analytics specific
                                    var fancyPath =  $route.current.action.split(".")[0] + "_page";
                                    $analytics.eventTrack('bragged', {category: 'Brag', label: $scope.product.pname});
                                    //console.log("ANALYTICS ++++  brag btn from bragBtn.js" );
                                    _bnbAnalytics.fancySuccess($scope.product.pid, $scope.product.pname, $scope.product.sid, data.catID, data.subCatID1, fancyPath);                               
                                }
                            }
                            else {
                                
                            }
                        }, function(error) {
                            
                        }
                    );    
                }
                
            };

            // this.bragOnFB = function() {
            //     var params = {};

            //         params['message'] = $scope.product.uname + " has acquired bragging rights for " + ($scope.product.pname).substring(0,42) + "... !! After all, brag is the new love! :)";
            //         params['name'] = 'BuynBrag.com';
            //         params['description'] = 'You can also acquire bragging rights for this product by logging on to www.buynbrag.com';
            //         params['link'] = "http://www.buynbrag.com/";
            //         params['picture'] = 'http://buynbragstores.s3.amazonaws.com/assets/images/stores/' + $scope.product.sid + '/' + $scope.product.pid + '/img1_171x171.jpg';
            //         params['caption'] = 'is your destination for everything hard-to-find';

            //         FB.getLoginStatus(function(logResponse) {

            //             if (logResponse.status === 'connected') {

            //                 var accessToken = logResponse.authResponse.accessToken;

            //                 FB.api('/me/feed', 'post', params, function (response) {

            //                     if (!response || response.error) {

            //                         console.log('Fb FFF Badly');

            //                     }
            //                     else {

            //                         api.get("brag_ajax/product_brag?store_id=" + $scope.product.sid + "&product_id=" + $scope.product.pid).then(function(data) {


            //                         });

            //                     }

            //                 });

            //             }

            //         });   
            // };

            /******** Local Functions ********/ 
            function readFancyList() {
                api.get('rapiv1/profile/fancyListDetails/' + user.getuser(), true).then(
                    function(data) {
                        if(data && data.data && data.data.fancyListsData) {
                            $scope.userFancyLists = data.data.fancyListsData;
                        }

                    }, function(error) {

                    }
                );
            }

        },
        link: function(scope, element, attrs, ctrl) {

            // scope.$on('PRODUCTFANCIED', function() {
            //     $timeout(function() {
            //         if(element.find('#postOnFB')[0].checked) {
            //             ctrl.bragOnFB();
            //         }
            //     }, 300);
            // });

            scope.$on('$destroy', function() {
                element.remove();
            });

        }
    }
}])