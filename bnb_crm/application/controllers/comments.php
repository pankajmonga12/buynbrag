<?php
class Comments extends Ci_Controller {


public function __construct() 
    {
		parent:: __construct();
        $this->load->helper("url");
		$this->load->model("comment_model");
		$this->load->library("pagination");
	}

    function display( $page = 0 )
{
	     
	     $limit=20;
	     $this->load->model('comment_model');
         
   		// pagination
		 $this->load->library('pagination');
         $config = array();
	     $config['base_url'] = base_url()."index.php/comments/display";
		 $config['total_rows']=$this->comment_model->record_count();
		 $config["per_page"] = $limit;
	     $config['use_page_numbers'] = TRUE;
	     $config['first_url'] = '1';
	     $offset = $this->uri->segment(3);
	     //$choice = $config["total_rows"] / $config["per_page"];
         //$pagination["num_links"] = round($choice);
		 $config['uri_segment'] = 3;
	     $config["num_links"] = 20;
	     $config['next_link']  = 'Next';
	     $config['prev_link'] = 'Back';
         $this->pagination->initialize( $config );
				
		 $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		 $data['i'] = (($offset-1) * $limit) +1; 
		 $data['baseURL'] = base_url();
		 $data['user'] = $this->comment_model->commentDetail($config['per_page'], $offset);
		 $data['pagination'] = $this->pagination->create_links();
		 $this->load->view('comment_view',$data);
					     
}
 
    function CommentAdd()
	{
		$userID = $this->input->get('userID');
		$editorID = $this->input->get('editorID');
		$comment = $this->input->get('comment');
		$ProductID = $this->input->get('productID');
		$commentID = $this->input->get('commentID');

		$this->load->model('comment_model');
		$result = $this->comment_model->CommentAdd($editorID, $userID, $comment, $ProductID,$commentID);
		$editorEmail = $this->comment_model->findeditorEmail($editorID);

		$email = array_unique($result,TRUE);
		$data['emailInfo'] = $email;
		$data['editorID'] = $editorID;
		$data['editorEmail'] = $editorEmail[0]->editorEmail;
		
		$emailMessage = $this->load->view('comments_email_view', $data, TRUE);
		$list_email  = array($email[0]['EmailID'],'teamBnB@buynbrag.com');
		$this->load->library('email');
		$this->email->from($editorEmail[0]->editorEmail, 'BuynBrag');
		$this->email->to($list_email);
		$this->email->subject("Reply from editor on your comment");
		$this->email->message( $emailMessage );
		$this->email->set_newline("\r\n");

		if($this->email->send())
		{
			echo("Email Send Successfully");
		}
		else
		{
			echo(" Error sending in Email");
			show_error($this->email->print_debugger()); 
		}
	}
    function PublishComment(){
    	$commentID = $this->input->get('commentID');
        $this->comment_model->publishComment($commentID);
    }
    function UnpublishComment(){
    	$commentID = $this->input->get('commentID');
    	$this->comment_model->UnpublishComment($commentID);
    }
    function CommentReplyEmail(){
       $userName = $this->input->post('username');
       $commentID = $this->input->post('commentID');
       $useremail = $this->input->post('emailID');
       $editorID = $this->input->post('editorID');
       $comment = $this->input->post('comment');
       $this->comment_model->replyComment($commentID);
       $editorEmail = $this->comment_model->findeditorEmail($editorID);
       $data['userName']= $userName;
       $data['useremail']= $useremail;

       $this->load->model('emojify');
       $data['comment']= $this->emojify->emojify( $comment );
       log_message('INFO', "comment after emojification : ".$data['comment'] );
       $data['editorEmail']=$editorEmail[0]->editorEmail;
      $message=$this->load->view('comments_email_layout',$data,TRUE);
      $list_email  = array($useremail,'teamBnB@buynbrag.com');
       switch(!empty($useremail))
       {
        case TRUE:	$this->load->library('email');
					$this->email->from($editorEmail[0]->editorEmail, 'BuynBrag');
					$this->email->to($list_email);
					$this->email->subject("Reply from editor on your comment");
                    $this->email->message($message);
                    $this->email->set_newline("\r\n");
					if($this->email->send())
					{
					  echo("Email Send Successfully");
					}
					else
					{
					   echo(" Error sending in Email");
					   show_error($this->email->print_debugger()); 
					}
      	case FALSE:	echo "Useremail not found";
       		break;
       }

    }

}
?>