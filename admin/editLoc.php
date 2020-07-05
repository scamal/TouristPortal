<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] === "daAdminje") {
        if (isset($_GET['idToEdit'])) {
            $id = $_GET['idToEdit'];
            $id = str_replace('"','',$id);
        }
        if (isset($_GET['edit'])) {
            $update = $_GET['edit'];
        }
        if (isset($_GET['editSimple'])) {
            $value = $_GET['editSimple'];
        }
        if (isset($_GET['longitude'])) {
            $longitude = $_GET['longitude'];
            $longitude = str_replace('"','',$longitude);
        }
        if (isset($update) and isset($id)) {
            $update = str_replace('"', '', $update);
            $id = str_replace('"', '', $id);
            if ($id > 0 and $update != '') {
                if (is_numeric($id) and $id >= 0) {
                    $id += 0;
                    if (!is_int($id)) {
                        echo "There is error with id.";
                        exit;
                    }
                } else {
                    echo "There is error with id.";
                    exit;
                }
                if (isset($value)) {
                    if ($update == 'location_name' and $value == '') {
                        echo "Location name must not be empty.";
                        exit;
                    } else if ($update == 'location_name') {
                        $value = "\"$value\"";
                        doQuery($update, $value, $id);
                        exit;
                    }
                    if (isset($longitude)) {

                        if ($longitude >= 19 and $longitude <= 22) {
                            $update = str_replace('"', '', $update);
                            $up = [];
                            $up[0] = $update;
                            $up[1] = "longt";
                            $val = [];
                            $val[0] = $value;
                            $val[1] = $longitude;
                            #echo "$longitude,$id,$update";
                            doQuery($up, $val, $id);
                            exit;
                        } else {
                            echo "Longitude must be between 19 and 22.";
                        }
                    }
                    if ($update == 'lat') {
                        $value = str_replace('"', '', $value);
                        if ($value >= 43 and $value <= 46) {
                            doQuery($update, $value, $id);
                            exit;
                        } else {
                            echo "Latitude must be between 43 and 46.";
                            exit;
                        }


                    }
                    $value = "\"$value\"";
                    doQuery($update, $value, $id);
                    exit;
                }
                if (isset($longitude)) {
                    $longitude = str_replace('"', '', $longitude);
                    if ($longitude >= 19 and $longitude <= 22) {
                        $update = str_replace('"', '', $update);
                        $update = "longt";
                        doQuery($update, $longitude, $id);
                        exit;
                    } else {
                        echo "Longitude must be between 19 and 22.";
                    }
                }
            }

        } else {
            echo "Required variables are not set.";
        }
    }
}
else {
    echo "Please log in as administrator";
}
function doQuery($update,$value,$id){
    if (is_array($update)){
        if ($value[0]!=0){
            $sql = "update location set $update[0]=$value[0], $update[1]=$value[1]  where location_ID= $id";
        }
        else
            $sql = "update location set $update[1]=$value[1]  where location_ID= $id";
    }
    else {
        $sql = "update location set $update=$value where location_ID= $id";
    }
    require_once "../requires/db_config.php";

    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if  ($result){
        echo "You have successfully updated database.";
    }
    else {
        echo "There is problem with database.";
    }

}
function doQueryLong(){

}