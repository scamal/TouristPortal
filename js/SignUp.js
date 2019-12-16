var inputs = document.getElementsByTagName("input");
$('form').on('submit',function (e) {
    e.preventDefault();
    if(submit_function(e)){
        sendAjax();
    }
})
function submit_function(form) {
    /*var help = true;
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "" && inputs[i].className != "conditional") {
            inputs[i].style.borderColor = "#ff1212";
            inputs[i].placeholder = "Invalid input";
            //inputs[i].placeholder.style.color="#ff0000";
            help=false;
        }
        else {
            inputs[i].style.borderColor = "#20ff00";
            inputs[i].placeholder = "";
        }
    }
    return help;*/
    let inputs = document.getElementsByTagName("input");

    for (let i=0;i<inputs.length;i++){
        //alert($(inputs[i]));
        if (inputs[i].classList.contains("error") || (inputs[i].value==="" &&inputs[i].placeholder==="required")){
            //alert("adgafdg");
            alert("Please enter values in all required fields!")
            return false;
        }
    }

    return true;
}
function checkMail(inputs) {
    var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!regex.test(inputs.value) && !(inputs.value == "" && inputs.className != "conditional")) {
        errorStyle(inputs,"Please enter VALID e-mail!");
    } else {
        successStyle(inputs);
    }
    
}
function errorCaption(error) {
    return "<h4 style='color: #ff1212'>"+error+"</h4>";
}
function errorStyle(inputs,caption) {
    inputs.style.borderColor = "#ff1212";
    let name = inputs.id+"div";
    //name = '"'+name+'"';
    //inputs.placeholder=name;
    let div = document.getElementById(name);
    //inputs.placeholder = name;
    div.innerHTML=errorCaption(caption);
    //inputs.placeholder = "";
    //inputs.placeholder.style.color="#ff0000";
    help = false;
    inputs.classList.add("error");
    //inputs.placeholder = inputs.classList.contains("error");
}
function successStyle(inputs) {
    let name = inputs.id+"div";
    let div = document.getElementById(name);
    //inputs.placeholder = name;
    div.innerHTML=errorCaption("");
    inputs.style.borderColor = "#20ff00";
    inputs.placeholder = "";
    inputs.classList.remove("error")
}
function check(inputs){
    var help = true;
    //inputs.placeholder = name;
    if (inputs.value == "" && !inputs.classList.contains("conditional") ) {
        //inputs.placeholder = inputs.classList.value
        errorStyle(inputs,'Please enter some value')
    }
    else if (inputs.id=="Mail"){
            checkMail(inputs);
        }
    else if(inputs.id=="Password"){
        checkPass(inputs);
    }
    else if (inputs.id=="Phone_number"){
        checkPhone(inputs);
    }
    else {
        successStyle(inputs);
    }

}

function checkPass(inputs) {
    let letter = /[a-z]/g;
    let number = /[0-9]/g;
    let text = "";
    let length = inputs.value.length;
    let h = document.getElementById("Passworddiv");
    let helper = true;
    h.innerHTML = "";
    //alert(length);
    let val = inputs.value.toLowerCase();
    if (!val.match(letter)){
        text = text+"<h4 style='color: red'>You didn't enter any letters</h4>";
        helper= false;
    }
    if (!val.match(number)){
        text = text+"<h4 style='color: red'>You didn't enter any numbers</h4>";
        helper= false;
    }
    if (length<8){
        text = text+"<h4 style='color: red'>You didn't enter at least 8 characters</h4>";
        helper= false;
    }
    if (helper){
        successStyle(inputs)

    }
    else{
        errorStyle(inputs);
        h.innerHTML=text;
    }

}
function write_user() {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "getcustomer.php?q="+str, true);
    xhttp.send();
}
function sendAjax() {
    var username = document.querySelector("#Username").value;
    var email = document.querySelector("#Mail").value;
    var password = document.querySelector("#Password").value;
    //var phone = document.querySelector("#Phone_number").value;
    var name = document.querySelector("#Name").value;
    var surname = document.querySelector("#Last_name").value;
    var ajaxMessage = document.querySelector('#ajax-message');
    var form  = document.querySelector("form");

    $.ajax({
        url: 'SignUpCheck.php',
        type: 'GET',
        data: 'username='+username+'&email='+email+'&password='+password+'&js='+1+"&name="+name+"&surname="+surname,
        success: function (response) {

            if(response.error) {
                alert(response.error);

            } else {
                alert(response.success);
                window.location.href = "/web_project/lost_or_found.html";
                form.reset();
            }
        }
    })
}