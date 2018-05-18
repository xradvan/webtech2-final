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

$date = "";
$treningStart = "";
$treningEnd = "";
$lat = 0;
$lng = 0;
$note = 0;

if(!empty($_POST['date'])){
    $date = $_POST['date'];
}
if(!empty($_POST['treningStart'])){
    $treningStart = $_POST['treningStart'];
}
if(!empty($_POST['treningEnd'])){
    $treningEnd = $_POST['treningEnd'];
}
if(!empty($_POST['lat'])){
    $lat = $_POST['lat'];
}
if(!empty($_POST['lng'])){
    $lng = $_POST['lng'];
}
if(!empty($_POST['note'])){
    $note = $_POST['note'];
}



session_start();
echo "<br> id:".$_SESSION['id'];

$idUser = $_SESSION['id'];

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, id_trasa FROM trasa_pouzivatel WHERE id_pouzivatel = $idUser AND aktivna_trasa = 1";

$id_trasa = 0;
$id_tr_pouz = 0;
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $id_tr_pouz = $row->id;
        $id_trasa = $row->id_trasa;
    }
    $result->close();
}

echo "<br><br><br>".$id_tr_pouz;

$sql = "INSERT INTO trening(id_trasa_pouzivatel, odbehnute_km, den_treningu, zaciatok_treningu, koniec_treningu, lat_trening, lng_trening, hodnotenie, poznamka) 
        VALUES (".$id_tr_pouz.",".$_POST['distance'].",'".$date."','".$treningStart."','".$treningEnd."',".$lat.",".$lng.",".$_POST['hodnotenie'].",'".$note."')";

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

echo "nase km ".$naseKm;
$celKM = 0;
$sql = "SELECT celkove_km FROM trasa where id =$id_trasa";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $celKM = $row->celkove_km;
    }
}

if ($naseKm >= $celKM){
    $naseKm = $celKM;
}

$sql = "UPDATE trasa_pouzivatel SET prejdene_km=$naseKm WHERE id = $id_tr_pouz";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$mod_trasy = "";

$sql = "SELECT mod_trasy FROM trasa where id =$id_trasa";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {

        $mod_trasy = $row->mod_trasy;
    }
}

echo "modTrasy: ".$mod_trasy;

if( $mod_trasy == 'štafetový'){

    $arrayIds = [];
    $sql = "SELECT pouzivatelia.id, pouzivatelia.id_timu FROM pouzivatelia where pouzivatelia.id_timu = (SELECT pouzivatelia.id_timu FROM pouzivatelia WHERE pouzivatelia.id = $idUser)";
$timId = 0;
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_object()) {

            array_push($arrayIds,$row->id);
            $timId = $row->id_timu;
        }
    }

    var_dump($arrayIds);

    echo "<br><br><br><br><br><br><br>";



$kilometreTimu = 0;

    foreach ($arrayIds as $index){

        $sql = "SELECT SUM(trasa_pouzivatel.prejdene_km) as totaldis
                FROM trasa_pouzivatel 
                WHERE id_pouzivatel = $index AND id_trasa = $id_trasa";

        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_object()) {

                $kilometreTimu += $row->totaldis;

            }
        }

    }

    echo $kilometreTimu;


    $sql = "UPDATE trasa_tim SET odbehnute_km=$kilometreTimu WHERE id_tim = $timId AND id_trasa = $id_trasa";
    echo "<br><br><br><br>";
    echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if($_SESSION['rola'] == 'admin'){
    header("Location: cestyAdmin.php");
}
else{
    header("Location: cesty.php");
}
