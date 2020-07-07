<?php
session_start();
require_once "db_config.php";
//var_dump($_SESSION);
if (isset($_POST['location_ID']) and isset($_SESSION['username']) && isset($_POST['locationArr'])/*and is_int($_POST['location_ID'])*/) {
    if (isset($_POST['makePublic'])){
        $makePublic = $_POST['makePublic'];
    }
    $locations = "'".$_POST['location_ID']."'";
    $user = "'".$_SESSION['username']."'";
    $locationsArr = $_POST['locationArr'];
    $tName = "NULL";
    $tDesc = "NULL";
    if (isset($_POST['tourName'])){
        if ($_POST['tourName']!=''){
            $tName = "'".$_POST['tourName']."'";
        }
        else {
            exit(json_encode(['status'=>"Please enter name of tour!"]));
        }

    }
    else {
        exit(json_encode(['status'=>"Please enter name of tour!"]));
    }
    if (isset($_POST['tourDesc'])){
        $tDesc = "'".$_POST['tourDesc']."'";
    }
    $sql = "INSERT INTO tour (name, user_ID, location_IDs, description, tour_public)
VALUES ($tName,$user,$locations,$tDesc,$makePublic);";
    //echo $sql;

    $result = mysqli_query($connect, $sql) or die(json_encode(['status'=>"Error with database!"]));

    if( mysqli_affected_rows($connect)){
        //var_dump($_POST['locationArr']);
        $lastIndex = mysqli_insert_id($connect);
        $res =  json_encode(['saved'=>"You have saved the tour!",'lastIndex'=>$lastIndex]);
    }
    foreach ($locationsArr as $loc){
        $sql = "INSERT INTO location_in_tour (location_ID,tour_ID)
VALUES ($loc,$lastIndex);";
        $result = mysqli_query($connect, $sql) or die(json_encode(['status'=>"Error with database!"]));
    }
    if( mysqli_affected_rows($connect)){
        //var_dump($_POST['locationArr']);
        $lastIndex = mysqli_insert_id($connect);
        echo $res;
    }

    mysqli_close($connect);


}
else {
    echo json_encode(['status'=>"Please log in!"]);
}

//exit(json_encode($location));
