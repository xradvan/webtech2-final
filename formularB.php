<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <title>Formulár</title>
</head>
<body>
    <div class="container">

        <div>

            <div class="form-group">
                <label>Počet odbehnutých kilometrov:</label>
                <input type="number" class="form-control" id="distance" min="0" step="any" required>
            </div>

            <div class="form-group">
                <label>Deň tréningu:</label>
                <input class="form-control" type="date"  id="date" >
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label>Začiatok tréningu:</label>
                    <input class="form-control" type="time"  id="startTime" >
                </div>

                <div class="form-group col-6">
                    <label>Koniec tréningu:</label>
                    <input class="form-control" type="time"  id="endTime" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label>Zemepisná šírka:</label>
                    <input type="number" class="form-control" id="latitude" step="any" >
                </div>

                <div class="form-group col-6">
                    <label>Zemepisná dĺžka:</label>
                    <input type="number" class="form-control" id="longtitude" step="any" >
                </div>
            </div>


            <div class="form-group">
                <label>Hodnotenie tréningu:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineRadio1" value="option1"> 1
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineRadio2" value="option2"> 2
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineRadio3" value="option3"> 3
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineRadio4" value="option5"> 4
                </div>
                <div class="form-check form-check-inline"">
                    <input class="form-check-input" type="radio" id="inlineRadio5" value="option5"> 5
                </div>
            </div>

            <div class="form-group">
                <label>Poznámka:</label>
                <textarea class="form-control" rows="5" id="poznamka"></textarea>
            </div>

        <button type="button" id="insertBtn" class="btn btn-danger col-4 offset-4">Potvrď</button>
        </form>

    </div>


</body>
</html>