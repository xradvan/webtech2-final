<?php
	require ('config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("UTF8");
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    $datum = date("Y-m-d");
    $query ="DELETE FROM aktuality WHERE id = '$_GET[id]'";
    $result = mysqli_query($conn,$query);
    $conn->close();
    header('location:aktuality.php');

?>
