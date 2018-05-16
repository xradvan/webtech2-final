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
<<<<<<< HEAD
    <h1>Cesty</h1>
    <?php echo $_SESSION["rola"]; ?>
=======

    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <span class="navbar-brand" >Navbar</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Link <span class="sr-only">(current)</span></a>
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
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

>>>>>>> Cesty -> nav, mapa, autocomplet
</body>
</html>