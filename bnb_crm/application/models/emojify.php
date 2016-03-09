<?php if( ! defined( 'BASEPATH' ) ) exit('403 Unauthorized');
/*
 * PHP function to change UTF8 strings into emojified strings.
 * 
 * -------------------------------------------------------------
 * File:     emojify.php
 * Name:     emojify
 * Purpose:  Turns a UTF8 string into emoji images
 * -------------------------------------------------------------
 */
class Emojify extends CI_Model
{
	public $callBack = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		log_message('INFO', "Emojify Model INIT" );
		$this->callBack = $this->_utf8_to_emojiimages;
	}
	function emojiimages($data)
	{
		log_message('INFO', "Emojify/_utf8_to_emojiimages called" );
	    $ret = 0;
	    foreach((str_split(strrev(chr((ord($data{0}) % 252 % 248 % 240 % 224 % 192) + 128) . substr($data, 1)))) as $k => $v)
	    {
	        $ret += (ord($v) % 128) * pow(64, $k);
	    }
	    return '<img src="'.base_url().'assets/emoji/' . dechex((int)$ret) .'.png" alt="emoji" class="emoji" />';
	}

	function emojify($string)
	{
		log_message('INFO', "Emojify/emojify called" );
		return preg_replace_callback("/([\\xC0-\\xF7]{1,1}[\\x80-\\xBF]+)/", "$this->emojiimages", $string);
	}

	
}
?>
