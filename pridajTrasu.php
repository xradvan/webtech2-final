<?php

$start = $_GET["start"];
$lat1  =  $_GET["lat1"];
$lng1  = $_GET["lng1"];
$end   =  $_GET["end"];
$lat2  =  $_GET["lat2"];
$lng2  =  $_GET["lng2"];
$dis  =  $_GET["dis"]/1000;
$modTrasy = "privátny";

require ("config.php");
// Create connection
$conn = new mysqli($servername, $username, $password , $dbname);
$conn->set_charset("UTF8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO trasa (start_nazov, start_lat, start_long,ciel_nazov,ciel_lat,ciel_long,prejdene_km,celkove_km,aktivna_trasa,datum_vytvorenia,mod_trasy)
                VALUES ('" . $start . "', '" . $lat1 . "','" . $lng1 . "','" . $end . "','" . $lat2 . "','" . $lng2 . "',0,$dis,0,'".date("Y-m-d H:i:s")."','" . $modTrasy . "')";

echo $sql."<br><br>";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: cesty.php");