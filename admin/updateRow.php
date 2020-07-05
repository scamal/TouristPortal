<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['admin'])) {
if ($_SESSION['admin'] === "daAdminje") {
require_once "../requires/db_config.php";
$sql = "select * from location";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
?>

    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
<div class='container-fluid' id="mainContainer"><table class='table-responsive-lg'><tr><th>Name</th><th>Description</th><th>GeoLocation</th><th>Image</th><th>Delete Location</th>
            <?php
            $counter = 0;
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) // MYSQLI_ASSOC, MYSQLI_BOTH
            {
                $id = $row[0];
                $locName = $row['location_name'];
                $desc = $row['location_description'];
                $picture = $row['location_picture'];
                $lat = $row['lat'];
                $longt = $row['longt'];
                if (strpos($picture,'locationIMG/')!==false) {
                    $picture = "../" . $picture;
                }
                $latlong = "$lat,"." $longt";

                echo "<tr id='$id'><td id='location_name$id' onclick='editLoc($id,\"location_name\",this,\"$locName\")'><abbr title='Click to edit'>$locName</abbr></td>
<td id='location_description$id' onclick='editLoc($id,\"location_description\",this,\"$desc\")' title='Click to edit'><abbr title='Click to edit'>$desc</abbr></td>
<td id='lat$id' onclick='editLoc($id,\"lat\",this,\"$lat, $longt\")'><abbr title='Click to edit'>$lat, $longt</abbr></td>
<td id='location_picture$id' onclick='updateImageLoc($id,\"location_picture\",this,\"$picture\")'><img  src='$picture' class='mr-1' width='150px'></td>
<td id='deleteLocation'><button onclick='deleteLocation($id)' class='btn btn-primary'>Delete</button></td>
</tr>";
                echo "<tr id='$id'><td><div  class='location_name$id' style='display: none'>
<div class='float-left'><label for='location_name$id' class='labelClass'>Location name:</label><input type='text' class='location_name$id labelClass'></div><button onclick='sendToEditLoc($id,\"location_name\",this)' class='labelClass'>Process</button></div</td>
<td ><div class='location_description$id'  title='Click to edit' style='display: none'>
<label for='location_description$id' class='labelClass'>Description:</label><input type='text' class='location_description$id labelClass'> <button class='labelClass' onclick='sendToEditLoc($id,\"location_description\",this,\"$desc\")'>Process</button></div></td>
<td ><div class='lat$id'  style='display: none'>
<div><label for='lat$id' class='labelClass'>Latitude: </label><input type='text' class='lat$id labelClass'></div>
<div><label class='labelClass'>Longitude: </label></label> <input type='text' class='lat$id labelClass'></div> <button class='labelClass' onclick='sendToEditLoc($id,\"lat\",this,\"$lat, $longt\")'}'>Process</button></div></td>
<td ><div class='location_picture$id' style='display: none'>
<form method='post' action='' enctype='multipart/form-data' id='updateImageForm$id'>
<div><label  class='labelClass' for='imgLink'>Link:</label>
<input type='text' id='imgLink$id' name='imgLink' class='labelClass'></div>
<div>
<label  class='labelClass'>Upload:</label>
<input type='file' accept='image/*' id='file$id' class='labelClass'>
</div> 
<!--input type='hidden' name='imageID' value='$id'-->
<button type='button' onclick='sendToUpdateImage($id,\"image\",this,\"$picture\")' class='labelClass'>Process</button>
</form>
</div></td>
</tr>";

                ?>
                <?php

            }

        }
    }
    else {
        echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>You must be administrator to access this page.</p1>";
    }
}
else {
    echo "<div class='largeDiv tableDiv text-center'><p1 class='centerInTable display-3'>You must be administrator to access this page.</p1>";
}
/*
 <?= ?> <----------------- ECHO KOJI SE KORISTI U HTMLu
    PRIMER
        <img onclick='uploadLoc(<?= $id =>,\"location_picture\")' src='<?= $picture ?>' class='mr-1' width='150px'>
 */
?>


    </div>
</div>