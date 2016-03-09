angular.module('addthis', [])

.directive('addthisShare', ['$filter', function($filter) {
    return {
        restrict: 'E',
        replace: true,
        template: '<div class="shareItemIcon pull-right">' +
                    '<a class="addthis_button_compact" href=""></a>' +
                  '</div>',
        link: function(scope, element, attrs) {

            var share_obj = {
                url: 'http://buynbrag.com/#/product/' + $filter('beautify')(scope.img.productName) + '/' + scope.img.productID,
                title: scope.img.productName
            };

            var addthis_config = {
                "data_track_addressbar":true,
                "data_track_clickback" : true,
                "data_ga_tracker" : 'UA-35785264-1',
                "data_ga_social" : true,
                "services_expanded" : 'facebook,twitter,google_plusone_share,pinterest,email',
                "services_compact" : 'facebook,twitter,google_plusone_share,pinterest,email',
                "services_exclude" : 'thefancy,print,yahoomail',
        //        "ui_click" : true,
        //        "ui_header_background" : "#000",
        //        "ui_use_css" : false,
                "ui_use_addressbook" : true
            };
            
            addthis.button(element[0].children[0], addthis_config, share_obj);

        }
    }
}]);