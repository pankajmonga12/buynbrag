angular.module('services.cart', ['services.api'])

.factory('cart', ['api', '$rootScope', '$q', 'user', function(api, $rootScope, $q, user) {

    var cart,
        cartDataAvailable = false,
        couponApplied = false;

    //Cart Structure
    // cart = {
    //     stores: {},
    //     totalAmount: 0,
    //     discount: 0,
    //     totalPayable: 0,
    //     itemsDistinctCount: 0,
    //     itemsTotalCount: 0
    // };

    function range(num) {
         var i = 1,
            quantity = [];

        while(i <= parseInt(+num)) {
            quantity.push({"num": i});
            i++;
        }

        return quantity;
    }

    function storeProductInCart(storeID) {
        return cart['stores'][storeID] ? true : false;
    }

    return {

        applyCoupon: function(coupon) {
            //applies coupon on cart or specific products
            var defer = $q.defer(),
                couponValid = true;

            //Validate coupon
            if(coupon.couponSpecifics.length > 0) {
                //Coupon is applicable on a category or store
                if(storeProductInCart(coupon.param1[0])) {
                    //Store product is present
                    if(+coupon.minPurchaseAmount > cart.totalAmount) {
                        //Cart amount is not greater than or equal to minimum purchase amount
                        defer.reject('minimumAmountError');
                        couponValid = false;
                    }

                }
                else {
                    couponValid = false;
                    defer.reject('storeCouponNotApplicable');
                }
            }
            else {
                //Coupon applicable site wide
                if(+coupon.minPurchaseAmount > cart.totalAmount) {
                    //Cart amount is not greater than or equal to minimum purchase amount
                    couponValid = false;
                    defer.reject('minimumAmountError');
                }
            }

            if(couponValid) {

                api.get('cart/redeemCoupon?coupon_id=' + coupon.couponID + '&totalPurchaseAmount=' + cart.totalAmount).then(function(data) {

                    if(data.isValidCoupon && data.isValidUser && data.isValidAmount && data.sessionSet) {
                        cart.discount = +data.redeemedPrice;
                        cart.totalPayable = cart.totalAmount - cart.discount;
                        couponApplied = true;
                        cart.coupon = coupon;
                        defer.resolve(true);
                    }
                    else {
                        defer.resolve(false);
                    }

                });

            }            

            return defer.promise;
        },

        calculateTotalCartAmount: function() {
            //calculates total cart amount
            cart.totalAmount = 0;

            angular.forEach(cart.stores, function(store) {
                angular.forEach(store.items, function(item) {
                    cart.totalAmount += (+item.totalPayable);
                });
            });
        },

        deleteCartItem: function(item) {
            //Deletes item from cart
            var defer = $q.defer(),
                self = this;

            api.get('cart/deleteItem/' + item.cartID).then(
                function(data) {
                    if(data && data.result) {
                        delete cart.stores[item.storeID].items[item.productID];
                        $rootScope.user.userdata.cartcount -= 1;
                        self.calculateTotalCartAmount();
                        $rootScope.$broadcast('ITEMREMOVEDFROMCART', {productID: item.productID});
                        defer.resolve();
                    }
                }
            );

            return defer.promise;            
        },

        get: function() {
            //If cart is already initialized, return it; else fetch new cart data and inititalize cart
            var defer = $q.defer();

            if(cart && Object.keys(cart.stores).length > 0) {
                defer.resolve(cart);
            }
            else {
                this.refresh().then(function() {
                    defer.resolve(cart);
                });
            }

            return defer.promise;
        },

        initialize: function(data, variants) {
            //Inititalizes cart
            var variantsDictionary = {};

            cart = {
                stores: {},
                coupon: '',
                totalAmount: 0,
                discount: 0,
                totalPayable: 0,
                itemsDistinctCount: 0,
                itemsTotalCount: 0
            };

            if(variants && variants.toString() === '[object Object]' && Object.keys(variants).length > 0) {
                var variantName, variantQuantity, variantColor, variantSize;

                angular.forEach(variants, function(variant){
                    if(!variantsDictionary[variant.productID]) {
                        variantsDictionary[variant.productID] = {
                            colorVariants: [],
                            sizeVariants: []
                        };
                    }

                    variantName = variant.variantName;
                    variantQuantity = variant.variantQuantity;

                    if( variantName && variantName.toUpperCase() === "COLOR" ) {
                        variantColor = variant.variantColor;
                        variantColor && variantsDictionary[variant.productID]['colorVariants'].push({"color": variantColor, "variantQuantity": variantQuantity});
                    }
                    else if(variantName && variantName.toUpperCase() === "SIZE") {
                        variantSize = variant.variantSize;
                        variantSize && variantsDictionary[variant.productID]['sizeVariants'].push({"size": variantSize, "variantQuantity": variantQuantity});
                    }

                });

            }

            if(data && data.toString() === '[object Object]' && Object.keys(data).length > 0) {

                angular.forEach(data, function(item) {
                    var discountedPrice = (+item.isOnDiscount === 1) ? (+item.originalPrice - (+item.discountAmount)) : (+item.originalPrice),
                        quantityRange = [];

                    if(!cart.stores[item.storeID]) {
                        cart.stores[item.storeID] = {
                            items: {},
                            storeName: item.storeName,
                            storeID: item.storeID,
                            itemCount: 0
                        };
                    }

                    item['sellingPrice'] = discountedPrice;
                    item['totalPayable'] = discountedPrice*(item.quantity);
                    item['dispatchDate'] = Date.now() + (+item.processingTime + 5)*86400000;
                    item['quantityRange'] = range(item.availableQuantity);
                    item['variants'] = variantsDictionary[item.productID] || {colorVariants: [], sizeVariants: []};
                    item['selectedQuantity'] = item['quantityRange'][item['quantityRange'].indexOfObject('num', +item.quantity)];

                    if(item.vcolor.length > 1) {
                        item['selectedColor'] = item['variants']['colorVariants'][item['variants']['colorVariants'].indexOfObject('color', item.vcolor)];
                    }

                    if(item.vsize.length > 1) {
                        item['selectedSize'] = item['variants']['sizeVariants'][item['variants']['sizeVariants'].indexOfObject('size', item.vsize)];
                    }            

                    cart.totalAmount += (+item.totalPayable);
                    cart.itemsTotalCount += (+item.quantity);
                    cart.itemsDistinctCount += 1;

                    cart.stores[item.storeID].items[item.productID] = item;
                    cart.stores[item.storeID].itemCount += 1;
                });

                cart.totalPayable = cart.totalAmount - cart.discount;

                $rootScope.user.userdata.cartcount = cart.itemsDistinctCount;

            }

        },

        inCart: function(productID) {
            //Returns whether product is in cart or not
            var productInCart = false;

            if(cart) {
                angular.forEach(cart.stores, function(store) {
                    angular.forEach(store.items, function(item) {
                        if(item.productID == productID) {
                            productInCart = true;
                        }
                   });

                });
            }

            return productInCart;
            // else {
            //     //If cart is not initialized already, fetch cart, inititalize it, then check if product is in cart or not
            //     this.refresh().then(function() {
            //         isProductInCart();
            //     });
            // }

            // function isProductInCart() {
            //     //Function that checks whether product is in cart
            //     angular.forEach(cart.stores, function(store) {
            //         angular.forEach(store.items, function(item) {
            //             if(item.productID == productID) {
            //                 productInCart = true;
            //             }
            //        });

            //     });

            //     defer.resolve(productInCart);
            // }

            // return defer.promise; 
        },

        ready: function() {

            var defer = $q.defer(),
                stop;

            if(cartDataAvailable) {
                defer.resolve();
            }
            else {
                stop = window.setInterval(function() {
                    if(cartDataAvailable) {
                        clearInterval(stop);
                        defer.resolve();
                    }
                }, 100);
            }


            return defer.promise;
        },

        refresh: function(flag) {
            //Fetches new cart data and initializes cart
            var self = this,
                defer = $q.defer();

            api.get('async/cartData').then(
                function(data) {
                    if(data && data[1]) {
                        self.initialize(data[1].cartData, data[1].productsVariants);
                        cartDataAvailable = true;
                        defer.resolve();

                        if(flag) {
                            $rootScope.openModal('checkoutModal', {dummy: 'dummy'});
                        }
                    }
                }
            );

            return defer.promise;
        },

        removeCoupon: function() {

            if(couponApplied) {
                api.get('cart/removeCoupon').then(function(data) {
                    if(data.couponFound && data.couponRemoved) {
                        couponApplied = false;
                        cart.coupon = '';
                        cart.discount = 0;
                    }
                });
            }


        },

        updateCart: function(item) {
            //Updates a cart product. Update can be new product variant or it's quantity
            var defer = $q.defer(),
                self = this,
                uid = user.getuser(),
                color = typeof(item.selectedColor) != 'undefined' ? item.selectedColor.color : 0,
                size = typeof(item.selectedSize) != 'undefined' ? item.selectedSize.size : 0,
                quantity = typeof(item.selectedQuantity) != 'undefined' ? item.selectedQuantity.num : 1,
                params = item.productID + '/' + color + '/' + size + '/' + uid + '/' + item.storeID + '/' + quantity;

            api.get('async/addToCart/' + params).then(
                function(data) {
                    if(data.addedProduct) {
                        item.vcolor = color;
                        item.vsize = size;
                        item.quantity = quantity;
                        item.totalPayable = (+item.sellingPrice)*(+item.selectedQuantity.num);
                        self.calculateTotalCartAmount();
                        
                        defer.resolve();
                    }
                }
            );

            return defer.promise;            
        }

        
    }
}])