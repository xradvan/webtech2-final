<?php

$index = $_GET['index'];


require ("config.php");
// Create connection
$conn = new mysqli($servername, $username, $password , $dbname);
$conn->set_charset("UTF8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE trasa SET aktivna_trasa=0";
$conn->query($sql);

$sql = "UPDATE trasa SET aktivna_trasa=1 WHERE id = $index";

echo $sql."<br><br>";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}





$sql = "SELECT start_lat, start_long, ciel_lat, ciel_long FROM trasa WHERE id =".$index;
$lat1=0;
$lng1=0;
$lat2=0;
$lng2=0;
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $lat1 = $row->start_lat;
        $lng1 = $row->start_long;
        $lat2 = $row->ciel_lat;
        $lng2 = $row->ciel_long;

    }
    $result->close();
}

header("Location: cesty.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2");

$conn->close();


