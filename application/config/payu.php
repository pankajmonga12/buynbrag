<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    //For Testing
//    $config['key']  = 'C0Dr8m';
//    $config['salt'] = '3sf0jURk';
//    $config['url']  = 'https://test.payu.in/_payment';
    
   //For Live
    $config['key']  = 'WZsjYU';
    $config['salt'] = 'EHHBivFw';
    $config['url']  = 'https://secure.payu.in/_payment';
    //$config['store_url'] = 'http://buynbragstores.s3-website-ap-southeast-1.amazonaws.com/';
    $config['store_url'] = 'http://buynbragstores.s3.amazonaws.com/';

    if( isset( $_SERVER['HTTPS'] ) && ( $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 ) || isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' )
    {
    	$config['store_url'] = 'https://buynbragstores.s3.amazonaws.com/';
    }

?>
