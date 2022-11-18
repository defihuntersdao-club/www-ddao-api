#!/usr/bin/php
<?php

include "conf.php";

print date("Y-m-d H:i:s\n");
$time = time();

$prefix = "buy_ddao_";

$a = "0x5d75668712a8f300680EEBf9d17a57CF3aae5dd2";
//$a = "0xB78DE295b26d54969A6581A4944e61860A93F520";
$contract = $a;


$tkns[usdc] = "0x2791Bca1f2de4661ED88A30C99A7a9449Aa84174";
$tkns[usdt] = "0xc2132D05D31c914a87C6611C10748AEb04B58e8F";
$tkns[dai]  = "0x8f3Cf7ad23Cd3CaDbD9735AFf958023239c6A063";


//die;
do
{
unset($o,$o3);
$o = $o2;
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

reset($wal_mas);
foreach($wal_mas as $w)
{

reset($tkns);
foreach($tkns as $coin=>$addr)
{

unset($t2,$v);
$b = "0xdd62ed3e";

$t = substr($w,2);
$t = view_number($t,64,"0");
$b .= $t;

$t = substr($contract,2);
$t = view_number($t,64,"0");
$b .= $t;


$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $addr;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."-".$n."-$pair-$name";
$v[id] = "allowance_".$coin."_".$w;
$jss[] = $v;
//------------------------
//------------------------
unset($t2,$v);
$b = "0x313ce567";
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $addr;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
//$v[id] = $net."-".$n."-$pair-$name";
$v[id] = "decimal_".$coin."_".$w;
$jss[] = $v;
}

}

print_r($jss);

$mas = curl_mas2($jss,$rpc,1);
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = $id;
    $t = explode("_",$t);
    $case = $t[0];
    $coin = $t[1];
    $wal = $t[2];
    $v = $v2[result];
    $v = gmp_hexdec($v);
    $v = gmp_strval($v);
    $o3[$wal][$coin][$case] = $v;
//    $o3[$id][$case] = $v;
}
//print_r($o3);
foreach($o3 as $wal=>$v3)
foreach($v3 as $coin=>$v2)
{
    $t = $v2[allowance]/10**$v2[decimal];
    $t = gmp_div_q($v2[allowance],10**$v2[decimal]);
    $t = gmp_strval($t);
    if($t > 1000000)$t = "&#8734;";
    $o2[$wal]["buy_allowance_".$coin] = $t;
}
 print_r($o2);

die;

for($i=0;$i<3;$i++)
{
    print ".";
    sleep(1);
}

}
while(time() < ($time+59));


