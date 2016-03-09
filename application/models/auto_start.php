<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized!');

class Auto_start extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		header('X-Powered-By: BNBTech 2.0'); //  set the default powered by header for branding
		header('Server: BuynBrag Web Server'); //  change the default server header for security
		/* to shut down the website, uncomment following two lines */
		// $this->load->view("website_down");
		// return TRUE;
		
		// execute the following block only when the machine is not local
		// and if the domain is 
		if($this->input->ip_address() != '127.0.0.1' && strcasecmp($this->input->server('SERVER_NAME'), 'dev.buynbrag.com') !== 0 && strcasecmp($this->input->server('SERVER_NAME'), 'buyandbrag.in') !== 0)
		{
			/* autostart code block to automatically save the http referer */
			$this->load->library('user_agent');

			if ($this->agent->is_referral())
			{
				$sessionDBID = ($this->session->userdata('DBID') === FALSE)? 0: $this->session->userdata('DBID');
				$sessionUserID = ($this->session->userdata('id') === FALSE)? 0: $this->session->userdata('id');
			    
			    $this->db->set('sessionDBID', $sessionDBID);
			    $this->db->set('user_id', $sessionUserID);
			    $this->db->set('fromURL1', $this->agent->referrer());
			    $this->db->set('toURL1', current_url());
			    $this->db->set('ts', time());
			    $___tQry = $this->db->insert('traffic_info');
			    switch($___tQry)
			    {
			    	case TRUE:	$trafficID = $this->db->insert_id();
			    				$this->session->set_userdata( array( 'tID' => $trafficID ) );
			    		break;
			    }
			}
			/* END SECTION autostart code block to automatically save the http referer */
		}
	}
}
?>