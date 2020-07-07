<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Tours | Belgrade</title>
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
require_once "navbar.php";
require_once "requires/userLocation.php";
?>
<div class="row overflow">
    <div class="col-md-6">
        <form class="form-inline d-flex justify-content-center md-form form-sm active-pink-2 mt-5">
            <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search" id="search">
            <?php
                $sql = "\"SELECT * FROM tour t left join location_in_tour lt on t.tour_ID = lt.tour_ID left join location l on lt.location_ID = l.location_ID where location_in_tour_ID != 'NULL'\"";
                $afteSql = "\"order by t.tour_ID\"";
                #echo  "<button type='button' class='btn-dark' style='height: 120%' onclick='searchB($sql,$afteSql)'>";
            ?>
            <button type='button' class='btn-dark' style='height: 120%' onclick='searchB("SELECT * FROM tour t left join location_in_tour lt on t.tour_ID = lt.tour_ID left join location l on lt.location_ID = l.location_ID where location_in_tour_ID != \"NULL\" "," order by t.tour_ID","and tour_public!=0 and t.","tourList.php")'>
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
</div>

<?php
//require_once "requires/session.php";
require_once "requires/db_config.php";
require_once "requires/deleteObsoleteTours.php";

$sql = "SELECT * FROM tour t left join location_in_tour lt on t.tour_ID = lt.tour_ID left join location l on lt.location_ID = l.location_ID where location_in_tour_ID != 'NULL' and tour_public!=0 order by t.tour_ID";
if (isset($_POST['newSql'])){
    if ($_POST['newSql']!=""){
        $sql = $_POST['newSql'];
    }
}

$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

//MapDiv


$url = "http://localhost/TouristPortal/LocationInfo.php?location=";
//echo "<div class='container-fluid'><table ><tr><th>Tour name</th><th class='d-none d-lg-table-cell'>Description</th><th>By</th><th>Locations</th><th>Info</th>";
$ses_set = isset($_SESSION['username']);
if ($ses_set){
    //echo "<th>Add to your tour</th></tr>";
}
else
    echo "</tr>";
echo "<br><div class='container-fluid'><table class='table table-responsive-lg '><tr><th>Tour name</th><th class='d-none d-lg-table-cell'>Tour description</th><th class='d-none d-md-table-cell'>Made by</th><th>Locations</th><th>View map</th>";
if (isset($_SESSION['username'])){
    echo "<th>Add to tour</th>";
}
if (mysqli_num_rows($result) > 0) {
$lastID = null;
$trigg = true;
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {

        $locID = $row['location_ID'];
        $longt = $row['longt'];
        $lat = $row['lat'];

        $locDesc = $row['location_description'];
        $currentID = $row['tour_ID'];
        $waypoints[$currentID][] = [$lat,$longt];
        if ($trigg){
            echo "<tr><td style=\"vertical-align: middle\">".$row['name']."</td><td style=\"vertical-align: middle\" class='d-none d-lg-table-cell'>".$row['description']."</td><td style=\"vertical-align: middle\" class='d-none d-md-table-cell'>".$row['user_ID']."</td><td style=\"vertical-align: middle\"><TABLE >";
            if ($row['location_name']!='') {
                echo "<tr><td><a class='links' href='/TouristPortal/LocationInfo.php?location=$locID' target='_blank'><abbr title='$locDesc'>" . $row['location_name'] . "</abbr></a></td></tr>"/*</TABLE></td><td>Info</td>"*/
                ;
            }
            $lastID = $currentID;
            $trigg = false;
        }
        else if ($currentID!=$lastID){
            $currentWaypoint = json_encode($waypoints[$lastID]);
            $newWay = [];
            foreach ($waypoints[$lastID] as $way){
                if ($way[0]!=null){
                    $newWay[] = $way;
                }
            }

            $currentWaypoint = json_encode($newWay);

            echo "</table><td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='viewMap($currentWaypoint,$startLat,$startLong)'>Map</button></td>";
            writeIfSession("<td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='addToMyTour($lastID)'>Add to my tours</button></td>");
            echo "</td></tr><tr><td style=\"vertical-align: middle\">".$row['name']."</td><td style=\"vertical-align: middle\" class='d-none d-lg-table-cell'>".$row['description']."</td><td style=\"vertical-align: middle\" class='d-none d-md-table-cell'>".$row['user_ID']."</td><td style=\"vertical-align: middle\"><TABLE>";
            if ($row['location_name']!='') {
                echo "<tr><td ><a class='links' href='/TouristPortal/LocationInfo.php?location=$locID' target='_blank'><abbr title='$locDesc'>" . $row['location_name'] . "</abbr></a></td></tr>"/*</TABLE></td><td>Info</td>"*/
                ;
            }
            $lastID = $currentID;
        }
        else {
            if ($row['location_name']!='') {
                echo "<tr><td><a class='links' href='/TouristPortal/LocationInfo.php?location=$locID' target='_blank'><abbr title='$locDesc'>" . $row['location_name'] . "</abbr></a></td></tr>"/*</TABLE></td><td>Info</td>"*/
                ;
            }
        }
        $img="";
        /*if ($row['location_picture']!=""){
            //echo $row['location_picture'];
            $img = "<img class='img-fluid' src='".$row['location_picture']."'>";
        }*/

        $url.= $row['tour_ID'];
        $id = $row['tour_ID']."row";
        //$ses = "<div class='$class'><a href='#'>Add location</a></div>";
        /*echo "<tr id='$id'><td>".$row['name']."</td><td class='d-none d-lg-table-cell'>".$row['description']."</td><td class='d-none d-md-table-cell'>".$row['user_ID']."</td><td><TABLE><tr>".
            echoNames($row['location_IDs'])."</tr></TABLE></td><td>Info</td>";
        if ($ses_set){
            echo "<td><button id='".$row['tour_ID']."'>Add</button></td></tr>";
        }
        else
            echo "</tr>";
        */
    }

    $newWay = [];
    foreach ($waypoints[$lastID] as $way){
        if ($way[0]!=null){
            $newWay[] = $way;
        }
    }

    $currentWaypoint = json_encode($newWay);
    echo "</table><td style=\"vertical-align: middle\"><button class='btn btn-primary'onclick='viewMap($currentWaypoint,$startLat,$startLong)'>Map</button></td>";
    writeIfSession("<td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='addToMyTour($lastID)'>Add to my tours</button></td>");
    echo "</td></tr></table></div>";

        //writeIfSession($ses);
    }
    //mysqli_free_result($result);
//echo "</table><table class='table table-dark' id='tour' style='width: 75%;'><caption class='table-dark'>Your tour</caption></table><div class='container'><div  style='height: 85vh'  id='map'></div><div id='buttons'></div></div></div>";
function writeIfSession($ses){
    require_once "requires/session.php";
    if (isset($_SESSION['username'])){
        echo $ses;
    }
}

?>

<br>
<div class="container" id='container'>
    <div  style="height: 50vh" id='map'>

    </div>
</div>

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

