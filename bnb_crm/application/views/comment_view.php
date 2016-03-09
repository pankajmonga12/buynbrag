<html>

<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src='<?php echo $baseURL; ?>assets/js/jquery.bpopup-x.x.x.min.js'></script>
<script src='<?php echo $baseURL; ?>assets/js/emojify.js'></script>
	

<style type="text/css" >
input[type=text]
{
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width: 150px;
  min-height: 28px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
  float: left;
display: inline;
margin-left: 1em;
}
textarea#txtArea {
width: 400px;
 border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
  float: left;
display: inline;
margin-left: 1em;
}
label{
  font-family: Tahoma;
  float: left;
  display: inline;
  margin-left: 1em;
}
	body {
background-color: aliceblue;
}
a {
text-decoration: none;
color: cornflowerblue;
cursor: pointer;
}
a:hover {
text-decoration: underline;
cursor: pointer;
color: #DD127B;

}
.pagination {
margin-left: 35%;
margin-bottom: 10px;
}
	input[type="submit"] {
width: 80px;
background-color: aliceblue;
}
table{
		border-collapse: collapse;

	}
	td,th{
		border: 1px solid #666666;
		padding: 4px;
	}
	.thead {
color: white;
background-color: black;
}
    .button {
    margin-top: 2em;
    margin-left: 20em;
    background: #E48F8F;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
}
		   input#addbutton {
	margin-top: 2em;
    margin-left: 20em;
    background: #E48F8F;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
	}
	       .button:hover{
	   cursor: pointer;
	}
           .button.b-close {
	border-radius: 7px 7px 7px 7px;

	font: bold 131% sans-serif;
	padding: 0 6px 2px;
	position: absolute;
	right: -7px;
	top: -50px;
	box-shadow: 0 2px 3px rgba(0,0,0,0.3);
	color: #fff;
	cursor: pointer;
	display: inline-block;
	text-align: center;
	text-decoration: none;
	}
 .box{
      background-color: white;
      color: black;
      font-size: 16px;
      box-shadow: 0 0 25px 5px #999;
      border-radius: 7px 7px 7px 7px;
      padding: 20px;
      position: absolute;
      top: 10em;
      left: 25em;
      width: 600px;
      height: auto;
      display: none;
      min-height: 200px;
     
    }
	
	  
 </style>
<script type="text/javascript">
   function repliedView(replycomment,comment) 
 {  
  function urldecode (str) {
  return decodeURIComponent((str + '').replace(/\+/g, '%20'));
} 
  document.getElementById("commentreplied-text").innerHTML='';
  document.getElementById("commentreplied-text").innerHTML+='<b>Comment:  <b>'+urldecode(comment);
  document.getElementById("commentreplied-text").innerHTML+='<br><br>';
  document.getElementById("commentreplied-text").innerHTML+='<b>Reply By Editor:  </b>'+urldecode(replycomment);
    $(document.getElementById("commentreplied-view")).bPopup({
            easing:'linear',
            speed: 500,
            escClose: true,
            transition: 'fadeIn'
            });
    }
	 function ComentView(ProductID,UserID,commentID) 
 {   
 	document.getElementById("button").innerHTML='';
    var btn = document.getElementById("button");
    var element1 = document.createElement("input");
    element1.setAttribute('type','button');
    element1.setAttribute('name','Add Comment');
    element1.setAttribute('id','addbutton');
    element1.setAttribute('value','Submit'); 
    element1.setAttribute('onclick','commentAdd("'+ProductID+'","'+UserID+'","'+commentID+'")');
    btn.appendChild(element1); 
   
    console.log(ProductID);
    $(document.getElementById("comment")).bPopup({
            easing:'linear',
            speed: 500,
            escClose: true,
            transition: 'fadeIn'
            });
    }
</script>
	<script type="text/javascript">
  /*======================================  CommentADD  FUNCTION START =================================================*/
        function commentAdd(productID,userID,commentID) 
        {
             console.log(userID);
             console.log(productID);
             var x = document.getElementById("EmailId");
             var editorID = x.value;
             var x = document.getElementById("txtArea");
             var comment = x.value;

         if (comment==null || comment=='' ) 
             {
                 alert("Please Add some text");
                 return false;
             }
   else {
           $.ajax
                      ({
                          url: "<?php echo $baseURL;?>index.php/comments/CommentAdd/",
                          data: {userID:userID,editorID:editorID,comment:comment,productID:productID,commentID:commentID},
                          type: 'GET',
                         success :   function(){
                          console.log('success');

                            console.log('response = ' + response);
                            alert("comment added and email sent to user");
                            window.location.reload();
                         }
                        });
            
                  }
                  $(document.getElementById('comment')).bPopup().close(); 
         
          }
           
/*==========================================  CommentADD FUNCTION END =================================================*/         
</script>
<script type="text/javascript">
  /*======================================  CommentReply  FUNCTION START =================================================*/
        function CommentReply(username,emailID,commentID) 
        {
             
             var x = document.getElementById("EmailId");
             var editorID = x.value;
             var x = document.getElementById("txtArea");
             var comment = x.value;

         if (comment==null || comment=='' ) 
             {
                 alert("Please Add some text");
                 return false;
             }
      else {
                $.ajax
                      ({
                          url: "<?php echo $baseURL;?>index.php/comments/CommentReplyEmail",
                          data: {username:username,emailID:emailID,comment:comment,editorID:editorID,commentID:commentID},
                          type: 'post',
                         success :   function(response){
                            console.log('success');

                            alert(" email sent to user");
                            window.location.reload();
                            
                            
                         }
                        });
                          
             $(document.getElementById('comment')).bPopup().close();             
            
           }
         
          }
           
/*==========================================  CommentReply FUNCTION END =================================================*/         
</script>
<script type="text/javascript">
	 function ReplyView(username,emailID,commentID) 
 {   
 	document.getElementById("button").innerHTML='';
    var btn = document.getElementById("button");
    var element1 = document.createElement("input");
    element1.setAttribute('type','button');
    element1.setAttribute('name','Add Comment');
    element1.setAttribute('id','addbutton');
    element1.setAttribute('value','Submit'); 
    element1.setAttribute('onclick','CommentReply("'+username+'","'+emailID+'","'+commentID+'")');
      btn.appendChild(element1); 
   
    console.log(username);
    $(document.getElementById("comment")).bPopup({
            easing:'linear',
            speed: 500,
            escClose: true,
            transition: 'fadeIn'
            });
    }
</script>

<script type="text/javascript">
  function publishComment(commentID) {
         $.ajax
                      ({
                          url: "<?php echo $baseURL;?>index.php/comments/PublishComment",
                          data: {commentID:commentID},
                          type: 'GET',
                         success :   function(response){
                            alert("comment has been published");
                            window.location.reload();
                         }
                        });
  }
</script>
<script type="text/javascript">
  function UnpublishComment(commentID) {

         $.ajax
                      ({
                          url: "<?php echo $baseURL;?>index.php/comments/UnpublishComment",
                          data: {commentID:commentID},
                          type: 'GET',
                         success :   function(response){
                            console.log('success');
                            alert("comment has been unpublished");
                            window.location.reload();

                          
                         }
                        });
  }
</script>
</head>
<body>
<button onClick="window.close();return true;">Return to CRM BASE</button>
<div class = "head" style="height:600;">
 <table align='center'>
		<thead class ="thead">
	      <th>S. No.</th>
		  <th>COMMENTS</th>
		  <th>COMMENT TIME</th>
		  <th>PRODUCT IMAGE</th>
		  <th>PRODUCT NAME</th>
		  <th>USERNAME</th>
		  <th>USEREMAIL</th>
		  <th colspan="2">REPLY</th>
      <th>REPLY STATUS</th>
		</thead>
      <tbody>
 <?php foreach($user as $q): ?>
	<tr>
	  <td><?php echo $i++; ?></td>
		<td><?php echo $q->Comments ?></td>
		<td><?php echo $q->CommentTime ?></td>
		<td><img src="https://buynbragstores.s3.amazonaws.com/assets/images/stores/<?php echo $q->StoreID; ?>/<?php echo $q->ProductID; ?>/img1_240x200.jpg" height="80" width="80"></td>
		<td><a href="https://buynbrag.com/product/<?php echo $q->ProductName?>/<?php echo $q->ProductID?> " target="_blank"><?php echo $q->ProductName?></a></td>
		<td><?php echo $q->Username?></td>
		<td><?php echo $q->Email?></td>
		<?php if($q->publish==0||$q->publish==null)
		{ 
		  echo "<td><button onclick=\"publishComment(".$q->CommentID.")\">Publish</button></td>";
	      echo "<td><button onclick=\"ReplyView('".$q->Username."','".$q->Email."','".$q->CommentID."')\">Reply</button></td>";
    	 }
    	else{
          echo"<td><button onclick=\"UnpublishComment(".$q->CommentID.")\">UnPublish</button></td>";
          echo "<td><button onclick=\"ComentView('".$q->ProductID."','".$q->UserID."','".$q->CommentID."')\">Reply</button></td>";
    	}?>
    <?php if( $q->replied == '0' && $q->replyID == '0' )
      { 
      echo "<td style=\"color:red;\">NOT REPLIED</td>";
      }
      else if( $q->replied == '2' ){
          echo "<td style=\"color:cornflowerblue;\">REPLIED BY EMAIL</td>";
      }
      else{
          echo "<td><a onclick=\"repliedView('".urlencode($q->replyComment)."','".urlencode($q->Comments)."')\">REPLIED</a></td>";
      }?>
	</tr>
     <?php endforeach; ?>
       <div class = "pagination"><?php echo $pagination ?>
       </div>
      </div>
	 </tbody>
    </table>
   <div class="box"  id="comment"style="display=none">
       <div class="button b-close" title="Close" id="closeMbtn">x</div>
       <h2><center>COMMENT REPLY</center></h2>
        <div class ="intern">
        <label for="CommentReply">REPLY BY:</label>
         <select id="EmailId">
         <option value="15368">dining@buynbrag.com</option>
         <option value="15366">fashion@buynbrag.com</option>
         <option value="15367">interior@buynbrag.com</option>
         <option value="5627">prt@buynbrag.com</option>
         <option value="22">prithvi.raj@gmail.com</option>
         <option value="18042">teamBnB@buynbrag.com</option>
  </select><br><br><br>
           <label for="CommentNew">REPLY:</label>
           ​<textarea id="txtArea" rows="10" cols="70"></textarea>
         <div id ="button"></div>
      </div>
      </div>
      <div class="box"  id="commentreplied-view"style="display=none">
        <div class="button b-close" title="Close" id="closeMbtn">x</div>
          <h2><center>COMMENT REPLIED BY EDITOR </center></h2>
            <div id ="commentreplied-text"></div>
      </div>
         <script>
      emojify.run();
</script>
  </body>
</html>