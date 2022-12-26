#!/usr/bin/php
<?php
include "conf.php";
//include "../../conf.php";
//include "../../vendor/autoload.php";

print date("Y-m-d H:i:s\n");
$time = time();

//$a = "0xc4CD50Ab4e1a30fa0Cf2E67aEe2042Cb419a9595";
//$a = "0xbf4389e2716918fD1ecA1AaF4942e7f37fAc1e75";
$a = "0x457280d60d23C40dbA92C00Acd3e701De040C8cb";

$contractAddress = $a;
//$contractAddress = "0x0eeca57a97928ca02a5A4b56bF1bE0D926CF3aa7";;
print "Contract address: $contractAddress\n";

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
//BalanceWallet:  0xb94d9d80
//BalanceWallet:  0x39d42f12
//$b = "0xb94d9d80";
$b = "0x39d42f12";
//$t = "0x3a434BBF72AF14Ae7cBf25c5cFA19Afe6A25510c";
$t = $w;
$t = substr($t,2);
//$t = substr($w,2);
$t = view_number($t,64,0);
$b .= $t;

$t = 0;
$t = view_number($t,64,0);
$b .= $t;


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
$v[id] = "BalanceWallet_".$w;
$jss[] = $v;
}


print_r($jss);
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

print_r($mas);
//die;
foreach($mas as $v2)
{
    $id = $v2[id];
    $t = explode("_",$id);
    $case = $t[0];
    $w = $t[1];
//print "\033[01;33m";
//print "--------------------------- $w -----------------";
//print "\033[00m";
//print "\n";
    switch($case)
    {
        case "BalanceWallet":
//    print $v2[id]."\t";
    $t = $v2[result];
    $t = substr($t,2);
    $l = strlen($t)/64;
    for($i=0;$i<$l;$i++)
    {
        $t2 = substr($t,$i*64,64);
        $i2 = $i-2;
        //print $i."\t".$t2."\t";

        switch($i)
        {
            case "4":
            case "12":
            case "20":
                $t3 = "0x".substr($t2,24);
		$t31 = $t3;
                $t3 = "\033[01;32m$t3\033[00m";
            break;
            case "20":
                $t3 = gmp_hexdec($t2);
		$t31 = $t3;
                $t3 = "\033[01;31m$t3\033[00m";

            break;
            default:
                $t3 = gmp_hexdec($t2);
                //$t3 /= 10**18;
		$t3 = div10($t3,18,36);
		$t31 = $t3;
        }

	$t4[$w][$i] = $t31;
        //print $t3."\t";
        //print "\n";
    }
    }
//    $t = hexdec($t);
//    $t /= 10**6;
//    $o[$v2[id]] = $t;

//    print $t."\t";
//    $t = $t/$kurs;
//    print $t."\t";
//    print "\n";
}
foreach($t4 as $wal=>$t5)
{
print_r($t5);

$rate = $t5[29];

$t = $t5[6];
$o2[$wal][lp_matic_sushi_ddao_wal_lp_bal_full] = $t;
$o2[$wal][lp_matic_sushi_ddao_wal_lp_bal_full25] = bcmul($t,0.25,18);
$o2[$wal][lp_matic_sushi_ddao_wal_lp_bal_full50] = bcmul($t,0.5,18);
$o2[$wal][lp_matic_sushi_ddao_wal_lp_bal_full75] = bcmul($t,0.75,18);

$tt = explode(".",$t);
$tt = $tt[1];
$tt = strlen($tt);
$tt = "0.".view_number(1,$tt,"0");
$o2[$wal][lp_matic_sushi_ddao_wal_lp_step] = $tt;


if($t)
{
if($t < 0.001)
{
$t = substr(($t*1000),0,7)." m";
}
}
$o2[$wal][lp_matic_sushi_ddao_wal_lp_bal] = $t;

$t = $t5[11];

$t = round($t,2);
$o2[$wal][lp_matic_sushi_ddao_wal_lp_bal_usd] = $t;

$t = $t5[11] / $rate;
$t = round($t,2);
$o2[$wal][lp_matic_sushi_ddao_wal_lp_bal_ddao] = $t;


//-------------------------------
$t = $t5[14];
$o2[$wal][lp_matic_sushi_gnft_wal_lp_bal_full] = $t;
$o2[$wal][lp_matic_sushi_gnft_wal_lp_bal_full25] = bcmul($t,0.25,18);
$o2[$wal][lp_matic_sushi_gnft_wal_lp_bal_full50] = bcmul($t,0.5,18);
$o2[$wal][lp_matic_sushi_gnft_wal_lp_bal_full75] = bcmul($t,0.75,18);

$tt = explode(".",$t);
$tt = $tt[1];
$tt = strlen($tt);
$tt = "0.".view_number(1,$tt,"0");
$o2[$wal][lp_matic_sushi_gnft_wal_lp_step] = $tt;

if($t < 0.001 && $t)
{
$t = substr(($t*1000),0,7)." m";
}
$o2[$wal][lp_matic_sushi_gnft_wal_lp_bal] = $t;

$t = $t5[19];
$t = round($t,2);
$o2[$wal][lp_matic_sushi_gnft_wal_lp_bal_usd] = $t;

$t = $t5[19] / $rate;
$t = round($t,2);
$o2[$wal][lp_matic_sushi_gnft_wal_lp_bal_ddao] = $t;


//-------------------------------------
$t = $t5[22];
$o2[$wal][lp_matic_quick_gnft_wal_lp_bal_full] = $t;
$o2[$wal][lp_matic_quick_gnft_wal_lp_bal_full25] = bcmul($t,0.25,18);;
$o2[$wal][lp_matic_quick_gnft_wal_lp_bal_full50] = bcmul($t,0.5,18);;
$o2[$wal][lp_matic_quick_gnft_wal_lp_bal_full75] = bcmul($t,0.75,18);;
$tt = explode(".",$t);
$tt = $tt[1];
$tt = strlen($tt);
$tt = "0.".view_number(1,$tt,"0");
$o2[$wal][lp_matic_quick_gnft_wal_lp_step] = $tt;

$t2 = $t;
if($t)
{
if($t2 < 0.001)
{
$t2 *= 1000;
$t2 = substr($t2,0,7);
$t = $t2." m";
}

if($t2 < 0.001 && $t2)
{
$t2 *= 1000;
$t = $t2." &mu;";
}
}

$o2[$wal][lp_matic_quick_gnft_wal_lp_bal] = $t;

$t = $t5[27];
$t = round($t,2);
$o2[$wal][lp_matic_quick_gnft_wal_lp_bal_usd] = $t;

$t = $t5[27] / $rate;
$t = round($t,2);
$o2[$wal][lp_matic_quick_gnft_wal_lp_bal_ddao] = $t;



}


foreach($o2 as $w=>$v2)
{
    $txt = json_encode($v2,192);
    $t = pathinfo(__FILE__);
    $f = $cache_dir."tmp/".$w.".".$t[filename].".json";
    $a = @file_get_contents($f);
//    if(file_exists($f))    print "File exists: $f\n";
//print $f."\n";
    print $txt;

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