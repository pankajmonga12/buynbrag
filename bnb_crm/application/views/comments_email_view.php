<html>
 <head> </head>
   <body>
      <?php $timestamp = strtotime($emailInfo[0]['Commentime']);?>
      <?php $commentDate = date("l, F j<\s\u\p>S</\s\u\p>, Y",$timestamp);?>
     Hi <?php echo $emailInfo[0]['UserName'] ?><br><a href="https://buynbrag.com/profile/social/<?php echo $editorID; ?>">Editor</a> just commented upon product (<a href="https://buynbrag.com/product/<?php echo $emailInfo[0]['productName']?>/<?php echo $emailInfo[0]['ProductID']?>"><?php echo $emailInfo[0]['productName']?></a>) that you have comented on <?php echo $commentDate?>.
 

 <br>
<br>
- Regards
<br>
Team BnB
 </body>
</html>