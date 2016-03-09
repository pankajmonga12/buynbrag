var logApp = angular.module( "logApp", ["ngUpload"] );

logApp.controller("logController", function($scope, $rootScope, $http, $location) {

	var  baseUrl = 'http://' + $location.host() + '/' ;

	$scope.manifestIDs = '' ;
	$scope.mfID = '';
	$scope.batchIDs = '';
	$scope.bcID = '';
	$scope.clicked = false;

	$http.get(baseUrl + 'index.php/logistic/manifestIDs').success(function(data) {

		$scope.manifestIDs = data.manifestIDs;
		$scope.mfID = $scope.manifestIDs[0];
	});

	$scope.$watch("mfID", function(newVal, oldVal) {
		if(newVal !== oldVal) {
			$http.get("/index.php/logistic/batchIDs/" + newVal.manifestID).success(function(data) {
				$scope.batchIDs = data.batchIDs;
				$scope.bcID = $scope.batchIDs[0];
			});
		}		
	});

	$scope.getBatchOrderData = function(bcID) {
		$http.get("/index.php/logistic/batchOrders/" + bcID.batchID).success(function(data) {
			$scope.awbs = data.batchOrders;
		});
	};

	$scope.showHiddenFields = function() {
		$scope.clicked = true;
	};

	$scope.showOriginalFields = function() {
		$scope.clicked = false;
	};

	$scope.editRemark = function(i, a, r) {
		$http.get("/index.php/logistic/saveRemark/" + i + "/" + a + "/" + r).success(function(data) {
			if(data.saveRemarkStatus) {
				$scope.getBatchOrderData($scope.bcID);
				$scope.clicked = false;
			}
		});
	};

	$scope.options = [
		{id:"0", text:"default/reserved/no idea"},
		{id:"1", text:"out for pickup"},
		{id:"2", text:"picked-up"},
		{id:"3", text:"in transit"},
		{id:"4", text:"out for delivery"},
		{id:"5", text:"delivered"},
		{id:"6", text:"problem with pickup"},
		{id:"7", text:"problem with delivery"}
	];

	$scope.orderStatus = [
		{id:"0", status:"Restart Processing/ Pending"},
		{id:"1", status:"Start Processing"},
		{id:"2", status:"Ready for Shipping"},
		{id:"3", status:"Completed"},
		{id:"4", status:"Problem With Order"},
		{id:"5", status:"Cancelled"}
	];
});