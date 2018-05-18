<?php
include("security/over_uzivatela.php");
?>

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
    <link rel="stylesheet" href="./css/stafetovyMod.css">
    <title>Štafetový mód - administrátor</title>
</head>
<body>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <span class="navbar-brand" >

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

            <li class="nav-item active">
                <a class="nav-link" href="druzstva.php">
                    Družstvá
                </a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="aktuality.php?odhlasenie='1'"><img src="logOut.png" width="25px" height="20px"></a></li>
        </ul>
    </div>
</nav>
<div class="formular">
       <div id="zobrazPrve">
           <h5>Maximálny počet členov v tíme: 6 </h5>
           <div class="input-group mb-3">
               <div class="input-group-prepend">
                   <span class="input-group-text" id="basic-addon1">Zadajte názov tímu:</span>
               </div>
               <input type="text" id="menoTimu" required class="form-control" aria-label="Username" aria-describedby="basic-addon1">
           </div>
           <div class="buttonDiv">
               <input type="button" id="potvrd" value="Potvrď" class="btn btn-secondary">
           </div>
       </div>

        <form onsubmit="return false;">
        <div id="zobrazDruhe">
            <?php
            require ('config.php');
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("UTF8");
            if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
            $meno = $_GET["nazov"];
            echo "<h4>Názov tímu: <span id='menot'>".$meno."</span></h4>";
            $query = " SELECT id, meno, priezvisko FROM pouzivatelia WHERE nazovtimu is NULL";
            $result = mysqli_query($conn,$query);
            $i = 1;
            echo "<select id='menaDoTimov' class='custom-select'>";
            echo "<option value = 0>"."Vyberte člena do tímu"."</option>";
            while ($data = mysqli_fetch_array($result))
            {
                echo "<option value='" . $data['id']."'>" . $data['meno']." ".$data['priezvisko']. "</option>";
                $i++;
            }
            echo "</select>";
            ?>

            <div id='menaClenovTimu'>
                <h4>Členovia tímu: </h4>
                <?php
                $meno = $_GET["nazov"];
                $query = " SELECT id, meno, priezvisko FROM pouzivatelia WHERE nazovtimu='".$meno."'";
                $result = mysqli_query($conn,$query);
                while ($data = mysqli_fetch_array($result))
                {
                    echo "<option value='" . $data['id']."'>" . $data['meno']." ".$data['priezvisko']. "</option>";
                    $i++;
                }
                ?>
            </div>
            <select id="odstranMena" class="custom-select">
                <option>Odstráňte člena z tímu</option>
            </select>
            <div class="buttonDiv">
                <input type="submit" id="vytvorTim" value="Vytvor tím" class="btn btn-secondary">

            </div>
        </div>
    </form>
</div>

<script>
    $("#potvrd").on("click",function(){
        if( $("#menoTimu").val() != '' ) {
            var meno = $("#menoTimu").val();
            console.log(meno);
            window.location.href = "stafetovyMod.php?nazov="+meno;
        }
        else{
            alert("Vyplňte názov tímu!");
        }
    });

    var pocetClenovTimu = 0;
    var clenoviaTimu = new Map();
    $('#menaDoTimov').on('change', function() {
        if(pocetClenovTimu <= 6){
            var value = $(this).val();
            var meno = $('#menaDoTimov option[value ="'+ value +'"]').text();
            var div = $('<div />').attr({'id':value }).html(meno);
            div.appendTo('#menaClenovTimu');
            $("#odstranMena").append('<option value= '+value+'>'+meno+'</option>');
            $('#menaDoTimov').find(":selected").remove();
            clenoviaTimu.set(value,meno);
            console.log(clenoviaTimu);
            pocetClenovTimu++;
        }else  {
            alert("Nie je možné pridať viac členov do tímu.");
        }
    });

    $('#odstranMena').on('change', function() {
        if(pocetClenovTimu != 0){
            var value = $(this).val();
            var meno = $('#odstranMena option[value ="'+ value +'"]').text();
            $("#menaDoTimov").append('<option value= '+value+'>'+meno+'</option>');
            clenoviaTimu.delete(value);
            console.log(clenoviaTimu);
            $('#'+value+'').remove();
            $('#odstranMena').find(":selected").remove();
            pocetClenovTimu--;


        }else{
            alert("Tím neobsahuje žiadnych členov.");
        }
    });

    $("#vytvorTim").on("click",function(){
        if (pocetClenovTimu <= 6){
            var menot = $('#menot').text();
            var i = 1;
            var url = "test.php?";
            for (var [key, value] of clenoviaTimu) {
                var id = key;
                url += i+"="+id+"&";
                i++;
            }
                url += "tim="+menot;
            window.location = url;
        }
        else{
            alert("V tíme nie je dostatočný počet členov!");
        }
    });



</script>

<?php

if(isset($_GET["nazov"])){
    $meno = $_GET["nazov"];
    require ('config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    $query = " SELECT nazovtimu FROM pouzivatelia WHERE nazovtimu='".$meno."'";
    $result = mysqli_query($conn,$query);
    $pocet = 0;

    if ($result == $conn->query($query)){
        while ($data = mysqli_fetch_array($result)) {
            $pocet++;
        }
    }

    if ($pocet >= 3){
        echo "<script>alert('Tím je plný!')</script>";
        echo "<script> window.location.href = 'stafetovyMod.php'</script>";
    }

    else{
        echo"<script>$('#zobrazDruhe').css('display','block'); </script>";
        echo"<script>$('#zobrazPrve').css('display','none')</script>";
    }
}
?>
</body>
</html>

