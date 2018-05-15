

<!DOCTYPE html>
<html lang="sk">
    <head>
        <!-- Javascript a Bootstrap knižnice -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/locale/bootstrap-table-zh-CN.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <form method="post" action="newsletter.php" id="subscribe">
            <div class="form-group" id="add_numbers_button_div">
                <button type="submit" class="btn-lg btn-warning" name="odoberaj" id="odoberaj">Odoberať</button>
                <button type="submit" class="btn-lg btn-warning" name="zrusOdber" id="zrusOdber">Zrušiť odber</button>
            </div>
        </form>
        <form method="post" action="newsletter.php" id="text">
            <div class="form-group" id="add_numbers_button_div">
                <input type="text" class="form-control" id="text" name="text" required>
                <button type="submit" class="btn-lg btn-warning" name="pridajText" id="pridajText">Pridať text</button>
            </div>
        </form>
    </body>
</html>

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

    if (isset($_POST['odoberaj'])){
        //$email = $_SESSION["email"];

        $query = "INSERT INTO odoberatelia (email) VALUES ('matusbubeliny@gmail.com')";
        mysqli_query($conn, $query);

        $conn->close();
    }

    if (isset($_POST['zrusOdber'])){
        //$email = $_SESSION["email"];

        $query = "DELETE FROM odoberatelia WHERE email = 'matusbubeliny@gmail.com'";
        mysqli_query($conn, $query);

        $conn->close();
    }

    if (isset($_POST['pridajText'])){
        $text = $_POST["text"];

        $query = "INSERT INTO clanky (text) VALUES ('$text')";
        mysqli_query($conn, $query);

        $mail = new PHPMailer(true);       
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
            $mail->addAddress('matusbubeliny@gmail.com', '');     
    
            $mail->isHTML(true);    
            $mail->Subject = 'Upozornenie na nový článok';
            $mail->Body    = '<h3>Bol pridaný nový článok</h3>';
            $mail->AltBody = '<h3>Bol pridaný nový článok</h3>';
    
            $mail->send();
        } catch (Exception $e) {
            echo $e;
        }
    }

?>