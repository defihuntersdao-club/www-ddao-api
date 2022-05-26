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

include __DIR__."/sale.php";

?>