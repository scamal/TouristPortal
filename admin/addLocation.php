<?php
$sqlColumns = "";
$sqlValues = "";
if (isset($_POST['locNm'])){
    if ($_POST['locNm']!=""){
        $name = $_POST['locNm'];
        $sqlColumns.="location_name";
        $sqlValues.="\"$name\"";
    }
    else
        exit("Location must have a name");
}
else{
    exit("Location must have a name");
}

if (isset($_POST['desc'])){
    $desc = $_POST['desc'];
    $sqlColumns.=",location_description";
    $sqlValues.=",\"$desc\"";
}
if (isset($_POST['lat'])){

    if ($_POST['lat']!=0){

        $value = $_POST['lat'];
        $value = str_replace('"', '', $value);
        if ($value >= 43 and $value <= 46) {
            $lat = $value;
            $lat = str_replace('"','',$lat);
            $sqlColumns.=",lat";
            $sqlValues.=",".$lat;
        }
        else {
            exit("Latitude must be between 43 and 46 degrees.");
        }
    }
    else {
        exit ("Latitude must be entered!");
    }

}
else {
    exit ("Latitude must be entered!");
}
if (isset($_POST['longt'])){
    if ($_POST['longt']!=0){
        $value = $_POST['longt'];
        $value = str_replace('"', '', $value);
        if ($value >= 19 and $value <= 22) {
            $longt = $value;
            $sqlColumns.=",longt";
            $sqlValues.=",".$longt;
        }
        else {
            exit("Longitude must be between 19 and 22 degrees.");
        }
    }
    else {
        exit ("Longitude must be entered!");
    }

}
else {
    exit ("Longitude must be entered!");
}
if (isset($_POST['imageName'])){
    if ($_POST['imageName']){
        $value = $_POST['imageName'];
        if ($value!=""){
            if (filter_var($value, FILTER_VALIDATE_URL)){
                $link = $_POST['imageName'];
                $sqlColumns.=",location_picture";
                $sqlValues.=",\"$link\"";
            }
            else {
                exit ("Link must be valid URL");
            }
        }
    }

}
if (isset($_FILES['file'])){
    $upload = true;
}
if (isset($_FILES['file'])) {
    if ($_FILES['file']["error"] > 0) {
        echo "Something went wrong during file upload!";
    } else {
        if (isset($_FILES["file"]) and is_uploaded_file($_FILES['file']['tmp_name'])) {

            $file_name = $_FILES['file']["name"];
            $file_temp = $_FILES["file"]["tmp_name"];
            $file_size = $_FILES["file"]["size"];
            $file_type = $_FILES["file"]["type"];
            $file_error = $_FILES['file']["error"];


            // http://en.wikipedia.org/wiki/Exchangeable_image_file_format
            // http://www.php.net/manual/en/book.exif.php


            if (!exif_imagetype($file_temp))
                exit("File is not a picture!");
            $upload = "../locationIMG/" . "$file_name";
            $smth = 1;
            $new_file = $file_name;
            $new_file_name = "";
            while ($smth) {
                global $new_file_name;

                $new_file_name = explode(".", $new_file);
                $new_file = "$new_file_name[0]" . "1.$new_file_name[1]";
                $new_file_name = "../locationIMG/" . "$new_file_name[0]" . "1.$new_file_name[1]";
                $upload = $new_file_name;
                $smth = file_exists($upload);
            }
            $databaseName = "locationIMG/" . $new_file;
            if (!($file_size > 5 * 1000 * 1000)) {
                if (move_uploaded_file($file_temp, $upload)) {
                    $sqlColumns .= ",location_picture";
                    $sqlValues .= ",\"$databaseName\"";
                } else
                    exit("Error!");
            } else {
                exit("File must be smaller than 5MB.");
            }

        }
    }
}
else if (isset($link)) {
    if ($link!=0){
        $sqlColumns .= ",location_picture";
        $sqlValues .= ",\"$link\"";
    }
}
$whereColumns = explode(",",$sqlColumns);
$whereValues = explode(",",$sqlValues);
$where = "";
for ($i=0;$i<(sizeof($whereColumns));$i++){
        $where.=" $whereColumns[$i]=$whereValues[$i] and";
}
$where = substr($where,0,-4);
$checkSql = "select * from location where ".$where;
require_once "../requires/db_config.php";
$result = mysqli_query($connect, $checkSql) or die(mysqli_error($connect));
if (!(mysqli_num_rows($result) > 0)){

    $sql = "INSERT INTO location (".$sqlColumns.") VALUES (".$sqlValues.");";


    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));

    if  ($result){
        $id = mysqli_insert_id($connect);
        qrAdd($id);
        echo "You have successfully entered location.";
    }
    else {
        echo "There is problem with database.";
    }
}
else {
    exit("There is already this location.");
}

function qrAdd($id){
    require_once "../QR/BarcodeQR.php";
    $qr = new BarcodeQR();
    if (isset($id)){
        $url = $_SERVER['HTTP_HOST']."/TouristPortal/LocationInfo.php?scanned=1&location=";
        $url.= $id;
        $qr->url($url);
// display new QR code image
//qr->draw();
//$qr->draw(450);

// save new QR code image (size 150x150)
        $qr->draw(450, "../QR/tmp/".$id.".png");
    }
}








