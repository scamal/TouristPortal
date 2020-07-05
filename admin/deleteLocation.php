<?php
if (isset($_POST['id'])){
    $val = str_replace('"','',$_POST['id']);

    if (is_numeric($val)){
        $val+=0;

        if (is_int($val)){
            $id = $_POST['id'];
        }
        else exit("Invalid id.");
    }
    else exit("Invalid id.");

}
else exit("Invalid id.");
if (isset($id)){
    $sql = "delete from location where location_ID=$id";
    require_once "../requires/db_config.php";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if ($result){
        exit("You have succesfully deleted location.");
    }
    else {
        exit("There is problem with database.");
    }
}
