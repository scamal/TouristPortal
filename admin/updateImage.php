<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $id = str_replace('"', '', $id);
    if ($id > 0) {
        if (is_numeric($id) and $id >= 0) {
            $id += 0;
        }
        else exit("Invalid request");
    }
    else exit("Invalid request");
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
                $new_file ="$new_file_name[0]" . "1.$new_file_name[1]";
                $new_file_name = "../locationIMG/" . "$new_file_name[0]" . "1.$new_file_name[1]";
                $upload = $new_file_name;
                $smth = file_exists($upload);
            }
            $databaseName = "locationIMG/".$new_file;
            if (!($file_size > 5 * 1000 * 1000)) {
                if (move_uploaded_file($file_temp, $upload)) {
                    if (is_int($id)) {
                        $sql = "UPDATE location set location_picture=\"$databaseName\" where location_ID=$id ";
                        require_once "../requires/db_config.php";
                        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                        if ($result) {
                            echo "You have successfully uploaded image.";
                        } else {
                            echo "There is problem with database.";
                        }

                    }

                } else
                    echo "Error!";
            } else {
                echo "File must be smaller than 5MB.";
            }

        }
    }
}
else if (isset($_POST['imgLink'])){
    if ($_POST['imgLink']!=""){
        $link = $_POST['imgLink'];
        $sql = "UPDATE location set location_picture=\"$link\" where location_ID=$id";
        require_once "../requires/db_config.php";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
        if ($result) {
            echo "You have successfully uploaded image.";
        } else {
            echo "There is problem with database.";
        }
    }
}
else
    echo "Please select file.";
