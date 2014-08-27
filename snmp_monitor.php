<?php

function recordlogsnmpvoltagem($valor){

	date_default_timezone_set('America/Sao_Paulo');

	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'snmp_monitor';



	$con=mysqli_connect($servidor,$usuario,$senha,$banco);
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$datahora = date("Y-m-d H:i:s");


	$result = mysqli_query($con,"INSERT INTO logvoltagem (id, intervalo, datahora, valor) 
	                             VALUES (NULL, 1, '$datahora', $valor)");


	mysqli_close($con);
	return 0 ;
}


$ip = "10.0.201.2";
$oid = ".1.3.6.1.4.1.14988.1.1.3.8.0";
$snmpvaluetype = 'float';

$snmpinformation = snmpget($ip,"public",$oid);

$snmpreturnstring = explode(': ', $snmpinformation);
$snmpdatatype = $snmpreturnstring[0];
$snmpvalue = $snmpreturnstring[1];


settype($snmpvalue, $snmpvaluetype);
$snmpvalue = $snmpvalue / 10;

recordlogsnmpvoltagem($snmpvalue);

?>