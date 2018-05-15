<?php
/**
 * Pridanim tohto suboru sa skontroluje, ci je uzivatel prihlaseny.
 * Ak nie, presmeruje ho na prihlasenie
 */

session_start();

if (!isset($_SESSION["rola"])) {
    header("Location: security/prihlasenie.php");
    die();
}