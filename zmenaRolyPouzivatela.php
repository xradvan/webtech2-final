<?php
 	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
	require ('config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
	if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    $query="UPDATE pouzivatelia SET rola= '$_GET[rola]' WHERE id = '$_GET[id]'";
    $result = mysqli_query($conn,$query);
    $select = "SELECT email FROM pouzivatelia WHERE id = '$_GET[id]'";
    $result = mysqli_query($conn,$select);
    while ($data = mysqli_fetch_array($result)){
          try {
                $mail = new PHPMailer(true); 
                $mail->isSMTP();              
                $mail->Host = 'smtp.gmail.com';  
                $mail->SMTPAuth = true;        
                $mail->Username = 'ebeehives@gmail.com';   
                $mail->Password = 'Qw3rty95';    
                $mail->SMTPSecure = 'tls';     
                $mail->Port = 587;           
                $mail->CharSet = 'UTF-8';
                
                $mail->setFrom('webtech@gmail.com', 'Webtech');
                $mail->addAddress($data['email']);     
        
                $mail->isHTML(true);    
                $mail->Subject = 'Upozornenie na zmenu práv používateľa';
                $mail->Body    = '<h2 style="text-align: center;">Vážený používateľ</h2><p style="text-align: center;">Vaše práva boli zmenené adminom na typ používateľa <strong>'.$_GET['rola'].'</strong></p> <p style="color: red;text-align: center;">Tento e-mail bol vygenerovaný z webovej aplikácie, prosím neodpovedajte naň</p>';

                $mail->AltBody = '<h2 style="text-align: center;">Vážený používateľ</h2><p style="text-align: center;">Vaše práva boli zmenené adminom na typ používateľa'.$_GET['rola'].'</p> <p style="color: red;text-align: center;">Tento e-mail bol vygenerovaný z webovej aplikácie, prosím neodpovedajte naň</p>';
                $mail->send();
            } catch (Exception $e) {
                echo $e;
            }
        }
    $conn->close();
    header('location:registraciaPouzivatela.php');
?>