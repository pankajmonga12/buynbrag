
"use strict";

var fs = require("fs");

// The temporary file used for communications.
var tmpfile = phantom.args[0];
// The page .html file to load.
var url = phantom.args[1];
// Extra, optionally overridable stuff.
var options = JSON.parse(phantom.args[2] || {});

// Messages are sent to the parent by appending them to the tempfile.
var sendMessage = function (arg) {
    var args = Array.isArray(arg) ? arg : [].slice.call(arguments);
    fs.write(tmpfile, JSON.stringify(args) + "\n", "a");
};

var sanitizeHtml = function(html,options){
    //remove weird pseudo new lines and tabs
     html = html.replace(/\\n|\\t/g,"");
    // add a custom attribute if so required
    if (options.bodyAttr)
        html = html.replace(/<body/,"<body " + options.bodyAttr + "='" + options.bodyAttr + "' ");

    //replace werid escaped quotes with real quotes
    html = html.replace(/\\"/g,'"');

    //remove first quote character
    html = html.substr(1);

    //remove last quote character
    html = html.substr(0, html.length - 1);

    return html;
};

// This allows grunt to abort if the PhantomJS version isn"t adequate.
sendMessage("private", "version", phantom.version);

// Create a new page.
var page = require("webpage").create();

// Relay console logging messages.
page.onConsoleMessage = function (message) {
    sendMessage("console", message);
};

page.onError = function (msg, trace) {
    sendMessage("error.onError", msg, trace);
};

page.open(url, function (status) {

    if (status == 'success') {
        //that's far from bullet proof. We need to wait a little bit to
        //give the page time to be assembled.
        //We should let the user provider a function to check the html against.
        //If the function returns false we continue waiting and check again until the
        //function returns true or a timeout is hit
        setTimeout(function(){
            var html = page.evaluate(function () {

                var garbageElem = document.getElementsByClassName('zopim');
                // garbageElem.parentNode.removeChild(garbageElem);
                // document.getElementsByClassName('zopim')[0].innerHTML='';

                if(garbageElem){
                    while(garbageElem.length > 0){
//                        console.log('inside loop1');
                        garbageElem[0].parentNode.removeChild(garbageElem[0]);
                    }
                }

                garbageElem = document.getElementById('uvTab');
                if(garbageElem){
                    garbageElem.parentNode.removeChild(garbageElem);
                }

                garbageElem = document.getElementById('fb-root');
                if(garbageElem){
                    garbageElem.parentNode.removeChild(garbageElem);
                }

//                garbageElem = document.getElementById('_atssh');
//                garbageElem.parentNode.removeChild(garbageElem);

                var domDump = document.all[0].outerHTML;

                return  JSON.stringify(domDump);
            });
            sendMessage("htmlSnapshot.pageReady", sanitizeHtml(html,options), url);

            phantom.exit();
        }, options.msWaitForPages);
    }
});

