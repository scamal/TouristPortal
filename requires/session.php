<?php
session_start();
function sesUser ($user){
    $_SESSION["username"]=$user;
}
