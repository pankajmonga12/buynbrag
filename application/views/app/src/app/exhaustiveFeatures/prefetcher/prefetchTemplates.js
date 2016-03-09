angular.module('prefetchTemplates', [])

.directive('prefetchTemplates', ['$window', '$rootScope', '$templateCache', '$http', 'api', function($window, $rootScope, $templateCache, $http, api) {

	var routes = {
		'home': '/application/views/app/src/app/pages/home/home.html',
		'allStores': '/application/views/app/src/app/pages/allStores/allStores.html',
		'category': '/application/views/app/src/app/pages/category/categories.html',
		'store': '/application/views/app/src/app/pages/store/store.html',
		'search': '/application/views/app/src/app/pages/search/search.html',
		'cart': '/application/views/app/src/app/pages/cart/checkoutCart.html',
		'checkout': '/application/views/app/src/app/pages/cart/checkout2.html',
		'trends': '/application/views/app/src/app/pages/trends/trends.html',
		'profile': '/application/views/app/src/app/pages/profile/profileHeader/profileHeader.html',
		'people': '/application/views/app/src/app/pages/people/people.html',
		'product': '/application/views/app/src/app/pages/product/product.html',
		'couponsModal': '/application/views/app/src/app/exhaustiveFeatures/independentModals/coupons/coupons.html',
		'bragModal': '/application/views/app/src/app/exhaustiveFeatures/callToActions/brag/bragList.html',
		'braggedByModal': '/application/views/app/src/app/exhaustiveFeatures/independentModals/fanciedBy/usersList.html',
		'searchProductsView': '/application/views/app/src/app/pages/search/searchProducts.html',
		'searchStoresView': '/application/views/app/src/app/pages/search/searchStores.html',
		'searchUsersView': '/application/views/app/src/app/pages/search/searchUsers.html',
		'profileBragListView': '/application/views/app/src/app/pages/profile/fancyList/fancyList.html',
		'profileAllBragsView': '/application/views/app/src/app/pages/profile/allBrags/allBrags.html',
		'profileDetailedBragListView': '/application/views/app/src/app/pages/profile/fancyListView/fancyListView.html',
		'profileBadgesView': '/application/views/app/src/app/pages/profile/badges/badges.html',
		'profileSocialView': '/application/views/app/src/app/pages/profile/social/social.html',
		'profileAboutView': '/application/views/app/src/app/pages/profile/about/about.html',
		'profileSettingsView': '/application/views/app/src/app/pages/profile/settings/settings.html',
		'editBragListModal': '/application/views/app/src/app/pages/profile/editFancyListModal.html',
		'cartPreviewModal': '/application/views/app/src/app/exhaustiveFeatures/callToActions/cart/cartModal.html',
		'redeemCouponModal': '/application/views/app/src/app/pages/cart/redeemCouponModal.html'
	};

	var pageRelations = {
		'home': 		[
							{name: 'bragModal', priority: 1},
							{name: 'braggedByModal', priority: 2},
						],
		'allStores': 	[
							{name: 'store', priority: 1},
						],
		'category': [],
		'store' : 	[],
		'cart' :        [
							{name: 'redeemCouponModal', priority: 1},
							{name: 'checkout', priority: 2}
						],
		'search': 		[
							{name: 'searchProductsView', priority: 1},
							{name: 'searchStoresView', priority: 2},
							{name: 'searchUsersView', priority: 3}
						],
		'trends': 	[],
		'profileHeader': 		[
							{name: 'profileBadgesView', priority: 3},
							{name: 'profileBragListView', priority: 1},
							{name: 'profileSocialView', priority: 2},
							{name: 'profileAboutView', priority: 5},
							{name: 'profileSettingsView', priority: 6},
							{name: 'profileAllBragsView', priority: 7},
						],
		'fancy' : 		[
							{name: 'profileDetailedBragListView', priority: 1}
						],
		'list' : 		[
							{name: 'bragModal', priority: 1},
							{name: 'editBragListModal', priority: 2}
						],
		'product': []
	};

	var alwaysAccessibleViews = [
		{name: 'home', priority: 1},
		{name: 'allStores', priority: 7},
		{name: 'category', priority: 4},
		{name: 'profile', priority: 3},
		{name: 'product', priority: 2},
		{name: 'people', priority: 11},
		{name: 'cart', priority: 10},
		{name: 'search', priority: 5},
		{name: 'trends', priority: 6},
		{name: 'couponsModal', priority: 8},
		{name: 'cartPreviewModal', priority: 9}
	];

	var hasOnloadTriggered = false;

	return {
		restrict: 'A',
		controller: function($scope) {

		},
		link: function(scope, element, attrs) {

			scope.$watch('subview', function(view) {

				api.httpRequestsFinished().then(function() {
					if(hasOnloadTriggered) {
						prefetchViews(pageRelations[scope.subview]);
					}
				});

			});

			angular.element($window).on('load', function() {
				hasOnloadTriggered = true;
				prefetchViews(alwaysAccessibleViews);
			});

			function prefetchViews(viewsList) {

				if(!viewsList || viewsList.length === 0) return;

				var sortedViews = viewsList.sort(function(a, b) {
					return a.priority - b.priority;
				});

				prefetch();

				function prefetch() {
					var n = 0,
						url;

					sortedViews.splice(0,6).forEach(function(view) {
						// if(!view) return;
						url = routes[view.name];

						if($templateCache.get(url)) {
							prefetchMoreIfAllLoaded();
							return;
						}

						$http.get(url, {cache :$templateCache}).then(
							function(data) {
								// $templateCache.put(url, data);
								prefetchMoreIfAllLoaded();

							}, function(error) {
								prefetchMoreIfAllLoaded();
							}
						);

					});

					function prefetchMoreIfAllLoaded() {
						console.log(n);						
						(++n === 6) && (sortedViews.length > 0) && prefetch();
					}

				}

			}
			

		}
	}
}])