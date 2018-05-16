<?php
	if (isset($_POST['subor'])) {
		$myfile = fopen("C:\Users\Nika\Downloads\osoby2.csv", "r") or die("Unable to open file!");
		require ('config.php');
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->set_charset("UTF8");
        if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
           
		$i=0;
		while (($data = fgetcsv($myfile, 1000, ";")) !== FALSE) {
			if($i>0){
				$heslo = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ%?_"), 0, 20);
				$hesloHash = password_hash($heslo, PASSWORD_BCRYPT);
    			$import="INSERT into pouzivatelia(meno,priezvisko,email,heslo,stredna_skola,stredna_skola_adresa,ulica,psc,obec,rola,odoberatel)values('".$data[2]."','".$data[1]."','".$data[3]."','".$hesloHash."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','user','0')";
    			mysqli_query($conn,$import) or die(mysqli_error($conn));
			}
			$i=1;
		}

		fclose($myfile);
		
	}

?>