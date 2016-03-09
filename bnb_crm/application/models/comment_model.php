<?php
class comment_model extends CI_Model {



	function commentDetail($limit = 0, $offset = 0)
    {
		
    	  $this->db->select('comments.id As CommentID,comments.comments As Comments,from_unixtime(comments.ts) As
                           CommentTime,comments.entity1 As ProductID,c.comments As replyComment,comments.isPublished As publish,comments.replied As replied,
                           comments.replyID As replyID,products.product_name As ProductName,products.store_id As StoreID,comments.user_id As UserID,
                           user_details.full_name As Username,user_details.email As Email');
        $this->db->join('comments c','comments.replyID=c.id','left');
        $this->db->join('user_details','comments.user_id=user_details.user_id','left');
        $this->db->join('products','comments.entity1=products.product_id','left');
        $this->db->order_by("comments.id", "desc");
    	  $query = $this->db->get('comments',$limit, ($offset-1)*$limit);
        return $query->result();
    }
    public function record_count() 
    {
        return $this->db->count_all("comments");
    }
    function commentAdd($editorID, $userID, $comment, $ProductID, $commentID)
    {
      $data = array(
             'ctype' => '1' ,
             'comments' => $comment ,
             'entity1' => $ProductID,
             'user_id' => $editorID,
             'isPublished' => '1',
             'ts' => time()
          );
        $this->db->insert('comments', $data);
        $replyID = $this->db->insert_id();

        $this->db->set('replied','1');
        $this->db->set('replyID',$replyID);
        $this->db->where('id',$commentID);
        $this->db->update('comments'); 

      $this->db->select('comments.user_id As UserID');
      $this->db->select('comments.entity1 As ProductID');  
      $this->db->select('from_unixtime(comments.ts) As Commentime');  
      $this->db->select('products.store_id As storeID');   
      $this->db->select('products.product_name As productName'); 
      $this->db->select('user_details.email As EmailID');  
      $this->db->select('user_details.full_name As UserName');   
      $this->db->select('user_details.full_name As UserName'); 
      $this->db->from('comments');
      $this->db->join('user_details','comments.user_id=user_details.user_id','left');
      $this->db->join('products','comments.entity1=products.product_id','left');
      $this->db->where('user_details.user_id',$userID);
      $query = $this->db->get();
      $emailInfo = $query->result_array();
      return $emailInfo;
    }
    function publishComment($commentID) {

        $this->db->set('comments.isPublished','1');
        $this->db->where('comments.id',$commentID);
         $query = $this->db->update('comments');
    }
    function UnpublishComment($commentID) {

        $this->db->set('comments.isPublished','0');
        $this->db->where('comments.id',$commentID);
        $query = $this->db->update('comments');
    }
    function findeditorEmail($editorID)
    {

        $this->db->select('user_details.email As editorEmail');
        $this->db->from('user_details');
        $this->db->where('user_details.user_id', $editorID);
        $query = $this->db->get();
        $emailInfo = $query->result();
        return $emailInfo;
    }
    function replyComment($commentID)
    {
       
        $this->db->set('replied','2');
        $this->db->set('replyID','0');
        $this->db->where('id',$commentID);
        $this->db->update('comments');
        return;
    }
 }
