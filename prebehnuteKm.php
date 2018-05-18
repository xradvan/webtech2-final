<?php
require ('config.php');
echo "<br>".$_POST['distance'];
echo "<br>".$_POST['date'];
echo "<br>".$_POST['treningStart'];
echo "<br>".$_POST['treningEnd'];
echo "<br>".$_POST['lat'];
echo "<br>".$_POST['lng'];
echo "<br>".$_POST['hodnotenie'];
echo "<br>".$_POST['note'];

session_start();
echo "<br>".$_SESSION['id'];

$idUser = $_SESSION['id'];

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id FROM trasa_pouzivatel WHERE id_pouzivatel = $idUser AND aktivna_trasa = 1";

$id_tr_pouz = 0;
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $id_tr_pouz = $row->id;

    }
    $result->close();
}

echo "<br><br><br>".$id_tr_pouz;

$sql = "INSERT INTO trening(id_trasa_pouzivatel, odbehnute_km, den_treningu, zaciatok_treningu, koniec_treningu, lat_trening, lng_trening, hodnotenie, poznamka) 
        VALUES (".$id_tr_pouz.",".$_POST['distance'].",'".$_POST['date']."','".$_POST['treningStart']."','".$_POST['treningEnd']."',".$_POST['lat'].",".$_POST['lng'].",".$_POST['hodnotenie'].",'".$_POST['note']."')";

echo "<br><br><br><br>".$sql;

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$naseKm = 0;

$sql = "SELECT  SUM(odbehnute_km) as moje_km FROM trening WHERE id_trasa_pouzivatel = $id_tr_pouz";

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $naseKm = $row->moje_km;

    }
    $result->close();
}

echo $naseKm;

$sql = "UPDATE trasa_pouzivatel SET prejdene_km=$naseKm WHERE id = $id_tr_pouz";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

if($_SESSION['rola'] == 'admin'){
    header("Location: cestyAdmin.php");
}
else{
    header("Location: cesty.php");
}
