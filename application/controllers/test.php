<?php if( ! defined ( 'BASEPATH' ) ) exit( '403 Unauthorized!' );
class badgeDetailsTest
{
	public $type;
	public $typeDesc;
	public $level;
	public $notificationText;
}


class Test extends CI_Controller
{
	private $userid = "";
	public $baseURL = "https://buynbrag.com/";

	//private $userdetails = array();
	
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('slog');
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

	public function fixShoppingBadge( $live = 0 )
	{
		log_message('DEBUG', "inside test/fixShoppingBadge/".($live == 0? 'TEST_DB': 'LIVE_DB') );
		$dbName = "bnbdbTest";
		switch( $live )
		{
			case 0:	$dbName = "`bnbdbTest`.";
				break;
			case 1:	$dbName = "`bnbdb`.";
				break;
		}

		// get a list of all the users(IDs) and their no of transactions who have made a purchase

		// traverse through the userIDs and update their badges data

		// store all data in array and then update or insert depending upon the requirement

		$badgeData = array
					(
						1 => array('badge_type' => 6, 'badge_level' => 1, 'notification_text' => 'The Newbie Shopper - 0 Star', 'bbucks' => 1500),
						2 => array('badge_type' => 6, 'badge_level' => 2, 'notification_text' => 'The Newbie Shopper - 1 Star', 'bbucks' => 2500),
						3 => array('badge_type' => 6, 'badge_level' => 3, 'notification_text' => 'The Newbie Shopper - 2 Star', 'bbucks' => 3500),
						4 => array('badge_type' => 6, 'badge_level' => 4, 'notification_text' => 'The Newbie Shopper - 3 Star', 'bbucks' => 4000),
						5 => array('badge_type' => 6, 'badge_level' => 5, 'notification_text' => 'The Serious Shopper - 0 Star', 'bbucks' => 8000),
						6 => array('badge_type' => 6, 'badge_level' => 6, 'notification_text' => 'The Serious Shopper - 1 Star', 'bbucks' => 10000),
						7 => array('badge_type' => 6, 'badge_level' => 7, 'notification_text' => 'The Serious Shopper - 2 Star', 'bbucks' => 12000),
						12 => array('badge_type' => 6, 'badge_level' => 8, 'notification_text' => 'The Serious Shopper - 3 Star', 'bbucks' => 15000),
						15 => array('badge_type' => 6, 'badge_level' => 9, 'notification_text' => 'The Veteran Shopper - 0 Star', 'bbucks' => 20000),
						20 => array('badge_type' => 6, 'badge_level' => 10, 'notification_text' => 'The Veteran Shopper - 1 Star', 'bbucks' => 25000),
						25 => array('badge_type' => 6, 'badge_level' => 11, 'notification_text' => 'The Veteran Shopper - 2 Star', 'bbucks' => 35000),
						30 => array('badge_type' => 6, 'badge_level' => 12, 'notification_text' => 'The Veteran Shopper - 3 Star', 'bbucks' => 45000),
						45 => array('badge_type' => 6, 'badge_level' => 13, 'notification_text' => 'The Shopaholic - 0 Star', 'bbucks' => 55000),
						50 => array('badge_type' => 6, 'badge_level' => 14, 'notification_text' => 'The Shopaholic - 1 Star', 'bbucks' => 75000),
						65 => array('badge_type' => 6, 'badge_level' => 15, 'notification_text' => 'The Shopaholic - 2 Star', 'bbucks' => 100000),
						100 => array('badge_type' => 6, 'badge_level' => 16, 'notification_text' => 'The Shopaholic - 3 Star', 'bbucks' => 125000),
					);

		$q1 = array(); // an array to hold all the queries that need to be executed

		$q2 = $this->db->query("SELECT COUNT(DISTINCT(`txnid`)) AS `txns`, `user_id` AS `userID` FROM ".$dbName."`orders` WHERE `orders`.`status_order` = 4 GROUP BY `user_id`");
		$q2Rows = $q2->num_rows();
		echo "\r\nFound ".$q2Rows." users and their transactions";
		switch($q2Rows > 0)
		{
			case TRUE:	$q2 = $q2->result();
						$usersWhoPurchased = array();
						$userTxns = array();
						foreach ($q2 as $key => $value){ $usersWhoPurchased[] = $value->userID; $userTxns[$value->userID] = $value->txns; } // store all the userIDs and their transactions

						$q3 = $this->db->query("SELECT `user_id` AS `userID`, `badge_level` FROM ".$dbName."`badges` WHERE `badge_type` = 6 AND `user_id` IN (".implode(",", $usersWhoPurchased).")");
						$q3Rows = $q3->num_rows();
						echo "\r\nFound ".$q3Rows." users and their badges data";
						switch ($q3Rows > 0)
						{
							case TRUE:	$r3 = $q3->result();
										foreach($r3 as $key => $value)
										{
											// read the current badge level of the user; BL1
											$bL1 = $value->badge_level;
											// compute the new badge level of the user; BL2
											if( isset( $userTxns[$value->userID] ) ) // if the number of transaction for the current user was read from the DB earlier
											{
												$bL2 = $userTxns[ $value->userID ];

												if($bL2 != $bL1 ) // if the badge levels are not same
												{
													if( isset( $badgeData[$bL2] ) ) // if there exists some badge data for the current number of transactions
													{
														// write a query to deduct the bbucks from the user_details table, Q1
														$q1[] = "UPDATE ".$dbName."`user_details` SET `bbucks` = `bbucks` - ".$badgeData[$bL2]['bbucks']." WHERE `user_id` = ".$value->userID;

														// write another query to change the badge level and other badge related data, Q2
														$q1[] = "UPDATE ".$dbName."`badges` SET `badge_level` = ".$bL2.", `notification_text` = ".$this->db->escape( $badgeData[$bL2]['notification_text'] ).", `notify_status` = 0 WHERE `badge_type` = 6 AND `user_id` = ".$value->userID;
														// store Q1 and Q2 in $q1[].
													}
												}
											}
											else
											{
												echo "Unable to find transaction data for user with ID ".$value->userID." while trying to compute new badge level. Skipping them.";
											}
										}
								break;
							case FALSE:	echo "Unable to find badge data";
								break;
						}
				break;
			case FALSE:	echo "Unable to find any transactions";
				break;
		}

		$q = array();

		$q1Count = count($q1);

		echo "\r\n\r\n Going to run ".$q1Count." UPDATE queries probably for ".$q1Count." / 2 = ".( $q1Count / 2 )." users.\r\n Total users read = ".$q2Rows;

		switch( $q1Count > 0 )
		{
			case TRUE:	$this->db->trans_start();
						foreach( $q1 as $key => $value )
						{
							$this->db->query( $value );
							$q[ $key ] = $this->db->affected_rows();
						}
						$this->db->trans_complete();
				break;
		}

		echo "\r\n\r\n Total affected_rows = ".array_sum($q)."\r\nExiting, Bye Bye!\r\n\r\n";
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

	public function userBucks($pageNumber = 0, $maxResults = 500)
	{
		$totalUsers = 0;
		switch($pageNumber === 0)
		{
			case TRUE:	$countSQL = "SELECT COUNT(user_id) AS totalUsers FROM user_details";
						$c1 = $this->db->query($countSQL);
						$t = $c1->result();
						$totalUsers = $t[0]->totalUsers;
						$this->session->set_userdata(md5("totalUsers"), $totalUsers);
				break;
			case FALSE:	$totalUsers = $this->session->userdata(md5("totalUsers"));
				break;
		}

		$totalPages = ceil($totalUsers / $maxResults);
		
		$q1SQL = "SELECT full_name, bbucks, fb_uid, user_id FROM user_details ORDER BY bbucks DESC LIMIT ".$maxResults." OFFSET ".($pageNumber*$maxResults);
		$q1 = $this->db->query($q1SQL);
		echo<<<HD1
		<html><head><title>User bucks list</title><style type="text/css">table{border-collapse:collapse;}table td{padding:6px;}</style></head><body><table border="1"><tr><th>Name</th><th>Brag Bucks</th><th colspan="2">BuynBrag / Facebook</th><th>userID</th></tr>
HD1;
		switch($q1->num_rows() > 0)
		{
			case TRUE:	$res = $q1->result();
						foreach($res as $resItem)
						{
							echo("<tr><td>".$resItem->full_name."</td><td>".$resItem->bbucks."</td><td>".( is_numeric($resItem->fb_uid) ? "<a href=\"https://facebook.com/".$resItem->fb_uid."\">https://facebook.com/".$resItem->fb_uid."</a>": "<a href=\"".$this->baseURL."profile/social/".$resItem->user_id."\">".$this->baseURL."profile/social/".$resItem->user_id."</a>")."</td><td>".( is_numeric($resItem->fb_uid) ? "<img src=\"https://graph.facebook.com/".$resItem->fb_uid."/picture?width=40&amp;height=40\">": "Direct<br/>Member")."</td><td>".$resItem->user_id."</td></tr>");
						}
						echo("<tr><td colspan=\"5\">");
						for($i = 1; $i <= $totalPages; $i++)
						{
							if($i !== $pageNumber)
							{
								echo "<a href=\"".$this->baseURL."index.php/test/userBucks/".$i."\">".$i."</a> | ";
							}
							else
							{
								echo "<b><u>".$i."</u></b> | ";
							}
						}
						echo("Xxz-_.</td></tr>");
				break;
			case FALSE:	// display data not found
				break;
		}
		echo("</table></body></html>");
	}

	public function smsTest()
	{
		/*
		$this->load->model('smsc');
		$this->smsc->sendSMS();
		*/
	}

	public function shell2()
	{
		$output = `sh pull.sh`;
		echo "<p>Output = </p><hr/><pre>".print_r($output, TRUE)."</pre>";
	}

	public function shell()
	{
		exec('git branch', $output, $retVal);
		echo "<p> \$output = </p>\r\n<pre>".print_r($output, TRUE)."</pre>";

		$currentBranch = NULL;
		foreach ($output as $branch)
		{
			$starPos = strpos($branch, '*');
			if( $starPos === 0 )
			{
				$currentBranch = str_replace('*', '', $branch);
				break;
			}
		}

		echo "<p> Current Branch = ".$currentBranch."</p>";

		exec('git pull origin backEnd', $output, $retVal);
		echo "<p> \$output = </p>\r\n<pre>".print_r($output, TRUE)."</pre>";

		echo "end!!!!!!!!!!!___________";
	}
	public function uaTest()
	{
		$this->load->library('user_agent');
		echo "<p> ci Referrer = ".json_encode($this->agent->referrer())."</p>";
		echo "<p> HTTP_REFERER = ".json_encode($this->input->server('HTTP_REFERER'))."</p>";
		echo "<p> ci is_referral = ".json_encode($this->agent->is_referral())." </p>";
		if ($this->agent->is_referral())
		{
		    echo $this->agent->referrer();
		}
		$link = ((strpos($this->input->server('SERVER_NAME'), "buynbrag.com") === FALSE) ? "http://dev.buynbrag.com/test/uaTest": "http://buyandbrag.in/test/uaTest");
		echo "\r\n\r\n\r\n<a href=\"".$link."\">Test Link</a>";
	}

	public function newFancyDataGen()
	{
		/*
		Algo in use:-
		find the total no of products in the db

		read a product

		select its most recent fancied user
		select their badge type, badge level and their badge notification text
		select last fancied time

		display the data
		*//*
		$this->slog->write( array('level' => 1, 'msg' => 'initiating test/newFancyDataGen') );

		$this->db->select('COUNT(product_id) AS totalProducts');
		$this->db->from('products');
		$cQuery = $this->db->get();

		$totalProducts = $cQuery->result();
		$totalProducts = $totalProducts[0]->totalProducts;
		$this->slog->write( array('level' => 1, 'msg' => 'totalProducts = '.$totalProducts) );

		$offset = 0;
		$dbLimit = 1000;
		$numProducts = 0;
		$totalChanged = 0;

		for($i = 0; $i <= $totalProducts; $i = $i + $numProducts)
		{
			$this->slog->write( array('level' => 1, 'msg' => 'Loop i = '.$i) );
			$this->db->select('p1.product_id');
			$this->db->select('(SELECT f1.user_id FROM fancy_products f1 WHERE f1.product_id = p1.product_id ORDER BY time DESC LIMIT 1) AS lastFanciedBy', FALSE);
			$this->db->select('(SELECT UNIX_TIMESTAMP(f1.time) FROM fancy_products f1 WHERE f1.product_id = p1.product_id ORDER BY time DESC LIMIT 1) AS lastFanciedAt', FALSE);

			$this->db->from('products p1');
			$this->db->limit($dbLimit, $offset);

			$query = $this->db->get();
			$numProducts = $query->num_rows();
			if($numProducts <= 0)
			{
				break; // break out of loop
			}
			$this->slog->write( array('level' => 1, 'msg' => 'NumProducts = '.$numProducts) );

			switch($query->num_rows() > 0)
			{
				case TRUE:	$products = $query->result();
							foreach($products as $product)
							{
								$this->db->select('badge_level AS lFUBadgeLevel');
								$this->db->select('notification_text AS lFUBadgeNotificationText');
								$this->db->from('badges');
								$this->db->where('badge_type', 4);
								$this->db->where('user_id', $product->lastFanciedBy);
								$query2 = $this->db->get();
								switch($query2->num_rows() > 0)
								{
									case TRUE:	$badge = $query2->result();
												$this->db->set('lastFanciedBy', $product->lastFanciedBy);
												$this->db->set('lastFanciedAt', $product->lastFanciedAt);
												$this->db->set('lFUBadgeType', 4);
												$this->db->set('lFUBadgeLevel', $badge[0]->lFUBadgeLevel);
												$this->db->set('lFUBadgeNotificationText', $badge[0]->lFUBadgeNotificationText);
												$this->db->where('product_id', $product->product_id);
												$iQuery = $this->db->update('products');
												if($product->product_id > 4499)
												{
													$this->db->set('lastFanciedBy', $product->lastFanciedBy);
													$this->db->set('lastFanciedAt', $product->lastFanciedAt);
													$this->db->set('lFUBadgeType', 4);
													$this->db->set('lFUBadgeLevel', $badge[0]->lFUBadgeLevel);
													$this->db->set('lFUBadgeNotificationText', $badge[0]->lFUBadgeNotificationText);
													$this->db->where('product_id', $product->product_id);
													$iQuery2 = $this->db->update('productsNew');
												}
												$totalChanged++;
										break;
								}
							}
					break;
			}
			$offset += $dbLimit;
		}
		$this->slog->write( array('level' => 1, 'msg' => 'totalChanged = '.$totalChanged) );
		print 'totalChanged = '.$totalChanged;
		*/
	}

	public function newFancyDataGenCli()
	{
		/*
		Algo in use:-
		find the total no of products in the db

		read a product

		select its most recent fancied user
		select their badge type, badge level and their badge notification text
		select last fancied time

		display the data
		*//*
		log_message( 'INFO', 'initiating test/newFancyDataGen' );

		$this->db->select('COUNT(product_id) AS totalProducts');
		$this->db->from('products');
		$cQuery = $this->db->get();

		$totalProducts = $cQuery->result();
		$totalProducts = $totalProducts[0]->totalProducts;
		log_message( 'INFO', 'totalProducts = '.$totalProducts );

		$offset = 0;
		$dbLimit = 1000;
		$numProducts = 0;
		$totalChanged = 0;

		for($i = 0; $i <= $totalProducts; $i = $i + $numProducts)
		{
			$this->slog->write( array('level' => 1, 'msg' => 'Loop i = '.$i) );
			$this->db->select('p1.product_id');
			$this->db->select('(SELECT f1.user_id FROM fancy_products f1 WHERE f1.product_id = p1.product_id ORDER BY time DESC LIMIT 1) AS lastFanciedBy', FALSE);
			$this->db->select('(SELECT UNIX_TIMESTAMP(f1.time) FROM fancy_products f1 WHERE f1.product_id = p1.product_id ORDER BY time DESC LIMIT 1) AS lastFanciedAt', FALSE);

			$this->db->from('products p1');
			$this->db->limit($dbLimit, $offset);

			$query = $this->db->get();
			log_message('INFO', "____________________________________________________________________________________________________________");
			log_message('INFO', 'Now reading products');
			log_message('INFO', "JUST RAN THE FOLLOWING QUERY___________________________\r\n".$this->db->last_query());
			log_message('INFO', "____________________________________________________________________________________________________________");

			echo("____________________________________________________________________________________________________________");
			echo('Now reading products');
			echo("JUST RAN THE FOLLOWING QUERY___________________________\r\n".$this->db->last_query());
			echo("____________________________________________________________________________________________________________");

			$numProducts = $query->num_rows();
			if($numProducts <= 0)
			{
				break; // break out of loop
			}
			log_message( 'INFO', 'NumProducts = '.$numProducts );

			switch($query->num_rows() > 0)
			{
				case TRUE:	$products = $query->result();
							foreach($products as $product)
							{
								$this->db->select('badge_level AS lFUBadgeLevel');
								$this->db->select('notification_text AS lFUBadgeNotificationText');
								$this->db->from('badges');
								$this->db->where('badge_type', 4);
								$this->db->where('user_id', $product->lastFanciedBy);
								$query2 = $this->db->get();
								switch($query2->num_rows() > 0)
								{
									case TRUE:	$badge = $query2->result();
												$this->db->set('lastFanciedBy', $product->lastFanciedBy);
												$this->db->set('lastFanciedAt', $product->lastFanciedAt);
												$this->db->set('lFUBadgeType', 4);
												$this->db->set('lFUBadgeLevel', $badge[0]->lFUBadgeLevel);
												$this->db->set('lFUBadgeNotificationText', $badge[0]->lFUBadgeNotificationText);
												$this->db->where('product_id', $product->product_id);
												$iQuery = $this->db->update('products');
												log_message('INFO', 'Now updating products for product_id: '.$product->product_id);
												log_message('INFO', "JUST RAN THE FOLLOWING QUERY___________________________\r\n".$this->db->last_query());
												if($product->product_id > 4499)
												{
													$this->db->set('lastFanciedBy', $product->lastFanciedBy);
													$this->db->set('lastFanciedAt', $product->lastFanciedAt);
													$this->db->set('lFUBadgeType', 4);
													$this->db->set('lFUBadgeLevel', $badge[0]->lFUBadgeLevel);
													$this->db->set('lFUBadgeNotificationText', $badge[0]->lFUBadgeNotificationText);
													$this->db->where('product_id', $product->product_id);
													$iQuery2 = $this->db->update('productsNew');
													log_message('INFO', 'Now updating productsNew for product_id: '.$product->product_id);
													log_message('INFO', "JUST RAN THE FOLLOWING QUERY___________________________\r\n".$this->db->last_query());
												}
												$totalChanged++;
										break;
								}
							}
					break;
			}
			$offset += $dbLimit;
		}
		log_message( 'INFO', 'totalChanged = '.$totalChanged );
		print 'totalChanged = '.$totalChanged;
		*/
	}

	public function urlTest()
	{
		echo "<p>Current URL(As Read by PHP): ".current_url()."</p>";
		echo "<p>Base URL(As Read by PHP): ".base_url()."</p>";
	}

	public function deleteActivity($activityID)
	{
		$this->load->model('slog');
		$this->output->set_content_type('application/json');
		$this->output->set_output( json_encode( array( 'result' => $this->slog->deleteActivity($activityID) ) ) );
	}

	public function showQueue()
	{
		$this->load->model( 'automate_model' );
		$connection = $this->automate_model->dbConnection->queue->find()->sort( array( 'jobCreatedAt' => -1 ) );
		echo $connection;
		?>
		<!DOCTYPE html>
		<html>
		    <head>
		    	<link href="/application/views/dist/styles/vendor.css" rel="stylesheet">
	    		<link href="/application/views/dist/styles/0f654b22.main.css" rel="stylesheet">
	    		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
				<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		        <title>QUEUE TABLE</title>
		        <style>
		           table{border-collapse:collapse;} 
	               table,th,td{border:1px solid black;}
	            </style>
	            <script type="text/javascript">
	            <!--
	            function displayJson(obj)
	            {
	            	var x = "";
					if( obj && typeof obj === "object" )
					{
				    	for( var i in obj )
						{
							if( obj.hasOwnProperty(i) )
							{
				            	x += (i + " ==> " + obj[i] )+ "\r\n";
							}
						}
					}
					return x;
				}

	            function showWindow(data)
	            {
	            	var x = window.open('', '_blank', 'toolbar=no,status=yes,location=no,replace=false');
	            	x.document.write( displayJson(data) );
	            }
	            //-->
	            </script>
		    </head>
		    <body>
		        <table class="table table-bordered table-hover">
		        	<tr>
		        	    <th>_id</th>
		        	    <th>jobType</th>
		        	    <th>jobScheduledTime</th>
		        	    <th>jobCreatedBy</th>
		        	    <th>jobCreatedAt</th>
		        	    <th>jobCreatedFromIP</th>
		        	    <th>jobCreatedFromBrowser</th>
		        	    <th>jobStatus</th>
		        	    <th>jobSuccessful</th>
		        	    <th>jobCommand</th>
		        	    <th>jobExecutionStart</th>
		        	    <th>jobExecutionEnd</th>
		        	    <th>Extras</th>
		        	</tr>
		        <?php
		        foreach ($connection as $key) 
		        {
		        	$tDiffArray = array
		        				(
		        					"_id" => $key["_id"],
		        					"jobType" => $key["jobType"],
		        					"jobScheduledTime" => $key["jobScheduledTime"],
		        					"jobCreatedBy" => $key["jobCreatedBy"],
		        					"jobCreatedAt" => $key["jobCreatedAt"],
		        					"jobCreatedFromIP" => $key["jobCreatedFromIP"],
		        					"jobCreatedFromBrowser" => $key["jobCreatedFromBrowser"],
		        					"jobStatus" => $key["jobStatus"],
		        					"jobSuccessful" => $key["jobSuccessful"],
		        					"jobCommand" => $key["jobCommand"],
		        					"jobExecutionStart" => $key["jobExecutionStart"],
		        					"jobExecutionEnd" => $key["jobExecutionEnd"]
		        				);
		        	$tExtras = array_diff_assoc($key, $tDiffArray);
		        	echo "<tr><td>".$key["_id"]."</td>\r\n<td>";
		        	echo $key["jobType"]."</td>\r\n<td>";
		        	echo date('l, F jS, Y g:i:s A T (P)', $key["jobScheduledTime"])."</td>\r\n<td>";
		        	echo $key["jobCreatedBy"]."</td>\r\n<td>";
		        	echo date('l, F jS, Y g:i:s A T (P)', $key["jobCreatedAt"])."</td>\r\n<td>";
		        	echo long2ip($key["jobCreatedFromIP"])."</td>\r\n<td>";
		        	echo $key["jobCreatedFromBrowser"]."</td>\r\n<td>";
		        	echo $key["jobStatus"]."</td>\r\n<td>";
		        	echo $key["jobSuccessful"]."</td>\r\n<td>";
		        	echo $key["jobCommand"]."</td>\r\n<td>";
		        	echo date('l, F jS, Y g:i:s A T (P)', $key['jobExecutionStart'])."</td>\r\n<td>";
		        	echo date('l, F jS, Y g:i:s A T (P)', $key["jobExecutionEnd"])."</td>\r\n<td>";
		        	echo "<a href=\"#\" onClick='showWindow(".json_encode($tExtras, JSON_FORCE_OBJECT|JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_NUMERIC_CHECK).")'>See Extra Data</a>";
		        	/*
		        	?>
		        	<a href="#" onClick="showWindow(\"<pre>\"+<?php
		        	$x = "";
		        	foreach($tExtras as $aKey => $value)
		        	{
		        		$x .= "\r\n[".$aKey."] => ".$value;
		        	}
		        	echo "\"".addslashes($x)."\"";
		        	?>
		        	+\"\\r\\n</pre>\")">See Extra Data</a>
		        	<?php
		        	*/
		        	echo "</td></tr>";
		        }
		        
		        ?>
		        </table>  
		    </body>
		</html>
		<?php
	}

	public function showCommonLog()
	{
	    $this->load->model('slog');
	    $cursor = $this->slog->readCISessions();
	    ?>
	    <!DOCTYPE html>
	    <html lang="en" xmlns="http://www.w3.org/1999/html" xmlns:ng="http://angularjs.org" ng-app="bnbApp">
	    	<head>
	    		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    		<meta charset="utf-8">
	    		<meta name="robots" content="index, follow">
	    		<title>BuynBrag | Your single destination for contemporary, quirky lifestyle.</title>
	    		<meta name="description" content="BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">
	    		<meta name="keywords" content="buy, and, brag, buyandbrag, buynbrag, buy and brag,  social, shopping, outfits, trends, fashion, style, advice, tips, fashion">
	    		<meta name="author" content="Shammi Shailaj" >
	    		<meta property="og:site_name" content="BuynBrag.com">
	    		<meta property="og:type" content="website">
	    		<meta property="og:title" content="BuynBrag | Your destination for discovery and indulgence and all things luxury you will love.">
	    		<meta property="og:description" content="BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">
	    		<meta property="og:image" content="http://buynbrag.com/application/views/dist/images/bnb_logo_200.png">
	    		<meta property="og:image:type" content="image/png">
	    		<meta property="og:image:width" content="512">
	    		<meta property="og:image:height" content="200">
	    		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	    		<link href="/application/views/dist/styles/vendor.css" rel="stylesheet">
	    		<link href="/application/views/dist/styles/0f654b22.main.css" rel="stylesheet">
	    		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
				<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
				<script type="text/javascript">
	            <!--
	            function displayJson(obj)
	            {
	            	var x = "";
					if( obj && typeof obj === "object" )
					{
				    	for( var i in obj )
						{
							if( obj.hasOwnProperty(i) )
							{
				            	x += (i + " ==> " + obj[i] )+ "\r\n";
							}
						}
					}
					return x;
				}

	            function showWindow(data)
	            {
	            	var x = window.open('', '_blank', 'toolbar=no,status=yes,location=no,replace=false');
	            	x.document.write( displayJson(data) );
	            }
	            //-->
	            </script>
	    	</head>
	    	<body>
		        <table class="table table-hover table-bordered">
		        	<tr>
		        		<th>_id</th>
		        		<th>_SLOG_timestamp</th>
		        		<th>_CI_session_id</th>
		        		<th>_CI_last_activity</th>
		        		<th>_CI_user_data</th>
		        		<th>_CI_DBID</th>
		        		<th>_BNB_logged_in</th>
		        		<th>_BNB_id</th>
		        		<th>_CI_ip_address</th>
		        		<th>_CI_user_agent</th>
		        		<th>Extras</th>
		        	</tr>
		        	<?php
			        foreach($cursor as $tDocument)
			        {
			        	$tDiffArray = array
			        				(
			        					"_id" => $tDocument['_id'],
			        					"_SLOG_timestamp" => $tDocument["_SLOG_timestamp"],
			        					"_CI_session_id" => $tDocument["_CI_session_id"],
			        					"_CI_last_activity" => $tDocument["_CI_last_activity"],
			        					"_CI_user_data" => $tDocument['_CI_user_data'],
			        					"_CI_DBID" => $tDocument['_CI_DBID'],
			        					"_BNB_logged_in" => $tDocument['_BNB_logged_in'],
			        					"_BNB_id" => $tDocument["_BNB_id"],
			        					"_CI_ip_address" => $tDocument["_CI_ip_address"],
			        					"_CI_user_agent" => $tDocument['_CI_user_agent']
			        				);
			        	echo "<tr><td>".$tDocument["_id"]."</td>\r\n";
			        	echo "<td>".date('l, F jS, Y g:i:s A T (P)', $tDocument["_SLOG_timestamp"])."</td>\r\n";
			        	echo "<td>".$tDocument["_CI_session_id"]."</td>\r\n";
			        	echo "<td>".date('l, F jS, Y g:i:s A T (P)', $tDocument["_CI_last_activity"])."</td>\r\n";
			        	echo "<td>".$tDocument["_CI_user_data"]."</td>\r\n";
			        	echo "<td>".$tDocument["_CI_DBID"]."</td>\r\n";
			        	echo "<td>".$tDocument["_BNB_logged_in"]."</td>\r\n";
			        	echo "<td>".$tDocument["_BNB_id"]."</td>\r\n";
			        	echo "<td>".long2ip( $tDocument["_CI_ip_address"] )."</td>\r\n";
			        	echo "<td>".$tDocument["_CI_user_agent"]."</td>";
			        	
			        	$tExtras = array_diff_assoc($tDocument, $tDiffArray);
			        	echo "<td><a href=\"#\" onClick='showWindow(".json_encode($tExtras, JSON_FORCE_OBJECT|JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_NUMERIC_CHECK).")'>See Extra Data</a></td>";
			        	/*echo "<td><table class=\"table table-hover table-bordered\">\r\n";
			        	foreach($tExtras as $tKey => $tValue)
			        	{
			        		echo "<tr><th>".$tKey."</th><td>".$tValue."</td></tr>\r\n";
			        	}
			        	echo "</table></td>\r\n"; */
			        	echo "</tr>\r\n";
			        }
			        ?>
				</table>
			</body>
		</html>
		<?php
	}

	public function showClog()
	{
	    $this->load->model('slog');
	    $cursor = $this->slog->readClog();
	    ?>
	    <!DOCTYPE html>
	    <html lang="en" xmlns="http://www.w3.org/1999/html" xmlns:ng="http://angularjs.org" ng-app="bnbApp">
	    	<head>
	    		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    		<meta charset="utf-8">
	    		<meta name="robots" content="index, follow">
	    		<title>BuynBrag | Your single destination for contemporary, quirky lifestyle.</title>
	    		<meta name="description" content="BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">
	    		<meta name="keywords" content="buy, and, brag, buyandbrag, buynbrag, buy and brag,  social, shopping, outfits, trends, fashion, style, advice, tips, fashion">
	    		<meta name="author" content="Shammi Shailaj" >
	    		<meta property="og:site_name" content="BuynBrag.com">
	    		<meta property="og:type" content="website">
	    		<meta property="og:title" content="BuynBrag | Your destination for discovery and indulgence and all things luxury you will love.">
	    		<meta property="og:description" content="BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">
	    		<meta property="og:image" content="http://buynbrag.com/application/views/dist/images/bnb_logo_200.png">
	    		<meta property="og:image:type" content="image/png">
	    		<meta property="og:image:width" content="512">
	    		<meta property="og:image:height" content="200">
	    		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	    		<link href="/application/views/dist/styles/vendor.css" rel="stylesheet">
	    		<link href="/application/views/dist/styles/0f654b22.main.css" rel="stylesheet">
	    		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
				<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
				<script type="text/javascript">
	            <!--
	            function displayJson(obj)
	            {
	            	var x = "";
					if( obj && typeof obj === "object" )
					{
				    	for( var i in obj )
						{
							if( obj.hasOwnProperty(i) )
							{
				            	x += (i + " ==> " + obj[i] )+ "\r\n";
							}
						}
					}
					return x;
				}

	            function showWindow(data)
	            {
	            	var x = window.open('', '_blank', 'toolbar=no,status=yes,location=no,replace=false');
	            	x.document.write( displayJson(data) );
	            }

	            function showHide(id)
	            {
	            	document.getElementById(id).className = (document.getElementById(id).className == 'table table-hover table-bordered')? 'table table-hover table-bordered hide': 'table table-hover table-bordered';
	            }
	            //-->
	            </script>
	    	</head>
	    	<body>
		        <table class="table table-hover table-bordered">
		        	<tr>
		        		<th>_id</th>
		        		<th>Default Data</th>
		        		<th>Msg</th>
		        		<th>Extras</th>
		        	</tr>
		        	<?php
			        foreach($cursor as $tDocument)
			        {
			        	$tDiffArray = array
			        				(
			        					"_id" => $tDocument['_id'],
			        					"_SLOG_timestamp" => $tDocument["_SLOG_timestamp"],
			        					"_CI_session_id" => $tDocument["_CI_session_id"],
			        					"_CI_last_activity" => $tDocument["_CI_last_activity"],
			        					"_CI_user_data" => $tDocument['_CI_user_data'],
			        					"_CI_DBID" => $tDocument['_CI_DBID'],
			        					"_BNB_logged_in" => $tDocument['_BNB_logged_in'],
			        					"_BNB_id" => $tDocument["_BNB_id"],
			        					"_CI_ip_address" => $tDocument["_CI_ip_address"],
			        					"_CI_user_agent" => $tDocument['_CI_user_agent'],
			        					"level" => $tDocument['level'],
			        					"msg" => $tDocument['msg']
			        				);
			        	echo "<tr><td>".$tDocument["_id"]."</td>\r\n";
			        	echo "<td><p><button class=\"btn btn-red\" onClick=\"showHide('".$tDocument["_id"]."')\"> Show / Hide </button></p><table class=\"table table-hover table-bordered hide\" id=\"".$tDocument["_id"]."\"><tr><th>_SLOG_timestamp</th><td>".date('l, F jS, Y g:i:s A T (P)', $tDocument["_SLOG_timestamp"])."</td></tr>\r\n";
			        	echo "<tr><th>_CI_session_id</th><td>".$tDocument["_CI_session_id"]."</td></tr>\r\n";
			        	echo "<tr><th>_CI_last_activity</th><td>".date('l, F jS, Y g:i:s A T (P)', $tDocument["_CI_last_activity"])."</td></tr>\r\n";
			        	echo "<tr><th>_CI_user_data</th><td>".$tDocument["_CI_user_data"]."</td></tr>\r\n";
			        	echo "<tr><th>_CI_DBID</th><td>".$tDocument["_CI_DBID"]."</td></tr>\r\n";
			        	echo "<tr><th>_BNB_logged_in</th><td>".$tDocument["_BNB_logged_in"]."</td></tr>\r\n";
			        	echo "<tr><th>_BNB_id</th><td>".$tDocument["_BNB_id"]."</td></tr>\r\n";
			        	echo "<tr><th>_CI_ip_address</th><td>".long2ip( $tDocument["_CI_ip_address"] )."</td></tr>\r\n";
			        	echo "<tr><th>_CI_user_agent</th><td>".$tDocument["_CI_user_agent"]."</td></tr>\r\n";
			        	echo "<tr><th>Level</th><td>".$tDocument["level"]."</td></tr></table>\r\n";
			        	echo "<td>".$tDocument["msg"]."</td>\r\n";
			        	
			        	$tExtras = array_diff_assoc($tDocument, $tDiffArray);
			        	echo "<td><a href=\"#\" onClick='showWindow(".json_encode($tExtras, JSON_FORCE_OBJECT|JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_NUMERIC_CHECK).")'>See Extra Data</a></td>";
			        	/*echo "<td><table class=\"table table-hover table-bordered\">\r\n";
			        	foreach($tExtras as $tKey => $tValue)
			        	{
			        		echo "<tr><th>".$tKey."</th><td>".$tValue."</td></tr>\r\n";
			        	}
			        	echo "</table></td>\r\n"; */
			        	echo "</tr>\r\n";
			        }
			        ?>
				</table>
			</body>
		</html>
		<?php
	}
	 
	public function showLog()
	{
	    $this->load->model('slog');
	    $cursor = $this->slog->readLog();
	    ?>
	    <!DOCTYPE html>
	    <html lang="en" xmlns="http://www.w3.org/1999/html" xmlns:ng="http://angularjs.org" ng-app="bnbApp">
	    	<head>
	    		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    		<meta charset="utf-8">
	    		<meta name="robots" content="index, follow">
	    		<title>BuynBrag | Your single destination for contemporary, quirky lifestyle.</title>
	    		<meta name="description" content="BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">
	    		<meta name="keywords" content="buy, and, brag, buyandbrag, buynbrag, buy and brag,  social, shopping, outfits, trends, fashion, style, advice, tips, fashion">
	    		<meta name="author" content="Shammi Shailaj" >
	    		<meta property="og:site_name" content="BuynBrag.com">
	    		<meta property="og:type" content="website">
	    		<meta property="og:title" content="BuynBrag | Your destination for discovery and indulgence and all things luxury you will love.">
	    		<meta property="og:description" content="BuynBrag is your destination for discovery. From new products by brands you already love, to beautiful products by brands that we know you'll love.">
	    		<meta property="og:image" content="http://buynbrag.com/application/views/dist/images/bnb_logo_200.png">
	    		<meta property="og:image:type" content="image/png">
	    		<meta property="og:image:width" content="512">
	    		<meta property="og:image:height" content="200">
	    		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	    		<link href="/application/views/dist/styles/vendor.css" rel="stylesheet">
	    		<link href="/application/views/dist/styles/0f654b22.main.css" rel="stylesheet">
	    		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
				<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	    	</head>
	    	<body>
		        <table class="table table-hover table-bordered">
		        	<tr>
		        		<th>_id</th>
		        		<th>Collection</th>
		        		<th>Last Activity</th>
		        		<th>Operations</th>
		        	</tr>
		        	<?php
			        foreach($cursor as $tDocument)
			        {
			        	echo "<tr><td>".$tDocument["_id"]."</td>\r\n<td>".$tDocument["collectionName"]."</td>\r\n<td>".date('l, F jS, Y g:i:s A T (P)',$tDocument["lastWrite"])."</td>\r\n<td>";
			        	echo "\r\n<a onClick=\"deleteActivity(".$tDocument["_id"].")\">Delete</a></td></tr>";
			        }
			        ?>
				</table>
			</body>
			<script type="text/javascript">
				function deleteActivity(activityID)
				{
					alert('will get from '+'<?php echo base_url(); ?>test/deleteActivity/'+activityID);
					jQuery.ajax({
						type: 'GET',
						url: '<?php echo base_url(); ?>test/deleteActivity/'+activityID,
						success: function(data)
						{
							alert('Done. Result = '+data);
						}
					});
				}
			</script>
		</html>
		<?php
	}

	public function testCISession()
	{
		echo "<p>Current session data  is</p><pre>", print_r($this->session->all_userdata(), TRUE), "</pre>";
	}

	public function testSlog()
	{
		$this->load->model('slog');
		$this->slog->write("Just trying out some test");
		print "<p>just wrote a slog</p>";
	}

	public function createJob()
	{
		$this->load->model('automate_model');
		$jobType = 1; // an email job
		$jobCommand = "php5 ".__DIR__."/../../index.php automate email";
		$jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013
		/* $jobScheduledTime = time() + 60; // currnet time + 1 minute */
		$jobDetails = array
						(
							'to' => 'shammishailaj@gmail.com',
							'cc' => 'prt@buynbrag.com,allemployees@buynbrag.com',
							'bcc' => 'sam@buynbrag.com,manish@buynbrag.com,bimal@buynbrag.com',
							'subject' => "Second Automation Mail from BuynBrag",
							'msg' => 'Hi. This is the first automated email message test. If you are getting this email, you are one of the priviledged members of Social Scientist E-Commerce Pvt. Ltd.'
						);
		$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
		echo "<p> Job Created and will be executed on ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A e', $jobScheduledTime)." </p>";
	}

	public function testMongo()
	{
		echo "<p> This test has been finished </p>";
		/*
		$this->load->model('sammongo');
		$mongoServer = 'ec2-175-41-180-143.ap-southeast-1.compute.amazonaws.com';
		$mongoUser = 'bnbdev';
		$mongoUserPassword = 'bnz483rgiuweh';
		$mongoAutomationUser = "automator";
		$mongoAutomationUserPassword = "bs27t3ekjwed";
		$mongoDBName = 'automation';
		$mongoCollectionName = 'queue';
		$mongoConn = $this->sammongo->connect($mongoServer, $mongoAutomationUser, $mongoAutomationUserPassword, $mongoDBName);
		$mongoDB = $this->sammongo->selectDB($mongoDBName, $mongoConn);
		$mongoCollection = $this->sammongo->selectCollection($mongoCollectionName, $mongoDB);
		$document = array("jobType" => 1, "jobCreatedAt" => 1380837600, "jobCreatedFromIP" => ip2long("10.0.1.1"), "jobCreatedFromBrowser" => $this->input->user_agent(),
					"jobStatus" => 0, "jobSuccessful" => FALSE, "jobCommand" => "php5 /var/www/dev/index.php test purgeCache", "jobExecutedAt" => NULL);
		$this->sammongo->insert($mongoCollection, $document);
		$cursor = $this->sammongo->getCursor($mongoCollection);

		$i = 0;
		// iterate through the results
		foreach ($cursor as $tdocument)
		{
		    echo "<hr/>".$i."<hr/><pre>", print_r($tdocument, TRUE), "</pre>";
		    $i++;
		}
		*/
	}

	public function getFBFriends()
	{
		$this->load->model('async_model');
		$isLoggedIN = $this->async_model->isLoggedIN();
		$currentUserID = $isLoggedIN['uid'];

		$fbFriends = $this->async_model->getFBFriends();
		echo "<pre>", print_r($fbFriends, TRUE), "</pre><hr/>";
		$friendFBIDs = array();
		foreach ($fbFriends['friendsList'] as $fbObj)
		{
			$friendFBIDs[] = $fbObj['id'];
		}
		$friendFBIDsCount = count($friendFBIDs);
		echo "<p>FBIDs of friends are</p><hr/>";
		echo "<pre>", print_r($friendFBIDs, TRUE), "</pre>";
		$friendFBIDs = implode(",", $friendFBIDs);
		echo "<p>", print_r($friendFBIDs, TRUE), "</p>";

		/* code that will be copied into a model after testing */
		if($friendFBIDsCount > 0)
		{
			$this->db->select('user_id');
			$this->db->from('user_details');
			$this->db->where("fb_uid IN (".$friendFBIDs.") ORDER BY FIELD(".$friendFBIDs.")"); // order by can be removed to improve performance without hampering the results, shammi
			$query = $this->db->get();
			switch($query->num_rows() > 0)
			{
				case TRUE:	$bnbfriends = $query->result();
							echo "<p>corressponding users on buynbrag who are fb friends of the current fb user </p><hr/><pre>", print_r($bnbfriends, TRUE), "</pre>";
							$bnbFriends = array();
							$bnbFriendsArr = NULL;
							foreach($bnbfriends as $bnbIDs)
							{
								$bnbFriends[] = $bnbIDs->user_id;
							}
							$bnbFriendsArr = $bnbFriends;
							$whereTextFollowers = $whereTextFollowing = "";
							if(count($bnbFriends) > 1)
							{
								$bnbFriends = implode(",", $bnbFriends);
								$whereTextFollowers = "follower_id IN (".$bnbFriends.") AND followee_id = ".$currentUserID;
								$whereTextFollowing = "followee_id IN (".$bnbFriends.") AND follower_id = ".$currentUserID;
							}
							else
							{
								$whereTextFollowers = "follower_id = ".$bnbFriends[0]." AND followee_id = ".$currentUserID;
								$whereTextFollowing = "followee_id = ".$bnbFriends[0]." AND follower_id = ".$currentUserID;
							}

							$followerIDs = array();
							$followeeIDs = array();

							$this->db->select('follower_id');
							$this->db->from('follow_friends');
							$this->db->where($whereTextFollowers);
							$followersQuery = $this->db->get();
							
							switch($followersQuery->num_rows() > 0)
							{
								case TRUE:	$followersQR = $followersQuery->result();
											foreach($followersQR as $fIDs)
											{
												$followerIDs[] = $fIDs->follower_id;
											}
									break;
							}

							$this->slog->write( array('level' => 1, 'msg' => 'followers = '.json_encode($followerIDs)) );

							$this->db->select('followee_id');
							$this->db->from('follow_friends');
							$this->db->where($whereTextFollowing);
							$followingQuery = $this->db->get();
							switch($followingQuery->num_rows() > 0)
							{
								case TRUE:	$followingQR = $followingQuery->result();
											foreach($followingQR as $fIDs)
											{
												$followeeIDs[] = $fIDs->followee_id;
											}
									break;
							}

							$this->slog->write( array('level' => 1, 'msg' => 'followers = '.json_encode($followeeIDs)) );

							$newFollowers = array();
							$newFollowing = array();
							$i = 0;
							if(count($followerIDs) > 0)
							{
								/*foreach($followerIDs as $key => $fID)
								{
									log_message('INFO', 'test/getFBFriends now finding followerID '.$fID." in (".json_encode($bnbFriendsArr).")");
									if(array_search($fID, $bnbFriendsArr) === FALSE)
									{
										$newFollowers[] = $fID;
										log_message('INFO', 'test/getFBFriends followerID '.$fID." not found");
									}
									else
									{
										log_message('INFO', 'test/getFBFriends followerID '.$fID." found");
									}
								}*/
								$newFollowers = array_diff($bnbFriendsArr, $followerIDs);
							}

							if(count($followingIDs) > 0)
							{
								/*foreach($followingIDs as $key => $fID)
								{
									log_message('INFO', 'test/getFBFriends now finding followeeID '.$fID." in (".json_encode($bnbFriendsArr).")");
									if(array_search($fID,  $bnbFriendsArr) === FALSE)
									{
										$newFollowing[] = $fID;
										log_message('INFO', 'test/getFBFriends followeeID '.$fID." not found");
									}
									else
									{
										log_message('INFO', 'test/getFBFriends followeeID '.$fID." found");
									}
								}*/
								$newFollowing = array_diff($bnbFriendsArr, $followeeIDs);
							}

							echo "<table border=\"1\"><tr><th>Facebook Friends on Buynbrag</th><th>Already following</th><th>Already being followed by</th></tr><tr><td>", print_r($bnbFriends, TRUE), "</td><td>", print_r($followingIDs, TRUE), "<hr/>New to follow<hr/>", print_r($newFollowing, TRUE), "</td><td>", print_r($followerIDs, TRUE), "<hr/>New followers<hr/>", print_r($newFollowers, TRUE), "</td></tr></table>";

							$this->load->model('rapiv1/profile_model', 'profile_model');
							if(count($newFollowers) > 0)
							{
								foreach($newFollowers as $key => $value)
								{
									$this->profile_model->follow($value, $currentUserID);
								}
							}

							if(count($newFollowing) > 0)
							{
								foreach($newFollowing as $key => $value)
								{
									$this->profile_model->follow($currentUserID, $value);
								}
							}
					break;
				case FALSE:	echo "<p> Looks like the current fb user does not have any of their fb friends on BNB</p>";
					break;
			}
		}
	}

	public function purgeCache()
	{
		$this->load->driver('cache');
		if($this->cache->memcached->clean())
		{
			print "<p>Cache Cleared</p>";
		}
		else
		{
			print "<p>Failed to clear cache</p>";
		}
	}

	public function mcacheView()
	{
		$this->load->driver("cache");
		echo "<pre>";
		var_dump($this->cache->cache_info());
		echo "</pre>";
	}

	public function updateCity()
	{
		exit("Already run on 31-07-2013. Aborting...");
		$this->db->select('orders.shipping_city');
		$this->db->select('orders.order_id');
		$this->db->select('orders.user_id');
		$this->db->select('user_details.city');
		$this->db->from('orders');
		$this->db->join('user_details','orders.user_id = user_details.user_id','left');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $values)
			{
				echo "\r\n\r\nNow handling_________________________________\r\n";
				echo "order_id = ".$values->order_id.", user_id = ".$values->user_id.", user_details.city = ".$values->city.", orders.shipping_city = ".$values->shipping_city."\r\n\r\n";
				if($values->city == NULL || $values->city == '' || $values->city == 'orders.shipping_city')
				{
					$this->db->set('user_details.city', $values->shipping_city);
					$this->db->join('orders','user_details.user_id = orders.user_id');
					$this->db->where('user_details.user_id', $values->user_id);
					$updateResult = $this->db->update('user_details');
					echo "_________________________________\r\nJUST RAN THE QUERY___________________________\r\n".$this->db->last_query()."\r\nSleeping for a while";
					//log_message('INFO', "JUST RAN THE QUERY___________________________\r\n".$this->db->last_query());
					$this->slog->write(array('level' => 1,'msg' => "JUST RAN THE QUERY___________________________\r\n".$this->db->last_query()));
					sleep(1);
					echo '.';
					sleep(1);
					echo '.';
					sleep(1);
					echo ".\r\n\r\n\r\n";
		        }
            }
            echo "\r\n Done with updating cities ";
		}
	}

	public function mcTest()
	{
		error_reporting(0);
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->driver('cache');
		$saveStatus = $this->cache->memcached->save('foo', 'bar', 10);
		echo "<p> The data in \$saveStatus is: ", json_encode($saveStatus, JSON_FORCE_OBJECT), "</p>";
		echo "<p><a href=\"".base_url()."test/mcTestRead\">Click here to test the code to read the data back from cache</a></p>";
	}

	public function mcTestRead()
	{
		error_reporting(0);
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->driver('cache');
		$foo = $this->cache->memcached->get('foo');
		echo "<p> The data in \$foo is: ", json_encode($foo, JSON_FORCE_OBJECT), "</p>";
	}

	public function createRanks()
	{
		exit("Ranks Already created!");
		$this->load->model('async_model');
		$this->db->select('user_id AS userID');
		$this->db->from('user_details');
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: $allUsers = $query->result();
					foreach($allUsers as $user)
					{
						$this->async_model->saveBuynbragRank($user->userID);
					}
				break;
		}
	}
	
	public function fbCouponsAll()
	{
		set_time_limit(0); // set time limit to zero to let the script run till infinity
		$couponDetails = array();
		//log_message('INFO', "NOW STARTING TO GENERATE COUPONS FOR ALL THE USERS SIGNED-UP VIA FACEBOOK BY SHAMMI SHAILAJ");
		$this->slog->write(array('level' => 1,'msg' => "NOW STARTING TO GENERATE COUPONS FOR ALL THE USERS SIGNED-UP VIA FACEBOOK BY SHAMMI SHAILAJ"));
		echo " NOW STARTING TO GENERATE COUPONS FOR ALL THE USERS SIGNED-UP VIA FACEBOOK BY SHAMMI SHAILAJ\r\n";
		echo "---------------------------------------------------------------------------------------------\r\n";
		$this->db->select('user_id');
		$this->db->select('fb_uid');
		$this->db->select('email');
		$this->db->select('full_name');
		$this->db->from('user_details');
		$this->db->where('user_id > 1576');
		$query1 = $this->db->get();
		echo "1. JUST RAN THE FOLLOWING QUERY___________________________\r\n";
		echo "   ".$this->db->last_query()."\r\n";

		switch($query1->num_rows() > 0)
		{
			case TRUE: $users = $query1->result();
						foreach($users as $user)
						{
							if($user->user_id < 9449)
							{
								if($user->fb_uid != "non-fb-member" || $user->fb_uid != 0)
								{
									$data['ip'] = $this->input->ip_address();
									$data['userFullName'] = $user->full_name;
									echo "---------------------------------------------------------------------------------------------\r\n";
									 //log_message('INFO', " NOW CREATING COUPON 1 FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
									 $this->slog->write(array('level' => 1,'msg' => " NOW CREATING COUPON 1 FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
									 echo "1.1 NOW CREATING COUPON 1 FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									 $this->load->model('async_model');
									 $couponDetails['couponid'] = "BNBFB1".$user->user_id;
									 $couponDetails['couponValue'] = 500;
									 $couponDetails['couponsCount'] = 1;
									 $couponDetails['couponType'] = 1;
									 $couponDetails['validFrom'] = time();
									 $couponDetails['validUpto'] = time() + (15 * 3600 * 24);
									 $couponDetails['minPurchaseAmount'] = 3500;
									 $couponDetails['userID'] = $user->user_id;

									 $couponResult = $this->async_model->createCouponPublic($couponDetails);
									 switch($couponResult)
									 {
									 	case TRUE: //log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB1".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
									 	           $this->slog->write(array('level' => 1,'msg' => " SUCCESSFULLY CREATED COUPON BNBFB1".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
									 				echo "1.1.1  SUCCESSFULLY CREATED COUPON BNBFB1".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									 		break;
									 	case FALSE: //log_message('INFO', " FAILURE CREATING COUPON BNBFB1".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
									 	            $this->slog->write(array('level' => 1,'msg' => " FAILURE CREATING COUPON BNBFB1".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
									 				echo "1.1.1 FAILURE CREATING COUPON BNBFB1".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									 		break;
									 }

									 $data['couponCode1'] = "BNBFB1".$user->user_id;
								   	 $data['validFrom1'] = $couponDetails['validFrom'];
								   	 $data['validTill1'] = $couponDetails['validUpto'];
								   	 $data['couponValue1'] = $couponDetails['couponValue'];

									// log_message('INFO', " NOW CREATING COUPON 2 FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
									 $this->slog->write(array('level' => 1,'msg' => " NOW CREATING COUPON 2 FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
									 echo "1.2 NOW CREATING COUPON 2 FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									 $couponDetails['couponid'] = "BNBFB2".$user->user_id;
									 $couponDetails['couponValue'] = 2000;
									 $couponDetails['couponsCount'] = 1;
									 $couponDetails['couponType'] = 1;
									 $couponDetails['validFrom'] = time();
									 $couponDetails['validUpto'] = time() + (15 * 3600 * 24);
									 $couponDetails['minPurchaseAmount'] = 10000;
									 $couponDetails['userID'] = $user->user_id;

									 $couponResult = $this->async_model->createCouponPublic($couponDetails);
									 switch($couponResult)
									 {
									 	case TRUE: //log_message('INFO', " SUCCESSFULLY CREATED COUPON BNBFB2".$user->user_id." FOR THE NEWLY REGISTERED USER WITH ID : ".$user->user_id);
									 	           $this->slog->write(array('level' => 1,'msg' => " SUCCESSFULLY CREATED COUPON BNBFB2".$user->user_id." FOR THE NEWLY REGISTERED USER WITH ID : ".$user->user_id));
									 				echo "1.2.1  SUCCESSFULLY CREATED COUPON BNBFB2".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									 		break;
									 	case FALSE: //log_message('INFO', " FAILURE CREATING COUPON BNBFB2".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
									 	            $this->slog->write(array('level' => 1,'msg' => " FAILURE CREATING COUPON BNBFB2".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
									 				echo "1.2.1 FAILURE CREATING COUPON BNBFB2".$user->user_id." FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									 		break;
									 }

									 $data['couponCode2'] = "BNBFB2".$user->user_id;
								   	 $data['validFrom2'] = $couponDetails['validFrom'];
								   	 $data['validTill2'] = $couponDetails['validUpto'];
								   	 $data['couponValue2'] = $couponDetails['couponValue'];

									 //log_message('INFO', " NOW SENDING coupon MAIl FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
									 $this->slog->write(array('level' => 1,'msg' => " NOW SENDING coupon MAIl FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
									 echo "1.3 NOW SENDING coupon MAIl FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									 $this->load->library('email');
									   $this->email->from('support@buynbrag.com', 'BuynBrag');
									   $this->email->to($user->email);
									   $this->email->subject("BuynBrag ::: A few things I'd like to share along with a small gift for you.");
									   
									   
									   
									   $msg = $this->load->view('emailers/fbSignupLinkCouponMailOldUsers', $data, true);
									   
									   $this->email->message($msg);
									   $this->email->set_newline("\r\n");
									   
									   if($this->email->send())
									   {
										  //log_message('INFO', " Successfully SENt coupon MAIl  FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
										  $this->slog->write(array('level' => 1,'msg' => " Successfully SENt coupon MAIl  FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
										  echo "1.3.1 Successfully SENt coupon MAIl  FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									   }
									   else
									   {
										   //log_message('INFO', " Error sending coupon MAIl  FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id);
										   $this->slog->write(array('level' => 1,'msg' => " Error sending coupon MAIl  FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id));
										   echo "1.3.1 Error sending coupon MAIl  FOR THE ALREADY REGISTERED USER WITH ID : ".$user->user_id."\r\n";
									   }
									   sleep(1); // sleep for 1 second before sending each mail
									   echo "---------------------------------------------------------------------------------------------\r\n";
								}
							}
							else
							{
								// check if the user has got 2 coupons
								// if they have proceed o next user else give them the two coupons
							}
						}
				break;
		}
	}

	public function newBadgeLevels()
	{
		$__ip = $this->input->ip_address();
		//log_message("INFO", $__ip." test/newBadgeLevels: Started! ");
		$this->slog->write(array('level' =>1,'msg' => $__ip." test/newBadgeLevels: Started! "));
		exit('BADGE LEVELS ALREADY SET AND BRAG BUCKS ALREADY GIVEN');
		include_once 'badges_desc.php';
		$queries = array();
		$bbQueries = array();
		$bbQueries[0] = "UPDATE user_details SET bbucks = 0 WHERE user_id > 0";
		//log_message("INFO", $__ip." test/newBadgeLevels: READING ALL BADGES! ");
		$this->slog->write(array('level' =>1,'msg' => $__ip." test/newBadgeLevels: READING ALL BADGES! "));
		$this->db->select('*');
		$this->db->from('badges');
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE://log_message("INFO", $__ip." test/newBadgeLevels: GOT BADGES DATA. GENERATING QUERIES NOW ");
			          $this->slog->write(array('level' => 1,'msg' => $__ip." test/newBadgeLevels: GOT BADGES DATA. GENERATING QUERIES NOW "));
					$badgesData = $query->result();
					$i = 0;
					$j = 1;
					foreach($badgesData as $badgeData)
					{
						$queries[$i] = "UPDATE badges SET ";
						$bbQueries[$j] = "UPDATE user_details SET bbucks = bbucks + ";
						$bBucksSkipped = 0;
						$newLevel = $badgeData->badge_level;
						switch($badgeData->badge_type)
						{
							case 1:if($badgeData->badge_level == 9 || $badgeData->badge_level == 8)
								  {
									$queries[$i] .= "badge_level = 8, notification_text = '".$storeBadges[8]->notificationText."'";
									$newLevel = 8;
								  }
								  elseif($badgeData->badge_level == 10 || $badgeData->badge_level == 11)
								  {
									$queries[$i] .= "badge_level = 9, notification_text = '".$storeBadges[9]->notificationText."'";
									$newLevel = 9;
								  }
								  elseif($badgeData->badge_level == 12)
								  {
									$queries[$i] .= "badge_level = 10, notification_text = '".$storeBadges[10]->notificationText."'";
									$newLevel = 12;
								  }
								  elseif($badgeData->badge_level == 13)
								  {
									$queries[$i] .= "badge_level = 11, notification_text = '".$storeBadges[11]->notificationText."'";
									$newLevel = 13;
								  }
								  elseif($badgeData->badge_level == 14 || $badgeData->badge_level == 15)
								  {
									$queries[$i] .= "badge_level = 12, notification_text = '".$storeBadges[12]->notificationText."'";
									$newLevel = 12;
								  }
								  elseif($badgeData->badge_level == 16)
								  {
									$queries[$i] .= "badge_level = 13, notification_text = '".$storeBadges[13]->notificationText."'";
									$newLevel = 13;
								  }
								  else
								  {
									$queries[$i] .= "badge_level = ".$badgeData->badge_level.", notification_text = '".$storeBadges[$badgeData->badge_level]->notificationText."'";
								  }
								  
								  for($k = $newLevel; $k >= 1; $k--)
								  {
									$bBucksSkipped += $storeBadges[$k]->bbucks;
								  }
								break;
							case 2:if($badgeData->badge_level == 4 || $badgeData->badge_level == 5 || $badgeData->badge_level == 6 || $badgeData->badge_level == 7 || $badgeData->badge_level == 8)
								  {
									$queries[$i] .= "badge_level = 4, notification_text = '".$pollBadges[4]->notificationText."'";
									$newLevel = 4;
								  }
								  elseif($badgeData->badge_level == 9 || $badgeData->badge_level == 10 || $badgeData->badge_level == 11)
								  {
									$queries[$i] .= "badge_level = 5, notification_text = '".$pollBadges[5]->notificationText."'";
									$newLevel = 5;
								  }
								  elseif($badgeData->badge_level == 12)
								  {
									$queries[$i] .= "badge_level = 6, notification_text = '".$pollBadges[6]->notificationText."'";
									$newLevel = 6;
								  }
								  elseif($badgeData->badge_level == 13 || $badgeData->badge_level == 14)
								  {
									$queries[$i] .= "badge_level = 7, notification_text = '".$pollBadges[7]->notificationText."'";
									$newLevel = 7;
								  }
								  elseif($badgeData->badge_level == 15)
								  {
									$queries[$i] .= "badge_level = 8, notification_text = '".$pollBadges[8]->notificationText."'";
									$newLevel = 8;
								  }
								  elseif($badgeData->badge_level == 16)
								  {
									$queries[$i] .= "badge_level = 9, notification_text = '".$pollBadges[9]->notificationText."'";
									$newLevel = 9;
								  }
								  else
								  {
									$queries[$i] .= "badge_level = ".$badgeData->badge_level.", notification_text = '".$pollBadges[$badgeData->badge_level]->notificationText."'";
								  }
								  for($k = $newLevel; $k >= 1; $k--)
								  {
									$bBucksSkipped += $pollBadges[$k]->bbucks;
								  }
								break;
							case 3:$queries[$i] .= "badge_level = ".$badgeData->badge_level.", notification_text = '".$fancyStoreBadges[$badgeData->badge_level]->notificationText."'";
								  for($k = $newLevel; $k >= 1; $k--)
								  {
									$bBucksSkipped += $fancyStoreBadges[$k]->bbucks;
								  }
								break;
							case 4:if($badgeData->badge_level == 1 || $badgeData->badge_level == 2)
								  {
									$queries[$i] .= "badge_level = 1, notification_text = '".$fancyBadges[1]->notificationText."'";
									$newLevel = 1;
								  }
								  elseif($badgeData->badge_level == 3 || $badgeData->badge_level == 4 || $badgeData->badge_level == 5 || $badgeData->badge_level == 6 || $badgeData->badge_level == 7 || $badgeData->badge_level == 8)
								  {
									$queries[$i] .= "badge_level = 2, notification_text = '".$fancyBadges[2]->notificationText."'";
									$newLevel = 2;
								  }
								  elseif($badgeData->badge_level == 9 || $badgeData->badge_level == 10)
								  {
									$queries[$i] .= "badge_level = 3, notification_text = '".$fancyBadges[3]->notificationText."'";
									$newLevel = 3;
								  }
								  elseif($badgeData->badge_level == 11 || $badgeData->badge_level == 12)
								  {
									$queries[$i] .= "badge_level = 4, notification_text = '".$fancyBadges[4]->notificationText."'";
									$newLevel = 4;
								  }
								  elseif($badgeData->badge_level == 13 || $badgeData->badge_level == 14)
								  {
									$queries[$i] .= "badge_level = 5, notification_text = '".$fancyBadges[5]->notificationText."'";
									$newLevel = 5;
								  }
								  elseif($badgeData->badge_level == 15)
								  {
									$queries[$i] .= "badge_level = 6, notification_text = '".$fancyBadges[6]->notificationText."'";
									$newLevel = 6;
								  }
								  elseif($badgeData->badge_level == 16)
								  {
									$queries[$i] .= "badge_level = 7, notification_text = '".$fancyBadges[7]->notificationText."'";
									$newLevel = 7;
								  }
								  else
								  {
									$queries[$i] .= "badge_level = ".$badgeData->badge_level.", notification_text = '".$fancyBadges[$badgeData->badge_level]->notificationText."'";
								  }
								  for($k = $newLevel; $k >= 1; $k--)
								  {
									$bBucksSkipped += $fancyStoreBadges[$k]->bbucks;
								  }
								break;
							case 5:if($badgeData->badge_level == 1 || $badgeData->badge_level == 2 || $badgeData->badge_level == 3 || $badgeData->badge_level == 4)
								  {
									$queries[$i] .= "badge_level = 1, notification_text = '".$bragBadges[1]->notificationText."'";
									$newLevel = 1;
								  }
								  elseif($badgeData->badge_level == 5)
								  {
									$queries[$i] .= "badge_level = 2, notification_text = '".$bragBadges[2]->notificationText."'";
									$newLevel = 2;
								  }
								  elseif($badgeData->badge_level == 6 || $badgeData->badge_level == 7 || $badgeData->badge_level == 8)
								  {
									$queries[$i] .= "badge_level = 3, notification_text = '".$bragBadges[3]->notificationText."'";
									$newLevel = 3;
								  }
								  elseif($badgeData->badge_level == 9 || $badgeData->badge_level == 10)
								  {
									$queries[$i] .= "badge_level = 4, notification_text = '".$bragBadges[4]->notificationText."'";
									$newLevel = 4;
								  }
								  elseif($badgeData->badge_level == 11 || $badgeData->badge_level == 12 || $badgeData->badge_level == 13)
								  {
									$queries[$i] .= "badge_level = 5, notification_text = '".$bragBadges[5]->notificationText."'";
									$newLevel = 5;
								  }
								  elseif($badgeData->badge_level == 14 || $badgeData->badge_level == 15)
								  {
									$queries[$i] .= "badge_level = 6, notification_text = '".$bragBadges[6]->notificationText."'";
									$newLevel = 6;
								  }
								  elseif($badgeData->badge_level == 16)
								  {
									$queries[$i] .= "badge_level = 7, notification_text = '".$bragBadges[7]->notificationText."'";
									$newLevel = 7;
								  }
								  else
								  {
									$queries[$i] .= "badge_level = ".$badgeData->badge_level.", notification_text = '".$bragBadges[$badgeData->badge_level]->notificationText."'";
								  }
								  for($k = $newLevel; $k >= 1; $k--)
								  {
									$bBucksSkipped += $fancyStoreBadges[$k]->bbucks;
								  }
								break;
							case 6:if($badgeData->badge_level == 8 || $badgeData->badge_level == 9 || $badgeData->badge_level == 10 || $badgeData->badge_level == 11)
								  {
									$queries[$i] .= "badge_level = 7, notification_text = '".$buyBadges[7]->notificationText."'";
									$newLevel = 7;
								  }
								  elseif($badgeData->badge_level == 12)
								  {
									$queries[$i] .= "badge_level = 8, notification_text = '".$buyBadges[8]->notificationText."'";
									$newLevel = 8;
								  }
								  elseif($badgeData->badge_level == 13)
								  {
									$queries[$i] .= "badge_level = 9, notification_text = '".$buyBadges[9]->notificationText."'";
									$newLevel = 9;
								  }
								  elseif($badgeData->badge_level == 14)
								  {
									$queries[$i] .= "badge_level = 10, notification_text = '".$buyBadges[10]->notificationText."'";
									$newLevel = 10;
								  }
								  elseif($badgeData->badge_level == 15)
								  {
									$queries[$i] .= "badge_level = 11, notification_text = '".$buyBadges[11]->notificationText."'";
									$newLevel = 11;
								  }
								  elseif($badgeData->badge_level == 16)
								  {
									$queries[$i] .= "badge_level = 12, notification_text = '".$buyBadges[12]->notificationText."'";
									$newLevel = 12;
								  }
								  else
								  {
									$queries[$i] .= "badge_level = ".$badgeData->badge_level.", notification_text = '".$buyBadges[$badgeData->badge_level]->notificationText."'";
								  }
								  for($k = $newLevel; $k >= 1; $k--)
								  {
									$bBucksSkipped += $fancyStoreBadges[$k]->bbucks;
								  }
								break;
						}
						$queries[$i] .= ", notify_status = 0 WHERE badge_level = ".$badgeData->badge_level." AND user_id = ".$badgeData->user_id." AND badge_type = ".$badgeData->badge_type;
						$bbQueries[$j] .= $bBucksSkipped." WHERE user_id = ".$badgeData->user_id;
						$i++;
						$j++;
					}
					//log_message("INFO", $__ip." test/newBadgeLevels: Done GENERATING QUERIES");
					$this->slog->write(array('level' => 1,'msg' => $__ip." test/newBadgeLevels: Done GENERATING QUERIES"));
					//log_message("INFO", $__ip." test/newBadgeLevels: Running them now");
					$this->slog->write(array('level' => 1,'msg' => $__ip." test/newBadgeLevels: Running them now"));
					foreach($queries as $q)
					{
						//log_message("INFO", $__ip." test/newBadgeLevels: DB QUERY\r\nABOUT TO RUN___".$q);
						$this->slog->write(array('level' => 1,'msg' => $__ip." test/newBadgeLevels: DB QUERY\r\nABOUT TO RUN___".$q));
						$result = $this->db->query($q);
						//log_message("INFO", $__ip." test/newBadgeLevels: DB QUERY\r\nJUST RAN___".$q."\r\nRESULT___".print_r(json_encode($result, JSON_FORCE_OBJECT), TRUE));
						$this->slog->write(array('level' => 1,'msg' => $__ip." test/newBadgeLevels: DB QUERY\r\nJUST RAN___".$q."\r\nRESULT___".print_r(json_encode($result, JSON_FORCE_OBJECT), TRUE)));
					}
					foreach($bbQueries as $bbq)
					{
						//log_message("INFO", $__ip." test/newBadgeLevels: DB QUERY\r\nABOUT TO RUN___".$bbq);
						$this->slog->write( array('level' => 1,'msg' => $__ip." test/newBadgeLevels: DB QUERY\r\nABOUT TO RUN___".$bbq) );
						$result2 = $this->db->query($bbq);
						//log_message("INFO", $__ip." test/newBadgeLevels: DB QUERY\r\nJUST RAN___\r\n".$bbq."\r\nRESULT___".print_r(json_encode($result2, JSON_FORCE_OBJECT), TRUE));
						$this->slog->write(array('level' => 1,'msg' => $__ip." test/newBadgeLevels: DB QUERY\r\nJUST RAN___\r\n".$bbq."\r\nRESULT___".print_r(json_encode($result2, JSON_FORCE_OBJECT), TRUE)));
					}
				break;
			case FALSE://log_message("INFO", $__ip." test/newBadgeLevels: DIDN't GET ANY DATA ");
			           $this->slog->write(array('level' => 1,'msg' => $__ip." test/newBadgeLevels: DIDN't GET ANY DATA "));
					 echo "<p> Got nothing from badges </p>";
				break;
		}
	}
	
	public function bragBucksProducts()
	{
		echo "<p>Brag bucks has been set already. Exiting!</p>";
		exit();
		// read all products data columns product_id, is_on_discount, discount, selling_price, bbucks
		
		/* start db transactions
		{
			loop through the product results.
			
			if discount > 0 then calculate its percentage
				to do that: calculate what percentage is discount of selling_price. call it P.
			newP = 0;
			if P > 0
			{
				if P > 10
				{
					newP = P - 10;
					bbucks = 10 percent of the selling_price;
				}
				else
				{
					newP = 0;
					bbucks = discount
				}
			}
			
			discount = newP percent of the selling_price;
			if discount > 0
			{
				is_on_discount = 1;
			}
			
			UPDATE products SET is_on_discount = current->is_on_discount, discount = current->discount, bbucks = current->bbucks
			WHERE product_id = current->product_id;
		}
		end db transactions
		*/
		$i = 0;
		for(; $i < 2; $i++)
		{
			$this->db->select('product_id');
			$this->db->select('is_on_discount');
			$this->db->select('discount');
			$this->db->select('selling_price');
			$this->db->select('bbucks');
			if($i === 0)
			{
				$this->db->from('products');
				print "<p> Now reading and computing bragbucks and discounts on table: <em><b>products</b></em></p>";
			}
			else
			{
				$this->db->from('productsNew');
				print "<p> Now reading and computing bragbucks and discounts on table: <em><b>productsNew</b></em></p>";
			}
			
			$readQuery = $this->db->get();
			
			switch($readQuery->num_rows() > 0)
			{
				case TRUE: $this->db->trans_start();
						$products = $readQuery->result();
						foreach($products as $product)
						{
							$realP = 0;
							$p = 0;
							$newP = 0;
							if($product->discount > 0)
							{
								$realP = ($product->discount * 100) / $product->selling_price;
								$p = floor($realP);
							}
							
							if($realP >= 1)
							{
								if($p > 0)
								{
									if($p > 10)
									{
										$newP = $p - 10;
										$product->bbucks = (10 * $product->selling_price) / 100;
										$product->discount = ($newP * $product->selling_price) / 100;
									}
									else
									{
										$newP = 0;
										$product->bbucks = $product->discount;
										$product->discount = 0;
									}
								}
							}
							else
							{
								if($product->discount > 0)
								{
									$newP = 0;
									$product->bbucks = $product->discount;
									$product->discount = 0;
								}
								else // when a product does not have any discount
								{
									$product->bbucks = (5 * $product->selling_price) / 100;
									$product->discount = 0;
								}
							}
							
							if($product->discount > 0)
							{
								$product->is_on_discount = 1;
							}
							else
							{
								$product->is_on_discount = 0;
							}
							
							$dbQ = "UPDATE products SET is_on_discount = ".$product->is_on_discount;
							$dbQ .= ", discount = ".$product->discount.", bbucks = ".$product->bbucks." WHERE product_id = ".$product->product_id;
							$this->db->query($dbQ);
						}
						$this->db->trans_complete();
						print "<p>Number of rows affected: ".$this->db->affected_rows()."</p>";
					break;
				case FALSE: print "<p> Did not get anything from products table. Can't proceed. </p>";
					break;
			}
		}
	}
	
	public function generateSendyDBPass($showPage = 1)
	{
	    switch($showPage)
	    {
	        case 2: $pass = $this->input->post('password');
	            $passEncrypted = hash('sha512', $pass.'PectGtma');
	            print "<pre> Password for DB is: \r\n".$passEncrypted."</pre>";
	            break;
	        case 1: ?>
	            <form action="<?php echo base_url()."test/generateSendyDBPass/2"; ?>" method="post">
	                <input type="text" name="password" placeholder="password" />
	                <input type="submit" value=" Show Sendy DB compatible password Hash " />
	            </form>
	            <?php
	            break;
	    }
	}
	
	public function testNotification()
	{
		$fancyBadges = array();
		for($i = 1; $i <= 16; $i++)
		{
			$badgeFancyProduct =  new badgeDetails;
			$badgeFancyProduct->type = 4;
			$badgeFancyProduct->typeDesc = 'You get these badges when you fancy products';
			$badgeFancyProduct->level = $i;
			switch($i)
			{
				case 1: $badgeFancyProduct->notificationText = 'Eye for Beauty - 0 Star';
					break;
				case 2: $badgeFancyProduct->notificationText = 'Eye for Beauty - 1 Star';
					break;
				case 3: $badgeFancyProduct->notificationText = 'Eye for Beauty - 2 Star';
					break;
				case 4: $badgeFancyProduct->notificationText = 'Eye for Beauty - 3 Star';
					break;
				case 5: $badgeFancyProduct->notificationText = 'The Aficionado - 0 Star';
					break;
				case 6: $badgeFancyProduct->notificationText = 'The Aficionado - 1 Star';
					break;
				case 7: $badgeFancyProduct->notificationText = 'The Aficionado - 2 Star';
					break;
				case 8: $badgeFancyProduct->notificationText = 'The Aficionado - 3 Star';
					break;
				case 9: $badgeFancyProduct->notificationText = 'The Connoisseur - 0 Star';
					break;
				case 10: $badgeFancyProduct->notificationText = 'The Connoisseur - 1 Star';
					break;
				case 11: $badgeFancyProduct->notificationText = 'The Connoisseur - 2 Star';
					break;
				case 12: $badgeFancyProduct->notificationText = 'The Connoisseur - 3 Star';
					break;
				case 13: $badgeFancyProduct->notificationText = 'The Curator - 0 Star';
					break;
				case 14: $badgeFancyProduct->notificationText = 'The Curator - 1 Star';
					break;
				case 15: $badgeFancyProduct->notificationText = 'The Curator - 2 Star';
					break;
				case 16: $badgeFancyProduct->notificationText = 'The Curator - 3 Star';
					break;
			}
			$fancyBadges[] = $badgeFancyProduct;
		}
		print "<pre>";
		print_r($fancyBadges);
		print "</pre>";
		
		print "<p>The notificationText for badge level 10 is: ".$fancyBadges[10]->notificationText."</p>";
	}

	public function image()
	{
		for ($i = 1; $i < 29; $i++) {
			$this->resize($i);
		}
	}
	
	public function getDomain()
	{
		$CI =& get_instance();
		return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $CI->config->slash_item('base_url'));
	}
	
	public function phpGetDomain()
	{
		$host = $_SERVER['HTTP_HOST'];
		preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
		echo "domain name is: {";
		print_r($matches);
		print "}\n";
	}
	
	public function domainTest()
	{
		print "<p>site url = ".site_url()."</p>";
		print "<p>get domain = ".$this->getDomain()."</p>";
		//print "<p>get phpDomain = ".$this->phpGetDomain()."</p>";
		print "<p>This->config->base_url = ".$this->config->item('base_url')."</p>";
		print "<p>__dir = ".__DIR__."</p>";
		print "<p>\$_SERVER[\"HTTP_HOST\"] = ".$_SERVER["HTTP_HOST"]."</p>";
		print "<pre>explode_url(\$_SERVER[\"HTTP_HOST\"]) = ";
		//print_r(parse_url($_SERVER["HTTP_HOST"], PHP_URL_SCHEME|PHP_URL_HOST|PHP_URL_PORT|PHP_URL_USER|PHP_URL_PASS|PHP_URL_PATH|PHP_URL_QUERY|PHP_URL_FRAGMENT));
		print_r(parse_url($this->config->item('base_url'), PHP_URL_PATH));
		print "\r\n";
		print_r(explode('/', parse_url($this->config->item('base_url'), PHP_URL_PATH)));
		print "</pre>";
	}

	public function resize($i)
	{
		$j = 0;
		while ($j < 10) {

			switch ($j) {
				case 0:
					$url = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . ".jpg";
					echo $url;
					$config['image_library'] = 'gd2';
					$config['quality'] = "100%";
					$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;

					$config['width'] = 598;
					$config['new_image'] = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . "\\img1_product.jpg";

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					}

					break;
				case 1:
					$url = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . ".jpg";
					echo $url;
					$config['image_library'] = 'gd2';
					$config['quality'] = "100%";
					$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;


					$config['width'] = 1013;
					$config['new_image'] = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . "\\fancy1.jpg";

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					}
					break;
				case 2:
					$url = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . ".jpg";
					echo $url;
					$config['image_library'] = 'gd2';
					$config['quality'] = "100%";
					$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;


					$config['width'] = 494;
					$config['new_image'] = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . "\\fancy2.jpg";

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					}
					break;
				case 3:
					$url = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . ".jpg";
					echo $url;
					$config['image_library'] = 'gd2';
					$config['quality'] = "100%";
					$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;

					$config['width'] = 323;
					$config['new_image'] = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . "\\fancy3.jpg";
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					}

					break;
				case 4:
					$url = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . ".jpg";
					echo $url;
					$config['image_library'] = 'gd2';
					$config['quality'] = "100%";
					$config['source_image'] = $url;
					$config['new_image'] = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . "\\crop.jpg";
					$vals = getimagesize($url);
					$w = $vals['0'];
					$h = $vals['1'];
					if ($w > $h) {
						$config['x_axis'] = $h;
						$config['y_axis'] = $h;
					} else {
						$config['x_axis'] = $w;
						$config['y_axis'] = $w;
					}
					$this->image_lib->initialize($config);
					if (!$this->image_lib->crop()) {
						echo $this->image_lib->display_errors();
					}
					break;
				case 3:
					$url = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . ".jpg";
					echo $url;
					$config['image_library'] = 'gd2';
					$config['quality'] = "100%";
					$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;

					$config['width'] = 323;
					$config['new_image'] = "D:\\wamp\\www\\fork\\BuynBrag\\test\\" . $i . "\\fancy3.jpg";
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$this->image_lib->initialize($config);
					if (!$this->image_lib->resize()) {
						echo $this->image_lib->display_errors();
					}

					break;


			}
			$j++;
		}
	}


	public function test2()
	{
		$url = "D:\\wamp\\www\\fork\\BuynBrag\\test\\1.jpg";
		echo $url;
		$config['image_library'] = 'gd2';
		$config['quality'] = "100%";
		$config['source_image'] = $url;
//                          $config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;

		$config['width'] = 40;
		$config['height'] = 40;
		$config['new_image'] = "D:\\wamp\\www\\fork\\BuynBrag\\test\\1\\img1_product.jpg";

		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}

	public function crop()
	{
		$img_path = '1.jpg';
		$img_thumb = '11.png';

		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_path;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;

		$img = getimagesize($img_path);
		$_width = $img['0'];
		$_height = $img['1'];
		print_r($img);

		$img_type = '';
		$thumb_size = 600;

		if ($_width > $_height) {
			// wide image
			$config['width'] = intval(($_width / $_height) * $thumb_size);
			if ($config['width'] % 2 != 0) {
				$config['width']++;
			}
			$config['height'] = $thumb_size;
			$img_type = 'wide';
		} else if ($_width < $_height) {
			// landscape image
			$config['width'] = $thumb_size;
			$config['height'] = intval(($_height / $_width) * $thumb_size);
			if ($config['height'] % 2 != 0) {
				$config['height']++;
			}
			$img_type = 'landscape';
		} else {
			// square image
			$config['width'] = $thumb_size;
			$config['height'] = $thumb_size;
			$img_type = 'square';
		}
		var_dump($config);
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		// reconfigure the image lib for cropping
		$conf_new = array(
			'image_library' => 'gd2',
			'source_image' => $img_thumb,
			'create_thumb' => FALSE,
			'maintain_ratio' => FALSE,
			'width' => $thumb_size,
			'height' => $thumb_size
		);

		if ($img_type == 'wide') {
			$conf_new['x_axis'] = ($config['width'] - $thumb_size) / 2;
			$conf_new['y_axis'] = 0;
		} else if ($img_type == 'landscape') {
			$conf_new['x_axis'] = 0;
			$conf_new['y_axis'] = ($config['height'] - $thumb_size) / 2;
		} else {
			$conf_new['x_axis'] = 0;
			$conf_new['y_axis'] = 0;
		}
		var_dump($conf_new);
		$this->image_lib->initialize($conf_new);

		$this->image_lib->crop();
	}


	function drow_thumb()
	{
		$im = imagecreatefromjpeg('1.jpg');

		if ($this->img['realext'] == 'jpg')
			$im = imagecreatefromjpeg('1.jpg');
		elseif ($this->img['realext'] == 'gif')
			$im = imagecreatefromgif('1.jpg'); elseif ($this->img['realext'] == 'png')
			$im = imagecreatefrompng('1.jpg');

		$thumbW = imagesx($im);
		$thumbH = imagesy($im);

		$canvas = imagecreatetruecolor($thumbW, $thumbH + 15);

		imagecopy($canvas, $im, 0, 0, 0, 0, $thumbW, $thumbH);

		imagedestroy($im);

		$thumbH += 15;

		$white = imagecolorallocate($canvas, 255, 255, 255);
		$black = imagecolorallocate($canvas, 0, 0, 0);

		imagefilledrectangle($canvas, 0, $thumbH - 15, $thumbW, $thumbH, $black);
		imagerectangle($canvas, 0, 0, $thumbW - 1, $thumbH - 1, $black);

		if ($this->img['size'] < 1024)
			$imghsize = $this->img['size'] . 'b';
		elseif ($this->img['size'] < 1024 * 1024)
			$imghsize = intval($this->img['size'] / 1024) . 'kb'; elseif ($this->img['size'] >= 1024 * 1024)
			$imghsize = intval($this->img['size'] / 1024 / 1024) . 'mb';

		$text = $this->img['width'] . 'x' . $this->img['height'] . ' ' . $imghsize;

		$textwidth = ceil('6' * strlen($text));
		$lefttextspace = intval(($thumbW - $textwidth) / 2);

		if ($textwidth >= $thumbW) {
			$text = $imghsize;
			$textwidth = ceil('6' * strlen($text));
			$lefttextspace = intval(($thumbW - $textwidth) / 2);
		}

		imagestring($canvas, 2, $lefttextspace, $thumbH - 14, $text, $white);

		if ($this->img['realext'] == 'jpg')
			imagejpeg($canvas, $this->img['thumbpath']);
		elseif ($this->img['realext'] == 'gif')
			imagegif($canvas, $this->img['thumbpath']); else
			imagepng($canvas, $this->img['thumbpath']);

		imagedestroy($canvas);


	}


	public function header()
	{
		//include 'header_for_controller.php';
		//By default, microtime() returns a string in the form "msec sec",
		//where sec is the current time measured in the number of seconds
		//since the Unix epoch (0:00:00 January 1, 1970 GMT), and
		//msec is the number of microseconds that have elapsed since sec expressed in seconds.
		$decimals = 4;
		$start_time = microtime();
		list($sm, $ss) = explode(' ', $start_time);
		sleep(21);
		list($em, $es) = explode(' ', microtime());
		$et = number_format(($em + $es) - ($sm + $ss), $decimals);
		var_dump($start_time);
		var_dump($sm);
		var_dump($ss);
		var_dump($em);
		var_dump($es);
		var_dump($et);
	}

	public function config()
	{
		$this->config->load('payu', TRUE);
		$config = $this->config->item('payu');
		$data['key'] = $config['key'];
		$data['salt'] = $config['salt'];
		$data['url'] = $config['url'];

		var_dump($data['url']);
	}

	public function invite()
	{
		//include 'header_for_controller.php';
		$this->load->library('fb_connect');
		$this->config->load('facebook', TRUE);
		$config = $this->config->item('facebook');
		$data['app_id'] = $config['appId'];
		$data['base_url'] = base_url();
		$fb_friends = $this->fb_connect->friends;
		$min = 0;
		$max = count($fb_friends['data']);
		$quantity = 54;
		$numbers = range($min, $max);
		shuffle($numbers);
		$data['keys'] = array_slice($numbers, 0, $quantity);
		$data['friends'] = $fb_friends['data'];
		$this->load->view('invite_people_js', $data);
	}

	public function invite_real()
	{
		include 'header_for_controller.php';
		$this->load->library('fb_connect');
		$this->config->load('facebook', TRUE);
		$config = $this->config->item('facebook');
		$data['app_id'] = $config['appId'];
		$data['base_url'] = base_url();
		$fb_friends = $this->fb_connect->friends;
		$min = 0;
		$max = count($fb_friends['data']) - 1;
		if ((int)count($fb_friends['data']) > 54)
			$quantity = 54;
		else
			$quantity = (int)count($fb_friends['data']);
		$numbers = range($min, $max);
		shuffle($numbers);
		$data['keys'] = array_slice($numbers, 0, $quantity);
		$data['friends'] = $fb_friends['data'];
		//echo '<img src="http://graph.facebook.com/'.$data['friends'][816]['id'].'/picture?type=large" height="96" width="96" alt="profile_pic"/>';
		//echo '<img src="http://graph.facebook.com/'.$data['friends'][0]['id'].'/picture?type=large" height="96" width="96" alt="profile_pic"/>';
		$this->load->view('invite_people', $data);
	}

	public function new_fun()
	{
		echo 'FFF Badly';
	}

	public function login()
	{
		$data['base_url'] = base_url();
//        $this->load->view('fb_login_js',$data);
		$this->load->view('cookie_test', $data);
	}

	public function next()
	{
		$format = 'g:i:s';
		$userid = 7;
		$data = array('id' => $userid, 'logged_in' => TRUE);
		$this->session->set_userdata($data);
		//$this->session->set_userdata('user_data',$data);
		$last_activity = $this->session->userdata('last_activity');
		$last_activity_time = date($format, $last_activity);
		$userdata = $this->session->userdata('user_data');
		$uid = $this->session->userdata('id');
		$all_data = $this->session->all_userdata();
		$cookie = array(
			'name' => 'bnb',
			'value' => $userid,
			'expire' => '0',
			'path' => '/',
			'prefix' => 'lee_',
			'secure' => FALSE
		);
		$this->input->set_cookie($cookie);
		$cookie_data = get_cookie('bnb');
		$def_cookie = get_cookie('BuynBrag');
		echo 'All Session data: ';
		var_dump($all_data);
		echo 'All Cookie data: ';
		var_dump($cookie_data);
		var_dump($def_cookie);
		var_dump('User id: ' . $uid);
		echo 'Last Activity: ';
		var_dump($last_activity_time);
		echo '<a href="' . base_url() . 'index.php/test/session_check1' . '">session_check1</a><br>';
		echo '<a href="' . base_url() . 'index.php/test/session_check2' . '">session_check2</a><br>';
		echo '<a href="' . base_url() . 'index.php/test/session_check3' . '">session_check3</a><br>';
		echo '<a href="' . base_url() . 'index.php/test/logout' . '">Logout</a>';
	}

	public function session_check1()
	{
		$this->load->model('test_model');
		$format = 'g:i:s';
		$logged_in = $this->session->userdata('last_activity');
		$session_user_data = $this->test_model->session();
		if ($logged_in) {
			$last_activity = $this->session->userdata('last_activity');
			$last_activity_time = date($format, $last_activity);
			var_dump($last_activity_time);
			var_dump($session_user_data);
			echo '<a href="' . base_url() . 'index.php/test/session_check2' . '">session_check2</a><br>';
			echo '<a href="' . base_url() . 'index.php/test/session_check3' . '">session_check3</a><br>';
			echo '<a href="' . base_url() . 'index.php/test/next' . '">next</a>';
			echo '<br><a href="' . base_url() . 'index.php/test/logout' . '">Logout</a>';
		} else {
			$url = base_url('index.php/test/logout');
			redirect($url, 'Location');
		}

	}

	public function session_check2()
	{
		$this->load->model('test_model');
		$format = 'g:i:s';
		$logged_in = $this->session->userdata('last_activity');
		$session_user_data = $this->test_model->session();
		if ($logged_in) {
			$last_activity = $this->session->userdata('last_activity');
			$last_activity_time = date($format, $last_activity);
			var_dump($last_activity_time);
			var_dump($session_user_data);
			echo '<a href="' . base_url() . 'index.php/test/session_check1' . '">session_check1</a><br>';
			echo '<a href="' . base_url() . 'index.php/test/session_check3' . '">session_check3</a><br>';
			echo '<a href="' . base_url() . 'index.php/test/next' . '">next</a>';
			echo '<br><a href="' . base_url() . 'index.php/test/logout' . '">Logout</a>';
		} else {
			$url = base_url('index.php/test/logout');
			redirect($url, 'Location');
		}
	}

	public function session_check3()
	{
		$this->load->model('test_model');
		$format = 'g:i:s';
		$logged_in = $this->session->userdata('last_activity');
		$session_user_data = $this->test_model->session();
		if ($logged_in) {
			$last_activity = $this->session->userdata('last_activity');
			$last_activity_time = date($format, $last_activity);
			var_dump($last_activity_time);
			var_dump($session_user_data);
			echo '<a href="' . base_url() . 'index.php/test/session_check2' . '">session_check2</a><br>';
			echo '<a href="' . base_url() . 'index.php/test/session_check1' . '">session_check1</a><br>';
			echo '<a href="' . base_url() . 'index.php/test/next' . '">next</a>';
			echo '<br><a href="' . base_url() . 'index.php/test/logout' . '">Logout</a>';
		} else {
			$url = base_url('index.php/test/logout');
			redirect($url, 'Location');
		}
	}

	public function logout()
	{
		$userid = 0;
		$data = array('id' => $userid, 'logged_in' => TRUE);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		$val = $this->session->userdata('logged_in');
		if (empty($val)) {
			var_dump($val);
			$data['base_url'] = base_url();
			$this->load->view('cookie_test', $data);
		} else
			echo 'FFF';
	}

	public function input()
	{
		$data['base_url'] = base_url();
		$this->load->view('input', $data);
	}

	public function input_hidden()
	{
		$data['base_url'] = base_url();
		$data['v1'] = $this->input->post('v1');
		$data['v2'] = $this->input->post('v2');
		$data['v3'] = $this->input->post('v3');
		$this->load->view('input_hidden', $data);
	}

	public function submit()
	{
		$session_data['v1'] = $this->input->post('v1');
		$session_data['v2'] = $this->input->post('v2');
		$session_data['v3'] = $this->input->post('v3');

		var_dump($session_data);
	}

	function fbConnect()
	{
		$this->load->library('fb_connect');
		$userId = $this->fb_connect->user_id;
		$userDetails = $this->fb_connect->user;
		$friends = $this->fb_connect->friends;
		//echo '<img src="http://graph.facebook.com/'.$data['friends'][816]['id'].'/picture?type=large" height="96" width="96" alt="profile_pic"/>';
		echo '<img src="http://graph.facebook.com/' . $userId . '/picture?type=large" height="96" width="96" alt="profile_pic"/>';
		var_dump($friends);
		var_dump($userDetails);
	}

	function imgsize()
	{
		$imgPath = '../../assets/images/stores/100/100/fancy1.jpg';
		$imgPath2 = './assets/images/stores/100/100/fancy1.JPG';
		echo '<img src="' . $imgPath . '" />';
		$properties = getimagesize($imgPath2);
		var_dump($properties);
		$width = $properties[0];
		$height = $properties[1];
		echo $width . '<br>' . $height;
	}

	function send_mail($txnid)
	{
		$this->load->model('vc_orders');
		$mail_info = $this->vc_orders->purchase_mail_details($txnid);
		if ($mail_info != 0) {
			$count_prod = count($mail_info);
			$buyer_name = $mail_info[0]['shipping_fname'] . ' ' . $mail_info[0]['shipping_lname'];
			$shipping_address = $mail_info[0]['shipping_address'];
			$shipping_city = $mail_info[0]['shipping_city'];
			$pin_code = $mail_info[0]['shipping_pincode'];
			$payment_mode = $mail_info[0]['pg_type'];
			if ($payment_mode == 'COD')
				$payment_mode = 'Cash on Delivery';
			elseif ($payment_mode == 'CC')
				$payment_mode = 'Credit Card'; elseif ($payment_mode == 'DC')
				$payment_mode = 'Debit Card'; elseif ($payment_mode == 'NB')
				$payment_mode = 'Net Banking';
			for ($j = 0; $j < $count_prod; $j++) {
				$order_no = $mail_info[$j]['order_id'];
				$product_name = $mail_info[$j]['product_name'];

				$variant_size = "Size: " . $mail_info[$j]['variant_size'];
				$variant_color = "Color: " . $mail_info[$j]['variant_color'];

				if ($mail_info[$j]['variant_size'] == "0" and $mail_info[$j]['variant_color'] == "0")
					$variant_details = "";
				elseif ($mail_info[$j]['variant_size'] != "0" and $mail_info[$j]['variant_color'] == "0")
					$variant_details = " - (" . $variant_size . ")"; elseif ($mail_info[$j]['variant_size'] == "0" and $mail_info[$j]['variant_color'] != "0")
					$variant_details = " - (" . $variant_color . ")"; elseif ($mail_info[$j]['variant_size'] != "0" and $mail_info[$j]['variant_color'] != "0")
					$variant_details = " - (" . $variant_size . "," . $variant_color . ")";

				$process_days = (int)$mail_info[$j]['process_days'];
				include 'mail_4.php';
				//Buyer Purchase Email
				$this->load->library('email');
				$this->email->from('support@buyandbrag.in', 'BuynBrag');
				$this->email->to($mail_info[0]['sent_email_id']);
				//$this->email->bcc('bnb.vitallabs@gmail.com');
				$this->email->subject("BuynBrag: Order Success,Order Id:$order_no");
				$this->email->message($purchase_message);
				$this->email->set_newline("\r\n");
				if ($this->email->send())
					//log_message('Info', "Order success mail sent successfully for order no: $order_no");
				    $this->slog->write(array('level'=> 1,'msg' => "Order success mail sent successfully for order no: $order_no"));
				else
					//log_message('Info', "Order success mail sending failed for order no: $order_no");
				    $this->slog->write(array('level' =>1 ,'msg' => "Order success mail sending failed for order no: $order_no"));
				//////////////////////////////
				$owner_name = $mail_info[$j]['owner_name'];
				//$owner_email = $mail_info[$j]['contact_email'];
				$amount_paid = (int)$mail_info[$j]['amt_paid'];
				$quantity = (int)$mail_info[$j]['quantity'];
				$total_amount = (int)$amount_paid * $quantity;
				$productImagePath = './assets/images/stores/' . $mail_info[$j]['store_id'] . '/' . $mail_info[$j]['product_id'] . '/';
				if (file_exists($productImagePath . 'fancy1.jpg')) {
					$productImage = $productImagePath . 'fancy1.jpg';
				} elseif (file_exists($productImagePath . 'fancy1.JPG')) {
					$productImage = $productImagePath . 'fancy1.JPG';
				} else {
					$productImage = '';
				}
				include 'mail_7.php';
				//Seller New Order Email
				$this->load->library('email');
				$this->email->clear(TRUE);
				$this->email->from('support@buyandbrag.in', 'BuynBrag');
				if (empty($owner_email))
					$owner_email = 'bnb.vitallabs@gmail.com';
				$this->email->to($owner_email);
				//$this->email->bcc('bnb.vitallabs@gmail.com,rajat.bhagat@buynbrag.com,arif@buynbrag.com,prt@buynbrag.com,ayushjain@buynbrag.com,gauri@buynbrag.com,bobby@buynbrag.com,lucky@buynbrag.com,finance@buynbrag.com');
				$this->email->bcc('bnb.vitallabs@gmail.com');
				$this->email->subject("New Order from BuynBrag,Order Id:$order_no");
				$this->email->message($new_order_message);
				$this->email->attach('./invoice/' . $txnid . '/buyer_invoice_order_' . $order_no . '.pdf');
				if (!empty($productImage))
					$this->email->attach($productImage);
				$this->email->set_newline("\r\n");
				if ($this->email->send())
				{
					//log_message('Info', "Seller new order recived. Mail sent to $owner_email for order no: $order_no");
					$this->slog->write(array('level'=>1,'msg'=> "Seller new order recived. Mail sent to $owner_email for order no: $order_no"));
					if ($j == ($count_prod - 1))
						$this->vc_orders->purchase_mail_success($txnid);
				} //end email send
				else {
					//log_message('Info', "Some error occured while sending 'Seller new order recived' mail to $owner_email order no: $order_no");
					$this->slog->write(array('level'=>1,'msg'=> "Some error occured while sending 'Seller new order recived' mail to $owner_email order no: $order_no"));
				}
				$this->email->clear(TRUE);
			}
			//end for
		}
		//end if mail_info !=0
	}
	
	public function sendCartEmails()
	{
		$this->load->model('cartdb');
		$products = $this->cartdb->selectOneWeekOldProducts();
		$users = array();
		foreach($products as $product)
		{
			
		}
	}
	
	public function mysqlTest()
	{
		print "<p>Query started at: ".time()." using mysql</p>";
		$this->db->select('*');
		$this->db->from('products');
		$result = $this->db->get();
		print "<p><b>TIME: ".time()." using mysql</b></p>";
		print "<p>NUmber of rows returned: ".$result->num_rows()."</p><p>Printing Data</p>";
		print "<pre>";print_r($result);print "</pre>";
		print "<pre>";print_r($result->result());print "</pre>";
		print "<p><b>TIME: ".time()." using mysql</b></p>";
	}
}

?>
