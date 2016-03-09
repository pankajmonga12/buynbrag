var hostProtocol = ("https:"===document.location.protocol?"https://":"http://"),
    hostName = document.location.hostname,
    hostURL = hostProtocol + hostName,
    environment = ("buynbrag.com"===document.location.hostname?"production":"development"),
    mx_trackEvent ="[TRACK] ",
    mx_peopleEvent ="[PEOPLE SET] ";

// start Mixpanel 

(function(f,b){if(!b.__SV){var a,e,i,g;window.mixpanel=b;
	  b._i=[];
	  b.init=function(a,e,d){function f(b,h){
	  	var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}
	  	var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];
	  	c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};
	  	c.people.toString=function(){return c.toString(1)+".people (stub)"};
	  	i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");
	for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;
	a=f.createElement("script");a.type="text/javascript";
	a.async=!0;a.src="//cdn.mxpnl.com/libs/mixpanel-2.2.min.js";
	e=f.getElementsByTagName("script")[0];
	e.parentNode.insertBefore(a,e)}})(document,window.mixpanel||[]);
 // mixpanel.init("YOUR TOKEN"); done after environment check

// end Mixpanel 

var _bnbAnalytics = {

    init : function(environment){

        if(environment === "production"){
            console.log('Analytics production environment initialized');
            mixpanel.init("0a66811e5320b6c5b39d47bfbfaf19e0");
		    mixpanel.set_config({
                cross_subdomain_cookie: false,
                debug: false
            });
        } else if(environment === "development"){
            console.log('Analytics development environment initialized.');
            mixpanel.init("409dd912d6f1b56a344818cd902f4c0f");
            mixpanel.set_config({
                cross_subdomain_cookie: false,
                debug: true
            });
        } else{
            console.log('Wrong Mixpanel initialization environment parameters.');
        }

    },

//    loginSuccess : function(emailID, bnbID, fullName, gender, FBID, newUserStatus, registrationStatus){
//
//        console.log('Mixpanel login success event started');
//
//        mixpanel.identify(emailID);
//
//        mixpanel.people.set_once({
//            'bnbID': bnbID
//        });
//
//        mixpanel.people.set({
//            '$email': emailID,
//            '$name': fullName,
//            'Gender': gender,
//            'Facebook ID': FBID,
//            'New or Old': newUserStatus,
//            'Registration Completed': registrationStatus
//        });
//
//    },

    registerSuccess : function(bnbID, emailID, fullName, gender, dobDate, dobMonth, dobYear, bnbCity, bnbCountry){

        //console.log('Mixpanel register success event update.');

        var accCreationDate = new Date();

        mixpanel.identify(emailID);

        mixpanel.register_once({
            'Account_Creation_Date': accCreationDate.toISOString()
        });

        mixpanel.track('Registration Completed', {
            'Email_ID': emailID,
            'Gender': gender,
            'Age': accCreationDate.getFullYear() - dobYear,
            'bnbID': parseInt(bnbID),
            'Registered_Via_FB': false,
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        }, 
        function(response) {_bnbAnalytics.logResponse(response, mx_trackEvent, "people data set after registration.");});

        mixpanel.people.set({
            '$email': emailID,
            '$name': fullName,
            'Gender': gender,
            'Age': accCreationDate.getFullYear() - dobYear,
            'DOB': dobYear + '-' + dobMonth + '-' + dobDate,
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "generic people data set after registration.");});

        mixpanel.people.set_once({
            'bnbID': parseInt(bnbID),
            '$created': accCreationDate.toISOString(),
            'Registration Completed': true,
            'Registered via FB': false,
            'New User': true
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "special people data set after registration.");});

    },

    fbRegisterSuccess : function(bnbID, emailID, fullName, gender, FBID, DOB, Age, bnbCity, bnbCountry){
        
        //console.log(" ANALYTICS :: register fb sucess vars: " + bnbID +  emailID +  fullName +  gender +  FBID + DOB + Age + bnbCity +  bnbCountry);
        
        if(!bnbCity){ bnbCity = "unknown"; }
        if(!bnbCountry){ bnbCountry = "unknown";}

        var accCreationDate = new Date();

        var dobYear = new Date(DOB).getFullYear();
        var currentYear = new Date().getFullYear();
        var Age = currentYear - dobYear;

        if(!dobYear){Age=0;}

        mixpanel.identify(emailID);
       
        mixpanel.register({
            'Email_ID': emailID,
            'Gender': gender,
            'Age': parseInt(Age),
            'bnbID': parseInt(bnbID),
            'Facebook_ID': FBID,
            'Facebook_User' : true,
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        });

        mixpanel.register_once({
            'Account_Creation_Date': accCreationDate.toISOString()
        });

        mixpanel.people.set({
            '$email': emailID,
            '$name': fullName,
            'Gender': gender,
            'Facebook ID': FBID,
            'Facebook_User' : true,
            'DOB' : DOB,
            'Age' : parseInt(Age),
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "generic people data set after login.");});

        mixpanel.people.set_once({
            'bnbID': parseInt(bnbID),
            '$created': accCreationDate.toISOString(),
            'Registration Completed': true,
            'Registered via FB': true,
            'New User': true
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "special people data set after login.");});

        mixpanel.track('Registration Completed', {
            'Email_ID': emailID,
            'Gender': gender,
            'Age': accCreationDate.getFullYear() - dobYear,
            'bnbID': parseInt(bnbID),
            'Registered_Via_FB': true,
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        }, function(response) {
            _bnbAnalytics.logResponse(response, mx_trackEvent, "people data set after registration.");

            var  xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", hostURL + '/async/deleteFBCookies', false );
            xmlHttp.send( null );
        });

    },

    trackLoginSuccess : function(bnbID, emailID, fullName, gender, FBID, DOB, Age, bnbCity, bnbCountry, accCreationDate){
        //console.log("tracking login success " + bnbID +"  "+ emailID +"  "+ fullName +"  "+ gender +"  "+ FBID +"  "+ DOB +"  "+ Age +"  "+ bnbCity +"  "+ bnbCountry +"  "+ accCreationDate);
        if(!bnbCity){ bnbCity = "unknown"; }
        if(!bnbCountry){ bnbCountry = "unknown"; }

        var dobYear = new Date(DOB).getFullYear();
        var currentYear = new Date().getFullYear();


        Age = currentYear - dobYear;

        if(!dobYear){Age=0;}

        var fbUser = true;

        if(FBID === 'non-fb-member' || FBID === 0){fbUser = false;}

        mixpanel.identify(emailID);

        mixpanel.register({
            'Email_ID': emailID,
            'Gender': gender,
            'Age': parseInt(Age),
            'bnbID': parseInt(bnbID),
            'Facebook_ID': FBID,
            'Facebook_User' : fbUser,
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        });

        mixpanel.register_once({
            'Account_Creation_Date': accCreationDate
        });

        mixpanel.people.set({
            '$email': emailID,
            '$name': fullName,
            'Gender': gender,
            'Facebook ID': FBID,
            'Facebook_User' : fbUser,
            'DOB' : DOB,
            'Age' : parseInt(Age),
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "generic people data set after login.");});

        mixpanel.people.set_once({
            'bnbID': parseInt(bnbID),
            '$created': accCreationDate,
            'Registration Completed': true,
            'Registered via FB': false,
            'New User': false
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "special people data set after login.");});

        mixpanel.track('Login Completed', {
            'Email_ID': emailID,
            'Gender': gender,
            'Name':fullName,
            'Age':Age,
            'bnbID': parseInt(bnbID),
            'bnbCity': bnbCity,
            'bnbCountry': bnbCountry
        }, function(response) {
            _bnbAnalytics.logResponse(response, mx_trackEvent, " login event tracking successful.")});

    },

    userStatsUpdate : function(bnbID, emailID, rank, fancyCount, cartCount, totalOrders, totalBadges){

        //console.log("ANALYTICS ::  user stats update vars"+ bnbID + emailID + rank + fancyCount + cartCount + totalOrders + totalBadges);
        if(!totalBadges){totalBadges=0}
        if(!rank){rank=bnbID}
        if(!totalOrders){ totalOrders = 0; }    

        mixpanel.identify(emailID);

        mixpanel.people.set({
            'Rank': parseInt(rank),
            'Fancy_Count': parseInt(fancyCount),
            'Cart_Count': parseInt(cartCount),
            'Total_Orders' : parseInt(totalOrders),
            'Total_Badges' : parseInt(totalBadges)
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "generic people data set after login.");});

    },

    fancySuccess : function(prodID, prodName, storeID, rootCatID, subCatID, src){
        //console.log(" ANALYTICS ::  fancy success vars: " + prodID + prodName + storeID + rootCatID + subCatID + src);
        mixpanel.track('Fancied', {
            'Product_ID': parseInt(prodID),
            'Product_Name': prodName,
            'Store_ID': parseInt(storeID),
            'Root_Category_ID': parseInt(rootCatID),
            'Sub_Category_ID': parseInt(subCatID),
            'Source_Page': src
        }, function(response) {_bnbAnalytics.logResponse(response, mx_trackEvent, " event tracked after fancy.");});
        // check calling of people.identify before increment
        //mixpanel.people.increment({
          //  Fancy_Count: 1
        //}, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "fancy count incremented after fancy.");});

    },

    commentSuccess: function(prodID, userID, prodName, storeID, prodComment) {
        mixpanel.track('Commented', {
            'Product_ID' : prodID,
            'bnbID' : userID,
            'Product_Name' : prodName,
            'Store_ID' : storeID,
            'Product_Comment' : prodComment
        });        
    },
   
    tagSuccess : function(emailID, src, prodID, prodName, storeID){

        mixpanel.track('Tagged', {
            'Product_ID': parseInt(prodID),
            'Email_ID': emailID,
            'Product_Name': prodName,
            'Store_ID': parseInt(storeID),
            'Source_Page': src
        }, function(response) {_bnbAnalytics.logResponse(response, mx_trackEvent, " event tracked after tag success.");});

    },

    registerFollow : function(bnbid, emailID, evntPage, personfollowed){

        mixpanel.track('Followed', {
            'Email_ID': emailID,
            'bnbid':bnbid,
            'Source_Page': evntPage,
            'followed_bnbid': personfollowed
        }, function(response) {_bnbAnalytics.logResponse(response, mx_trackEvent, " event tracked after follow.");});

    },

    shoppingCartLoaded : function(emailID, cartSize, visitCount){
        //console.log("ANALYTICS :: shopping cart load vars: " + emailID +  cartSize + visitCount);
        mixpanel.identify(emailID);

        mixpanel.people.set({
            'Cart_Count' : parseInt(cartSize),
            'Cart_Visit_Count' : visitCount
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "cart update sent on shopping cart page.");});

        mixpanel.track('Shopping cart page loaded', {
            'Cart_Size': cartSize,
            'Cart_Visit_Count' : visitCount
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "tracked shopping cart page load.");});

    },

    checkout1Loaded : function(emailID, cartSize, visitCount){
        //console.log("ANALYTICS :: checkout 1 Loaded load vars: " + emailID +  cartSize + visitCount);
        mixpanel.identify(emailID);

        mixpanel.people.set({
            'Checkout1_Visit_Count' : visitCount
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "checkout 1 update sent on shopping cart page.");});

        mixpanel.track('Checkout 1 loaded', {
            'Cart_Size': cartSize,
            'Checkout1_Visit_Count' : visitCount
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "checkout 1 loaded.");});

    },

    registerContactNo : function(emailID, contactNo){
        
        mixpanel.identify(emailID);

        contactNo = "+91"+contactNo;

        mixpanel.people.set({
            'Contact_No' : contactNo
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "contact no update sent on shopping cart proceed");});
 
    },

    trackProfileVisit : function (visitorId, emailID, visitedId, visitedTab){
        mixpanel.track('Profile Visit', {
            'Visitor Id': visitorId,
            'Visitor Email': emailID,
            'ID visted' :  visitedId,
            'Tab Visited': visitedTab
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "profile visit");});

    },

    checkout2Loaded : function(emailID, cartSize, visitCount){
        //console.log("ANALYTICS :: checkout 2 Loaded load vars: " + emailID +  cartSize + visitCount);
        mixpanel.identify(emailID);

        mixpanel.people.set({
            'Checkout2_Visit_Count' : visitCount
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "checkout 2 update sent on shopping cart page.");});

        mixpanel.track('Checkout 2 loaded', {
            'Cart_Size': cartSize,
            'Checkout2_Visit_Count' : visitCount
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "checkout 2 loaded.");});

    },

    orderConfirmed : function(){

        //console.log('Analytics :: Mixpanel order confirmed event update');
		// On checkout_second page within validate() function

    },

    orderSuccessProdAppend : function(emailID, prodName, prodQuantity, orderID){
        //console.log("ANALYTICS :: order success append" + emailID +  prodName + prodQuantity + orderID);
        mixpanel.identify(emailID);

        mixpanel.people.append({
            'History_Products_Ordered' : prodName,
            'History_Order_ID' : parseInt(orderID),
            'History_Single_Product_Quantity' : parseInt(prodQuantity)
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "products appended successfully.");});


    },

    orderSuccess : function(emailID, grandTotal, cartSize, totalProdQuantity, prodsOrderedArr, prodUnitPriceArr, prodsQuantityArr, orderIdArr){
        //console.log("ANALYTICS :: order success " + emailID + grandTotal + cartSize + totalProdQuantity + prodsOrderedArr + prodUnitPriceArr + prodsQuantityArr + orderIdArr);
        mixpanel.identify(emailID);

        //console.log(prodsOrderedArr);
        //console.log(prodUnitPriceArr);
        //console.log(prodsQuantityArr);
        //console.log(orderIdArr);

        var paymentMode = getCookie("bnb_Mode_Of_Payment");
        var couponID = getCookie("bnbCouponID");
        var couponValue = getCookie("bnbCouponRedeemVal");
        couponValue = parseFloat(couponValue);

        var transactionTime = new Date();

        mixpanel.track('Order successful', {
            'Grand_Total': grandTotal,
            'Cart_Size_Ordered': cartSize,
            'Total_Products_Ordered': totalProdQuantity,
            'Mode_Of_Payment': paymentMode,
            'Redeemed_Coupon': couponID,
            'Redeemed_Amount': couponValue,
            'Product_Ordered': prodsOrderedArr,
            'Product_Unit_Price': prodUnitPriceArr,
            'Product_Quantity_Ordered': prodsQuantityArr,
            'Order_ID': orderIdArr
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "order success event update sent.");});

        mixpanel.people.track_charge(grandTotal, {
            '$time': transactionTime.toISOString(),
            'Cart_Size_Ordered': cartSize,
            'Total_Products_Ordered': totalProdQuantity,
            'Mode_Of_Payment': paymentMode,
            'Redeemed_Coupon': couponID,
            'Redeemed_Amount': couponValue,
            'Last_Products_Ordered': prodsOrderedArr,
            'Last_Products_Unit_Price': prodUnitPriceArr,
            'Last_Products_Quantity_Ordered': prodsQuantityArr,
            'Last_Order_ID': orderIdArr
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "charges tracked successfully.");});

        mixpanel.people.set({
            'Cart_Count': 0
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "cart reset update sent.");});

        mixpanel.people.increment({
            'Total_Orders': 1
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "orders incremented.");});

        mixpanel.people.append({
            'History_Grand_Total': grandTotal,
            'History_Cart_Size_Ordered': cartSize,
            'History_Total_Products_Ordered': totalProdQuantity,
            'History_Mode_Of_Payment': paymentMode,
            'History_Redeemed_Coupon': couponID,
            'History_Redeemed_Amount': couponValue
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "history update sent.");});

        eraseCookie("bnb_Mode_Of_Payment");
        eraseCookie("bnbCouponID");
        eraseCookie("bnbCouponRedeemVal");
        eraseCookie("shoppingCartPageLoaded");
        eraseCookie("checkout1VisitCounter");
        eraseCookie("checkout2VisitCounter");
        eraseCookie("checkout1CartSize");
        eraseCookie("bnbGrandTotal");

    },

    orderFailed : function(emailID){
        //console.log("ANALYTICS :: order failed vars: " + emailID);
        mixpanel.identify(emailID);

        var paymentMode = getCookie("bnb_Mode_Of_Payment");
        var bnbGrandTotal = getCookie("bnbGrandTotal");

        mixpanel.track('Order failed', {
            'Mode_Of_Payment': paymentMode,
            'Grand_Total': parseFloat(bnbGrandTotal)
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "order failure event update sent.");});

        mixpanel.people.increment({
            'Failed_Orders': 1,
            'Failed_Orders_Total_Loss': parseFloat(bnbGrandTotal)
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "failed orders incremented.");});

        mixpanel.people.append({
            'History_Failed_Order_Grand_Total': parseFloat(bnbGrandTotal),
            'History_Failed_Order_Payment_Mode': paymentMode
        }, function(response) {_bnbAnalytics.logResponse(response, mx_peopleEvent, "failed orders update sent.");});

    },

    logResponse : function(response, eventType, event){
        if (response == -1) {
            console.log("Request queued until identify() is called for event: " + eventType + ' ' + event);
        } else if (response == 0) {
            console.log("Invalid request, rejected by API for event: " + eventType + ' ' + event);
        } else if (response == 1) {
            console.log("Successful response from server for event: " + eventType + ' ' + event);
        }
    }

};

// Initialization of Analytics code
_bnbAnalytics.init(environment);

(function(){
    var ref, domain;

    if (!(document.referrer == '' || document.referrer == 'http://buynbrag.com/')) {
        ref = document.referrer;
        domain = ref.match(/:\/\/(.[^/]+)/)[1];

        mixpanel.register({
            'Current_Referrer': ref,
            'Current_Referring_Domain': domain
        });
    } else{
        mixpanel.register({
            'Current_Referrer': 'Direct',
            'Current_Referring_Domain': 'Direct'
        });
    }

//    mixpanel.track_links("#mx-fbLoginTrack", "Discover with FB");

})();