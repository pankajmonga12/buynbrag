<?php if( ! defined ( 'BASEPATH' ) ) exit( '403 Unauthorized!' );

class Test extends CI_Controller
{	
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->baseURL = base_url();
		if( !$this->input->is_cli_request() ) // if the controller is not being run from the command line
		{ 
			if (!isset($_SERVER['PHP_AUTH_USER']))
			{
				header('WWW-Authenticate: Basic realm="BuynBrag Technology Division"');
				header('HTTP/1.1 401 Unauthorized');
				echo '<p>Unauthorized access can lead you to prison. DO NOT play with fire! ITS DANGEROUS!!!</p>';
				exit;
			}
			else
			{
				if( strcmp( $_SERVER['PHP_AUTH_USER'], "sam@buynbrag.com" ) === 0 && strcmp( $_SERVER['PHP_AUTH_PW'], "szzdell" ) === 0 )
				{
					// do nothing. I.e., continue as the request has been authorized
				}
				else
				{
					header('HTTP/1.0 403 Forbidden');
					echo "<p>DO NOT tread in forbidden waters!</p>";
					exit; // end further execution
				}
			}
	    }
	}

	public function cilogs()
	{
	    /*
	    highly advised that you use authentification 
	    before running this controller to keep the world out of your logs!!!
	    you can use whatever method you like does not have to be logs
	    */
	    $this->load->spark( 'fire_log/0.8.2');
	    // thats it, ill take if from there
	}
	
	public function index()
	{
		phpinfo();
	}
}