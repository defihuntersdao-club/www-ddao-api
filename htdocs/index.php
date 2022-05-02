<?php


include "../conf.php";
//	$_SERVER['QUERY_STRING']	
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
if(in_array($ip,$debug_ip))$debug = 1;

$debug_file = "/tmp/api_debug.txt";
$debug = @file_get_contents($debug_file);


$ref = $_SERVER[HTTP_REFERER];
$t = pathinfo($ref);
//print_r($t);
//print $ref;
$domen[] = "https://app-test.defihuntersdao.club/";
$domen[] = "https://app.defihuntersdao.club/";

if(!in_array($ref,$domen))
{
    $err = "Your server not accessed";
}

if(!$err)
{


$t = $_SERVER['REQUEST_URI'];
$t = explode("?",$t);
$var_query = $t[1];
$t = $t[0];
$t = explode("/",$t);
$item = $t[1];
$item2 = $t[2];
$var_query = $_SERVER['QUERY_STRING'];


	$inc = "inc/$item.php";
//print_r($sale_mas);die;
if(file_exists($inc))
include $inc;


if(!isset($o))
{
    $o[error] = "Data doesn't exists";
}

}
else
{
    $o[error] = $err;
}

$txt = json_encode($o,192);
print $txt;

?>