angular.module('directives.share', [])

.directive('shareBtns', ['user', 'socialMessages', function(user, socialMessages) {    

	return {
		restrict: 'E',
        replace: true,
		scope: {
            urltoshare : '@',
            productname : '@'
        },
        // template: '<button class="shareBtn icon icon-export" ng-click="addToolbox()"></button>',
        template: '<div id="toolbox" class="shareBtn"></div>',
		link: function(scope, element, attrs) {

            attrs.$observe('urltoshare', function(url) {
                if(url) {
                    element.attr('addthis:url', url);
                    element.attr('addthis:title', scope.productname);
                    element.append('<a class="addthis_button_compact"><img src="/assets/images/shareIcon.png" width="20" height="20"/></a>');
                    addthis.toolbox(element[0]);
                }                
            });

		}
	}
}])


.factory("socialMessages", ["$filter", function($filter) {

    return {
        fancyOnFacebook: function(userName, productName, storeId, productId) {
            var params = {};

            params['message'] = userName + " has added " + productName.substring(0,42) + " to their fancy list!";
            params['name'] = 'Discover more on BuynBrag.com';
            params['description'] = 'You can also curate your own fancy list and share it with friends.';
            params['link'] = "http://www.buynbrag.com/#/product/" + $filter('beautify')(productName) + "/" + productId;
            params['picture'] = 'http://buynbragstores.s3.amazonaws.com/assets/images/stores/' + storeId + '/' + productId + '/img1_171x171.jpg';
            params['caption'] = 'Bringing back the FUN in shopping.';

            window.FB.getLoginStatus(function(logResponse) {
                if (logResponse.status === 'connected') {
                    var accessToken = logResponse.authResponse.accessToken;

                    window.FB.api('/me/feed', 'post', params, function (response) {
                        if (!response || response.error) {
                            console.log('Could not brag', response);
                        }
                        else {
                            console.log('Bragged');
                        }
                    });

                }

            }); 
        }
    }

}])