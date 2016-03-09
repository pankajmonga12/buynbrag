angular.module('cartPage', ['services.cart'])

.directive('cartpagecheckout', ["api", "requestContext", "cart", 'user',
    function(api, requestContext, cart, user) {

        return {
            restrict: 'A',

            scope: true,

            controller: function($scope) {

                /**************************************************************/
                /********************* Route Specific *************************/
                /**************************************************************/
                var renderContext = requestContext.getRenderContext("cart");
                $scope.subview = renderContext.getNextSection();

                $scope.$on("requestContextChanged", function() {

                    if (!renderContext.isChangeRelevant()) {
                        return;
                    }

                    $scope.subview = renderContext.getNextSection();
                });

                /**************************************************************/
                /*********************** Initialize ***************************/
                /**************************************************************/
                var unorderedCart = {};
                $scope.closeModal('checkoutModal');
                $scope.cartData = {};
                $scope.showSpinner = false;
                $scope.emptyCart = false;

                cart.get().then(function(data) {

                    if (Object.keys(data.stores).length < 1) {
                        $scope.emptyCart = true;
                        return;
                    }

                    $scope.cartData = data;

                });

                $scope.$watchCollection('[cartData.discount, cartData.totalAmount]', function(val) {
                    $scope.cartData.totalPayable = $scope.cartData.totalAmount - $scope.cartData.discount;
                });

                $scope.updateCart = function(item) {

                    $scope.showSpinner = true;

                    cart.updateCart(item).then(function() {
                        $scope.showSpinner = false;
                    });

                };

                $scope.deleteCartItem = function(item) {
                    $scope.showSpinner = true;

                    cart.deleteCartItem(item).then(function() {
                        $scope.cartData.stores[item.storeID].itemCount -= 1;
                        $scope.showSpinner = false;
                    });

                };

                $scope.removeCoupon = function() {
                    cart.removeCoupon();
                };

                $scope.saveCart = function() {
                    api.get('rapiv1/checkout/init/1').then(function(response) {

                    });
                };


            },

            link: function(scope, element, attrs) {




            }

        }

    }
])



.directive('useCouponsModal', ['user', 'cart',
    function(user, cart) {

        // CouponType ---   Meaning
        // 0                percentage discount
        // 1				Rupees discount
        // 5				Rupess discount on a specific category
        // 8				percentage discount on a specific store

        var couponsHtmlRef = {
            0: [undefined, '% off - Site wide'],
            1: ['Rs ', undefined, ' off - Site wide'],
            5: ['Rs ', undefined, ' off - ', undefined, ' category only'],
            8: [undefined, '% off -', undefined, ' store only']
        };

        var rupeeCoupons = [1, 5],
        	storeCoupons = [8],
        	categoryCoupons = [5];

        var couponPropertiesToUse = ['couponValue', 'param1'];


        return {
            restrict: 'A',
            scope: true,
            controller: function($scope) {
                var couponsObject = user.getUserCoupons(),
                    availableCoupons = [];

                $scope.errorMessage = '';

                angular.forEach(couponsObject, function(coupon) {
                    availableCoupons.push(coupon);
                });

                angular.forEach(availableCoupons, function(coupon) {
                    var propertyCounter = 0,
                    	couponType = +coupon.couponType;

                    coupon['couponSpecifics'] = [];
                    if(storeCoupons.indexOf(couponType) > -1) {
                    	coupon['couponSpecifics'].push('store');
                    	coupon['couponSpecifics'].push(coupon.param1[1]);
                    }
                    else if(categoryCoupons.indexOf(couponType) > -1) {
                    	coupon['couponSpecifics'].push('category');	
                    	coupon['couponSpecifics'].push(coupon.param1[1]);
                    }

                    coupon['couponText'] = couponsHtmlRef[+coupon.couponType].map(function(ref) {
                        if (ref) {
                            return ref;
                        } else {
                            return coupon[couponPropertiesToUse[propertyCounter++]];
                        }
                    }).join('');

                    coupon['discountType'] = (rupeeCoupons.indexOf(+coupon['couponType']) > -1) ? 'Rs' : 'perc';

                });

                availableCoupons.splice(0, 0, {
                    couponText: 'Select from your available coupons'
                });

                $scope.availableCoupons = angular.copy(availableCoupons);
                $scope.selectedCoupon = $scope.availableCoupons[0];
                $scope.discount = 0;
                delete availableCoupons;

                $scope.redeemCoupon = function() {

                    cart.applyCoupon($scope.selectedCoupon).then(
                    	function(data) {
	                        if (data) {
	                            $scope.closeModal('couponSelectModal');
	                        }
                    	}, function(error) {
                    		
                    		switch(error) {
                    			case 'minimumAmountError':
                    				$scope.errorMessage = 'Your cart amount should be greater than';
                    				break;
                    			case 'storeCouponNotApplicable':
                    				$scope.errorMessage = "You don't have product of store in your cart";
                    		};

                    	}
                    );
                };

            },
            link: function(scope, element, attrs) {

                scope.$on('$destroy', function() {
                    element.remove();
                });

            }
        }
    }
])