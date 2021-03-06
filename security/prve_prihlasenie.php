<?php
session_start();
//if (isset($_SESSION["email"])) {
//    header("location: ../cesty.php");
//}

?>
<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prvé prihlásenie</title>

    <!--  Bootstrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/prihlasenie.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body class="text-center">
<form class="form-signin" action="prve_prihlasenie_script.php" method="POST" onsubmit="return validate()">
    <h1 class="h3 mb-3 font-weight-normal">Prvé prihlásenie.</h1>
    <h6>Prosím zmeňte si Vaše heslo.</h6>
    <h6 class="text-danger d-none" id="alert-zhoda">Nové heslá sa musia zhodovať</h6>
    <h6 class="text-danger d-none" id="alert-login">Nesprávne meno, alebo heslo.</h6>
    <br>
    <input type="password" name="heslo" id="stare-heslo" class="form-control" placeholder="Staré heslo" required autofocus>
    <input type="password" name="nove-heslo" id="nove-heslo" class="form-control" placeholder="Nové heslo" required >
    <input type="password" name="znovu-nove-heslo" id="znovu-nove-heslo" class="form-control" placeholder="Znovu nové heslo" required >
    <br>
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Zmeniť heslo</button>
    <br>
    <div id="spat" class="btn btn-lg btn-primary btn-block btn-danger">Späť na úvod</div>
</form>

<script>
    // Zobrazenie alertu

    // Nespravne meno alebo heslo
    if(window.location.href.indexOf("pass=fail") > -1) {
        $('#alert-login').removeClass("d-none");
    }


    $( "#spat" ).click(function() {
        window.location.href = "../prologue.php";
    });


    function validate() {
        var nove = $('#nove-heslo').val();
        var stare = $('#znovu-nove-heslo').val();

        if (nove !== stare) {
            $('#alert-zhoda').removeClass("d-none");
            return false;
        }

        return true;
    }

</script>
</body>
</html>