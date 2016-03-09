angular.module("profileComplete", [])

.directive('specialBlur', [function() {

	var BLUR_CLASS = "ng-blurred";

  	return {
	    restrict: 'A',
	    require: 'ngModel',
	    link: function(scope, element,attrs, ctrl) {
	    	
	      	ctrl.$blurred = false;

	      	element.bind('keydown', function() {
	        	element.removeClass(BLUR_CLASS);
	        	scope.$apply(function() {
	          		ctrl.$blurred = false;
	          		scope.fillProfile.submitted = false;
	        	});
	      	});

	      	element.bind('blur', function() {
	        	element.addClass(BLUR_CLASS);
	        	scope.$apply(function() {
	          		ctrl.$blurred = true;
	        	});
	      	});

	    }
	}
}])

.controller("ProfileFillController", ["$scope", "$rootScope", "$window", "api", "$http", "user", function($scope, $rootScope, $window, api, $http, user) {

	function range(a, b, step){
	    var A= [];
	    if(typeof a== 'number'){
	        A[0]= a;
	        step= step || 1;
	        while(a+step<= b){
	            A[A.length]= a+= step;
	        }
	    }
	    else{
	        var s= 'abcdefghijklmnopqrstuvwxyz';
	        if(a=== a.toUpperCase()){
	            b=b.toUpperCase();
	            s= s.toUpperCase();
	        }
	        s= s.substring(s.indexOf(a), s.indexOf(b)+ 1);
	        A= s.split('');        
	    }
	    return A;
	}

	$scope.register = {
				fullName: '',
				country: '',
				state: '',
				gender: '',
				dobYear: '',
				dobMonth: '',
				dobDate: ''
			};

	$scope.$on("userLoggedIn", function() {
		var dobFields = typeof $rootScope.user.userdata.dob === 'string' ? $rootScope.user.userdata.dob.split("-") : new Array(3);

		$scope.register.fullName = $rootScope.user.userdata.name;
		$scope.register.state = $rootScope.user.userdata.city;
		// $scope.register.country = $rootScope.user.userdata.country;
		$scope.register.gender = $rootScope.user.userdata.gender;
		$scope.register.dobYear = dobFields[0];
		$scope.register.dobMonth = dobFields[1];
		$scope.register.dobDate = dobFields[2];
	});					
							
	$scope.years = range(1930, (new Date()).getFullYear()).reverse();

	//Get countries list
	$http.get('/countryList.json').then(function(data) {
		$scope.countries = data.data;

		angular.forEach($scope.countries, function(country) {
				$scope.register.country = $scope.countries[100];
		});
	});

	$scope.updateProfile = function() {
				
				if($scope.fillProfile.$valid) {

					api.post('rapiv1/profile/saveNewUserDetails/' + user.getuser(), {
			            fName: $scope.register.fullName,
			            dd: $scope.register.dobDate,
			            mm: $scope.register.dobMonth,
			            yyyy: $scope.register.dobYear,
			            sex: $scope.register.gender,
			            city: $scope.register.state,
			            cc: $scope.register.country.code
			        }).then(function(data) {
			            var response = data.data;

			            if(response.updateOK) {

                            setTimeout(function(){
                                $window.location.reload();
                            },1000);
			            }
			        });

				}
				else {
					$scope.fillProfile.submitted = true;
				}

			};

}])