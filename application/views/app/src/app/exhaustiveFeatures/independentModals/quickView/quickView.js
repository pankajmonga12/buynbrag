angular.module('quickView', ['directives.cart', 'directives.emptyImg', 'directives.imageZoom'])

.controller("QuickViewController", ["$scope", "$timeout", "api", "apiBroadcast", function($scope, $timeout, api, apiBroadcast) {
    /****************************** Definition of all the variables here *********************************/

    var objComputed = {}, checkedForImageLoad;

    //Called when main image is loaded in QV, hides spinner
    $scope.loaded = function() {

        if(!checkedForImageLoad) {

            checkedForImageLoad = true;

            $scope.imageLoaded = true;
            $scope.objValid && loadRemainingImages();
            
            $timeout(function() { $scope.busy = false; }, 750);

        }
    };

    $scope.changeImage = function(url, num) {

        if(num === 1) {

            $scope.mainImage = url + 'fancy2.jpg';
            $scope.zoomedImage = url + 'fancy1.jpg';

        }
        else {

            $scope.mainImage = url + 'img' + num + '_product.jpg';
            $scope.zoomedImage = url + 'img' + num + '_product.jpg';

        }

    };

    $scope.passDescription = function() {

        dataService.setDescription($scope.productDescription, $scope.productName, true);

    };

    $scope.$on("openQuickViewSame", function() {

      $scope.busy = true;

      $timeout(function() { $scope.busy = false; }, 300);

    });

    $scope.$on("openQuickView", function() {

        checkedForImageLoad = false;

        /*************** Initialize Scope ***************/

        $scope.productDescription = "";
        $scope.productName = "";
        $scope.storeName = "";
        $scope.origPrice = "";
        $scope.discountPrice = ""
        $scope.quantity = "";
        $scope.imageLoaded = false, $scope.objValid = false;
        $scope.busy = apiBroadcast.busy;
        $scope.productID = apiBroadcast.pid;
        $scope.storeID = apiBroadcast.sid;


        /*************** Start Updating Scope  ***************/
        $scope.mainImage = api.productImage($scope.storeID, $scope.productID) + "fancy2.jpg";

        var zoomed = api.productImage($scope.storeID, $scope.productID) + "fancy1.jpg";

        api.get("async/qvdata/" + $scope.productID).then(function(data) {
             
            var i, imageURL, variantName,
                variant="",
                colorVariants = [],
                sizeVariants = [],
                qvdata = data.qvData,
                moreproducts = data.moreStoreProducts,
                thumbnails = data.filesExistence,
                variants = data.variants,
                descriptionHtml = qvdata.productDescription,
                descriptionText = (function() {

                                        var div = document.createElement("div");
                                        var html = descriptionHtml;

                                        div.innerHTML = html;

                                        return div.textContent || div.innerText || "";

                                    })();;

            /***** Get Product Variants *****/
            if(variants) {

                angular.forEach(variants, function(val, key) {

                    variantName = val.variantName;
                    variantQuantity = val.variantQuantity;

                    if( variantName && variantName.toUpperCase() === "COLOR" ) {

                        variant = val.variantColor;
                        (variant) && colorVariants.push({"color": variant, "variantQuantity": variantQuantity});

                    }
                    else if( variantName && variantName.toUpperCase() === "SIZE" ) {

                        variant = val.variantSize;
                        (variant) && sizeVariants.push({"size": variant, "variantQuantity": variantQuantity});

                    }
                                                    
                });

            }

            $scope.hasFancied = qvdata.hasFancied;
            $scope.hasBragged = qvdata.hasBragged;
            $scope.quickpid = qvdata.productID;
            $scope.quicksid = qvdata.storeID;  
            $scope.productDescription = qvdata.productDescription;
            $scope.productDescriptionShort = descriptionText.split(".")[0] + ".";
            $scope.productName = qvdata.productName;
            $scope.storeName = qvdata.storeName;
            $scope.origPrice = qvdata.productSellingPrice;
            $scope.discountPrice = (parseInt(qvdata.productSellingPrice) - parseInt(qvdata.productDiscount)).toString();
            $scope.totalQuantity = qvdata.productQuantity;

            $scope.colorVariants = (colorVariants.length !== 0) ? colorVariants : null;
            $scope.selectedColorVariant = $scope.colorVariants ? $scope.colorVariants[0] : null;
            $scope.sizeVariants = (sizeVariants.length !== 0) ? sizeVariants : null;
            $scope.selectedSizeVariant = $scope.sizeVariants ? $scope.sizeVariants[0] : null;

            $scope.productQuantity = (function() {
                                        var i = 1,
                                            quantity = [];

                                        while(i <= parseInt($scope.totalQuantity)) {
                                            quantity.push({"num": i});
                                            i++;
                                        }

                                        return quantity;
                                    })();

            $scope.selectedQuantity = $scope.productQuantity[0];

            //Check remote existence of more product images and attach URLs to scope if present
            var imageThumbs = [], 
                imageThumbsUrl = api.productImage(qvdata.storeID, qvdata.productID);

            for(thumbnail in thumbnails) {

                (thumbnails[thumbnail]) && imageThumbs.push({"imageURL" : imageThumbsUrl, "num": (parseInt(thumbnail) + 1)});

            }                

            //Generate "Fancied by User Images" URLs
            var bgUserImages = [];

            for(i=1; i<=5; i++) {

                var userID = eval("qvdata.userID" + i), 
                    userFBID = eval("qvdata.user" + i + "FBID"), 
                    userGender = eval("qvdata.user" + i + "Gender");
                    
                imageURL = (userFBID && !isNaN(userFBID)) ? api.userImageFb(userFBID, 75) : api.userImageBnb(userGender);
                userID && bgUserImages.push({"userID":userID, "imageURL":imageURL});  

            }                
                  
            //Generate "Most Fancied Product Images" URLs 
            var bgImages = []; 

            for(i=1; i<=5; i++) {

                var fpsID = eval("qvdata.mostFanciedProductStoreID" + i),
                    fpID = eval("qvdata.mostFanciedProductID" + i);

                imageURL = api.productImage(fpsID, fpID) + "img1_171x171.jpg";
                fpsID && fpID && bgImages.push({"fpID":fpID, "fpsID": fpsID, "imageURL":imageURL}); 

            }                

            //Generate More store products URLs
            var moreimages = [];

            for(i=0; i<9; i++) {

                var elm = moreproducts[i];

                imageURL = api.productImage(elm.storeID, elm.productID) + "img1_171x171.jpg";
                elm.productID && elm.storeID && moreimages.push({"mpID":elm.productID, "fpsID":elm.storeID, "imageURL":imageURL});

            }

            objComputed["imageThumbs"] = imageThumbs;                
            objComputed["bgUserImages"] = bgUserImages;
            objComputed["bgImages"] = bgImages;
            objComputed["moreimages"] = moreimages;
            objComputed["zoomedImage"] = zoomed;

            $scope.objValid = true;
            $scope.imageLoaded && loadRemainingImages();

        });
    });

    function loadRemainingImages() {

        $scope.productImageThumbs = objComputed.imageThumbs;
        $scope.bgUserImages = objComputed.bgUserImages;
        $scope.bgImages = objComputed.bgImages;
        $scope.moreProducts = objComputed.moreimages;

        $timeout(function() { $scope.zoomedImage = objComputed.zoomedImage; }, 500);

    }

}]);