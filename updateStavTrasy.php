<?php
require ("config.php");
// Create connection
$conn = new mysqli($servername, $username, $password , $dbname);
$conn->set_charset("UTF8");


$index = $_GET['index'];
$tid = $_GET['tid'];
session_start();
$idUser = $_SESSION['id'];
echo "trasaId->".$tid."<br>";
echo "userId ->".$idUser."<br>";

$res = $conn->query("SELECT prejdene_km FROM trasa_pouzivatel WHERE id_pouzivatel = $idUser AND id_trasa = $tid");
$tmp = $res->fetch_assoc();
$prejdeneKm = $tmp['prejdene_km'];

echo "userKm->".$prejdeneKm;
echo "<hr>";

$res = $conn->query("SELECT id_timu FROM pouzivatelia WHERE id = $idUser");
$tmp = $res->fetch_assoc();
$idTim = $tmp['id_timu'];

echo "timId->$idTim<br>";



echo "<hr>";


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE trasa_pouzivatel SET aktivna_trasa=0 WHERE id_pouzivatel = $idUser";
$conn->query($sql);

$sql = "UPDATE trasa_pouzivatel SET aktivna_trasa=1 WHERE id_pouzivatel =".$index." AND id_trasa =".$tid;

echo $sql."<br><br>";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}





$sql = "SELECT id,start_lat, start_long, ciel_lat, ciel_long, mod_trasy FROM trasa WHERE id =".$tid;
$lat1=0;
$lng1=0;
$lat2=0;
$lng2=0;
$mod_trasy = "";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $lat1 = $row->start_lat;
        $lng1 = $row->start_long;
        $lat2 = $row->ciel_lat;
        $lng2 = $row->ciel_long;
        $mod_trasy = $row->mod_trasy;
    }
    $result->close();
}

if($mod_trasy === 'štafetový' ){
    $res = $conn->query("SELECT odbehnute_km FROM trasa_tim WHERE id_tim = $idTim AND id_trasa = $tid");
    $tmp = $res->fetch_assoc();
    $prejdeneKmTim = $tmp['odbehnute_km'];

    echo "timKm->$prejdeneKmTim<br>";

    $vzd = "&vzd=$prejdeneKmTim";
}
else{
    $vzd = "&vzd=$prejdeneKm";
}
echo "<hr>";
echo "<br>$vzd";
if($_SESSION['rola'] == "admin"){
    header("Location: cestyAdmin.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2$vzd");
}
else{
    header("Location: cesty.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2$vzd");
}

$conn->close();


