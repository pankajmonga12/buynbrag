<?php
	include(APPPATH.'libraries/facebook/facebook.php');

	class Fb_connect extends Facebook{

		//declare public variables
		public $user 		= NULL;
		public $user_id 	= FALSE;
                public $friends         = NULL;
                public $fb 		= FALSE;
		public $fbSession	= FALSE;
		public $appkey		= 0;

		//constructor method.
		public function __construct()
		{
                    $CI = & get_instance();
                    $CI->config->load("facebook",TRUE);
                    $config = $CI->config->item('facebook');
                    parent::__construct($config);
                    $this->user_id = $this->getUser(); // New code

                    $me = null;
                    $friends = null;
                    if ($this->user_id) {
                        try {
                            $me = $this->api('/me');
                            $friends = $this->api('/me/friends');
                            $this->user = $me;
                            $this->friends = $friends;
                            } catch (FacebookApiException $e) {
                                error_log($e);
                            }
			}
		} 

	} // end class
?>