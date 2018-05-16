<?php
    include("security/over_uzivatela.php");
    if(isset($_GET['odhlasenie'])){
    session_destroy();
    unset($_SESSION['rola']);
    unset($_SESSION['email']);
    header("location:prologue.php");
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Aktuality</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <span class="navbar-brand" >
                <?php
                require ('config.php');
                $conn = new mysqli($servername, $username, $password, $dbname);
                $conn->set_charset("UTF8");
                $email= $_SESSION['email'];
                if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
                $query="SELECT meno, priezvisko from pouzivatelia WHERE email='$email'";
                $result = mysqli_query($conn,$query);
                while ($data = mysqli_fetch_array($result)){
                    echo "Vitajte ".$data['meno']." ".$data['priezvisko'];
                }
                $conn->close();
            ?>
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cesty.php">Domov</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Upozornenia
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="#">Zapnúť</a>
                        <a class="dropdown-item active" href="#">Vypnúť</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="aktuality.php">
                        Aktuality
                    </a>
                </li>
                <li class="nav-item active" id="registracia" style="display: none;">
                    <a class="nav-link" href="registraciaPouzivatela.php">
                        Registrácia používateľa
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="aktuality.php?odhlasenie='1'"><img src="logOut.png" width="25px" height="20px"></a></li>
            </ul>
        </div>
    </nav>
    <script type="text/javascript">
                var user = '<?php echo $_SESSION['rola']; ?>';
                if(user=="admin"){
                    $("#registracia").css("display","inline");
                }
    </script>
    <form action="ulozenieCSV.php" method="POST">
  		<input type="file" name="subor">
  		<input type="submit">
	</form>

</body>
</html>
<?php
	
?>