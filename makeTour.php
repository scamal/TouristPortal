<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Location info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>

    <!--MapQuestAPI-->
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <style>
        table{
            width: 100%
        }
        caption{
            caption-side: top;
        }
        td{
            padding: 20px 20px;
        }
    </style>

</head>
<body class="text-center">

<?php
require_once "navbar.php";
//require_once "requires/session.php";
require_once "requires/db_config.php";
$sql = "SELECT * FROM location";

$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

$url = "http://localhost/TouristPortal/LocationInfo.php?location=";
echo "<div class='container-fluid'><table class='table-striped'><tr><th>Location</th><th class='d-none d-lg-table-cell'>Description</th><th class='d-none d-md-table-cell'>Photo</th><th>Info</th><th>Add to tour</th>";
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {

        $img="";
        if ($row['location_picture']!=""){
            //echo $row['location_picture'];
            $img = "<img class='img-fluid' src='".$row['location_picture']."'>";
        }
        $url.= $row['location_ID'];
        $id = $row['location_ID']."row";
        //$ses = "<div class='$class'><a href='#'>Add location</a></div>";
        echo "<tr id='$id'><th>".$row['location_name']."</th><th class='d-none d-lg-table-cell'>".$row['location_description']."</th><th class='d-none d-md-table-cell'>$img</th><th>Info</th><th><button id='".$row['location_ID']."'>Add to tour</button></th></tr>";
        //writeIfSession($ses);
    }
    mysqli_free_result($result);
}
echo "</table><table class='table table-dark' id='tour' style='width: 75%;'><caption class='table-dark'>Your tour</caption></table><div class='container'><div  style='height: 85vh'  id='map'></div><div id='buttons'></div></div></div>";
function writeIfSession($ses){
    require_once "requires/session.php";
    if (isset($_SESSION['username'])){
        echo $ses;
    }
}
?>
<script src="js/makeTour.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8rxbHWZvXHRRk9NZFAiZ2DMNl9_kBsEk&callback=initMap"
        async defer></script>

</body>
</html>
