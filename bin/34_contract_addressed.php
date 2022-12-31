#!/usr/bin/php
<?php

include "conf.php";

print date("Y-m-d H:i:s\n");
$time = time();

$prefix = "contract_address_";

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

foreach($wal_mas as $wal)
{
    foreach($contracts as $k=>$v)
    {
	$o2[$wal][$prefix.$k] = $v;
    }
}
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
