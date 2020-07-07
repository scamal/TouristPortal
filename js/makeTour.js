$(document).ready(function () {
    /*var buttons = document.getElementsByTagName("button");
    for (let i=0;i<buttons.length;i++){
        buttons[i].addEventListener('click',function () {
            makeString(buttons[i]);
        });

    }*/
    createMap();




})
var locationsIDString="";
let count = 0;
let longt;
let lat;
let locationIDArr = [];
var maplayer = undefined;
function makeString(t) {



    let doNotAdd=0;
    locationsIDString+=t.toString()+", ";
    console.log(locationsIDString)
    locationIDArr.push(t);

    /*for (let i=0;i<splited.length;i++){
        if (splited[i]==t.id){
            doNotAdd=1;
            //console.log("do not add = 1")
        }
    }*/

    let tour = document.getElementById("tour");
  //  if (doNotAdd==0) {
        //locationString =" " + locationString + t.id + " ";
        //console.log(locationString);
        let id = t;
        //console.log(i);
        button = document.getElementById(id).outerHTML;
        let row = document.getElementById(id+"row").innerHTML;
        locID = id



        //console.log('<button id="'+locID+'" class="btn btn-primary">Add to tour</button>')
        //console.log(row);

        //make locations IDs

        //locationsIDString+=t.id+", ";
        //locationIDArr.push(t.id);


        //sendAjax for location


        $.ajax({
            url: 'requires/getLocationInfo.php',
            async: false,
            type: 'POST',
            dataType: 'json',
            data: {location_ID: id},
           // data: 'location_ID=' + t.id,
            success: function (response) {

                if (response.error) {
                    alert(response.error);

                } else {
                    //console.log(response.lat);
                    //console.log(response.longt);
                    // ovo je obrnuto zbog greske u phpu

                    lat = response.longt;
                    longt = response.lat;
                    //console.log(longt);
                    //addMarker(longt,lat);




                    //window.location.href = "index.php";
                   // form.reset();
                }
            }


        });

        //endofAjax


        waypoints = addWaypoint(longt,lat);
        row = row.replace(button,'<button id=remove'+locID+' onclick="removeWaypoint('+locID+','+longt+','+lat+')" class="btn btn-primary removeLoc">Remove</button>')
    tour.innerHTML += row;


        if (waypoints.length>1){

            //console.log(makeUserRoute(waypoints))
            //let route = makeUserRoute(waypoints);
            L.mapquest.directions().route({

                waypoints: waypoints
            });
            document.getElementById("buttons").innerHTML="<label for='tourName'>Tour name: </label><br><input type='text' name='tourName' style='width: 50vw' id='tourName'><br><label for='tourDesc'>Tour description: </label><br><textarea rows=\"4\" style='width: 50vw' name='tourDesc' id='tourDesc'></textarea><br>" +
                "<br><div class=\"custom-control custom-checkbox\">\n" +
                "  <input type=\"checkbox\" class=\"custom-control-input\" checked='true' id=\"makePublic\" name='makePublic' value='MakeIt'>\n" +
                "  <label class=\"custom-control-label\" for=\"makePublic\">Make tour public</label>\n" +
                "</div>" +
                "<br><button id='postTour' class='btn btn-primary' onclick='insertTour()'>Save your tour</button>";

        }
        //waypoints = ;

       //makeUserRoute("[44.82481, 20.453211],[44.72481, 20.553211],");
        /*L.mapquest.directions().route({

            waypoints: [makeUserRoute(waypoints)]
        });*/
       /* L.mapquest.directions().route({

            waypoints: [[44.82481,20.453211]]
        });*/




        //console.log(longt+"sddsfsd");

  //  }
    count++;
    //console.log(count)
    if (waypoints.length==1){
        addMarker(longt,lat);
    }


}
var map;
function createMap(){
    L.mapquest.key = 'sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB';

// 'map' refers to a <div> element with the ID map
     map = L.mapquest.map('map', {
        center: [44.82481, 20.453211],
        layers: L.mapquest.tileLayer('map'),
        zoom: 10
    });
     
}
function reloadMap(longi,lati) {
    L.mapquest.key = 'sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB';
    //map.layers =  L.mapquest.tileLayer('map');
    map.off();
    map.remove();
    L.mapquest.key = 'sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB';

// 'map' refers to a <div> element with the ID map
    map = L.mapquest.map('map', {
        center: [longi, lati],
        layers: L.mapquest.tileLayer('map'),
        zoom: 10
    });
}
function addMarker(longt,lat){
    //console.log(lat + "\n "+longt+"sdfsdf");
    L.marker([longt, lat], {
        icon: L.mapquest.icons.marker(),
        draggable: false
    }).bindPopup('Denver, CO').addTo(map);
}
//replace at prototype

String.prototype.replaceAt=function(index, replacement) {
    return this.substr(0, index) + replacement+ this.substr(index + replacement.length);
}

var waypoints=new Array();
var ArrayWaypoints = new Array();
//var locations = new Array();
function addWaypoint(longt,lat){
    waypoints+="["+longt+","+lat+"], ";
    longt = parseFloat(longt);
    lat = parseFloat(lat);
    ArrayWaypoints.push([longt,lat]);
    console.log(ArrayWaypoints);
    return ArrayWaypoints;
}
function makeUserRoute(waypoints){

    waypoints = waypoints.toString().slice(0,waypoints.length-2);
   // console.log(waypoints+" this is not the way");

    //locations.push([longt,lat]);

    //let URL = "http://www.mapquestapi.com/directions/v2/route?key=sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB&json=%7B%22locations%22%3A%5Bnull%2C%7B%22latLng%22%3A%7B%22lat%22%3A44.82481%2C%22lng%22%3A20.453211%7D%7D%2C%7B%22latLng%22%3A%7B%22lat%22%3A44.72481%2C%22lng%22%3A20.553211%7D%7D%2Cnull%5D%2C%22options%22%3A%7B%22shapeFormat%22%3A%22cmp6%22%2C%22timeType%22%3A1%2C%22useTraffic%22%3Atrue%2C%22conditionsAheadDistance%22%3A200%2C%22generalize%22%3A0%7D%7D"
    //return waypoints;

}
/*function displayTour(t){
   // console.log("clicked");
    var splited =  locationString.split(" ");
    for (let i=0;i<splited.length;i++){
        let id = t.id+"row";
        console.log(i);
        let row = document.getElementById(id).outerHTML;

        //console.log(row);
        let tour = document.getElementById("tour");
        tour.innerHTML += row;
    }
}*/

function insertTour() {
    //let splitedLS = locationString.split(" ");
    let sql = "select * from locations where ";
    let name = document.getElementById("tourName").value;
    let desc = document.getElementById("tourDesc").value;
    let makePublic = document.getElementById('makePublic').checked;
    console.log(locationsIDString)
    if (waypoints.length>1){
        $.ajax({
            url: 'requires/insertTour.php',
            async: false,
            type: 'POST',
            dataType: 'json',
            data: {location_ID: locationsIDString.replace("+",""),locationArr: locationIDArr, tourName:name,tourDesc:desc,makePublic: makePublic},
            // data: 'location_ID=' + t.id,
            success: function (response) {

                if (response.saved) {
                    var txt;
                    if (confirm(response.saved)) {
                        $.ajax({
                            url: 'requires/addToMyTours.php',
                            async: false,
                            type: 'POST',
                            dataType: 'json',
                            data: {tour_ID: response.lastIndex},
                            success: function (res) {

                            }
                        });
                    } else {
                        //txt = "You pressed Cancel!";
                    }

                } else {
                    alert(response.status);
                    //console.log(response.lat);
                    //console.log(response.longt);
                    // ovo je obrnuto zbog greske u phpu
                    //locationsIDString+=t.id+" ";

                    //console.log(longt);
                    //addMarker(longt,lat);




                    //window.location.href = "index.php";
                    // form.reset();
                }
            }


        });
    }
    else {
        alert("Please add more than one location.")
    }

}
function removeWaypoint(locID,longi,lati) {
    delWaypoint(longi,lati);
    locationsIDString = locationsIDString.replace(locID+", ",'')
    locationIDArr = locationIDArr.filter(ID=>ID==locID);
    count--;
    let btn = document.getElementById("remove"+locID);
    let td = btn.parentElement;
    let tr = td.parentElement;
    tr.remove();
    console.log(waypoints,waypoints!=undefined);
    if (waypoints[0]!=undefined){
        console.log(waypoints[0][1])
        reloadMap(waypoints[0][0],waypoints[0][1]);
        console.log(waypoints);
        routes = []
        document.getElementById("buttons").innerHTML="<label for='tourName'>Tour name: </label><br><input type='text' name='tourName' style='width: 50vw' id='tourName'><br><label for='tourDesc'>Tour description: </label><br><textarea rows=\"4\" style='width: 50vw' name='tourDesc' id='tourDesc'></textarea><br>" +
            "<br><div class=\"custom-control custom-checkbox\">\n" +
            "  <input type=\"checkbox\" class=\"custom-control-input\" checked='true' id=\"makePublic\" name='makePublic' value='MakeIt'>\n" +
            "  <label class=\"custom-control-label\" for=\"makePublic\">Make tour public</label>\n" +
            "</div>" +
            "<br><button id='postTour' class='btn btn-primary' onclick='insertTour()'>Save your tour</button>";
        if (waypoints.length>1){
            routes.push(L.mapquest.directions().route({

                    waypoints: waypoints
                })
            )

            //console.log(makeUserRoute(waypoints))
            //let route = makeUserRoute(waypoints);
        }
        else if (waypoints.length==1){
            addMarker(waypoints[0][0],waypoints[0][1]);
        }

    }
    else {
        console.log('Reload')
        map.off();
        map.remove();
        createMap();
    }


}
function delWaypoint(longi,lati){
    longi = parseFloat(longi);
    lati = parseFloat(lati);
    let newWaypoints = [];
    let longilat = [longi,lati]
    for (let i=0;i<waypoints.length;i++){
        console.log(waypoints[i].toString()===longilat.toString());

        if (waypoints[i].toString()!=longilat.toString()){
            newWaypoints.push(waypoints[i]);
        }
    }

    waypoints = newWaypoints;
    console.log(waypoints);
    ArrayWaypoints = waypoints;
    return ArrayWaypoints;
}
function check(wayp){
    return wayp!=[longt,lat]
}
