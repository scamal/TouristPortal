<?php
$startLat = 181;
$startLong = 181;
if (isset($_GET['lat']) and isset($_GET['long'])){
    if ($_GET['lat']!=181 and $_GET['long']!=181){
        $startLat = $_GET['lat'];
        $startLong = $_GET['long'];
    }
}

