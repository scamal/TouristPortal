<?php
require_once "requires/db_config.php";
$tours = [];
$sql = "select * from tour";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$where = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
    {
        $tours[$row['tour_ID']] = $row['location_IDs'];
        /*echo "<br>".$row['location_IDs'];
        $locations =  explode(", ",$row['location_IDs']);
        var_dump($locations);
        if (sizeof($locations)<3){
            $where.="tour_ID=".$row['tour_ID'];
        }*/
    }
}
echo $where;
$checkLoc = [];
$locations = [];
foreach ($tours as $tour=>$location) {
    $location = explode(", ",$location);
    $locations[$tour] = $location;
    $checkLoc = array_merge($checkLoc,$locations);

}
$tourToDelete = [];
foreach ($locations as $tourID=>$locationIDs){
    foreach ($locationIDs as $locationID){
        if ($locationID!=''){
            $sql = "select * from location where location_ID=$locationID";
            $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
            if (mysqli_num_rows($result) == 0) {
                $tourToDelete[$tourID][] = $locationID;
            }
        }
    }

}
$ToDelete = [];
$where = "";

foreach ($tourToDelete as $key=>$val){
    //if you want to delete table cascade style remove [$key]
    if ((sizeof($locations[$key])-sizeof($tourToDelete[$key]))<3 ){
        $sql = "delete from tour where tour_ID=$key";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    }
}
/*
foreach ($tourToDelete as $delete){
    $sql = "delete from tour where tour_ID=$tourToDelete";
}




$locations = explode(", ",$location);
$location = array_unique($locations);
var_dump($tours);
$locDelete = [];
foreach ($location as $tour=>$loc){
    $sql = "select * from location where location_ID = $loc";
    echo "$sql";

    if (is_numeric($loc)){
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
        if (mysqli_num_rows($result) > 0) {
            $locDelete[] = $loc;
            echo "<br>";
        }
    }

}
var_dump($toDel);
/*
$tourDelete = [];
foreach ($locDelete as $td){
    $toPush = array_keys($locations,$td);
    $tourDelete = array_merge($tourDelete,$toPush);
}
$where = "";
foreach ($tourDelete as $td){
    $where.= " tour_ID=$td and";

}
$where = substr($where,0,-4);
$sql = "delete from tour where".$where;
var_dump($tourDelete);
*/


