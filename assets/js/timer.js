function StartCountDownDays(b,d){var c=new Date(d);var a=new Date();ddiff=new Date(c-a);gsecs=Math.floor(ddiff.valueOf()/1000);CountBackDays(b,gsecs)}function Calcage(a,c,b){s=((Math.floor(a/c))%b).toString();if(s.length<2){s="0"+s}return(s)}function CountBackDays(a,c){var b;var d="%%D%%";b=d.replace(/%%D%%/g,Calcage(c,86400,100000));b=b.replace(/%%H%%/g,Calcage(c,3600,24));b=b.replace(/%%M%%/g,Calcage(c,60,60));b=b.replace(/%%S%%/g,Calcage(c,1,60));if(c>0){document.getElementById(a).innerHTML=b;setTimeout("CountBackDays('"+a+"',"+(c-1)+");",990)}else{document.getElementById(a).innerHTML="0"}}function StartCountDownHours(b,d){var c=new Date(d);var a=new Date();ddiff=new Date(c-a);gsecs=Math.floor(ddiff.valueOf()/1000);CountBackHours(b,gsecs)}function CountBackHours(a,c){var b;var d="%%H%%";b=d.replace(/%%D%%/g,Calcage(c,86400,100000));b=b.replace(/%%H%%/g,Calcage(c,3600,24));b=b.replace(/%%M%%/g,Calcage(c,60,60));b=b.replace(/%%S%%/g,Calcage(c,1,60));if(c>0){document.getElementById(a).innerHTML=b;setTimeout("CountBackHours('"+a+"',"+(c-1)+");",990)}else{document.getElementById(a).innerHTML="0"}}function StartCountDownMins(b,d){var c=new Date(d);var a=new Date();ddiff=new Date(c-a);gsecs=Math.floor(ddiff.valueOf()/1000);CountBackMins(b,gsecs)}function CountBackMins(a,c){var b;var d="%%M%%";b=d.replace(/%%D%%/g,Calcage(c,86400,100000));b=b.replace(/%%H%%/g,Calcage(c,3600,24));b=b.replace(/%%M%%/g,Calcage(c,60,60));b=b.replace(/%%S%%/g,Calcage(c,1,60));if(c>0){document.getElementById(a).innerHTML=b;setTimeout("CountBackMins('"+a+"',"+(c-1)+");",990)}else{document.getElementById(a).innerHTML="0"}}function StartCountDownSecs(b,d){var c=new Date(d);var a=new Date();ddiff=new Date(c-a);gsecs=Math.floor(ddiff.valueOf()/1000);CountBackSecs(b,gsecs)}function CountBackSecs(a,c){var b;var d="%%S%%";b=d.replace(/%%D%%/g,Calcage(c,86400,100000));b=b.replace(/%%H%%/g,Calcage(c,3600,24));b=b.replace(/%%M%%/g,Calcage(c,60,60));b=b.replace(/%%S%%/g,Calcage(c,1,60));if(c>0){document.getElementById(a).innerHTML=b;setTimeout("CountBackSecs('"+a+"',"+(c-1)+");",990)}else{document.getElementById(a).innerHTML="0"}};