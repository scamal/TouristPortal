function addAdmin(user) {
    $.ajax({
        url: 'addAdmin.php',
        /*async: false,*/
        type: 'POST',
        data: {user: user},
        success: function (res) {
            alert(res);
            location.reload();
        }
    });
}
function removeAdmin(user) {
    $.ajax({
        url: 'removeAdmin.php',
        /*async: false,*/
        type: 'POST',
        data: {user: user},
        success: function (res) {
            alert(res);
            location.reload();
        }
    });
}
function deleteUser(user) {
    $.ajax({
        url: 'deleteUser.php',
        /*async: false,*/
        type: 'POST',
        data: {user: user},
        success: function (res) {
            alert(res);
            location.reload();
        }
    });
}
var count = 0;
function editLoc(id,toEdit,selected,val) {
    changeMapEdit('form');
    if (selected.id!=undefined){
        td = document.getElementsByClassName(selected.id)[0]
        if (td.style.display=="none") {
            td.style.display = "table-cell"
        }
        else {
            td.style.display = "none"
        }
    }
    else {
    }

}
function sendToEditLoc(id,toEdit,selected) {
    var input = document.getElementsByClassName(toEdit+id);
    if (input[1]!=undefined) {
            if (input[2]!=undefined) {
                    $.ajax({
                        url: 'editLoc.php',
                        /*async: false,*/
                        type: 'GET',
                        data: {idToEdit: id, edit: toEdit, editSimple: input[1].value, longitude: input[2].value},
                        success: function (res) {
                            alert(res);
                            updateRow();

                        }
                    });
                    return 0;
            }
        $.ajax({
            url: 'editLoc.php',
            /*async: false,*/
            type: 'GET',
            data: {idToEdit: id, edit: toEdit, editSimple: input[1].value},
            success: function (res) {
                alert(res);
                updateRow();
            }
        });
        return 0;
    }
    var editSimple = input[1].value;
    if (input[2]!=undefined){
        if (input[2].value!=''){
            var longitude = input[2].value;
            console.log(longitude);
        }

    }

    console.log(editSimple);


}
function updateRow() {
    cont = document.getElementById("mainContainer");
    $.ajax({
        url: 'updateRow.php',
        /*async: false,*/
        type: 'GET',
        data: {},
        success: function (res) {
            cont.innerHTML = res;
        }
    });

}
function displayAddLocation() {
    changeMapEdit('form');
    var div = document.getElementById("addLocation");
    var smt = document.getElementById("this");
    if (div.style.display=="none"){
        div.style.display = "inline";
        smt.innerHTML = "Hide form";
    }
    else {
        div.style.display = "none";
        smt.innerHTML = "Add location";
    }


}
function updateLocationSimpleData(id,e) {
    var counter = e.id;
    var x = document.querySelector("button#counter");

    x = x.value;
    console.log(x);
    var update = document.getElementById('processData').className.split();
    if (update.length==1) {
        $.ajax({
            url: 'editLoc.php',
            /*async: false,*/
            type: 'GET',
            data: {
                idToEdit: id,
                edit: update[0],
                editSimple: x
            },
            success: function (res) {
                alert(res);
                location.reload();
            }
        });
    }
    else if (update.length==2){
        $.ajax({
            url: 'editLoc.php',
            /*async: false,*/
            type: 'GET',
            data: {
                idToEdit: id,
                edit: update[0],
                editSimple: x,
                longitude: update[1]
            },
            success: function (res) {
                alert(res);
                location.reload();
            }
        });
    }
}
function updateImageLoc(id,toEdit,selected,val) {
    if (selected.id!=undefined){
        td = document.getElementsByClassName(selected.id)[0]
        if (td.style.display=="none") {
            td.style.display = "table-cell"
        }
        else {
            td.style.display = "none"
        }
    }
}
function sendToUpdateImage(id,image,selected,picture){
    var form = document.getElementById("updateImageForm"+id);
    var formData = new FormData();
    var file = document.getElementById("file"+id).files[0];
    var imgLink = document.getElementById("imgLink"+id).value;
    formData.append('file',file);
    formData.append('id',id);
    formData.append('imgLink',imgLink);
    $.ajax({
        url: 'updateImage.php',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(response != 0){
                alert(response)
                updateRow();
            }else{
                alert('File not uploaded');
            }
        },
    });

}
function sendAddLocationForm(e) {
    changeMapEdit('form','');
    var form = document.getElementById("addLocationForm");
    var url = "addLocation.php";
    form = $('form')[0];
    var formData = new FormData();
    let locNm = document.getElementById("locNm").value;
    let desc = document.getElementById("desc").value;
    let longt = document.getElementById("longt").value;
    let lat = document.getElementById("lat").value;
    let imageName = document.getElementById("imageName").value;
    formData.append('locNm',locNm);
    formData.append('desc',desc);
    formData.append('longt',longt);
    formData.append('lat',lat);
    formData.append('imageName',imageName);
    let formImage = document.getElementById("formImage").files[0];
    formData.append('file', formImage)

    $.ajax({
        type: "POST",
        url: url,
        data: formData, // serializes the form's elements.
        contentType: false,
        processData: false,
        success: function(response)
        {
            alert(response); // show response from the php script.
            updateRow();
            restartMap();
        },
    });
}
function deleteLocation(ids) {
    $.ajax({
        url: 'deleteLocation.php',
        /*async: false,*/
        type: 'POST',
        data: {id: ids},
        success: function (res) {
            alert(res);
            updateRow();
        }
    });
}
function filterStats(id) {
    let select = document.getElementById(id).value;
    console.log(select+", "+id);
    $.ajax({
        url: 'filterStats.php',
        /*async: false,*/
        type: 'POST',
        data: {key: id, value: select},
        success: function (res) {
            document.getElementById('mainContainer').innerHTML = res
            statsJs();
        }
    });

}
function changeMapEdit(id) {
    console.log("sadfasdf");
    let latlong = document.getElementById("latlongToEdit");
    latlong.value = id;
}
if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(str) {
        return this.lastIndexOf(str, 0) === 0;
    };
}

