<?php
require ("config.php");
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT start_lat, start_long, ciel_lat, ciel_long FROM trasa WHERE id =".$_GET['id'];
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
echo $lat1."<br>";
echo $lng1."<br>";
echo $lat2."<br>";
echo $lng2."<br>";
session_start();
if($_SESSION['rola'] == 'admin'){

    $fileName="tmp/bezciInfo.js";
    $fp = fopen($fileName, 'w');
    fwrite($fp, '1');

    fclose($fp);

    header("Location: cestyAdmin.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2");
}
else{
    header("Location: cesty.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2");
}
