<?php
require_once "security/over_uzivatela.php";
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/osobneVykony.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
    <title>Ososbné výkony</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <span class="navbar-brand" >
            <?php
                require ('config.php');
                $conn = new mysqli($servername, $username, $password, $dbname);
                $conn->set_charset("UTF8");
                $email= $_SESSION['email'];
                if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
                $query="SELECT meno, priezvisko from pouzivatelia WHERE email='$email'";
                $result = mysqli_query($conn,$query);
                while ($data = mysqli_fetch_array($result)){
                    echo "Vitajte ".$data['meno']." ".$data['priezvisko'];
                }
            ?>
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cesty.php">Domov</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Upozornenia
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="#">Zapnúť</a>
                        <a class="dropdown-item active" href="#">Vypnúť</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aktuality.php">
                        Aktuality
                    </a>
                </li>
                <li class="nav-item" id="registracia" style="display: none;">
                    <a class="nav-link" href="registraciaPouzivatela.php">
                        Používatelia
                    </a>
                </li>
                <li class="nav-item" id="osobneVykony" style="display: inline;">
                    <a class="nav-link" href="osobneVykony.php">
                        Osobné výkony
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="aktuality.php?odhlasenie='1'"><img src="logOut.png" width="25px" height="20px"></a></li>
            </ul>
        </div>
    </nav>

    <div class="container text-center col-lg-10">
        <h4 class="text-left">Používateľ <strong><?php echo $_SESSION['meno']." ".$_SESSION['priezvisko']; ?></strong></h4>
    	<table class="table table-dark table-bordered"  id="pouzivateliaTable">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">COL 1</th>
                <th scope="col">COL 2</th>
                <th scope="col">COL 3</th>
                <th scope="col">COL 1</th>
                <th scope="col">COL 2</th>
                <th scope="col">COL 3</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    /*if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
                        $query="SELECT id, meno, priezvisko, rola from pouzivatelia";
                        $result = mysqli_query($conn,$query);
                        $i=1;
                        while ($data = mysqli_fetch_array($result)){
                            echo '<tr>';
                            echo '<th scope="row">'.$i.'</th>';
                            echo '<td>'.$data["meno"].'</td>';
                            echo '<td>'.$data["priezvisko"].'</td>';
                            if($data['rola'] == "user"){
                                echo '<td><input type="checkbox" class="checkbox" value="'.$data['id'].'"></td>';
                            }else{
                                echo '<td><input type="checkbox" class="checkbox" checked value="'.$data['id'].'"></td>';
                            }
                             echo '</tr>';
                             $i++;
                        }
                        $conn->close();*/

                ?>
            </tbody>
        </table>
    </div>
    <div class="container text-center col-lg-2">
        <input type="image" src="img/download.png" id="ulozit" width="70" height="70"><br>
        <span>Uložiť tabulku ako PDF</span>
        <button type="button" class="btn-lg btn-danger" id="returnButton" style="display:none">Späť na používateľov</button>
    </div>

     <script type="text/javascript">
        var user = '<?php echo $_SESSION['rola']; ?>';
        if(user=="admin"){
            $("#registracia").css("display","inline");
            $("#osobneVykony").css("display", "none");
            $("#returnButton").css("display","inline");
        }
    </script>

<script type="text/javascript">
    $( "#returnButton" ).click(function() {
            window.location.href = "registraciaPouzivatela.php";
        });

	 $( document ).ready(function() {
      $('#pouzivateliaTable').DataTable();
      $("#ulozit").on('click', function () {
      	// parse the HTML table element having an id=exportTable
          var dataSource = shield.DataSource.create({
            data: "#pouzivateliaTable",
            schema: {
                type: "table",
                fields: {
                    Meno: { type: String },
                    Priezvisko: { type: String },
                    Admin: { type: String }
                }
            }
        });

        // when parsing is done, export the data to PDF
        dataSource.read().then(function (data) {
            var pdf = new shield.exp.PDFDocument({
                author: "Webtech",
                created: new Date()
            });

            pdf.addPage("a4", "portrait");

            pdf.table(
                50,
                50,
                data,
                [
                    { field: "Meno", title: "Meno", width: 100 },
                    { field: "Priezvisko", title: "Priezvisko", width: 100 },
                    { field: "Admin", title: "Admin", width: 50 }
                ],
                {
                    margins: {
                        top: 50,
                        left: 50
                    }
                }
            );

            pdf.saveAs({
                fileName: "OsobneVykony"
            });
        });
    });
});

</script>
</body>
</html>