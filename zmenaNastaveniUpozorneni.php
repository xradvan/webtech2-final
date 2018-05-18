<?php
	include("security/over_uzivatela.php");

	if(isset($_SESSION['email'])){
		require ("config.php");
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("UTF8");
        if($_GET['not']=="zap"){
        	$query = "UPDATE pouzivatelia SET odoberatel = 1 WHERE email = '$_SESSION[email]'";
    	}else{
    		$query = "UPDATE pouzivatelia SET odoberatel = 0 WHERE email = '$_SESSION[email]'";
    	}
        $result = mysqli_query($conn,$query);
    	$conn->close();
	}
    header("location: ".$_GET[lokacia]."");
?>