angular.module('services.hoverTimestamp', [])
.factory('hoverTimestamp', [function() {
	var timestamp;

	return {
		generateTimestamp: function() {
			timestamp = Date.now();
		},
		timestampDiff: function() {
			return Date.now() - timestamp;
		}
	}
}])