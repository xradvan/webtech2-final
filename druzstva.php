<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/druzstva.css">
    <title>Štafetový mód - administrátor</title>
</head>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <span class="navbar-brand" >

        </span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="cesty.php">Domov</a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="stafetovyMod.php">
                    Štafetový mód
                </a>
            </li>
            <li class="nav-item" id="registracia" style="display: none;">
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
    <?php
    require ('config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    ?>
<div class="row">
    <div class="col-6 col-md-5">
        <?php
        $query = " SELECT DISTINCT nazovTimu FROM zoznamtimov";
        $result = mysqli_query($conn,$query);
        echo "<table class='table table-dark'>";
        echo "<th>Zoznam tímov</th>";
        echo "<th>Vymaž tím</th>";
        while ($data = mysqli_fetch_array($result)) {
            $string = str_replace(' ', '_', $data['nazovTimu']);
            $odkaz = "druzstva.php?nazov=".$string;
            $odkazId = "druzstva.php?vymaz=".$string;
            echo "<tr>";
            echo "<td><a href=$odkaz>" . $data['nazovTimu']."</a></td>";
            echo "<td><a href='$odkazId'>&#10006;</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
     </div>
    <div class="col-6 col-md-2"></div>
    <div class="col-6 col-md-5">
        <?php
        if(isset($_GET["nazov"])){
            $prem = str_replace('_', ' ', $_GET["nazov"]);
            $query = " SELECT * FROM zoznamtimov WHERE nazovTimu ='$prem'";
            $result = mysqli_query($conn,$query);
            echo "<table class='table table-dark'>";
            echo "<th>Členovia tímu</th>";
            echo "<th>Vymaž člena</th>";
            while ($data = mysqli_fetch_array($result)) {
                $odkazDel = "druzstva.php?del=".$data['idUzivatela']."&tim=".$data['nazovTimu'];
                echo "<tr>";
                echo "<td>". $data['idUzivatela']."</td>";
                echo "<td><a href='$odkazDel'>&#10006;</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</div>
</body>
</html>

<?php
if(isset($_GET["vymaz"])){
    $prem = str_replace('_', ' ', $_GET["vymaz"]);
    $query = " DELETE FROM zoznamtimov WHERE nazovTimu ='$prem'";
    $result = mysqli_query($conn,$query);
    header("Refresh:0; url=druzstva.php");
}

if(isset($_GET["del"]) && isset($_GET["tim"])){
    $prem = $_GET["del"];
    $prem2 = str_replace('_', ' ', $_GET["tim"]);
    $query = " DELETE FROM zoznamtimov WHERE idUzivatela =".$prem." AND nazovTimu ='$prem2'";
    $result = mysqli_query($conn,$query);
    header("Refresh:0; url=druzstva.php?nazov=$prem2");
}
?>