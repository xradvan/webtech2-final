// Odbehnute km timu
var odbehnuteTim = 70;
var odbhenuteTimTotal = 112;

var properties = {
    color: '#aaa',

    strokeWidth: 4,
    trailWidth: 1,
    easing: 'easeInOut',
    duration: 1400,
    text: {
        autoStyleContainer: false
    },
    from: { color: '#aaa', width: 1 },
    to: { color: '#333', width: 4 },
    step: function(state, circle) {
        circle.path.setAttribute('stroke', state.color);
        circle.path.setAttribute('stroke-width', state.width);

        var value = Math.round(circle.value() * 100);
        if (value === 0) {
            circle.setText('');
        } else {
            circle.setText(value + " / " + odbhenuteTimTotal + " km");
        }

    }
}

var bar = new ProgressBar.Circle(probar1, properties);
bar.animate(odbehnuteTim / odbhenuteTimTotal);




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
        'width':450,
        };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('barClenovia'));
    chart.draw(data, options);
}
