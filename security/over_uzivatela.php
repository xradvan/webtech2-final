<?php
/**
 * Pridanim tohto suboru sa skontroluje, ci je uzivatel prihlaseny.
 * Ak nie, presmeruje ho na uvodnu stranku
 */

session_start();

if (!isset($_SESSION["rola"])) {
    header("Location: prologue.php");
    die();
}