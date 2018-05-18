var place,place2;
var lat1,lat2,lng1,lng2,dis;
var directionsService;
var directionsDisplay;
var directionsDisplay2;
var map;
var map2;

var directions={};



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




    //
    var routes=[
        { label:'',
            request:{
                origin: new google.maps.LatLng(lat1, lng1),
                destination: new google.maps.LatLng(lat2, lng2),
                travelMode: google.maps.DirectionsTravelMode.DRIVING},
            rendering:{marker:{icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'},draggable:false}
        }
    ];

    var bounds=new google.maps.LatLngBounds();


    var dists=[vzd*1000];
    console.log(vzd);
    var selects=document.createElement('select');
    selects.style.visibility = "hidden";

    list=document.getElementsByTagName('ul')[0];

    for(var d=0;d<dists.length;++d)
    {
        selects.options[selects.options.length]=new Option(dists[d],dists[d],d==0,d==0);
    }

    for(var r=0;r<routes.length;++r)
    {
        bounds.extend(routes[r].request.destination);
        routes[r].rendering.routeId='r'+r+new Date().getTime();
        routes[r].rendering.dist=dists[0];
        var select=selects.cloneNode(true);

        select.setAttribute('name',routes[r].rendering.routeId);

        select.onchange=function(){directions[this.name].renderer.dist=this.value;
            setMarkers(this.name)};

        list.appendChild(document.createElement('li'));
        list.lastChild.appendChild(select);
        list.lastChild.appendChild(document.createTextNode(routes[r].label));

        requestRoute(routes[r],map);
    }

    map.fitBounds(bounds);
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

function setMarkers(ID)
{
    var direction=directions[ID],
        renderer=direction.renderer,
        dist=renderer.dist,
        marker=renderer.marker,
        map=renderer.getMap(),
        dirs=direction.renderer.getDirections();
    marker.map=map;

    for(var k in direction.sets)
    {

        var set=directions[ID].sets[k];
        set.visible=!!(k===dist);

        for(var m=0;m<set.length;++m)
        {

            set[m].setMap((set.visible)?map:null);
        }
    }
    if(!direction.sets[dist])
    {
        if(dirs.routes.length)
        {
            var route=dirs.routes[0];
            var az=0;
            for(var i=0;i<route.legs.length;++i)
            {

                if(route.legs[i].distance)
                {
                    az+=route.legs[i].distance.value;
                }

            }
            dist=Math.max(dist,Math.round(az/100));
            direction.sets[dist]=gMilestone(route,dist,marker);

        }
    }
}

function requestRoute(route,map)
{
    if(!window.gDirSVC)
    {
        window.gDirSVC = new google.maps.DirectionsService();
    }

    var renderer=new google.maps.DirectionsRenderer(route.rendering);
    var renderer=new google.maps.DirectionsRenderer(route.rendering);
    renderer.setMap(map);
    renderer.setOptions({preserveViewport:true})


    google.maps.event.addListener(renderer, 'directions_changed', function() {

        if(directions[this.routeId])
        {
            //remove markers
            for(var k in directions[this.routeId].sets)
            {
                for(var m=0;m<directions[this.routeId].sets[k].length;++m)
                {
                    directions[this.routeId].sets[k][m].setMap(null);
                }
            }
        }

        directions[this.routeId]={renderer:this,sets:{}};
        setMarkers(this.routeId);

    });

    window.gDirSVC.route(route.request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            renderer.setDirections(response);
        }
    });
}

function gMilestone(route,dist,opts)
{

    var markers=[],
        geo=google.maps.geometry.spherical,
        path=route.overview_path,
        point=path[0],
        distance=0,
        leg,
        overflow,
        pos;
    var limit = 0;
    for(var p=1;p<path.length;++p)
    {

        leg=Math.round(geo.computeDistanceBetween(point,path[p]));
        d1=distance+0
        distance+=leg;
        overflow=dist-(d1%dist);


        if(distance>=dist && leg>=overflow)
        {
            if(overflow && leg>=overflow)
            {
                pos = geo.computeOffset(point, overflow, geo.computeHeading(point, path[p]));
                opts.position = pos;
                limit++;
                if (limit > 1) {
                    opts.visible = false;
                }
                markers.push(new google.maps.Marker(opts));
                distance -= dist;
            }
            while(distance>=dist)
            {

                pos = geo.computeOffset(point, dist + overflow, geo.computeHeading(point, path[p]));
                opts.position = pos;
                markers.push(new google.maps.Marker(opts));
                distance -= dist;


            }
        }
        point=path[p]
    }
    return markers;
}