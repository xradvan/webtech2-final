<?php
require ('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$values = $_SERVER['REQUEST_URI'];
parse_str($_SERVER['QUERY_STRING'], $output);

for ($i = 1; $i < count($output); $i++){
    $query="INSERT INTO zoznamtimov (idUzivatela,nazovTimu) VALUES ('".$output[$i]."','".$output['tim']."')";
    $result = mysqli_query($conn,$query);
    echo "<script>window.location.href ='stafetovyMod.php'</script>";
}
?>