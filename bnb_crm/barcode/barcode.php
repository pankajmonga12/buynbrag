<?php
session_start();
// Including all required classes
require_once('class/BCGFontFile.php');
require_once('class/BCGColor.php');
require_once('class/BCGDrawing.php');

// Including the barcode technology
require_once('class/BCGcode39.barcode.php');

// Loading Font
$font = new BCGFontFile('./class/font/Arial.ttf', 18);

// The arguments are R, G, B for color.
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255);

$orderID = (isset($_GET['orderid']))? $_GET['orderid']: NULL; // used only to set header which will set the filename for the file being saved
$txnid = (isset($_GET['txnid']))? $_GET['txnid']: NULL; // used only to set header which will set the filename for the file being saved
$awbNo = (isset($_GET['awbno']))? $_GET['awbno']: NULL; // used for barcode generation


$drawException = null;
try {
	$code = new BCGcode39();
	$code->setScale(2); // Resolution
	$code->setThickness(30); // Thickness
	$code->setForegroundColor($color_black); // Color of bars
	$code->setBackgroundColor($color_white); // Color of spaces
	$code->setFont($font); // Font (or 0)
	$code->parse($awbNo); // Text
}
catch(Exception $exception) {
	$drawException = $exception;
}

/* Here is the list of the arguments
1 - Filename (empty : display on screen)
2 - Background color */
$drawing = new BCGDrawing('', $color_white);
if($drawException)
{
	$drawing->drawException($drawException);
}
else
{
	$drawing->setBarcode($code);
	$drawing->draw();
}

// Header that says it is an image (remove it if you save the barcode to a file)
header('Content-Type: image/png');
header('Content-Disposition: inline; filename="'.$txnid.'_'.$orderID.'.png"');
// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG); //uncomment
//$base_url = 'http://localhost/fork/bnb';
//$base_url = 'http://www.buynbrag.com';
//$url = $base_url.'/'.$barcode_file.'/'.$order_id.'/'.$txn_id.'/'.$over_write;
//header("Location: $url");
?>
