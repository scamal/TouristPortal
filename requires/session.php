<?php
session_start();

function sesUser ($user){
    $_SESSION["success"] = "";
    $_SESSION["username"]=$user;
}
