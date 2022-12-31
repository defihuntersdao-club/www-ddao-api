#!/usr/bin/php
<?php
include "conf.php";

print date("Y-m-d H:i:s\n");
$time = time();

$prefix = "ddao_group_";

$num = $argv[1];
$num *= 1;
if(!$num)$num = 1;

$nn = $argv[2];
$nn *= 1;
if(!$nn)$nn = 1;

do
{
unset($o,$o2,$o3);
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
foreach($wal_mas as $wal)
{
// balanceOfLevel 0xe69ace47
for($i = 1;$i <= 3;$i++)
{
$b = "0xe69ace47";

$t = $wal;
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t = $i;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;


$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contracts[proxy];
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "group_".$wal."_".$i;
$jss[] = $v;
//-----------------------------------------
}
}
//print_r($jss);
$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $w = $t[1];
    $grp = $t[2];
    $v = $v2[result];
    $v = hexdec($v);
    $o2[$w][$prefix.$grp] = $v;
}
//print_r($o2);
foreach($o2 as $w=>$v2)
{
    $txt = json_encode($v2,192);
//print $txt;
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


//------------------
//print_r($wal_mas);
for($i=0;$i<5;$i++)
{
    print ".";
    sleep(1);
}


}
while(time() < ($time+59));
