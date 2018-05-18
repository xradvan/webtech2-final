<?php
require_once "security/over_uzivatela.php";
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
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" href="./css/cesty.css">
    <title>Document</title>
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
            ?>
        </span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link" href="aktuality.php">
                    Aktuality
                </a>
            </li>
            <li class="nav-item" id="registracia" style="display: none;">
                <a class="nav-link" href="registraciaPouzivatela.php">
                    Používatelia
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


    <div class="container">
        <div id="myMap" style="height: 70%; width: 100%"></div>
    </div>





<script>

    if (window.location.href.indexOf("lat1=") > -1) {


        var url_string = window.location.href;
        var url = new URL(url_string);
        var lat1 = url.searchParams.get("lat1");
        var lng1 = url.searchParams.get("lng1");
        var lat2 = url.searchParams.get("lat2");
        var lng2 = url.searchParams.get("lng2");

    }
    console.log(lat1);


</script>

<script src="scripts/stafeta.js" ></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArw-eyIcflcUehHyPzWx5FRzAr6EEI_68&libraries=places&callback=myMap"></script>


</body>
</html>