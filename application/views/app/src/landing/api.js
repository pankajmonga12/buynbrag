angular.module('services.api', [])

.factory("api",["$http", "$rootScope" , function($http, $rootScope) {

  var header = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': "application/json; charset=utf-8"
        //'4de4dd657c84d944809a672758c11065293ace81': $cookies['83f2a208758ce1325a822a86553c6779']
    };

  var param = function(obj)
    {
      var query = '';
      var name, value, fullSubName, subName, subValue, innerObj, i;
      
      for(name in obj)
      {
        value = obj[name];
        
        if(value instanceof Array)
        {
          for(i=0; i<value.length; ++i)
          {
            subValue = value[i];
            fullSubName = name + '[' + i + ']';
            innerObj = {};
            innerObj[fullSubName] = subValue;
            query += param(innerObj) + '&';
          }
        }
        else if(value instanceof Object)
        {
          for(subName in value)
          {
            subValue = value[subName];
            fullSubName = name + '[' + subName + ']';
            innerObj = {};
            innerObj[fullSubName] = subValue;
            query += param(innerObj) + '&';
          }
        }
        else if(value !== undefined && value !== null)
        {
          query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
        }
      }
      
      return query.length ? query.substr(0, query.length - 1) : query;
    };

    return {

        get: function(url) {
            return $http({
                            method: "GET",
                            url: "/index.php/" + url,
                            cache: false 
                        }).then(function(response) {
                            return response.data;
                        });
        },

        post: function(u, d) {

            return $http({
                            method: "POST",
                            url: "/index.php/" + u,
                            headers: header,
                            data: param(d)
                        }
                        ).then(function(response) {
                            return response.data;
                    });
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