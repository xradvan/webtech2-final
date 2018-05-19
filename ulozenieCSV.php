<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include("security/over_uzivatela.php");
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require_once 'config.php';

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
                $import="INSERT into pouzivatelia(meno,priezvisko,email,heslo,stredna_skola,stredna_skola_adresa,ulica,psc,obec, prve_prihlasenie) values('".$meno."','".$priezvisko."','".$email."','".$hesloHash."','".$stredna_skola."','".$stredna_skola_adresa."','".$ulica."','".$psc."','".$obec."', '1')";
//                echo $import;

                // Query
                mysqli_query($conn,$import) or die(mysqli_error($conn));

                // Testovanie pouzivania emailu
                try {
                    $mail = new PHPMailer(true); 
                    $mail->isSMTP();              
                    $mail->Host = 'mail.stuba.sk';  
                    $mail->SMTPAuth = true;        
                    $mail->Username = $AISLogin;   
                    $mail->Password = $AISPassword;    
                    $mail->SMTPSecure = 'tls';     
                    $mail->Port = 25;           
                    $mail->CharSet = 'UTF-8';
                    
                    $mail->setFrom('webtech@stuba.sk', 'Webtech');
                    $mail->addAddress($email);     
        
                    $mail->isHTML(true);    
                    $mail->Subject = 'Registrácia do webovej aplikácie';
                    $mail->Body    = "<h2 style='text-align: center;'>Dobrý deň,
                    
                    boli ste registrovaní na našom portáli. 
                    Vaše heslo je:
                    $heslo
                    
                    Prihláste sa na: 
                    http://147.175.98.209/webtech2-final/security/prihlasenie.php</h2><p style='color: red;text-align: center;'>Tento e-mail bol vygenerovaný z webovej aplikácie, prosím neodpovedajte naň</p>";
        
                    $mail->AltBody = '<h2 style="text-align: center;">Dobrý deň,<br>
                    <br>
                    boli ste registrovaní na našom portáli. <br>
                    Vaše heslo je: <br>
                    $heslo <br>
                    <br>
                    Prihláste sa na: <br>
                    <br>http://147.175.98.209/webtech2-final/security/prihlasenie.php</h2><p style="color: red;text-align: center;">Tento e-mail bol vygenerovaný z webovej aplikácie, prosím neodpovedajte naň</p>';
                    $mail->send();
        
                } catch (Exception $e) {
                    exit('Error registering user - 0x2');
                }
            }
            $i=1;
        }

        // Zavrie subor
        fclose($myfile);

        // Vymaze subor po uspesnom importe
        unlink($target_file);

         header("location:registraciaPouzivatela.php?upload=ok");
         die();

    } else {
        header("location:registraciaPouzivatela.php?upload=fail");
        die();
    }

?>