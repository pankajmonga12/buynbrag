angular.module("loginRegisterModule", ["services.api"])


.directive('ngBlur', [function() {

	var BLUR_CLASS = "ng-blurred";

  	return {
	    restrict: 'A',
	    require: 'ngModel',
	    link: function(scope, element,attrs, ctrl) {
	    	
	      	ctrl.$blurred = false;
	      	console.log(scope);

	      	element.bind('keydown', function() {
	        	element.removeClass(BLUR_CLASS);
	        	scope.$apply(function() {
	          		ctrl.$blurred = false;
	          		scope.signin_form.submitted = false;
	          		scope.register_form.submitted = false;
	          		scope.resetForm.submitted = false;
	          		scope.wrongPassword = false;
	          		scope.reset.message = '';
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

.directive('loginRegister', [function() {

	return {
		restrict: 'A',
		controller: function($scope) {
			
		},
		link: function(scope, element, attrs) {

		}
	}
}])

.directive("user", ["$window", "$timeout", "api", "$http", "$location", "$routeParams", "$rootScope", function($window, $timeout, api, $http, $location, $routeParams, $rootScope) {

	function getParameter(paramName) {
	  var searchString = window.location.search.substring(1),
	      i, val, params = searchString.split("&");

	  for (i=0;i<params.length;i++) {
	    val = params[i].split("=");
	    if (val[0] == paramName) {
	      return val[1];
	    }
	  }
	  return null;
	}

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

	return {
		restrict: "A",
		controller: function($scope) {
			$rootScope.stylesheets = [{href: '/application/views/app/styles/landing.css'}];
		},
		link: function(scope, element, attrs) {

			/******** Initialize **********/
			var urlParam = $location.search(),
				userID, email;

			scope.signin_form.submitted = false;
			scope.register_form.submitted = false;
			scope.resetForm.submitted = false;
			scope.wrongPassword = false;

			scope.reset = {
				message: "",
				success: false
			};

			scope.login = {email: ''};
			scope.register = {
				fullName: '',
				country: '',
				state: ''
			};
			email = getParameter("eml");

			if(email) {
				document.getElementsByClassName("forgotPwd")[0].className += "hide";
				scope.firstStepClass = "active";
				scope.login.email = email;
			}
			else {
				scope.firstStepClass = "";
			}

			/******** Login autofill hack *********/
			var triggerStarted = false,
				monitorId;

			scope.$watch("login.email", function(val) {
				if(val && val.length > 0 && !triggerStarted) {
					triggerStarted = true;
					inputElem = angular.element(element.find("input")[1]);
					monitorId = window.setInterval(function() {
						inputElem.triggerHandler("input");
					}, 250);
				}
			});
			
			/******** Scope functions ********/
			scope.changeClass = function(cls) {
				scope.firstStepClass = cls;
			};

			scope.resetPassword = function() {

				if(scope.resetForm.$valid) {

					scope.$broadcast("showSpinner");

					api.post("async/forgotPassword/1", {
						email: scope.reset.email
					}).then(function(response) {

						scope.$broadcast("hideSpinner");

						if(!response.userExists) {
			                scope.reset.message = "User does not exist";
			            }
			            else {
			                if(response.hashGenerated) {
			                    if(!response.hashSaved || !response.emailSent) {
			                        scope.reset.message = "Server seems busy, please try after some time";
			                    }
			                    else if(response.emailSent) {
			                        scope.reset.message = '';
			                        scope.reset.success = true;
			                    }
			                }
			            }

					});
				}
				else {
					scope.resetForm.submitted = true;
				}
			};

			scope.signInLocal = function() {
				triggerStarted && window.clearInterval(monitorId);

				if (scope.signin_form.$valid) {
			      // Submit as normal
			      scope.$broadcast("showSpinner");

			      api.post("async/login", {
						signin_email: scope.login.email,
						signin_pw: scope.login.password
					}).then(function(data) {

						var loginResponse = data[0],
							userDetails = data[1],
							userAccount = data[2];

						// scope.$broadcast("hideSpinner");
						
						if(loginResponse.sessionSet && loginResponse.validCredentials && userAccount.userExists && loginResponse.isActive == 1) {
							//User successfully logged in, take him to main site

                            $window.location.reload();
						}
						else if(!loginResponse.sessionSet && userAccount.userExists && !loginResponse.validCredentials) {
							scope.$broadcast("hideSpinner");
							scope.wrongPassword = true;
						}
						else if(userAccount.newUserCreated || (loginResponse.validCredentials && userAccount.userExists && loginResponse.isActive == 0)) {
							scope.$broadcast("hideSpinner");
							userID = userAccount.newUserCreated ? userAccount.newUserID : loginResponse.ID;
							scope.showFinalForm = true;

							scope.years = range(1930, (new Date()).getFullYear()).reverse();					
							
							//Get countries list
							$http.get('/countryList.json').then(function(data) {
						        scope.countries = data.data;

						        angular.forEach(scope.countries, function(country) {
						            scope.register.country = scope.countries[100];
						        });
						    });
						}
					});
			    } 
			    else {
			      scope.signin_form.submitted = true;
			    }
			};

			scope.registerLocal = function() {
				
				if(scope.register_form.$valid) {
					scope.$broadcast("showSpinner");

					api.post('rapiv1/profile/saveNewUserDetails/' + userID, {
			            fName: scope.register.fullName,
			            dd: scope.register.dobDate,
			            mm: scope.register.dobMonth,
			            yyyy: scope.register.dobYear,
			            sex: scope.register.gender,
			            city: scope.register.state,
			            cc: scope.register.country.code
			        }).then(function(data) {
			            var response = data.data;

			            scope.$broadcast("hideSpinner");

			            if(response.updateOK) {           

			            	console.log("ANALYTICS +++++ log in register vars  " + userID + scope.login.email + scope.register.fullName + scope.register.gender + scope.register.dobDate + scope.register.dobMonth + scope.register.dobYear + scope.register.state + scope.register.country.name);
                            _bnbAnalytics.registerSuccess(userID, scope.login.email, scope.register.fullName, scope.register.gender, scope.register.dobDate, scope.register.dobMonth, scope.register.dobYear, scope.register.state, scope.register.country.name);

                            setTimeout(function(){
                                scope.subview = 'people';
                            },1000);
			            }
			        });

				}
				else {
					scope.register_form.submitted = true;
				}

			};
		}
	}
}]);