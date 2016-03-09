<?php if ( ! defined ('BASEPATH') ) exit('403 Unauthorized!');
class Dbupdate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function userRanks( $live = 0 )
	{
		/* update rank in user_details.userRank */
		/* update total fancy count in user_details.fancy_counter */
		$dbName = "bnbdbTest";
		switch( $live )
		{
			case 0:	$dbName = "`bnbdbTest`.";
				break;
			case 1:	$dbName = "`bnbdb`.";
				break;
		}

		$q1SQL = "SELECT `user_id` AS `userID` FROM ".$dbName."`buynbrag_rankScore` ORDER BY `score` DESC"; // read the rank of all users
		$q1 = $this->db->query( $q1SQL );
		$q1Count = $q1->num_rows();

		switch( $q1Count )
		{
			case TRUE:	$r1 = $q1->result();
						$userIDs = array();
						$q2SQL = "UPDATE ".$dbName."`user_details` SET `userRank` = (CASE `user_id`";
						for( $i = 0; $i < $q1Count; $i++ )
						{
							$q2SQL .= " WHEN ".$r1[ $i ]->userID." THEN ".($i + 1);
							$userIDs[] = $r1[ $i ]->userID;
						}

						$q2SQL .= " ELSE NULL END) WHERE `user_id` IN (".implode(",", $userIDs).")";
						$this->db->query( $q2SQL );
						echo "\r\n Updated ranks for ".$q1Count." users. affected rows = ".$this->db->affected_rows()."\r\n";
				break;
			case FALSE:	log_message('INFO', "USER RANKS COULD NOT BE READ FROM buynbrag_rankScore" );
		}
		log_message('INFO', "JUST RAN__\r\n".$q1SQL );
		log_message('DEBUG', "CRON:::RANK + FANCY_COUNT:- JUST updated userRank and fancy_counter in bnbdbTest.user_details. Affected rows = ".$this->db->affected_rows() );

		sleep(3); /* sleep for 3 seconds */
	}

	public function userRanks__OLD()
	{
		/* update rank in user_details.userRank */
		/* update total fancy count in user_details.fancy_counter */
		$q1SQL = "UPDATE `bnbdbTest`.`user_details`, `bnbdbTest`.`fancy_rank` SET `user_details`.`userRank` = `fancy_rank`.`rank`, `user_details`.`fancy_counter` = `fancy_rank`.`total_fancy` WHERE `fancy_rank`.`user_id` = `user_details`.`user_id`";
		$this->db->query( $q1SQL );
		log_message('INFO', "JUST RAN__\r\n".$q1SQL );
		log_message('DEBUG', "CRON:::RANK + FANCY_COUNT:- JUST updated userRank and fancy_counter in bnbdbTest.user_details. Affected rows = ".$this->db->affected_rows() );

		sleep(3); /* sleep for 3 seconds */

		$q2SQL = "UPDATE `bnbdb`.`user_details`, `bnbdb`.`fancy_rank` SET `user_details`.`userRank` = `fancy_rank`.`rank`, `user_details`.`fancy_counter` = `fancy_rank`.`total_fancy` WHERE `fancy_rank`.`user_id` = `user_details`.`user_id`";
		$this->db->query( $q2SQL );
		log_message('INFO', "JUST RAN__\r\n".$q2SQL );
		log_message('DEBUG', "CRON:::RANK + FANCY_COUNT:- JUST updated userRank and fancy_counter in bnbdb.user_details. Affected rows = ".$this->db->affected_rows() );
	}

	public function storeSectionProductsCount()
	{
		$q1SQL = "UPDATE `bnbdbTest`.`store_section` SET `totalProducts` = (SELECT COUNT(`products`.`product_id`) FROM `bnbdbTest`.`products` WHERE `products`.`storesection_id` = `store_section`.`storesection_id` AND `products`.`is_enable` = 0 AND `products`.`status` = 1)";
		$this->db->query( $q1SQL );
		log_message('INFO', "JUST RAN__\r\n".$q1SQL );
		log_message('DEBUG', "CRON:::storeSectionProductsCount:- JUST UPDATED THE `bnbdbTest`.`totalProducts` COUNT FOR ALL STORE_SECTIONS. ONLY COUNTED ENABLED PRODUCTS. Affected rows = ".$this->db->affected_rows() );

		sleep(3); /* sleep for 3 seconds */

		$q2SQL = "UPDATE `bnbdb`.`store_section` SET `totalProducts` = (SELECT COUNT(`products`.`product_id`) FROM `bnbdb`.`products` WHERE `products`.`storesection_id` = `store_section`.`storesection_id` AND `products`.`is_enable` = 0 AND `products`.`status` = 1)";
		$this->db->query( $q2SQL );
		log_message('INFO', "JUST RAN__\r\n".$q2SQL );
		log_message('DEBUG', "CRON:::storeSectionProductsCount:- JUST UPDATED THE `bnbdb`.`totalProducts` COUNT FOR ALL STORE_SECTIONS. ONLY COUNTED ENABLED PRODUCTS. Affected rows = ".$this->db->affected_rows() );
	}

	public function newRank($uid = NULL)
	{
		/*
		QUERY BEING USED==================================================
		SELECT DISTINCT(`fancy_products`.`product_id`), `products`.`fancy_counter` FROM `fancy_products`
		JOIN `products` ON `products`.`product_id` = `fancy_products`.`product_id`
		WHERE `user_id` = 141
		ORDER BY `fancy_counter` DESC;
		*/
		$rank = 0;
		if(is_null($uid))
		{
			return FALSE;
		}
		$q1SQL = "SELECT DISTINCT(`fancy_products`.`product_id`), `products`.`fancy_counter`";
		$q1SQL .= " FROM `fancy_products`";
		$q1SQL .= " JOIN `products` ON `products`.`product_id` = `fancy_products`.`product_id`";
		$q1SQL .= " WHERE `fancy_products`.`user_id` = ".$uid." ORDER BY `fancy_counter` DESC";

		$q1 = $this->db->query( $q1SQL );
		log_message('INFO', "JUST RAN__\r\n".$q1SQL );
		
		switch($q1->num_rows() > 0)
		{
			case FALSE: return FALSE;
				break;
			case TRUE: $b = $q1->result();
					 $a = count($b);
					 $prank = 0;
					 foreach($b as $bElement)
					 {
						$prank += $bElement->fancy_counter;
					 }
					 $rank += $prank;
					 /*
					 QUERY BEING USED==================================================
					 SELECT `badge_type`, `badge_level` FROM `badges` WHERE `user_id` = 141;
					 */
					 $q2SQL = "SELECT `badge_type`, `badge_level` FROM `badges` WHERE `user_id` = ".$uid;

					 $q2 = $this->db->query( $q2SQL );
					 log_message('INFO', "JUST RAN__\r\n".$q2SQL );
					 
					 $c = 0;

					 switch($q2->num_rows() > 0)
					 {
						case FALSE: $c += 0;
							break;
						case TRUE: $cData = $q2->result();
								 foreach($cData as $cDataItem)
								 {
									switch($cDataItem->badge_type)
									{
										case 1: $c += $cDataItem->badge_level * 10;
											break;
										case 2: $c += $cDataItem->badge_level * 15;
											break;
										case 3: $c += $cDataItem->badge_level * 25;
											break;
										case 4: $c += $cDataItem->badge_level * 20;
											break;
										case 5: $c += $cDataItem->badge_level * 30;
											break;
										case 6: $c += $cDataItem->badge_level * 50;
											break;
										case 8: $c += $cDataItem->badge_level * 50;
											break;
										case 9: $c += $cDataItem->badge_level * 50;
											break;
									}
								 }
							break;
					 }
					 $rank += $c;
					 $rank /= $a;
				break;
		}
		return $rank;
	}
	
	public function saveBuynbragRank( $userID = NULL )
	{
		if( $userID !== NULL )
		{
			$rankScore = $this->newRank( $userID ); /* compute the new rank */
			if($rankScore === FALSE) /* if we can not compute the rank */
			{
				$rankScore = ($userID - ($userID + $userID)); /* use the negated value of the userID as rankScore i.e., -4321 for user id 4321 */
			}
			/* find if a rank score entry exists for the current user */
			$q1SQL = "SELECT `user_id` FROM `buynbrag_rankScore` WHERE `user_id` = ".$userID;

			$q1 = $this->db->query( $q1SQL );
			log_message('INFO', "JUST RAN__\r\n".$q1SQL );
			
			$q2SQL = NULL;
			switch($q1->num_rows() > 0)
			{
				case TRUE:	$q2SQL = "UPDATE `buynbrag_rankScore` SET `score` = ".$rankScore." WHERE `user_id` = ".$userID;
					break;
				case FALSE:	$q2SQL ="INSERT INTO `buynbrag_rankScore`(`user_id`, `score`) VALUES(".$userID.", ".$rankScore.")";
					break;
			}

			$q2 = $this->db->query( $q2SQL );
			log_message('INFO', "JUST RAN__\r\n".$q2SQL );

			return (($this->db->affected_rows() > 0)? TRUE: FALSE);
		}
		else
		{
			return NULL;
		}
	}
	
	public function updateRankScores( $live = 0 )
	{
		log_message('DEBUG', "inside dbupdate/updateRankScores/".($live == 0? 'TEST_DB': 'LIVE_DB') );
		$dbName = "bnbdbTest";
		switch( $live )
		{
			case 0:	$dbName = "`bnbdbTest`.";
				break;
			case 1:	$dbName = "`bnbdb`.";
				break;
		}

		echo "\r\nDBNAME = ".$dbName."\r\n";
		$q1SQL = "SELECT `user_id`, `multiplier` FROM ".$dbName."`user_details` ORDER BY `userRank` DESC";

		$q1 = $this->db->query( $q1SQL );
		log_message('INFO', "JUST RAN__\r\n".$q1SQL );

		switch( $q1->num_rows() > 0 )
		{
			case TRUE:	$r1 = $q1->result();
						
						$nullUserIDs = 0;
						$aRows = 0;
						$zeroFanciedUsers = array();

						$this->db->trans_start(); /* start a DB transaction */

						foreach( $r1 as $key => $rItem )
						{
							$userID = $rItem->user_id;
							$multiplier = ( $rItem->multiplier / 1000 ); // divide the multiplier by 1000
							if( $userID !== NULL )
							{
								/* compute the new rank */
								$rank = 0;
								if( is_null( $userID ) )
								{
									$nullUserIDs++;
								}
								$q1SQL = "SELECT DISTINCT(`fancy_products`.`product_id`), `products`.`fancy_counter`";
								$q1SQL .= " FROM ".$dbName."`fancy_products`";
								$q1SQL .= " JOIN ".$dbName."`products` ON `products`.`product_id` = `fancy_products`.`product_id`";
								$q1SQL .= " WHERE `fancy_products`.`user_id` = ".$userID." ORDER BY `fancy_counter` DESC";

								$q1 = $this->db->query( $q1SQL );
								log_message('INFO', "JUST RAN__\r\n".$q1SQL );
								$bCount = $q1->num_rows();
								
								switch( $bCount > 0)
								{
									case FALSE: $zeroFanciedUsers[] = $userID;
										break;
									case TRUE: $b = $q1->result();
											 $a = $bCount;
											 $prank = 0;
											 foreach($b as $bElement)
											 {
												$prank += $bElement->fancy_counter;
											 }
											 $rank += $prank;
											 /*
											 QUERY BEING USED==================================================
											 SELECT `badge_type`, `badge_level` FROM `badges` WHERE `user_id` = 141;
											 */
											 $q2SQL = "SELECT `badge_type`, `badge_level` FROM ".$dbName."`badges` WHERE `user_id` = ".$userID;

											 $q2 = $this->db->query( $q2SQL );
											 /* log_message('INFO', "JUST RAN__\r\n".$q2SQL ); */
											 
											 $c = 0;

											 switch($q2->num_rows() > 0)
											 {
												case FALSE: $c += 0;
													break;
												case TRUE: $cData = $q2->result();
														 foreach($cData as $cDataItem)
														 {
															switch($cDataItem->badge_type)
															{
																case 1: $c += $cDataItem->badge_level * 10;
																	break;
																case 2: $c += $cDataItem->badge_level * 15;
																	break;
																case 3: $c += $cDataItem->badge_level * 25;
																	break;
																case 4: $c += $cDataItem->badge_level * 20;
																	break;
																case 5: $c += $cDataItem->badge_level * 30;
																	break;
																case 6: $c += $cDataItem->badge_level * 50;
																	break;
																case 8: $c += $cDataItem->badge_level * 50;
																	break;
																case 9: $c += $cDataItem->badge_level * 50;
																	break;
															}
														 }
													break;
											 }
											 $rank += $c;
											 $rank /= $a;
											 $rank *= $multiplier;
										break;
								} /* end rank score computation */

								if($userID == 8007) echo "Rank of 8007 = ".$rank."\r\n";

								if( $rank === FALSE ) /* if we can not compute the rank */
								{
									$rank = ($userID - ($userID + $userID)); /* use the negated value of the userID as rankScore i.e., -4321 for user id 4321 */
								}
								/* find if a rank score entry exists for the current user */
								$q1SQL = "SELECT `user_id` FROM ".$dbName."`buynbrag_rankScore` WHERE `user_id` = ".$userID;

								$q1 = $this->db->query( $q1SQL );
								/* log_message('INFO', "JUST RAN__\r\n".$q1SQL ); */
								
								$q2SQL = NULL;

								/* $logStr = "CRON:::updateCurators:- JUST "; */
								
								switch( $q1->num_rows() > 0 )
								{
									case TRUE:	$q2SQL = "UPDATE ".$dbName."`buynbrag_rankScore` SET `score` = ".$rank." WHERE `user_id` = ".$userID;
												/* $logStr .= " UPDATED"; */
										break;
									case FALSE:	$q2SQL ="INSERT INTO ".$dbName."`buynbrag_rankScore`(`user_id`, `score`) VALUES(".$userID.", ".$rank.")";
												/* $logStr .= " INSERTED INTO"; */
										break;
								}
								/*$logStr .= "`bnbdb`.`rankScore` . Affected rows = ";*/

								$q2 = $this->db->query( $q2SQL );
								if($userID == 8007) echo "q2SQL = ".$q2SQL."\r\n";
								/* log_message('INFO', "JUST RAN__\r\n".$q2SQL ); */

								/*log_message('DEBUG', $logStr.$this->db->affected_rows() );*/
								$aRows += $this->db->affected_rows();
							}
							else
							{
								$nullUserIDs++;
							}

							if( $key !== 0 && $key % 1000 === 0 )
							{
								log_message('DEBUG', "CRON:::updateRankScores:- Processed ".$key." records so far. Sleeping for 1 second now!" );
							}
						}

						$zeroFanciedUsersCount = count($zeroFanciedUsers);

						log_message('DEBUG', "dbupdate/updateRankScores::rank computation found ".$zeroFanciedUsersCount." users with no fancies. Now creating their scores");

						if( $zeroFanciedUsersCount > 0 )
						{
							$q1SQL = "SELECT MAX(`score`) AS `maxScore`, MIN(`score`) AS `minScore` FROM ".$dbName."`buynbrag_rankScore`";
							$maxScore = 0;
							$q1 = $this->db->query( $q1SQL );
							log_message('INFO', "JUST RAN__\r\n".$q1SQL );
							switch( $q1->num_rows() > 0 )
							{
								case TRUE:	$r1 = $q1->result();
											$maxScore = $r1[0]->maxScore;
											$minScore = $r1[0]->minScore;
											if($minScore < 0)
											{
												$maxScore = $minScore * (-1); // convert the minima to a positive number
											}
											$maxScore = ceil($maxScore);
									break;
							}

							foreach( $zeroFanciedUsers as $key => $userID )
							{
								$q1SQL = "SELECT `user_id` FROM ".$dbName."`buynbrag_rankScore` WHERE `user_id` = ".$userID;
								$q2SQL = NULL;

								$q1 = $this->db->query( $q1SQL );
								log_message('INFO', "JUST RAN__\r\n".$q1SQL );
								
								switch( $q1->num_rows() > 0 )
								{
									case TRUE:	$q2SQL = "UPDATE ".$dbName."`buynbrag_rankScore` SET `score` = ".($maxScore - ($maxScore * 2) )." WHERE `user_id` = ".$userID;
										break;
									case FALSE:	$q2SQL ="INSERT INTO ".$dbName."`buynbrag_rankScore`(`user_id`, `score`) VALUES(".$userID.", ".($maxScore - ($maxScore * 2) ).")";
										break;
								}

								$q2 = $this->db->query( $q2SQL );
								log_message('INFO', "JUST RAN__\r\n".$q2SQL );
								$maxScore++;
							}
						}

						$this->db->trans_complete();

						log_message('DEBUG', "CRON:::updateRankScores foreach user_id loop. userID = NULL occurred ".$nullUserIDs." times");
						log_message('DEBUG', "CRON:::updateRankScores UPDATED / INSERTED scores for ".$aRows." users");
				break;
		}
	}

	public function fixShoppingBadge( $live = 0 )
	{
		log_message('DEBUG', "inside dbupdate/fixShoppingBadge/".($live == 0? 'TEST_DB': 'LIVE_DB') );
		$dbName = "bnbdbTest";
		switch( $live )
		{
			case 0:	$dbName = "`bnbdbTest`.";
				break;
			case 1:	$dbName = "`bnbdb`.";
				break;
		}

		echo "\r\nDBNAME = ".$dbName."\r\n";

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

	public function updateCurators()
	{
		$q1SQL = "UPDATE `bnbdb`.`products` SET `products`.`curator` = (SELECT `user_id` FROM `bnbdb`.`fancy_products` WHERE `fancy_products`.`product_id` = `products`.`product_id` ORDER BY `time` ASC LIMIT 1) WHERE `products`.`curator` = 0";
		$q1 = $this->db->query( $q1SQL );
		echo "\r\nJUST RAN__\r\n".$q1SQL;
		echo "\r\nCRON:::updateCurators:- JUST UPDATED THE `bnbdb`.`products`.`curator` ALL PRODUCTS WITH NO CURATOR.\r\nAffected rows = ".$this->db->affected_rows();
		log_message('INFO', "JUST RAN__\r\n".$q1SQL );
		log_message('DEBUG', "CRON:::updateCurators:- JUST UPDATED THE `bnbdb`.`products`.`curator` ALL PRODUCTS WITH NO CURATOR. Affected rows = ".$this->db->affected_rows() );

		$q2SQL = "UPDATE `bnbdbTest`.`products` SET `products`.`curator` = (SELECT `user_id` FROM `bnbdbTest`.`fancy_products` WHERE `fancy_products`.`product_id` = `products`.`product_id` ORDER BY `time` ASC LIMIT 1) WHERE `products`.`curator` = 0";
		$q2 = $this->db->query( $q2SQL );
		echo "\r\nJUST RAN__\r\n".$q2SQL;
		echo "\r\nCRON:::updateCurators:- JUST UPDATED THE `bnbdbTest`.`products`.`curator` ALL PRODUCTS WITH NO CURATOR.\r\nAffected rows = ".$this->db->affected_rows();
		echo "\r\n";
		log_message('INFO', "JUST RAN__\r\n".$q2SQL );
		log_message('DEBUG', "CRON:::updateCurators:- JUST UPDATED THE `bnbdbTest`.`products`.`curator` ALL PRODUCTS WITH NO CURATOR. Affected rows = ".$this->db->affected_rows() );
	}

	public function updateMultipliers( $live = 0 )
	{
		echo "\r\n";
		log_message('DEBUG', "inside dbupdate/updateMultipliers/".($live == 0? 'TEST_DB': 'LIVE_DB') );
		$dbName = "bnbdbTest";
		switch( $live )
		{
			case 0:	$dbName = "`bnbdbTest`.";
				break;
			case 1:	$dbName = "`bnbdb`.";
				break;
		}

		echo "\r\nDBNAME = ".$dbName."\r\n";

		//	read all the products, store in A
		//	create an array M to store all the multiplier values
		//	loop through A using i = 0
		//		read all the people who have curated the product A[i], sorted by time in ascending order, store in B
		//		loop through B using j = 0
		//			if j = 0 then MULTIPLIER = 10 else MULTIPLIER = 1
		//			if isset( M[ B[i]->userID ] && M[ B[i]->userID ] > 0 ) then M[ B[i]->userID ] += MULTIPLIER else M[ B[i]->userID ] = MULTIPLIER;
		//		end loop B[j]
		//	end loop A[i]
		//	count(M) and store in MCount
		//	q = "UPDATE user_details SET multiplier = (CASE id"
		//	loop through M
		//		q += " WHEN " + ( M->currentKey ) + " THEN " + ( M->value )
		//	q += " END CASE)"
		//	this->db->query( q )

		$noFancyA = array(); //  array to hold the productIDs of all products that have never been fancied

		$q1 = $this->db->query( "SELECT DISTINCT(`product_id`) AS `productID` FROM ".$dbName."`products`" );

		$aCount = $q1->num_rows();
		switch ($aCount > 0)
		{
			case TRUE:	$a = $q1->result();
						$q1 = NULL; // free-up memory
						$m = array(); // array to hold multiplier values
						$i = 0;
						for(; $i < $aCount; $i++ )
						{
							$q2 = $this->db->query( "SELECT `user_id` AS `userID` FROM ".$dbName."`fancy_products` WHERE `product_id` = ".$a[$i]->productID." ORDER BY `time` ASC" );
							$bCount = $q2->num_rows();
							switch($bCount > 0)
							{
								case TRUE:	$b = $q2->result();
											$q2 = NULL; // free-up memory
											$j = 0;
											for(; $j <$bCount; $j++ )
											{
												$multiplier = ( $j === 0 )? 10: 1;
												
												if( isset( $m[ $b[ $j ]->userID ] ) && $b[ $j ]->userID > 0 )
												{
													$m[ $b[ $j ]->userID ] += $multiplier;
												}
												else
												{
													$m[ $b[ $j ]->userID ] = $multiplier;
												}
											}
									break;
								case FALSE:	$noFancyA[] = $a[ $i ]->productID;
									break;
							}
						}

						$mCount = count( $m );
						switch( $mCount > 0 )
						{
							case TRUE:	$users = array_keys( $m ); // store all the userIDs in the userIDs array
										$usersCount = count( $users ); // store the number of users. should be equal to $mCount. So, this step is an overhead
										$q3SQL = "UPDATE ".$dbName."`user_details` SET `multiplier` = ( CASE `user_id`";
										for( $i = 0; $i < $usersCount; $i++ )
										{
											$q3SQL .= " WHEN ".$users[ $i ]." THEN ".$m[ $users[ $i ] ];
										}
										$q3SQL .= " ELSE NULL END) WHERE user_id IN(".implode( ",", $users ).")";

										echo "\r\n Will now run the following query___\r\n".$q3SQL;
										echo "\r\n Sleeping for 6 seconds";
										for($i = 0; $i < 6; $i++)
										{
											sleep(1);
											echo ".";
										}
										echo "\r\n Running query at: ".date('Y-m-d H:i:s');
										$this->db->query( $q3SQL );
										echo "\r\n Query Finished at: ".date('Y-m-d H:i:s');
								break;
							case FALSE:	echo "\r\n User multiplier data was not found in M. Please check the script!";
								break;
						}
				break;
			
			case FALSE:	echo "Unable to find any products.";
				break;
		}
		echo "\r\n No user has fancied the products:\r\n".implode( ",", $noFancyA );
		echo "\r\n";
	}

	public function updateFollowFriends( $live = 0 )
	{
		echo "\r\n";
		$db = ($live == 0? 'TEST_DB': 'LIVE_DB');
		log_message('DEBUG', "inside dbupdate/updateFollowFriends/".$db );
		$dbName = "bnbdbTest";
		switch( $live )
		{
			case 0:	$dbName = "`bnbdbTest`.";
				break;
			case 1:	$dbName = "`bnbdb`.";
				break;
		}

		echo "\r\nDBNAME = ".$dbName."\r\n";
		$q1SQL = "UPDATE ".$dbName."`user_details` AS `ud` SET `ud`.`totalFollowers` = (SELECT COUNT(`ff`.`f_no`) FROM ".$dbName."follow_friends AS `ff` WHERE `ff`.`followee_id` = `ud`.`user_id`),";
		$q1SQL .= " `ud`.`totalFollowing` = (SELECT COUNT(`ff`.`f_no`) FROM ".$dbName."follow_friends WHERE `ff`.`follower_id` = `ud`.`user_id`)";

		$q1 = $this->db->query( $q1SQL );

		$aRows = $this->db->affected_rows();

		echo "Updated ".$db." followers and following counts in user_details table. Affected rows: ".$aRows."\r\n\r\n";
		log_message('INFO', "Updated ".$db." followers and following counts in user_details table. Affected rows: ".$aRows );
	}
}
?>