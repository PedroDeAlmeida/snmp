<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["gauge"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Bateria', 12.5],
        ]);

        var options = {
          width: 700, height: 300,
          redFrom: 0, redTo: 11.9,
          yellowFrom:11.9, yellowTo: 12.2,
          greenFrom:12.2, greenTo:12.8,
          blueFrom:12.8,
          minorTicks: 5,
          max:12.9,
          min:11.6
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 700px; height: 500px;"></div>
  </body>
</html>