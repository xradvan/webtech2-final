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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link rel="stylesheet" href="./css/cesty.css">
    <title>Document</title>
</head>
<body>

<<<<<<< HEAD
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <span class="navbar-brand" >Navbar</span>
=======

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
>>>>>>> 2f5b5616057e54da81cbb26ea99216ca8074d2a1
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
<<<<<<< HEAD
                    <a class="nav-link" href="#">Link <span class="sr-only">(current)</span></a>
=======
                    <a class="nav-link" href="cesty.php">Domov</a>
>>>>>>> 2f5b5616057e54da81cbb26ea99216ca8074d2a1
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
<<<<<<< HEAD
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
=======
                <li class="nav-item">
                    <a class="nav-link" href="aktuality.php">
                        Aktuality
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="aktuality.php?odhlasenie='1'"><img src="logOut.png" width="25px" height="20px"></a></li>
>>>>>>> 2f5b5616057e54da81cbb26ea99216ca8074d2a1
            </ul>
        </div>
    </nav>


    <div class="row">
        <div class="col-8 leftCol">
            <div id="myMap" style="height: 400px; width: 70%"></div>

            <div class="dropdown show " id="trasyId">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Výber trasy
                </a>

                <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Trasa 1</a>
                    <a class="dropdown-item" href="#">Trasa 2</a>
                    <a class="dropdown-item" href="#">Trasa 3</a>
                </div>
            </div>

            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>

                </tbody>
            </table>

        </div>
        <div class="col-4 rightCol">

            <img src="img/add.png" class="addBtn" alt="add">

            <div class="addDiv">

                <form id="addForm">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Zadaj štart trasy</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Zadaj štart trasy">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Zadaj cieľ trasy</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Zadaj cieľ trasy">
                    </div>

                    <button type="button" class="btn btn-secondary">Vyhľadaj</button>
                </form>


                <div id="myMap2" style="height: 40%; width: 100%"></div>

            </div>


        </div>
    </div>

    <script>

        $(".addBtn").on('click', function () {
            $(".addDiv").slideToggle();
        });
        var map;
        var map2;
        function myMap() {
            var myLatLng = {lat: 48.6737532, lng: 19.696058};
            var mapProp= {
                center:myLatLng,
                zoom:7
            };
            var mapProp2= {
                center:myLatLng,
                zoom:6
            };
            map = new google.maps.Map(document.getElementById("myMap"),mapProp);
            map2 = new google.maps.Map(document.getElementById("myMap2"),mapProp2);


            /*----------------------------------------------------------*/


            var start = document.getElementById('formGroupExampleInput');
            var ciel = document.getElementById('formGroupExampleInput2');

            var autocomplete = new google.maps.places.Autocomplete(start);

            var marker = new google.maps.Marker({
                map: map2,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                marker.setVisible(false);
                var place = autocomplete.getPlace();

                if (place.geometry.viewport) {
                    map2.fitBounds(place.geometry.viewport);
                } else {
                    map2.setCenter(place.geometry.location);
                    map2.setZoom(8);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });




        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArw-eyIcflcUehHyPzWx5FRzAr6EEI_68&libraries=places&callback=myMap"></script>

<<<<<<< HEAD
=======
>>>>>>> Cesty -> nav, mapa, autocomplet
>>>>>>> 2f5b5616057e54da81cbb26ea99216ca8074d2a1
</body>
</html>