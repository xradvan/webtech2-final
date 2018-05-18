<?php
 use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    include("security/over_uzivatela.php");
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    if(isset($_POST['titulok']) && isset($_POST['obsah'])){
            require ('config.php');
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("UTF8");
            if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
            $datum = date("Y-m-d");
            $query ="INSERT INTO aktuality (titulok, obsah, datum) VALUES ('".$_POST['titulok']."', '".$_POST['obsah']."','".$datum."' )";
            $result = mysqli_query($conn,$query);
           
        $odoberatelia = array();
        $selectOdoberatelia = "SELECT email FROM pouzivatelia WHERE odoberatel='1'";
        $result = mysqli_query($conn, $selectOdoberatelia);


        while ($row = mysqli_fetch_assoc($result)){
            array_push($odoberatelia, $row);
        }

          
        for ($i = 0; $i < sizeof($odoberatelia); $i++){    
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
                $mail->addAddress($odoberatelia[$i]['email']);     
        
                $mail->isHTML(true);    
                $mail->Subject = 'Upozornenie na nový článok';
                $mail->Body    = '<h2 style="text-align: center;">'.$_POST['titulok'].'</h2><h5 style="color: gray; text-align: center;">'.$datum.'</h5><p style="text-align: center;">'.$_POST['obsah'].'</p> <p style="color: red;text-align: center;">Tento e-mail bol vygenerovaný z webovej aplikácie, prosím neodpovedajte naň</p>';

                $mail->AltBody = '<h2 style="text-align: center;">'.$_POST['titulok'].'</h2><h5 style="color: gray; text-align: center;">'.$datum.'</h5><p style="text-align: center;">'.$_POST['obsah'].'</p> <p style="color: red;text-align: center;">Tento e-mail bol vygenerovaný z webovej aplikácie, prosím neodpovedajte naň</p>';
        
                $mail->send();
            } catch (Exception $e) {
                echo $e;
            }
        }      
    


            $conn->close();

            header('location:aktuality.php');
    }


?>