<?php
    include("security/over_uzivatela.php");
    if(isset($_GET['odhlasenie'])){
    session_destroy();
    unset($_SESSION['rola']);
    unset($_SESSION['email']);
    header("location:prologue.php");
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/aktuality.css">
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
    <title>Aktuality</title>
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
                    <?php 
                        if($_SESSION['rola']== "admin"){
                            echo '<a class="nav-link" href="cestyAdmin.php">Domov</a>';
                        }else{
                            echo '<a class="nav-link" href="cesty.php">Domov</a>';
                        }
                     ?>
                    
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Upozornenia
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                        $email= $_SESSION['email'];
                        $query="SELECT odoberatel from pouzivatelia WHERE email='$email'";
                        $result = mysqli_query($conn,$query);
                        while ($data = mysqli_fetch_array($result)){
                            if($data['odoberatel'] == 1){
                                echo '<a class="dropdown-item active" href="#" id="zapUpozornenia" onclick="zmenitNastavenieAktualit(\'zapUpozornenia\');">Zapnúť</a>';
                                echo '<a class="dropdown-item " href="#" id="vypUpozornenia" onclick="zmenitNastavenieAktualit(\'vypUpozornenia\');">Vypnúť</a>';
                            }else{
                                echo '<a class="dropdown-item" href="#" id="zapUpozornenia" onclick="zmenitNastavenieAktualit(\'zapUpozornenia\');">Zapnúť</a>';
                                echo '<a class="dropdown-item active" href="#" id="vypUpozornenia" onclick="zmenitNastavenieAktualit(\'vypUpozornenia\');">Vypnúť</a>';
                            }
                        }
                        $conn->close();
                    ?>
                </div>
                </li>
                <li class="nav-item active">
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
    <script type="text/javascript">
                var user = '<?php echo $_SESSION['rola']; ?>';
                if(user=="admin"){
                    $("#registracia").css("display","inline");
                    $("#osobneVykony").css("display", "none");
                }
    </script>
    <div class="container aktualityDiv" id="containerAktuality">
        <div class="container aktualityLeft col-lg-4" id="left">
        <?php
            require ('config.php');
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("UTF8");
            if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
            $query="SELECT * from aktuality";
            $result = mysqli_query($conn,$query);
            $i=1;
            while ($data = mysqli_fetch_array($result))
            {   
                if($i%2==1){
                    echo '<div class="card" id="'.$data['id'].'">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$data['titulok'].'</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">'.$data['datum'].'</h6>';
                    echo '<p class="card-text">'.$data['obsah'].'</p>';
                     if($_SESSION['rola']=="admin"){
                        echo '<input type="image" src="img/edit.png" onclick="editovatAktualitu(\''.$data['id'].'\');" width="22" height="24"></button>';
                        echo '<input type="image" src="img/delete.png" onclick="window.location =\'zmazatAktualitu.php?id='.$data['id'].'\';" width="24" height="24" class="deleteButton">';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                $i++;
            }

            
            $conn->close();
        ?>
        </div>
        <div class="container aktualityMiddle col-lg-4">
            <form id="pridatAktualituForm" method="POST" action="pridatAktualitu.php">
                    <div class="form-group">
                    <label for="titulok">Titulok</label>
                    <input type="text" class="form-control" id="titulok" name="titulok" placeholder="zadajte nadpis aktuality">
                    </div>
                    <div class="form-group">
                    <label for="obsah">Aktualita</label>
                    <textarea class="form-control" id="obsah" name="obsah" rows="10" placeholder="zadajte popis aktuality"></textarea>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-light">Pridať aktualitu</button>
                    </div>
                    </form>
            
        </div>
        <div class="container aktualityRight col-lg-4" id="right">
        <?php
            require ('config.php');
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("UTF8");
            if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
            $query="SELECT * from aktuality";
            $result = mysqli_query($conn,$query);
            $i=1;
            while ($data = mysqli_fetch_array($result))
            {   
                if($i%2==0){
                    echo '<div class="card" id="'.$data['id'].'">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$data['titulok'].'</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">'.$data['datum'].'</h6>';
                    echo '<p class="card-text">'.$data['obsah'].'</p>';
                    if($_SESSION['rola']=="admin"){
                        echo '<input type="image" src="img/edit.png" onclick="editovatAktualitu(\''.$data['id'].'\');" width="22" height="24"></button>';
                        echo '<input type="image" src="img/delete.png" onclick="window.location =\'zmazatAktualitu.php?id='.$data['id'].'\';" width="24" height="24" class="deleteButton">';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                $i++;
            }

            
            $conn->close();
        ?>
        </div>
    </div>
    <script type="text/javascript">
                var user = '<?php echo $_SESSION['rola']; ?>';
                if(user=="admin"){
                    $(".aktualityMiddle").css("display","inline");
                    
                }else{
                    $(".aktualityMiddle").css("display","none");
                    $("#left").removeClass("col-lg-4").addClass("col-lg-6");
                    $("#left").css("padding-right","0.5em");
                    $("#right").removeClass("col-lg-4").addClass("col-lg-6");
                    $("#right").css("padding-left","0.5em");
                }

            </script>
    <div class="lightBox">
        <div class="container editDiv">
            <form method="POST" action="zmenitAktualitu.php">
                <div class="form-group">
                    <label for="editTitulok">Titulok</label>
                    <input type="text" class="form-control" name="editTitulok" id="editTitulok">
                </div>
                <div class="form-group">
                    <label for="editDatum">Dátum</label>
                    <input type="date" class="form-control" name="editDatum" id="editDatum">
                </div>
                <div class="form-group">
                    <label for="editObsah">Aktualita</label>
                    <textarea class="form-control" id="editObsah" name="editObsah" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-light">uložiť zmeny</button>
                </div>
                <input type="text" style="display: none;" name="aktualitaId" id="aktualitaId">
            </form>
        </div>
        <i class="fas fa-times"></i>
    </div>
    <?php

    ?>
    <script type="text/javascript">

        function zmenitNastavenieAktualit(id){

        if(id=="zapUpozornenia"){
            $("#zapUpozornenia").addClass("active");
            $("#vypUpozornenia").removeClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=zap&lokacia=aktuality.php";

        }else{
            $("#zapUpozornenia").removeClass("active");
            $("#vypUpozornenia").addClass("active");
            window.location.href = "zmenaNastaveniUpozorneni.php?not=vyp&lokacia=aktuality.php";
        }
    }
    
        function editovatAktualitu(id){
            var editTitulok = $("#"+id + " h5").text();
            var editObsah = $("#"+id + " p").text();
            var datum = new Date();
            $("#editTitulok").val(editTitulok);
            $("#editObsah").val(editObsah);
            $("#aktualitaId").val(id);
            document.getElementById("editDatum").valueAsDate = new Date();
            $(".lightBox").fadeIn();
            
        }

        $(".fa-times").on("click", function(){
            $(".lightBox").fadeOut();
        })
    </script>
</body>
</html>