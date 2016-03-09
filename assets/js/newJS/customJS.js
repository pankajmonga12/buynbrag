var ajaxError = function(xhr, status, error)
{
	console.log("Async Errors. Please try again later.\r\n"+status+": "+error);
	console.log("status = "+status+"\r\nerror = "+error+"\r\nxhr.readyState = "+xhr.readyState+"\r\nxhr.status = "+xhr.status);
};

// Fancy Product function

var fancyProduct = function(prodID, handle)
{
    //alert("inside fancy. productID = "+prodID+", handle = "+handle);
    var sess_id = $('#sess_id').val();
   // alert(sess_id);
    if (sess_id==0)
    {
            $('#loginModal').modal('show');
            return 0;
    }

    var request = $.ajax(
    {
        type: "GET",
        url: baseUrl + "index.php/async/fancy2/" + prodID,
        success: function(data, status, xhr)
        {
           // alert("inside fancy success. productID = "+prodID+", handle = "+handle);
           // alert("result = "+result);
           console.log(data);
            if(!(data.loggedIN)) {
                $('#loginModal').modal('show');
            }
            else if(data.error) {
                console.log("Well, this is embarassing and we are sorry.\r\nSome error has occurred. Please log-out, clear your cache, reload the page, login\r\nand then try fancying the product again.");                    
            } 
            else {
                $("#"+handle).find("#hoverFancy"+prodID).css("background-image", "url("+baseUrl+"assets/images/fancie_icon.png)");
                $("#"+handle).find("#hoverText"+prodID).html("FANCIED");
                $("#"+handle).attr("onClick", "unFancyProduct("+prodID+", \""+handle+"\");");
                $("#"+handle).find("#hoverFancy"+prodID).css("background-image", "url("+baseUrl+"assets/images/fancie_icon.png)");
                $("#"+handle).find("#hoverText"+prodID).html("FANCIED");
                $("#"+handle).hover(
                function() {
                    $(this).find("#hoverFancy"+prodID).css("background-image", "url("+baseUrl+"assets/images/editfancy_icon.png)");
                    $(this).find("#hoverText"+prodID).html("UNFANCY");
                },
                function() {
                    $(this).find("#hoverFancy"+prodID).css("background-image", "url("+baseUrl+"assets/images/editfancy_icon.png)");
                    $(this).find("#hoverText"+prodID).html("UNFANCY");
                });  
            } 
            countFancy(true);
        },
        error: ajaxError
    });
};

// Unfancy Product function

var unFancyProduct = function(prodID, handle)
{
    var sess_id = $('#sess_id').val();
    if (sess_id==0)
    {
            $("#createAccountPopup").dialog('close');
            $("#homePagePopup").dialog(
            {
                    width:439,
                    height:439,
                    modal:true
            });
            return 0;
    }
    //alert("inside fancy. productID = "+prodID+", handle = "+handle+"handleText = "+handleText);
    var request = $.ajax(
    {
        type: "GET",
        url: baseUrl+"index.php/async/unFancy/"+prodID,
        dataType: "text",
        success: function(result, status, xhr)
        {
            //alert("inside fancy success. productID = "+prodID+", handle = "+handle);
            //alert("result = "+result);
            switch(result)
            {
                case "___NOT_LOGGED_IN___": // popup login dialog$("#createAccountPopup").dialog('close');
                                            $("#homePagePopup").dialog(
                                            {
                                                    width:439,
                                                    height:439,
                                                    modal:true
                                            });
                    break;
                case "___ERROR___": console.log("Well, this is embarassing and we are sorry.\r\nSome error has occurred. Please log-out, clear your cache, reload the page, login\r\nand then try fancying the product again.");
                    break;
                case 3:
                default: $("#"+handle).find("#hoverFancy"+prodID).css("background-image", "url("+baseUrl+"assets/images/fancie_icon.png)");
                    $("#"+handle).find("#hoverText"+prodID).html("FANCY IT");
                    $("#"+handle).hover(
                        function()
                        {
                            $(this).find("#hoverFancy"+prodID).css("background-image", "url("+baseUrl+"assets/images/fancie_icon.png)");
                            $(this).find("#hoverText"+prodID).html("FANCY IT");
                        },
                        function()
                        {
                            $(this).find("#hoverFancy"+prodID).css("background-image", "url("+baseUrl+"assets/images/homepage_fancy_icon.png)");
                            $(this).find("#hoverText"+prodID).html("FANCY IT");
                        });
                    $("#"+handle).attr("onClick", "fancyProduct("+prodID+", \""+handle+"\");");
            }
            countFancy(false);
        },
        error: ajaxError
    });
};

$(document).ready(function() {
    $(".hoverFancyNext").each(function() {
        $(this).hover(
            function() {
                $(this).next().text("UNFANCY");
            },
            function() {
                $(this).css("background-image", "url("+baseUrl+"assets/images/editfancy_icon.png)");
            });
    });
});


// Counter functions

function counterInc(currentVal, countCont){
    countCont.html(currentVal+1);
}

function counterDec(currentVal, countCont){
    countCont.html(currentVal-1);
}

function countFancy(action){
    var countCont = $("#countFancy");
    var currentVal = parseInt(countCont.html());
    if(action){
        counterInc(currentVal, countCont);
    }else{
        counterDec(currentVal, countCont);
    }
}

function countPoll(action){
    var countCont = $("#countPoll");
    var currentVal =	parseInt(countCont.html());
    if(action){
        counterInc(currentVal, countCont);
    }else{
        counterDec(currentVal, countCont);
    }
}

function countCart(action){
    var countCont = $("#countCart");
    var currentVal =	parseInt(countCont.html());
    if(action){
        counterInc(currentVal, countCont);
    }else{
        counterDec(currentVal, countCont);
    }
}