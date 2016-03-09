angular.module('fancyProducts', [])

.directive('bragProducts', ['$rootScope', '$window', 'api', function($rootScope, $window, api) {

	return {
		restrict: 'A',
		controller: function($scope) {
			var page = 0;

			$scope.productsFancied = 3;

			$scope.loadNext = function() {
				api.get('rapiv1/ldata/get/' + page).then(function(data) {
					if(data.result) {
						$scope.productsToFancy = data.result;
						page++;
					}
				});
			};

			$scope.switchView = function() {
				if($scope.productsFancied >= 3) {
					$scope.$emit('PEOPLEVIEW');
				}
			};

			$scope.$watch('productsFancied', function(count) {
				if(count < 3) {
//					$scope.buttonText = 'Fancy ' + (3 - count) + ' more!';
					$scope.buttonText = (3 - count) + ' more';
				}
				else {
					$scope.buttonText = 'Continue';
				}
				
			});

			$scope.loadNext();
		},
		link: function(scope, element, attrs) {

		}
	}
}])

.directive('bragThis', ['api', function(api) {

	var braggedClass = 'hasBragged',
		productsBragged = [];

	return {
		restrict: 'E',
		scope: {
			pid: '@',
			sid: '@',
			uname: '@',
			pname: '@'
		},
		// templateUrl: '/application/views/app/src/app/user/bragBtn.html',
		templateUrl: function(tElement, tAttrs) {
            if(typeof tAttrs.url !== 'undefined') {
                return tAttrs.url;
            }
            else {
                return '/application/views/app/src/app/user/bragBtn.html';
            }
        },
		controller: function($scope) {

			// function bragOnFB() {
			// 	var params = {};

   //                  params['message'] = $scope.uname + " has acquired bragging rights for " + ($scope.pname).substring(0,42) + "... !! After all, brag is the new love! :)";
   //                  params['name'] = 'BuynBrag.com';
   //                  params['description'] = 'You can also acquire bragging rights for this product by logging on to www.buynbrag.com';
   //                  params['link'] = "http://www.buynbrag.com/";
   //                  params['picture'] = 'http://buynbragstores.s3.amazonaws.com/assets/images/stores/' + $scope.sid + '/' + $scope.pid + '/img1_171x171.jpg';
   //                  params['caption'] = 'is your destination for everything hard-to-find';

   //                  FB.getLoginStatus(function(logResponse) {

   //                      if (logResponse.status === 'connected') {

   //                          var accessToken = logResponse.authResponse.accessToken;

   //                          FB.api('/me/feed', 'post', params, function (response) {

   //                              if (!response || response.error) {

   //                                  console.log('Fb FFF Badly');

   //                              }
   //                              else {

   //                                  api.get("brag_ajax/product_brag?store_id=" + $scope.sid + "&product_id=" + $scope.pid).then(function(data) {


   //                                  });

   //                              }

   //                          });

   //                      }

   //                  });   
			// };

			$scope.triggerBrag = function() {
				if(!$scope.braggedClass) {
					$scope.braggedClass = braggedClass;
	                $scope.$parent.$parent.productsFancied++;
	                
					api.get("async/fancy2/" + $scope.pid).then(function(data) {
						
	                    if( data.fancy && !data.alreadyFancied ) {

	                    	productsBragged.push($scope.pid);

	                    	_bnbAnalytics.fancySuccess($scope.pid, $scope.pname, $scope.sid, data.catID, data.subCatID1, 'Registration_Flow');

	                    	//Brag on FB
	                    	// bragOnFB();
	                    }
	                });
				}
			};
		},
		link: function(scope, element, attrs, ctrl) {

			attrs.$observe('pid', function(pid) {
				scope.braggedClass = productsBragged.indexOf(pid) > -1
					? braggedClass
					: '';
			});

			scope.$parent.$parent.productsFancied = productsBragged.length;

		}
	}
}])