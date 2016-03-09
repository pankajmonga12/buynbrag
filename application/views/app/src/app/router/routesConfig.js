angular.module('router.routesConfig', [])

.config(function($routeProvider, $locationProvider, $provide) {

    // $provide.decorator('$sniffer', function($delegate) {
    //         $delegate.history = false;
    //         return $delegate;
    //     });

    $routeProvider
            .when(
                "",
                {
                    action: "home.default"
                }
            )
            .when(
                "/",
                {
                    action: "home.default"
                }
            )
            .when(
                "/#_=_",
                {
                    action: "home.default"
                }
            )
            .when(
                "/home",
                {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                    action: "home.default"
                }
            )
            .when(
                "/users",
                {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                    action: "users.default"
                }
            )
            .when(
                "/trends/:cityName",
                {
                    action: "trends.default"
                }
            )
            .when(
                "/dealofday",
                {
                    action: "dealofday.default"
                }
            )
            .when(
                "/allStores",
                {
                    action: "allStores.default"
                }
            )
            .when(
                "/allStores/:categoryName/:categoryID",
                {
                    action: "allStores.default"
                }
            )
            .when(
                "/product/:productName/:productID",
                {
                    action: "product.default"
                }
            )
            .when(
                "/store/:storeName/:storeID",
                {
                    action: "store.default"
                }
            )
            .when(
                "/store/:storeName/:storeSectionName/:storeID/:storeSectionID",
                {
                    action: "store.default"
                }
            )
            .when(
                "/storeDisabled/:storeID",
                {
                    action: "storeDisabled.default"
                }
            )
            .when(
                "/storeDisabled/:storeID/:storeSectionID",
                {
                    action: "storeDisabled.default"
                }
            )
            .when(
                "/Furniture/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Furniture/:categoryName*\/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Decor-Furnishing/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Decor-Furnishing/:categoryName*\/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Dining/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Dining/:categoryName*\/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Lighting/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Lighting/:categoryName*\/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Fashion/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Fashion/:categoryName*\/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Gifts-Collectibles/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Gifts-Collectibles/:categoryName*\/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Art/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/Art/:categoryName*\/:categoryID",
                {
                    action: "categories.default"
                }
            )
            .when(
                "/inviteFriends",
                {
                    action: "inviteFriends.default"
                }
            )
            .when(
                "/inviteStatus",
                {
                    action: "inviteStatus.default"
                }
            )
            .when(
                "/login",
                {
                    action: "login.default"
                }
            )
            .when(
                "/register",
                {
                    action: "register.default"
                }
            )
            .when(
                "/404",
                {
                    action: "404.default"
                }
            )
            .when(
                "/contact",
                {
                    action: "contact.default"
                }
            )
            .when(
                "/forSellers",
                {
                    action: "forSellers.default"
                }
            )
            .when(
                "/aboutUs",
                {
                    action: "aboutUs.default"
                }
            )
            .when(
                "/policies",
                {
                    action: "policies.default"
                }
            )
            .when(
                "/search/products/:searchKey",
                {
                    action: "search.products"
                }
            )
            .when(
                "/search/stores/:searchKey",
                {
                    action: "search.stores"
                }
            )
            .when(
                "/search/people/:searchKey",
                {
                    action: "search.people"
                }
            )
            .when(
                "/cart",
                {
                    action: 'cart.default'
                }
            )
            .when(
                "/checkout",
                {
                    action: 'checkout.default'
                }
            )
            .when(
                "/profile/fancy/:userID",
                {
                    action: "profileHeader.fancy"
                }
            )
            .when(
                "/profile/allBrags/:userID",
                {
                    action: "profileHeader.allBrags"
                }
            )
            .when(
                "/profile/mutualproducts/:userID",
                {
                    action: "profileHeader.mutualproducts"
                }
            )
            .when(
                "/profile/fancy/:userID/list/:listID",
                {
                    action: "profileHeader.list"
                }
            )
            .when(
                "/profile/badges/:userID",
                {
                    action: "profileHeader.badges"
                }
            )
            .when(
                "/profile/social/:userID",
                {
                    action: "profileHeader.social"
                }
            )
            .when(
                "/profile/about/:userID",
                {
                    action: "profileHeader.about"
                }
            )
            .when(
                "/profile/settings/:userID",
                {
                    action: "profileHeader.settings"
                }
            )
            .when(
                "/profile/purchaseHistory",
                {
                    action: "profileHeader.purchaseHistory"
                }
            )
            .when(
                "/reset/:resetHash",
                {
                    action: "reset.default"
                }
            )
            .otherwise(
                {
                    redirectTo: "/home"
                }
            );

            $locationProvider.html5Mode(true).hashPrefix('!');
    
})

