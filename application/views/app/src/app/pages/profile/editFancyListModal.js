angular.module('editFancyList', [])

.directive('editFancylist', ['$location', '$rootScope', '$cacheFactory', 'user', 'api', function($location, $rootScope, $cacheFactory, user, api) {

	return {
		restrict: 'A',
		// scope: true,
		controller: function($scope) {
			var listPointer;

			$scope.$on('editFancyListModal', function(event, data) {
				listPointer = data.list;
				$scope.listCopy = angular.copy(data.list);
				$scope.editableListName = $scope.listCopy.fancyListName;
				$scope.editableListDescription = $scope.listCopy.fancyListDescription;
			});

			$scope.updateListData = function() {
				var lName = $scope.editableListName,
					lDesc = $scope.editableListDescription;

				$scope.editableListName = '';
				$scope.editableListDescription = '';

				if($scope.listCopy.fancyListName != lName) {
					api.post('rapiv1/profile/updateFancyListName', {listID: $scope.listCopy.fancyListID, listName: lName}).then(
						function(data) {
							if(data && data.data && data.data.saved) {
								listPointer.fancyListName = lName;
								var bragListCache = api.getHttpCacheObject('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser());
								
								bragListCache.data.fancyListsData.findObject('fancyListID', $scope.listCopy.fancyListID).fancyListName = lName;
                            	api.updateHttpCache('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser(), bragListCache);
							}
						}, function(error) {

						}
					);	
				}

				if($scope.listCopy.fancyListDescription != lDesc) {
					api.post('rapiv1/profile/saveFancyListDescription', {listID: $scope.listCopy.fancyListID, listDesc: lDesc}).then(
						function(data) {
							if(data && data.data && data.data.saved) {
								//Update fancy list description on collections view via cache
								var bragListCache = api.getHttpCacheObject('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser());
								bragListCache.data.fancyListsData.findObject('fancyListID', $scope.listCopy.fancyListID).fancyListDescription = lDesc;
								api.updateHttpCache('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser(), bragListCache);

								//Update fancy list name on collections detailed view
								listPointer.fancyListDescription = lDesc;
							}
						}, function(error) {

						}
					);	
				}

				angular.element('#editFancyListModal').modal('hide');
			};

			$scope.deleteList = function(list) {
				api.post('rapiv1/profile/deleteFancyList', {listID: list.fancyListID}).then(
					function(data) {
						if(data && data.data && data.data.result) {
							
							var bragListCache = api.getHttpCacheObject('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser()),
								listsArray = bragListCache.data.fancyListsData;

							listsArray.deleteObject('fancyListID', list.fancyListID);
							
							api.updateHttpCache('/index.php/rapiv1/profile/fancyListDetails/' + user.getuser(), bragListCache);
							angular.element('#editFancyListModal').modal('hide');
							$location.path('profile/fancy/' + user.getuser());
						}
					}
				);
			};

		},
		link: function(scope, element, attrs) {

			// scope.$on('$destroy', function() {
   //              element.remove();
   //          });

		}
	}
}])