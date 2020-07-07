

document.onload = function (){
    let btn = document.getElementById("signin");
    btn.disabled = true;
    console.log("asdfasdf");
    //btn.innerHTML = "asdfdsaf";
}
window.addEventListener('load', init);//dodajemo da se pri ucitavanju stranice ucita funkacija init u koju idu pozivi ostalih f-ja

/*function $(id) {
    return document.getElementById(id);
}*/

function check(input){
    if (input.value == ""){
        errorStyle(input, 'Please enter some value!');
    }
    else successStyle(input)
}
function init() {
   // $('signout').addEventListener('click', SignOut);
    let signIn = document.getElementById("signin");
    signIn.addEventListener('click',SignIn);
}

//styles definitions for errors
function errorCaption(error) {
    return "<h4 style='color: #ff1212'>" + error + "</h4>";
}
function errorStyle(inputs, caption) {
    inputs.style.borderColor = "#ff1212";
    let name = inputs.id + "div";
    //name = '"'+name+'"';
    //inputs.placeholder=name;
    //console.log(name);
    let div = document.getElementById(name);
    //inputs.placeholder = name;
    div.innerHTML = errorCaption(caption);
    //inputs.placeholder = "";
    //inputs.placeholder.style.color="#ff0000";
    help = false;
    inputs.classList.add("error");
    //inputs.placeholder = inputs.classList.contains("error");
}

function successStyle(inputs) {
    let name = inputs.id + "div";
    let div = document.getElementById(name);
    //inputs.placeholder = name;
    div.innerHTML = errorCaption("");
    inputs.style.borderColor = "#20ff00";
    inputs.placeholder = "";
    inputs.classList.remove("error")
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
function checkAll(){
    let inputs = document.getElementsByTagName("input");
    let inputLength = inputs.length;
    for (let i = 0; i<inputLength;i++){
        if (inputs[i].value==""){
            errorStyle(inputs[i],"Please enter some value!")
            return false;
        }
    }
    return true;
}
function SignIn(e){
    e.stopPropagation();
    e.stopPropagation();
    //this.stopPropagation();
    //console.log(this.id);

    //submit.preventDefault();
    if (checkAll()) {
       // let form = document.getElementById("form");
        let postData = $("form").serializeArray();
        /*var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                $('error_mess').innerHTML = xmlhttp.responseText;
                if (xmlhttp.responseText === "Succesfull !") {
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
        xmlhttp.send(postData);*/
        let respo
        $.ajax({
            url: 'requires/loadLocationJS.php',
            type: 'POST',
            //data: 'username=' + username + '&email=' + email + '&password=' + password + '&js=' + 1 + "&name=" + name + "&surname=" + surname,
            success: function (res) {
                console.log(res)
                respo = res;
            }

        })
        $.ajax({
            url: 'LogInCheck.php',
            type: 'POST',
            //data: 'username=' + username + '&email=' + email + '&password=' + password + '&js=' + 1 + "&name=" + name + "&surname=" + surname,
            data: postData,
            success: function (response) {
                console.log(response);
                let mess = document.getElementById("error_mess");
                mess.style.color = "red";
                mess.innerHTML = response;
                let captcha = document.getElementById("captcha");
                grecaptcha.reset()
                if (response === "Succesfull !") {
                    //alert(response.error);

                    mess.style.color = "green";

                    window.location.replace('index.php');
                }
            }

        })
    }
}

