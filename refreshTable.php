<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$currentWaypoint = "";
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


    $helper = -100;
    $sql = "SELECT * FROM user_tour ut left join tour t on t.tour_ID = ut.tour_ID left join location_in_tour lt on t.tour_ID = lt.tour_ID left join location l on lt.location_ID = l.location_ID where ut.username = \"$un\"  order by ut.user_tour_ID";
    if (isset($_POST['newSql'])){
        if ($_POST['newSql']!=""){
            $sql = $_POST['newSql'];
        }
    }
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    echo "<table id='table' class='table table-responsive-lg'><tr><th>Tour name</th><th>Tour description</th><th>Locations</th><th>View map</th><th>Remove tour</th></tr>";
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
        echo "</tr></table></td><td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='viewMap($currentWaypoint,$startLat,$startLong)'>Map</button></td><td style=\"vertical-align: middle\"><button class='btn btn-primary' onclick='removeTour($userTourID)'>Remove tour</button></td></tr>";

    }
}
else {

    echo "<div class='largeDiv tableDiv'><p1 class='centerInTable display-3'>You must log in to access this page.</p1>";
}
?>
