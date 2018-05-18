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


<!--    Google charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
                <a class="nav-link" href="cestyAdmin.php">Domov</a>
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

<h1 class="adminMode">Administratorský mód</h1>


<div class="row">
    <div class="col-8 leftCol">
        <div id="myMap" style="height: 400px; width: 70%"></div>

<!--   Nacitanie dat uzivatelov pre vykreslenie grafu: verejny rezim    -->
        <?php
            $fileName = "tmp/bezciInfo.js";

            if (file_exists($fileName)) {
                $file = fopen($fileName, "r");
                $contents = fread($file, filesize($fileName));
                echo "<script>";
                echo $contents;
                echo "</script>";
                fclose($file);

            }
        ?>

        <div class="dropdown show " id="trasyId">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Výber trasy
            </a>

            <?php
            require ("config.php");

            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("UTF8");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $idU = $_SESSION['id'];
            $sql = "SELECT trasa.id as tid, pouzivatelia.id, trasa.start_nazov, trasa.ciel_nazov, trasa_pouzivatel.prejdene_km, trasa.celkove_km, trasa.datum_vytvorenia, trasa_pouzivatel.aktivna_trasa, trasa.mod_trasy, trasa.vytvoril
                    FROM trasa_pouzivatel
                    INNER JOIN trasa ON trasa.id = trasa_pouzivatel.id_trasa
                    INNER JOIN pouzivatelia on pouzivatelia.id = trasa_pouzivatel.id_pouzivatel
                    WHERE trasa_pouzivatel.id_pouzivatel = $idU ORDER BY aktivna_trasa DESC";

            ?>

            <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">

                <?php

                if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_object()) {

                        echo "<a href='getUluru.php?id=$row->tid'   class='dropdown-item'>$row->start_nazov - $row->ciel_nazov</a>";

                    }
                    $result->close();
                }
                ?>

            </div>
        </div>


        <h1>Moje trasy</h1>


        <table class="table table-dark" id="privatneTrasy">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Štart</th>
                <th scope="col">Cieľ</th>
                <th scope="col">Prejdené km</th>
                <th scope="col">Dátum vytvorenia</th>
                <th scope="col">Definoval</th>
                <th scope="col">Mód</th>
                <th scope="col">Aktívna</th>


            </tr>
            </thead>
            <tbody>


            <?php
            $i = 1;
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<th scope='row'>$i <span class='spanId' >$row->id</span><span class='spanTid' >$row->tid</span></th>";
                    echo "<td>$row->start_nazov</td>";
                    echo "<td>$row->ciel_nazov</td>";
                    echo "<td>$row->prejdene_km/<b>$row->celkove_km</b></td>";
                    echo "<td>$row->datum_vytvorenia</td>";
                    //echo "<td>$row->aktivna_trasa</td>";
                    echo "<td>$row->vytvoril</td>";
                    echo "<td>$row->mod_trasy</td>";
                    if($row->aktivna_trasa > 0){
                        echo "<td><input onclick='check($i)' class='radio' type='radio' checked> </td>";
                    }
                    else{
                        echo "<td><input onclick='check($i)' class='radio' type='radio' ></td>";
                    }
                    echo "</tr>";
                    $i++;
                }
                $result->close();
            }
            ?>
            </tbody>
        </table>

        <h1 style="margin-top: 100px;">Všetky trasy</h1>

        <table class="table table-dark" id="vsetkyTrasy">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Štart</th>
                <th scope="col">Cieľ</th>
                <th scope="col">Prejdené km</th>
                <th scope="col">Dátum vytvorenia</th>
                <th scope="col">Definoval</th>
                <th scope="col">Mód</th>
                <th scope="col">Používateľ</th>


            </tr>
            </thead>
            <tbody>


            <?php

            $sql = "SELECT trasa.id as tid, pouzivatelia.id, pouzivatelia.meno, pouzivatelia.priezvisko, trasa.start_nazov, trasa.ciel_nazov, trasa_pouzivatel.prejdene_km, trasa.celkove_km, trasa.datum_vytvorenia, trasa_pouzivatel.aktivna_trasa, trasa.mod_trasy, trasa.vytvoril
                    FROM trasa_pouzivatel
                    INNER JOIN trasa ON trasa.id = trasa_pouzivatel.id_trasa
                    INNER JOIN pouzivatelia on pouzivatelia.id = trasa_pouzivatel.id_pouzivatel
                    ORDER BY aktivna_trasa DESC";


            $i = 1;
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<th scope='row'>$i <span class='spanId' >$row->id</span><span class='spanTid' >$row->tid</span></th>";
                    echo "<td>$row->start_nazov</td>";
                    echo "<td>$row->ciel_nazov</td>";
                    echo "<td>$row->prejdene_km/<b>$row->celkove_km</b></td>";
                    echo "<td>$row->datum_vytvorenia</td>";
                    //echo "<td>$row->aktivna_trasa</td>";
                    echo "<td>$row->vytvoril</td>";
                    echo "<td>$row->mod_trasy</td>";
                    echo "<td>$row->meno $row->priezvisko</td>";

                    echo "</tr>";
                    $i++;
                }
                $result->close();
            }
            ?>
            </tbody>
        </table>


    </div>
    <div class="col-4 rightCol">

        <img src="img/add.png"    id="privateBtn" class="addBtn" alt="add">
        <img src="img/public.png" id="publicBtn" class="addBtn" alt="add">
        <img src="img/relay.png"  id="relayBtn" class="addBtn" alt="add">
        <a href="stafetovyMod.php" > <img src="img/addpeople.png" id="addPeople" class="addBtn" alt="add"></a>
        <img src="img/distance.png" id="distanceBtn" class="addBtn" alt="add">

        <div class="addDiv">

            <form id="addForm">
                <div class="form-group">
                    <label for="formGroupExampleInput">Zadaj štart trasy</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Zadaj štart trasy" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Zadaj cieľ trasy</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Zadaj cieľ trasy" required>
                </div>

                <button type="button" id="searchBtn" class="btn btn-secondary">Vyhľadaj</button>
                <button type="button"  class="btn btn-danger">Potvrď</button>

            </form>


            <div id="myMap2" style="height: 40%; width: 100%"></div>

        </div>

        <div class="distanceDiv">

            <div class="distanceDiv">

                <form action="prebehnuteKm.php" method="post" >
                    <div class="form-group">
                        <label>Počet odbehnutých kilometrov:</label>
                        <input type="number" name="distance" class="form-control" id="distance" min="0" step="any" required>
                    </div>

                    <div class="form-group">
                        <label>Deň tréningu:</label>
                        <input class="form-control" name="date" type="date"  id="date" >
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Začiatok tréningu:</label>
                            <input class="form-control" name="treningStart" type="time"  id="startTime" >
                        </div>

                        <div class="form-group col-6">
                            <label>Koniec tréningu:</label>
                            <input class="form-control" type="time" name="treningEnd" id="endTime" >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Zemepisná šírka:</label>
                            <input type="number" class="form-control" name="lat" id="latitude" step="any" >
                        </div>

                        <div class="form-group col-6">
                            <label>Zemepisná dĺžka:</label>
                            <input type="number" class="form-control" name="lng" id="longtitude" step="any" >
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Hodnotenie tréningu:</label><br>
                        <select name="hodnotenie" class="custom-select custom-select-lg p-30">

                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Poznámka:</label>
                        <textarea class="form-control" rows="5" name="note" id="poznamka"></textarea>
                    </div>

                    <button type="submit" id="prebehnutyBtn" class="btn btn-danger col-4 offset-4">Potvrď</button>
                </form>



            </div>

        </div>

        <div class="progressDiv">
            <h4>Odbehnuté km tímu</h4>
            <div id="probar1">

            </div>
            <br>
            <h4>Odbehnuté km bežcov</h4>
            <div id="barClenovia"></div>
        </div>

    </div>
</div>

<script>
    function zmenitNastavenieAktualit(id){

        if(id=="zapUpozornenia"){
            $("#zapUpozornenia").addClass("active");
            $("#vypUpozornenia").removeClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=zap&lokacia=cestyAdmin.php";

        }else{
            $("#zapUpozornenia").removeClass("active");
            $("#vypUpozornenia").addClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=vyp&lokacia=cestyAdmin.php";
        }
    }

    if (window.location.href.indexOf("lat1=") > -1) {


        var url_string = window.location.href;
        var url = new URL(url_string);
        var lat1 = url.searchParams.get("lat1");
        var lng1 = url.searchParams.get("lng1");
        var lat2 = url.searchParams.get("lat2");
        var lng2 = url.searchParams.get("lng2");
        var vzd = url.searchParams.get("vzd");

    }



    function check(index) {
        for(var i = 1; i < document.getElementById("privatneTrasy").rows.length; i++){
            document.querySelector("#privatneTrasy tr:nth-child("+i+")  td:last-child .radio").checked = false;
        }
        document.querySelector("#privatneTrasy tr:nth-child("+index+")  td:last-child .radio").checked = true;
        var id = $("#privatneTrasy tr:nth-child("+index+") th span:first-child").text();
        var tid = $("#privatneTrasy tr:nth-child("+index+") th span:last-child").text();
        console.log(id);
        console.log(tid);
        //var str = "updateStavTrasy.php?index="+id+"&tid="+tid;
        //console.log(str);
        window.location.replace("updateStavTrasy.php?index="+id+"&tid="+tid);
    }
    $(document).ready(function () {

        $("#privatneTrasy").DataTable();
        $("#vsetkyTrasy").DataTable();


    })

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.0.1/progressbar.min.js"></script>
<script src="scripts/bar.js" ></script>
<script src="scripts/cesty.js" ></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArw-eyIcflcUehHyPzWx5FRzAr6EEI_68&libraries=places&callback=myMap"></script>


</body>
</html>