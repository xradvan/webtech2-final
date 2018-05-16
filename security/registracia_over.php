<?php
/**
 * Dokoncenie registracie pomocou overenia cez email. Zapisanie dat do DB
 */
session_start();

require_once '../config.php';

// Ziskanie dat
if (isset($_SESSION["email"])) {
    // Zapisanie dat do session
    $meno = $_SESSION["meno"];
    $priezvisko = $_SESSION["priezvisko"];
    $email = $_SESSION["email"];
    $heslo = $_SESSION["heslo"];
    $stredna_skola = $_SESSION["stredna_skola"];
    $stredna_skola_adresa = $_SESSION["stredna_skola_adresa"];
    $ulica = $_SESSION["ulica"];
    $psc = $_SESSION["psc"];
    $obec = $_SESSION["obec"];


} else {
    header("Location: registracia.php");
    die();
}



try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Nepodarilo sa prihlasit');
}


// Priprava queries
try {
    $regQuery = $conn->prepare("INSERT INTO pouzivatelia (meno, priezvisko, email, heslo, stredna_skola, stredna_skola_adresa, 
    ulica, psc, obec) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

} catch (Exception $e) {
    exit('Error registering user - 0x1');
}


// Hashovanie hesla pouzitim Blowfish algoritmu so saltom
$hesloHash = password_hash($heslo, PASSWORD_BCRYPT);

// Registruj
try {
    $regQuery->bind_param("sssssssss",$meno, $priezvisko, $email, $hesloHash, $stredna_skola, $stredna_skola_adresa,
        $ulica, $psc, $obec);

    $regQuery->execute();
    $regQuery->close();

    session_unset();
    session_destroy();

    // Po uspesnej registracii: presmerovanie na stranku prihlasenia
    header("Location: prihlasenie.php?register=ok");
    die();
} catch (Exception $e) {
    exit('Error registering user - 0x3');
}

$conn->close();