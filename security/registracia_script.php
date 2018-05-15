<?php
/**
 *  Registracny php skript. Overi, ci je volna emailova adresa.
 *  Odosle registracny email. Do session zapise udaje z formularu.
 *
 */
session_start();
require_once '../config.php';


try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Nepodarilo sa prihlasit');
}

// Priprava queries
try {
    $emailQuery = $conn->prepare("SELECT COUNT(email) FROM pouzivatelia WHERE email=?");

} catch (Exception $e) {
    exit('Error registering user - 0x1');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meno = mysqli_real_escape_string($conn, $_POST["meno"]);
    $priezvisko = mysqli_real_escape_string($conn, $_POST["priezvisko"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $heslo = mysqli_real_escape_string($conn, $_POST["heslo"]);
    $stredna_skola = mysqli_real_escape_string($conn, $_POST["stredna_skola"]);
    $stredna_skola_adresa = mysqli_real_escape_string($conn, $_POST["stredna_skola_adresa"]);
    $ulica = mysqli_real_escape_string($conn, $_POST["ulica"]);
    $psc = mysqli_real_escape_string($conn, $_POST["psc"]);
    $obec = mysqli_real_escape_string($conn, $_POST["obec"]);


    // Testovanie pouzivania emailu
    try {

        $emailQuery->bind_param("s", $email);
        $emailQuery->execute();
        $emailQuery->store_result();
        $emailQuery->bind_result($pocet);
        $emailQuery->fetch();

        // Ak sa email uz pouziva, presmerovanie na registracny formular
        if ((int)$pocet > 0) {
            $emailQuery->close();
            header("Location: registracia.php?register=fail");
            die();
        }

        // Zapisanie dat do session
        $_SESSION["meno"] = $meno;
        $_SESSION["priezvisko"] = $priezvisko;
        $_SESSION["email"] = $email;
        $_SESSION["heslo"] = $heslo;
        $_SESSION["stredna_skola"] = $stredna_skola;
        $_SESSION["stredna_skola_adresa"] = $stredna_skola_adresa;
        $_SESSION["ulica"] = $ulica;
        $_SESSION["psc"] = $psc;
        $_SESSION["obec"] = $obec;



        // Poslanie emailu na overenie registracie
        $message = <<<EOT
        Dobry den,
        
        na dokoncenie registracie prosim kliknite na nasledovny odkaz:
        http://147.175.98.209/webtech2-final/security/registracia_over.php

EOT;
        mail($email, "Dokoncenie registracie", $message);


    } catch (Exception $e) {
        exit('Error registering user - 0x2');
    }

}
$conn->close();
//?>

<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrácia</title>

    <!--  Bootstrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    </head>
<body>



<div class="container">
    <br>
    <h1>Dokončenie registrácie</h1>
    <br>
    <p>Pre úspešné dokončenie registrácie pokračujte podľa pokynov v emaili.</p>
</div>


</body>
</html>