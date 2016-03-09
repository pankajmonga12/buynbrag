<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');
class Badgesc extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function all($userID = NULL)
	{
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		$badges = NULL;
		$responseData = array();
		switch($isLoggedIN['status'] === TRUE)
		{
			case TRUE:switch(is_null($userID))
					{
						case TRUE:$responseData['isLoggedIN'] = TRUE;
									$responseData['hasUserID'] = TRUE;
									$responseData['badges'] = $this->async_model->badges($isLoggedIN['uid']);
							break;
						case FALSE:$responseData['isLoggedIN'] = TRUE;
									$responseData['hasUserID'] = FALSE;
									$responseData['badges'] = $this->async_model->badges($userID);
							break;
					}
				break;
			case FALSE: switch(is_null($userID))
					{
						case TRUE:$responseData['isLoggedIN'] = FALSE;
									$responseData['hasUserID'] = FALSE;
									$responseData['badges'] = NULL;
							break;
						case FALSE:$responseData['isLoggedIN'] = FALSE;
									$responseData['hasUserID'] = TRUE;
									$responseData['badges'] = $this->async_model->badges($userID);
							break;
					}
				break;
		}
		$response = json_encode($responseData, JSON_FORCE_OBJECT);
		$this->output->set_content_type('application/json');
		$this->output->set_output($response);
	}
}
?>
