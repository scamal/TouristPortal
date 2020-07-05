$(document).ready(function () {
    createMap();
})


function addToMyTour(tour_ID) {
    event.stopPropagation();
    $.ajax({
        url: 'requires/addToMyTours.php',
        /*async: false,*/
        type: 'POST',
        dataType: 'json',
        data: {tour_ID: tour_ID},
        success: function (res) {
            alert(res.message);
        }
    });
}
var map;
function createMap(){
    L.mapquest.key = 'sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB';
    map = L.mapquest.map('map', {
        center: [44.82481, 20.453211],
        layers: L.mapquest.tileLayer('map'),
        zoom: 10
    });
}
function viewMap(waypoints,startLat,startLong) {
    if (startLat>=-90 && startLat<=90 && startLong>=-180 && startLong<=180){
        waypoints.unshift([startLat,startLong]);
    }
    document.getElementById("container").style.visibility = "visible";


// 'map' refers to a <div> element with the ID map
    map.off();
    map.remove();
    L.mapquest.key = 'sDMUILZdl1SrnPDJV4e6vn8jmhh4gKcB';
    map = L.mapquest.map('map', {
        center: [44.82481, 20.453211],
        layers: L.mapquest.tileLayer('map'),
        zoom: 10
    });
    //console.log(tour_ID);
    L.mapquest.directions().route({

        waypoints: waypoints

    });
    for (let i =0; i<waypoints.length;i++){
        console.log(waypoints[i]);

    }
}
function removeTour(id) {
    $.ajax({
        url: 'requires/removeTour.php',
        /*async: false,*/
        type: 'POST',
        data: {tour_ID: id},
        success: function (res) {
            alert(res);
            refreshTours();
        }
    });
}
function refreshTours() {
    table = document.getElementById("table");
    table.innerHTML =     $.ajax({
        url: 'refreshTable.php',
        /*async: false,*/
        type: 'POST',
        data: {},
        success: function (res) {
            table.innerHTML = res;
        }
    });
}