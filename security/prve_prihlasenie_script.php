<?php
/**
 * Prve prihlasenie uzivatela.
 */

require_once '../config.php';
session_start();

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Nepodarilo sa prihlasit');
}

try {
    // Ziskaj hash query
    $stmt = $conn->prepare("SELECT heslo, rola, meno, priezvisko, id FROM pouzivatelia WHERE email=?");
    $update = $conn->prepare("UPDATE pouzivatelia SET heslo = ?, prve_prihlasenie = '0' WHERE email = ?");

} catch (Exception $e) {
    exit('Error logging in user - 0x1');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION["email"];
    $heslo = mysqli_real_escape_string($conn, $_POST["heslo"]);


    // Ziskanie hashu a update hesla
    try {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hesloDB, $rola, $meno, $priezvisko, $id);
        $stmt->fetch();



        if (password_verify($heslo, $hesloDB)) {

            // Zmena hesla
            $noveHeslo = mysqli_real_escape_string($conn, $_POST["nove-heslo"]);
            $noveHesloHash = password_hash($noveHeslo, PASSWORD_BCRYPT);
            $update->bind_param("ss", $noveHesloHash, $email);
            $update->execute();


            header("Location: ../cesty.php");


        } else {
            header("Location: prve_prihlasenie.php?pass=fail");
            die();
        }

    } catch (Exception $e) {
        exit('Error logging in user - 0x2');
    }
}
$conn->close();
?>

