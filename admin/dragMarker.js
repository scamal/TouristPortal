if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(str) {
        return this.lastIndexOf(str, 0) === 0;
    };
}

var mapLayer = MQ.mapLayer();
var mapLeaflet;

var latLng = new L.LatLng(44.82, 20.44);

showLL(latLng, '');

var map = L.map('lat-long-map', {
    layers: mapLayer,
    center: latLng,
    zoom: 12
}).on('click', function(e) {
    addMarker(e);
});

L.control.layers({
    'Map': mapLayer,
    'Dark': MQ.darkLayer(),
    'Light': MQ.lightLayer(),
    'Satellite': MQ.satelliteLayer()
}).addTo(map);

var mapQuestMarker = L.icon({
    iconUrl: MQ.mapConfig.getConfig("imagePath") + 'poi.png',
    iconRetinaUrl: MQ.mapConfig.getConfig("imagePath") + 'poi@2x.png',
    iconSize: [36, 35],
    iconAnchor: [15, 35],
    popupAnchor: [-1, -30]
});

var popup = L.marker(latLng, {icon: mapQuestMarker, draggable: true}).addTo(map);

popup.on('dragend', function(event) {
    var marker = event.target;
    var position = marker.getLatLng().wrap();
    showLL(position, 'USER_DEFINED');
});
function restartMap() {

    if (!String.prototype.startsWith) {
        String.prototype.startsWith = function(str) {
            return this.lastIndexOf(str, 0) === 0;
        };
    }
    var removeScript = document.getElementById('removeScript');
    removeScript.remove();
    let mapCont =document.getElementById('map_container');
    mapCont.innerHTML ="<div id=\"lat-long-mp\" style=\"height:50vh\">&nbsp;</div>"

    var head= document.getElementsByTagName('body')[0];
    var script= document.createElement('script');
    script.src= 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js';
    script.id = 'removeScript';
    head.appendChild(script);

    var mapLayer = MQ.mapLayer();
    var mapLeaflet;

    var latLng = new L.LatLng(44.82, 20.44);

    showLL(latLng, '');
    var map = new L.map('lat-long-mp', {
        layers: mapLayer,
        center: latLng,
        zoom: 12
    }).on('click', function(e) {
        addMarker(e);
    });

    L.control.layers({
        'Map': mapLayer,
        'Dark': MQ.darkLayer(),
        'Light': MQ.lightLayer(),
        'Satellite': MQ.satelliteLayer()
    }).addTo(map);

    var mapQuestMarker = L.icon({
        iconUrl: MQ.mapConfig.getConfig("imagePath") + 'poi.png',
        iconRetinaUrl: MQ.mapConfig.getConfig("imagePath") + 'poi@2x.png',
        iconSize: [36, 35],
        iconAnchor: [15, 35],
        popupAnchor: [-1, -30]
    });

    var popup = L.marker(latLng, {icon: mapQuestMarker, draggable: true}).addTo(map);

    popup.on('dragend', function(event) {
        var marker = event.target;
        var position = marker.getLatLng().wrap();
        showLL(position, 'USER_DEFINED');
    });


    }
function roundNumber(num, dec) {
    return Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
}

function popInfo() {
    street = document.getElementById("street").value;
    city = document.getElementById("city").value;
    state = document.getElementById("state").value;
    postal = document.getElementById("postalCode").value;
    country = document.getElementById("country").value;

    if (document.getElementById("country").value == "") {
        country = "US";
    } else {
        country = document.getElementById("country").value;
    }
    simpleGeocode();
}

function clearMap() {
    document.getElementById('resultDiv').innerHTML = strResult;
    document.getElementById("street").value = "";
    document.getElementById("city").value = "";
    document.getElementById("state").value = "";
    document.getElementById("postalCode").value = "";
}

function addMarker(e) {
    popup.setLatLng(e.latlng);
    showLL(e.latlng.wrap(), 'USER_DEFINED');
}

function simpleGeocode() {
    var geocode = MQ.geocode()
        .search({
            'street': street,
            'city': city,
            'state': state,
            'postalCode': postal,
            'adminArea1': country
        })
        .on('success', function(e) {
            var best = e.result.best;
            var latlng = best.latlng;

            var quality = best.geocodeQualityCode;

            map.setView(latlng, getZoomFromResultCode(quality));

            popup.setLatLng(latlng);

            showLL(latlng, quality);
        });
}

function getZoomFromResultCode(resultCode) {
    var zoom = 12;
    if (resultCode.startsWith("P") || resultCode.startsWith("L") || resultCode.startsWith("B")
        || resultCode.startsWith("I")) {
        zoom = 15;
    } else if (resultCode.startsWith("Z") || resultCode.startsWith("A5")) {
        zoom = 12;
    } else if (resultCode.startsWith("A4")) {
        zoom = 9;
    } else if (resultCode.startsWith("A3")) {
        zoom = 5;
    } else if (resultCode.startsWith("A1")) {
        zoom = 2;
    }

    return zoom;
}

function showLL(ll, quality) {
    let toEdit = document.getElementById('latlongToEdit').value;
    var Lat = document.getElementById('lat');
    var Longt = document.getElementById('longt');
    console.log(toEdit)
    if (toEdit!='form'){
        console.log("not form")
    }
    Lat.value = ll.lat;
    Longt.value = ll.lng;

}

function searchKeyPress(e) {
    if (window.event) {
        e = window.event;
    }
    if (e.keyCode == 13) {
        document.getElementById('btnGC').click();
    }
}
