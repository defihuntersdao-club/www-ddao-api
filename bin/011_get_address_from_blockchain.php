#!/usr/bin/php
<?php

include "conf.php";

$time = time();

switch($argv[1])
{
    case "test":
    break;
    default:
    $contractAddress = "0xa9a2d6b16f3dd4c145aa8c875b9ceb8cda3022e3";
    $tkn = "0x90F3edc7D5298918F7BB51694134b07356F7d0C7";
}

$n_mas[0] = "ddao_seed_";
$n_mas[1] = "ddao_private1_";
$n_mas[2] = "ddao_private2_";

do
{
unset($q);
unset($jss);
unset($wal_mas);
$q[] = "SELECT * FROM address WHERE ymdhi = '".date("YmdHi",time())."'";
$q[] = "SELECT * FROM address WHERE ymdhi = '".date("YmdHi",time()-60)."'";
$query = "(".implode(")UNION(",$q).")";
//print $query."\n";
$res = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($res))
{
//    print_r($row);
    $w = $row[name];
    $w = strtolower($w);
    $wal_mas[] = $w;
}
print_r($wal_mas);

foreach($wal_mas as $w)
{

for($i=0;$i<3;$i++)
{
//------------------------------------------------
unset($t);
//$t[from] = $wal;
//$b = "0xdd3680fc";
$b = "0x6c75356b";
//0x70a08231000000000000000000000000b2207c34de61f3018576cb637fa90dae0425d916
$t2 = substr($w,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

$t2 = $i; 
$t2 = view_number($t2,64,"0");
$b .= $t2;

$t2 = 0; 
$t2 = view_number($t2,64,"0");
$b .= $t2;

$t[data] = $b;
$t[to] = $contractAddress;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-".$n_mas[$i]."aviable";
$jss[] = $v;

//------------------------------------------------
unset($t);
//$t[from] = $wal;
//$b = "0xdd3680fc";
$b = "0x0cabfbb3";
//0x70a08231000000000000000000000000b2207c34de61f3018576cb637fa90dae0425d916

$t2 = $i; 
$t2 = view_number($t2,64,"0");
$b .= $t2;

$t2 = substr($w,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;


$t[data] = $b;
$t[to] = $contractAddress;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-".$n_mas[$i]."claimed";
$jss[] = $v;

//------------------------------------------------
unset($t);
//$t[from] = $wal;
//$b = "0xdd3680fc";
$b = "0x70a08231";
//0x70a08231000000000000000000000000b2207c34de61f3018576cb637fa90dae0425d916
/*
$t2 = $i; 
$t2 = view_number($t2,64,"0");
$b .= $t2;
*/

$t2 = substr($w,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;


$t[data] = $b;
$t[to] = $tkn;
//print_r($t);

$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."_"."AllocSaleAmount_".$sale_id;
$v[id] = $w."-"."ddao_balance";
$jss[] = $v;


}

}

print_r($jss);
//error_reporting(65535);

unset($mas);
//$jss = $jss2[$name];
//$mas = curl_mas($jss,$rpc,1);
print "Send ".count($jss)." requests to blockchain [$name]\n";
$t = $time;
//print "Get data from blockchain in ".count($jss)." requests\n";
if(count($jss))
{
$mas = curl_mas($jss,$rpc,1);
}
$t = time()-$t;
print "Get data from blockchain in ".count($jss)." requests [$t sec]\n\n";

print_r($mas);

foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("-",$id);
    $w = $t[0];
    $k = $t[1];
    $t = $v2[result];
    $t = gmp_hexdec($t);
    $t = gmp_div($t,10**18);
    $t = gmp_strval($t);
    $o[$w][$k] = $t;

}
print_r($o);
foreach($o as $w=>$v2)
{
    $txt = json_encode($v2,192);
    $f = $cache_dir.$w.".json";
//    if(file_exists($f))
    $a = @file_get_contents($f);
    if(md5($a) != md5($txt))
    {
    file_put_contents($f,$txt);
    print "Save $w\n";
    }

}

for($i=0;$i<3;$i++)
{
    print ".";
    sleep(1);
}

}
while(time() < ($time+59));

print "END\n";
?>