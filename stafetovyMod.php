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
<div class="formular">
    <form onsubmit="pridajTim(); return false;">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Zadajte názov tímu:</span>
            </div>
            <input type="text" id="menoTimu" required class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <?php
        require ('config.php');
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("UTF8");
        if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

        $query = " SELECT meno, priezvisko, id FROM pouzivatelia ";
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
        </div>

        <select id="odstranMena" class="custom-select">
            <option>Odstráňte člena z tímu</option>
        </select>
        <div id="buttonDiv">
            <input type="submit" id="vytvorTim" value="Vytvor tím" class="btn btn-secondary">

        </div>
    </form>
</div>


<script>
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


    function pridajTim(){
        if (pocetClenovTimu <= 6){
           // alert("OK");
           // console.log(clenoviaTimu);
            //for (var [key, value] of clenoviaTimu) {
               // var id = key;
               // var meno = value;
                var menoTimu = $('#menoTimu').val();
                //console.log(menoTimu);
           // }


               /*$.ajax({
                    type: "POST",
                    url: 'test.php',
                    data: ({Imgname:"13"}),
                    success: function(data) {
                        alert(data);
                    }
                });
                window.location = 'test.php';*/
        }
        else{
            alert("V tíme nie je dostatočný počet členov!");
        }
    }
</script>
</body>
</html>

