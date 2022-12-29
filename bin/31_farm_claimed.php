#!/usr/bin/php
<?php
include "conf.php";

print date("Y-m-d H:i:s\n");
$time = time();

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
unset($v,$t,$t2,$t3,$t4);
//$b .= view_number($i,64,0);
//$b = "0x01111de4";
// balanceof
// IsAdmin:        0xb11e3c1a
$b = "0xb11e3c1a";
//ClaimList2:     0x249dcf6c
$b = "0x249dcf6c";
// ClaimList:      0x9126e536
$b = "0x9126e536";
//$t = "0x3a434BBF72AF14Ae7cBf25c5cFA19Afe6A25510c";
$t = $contracts[stake2];
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t = 2;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t = $wal;
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contracts[info2];
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "rew_".$wal;
$jss[] = $v;
}
print_r($jss);
$mas = curl_mas2($jss,$rpc,0);
print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $case = $t[0];
    $w = $t[1];
    $v = $v2[result];
    unset($t4);
    switch($case)
    {
	case "rew":
	$t = $v;
	$t = substr($t,2);
	$l = strlen($t)/64;
	    for($i=0;$i<$l;$i++)
	    {
		$t2 = substr($t,$i*64,64);
		print $i."\t";
		print $t2."\t";
		$t3 = gmp_hexdec($t2);
		$t3 = gmp_strval($t3);
		print "$t3\t";
		print "\n";
		$t4[$i] = $t3;
	    }
	break;
    }
//
    print $t4[0] / 10**$t4[6];
    print "\n";
    print "\n";
    
}

?>