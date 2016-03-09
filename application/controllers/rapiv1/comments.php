<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller
{
	var $userID = NULL;
	var $isLoggedIN = NULL;
	var $isReallyLoggedIN = FALSE;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('rapiv1/comments_model', 'comments_model');
		$this->userID = $this->session->userdata('id');
		$this->isLoggedIN = $this->session->userdata('logged_in');
		$this->isReallyLoggedIN = ($this->userID !== FALSE && $this->isLoggedIN !== FALSE && is_numeric($this->userID) && $this->userID > 0 && $this->isLoggedIN === TRUE) ? TRUE : FALSE; // check if the user is actually logged in
	}

	public function save()
	{
		$responseData = array();
		$responseData['isValid'] = FALSE;
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['result'] = NULL;
		
		$ctype = (($this->input->post('ctype',TRUE) !== FALSE)? $this->input->post('ctype',TRUE): 1);
		$comment = (($this->input->post('comments',TRUE) !== FALSE)? $this->input->post('comments',TRUE): NULL);
		$pid = (($this->input->post('pid',TRUE) !== FALSE)? $this->input->post('pid',TRUE): NULL);
		
		if($this->isReallyLoggedIN === TRUE)
		{
			$responseData['isLoggedIN'] = TRUE;
			if(!is_null($ctype) && !is_null($comment) && !is_null($pid))
			{
				$responseData['isValid'] = TRUE;
				$responseData['result'] = $this->comments_model->saveComment($ctype, $comment, $pid, $this->userID);
			}
		}
        
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function update($commentID)
	{
		$responseData = array();
		$responseData['isValid'] = FALSE;
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		$responseData['result'] = NULL;
		
		$comment = (($this->input->post('comments',TRUE) !== FALSE)? $this->input->post('comments',TRUE): NULL);
		
		if($this->isReallyLoggedIN === TRUE)
		{
			$responseData['isLoggedIN'] = TRUE;
			if(!is_null($comment))
			{
				$responseData['isValid'] = TRUE;
				$responseData['result'] = $this->comments_model->updateComment($comment, $commentID, $this->userID);
			}
		}
        
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}

	public function read($productID)
	{
		$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;
		
		$responseData['result'] = $this->comments_model->readComments($productID);
	
	    $response = json_encode($responseData);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
    }

    public function delete($commentID)
    {
    	$responseData = array();
		$responseData['isLoggedIN'] = $this->isReallyLoggedIN;

		if($this->isReallyLoggedIN === TRUE)
		{
			$userID = $this->session->userdata('id');
			$responseData['isLoggedIN'] = TRUE;
			$responseData['result'] = $this->comments_model->deleteComment($commentID,$userID);
        }
        else
        {
        	$responseData['result'] = NULL;
        }
        $response = json_encode($responseData);
        $this->output->set_content_type('application/json');
		$this->output->set_output($response);
    }
}
?>