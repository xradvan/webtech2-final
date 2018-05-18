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
    <link rel="stylesheet" href="css/hide.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/registraciaPouzivatela.css">
    
    <title>Pouzivatelia</title>
</head>
<body>

<!--    Alerts -->
<div class="alert alert-success  hide-default" id="alert-success">
    Užívatelia boli úspešne pridaný.
</div>
<div class="alert alert-danger  hide-default" id="alert-fail">
    Súbor sa nepodarilo nahrať. Skontrolujte veľkosť a formát. Podporovane je len kodovanie UTF-8.
</div>
<script>
    // Zobrazenie alertu
    // Uspesna registracia
    if(window.location.href.indexOf("ok") > -1) {
        $('#alert-success').removeClass("hide-default");
    }

    // Nespravne meno alebo heslo
    if(window.location.href.indexOf("fail") > -1) {
        $('#alert-fail').removeClass("hide-default");
    }
</script>
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
            <li class="nav-item">
                <?php 
                        if($_SESSION['rola']== "admin"){
                            echo '<a class="nav-link" href="cestyAdmin.php">Domov</a>';
                        }else{
                            echo '<a class="nav-link" href="cesty.php">Domov</a>';
                        }
                     ?>
            </li>

            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Upozornenia
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                        $email= $_SESSION['email'];
                        $query="SELECT odoberatel from pouzivatelia WHERE email='$email'";
                        $result = mysqli_query($conn,$query);
                        while ($data = mysqli_fetch_array($result)){
                            if($data['odoberatel'] == 1){
                                echo '<a class="dropdown-item active" href="#" id="zapUpozornenia" onclick="zmenitNastavenieAktualit(\'zapUpozornenia\');">Zapnúť</a>';
                                echo '<a class="dropdown-item " href="#" id="vypUpozornenia" onclick="zmenitNastavenieAktualit(\'vypUpozornenia\');">Vypnúť</a>';
                            }else{
                                echo '<a class="dropdown-item" href="#" id="zapUpozornenia" onclick="zmenitNastavenieAktualit(\'zapUpozornenia\');">Zapnúť</a>';
                                echo '<a class="dropdown-item active" href="#" id="vypUpozornenia" onclick="zmenitNastavenieAktualit(\'vypUpozornenia\');">Vypnúť</a>';
                            }
                        }
                       
                    ?>
                </div>
                </li>
            <li class="nav-item ">
                <a class="nav-link" href="aktuality.php">
                    Aktuality
                </a>
            </li>
            <li class="nav-item active" id="registracia" style="display: none;">
                <a class="nav-link" href="registraciaPouzivatela.php">
                    Používatelia
                </a>
            </li>
            <li class="nav-item" id="osobneVykony" style="display: inline;">
                <a class="nav-link" href="osobneVykony.php">
                    Osobné výkony
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
        $("#osobneVykony").css("display", "none");
    }
</script>

<div class="row">
    <div class="col-8 leftCol">
        <h3> Tabuľka všetkých používateľov</h3>
        <table class="table table-dark table-bordered"  id="pouzivateliaTable">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Meno</th>
                <th scope="col">Priezvisko</th>
                <th scope="col">Admin</th>
                <th scope="col">Osobné výkony</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
            $email= $_SESSION['email'];
            $query="SELECT id, meno, priezvisko, rola from pouzivatelia WHERE NOT email ='".$email."'";
            $result = mysqli_query($conn,$query);
            $i=1;
            while ($data = mysqli_fetch_array($result)){
                echo '<tr>';
                echo '<th scope="row">'.$i.'</th>';
                echo '<td>'.$data["meno"].'</td>';
                echo '<td>'.$data["priezvisko"].'</td>';
                if($data['rola'] == "user"){
                    echo '<td><input type="checkbox" class="checkbox" value="'.$data['id'].'"></td>';
                }else{
                    echo '<td><input type="checkbox" class="checkbox" checked value="'.$data['id'].'"></td>';
                }
                echo '<td><a href="osobneVykony.php?id='.$data['id'].'">Zobraziť osobné výkony</a></td>';
                echo '</tr>';
                $i++;
            }
            $conn->close();

            ?>
            </tbody>
        </table>

    </div>
    <div class="col-4 rightCol">
        <h3>Pridanie používateľov</h3>
        <img src="img/add.png" class="addBtn" alt="add">

        <div class="addDiv">

            <form id="addForm" method="post" action="ulozenieCSV.php" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="subor">Vyberte csv súbor pre registrovanie nových používateľov </label>
                    <input type="file" id="subor" name="inputFile" required>
                </div>

                <button type="submit" id="insertBtn" class="btn btn-danger">Registrovať</button>

            </form>

            <table class="table table-striped" id="pridaniPouzivateliaTable" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Meno</th>
                    <th scope="col">Priezvisko</th>
                    <th scope="col">Admin</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

    function zmenitNastavenieAktualit(id){

        if(id=="zapUpozornenia"){
            $("#zapUpozornenia").addClass("active");
            $("#vypUpozornenia").removeClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=zap&lokacia=registraciaPouzivatela.php";

        }else{
            $("#zapUpozornenia").removeClass("active");
            $("#vypUpozornenia").addClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=vyp&lokacia=registraciaPouzivatela.php";
        }
    }

    $( document ).ready(function() {
        $('#pouzivateliaTable').DataTable();

        $('.checkbox').change(function() {
            if($(this).is(":checked")) {
                var rola = "admin";
            }else{
                var rola = "user";
            }
            var id = $(this).val();
            window.location.href = "zmenaRolyPouzivatela.php?id="+id+"&rola="+rola;


        });

        $(".addBtn").on('click', function () {
            $(".addDiv").slideToggle();
        });

//            $("#insertBtn").on('click', function () {
//                window.location.href = "ulozenieCSV.php?subor="+$("#subor").val();
//
//            });

    });

</script>
</body>
</html>
