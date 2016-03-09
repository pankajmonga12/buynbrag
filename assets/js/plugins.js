window.log = function f() {
    log.history = log.history || [];
    log.history.push(arguments);
    if (this.console) {
        var a = arguments,
            b;
        a.callee = a.callee.caller;
        b = [].slice.call(a);
        if (typeof console.log === "object") {
            log.apply.call(console.log, console, b)
        } else {
            console.log.apply(console, b)
        }
    }
};
(function (g) {
    function e() {}
    for (var i = "assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","), h; !! (h = i.pop());) {
        g[h] = g[h] || e
    }
})(function () {
        try {
            console.log();
            return window.console
        } catch (b) {
            return (window.console = {})
        }
    }());