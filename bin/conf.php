<?php

include "../conf.php";


$f = "/opt/rpc_need.txt";
if(file_exists($f))
$rpc = file_get_contents($f);
else
$rpc = "https://polygon-rpc.com/";

$curl1 = "curl --connect-timeout 1 -H 'content-type: application/json' -X POST --data ";

?>