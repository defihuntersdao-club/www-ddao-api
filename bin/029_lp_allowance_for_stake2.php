#!/usr/bin/php
<?php

include "conf.php";

print date("Y-m-d H:i:s\n");
$time = time();

$prefix = "stake2_";

//$a = "0x457280d60d23C40dbA92C00Acd3e701De040C8cb";
//$contract = $a;
include "stake2_contract.php";
$contract = $stake2_contract;
print "Contract: $contract\n";


$tkns[lp_ddao_weth] = "0xfC067766349d0960bdC993806EA2E13fcFC03C4D";
$tkns[lp_gnft_weth] = "0x03B67a0cE884E806673CC92e9A1C4A77D5BC770B";
$tkns[lp_gnft_usdc] = "0x3fd0CC5f7Ec9A09F232365bDED285e744E0446e2";

//$tkns[usdc] = "0x2791Bca1f2de4661ED88A30C99A7a9449Aa84174";
//$tkns[usdt] = "0xc2132D05D31c914a87C6611C10748AEb04B58e8F";
//$tkns[dai]  = "0x8f3Cf7ad23Cd3CaDbD9735AFf958023239c6A063";


//die;
do
{
unset($o,$o2,$o3);
//$o = $o2;
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
$o2[$w][$prefix."contract"] = $contract;
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
$v[id] = "allowance-".$coin."-".$w;
$jss[] = $v;
//------------------------
//------------------------
/*
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
$v[id] = "decimal-".$coin."-".$w;
$jss[] = $v;
*/
}


}

//print_r($jss);die;

$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = $id;
    $t = explode("-",$t);
    $case = $t[0];
    $coin = $t[1];
    $wal = $t[2];
    $v = $v2[result];
    $v = gmp_hexdec($v);
    $v = gmp_strval($v);
    $o3[$wal][$coin][$case] = $v;
//    $o3[$id][$case] = $v;
}
//print_r($o3);die;
foreach($o3 as $wal=>$v3)
foreach($v3 as $coin=>$v2)
{
    $t = $v2[allowance]/10**$v2[decimal];
    $t = gmp_div_q($v2[allowance],10**$v2[decimal]);
    $t = gmp_strval($t);
//    if($t > 1000000)$t = "&#8734;";
    if($t > 1000000)$t = "∞";
    $o2[$wal][$prefix."allowance_".$coin] = $t;
}
// print_r($o2);

foreach($o2 as $w=>$v2)
{
    $txt = json_encode($v2,192);
    $t = pathinfo(__FILE__);
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json";
    $a = @file_get_contents($f);
//    if(file_exists($f))    print "File exists: $f\n";
//print $f."\n";
if(0)
{
print "md5(a) = ".md5($a)."\n";
print $a;
print "\nmd5(t) = ".md5($txt)."\n";
print $txt."\n";
}
    if(1)
    if(md5($a) != md5($txt))
    {
    file_put_contents($f,$txt);
    print "Save $w\n";
    }

}


//die;

for($i=0;$i<3;$i++)
{
    print ".";
    sleep(1);
}

}
while(time() < ($time+59));


