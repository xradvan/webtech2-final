<?php
    include("security/over_uzivatela.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Členovia tímov</title>
</head>
<body>
<img src="/img/back.png" alt="back">
</body>
</html>
<?php
$nazovTimu = $_GET["nazov"];

require ('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$query = " SELECT * FROM zoznamtimov WHERE nazovTimu ='$nazovTimu'";
$result = mysqli_query($conn,$query);
echo "<table>";
echo "<th>Členovia tímu</th>";
while ($data = mysqli_fetch_array($result)) {
    $odkaz = "zobrazTim.php?del=".$data['idUzivatela'];
    echo "<tr>";
    echo "<td>". $data['idUzivatela']."</td>";
    echo "<td><a href='$odkaz'>&#10006;</a></td>";
    echo "</tr>";
}
echo "</table>";