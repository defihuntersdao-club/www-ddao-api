#!/usr/bin/php
<?php
include "conf.php";
//include "../../conf.php";
//include "../../vendor/autoload.php";

print date("Y-m-d H:i:s\n");
$time = time();

$a = "0xcc6ae25446913bf846e1022cde3e3854a9e8ab1e";
$contractAddress = $a;
//$contractAddress = "0x0eeca57a97928ca02a5A4b56bF1bE0D926CF3aa7";;
//print "Contract address: $contractAddress\n";

//$rpc = $rpc_mas[$net];
//print "RPC: $rpc\n";
//die;

//$f_save = "pool.json";

//$kurs = 2422;
//$wal_mas[] = "0x3a434BBF72AF14Ae7cBf25c5cFA19Afe6A25510c";
//$wal_mas[] = "0x330eC7c6AfC3cF19511Ad4041e598B235D44862f";

do
{
unset($o,$o2,$o3,$jss);
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

//for($i=0;$i<10;$i++)
foreach($wal_mas as $w)
{
unset($v,$t,$t2,$t3,$t4);
//$b .= view_number($i,64,0);
//$b = "0x01111de4";
// balanceif nft hamster
$b = "0x70a08231";
//$t = "0x3a434BBF72AF14Ae7cBf25c5cFA19Afe6A25510c";
$t = $w;
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

//$t = 0;
//$t = view_number($t,64,0);
//$b .= $t;


$t2[from] = "0x0000000000000000000000000000000000000000";
$t2[data] = $b;
$t2[to] = $contractAddress;
//print_r($t);
unset($v);
$v[jsonrpc] = "2.0";
$v[method] = "eth_call";
//$v[params][0] = $row[wal];
$v[params][0] = $t2;
$v[params][1] = "latest";
//$v[id] = $row[id];
$v[id] = "hamster_".$w;
$jss[] = $v;
}


//print_r($jss);
unset($out);
print "Send ".count($jss)." requests to blockchain\n";
$t = $time;
//print "Get data from blockchain in ".count($jss)." requests\n";
if(count($jss))
{
$mas = curl_mas2($jss,$rpc,0);
}
$t = time()-$t;
print "Get data from blockchain in ".count($jss)." requests [$t sec]\n";

//print_r($mas);
//die;
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $case = $t[0];
    $w = $t[1];
    $val = $v2[result];

    switch($case)
    {
	case "hamster":
	    $val = hexdec($val);
	break;
    }
//print "\033[01;33m";
//print "--------------------------- $w -----------------";
//print "\033[00m";
//print "\n";

$o2[$w][my_hamsters_count] = $val;


}


foreach($o2 as $w=>$v2)
{
    $txt = json_encode($v2,192);
    $t = pathinfo(__FILE__);
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json";
    $a = @file_get_contents($f);
//    if(file_exists($f))    print "File exists: $f\n";
//print $f."\n";
//    print $txt;

    if(md5($a) != md5($txt))
    {
    file_put_contents($f,$txt);

    print "Save $w [$f]\n";
    }

}


    for($i=0;$i<5;$i++)
    {
	print ".";
	sleep(1);
    }
}
while(time() < ($time + 59));