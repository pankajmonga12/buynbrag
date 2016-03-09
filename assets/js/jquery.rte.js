jQuery.fn.rte=function(d,c){if(!c||c.constructor!=Array){c=new Array()}$(this).each(function(b){var a=(this.id)?this.id:c.length;c[a]=new lwRTE(this,d||{})});return c};var lwRTE_resizer=function(b){this.drag=false;this.rte_zone=$(b).parents(".rte-zone")};lwRTE_resizer.mousedown=function(c,d){c.drag=true;c.event=(typeof(d)=="undefined")?window.event:d;c.rte_obj=$(".rte-resizer",c.rte_zone).prev().eq(0);$("body",document).css("cursor","se-resize");return false};lwRTE_resizer.mouseup=function(c,d){c.drag=false;$("body",document).css("cursor","auto");return false};lwRTE_resizer.mousemove=function(g,h){if(g.drag){h=(typeof(h)=="undefined")?window.event:h;var f=Math.max(1,g.rte_zone.width()+h.screenX-g.event.screenX);var e=Math.max(1,g.rte_obj.height()+h.screenY-g.event.screenY);g.rte_zone.width(f);g.rte_obj.height(e);g.event=h}return false};var lwRTE=function(e,d){this.css=[];this.css_class=d.frame_class||"";this.base_url=d.base_url||"";this.width=d.width||$(e).width()||"100%";this.height=d.height||$(e).height()||350;this.iframe=null;this.iframe_doc=null;this.textarea=null;this.event=null;this.range=null;this.toolbars={rte:"",html:""};this.controls={rte:{disable:{hint:"Source editor"}},html:{enable:{hint:"Visual editor"}}};$.extend(this.controls.rte,d.controls_rte||{});$.extend(this.controls.html,d.controls_html||{});$.extend(this.css,d.css||{});if(document.designMode||document.contentEditable){$(e).wrap($("<div></div>").addClass("rte-zone").width(this.width));$('<div class="rte-resizer"><a href="#"></a></div>').insertAfter(e);var f=new lwRTE_resizer(e);$(".rte-resizer a",$(e).parents(".rte-zone")).mousedown(function(a){$(document).mousemove(function(b){return lwRTE_resizer.mousemove(f,b)});$(document).mouseup(function(b){return lwRTE_resizer.mouseup(f,b)});return lwRTE_resizer.mousedown(f,a)});this.textarea=e;this.enable_design_mode()}};lwRTE.prototype.editor_cmd=function(f,e){this.iframe.contentWindow.focus();try{this.iframe_doc.execCommand(f,false,e)}catch(d){}this.iframe.contentWindow.focus()};lwRTE.prototype.get_toolbar=function(){var b=(this.iframe)?$(this.iframe):$(this.textarea);return(b.prev().hasClass("rte-toolbar"))?b.prev():null};lwRTE.prototype.activate_toolbar=function(f,e){var d=this.get_toolbar();if(d){d.remove()}$(f).before($(e).clone(true))};lwRTE.prototype.enable_design_mode=function(){var i=this;i.iframe=document.createElement("iframe");i.iframe.frameBorder=0;i.iframe.frameMargin=0;i.iframe.framePadding=0;i.iframe.width="100%";i.iframe.height=i.height||"100%";i.iframe.src="javascript:void(0);";if($(i.textarea).attr("class")){i.iframe.className=$(i.textarea).attr("class")}if($(i.textarea).attr("id")){i.iframe.id=$(i.textarea).attr("id")}if($(i.textarea).attr("name")){i.iframe.title=$(i.textarea).attr("name")}var n=$(i.textarea).val();$(i.textarea).hide().after(i.iframe).remove();i.textarea=null;var p="";for(var e in i.css){p+="<link type='text/css' rel='stylesheet' href='"+i.css[e]+"' />"}var m=(i.base_url)?"<base href='"+i.base_url+"' />":"";var o=(i.css_class)?"class='"+i.css_class+"'":"";var k="<html><head>"+m+p+"</head><body "+o+" style='padding:5px' id='abc'>"+n+"</body></html>";i.iframe_doc=i.iframe.contentWindow.document;try{i.iframe_doc.designMode="on"}catch(l){$(i.iframe_doc).focus(function(){i.iframe_doc.designMode()})}i.iframe_doc.open();i.iframe_doc.write(k);i.iframe_doc.close();if(!i.toolbars.rte){i.toolbars.rte=i.create_toolbar(i.controls.rte)}i.activate_toolbar(i.iframe,i.toolbars.rte);$(i.iframe).parents("form").submit(function(){i.disable_design_mode(true)});$(i.iframe_doc).mouseup(function(a){if(i.iframe_doc.selection){i.range=i.iframe_doc.selection.createRange()}i.set_selected_controls((a.target)?a.target:a.srcElement,i.controls.rte)});$(i.iframe_doc).blur(function(a){if(i.iframe_doc.selection){i.range=i.iframe_doc.selection.createRange()}});$(i.iframe_doc).keyup(function(a){i.set_selected_controls(i.get_selected_element(),i.controls.rte)});if(!$.browser.msie){i.editor_cmd("styleWithCSS",false)}};lwRTE.prototype.disable_design_mode=function(c){var d=this;d.textarea=(c)?$('<input type="hidden" />').get(0):$("<textarea></textarea>").width("100%").height(d.height).get(0);if(d.iframe.className){d.textarea.className=d.iframe.className}if(d.iframe.id){d.textarea.id=d.iframe.id}if(d.iframe.title){d.textarea.name=d.iframe.title}$(d.textarea).val($("body",d.iframe_doc).html());$(d.iframe).before(d.textarea);if(!d.toolbars.html){d.toolbars.html=d.create_toolbar(d.controls.html)}if(c!=true){$(d.iframe_doc).remove();$(d.iframe).remove();d.iframe=d.iframe_doc=null;d.activate_toolbar(d.textarea,d.toolbars.html)}};lwRTE.prototype.toolbar_click=function(j,k){var e=k.exec;var h=k.args||[];var i=(j.tagName.toUpperCase()=="SELECT");$(".rte-panel",this.get_toolbar()).remove();if(e){if(i){h.push(j)}try{e.apply(this,h)}catch(l){}}else{if(this.iframe&&k.command){if(i){h=j.options[j.selectedIndex].value;if(h.length<=0){return}}this.editor_cmd(k.command,h)}}};lwRTE.prototype.create_toolbar=function(m){var n=this;var e=$("<div></div>").addClass("rte-toolbar").width("100%").append($("<ul></ul>")).append($("<div></div>").addClass("clear"));var j,i;for(var l in m){if(m[l].separator){i=$("<li></li>").addClass("separator")}else{if(m[l].init){try{m[l].init.apply(m[l],[this])}catch(k){}}if(m[l].select){j=$(m[l].select).change(function(a){n.event=a;n.toolbar_click(this,m[this.className]);return false})}else{j=$("<a href='#'></a>").attr("title",(m[l].hint)?m[l].hint:l).attr("rel",l).click(function(a){n.event=a;n.toolbar_click(this,m[this.rel]);return false})}i=$("<li></li>").append(j.addClass(l))}$("ul",e).append(i)}$(".enable",e).click(function(){n.enable_design_mode();return false});$(".disable",e).click(function(){n.disable_design_mode();return false});return e.get(0)};lwRTE.prototype.create_panel=function(k,p){var j=this;var n=j.get_toolbar();if(!n){return false}$(".rte-panel",n).remove();var m,q;var o=j.event.pageX;var l=j.event.pageY;var r=$("<div></div>").hide().addClass("rte-panel").css({left:o,top:l});$("<div></div>").addClass("rte-panel-title").html(k).append($("<a class='close' href='#'>X</a>").click(function(){r.remove();return false})).mousedown(function(){m=true;return false}).mouseup(function(){m=false;return false}).mousemove(function(a){if(m&&q){o-=q.pageX-a.pageX;l-=q.pageY-a.pageY;r.css({left:o,top:l})}q=a;return false}).appendTo(r);if(p){r.width(p)}n.append(r);return r};lwRTE.prototype.get_content=function(){return(this.iframe)?$("body",this.iframe_doc).html():$(this.textarea).val()};lwRTE.prototype.set_content=function(b){(this.iframe)?$("body",this.iframe_doc).html(b):$(this.textarea).val(b)};lwRTE.prototype.set_selected_controls=function(u,i){var p=this.get_toolbar();if(!p){return false}var n,v,s,r,e,t,o;try{for(n in i){r=i[n];s=$("."+n,p);s.removeClass("active");if(!r.tags){continue}v=u;do{if(v.nodeType!=1){continue}e=v.nodeName.toLowerCase();if($.inArray(e,r.tags)<0){continue}if(r.select){s=s.get(0);if(s.tagName.toUpperCase()=="SELECT"){s.selectedIndex=0;for(t=0;t<s.options.length;t++){o=s.options[t].value;if(o&&((r.tag_cmp&&r.tag_cmp(v,o))||e==o)){s.selectedIndex=t;break}}}}else{s.addClass("active")}}while(v=v.parentNode)}}catch(q){}return true};lwRTE.prototype.get_selected_element=function(){var j,e,g;var i=this.iframe.contentWindow;if(i.getSelection){try{e=i.getSelection();g=e.getRangeAt(0);j=g.commonAncestorContainer}catch(h){return false}}else{try{e=i.document.selection;g=e.createRange();j=g.parentElement()}catch(h){return false}}return j};lwRTE.prototype.get_selection_range=function(){var e=null;var f=this.iframe.contentWindow;this.iframe.focus();if(f.getSelection){e=f.getSelection().getRangeAt(0);if($.browser.opera){var d=e.startContainer;if(d.nodeType===Node.TEXT_NODE){e.setStartBefore(d.parentNode)}}}else{this.range.select();e=this.iframe_doc.selection.createRange()}return e};lwRTE.prototype.get_selected_text=function(){var b=this.iframe.contentWindow;if(b.getSelection){return b.getSelection().toString()}this.range.select();return b.document.selection.createRange().text};lwRTE.prototype.get_selected_html=function(){var e=null;var g=this.iframe.contentWindow;var f=this.get_selection_range();if(f){if(g.getSelection){var h=document.createElement("div");h.appendChild(f.cloneContents());e=h.innerHTML}else{e=f.htmlText}}return e};lwRTE.prototype.selection_replace_with=function(d){var e=this.get_selection_range();var f=this.iframe.contentWindow;if(!e){return}this.editor_cmd("removeFormat");if(f.getSelection){e.deleteContents();e.insertNode(e.createContextualFragment(d));this.editor_cmd("delete")}else{this.editor_cmd("delete");e.pasteHTML(d)}};