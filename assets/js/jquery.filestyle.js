(function(a){a.fn.filestyle=function(b){var c={width:250};if(b){a.extend(c,b)}return this.each(function(){var e=this;var f=a("<div class='fileButton'>").css({width:c.width+"px",height:c.height+"px","background-color":"#"+c.backgroundColor,"float":"right",display:"inline",position:"absolute",overflow:"hidden","margin-left":"12px","border-bottom":"1px solid #fff"});var d=a('<input class="file">').addClass(a(e).attr("class")).css({display:"inline",width:"390px"});a(e).before(d);a(e).wrap(f);a(e).css({position:"relative",height:c.height+"px",width:c.width+"px",display:"inline",cursor:"pointer",opacity:"0.0"});if(a.browser.mozilla){if(/Win/.test(navigator.platform)){a(e).css("margin-left","-142px")}else{a(e).css("margin-left","-168px")}}else{a(e).css("margin-left","0px")}a(e).bind("change",function(){d.val(a(e).val())})})}})(jQuery);