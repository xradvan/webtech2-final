<?php
session_start();
$start = $_GET["start"];
$lat1  =  $_GET["lat1"];
$lng1  = $_GET["lng1"];
$end   =  $_GET["end"];
$lat2  =  $_GET["lat2"];
$lng2  =  $_GET["lng2"];
$dis  =  $_GET["dis"]/1000;
$modTrasy = "štafetový";
$meno = $_SESSION['meno'];
$priezvisko = $_SESSION['priezvisko'];
$idUser = $_SESSION['id'];
echo $idUser;
require ("config.php");
// Create connection
$conn = new mysqli($servername, $username, $password , $dbname);
$conn->set_charset("UTF8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO trasa (start_nazov, start_lat, start_long,ciel_nazov,ciel_lat,ciel_long,celkove_km,datum_vytvorenia,mod_trasy,id_user, vytvoril)
        VALUES ('" . $start . "', '" . $lat1 . "','" . $lng1 . "','" . $end . "','" . $lat2 . "','" . $lng2 . "',$dis,'".date("Y-m-d H:i:s")."','" . $modTrasy . "',$id,'" . $meno." ".$priezvisko . "')";

echo $sql."<br><br>";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT id from trasa ORDER BY id DESC LIMIT 1";
$idTrasa = 0;
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $idTrasa = $row->id;

    }
}
echo $idTrasa."<br>";


$conn->close();

header("Location: cestyAdmin.php");