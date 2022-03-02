<?php
$db["host"] = "127.0.0.1";
$db["user"] = "defihuntersdao-api";
$db["pass"] = "apiddao";
if(!$db["name"])
$db["name"] = "api";

$con = mysqli_connect($db["host"],$db["user"],$db["pass"],$db["name"]);
if(mysqli_connect_error())
{
    print "Mysqli Connect Err $db[host]\n";
    die;
}
?>
