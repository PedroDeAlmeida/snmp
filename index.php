<?php

echo "////////SNMPGet///////<br>";

$ip = "10.0.201.2";
$oid = ".1.3.6.1.4.1.14988.1.1.3.8.0";
$snmpvaluetype = 'float';

$snmpinformation = @snmpget($ip,"public",$oid);

$snmpreturnstring = explode(': ', $snmpinformation);
$snmpdatatype = $snmpreturnstring[0];
$snmpvalue = $snmpreturnstring[1];


settype($snmpvalue, $snmpvaluetype);
$snmpvalue = $snmpvalue / 10;

var_dump($snmpvalue);

?>