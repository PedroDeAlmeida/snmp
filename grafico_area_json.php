<html>
  <head>
       <!-- Load jQuery -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart","gauge"]});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var jsonData = $.ajax({url: "/snmp/get_snmp_values.php",dataType: "json",async: false}).responseText;      

        var jsonData2 = $.ajax({url: "/snmp/get_snmp_values2.php",dataType: "json",async: false}).responseText; 

        var realVoltage = parseFloat(jsonData2);


        var data = new google.visualization.DataTable(jsonData);

        var data2 = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Carga',realVoltage],
        ]);        

        var options = {
          title: 'Analise ultimo(s) 2 dia(s)',
          vAxis: {title: 'Voltagem'},
          isStacked: true
        };

        var options2 = {
          width: 200, height: 200,
          //yellowFrom:14.01,yellowTo:14.5,
          //greenFrom:13.8, greenTo:14.0,
          //redFrom: 13.3, redTo: 13.7, 
          animation:{duration: 6000},         
          minorTicks: 3,
          //max:14.0,
          //min:11.6
          max:13.6,
          min:13.0          
        };        

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
        var chart2 = new google.visualization.Gauge(document.getElementById('gauge_div'));
        
        chart.draw(data, options);
        chart2.draw(data2, options2);


        setInterval(function() {
          var jsonData2 = $.ajax({url: "/snmp/get_snmp_values2.php",dataType: "json",async: false}).responseText;   
          var realVoltage = parseFloat(jsonData2);
          data2.setValue(0,1,realVoltage);
          chart2.draw(data2, options2);
        }, 10000);           
      } 

      setInterval(function(){
        drawChart();
      }, 60000);   


    </script>
  </head>
  <body>
    <div style="float: left;">
      <div id="gauge_div" style="float: right; width: 200px; height: 200px;"></div>    
      <div id="chart_div" style="float: right; width: 900px; height: 300px;"></div>
    </div>

  </body>
</html>