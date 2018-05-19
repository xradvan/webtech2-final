<?php
require ("config.php");
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$idUser = $_SESSION['id'];

echo "id->".$idUser."<br>";


$sql = "SELECT id, start_lat, start_long, ciel_lat, ciel_long, mod_trasy FROM trasa WHERE id =".$_GET['id'];
$lat1=0;
$lng1=0;
$lat2=0;
$lng2=0;
$idTrasa = null;
$mod_trasy="";
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_object()) {
        $idTrasa = $row->id;
        $lat1 = $row->start_lat;
        $lng1 = $row->start_long;
        $lat2 = $row->ciel_lat;
        $lng2 = $row->ciel_long;
        $mod_trasy = $row->mod_trasy;
    }
    $result->close();
}

$res = $conn->query("SELECT id_timu FROM pouzivatelia WHERE id = $idUser");
$tmp = $res->fetch_assoc();
$idTimu = $tmp['id_timu'];

$res = $conn->query("SELECT odbehnute_km FROM trasa_tim WHERE id_tim = $idTimu AND id_trasa = $idTrasa");
$tmp = $res->fetch_assoc();
$odbehKmTimu = $tmp['odbehnute_km'];

echo "idTrasa->".$idTrasa."<br>idTimu->".$idTimu."<br>idTimu->".$odbehKmTimu."<hr>";
echo $lat1."<br>";
echo $lng1."<br>";
echo $lat2."<br>";
echo $lng2."<br>";
session_start();


// Ak je trasa verejna, vygeneruj data vsetkych bezcov, ktory na nej bezia
// Verejny mod
$fileName="tmp/bezciInfo.js";
if (file_exists($fileName)) {
    unlink($fileName);
}

// ziskanie prejdenych km
$prejdeneKm = null;
if ($mod_trasy !== "štafetový") {
    $result = $conn->query("SELECT prejdene_km FROM trasa_pouzivatel WHERE trasa_pouzivatel.id_trasa=".$_GET["id"]." AND id_pouzivatel=".$_SESSION["id"]);
    $row = $result->fetch_assoc();
    $prejdeneKm = $row["prejdene_km"];
}

if ($mod_trasy === "verejný") {

    $fp = fopen($fileName, 'w');
    $verejnyUsers = $conn->query("SELECT CONCAT(pouzivatelia.meno, \" \",pouzivatelia.priezvisko) as bezec, prejdene_km FROM trasa_pouzivatel JOIN pouzivatelia ON pouzivatelia.id=trasa_pouzivatel.id_pouzivatel
WHERE trasa_pouzivatel.id_trasa=".$_GET['id']);
    if ($verejnyUsers->num_rows > 0) {

        fwrite($fp, "var bezciInfo = [");
        while ($row = $verejnyUsers->fetch_assoc()) {
            // generovanie nahodneho suboru
            $farba = "#".dechex(rand(0x000000, 0xFFFFFF));

            // zapis
            fwrite($fp, " ['{$row['bezec']}', {$row['prejdene_km']}, '{$farba}'],");
        }
        fwrite($fp, "];");
    }

    fclose($fp);


} else if ($mod_trasy === "štafetový") {
    $fileName="tmp/bezciInfo.js";
    $fp = fopen($fileName, 'w');
    $verejnyUsers = $conn->query("SELECT tim.nazov AS tim, trasa_tim.odbehnute_km FROM trasa_tim JOIN tim ON tim.id=trasa_tim.id_tim WHERE trasa_tim.id_trasa=".$_GET['id']);
    if ($verejnyUsers->num_rows > 0) {

        fwrite($fp, "var bezciInfo = [");
        while ($row = $verejnyUsers->fetch_assoc()) {
            // generovanie nahodneho suboru
            $farba = "#".dechex(rand(0x000000, 0xFFFFFF));

            // zapis
            fwrite($fp, " ['{$row['tim']}', {$row['odbehnute_km']}, '{$farba}'],");
        }
        fwrite($fp, "];");
    }

    fclose($fp);


}
$vzd = is_null($prejdeneKm) ? "":"&vzd=$prejdeneKm";
if($mod_trasy === 'štafetový' ){
    $vzd = "&vzd=$odbehKmTimu";
}
if($_SESSION['rola'] == 'admin'){
    header("Location: cestyAdmin.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2".$vzd);
}
else{
    header("Location: cesty.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2".$vzd);
}
