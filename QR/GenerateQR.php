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
$sql = "SELECT * FROM location";

$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {
        $url = $_SERVER['HTTP_HOST']."/TouristPortal/LocationInfo.php?scanned=1&location=";
        $url.= $row['location_ID'];
        $id = $row['location_ID'];
        $qr->url($url);
// display new QR code image
//qr->draw();
        //$qr->draw(450);
        echo $url;
// save new QR code image (size 150x150)
        $qr->draw(450, "tmp/".$id.".png");
    }
    mysqli_free_result($result);
}
mysqli_close($connect);
