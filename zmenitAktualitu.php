<?php
if(isset($_POST['editTitulok'])  && isset($_POST['editObsah']) && isset($_POST['editDatum']) && isset($_POST['aktualitaId'])){
	require ('config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    $query ="UPDATE aktuality SET titulok= '$_POST[editTitulok]', obsah='$_POST[editObsah]', datum = '$_POST[editDatum]'  WHERE id = '$_POST[aktualitaId]'";
    $result = mysqli_query($conn,$query);
    $conn->close();
    header('location:aktuality.php');
}

?>