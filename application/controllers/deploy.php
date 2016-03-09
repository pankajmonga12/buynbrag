<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized!');

class Deploy extends CI_Controller
{

  /**
  * A callback function to call after the deploy has finished.
  * 
  * @var callback
  */
  public $post_deploy;

  /**
  * The name of the file that will be used for logging deployments. Set to 
  * FALSE to disable logging.
  * 
  * @var string
  */
  private $_log = '/var/www/dev/bnb-l/application/logs/deployments.log';

  /**
  * The timestamp format used for logging.
  * 
  * @link    http://www.php.net/manual/en/function.date.php
  * @var     string
  */
  private $_date_format = 'Y-m-d H:i:sP';

  /**
  * The name of the branch to pull from.
  * 
  * @var string
  */
  private $_branch = 'master';

  /**
  * The name of the remote to pull from.
  * 
  * @var string
  */
  private $_remote = 'origin';

  /**
  * The directory where your website and git repository are located, can be 
  * a relative or absolute path
  * 
  * @var string
  */
  private $_directory;

  private $_currentBranch = NULL;

  /**
  * Sets up defaults.
  * 
  * @param  string  $directory  Directory where your website is located
  * @param  array   $data       Information about the deployment
  */
  public function __construct()
  {
    parent::__construct();
  }

  /**
  * Writes a message to the log file.
  * 
  * @param  string  $message  The message to write
  * @param  string  $type     The type of log message (e.g. INFO, DEBUG, ERROR, etc.)
  */
  public function log($message, $type = 'INFO')
  {
    if ($this->_log)
    {
      // Set the name of the log file
      $filename = $this->_log;

      if ( ! file_exists($filename))
      {
        // Create the log file
        file_put_contents($filename, '');

        // Allow anyone to write to log files
        chmod($filename, 0666);
      }

      // Write the message into the log file
      // Format: time --- type: message
      file_put_contents($filename, date($this->_date_format).' --- '.$type.': '.$message.PHP_EOL, FILE_APPEND);
    }
  }

  public function pd()
  {
    // hit the wp-admin page to update any db changes
    /*exec('curl http://www.foobar.com/wp-admin/upgrade.php?step=upgrade_db');
    $deploy->log('Updating wordpress database... ');*/

    $this->load->library('email');
    $this->email->from('support@buynbrag.com', 'BuynBrag');
    $this->email->to('sam@buynbrag.com');
    $this->email->subject("BNBAD ::: Your automated pull is complete!");

    $msg = "Your automated pull is complete! The posted data is :\r\n<hr><pre>".$this->input->post()."</pre>";

    $this->email->message($msg);
    $this->email->set_newline("\r\n");

    if($this->email->send())
    {
       $this->log(" Successfully SENT deployment mail");
    }
    else
    {
       $this->log(" Error sending following deployment MAIl");
    }
  }

  /**
  * Executes the necessary commands to deploy the website.
  */
  public function execute($directory, $options = array())
  {
    date_default_timezone_set('Asia/Kolkata');
    // Determine the directory path
    $this->_directory = realpath($directory).DIRECTORY_SEPARATOR;

    $available_options = array('log', 'date_format', 'branch', 'remote');

    foreach ($options as $option => $value)
    {
      if (in_array($option, $available_options))
      {
        $this->{'_'.$option} = $value;
      }
    }

    exec('git branch', $output, $retVal);

    foreach ($output as $branch)
    {
      $starPos = strpos($branch, '*');
      if( $starPos === 0 )
      {
        $this->_currentBranch = str_replace('*', '', $branch);
        break;
      }
    }

    if(strcmp($this->_currentBranch, '') === 0 || is_null($this->_currentBranch))
    {
      exec('git checkout master', $output, $retVal); // switch to master branch if no branch has been checked-out yet
      $this->_currentBranch = 'master';
    }

    $this->log('Attempting deployment...');

    //---------------------
    
    try
    {
      // Make sure we're in the right directory
      $this->log('Executing command:::___ cd '.$this->_directory);
      exec('cd '.$this->_directory, $output);
      $this->log('Changing working directory... '.implode(' ', $output));

      // Discard any changes to tracked files since our last deploy
      $this->log('Executing command:::___ git reset --hard HEAD');
      exec('git reset --hard HEAD', $output);
      $this->log('Reseting repository... '.implode(' ', $output));

      // Update the local repository
      $this->log('Executing command:::___ git pull '.$this->_remote.' '.$this->_currentBranch);
      exec('git pull '.$this->_remote.' '.$this->_currentBranch, $output);
      $this->log('Pulling in changes... '.implode(' ', $output));

      // Secure the .git directory
      $this->log('Executing command:::___ chmod -R og-rx .git');
      exec('chmod -R og-rx .git');
      $this->log('Securing .git directory... ');

      $this->pd();

      $this->log('Deployment successful.');
    }
    catch (Exception $e)
    {
      $this->log($e, 'ERROR');
    }
  }

  public function index()
  {
    $this->post_deploy = 'pd';

    $this->execute('/var/www/dev/bnb-l');
  }
}

?>