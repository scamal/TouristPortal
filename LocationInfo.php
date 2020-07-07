<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Location info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--MapQuestAPI-->
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>
    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!--MapQuestAPI-->
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>

</head>
<body class=" konj">
<?php
require_once "navbar.php";
?>
<div class="container p-4 text-center">
    <div class="div-style row p-3 rounded min-height-100 text-center">
<?php



require('requires/db_config.php');

/*$sql = "SELECT * FROM workers
        WHERE name LIKE '%t_'";
*/
if (isset($_GET['location'])){
    $location_ID = $_GET['location'];
}
else echo "You haven't selected any location";
$sql = "SELECT * FROM location
        WHERE location_ID= $location_ID";

$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {
        if ($row['lat']!=null){
            $lat = $row['lat'];
        }
        if ($row['longt']!=null){
            $longt = $row['longt'];
        }

        if ($row['location_name']!=null){
            $locName =$row['location_name'];
            $img = $row['location_name'];
            echo "<div class='col-12'><h4 class='title-font white-text'>$img</h4></div>";
        }
        if ($row['location_picture']!=null){
            $img = $row['location_picture'];
            echo "<div class='col-1 col-md-2 '></div><img src=\"$img\" class='col-10 col-md-8'><div class='col-1 col-md-2 '></div><br><br>";
        }
        if ($row['location_description']!=null){
            $img = $row['location_description'];
            echo "<div class='col-12'><p>$img</p></div>";
        }
        if ($row['map_embed']!=null){
            $img = $row['map_embed'];
            $arr = explode(" ",$img);
           // var_dump($arr);
            $newArr = [];
            foreach ($arr as $word){
                //$word = "$word ";
                //echo "$word";

                //echo "asfdasdfadsf<br>";
                if (strpos($word,"width")===0){
                    $word = "width=\"100%\"";
                    //echo "sdfadsf";
                }
                if (strpos($word,"height")===0){
                    $word = "height=\"450\"";
                }
                //echo "$word".strpos($word,"width"). "<br>";
                $newArr[] = $word;
            }
            //var_dump($newArr);
            $img = implode(" ",$newArr);

        }
        echo "<br><br><div class=\"container mt-1\" id='container'>
    <br><br><div  style=\"height: 50vh\" id='map'>

    </div>
</div>";




    }
    mysqli_free_result($result);
}
$scanned = "False";
if (isset($_GET['scanned'])){
    if ($_GET['scanned'] == 1) {
        $scanned = "True";
    }
}
require_once "MobileDetectStats/Stats.php";
$os = "$os";
$deviceType = "$deviceType";
$browser = "$browser";
$name = "";
if (isset($locName)){
    $name = $locName;
}
$sql = "insert into scan_stats (scanned, device_type,operating_system,browser,Location_name,scan_country) values ($scanned, \"$os\", \"$deviceType\",\"$browser\",\"$name\",\"$country\")";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

mysqli_close($connect);
?>
    </div>
</div>
<?php
    echo "<script>window.onload = function() {
    var mapDiv = document.getElementById('showLoc');
    L.mapquest.key = 'sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB';

// 'map' refers to a <div> element with the ID map
    map = L.mapquest.map('map', {
        center: [$lat, $longt],
        layers: L.mapquest.tileLayer('map'),
        zoom: 12
    }); 
    L.mapquest.textMarker([$lat, $longt], {
            text: '$locName',
            position: 'right',
            type: 'marker',
            icon: {
                primaryColor: '#333333',
                secondaryColor: '#333333',
                size: 'sm'
        }
    }).addTo(map);



};
</script>"
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="js/simpleWeather.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

</body>

</html>

