<?php
require_once "db_config.php";
if (isset($_POST['location_ID']) /*and is_int($_POST['location_ID'])*/){
    //echo "locid set";
    $id = $_POST['location_ID'];
    $sql = "select * from location where location_ID=$id";

    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
        {
            $location=["longt"=>$row['longt'],"lat"=>$row['lat']];
            //var_dump($location);

            //exit(json_encode($location));
        }
        mysqli_free_result($result);
    }


    mysqli_close($connect);
}
exit(json_encode($location));


