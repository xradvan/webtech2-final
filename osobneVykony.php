<?php
require_once "security/over_uzivatela.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/osobneVykony.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
    <title>Ososbné výkony</title>
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
                <li class="nav-item active" id="osobneVykony" style="display: inline;">
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

    

    <div class="container text-center col-lg-10">
    <?php if ($_SESSION['rola'] == "user"){
            echo '<h4 class="text-left">Používateľ <strong>'.$_SESSION['meno']." ".$_SESSION['priezvisko'].'</strong></h4>';
                $query="SELECT id from pouzivatelia WHERE email='$_SESSION[email]'";
                $result1 = mysqli_query($conn,$query);
                $data1 = mysqli_fetch_array($result1);
        }
            else {
                $query="SELECT meno, priezvisko from pouzivatelia WHERE id='$_GET[id]'";
                $result = mysqli_query($conn,$query);
                $data = mysqli_fetch_array($result);
                echo '<h4 class="text-left">Používateľ <strong>'.$data['meno']." ".$data['priezvisko'].'</strong></h4>';
            }
            ?>
        <table class="table table-dark table-bordered"  id="pouzivateliaTable">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Počet_km</th>
                <th scope="col">Začiatok</th>
                <th scope="col">Koniec</th>
                <th scope="col">Zem_šírka</th>
                <th scope="col">Zem_výška</th>
                <th scope="col">Hodnotenie</th>
                <th scope="col">Poznámka</th>
                <th scope="col">Dátum</th>
                <th scope="col">Priem_rýchlosť</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
                    if(!isset($_GET['id'])){
                        $query="SELECT  trening.lat_trening, trening.lng_trening, trening.poznamka, trening.odbehnute_km, trening.den_treningu, trening.zaciatok_treningu, trening.koniec_treningu, trening.hodnotenie, trening.poznamka FROM trening JOIN trasa_pouzivatel ON trasa_pouzivatel.id = trening.id_trasa_pouzivatel JOIN pouzivatelia ON trasa_pouzivatel.id_pouzivatel = pouzivatelia.id JOIN trasa ON trasa.id = trasa_pouzivatel.id_trasa AND pouzivatelia.id = '$data1[id]'";
                    }else{
                        $query="SELECT  trening.lat_trening, trening.lng_trening, trening.poznamka, trening.odbehnute_km, trening.den_treningu, trening.zaciatok_treningu, trening.koniec_treningu, trening.hodnotenie, trening.poznamka FROM trening JOIN trasa_pouzivatel ON trasa_pouzivatel.id = trening.id_trasa_pouzivatel JOIN pouzivatelia ON trasa_pouzivatel.id_pouzivatel = pouzivatelia.id JOIN trasa ON trasa.id = trasa_pouzivatel.id_trasa AND pouzivatelia.id = '$_GET[id]'";
                        
                    }   $km_tr = 0;
                        $result = mysqli_query($conn,$query);
                        $i=1;
                        while ($data = mysqli_fetch_array($result)){
                            $km_tr += $data["odbehnute_km"];
                            $prm = strtotime($data["koniec_treningu"]) - strtotime($data["zaciatok_treningu"]);
                            $prm = round($data["odbehnute_km"]/(($prm / 60) / 60), 2)." km/h";
                            echo '<tr>';
                            echo '<th scope="row">'.$i.'</th>';
                            echo '<td>'.$data["odbehnute_km"].'</td>';
                            echo '<td>'.$data["zaciatok_treningu"].'</td>';
                            echo '<td>'.$data["koniec_treningu"].'</td>';
                            echo '<td>'.$data["lat_trening"].'</td>';
                            echo '<td>'.$data["lng_trening"].'</td>';
                            echo '<td>'.$data["hodnotenie"].'</td>';
                            echo '<td>'.$data["poznamka"].'</td>';
                            echo '<td>'.$data["den_treningu"].'</td>';
                            echo '<td>'.$prm.'</td>';
                            echo '</tr>';
                            $i++;
                            }
                            if($i-1 != 0){
                                $km_tr = $km_tr / ($i - 1);
                            }

                ?>
            </tbody>
        </table>
        <?php
            echo "<h4><strong>Priemerná hodnota odbehnutých km na 1 tréning je: ".$km_tr." km</strong></h4>";
        ?>
    </div>
    <div class="container text-center col-lg-2">
        <input type="image" src="img/download.png" id="ulozit" width="70" height="70"><br>
        <span>Uložiť tabulku ako PDF</span>
        <button type="button" class="btn-lg btn-danger" id="returnButton" style="display:none">Späť na používateľov</button>
    </div>

     <script type="text/javascript">
        var user = '<?php echo $_SESSION['rola']; ?>';
        if(user=="admin"){
            $("#registracia").css("display","inline");
            $("#osobneVykony").css("display", "none");
            $("#returnButton").css("display","inline");
        }
    </script>

<script type="text/javascript">
    function zmenitNastavenieAktualit(id){

        if(id=="zapUpozornenia"){
            $("#zapUpozornenia").addClass("active");
            $("#vypUpozornenia").removeClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=zap&lokacia=osobneVykony.php";

        }else{
            $("#zapUpozornenia").removeClass("active");
            $("#vypUpozornenia").addClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=vyp&lokacia=osobneVykony.php";
        }
    }
    
    $( "#returnButton" ).click(function() {
            window.location.href = "registraciaPouzivatela.php";
        });

     $( document ).ready(function() {
      $('#pouzivateliaTable').DataTable();
      $("#ulozit").on('click', function () {
          var dataSource = shield.DataSource.create({
            data: "#pouzivateliaTable",
            schema: {
                type: "table",
                fields: {
                    Počet_km: { type: String },
                    Začiatok: { type: String },
                    Koniec: { type: String },
                    Zem_šírka: { type: String },
                    Zem_výška: { type: String },
                    Hodnotenie: { type: String },
                    Poznámka: { type: String },
                    Dátum: { type: String },
                    Priem_rýchlosť: { type: String }
                }
            }
        });


        dataSource.read().then(function (data) {
            var pdf = new shield.exp.PDFDocument({
                author: "Webtech",
                created: new Date()
            });

            pdf.addPage("a4", "letter");

            pdf.table(
                50,
                50,
                data,
                [
                    { field: "Počet_km", title: "Pocet km", width: 70 },
                    { field: "Začiatok", title: "Zaciatok", width: 70 },
                    { field: "Koniec", title: "Koniec", width: 70 },
                    { field: "Zem_šírka", title: "Zem.sirka", width: 70 },
                    { field: "Zem_výška", title: "Zem. vyska", width: 70 },
                    { field: "Hodnotenie", title: "Hodnotenie", width: 70 },
                    { field: "Poznámka", title: "Poznamka", width: 100 },
                    { field: "Dátum", title: "Datum", width: 70 },
                    { field: "Priem_rýchlosť", title: "Priem. rychlost", width: 100 }
                ]
               
            );

            pdf.saveAs({
                fileName: "OsobneVykony"
            });
        });
            });
        });

</script>
</body>
</html>