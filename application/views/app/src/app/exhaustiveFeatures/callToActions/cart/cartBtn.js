angular.module('directives.cart', ['directives.loadingSpinner', 'services.cart'])

.directive("btnCart", ["user", "cart", "api", function(user, cart, api) {
    var txtBuy = 'Buy now',
        txtInCart = 'In Your Cart',
        txtUnavailable = 'Out of stock',
        inCartClass = 'inYourCart';

    return {
        restrict: "E",
        scope: {
            pid: "@",
            sid: "@",
            sp: "@",
            pname: "@",
            quantity: "@",
            color: "@",
            size: "@",
            selectedquantity: "@"
        },
        templateUrl: function(tElem, tAttrs) {
            if(typeof tAttrs.url !== 'undefined') {
                return tAttrs.url;
            }
            else {
                return '/application/views/app/src/app/exhaustiveFeatures/callToActions/cart/cartBtnHome.html'
            }
        },
        controller: function($scope) {

        },
        link: function(scope, element, attrs, ctrl) {

            var productIDAvailable = false,
                quantityAvailable = false,
                disableCartButton = false,
                productID;

            scope.cartClass = '';

            //Initialize Cart button when product changes
            attrs.$observe("pid", function(pid) {
                productIDAvailable = true;
                productID = pid;
                canLoadText();
            });  

            attrs.$observe("quantity", function(n) {
                quantityAvailable = true;
                canLoadText();
            });

            scope.$on('ITEMREMOVEDFROMCART', function($event, data) {
                if(data.productID == scope.pid) {
                    scope.cartClass = '';
                    scope.productCartClass = '';
                    disableCartButton = false;
                }
            });

            scope.buyProduct = function() {
                if(user.getloginstatus()) {
                    if(!disableCartButton) {
                        addToCart();
                    }
                }
                else {
                    $("#loginModal").modal('show');
                }
                
            };

            //Sets Cart button text
            function loadText(pid) {

                if(user.getloginstatus()) {
                    cart.ready().then(function() {
                        if(cart.inCart(pid)) {
                            scope.cartText = txtInCart;
                            scope.cartClass = inCartClass;
                            scope.productCartClass = api.ctaActivatedClass;
                            disableCartButton = true;
                        }
                        else {
                            if(+scope.quantity < 1) {
                                scope.cartText = txtUnavailable;
                                disableCartButton = true;
                            }
                            else {
                                scope.cartText = txtBuy;
                            }
                        }
                    });

                }

            }

            //Adds product to user cart and updates cart, also disabled the cart button
            function addToCart() {

                scope.$broadcast("showSpinner");

                var uid = user.getuser(),
                    color = scope.color || 0,
                    size = scope.size || 0,
                    quantity = scope.selectedquantity || 1,
                    params = scope.pid + "/" + color + "/" + size + "/" + uid + "/" + scope.sid + "/" + quantity;

                api.get("async/addToCart/" + params).then(function(data) {

                    if( data.addedProduct ) {

                        //Product added to Cart, disable cart button and update user cart
                        scope.$broadcast("hideSpinner");
                        scope.cartText = txtInCart;
                        scope.cartClass = inCartClass;
                        scope.productCartClass = api.ctaActivatedClass;
                        disableCartButton = true;
                        cart.refresh(true);

                    }

                });

            } 

            function canLoadText() {
                if(productIDAvailable && quantityAvailable) {
                    disableCartButton = false;
                    loadText(productID);
                }
            }          

            //Reset Cart button when quantity changes, if it was disabled
            // scope.$watch("selectedquantity", function(val) {

            //     (val > 1) && scope.disableButton && resetCartButton();

            // });            

        }
    }
}])

.directive("cartmodalcheckout", ['cart', 'user', 'api', '$rootScope', function(cart, user, api, $rootScope) {

    return {
        restrict: "A",
        scope: true,
        controller: function($scope) {
            $scope.cartData = {};
            $scope.showSpinner = false;
            $scope.emptyCart = false;

            cart.get().then(function(data) {

                if(Object.keys(data.stores).length < 1) {
                    $scope.emptyCart = true;
                    return;
                }

                $scope.cartData = data;
                console.log($scope.cartData)

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
                    $scope.showSpinner = false;
                });
            };

        },
        link: function(scope, element, attrs) {

            scope.$watch('showSpinner', function(val) {
                var modalBody = element.find('.modal-body');

                if(modalBody[0]) {
                    modalBody[0].style.overflow = val ? 'hidden' : '';    
                }
                
            });

            scope.$on('$destroy', function() {
                element.remove();
            });

        }
    }
}])