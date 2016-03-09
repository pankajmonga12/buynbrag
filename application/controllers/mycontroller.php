<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mycontroller extends Controller
{


	function __construct()
	{


	}


	function myuploader()
	{

		$this->load->library('qquploadedfilexhr');

		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array('png', 'jpeg', 'jpg', 'gif', 'bmp');
		// max file size in bytes
		$sizeLimit = 1 * 1024 * 1024;

		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload('/path/to/your/upload/folder/');
		// to pass data through iframe you will need to encode all html tags
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);


	}


}