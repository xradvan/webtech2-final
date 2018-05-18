
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./css/prologue.css">
    <title>Dokumentácia</title>
</head>
<body>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
    <div class="navbar-header">
        <span class="navbar-brand" id="vitajte" href="#"><b>Vitajte!</b></span>
    </div>
    <ul class="nav navbar-nav">
        <li ><a href="prologue.php">Home</a></li>
        <li><a href="#" name="adresa_uzivatel" onclick="adresaUzivatelia();">Adresy užívateľov</a></li>
        <li><a href="#" name="adresa_skoly" onclick="adresaSkoly();">Adresy škôl</a></li>
        <li class="active"><a href="dokumentacia.php" name="dokumentacia">Dokumentácia</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="security/registracia.php"><span class="glyphicon glyphicon-user"></span> Registrácia</a></li>
        <li><a href="security/prihlasenie.php"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Prihlásenie</a></li>
    </ul>
</div>
</nav>
    <div class="col-lg-6">
        <table class="table table-dark table-bordered text-center"  id="pouzivateliaTable">
        <h1 class="text-center">Rozdelenie úloh</h1>
            <thead>
            <tr>
                <th scope="col"  class="text-center">Úloha</th>
                <th scope="col"  class="text-center">Marek Bláha</th>
                <th scope="col"  class="text-center">Nikola Čarnogurská</th>
                <th scope="col"  class="text-center">Matúš Bubelíny</th>
                <th scope="col"  class="text-center">Marcel Boldiš</th>
                <th scope="col"  class="text-center">Peter Radvan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td scope="col">Verzionovací systém Github</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            </tr>
            <tr>
            <td scope="col">Registrácia</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            </tr>
            <tr>
            <td scope="col">Registrácia adminom</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            </tr>
            <tr>
            <td scope="col">Prihlásenie</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            </tr>
            <tr>
            <td scope="col">Definovanie trasy</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">Nastavenie módu trasy</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            </tr>
            <tr>
            <td scope="col">Tabuľka s trasami (aktivácia/deaktivácia)</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            </tr>
            <tr>
            <td scope="col">Štafetový mód</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">Grafické odlíšenie členov trasy</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">Tabuľka osobných výkonov</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">Tabuľka všetkých používateľov pre admina</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">Generovanie PDF súboru</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">Úvodná strana</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">Aktualizácia údajov v tabuľke výkonov</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            <tr>
            <td scope="col">pridávanie aktualít s odoslaním na e-mail</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-success">A</td>
            <td scope="col" class="bg-danger">N</td>
            <td scope="col" class="bg-danger">N</td>
            </tr>
            </tbody>
            </table>
            </div>
            <div class="col-lg-6">
            <h1 class="text-center">Technická dokumentácia</h1>
            <h3>Použité knižnice / frameworky</h3>
            <ul>
                <li>jQuery</li>
                <li>Bootstrap</li>
                <li>PHPMailer</li>
            </ul>
            <h3>Použité API</h3>
            <ul>
                <li>Google Maps</li>
                <li>Google Maps</li>
                <li>Google Maps</li>
            </ul>
            <h3>Repozitár</h3>
            <ul>
                <li><a href="https://github.com/xradvan/webtech2-final">Github</a></li>
            </ul>
            </div>
            
</body>
</html>