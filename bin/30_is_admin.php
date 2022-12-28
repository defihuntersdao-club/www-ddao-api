#!/usr/bin/php
<?php

include "conf.php";

print date("Y-m-d H:i:s\n");
$time = time();

$prefix = "contract_admin_";

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

//$a = "0x457280d60d23C40dbA92C00Acd3e701De040C8cb";
//$contract = $a;
//include "stake2_contract.php";
unset($c_mas);
$c_mas[2] = $contracts[stake2];
//print "Contract: $contract\n";
foreach($c_mas as $contract)
{
foreach($wal_mas as $name=>$w)
{
unset($v,$t,$t2,$t3,$t4);
//$b .= view_number($i,64,0);
//$b = "0x01111de4";
// balanceof
// IsAdmin:        0xb11e3c1a
$b = "0xb11e3c1a";
//$t = "0x3a434BBF72AF14Ae7cBf25c5cFA19Afe6A25510c";
$t = $w;
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contract;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "admin_".$w;
$jss[] = $v;

}
}
//print_r($jss);
$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $case = $t[0];
    $wal = $t[1];
    $v = $v2[result];
    $v = hexdec($v);
    
    $o2[$wal][$prefix.$name] = $v;

}
//print_r($o2);
foreach($o2 as $w=>$v2)
{
    $txt = json_encode($v2,192);
print $txt;
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
