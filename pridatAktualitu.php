<?php
 use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
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

        $mail = new PHPMailer(true);   
        for ($i = 0; $i < sizeof($odoberatelia); $i++){    
            try {
                $mail->isSMTP();              
                $mail->Host = 'smtp.gmail.com';  
                $mail->SMTPAuth = true;        
                $mail->Username = 'ebeehives@gmail.com';   
                $mail->Password = 'Qw3rty95';    
                $mail->SMTPSecure = 'tls';     
                $mail->Port = 587;           
                $mail->CharSet = 'UTF-8';
                
                $mail->setFrom('webtech@gmail.com', 'Webtech');
                $mail->addAddress($odoberatelia[$i]['email'], '');     
        
                $mail->isHTML(true);    
                $mail->Subject = 'Upozornenie na nový článok';
                $mail->Body    = '<h3>Bol pridaný nový článok</h3>';
                $mail->AltBody = '<h3>Bol pridaný nový článok</h3>';
        
                $mail->send();
            } catch (Exception $e) {
                echo $e;
            }
        }      
    


            $conn->close();

            header('location:aktuality.php');
    }


?>