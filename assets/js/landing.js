$(function(){$(".fancy_icon").hover(function(){$(".fancy_tooltip").show()},function(){$(".fancy_tooltip").hide()});$(".styleboard_icon").hover(function(){$(".styleboard_tooltip").show()},function(){$(".styleboard_tooltip").hide()});$(".poll_icon").hover(function(){$(".poll_tooltip").show()},function(){$(".poll_tooltip").hide()});$(".blog_icon").hover(function(){$(".blog_tooltip").show()},function(){$(".blog_tooltip").hide()})});function Randomize(){var a=new Array("landing_1.jpg","landing_2.jpg","landing_3.jpg","landing_4.jpg","landing_5.jpg");var b=Math.floor(Math.random()*a.length);$("html").css("background-image","url(http://www.buynbrag.com/assets/images/"+a[b]+")")}window.onload=Randomize;