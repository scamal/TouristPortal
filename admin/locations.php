<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Locations | Admin | Belgrade</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--font-->



    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="js/simpleWeather.js"></script>

    <!--MapQuestAPI-->

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/style.css">
    <link type="text/css" rel="stylesheet" href="../css/tourList.css">
    <link type="text/css" rel="stylesheet" href="admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css"
          rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <style>
        table{
            width: 100%;
        }
        caption{
            caption-side: top;
        }
        tr:nth-child(even)>td{
            padding: 20px 20px;
            cursor: help;
        }
        tr:nth-child(even)>td:hover{
            background-color: #aaa;
        }
        #addLocation tr>td{
            padding: 20px 20px;
            cursor: help;
        }
        #addLocation tr>td:hover{
            background-color: #aaa0;
        }
        input{
            margin: 5px;
        }
        .labelClass{
            margin: 5px;
        }




    </style>

</head>
<?php
require_once "navbar.php";
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] === "daAdminje") {
        require_once "../requires/db_config.php";
        $sql = "select * from location";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
        ?>
<div class="container-fluid">
<div class="col-12 m-2 p-2" >
    <button class="btn btn-primary" onclick="displayAddLocation()" id="this">Add location</button>
</div>
    <input type="hidden" id="latlongToEdit" value="form">
<div class="row">
                <div class="col-lg-6 m-2 p-2" style="background-color: #ccc; display: none" id="addLocation" class="col-4">
                    <h3>Sir, enter data for new location..</h3>
                    <div>
                        <div>
                    <form enctype='multipart/form-data' id='addLocationForm' method="post" action="addLocation.php">
                        <table class="addTable table-responsive">
                            <tr><td><label for='nm'>Name: </label></td><td><input name='locNm' id='locNm'></td></tr>
                        <tr><td><label for='desc'>Description: </label></td><td><input name='desc' id='desc'></td></tr>
                        <tr><td><label for='lat'>Latitude: </label></td><td><input name='lat' id='lat'></td></tr>
                        <tr><td><label for='longt'>Longitude: </label></td><td><input name='longt' id='longt'></td></tr>
                        <tr><td><label for='longt'>Image name or link: </label></td><td><input name='imageName' id='imageName'><input type="file" accept="image/*" id="formImage"></td></tr>
                            <br>
                            <tr><td><button type="submit" class="btn btn-primary" onclick="event.preventDefault();event.stopPropagation();sendAddLocationForm()">Add</button></td></tr>
                        </table>
                    </form>
                        </div>

                    </div>

                </div>
    <div id="map_container" class="col-lg-5">
        <div class="mapHead" id="resultDiv">&nbsp;</div>

        <div id="lat-long-map" style="height:50vh">&nbsp;</div>
    </div>
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

                echo "<tr id='$id' class='mainRow'><td id='location_name$id' onclick='editLoc($id,\"location_name\",this,\"$locName\")'><abbr title='Click to edit'>$locName</abbr></td>
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
</div>

<script
        src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB"></script>
<script
        src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-geocoding.js?key=sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB"></script>
<script type="text/javascript" src="dragMarker.js"></script>
<script src="admin.js"></script>
<script src="../search/search.js"></script>
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