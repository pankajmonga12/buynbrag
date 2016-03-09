var highlight = angular.module('filters.highlight', []);

highlight.filter("highlight", [function() {
    return function(text, key) {
        var index = (text.toLowerCase()).indexOf(key.toLowerCase());
        var first = text.substring(0, index);
        var middle = text.substring(index, index + key.length);
        var last = text.substring(index + key.length);

        return first + '<strong>' + middle + '</strong>' + last;
    }
}]);