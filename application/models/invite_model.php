<?php if( !defined('BASEPATH') ) exit('403 Unauthorized');
class Invite_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function saveInvite($inviter = NULL, $inviteeRefID = NULL, $invitationMedium = NULL)
	{
		log_message('INFO', "invite_model/saveInvite fired with \$inviter = ".print_r($inviter, TRUE).", \$inviteeRefID = ".print_r($inviteeRefID, TRUE).", \$invitationMedium = ".print_r($invitationMedium, TRUE));
		$hash = NULL;
		$savedInvite = FALSE;
		$inviteID = NULL;
		$userExists = NULL;
		if(is_null($inviter) || is_null($inviteeRefID) || is_null($invitationMedium) )
		{
			return array("savedInvite" => $savedInvite, "inviteID" => $inviteID, "hash" => $hash, "userExists" => $userExists);
		}
		$updateFlag = FALSE;
		$inviteID = NULL;
		$savedInvite = FALSE;
		/* code to check if the invteeRefID already exists on BuynBrag */
		$this->db->select('user_id');
		$this->db->from('user_details');
		switch($invitationMedium)
		{
			case 1: $this->db->where("fb_uid", $inviteeRefID); // existing user from facebook
				break;
			case 2: $this->db->where("tw_uid", $inviteeRefID); // existing user from twitter
				break;
			case 3: $this->db->where("email", $inviteeRefID); // existing user from email
				break;
		}
		$existingUserCheck = $this->db->get();
		switch($existingUserCheck->num_rows() > 0)
		{
			case TRUE: $existingUser = $existingUserCheck->result();
					$userExists = $existingUser[0]->user_id;
					return array("savedInvite" => $savedInvite, "inviteID" => $inviteID, "hash" => $hash, "userExists" => $userExists);
				break;
		}
		
		/* code to check if an invite with invite with the same parameters as the current already exists */
		$this->db->select("invite_id");
		$this->db->select("invitationStatus");
		$this->db->from("bnbinvites");
		$this->db->where("inviter", $inviter);
		$this->db->where("invitationMedium", $invitationMedium);
		$this->db->where("inviteeRefID", $inviteeRefID);
		$checkQuery = $this->db->get();
		switch($checkQuery->num_rows() > 0)
		{
			case TRUE: $checkQueryResult = $checkQuery->result();
					 $inviteID = $checkQueryResult[0]->invite_id;
					 $updateFlag = TRUE;
				break;
		}
		
		$validFrom = time(); /* valid from the date and time when the invite is saved */
		$validUpto = $validFrom + 2592000; /* valid upto 30 days after the time the validity started */
		$this->db->set('inviter', $inviter, FALSE);
		$this->db->set('inviteeRefID', $inviteeRefID);
		/* 1 = facebook, 2 = twitter, 3 = email(default), referral link(email), 5 = yahoo, 6 = gmail */
		$this->db->set('invitationMedium', $invitationMedium);
		/*
		0 = not joined (default), 1 = joined(invitee column will contain their BNB userID), 2 = joined via other user, 3 = re-invited once,
		4 = re-invited twice, 5 = re-invited thrice, and so on...
		*/
		$this->db->set('invitationStatus', 0);
		$this->db->set('joinedDate', 0);
		$this->db->set('sentDate', $validFrom);
		$this->db->set('validUpto', $validUpto);
		switch($updateFlag)
		{
			case TRUE: $this->db->where("invite_id", $inviteID);
					$savedInvite = $this->db->update('bnbinvites');
					log_message("INFO", "UPDATING DB where INVITE_ID = ".$inviteID);
				break;
			case FALSE: $savedInvite = $this->db->insert('bnbinvites');
					  $inviteID = $this->db->insert_id();
					  log_message("INFO", "INSERTING INTO DB. GOT INVITE_ID = ".$inviteID);
				break;
		}
		
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY______________________________________\r\n".$this->db->last_query());
		
		log_message('INFO', "Invite ID  = ".$inviteID);
		
		$this->db->select('invite_id');
		$this->db->select('inviter');
		$this->db->select('invitee');
		$this->db->select('invitationMedium');
		$this->db->select('inviteeRefID');
		$this->db->select('invitationStatus');
		$this->db->select('sentDate');
		$this->db->select('joinedDate');
		$this->db->select('validUpto');
		
		$this->db->from('bnbinvites');
		
		$this->db->where('invite_id', $inviteID);
		
		$query = $this->db->get();
		log_message('INFO', "JUST RAN THE FOLLOWING QUERY______________________________________\r\n".$this->db->last_query());
		
		switch($query->num_rows() > 0)
		{
			case TRUE: $hashData = $query->result();
					 $hashData = $hashData[0];
					 log_message('INFO', "HASHDATA = ".print_r($hashData, TRUE));
					 $hash = sha1( md5( $hashData->invite_id.$hashData->inviter.$hashData->invitee.$hashData->invitationMedium.$hashData->inviteeRefID.$hashData->invitationStatus.$hashData->sentDate.$hashData->joinedDate.$hashData->validUpto ) );
					 log_message('INFO', "HASH = ".$hash);
					 return array("savedInvite" => $savedInvite, "inviteID" => $inviteID, "hash" => $hash, "userExists" => $userExists);
				break;
			case FALSE: return array("savedInvite" => $savedInvite, "inviteID" => $inviteID, "hash" => $hash, "userExists" => $userExists);
				break;
		}
	}
	
	public function inviteData($inviteID)
	{
		$this->db->select('invite_id');
		$this->db->select('inviter');
		$this->db->select('invitee');
		$this->db->select('invitationMedium');
		$this->db->select('inviteeRefID');
		$this->db->select('invitationStatus');
		$this->db->select('sentDate');
		$this->db->select('joinedDate');
		$this->db->select('validUpto');
		
		$this->db->from('bnbinvites');
		
		$this->db->where('invite_id', $inviteID);
		
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}
	
	public function listInvites($userID)
	{
		$this->db->select('invite_id');
		$this->db->select('invitee');
		$this->db->select('invitationMedium');
		$this->db->select('inviteeRefID');
		$this->db->select('invitationStatus');
		$this->db->select('sentDate');
		$this->db->select('joinedDate');
		$this->db->select('validUpto');
		$this->db->from('bnbinvites');
		$this->db->where('inviter', $userID);
		$query = $this->db->get();
		switch($query->num_rows() > 0)
		{
			case TRUE: return $query->result();
				break;
			case FALSE: return NULL;
				break;
		}
	}
	
	public function checkInvite($inviteID, $userHash)
	{
		$this->db->select('invite_id');
		$this->db->select('inviter');
		$this->db->select('invitee');
		$this->db->select('invitationMedium');
		$this->db->select('inviteeRefID');
		$this->db->select('invitationStatus');
		$this->db->select('sentDate');
		$this->db->select('joinedDate');
		$this->db->select('validUpto');
		$this->db->from("bnbinvites");
		$this->db->where("invite_id = ".$inviteID." AND validUpto <= ".time()." AND invitationStatus = 0");
		
		$readInviteQuery = $this->db->get();
		
		switch($readInviteQuery->num_rows() > 0)
		{
			case TRUE: $hashData = $readInviteQuery->result();
					$hashData = $hashData[0];
					$checkHash = sha1( md5( $hashData->invite_id.$hashData->inviter.$hashData->invitee.$hashData->invitationMedium.$hashData->inviteeRefID.$hashData->invitationStatus.$hashData->sentDate.$hashData->joinedDate.$hashData->validUpto ) );
					if( strcmp($userHash, $checkHash) === 0 )
					{
						return TRUE; // valid invite
					}
					else
					{
						return FALSE; // invalid invite. Hash failed consistency check
					}
				break;
			case FALSE: return NULL; // no data returned from the database
				break;
		}
	}
	
	public function creditInviter($inviteID, $hash)
	{
		$checkInvite = $this->checkInvite($inviteID, $hash);
		if($checkInvite === TRUE)
		{
			$this->db->select('inviter');
			$this->db->from('bnbinvites');
			$this->db->where('invite_id', $inviteID);
			
			$inviterQuery = $this->db->get();
			
			switch($inviterQuery->num_rows() > 0)
			{
				case TRUE: $inviter = $inviterQuery->result();
						 $inviter = $inviter[0];
						 $bbucksQuery = "UPDATE `user_details` SET `bbucks` = `bbucks` + 1000 WHERE `user_id` = ".$this->db->escape($inviter->inviter);
						 return $this->db->query($bbucksQuery);
					break;
				case FALSE: return NULL;
					break;
			}
		}
	}
	
	public function acceptInvite($inviteID, $hash, $invitee)
	{
		if($this->checkInvite($inviteID, $hash) === TRUE) // check if the invite is valid
		{
			$this->db->select('inviter'); // read the inviter, invitationMedium, inviteeRefID
			$this->db->select('invitationMedium');
			$this->db->select('inviteeRefID');
			$this->db->from('bnbinvites');
			$this->db->where('invite_id', $inviteID);
			
			$inviterQuery = $this->db->get();
			
			switch($inviterQuery->num_rows() > 0)
			{
				case TRUE: $inviter = $inviterQuery->result();
						 $inviter = $inviter[0];
						 // update the bnbinvites table
						 $this->db->set('invitee', $invitee); // set the invitee to to the bnb user_id of the joined user
						 $this->db->set('invitationStatus', 1); // set the invitationStatus to joined,
						 $this->db->set('joinedDate', time()); // joinedData to the current timestamp
						 $this->db->where('invite_id', $inviteID); 
						 $this->db->update('bnbinvites');
						 
						 $this->db->set('invitationStatus', 2); // invitationStatus = 2 (joined via other user)
						 $this->db->where("invitationMedium = ".$inviter->invitationMedium." AND inviteeRefID = ".$inviter->inviteeRefID." AND invite_id <> ".$inviteID);
						 $this->db->update("bnbinvites"); //  where the invitationMedium and inviteeRefID are the same as the current but the invitation ID is different
						 return $this->creditInviter($inviteID, $hash); //  credit the inviter
						 // send mail to inviter that the invitee has joined and that
						 // their account has been credited with 1000 brag bucks.
						 // Use ther follower-following email template for that.
						 // ON BuynBrag, Make the invitee a friend of the inviter
					break;
				case FALSE: return NULL;
					break;
			}
		}
		else
		{
			return FALSE;
		}
		
	}
	
	public function userExists($userID)
	{
		$this->db->select('user_id');
		$this->db->from('user_details');
		$this->db->where('user_id', $userID);
		$query = $this->db->get();
		return ($query->num_rows() > 0);
	}
	
	public function creditUser($userID, $bbucks)
	{
		return $this->db->query("UPDATE `user_details` SET `bbucks` = `bbucks` + ".$bbucks." WHERE `user_id` = ".$userID);
	}
	
	public function acceptReferral($referrerID, $referralID)
	{
		if($this->userExists($referrerID) === TRUE) // check if the user exists
		{
			// search the database for the referralID
			$this->db->select('COUNT(*) AS regCount');
			$this->db->from('referrals');
			$this->db->where('referral', $referralID);
			$sQuery = $this->db->get();
			$insertQ = FALSE;
			switch($sQuery->num_rows() > 0) // if a referral does not exist
			{
				case FALSE:$this->db->set('referrer', $referrerID); // create one in the db
						$this->db->set('referral', $referralID);
						$insertQ = $this->db->insert('referrals');
						if($insertQ)
						{
							return $this->creditUser($userID, 1000); // if the referral creation was successful, give the referrer 1000 brag bucks
						}
					break;
				case TRUE: return 0;
					break;
			}
		}
		else
		{
			return 1;
		}
	}
	
	public function createAccount($accountData)
	{
		$retResult = array();
		$retResult['emailOK'] = FALSE;
		$retResult['fnameOK'] = FALSE;
		$retResult['lnameOK'] = FALSE;
		$retResult['pw1OK'] = FALSE;
		$retResult['pw2OK'] = FALSE;
		$retResult['pwOK'] = FALSE;
		$retResult['genderOK'] = FALSE;
		$retResult['cityOK'] = FALSE;
		$retResult['userExists'] = FALSE;
		$retResult['accountCreated'] = FALSE;
		$retResult['newUID'] = NULL;
		
		if($accountData['email'] !== NULL)
		{
			$retResult['emailOK'] = TRUE;
		}
		
		if($accountData['fname'] !== NULL)
		{
			$retResult['fnameOK'] = TRUE;
		}
		
		if($accountData['lname'] !== NULL)
		{
			$retResult['lnameOK'] = TRUE;
		}
		
		if($accountData['pw1'] !== NULL)
		{
			$retResult['pw1OK'] = TRUE;
		}
		
		if($accountData['pw2'] !== NULL)
		{
			$retResult['pw2OK'] = TRUE;
		}
		
		if(strcmp($accountData['pw1'], $accountData['pw2']) === 0)
		{
			$retResult['pwOK'] = TRUE;
		}
		
		if($accountData['gender'] !== NULL)
		{
			$retResult['genderOK'] = TRUE;
		}
		
		if($accountData['city'] !== NULL)
		{
			$retResult['cityOK'] = TRUE;
		}
		
		// check if the a user already exists
		$this->db->select('user_id');
		$this->db->from('user_details');
		$this->db->where('email', $accountData['email']);
		$chkQ = $this->db->get();
		switch($chkQ->num_rows() > 0)
		{
			case FALSE:if($retResult['emailOK'] === TRUE && $retResult['fnameOK'] = TRUE && $retResult['lnameOK'] = TRUE && $retResult['pw1OK'] = TRUE && $retResult['pw2OK'] = TRUE && $retResult['pwOK'] = TRUE && $retResult['genderOK'] = TRUE && $retResult['cityOK'] = TRUE && $retResult['userExists'] === FALSE)
					{
						$this->db->set('email', $accountData['email']);
						$this->db->set('full_name', $accountData['fname']." ".$accountData['lname']);
						$this->db->set('password', md5($accountData['pw1']));
						$this->db->set('gender', $accountData['gender']);
						$this->db->set('fb_uid', 'non-fb-member');
						$this->db->set('city', $accountData['city']);
						$retResult['accountCreated'] = $$this->db->insert('user_details');
						$retResult['newUID'] = $this->db->last_insert_id();
					}
				break;
			case TRUE: $retResult["userExists"] = TRUE;
				break;
		}
		return $retResult;
	}
}
?>