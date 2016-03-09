angular.module('checkoutPage', [])

.directive('blurFocus', [function() {

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
	          		scope.checkoutForm.submitted = false;
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

.directive('checkoutPageHandler', ['api', function(api) {

	function addressModel() {
		this.fullName = '';
		this.email = '';
		this.address1 = '';
		this.address2 = '';
		this.city = '';
		this.state = '';
		this.country = '';
		this.pincode = '';
		this.contactNumber = '';
		this.addressType = {
			shipping : '',
			billing : ''
		};
	}

	return {
		restrict: 'A',
		scope: true,
		controller: function($scope) {

			var editMode = false,
				addressToChange;

			$scope.addressDetails = new addressModel();
			$scope.showAddressesAndForm = false;
			$scope.shippingAddress = '';
			$scope.billingAddress = '';
			$scope.savedAddresses = [];
			$scope.paymentDetails = {
				method: ''
			};

			fetchAddresses();	

			//Fetch countries list to show in select box
			api.http('/countryList.json').then(function(data) {
		        $scope.countries = data;

		        angular.forEach($scope.countries, function(country) {
		            $scope.addressDetails.country = $scope.countries[100];
		        });
		    });

			$scope.confirmCheckout = function() {

				if($scope.checkoutForm.$valid) {
					var names = $scope.addressDetails.fullName.split(' ');

					api.post('rapiv1/address/save', {
						editMode: editMode ? 1: 0,
						addressID: editMode ? $scope.addressDetails.addressID : '',
						firstName: names[0],
						lastName: names.splice(1).join(' '),
						email: $scope.addressDetails.email,
						address1: $scope.addressDetails.address1,
						address2: $scope.addressDetails.address2,
						city:     $scope.addressDetails.city,
						state:    $scope.addressDetails.state,
						country:  $scope.addressDetails.country.name,
						zipcode:  $scope.addressDetails.pincode,
						phoneNo:  $scope.addressDetails.contactNumber,
						addressType: (+$scope.addressDetails.addressType.shipping) + (+$scope.addressDetails.addressType.billing)
					}).then(function(data) {

						if(data.isValid && data.result.created) {
							fetchAddresses();
						}

						//Clear form after submission
						$scope.clearForm();
						
					});

				}
				else {
					console.log('INVALID')
					$scope.checkoutForm.submitted = true;
				}
			};

			$scope.editAddress = function(address)  {
				$scope.clearForm();
				
				$scope.addressDetails.fullName = address.firstName + ' ' + address.lastName;
				$scope.addressDetails.address1 = address.address1;
				$scope.addressDetails.address2 = address.address2;
				$scope.addressDetails.city = address.city;
				$scope.addressDetails.state = address.state;
				$scope.addressDetails.country = $scope.countries[$scope.countries.indexOfObject('name', address.country)];
				$scope.addressDetails.pincode = address.zipCode;
				$scope.addressDetails.contactNumber = address.mobile;
				$scope.addressDetails.addressID = address.addressID;
				
				switch(+address.addressType) {
					case 1:
						$scope.addressDetails.addressType.shipping = 1;
						$scope.addressDetails.addressType.billing = 0;
						break;
					case 2:
						$scope.addressDetails.addressType.shipping = 0;
						$scope.addressDetails.addressType.billing = 2;
						break;
					case 3:
						$scope.addressDetails.addressType.shipping = 1;
						$scope.addressDetails.addressType.billing = 2;
						break;
				};

				editMode = true;

			};

			$scope.changeAddress = function(addressType) {
				addressToChange = addressType;
				$scope.showAddressesAndForm = true;
			};

			$scope.selectAddress = function(address) {
				if(addressToChange == 1) {
					//Shipping
					$scope.shippingAddress = address;
				}
				else if(addressToChange == 2) {
					//Billing
					$scope.billingAddress = address;
				}

				$scope.showAddressesAndForm = false;
			};

			$scope.deleteAddress = function(address) {
				var addressID = address.addressID;

				if(address) {
					api.get('rapiv1/address/delete/' + addressID).then(function(data) {
						if(data.result.deleted) {
							$scope.savedAddresses.deleteObject('addressID', addressID);

							if($scope.shippingAddress.addressID == addressID) {
								$scope.shippingAddress = '';
							}

							if($scope.billingAddress.addressID == addressID) {
								$scope.billingAddress = '';
							}
						}
					});
				}
			};

			$scope.clearForm = function() {
				$scope.checkoutForm.$setPristine();
				$scope.checkoutForm.submitted = false;
				editMode = false;
				$scope.addressDetails = new addressModel();
			};

			$scope.$watch('paymentDetails.method', function(val) {
				if(!val) return;

				api.get('rapiv1/checkout/setPaymentMethod/' + $scope.shippingAddress.addressID + '/' + $scope.billingAddress.addressID + '/' + val).then(function(data) {
					var data = data.result,
						nonCODProducts;

					$scope.proceedToPay = function() {

						if(!(data.validParams && data.addressExists && data.stateDataExists && data.addressSet && data.paymentOptionSet)) {
							return;
						}

						if(data.paymentOptionConflict) {
							//Some products don't have COD
							nonCODProducts = data.nonCODProducts;

							if(window.confirm('COD is not available for ' + nonCODProducts.length + ' products in your cart, they will be dropped from this order. Do you wish to continue?')) {
								//Continue to pay
								checkState();
							}
							else {
								return;
							}

						}
						else {
							//No conflict
							checkState();

						}

						function checkState() {
							if(data.stateSaved.saved) {
								//Continue to pay
							}
							else {
								//
								window.alert('Some error occured on the server, we apologise for the inconvenience. Please try again after some time.');
							}
						}

					};

				});

			});

			function fetchAddresses() {
				//Fetch user's stored addresses
				api.get('rapiv1/address/read').then(function(data) {
					if(data.isLoggedIN) {
						if(+data.totalResults > 0) {
							$scope.savedAddresses = data.result;
							// $scope.addressCount = +data.totalResults;

							$scope.shippingAddress = $scope.savedAddresses.sort(function(add1, add2) {
								return (+add1.lastUsed) - (+add2.lastUsed);
							})[0];

							$scope.billingAddress = angular.copy($scope.shippingAddress);
							window.scrollTo(0, 0);
						}
						else {
							$scope.showAddressesAndForm = true;
						}
						
					}
				});
			}

		},
		link: function(scope, element, attrs) {
			scope.checkoutForm.submitted = false;

		}
	}

}])