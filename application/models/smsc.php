<?php if( ! defined('BASEPATH') ) exit('403 Unauthorized');
class Smsc extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('slog');
	}

	public function sendSMS($mobiles = NULL, $message = NULL)
	{
		//Please Enter Your Details
		$user = "buynbrag"; //your username
		$password = "aaindus99"; //your password
		$mobilenumbers = "919899670183,9999178822,9811618547,9990119948,9953200049"; //enter Mobile numbers comma seperated
		if( ! is_null($mobiles) )
		{
			$mobilenumbers = $mobiles;
		}

		if( is_null($message) )
		{
			$message = "This is just a test message to test SMSCountry functionality.\r\nBuynBrag"; //enter Your Message 
		}
		$senderid = "BuynBrag"; //Your senderid
		$messagetype = "N"; //Type Of Your Message
		$DReports = "Y"; //Delivery Reports
		$url = "http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
		$message = urlencode($message);
		$ch = curl_init(); 
		
		if (!$ch)
		{
			$this->slog->write( array( 'level' => 1, 'msg' => "Couldn't initialize a cURL handle" ) );
			return FALSE;
		}

		$ret = curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
		// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");

		$curlresponse = curl_exec($ch); // execute
		
		if(curl_errno($ch))
		{
			$this->slog->write( array( 'level' => 1, 'msg' => 'curl error : '. curl_error($ch) ) );
		}

		if ( empty($ret) )
		{
			// some kind of an error happened
		    $this->slog->write( array( 'level' => 1, 'msg' => curl_error($ch) ) );
		    curl_close($ch); // close cURL handler
		}
		else
		{
			$info = curl_getinfo($ch);
		    curl_close($ch); // close cURL handler
		    //echo "<br>";
		    $this->slog->write( array( 'level' => 1, 'msg' => $curlresponse ) );
		}
	}
}
?>