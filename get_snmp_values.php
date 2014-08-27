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


$intervalo_em_dias = 1;
$mysqli = dbconnect();
$rs = mysqli_query($mysqli,"SELECT concat('Dia:', day(datahora), DATE_FORMAT(datahora, ' %H:%i')) as 'data',
                                   valor
                              FROM logvoltagem 
                             WHERE (datahora BETWEEN (now() - interval $intervalo_em_dias day) AND now())
                               AND valor > 0 ;"
                  );


$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'Data e Hora', 'type' => 'string'),
    array('label' => 'Voltagem', 'type' => 'number')

);

$rows = array();
while($r = mysqli_fetch_array($rs)) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $r['data']); 

    // Values of each slice
    $temp[] = array('v' => (float) $r['valor']); 
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
echo $jsonTable;

?>