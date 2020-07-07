<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>My Tours | Belgrade</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>

    <!--MapQuestAPI-->
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
    <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css"/>

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/tourList.css">
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
$currentWaypoint = "";
require_once "navbar.php";
//require_once "requires/session.php";
require_once "requires/db_config.php";
require_once "requires/userLocation.php";
require_once "requires/deleteObsoleteTours.php";

if (isset($_SESSION['username'])) {

    $un = $_SESSION['username'];
    $un1 = "\'$un\'";

    $sq =$sql = "SELECT * FROM user_tour ut left join tour t on t.tour_ID = ut.tour_ID left join location_in_tour lt on t.tour_ID = lt.tour_ID left join location l on lt.location_ID = l.location_ID where ut.username = '$un' ";
    $sqD = "and";
    $ord = "order by ut.user_tour_ID";


    echo "<div class=\"row overflow\">
    <div class=\"col-md-6\">
        <form class=\"form-inline d-flex justify-content-center md-form form-sm active-pink-2 mt-5\">
            <input class=\"form-control form-control-sm mr-3 w-75\" type=\"text\" placeholder=\"Search\" aria-label=\"Search\" id=\"search\">
            <button type=\"button\" class=\"btn-dark\" style=\"height: 120%\" onclick=\"searchB('SELECT * FROM user_tour ut left join tour t on t.tour_ID = ut.tour_ID left join location_in_tour lt on t.tour_ID = lt.tour_ID left join location l on lt.location_ID = l.location_ID where ut.username = \'$un\' ',' order by t.tour_ID',' and ','userTours.php')\">
                <i class=\"fa fa-search\"></i>
            </button>
        </form>
    </div>
</div><br>";
    $helper = -100;
    $sql = "SELECT * FROM user_tour ut left join tour t on t.tour_ID = ut.tour_ID left join location_in_tour lt on t.tour_ID = lt.tour_ID left join location l on lt.location_ID = l.location_ID where ut.username = \"$un\"  order by ut.user_tour_ID";
    if (isset($_POST['newSql'])){
        if ($_POST['newSql']!=""){
            $sql = $_POST['newSql'];
        }
    }
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    echo "<div class='container-fluid'><table id='table' class='table table-responsive-lg'><tr><th>Tour name</th><th>Tour description</th><th>Locations</th><th>View map</th><th>Remove tour</th></tr>";
    $last_ID = -1000;
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
        {

            $longt = $row['longt'];
            $lat = $row['lat'];
            $userTourID = $row[0];
            $locDesc = $row['location_description'];
            $currentID =$userTourID;
            $waypoints[$currentID][] = [$lat, $longt];
            if ($last_ID==-1000){
                $last_ID = $currentID;
            }
            $newWay = [];
            foreach ($waypoints[$last_ID] as $way){
                if ($way[0]!=null){
                    $newWay[] = $way;
                }
            }

            $currentWaypoint = json_encode($newWay);
            //$currentWaypoint = json_encode($waypoints[$last_ID]);
            if ($helper != $userTourID) {

                $nm = $row['name'];
                $dsc = $row['description'];
                if ($helper != -100) {
                    $newWay = [];
                    foreach ($waypoints[$last_ID] as $way){
                        if ($way[0]!=null){
                            $newWay[] = $way;
                        }
                    }

                    $currentWaypoint = json_encode($newWay);
                    //$currentWaypoint = json_encode($waypoints[$last_ID]);
                    echo "</table></td><td style='vertical-align: middle'><button class='btn btn-primary' onclick='viewMap($currentWaypoint,$startLat,$startLong)'>Map</button></td><td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='removeTour($userTourID)'>Remove tour</button></td></tr><tr><td>$nm</td><td style=\"vertical-align: middle\">$dsc</td><td><table>";
                } else {
                    echo "<tr><td style=\"vertical-align: middle\">$nm</td><td style=\"vertical-align: middle\">$dsc</td><td><table>";
                }
                $helper = $userTourID;
            }
            $loc = $row['location_name'];
            $locdsc = $row['location_description'];
            $locID = $row['location_ID'];
            if ($row['location_name']!='') {
                echo "<tr><td><a class='links' href='/TouristPortal/LocationInfo.php?location=$locID' target='_blank'><abbr title='$locdsc'>" . $row['location_name'] . "</abbr></a></td></tr>"/*</TABLE></td><td>Info</td>"*/
                ;
            }
            //echo "<tr><td><abbr title='$locdsc'>$loc</abbr></td></tr>";
            $last_ID = $currentID;
        }
        echo "</tr></table></td><td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='viewMap($currentWaypoint,$startLat,$startLong)'>Map</button></td><td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='removeTour($userTourID)'>Remove tour</button></td></tr></table></div>";
        echo "<br>
<div style='position: relative' >
<div class=\"container\" id='container'>
    <div  style=\"height: 50vh\" id='map'>

    </div>
</div></div>";
    }
}
else {

    echo "<div class='largeDiv tableDiv'><p1 class='centerInTable display-3'>You must log in to access this page.</p1>";
}
?>


<!--script src="js/makeTour.js"></script-->
<script src="js/addToMyTour.js"></script>
<script src="search/search.js"></script>
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
