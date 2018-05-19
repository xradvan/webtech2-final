// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

    var dataTemp = [
        ['Meno', '', { role: 'style' }]
    ];

    // Vlozenie dat z DB
    for (var d of bezciInfo) {
        dataTemp.push(d)
    }

    var data = google.visualization.arrayToDataTable(dataTemp);


    var options = {
        'title':'Odbehnuté km členov',
        'width':450,
        };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('barClenovia'));
    chart.draw(data, options);
}
