<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Úvodná stránka</title>
</head>
<body>
<form>
    <input type="submit" value="Adresa Userov" name="adresa_uzivatel">
    <input type="submit" value="Adresa Skol" name="adresa_skoly">
</form>

<div id="googleMap" style="width:50%;height:350px;"></div>
<script src="scripts/map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzAGVYxB7GHyFD0rDQuIiKZMWiYKWBqsw&callback=myMap"></script>

<?php
require ('config.php');
/*$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}*/

if (isset($_GET['adresa_uzivatel'])) {
    echo "Je vyplnena adresa uzivatela";

    /*$query="SELECT * from User";
    $result = mysqli_query($conn,$query);

    while ($data = mysqli_fetch_array($result))
    {
        $data['name'];
    }*/

}
elseif (isset($_GET['adresa_skoly'])) {
    echo "Je vyplnena adresa skoly";
}


?>

</body>
</html>