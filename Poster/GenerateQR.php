<?php
// include BarcodeQR class
include "BarcodeQR.php";
require_once('../requires/db_config.php');
// set BarcodeQR object
$qr = new BarcodeQR();

// create URL QR code
//$qr->url("www.google.com");
//$qr->sms("064232323","Hello vts");
$url = "http://localhost/TouristPortal/LocationInfo.php?location=";


/*$sql = "SELECT * FROM workers
        WHERE name LIKE '%t_'";
*/
$url = "http://grgulu.byethost7.com/TouristPortal/";
$qr->url($url);
// display new QR code image
//qr->draw();
//$qr->draw(450);
echo $url;
// save new QR code image (size 150x150)
$qr->draw(450, "posterQR.png");
