<?php if(! defined ('BASEPATH') ) exit('403 Unathorized');
class Slog extends CI_Model
{
	public $collection = NULL;
	public $dbConn = NULL;
	public $sessionData = NULL;
	public $autoDocumentData = NULL;
	public $ciSessions = NULL;
	public $cLog = NULL;

	public function __construct()
	{
		parent::__construct();

		$this->config->load('mongodb', TRUE);

		$mongoServer = $this->config->item('mongoServer', 'mongodb');
		$mongoSloggerUser = $this->config->item('mongoSloggerUser', 'mongodb');
		$mongoSloggerUserPassword = $this->config->item('mongoSloggerUserPassword', 'mongodb');
		$mongoSloggerDBName = $this->config->item('mongoSloggerDBName', 'mongodb');


		$params = array("username" => $mongoSloggerUser, "password" => $mongoSloggerUserPassword, "db" => $mongoSloggerDBName);

		$sloggerConn = NULL;

		try
		{
			$sloggerConn = new MongoClient("mongodb://".$mongoServer, $params);
			$this->dbConn = $sloggerConn->{$mongoSloggerDBName};
			$this->ciSessions = $this->dbConn->ci_sessions;
			$this->cLog = $this->dbConn->clog;

			$this->sessionData = $session = $this->session->all_userdata();
			$isLoggedIN = (($this->session->userdata('logged_in') !== FALSE)? TRUE: FALSE);
			
			$bnbUID = (($this->session->userdata('id') !== FALSE)? $this->session->userdata('id'): NULL);

			$tCollectionName = NULL;

			// compute the name of the current collection name

			switch($isLoggedIN === TRUE)
			{
				case TRUE:	$tCollectionName = "bnb__".$bnbUID; // create/connect a/to collection of the format bnb__X where X is the buynbrag user_id of the user who is logged-in
					break;
				case FALSE:	$tCollectionName = "ci_sessions"; //  create/connect a/to collection of the format ci_session_dbid__X where X is the unique id of the row in the buynbrag_sessions table
							/* the naming convention for the collection that will store the log for a user that is not logged-in
							has been changed so that all log of the non-logged-in users will be stored in the collection ci_sessions */
					break;
			}

			if($this->dbConn !== NULL)
			{
				$activityCounter = NULL;

				$activityCounterQuery = array('_id' => 0);

				$activityCounterCursor = $sloggerConn->slog->activityCounter->find($activityCounterQuery)->limit(1);

				if($activityCounterCursor->hasNext())
				{
					$tData = $activityCounterCursor->getNext();
					$activityCounter = $tData['currentCounter'];
				}
				else
				{
					/*
					If execution reaches this point, it means that either the activityCounter collection does not exist
					or there is no document in the collection with _id = 0. 
					So, we will create a new collection/document or both in the database
					*/
					$sloggerConn->slog->activityCounter->save(array('_id' => 0, 'currentCounter' => 0));
					$activityCounter = 0;
				}

				$activityCounter++; // increment the counter by 1

				$activityQuery = array('collectionName' => $tCollectionName);

				$activityCursor = $sloggerConn->slog->activity->find($activityQuery)->limit(1);

				if($activityCursor->hasNext())
				{
					$tData = $activityCursor->getNext();
					$sloggerConn->slog->activity->save( array('_id' => $tData['_id'], 'collectionName' => $tCollectionName, 'lastWrite' => time()) );
				}
				else
				{
					$sloggerConn->slog->activity->save( array('_id' => $activityCounter, 'collectionName' => $tCollectionName, 'lastWrite' => time()) );
					$sloggerConn->slog->activityCounter->save(array('_id' => 0, 'currentCounter' => $activityCounter));
				}

				/*
				- create a collection named activityCounter
				-- this will contain the counter that will be assigned to the next document in activity collection as its unique _id for its primary key
				-- to get the value of this counter, read the document with _id = 0. It will contain an attribute named currentCounter.
				-- Read and increment and then store the value of "currenCounter" attribute in $__ID
				---
				- create a colletion named activity
				-- find if there's an entry with "collectionName": $tCollectionName.
				--- if there is, read its "_id" and update its "lastWrite" attribute with the current timestamp
				--- if there isn't, insert a new document as {"_id": $__ID, "collectionName": $tCollectionName, "lastWrite": time() }
				---- save the incremented value of the activityCounters.currentCounter by 1
				*/

				$this->collection = $sloggerConn->slog->{$tCollectionName}; // create a collection with the current session's DBID

				$this->autoDocumentData = array
								(
									"_CI_session_id"	=>	$this->sessionData['session_id'],
									"_CI_ip_address"	=>	ip2long($this->sessionData['ip_address']),
									"_CI_user_agent"	=>	$this->sessionData['user_agent'],
									"_CI_last_activity"	=>	$this->sessionData['last_activity'],
									"_CI_user_data"	=>	$this->sessionData['user_data'],
									"_CI_DBID"	=>	(integer) $this->sessionData['DBID'],
									"_BNB_logged_in"	=>	(($this->session->userdata('logged_in') !== FALSE)? TRUE: FALSE),
									"_BNB_id"	=>	(($this->session->userdata('id') !== FALSE)? $this->session->userdata('id'): NULL),
									"_SLOG_timestamp"	=>	time()
								);
			}
		}
		catch(MongoConnectionException $e)
		{
			$sloggerConn = NULL;
		}
	}

	public function write($document)
	{
		if($this->dbConn !== NULL)
		{
			if(! is_array($document) )
			{
				$document = array("nonArrayData" => $document);
			}
			$savedDocument = array_merge($this->autoDocumentData, $document);
			// add a record
			$this->collection->insert($savedDocument); // write to the required log collection
			$this->cLog->insert($savedDocument); // write to the central log as well
		}
	}

	public function readLog()
	{
		$cursor = $this->dbConn->activity->find()->sort(array("lastWrite" => -1));
		
		return $cursor;
    }

    public function readCISessions()
    {
    	$cursor = $this->ciSessions->find()->limit(300)->sort( array("_SLOG_timestamp" => -1) );

    	return $cursor;
    }

    public function readClog()
    {
    	//$cursor = $this->cLog->find()->limit(300)->sort( array( "_SLOG_timestamp" => -1 ) );
    	$cursor = $this->cLog->find()->limit(300);

    	return $cursor;
    }

    public function deleteActivity($activityID)
    {
    	log_message("INFO", "\$activityID = ".print_r($activityID, TRUE));
    	$activityDataCursor = $this->dbConn->activity->find(array('_id' => $activityID)); // read the activity data
    	$activityData = NULL;
    	if( $activityDataCursor->hasNext() )
    	{
    		$activityData = $activityDataCursor->getNext();
    		log_message('INFO', "\$activityDataCursor has data ");
    	}
    	$collectionName = $activityData['collectionName'];
    	log_message('INFO', "collectionName = ".$collectionName." \r\n\$activityData = ".print_r($activityData, TRUE));
    	$response1 = $this->dbConn->execute("db".$collectionName."drop()"); // drop the collection read in the activity data
    	log_message('INFO', "\$response1 = ".print_r($response1, TRUE));
    	$response2 = $this->dbConn->activity->remove(array('_id' => $activityID)); // remove the activity entry from activity collection
    	log_message('INFO', "\$response2 = ".print_r($response2, TRUE));
    	return array($collectionName, $response1, $response2, $activityData); // return the response from the remove and drop commands to the caller
    }
}
?>