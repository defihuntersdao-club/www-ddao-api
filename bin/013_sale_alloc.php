#!/usr/bin/php
<?php

// no cron file
// one start this, after modify file in sale dir

include "conf.php";
//error_reporting(65535);

$d = __DIR__."/sale/";
$h = opendir($d);
while($f = readdir($h))
{
    if($f=="." || $f == "..")continue;

    $t = pathinfo($f);
//print_r($t);die;
    $t = $t[filename];

    $t = explode("_",$t);
    $id = $t[1];
    $name = $t[2];

    $tf = $d.$f;
    $a = file_get_contents($tf);
    $a = trim($a);
    $mas = explode("\n",$a);
    foreach($mas as $w=>$v)
    $preg = "/[\s]{1,100}/si";
    foreach($mas as $l)
    {
    $l = preg_replace($preg,"\t",$l);
    $t = explode("\t",$l);
    $w = $t[0];
    $v = $t[1];
    $sale[$name][$w] = $v;
    }
}
//print_r($sale);
/*
$t = json_encode($sale,192);
$f = __FILE__.".json";
file_put_contents($f,$t);
*/

$d = __DIR__;
$d = dirname($d);
reset($sale);
foreach($sale as $k=>$v3)
foreach($v3 as $w=>$v)
{
    $k2 = "pool_".$k;
    $o2[$w][$k2] = $v;
}
print_r($o2);
foreach($o2 as $w=>$v)
{
    $t = pathinfo(__FILE__);
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json";

    $t = json_encode($v,192);
    file_put_contents($f,$t);
}