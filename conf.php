<?php

error_reporting(0);
include __DIR__."/func.php";
include "conf.sql.php";

$www_dir = __DIR__."/htdocs/";
$cache_dir = __DIR__."/htdocs/cache/";

// $debug_ip[] = "";
$f = "/debug_ip.php";
if(file_exists($f))
include $f;

$f = "/rpc.php";
if(file_exists($f))
include $f;

$curl1 = "curl --connect-timeout 1 -H 'content-type: application/json' -X POST --data ";


include __DIR__."/sale.php";
include __DIR__."/contracts.php";

?>