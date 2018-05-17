<?php
/**
 * Prihlasenie uzivatela.
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
    $stmt = $conn->prepare("SELECT heslo, rola, meno, priezvisko, id, prve_prihlasenie FROM pouzivatelia WHERE email=?");


} catch (Exception $e) {
    exit('Error logging in user - 0x1');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $heslo = mysqli_real_escape_string($conn, $_POST["heslo"]);


    // Ziskanie hashu a overenie hesla
    try {
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hesloDB, $rola, $meno, $priezvisko, $id, $prve_prihlasenie);
        $stmt->fetch();

        if (password_verify($heslo, $hesloDB)) {
            // Vytvorenie session
            $_SESSION['rola'] = $rola;
            $_SESSION['email'] = $email;
            $_SESSION['meno'] = $meno;
            $_SESSION['priezvisko'] = $priezvisko;
            $_SESSION['id'] = $id;

            // Ak je to prve prihlasenie a bol importovany z CSV, je presmerovany
            if ($prve_prihlasenie == "1") {
                header("Location: prve_prihlasenie.php");
                die();
            }



            if ($rola == "admin") {
                header("Location: ../cestyAdmin.php");
                die();
            } else {
                header("Location: ../cesty.php");
                die();
            }
        }
        else {
            header("Location: prihlasenie.php?login=fail");
            die();
        }

    } catch (Exception $e) {
        exit('Error logging in user - 0x2');
    }
}
$conn->close();
?>

