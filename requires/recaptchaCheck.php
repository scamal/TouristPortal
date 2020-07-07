<?php
function reCaptchaCheck(){

    if(empty($_POST['g-recaptcha-response']))
    {
       return false;
    }
    else
    {
        $secret_key = '6LcjlNAUAAAAAGGOem-OHs5z-rVOn-VPtAoDNC7x';

        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

        $response_data = json_decode($response);
        //var_dump($response_data);
        if(!$response_data->success)
        {
            return false;
        }
        else
            return true;
    }
}

//echo reCaptchaCheck();