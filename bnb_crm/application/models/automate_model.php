<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');

class Automate_model extends CI_Model
{
	public $collection;
	public $dbConnection;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$mongoServer = 'ec2-175-41-180-143.ap-southeast-1.compute.amazonaws.com';

		$mongoUser = 'bnbdev';
		$mongoUserPassword = 'bnz483rgiuweh';
		$mongoDBName = "admin";
		
		$mongoAutomationUser = "automator";
		$mongoAutomationUserPassword = "bs27t3ekjwed";
		$mongoAutomationDBName = 'automation';
		$mongoAutomationCollectionName = 'queue';
		
		$mongoSloggerUser = "slogger";
		$mongoSloggerUserPassword = "jsetr347hweiuf";
		$mongoSloggerDBName = "slog";

		$params = array("username" => $mongoAutomationUser, "password" => $mongoAutomationUserPassword, "db" => $mongoAutomationDBName);

		$autoConn = new MongoClient("mongodb://".$mongoServer, $params);

		$this->dbConnection = $autoConn->{$mongoAutomationDBName};

		$this->collection = $this->dbConnection->{$mongoAutomationCollectionName};
	}

	public function createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetailsDocument)
	{
		$queueCounter = NULL;
		$queueCounterQuery = array('_id' => 0);

		$queueCounterCursor = $this->dbConnection->queueCounter->find($queueCounterQuery)->limit(1);

		if($queueCounterCursor->hasNext())
		{
			$tData = $queueCounterCursor->getNext();
			$queueCounter = $tData['currentCounter'];
		}
		else
		{
			/*
			If execution reaches this point, it means that either the queueCounter collection does not exist
			or there is no document in the collection with _id = 0. 
			So, we will create a new collection/document or both in the database
			*/
			$this->dbConnection->queueCounter->save(array('_id' => 0, 'currentCounter' => 0));
			$queueCounter = 0;
		}

		$queueCounter++; // increment the counter by 1

		$isLoggedIN = (($this->session->userdata('logged_in') !== FALSE)? TRUE: FALSE);
		$bnbUID = (($this->session->userdata('id') !== FALSE)? $this->session->userdata('id'): NULL);

		$defaultDocument = array
					(
						"_id" => $queueCounter, /* a unique ID for each job */
						/* type of job.
						1 = email,
						2 = homepage data,
						3 = generate sitemap,
						4 = check and then send email job depending upon the result of the check */
						"jobType" => $jobType,
						"jobScheduledTime" => $jobScheduledTime, /*  The time only after which the job will be executed */
						"jobCreatedBy" => "BuynBrag CRM", /* the unique "id" (in MySQL) of the codeigniter session which created this job */
						"jobCreatedAt" => time(), /* the timestamp at which this job is being created */
						"jobCreatedFromIP" => ip2long($this->input->ip_address()), /* the ip address from which this job was created */
						"jobCreatedFromBrowser" => $this->input->user_agent(), /* the user agent which was used to create this job */
						"jobStatus" => 0, /* status of the job. 0 = created, 1 = executing, 2 = finished */
						"jobSuccessful" => FALSE, /* contains a value of php TRUE if the command executed successfully. For eg, if a mail had to be sent and was sent successfully, then it will have a value of TRUE and FALSE otherwise */
						"jobCommand" => $jobCommand, /* the complete command which will be executed EG:- "php5 /var/www/dev/index.php automate purgeCache" */
						"jobExecutionStart" => NULL, /* the timestamp at which the job execution was started */
						"jobExecutionEnd" => NULL /* the timestamp at which the job finished execution */
					);

		$savedDocument = array_merge($defaultDocument, $jobDetailsDocument); // merge the default job document with the one being provided by the job creator
		$this->collection->save($savedDocument); // create a new task in the db
		$this->dbConnection->queueCounter->save( array('_id' => 0, 'currentCounter' => $queueCounter) ); // save the counter in the database
	}

	public function getNextJob() // automatically gets the next job in queue which is to be executed
	{
		/*
		Set the condition to read the job from the database.
		Read only those jobs which have a status of 0 and whose execution has not started and which have a jobScheduledTime less than the current timestamp.
		*/
		$jobReadQuery = array('jobStatus' => 0, 'jobScheduledTime' => array('$lt' => time()), 'jobExecutionStart' => NULL); 

		/* query the database for the next job in queue an sort the data in ascending order based on the jobCreatedAt attribute and limit the total results to 1 */
		$jobQueueCursor = $this->collection->find($jobReadQuery)->sort( array('jobCreatedAt' => 1) );

		if( $jobQueueCursor->hasNext() )
		{
			return $jobQueueCursor->getNext();
		}
		else
		{
			return NULL;
		}
	}

	public function getJob($jobID) // read a job based on its ID
	{
		$jobReadQuery = array( '_id' => $jobID );

		return $this->collection->findOne( $jobReadQuery );
	}

	public function startJob($jobID) // start a job in the db by updating its jobExecutionStart attibute to the current timestamp and its jobStatus attribute to 1
	{
		$updateCriteria = array( '_id' => $jobID );

		$valuesToUpdate = array( 'jobStatus' => 1, 'jobExecutionStart' => time() );

		$this->collection->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array('upsert' => FALSE, 'multiple' => FALSE) );
	}

	public function finishJob($jobID, $jobResult = FALSE, $extraInfo = NULL) // finish a job in the db by updating its jobExecutionEnd attribute to the current timestamp and its jobStatus attribute to 2
	{													  // and set the value of jobSuccessful attribute depending upon the jobResult parameter and save the extaInfo as well if it is not NULL
		$updateCriteria = array( '_id' => $jobID );		  // Please note that the extraInfo must be an associative array else its discarded

		$valuesToUpdate = array( 'jobStatus' => 2, 'jobSuccessful' => $jobResult, 'jobExecutionEnd' => time() );

		if(! is_null($extraInfo)  && is_array($extraInfo) )
		{
			$valuesToUpdate = array_merge($valuesToUpdate, $extraInfo);
		}

		$this->collection->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array('upsert' => FALSE, 'multiple' => FALSE) );
	}

	public function getEmailJobs() // automatically gets the next job in queue which is to be executed
	{
		$retVal = NULL;
		/*
		Set the condition to read the job from the database.
		Read only those jobs which have a status of 0 and whose execution has not started and which have a jobScheduledTime less than the current timestamp.
		*/
		$jobReadQuery = array( 'jobType' => 1, 'jobStatus' => 0, 'jobScheduledTime' => array('$lt' => time()), 'jobExecutionStart' => NULL );

		/* query the database for the next job in queue an sort the data in ascending order based on the jobCreatedAt attribute and limit the total results to 1 */
		$jobQueueCursor = $this->collection->find($jobReadQuery)->sort( array('jobCreatedAt' => 1) )->limit(6);

		while( $jobQueueCursor->hasNext() )
		{
			$retVal[] = $jobQueueCursor->getNext();
		}
		
		return $retVal;
	}

	public function getCheckAndEmailJobs()
	{
		$retVal = NULL;

		$jobReadQuery = array( 'jobType' => 4, 'jobStatus' => 0, 'jobScheduledTime' => array( '$lt' => time() ), 'jobExecutionStart' => NULL );
		/* query the database for the next job in queue an sort the data in ascending order based on the jobCreatedAt attribute and limit the total results to 1 */
		$jobQueueCursor = $this->collection->find( $jobReadQuery )->sort( array('jobCreatedAt' => 1) )->limit(6);

		while( $jobQueueCursor->hasNext() )
		{
			$retVal[] = $jobQueueCursor->getNext();
		}

		return $retVal;
	}

	public function startJobs($jobIDs) // start a job in the db by updating its jobExecutionStart attibute to the current timestamp and its jobStatus attribute to 1
	{
		$updateCriteria = NULL;

		if( is_array($jobIDs) )
		{
			$updateCriteria = array( '_id' => array( '$in' => $jobIDs ) );
		}
		else
		{
			$updateCriteria = array( '_id' => $jobIDs );
		}

		$valuesToUpdate = array( 'jobStatus' => 1, 'jobExecutionStart' => time() );

		$this->collection->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array('upsert' => FALSE, 'multiple' => TRUE) );
	}

	public function finishJobs($jobID, $jobResult = FALSE, $extraInfo = NULL) // finish a job in the db by updating its jobExecutionEnd attribute to the current timestamp and its jobStatus attribute to 2
	{													  // and set the value of jobSuccessful attribute depending upon the jobResult parameter and save the extaInfo as well if it is not NULL
		$updateCriteria = NULL;							// Please note that the extraInfo must be an associative array else its discarded

		if( is_array($jobIDs) )
		{
			$updateCriteria = array( '_id' => array( '$in' => $jobIDs ) );
		}
		else
		{
			$updateCriteria = array( '_id' => $jobIDs );
		}

		$valuesToUpdate = array( 'jobStatus' => 2, 'jobSuccessful' => $jobResult, 'jobExecutionEnd' => time() );

		if(! is_null($extraInfo)  && is_array($extraInfo) )
		{
			$valuesToUpdate = array_merge($valuesToUpdate, $extraInfo);
		}

		$this->collection->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array('upsert' => FALSE, 'multiple' => TRUE) );
	}

	public function execStatus( $jobType )
	{
		$retVal = NULL;

		$executionStatusQuery = array( '_id' => ($jobType - 1) );

		$execStatusCursor = $this->dbConnection->execStatus->find($executionStatusQuery);
		
		if( $execStatusCursor->hasNext() )
		{
			$execStatusData = $execStatusCursor->getNext();
			$retVal = $execStatusData['execStatus'];
		}

		return $retVal;
	}

	public function execStart( $jobType )
	{
		$retVal = NULL;

		$updateCriteria = array( '_id' => ($jobType - 1) );

		$valuesToUpdate = array( 'execStatus' => TRUE );

		$this->dbConnection->execStatus->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array( 'upsert' => FALSE, 'multiple' => TRUE ) );
	}

	public function execStop( $jobType )
	{
		$retVal = NULL;

		$updateCriteria = array( '_id' => ($jobType - 1) );

		$valuesToUpdate = array( 'execStatus' => FALSE );

		$this->dbConnection->execStatus->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array( 'upsert' => FALSE, 'multiple' => TRUE ) );
	}
}
?>