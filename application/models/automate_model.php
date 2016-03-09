<?php if( ! defined ('BASEPATH') ) exit('403 Unauthorized');

class Automate_model extends CI_Model
{
	public $collection;
	public $dbConnection;
	public $sessionData;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');

		$this->config->load('mongodb', TRUE);

		$mongoServer = $this->config->item('mongoServer', 'mongodb');
		$mongoAutomationUser = $this->config->item('mongoAutomationUser', 'mongodb');
		$mongoAutomationUserPassword = $this->config->item('mongoAutomationUserPassword', 'mongodb');
		$mongoAutomationDBName = $this->config->item('mongoAutomationDBName', 'mongodb');
		$mongoAutomationCollectionName = $this->config->item('mongoAutomationCollectionName', 'mongodb');

		$params = array("username" => $mongoAutomationUser, "password" => $mongoAutomationUserPassword, "db" => $mongoAutomationDBName);

		$autoConn = new MongoClient("mongodb://".$mongoServer, $params);

		$this->dbConnection = $autoConn->{$mongoAutomationDBName};

		$this->collection = $this->dbConnection->{$mongoAutomationCollectionName};

		$this->sessionData = $this->session->all_userdata();
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
						4 = check and then send email job depending upon the result of the check
						5 = create job(s) based on the fancied product to send mail to everyone who have fancied the product intimating about the latest user who has fancied it
						6 = 12th day coupon mail
						7 = 13th day coupon mail
						8 = 14th day coupon mail */
						"jobType" => $jobType,
						"jobScheduledTime" => $jobScheduledTime, /*  The time only after which the job will be executed */
						"jobCreatedBy" => (integer) $this->sessionData['DBID'], /* the unique "id" (in MySQL) of the codeigniter session which created this job */
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
		$jobQueueCursor = $this->collection->find($jobReadQuery)->sort( array('jobCreatedAt' => 1) )->limit(100); // max rate can be 4200 emails per minute

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
		/* query the database for the next job in queue an sort the data in ascending order based on the jobCreatedAt attribute and limit the total results to 6 */
		$jobQueueCursor = $this->collection->find( $jobReadQuery )->sort( array('jobCreatedAt' => 1) )->limit(6);

		while( $jobQueueCursor->hasNext() )
		{
			$retVal[] = $jobQueueCursor->getNext();
		}

		return $retVal;
	}

	public function getFancyProductComputerJobs()
	{
		$retVal = NULL;

		$jobReadQuery = array( 'jobType' => 5, 'jobStatus' => 0, 'jobScheduledTime' => array( '$lt' => time() ), 'jobExecutionStart' => NULL );
		/* query the database for the next job in queue an sort the data in ascending order based on the jobCreatedAt attribute and limit the total results to 10 */
		$jobQueueCursor = $this->collection->find( $jobReadQuery )->sort( array('jobCreatedAt' => 1) )->limit(50);

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

	public function execStatus( $jobType, $definition = NULL )
	{
		$retVal = NULL;

		$executionStatusQuery = array( '_id' => ($jobType - 1) );

		$execStatusCursor = $this->dbConnection->execStatus->find($executionStatusQuery);
		
		if( $execStatusCursor->hasNext() )
		{
			$execStatusData = $execStatusCursor->getNext();
			$retVal = $execStatusData['execStatus'];
		}
		else
		{
			$newExecDocument = array( '_id' => $executionStatusQuery['_id'], 'execStatus' => FALSE, 'definition' => $definition );
			
			$this->dbConnection->execStatus->insert($newExecDocument);
			
			$retVal = FALSE;
		}

		return $retVal;
	}

	public function execStart( $jobType )
	{
		$retVal = NULL;

		$updateCriteria = array( '_id' => ($jobType - 1) );

		$valuesToUpdate = array( 'execStatus' => TRUE );

		$this->dbConnection->execStatus->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array( 'upsert' => TRUE, 'multiple' => TRUE ) );
	}

	public function execStop( $jobType )
	{
		$retVal = NULL;

		$updateCriteria = array( '_id' => ($jobType - 1) );

		$valuesToUpdate = array( 'execStatus' => FALSE );

		$this->dbConnection->execStatus->update( $updateCriteria, array( '$set' => $valuesToUpdate ), array( 'upsert' => FALSE, 'multiple' => TRUE ) );
	}

	public function readFancyUserDetails($userID, $productID)
	{
		$retVal = NULL;
		$this->slog->write( array( 'level' => 1, 'msg' => 'automate_model/readFancyUserDetails fired') );
		log_message('INFO', 'automate_model/readFancyUserDetails fired');
		$this->db->select('user_id AS userID');
		$this->db->select('full_name AS userFullName');
		$this->db->select('gender AS userGender');
		$this->db->select('fb_uid AS userFBID');
		$this->db->select('joined_date AS memberSince');
		$this->db->select('(SELECT COUNT(DISTINCT(user_id)) FROM fancy_products WHERE(product_id = '.$productID.' AND user_id <> '.$userID.'))AS totalFanciedUsers');
		$this->db->select('(SELECT COUNT(DISTINCT(product_id)) FROM fancy_products WHERE(user_id = '.$userID.')) AS totalFanciedProducts');
		$this->db->select('(SELECT store_id FROM products WHERE product_id = '.$productID.' LIMIT 1) AS storeID');
		$this->db->select('(SELECT product_name FROM products WHERE product_id = '.$productID.' LIMIT 1) AS productName');
		$this->db->select('(SELECT rank FROM fancy_rank WHERE user_id = '.$userID.' LIMIT 1) AS userRank');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE:	$retVal = $query->result();
						$retVal = $retVal[0];
				break;
			case FALSE:	$retVal = NULL;
				break;
		}
		return $retVal;
	}

	public function readFancyProductUsers($productID, $userID, $timeStampBefore)
	{
		$retVal = NULL;
		$this->slog->write( array( 'level' => 1, 'msg' => 'automate_model/readFancyProductUsers fired') );
		log_message( 'INFO', 'automate_model/readFancyProductUsers fired' );
		$this->db->select('fancy_products.user_id AS userID');
		$this->db->select('user_details.full_name AS userFullName');
		$this->db->select('user_details.email AS emailAddress');
		//$this->db->select('user_details.joined_date AS memberSince');
		//$this->db->select('user_details.gender AS userGender');
		//$this->db->select('user_details.fb_uid AS userFBID');
		$this->db->from('fancy_products');
		$this->db->join('user_details', 'fancy_products.user_id = user_details.user_id', 'left');
		$this->db->where('fancy_products.user_id <> ', $userID);
		$this->db->where('fancy_products.product_id', $productID);
		$this->db->where('fancy_products.time < ', $timeStampBefore);
		$query = $this->db->get();
		$this->slog->write( array( 'level' => 1, 'msg' => "JUST RAN THE FOLLOWING QUERY___\r\n".$this->db->last_query() ) );
		log_message( 'INFO', "JUST RAN THE FOLLOWING QUERY___\r\n".$this->db->last_query() );
		switch($query->num_rows() > 0)
		{
			case TRUE: $retVal = $query->result();
				break;
		}
		$this->slog->write( array( 'level' => 1, 'msg' => "returning \$retVal = ".json_encode($retVal) ) );
		log_message( 'INFO', "returning \$retVal = ".json_encode($retVal) );
		return $retVal;
	}

	public function getUnusedCouponUsers($daysPassed = 12)
	{
		/*

		LOGIC BEING USED
		

		QUERY BEING USED
		
		-- for 13thday

		select sno, couponid, coupon.user_id, validFrom, validUpto, minPurchaseAmount, email,
		((((validUpto - validFrom) / 60) / 60) / 24) as totalValidDays,
		((((validUpto - unix_timestamp(current_timestamp)) / 60) / 60) / 24) as validDaysLeft
		from coupon
		left join user_details on coupon.user_id = user_details.user_id
		where
		unix_timestamp(current_timestamp) >= (validFrom+(12 * 24 * 3600))
		and
		unix_timestamp(current_timestamp) < (validFrom+(13 * 24 * 3600))
		and
		unix_timestamp(current_timestamp) < validUpto
		and usecount > 0
		and coupon.user_id != 0;
		
		*/
		$currentTime = time(); // get the current time
		// set the lower limit for the number of days after which the user is to be selected
		$dayLowerLimit = $daysPassed * 24 * 3600;

		// set the upper limit for the number of days uptill which a user is to be selected
		$dayUpperLimit = $dayLowerLimit + (24 * 3600);

		$this->db->select('coupon.user_id AS userID');
		$whereText = '((coupon.validFrom - '.$currentTime.') >= '.$dayLowerLimit.') AND (coupon.validFrom ';
		$this->db->where('');
	}
}
?>