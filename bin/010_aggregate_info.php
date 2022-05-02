#!/usr/bin/php
<?php
include "conf.php";

    $d = "".$www_dir."cache/tmp";
$time = time();
do
{
unset($log,$q);
unset($out);
print date("Y-m-d H:i:s\t");
unset($wal_mas);
$q[] = "SELECT * FROM address WHERE ymdhi = '".date("YmdHi",time())."'";
$q[] = "SELECT * FROM address WHERE ymdhi = '".date("YmdHi",time()-60)."'";
$query = "(".implode(")UNION(",$q).")";
//print $query."\n";
$log[] = json_encode($q,192);
//$log[] = "-=-=-=-=-=";

$res = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($res))
{
//    print_r($row);
    $w = $row[name];
    $w = strtolower($w);
    $wal_mas[] = $w;
}
//print_r($wal_mas);
print "Found ".count($wal_mas)." addresses\t";

foreach($wal_mas as $w)
{
    unset($reg,$out);
    $exec = "ls $d | grep -i $w";
//    print $exec."\n";
    exec($exec,$reg);
    $log[] = $exec;
    $log[] = json_encode($reg,192);
    //print_r($reg);
    $kolvo = count($reg);
    print "Found $kolvo records\t";
    foreach($reg as $v2)
    {
    $f = $d."/".$v2;
    //print "$f\n";
    $a = file_get_contents($f);
    $log[] = $f;
    $log[] = $a;
    $a = json_decode($a,1);
    if(isset($out))$out = array_merge($out,$a);
    else $out = $a;
    }
    
    $f = $cache_dir."$w.json";
    $b = json_encode($out,192);
    $c = @file_get_contents($f);

//print $c."\t".md5($c)."\n";
//print $b."\t".md5($b)."\n";
    if(md5($c) != md5($b))
    {
    $log[] = $f;
    file_put_contents($f,$b);
    print "$w updated. log[$f_log]\n";
    $log[] = $b;
    
	$f_log = "/tmp/wallet.$w.log";
	$log_txt = "====== ".date("Y-m-d H:i:s")." =======\n";
	foreach($log as $n=>$v)
	{
	    $log_txt .= "------- $n -----\n";
	    $log_txt .= $v."\n";
	}
	$f2 = fopen($f_log,"a+");
	fwrite($f2,$log_txt);
	fclose($f2);
    }
//print_r($out);
}
//print ".";
sleep(1);
print "\n";

}
while(time() < ($time+59));
