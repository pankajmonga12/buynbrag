<?php if( ! defined ('BASEPATH') ) exit('403 UNauthorized');

class Automate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('automate_model');
		$this->load->model('slog');
		/*error_reporting(0);
		error_reporting(E_ALL);
		ini_set('display_errors', 1);*/

		//error_reporting(0);
	}

	public function index()
	{
		/*
		Algorithm for the cron job
		- read a job from the DB
		- mark the job as started
		- decide what kind of job it is and then execute it
		- mark the job a finished and set its status according to the result and also pass any extra information if necessary
		*/
		$this->slog->write('started execution of automate/index');

		//$job = $this->automate_model->getNextJob();
		
		//$this->slog->write("<p> next job details </p><pre>".print_r($job, TRUE)."</pre>");
		
		/* log_message('INFO', "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>"); */
		
		//$this->slog->write("<p>job id = ".$job['_id']."</p>");
		
		/* log_message('INFO', "<p>job id = ".$job['_id']."</p>"); */
		
		//$this->slog->write('test automation 1');
		
		/* log_message('INFO', 'test automation 1'); */
		
		/*
		switch($job === NULL)
		{
			case TRUE:	$this->slog->write("No jobs to do in the automation table");
				break;
			case FALSE:	$this->slog->write('Found a job to automate with id: '.$job['_id']->id);
				break;
		}
		*/
		$this->slog->write('Ending execution of automate/index');		
	}

	public function email($jobID = NULL)
	{
		$this->slog->write( array('level' => 1, 'msg' => 'started email automation script') );
		log_message('INFO', 'started email automation script');
		if( $this->automate_model->execStatus(1) === FALSE)
		{
			$this->automate_model->execStart(1); // mark execution start to avoid process collision

			/* code to send email */

			$jobs = $this->automate_model->getEmailJobs();

			$jobIDs = NULL;

			if(is_array($jobs))
			{
				foreach($jobs as $job)
				{
					$jobIDs[] = $job["_id"]; // get all the jobIDs
				}
				$this->slog->write( array( 'level' => 1, 'msg' => 'email jobs read: '.json_encode( $jobIDs ) ) );

				$this->automate_model->startJobs($jobIDs); // mark all the jobs as started

				foreach($jobs as $job)
				{
					$this->slog->write( "<p> job details </p><pre>".print_r($job, TRUE)."</pre>" );

					log_message( 'INFO', "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>" );
					/* echo "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>"; */
					$to = NULL;
					$cc = NULL;
					$bcc = NULL;
					$subject = NULL;
					$msg = NULL;
					$minRecipients = FALSE;

					if( array_key_exists('to', $job) )
					{
						$to = $job['to'];
						$minRecipients = TRUE;
					}

					if( array_key_exists('cc', $job) )
					{
						$cc = $job['cc'];
						$minRecipients = TRUE;
					}

					if( array_key_exists('bcc', $job) )
					{
						$bcc = $job['bcc'];
						$minRecipients = TRUE;
					}

					if( array_key_exists('subject', $job) )
					{
						$subject = $job['subject'];
					}

					if( array_key_exists('msg', $job) )
					{
						$msg = $job['msg'];
					}

					if($minRecipients === TRUE && strlen($msg) > 0)
					{
						$this->slog->write( array("level" => 1, "msg" => "automation server job log", "jobDetails" => $job) );
						$this->load->library('email');
						$this->email->clear(TRUE); // clear all emails
						$this->email->from('support@buynbrag.com', 'BuynBrag');
						if( array_key_exists('to', $job) )
						{
							$this->email->to($to);
						}

						if( array_key_exists('cc', $job) )
						{
							$this->email->cc($cc);
						}

						if( array_key_exists('bcc', $job) )
						{
							$this->email->bcc($bcc);
						}

						if( array_key_exists('subject', $job) )
						{
							$this->email->subject($subject);
						}

						if( array_key_exists('msg', $job) )
						{
							$this->email->message($msg);
						}

						$this->email->set_newline("\r\n");
						if($this->email->send())
						{
						   $this->slog->write(array('level' => 'INFO', 'msg' => " Successfully SENT following MAIl FOR JOB ID : ".$job['_id']) );
						   log_message('INFO', " Successfully SENT following MAIl FOR JOB ID : ".$job['_id']);
						   $this->automate_model->finishJob($job['_id'], TRUE);
						}
						else
						{
						   $this->slog->write(array('level' => 'INFO', 'msg' => " Error sending following MAIl FOR JOB ID : ".$job['_id'], 'debug' => $this->email->print_debugger()) );
						   log_message('INFO', " Error sending following MAIl FOR JOB ID : ".$job['_id']);
						   $this->automate_model->finishJob($job['_id'], FALSE);
						}
						$this->email->clear(TRUE); // clear all emails
					}
					
					/* log_message('INFO', "<p>job id = ".$job['_id']."</p>"); */
					/* echo "<p>job = ".$job['_id']."</p>"; */
					
					/* log_message('INFO', 'test automation 1::: send email'); */
					/* echo 'test automation 1::: send email'; */
				}
			}

			$this->automate_model->execStop(1); // mark process end to allow processes to execute
		}
		else
		{
			/* log_message('INFO', 'avoiding process collision. exiting now. bye bye'); */

			$this->slog->write( array('level' => 1, 'msg' => 'avoiding process collision. exiting now. bye bye') );
		}
	}

	public function checkOrderStatusEmail($jobID = NULL)
	{
		$this->email->clear(TRUE); // clear all email variables

		$this->slog->write( array( 'level' => 1, 'msg' => 'started check order status email automation script' ) );

		log_message( 'INFO', 'started email automation script' );
		
		if( $this->automate_model->execStatus(4) === FALSE)
		{
			$this->automate_model->execStart(4); // mark execution start to avoid process collision

			/* code to send email */

			$jobs = $this->automate_model->getCheckAndEmailJobs();

			$jobIDs = NULL;
			foreach($jobs as $job)
			{
				$jobIDs[] = $job["_id"]; // get all the jobIDs
			}

			$this->automate_model->startJobs( $jobIDs ); // mark all the jobs as started

			foreach($jobs as $job)
			{
				$this->slog->write( "<p> job details </p><pre>".print_r($job, TRUE)."</pre>" );

				log_message( 'INFO', "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>" );
				/* echo "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>"; */

				$orderID = NULL;
				$to = NULL;
				$cc = NULL;
				$bcc = NULL;
				$subject = NULL;
				$msg = NULL;
				$minRecipients = FALSE;

				if( array_key_exists('orderID', $job) ===  FALSE )
				{
					$orderID = FALSE;
				}
				else
				{
					$orderID = $job['orderID'];
				}

				if( array_key_exists('to', $job) )
				{
					$to = $job['to'];
					$minRecipients = TRUE;
				}

				if( array_key_exists('cc', $job) )
				{
					$cc = $job['cc'];
					$minRecipients = TRUE;
				}

				if( array_key_exists('bcc', $job) )
				{
					$bcc = $job['bcc'];
					$minRecipients = TRUE;
				}

				if( array_key_exists('subject', $job) )
				{
					$subject = $job['subject'];
					if( $orderID === FALSE )
					{
						$tOID = explode(' ', $subject);
						$orderID = $tOID[ ( count($tOID) - 1) ];
						if( !is_numeric($orderID) )
						{
							$orderID = FALSE;
						}
					}
				}

				if( array_key_exists('msg', $job) )
				{
					$msg = $job['msg'];
				}

				if( $orderID === FALSE )
				{
					$this->slog->write( array( 'level' => 1, 'msg' => 'unable to find orderID in the data provided for job id: '.$job['_id'].'. Exiting automate/checkOrderStatusEmail') );
					$this->automate_model->finishJob($job['_id'], FALSE); // mark the job as finished
					continue; // continue to the next iteration
				}

				if($minRecipients === TRUE && strlen($msg) > 0)
				{
					$this->slog->write( array("level" => 1, "msg" => "automation server job log", "jobDetails" => $job) );
					$this->load->library('email');
					$this->email->from('support@buynbrag.com', 'BuynBrag');
					if( array_key_exists('to', $job) )
					{
						$this->email->to($to);
					}

					if( array_key_exists('cc', $job) )
					{
						$this->email->cc($cc);
					}

					if( array_key_exists('bcc', $job) )
					{
						$this->email->bcc($bcc);
					}

					if( array_key_exists('subject', $job) )
					{
						$this->email->subject($subject);
					}

					if( array_key_exists('msg', $job) )
					{
						$this->email->message($msg);
					}

					$this->email->set_newline("\r\n");
					if($this->email->send())
					{
					   $this->slog->write(array('level' => 'INFO', 'msg' => " Successfully SENT following MAIl FOR JOB ID : ".$job['_id']) );
					   log_message('INFO', " Successfully SENT following MAIl FOR JOB ID : ".$job['_id']);
					   $this->automate_model->finishJob($job['_id'], TRUE);
					}
					else
					{
					   $this->slog->write(array('level' => 'INFO', 'msg' => " Error sending following MAIl FOR JOB ID : ".$job['_id']) );
					   log_message('INFO', " Error sending following MAIl FOR JOB ID : ".$job['_id']);
					   $this->automate_model->finishJob($job['_id'], FALSE);
					}
				}
				
				/* log_message('INFO', "<p>job id = ".$job['_id']."</p>"); */
				/* echo "<p>job = ".$job['_id']."</p>"; */
				
				/* log_message('INFO', 'test automation 1::: send email'); */
				/* echo 'test automation 1::: send email'; */
				$this->email->clear(TRUE); // clear all emails
			}

			$this->automate_model->execStop(4); // mark process end to allow processes to execute
		}
		else
		{
			/* log_message('INFO', 'avoiding process collision. exiting now. bye bye'); */

			$this->slog->write( array('level' => 1, 'msg' => 'avoiding process collision. exiting now. bye bye') );
		}
	}

	public function fancyProductEmailComputer()
	{
		$this->slog->write( array( 'level' => 1, 'msg' => 'started fancy product email computer automation script' ) );
		log_message( 'INFO', 'started fancy product email computer automation script' );
		
		if( $this->automate_model->execStatus(5) === FALSE)
		{
			$this->automate_model->execStart(5); // mark execution start to avoid process collision

			$jobs = $this->automate_model->getFancyProductComputerJobs();

			$jobIDs = NULL;
			foreach($jobs as $job)
			{
				$jobIDs[] = $job["_id"]; // get all the jobIDs
			}

			log_message('INFO', "All jobIDs selected ::: ".print_r($jobIDs, TRUE));

			$this->automate_model->startJobs( $jobIDs ); // mark all the jobs as started

			foreach($jobs as $job)
			{
				$this->slog->write( "<p> job details </p><pre>".print_r($job, TRUE)."</pre>" );
				log_message( 'INFO', "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>" );
				/* echo "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>"; */


				if( array_key_exists('productID', $job) && array_key_exists('userID', $job) && array_key_exists('fancyTimeStamp', $job) ) // proceed only if the timestamp , userID and productID were stored
				{
					$fanciedBy = $this->automate_model->readFancyUserDetails($job['userID'], $job['productID']);
					if( !is_null($fanciedBy) )
					{
						$tData['fanciedByProfileImageSrc'] = "http://buynbrag.com/assets/images/default/male.png";

						if( strcmp($fanciedBy->userGender, 'female') === 0)
						{
							$tData['fanciedByProfileImageSrc'] = "https://buynbrag.com/assets/images/default/female.png";
						}

						if( strcmp($fanciedBy->userFBID, 'non-fb-member') !== 0)
						{
							$tData['fanciedByProfileImageSrc'] = "https://graph.facebook.com/".$fanciedBy->userFBID."/picture?width=75&height=75";
						}

						$tData['fanciedByFullName'] = $fanciedBy->userFullName;
						$tData['fanciedByStoreID'] = $fanciedBy->storeID;
						$tData['totalProductFancyCount'] = $fanciedBy->totalFanciedProducts;
						$tData['totalFanciedBy'] = $fanciedBy->totalFanciedUsers;
						$tData['fanciedProductImageSrc'] = 'http://buynbragstores.s3.amazonaws.com/assets/images/stores/'.$fanciedBy->storeID.'/'.$job['productID'].'/img1_171x171.jpg';
						$tData['fanciedProductName'] = $fanciedBy->productName;
						$tData['fanciedByUserID'] = $job['userID'];
						$tData['memberSince'] = $fanciedBy->memberSince;
						$tData['fanciedByUserRank'] = $fanciedBy->userRank;
						$tData['productPageLink'] = "http://buynbrag.com/#!/product//".$job['productID']."?utm_source=someOneFanciedWhatYouFancied&utm_medium=email&utm_jid=".$job['_id'];

						$users = $this->automate_model->readFancyProductUsers($job['productID'], $job['userID'], $job['fancyTimeStamp']);
						log_message('INFO', "Users returned from automate_model are: ".print_r($users, TRUE));
						foreach($users as $user)
						{
							log_message('INFO', 'Entering user loop!!! User = '.print_r($user, TRUE) );
							$tData['userFullName'] = $user->userFullName;
							
							log_message('INFO', "Computed tData = ".print_r($tData, TRUE));

							$someOneFanciedWhatYouFancied = $this->load->view('emailers/someOneFanciedWhatYouFancied', $tData, TRUE);

							$jobType = 1; // create job(s) based on the fancied product to send mail to everyone who have fancied the product intimating about the latest user who has fancied it
							$jobCommand = "/usr/bin/php5 ".__DIR__."/../../index.php automate email";
							/* $jobScheduledTime = mktime(20, 37, 00, 10, 21, 2013); // 4:35:00 pm 12th October 2013 */
							$jobScheduledTime = (time() + 66); // current time + 1 day (24 hrs 1 minute)
							$jobDetails = array
											(
												'to' => $user->emailAddress,
												/*'bcc' => 'manish@buynbrag.com,prt@buynbrag.com,bimal@gmail.com,sam@buynbrag.com',*/
												'subject' => "Someone fancied what you have already fancied at BuynBrag",
												'msg' => $someOneFanciedWhatYouFancied
											);
							$this->automate_model->createJob($jobType, $jobCommand, $jobScheduledTime, $jobDetails);
							$this->slog->write( array('level' => 1, 'msg' => "<p>A job(s) based on the fancied product to send mail to everyone who have fancied the product intimating about the latest user who has fancied it has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A T (P)', $jobScheduledTime)." </p>" ) );
							log_message('INFO', "<p>A job(s) based on the fancied product to send mail to everyone who have fancied the product intimating about the latest user who has fancied it has been created and will be executed on or after ".date('l, F jS, Y', $jobScheduledTime)." at ".date('g:i:s A T (P)', $jobScheduledTime)." </p>");
						}
					}
					log_message('INFO', "finishing job with ID: ".$job['_id']);
					$this->automate_model->finishJob($job['_id'], TRUE);
				}
				else
				{
					$this->slog->write( array('level' => 1, 'msg' => 'invalid fancy data. Unable to compute!') );
					log_message('INFO', 'invalid fancy data. Unable to compute!');
					$this->automate_model->finishJob( $job['_id'], FALSE, array( 'errorMsg' => "Invalid fancy data. Unable to compute! Fancy data provided: productID: ".json_encode( $job['productID'] ).", userID: ".json_encode( $job['userID'] ).", fancyTimeStamp: ".json_encode( $job['fancyTimeStamp'] ) ) );
				}
			}

			log_message('INFO', "marking process as stopped to let other process execute");

			$this->automate_model->execStop(5); // mark process end to allow processes to execute
		}
		else
		{
			/* log_message('INFO', 'avoiding process collision. exiting now. bye bye'); */

			$this->slog->write( array('level' => 1, 'msg' => 'avoiding process collision. exiting now. bye bye') );
			log_message('INFO', 'avoiding process collision. exiting now. bye bye');
		}
	}

	public function checkCouponDay12()
	{
		$this->slog->write( array('level' => 1, 'msg' => 'started email automation script') );
		log_message('INFO', 'started email automation script');
		if( $this->automate_model->execStatus(6, "12th Day Copon Mail Automator Status") === FALSE)
		{
			$this->automate_model->execStart(6); // mark execution start to avoid process collision

			/* code to send email */

			$jobs = $this->automate_model->getEmailJobs();

			$jobIDs = NULL;

			if(is_array($jobs))
			{
				foreach($jobs as $job)
				{
					$jobIDs[] = $job["_id"]; // get all the jobIDs
				}
				$this->slog->write( array( 'level' => 1, 'msg' => 'email jobs read: '.json_encode( $jobIDs ) ) );

				$this->automate_model->startJobs($jobIDs); // mark all the jobs as started

				foreach($jobs as $job)
				{
					$this->slog->write( "<p> job details </p><pre>".print_r($job, TRUE)."</pre>" );

					log_message( 'INFO', "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>" );
					/* echo "<p> next job details </p><pre>".print_r($job, TRUE)."</pre>"; */
					$to = NULL;
					$cc = NULL;
					$bcc = NULL;
					$subject = NULL;
					$msg = NULL;
					$minRecipients = FALSE;

					if( array_key_exists('to', $job) )
					{
						$to = $job['to'];
						$minRecipients = TRUE;
					}

					if( array_key_exists('cc', $job) )
					{
						$cc = $job['cc'];
						$minRecipients = TRUE;
					}

					if( array_key_exists('bcc', $job) )
					{
						$bcc = $job['bcc'];
						$minRecipients = TRUE;
					}

					if( array_key_exists('subject', $job) )
					{
						$subject = $job['subject'];
					}

					if( array_key_exists('msg', $job) )
					{
						$msg = $job['msg'];
					}

					if($minRecipients === TRUE && strlen($msg) > 0)
					{
						$this->slog->write( array("level" => 1, "msg" => "automation server job log", "jobDetails" => $job) );
						$this->load->library('email');
						$this->email->clear(TRUE); // clear all emails
						$this->email->from('support@buynbrag.com', 'BuynBrag');
						if( array_key_exists('to', $job) )
						{
							$this->email->to($to);
						}

						if( array_key_exists('cc', $job) )
						{
							$this->email->cc($cc);
						}

						if( array_key_exists('bcc', $job) )
						{
							$this->email->bcc($bcc);
						}

						if( array_key_exists('subject', $job) )
						{
							$this->email->subject($subject);
						}

						if( array_key_exists('msg', $job) )
						{
							$this->email->message($msg);
						}

						$this->email->set_newline("\r\n");
						if($this->email->send())
						{
						   $this->slog->write(array('level' => 'INFO', 'msg' => " Successfully SENT following MAIl FOR JOB ID : ".$job['_id']) );
						   log_message('INFO', " Successfully SENT following MAIl FOR JOB ID : ".$job['_id']);
						   $this->automate_model->finishJob($job['_id'], TRUE);
						}
						else
						{
						   $this->slog->write(array('level' => 'INFO', 'msg' => " Error sending following MAIl FOR JOB ID : ".$job['_id'], 'debug' => $this->email->print_debugger()) );
						   log_message('INFO', " Error sending following MAIl FOR JOB ID : ".$job['_id']);
						   $this->automate_model->finishJob($job['_id'], FALSE);
						}
						$this->email->clear(TRUE); // clear all emails
					}
					
					/* log_message('INFO', "<p>job id = ".$job['_id']."</p>"); */
					/* echo "<p>job = ".$job['_id']."</p>"; */
					
					/* log_message('INFO', 'test automation 1::: send email'); */
					/* echo 'test automation 1::: send email'; */
				}
			}

			$this->automate_model->execStop(1); // mark process end to allow processes to execute
		}
	}
}
?>