var place,place2;
var lat1,lat2,lng1,lng2,dis;
var directionsService;
var directionsDisplay;
var directionsDisplay2;
var map;
var map2;




$("#privateBtn").on('click', function () {
    $(".addDiv").slideToggle();

    $(".addDiv button:last-child").attr('id', 'insertBtn');
});

$("#publicBtn").on('click', function () {
    $(".addDiv").slideToggle();
    $(".addDiv button:last-child").attr('id', 'insertBtnP');

});

$("#relayBtn").on('click', function () {
    $(".addDiv").slideToggle();
    $(".addDiv button:last-child").attr('id', 'insertBtnR');

});

$(document).on('click','#insertBtn', function () {
    window.location.href = "pridajTrasu.php?lat1="+lat1+"&lng1="+lng1+"&lat2="+lat2+"&lng2="+lng2+"&start="+$("#formGroupExampleInput").val()+"&end="+$("#formGroupExampleInput2").val()+"&dis="+dis;
});

$(document).on('click','#insertBtnP', function () {
    window.location.href = "pridajVerejne.php?lat1="+lat1+"&lng1="+lng1+"&lat2="+lat2+"&lng2="+lng2+"&start="+$("#formGroupExampleInput").val()+"&end="+$("#formGroupExampleInput2").val()+"&dis="+dis;
});

$(document).on('click','#insertBtnR', function () {
    window.location.href = "pridajStafeta.php?lat1="+lat1+"&lng1="+lng1+"&lat2="+lat2+"&lng2="+lng2+"&start="+$("#formGroupExampleInput").val()+"&end="+$("#formGroupExampleInput2").val()+"&dis="+dis;
});

function myMap() {
    var myLatLng = {lat: 48.6737532, lng: 19.696058};
    var mapProp= {
        center:myLatLng,
        zoom:7
    };
    var mapProp2= {
        center:myLatLng,
        zoom:6
    };
    map = new google.maps.Map(document.getElementById("myMap"),mapProp);
    map2 = new google.maps.Map(document.getElementById("myMap2"),mapProp2);

    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay2 = new google.maps.DirectionsRenderer;
    /*----------------------------------------------------------*/

    var start = document.getElementById('formGroupExampleInput');
    var ciel = document.getElementById('formGroupExampleInput2');

    var autocomplete = new google.maps.places.Autocomplete(start);
    var autocomplete2 = new google.maps.places.Autocomplete(ciel);

    var marker = new google.maps.Marker({
        map: map2,
        anchorPoint: new google.maps.Point(0, -29)
    });

    var marker2 = new google.maps.Marker({
        map: map2,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        marker.setVisible(false);
        place = autocomplete.getPlace();
        lat1 = place.geometry.location.lat();
        lng1 = place.geometry.location.lng();

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    });

    autocomplete2.addListener('place_changed', function() {
        marker2.setVisible(false);
        place2 = autocomplete2.getPlace();
        lat2 = place2.geometry.location.lat();
        lng2 = place2.geometry.location.lng();
        marker2.setPosition(place2.geometry.location);
        marker2.setVisible(true);
    });


    directionsDisplay2.setMap(map);
    directionsDisplay.setMap(map2);

    $("#searchBtn").on('click', function () {
        var request = {
            origin      : place.geometry.location,
            destination : place2.geometry.location,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING
        };

        directionsService.route(request, function(response, status) {
            if (status === 'OK') {
                $(".addDiv button:last-child").fadeIn();
                directionsDisplay.setDirections(response);
                dis = response.routes[0].legs[0].distance.value;
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });

    });

    if (window.location.href.indexOf("lat1=") > -1) {

        console.log(lat1);
        console.log(lng1);
        console.log(lat2);
        console.log(lng2);

        var request3 = {
            origin      : new google.maps.LatLng(lat1,lng1),
            destination : new google.maps.LatLng(lat2,lng2),
            travelMode  : google.maps.DirectionsTravelMode.DRIVING
        };

        directionsService.route(request3, function(response, status) {
            if (status === 'OK') {
                $("#insertBtn").fadeIn();
                directionsDisplay2.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
}
/*
function urobTrasu(lat1,lng1,lat2,lng2){
    var request = {
        origin      : {lat: lat1, lng:lng1},
        destination : {lat: lat2, lng:lng2},
        travelMode  : google.maps.DirectionsTravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
        if (status === 'OK') {
            $("#insertBtn").fadeIn();
            directionsDisplay2.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });

}*/