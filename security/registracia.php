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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>

<body>


    <div class="container">
        <!--  Alert  -->
        <div class="alert alert-danger d-none" id="alert">
            Zadaná emailová adresa sa už používa
        </div>

        <form action="registracia_script.php" method="POST" class="col-lg-6 offset-lg-3 needs-validation" novalidate>
            <br>
            <h1>Registrácia</h1>
            <br>

            <label for="email">Email</label>
            <input type="email" class="form-control" name="email"  id="email" required>
            <div class="invalid-feedback">
                Zadajte platný email.
            </div>


            <label for="heslo">Heslo</label>
            <input type="password" class="form-control" name="heslo"  id="heslo" required>


            <label for="meno">Meno</label>
            <input type="text" class="form-control" name="meno"  id="meno" autofocus required>


            <label for="priezvisko">Priezvisko</label>
            <input type="text" class="form-control" name="priezvisko"  id="priezvisko" required>


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
            <br><br>
        </form>

    </div>
    <script>
        // Zobrazenie alertu
        if(window.location.href.indexOf("fail") > -1) {
            $('#alert').removeClass("d-none");
        }

        // Validacia
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    </body>
</html>