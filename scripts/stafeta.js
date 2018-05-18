var place,place2;
var lat1,lat2,lng1,lng2,dis;
var directionsService;
var directionsDisplay;

var map;

if (window.location.href.indexOf("lat1=") > -1) {


    var url_string = window.location.href;
    var url = new URL(url_string);
    lat1 = Number(url.searchParams.get("lat1"));
    lng1 = Number(url.searchParams.get("lng1"));
    lat2 = Number(url.searchParams.get("lat2"));
    lng2 = Number(url.searchParams.get("lng2"));

    console.log(lat1);
    console.log(lat2);
    console.log(lng1);
    console.log(lng2);


}

function myMap() {
    var myLatLng = {lat: 48.6737532, lng: 19.696058};
    var mapProp = {
        center: myLatLng,
        zoom: 7
    };

    map = new google.maps.Map(document.getElementById("myMap"), mapProp);

    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);

    var myLatLng1 = {lat: lat1, lng: lng1};
    var myLatLng2 = {lat: lat2, lng: lng2};


    var marker = new google.maps.Marker({
        position: myLatLng1,
        map: map,
        title: 'A'
    });
    var marker2 = new google.maps.Marker({
        position: myLatLng2,
        map: map,
        title: ' '
    });


    var request = {
        origin      : myLatLng1,
        destination : myLatLng2,
        travelMode  : google.maps.DirectionsTravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);

            // dis = response.routes[0].legs[0].distance.value;
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}