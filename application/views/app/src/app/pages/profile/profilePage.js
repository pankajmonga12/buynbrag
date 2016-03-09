angular.module('profilePage', ['facebookInvite', 'editFancyList'])


.factory('fancyListService', [function() {
    var list = '';

    return {
        setList: function(data) {
            list = data;
        },
        getList: function() {
            return list;
        }
    }
}])



function facebookConnected() {
    window.fbConnectWindow.close();
    angular.element('#loginModal').scope().logUserIn();
}