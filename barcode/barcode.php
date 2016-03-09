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

$order_id = $_SESSION['order_id'];
$txn_id = $_SESSION['txn_id'];
$barcode_file = $_SESSION['docket_number'];
$base_url = $_SESSION['base_url'];
$over_write = $_SESSION['over_write'];
				
unset($_SESSION['order_id']);
unset($_SESSION['txn_id']);
unset($_SESSION['docket_number']);
unset($_SESSION['base_url']);
unset($_SESSION['over_write']);

$barcode_path = $txn_id.'_'.$order_id.'.png';
//
$drawException = null;
try {
	$code = new BCGcode39();
	$code->setScale(2); // Resolution
	$code->setThickness(30); // Thickness
	$code->setForegroundColor($color_black); // Color of bars
	$code->setBackgroundColor($color_white); // Color of spaces
	$code->setFont($font); // Font (or 0)
	$code->parse($barcode_file); // Text
}
catch(Exception $exception) {
	$drawException = $exception;
}

/* Here is the list of the arguments
1 - Filename (empty : display on screen)
2 - Background color */
$drawing = new BCGDrawing($barcode_path, $color_white);
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
//header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG); //uncomment
//$base_url = 'http://localhost/fork/bnb';
//$base_url = 'http://www.buynbrag.com';
$url = $base_url.'/'.$barcode_file.'/'.$order_id.'/'.$txn_id.'/'.$over_write;
header("Location: $url");
?>