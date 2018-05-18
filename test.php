<?php
require ('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("UTF8");
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

$values = $_SERVER['REQUEST_URI'];
parse_str($_SERVER['QUERY_STRING'], $output);

$query2="INSERT INTO tim  (nazov) VALUES ('".$output['tim']."')";
$result2 = mysqli_query($conn,$query2);

for ($i = 1; $i < count($output); $i++){

    $query = "SELECT id from tim ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn,$query);
    $idT = 0;

    while ($data = mysqli_fetch_array($result)){

        $idT = $data['id'];

    }
    $query3="UPDATE pouzivatelia SET id_timu = ".$idT." WHERE id = ".$output[$i];
    $result3 = mysqli_query($conn,$query3);

}
echo "<script>window.location.href ='stafetovyMod.php'</script>";
?>