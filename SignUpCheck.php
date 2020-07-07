<?php

require_once 'requires/db_config.php';
require_once "requires/session.php";
require_once "requires/recaptchaCheck.php";
header('Content-Type: application/json');
if (isset($_POST['Name'])&&isset($_POST['Last_name'])&&isset($_POST['Username'])&&isset($_POST['Mail'])&&isset($_POST['Password'])){

    $data = [
        "name"  => mysqli_real_escape_string($connect,trim($_POST['Name'])),
        "surname"  => mysqli_real_escape_string($connect,trim($_POST['Last_name'])),
        //"phone"  => mysqli_real_escape_string($connect,trim($_POST['phone'])),
        "username" => mysqli_real_escape_string($connect,trim($_POST['Username'])),
        "email" => mysqli_real_escape_string($connect,trim($_POST['Mail'])),
        "password" => mysqli_real_escape_string($connect,trim($_POST['Password']))
    ];

    foreach ($data as $key => $value) {
        if (empty($value) and $key!=="phone") {
            exit(json_encode(['error' => 'Please fill in all fields']));
        }
    }

    /*if (preg_match('/[A-Za-z]/',$data["phone"]) And $data["phone"]!=""){
        exit(json_encode(['error' => 'Invalid phone number!']));
    }*/
/*if ($data["phone"]==""){
    $data["phone"]="null";
}*/
    if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data["password"]) and strlen($data["password"].length)>=8)
    {
        exit(json_encode(['error' => 'Password is invalid!']));
    }
    $password = password_hash($data['password'],PASSWORD_DEFAULT);
    if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
        exit(json_encode(['error' => 'Email is invalid!']));
    }


    $sql = "SELECT username FROM users WHERE email = '{$data['email']}';";
    $query=mysqli_query($connect,$sql);
    if (!$query){
        $err = mysqli_error($connect);
        exit(json_encode(['error' => "There is some error! $err"]));
    }
    if($row = mysqli_num_rows($query) > 0) {
        exit(json_encode(['error' => 'You are already registered']));
    }

    //exit (json_encode(['error' => $_POST['g-recaptcha-response']]));
    if (!reCaptchaCheck()){
        exit(json_encode(['error' => 'Please check the  box in captcha!']));
    }
    $link = makeLink();
    $sql = "INSERT INTO users(email,username,password,name,last_name,ver_link) VALUES('{$data['email']}','{$data['username']}','$password','{$data['name']}','{$data['surname']}','$link');";
if (!$query=mysqli_query($connect,$sql)){
    $err = mysqli_error($connect);
    exit(json_encode(['error' => "You are already registered!"]));
}

    $sql = "SELECT username FROM users WHERE email = '{$data['email']}';";
    if (!$query=mysqli_query($connect,$sql)){
        $err = mysqli_error($connect);
        exit(json_encode(['error' => "There is some error! $err"]));
    }
    if($row = mysqli_num_rows($query) > 0){
        $i=0;
        while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)){
            if (!$i){
                $user = mysqli_real_escape_string($connect,trim($result["username"]));
                //sesUser($user);
                //echo $user;
            }
        }
    }
    require_once "vendor/autoload.php";
    $userID = mysqli_insert_id($connect);
    $email = $data['email'];
    $username = $data['username'];
    $name = $data['name'];

    /*$header = "From: Beograd <>\n";
    $header .= "X-Sender: <$email>\n";
    $header .= "X-Mailer: PHP\n";
    $header .= "X-Priority: 1\n";
    $header .= "Return-Path: <$email>\n";
    $header .= "Content-Type: text/html; charset=UTF-8\n";
*/

    $message = "<br><br><div style='background-color: #0e2231'>
                <h1 style='color: #fff0ff'>Tourist Portal: Belgrade</h1>
                <h2 style='color: #fff0ff'>Please verify your account by accessing the link:</h2></div>
                <br><a href='$link'>$link</a>";
    $to = "$email";
    $subject = "Belgrade - Verification mail";
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP(true);
    try {
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = 'smtp.gmail.com';
        $mail->port = 587;
        $mail->isHTML();
        $mail->Username = 'TouristPortalBelgrade@gmail.com';
        $mail->Password = 'elektronsko poslovanje';
        $mail->SetFrom('TouristPortalBelgrade@gmail.com');
        $mail->Body = $message;
        $mail->AddAddress($to);
        $mail->Send();
    }
    catch (Exception $e)
    {
        /* PHPMailer exception. */
        echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
        /* PHP exception (note the backslash to select the global namespace Exception class). */
        echo $e->getMessage();
    }

    if ($mail->Send()){
        echo (json_encode(['success' => 'Mail was sent']));
        

    }

    //mail($to,$subject,$message);

    //if (mail($to, $subject, $message, $header))



}
else{
    if(isset($_POST["ses"])){
        $string =  mysqli_real_escape_string($connect,$_SESSION['user']);
        exit(json_encode(['ses' => $string]));
    }
    exit(json_encode(['error' => ' something went wrong']));

}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function makeLink(){
    $link = $_SERVER['HTTP_HOST']."/TouristPortal/verifyAccount.php?code=";
    $link.= generateRandomString(rand(5,15));
    return $link;
}
