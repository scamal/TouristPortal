


window.addEventListener('load', init);//dodajemo da se pri ucitavanju stranice ucita funkacija init u koju idu pozivi ostalih f-ja

function $(id) {
    return document.getElementById(id);
}

function init() {
    $('signout').addEventListener('click', SignOut);
    $('signin').addEventListener('click',SignIn);
}

function SignOut(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            alert(xmlhttp.responseText);
            setTimeout(function (){
                window.location.replace("LogIn.php");
            }, 1000)
        }
    };

    xmlhttp.open("POST", "SignOut.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}

function SignIn(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            $('error_mess').innerHTML = xmlhttp.responseText;
            if(xmlhttp.responseText === "Succesfull !") {
                setTimeout(function () {
                    window.location.replace("index.php");
                }, 1000)
                $('error_mess').style.color = "green";
            }
        }
    };

    var username = $('Username').value;
    var pass = $('Password').value;

    xmlhttp.open("POST", "LogInCheck.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("Username="+username+"&Password="+pass);
}

