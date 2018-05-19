<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/prologue.css">
    <title>Úvodná stránka</title>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <span class="navbar-brand" id="vitajte" href="#"><b>Vitajte!</b></span>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#" name="adresa_uzivatel" onclick="adresaUzivatelia();">Adresy užívateľov</a></li>
            <li><a href="#" name="adresa_skoly" onclick="adresaSkoly();">Adresy škôl</a></li>
            <li><a href="dokumentacia.php" name="adresa_skoly">Dokumentácia</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="security/registracia.php"><span class="glyphicon glyphicon-user"></span> Registrácia</a></li>
            <li><a href="security/prihlasenie.php"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Prihlásenie</a></li>
        </ul>
    </div>
</nav>
<br>
<h1 class="text-center text-primary">Vitajte na našom portáli!</h1>
<div id="googleMap" style="width:80%;"></div>
<?php
    require ('config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

    $query = "SELECT stredna_skola,stredna_skola_adresa, count(stredna_skola) as pocet FROM `pouzivatelia` GROUP BY stredna_skola, stredna_skola_adresa";
    $result = mysqli_query($conn,$query);


    echo "<script>";
    echo "var strednaSkolaAdresa = [";
    while ($data = mysqli_fetch_array($result))
    {
        echo "[";
        echo "'{$data['stredna_skola_adresa']}',";
        echo "'{$data['pocet']}',";
        echo "],";
    }
    echo "];";
    echo "</script>";

    $query="SELECT obec from pouzivatelia";
    $result = mysqli_query($conn,$query);

    echo "<script>";
    echo "var UzivatelAdresa = [";
    while ($data = mysqli_fetch_array($result))
    {
        echo "'{$data['obec']}',";

    }
    echo "];";
    echo "</script>";
?>

<script>
    var map;
    var geocoder;
    var markers = [];
    function myMap() {
        geocoder = new google.maps.Geocoder();
        var myLatLng = {lat: 48.6737532, lng: 19.696058};
        var mapProp= {
            center:myLatLng,
            zoom:7.8
        };
        map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }

    function adresaUzivatelia(){
        removeMarkers();
        for (var i = 0; i < UzivatelAdresa.length; i++) {
            var address = UzivatelAdresa[i];
            geocoder.geocode({'address': address}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        title: results[0].address_components[0].long_name,
                        animation: google.maps.Animation.DROP,
                        position: results[0].geometry.location
                    });
                    markers.push(marker);
                }
            });
        }
    }

    function adresaSkoly(){
        removeMarkers();
        for (var i = 0; i < strednaSkolaAdresa.length; i++) {
            var adresa = strednaSkolaAdresa[i][0];
            var pocet = 0;
            geocoder.geocode({'address': adresa}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        label:strednaSkolaAdresa[pocet][1],
                        animation: google.maps.Animation.DROP,
                        position: results[0].geometry.location
                    });
                    markers.push(marker);
                    pocet++;
                }
            });
        }
    }

    function removeMarkers(){
        for(i=0; i<markers.length; i++){
            markers[i].setMap(null);
        }
    }



</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArw-eyIcflcUehHyPzWx5FRzAr6EEI_68&callback=myMap"></script>
</body>
</html>