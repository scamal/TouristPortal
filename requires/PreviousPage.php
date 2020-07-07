<?php
#global $uri;
function getUri(){
    $uri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
    $uriEl = explode("/",$uri);

    echo $uriEl[sizeof($uriEl)-1]!="logIn.php" and  $uriEl[sizeof($uriEl)-1]!="signOut.php";
    if ($uriEl[sizeof($uriEl)-1]!="logIn.php" and  $uriEl[sizeof($uriEl)-1]!="signOut.php"){
        $_SESSION["previousPage"] = $uri;

    }
    $_SESSION["success"] = True;



    return $uri;
    #$_SESSION["previousPage"] = $uri;
}
function saveToSession(){

}
function redirect(){

    $uri = $_SESSION["previousPage"];
    echo "$uri";
    //header("Location: $uri");
}
function echoPP(){
    echo $_SESSION["previousPage"];
}

