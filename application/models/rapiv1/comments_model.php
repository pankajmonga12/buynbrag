<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Comments_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveComment($ctype, $comment, $pid, $userID)
    {
        $data = array(
                        'ctype' => $ctype,
                        'comments' => $comment,
                        'ts' => time(),
                        'entity1' => $pid,
                        'user_id' => $userID
        			);
        log_message("INFO", "DATA BEING RETURNED FROM(\$data) comments/saveComments IS_____".print_r($data, TRUE));
        $retVal = $this->db->insert('comments', $data);
        log_message( "INFO", "just ran the following query_____".PHP_EOL.$this->db->last_query());
        return $retVal;
	}

    public function updateComment($comment, $commentID, $userID)
    {
        $data = array(
                        'comments' => $comment,
                        'ts' => time()
                    );
        log_message("INFO", "DATA BEING RETURNED FROM(\$data) comments/updateComments IS_____".print_r($data, TRUE));
        $this->db->where('user_id', $userID);
        $this->db->where('id', $commentID);
        $retVal = $this->db->update('comments', $data);
        log_message( "INFO", "just ran the following query_____".PHP_EOL.$this->db->last_query());
        return $retVal;
    }

    public function readComments( $productID )
    {
        $q1SQL = "SELECT `comments`.`user_id` AS `userID`, `comments`.`comments` AS `userComments`, `comments`.`ts` AS `commentTime`, `comments`.`id` AS `commentID`,";
        $q1SQL .= " `user_details`.`fb_uid` AS `userFBID`, `user_details`.`full_name` AS `userFullName`, `user_details`.`gender` AS `userGender`,";
        $q1SQL .= " `user_details`.`city` AS `userCity`, `user_details`.`country` AS `userCountry`";
        $q1SQL .= " FROM `comments`";
        $q1SQL .= " LEFT JOIN `user_details` ON `comments`.`user_id` = `user_details`.`user_id`";
        $q1SQL .= " WHERE `ctype` = 1 AND `entity1` = ".$productID." AND `isPublished` = 1";
        
        $comments = $this->db->query( $q1SQL );

        log_message( 'DEBUG', 'JUST RAN THE FOLLOWING QUERY___'.PHP_EOL.$this->db->last_query() );
        $retVal = NULL;

        if($comments->num_rows() > 0)
        {
            $retVal = $comments->result();
        }
        else 
        {
            $retVal = NULL;
        }
        log_message('INFO', 'returning from readComments/'.$productID.'___'.PHP_EOL.print_r($retVal, TRUE));
        return $retVal;
    }
    
    public function deleteComment($commentID,$userID)
    {
        $this->db->select('comments.user_id AS userID');
        $this->db->from('comments');
        $this->db->where('comments.id',$commentID);
        $dbUserID = $this->db->get();

        $dbUserID = $dbUserID->result();

        if($dbUserID[0]->userID == $userID)
        {
            $this->db->where('comments.id', $commentID);
            $this->db->where('comments.user_id', $userID);
            return $this->db->delete('comments');
        }
        else 
        {
            return NULL;
        }   
    }
}     
?>