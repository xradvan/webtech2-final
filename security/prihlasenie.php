<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prihlásenie</title>

    <!--  Bootstrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/prihlasenie.css">
</head>

    <body class="text-center">
    <form class="form-signin" action="prihlasenie_script.php">
        <h1 class="h3 mb-3 font-weight-normal">Prihlásenie</h1>
        <br>
        <label for="email" class="sr-only">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
        <label for="heslo" class="sr-only">Heslo</label>
        <input type="password" name="heslo" id="heslo" class="form-control" placeholder="Heslo" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Prihlásiť</button>
    </form>
    </body>


</html>