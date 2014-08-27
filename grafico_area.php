<?php

function dbconnect(){
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'snmp_monitor';



    $mysqli=mysqli_connect($servidor,$usuario,$senha,$banco);
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      return 0;
    }

    return $mysqli;
}


$intervalo_em_dias = 2;
$mysqli = dbconnect();
$rs = mysqli_query($mysqli,"SELECT concat('Dia:', day(datahora), DATE_FORMAT(datahora, ' %H:%i')) as 'data',
                                   valor
                              FROM logvoltagem 
                             WHERE (datahora BETWEEN (now() - interval $intervalo_em_dias day) AND now())
                               AND valor > 0 ;"
                  );

$jsdata = '';


while($row = mysqli_fetch_array($rs)) {    
  $jsdata = $jsdata . "['" . $row['data'] . "'," . $row['valor'] . "]," . "\n";
}

//echo $jsdata;

?>


<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart","gauge"]});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = google.visualization.arrayToDataTable
          ([
            ['Data e Hora',  'Voltagem'],<?php echo $jsdata; ?> 
          ]);

        var options = {
          title: 'Analise ultimo(s) <?php echo $intervalo_em_dias; ?>  dia(s)',
          vAxis: {title: 'Voltagem'},
          isStacked: true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    <div id="gauge_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>