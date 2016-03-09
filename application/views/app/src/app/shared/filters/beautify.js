angular.module('filters.beautify', [])
.filter("beautify", [function() {

    return function(text) {

        return text && (text.replace(/\W/g, ' ')).trim().replace(/\s+/g, '-');

    }

}]);