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


$mysqli = dbconnect();
$rs = mysqli_query($mysqli,"select * from logvoltagem where valor > 0");
//$rs = mysqli_query($mysqli,"SELECT * FROM logvoltagem
//                             WHERE (datahora BETWEEN '2014-08-22 12:00:00' AND '2014-08-22 14:00:00')");
$jsdata = '';

//WHERE (`datahora` BETWEEN '2014-08-22 02:35:00' AND '2014-08-22 02:37:00')

while($row = mysqli_fetch_array($rs)) {    
  $jsdata = $jsdata . "['" . $row['datahora'] . "'," . $row['valor'] . "]," . "\n";
}

//echo $jsdata;

?>


<html>
<body>
<script type="text/javascript"
        src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1',
                                                                 'packages':['corechart']}]}"></script>
<script>
google.setOnLoadCallback(drawChart);
function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'x');
    data.addColumn('number', 'values');


    data.addRows([<?php echo $jsdata; ?>]);

    // The intervals data as narrow lines (useful for showing raw source
    // data)
    var options_lines = {
        title: '21/08/2014',
        curveType:'function',
        lineWidth: 2,
        intervals: { 'style':'line' }, // Use line intervals.
        legend: 'none',
    };

    var chart_lines = new google.visualization.LineChart(document.getElementById('chart_lines'));
    chart_lines.draw(data, options_lines);
}
</script>

<div id="chart_lines" style="width: 1200px; height: 500px;"></div>
</body>
</html>