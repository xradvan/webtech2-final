<?php
require_once "security/over_uzivatela.php";
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
                <li class="nav-item active">
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
                }
    </script>


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
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Zadaj štart trasy" required>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Zadaj cieľ trasy</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Zadaj cieľ trasy" required>
                </div>

                <button type="button" id="searchBtn" class="btn btn-secondary">Vyhľadaj</button>
                <button type="button" id="insertBtn" class="btn btn-danger">Potvrď</button>

            </form>


            <div id="myMap2" style="height: 40%; width: 100%"></div>

        </div>


    </div>
</div>

<script>
    var place,place2;
    var lat1,lat2,lng1,lng2;

    $(".addBtn").on('click', function () {
        $(".addDiv").slideToggle();
    });

    $("#insertBtn").on('click', function () {
        window.location.href = "pridajTrasu.php?lat1="+lat1+"&lng1="+lng1+"&lat2="+lat2+"&lng2="+lng2+"&start="+$("#formGroupExampleInput").val()+"&end="+$("#formGroupExampleInput2").val();


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
        var autocomplete2 = new google.maps.places.Autocomplete(ciel);

        var marker = new google.maps.Marker({
            map: map2,
            anchorPoint: new google.maps.Point(0, -29)
        });

        var marker2 = new google.maps.Marker({
            map: map2,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            marker.setVisible(false);
            place = autocomplete.getPlace();
            lat1 = place.geometry.location.lat();
            lng1 = place.geometry.location.lng();

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        });

        autocomplete2.addListener('place_changed', function() {
            marker2.setVisible(false);
            place2 = autocomplete2.getPlace();
            lat2 = place2.geometry.location.lat();
            lng2 = place2.geometry.location.lng();
            marker2.setPosition(place2.geometry.location);
            marker2.setVisible(true);
        });

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        directionsDisplay.setMap(map2);

        $("#searchBtn").on('click', function () {

            directionsService.route({
                origin: place.geometry.location,
                destination: place2.geometry.location,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });

        });

        /*function calculateAndDisplayRoute(directionsService, directionsDisplay) {

        }*/

    }


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArw-eyIcflcUehHyPzWx5FRzAr6EEI_68&libraries=places&callback=myMap"></script>


</body>
</html>