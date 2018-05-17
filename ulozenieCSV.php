<?php
    require ('config.php');

    //po ulozeni pridat tabulku ulozenych
    $target_dir = "tmp/";
    $target_file = $target_dir . basename($_FILES["inputFile"]["name"]);

    // Nahravanie
    if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $target_file)) {


        // Otvorenie suboru
        $myfile = fopen($target_file, "r");


        // DB pripojenie
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("utf8");
        if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

        $i=0;
        while (($data = fgetcsv($myfile, 200, ";")) !== FALSE) {
            if($i>0){

                // Generovanie hesla
                $heslo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ%?_"), 0, 8);
                $hesloHash = password_hash($heslo, PASSWORD_BCRYPT);

                $meno = $data[2];
                $priezvisko = $data[1];
                $email = $data[3];
                $stredna_skola = $data[4];
                $stredna_skola_adresa = $data[5];
                $ulica = $data[6];
                $psc = $data[7];
                $obec = $data[8];

                $import="INSERT into pouzivatelia(meno,priezvisko,email,heslo,stredna_skola,stredna_skola_adresa,ulica,psc,obec) values('".$meno."','".$priezvisko."','".$email."','".$hesloHash."','".$stredna_skola."','".$stredna_skola_adresa."','".$ulica."','".$psc."','".$obec."')";

                // Query
                mysqli_query($conn,$import) or die(mysqli_error($conn));






                // Poslanie emailu na overenie registracie
                $message = <<<EOT
                Dobry den,
                
                na dokoncenie registracie prosim kliknite na nasledovny odkaz:
                http://147.175.98.209/webtech2-final/security/registracia_over.php

EOT;
                mail($email, "Vitajte", $message);
            }
            $i=1;
        }

        // Zavrie subor
        fclose($myfile);

        // Vymaze subor po uspesnom importe
        unlink($target_file);

        // header("location:registraciaPouzivatela.php?upload=ok");
        // die();

    } else {
//        header("location:registraciaPouzivatela.php?upload=fail");
//        die();
    }

?>