(function(a){a.fn.sexyCombo=function(d){return this.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}new b(this,d)})};var c={skin:"sexy",suffix:"__sexyCombo",hiddenSuffix:"__sexyComboHidden",renameOriginal:false,initialHiddenValue:"",emptyText:"",autoFill:false,triggerSelected:true,filterFn:null,dropUp:false,separator:",",key:"value",value:"text",showListCallback:null,hideListCallback:null,initCallback:null,initEventsCallback:null,changeCallback:null,textChangeCallback:null,checkWidth:true};a.sexyCombo=function(e,h){if(e.tagName.toUpperCase()!="SELECT"){return}this.config=a.extend({},c,h||{});this.selectbox=a(e);this.options=this.selectbox.children().filter("option");this.wrapper=this.selectbox.wrap("<div>").hide().parent().addClass("combo").addClass(this.config.skin);this.input=a("<input type='text' />").appendTo(this.wrapper).attr("autocomplete","off").attr("value","").attr("name",this.selectbox.attr("name")+this.config.suffix);var g=this.selectbox.attr("name");var d=g+this.config.hiddenSuffix;if(this.config.renameOriginal){this.selectbox.attr("name",d)}this.hidden=a("<input type='hidden' />").appendTo(this.wrapper).attr("autocomplete","off").attr("value",this.config.initialHiddenValue).attr("name",this.config.renameOriginal?g:d);this.icon=a("<div />").appendTo(this.wrapper).addClass("icon");this.listWrapper=a("<div />").appendTo(this.wrapper).addClass("list-wrapper");this.updateDrop();this.list=a("<ul />").appendTo(this.listWrapper);var f=this;var i=[];this.options.each(function(){var k=a.trim(a(this).text());if(f.config.checkWidth){i.push(a("<li />").appendTo(f.list).html("<span>"+k+"</span>").addClass("visible").find("span").outerWidth())}else{a("<li />").appendTo(f.list).html("<span>"+k+"</span>").addClass("visible")}});this.listItems=this.list.children();if(i.length){i=i.sort(function(l,k){return l-k});var j=i[i.length-1]}this.singleItemHeight=this.listItems.outerHeight();this.listWrapper.addClass("invisible");if(a.browser.opera){this.wrapper.css({position:"relative",left:"0",top:"0"})}this.filterFn=("function"==typeof(this.config.filterFn))?this.config.filterFn:this.filterFn;this.lastKey=null;this.multiple=this.selectbox.attr("multiple");var f=this;this.wrapper.data("sc:lastEvent","click");this.overflowCSS="overflow";if((this.config.checkWidth)&&(this.listWrapper.innerWidth()<j)){this.overflowCSS="overflow"}this.notify("init");this.initEvents()};var b=a.sexyCombo;b.fn=b.prototype={};b.fn.extend=b.extend=a.extend;b.fn.extend({initEvents:function(){var d=this;this.icon.bind("click",function(f){if(!d.wrapper.data("sc:positionY")){d.wrapper.data("sc:positionY",f.pageY)}});this.input.bind("click",function(f){if(!d.wrapper.data("sc:positionY")){d.wrapper.data("sc:positionY",f.pageY)}});this.wrapper.bind("click",function(f){if(!d.wrapper.data("sc:positionY")){d.wrapper.data("sc:positionY",f.pageY)}});this.icon.bind("click",function(){if(d.input.attr("disabled")){d.input.attr("disabled",false)}d.wrapper.data("sc:lastEvent","click");d.filter();d.iconClick()});this.listItems.bind("mouseover",function(f){if("LI"==f.target.nodeName.toUpperCase()){d.highlight(f.target)}else{d.highlight(a(f.target).parent())}});this.listItems.bind("click",function(f){d.listItemClick(a(f.target))});this.input.bind("keyup",function(f){d.wrapper.data("sc:lastEvent","key");d.keyUp(f)});this.input.bind("keypress",function(f){if(b.KEY.RETURN==f.keyCode){f.preventDefault()}if(b.KEY.TAB==f.keyCode){f.preventDefault()}});a(document).bind("click",function(f){if((d.icon.get(0)==f.target)||(d.input.get(0)==f.target)){return}d.hideList()});this.triggerSelected();this.applyEmptyText();this.input.bind("click",function(f){d.wrapper.data("sc:lastEvent","click");d.icon.trigger("click")});this.wrapper.bind("click",function(){d.wrapper.data("sc:lastEvent","click")});this.input.bind("keydown",function(f){if(9==f.keyCode){f.preventDefault()}});this.wrapper.bind("keyup",function(g){var f=g.keyCode;for(key in b.KEY){if(b.KEY[key]==f){return}}d.wrapper.data("sc:lastEvent","key")});this.input.bind("click",function(){d.wrapper.data("sc:lastEvent","click")});this.icon.bind("click",function(f){if(!d.wrapper.data("sc:positionY")){d.wrapper.data("sc:positionY",f.pageY)}});this.input.bind("click",function(f){if(!d.wrapper.data("sc:positionY")){d.wrapper.data("sc:positionY",f.pageY)}});this.wrapper.bind("click",function(f){if(!d.wrapper.data("sc:positionY")){d.wrapper.data("sc:positionY",f.pageY)}});this.notify("initEvents")},getTextValue:function(){return this.__getValue("input")},getCurrentTextValue:function(){return this.__getCurrentValue("input")},getHiddenValue:function(){return this.__getValue("hidden")},getCurrentHiddenValue:function(){return this.__getCurrentValue("hidden")},__getValue:function(h){h=this[h];if(!this.multiple){return a.trim(h.val())}var f=h.val().split(this.config.separator);var g=[];for(var e=0,d=f.length;e<d;++e){g.push(a.trim(f[e]))}g=b.normalizeArray(g);return g},__getCurrentValue:function(d){d=this[d];if(!this.multiple){return a.trim(d.val())}return a.trim(d.val().split(this.config.separator).pop())},iconClick:function(){if(this.listVisible()){this.hideList();this.input.blur()}else{this.showList();this.input.focus();if(this.input.val().length){this.selection(this.input.get(0),0,this.input.val().length)}}},listVisible:function(){return this.listWrapper.hasClass("visible")},showList:function(){if(!this.listItems.filter(".visible").length){return}this.listWrapper.removeClass("invisible").addClass("visible");this.wrapper.css("zIndex","99999");this.listWrapper.css("zIndex","99999");this.setListHeight();var e=this.listWrapper.height();var f=this.wrapper.height();var d=parseInt(this.wrapper.data("sc:positionY"))+f+e;var g=a(window).height()+a(document).scrollTop();if(d>g){this.setDropUp(true)}else{this.setDropUp(false)}if(""==a.trim(this.input.val())){this.highlightFirst();this.listWrapper.scrollTop(0)}else{this.highlightSelected()}this.notify("showList")},hideList:function(){if(this.listWrapper.hasClass("invisible")){return}this.listWrapper.removeClass("visible").addClass("invisible");this.wrapper.css("zIndex","0");this.listWrapper.css("zIndex","99999");this.notify("hideList")},getListItemsHeight:function(){var d=this.singleItemHeight;return d*this.liLen()},setOverflow:function(){var d=this.getListMaxHeight();if(this.getListItemsHeight()>d){this.listWrapper.css(this.overflowCSS,"scroll")}else{this.listWrapper.css(this.overflowCSS,"hidden")}},highlight:function(d){if((b.KEY.DOWN==this.lastKey)||(b.KEY.UP==this.lastKey)){return}this.listItems.removeClass("active");a(d).addClass("active")},setComboValue:function(h,g,d){var f=this.input.val();var e="";if(this.multiple){e=this.getTextValue();if(g){e.pop()}e.push(a.trim(h));e=b.normalizeArray(e);e=e.join(this.config.separator)+this.config.separator}else{e=a.trim(h)}this.input.val(e);this.setHiddenValue(h);this.filter();if(d){this.hideList()}this.input.removeClass("empty");if(this.multiple){this.input.focus()}if(this.input.val()!=f){this.notify("textChange")}},setHiddenValue:function(d){var l=false;d=a.trim(d);var n=this.hidden.val();if(!this.multiple){for(var g=0,h=this.options.length;g<h;++g){if(d==this.options.eq(g).text()){this.hidden.val(this.options.eq(g).val());l=true;break}}}else{var k=this.getTextValue();var m=[];for(var g=0,h=k.length;g<h;++g){for(var f=0,e=this.options.length;f<e;++f){if(k[g]==this.options.eq(f).text()){m.push(this.options.eq(f).val())}}}if(m.length){l=true;this.hidden.val(m.join(this.config.separator))}}if(!l){this.hidden.val(this.config.initialHiddenValue)}if(n!=this.hidden.val()){this.notify("change")}this.selectbox.val(this.hidden.val());this.selectbox.trigger("change")},listItemClick:function(d){this.setComboValue(d.text(),true,true);this.inputFocus()},filter:function(){if("yes"==this.wrapper.data("sc:optionsChanged")){var e=this;this.listItems.remove();this.options=this.selectbox.children().filter("option");this.options.each(function(){var f=a.trim(a(this).text());a("<li />").appendTo(e.list).text(f).addClass("visible")});this.listItems=this.list.children();this.listItems.bind("mouseover",function(f){e.highlight(f.target)});this.listItems.bind("click",function(f){e.listItemClick(a(f.target))});e.wrapper.data("sc:optionsChanged","")}var d=this.input.val();var e=this;this.listItems.each(function(){var f=a(this);var g=f.text();if(e.filterFn.call(e,e.getCurrentTextValue(),g,e.getTextValue())){f.removeClass("invisible").addClass("visible")}else{f.removeClass("visible").addClass("invisible")}});this.setOverflow();this.setListHeight()},filterFn:function(g,h,e){if("click"==this.wrapper.data("sc:lastEvent")){return true}if(!this.multiple){return h.toLowerCase().indexOf(g.toLowerCase())==0}else{for(var f=0,d=e.length;f<d;++f){if(h==e[f]){return false}}return h.toLowerCase().search(g.toLowerCase())==0}},getListMaxHeight:function(){var d=parseInt(this.listWrapper.css("maxHeight"),10);if(isNaN(d)){d=this.singleItemHeight*10}return d},setListHeight:function(){var d=this.getListItemsHeight();var f=this.getListMaxHeight();var e=this.listWrapper.height();if(d<e){this.listWrapper.height(d);return d}else{if(d>e){this.listWrapper.height(Math.min(f,d));return Math.min(f,d)}}},getActive:function(){return this.listItems.filter(".active")},keyUp:function(f){this.lastKey=f.keyCode;var d=b.KEY;switch(f.keyCode){case d.RETURN:case d.TAB:this.setComboValue(this.getActive().text(),true,true);if(!this.multiple){break}case d.DOWN:this.highlightNext();break;case d.UP:this.highlightPrev();break;case d.ESC:this.hideList();break;default:this.inputChanged();break}},liLen:function(){return this.listItems.filter(".visible").length},inputChanged:function(){this.filter();if(this.liLen()){this.showList();this.setOverflow();this.setListHeight()}else{this.hideList()}this.setHiddenValue(this.input.val());this.notify("textChange")},highlightFirst:function(){this.listItems.removeClass("active").filter(".visible:eq(0)").addClass("active");this.autoFill()},highlightSelected:function(){this.listItems.removeClass("active");var f=a.trim(this.input.val());try{this.listItems.each(function(){var e=a(this);if(e.text()==f){e.addClass("active");self.listWrapper.scrollTop(0);self.scrollDown()}});this.highlightFirst()}catch(d){}},highlightNext:function(){var d=this.getActive().next();while(d.hasClass("invisible")&&d.length){d=d.next()}if(d.length){this.listItems.removeClass("active");d.addClass("active");this.scrollDown()}},scrollDown:function(){if("scroll"!=this.listWrapper.css(this.overflowCSS)){return}var d=this.getActiveIndex()+1;var e=this.listItems.outerHeight()*d-this.listWrapper.height();if(a.browser.msie){e+=d}if(this.listWrapper.scrollTop()<e){this.listWrapper.scrollTop(e)}},highlightPrev:function(){var d=this.getActive().prev();while(d.length&&d.hasClass("invisible")){d=d.prev()}if(d.length){this.getActive().removeClass("active");d.addClass("active");this.scrollUp()}},getActiveIndex:function(){return a.inArray(this.getActive().get(0),this.listItems.filter(".visible").get())},scrollUp:function(){if("scroll"!=this.listWrapper.css(this.overflowCSS)){return}var d=this.getActiveIndex()*this.listItems.outerHeight();if(this.listWrapper.scrollTop()>d){this.listWrapper.scrollTop(d)}},applyEmptyText:function(){if(!this.config.emptyText.length){return}var d=this;this.input.bind("focus",function(){d.inputFocus()}).bind("blur",function(){d.inputBlur()});if(""==this.input.val()){this.input.addClass("empty").val(this.config.emptyText)}},inputFocus:function(){if(this.input.hasClass("empty")){this.input.removeClass("empty").val("")}},inputBlur:function(){if(""==this.input.val()){this.input.addClass("empty").val(this.config.emptyText)}},triggerSelected:function(){if(!this.config.triggerSelected){return}var d=this;try{this.options.each(function(){if(a(this).attr("selected")){d.setComboValue(a(this).text(),false,true);throw new Error()}})}catch(f){return}d.setComboValue(this.options.eq(0).text(),false,false)},autoFill:function(){if(!this.config.autoFill||(b.KEY.BACKSPACE==this.lastKey)||this.multiple){return}var e=this.input.val();var d=this.getActive().text();this.input.val(d);this.selection(this.input.get(0),e.length,d.length)},selection:function(f,g,e){if(f.createTextRange){var d=f.createTextRange();d.collapse(true);d.moveStart("character",g);d.moveEnd("character",e);d.select()}else{if(f.setSelectionRange){f.setSelectionRange(g,e)}else{if(f.selectionStart){f.selectionStart=g;f.selectionEnd=e}}}},updateDrop:function(){if(this.config.dropUp){this.listWrapper.addClass("list-wrapper-up")}else{this.listWrapper.removeClass("list-wrapper-up")}},setDropUp:function(d){this.config.dropUp=d;this.updateDrop()},notify:function(d){if(!a.isFunction(this.config[d+"Callback"])){return}this.config[d+"Callback"].call(this)}});b.extend({KEY:{UP:38,DOWN:40,DEL:46,TAB:9,RETURN:13,ESC:27,COMMA:188,PAGEUP:33,PAGEDOWN:34,BACKSPACE:8},log:function(e){var d=a("#log");d.html(d.html()+e+"<br />")},createSelectbox:function(e){var j=a("<select />").appendTo(e.container).attr({name:e.name,id:e.id,size:"1"});if(e.multiple){j.attr("multiple",true)}var h=e.data;var g=false;for(var f=0,d=h.length;f<d;++f){g=h[f].selected||false;a("<option />").appendTo(j).attr("value",h[f][e.key]).text(h[f][e.value]).attr("selected",g)}return j.get(0)},create:function(e){var f={name:"",id:"",data:[],multiple:false,key:"value",value:"text",container:a(document),url:"",ajaxData:{}};e=a.extend({},f,e||{});if(e.url){return a.getJSON(e.url,e.ajaxData,function(g){delete e.url;delete e.ajaxData;e.data=g;return b.create(e)})}e.container=a(e.container);var d=b.createSelectbox(e);return new b(d,e)},deactivate:function(d){d=a(d);d.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}var e=a(this);if(!e.parent().is(".combo")){return}})},activate:function(d){d=a(d);d.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}var e=a(this);if(!e.parent().is(".combo")){return}e.parent().find("input[type='text']").attr("disabled",false)})},changeOptions:function(d){d=a(d);d.each(function(){if("SELECT"!=this.tagName.toUpperCase()){return}var h=a(this);var g=h.parent();var i=g.find("input[type='text']");var f=g.find("ul").parent();f.removeClass("visible").addClass("invisible");g.css("zIndex","0");f.css("zIndex","99999");i.val("");g.data("sc:optionsChanged","yes");var e=h;e.parent().find("input[type='text']").val(e.find("option:eq(0)").text());e.parent().data("sc:lastEvent","click");e.find("option:eq(0)").attr("selected","selected")})},normalizeArray:function(f){var e=[];for(var g=0,d=f.length;g<d;++g){if(""==f[g]){continue}e.push(f[g])}return e}})})(jQuery);