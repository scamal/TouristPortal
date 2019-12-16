<?php

require_once 'requires/db_config.php';
require_once "requires/session.php";
header('Content-Type: application/json');
if(isset($_GET['js'])){

    $data = [
        "name"  => mysqli_real_escape_string($connect,trim($_GET['name'])),
        "surname"  => mysqli_real_escape_string($connect,trim($_GET['surname'])),
        "phone"  => mysqli_real_escape_string($connect,trim($_GET['phone'])),
        "username" => mysqli_real_escape_string($connect,trim($_GET['username'])),
        "email" => mysqli_real_escape_string($connect,trim($_GET['email'])),
        "password" => mysqli_real_escape_string($connect,trim($_GET['password']))
    ];

    foreach ($data as $key => $value) {
        if (empty($value) and $key!=="phone") {
            exit(json_encode(['error' => 'Please fill in all fields']));
        }
    }

    if (preg_match('/[A-Za-z]/',$data["phone"]) And $data["phone"]!=""){
        exit(json_encode(['error' => 'Invalid phone number!']));
    }
if ($data["phone"]==""){
    $data["phone"]="null";
}
    if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data["password"]) and strlen($data["password"].length)>=8)
    {
        exit(json_encode(['error' => 'Password is invalid!']));
    }
    $password = password_hash($data['password'],PASSWORD_DEFAULT);
    if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
        exit(json_encode(['error' => 'Email is invalid!']));
    }


    $sql = "SELECT ID_user FROM users WHERE mail = '{$data['email']}';";
    if (!$query=mysqli_query($connect,$sql)){
        exit(json_encode(['error' => "There is some error!"]));
    }
    if($row = mysqli_num_rows($query) > 0) {
        exit(json_encode(['error' => 'You are already registered']));
    }

    $sql = "INSERT INTO users(mail,Username,Password,Name,Last_name,Phone_number) VALUES('{$data['email']}','{$data['username']}','$password','{$data['name']}','{$data['surname']}','{$data['phone']}');";
if (!$query=mysqli_query($connect,$sql)){
    exit(json_encode(['error' => "There is some error!"]));
}
    $sql = "SELECT ID_user FROM users WHERE mail = '{$data['email']}';";
    if (!$query=mysqli_query($connect,$sql)){
        exit(json_encode(['error' => "There is some error!"]));
    }
    if($row = mysqli_num_rows($query) > 0){
        $i=0;
        while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
            if (!$i){
                $user = mysqli_real_escape_string($connect,trim($result["ID_user"]));
                sesUser($user);
                //echo $user;
            }
        }
    }

        exit(json_encode(['success' => 'Thank you for registering.']));
} else {
    if(isset($_GET["ses"])){
        $string =  mysqli_real_escape_string($connect,$_SESSION['user']);
        exit(json_encode(['ses' => $string]));
    }
    exit(json_encode(['error' => ' something went wrong']));

}