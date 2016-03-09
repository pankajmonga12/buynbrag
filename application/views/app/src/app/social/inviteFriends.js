angular.module('inviteFriends', [])

.controller("InviteController", ["$scope", "api", "user", "dataService", function($scope, api, user, dataService) {

    var options = {
        contenturl: 'http://dm234.buynbrag.com/#/home',
        clientid: '647407892758.apps.googleusercontent.com',
        cookiepolicy: 'http://buynbrag.com',
        prefilltext: 'Invitation to join BuynBrag',
        calltoactionlabel: 'INVITE',
        calltoactionurl: 'http://dm234.buynbrag.com/#/home?invite=true'
    };

    $scope.showFriends = false;
  
    $scope.inviteFriend = function() {

        api.post("invite/email",
                                {
                                    inviteeEmailAddress: $scope.invite.emails
                                }
        ).then(function(data) {

            console.log(data)
            data[1].savedInvite && data[1].hash && alert("Invitation successfully sent!");

        });

    };

    $scope.inviteFacebookFriends = function() {

        var msg = user.getName() + " has invited you to join BuynBrag. Discover amazing designs, brag the things you love, unlock amazing deals!";

        FB.ui(
            {
                method: 'apprequests',
                message: msg,
                filters: ["app_non_users"]
            }, 
            function(response) {

                if(!response) return;

                var request_ids = "";

                for (var i = 0; i < response.to.length; i++) {

                    response.request + "_" + response.to[i];

                    if (request_ids.length > 0) {

                        request_ids = request_ids + ',' + response.request + "_" + response.to[i];

                    }                    
                    else {

                        request_ids = response.request + "_" + response.to[i];

                    }
                }

                api.post("invite/fbInvite/save", {"request_ids" : request_ids}); 

        });
    };

    $scope.inviteGooglePlusFriends = function() {

        window.gapi.interactivepost.render('sharePost', options);

    };

    $scope.inviteGmailFriends = function() {
        
    };

    $scope.inviteTwitterFriends = function() {

        api.get("twitterLogin/isConnected").then(function(data) {

            if(data.isConnected) {

                $scope.getTwitterFollowers();

            }
            else {

                window.tw_window = window.open("/twitterLogin/index", '_blank', 'height=500,width=700,left=250,top=100,resizable=yes', true );

            }
        });
    };

    $scope.getTwitterFollowers = function() {

        api.get("twitterLogin/followers").then(function(data) {

            dataService.setData(data);

            $scope.showFriends = false;

        });

    };

}])

.controller("FriendsController", ["$scope", "api", "dataService", function($scope, api, dataService) {

    var selected = [];

    $scope.showFriends = false;

    $scope.$on("friendsAvailable", function() {

        var followers = dataService.data.users;

        angular.forEach(followers, function(val, key) {

            val["checked"] = false;

        });

        $scope.twitterFollowers = followers;
        $scope.showFriends = true;

    });

    $scope.toggleAll = function(bool) {

        angular.forEach($scope.twitterFollowers, function(val, key) {

            console.log(bool);
            val["checked"] = bool;

        });

    };

    $scope.sendInvites = function() {

        selected = [];

        angular.forEach($scope.twitterFollowers, function(val, key) {

            (val.checked == true) && selected.push(val.id);

        });

        api.post("twitterLogin/sendMessage", {

            followerIDs: selected

        });
    };

}])

.controller("InviteStatusController", ["$scope", "api", function($scope, api) {

    $scope.inviteStatus = {
        0: "Invitation Sent",
        1: "Joined",
        2: "Already Registered"
    };

    $scope.invitedFriends = api.get("invite/invlist", 1);

}]);