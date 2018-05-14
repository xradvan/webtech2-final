<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrácia</title>

    <!--  Bootstrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>




<body>
    <div class="container">

        <form action="registracia_script.php" class="col-lg-6 offset-lg-3">
            <h1>Registrácia</h1>
            <br>

            <label for="meno">Meno</label>
            <input type="text" class="form-control" name="meno"  id="meno" autofocus required>


            <label for="priezvisko">Priezvisko</label>
            <input type="text" class="form-control" name="priezvisko"  id="priezvisko" required>


            <label for="email">Email</label>
            <input type="email" class="form-control" name="email"  id="email" required>



            <label for="stredna_skola">Stredná škola</label>
            <input type="text" class="form-control" name="stredna_skola" id="stredna_skola" required>



            <label for="stredna_skola_adresa">Adresa strednej školy</label>
            <input type="text" class="form-control" name="stredna_skola_adresa"  id="stredna_skola_adresa" required>



            <label for="ulica">Ulica</label>
            <input type="text" class="form-control" name="ulica"  id="ulica" required>



            <label for="psc">PSČ</label>
            <input type="text" class="form-control" name="psc"  id="psc" required>



            <label for="obec">Obec</label>
            <input type="text" class="form-control" name="obec" id="obec" required>


            <br><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Registruj</button>
        </form>

    </div>


</body>


</html>