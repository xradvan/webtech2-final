<?php
    require ('config.php');

    //po ulozeni pridat tabulku ulozenych
    $target_dir = "tmp/";
    $target_file = $target_dir . basename($_FILES["inputFile"]["name"]);

    // Kontrola velkosti
    if ($_FILES["inputFile"]["name"] > 500000) {
        header("location:registraciaPouzivatela.php?upload=fail");
        die();
    }


    // Nahravanie
    if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $target_file)) {


        // Otvorenie suboru
        $myfile = fopen($target_file, "r");


        // DB pripojenie
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("UTF-8");
        if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

        $i=0;
        while (($data = fgetcsv($myfile, 200, ";")) !== FALSE) {
            if($i>0){

                // Generovanie hesla
                $heslo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ%?_"), 0, 20);
                $hesloHash = password_hash($heslo, PASSWORD_BCRYPT);
                $meno = iconv(mb_detect_encoding($data[2], mb_detect_order(), true), "UTF-8", $data[2]);
                $priezvisko = iconv(mb_detect_encoding($data[1], mb_detect_order(), true), "UTF-8", $data[1]);
                $email = iconv(mb_detect_encoding($data[3], mb_detect_order(), true), "UTF-8", $data[3]);
                $stredna_skola = iconv(mb_detect_encoding($data[4], mb_detect_order(), true), "UTF-8", $data[4]);
                $stredna_skola_adresa = iconv(mb_detect_encoding($data[5], mb_detect_order(), true), "UTF-8", $data[5]);
                $ulica = iconv(mb_detect_encoding($data[6], mb_detect_order(), true), "UTF-8", $data[6]);
                $psc = iconv(mb_detect_encoding($data[7], mb_detect_order(), true), "UTF-8", $data[7]);
                $obec = iconv(mb_detect_encoding($data[8], mb_detect_order(), true), "UTF-8", $data[8]);
                $import="INSERT into pouzivatelia(meno,priezvisko,email,heslo,stredna_skola,stredna_skola_adresa,ulica,psc,obec)values('".$meno."','".$priezvisko."','".$email."','".$hesloHash."','".$stredna_skola."','".$stredna_skola_adresa."','".$ulica."','".$psc."','".$obec."')";

                echo mb_detect_encoding($priezvisko, mb_detect_order(), true)."<br>";
                echo $import;
                // Query
//                mysqli_query($conn,$import) or die(mysqli_error($conn));
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
        header("location:registraciaPouzivatela.php?upload=fail");
        die();
    }

?>