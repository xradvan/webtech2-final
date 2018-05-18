<?php
require ("config.php");
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT start_lat, start_long, ciel_lat, ciel_long, mod_trasy FROM trasa WHERE id =".$_GET['id'];
$lat1=0;
$lng1=0;
$lat2=0;
$lng2=0;
$mod_trasy="";
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
echo $lat1."<br>";
echo $lng1."<br>";
echo $lat2."<br>";
echo $lng2."<br>";
session_start();
if($_SESSION['rola'] == 'admin'){

    // Ak je trasa verejna, vygeneruj data vsetkych bezcov, ktory na nej bezia
    // Zapis do suboru


    if ($mod_trasy === "verejný") {
        $fileName="tmp/bezciInfo.js";
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
    }




    header("Location: cestyAdmin.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2");
}
else{
    header("Location: cesty.php?lat1=$lat1&lng1=$lng1&lat2=$lat2&lng2=$lng2");
}
