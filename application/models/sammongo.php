<?php if(! defined ('BASEPATH') ) exit('403 Unathorized');
class Sammongo extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function connect($serverName, $userName, $password, $dbName = NULL)
	{
		// Specifying the username and password via the options array (alternative)
		$params = array("username" => $userName, "password" => $password);
		switch(! is_null($dbName) )
		{
			case TRUE: $params['db'] = $dbName;
				break;
		}
		return new MongoClient("mongodb://".$serverName, $params);
	}

	public function selectDB($dataBase, $mongoLink)
	{
		// select a database
		return $mongoLink->{$dataBase};
	}

	public function selectCollection(&$collection, $db)
	{
		// select a collection (analogous to a relational database's table)
		return $db->{$collection};
	}

	public function insert(&$collection, $document)
	{
		// add a record
		$collection->insert($document); // the document is a collection
	}

	public function getCursor(&$collection)
	{
		return $collection->find();
	}
}
?>