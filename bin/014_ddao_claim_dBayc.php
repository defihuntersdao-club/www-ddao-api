#!/usr/bin/php
<?php

include "conf.php";

print date("Y-m-d H:i:s\n");

$time = time();

/*
print_r($argv);


switch($argv[1])
{
    case "test":
        $contractAddress = "0xb50c22c740D5a034023459bAccD3c785C6bB8303";
	$tkn 	= "0x47a1162C73b565c7F0a5bD16168e3B2cA38942D5";
	$tkn2	= "0x0EEAfFCfeA437f5822Fc1537b95Fc84EEBb3D9Db";
	
    break;
    default:
	$contractAddress = "0xa9a2d6b16f3dd4c145aa8c875b9ceb8cda3022e3";
        $tkn 	= "0x90F3edc7D5298918F7BB51694134b07356F7d0C7";
	$tkn2 	= "0xCA1931C970CA8C225A3401Bb472b52C46bBa8382";
}
*/
//$contractAddress = "0xAAC0EeB23A168387711BAace2F142F02AA117169";

$contractAddress = "0x5E1dA69FDE8f9D041B6B95167875D23AAb43281F";

$n_mas[0] = "ddao_dbayc_";
//$n_mas[1] = "ddao_private1_";
//$n_mas[2] = "ddao_private2_";

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

//for($i=0;$i<3;$i++)
{
//------------------------------------------------
unset($t);

//ClaimAmount
$b = "0x5e23e037";
$t2 = substr($w,2);
$t2 = view_number($t2,64,"0");
$b .= $t2;

//$t2 = $i; 
//$t2 = view_number($t2,64,"0");
//$b .= $t2;

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
$v[id] = $w."-".$n_mas[0]."aviable";
$jss[] = $v;

//------------------------------------------------
unset($t);
//$t[from] = $wal;
//$b = "0xdd3680fc";
//$b = "0x0cabfbb3";
# claimed (payed)
$b = "0xb449c24d";
//0x70a08231000000000000000000000000b2207c34de61f3018576cb637fa90dae0425d916

//$t2 = $i; 
//$t2 = view_number($t2,64,"0");
//$b .= $t2;

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
$v[id] = $w."-".$n_mas[0]."claimed";
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

    switch($k)
    {
	case "ddao_balance":
	    if($t>100000)$t = "100k+";
	break;
	default:
    }
    $o[$w][$k] = $t;

$o[$w][contract_ddao_team] = $contractAddress;
//$o[$w][addr_addao] = $tkn2;
//$o[$w][time] = date("Y-m-d H:i:s");

}

print_r($o);
foreach($o as $w=>$v2)
{
    $txt = json_encode($v2,192);
    $t = pathinfo(__FILE__);
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json";
    $a = @file_get_contents($f);
//    if(file_exists($f))
//print $f."\n";
//print "md5(a) = ".md5($a)."\n";
//print $a;
//print "\nmd5(t) = ".md5($txt)."\n";
//print $txt."\n";

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