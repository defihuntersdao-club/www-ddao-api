#!/usr/bin/php
<?php
include "conf.php";

print date("Y-m-d H:i:s\n");
$time = time();

$prefix = "farm_claim_";

$num = $argv[1];
$num *= 1;
if(!$num)$num = 1;

$nn = $argv[2];
$nn *= 1;
if(!$nn)$nn = 1;

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

//------------------
unset($v,$t,$t2,$t3,$t4);
// RewardNum:      0x436d37ba
$b = "0x436d37ba";
$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contracts[stake2];
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "rewards";
$jss[] = $v;

reset($wal_mas);
foreach($wal_mas as $wal)
{
//------------------
unset($v,$t,$t2,$t3,$t4);
// RewardNum:      0x436d37ba
//$b = "0x436d37ba";
// StakeNum:       0x63777247
$b = "0x63777247";
$t = $wal;
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;


$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contracts[stake2];
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "stakes_".$wal;
$jss[] = $v;
}

//print_r($jss);
$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $case = $t[0];
    $w = $t[1];
    $v = $v2[result];
    $v = hexdec($v);
    switch($case)
    {
	case "stakes":
	$stat[$case][$w] = $v;
	break;
	case "rewards":
	$stat[$case] = $v;
	break;
    }
}
//print_r($stat);
//die;

unset($jss);
for($rew = 1;$rew <= $stat[rewards];$rew++)
{

//------------------
unset($v,$t,$t2,$t3,$t4);
// RewardNum:      0x436d37ba
//$b = "0x436d37ba";
// StakeNum:       0x63777247
// RewardDecimals: 0xb917e040
$b = "0xb917e040";

$t = $contracts[stake2];
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t = $rew;
$t = dechex($t);
//$t = substr($t,2);
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
$v[id] = "decimals_".$rew;
$jss[] = $v;

//print $rew."\n";
reset($wal_mas);
foreach($wal_mas as $wal)
{
//$amount[$wal][$rew] = 0;
//$o2[$wal][amount][$rew] = 0;
$o2[$wal][$prefix."amount_$rew"] = 0;
$o2[$wal][$prefix."claimed_$rew"] = 0;



if($stat[stakes][$wal]>0)
{
for($i=1;$i<=$stat[stakes][$wal];$i++)
{
//---------------------------------
unset($v,$t,$t2,$t3,$t4);
// RewardNumByAddr:        0x493942f6
$b = "0x493942f6";

$t = $rew;
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

$t = $i;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t = 0;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contracts[stake2];
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "rew_".$wal."_".$rew."_".$i;
$jss[] = $v;
//-----------------------------------------
unset($v,$t,$t2,$t3,$t4);
// Claimed:        0x987d620f
$b = "0x987d620f";


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

$t = $rew;
$t = dechex($t);
//$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;


$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contracts[stake2];
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "claimed_".$wal."_".$rew."_".$i;
$jss[] = $v;
//-----------------------------------------
}
}
}
}
print_r($jss);
//die;
$mas = curl_mas2($jss,$rpc,0);
//print_r($mas);
//die;
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $case = $t[0];
    $w = $t[1];
    $num = $t[2];
    $nn = $t[3];

    $v = $v2[result];
    $v = hexdec($v);


    switch($case)
    {
	case "rew":
	    $v /= 10**$decimals[$num];
//	    $o2[$w][amount[$num]+=$v;
	    $o2[$w][$prefix."amount_$num"]+=$v;
	break;
	case "claimed":
//	    $v /= 10**18;
	    $v /= 10**$decimals[$num];
//	    $o2[$w][claimed][$num]+=$v;
	    $o2[$w][$prefix."claimed_$num"]+=$v;
	break;
	case "decimals":
	    $decimals[$w] = $v;
	break;
    }
//    $o2[$w][$prefix.$n
}
//print_r($o2);
//print_r($decimals);
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


?>