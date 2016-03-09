var compress = angular.module('filters.compress', []);

compress.filter("compress", [function() {

    return function(text) {

        return text && (text.replace(/\W/g, ' ')).trim().replace(/\s+/g, '');

    }

}]);