var api = angular.module('services.api', []);

api.factory("api",["$http", "$rootScope", "$cacheFactory", "$q", function($http, $rootScope, $cacheFactory, $q) {

    var header = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': "application/json; charset=utf-8"
        //'4de4dd657c84d944809a672758c11065293ace81': $cookies['83f2a208758ce1325a822a86553c6779']
    };

    var httpCache = $cacheFactory.get('$http'),
        xhrData;

    return {

        ctaActivatedClass: 'btn-selected',

        get: function(url, cacheFlag, ignoreLoadingBar) {
            return ignoreLoadingBar

                    ?   $http({
                            method: "GET",
                            url: "/index.php/" + url,
                            ignoreLoadingBar: true,
                            cache: cacheFlag || false 
                        }).then(function(response) {
                            return response.data;
                        })

                    :   $http({
                            method: "GET",
                            url: "/index.php/" + url,
                            cache: cacheFlag || false 
                        }).then(function(response) {
                            return response.data;
                        })
        },

        http: function(url) {
            return $http({
                method : 'GET',
                url : url
            }).then(function(response) {
                return response.data;
            });
        },

        post: function(u, d) {

            return $http({
                            method: "POST",
                            url: "/index.php/" + u,
                            data: $.param(d),
                            headers: header
                        }
                        ).then(function(response) {
                            return response.data;
                    });
        },

        httpRequestsFinished : function() {
            var defer = $q.defer(),
                intervalId;

            intervalId = window.setInterval(function() {
                if($http.pendingRequests.length === 0) {
                    clearInterval(intervalId);
                    defer.resolve();
                }
            }, 200);

            return defer.promise;
        },

        getHttpCacheObject: function(url) {
            xhrData = httpCache.get(url);
            return xhrData ? JSON.parse(xhrData[1]) : null;
        },

        updateHttpCache: function(url, data) {
            httpCache.remove(url);
            xhrData[1] = JSON.stringify(data);
            httpCache.put(url, xhrData);
        },

        productImage: function(sid, pid) {

            return $rootScope.s3baseUrl + sid + "/" + pid + "/";

        },

        userImageFb: function(id, dimension) {

            return 'https://graph.facebook.com/' + id + '/picture?width=' + dimension + '&height=' + dimension;

        },

        userImageBnb: function(gender) {

            return (gender === "female") ? ('/assets/images/default/female.png') : ('/assets/images/default/male.png');

        }
    }
}]);