angular.module('profilePage')

.controller("BadgesListController", ["$scope", "api", "requestContext", function($scope, api, requestContext) {

    /**************************************************************/
    /********************* Route Specific *************************/
    /**************************************************************/
    var renderContext = requestContext.getRenderContext( "profileHeader.badges", "userID" );
    $scope.subview = renderContext.getNextSection();

    $scope.$on( "requestContextChanged", function() {        
        if ( ! renderContext.isChangeRelevant() ) {            
            return;
        }

        if(requestContext.hasParamChanged('userID')) {
            refreshView();
        }

        $scope.subview = renderContext.getNextSection();
    });

    /**************************************************************/
    /********************* Initialize *************************/
    /**************************************************************/    
    var badgesReference = {
        1: {
            type: "explore",
            subType: "stores",
            hint: "The more you wander, the better it gets ;)"
        },
        3: {
            type: "follow",
            subType: "stores",
            hint: "Be a store guide..."
        },
        4: {
            type: "brag",
            subType: "products",
            hint: "Don't be shy, spread the love!"
        },
        6: {
            type: "buy",
            subType: "products",
            hint: "Ding! Sold! ;)"
        }
    };

    refreshView();

    /**************************************************************/
    /********************* Controller Logic *************************/
    /**************************************************************/

    $scope.$on('badgeInfoModal', function(event, badge) {
        badge['txt1'] = badgesReference[badge.type].type == "explore" ? "explor" : badgesReference[badge.type].type;
        badge['txt2'] = badgesReference[badge.type].subType;
        $scope.activeBadge = badge;
    });

    function setParams() {
        $scope.params = $scope.userID ? "badgesc/all/" + $scope.userID : "badgesc/all";
    }

    function refreshView() {
        $scope.hideSpinner = false;
        $scope.userBadges = {};
        setParams();
        getUserBadges();
    }

    function getUserBadges() {

        api.get($scope.params, true).then(function(data) {
            var badges = data.badges,
                badgeType, badgeSubCategory ,badgeCategory, userBadges={}, userBadgesArr=[], lockedTypes=[];

            angular.forEach(badges, function(badge) {
                badgeType = badge.type;

                if(Object.keys(badgesReference).indexOf(badgeType) !== -1) {
                    
                    badgeCategory = badgesReference[badgeType].type;
                    badgeSubCategory = badgesReference[badgeType].subType;

                    badge['badgeSrc'] = "/assets/images/badges/" + badge.img;

                    if(!userBadges[badgeType]) {
                        userBadges[badgeType] = {
                            type: badgeType,
                            text: badgeCategory 
                                + " | unlocked by "
                                + (function() {
                                    var result;

                                    switch(badgeCategory) {
                                        case 'explore':
                                            result = 'explor';
                                            break;
                                        case 'brag':
                                            result = 'bragg';
                                            break;
                                        default:
                                            result = badgeCategory;
                                            break;
                                    };

                                    return result;
                                }())
                                + "ing " + badgeSubCategory
                                + ". "
                                + badgesReference[badgeType].hint,
                            unlockedBadges: []
                        };
                    }

                    userBadges[badge.type].unlockedBadges.push(badge);   
                }
                             
            });

            lockedTypes = Object.keys(badgesReference).filter(function(type) {
                return Object.keys(userBadges).indexOf(type) < 0;
            });

            angular.forEach(lockedTypes, function(type) {
                var lockedBadges = [];
                badgeCategory = badgesReference[type].type;
                badgeSubCategory = badgesReference[type].subType;

                for(var i=0; i<16; i++) {
                    lockedBadges.push(i);
                }

                userBadges[type] = {
                    type: type,
                    text: badgeCategory + " | unlocked by " + (badgeCategory==='explore' ? 'explor' : badgeCategory) + "ing " + badgeSubCategory + ". " + badgesReference[type].hint,
                    lockedBadges: {
                        badges: lockedBadges,
                        badgeSrc: "/assets/images/badges/locked_badges.png",
                        badgesText: "Locked!"
                    },
                    unlockedBadges: []
                };
            });

            angular.forEach(userBadges, function(badges) {
                if(badges.unlockedBadges.length > 0) {
                    var lockedBadgesCount = 16 - badges.unlockedBadges.length,
                        lockedBadges = [];

                    for(var i=0; i<lockedBadgesCount; i++) {
                        lockedBadges.push(i);
                    }
                    badges['lockedBadges'] = {
                        badges: lockedBadges,
                        badgeSrc: "/assets/images/badges/locked_badges.png",
                        badgesText: "Locked!"
                    };
                }
                
            });

            angular.forEach(userBadges, function(badges) {
                userBadgesArr.push(badges);
            });

            userBadgesArr.sort(function(a, b) {
                return b.unlockedBadges.length - a.unlockedBadges.length;
            });

            $scope.userBadges = userBadgesArr;
            $scope.hideSpinner = true;
        });

    }

}])